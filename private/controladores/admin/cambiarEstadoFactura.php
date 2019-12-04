<?php 
include '../../../config/conexionBD.php';


$factura_id = $_GET["factura_id"];     
$factura_estado = $_GET["factura_estado"];     
 
//Si voy a eliminar físicamente el registro de la tabla 
//$sql = "DELETE FROM usuario WHERE codigo = '$codigo'"; date_default_timezone_set("America/Guayaquil"); 
 


$sql= "UPDATE `factura_cabecera` SET `factura_estado`='$factura_estado'
 WHERE `factura_id`=$factura_id";


if ($conn->query($sql) === TRUE) {         
    echo "<p>Modificacion Correcta !!</p>";      
} else {         
    echo "<p>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>";         
} 

//header("Location: ../../vista/admin/gestionPedidos.html");
$conn->close(); 


?>