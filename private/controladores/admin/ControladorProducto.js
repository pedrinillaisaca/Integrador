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
    formData = new FormData($('#formulario')[0]);
    formData.append('metodo', 'imagen');
    $.ajax({
        type: "POST",
        url: '/Bellisima/private/controladores/admin/Controlador_Producto.php',
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
    let url = '/Bellisima/private/controladores/admin/Controlador_Producto.php';
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

function abrirParaModificar(param){
    window.location = '../../vista/admin/Producto.html?id='+param;
}

function cargarParaEditar(id){
    let ajax = new XMLHttpRequest();
    let url = '/Bellisima/private/controladores/admin/Controlador_Producto.php';
    let params = 'metodo=editar&id='+id;
    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function () {
        if(this.status === 200 && this.readyState === 4){
            let retorno = this.responseText;
            let spliteo = retorno.split(';');
            document.getElementById('precio').value = spliteo[1];
            document.getElementById('iva').value = spliteo[2];
            document.getElementById('stock').value = spliteo[3];
            let spliteoTalla = spliteo[4].split(',');
            if(spliteoTalla[0] ==='S') document.getElementById('small').checked = true;
            if(spliteoTalla[1] ==='M') document.getElementById('medium').checked = true;
            if(spliteoTalla[2] ==='L') document.getElementById('large').checked = true;
            document.getElementById('nombre').value = spliteo[5];
            document.getElementById('descripcion').value = spliteo[7];
            document.getElementById('color').value = spliteo[6];
        }
    };
    ajax.send(params);
    return false;
}

function abrirModificar(origen){
    abrirParaModificar(origen.id);
}

function actualizar(){
    if(document.getElementById('abrir_img').getAttribute('src') !== ""){
        formData = new FormData($('#formulario')[0]);
        formData.append('metodo', 'updateImg');
        let leu = document.getElementById('hidden_id').value;
        formData.append('prod_id', leu);
        $.ajax({
            type: "POST",
            url: '/Bellisima/private/controladores/admin/Controlador_Producto.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                updateProducto(data, true);
            }
        });
    }else{
        updateProducto(document.getElementById('hidden_id').value, false);
    }
}

function updateProducto(data, state_img){
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
    let prod_id = document.getElementById('hidden_id').value;
    let ajax = new XMLHttpRequest();
    let url = '/Bellisima/private/controladores/admin/Controlador_Producto.php';
    let params = 'metodo=actualizar&nombre_img='+data+'&precio='+precio+'&iva='+iva+'&stock='+stock+'&talla='+talla
        +'&nombre='+nombre+'&descripcion='+descripcion+'&color='+color+'&='+prod_id+'&=check_img='+state_img;
    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function () {
        if(ajax.readyState === 4 && ajax.status === 200){
            alert(this.responseText + '<---');
            if(this.responseText === 1){
                alert('Se ha actualizado el producto correctamente.');
            }else{
                alert('No se ha podido actualizar el producto.');
            }
        }
    };
    ajax.send(params);
    return false;
}

function eliminar(param){
    let id = param.id;
    let ajax = new XMLHttpRequest();
    let url = '/Bellisima/private/controladores/admin/Controlador_Producto.php';
    let params = 'metodo=borrar&id='+id;
    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function () {
        if(this.readyState === 4 && this.status === 200){
            alert(this.responseText);
        }
    };
    ajax.send(params);
    return false;
}

function mostrarProducto(){
    let ajax = new XMLHttpRequest();
    let url = '/Bellisima/private/controladores/admin/Controlador_Producto.php';
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
    let ajax = new XMLHttpRequest();
    let url = '/Bellisima/private/controladores/admin/Controlador_Producto.php';
    let elemento = document.getElementById('tablita');
    if(elemento!=null){
        elemento.parentNode.removeChild(elemento);
    }
    let valor = document.getElementById('txt_buscar').value;
    let params = 'metodo=buscar&valor='+valor;
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