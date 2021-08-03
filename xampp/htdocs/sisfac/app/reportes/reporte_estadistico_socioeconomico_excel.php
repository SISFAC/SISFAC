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
$excel = $archivo->load('Reporte_estadistico_socioeconomico_excel.xlsx');
global $wh;

$datos = explode('-',datoReporte($_REQUEST[atributo], $_REQUEST[seleccion1]));
$wh = $datos[0];
$querygen = $datos[1];
$campo = $datos[2];

//$fechaInicio = formatoFecha($_REQUEST['fechaInicio']);

$resultgen = mysql_query($querygen);

while($rowgen = mysql_fetch_array($resultgen)){
    if($_REQUEST['atributo1'] == 'SOCIOECONOMICO'){
        $query1 = "SELECT soc.tipo,soc.descripcion,COUNT(fam.idfamilia)
                FROM socioeconomico soc INNER JOIN familia fam ON soc.idfamilia = fam.idfamilia AND soc.claveGeneral=fam.claveGeneral 
                WHERE soc.tipo = '$_REQUEST[opc]' $wh AND fam.activo = 'AC'
                GROUP BY 1,2 ORDER BY 1 desc
        ";//AND soc.descripcion <> '' 
    }
    elseif($_REQUEST['atributo1'] == 'VIVIENDA Y ENTORNO'){
        /*$query1 = "SELECT ent.tipo, ent.descripcion,COUNT(fam.idfamiliaH) FROM entornoH ent INNER JOIN familiaH fam ON ent.idfamiliaH = fam.idfamiliaH
                INNER JOIN sector sec ON fam.idsector=sec.idsector INNER JOIN comunidad com ON com.idcomunidad=sec.idcomunidad
                INNER JOIN establecimiento est ON est.idestablecimiento=com.idestablecimiento INNER  JOIN distrito dis ON dis.iddistrito=est.iddistrito INNER
                JOIN provincia pro ON pro.idprovincia=dis.idprovincia INNER JOIN region reg ON reg.idregion = pro.idregion INNER JOIN nucleo nuc ON
                nuc.idnucleo = est.idnucleo INNER JOIN microred mic ON mic.idmicrored = nuc.idmicrored INNER JOIN red ON red.idred=mic.idred
                WHERE activo = 'AC' $wh AND ent.tipo = '$_REQUEST[seleccion1]' AND fechaHistorial>='$fechaInicio 00:00:01' AND fechaHistorial<='$fechaFin 23:59:59' GROUP BY 1,2 ORDER BY 1,3";*/
        $query1 = "
            SELECT ent.tipo,ent.descripcion,COUNT(fam.idfamilia)
                FROM entorno ent INNER JOIN familia fam ON ent.idfamilia = fam.idfamilia AND ent.claveGeneral=fam.claveGeneral 
                WHERE ent.tipo = '$_REQUEST[opc]' $wh  AND fam.activo = 'AC'
                GROUP BY 1,2 ORDER BY 1 desc
            ";//AND ent.descripcion <> '' 
    }
    
    
    $result1 = mysql_query($query1);
    //echo $query1;
    $i=6;
    
    $titulo = $_REQUEST['opc']=='ORGANIZACION DE LA VIVIENDA'?$_REQUEST['opc'].' QUE NO CUENTAN CON':$_REQUEST['opc'];
    $excel->setActiveSheetIndex(0)->setCellValue('A1' ,"NÚMERO DE FAMILIAS POR $titulo");//->mergeCells('B1:Z1');
    //$excel->getActiveSheet()->getStyle("B1:Z1")->applyFromArray($style['red_text']);
    $j=0;
    while ($row = mysql_fetch_array($result1)) {
        //$excel->getActiveSheet()->getColumnDimensionByColumn()->setAutoSize(true);
        if($row[1]!=''){
            $excel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $i-5)
                ->setCellValue('B'.$i, $row[0])
                ->setCellValue('C'.$i, $row[1])
                ->setCellValue('D'.$i, $row[2]);
            $i++;
        }else $j+=$row[2];
        
    }    
    if($j>0) $excel->setActiveSheetIndex(0)->setCellValue('B'.($i+1) ,"Hay $j familia(s) que no registran $_REQUEST[opc]")->mergeCells("B".($i+1).":Z".($i+1));

    $excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
    
    $excel->getActiveSheet()->setCellValue('A2', $_REQUEST['atributo'].' - '.$_REQUEST['seleccion']);//COLUMNAS
    $excel->getActiveSheet()->setCellValue('D3', date('d/m/y H:i:s'));//COLUMNAS    // Redirect output to a clientâ€™s web browser (Excel5)
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