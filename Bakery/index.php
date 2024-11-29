<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emilia's Bakery</title> 
    <!-- Fuentes e Iconos -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="styles/style-home.css?v=1.0">
</head>
<body background="media/bg-bakery.jpg">

<!-- Encabezado con menú de navegación y logo -->
<header class="main-header">
    <nav class="navbar">

    <div class="menu-toggle" onclick="toggleMenu()">
        <i class="fas fa-bars"></i>
    </div>

        <div class="logo">
            <img src="media/logo-bakery.png" alt="Logo Panadería Emilia's Bakery" width="120">
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
    <div class="header-banner">
        <img src="media/image-bakery1.jpg" alt="Pan" class="banner-img">
        <style>
            @font-face {
            font-family: 'Louis George Cafe Bold Italic';
            src: url(./styles/tipografia/Louis\ George\ Cafe\ Bold\ Italic.ttf) format('truetype');
            }
            .titulo1 {
                
                font-family: 'Louis George Cafe Bold Italic', sans-serif;
            }

            .titulo2 {
                font-family: 'Louis George Cafe Bold Italic', sans-serif;
            }
        </style>
        <h1 class="titulo1">Bienvenidos a</h1>
        <h1 class="titulo2">Emilia's Bakery</h1>
        <p class="slogan">"El sabor del pan recién horneado, en cada mordida"</p>
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


<!-- Sección de productos destacados -->
 
    <div class="productos-destacados">
        <h2>Nuestra Sucursal</h2>
        <p class="map-description">Visítanos en nuestra sucursal. ¡Esperamos verte pronto!</p>
        <div class="mapa-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4292.094677338652!2d-116.82331329984582!3d32.46200750793063!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80d93e743f2e3bd7%3A0xbf19e069ae61d678!2sUniversidad%20Tecnol%C3%B3gica%20de%20Tijuana!5e0!3m2!1ses-419!2smx!4v1731602215684!5m2!1ses-419!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <a href="https://maps.app.goo.gl/wZZfi8ai7LFPyGkQA" target="_blank" class="map-button">Ver en Google Maps</a>
    </div>

<script>
    function toggleMenu() {
        document.querySelector('.menu').classList.toggle('show');
    }
</script>

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
.productos-destacados {
    text-align: center;
    margin-top: 0;
    padding-top: 0;
}

.productos-destacados h2 {
    font-size: 2em;
    color: #6b705c; /* Color del título */
    margin-bottom: 20px;
    font-weight: bold;
    text-align: center; /* Centra todo el contenido dentro del div */
}

.mapa-container {
    display: flex;
    justify-content: center; /* Centra el iframe dentro de su contenedor */
    align-items: center;
    margin-top: 30px; /* Espaciado superior, puedes ajustar este valor */
    padding: 20px;
    background-color:#fdfdfd; /* Fondo suave */
    border-radius: 15px; /* Bordes redondeados */
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Sombra para darle un efecto flotante */
    max-width: 700px;
    margin: 20px auto;
}

iframe {
    border-radius: 10px;
    max-width: 800px; /* Hace que el mapa sea responsivo */
    height: 300px;
}

.map-button {
    display: inline-block;
    margin-top: 15px;
    padding: 18px 20px;
    background-color: #d8b28c; /* Color del botón */
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    transition: background-color 0.3s ease;
    margin-bottom: 40px;
}

.map-button:hover {
    background-color: #d4a373; /* Color del botón en hover */
}

.map-description {
    font-size: 1em;
    color: #555;
    margin-top: 10px;
    max-width: 700px;
    text-align: center;
    margin: 0 auto 20px auto; /* Centrado con márgenes */
    margin-bottom: 20px;
}

</style>

</body>
</html>
