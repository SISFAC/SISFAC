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
//$excel = $archivo->load('Planilla_reporte.xlsx');

global $wh;

$datos = explode('-',datoReporte($_REQUEST[atributo], $_REQUEST[seleccion1]));
$wh = $datos[0];
$querygen = $datos[1];
$campo = $datos[2];
if(trim($_REQUEST['codigoFicha']) != '') $wh.=" AND fam.codigoFicha = '$_REQUEST[codigoFicha]'";


$wh.=" AND fam.activo='AC' and per.activo='AC'";


$resultgen = mysql_query($querygen);


if($_REQUEST['opc'] == 7){
    $campos = "fam.nombreRegion, fam.nompro, fam.nombre, nombreComunidad, nombreSector, fam.claveGeneral, nombreEstablecimiento, opcionDNI, dni, 
            codigoFicha, per.apellidoPaterno, per.apellidoMaterno, per.nombre, sexo, fechaNacimiento ,fechaNacimiento , per.seguroMedico, per.numeroSeguro, jefeFamilia, 
            gradoInstruccion, idioma1, idioma2, idioma3, descripcion, numeroHC, reg.nombreRegion, pro.nompro, dis.nombre, parentesco, estadoCivil, ocupacion, tipoOcupacion, 
            fam.idfamilia, pertenenciaEtnica, desendenciaEtnica, per.activo, per.motivo" ;
    $nombreArchivo = "01Rep_InformacionGeneralIndividualPoblacion";
}else if($_REQUEST['opc'] == 1){
    $campos = "fam.claveGeneral, fam.codigoFicha, fam.nombreFamilia, CONCAT_WS(' ', per.nombre, per.apellidoPaterno, per.apellidoMaterno) as nombres, nombreSector, nombreComunidad, dni, fechaNacimiento" ;
    $wh.=" AND con.codigoCondicion=2";
    $nombreArchivo = "02Rep_ListadoGestantes";
}else if($_REQUEST['opc'] == 2){
    $campos = "fam.claveGeneral, fam.codigoFicha, fam.nombreFamilia, nombreCiclo, CONCAT_WS(' ', per.nombre, per.apellidoPaterno, per.apellidoMaterno) as nombres, nombreSector, nombreComunidad" ;
    $wh.=" AND per.jefeFamilia='SI'";
    $nombreArchivo = "03Rep_FamiliasCicloVital";
}else if($_REQUEST['opc'] == 3){
    $campos = "fam.claveGeneral, fam.codigoFicha, fam.nombreFamilia, tipoFamilia, CONCAT_WS(' ', per.nombre, per.apellidoPaterno, per.apellidoMaterno) as nombres, nombreSector, nombreComunidad" ;
    $wh.=" AND per.jefeFamilia='SI'";
    $nombreArchivo = "04Rep_FamiliasTipoFamilia";
}else if($_REQUEST['opc'] == 4){
    $campos = "fam.claveGeneral, fam.codigoFicha, fam.nombreFamilia, CONCAT_WS(' ', per.nombre, per.apellidoPaterno, per.apellidoMaterno) as nombres, fechaNacimiento, nombreSector, nombreComunidad" ;
    $wh.=" AND seguroMedico='SIN SEGURO'";
    $nombreArchivo = "05_Rep_PersonasSinSeguro";
}else if($_REQUEST['opc'] == 5){
    $campos = "fam.claveGeneral, fam.codigoFicha, fam.nombreFamilia, nombreSector, nombreComunidad, COUNT(*)" ;
    $wh.=" ORDER BY fam.codigoFicha";
    $nombreArchivo = "06Rep_NumeroVisitasPorFamilia";
}else if($_REQUEST['opc'] == 6){
    $campos = "fam.claveGeneral, fam.codigoFicha, fam.nombreFamilia, nombreSector, nombreComunidad, fechaVisita, vis.trabajador, resultado, fechaCita" ;
    $wh .= " ORDER BY fam.codigoFicha";
    $nombreArchivo = "07Rep_VisitasFamiliares";
}

