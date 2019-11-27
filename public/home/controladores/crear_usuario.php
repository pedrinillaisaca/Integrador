 <?php
include '../../../config/conexionBD.php';
 $nombres = $_POST['nombre'];
 $apellidos = $_POST['apellido'];
 $direccion = $_POST['direccion'];
 $telefono = $_POST['telefono'];
 $correo = $_POST['correo'];
 $contrasena = $_POST['password'];
 $sql = "INSERT INTO persona VALUES (0,'U','N', '$nombres', '$apellidos', '$direccion', '$telefono','$correo', MD5('$contrasena'),now(),NULL)";
 if ($conn->query($sql) === TRUE) {
 echo "Se ha creado los datos personales correctamemte!!!";

 } else {
 if($conn->errno == 1062){
 echo "<p class='error'>La persona con la cedula $cedula ya esta registrada en el sistema </p>";
  header("Location: ../vista/index.html");
 }else{
    echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
}
}
//cerrar la base de datos
$conn->close();




?>





