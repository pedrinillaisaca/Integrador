<?php
//session_start();
//if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){
//    header("Location: ../../../public/home/vista/login.html");
//}
//$codigo = $_GET["codigo"];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Gestion de Pedidos y Facturas</title>
    <link rel="stylesheet" href="../../../css/tablas.css">
    <script type="text/javascript" src="gestionPedidos.js"></script>
</head>

<body onload="mostTodosPed()">
    </div>

    <h1>Gestion de Pedidos y Facturas</h1>

    <!--<option value="Generar Ruta">Generar Ruta</option>-->

    <div id="opciones">
        <select required name="visualizar" id="visualizar" onclick="if (typeof(this.selectedIndex) != 'undefined') checkOpPed(this.selectedIndex)">
            <option value="">Buscar Pedidos:</option>
            <option value="todosPedidos">Listar todos los Pedidos</option>
            <option value="fechaPed">Buscar Pedido por Fecha</option>
            <option value="correoPed">Buscar Pedido por Correo del titular</option>
            <option value="Visualizar Facturas">Buscar Facturas</option>
            <option value="Limpiar">Limpiar</option>

        </select>
        <input type="date" id="fechaPed" name="fechaPed" style="display: none;">
        <input type="text" id="correoPed" name="correoPed" placeholder="Ingresa el correo del titular" style="display: none;">
        <input type="button" id="ejecutar" name="ejecutar" value="Ejecutar" onclick="return ejecutar();">
    </div>




    <div id="opciones_de_factura">

        <select required name="buscarFactura" id="buscarFactura" onclick="if (typeof(this.selectedIndex) != 'undefined') checkOpFac(this.selectedIndex)">
            <option value="">Buscar por: </option>
            <option value="todas">Todas</option>
            <option value="fecha">Buscar por Fecha</option>
            <option value="correo">Buscar por Correo del titular</option>

        </select>
        <input type="date" id="fecha" name="fecha" style="display: none;">
        <input type="text" id="correo" name="correo" placeholder="Ingresa el correo del titular" style="display: none;">

        <input type="button" id="buscar" name="buscar" value="Buscar" onclick="return buscarFacturaParam()">


    </div>
    <br>

    <div id="divDinamico" style="clear: both;">


    </div>



</body>

</html>