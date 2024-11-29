<?php
 
 $host= "localhost";
 $user= "root";
 $clave="";
 $bd="emiliabk";
 
 $conectar= mysqli_connect($host, $user, $clave, $bd);

 if(!$conectar) {
    echo "Conexión fallida :c"; 
}

?>