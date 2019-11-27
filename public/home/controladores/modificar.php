<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">
 <title>Modificar datos de persona</title>
<script type="text/javascript" src="../controladores/crear_usuario.js"></script>	
</head>
<body>
 <?php
  session_start();
  if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){
  header("Location: /Bellisima/public/home/vista/login.html");
  }
 $codigo = $_GET["codigo"];
 $sql = "SELECT * FROM persona where per_id=$codigo";
 include '../../../config/conexionBD.php';
 $result = $conn->query($sql);

 if ($result->num_rows > 0) {

 while($row = $result->fetch_assoc()) {
 ?>
 <form id="formulario01" method="POST" action="../controladores/modificar.php">
 <input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo ?>" />
 <label for="cedula">Cedula (*)</label>
 <input type="text" id="cedula" name="cedula" value="<?php echo $row["per_id"]; ?>"
required placeholder="Ingrese la cedula ..."/>
 <br>
 <label for="nombre">Nombres (*)</label>
 <input type="text" id="nombre" name="nombre" value="<?php echo $row["per_nombre"];
?>" required placeholder="Ingrese los dos nombres ..."/>
 <br>
 <label for="apellido">Apelidos (*)</label>
 <input type="text" id="apellido" name="apellido" value="<?php echo $row["per_apellido"];
?>" required placeholder="Ingrese los dos apellidos ..."/>
 <br>
 <label for="direccion">Dirección (*)</label>
 <input type="text" id="direccion" name="direccion" value="<?php echo $row["per_direccion"];
?>" required placeholder="Ingrese la dirección ..."/>
 <br>
 <label for="telefono">Teléfono (*)</label>
 <input type="text" id="telefono" name="telefono" value="<?php echo $row["per_telefono"];
?>" required placeholder="Ingrese el teléfono ..."/>
 <br>
 <label for="correo">Correo (*)</label>
 <input type="email" id="correo" name="correo" value="<?php echo
$row["per_email"]; ?>" required placeholder="Ingrese su correo..."/>
 <br>
 <label for="password">Correo electrónico (*)</label>
 <input type="password" id="password" name="password" value="<?php echo $row["per_password"]; ?>"
required placeholder="Ingrese su contrasena ..."/>
 <br>

 <input type="submit" id="modificar" name="modificar" value="Modificar" />
 <input type="reset" id="cancelar" name="cancelar" value="Cancelar" />
 </form>
 <?php
 }
 } else {
 echo "<p>Ha ocurrido un error inesperado !</p>";
 echo "<p>" . mysqli_error($conn) . "</p>";
 }
 $conn->close();
 ?>
</body>
</html>