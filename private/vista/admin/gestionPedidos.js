function ejecutar() {
    console.log("Funcion de Ejecución")

    var indicadorr = document.getElementById("visualizar").value;

    if (indicadorr == "" || indicadorr == "Limpiar") {
        document.getElementById("divDinamico").innerHTML = "";
    } else {

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

        if (indicadorr == "todosPedidos") {
            mostTodosPed()
        } else {
            var param = document.getElementById(indicadorr).value;
            xmlhttp.open("GET", "../../controladores/admin/visualizarPedidos.php?indicador=" + indicadorr + "&parametro=" + param, true);
            xmlhttp.send();
            console.log(param);
        }
        console.log(indicadorr);
    }
    return false;
}

function mostTodosPed() {
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

    return false;
}


function cambiarEstado(id) {

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //alert("llegue"); 
            document.getElementById("divDinamico").innerHTML = this.responseText;
        }
    };
    let id_estado = "estado" + id;
    let estado = document.getElementById(id_estado).value;
    console.log("CAmbiando estado")
    console.log(id)
    console.log(estado)
    let url = "../../controladores/admin/cambiarEstadoPedido.php?pedido_id=" + id + "&pedido_estado=" + estado;

    xmlhttp.open("GET", url, true);

    xmlhttp.send();

    return false;
}


function mostrar() {
    document.getElementById('opciones_de_factura').style.display = 'block';
    return false;
}
function mostCorreo() {
    document.getElementById("correo").removeAttribute('style');
    document.getElementById("fecha").style.display = 'none';
    return false;
}
function mostFecha() {
    document.getElementById("correo").style.display = 'none';
    document.getElementById("fecha").style.display = 'block';
    return false;
}

function mostTodas() {
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //alert("llegue"); 
            document.getElementById("divDinamico").innerHTML = this.responseText;
        }
    };

    console.log("Mostrando todas las facturas")
    let url = "../../controladores/admin/printAllFacturas.php";

    xmlhttp.open("GET", url, true);

    xmlhttp.send();

    return false;
}



function cambiarEstadoFactura(id) {
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //alert("llegue"); 
            document.getElementById("divDinamico").innerHTML = this.responseText;
        }
    };

    let id_estadoFactura = "estadoFactura" + id;
    let estado = document.getElementById(id_estadoFactura).value;
    let url = "../../controladores/admin/cambiarEstadoFactura.php?factura_id=" + id + "&factura_estado=" + estado;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
    return false;

}


function buscarFacturaParam() {
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
    console.log(indicador)
    if (indicador == "todas") {
        mostTodas()
    } else {        
        var parametro = document.getElementById(indicador).value;
        console.log(parametro)
        let url = "../../controladores/admin/printAllFacturasParam.php?indicador=" + indicador + "&parametro=" + parametro;
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    }


    return false;

}

function verFacturaCompleta(id) {
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //alert("llegue"); 
            document.getElementById("divDinamico").innerHTML = this.responseText;
        }
    };
    let url = "../../controladores/admin/printFacturaCompleta.php?idFactura=" + id;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
    return false;
} 

function checkOpFac(select){
    if (select==2) {
        mostFecha()
    }else if(select==3){
        mostCorreo()
    }
}

function checkOpPed(select){    
    if (select==2) {
        mostFechaPed()
    }else if(select==3){
        mostCorreoPed()
    }else if (select==4){
        mostrar()
    }
}

function mostCorreoPed() {
    document.getElementById("correoPed").style.display = 'block';
    document.getElementById("fechaPed").style.display = 'none';
    return false;
}
function mostFechaPed() {
    document.getElementById("correoPed").style.display = 'none';
    document.getElementById("fechaPed").removeAttribute('style');
    return false;
}

function printMapa(lon, lat) {
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //alert("llegue"); 
            document.getElementById("divDinamico").innerHTML = this.responseText;
        }
    };
    console.log("print mapa")
    console.log(lon)
    console.log(lat)
    let url = "../../controladores/admin/mapita.php?lon=" + lon + "&lat=" + lat;
    xmlhttp.open("GET", url, true)
    xmlhttp.send();
    return false;
}