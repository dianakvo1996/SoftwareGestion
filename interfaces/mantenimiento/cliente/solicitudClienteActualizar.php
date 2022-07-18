<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//librerias envio correo

require_once dirname(__FILE__) .  '/../../../librerias/PHPMailer/Exception.php';
require_once dirname(__FILE__) .  '/../../../librerias/PHPMailer/PHPMailer.php';
require_once dirname(__FILE__) .  '/../../../librerias/PHPMailer/SMTP.php';

require_once dirname(__FILE__) . '/../../../clasesMantenimiento/solicitudCorrectivo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/RespuestaSolicitud.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/EquipoCorrectivo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/ConectorBD.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

date_default_timezone_set('America/Bogota');

$informacionEquipo=new Equipo('ide', $ideEquipo);
$equipoCorrectivo=new EquipoCorrectivo ('ide',$ideEquipo);

if($equipoCorrectivo->getItem()==null){
echo 'hola';
	$equipoCorrectivo->setIde($informacionEquipo->getIde());
	$equipoCorrectivo->setMarca($informacionEquipo->getMarca());
	$equipoCorrectivo->setModelo($informacionEquipo->getModelo());
	$equipoCorrectivo->setSerial($informacionEquipo->getSerial());
	$equipoCorrectivo->setActivoFijo($informacionEquipo->getActivoFijo());
	$equipoCorrectivo->setUbicacion($informacionEquipo->getUbicacion());
	$equipoCorrectivo->setNitCliente($informacionEquipo->getNitCliente());
	$equipoCorrectivo->setNombreEquipo($informacionEquipo->getNombreEquipo());
	$equipoCorrectivo->setRegistroInvima('NR');
	$equipoCorrectivo->setReferencia('NR');
	$equipoCorrectivo->adicionarCliente();
}
$fechaRealizacion= date('Y-m-d H:i:s');
$fecha=date('Ymd-His');
$codDepartamento=$informacionEquipo->getCliente()->getCiudad()->getCodDepartamento();
switch ($accion) {
    case 'Enviar':
        $solicitudCorrectivo=new solicitudCorrectivo(null, null);
        $solicitudCorrectivo->setIdeEquipo($ideEquipo);
        $solicitudCorrectivo->setNitCliente($informacionEquipo->getNitCliente());
        $solicitudCorrectivo->setSolicitante($solicitante);
        $solicitudCorrectivo->setCargo($cargo);
        $solicitudCorrectivo->setDetalle($detalle);
        $solicitudCorrectivo->setFecha($fechaRealizacion);
        $solicitudCorrectivo->setCodCiudad($informacionEquipo->getCliente()->getCodCiudad());
    //inicio subir fotografia
        $ruta='';
        $origen=$_FILES['fotografia']['tmp_name'];
        if ($origen!=""){
            list($fotografia, $extension) = explode('.', $_FILES['fotografia']['name']);
            $destino = '/var/www/html/SoftwareGestion/FotografiasCorrectivos/'.$fotografia.'_'.$fecha.'.' . $extension;
            if (move_uploaded_file($origen, $destino)) {
		echo "Archivo subido Exitosamente";
                $solicitudCorrectivo->setFotografia($fotografia.'_'.$fecha.'.'.$extension);
                $ruta=$fotografia.'_'.$fecha.'.'.$extension;
            }          
        }else{	    
            $solicitudCorrectivo->setFotografia(null);  
        }            
    $solicitudCorrectivo->adicionarSolicitudCliente();
    $respuestaSolicitud=new RespuestaSolicitud(null, null);
    $consultaIdeSolicitud= ConectorBD::ejecutarQuery("select max(ide) from solicitudCorrectivo", null)[0][0];
    $respuestaSolicitud->setIdeSolicitud($consultaIdeSolicitud);
    $respuestaSolicitud->adicionarRespuestaPrevia();
   //Fin subir fotografia
     break;
}
//inicio mensaje

$destinos=explode(",",RespuestaSolicitud::getSeleccionarDestino($informacionEquipo->getCliente()->getNit()));
$correoDestino=$destinos[0];
$ideTelegram=$destinos[1];
RespuestaSolicitud::getEnviarMensajeTelegram("<strong>SOLICITUD MTTO CORRECTIVO_{$informacionEquipo->getCliente()->getNombre()} EQUIPO:</strong> {$informacionEquipo->getNombreEquipo()}<strong> - ACTIVO FIJO:</strong>{$informacionEquipo->getActivoFijo()} <strong>-DETALLE: </strong>{$detalle}",$ideTelegram);

