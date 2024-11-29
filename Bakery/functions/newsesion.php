<script type="text/javascript">

   		function errorDatos() {
   			alert("Todos los datos son requeridos");
         window.location.href="crear-cuenta.php";
            }
            function errorExiste() {
            	alert("Usuario ya existente");
              window.location.href="crear-cuenta.php";
            }
            function cuentaCreada() {
            	alert("Usuario creado exitisamente");
              window.location.href="crear-cuenta.php";
            }
            function noCoincide() {
            	alert("Las contraseñas no coinsiden");
              window.location.href="crear-cuenta.php";
            }
            function errorCrear() {
            	alert("A ocurrido un error :c, intentelo mas tarde");
              window.location.href="crear-cuenta.php";
            }
   </script>

<?php
 session_start();

 include('conexion.php');

 if (isset($_POST['nombres'])&& isset($_POST['pat_apellido']) && isset($_POST['mat_apellido']) && isset($_POST['telefono'])  && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['repetir']) ) {

    function validar ($data) {
        $data= trim($data);
        $data = stripslashes($data);
        $data= htmlspecialchars($data);
        return $data;
    }

    $nombre= validar($_POST['nombres']);
    $pat=validar ($_POST['pat_apellido']);
    $mat=validar($_POST['mat_apellido']);
    $telefono= validar($_POST['telefono']);
    $email= validar($_POST['email']);
    $pass= validar($_POST['password']);
    $repetir= validar($_POST['repetir']);

    if (empty($nombre)) {
        echo "<script>errorDatos();</script>";
        exit();
  }elseif(empty($pat)) {
    echo "<script>errorDatos();</script>";
    exit();
  }elseif (empty($mat)){
    echo "<script>errorDatos();</script>";
    exit();
  }elseif (empty($telefono)){
    echo "<script>errorDatos();</script>";
    exit();
  }elseif (empty($email)){
    echo "<script>errorDatos();</script>";
    exit();
  }elseif(empty($pass)) {
    echo "<script>errorDatos();</script>";
    exit();
}elseif(empty($repetir)) {
    echo "<script>errorDatos();</script>";
    exit();
    }elseif($pass !== $repetir) {
        echo "<script>noCoincide();</script>";
    exit();
    } else {
        $passEncrip= password_hash($pass, PASSWORD_DEFAULT); //encriptar password con hash

        $sql= "SELECT * FROM usuarios WHERE email = '$email' ";
        $query= $conectar ->query($sql);

        if (mysqli_num_rows($query)> 0) {
            echo "<script>errorExiste();</script>";
            exit();
        }else {
          $rol='cliente';
            $sql2= "INSERT INTO usuarios(nombres, pat_apellido, mat_apellido, telefono, email, password, rol) VALUES ('$nombre', '$pat','$mat','$telefono','$email','$passEncrip', '$rol')";
            $query2= $conectar -> query($sql2);

            if ($query2) {
                echo "<script>cuentaCreada();</script>";
                header('Location: ../index.php');
            exit();
            } else {
                echo "<script>errorCrear();</script>";
            exit();
       }
    }
  }
}else {
    header('Location: ../index.php');
    exit();
}

         