<?php
session_start();
if ($_SESSION['rol'] != "admin") {
 header("Location:sesion_caducada.php");
 session_destroy();
	//ahora funciona, hay q cerrar el navegador y abrirlo de nuevo
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Aforos</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css'>
	<link rel="stylesheet" href="../css/styles.css">
         <script src="../js/jquery-3.1.1.min.js"></script>

</head>
<body>

	<div class="global-container">
	<div class="card login-form">
	<div class="card-body">
		<h3 class="card-title text-center">Crear nuevo usuario</h3>
		<div class="card-text">
			<!--
			<div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect username or password.</div> -->
                        <form action="../controllers/registrar_usuario.php" method="post">
				<!-- to error: add class "has-danger" -->
				<div class="form-group">
					<label for="nombreUsuario">Usuario</label>
					<input type="text" class="form-control form-control-sm" id="nombreUsuario" name="nombreUsuario" required>
				</div>
				<div id="result-username" align="center"></div>

				<div class="form-group">
				<label for="combo_rol">Rol</label>
                     <select id="combo_rol" name="combo_rol" class="form-control" required>
                        <option>Seleccione un rol</option>
                        <option value="admin">1- Administrador</option>
                        <option value="normal">2- Usuario normal</option>

                     </select>
                 </div>

				

				<div class="form-group">
					<label for="contraseña">Contraseña</label>
					<input type="password" class="form-control form-control-sm" name="contraseña" required>
				</div>

				<div class="form-group">
					<label for="confirmaContraseña">Confirme Contraseña</label>
					<input type="password" class="form-control form-control-sm" name="confirmaContraseña" required>
				</div>

				<button type="submit" class="btn btn-primary btn-block" name="btn_guardar">Registrar</button>


			</form>
		</div>
	</div>
</div>
</div>

<script type="text/javascript">//script para verificar si el nombre de usuario ya existe
$(document).ready(function() {
    $('#nombreUsuario').on('blur', function() {
        $('#result-username').html('<img src="../images/cargando2.gif" />').fadeOut(1000);

        var username = $(this).val();
        var dataString = 'username='+username;

        $.ajax({
            type: "POST",
            url: "../check_username_availability.php",
            data: dataString,
            success: function(data) {
                $('#result-username').fadeIn(1000).html(data);
            }
        });
    });
});
</script>
</body>
</html>