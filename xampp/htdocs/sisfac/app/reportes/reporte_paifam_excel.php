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
$excel = $archivo->load('ReportePAIFAM.xlsx');
global $wh;$k=0;$sum=0;$tem;

$query = "SELECT DISTINCT fam.idfamilia,codigoFicha ,nombreFamilia,nombreSector , CONCAT_WS(' ', per.nombre, apellidoPaterno, apellidoMaterno) as jefe,lote,referencia,telefono,fechaNacimiento
                FROM familia fam INNER JOIN persona per ON fam.idfamilia = per.idfamilia AND fam.claveGeneral=per.claveGeneral
                WHERE fam.idfamilia = $_REQUEST[idfamilia] AND jefeFamilia='SI' AND fam.claveGeneral = '$_REQUEST[claveGeneral]'";

$row = mysql_fetch_array(mysql_query($query));

$excel->setActiveSheetIndex(0)->setCellValue('B2', $row['codigoFicha']);//COLUMNAS
$excel->setActiveSheetIndex(0)->setCellValue('D2', $row['nombreFamilia']);//COLUMNAS
$excel->setActiveSheetIndex(0)->setCellValue('F2', $row['nombreSector']);//COLUMNAS
$excel->setActiveSheetIndex(0)->setCellValue('H2', $row['lote']);//COLUMNAS
$excel->setActiveSheetIndex(0)->setCellValue('H3', $row['referencia']);//COLUMNAS
$excel->setActiveSheetIndex(0)->setCellValue('k3', $row['telefono']);//COLUMNAS

$query1 = "SELECT nombreCompleto, edad, etapa, nombreRiesgo,cont  FROM ((SELECT nombreFamilia as
nombreCompleto, fechaNacimiento edad,etapa,nombreRiesgo,
( SELECT COUNT(*) FROM familia fam INNER JOIN persona per ON fam.idfamilia=per.idfamilia AND fam.claveGeneral=per.claveGeneral 
LEFT JOIN riesgo rie ON rie.idpersona=per.idpersona AND rie.claveGeneral=per.claveGeneral 
WHERE fam.idfamilia = '$_REQUEST[idfamilia]' AND fam.claveGeneral = '$_REQUEST[claveGeneral]' AND etapa='FAMILIA') as cont FROM familia fam INNER JOIN persona per ON fam.idfamilia=per.idfamilia AND fam.claveGeneral=per.claveGeneral LEFT JOIN riesgo rie ON
rie.idpersona=per.idpersona AND rie.claveGeneral = per.claveGeneral 
WHERE fam.idfamilia=$_REQUEST[idfamilia] AND etapa='FAMILIA' AND fam.claveGeneral = '$_REQUEST[claveGeneral]' and per.activo='AC'
)
UNION ALL
(
SELECT CONCAT_WS(' ',per.nombre,apellidoPaterno,apellidoMaterno) as
nombreCompleto,fechaNacimiento edad,etapa,nombreRiesgo,
(SELECT COUNT(*) FROM familia fam INNER JOIN persona per ON fam.idfamilia=per.idfamilia AND fam.claveGeneral=per.claveGeneral 
LEFT JOIN riesgo rie ON rie.idpersona=per.idpersona AND rie.claveGeneral=per.claveGeneral 
WHERE fam.idfamilia= '$_REQUEST[claveGeneral]' AND etapa<>'FAMILIA' AND fam.claveGeneral = '$_REQUEST[claveGeneral]') as cont 
FROM familia fam INNER JOIN persona per ON fam.idfamilia=per.idfamilia AND fam.claveGeneral=per.claveGeneral LEFT JOIN riesgo rie ON rie.idpersona=per.idpersona AND rie.claveGeneral = per.claveGeneral 
WHERE fam.idfamilia=$_REQUEST[idfamilia] AND etapa<>'FAMILIA' and per.activo='AC' AND fam.claveGeneral = '$_REQUEST[claveGeneral]')) AS T WHERE nombreRiesgo<>''";
$row1 = mysql_query($query1);
//echo $query1;
$i=6;
while ($row1 = mysql_fetch_array($result1)) {
    $excel->setActiveSheetIndex(0)
                ->setCellValue('B'.$i, $row1[nombreCompleto])
                ->setCellValue('C'.$i, obtenerEdad($row1[edad]))
                ->setCellValue('D'.$i, $row1[nombreRiego]);
}

