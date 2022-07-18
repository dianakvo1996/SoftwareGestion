<?php
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/VerificacionMetrologica.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/ReportePreventivo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Repuesto.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/FirmaIngeniero.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/FirmaSatisfaccion.php';


foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;


$reportePreventivo=new ReportePreventivo('numeroReporte', "'".$numeroReporte."'");
$fecha=new DateTime($reportePreventivo->getMantenimientoPreventivo()->getFecha());
$meses= array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
$mes=$meses[$fecha->format('n')-1];

//inicio firmas
//firma Ingeniero
$imgFirm="<img src='../FirmasIMG/firmaBlanco.png' height='63px'>";
$firmaIng=new FirmaIngeniero('ideIngeniero',"'{$reportePreventivo->getPersona()->getIdentificacion()}'");
if($firmaIng->getIde()!=null){
	$imgFirm="<img src='../FirmasIMG/{$firmaIng->getImgFirma()}' height='63px'>";
}
//firma satistaccion
$imgSat="<img src='../FirmasIMG/firmaBlanco.png' height='63px'>";
$firmaSat=new FirmaSatisfaccion('numReporte',$numeroReporte);
if($firmaSat->getIde()!=null){
	$imgSat="<img src='../FirmasIMG/FirmaSatisfaccion/{$firmaSat->getImgFirma()}' height='63px'>";
}

//fin Firma
//listado repuestos
$datosRepuestos= Repuesto::getDatosEnObjetos("numeroPreventivo='{$reportePreventivo->getNumeroReporte()}'", 'detalle');
$listaRepuestos='';
for ($i = 0; $i < count($datosRepuestos); $i++) {
    $objeto=$datosRepuestos[$i];
    $listaRepuestos.='<tr>';
    $listaRepuestos.="<td>{$objeto->getDetalle()}</td>";
    $listaRepuestos.="<td style='border-left: 1px solid #000; border-right: 1px solid #000;'>{$objeto->getReferencia()}</td>";
    $listaRepuestos.="<td style='border-right:none'>{$objeto->getCantidad()}</td>";
    $listaRepuestos.='</tr>';
}
//listado repuestos

switch (count($datosRepuestos)) {
    case '0':
        for ($k = 1; $k < 4; $k++) {
            $listaRepuestos.='<tr>';
            $listaRepuestos.="<td></td>";
            $listaRepuestos.="<td style='border-left: 1px solid #163E78; border-right: 1px solid #163E78;'></td>";
            $listaRepuestos.="<td style='border-right:none'></td>";
            $listaRepuestos.='</tr>';
        }
        break;
    case '1':
        for ($l = 1; $l < 3; $l++) {
            $listaRepuestos.='<tr>';
            $listaRepuestos.="<td></td>";
            $listaRepuestos.="<td style='border-left: 1px solid #163E78; border-right: 1px solid #163E78;'></td>";
            $listaRepuestos.="<td style='border-right:none'></td>";
            $listaRepuestos.='</tr>';
        }
        break;
    case '2':
        for ($m = 1; $m < 2; $m++) {
            $listaRepuestos.='<tr>';
            $listaRepuestos.="<td></td>";
            $listaRepuestos.="<td style='border-left: 1px solid #163E78; border-right: 1px solid #163E78;'></td>";
            $listaRepuestos.="<td style='border-right:none'></td>";
            $listaRepuestos.='</tr>';
        }
        break;
}

if ($reportePreventivo->getEquipo()->getIdeSede()!=null) {
    $direccion="mantenimiento/administrador/equiposMantenimientoSede.php&ide={$reportePreventivo->getIdeMantenimientoPreventivo()}";
    $empresa=$reportePreventivo->getEquipo()->getSede()->getCliente()->getNombre();
    $sede=$reportePreventivo->getEquipo()->getSede()->getNombre();
}else{
    $direccion="mantenimiento/administrador/equiposMantenimientoCliente.php&ide={$reportePreventivo->getIdeMantenimientoPreventivo()}";
    $empresa=$reportePreventivo->getEquipo()->getCliente()->getNombre();
    $sede=$reportePreventivo->getEquipo()->getCliente()->getNombre();    
}
if ($reportePreventivo->getIdeRutinaExtra()=='') {
    $rutinaSeleccionada=$reportePreventivo->getEquipo()->getTipoEquipo()->getRutinaLista();
}else{
    $rutinaSeleccionada=$reportePreventivo->getRutinaExtra()->getRutinaMostrar();
}


