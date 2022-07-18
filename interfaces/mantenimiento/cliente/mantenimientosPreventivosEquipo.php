<?php
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/ReportePreventivo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/ReportePreventivoPDF.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;


if(isset($numeroReporte))
    $_GET['RP'] = 'reportePreventivoDetalles.php';
else $_GET['RP'] = 'inicio.php';

date_default_timezone_set('America/Bogota');

$anioPresente= date('Y');
$opciones="";
for($i=1;$i<=5;$i++){
	$opciones.="<option value='{$anioPresente}'>{$anioPresente}</option>";
	$anioPresente--; 
}
?>
<div  class="menuAnios">
	<form method="POST" name="formulario2" >
		<label><strong>Seleccione Año:&nbsp;&nbsp;&nbsp;</strong></label>
		<select name="aniosP" onchange="cargarListaPreventivos(this.value)"><?=$opciones?></select>		
	</form>				
</div>
<div class="mostrarReportes">
	<div class="seleccionFecha">
		<label>Seleccione Reporte</label>
		<table style="margin:0 auto;width:100%">
			<tbody id="listaReportesPreventivos">
			</tbody>
		</table>
	</div>
	<div class="visorRPDF">
		<section id="visorPreventivos" >
         	<?php include $_GET['RP']?>
		</section>
	</div>
</div>
<script>
	function cargarListaPreventivos(anio1){
	 <?=ReportePreventivo::getDatosArregloJS("ideEquipo={$ideEquipo}") ?>
	 <?=ReportePreventivoPDF::getDatosArregloJS("ideEquipo={$ideEquipo}") ?>
		var listas='';
		for(var i = 0 ; i < reportes.length; i++){ 
			const fechaReporte= new Date(reportes[i][0])
			var anioP = fechaReporte.getFullYear()
			if(anio1==anioP){
				listas+="<a href='principal.php?CONTENIDO=mantenimiento/cliente/detallesEquipo.php&ideEquipo=<?=$ideEquipo?>&numeroReporte="+reportes[i][1]+"'>"+reportes[i][2]+"</a>";
			}
		}

		for(var j = 0 ; j < reportesPDF.length; j++){
			const fechaReportePDF = new Date(reportesPDF[j][0])
			var anioPPDF = fechaReportePDF.getFullYear()
			if(anio1==anioPPDF){
				listas+="<a onclick='cargarReportePreventivoPDF("+'"'+reportesPDF[j][2]+'"'+")' id='fechaPrev'>"+reportesPDF[j][3]+"</a>";
			}

		}
		document.getElementById('listaReportesPreventivos').innerHTML ="<tr><td>"+listas+"</td></tr>";
	}

	function cargarReportePreventivo(numReporte){ 
		 document.getElementById('visorPreventivos').innerHTML= numReporte

	}
	function cargarReportePreventivoPDF(archivo){
		let indice = archivo.split(".");
		switch(indice[1]){
			case 'pdf':
				document.getElementById('visorPreventivos').innerHTML="<iframe src='http://laboratoriobiometrical.com.co/SoftwareGestion/librerias/pdfjs/web/viewer.html?file=http://laboratoriobiometrical.com.co/SoftwareGestion/ReportePreventivosPDF/"+archivo+"'></iframe>";
				break;
			case 'jpg':
				document.getElementById('visorPreventivos').innerHTML="<img src='../ReportePreventivosPDF/"+evidencia+"' height='500px'>";
				break;
			case 'JPG':
				document.getElementById('visorPreventivos').innerHTML="<img src='../ReportePreventivosPDF/"+evidencia+"' height='500px'>";
				break;
			case 'jpeg':
				document.getElementById('visorPreventivos').innerHTML="<img src='../ReportePreventivosPDF/"+evidencia+"' height='500px'>";
				break;
			default:
				document.getElementById('visorPreventivos').innerHTML="<img src='../ReportePreventivosPDF/mantenimientoEnProceso.png' height='100px'>"
				break;

		}
	}

</script>