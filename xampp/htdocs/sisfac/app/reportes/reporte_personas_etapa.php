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
//$archivo->setIncludeCharts(TRUE);
//$archivo->getActiveSheet(0)->addChart();
$excel = $archivo->load('Reporte_personas_etapa.xlsx');
//$archivo->setIncludeCharts(TRUE);
global $wh;
$datos = explode('-',datoReporte($_REQUEST[atributo], $_REQUEST[seleccion1]));
$wh = $datos[0];
$querygen = $datos[1];
$campo = $datos[2];



function obtenerMaximo($codigoFicha){
    $row = mysql_fetch_array(mysql_query("SELECT MAX(fam1.idfamilia) FROM familia fam1 
            WHERE  fam1.codigoFicha = '$codigoFicha'"));
    return $row[0];
}

$resultgen = mysql_query($querygen);
$rowgen = mysql_fetch_array($resultgen);
//while($rowgen = mysql_fetch_array($resultgen)){

   $query1 = "
        SELECT DISTINCT etapa,COUNT(*) as total FROM( SELECT CASE
	WHEN (fechaNacimiento) = '0000-00-00' || (fechaNacimiento) = ''  THEN 'F: NO REGISTRAN EDAD'
        WHEN (YEAR(CURDATE()) - YEAR(fechaNacimiento))>=0 AND (YEAR(CURDATE()) - YEAR(fechaNacimiento))<12 THEN 'A: ETAPA NIÑO(0-11 AÑOS)'
        WHEN  (YEAR(CURDATE()) - YEAR(fechaNacimiento))>=12 AND (YEAR(CURDATE()) - YEAR(fechaNacimiento))<18 THEN 'B: ETAPA ADOLESCENTE (12-17 AÑOS)'
        WHEN  (YEAR(CURDATE()) - YEAR(fechaNacimiento))>=18  AND  (YEAR(CURDATE()) - YEAR(fechaNacimiento)) <30 THEN 'C: ETAPA JOVEN(18-29 AÑOS)'
        WHEN  (YEAR(CURDATE()) - YEAR(fechaNacimiento))>=30 AND (YEAR(CURDATE()) - YEAR(fechaNacimiento))<60 THEN 'D: ETAPA ADULTO(30-59 AÑOS)'
        WHEN  YEAR(CURDATE()) - YEAR(fechaNacimiento)>=60 THEN 'E: ETAPA ADULTO MAYOR(60 AÑOS A MAS)'
        END as etapa ,fechaNacimiento
		FROM familia fam INNER JOIN persona per ON fam.idfamilia = per.idfamilia AND fam.claveGeneral = per.claveGeneral
        WHERE per.activo = 'AC' and fam.activo = 'AC' $wh) AS T WHERE etapa<>''
        GROUP BY 1 ORDER BY etapa"; 
		
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
        //$excel->getActiveSheet()->getColumnDimensionByColumn()->setAutoSize(true);
        $excel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $i-5)
            ->setCellValue('B'.$i, $row[0])
            ->setCellValue('C'.$i, $row[1]);
        $i++;
    }    
    
    $excel->getActiveSheet()->setCellValue('A2', $_REQUEST['atributo'].': '. $_REQUEST['seleccion']);//COLUMNAS
    $excel->getActiveSheet()->setCellValue('C3', date('d/m/y H:i:s'));//COLUMNAS
    $excel->getActiveSheet()->setCellValue('B4', date('d/m/y H:i:s'));//COLUMNAS
    // Redirect output to a clientâ€™s web browser (Excel5)
    $nombre = 'ETAPAVIDA'.date('d/m/y H:i:s');
    //header('Content-Type: application/vnd.ms-excel');
    //header("Content-Disposition: attachment;filename=$nombre.xls");
    //header('Cache-Control: max-age=0');
    
    $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    

    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment;filename=$nombre.xls");
    header('Cache-Control: max-age=0');

    $objWriter->save('php://output');

//}

?>