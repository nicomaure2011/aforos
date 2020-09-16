<?php
require('data/conexion.php');
sleep(1);
if (isset($_POST)) {
    $username = $_POST['username'];//este 'username' es el que trae del script

    $result = $conn->query(
        'SELECT * FROM usuarios WHERE nombre_usuario = "'.strtolower($username).'"'
    );

    if ($result->num_rows > 0) {
        echo '<div class="alert alert-danger"> Nombre de usuario no disponible.</div><br>';
    }
}