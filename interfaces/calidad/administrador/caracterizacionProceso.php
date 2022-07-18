<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/Proceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/CaracterizacionProceso.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable => $Valor) ${$Variable} = $Valor;

$proceso=new Proceso("ide",$ideProceso);
$carpeta= str_replace(' ','_',$proceso->getNombre());

$datos= CaracterizacionProceso::getDatosEnObjetos("ideProceso=".$proceso->getIde(), null);
$lista='';
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<td>{$objeto->getNombre()}</td>";
    $lista.="<td>{$objeto->getRuta()}</td>";
    $lista.="<td><a href='../ArchivosProcesos/{$carpeta}/Caracterizacion/{$objeto->getRuta()}'target='_blank'><img src='../presentacion/iconos/pdf.png' height='50px'></a></td>";
    $lista.="<td><a href='principal.php?CONTENIDO=calidad/administrador/caracterizacionProcesoFormulario.php&accion=Modificar&ideProceso={$ideProceso}&codigo={$objeto->getCodigo()}'><img src='../presentacion/iconos/cambiar.png' title='Cambiar' height='60px'></a></td>";
    $lista.='</tr>';
}
?>
<a href="principal.php?CONTENIDO=calidad/administrador/procesos.php"><img src="../presentacion/iconos/atras.png" title="Atras" height="50px" style="float: left"></a>
<div id="listados">
    <img src="../presentacion/iconos/caracterizacion.png" title="Caracterizacion de Proceso" height="100px" style="opacity: 0.8">
    <h3>GESTIÓN DE CARACTERIZACIÓN DEL PROCESO <?= strtoupper($proceso->getNombre())?></h3>
    <table>
        <tr>
            <th>NOMBRE</th>
            <th>RUTA</th>
            <th>TIPO</th>
            <th colspan="2">
                OPCIONES
            </th>
        </tr>
            <?=$lista?>
    </table>
</div>
<script>
    function eliminar(codigo,rutaAnterior) {
        if(confirm("¿Realmente desea eliminar este Registro?")){
            location = 'calidad/administrador/caracterizacionProcesoActualizar.php?accion=Eliminar&codigo='+codigo+'&ideProceso='+<?=$ideProceso?>+'&rutaAnterior='+rutaAnterior;
         }
    }
</script>