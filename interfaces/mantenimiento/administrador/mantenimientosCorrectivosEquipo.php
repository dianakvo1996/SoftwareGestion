<?php
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/solicitudCorrectivo.php';

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
		<select name="anios" onchange="cargarListaCorrectivos(this.value)">
			<?=$option?>
		</select>		
	</form>				
</div>
<div class="mostrarReportes">
	<div class="seleccionFecha">
		<label>Seleccione Reporte</label>
		<table style="margin:0 auto;width:100%">
			<tbody id="listaReportesCorrectivos">
			</tbody>
		</table>
	</div>
	<div class="visorRPDF">
		<section id="visorCorrectivo"></section>
	</div>
</div>
<script>
	function cargarListaCorrectivos(anio){
	<?=solicitudCorrectivo::getDatosArregloJS("ideEquipo={$ideEquipo}") ?>
		var listaCorrectivo = '';
		for(var i = 0 ; i < solicitudes.length; i++){
			const fechaSolicitud = new Date(solicitudes[i][1])
			var anioS = fechaSolicitud.getFullYear()
			if(anioS==anio){
				listaCorrectivo+="<a onclick='cargarReporte("+'"'+solicitudes[i][2]+'"'+")'>"+solicitudes[i][3]+"</a>"
			}
		}
		document.getElementById('listaReportesCorrectivos').innerHTML = "<tr><td>"+listaCorrectivo+"</td></tr>";
	}

	function cargarReporte(evidencia){
		let indice = evidencia.split(".");
		switch(indice[1]){
			case 'pdf':
				document.getElementById('visorCorrectivo').innerHTML="<iframe src='http://laboratoriobiometrical.com.co/SoftwareGestion/librerias/pdfjs/web/viewer.html?file=http://laboratoriobiometrical.com.co/SoftwareGestion/EvidenciasCorrectivos/"+evidencia+"'></iframe>";
				break;
			case 'jpg':
				document.getElementById('visorCorrectivo').innerHTML="<img src='../EvidenciasCorrectivos/"+evidencia+"' height='500px'>";
				break;
			case 'JPG':
				document.getElementById('visorCorrectivo').innerHTML="<img src='../EvidenciasCorrectivos/"+evidencia+"' height='500px'>";
				break;
			case 'jpeg':
				document.getElementById('visorCorrectivo').innerHTML="<img src='../EvidenciasCorrectivos/"+evidencia+"' height='500px'>";
				break;
			default:
				document.getElementById('visorCorrectivo').innerHTML="<img src='../EvidenciasCorrectivos/mantenimientoEnProceso.png' height='100px'>"
				break;
		}
		
	}
</script>