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
ini_set('memory_limit', '512M');
require_once('../../tcpdf/config/lang/spa.php');
require_once('../../tcpdf/tcpdf.php');
require_once('../../conexion/Conexion.php');
$cnn = new Conexion();

class MYPDF extends TCPDF {
    //Page header
    public function Header() {
       $html = "
            <table border=\"0\">
		<tr>
			<td align=\"left\" valign=\"middle\">
                        <img src=\"../../imagenes/EncabezadoIzquierda.png\" alt=\"test alt attribute\"  width=\"270px\" height=\"50px\" border=\"0\"/>
                    </td>
                   <td align=\"center\" valign=\"middle\">
                        <img src=\"../../imagenes/MINSA.png\" alt=\"test alt attribute\"  width=\"170px\" height=\"40px\" border=\"0\"/>
                    </td>
<td align=\"rigth\" valign=\"middle\">
                        <img src=\"../../imagenes/EncabezadoDerecha.png\" alt=\"test alt attribute\"  width=\"175px\" height=\"52px\" border=\"0\"/>
                    </td>
                </tr>
 <tr>
 <td align=\"center\" colspan=\"3\">
                            <label style=\"font-size:16;\"><b>REPORTE FAMILIAS EN RIESGO SEG&Uacute;N ETAPA DE VIDA</b></label><br/>
                            <label style=\"font-size:12;\"><b>$_REQUEST[titulo]</b></label><br/>
                        </td>
 </tr>
 <tr>
 <td align=\"center\" colspan=\"3\"><label style=\"font-size:16;\"><b>Hasta $_REQUEST[fechaFin]</b></label><br/></td>
</tr>
</table>
    ";
	   
	      	   
	            $this->writeHTML($html, true, false, true, false, '');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
	$this->SetY(-25);
	// Set font
	$this->SetFont('helvetica', 'I', 8);
	// Page number
        $this->Cell(0, 10, 'Fecha de impresion: '.date('d/m/Y h:i:s a'), 0, false, 'L', 0, '', 0, false, 'T', 'M');
	$this->Cell(0, 10, 'Página '.$this->getAliasNumPage().' de '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
	//$image_file2 = '../../../piereporte.png';
	//$this->Image($image_file2, 55, 275, 110, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);		
    }
}

// create new PDF document
//$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 048');
$pdf->SetSubject('TCPDF Tutorial');

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP + 23, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 12);

// add a page
$pdf->AddPage();

//$pdf->Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);
$pdf->SetAlpha(0.2);

$pdf->SetAlpha(1);
// -----------------------------------------------------------------------------

$cnn->abrirConexion();

//RELACION DE PROGRAMAS

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

function calcularPuntaje($idfamiliaH,$claveGeneral){
    $puntaje = mysql_fetch_array(mysql_query("SELECT SUM(puntaje) FROM riesgoH WHERE idfamiliaH = $idfamilia AND claveGeneral = '$claveGeneral'"));
    return $puntaje[0];
}

$fechaFin = formatoFecha($_REQUEST['fechaFin']);

