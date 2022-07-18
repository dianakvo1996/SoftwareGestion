<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once dirname(__FILE__) . '/../clasesGenericas/Usuario.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$MENSAJE='';
if (isset($_GET['MENSAJE']))
    $MENSAJE = $_GET['MENSAJE'];

session_start();

if (!isset($_SESSION['usuario'])) {
    $mensaje = "Sesión no valida.";
    header("Location: ../index.php?MENSAJE=$mensaje");
}
$plataforma= explode('/', $_GET['CONTENIDO'])[0];
switch ($plataforma) {
    case 'seleccionPlataforma.php':
        $menuNavegacion='';
        $cabacera=" laboratorio biometrical s.a.s.";
        break;
    case 'mantenimiento':
        $menuNavegacion= Usuario::getMenuMantenimiento($_SESSION['usuario']);
        $cabacera="Mantenimiento";
        break;
    case 'calidad':
        $menuNavegacion= Usuario::getMenuCalidad($_SESSION['tipo']);
        $cabacera="Gestión de Calidad";
        break;
    case 'calibracion':
        $menuNavegacion= Usuario::getMenuCalibracion($_SESSION['tipo']);
        $cabacera="Calibración";
        break;
}
$auxiliar='';
if ($_SESSION['tipo']=='C') {
    $auxiliar='display: none;';  
    $cabacera='Usuario Cliente';
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Quality System Ingenieria Biomédica</title>
        <link rel="shortcut icon" type="image/x-icon" href="../presentacion/imagenes/logoIcono.ico" >
        <link href="../presentacion/css/estilo_V2.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../presentacion/css/estiloDetallesEquipo_V3.css">
<link rel="stylesheet" href="../presentacion/css/autocompletar/awesomplete.base.css">
<link rel="stylesheet" href="../presentacion/css/autocompletar/awesomplete.theme.css">
        <link href="../presentacion/css/imprimirReporte_V1.css" rel="stylesheet" type="text/css" media="print"/> 

        <link rel="stylesheet" href="../presentacion/css/styles.css" />
        <meta name="viewport" content="width=device-width,user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
        <link href="https://fonts.googleapis.com/css?family=Cabin|Hepta+Slab&display=swap" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.2.1.js"></script> 
        <script src="../presentacion/js/main.js"></script>
        <script src="../presentacion/js/menu.js"></script>  
		<script src="../presentacion/js/signature_pad.js"></script>
		<script type="text/javascript" src="../presentacion/css/autocompletar/awesomplete.min.js"></script>
        <meta charset="utf-8"/>
    </head>
    <body>
        <div id="contenedor">
            <header>
                <div class="info">
                    <a href="principal.php?CONTENIDO=seleccionPlataforma.php"><img src="../presentacion/iconos/inicio.png" height="20px" title="inicio" style="float:left;margin-left: 10px;vertical-align: middle;<?=$auxiliar?>"></a>
                    <label><?=$cabacera?></label>
	<label class="usuarioDerecha" style="<?=$auxiliar?>" onclick="confirmarSalir()"><?=$_SESSION['usuario']?></label>
                </div>
            </header>
		<div id="menu">
			<div id="logoPrincipal">
				<div class="logoBio"><img src="../presentacion/iconos/logo_Bio.png" height="30px"></div>			
				<p>Quality System Ingeniería Biomédica</p>		
			</div>
			<hr>
			<?=$menuNavegacion?>
			<div class="contenedorGeneral" onclick="confirmarSalir()">
				<div class="logoInterior"><img src="../presentacion/iconos/cerrarSesion.png" width="30px" title="Cerrar Sesion"> 
				</div>
				<label class="texto">CERRAR SESIÓN</label>
				</div>
			<div class="pieMenu">			
				<p><strong style="color: #fff"><a href="http://laboratoriobiometrical.com.co" target="_blank">©Laboratorio Biometrical S.A.S.</a></strong> Todos los derechos reservados.</p>
			</div>
		</div>

            <div id="contenedor_carga">		
                <div id="carga"></div>
            </div>   
         
            <div id="contenido">
                <?php include $_GET['CONTENIDO']; ?>
            </div>
        </div>
    </body>
</html>
<script>
    function confirmarSalir(){
        if (confirm("¿Esta seguro de Cerrar Sesión?")) {
        location = "../index.php";
        }
    }
</script>