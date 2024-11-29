<?php
session_start();
include ('functions/conexion.php');
function generarContrasena($longitud = 10) {
    $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$_'; //generar contraseña random
    $contrasena = '';
    for ($i = 0; $i < $longitud; $i++) {
        $contrasena .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }
    return $contrasena;
}
// Generamos la contraseña aleatoria
$contrasena_aleatoria = generarContrasena();
$_SESSION['contrasena_aleatoria'] = $contrasena_aleatoria;
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
    <h2>Agregar Administrador</h2>

<form action="functions/add_admin.php" method="POST" class="contacto-form">
    <!-- USUARIO INPUT -->
    <label for="username">Nombres: </label>
        <input type="text" placeholder="Ingresa el nombre" name="nombres" autocomplete="off" required></input>

        <label for="username">Apellido Paterno: </label>
        <input type="text" placeholder="Ingresa el apellido" name="pat_apellido" autocomplete="off" required></input>

        <label for="username">Apellido Materno:</label>
        <input type="text" placeholder="Ingresa el apellido" name="mat_apellido" autocomplete="off" required></input>

        <label for="username">Teléfono:</label>
        <input type="tel" placeholder="Ingresa el teléfono" name="telefono" pattern="[0-9]+" autocomplete="off" required></input>

        <label for="username">Email:</label>
        <input type="email" placeholder="Ingresa el email" name="email" autocomplete="off" required></input>

        <label for="username">Contraseña de acceso:</label>
        <input type="password" placeholder="Ingresa la contraseña" name="password_usuario" autocomplete="off" required></input>

        <label for="recomendacion">Contraseña de acceso a Administrador(Recuerda guardarla): </label>
         <input type="text" value="<?php echo $contrasena_aleatoria; ?>" readonly disabled>

        <button type="submit">Agregar Administrador</button>
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
