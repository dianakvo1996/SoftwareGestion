<?php
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Sede.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/ReportePreventivo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/MantenimientoPreventivo.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$mantenimiento=new MantenimientoPreventivo('ide', $ide);

$nombreDescarga='Mantenimiento Preventivo-'. $mantenimiento->getSedeClase()->getNombre().'-'.$mantenimiento->getMostarFecha();

//header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
//header('Content-Disposition: attachment; filename='.$nombreDescarga.'.xls');

header('Content-type: application/vnd.ms-word;charset=iso-8859-15');
header('Content-Disposition: attachment; filename='.$nombreDescarga.'.doc');

$mantenimiento=new MantenimientoPreventivo('ide', $ide);
$reporte=new ReportePreventivo('ideMantenimientoPreventivo', $mantenimiento->getIde());
$equipos= Equipo::getDatosEnObjetos("ideSede={$mantenimiento->getIdeSede()}", 'ubicacion,nombreequipo asc');
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
    $numeroReporte = ReportePreventivo::getBuscarReporte($mantenimiento->getIde(), $objeto->getIde());
    if ($numeroReporte){
	$lista.="<td>{$numeroReporte}</td>";

    }else{
        $lista.="<td>-</td>";
    }
    $lista.='</tr>';
    $item++;
}

?>
<style type="text/css">
	table{
		border-collapse: collapse;
		margin:0 auto;
		width:450px;
		font-size: 12px;
		font-family:'Arial';
	}
	.titulo{
		background:#060357;
		color: #fff;
	}
	td{
		text-align:center;
	}
	.tColumnas{
		background:#b2b2b2
	}
	.subtitulos{
		background: #8E95F2;
	}
</style>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <table border='1'>
    	<tr>
    		<th colspan="8" class="titulo">MANTENIMIENTO PREVENTIVO</th>
    	</tr>
    	<tr>
    		<th colspan="2" class="subtitulos">CLIENTE</th><td colspan="2"><?=$mantenimiento->getSedeClase()->getCliente()->getNombre().' - '.$mantenimiento->getSedeClase()->getNombre()?></td>
    		<th colspan="2" class="subtitulos">FECHA</th><td colspan="2"><?=$mantenimiento->getMostarFecha()?></td>
    	</tr>
        <tr>
            <th class="tColumnas">ITEM</th>
            <th class="tColumnas">ACTIVO FIJO</th>
            <th class="tColumnas">EQUIPO</th>
            <th class="tColumnas">MARCA</th>
            <th class="tColumnas">MODELO</th>
            <th class="tColumnas">SERIE</th>
            <th class="tColumnas">UBICACIÓN</th>
            <th class="tColumnas">NUMERO REPORTE</th>
        </tr>
        <?=$lista?>
    </table>