function crearUsuario() {

	let nombre = document.getElementById("nombre").value;
	let apellido = document.getElementById("apellido").value;
	let direccion = document.getElementById("direccion").value;
	let telefono  =document.getElementById("telefono").value;
	let correo = document.getElementById("correo").value;
	let password = document.getElementById("password").value;
	let http = new XMLHttpRequest();
    let url = '/Bellisima/public/home/controladores/crear_usuario.php';
    let params = 'nombre='+nombre+'&apellido='+apellido+'&direccion='+direccion+'&telefono='+telefono+'&correo='+correo+
        '&password='+password;
	
    http.open('POST', url, true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.onreadystatechange = function() {
        if(http.readyState === 4 && http.status === 200) {
            alert(http.responseText);
        }
    };
    http.send(params);
    return false;
	
}
function iniciar_sesion() {

	let correo = document.getElementById('correo').value;
	let contrasena = document.getElementById('password').value;
	let http = new XMLHttpRequest();
    let url = '/Bellisima/public/home/controladores/login.php';
    let params = 'mail='+correo+'&password='+contrasena;
	
    http.open('POST', url, true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.onreadystatechange = function() {
        if(http.readyState === 4 && http.status === 200) {
            alert(http.responseText);
			let leo = this.responseText;
            let spliteo = leo.split(';');
            if(spliteo[0] === 'user'){
                window.location.assign("../vista/index.html")
            }else if(spliteo[0] =='admin'){
                alert('ventana administrador');
            }

        }
    };
    http.send(params);
    return false;
	
	
}
	

/*function modificar_usuario() {
	//let nombre = document.getElementById("codigo").value;
	let nombre = document.getElementById("nombre").value;
	let apellido = document.getElementById("apellido").value;
	let direccion = document.getElementById("direccion").value;
	let telefono  =document.getElementById("telefono").value;
	let correo = document.getElementById("correo").value;
	let password = document.getElementById("password").value;
	let http = new XMLHttpRequest();
    let url = '/Bellisima/public/home/controladores/crear_usuario.php';
    let params = 'nombre='+nombre+'&apellido='+apellido+'&direccion='+direccion+'&telefono='+telefono+'&correo='+correo+
        '&password='+password;
	
    http.open('POST', url, true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.onreadystatechange = function() {
        if(http.readyState === 4 && http.status === 200) {
            alert(http.responseText);
        }
    };
    http.send(params);
    return false;
}
	
	
	
	
 /*\if (nombre == "") {
 document.getElementById("informacion").innerHTML = "";
 } else {
 if (window.XMLHttpRequest) {
 // code for IE7+, Firefox, Chrome, Opera, Safari
 xmlhttp = new XMLHttpRequest();
 } else {
 // code for IE6, IE5
 xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
 }
 xmlhttp.onreadystatechange = function() {
 if (this.readyState == 4 && this.status == 200) {
 alert("llegue");
 document.getElementById("informacion").innerHTML = this.responseText;
 }
 };+
 xmlhttp.open("POST","crear_usuario.php?nombre="+nombre+"&apellido="+apellido+"&direccion="+direccion+"&telefono="+telefono+"&correo="+correo+"&password="+password,true);
 xmlhttp.send();
 }
 return false;
	
	let http = new XMLHttpRequest();
	let url = 'Bellisima/Public/Home/Controladores/crear_usuario.php';
	let params = 'leo=le0_alv';
	http.open('POST', url, true);
	http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	http.onreadystatechange = function(){
		if(http.readyState === 4 && http.status === 200){
			alert(http.responseText);
		}
	};
	http.send(params);
	return false;
}





function crearUsuario() {
	
	alert('se debe enviar alguito');
	let http = new XMLHttpRequest();
	let url = '/Bellisima/Public/Home/Controladores/crear_usuario.php';
	let params = 'function=login&'+;
	http.open('POST', url, true);
	http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	http.onreadystatechange = function(){
		if(http.readyState === 4 && http.status === 200){
			alert(http.responseText);
		}
	};
	http.send(params);
	return false;
}
*/