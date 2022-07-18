<?php

require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Sede.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$sede=new Sede('ide',$ideSede);
$datos=Equipo::getDatosEnObjetos("ideSede=$ideSede", 'ubicacion,nombreequipo asc');
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
    $lista.="<td><a href='principal.php?CONTENIDO=mantenimiento/administrador/hojaDeVidaEquipoSede.php&ideEquipo={$objeto->getIde()}&accion=ACTUALIZAR&ideSede={$ideSede}' class='enlace'>Actualizar</a>";
	$lista.="<a href='mantenimiento/administrador/hojaDeVidaEquipoVisualizar.php?ideEquipo={$objeto->getIde()}' class='enlace'>Visualizar</a></td>";
	$lista.="<td><img src='../presentacion/iconos/eliminar.png' height='30px' title='Eliminar' onclick='eliminar({$objeto->getIde()},{$ideSede})'></td>";
	$lista.='</tr>';
    $item++;
}
?>
<a href="principal.php?CONTENIDO=mantenimiento/administrador/equiposSede.php&ideSede=<?=$sede->getIde()?>" style="float: left"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
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
		<th colspan="2"><a href="principal.php?CONTENIDO=mantenimiento/administrador/hojaDeVidaEquipoSede.php&accion=ADICIONAR&ideSede=<?=$ideSede?>"><img src="../presentacion/iconos/adicionar.png" height="30px" title="Adicionar Hoja de Vida Equipo"></a></th>
	</tr>
	<?=$lista?>
</table>
</div>

<script>
	function eliminar(ideEquipo,ideSede) {
		if(confirm("Confirmacion eliminar hoja de vida")){
            location = 'mantenimiento/administrador/hojaDeVidaEquipoSedeActualizar.php?accion=Eliminar&ideEquipo='+ideEquipo+'&ideSede='+ideSede;
        }
    }

</script>
