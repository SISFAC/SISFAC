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
global $wh,$ve,$t;

$datos = explode('-',datoReporte($_REQUEST[atributo], $_REQUEST[seleccion1]));
$wh = $datos[0];
$querygen = $datos[1];
$campo = $datos[2];


$resultgen = mysql_query($querygen);

while($rowgen = mysql_fetch_array($resultgen)){
    $t='';
    if($_REQUEST['atributo1']=='GEOPOLITICO'){
        if($_REQUEST['atributo']=='REGION' || $_REQUEST['atributo']=='DISA/DIRESA') {
            $t = 'nompro,dis.nombre,nombreEstablecimiento,nombreComunidad,nombreSector';
            $ve ['B'] = 'PROVINCIA';
            $ve ['C'] = 'DISTRITO';
            $ve ['D'] = 'ESTABLECIMIENTO';
            $ve ['E'] = 'COMUNIDAD';
            $ve ['F'] = 'SECTOR';

        }
        elseif($_REQUEST['atributo']=='PROVINCIA') {
            $t = 'dis.nombre,nombreEstablecimiento,nombreComunidad,nombreSector';
            $ve ['C'] = 'DISTRITO';
            $ve ['D'] = 'ESTABLECIMIENTO';
            $ve ['E'] = 'COMUNIDAD';
            $ve ['F'] = 'SECTOR';
        }
        elseif($_REQUEST['atributo']=='DISTRITO') {
            $t = 'nombreEstablecimiento,nombreComunidad,nombreSector';
            $ve ['D'] = 'ESTABLECIMIENTO';
            $ve ['E'] = 'COMUNIDAD';
            $ve ['F'] = 'SECTOR';
        }
        elseif($_REQUEST['atributo']=='ESTABLECIMIENTO') {
            $t = 'nombreComunidad,nombreSector';
            $ve ['E'] = 'COMUNIDAD';
            $ve ['F'] = 'SECTOR';
        }
        elseif($_REQUEST['atributo']=='COMUNIDAD') {
            $t = 'nombreSector';
            $ve ['F'] = 'SECTOR';
        }
        elseif($_REQUEST['atributo']=='SECTOR') {
            $t = 'nombreSector';
            $ve ['G'] = 'SECTOR';
        }

        $query1 = "SELECT distinct nompro,d.nombre,nombreEstablecimiento,nombreComunidad,nombreSector
                FROM provincia p
                LEFT OUTER JOIN distrito d
                ON p.idprovincia=d.idprovincia
                LEFT OUTER JOIN establecimiento e 
                ON d.iddistrito=e.iddistrito
                LEFT OUTER JOIN comunidad c
                ON e.idestablecimiento=c.idestablecimiento
                LEFT OUTER JOIN sector s
                ON s.idcomunidad=c.idcomunidad
                ORDER BY p.nompro, d.nombre, e.nombreEstablecimiento, c.nombreComunidad, s.nombreSector";
    }else{
        $t = 'nombreRed,nombreMicrored,nombreNucleo,nombreEstablecimiento';
        $ve ['B'] = 'RED';
        $ve ['C'] = 'MICRORED';
        $ve ['D'] = 'NUCLEO';
        $ve ['E'] = 'ESTABLECIMIENTO';

        $query1 = "SELECT distinct nombreRed,nombreMicrored,nombreNucleo,nombreEstablecimiento
                    FROM
                    red r 
                    LEFT OUTER JOIN microred m ON r.idred=m.idred 
                    LEFT OUTER JOIN nucleo n ON n.idmicrored=m.idmicrored 
                    LEFT OUTER JOIN establecimiento e ON e.idnucleo=n.idnucleo";
    }
    


    
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
    
    $excel->setActiveSheetIndex(0)->setCellValue('B1' ,"ESTRUCTURA DE TABLAS MAESTRAS - DIVISIÓN $_REQUEST[atributo1]")->mergeCells('B1:G1');
    $excel->getActiveSheet()->getStyle("B1:G1")->applyFromArray($style['red_text']);
    while ($row = mysql_fetch_array($result1)) {
        $excel->getActiveSheet()->getColumnDimensionByColumn()->setAutoSize(true);
        $j=0;
        foreach ($ve as $letra => $numero) {
            $excel->setActiveSheetIndex(0)->setCellValue($letra.$i, $row[$j]);
            $j++;
        }
        $i++;
    }
    
    foreach ($ve as $letra => $numero) {
        $excel->getActiveSheet()->getColumnDimension($letra)->setAutoSize(true);
    }
    
    foreach ($ve as $letra => $titulo) {
        $excel->getActiveSheet()->setCellValue($letra.'2', $titulo);
    }
    //$excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    //$excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    //$excel->getActiveSheet()->setCellValue('B2', 'FAMILIA');//COLUMNAS
    //$excel->getActiveSheet()->setCellValue('C2', 'NUMERO DE CANES');//COLUMNAS


    //$excel->getActiveSheet()->setCellValue('A2', $_REQUEST['atributo'].' : '.$_REQUEST['seleccion']);//COLUMNAS
    //$excel->getActiveSheet()->setCellValue('D3', date('d/m/y H:i:s'));//COLUMNAS

    // Redirect output to a clientâ€™s web browser (Excel5)
    $nombre = 'DIVISION_TABLAS_'.$_REQUEST['atributo1'].date('d/m/y H:i:s');
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=$nombre.xls");
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
    $objWriter->save('php://output');

}

?>