<?php
// Iniciar la sesión y configurar los encabezados para respuesta JSON
session_start();
header('Content-Type: application/json');

// Verificar si el usuario está logueado
if (!isset($_SESSION['email'])) {
    echo json_encode(['success' => false, 'message' => 'Debes iniciar sesión para realizar una compra.']);
    exit();
}

require('conexion.php');

// Obtener el email de la sesión
$email = $_SESSION['email'];

// Buscar el id del usuario logueado por el email
$stmt_id = $conectar->prepare("SELECT id_usuario FROM usuarios WHERE email = ?");
$stmt_id->bind_param("s", $email);
$stmt_id->execute();
$result = $stmt_id->get_result();

// Verificar si se encontró el usuario
if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'No se encontró el usuario con el correo proporcionado.']);
    exit();
}

$user_data = $result->fetch_assoc();
$user_id = $user_data['id_usuario'];
$stmt_id->close();

// Verificar si los datos se enviaron correctamente (formato JSON)
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'Datos inválidos.']);
    exit();
}

// Obtener los valores del JSON recibido
$colonia = $data['colonia'];
$calle = $data['calle'];
$numero_casa = $data['numero_casa'];
$codigo_postal = $data['codigo_postal'];
$referencia = $data['referencia'];
$fecha_creacion = date('Y-m-d H:i:s');

// Preparar y ejecutar la consulta de inserción
$stmt = $conectar->prepare("INSERT INTO domicilio (colonia, calle, num_casa, cp, referencia, id_usuario, fecha_creacion) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("sssisis", $colonia, $calle, $numero_casa, $codigo_postal, $referencia, $user_id, $fecha_creacion);

// Verificar si la inserción fue exitosa
if ($stmt->execute()) {
    // Enviar una respuesta JSON exitosa
    echo json_encode(['success' => true, 'message' => 'Domicilio guardado correctamente.', 'redirect' => 'form_pago.php?paymentType=electronic']);
} else {
    // Enviar una respuesta JSON con el error
    echo json_encode(['success' => false, 'message' => 'Hubo un problema al guardar la dirección: ' . $stmt->error]);
}

$stmt->close();

// Cerrar la conexión
$conectar->close();
?>
