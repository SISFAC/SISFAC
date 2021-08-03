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
 <td align=\"center\" colspan=\"3\"><label style=\"font-size:16;\"><b><br/>DATOS DE LOS MIEMBROS FAMILIARES</b></label><br/></td>
 </tr>
 <tr>
 <td align=\"center\" colspan=\"3\"><label style=\"font-size:14;\"><b>Ficha: $_REQUEST[codigoFicha] - Fecha de historial: $_REQUEST[fechaHistorial]</b></label><br/></td>
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

$query = "SELECT numeroHC, opcionDNI, dni, per.nombre, apellidoPaterno, apellidoMaterno, sexo, fechaNacimiento, per.nombreDistrito, gradoInstruccion, 
        seguroMedico, numeroSeguro, ocupacion, tipoOcupacion, parentesco, estadoCivil, jefeFamilia, pertenenciaEtnica, desendenciaEtnica, per.activo, per.motivo 
        FROM personaH per INNER JOIN familiaH fam ON per.idfamiliaH = fam.idfamiliaH AND per.claveGeneral = fam.claveGeneral WHERE fam.idfamiliaH = $_REQUEST[idfamiliaH]  AND codigoFicha = '$_REQUEST[codigoFicha]'";
$result = mysql_query($query);
//echo $query;
while($row = mysql_fetch_array($result)){
$contenido.= "
    <table border=\"1\">
            <tr>
                <td align=\"left\" width=\"200\">N&uacute;mero HC</td>
                <td width=\"200\">$row[numeroHC]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Opcion DNI</td>
                <td width=\"200\">$row[opcionDNI]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">DNI</td>
                <td width=\"200\">$row[dni]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Nombres</td>
                <td width=\"200\">$row[nombre]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Apellido paterno</td>
                <td width=\"200\">$row[apellidoPaterno]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Apellido materno</td>
                <td width=\"200\">$row[apellidoMaterno]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Sexo</td>
                <td width=\"200\">".($row[sexo]=='M'?'MASCULINO':'FEMENINO')."</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Fecha nacimiento</td>
                <td width=\"200\">$row[fechaNacimiento]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Lugar nacimiento</td>
                <td width=\"200\">$row[nombreDistrito]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Grado instruccion</td>
                <td width=\"200\">$row[gradoInstruccion]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Seguro m&eacute;dico</td>
                <td width=\"200\">$row[seguroMedico]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">N&uacute;mero seguro</td>
                <td width=\"200\">$row[numeroSeguro]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Ocupaci&oacute;n</td>
                <td width=\"200\">".($row[ocupacion]=='S'?'TRABAJADOR ESTABLE':($row[ocupacion]=='V'?'EVENTUAL':($row[ocupacion]=='D'?'DESOCUPADO':($row[ocupacion]=='J'?'JUBILADO':($row[ocupacion]=='E'?'ESTUDIANTE':($row[ocupacion]=='A'?'AMA DE CASA':'NO APLICA'))))))."</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Tipo ocupacion</td>
                <td width=\"200\">$row[tipoOcupacion]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Parentesco</td>
                <td width=\"200\">".($row[parentesco]=='P'?'PADRE':($row[parentesco]=='M'?'MADRE':($row[parentesco]=='H'?'HIJO':($row[parentesco]=='A'?'ABUELO/ABUELA':($row[parentesco]=='T'?'TIO/TIA':($row[parentesco]=='N'?'NIETO/NIETA':($row[parentesco]=='PA'?'PADRE ADOPTIVO':'MADRE ADOPTIVA')))))))."</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Estado civil</td>
                <td width=\"200\">".($row[estadoCivil]=='S'?'SOLTERO':($row[estadoCivil]=='CV'?'CONVIVIENTE':($row[estadoCivil]=='C'?'CASADO':($row[estadoCivil]=='SE'?'SEPARADO':($row[estadoCivil]=='D'?'DIVORCIADO':'VIUDO')))))."</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Jefe de familia</td>
                <td width=\"200\">$row[jefeFamilia]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Pertenencia &eacute;tnica</td>
                <td width=\"200\">$row[pertenenciaEtnica]</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Desendencia &eacute;tnica</td>
                <td width=\"200\">$row[desendenciaEtnica]</td>
        </tr>   
        <tr>
                <td align=\"left\" width=\"200\">Activo</td>
                <td width=\"200\">".($row[activo]=='AC'?'ACTIVO':'INACTIVO')."</td>
        </tr>    
        <tr>
                <td align=\"left\" width=\"200\">Motivo</td>
                <td width=\"200\">$row[motivo]</td>
        </tr></table>    <br/>
";
}

$tbl = <<<EOD
$contenido
EOD;
$pdf->SetFont('helvetica', '', 9);
$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------

//Close and output PDF document
$pdf->Output('reporte_egresos.pdf', 'I');


?>