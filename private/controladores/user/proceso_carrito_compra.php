<?php
include("../../../config/conexionBD.php"); //include config file
session_start(); //start session
$precio =0;
$cabecera = 0;
$cabecera2 = 0;
$totalcabecera = 0;
$subtotalcabecera=0;

if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){
    echo 0;
}else {
    echo 1;

    $producto_id = $_REQUEST["codigo_producto"];
    $codigo_user = $_REQUEST["codigo_usuario"];
    $cantidad = $_REQUEST["cantidad"];


    $sqlsubtotal = "SELECT producto_precio FROM producto WHERE producto_id=$producto_id";
    $resultpro = $conn->query($sqlsubtotal);
    if ($resultpro->num_rows > 0) {
        while ($row = $resultpro->fetch_assoc()) {
            $precio = $row["producto_precio"];

        }
    }
    $subtotal = $precio * $cantidad;


    $sqlcabecera = "SELECT * FROM carrito_cabecera WHERE fk_persona_carrito=$codigo_user AND  carrito_eliminado='N'";
    $resultcabecera = $conn->query($sqlcabecera);
    if ($resultcabecera->num_rows > 0) {
        while ($row = $resultcabecera->fetch_assoc()) {
            $cabecera = $row["carrito_id"];
        }
        $sql5 = "INSERT INTO carrito_detalle VALUES (0,'N', $cantidad,$subtotal, $producto_id,$cabecera)";
        $conn->query($sql5);

        $sqlsumasubtotal = "SELECT SUM(carrito_det_total) as suma FROM carrito_detalle ,carrito_cabecera WHERE fk_persona_carrito=$codigo_user and fk_carrito_cabecera=$cabecera and  carrito_det_eliminado='N' and carrito_eliminado='N'";
        $re = $conn->query($sqlsumasubtotal);
        if ($re->num_rows > 0) {
            while ($row = $re->fetch_assoc()) {
                $subtotalcabecera = $row["suma"];
            }
        }

        $totalcabecera = $costo_emvio + $subtotalcabecera;
        $sqlupdate3 = "UPDATE carrito_cabecera SET carrito_subtotal = $subtotalcabecera where fk_persona_carrito=$codigo_user AND carrito_eliminado='N'";
        $conn->query($sqlupdate3);
        $sqlupdate4 = "UPDATE carrito_cabecera SET carrito_total = $totalcabecera where fk_persona_carrito=$codigo_user AND carrito_eliminado='N'";
        $conn->query($sqlupdate4);

    } else {
        $sql = "INSERT INTO carrito_cabecera VALUES (0, 'N', 00.0000, 00.0000,$codigo_user)";
        $conn->query($sql);
        $sqlcabecera1 = "SELECT * FROM carrito_cabecera WHERE fk_persona_carrito=$codigo_user and carrito_eliminado='N'";
        $resultcabecera1 = $conn->query($sqlcabecera1);
        if ($resultcabecera1->num_rows > 0) {
            while ($row = $resultcabecera1->fetch_assoc()) {
                $cabecera = $row["carrito_id"];
            }
            $sql6 = "INSERT INTO carrito_detalle VALUES (0,'N',$cantidad,$subtotal, $producto_id,$cabecera) ;";
            $conn->query($sql6);
            $sqlsumasubtotal1 = "SELECT SUM(carrito_det_total) as suma FROM carrito_detalle ,carrito_cabecera WHERE fk_persona_carrito=$codigo_user and fk_carrito_cabecera=$cabecera and  carrito_det_eliminado='N' and carrito_eliminado='N'";
            $re1 = $conn->query($sqlsumasubtotal1);
            if ($re1->num_rows > 0) {
                while ($row = $re1->fetch_assoc()) {
                    $subtotalcabecera = $row["suma"];
                }
            }

            $totalcabecera = $costo_emvio + $subtotalcabecera;
            $sqlupdate = "UPDATE carrito_cabecera SET carrito_subtotal = $subtotalcabecera where fk_persona_carrito=$codigo_user and carrito_eliminado='N'";
            $conn->query($sqlupdate);
            $sqlupdate1 = "UPDATE carrito_cabecera SET carrito_total = $totalcabecera where fk_persona_carrito=$codigo_user and carrito_eliminado='N'";
            $conn->query($sqlupdate1);
        }

    }
}

$conn->close();
?>