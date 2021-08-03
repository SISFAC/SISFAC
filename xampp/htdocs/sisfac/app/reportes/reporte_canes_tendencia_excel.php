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
$excel = $archivo->load('RepTendencia_NumeroCanesPorFamilia.xlsx');
global $wh;$k=0;$sum=0;$tem;

$datos = explode('-',datoReporte($_REQUEST[atributo], $_REQUEST[seleccion1]));
$wh = $datos[0];
$querygen = $datos[1];
$campo = $datos[2];

$fechaInicio = formatoFecha($_REQUEST['fechaInicio']);
$fechaFin = formatoFecha($_REQUEST['fechaFin']);

$resultgen = mysql_query($querygen);
$array = array();
$suma = array();
$campos = array('NUMERO DE CANES');
$celda = array('C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T');
while($rowgen = mysql_fetch_array($resultgen)){
    $query1 = "
        SELECT DISTINCT DATE_FORMAT(fam.fechaHistorial,'%Y/%m/%d') as fecha,tipo, SUM(ent.descripcion) as total
        FROM familiaH fam INNER JOIN entornoH ent ON fam.idfamiliaH=ent.idfamiliaH AND fam.claveGeneral=ent.claveGeneral 
        WHERE ent.tipo = 'NUMERO DE CANES' $wh AND fam.idfamiliaH = sf_maxfam(fam.codigoFicha,'$fechaFin') 
        AND ent.descripcion<>'' AND fechaHistorial>='$fechaInicio 00:00:00' AND fechaHistorial<='$fechaFin 23:59:59' 
        GROUP BY 1,2 ORDER BY 1";
    $result1 = mysql_query($query1);
    $i=6;
    
    while ($row = mysql_fetch_array($result1)) {
        $excel->setActiveSheetIndex(0)->setCellValue('A'.$i, $i-5);
        $excel->setActiveSheetIndex(0)->setCellValue('B'.$i, $row[0]);
        $excel->setActiveSheetIndex(0)->setCellValue('C'.$i, $row[2]);
    }
    //print_r($array);
    /*
    foreach ($array as $key => $value) {
        foreach ($value as $clave => $data) {
            $sum +=  $data;
        }
        $suma[$key] = $sum;
        $sum = 0;
    }
    
    foreach ($array as $key => $value) {
        $excel->setActiveSheetIndex(0)->setCellValue('A'.$i, $i-5);
        $excel->setActiveSheetIndex(0)->setCellValue('B'.$i, $key);
        foreach ($value as $clave => $data) {
            $excel->setActiveSheetIndex(0)->setCellValue($celda[$k].$i, formatoNumero($data*100/$suma[$key],2));
            $k++;
        }
        $k=0;
        $i++;
    }
    */
    //print_r($array);

    $excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
    
    $excel->getActiveSheet()->setCellValue('A2', $_REQUEST['atributo'].' : '.$_REQUEST['seleccion']);//COLUMNAS
    $excel->getActiveSheet()->setCellValue('C3', date('d/m/y H:i:s'));//COLUMNAS
    $excel->getActiveSheet()->setCellValue('B4', $_REQUEST['fechaInicio']);//COLUMNAS
    $excel->getActiveSheet()->setCellValue('D4', $_REQUEST['fechaFin']);//COLUMNAS
    // Redirect output to a clientâ€™s web browser (Excel5)
    $nombre = 'REPORTE_TENDENCIA'.date('d/m/y H:i:s');
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=$nombre.xls");
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
    $objWriter->save('php://output');

}

?>