<?php

require_once dirname(__FILE__) . '/../../../clasesMantenimiento/TipoEquipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/GuiaEquipo.php';

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
	
	$listaPaginacion="<a href='principal.php?CONTENIDO=mantenimiento/administrador/guiaEquipo.php&pag={$DecrementNum}' title='Atrás'>◄</a>";
	$listaPaginacion.="<label> {$compag} de {$totalRegistros} </label>";
	$listaPaginacion.="<a href='principal.php?CONTENIDO=mantenimiento/administrador/guiaEquipo.php&pag={$IncrimentNum}' title='Adelante'>►</a>";	

//Fin paginacion

$datos= TipoEquipo::getDatosEnObjetos($filtro, 'nombre asc  limit '.$cantidadMostrar.' offset '.(($compag-1)*$cantidadMostrar));
$lista='';
$item=1;
for ($i = 0; $i < count($datos); $i++) {
	$objeto=$datos[$i];
	$guia=new GuiaEquipo('ideTipoEquipo', $objeto->getIde());
 	$lista.='<tr>';
    	$lista.="<td>{$item}</td>";
    	$lista.="<td>{$objeto->getNombre()}</td>";
	if($guia->getIde()!=null){
		$lista.="<td><a href='../GuiaRapidaEquipo/{$guia->getRuta()}' target='_blank' class='link'>Visualización</a></td>";
		$lista.="<td><a href='#modalGestion' onclick='cargarDatos(" . '"' . "{$objeto->getNombre()}" . '"' . ",{$objeto->getIde()}," . '"' . "ACTUALIZAR GUIA" . '"' . ")' id='accionN' class='link'>Actualizar Guia</a>";
		$lista.="<img src='../presentacion/iconos/eliminar.png' height='15px' onclick='eliminar({$objeto->getIde()})' title='Eliminar Guia'></td>";
	}else{
		$lista.="<td>-</td>";
		$lista.="<td><a href='#modalGestion' onclick='cargarDatos(" . '"' . "{$objeto->getNombre()}" . '"' . ",{$objeto->getIde()}," . '"' . "SUBIR GUIA" . '"' . ")' id='accionN' class='link'>Subir Guia</a></td>";
	}
    $lista.='</tr>';
    $item++;
}
if(isset($_GET['pag']))
$pagina=$_GET['pag'];
else
$pagina='1';

$extra="";
if($lista=="") $extra="No se encontraron coincidencias.";
?>
<div class="paginacion">
	<?=$listaPaginacion?>
</div>
<div id="listados">
	<table>
		<tr>
			<th class="tituloSuperior" colspan="4">GUIAS RAPIDAS EQUIPOS BIOMEDICOS</th>
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
			<th>GUIA</th>
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
    	<form method="post" action="mantenimiento/administrador/guiaRapidaActualizar.php"  enctype="multipart/form-data" onsubmit="bloquearEnviar()">
		<table>
			<tr>
				<th colspan="2"><label id="accion"></label></th>
			</tr>
			<tr>
				<td><label id="nombreEquipo"></label></td>
			</tr>
			<tr>
				<th colspan="2"><input type="file" name="guia" accept=".pdf" required></th>
			</tr>
			<tr>
				<td>
					<input type="hidden" name="ideEquipo" value="" id="ide">
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
<script>
	function cargarDatos(nombre,ide,accionL){
		document.getElementById('accion').innerHTML = accionL.toUpperCase()
		document.getElementById('ide').value = ide
		var indice=accionL.indexOf(" ")
		document.getElementById('accionBoton').value = accionL.substring(0, indice).toUpperCase()
		document.getElementById('accionSub').value = accionL.substring(0, indice).toUpperCase()
        	document.getElementById('nombreEquipo').innerHTML = nombre;	
	}

	function bloquearEnviar(){
		document.getElementById('accionBoton').disabled=true;
	}

	function eliminar(ide) {
        	if(confirm("¿Realmente desea eliminar Guia de Equipo?")){
            		location = 'mantenimiento/administrador/guiaRapidaActualizar.php?accion=ELIMINAR&ideEquipo='+ide+'&pagina='+<?=$pagina?>;
         	}
	}	
</script>