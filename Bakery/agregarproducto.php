<script type="text/javascript">
    function agregado() {
        alert("Producto Agregado Exitosamente!");
        window.location.href = "newproduct.php";
    }
    function noAgregado(mensaje) {
        alert("Lo Sentimos, No Pudimos Completar La Petición: " + mensaje);
        window.location.href = "newproduct.php";
    }
</script>
<?php

include 'functions/conexion.php'; // conexion a la db

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Captura de datos y control de inyeccion sql
    $id_producto = $conectar->real_escape_string($_POST['id_producto']);
    $categoria = $conectar->real_escape_string($_POST['categoria']);
    $nombre = $conectar->real_escape_string($_POST['nombre']);
    $precio = $conectar->real_escape_string($_POST['precio']);
    $descripcion = $conectar->real_escape_string($_POST['descripcion']);
    $cantidad = $conectar->real_escape_string($_POST['cantidad']);
    $passAdmin = $conectar->real_escape_string($_POST['passAdmin']);

    $sqlpass = "SELECT passAdmin FROM admin WHERE passAdmin IS NOT NULL";
    $stmt = $conectar->prepare($sqlpass);
    if ($stmt) {
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $passwordValida = false;

            // Verificar cada hash de contraseña en la base de datos
            while ($row = $result->fetch_assoc()) {
                $hashedPassword = $row['passAdmin'];
                if (password_verify($passAdmin, $hashedPassword)) {
                    $passwordValida = true;
                    break;
                }
            }

            if ($passwordValida) {

    // para insertar imagen
    $imagen = $_FILES['imagen']['name'];  // obtiene el nombre de la imagen subida
    $imagen_tmp = $_FILES['imagen']['tmp_name']; // Ruta temporal donde php guarda el archivo subido
    $imagen_path = "media/" . basename($imagen); //ruta final donde se guardará el archivo 

    // saber si la imagen es del formato correcto
    if (getimagesize($imagen_tmp)) {
        // agrega la imagen a la carpeta media
        if (move_uploaded_file($imagen_tmp, $imagen_path)) {
            $sql = "INSERT INTO producto (id_producto, categoria, nombre, precio, descripcion, cantidad, imagen)
                    VALUES ('$id_producto', '$categoria', '$nombre', '$precio', '$descripcion', '$cantidad', '$imagen_path')";

            if ($conectar->query($sql) === TRUE) {
                echo "<script>agregado();</script>";
            } else {
                $errorMsg = addslashes($conectar->error);
                echo "<script>noAgregado('$errorMsg');</script>";// Dice pq el error
            }
        } else {
            echo "<script>alert('Error al subir la imagen.'); window.location.href='newproduct.php';</script>";
        }
    } else {
        echo "<script>alert('El archivo no es una imagen válida.'); window.location.href='newproduct.php';</script>";
    }
} else {
    // Si la contraseña es incorrecta
    echo "<script>alert('Contraseña incorrecta.'); window.location.href='newproduct.php';</script>";
}
    $conectar->close();
}
    }
}
?>
