<?php
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/TipoEquipo.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

date_default_timezone_set('America/Bogota');
$nombreDescarga="Rutinas_Equipos_".date('Y-m-d_His');

header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename='.$nombreDescarga.'.xls');

$datos= TipoEquipo::getDatosEnObjetos(null, 'nombre');
$lista='';
$prueba='';
$item=1;
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<td>{$item}</td>";
    $lista.="<td>{$objeto->getNombre()}</td>";
    $lista.='</tr>';
    $item++;
}

?>
<style>
    body{
	margin: 10px;
    }
    h2{
	font-family: Arial;
    }
    table{
        border: 1px solid #000;
        margin:auto;
	border-collapse:collapse;
	font-family: Arial;
    }
    table th{
    	font-size:14px;
	background-color: #9999ff;
	border: 1px solid #000;

    }
    table td{
    	font-size:12px;
	border: 1px solid #000;
	line-height:22px;
    }

</style>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<table>
   <tr>
	<th colspan="2" style="width:60px">NOMBRE</th>
   </tr>
	<?=$lista?>
</table
