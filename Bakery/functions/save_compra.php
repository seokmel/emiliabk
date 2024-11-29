<?php
session_start();
require 'conexion.php';

$deliveryType = $_POST['deliveryType'];
$paymentType = $_POST['paymentType'];
$cart = json_decode($_POST['agregar-carrito']); // Asegúrate de que el carrito esté correctamente formateado

// Obtener la fecha y hora actual en formato adecuado para TIMESTAMP
$purchaseDate = date("Y-m-d H:i:s"); // fecha y hora actual

$cliente_id = $_SESSION['id_usuario'];  // Verifica que la sesión del usuario esté activa

$totalAmount = 0; // Calcular el monto total de la compra
foreach ($cart as $item) {
    $totalAmount += $item->subtotal; 
}

$estado = 'pendiente';  // El estado es pendiente al principio de la compra

// Validar pago electrónico
if ($paymentType === "electronic") {
    $estado = 'pagado'; 
    $cardNumber = $_POST['card-number'];
    $cardName = $_POST['card-name'];
    $cardExpiry = $_POST['card-expiry'];
    $cardCVV = $_POST['card-cvv']; 

    // Validar número de tarjeta
    if (strlen($cardNumber) !== 19 || !preg_match('/^\d{4} \d{4} \d{4} \d{4}$/', $cardNumber)) {
        echo "El número de tarjeta no es válido.";
        exit();
    }

    // Validar nombre del titular
    if (empty($cardName)) {
        echo "El nombre del titular no puede estar vacío.";
        exit();
    }

    // Validar fecha de expiración
    if (!preg_match('/^(0[1-9]|1[0-2])\/\d{2}$/', $cardExpiry)) {
        echo "La fecha de expiración no es válida.";
        exit();
    }

    // Validar código de seguridad
    if (strlen($cardCVV) !== 3 || !ctype_digit($cardCVV)) {
        echo "El CVV no es válido.";
        exit();
    }
}

// Insertar la compra en la tabla 'pedido'
$sql = "INSERT INTO pedido (id_usuario, tipo_envio, tipo_pago, fecha_compra, monto_total, estado) 
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conectar->prepare($sql);
$stmt->bind_param('isssss', $cliente_id, $deliveryType, $paymentType, $purchaseDate, $totalAmount, $estado);

if ($stmt->execute()) {
    // Obtener el ID de la compra recién creada
    $purchaseId = $conectar->insert_id;

    // Insertar los productos del carrito en la tabla 'recibo'
    foreach ($cart as $item) {
        $productId = $item->id; // Aquí el ID del producto es VARCHAR
        $productQuantity = $item->cantidad; 
        $productPrice = $item->precio;

        // Actualizar el stock del producto en la tabla 'producto'
        $sqlUpdateStock = "UPDATE producto SET cantidad = cantidad - ? WHERE id_producto = ?";
        $stmtUpdateStock = $conectar->prepare($sqlUpdateStock);
        $stmtUpdateStock->bind_param('is', $productQuantity, $productId);

        if (!$stmtUpdateStock->execute()) {
            echo "Error al actualizar el stock del producto: " . $conectar->error;
            exit();
        }

        $sqlProduct = "INSERT INTO recibo (id_pedido, id_producto, cantidad, precio)
                       VALUES (?, ?, ?, ?)";
        $stmtProduct = $conectar->prepare($sqlProduct);
        $stmtProduct->bind_param('ssis', $purchaseId, $productId, $productQuantity, $productPrice);

        if (!$stmtProduct->execute()) {
            echo "Error al insertar producto: " . $conectar->error;
        }
    }

    // Si el pago es electrónico, generar el ticket directamente
    if ($paymentType === "electronico") {
        header("Location: ticket01.php?purchase_id=" . $purchaseId ."&success=true");
        exit();
    }

    // Si es pago en sucursal, devolver el ID de la compra
    echo $purchaseId;
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conectar->error;
}

$conectar->close();
?>
