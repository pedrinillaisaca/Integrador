


    //if(letras.indexOf(tecla)==-1 && !tecla_especial){
      //  return false;
    //}
//}
function soloNumeros(e)
{
    var key = window.Event ? e.which : e.keyCode
    return ((key >= 48 && key <= 57) || (key==8))

}



function validarTelefono(elemento){
    if (elemento.value.length <11) {
        return false;
    }else{
        elemento.value=elemento.value.substring(0,elemento.value.length-1);
    }

}
function numerotelefono(){
    if(document.getElementById('telefonos').value.length <9 ){
        alert("Error: telefono" + " es invalida");
        document.getElementById('telefonos').style.border='1px red solid';
        document.getElementById('mensajeTelefono').innerHTML='<br>telefono invalido';
        return false;
    }
}

function validarCedula() {
    console.log();
    var cad = document.getElementById("cedula").value.trim();
    var total = 0;
    var longitud = cad.length;
    var longcheck = longitud - 1;

    if (cad !== "" && longitud === 10) {
        for (i = 0; i < longcheck; i++) {
            if (i % 2 === 0) {
                var aux = cad.charAt(i) * 2;
                if (aux > 9) aux -= 9;
                total += aux;
            } else {
                total += parseInt(cad.charAt(i)); // parseInt o concatenará en lugar de sumar
            }
        }

        total = total % 10 ? 10 - total % 10 : 0;

        if (cad.charAt(longitud - 1) == total) {
            console.log("La cedula" + " es valida");

        } else {
            alert("Error: La cedula" + " es invalida");
            document.getElementById('cedula').style.border='1px red solid';
            document.getElementById('mensajeCedula').innerHTML='<br> la cedula invalida';
            return false;

        }
    }
}

function validarEmail(){
    var cadena = document.getElementById('correo').value,
        separador = "@", // un espacio en blanco
        arregloDeSubCadenas = cadena.split(separador);
    if((arregloDeSubCadenas[1]==='est.ups.edu.ec' || arregloDeSubCadenas[1]==='ups.edu.ec') && arregloDeSubCadenas[0].length > 2  ){
        console.log('correo valido');
        return true;

    }else{
        document.getElementById('correo').style.border='1px red solid';
        document.getElementById('mensajeCorreo').innerHTML='<br>correo invalido';
        console.log('correo invalido');
        return false;
    }

    console.log(arregloDeSubCadenas);
}



function validar_clave()
{
    let contrasenna= document.getElementById('password').value;
    console.log(contrasenna)

    if(contrasenna.length > 7)
    {
        var mayuscula = false;
        var minuscula = false;
        var numero = false;
        var caracter_raro = false;

        for(var i = 0;i<contrasenna.length;i++)
        {
            if(contrasenna.charCodeAt(i) >= 65 && contrasenna.charCodeAt(i) <= 90)
            {
                mayuscula = true;
            }
            else if(contrasenna.charCodeAt(i) >= 97 && contrasenna.charCodeAt(i) <= 122)
            {
                minuscula = true;
            }
            else if(contrasenna.charCodeAt(i) >= 48 && contrasenna.charCodeAt(i) <= 57)
            {
                numero = true;
            }
            else
            {
                caracter_raro = true;
            }
        }
        if(mayuscula == true && minuscula == true && caracter_raro == true && numero == true)
        {

            return true;
        }
    }
    document.getElementById('password').style.border='1px red solid';
    document.getElementById('mensajePassword').innerHTML='<br>Contrasena invalida';
    console.log('Clave no cumple con los requisitos');
    return false;

}

