<?php
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Sede.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Cliente.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/EquipoDeBaja.php';

$sede=new Sede('ide',$ideSede);
$datos= EquipoDeBaja::getDatosEnObjetos('ideSede='.$ideSede, 'nombreEquipo');
$lista='';
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<td>{$objeto->getActivoFijo()}</td>";
    $lista.="<td>{$objeto->getNombreEquipo()}</td>";
    $lista.="<th colspan='2' style='text-align:justify'>{$objeto->getJustificacion()}</th>";
    $lista.="<td>{$objeto->getMostrarFechaRealizacion()}</td>";
    $lista.="<td><a href='principal.php?CONTENIDO=mantenimiento/administrador/equiposDeBajaSede.php&ideSede={$objeto->getIdeSede()}&ide={$objeto->getIde()}#detalles' class='enlace'>Detalles</a>";
    $lista.="<br><br><label class='enlace' onclick='restaurar({$objeto->getIde()}," . '"' . "{$sede->getIde()}" . '"' . "," . '"' . "{$objeto->getNombreEquipo()}" . '"' . ")'>Restaurar</label></td>";
    $lista.="<td><a href='mantenimiento/administrador/reporteBajaEquipoSede.php?ideEquipo={$objeto->getIde()}' class='enlace'>Reporte</a></td>";
    $lista.='</tr>';
}
?>
<a href="principal.php?CONTENIDO=mantenimiento/administrador/equiposSede.php&ideSede=<?=$sede->getIde()?>" style="float: left"><img src="../presentacion/iconos/atras.png" title="Volver" height="40px"></a>
<div id="listados">
    <img src="../presentacion/iconos/deBaja1.png" height="90px" style="opacity: 0.8">
    <br>
    <br>
    <table>
        <tr>
            <th>CLIENTE</th>
            <td><?=$sede->getCliente()->getNombre()?></td>
        </tr>
        <tr>
            <th>SEDE</th>
            <td><?=$sede->getNombre()?></td>
        </tr>
    </table>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th>CODIGO ACTIVO FIJO</th>
            <th>EQUIPO</th>
            <th>JUSTIFICACION</th>
            <th></th>
            <th>FECHA DE REALIZACIÓN</th>
            <th colspan="2"></th>
        </tr>
        <?=$lista?>
    </table>
</div>
<div id="detalles" class="modalDialog">
    <div>
    <a href="#close" title="Cerrar" class="close">x</a>
    <center>
        <h3>DETALLES</h3>
        <?php require_once dirname(__FILE__) . '/../../../clasesMantenimiento/Equipo.php'; $equipo=new EquipoDeBaja('ide', $_GET['ide'])?>
        <table id="listados" style="">
            <tr>
                <th>EQUIPO</th><th style="background: rgba(180,180,180,0.1);font-weight: lighter"><?=$equipo->getNombreEquipo()?></th>
            </tr>
            <tr>
                <th>ACTIVO FIJO</th><th style="background: rgba(180,180,180,0.1);font-weight: lighter"><?=$equipo->getActivoFijo()?></th>
            </tr>
            <tr>
                <th>MARCA</th><th style="background: rgba(180,180,180,0.1);font-weight: lighter"><?=$equipo->getMarca()?></th>
            </tr>
            <tr>
                <th>MODELO</th><th style="background: rgba(180,180,180,0.1);font-weight: lighter"><?=$equipo->getModelo()?></th>
            </tr>
            <tr>
                <th>SERIE</th><th style="background: rgba(180,180,180,0.1);font-weight: lighter"><?=$equipo->getSerial()?></th>
            </tr>
            <tr>
                <th>UBICACION</th><th style="background: rgba(180,180,180,0.1);font-weight: lighter"><?=$equipo->getUbicacion()?></th>
            </tr>
            <tr>
                <th>JUSTIFICACCION</th><th style="background: rgba(180,180,180,0.1);font-weight: lighter"><?=$equipo->getJustificacion()?></th>
            </tr>           
            <tr>
                <th>FECHA DE BAJA</th><th style="background: rgba(180,180,180,0.1);font-weight: lighter"><?=$equipo->getMostrarFechaRealizacion()?></th>
            </tr>           
            <tr>
                <th>FECHA DE INGRESO</th><th style="background: rgba(180,180,180,0.1);font-weight: lighter"><?=$equipo->getFechaSistema()?></th>
            </tr>           
        </table>
    </center>
    </div>
</div>
<script>
    function restaurar(ide,ideSede,nombre) {
        if(confirm('Esta seguro de restaurar '+nombre+' al inventario?')){
            location = 'mantenimiento/administrador/restaurarEquipo.php?lugar=sede&ide='+ide+'&ideSede='+ideSede;
        }
    }
</script>