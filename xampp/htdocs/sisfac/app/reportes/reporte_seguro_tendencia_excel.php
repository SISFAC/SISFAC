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
$excel = $archivo->load('RepTendencia_PersonasPorSeguro.xlsx');
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



$campos = array('USUARIO', 'AUS/SIS', 'ESSALUD','S.O.A.T' ,'SANIDAD F.A.P' ,'SANIDAD NAVAL' ,'SANIDAD EP' ,'SANIDAD PNP' ,'PRIVADOS' ,'OTROS' ,'EXONERADO' ,'SIN SEGURO');
$celda = array('C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T');
while($rowgen = mysql_fetch_array($resultgen)){
    $query1 = "
        SELECT DISTINCT fecha, tipo, COUNT(*) as total FROM (SELECT DISTINCT DATE_FORMAT(fam.fechaHistorial,'%Y/%m/%d') as fecha, sexo , seguroMedico as tipo, dni
        FROM familiaH fam INNER JOIN personaH per ON fam.idfamiliaH = per.idfamiliaH  AND fam.claveGeneral=per.claveGeneral 
        WHERE per.activo = 'AC' $wh AND fechaHistorial>='$fechaInicio 00:00:00'  AND fechaHistorial<='$fechaFin 23:59:59' AND seguroMedico<>'') AS T 
        GROUP BY 1,2 ORDER BY 1,2
        ";
    
    //ANALFABETA, PRIMARIA SECUNDARIA SUPERIOR
    $result1 = mysql_query($query1);
    //echo $query1;
    $i=6;

    
    while ($row = mysql_fetch_array($result1)) {
        foreach ($campos as $value) {
            if($row[1] == $value) $array[$row[0]][$value] = $row[2];
        }
    }
    //print_r($array);
    
    foreach ($array as $key => $value) {
        foreach ($value as $clave => $data) {
            $sum +=  $data;
        }
        $suma[$key] = $sum;
        $sum = 0;
    }
    
    foreach ($array as $key => $value) {
        //$excel->getActiveSheet()->getColumnDimensionByColumn()->setAutoSize(true);
        $excel->setActiveSheetIndex(0)->setCellValue('A'.$i, $i-5);
        $excel->setActiveSheetIndex(0)->setCellValue('B'.$i, $key);
        foreach ($value as $clave => $data) {
            if($clave == 'USUARIO') $excel->setActiveSheetIndex(0)->setCellValue('C'.$i, formatoNumero($data*100/$suma[$key],2));
            if($clave == 'AUS/SIS') $excel->setActiveSheetIndex(0)->setCellValue('D'.$i, formatoNumero($data*100/$suma[$key],2));
            if($clave == 'ESSALUD') $excel->setActiveSheetIndex(0)->setCellValue('E'.$i, formatoNumero($data*100/$suma[$key],2));
            if($clave == 'S.O.A.T') $excel->setActiveSheetIndex(0)->setCellValue('F'.$i, formatoNumero($data*100/$suma[$key],2));
            if($clave == 'SANIDAD F.A.P') $excel->setActiveSheetIndex(0)->setCellValue('G'.$i, formatoNumero($data*100/$suma[$key],2));
            if($clave == 'SANIDAD NAVAL') $excel->setActiveSheetIndex(0)->setCellValue('H'.$i, formatoNumero($data*100/$suma[$key],2));
            if($clave == 'SANIDAD EP') $excel->setActiveSheetIndex(0)->setCellValue('I'.$i, formatoNumero($data*100/$suma[$key],2));
            if($clave == 'SANIDAD PNP') $excel->setActiveSheetIndex(0)->setCellValue('J'.$i, formatoNumero($data*100/$suma[$key],2));
            if($clave == 'PRIVADOS') $excel->setActiveSheetIndex(0)->setCellValue('K'.$i, formatoNumero($data*100/$suma[$key],2));
            if($clave == 'OTROS') $excel->setActiveSheetIndex(0)->setCellValue('L'.$i, formatoNumero($data*100/$suma[$key],2));
            if($clave == 'EXONERADO') $excel->setActiveSheetIndex(0)->setCellValue('M'.$i, formatoNumero($data*100/$suma[$key],2));
            if($clave == 'SIN SEGURO') $excel->setActiveSheetIndex(0)->setCellValue('N'.$i, formatoNumero($data*100/$suma[$key],2));
            $k++;
        }
        $k=0;
        $i++;
    }
    
    $k=0;$m=$t=0;
    //echo $i;
    for ($m = 6; $m < $i; $m++) {//RECORREMOS FILAS
        for ($j = 3; $j < 14; $j++) {//RECORREMOS COLUMNAS
            if($excel->getActiveSheet()->getCell($celda[$k].$m)->getValue()==''){
                $excel->setActiveSheetIndex(0)->setCellValue($celda[$k].$m, formatoNumero(0,2));
            }
            $k++;
        }
        $k=0;
    }
    
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