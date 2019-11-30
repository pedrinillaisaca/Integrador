<?php
session_start();
if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] === FALSE){
header("Location: /Bellisima/public/home/vista/login.html");
}else{

}

?>