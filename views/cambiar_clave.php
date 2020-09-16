<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
session_start();
require_once('../data/conexion.php');
$idUsuario = $_SESSION['id_usuario'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Cambiar clave</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css'>
	<link rel="stylesheet" href="../css/styles.css">


</head>
<body>

<div class="global-container">
	<div class="card login-form">
	<div class="card-body">
		<div align="center">
			<img src="../images/logo_gllen.png">
		</div>
		<h3 class="card-title text-center">Cambiar clave</h3>
		<div class="card-text">
			<!--
			<div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect username or password.</div> -->
			<form action="../validar_cambio_clave.php" method="post">
				<!-- to error: add class "has-danger" -->
				<div class="form-group">
					<label for="claveActual">Contraseña Actual</label>
                                        <input type="password" class="form-control form-control-sm" name="claveActual" id="claveActual" autofocus="true">
				</div>
				<div class="form-group">
					<label for="claveNueva">Nueva Contraseña</label>
					<input type="password" class="form-control form-control-sm" id="claveNueva" name="claveNueva">
				</div>
                                
                                <div class="form-group">
					<label for="claveNueva2">Repetir Contraseña</label>
					<input type="password" class="form-control form-control-sm" id="claveNueva2" name="claveNueva2">
				</div>
				<button type="submit" class="btn btn-primary btn-block">Guardar</button>

				<div class="sign-up text-secondary">
					Desarrollado por Nicolás Maure - 2020
				</div>
			</form>
		</div>
	</div>
</div>
</div>
</body>
</html>

