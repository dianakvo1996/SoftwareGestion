<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/OpcionesProceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/SubMenuProceso.php';
require_once dirname(__FILE__) . '/../../../clasesCalidad/Proceso.php';

$datosProceso=new Proceso("ide",$ideProceso);
$chekeadoPRO='';
$chekeadoM='';
$chekeadoG='';
$chekeadoP='';
$chekeadoI='';
$chekeadoF='';
if ($accion=='Modificar') {
    $opcionesProceso=new OpcionesProceso("ide", $ideOpcion);
    $datosSubproceso= SubMenuProceso::getDatosEnObjetos('ideOpcion='.$ideOpcion, null);
    
    for ($i = 0; $i < count($datosSubproceso); $i++) {
        $objeto=$datosSubproceso[$i];
        switch ($objeto->getMenu()) {
            case 'PRO':
                $chekeadoPRO='checked';
                break;
            case 'M':
                $chekeadoM='checked';
                break;
            case 'G':
                $chekeadoG='checked';
                break;
            case 'P':
                $chekeadoP='checked';
                break;
            case 'I':
                $chekeadoI='checked';
                break;
            case 'F':
                $chekeadoF='checked';
                break;
        }
        
    }
}else{
    $opcionesProceso=new OpcionesProceso(null, null);
}
?>
<a href="principal.php?CONTENIDO=calidad/administrador/opcionesProceso.php&ideProceso=<?=$ideProceso?>"><img src="../presentacion/iconos/atras.png" title="Volver" height="50px"></a>
<div id="formulario">
    <center>
        <form action="calidad/administrador/opcionesProcesoActualizar.php" method="post" onsubmit="return validarSeleccion()">
        <label id="alerta" style="color: red"></label>
        <table>
            <tr>
                <th colspan="3"><?= strtoupper($accion)?> SUBPROCESO</th>
            </tr>
            <tr>
                <th colspan="3"><?= strtoupper($datosProceso->getNombre())?></th>
            </tr>
            <tr>
                <th>Nombre:</th>
                <td colspan="2"><input type="text" name="nombre" value="<?=$opcionesProceso->getNombre()?>" required></td>
            </tr>
            <tr>
                <th rowspan="3">Opciones:</th>
                
                <td><input type="checkbox" id="sub1" name="sub1"  <?=$chekeadoPRO?> value="PRO" ><label for="sub1">Procedimientos</label></td>
                <td><input type="checkbox" id="sub2" name="sub2" <?=$chekeadoM?> value="M"><label for="sub2">Manuales</label></td>
            </tr>
            <tr>
                <td><input type="checkbox" id="sub3" name="sub3" <?=$chekeadoG?> value="G"><label for="sub3">Guias</label></td>
                <td><input type="checkbox" id="sub4" name="sub4" <?=$chekeadoP?> value="P"><label for="sub4">Protocolos</label></td>
            </tr>
            <tr>
                <td><input type="checkbox" id="sub5" name="sub5" <?=$chekeadoI?> value="I"><label for="sub5">Instructivos</label></td>
                <td><input type="checkbox" id="sub6" name="sub6" <?=$chekeadoF?> value="F"><label for="sub6">Formatos</label></td>
            </tr>
            <tr>
            
                <th colspan="3">
                    <input type="hidden"  name="usuarioActual" value="<?=$_SESSION['usuario']?>">
                    <input type="hidden" name="ideProceso" value="<?=$datosProceso->getIde()?>">
                    <input type="hidden" name="ideOpcion" value="<?=$opcionesProceso->getIde()?>">
                    <input type="hidden" name="nombreAnterior" value="<?=$opcionesProceso->getNombre()?>">
                    <input type="submit" value="<?=$accion?>" name="accion">
                </th>
            </tr>
            
        </table>
        
    </form>
        </center>
</div>
<script>
//    funcion para validar que se seleccione como minimo una de las opciones, y el subproceso quede sin que mostrar
    function validarSeleccion() {
        var contador=0;
        var valido=true;
        for(var i = 1; i < 7; i++){
            if (document.getElementById('sub'+i).checked) {
                contador++;
            }
        }
        if(contador===0){
            valido=false;
            alert('Debe seleccionar como mínimo una de las opciones.');           
        }else{
            valido=true;           
        }
        return valido;
    };
// fin funcion
</script>