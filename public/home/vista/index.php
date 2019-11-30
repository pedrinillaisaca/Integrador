<?php
session_start(); //start session
include("../../../config/conexionBD.php"); //include config file
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>Bellisima</title>
    <link rel="stylesheet" href="../../../css/estilo_carrito.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<body>
<header>
    <nav class="navbar navbar-inverse" style="height: 80px">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Bellisima.com</a>
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

            </ul>
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
    </nav>
</header>

<main>
    <section id="banner">
        <div class="col-6" style="width: 100%; float: left">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class=""></li>
                    <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                    <li data-target="#myCarousel" data-slide-to="2" class="active"></li>
                </ol>

                <div class="carousel-inner" style="height: 450px">
                    <div class="item" style="height: 100% ;width: 100%">
                        <img class="centrar_imagen" src="../../../imgs/public/top_ventas/mod_1.jpg" alt="Los Angeles">
                    </div>

                    <div class="item">
                        <img class="centrar_imagen" src="../../../imgs/public/top_ventas/mod_2.jpg" alt="Chicago"
                             style="height: auto">
                    </div>

                    <div class="item active">
                        <img class="centrar_imagen" src="../../../imgs/public/top_ventas/mod_3.jpg" alt="Chicago"
                             style="height: auto">
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
    </section>

    <section id="bienvenidos">
        <div class="contenedor">
            <h2>BIENVENIDOS A NUESTRA TIENDA ONLINE</h2>
        </div>
    </section>

    <section id="blog">
        <div align="center">


            <h3>CATALOGO</h3>
            <i class="fab fa-cc-visa"></i>


            <?php
            //Lista de productos de la base de datos

            $results = $conn->query("SELECT * FROM producto");
            if (!$results) {
                printf("Error: %s\n", $conn->error);
                exit;
            }

            //Muestra los registros recuperados como quieras
            $products_list = '<ul class="products-wrp">';

            while ($row = $results->fetch_assoc()) {
                $products_list .= <<<EOT
<li>
<form class="form-item" method="post" onsubmit="return AgregarCarrito()">
<h4>{$row["producto_nombre"]}</h4>
<div><img src="../../../imgs/public/{$row["producto_img"]}"></div>
<div>Precio : {$moneda} {$row["producto_precio"]}<div>
<div class="item-box">
    <div>
	Color :
    <select name="producto_color">
    <option value="Rojo">Rojo</option>
    <option value="Azul">Azul</option>
    <option value="blanco">Blanco</option>
    <option value="negro">Negro</option>
    
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
	
    <input name="producto_id" id="producto_codigo" type="hidden" value="{$row["producto_id"]}">
    
    <button type="button" id="agregar" value="" onclick="AgregarCarrito()">agregar Carrito</button>
    
    <a class="fontawesome-twitter" href="#"></a>
    <a class="fontawesome-thumbs-up" href="#"></a>
    <a class="fontawesome-thumbs-down" href="#"></a>
    <i class="fas fa-camera-retro fa-10x"></i>
    
    
    
</div>
</form>
</li>
EOT;
            }
            $products_list .= '</ul></div>';

            echo $products_list;
            ?>
    </section>

    <section id="info">
        <h3>El fisico atrae pero los tacones enamoran.</h3>
        <div class="contenedor">
            <div class="info-pet">
                <img src="../../../imgs/public/tacos.jpg" alt="">
                <h4>Tacones</h4>
            </div>
            <div class="info-pet">
                <img src="../../../imgs/public/anillo.jpg" alt="">
                <h4>Anillos</h4>
            </div>
            <div class="info-pet">
                <img src="../../../imgs/public/camiseta.jpg" alt="">
                <h4>Camisetas</h4>
            </div>
            <div class="info-pet">
                <img src="../../../imgs/public/bestido.jpg" alt="">
                <h4>Vestidos</h4>
            </div>
        </div>
    </section>
</main>

<footer>
    <div class="contenedor">
        <p class="copy">Bellisima &copy; 2019</p>
        <div class="sociales">
            <a class="fontawesome-facebook-sign" href="#"></a>
            <a class="fontawesome-twitter" href="#"></a>
            <a class="fontawesome-camera-retro" href="#"></a>
            <a class="fontawesome-google-plus-sign" href="#"></a>
            <a class="fab fa-facebook" href="www.facebook.com"></a>
            <a class="fontawesome-fa-facebook-messenger"></a>
            <i class="fab fa-cc-mastercard"></i>
            <i class="fab fa-facebook-messenger"></i>

        </div>
    </div>
</footer>
</body>
</html>