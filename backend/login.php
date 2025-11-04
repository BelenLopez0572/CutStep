<?php
session_start();
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? '');
    $password = trim($_POST["password"] ?? '');

    if ($username === '' || $password === '') {
        $_SESSION["error"] = "Por favor ingresa usuario y contraseña.";
        header("Location: ../fronted/index.php");
        exit();
    }

    $stmt = $mysqli->prepare("SELECT id, password FROM usuarios WHERE username = ?");
    if (!$stmt) {
        $_SESSION['error'] = "Error en la consulta: " . $mysqli->error;
        header("Location: ../fronted/index.php");
        exit();
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // password en DB es el hash
        if (password_verify($password, $row["password"])) {
            session_regenerate_id(true);
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["username"] = $username;
            header("Location: ../fronted/menu.html");
            exit();
        } else {
            $_SESSION["error"] = "Contraseña incorrecta.";
            header("Location: ../fronted/index.php");
            exit();
        }
    } else {
        $_SESSION["error"] = "El usuario no existe.";
        header("Location: ../fronted/index.php");
        exit();
    }

    $stmt->close();
    $mysqli->close();
}
?>
