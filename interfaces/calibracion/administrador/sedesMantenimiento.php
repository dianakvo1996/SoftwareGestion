<?php

require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Sede.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';


foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$cliente=new Cliente('nit', "'".$nit."'");
$datos= Sede::getConsultaCombinada("nitCliente='{$nit}' ", 'nombre');
$lista='';
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
	if($objeto->getBaja()!='SI'){
		$lista.='<tr>';
    	$lista.="<td>{$objeto->getNombre()}</td>";
    	$lista.="<td>{$objeto->getCiudad()->getNombre()}</td>";
    	$lista.="<td><a href='principal.php?CONTENIDO=calibracion/administrador/equiposSedeMntto.php&ideSede={$objeto->getIde()}' class='enlace'>Equipos</a>";
    	$lista.='</tr>'; 
	} 
}
?>

<a href="principal.php?CONTENIDO=calibracion/administrador/clientesMantenimiento.php" style="float: left"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="listados"> 
    <table>
		<tr>
			<th colspan="4" class="tituloSuperior">SEDES</th>
		</tr>
        <tr>
            <th>CLIENTE</th><td colspan="3"><?=$cliente->getNombre()?></td>	
        </tr>
    </table>
    <table>
        <tr>
            <th>NOMBRE</th>
            <th>CIUDAD</th>
            <th></th>
        </tr>
        <?=$lista?>
    </table> 
</div>
