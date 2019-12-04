<?php
//maps/examples/index.php?lon=".$_GET['lon']."&lat=".$_GET['lat']."

echo "

<html>

<head>
<title>Mostrar un enlace en una iframe</title>
</head>

<body>

<div >
    <iframe src='../../vista/admin/maps/examples/index.php?lon=".$_GET['lon']."&lat=".$_GET['lat']."'
    marginwidth='0' marginheight='0' name='ventana_iframe' scrolling='no' border='0' 
    frameborder='0' width='80%' height='500px%'>
    </iframe>
</div>



</body>

</html>
";

?>