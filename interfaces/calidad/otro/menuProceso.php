<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/PoliticasOperativasProceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/CaracterizacionProceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/OpcionesProceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/Permiso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/Proceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/SubMenuProceso.php';

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

$politicaProceso=new PoliticasOperativasProceso("ideProceso", $ideProceso);
$caracterizacion=new CaracterizacionProceso("ideProceso", $ideProceso);

$datos= OpcionesProceso::getDatosEnObjetos("ideProceso=$ideProceso", "nombre");
$lista='';
$lista.="<li><a href='principal.php?CONTENIDO=calidad/otro/menuProceso.php&ideProceso={$ideProceso}&CONTENIDOINTERNO=calidad/otro/{$visualizador}&ruta=/{$carpeta}/Politicas/{$politicaProceso->mostrarFormato()}'><img src='../presentacion/iconos/politicas.png' height='20px' class='iconoOpcion'>Politica Operativa</a></li>";
$lista.='</br>';
$lista.="<li><a href='principal.php?CONTENIDO=calidad/otro/menuProceso.php&ideProceso={$ideProceso}&CONTENIDOINTERNO=calidad/otro/{$visualizador}&ruta=/{$carpeta}/Caracterizacion/{$caracterizacion->mostrarFormato()}'><img src='../presentacion/iconos/caracterizacion.png' height='20px' class='iconoOpcion'>Caracterización del Proceso</a></li>";
$lista.='</br>';
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.="<li><a href='#'><img src='../presentacion/iconos/opcion.png' height='16px' class='iconoOpcion'>{$objeto->getNombre()}<img src='../presentacion/iconos/abajo.png' height='16px' class='abajo'></a>";
    $lista.='<ul>';
    $datosSubmenu= SubMenuProceso::getDatosEnObjetos("ideOpcion={$objeto->getIde()}", null);
    for ($j = 0; $j < count($datosSubmenu); $j++) {
        $objetoSubMenu=$datosSubmenu[$j];
        switch ($objetoSubMenu->getMenu()) {
            case 'PRO':
                $lista.="<li><a href='principal.php?CONTENIDO=calidad/otro/menuProceso.php&ideProceso={$ideProceso}&CONTENIDOINTERNO=calidad/otro/procedimientosDetalle.php&ideOpcion={$objeto->getIde()}'><img src='../presentacion/iconos/procedimientos.png' title='Procedimientos' height='18px' class='iconoOpcion'>Procedimientos</a></li>";
                break;
            case 'G':
                $lista.="<li><a href='principal.php?CONTENIDO=calidad/otro/menuProceso.php&ideProceso={$ideProceso}&CONTENIDOINTERNO=calidad/otro/guiasDetalle.php&ideOpcion={$objeto->getIde()}'><img src='../presentacion/iconos/guias.png'title='Guias' height='18px'class='iconoOpcion'>Guias</a></li>";
                break;
            case 'M':
                $lista.="<li><a href='principal.php?CONTENIDO=calidad/otro/menuProceso.php&ideProceso={$ideProceso}&CONTENIDOINTERNO=calidad/otro/manualesDetalle.php&ideOpcion={$objeto->getIde()}'><img src='../presentacion/iconos/manuales.png' title='Manuales' height='18px'class='iconoOpcion'>Manuales</a></li>";
                break;
            case 'P':
                $lista.="<li><a href='principal.php?CONTENIDO=calidad/otro/menuProceso.php&ideProceso={$ideProceso}&CONTENIDOINTERNO=calidad/otro/protocolosDetalle.php&ideOpcion={$objeto->getIde()}'><img src='../presentacion/iconos/protocolos.png' title='Protocolos' height='18px'class='iconoOpcion'>Protocolos</a></li>";
                break;
            case 'I':
                $lista.="<li><a href='principal.php?CONTENIDO=calidad/otro/menuProceso.php&ideProceso={$ideProceso}&CONTENIDOINTERNO=calidad/otro/instructivosDetalle.php&ideOpcion={$objeto->getIde()}'><img src='../presentacion/iconos/instructivos.png' title='Instructivos' height='18px'class='iconoOpcion'>Instructivos</a></li>";
                break;
            case 'F':
                $lista.="<li><a href='principal.php?CONTENIDO=calidad/otro/menuProceso.php&ideProceso={$ideProceso}&CONTENIDOINTERNO=calidad/otro/formatosDetalle.php&ideOpcion={$objeto->getIde()}'><img src='../presentacion/iconos/formatos.png' title='Formatos' height='18px' class='iconoOpcion'>Formatos</a></li>";
                break;
        }
    }
    $lista.='</ul>';
    $lista.='</li>';
    $lista.='</br>';
}
?>
<div id="menuLateral"> 
    <a href="principal.php?CONTENIDO=calidad/otro/inicio.php"><img src="../presentacion/iconos/atras.png" title="Volver" height="30px"></a>
    <br>
    <br>
    <img src="../presentacion/imagenes/<?=$proceso->getImagen()?>" height="90px" style="opacity: 0.8" title="<?=$proceso->getNombre()?>">
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

