<?php

/*
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.

*/

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

/** Include PHPExcel */
require_once('../../phpexcel/PHPExcel.php');
require_once('../../phpexcel/PHPExcel/IOFactory.php');
require_once('../../conexion/Conexion.php');
$cnn = new Conexion();
$cnn->abrirConexion();

global $wh;

// Creamos un objeto PHPExcel
$objPHPExcel = new PHPExcel();
// Leemos un archivo Excel 2007
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load("../../app/plantillas/reporteNino.xlsx");
// Indicamos que se pare en la hoja uno del libro

$objPHPExcel->setActiveSheetIndex(0);

$array = array();
$ejey =array();

$fila = array(73=>181,74=>364,75=>728,76=>1093,77=>1459,78=>2189);
$columna = array('C'=>'SF1','D'=>'SF2','E'=>'SF3','F'=>'SF4','G'=>'SF5','H'=>'VA1','I'=>'VA2');//,'J','K','L','M','N','O','P','Q','R','S','T'

$fechaInicio = formatoFecha($_REQUEST['fechaInicio']);
$fechaFin = formatoFecha($_REQUEST['fechaFin']);

$objPHPExcel->getActiveSheet()->SetCellValue('B3', 'DESDE '.$_REQUEST['fechaInicio']);
$objPHPExcel->getActiveSheet()->SetCellValue('B4', 'HASTA '.$_REQUEST['fechaFin']);

if(isset($_REQUEST['idsector'])) $wh.= " AND sec.idsector = ".$_REQUEST['idsector'];
if(isset($_REQUEST['idcomunidad'])) $wh.= " AND com.idcomunidad = $_REQUEST[idcomunidad]";
if(isset($_REQUEST['idestablecimiento'])) $wh.= " AND est.idestablecimiento = $_REQUEST[idestablecimiento]";
if(isset($_REQUEST['idnucleo'])) $wh.= " AND nuc.idnucleo = $_REQUEST[idnucleo]";
if(isset($_REQUEST['idmicrored'])) $wh.= " AND mic.idmicrored = $_REQUEST[idmicrored]";
if(isset($_REQUEST['idred'])) $wh.= " AND red.idred = $_REQUEST[idred]";
if(isset($_REQUEST['iddiresa'])) $wh.= " AND dir.iddiresa = $_REQUEST[iddiresa]";



$query = "SELECT cep.idcatalogoEpisodio ,cep.nombreEpisodio, limiteInicial,limiteFinal, variablelab, COUNT(*) 
FROM his his INNER JOIN administracionMicronutrientesNino amn ON his.idepisodio = amn.idepisodio
INNER JOIN episodio epi ON epi.idepisodio=amn.idepisodio INNER JOIN catalogoEpisodio cep ON epi.nombreEpisodio = cep.idcatalogoEpisodio 
INNER JOIN persona per ON per.idpersona = epi.idpersona AND per.claveGeneral = epi.claveGeneral INNER JOIN familia fam ON fam.idfamilia = per.idfamilia 
AND per.claveGeneral = fam.claveGeneral LEFT JOIN sector sec ON fam.idsector=sec.idsector LEFT JOIN comunidad com ON com.idcomunidad=sec.idcomunidad LEFT JOIN establecimiento est ON est.idestablecimiento=com.idestablecimiento LEFT JOIN distrito dis ON dis.iddistrito=est.iddistrito AND dis.claveGeneral=est.claveGeneral LEFT JOIN
provincia pro ON pro.idprovincia=dis.idprovincia LEFT JOIN region reg ON reg.idregion = pro.idregion LEFT JOIN nucleo nuc ON nuc.idnucleo = est.idnucleo 
LEFT JOIN microred mic ON mic.idmicrored = nuc.idmicrored LEFT JOIN red ON red.idred=mic.idred LEFT JOIN diresa dir ON dir.iddiresa=red.iddiresa 
WHERE epi.fechaInicio>'$fechaInicio' AND epi.fechaFin<'$fechaFin' $wh
GROUP BY 1,2,3,4,5 ORDER BY 1,5";
//echo $query;
$result = mysql_query($query);
$k = 0;
$valt=0;
while ($row = mysql_fetch_array($result)) {
    
    //if($row[4]=='SF1')  
    //$array[$row[4]][$row[3]] = $row[5];
    foreach ($fila as $i => $fil) {
        foreach ($columna as $j => $col) {
            if($row[3]>$valt && $row[3]<$fil && $row[4] == $col) {
                $val = $objPHPExcel->getActiveSheet()->getCell($j.$i)->getValue();
                //$objPHPExcel->getActiveSheet()->SetCellValue($j.$i, $col.'--'.$fil.'--'.$row[3].'-'.$row[4]);
                $objPHPExcel->getActiveSheet()->SetCellValue($j.$i, $val + $row[5]);
            }
        }
        $valt = $fil;
        $k++;
    }
}

//print_r($array);



//$a = $objPHPExcel->getActiveSheet()->getCell('B2')->getValue();

//C73


//Escribimos en la hoja en la celda B1




//Guardamos el archivo en formato Excel 2007
//Si queremos trabajar con Excel 2003, basta cambiar el 'Excel2007' por 'Excel5' y el nombre del archivo de salida cambiar su formato por '.xls'

$nombre = 'REPORTE_NINO'.date('d/m/y H:i:s');
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment;filename=$nombre.xlsx");
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save("php://output");

?>