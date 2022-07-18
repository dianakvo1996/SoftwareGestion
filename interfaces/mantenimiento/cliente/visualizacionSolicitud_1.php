<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/solicitudCorrectivo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/RespuestaSolicitud.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$solicitud=new solicitudCorrectivo('ide', $ideSolicitud);
$respuestaSolicitud=new RespuestaSolicitud('ideSolicitud', $solicitud->getIde());
switch ($respuestaSolicitud->getEstado()) {
    case 'R':
        $estado='<label style="color:#008C09">Ejecutado</label>';
        break;
    case 'P':
        $estado='<label style="color:#FF5733">Pendiente</label>';
        break;
    case 'E':
        $estado='<label style="color:#3230C4">En Proceso</label>';
        break;

}

if ($solicitud->getNitCliente()!=null){
    $cliente=$solicitud->getCliente()->getNombre();
    $sede=$solicitud->getCliente()->getNombre();    
}else{
    $cliente=$solicitud->getSede()->getCliente()->getNombre();
    $sede=$solicitud->getSede()->getNombre();
}
$ruta='No Adjuntada';
if ($solicitud->getFotografia()!='') {
    $ruta="<img src='../FotografiasCorrectivos/{$solicitud->getFotografia()}' height='200px'>";
}

$ruta2='';
if ($respuestaSolicitud->getEvidencia()!='') {
	$archivo=explode(".",$respuestaSolicitud->getEvidencia());
	$extension=$archivo[1];
	switch($extension){
		case'pdf':
			$ruta2="<a href='../EvidenciasCorrectivos/{$respuestaSolicitud->getEvidencia()}' target='_blank' style='color:red'>VISUALIZAR PDF</a>";
		break;
		default:
			$ruta2="<a href='principal.php?CONTENIDO=mantenimiento/cliente/visualizacionSolicitud_1.php&ideSolicitud={$ideSolicitud}#visor'><img src='../EvidenciasCorrectivos/{$respuestaSolicitud->getEvidencia()}' height='200px'></a>";
		break;
	}
    
}


$NOTA='';
if($solicitud->getIdeEquipo()!=null){
	$activoFijo=$solicitud->getEquipo()->getActivoFijo();
    $nombreEquipo=$solicitud->getEquipo()->getNombreEquipo();
	$marca=$solicitud->getEquipo()->getMarca();
	$modelo=$solicitud->getEquipo()->getModelo();
	$ubicacion=$solicitud->getEquipo()->getUbicacion();
	$serie=$solicitud->getEquipo()->getSerial();
}else{
	$activoFijo=$solicitud->getEquipoDeBaja()->getActivoFijo();
	$nombreEquipo=$solicitud->getEquipoDeBaja()->getNombreEquipo();
	$marca=$solicitud->getEquipoDeBaja()->getMarca();
	$modelo=$solicitud->getEquipoDeBaja()->getModelo();
	$ubicacion=$solicitud->getEquipoDeBaja()->getUbicacion();
	$serie=$solicitud->getEquipoDeBaja()->getSerial();
$NOTA="<h4 style='color:red'>EQUIPO DE BAJA</h4>";

}


?>
<a href="principal.php?CONTENIDO=mantenimiento/cliente/solicitudesCorrectivoSede.php&ideSede=<?=$solicitud->getIdeSede()?>" style="float: left"><img src="../presentacion/iconos/atras.png" title="Volver" height="30px"></a>
<div id="formulario">
    <center>
<?=$NOTA?>
    <table>
        <tr>
            <th colspan="2">DETALLES SOLICITUD MANTENIMIENTO CORRECTIVO</th>
            <th colspan="2">DETALLES RESPUESTA</th>
        </tr>
        <tr>
            <th>FECHA</th>
            <td><?=$solicitud->getFecha()?></td>
            <th>FECHA EJECUCIÓN</th>
            <td><?=$respuestaSolicitud->getMostrarFecha()?></td>
        </tr>
        <tr>
            <th>CLIENTE</th>
            <td><?=$cliente?></td>
            <th>ESTADO</th>
            <td><?=$estado?><td>
        </tr>
        <tr>
            <th>SEDE</th>
            <td><?=$sede?></td>
            <th>RESPUESTA</th>
            <td><?=$respuestaSolicitud->getRespuesta()?></td>
        </tr>
        <tr>
            <th>INFORMACION EQUIPO</th>
            <td>
                    <strong>Activo Fijo: </strong><?=$activoFijo?><br>
                    <strong>Equipo: </strong><?=$nombreEquipo?><br>
                    <strong>Marca: </strong><?=$marca?><br>
                    <strong>Modelo: </strong><?=$modelo?><br>
                    <strong>Ubicación: </strong><?=$ubicacion?><br>
                    <strong>Serie: </strong><?=$serie?>
            </td>
            <th>EVIDENCIA</th>
            <td>
				<?=$ruta2?>
            </td>
        </tr>
        <tr>
            <th>SOLICITANTE</th>
            <td><?=$solicitud->getSolicitante()?></td>
        </tr>
        <tr>
            <th>CARGO</th>
            <td><?=$solicitud->getCargo()?></td>
        </tr>
        <tr>
            <th>DETALLES DE DAÑO</th>
            <td><?=$solicitud->getDetalle()?></td>
        </tr>
    </table>
    </center>
</div>

<div id="visor" class="modalDialog">
    <div>
        <a href="#close" title="Cerrar" class="close">X</a>
			<div id="visor">
        		<center>
					<img src="../EvidenciasCorrectivos/<?=$respuestaSolicitud->getEvidencia()?>" height="570px">
				</center>
			</div>
    </div>
</div>
