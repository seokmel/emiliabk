<?php
session_start();
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

<section class="productos-destacados">
    <h2>Panel de Administración</h2>
    <div class="productos-container">
        <!-- pasteles-->
        <div class="producto">
            <!-- Menú superpuesto -->
        <div id="menu">
        <ul>
        <li><a href="newproduct.php" title="Panes">Agregar</a></li>
        <li><a href="actproduct.php" title="Galletas">Editar</a></li>
        <li><a href="status.php" title="Pasteles">Estatus</a></li>
        </ul>
        </div>
                <img src="media/pastel-durazno.png" alt="Garibaldi" class="producto-img">
                <h3>Gestión de Productos</h3>
        </div>
        <!--panes-->
        <div class="producto">
            <a href="productosyventas-admin.php" class="producto-link">
                <img src="media/concha-choco.jpg" alt="Concha de Chocolate" class="producto-img">
                <h3>Pedidos y Ventas</h3>
            </a>
        </div>
        <!-- galletas -->
        <div class="producto">
            <a href="usuarios-admin.php" class="producto-link">
                <img src="media/galletas.jpeg" alt="Croissant" class="producto-img">
                <h3>Gestión de Administradores</h3>
            </a>
        </div>
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
    }

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

    .top-categories {
	display: flex;
	flex-direction: column;
	gap: 3rem;
    margin: 0 auto;
	margin-bottom: 3rem;
    max-width: 1200px;
    padding: 0 2rem;
}

.container-categories {
	display: grid;
	grid-template-columns: repeat(3, 1fr);
	gap: 3rem;
}

.card-category {
	height: 18rem;
	display: flex;
	flex-direction: column;
	align-items: center;
	justify-content: center;
	border-radius: 2rem;
	gap: 1rem;
    text-align: center;
}
.productos-container {
    display: flex;
    justify-content: space-around; /* Espacio uniforme entre las tarjetas */
    align-items: flex-start;
    gap: 1.5rem;
    max-width: 1200px;
    margin: 0 auto;
    padding: 1rem;
    flex-wrap: wrap; /* Permite que las tarjetas se ajusten en varias filas en pantallas pequeñas */
}


.producto {
    position: relative;
    width: 300px; /* Ajusta el ancho para que todas tengan un tamaño consistente */
    overflow: hidden;
    border-radius: 1rem;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
}

.producto:hover {
    transform: scale(1.05);
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
}

.producto-link {
    display: block;
    text-decoration: none;
    text-align: center;
}

.producto-img {
    width: 100%;
    height: 200%;
    object-fit: cover;
    filter: brightness(0.55); /* Oscurece un poco la imagen para resaltar el texto */
}



#menu {
    position: absolute;
    top: 35px;
    left: 40px;
    right: 40px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin-top: 1.2rem;
    padding: 1rem;
    gap: 0.5rem;
    z-index: 2; /* Asegura que el menú esté encima de la imagen */
}


#menu ul {
    list-style-type: none;
    margin: 0px;
    padding: 0px;
    width: 200px;
    font-family: 'Montserrat', sans-serif;
    font-size: 17pt;
}

#menu ul li {
    text-align: center;
}

#menu ul li a {
    color: #fff;
    text-decoration: none;
    text-transform: uppercase;
    display: block;
    padding: 10px 10px 10px;
}

#menu ul li a:hover {
    border-left: 8px solid #fff;
    color: #fff;
}








.category-pastel {
	background-image: linear-gradient(#00000080, #00000080),
		url('img/pastel-nuez.png');
	background-size: cover;
	background-position: center;
	background-repeat: no-repeat;
    background-blend-mode: darken;
    border-radius: 2rem;
	padding: 1rem;
	transition: transform 0.3s, box-shadow 0.3s;
}

.category-galletas {
	background-image: linear-gradient(#00000080, #00000080),
		url('img/galletas.jpeg');
	background-size: cover;
	background-position: center;
	background-repeat: no-repeat;
    background-blend-mode: darken;
    border-radius: 2rem;
	padding: 1rem;
	transition: transform 0.3s, box-shadow 0.3s;
}

.category-panes {
	background-image: linear-gradient(#00000080, #00000080),
		url('img/panque-choco.jpg');
	background-size: cover;
	background-position: center;
	background-repeat: no-repeat;
    background-blend-mode: darken;
    border-radius: 2rem;
	padding: 1rem;
	transition: transform 0.3s, box-shadow 0.3s;
}

.category-pastel:hover,
.category-galletas:hover,
.category-panes:hover {
	transform: scale(1.05);
	box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
}

.card-category p {
	font-size: 1.9rem;
	color: #fff;
	text-transform: capitalize;
	position: relative;
    margin: 0;
}

.card-category p::after {
	content: '';
	width: 2.5rem;
	height: 2px;
	background-color: #fff;
	position: absolute;
	bottom: -1rem;
	left: 50%;
	transform: translate(-50%, 50%);
}

.card-category span:hover {
	color: var(--primary-color);
}
    .galeria {
        background-color: #ffffff;
        padding: 50px 20px;
        text-align: center;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        margin: 20px auto;
        max-width: 1200px;
    }

    .galeria-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    .galeria-item {
        width: 23%;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .galeria-item:hover {
        transform: scale(1.05);
        box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
    }

    .galeria-item img {
        width: 100%;
        height: auto;
        display: block;
    }

    @media (max-width: 768px) {
	.container-categories {
		grid-template-columns: 1fr; /* Una columna en pantallas pequeñas */
	    }
    }

    @media (max-width: 768px) {
        .galeria-item {
            width: 46%;
        }
    }

    @media (max-width: 480px) {
        .galeria-item {
            width: 90%;
        }
    }
</style>
<script src="scripts/salir.js" defer></script>
</body>
</html>
