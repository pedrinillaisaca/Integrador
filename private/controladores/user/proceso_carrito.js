
	/*, aunque haya elementos que no hayan sido cargados del */
	function AgrregarCarrito(){

	}
$(document).ready(function(){	
	/* sirve para hacer cosas cuando la página está lista para recibir instrucciones jQuery que modifiquen el DOM. */
		$(".form-item").submit(function(e){
			var form_data = $(this).serialize();
			var button_content = $(this).find('button[type=submit]');
			button_content.html('Añadiendo'); //Cargando texto del botón

			$.ajax({ //hacer una solicitud ajax a proceso_carrito_compra.php
				url: "proceso_carrito_compra.php",
				type: "POST",
				dataType:"json", //esperar valor json del servidor
				data: form_data
			}).done(function(data){ //éxito de Ajax
				$("#cart-info").html(data.items); //artículos totales en el elemento de información del carrito
				button_content.html('Agregar Carrito'); //restablecer el texto del botón al texto original
				alert("A añadido al carrito de compras!"); //alert user
				if($(".shopping-cart-box").css("display") === "block"){ //si la caja del carrito sigue visible
					$(".cart-box").trigger( "click" ); //disparador haga clic para actualizar la caja del carrito.
				}
			})
			/* el link no lleve a
ningún sitio, simplemente se ejecutará el código Javascript contenido para el evento*/
			e.preventDefault();
		});

	//Mostrar artículos en el carrito
	$( ".cart-box").click(function(e) { //cuando el usuario hace clic en la caja del carrito
		e.preventDefault(); 
		$(".shopping-cart-box").fadeIn(); //exhibir la caja del carro
		$("#shopping-cart-results").html('<img src="../../../imgs/public/ajax-loader.gif">'); //mostrar imagen de carga
		$("#shopping-cart-results" ).load( "proceso_carrito_compra.php", {"load_cart":"1"}); //Haga una solicitud ajax usando jQuery Load () y actualice los resultados
	});
	
	//Close Cart
	$( ".close-shopping-cart-box").click(function(e){ //usuario haga clic en la caja del carrito cerrar enlace
		e.preventDefault(); 
		$(".shopping-cart-box").fadeOut(); //close cart-box
	});
	
	//Eliminar artículos del carrito
	$("#shopping-cart-results").on('click', 'a.remove-item', function(e) {
		e.preventDefault(); 
		var pcode = $(this).attr("data-code"); //obtener el código del producto
		$(this).parent().fadeOut(); //eliminar elemento del elemento de la caja
		$.getJSON( "proceso_carrito_compra.php", {"remove_code":pcode} , function(data){ //obtener el recuento de elementos del servidor
			$("#cart-info").html(data.items); //actualizar el recuento de artículos en el carrito
			$(".cart-box").trigger( "click" ); //haga clic en la caja del carrito para actualizar la lista de artículos
		});
	});

});