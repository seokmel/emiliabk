<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emilia's Bakery</title>
    <meta name="description" content="Pan artesanal, dulce, salado, croissants, y más. Horneado diariamente con ingredientes frescos.">
    
    <!-- Fuentes e Iconos -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="styles/style-cart.css">
</head>

<body>
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
    </header>
    
    <main>
        <section class="cart-container">
            <h1>Tu carrito</h1>
            <a href="productos.php" class="continue-shopping">Seguir comprando</a>
            <br>
            <div class="cart">
                <div class="cart-header">
                    <span>Producto</span>
                    <span>Cantidad</span>
                    <span>Total</span>
                </div>
                <div id="cart-items" class="cart-items">
                    <!-- Aquí se agregarán los elementos del carrito dinámicamente -->
                </div>

                <div class="cart-summary">
                    <div class="summary-total">
                        <p>Total: <strong id="total-carrito"></strong></p>
                    </div>
                    <!-- Botón que redirige a proceso-compra.php -->
                    <a href="proceso-compra.php" class="checkout-btn"  onclick="checkCart(event)">Pagar Pedido</a>
                </div>

                <div class="payment-methods">
                    <p>PAGO 100% SEGURO</p>
                    <img src="media/visa.png" alt="Visa">
                    <img id="method2" src="media/mastercard.png" alt="Mastercard">
                </div>
            </div>
        </section>
    </main>

    <script>
        function toggleMenu() {
            document.querySelector('.menu').classList.toggle('show');
        }
        function checkCart(event) {
    // Verifica si el carrito está vacío (en este caso, usando localStorage como ejemplo)
    const cart = JSON.parse(localStorage.getItem('agregar-carrito')) || []; // Si no hay carrito, se usa un arreglo vacío

    if (cart.length === 0) {
        event.preventDefault();  // Prevenimos la acción de redirección
        alert("El carrito está vacío. Agrega productos antes de proceder con el pago.");
    } 
    // Si el carrito no está vacío, el enlace continuará normalmente
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
</body>
<script src="scripts/script.js" defer></script>
</html>

