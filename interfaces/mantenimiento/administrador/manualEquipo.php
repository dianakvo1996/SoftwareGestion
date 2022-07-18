<?php
//	$datosManuales=ConectorBD::ejecutarQuery("select count(ide) from manualEquipo where ideTipoEquipo={$objeto->getIde()}", null)[0][0];
//			document.getElementById("tcuerpo").innerHTML = arreglo;
//
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/TipoEquipo.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/ConectorBD.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/ManualEquipo.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

//Inicio Busqueda
$filtro=null;
$valor='';
if (isset($_POST['buscar'])){
    $valor=$_POST['nombreEquipo'];
$restocadena="";
    //$filtro=" nombre ilike '%{$valor}%'";
    $filtro="TRANSLATE(nombre,'ÁÉÍÓÚáéíóú','AEIOUaeiou') ilike translate('%{$valor}%','ÁÉÍÓÚáéíóú','AEIOUaeiou')";
}
//Fin Busqueda


//Inicio paginacion
	$cantidadMostrar=27;
	$totalColumnas=count(TipoEquipo::getDatosEnObjetos($filtro, 'nombre'));
	$totalRegistros=ceil($totalColumnas/$cantidadMostrar);
	$compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];

	$IncrimentNum =(($compag +1)<=$totalRegistros)?($compag +1):1;
  	$DecrementNum =(($compag -1))<1?1:($compag -1);
	
	$listaPaginacion="<a href='principal.php?CONTENIDO=mantenimiento/administrador/manualEquipo.php&pag={$DecrementNum}' title='Atrás'>◄</a>";
	$listaPaginacion.="<label> {$compag} de {$totalRegistros} </label>";
	$listaPaginacion.="<a href='principal.php?CONTENIDO=mantenimiento/administrador/manualEquipo.php&pag={$IncrimentNum}' title='Adelante'>►</a>";	

//Fin paginacion

$datos= TipoEquipo::getDatosEnObjetos($filtro, 'nombre asc  limit '.$cantidadMostrar.' offset '.(($compag-1)*$cantidadMostrar));
$lista='';
$arreglo="";
$item=1;
for ($i = 0; $i < count($datos); $i++) {
	$objeto=$datos[$i];
	$lista.="<tr id='{$objeto->getIde()}'>";
    	$lista.="<td>{$item}</td>";
    	$lista.="<td>{$objeto->getNombre()}</td>";
	$datosManuales=ManualEquipo::getDatosEnObjetos("ideTipoEquipo={$objeto->getIde()}",'ide');
	switch(count($datosManuales)){
		case '0':
			$lista.="<td>-</td>";
			$lista.="<td><a href='#modalGestion' onclick='cargarDatos(" . '"' . "{$objeto->getNombre()}" . '"' . ",{$objeto->getIde()}," . '"' . "SUBIR MANUAL" . '"' . ")' id='accionN' class='link'>Subir Manual</a></td>";
			break;
		case '1':
			$manual=new ManualEquipo('ideTipoEquipo',$objeto->getIde());
			$lista.="<td><a href='../ManualEquipo/{$manual->getRuta()}' target='_blank' class='link'>Visualización</a></td>";
			$lista.="<td><a href='#modalGestion' onclick='cargarDatos(" . '"' . "{$objeto->getNombre()}" . '"' . ",{$objeto->getIde()}," . '"' . "ACTUALIZAR MANUAL" . '"' . ")' id='accionN' class='link'>Actualizar Manual</a>";
			$lista.="<a href='#modalGestion' onclick='cargarDatos(" . '"' . "{$objeto->getNombre()}" . '"' . ",{$objeto->getIde()}," . '"' . "SUBIR MANUAL" . '"' . ")' id='accionN'><img src='../presentacion/iconos/adicionar.png' height='15px'></a></td>";
			break;
		default:
			$manual=new ManualEquipo('ideTipoEquipo',$objeto->getIde());
			$lista.="<td><a href='../ManualEquipo/{$manual->getRuta()}' target='_blank' class='link'>Visualización</a></td>";
			$lista.="<td><a href='principal.php?CONTENIDO=mantenimiento/administrador/manualEquipo.php&ideTipoEquipo={$objeto->getIde()}#modalGestion2' onclick='cargarDatos2(" . '"' . "{$objeto->getNombre()}" . '"' . ")' class='link'>Manuales</a></td>";
			break;
	}    $item++;
    $lista.='</tr>';

}
if(isset($_GET['pag']))
$pagina=$_GET['pag'];
else
$pagina='1';
$extra="";
if($lista=="") $extra="<label>No se encontraron registros de <strong>".$_POST['nombreEquipo']."</strong></label>";
?>
<div class="paginacion">
	<?=$listaPaginacion?>
