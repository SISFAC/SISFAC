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
$excel = $archivo->load('Reporte_ficha.xlsx');

global $wh;

$datos = explode('-',datoReporte($_REQUEST[atributo], $_REQUEST[seleccion1]));
$wh = $datos[0];
$querygen = $datos[1];
$campo = $datos[2];

$resultgen = mysql_query($querygen);
$fechaFin = formatoFecha($_REQUEST['fechaFin']);
//echo $querygen;
while($rowgen = mysql_fetch_array($resultgen)){
    $query1 = "SELECT codigoFicha,nombreFamilia,nompro, nombre, nombreComunidad, fam.nombreSector, telefono, correo, lote, idioma1, idioma2, idioma3, religion, 
                viviendaAnterior, tiempoDemora, tiempoDomicilio, medioTransporte,diaVisita, horaVisita , tipoEntorno, referencia
                FROM familia fam 
                WHERE fam.activo = 'AC' $wh";//; //AND fam.idfamiliaH = sf_maxfam(fam.codigoFicha,'$fechaFin 23:59:59')
    //echo $query1;
    $result1 = mysql_query($query1);
    $i=6;
    $style['red_text'] = array(
        'font' => array(
            'name' => 'Arial',
            'color' => array(
                'rgb' => '0074C7'
            )
        ),
    );
    
    //$excel->setActiveSheetIndex(0)->setCellValue('B1' ,"REPORTE FICHA FAMILIAR")->mergeCells('B1:G1');
    //$excel->getActiveSheet()->getStyle("B1:G1")->applyFromArray($style['red_text']);
    while ($row = mysql_fetch_array($result1)) {
        //$excel->getActiveSheet()->getColumnDimensionByColumn()->setAutoSize(true);
        $excel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $i-5)
            ->setCellValue('B'.$i, $row[0])
            ->setCellValue('C'.$i, $row[1])
            ->setCellValue('D'.$i, $row[2])
            ->setCellValue('E'.$i, $row[3])
            ->setCellValue('F'.$i, $row[4])
            ->setCellValue('G'.$i, $row[5])
            ->setCellValue('H'.$i, $row[6])
            ->setCellValue('I'.$i, $row[7])
            ->setCellValue('J'.$i, $row[8])
            ->setCellValue('K'.$i, $row[9])
            ->setCellValue('L'.$i, $row[10])
            ->setCellValue('M'.$i, $row[11])
            ->setCellValue('N'.$i, $row[12])
            ->setCellValue('O'.$i, $row[13])
            ->setCellValue('P'.$i, $row[14])
            ->setCellValue('Q'.$i, $row[15])
            ->setCellValue('R'.$i, $row[16])
            ->setCellValue('S'.$i, $row[17])
            ->setCellValue('T'.$i, $row[18])
            ->setCellValue('U'.$i, $row[19])
            ->setCellValue('V'.$i, $row[20]);
        $i++;
    }
}
$excel->getActiveSheet()->setCellValue('A2', $_REQUEST['atributo'].': '. $_REQUEST['seleccion']);//COLUMNAS
$excel->getActiveSheet()->setCellValue('D3', date('d/m/y H:i:s'));//COLUMNAS
$excel->getActiveSheet()->setCellValue('B4', $_REQUEST['fechaFin']);//COLUMNAS
//$excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
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

// Rename worksheet
$excel->getActiveSheet()->setTitle('Reporte datos de familia');


// Redirect output to a clientâ€™s web browser (Excel5)
$nombre = 'Reporte_Ficha_'.date('d/m/y H:i:s');
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment;filename=$nombre.xls");
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$objWriter->save('php://output');
exit;


?>