<?php
session_start();
require('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombres = mysqli_real_escape_string($conectar, $_POST['nombres']);
    $pat_apellido = mysqli_real_escape_string($conectar, $_POST['pat_apellido']);
    $mat_apellido = mysqli_real_escape_string($conectar, $_POST['mat_apellido']);
    $telefono = mysqli_real_escape_string($conectar, $_POST['telefono']);
    $email = mysqli_real_escape_string($conectar, $_POST['email']);
    $password_usuario = mysqli_real_escape_string($conectar, $_POST['password_usuario']); // Contraseña ingresada por el usuario
    $contrasena_aleatoria = $_SESSION['contrasena_aleatoria']; //contraseña generada aleatoriamente
    $rol = 'admin';

    // encriptar la contraseña del usuario
    $password_encriptada_usuario = password_hash($password_usuario, PASSWORD_DEFAULT);

    // encriptar contraseña de admin generada aleatoriamente
    $password_encriptada_admin = password_hash($contrasena_aleatoria, PASSWORD_DEFAULT);

    // Estado inicial del admin
    $estado_admin = 'activo';

    $conectar->begin_transaction();

    try {
        // insertar info de la tabla de usuarios
        $query_usuarios = "INSERT INTO usuarios (nombres, pat_apellido, mat_apellido, telefono, email, password, rol) 
                           VALUES ('$nombres', '$pat_apellido', '$mat_apellido', '$telefono', '$email', '$password_encriptada_usuario', '$rol')";
        if (!$conectar->query($query_usuarios)) {
            throw new Exception("Error al insertar en usuarios: " . $conectar->error);
        }

        // obtener el id del admin q se acaba de insertar
        $id_usuario = $conectar->insert_id;

        // insertar el estado y el password en la tabla admin
        $query_admin = "INSERT INTO admin (id_usuario, passAdmin, estatus) 
                        VALUES ('$id_usuario', '$password_encriptada_admin', '$estado_admin')";
        if (!$conectar->query($query_admin)) {
            throw new Exception("Error al insertar en admin: " . $conectar->error);
        }

        $conectar->commit();

        // Mostrar la contraseña generada al admin (puedes enviarla por correo o mostrarla en pantalla)
        echo "<script>alert('Nuevo administrador agregado con éxito. Contraseña de admin: $contrasena_aleatoria_admin');</script>";
        header('location: ../usuarios-admin.php');
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $conectar->rollback();
        echo "Error: " . $e->getMessage();
    } finally {
        $conectar->close();
    }
}
?>
