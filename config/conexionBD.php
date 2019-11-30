<?php
$db_servername = "18.210.137.23";
 $db_username = "admin";
 $db_password = "rootpassword";
 $db_name = "bellisima";

 $conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
 $conn->set_charset("utf8");
$moneda			= '&#36; '; //símbolo de moneda
$costo_emvio		= 1.50; //costo de envío
$impuesto				= array( //Lista tu porcentaje de impuestos aquí.
    'iva' => 12,
    'impuesto a la renta' => 5,
    'otro impuesto' => 10
);
 # Probar conexión
 if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
 }else{
 
 }
?>