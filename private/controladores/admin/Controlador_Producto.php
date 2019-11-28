<?php
    $target_dir = 'C:/Users/Leo Alvarado/Desktop/';
    $target_file = $target_dir . basename($_FILES['file']['tpm_name']);
    $updaloadok = 1;
    $imgFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if(move_uploaded_file($_FILES['file']['tpm_name'], $target_dir)){
        echo "A la vrg vale vrg perro";
    }else{
        echo "No se fue nada a la vrg :(";
    }
?>