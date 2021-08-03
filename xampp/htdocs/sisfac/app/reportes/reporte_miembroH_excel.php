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
$excel = $archivo->load('02_Historial_DatosMiembrosFamiliares.xlsx');

global $wh;

$query = "SELECT numeroHC, opcionDNI, dni, apellidoPaterno, apellidoMaterno, per.nombre, sexo, fechaNacimiento, per.nombreDistrito, gradoInstruccion, 
        seguroMedico, numeroSeguro, ocupacion, tipoOcupacion, parentesco, estadoCivil, jefeFamilia, pertenenciaEtnica, desendenciaEtnica, per.activo, per.motivo 
        FROM personaH per INNER JOIN familiaH fam ON per.idfamiliaH = fam.idfamiliaH AND per.claveGeneral = fam.claveGeneral 
        WHERE fam.idfamiliaH = $_REQUEST[idfamiliaH]  AND codigoFicha = '$_REQUEST[codigoFicha]'";

$result1 = mysql_query($query);
$i=9;
$j=0;
$excel->setActiveSheetIndex(0)->setCellValue('C2', $_REQUEST['claveGeneral']);
$excel->setActiveSheetIndex(0)->setCellValue('C3', $_REQUEST['fechaHistorial']);
$excel->setActiveSheetIndex(0)->setCellValue('C4', date('d/m/Y H:i:s'));
$excel->setActiveSheetIndex(0)->setCellValue('C5', $_REQUEST['codigoFicha']);
$excel->setActiveSheetIndex(0)->setCellValue('C6', $_REQUEST['nombreFamilia']);
$k=1;
while ($row = mysql_fetch_array($result1)) {
    $excel->setActiveSheetIndex(0)
        ->setCellValue('A'.($i), $k)
        ->setCellValue('B'.($i), $row['numeroHC'])
        ->setCellValue('C'.($i), $row['opcionDNI'])
        ->setCellValue('D'.($i), $row['dni'])
        ->setCellValue('E'.($i), $row['apellidoPaterno'])
        ->setCellValue('F'.($i), $row['apellidoMaterno'])
        ->setCellValue('G'.($i), $row['nombre'])
        ->setCellValue('H'.($i), ($row[sexo]=='M'?'MASCULINO':'FEMENINO'))
        ->setCellValue('I'.($i), $row[fechaNacimiento])
        ->setCellValue('J'.($i), $row[nombreDistrito])
        ->setCellValue('K'.($i), $row[gradoInstruccion])
        ->setCellValue('L'.($i), $row[seguroMedico])
        ->setCellValue('M'.($i), $row[numeroSeguro])
        ->setCellValue('N'.($i), ($row[ocupacion]=='S'?'TRABAJADOR ESTABLE':($row[ocupacion]=='V'?'EVENTUAL':($row[ocupacion]=='D'?'DESOCUPADO':($row[ocupacion]=='J'?'JUBILADO':($row[ocupacion]=='E'?'ESTUDIANTE':($row[ocupacion]=='A'?'AMA DE CASA':'NO APLICA')))))))
        ->setCellValue('O'.($i), $row[tipoOcupacion])
        ->setCellValue('P'.($i), ($row[parentesco]=='P'?'PADRE':($row[parentesco]=='M'?'MADRE':($row[parentesco]=='H'?'HIJO':($row[parentesco]=='A'?'ABUELO/ABUELA':($row[parentesco]=='T'?'TIO/TIA':($row[parentesco]=='N'?'NIETO/NIETA':($row[parentesco]=='PA'?'PADRE ADOPTIVO':'MADRE ADOPTIVA'))))))))
        ->setCellValue('Q'.($i), ($row[estadoCivil]=='S'?'SOLTERO':($row[estadoCivil]=='CV'?'CONVIVIENTE':($row[estadoCivil]=='C'?'CASADO':($row[estadoCivil]=='SE'?'SEPARADO':($row[estadoCivil]=='D'?'DIVORCIADO':'VIUDO'))))))
        ->setCellValue('R'.($i), $row[jefeFamilia])
        ->setCellValue('S'.($i), $row[pertenenciaEtnica])
        ->setCellValue('T'.($i), $row[desendenciaEtnica])
        ->setCellValue('U'.($i), ($row[activo]=='AC'?'ACTIVO':'INACTIVO'))
        ->setCellValue('V'.($i), $row[motivo]);
    $i++;
    $k++;
    $j=0;
}    


header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment;filename=02_Historial_DatosMiembrosFamiliares.xls");
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$objWriter->save('php://output');

?>