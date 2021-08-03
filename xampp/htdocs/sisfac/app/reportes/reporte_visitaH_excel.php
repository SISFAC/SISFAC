<?php
/*
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.

*/
ini_set('max_execution_time', 30000);
error_reporting(E_ALL);
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

/** Include PHPExcel */
require_once('../../phpexcel/PHPExcel.php');
require_once('../../conexion/Conexion.php');
$cnn = new Conexion();
$cnn->abrirConexion();

$excel = new PHPExcel();
$archivo = PHPExcel_IOFactory::createReader('Excel2007');
$excel = $archivo->load('05_HistorialVisitasDomiciliarias.xlsx');

global $wh;

$query = "SELECT fechaVisita, resultado, fechaCita, estadoCita, vis.motivo, vis.trabajador FROM visitaH vis INNER JOIN familiaH fam ON vis.idfamiliaH=fam.idfamiliaH AND vis.claveGeneral=fam.claveGeneral WHERE fam.idfamiliaH = $_REQUEST[idfamiliaH]  AND codigoFicha = '$_REQUEST[codigoFicha]'";
$result1 = mysql_query($query);

$i=9;
$j=1;
$excel->setActiveSheetIndex(0)->setCellValue('C2', $_REQUEST['claveGeneral']);
$excel->setActiveSheetIndex(0)->setCellValue('C3', $_REQUEST['fechaHistorial']);
$excel->setActiveSheetIndex(0)->setCellValue('C4', date('d/m/Y H:i:s'));
$excel->setActiveSheetIndex(0)->setCellValue('C5', $_REQUEST['codigoFicha']);
$excel->setActiveSheetIndex(0)->setCellValue('C6', $_REQUEST['nombreFamilia']);
while ($row = mysql_fetch_array($result1)) {
    $excel->setActiveSheetIndex(0)
        ->setCellValue('A'.($i), $j++)
        ->setCellValue('B'.($i), $row[0])
        ->setCellValue('C'.($i), $row[1])
        ->setCellValue('D'.($i), $row[2])
        ->setCellValue('E'.($i), $row[3])
        ->setCellValue('F'.($i), $row[4])
        ->setCellValue('G'.($i), $row[5]);
    $i++;
} 

header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment;filename=05_HistorialVisitasDomiciliarias.xls");
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$objWriter->save('php://output');

?>