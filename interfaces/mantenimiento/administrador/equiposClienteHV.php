<?php

require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/EquipoHV.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$cliente=new Cliente('nit', "'".$nitCliente."'");
$datos=EquipoHV::getDatosEnObjetos("nitCliente='".$nitCliente."'", 'ubicacion,nombreequipo asc');
$lista="";

for ($i = 0; $i < count($datos); $i++) {
	$objeto=$datos[$i];
	$lista.='<tr>';
	$lista.="<td><input type='radio' value='{$objeto->getIde()}' id='{$objeto->getIde()}' name='ideEquipo'></td>";
	$lista.="<td><label for='{$objeto->getIde()}'>{$objeto->getActivoFijo()}</label></td>";
	$lista.="<td><label for='{$objeto->getIde()}'>{$objeto->getNombreEquipo()}</label></td>";
	$lista.="<td><label for='{$objeto->getIde()}'>{$objeto->getActivoFijo()}</label></td>";
	$lista.='</tr>';
}
?>
<div id="listados">
	<table>
		<?=$lista?>
	</table>
</div>