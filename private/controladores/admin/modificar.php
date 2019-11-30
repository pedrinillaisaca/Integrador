<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modificar datos de persona </title>
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){
    header("Location: /Bellisima/public/home/vista/login.html");
}
//incluir conexión a la base de datos
include '../../../config/conexionBD.php';
$codigo = $_POST["codigo"];
$rol =$_POST["rol"];
$nombres = isset($_POST["nombre"]) ? mb_strtoupper(trim($_POST["nombre"]), 'UTF-8') : null;
$apellidos = isset($_POST["apellido"]) ? mb_strtoupper(trim($_POST["apellido"]), 'UTF-8') : null;
$direccion = isset($_POST["direccion"]) ? mb_strtoupper(trim($_POST["direccion"]), 'UTF-8') : null;
$telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]): null;
$correo = isset($_POST["correo"]) ? trim($_POST["correo"]): null;
$fecha = date('Y-m-d H:i:s', time());
$sql = "UPDATE persona " .
    "SET per_rol = '$rol', " .
    "per_nombre = '$nombres', " .
    "per_apellido = '$apellidos', " .
    "per_direccion = '$direccion', " .
    "per_telefono = '$telefono', " .
    "per_email = '$correo', " .
    "per_fecha_mod = '$fecha' " .
    "WHERE per_id = $codigo";
if ($conn->query($sql) === TRUE) {
    echo "Se ha actualizado los datos personales correctamemte!!!<br>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn) . "<br>";
}
echo "<a href='../vista/usuario/index.php'>Regresar</a>";
$conn->close();

?>
</body>
</html>