<?php
session_start();
include('functions/conexion.php');

// Verificar si el usuario no ha iniciado sesión
if (!isset($_SESSION['email'])) {
    // Redirigir al formulario 
    header("Location: iniciar-sesion.php");
    exit();
}

// Número de recibos por página
$receiptsPerPage = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $receiptsPerPage;

// Obtener el id_cliente usando el email de la sesión
$email = $_SESSION['email'];
$sqlCliente = "SELECT id_usuario FROM usuarios WHERE email = ?";
$stmtCliente = $conectar->prepare($sqlCliente);
$stmtCliente->bind_param("s", $email);
$stmtCliente->execute();
$resultCliente = $stmtCliente->get_result();

if ($resultCliente->num_rows > 0) {
    // Obtener el id_cliente
    $cliente = $resultCliente->fetch_assoc();
    $id_cliente = $cliente['id_usuario'];

    // Consulta para obtener los recibos del cliente logueado, incluyendo el nombre del producto
    $sql = "SELECT 
                r.id_recibo, 
                pr.nombre AS nombre_producto,
                r.cantidad, 
                r.precio, 
                p.tipo_envio, 
                p.tipo_pago, 
                p.fecha_compra
            FROM 
                recibo r
            JOIN 
                pedido p ON r.id_pedido = p.id_pedido
            JOIN 
                producto pr ON r.id_producto = pr.id_producto
            WHERE 
                p.id_usuario = ?  -- Usamos el parámetro del cliente logueado
            ORDER BY 
                p.fecha_compra DESC
            LIMIT $receiptsPerPage OFFSET $offset";

    // Preparar y ejecutar la consulta
    $stmt = $conectar->prepare($sql);
    $stmt->bind_param("i", $id_cliente);  // Vinculamos el id del cliente de la sesión
    $stmt->execute();
    $result = $stmt->get_result();

    // Obtener el total de recibos para paginación
    $totalRecibos = $conectar->query("SELECT COUNT(*) AS total FROM recibo r JOIN pedido p ON r.id_pedido = p.id_pedido WHERE p.id_usuario = " . $id_cliente)->fetch_assoc();
    $totalPages = ceil($totalRecibos['total'] / $receiptsPerPage);
} else {
    // Si no se encuentra el id_cliente
    die("Error al obtener el id del cliente.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Datos</title>
    <!-- Fuentes e Iconos -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Estilos personalizados -->
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
            <h1>Datos del Usuario</h1>
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
    <div class="productos-container" style="display: flex; justify-content: space-between;">
        <!-- Información del Usuario -->
        <div class="producto usuario-info" style="flex: 1; margin-right: 20px;">
            <p>Nombre de usuario: <?php echo $_SESSION['nombres']; ?></p>
            <p>Apellidos: <?php echo $_SESSION['pat_apellido'] . ' ' . $_SESSION['mat_apellido']; ?></p>
            <p>Teléfono: <?php echo $_SESSION['telefono']; ?></p>
            <p>Email: <?php echo $_SESSION['email']; ?></p>
            <a href="actualizar.php">Actualizar datos</a>
            <a href="functions/logout.php">Cerrar sesión</a>
        </div>

        <!-- Historial de Compras -->
        <div class="producto" style="flex: 2;">
            <h2>Historial de Compras</h2>
            <div class="tabla-responsive">
                <table class="tabla-usuarios">
                    <thead>
                        <tr>
                            <th>Num. Recibo</th>
                            <th>Nombre Producto</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Tipo de Envío</th>
                            <th>Tipo de Pago</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id_recibo']; ?></td>
                                <td><?php echo $row['nombre_producto']; ?></td>
                                <td><?php echo $row['cantidad']; ?></td>
                                <td><?php echo $row['precio']; ?></td>
                                <td><?php echo $row['tipo_envio']; ?></td>
                                <td><?php echo $row['tipo_pago']; ?></td>
                                <td><?php echo $row['fecha_compra']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
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
</body>
</html>
