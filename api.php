<?php

session_start();

header("Content-Type: application/json; charset=utf-8");

require_once __DIR__ . "/db.php";

function out($data, $status = 200)
{
    http_response_code($status);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

function input()
{
    $raw = file_get_contents("php://input");
    $json = json_decode($raw, true);

    if (is_array($json)) {
        return $json;
    }

    return $_POST;
}

function uid()
{
    return !empty($_SESSION["usuario_id"]) ? (int) $_SESSION["usuario_id"] : 0;
}

function needUser()
{
    if (!uid()) {
        out([
            "ok" => false,
            "message" => "Sessão expirada."
        ], 401);
    }
}

function needAdmin()
{

    needUser();

    global $conn;

    $id = uid();

    $stmt = $conn->prepare("
        SELECT tipo
        FROM usuarios
        WHERE id = ?
    ");

    $stmt->bind_param("i", $id);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc();

    if (!$usuario || $usuario["tipo"] !== "admin") {
        out([
            "ok" => false,
            "message" => "Acesso negado."
        ], 403);
    }
}

function logAction($action, $descricao = "")
{

    global $conn;

    $usuarioId = uid();
    $ip = $_SERVER["REMOTE_ADDR"] ?? null;

    $stmt = $conn->prepare("
        INSERT INTO logs_sistema
        (usuario_id, acao, descricao, ip)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->bind_param("isss", $usuarioId, $action, $descricao, $ip);
    $stmt->execute();
}

$action = $_GET["action"] ?? "";
$d = input();

try {

    switch ($action) {

        case "register":

            $nome = trim($d["nome"] ?? "");
            $email = strtolower(trim($d["email"] ?? ""));
            $telefone = trim($d["telefone"] ?? "");
            $senha = $d["senha"] ?? "";
            $tipo = $d["tipo"] ?? "protegida";

            if (!$nome || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($senha) < 6) {
                out([
                    "ok" => false,
                    "message" => "Dados de cadastro inválidos."
                ], 422);
            }

            if (!in_array($tipo, ["protegida", "responsavel"], true)) {
                $tipo = "protegida";
            }

            $stmt = $conn->prepare("
                SELECT id
                FROM usuarios
                WHERE email = ?
            ");

            $stmt->bind_param("s", $email);
            $stmt->execute();

            if ($stmt->get_result()->fetch_assoc()) {
                out([
                    "ok" => false,
                    "message" => "Este e-mail já está cadastrado."
                ], 409);
            }

            $conn->begin_transaction();

            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("
                INSERT INTO usuarios
                (nome, email, telefone, senha, tipo)
                VALUES (?, ?, ?, ?, ?)
            ");

            $stmt->bind_param(
                "sssss",
                $nome,
                $email,
                $telefone,
                $senhaHash,
                $tipo
            );

            $stmt->execute();

            $id = $conn->insert_id;

            $stmt = $conn->prepare("
                INSERT INTO configuracoes (usuario_id)
                VALUES (?)
            ");

            $stmt->bind_param("i", $id);
            $stmt->execute();

            if (
                $tipo === "protegida" &&
                !empty($d["contatoEmergencia"]) &&
                !empty($d["telefoneEmergencia"])
            ) {

                $nomeContato = trim($d["contatoEmergencia"]);
                $telefoneContato = trim($d["telefoneEmergencia"]);
                $principal = 1;

                $stmt = $conn->prepare("
                    INSERT INTO contatos_emergencia
                    (usuario_id, nome, telefone, principal)
                    VALUES (?, ?, ?, ?)
                ");

                $stmt->bind_param(
                    "issi",
                    $id,
                    $nomeContato,
                    $telefoneContato,
                    $principal
                );

                $stmt->execute();
            }

            if ($tipo === "responsavel" && !empty($d["codigoConvite"])) {

                $codigo = strtoupper(trim($d["codigoConvite"]));

                $stmt = $conn->prepare("
                    SELECT usuario_id
                    FROM convites
                    WHERE codigo = ?
                    AND utilizado = 0
                    LIMIT 1
                ");

                $stmt->bind_param("s", $codigo);
                $stmt->execute();

                $convite = $stmt->get_result()->fetch_assoc();

                if ($convite) {

                    $usuarioProtegido = (int) $convite["usuario_id"];
                    $relacao = trim($d["relacao"] ?? "");

                    $stmt = $conn->prepare("
                        INSERT INTO responsaveis
                        (usuario_protegido_id, usuario_responsavel_id, relacao)
                        VALUES (?, ?, ?)
                    ");

                    $stmt->bind_param(
                        "iis",
                        $usuarioProtegido,
                        $id,
                        $relacao
                    );

                    $stmt->execute();

                    $stmt = $conn->prepare("
                        UPDATE convites
                        SET utilizado = 1
                        WHERE codigo = ?
                    ");

                    $stmt->bind_param("s", $codigo);
                    $stmt->execute();
                }
            }

            $conn->commit();

            $_SESSION["usuario_id"] = $id;
            $_SESSION["usuario_tipo"] = $tipo;

            out([
                "ok" => true,
                "user" => [
                    "id" => $id,
                    "nome" => $nome,
                    "email" => $email,
                    "telefone" => $telefone,
                    "tipo" => $tipo
                ]
            ]);

        case "login":

            $email = strtolower(trim($d["email"] ?? ""));
            $senha = $d["senha"] ?? "";

            $stmt = $conn->prepare("
        SELECT id, nome, email, telefone, senha, tipo
        FROM usuarios
        WHERE email = ?
        AND ativo = 1
        LIMIT 1
    ");

            $stmt->bind_param("s", $email);
            $stmt->execute();

            $stmt->bind_result(
                $id,
                $nome,
                $emailBanco,
                $telefone,
                $senhaBanco,
                $tipo
            );

            if (!$stmt->fetch()) {
                out([
                    "ok" => false,
                    "message" => "E-mail ou senha incorretos."
                ], 401);
            }

            if (!password_verify($senha, $senhaBanco)) {
                out([
                    "ok" => false,
                    "message" => "E-mail ou senha incorretos."
                ], 401);
            }

            session_regenerate_id(true);

            $_SESSION["usuario_id"] = (int) $id;
            $_SESSION["usuario_tipo"] = $tipo;

            logAction("login", "Login realizado");

            out([
                "ok" => true,
                "user" => [
                    "id" => $id,
                    "nome" => $nome,
                    "email" => $emailBanco,
                    "telefone" => $telefone,
                    "tipo" => $tipo
                ]
            ]);

        case "admin_login":

            $email = strtolower(trim($d["email"] ?? ""));
            $senha = $d["senha"] ?? "";

            $stmt = $conn->prepare("
                SELECT *
                FROM usuarios
                WHERE email = ?
                AND tipo = 'admin'
                AND ativo = 1
                LIMIT 1
            ");

            $stmt->bind_param("s", $email);
            $stmt->execute();

            $usuario = $stmt->get_result()->fetch_assoc();

            if (!$usuario || !password_verify($senha, $usuario["senha"])) {
                out([
                    "ok" => false,
                    "message" => "Credenciais administrativas inválidas."
                ], 401);
            }

            session_regenerate_id(true);

            $_SESSION["usuario_id"] = (int) $usuario["id"];
            $_SESSION["usuario_tipo"] = "admin";

            out(["ok" => true]);

        case "logout":

            session_unset();
            session_destroy();

            out(["ok" => true]);

        case "bootstrap":

            needUser();

            $id = uid();

            $stmt = $conn->prepare("
                SELECT id, nome, email, telefone, tipo
                FROM usuarios
                WHERE id = ?
            ");

            $stmt->bind_param("i", $id);
            $stmt->execute();

            $usuario = $stmt->get_result()->fetch_assoc();

            $stmt = $conn->prepare("
                SELECT id, nome, telefone, relacao, principal
                FROM contatos_emergencia
                WHERE usuario_id = ?
                AND ativo = 1
                ORDER BY principal DESC, nome
            ");

            $stmt->bind_param("i", $id);
            $stmt->execute();

            $contatos = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            $stmt = $conn->prepare("
                SELECT
                    id,
                    data_relato AS data,
                    horario,
                    pessoa,
                    local,
                    relato,
                    observacoes
                FROM diario
                WHERE usuario_id = ?
                ORDER BY data_relato DESC, horario DESC
            ");

            $stmt->bind_param("i", $id);
            $stmt->execute();

            $relatos = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            $stmt = $conn->prepare("
                SELECT id, remetente, mensagem, criado_em
                FROM mensagens_chat
                WHERE usuario_id = ?
                ORDER BY id
            ");

            $stmt->bind_param("i", $id);
            $stmt->execute();

            $chat = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            out([
                "ok" => true,
                "user" => $usuario,
                "contatos" => $contatos,
                "relatos" => $relatos,
                "chat" => $chat
            ]);

        case "save_contacts":

            needUser();

            $items = $d["contatos"] ?? [];

            if (!is_array($items)) {
                out([
                    "ok" => false,
                    "message" => "Contatos inválidos."
                ], 422);
            }

            $id = uid();

            $conn->begin_transaction();

            $stmt = $conn->prepare("
                DELETE FROM contatos_emergencia
                WHERE usuario_id = ?
            ");

            $stmt->bind_param("i", $id);
            $stmt->execute();

            $stmt = $conn->prepare("
                INSERT INTO contatos_emergencia
                (usuario_id, nome, telefone, relacao, principal)
                VALUES (?, ?, ?, ?, ?)
            ");

            foreach ($items as $contato) {

                if (!empty($contato["nome"]) && !empty($contato["telefone"])) {

                    $nome = trim($contato["nome"]);
                    $telefone = trim($contato["telefone"]);
                    $relacao = trim($contato["relacao"] ?? "");
                    $principal = !empty($contato["principal"]) ? 1 : 0;

                    $stmt->bind_param(
                        "isssi",
                        $id,
                        $nome,
                        $telefone,
                        $relacao,
                        $principal
                    );

                    $stmt->execute();
                }
            }

            $conn->commit();

            out(["ok" => true]);

        case "save_diary":

            needUser();

            $id = uid();
            $data = $d["data"] ?? date("Y-m-d");
            $horario = $d["horario"] ?? date("H:i");
            $pessoa = trim($d["pessoa"] ?? "");
            $local = trim($d["local"] ?? "");
            $relato = trim($d["relato"] ?? "");
            $observacoes = trim($d["observacoes"] ?? "");

            $stmt = $conn->prepare("
                INSERT INTO diario
                (usuario_id, data_relato, horario, pessoa, local, relato, observacoes)
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ");

            $stmt->bind_param(
                "issssss",
                $id,
                $data,
                $horario,
                $pessoa,
                $local,
                $relato,
                $observacoes
            );

            $stmt->execute();

            out([
                "ok" => true,
                "id" => $conn->insert_id
            ]);

        case "delete_diary":

            needUser();

            $idRelato = (int) ($d["id"] ?? 0);
            $idUsuario = uid();

            $stmt = $conn->prepare("
                DELETE FROM diario
                WHERE id = ?
                AND usuario_id = ?
            ");

            $stmt->bind_param("ii", $idRelato, $idUsuario);
            $stmt->execute();

            out(["ok" => true]);

        case "create_alert":

            needUser();

            $idUsuario = uid();
            $tipo = $d["tipo"] ?? "emergencia";
            $titulo = trim($d["titulo"] ?? "Alerta de emergência");
            $descricao = trim($d["descricao"] ?? "");

            $stmt = $conn->prepare("
                INSERT INTO alertas
                (usuario_id, tipo, titulo, descricao, status)
                VALUES (?, ?, ?, ?, 'ativo')
            ");

            $stmt->bind_param(
                "isss",
                $idUsuario,
                $tipo,
                $titulo,
                $descricao
            );

            $stmt->execute();

            $idAlerta = $conn->insert_id;

            if (isset($d["latitude"], $d["longitude"])) {

                $latitude = $d["latitude"];
                $longitude = $d["longitude"];
                $precisao = $d["precisao"] ?? null;

                $stmt = $conn->prepare("
                    INSERT INTO localizacoes
                    (usuario_id, alerta_id, latitude, longitude, precisao)
                    VALUES (?, ?, ?, ?, ?)
                ");

                $stmt->bind_param(
                    "iiddi",
                    $idUsuario,
                    $idAlerta,
                    $latitude,
                    $longitude,
                    $precisao
                );

                $stmt->execute();
            }

            out([
                "ok" => true,
                "id" => $idAlerta
            ]);

        case "resolve_alert":

            needUser();

            $idAlerta = (int) ($d["id"] ?? 0);
            $idUsuario = uid();

            $stmt = $conn->prepare("
                UPDATE alertas
                SET status = 'resolvido',
                    data_fim = NOW()
                WHERE id = ?
                AND usuario_id = ?
            ");

            $stmt->bind_param("ii", $idAlerta, $idUsuario);
            $stmt->execute();

            out(["ok" => true]);

        case "location":

            needUser();

            $idUsuario = uid();
            $alertaId = $d["alerta_id"] ?? null;
            $latitude = $d["latitude"];
            $longitude = $d["longitude"];
            $precisao = $d["precisao"] ?? null;

            $stmt = $conn->prepare("
                INSERT INTO localizacoes
                (usuario_id, alerta_id, latitude, longitude, precisao)
                VALUES (?, ?, ?, ?, ?)
            ");

            $stmt->bind_param(
                "iiddi",
                $idUsuario,
                $alertaId,
                $latitude,
                $longitude,
                $precisao
            );

            $stmt->execute();

            out(["ok" => true]);

        case "save_profile":

            needUser();

            $id = uid();

            $nome = trim($d["nome"] ?? "");
            $email = trim($d["email"] ?? "");
            $telefone = trim($d["telefone"] ?? "");

            $stmt = $conn->prepare("
                UPDATE usuarios
                SET nome = ?, email = ?, telefone = ?
                WHERE id = ?
            ");

            $stmt->bind_param(
                "sssi",
                $nome,
                $email,
                $telefone,
                $id
            );

            $stmt->execute();

            out(["ok" => true]);

        case "chat":

            needUser();

            $id = uid();
            $remetente = $d["remetente"] ?? "usuario";
            $mensagem = trim($d["mensagem"] ?? "");

            $stmt = $conn->prepare("
                INSERT INTO mensagens_chat
                (usuario_id, remetente, mensagem)
                VALUES (?, ?, ?)
            ");

            $stmt->bind_param(
                "iss",
                $id,
                $remetente,
                $mensagem
            );

            $stmt->execute();

            out([
                "ok" => true,
                "id" => $conn->insert_id
            ]);

        case "generate_invite":

            needUser();

            $id = uid();
            $codigo = strtoupper(substr(bin2hex(random_bytes(5)), 0, 8));

            $stmt = $conn->prepare("
                INSERT INTO convites
                (usuario_id, codigo)
                VALUES (?, ?)
            ");

            $stmt->bind_param("is", $id, $codigo);
            $stmt->execute();

            out([
                "ok" => true,
                "codigo" => $codigo
            ]);

        case "admin_stats":

            needAdmin();

            $stats = [];

            $stmt = $conn->prepare("
                SELECT COUNT(*)
                FROM usuarios
                WHERE tipo <> 'admin'
            ");

            $stmt->execute();
            $stats["usuarios"] = (int) $stmt->get_result()->fetch_row()[0];

            $stmt = $conn->prepare("
                SELECT COUNT(*)
                FROM dispositivos
            ");

            $stmt->execute();
            $stats["dispositivos"] = (int) $stmt->get_result()->fetch_row()[0];

            $stmt = $conn->prepare("
                SELECT COUNT(*)
                FROM alertas
            ");

            $stmt->execute();
            $stats["alertas"] = (int) $stmt->get_result()->fetch_row()[0];

            $stmt = $conn->prepare("
                SELECT COUNT(*)
                FROM alertas
                WHERE status = 'ativo'
            ");

            $stmt->execute();
            $stats["ativos"] = (int) $stmt->get_result()->fetch_row()[0];

            $stmt = $conn->prepare("
                SELECT COUNT(*)
                FROM alertas
                WHERE status = 'resolvido'
            ");

            $stmt->execute();
            $stats["resolvidos"] = (int) $stmt->get_result()->fetch_row()[0];

            out([
                "ok" => true,
                "stats" => $stats
            ]);

        case "admin_users":

            needAdmin();

            $stmt = $conn->prepare("
                SELECT id, nome, email, telefone, tipo, ativo, criado_em
                FROM usuarios
                WHERE tipo <> 'admin'
                ORDER BY id DESC
            ");

            $stmt->execute();

            $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            out([
                "ok" => true,
                "items" => $items
            ]);

        case "admin_alerts":

            needAdmin();

            $stmt = $conn->prepare("
                SELECT
                    a.id,
                    a.tipo,
                    a.titulo,
                    a.descricao,
                    a.status,
                    a.data_inicio,
                    a.data_fim,
                    u.nome AS usuario
                FROM alertas a
                JOIN usuarios u ON u.id = a.usuario_id
                ORDER BY a.id DESC
            ");

            $stmt->execute();

            $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            out([
                "ok" => true,
                "items" => $items
            ]);

        case "admin_devices":

            needAdmin();

            $stmt = $conn->prepare("
                SELECT d.*, u.nome AS usuario
                FROM dispositivos d
                LEFT JOIN usuarios u ON u.id = d.usuario_id
                ORDER BY d.id DESC
            ");

            $stmt->execute();

            $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            out([
                "ok" => true,
                "items" => $items
            ]);

        case "admin_contacts":

            needAdmin();

            $stmt = $conn->prepare("
                SELECT c.*, u.nome AS usuario
                FROM contatos_emergencia c
                JOIN usuarios u ON u.id = c.usuario_id
                ORDER BY c.id DESC
            ");

            $stmt->execute();

            $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            out([
                "ok" => true,
                "items" => $items
            ]);

        case "admin_report":

            needAdmin();

            $stmt = $conn->prepare("
                SELECT
                    DATE(data_inicio) AS dia,
                    tipo,
                    COUNT(*) AS quantidade
                FROM alertas
                GROUP BY DATE(data_inicio), tipo
                ORDER BY dia
            ");

            $stmt->execute();

            $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            out([
                "ok" => true,
                "items" => $items
            ]);

        default:

            out([
                "ok" => false,
                "message" => "Ação não encontrada."
            ], 404);
    }

} catch (Throwable $e) {

    if ($conn->errno) {
        // Não interrompe a resposta caso o erro não seja de transação.
    }

    out([
        "ok" => false,
        "message" => "Erro no servidor.",
        "detail" => $e->getMessage()
    ], 500);
}
