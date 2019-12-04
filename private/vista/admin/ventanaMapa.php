<?php

$lon=$_GET['lon'];
$lat=$_GET['lat'];

echo"
DESUSO CARAJPOOOOOOO
<!DOCTYPE html>
<html>

<head>
    <!--PEDRO ES LA OSTIA-->
    <meta charset='utf-8' />
    <title>Leaflet OSRM Example</title>
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
    <link rel='stylesheet' href='https://unpkg.com/leaflet@1.3.1/dist/leaflet.css' />
    <link rel='stylesheet' href='../../../css/leaflet-routing-machine.css'>
	<link rel='stylesheet' href='../../../css/index.css'>     
</head>

<body onload='startMapa(".$lon.",".$lat.")'>
    <div id='map' class='map'></div>
    <script src='https://unpkg.com/leaflet@1.3.1/dist/leaflet.js'></script>
    <script src='../../controladores/admin/leaflet-routing-machine.js'></script>
    <script src='../../controladores/admin/Control.Geocoder.js'></script>
    <script src='../../controladores/admin/config.js'></script>
    <script src='../../controladores/admin/index.js'></script>




</body>

</html>

";


?>