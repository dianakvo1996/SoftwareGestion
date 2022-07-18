<?php
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';
require_once dirname(__FILE__) . '/../../../clasesCalibracion/ReporteCalibracionPDF.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$equipo=new Equipo('ide',$ideEquipo);
$datos=ReporteCalibracionPDF::getDatosEnObjetos("ideEquipo={$ideEquipo}", 'fecha');
$lista='';
$item=1;
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.="<tr>";
	$lista.="<td>{$item}</td>";
	$lista.="<td>{$objeto->getFechaLista()}</td>";
	$lista.="<td><a href='../ReporteCalibracionPDF/{$objeto->getArchivo()}' target='_blank'>{$objeto->getArchivo()}</a></td>";
	$lista.="<th><img src='../presentacion/iconos/eliminar.png' title='Eliminar' height='20px' onclick='eliminar({$objeto->getIde()})'></th>";
    $lista.='</tr>';
    $item++;
}
if($equipo->getideSede()!=null){
	$redireccion="equiposSedeMntto.php&ideSede={$equipo->getideSede()}";
	$cliente=$equipo->getSede()->getCliente()->getNombre();
	$sede="-".$equipo->getSede()->getNombre();
}else{
	$redireccion="equiposClienteMntto.php&nit={$equipo->getNitCliente()}";
	$cliente=$equipo->getCliente()->getNombre();
	$sede='';	
}
?>
<a href="principal.php?CONTENIDO=calibracion/administrador/clientesMantenimiento.php" style="float: left"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="listados">
    <table>
		<tr>
			<th colspan="5" class="tituloSuperior">EQUIPOS MANTENIMIENTO</th>
		</tr>
        <tr>
            <th>Cliente</th><td class="encabezado"><?=$cliente.$sede?></td>
        </tr>
		<tr>
			<th>INFORMACION EQUIPO</th>
			<td  class="encabezado">
				<strong>Equipo: </strong><?=$equipo->getNombreEquipo()?><br>
				<strong>Activo Fijo: </strong><?=$equipo->getActivoFijo()?><br>
				<strong>Serie: </strong><?=$equipo->getSerial()?><br>
				<strong>Modelo: </strong><?=$equipo->getModelo()?><br>
				<strong>Ubicacion: </strong><?=$equipo->getUbicacion()?><br>
			</td>
		</tr>
    </table>
	<table>
		<tr>
			<th colspan="2">FECHA</th>
			<th>REPORTE</th>
			<th><a href="#formReportePDF" class="enlace">Adicionar</a></th>
		</tr>
		<?=$lista?>
	</table>
</div>

<div id="formReportePDF" class="modalDialog">
    <div>
    <a href="#close" title="Cerrar" class="close">x</a>
    <center>
        <h2>ADICIONAR REPORTE CALIBRACION</h2>
		<form method="POST" action="calibracion/administrador/reporteCalibracionPDFActualizar.php" enctype="multipart/form-data">
			<table id="formulario">
				<tr>
					<th>FECHA:</th><td><input type="date" name="fecha" value="<?= date('Y-m-d')?>" max="<?= date('Y-m-d')?>" required></td>
				</tr>
				<tr>
					<th>REPORTE:</th>
						<td>
							<input type="file" name="archivo" accept="image/*,.pdf" required>
						</td>
				</tr>
				<tr>
					<th colspan="2">
						<input type="hidden" name="ideEquipo" value="<?=$ideEquipo?>">
						<input type="submit" value="Adicionar" name="accion">

					</th>	
				</tr>
			</table>
		</form>
    </center>
    </div>
</div>
<script>
function eliminar(ide){
	if(confirm('¿Esta seguro de realizar esta accion?')){
		location = 'calibracion/administrador/reporteCalibracionPDFActualizar.php?accion=Eliminar&ide='+ide+'&ideEquipo='+<?=$ideEquipo?>;
	}
}
</script>

