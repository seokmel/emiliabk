<?php
session_start();

$paymentType = isset($_GET['paymentType']) ? $_GET['paymentType'] : '';

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
                <h1>Domicilio</h1>
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
    <div class="contacto-container"></div>
    <h2>Domicilio</h2>

    <form id="orderForm" class="contacto-form" action="functions/save_domicilio.php" method="POST">
    <label for="codigo_postal">Código Postal:</label>
    <input type="text" id="codigo_postal" name="codigo_postal" required maxlength="10" placeholder="Ejemplo: 22253" pattern="\d{5}">
    <span id="cpError" class="error hidden">Este código postal no cuenta con servicio a domicilio.</span>

    <label for="colonia">Colonia:</label>
    <input type="text" id="colonia" name="colonia" required placeholder="Ejemplo: Laurel 1" disabled>

    <label for="calle">Calle:</label>
    <input type="text" id="calle" name="calle" required placeholder="Ejemplo: Avenida Principal" disabled>

    <label for="numero_casa">Número de Casa:</label>
    <input type="text" id="numero_casa" name="numero_casa" required placeholder="Ejemplo: 64-B" disabled>

    <label for="referencia">Referencia del Domicilio:</label>
    <textarea id="referencia" name="referencia" placeholder="Ejemplo: casa color blanca con porton negro" required disabled></textarea>

    <button type="submit" id="submit" disabled>Enviar</button>
</form>
</section>

<script>
    function toggleMenu() {
        document.querySelector('.menu').classList.toggle('show');
    }
    const urlParams = new URLSearchParams(window.location.search);
    const paymentType = urlParams.get('paymentType'); // Puede ser 'electronic' o 'sucursal'


    const validPostalCodes = ['22253']; // Lista de códigos postales válidos
    const cpInput = document.getElementById('codigo_postal');
    const cpError = document.getElementById('cpError');
    const submitBtn = document.getElementById('submit');
    const formElements = document.querySelectorAll('input:not(#codigo_postal), textarea'); // Todos los campos excepto CP
    const domicilioForm = document.getElementById('orderForm');

    // Habilitar campos del formulario
    function enableFormFields() {
        formElements.forEach(element => {
            element.disabled = false;
        });
        if (submitBtn) submitBtn.disabled = false; // Asegurarse de que el botón exista
    }

    // Deshabilitar campos del formulario
    function disableFormFields() {
        formElements.forEach(element => {
            element.disabled = true;
        });
        if (submitBtn) submitBtn.disabled = true;
    }

    // Validar el código postal mientras el usuario escribe
    cpInput.addEventListener('input', () => {
        const postalCode = cpInput.value.trim();
        if (validPostalCodes.includes(postalCode)) {
            cpError.classList.add('hidden'); // Ocultar mensaje de error
            enableFormFields();
        } else {
            cpError.classList.remove('hidden'); // Mostrar mensaje de error
            disableFormFields();
        }
    });

    // Manejar el envío del formulario
    domicilioForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevenir el envío predeterminado del formulario

        const formData = {
            codigo_postal: cpInput.value,
            colonia: document.getElementById('colonia').value,
            calle: document.getElementById('calle').value,
            numero_casa: document.getElementById('numero_casa').value,
            referencia: document.getElementById('referencia').value,
            tipo_envio: paymentType,
        };

        // Enviar los datos al servidor con Fetch
        fetch('functions/save_domicilio.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData),  // Enviar el objeto formData
        })
        .then(response => response.json())  // Parsear la respuesta como JSON
        .then(data => {
            if (data.success) {
                // Mostrar mensaje de éxito
                window.location.href = data.redirect;
            } else {
            alert(data.message); // Mostrar mensaje de error
        }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un problema al procesar la solicitud. Intenta de nuevo más tarde.');
        });
    });
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
        .hidden {
            display: none;
        }
        .error {
            color: red;
            font-size: 0.9em;
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
</body>
</html>
