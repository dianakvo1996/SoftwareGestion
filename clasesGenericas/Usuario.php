<?php
require_once dirname(__FILE__). '/ConectorBD.php';
require_once dirname(__FILE__). '/Ciudad.php';
require_once dirname(__FILE__). '/Ciudad.php';
require_once dirname(__FILE__) . '/../clasesCalidad/Persona.php';
require_once dirname(__FILE__) . '/../clasesMantenimiento/LugarIC.php';


class Usuario {

    private $usuario;
    private $clave;
    private $tipo;   
    private $acceso;   

    function __construct($campo, $valor) {

        if ($campo != null) {
            if (is_array($campo))
                $this->cargarAtributos($campo);
            else {
                $cadenaSQL = "select * from usuario where $campo=$valor";
                $datos = ConectorBD::ejecutarQuery($cadenaSQL, NULL);
                if (count($datos) > 0)
                    $this->cargarAtributos($datos[0]);
            }
        }
    }

    public function cargarAtributos($datos) {
        $this->usuario = $datos['usuario'];
        $this->clave = $datos['clave'];
        $this->tipo = $datos['tipo']; 
        $this->acceso = $datos['acceso'];        
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getClave() {
        return $this->clave;
    }

    function getTipo() {
        return $this->tipo;
    }
    function getCodCiudad() {
        return $this->codCiudad;
    }

    function getAcceso() {
        return $this->acceso;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    function setAcceso($acceso) {
        $this->acceso= $acceso;
    }

    function setTipo($rol) {
        $this->tipo = $rol;
    }

    public static function getTipoEnOptions($predeterminado) {
        $opciones='';
        switch ($predeterminado) {
            case 'A':
                $opciones.='<option value="">--Seleccione--</option>';
                $opciones.='<option value="A" selected="">Administrador</option>';
                $opciones.='<option value="CM">Coordinador de Mantenimento</option>';
				$opciones.='<option value="IM">Ingeniero de Mantenimento</option>';
				$opciones.='<option value="CC">Coordinador de Calibracion</option>';
				$opciones.='<option value="M">Metrologo</option>';
				$opciones.='<option value="AM">Auxiliar Metrologo</option>';
				$opciones.='<option value="O">otro</option>';
            break;
            case 'CM':
                $opciones.='<option value="">--Seleccione--</option>';
                $opciones.='<option value="A">Administrador</option>';
                $opciones.='<option value="CM" selected="">Coordinador de Mantenimento</option>';
				$opciones.='<option value="IM">Ingeniero de Mantenimento</option>';
				$opciones.='<option value="CC">Coordinador de Calibracion</option>';
				$opciones.='<option value="M">Metrologo</option>';
				$opciones.='<option value="AM">Auxiliar Metrologo</option>';
				$opciones.='<option value="O">otro</option>';

            break;
            case 'IM':
                $opciones.='<option value="">--Seleccione--</option>';
                $opciones.='<option value="A">Administrador</option>';
                $opciones.='<option value="CM">Coordinador de Mantenimento</option>';
		$opciones.='<option value="IM" selected="">Ingeniero de Mantenimento</option>';
		$opciones.='<option value="CC">Coordinador de Calibracion</option>';
		$opciones.='<option value="M">Metrologo</option>';
		$opciones.='<option value="AM">Auxiliar Metrologo</option>';
		$opciones.='<option value="O">otro</option>';

            break;
            case 'CC':
                $opciones.='<option value="">--Seleccione--</option>';
                $opciones.='<option value="A">Administrador</option>';
                $opciones.='<option value="CM">Coordinador de Mantenimento</option>';
		$opciones.='<option value="IM">Ingeniero de Mantenimento</option>';
		$opciones.='<option value="CC" selected="">Coordinador de Calibracion</option>';
		$opciones.='<option value="M">Metrologo</option>';
		$opciones.='<option value="AM">Auxiliar Metrologo</option>';
		$opciones.='<option value="O">otro</option>';
            break;
	    case 'M':
                $opciones.='<option value="">--Seleccione--</option>';
                $opciones.='<option value="A">Administrador</option>';
                $opciones.='<option value="CM">Coordinador de Mantenimento</option>';
		$opciones.='<option value="IM">Ingeniero de Mantenimento</option>';
		$opciones.='<option value="CC" selected="">Coordinador de Calibracion</option>';
		$opciones.='<option value="M" selected="">Metrologo</option>';
		$opciones.='<option value="AM">Auxiliar Metrologo</option>';
		$opciones.='<option value="O">otro</option>';
            break;
	    case 'AM':
                $opciones.='<option value="">--Seleccione--</option>';
                $opciones.='<option value="A">Administrador</option>';
                $opciones.='<option value="CM">Coordinador de Mantenimento</option>';
		$opciones.='<option value="IM">Ingeniero de Mantenimento</option>';
		$opciones.='<option value="CC" selected="">Coordinador de Calibracion</option>';
		$opciones.='<option value="M" >Metrologo</option>';
		$opciones.='<option value="AM" selected="">Auxiliar Metrologo</option>';
		$opciones.='<option value="O">otro</option>';
            break;
	    case 'O':
                $opciones.='<option value="">--Seleccione--</option>';
                $opciones.='<option value="A">Administrador</option>';
                $opciones.='<option value="CM">Coordinador de Mantenimento</option>';
		$opciones.='<option value="IM">Ingeniero de Mantenimento</option>';
		$opciones.='<option value="CC" selected="">Coordinador de Calibracion</option>';
		$opciones.='<option value="M" >Metrologo</option>';
		$opciones.='<option value="AM">Auxiliar Metrologo</option>';
		$opciones.='<option value="O" selected="">otro</option>';
            break;
            default:
                $opciones.='<option value="">--Seleccione--</option>';
                $opciones.='<option value="A">Administrador</option>';
                $opciones.='<option value="CM">Coordinador de Mantenimento</option>';
		$opciones.='<option value="IM">Ingeniero de Mantenimento</option>';
		$opciones.='<option value="CC">Coordinador de Calibracion</option>';
		$opciones.='<option value="M">Metrologo</option>';
		$opciones.='<option value="AM">Auxiliar Metrologo</option>';
		$opciones.='<option value="O">otro</option>';
            break;            
        }
        return $opciones;
    }
	public static function getTipoMantenimiento($predeterminado){
		$opciones='';
		switch ($predeterminado) {
			case 'IM':
				$opciones.='<option value="">--Seleccione--</option>';
				$opciones.='<option value="IM" selected>INGENIERO DE MANTENIMIENTO</option>';
				$opciones.='<option value="IC">INGENIERO DE CAMPO</option>';
				break;
			case 'IC':
				$opciones.='<option value="">--Seleccione--</option>';
				$opciones.='<option value="IM">INGENIERO DE MANTENIMIENTO</option>';
				$opciones.='<option value="IC" selected>INGENIERO DE CAMPO</option>';
				break;
			default:
				$opciones.='<option value="">--Seleccione--</option>';
				$opciones.='<option value="IM">INGENIERO DE MANTENIMIENTO</option>';
				$opciones.='<option value="IC">INGENIERO DE CAMPO</option>';
				break;
		}
	return $opciones;
	}
    public function getTipoLista($predeterminado){
	$lista='';
	switch ($predeterminado) {	    
            case 'A':
		$lista='Administrador';
		break;
	    case 'CM':
		$lista='Coordinador de Mantenimiento';
		break;
	    case 'IM':
		$lista='Ingeniero Mantenimiento';
		break;
	    case 'CC':
		$lista='Coordinador Calibración';
		break;
	    case 'M':
		$lista='Metrólogo';
		break;
	    case 'M':
		$lista='Auxiliar Metrología';
		break;
	    case 'O':
		$lista='Otro';
		break;
	    case 'IC':
			$lista='Ingeniero de Campo';
		break;

	}
	return $lista;

    }
    public function grabar() {
        $cadenaSQL = "insert into usuario(usuario, clave, tipo) values ('{$this->getUsuario()}', md5('{$this->getClave()}'), '{$this->getTipo()}')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }

    public function modificar($usuarioAnterior) {
        $cadenaSQL = "update usuario set usuario='{$this->getUsuario()}', clave='{$this->getClave()}', tipo='{$this->tipo}' where usuario='{$usuarioAnterior}'";
        ConectorBD::ejecutarQuery($cadenaSQL, null);        
    }

    public function eliminar() {
        $cadenaSQL = "delete from usuario where usuario = '$this->usuario'";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
        
    }

    public static function validar($usuario, $clave) {
        $validar = null;
        $usuario = new Usuario("usuario", "'$usuario'");
        if ($usuario->getUsuario() != null) {
            if ($usuario->getClave() == md5($clave))
                $validar = $usuario;
        }
        return $validar;
    }
    public static function getNumeroNotificaciones($usuario) {
	$persona=new Persona('usuario',"'".$usuario."'");
	$usuario=new Usuario('usuario',"'".$usuario."'");
	$condicionIC=null;
	if($usuario->getTipo()=='IC'){
	$lugar=new LugarIC('ideIngeniero',"'".$persona->getIdentificacion()."'");
	
	switch($lugar->getNitCliente()){
		case'900597845-3'://Clinica Pabon
				$condicionIC=" and solicitudcorrectivo.codCiudad='".$lugar->getCliente()->getCodCiudad()."'";
		$mostrarFiltro='style="display:none"';
				break;
		case'900077584RV'://Sede Valle
				$condicionIC="and solicitudcorrectivo.codCiudad='".$lugar->getCliente()->getCodCiudad()."'";
				$mostrarFiltro='style="display:none"';
				break;
		case'900077584-HC'://UCI Valle
				$condicionIC="and solicitudcorrectivo.ideSede=127";
				$mostrarFiltro='style="display:none"';
				break;
		case'900077584-HT'://Hospital Tuquerres
				$condicionIC="and solicitudcorrectivo.codCiudad='".$lugar->getCliente()->getCodCiudad()."'";
				$mostrarFiltro='style="display:none"';
				break;
		default:
				$condicionIC='';
				break;
	}
}
	
		$cadenaSQL="select count(respuestaSolicitud.ide) from respuestaSolicitud,solicitudCorrectivo,ciudad where respuestaSolicitud.ideSolicitud=solicitudCorrectivo.ide and solicitudCorrectivo.codCiudad=ciudad.codigo and estado='P' {$condicionIC}";
		$numeroNotificacion= ConectorBD::ejecutarQuery($cadenaSQL, null)[0][0];
        return $numeroNotificacion;
    }

    public static function getMenuCalidad($tipo) {
        $menu='';       
        switch ($tipo) {
            case "A":                
				$menu.='<div class="contenedorGeneral"><a href="principal.php?CONTENIDO=calidad/administrador/inicio.php"><div class="logoInterior"><img src="../presentacion/iconos/mapaProcesos.png" width="30px" title="Mapa de Procesos"></div><label class="texto">MAPA DE PROCESOS</label></a></div>';        
				$menu.='<div class="contenedorGeneral"><a href="principal.php?CONTENIDO=calidad/administrador/usuarios.php"><div class="logoInterior"><img src="../presentacion/iconos/registroU.png" width="30px" title="Usuarios"></div><label class="texto">USUARIOS</label></a></div>';        
				$menu.='<div class="contenedorGeneral"><a href="principal.php?CONTENIDO=calidad/administrador/procesos.php"><div class="logoInterior"><img src="../presentacion/iconos/procesos.png" width="30px" title="Procesos"></div><label class="texto">PROCESOS</label></a></div>';        
				$menu.='<div class="contenedorGeneral"><a href="principal.php?CONTENIDO=calidad/administrador/clientes.php"><div class="logoInterior"><img src="../presentacion/iconos/documentoGestion.png" width="30px" title="Documentos de Gestion"></div><label class="texto">DOCUMENTOS DE GESTION</label></a></div>';        
            break;
            default: 
				$menu.='<div class="contenedorGeneral"><a href="principal.php?CONTENIDO=calidad/otro/inicio.php"><div class="logoInterior"><img src="../presentacion/iconos/mapaProcesos.png" width="30px" title="Mapa de Procesos"></div><label class="texto">MAPA DE PROCESOS</label></a></div>';                                            
            break;
            }
            return $menu;
    }
    public static function getMenuMantenimiento($usuario) {
        $menu='';
        $color='#000';
        $imagen='<img src="../presentacion/iconos/notificacion.png" height="30px" title="Solicitudes Correctivos">';
        $numeroNotificaciones= Usuario::getNumeroNotificaciones($usuario);
        if ($numeroNotificaciones>0) {
            $color='red';
            $imagen='<img src="../presentacion/iconos/notificacionActiva.png" height="30px" title="Solicitudes Correctivos">';
        }
        $usuario=new Usuario('usuario', "'{$usuario}'");
	$resto='<section><a href="principal.php?CONTENIDO=mantenimiento/administrador/guiaEquipo.php" title="Guias">GUIAS RAPIDAS</a></section><section><a href="principal.php?CONTENIDO=mantenimiento/administrador/manualEquipo.php" title="Manuales">MANUALES</a></section>';
        switch ($usuario->getTipo()) {
            case 'A':
                $menu.='<div class="contenedorGeneral"><a href="principal.php?CONTENIDO=mantenimiento/administrador/clientes.php"><div class="logoInterior"><img src="../presentacion/iconos/cliente.png" width="30px" title="Listado de Clientes"></div><label class="texto">CLIENTES</label></a></div>';
                $menu.='<div class="desplegar"><div class="contenedorGeneral"><a href="principal.php?CONTENIDO=mantenimiento/administrador/tiposEquipos.php"><div class="logoInterior"><img src="../presentacion/iconos/equipo.png" width="30px" title="Tipos de Equipos"></div><label class="texto">TIPOS DE EQUIPOS</label></a></div>'.$resto.'</div>';
                $menu.='<div class="contenedorGeneral"><a href="principal.php?CONTENIDO=mantenimiento/administrador/usuario.php"><div class="logoInterior"><img src="../presentacion/iconos/registroU.png" width="30px" title="Registro de usuarios"></div><label class="texto">REGISTRO DE USUARIOS</label></a></div>'; 
				$menu.='<div class="contenedorGeneral"><a href="principal.php?CONTENIDO=mantenimiento/administrador/bandejaEntrada.php"><div class="logoInterior">'.$imagen.'</div><label class="texto" style="color:'.$color.'">SOLICITUDES CORRECTIVOS-'.$numeroNotificaciones.'</label></a></div>';
                $menu.='<div class="contenedorGeneral"><a href="principal.php?CONTENIDO=mantenimiento/administrador/fabricantes.php"><div class="logoInterior"><img src="../presentacion/iconos/fabricante.png" width="30px" title="Gestion de Fabricantes"></div><label class="texto">FABRICANTES/PROVEEDORES</label></a></div>';
                break;
	    case 'CM':
                $menu.='<div class="contenedorGeneral"><a href="principal.php?CONTENIDO=mantenimiento/administrador/clientes.php"><div class="logoInterior"><img src="../presentacion/iconos/cliente.png" width="30px" title="Listado de Clientes"></div><label class="texto">CLIENTES</label></a></div>';
				$menu.='<div class="desplegar"><div class="contenedorGeneral"><a href="principal.php?CONTENIDO=mantenimiento/administrador/tiposEquipos.php"><div class="logoInterior"><img src="../presentacion/iconos/equipo.png" width="30px" title="Tipos de Equipos"></div><label class="texto">TIPOS DE EQUIPOS</label></a></div>'.$resto.'</div>';
                $menu.='<div class="contenedorGeneral"><a href="principal.php?CONTENIDO=mantenimiento/administrador/usuario.php"><div class="logoInterior"><img src="../presentacion/iconos/registroU.png" width="30px" title="Registro de usuarios"></div><label class="texto">REGISTRO DE USUARIOS</label></a></div>'; 
				$menu.='<div class="contenedorGeneral"><a href="principal.php?CONTENIDO=mantenimiento/administrador/bandejaEntrada.php"><div class="logoInterior">'.$imagen.'</div><label class="texto" style="color:'.$color.'">SOLICITUDES CORRECTIVOS-'.$numeroNotificaciones.'</label></a></div>';
                $menu.='<div class="contenedorGeneral"><a href="principal.php?CONTENIDO=mantenimiento/administrador/fabricantes.php"><div class="logoInterior"><img src="../presentacion/iconos/fabricante.png" width="30px" title="Gestion de Fabricantes"></div><label class="texto">FABRICANTES/PROVEEDORES</label></a></div>';
				break;
            case 'IM':
                $menu.='<div class="contenedorGeneral"><a href="principal.php?CONTENIDO=mantenimiento/administrador/clientes.php"><div class="logoInterior"><img src="../presentacion/iconos/cliente.png" width="30px" title="Listado de Clientes"></div><label class="texto">CLIENTES</label></a></div>';
               	$menu.='<div class="desplegar"><div class="contenedorGeneral"><a href="principal.php?CONTENIDO=mantenimiento/administrador/tiposEquipos.php"><div class="logoInterior"><img src="../presentacion/iconos/equipo.png" width="30px" title="Tipos de Equipos"></div><label class="texto">TIPOS DE EQUIPOS</label></a></div>'.$resto.'</div>';
				$menu.='<div class="contenedorGeneral"><a href="principal.php?CONTENIDO=mantenimiento/administrador/bandejaEntrada.php"><div class="logoInterior">'.$imagen.'</div><label class="texto" style="color:'.$color.'">SOLICITUDES CORRECTIVOS-'.$numeroNotificaciones.'</label></a></div>';
                $menu.='<div class="contenedorGeneral"><a href="principal.php?CONTENIDO=mantenimiento/administrador/fabricantes.php"><div class="logoInterior"><img src="../presentacion/iconos/fabricante.png" width="30px" title="Gestion de Fabricantes"></div><label class="texto">FABRICANTES/PROVEEDORES</label></a></div>';                
				break;
	    case 'IC':
                $menu.='<div class="contenedorGeneral"><a href="principal.php?CONTENIDO=mantenimiento/administrador/clientes.php"><div class="logoInterior"><img src="../presentacion/iconos/cliente.png" width="30px" title="Listado de Clientes"></div><label class="texto">CLIENTES</label></a></div>';
				$menu.='<div class="desplegar"><div class="contenedorGeneral"><a href="principal.php?CONTENIDO=mantenimiento/administrador/tiposEquipos.php"><div class="logoInterior"><img src="../presentacion/iconos/equipo.png" width="30px" title="Tipos de Equipos"></div><label class="texto">TIPOS DE EQUIPOS</label></a></div>'.$resto.'</div>';		$menu.='<div class="contenedorGeneral"><a href="principal.php?CONTENIDO=mantenimiento/administrador/bandejaEntrada.php"><div class="logoInterior">'.$imagen.'</div><label class="texto" style="color:'.$color.'">SOLICITUDES CORRECTIVOS-'.$numeroNotificaciones.'</label></a></div>';
                $menu.='<div class="contenedorGeneral"><a href="principal.php?CONTENIDO=mantenimiento/administrador/fabricantes.php"><div class="logoInterior"><img src="../presentacion/iconos/fabricante.png" width="30px" title="Gestion de Fabricantes"></div><label class="texto">FABRICANTES/PROVEEDORES</label></a></div>';
				break;
            case 'C':
                $menu.='<div class="contenedorGeneral"><a href="principal.php?CONTENIDO=mantenimiento/cliente/inicio.php"><div class="logoInterior"><img src="../presentacion/iconos/inicio.png" width="30px" title="Inicio"></div><label class="texto">INICIO</label></a></div>';
                break;
        }
        return $menu;
    }
    public static function getMenuCalibracion($tipo) {
        $menu='';
        switch ($tipo) {
            case 'A':
                $menu.='<div class="contenedorGeneral"><a href="principal.php?CONTENIDO=calibracion/administrador/clientes.php"><div class="logoInterior"><img src="../presentacion/iconos/cliente.png" width="30px" title="Listado de Clientes"></div><label class="texto">CLIENTES</label></a></div>';
				$menu.='<div class="contenedorGeneral"><a href="principal.php?CONTENIDO=calibracion/administrador/equiposCaracteristicas.php"><div class="logoInterior"><img src="../presentacion/iconos/equipo.png" width="30px" title="Tipos de Equipos"></div><label class="texto">TIPOS DE EQUIPOS</label></a></div>';
                $menu.='<div class="contenedorGeneral"><a href="principal.php?CONTENIDO=calibracion/administrador/clientesMantenimiento.php"><div class="logoInterior"><img src="../presentacion/iconos/cliente.png" width="30px" title="Clientes Mantenimiento"></div><label class="texto">CLIENTES MANTENIMIENTO</label></a></div>';
				break;
            case 'K':
                $menu.='<div class="contenedorGeneral"><a href="principal.php?CONTENIDO=calibracion/administrador/clientes.php"><div class="logoInterior"><img src="../presentacion/iconos/cliente.png" width="30px" title="Listado de Clientes"></div><label class="texto">CLIENTES</label></a></div>';
				$menu.='<div class="contenedorGeneral"><a href="principal.php?CONTENIDO=calibracion/administrador/equiposCaracteristicas.php"><div class="logoInterior"><img src="../presentacion/iconos/equipo.png" width="30px" title="Tipos de Equipos"></div><label class="texto">TIPOS DE EQUIPOS</label></a></div>';
$menu.='<div class="contenedorGeneral"><a href="principal.php?CONTENIDO=calibracion/administrador/clientesMantenimiento.php"><div class="logoInterior"><img src="../presentacion/iconos/cliente.png" width="30px" title="Clientes Mantenimiento"></div><label class="texto">CLIENTES MANTENIMIENTO</label></a></div>';
                break;
	    case 'M':
                $menu.='<div class="contenedorGeneral"><a href="principal.php?CONTENIDO=calibracion/administrador/clientes.php"><div class="logoInterior"><img src="../presentacion/iconos/cliente.png" width="30px" title="Listado de Clientes"></div><label class="texto">CLIENTES</label></a></div>';
		$menu.='<div class="contenedorGeneral"><a href="principal.php?CONTENIDO=calibracion/administrador/equiposCaracteristicas.php"><div class="logoInterior"><img src="../presentacion/iconos/equipo.png" width="30px" title="Tipos de Equipos"></div><label class="texto">TIPOS DE EQUIPOS</label></a></div>';
				$menu.='<div class="contenedorGeneral"><a href="principal.php?CONTENIDO=calibracion/administrador/clientesMantenimiento.php"><div class="logoInterior"><img src="../presentacion/iconos/cliente.png" width="30px" title="Clientes Mantenimiento"></div><label class="texto">CLIENTES MANTENIMIENTO</label></a></div>';
                break;

        }
        return $menu;
    }

    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * from usuario";
        if ($filtro!=null) $cadenaSQL.=" where $filtro ";
        if ($orden!=null) $cadenaSQL.=" order by $orden ";
        return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public static function getDatosEnObjetos($filtro, $orden) {
        $datos = Usuario::getDatos($filtro, $orden);
        $lista = array();
        for ($i = 0; $i < count($datos); $i++) {
            $usuario= new Usuario($datos[$i], null);
            $lista[$i] = $usuario;
        }
        return $lista;
    }
}