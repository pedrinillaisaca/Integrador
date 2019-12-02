<?php
session_start();
include '../../../config/conexionBD.php';

if($_POST['metodo'] === 'imagen'){
    $leo = $_FILES['file']['name'];
    $dir_subida = '/Bellisima/imgs/';
    $fichero_subido =$dir_subida . basename($_FILES['file']['name']);

    $sql = 'select max(producto_id) as maximo from producto';
    $result = $conn->query($sql);
    $valor_maximo = 0;
    while($row = $result->fetch_assoc()){
        $valor_maximo = $row['maximo'] + 1;
    }
    $conn->close();
    if (move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/Bellisima/imgs/private/'.$valor_maximo.'.jpg')) {
        echo $valor_maximo.'.jpg';
    }
}else if($_POST['metodo'] === 'updateImg'){
    $id = $_POST['prod_id'];
    $leo = $_FILES['file']['name'];
    $dir_subida = '/Bellisima/imgs/';
    $fichero_subido = $dir_subida . basename($_FILES['file']['name']);

    if(move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/Bellisima/imgs/private/'.$id.'.jpg')){
        echo $id;
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
}else if($_POST['metodo'] === 'editar'){
    getProducto();
}

function getProducto(){
    $id = $_POST['id'];
    global $conn;
    $sql = "select * from producto where producto_id='$id'";
    $result = $conn->query($sql);
    $strProducto = "";
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $strProducto = $strProducto . $row['producto_img'] .';'. $row['producto_precio'] .';'. $row['producto_iva'] .';'. $row['producto_stock']
                .';'. $row['producto_talla'] .';'. $row['producto_nombre'] .';'. $row['producto_color'] .';'. $row['producto_descripcion'];
        }
        echo $strProducto;
    }
    $conn->close();
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
    $sql = "select producto_id, producto_precio, producto_iva, producto_stock, producto_talla, producto_nombre, producto_color,
       producto_descripcion from producto where producto_eliminado = 'N'";
    $resultado = $conn->query($sql);
    if($resultado->num_rows > 0){
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
            echo "<tr>";
                echo "<td>" . $row['producto_nombre'] . "</td>";
                echo "<td>" . $row['producto_descripcion'] . "</td>";
                echo "<td>" . $row['producto_precio'] . "</td>";
                echo "<td>" . $row['producto_iva'] . "</td>";
                echo "<td>" . $row['producto_stock'] . "</td>";
                echo "<td>" . $row['producto_talla'] . "</td>";
                echo "<td>" . $row['producto_color'] . "</td>";
            echo "<td>" . "<button id='". $row['producto_id'] ."' onclick='abrirModificar(this)'>MODIFICAR</button>" . "</td>";
            echo "<td>" . "<button id='". $row['producto_id'] ."' onclick='eliminar(this)'>ELIMINAR</button>" . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    $conn->close();
}

function actualizar(){
    global $conn;
    $nombre_img = $_POST['nombre_img'];
    $precio  = $_POST['precio'];
    $iva  = $_POST['iva'];
    $stock  = $_POST['stock'];
    $talla  = $_POST['talla'];
    $nombre  = $_POST['nombre'];
    $color  = $_POST['color'];
    $prod_id = $nombre_img;
    $nombre_img = $nombre_img . '.jpg';
    $descripcion  = $_POST['descripcion'];
    $sql = "update producto set producto_img='$nombre_img', producto_precio='$precio', producto_iva='$iva', producto_stock='$stock',
                producto_talla='$talla', producto_nombre='$nombre', producto_color='$color', producto_descripcion='$descripcion' where producto_id='$prod_id'";
    if($conn->query($sql)== TRUE){
        echo 1;
    }else{
        echo 2;
    }
    $conn->close();
}

function borrar(){
    global $conn;
    $prod_id = $_POST['id'];
    $sql = "update producto set producto_eliminado = 'S' where producto_id='$prod_id'";
    if($conn->query($sql) === TRUE){
        echo 1;
    }else{
        echo 2;
    }
    $conn->close();
}

function buscar(){
    global  $conn;
    $buscar = $_POST['valor'];
    $sql = "select producto_id, producto_precio, producto_iva, producto_stock, producto_talla, producto_nombre, producto_color,
       producto_descripcion from producto where producto_nombre like '%" . $buscar . "%' and producto_eliminado = 'N'";

    $resultado = $conn->query($sql);
    if($resultado->num_rows >0){
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
            echo "<tr>";
            echo "<td>" . $row['producto_nombre'] . "</td>";
            echo "<td>" . $row['producto_descripcion'] . "</td>";
            echo "<td>" . $row['producto_precio'] . "</td>";
            echo "<td>" . $row['producto_iva'] . "</td>";
            echo "<td>" . $row['producto_stock'] . "</td>";
            echo "<td>" . $row['producto_talla'] . "</td>";
            echo "<td>" . $row['producto_color'] . "</td>";
            echo "<td>" . "<button id='". $row['producto_id'] ."' onclick='abrirModificar(this)'>MODIFICAR</button>" . "</td>";
            echo "<td>" . "<button id='". $row['producto_id'] ."' onclick='eliminar(this)'>ELIMINAR</button>" . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    $conn->close();
}
?>