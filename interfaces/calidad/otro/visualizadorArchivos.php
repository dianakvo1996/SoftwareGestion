<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/ArchivoExtra.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable => $Valor) ${$Variable} = $Valor;

$archivo=new ArchivoExtra("tipo", "'".$tipo."'");

switch ($tipo) {
    case 'DE':        
        $titulo="DIRECCIONAMIENTO ESTRATÉGICO";
     break;
    case 'PE':
        $titulo="PLATAFORMA ESTRATÉGICA";
     break;
    case 'GC':
        $titulo="GESTIÓN DE CALIDAD";
     break;
    case 'PD':
        $titulo="PIRÁMIDE DOCUMENTAL";
     break;
    case 'RH':
        $titulo="RESEÑA HISTÓRICA";
     break;
    case 'CI':
        $titulo="CLIENTES Y PARTES INTERESADAS";
     break;
}
$ruta="../ArchivosProcesos/Archivos_Extras/".$archivo->getArchivo();
?>
<a href=" principal.php?CONTENIDO=calidad/otro/inicio.php"><img src="../presentacion/iconos/atras.png" title="Atras" height="40px"></a>
<center>
    <div id="visualizadorDerecha"></div>
    <div id="visualizadorIzquierda"></div>
        <h2><?=$titulo?></h2>
        <div id="app">
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
          initPDFViewer("<?=$ruta?>");
          document.oncontextmenu = function(){return false}//bloqueo menu contextual derecho
          //codigo javascript 
            var isCtrl = false;
            document.onkeyup=function(e){
            if(e.which == 17) isCtrl=false;
            }
            document.onkeydown=function(e){
            if(e.which == 17) isCtrl=true;
            if(e.which == 80 && isCtrl == true) {
            //Combinancion de teclas CTRL+P y bloquear su ejecucion en el navegador
            return false;
            }
            }
        </script>
</center>