</div>
<div id="listados">
	<table>
		<tr>
			<th class="tituloSuperior" colspan="4">MANUALES EQUIPOS BIOMEDICOS</th>
		</tr>
		<tr>
			<td colspan="4">
				<form method="POST">
					<input type="search" name="nombreEquipo" placeholder="Nombre Equipo" placeholder="Nombre Equipo" required>
					<button type="submit" name="buscar" >Buscar</button>
				</form>
			</td>
		</tr>
		<tr>
			<th colspan="2">NOMBRE EQUIPO</th>
			<th>MANUAL</th>
			<th><img src="../presentacion/iconos/adicionar.png" height="30px" title="Adicionar"></th>
		</tr>
		<?=$lista?>
	</table>
	<?=$extra?>
</div>
<div id="modalGestion" class="modalGestion">
  <div class="modalContenido">
    <a href="#close" title="Cerrar">X</a>
	<div class="formulario">
    	<form method="post" action="mantenimiento/administrador/manualEquipoActualizar.php"  enctype="multipart/form-data" onsubmit="bloquearEnviar()">
		<table>
			<tr>
				<th colspan="2"><label id="accion"></label></th>
			</tr>
			<tr>
				<td><label id="nombreEquipo"></label></td>
			</tr>
			<tr>
				<th colspan="2"><input type="file" name="manual" accept=".pdf" required></th>
			</tr>
			<tr>
				<td>
					<input type="hidden" name="ideEquipo" value="" id="ide">
					<input type="hidden" name="ideManual" value="" id="accionSub">
					<input type="hidden" name="accion" value="" id="accionSub">
					<input type="hidden" name="pagina" value="<?=$pagina?>">
					<input type="submit" value="" name="accionBoton" class="boton" id="accionBoton">
				</td>
			</tr>
		</table>
	</form>
	</div>
  </div>  
</div>

<div id="modalGestion2" class="modalGestion">
  <div class="modalContenido">
    <a href="#close" title="Cerrar">X</a>
	<?php
		$arreglo='';
		$datosManuales=ManualEquipo::getDatosEnObjetos("ideTipoEquipo={$ideTipoEquipo}",'ide');
		for ($j = 0; $j < count($datosManuales); $j++) {
			$objetoM=$datosManuales[$j];
			$arreglo.="<tr>";
			$arreglo.= "<td>{$objetoM->getRuta()}</td>";
        		$arreglo.= "<td><a href='#modalGestion' onclick='cargarDatos(" . '"' . "{$objeto->getNombre()}" . '"' . ",{$objeto->getIde()}," . '"' . "ACTUALIZAR MANUAL" . '"' . ")' id='accionN' class='link'>Actualizar Manual</a></td>";
			$arreglo.="</tr>";
			}
	?>
	<div class="listas">
		<table>
			<tr>
				<th colspan="2">MANUALES <label id="nombreEquipo2"></label></th>
			</tr>
			<tbody id="tcuerpo">
				<?=$arreglo?>
  			</tbody>
		</table>
    	</div>
  </div>  
</div>

<script>
	function cargarDatos(nombre,ide,accionL){
		document.getElementById('accion').innerHTML = accionL.toUpperCase()
		document.getElementById('ide').value = ide
		var indice=accionL.indexOf(" ")
		document.getElementById('accionBoton').value = accionL.substring(0, indice).toUpperCase()
		document.getElementById('accionSub').value = accionL.substring(0, indice).toUpperCase()
        	document.getElementById('nombreEquipo').innerHTML = nombre;	
	}
	function cargarDatos2(nombre){
        	document.getElementById('nombreEquipo2').innerHTML = nombre;	
	}

	function bloquearEnviar(){
		document.getElementById('accionBoton').disabled=true;
	}
	function eliminar(ide) {
        	if(confirm("¿Realmente desea eliminar Guia de Equipo?")){
            		location = 'mantenimiento/administrador/manualEquipoActualizar.php?accion=ELIMINAR&ideManual='+ide+'&pagina='+<?=$pagina?>;
         	}
	}
</script>