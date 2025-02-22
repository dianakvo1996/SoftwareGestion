<?php
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/ManualEquipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/TipoEquipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/GuiaEquipo.php';

//Detalles Equipo
foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$equipo=new Equipo('ide',$ideEquipo);

$guiaEquipo=new GuiaEquipo('ideTipoEquipo',$equipo->getTipoEquipo()->getIde());
$manualEquipo=new ManualEquipo('ideTipoEquipo',$equipo->getTipoEquipo()->getIde());

if($guiaEquipo->getIde()!=null){
	$guiaMostrar="<div class='visorPDF'><iframe src='http://laboratoriobiometrical.com.co/SoftwareGestion/librerias/pdfjs/web/viewer.html?file=http://laboratoriobiometrical.com.co/SoftwareGestion/GuiaRapidaEquipo/{$guiaEquipo->getRuta()}'></iframe></div>";
}else{
	$guiaMostrar="<label>NO DISPONIBLE</label>";
}

if($manualEquipo->getIde()!=null){
	$manualMostrar="<div class='visorPDF'><iframe src='http://laboratoriobiometrical.com.co/SoftwareGestion/librerias/pdfjs/web/viewer.html?file=http://laboratoriobiometrical.com.co/SoftwareGestion/ManualEquipo/{$manualEquipo->getRuta()}'></iframe></div>";
}else{
	$manualMostrar="<label>NO DISPONIBLE</label>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>DETALLES DE EQUIPO</title>
	<link rel="stylesheet" type="text/css" href="../../../presentacion/css/estiloDetallesEquipo.css">
	<link rel="stylesheet" type="text/css" href="../../../presentacion/css/styles.css">
	<link href="../../../presentacion/css/imprimirHojaVida.css" rel="stylesheet" type="text/css" media="print"/>
	<link rel="shortcut icon" type="image/x-icon" href="../../../presentacion/imagenes/logoIcono.ico" />
	<link href="https://fonts.googleapis.com/css?family=Cabin&display=swap" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
</head>
<body onload="mostrarContenido('hojaVidaM')">
<a href="../../principal.php?CONTENIDO=mantenimiento/administrador/equiposSede.php&ideSede=<?=$equipo->getIdeSede()?>"><img src="../../../presentacion/iconos/atras.png" title="Volver" height="20px" style="float: left"></a>
		<h2 style="text-align:center">DETALLES EQUIPO BIOMEDICO</h2>
		<div class="checkMostrar">
                        <div class="li"><input type="checkbox" id="hojaVidaM" name="tipoMantenimiento" class="botonCheck" onclick="mostrarContenido(this.id)" checked><span></span><label for="hojaVidaM">HOJA DE VIDA EQUIPO BIOMEDICO</label></div>
				<div id="hojaVidaMostrar" class="mostrarEsconder">
					<?php include 'hojaDeVidaEquipoMostrar.php'; ?>
				</div>
			<div class="li"><input type="checkbox" id="mttoPreventivo" name="tipoMantenimiento" class="botonCheck" onclick="mostrarContenido(this.id)" ><span></span><label for="mttoPreventivo">MANTENIMIENTO REVENTIVO</label></div>
				<div id="mttoPreventivoMostrar" class="mostrarEsconder">
					<?php include 'mantenimientosPreventivosEquipo.php'; ?>
				</div>
			<div class="li"><input type="checkbox" id="mttoCorrectivo" name="tipoMantenimiento" class="botonCheck" onclick="mostrarContenido(this.id)" ><span></span><label for="mttoCorrectivo">MANTENIMIENTO CORRECTIVO</label></div>
				<div id="mttoCorrectivoMostrar" class="mostrarEsconder">
					<?php include 'mantenimientosCorrectivosEquipo.php'; ?>
				</div>			
			<div class="li"><input type="checkbox" id="calibracion" name="tipoMantenimiento" class="botonCheck" onclick="mostrarContenido(this.id)" ><span></span><label for="calibracion">CALIBRACION</label></div>
				<div id="calibracionMostrar" class="mostrarEsconder">
				</div>
			<div class="li"><input type="checkbox" id="guiaUso" name="tipoMantenimiento" class="botonCheck" onclick="mostrarContenido(this.id)" ><span></span><label for="guiaUso">GUIA DE USO</label></div>
				<div id="guiaUsoMostrar" class="mostrarEsconder">					
					<?=$guiaMostrar?>
				</div>				
			<div class="li"><input type="checkbox" id="manual" name="tipoMantenimiento" class="botonCheck" onclick="mostrarContenido(this.id)" ><span></span><label for="manual">MANUAL</label></div>
				<div id="manualMostrar" class="mostrarEsconder">
					<?=$manualMostrar?>
				</div>
		</div>
</body>
</html>
<script>
	function mostrarContenido(ide) {
		var ideChek='';
		var seleccionado = document.getElementById(ide).checked
		switch(ide){
			case 'hojaVidaM':
				ideChek='hojaVidaMostrar'
				break;
			case 'mttoPreventivo':
				ideChek='mttoPreventivoMostrar'
				break;
			case 'mttoCorrectivo':
				ideChek='mttoCorrectivoMostrar'
				break;
			case 'calibracion':
				ideChek='calibracionMostrar'
				break;
			case 'guiaUso':
				ideChek='guiaUsoMostrar'
				break;
			case 'manual':
				ideChek='manualMostrar'
				break;
		}
		if (seleccionado) {
			var intro = document.getElementById(ideChek);
			intro.style.display = 'block';
		}else{
			var intro = document.getElementById(ideChek);
			intro.style.display = 'none';
		}
	}
</script>