<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Eliminar datos de persona </title>
</head>
<body>
<h3>Eliminar datos de usuario</h3>
<?php
session_start();
if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){
    header("Location: /Bellisima/public/home/vista/login.html");
}
//incluir conexión a la base de datos
include '../../../config/conexionBD.php';
$codigo = $_POST["codigo"];
echo $codigo;

//Si voy a eliminar físicamente el registro de la tabla
//$sql = "DELETE FROM usuario WHERE codigo = '$codigo'";
date_default_timezone_set("America/Guayaquil");
$fecha = date('Y-m-d H:i:s', time());
$sql = "UPDATE persona SET per_eliminado = 'S', per_fecha_mod = '$fecha' WHERE
per_id = $codigo";
if ($conn->query($sql) === TRUE) {
    echo "<p>Se ha eliminado los datos correctamemte!!!</p>";
} else {
    echo "<p>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>";
}
echo "<a href='../../vista/usuario/index.php'>Regresar</a>";
$conn->close();

?>
</body>
</html>