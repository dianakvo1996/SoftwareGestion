<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RespuestaSolicitud
 *
 * @author Lenovo
 */
require_once dirname(__FILE__) . '/../clasesGenericas/ConectorBD.php';
require_once dirname(__FILE__) . '/solicitudCorrectivo.php';

class RespuestaSolicitud {
    private $ide;
    private $ideSolicitud;
    private $respuesta;
    private $estado;
    private $evidencia;
    private $fechaRealizacion;
  	private $fechaEnProceso;
    
    function __construct($campo,$valor) {
        if ($campo!=null) {
            if (is_array($campo))
                $this->cargarAtributos ($campo);
            else {
                $cadenaSQL="select * from respuestasolicitud where $campo=$valor";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL,null);
                if (count($resultado)>0)
                    $this->cargarAtributos ($resultado[0]);
            }
        }
    }
    
    private function cargarAtributos($datos) {
        $this->ide=$datos['ide'];
        $this->ideSolicitud=$datos['idesolicitud'];
        $this->respuesta=$datos['respuesta'];
        $this->estado=$datos['estado'];
        $this->evidencia=$datos['evidencia'];
        $this->fechaRealizacion=$datos['fecharealizacion'];
		$this->fechaEnProceso=$datos['fechaenproceso'];
    }
    function getIde() {
        return $this->ide;
    }

    function getIdeSolicitud() {
        return $this->ideSolicitud;
    }

    function getRespuesta() {
        return $this->respuesta;
    }

    function getEstado() {
        return $this->estado;
    }
	function getFechaEnProceso() {
        return $this->fechaEnProceso;
    }

    public function __toString() {
        return $this->estado;
    }

    function getEstadoRadio() {
        $lista='';
        switch ($this->estado) {
            case 'P':
                $lista.='<input type="radio" name="estado" id="1" value="P" onclick="validarEstado()" checked="true" style="width:5%"><label for="1">Pendiente</label>';
                $lista.='<input type="radio" name="estado" id="2" value="R" onclick="validarEstado()" style="width:5%"><label for="2">Ejecutado</label>';
				$lista.='<input type="radio" name="estado" id="3" value="E" onclick="validarEstado()" style="width:5%"><label for="3">En Proceso</label>';

                break;
            case 'R':
                $lista.='<input type="radio" name="estado" id="1" value="P" onclick="validarEstado()" style="width:5%"><label for="1">Pendiente</label>';
                $lista.='<input type="radio" name="estado" id="2" value="R" onclick="validarEstado()" checked="true" style="width:5%"><label for="2">Ejecutado</label>';
				$lista.='<input type="radio" name="estado" id="3" value="E" onclick="validarEstado()" style="width:5%"><label for="3">En Proceso</label>';
                break;
            case 'E':
                $lista.='<input type="radio" name="estado" id="1" value="P" onclick="validarEstado()" style="width:5%"><label for="1">Pendiente</label>';
                $lista.='<input type="radio" name="estado" id="2" value="R" onclick="validarEstado()" style="width:5%"><label for="2">Ejecutado</label>';
				$lista.='<input type="radio" name="estado" id="3" value="E" onclick="validarEstado()" checked="true" style="width:5%"><label for="3">En Proceso</label>';
                break;

            default:
                $lista.='<input type="radio" name="estado" id="1" value="P" onclick="validarEstado()" style="width:5%"><label for="1">Pendiente</label>';
                $lista.='<input type="radio" name="estado" id="2" value="R" onclick="validarEstado()" style="width:5%"><label for="2">Ejecutado</label>';
				$lista.='<input type="radio" name="estado" id="3" value="E" onclick="validarEstado()" style="width:5%"><label for="3">En Proceso</label>';
                break;
        }
        return $lista;
    }

    function getFechaRealizacion() {
        return $this->fechaRealizacion;
    }
    function getEvidencia() {
        return $this->evidencia;
    }

    function setEvidencia($evidencia) {
        $this->evidencia = $evidencia;
    }
    
    function setIde($ide) {
        $this->ide = $ide;
    }

    function setIdeSolicitud($ideSolicitud) {
        $this->ideSolicitud = $ideSolicitud;
    }

    function setRespuesta($respuesta) {
        $this->respuesta = $respuesta;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setFechaEnProceso($fechaEnProceso) {
        $this->fechaEnProceso= $fechaEnProceso;
    }

    function setFechaRealizacion($fechaRealizacion) {
        $this->fechaRealizacion = $fechaRealizacion;
    }
    function getMostrarFecha() {
        if ($this->fechaRealizacion==null) {
            return '';
        }else{
            $date= date_create($this->fechaRealizacion);
            return date_format($date,'d/m/Y h:i A');
        }
    }
    function getSolicitud() {
        return new solicitudCorrectivo('ide', $this->ideSolicitud);   
    }
    
    function getCalcularTiempoRespuesta($fechaCorrectivo,$fechaRespuesta) {
        if ($fechaRespuesta==null) {
            return $diferencia='Sin Realizar'; 
        }else{
            $fechaSolicitud=date_create($fechaCorrectivo);
            $fechaRealizacion=date_create($fechaRespuesta);
            $diferencia= date_diff($fechaSolicitud, $fechaRealizacion);
            return $diferencia->format('%d d %h h %i min');
        }
    }

    public static function getPromedioRespuesta() {
        $suma=0;
        $datosRespuesta= RespuestaSolicitud::getDatosEnObjetos(null, null);
        for ($i = 0; $i < count($datosRespuesta); $i++) {
            $objeto=$datosRespuesta[$i];
            $diferencia+= $this->getCalcularTiempoRespuesta($objeto->getSolicitud()->getFecha(),$objeto->getFechaRealizacion());
        }
    }
            
    function adicionarRespuestaPrevia() {
        $cadenaSQL="insert into respuestaSolicitud (ideSolicitud,estado)values({$this->ideSolicitud},'P')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    function modificarRespuesta() {
        $cadenaSQL="update respuestaSolicitud set respuesta='{$this->respuesta}', estado='$this->estado', fecharealizacion='{$this->fechaRealizacion}', evidencia='{$this->evidencia}' where ide={$this->ide}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }

	function modificarRespuestaEnProceso(){
		$cadenaSQL="update respuestaSolicitud set estado='E', respuesta='{$this->respuesta}', fechaEnProceso = '{$this->fechaEnProceso}' where ideSolicitud={$this->ideSolicitud}";
    	echo $cadenaSQL;    
	ConectorBD::ejecutarQuery($cadenaSQL, null);

	}

    public static function getDatos($filtro,$orden) {
        $cadenaSQL="select * form respuestaSolicitud";
        if ($filtro!=null) $cadenaSQL.=" where $filtro";
        if ($orden!=null) $cadenaSQL.=" order by $orden";
    return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }

    public static function getDatosEnObjetos($filtro,$orden) {
        $datos= RespuestaSolicitud::getDatos($filtro, $orden);
        $lista=array();
        for ($i = 0; $i < count($datos); $i++) {
            $respuesta=new RespuestaSolicitud($datos[$i], null);
            $lista[$i]=$respuesta;
        }
        return $lista;
    }
    
	public static function getCalcularPromedioGeneral($filtro){
		$cadenaSQL = "select fecha,fecharealizacion from solicitudCorrectivo,respuestasolicitud where solicitudCorrectivo.ide=ideSolicitud";
		if($filtro!=null)$cadenaSQL.=" and $filtro";
		//echo $cadenaSQL;
		$datos = ConectorBD::ejecutarQuery($cadenaSQL, null);
		$lista='';
		$valores='';
		for ($i = 0; $i < count($datos); $i++) {
			$fechaS=$datos[$i][0];
			$fechaR=$datos[$i][1];
			//inicio calculo diferencia
				$fechaSolicitud=date_create($fechaS);
            	$fechaRealizacion=date_create($fechaR);
            	$diferencia= date_diff($fechaSolicitud, $fechaRealizacion);
            	$diferencias = $diferencia->format('%Y-%m-%d %H:%i:%s');

				//echo $diferencias;
				$difFechas = $fechaSolicitud->diff($fechaRealizacion);
	$valores.= $difFechas->days;
			// Fin calculo diferencia
			$lista.=$diferencias.",";
        }
		$listas=substr($lista, 0, -1);
			$arreglo   = explode(",", $listas);
    		$resultado = 0;
        	foreach($arreglo AS $tiempo){
            	$resultado += strtotime($tiempo) - strtotime("TODAY");
        	}
//echo $resultado;
//inicio cuenta dias
		$valores_en_array=str_split($valores);
		$sumatorio=array_sum($valores_en_array);
		unset($valores_en_array);		
		$diasPromedio=$sumatorio/count($arreglo);
//fin cuenta dias
		
        	$promedio= $resultado / count($arreglo);
			$promedios=gmdate("j:G:i", $promedio);
			$horas=explode(":",$promedios)[1];
			if($horas==12)$horas='0';
			$minutos=explode(":",$promedios)[2];
        return $mostar= floor($diasPromedio)." dias ".$horas." horas, ".$minutos." minutos ";
	}

	
	public static function getSeleccionarDestino($nitCliente){
		$correo='';
		$ideTelegram='';
		switch($nitCliente){
			case '900077584'://nariño
				$correo='correctivosnarino@gmail.com';
				$ideTelegram='-1001479767291';
			break;
			case '900077584RV'://valle
				$correo='correctivosvalle@gmail.com';
				$ideTelegram='-1001421842586';
			break;
			case '900077584-HT'://hospital San Jose Tuquerres
				$correo='correctivoshospitalsanjose@gmail.com';
				$ideTelegram='-1001169909438';
			break;
			case '900077584-C'://hospital San Juan de Dios
				$correo='correctivossanjuandedios@gmail.com';
				$ideTelegram='-1001255633040';
			break;
			default://todos los demas
				$correo='correctivosnarino@gmail.com';
				$ideTelegram='-1001479767291';
			break;
		}
		return $correo.','.$ideTelegram;
	}
	public static function getEnviarMensajeTelegram($mensaje,$ideTelegram){
		$token = "1609840936:AAEvnQFPbHjxYim7HQ8jczdRCYD4W3d7zP4";
		$id = $ideTelegram;
		$urlMsg = "https://api.telegram.org/bot{$token}/sendMessage";
		$msg = $mensaje;
 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $urlMsg);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "chat_id={$id}&parse_mode=HTML&text=$msg");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec($ch);
		curl_close($ch);
	}

}
