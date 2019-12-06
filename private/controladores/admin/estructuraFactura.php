<?php

    include '../../../config/conexionBD.php';
    if($_POST['metodo']=='getDatos'){
        getDatosPersona();
    }elseif ($_POST['metodo']=='mostrar_facturas'){
        mostrarFacturas();
    }

    function getDatosPersona(){
        global $conn;
        $persona_nombre ='';
        $persona_correo = '';
        $persona_telefono = '';
        $persona_direccion = '';
        $persona_cedula = '';

        //$persona = $_POST['cli_id'];//EN REALIDAD ES EL ID DE LA FACTURA
        //echo"<p> codigo Factura".$persona."</p>";
        $fact_id = $_POST['fact_id'];
        $sql="SELECT * FROM persona, factura_cabecera
        WHERE persona.per_id=factura_cabecera.fk_persona_factura AND factura_cabecera.factura_id=$fact_id;";
        
        //$sql = "select * from persona where per_id = '$persona'";
        $resultados = $conn->query($sql);

        //$id_fac = $conn->query($sql_fac);
        $id = 0;

        /*while($row = $id_fac->fetch_assoc()){
            $id = $row['maximo'] + 1;
        }*/

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

    function mostrarFacturas(){//AQUI VA LA CABECERA DE LA FACTURA
        global $conn;        
        //var_dump($_POST);
        $fact_id = $_POST['fact_id'];
        $sqlCabecera = "SELECT factura_cantidad AS cantidad , producto_nombre AS productoo, producto_precio AS precio_unit,(producto_precio*factura_cantidad) AS subtotal         
        FROM factura_detalle, factura_cabecera, producto
        WHERE factura_cabecera.factura_id= factura_detalle.fk_factura_det_factura_cabecera
        AND producto.producto_id=factura_detalle.fk_factura_det_producto
        AND factura_cabecera.factura_id=$fact_id;";

        $result = $conn->query($sqlCabecera);        
        $total = 0;
        $subtotal=0;
        echo "<table class='container'>";
        echo "<tr>";
        echo "<th>CANTIDAD</th>";
        echo "<th>PRODUCTO</th>";
        echo "<th>PRECIO UNITARIO</th>";
        echo "<th>IMPORTE</th>";
        echo "</tr>";

        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo "<td>" .$row['cantidad']. "</td>";
                echo "<td>" .$row['productoo']. "</td>";
                echo "<td>" .$row['precio_unit']. "</td>";
                echo "<td>" .$row['subtotal']. "</td>";
                $subtotal=$subtotal+$row['subtotal'];                
                echo "<tr>";                                                                
            }
            echo "<td colspan='3' style='text-align: right; padding-right: 20px'>Subtotal:</td>";
                echo "<td id='cmpSubtotal'>$subtotal</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td colspan='3' style='text-align: right; padding-right: 20px'>TOTAL:</td>";
                $total = $subtotal+1.50;
                echo "<td id='cmpTotal'>$total</td>";
                echo "</tr>";
            echo "</table>";   
        }
        $conn->close();
    }


    /** 
    function crearFactura(){
        global $conn;
        $carrito_id = $_POST['carrito_id'];
        $sql = "insert into factura_cabecera(factura_date, factura_total, fk_persona_factura) select now(), carrito_total, fk_persona_carrito from carrito_cabecera where carrito_id = '$carrito_id'";
        if($conn->query($sql)){
            $sql = "insert into factura_detalle(factura_cantidad, factura_precio_unit, factura_precio_total, fk_factura_det_producto, fk_factura_det_factura_cabecera) 
                select carrito_det_cantidad, carrito_det_total/carrito_det_cantidad, carrito_det_total, fk_carrito_producto,
                       maximo.mx  from carrito_detalle, (select max(factura_id) as mx from factura_cabecera) as maximo where fk_carrito_cabecera=$carrito_id";
            if($conn->query($sql)){
                echo "Se ha insertado la factura correctamente. 'Dont worry, be happy'";
            }else{
                echo "Error al ingresar el detalle de la factura";
            }
        }else{
            echo "Error al ingresar la cabecera";
        }
        $conn->close();
    }*/
?>