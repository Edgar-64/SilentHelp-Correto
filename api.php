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

        /* =========================
           CADASTRO
        ========================= */
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

            if (!in_array($tipo, ["protegida", "responsavel", "admin"], true)) {
                $tipo = "protegida";
            }

            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
            if (!$stmt) {
                throw new Exception($conn->error);
            }

            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($idExistente);
            $existe = $stmt->fetch();
            $stmt->close();

            if ($existe) {
                out([
                    "ok" => false,
                    "message" => "Este e-mail já está cadastrado."
                ], 409);
            }

            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            $codigoConvite = trim($d["codigoConvite"] ?? "");

            if ($codigoConvite === "") {
                $codigoConvite = null;
            }
            $contatoEmergencia = trim($d["contatoEmergencia"] ?? "");
            $telefoneEmergencia = trim($d["telefoneEmergencia"] ?? "");
            $relacao = trim($d["relacao"] ?? "");

            $stmt = $conn->prepare("\n                INSERT INTO users\n                (type, name, email, phone, password_hash, invite_code, emergency_contact, emergency_phone, relationship)\n                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)\n            ");
            if (!$stmt) {
                throw new Exception($conn->error);
            }

            // O código de convite pertence ao responsável/protegida no banco atual.
            // Guardamos o valor informado sem criar uma tabela que não existe no SQL.
            $stmt->bind_param(
                "sssssssss",
                $tipo,
                $nome,
                $email,
                $telefone,
                $senhaHash,
                $codigoConvite,
                $contatoEmergencia,
                $telefoneEmergencia,
                $relacao
            );

            if (!$stmt->execute()) {
                throw new Exception(
                    "Erro ao cadastrar usuário: " . $stmt->error
                );
            }

            $id = $conn->insert_id;

            if (!$id) {
                throw new Exception(
                    "Usuário foi inserido, mas o ID retornado pelo banco foi 0."
                );
            }

            $stmt->close();

            $_SESSION["usuario_id"] = $id;
            $_SESSION["usuario_tipo"] = $tipo;
            $_SESSION["nome"] = $nome;

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
             * =====================================================
             * VERIFICAR SE EXISTE RESPONSÁVEL VINCULADO
             * =====================================================
             */

            $stmt = $conn->prepare("
        SELECT id
        FROM responsible_links
        WHERE
            protected_user_id = ?
            AND status = 'active'
        LIMIT 1
    ");

            if (!$stmt) {
                throw new Exception($conn->error);
            }

            $stmt->bind_param(
                "i",
                $idUsuario
            );

            $stmt->execute();
            $stmt->bind_result($vinculoId);

            if (!$stmt->fetch()) {

                $stmt->close();

                out([
                    "ok" => false,
                    "message" => "Você não possui um responsável vinculado."
                ], 403);
            }

            $stmt->close();


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
            AND a.status = 'open'

        ORDER BY a.id DESC

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


        case "resolve_alert":

            needUser();

            $idAlerta = (int) ($d["id"] ?? 0);
            $idUsuario = uid();

            $stmt = $conn->prepare("\n                UPDATE alerts\n                SET status = 'resolved'\n                WHERE id = ?\n                AND user_id = ?\n            ");
            if (!$stmt) {
                throw new Exception($conn->error);
            }

            $stmt->bind_param("ii", $idAlerta, $idUsuario);
            $stmt->execute();
            $stmt->close();

            out(["ok" => true]);


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
                    "ativo" => $status === "admin" ? 1 : 0,
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