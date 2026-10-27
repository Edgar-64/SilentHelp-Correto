<?php

session_start();
header("Content-Type: application/json; charset=utf-8");

require_once __DIR__ . "/../db.php";

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
    return !empty($_SESSION["usuario_id"])
        ? (int) $_SESSION["usuario_id"]
        : 0;
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

    $stmt = $conn->prepare("SELECT type FROM users WHERE id = ? LIMIT 1");
    if (!$stmt) {
        throw new Exception($conn->error);
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($tipo);

    if (!$stmt->fetch() || $tipo !== "admin") {
        $stmt->close();
        out([
            "ok" => false,
            "message" => "Acesso negado."
        ], 403);
    }

    $stmt->close();
}

$action = $_GET["action"] ?? "";
$d = input();

try {

    switch ($action) {

        case "get_preferences":
            needUser();
            $defaults = [
                "localizacao" => "1",
                "modoDiscreto" => "0",
                "alertas" => "1",
                "notificacoes" => "1",
                "sons" => "0"
            ];
            $usuarioId = uid();
            $stmt = $conn->prepare("SELECT setting_key, setting_value FROM settings WHERE user_id = ? AND setting_key IN ('localizacao','modoDiscreto','alertas','notificacoes','sons')");
            if (!$stmt) throw new Exception($conn->error);
            $stmt->bind_param("i", $usuarioId);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $defaults[$row["setting_key"]] = $row["setting_value"] === "1" ? "1" : "0";
            }
            $stmt->close();
            $prefs = [];
            foreach ($defaults as $key => $value) $prefs[$key] = ($value === "1");
            out(["ok" => true, "preferences" => $prefs]);

        case "save_preferences":
            needUser();
            $allowed = ["localizacao", "modoDiscreto", "alertas", "notificacoes", "sons"];
            $usuarioId = uid();
            $saved = [];
            foreach ($allowed as $key) {
                if (!array_key_exists($key, $d)) continue;
                $value = filter_var($d[$key], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
                if ($value === null) out(["ok" => false, "message" => "Preferência inválida: " . $key], 400);
                $valor = $value ? "1" : "0";
                $check = $conn->prepare("SELECT id FROM settings WHERE user_id = ? AND setting_key = ? LIMIT 1");
                if (!$check) throw new Exception($conn->error);
                $check->bind_param("is", $usuarioId, $key);
                $check->execute();
                $check->bind_result($settingId);
                $exists = $check->fetch();
                $check->close();
                if ($exists) {
                    $stmt = $conn->prepare("UPDATE settings SET setting_value = ? WHERE id = ?");
                    if (!$stmt) throw new Exception($conn->error);
                    $stmt->bind_param("si", $valor, $settingId);
                } else {
                    $stmt = $conn->prepare("INSERT INTO settings (user_id, setting_key, setting_value) VALUES (?, ?, ?)");
                    if (!$stmt) throw new Exception($conn->error);
                    $stmt->bind_param("iss", $usuarioId, $key, $valor);
                }
                $stmt->execute();
                $stmt->close();
                $saved[$key] = $value;
            }
            out(["ok" => true, "preferences" => $saved]);
        case "battery_update":
            needUser();
            $nivel = filter_var($d["level"] ?? null, FILTER_VALIDATE_INT);
            if ($nivel === false || $nivel < 0 || $nivel > 100) {
                out(["ok" => false, "message" => "Nível de bateria inválido."], 400);
            }
            $usuarioId = uid();
            $stmt = $conn->prepare("INSERT INTO settings (user_id, setting_key, setting_value) VALUES (?, 'battery_level', ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)");
            if (!$stmt)
                throw new Exception($conn->error);
            $valor = (string) $nivel;
            $stmt->bind_param("is", $usuarioId, $valor);
            $stmt->execute();
            $stmt->close();
            $agora = date('Y-m-d H:i:s');
            $stmt = $conn->prepare("INSERT INTO settings (user_id, setting_key, setting_value) VALUES (?, 'battery_updated_at', ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)");
            if (!$stmt)
                throw new Exception($conn->error);
            $stmt->bind_param("is", $usuarioId, $agora);
            $stmt->execute();
            $stmt->close();
            out(["ok" => true, "level" => $nivel]);

        case "responsible_battery":
            needUser();
            $responsavelId = uid();
            $stmt = $conn->prepare("SELECT u.id FROM responsible_links rl INNER JOIN users u ON u.id = rl.protected_user_id WHERE rl.responsible_user_id = ? AND rl.status = 'active' LIMIT 1");
            if (!$stmt)
                throw new Exception($conn->error);
            $stmt->bind_param("i", $responsavelId);
            $stmt->execute();
            $stmt->bind_result($protegidoId);
            if (!$stmt->fetch()) {
                $stmt->close();
                out(["ok" => true, "level" => null, "updated_at" => null]);
            }
            $stmt->close();
            $stmt = $conn->prepare("SELECT setting_key, setting_value FROM settings WHERE user_id = ? AND setting_key IN ('battery_level','battery_updated_at')");
            if (!$stmt)
                throw new Exception($conn->error);
            $stmt->bind_param("i", $protegidoId);
            $stmt->execute();
            $result = $stmt->get_result();
            $vals = [];
            while ($row = $result->fetch_assoc())
                $vals[$row['setting_key']] = $row['setting_value'];
            $stmt->close();
            $level = isset($vals['battery_level']) ? (int) $vals['battery_level'] : null;
            $updated = $vals['battery_updated_at'] ?? null;
            // Leituras com mais de 10 minutos são consideradas desatualizadas.
            $fresh = $updated && (time() - strtotime($updated) <= 600);
            out(["ok" => true, "level" => ($fresh ? $level : null), "updated_at" => $updated, "stale" => !$fresh]);

        /* =========================
           CADASTRO
        ========================= */
        case "register":

            $nome = trim($d["nome"] ?? "");
            $email = strtolower(trim($d["email"] ?? ""));
            $telefone = trim($d["telefone"] ?? "");
            $senha = $d["senha"] ?? "";
            $tipo = $d["tipo"] ?? "protegida";

            $codigoInformado = strtoupper(
                trim($d["codigoConvite"] ?? "")
            );

            $contatoEmergencia = trim(
                $d["contatoEmergencia"] ?? ""
            );

            $telefoneEmergencia = trim(
                $d["telefoneEmergencia"] ?? ""
            );

            $relacao = trim($d["relacao"] ?? "");

            // 1. Validar os dados básicos
            if (
                !$nome ||
                !filter_var($email, FILTER_VALIDATE_EMAIL) ||
                strlen($senha) < 6
            ) {
                out([
                    "ok" => false,
                    "message" => "Verifique os dados do cadastro."
                ], 422);
            }

            // Cadastro público não pode criar administradores
            if (!in_array($tipo, ["protegida", "responsavel"], true)) {
                out([
                    "ok" => false,
                    "message" => "Tipo de conta inválido."
                ], 422);
            }

            if ($tipo === "responsavel" && (!$codigoInformado || !$relacao)) {
                out([
                    "ok" => false,
                    "message" => "Informe o código e sua relação com a pessoa protegida."
                ], 422);
            }

            // 2. Verificar se o e-mail já existe
            $stmt = $conn->prepare("
        SELECT id
        FROM users
        WHERE email = ?
        LIMIT 1
    ");

            if (!$stmt) {
                throw new Exception($conn->error);
            }

            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            $emailExiste = $stmt->num_rows > 0;

            $stmt->close();

            if ($emailExiste) {
                out([
                    "ok" => false,
                    "message" => "Este e-mail já está cadastrado."
                ], 409);
            }

            // 3. Se for responsável, localizar a pessoa protegida
            $protegidoId = 0;

            if ($tipo === "responsavel") {

                $stmt = $conn->prepare("
            SELECT id
            FROM users
            WHERE invite_code = ?
              AND type = 'protegida'
            LIMIT 1
        ");

                if (!$stmt) {
                    throw new Exception($conn->error);
                }

                $stmt->bind_param("s", $codigoInformado);
                $stmt->execute();
                $stmt->bind_result($protegidoIdBanco);

                if (!$stmt->fetch()) {
                    $stmt->close();

                    out([
                        "ok" => false,
                        "message" => "Código inválido. Confira o código da pessoa protegida."
                    ], 422);
                }

                $protegidoId = (int) $protegidoIdBanco;
                $stmt->close();
            }

            // 4. Gerar um código exclusivo para uma nova pessoa protegida
            $codigoGerado = null;

            if ($tipo === "protegida") {

                do {
                    $codigoGerado = "SH" .
                        strtoupper(bin2hex(random_bytes(4)));

                    $stmt = $conn->prepare("
                SELECT id
                FROM users
                WHERE invite_code = ?
                LIMIT 1
            ");

                    if (!$stmt) {
                        throw new Exception($conn->error);
                    }

                    $stmt->bind_param("s", $codigoGerado);
                    $stmt->execute();
                    $stmt->store_result();

                    $codigoExiste = $stmt->num_rows > 0;

                    $stmt->close();

                } while ($codigoExiste);
            }

            // 5. Criar a conta e, se necessário, o vínculo
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $codigoBanco = $tipo === "protegida"
                ? $codigoGerado
                : null;

            $conn->begin_transaction();

            try {

                $stmt = $conn->prepare("
            INSERT INTO users (
                type,
                name,
                email,
                phone,
                password_hash,
                invite_code,
                emergency_contact,
                emergency_phone,
                relationship
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

                if (!$stmt) {
                    throw new Exception($conn->error);
                }

                $stmt->bind_param(
                    "sssssssss",
                    $tipo,
                    $nome,
                    $email,
                    $telefone,
                    $senhaHash,
                    $codigoBanco,
                    $contatoEmergencia,
                    $telefoneEmergencia,
                    $relacao
                );

                if (!$stmt->execute()) {
                    throw new Exception($stmt->error);
                }

                $novoUsuarioId = (int) $conn->insert_id;
                $stmt->close();

                // Se a conta for de responsável, salvar o vínculo
                if ($tipo === "responsavel") {

                    $stmt = $conn->prepare("
                INSERT INTO responsible_links (
                    protected_user_id,
                    responsible_user_id,
                    relationship,
                    status
                )
                VALUES (?, ?, ?, 'active')
            ");

                    if (!$stmt) {
                        throw new Exception($conn->error);
                    }

                    $stmt->bind_param(
                        "iis",
                        $protegidoId,
                        $novoUsuarioId,
                        $relacao
                    );

                    if (!$stmt->execute()) {
                        throw new Exception($stmt->error);
                    }

                    $stmt->close();
                }

                $conn->commit();

            } catch (Throwable $e) {

                $conn->rollback();

                error_log("Erro no cadastro SilentHelp: " . $e->getMessage());

                out([
                    "ok" => false,
                    "message" => "Não foi possível concluir o cadastro. Tente novamente."
                ], 500);
            }

            // 6. Iniciar sessão
            session_regenerate_id(true);

            $_SESSION["usuario_id"] = $novoUsuarioId;
            $_SESSION["usuario_tipo"] = $tipo;
            $_SESSION["nome"] = $nome;

            // 7. Retornar os dados para o frontend
            $resposta = [
                "ok" => true,
                "user" => [
                    "id" => $novoUsuarioId,
                    "nome" => $nome,
                    "email" => $email,
                    "telefone" => $telefone,
                    "tipo" => $tipo
                ]
            ];

            // O código só é devolvido ao criar a conta protegida
            if ($tipo === "protegida") {
                $resposta["codigoConvite"] = $codigoGerado;
            }

            out($resposta);


        /* =========================
           LOGIN
        ========================= */
        case "login":

            $email = strtolower(trim($d["email"] ?? ""));
            $senha = $d["senha"] ?? "";

            $stmt = $conn->prepare("
        SELECT id, name, email, phone, password_hash, type
        FROM users
        WHERE email = ?
        LIMIT 1
    ");

            if (!$stmt) {
                throw new Exception($conn->error);
            }

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
                $stmt->close();

                out([
                    "ok" => false,
                    "message" => "E-mail ou senha incorretos."
                ], 401);
            }

            $stmt->close();

            if (!password_verify($senha, $senhaBanco)) {
                out([
                    "ok" => false,
                    "message" => "E-mail ou senha incorretos."
                ], 401);
            }

            session_regenerate_id(true);

            $_SESSION["usuario_id"] = (int) $id;
            $_SESSION["usuario_tipo"] = $tipo;
            $_SESSION["nome"] = $nome;

            out([
                "ok" => true,
                "user" => [
                    "id" => (int) $id,
                    "nome" => $nome,
                    "email" => $emailBanco,
                    "telefone" => $telefone,
                    "tipo" => $tipo
                ]
            ]);


        /* =========================
           LOGIN ADMIN
        ========================= */
        case "admin_login":

            $email = strtolower(trim($d["email"] ?? ""));
            $senha = $d["senha"] ?? "";

            $stmt = $conn->prepare("\n
            SELECT id, name, email, phone, password_hash, type\n
            FROM users\n
            WHERE email = ?\n
            AND type = 'admin'\n
            LIMIT 1\n            ");

            if (!$stmt) {
                throw new Exception($conn->error);
            }

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
                $stmt->close();
                out([
                    "ok" => false,
                    "message" => "Credenciais administrativas inválidas."
                ], 401);
            }

            $stmt->close();

            if (!password_verify($senha, $senhaBanco)) {
                out([
                    "ok" => false,
                    "message" => "Credenciais administrativas inválidas."
                ], 401);
            }

            session_regenerate_id(true);
            $_SESSION["usuario_id"] = (int) $id;
            $_SESSION["usuario_tipo"] = "admin";
            $_SESSION["nome"] = $nome;

            out([
                "ok" => true,
                "user" => [
                    "id" => (int) $id,
                    "nome" => $nome,
                    "email" => $emailBanco,
                    "telefone" => $telefone,
                    "tipo" => "admin"
                ]
            ]);


        /* =========================
           LOGOUT
        ========================= */
        case "logout":

            session_unset();
            session_destroy();

            out(["ok" => true]);


        /* =========================
           DADOS INICIAIS DO USUÁRIO
        ========================= */
        case "bootstrap":

            needUser();
            $id = uid();

            $stmt = $conn->prepare("\n                SELECT id, name, email, phone, type\n                FROM users\n                WHERE id = ?\n                LIMIT 1\n            ");
            if (!$stmt) {
                throw new Exception($conn->error);
            }

            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($uidBanco, $nome, $email, $telefone, $tipo);

            if (!$stmt->fetch()) {
                $stmt->close();
                out(["ok" => false, "message" => "Usuário não encontrado."], 404);
            }
            $stmt->close();

            $usuario = [
                "id" => (int) $uidBanco,
                "nome" => $nome,
                "email" => $email,
                "telefone" => $telefone,
                "tipo" => $tipo
            ];

            $contatos = [];
            $stmt = $conn->prepare("\n                SELECT id, name, phone, relationship, is_primary\n                FROM emergency_contacts\n                WHERE user_id = ?\n                ORDER BY is_primary DESC, name\n            ");
            if (!$stmt) {
                throw new Exception($conn->error);
            }
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($cid, $cnome, $ctelefone, $crelacao, $cprincipal);

            while ($stmt->fetch()) {
                $contatos[] = [
                    "id" => (int) $cid,
                    "nome" => $cnome,
                    "telefone" => $ctelefone,
                    "relacao" => $crelacao,
                    "principal" => (int) $cprincipal
                ];
            }
            $stmt->close();

            $relatos = [];
            $stmt = $conn->prepare("\n                SELECT id, title, content, mood, entry_date, created_at\n                FROM diary_entries\n                WHERE user_id = ?\n                ORDER BY entry_date DESC, id DESC\n            ");
            if (!$stmt) {
                throw new Exception($conn->error);
            }
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($rid, $titulo, $conteudo, $humor, $dataRelato, $criadoEm);

            while ($stmt->fetch()) {
                $relatos[] = [
                    "id" => (int) $rid,
                    "data" => $dataRelato,
                    "horario" => date("H:i", strtotime($criadoEm)),
                    "pessoa" => $titulo,
                    "local" => "",
                    "relato" => $conteudo,
                    "observacoes" => $humor
                ];
            }
            $stmt->close();

            // O SQL enviado não possui tabela de chat.
            // Retornamos lista vazia para não quebrar o frontend.
            $chat = [];

            out([
                "ok" => true,
                "user" => $usuario,
                "contatos" => $contatos,
                "relatos" => $relatos,
                "chat" => $chat
            ]);


        /* =========================
           CONTATOS DE EMERGÊNCIA
        ========================= */
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

            try {
                $stmt = $conn->prepare("DELETE FROM emergency_contacts WHERE user_id = ?");
                if (!$stmt) {
                    throw new Exception($conn->error);
                }
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->close();

                $stmt = $conn->prepare("\n                    INSERT INTO emergency_contacts\n                    (user_id, name, phone, relationship, is_primary)\n                    VALUES (?, ?, ?, ?, ?)\n                ");
                if (!$stmt) {
                    throw new Exception($conn->error);
                }

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

                $stmt->close();
                $conn->commit();

            } catch (Throwable $e) {
                $conn->rollback();
                throw $e;
            }

            out(["ok" => true]);


        /* =========================
           DIÁRIO
        ========================= */
        case "save_diary":

            needUser();

            $id = uid();
            $data = $d["data"] ?? date("Y-m-d");
            $pessoa = trim($d["pessoa"] ?? $d["titulo"] ?? "");
            $relato = trim($d["relato"] ?? $d["conteudo"] ?? "");
            $observacoes = trim($d["observacoes"] ?? $d["humor"] ?? "");

            $stmt = $conn->prepare("\n                INSERT INTO diary_entries\n                (user_id, title, content, mood, entry_date)\n                VALUES (?, ?, ?, ?, ?)\n            ");
            if (!$stmt) {
                throw new Exception($conn->error);
            }

            $stmt->bind_param(
                "issss",
                $id,
                $pessoa,
                $relato,
                $observacoes,
                $data
            );
            $stmt->execute();
            $novoId = $conn->insert_id;
            $stmt->close();

            out([
                "ok" => true,
                "id" => $novoId
            ]);


        case "delete_diary":

            needUser();

            $idRelato = (int) ($d["id"] ?? 0);
            $idUsuario = uid();

            $stmt = $conn->prepare("\n                DELETE FROM diary_entries\n                WHERE id = ?\n                AND user_id = ?\n            ");
            if (!$stmt) {
                throw new Exception($conn->error);
            }

            $stmt->bind_param("ii", $idRelato, $idUsuario);
            $stmt->execute();
            $stmt->close();

            out(["ok" => true]);


        /* =========================
   ALERTA
========================= */
        case "create_alert":

            needUser();

            $idUsuario = uid();

            $tipo = trim($d["tipo"] ?? "emergencia");
            $titulo = trim($d["titulo"] ?? "Alerta de emergência");
            $descricao = trim($d["descricao"] ?? "");

            $latitude = $d["latitude"] ?? null;
            $longitude = $d["longitude"] ?? null;


            /*
             * O alerta deve ser registrado no banco mesmo se o vínculo
             * com o responsável estiver temporariamente ausente. A tela
             * do responsável só exibirá alertas de pessoas vinculadas.
             */

            /*
             * =====================================================
             * MONTAR MENSAGEM
             * =====================================================
             */

            $mensagem = $titulo;

            if ($descricao !== "") {
                $mensagem .= " - " . $descricao;
            }


            /*
             * =====================================================
             * SALVAR ALERTA
             * =====================================================
             */

            $stmt = $conn->prepare("
        INSERT INTO alerts
        (
            user_id,
            type,
            message,
            latitude,
            longitude,
            status
        )
        VALUES (?, ?, ?, ?, ?, 'open')
    ");

            if (!$stmt) {
                throw new Exception($conn->error);
            }

            $lat = $latitude !== null
                ? (float) $latitude
                : null;

            $lng = $longitude !== null
                ? (float) $longitude
                : null;

            // Strings preservam NULL quando a localização não foi obtida.
            // Tipos corretos: id inteiro, tipo/mensagem texto e coordenadas numéricas.
            // mysqli aceita NULL para coordenadas quando o navegador não forneceu GPS.
            $stmt->bind_param(
                "issdd",
                $idUsuario,
                $tipo,
                $mensagem,
                $lat,
                $lng
            );

            if (!$stmt->execute()) {

                $erro = $stmt->error;
                $stmt->close();

                throw new Exception(
                    "Erro ao registrar alerta: " . $erro
                );
            }

            $idAlerta = $conn->insert_id;

            $stmt->close();


            /*
             * =====================================================
             * RETORNO
             * =====================================================
             */

            out([
                "ok" => true,
                "id" => (int) $idAlerta,
                "status" => "open",
                "message" => "Alerta enviado ao responsável."
            ]);

        /* =========================
ALERTA DO RESPONSÁVEL
========================= */
        case "responsible_alert":

            needUser();

            $responsavelId = uid();


            /*
             * =====================================================
             * BUSCAR ALERTA DA PESSOA PROTEGIDA VINCULADA
             * =====================================================
             */

            $stmt = $conn->prepare("
        SELECT
            a.id,
            a.user_id,
            a.type,
            a.message,
            a.status,
            a.latitude,
            a.longitude,
            a.created_at,
            u.name
        FROM alerts a

        INNER JOIN responsible_links rl
            ON rl.protected_user_id = a.user_id

        INNER JOIN users u
            ON u.id = a.user_id

        WHERE
            rl.responsible_user_id = ?
            AND rl.status = 'active'
            AND LOWER(TRIM(a.status)) IN ('open', 'aberto', 'aberta', 'attended', 'atendido', 'atendida', 'em_atendimento')

        ORDER BY CASE WHEN LOWER(a.status) IN ('open', 'aberto', 'aberta', 'pending', 'pendente') THEN 0 ELSE 1 END, a.id DESC

        LIMIT 1
    ");

            if (!$stmt) {
                throw new Exception($conn->error);
            }

            $stmt->bind_param(
                "i",
                $responsavelId
            );

            $stmt->execute();

            $stmt->bind_result(
                $alertaId,
                $usuarioId,
                $tipo,
                $mensagem,
                $status,
                $latitude,
                $longitude,
                $criadoEm,
                $nomeUsuario
            );


            /*
             * =====================================================
             * NENHUM ALERTA
             * =====================================================
             */

            if (!$stmt->fetch()) {

                $stmt->close();

                out([
                    "ok" => true,
                    "alerta" => null
                ]);
            }


            $stmt->close();


            /*
             * =====================================================
             * RETORNAR ALERTA
             * =====================================================
             */

            out([
                "ok" => true,

                "alerta" => [
                    "id" => (int) $alertaId,
                    "usuario_id" => (int) $usuarioId,
                    "usuario_nome" => $nomeUsuario,
                    "tipo" => $tipo,
                    "mensagem" => $mensagem,
                    "status" => $status,
                    "latitude" => $latitude,
                    "longitude" => $longitude,
                    "timestamp" => strtotime($criadoEm) * 1000,
                    "localizacao" => (
                        $latitude !== null &&
                        $longitude !== null
                    )
                        ? "Compartilhada"
                        : "Não disponível"
                ]
            ]);


        case "attend_alert":

            needUser();

            $responsavelId = uid();
            $idAlerta = (int) ($d["id"] ?? 0);

            if ($idAlerta <= 0) {
                out(["ok" => false, "message" => "ID do alerta inválido."], 400);
            }

            // Só permite ao responsável vinculado assumir um alerta aberto.
            $stmt = $conn->prepare("
                UPDATE alerts a
                INNER JOIN responsible_links rl
                    ON rl.protected_user_id = a.user_id
                SET a.status = 'attended'
                WHERE a.id = ?
                  AND rl.responsible_user_id = ?
                  AND rl.status = 'active'
                  AND LOWER(a.status) IN ('open', 'aberto', 'aberta', 'pending', 'pendente', 'attended', 'atendido', 'atendida', 'em_atendimento')
            ");

            if (!$stmt) {
                throw new Exception($conn->error);
            }

            $stmt->bind_param("ii", $idAlerta, $responsavelId);
            $stmt->execute();
            $alteradas = $stmt->affected_rows;
            $stmt->close();

            if ($alteradas < 1) {
                // UPDATE pode afetar zero linhas quando o alerta já está atendido.
                // Confere vínculo e status para tornar o clique idempotente sem liberar alertas alheios.
                $check = $conn->prepare("
                    SELECT LOWER(a.status)
                    FROM alerts a
                    INNER JOIN responsible_links rl ON rl.protected_user_id = a.user_id
                    WHERE a.id = ? AND rl.responsible_user_id = ? AND rl.status = 'active'
                    LIMIT 1
                ");
                if (!$check)
                    throw new Exception($conn->error);
                $check->bind_param("ii", $idAlerta, $responsavelId);
                $check->execute();
                $check->bind_result($statusAtual);
                $jaAtendido = $check->fetch() && in_array($statusAtual, ['attended', 'atendido', 'atendida', 'em_atendimento'], true);
                $check->close();
                if (!$jaAtendido) {
                    out(["ok" => false, "message" => "O alerta não está mais disponível ou não pertence a uma pessoa vinculada a você."], 409);
                }
            }

            out([
                "ok" => true,
                "id" => $idAlerta,
                "status" => "attended",
                "message" => "Atendimento registrado no banco de dados."
            ]);



        case "resolve_alert":

            needUser();

            $idAlerta = (int) ($d["id"] ?? 0);
            $responsavelId = uid();

            if ($idAlerta <= 0) {
                out([
                    "ok" => false,
                    "message" => "ID do alerta inválido."
                ], 400);
            }

            // Encerra apenas um alerta de uma pessoa vinculada
            // ao responsável e que já esteja em atendimento.
            $stmt = $conn->prepare("
        UPDATE alerts a
        INNER JOIN responsible_links rl
            ON rl.protected_user_id = a.user_id
        SET a.status = 'encerrado'
        WHERE a.id = ?
          AND rl.responsible_user_id = ?
          AND rl.status = 'active'
          AND LOWER(TRIM(a.status)) IN (
              'attended',
              'atendido',
              'atendida',
              'em_atendimento'
          )
    ");

            if (!$stmt) {
                throw new Exception($conn->error);
            }

            $stmt->bind_param("ii", $idAlerta, $responsavelId);

            if (!$stmt->execute()) {
                $erro = $stmt->error;
                $stmt->close();
                throw new Exception("Erro ao encerrar atendimento: " . $erro);
            }

            $alteradas = $stmt->affected_rows;
            $stmt->close();

            // Se nenhuma linha foi alterada, verifica se o alerta
            // já estava encerrado e se pertence a uma pessoa vinculada.
            if ($alteradas < 1) {

                $check = $conn->prepare("
            SELECT LOWER(TRIM(a.status))
            FROM alerts a
            INNER JOIN responsible_links rl
                ON rl.protected_user_id = a.user_id
            WHERE a.id = ?
              AND rl.responsible_user_id = ?
              AND rl.status = 'active'
            LIMIT 1
        ");

                if (!$check) {
                    throw new Exception($conn->error);
                }

                $check->bind_param("ii", $idAlerta, $responsavelId);
                $check->execute();
                $check->bind_result($statusAtual);

                $encontrou = $check->fetch();
                $check->close();

                if (
                    !$encontrou ||
                    !in_array(
                        $statusAtual,
                        ['encerrado', 'encerrada', 'resolved', 'closed'],
                        true
                    )
                ) {
                    out([
                        "ok" => false,
                        "message" => "Não foi possível encerrar o alerta. Verifique se o atendimento foi confirmado."
                    ], 409);
                }
            }

            out([
                "ok" => true,
                "id" => $idAlerta,
                "status" => "encerrado",
                "message" => "Atendimento encerrado com sucesso."
            ]);

        /* =========================
           LOCALIZAÇÃO
        ========================= */
        case "location":

            needUser();

            $idUsuario = uid();
            $alertaId = (int) ($d["alerta_id"] ?? 0);
            $latitude = (float) ($d["latitude"] ?? 0);
            $longitude = (float) ($d["longitude"] ?? 0);

            // O SQL não possui uma tabela localizacoes.
            // Se houver um alerta informado, atualizamos a localização dele.
            if ($alertaId > 0) {
                $stmt = $conn->prepare("\n                    UPDATE alerts\n                    SET latitude = ?, longitude = ?\n                    WHERE id = ? AND user_id = ?\n                ");
                if (!$stmt) {
                    throw new Exception($conn->error);
                }

                $stmt->bind_param(
                    "ddii",
                    $latitude,
                    $longitude,
                    $alertaId,
                    $idUsuario
                );
                $stmt->execute();
                $stmt->close();

                out(["ok" => true]);
            }

            out([
                "ok" => false,
                "message" => "O banco atual não possui uma tabela própria para localizações."
            ], 422);


        /* =========================
           PERFIL
        ========================= */
        case "save_profile":

            needUser();

            $id = uid();
            $nome = trim($d["nome"] ?? "");
            $email = strtolower(trim($d["email"] ?? ""));
            $telefone = trim($d["telefone"] ?? "");

            if (!$nome || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                out([
                    "ok" => false,
                    "message" => "Nome ou e-mail inválido."
                ], 422);
            }

            $stmt = $conn->prepare("\n                UPDATE users\n                SET name = ?, email = ?, phone = ?\n                WHERE id = ?\n            ");
            if (!$stmt) {
                throw new Exception($conn->error);
            }

            $stmt->bind_param("sssi", $nome, $email, $telefone, $id);
            $stmt->execute();
            $stmt->close();

            $_SESSION["nome"] = $nome;

            out(["ok" => true]);


        /* =========================
          CHAT
       ========================= */
        case "chat":

            needUser();

            $usuarioId = uid();
            $modo = $_GET["mode"] ?? "get";


            /*
             * =====================================================
             * LOCALIZAR O USUÁRIO VINCULADO
             * =====================================================
             */

            $stmt = $conn->prepare("
        SELECT
            CASE
                WHEN protected_user_id = ?
                    THEN responsible_user_id
                ELSE protected_user_id
            END AS contato_id
        FROM responsible_links
        WHERE
            status = 'active'
            AND (
                protected_user_id = ?
                OR responsible_user_id = ?
            )
        LIMIT 1
    ");

            if (!$stmt) {
                throw new Exception($conn->error);
            }

            $stmt->bind_param(
                "iii",
                $usuarioId,
                $usuarioId,
                $usuarioId
            );

            $stmt->execute();
            $stmt->bind_result($contatoId);

            if (!$stmt->fetch()) {

                $stmt->close();

                out([
                    "ok" => false,
                    "message" => "Você não possui um usuário vinculado."
                ], 403);
            }

            $stmt->close();

            $contatoId = (int) $contatoId;


            /*
             * =====================================================
             * BUSCAR DADOS DO CONTATO
             * =====================================================
             */

            $stmt = $conn->prepare("
        SELECT
            id,
            name,
            type
        FROM users
        WHERE id = ?
        LIMIT 1
    ");

            if (!$stmt) {
                throw new Exception($conn->error);
            }

            $stmt->bind_param("i", $contatoId);
            $stmt->execute();

            $stmt->bind_result(
                $contatoIdBanco,
                $contatoNome,
                $contatoTipo
            );

            if (!$stmt->fetch()) {

                $stmt->close();

                out([
                    "ok" => false,
                    "message" => "Usuário vinculado não encontrado."
                ], 404);
            }

            $stmt->close();


            /*
             * =====================================================
             * ENVIAR MENSAGEM
             * =====================================================
             */

            if ($modo === "send") {

                $mensagem = trim($d["message"] ?? "");

                if ($mensagem === "") {

                    out([
                        "ok" => false,
                        "message" => "Digite uma mensagem."
                    ], 422);
                }

                if (mb_strlen($mensagem) > 500) {

                    out([
                        "ok" => false,
                        "message" => "A mensagem deve ter no máximo 500 caracteres."
                    ], 422);
                }


                /*
                 * Confirma que o vínculo continua ativo
                 */

                $stmt = $conn->prepare("
            SELECT id
            FROM responsible_links
            WHERE
                status = 'active'
                AND (
                    (
                        protected_user_id = ?
                        AND responsible_user_id = ?
                    )
                    OR
                    (
                        protected_user_id = ?
                        AND responsible_user_id = ?
                    )
                )
            LIMIT 1
        ");

                if (!$stmt) {
                    throw new Exception($conn->error);
                }

                $stmt->bind_param(
                    "iiii",
                    $usuarioId,
                    $contatoId,
                    $contatoId,
                    $usuarioId
                );

                $stmt->execute();
                $stmt->bind_result($vinculoId);

                if (!$stmt->fetch()) {

                    $stmt->close();

                    out([
                        "ok" => false,
                        "message" => "Esse usuário não está mais vinculado a você."
                    ], 403);
                }

                $stmt->close();


                /*
                 * Salvar mensagem
                 */

                $stmt = $conn->prepare("
            INSERT INTO messages
            (
                sender_id,
                receiver_id,
                message
            )
            VALUES (?, ?, ?)
        ");

                if (!$stmt) {
                    throw new Exception($conn->error);
                }

                $stmt->bind_param(
                    "iis",
                    $usuarioId,
                    $contatoId,
                    $mensagem
                );

                if (!$stmt->execute()) {

                    $erro = $stmt->error;
                    $stmt->close();

                    throw new Exception(
                        "Erro ao salvar mensagem: " . $erro
                    );
                }

                $mensagemId = $conn->insert_id;

                $stmt->close();

                out([
                    "ok" => true,
                    "message_id" => (int) $mensagemId
                ]);
            }


            /*
             * =====================================================
             * MARCAR MENSAGENS COMO LIDAS
             * =====================================================
             */

            if ($modo === "read") {

                $stmt = $conn->prepare("
            UPDATE messages
            SET
                is_read = 1,
                read_at = NOW()
            WHERE
                sender_id = ?
                AND receiver_id = ?
                AND is_read = 0
        ");

                if (!$stmt) {
                    throw new Exception($conn->error);
                }

                $stmt->bind_param(
                    "ii",
                    $contatoId,
                    $usuarioId
                );

                $stmt->execute();
                $stmt->close();

                out([
                    "ok" => true
                ]);
            }


            /*
             * =====================================================
             * CARREGAR HISTÓRICO
             * =====================================================
             */

            $stmt = $conn->prepare("
        SELECT
            m.id,
            m.sender_id,
            m.receiver_id,
            m.message,
            m.is_read,
            m.created_at,
            u.name AS sender_name
        FROM messages m
        INNER JOIN users u
            ON u.id = m.sender_id
        WHERE
            (
                m.sender_id = ?
                AND m.receiver_id = ?
            )
            OR
            (
                m.sender_id = ?
                AND m.receiver_id = ?
            )
        ORDER BY m.created_at ASC
        LIMIT 100
    ");

            if (!$stmt) {
                throw new Exception($conn->error);
            }

            $stmt->bind_param(
                "iiii",
                $usuarioId,
                $contatoId,
                $contatoId,
                $usuarioId
            );

            $stmt->execute();

            $stmt->bind_result(
                $mensagemId,
                $senderId,
                $receiverId,
                $texto,
                $lida,
                $criadoEm,
                $senderName
            );

            $mensagens = [];

            while ($stmt->fetch()) {

                $mensagens[] = [
                    "id" => (int) $mensagemId,
                    "sender_id" => (int) $senderId,
                    "receiver_id" => (int) $receiverId,
                    "message" => $texto,
                    "is_read" => (int) $lida,
                    "created_at" => $criadoEm,
                    "sender_name" => $senderName
                ];
            }

            $stmt->close();


            /*
             * =====================================================
             * MARCAR MENSAGENS RECEBIDAS COMO LIDAS
             * =====================================================
             */

            $stmt = $conn->prepare("
        UPDATE messages
        SET
            is_read = 1,
            read_at = NOW()
        WHERE
            sender_id = ?
            AND receiver_id = ?
            AND is_read = 0
    ");

            if (!$stmt) {
                throw new Exception($conn->error);
            }

            $stmt->bind_param(
                "ii",
                $contatoId,
                $usuarioId
            );

            $stmt->execute();
            $stmt->close();


            /*
             * =====================================================
             * RESPOSTA
             * =====================================================
             */

            out([
                "ok" => true,

                "usuario_id" => $usuarioId,

                "contato" => [
                    "id" => (int) $contatoIdBanco,
                    "nome" => $contatoNome,
                    "tipo" => $contatoTipo
                ],

                "messages" => $mensagens
            ]);

        /* =========================
           CONVITE
        ========================= */
        case "generate_invite":

            needUser();

            $id = uid();
            $codigo = strtoupper(substr(bin2hex(random_bytes(5)), 0, 8));

            $stmt = $conn->prepare("\n                UPDATE users\n                SET invite_code = ?\n                WHERE id = ?\n            ");
            if (!$stmt) {
                throw new Exception($conn->error);
            }

            $stmt->bind_param("si", $codigo, $id);
            $stmt->execute();
            $stmt->close();

            out([
                "ok" => true,
                "codigo" => $codigo
            ]);


        /* =========================
           ESTATÍSTICAS ADMIN
        ========================= */
        case "admin_stats":

            needAdmin();

            $stats = [];

            $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE type <> 'admin'");
            if (!$stmt)
                throw new Exception($conn->error);
            $stmt->execute();
            $stmt->bind_result($total);
            $stmt->fetch();
            $stmt->close();
            $stats["usuarios"] = (int) $total;

            $stmt = $conn->prepare("SELECT COUNT(*) FROM devices");
            if (!$stmt)
                throw new Exception($conn->error);
            $stmt->execute();
            $stmt->bind_result($total);
            $stmt->fetch();
            $stmt->close();
            $stats["dispositivos"] = (int) $total;

            $stmt = $conn->prepare("SELECT COUNT(*) FROM alerts");
            if (!$stmt)
                throw new Exception($conn->error);
            $stmt->execute();
            $stmt->bind_result($total);
            $stmt->fetch();
            $stmt->close();
            $stats["alertas"] = (int) $total;

            $stmt = $conn->prepare("SELECT COUNT(*) FROM alerts WHERE status = 'open'");
            if (!$stmt)
                throw new Exception($conn->error);
            $stmt->execute();
            $stmt->bind_result($total);
            $stmt->fetch();
            $stmt->close();
            $stats["ativos"] = (int) $total;

            $stmt = $conn->prepare("SELECT COUNT(*) FROM alerts WHERE status = 'resolved'");
            if (!$stmt)
                throw new Exception($conn->error);
            $stmt->execute();
            $stmt->bind_result($total);
            $stmt->fetch();
            $stmt->close();
            $stats["resolvidos"] = (int) $total;

            out([
                "ok" => true,
                "stats" => $stats
            ]);


        /* =========================
           ADMIN - USUÁRIOS
        ========================= */
        case "admin_users":

            needAdmin();

            $stmt = $conn->prepare("\n                SELECT id, name, email, phone, type, status, created_at\n                FROM users\n                WHERE type <> 'admin'\n                ORDER BY id DESC\n            ");
            if (!$stmt)
                throw new Exception($conn->error);

            $stmt->execute();
            $stmt->bind_result($id, $nome, $email, $telefone, $tipo, $status, $criado);

            $items = [];
            while ($stmt->fetch()) {
                $items[] = [
                    "id" => (int) $id,
                    "nome" => $nome,
                    "email" => $email,
                    "telefone" => $telefone,
                    "tipo" => $tipo,
                    "ativo" => in_array(strtolower((string)$status), ["active","ativo","ativa","1"], true) ? 1 : 0,
                    "criado_em" => $criado
                ];
            }
            $stmt->close();

            out([
                "ok" => true,
                "items" => $items
            ]);


        /* =========================
           ADMIN - ALERTAS
        ========================= */
        case "admin_alerts":

            needAdmin();

            $stmt = $conn->prepare("\n                SELECT\n                    a.id,\n                    a.type,\n                    a.message,\n                    a.status,\n                    a.latitude,\n                    a.longitude,\n                    a.created_at,\n                    u.name AS usuario\n                FROM alerts a\n                LEFT JOIN users u ON u.id = a.user_id\n                ORDER BY a.id DESC\n            ");
            if (!$stmt)
                throw new Exception($conn->error);

            $stmt->execute();
            $stmt->bind_result($id, $tipo, $mensagem, $status, $latitude, $longitude, $criado, $usuario);

            $items = [];
            while ($stmt->fetch()) {
                $items[] = [
                    "id" => (int) $id,
                    "tipo" => $tipo,
                    "titulo" => $mensagem,
                    "descricao" => $mensagem,
                    "status" => $status,
                    "latitude" => $latitude,
                    "longitude" => $longitude,
                    "data_inicio" => $criado,
                    "data_fim" => null,
                    "usuario" => $usuario
                ];
            }
            $stmt->close();

            out([
                "ok" => true,
                "items" => $items
            ]);


        /* =========================
           ADMIN - DISPOSITIVOS
        ========================= */
        case "admin_devices":

            needAdmin();

            $stmt = $conn->prepare("\n                SELECT d.id, d.user_id, d.name, d.device_code, d.status, d.last_seen, d.created_at,\n                       u.name AS usuario\n                FROM devices d\n                LEFT JOIN users u ON u.id = d.user_id\n                ORDER BY d.id DESC\n            ");
            if (!$stmt)
                throw new Exception($conn->error);

            $stmt->execute();
            $stmt->bind_result($id, $userId, $nome, $codigo, $status, $lastSeen, $criado, $usuario);

            $items = [];
            while ($stmt->fetch()) {
                $items[] = [
                    "id" => (int) $id,
                    "usuario_id" => (int) $userId,
                    "nome" => $nome,
                    "device_code" => $codigo,
                    "status" => $status,
                    "last_seen" => $lastSeen,
                    "criado_em" => $criado,
                    "usuario" => $usuario
                ];
            }
            $stmt->close();

            out([
                "ok" => true,
                "items" => $items
            ]);


        /* =========================
           ADMIN - CONTATOS
        ========================= */
        case "admin_contacts":

            needAdmin();

            $stmt = $conn->prepare("\n                SELECT c.id, c.user_id, c.name, c.phone, c.relationship, c.is_primary, c.created_at,\n                       u.name AS usuario\n                FROM emergency_contacts c\n                JOIN users u ON u.id = c.user_id\n                ORDER BY c.id DESC\n            ");
            if (!$stmt)
                throw new Exception($conn->error);

            $stmt->execute();
            $stmt->bind_result($id, $userId, $nome, $telefone, $relacao, $principal, $criado, $usuario);

            $items = [];
            while ($stmt->fetch()) {
                $items[] = [
                    "id" => (int) $id,
                    "usuario_id" => (int) $userId,
                    "nome" => $nome,
                    "telefone" => $telefone,
                    "relacao" => $relacao,
                    "principal" => (int) $principal,
                    "criado_em" => $criado,
                    "usuario" => $usuario
                ];
            }
            $stmt->close();

            out([
                "ok" => true,
                "items" => $items
            ]);


        /* =========================
           ADMIN - RELATÓRIO
        ========================= */
        case "admin_report":

            needAdmin();

            $stmt = $conn->prepare("\n                SELECT\n                    entry_date AS dia,\n                    mood AS tipo,\n                    COUNT(*) AS quantidade\n                FROM diary_entries\n                GROUP BY entry_date, mood\n                ORDER BY dia\n            ");
            if (!$stmt)
                throw new Exception($conn->error);

            $stmt->execute();
            $stmt->bind_result($dia, $tipo, $quantidade);

            $items = [];
            while ($stmt->fetch()) {
                $items[] = [
                    "dia" => $dia,
                    "tipo" => $tipo,
                    "quantidade" => (int) $quantidade
                ];
            }
            $stmt->close();

            out([
                "ok" => true,
                "items" => $items
            ]);

        case "responsible_alert_history":

            needUser();

            $responsavelId = uid();

            // Localiza a pessoa protegida vinculada
            $stmt = $conn->prepare("
        SELECT protected_user_id
        FROM responsible_links
        WHERE responsible_user_id = ?
          AND status = 'active'
        LIMIT 1
    ");

            if (!$stmt) {
                throw new Exception($conn->error);
            }

            $stmt->bind_param("i", $responsavelId);
            $stmt->execute();
            $stmt->bind_result($protegidoId);

            if (!$stmt->fetch()) {
                $stmt->close();

                out([
                    "ok" => true,
                    "alertas" => []
                ]);
            }

            $stmt->close();

            // Busca os 5 alertas mais recentes dessa pessoa
            $stmt = $conn->prepare("
        SELECT
            id,
            type,
            message,
            status,
            created_at
        FROM alerts
        WHERE user_id = ?
        ORDER BY created_at DESC, id DESC
        LIMIT 5
    ");

            if (!$stmt) {
                throw new Exception($conn->error);
            }

            $stmt->bind_param("i", $protegidoId);
            $stmt->execute();

            $stmt->bind_result(
                $alertaId,
                $tipo,
                $mensagem,
                $status,
                $criadoEm
            );

            $alertas = [];

            while ($stmt->fetch()) {
                $alertas[] = [
                    "id" => (int) $alertaId,
                    "tipo" => $tipo,
                    "mensagem" => $mensagem,
                    "status" => $status,
                    "created_at" => $criadoEm
                ];
            }

            $stmt->close();

            out([
                "ok" => true,
                "alertas" => $alertas
            ]);

            break;



        /* =========================
           ADMIN CRUD - ROTAS DO PAINEL
        ========================= */
        case "admin_create_user":
            needAdmin();
            $nome=trim($d["nome"]??""); $email=strtolower(trim($d["email"]??""));
            $telefone=trim($d["telefone"]??""); $tipo=$d["tipo"]??"protegida"; $senha=$d["senha"]??"";
            if($nome===""||!filter_var($email,FILTER_VALIDATE_EMAIL)||strlen($senha)<6||!in_array($tipo,["protegida","responsavel"],true))
                out(["ok"=>false,"message"=>"Confira nome, e-mail, tipo e senha (mínimo 6 caracteres)."],422);
            $st=$conn->prepare("SELECT id FROM users WHERE email=? LIMIT 1"); if(!$st)throw new Exception($conn->error);
            $st->bind_param("s",$email);$st->execute();$st->store_result();$exists=$st->num_rows>0;$st->close();
            if($exists)out(["ok"=>false,"message"=>"Este e-mail já está cadastrado."],409);
            $hash=password_hash($senha,PASSWORD_DEFAULT);
            $st=$conn->prepare("INSERT INTO users (type,name,email,phone,password_hash,status) VALUES (?,?,?,?,?,'active')");
            if(!$st)throw new Exception($conn->error);$st->bind_param("sssss",$tipo,$nome,$email,$telefone,$hash);
            if(!$st->execute())throw new Exception($st->error);$id=$conn->insert_id;$st->close();
            out(["ok"=>true,"id"=>(int)$id,"message"=>"Usuário cadastrado."]);

        case "admin_update_user":
            needAdmin();$id=(int)($d["id"]??0);$nome=trim($d["nome"]??"");$email=strtolower(trim($d["email"]??""));$telefone=trim($d["telefone"]??"");$tipo=$d["tipo"]??"";
            if($id<=0||$nome===""||!filter_var($email,FILTER_VALIDATE_EMAIL)||!in_array($tipo,["protegida","responsavel"],true))out(["ok"=>false,"message"=>"Dados do usuário inválidos."],422);
            $st=$conn->prepare("SELECT id FROM users WHERE email=? AND id<>? LIMIT 1");if(!$st)throw new Exception($conn->error);$st->bind_param("si",$email,$id);$st->execute();$st->store_result();$exists=$st->num_rows>0;$st->close();if($exists)out(["ok"=>false,"message"=>"Este e-mail já está em uso."],409);
            $st=$conn->prepare("UPDATE users SET name=?,email=?,phone=?,type=? WHERE id=? AND type<>'admin'");if(!$st)throw new Exception($conn->error);$st->bind_param("ssssi",$nome,$email,$telefone,$tipo,$id);$st->execute();$changed=$st->affected_rows;$st->close();
            out(["ok"=>true,"message"=>"Usuário atualizado."]);

        case "admin_toggle_user":
            needAdmin();$id=(int)($d["id"]??0);$active=!empty($d["ativo"])?1:0;$status=$active?"active":"inactive";
            $st=$conn->prepare("UPDATE users SET status=? WHERE id=? AND type<>'admin'");if(!$st)throw new Exception($conn->error);$st->bind_param("si",$status,$id);$st->execute();$st->close();out(["ok"=>true]);

        case "admin_delete_user":
            needAdmin();$id=(int)($d["id"]??0);if($id<=0||$id===uid())out(["ok"=>false,"message"=>"ID inválido ou não é permitido excluir a própria conta administrativa."],422);
            $st=$conn->prepare("SELECT type FROM users WHERE id=?");if(!$st)throw new Exception($conn->error);$st->bind_param("i",$id);$st->execute();$st->bind_result($type);if(!$st->fetch()){$st->close();out(["ok"=>false,"message"=>"Usuário não encontrado."],404);}$st->close();if($type==="admin")out(["ok"=>false,"message"=>"Não é permitido excluir uma conta administrativa por esta tela."],403);
            $conn->begin_transaction();try{
                foreach(["DELETE FROM messages WHERE sender_id=? OR receiver_id=?","DELETE FROM responsible_links WHERE protected_user_id=? OR responsible_user_id=?","DELETE FROM emergency_contacts WHERE user_id=?","DELETE FROM diary_entries WHERE user_id=?","DELETE FROM alerts WHERE user_id=?","DELETE FROM devices WHERE user_id=?","DELETE FROM settings WHERE user_id=?"] as $sql){
                    $st=$conn->prepare($sql);if(!$st)throw new Exception($conn->error);
                    if(substr_count($sql,"?")===2)$st->bind_param("ii",$id,$id);else $st->bind_param("i",$id);
                    $st->execute();$st->close();
                }
                $st=$conn->prepare("DELETE FROM users WHERE id=? AND type<>'admin'");if(!$st)throw new Exception($conn->error);$st->bind_param("i",$id);$st->execute();$st->close();$conn->commit();
            }catch(Throwable $e){$conn->rollback();throw $e;}out(["ok"=>true,"message"=>"Usuário e dados dependentes excluídos."]);

        case "admin_save_device":
            needAdmin();$id=(int)($d["id"]??0);$uidOwner=(int)($d["usuario_id"]??0);$nome=trim($d["nome"]??"");$code=trim($d["device_code"]??"");$status=$d["status"]??"offline";
            if($uidOwner<=0||$nome===""||$code===""||!in_array($status,["online","offline","connected","disconnected"],true))out(["ok"=>false,"message"=>"Confira os dados do dispositivo."],422);
            $st=$conn->prepare("SELECT id FROM users WHERE id=? AND type<>'admin'");if(!$st)throw new Exception($conn->error);$st->bind_param("i",$uidOwner);$st->execute();$st->store_result();$valid=$st->num_rows>0;$st->close();if(!$valid)out(["ok"=>false,"message"=>"Usuário proprietário não encontrado."],422);
            if($id>0){$st=$conn->prepare("UPDATE devices SET user_id=?,name=?,device_code=?,status=? WHERE id=?");if(!$st)throw new Exception($conn->error);$st->bind_param("isssi",$uidOwner,$nome,$code,$status,$id);}
            else{$st=$conn->prepare("INSERT INTO devices (user_id,name,device_code,status) VALUES (?,?,?,?)");if(!$st)throw new Exception($conn->error);$st->bind_param("isss",$uidOwner,$nome,$code,$status);}
            if(!$st->execute()){$err=$st->error;$st->close();out(["ok"=>false,"message"=>"Não foi possível salvar. Verifique se o código já existe.","detail"=>$err],409);}$newId=$id?:$conn->insert_id;$st->close();out(["ok"=>true,"id"=>(int)$newId]);

        case "admin_delete_device":
            needAdmin();$id=(int)($d["id"]??0);$st=$conn->prepare("DELETE FROM devices WHERE id=?");if(!$st)throw new Exception($conn->error);$st->bind_param("i",$id);$st->execute();$n=$st->affected_rows;$st->close();if(!$n)out(["ok"=>false,"message"=>"Dispositivo não encontrado."],404);out(["ok"=>true]);

        case "admin_save_contact":
            needAdmin();$id=(int)($d["id"]??0);$owner=(int)($d["usuario_id"]??0);$nome=trim($d["nome"]??"");$phone=trim($d["telefone"]??"");$rel=trim($d["relacao"]??"");$primary=!empty($d["principal"])?1:0;
            if($owner<=0||$nome===""||$phone==="")out(["ok"=>false,"message"=>"Informe usuário, nome e telefone."],422);
            $st=$conn->prepare("SELECT id FROM users WHERE id=? AND type<>'admin'");if(!$st)throw new Exception($conn->error);$st->bind_param("i",$owner);$st->execute();$st->store_result();$valid=$st->num_rows>0;$st->close();if(!$valid)out(["ok"=>false,"message"=>"Usuário proprietário não encontrado."],422);
            $conn->begin_transaction();try{
                if($primary){$st=$conn->prepare("UPDATE emergency_contacts SET is_primary=0 WHERE user_id=?");if(!$st)throw new Exception($conn->error);$st->bind_param("i",$owner);$st->execute();$st->close();}
                if($id>0){$st=$conn->prepare("UPDATE emergency_contacts SET user_id=?,name=?,phone=?,relationship=?,is_primary=? WHERE id=?");if(!$st)throw new Exception($conn->error);$st->bind_param("isssii",$owner,$nome,$phone,$rel,$primary,$id);}
                else{$st=$conn->prepare("INSERT INTO emergency_contacts (user_id,name,phone,relationship,is_primary) VALUES (?,?,?,?,?)");if(!$st)throw new Exception($conn->error);$st->bind_param("isssi",$owner,$nome,$phone,$rel,$primary);}
                if(!$st->execute())throw new Exception($st->error);$newId=$id?:$conn->insert_id;$st->close();$conn->commit();
            }catch(Throwable $e){$conn->rollback();throw $e;}out(["ok"=>true,"id"=>(int)$newId]);

        case "admin_delete_contact":
            needAdmin();$id=(int)($d["id"]??0);$st=$conn->prepare("DELETE FROM emergency_contacts WHERE id=?");if(!$st)throw new Exception($conn->error);$st->bind_param("i",$id);$st->execute();$n=$st->affected_rows;$st->close();if(!$n)out(["ok"=>false,"message"=>"Contato não encontrado."],404);out(["ok"=>true]);

        case "admin_update_alert":
            needAdmin();$id=(int)($d["id"]??0);$message=trim($d["message"]??"");$status=$d["status"]??"open";$lat=$d["latitude"]??null;$lng=$d["longitude"]??null;
            if($id<=0||$message===""||!in_array($status,["open","attended","encerrado"],true))out(["ok"=>false,"message"=>"Dados do alerta inválidos."],422);
            if(($lat===null)!==($lng===null))out(["ok"=>false,"message"=>"Informe as duas coordenadas ou nenhuma."],422);
            if($lat!==null&&(!is_numeric($lat)||!is_numeric($lng)||(float)$lat < -90||(float)$lat>90||(float)$lng < -180||(float)$lng>180))out(["ok"=>false,"message"=>"Coordenadas inválidas."],422);
            $lat=$lat===null?null:(float)$lat;$lng=$lng===null?null:(float)$lng;
            $st=$conn->prepare("UPDATE alerts SET message=?,status=?,latitude=?,longitude=? WHERE id=?");if(!$st)throw new Exception($conn->error);$st->bind_param("ssddi",$message,$status,$lat,$lng,$id);if(!$st->execute())throw new Exception($st->error);$n=$st->affected_rows;$st->close();out(["ok"=>true]);

        case "admin_delete_alert":
            needAdmin();$id=(int)($d["id"]??0);$st=$conn->prepare("DELETE FROM alerts WHERE id=?");if(!$st)throw new Exception($conn->error);$st->bind_param("i",$id);$st->execute();$n=$st->affected_rows;$st->close();if(!$n)out(["ok"=>false,"message"=>"Alerta não encontrado."],404);out(["ok"=>true]);

        case "change_password":
            needUser();$atual=$d["atual"]??$d["senhaAtual"]??$d["senha_atual"]??"";$nova=$d["nova"]??$d["novaSenha"]??$d["nova_senha"]??"";
            if(strlen($nova)<6)out(["ok"=>false,"message"=>"A nova senha deve ter pelo menos 6 caracteres."],422);
            $id=uid();$st=$conn->prepare("SELECT password_hash FROM users WHERE id=?");if(!$st)throw new Exception($conn->error);$st->bind_param("i",$id);$st->execute();$st->bind_result($hash);if(!$st->fetch()){$st->close();out(["ok"=>false,"message"=>"Usuário não encontrado."],404);}$st->close();
            if(!password_verify($atual,$hash))out(["ok"=>false,"message"=>"A senha atual está incorreta."],403);
            $novoHash=password_hash($nova,PASSWORD_DEFAULT);$st=$conn->prepare("UPDATE users SET password_hash=? WHERE id=?");if(!$st)throw new Exception($conn->error);$st->bind_param("si",$novoHash,$id);$st->execute();$st->close();out(["ok"=>true]);

        default:

            out([
                "ok" => false,
                "message" => "Ação não encontrada."
            ], 404);
    }

} catch (Throwable $e) {
    out([
        "ok" => false,
        "message" => "Erro no servidor.",
        "detail" => $e->getMessage(),
        "line" => $e->getLine()
    ], 500);
}