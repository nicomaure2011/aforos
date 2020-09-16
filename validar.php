<?php
session_start();
require_once 'data/conexion.php';

$usuario = $_POST['nombreUsuario'];
$clave = md5($_POST['clave']);


$resultados = mysqli_query($conn, "SELECT * from usuarios where nombre_usuario = '$usuario' and contraseña = '$clave'");

if ($f = mysqli_fetch_array($resultados)) {

	if($f['rol'] == "admin"){

		$_SESSION['id_usuario'] = $f['id_usuario'];
		$_SESSION['nombre_usuario'] = $f['nombre_usuario'];
		$_SESSION['rol'] = $f['rol'];
		$_SESSION['area'] = $f['area'];
		header("Location:views/admin.php");
		//echo '<script>location.href="admin.php"</script>';
	}else if ($f['rol'] == "normal"){
		$_SESSION['id_usuario'] = $f['id_usuario'];
		$_SESSION['nombre_usuario'] = $f['nombre_usuario'];
		$_SESSION['rol'] = $f['rol'];
		$_SESSION['area'] = $f['area'];
		header("Location:views/vista_aforos.php");
	}
} else {
	
	echo '<script>alert("Usuario y/o clave incorrectos")</script>';
	echo '<script>location.href="index.php"</script>';


}


?>


