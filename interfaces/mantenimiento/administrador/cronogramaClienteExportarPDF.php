<?php
require_once dirname(__FILE__) . '/../../../librerias/dompdf/autoload.inc.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cronograma.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Mes.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

date_default_timezone_set('America/bogota');
$cliente=new Cliente('nit',"'".$nit."'");

$cronograma=new Cronograma('nitCliente',"'".$nit."'");

$datos= Equipo::getDatosEnObjetos("nitCliente='$nit'",null );
$lista='';
//lista meeses
$meses= Mes::getDatosEnObjetos(null, null);
$mes='';
$semanas='';
$semanas2='';
    for ($j = 0; $j < 12 ; $j++) {
       $objMes=$meses[$j];
       $mes.="<th colspan='4'rowspan='3' style='text-align: center;background-color: #7FE98D;'>{$objMes->getNombre()}</th>";
       $semanas.="<th style='text-align: center;background-color: #7FE98D'>I</th><th style='text-align: center;background-color: #7FE98D'>II</th><th style='text-align: center;background-color: #7FE98D'>III</th><th style='text-align: center;background-color: #7FE98D'>IV</th>";               
       switch ($objMes->getIde()) {
           case $cronograma->getCalculo()[0]:
                $semanas2.="<th style='text-align: center;background-color: #073061'></th><th style='text-align: center;background-color: #073061'></th><th style='text-align: center;background-color: #073061'></th><th style='text-align: center;background-color: #073061'></th>";
               break;
           case $cronograma->getCalculo()[1]:
                $semanas2.="<th style='text-align: center;background-color: #073061'></th><th style='text-align: center;background-color: #073061'></th><th style='background-color: #073061'></th><th style='background-color: #073061'></th>";
               break;
           case $cronograma->getCalculo()[2]:
                $semanas2.="<th style='text-align: center;background-color: #073061'></th><th style='text-align: center;background-color: #073061'></th><th style='background-color: #073061'></th><th style='background-color: #073061'></th>";
               break;
           case $cronograma->getCalculo()[3]:
                $semanas2.="<th style='text-align: center;background-color: #073061'></th><th style='text-align: center;background-color: #073061'></th><th style='background-color: #073061'></th><th style='background-color: #073061'></th>";
               break;
           case $cronograma->getCalculo()[4]:
                $semanas2.="<th style='text-align: center;background-color: #073061'></th><th style='text-align: center;background-color: #073061'></th><th style='background-color: #073061'></th><th style='background-color: #073061'></th>";
               break;
           case $cronograma->getCalculo()[5]:
                $semanas2.="<th style='text-align: center;background-color: #073061'></th><th style='text-align: center;background-color: #073061'></th><th style='background-color: #073061'></th><th style='background-color: #073061'></th>";
               break;
           default:
               $semanas2.="<td></td><td></td><td></td><td></td>";
               break;
       }       
    }       
//lista meses
//lista equipos
$item=1;
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<th>{$item}</th>";
    $lista.="<td>{$objeto->getActivoFijo()}</td>";
    $lista.="<td>{$objeto->getNombreEquipo()}</td>";
    $lista.="<td>{$objeto->getMarca()}</td>";
    $lista.="<td>{$objeto->getModelo()}</td>";
    $lista.="<td>{$objeto->getSerial()}</td>"; 
    $lista.="<td>{$objeto->getUbicacion()}</td>";
    $lista.="<td>BIOMETRICAL</td>";
    $lista.="<td>{$cronograma->getPerioricidadLista()}</td>";
    $lista.=$semanas2;
    $item++;
    $lista.='</tr>';
    
}
//fin lista equipos

