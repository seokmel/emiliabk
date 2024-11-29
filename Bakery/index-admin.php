<?php
session_start();




?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emilia's Bakery</title>
    <meta name="description" content="Pan artesanal, dulce, salado, croissants, y más. Horneado diariamente con ingredientes frescos.">
    
    <!-- Fuentes e Iconos -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="styles/style-home.css?v=1.0">
</head>
<body background="../media/bg-bakery.jpg">

<!-- Encabezado con menú de navegación y logo -->
<header class="main-header">
    <nav class="navbar">
        <div class="logo">
            <img src="media/logo-bakery.png" alt="Logo Panadería Emilia's Bakery" width="120">
        </div>
        <ul class="menu">
            <li><a href="index-admin.php"><i class="fas fa-home"></i> Inicio</a></li>
            <li><a href="productos-admin.php"><i class="fas fa-clipboard-list"></i> Gestión de Productos</a></li>

    <?php if (isset($_SESSION['email'])): ?>
        <li><a href="functions/logout.php" onclick="return confirmarSalida()" ><i class="fas fa-user"></i>Salir</a></li>
    <?php endif; ?>
        </ul>
    </nav>
    <div class="header-banner">
        <img src="media/image-bakery1.jpg" alt="Pan" class="banner-img">
        <style>
            @font-face {
            font-family: 'Louis George Cafe Bold Italic';
            src: url(styles/tipografia/Louis\ George\ Cafe\ Bold\ Italic.ttf) format('truetype');
            }
            .titulo1 {
                
                font-family: 'Louis George Cafe Bold Italic', sans-serif;
            }

            .titulo2 {
                font-family: 'Louis George Cafe Bold Italic', sans-serif;
            }
        </style>
        <h1 class="titulo1">Bienvenido a</h1>
        <h1 class="titulo2">Emilia's Bakery</h1>
        <p class="slogan">Administrador</p>
    </div>
</header>

<section class="servicios">
    <h2>Nuestros Servicios</h2>
    <div class="servicios-container">
        <div class="servicio">
            <i class="fas fa-birthday-cake"></i>
            <h3>Pasteles Personalizados</h3>
            <p>Ofrecemos pasteles personalizados para toda ocasión, hechos con ingredientes frescos y sabores únicos.</p>
        </div>
        <div class="servicio">
            <i class="fas fa-truck"></i>
            <h3>Entrega a Domicilio</h3>
            <p>Recibe nuestros productos frescos directamente en la puerta de tu casa con nuestro servicio de entrega a domicilio.</p>
        </div>
        <div class="servicio">
            <i class="fas fa-shopping-bag"></i>
            <h3>Pedidos Especiales</h3>
            <p>Haz tus pedidos especiales en línea o por teléfono, y nosotros los tendremos listos para cuando los necesites.</p>
        </div>
    </div>
</section>

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
<script src="scripts/salir.js" defer></script>
</body>
</html>