$resultgen = mysql_query($querygen);
//echo $querygen;
//while($rowgen = mysql_fetch_array($resultgen)){
    //echo $querygen;
    $rowgen = mysql_fetch_array($resultgen);
    $fun = "sf_punrie(fam.idfamiliaH,fam.claveGeneral)";
    /*if($_REQUEST[atributo1]=='ALTO RIESGO') $array = array(" AND $fun>5");
    elseif($_REQUEST[atributo1]=='MEDIANO RIESGO') $array = array(" AND $fun<=5 AND $fun>=3");
    elseif($_REQUEST[atributo1]=='BAJO RIESGO') $array = array(" AND $fun<=2 AND $fun>=0");
    else $array = array("ALTO RIESGO"=>"AND $fun>5","MEDIANO RIESGO"=>"AND $fun<=5 AND $fun>=3","BAJO RIESGO"=>" AND $fun<=2 AND $fun>=0");*/
    if($_REQUEST[atributo1]=='ALTO RIESGO') $array = array(" AND $fun BETWEEN 6 AND 100");
    elseif($_REQUEST[atributo1]=='MEDIANO RIESGO') $array = array("  AND $fun BETWEEN 3 AND 5");
    elseif($_REQUEST[atributo1]=='BAJO RIESGO') $array = array("  AND $fun BETWEEN 0 AND 2");
    else $array = array("ALTO RIESGO"=>" AND $fun BETWEEN 6 AND 100","MEDIANO RIESGO"=>" AND $fun BETWEEN 3 AND 5","BAJO RIESGO"=>" AND $fun BETWEEN 0 AND 2");

    foreach ($array as $key => $wh) {
        //echo $key."<br/>";
        
    $query1 = "SELECT DISTINCT '$key',t.idfamiliaH,t.nombrefamilia,t.puntaje,t.claveGeneral ,CONCAT_WS(' ',perH.nombre,perH.apellidoPaterno,perH.apellidoMaterno) as nombreCompleto ,rieH.etapa, rieH.nombreRiesgo 
                    FROM (SELECT DISTINCT fam.idfamiliaH,nombrefamilia,sf_punrie(fam.idfamiliaH,fam.claveGeneral) as puntaje,fam.claveGeneral
                    FROM riesgoH rie INNER JOIN familiaH fam ON rie.idfamiliaH =fam.idfamiliaH AND rie.claveGeneral=fam.claveGeneral 
                    AND fam.idfamiliaH = sf_maxfam(fam.codigoFicha,'$fechaFin 23:59:59') AND $campo = $rowgen[0]
                    WHERE 1=1 $wh AND fechaHistorial<='$fechaFin 23:59:59' AND fam.activo='AC' AND nombreRiesgo<>'' ) AS t
                    INNER JOIN personaH perH ON t.idfamiliaH = perH.idfamiliaH AND t.claveGeneral=perH.claveGeneral INNER JOIN riesgoH rieH ON rieH.idpersonaH=perH.idpersonaH 
                    AND rieH.claveGeneral=perH.claveGeneral ORDER BY 4 desc,6";
    //echo $query1.";<br/><br/><br/>";
    
    
    $result1 = mysql_query($query1);
    $contenido= "
        <table>
            <tr><th align=\"center\" colspan=\"20\"><b><h3>$key</h3></b></th></tr>
            <tr><th colspan=\"20\"><b>$_REQUEST[atributo]: $rowgen[1]</b></th></tr>
            <tr><th colspan=\"20\"><HR width=\"100%\"/></th></tr>
            <tr>
                <th width=\"30\"></th>
                <th align=\"left\" width=\"30\">Nro.</th>
                <th align=\"left\" width=\"150\">Familia</th>
                <th align=\"left\" width=\"80\">Puntaje</th>
                <th align=\"left\" width=\"150\">Miembro</th>
                <th align=\"left\" width=\"250\">Etapa</th>
                <th align=\"center\" width=\"350\">Nombre riesgo</th>
            </tr>
    ";
    //$pdf->writeHTML($contenido, true, false, true, false, '');

    //$pdf->writeHTML($contenido, true, false, false, false, '');        

        while($row1 = mysql_fetch_array($result1)){
                $temp.= "
                    <tr>
                        <td width=\"30\"></td>
                        <td width=\"30\">".$cont++.".-</td>
                        <td width=\"150\">".$row1[nombrefamilia]."</td>
                        <td width=\"80\">".$row1[puntaje]."</td>
                        <td width=\"150\">".$row1[nombreCompleto]."</td>
                        <td width=\"250\">".$row1[etapa]."</td>
                        <td width=\"350\">".$row1[nombreRiesgo]."</td>
                    </tr>";
                //$contenido.= "a";
                //$pdf->writeHTML($temp, true, false, false, false, '');
        }
        $contenido.="$temp</table>";
        $pdf->writeHTML($contenido, true, false, true, false, '');        
        $temp="";
        $contenido="";
    }
        
    
        //echo $contenido;

   
    //}
        

//}

// -----------------------------------------------------------------------------

//Close and output PDF document
$pdf->Output('reporte_estadistico.pdf', 'I');
?>