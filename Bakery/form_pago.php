<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proceso de Compra - Emilia's Bakery</title>
    <!-- Fuentes e Iconos -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style-proceso-compra.css">
</head>
<body>
<header class="main-header">

    <nav class="navbar">
        <div class="menu-toggle" onclick="toggleMenu()">
            <i class="fas fa-bars"></i>
        </div>
            <div class="logo">
                <img src="media/logo-bakery.png" alt="Logo Panadería Emilia's Bakery" width="120">
                <h1>Pago Electronico</h1>
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

    <section class="contacto">

     <!-- Sección de la tarjeta -->
     <div class="main-container">
     <div class="card-section">
        <div class="card" id="card">
            <!-- Parte frontal -->
            <div class="front">
                <div class="chip"></div>
                <div class="card-number" id="display-number">#### #### #### ####</div>
                <div class="card-info">
                    <div>
                        <div>Titular:</div>
                        <div id="display-name">NOMBRE APELLIDO</div>
                    </div>
                    <div>
                        <div>Expira:</div>
                        <div id="display-expiry">MM/AA</div>
                    </div>
                </div>
            </div>
            <!-- Parte trasera -->
            <div class="back">
                <div class="magnetic-strip"></div>
                <div class="signature-area">
                    <div class="signature" id="display-signature">FIRMA</div>
                    <div class="security-code" id="display-cvv">###</div>
                </div>
            </div>
        </div>
        </div>
        </div>

        <br>
        <br>
      
         <!-- Formulario de pago -->
<form class="contacto-form" id="orderForm">

    <label for="total-amount">Total a pagar:</label>
    <input type="text" id="total-amount" name="total-amount" readonly class="total-amount-input">

    <label>
        Número de Tarjeta:
        <input type="text" id="card-number" name="card-number" maxlength="19" placeholder="xxxx xxxx xxxx xxxx" required>
        <div class="error" id="number-error"></div>
    </label>
    <label>
        Nombre del Titular:
        <input type="text" id="card-name" name="card-name" placeholder="Nombre Apellido" required>
        <div class="error" id="name-error"></div>
    </label>
    <label>
        Fecha de Expiración:
        <input type="text" id="card-expiry" name="card-expiry" maxlength="5" placeholder="MM/AA" required>
        <div class="error" id="expiry-error"></div>
    </label>
    <label>
        Código de Seguridad:
        <input type="text" id="card-cvv" name="card-cvv" maxlength="3" placeholder="000" required>
        <div class="error" id="cvv-error"></div>
    </label>

    <!-- Información personal -->
    <h2>Ingrese su información</h2>
    <label for="full-name">Nombre Completo:</label>
    <input type="text" id="full-name" name="full-name" placeholder="Nombre Completo" required>
    
    <label for="email">Correo Electrónico:</label>
    <input type="email" id="email" name="email" placeholder="ejemplo@correo.com" required>

    <input type="hidden" name="deliveryType" value="sucursal" || value="domicilio">
    <input type="hidden" name="paymentType" value="electronic">
    
    <button type="submit">Procesar Pago</button>
    </form>
    </section>

    <style>
    .main-container {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    gap: 40px; /* Espacio entre la tarjeta y la sección de película */
    }
    .card-section {
  width: 340px;
  height: 200px;
}
    .card {
  width: 100%;
  height: 100%;
  border-radius: 15px;
  position: relative;
  transform-style: preserve-3d;
  transform: rotateY(0);
  transition: transform 0.8s;
}

.card .front,
.card .back {
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
  border-radius: 15px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 20px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
}
.front {
/* background: linear-gradient(135deg, rgba(0, 80, 239, 0.8), rgba(0, 80, 239, 0.5)); azul cobalto */ 
/*  background: linear-gradient(135deg, rgba(0, 0, 139, 0.8), rgba(0, 0, 139, 0.5)); azul rey */ 
 /*background: linear-gradient(135deg, #e07b30, #d4af37);  anaranjado */ 
 background: linear-gradient(135deg, #003366, #b0b0b0);
  color: white;
}

.back {
  background: linear-gradient(135deg, #003366, #b0b0b0);
  color: white;
  transform: rotateY(180deg);
}

.chip {
  width: 50px;
  height: 35px;
  background: #e0c17c;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.card-number {
  font-size: 1.4rem;
  letter-spacing: 2px;
}
.card-info {
  display: flex;
  justify-content: space-between;
  font-size: 0.9rem;
}

.magnetic-strip {
  width: 100%;
  height: 40px;
  background: black;
  margin-bottom: 20px;
}

.signature-area {
  background: #d9d9d9;
  height: 35px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 10px;
  border-radius: 5px;
}

.signature {
  font-family: 'Cursive', Arial, sans-serif;
  font-size: 1.1rem;
}

.security-code {
  font-size: 1.1rem;
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
.total-amount-input {
    background-color: #d4a373;  
    color: #fff;  /* Color de texto blanco */
    font-size: 20px;  
    font-weight: bold;  /* Hacer el texto negrita */
    text-align: center;  
    padding: 10px;  
    border: 2px solid #e67e22;  
    border-radius: 8px;  
    width: 100%;  
    box-sizing: border-box;  
    margin-top: 10px;  
    margin-bottom: 20px;  
    cursor: not-allowed;  /* Mostrar un cursor de "no permitido" para indicar que es de solo lectura */
}

.total-amount-input:focus {
    outline: none;  /* Eliminar el contorno cuando se haga foco */
    border-color: #f39c12;  /* Cambiar el borde a un color más brillante al hacer foco */
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
        h1#letritas {
            color: #6b705c;
            text-align: center;
        }
    </style>

    <script>
        function toggleMenu() {
        document.querySelector('.menu').classList.toggle('show');
    }
        window.onload = function() {
    // Obtener los productos del carrito desde localStorage
    const cart = JSON.parse(localStorage.getItem('agregar-carrito')) || [];

    // Calcular el total a pagar
    let totalAmount = 0;
    cart.forEach(product => {
        totalAmount += product.precio * product.cantidad;
    });

    // Mostrar el total en el campo de texto
    document.getElementById('total-amount').value = `$${totalAmount.toFixed(2)}`;
};

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

    <script src="scripts/tarjeta.js"></script>
</body>
</html>
