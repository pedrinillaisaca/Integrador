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
                let codigo=spliteo[1];
                let nombre=spliteo[2];
                window.location="../vista/index.php?codigo="+codigo+'&nombre='+nombre;
            }else if(spliteo[0] ==='admin'){
                window.location="../../../private/vista/admin/index.php?correo="+correo+'&contrasena='+contrasena;
            }

        }
    };
    http.send(params);
    return false;
	
	
}

function soloLetras() {
    let regNombre = new RegExp('^[a-zA-Z ]*$');
    let valorTxtN = document.getElementById('nombre').value;
    let testeoNombre = regNombre.test(valorTxtN);
    if(testeoNombre === false){
        alert("No puede ingresar numeros en el campo nombre.");
        document.getElementById('nombre').value = valorTxtN.replace(/[0-9]/g, "");
    }

    let valorTxtA = document.getElementById('apellido').value;
    let testeoApellido = regNombre.test(valorTxtA);
    if(testeoApellido === false){
        alert("No puede ingresar numeros en el campo apellido.");
        document.getElementById('apellido').value = valorTxtA.replace(/[0-9]/g, "");
    }
}
function soloNumeros(e) {

    var key = window.Event ? e.which : e.keyCode
    return ((key >= 48 && key <= 57) || (key==8))
}
	

