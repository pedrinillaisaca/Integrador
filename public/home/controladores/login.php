<?php
 session_start();
 include '../../../config/conexionBD.php';
 $usuario = isset($_POST["mail"]) ? trim($_POST["mail"]) : null;
 $contrasena = isset($_POST["password"]) ? trim($_POST["password"]) : null;
 $sql = "SELECT * FROM persona WHERE per_email = '$usuario' and per_password =
MD5('$contrasena')";
 	$result = $conn->query($sql);
	if($result->num_rows > 0){
	    $_SESSION['isLogged'] = TRUE;
	    while($row=$result->fetch_assoc()){
	        $codigo=$row['per_id'];
            if($row["per_rol"]=='A'){
                echo 'admin'.';'.$codigo;
            }else if ($row["per_rol"]=='U'){
                $codigo=$row['per_id'];
                echo 'user'.';'.$codigo;
            }
        }
	}else{
        echo $sql;
        echo ('algo salio mal');
       //header("Location: ../vista/login.html");
	}

	$conn->close();
?>