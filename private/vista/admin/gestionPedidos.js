function ejecutar() {
    console.log("Pedro")

    var indicadorr = document.getElementById("visualizar").value;

    if (indicadorr == "" || indicadorr == "Limpiar") {
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

        param=document.getElementById(indicadorr).value;
        console.log(indicadorr);
        console.log(param);


        
        xmlhttp.open("GET", "../../controladores/admin/visualizarPedidos.php?indicador="+indicadorr+"&parametro="+param, true);

        xmlhttp.send();
    
    }
    return false;
}

function mostTodosPed(){
    console.log("inicial")
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

    xmlhttp.open("GET", "../../controladores/admin/visualizarTodosPedidos.php", true);

        xmlhttp.send();
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





function mostrar(){
    document.getElementById('opciones_de_factura').style.display = 'block';
    }
function mostCorreo(){
    document.getElementById("correo").style.display='block';
    document.getElementById("fecha").style.display='none';
}
function mostFecha(){
    document.getElementById("correo").style.display='none';
    document.getElementById("fecha").style.display='block';
}

function mostTodas(){
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //alert("llegue"); 
            document.getElementById("divDinamico").innerHTML = this.responseText;
        }
    };

    console.log("Mostrando todas las facturas")
    let url ="../../controladores/admin/printAllFacturas.php";

    xmlhttp.open("GET", url, true);

    xmlhttp.send();

    return false;
}



function cambiarEstadoFactura(id){
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //alert("llegue"); 
            document.getElementById("divDinamico").innerHTML = this.responseText;
        }
    };
    
    let id_estadoFactura="estadoFactura"+id;
    let estado=document.getElementById(id_estadoFactura).value;

    
    let url ="../../controladores/admin/cambiarEstadoFactura.php?factura_id="+id+"&factura_estado="+estado;
        
    xmlhttp.open("GET", url, true);

    xmlhttp.send();

    return false;

}


function buscarFacturaParam(){

    

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

    var indicador = document.getElementById("buscarFactura").value;
    var parametro="";
    console.log(indicador)
    parametro=document.getElementById(indicador).value;       
    console.log(parametro)

    let url ="../../controladores/admin/printAllFacturasParam.php?indicador="+indicador+"&parametro="+parametro;
        
    xmlhttp.open("GET", url, true);

    xmlhttp.send();

    return false;

}

function verFacturaCompleta(id){

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //alert("llegue"); 
            document.getElementById("divDinamico").innerHTML = this.responseText;
        }
    };
    let url ="../../controladores/admin/printFacturaCompleta.php?idFactura="+id;
        
    xmlhttp.open("GET", url, true);

    xmlhttp.send();

    return false;


}

function mostCorreoPed(){
    document.getElementById("correoPed").style.display='block';
    document.getElementById("fechaPed").style.display='none';
}
function mostFechaPed(){
    document.getElementById("correoPed").style.display='none';
    document.getElementById("fechaPed").style.display='block';
}