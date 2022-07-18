<?php 
require_once dirname(__FILE__) . '/../../../clasesCalidad/Persona.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/Usuario.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/LugarIC.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

if($accion=='Modificar'){
   $datosPersona=new Persona("identificacion","'".$identificacion."'");
    $datosUsuario=new Usuario("usuario","'".$datosPersona->getUsuario()."'");
	$datosLugar=new LugarIC('ideIngeniero',"'".$identificacion."'");
    $requerido='';
    
}else{
    $datosPersona=new Persona(null, null);
    $datosUsuario=new Usuario(null, null);
    $requerido='required';
	$datosLugar=new LugarIC(null,null);


}
?>
<div id="formulario">
    <form method="POST" action="mantenimiento/administrador/usuarioActualizar.php">
	<center>
	<table>
	    <tr>
        	<th colspan="2"><?= strtoupper($accion)?> USUARIO</th>
        </tr>
        <tr>
        	<th>Identificación:</th>
            <td><input type="number" id="identificacion" onchange="generarContraseña();" onclick="restaurar()" autocomplete="off" value="<?=$datosPersona->getIdentificacion()?>" name="identificacion" required></td>
        </tr>
        <tr>
            <th>Nombres:</th>
                <td><input  id="nombre" onchange="generarContraseña()" autocomplete="off" type="text" value="<?=$datosPersona->getNombres()?>" name="nombres" onchange="usuario()" required></td>
            </tr>
            <tr>
                <th>Apellidos:</th>
                <td><input type="text" id="apellido" autocomplete="off" value="<?=$datosPersona->getApellidos()?>" onchange="usuario()" name="apellidos" required></td>
            </tr>
            <tr>
                <th>Cargo:</th>
                <td><input type="text" name="cargo" autocomplete="off" value="<?=$datosPersona->getCargo()?>" required></td>
            </tr>
            <tr>
                <th>Tipo:</th>
                <td>
                    <select name="tipo" required class="cajon">
                        <?= Usuario::getTipoMantenimiento($datosUsuario->getTipo())?>
                    </select>
                </td>
            </tr>
			<tr>
                <th>Lugar:</th>
                <td>
                    <select name="lugar" required class="cajon">
						<option value="0">--Seleccione--</option>
                		<option value="900597845-3">Clínica Cardioneurovascular Pabon</option>
                		<option value="900077584RV">Sede Valle</option>
                		<option value="900077584-HC">UCI Valle</option>
                		<option value="900077584-HT">Hospital Tuquerres</option>
					</select>
                </td>
            </tr>
            <tr>
                <th>Usuario:</th>
                <td id="usuario"><?=$datosPersona->getUsuario()?></td>
            </tr>
            <tr>
                <th>Contraseña:</th>
                <td id="clave1"></td>                
            </tr>                                   
            <tr>                
                <th colspan="2">
                    <input type="hidden" name="clave" id="clave2">
                    <input type="hidden" name="claveAnterior" value="<?=$datosUsuario->getClave()?>">
                    <input type="hidden" name="usuarioAnterior" value="<?=$datosUsuario->getUsuario()?>">
                    <input type="hidden" name="identificacionAnterior" value="<?=$datosPersona->getIdentificacion()?>">
                    <input type="submit" value="<?=$accion?>"  name="accion">
                </th>
            </tr>
	</table>
	</center>
    </form>
</div>
<script>
	function generarContraseña(){
        var nombres=document.getElementById("nombre").value;
        var arrayNombres=nombres.split(" ");
        var identificacion=document.getElementById("identificacion").value;
        var digitos=identificacion.substr(0,4);
        var clave=arrayNombres[0]+digitos;
        document.getElementById("clave1").innerHTML=clave.toLowerCase();
        document.getElementById("clave2").value=clave.toLowerCase();
	}
	function usuario(){
        var nombres=document.getElementById("nombre").value;
        var apellidos=document.getElementById("apellido").value;
        var arrayNombres=nombres.split(" ");
        var arrayApellidos=apellidos.split(" ");
        var nuevoUsuario=arrayNombres[0]+"."+arrayApellidos[0];
        document.getElementById("usuario").innerHTML=nuevoUsuario.toLowerCase();
	}
</script>