$excel = $archivo->load($nombreArchivo.'.xlsx');
while($rowgen = mysql_fetch_array($resultgen)){
    
    if($_REQUEST['opc'] == 5){
        $query1 = "SELECT distinct claveGeneral, codigoFicha, nombreFamilia, nombreSector, nombreComunidad, COUNT(*) FROM(
                SELECT fam.claveGeneral, fam.codigoFicha, fam.nombreFamilia, nombreSector, nombreComunidad,resultado,fechaVisita
                FROM familia fam LEFT JOIN persona per ON fam.idfamilia=per.idfamilia AND fam.claveGeneral=per.claveGeneral 
                LEFT JOIN condicion con ON per.idpersona=con.idpersona AND con.claveGeneral=per.claveGeneral 
                LEFT JOIN ciclo cic ON fam.idfamilia=cic.idfamilia AND fam.claveGeneral = cic.claveGeneral 
                INNER JOIN visita vis ON vis.idfamilia=fam.idfamilia AND vis.claveGeneral=fam.claveGeneral 
                WHERE 1=1 AND fam.activo = 'AC' AND per.activo='AC' $wh) AS T  GROUP BY 1,2,3,4,5 ORDER BY 2";
    }elseif($_REQUEST['opc'] == 7){
        $query1 = "
            SELECT distinct $campos
            FROM familia fam LEFT JOIN persona per ON fam.idfamilia=per.idfamilia AND fam.claveGeneral=per.claveGeneral 
            LEFT JOIN socioeconomico soc ON fam.claveGeneral = soc.claveGeneral AND fam.idfamilia = soc.idfamilia AND soc.tipo='INGRESOS FAMILIARES'
            LEFT JOIN distrito dis ON dis.iddistrito=per.iddistrito LEFT JOIN provincia pro ON dis.idprovincia=pro.idprovincia LEFT JOIN region reg ON reg.idregion=pro.idregion
            LEFT JOIN condicion con ON con.idpersona=per.idpersona AND con.claveGeneral = per.claveGeneral
            WHERE 1=1 AND fam.activo = 'AC' AND per.activo='AC' $wh ";
    }elseif($_REQUEST['opc'] == 6){
        $query1 = "
            SELECT  distinct $campos
            FROM familia fam LEFT JOIN persona per ON fam.idfamilia=per.idfamilia AND fam.claveGeneral=per.claveGeneral 
            LEFT JOIN condicion con ON per.idpersona=con.idpersona AND con.claveGeneral=per.claveGeneral 
            LEFT JOIN ciclo cic ON fam.idfamilia=cic.idfamilia AND fam.claveGeneral = cic.claveGeneral
            INNER JOIN visita vis ON vis.idfamilia=fam.idfamilia AND vis.claveGeneral=fam.claveGeneral
            WHERE 1=1 AND fam.activo = 'AC' AND per.activo='AC' $wh ";
    }
    else{
        $query1 = "
            SELECT distinct $campos
            FROM familia fam LEFT JOIN persona per ON fam.idfamilia=per.idfamilia AND fam.claveGeneral=per.claveGeneral 
            LEFT JOIN condicion con ON per.idpersona=con.idpersona AND con.claveGeneral=per.claveGeneral 
            LEFT JOIN ciclo cic ON fam.idfamilia=cic.idfamilia AND fam.claveGeneral = cic.claveGeneral
            LEFT JOIN visita vis ON vis.idfamilia=fam.idfamilia AND vis.claveGeneral=fam.claveGeneral
            WHERE 1=1 AND fam.activo = 'AC' AND per.activo='AC' $wh ";
    }
    
   
    $result1 = mysql_query($query1);
    $i=6;
    while ($row = mysql_fetch_array($result1)) {
        $j=0;
        if($_REQUEST[opc] == 7){
            $excel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $i-5)
                ->setCellValue('B'.$i, $row[$j++])
                ->setCellValue('C'.$i, $row[$j++])
                ->setCellValue('D'.$i, $row[$j++])
                ->setCellValue('E'.$i, $row[$j++])
                ->setCellValue('F'.$i, $row[$j++])
                ->setCellValue('G'.$i, $row[$j++])
                ->setCellValue('H'.$i, $row[$j++])
                ->setCellValue('I'.$i, $row[$j++])
                ->setCellValue('J'.$i, $row[$j++])
                ->setCellValue('K'.$i, $row[$j++])
                ->setCellValue('L'.$i, $row[$j++])
                ->setCellValue('M'.$i, $row[$j++])
                ->setCellValue('N'.$i, $row[$j++])
                ->setCellValue('O'.$i, $row[$j++])
                ->setCellValue('P'.$i, obtenerEdad($row[$j++]))
                ->setCellValue('Q'.$i, $row[$j++])
                ->setCellValue('R'.$i, $row[$j++])
                ->setCellValue('S'.$i, $row[$j++])
                ->setCellValue('T'.$i, $row[$j++])
                ->setCellValue('U'.$i, $row[$j++])
                ->setCellValue('V'.$i, $row[$j++])
                ->setCellValue('W'.$i, $row[$j++])
                ->setCellValue('X'.$i, $row[$j++])
                ->setCellValue('Y'.$i, $row[$j++])
                ->setCellValue('Z'.$i, $row[$j++])
                ->setCellValue('AA'.$i, $row[$j++])
                ->setCellValue('AB'.$i, $row[$j++])
                ->setCellValue('AC'.$i, $row[$j++])
                ->setCellValue('AD'.$i, $row[$j++]=='P'?'PADRE':($row[28]=='M'?'MADRE':($row[28]=='H'?'HIJO/HIJA':($row[28]=='A'?'ABUELO/ABUELA':($row[28]=='T'?'TIO/TIA':($row[28]=='N'?'NIETO/NIETA':($row[28]=='PA'?'PADRE ADOPTIVO':($row[28]=='MA'?'MADRE ADOPTIVA':($row[28]=='PD'?'PADRASTRO':($row[28]=='MD'?'MADRASTRA':($row[28]=='NU'?'NUERA':($row[28]=='YE'?'YERNO':($row[28]=='OT'?'OTRO':'')))))))))))))
                ->setCellValue('AE'.$i, $row[$j++]=='S'?'SOLTERO':($row[29]=='CV'?'CONVIVIENTE':($row[29]=='C'?'CASADO':($row[29]=='SE'?'SEPARADO':($row[29]=='D'?'DIVORCIADO':($row[29]=='V'?'VIUDO':''))))))
                ->setCellValue('AF'.$i, $row[$j++]=='S'?'TRABAJADOR ESTABLE':($row[30]=='V'?'EVENTUAL':($row[30]=='D'?'DESOCUPADO':($row[30]=='J'?'JUBILADO':($row[30]=='E'?'ESTUDIANTE':($row[30]=='A'?'AMA DE CASA':($row[30]=='N'?'NO APLICA':'')))))))
                ->setCellValue('AG'.$i, $row[$j++]);
            
                //
                $tempt = "";
                
                $queryt = mysql_query("SELECT nombreCondicion FROM condicion con1 INNER JOIN persona per1 ON con1.idpersona=per1.idpersona AND con1.claveGeneral = per1.claveGeneral WHERE per1.dni = $row[dni] AND per1.idfamilia = $row[idfamilia]");
                while ($rowt = mysql_fetch_array($queryt)) {
                    //$tempt .= $rowt[0].',';
                    if($rowt[0] == 'APARENTEMENTE SANO') $excel->setActiveSheetIndex(0)->setCellValue('AH'.$i, $rowt[0]);
                    if($rowt[0] == 'GESTANTE') $excel->setActiveSheetIndex(0)->setCellValue('AI'.$i, $rowt[0]);
                    if($rowt[0] == 'CON DISCAPACIDAD') $excel->setActiveSheetIndex(0)->setCellValue('AJ'.$i, $rowt[0]);
                    if($rowt[0] == 'ENFERMO') $excel->setActiveSheetIndex(0)->setCellValue('AK'.$i, $rowt[0]);
                }
                $j++;
                $excel->setActiveSheetIndex(0)->setCellValue('AL'.$i, $row[$j++])
                ->setCellValue('AM'.$i, $row[$j++])
                ->setCellValue('AN'.$i, ($row[$j++]=='AC'?'ACTIVO':'INACTIVO'))
                ->setCellValue('AO'.$i, $row[$j++]);
        }else if($_REQUEST[opc] == 1) {
            $excel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $i-5)
                ->setCellValue('B'.$i, $row[$j++])
                ->setCellValue('C'.$i, $row[$j++])
                ->setCellValue('D'.$i, $row[$j++])
                ->setCellValue('E'.$i, $row[$j++])
                ->setCellValue('F'.$i, $row[$j++])
                ->setCellValue('G'.$i, $row[$j++])
                ->setCellValue('H'.$i, $row[$j++])
                ->setCellValue('I'.$i, obtenerEdad($row[$j++]));
        }else if($_REQUEST[opc] == 2) {
            $excel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $i-5)
                ->setCellValue('B'.$i, $row[$j++])
                ->setCellValue('C'.$i, $row[$j++])
                ->setCellValue('D'.$i, $row[$j++])
                ->setCellValue('E'.$i, $row[$j++])
                ->setCellValue('F'.$i, $row[$j++])
                ->setCellValue('G'.$i, $row[$j++])
                ->setCellValue('H'.$i, $row[$j++]);
        }else if($_REQUEST[opc] == 3) {
            $excel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $i-5)
                ->setCellValue('B'.$i, $row[$j++])
                ->setCellValue('C'.$i, $row[$j++])
                ->setCellValue('D'.$i, $row[$j++])
                ->setCellValue('E'.$i, $row[$j++])
                ->setCellValue('F'.$i, $row[$j++])
                ->setCellValue('G'.$i, $row[$j++])
                ->setCellValue('H'.$i, $row[$j++]);
        }else if($_REQUEST[opc] == 4) {
            $excel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $i-5)
                ->setCellValue('B'.$i, $row[$j++])
                ->setCellValue('C'.$i, $row[$j++])
                ->setCellValue('D'.$i, $row[$j++])
                ->setCellValue('E'.$i, $row[$j++])
                ->setCellValue('F'.$i, obtenerEdad($row[$j++]))
                ->setCellValue('G'.$i, $row[$j++])
                ->setCellValue('H'.$i, $row[$j++]);
        }else if($_REQUEST[opc] == 5) {
            $excel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $i-5)
                ->setCellValue('B'.$i, $row[$j++])
                ->setCellValue('C'.$i, $row[$j++])
                ->setCellValue('D'.$i, $row[$j++])
                ->setCellValue('E'.$i, $row[$j++])
                ->setCellValue('F'.$i, $row[$j++])
                ->setCellValue('G'.$i, $row[$j++])
                ->setCellValue('H'.$i, $row[$j++]);
        }else if($_REQUEST[opc] == 6) {
            $excel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $i-5)
                ->setCellValue('B'.$i, $row[$j++])
                ->setCellValue('C'.$i, $row[$j++])
                ->setCellValue('D'.$i, $row[$j++])
                ->setCellValue('E'.$i, $row[$j++])
                ->setCellValue('F'.$i, $row[$j++])
                ->setCellValue('G'.$i, $row[$j++])
                ->setCellValue('H'.$i, $row[$j++])
                ->setCellValue('I'.$i, $row[$j++])
                ->setCellValue('J'.$i, $row[$j++]);
        }
        $i++;
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
    $excel->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
    $excel->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);

    $excel->getActiveSheet()->setCellValue('A2', $_REQUEST['atributo'].': '. $_REQUEST['seleccion']);//COLUMNAS
    $excel->getActiveSheet()->setCellValue('D3', date('d/m/y H:i:s'));//COLUMNAS


    // Redirect output to a clientâ€™s web browser (Excel5)
    $nombre = $nombreArchivo.date('d/m/y H:i:s');
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=$nombre.xls");
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
    $objWriter->save('php://output');
}

?>