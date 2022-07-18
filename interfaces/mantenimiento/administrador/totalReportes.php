<?php

require_once dirname(__FILE__) . '/../../../clasesMantenimiento/VerificacionMetrologica.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/ReportePreventivo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Repuesto.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;


$reportePreventivo=new ReportePreventivo('numeroReporte', "'".$numeroReporte."'");
$fecha=new DateTime($reportePreventivo->getMantenimientoPreventivo()->getFecha());
$meses= array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
$mes=$meses[$fecha->format('n')-1];
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
<html>
    <head>
        <title>Reporte de MantenimientoPreventivo</title>
        <link href="https://fonts.googleapis.com/css?family=Cabin|Hepta+Slab&display=swap" rel="stylesheet" />
<style>
*{
	margin:0 0;
  	color-adjust: exact;  
}
.reporteMantenimiento{
	font-family: 'Arial', Helvetica;
	font-size: 12px;
    height: auto;
    width: 100%;
    margin: 0;
	-webkit-print-color-adjust: exact;
}

.reporteMantenimiento .encabezado{
 	margin:20px;
   	width: 95%;
    height: 125px;
    margin-bottom: 0px;
}
.reporteMantenimiento .encabezado .izquierda{
    text-align: center;
    height: 115px;
    width: 32%;
    float: left;
    font-size: 13px;
    color: #061E41;
}
.reporteMantenimiento .encabezado .titulo{
    margin-top: 20px;
    font-weight: bold;
}
.reporteMantenimiento .encabezado .izquierda .numeroReporte{
    font-size: 25px;
    font-family: 'Hepta Slab', serif;
    font-weight: bold;
    border: 2px dashed #4775A6;
    color: #9F0404;
    padding: 8px;
    width: 100px;
    margin: 10px auto;
}
.reporteMantenimiento .encabezado .imagenes{
    height: 115px;
    float: right;
	width: 68%;
}
.reporteMantenimiento .formulario{
    width: 95%;
    margin: 0 auto;
}
.reporteMantenimiento .formulario .titulo{   
    background: #4775A6;
    margin: 3px auto;
    color: #fff;
    text-align: center;
    font-size: 14px;
    width: 100%;
	height:20px;
    padding: 2px 0;
    border-radius: 8px;
    font-weight: bold;
    border: 1px solid #18385B;
}
.reporteMantenimiento .formulario .subTitulo{   
    background: #4775A6;
    color: #fff;
    width: 50%;
    height: 18px;
    font-weight: bold;
    font-size: 14px;
    margin: 0 auto;    
    text-align: center;
    margin-top: 3px;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px; 
    border: 1px solid #18385B;  
    border-bottom: none;
}
.reporteMantenimiento .formulario .datosCliente{
    width: 100%;
    border-spacing: 0;
    margin-top: 28px;
    font-size: 12px;
    border: 1px solid #163E78;
    border-radius: 8px;
    color: #061E41;
}
.reporteMantenimiento .formulario .datosCliente th{
    text-align: initial;
    background: rgba(173,185,201,.5);
    height: 20px;
    width: 230px;
    border-right: 1px solid #163E78;
}
.reporteMantenimiento .formulario .datosCliente td{
    text-align: initial;   
}
.reporteMantenimiento .formulario .bordeSuperiorIzquierdo{
    border-top-left-radius: 8px;
}
.reporteMantenimiento .formulario .bordeInferiorIzquierdo{
    border-bottom-left-radius: 8px;
}
.reporteMantenimiento .formulario .bordeSuperiorDerecho{
    border-top-right-radius: 8px;
}
.reporteMantenimiento .formulario .bordeInferiorDerecho{
    border-bottom-right-radius: 8px;
}
.reporteMantenimiento .formulario .datosEquipo{
    width: 100%;
    border-spacing: 0;
    font-size: 12px;
    border: 1px solid #18385B;
    border-radius: 8px;
    color: #061E41;
}
.reporteMantenimiento .formulario .datosEquipo th{
    text-align: initial;
    background: rgba(173,185,201,.5);
    height: 20px;
    border-right: 1px solid #18385B;    
}
.reporteMantenimiento .formulario .datosEquipo td{
    text-align: initial;
}

