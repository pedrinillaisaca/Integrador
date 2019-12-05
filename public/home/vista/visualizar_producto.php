<?php

include("../../../config/conexionBD.php"); //include config file
$codigo_user = $_GET["codigo_usuario"];
$codigo_cabecera =0;
$positivo=1;
$negativo=0;



?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../css/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>Bellisima</title>
    <link rel="stylesheet" href="../../../css/estilo_carrito.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="../../../private/controladores/user/proceso_carrito.js"></script>
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
                <li><a href="login.html"><span class="glyphicon glyphicon-log-in"></span> Iniciar Sesion </a></li>
                <li><a href="../../../private/controladores/user/cerrar_sesion.php"><span class="glyphicon glyphicon-log-in"></span> Cerrar Sesion</a></li>


            </ul>
        </div>
        <?php
        $sql="SELECT * FROM carrito_cabecera WHERE fk_persona_carrito=$codigo_user and carrito_eliminado='N'";
        $re=$conn->query($sql);
        if ($re->num_rows > 0) {
            while ($row = $re->fetch_assoc()) {
                $codigo_cabecera = $row["carrito_id"];
                echo $codigo_cabecera;
            }
            echo $codigo_cabecera;
            echo "<a href='../../../private/vista/user/visualizar_carrito.php?id_usuario=$codigo_user&id_cabecera=$codigo_cabecera' class='cart-box' id='cart-info' title='visualizar_carrito'>";
        }

            if (isset($_SESSION["products"])) {
                echo count($_SESSION["products"]);
            } else {
                echo 0;
            }
            ?>
        </a>
        <div class="shopping-cart-box">
            <a href="#" class="close-shopping-cart-box">Close</a>
            <h3>SU COMPRAS DEL CARRITO</h3>
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



    <?php
include("../../../config/conexionBD.php"); //include config file
$codigo_producto = $_GET["codigo_producto"];


echo " <input name='codigo_usuario' id='codigo_usuario' type='hidden' value='$codigo_user'>";
$results = $conn->query("SELECT * FROM producto where producto_id=$codigo_producto and producto_eliminado='N'");
if (!$results) {
    printf("Error: %s\n", $conn->error);
    exit;
}

//Muestra los registros recuperados como quieras
$products_list = '<ul class="products-wrp">';

while ($row = $results->fetch_assoc()) {
    $products_list .= <<<EOT
<li>
<form class="form-item" method="post" action="verproducto()"> 
<h4>{$row["producto_nombre"]}</h4>
<div><img src="../../../imgs/private/{$row["producto_img"]}" href="../../../private/vista/user/ver_descripcion.php?id_producto={$row["producto_id"]}" alt=""></div>
<div>Precio : {$moneda} {$row["producto_precio"]}<div>
<div class="item-box">
   <div>
   
	Color :
    <select name="color" id="color" >
        <option value="" disabled selected>Seleccionar</option>
          <option value="rojo">Rojo</option>
          <option value="azul">Azul</option>
          <option value="celeste">Verde</option>
          <option value="blanco">Blanco</option>
          <option value="negro">Negro</option>
          <option value="negro">Vino</option>
      </select>
    
    </select>
	</div>
	 
	
	<div>
    Cantidad :
     <select name="cantidad" id="cantidad" onchange="AgregarCarrito();">
        <option value="" disabled selected>Seleccionar</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
      </select>
    
    </select>
	</div>
	 
	<div>
	Talla :
   <select name="talla" id="talla" >
        <option value="" disabled selected>Seleccionar</option>
          <option value="S">S</option>
          <option value="M">M</option>
          <option value="L">L</option>
        
      </select>
    
    </select>
	</div >
	<div>
	Descripcion del producto:
	<p>{$row["producto_descripcion"]}</p>
	
</div>

 
	
    <input name="producto_id" id="{$row["producto_id"]}" type="hidden" value="{$row["producto_id"]}">
     <input type="button" id="agregar" name="agregar" value="Agregar Carrito" onclick="AgregarCarrito({$row["producto_id"]})"
    <a class="fontawesome-twitter" href="#"></a>
    
    <a class="fontawesome-thumbs-up" href="../../../private/controladores/user/gestion_calificaciones.php?id_usuario=$codigo_user&id_producto=$codigo_producto&calificacion=$positivo"></a>
    <a class="fontawesome-thumbs-down" href="../../../private/controladores/user/gestion_calificaciones.php?id_usuario=$codigo_user&id_producto=$codigo_producto&calificacion=$negativo"></a>
    
    
</div>

 <div style="float: start">
 <form id="comentario" method="post" action="">
Comentario:
<input type="text" id="comentario" name="comentario" value="" placeholder="Ingrese un comentario si desea ..."
required/>
<input type="submit" id="crear" name="Crear" value="Aceptar" />

</form>
	
	
    </div>
    
</form>
</li>
EOT;
}
$products_list .= '</ul></div>';

echo $products_list;
$conn->close();
?>
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
