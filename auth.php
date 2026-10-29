<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once __DIR__ . "/db.php";


function usuarioAtual()
{
    global $conn;

    if (empty($_SESSION["usuario_id"])) {
        return null;
    }

    $id = (int) $_SESSION["usuario_id"];

    $stmt = $conn->prepare("
        SELECT id, name, email, phone, password_hash, type, status, account_status
        FROM users
        WHERE id = ?
        LIMIT 1
    ");

    if (!$stmt) {
        return null;
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();

    $stmt->bind_result(
        $idBanco,
        $nome,
        $email,
        $telefone,
        $senha,
        $tipo,
        $status,
        $statusConta
    );

    if (!$stmt->fetch()) {
        $stmt->close();
        return null;
    }

    $stmt->close();

    // A coluna "status" existente contém valores de perfil/legado.
    // A ativação da conta é controlada separadamente por "account_status".
    if (!in_array(strtolower(trim((string) $statusConta)), ["active", "ativo", "ativa", "1"], true)) {
        $_SESSION = [];
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), "", time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
        }
        session_destroy();
        return null;
    }

    return [
        "id" => $idBanco,
        "nome" => $nome,
        "email" => $email,
        "telefone" => $telefone,
        "senha" => $senha,
        "tipo" => $tipo,
        "status" => $status,
        "account_status" => $statusConta
    ];
}


function exigirLogin()
{
    $usuario = usuarioAtual();

    if (!$usuario) {
        header("Location: login.php");
        exit;
    }

    return $usuario;
}


function exigirAdmin()
{
    $usuario = usuarioAtual();

    if (!$usuario || $usuario["tipo"] !== "admin") {
        header("Location: login-admin.php");
        exit;
    }

    return $usuario;
}

?>