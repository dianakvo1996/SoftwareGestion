<?php
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/solicitudCorrectivo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/RespuestaSolicitud.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/LugarIC.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/EquipoDeBaja.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/Persona.php';


foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$usuario=new Usuario('usuario', "'".$_SESSION['usuario']."'");
$persona=new Persona('Usuario',"'".$_SESSION['usuario']."'");

$condicionAdicional='';
$estilo='';
//Inicio filtro busqueda
$filtro='';
$mas='';
$condicion=null;
$extension='';
if (isset($_POST['filtro'])) {
    switch ($_POST['filtro']) {
        case 'P':
		$condicion=" estado='P'";
                $mas='Pendientes';
                $extension=' and ';
        break;
        case 'R':            
            $condicion=" estado='R'";
            $mas='Ejecutadas';
            $extension=' and ';
        break;
        case 'E':            
            $condicion=" estado='E'";
            $mas='En Proceso';
            $extension=' and ';
        break;

        case 'T':
            $condicion=null;
            $mas='';
            $extension='';
        break;
    }
}
//Fin filtro busqueda

$condicionIC='';
$mostrarFiltro='';
if($usuario->getTipo()=='IC'){
	$lugar=new LugarIC('ideIngeniero',"'".$persona->getIdentificacion()."'");
	
	switch($lugar->getNitCliente()){
		case'900597845-3'://Clinica Pabon
				$condicionIC="solicitudcorrectivo.codCiudad='".$lugar->getCliente()->getCodCiudad()."'";
				$mostrarFiltro='style="display:none"';
				break;
		case'900077584RV'://Sede Valle
				$condicionIC="codDepartamento='".$lugar->getCliente()->getCiudad()->getCodDepartamento()."'";
				$mostrarFiltro='style="display:none"';
				break;
		case'900077584-HC'://UCI Valle
				$condicionIC="solicitudcorrectivo.ideSede=127";
				$mostrarFiltro='style="display:none"';
				break;
		case'900077584-HT'://Hospital Tuquerres
				$condicionIC="solicitudcorrectivo.codCiudad='".$lugar->getCliente()->getCodCiudad()."'";
				$mostrarFiltro='style="display:none"';
				break;
		default:
				$condicionIC='';
				break;
	}
}

//inicio filtro sucursal

$sede='';
if (isset($_POST['sucursal'])) {
    switch ($_POST['sucursal']) {
        case '52':
            $condicionAdicional=" {$extension} ciudad.codDepartamento='52'";
            $sede='Nariño';
            break;
        case '76':
            $condicionAdicional="{$extension} ciudad.codDepartamento='76'";
            $sede='Valle';
            break;
        default:
            $condicionAdicional="";
            $sede='Ninguna de las sedes';
            break;
    }
}

//fin filtro sucursal
$promedio = RespuestaSolicitud::getCalcularPromedioGeneral(null);

//Inicio paginacion

	$cantidadMostrar=16;
	$totalColumnas=count(solicitudCorrectivo::getConsultaTablaCombinada($condicion.$condicionAdicional.$condicionIC, 'fecha desc'));
	$totalRegistros=ceil($totalColumnas/$cantidadMostrar);
	$compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];

	$IncrimentNum =(($compag +1)<=$totalRegistros)?($compag +1):1;
  	$DecrementNum =(($compag -1))<1?1:($compag -1);
	
	$listaPaginacion="<a href='principal.php?CONTENIDO=mantenimiento/administrador/bandejaEntrada.php&pag={$DecrementNum}' title='Atrás'>◄</a>";
	$listaPaginacion.="<label> {$compag} de {$totalRegistros} </label>";
	$listaPaginacion.="<a href='principal.php?CONTENIDO=mantenimiento/administrador/bandejaEntrada.php&pag={$IncrimentNum}' title='Adelante'>►</a>";	

//Fin paginacion
$datos= solicitudCorrectivo::getConsultaTablaCombinada($condicion.$condicionAdicional.$condicionIC, 'fecha desc limit '.$cantidadMostrar.' offset '.(($compag-1)*$cantidadMostrar));
$lista='';

