<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable => $Valor) ${$Variable} = $Valor;

$datosProceso=new Proceso("ide",$ideProceso);
$carpeta= str_replace(' ','_',$datosProceso->getNombre());

if (!isset($ruta)) {
    $archivo=new ArchivosProceso("ideProceso", $datosProceso->getIde());
    $ruta=$carpeta.'/'.$archivo->getRuta();
}
$archivo="../ArchivosProcesos/".$ruta;

?>
<object data="<?=$archivo?>" type="application/PDF" width="100%" height="520px" align="right"></object>
    
