<?php
session_start();
$_SESSION['isLogged'] = FALSE;
session_destroy();
header("Location: /Bellisima/public/home/vista/login.html");
?>