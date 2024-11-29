<?php
session_start();
require 'conexion.php';

if (isset($_GET['success']) && $_GET['success'] == 'true') {
    echo "<script>alert('Compra exitosa. ¡Gracias por tu compra!');</script>";
}

// obtenemos el ID del pedido por la url 
$purchaseId = intval($_GET['purchase_id']); // Converte el dato a entero

// Obtener la información del pedido
$sql = "SELECT * FROM pedido WHERE id_pedido = ?";
$stmt = $conectar->prepare($sql);
$stmt->bind_param('i', $purchaseId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Error: No se encontró el pedido con el ID especificado.";
    exit();
}

$purchase = $result->fetch_assoc();

// Oconsulta para obtener los datos de los pedidos
$sqlProducts = "SELECT r.cantidad, r.precio, p.nombre 
                FROM recibo r 
                JOIN producto p ON r.id_producto = p.id_producto
                WHERE r.id_pedido = ?";
$stmtProducts = $conectar->prepare($sqlProducts);
$stmtProducts->bind_param('i', $purchaseId);
$stmtProducts->execute();
$productsResult = $stmtProducts->get_result();

?>

<!-- Enlace al archivo CSS -->
<head>
    <link rel="stylesheet" href="../styles/ticket01.css">
</head>

<!-- Mostrar ticket -->
<div id='ticket' class='ticket'>
    <div class='ticket-header'>
        <h1>Emilia's Bakery</h1>
        <p>Folio ticket: <?php echo $purchase['id_pedido']; ?></p>
    </div>

    <div class='ticket-info'>
        <p><strong>Fecha y hora:</strong> <?php echo date("d/m/Y H:i", strtotime($purchase['fecha_compra'])); ?></p>
        <p><strong>Tipo de Envío:</strong> <?php echo ucfirst(htmlspecialchars($purchase['tipo_envio'])); ?></p>
        <p><strong>Metódo de Pago:</strong> <?php echo ucfirst(htmlspecialchars($purchase['tipo_pago'])); ?></p>
        <p><strong>Pago:</strong> <?php echo ucfirst(htmlspecialchars($purchase['estado'])); ?></p>

        <h3>Productos comprados:</h3>
        <table class='ticket-table'>
            <thead>
                <tr>
                    <th>Cant.</th>
                    <th>Producto</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $totalAmount = 0;
            while ($product = $productsResult->fetch_assoc()) {
                $productTotal = $product['cantidad'] * $product['precio'];
                echo "<tr>
                        <td>" . $product['cantidad'] . "</td>
                        <td>" . htmlspecialchars($product['nombre']) . "</td>
                        <td>$" . number_format($product['precio'], 2) . "</td>
                        <td>$" . number_format($productTotal, 2) . "</td>
                    </tr>";
                $totalAmount += $productTotal;
            }
            ?>
            </tbody>
        </table>

        <div class='ticket-footer'>
            <p><strong>Total: </strong> $<?php echo number_format($totalAmount, 2); ?> MX</p>
            <small>Son <?php echo convertNumberToWords($totalAmount); ?>.</small>
            <p>!AGRADECEMOS SU PREFERENCIA, VUELVA PRONTO!</p>
        </div>
    </div>
</div>

<!-- Botón para imprimir -->
<button onclick='printTicket()'>Imprimir Ticket</button>

<!-- Botón para regresar al index -->
<button onclick='goBackToIndex()'>Volver a la Página Principal</button>

<script>
// Función para imprimir el ticket
function printTicket() {
    const ticketContent = document.getElementById('ticket').innerHTML;
    const originalContent = document.body.innerHTML;

    // Mostrar solo el contenido del ticket
    document.body.innerHTML = ticketContent;
    window.print();

    // Restaurar contenido original después de imprimir
    document.body.innerHTML = originalContent;
    location.reload(); // Recargar la página para evitar problemas
}

// Función para redirigir al index
function goBackToIndex() {
    window.location.href = '../index.php'; 
    localStorage.removeItem('agregar-carrito');
}

// Detectar cuando el usuario presiona el botón de retroceder (en el navegador)
window.onpopstate = function(event) {
    window.location.href = '../index.php'; // Redirige al index si el usuario navega hacia atras
    localStorage.removeItem('agregar-carrito');
};

// Agregar una entrada en el historial para que funcione correctamente la detección del retroceso
history.pushState(null, '', location.href);

   // Obtener el parámetro success de la URL
   const urlParams = new URLSearchParams(window.location.search);
    const success = urlParams.get('success');

    if (success === 'true') {
        // Mostrar mensaje de compra exitosa
        alert("¡Compra exitosa! Gracias por tu compra.");
    }
</script>

<?php
// Cerrar conexión
$stmt->close();
$stmtProducts->close();
$conectar->close();

// Función para convertir el número a palabras (para cantidades en ticket)
function convertNumberToWords($number) {
    $units = [
        0 => 'cero', 1 => 'uno', 2 => 'dos', 3 => 'tres', 4 => 'cuatro',
        5 => 'cinco', 6 => 'seis', 7 => 'siete', 8 => 'ocho', 9 => 'nueve',
        10 => 'diez', 11 => 'once', 12 => 'doce', 13 => 'trece', 14 => 'catorce',
        15 => 'quince', 16 => 'dieciséis', 17 => 'diecisiete', 18 => 'dieciocho', 19 => 'diecinueve',
        20 => 'veinte'
    ];

    if ($number <= 20) {
        return $units[$number];
    }

    $tens = [
        30 => 'treinta', 40 => 'cuarenta', 50 => 'cincuenta', 60 => 'sesenta',
        70 => 'setenta', 80 => 'ochenta', 90 => 'noventa'
    ];

    if ($number < 30) {
        return 'veinti' . $units[$number - 20];
    }

    if ($number < 100) {
        $tensPart = floor($number / 10) * 10;
        $unitsPart = $number % 10;

        if ($unitsPart == 0) {
            return $tens[$tensPart];
        } else {
            return $tens[$tensPart] . " y " . $units[$unitsPart];
        }
    }

    
    return $number;  // Retorna el número
}
?>
