<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proceso de Compra - Emilia's Bakery</title>
    <!-- Fuentes e Iconos -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style-proceso-compra.css">
</head>
<body>
<header class="main-header">

    <nav class="navbar">
        <div class="menu-toggle" onclick="toggleMenu()">
            <i class="fas fa-bars"></i>
        </div>
            <div class="logo">
                <img src="media/logo-bakery.png" alt="Logo Panadería Emilia's Bakery" width="120">
                <h1>Pago</h1>
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
    <main>
        <section class="checkout-form-container">
            <h1 id="letritas">Proceso de Compra</h1>
<br>

<form id="orderForm">
    <!-- Tipo de Envío -->
    <fieldset>
        <legend>Selecciona el tipo de envío</legend>
        <label>
            <input type="radio" name="deliveryType" value="sucursal">
            Recoger en Sucursal
        </label>
        
        <label>
            <input type="radio" name="deliveryType" value="domicilio">
            A Domicilio
        </label>
    </fieldset>
<br>
    <!-- Método de Pago -->
    <fieldset>
        <legend>Selecciona el método de pago</legend>

        <label>
            <input type="radio" name="paymentType" value="sucursal">
            Pago con efectivo
        </label>
        
        <label>
            <input type="radio" name="paymentType" value="electronic">
            Pago Electrónico
        </label>
    </fieldset>
    <br>
    <div id="paymentWarning" class="hidden" style="color: red; font-weight: bold;">
        El pago en efectivo no está disponible para envío a domicilio.
    </div>
    <br>
    <?php if (isset($_SESSION['email'])): ?>
    <button type="submit" class="hidden">Seguir con la compra</button>
    <?php else: ?>
        <button class="hidden"><a href="iniciar-sesion.php" style="color: white; text-decoration: none;">Seguir con la compra</a></button>
    <?php endif; ?>
</form>

        </section>
    </main>
    <style>
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
        h1#letritas {
            color: #6b705c;
            text-align: center;
        }
    </style>

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

    <script src="scripts/proceso-compra.js"></script>
</body>
</html>
