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
$excel = $archivo->load('04_HistorialViviendayEntorno.xlsx');

global $wh;

$query = "SELECT tipo, descripcion FROM entornoH ent INNER JOIN familiaH fam ON ent.idfamiliaH=fam.idfamiliaH AND ent.claveGeneral=fam.claveGeneral WHERE fam.idfamiliaH = $_REQUEST[idfamiliaH] AND codigoFicha = '$_REQUEST[codigoFicha]'";
$result1 = mysql_query($query);

$i=9;
$excel->setActiveSheetIndex(0)->setCellValue('B2', $_REQUEST['claveGeneral']);
$excel->setActiveSheetIndex(0)->setCellValue('B3', $_REQUEST['fechaHistorial']);
$excel->setActiveSheetIndex(0)->setCellValue('B4', date('d/m/Y H:i:s'));
$excel->setActiveSheetIndex(0)->setCellValue('B5', $_REQUEST['codigoFicha']);
$excel->setActiveSheetIndex(0)->setCellValue('B6', $_REQUEST['nombreFamilia']);
while ($row = mysql_fetch_array($result1)) {
    $excel->setActiveSheetIndex(0)
        ->setCellValue('A'.($i), $row[0])
        ->setCellValue('B'.($i), $row[1]);
    $i++;
} 

header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment;filename=04_HistorialViviendayEntorno.xls");
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$objWriter->save('php://output');

?>