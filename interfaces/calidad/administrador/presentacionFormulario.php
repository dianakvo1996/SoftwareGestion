<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;
?>
<a href="principal.php?CONTENIDO=calidad/administrador/presentaciones.php"><img src="../presentacion/iconos/atras.png" title="Volver" width="50px"></a>
<div id="formulario">
    <center>
    <form action="calidad/administrador/presentacionActualizar.php" method="post" enctype="multipart/form-data">
        <label id="alerta" style="color: red"></label>
        <table>
            <tr>
                <th colspan="2"><?= strtoupper($accion)?> PRESENTACION</th>
            </tr>
            <tr>
                <th>Presentación:</th>
                <td><input type="file" name="presentacion" accept=".ppt, .pptx" required></td>
            </tr>
            
            <tr>
            
                <th colspan="2">
                    <input type="submit" value="<?=$accion?>" name="accion">
                </th>
            </tr>
            
        </table>
        
    </form>
    </center>
</div>