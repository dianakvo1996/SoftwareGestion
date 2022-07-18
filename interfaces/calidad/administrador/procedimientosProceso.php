<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/Proceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/OpcionesProceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/ProcedimientosProceso.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable => $Valor) ${$Variable} = $Valor;

$datosOpciones=new OpcionesProceso("ide", $ideOpcion);
$carpeta= str_replace(' ','_',$datosOpciones->getProcesoEnObjeto()->getNombre());

$datos= ProcedimientosProceso::getDatosEnObjetos("ideOpcionesProceso=".$ideOpcion, null);
$lista='';

for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<td>{$objeto->getNombre()}</td>";
    $lista.="<td>{$objeto->getRuta()}</td>";
    $lista.="<td><a href='../ArchivosProcesos/{$carpeta}/Procedimientos/{$objeto->getRuta()}'target='_blank'><img src='../presentacion/iconos/pdf.png' height='50px'></a></td>";  
    $lista.="<td><a href='principal.php?CONTENIDO=calidad/administrador/procedimientosProcesoFormulario.php&accion=Modificar&codigo={$objeto->getCodigo()}&ideOpcion={$datosOpciones->getIde()}'><img src='../presentacion/iconos/modificar.png' height='50px'></a>";
    $lista.="<img src='../presentacion/iconos/eliminar.png' onclick='eliminar({$objeto->getCodigo()}," . '"' . "{$objeto->getRuta()}" . '"' . "," . '"' . "{$_SESSION['usuario']}" . '"' . ")' height='50px'></td>";
    $lista.='</tr>';
}
?>
<a href="principal.php?CONTENIDO=calidad/administrador/opcionesProceso.php&ideProceso=<?=$datosOpciones->getIdeProceso()?>"><img src="../presentacion/iconos/atras.png" title="Atras" height="50px" style="float: left"></a>
<div id="listados">
    <img src="../presentacion/iconos/procedimientos.png" height="90px" title="Procedimientos" style="opacity: 0.8">    
    <h3>GESTIÓN DE PROCEDIMIENTOS <?= strtoupper($datosOpciones->getProcesoEnObjeto()->getNombre())?></h3>
    <h3><?=$datosOpciones->getNombre()?></h3>
    <table>
        <tr>
            <th>NOMBRE</th>
            <th>ARCHIVO</th>
            <th>TIPO</th>
            <th colspan="2">
                <a href="principal.php?CONTENIDO=calidad/administrador/procedimientosProcesoFormulario.php&accion=Adicionar&ideOpcion=<?=$datosOpciones->getIde()?>">
                    <img src="../presentacion/iconos/addProcedimiento.png" height="60px" title="Adicionar">
                </a>
            </th>
        </tr>
            <?=$lista?>
    </table>
</div>
<script>
    function eliminar(codigo,rutaAnterior,usuarioActual) {
        if(confirm("¿Realmente desea eliminar este Registro?")){
            location = 'calidad/administrador/procedimientosProcesoActualizar.php?accion=Eliminar&codigo='+codigo+'&rutaAnterior='+rutaAnterior+'&ideOpcion='+<?=$datosOpciones->getIde()?>+'&usuarioActual='+usuarioActual;
         }
    }
</script>