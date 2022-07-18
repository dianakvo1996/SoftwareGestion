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
<a href=" principal.php?CONTENIDO=calidad/administrador/inicio.php"><img src="../presentacion/iconos/atras.png" title="Atras" height="40px" style="float: left"></a>

<center>
    <a href="principal.php?CONTENIDO=calidad/administrador/archivoExtraFormulario.php&tipo=<?=$tipo?>"><img src="../presentacion/iconos/cambiar.png" title="Cambiar <?=$titulo?>" height="60px" ></a>
    <h2><?=$titulo?></h2>
    <object data="<?=$ruta?>" type="application/PDF" width="1000px" height="420px"></object>  
</center>