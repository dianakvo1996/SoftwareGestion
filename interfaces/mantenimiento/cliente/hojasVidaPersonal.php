<?php
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/HojaDeVida.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/PermisoHojaVida.php';

$cliente=new Cliente('usuario', "'".$_SESSION['usuario']."'");

$permiso=new PermisoHojaVida('nitCliente',"'{$cliente->getNit()}'");

switch($permiso->getPermiso()){
	case '1':
		$filtro="area='M' and codCiudad='{$cliente->getCodCiudad()}'";
		break;
	case '2':
		$filtro="area='K'";
		break;
	case '3':
		$filtro=null;
		break;
	default:
		$filtro="area='H'";
		break;

}
$datos = HojaDeVida::getDatosEnObjetos($filtro, 'area,nombre asc');
$lista='';
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
	switch($objeto->getArea()){
		case 'M':
			if ($objeto->getCodCiudad()==$cliente->getCodCiudad()){
				$lista.='<tr>';
    			$lista.="<td>{$objeto->getNombre()}</td>";
    			$lista.="<td>{$objeto->getCargo()}</td>";
    			$lista.="<td>{$objeto->getAreaLista()}</td>";
    			$lista.="<td><a href='principal.php?CONTENIDO=mantenimiento/cliente/documentosGestion.php&CONTENIDOV=mantenimiento/cliente/visualizacionBloqueoHV.php&ruta={$objeto->getRuta()}' class='enlace'>Visualizar</a></td>";
    			$lista.='</tr>';
			}
			break;
		case 'K':
			$lista.='<tr>';
    		$lista.="<td>{$objeto->getNombre()}</td>";
    		$lista.="<td>{$objeto->getCargo()}</td>";
    		$lista.="<td>{$objeto->getAreaLista()}</td>";
    		$lista.="<td><a href='principal.php?CONTENIDO=mantenimiento/cliente/documentosGestion.php&CONTENIDOV=mantenimiento/cliente/visualizacionBloqueoHV.php&ruta={$objeto->getRuta()}' class='enlace'>Visualizar</a></td>";
    		$lista.='</tr>';
			break;
	}
}
?>
<div id="listados">
	<h2>HOJAS DE VIDA PERSONAL BIOMÉDICO</h2>
    <table>
        <tr>
            <th>NOMBRE</th>
            <th>CARGO</th>
            <th>PROCESO</th>
			<th></th>
        </tr>
        <?=$lista?>
    </table>

</div>