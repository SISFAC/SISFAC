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
require_once('../../tcpdf/config/lang/spa.php');
require_once('../../tcpdf/tcpdf.php');
require_once('../../conexion/Conexion.php');
$cnn = new Conexion();
$cnn->abrirConexion();


$rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
//$rendererName = PHPExcel_Settings::PDF_RENDERER_MPDF;
//$rendererName = PHPExcel_Settings::PDF_RENDERER_DOMPDF;
$rendererLibrary = '../../tcpdf';
//$rendererLibrary = 'mPDF.php';
//$rendererLibrary = 'domPDF0.6.0beta3';
$rendererLibraryPath = '' . $rendererLibrary;

$excel = new PHPExcel();
$archivo = PHPExcel_IOFactory::createReader('Excel2007');
$excel = $archivo->load('RepFamiliasEnRiesgoDatosSocioeconomicospdf.xlsx');


global $wh,$querygen,$i,$j,$k,$cont,$fil;

$datos = explode('-',datoReporte($_REQUEST[atributo], $_REQUEST[opc]));
$wh = $datos[0];
$querygen = $datos[1];
$campo = $datos[2];

//$fechaInicio = formatoFecha($_REQUEST['fechaInicio']);

$resultgen = mysql_query($querygen);
//$i=3;$j=0;$k=3;$cont=6;$fil=3;
$i=1;$j=0;$k=1;$cont=4;$fil=1;
while($rowgen = mysql_fetch_array($resultgen)){
    $excel->getActiveSheet()->getProtection()->setSheet(false);
    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);//ORIENTACION DE LA PAGINA
    $excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);//TIPO DE PAPEL
    $excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);//
    $excel->getActiveSheet()->getPageSetup()->setFitToHeight(0);//
    $excel->getActiveSheet()->getPageMargins()->setTop(0.6);//MARGEN SUPERIOR
    $excel->getActiveSheet()->getPageMargins()->setRight(0.6);//MARGEN DERECHO
    $excel->getActiveSheet()->getPageMargins()->setLeft(0.6);//MARGEN IZQUIERDO
    $excel->getActiveSheet()->getPageMargins()->setBottom(0.6);//MARGEN INFERIOR
    $excel->getActiveSheet()->getPageSetup()->setScale(55);//ESCALA PARA IMPRESION
    $excel->getActiveSheet()->getHeaderFooter()->setOddFooter('myFooter');


        
    if($_REQUEST['atributo1']=='ALTO RIESGO') {$min = 37; $max=100;}
    elseif($_REQUEST['atributo1']=='MEDIANO RIESGO') {$min = 24; $max=36;}
    elseif($_REQUEST['atributo1']=='BAJO RIESGO') {$min = 11; $max=23;}
    else {$min = 0; $max=100;}
    
    //foreach ($punt as $key => $wh) {
        
    $query1 = "
            SELECT DISTINCT fam.nombrefamilia, soc.tipo, soc.descripcion, puntaje, fam.claveGeneral,codigoFicha
            FROM socioeconomico soc INNER JOIN familia fam ON soc.idfamilia = fam.idfamilia AND soc.claveGeneral=fam.claveGeneral
            WHERE fam.activo = 'AC' AND  $campo = $rowgen[0] ORDER BY 6,5,1,2";
        $result1 = mysql_query($query1);
        
        $vector = array();
        $i=0; 
        $puntaje=0;
        $tid = $tcg = $temp = '';
        while($row1 = mysql_fetch_array($result1)){
            if($tid == '' && $tcg == ''){//INICIAMOS
                $tid=$row1['nombrefamilia'];
                $tcg=$row1['codigoFicha'];
                $temp='CODIGOFICHA;'.$row1['codigoFicha'].'*'.'CLAVEGENERAL;'.$row1['claveGeneral'].'*'.'FAMILIA;'.$row1['nombrefamilia'].'*';
            }
            if(($row1['nombrefamilia'] == $tid && $row1['codigoFicha'] == $tcg)==false){
                $vector[$temp] = $puntaje;
                //$temp =(($row1['nombrefamilia'] != $tid && $row1['codigoFicha'] != $tcg)?('FAMILIA;'.$row1['nombrefamilia'].'*'):'').$row1['tipo'].';'.$row1['descripcion'].'*';
                $temp ='CODIGOFICHA;'.$row1['codigoFicha'].'*'.'CLAVEGENERAL;'.$row1['claveGeneral'].'*'.'FAMILIA;'.$row1['nombrefamilia'].'*'.$row1['tipo'].';'.$row1['descripcion'].'*';
                $puntaje = $row1['puntaje'];
            }else{
                //$temp .=(($row1['nombrefamilia'] != $tid && $row1['codigoFicha'] != $tcg)?('FAMILIA;'.$row1['nombrefamilia'].'*'):'').$row1['tipo'].';'.$row1['descripcion'].'*';
                $temp .='CODIGOFICHA;'.$row1['codigoFicha'].'*'.'CLAVEGENERAL;'.$row1['claveGeneral'].'*'.'FAMILIA;'.$row1['nombrefamilia'].'*'.$row1['tipo'].';'.$row1['descripcion'].'*';
                $puntaje += $row1['puntaje'];
            }
            $tid=$row1['nombrefamilia'];
            $tcg=$row1['codigoFicha'];
        }
        $vector[$temp] = $puntaje;
        arsort($vector);
        //print_r($vector);
        $i=$j=0;
        
        $te = 0;
        $temp='';
        foreach ($vector as $key => $value) {
            $data = explode('*', $key);
            if($value>=$min && $value<=$max){
                foreach ($data as $kla => $val) {
                    $row1 = explode(';',$val);
                    
                    if(isset($row1[0]) && isset($row1[1])){
                    
                        //$excel->getActiveSheet()->getColumnDimensionByColumn()->setAutoSize(true);
                        $excel->setActiveSheetIndex(0)->setCellValue('A'.($j+6), $j + 1);
                        if($row1[0] == 'CLAVEGENERAL' ) $excel->setActiveSheetIndex(0)->setCellValue('B'.($j+6), $row1[1]);
                        if($row1[0] == 'CODIGOFICHA' ) $excel->setActiveSheetIndex(0)->setCellValue('C'.($j+6), $row1[1]);
                        if($row1[0] == 'FAMILIA' ) $excel->setActiveSheetIndex(0)->setCellValue('D'.($j+6), $row1[1]);
                        if($row1[0] == 'AGUA DE CONSUMO') $excel->setActiveSheetIndex(0)->setCellValue('E'.($j+6), $row1[1]);
                        if($row1[0] == 'CUANTAS HABITACIONES HAY EN HOGAR') $excel->setActiveSheetIndex(0)->setCellValue('F'.($j+6), $row1[1]);
                        if($row1[0] == 'ELIMINACION DE EXCRETAS') $excel->setActiveSheetIndex(0)->setCellValue('G'.($j+6), $row1[1]);
                        if($row1[0] == 'ENERGIA ELECTRICA(EE)') $excel->setActiveSheetIndex(0)->setCellValue('H'.($j+6), $row1[1]);
                        if($row1[0] == 'ESTADO CIVIL DEL JEFE DE FAMILIA') $excel->setActiveSheetIndex(0)->setCellValue('I'.($j+6), $row1[1]);
                        if($row1[0] == 'GRUPO FAMILIAR') $excel->setActiveSheetIndex(0)->setCellValue('J'.($j+6), $row1[1]);
                        if($row1[0] == 'INGRESOS FAMILIARES') $excel->setActiveSheetIndex(0)->setCellValue('K'.($j+6), $row1[1]);
                        if($row1[0] == 'NIVEL DE INSTRUCCION DE LA MADRE') $excel->setActiveSheetIndex(0)->setCellValue('L'.($j+6), $row1[1]);
                        if($row1[0] == 'NRO DE PERSONAS X DORMITORIO') $excel->setActiveSheetIndex(0)->setCellValue('M'.($j+6), $row1[1]);
                        if($row1[0] == 'OCUPACION JEFE DE LA FAMILIA') $excel->setActiveSheetIndex(0)->setCellValue('N'.($j+6), $row1[1]);
                        if($row1[0] == 'SALUD EN EL HOGAR') {
                            $temp .= $row1[1].',';
                            $excel->setActiveSheetIndex(0)->setCellValue('O'.($j+6), substr($temp, 0, -1));
                        }
                        if($row1[0] == 'TENENCIA DE LA VIVIENDA') $excel->setActiveSheetIndex(0)->setCellValue('P'.($j+6), $row1[1]);
                        $excel->setActiveSheetIndex(0)->setCellValue('Q'.($j+6), $value);//PUNTAJE

                        $i++;
                        $cont++;
                    }
                }
                $temp='';
                $j++;
                $i=0;
            }
        }
        $cont += 2;
        $fil+=2;
        //print_r($vector);
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
    
        
    // Rename worksheet
    $excel->getActiveSheet()->setTitle('Reportes');
    $excel->getActiveSheet()->setCellValue('A2', $_REQUEST['atributo'].": ".$_REQUEST['seleccion']);//COLUMNAS
    $excel->getActiveSheet()->setCellValue('A3', $_REQUEST['atributo1']."  - HASTA ".date('d/m/y H:i:s'));//COLUMNAS    
    //$excel->getActiveSheet()->setCellValue('E3', $_REQUEST['fechaFin']);//COLUMNAS
    // Redirect output to a clientâ€™s web browser (Excel5)
    
    $excel->getActiveSheet()->setShowGridLines(false);
    
    if (!PHPExcel_Settings::setPdfRenderer(
      $rendererName,
      $rendererLibraryPath
     )) {
     die(
      'NOTICE: Please set the $rendererName and $rendererLibraryPath values' .
      '<br />' .
      'at the top of this script as appropriate for your directory structure'
     );
    }
    $excel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $excel->getProperties()->getTitle() . '&RPage &P of &N');
    /*
    $nombre = 'RIESGO_SOCIOECONOMICO'.date('d/m/y H:i:s');
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=$nombre.xls");
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
    $objWriter->save('php://output');
*/
 // Redirect output to a client’s web browser (PDF)
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment;filename="01simple.pdf"');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($excel, 'PDF');
    $objWriter->save('php://output');
    
}

?>