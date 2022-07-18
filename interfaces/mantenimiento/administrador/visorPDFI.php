<?php
$dentro='';
$archivo="manual.pdf";
$dentro.='<div id="app" style="height:500px">';
$dentro.='<div role="toolbar" id="toolbar">';
$dentro.='<div id="pager">';
$dentro.='<button data-pager="prev">Anterior</button>';
$dentro.='<button data-pager="next">Siguiente</button>';
$dentro.='<button data-pager="next">Siguiente</button>';
$dentro.='</div>';
$dentro.='<div id="page-mode">';
$dentro.='<input type="hidden" value="1" min="1"/>';
$dentro.='</div>';
$dentro.='</div>';
$dentro.='<div id="viewport-container"><div role="main" id="viewport"></div></div>';
$dentro.='</div>';
$dentro.='<script src="https://unpkg.com/pdfjs-dist@2.0.489/build/pdf.min.js"></script>';
$dentro.='<script src="../../../presentacion/js/index.js"></script>';
$dentro.='<script>';
$dentro.="initPDFViewer('{$archivo}');";
$dentro.="document.oncontextmenu = function(){return false}";
$dentro.='</script>';

?>
<?=$dentro?>

