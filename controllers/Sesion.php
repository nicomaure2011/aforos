<?php

session_start();
$rta = ["id_usuario"=>$_SESSION["id_usuario"], 
    "nombre_usuario"=>$_SESSION["nombre_usuario"], 
    "rol"=>$_SESSION["rol"]];
echo json_encode($rta);
