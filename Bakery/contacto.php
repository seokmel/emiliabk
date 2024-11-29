<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Emilia's Bakery</title>
    <meta name="description" content="Ponte en contacto con Emilia's Bakery para cualquier consulta o pedido especial.">
    
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
            <h1>Contacto</h1>
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

<section class="contacto">
    <div class="contacto-container">
        <h2>¿Tienes alguna pregunta?</h2>
        <p>Estamos aquí para ayudarte. Completa el formulario y nos pondremos en contacto contigo lo antes posible.</p>
        
        <form action="functions/contacte.php" method="POST" class="contacto-form">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" autocomplete="off" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" autocomplete="off" required>
            
            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" autocomplete="off" pattern="[0-9]+" required>
            
            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="mensaje" rows="5" autocomplete="off" required></textarea>
            
            <button type="submit"><i class="fas fa-paper-plane"></i> Enviar</button>
        </form>
        
        <div class="info-contacto">
            <h3>Información de Contacto</h3>
            <p><i class="fas fa-map-marker-alt"></i> Calle Paseo de Las Lilas 92, CDMX</p>
            <p><i class="fas fa-phone"></i> Teléfono: +52 55 3930 6638</p>
            <p><i class="fas fa-envelope"></i> Email: contacto@emiliasbakery.com</p>
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

    .main-header {
        background-color: #d4a373;
        padding: 10px 0;
    }

    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 40px;
    }

    .contacto {
        padding: 50px 20px;
        text-align: center;
        background-color: #ffffff;
        margin: 20px auto;
        max-width: 800px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .contacto h2 {
        font-size: 36px;
        color: #6b705c;
    }

    .contacto p {
        font-size: 16px;
        color: #8d99ae;
    }

    .contacto-form {
        display: flex;
        flex-direction: column;
        margin-top: 20px;
    }

    .contacto-form label {
        margin-bottom: 5px;
        font-weight: 500;
    }

    .contacto-form input,
    .contacto-form textarea {
        padding: 10px;
        border: 1px solid #d4a373;
        border-radius: 5px;
        margin-bottom: 15px;
    }

    .contacto-form button {
        background-color: #d4a373;
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .contacto-form button:hover {
        background-color: #bc6c25;
    }

    .info-contacto {
        margin-top: 40px;
        text-align: left;
    }

    .info-contacto h3 {
        font-size: 24px;
        color: #6b705c;
        margin-bottom: 10px;
    }

    .info-contacto p {
        font-size: 16px;
        color: #8d99ae;
    }

    footer {
        background-color: #d4a373;
        color: #ffffff;
        text-align: center;
        padding: 20px 0;
        font-size: 14px;
    }

    .footer-content {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
    }

    .footer-logo img {
        margin-bottom: 10px;
    }
</style>


</body>
</html>