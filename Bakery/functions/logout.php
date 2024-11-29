<?php
session_start();
session_unset(); 
session_destroy(); 

// Redirigir al formulario de inicio de sesión cuando la sesion se cerro
header("Location: ../index.php");
exit();
?>