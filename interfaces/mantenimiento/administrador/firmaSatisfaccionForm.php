<?php

require_once dirname(__FILE__) . '/../../../clasesMantenimiento/ReportePreventivo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/MantenimientoPreventivo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/FirmaSatisfaccion.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;
$hidden="";
for ($i = 1; $i <=$numReportes; $i++) {
    if(isset($_POST["firmar$i"])) {
		$hidden.="<input type='hidden' name='numReporte{$i}' value='".$_POST["firmar$i"]."'>"; 
	}
}
$mantenimiento=new MantenimientoPreventivo('ide',$ideMantenimiento);
?>
<a href="principal.php?CONTENIDO=mantenimiento/administrador/equiposMantenimientoSede.php&ide=<?=$ideMantenimiento?>"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="formulario">
<center>
	<table>
		<tr>
			<th colspan="2">ADICIONAR FIRMA DE SATISFACCION<br>MANTENIMIENTO PREVENTIVO</th>
		</tr>
		<tr>
			<th>Fecha Mantenimiento</th><td style="text-align:center"><?=$mantenimiento->getMostarFecha()?></td>
		</tr>
		<tr>
			<th>Cliente</th>
			<td>
				<?=$mantenimiento->getSede()->getCliente()->getNombre()?>
			</td>
		</tr>
<tr>
	<td colspan="2" style="text-align:center">
<!-- Contenedor y Elemento Canvas -->
  <div id="signature-pad" class="signature-pad" >
    <div class="signature-pad--body">
      <canvas style="width: 400px; height: 100px; border: 1px black dashed; " id="canvas"></canvas>
    </div>
  </div>
</td>
</tr>
<tr>
<th colspan="2">
<!-- Formulario que recoge los datos y los enviara al servidor -->
 <form id="form" action="mantenimiento/administrador/firmaSatisfaccionActualizar.php" method="post">
    <input type="hidden" name="base64" value="" id="base64">
	<?=$hidden?>
	<input type="hidden" name="numReportes" value="<?=$numReportes?>">
	<input type="hidden" name="ideMantenimiento" value="<?=$ideMantenimiento?>">
    <input type="submit" id="saveandfinish" value="Guardar y Finalizar" class="btn btn-success">
</form>
</div>
</th>
		</tr>
	</table>
</center>
<script type="text/javascript">

var wrapper = document.getElementById("signature-pad");

var canvas = wrapper.querySelector("canvas");
var signaturePad = new SignaturePad(canvas, {
  backgroundColor: 'rgb(255, 255, 255)'
});

function resizeCanvas() {

  var ratio =  Math.max(window.devicePixelRatio || 1, 1);

  canvas.width = canvas.offsetWidth * ratio;
  canvas.height = canvas.offsetHeight * ratio;
  canvas.getContext("2d").scale(ratio, ratio);

  signaturePad.clear();
}

window.onresize = resizeCanvas;
resizeCanvas();

</script>
<script>

   document.getElementById('form').addEventListener("submit",function(e){

    var ctx = document.getElementById("canvas");
      var image = ctx.toDataURL(); // data:image/png....
      document.getElementById('base64').value = image;
   },false);

</script>
