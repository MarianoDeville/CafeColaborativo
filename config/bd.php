<?php

    $host="localhost";
    $bd="cafeteria";
    //$usuario="mycafecola";
    $usuario="root";
    //$contraseña="UCjmuTN6";
    $contraseña="";

    try {
        
        $conexion=new PDO("mysql:host=$host;dbname=$bd", $usuario, $contraseña);

    } catch (Exception $ex) {
        
        echo $ex->getMessage();
    }
?>