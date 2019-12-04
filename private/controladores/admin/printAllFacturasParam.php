<?php 

$indicador=$_GET['indicador'];
$parametro=$_GET['parametro'];
include '../../../config/conexionBD.php';

$sql="";
if ('fecha'==$indicador) {
    $sql= "SELECT factura_cabecera.factura_estado AS estado ,factura_cabecera.factura_id AS idfactura, factura_cabecera.factura_date AS fecha , CONCAT(persona.per_nombre,' ',persona.per_apellido) AS nombre, persona.per_email AS correo
    FROM persona  , factura_cabecera  WHERE persona.per_id=factura_cabecera.fk_persona_factura AND factura_cabecera.factura_date='$parametro';";
    
}
if ('correo'==$indicador) {
    $sql= "SELECT factura_cabecera.factura_estado AS estado ,factura_cabecera.factura_id AS idfactura, factura_cabecera.factura_date AS fecha , CONCAT(persona.per_nombre,' ',persona.per_apellido) AS nombre, persona.per_email AS correo
    FROM persona  , factura_cabecera  WHERE persona.per_id=factura_cabecera.fk_persona_factura AND persona.per_email='$parametro';";
}



$result = $conn->query($sql);



echo"
<table style='width:100%' class='tabla'>
<tr>
    <th>Estado Válida= V, Anulada=A </th>
    <th>Factura Numero</th>
    <th>Fecha Emisión</th>
    <th>Generado por:</th>
    <th>Correo Titular</th>    
    <th>Modificar</th>
</tr>";


if ($result->num_rows > 0) {

    
    while ($row = $result->fetch_assoc()) {        
        echo "<tr>";
        echo "   <td>" . $row["estado"] . "</td>";
        echo "   <td>" . $row['idfactura'] . "</td>";
        echo "   <td>" . $row['fecha'] . "</td>";
        echo "   <td>" . $row['nombre'] . "</td>";
        echo "   <td>" . $row['correo'] . "</td>";
                        
        echo "<td> 
        <select  required name='estado' id='estadoFactura".$row["idfactura"]."' >
        <option value=''>Cambiar de Estado</option>
        <option value='V'>V = Válida</option>
        <option value='A'>A = Anulada</option>    
        </select>
        
        <input type='button' id='boton' name='boton' value='Cambiar' onclick='cambiarEstadoFactura(".$row['idfactura'].")'>
        <input type='button' id='boton1' name='boton1' value='Visualizar' onclick='verFacturaCompleta(".$row['idfactura'].")'>
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
