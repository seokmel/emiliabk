<?php
session_start();
include('functions/conexion.php');

// Número de recibos por página
$receiptsPerPage = 6;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $receiptsPerPage;

// Consulta SQL para obtener los datos de los recibos y la información relacionada de la tabla pedido
$query = "SELECT 
            r.id_recibo, 
            r.id_producto, 
            r.cantidad, 
            r.precio, 
            p.tipo_envio, 
            p.fecha_compra, 
            p.estado
        FROM 
            recibo r
        JOIN 
            pedido p ON r.id_pedido = p.id_pedido
        ORDER BY 
            p.fecha_compra DESC 
        LIMIT $receiptsPerPage OFFSET $offset";

$resultado = $conectar->query($query);

// Consulta para obtener el total de recibos
$totalQuery = "SELECT COUNT(*) AS total FROM recibo";
$totalResult = $conectar->query($totalQuery);
$totalRow = $totalResult->fetch_assoc();
$totalReceipts = $totalRow['total'];
$totalPages = ceil($totalReceipts / $receiptsPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos y Ventas - Emilia's Bakery</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style-home.css?v=1.0">
</head>
<body>
<header class="main-header">
    <nav class="navbar">
        <div class="logo">
            <img src="media/logo-bakery.png" alt="Logo Panadería Emilia's Bakery" width="120">
        </div>
        <ul class="menu">
            <li><a href="index-admin.php"><i class="fas fa-home"></i> Inicio</a></li>
            <li><a href="productos-admin.php"><i class="fas fa-clipboard-list"></i> Gestión de Productos</a></li>

    <?php if (isset($_SESSION['email'])): ?>
        <li><a href="functions/logout.php" onclick="return confirmarSalida()"><i class="fas fa-user"></i>Salir</a></li>
    <?php endif; ?>
        </ul>
    </nav>
</header>

    <main>
    <section class="productos-destacados">
    <h2>Pedidos y Ventas</h2>
    <div class="tabla-responsive">
        <table class="tabla-usuarios">
            <thead>
                <tr>
                    <th>ID Recibo</th>
                    <th>ID Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Tipo de Envío</th>
                    <th>Fecha de Compra</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultado->num_rows > 0) {
                    while ($row = $resultado->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id_recibo']}</td>
                                <td>{$row['id_producto']}</td>
                                <td>{$row['cantidad']}</td>
                                <td>{$row['precio']}</td>
                                <td>{$row['tipo_envio']}</td>
                                <td>{$row['fecha_compra']}</td>
                                <td>{$row['estado']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No hay recibos disponibles.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

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
        }  .productos-container {
    display: flex;
    justify-content: space-between;
}

.producto {
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.usuario-info {
    flex: 1;
    margin-right: 20px;
    max-height: 300px; /* Ajusta la altura máxima */
    overflow-y: auto; /* Permite desplazamiento vertical si el contenido excede la altura */
}

.historial-compras {
    flex: 2;
}

.producto a {
    display: inline-block;
    padding: 10px 20px;
    background-color: #bd8853;
    color: white;
    text-decoration: none;
    margin: 10px;
}

.producto a:hover {
    background-color: #bc6c25;
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



    </style>
    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <img src="../media/logo-bakery.png" alt="Logo Panadería Emilia's Bakery" width="100">
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
