<script type="text/javascript">

    function datosRegistrados() {
        alert("Tu Mensaje Fue Registrado Con Éxito!");
        window.location.href = "../contacto.php"; 
    }
     function datosNo(){
        alert("Lo sentimos!, tu mensaje no pudo ser enviado");
     }    window.location.href = "../contacto.php";
     function completaplis(){
        alert ('Por favor completa todos los campos solicitados!');
        window.location.href = "../contacto.php";
     }
    
</script>

<?php 
require 'conexion.php';

if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['telefono']) && isset($_POST['mensaje'])) {
    $nombres = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $mensaje = $_POST['mensaje'];

    // Consulta para insertar datos
    $insertar = "INSERT INTO contacto VALUES('', '$nombres', '$email', '$telefono', '$mensaje')";
    $query = mysqli_query($conectar, $insertar);

    if ($query) {
        echo "<script>datosRegistrados();</script>"; 
        exit();
    } else {
        echo "<script>datosNo();</script>"; 
        exit();
    }
} else {
    echo "<script>completaPlis();</script>"; 
    exit();
}

