<?php

require_once dirname(__FILE__) . '/../../../clasesGenericas/ConectorBD.php';
require_once dirname(__FILE__) . '/../../../clasesMantenimiento/TipoEquipo.php';
require_once dirname(__FILE__) . '/../../../librerias/vendor/autoload.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

date_default_timezone_set('America/Bogota');
$origen = $_FILES['equipos']['tmp_name'];
list($equipos, $extension) = explode('.', $_FILES['equipos']['name']);

$nombreArchivo=$equipos. date('YmdHis') . '.' . $extension;
$destino = '/var/www/html/SoftwareGestion/interfaces/mantenimiento/datos/' . $nombreArchivo;

move_uploaded_file($origen, $destino);

//importamos los datos
use PhpOffice\PhpSpreadsheet\Spreadsheet;
$ruta = "/var/www/html/SoftwareGestion/interfaces/mantenimiento/datos/$nombreArchivo";
echo $ruta;
try {
    $reader= PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xls");
    $spreadsheet=$reader->load($ruta);
    $sheet=$spreadsheet->getActiveSheet();
    
    foreach ($sheet->getRowIterator(13) as $row) {
        $nombreEquipo=null;
        $marca=null;
        $modelo=null;
        $serial=null;
        $activoFijo=null;
        $ubicacion=null;
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(FALSE);
        
        $cadenaSQL="insert into equipoC(nombreEquipo,marca,modelo,serial,activoFijo, ubicacion,ideSede)";
        $fila=0;
        
        foreach ($cellIterator as $cell) {
           $value="";
           if (!is_null($cell)) {
               if ($cell->getCalculatedValue() == '') {
                    $value = null;
               } else {
                    $value = "'".$cell->getCalculatedValue()."'";
                }
              switch ($fila) {
                case 1:
                    $activoFijo = $value;
                    break;
                case 2:
                    $nombreEquipo = TipoEquipo::sanearCadena($value);                    
                    break;
                case 3:
                    $marca = $value;                    
                    break;
                case 4:
                    $modelo = $value;                    
                    break;
                case 5:
                    $serial = $value;
                    break;
                case 6:
                    $ubicacion = $value;
                    break;
                } 
           }
           $fila++;           
        }
        $cadenaSQL.="values({$nombreEquipo},{$marca},{$modelo},{$serial},{$activoFijo},{$ubicacion},{$ideSede})";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
        
    }
} catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
    die('Error loading file: ' . $e->getMessage());
    echo "Problemas de interacciones con los componentes del sistema en el servidor";
}
echo "<script> window.location='../../principal.php?CONTENIDO=calibracion/administrador/equiposSede.php&ideSede=".$ideSede."'; </script>";
//header('Location: ../../principal.php?CONTENIDO=mantenimiento/administrador/equiposSede.php&ideSede='.$ideSede);
