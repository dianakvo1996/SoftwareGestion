<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) . '/../../../clasesGenericas/ConectorBD.php';
require_once dirname(__FILE__) . '/../../../librerias/vendor/autoload.php';

foreach ($_GET as $Variable => $Valor) ${$Variable} = $Valor;
foreach ($_POST as $Variable=> $Valor) ${$Variable} = $Valor;

date_default_timezone_set('America/Bogota');
$origen = $_FILES['rutina']['tmp_name'];
list($rutina, $extension) = explode('.', $_FILES['rutina']['name']);

$nombreArchivo=$rutina. date('YmdHis') . '.' . $extension;
$destino = '/var/www/html/SoftwareGestion/interfaces/mantenimiento/datos/' . $nombreArchivo;

move_uploaded_file($origen, $destino);

//importacion de datos
use PhpOffice\PhpSpreadsheet\Spreadsheet;
$ruta = "/var/www/html/SoftwareGestion/interfaces/mantenimiento/datos/$nombreArchivo";
try {
    $reader= PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xls");
    $spreadsheet=$reader->load($ruta);
    $sheet=$spreadsheet->getActiveSheet();
    foreach ($sheet->getRowIterator(4) as $row) {
        $nombre="";
        $calibrable="";
        $rutinas="";
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(FALSE);
        
        $cadenaRutina="insert into tipoequipo(nombre,calibrable,rutina,tipo,otro)";
        $fila=0;
        foreach ($cellIterator as $cell) {
            $value="";
            if (!is_null($cell)) {
               if ($cell->getCalculatedValue() == "") {
                    $value = "desconocido";
                }else {
                    $value = $cell->getCalculatedValue();
                }
                switch ($fila) {
                    case 1:
                        $nombre = $value;
                        break;
                    case 2:
                        $rutinas = $value;
                        break;
                    case 3:
                        if ($value=='desconocido') {
                            $calibrable='N';
                        } else {
                            $calibrable='S';
                        }
                        break;
                    case 4:
                        $tipo = $value;
                        break;
                    case 5:
                        if ($value=='desconocido') {
                            $otro='';
                        }
                        break;
               }
            }
            $fila++;
        }
        $cadenaRutina.="values('{$nombre}','{$calibrable}','{$rutinas}','{$tipo}','{$otro}')";
        ConectorBD::ejecutarQuery($cadenaRutina, null);
    }
} catch (Exception $e) {
    die('Error loading file: ' . $e->getMessage());
    echo "Problemas de interacciones con los componectes del sistema en el servidor";
}
header('Location: ../../principal.php?CONTENIDO=mantenimiento/administrador/tiposEquipos.php');
