<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Crear cuenta - CUT</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="page small">
    <div class="left">
      <img src="imagenes/logo_cut.png" alt="CUT logo" class="logo">
    </div>

    <div class="right">
      <div class="card">
        <h2 class="title">CREAR CUENTA</h2>

        <?php
        if (session_status() === PHP_SESSION_NONE) { @session_start(); }
        if (!empty($_SESSION['error'])) {
            echo '<div class="msg error">'.htmlspecialchars($_SESSION['error']).'</div>';
            unset($_SESSION['error']);
        }
        ?>

        <form action="../backend/register.php" method="post" class="form">
          <label class="field">
            <span class="icon">👤</span>
            <input name="username" type="text" placeholder="Usuario" required>
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
    <script>
  // Mostrar / ocultar contraseña
  document.getElementById('toggle').addEventListener('click', function(){
    const pwd = document.getElementById('pwd');
    pwd.type = (pwd.type === 'password') ? 'text' : 'password';
  });
</script>
  </div>
</body>
</html>
