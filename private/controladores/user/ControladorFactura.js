function cargarDatos(){
    let url = '/Bellisima/private/controladores/user/Controlador_Factura.php';
    let params = 'metodo=getDatos&cli_id='+2;
    let ajax = new XMLHttpRequest();
    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function () {
        if(this.status === 200 && this.readyState === 4){
            let spliteo = this.responseText.toString().split('|');
            document.getElementById('num_fac').innerHTML = "<strong># Factura: </strong>" + spliteo[0];
            document.getElementById('nombre').innerHTML = "<strong>Nombre: </strong>" + spliteo[1];
            document.getElementById('correo').innerHTML = "<strong>Correo: </strong>" + spliteo[2];
            document.getElementById('telefono').innerHTML = "<strong>Telefono: </strong>" + spliteo[3];
            document.getElementById('direccion').innerHTML = "<strong>Direccion: </strong>" + spliteo[4];
            document.getElementById('cedula').innerHTML = "<strong>Cedula: </strong>" + spliteo[5];
        }
    };
    ajax.send(params);
    mostrarFactura();
}

function mostrarFactura(){
    let url = '/Bellisima/private/controladores/user/Controlador_Factura.php';
    let params = 'metodo=mostrar_facturas';
    let ajax = new XMLHttpRequest();
    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function () {
        if(this.status === 200 && this.readyState === 4){
            let leo = this.responseText;
            let spliteo = leo.split('||');
            document.getElementById('hidden_carrito').innerText=spliteo[1];
            console.log(spliteo[1]);
            document.getElementById('factura').innerHTML=spliteo[0];
        }
    };
    ajax.send(params);
}

function crearFactura(){
    let url = '/Bellisima/private/controladores/user/Controlador_Factura.php';
    let carrito_id = document.getElementById('hidden_carrito').textContent;
    let params = 'metodo=crear_factura&carrito_id='+carrito_id;
    let ajax = new XMLHttpRequest();
    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function () {
        if(this.status === 200 && this.readyState === 4){
            alert(this.responseText);
        }
    };
    ajax.send(params);
}

function imprimir(){

}