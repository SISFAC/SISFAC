<?php
/*
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.

*/
ini_set('max_execution_time', 3000000);
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
$excel = $archivo->load('Reporte_gestantes.xlsx');
global $wh;

$datos = explode('-',datoReporte($_REQUEST[atributo], $_REQUEST[seleccion1]));
$wh = $datos[0];
$querygen = $datos[1];
$campo = $datos[2];

$fechaFin = formatoFecha($_REQUEST['fechaFin']);

$resultgen = mysql_query($querygen);

while($rowgen = mysql_fetch_array($resultgen)){
   /* 
    $query1 = "SELECT '$rowgen[1]', COUNT(*) FROM(SELECT DISTINCT dni
                FROM familiaH fam INNER JOIN personaH per ON fam.idfamiliaH = per.idfamiliaH AND fam.claveGeneral=per.claveGeneral 
                LEFT JOIN condicionH con ON con.idpersonaH = per.idpersonaH AND con.claveGeneral=per.claveGeneral
                WHERE codigoCondicion = 2 $wh AND fechaHistorial<='$fechaFin 23:59:59' AND fam.activo = 'AC' AND per.activo='AC' ) AS T GROUP BY 1";
                //AND fam.idfamiliaH = sf_maxfam(fam.codigoFicha,'$fechaFin 23:59:59') 
   */
    
    $query1 = "SELECT '$rowgen[1]', COUNT(*) FROM(SELECT distinct dni
                FROM familia fam INNER JOIN persona per ON fam.idfamilia = per.idfamilia AND fam.claveGeneral=per.claveGeneral 
                LEFT JOIN condicion con ON con.idpersona = per.idpersona AND con.claveGeneral=per.claveGeneral
                WHERE codigoCondicion = 2 $wh AND fam.activo = 'AC' AND per.activo='AC' ) AS T GROUP BY 1";
 

    $result1 = mysql_query($query1);
    //echo $query1;
    $i=6;
    $style['red_text'] = array(
        'font' => array(
            'name' => 'Arial',
            'color' => array(
                'rgb' => '0074C7'
            )
        ),
    );
    
    
    while ($row = mysql_fetch_array($result1)) {
        $excel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $i-5)
            ->setCellValue('B'.$i, $row[0])
            ->setCellValue('C'.$i, $row[1]);
        $i++;
    }
}


$excel->getActiveSheet()->setCellValue('A2', $_REQUEST['atributo'].' : '.$_REQUEST['seleccion']);//COLUMNAS
$excel->getActiveSheet()->setCellValue('C3', date('d/m/y H:i:s'));//COLUMNAS
$excel->getActiveSheet()->setCellValue('B4', date('d/m/y H:i:s'));//COLUMNAS
// Rename worksheet
$excel->getActiveSheet()->setTitle('Reporte');


// Redirect output to a clientâ€™s web browser (Excel5)
$nombre = 'PERSONAS_GESTANTES'.date('d/m/y H:i:s');
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment;filename=$nombre.xls");
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
$objWriter->save('php://output');


?>