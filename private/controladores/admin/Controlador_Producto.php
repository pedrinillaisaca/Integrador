<?php
include '../../../config/conexionDB.php';

if($_POST['metodo'] === 'imagen'){
    $leo = $_FILES['file']['name'];
    $dir_subida = '/Integrador/imgs/';
    $fichero_subido =$dir_subida . basename($_FILES['file']['name']);

    $sql = 'select max(producto_id) as maximo from producto';
    $result = $conn->query($sql);
    $valor_maximo = 0;
    while($row = $result->fetch_assoc()){
        $valor_maximo = $row['maximo'] + 1;
    }
    $conn->close();
    if (move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/Integrador/imgs/private/'.$valor_maximo.'.jpg')) {
        echo $valor_maximo.'.jpg';
    }
}

if($_POST['metodo'] === 'insertar'){

    insertar();
}else if($_POST['metodo'] === 'listarProductos') {
    listar();
}else if($_POST['metodo'] === 'actualizar'){
    actualizar();
}else if($_POST['metodo'] === 'borrar'){
    borrar();
}else if($_POST['metodo'] === 'buscar'){
    buscar();
}

function insertar(){
    $nombre_img = $_POST['nombre_img'];
    $precio  = $_POST['precio'];
    $iva  = $_POST['iva'];
    $stock  = $_POST['stock'];
    $talla  = $_POST['talla'];
    $nombre  = $_POST['nombre'];
    $color  = $_POST['color'];
    $descripcion  = $_POST['descripcion'];

    global $conn;
    $sql = "insert into producto(producto_img, producto_precio, producto_iva, producto_stock, producto_talla,
                     producto_nombre, producto_color, producto_descripcion) values ('$nombre_img', '$precio', '$iva',
                                                                                 '$stock', '$talla', '$nombre', '$color', '$descripcion')";
    if($conn->query($sql) === TRUE){
        echo 1;
    }else{
        echo $conn->error;
        echo "<p>No se ha podido ingresar el producto</p>";
    }
    $conn->close();
}

function listar(){
    global $conn;
    $sql = "select producto_precio, producto_iva, producto_stock, producto_talla, producto_nombre, producto_color,
       producto_descripcion from producto";
    $resultado = $conn->query($sql);
    if($resultado->num_rows > 0){
        echo "<label for='txt_buscar'>Nombre del producto:</label>";
        echo "<input id='txt_buscar' type='text' placeholder='Nombre' onkeyup='buscar()'>";
        echo "<table id='tablita'>";
        echo "<tr>";
        echo "<th>Nombre</th>";
        echo "<th>Descripcion</th>";
        echo "<th>Precio</th>";
        echo "<th>IVA</th>";
        echo "<th>Stock</th>";
        echo "<th>Talla</th>";
        echo "<th>Color</th>";
        echo "<th>MODIFICAR</th>";
        echo "<th>ELIMINAR</th>";
        echo "</tr>";
        while($row = $resultado->fetch_assoc()){
            array_push($response, $row['producto_nombre'], $row);
            echo "<tr>";
                echo "<td>" . $row['producto_nombre'] . "</td>";
                echo "<td>" . $row['producto_descripcion'] . "</td>";
                echo "<td>" . $row['producto_precio'] . "</td>";
                echo "<td>" . $row['producto_iva'] . "</td>";
                echo "<td>" . $row['producto_stock'] . "</td>";
                echo "<td>" . $row['producto_talla'] . "</td>";
                echo "<td>" . $row['producto_color'] . "</td>";
                echo "<td>" . "<button onclick='abrirModificar()'>MODIFICAR</button>" . "</td>";
                echo "<td>" . "<button id='elm' onclick='eliminar()'>ELIMINAR</button>" . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    $conn->close();
}

function actualizar(){

}

function borrar(){

}

function buscar(){

}

function crearTabla($result){

}
?>