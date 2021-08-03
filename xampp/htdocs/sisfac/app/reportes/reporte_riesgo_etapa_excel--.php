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
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

/** Include PHPExcel */
require_once('../../phpexcel/PHPExcel.php');
require_once('../../conexion/Conexion.php');
$cnn = new Conexion();
$cnn->abrirConexion();

$excel = new PHPExcel();
global $wh,$querygen,$i,$j,$cont;


if($_REQUEST['atributo'] == 'DISA/DIRESA') {
    if($_REQUEST['seleccion']!='') $wh = " AND fam.nombreDiresa = '$_REQUEST[seleccion]'";
    $querygen = "SELECT DISTINCT iddiresa, nombreDiresa FROM diresa dir WHERE nombreDiresa = '$_REQUEST[seleccion]'";
    $campo = 'fam.iddiresa';
}
elseif($_REQUEST['atributo'] == 'REGION') {
    if($_REQUEST['seleccion']!='') $wh = " AND fam.nombreRegion = '$_REQUEST[seleccion]'";
    $querygen = "SELECT DISTINCT idregion, nombreRegion FROM region reg WHERE nombreRegion = '$_REQUEST[seleccion]'";
    $campo = 'fam.idregion';
}
elseif($_REQUEST['atributo'] == 'PROVINCIA') {
    if($_REQUEST['seleccion']!='') $wh = " AND fam.nompro = '$_REQUEST[seleccion]'";
    $querygen = "SELECT DISTINCT idprovincia, nompro FROM provincia pro WHERE nompro = '$_REQUEST[seleccion]'";
    $campo = 'fam.idprovincia';
}
elseif($_REQUEST['atributo'] == 'DISTRITO') {
    if($_REQUEST['seleccion']!='') $wh = " AND fam.nombre = '$_REQUEST[seleccion]'";
    $querygen = "SELECT DISTINCT iddistrito, nombre FROM distrito dis WHERE nombre = '$_REQUEST[seleccion]'";
    $campo = 'fam.iddistrito';
}
elseif($_REQUEST['atributo'] == 'SECTOR') {
    if($_REQUEST['seleccion']!='') $wh = " AND fam.nombreSector = '$_REQUEST[seleccion]' AND fam.nombreComunidad = '$_REQUEST[codigo1]'";
    $querygen = "SELECT DISTINCT idsector, nombreSector FROM sector sec INNER JOIN comunidad com ON sec.idcomunidad=com.idcomunidad WHERE nombreSector = '$_REQUEST[seleccion]' AND nombreComunidad = '$_REQUEST[codigo1]'";
    $campo = 'fam.idsector';
}
elseif($_REQUEST['atributo'] == 'COMUNIDAD') {
    if($_REQUEST['seleccion']!='') $wh = " AND fam.nombreComunidad = '$_REQUEST[seleccion]'";
    $querygen = "SELECT DISTINCT idcomunidad, nombreComunidad FROM comunidad com WHERE nombreComunidad = '$_REQUEST[seleccion]'";
    $campo = 'fam.idcomunidad';
}
elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') {
    if($_REQUEST['seleccion']!='') $wh = " AND fam.nombreEstablecimiento = '$_REQUEST[seleccion]'";
    $querygen = "SELECT DISTINCT idestablecimiento, nombreEstablecimiento FROM establecimiento est WHERE nombreEstablecimiento = '$_REQUEST[seleccion]'";
    $campo = 'fam.idestablecimiento';
}
elseif($_REQUEST['atributo'] == 'RED') {
    if($_REQUEST['seleccion']!='') $wh = " AND fam.nombreRed = '$_REQUEST[seleccion]'";
    $querygen = "SELECT DISTINCT idred, nombreRed FROM red WHERE nombreRed = '$_REQUEST[seleccion]'";
    $campo = 'fam.idred';
}
elseif($_REQUEST['atributo'] == 'MICRORED') {
    if($_REQUEST['seleccion']!='') $wh = " AND fam.nombreMicrored = '$_REQUEST[seleccion]'";
    $querygen = "SELECT DISTINCT idmicrored, nombreMicrored FROM microred mic WHERE nombreMicrored = '$_REQUEST[seleccion]'";
    $campo = 'fam.idmicrored';
}
elseif($_REQUEST['atributo'] == 'NUCLEO') {
    if($_REQUEST['seleccion']!='') $wh = " AND fam.nombreNucleo = '$_REQUEST[seleccion]'";
    $querygen = "SELECT DISTINCT idnucleo, nombreNucleo FROM nucleo nuc WHERE nombreNucleo = '$_REQUEST[seleccion]'";
    $campo = 'fam.idnucleo';
}

//$fechaInicio = formatoFecha($_REQUEST['fechaInicio']);
$fechaFin = formatoFecha($_REQUEST['fechaFin']);