.reporteMantenimiento .formulario .tipoEquipo{
    width: 100%;
    height: 20px;
    margin:3px auto;
    border-spacing: 0;
    font-size: 12px;
    border: 1px solid #18385B;
    border-radius: 8px;
    color: #061E41;
}
.reporteMantenimiento .formulario .tipoEquipo th{
    background: rgba(173,185,201,.5);
    text-align: initial;
    border-bottom-left-radius: 8px;
    border-top-left-radius: 8px;
    width: 175px;
    border-right: 1px solid #18385B;
}
.reporteMantenimiento .formulario .tipoEquipo td{
    border-bottom-right-radius: 8px;
    border-top-right-radius: 8px;
}
.reporteMantenimiento .formulario .tipoMantenimiento{
    width: 100%;
    margin: 0 auto;
    border: 1px solid #18385B;
    border-radius: 8px;
    font-size: 12px;
    border-spacing: 0;
    color: #061E41;
height:35px;
}
.reporteMantenimiento .formulario .tipoMantenimiento th{
    background: rgba(173,185,201,.5);
    border-top-left-radius: 8px;
    border-bottom-left-radius: 8px;
    border-right: 1px solid #18385B;
    width: 175px;
    text-align: initial;
}
.reporteMantenimiento .formulario .tipoMantenimiento .botones{
    list-style: none;
}
.reporteMantenimiento .formulario .tipoMantenimiento .botones li{
    display: block;
    width: 25%;
    float: left;
}
.reporteMantenimiento .formulario .tipoMantenimiento .botones li label{
    padding-left: 35px;
    position: relative;
    left: -25px;
}
.reporteMantenimiento .formulario .tipoMantenimiento .botones li span{
    margin-left: 2px;
}
.reporteMantenimiento .formulario .tipoMantenimiento .botones li .subrayar{
    width: 90%;
    height: 10px;
    margin-top: 1px;
    border-bottom: 1px solid #18385B;
    font-style: oblique;
}
.reporteMantenimiento .formulario .tipoFalla{
    border: 1px solid #18385B;
    border-radius: 8px;
    width: 100%;
    font-size: 10px;
    height: 45px;
    color: #061E41;
}
.reporteMantenimiento .formulario .tipoFalla .botones{
    list-style-type: none;
}
.reporteMantenimiento .formulario .tipoFalla .botones li{
    display: block;
    width: 20%;
    float: left;
}
.reporteMantenimiento .formulario .tipoFalla .botones li label{
    padding-left: 35px;
    position: relative;
    left: -25px;
}
.reporteMantenimiento .formulario .tipoFalla .botones li span{
  display: inline-block;
  position: relative;
  top: 5px;
  text-align: center;
  width: 13px;
  height: 13px;
  background: #fff;
  left: 10px;
}
.reporteMantenimiento .formulario .tipoFalla .botones li .subrayar{
    width: 90%;
    height: 15px;
    margin-top: 1px;
    border-bottom: 1px solid #18385B;
    font-style: oblique;
}
.reporteMantenimiento .formulario .problema{
    width: 100%;
    height: 20px;
    font-size: 12px;
    margin: 3px auto;
    border-spacing: 0;
    border: 1px solid #18385B;
    border-radius: 8px;
    color: #061E41;
}
.reporteMantenimiento .formulario .problema th{
    background: rgba(173,185,201,.5);
    text-align: initial;
    border-bottom-left-radius: 8px;
    border-top-left-radius: 8px;
    width: 200px;
    border-right: 1px solid #18385B;
}
.reporteMantenimiento .formulario .problema td{
    text-align: initial;
    border-bottom-right-radius: 8px;
    border-top-right-radius: 8px;
}
.reporteMantenimiento .formulario .actividades{
    width: 100%;
    height: 115px;
    font-size: 12px;
    border-spacing: 0; 
    min-height: 130px;
    border: 1px solid #18385B;
    border-radius: 8px;
    color: #061E41;
}
.reporteMantenimiento .formulario .actividades th{
    width: 400px;
    min-width: 140px;
    height: 20px;
    background: rgba(173,185,201,.5);
    border-bottom: 1px solid #18385B;
    border-left: 1px solid #18385B;
}
.reporteMantenimiento .formulario .actividades td{
    text-align: left;
    font-size: 10px;
    
}
.reporteMantenimiento .formulario .actividades td div{
    margin-left: 10px;
    margin-right: 10px;
}

