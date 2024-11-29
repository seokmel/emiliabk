<?php
require('conexion.php');

if (isset($_POST['id_admin']) && isset($_POST['estatus'])) {
    $id_admin = $_POST['id_admin'];
    $estado = $_POST['estatus'];

    // Consulta para actualizar el estado del administrador
    $query = "UPDATE admin SET estatus = ? WHERE id_admin = ?";

    if ($stmt = $conectar->prepare($query)) {
        $stmt->bind_param("si", $estado, $id_admin);
        if ($stmt->execute()) {
            echo "<script>alert('Estado del administrador actualizado correctamente.'); window.location.href = '../usuarios-admin.php';</script>";
        } else {
            echo "Error al actualizar estado: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conectar->error;
    }

    $conectar->close();
}
?>