$query1 = "SELECT nombreCompleto, edad, etapa, nombreRiesgo,cont  FROM ((SELECT nombreFamilia as
nombreCompleto, fechaNacimiento edad,etapa,nombreRiesgo,
(SELECT COUNT(*) FROM familia fam INNER JOIN persona per ON fam.idfamilia=per.idfamilia 
AND fam.claveGeneral=per.claveGeneral LEFT JOIN riesgo rie ON rie.idpersona=per.idpersona AND rie.claveGeneral=per.claveGeneral 
WHERE fam.idfamilia=$_REQUEST[idfamilia] AND fam.claveGeneral = '$_REQUEST[claveGeneral]' AND etapa='FAMILIA') as cont FROM familia fam INNER JOIN persona per ON fam.idfamilia=per.idfamilia AND fam.claveGeneral=per.claveGeneral LEFT JOIN riesgo rie ON
rie.idpersona=per.idpersona AND rie.claveGeneral = per.claveGeneral 
WHERE fam.idfamilia=$_REQUEST[idfamilia] and per.activo='AC' AND etapa='FAMILIA' AND fam.claveGeneral = '$_REQUEST[claveGeneral]'
)
UNION ALL
(
SELECT CONCAT_WS(' ',per.nombre,apellidoPaterno,apellidoMaterno) as
nombreCompleto,fechaNacimiento edad,etapa,nombreRiesgo,(SELECT COUNT(*) FROM familia fam INNER JOIN persona per ON fam.idfamilia=per.idfamilia 
AND fam.claveGeneral=per.claveGeneral LEFT JOIN riesgo rie ON rie.idpersona=per.idpersona AND rie.claveGeneral=per.claveGeneral 
WHERE fam.idfamilia=$_REQUEST[idfamilia] AND etapa<>'FAMILIA' AND fam.claveGeneral = '$_REQUEST[claveGeneral]') as cont FROM familia fam INNER JOIN persona per ON fam.idfamilia=per.idfamilia AND fam.claveGeneral=per.claveGeneral LEFT JOIN riesgo rie ON
rie.idpersona=per.idpersona AND rie.claveGeneral = per.claveGeneral WHERE fam.idfamilia=$_REQUEST[idfamilia] AND etapa<>'FAMILIA' and per.activo='AC' AND fam.claveGeneral = '$_REQUEST[claveGeneral]')) AS T WHERE nombreRiesgo<>''";
$result1 = mysql_query($query1);

$i=6;
while ($row1 = mysql_fetch_array($result1)) {
    $excel->setActiveSheetIndex(0)
                ->setCellValue('B'.$i, $row1[nombreCompleto])
                ->setCellValue('C'.$i, obtenerEdad($row1[edad]))
                ->setCellValue('D'.$i, $row1[nombreRiesgo]);
    $i++;
}


$query1 = "SELECT tipo,descripcion FROM (
(SELECT DISTINCT tipo, descripcion FROM entorno ent INNER JOIN
persona per ON ent.idfamilia  = per.idfamilia AND ent.claveGeneral=per.claveGeneral WHERE per.idfamilia = $_REQUEST[idfamilia] AND per.activo='AC' AND per.claveGeneral = '$_REQUEST[claveGeneral]')
UNION ALL (
SELECT DISTINCT tipo, descripcion FROM socioeconomico soc INNER JOIN persona per ON soc.idfamilia  = per.idfamilia AND per.claveGeneral = soc.claveGeneral WHERE
per.idfamilia = $_REQUEST[idfamilia] AND per.activo='AC' AND per.claveGeneral = '$_REQUEST[claveGeneral]'))AS T WHERE tipo = 'AGUA DE CONSUMO' OR tipo = 'ELIMINACION DE EXCRETAS' OR tipo = 'CUANTAS HABITACIONES HAY EN HOGAR' OR 
tipo ='NRO DE PERSONAS X DORMITORIO' OR tipo = 'ORGANIZACION DE LA VIVIENDA' OR tipo = 'DISPOSICION DE BASURA' OR tipo = 'RIESGO X ENTORNO' OR tipo = 'BIOHUERTO'";
$result1 = mysql_query($query1);

while ($row1 = mysql_fetch_array($result1)) {
    $excel->setActiveSheetIndex(0)
                ->setCellValue('B'.$i, $row1[tipo])
                ->setCellValue('D'.$i, $row1[descripcion]);
    $i++;
}



$nombre = 'REPORTE_PAIFAM'.date('d/m/y H:i:s');
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment;filename=$nombre.xls");
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
$objWriter->save('php://output');
?>