$resultgen = mysql_query($querygen);
$i=3;$j=0;
while($rowgen = mysql_fetch_array($resultgen)){
    
    $style['red_text'] = array(
        'font' => array(
            'name' => 'Arial',
            'color' => array(
                'rgb' => '0074C7'
            )
        ),
    );
    $style['celda'] = array(
        'font' => array(
            'name' => 'Arial Narrow',
            'size' => '6'
        ),
    );
    $excel->getActiveSheet()->getProtection()->setSheet(true);
    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    $excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
    $excel->setActiveSheetIndex(0)->setCellValue('B1' ,"REPORTE FAMILIAS EN RIESGO SEGUN ETAPA DE VIDA - $_REQUEST[atributo]: $_REQUEST[seleccion]")->mergeCells('B1:F1');
    $excel->getActiveSheet()->getStyle("B1:F1")->applyFromArray($style['red_text']);
    $excel->getActiveSheet()->getStyle("A:F")->applyFromArray($style['celda']);
            
    $fun = "sf_punrie(fam.idfamiliaH,fam.claveGeneral)";
    if($_REQUEST['atributo1']=='ALTO RIESGO') $array = array(" AND $fun BETWEEN 6 AND 100");
    elseif($_REQUEST['atributo1']=='MEDIANO RIESGO') $array = array("  AND $fun BETWEEN 3 AND 5");
    elseif($_REQUEST['atributo1']=='BAJO RIESGO') $array = array("  AND $fun BETWEEN 0 AND 2");
    else $array = array("ALTO RIESGO"=>" AND $fun BETWEEN 6 AND 100","MEDIANO RIESGO"=>" AND $fun BETWEEN 3 AND 5","BAJO RIESGO"=>" AND $fun BETWEEN 0 AND 2");
    
    foreach ($array as $key => $wh) {
        
        $query1 = "SELECT DISTINCT '$key',t.idfamiliaH,t.nombrefamilia,t.puntaje,t.claveGeneral ,CONCAT_WS(' ',perH.nombre,perH.apellidoPaterno,perH.apellidoMaterno) as nombreCompleto ,rieH.etapa, rieH.nombreRiesgo 
                    FROM (SELECT DISTINCT fam.idfamiliaH,nombrefamilia,sf_punrie(fam.idfamiliaH,fam.claveGeneral) as puntaje,fam.claveGeneral
                    FROM riesgoH rie INNER JOIN familiaH fam ON rie.idfamiliaH =fam.idfamiliaH AND rie.claveGeneral=fam.claveGeneral 
                    AND fam.idfamiliaH = sf_maxfam(fam.codigoFicha,'$fechaFin 23:59:59') AND $campo = $rowgen[0]
                    WHERE 1=1 $wh AND fechaHistorial<='$fechaFin 23:59:59' AND fam.activo='AC' AND nombreRiesgo<>'' ) AS t
                    INNER JOIN personaH perH ON t.idfamiliaH = perH.idfamiliaH AND t.claveGeneral=perH.claveGeneral INNER JOIN riesgoH rieH ON rieH.idpersonaH=perH.idpersonaH 
                    AND rieH.claveGeneral=perH.claveGeneral ORDER BY 4 desc,6";
    
        $result1 = mysql_query($query1);
        //echo $query1;
        $excel->getActiveSheet()->getColumnDimensionByColumn()->setAutoSize(true);
        $excel->setActiveSheetIndex(0)
            ->setCellValue('A'.($i+$j), $_REQUEST['atributo1'])
            ->setCellValue('B'.($i+1+$j), ($_REQUEST['atributo'].":".$rowgen[1]));
        
        
        $excel->getActiveSheet()->setCellValue('A'.($i+3+$j), 'NRO');//COLUMNAS
        $excel->getActiveSheet()->setCellValue('B'.($i+3+$j), 'FAMILIA');
        $excel->getActiveSheet()->setCellValue('C'.($i+3+$j), 'PUNTAJE');//COLUMNAS
        $excel->getActiveSheet()->setCellValue('D'.($i+3+$j), 'NOMBRE Y APELLIDOS');//COLUMNAS
        $excel->getActiveSheet()->setCellValue('E'.($i+3+$j), 'ETAPA');//COLUMNAS
        $excel->getActiveSheet()->setCellValue('F'.($i+3+$j), 'RIESGO');
        $cont = 1;
        while($row1 = mysql_fetch_array($result1)){
            $excel->getActiveSheet()->getColumnDimensionByColumn()->setAutoSize(true);
                $excel->setActiveSheetIndex(0)
                    ->setCellValue('A'.($i+4+$j), $cont.".-")
                    ->setCellValue('B'.($i+4+$j), $row1['nombrefamilia'])
                    ->setCellValue('C'.($i+4+$j), $row1['puntaje'])
                    ->setCellValue('D'.($i+4+$j), $row1['nombreCompleto'])
                    ->setCellValue('E'.($i+4+$j), $row1['etapa'])
                    ->setCellValue('F'.($i+4+$j), $row1['nombreRiesgo']);
            $i++;
            $cont++;
        }
        $j=$j+3;
    }
        $excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);   
        $excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);   
        $excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);   
        $excel->getActiveSheet()->getPageSetup()->setPrintArea("A1:N$cont");
    // Rename worksheet
    $excel->getActiveSheet()->setTitle('Reportes');


    // Redirect output to a clientâ€™s web browser (Excel5)
    $nombre = 'RIESGO_ETAPA'.date('d/m/y H:i:s');
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=$nombre.xls");
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
    $objWriter->save('php://output');

}

?>