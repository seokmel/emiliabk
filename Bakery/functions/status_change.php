<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Obtener los datos del formulario
    $id_producto = $_POST['id_producto'];
    $status = $_POST['estatus']; 
    $passAdmin = $_POST['passAdmin']; 

    $query = "SELECT passAdmin FROM admin WHERE passAdmin IS NOT NULL";
    if ($stmt = $conectar->prepare($query)) {
        $stmt->execute(); // Ejecuta la consulta
        $result = $stmt->get_result(); // Obtiene el resultado

        if ($result->num_rows > 0) {
            $passwordValida = false;

            // Validar la contraseña ingresada contra los hashes almacenados
            while ($row = $result->fetch_assoc()) {
                $hashedPassword = $row['passAdmin'];
                if (password_verify($passAdmin, $hashedPassword)) {
                    $passwordValida = true;
                    break;
                }
            }

            if ($passwordValida)

         {
            $sql = "UPDATE producto SET estatus = ? WHERE id_producto = ?";
            if ($stmt = $conectar->prepare($sql)) {
                $stmt->bind_param('ss', $status, $id_producto); 
                $stmt->execute(); // actualiza

                header("Location: ../status.php?msg=success");
                exit;
            }
        } else {
            header("Location: ../status.php?msg=error&error=invalid_password");
            exit;
        }
    }
  }
}

?>
