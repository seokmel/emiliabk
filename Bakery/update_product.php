<?php

include 'functions/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $passAdmin = $_POST['passAdmin']; // Contraseña que ingresó el admin

    $sqlpass = "SELECT passAdmin FROM admin WHERE passAdmin IS NOT NULL";
    $stmt = $conectar->prepare($sqlpass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $passwordValida = false;

        while ($row = $result->fetch_assoc()) {
            $hashedPassword = $row['passAdmin'];
            if (password_verify($passAdmin, $hashedPassword)) {
                $passwordValida = true;
                break;
            }
        }
        if (!$passwordValida) {
            die('Contraseña de administrador incorrecta. Acceso denegado.');
        }
    } else {
        die('No se encontraron contraseñas en la base de datos.');
    }

    $id_producto = $_POST['id_producto']; 
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $stock = $_POST['cantidad'];

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) { // Revisar si se subió una nueva imagen
        $imagen = $_FILES['imagen'];
        $imagen_nombre = $imagen['name'];
        $imagen_temp = $imagen['tmp_name'];

        $imagen_tipo = mime_content_type($imagen_temp); // Validar el tipo de imagen
        if (!in_array($imagen_tipo, ['image/jpeg', 'image/png'])) {
            die('El archivo no es una imagen válida.');
        }

        if (!is_dir('media')) { // Verificar si la carpeta media existe
            mkdir('media', 0777, true); // Crear la carpeta si no existe
        }

        $imagen_nombre_unico = time() . '_' . $imagen_nombre;
        $ruta_imagen = 'media/' . $imagen_nombre_unico;
        move_uploaded_file($imagen_temp, $ruta_imagen);

    } else {
        $ruta_imagen = $_POST['imagen_anterior']; // Si no se subió nueva imagen, mantener la imagen anterior
    }

    $sql = "UPDATE producto SET nombre = ?, precio = ?, descripcion = ?, cantidad = ?, imagen = ? WHERE id_producto = ?";
    $stmt = $conectar->prepare($sql);
    $stmt->bind_param('sdssss', $nombre, $precio, $descripcion, $stock, $ruta_imagen, $id_producto);
    $stmt->execute();

    header("Location: actproduct.php?msg=success");
    exit;
}
?>
