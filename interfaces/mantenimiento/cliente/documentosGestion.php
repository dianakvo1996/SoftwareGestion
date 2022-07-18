<?php
require_once dirname(__FILE__) . '/../../../clasesCalidad/TipoDocumento.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/DocumentoGestion.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/PermisoHojaVida.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';

if(isset($_GET['CONTENIDOV']))$_GET['CONTENIDO']=$_GET['CONTENIDO'];
else $_GET['CONTENIDOV']='mantenimiento/cliente/VisualizadorDG.php';
$cliente=new Cliente('usuario', "'".$_SESSION['usuario']."'");

$datos=TipoDocumento::getDatosEnObjetos(null,null);
$lista='';
$item=1;
for ($i = 0; $i < count($datos); $i++) {
	$objeto=$datos[$i];
	$lista.='<tr>';
	$rutaDoc=$objeto->getRutaDocumento($cliente->getNit(),$objeto->getIde());
	if($rutaDoc!=null){
		$lista.="<th><section class='enlaceL'><a href='principal.php?CONTENIDO=mantenimiento/cliente/documentosGestion.php&CONTENIDOV=mantenimiento/cliente/VisualizadorDG.php&ideDoc={$objeto->getDocumentoGestion()->getIde()}&rutaDoc={$rutaDoc}'>{$objeto->getNombre()}</a></section></th>";
	} else {
		$lista.="<th><section class='enlaceV'><a href='#' onclick='advertencia(" . '"' . "{$objeto->getTipo()}" . '"' . ")'>{$objeto->getNombre()}</a></section></th>";
	}	
	$lista.='</tr>';
$item++;
}
?>
<div class="contenedorPrincipal">
<div class="menuLateral">
<section class="titulo">
<h3>DOCUMENTOS DE GESTION</h3>
</section>
<table>
	<?=$lista?>
		<tr>
			<th><section class='enlaceL'><a href="principal.php?CONTENIDO=mantenimiento/cliente/documentosGestion.php&CONTENIDOV=mantenimiento/cliente/hojasVidaPersonal.php">HOJAS DE VIDA PERSONAL BIOMÉDICO</a></section></th>
		</tr>
</table>
</div>
<div class="contenidoV">
    <?php include $_GET['CONTENIDOV']; ?>
</div>
</div>
<script>
	function advertencia(valor){
		var cadena;
		switch (valor) {
  			case 'C':
    			cadena = 'CONTRATO';
    			break;
  			case 'PM':
    			cadena = 'PLAN DE MANTENIMIENTO';
    			break;
  			case 'PAM':
    			cadena = 'PLAN DE ASEGURAMIENTO METROLOGICO';
    			break;
  			case 'PMST':
    			cadena = 'PROTOCOLO MANEJO SEGURO DE TECNOLOGIAS';
    			break;
  			default:
    			cadena = 'OTRO';
    			break;

		}
		alert(cadena+' NO DISPONIBLE')
	}
</script>