.reporteMantenimiento .formulario .datosMetrologicos{
    width: 100%;
    font-size: 12px;
    border-spacing: 0;
    border: 1px solid #18385B;
    border-radius: 8px;
    color: #061E41;
}
.reporteMantenimiento .formulario .datosMetrologicos th{
    background: rgba(173,185,201,.5);
}
.reporteMantenimiento .formulario .datosMetrologicos td{
    border-top: 1px solid #18385B;
    text-align: center;
    height: 17px;
    font-size: 10px;
}
.reporteMantenimiento .formulario .repuestos{
    width: 100%;
    border-spacing: 0;
    border: 1px solid #18385B;
    border-radius: 8px;
    font-size: 12px;
    color: #061E41;
}
.reporteMantenimiento .formulario .repuestos th{
    background: rgba(173,185,201,.5);
    width: 30%;
}
.reporteMantenimiento .formulario .repuestos td{
    text-align: center;
    border-top: 1px solid #18385B;
    height: 17px;
    font-size: 10px;
}
.reporteMantenimiento .formulario .observaciones{
    font-size: 12px;
    border: 1px solid #18385B;
    border-radius: 8px;
    width: 100%;
    border-spacing: 0;
    color: #061E41;
}
.reporteMantenimiento .formulario .observaciones th{
    border-bottom: 1px solid #18385B;
    background: rgba(173,185,201,.5);
    text-align: justify;
    height: 23px;
    display: block;
    border-top-right-radius: 8px;
    border-top-left-radius: 8px;
}
.reporteMantenimiento .formulario .observaciones th ul{
    list-style: none;
}
.reporteMantenimiento .formulario .observaciones th ul li{
    display: block;
    float: left;
}
.reporteMantenimiento .formulario .observaciones th label{
    padding-left: 38px;
    position: relative;
    left: -25px;
    font-weight: lighter;
}
.reporteMantenimiento .formulario .observaciones th span{
    display: inline-block;
    position: relative;
    top: 4px;
    text-align: center;
    width: 12px;
    height: 12px;
    background: #fff;
    left: 10px;
}
.reporteMantenimiento .formulario .observaciones td{
    height: 40px;  
    font-size: 10px;
}
.reporteMantenimiento .formulario .observaciones td p{
    text-align: justify;
    margin: 3px;
}
.reporteMantenimiento .formulario .piePagina{
    width: 100%;
    text-align: center;
    margin-top: 63px;
    font-size: 11px;
    font-weight: bolder;
    font-style: italic;
    color: #061E41;
}
.reporteMantenimiento .formulario .piePagina .firmaIngeniero{
    width: 49%;
    float: left;
    height: 25px;
    text-align: center;
}
.reporteMantenimiento .formulario .piePagina .firmaSatisfaccion{
    width: 49%;
    float: right;
    height: 25px;
    text-align: center;
}
.reporteMantenimiento .formulario .piePagina hr{
    height: 1px;
    background: #18385B;
    margin: 0 auto;
    width: 300px;
    border: none;
}
.reporteMantenimiento .formulario .piePagina .version{
    width: 100%;
    height: 20px;
    position: fixed;
}
.reporteMantenimiento .formulario .piePagina p{
    font-size: 8px;
}
.reporteMantenimiento .formulario .piePagina img{
    opacity: 0.5;
    float: right;
}

</style>
    </head>
    <body>
        <div class="reporteMantenimiento">
            <div class="encabezado">
                <div class="izquierda">
                    <br>
                    <label class="titulo">REGISTRO DE SERVICIO</label>
                    
                    <article class="numeroReporte"><?=$reportePreventivo->getNumeroReporte()?></article>
                    <label class="fecha"><?=$reportePreventivo->getCiudad().', '.$fecha->format('d').' de '.$mes.' de '.$fecha->format('Y')?></label>
                </div>               
                <div class="imagenes">
                    <img src="../../../presentacion/imagenes/isotipoBio.png" height="50px" style="margin-right: 30px">
                    <img src="../../../presentacion/imagenes/CerificacionIcontec.png" height="110px" style="margin-left: 30px;margin-top: 10px">
                </div>
            </div>
            <div class="formulario">
                <section class="titulo">REPORTE DE MANTENIMIENTO</section>
