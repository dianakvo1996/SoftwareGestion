<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesCalidad/ArchivoExtra.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

$archivo=new ArchivoExtra("tipo", "'".$tipo."'");

switch ($tipo) {
    case 'DE':        
        $titulo="DIRECCIONAMIENTO ESTRATÉGICO";
     break;
    case 'PE':
        $titulo="PLATAFORMA ESTRATÉGICA";
     break;
    case 'GC':
        $titulo="GESTIÓN DE CALIDAD";
     break;
    case 'PD':
        $titulo="PIRÁMIDE DOCUMENTAL";
     break;
    case 'RH':
        $titulo="RESEÑA HISTÓRICA";
     break;
    case 'CI':
        $titulo="CLIENTES Y PARTES INTERESADAS";
     break;
}
?>
<a href="principal.php?CONTENIDO=calidad/administrador/visualizadorArchivos.php&tipo=<?=$tipo?>"><img src="../presentacion/iconos/atras.png" title="Volver" width="50px"></a>
<div id="formulario">
    <center>
    <form action="calidad/administrador/archivoExtraActualizar.php" method="post" enctype="multipart/form-data">
        <label id="alerta" style="color: red"></label>
        <table>
            <tr>
                <th colspan="2">CAMBIAR <?= strtoupper($titulo)?> </th>
            </tr>
            <tr>
                <th>Archivo:</th>
                <td><input type="file" name="archivo" accept=".pdf" required></td>
            </tr>
            
            <tr>
            
                <th colspan="2">
                    <input type="hidden" value="<?=$_SESSION['usuario']?>" name="usuarioActual">
                    <input type="hidden" value="<?=$archivo->getArchivo()?>" name="archivoAnterior">
                    <input type="hidden" value="<?=$tipo?>" name="tipo">
                    <input type="submit" value="Cambiar" name="accion">
                </th>
            </tr>
            
        </table>       
    </form>
    </center>
</div>
