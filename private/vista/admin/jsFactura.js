function cargarDatos(id){
    console.log(id);
    let url = '../../controladores/admin/estructuraFactura.php';
    let params = 'metodo=getDatos&fact_id='+id;//ojo aqui 

    let ajax = new XMLHttpRequest();
    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function () {
        if(this.status === 200 && this.readyState === 4){
            let spliteo = this.responseText.toString().split('|');
            document.getElementById('num_fac').innerHTML = "<strong># Factura: </strong>" + id;
            document.getElementById('nombre').innerHTML = "<strong>Nombre: </strong>" + spliteo[1];
            document.getElementById('correo').innerHTML = "<strong>Correo: </strong>" + spliteo[2];
            document.getElementById('telefono').innerHTML = "<strong>Telefono: </strong>" + spliteo[3];
            document.getElementById('direccion').innerHTML = "<strong>Direccion: </strong>" + spliteo[4];
            document.getElementById('cedula').innerHTML = "<strong>Cedula: </strong>" + spliteo[5];
        }
    };
    ajax.send(params);
    
    
    mostrarFactura(id);//ojo
}

function mostrarFactura(id){
    console.log("verga: "+id);
    let url = '../../controladores/admin/estructuraFactura.php';
    let params = "metodo=mostrar_facturas&fact_id="+id;//ojo
    let ajax = new XMLHttpRequest();
    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function () {
        if(this.status === 200 && this.readyState === 4){
            let leo = this.responseText;
            let spliteo = leo.split('||');
            console.log(spliteo);
            document.getElementById('hidden_carrito').innerText=spliteo[1];
            //console.log(spliteo[1]);
            document.getElementById('factura').innerHTML=spliteo[0];
        }
    };
    ajax.send(params);
}

function crearFactura(){
    let url = '../../controladores/admin/estructuraFactura.php';
    let carrito_id = document.getElementById('hidden_carrito').textContent;
    let params = 'metodo=crear_factura&carrito_id='+carrito_id;//ojo
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