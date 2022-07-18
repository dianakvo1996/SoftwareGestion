<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;
?>
<a href="principal.php?CONTENIDO=calidad/administrador/membretes.php"><img src="../presentacion/iconos/atras.png" title="Volver" width="50px"></a>

<div id="formulario">
    <center>
    <form action="calidad/administrador/membreteActualizar.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <th colspan="2"><?= strtoupper($accion)?> MEMBRETE</th>
            </tr>
            <tr>
                <th>MEMBRETE:</th>
                <td><input type="file" id="archivo" name="membrete" accept=".doc,.docx,.jpg,.png" required></td>
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
<script>
    
</script>