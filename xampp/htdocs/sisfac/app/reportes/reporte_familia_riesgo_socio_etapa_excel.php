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
    if($_REQUEST['seleccion']!='') $wh = " AND dir.nombreDiresa = '$_REQUEST[seleccion]'";
    $querygen = "SELECT iddiresa, nombreDiresa FROM diresa dir WHERE 1=1 $wh";
    $campo = 'dir.iddiresa';
}
elseif($_REQUEST['atributo'] == 'REGION') {
    if($_REQUEST['seleccion']!='') $wh = " AND reg.nombreRegion = '$_REQUEST[seleccion]'";
    $querygen = "SELECT idregion, nombreRegion FROM region reg WHERE 1=1 $wh";
    $campo = 'reg.idregion';
}
elseif($_REQUEST['atributo'] == 'PROVINCIA') {
    if($_REQUEST['seleccion']!='') $wh = " AND pro.nompro = '$_REQUEST[seleccion]'";
    $querygen = "SELECT idprovincia, nompro FROM provincia pro WHERE 1=1 $wh";
    $campo = 'pro.idprovincia';
}
elseif($_REQUEST['atributo'] == 'DISTRITO') {
    if($_REQUEST['seleccion']!='') $wh = " AND dis.nombre = '$_REQUEST[seleccion]'";
    $querygen = "SELECT iddistrito, nombre FROM distrito dis WHERE 1=1 $wh";
    $campo = 'dis.iddistrito';
}
elseif($_REQUEST['atributo'] == 'SECTOR') {
    if($_REQUEST['seleccion']!='') $wh = " AND sec.nombreSector = '$_REQUEST[seleccion]' AND com.nombreComunidad = '$_REQUEST[codigo1]'";
    $querygen = "SELECT idsector, nombreSector FROM sector sec INNER JOIN comunidad com ON sec.idcomunidad=com.idcomunidad WHERE 1=1 $wh";
    $campo = 'sec.idsector';
}
elseif($_REQUEST['atributo'] == 'COMUNIDAD') {
    if($_REQUEST['seleccion']!='') $wh = " AND com.nombreComunidad = '$_REQUEST[seleccion]'";
    $querygen = "SELECT idcomunidad, nombreComunidad FROM comunidad com WHERE 1=1 $wh";
    $campo = 'com.idcomunidad';
}
elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') {
    if($_REQUEST['seleccion']!='') $wh = " AND est.nombreEstablecimiento = '$_REQUEST[seleccion]'";
    $querygen = "SELECT idestablecimiento, nombreEstablecimiento FROM establecimiento est WHERE 1=1 $wh";
    $campo = 'est.idestablecimiento';
}
elseif($_REQUEST['atributo'] == 'RED') {
    if($_REQUEST['seleccion']!='') $wh = " AND red.nombreRed = '$_REQUEST[seleccion]'";
    $querygen = "SELECT idred, nombreRed FROM red WHERE 1=1 $wh";
    $campo = 'red.idred';
}
elseif($_REQUEST['atributo'] == 'MICRORED') {
    if($_REQUEST['seleccion']!='') $wh = " AND mic.nombreMicrored = '$_REQUEST[seleccion]'";
    $querygen = "SELECT idmicrored, nombreMicrored FROM microred mic WHERE 1=1 $wh";
    $campo = 'mic.idmicrored';
}
elseif($_REQUEST['atributo'] == 'NUCLEO') {
    if($_REQUEST['seleccion']!='') $wh = " AND nuc.nombreNucleo = '$_REQUEST[seleccion]'";
    $querygen = "SELECT idnucleo, nombreNucleo FROM nucleo nuc WHERE 1=1 $wh";
    $campo = 'nuc.idnucleo';
}

//$fechaInicio = formatoFecha($_REQUEST['fechaInicio']);
$fechaFin = formatoFecha($_REQUEST['fechaFin']);

$resultgen = mysql_query($querygen);

