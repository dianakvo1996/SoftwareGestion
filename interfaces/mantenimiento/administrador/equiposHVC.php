<?php

require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/EquipoHV.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$cliente=new Cliente('nit', "'".$nitCliente."'");
$datos=EquipoHV::getDatosEnObjetos("nitCliente='".$nitCliente."'", 'ubicacion,nombreequipo asc');
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
    $lista.="<td><a href='principal.php?CONTENIDO=mantenimiento/administrador/hojaDeVidaEquipoCliente.php&ideEquipo={$objeto->getIde()}&accion=ACTUALIZAR&nit={$nitCliente}' class='enlace'>Actualizar</a>";
	$lista.='</tr>';
    $item++;
}

?>
<a href="principal.php?CONTENIDO=mantenimiento/administrador/equiposCliente.php&nit=<?=$cliente->getNit()?>" style="float: left"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="listados">
	<h2>HOJA DE VIDA DE EQUIPOS BIOMEDICOS</h2>
<table>
	<tr>
		<th colspan="2">CLIENTE</th>
		<td colspan="5" style="text-align:left"><?=$cliente->getNombre()?></td>
	</tr>
	<tr>
		<th>ACTIVO FIJO</th><th>NOMBRE</th><th>MARCA</th><th>MODELO</th><th>SERIAL</th><th>UBICACION</th>
		<th><a href="principal.php?CONTENIDO=mantenimiento/administrador/hojaDeVidaEquipoCliente.php&accion=ADICIONAR&nit=<?=$nitCliente?>"><img src="../presentacion/iconos/adicionar.png" height="30px" title="Adicionar Hoja de Vida Equipo"></a></th>
	</tr>
	<?=$lista?>
</table>
</div>
