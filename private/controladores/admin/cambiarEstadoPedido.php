<?php 
include '../../../config/conexionBD.php';


$pedido_id = $_GET["pedido_id"];     
$pedido_estado = $_GET["pedido_estado"];     
 
//Si voy a eliminar físicamente el registro de la tabla 
//$sql = "DELETE FROM usuario WHERE codigo = '$codigo'"; date_default_timezone_set("America/Guayaquil"); 
 


$sql= "UPDATE `pedido` SET `pedido_estado`='$pedido_estado'
 WHERE `pedido_id`=$pedido_id";


if ($conn->query($sql) === TRUE) {         
    echo "<p>Modificacion Correcta !!</p>";      
} else {         
    echo "<p>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>";         
} 

//header("Location: ../../vista/admin/gestionPedidos.html");
$conn->close(); 


?>
