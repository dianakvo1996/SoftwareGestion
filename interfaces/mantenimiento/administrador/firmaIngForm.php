<?php

require_once dirname(__FILE__) . '/../../../clasesCalidad/Persona.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/FirmaIngeniero.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$firmaIng=new FirmaIngeniero('ideIngeniero',"'{$ideIng}'");
$persona=new Persona('identificacion',"'{$ideIng}'");
if($firmaIng->getIde()!=null){
	$img="<img src='../FirmasIMG/{$firmaIng->getImgFirma()}' height='100px'>";
}else{
	$img='NO DISPONIBLE';
}
?>
<a href="principal.php?CONTENIDO=mantenimiento/administrador/usuario.php"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="formulario">
<center>
	<table>
		<tr>
			<th colspan="2">ADMINISTRACION DE FIRMA</th>
		</tr>

		<tr>
			<td colspan="2" style="text-align:center"><?=$persona->getNombresCompletos()?></td>
		</tr>
		<tr>
			<th>Firma Anterior</th><td><?=$img?></td>
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
 <form id="form" action="mantenimiento/administrador/firmaIngActualizar.php" method="post">
    <input type="hidden" name="ideIngeniero" value="<?=$ideIng?>">
    <input type="hidden" name="base64" value="" id="base64">
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
