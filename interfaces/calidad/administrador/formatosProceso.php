<?php

require_once dirname(__FILE__) . '/../../../clasesCalidad/Proceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/OpcionesProceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/FormatoProceso.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable => $Valor) ${$Variable} = $Valor;

$datosOpciones=new OpcionesProceso("ide", $ideOpcion);
$carpeta= str_replace(' ','_',$datosOpciones->getProcesoEnObjeto()->getNombre());

$datos= FormatoProceso::getDatosEnObjeto("ideOpcionesProceso=".$ideOpcion, "nombre");
$lista='';
for ($i = 0; $i < count($datos); $i++) {
   $objeto=$datos[$i];
   $tipoArchivo=$objeto->getTipo();
    $lista.='<tr>';
    $lista.="<td>{$objeto->getNombre()}</td>";
    $lista.="<td>{$objeto->mostrarFormato()}</td>";
    switch ($tipoArchivo) {
        case 'pdf':
            $lista.="<td><a href='../ArchivosProcesos/{$carpeta}/Formatos/{$objeto->getRuta()}'target='_blank'><img src='../presentacion/iconos/pdf.png' title='Descargar' height='50px'></a></td>";
        break;
        case 'doc':
            $lista.="<td><a href='../ArchivosProcesos/{$carpeta}/Formatos/{$objeto->getRuta()}'target='_blank'><img src='../presentacion/iconos/word.png' title='Descargar' height='50px'></a></td>";
        break;
        case 'docx':
            $lista.="<td><a href='../ArchivosProcesos/{$carpeta}/Formatos/{$objeto->getRuta()}'target='_blank'><img src='../presentacion/iconos/word.png' title='Descargar' height='50px'></a></td>";
        break;
        case 'xls':
            $lista.="<td><a href='../ArchivosProcesos/{$carpeta}/Formatos/{$objeto->getRuta()}'target='_blank'><img src='../presentacion/iconos/excel.png' title='Descargar' height='50px'></a></td>";
        break;
        case 'xlsx':
            $lista.="<td><a href='../ArchivosProcesos/{$carpeta}/Formatos/{$objeto->getRuta()}'target='_blank'><img src='../presentacion/iconos/excel.png' title='Descargar' height='50px'></a></td>";
        break;
        case 'pptx':
            $lista.="<td><a href='../ArchivosProcesos/{$carpeta}/Formatos/{$objeto->getRuta()}'target='_blank'><img src='../presentacion/iconos/powerPoint.png' title='Descargar' height='50px'></a></td>";
        break;
        case 'ppt':
            $lista.="<td><a href='../ArchivosProcesos/{$carpeta}/Formatos/{$objeto->getRuta()}'target='_blank'><img src='../presentacion/iconos/powerPoint.png' title='Descargar' height='50px'></a></td>";
        break;

    }
    $lista.="<td><a href='principal.php?CONTENIDO=calidad/administrador/formatosProcesoFormulario.php&accion=Modificar&codigo={$objeto->getCodigo()}&ideOpcion={$datosOpciones->getIde()}'><img src='../presentacion/iconos/modificar.png' height='50px'></a></td>";
    $lista.="<td><img src='../presentacion/iconos/eliminar.png' onclick='eliminar({$objeto->getCodigo()}," . '"' . "{$objeto->getRuta()}" . '"' . "," . '"' . "{$_SESSION['usuario']}" . '"' . ")' height='50px'></td>";
    $lista.='</tr>';
}
?>
<a href="principal.php?CONTENIDO=calidad/administrador/opcionesProceso.php&ideProceso=<?=$datosOpciones->getIdeProceso()?>"><img src="../presentacion/iconos/atras.png" title="Atras" height="50px" style="float: left"></a>
<div id="listados">
    <img src="../presentacion/iconos/formatos.png" title="Formatos" height="90px" style="opacity: 0.8">
    <h3>GESTIÓN DE FORMATOS <?= strtoupper($datosOpciones->getProcesoEnObjeto()->getNombre())?></h3>
    <h3><?=$datosOpciones->getNombre() ?></h3>
    <table>
        <tr>
            <th>NOMBRE</th>
            <th>RUTA</th>
            <th>TIPO</th>
            <th colspan="2">
                <a href="principal.php?CONTENIDO=calidad/administrador/formatosProcesoFormulario.php&accion=Adicionar&ideOpcion=<?=$datosOpciones->getIde()?>">
                    <img src="../presentacion/iconos/addFormato.png" height="60px" title="Adicionar">
                </a>
            </th>
        </tr>
            <?=$lista?>
    </table>
</div>
<script>
    function eliminar(codigo,rutaAnterior,usuarioActual) {
        if(confirm("¿Realmente desea eliminar este Registro?")){
            location = 'calidad/administrador/formatosProcesoActualizar.php?accion=Eliminar&codigo='+codigo+'&rutaAnterior='+rutaAnterior+'&ideOpcion='+<?=$datosOpciones->getIde()?>+'&usuarioActual='+usuarioActual;
         }
    }
</script>