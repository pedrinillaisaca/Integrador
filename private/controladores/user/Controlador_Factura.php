<?php

    include '../../../config/conexionBD.php';
    if($_POST['metodo']=='getDatos'){
        getDatosPersona();
    }elseif ($_POST['metodo']=='mostrar_facturas'){
        mostrarFacturas();
    }elseif ($_POST['metodo'] == 'crear_factura'){
        crearFactura();
    }

    function getDatosPersona(){
        global $conn;
        $persona_nombre ='';
        $persona_correo = '';
        $persona_telefono = '';
        $persona_direccion = '';
        $persona_cedula = '';

        $persona = $_POST['cli_id'];
        $sql_fac = "select max(factura_id) as maximo from factura_cabecera";
        $sql = "select * from persona where per_id = '$persona'";
        $resultados = $conn->query($sql);
        $id_fac = $conn->query($sql_fac);
        $id = 0;
        while($row = $id_fac->fetch_assoc()){
            $id = $row['maximo'] + 1;
        }

        if($resultados->num_rows > 0){
            while($row = $resultados->fetch_assoc()){
                $persona_nombre = $row['per_nombre'] . ' ' . $row['per_apellido'];
                $persona_correo = $row['per_email'];
                $persona_telefono = $row['per_telefono'];
                $persona_direccion = $row['per_direccion'];
                $persona_cedula = $row['per_cedula'];
            }
            echo $id . '|' . $persona_nombre .'|'.$persona_correo .'|'.$persona_telefono .'|'.$persona_direccion . '|' . $persona_cedula;
        }

        $conn->close();
    }

    function mostrarFacturas(){
        global $conn;
        $sqlCabecera = 'select * from carrito_cabecera where (select max(carrito_id)) = carrito_id and fk_persona_carrito=20';
        $result = $conn->query($sqlCabecera);

        $subtotal = 0;
        $total = 0;
        $id_persona = 0;

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $carrito_id = $row['carrito_id'];
                $subtotal = $row['carrito_subtotal'];
                $total = $row['fk_persona_carrito'];
                $id_persona = $row['fk_persona_carrito'];

                $sqlDetalle = "select carrito_det_cantidad, p.producto_nombre as prod_nombre, carrito_det_total from carrito_detalle, (select producto_nombre, producto_id from producto) as p
                where fk_carrito_cabecera = '$carrito_id' && producto_id = fk_carrito_producto";
                $detalles = $conn->query($sqlDetalle);
                if($detalles->num_rows>0){
                    echo "<table class='container'>";
                    echo "<tr>";
                    echo "<th>CANTIDAD</th>";
                    echo "<th>PRODUCTO</th>";
                    echo "<th>TOTAL</th>";
                    echo "</tr>";
                    while($row_det = $detalles->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>" . $row_det['carrito_det_cantidad'] . "</td>";
                        echo "<td>" . $row_det['prod_nombre'] . "</td>";
                        echo "<td>" . $row_det['carrito_det_total'] . "</td>";
                        echo "</tr>";
                    }
                    echo "<tr>";
                    echo "<td colspan='2' style='text-align: right; padding-right: 20px'>Subtotal:</td>";
                    echo "<td id='cmpSubtotal'>$subtotal</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td colspan='2' style='text-align: right; padding-right: 20px'>TOTAL:</td>";
                    $subtotal = $subtotal+1.50;
                    echo "<td id='cmpTotal'>$subtotal</td>";
                    echo "</tr>";
                    echo "</table>";
                    echo "||".$carrito_id;
                }
            }
        }
        $conn->close();
    }

    function crearFactura(){
        global $conn;
        $carrito_id = $_POST['carrito_id'];
        $sql = "insert into factura_cabecera(factura_date, factura_total, fk_persona_factura) select now(), carrito_total, fk_persona_carrito from carrito_cabecera where carrito_id = '$carrito_id'";
        if($conn->query($sql)){
            $sql = "insert into factura_detalle(factura_cantidad, factura_precio_unit, factura_precio_total, fk_factura_det_producto, fk_factura_det_factura_cabecera) 
                select carrito_det_cantidad, carrito_det_total/carrito_det_cantidad, carrito_det_total, fk_carrito_producto,
                       maximo.mx  from carrito_detalle, (select max(factura_id) as mx from factura_cabecera) as maximo where fk_carrito_cabecera='13'";
            if($conn->query($sql)){
                echo "Se ha insertado la factura correctamente. 'Dont worry, be happy'";
            }
        }
        echo $sql;
    }

?>