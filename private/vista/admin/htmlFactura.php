
<?php 


$c=$_GET["id_factura"];

$c1=substr($c, 0,1);

//echo"<p>".$celos."</p>";

echo"
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <script src='jsFactura.js'></script>
    <link rel='stylesheet' type='text/css' href='../../../css/FacturaStyle.css'>
    <link rel='stylesheet' type='text/css' href='../../../css/Factura.css'>
    <title>Facturas</title>
    <style>
        button{
            width: 200px;
            height: 40px;
            margin-top: 15px;
        }
        .btn-ok{
            color: white;
            border-radius: 4px;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
            background: #1CB841;
        }
        .btn-ok:hover{
            background-color: #1CB841;
            color: white;
            font-weight: bold;

            box-shadow: #1CB841 -1px 1px, #1CB841 2px 2px, #1CB841 -3px 3px, #1CB841 -4px 4px, #1CB841;
            transform: translate3d(4px, -4px, 0);

            transition-delay: 0s;
            transition-duration: 0.4s;
            transition-property: all;
            transition-timing-function: linear;
        }

        .btn-danger{
            color: white;
            border-radius: 4px;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
            background: #CA3C3C;
        }

        .btn-danger:hover{
            background-color: #CA3C3C;
            color: white;
            font-weight: bold;

            box-shadow: #CA3C3C -1px 1px, #CA3C3C 2px 2px, #CA3C3C -3px 3px, #CA3C3C -4px 4px, #CA3C3C;
            transform: translate3d(4px, -4px, 0);

            transition-delay: 0s;
            transition-duration: 0.4s;
            transition-property: all;
            transition-timing-function: linear;
        }
    </style>
</head>

<body onload='cargarDatos(".$c1.")' style='margin-left: 10%; width: 70%'>
    <label style='visibility: hidden' id='hidden_carrito'>13</label>
    <img src='../../../imgs/private/logo.jpg'>
    <label id='num_fac'>Numero de Factura</label>
    <div class='row'>
        <div class='column'>
            <label>Juana Maria</label><br>
            <label>Gaspar Sangurima 2-30</label><br>
        </div>
        <div class='column'>
            <label id='nombre'>NOMBRE</label><br>
            <label id='correo'>CORREO</label><br>
            <label id='telefono'>TELEFONO</label><br>
            <label id='direccion'>DIRECCION</label><br>
            <label id='cedula'>DIRECCION</label><br>
        </div>
    </div>

    <div id='factura' style='clear:both; margin-top: 15%'>
    </div>
    <div class='row'>
        <div class='column'>
           
        </div>
    </div>
</body>
</html>
"

 
?>