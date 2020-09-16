$(function () {
     
    var Aforos = {};
     var items=[];
    (function (app) {

        app.init = function () {
            app.verificarSesion();
            app.bindings();
            
            if ($("#contItems").val() == 2) {
                $("#btn_quitar").attr("disabled", true);
            }
        };
        app.bindings = function () {
            //app.mostrarFecha();
            //app.getUtm();
            
            $("#agregarItem").on('click', function (event) {
             $("#calcula_aforo").css('display','none');
             app.cargarComboCategoria();
             app.cargarComboDestino();
               
                var cont = $("#contItems").val();
                var idDivItem = "divItem" + cont;
                var idSuperficie = "superficie" + cont;
                var idComboCategoria = "combo_categoria" + cont;
                var idComboDestino = "combo_destino" + cont;
                var idCheckCivil = "check_civil" + cont;
                var idCheckSanitario = "check_sanitario" + cont;
                var idCheckElectrico = "check_electrico" + cont;
                var idCheckIncendio = "check_incendio" + cont;
                var idNoCorresponde = "no_corresponde" + cont;
                var radioRecargo = "radio_recargo" + cont;
                var idRadioEspontaneo = "radio_espontaneo" + cont;
                var idRadioEmplazado = "radio_emplazado" + cont;
               
               
               
                var idBotonQuitar = "btn_quitar" + cont;
                var idBotonConfirmar = "btn_confirmar" + cont;
                var filaGrid ="<div class=\"form-group row\" id=\""+idDivItem+"\" style='margin-top: 20px;'>"+
                        "<label class=\"col-form-label col-sm-1\"style=\"margin-top: 8px;\ for=\"" + idSuperficie + "\">Superficie</label>" +
                        "<div class=\"col-lg-2\">" +
                        "<input class=\"form-control\" type=\"text\" id=\"" + idSuperficie + "\" name=\"" + idSuperficie + "\" placeholder=\"Superficie en mt2\">" +
                        "</div>" +
                        "<label class=\"col-form-label col-sm-1\"style=\"margin-top: 8px;\ for=\"" + idComboDestino + "\">Destino</label>" +
                        "<div class=\"col-lg-3\">" +
                        "<select class=\"form-control\" id=\"" + idComboDestino + "\" name=\""+idComboDestino+"\">" +
                        "</select>" +
                        "</div>" +
                        "<label class=\"col-form-label col-sm-1\"style=\"margin-top: 8px;\ for=\"" + idComboCategoria + "\">Categoría</label>" +
                        "<div class=\"col-lg-3\">" +
                        "<select class=\"form-control\" id=\"" + idComboCategoria + "\" name=\""+idComboCategoria+"\">"+
                        
                        "</select>" +
                        "</div>" +
                                         
                        "<div class='container' style='display:flex'>"+
                        "<div align='center' style='margin-left: -1%;margin-right: 10%;' >"+
                        "<h3 class='text-muted' align='center'>Marcar lo que corresponda</h3>"+
                        "<label  for=\""+idCheckCivil+"\">Obra Civil</label>"+
                        "<input  type='checkbox' id=\""+idCheckCivil+"\" name=\""+idCheckCivil+"\" value='0.7'>"+
                        "&nbsp;&nbsp;"+
                        "<label  for=\""+idCheckSanitario+"\">Instlación Sanitaria</label>"+
                        "<input  type='checkbox' id=\""+idCheckSanitario+"\" name=\""+idCheckSanitario+"\" value='0.15'>&nbsp;&nbsp;"+
                        "<label  for=\""+idCheckElectrico+"\">Instlación Eléctrica</label>"+
                        "<input  type='checkbox' id=\""+idCheckElectrico+"\" name=\""+idCheckElectrico+"\" value='0.15'>&nbsp;&nbsp;"+
                        "<label  for=\""+idCheckIncendio+"\">Instlación C/Incendio</label>"+
                        "<input  type='checkbox' id=\""+idCheckIncendio+"\" name=\""+idCheckIncendio+"\" value='0.03'>&nbsp;&nbsp;"+
                        "</div>"+
                        "<div align='center'>"+
                        "<h3 class='text-muted' align='center'>Recargos</h3>"+
                        "<label  for=\""+idNoCorresponde+"\">No corresponde</label>"+
                        "<input  type='radio' id=\""+idNoCorresponde+"\" name=\""+radioRecargo+"\" checked>&nbsp;&nbsp;"+
                        "<label  for=\""+idRadioEspontaneo+"\">Presentación espontánea</label>"+
                        "<input  type='radio' id=\""+idRadioEspontaneo+"\" name=\""+radioRecargo+"\">&nbsp;&nbsp;"+
                        "<label  for=\""+idRadioEmplazado+"\">Emplazado</label>"+
                        "<input  type='radio' id=\""+idRadioEmplazado+"\" name=\""+radioRecargo+"\">&nbsp;&nbsp;"+
                        "</div></div><hr>"+
                        "<div style='display:flex;align-items:center;justify-content:center;'>"+
                        "<div style='width:140px'>"+
                        "<button class=\"btn btn-success\" id=\"" + idBotonConfirmar + "\">Confirmar Item</button>" +
                        "</div>"+
                        "<div style='width:140px'>"+
                        "<button class=\"btn btn-danger\" id=\"" + idBotonQuitar + "\">Quitar Item</button>" +
                        "</div>"+
                        "</div><br><br>"+
                        "<div id='span_confirmar_item' align='center'>"+
                        "<span>(DEBE COMFIRMAR EL ITEM PARA PODER REALIZAR EL CÁLCULO)</span>"+
                        "</div>";
                
                $("#gridItems").append(filaGrid);
                        //una vez que lleno los campos del nuevo item, pregunto si quieren confirmar el item
                        $("#"+ idBotonConfirmar).on('click',function(){
                        var rta="";
                        if($("#"+idSuperficie).val()==""){
                                rta+="El campo SUPERFICIE no puede estar vacío.";
                                alert(rta);
                                $("#"+idSuperficie).focus();
                                return false;
                            }else if($("#"+idComboDestino).val()==0){
                                rta+="Debe seleccionar un DESTINO.";
                                alert(rta);
                                $("#"+idComboDestino).focus();
                                return false;
                            }else if($("#"+idComboCategoria).val()==0){
                               rta+="Debe seleccionar una CATEGORÍA.";
                                alert(rta);
                                $("#"+idComboCategoria).focus();
                                return false; 
                            }else if($("#"+idCheckSanitario).is(":checked")==false && $("#"+idCheckCivil).is(":checked")==false && $("#"+idCheckElectrico).is(":checked")==false && $("#"+idCheckIncendio).is(":checked")==false){ 
                    rta += "Debe marcar alguna de las siguientes opciones:\n\n\
                            - Obra civil\n\n\
                            - Instalación Sanitaria\n\n\
                            - Instalacion Eléctrica\n\n\
                            - Instalación C/incendio";
                    alert(rta);
                    return false;
                }else 
                        //si confirman el item
                        if(confirm("Al agregar el item, éste ya NO se podrá quitar, ¿Desea continuar?")==true){
                          
                        $("#span_confirmar_item").css('display','none');
                        //oculto el boton CONFIRMAR    
                        $("#"+idBotonConfirmar).css("display","none");
                        // oculto el boton QUITAR
                        $("#"+idBotonQuitar).css("display","none");
                        // oculto el boton CALCULAR AFORO
                       $("#calcula_aforo").css('display','block');
                     //como ya confirmaron el item, comienzo a asignar los valores a las variables
                    var superficie = $("#"+ idSuperficie).val();
                    var destino = $("#"+ idComboDestino).val();
                    var categoria = $("#"+ idComboCategoria).val();
                    var checkCivil = $("#"+ idCheckCivil).prop("checked");
                    var checkSanitario = $("#"+ idCheckSanitario).prop("checked");
                    var checkElectrico = $("#"+ idCheckElectrico).prop("checked");
                    var checkIncendio = $("#"+ idCheckIncendio).prop("checked");
                    var radioEspontaneo = $("#"+idRadioEspontaneo).prop("checked");
                    var radioEmplazado = $("#"+idRadioEmplazado).prop("checked");
                    
                    //agrego un campo oculto para la superficie del item
                    $("#campos_ocultos").html("<input type='text' hidden name='item2' value='item2'>");
                    //agrego un campo oculto para la superficie del item
                    $("#campos_ocultos").html("<input type='text' hidden name='"+idSuperficie+"' value='"+superficie+"'>");
                    //una vez que tengo todas las variables, las agrego al array
                    items.push({idSuperficie:superficie,idComboDestino:destino,idComboCategoria:categoria,checkCivil:checkCivil,checkSanitario:checkSanitario,checkElectrico:checkElectrico,checkIncendio:checkIncendio,radioEspontaneo:radioEspontaneo,radioEmplazado:radioEmplazado });   
                    //retorno falso para que despues de hacer click en el boton CONFIRMAR, se quede en la misma pagina
                    return false;
                //fin else validacion
                        }else{return false;}//retorno falso cuando en la ventana de confirmacion, elijen CANCELAR
                });
               // });
                   
                //despues de agregar un item, le sumo 1 al valor del contador   
                $("#contItems").val((parseInt(cont) + 1).toString());
                
                //al presionar el boton QUITAR ITEM
                $("#" + idBotonQuitar).on('click', function () {
                    //oculto el boton CALCULAR AFORO
                    $("#calcula_aforo").css('display','block');
                    //quito el div que contiene el item
                    $("#" + idDivItem).remove();
                                    
                });

            });
            
           
            }//fin app.bindings()
            
            //al presionar al boton CALCULAR AFORO
             $("#calcula_aforo").on('click', function (event) {
            //valido los campos (solo se validan los que aparecen por defecto, NO los items agregados    
            app.validarCampos();
        });
        
         //funcion que valida los campos
            app.validarCampos = function(){
                
                var cont = $("#contItems").val();
                var nom = $("#nombrePropietario").val();
                var ape = $("#apellidoPropietario").val();
                var domicilio = $("#domicilio").val();
                var padron = $("#padron").val();
                var area = $("#combo_area1").val();
                var sup = $("#superficie1").val();
                var destino = $("#combo_destino1").val();
                var categoria = $("#combo_categoria1").val();
                var rta = "";
                if(/^[ñA-Za-z _]*[ñA-Za-z][ñA-Za-z _]*$/.test(nom)==false){
                    rta += "El campo 'NOMBRE' NO puede contener numeros.";
                     alert(rta);
                     
                     $("#nombrePropietario").focus();
                }else 
                if(nom == ""){
                     rta += "Debes completar el campo 'NOMBRE'.";
                     alert(rta);
                     
                     $("#nombrePropietario").focus();
                     
                }else if(/^[ñA-Za-z _]*[ñA-Za-z][ñA-Za-z _]*$/.test(ape)==false){
                    rta += "El campo 'APELLIDO' NO puede contener numeros.";
                     alert(rta);
                     
                     $("#apellidoPropietario").focus();
                }
            else if (ape == "") {
                    rta += "Debes completar el campo 'APELLIDO'.";
                    alert(rta);
                    $("#apellidoPropietario").focus();
                
                
                }else if(domicilio == ""){
                    rta += "Debes completar el campo 'DOMICILIO'.";
                    alert(rta);
                    $("#domicilio").focus();
                    
                }else if(padron == ""){
                    rta += "Debes completar el campo 'PADRÓN'.";
                    alert(rta);
                    $("#padron").focus();
                    
                }else if(isNaN(padron)){
                    rta += "Sólo números para el campo 'PADRÓN'.";
                    alert(rta);
                   $("#padron").focus();
                   
                }else if(area == 0){
                   rta += "Debes seleccionar un 'ÁREA'.";
                   alert(rta);
                   $("#combo_area1").focus();
                   
                   
                }else if(sup == ""){
                    rta += "Debes completar el campo 'SUPERFICIE'.";
                    alert(rta);
                    $("#superficie"+cont).focus();
                    
                }else if(isNaN(sup)){
                    rta += "Sólo números para 'SUPERFICIE'.";
                    alert(rta);
                  $("#superficie1").focus(); 
                    
                }else if(destino == 0){
                    rta += "Debes seleccionar un 'DESTINO'.";
                    alert(rta);
                   $("#combo_destino1").focus();
                   
                }else if(categoria == 0){
                    rta += "Debes seleccionar una 'CATEGORÍA'.";
                    alert(rta);
                   $("#combo_categoria1").focus();   
                   
                }else if($("#check_sanitario").is(":checked")==false && $("#check_civil").is(":checked")==false && $("#check_electrico").is(":checked")==false && $("#check_incendio").is(":checked")==false){ 
                    rta += "Debe marcar alguna de las siguientes opciones:\n\n\
                            - Obra civil\n\n\
                            - Instalación Sanitaria\n\n\
                            - Instalacion Eléctrica\n\n\
                            - Instalación C/incendio";
                    alert(rta);
                }else{//si todos los campos son validos, llamo a la funcion calcular()
                    app.calcular();}
            
            };
            
            //funcion calcular
            app.calcular = function(){
                //una vez que presiono el boton CALCULAR AFORO, oculto el boton AGREGAR ITEM
                $("#agregarItem").css('display','none');
                var tabla = "";//la voy a usar para dibujar la tabla que muestra los resultados    
                var tabla2="";
                var vb=0;//variable para almacenar el Valor Base
                //obtengo los valores de los input
                var vi= $("#valorindice").val();
                var s= $("#superficie1").val();
                var u = $("#combo_area1").val();               
                var d = $("#combo_destino1").val();
                var c = $("#combo_categoria1").val();
                //le doy un valor fijo a las variables, estos valores representan los porcentajes para la formula
                var docCivil=0.15*0.7;
                var inspCivil=0.45*0.7;
                var docSanitario=0.15*0.15;
                var inspSanitario=0.15*0.45;
                var docElectrico=0.15*0.15;
                var inspElectrico=0.15*0.45;
                var docIncendio=0.03*0.15;
                var inspIncendio=0.03*0.45;
                //declaro todas las variables que voy a usar en el calculo
                var derechoOcDoc=0;
                var derechoOcInsp=0;
                var derechoIsDoc=0;
                var derechoIsInsp=0;
                var derechoIeDoc=0;
                var derechoIeInsp=0;
                var derechoIciDoc=0;
                var derechoIciInsp=0;
                var recargoOC=0;
                var recargoIS=0;
                var recargoIE=0;
                var recargoICI=0;
                var recargoOCEmplazado=0;
                var recargoISEmplazado=0;
                var recargoIEEmplazado=0;
                var recargoICIEmplazado=0;
                var total=0;
                 var total2=0;
                var totalGeneral=0;
                //aca me fijo si han agregado items
                if(items !== null){//si existen items
                $.each(items,function(clave,valor){
                    //vuelvo a declarar las variables para el calculo ya que tienen que sumarse al aforo original
                   
                    var vb2=0;
                    var s2=valor.idSuperficie;
                    //el area va por fuera del item asique usamos la misma variable del aforo original
                    var d2=valor.idComboDestino;
                    var c2 = valor.idComboCategoria;
                    var derechoOcDoc2=0;
                    var derechoOcInsp2=0;
                    var derechoIsDoc2=0;
                    var derechoIsInsp2=0;
                    var derechoIeDoc2=0;
                    var derechoIeInsp2=0;
                    var derechoIciDoc2=0;
                    var derechoIciInsp2=0;
                    var recargoOC2=0;
                    var recargoIS2=0;
                    var recargoIE2=0;
                    var recargoICI2=0;
                    var recargoOCEmplazado2=0;
                    var recargoISEmplazado2=0;
                    var recargoIEEmplazado2=0;
                    var recargoICIEmplazado2=0;
                   
                    //calculo el Valor Base con los datos del item
                    var vb2 = (vi * s2 * u * d2 * c2).toFixed(2);
                    
                    //pregunto si que han marcado en los checkbox
                    if(valor.checkCivil){

                    
                     derechoOcDoc2 = ((vb2 * docCivil)/100).toFixed(2);//usar esto para redondear
                     derechoOcInsp2 = ((vb2 * inspCivil)/100).toFixed(2);
                }

                if(valor.checkSanitario){

                     
                     derechoIsDoc2 = ((vb2 * docSanitario)/100).toFixed(2);
                     derechoIsInsp2 = ((vb2 * inspSanitario)/100).toFixed(2);
                }

                if(valor.checkElectrico){

                     derechoIeDoc2 = ((vb2 * docElectrico)/100).toFixed(2);
                     derechoIeInsp2 = ((vb2 * inspElectrico)/100).toFixed(2);
                }

                if(valor.checkIncendio){

                     derechoIciDoc2 = ((vb2 * docIncendio)/100).toFixed(2);
                     derechoIciInsp2 = ((vb2 * inspIncendio)/100).toFixed(2);
                }
                
                //pregunto si los radiobox estan marcados
                if(valor.radioEspontaneo){
                    recargoOC2 = (parseFloat(derechoOcDoc2) + parseFloat(derechoOcInsp2))*0.5;
                    recargoIS2 = (parseFloat(derechoIsDoc2) + parseFloat(derechoIsInsp2))*0.5;
                    recargoIE2 = (parseFloat(derechoIeDoc2) + parseFloat(derechoIeInsp2))*0.5;
                    recargoICI2 = (parseFloat(derechoIciDoc2) + parseFloat(derechoIciInsp2))*0.5;
                }
                
                if(valor.radioEmplazado){
                    recargoOCEmplazado2 = (parseFloat(derechoOcDoc2) + parseFloat(derechoOcInsp2))*1.5;
                    recargoISEmplazado2 = (parseFloat(derechoIsDoc2) + parseFloat(derechoIsInsp2))*1.5;
                    recargoIEEmplazado2 = (parseFloat(derechoIeDoc2) + parseFloat(derechoIeInsp2))*1.5;
                    recargoICIEmplazado2 = (parseFloat(derechoIciDoc2) + parseFloat(derechoIciInsp2))*1.5;
                }
                //hago el calculo y lo voy guardando en la variable total2
                 total2 += parseFloat(derechoOcDoc2) + parseFloat(derechoOcInsp2) + parseFloat(derechoIeDoc2) +
                           parseFloat(derechoIeInsp2) + parseFloat(derechoIsDoc2) + parseFloat(derechoIsInsp2) + 
                           parseFloat(derechoIciDoc2) + parseFloat(derechoIciInsp2)+ parseFloat(recargoOC2) + 
                           parseFloat(recargoIS2) + parseFloat(recargoIE2) + parseFloat(recargoICI2)+parseFloat(recargoOCEmplazado2)+
                           parseFloat(recargoISEmplazado2)+parseFloat(recargoIEEmplazado2)+parseFloat(recargoICIEmplazado2);
                   
                 //tabla
                 tabla2="<table class='tabla_resultados'>"+
                    "<thead>"+
                        "<tr>"+
                            "<th colspan='4'>ITEM AÑANIDO</th>"+
                        "</tr>"+
                    "</thead>" +
                    "<tr>"+
                        "<td>Derecho Obra Civil (Estudio de documentacion)</td>"+"<td>"+vb2+"</td>"+"<td>"+0.105+"</td>"+"<td>"+derechoOcDoc2+"</td>" + 
                    "</tr>"+
                    "<tr>"+
                        "<td>Derecho Obra Civil (Derecho de inspeccion)</td>"+"<td>"+vb2+"</td>"+"<td>"+0.315+"</td>"+"<td>"+derechoOcInsp2+"</td>"+
                    "</tr>"+
                    "<tr>"+
                        "<td>Derecho Instalacion Eléctrica (Estudio de documentacion)</td>"+"<td>"+vb2+"</td>"+"<td>"+0.0225+"</td>"+"<td>"+derechoIeDoc2+"</td>"+
                    "</tr>"+
                    "<tr>"+
                        "<td>Derecho Instalacion Eléctrica (Derecho de inspeccion)</td>"+"<td>"+vb2+"</td>"+"<td>"+0.0675+"</td>"+"<td>"+derechoIeInsp2+"</td>"+ 
                    "</tr>"+
                    "<tr>"+
                        "<td>Derecho Instalacion Sanitaria (Estudio de documentacion)</td>"+"<td>"+vb2+"</td>"+"<td>"+0.0225+"</td>"+"<td>"+derechoIsDoc2+"</td>"+
                    "</tr>"+
                    "<tr>"+
                        "<td>Derecho Instalacion Sanitaria (Derecho de inspeccion)</td>"+"<td>"+vb2+"</td>"+"<td>"+0.0675+"</td>"+"<td>"+derechoIsInsp2+"</td>"+ 
                    "</tr>"+
                    "<tr>"+
                        "<td>Derecho Instalacion Contra Incendio (Estudio de documentacion)</td>"+"<td>"+vb2+"</td>"+"<td>"+0.0045+"</td>"+"<td>"+derechoIciDoc2+"</td>"+
                    "</tr>"+
                    "<tr>"+
                        "<td>Derecho Instalacion Contra Incendio (Derecho de inspeccion)</td>"+"<td>"+vb2+"</td>"+"<td>"+0.0135+"</td>"+"<td>"+derechoIciInsp+"</td>"+ 
                    "</tr>"+
                    "<tr>"+
                        "<td>Recargo Obra Civil Clandestina (Presentación espontánea)</td>"+"<td>-</td>"+"<td>0.50</td>"+"<td>"+ recargoOC2.toFixed(2) +"</td>"+
                    "</tr>"+
                    "<tr>"+
                        "<td>Recargo Instalación Sanitaria Clandestina (Presentación espontánea)</td>"+"<td>-</td>"+"<td>0.50</td>"+"<td>"+ recargoIS2.toFixed(2) +"</td>"+
                    "</tr>"+
                    "<tr>"+
                        "<td>Recargo Instalación Eléctrica Clandestina (Presentación espontánea)</td>"+"<td>-</td>"+"<td>0.50</td>"+"<td>"+ recargoIE2.toFixed(2) +"</td>"+
                    "</tr>"+
                    "<tr>"+
                        "<td>Recargo Instalación Contra Incendio Clandestina (Presentación espontánea)</td>"+"<td>-</td>"+"<td>0.50</td>"+"<td>"+ recargoICI2.toFixed(2) +"</td>"+
                    "</tr>"+
                    "<tr>"+
                    "<td>Recargo Obra Civil Clandestina (Emplazado con notificación)</td>"+"<td>-</td>"+"<td>1.5</td>"+"<td>"+ recargoOCEmplazado2.toFixed(2) +"</td>"+
                    "</tr>"+
                    "<tr>"+
                        "<td>Recargo Instalación Sanitaria Clandestina (Emplazado con notificación)</td>"+"<td>-</td>"+"<td>1.5</td>"+"<td>"+ recargoISEmplazado2.toFixed(2) +"</td>"+
                    "</tr>"+
                    "<tr>"+
                        "<td>Recargo Instalación Eléctrica Clandestina (Emplazado con notificación)</td>"+"<td>-</td>"+"<td>1.5</td>"+"<td>"+ recargoIEEmplazado2.toFixed(2) +"</td>"+
                    "</tr>"+
                    "<tr>"+
                        "<td>Recargo Instalación Contra Incendio Clandestina (Emplazado con notificación)</td>"+"<td>-</td>"+"<td>1.5</td>"+"<td>"+ recargoICIEmplazado2.toFixed(2) +"</td>"+
                    "</tr>"+
                    "<tr>"+
                        "<td></td><td></td><td>SUB TOTAL:</td><td>"+total2.toFixed(2)+"</td>"+
                    "</tr>"+    
                    
                  "</table>";
                 
                });//fin each items
                
                
            }

                var vb = (vi * s * u * d * c).toFixed(2);
               


                if($("#check_civil").is(":checked")){

                    // oc = docCivil + inspCivil;
                     derechoOcDoc = ((vb * docCivil)/100).toFixed(2);//usar esto para redondear
                     derechoOcInsp = ((vb * inspCivil)/100).toFixed(2);
                }

                if($("#check_sanitario").is(":checked")){

                     //os = docSanitario + inspSanitario;
                     derechoIsDoc = ((vb * docSanitario)/100).toFixed(2);
                     derechoIsInsp = ((vb * inspSanitario)/100).toFixed(2);
                }

                if($("#check_electrico").is(":checked")){

                     //ie = docElectrico + inspElectrico;
                     derechoIeDoc = ((vb * docElectrico)/100).toFixed(2);
                     derechoIeInsp = ((vb * inspElectrico)/100).toFixed(2);
                }

                if($("#check_incendio").is(":checked")){

                     //ici = docIncendio + inspIncendio;
                     derechoIciDoc = ((vb * docIncendio)/100).toFixed(2);
                     derechoIciInsp = ((vb * inspIncendio)/100).toFixed(2);
                }

                if($("#radio_espontaneo").is(":checked")){
                    recargoOC = (parseFloat(derechoOcDoc) + parseFloat(derechoOcInsp))*0.5;
                    recargoIS = (parseFloat(derechoIsDoc) + parseFloat(derechoIsInsp))*0.5;
                    recargoIE = (parseFloat(derechoIeDoc) + parseFloat(derechoIeInsp))*0.5;
                    recargoICI = (parseFloat(derechoIciDoc) + parseFloat(derechoIciInsp))*0.5;
                }
                
                if($("#radio_emplazado").is(":checked")){
                    recargoOCEmplazado = (parseFloat(derechoOcDoc) + parseFloat(derechoOcInsp))*1.5;
                    recargoISEmplazado = (parseFloat(derechoIsDoc) + parseFloat(derechoIsInsp))*1.5;
                    recargoIEEmplazado = (parseFloat(derechoIeDoc) + parseFloat(derechoIeInsp))*1.5;
                    recargoICIEmplazado = (parseFloat(derechoIciDoc) + parseFloat(derechoIciInsp))*1.5;
                }
                  
                   total = parseFloat(derechoOcDoc) + parseFloat(derechoOcInsp) + parseFloat(derechoIeDoc) + parseFloat(derechoIeInsp) + parseFloat(derechoIsDoc) + parseFloat(derechoIsInsp) + parseFloat(derechoIciDoc) + parseFloat(derechoIciInsp)+ parseFloat(recargoOC) + parseFloat(recargoIS) + parseFloat(recargoIE) + parseFloat(recargoICI)+parseFloat(recargoOCEmplazado)+ parseFloat(recargoISEmplazado)+parseFloat(recargoIEEmplazado)+parseFloat(recargoICIEmplazado);
                   totalGeneral = total + total2;
                   
                   
           $("#main-container").css("display","block");
           tabla = "<table>"+
                    "<thead>"+
                        "<tr>"+
                            "<th>Detalle</th><th>Valor Base</th><th>%</th><th>Importe</th>"+
                        "</tr>"+
                    "</thead>" +
                    "<tr>"+
                        "<td>Derecho Obra Civil (Estudio de documentacion)</td>"+"<td>"+vb+"</td>"+"<td>"+0.105+"</td>"+"<td>"+derechoOcDoc+"</td>" + 
                    "</tr>"+
                    "<tr>"+
                        "<td>Derecho Obra Civil (Derecho de inspeccion)</td>"+"<td>"+vb+"</td>"+"<td>"+0.315+"</td>"+"<td>"+derechoOcInsp+"</td>"+
                    "</tr>"+
                    "<tr>"+
                        "<td>Derecho Instalacion Eléctrica (Estudio de documentacion)</td>"+"<td>"+vb+"</td>"+"<td>"+0.0225+"</td>"+"<td>"+derechoIeDoc+"</td>"+
                    "</tr>"+
                    "<tr>"+
                        "<td>Derecho Instalacion Eléctrica (Derecho de inspeccion)</td>"+"<td>"+vb+"</td>"+"<td>"+0.0675+"</td>"+"<td>"+derechoIeInsp+"</td>"+ 
                    "</tr>"+
                    "<tr>"+
                        "<td>Derecho Instalacion Sanitaria (Estudio de documentacion)</td>"+"<td>"+vb+"</td>"+"<td>"+0.0225+"</td>"+"<td>"+derechoIsDoc+"</td>"+
                    "</tr>"+
                    "<tr>"+
                        "<td>Derecho Instalacion Sanitaria (Derecho de inspeccion)</td>"+"<td>"+vb+"</td>"+"<td>"+0.0675+"</td>"+"<td>"+derechoIsInsp+"</td>"+ 
                    "</tr>"+
                    "<tr>"+
                        "<td>Derecho Instalacion Contra Incendio (Estudio de documentacion)</td>"+"<td>"+vb+"</td>"+"<td>"+0.0045+"</td>"+"<td>"+derechoIciDoc+"</td>"+
                    "</tr>"+
                    "<tr>"+
                        "<td>Derecho Instalacion Contra Incendio (Derecho de inspeccion)</td>"+"<td>"+vb+"</td>"+"<td>"+0.0135+"</td>"+"<td>"+derechoIciInsp+"</td>"+ 
                    "</tr>"+
                    "<tr>"+
                        "<td>Recargo Obra Civil Clandestina (Presentación espontánea)</td>"+"<td>-</td>"+"<td>0.50</td>"+"<td>"+ recargoOC.toFixed(2) +"</td>"+
                    "</tr>"+
                    "<tr>"+
                        "<td>Recargo Instalación Sanitaria Clandestina (Presentación espontánea)</td>"+"<td>-</td>"+"<td>0.50</td>"+"<td>"+ recargoIS.toFixed(2) +"</td>"+
                    "</tr>"+
                    "<tr>"+
                        "<td>Recargo Instalación Eléctrica Clandestina (Presentación espontánea)</td>"+"<td>-</td>"+"<td>0.50</td>"+"<td>"+ recargoIE.toFixed(2) +"</td>"+
                    "</tr>"+
                    "<tr>"+
                        "<td>Recargo Instalación Contra Incendio Clandestina (Presentación espontánea)</td>"+"<td>-</td>"+"<td>0.50</td>"+"<td>"+ recargoICI.toFixed(2) +"</td>"+
                    "</tr>"+
                    "<tr>"+
                    "<td>Recargo Obra Civil Clandestina (Emplazado con notificación)</td>"+"<td>-</td>"+"<td>1.5</td>"+"<td>"+ recargoOCEmplazado.toFixed(2) +"</td>"+
                    "</tr>"+
                    "<tr>"+
                        "<td>Recargo Instalación Sanitaria Clandestina (Emplazado con notificación)</td>"+"<td>-</td>"+"<td>1.5</td>"+"<td>"+ recargoISEmplazado.toFixed(2) +"</td>"+
                    "</tr>"+
                    "<tr>"+
                        "<td>Recargo Instalación Eléctrica Clandestina (Emplazado con notificación)</td>"+"<td>-</td>"+"<td>1.5</td>"+"<td>"+ recargoIEEmplazado.toFixed(2) +"</td>"+
                    "</tr>"+
                    "<tr>"+
                        "<td>Recargo Instalación Contra Incendio Clandestina (Emplazado con notificación)</td>"+"<td>-</td>"+"<td>1.5</td>"+"<td>"+ recargoICIEmplazado.toFixed(2) +"</td>"+
                    "</tr>"+
                    "<tr>"+
                        "<td></td><td></td><td>SUB TOTAL:</td><td>"+total.toFixed(2)+"</td>"+
                    "</tr>"+ 
                    
                  "</table><br><br>";
            
                  
          $("#main-container").append(tabla);
          $("#main-container").append(tabla2);
          $("#txt_total").val(total.toFixed(2));
          $("#total").css('display','block');
          $("#calcula_aforo").css('display','none');
          $("#div_volver").css('display','block');
          $("#div_imprimir").css('display','block');
          $("#total").val(total.toFixed(2));
          $("#valor_base").val(vb);
          $("#derechoOcDoc").val(derechoOcDoc);
          $("#derechoOcInsp").val(derechoOcInsp);
          $("#derechoIsDoc").val(derechoIsDoc);
          $("#derechoIsInsp").val(derechoIsInsp);
          $("#derechoIeDoc").val(derechoIeDoc);
          $("#derechoIeInsp").val(derechoIeInsp);
          $("#derechoIciDoc").val(derechoIciDoc);
          $("#derechoIciInsp").val(derechoIciInsp);
          $("#recargoOC").val(recargoOC);
          $("#recargoIS").val(recargoIS);
          $("#recargoIE").val(recargoIE);
          $("#recargoICI").val(recargoICI);
          $("#recargoOCEmplazado").val(recargoOCEmplazado);
          $("#recargoISEmplazado").val(recargoISEmplazado);
          $("#recargoIEEmplazado").val(recargoIEEmplazado);
          $("#recargoICIEmplazado").val(recargoICIEmplazado);
          $("#area_seleccionada").val($("#combo_area1 option:selected").text());
          $("#destino_seleccionado").val($("#combo_destino1 option:selected").text());
          $("#categoria_seleccionada").val($("#combo_categoria1 option:selected").text());
          
          //PARA IMPRIMIR PDF
          $("#imprimir").on('click',function(){
            var opcion = confirm("Al imprimir el documento, se guardará el cálculo en la Base de Datos ¿Desea continuar?");
            if (opcion == true) {
                 app.guardar();
                } 
           
            
        });
        
         app.guardar = function() {
                
            var url = "../controllers/Ruteador.php"; //voy al ruteador a guardar alumno (tanto para modific como para agregar)
            //data del formulario persona
            
            var data = $("#formulario").serialize();
          
            
           $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: data,
                 
                success: function(datos) {
                   
                   //location.href = "../views/pdf/ImprimirPdf.php";
                   location.href = "../views/imprimirPdf.php";
                   //setTimeout(function(){location.href = "../views/vista_aforos.php";},500);
                 //$("#imprimir").css('display','none');
                },
                error: function(data) {
                    alert("No se pudo guardar en la Base de Datos.");
                }
            });
        };
        
        
        
      };//fin app.calcular()
      
     
      
      $("#volver").on('click',function(){
           location.href="vista_aforos.php"; 
        });
        
        
           
            
            app.cargarComboCategoria = function () {
                
           var fila="<option value='0'>Seleccione Categoría</option>";
           var cont = $("#contItems").val();
           var url = "../controllers/Ruteador.php?metodo=categoria";
            
           
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function (datosDevueltos) {
                    $("#combo_categoria"+cont).append(fila);
                      // console.log(datosDevueltos[]);
                    $.each(datosDevueltos, function (clave, categoria) {
                      
                        $("#combo_categoria" + cont).append('<option value="' + categoria[2] + '">' + categoria[1] + '</option>');
                       /* if (area.id_area === index)
                            $("#comboArea2 option").each(function () {
                                this.selected = area.nombre_area
                            });*/
                    });
                  
                },
                error: function () {
                    alert("error en categoria");
                }
            });
            
        };
        
        
        
        //FUNCION PARA CARGAR COMBO DESTINOS
          app.cargarComboDestino = function (index) {
                
           var filaGrid="<option value='0'>Seleccione destino</option>";
          var cont = $("#contItems").val();
           var url = "../controllers/Ruteador.php?metodo=destino";
            
           
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function (datosDevueltos) {
                    $("#combo_destino"+cont).append(filaGrid);
                     console.log(datosDevueltos);
                    $.each(datosDevueltos, function (clave, destino) {
                      console.log(cont);
                        $("#combo_destino" + cont).append('<option id="'+destino[0]+ '" value="' + destino[2] + '">' + destino[1] + '</option>');
                       /* if (area.id_area === index)
                            $("#comboArea2 option").each(function () {
                                this.selected = area.nombre_area
                            });*/
                    });
                  
                },
                error: function () {
                    alert("error en destino");
                }
            });
            
        };
        
        

        
        app.mostrarFecha = function(){
            var f = new Date();
            var mes = (f.getMonth() + 1);
            var mesLetras  = "";
            switch (mes)
            {
                case 1:
                   mesLetras  = "Enero";
                   break;
                case 2:
                   mesLetras  = "Febrero";
                   break;
                case 3:
                   mesLetras  = "Marzo";
                   break;
                case 4:
                   mesLetras  = "Abril";
                   break;
                case 5:
                   mesLetras  = "Mayo";
                   break;
                case 6:
                    mesLetras  = "Junio";
                    break;
                case 7:
                    mesLetras  = "Julio";
                    break;
                case 8:
                    mesLetras  = "Agosto";
                    break;
                case 9:
                    mesLetras  = "Septiembre";
                    break;
                case 10:
                    mesLetras  = "Octubre";
                    break;
                case 11:
                    mesLetras  = "Noviembre";
                    break;
                case 12:
                    mesLetras  = "Diciembre";
                    break;
            }
            $("#fecha").html(f.getDate() + " de " + mesLetras + " de " + f.getFullYear());
          };

          app.getUtm = function (){
            var url = "../controllers/Ruteador.php?metodo=utm";
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(datosDevueltos){
                 
                $.each(datosDevueltos, function (clave, utm) {
                      $("#valorindice").val(utm*5000);
                      $("#utm").val(utm);
                     
                        
                    });
                },
                error: function () {
                    alert("error en utm");
                }
            });
        };
        
        app.verificarSesion = function(){
           var url = "../controllers/Sesion.php";
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                success: function(datos) {
                        if (datos.rol === "admin") {
                            $("#logedUser").html(datos.nombre_usuario);
                            
                        }else if(datos.rol === "normal"){
                            //$("#id_usuario").val(datos.id_usuario);
                            $("#logedUser").html(datos.nombre_usuario);
                           // location.href = "vista_aforos.php"
                        }
                    
                },
                error: function(data) {
                    //location.href = "../views/aforos_tecnica.php";
                    alert("error en sesion");
                }
            });
        };
        app.init();

    })(Aforos);

});
