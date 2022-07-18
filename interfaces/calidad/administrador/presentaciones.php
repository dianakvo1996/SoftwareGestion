<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/Presentacion.php';

$datos = Presentacion::getDatosEnObjetos(null, "nombre");
$lista ='';

for ($i= 0; $i< count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<td>{$objeto->getNombre()}</td>";
    $lista.="<td><a href='../ArchivosProcesos/Presentaciones/{$objeto->getPresentacion()}'><img src='../presentacion/iconos/presentacion.png' title='Descargar' height='80px'></a></td>";
    $lista.="<td><img src='../presentacion/iconos/eliminar.png' title='Eliminar'onclick='eliminar({$objeto->getCodigo()}," . '"' . "{$objeto->getPresentacion()}" . '"' . ")' height='50px'></td>";
    $lista.='</tr>';
}
?>
<a href="principal.php?CONTENIDO=calidad/administrador/inicio.php" ><img src="../presentacion/iconos/atras.png" title="Atras" height="40px" style="float: left"></a>
<div id="listados">
    <img src="../presentacion/iconos/presentaciones.png" title="Presentaciones" height="90px" style="opacity: 0.8">   
    <h3>GESTIÓN DE PRESENTACIONES</h3>
    <table>
        <tr>
            <th>NOMBRE</th>
            <th>TIPO</th>
            <th colspan="2">
                <a href="principal.php?CONTENIDO=calidad/administrador/presentacionFormulario.php&accion=Adicionar">
                    <img src="../presentacion/iconos/addPresentacion.png"  height="60px" title="Adicionar">
                </a>
            </th>
        </tr>
            <?=$lista?>
    </table>
</div>
<script>
    function eliminar(codigo,rutaAnterior) {
        if(confirm("¿Realmente desea eliminar este Registro?")){
            location = 'calidad/administrador/presentacionActualizar.php?accion=Eliminar&codigo='+codigo+'&ruta='+rutaAnterior;
         }
    }
</script>
