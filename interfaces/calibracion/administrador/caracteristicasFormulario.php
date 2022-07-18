<?php
require_once dirname(__FILE__) . '/../../../clasesCalibracion/NombreEquipo.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

if($accion=="Modificar"){
	$nombreEquipo=new NombreEquipo('ide',$ide);
}else{
	$nombreEquipo=new NombreEquipo(null,null);
}

$datosLista=NombreEquipo::getNombreArreglo(null,'nombre asc');
?>
<a href="principal.php?CONTENIDO=calibracion/administrador/equiposCaracteristicas.php"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="formulario">
<form method="POST" action="calibracion/administrador/caracteristicasActualizar.php">
    <center>
    <table>
        <tr>
            <th colspan="2"><?=strtoupper($accion)?> EQUIPO</th>
        </tr>
        <tr>
            <th>NOMBRE </th>
            <td>
                <input type="text" class="awesomplete" name="nombre" value="<?=$nombreEquipo->getNombre()?>" autocomplete="off" data-list="<?=$datosLista?>" data-minChars="1">
            </td>
        </tr>
        <tr>
            <th>TIPO </th>
            <td>
				<select name="tipo" class="cajon"><option value="/">- - - - - - - -</option><?=$nombreEquipo->getTipoOptions()?></select>
            </td>
        </tr>
		<tr>
            <th>CLASIFICACION BIOMEDICA</th>
            <td>
				<select name="clasificacionBiomedica" class="cajon"><option value="/">- - - - - - - -</option><?=$nombreEquipo->getClasificacionBiomedicaOptions()?></select>
            </td>
        </tr>
		<tr>
            <th colspan="2">
				<input type="hidden" name="ide" value="<?=$nombreEquipo->getIde()?>">
				<input type="submit" name="accion" value="<?=$accion?>">
			</th>
        </tr>

    </table>
    </center>
</form>
</div>
<script type="text/javascript" src="../presentacion/css/autocompletar/awesomplete.min.js"></script>