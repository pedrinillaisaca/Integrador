<?php

$lon=$_GET['lon'];
$lat=$_GET['lat'];
//$url="../examples/index.php";


echo"

<!DOCTYPE html>
<html>

<head>
    <!--PEDRO ES LA OSTIA-->
    <meta charset='UTF-8' />
    <title>Leaflet OSRM Example</title>
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
    <link rel='stylesheet' href='https://unpkg.com/leaflet@1.3.1/dist/leaflet.css' />
    <link rel='stylesheet' href='../dist/leaflet-routing-machine.css' />
    <link rel='stylesheet' href='index.css' />
    
</head>
<body >
<input type='hidden' id='lon' name='lon' value='".$lon."'>
<input type='hidden' id='lat' name='lat' value='".$lat."'>

    <div id='map' class='map'></div>
    <script src='https://unpkg.com/leaflet@1.3.1/dist/leaflet.js'></script>
    <script src='../dist/leaflet-routing-machine.js'></script>
    <script src='Control.Geocoder.js'></script>
    <script src='config.js'></script>
    <script src='index.js'></script>


    

</body>


</html>


";


?>
