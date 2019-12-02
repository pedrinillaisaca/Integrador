
<!DOCTYPE html> 
<html> 
<head> 
    <meta charset="UTF-8"> 
    <title>Modificar datos de persona</title>     
</head> 
 
<body> 
    <?php 
    $codigo = $_GET["codigo"];   
    
    ?> 
 
    <form id="formulario01" method="POST" action="index.php"> 
         
        <input type="hidden" id="codigo" name="codigo" value="<?php echo ($codigo) ?>" /> 
 
        
        <input type="submit" id="modificar" name="modificar" value="Modificar" /> 
        <input type="reset" id="cancelar" name="cancelar" value="Cancelar" /> 
    </form>                                 
 
</body> 
</html>
