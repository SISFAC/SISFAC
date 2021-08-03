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
$excel = $archivo->load('RepFamiliasEnRiesgoEtapaDeVida.xlsx');

global $wh,$querygen,$i,$j,$cont;

    $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
    
    // tcpdf folder
    $rendererLibraryPath = '../../tcpdf/tcpdf.php'; 

$datos = explode('-',datoReporte($_REQUEST[atributo], $_REQUEST[opc]));
$wh = $datos[0];
$querygen = $datos[1];
$campo = $datos[2];
// $fechaInicio = formatoFecha($_REQUEST['fechaInicio']); 

//echo $querygen;

$resultgen = mysql_query($querygen);
$i=3;$j=0;
while($rowgen = mysql_fetch_array($resultgen)){
    $vector = array();
    $tid=$tcg=$temp="";$puntaje=0;
    
    if($_REQUEST['atributo1']=='ALTO RIESGO') {$min = 6; $max=100;}//$array = array(" AND $fun BETWEEN 6 AND 100");
    elseif($_REQUEST['atributo1']=='MEDIANO RIESGO') {$min = 3; $max=5;}//$array = array("  AND $fun BETWEEN 3 AND 5");
    elseif($_REQUEST['atributo1']=='BAJO RIESGO') {$min = 0; $max=2;}//$array = array("  AND $fun BETWEEN 0 AND 2");
    else {$min = 0; $max=100;}//$array = array("ALTO RIESGO"=>" AND $fun BETWEEN 6 AND 100","MEDIANO RIESGO"=>" AND $fun BETWEEN 3 AND 5","BAJO RIESGO"=>" AND $fun BETWEEN 0 AND 2");
    
        $query1 = "
            SELECT distinct fam.claveGeneral as claveGeneral,fam.codigoFicha as codigoFicha,nombrefamilia,CONCAT_WS(' ',per.nombre,per.apellidoPaterno,per.apellidoMaterno) as nombreCompleto , 
            fechaNacimiento, TIMESTAMPDIFF(YEAR, fechaNacimiento, CURDATE()) AS edad, rie.nombreRiesgo as nombreRiesgo, nombreSector, nombreComunidad, rie.puntaje, etapa, dni
            FROM familia fam INNER JOIN persona per ON fam.idfamilia = per.idfamilia AND fam.claveGeneral=per.claveGeneral INNER JOIN riesgo rie ON 
            rie.idpersona=per.idpersona AND rie.claveGeneral = per.claveGeneral
            WHERE  fam.activo='AC' AND $campo = $rowgen[0] AND nombreRiesgo<>'' AND per.activo='AC' ORDER BY 2,3,10";

        //echo $query1;
        $result1 = mysql_query($query1);
        while ($row = mysql_fetch_array($result1)) {
            if($tid == '' && $tcg == ''){//INICIAMOS
                $tid=$row['codigoFicha'];
                $tcg=$row['claveGeneral'];
            }
            if(($row['codigoFicha'] == $tid && $row['claveGeneral'] == $tcg)==false){
                $vector[$temp] = $puntaje;
                $temp =$row['codigoFicha'].';'.$row['claveGeneral'].';'.$row['nombrefamilia'].';'.$row['nombreCompleto'].';'.$row['fechaNacimiento'].';'.$row['edad'].';'.$row['nombreRiesgo'].';'.$row['nombreSector'].';'.$row['nombreComunidad'].'*';
                $puntaje = $row['puntaje'];
            }else{
                $temp .=$row['codigoFicha'].';'.$row['claveGeneral'].';'.$row['nombrefamilia'].';'.$row['nombreCompleto'].';'.$row['fechaNacimiento'].';'.$row['edad'].';'.$row['nombreRiesgo'].';'.$row['nombreSector'].';'.$row['nombreComunidad'].'*';
                $puntaje += $row['puntaje'];
            }
            $tid=$row['codigoFicha'];
            $tcg=$row['claveGeneral'];
        }
        $vector[$temp] = $puntaje;
        arsort($vector);
        
        $cont = 1;
        foreach ($vector as $key => $value) {
            if($value>=$min && $value<=$max){
                $data = explode('*', $key);
                foreach ($data as $kla => $val) {
                    $row1 = explode(';',$val);
                    if(isset($row1[0]) && isset($row1[1]) && isset($row1[2]) && isset($row1[3])){
                        $excel->setActiveSheetIndex(0)
                            ->setCellValue('A'.($i+3+$j), $cont.".-")
                            ->setCellValue('B'.($i+3+$j), $row1[1])
                            ->setCellValue('C'.($i+3+$j), $row1[0])
                            ->setCellValue('D'.($i+3+$j), $row1[2])
                            ->setCellValue('E'.($i+3+$j), $row1[3])
                            ->setCellValue('F'.($i+3+$j), obtenerEdad($row1[4]))
                            ->setCellValue('G'.($i+3+$j), ($row1[10] == 'GESTANTE'?'GESTANTE':($row1[5]<=11?'NINO':($row1[5]<=17?'ADOLESCENTE':($row1[5]<=29?'JOVEN':($row1[5]<=59?'ADULTO':'ADULTO MAYOR'))))))
                            ->setCellValue('H'.($i+3+$j), $row1[6])
                            ->setCellValue('I'.($i+3+$j), $row1[7])
                            ->setCellValue('J'.($i+3+$j), $row1[8])
                            ->setCellValue('K'.($i+3+$j), $value);
                        $i++;
                        $cont++;
                    }
                }
            }
        }
        $j=$j+3;
        $cont= floor($cont/2);

        $excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);   
        $excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);   
        $excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);   
        
    $excel->getActiveSheet()->setTitle('Reportes');

    $excel->getActiveSheet()->setCellValue('A2', $_REQUEST['atributo'].": ".$_REQUEST['seleccion']);//COLUMNAS
    $excel->getActiveSheet()->setCellValue('D4', date('d/m/y H:i:s'));
    $excel->getActiveSheet()->setCellValue('E3', date('d/m/y H:i:s'));//COLUMNAS    
    $excel->getActiveSheet()->setCellValue('A3', $_REQUEST['atributo1']);//COLUMNAS    
    $nombre = 'RIESGO_ETAPA'.date('d/m/y H:i:s');
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=$nombre.xls");
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
    $objWriter->save('php://output');
}

?>