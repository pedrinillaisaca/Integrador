<?php
session_start(); //start session
include("../../../config/conexionBD.php"); //include config file
setlocale(LC_MONETARY, "en_US"); // US national format (see : http://php.net/money_format)
############# add products to session #########################
if (isset($_POST["producto_id"])) {
	foreach ($_POST as $key => $value) {
		$new_product[$key] = filter_var($value, FILTER_SANITIZE_STRING); //crear una nueva gama de productos
	}

	//Necesitamos obtener el nombre y el precio del producto de la base de datos.
	$statement = $conn->prepare("SELECT producto_nombre, producto_precio FROM producto WHERE producto_id=? LIMIT 1");
	$statement->bind_param('s', $new_product['producto_id']);
	$statement->execute();
	$statement->bind_result($producto_nombre, $producto_precio);


	while ($statement->fetch()) {
		$new_product["producto_nombre"] = $producto_nombre; /// fetch nombre del producto de la base de datos
		$new_product["product_precio"] = $producto_precio;  //obtener el precio del producto de la base de datos

		if (isset($_SESSION["products"])) {  //si la sesión var ya existe
			if (isset($_SESSION["products"][$new_product['product_code']])) //verifique que el artículo exista en la gama de productos
			{
				unset($_SESSION["products"][$new_product['product_code']]); //elemento antiguo sin configurar
			}
		}

		$_SESSION["products"][$new_product['producto_id']] = $new_product;	//actualizar productos con una nueva matriz de artículos
	}

	$total_items = count($_SESSION["products"]); //cuenta total items
	die(json_encode(array('items' => $total_items))); // salida json

}

################## lista de productos en el carrito###################
if (isset($_POST["load_cart"]) && $_POST["load_cart"] == 1) {

	if (isset($_SESSION["products"]) && count($_SESSION["products"]) > 0) { //si tenemos variable de sesión
		$cart_box = '<ul class="cart-products-loaded">';
		$total = 0;
		foreach ($_SESSION["products"] as $product) { //recorrer los elementos y preparar contenido html

			//establecer variables para usarlas en el contenido HTML a continuación
			$producto_nombre = $product["producto_nombre"];
			$producto_precio = $product["producto_precio"];
			$product_code = $product["producto_id"];
			$producto_cantidad = $product["producto_cantidad"];
			$product_color = $product["producto_color"];
			$product_size = $product["producto_talla"];

			$cart_box .=  "<li> $producto_nombre (cantidad : $producto_cantidad | $product_color  | $product_size ) &mdash; $moneda " . sprintf("%01.2f", ($producto_precio * $producto_cantidad)) . " <a href=\"#\" class=\"remove-item\" data-code=\"$product_code\">&times;</a></li>";
			$subtotal = ($producto_precio * $producto_cantidad);
			$total = ($total + $subtotal);
		}
		$cart_box .= "</ul>";
		$cart_box .= '<div class="cart-products-total">Total : ' . $moneda . sprintf("%01.2f", $total) . ' <u><a href="visualizar_carrito.php" title="Revisualizar_carrito and Revisar_Carrito">Revisar_Carrito</a></u></div>';
		die($cart_box); //salida y salida de contenido
	} else {
		die("su carrito esta vacio actualmente"); // tenemos carro vacío
	}
}

################# eliminar artículo del carrito de compras################
if (isset($_GET["remove_code"]) && isset($_SESSION["products"])) {
	$product_code   = filter_var($_GET["remove_code"], FILTER_SANITIZE_STRING); //obtener el código del producto para eliminar

	if (isset($_SESSION["products"][$product_code])) {
		unset($_SESSION["products"][$product_code]);
	}

	$total_items = count($_SESSION["products"]);
	die(json_encode(array('items' => $total_items)));
}
