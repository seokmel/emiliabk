<?php
session_start();

require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $id_usuario = $_SESSION['id_usuario']; 
    $nombres = $_POST['nombres'];
    $pat_apellido = $_POST['pat_apellido'];
    $mat_apellido = $_POST['mat_apellido'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    $sql = "UPDATE usuarios SET nombres = ?, pat_apellido = ?, mat_apellido = ?, telefono = ?, email = ? WHERE id_usuario= ?";
    $stmt = $conectar->prepare($sql);

    $stmt->bind_param("sssssi", $nombres, $pat_apellido, $mat_apellido, $telefono, $email, $id_usuario);

    
    if ($stmt->execute()) {
        // Actualizar los datos en la sesión para que se reflejen de inmediato
        $_SESSION['nombres'] = $nombres;
        $_SESSION['pat_apellido'] = $pat_apellido;
        $_SESSION['mat_apellido'] = $mat_apellido;
        $_SESSION['telefono'] = $telefono;
        $_SESSION['email'] = $email; 

        header('Location: ../datos.php');  
        exit();
    } else {
        echo "Error al actualizar los datos: " . $stmt->error;
    }

    $stmt->close();
    $conectar->close();
}
?>