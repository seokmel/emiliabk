<?php
session_start();

include('functions/conexion.php');

// Número de productos por página
$productsPerPage = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $productsPerPage;

$totalQuery = "SELECT COUNT(*) as total FROM producto";
$totalResult = $conectar->query($totalQuery);
$totalRow = $totalResult->fetch_assoc();
$totalProducts = $totalRow['total'];
$totalPages = ceil($totalProducts / $productsPerPage);

// Consultar los productos con LIMIT y OFFSET
$query = "SELECT id_producto, nombre, cantidad, estatus FROM producto LIMIT $productsPerPage OFFSET $offset";
$result = $conectar->query($query);
?> 

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión - Emilia's Bakery</title>
    <meta name="description" content="Galería de productos frescos y deliciosos de Emilia's Bakery.">
    
    <!-- Fuentes e Iconos -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style-home.css">
</head>
<body>

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
        <li><a href="functions/logout.php" onclick="return confirmarSalida()"><i class="fas fa-user"></i> Salir</a></li>
    <?php endif; ?>
        </ul>
    </nav>
</header>

<main>
        <section class="productos-destacados">
            <h2>Estatus de los Productos</h2>
            <table class="tabla-usuarios">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Stock</th>
                <th>Estatus</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['cantidad']; ?></td>
                    <td><?php echo $row['estatus']; ?></td>
                    <td><a href="status_form.php?id_producto=<?php echo $row['id_producto']; ?>" class="edit-button">Cambiar estatus</a></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?>">Anterior</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?php echo $i; ?>" <?php if ($i == $page) echo 'style="font-weight: bold;"'; ?>><?php echo $i; ?></a>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <a href="?page=<?php echo $page + 1; ?>">Siguiente</a>
        <?php endif; ?>
    </div>

        </section>
    </main>

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

        .admin-usuarios {
    padding: 50px;
    background-color: #fff;
}

.admin-usuarios h2 {
    text-align: center;
    font-size: 36px;
    margin-bottom: 30px;
    color: #6b705c;
}

.tabla-responsive {
    overflow-x: auto;
}

.tabla-usuarios {
    width: 100%;
    border-collapse: collapse;
    margin: 0 auto;
}

.tabla-usuarios th, .tabla-usuarios td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: center;
}

.tabla-usuarios th {
    background-color: #d2b08e;
    color: white;
}

.tabla-usuarios tr:nth-child(even) {
    background-color: #f2f2f2;
}

.tabla-usuarios tr:hover {
    background-color: #e1e1e1;
}

.tabla-usuarios td {
    color: #333;
}

    </style>
<script src="scripts/salir.js" defer></script>
</body>
</html>