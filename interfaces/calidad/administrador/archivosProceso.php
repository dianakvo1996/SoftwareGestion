<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../clases/Proceso.php';
require_once dirname(__FILE__) . '/../../clases/ArchivosProceso.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable => $Valor) ${$Variable} = $Valor;

$datosProceso=new Proceso("ide",$ideProceso);
$carpeta= str_replace(' ','_',$datosProceso->getNombre());

$datos= ArchivosProceso::getDatosEnObjetos("ideProceso=".$datosProceso->getIde(), null);
$lista='';
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<td>{$objeto->getNombre()}</td>";
    $lista.="<td>{$objeto->getRuta()}</td>";
    $lista.="<td><a href='../ArchivosProcesos/{$carpeta}/{$objeto->getRuta()}' target='_blank'><img src='../presentacion/iconos/pdf.png' height='50px'></a></td>";
    $lista.="<td><a href='principal.php?CONTENIDO=administrador/archivosProcesoFormulario.php&accion=Modificar&ideProceso={$ideProceso}&codigo={$objeto->getCodigo()}'><img src='../presentacion/iconos/modificar.png'  height='50px'></a>";
    $lista.="<img src='../presentacion/iconos/eliminar.png' onclick='eliminar({$objeto->getCodigo()}," . '"' . "{$objeto->getRuta()}" . '"' . ")' height='50px'></td>";
    $lista.='</tr>';
}
?>
<a href="principal.php?CONTENIDO=administrador/procesos.php"><img src="../presentacion/iconos/atras.png" title="Volver" height="50px"></a>
<div id="listados">
    <h3>GESTIÓN FORMATOS <?= strtoupper($datosProceso->getNombre())?></h3>
    <table>
        <tr>
            <th>NOMBRE</th>
            <th>RUTA</th>
            <th>TIPO</th>
            <th colspan="2">
                <a href="principal.php?CONTENIDO=administrador/archivosProcesoFormulario.php&accion=Adicionar&ideProceso=<?=$ideProceso?>">
                    <img src="../presentacion/iconos/addFormato.png" height="60px" title="Adicionar">
                </a>
            </th>
        </tr>
            <?=$lista?>
    </table>
</div>
<script>
    function eliminar(codigo,rutaAnterior) {
        if(confirm("¿Realmente desea eliminar este Registro?")){
            location = 'administrador/archivosProcesoActualizar.php?accion=Eliminar&codigo='+codigo+'&ideProceso='+<?=$ideProceso?>+'&rutaAnterior='+rutaAnterior;
         }
    }
</script>
