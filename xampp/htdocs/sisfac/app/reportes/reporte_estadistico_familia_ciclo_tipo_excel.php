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
$excel = $archivo->load('Reporte_estadistico_familia_ciclo_tipo_excel.xlsx');
global $wh;

$datos = explode('-',datoReporte($_REQUEST[atributo], $_REQUEST[seleccion1]));
$wh = $datos[0];
$querygen = $datos[1];
$campo = $datos[2];


$resultgen = mysql_query($querygen);


while($rowgen = mysql_fetch_array($resultgen)){
    if($_REQUEST['atributo1'] == 'CICLO VITAL'){
        $query1 = "
        SELECT nombreCiclo,COUNT(*) 
        FROM (
            SELECT CASE WHEN 
                INSTR(nombreCiclo, 'FAMILIA EXPANSION')>0 THEN 'FAMILIA EN EXPANSION' ELSE nombreCiclo END as nombreCiclo,codigoFicha,fam.claveGeneral
            FROM familia fam INNER JOIN ciclo cic ON fam.idfamilia=cic.idfamilia AND fam.claveGeneral=cic.claveGeneral 
            WHERE fam.activo = 'AC' $wh 
        ) AS T GROUP BY 1 ORDER BY 1 desc
        ";

    }
    elseif($_REQUEST['atributo1'] == 'TIPO FAMILIA'){
        $query1 = "SELECT tipoFamilia as nombreCiclo,COUNT(*) as total FROM (
                SELECT codigoFicha, claveGeneral, tipoFamilia 
                FROM familia fam 
               WHERE fam.activo = 'AC' $wh AND tipoFamilia <>'') AS T GROUP BY 1 ORDER BY 1 desc";
    }
    
    
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
    $j=0;
    
    while ($row = mysql_fetch_array($result1)) {
        //$excel->getActiveSheet()->getColumnDimensionByColumn()->setAutoSize(true);
        if($row[0]!=''){
            $excel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $i-5)
                ->setCellValue('B'.$i, $row[0])
                ->setCellValue('C'.$i, $row[1]);
            $i++;
        }else $j+= $row[1];
        
    }    
    $excel->setActiveSheetIndex(0)->setCellValue('B'.($i+1) ,"Hay $j familia(s) que no registran $_REQUEST[atributo1]")->mergeCells("B".($i+1).":Z".($i+1));

    
    $excel->getActiveSheet()->setCellValue('A1', 'REPORTE NUMERO DE FAMILIA POR '.$_REQUEST['atributo1']);//COLUMNAS
    $excel->getActiveSheet()->setCellValue('A2', $_REQUEST['atributo'].' : '.$_REQUEST['seleccion']);//COLUMNAS
    $excel->getActiveSheet()->setCellValue('C3', date('d/m/y H:i:s'));//COLUMNAS
    $excel->getActiveSheet()->setCellValue('B4', date('d/m/y H:i:s'));//COLUMNAS
 
    // Redirect output to a clientâ€™s web browser (Excel5)
    $nombre = $_REQUEST['atributo1'].date('d/m/y H:i:s');
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=$nombre.xls");
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
    $objWriter->save('php://output');

}

?>