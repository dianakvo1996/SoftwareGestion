<?php
require_once dirname(__FILE__) . '/../../../clasesCalidad/Persona.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/Ciudad.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/Departamento.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$MENSAJE='';
if (isset($_GET['MENSAJE']))
    $MENSAJE = $_GET['MENSAJE'];

$codDepartamento='';

if ($accion=='Modificar') {
    $datosPersona=new Persona("identificacion","'".$identificacion."'");
    $datosUsuario=new Usuario("usuario","'".$datosPersona->getUsuario()."'");
    $requerido='';
}else{
    $datosPersona=new Persona(null, null);
    $datosUsuario=new Usuario(null, null);
    $requerido='required';
}
?>
<a href="principal.php?CONTENIDO=calidad/administrador/usuarios.php"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px" ></a>
<div id="formulario">
<center>
    <form action="calidad/administrador/actualizarUsuario.php" name="formulario" method="post">
        <label id="mensaje" style="color: red"><?=$MENSAJE?></label>
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
                        <?= Usuario::getTipoEnOptions($datosUsuario->getTipo())?>
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
    </form>
</center>
</div>

<script>
    
//    function compararClave(){
//        var clave1=document.getElementById("clave1").value;
//        var clave2=document.getElementById("clave2").value;
//        
//        
//        if (clave1 == clave2) {
//            document.getElementById("mensaje").innerHTML="<img src='../presentacion/iconos/correcto.png' height='30px'>";
//            
//        }else{ 
//            document.getElementById("mensaje").innerHTML="<img src='../presentacion/iconos/incorrecto.png' height='30px' title='Las contraseñas no coinciden'>";
//            
//        } 
//    }
	function restaurar() {
    	document.getElementById("mensaje").innerHTML=" ";
	}
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