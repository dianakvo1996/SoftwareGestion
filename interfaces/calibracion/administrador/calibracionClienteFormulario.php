<?php

require_once dirname(__FILE__) . '/../../../clasesCalibracion/CronogramaC.php';
require_once dirname(__FILE__) . '/../../../clasesGenericas/ConectorBD.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

date_default_timezone_set('America/Bogota');
$cronogramaCalibracion=new CronogramaC('ide', $ideCronograma);

//inicio caluculo siguiente calibracion
$ultimaCalibracion= ConectorBD::ejecutarQuery("select max(fecha) as ultimaCalibracion from calibracion where ideCronograma={$cronogramaCalibracion->getIde()}", null);

$proximoMes=str_pad($cronogramaCalibracion->getMes(), 2,'0',STR_PAD_LEFT);
if ($ultimaCalibracion[0][0]!=null) {
        $fecha= date_create($ultimaCalibracion[0][0]);
        $mes = date_format($fecha,'m');
        $mesSiguiente=$mes+$cronogramaCalibracion->getPerioricidad();
    if ($mesSiguiente < 12) {  
        $proximoMes=str_pad($mesSiguiente, 2,'0',STR_PAD_LEFT);
    } else {
        $proximoMes=str_pad($cronogramaCalibracion->getMes(), 2,'0',STR_PAD_LEFT);
    }
} 
//fin caluculo siguiente calibracion
?>
<a href="principal.php?CONTENIDO=calibracion/administrador/cronogramaCliente.php&nitCliente=<?=$cronogramaCalibracion->getNitCliente()?>"><img src="../presentacion/iconos/atras.png" title="Volver" height="20px"></a>
<div id="formulario">
    <form method="POST" action="calibracion/administrador/calibracionClienteActualizar.php">
    <center>
    <table>
        <tr>
            <th colspan="2">ADICIONAR CALIBRACIÓN</th>
        </tr>
        <tr>
            <th>Fecha</th>
            <td>
                <input type="date" name="fecha" value="<?=date('Y').'-'.$proximoMes?>-01">
            </td>
        </tr>
        <tr>
            <th colspan="2">
                <input type="hidden" name="ideCronograma" value="<?=$ideCronograma?>">
                <input type="submit" value="Adicionar" name="accion">
            </th>
        </tr>
    </table>
    </center>
    </form>
</div>