<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Sede.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$sede=new Sede('ide',$ideSede);
$datos= Equipo::getDatosEnObjetos('ideSede='.$sede->getIde(),null);
$lista='';
$item = 1;
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
	$direccion="document.location='principal.php?CONTENIDO=mantenimiento/cliente/detallesEquipo.php&ideEquipo={$objeto->getIde()}'";
    $lista.="<tr onclick={$direccion}>";
    $lista.="<td>{$item}.</td>";
    $lista.="<td>{$objeto->getActivoFijo()}</td>";
    $lista.="<td>{$objeto->getNombreEquipo()}</td>";
    $lista.="<td>{$objeto->getMarca()}</td>";
    $lista.="<td>{$objeto->getModelo()}</td>";
    $lista.="<td>{$objeto->getSerial()}</td>";  
    $lista.="<td>{$objeto->getUbicacion()}</td>";
    $lista.="<td>{$objeto->getRegistroInvima()}</td>";
    $lista.="<td>{$objeto->getTipoEquipo()->getTipoLista()}</td>";
    $lista.="<td>{$objeto->getTipoEquipo()->clasificacionBiomedicaLista()}</td>";
    $lista.="<td>{$objeto->getTipoEquipo()->clasificacionRiesgoLista()}</td>";
    $lista.="<td>{$objeto->getTipoEquipo()->getManualLista()}</td>";
    $lista.='</tr>';
$item++;
}
?>
<a href="principal.php?CONTENIDO=mantenimiento/cliente/sedes.php" style="float: left"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="listados">
	<h2>INVENTARIO EQUIPOS MANTENIMIENTO</h2>
</br>
    <table>
        <tr>
            <th>Sede:</th>
            <td style="text-align: initial" colspan="2"><?=$sede->getNombre()?></td>
        </tr>
	<tr>
		<th><a href="principal.php?CONTENIDO=mantenimiento/cliente/cronogramaSede.php&ideSede=<?=$sede->getIde()?>" class="enlace">CRONOGRAMA DE MANTENIMIENTO</a></th>
		<th><a href="principal.php?CONTENIDO=mantenimiento/cliente/equiposDeBajaSede.php&ideSede=<?=$sede->getIde()?>" class="enlace">EQUIPOS DE BAJA</a></th>
	</tr>
    </table>
    <table>
        <tr>
            <th colspan="2">ACTIVO FIJO</th>
            <th>NOMBRE</th>
            <th>MARCA</th>
            <th>MODELO</th>
            <th>SERIAL</th>
            <th>UBICACIÓN</th>
            <th>REGISTRO INVIMA</th>
			<th>TIPO</th>
			<th>CLASIFICACION BIOMEDICA</th>
			<th>CLASIFICACION DEL RIESGO</th>
			<th>MANUAL</th>         </tr>
        <?=$lista?>
    </table>
</div>