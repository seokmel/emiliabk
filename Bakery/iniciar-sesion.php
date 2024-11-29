<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Emilia's Bakery Sesión</title>
  <link rel="icon" href="img/lo.ico">
	<link rel="stylesheet" type="text/css" href="styles/style-sesion.css?v=1.0">
  
</head>
<body>
	<div class="login-box">
      <img src="media/logo-bakery.png" class="avatar" alt="Avatar Image">
      <h1>Inicio de sesión</h1>

      <form action="functions/sesion.php" method="POST">
        <!-- USUARIO INPUT -->
        <label for="username">Email</label>
        <input type="email" placeholder="Ingresa tu email" name="email" autocomplete="off" required autofocus></input>
        <!-- CONTRASEÑA INPUT -->
        <label for="password">Contraseña</label>
        <input type="password" placeholder="Ingresa tu contraseña" name="password" required></input>
        <input type="submit" name="enviar" value="Ingresar"></input>
        <a href="crear-cuenta.php">Crear una cuenta</a>
      </form>

    </div>
  </body>
</html>