if($reportePreventivo->getValorMedido1()=='')$unidadMedida1='';
else $unidadMedida1=$reportePreventivo->getUnidadMedida1()->getUnidad();	
	
if($reportePreventivo->getValorMedido2()=='')$unidadMedida2='';
else $unidadMedida2=$reportePreventivo->getUnidadMedida2()->getUnidad();

if($reportePreventivo->getValorMedido3()=='')$unidadMedida3='';
else $unidadMedida3=$reportePreventivo->getUnidadMedida3()->getUnidad();	

if($reportePreventivo->getValorMedido4()=='')$unidadMedida4='';
else $unidadMedida4=$reportePreventivo->getUnidadMedida4()->getUnidad();

if($reportePreventivo->getValorMedido5()=='')$unidadMedida5='';
else $unidadMedida5=$reportePreventivo->getUnidadMedida5()->getUnidad();

if($reportePreventivo->getValorMedido6()=='')$unidadMedida6='';
else $unidadMedida6=$reportePreventivo->getUnidadMedida6()->getUnidad();	


//Inicio datos VerificacionMetrologica
$tablaVerificacion='';
switch($reportePreventivo->getValorMedido3()){
	case '':
		$tablaVerificacion.='<tr>';
		$tablaVerificacion.='<th class="bordeSuperiorIzquierdo" style="border-right: 1px solid #163E78;">Valor Nominal</th>';
		$tablaVerificacion.='<th class="bordeSuperiorDerecho">Valor Medido</th>';
		$tablaVerificacion.='</tr>';
		$tablaVerificacion.='<tr>';
		$tablaVerificacion.="<td style='border-right: 1px solid #163E78;'>{$reportePreventivo->getValorNominal1()} {$unidadMedida1}</td>";
		$tablaVerificacion.="<td>{$reportePreventivo->getValorMedido1()} {$unidadMedida1}</td>";
		$tablaVerificacion.='</tr>';
		$tablaVerificacion.='<tr>';
		$tablaVerificacion.="<td style='border-right: 1px solid #163E78;'>{$reportePreventivo->getValorNominal2()} {$unidadMedida2}</td>";
		$tablaVerificacion.="<td>{$reportePreventivo->getValorMedido2()} {$unidadMedida2}</td>";
		$tablaVerificacion.='</tr>';
	break;
	default:
		$tablaVerificacion.='<tr>';
		
		$tablaVerificacion.='<th class="bordeSuperiorIzquierdo" style="border-right: 1px dashed #163E78;">Valor Nominal</th>';
		$tablaVerificacion.='<th style="border-right: 1px solid #163E78;">Valor Medido</th>';
		
		$tablaVerificacion.="<th style='border-right: 1px dashed #163E78;'>Valor Nominal</th>";
		$tablaVerificacion.="<th style='border-right: 1px solid #163E78;'>Valor Medido</th>";
		
		$tablaVerificacion.="<th style='border-right: 1px dashed #163E78;'>Valor Nominal</th>";
		$tablaVerificacion.="<th class='bordeSuperiorDerecho'>Valor Medido</th>";
		
		$tablaVerificacion.='</tr>';
		
		$tablaVerificacion.='<tr>';
		
		$tablaVerificacion.="<td style='border-right: 1px dashed #163E78;'> <strong style='float:left'>1.</strong> {$reportePreventivo->getValorNominal1()} {$unidadMedida1}</td>";
		$tablaVerificacion.="<td style='border-right: 1px solid #163E78;'>{$reportePreventivo->getValorMedido1()} {$unidadMedida1}</td>";
		
		$tablaVerificacion.="<td style='border-right: 1px dashed #163E78;'><strong style='float:left'>3.</strong> {$reportePreventivo->getValorNominal3()} {$unidadMedida3}</td>";
		$tablaVerificacion.="<td style='border-right: 1px solid #163E78;'>{$reportePreventivo->getValorMedido3()} {$unidadMedida3}</td>";
		
		$tablaVerificacion.="<td style='border-right: 1px dashed #163E78;'><strong style='float:left'> 5.</strong>{$reportePreventivo->getValorNominal5()} {$unidadMedida5}</td>";
		$tablaVerificacion.="<td>{$reportePreventivo->getValorMedido5()} {$unidadMedida5}</td>";
		
		$tablaVerificacion.='</tr>';

		$tablaVerificacion.='<tr>';
		
		$tablaVerificacion.="<td style='border-right: 1px dashed #163E78;'><strong style='float:left'> 2.</strong> {$reportePreventivo->getValorNominal2()} {$unidadMedida2}</td>";
		$tablaVerificacion.="<td style='border-right: 1px solid #163E78;'>{$reportePreventivo->getValorMedido2()} {$unidadMedida2}</td>";
		
		$tablaVerificacion.="<td style='border-right: 1px dashed #163E78;'><strong style='float:left'> 4.</strong>{$reportePreventivo->getValorNominal4()} {$unidadMedida4}</td>";
		$tablaVerificacion.="<td style='border-right: 1px solid #163E78;'>{$reportePreventivo->getValorMedido4()} {$unidadMedida4}</td>";
		
		$tablaVerificacion.="<td style='border-right: 1px dashed #163E78;'><strong style='float:left'> 6.</strong> {$reportePreventivo->getValorNominal6()} {$unidadMedida6}</td>";
		$tablaVerificacion.="<td>{$reportePreventivo->getValorMedido6()} {$unidadMedida6}</td>";
		
		$tablaVerificacion.='</tr>';
	break;
}
//Fin datos VerificacionMetrologica
?>
        <div class='reporteMantenimientoDetalles'>
            <div class='encabezado'>
                <div class='izquierda'>
                    <br>
                    <label class='titulo'>REGISTRO DE SERVICIO</label>                    
                    <article class='numeroReporte'><?=$reportePreventivo->getNumeroReporte()?></article>
                    <label class='fecha'><?=$reportePreventivo->getCiudad().', '.$fecha->format('d').' de '.$mes.' de '.$fecha->format('Y')?></label>
                </div>               
                <div class='imagenes'>
                    <img src='../presentacion/imagenes/isotipoBio.png' height='50px' style='margin-top: 40px;margin-right: 30px'>
                    <img src='../presentacion/imagenes/CerificacionIcontec.png' height='110px' style='margin-left: 30px;margin-top: 10px'>
                </div>
            </div>
            <div class='formularioDetalle'>
                <div class='titulo'>REPORTE DE MANTENIMIENTO</div>
                <table class='datosCliente'>
                    <tr>
                        <th class='bordeSuperiorIzquierdo'>&nbsp;&nbsp;NOMBRE INGENIERO O TÉCNICO:</th>
                        <td class='bordeSuperiorDerecho'>&nbsp;&nbsp;<?=$reportePreventivo->getPersona()->getNombresCompletos()?></td>
                    </tr>
                    <tr>
                        <th style='border-top: 1px solid #163E78;border-bottom: 1px solid #163E78'>&nbsp;&nbsp;EMPRESA:</th>
                        <td style='border-top: 1px solid #163E78;border-bottom: 1px solid #163E78'>&nbsp;&nbsp;<?=$empresa?></td>
                    </tr>
                    <tr>
                        <th class='bordeInferiorIzquierdo'>&nbsp;&nbsp;SEDE:</th>
                        <td class='bordeInferiorDerecho'>&nbsp;&nbsp;<?=$sede?></td>
                    </tr>
                </table>
                <div class='subTitulo'>INFORMACIÓN DEL EQUIPO</div> 
                <table  class='datosEquipo'>
                    <tr>
                        <th class='bordeSuperiorIzquierdo' style='width: 230px'>&nbsp;&nbsp;NOMBRE DEL EQUIPO:</th>
                        <td colspan='3' class='bordeSuperiorDerecho'>&nbsp;&nbsp;<?=$reportePreventivo->getEquipo()->getNombreEquipo()?></td>
                    </tr>
                    <tr>
                        <th style='border-top: 1px solid #163E78;border-bottom: 1px solid #163E78'>&nbsp;&nbsp;MARCA:</th>
                        <td colspan='3' style='border-top: 1px solid #163E78;border-bottom: 1px solid #163E78'>&nbsp;&nbsp;<?=$reportePreventivo->getEquipo()->getMarca()?></td>
                    </tr>
                    <tr>
                        <th style='border-bottom: 1px solid #163E78'>&nbsp;&nbsp;MODELO:</th>
                        <td style='border-bottom: 1px solid #163E78'>&nbsp;&nbsp;<?=$reportePreventivo->getEquipo()->getModelo()?></td>
                        <th style='border-left: 1px solid #163E78;border-bottom: 1px solid #163E78'>&nbsp;&nbsp;SERIE:</th>
                        <td style='border-bottom: 1px solid #163E78'>&nbsp;&nbsp;<?=$reportePreventivo->getEquipo()->getSerial()?></td>
                    </tr>                    
                    <tr>
                        <th class='bordeInferiorIzquierdo'>&nbsp;&nbsp;UBICACIÓN:</th>
                        <td>&nbsp;&nbsp;<?=$reportePreventivo->getEquipo()->getUbicacion()?></td>
                        <th style='border-left: 1px solid #163E78;'>&nbsp;&nbsp;CÓDIGO:</th>
                        <td class='bordeInferiorDerecho'>&nbsp;&nbsp;<?=$reportePreventivo->getEquipo()->getActivoFijo()?></td>
                    </tr>
                </table>
                <table class='tipoEquipo'>
                    <tr>
                        <th>&nbsp;&nbsp;TIPO EQUIPO:</th>
                        <td>&nbsp;&nbsp;<?=$reportePreventivo->getEquipo()->getTipoEquipo()->getTipoLista()?></td>
                    </tr>
                </table>
                <table class='tipoMantenimiento'>
                    <tr>
                        <th>&nbsp;&nbsp;TIPO DE SERVICIO:</th>
                        <td>
                            <ul class='botones'>
                                <?=$reportePreventivo->getTipoMantenimientoReporte('cambio')?>
                                <li>
                                    <div class='subrayar'>&nbsp;&nbsp;&nbsp;</div>
                                </li>
                            </ul>
                        </td>
                    </tr>
                </table>
                <div class='subTitulo'>TIPO FALLA</div>
                <table class='tipoFalla'>
                    <tr>
                        <td>
                            <ul class='botones'>
                                <?=$reportePreventivo->getTipoFallaListaReporte('cambio')?>
                                <li><div class='subrayar'>&nbsp;&nbsp;&nbsp;<?=$reportePreventivo->getOtraFalla()?></div></li>
                            </ul>
                        </td>
                    </tr>
                </table>
                <table class='problema'>
                    <tr>
                        <th>&nbsp;&nbsp;PROBLEMA PRESENTADO:</th>
                        <td>&nbsp;&nbsp;</td>
                    </tr>
                </table>
                <div class='subTitulo'>ACTIVIDADES</div>
                <table class='actividades'>
                    <tr>
                        <td rowspan='2' style='border-bottom-left-radius: 8px;border-top-left-radius: 8px'>
                            <table>
                                <tr>
                                    <td><?=$reportePreventivo->getPruebaInicialReporte('cambio')?></td>
                                    <td><?=$reportePreventivo->getSistemaOpticoReporte('cambio')?></td>
                                </tr>
                                <tr>
                                    <td><?=$reportePreventivo->getAspectoFisicoReporte('cambio')?></td>
                                    <td><?=$reportePreventivo->getSistemaElectromecanicoReporte('cambio')?></td>
                                </tr>
                                <tr>
                                    <td><?=$reportePreventivo->getCondicionAmbientalReporte('cambio')?></td>
                                    <td><?=$reportePreventivo->getSistemaVaporReporte('cambio')?></td>
                                </tr>
                                <tr>
                                    <td><?=$reportePreventivo->getSistemaElectronicoReporte('cambio')?></td>
                                    <td><?=$reportePreventivo->getSistemaOperativoReporte('cambio')?></td>
                                </tr>
                                <tr>
                                    <td><?=$reportePreventivo->getSistemaHidraulicoReporte('cambio')?></td>
                                    <td><?=$reportePreventivo->getLimpiezaInternaReporte('cambio')?></td>
                                </tr>
                                <tr>
                                    <td><?=$reportePreventivo->getSistemaNeumaticoReporte('cambio')?></td>
                                    <td><?=$reportePreventivo->getLimpiezaExternaReporte('cambio')?></td>
                                </tr>
                                <tr>
                                    <td> <?=$reportePreventivo->getSistemaMecanicoReporte('cambio')?></td>
                                    <td> <?=$reportePreventivo->getLubricacionPartesReporte('cambio')?></td>
                                </tr>
                                <tr>
                                    <td><?=$reportePreventivo->getSistemaElectricoReporte('cambio')?></td>
                                    <td><?=$reportePreventivo->getPruebasFuncionamientoReporte('cambio')?></td>
                                </tr>
                            </table>                         
                        </td>
                        <th class='bordeSuperiorDerecho'>Rutina de Mantenimiento</th>
                    </tr>
                    <tr>
                        <td class='bordeInferiorDerecho' style='width: 170px;font-size: 10px;border-left: 1px solid #163E78;'><?=$rutinaSeleccionada?></td>
                    </tr>
                </table>
                <div class='subTitulo'>VERIFICACIÓN METROLÓGICA</div>
                <table class='datosMetrologicos'>
                    <?=$tablaVerificacion?>                    
                </table>
                <div class='subTitulo'>REPUESTOS UTILIZADOS</div>
                <table class='repuestos'>
                    <tr>
                        <th class='bordeSuperiorIzquierdo'>Detalle</th>
                        <th style='border-left: 1px solid #163E78; border-right: 1px solid #163E78;'>Referencia</th>
                        <th class='bordeSuperiorDerecho'>Cantidad</th>
                    </tr>
                    <?=$listaRepuestos?>
                </table>
                <div class='subTitulo'>OBSERVACIONES</div>
                <table class='observaciones'>
                    <tr>
                        <th><ul><li>&nbsp;&nbsp;EL EQUIPO FUNCIONA CORRECTAMENTE:</li><?=$reportePreventivo->getFuncionamientoCorrectoReporte('cambio')?></ul></th>
                    </tr>
                    <tr>
                        <td valign='top'>
                            <p>
                                <?=$reportePreventivo->getObservaciones()?>
                            </p>
                        </td>
                    </tr>                    
                </table>
                <div class='firmas'>
                    <section class='firmaIngeniero'>
						<?=$imgFirm?>
                        <hr/>
                        <label>INGENIERO O TÉCNICO RESPONSABLE</label>
                    </section>
                    <section class='firmaSatisfaccion'>
						<?=$imgSat?>
                        <hr/>
                        <label>FIRMA DE QUIEN RECIBE A SATISFACCIÓN</label>
                    </section>                    
                </div>
				<div class='piePagina'>
                    	<p>Carrera 27 #15-24 - Celulares: 3177508140 - 3166245393<br>
                        	biometrical.pasto@gmail.com<br>
                    		www.laboratoriobiometrical.com.co</p>                   
                  		<img src='../presentacion/imagenes/biometricalEscalaGrises.png' height='30px' class='img'>
                    <div style='width: 100%;height: 20px;text-align: initial;font-size: 7px;margin-top: 20px'>DOCUMENTO CONTROLADO, PROHIBIDA SU REPRODUCCIÓN PARCIAL O TOTAL SIN AUTORIZACIÓN. V.03</div>
				</div>
            </div>
        </div>         

