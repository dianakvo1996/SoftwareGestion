<?php

require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Sede.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/EquipoHV.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$sede=new Sede('ide',$ideSede);
$datos=EquipoHV::getDatosEnObjetos("ideSede={$ideSede}", 'ubicacion,nombreequipo asc');
$lista='';
$item=1;


for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<td><label for='{$objeto->getIde()}'>{$objeto->getActivoFijo()}</label></td>";
    $lista.="<td><label for='{$objeto->getIde()}'>{$objeto->getNombreEquipo()}</label></td>";
    $lista.="<td><label for='{$objeto->getIde()}'>{$objeto->getMarca()}</label></td>";
    $lista.="<td><label for='{$objeto->getIde()}'>{$objeto->getModelo()}</label></td>";
    $lista.="<td><label for='{$objeto->getIde()}'>{$objeto->getSerial()}</label></td>";    
    $lista.="<td><label for='{$objeto->getIde()}'>{$objeto->getUbicacion()}</label></td>";
    $lista.="<td><a href='mantenimiento/cliente/hojaDeVidaEquipoVisualizar.php?ideEquipo={$objeto->getIde()}' class='enlace'>Visualizar</a></td>";
	$lista.='</tr>';
    $item++;
}
?>
<a href="principal.php?CONTENIDO=mantenimiento/cliente/equiposSede.php&ideSede=<?=$sede->getIde()?>" style="float: left"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="listados">
	<h2>HOJA DE VIDA DE EQUIPOS BIOMEDICOS</h2>
<table>
	<tr>
		<th colspan="1">CLIENTE</th>
		<td colspan="3" style="text-align:left"><?=$sede->getCliente()->getNombre()?></td>
		<th colspan="1">SEDE</th>
		<td colspan="3" style="text-align:left"><?=$sede->getNombre()?></td>
	</tr>
	<tr>
		<th>ACTIVO FIJO</th><th>NOMBRE</th><th>MARCA</th><th>MODELO</th><th>SERIAL</th><th>UBICACION</th>
		<th></th>
	</tr>
	<?=$lista?>
</table>
</div>
