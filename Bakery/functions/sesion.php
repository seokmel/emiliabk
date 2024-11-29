<script type="text/javascript">
  
   		function accesoDenegado() {
   			alert("usuario y/o contraseña incorrectos");
         window.location.href="../iniciar-sesion.php";
            }
            function errorDatos() {
            	alert("no dejar espacios en blanco");
              window.location.href="../iniciar-sesion.php";
            }
   </script>

<?php 
session_start();

include('conexion.php');

if (isset($_POST['email']) && isset($_POST['password'])) {
  
  function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  
  $email = validate($_POST['email']);
  $pass = validate($_POST['password']);

  if (empty($email)) {
    echo "<script>accesoDenegado();</script>";
    exit();
  } elseif (empty($pass)) {
    echo "<script>accesoDenegado();</script>";
    exit();
  } else {
    $sql = "SELECT * FROM usuarios WHERE email = '$email'"; //consulta a la db 

    $result = mysqli_query($conectar, $sql); 

    if (mysqli_num_rows($result) === 1) {
      $row = mysqli_fetch_assoc($result);

      if (password_verify($pass, $row['password'])) { // verificar si coinside la password encriptada
        $_SESSION['id_usuario'] = $row['id_usuario'];
        $_SESSION['nombres'] = $row['nombres'];
        $_SESSION['pat_apellido'] = $row['pat_apellido'];
        $_SESSION['mat_apellido'] = $row['mat_apellido'];
        $_SESSION['telefono'] = $row['telefono'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['rol'] = $row['rol'];

        // si es admin: 
        if ($row['rol'] === 'admin') {
          // verifica si la cuenta del admin esta activa
          $sql_admin = "SELECT estatus FROM admin WHERE id_usuario = '".$row['id_usuario']."'";
          $result_admin = mysqli_query($conectar, $sql_admin);

          if (mysqli_num_rows($result_admin) === 1) {
            $admin_data = mysqli_fetch_assoc($result_admin);
            if ($admin_data['estatus'] !== 'activo') {
              // si la cuenta esta inactiva no te dejara entrar
              echo "<script>alert('Tu cuenta de administrador está inactiva. No puedes iniciar sesión.'); window.location.href = '../iniciar-sesion.php';</script>";
              exit();
            }
          } else {
            // si no encuentra el admin en la tabla no te dejara entrar
            echo "<script>alert('No se encontró el estado del administrador.'); window.location.href = '../iniciar-sesion.php';</script>";
            exit();
          }
        }
        // redireccion segun su rol
        if ($row['rol'] === 'cliente') {
          header('location: ../index.php');
          exit();
        } elseif ($row['rol'] === 'admin') {
          header('location: ../index-admin.php');
          exit();
        }
      } else {
        echo "<script>accesoDenegado();</script>";
        exit();
      }
    } else {
      echo "<script>accesoDenegado();</script>"; 
      exit();
    }
  }
} 
?>
