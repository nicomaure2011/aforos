
<?php 

    require_once('../data/conexion.php');
        $sumaRecargos=0;
        $totalGeneral=0;
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
        
           $consulta[$i] = [$valores[1],$valores[2],$valores[3],$valores[4],$valores[5],$valores[6],$valores[7],$valores[8],$valores[9],$valores[10],$valores[12],$valores[21],$valores[22],$valores[23],$valores[24],$valores[25],$valores[26],$valores[27],$valores[28],$valores[13],$valores[14],$valores[15],$valores[16],$valores[17],$valores[18],$valores[19],$valores[20],$valores[29],$valores[11]] ;
                  
            $i++;
       }
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Sistema Aforos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../js/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/stylespdf.css">
        <script src="../js/jquery-3.1.1.min.js"></script>
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
                <img src="../images/logo_pdf.JPG">
            </div>
            <div class="padron">
                Padrón Municipal: <?php echo $resultado[6];?><br><br><!--En la posicion 6 del array trae la posicion 6 de la bbdd-->
                Fecha: <?php echo $resultado[2];?><br><br><!--En la posicion 2 del array trae la posicion 2 de la bbdd-->
                Nº Liquidación: <?php echo $resultado[0];?><br><br><!--En la posicion 0 del array trae la posicion 0 de la bbdd-->
                Valor UTM: <?php echo $resultado[29];?><br>
                (Según Ord. 8959/19)<br>
                Liquidó: <?php echo $resultado[1];?>
            </div>
        </div>
        <div class="datos_propietario">
            <strong>Propietario: <?php echo $resultado[3]." ".$resultado[4];?></strong><br><br>
            <strong>Domicilio: <?php echo $resultado[5];?></strong><br>
            
            <hr>
        </div><br><br><br>
        <div style="display:flex;margin-left: 100px">
        <div class="datos_proyecto">
            <table border="1" align="center">
                <tr>
                    <td>Superficie:</td><td><?php echo $resultado[8]; ?></td><td></td>
                </tr>
                <tr>
                    <td>Destino:</td><td><?php echo $resultado[9]; ?></td><td></td>
                </tr>
                <tr>
                    <td>Categoría:</td><td><?php echo $resultado[10]; ?></td><td></td>
                </tr>
                <tr>
                    <td>Valor Base:</td><td><?php echo $resultado[11]; ?></td><td></td>
                </tr>
                
            </table>
        </div>
            <div>
            <table border="1" align="center">
                <tr>
                    <td colspan="2">ESTUDIO DOCUMENTACIÓN E INSPECCIONES</td>
                </tr>
                <tr>
                    <td>Recargos:</td><td>
                        <?php if($resultado[12]==0 && $resultado[13]==0 && $resultado[14]==0 && $resultado[15]==0 && $resultado[16]==0 && $resultado[17]==0 && $resultado[18]==0 && $resultado[19]==0){
                            echo "Sin Recargos";
                        }else{
                            $sumaRecargos += $resultado[12]+$resultado[13]+$resultado[14]+$resultado[15]+$resultado[16]+$resultado[17]+$resultado[18]+$resultado[19];
                            echo "$".$sumaRecargos;
                        }?>
                    </td><td></td>
                </tr>
                <tr>
                    <td>Obra/Instalaciones:</td><td><?php 
                    
                        if($resultado[20]!=0 || $resultado[21]!=0){
                            echo "OC(70%) ";
                        }
                        if($resultado[22]!=0 || $resultado[23]!=0){
                            echo "IS(15%) ";
                        }
                        if($resultado[24]!=0 || $resultado[25]!=0){
                            echo "IE(15%) ";
                        }
                        if($resultado[26]!=0 || $resultado[27]!=0){
                            echo "ICI(3%)";
                        }
                    
                    ?></td><td></td>
                </tr>
                <tr>
                    <td>Sub-total:</td><td><?php echo " $".$resultado[28]; ?></td><td></td>
                </tr>
                
            </table>
        </div>
        </div><br>
        <?php $totalGeneral = $resultado[28] + $sumaRecargos ?>
        <div style="margin-left:300px">
            <label for="total">TOTAL AFORO:&nbsp;&nbsp;&nbsp;</label>
            <input type="text" name="total" value="<?php echo " $".$totalGeneral; ?>" style="width:200px">
        </div>
        <div style="margin-left: 100px"><br>

    
</div>
        <button id="btn_imprimir" onclick="imprimir()">Imprimir</button>
        <script>
        //function imprimir(){
            window.onload = function(){
                $("#btn_imprimir").css('display','none');
            window.print();
            setTimeout(function(){location.href = "../views/vista_aforos.php";},2000);
            };
            
        //}
        </script>
    </body>
</html>