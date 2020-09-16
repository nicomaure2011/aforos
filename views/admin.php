<?php
session_start();
if ($_SESSION['rol'] != "admin") {
 header("Location:sesion_caducada.php");
 session_destroy();
	//ahora funciona, hay q cerrar el navegador y abrirlo de nuevo
}
?>


<!doctype html>
<html lang="en">
  <head>
      <title>Admin</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/stylesAdmin.css"

    
  </head>
  <body>
      <div class="d-flex">
          <div id="sidebar-container" class="bg-primary2">
              <div class="logo">
                  <h4 class="text-light font-weight-bold">Sistema de Aforos</h4>
              </div>
              <div class="menu">
                  <a href="#" class="d-block text-light p-3">Administrar Usuarios</a>
                  <a href="#" class="d-block text-light p-3">Administrar Áreas</a>
                  <a href="#" class="d-block text-light p-3">Administrar Destinos</a>
                  <a href="#" class="d-block text-light p-3">Administrar Categorías</a>
              </div>
          </div>
      </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>