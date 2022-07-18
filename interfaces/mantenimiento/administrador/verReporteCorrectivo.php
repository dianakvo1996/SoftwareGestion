<?php
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/VerificacionMetrologica.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Repuesto.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/ReporteCorrectivo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/VerificacionMetrologica.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$reporteCorrectivo=new ReporteCorrectivo('numeroReporte', "'".$numeroReporte."'");
$fecha=new DateTime($reporteCorrectivo->getFecha());
$meses= array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
$mes=$meses[$fecha->format('n')-1];
//listado repuestos
$datosRepuestos= Repuesto::getDatosEnObjetos("numeroCorrectivo='{$reporteCorrectivo->getNumeroReporte()}'", 'detalle');
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
//Inicio datos VerificacionMetrologica
$datosMetrologicos= VerificacionMetrologica::getDatosEnObjetos("numeroCorrectivo='$numeroReporte'", 'ide');
$listaMetrologica='';
for ($j = 0; $j < count($datosMetrologicos); $j++) {
    $objetoMetrologia=$datosMetrologicos[$j];
    $listaMetrologica.='<tr>';
    $listaMetrologica.="<td style='border-right: 1px solid #000;'>{$objetoMetrologia->getValorNominal()} {$objetoMetrologia->getUnidadMedida()->getUnidad()}</td>";
    $listaMetrologica.="<td>{$objetoMetrologia->getValorMedido()} {$objetoMetrologia->getUnidadMedida()->getUnidad()}</td>";
    $listaMetrologica.='</tr>';
}
//Fin datos VerificacionMetrologica
switch (count($datosRepuestos)) {
    case '0':
        for ($k = 1; $k < 4; $k++) {
            $listaRepuestos.='<tr>';
            $listaRepuestos.="<td></td>";
            $listaRepuestos.="<td style='border-left: 1px solid #000; border-right: 1px solid #000;'></td>";
            $listaRepuestos.="<td style='border-right:none'></td>";
            $listaRepuestos.='</tr>';
        }
        break;
    case '1':
        for ($l = 1; $l < 3; $l++) {
            $listaRepuestos.='<tr>';
            $listaRepuestos.="<td></td>";
            $listaRepuestos.="<td style='border-left: 1px solid #000; border-right: 1px solid #000;'></td>";
            $listaRepuestos.="<td style='border-right:none'></td>";
            $listaRepuestos.='</tr>';
        }
        break;
    case '2':
        for ($m = 1; $m < 2; $m++) {
            $listaRepuestos.='<tr>';
            $listaRepuestos.="<td></td>";
            $listaRepuestos.="<td style='border-left: 1px solid #000; border-right: 1px solid #000;'></td>";
            $listaRepuestos.="<td style='border-right:none'></td>";
            $listaRepuestos.='</tr>';
        }
        break;
}
if ($reporteCorrectivo->getEquipo()->getIdeSede()!=null) {
    $direccion="mantenimiento/administrador/mantenimientoCorrectivoSede.php&ideSede={$reporteCorrectivo->getIdeSede()}";
    $empresa=$reporteCorrectivo->getSede()->getCliente()->getNombre();
    $sede=$reporteCorrectivo->getEquipo()->getSede()->getNombre();
}else{
    $direccion="mantenimiento/administrador/mantenimientoCorrectivoCliente.php&nitCliente={$reporteCorrectivo->getNitCliente()}";
    $empresa=$reporteCorrectivo->getCliente()->getNombre();
    $sede=$reporteCorrectivo->getCliente()->getNombre();    
}
?>
<html>
    <head>
        <title>Reporte de Mantenimiento</title>
        <link href="../../../presentacion/css/estiloVista.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="../../../presentacion/css/imprimir.css" rel="stylesheet" type="text/css" media="print"/>
        <link rel="shortcut icon" type="image/x-icon" href="../../../presentacion/imagenes/logoIcono.ico" />
        <link href="https://fonts.googleapis.com/css?family=Cabin|Hepta+Slab&display=swap" rel="stylesheet" />
        <style>
            @media print { html {zoom: 100%;} }
        </style>
    </head>
    <body>
        <a href="../../principal.php?CONTENIDO=<?=$direccion?>" style="float: left" class="volver"><img src="../../../presentacion/iconos/atras.png" title="Volver" height="40px"></a>
        <div class="opciones">
            <a href="../../principal.php?CONTENIDO=mantenimiento/administrador/reporteMantenimietoCorrectivo.php&accion=Modificar&numeroReporte=<?=$reporteCorrectivo->getNumeroReporte()?>" class="boton">Modificar</a>
            <a onclick="imprimir()">Imprimir</a>
        </div>
        <div class="reporteMantenimiento">
            <div class="encabezado">
                <div class="izquierda">
                    <br>
                    <label class="titulo">REGISTRO DE SERVICIO</label>
                    
                    <article class="numeroReporte"><?=$reporteCorrectivo->getNumeroReporte()?></article>
                    <label class="fecha"><?=$reporteCorrectivo->getCiudad().', '.$fecha->format('d').' de '.$mes.' de '.$fecha->format('Y')?></label>
                </div>               
                <div class="imagenes">
                    <img src="../../../presentacion/imagenes/biometricalEscalaGrises.png" height="50px" style="margin-top: 40px;margin-right: 30px">
                    <img src="../../../presentacion/imagenes/CerificacionIcontec.png" height="110px" style="margin-left: 30px;margin-top: 10px">
                </div>
            </div>
            <div class="formulario">
                <div class="titulo">REPORTE DE MANTENIMIENTO</div>
                <table class="datosCliente">
                    <tr>
                        <th class="bordeSuperiorIzquierdo">&nbsp;&nbsp;NOMBRE INGENIERO O TÉCNICO:</th>
                        <td class="bordeSuperiorDerecho">&nbsp;&nbsp;<?=$reporteCorrectivo->getPersona()->getNombresCompletos()?></td>
                    </tr>
                    <tr>
                        <th style="border-top: 1px solid #000;border-bottom: 1px solid #000">&nbsp;&nbsp;EMPRESA:</th>
                        <td style="border-top: 1px solid #000;border-bottom: 1px solid #000">&nbsp;&nbsp;<?=$empresa?></td>
                    </tr>
                    <tr>
                        <th class="bordeInferiorIzquierdo">&nbsp;&nbsp;SEDE:</th>
                        <td class="bordeInferiorDerecho">&nbsp;&nbsp;<?=$sede?></td>
                    </tr>
                </table>
                <div class="subTitulo">INFORMACIÓN DEL EQUIPO</div>
                <table  class="datosEquipo">
                    <tr>
                        <th class="bordeSuperiorIzquierdo">&nbsp;&nbsp;NOMBRE DEL EQUIPO:</th>
                        <td colspan="3" class="bordeSuperiorDerecho">&nbsp;&nbsp;<?=$reporteCorrectivo->getEquipo()->getNombreEquipo()?></td>
                    </tr>
                    <tr>
                        <th style="border-top: 1px solid #000;border-bottom: 1px solid #000">&nbsp;&nbsp;MARCA:</th>
                        <td colspan="3" style="border-top: 1px solid #000;border-bottom: 1px solid #000">&nbsp;&nbsp;<?=$reporteCorrectivo->getEquipo()->getMarca()?></td>
                    </tr>
                    <tr>
                        <th style="border-bottom: 1px solid #000">&nbsp;&nbsp;MODELO:</th>
                        <td style="border-bottom: 1px solid #000">&nbsp;&nbsp;<?=$reporteCorrectivo->getEquipo()->getModelo()?></td>
                        <th style="border-left: 1px solid #000;border-bottom: 1px solid #000">&nbsp;&nbsp;SERIE:</th>
                        <td style="border-bottom: 1px solid #000">&nbsp;&nbsp;<?=$reporteCorrectivo->getEquipo()->getSerial()?></td>
                    </tr>
                    
                    <tr>
                        <th class="bordeInferiorIzquierdo">&nbsp;&nbsp;UBICACIÓN:</th>
                        <td>&nbsp;&nbsp;<?=$reporteCorrectivo->getEquipo()->getUbicacion()?></td>
                        <th style="border-left: 1px solid #000;">&nbsp;&nbsp;CÓDIGO:</th>
                        <td class="bordeInferiorDerecho">&nbsp;&nbsp;<?=$reporteCorrectivo->getEquipo()->getActivoFijo()?></td>
                    </tr>
                </table>
                <table class="tipoEquipo">
                    <tr>
                        <th>&nbsp;&nbsp;TIPO EQUIPO:</th>
                        <td>&nbsp;&nbsp;<?=$reporteCorrectivo->getEquipo()->getTipoEquipo()->getTipoLista()?></td>
                    </tr>
                </table>
                <table class="tipoMantenimiento">
                    <tr>
                        <th>&nbsp;&nbsp;TIPO DE SERVICIO:</th>
                        <td>
                            <ul class="botones">
                                <?=$reporteCorrectivo->getTipoMantenimientoReporte()?>
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
                                <?=$reporteCorrectivo->getTipoFallaListaReporte()?>
                                <li><div class="subrayar">&nbsp;&nbsp;&nbsp;<?=$reporteCorrectivo->getOtraFalla()?></div></li>
                            </ul>
                        </td>
                    </tr>
                </table>
                <table class="problema">
                    <tr>
                        <th>&nbsp;&nbsp;PROBLEMA PRESENTADO:</th>
                        <td>&nbsp;&nbsp;<?=$reporteCorrectivo->getProblemaPresentado()?></td>
                    </tr>
                </table>
                <div class="subTitulo">ACTIVIDADES</div>
                <table class="actividades">
                    <tr>
                        <td rowspan="2" style="border-bottom-left-radius: 8px;border-top-left-radius: 8px">
                            <ul class="checks">
                                <?=$reporteCorrectivo->getPruebaInicialReporte()?>
                                <?=$reporteCorrectivo->getSistemaOpticoReporte()?>
                                <?=$reporteCorrectivo->getAspectoFisicoReporte()?>
                                <?=$reporteCorrectivo->getSistemaElectromecanicoReporte()?>
                                <?=$reporteCorrectivo->getCondicionAmbientalReporte()?>
                                <?=$reporteCorrectivo->getSistemaVaporReporte()?>
                                <?=$reporteCorrectivo->getSistemaElectronicoReporte()?>
                                <?=$reporteCorrectivo->getSistemaOperativoReporte()?>
                                <?=$reporteCorrectivo->getSistemaHidraulicoReporte()?>
                                <?=$reporteCorrectivo->getLimpiezaInternaReporte()?>
                                <?=$reporteCorrectivo->getSistemaNeumaticoReporte()?>
                                <?=$reporteCorrectivo->getLimpiezaExternaReporte()?>
                                <?=$reporteCorrectivo->getSistemaMecanicoReporte()?>                                
                                <?=$reporteCorrectivo->getLubricacionPartesReporte()?>
                                <?=$reporteCorrectivo->getSistemaElectricoReporte()?>
                                <?=$reporteCorrectivo->getPruebasFuncionamientoReporte()?>
                            </ul>
                        </td>
                        <th class="bordeSuperiorDerecho">Rutina de Mantenimiento</th>
                    </tr>
                    <tr>
                        <td class="bordeInferiorDerecho" style="width: 170px;font-size: 10px;border-left: 1px solid #000;"><?=$reporteCorrectivo->getEquipo()->getTipoEquipo()->getRutinaLista()?></td>
                    </tr>
                </table>
                <div class="subTitulo">VERIFICACIÓN METROLÓGICA</div>
                <table class="datosMetrologicos">
                    <tr>
                        <th class="bordeSuperiorIzquierdo" style="border-right: 1px solid #000;">Valor Nominal</th>
                        <th class="bordeSuperiorDerecho">Valor Medido</th>
                    </tr>
                    <?=$listaMetrologica?>
                </table>
                <div class="subTitulo">REPUESTOS UTILIZADOS</div>
                <table class="repuestos">
                    <tr>
                        <th class="bordeSuperiorIzquierdo">Detalle</th>
                        <th style="border-left: 1px solid #000; border-right: 1px solid #000;">Referencia</th>
                        <th class="bordeSuperiorDerecho">Cantidad</th>
                    </tr>
                    <?=$listaRepuestos?>
                </table>
                <div class="subTitulo">OBSERVACIONES</div>
                <table class="observaciones">
                    <tr>
                        <th><ul><li>&nbsp;&nbsp;EL EQUIPO FUNCIONA CORRECTAMENTE:</li><?=$reporteCorrectivo->getFuncionamientoCorrectoReporte()?></ul></th>
                    </tr>
                    <tr>
                        <td valign="top">
                            <p>
                                <?=$reporteCorrectivo->getObservaciones()?>
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
                    www.laboratoriobiometrical.com</p>
                   
                    <img src="../../../presentacion/imagenes/biometricalEscalaGrises.png" height="30px">
                    <div style="width: 100%;height: 20px;text-align: initial;font-size: 7px;margin-top: 20px">DOCUMENTO CONTROLADO, PROHIBIDA SU REPRODUCCIÓN PARCIAL O TOTAL SIN AUTORIZACIÓN. V.03</div>
                    
                </div>
            </div>
        </div>
            
    </body>
</html>
<script>
    function imprimir(){
        window.print()
    }
</script>