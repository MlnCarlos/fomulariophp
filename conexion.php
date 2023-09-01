<?php
$servidor = "localhost";
$user = "root";
$password = "";
$basededatos = "bdfactura";

$conexion = new mysqli($servidor, $user, $password, $basededatos);

if($conexion -> connect_errno){
    die("Error: ".$conexion -> connect_errno);
}
?>