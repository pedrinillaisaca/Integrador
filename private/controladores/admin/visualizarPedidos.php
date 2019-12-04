<?php 

/**
 *  <input type='button' id='boton2' name='boton2' value='Trazar Ruta' onclick='trazarRutaMapa(".$row['per_longitud'].",".$row['per_latitud'].")'>
 */
$indicador=$_GET['indicador'];
$parametro=$_GET['parametro'];
include '../../../config/conexionBD.php';


$sql="";

if ('fechaPed'==$indicador) {
    $sql= "SELECT * FROM pedido,(SELECT factura_cabecera.factura_id AS fac_cab, CONCAT (per.per_nombre , ' ',  per.per_apellido) AS nombres,  per.per_longitud, per.per_latitud , per.per_email AS correo
    FROM persona per, factura_cabecera WHERE factura_cabecera.fk_persona_factura = per.per_id) AS leo 
    WHERE pedido.fk_pedido_factura = leo.fac_cab AND pedido_fecha='$parametro';";
    
}
if ('correoPed'==$indicador) {
    $sql= "SELECT * FROM pedido,(SELECT factura_cabecera.factura_id AS fac_cab, CONCAT (per.per_nombre , ' ',  per.per_apellido) AS nombres,  per.per_longitud, per.per_latitud , per.per_email AS correo
    FROM persona per, factura_cabecera WHERE factura_cabecera.fk_persona_factura = per.per_id) AS leo 
    WHERE pedido.fk_pedido_factura = leo.fac_cab  AND correo='$parametro';";
}


$result = $conn->query($sql);



echo"
<table style='width:100%' class='tabla'>
<tr>

    <th>Estado de pedido</th>
    <th>Fecha Creacion </th>
    <th>Generado por:</th>
    <th>Correo</th>
    <th>Modificar</th>
    <!--FALTA-->

</tr>";


if ($result->num_rows > 0) {

    $cont=0;
    while ($row = $result->fetch_assoc()) {
        $cont=$cont+1;
        echo "<tr>";
        echo "   <td>" . $row["pedido_estado"] . "</td>";
        echo "   <td>" . $row['pedido_fecha'] . "</td>";
        echo "   <td>" . $row['nombres'] . "</td>";
        echo "   <td>" . $row['correo'] . "</td>";
        echo "   <td style='display:none;'>" . $row['per_longitud'] . "</td>";
        echo "   <td style='display:none;'>" . $row['per_latitud'] . "</td>";
        echo "<td> 
        <select  required name='estado' id='estado".$row["pedido_id"]."' >
        <option value=''>Cambiar de Estado</option>
        <option value='C'>C = Creado</option>
        <option value='A'>A = Aceptado</option>
        <option value='E'>E = En camino</option>
        <option value='F'>F = Finalizado</option>
        <option value='R'>R = Rechazado</option>
        </select>
        
        <input type='button' id='boton' name='boton' value='Cambiar' onclick='cambiarEstado(".$row['pedido_id'].")'>
        <input type='button' id='prueba' name='prueba' value='Trazar Ruta' onclick='printMapa(".$row['per_longitud'].",".$row['per_latitud'].")'>                
        </td>";
        echo "</tr>";
        
    }
} else {
    echo "<tr>";
    echo "   <td colspan='7'> No hay registro en el sistema </td>";
    echo "</tr>";
}
$conn->close();


echo"</table>";

?>
