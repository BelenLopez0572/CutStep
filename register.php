<?php
// Iniciar sesión (si no está iniciada) para manejar mensajes de error
if (session_status() === PHP_SESSION_NONE) { session_start(); }
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Crear cuenta - CUT</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="page">
        <div class="right">
            <div class="card">
                <div class="logo-container"> 
                    <img src="/imagenes/CUTstep.png" alt="CUT logo" class="logo">
                </div>
                
                <h2 class="title">CREAR CUENTA</h2>

                <?php
                // Muestra mensajes de error de la sesión
                if (!empty($_SESSION['error'])) {
                    echo '<div class="msg error">'.htmlspecialchars($_SESSION['error']).'</div>';
                    unset($_SESSION['error']);
                }
                ?>

                <form action="backend/register.php" method="post" class="form">
                    <label class="field">
                        <span class="icon">👤</span>
                        <input name="username" type="text" placeholder="Usuario (correo)" required>
                    </label>

                    <label class="field">
                        <span class="icon">🔒</span>
                        <input id="pwd" name="password" type="password" placeholder="Contraseña" required>
                        <button type="button" id="toggle" class="eye" aria-label="Mostrar contraseña">👁️</button>
                    </label>

                    <button class="btn" type="submit">Crear cuenta</button>
                </form>
                
                <a class="link" href="index.php">Volver al inicio</a>
            </div>
        </div>
    </div>
    
    <script>
    // Mostrar / ocultar contraseña
    document.getElementById('toggle').addEventListener('click', function(){
        const pwd = document.getElementById('pwd');
        const icon = this;
        
        if (pwd.type === 'password') {
            pwd.type = 'text';
            icon.textContent = '🔒';
        } else {
            pwd.type = 'password';
            icon.textContent = '👁️';
        }
    });

    // Validación de email (Asume que el campo 'username' es el email)
    document.querySelector("form").addEventListener("submit", function(event) {
        const emailInput = document.querySelector("input[name='username']");
        const email = emailInput.value.trim();
        const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const dominiosValidos = ["gmail.com", "hotmail.com", "outlook.com", "yahoo.com"];
        const dominio = email.split("@")[1];

        if (!regexEmail.test(email)) {
            event.preventDefault();
            mostrarError("Ingresa un correo electrónico válido.");
            return;
        }
        if (!dominiosValidos.includes(dominio)) {
            event.preventDefault();
            mostrarError("El correo debe ser Gmail, Hotmail, Outlook o Yahoo.");
            return;
        }
        limpiarErrores();
    });

    function mostrarError(msg) {
        let contenedor = document.querySelector(".msg.error");
        if (!contenedor) {
            contenedor = document.createElement("div");
            contenedor.className = "msg error";
            document.querySelector(".card").insertBefore(contenedor, document.querySelector(".form"));
        }
        contenedor.textContent = msg;
    }
    
    function limpiarErrores() {
        const contenedor = document.querySelector(".msg.error");
        if (contenedor) {
            contenedor.remove();
        }
    }
    </script>
</body>
</html>