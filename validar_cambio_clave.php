<?php

session_start();
require_once 'data/conexion.php';

$idUsuario = $_SESSION['id_usuario'];
$claveActual = md5($_POST['claveActual']);
$claveNueva = md5($_POST['claveNueva']);
$claveNueva2 = md5($_POST['claveNueva2']);


if($claveNueva != $claveNueva2){
    echo "<script>alert('Las contraseñas NO coinciden.')</script>";
    echo '<script>location.href="views/cambiar_clave.php"</script>';
    
}else{
     $sql = "UPDATE usuarios SET contraseña = '".$claveNueva."' WHERE id_usuario = ".$idUsuario."";
 if ($conn->query($sql) === TRUE) {
    echo "<script>alert('La clave se actualizó correctamente.')</script>";
    echo '<script>location.href="views/vista_aforos.php"</script>';
 }else {
  echo "<script>alert('Error al actualizar la clave')</script>";
  echo '<script>location.href="views/cambiar_clave.php"</script>';
 }
 mysqli_close($conn);
}

