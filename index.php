<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
require_once('data/conexion.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Aforos</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css'>
	<link rel="stylesheet" href="css/styles.css">


</head>
<body>

<div class="global-container">
	<div class="card login-form">
	<div class="card-body">
		<div align="center">
			<img src="images/logo_gllen.png">
		</div>
		<h3 class="card-title text-center">Ingreso al Sistema</h3>
		<div class="card-text">
			<!--
			<div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect username or password.</div> -->
			<form action="validar.php" method="post">
				<!-- to error: add class "has-danger" -->
				<div class="form-group">
					<label for="exampleInputEmail1">Usuario</label>
					<input type="text" class="form-control form-control-sm" name="nombreUsuario" autofocus="true">
				</div>
				<div class="form-group">
					<label for="password">Contraseña</label>
					<input type="password" class="form-control form-control-sm" id="clave" name="clave">
				</div>
				<button type="submit" class="btn btn-primary btn-block">Entrar</button>

				<div class="sign-up text-secondary">
                                    Desarrollado por Nicolás Maure - 2020<br>
                                    Versión 1.0
				</div>
			</form>
		</div>
	</div>
</div>
</div>
</body>
</html>