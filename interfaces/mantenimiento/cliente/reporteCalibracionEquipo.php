<?php
require_once dirname(__FILE__) . '/../../../clasesCalibracion/ReporteCalibracionPDF.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

date_default_timezone_set('America/Bogota');


$anioActual_ = date('Y');
$anioActual = date('Y');
$option="";
for($i=1;$i<=3;$i++){
	$option.="<option value='{$anioActual}'>{$anioActual}</option>";
	$anioActual=$anioActual-1; 
}

?>
<div  class="menuAnios">
	<form method="POST" name="formulario" >
		<label><strong>Seleccione Año:&nbsp;&nbsp;&nbsp;</strong></label>
		<select name="anios" onchange="cargarListaReportesCalibracion(this.value)">
			<?=$option?>
		</select>		
	</form>				
</div>
<div class="mostrarReportes">
	<div class="seleccionFecha">
		<label>Seleccione Reporte</label>
		<table style="margin:0 auto;width:100%">
			<tbody id="listaReportesCalibracion">
			</tbody>
		</table>
	</div>
	<div class="visorRPDF">
		<section id="visorCalibracion"></section>
	</div>
</div>
<script>
	function cargarListaReportesCalibracion(anio){
	<?=ReporteCalibracionPDF::getDatosArregloJS("ideEquipo={$ideEquipo}") ?>
		var listaCalibracion = '';
		for(var i = 0 ; i < reportesPDF.length; i++){
			const fechaSolicitud = new Date(reportesPDF[i][0])
			var anioS = fechaSolicitud.getFullYear()
			if(anioS==anio){
				listaCalibracion+="<a onclick='cargarReporteCalibracion("+'"'+reportesPDF[i][2]+'"'+")'>"+reportesPDF[i][3]+"</a>"
			}
		}
		document.getElementById('listaReportesCalibracion').innerHTML = "<tr><td>"+listaCalibracion+"</td></tr>";
	}

	function cargarReporteCalibracion(evidencia){
		let indice = evidencia.split(".");
		switch(indice[1]){
			case 'pdf':
				document.getElementById('visorCalibracion').innerHTML="<iframe src='http://laboratoriobiometrical.com.co/SoftwareGestion/librerias/pdfjs/web/viewer.html?file=http://laboratoriobiometrical.com.co/SoftwareGestion/ReporteCalibracionPDF/"+evidencia+"'></iframe>";
				break;
			case 'jpg':
				document.getElementById('visorCalibracion').innerHTML="<img src='../ReporteCalibracionPDF/"+evidencia+"' height='500px'>";
				break;
			case 'JPG':
				document.getElementById('visorCalibracion').innerHTML="<img src='../ReporteCalibracionPDF/"+evidencia+"' height='500px'>";
				break;
			case 'jpeg':
				document.getElementById('visorCalibracion').innerHTML="<img src='../ReporteCalibracionPDF/"+evidencia+"' height='500px'>";
				break;
			default:
				document.getElementById('visorCalibracion').innerHTML="<img src='../ReporteCalibracionPDF/mantenimientoEnProceso.png' height='100px'>"
				break;
		}
		
	}
</script>