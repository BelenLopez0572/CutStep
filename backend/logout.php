<?php
<<<<<<< HEAD
// backend/logout.php

// Iniciar sesión
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Si se usa cookie de sesión, también hay que borrarla
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruir la sesión
session_destroy();

// Redirigir al inicio de sesión (index.php)
header("Location: ../index.php");
exit();
?>
=======
// back/logout.php
session_start();
$_SESSION = [];
session_destroy();
header('Location: ../front/index.html');
exit;
>>>>>>> 87436fbef9cf013795a14a149f771ab25f61f80a
