<?php

$servidor = "18.210.137.23";
$usuario = "admin";
$password = "rootpassword";
$base = "bellisima";

$conn = new mysqli($servidor, $usuario, $password, $base);
$conn->set_charset('utf8');

if($conn->connect_error){
    die("Conexion Fallida".$conn->connect_error);
}else{
    echo "<p> A LA VRGGGG</p>";
}
?>
