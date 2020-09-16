<?php
session_start();
require_once '../data/conexion.php';

$id_usuario = $_SESSION['id_usuario'];
?>


<?php
if (isset($_POST['btn_guardar'])) {
	$usuario = $_POST['nombreUsuario'];
	$password= md5($_POST['contraseña']);
    $conf_contraseña=md5($_POST['confirmaContraseña']);
    $rol = $_POST['combo_rol'];
	

         if($password != $conf_contraseña ){
             
             echo '<script>alert("LAS CONTRASEÑAS NO COINCIDEN")</script> ';
             echo '<script>location.href="../views/crear_usuario.php"</script>';
                
         }else if($rol == "Seleccione un rol"){       
		echo '<script>alert("DEBE SELECCIONAR UN ROL")</script> ';
                echo '<script>location.href="../views/crear_usuario.php"</script>';
                
                
		
         }else {
                $sentencia = "INSERT INTO  usuarios (nombre_usuario, contraseña, rol) VALUES ('$usuario', '$password', '$rol')";

                $result = mysqli_query($conn, $sentencia);
                echo '<script>alert("NUEVO USUARIO  INGRESADO")</script> ';
		echo '<script>location.href="../index.php"</script>';
         }




	}


?>







 <?php

//require_once 'static/footer.php'

?>