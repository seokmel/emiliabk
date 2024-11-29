<?php
session_start();
include('functions/conexion.php');


if (isset($_GET['id_producto'])) { //obtiene el id_producto de archivo de origen (pastel,galleta,pan)
    $id_producto = $_GET['id_producto']; 
    
    $id_producto = mysqli_real_escape_string($conectar, $id_producto); // evita inyecciones SQL

    $query = "SELECT * FROM producto WHERE id_producto = '$id_producto'";
    $result = mysqli_query($conectar, $query);//almacena la info de la consulta sql

    if ($result && mysqli_num_rows($result) > 0) {
        $producto = mysqli_fetch_assoc($result); //accede a la info de $result (consulta)
        $status= $producto['estatus']; //llamar el status pa q pueda verificar si o neh
    } else {
        echo "Producto no encontrado.";
        exit(); 
    }
} else {
    echo "ID de producto no especificado.";
    exit(); 
}
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
    <link rel="stylesheet" href="styles/style-product.css">
</head>

<body background="media/bg-bakery.jpg">

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
    <!-- Sección del producto -->
    <section class="producto-detalle">
        <div class="product-container">
            <div class="product-image">
                <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
            </div>
            <div class="product-details">
                <h1><?php echo $producto['nombre']; ?></h1>
                <p class="description"><?php echo $producto['descripcion']; ?></p>
                <p class="price"><?php echo '$' . $producto['precio'] . ' MXN'; ?></p>
                <!-- Verificar el estatus del pan -->
                <?php if ($status == 'activo') { ?>
                <!-- Producto disponible-->
                <div class="cantidad-container">
                    <button class="cantidad-btn" onclick="cambiarCantidad(this, -1)">-</button>
                    <input type="text" id="cantidad-<?php echo $producto['id_producto']; ?>" class="cantidad" value="1" readonly>
                    <button class="cantidad-btn" onclick="cambiarCantidad(this, 1)">+</button>
                </div>
                        <button class="agregar-carrito" onclick="agregarAlCarrito('<?php echo $producto['nombre']; ?>', <?php echo $producto['precio']; ?>, '<?php echo $producto['id_producto']; ?>', '<?php echo $producto['imagen']; ?>')"><i class="fas fa-cart-plus"></i> Añadir al carrito</button>
                    <?php } else { ?>
                        <!-- Producto no disponible -->
                        <button class="no-disponible" disabled><i class="fas fa-ban"></i> Producto no disponible</button>
                    <?php } ?>
            </div>
        </div>

        <div class="suggestions">
            <h2>También te podría gustar:</h2>
            <div class="suggestion-item">
                <img src="media/garibaldi.jpg" alt="Garibaldi">
                <p>Garibaldi</p>
                <p class="precio">$15.00 MXN</p>
            </div>
            <div class="suggestion-item">
                <img src="media/croissant.jpg" alt="Croissant">
                <p>Croissant</p>
                <p class="precio">$25.00 MXN</p>
            </div>
            <div class="suggestion-item">
                <img src="media/cuernitos.png" alt="Cuernitos">
                <p>Cuernitos</p>
                <p class="precio">$20.00 MXN</p>
            </div>
            <!-- Añadir más productos sugeridos -->
        </div>
    </section>
</main>

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
<script src="scripts/script.js" defer></script>
</body>
</html>
