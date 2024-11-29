<?php
session_start();
require ('functions/conexion.php');

$query = "SELECT a.id_admin, u.nombres,pat_apellido,mat_apellido,telefono, u.email, a.estatus 
          FROM admin a 
          JOIN usuarios u ON a.id_usuario = u.id_usuario;"; // Unimos admin con usuarios para obtener los datos del usuario

$result = $conectar->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Usuarios - Emilia's Bakery</title>
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
    <section class="admin-usuarios">
    <h2>Gestión de Administradores</h2>
    <div class="tabla-responsive">

    <div class="container">
        <a href="update_admin.php"><button type="submit" class="modificar">Añadir Administrador</button></a>
    </div>
        <table class="tabla-usuarios">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Sucursal</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            if ($result->num_rows > 0) {
            while($admin = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $admin['id_admin']; ?></td>
                    <td><?php echo $admin['nombres']; ?></td>
                    <td><?php echo $admin['pat_apellido']." ". $admin['mat_apellido']; ?></td>
                    <td><?php echo $admin['telefono']; ?></td>
                    <td><?php echo $admin['email']; ?></td>
                    <td>Sucursal El Refugio</td>
                    <td><?php echo $admin['estatus']; ?></td>
                    <td><form method="POST" action="functions/delete-admin.php">
                                        <input type="hidden" name="id_admin" value="<?php echo $admin['id_admin']; ?>">
                                        <select name="estatus" required>
                                            <option value="activo" <?php echo $admin['estatus'] == 'activo' ? 'selected' : ''; ?>>Activo</option>
                                            <option value="inactivo" <?php echo $admin['estatus'] == 'inactivo' ? 'selected' : ''; ?>>Inactivo</option>
                                        </select>
                                        <button class="eliminar" type="submit">Actualizar Estado</button>
                                    </form>
                                    </td>
                </tr>
                <?php  endwhile; }?>
            </tbody>
        </table>
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