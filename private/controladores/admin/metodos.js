function cerrarSesion(){
    let xml = new XMLHttpRequest();
    let url = '/Bellisima/private/controladores/admin/controladorSesion.php';
    xml.open('POST', url, true);
    xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xml.onreadystatechange = function () {
        if(this.readyState === 4 && this.status === 200){
            alert(this.responseText);
        }
    };
    xml.send();
    window.open('../../../public/home/vista/primero.html');
    //return false;
}

function modificar_usuario() {
    let codigo = document.getElementById("codigo").value;
    let rol = document.getElementById('rol').value;
    let nombre = document.getElementById("nombre").value;
    let apellido = document.getElementById("apellido").value;
    let direccion = document.getElementById("direccion").value;
    let telefono  =document.getElementById("telefono").value;
    let correo = document.getElementById("correo").value;
    let http = new XMLHttpRequest();
    let url = '/Bellisima/private/controladores/admin/modificar.php';
    let params = 'codigo='+codigo+'&rol='+rol+'&nombre='+nombre+'&apellido='+apellido+'&direccion='+direccion+'&telefono='+telefono+'&correo='+correo;
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


function cambiar_contrasena() {
    alert('entro aki');
    let codigo = document.getElementById("codigo").value;
    let contrasena1 = document.getElementById("contrasena1").value;
    let contrasena2 = document.getElementById('contrasena2').value;
    let http = new XMLHttpRequest();
    let url = '/Bellisima/private/controladores/admin/cambiar_contrasena.php';
    let params = 'codigo='+codigo+'&contrasena1='+contrasena1+'&contrasena2='+contrasena2;
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

function eliminar_registro() {
    alert('entro a eliminar');
    let codigo = document.getElementById("codigo").value;
    let http = new XMLHttpRequest();
    let url = '/Bellisima/private/controladores/admin/eliminar.php';
    let params = 'codigo='+codigo;
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

function verificar_cuenta() {
    let xml = new XMLHttpRequest();
    let url = '/Bellisima/private/controladores/admin/controladorSesion.php';
    xml.open('POST', url, true);
    xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xml.onreadystatechange = function () {
        if(this.readyState === 4 && this.status === 200){
            alert(this.responseText);
        }
    };
    xml.send();
    window.open('../../../public/home/vista/primero.html');
    //return false;

}