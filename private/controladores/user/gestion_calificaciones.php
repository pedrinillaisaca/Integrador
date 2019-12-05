<?php
session_start();
include("../../../config/conexionBD.php"); //include config file

if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){
header("Location: /Bellisima/public/home/vista/login.html");
}else {
$codigo_persona = $_GET["id_usuario"];
$codigo_producto = $_GET["id_producto"];
$calificacion = $_GET["calificacion"];
//incluir conexión a la base de datos
include("../../../config/conexionBD.php"); //include config file
$sql = "INSERT INTO calificacion_comentario VALUES (0,'N','null', $calificacion,$codigo_persona, $codigo_producto)";
$conn->query($sql);

header("Location: /Bellisima/private/vista/user/vercalificacion.php?codigo_persona=$calificacion");
}
?>