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
    alert('entra');
    let file = document.getElementById('abrir_img').files[0];
    let dataImg = new FormData();
    data.append('img', file);

    $.ajax({
        type: 'GET',
        url: '/Integrador/private/controladores/admin/Controlador_Producto.php',
        data: dataImg,
        dataType: 'json',
        success: function (data) {
            for(let i in data){
                let entry = data[i];
            }
            alert('SUCESFUL :v');
        }
    });

}