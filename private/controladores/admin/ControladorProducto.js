function abrirImg() {
    let preview = document.querySelector('img');
    let file    = document.querySelector('input[type=file]').files[0];
    let reader  = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
    };

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "";
    }
}

function guardarPishure(){
    alert('entra la pishula');
    formData = new FormData($('#formulario')[0]);
    formData.append('metodo', 'imagen');
    $.ajax({
        type: "POST",
        url: '/Integrador/private/controladores/admin/Controlador_Producto.php',
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            alert(data);
            insertar(data);
        }
    });
    return false;
}

function insertar(data){
    let precio = document.getElementById('precio').value;
    if(precio <= 0){
        alert('El precio debe ser mayor que cero');
        return false;
    }
    let iva = document.getElementById('iva').value;
    if(iva < 0){
        alert('El valor del IVA debe ser mayor o igual que cero');
        return false;
    }
    let stock = document.getElementById('stock').value;
    if(stock < 0){
        alert('El valor del Stock debe ser mayor o igual que cero');
        return false;
    }
    // REVISAR SI SMALL / MEDIUM / LARGE ESTA SELECTED
    let talla;
    if(document.getElementById('small').checked === true && document.getElementById('medium').checked === true
        && document.getElementById('large').checked === true)
        talla = 'S,M,L';
    else if(document.getElementById('small').checked === true && document.getElementById('medium').checked === true
        && document.getElementById('large').checked === false)
        talla = 'S,M';
    else if(document.getElementById('small').checked === true && document.getElementById('medium').checked === false
        && document.getElementById('large').checked === false)
        talla = 'S';
    else {
        alert('Debe seleccionar al menos una talla de ropa');
        return false;
    }

    let nombre = document.getElementById('nombre').value;
    if(nombre === '' || nombre === null){
        alert('Debe ingresar un valor en el nombre de la prenda.');
        return false;
    }
    let descripcion = document.getElementById('descripcion').value;
    if(descripcion  === '' || descripcion === null){
        alert('Debe dar una descripcion de la prenda');
        return false;
    }
    let color = document.getElementById('color').value;
    if(color === '' || color === null){
        alert('Debe ingresar al menos un color en las prendas');
        return false;
    }

    let ajax = new XMLHttpRequest();
    let url = '/Integrador/private/controladores/admin/Controlador_Producto.php';
    let params = 'metodo=insertar&nombre_img='+data+'&precio='+precio+'&iva='+iva+'&stock='+stock+'&talla='+talla
        +'&nombre='+nombre+'&descripcion='+descripcion+'&color='+color;
    
    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function () {
        if(ajax.readyState === 4 && ajax.status === 200){
            alert(this.responseText);
            if(ajax.responseText === 1){
                alert('Se ha ingresado el producto correctamente.');
            }else{
                alert('Ha ocurrido un error al momento del ingreso.');
            }
        }
    };
    ajax.send(params);
    return false;

}

function listar(){
    window.location = '../../vista/admin/ListadoProductos.html';
}

function abrirModificar(){
    alert('ALGO');
}

function actualizar(){

}

function eliminar(){

}

function mostrarProducto(){
    let ajax = new XMLHttpRequest();
    let url = '/Integrador/private/controladores/admin/Controlador_Producto.php';
    let params = 'metodo=listarProductos';
    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function () {
        if(this.readyState === 4 && this.status === 200){
            document.getElementById('tablaProductos').innerHTML=this.responseText;
        }
    };
    ajax.send(params);
    return false;
}

function buscar() {

}