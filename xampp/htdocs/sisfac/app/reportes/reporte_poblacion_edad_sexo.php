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
$excel = $archivo->load('Reporte_persona_edad_sexo.xlsx');

$datos = explode('-',datoReporte($_REQUEST[atributo], $_REQUEST[seleccion1]));
$wh = $datos[0];
$querygen = $datos[1];
$campo = $datos[2];

//echo $querygen.'ssssssssssss';

$resultgen = mysql_query($querygen);
//$array=array('');
$array = array();
$temArray = array();

while ($rowgen = mysql_fetch_array($resultgen)) {
    /*
    $query = "
        SELECT edad, sexo, COUNT(*) as total 
        FROM( 
        SELECT DISTINCT dni,sexo,codigoFicha, fechaNacimiento ,
        CASE WHEN YEAR('$fechaFin') - YEAR(fechaNacimiento) < 0 || YEAR('$fechaFin') - YEAR(fechaNacimiento) > 150 THEN 'NO REGISTRAN EDAD' 
        ELSE YEAR('$fechaFin') - YEAR(fechaNacimiento)  END as edad 
        FROM familiaH fam INNER JOIN personaH per ON fam.idfamiliaH = per.idfamiliaH AND fam.claveGeneral = per.claveGeneral 
        WHERE fam.activo = 'AC' AND per.activo = 'AC' $wh AND fechaHistorial<='$fechaFin 23:59:59' ) AS T 
        GROUP BY 1,2 ORDER BY edad + 0";
        */
    $query = "
        SELECT edad, sexo, COUNT(*) as total 
        FROM( 
        SELECT sexo, 
        CASE WHEN YEAR(CURDATE()) - YEAR(fechaNacimiento) < 0 || YEAR(CURDATE()) - YEAR(fechaNacimiento) > 150 THEN 'NO REGISTRAN EDAD' 
        ELSE YEAR(CURDATE()) - YEAR(fechaNacimiento)  END as edad 
        FROM familia fam INNER JOIN persona per ON fam.idfamilia = per.idfamilia AND fam.claveGeneral = per.claveGeneral 
        WHERE fam.activo = 'AC' AND per.activo = 'AC'  $wh ) AS T 
        GROUP BY 1,2 ORDER BY edad-0";

      
    //fam.activo = 'AC' AND 
    $result = mysql_query($query);
    
    //echo $query."<br/>";
    $j=0;
    while ($row = mysql_fetch_array($result)) {//FILAS
        //echo $row[0].'-'.$row[1].'-'.$row[2].'<br>';
        $j+=$row[2];
        $array[$row[0]][$row[1]] = $row[2];
    }
    //echo $j.'<br>';
}
$i=0;
//print_r($array);
global $temp, $op;
$temp=$op=$suma=0;
foreach ($array as $key => $value) {
    foreach ($value as $clave => $data) {
        $temp = $clave;
        if($temp != '') {
            $i++;
            $temArray[$key][$clave] = $data;
        }
        else $suma+=$data;
    }
    
    if($i!=2){
        if($temp == 'M') $temArray[$key]['F'] = 0;
        if($temp == 'F') $temArray[$key]['M'] = 0;
    }
    $i=0;
}
$j=$k=0;
$w=1;

foreach ($temArray as $key => $value) {
    foreach ($value as $clave => $data) {
        $excel->setActiveSheetIndex(0)->setCellValue('B'.($j + 6), $key);
        if($clave=='F') $excel->setActiveSheetIndex(0)->setCellValue('C'.($j + 6), $data);
        elseif($clave=='M') $excel->setActiveSheetIndex(0)->setCellValue('D'.($j + 6), $data);
    }
    
    $j++;
    $excel->getActiveSheet()->setCellValue('A'.($w+5), $w);
    $w++;
}
if($suma>0){
    $excel->setActiveSheetIndex(0)->setCellValue('C'.($j + 7), "Hay $suma persona(s) que no registra SEXO.")->mergeCells("C".($j+4).":G".($j+4));
}


//print_r($temArray);
$style['red_text'] = array(
        'font' => array(
            'name' => 'Arial',
            'color' => array(
                'rgb' => '0074C7'
            )
        ),
    );
    
    //$excel->setActiveSheetIndex(0)->setCellValue('B1' ,"NÚMERO DE PERSONAS POR EDAD Y SEXO")->mergeCells('B1:G1');
    //$excel->getActiveSheet()->getStyle("B1:G1")->applyFromArray($style['red_text']);

function llenaDatos($excel,$key,$data,$temp,$clave,$j){
    $excel->setActiveSheetIndex(0)->setCellValue('B'.($j + 6), $key);
    if($clave=='F' && $key == $temp) {
        $excel->setActiveSheetIndex(0)->setCellValue('C'.($j + 6), $data);
        $op = 1;
    }elseif($clave=='M' && $key == $temp){
        $excel->setActiveSheetIndex(0)->setCellValue('D'.($j + 6), $data);
        $op = 1;
    }
}

$excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);


$excel->getActiveSheet()->setCellValue('A2', $_REQUEST['atributo'].': '. $_REQUEST['seleccion']);//COLUMNAS
$excel->getActiveSheet()->setCellValue('C3', date('d/m/y H:i:s'));//COLUMNAS
$excel->getActiveSheet()->setCellValue('B4',date('d/m/y H:i:s'));//COLUMNAS


// Rename worksheet
$excel->getActiveSheet()->setTitle('Reporte');



$nombre = 'POBLACION_EDAD_SEXO_'.date('d/m/y H:i:s');
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment;filename=$nombre.xls");
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$objWriter->save('php://output');
exit;

?>  