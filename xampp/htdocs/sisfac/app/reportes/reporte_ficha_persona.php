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
global $wh;

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

$resultgen = mysql_query($querygen);
$fechaFin = formatoFecha($_REQUEST['fechaFin']);
//echo $querygen;
while($rowgen = mysql_fetch_array($resultgen)){
    $query1 = "SELECT DISTINCT codigoFicha, nombreFamilia, nombreRegion, nompro, fam.nombre, nombreComunidad, nombreSector, fam.claveGeneral, nombreEstablecimiento, 
                CONCAT_WS(per.nombre,apellidoPaterno,apellidoMaterno,' ') as nombre,sexo, fechaNacimiento, seguroMedico, numeroSeguro,idioma1, idioma2, idioma3, 
                religion, viviendaAnterior, tiempoDemora, tiempoDomicilio, medioTransporte,diaVisita, horaVisita , tipoEntorno, referencia 
                FROM familiaH fam INNER JOIN personaH per ON fam.idfamiliaH=per.idfamiliaH 
                WHERE fechaHistorial<='$fechaFin 23:59:59' $wh AND fam.idfamiliaH = sf_maxfam(fam.codigoFicha,'$fechaFin 23:59:59')";
    //echo $query1;
    $result1 = mysql_query($query1);
    $i=3;
    $style['red_text'] = array(
        'font' => array(
            'name' => 'Arial',
            'color' => array(
                'rgb' => '0074C7'
            )
        ),
    );
    
    $excel->setActiveSheetIndex(0)->setCellValue('B1' ,"REPORTE FICHA FAMILIAR")->mergeCells('B1:G1');
    $excel->getActiveSheet()->getStyle("B1:G1")->applyFromArray($style['red_text']);
    while ($row = mysql_fetch_array($result1)) {
        $excel->getActiveSheet()->getColumnDimensionByColumn()->setAutoSize(true);
        $excel->setActiveSheetIndex(0)
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
$excel->getActiveSheet()->setCellValue('B2', 'CODIGO FICHA');//COLUMNAS
$excel->getActiveSheet()->setCellValue('C2', 'FAMILIA');//COLUMNAS
$excel->getActiveSheet()->setCellValue('D2', 'REGION');//COLUMNAS
$excel->getActiveSheet()->setCellValue('E2', 'PROVINCIA');//COLUMNAS
$excel->getActiveSheet()->setCellValue('F2', 'DISTRITO');//COLUMNAS
$excel->getActiveSheet()->setCellValue('G2', 'COMUNIDAD');//COLUMNAS
$excel->getActiveSheet()->setCellValue('H2', 'SECTOR');//COLUMNAS
$excel->getActiveSheet()->setCellValue('I2', 'COD RENAES');//COLUMNAS
$excel->getActiveSheet()->setCellValue('J2', 'ESTABLECIMIENTO');//COLUMNAS
$excel->getActiveSheet()->setCellValue('K2', 'PERSONA');//COLUMNAS
$excel->getActiveSheet()->setCellValue('L2', 'SEXO');//COLUMNAS
$excel->getActiveSheet()->setCellValue('M2', 'FECHA NACIMIENTO');//COLUMNAS
$excel->getActiveSheet()->setCellValue('N2', 'SEGURO MEDICO');//COLUMNAS
$excel->getActiveSheet()->setCellValue('O2', 'IDIOMA1');//COLUMNAS
$excel->getActiveSheet()->setCellValue('P2', 'IDIOMA2');//COLUMNAS
$excel->getActiveSheet()->setCellValue('Q2', 'IDIOMA3');//COLUMNAS
$excel->getActiveSheet()->setCellValue('R2', 'RELIGION');//COLUMNAS
$excel->getActiveSheet()->setCellValue('S2', 'VIVIENDA ANTERIOR');//COLUMNAS
$excel->getActiveSheet()->setCellValue('T2', 'HORA VISITA');//COLUMNAS
$excel->getActiveSheet()->setCellValue('U2', 'UBICACION VIVIENDA');//COLUMNAS
$excel->getActiveSheet()->setCellValue('V2', 'REFERENCIA');//COLUMNAS

// Rename worksheet
$excel->getActiveSheet()->setTitle('Reporte datos de familia');


// Redirect output to a clientâ€™s web browser (Excel5)
$nombre = 'Reporte_Ficha_'.date('d/m/y H:i:s');
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment;filename=$nombre.xls");
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
$objWriter->save('php://output');
exit;


?>