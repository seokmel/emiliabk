<?php
session_start();
include('functions/conexion.php');

$id_producto = $_GET['id_producto']; //obtiene el id del producto mandado de la tablita

$query = "SELECT * FROM producto WHERE id_producto = ?"; //consulta donde obtendra la info del id obtenido

if ($stmt = mysqli_prepare($conectar, $query)) { //prepara la consulta ante inyecciones sql 
    mysqli_stmt_bind_param($stmt, "s", $id_producto); //se vincula el id obtenido a la query hecha

    mysqli_stmt_execute($stmt); //ejecuta la consulta 
    $result = mysqli_stmt_get_result($stmt); //obtiene el resultado de la consulta 
    $producto = mysqli_fetch_assoc($result); //guarda todos los datos de la consulta 
}
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
    <link rel="stylesheet" href="styles/style-home.css?v=1.0">
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
        <li><a href="functions/logout.php" onclick="return confirmarSalida()"><i class="fas fa-user"></i>Salir</a></li>
    <?php endif; ?>
        </ul>
    </nav>
</header>

<section class="contacto">
    <div class="contacto-container"></div>
    <h2>Editar producto</h2>

<form action="update_product.php" method="POST" class="contacto-form" enctype="multipart/form-data">
    <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>"/>

    <label for="nombre">Nombre del Producto:</label>
    <input type="text" id="nombre" name="nombre" value="<?php echo $producto['nombre']; ?>" >

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="precio" step="0.01" value="<?php echo $producto['precio']; ?>" >

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion"><?php echo htmlspecialchars($producto['descripcion']); ?></textarea>

    <label for="cantidad">Cantidad en Stock:</label>
    <input type="number" id="cantidad" name="cantidad" min="0" step="1" value="<?php echo $producto['cantidad']; ?>" title="La cantidad debe ser al menos 1">

    <label for="imagen">Imagen actual:</label>
    <img src="<?php echo $producto['imagen']; ?>" alt="Imagen actual" width="200"><br>

    <label for="imagen">Nueva Imagen:</label>
    <input type="file" id="imagen" name="imagen" value="<?php echo $producto['imagen']; ?>"  accept="image/*">

    <input type="hidden" name="imagen_anterior" value="<?php echo $producto['imagen']; ?>">

    <!-- Campo para la contraseña -->
    <label for="passAdmin">Contraseña de Seguridad:</label>
    <input type="password" id="passAdmin" name="passAdmin" required>

    <button type="submit" >Actualizar</button>
            </form>
        </div>
    </section>

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
    background-color: #f4f4f9; /* Fondo claro para contraste */
    margin: 0;
    padding: 0;
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

h1 {
    font-size: 2.5em;
    color: #ffffff;
    margin: 0;
}

.contacto {
    padding: 40px 20px;
    background-color: #ffffff;
    margin: 20px auto;
    max-width: 800px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

.contacto h2 {
    font-size: 36px;
    color: #6b705c;
    text-align: center;
}

.contacto-form {
    display: flex;
    flex-direction: column;
    margin-top: 20px;
}

.contacto-form label {
    margin-bottom: 8px;
    font-weight: 600;
    color: #6b705c;
}

.contacto-form input,
.contacto-form select,
.contacto-form textarea {
    padding: 12px;
    border: 1px solid #d4a373;
    border-radius: 8px;
    margin-bottom: 20px;
    font-size: 16px;
    color: #333;
}

.contacto-form textarea {
    resize: vertical;
    min-height: 100px;
}

.contacto-form button {
    background-color: #d4a373;
    color: #ffffff;
    border: none;
    padding: 12px 25px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 8px;
    transition: background-color 0.3s;
    align-self: flex-start;
}

.contacto-form button:hover {
    background-color: #bc6c25;
}

.contacto-form input[type="file"] {
    padding: 5px;
}

.contacto-form .categoria {
    background-color: #ffffff;
    border: 1px solid #d4a373;
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
}

footer {
    background-color: #d4a373;
    color: #ffffff;
    text-align: center;
    padding: 20px 0;
    font-size: 14px;
}
.contacto-form input[type="file"] {
    padding: 10px;
    border: 1px solid #d4a373;
    border-radius: 8px;
    background-color: #fff;
    color: #333;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s, border 0.3s;
    width: 100%;
}

.contacto-form input[type="file"]:hover {
    background-color: #f5f5f5;
    border-color: #bc6c25;
}

.contacto-form input[type="file"]::-webkit-file-upload-button {
    background-color: #d4a373;
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}

.contacto-form input[type="file"]::-webkit-file-upload-button:hover {
    background-color: #bc6c25;
}

</style>
<script src="scripts/salir.js" defer></script>
</body>
</html>
 