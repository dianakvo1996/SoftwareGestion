<?php

require_once dirname(__FILE__) . '/../../../clasesCalidad/DocumentoGestion.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable => $Valor) ${$Variable} = $Valor;

$MENSAJE='';
if (isset($_GET['MENSAJE']))
    $MENSAJE = $_GET['MENSAJE'];

if(isset($ideDoc))$docGestion=new DocumentoGestion('ide',$ideDoc);

else $docGestion=new DocumentoGestion(null,null);

$dentro='';
switch($docGestion->getIdeTipo()){
	case '1':
$archivo="../Documento_Gestion/{$docGestion->getRuta()}";
$dentro.='<div id="app" style="height:100%">';
$dentro.='<div role="toolbar" id="toolbar">';
$dentro.='<div id="pager">';
$dentro.='<button data-pager="prev">Anterior</button>';
$dentro.='<button data-pager="next">Siguiente</button>';
$dentro.='</div>';
$dentro.='<div id="page-mode">';
$dentro.='<input type="hidden" value="1" min="1"/>';
$dentro.='</div>';
$dentro.='</div>';
$dentro.='<div id="viewport-container"><div role="main" id="viewport"></div></div>';
$dentro.='</div>';
$dentro.='<script src="https://unpkg.com/pdfjs-dist@2.0.489/build/pdf.min.js"></script>';
$dentro.='<script src="../presentacion/js/index.js"></script>';
$dentro.='<script>';
$dentro.="initPDFViewer('{$archivo}');";
$dentro.="document.oncontextmenu = function(){return false}";
$dentro.='</script>';
		break;
	case '2':
		$dentro.="<object data='../Documento_Gestion/{$rutaDoc}' type='application/PDF' width='100%' style='min-height:600px' height='100%' align='right'></object>";
		break;
	case '3':
		$dentro.="<object data='../Documento_Gestion/{$rutaDoc}' type='application/PDF' width='100%' style='min-height:600px' height='100%' align='right'></object>";
		break;
	case '4':
		$dentro.="<object data='../Documento_Gestion/{$rutaDoc}' type='application/PDF' width='100%' height='100%' style='min-height:600px' align='right'></object>";
		break;
	default:
		$dentro.="<section><img src='../presentacion/iconos/qualityOpaco.png' style='opacity: 0.5;' height='200px'></section>";
		break;

}
?>
<div class="alerta" style="color: red"><?=$MENSAJE?></div>
<?=$dentro?>