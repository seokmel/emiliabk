<?php
// Valida el número de tarjeta (largo y formato)
function validarNumeroTarjeta($numero) {
    return preg_match('/^\d{16}$/', $numero);
}

// Valida la fecha de expiración (formato MM/AA y no debe ser una fecha pasada)
function validarFechaExpiracion($fecha) {
    $fechaActual = new DateTime();
    $fechaExpiracion = DateTime::createFromFormat('m/y', $fecha);
    return ($fechaExpiracion && $fechaExpiracion > $fechaActual);
}

// Valida el CVV (3 dígitos)
function validarCVV($cvv) {
    return preg_match('/^\d{3}$/', $cvv);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario
    $nombre = $_POST['name'];
    $numeroTarjeta = $_POST['cardNumber'];
    $fechaExpiracion = $_POST['expirationDate'];
    $cvv = $_POST['cvv'];

    // Validar los datos
    if (empty($nombre) || empty($numeroTarjeta) || empty($fechaExpiracion) || empty($cvv)) {
        echo "Todos los campos son obligatorios.";
    } elseif (!validarNumeroTarjeta($numeroTarjeta)) {
        echo "El número de tarjeta no es válido. Debe tener 16 dígitos.";
    } elseif (!validarFechaExpiracion($fechaExpiracion)) {
        echo "La fecha de expiración es inválida o ya ha pasado.";
    } elseif (!validarCVV($cvv)) {
        echo "El CVV debe tener 3 dígitos.";
    } else {
        // Si todo es válido, simula el proceso de pago
        echo "Pago procesado correctamente para el titular: $nombre.";
        // Aquí puedes agregar el código para actualizar el estado del pedido en la base de datos
    }
}
?>
