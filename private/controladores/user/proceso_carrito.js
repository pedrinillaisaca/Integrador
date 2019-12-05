

function AgregarCarrito(id){
	var cantidad = document.getElementById("cantidad");
	var selectedcantidad = cantidad.options[cantidad.selectedIndex].text;


	var codigo_user=document.getElementById("codigo_usuario").value;
	var producto_id=document.getElementById(id).value;
	var cantidad = document.getElementById("cantidad").value;


	/* Para obtener el texto */

	if (producto_id===0  ) {
		document.getElementById("cart-info").innerHTML = "0";
	} else {
		///ajax llamada a ajax//
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}

		xmlhttp.onreadystatechange = function() {
			var l=this.responseText;
			if (this.readyState === 4 && this.status === 200) {
				//alert('Leo' +l);
				if (l == 0){
					//alert(l);
					window.location='login.html';
				}else{if (!l==0)
					//alert('logeado');
					console.log(this.responseText);
					//alert(this.responseText);
					document.getElementById("cart-info").innerHTML = this.responseText;
				}



			}
		};
		xmlhttp.open("GET"," ../../../private/controladores/user/proceso_carrito_compra.php?codigo_producto=" + producto_id+"&codigo_usuario="+codigo_user +"&cantidad="+cantidad,true);
		xmlhttp.send();

	}
	return false;
}
function eliminar(idper,cant,iddetcarr,pro_id) {

	var id_per=document.getElementById(idper).value;
	//alert('usuario'+ id_per);

	var Cantidad=document.getElementById(cant).value;
	//alert('cantidad'+ Cantidad);

	var id_detalle=document.getElementById(iddetcarr).value;
	//alert('iddetalle'+ id_detalle);

	var id_producto=document.getElementById(pro_id).value;
	//alert('producto'+ id_producto);

	if (id_producto===0  ) {
		document.getElementById("cart-info").innerHTML = "0";
	} else {
		///ajax llamada a ajax//
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}

		xmlhttp.onreadystatechange = function() {
			var l=this.responseText;
			if (this.readyState === 4 && this.status === 200) {

					document.getElementById("informacion").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET"," ../../../private/controladores/user/eliminarcarrito.php?codigo_detalle=" + id_detalle+"&codigo_usuario="+id_per+"&cantidad="+Cantidad+"&codigo_producto="+id_producto,true); /*+"&codigo_usuario="+codigo_user +"&cantidad="+cantidad*/
		xmlhttp.send();

	}
	return false;

}
function capturar(idper,iddetcarr,pro_id){
	var id_per=document.getElementById(idper).value;
	//alert('usuario'+ id_per);

	var id_detalle=document.getElementById(iddetcarr).value;
	//alert('iddetalle'+ id_detalle);

	var id_producto=document.getElementById(pro_id).value;
	//alert('producto'+ id_producto);

		var x=document.getElementsByTagName("td");
		Cantidad=x[1].innerHTML;
		alert ('desea modificar la cantidad de prendas a :'+ Cantidad);
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}

		xmlhttp.onreadystatechange = function() {
			var l=this.responseText;
			if (this.readyState === 4 && this.status === 200) {

				document.getElementById("informacion").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET"," ../../../private/controladores/user/modificarcarrito.php?codigo_detalle=" + id_detalle+"&codigo_usuario="+id_per+"&cantidad="+Cantidad+"&codigo_producto="+id_producto,true); /*+"&codigo_usuario="+codigo_user +"&cantidad="+cantidad*/
		xmlhttp.send();


}
function comprar(idpersona,idcarritodetalle,idproducto) {
	var id_per=document.getElementById(idpersona).value;
	//alert('usuario'+ id_per);

	var id_detalle=document.getElementById(idcarritodetalle).value;
	//alert('iddetalle'+ id_detalle);

	var id_producto=document.getElementById(id_producto).value;
	//alert('producto'+ id_producto);
}


