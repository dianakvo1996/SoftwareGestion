<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__) . '/../../../clasesCalibracion/ClienteC.php';
require_once dirname(__FILE__) . '/../../../clasesCalibracion/EquipoC.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/TipoEquipo.php';
require_once dirname(__FILE__) . '/../../../clasesCalibracion/NombreEquipo.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable => $Valor) ${$Variable} = $Valor;

$cliente=new ClienteC('nit', "'".$nitCliente."'");

if ($accion=='Modificar') {
    $equipo=new EquipoC('ide', $ide);    
}else{
    $equipo=new EquipoC(null, null);
}

$datosLista=NombreEquipo::getNombreArreglo(null,'nombre asc');
?>
<a href="principal.php?CONTENIDO=calibracion/administrador/equiposCliente.php&nitCliente=<?=$cliente->getNit()?>"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="formulario">
    <form method="POST" action="calibracion/administrador/equipoClienteActualizar.php">
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
				<input class="awesomplete" autofocus type="text" name="nombreEquipo" value="<?=$equipo->getNombreEquipo()?>" autocomplete="off" data-list="<?=$datosLista?>" data-minChars="1">
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
            <th>SERIE</th>
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
                <input type="hidden" name="nitCliente" value="<?=$cliente->getNit()?>">
                <input type="submit" name="accion" value="<?=$accion?>">
            </th>
        </tr>
    </table>
    </center>
    </form>
</div>

<script type="text/javascript" src="../presentacion/css/autocompletar/awesomplete.min.js"></script>
