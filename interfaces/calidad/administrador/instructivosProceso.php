<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/Proceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/InstructivosProceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/OpcionesProceso.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable => $Valor) ${$Variable} = $Valor;

$datosOpciones=new OpcionesProceso("ide", $ideOpcion);

$carpeta= str_replace(' ','_',$datosOpciones->getProcesoEnObjeto()->getNombre());

$datos= InstructivosProceso::getDatosEnObjetos("ideOpcionesProceso=".$ideOpcion, null);
$lista='';
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<td>{$objeto->getNombre()}</td>";
    $lista.="<td>{$objeto->getRuta()}</td>";
    $lista.="<td><a href='../ArchivosProcesos/{$carpeta}/Instructivos/{$objeto->getRuta()} 'target='_blank'><img src='../presentacion/iconos/pdf.png' title='Descargar' height='50px'></a></td>";
    $lista.="<td><a href='principal.php?CONTENIDO=calidad/administrador/instructivosProcesoFormulario.php&accion=Modificar&codigo={$objeto->getCodigo()}&ideOpcion={$datosOpciones->getIde()}'><img src='../presentacion/iconos/modificar.png' title='Modificar' height='50px'></a>";
    $lista.="<img src='../presentacion/iconos/eliminar.png' title='Eliminar' onclick='eliminar({$objeto->getCodigo()}," . '"' . "{$objeto->getRuta()}" . '"' . "," . '"' . "{$_SESSION['usuario']}" . '"' . ")' height='50px'></td>";
    $lista.='</tr>';  
}
?>
<a href="principal.php?CONTENIDO=calidad/administrador/opcionesProceso.php&ideProceso=<?=$datosOpciones->getIdeProceso()?>"><img src="../presentacion/iconos/atras.png" title="Atras" height="50px" style="float: left"></a>
<div id="listados">
    <img src="../presentacion/iconos/instructivos.png" title="Instructivos" height="90px" style="opacity: 0.8">
    <h3>GESTIÓN DE INSTRUCTIVOS <?= strtoupper($datosOpciones->getProcesoEnObjeto()->getNombre())?></h3>
    <h3><?=$datosOpciones->getNombre()?></h3>
    <table>
        <tr>
            <th>NOMBRE</th>
            <th>ARCHIVO</th>
            <th>TIPO</th>
            <th colspan="2">
                <a href="principal.php?CONTENIDO=calidad/administrador/instructivosProcesoFormulario.php&accion=Adicionar&ideOpcion=<?=$datosOpciones->getIde()?>">
                    <img src="../presentacion/iconos/addInstructivo.png" height="60px" title="Adicionar">
                </a>
            </th>
        </tr>
            <?=$lista?>
    </table>
</div>
<script>
    function eliminar(codigo,rutaAnterior,usuarioActual) {
        if(confirm("¿Realmente desea eliminar este Registro?")){
            location = 'calidad/administrador/instructivosProcesoActualizar.php?accion=Eliminar&codigo='+codigo+'&rutaAnterior='+rutaAnterior+'&ideOpcion='+<?=$datosOpciones->getIde()?>+"&usuarioActual="+usuarioActual;
         }
    }
</script>