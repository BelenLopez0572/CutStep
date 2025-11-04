<?php
// Iniciar sesión para mostrar mensajes de error o éxito
session_start();
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Inicio de sesión - CUT</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="page">
    <!-- Lado izquierdo con logo -->
    <div class="left">
      <img src="imagenes/logo_cut.png" alt="CUT logo" class="logo">
    </div>

    <!-- Lado derecho con formulario -->
    <div class="right">
      <div class="card">
        <h2 class="title">INICIO DE SESIÓN</h2>

        <!-- Mostrar mensajes de sesión -->
        <?php if (!empty($_SESSION['error'])): ?>
          <div class="msg error">
            <?= htmlspecialchars($_SESSION['error']) ?>
          </div>
          <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (!empty($_SESSION['success'])): ?>
          <div class="msg success">
            <?= htmlspecialchars($_SESSION['success']) ?>
          </div>
          <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <!-- Formulario de login -->
        <form action="../backend/login.php" method="post" class="form">
          <label class="field">
            <span class="icon">👤</span>
            <input name="username" type="text" placeholder="Correo" required>
          </label>

          <label class="field">
            <span class="icon">🔒</span>
            <input id="pwd" name="password" type="password" placeholder="Contraseña" required>
            <button type="button" id="toggle" class="eye" aria-label="Mostrar contraseña">👁️</button>
          </label>

          <button class="btn" type="submit">Ingresar</button>
        </form>

       <a class="link" href="register.php">Crear una cuenta</a>
    </div>
  </div>

<script>
  // Mostrar / ocultar contraseña
  document.getElementById('toggle').addEventListener('click', function(){
    const pwd = document.getElementById('pwd');
    pwd.type = (pwd.type === 'password') ? 'text' : 'password';
  });
</script>
</body>
</html>
