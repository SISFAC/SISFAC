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
$excel = $archivo->load('01_HistorialDatosFamilia.xlsx');

global $wh;

$query = "SELECT claveGeneral, fechaHistorial, fechaApertura, codigoFicha, nombreFamilia, nombreSector, lote, telefono, correo, referencia, 
        tipoEntorno, idioma1, idioma2, idioma3, tiempoDemora, tiempoDomicilio, viviendaAnterior, medioTransporte, religion, diaVisita, horaVisita, 
        tipoFamilia, activo, motivo, registrador, trabajador 
        FROM familiaH WHERE idfamiliaH = $_REQUEST[idfamiliaH] AND codigoFicha = '$_REQUEST[codigoFicha]'";

$result1 = mysql_query($query);
$i=2;
$j=0;

while ($row = mysql_fetch_array($result1)) {
    $excel->setActiveSheetIndex(0)
        ->setCellValue('B'.($i++), $row['claveGeneral'])
        ->setCellValue('B'.($i++), $row['fechaHistorial'])
        ->setCellValue('B'.($i++), $row['fechaApertura'])
        ->setCellValue('B'.($i++), $row['codigoFicha'])
        ->setCellValue('B'.($i++), $row['nombreFamilia']);
        $i=9;
        $excel->setActiveSheetIndex(0)
        ->setCellValue('B'.($i++), $row['nombreSector'])
        ->setCellValue('B'.($i++), $row['codigoFicha'])
        ->setCellValue('B'.($i++), $row['fechaApertura'])
        ->setCellValue('B'.($i++), $row['nombreFamilia'])
        ->setCellValue('B'.($i++), $row['lote'])
        ->setCellValue('B'.($i++), $row['telefono'])
        ->setCellValue('B'.($i++), $row['correo'])
        ->setCellValue('B'.($i++), $row['referencia'])
        ->setCellValue('B'.($i++), $row['tipoEntorno'])
        ->setCellValue('B'.($i++), ($row['idioma1'].'-'.$row['idioma2'].'-'.$row['idioma3']))
        ->setCellValue('B'.($i++), $row['tiempoDemora'])
        ->setCellValue('B'.($i++), $row['tiempoDomicilio'])
        ->setCellValue('B'.($i++), $row['viviendaAnterior'])
        ->setCellValue('B'.($i++), $row['medioTransporte'])
        ->setCellValue('B'.($i++), $row['religion'])
        ->setCellValue('B'.($i++), $row['diaVisita'])
        ->setCellValue('B'.($i++), $row['horaVisita'])
        ->setCellValue('B'.($i++), $row['tipoFamilia'])
        ->setCellValue('B'.($i++), ($row['activo']=='AC'?'ACTIVO':'INACTIVO'))
        ->setCellValue('B'.($i++), $row['motivo'])
        ->setCellValue('B'.($i++), $row['registrador'])
        ->setCellValue('B'.($i++), $row['trabajador']);
}    


header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment;filename=01_HistorialDatosFamilia.xls");
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$objWriter->save('php://output');

?>