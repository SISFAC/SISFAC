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
// Create new PHPExcel object
global $wh,$excel,$querygen;
$excel = new PHPExcel();

$archivo = PHPExcel_IOFactory::createReader('Excel2007');
$excel = $archivo->load('Reporte_familia_riesgo_excel.xlsx');

$datos = explode('-',datoReporte($_REQUEST[atributo], $_REQUEST[seleccion1]));
$wh = $datos[0];
$querygen = $datos[1];
$campo = $datos[2];


$resultgen = mysql_query($querygen);
$array = array();
$temArray = array();


$query = "SELECT fam.idfamilia, fam.claveGeneral, fam.nombreFamilia, fam.codigoFicha, 
            (SELECT SUM(riesgo.puntaje) AS total FROM riesgo WHERE riesgo.idfamilia=fam.idfamilia AND fam.claveGeneral=riesgo.claveGeneral and etapa='FAMILIA') AS t 
            FROM familia fam WHERE fam.activo = 'AC' $wh 
            GROUP BY fam.idfamilia, fam.claveGeneral,fam.nombreFamilia, fam.codigoFicha having t>0 ORDER BY t desc";

      
$result = mysql_query($query);

$i=6;
while ($row = mysql_fetch_array($result)) {

    $query = "SELECT nombreRiesgo, codRiesgo, puntaje from riesgo where claveGeneral='$row[1]' and idfamilia=$row[0] and etapa='FAMILIA' order by nombreRiesgo asc";
      
    $result2 = mysql_query($query);


    while ($row2 = mysql_fetch_array($result2)) {
        $excel->setActiveSheetIndex(0)->setCellValue('A'.$i, $row[2] )->setCellValue('B'.$i, $row[3] )->setCellValue('C'.$i, $row2[1] )->setCellValue('D'.$i, $row2[0])->setCellValue('E'.$i, $row2[2])->setCellValue('F'.$i, $row[4]);
        $i++;
    }  


}


$excel->getActiveSheet()->setCellValue('A2', $_REQUEST['atributo'].': '. $_REQUEST['seleccion']);//COLUMNAS
$excel->getActiveSheet()->setCellValue('B4',date('d/m/y H:i:s'));//COLUMNAS

$nombre = 'RIESGO'.date('Y-m-d-H-i-s');

$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment;filename=$nombre.xls");
header('Cache-Control: max-age=0');
$objWriter->save('php://output');
exit();
?>  