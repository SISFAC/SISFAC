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
 <td align=\"center\" colspan=\"3\"><label style=\"font-size:16;\"><b><br/>REPORTE DATOS DE LA FAMILIA</b></label><br/></td>
 </tr>
 <tr>
 <td align=\"center\" colspan=\"3\"><label style=\"font-size:14;\"><b>Ficha: $_REQUEST[codigoFicha]-Fecha de historial: $_REQUEST[fechaHistorial]</b></label><br/></td>
</tr>
</table>
    ";
        $this->writeHTML($html, true, false, true, false, '');
    }

    // Page footer
    public function Footer() {
	
        // Position at 15 mm from bottom
	$this->SetY(-20);
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

$contenido = "
    <table  align='center' border=\"1\">
            
";
$cnn->abrirConexion();

$query = "SELECT fechaHistorial, nombreSector, codigoFicha, fechaApertura, nombreFamilia, lote, telefono, correo, referencia, tipoEntorno, idioma1, 
            idioma2, idioma3, tiempoDemora, tiempoDomicilio, viviendaAnterior, medioTransporte, religion, diaVisita, horaVisita, tipoFamilia, activo, motivo, registrador, trabajador 
            FROM familiaH WHERE idfamiliaH = $_REQUEST[idfamiliaH] AND codigoFicha = '$_REQUEST[codigoFicha]'";
$result = mysql_query($query);
while($row = mysql_fetch_array($result)){
$contenido.= "
            <tr align='center'>
                <td align=\"left\" width=\"200\">Fecha historial</td>
                <td width=\"200\">$row[fechaHistorial]</td>
        </tr>    
        <tr>
    <td align=\"left\" width=\"200\">Sector</td>
                <td width=\"200\">$row[nombreSector]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">C&oacute;digo ficha</td>
                <td width=\"200\">$row[codigoFicha]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Fecha apertura</td>
                <td width=\"200\">$row[fechaApertura]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Familia</td>
                <td width=\"200\">$row[nombreFamilia]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Lote</td>
                <td width=\"200\">$row[lote]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Tel&eacute;fono</td>
                <td width=\"200\">$row[telefono]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Correo</td>
                <td width=\"200\">$row[correo]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Referencia</td>
                <td width=\"200\">$row[referencia]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Tipo entorno</td>
                <td width=\"200\">$row[tipoEntorno]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Idiomas</td>
                <td width=\"200\">$row[idioma1] - $row[idioma2] - $row[idioma3]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Tiempo demora</td>
                <td width=\"200\">$row[tiempoDemora]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Tiempo domicilio</td>
                <td width=\"200\">$row[tiempoDomicilio]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Vivienda anterior</td>
                <td width=\"200\">$row[viviendaAnterior]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Medio transporte</td>
                <td width=\"200\">$row[medioTransporte]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Religi&oacute;n</td>
                <td width=\"200\">$row[religion]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Dias visita</td>
                <td width=\"200\">$row[diaVisita]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Horas visita</td>
                <td width=\"200\">$row[horaVisita]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Tipo familia</td>
                <td width=\"200\">$row[tipoFamilia]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Activo</td>
                <td width=\"200\">".($row[activo]=='AC'?'ACTIVO':'INACTIVO')."</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Motivo</td>
                <td width=\"200\">$row[motivo]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Responsable modificaci&oacute;n</td>
                <td width=\"200\">$row[registrador]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Responsable ejecuci&oacute;n</td>
                <td width=\"200\">$row[trabajador]</td>
            </tr>
";
}
$contenido.="
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