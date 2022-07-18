<?php
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/TipoEquipo.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$cliente=new Cliente('nit', "'".$nit."'");
if ($accion=='Modificar') {
    $equipo=new Equipo('ide', $ide);    
}else{
    $equipo=new Equipo(null, null);
}
$datosLista=TipoEquipo::getNombreArreglo(null,null);
?>

<a href="principal.php?CONTENIDO=mantenimiento/administrador/equiposCliente.php&nit=<?=$cliente->getNit()?>"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="formulario">
    <form method="POST" action="mantenimiento/administrador/equipoClienteActualizar.php">
    <center>
    <table>
        <tr>
            <th colspan="2"><?= strtoupper($accion)?> EQUIPO</th>
        </tr>
        <tr>
            <th colspan="2"><?= strtoupper($cliente->getNombre())?></th>
        </tr>
        <tr>
            <th>EQUIPO</th>
            <td>
                <input  type="text" class="awesomplete" name="nombreEquipo" value="<?=$equipo->getNombreEquipo()?>" required="true" autocomplete="off" data-list="<?=$datosLista?>" data-minChars="1">
            </td>
        </tr>
        <tr>
            <th>MARCA</th>
            <td><input type="text" name="marca" value="<?=$equipo->getMarca()?>" required="true"></td>
        </tr>
        <tr>
            <th>MODELO</th>
            <td><input type="text" name="modelo" value="<?=$equipo->getModelo()?>" required="true"></td>
        </tr>
        <tr>
            <th>SERIE</th>
            <td><input type="text" name="serial" value="<?=$equipo->getSerial()?>" required="true"></td>
        </tr>
        <tr>
            <th>ACTIVO FIJO</th>
            <td><input type="text" name="activoFijo" value="<?=$equipo->getActivoFijo()?>" required="true"></td>
        </tr>
        <tr>
            <th>UBICACIÓN</th>
            <td><input type="text" name="ubicacion" value="<?=$equipo->getUbicacion()?>" required="true"></td>
        </tr>
        <tr>
            <th>REFERENCIA</th>
            <td><input type="text" name="referencia" value="<?=$equipo->getReferencia()?>" required="true"></td>
        </tr>
        <tr>
            <th>REGISTRO INVIMA</th>
            <td><input type="text" name="registroInvima" value="<?=$equipo->getRegistroInvima()?>" required="true"></td>
        </tr>

        <tr>
            <th colspan="2">
                <input type="hidden" name="ide" value="<?=$equipo->getIde()?>">
                <input type="hidden" name="nitCliente" value="<?=$cliente->getNit()?>">
                <input type="submit" name="accion" value="<?=$accion?>">
            </th>
        </tr>
    </table>
    </center>
    </form>
</div>
