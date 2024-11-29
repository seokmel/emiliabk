<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Emilia's Bakery Sesión</title>
  <link rel="icon" href="img/lo.ico">
	<link rel="stylesheet" type="text/css" href="styles/style-newsesion.css?v=1.0">
  
</head>
<body>
	<div class="login-box">
      <h1>Crear cuenta</h1>

      <form action="functions/newsesion.php" method="POST">
        <!-- USUARIO INPUT -->
        <label for="username">Nombre</label>
        <input type="text" placeholder="Ingresa tu nombre" name="nombres" autocomplete="off" required></input>
        <br><br><br>
        <label for="username">Apellido Paterno</label>
        <input type="text" placeholder="Ingresa tu apellido" name="pat_apellido" autocomplete="off" required></input>
        <br><br><br>
        <label for="username">Apellido Materno</label>
        <input type="text" placeholder="Ingresa tu apellido" name="mat_apellido" autocomplete="off" required></input>
        <br><br><br>
        <label for="username">Teléfono</label>
        <input type="tel" placeholder="Ingresa tu teléfono" name="telefono" pattern="[0-9]+" autocomplete="off" required></input>
        <br><br><br>
        <label for="username">Email</label>
        <input type="email" placeholder="Ingresa tu email" name="email" autocomplete="off" required></input>
        <!-- CONTRASEÑA INPUT -->
        <br><br><br>
        <label for="password">Contraseña</label>
        <input type="password" placeholder="Ingresa tu contraseña" name="password" required></input>
        <br><br><br>
        <label for="password">Confirmar contraseña</label>
        <input type="password" placeholder="Repita contraseña" name="repetir" required></input>

        <input type="submit" name="enviar" value="Ingresar"></input>
        <a href="iniciar-sesion.php">Ya tengo cuenta</a>
      </form>

    </div>
  </body>
</html>
 

  