$foto='<img src="http://laboratoriobiometrical.com.co/Admin_web/imagenes/Logo/logoBiometrical.png" height="30px" title="Logo Biometrical"><br>';
$construccionMensaje='<table cellpadding="0" cellspacing="0" style="width: 400px; margin:0 auto;border:1px dashed #8A8A8A">';
$construccionMensaje.='<tr>';
$construccionMensaje.='<th colspan="2"  style="background:#DBF5FF;height: 50px;border-bottom:1px solid #b4b4b4">DETALLES SOLICITUD<br>MANTENIMIENTO CORRECTIVO</th>';
$construccionMensaje.='</tr>';
$construccionMensaje.='<tr>';
$construccionMensaje.='<th style="background:#E1E1E1;height: 30px;width: 110px;border-bottom:1px solid #b4b4b4">FECHA:</th><td style="border-bottom:1px solid #b4b4b4">'.$fechaRealizacion.'</td>';
$construccionMensaje.='</tr>';
$construccionMensaje.='<tr>';
$construccionMensaje.='<th style="background:#E1E1E1;height: 30px;border-bottom:1px solid #b4b4b4">CLIENTE:</th><td style="border-bottom:1px solid #b4b4b4">'.$informacionEquipo->getCliente()->getNombre().'</td>';
$construccionMensaje.='</tr>';
$construccionMensaje.='<tr>';
$construccionMensaje.='<th style="background:#E1E1E1;height: 30px;border-bottom:1px solid #b4b4b4">SEDE:</th><td style="border-bottom:1px solid #b4b4b4">'.$informacionEquipo->getCliente()->getNombre().'</td>';
$construccionMensaje.='</tr>';
$construccionMensaje.='<tr>';
$construccionMensaje.='<th style="background:#E1E1E1;height: 30px;border-bottom:1px solid #b4b4b4">INFORMACIÓN EQUIPO:</th>';
$construccionMensaje.='<td style="border-bottom:1px solid #b4b4b4">';
$construccionMensaje.='<strong>Activo Fijo: </strong>'.$informacionEquipo->getActivoFijo().'<br>';
$construccionMensaje.='<strong>Equipo: </strong>'.$informacionEquipo->getNombreEquipo().'<br>';
$construccionMensaje.='<strong>Marca: </strong>'.$informacionEquipo->getMarca().'<br>';
$construccionMensaje.='<strong>Modelo: </strong>'.$informacionEquipo->getModelo().'<br>';
$construccionMensaje.='<strong>Ubicación: </strong>'.$informacionEquipo->getUbicacion().'<br>';
$construccionMensaje.='<strong>Serial: </strong>'.$informacionEquipo->getSerial().'<br>';
$construccionMensaje.='</td>';
$construccionMensaje.='</tr>';
$construccionMensaje.='<tr>';
$construccionMensaje.='<th style="background:#E1E1E1;height: 30px;border-bottom:1px solid #b4b4b4">SOLICITANTE:</th><td style="border-bottom:1px solid #b4b4b4">'.$solicitante.'</td>';
$construccionMensaje.='</tr>';
$construccionMensaje.='<tr>';
$construccionMensaje.='<th style="background:#E1E1E1;height: 30px;border-bottom:1px solid #b4b4b4">CARGO:</th><td style="border-bottom:1px solid #b4b4b4">'.$cargo.'</td>';
$construccionMensaje.='</tr>';
$construccionMensaje.='<tr>';
$construccionMensaje.='<th style="background:#E1E1E1;height: 30px;border-bottom:1px solid #b4b4b4">DETALLES DE DAÑO:</th><td style="border-bottom:1px solid #b4b4b4">'.$detalle.'</td>';
$construccionMensaje.='</tr>';
$construccionMensaje.='<tr>';
$construccionMensaje.='<th style="background:#E1E1E1;height: 30px;">ESTADO:</th><th><label style="color:#FF0000;">PENDIENTE</label></th>';
$construccionMensaje.='</tr>';
$construccionMensaje.='</table>';
$construccionMensaje.='<p style="text-aling:text-align: justify">'
        . $foto
        . '<strong>Reporte de solicitud de servicio</strong><br><strong>Quality System Ingenieria Biomédica</strong><br>Este correo es únicamente informativo y '
        . 'es de uso exclusivo del destinatario(a), puede contener información privilegiada y/o confidencial. Si no es usted el destinatario(a) deberá borrarlo inmediatamente.'
        . ' Queda notificado que el mal uso, divulgación no autorizada, alteración y/o modificación malintencionada sobre este mensaje y sus anexos quedan estrictamente'
        . ' prohibidos y pueden ser legalmente sancionados.<br>'
        . '<strong>© Laboratorio Biometrical S.A.S. Todos los derechos reservados.</strong><br><h6>----------NO RESPONDER------mensaje generado automaticamente</h6></p>';
//fin mensaje
// Instantiation and passing `true` enables exceptions
//$mail = new PHPMailer(true);
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'qualitysystem.biometrical@gmail.com';                     // SMTP username
    $mail->Password   = '9007095548BQS';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->CharSet    = 'utf-8';
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

$consecutivoSol=ConectorBD::ejecutarQuery("select count(ide) from solicitudCorrectivo where nitCliente='{$informacionEquipo->getNitCliente()}'",null)[0][0];

    //Recipients
    $mail->setFrom('qualitysystem.biometrical@gmail.com', $informacionEquipo->getCliente()->getNombre());
    $mail->addAddress($correoDestino);     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'SOLICITUD MTTO CORRECTIVO_'.$informacionEquipo->getCliente()->getNombre()."_{$consecutivoSol}";
    $mail->Body    = $construccionMensaje;
    $mail->send();
    echo 'el mensaje se envio correctamente';
} catch (Exception $e) {
    echo "no se envio: {$mail->ErrorInfo}";
}

header("Location: ../../principal.php?CONTENIDO=mantenimiento/cliente/solicitudesCorrectivo.php");

