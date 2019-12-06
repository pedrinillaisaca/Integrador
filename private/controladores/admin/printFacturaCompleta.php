<?php 

$idFactura=$_GET['idFactura'];

include '../../../config/conexionBD.php';
//echo"<p> Aqui se tiene que imprimir  la factura con id ".$idFactura."</p> ";//;PILAS
//header('Location: ../../vista/admin/htmlFactura.html');


echo "
<html>
<head>
<title>Mostrar un enlace en una iframe</title>
</head>
<body>
<div >
    <iframe src='../../vista/admin/htmlFactura.php?id_factura=".$idFactura."

    marginwidth='0' marginheight='0' name='ventana_iframe' scrolling='no' border='0' 
    
    frameborder='0' width='80%' height='500px%'>
    </iframe>
</div>
</body>
</html>
";

?>