$reporte='<table border="1" cellpadding="0" cellspacing="0" style="font-family: DejaVu Sans;margin:auto;font-size:11px;margin-top:50px">';
$reporte.='<tr>';
$reporte.='<th colspan="6" rowspan="4" style="text-align: center;"><img src="file:///D:/Programas/wamp64/www/LaboratorioBiometrical/presentacion/imagenes/Biometrical_Miniatura.png" width="150px"></th>';
$reporte.='<th colspan="20" rowspan="4" style="text-align: center;font-size:20px">CRONOGRAMA</th>';
$reporte.='<th colspan="16" style="text-align: center;">CODIGO</th>';
$reporte.='<th colspan="15" style="text-align: center;">VERSION</th>';
$reporte.='</tr>';
$reporte.='<tr>';
$reporte.='<td style="text-align: center;border-bottom: none" colspan="16">F-O-M-LC-08</td>';
$reporte.='<td style="text-align: center" colspan="15">&nbsp;01</td>';
$reporte.='</tr>';
$reporte.='<tr>';
$reporte.='<th colspan="31" style="text-align: center;">FECHA VIGENCIA</th>';
$reporte.='</tr>';
$reporte.='<tr>';
$reporte.='<td style="text-align: center" colspan="31">19/01/2017</td>';
$reporte.='</tr>';
$reporte.='<tr>';
$reporte.='<th style="height: 5px" colspan="57"></th>';
$reporte.='</tr>';
$reporte.='<tr>';
$reporte.='<th colspan="2" style="background-color: #9FC6F3;text-align: center;">EMPRESA:</th>';
$reporte.='<th colspan="4" style="text-align: center;">'.$cliente->getNombre().'</th>';
$reporte.='<th style="text-align: center;background-color: #9FC6F3">CODIGO:</th>';
$reporte.='<th colspan="2" style="text-align: center;">MTT-CMS-19</th>';
$reporte.=$mes;
$reporte.='</tr>';
$reporte.='<tr>';
$reporte.='<th colspan="3" style="text-align: center;background-color: #9FC6F3">FECHA VIGENCIA</th>';
$reporte.='<th style="text-align: center;background-color: #BBC3CA">INICIO:</th>';
$reporte.='<th colspan="2" style="text-align: center;">01/01/'.date('Y').'</th>';
$reporte.='<th style="text-align: center;background-color: #BBC3CA">FIN:</th>';
$reporte.='<th colspan="2" style="text-align: center;">31/12/'.date('Y').'</th>';
$reporte.='</tr>';
$reporte.='<tr>';
$reporte.='<th colspan="3" style="text-align: center;background-color: #9FC6F3">TIPO:</th>';
$reporte.='<th colspan="2" style="text-align: center;background-color: #BBC3CA">CALIBRACION:</th>';
$reporte.='<th></th>';
$reporte.='<th colspan="2" style="text-align: center;background-color: #BBC3CA">MANTENIMIENTO:</th>';
$reporte.='<th style="text-align: center;">X</th>';
$reporte.='</tr>';
$reporte.='<tr>';
$reporte.='<th style="text-align: center;background-color: #BBC3CA; height: 40px">ITEM</th>';
$reporte.='<th style="text-align: center;background-color: #BBC3CA">CODIGO ACTIVO FIJO</th>';
$reporte.='<th style="text-align: center;background-color: #BBC3CA">EQUIPO</th>';
$reporte.='<th style="text-align: center;background-color: #BBC3CA">MARCA</th>';
$reporte.='<th style="text-align: center;background-color: #BBC3CA">MODELO</th>';
$reporte.='<th style="text-align: center;background-color: #BBC3CA">SERIE</th>';
$reporte.='<th style="text-align: center;background-color: #BBC3CA">AREA</th>';
$reporte.='<th style="text-align: center;background-color: #BBC3CA">RESPONSABLE</th>';
$reporte.='<th style="text-align: center;background-color: #9FC6F3">FRECUANCIA</th>';
$reporte.=$semanas;
$reporte.='</tr>';
$reporte.=$lista;
$reporte.='</table>';

$dompdf=new Dompdf\DOMPDF();
$dompdf->set_paper('A4','landscape');
$dompdf->set_option('dpi', 150);
$dompdf->load_html($reporte);
ini_set("memory_limit", "512M");
$dompdf->render();
$fecha= "_".date('Y-m-d_His');
$dompdf->stream("Cronograma Mantenimineto_".$cliente->getNombre().$fecha.".pdf",array('enable_remote' => true));