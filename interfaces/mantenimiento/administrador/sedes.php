<?php
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Sede.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';


foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

//busqueda de Equipos en todas las sedes.
$filtro='';
$campo='';
$valor='';
$resultadoBusqueda='';
if (isset($_POST['buscar'])) {
	$valor=$_POST['valor'];
    	switch ($_POST['campo']) {
        	case 'AF':
                	$campo='activoFijo';
        		break;
        	case 'S':
                	$campo='serial';
        	break;
   	 }
	$equipo=new Equipo($campo,"'".$valor."'");
	if($equipo!=null){
   		$resultadoBusqueda=$equipo->getNombreEquipo()."  ";
		if($equipo->getIdeSede()!=null){
			$resultadoBusqueda.="esta Ubicado en ".$equipo->getSede()->getCliente()->getNombre()."  sede  ".$equipo->getSede()->getNombre();
		}
	}else{
	}

}
// fin Busqueda

$usuario=new Usuario('usuario', "'".$_SESSION['usuario']."'");

$cliente=new Cliente('nit', "'".$nit."'");
$datos= Sede::getConsultaCombinada("nitCliente='{$nit}'", 'nombre');
$lista='';
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
	if($objeto->getBaja()!='SI'){
		$lista.='<tr>';
    	$lista.="<td>{$objeto->getNombre()}</td>";
    	$lista.="<td>{$objeto->getCiudad()->getNombre()}</td>";
    	$lista.="<td><a href='principal.php?CONTENIDO=mantenimiento/administrador/equiposSede.php&ideSede={$objeto->getIde()}' class='enlace'>Equipos</a>";
    	$lista.="<a href='principal.php?CONTENIDO=mantenimiento/administrador/cronogramaSede.php&ideSede={$objeto->getIde()}' class='enlace'>Cronograma</a></td>";
   		$lista.="<th><a href='principal.php?CONTENIDO=mantenimiento/administrador/sedeFormulario.php&accion=Modificar&nit={$cliente->getNit()}&ide={$objeto->getIde()}'><img src='../presentacion/iconos/modificar.png' height='30px' title='Modificar'></a>";
    	$lista.="<img src='../presentacion/iconos/eliminar.png' onclick='eliminar({$objeto->getIde()}," . '"' . "{$cliente->getNit()}" . '"' . "," . '"' . "{$objeto->getNombre()}" . '"' . ")' height='30px' title='Eliminar'>";
		$lista.="<img src='../presentacion/iconos/baja.png' onclick='darBaja(" . '"' . "{$objeto->getNombre()}" . '"' . ",{$objeto->getIde()})' height='30px' title='Dar de Baja Sede'></th>";
    	$lista.='</tr>';  
	}
}
?>
<a href="principal.php?CONTENIDO=mantenimiento/administrador/clientes.php" style="float: left"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="listados"> 
<form method="POST">
    <table>
	<tr>
		<th colspan="4" class="tituloSuperior">SEDES</th>
	</tr>
        <tr>
            <th>CLIENTE</th><td colspan="3"><?=$cliente->getNombre()?></td>
	
        </tr>
	<tr>
		<th>Busqueda de Equipo</th>
		<td>
                    <select name="campo" id="campo">
                        <option value="AF">Activo Fijo</option>
                        <option value="S">Serial</option>
                    </select>
                </td>
		<td>
		    <input type="text" name="valor" required>
		</td>
		<td>
		    <button type="submit" class="iconBusqueda" id="buscar" name="buscar"><img src="../presentacion/iconos/buscar.png" height="20px" title="Buscar"></butto>
		</td>
	</tr>
<tr>
	<td colspan="4"><?=$resultadoBusqueda?></td>
</tr>
    </table>
</form>
    <table>
        <tr>
            <th>NOMBRE</th>
            <th>CIUDAD</th>
            <th colspan="2"><a href="principal.php?CONTENIDO=mantenimiento/administrador/sedeFormulario.php&accion=Adicionar&nit=<?=$cliente->getNit()?>"><img src="../presentacion/iconos/adicionar.png" height="30px" title="Adicionar"></a></th>
        </tr>
        <?=$lista?>
    </table> 
</div>
<script src="http://pajhome.org.uk/crypt/md5/2.2/md5-min.js"></script>

<script>
    function eliminar(ide,nitCliente,nombre) {
		var contrasena = prompt("ADVERTENCIA: Recuerde al realizar esta accion eliminará; mantenimientos, cronogramas, equipos, reportes de mantenimentos y equipos de baja de la sede : "+nombre);
		var cifrado = hex_md5(contrasena);		
		if (cifrado =="202cb962ac59075b964b07152d234b70"){
			location = 'mantenimiento/administrador/sedeActualizar.php?accion=Eliminar&ide='+ide+'&nitCliente='+nitCliente;
		}else{
			alert("!Contraseña Incorrecta¡, Intente Nuevamente");
		}
        //if(confirm("¿Realmente desea eliminar esta Sede?")){
           // location = 'mantenimiento/administrador/sedeActualizar.php?accion=Eliminar&ide='+ide+'&nitCliente='+nitCliente;
         //}
    }

	function darBaja(nombre,ide){
		if(confirm('¿Realmente desea dar de baja la sede, '+nombre+'?')){
			location = 'mantenimiento/administrador/bajaSedeActualizar.php?ideSede='+nit+'&accion=bajarS';
		}
	}
</script>