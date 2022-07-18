<?php
require_once dirname(__FILE__) . '/../../../clasesCalibracion/ClienteC.php';
require_once dirname(__FILE__) . '/../../../clasesCalibracion/SedeC.php';
require_once dirname(__FILE__) . '/../../../clasesCalibracion/CronogramaC.php';
require_once dirname(__FILE__) . '/../../../clasesCalibracion/EquipoC.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Mes.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/ConectorBD.php';


foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

date_default_timezone_set('America/bogota');
$sede=new SedeC('ide', $ideSede);
//$cliente=new Cliente('nit',"'".$sede->getNitCliente()."'");

$nombreDescarga="Cronograma Calibracion-{$sede->getCliente()->getNombre()}_{$sede->getNombre()}_".date('Y-m-d_His');
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename='.$nombreDescarga.'.xls');

$cronograma=new CronogramaC('ideSede',$ideSede);

$datos= EquipoC::getDatosEnObjetos("ideSede=$ideSede",'nombreEquipo');
$lista='';
//lista meeses
$meses= Mes::getDatosEnObjetos(null, null);
$mes='';
$semanas='';
$semanas2='';
    for ($j = 0; $j < 12 ; $j++) {
       $objMes=$meses[$j];
       $mes.="<th colspan='4'rowspan='3' style='background-color: #7FE98D'>{$objMes->getNombre()}</th>";
       $semanas.="<th style='background-color: #7FE98D'>I</th><th style='background-color: #7FE98D'>II</th><th style='background-color: #7FE98D'>III</th><th style='background-color: #7FE98D'>IV</th>";               
       switch ($objMes->getIde()) {
           case $cronograma->getCalculo()[0]:
                $semanas2.="<th style='background-color: #073061'></th><th style='background-color: #073061'></th><th style='background-color: #073061'></th><th style='background-color: #073061'></th>";
               break;
           case $cronograma->getCalculo()[1]:
                $semanas2.="<th style='background-color: #073061'></th><th style='background-color: #073061'></th><th style='background-color: #073061'></th><th style='background-color: #073061'></th>";
               break;
           case $cronograma->getCalculo()[2]:
                $semanas2.="<th style='background-color: #073061'></th><th style='background-color: #073061'></th><th style='background-color: #073061'></th><th style='background-color: #073061'></th>";
               break;
           case $cronograma->getCalculo()[3]:
                $semanas2.="<th style='background-color: #073061'></th><th style='background-color: #073061'></th><th style='background-color: #073061'></th><th style='background-color: #073061'></th>";
               break;
           case $cronograma->getCalculo()[4]:
                $semanas2.="<th style='background-color: #073061'></th><th style='background-color: #073061'></th><th style='background-color: #073061'></th><th style='background-color: #073061'></th>";
               break;
           case $cronograma->getCalculo()[5]:
                $semanas2.="<th style='background-color: #073061'></th><th style='background-color: #073061'></th><th style='background-color: #073061'></th><th style='background-color: #073061'></th>";
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
    $lista.="<td style='text-align: center'>{$objeto->getActivoFijo()}</td>";
    $lista.="<td style='text-align: center'>{$objeto->getNombreEquipo()}</td>";
    $lista.="<td style='text-align: center'>{$objeto->getMarca()}</td>";
    $lista.="<td style='text-align: center'>{$objeto->getModelo()}</td>";
    $lista.="<td style='text-align: center'>{$objeto->getSerial()}</td>"; 
    $lista.="<td style='text-align: center'>{$objeto->getUbicacion()}</td>";
    $lista.="<td style='text-align: center'>BIOMETRICAL</td>";
    $lista.="<td>{$cronograma->getPerioricidadLista()}</td>";
    $lista.=$semanas2;
    $item++;
    $lista.='</tr>';
    
}
//fin lista equipos
?>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<table border="1">
    <tr>
        <th colspan="6" rowspan="4"><img src="http://laboratoriobiometrical.com.co/SoftwareGestion/presentacion/imagenes/Biometrical_Miniatura.png" width="50px"></th>
        <th colspan="20" rowspan="4">CRONOGRAMA</th>
        <th colspan="16">CODIGO</th>
        <th colspan="15">VERSION</th>
    </tr>
    <tr>
        <td style="text-align: center;border-bottom: none" colspan="16">F-O-M-LC-08</td>
        <td style="text-align: center" colspan="15">&nbsp;01</td>
    </tr>
    <tr>
        <th colspan="31">FECHA VIGENCIA</th>
    </tr>
    <tr>
        <td style="text-align: center" colspan="31">19/01/2017</td>
    </tr>
    <tr>
        <th style="height: 5px" colspan="57"></th>
    </tr>
    <tr>
        <th colspan="2" style="background-color: #9FC6F3">EMPRESA:</th>
        <th colspan="4"><?=$sede->getCliente()->getNombre()?>-<?=$sede->getNombre()?></th>
        <th style="background-color: #9FC6F3">CODIGO:</th>
        <th colspan="2">MTT-CMS-19</th>
        <?=$mes?>
    </tr>
    <tr>
        <th colspan="3" style="background-color: #9FC6F3">FECHA VIGENCIA</th>
        <th style="background-color: #BBC3CA">INICIO:</th>
        <th colspan="2">01/01/<?= date('Y')?></th>
        <th style="background-color: #BBC3CA">FIN:</th>
        <th colspan="2">31/12/<?= date('Y')?></th>
    </tr>
    <tr>
        <th colspan="3" style="background-color: #9FC6F3">TIPO:</th>
        <th colspan="2" style="background-color: #BBC3CA">CALIBRACION:</th>
        <th style="text-align: center">X</th>
        <th colspan="2" style="background-color: #BBC3CA">MANTENIMIENTO:</th>
        <th></th>
    </tr>
    <tr>
        <th style="background-color: #BBC3CA; height: 40px">ITEM</th>
        <th style="background-color: #BBC3CA">CODIGO ACTIVO FIJO</th>
        <th style="background-color: #BBC3CA">EQUIPO</th>
        <th style="background-color: #BBC3CA">MARCA</th>
        <th style="background-color: #BBC3CA">MODELO</th>
        <th style="background-color: #BBC3CA">SERIE</th>
        <th style="background-color: #BBC3CA">AREA</th>
        <th style="background-color: #BBC3CA">RESPONSABLE</th>
        <th style="background-color: #9FC6F3">FRECUANCIA</th>
        <?=$semanas?>
    </tr>
    <?=$lista?>
</table>
