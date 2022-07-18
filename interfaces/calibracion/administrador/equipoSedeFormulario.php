<?php
require_once dirname(__FILE__) . '/../../../clasesCalibracion/ClienteC.php';
require_once dirname(__FILE__) . '/../../../clasesCalibracion/SedeC.php';
require_once dirname(__FILE__) . '/../../../clasesCalibracion/EquipoC.php';
require_once dirname(__FILE__) . '/../../../clasesCalibracion/NombreEquipo.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$sede=new SedeC('ide', $ideSede);

if ($accion=='Modificar') {
    $equipo=new EquipoC('ide', $ide);
}else{
    $equipo=new EquipoC(null, null);
}

$datosLista=NombreEquipo::getNombreArreglo(null,'nombre asc');
?>
<a href="principal.php?CONTENIDO=calibracion/administrador/equiposSede.php&ideSede=<?=$sede->getIde()?>"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="formulario">
    <form method="POST" action="calibracion/administrador/equipoSedeActualizar.php">
    <center>
    <table>
        <tr>
            <th colspan="2"><?= strtoupper($accion)?> EQUIPO</th>
        </tr>
        <tr>
            <th colspan="2"><?= strtoupper($sede->getNombre())?></th>
        </tr>
        <tr>
            <th>EQUIPO</th>
            <td>
                <input type="text" name="nombreEquipo" class="awesomplete" value="<?=$equipo->getNombreEquipo()?>" autocomplete="off" data-list="<?=$datosLista?>" data-minChars="1">
			</td>
        </tr>
        <tr>
            <th>MARCA</th>
            <td><input type="text" name="marca" value="<?=$equipo->getMarca()?>"></td>
        </tr>
        <tr>
            <th>MODELO</th>
            <td><input type="text" name="modelo" value="<?=$equipo->getModelo()?>"></td>
        </tr>
        <tr>
            <th>SERIAL</th>
            <td><input type="text" name="serial" value="<?=$equipo->getSerial()?>"></td>
        </tr>
        <tr>
            <th>ACTIVO FIJO</th>
            <td><input type="text" name="activoFijo" value="<?=$equipo->getActivoFijo()?>"></td>
        </tr>
        <tr>
            <th>UBICACIÓN</th>
            <td><input type="text" name="ubicacion" value="<?=$equipo->getUbicacion()?>"></td>
        </tr>
        <tr>
            <th colspan="2">
                <input type="hidden" name="ide" value="<?=$equipo->getIde()?>">
                <input type="hidden" name="ideSede" value="<?=$sede->getIde()?>">
                <input type="submit" name="accion" value="<?=$accion?>">
            </th>
        </tr>
    </table>
    </center>
        </form>
</div>

