<?php
session_start(); //start session
include("../../../config/conexionBD.php"); //include config file
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Catalogo Bellisima</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <!--<link rel="stylesheet" href="../../../CSS/Style.css">-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="../../../private/controladores/user/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="../../../private/controladores/user/proceso_carrito.js"></script>

    <!--<link href="../../../css/carrocel.css" rel="stylesheet" type="text/css">-->
    <!--<link rel="stylesheet" href="../../../css/estilo_carrocel.css">-->
    <link rel="stylesheet" href="../../../css/estilo_carrito.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">


</head>

<body>


    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Bellisima</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Mi Cuenta</a></li>
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span
                            class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Actualizar datos</a></li>
                        <li><a href="#">Page 1-2</a></li>
                        <li><a href="#">Page 1-3</a></li>
                    </ul>
                </li>
                <li><a href="#">Page 2</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="crear_usuario.html"><span class="glyphicon glyphicon-user"></span>Registrate</a></li>
                <li><a href="login.html"><span class="glyphicon glyphicon-log-in"></span> Iniciar Sesion</a></li>

        </div>
        <a href="#" class="cart-box" id="cart-info" title="visualizar_carrito">
            <?php
        if (isset($_SESSION["products"])) {
            echo count($_SESSION["products"]);
        } else {
            echo 0;
        }
        ?>
        </a>
        <div class="shopping-cart-box">
            <a href="#" class="close-shopping-cart-box">Close</a>
            <h3>SUS COMPRAS DEL CARRITO</h3>
            <div id="shopping-cart-results">
            </div>
        </div>
        </ul>//pilas aqui
    </nav>

    <div class="col-6" style="width: 50%; float: left">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner" style="height: 450px">
                <div class="item active">
                    <img class="centrar_imagen" src="../../../imgs/public/top_ventas/mod_1.jpg" alt="Los Angeles">
                </div>

                <div class="item">
                    <img class="centrar_imagen" src="../../../imgs/public/top_ventas/mod_2.jpg" alt="Chicago">
                </div>

                <div class="item">
                    <img class="centrar_imagen" src="../../../imgs/public/top_ventas/mod_3.jpg" alt="Chicago">
                </div>

                <div class="item">
                    <img class="centrar_imagen" src="../../../imgs/public/top_ventas/mod_4.jpg" alt="Chicago">
                </div>
            </div>

            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Siguiente</span>
            </a>
        </div>
    </div>
    </div>
    </div>

    <div align="center">


        <h3>CATALOGO DE MUJERES</h3>
        <i class="fab fa-cc-visa"></i>


        <?php
    //Lista de productos de la base de datos

    $results = $conn->query("SELECT * FROM producto");
    if (!$results) {
        printf("Error: %s\n", $conn->error);
        exit;
    }

    //Muestra los registros recuperados como quieras
    $products_list =  '<ul class="products-wrp">';

    while ($row = $results->fetch_assoc()) {
        $products_list .= <<<EOT
<li>
<form class="form-item">
<h4>{$row["producto_nombre"]}</h4>
<div><img src="../../../imgs/public/{$row["producto_img"]}"></div>
<div>Precio : {$moneda} {$row["producto_precio"]}<div>
<div class="item-box">
    <div>
	Color :
    <select name="producto_color">
    <option value="Rojo">Red</option>
    <option value="Azul">Blue</option>
    <option value="Tomate">Orange</option>
    </select>
	</div>
	
	<div>
    Cantidad :
    <select name="producto_cantidad">
    <option value="1">1</option>b
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    </select>
	</div>
	
	<div>
    Talla :
    <select name="producto_talla">
	<option value="S">M</option>
    <option value="M">XL</option>
    <option value="L">XLL</option>
    </select>
	</div>
	
    <input name="producto_id" type="hidden" value="{$row["producto_id"]}">
    <button type="submit">Agregar Carrito</button>
</div>
</form>
</li>
EOT;
    }
    $products_list .= '</ul></div>';

    echo $products_list;
    ?>

</body>

</html>