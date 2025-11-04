<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once "db.php"; // debe crear $mysqli (o ajusta según tu db.php)

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? '');
    $password = trim($_POST["password"] ?? '');

    // Validar campos vacíos
    if ($username === '' || $password === '') {
        $_SESSION["error"] = "Todos los campos son obligatorios.";
        header("Location: ../fronteded/register.php");
        exit();
    }

    // Validar longitud 
    if (strlen($password) > 255) {
        $_SESSION["error"] = "La contraseña es demasiado larga.";
        header("Location: ../fronted/register.php");
        exit();
    }

    // Verificar si ya existe el usuario
    $check = $mysqli->prepare("SELECT id FROM usuarios WHERE username = ?");
    if (!$check) {
        $_SESSION['error'] = "Error en la consulta: " . $mysqli->error;
        header("Location: ../fronted/register.php");
        exit();
    }
    $check->bind_param("s", $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $_SESSION["error"] = "El nombre de usuario ya existe.";
        header("Location: ../fronted/register.php");
        exit();
    }
    $check->close();

    // Hashear la contraseña antes de guardar
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    

    // Insertar nuevo usuario (usar el hash)
    $stmt = $mysqli->prepare("INSERT INTO usuarios (username, password) VALUES (?, ?)");
    if (!$stmt) {
        $_SESSION['error'] = "Error en la inserción: " . $mysqli->error;
        header("Location: ../fronted/register.php");
        exit();
    }
    $stmt->bind_param("ss", $username, $hashedPassword);

    if ($stmt->execute()) {
        $_SESSION["success"] = "Cuenta creada con éxito. Inicia sesión.";
        header("Location: ../fronted/index.php");
        exit();
    } else {
        $_SESSION["error"] = "Error al registrar usuario: " . $mysqli->error;
        header("Location: ../fronted/register.php");
        exit();
    }

    $stmt->close();
    $mysqli->close();
}
?>
