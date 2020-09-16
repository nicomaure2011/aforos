<?php


class Consultas {
    
    
    
    function buscar_categoria() {
        require_once('../data/conexion.php');//TERCER CAMBIO
        $consulta;
        $query = $conn->query("SELECT * FROM categorias");
        $i = 0;
        while ($valores = mysqli_fetch_array($query)) {
        // En esta sección estamos llenando el select con datos extraidos de una base de datos.
            //$consulta = [" id_area" .$valores['id_area']."  " ."nombre". $valores['nombre_area']] ;//ACÁ DEBERIAS ARMAR UN ARRAY PARA DEVOLVER A LA VISTA Y QUE LO TRABAJE EL JQUERY
            $consulta[$i] = [$valores['id_categoria'],$valores['nombre_categoria'],$valores['coeficiente_categoria']] ;
            $i++;
       }
        echo json_encode($consulta);
       
    }
    
    
    //METODO PARA TRAER LOS DESTINOS
    function buscar_destino() {
        require_once('../data/conexion.php');//TERCER CAMBIO
        $consulta;
        $query = $conn->query("SELECT * FROM destinos");
        $i = 0;
        while ($valores = mysqli_fetch_array($query)) {
        // En esta sección estamos llenando el select con datos extraidos de una base de datos.
            //$consulta = [" id_area" .$valores['id_area']."  " ."nombre". $valores['nombre_area']] ;//ACÁ DEBERIAS ARMAR UN ARRAY PARA DEVOLVER A LA VISTA Y QUE LO TRABAJE EL JQUERY
            $consulta[$i] = [$valores['id_destino'],$valores['nombre_destino'],$valores['coeficiente_destino']] ;
            $i++;
       }
        echo json_encode($consulta);
    }
    
    function getUtm(){
        //echo "<script>alert();</script>";
        require_once('../data/conexion.php');//TERCER CAMBIO
        //$consulta;
        //con esta query traigo la ultima utm agregada, es decir la mas actual
        $query = $conn->query("SELECT * FROM utm ORDER BY id_utm ASC");
        
       $i = 0;
       while ($valores = mysqli_fetch_array($query)) {
        // En esta sección estamos llenando el select con datos extraidos de una base de datos.
            //$consulta = [" id_area" .$valores['id_area']."  " ."nombre". $valores['nombre_area']] ;//ACÁ DEBERIAS ARMAR UN ARRAY PARA DEVOLVER A LA VISTA Y QUE LO TRABAJE EL JQUERY
            $consulta = [$valores['id_utm'],$valores['valor']];
            $i++;
            
       }
      echo json_encode($consulta);
    }
    
    

}







    

