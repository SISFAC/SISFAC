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
                            <label style=\"font-size:12;\"><b>$_REQUEST[atributo] : $_REQUEST[seleccion]</b></label><br/>
                            <label style=\"font-size:12;\"><b>$_REQUEST[titulo]</b></label><br/>
                        </td>
 </tr>
 <tr>
 <td align=\"center\" colspan=\"3\"><label style=\"font-size:16;\"><b>Hasta ".date('d/m/Y h:i:s a')."</b></label><br/></td>
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

$datos = explode('-',datoReporte($_REQUEST[atributo], $_REQUEST[opc]));
$wh = $datos[0];
$querygen = $datos[1];
$campo = $datos[2];

function calcularPuntaje($idfamiliaH,$claveGeneral){
    $puntaje = mysql_fetch_array(mysql_query("SELECT SUM(puntaje) FROM riesgoH WHERE idfamiliaH = $idfamilia AND claveGeneral = '$claveGeneral'"));
    return $puntaje[0];
}


//$resultgen = mysql_query($querygen);
//$rowgen = mysql_fetch_array($resultgen);
    if($_REQUEST['atributo1']=='ALTO RIESGO') {$min = 6; $max=100;}//$array = array(" AND $fun BETWEEN 6 AND 100");
    elseif($_REQUEST['atributo1']=='MEDIANO RIESGO') {$min = 3; $max=5;}//$array = array("  AND $fun BETWEEN 3 AND 5");
    elseif($_REQUEST['atributo1']=='BAJO RIESGO') {$min = 0; $max=2;}//$array = array("  AND $fun BETWEEN 0 AND 2");
    else {$min = 0; $max=100;}//$array = array("ALTO RIESGO"=>" AND $fun BETWEEN 6 AND 100","MEDIANO RIESGO"=>" AND $fun BETWEEN 3 AND 5","BAJO RIESGO"=>" AND $fun BETWEEN 0 AND 2");

    $query1 = "
            SELECT fam.codigoFicha,nombrefamilia,rie.puntaje,fam.claveGeneral ,CONCAT_WS(' ',per.nombre,per.apellidoPaterno,per.apellidoMaterno) as  
            nombreCompleto ,rie.etapa, rie.nombreRiesgo, dni  
            FROM familia fam INNER JOIN persona per ON fam.idfamilia = per.idfamilia AND fam.claveGeneral=per.claveGeneral  INNER JOIN riesgo rie ON 
            rie.idpersona=per.idpersona AND rie.claveGeneral = per.claveGeneral
            WHERE 1=1 $wh AND nombreRiesgo<>'' AND per.activo='AC' AND fam.activo='AC' ORDER BY 1,4,2,5,6,7
        ";
    
    
    $result1 = mysql_query($query1);
    while ($row = mysql_fetch_array($result1)) {
        if($tid == '' && $tcg == ''){//INICIAMOS
            $tid=$row['codigoFicha'];
            $tcg=$row['claveGeneral'];
        }
        if(($row['codigoFicha'] == $tid && $row['claveGeneral'] == $tcg)==false){
            $vector[$temp] = $puntaje;
            $temp =$row['nombrefamilia'].';'.$row['nombreCompleto'].';'.$row['etapa'].';'.$row['nombreRiesgo'].'*';
            $puntaje = $row['puntaje'];
        }else{
            $temp .=$row['nombrefamilia'].';'.$row['nombreCompleto'].';'.$row['etapa'].';'.$row['nombreRiesgo'].'*';
            $puntaje += $row['puntaje'];
        }
        $tid=$row['codigoFicha'];
        $tcg=$row['claveGeneral'];
    }
    $vector[$temp] = $puntaje;
    arsort($vector);
    $temp="";
    $contenido= "
        <table>
            <tr><th align=\"center\" colspan=\"20\"><b><h3>$key</h3></b></th></tr>
            <tr><th colspan=\"20\"><b>$_REQUEST[atributo]: $_REQUEST[seleccion]</b></th></tr>
            <tr><th colspan=\"20\"><HR width=\"100%\"/></th></tr>
            <tr>
                <th width=\"30\"></th>
                <th align=\"left\" width=\"30\">Nro.</th>
                <th align=\"left\" width=\"150\">Familia</th>
                <th align=\"left\" width=\"150\">Miembro</th>
                <th align=\"left\" width=\"250\">Etapa</th>
                <th align=\"center\" width=\"350\">Nombre riesgo</th>
            </tr>
    ";
    $cont = 1;
    foreach ($vector as $key => $value) {
        if($value>=$min && $value<=$max){
            $data = explode('*', $key);
            foreach ($data as $kla => $val) {
                $row1 = explode(';',$val);
                if(isset($row1[0]) && isset($row1[1]) && isset($row1[2]) && isset($row1[3])){
                    $temp.= "
                    <tr>
                        <td width=\"30\"></td>
                        <td width=\"30\">".$cont++.".-</td>
                        <td width=\"150\">".$row1[0]."</td>
                        <td width=\"150\">".$row1[1]."</td>
                        <td width=\"250\">".$row1[2]."</td>
                        <td width=\"350\">".$row1[3]."</td>
                    </tr>";
                    $i++;
                    //$cont++;
                }
            }
            $temp .= "<tr><td colspan=\"4\" align=\"right\"><b>PUNTAJE: $value</b></td></tr>";
            $i++;
        }
    }
        $contenido.="$temp</table>";
        //echo $contenido;
        $pdf->writeHTML($contenido, true, false, true, false, '');        
        $temp="";
        $contenido="";
        
$pdf->Output('reporte_estadistico.pdf', 'I');
?>