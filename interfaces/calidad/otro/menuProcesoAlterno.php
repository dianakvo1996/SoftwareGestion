<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/Proceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/Permiso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/ArchivosProceso.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable => $Valor) ${$Variable} = $Valor;

$proceso=new Proceso("ide", $ideProceso);
$carpeta= str_replace(' ','_',$proceso->getNombre());

$datosPermiso= Permiso::getDatosEnObjeto("ideProceso=$ideProceso and usuario='".$_SESSION['usuario']."'", null);
$visualizador="visualizadorPDF.php";

for ($j = 0; $j < count($datosPermiso); $j++) {
    $objetoPermiso=$datosPermiso[$j];
    if ($objetoPermiso->getPermiso()=='SL') {
        $visualizador="visualizadorPDFBloqueado.php";
    }
}

$datos= ArchivosProceso::getDatosEnObjetos("ideProceso=$ideProceso", "nombre");
$lista='';
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.="<li><a href='principal.php?CONTENIDO=calidad/otro/menuProcesoAlterno.php&ideProceso={$ideProceso}&CONTENIDOINTERNO=calidad/otro/{$visualizador}&ruta={$carpeta}/{$objeto->getMostrarFormato()}'><img src='../presentacion/iconos/pdf.png' height='30px' class='iconoOpcion'>{$objeto->getNombre()}</a></li>";
    $lista.='</br>';
}
?>
<div id="menuLateral"> 
    <a href="principal.php?CONTENIDO=calidad/otro/inicio.php"><img src="../presentacion/iconos/atras.png" title="Volver" height="30px"></a>
    <br>
    <br>
    <img src="../presentacion/imagenes/<?=$proceso->getImagen()?>" height="90px" style="opacity: 0.8" title="<?= $proceso->getNombre() ?>">
    <h3><?=strtoupper($proceso->getNombre())?></h3>
    <nav>
        <ul class="opciones">
            <?=$lista?>
        </ul>
    </nav>
</div>
<div id="contenidoInterno">
    <?php include $_GET['CONTENIDOINTERNO']; ?>
</div>