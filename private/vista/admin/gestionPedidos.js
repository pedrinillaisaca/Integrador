function ejecutar() {
    console.log("Pedro")

    var indicador = document.getElementById("visualizar").value;

    if (indicador == "" || indicador == "Limpiar") {
        document.getElementById("divDinamico").innerHTML = "";
    } else {

        ////
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari 
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5 
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                //alert("llegue"); 
                document.getElementById("divDinamico").innerHTML = this.responseText;
            }
        };


        //IMportante
        if (indicador === "Visualizar Pedidos") {
            return visualizarPedido();
        }
        //Importante
    }
    return false;
}

function visualizarPedido() {

    xmlhttp.open("GET", "../../controladores/admin/visualizarPedidos.php", true);

    xmlhttp.send();

    return false;
}


function cambiarEstado(id) {

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //alert("llegue"); 
            document.getElementById("divDinamico").innerHTML = this.responseText;
        }
    };
    let id_estado="estado"+id;
    let estado=document.getElementById(id_estado).value;
    console.log("CAmbiando estado")
    console.log(id)
    console.log(estado)
    let url ="../../controladores/admin/cambiarEstadoPedido.php?pedido_id="+id+"&pedido_estado="+estado;

    xmlhttp.open("GET", url, true);

    xmlhttp.send();

    return false;
}



function trazarRutaMapa(lon,lat) {
       
    console.log("trazando Ruta")
    //recarga(lon,lat);//funcion llamada desde controladores
    mostrar();
    return false;
}



function mostrar(){
    document.getElementById('siteloader').style.display = 'block';
    }