<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gestión de usuarios</title>
    <link rel="stylesheet" href="../../../css/admin_index.css">
</head>
<body>
<h1 class="icono">&nbsp&nbsp&nbsp&nbsp&nbspGestion de usuarios</h1>
<input type="button" value="Cerrar Sesion"id="cerrar" onclick="window.open('../../../public/home/vista/index.php')" />
<table style="width:100%">
    <tr>
        <th>Rol</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Dirección</th>
        <th>Telefono</th>
        <th>Correo</th>
        <th>Actions</th>
    </tr>
    <?php
    session_start();
    if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){
        header("Location: /Bellisima/public/home/vista/login.html");
    }
    include '../../../config/conexionBD.php';
    $sql = "SELECT * FROM persona";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo " <td>" . $row["per_rol"] . "</td>";
            echo " <td>" . $row['per_nombre'] ."</td>";
            echo " <td>" . $row['per_apellido'] . "</td>";
            echo " <td>" . $row['per_direccion'] . "</td>";
            echo " <td>" . $row['per_telefono'] . "</td>";
            echo " <td>" . $row['per_email'] . "</td>";
            echo " <td> <a href='cambiar_contrasena.php?codigo=" . $row['per_id'] . "'>Cambiar
        contraseña</a> </td>";

            echo " <td> <a href='modificar.php?codigo=" . $row['per_id'] . "'>Modificar</a> </td>";
            echo " <td> <a href='eliminar.php?codigo=" . $row['per_id'] . "'>Eliminar</a> </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr>";
        echo " <td colspan='7'> No existen usuarios registradas en el sistema </td>";
        echo "</tr>";
    }
    $conn->close();
    ?>
</table>
</body>
</html>