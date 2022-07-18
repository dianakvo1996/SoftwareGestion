<?php
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/ConectorBD.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/EquipoDeBaja.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/solicitudCorrectivo.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;
date_default_timezone_set('America/Bogota');
$direccion='';
switch ($accion) {
    case 'Aceptar':
        $equipo=new Equipo('ide', $ide);
        $darBaja=new EquipoDeBaja(null, null);
        $darBaja->setFechaSistema(date('Y/m/d H:i:s'));
        $darBaja->setJustificacion($justificacion);
        $darBaja->setFechaRealizacion($fechaRealizacion);
        $darBaja->setNombreEquipo($equipo->getNombreEquipo());
        $darBaja->setMarca($equipo->getMarca());
        $darBaja->setModelo($equipo->getModelo());
        $darBaja->setSerial($equipo->getSerial());
        $darBaja->setActivoFijo($equipo->getActivoFijo());
        $darBaja->setUbicacion($equipo->getUbicacion());
        if (isset($ideSede)){
            $darBaja->setIdeSede($equipo->getIdeSede());
            $direccion='equiposSede.php&ideSede='.$equipo->getIdeSede();
            $darBaja->grabarSede();
        }else {
            $darBaja->setNitCliente($equipo->getNitCliente());
            $direccion='equiposCliente.php&nit='.$equipo->getNitCliente();
            $darBaja->grabarCliente();
        }
		$ideEquipoBaja=ConectorBD::ejecutarQuery("select max(ide) from equipodebaja",null)[0][0];
		$solicitudes= solicitudCorrectivo::getDatosEnObjetos('ideEquipo ='.$equipo->getIde(),null);
		for ($i = 0; $i < count($solicitudes); $i++) {
			$objeto=$solicitudes[$i];
			ConectorBD::ejecutarQuery("update solicitudCorrectivo set ideequipo=null, ideequipodebaja={$ideEquipoBaja} where ide={$objeto->getIde()}", null);
		}
        $equipo->Eliminar();
        break;
    default:
        break;
}
header('Location: ../../principal.php?CONTENIDO=mantenimiento/administrador/'.$direccion);