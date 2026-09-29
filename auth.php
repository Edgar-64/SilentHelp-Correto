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
        SELECT id, name, email, phone, password_hash, type, status
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
        $status
    );

    if (!$stmt->fetch()) {
        $stmt->close();
        return null;
    }

    $stmt->close();

    if ($status !== "active") {
        return null;
    }

    return [
        "id" => $idBanco,
        "nome" => $nome,
        "email" => $email,
        "telefone" => $telefone,
        "senha" => $senha,
        "tipo" => $tipo,
        "status" => $status
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