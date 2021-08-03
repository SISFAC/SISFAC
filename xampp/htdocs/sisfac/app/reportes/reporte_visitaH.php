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
 <td align=\"center\" colspan=\"3\"><label style=\"font-size:16;\"><b><br/>REPORTE: VISITAS DOMICILIARIAS</b></label><br/></td>
 </tr>
 <tr>
 <td align=\"center\" colspan=\"3\"><label style=\"font-size:14;\"><b>Ficha: $_REQUEST[codigoFicha]  -  Fecha de historial: $_REQUEST[fechaHistorial]</b></label><br/></td>
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

$query = "SELECT fechaVisita, resultado, fechaCita, estadoCita, vis.motivo, vis.trabajador FROM visitaH vis INNER JOIN familiaH fam ON vis.idfamiliaH=fam.idfamiliaH AND vis.claveGeneral=fam.claveGeneral WHERE fam.idfamiliaH = $_REQUEST[idfamiliaH]  AND codigoFicha = '$_REQUEST[codigoFicha]'";
$result = mysql_query($query);
$contenido.= "<table border=\"1\">
                <thead>
                        <tr>
                            <td align=\"center\" width=\"150\">Fecha visita</td>
                            <td align=\"center\" width=\"150\">Resultado</td>
                            <td align=\"center\" width=\"150\">Fecha cita</td>
                            <td align=\"center\" width=\"150\">Estado cita</td>
                            <td align=\"center\" width=\"150\">Motivo cambio cita</td>
                            <td align=\"center\" width=\"150\">Responsable</td>
                        </tr>
                    </thead>
                    <tbody>
    ";
while($row = mysql_fetch_array($result)){
$contenido.= "<tr>
                <td width=\"150\">$row[fechaVisita]</td>
                <td width=\"150\">$row[resultado]</td>
                <td width=\"150\">$row[fechaCita]</td>
                <td width=\"150\">$row[estadoCita]</td>
                <td width=\"150\">$row[motivo]</td>
                <td width=\"150\">$row[trabajador]</td>
    </tr>
";
}

$contenido.="
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