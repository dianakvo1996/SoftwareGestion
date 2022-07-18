<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/OpcionesProceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/SubMenuProceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/Proceso.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable => $Valor) ${$Variable} = $Valor;
$proceso=new Proceso("ide", $ideProceso);

$datos= OpcionesProceso::getDatosEnObjetos("ideProceso=$ideProceso", "nombre");
$lista='';
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<td>{$objeto->getNombre()}</td>";
    $lista.="<th>";
    $datosSubmenu= SubMenuProceso::getDatosEnObjetos("ideOpcion={$objeto->getIde()}", null);
    for ($j = 0; $j < count($datosSubmenu); $j++) {
        $objetoSubMenu=$datosSubmenu[$j];
        switch ($objetoSubMenu->getMenu()) {
            case 'PRO':
                $lista.="<a href='principal.php?CONTENIDO=calidad/administrador/procedimientosProceso.php&ideOpcion={$objeto->getIde()}' class='enlace'>Procedimientos</a>";
                break;
            case 'G':
                $lista.="<a href='principal.php?CONTENIDO=calidad/administrador/guiasProceso.php&ideOpcion={$objeto->getIde()}' class='enlace'>Guias</a>";
                break;
            case 'M':
                $lista.="<a href='principal.php?CONTENIDO=calidad/administrador/manualesProceso.php&ideOpcion={$objeto->getIde()}' class='enlace'>Manuales</a>";
                break;
            case 'P':
                $lista.="<a href='principal.php?CONTENIDO=calidad/administrador/protocolosProceso.php&ideOpcion={$objeto->getIde()}' class='enlace'>Protocolos</a>";
                break;
            case 'I':
                $lista.="<a href='principal.php?CONTENIDO=calidad/administrador/instructivosProceso.php&ideOpcion={$objeto->getIde()}' class='enlace'>Instructivos</a>";
                break;
            case 'F':
                $lista.="<a href='principal.php?CONTENIDO=calidad/administrador/formatosProceso.php&ideOpcion={$objeto->getIde()}' class='enlace'>Formatos</a>";
                break;
 
        }
    }
    $lista.="</th>";
    $lista.="<td><a href='principal.php?CONTENIDO=calidad/administrador/opcionesProcesoFormulario.php&accion=Modificar&ideProceso={$objeto->getIdeProceso()}&ideOpcion={$objeto->getIde()}'><img src='../presentacion/iconos/modificar.png' title='Modificar' height='50px'></a>";
    $lista.="<img src='../presentacion/iconos/eliminar.png' title='eliminar' onclick='eliminar({$objeto->getIde()}, " . '"' . "{$_SESSION['usuario']} " . '"' . ")' height='50px'></td>";
    $lista.='</tr>';
}

?>
<a href="principal.php?CONTENIDO=calidad/administrador/procesos.php"><img src="../presentacion/iconos/atras.png" title="Volver" height="50px" style="float: left"></a>
<div id="listados">  
    <img src="../presentacion/iconos/opciones.png" title="Subprocesos" height="90px" style="opacity: 0.8">
    <h3 style="text-align: center">GESTIÓN DE SUBPROCESOS <?= strtoupper($proceso->getNombre())?></h3>
    
<table>
    <tr>
        <th>SUBPROCESO</th>
        <th>OPCIONES</th>
        <th>
            <a href="principal.php?CONTENIDO=calidad/administrador/opcionesProcesoFormulario.php&accion=Adicionar&ideProceso=<?=$ideProceso?>">
                <img src="../presentacion/iconos/addOpcion.png" title="Adicionar Subproceso" alt="Adicionar Subproceso" width="60px">
            </a>
        </th>
    </tr>
    <?=$lista?>
</table>
</div>
<script>
    function eliminar(ideOpcion,usuarioActual) {
        if (confirm("¿Realmente desea eliminar este registro?")) {
        location = 'calidad/administrador/opcionesProcesoActualizar.php?accion=Eliminar&ideOpcion='+ideOpcion+'&ideProceso='+<?=$ideProceso?>+'&usuarioActual='+usuarioActual;
        }
    }
</script>