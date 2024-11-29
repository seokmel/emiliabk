<?php
session_start();
include('functions/conexion.php');

$sql = "SELECT * FROM producto WHERE categoria = 'galleta'";
$resultado = $conectar->query($sql);

if (!$resultado) {
    echo "Error en la consulta: " . mysqli_error($conectar);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galletas</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
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
                <h1>Nuestras Galletas</h1>
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
        <section class="productos-destacados">
            <h2>Galletas</h2>
            <br>
            <div class="productos-container">
<?php
    if ($resultado->num_rows > 0) {
        while ($producto = $resultado->fetch_assoc()) {
            $id_producto = $producto['id_producto'];
            $status= $producto['estatus'];
            ?>
                <!-- Productos-->
                <div class="producto">
                <a href="productcart.php?id_producto=<?php echo $producto['id_producto']; ?>" class="producto-link">
                    <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>" class="producto-img">
                    <h3><?php echo $producto['nombre']; ?></h3>
                    <p><?php echo $producto['descripcion']; ?></p>
                    <p class="precio"><?php echo '$' . $producto['precio'] . ' MXN'; ?></p>
                    </a>
                  <!-- Verificar el estatus del pan -->
                  <?php if ($status == 'activo') { ?>
                        <!-- Producto disponible-->
                        <button class="agregar-carrito" onclick="agregarAlCarrito('<?php echo $producto['nombre']; ?>', <?php echo $producto['precio']; ?>, '<?php echo $producto['id_producto']; ?>', '<?php echo $producto['imagen']; ?>')"><i class="fas fa-cart-plus"></i> Añadir al carrito</button>
                    <?php } else { ?>
                        <!-- Producto no disponible -->
                        <button class="no-disponible" disabled><i class="fas fa-ban"></i> Producto no disponible</button>
                    <?php } ?>
                </div>
        
            <?php
        }
        } else {
            echo "<p>No hay productos en esta categoría.</p>";
        }
        ?>
        </section>
    </main>

    <script>
    function toggleMenu() {
        document.querySelector('.menu').classList.toggle('show');
    }
</script>

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
        .no-disponible {
        background-color: #ccc;  
        color: #666;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        cursor: not-allowed;  /* nonon */
        margin-top: 10px;
        border-radius: 5px;
        transition: background-color;
}
    </style>
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

<!-- Enlazar el archivo JavaScript externo -->
<script src="scripts/script.js"></script>

</body>
</html>