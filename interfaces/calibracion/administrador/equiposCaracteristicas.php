<?php
require_once dirname(__FILE__) . '/../../../clasesCalibracion/NombreEquipo.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable => $Valor) ${$Variable} = $Valor;

$datos=NombreEquipo::getDatosEnObjetos(null,'nombre asc');
$lista='';
$item=1;

for ($i = 0; $i < count($datos); $i++) {
	$objeto=$datos[$i];
	$lista.='<tr>';
	$lista.="<td>{$item}</td>";
	$lista.="<td>{$objeto->getNombre()}</td>";
	$lista.="<td>{$objeto->getTipoLista()}</td>";
	$lista.="<td>{$objeto->getClasificacionBiomedicaLista()}</td>";
	$lista.="<td><a href='principal.php?CONTENIDO=calibracion/administrador/caracteristicasFormulario.php&accion=Modificar&ide={$objeto->getIde()}'><img src='../presentacion/iconos/modificar.png' height='33px' title='Modificar'></a>";
	$lista.="    <img src='../presentacion/iconos/eliminar.png' onclick='eliminar({$objeto->getIde()})' height='33px' title='Eliminar'></td>";
	$lista.='</tr>';	
	$item++;
}
?>
<div id="listados">
	<br>
	<h1>CARACTERISTICAS EQUIPOS</h1>
	<br>
	<table>
		<tr>
			<th colspan="2">NOMBRE</th>
			<th>TIPO</th>
			<th>CLASIFICACION BIOMEDICA</th>
			<th>
				<a href="principal.php?CONTENIDO=calibracion/administrador/caracteristicasFormulario.php&accion=Adicionar">
                    <img src="../presentacion/iconos/adicionar.png" height="60px" title="Adicionar">
                </a>
			</th>
		</tr>
		<?=$lista?>
	</table>		
</div>
<script>
	 function eliminar(ide) {
        if(confirm("¿Realmente desea eliminar este Equipo?")){
            location = 'calibracion/administrador/caracteristicasActualizar.php?accion=Eliminar&ide='+ide;
         }
    }
</script>
