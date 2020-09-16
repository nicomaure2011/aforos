<?php

$arrayParamGet = filter_input_array(INPUT_GET); //creo un Array con los datos q filtro desde el HTML que vienen con el metodo GET
$arrayParamPost = filter_input_array(INPUT_POST); //creo un Array con los datos q filtro desde el HTML que vienen con el metodo POST
//$datosCampos = filter_input_array(INPUT_GET);//descomentar para realizar pruebas harcodeadas a la BD
if ($arrayParamGet != NULL) {//si los datos vienen por GET ingresa en este if
    $accion = filter_input(INPUT_GET, 'metodo'); //filtrando datos cargo la variable accion
         
} else if ($arrayParamPost != NULL) {//si viene por POST compruebo q tenga la llave accion para enviar al switch
   $accion = filter_input(INPUT_POST, 'accion'); //cargo con el filtrado input de las variables la accion que va hacia el metodo switch
   //$item = filte_input(INPUT_POST,'item2'); 
    $datosCampos = filter_input_array(INPUT_POST); //cargo con el input_array todos los datos que llegan por POST en la variable $datosCampos q luego deberan ser enviados al switch
    //$nombreformulario = filter_input(INPUT_POST, 'nombreFormulario'); //cargo con el filtrado input de las variables la accion que va hacia el metodo switch
    //$id = $arrayParamPost["id"];
} 

require_once '../models/Consultas.php';
$consulta = new Consultas();




switch ($accion) {//segun el valor de la variable accion, voy a entrar al case especifico
    
    case "guardar":  
        require_once('../data/conexion.php');
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $fecha =  date('d-m-yy H:i:s');
        $sql = ("INSERT INTO calculo_aforo (usuario_calculo,fecha_calculo,nombre_propietario, apellido_propietario,domicilio,padron,area,superficie,destino,categoria,utm,valor_base,derecho_oc_doc,derecho_oc_insp,derecho_is_doc,derecho_is_insp,derecho_ie_doc,derecho_ie_insp,derecho_ici_doc,derecho_ici_insp,recargo_oc,recargo_is,recargo_ie,recargo_ici,recargo_oc_emplazado,recargo_is_emplazado,recargo_ie_emplazado,recargo_ici_emplazado,total_aforo)"
                . "VALUES ('".$datosCampos['usuario_calculo']."','".$fecha."','".$datosCampos['nombrePropietario']."','".$datosCampos['apellidoPropietario']."','".$datosCampos['domicilio']."','".$datosCampos['padron']."','".$datosCampos['area_seleccionada']."',".$datosCampos['superficie1'].",'".$datosCampos['destino_seleccionado']."','".$datosCampos['categoria_seleccionada']."',".$datosCampos['utm'].",".$datosCampos['valor_base'].",".$datosCampos['derechoOcDoc'].",".$datosCampos['derechoOcInsp'].",".$datosCampos['derechoIsDoc'].",".$datosCampos['derechoIsInsp'].",".$datosCampos['derechoIeDoc'].",".$datosCampos['derechoIeInsp'].",".$datosCampos['derechoIciDoc'].",".$datosCampos['derechoIciInsp'].",".$datosCampos['recargoOC'].",".$datosCampos['recargoIS'].",".$datosCampos['recargoIE'].",".$datosCampos['recargoICI'].",".$datosCampos['recargoOCEmplazado'].",".$datosCampos['recargoISEmplazado'].",".$datosCampos['recargoIEEmplazado'].",".$datosCampos['recargoICIEmplazado'].",".$datosCampos['txt_total'].")");
         if(mysqli_query($conn,$sql)){
             echo json_encode($sql);
         }else{
             echo "Error: " . $sql . "<br>" . mysqli_error($conn);
         }    
        break;
        
        case "categoria":  
        $consulta->buscar_categoria();
        break;
    
    case "destino":  
        $consulta->buscar_destino();
        break;
    
    case "utm":  
        $consulta->getUtm();
        break;
   
    
        default:
        break;
}
//traigo el id del ultimo aforo ingresado
     /*   $id;
        
        $query = $conn->query("SELECT MAX(id_calculo_aforo) FROM calculo_aforo");
        
        $i = 0;
       
        while ($valores = mysqli_fetch_array($query)) {
        
          //  $consulta[$i] = [$valores['id_calculo_aforo'],$valores['usuario_calculo'],$valores['fecha_calculo'],$valores['nombre_propietario'],$valores['apellido_propietario'],$valores['domicilio'],$valores['padron'],$valores['utm'],$valores['total_aforo']] ;
             $id[$i] = [$valores[0]];
            $i++;
       }*/
/*
while($item){
    
    require_once('../data/conexion.php');
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $fecha =  date('d-m-yy H:i:s');
        $sql = ("INSERT INTO calculo_aforo (usuario_calculo,fecha_calculo,nombre_propietario, apellido_propietario,domicilio,padron,area,superficie,destino,categoria,utm,valor_base,derecho_oc_doc,derecho_oc_insp,derecho_is_doc,derecho_is_insp,derecho_ie_doc,derecho_ie_insp,derecho_ici_doc,derecho_ici_insp,recargo_oc,recargo_is,recargo_ie,recargo_ici,recargo_oc_emplazado,recargo_is_emplazado,recargo_ie_emplazado,recargo_ici_emplazado,total_aforo)"
                . "VALUES ('".$datosCampos['usuario_calculo']."','".$fecha."','".$datosCampos['nombrePropietario']."','".$datosCampos['apellidoPropietario']."','".$datosCampos['domicilio']."','".$datosCampos['padron']."','".$datosCampos['area_seleccionada']."',".$datosCampos['superficie2'].",'".$datosCampos['destino_seleccionado']."','".$datosCampos['categoria_seleccionada']."',".$datosCampos['utm'].",".$datosCampos['valor_base'].",".$datosCampos['derechoOcDoc'].",".$datosCampos['derechoOcInsp'].",".$datosCampos['derechoIsDoc'].",".$datosCampos['derechoIsInsp'].",".$datosCampos['derechoIeDoc'].",".$datosCampos['derechoIeInsp'].",".$datosCampos['derechoIciDoc'].",".$datosCampos['derechoIciInsp'].",".$datosCampos['recargoOC'].",".$datosCampos['recargoIS'].",".$datosCampos['recargoIE'].",".$datosCampos['recargoICI'].",".$datosCampos['recargoOCEmplazado'].",".$datosCampos['recargoISEmplazado'].",".$datosCampos['recargoIEEmplazado'].",".$datosCampos['recargoICIEmplazado'].",".$datosCampos['txt_total'].")");
         if(mysqli_query($conn,$sql)){
             echo json_encode($sql);
         }else{
             echo "Error: " . $sql . "<br>" . mysqli_error($conn);
         }  
}*/
//$metodo = $_GET["metodo"];
/*
switch ($metodo) {//segun el valor de la variable accion, voy a entrar al case especifico
    
    case "categoria":  
        $consulta->buscar_categoria();
        break;
    
    case "destino":  
        $consulta->buscar_destino();
        break;
    
    case "utm":  
        $consulta->getUtm();
        break;
   
    
        default:
        break;
}
*/







