<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <!--<link rel="stylesheet" href="../../../CSS/Style.css">-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>Gestión de usuarios</title>
    <script>function cerrarSesion(){
            let xml = new XMLHttpRequest();
            let url = '/Bellisima/private/controladores/admin/controladorSesion.php';
            xml.open('POST', url, true);
            xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xml.onreadystatechange = function () {
                if(this.readyState === 4 && this.status === 200){
                    alert(this.responseText);
                }
            };
            xml.send();
            window.open('../../../public/home/vista/index.php');
            //return false;
        }
    </script>
    <link rel="stylesheet" href="../../../css/admin_index.css">
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="../../../public/home/vista/index.php">Bellisima</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Gestion Usuarios</a></li>
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Actualizar datos</a></li>
                    <li><a href="#">Page 1-2</a></li>
                    <li><a href="#">Page 1-3</a></li>
                </ul>
            </li>
            <li><a href="#">Gestion productos</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="crear_usuario.html"><span class="glyphicon glyphicon-user"></span >Registrate</a></li>
            <li><a href="login.html"><button onclick="cerrarSesion()">Cerrar Sesion</button></a></li>
        </ul>
    </div>
</nav>
<h1 class="icono">&nbsp&nbsp&nbsp&nbsp&nbspGestion de usuarios</h1>



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
        header("Location: ../../../public/home/vista/login.html");
    }
    include '../../../config/conexionBD.php';
    $sql = "SELECT * FROM persona";
    $result = $conn->query($sql);
    $_SESSION['correo']=$_GET['correo'] ;
    $_SESSION['contrasena']=$_GET['contrasena'];
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
            echo " <td> <a href='../../vista/admin/modificar.php?codigo=" . $row['per_id'] . "'>Modificar</a> </td>";
            echo " <td> <a href='../../vista/admin/eliminar.php?codigo=" . $row['per_id'] . "'>Eliminar</a> </td>";
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