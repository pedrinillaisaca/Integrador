
DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Eliminar datos de persona</title>
    <script type="text/javascript" src="../../controladores/admin/metodos.js"></script>
    <link rel="stylesheet" href="../../../css/eliminar.css">
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){
    header("Location: ../../../public/home/vista/login.html");
}


$codigo = $_GET["codigo"];

$sql = "SELECT * FROM persona where per_id=$codigo";
echo $sql;
include '../../../config/conexionBD.php';
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        ?>
        <form id="formulario01" method="POST" action="" onsubmit="return eliminar_registro()" >
            <h2>Eliminar usuario</h2>
            <input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo ?>" />
            <label for="ROL">Rol (*)</label>
            <input type="text" id="rol" name="rol" value="<?php echo $row["per_rol"]; ?>"
                   disabled/>
            <br>
            <label for="nombres">Nombres (*)</label>
            <input type="text" id="nombres" name="nombre" value="<?php echo $row["per_nombre"];
            ?>" disabled/>
            <br>
            <label for="apellidos">Apelidos (*)</label>
            <input type="text" id="apellidos" name="apellido" value="<?php echo $row["per_apellido"];
            ?>" disabled/>
            <br>
            <label for="direccion">Dirección (*)</label>
            <input type="text" id="direccion" name="direccion" value="<?php echo $row["per_direccion"];
            ?>" disabled/>
            <br>
            <label for="telefono">Teléfono (*)</label>
            <input type="text" id="telefono" name="telefono" value="<?php echo $row["per_telefono"];
            ?>" disabled/>
            <br>
            <label for="correo">Correo electrónico (*)</label>
            <input type="email" id="correo" name="correo" value="<?php echo $row["per_email"]; ?>"
                   disabled/>
            <br>

            <input type="submit" id="eliminar" name="eliminar" value="Eliminar" onclick="eliminar_registro()" />
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