while($rowgen = mysql_fetch_array($resultgen)){
    $query1 = "
        SELECT riesgo,COUNT(*)  as total FROM (SELECT DISTINCT fam.idfamiliaH,nombrefamilia,(SELECT SUM(puntaje) FROM riesgoH WHERE
        idfamiliaH = fam.idfamiliaH AND claveGeneral = fam.claveGeneral) as puntaje,
        CASE
        WHEN (SELECT SUM(puntaje) FROM riesgoH WHERE idfamiliaH = fam.idfamiliaH AND claveGeneral = fam.claveGeneral) >5 THEN 'ALTO RIESGO'
        WHEN (SELECT SUM(puntaje) FROM riesgoH WHERE idfamiliaH = fam.idfamiliaH AND claveGeneral = fam.claveGeneral) <=5 &&
        (SELECT SUM(puntaje) FROM riesgoH WHERE idfamiliaH = fam.idfamiliaH AND claveGeneral = fam.claveGeneral) >=3
        THEN 'MEDIANO RIESGO'
        ELSE 'BAJO RIESGO' END as riesgo
        FROM riesgoH rie INNER JOIN familiaH fam ON rie.idfamiliaH =fam.idfamiliaH AND rie.claveGeneral=fam.claveGeneral INNER JOIN sector sec 
        ON fam.idsector=sec.idsector AND fam.claveGeneral=sec.claveGeneral INNER JOIN comunidad com ON com.idcomunidad=sec.idcomunidad AND 
        com.claveGeneral=sec.claveGeneral INNER JOIN establecimiento est ON est.idestablecimiento=com.idestablecimiento AND est.claveGeneral=com.claveGeneral 
        INNER JOIN distrito dis ON dis.iddistrito=est.iddistrito AND dis.claveGeneral=est.claveGeneral INNER JOIN provincia pro ON pro.idprovincia=dis.idprovincia 
        AND pro.claveGeneral=dis.claveGeneral INNER JOIN region reg ON reg.idregion = pro.idregion AND reg.claveGeneral=pro.claveGeneral INNER JOIN 
        nucleo nuc ON nuc.idnucleo = est.idnucleo AND nuc.claveGeneral = est.claveGeneral INNER JOIN microred mic ON mic.idmicrored = nuc.idmicrored 
        AND mic.claveGeneral = nuc.claveGeneral INNER JOIN red ON red.idred=mic.idred AND red.claveGeneral = mic.claveGeneral INNER JOIN diresa dir 
        ON dir.iddiresa=red.iddiresa AND dir.claveGeneral=red.claveGeneral 
        WHERE fam.activo = 'AC' $wh AND fechaHistorial<='$fechaFin 23:59:59' AND fam.idfamiliaH = (SELECT MAX(fam1.idfamiliaH) FROM familiaH fam1
        WHERE fam.codigoFicha = fam1.codigoFicha AND fechaHistorial<= '$fechaFin 23:59:59') ORDER BY 3 desc) AS T GROUP BY 1
        ";
    //ent.tipo = '$_REQUEST[seleccion1]' $wh AND fechaHistorial<='$fechaFin 23:59:59' AND fam.idfamiliaH = (SELECT MAX(fam1.idfamiliaH) FROM familiaH fam1 
    //      WHERE fam.codigoFicha = fam1.codigoFicha AND fechaHistorial<='$fechaFin 23:59:59' )
    
    $result1 = mysql_query($query1);
    //echo $query1;
    $i=3;
    $style['red_text'] = array(
        'font' => array(
            'name' => 'Arial',
            'color' => array(
                'rgb' => '0074C7'
            )
        ),
    );
    $excel->setActiveSheetIndex(0)->setCellValue('B1' ,"NÚMERO DE FAMILIAS EN RIESGO SEGUN ETAPAS DE VIDA - $_REQUEST[atributo]: $_REQUEST[seleccion]")->mergeCells('B1:Z1');
    $excel->getActiveSheet()->getStyle("B1:Z1")->applyFromArray($style['red_text']);
    while ($row = mysql_fetch_array($result1)) {
        $excel->getActiveSheet()->getColumnDimensionByColumn()->setAutoSize(true);
        $excel->setActiveSheetIndex(0)
            ->setCellValue('B'.$i, $row[0])
            ->setCellValue('C'.$i, $row[1]);
        $i++;
    }    

    $excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    $excel->getActiveSheet()->setCellValue('B2', 'RIESGO');//COLUMNAS
    $excel->getActiveSheet()->setCellValue('C2', 'NUMERO DE FAMILIA');//COLUMNAS

    // Rename worksheet
    $excel->getActiveSheet()->setTitle('Reportes');


    // Redirect output to a clientâ€™s web browser (Excel5)
    $nombre = 'FAMILIA_RIESGO'.date('d/m/y H:i:s');
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=$nombre.xls");
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
    $objWriter->save('php://output');

}

?>