for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];   
    $respuesta=new RespuestaSolicitud('ideSolicitud', $objeto->getIde());
    $lista.='<tr>';
    $lista.="<td>{$objeto->getMostrarFecha()}</td>";
    if ($objeto->getIdeSede()!=null) {		
        $sede=$objeto->getSede()->getNombre();
        $cliente=$objeto->getSede()->getCliente()->getNombre();
        $ciudad=$objeto->getSede()->getCiudad()->getNombre();
    }else{
        $sede=$objeto->getCliente()->getNombre();
        $cliente=$objeto->getCliente()->getNombre();
        $ciudad=$objeto->getCiudad()->getNombre();
    }
//$lista.="<td>{$objeto->getIde()}</td>";
    $lista.="<td>{$cliente}</td>";
    $lista.="<td>{$sede}</td>";
    $lista.="<td>{$ciudad}</td>";

	if($objeto->getIdeEquipo()!=null){
		$lista.="<td>{$objeto->getEquipo()->getNombreEquipo()}</td>";
    	$lista.="<td>{$objeto->getEquipo()->getActivoFijo()}</td>";
	}else{
		$lista.="<td>{$objeto->getEquipoDeBaja()->getNombreEquipo()}</td>";
    	$lista.="<td>{$objeto->getEquipoDeBaja()->getActivoFijo()}</td>";
	}
    
    $lista.="<td>{$respuesta->getCalcularTiempoRespuesta($objeto->getFecha(),$respuesta->getFechaRealizacion())}</td>";
    switch ($respuesta->getEstado()) {
        case 'R':
            $estado="<a href='principal.php?CONTENIDO=mantenimiento/administrador/visualizacionSolicitud.php&ideSolicitud={$objeto->getIde()}' style='background:#61F955;color:#000' class='enlace'>Ejecutado</a>";
            break;
        case 'P':
            $estado="<a href='principal.php?CONTENIDO=mantenimiento/administrador/respuestaSolicitud.php&ideSolicitud={$objeto->getIde()}'><label style='background:#E34321;color:#fff' class='enlace'>Responder</label></a>";
            break;
        case 'E':
            $estado="<a href='principal.php?CONTENIDO=mantenimiento/administrador/respuestaSolicitud.php&ideSolicitud={$objeto->getIde()}'><label style='background:#3230C4;color:#fff;font-size:12px' class='enlace'>En Proceso</label></a>";
            break;
        default:
            $estado="<a href='principal.php?CONTENIDO=mantenimiento/administrador/respuestaSolicitud.php&ideSolicitud={$objeto->getIde()}'><label style='background:#E34321;color:#fff' class='enlace'>Responder</label></a>";
            break;
    }
    $lista.="<td>{$estado}</td>";
    $lista.='</tr>';
}
$falta='';
if ($lista==''){
    $falta ='<h2>No hay solicitudes '.$mas.' '.$sede.'</h2>';
}
//onchange="this.form.submit()"
?>
<div id="listados">
    <img src="../presentacion/iconos/solicitudes.png" width="50px">
    <h2>SOLICITUDES MANTENIMIENTO</h2> 
    <form method="POST">
        <table <?=$mostrarFiltro?>>
            <tr>
                <th>Filtros</th>
                <td>                
                    <input type="radio" value="T" id="T" name="filtro" required="true"><label for="T">Todos</label>
                    <input type="radio" value="P" id="P" name="filtro"><label for="P">Pendientes</label>
					<input type="radio" value="E" id="E" name="filtro"><label for="E">En Proceso</label>
                    <input type="radio" value="R" id="R" name="filtro"><label for="R">Ejecutados</label>           
                </td>
                <td>
                    <select name="sucursal">
                        <option value="0">**Seleccione Sede**</option>
                        <option value="52">Nariño</option>
                        <option value="76">Valle</option>
                        <option value="1">Todos</option>
                    </select>
                </td>
                <th>
                    <button type="submit">Filtrar</button>
                </th>
            </tr>
			<tr>
				<th colspan="2">Promedio Total de Respuesta:</th><td colspan="2"><?=$promedio?></td>
			</tr>
        </table>
    </form>
    <table>
        <tr>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Sede</th>
            <th>Ciudad</th>
            <th>Equipo</th>
            <th>Activo Fijo</th>
            <th>Tiempo<br>Respuesta</th>
            <td><?=$listaPaginacion?></td>
        </tr>
        <?=$lista?>
    </table>
    <?=$falta?>
</div>