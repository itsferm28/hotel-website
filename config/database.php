<?php
    #php -S localhost:3001
    $db = mysqli_connect('localhost:3306','root','admin','proyectofinal');
    if(!$db){
        echo "Error de conexion a base de datos<br>";
    }/*else{
        echo "Conexion Exitosa<br>";
    }*/
    ?>