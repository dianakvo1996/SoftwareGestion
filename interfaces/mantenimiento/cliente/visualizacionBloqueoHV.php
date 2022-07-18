<?php

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable => $Valor) ${$Variable} = $Valor;

$archivo="../HojasDeVidaPersonal/".$ruta;

?>
<div id="app" style="height:100%; max-height:600px">
    <div role="toolbar" id="toolbar">
        <div id="pager">
            <button data-pager="prev">Anterior</button>
            <button data-pager="next">Siguiente</button>
        </div>
        <div id="page-mode">
            <input type="hidden" value="1" min="1"/>
        </div>
    </div>
      <div id="viewport-container"><div role="main" id="viewport"></div></div>
</div>
<script src="https://unpkg.com/pdfjs-dist@2.0.489/build/pdf.min.js"></script>
<script src="../presentacion/js/index.js"></script>
<script>
      initPDFViewer("<?=$archivo?>");
      document.oncontextmenu = function(){return false}
      //Combinancion de teclas CTRL+P y bloquear su ejecucion en el navegador
        var isCtrl = false;
        document.onkeyup=function(e){
        if(e.which == 17) isCtrl=false;
        }
        document.onkeydown=function(e){
        if(e.which == 17) isCtrl=true;
        if(e.which == 80 && isCtrl == true) {
        
        return false;
        }
        }
</script>