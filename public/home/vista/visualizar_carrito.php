<?php
session_start(); //start session
include("../../config/conexionBD.php"); //include config file
setlocale(LC_MONETARY, "en_US"); // US national format (see : http://php.net/money_format)
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Revisar su carrito antes de comprar</title>
    <link href="../../../css/estilo_carrito.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../../../private/controladores/user/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="../../../private/controladores/user/proceso_carrito.js"></script>
</head>

<body>
    <h3 style="text-align:center">Revise su carrito antes de comprar</h3>
    <?php
	if (isset($_SESSION["products"]) && count($_SESSION["products"]) > 0) {
		$total 			= 0;
		$list_tax 		= '';
		$cart_box 		= '<ul class="view-cart">';

		foreach ($_SESSION["products"] as $product) { //Imprima cada artículo, cantidad y precio.
			$producto_nombre = $product["producto_nombre"];
			$producto_cantidad = $product["producto_cantidad"];

			$product_code = $product["producto_codigo"];
			$product_color = $product["producto_color"];
			$product_size = $product["producto_talla"];


			$item_price 	= sprintf("%01.2f", ($product_price * $producto_cantidad));  // precio x cantidad = precio total del artículo

			$cart_box 		.=  "<li> $product_code &ndash;  $producto_nombre (cantidad : $producto_cantidad | $product_color | $product_size) <span> $moneda $item_price </span></li>";

			$subtotal 		= ($product_price * $producto_cantidad); //Multiplicar la cantidad del artículo * precio
			$total 			= ($total + $subtotal); //Agregar al precio total
		}

		$grand_total = $total + $costo_emvio; //gran total

		foreach ($impuesto as $key => $value) { //enumerar y calcular todos los impuestos en la matriz
			$tax_amount 	= round($total * ($value / 100));
			$tax_item[$key] = $tax_amount;
			$grand_total 	= $grand_total + $tax_amount;
		}

		foreach ($tax_item as $key => $value) { //Lista de impuestos
			$list_tax .= $key . ' ' . $moneda . sprintf("%01.2f", $value) . '<br />';
		}

		$costo_emvio = ($costo_emvio) ? 'costo de emvio : ' . $moneda . sprintf("%01.2f", $costo_emvio) . '<br />' : '';

		//Envío de impresión, IVA y Total
		$cart_box .= "<li class=\"view-cart-total\">$costo_emvio  $list_tax <hr>total a pagar : $moneda " . sprintf("%01.2f", $grand_total) . "</li>";
		$cart_box .= "</ul>";

		echo $cart_box;
	} else {
		echo "su carrito esta vacio actualmente";
	}
	?>
    <?php
    //Lista de productos de la base de datos
    echo  "relacionados";

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