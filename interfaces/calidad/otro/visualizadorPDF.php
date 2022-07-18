<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable => $Valor) ${$Variable} = $Valor;
$archivo="../ArchivosProcesos/".$ruta;
?>
<object data="<?=$archivo?>" type="application/PDF" width="100%" height="450px" align="right"></object>
    
