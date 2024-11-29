<?php
session_start();
include('functions/conexion.php');

if (!isset($_SESSION['id_usuario'])) {
    header("Location: iniciar-sesion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Datos</title>
     <!-- Fuentes e Iconos -->
     <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="styles/style-home.css?v=1.0">
</head>
<body>
<header class="main-header">
    <nav class="navbar">
    <div class="menu-toggle" onclick="toggleMenu()">
        <i class="fas fa-bars"></i>
    </div>
        <div class="logo">
            <img src="media/logo-bakery.png" alt="Logo Panadería Emilia's Bakery" width="120">
            <h1>Datos del Usuario</h1>
        </div>
        <ul class="menu">
            <li><a href="index.php"><i class="fas fa-home"></i> Inicio</a></li>
            <li><a href="productos.php"><i class="fas fa-images"></i> Productos</a></li>

    <?php if (isset($_SESSION['email'])): ?>
        <li><a href="../Bakery/datos.php"><i class="fas fa-user"></i> Cuenta</a></li>
       
    <?php else: ?>
        <li><a href="iniciar-sesion.php"><i class="fas fa-user"></i> Cuenta</a></li>
    <?php endif; ?>

            <li><a href="cart.php"><i class="fas fa-shopping-cart"></i> Carrito</a></li>
            <li><a href="contacto.php"><i class="fas fa-envelope"></i> Contacto</a></li>
        </ul>
    </nav>
</header>

<section class="productos-destacados">
<div class="productos-container">
<div class="producto">

<form action="functions/actuali.php" method="POST">
    <label for="nombres">Nombre(s):</label> 
    <br>
    <input type="text" name="nombres"  value="<?php echo $_SESSION['nombres']; ?>" required>
    <br>

    <label for="pat_apellido">Apellido Paterno:</label>
    <br>
    <input type="text" name="pat_apellido" value="<?php echo $_SESSION['pat_apellido']; ?>" required>
    <br>
    <label for="mat_apellido">Apellido Materno:</label>
    <br>
    <input type="text" name="mat_apellido" value="<?php echo $_SESSION['mat_apellido']; ?>" required>
    <br>
    <label for="telefono">Teléfono:</label>
    <br>
    <input type="text" name="telefono"  value="<?php echo $_SESSION['telefono']; ?>" required>
    <br>
    <label for="email">Email:</label>
    <br>
    <input type="email" name="email"  value="<?php echo $_SESSION['email']; ?>" required>
    <br> <br>
    <a href="datos.php">Cancelar</a>
    <button type="submit">Actualizar</button>
</form>
    </div>
  </div>
</section>
<script>
    function toggleMenu() {
        document.querySelector('.menu').classList.toggle('show');
    }
</script>


    <!-- Pie de página -->
<footer>
    <div class="footer-content">
        <div class="footer-logo">
            <img src="media/logo-bakery.png" alt="Logo Panadería Emilia's Bakery" width="100">
        </div>
        <div class="footer-contacto">
            <p>Calle Paseo de Las Lilas 92, CDMX</p>
            <p>Teléfono: +52 55 3930 6638</p>
            <p>Horario: Lunes a Jueves 9:30 - 19:00 | Viernes 9:30 - 17:00 | Sábado 10:00 - 15:00</p>
        </div>
        <div class="footer-links">
            <a href="#">Aviso de Privacidad</a> | 
            <a href="#">Política de Envío</a> | 
            <a href="#">Términos y Condiciones</a>
        </div>
        <div class="footer-social">
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
        <p>© 2024 Panadería Emilia's Bakery</p>
    </div>
</footer>
<style>
    body {
        font-family: 'Montserrat', sans-serif;
    }

    .logo {
        display: flex;
        align-items: center;
    }

    .logo img {
        width: 120px;
        margin-right: 20px; 
    }

    h1 {
        font-size: 2.5em;
        color: #ffffff;
        margin: 0; /* Sin margen para alinear correctamente */
    }
    .producto a{
    display: inline-block; 
    padding: 10px 20px; 
    background-color: #bd8853; 
    color: white; 
    text-decoration: none; 
    margin: 10px; /* Espacio entre botones */
    } 
    button{
    font-family: 'Montserrat', sans-serif;
    display: inline-block; /* Hacer que el enlace se comporte como un bloque en línea */
    padding: 13px 22px; 
    background-color: #bd8853; 
    border: none;
    color: white; 
    text-decoration: none; 
    margin: 10px; /* Espacio entre botones */
    } 
    .button:hover {
    background-color: #bc6c25;
    }
    .producto a:hover {
    background-color: #bc6c25;
    }  
    </style>
</body>
</html>
