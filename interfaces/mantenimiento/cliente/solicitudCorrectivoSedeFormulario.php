<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Sede.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$informacionEquipo=new Equipo('ide', $ideEquipo);

$sede=new Sede('ide', $informacionEquipo->getIdeSede());
?>
<a href="principal.php?CONTENIDO=mantenimiento/cliente/seleccionarEquipoSede.php&ideSede=<?=$sede->getIde()?>" style="float: left"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<br>
<div id="formulario">
    <form method="POST" action="mantenimiento/cliente/solicitudSedeActualizar.php" enctype="multipart/form-data" onsubmit="bloquearEnviar()">
        <center>
            <table>
                <tr>
                    <th colspan="4">SOLICITAR MANTENIMIENTO CORRECTIVO</th>
                </tr>
                <tr>
                    <th>Cliente:</th>
                    <td><?=$sede->getCliente()->getNombre()?></td>
                </tr>
                <tr>
                    <th>Sede:</th>
                    <td><?=$sede->getNombre()?></td>
                </tr>
                <tr>
                    <th>Ciudad:</th>
                    <td><?=$sede->getCiudad()->getNombre()?></td>
                </tr>
                <tr>
                    <th>Información Equipo:</th>
                    <td>
                        <strong>Activo Fijo: </strong><?=$informacionEquipo->getActivoFijo()?><br>
                        <strong>Equipo: </strong><?=$informacionEquipo->getNombreEquipo()?><br>
                        <strong>Marca: </strong><?=$informacionEquipo->getMarca()?><br>
                        <strong>Ubicación: </strong><?=$informacionEquipo->getUbicacion()?><br>
                        <strong>Serie: </strong><?=$informacionEquipo->getSerial()?>
                    </td>                  
                </tr>
                <tr>
                    <th>Solicitante:</th>
                    <td><input type="text" name="solicitante" required="true"></td>
                </tr>
                <tr>
                    <th>Cargo:</th>
                    <td><input type="text" name="cargo" required="true"></td>
                </tr>
                <tr>
                    <th>Detalles de Daño:</th>
                    <td><textarea class="textarea" required="true" name="detalle" required="true"></textarea></td>
                </tr>
                <tr>
                    <th>Fotografia:</th>
                    <td><input type="file" name="fotografia"></td>
                </tr>
                <tr>
                    <th colspan="2">
                        <input type="hidden" name="ideEquipo" value="<?=$informacionEquipo->getIde()?>">
                        <input type="hidden" name="accion" value="Enviar">
                        <input type="submit" name="accion_" value="Enviar"  id="accion">
                    </th>
                </tr>
            </table>
        </center>
    </form>
</div>
<script>
	function bloquearEnviar(){
		document.getElementById('accion').disabled=true;
	}
</script>