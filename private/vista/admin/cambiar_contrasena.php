<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cambiar contrasena</title>
    <script type="text/javascript" src="../../controladores/admin/metodos.js"></script>
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){
    header("Location: ../../../public/home/vista/login.html");
}
$codigo = $_GET["codigo"];
?>
<form id="formulario01" method="POST" onsubmit="return cambiar_contrasena()" action="">

    <input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo ?>" />
    <label for="cedula">Contraseña Actual (*)</label>
    <input type="password" id="contrasena1" name="contrasena1" value="" required
           placeholder="Ingrese su contraseña actual ..."/>
    <br>
    <label for="cedula">Contraseña Nueva (*)</label>
    <input type="password" id="contrasena2" name="contrasena2" value="" required
           placeholder="Ingrese su contraseña nueva ..."/>
    <br>

    <input type="submit" id="modificar" name="modificar" value="Modificar" onclick="return cambiar_contrasena()" />
    <input type="reset" id="cancelar" name="cancelar" value="Cancelar" />
</form>
<div id="informacion"><b>Datos de la persona</b></div>
</body>
</html>