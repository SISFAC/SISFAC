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
$excel = $archivo->load('Reporte_familia_riesgo_etapa_excel.xlsx');
global $wh;

$datos = explode('-',datoReporte($_REQUEST[atributo], $_REQUEST[seleccion1]));
$wh = $datos[0];
$querygen = $datos[1];
$campo = $datos[2];

//$fechaInicio = formatoFecha($_REQUEST['fechaInicio']);

$resultgen = mysql_query($querygen);

while($rowgen = mysql_fetch_array($resultgen)){
    $query1 = "
        SELECT  
            CASE  
            WHEN puntaje >5 THEN 'A: ALTO RIESGO'  
            WHEN puntaje >=3 THEN 'B: MEDIANO RIESGO'  
            WHEN puntaje >=0 THEN 'C: BAJO RIESGO' END riesgo, COUNT(*)  
            FROM(  
            SELECT fam.claveGeneral,codigoFicha,SUM(puntaje) as puntaje  
            FROM riesgo rie INNER JOIN familia fam ON rie.idfamilia = fam.idfamilia AND rie.claveGeneral=fam.claveGeneral 
            WHERE fam.activo='AC' AND nombreFamilia<>'' $wh  GROUP BY 1,2
            ) AS T  GROUP BY 1
        ";
    //ent.tipo = '$_REQUEST[seleccion1]' $wh AND fechaHistorial<='$fechaFin 23:59:59' AND fam.idfamiliaH = (SELECT MAX(fam1.idfamiliaH) FROM familiaH fam1 
    //      WHERE fam.codigoFicha = fam1.codigoFicha AND fechaHistorial<='$fechaFin 23:59:59' )
    
    $result1 = mysql_query($query1);
    //echo $query1;
    $i=6;
    
    while ($row = mysql_fetch_array($result1)) {
        //$excel->getActiveSheet()->getColumnDimensionByColumn()->setAutoSize(true);
        $excel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $i-5)
            ->setCellValue('B'.$i, $row[0])
            ->setCellValue('C'.$i, $row[1]);
        $i++;
    }    

    

    $excel->getActiveSheet()->setCellValue('A2', $_REQUEST['atributo'].' : '.$_REQUEST['seleccion']);//COLUMNAS
    $excel->getActiveSheet()->setCellValue('C3', date('d/m/y H:i:s'));//COLUMNAS
    $excel->getActiveSheet()->setCellValue('B4', date('d/m/y H:i:s'));//COLUMNAS

    // Redirect output to a clientâ€™s web browser (Excel5)
    $nombre = 'FAMILIA_RIESGO'.date('d/m/y H:i:s');
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=$nombre.xls");
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
    $objWriter->save('php://output');
    


}

?>