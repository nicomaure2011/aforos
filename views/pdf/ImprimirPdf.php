<?php ob_start();?>

<?php 

    require_once('../../data/conexion.php');//TERCER CAMBIO
        $consulta;
        $resultado=array();
        $query = $conn->query("SELECT MAX(id_calculo_aforo) FROM calculo_aforo");
        // var_dump($query);
        //$query2 = $conn->query("SELECT * FROM calculo_aforo WHERE id_calculo_aforo=".$query[0]);
        $i = 0;
       
        while ($valores = mysqli_fetch_array($query)) {
        
          //  $consulta[$i] = [$valores['id_calculo_aforo'],$valores['usuario_calculo'],$valores['fecha_calculo'],$valores['nombre_propietario'],$valores['apellido_propietario'],$valores['domicilio'],$valores['padron'],$valores['utm'],$valores['total_aforo']] ;
             $consulta[$i] = [$valores[0]];
            $i++;
       }
       //  $query2 = $conn->query("SELECT * FROM calculo_aforo WHERE id_calculo_aforo=".$consulta[0]);
       //var_dump($query2);
        //echo json_encode($consulta);
       //$html = $consulta;
       foreach ($consulta as $key => $value) {
           foreach ($value as $llave => $valor) {
               $query2 = $conn->query("SELECT * FROM calculo_aforo WHERE id_calculo_aforo=".$valor);
              
           }
           
   }
   while ($valores = mysqli_fetch_array($query2)) {
        
           $consulta[$i] = [$valores[1],$valores[2],$valores[3],$valores[4],$valores[5],$valores[6],$valores[7],$valores[29]] ;
            // $consulta[$i] = [$valores[0]];
       
            $i++;
       }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
       <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
        <link rel="stylesheet" type="text/css" href="../js/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../../css/styles.css">
    </head>
    <body>
        <?php foreach ($consulta as $key => $value) {
                foreach ($value as $llave => $valor) {
                    array_push($resultado, $valor);
                }
              }
        ?>
        <div class="header_pdf">
            <div class="logo">
                <img src="../../images/logo_pdf.JPG">
            </div>
            <div class="padron">
                Padrón Municipal: <?php echo $resultado[6];?><br><br>
                Fecha: <?php echo $resultado[2];?><br><br>
                Nº Liquidación: <?php echo $resultado[0];?>
            </div>
        </div><br><br>
        
        <div class="content"> 
        PROPIETARIO: <?php echo $resultado[3]." ".$resultado[4];?>
        </div>
    </body>
</html>

       


<?php
require_once '../../dompdf/autoload.inc.php';
//$datosCampos = filter_input_array(INPUT_POST);
use Dompdf\Dompdf;

$dompdf = new DOMPDF();

$dompdf->set_paper("A4", "portrait");
$dompdf->load_html(ob_get_clean());
//$dompdf->load_html($html);
$dompdf->render();
$pdf = $dompdf->output();
$filename = "ejemplo.pdf";
//file_put_contents($filename, $pdf);
$dompdf->stream($filename);









 
