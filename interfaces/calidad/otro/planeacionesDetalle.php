<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../clases/Proceso.php';
require_once dirname(__FILE__) . '/../../clases/Permiso.php';
require_once dirname(__FILE__) . '/../../clases/PlaneacionesProceso.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$datosProceso=new Proceso("ide",$ideProceso);
$opcion=new OpcionesProceso("ide",$ideOpcion);

$datosPermiso= Permiso::getDatosEnObjeto("ideProceso=$ideProceso and usuario='".$_SESSION['usuario']."'", null);
$visualizador="visualizadorPDF.php";

for ($j = 0; $j < count($datosPermiso); $j++) {
    $objetoPermiso=$datosPermiso[$j];
    if ($objetoPermiso->getPermiso()=='SL') {
        $visualizador="visualizadorPDFBloqueado.php";
    }
}

$datos= PlaneacionesProceso::getDatosEnObjetos("ideProceso={$ideProceso} and ideOpcionesProceso=".$ideOpcion, "nombre");
$lista='';

for ($i = 0; $i < count($datos); $i++) {
   $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<td>{$objeto->getNombre()}</td>";
    $lista.="<td>{$objeto->mostrarFormato()}</td>";
    $lista.="<td><a href='principal.php?CONTENIDO=administrador/menuProceso.php&ideProceso={$ideProceso}&CONTENIDOINTERNO=administrador/{$visualizador}&ruta={$objeto->mostrarFormato()}'><img src='../presentacion/iconos/pdf.png' width='35px' height='40px' title='PDF'></a></td>";
    $lista.='</tr>';
}

?>
<div id="listados">
    <h3>PLANEACIONES <?= strtoupper($datosProceso->getNombre())?></h3>
    <h3><?=$opcion->getNombre() ?></h3>
    <table style="width: 100%; text-align: center">    
            <tr>
                <th>NOMBRE</th>
                <th>RUTA</th>
                <th>TIPO</th>
            </tr>
            <?=$lista?>
    </table>

</div>