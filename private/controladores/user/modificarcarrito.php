<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gestión de carrito</title>
    <script src="../../../private/controladores/user/proceso_carrito.js"></script>
</head>
<body>
<div id="informacion">informacion sobre todos sus productos en el carrito
    <table style="width:100%">
        <tr>
            <th>producto nombre</th>
            <th>cantidad</th>
            <th>precio</th>
            <th>color</th>
            <th>subtotal</th>
        </tr>
        <?php
        session_start();
        include("../../../config/conexionBD.php"); //include config file

        if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){
            header("Location: /Bellisima/private/public/home/vista/login.html");
        }
        //incluir conexión a la base de datos
        include("../../../config/conexionBD.php"); //include config file
        $codigo = $_GET["codigo_detalle"];
        /*PARA LA ACTUALIZACION TOTAL*/
        $codigo_user = $_REQUEST["codigo_usuario"];
        $cantidad = $_REQUEST["cantidad"];
        $producto_id=$_REQUEST["codigo_producto"];

        /*FINNNNNNNNNNNNNNNNNNNNN*/
        $cabecera=0;

        $sqlupdatet = "UPDATE carrito_detalle SET carrito_det_cantidad = $cantidad WHERE
carrito_det_id = $codigo and carrito_det_eliminado='N'" ;
        $re32 = $conn->query($sqlupdatet);


        /*para actualizar el total a pagar*/

        $precio =0;
        $cabecera = 0;
        $totalcabecera = 0;
        $subtotalcabecera=0;


        $sqlsubtotal = "SELECT producto_precio FROM producto WHERE producto_id=$producto_id";
        $resultpro = $conn->query($sqlsubtotal);
        if ($resultpro->num_rows > 0) {
            while ($row = $resultpro->fetch_assoc()) {
                $precio = $row["producto_precio"];

            }
        }
        $subtotal = $precio * $cantidad;

        $sqlupdatet1 = "UPDATE carrito_detalle SET carrito_det_total = $subtotal WHERE
carrito_det_id = $codigo and carrito_det_eliminado='N'" ;
        $re323 = $conn->query($sqlupdatet1);


        $sqlcabecera = "SELECT * FROM carrito_cabecera WHERE fk_persona_carrito=$codigo_user and carrito_eliminado='N'";
        $resultcabecera = $conn->query($sqlcabecera);
        if ($resultcabecera->num_rows > 0) {
            while ($row = $resultcabecera->fetch_assoc()) {
                $cabecera = $row["carrito_id"];
            }


            $sqlsumasubtotal = "SELECT SUM(carrito_det_total) as suma FROM carrito_detalle ,carrito_cabecera WHERE fk_persona_carrito=$codigo_user and fk_carrito_cabecera=$cabecera and  carrito_det_eliminado='N'";
            $re = $conn->query($sqlsumasubtotal);
            if ($re->num_rows > 0) {
                while ($row = $re->fetch_assoc()) {
                    $subtotalcabecera = $row["suma"];
                }
            }
        }
            $totalcabecera = $costo_emvio + $subtotalcabecera;
            $sqlupdate33 = "UPDATE carrito_cabecera SET carrito_subtotal = $subtotalcabecera where fk_persona_carrito=$codigo_user AND carrito_eliminado='N'";
            $conn->query($sqlupdate33);
            $sqlupdate43 = "UPDATE carrito_cabecera SET carrito_total = $totalcabecera where fk_persona_carrito=$codigo_user AND carrito_eliminado='N'";
            $conn->query($sqlupdate43);


        /*FIN ACTUALIZAR*/


        $sql = "select * from carrito_cabecera ,carrito_detalle ,producto where fk_carrito_cabecera=$cabecera and fk_persona_carrito=$codigo_user and fk_carrito_producto=producto_id and carrito_det_eliminado='N'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo " <td>" . $row["producto_nombre"] . "</td>";
                echo " <td contenteditable>" . $row['carrito_det_cantidad'] ."</td>";
                echo " <td>" . $moneda.$row['producto_precio'] . "</td>";
                echo " <td>" . $row['producto_color'] . "</td>";
                echo " <td>" . $row['carrito_det_total'] . "</td>";
                $subtotal=$row['carrito_subtotal'];
                $total=$row['carrito_total'];
                $idpersona= '6'.$row["fk_persona_carrito"];
                $idcantidad='7'.$row["carrito_det_cantidad"];
                $idcarritodetalle='8'.$row["carrito_det_id"];
                $idproducto='9'.$row["producto_id"];
                echo "<input name='codigo user' id='$idpersona' type='hidden' value='{$row["fk_persona_carrito"]}'>";
                echo "<input name='cantidad' id='$idcantidad' type='hidden' value='{$row["carrito_det_cantidad"]}'>";
                echo "<input name='producto_id' id='$idcarritodetalle' type='hidden' value='{$row["carrito_det_id"]}'>";
                echo "<input name='producto_id' id='$idproducto' type='hidden' value='{$row["producto_id"]}'>";
                echo "<td><input type='button' id='agregar' name='agregar' value='Eliminar' onclick='eliminar($idpersona,$idcantidad,$idcarritodetalle,$idproducto)'</td>";
                echo "<td><input type='button' id='editar' name='agregar' value='Editar' onclick='capturar($idpersona,$idcarritodetalle,$idproducto)'</td>";
            }
            echo "<tr>";
            echo " <td colspan='3'> </td>";
            echo " <td>Subtotal </td>";
            echo " <td>" . $moneda.$subtotal . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo " <td colspan='3'> </td>";
            echo " <td>Costo de Emvio </td>";
            echo " <td>" . $moneda.$costo_emvio . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo " <td colspan='3'> </td>";
            echo " <td>Total a pagar</td>";
            echo " <td>" . $moneda.$total . "</td>";
            echo "</tr>";
            echo "</tr>";

            echo "<tr>";
            echo " <td colspan='3'> </td>";
            echo " <td>confirmar compra</td>";
            echo " <td><a href='../../../private/controladores/user/comprar.php?id_usuario=$codigo_user&id_cabecera=$codigo_cabecera'>COMPRAR</a> </td>";
            echo "</tr>";
            echo "</tr>";



        } else {
            echo "<tr>";
            echo " <td colspan='7'> No existen productos agregados en el carrito </td>";
            echo "</tr>";
        }

        $conn->close();

        ?>
</div>
</body>
</html>
