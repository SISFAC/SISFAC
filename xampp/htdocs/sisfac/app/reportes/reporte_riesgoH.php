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
 <td align=\"center\" colspan=\"3\"><label style=\"font-size:16;\"><b><br/>DATOS DE LOS RIESGOS POR ETAPA DE VIDA</b></label><br/></td>
 </tr>
 <tr>
 <td align=\"center\" colspan=\"3\"><label style=\"font-size:14;\"><b>Ficha: $_REQUEST[codigoFicha]    -    Fecha de historial: $_REQUEST[fechaHistorial]</b></label><br/></td>
</tr>
</table>
    ";
 $this->writeHTML($html, true, false, true, false, '');
    }

    // Page footer
    public function Footer() {
	
	//$this->writeHTML($html, true, false, true, false, '');
        // Position at 15 mm from bottom
	$this->SetY(-25);
	// Set font
	$this->SetFont('helvetica', 'I', 8);
	// Page number
	    //$this->Cell(0, 10, $html, 0, false, 'L', 0, '', 0, false, 'T', 'M');
    $this->Cell(0, 10, 'Fecha de impresion: '.date('d/m/Y h:i:s a'), 0, false, 'L', 0, '', 0, false, 'T', 'M');
	$this->Cell(0, 10, 'Página '.$this->getAliasNumPage().' de '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
	$image_file2 = '../../imagenes/EncabezadoIzquierda.png';
	$this->Image($image_file2, 55, 275, 110, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);		
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
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP + 25, PDF_MARGIN_RIGHT);
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

$cnn->abrirConexion();

$query = "SELECT CONCAT_WS(' ',per.nombre,apellidoPaterno,apellidoMaterno) as nombre, etapa, nombreRiesgo, puntaje
            FROM riesgoH rie INNER JOIN personaH per ON rie.idpersonaH=per.idpersonaH AND rie.claveGeneral = per.claveGeneral
            INNER JOIN familiaH fam ON fam.idfamiliaH = per.idfamiliaH AND fam.claveGeneral = per.claveGeneral
            WHERE rie.idfamiliaH = $_REQUEST[idfamiliaH]  AND codigoFicha = '$_REQUEST[codigoFicha]'";
$result = mysql_query($query);
$contenido.= "
    <table border=\"1\">
        <thead>
            <tr>
                <td align=\"center\" width=\"300\">Miembro</td>
                <td align=\"center\" width=\"300\">Etapa</td>
                <td align=\"center\" width=\"300\">Riesgo</td>
                <td align=\"center\" width=\"50\">Puntaje</td>
            </tr>
        </thead>
        <tbody>
        ";
while($row = mysql_fetch_array($result)){
$contenido.= "<tr>
    <td width=\"300\">$row[nombre]</td>
    <td width=\"300\">$row[etapa]</td>
    <td width=\"300\">$row[nombreRiesgo]</td>
    <td width=\"50\" align=\"right\" >$row[puntaje]</td></tr>
";
$s += $row[puntaje];
}
$contenido.= "
    <tr><td width=\"900\" align=\"right\" colspan=\"3\" ><b>Total:</b></td>
        <td width=\"50\" align=\"right\" ><b>$s</b></td></tr>
        </tbody>
        </table>
        ";

$tbl = <<<EOD
$contenido
EOD;
$pdf->SetFont('helvetica', '', 9);
$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------

//Close and output PDF document
$pdf->Output('reporte_egresos.pdf', 'I');


?>