<?php
session_start();
include("../../../config/conexionBD.php"); //include config file

if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){
    header("Location: /Bellisima/public/home/vista/login.html");
}else {
    $codigo_persona = $_GET["id_usuario"];
    $codigo_cabecera = $_GET["id_cabecera"];
//incluir conexión a la base de datos
    include("../../../config/conexionBD.php"); //include config file
    $sql = "UPDATE carrito_cabecera SET carrito_eliminado='S' where  carrito_id=$codigo_cabecera and  fk_persona_carrito=$codigo_persona";
    $conn->query($sql);
    $sql1 = "UPDATE carrito_detalle SET carrito_det_eliminado='S'  where fk_carrito_cabecera=$codigo_cabecera";
    $conn->query($sql1);
    header("Location: /Bellisima/private/vista/user/compra.php?codigo_persona=$codigo_persona");
}
?>
