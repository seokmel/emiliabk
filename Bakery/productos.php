<?php
session_start();

// Verificar si el usuario no ha iniciado sesión

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería - Emilia's Bakery</title>
    <meta name="description" content="Galería de productos frescos y deliciosos de Emilia's Bakery.">
    
    <!-- Fuentes e Iconos -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style-home.css?v=1.0">
</head>
<body>

<!-- Encabezado con menú de navegación y logo -->
<header class="main-header">
    <nav class="navbar">
    <div class="menu-toggle" onclick="toggleMenu()">
        <i class="fas fa-bars"></i>
    </div>
        <div class="logo">
            <img src="media/logo-bakery.png" alt="Logo Panadería Emilia's Bakery" width="120">
            <h1>Nuestros Productos</h1>
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
    <h2>Productos</h2>
    <br>
    <div class="productos-container">
        <!-- pasteles-->
        <div class="producto">
            <a href="pasteles.php" class="producto-link">
                <img src="media/pasteles.png" alt="Garibaldi" class="producto-img">
                <h3>Pasteles</h3>
                <p>Descubre nuestra irresistible selección de pasteles recién horneados, perfectos para cualquier ocasión.</p>
            </a>
        </div>
        <!--panes-->
        <div class="producto">
            <a href="panes.php" class="producto-link">
                <img src="media/concha-choco.jpg" alt="Concha de Chocolate" class="producto-img">
                <h3>Panes</h3>
                <p>Descubre nuestros irresistibles panes recién horneados, ¡perfectos para cualquier ocasión!</p>
            </a>
        </div>
        <!-- galletas -->
        <div class="producto">
            <a href="galletas.php" class="producto-link">
                <img src="media/galletas.jpeg" alt="Croissant" class="producto-img">
                <h3>Galletas</h3>
                <p>Descubre nuestras irresistibles galletas, ¡perfectas para cualquier antojo!</p>
            </a>
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
        margin-right: 20px; /* Espaciado entre logo y título */
    }

    h1 {
        font-size: 2.5em;
        color: #ffffff;
        margin: 0; /* Sin margen para alinear correctamente */
    }

    .galeria {
        background-color: #ffffff;
        padding: 50px 20px;
        text-align: center;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        margin: 20px auto;
        max-width: 1200px;
    }

    .galeria-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    .galeria-item {
        width: 23%;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .galeria-item:hover {
        transform: scale(1.05);
        box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
    }

    .galeria-item img {
        width: 100%;
        height: auto;
        display: block;
    }

    @media (max-width: 768px) {
        .galeria-item {
            width: 46%;
        }
    }

    @media (max-width: 480px) {
        .galeria-item {
            width: 90%;
        }
    }
</style>

</body>
</html>
