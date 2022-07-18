<?php
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/ReportePreventivo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/MantenimientoPreventivo.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$mantenimiento=new MantenimientoPreventivo('ide', $ide);

$equipos= Equipo::getDatosEnObjetos("nitCliente='{$mantenimiento->getNitCliente()}'", 'ubicacion,nombreequipo asc');
$lista='';
$item=1;
for ($i = 0; $i < count($equipos); $i++) {
    $objeto=$equipos[$i];
    $lista.='<tr>';
    $lista.="<td>{$item}</td>";
    $lista.="<td>{$objeto->getActivoFijo()}</td>";
    $lista.="<td>{$objeto->getNombreEquipo()}</td>";
    $lista.="<td>{$objeto->getMarca()}</td>";
    $lista.="<td>{$objeto->getModelo()}</td>";
    $lista.="<td>{$objeto->getSerial()}</td>";
    $lista.="<td>{$objeto->getUbicacion()}</td>";
    $numeroReporte= ReportePreventivo::getBuscarReporte($mantenimiento->getIde(), $objeto->getIde());
    if ($numeroReporte!=null) {
	//$lista.="<td><a onclick='abrirModal({$numeroReporte})' style='background:#0C5808;color:#fff' class='enlace'>Ver Reporte</a></td>";
        $lista.="<td><a href='mantenimiento/administrador/verReportePreventivo.php?numeroReporte={$numeroReporte}' style='background:#0C5808;color:#fff' class='enlace'>Ver Reporte</a></td>";
    } else {
        $lista.="<td><a href='principal.php?CONTENIDO=mantenimiento/administrador/reporteMantenimientoPreventivo.php&ideMantenimiento={$mantenimiento->getIde()}&ideEquipo={$objeto->getIde()}&accion=Guardar' style='background:#C8C52B' class='enlace'>Generar Reporte</a></td>";
    }   
    $lista.='</tr>';
    $item++;
}
?>
<a href="principal.php?CONTENIDO=mantenimiento/administrador/mantenimientoPreventivoCliente.php&nitCliente=<?=$mantenimiento->getNitCliente()?>"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="listados">
    <h2>Reportes Mantenimiento Preventivo</h2>
    <table>
        <tr>
            <th>Cliente:</th>
            <td><?=$mantenimiento->getCliente()->getNombre()?></td>
        </tr>
    </table>
    <table>
        <tr>
            <th colspan="2">ACTIVO FIJO</th>
            <th>EQUIPO</th>
            <th>MARCA</th>
            <th>MODELO</th>
            <th>SERIE</th>
            <th>UBICACIÓN</th>
            <th>ESTADO</th>
        </tr>
        <?=$lista?>
    </table>
</div>
<script>
    function abrirModal(numeroReporte){
        window.open('mantenimiento/administrador/verReportePreventivo.php?numeroReporte='+numeroReporte,'nombre_ventana','width=850px;,height=690px,menubar=no,resizable=0,location=0')
    }
</script>