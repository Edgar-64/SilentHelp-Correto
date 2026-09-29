<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once __DIR__ . "/db.php";

function usuarioAtual() {

    global $conn;

    if (empty($_SESSION["usuario_id"])) {
        return null;
    }

    $id = $_SESSION["usuario_id"];

    $stmt = $conn->prepare("
        SELECT id, nome, email, telefone, tipo, ativo
        FROM usuarios
        WHERE id = ?
        LIMIT 1
    ");

    $stmt->bind_param("i", $id);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc();

    if (!$usuario || !$usuario["ativo"]) {
        return null;
    }

    return $usuario;
}

function exigirLogin() {

    $usuario = usuarioAtual();

    if (!$usuario) {
        header("Location: login.php");
        exit;
    }

    return $usuario;
}

function exigirAdmin() {

    $usuario = usuarioAtual();

    if (!$usuario || $usuario["tipo"] !== "admin") {
        header("Location: login-admin.php");
        exit;
    }

    return $usuario;
}
?>
