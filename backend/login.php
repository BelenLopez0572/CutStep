<?php
session_start();

$email = $_POST["username"] ?? "";
$pass  = $_POST["password"] ?? "";

// Validación de email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "Correo inválido.";
    header("Location: ../index.php");
    exit;
}

$dominios_validos = ["gmail.com", "hotmail.com", "outlook.com", "yahoo.com"];
$dominio = explode("@", $email)[1];

if (!in_array($dominio, $dominios_validos)) {
    $_SESSION['error'] = "Solo Gmail, Hotmail, Outlook o Yahoo.";
    header("Location: ../index.php");
    exit;
}

// Aceptamos cualquier usuario y contraseña
$_SESSION['success'] = "Bienvenido: $email";
header("Location: ../menu.html");
exit;
?>