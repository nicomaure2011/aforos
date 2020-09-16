<?php
require_once('../data/conexion.php');
session_start();
//me aseguro que el usuario este logueado
if ($_SESSION['nombre_usuario'] == null || $_SESSION['rol'] != "normal") {
 header("Location:sesion_caducada.php");
 session_destroy();
	
}
$url = 'http://192.168.41.62/rentas/utm';
$curl = curl_init();
curl_setopt($curl,CURLOPT_URL, $url);
curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl,CURLOPT_HEADER, false);
$utm = (float)curl_exec($curl);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Aforos</title>
       <link rel="stylesheet" type="text/css" href="../js/bootstrap/css/bootstrap.min.css">
       <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
    </head>
    <body>
<?php 

date_default_timezone_set("America/Argentina/Buenos_Aires");
$fecha =  date('d-m-yy');
?>
        <nav class="navbar navbar-light bg-primary">
            <div class="container col-lg-12" id="navbar2">
                 <div class="col-lg-12" id="navbar">
                     <a class="btn pull-left col-lg-3"><span style="font-size: 12pt;color:white;"><img src="../images/icono_usuario.svg" width="25" height="25" alt="">&nbsp;</span><font color="white"><span id="logedUser"></span></font></a>
                     <a class="btn text-center col-lg-5"><img src="../images/icono_fecha.svg" width="25" height="25" alt="">&nbsp;<span id="fecha" style="font-size: 12pt;color: white;"><?php echo $fecha;?> </span></a>
                     
                     <a class="btn pull-right col-lg-2" href="cambiar_clave.php" id="cambiarClave"><span style="font-size: 12pt;color: white;">Cambiar clave</span>&nbsp;<img src="../images/icono_pass.svg" width="25" height="25" alt=""></a>
                     <a class="btn pull-right col-lg-2" href="cerrarSesion.php" id="cerrarSesion" style=""><span style="font-size: 12pt;color: white;">Cerrar sesión</span>&nbsp;<img src="../images/icono_logout.svg" width="25" height="25" alt=""></a>
                </div><!--/.navbar-collapse -->
            </div>
            </div>
        </nav>
       
          
            <div class="container" style="margin-top: 20px;margin-bottom: 20px;">
                <div class="form-group row">
                    <form id="formulario"  name="formulario" method="POST" style="margin-bottom: 20px;">
                        <h2 align="center"><strong>DATOS DEL PROPIETARIO</strong></h2><br><br>
                        <input type="text" id="usuario_calculo" name="usuario_calculo" value="<?php echo $_SESSION['nombre_usuario']; ?>" hidden>
                     <label class="col-form-label col-sm-2" style="padding-top: 5px;" for="nombrePropietario">Nombre del propietario</label>
                    <div class="col-sm-5 mb-4">
                        <input type="text" class="form-control" name="nombrePropietario" id="nombrePropietario" autofocus>
                    </div>
                    <br><br>

                    <label class="col-form-label col-sm-2" style="padding-top: 5px;" for="apellidoPropietario">Apellido del propietario</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="apellidoPropietario" id="apellidoPropietario">
                    </div>
                    <br><br>

                    <label class="col-form-label col-sm-2" style="padding-top: 5px;" for="domicilio">Domicilio</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="domicilio" id="domicilio">
                    </div>
                    <br><br>
                    
                    <label class="col-form-label col-sm-2" style="padding-top: 5px;" for="padron">Nº de Padrón</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="padron" id="padron">
                    </div>
                    <br><br>
                    
                    <div style="display:flex;">
                        <label class="col-form-label col-sm-2" for="valorindice" style="padding-top: 5px;">Valor Indice (5000 UTM)</label>
                    <div class="col-sm-5" style="width:230px">
                        <input type="text" class="form-control" name="valorindice" id="valorindice"  value="<?php echo $utm*5000 ?>"readonly  style="width: 80px;">
                    </div>
                    
                    <label class="col-form-label col-sm-1,5" style="padding-top: 5px;" for="utm">Valor actual de UTM $</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="utm" id="utm" value="<?php echo $utm ?>" readonly style="width: 80px;">
                    </div>
                    </div>
                    <br><br>
                  
                    
                        <label class="col-form-label col-sm-2" style="padding-top: 5px;" for="combo_area1">Zona-Área-Uso</label>
                        <div class="col-sm-5" style="margin-bottom: 20px">
                            <select class="form-control" id="combo_area1" name="combo_area1">
                            <option value="0">Seleccione área</option>
                            <?php
                            // Realizo la consulta para extraer los datos
                            $query = $conn->query("SELECT * FROM areas");
                            while ($valores = mysqli_fetch_array($query)) {
                            //lleno el select con datos extraidos de la base de datos.
                                echo '<option id='.$valores[id_area].' value="' . $valores[coeficiente_area] . '">' . $valores[nombre_area] . '</option>';
                            }
                            ?>
                        </select>
                            <input type="text" id="area_seleccionada" name="area_seleccionada" hidden>
                                
                        </div>
                        <br><br>
         
        
          <h2 align="center"><strong>DATOS DEL PROYECTO</strong></h2><br><br>
          
          <div id="gridItems">
              <div  class="form-group row" id="divItem1" style="margin-top: 20px;">
                    <label class="col-form-label col-sm-1" style="margin-top: 8px;" for="superficie1">Superficie</label>    
                    <div class="col-lg-2">
                        <input class="form-control" type="text" id="superficie1"  name="superficie1" placeholder="Superficie en mt2">
                    </div>

                    <label class="col-form-label col-sm-1" style="margin-top: 8px;" for="combo_destino1">Destino</label>
                    <div class="col-lg-3">
                        <select class="form-control" id="combo_destino1" name="combo_destino1">
                            <option value="">Seleccione destino</option>
                            <?php

                            $query = $conn->query("SELECT * FROM destinos");
                            while ($valores = mysqli_fetch_array($query)) {

                                echo '<option id='.$valores[id_destino].' value="' . $valores[coeficiente_destino] . '">' . $valores[nombre_destino] . '</option>';
                               //echo "<script> console.log($valores[coeficiente_destino])</script>";
                            }
                            ?>
                        </select>
                        <input type="text" id="destino_seleccionado" name="destino_seleccionado" hidden>
                    </div>

                     <label class="col-form-label col-sm-1" style="margin-top: 8px;" for="combo_categoria1">Categoría</label>
                    <div class="col-sm-3">
                        <select class="form-control" id="combo_categoria1" name="combo_categoria1">
                            <option value="0">Seleccione categoría</option>
                            <?php
                           
                            $query = $conn->query("SELECT * FROM categorias");
                            while ($valores = mysqli_fetch_array($query)) {
                                
                                echo '<option id='.$valores[id_categoria].' value="' . $valores[coeficiente_categoria] . '">' . $valores[nombre_categoria] . '</option>';
                            }
                            ?>
                        </select>
                        <input type="text" id="categoria_seleccionada" name="categoria_seleccionada" hidden>
                    </div>
              
                    
        
              <div class="container" style="display:flex;">    
               <div   align="center" style="margin-left: -1%;margin-right: 10%;" >
                <h3 class="text-muted" align="center">Marcar lo que corresponda</h3>
                <label  for="check_civil">Obra Civil</label>
                <input  type="checkbox" id="check_civil" name="check_civil" value="0.7">
                  &nbsp;&nbsp;
                <label for="check_sanitario">Instalación Sanitaria</label>
                <input  type="checkbox" id="check_sanitario" name="check_sanitario" value="0.15">
                &nbsp;&nbsp;
                <label  for="check_electrico">Instalación Eléctrica</label>
                <input  type="checkbox" id="check_electrico" name="check_electrico" value="0.15">
                &nbsp;&nbsp;
                <label  for="check_incendio">Instalación C/Incendio</label>
                <input  type="checkbox" id="check_incendio" name="check_incendio" value="0.03">
               </div>  
                        
                <div align="center">
                    <h3 class="text-muted" align="center">Recargos</h3>
                    <label  for="no_corresponde">No corresponde</label>
                    <input  type="radio" id="no_corresponde" name="radio_recargo"checked>
                      &nbsp;&nbsp;
                    <label  for="radio_espontaneo">Presentación espontánea</label>
                    <input  type="radio" id="radio_espontaneo" name="radio_recargo">
                      &nbsp;&nbsp;
                    <label for="radio_emplazado">Emplazado</label>
                    <input  type="radio" id="radio_emplazado" name="radio_recargo">
                </div>
                        
            </div> <!--fin checkboks y radio-->
              </div>
            <hr>
            </div>

                    
           
             <div align="center">
                <!--<button type="button" class="btn btn-primary" id="agregarItem" name="agregarItem"><img src="../images/icono_add.svg" width="25" height="25" alt="">&nbsp;&nbsp;Agregar item</button>-->
            </div>
            
             <div id="main-container" hidden> </div><!--div oculto para mostrar la tabla con el resultado-->
             <br><br>
             <div id="total" hidden align="center"> 
                 <label id="lbl_total" for="txt_total">TOTAL:</label>
                 <input type="text" name="txt_total" id="txt_total">
             </div>     
               
               
           
             
             <div align="center" style="margin-bottom: 30px;">
                <button type="button" class="btn btn-primary" id="calcula_aforo" name="calcula_aforo">Calcular aforo</button>
                
            </div>
             
            <div id="div_imprimir"style="margin-bottom: 10px;" align="center" hidden>
                <button type="button" class="btn btn-primary" id="imprimir" name="accion" value="guardar">Imprimir</button> 
                <!-- input que voy a usar para llamar al ruteador y guardar los datos en la bbdd -->
                 <input class="form-control" type="hidden" id="accion" name="accion" value="guardar">
            </div>
           
             <div align="center" id="div_volver" style="margin-bottom: 10px;" hidden>
                 <button type="button" class="btn btn-primary" id="volver" name="volver"><img src="../images/icono_volver.svg" width="23" height="23" alt="">&nbsp;&nbsp;Volver</button>
            </div>

             <!--campo oculto para usarlo cuando agrego un item-->
            <input class="form-control" type="hidden" id="contItems" name="contItems" value="2">
            <!--campos ocultos para usarlos cuando mando los datos a la bbdd y para diseñar el pdf-->
           
            <input class="form-control" type="hidden" id="total" name="total">
            <input class="form-control" type="hidden" id="valor_base" name="valor_base">
            <input class="form-control" type="hidden" id="derechoOcDoc" name="derechoOcDoc">
            <input class="form-control" type="hidden" id="derechoOcInsp" name="derechoOcInsp">
            <input class="form-control" type="hidden" id="derechoIsDoc" name="derechoIsDoc">
            <input class="form-control" type="hidden" id="derechoIsInsp" name="derechoIsInsp">
            <input class="form-control" type="hidden" id="derechoIeDoc" name="derechoIeDoc">
            <input class="form-control" type="hidden" id="derechoIeInsp" name="derechoIeInsp">
            <input class="form-control" type="hidden" id="derechoIciDoc" name="derechoIciDoc">
            <input class="form-control" type="hidden" id="derechoIciInsp" name="derechoIciInsp">
            <input class="form-control" type="hidden" id="recargoOC" name="recargoOC">
            <input class="form-control" type="hidden" id="recargoIS" name="recargoIS">
            <input class="form-control" type="hidden" id="recargoIE" name="recargoIE">
            <input class="form-control" type="hidden" id="recargoICI" name="recargoICI">
            <input class="form-control" type="hidden" id="recargoOCEmplazado" name="recargoOCEmplazado">
            <input class="form-control" type="hidden" id="recargoISEmplazado" name="recargoISEmplazado">
            <input class="form-control" type="hidden" id="recargoIEEmplazado" name="recargoIEEmplazado">
            <input class="form-control" type="hidden" id="recargoICIEmplazado" name="recargoICIEmplazado">
            <!-- campos ocultos para guardar la info de los items -->
             <div id="campos_ocultos">
            </div>
        </form>

                </div>
            </div>

        <script src="../js/jquery-3.1.1.min.js"></script>
        <script src="../js/scriptItems.js" type="text/javascript"></script>
   
     
    </body>
</html>
<!-- Desarrollado por Nicolas Maure -->
<!-- Con la coalboracion de Diego "crack" Bilyk -->