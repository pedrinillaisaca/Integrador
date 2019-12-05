<?php
session_start();
$_SESSION['isLogged'] = FALSE;
session_destroy();
header("Location: ../../../public/home/vista/index.php");
?>