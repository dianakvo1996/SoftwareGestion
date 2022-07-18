<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalibracion/ClienteC.php';
require_once dirname(__FILE__) . '/../../../clasesCalibracion/CronogramaC.php';
require_once dirname(__FILE__) . '/../../../clasesCalibracion/EquipoC.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Mes.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/ConectorBD.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

date_default_timezone_set('America/bogota');
$cliente=new Cliente('nit',"'".$nitCliente."'");

$cronograma=new CronogramaC('nitCliente',"'".$nitCliente."'");
$datos= EquipoC::getDatosEnObjetos("nitCliente='$nitCliente'",'ubicacion,nombreequipo asc');
$lista='';
//lista meeses
$meses= Mes::getDatosEnObjetos(null, null);
$mes='';
$semanas='';
$semanas2='';
    for ($j = 0; $j < 12 ; $j++) {
       $objMes=$meses[$j];
       $mes.="<th colspan='4'>{$objMes->getNombre()}</th>";
       $semanas.="<th class='marcar'>I</th><th class='marcar'>II</th><th class='marcar'>III</th><th class='marcar'>IV</th>";               
       switch ($objMes->getIde()) {
           case $cronograma->getCalculo()[0]:               
//                $semanas2.="<th class='cambio'></th><th class='cambio'></th><th class='cambio'></th><th class='cambio'></th>";
               $semanas2.=$cronograma->getValidarCalibracion($cronograma->getCalculo()[0],$cronograma->getIde());
               break;
           case $cronograma->getCalculo()[1]:
//                $semanas2.="<th class='cambio'></th><th class='cambio'></th><th class='cambio'></th><th class='cambio'></th>";
               $semanas2.=$cronograma->getValidarCalibracion($cronograma->getCalculo()[1],$cronograma->getIde());
               break;
           case $cronograma->getCalculo()[2]:
//                $semanas2.="<th class='cambio'></th><th class='cambio'></th><th class='cambio'></th><th class='cambio'></th>";
               $semanas2.=$cronograma->getValidarCalibracion($cronograma->getCalculo()[2],$cronograma->getIde());
               break;
           case $cronograma->getCalculo()[3]:
//                $semanas2.="<th class='cambio'></th><th class='cambio'></th><th class='cambio'></th><th class='cambio'></th>";
               $semanas2.=$cronograma->getValidarCalibracion($cronograma->getCalculo()[3],$cronograma->getIde());
               break;
           case $cronograma->getCalculo()[4]:
//                $semanas2.="<th class='cambio'></th><th class='cambio'></th><th class='cambio'></th><th class='cambio'></th>";
               $semanas2.=$cronograma->getValidarCalibracion($cronograma->getCalculo()[4],$cronograma->getIde());
               break;
           case $cronograma->getCalculo()[5]:
//                $semanas2.="<th class='cambio'></th><th class='cambio'></th><th class='cambio'></th><th class='cambio'></th>";
               $semanas2.=$cronograma->getValidarCalibracion($cronograma->getCalculo()[5],$cronograma->getIde());
               break;
           default:
               $semanas2.="<td></td><td></td><td></td><td></td>";
               break;
       }       
    }       
// fin lista meses
//lista equipos
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<td>{$objeto->getActivoFijo()}</td>";
    $lista.="<td>{$objeto->getNombreEquipo()}</td>";
    $lista.="<td>{$objeto->getMarca()}</td>";
    $lista.="<td>{$objeto->getModelo()}</td>";
    $lista.="<td>{$objeto->getSerial()}</td>"; 
    $lista.="<td>{$objeto->getUbicacion()}</td>";
    $lista.=$semanas2;    
    $lista.='</tr>';
}
//fin lista equipos
?>
<a href="principal.php?CONTENIDO=calibracion/administrador/equiposCliente.php&nitCliente=<?=$cliente->getNit()?>" style="float: left"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="listados">
    <img src="../presentacion/iconos/cronogramaCalibracion.png" height="100px">
    <table style="">
        <tr>
            <th>Cliente</th><td><?=$cliente->getNombre()?></td><td colspan="2"></td>
            <th>
                <a href="calibracion/administrador/exportarCronogramaCalibracionClienteExcel.php?nitCliente=<?=$nitCliente?>"><img src="../presentacion/iconos/exportarExcel.png" height="30px" title="Exportar Excel"></a>
                 
            </th>
        </tr>
        <tr>
            <th>Perioricidad</th><td><?=$cronograma->getPerioricidadLista()?></td>
            <th>Mes</th><td><?=$cronograma->getMesLista()?></td><td><a href="principal.php?CONTENIDO=calibracion/administrador/calibracionClienteFormulario.php&ideCronograma=<?=$cronograma->getIde()?>" class="enlace">Agregar Calibración</a></td>          
        </tr>
        
        <tr>
            <th>Fecha de Vigencia</th><th>Inicio</th><td>01/01/<?= date('Y')?></td><th>Fin</th><td>31/12/<?= date('Y')?></td>
        </tr>
    </table>
</div>
<div id="cronograma">
    <center>
    <table>
        <tr>
            <th rowspan="2">ACTIVO FÍJO</th>
            <th rowspan="2">EQUIPO</th>
            <th rowspan="2">MARCA</th>
            <th rowspan="2">MODELO</th>
            <th rowspan="2">SERIAL</th>   
            <th rowspan="2">UBICACIÓN</th>
            <?=$mes?>
        </tr>
        <tr>
            <?=$semanas?>
        </tr>
        <?=$lista?>
    </table>
    </center>
</div>