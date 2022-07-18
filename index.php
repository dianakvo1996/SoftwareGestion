<?php
session_start();
session_unset();
session_destroy();

$MENSAJE='';
if (isset($_GET['MENSAJE']))
    $MENSAJE = $_GET['MENSAJE'];
?>
<html>
	<head>
            <title>Quality System Ingenieria Biomédica</title>
            <meta charset="utf-8" />
  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">
            <meta name="viewport" content="width=device-width,user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
	  <meta name="author" content="Diana Karolina Valencia, dianavalencia310@gmail.com">
            <link rel="stylesheet" href="presentacion/css/estiloIndex-1.css" />
            <link rel="shortcut icon" type="image/x-icon" href="presentacion/imagenes/logoIcono.ico" >
            <link href="https://fonts.googleapis.com/css?family=Cabin&display=swap" rel="stylesheet">
            <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
            <script src="presentacion/js/menu.js"></script>
            <script type="text/javascript">
                $(document).ready(function() {
                    setTimeout(function() {
                        $(".alerta").fadeOut(1500);
                    },3000);
                });
            </script>

        </head>
        <body>
		<div id="menu">
			<div id="logoPrincipal">
				<div class="logoBio"><img src="presentacion/iconos/logo_Bio.png" height="30px"></div>			
				<p>Quality System Ingeniería Biomédica</p>		
			</div>
			<hr>
			<div class="contenedorGeneral">
				<a href="index.php">
				<div class="logoInterior"><img src="presentacion/iconos/inicioSesion.png" width="30px" title="Iniciar Sesión">
				</div>
				<label class="texto">INICIAR SESIÓN</label>
				</a>
			</div>
			<div class="pieMenu">			
				<p><strong style="color: #fff"><a href="http://laboratoriobiometrical.com.co" target="_blank">©Laboratorio Biometrical S.A.S.</a></strong> Todos los derechos reservados.</p>
			</div>
		</div>
            <div id="contenedor">
                <section class="login">
                    <form method="post" action="validar.php">
                        <table>
                            <tr>
                                <th colspan="2"><br><img src="presentacion/imagenes/logotipoBiometrical.png" height="60px" class="logoLogin"></th>
                            </tr>
                            <tr>
                                <th class="titulo" colspan="2">Iniciar Sesión</th>
                            </tr>
                            <tr>
                                <th colspan="2"><div class="alerta" style="color: red"><?=$MENSAJE?></div></th>
                            </tr>

                            <tr>
                                <th class="subtitulo" colspan="2">Usuario</th>
                            </tr>
                            <tr>
                                <th>
                                    <input type="text" name="usuario" class="datos" required autofocus="true" autocomplete="off" spellcheck="false">
                                </th>
                            </tr>
                            <tr>
                                <th class="subtitulo" colspan="2">Contraseña <input type= "checkbox" onclick="mostrarContrasena()" style="float:right"></th>
                            </tr>
                            <tr>
                                <th>
                                    <input type="password" name="clave" required id="contrasena" class="datos">
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2">
                                    <input type="submit" value="Ingresar" minlength="5" name="inicioSesion" class="boton">
                                </th>
                            </tr>                            
                        </table>                        
                   </form>
                   </section>
            </div>
        </body>
	
</html>
<script>
  function mostrarContrasena(){
      var tipo = document.getElementById("contrasena");
      if(tipo.type == "password"){
          tipo.type = "text";
      }else{
          tipo.type = "password";
      }
  }
</script>