<section>
                <table class="datosCliente">
                    <tr>
                        <th class="bordeSuperiorIzquierdo">&nbsp;&nbsp;NOMBRE INGENIERO O TÉCNICO:</th>
                        <td class="bordeSuperiorDerecho">&nbsp;&nbsp;<?=$reportePreventivo->getPersona()->getNombresCompletos()?></td>
                    </tr>
                    <tr>
                        <th style="border-top: 1px solid #163E78;border-bottom: 1px solid #163E78">&nbsp;&nbsp;EMPRESA:</th>
                        <td style="border-top: 1px solid #163E78;border-bottom: 1px solid #163E78">&nbsp;&nbsp;<?=$empresa?></td>
                    </tr>
                    <tr>
                        <th class="bordeInferiorIzquierdo">&nbsp;&nbsp;SEDE:</th>
                        <td class="bordeInferiorDerecho">&nbsp;&nbsp;<?=$sede?></td>
                    </tr>
                </table>
</section>
                <div class="subTitulo">INFORMACIÓN DEL EQUIPO</div>
                <table  class="datosEquipo">
                    <tr>
                        <th class="bordeSuperiorIzquierdo" style="width: 230px">&nbsp;&nbsp;NOMBRE DEL EQUIPO:</th>
                        <td colspan="3" class="bordeSuperiorDerecho">&nbsp;&nbsp;<?=$reportePreventivo->getEquipo()->getNombreEquipo()?></td>
                    </tr>
                    <tr>
                        <th style="border-top: 1px solid #163E78;border-bottom: 1px solid #163E78">&nbsp;&nbsp;MARCA:</th>
                        <td colspan="3" style="border-top: 1px solid #163E78;border-bottom: 1px solid #163E78">&nbsp;&nbsp;<?=$reportePreventivo->getEquipo()->getMarca()?></td>
                    </tr>
                    <tr>
                        <th style="border-bottom: 1px solid #163E78">&nbsp;&nbsp;MODELO:</th>
                        <td style="border-bottom: 1px solid #163E78">&nbsp;&nbsp;<?=$reportePreventivo->getEquipo()->getModelo()?></td>
                        <th style="border-left: 1px solid #163E78;border-bottom: 1px solid #163E78">&nbsp;&nbsp;SERIE:</th>
                        <td style="border-bottom: 1px solid #163E78">&nbsp;&nbsp;<?=$reportePreventivo->getEquipo()->getSerial()?></td>
                    </tr>                    
                    <tr>
                        <th class="bordeInferiorIzquierdo">&nbsp;&nbsp;UBICACIÓN:</th>
                        <td>&nbsp;&nbsp;<?=$reportePreventivo->getEquipo()->getUbicacion()?></td>
                        <th style="border-left: 1px solid #163E78;">&nbsp;&nbsp;CÓDIGO:</th>
                        <td class="bordeInferiorDerecho">&nbsp;&nbsp;<?=$reportePreventivo->getEquipo()->getActivoFijo()?></td>
                    </tr>
                </table>
                <table class="tipoEquipo">
                    <tr>
                        <th>&nbsp;&nbsp;TIPO EQUIPO:</th>
                        <td>&nbsp;&nbsp;<?=$reportePreventivo->getEquipo()->getTipoEquipo()->getTipoLista()?></td>
                    </tr>
                </table>
                <table class="tipoMantenimiento">
                    <tr>
                        <th>&nbsp;&nbsp;TIPO DE SERVICIO:</th>
                        <td>
                            <ul class="botones">
                                <?=$reportePreventivo->getTipoMantenimientoReporte()?>
                                <li>
                                    <div class="subrayar">&nbsp;&nbsp;&nbsp;</div>
                                </li>
                            </ul>
                        </td>
                    </tr>
                </table>
                <div class="subTitulo">TIPO FALLA</div>
                <table class="tipoFalla">
                    <tr>
                        <td>
                            <ul class="botones">
                                <?=$reportePreventivo->getTipoFallaListaReporte()?>
                                <li><div class="subrayar">&nbsp;&nbsp;&nbsp;<?=$reportePreventivo->getOtraFalla()?></div></li>
                            </ul>
                        </td>
                    </tr>
                </table>
                <table class="problema">
                    <tr>
                        <th>&nbsp;&nbsp;PROBLEMA PRESENTADO:</th>
                        <td>&nbsp;&nbsp;</td>
                    </tr>
                </table>
                <div class="subTitulo">ACTIVIDADES</div>
                <table class="actividades">
                    <tr>
                        <td rowspan="2" style="border-bottom-left-radius: 8px;border-top-left-radius: 8px">
                            <table>
                                <tr>
                                    <td><?=$reportePreventivo->getPruebaInicialReporte()?></td>
                                    <td><?=$reportePreventivo->getSistemaOpticoReporte()?></td>
                                </tr>
                                <tr>
                                    <td><?=$reportePreventivo->getAspectoFisicoReporte()?></td>
                                    <td><?=$reportePreventivo->getSistemaElectromecanicoReporte()?></td>
                                </tr>
                                <tr>
                                    <td><?=$reportePreventivo->getCondicionAmbientalReporte()?></td>
                                    <td><?=$reportePreventivo->getSistemaVaporReporte()?></td>
                                </tr>
                                <tr>
                                    <td><?=$reportePreventivo->getSistemaElectronicoReporte()?></td>
                                    <td><?=$reportePreventivo->getSistemaOperativoReporte()?></td>
                                </tr>
                                <tr>
                                    <td><?=$reportePreventivo->getSistemaHidraulicoReporte()?></td>
                                    <td><?=$reportePreventivo->getLimpiezaInternaReporte()?></td>
                                </tr>
                                <tr>
                                    <td><?=$reportePreventivo->getSistemaNeumaticoReporte()?></td>
                                    <td><?=$reportePreventivo->getLimpiezaExternaReporte()?></td>
                                </tr>
                                <tr>
                                    <td> <?=$reportePreventivo->getSistemaMecanicoReporte()?></td>
                                    <td> <?=$reportePreventivo->getLubricacionPartesReporte()?></td>
                                </tr>
                                <tr>
                                    <td><?=$reportePreventivo->getSistemaElectricoReporte()?></td>
                                    <td><?=$reportePreventivo->getPruebasFuncionamientoReporte()?></td>
                                </tr>
                            </table>                         
                        </td>
                        <th class="bordeSuperiorDerecho">Rutina de Mantenimiento</th>
                    </tr>
                    <tr>
                        <td class="bordeInferiorDerecho" style="width: 170px;font-size: 10px;border-left: 1px solid #163E78;"><?=$rutinaSeleccionada?></td>
                    </tr>
                </table>
                <div class="subTitulo">VERIFICACIÓN METROLÓGICA</div>
                <table class="datosMetrologicos">
                    <?=$tablaVerificacion?>                    
                </table>
                <div class="subTitulo">REPUESTOS UTILIZADOS</div>
                <table class="repuestos">
                    <tr>
                        <th class="bordeSuperiorIzquierdo">Detalle</th>
                        <th style="border-left: 1px solid #163E78; border-right: 1px solid #163E78;">Referencia</th>
                        <th class="bordeSuperiorDerecho">Cantidad</th>
                    </tr>
                    <?=$listaRepuestos?>
                </table>
                <div class="subTitulo">OBSERVACIONES</div>
                <table class="observaciones">
                    <tr>
                        <th><ul><li>&nbsp;&nbsp;EL EQUIPO FUNCIONA CORRECTAMENTE:</li><?=$reportePreventivo->getFuncionamientoCorrectoReporte()?></ul></th>
                    </tr>
                    <tr>
                        <td valign="top">
                            <p>
                                <?=$reportePreventivo->getObservaciones()?>
                            </p>
                        </td>
                    </tr>                    
                </table>
                <div class="piePagina">
                    <section class="firmaIngeniero">
                        <hr/>
                        <label>INGENIERO O TÉCNICO RESPONSABLE</label>
                    </section>
                    <section class="firmaSatisfaccion">
                        <hr/>
                        <label>FIRMA DE QUIEN RECIBE A SATISFACCIÓN</label>
                    </section>
                    <p>Carrera 27 #15-24 - Celulares: 3177508140 - 3166245393<br>
                        biometrical.pasto@gmail.com<br>
                    www.laboratoriobiometrical.com.co</p>                   
                    <img src="../../../presentacion/imagenes/biometricalEscalaGrises.png" height="30px">
                    <div style="width: 100%;height: 20px;text-align: initial;font-size: 7px;margin-top: 20px">DOCUMENTO CONTROLADO, PROHIBIDA SU REPRODUCCIÓN PARCIAL O TOTAL SIN AUTORIZACIÓN. V.03</div>
                    
                </div>
            </div>
        </div>
            
    </body>
</html>
