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
//ini_set('memory_limit', '3000M');
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
$excel = $archivo->load('Piramide matriz2.xlsx');

global $wh;

$datos = explode('-',datoReporte($_REQUEST[atributo], $_REQUEST[seleccion1]));
$wh = $datos[0];
$querygen = $datos[1];
$campo = $datos[2];
//$fechaInicio = formatoFecha($_REQUEST['fechaInicio']);
$fechaFin = formatoFecha($_REQUEST['fechaFin']);

$resultgen = mysql_query($querygen);

while($rowgen = mysql_fetch_array($resultgen)){ 

  
    $query1 = "SELECT TIMESTAMPDIFF(YEAR, fechaNacimiento, CURDATE()) edad, sexo, COUNT(*)  FROM (
            SELECT distinct per.idpersona,sexo,codigoFicha, fechaNacimiento 
        FROM familia fam INNER JOIN persona per ON fam.idfamilia = per.idfamilia AND fam.claveGeneral = per.claveGeneral 
        WHERE fam.activo = 'AC' AND per.activo = 'AC'  $wh) AS T where TIMESTAMPDIFF(YEAR, fechaNacimiento, CURDATE()) is not null GROUP BY 1,2";

   // echo $query1; exit();

    $result1 = mysql_query($query1);
    $i=0;
    $ini = 4; 
    $suma = 5;
    $j=0;
    while ($row = mysql_fetch_array($result1)) {
        
        if($row[0] >= 0){
            if($row[1] == 'F'){
                if($i==$row[0]) {
                    $valores[$i] = array($row[1]=>$row[2]);
                }else{
                    while($i!=$row[0]){
                        $valores[$i] = array('F'=>0);
                        $i++;
                        if($i==$row[0]) {
                            $op=1;
                        }
                    }    
                }
                if($op==1) {
                    $op=0;
                    $valores[$i] = array($row[1]=>$row[2]);
                }
                $i++;
            }
        }
    }
    //print_r($valores);
    foreach ($valores as $key => $value) {
        foreach ($value as $k => $v) {
            if($key<100){
                if($key<=$ini+1){
                    $temp +=$v;
                }
                if($key==$ini){
                    $array[$ini] = $temp;
                    $temp=0;
                    $ini +=$suma;
                }
            }
            elseif($key>=100){
                $array[100] += $v;
            }
        }
        if($temp>0) {
            $array[$key] = $temp;
            $ktem = $key;
        }
    }
    
    //print_r($array);
    unset($valores);
    
    $i=6;
    $j=4;
    for ($i = 6; $i <= 26; $i++) {
        $excel->setActiveSheetIndex(0)
        ->setCellValue('C'.$i, $array[$j]);
        $j +=5;
    }
    
    
    $excel->setActiveSheetIndex(0)->setCellValue('C'.(intval($ktem/5)+6), $array[$ktem]);
    
    $excel->setActiveSheetIndex(0)->setCellValue('C26', $array[100]);
    
    $i=0;
    $ini = 4; $suma = 5;
    $j=0; $temp=0; $op=0;
    $result = mysql_query($query1);
    while ($row = mysql_fetch_array($result)) {
        if($row[0] >= 0){
            if($row[1] == 'M'){
                if($i==$row[0]) {
                    $valores1[$i] = array($row[1]=>$row[2]);
                }else{
                    while($i!=$row[0]){
                        $valores1[$i] = array('M'=>0);
                        $i++;
                        if($i==$row[0]) {
                            $op=1;
                        }
                    }
                }
                if($op==1) {
                    $op=0;
                    $valores1[$i] = array($row[1]=>$row[2]);
                }
                $i++;
            }
        }

    }

    foreach ($valores1 as $key => $value) {
        foreach ($value as $k => $v) {
            if($key<100){
                if($key<=$ini+1){
                    $temp +=$v;
                }
                if($key==$ini){
                    $array1[$ini] = $temp;
                    $temp=0;
                    $ini +=$suma;
                }
            }
            elseif($key>=100){
                $array1[100] += $v;
            }
        }
        if($temp>0) {
            $array1[$key] = $temp;
            $ktem1=$key;
        }
    }
    unset ($valores1);
    //print_r($array1);
    $i=6;
    $j=4;
    $suma=0;
    for ($i = 6; $i <= 26; $i++) {
        $suma+=$array1[$j];
        $excel->setActiveSheetIndex(0)
        ->setCellValue('D'.$i, $array1[$j]);
        $j +=5;
    }
    $excel->setActiveSheetIndex(0)->setCellValue('D'.(intval($ktem1/5)+6), $array1[$ktem1]);
    $suma+=$array1[$ktem1];
    $excel->setActiveSheetIndex(0)->setCellValue('D26', $array1[100]);
    $suma+=$array1[100];
    $excel->setActiveSheetIndex(0)->setCellValue('D27', $suma);
    

    $excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);

    //$excel->getActiveSheet()->setCellValue('A2', $_REQUEST['atributo']);//COLUMNAS
    //$excel->getActiveSheet()->setCellValue('D2', date('d/m/y H:i:s'));//COLUMNAS
    
    //$excel->getActiveSheet()->setCellValue('A2', 'REPORTE NUMERO DE FAMILIA POR '.$_REQUEST['atributo1']);//COLUMNAS
    $excel->getActiveSheet()->setCellValue('A2', $_REQUEST['atributo']." - ".$_REQUEST['seleccion']);//COLUMNAS
    $excel->getActiveSheet()->setCellValue('C3', date('d/m/y H:i:s'));//COLUMNAS


    // Redirect output to a clientâ€™s web browser (Excel5)
    $nombre = 'Reporte'.date('d/m/y H:i:s');
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=$nombre.xls");
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
    $objWriter->save('php://output');
}

?>