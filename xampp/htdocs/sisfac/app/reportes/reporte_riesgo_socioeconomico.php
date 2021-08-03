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
 <td align=\"center\" colspan=\"3\">
                            <label style=\"font-size:14;\"><b>REPORTE DE FAMILIAS EN RIESGO SEG&Uacute;N DATOS SOCIOECON&Oacute;MICOS</b></label><br/>
                            <label style=\"font-size:12;\"><b>$_REQUEST[atributo] : $_REQUEST[seleccion] </b></label><br/>
                            <label style=\"font-size:12;\"><b>$_REQUEST[atributo1]</b></label><br/>
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

$fechaFin = formatoFecha($_REQUEST['fechaFin']);


$resultgen = mysql_query($querygen);
$rowgen = mysql_fetch_array($resultgen);
    if($_REQUEST['atributo1']=='ALTO RIESGO') {$min = 37; $max=100;}
    elseif($_REQUEST['atributo1']=='MEDIANO RIESGO') {$min = 24; $max=36;}
    elseif($_REQUEST['atributo1']=='BAJO RIESGO') {$min = 11; $max=23;}
    else {$min = 0; $max=100;}
    
    
    $query1 = "
            SELECT DISTINCT  fam.nombrefamilia, soc.tipo, soc.descripcion, puntaje, fam.claveGeneral,codigoFicha
            FROM socioeconomicoH soc INNER JOIN familiaH fam ON soc.idfamiliaH = fam.idfamiliaH AND soc.claveGeneral=fam.claveGeneral
            WHERE fam.activo = 'AC' AND $campo = $rowgen[0] AND fechaHistorial<='$fechaFin 23:59:59' ORDER BY 6,5,1,2 ";
        $result1 = mysql_query($query1);
    //echo $query1;
        //<h3>$_REQUEST[atributo1]: $rowgen[1]</h3>
        $contenido = "<table border=\"0.5\"><tr align=\"center\">";
            
            //$array = array('FAMILIA');
            $array = array('FAMILIA',
                'AGUA DE CONSUMO',
                'CUANTAS HABITACIONES HAY EN HOGAR',
                'ELIMINACION DE EXCRETAS',
                'ENERGIA ELECTRICA(EE)',
                'ESTADO CIVIL DEL JEFE DE FAMILIA',
                'GRUPO FAMILIAR',
                'INGRESOS FAMILIARES',
                'NIVEL DE INSTRUCCION DE LA MADRE',
                'NRO DE PERSONAS X DORMITORIO',
                'OCUPACION JEFE DE LA FAMILIA',
                'SALUD EN EL HOGAR',
                'TENENCIA DE LA VIVIENDA',
                'PUNTAJE');
            foreach ($array as $value) {
                $temp .= "<td align=\"center\" width=\"65\"><b>$value</b></td>\n";
            }
            $contenido .="$temp</tr>\n";
            $vector = array();
            $i=0; 
            $puntaje=0;
            $tid = $tcg = $temp = '';
            while($row1 = mysql_fetch_array($result1)){
                if($tid == '' && $tcg == ''){//INICIAMOS
                    $tid=$row1['nombrefamilia'];
                    $tcg=$row1['codigoFicha'];
                    $temp='FAMILIA;'.$row1['nombrefamilia'].'*';
                }
                if(($row1['nombrefamilia'] == $tid && $row1['codigoFicha'] == $tcg)==false){
                    $vector[$temp] = $puntaje;
                    //$temp =(($row1['nombrefamilia'] != $tid && $row1['codigoFicha'] != $tcg)?('FAMILIA;'.$row1['nombrefamilia'].'*'):'').$row1['tipo'].';'.$row1['descripcion'].'*';
                    $temp ='FAMILIA;'.$row1['nombrefamilia'].'*'.$row1['tipo'].';'.$row1['descripcion'].'*';
                    $puntaje = $row1['puntaje'];
                }else{
                    //$temp .=(($row1['nombrefamilia'] != $tid && $row1['codigoFicha'] != $tcg)?('FAMILIA;'.$row1['nombrefamilia'].'*'):'').$row1['tipo'].';'.$row1['descripcion'].'*';
                    $temp .='FAMILIA;'.$row1['nombrefamilia'].'*'.$row1['tipo'].';'.$row1['descripcion'].'*';
                    $puntaje += $row1['puntaje'];
                }
                $tid=$row1['nombrefamilia'];
                $tcg=$row1['codigoFicha'];
            }
            $vector[$temp] = $puntaje;
            arsort($vector);
            //print_r($vector);
            
            $i=$j=0;
$array1 = array('FAMILIA',
                'AGUA DE CONSUMO',
                'CUANTAS HABITACIONES HAY EN HOGAR',
                'ELIMINACION DE EXCRETAS',
                'ENERGIA ELECTRICA(EE)',
                'ESTADO CIVIL DEL JEFE DE FAMILIA',
                'GRUPO FAMILIAR',
                'INGRESOS FAMILIARES',
                'NIVEL DE INSTRUCCION DE LA MADRE',
                'NRO DE PERSONAS X DORMITORIO',
                'OCUPACION JEFE DE LA FAMILIA',
                'SALUD EN EL HOGAR',
                'TENENCIA DE LA VIVIENDA');
        $te = 0;
        $temp='';$pri = "";$opc=$var=$tvar="";
        foreach ($vector as $key => $value) {
            
            $data = explode('*', $key);
            $data = array_values(array_unique($data));
            //$data = array_merge($data,$array1);
            
            
            if($value>=$min && $value<=$max){
                //$pri ="<tr align=\"center\">";
                //echo "<br>";
                //print_r($data);
                $op1=$op2=$op3=$op4=$op5=$op6=$op7=$op8=$op9=$op10=$op11=$op12=$op13=0;
                $i=0;
                foreach ($data as $kla => $val) {
                    $row1 = explode(';',$val);
                    if(isset($row1[0]) && isset($row1[1])){
                        //echo $array1[$i].'-'.$row1[0]."<br>";
                        //echo $row1[0];
                    
                        if($array1[$i] != $row1[0] && $i<12){
                            $tab .= "<td align=\"center\" width=\"65\">-</td>\n";
                            $i++;
                        }
                        
                        if($row1[0] == 'FAMILIA' && $op1==0) {
                            $tab .= "<td align=\"center\" width=\"65\">$row1[1]</td>\n";
                            $op1=1;
                        }
                        if($row1[0] == 'AGUA DE CONSUMO' && $op2==0) {
                            $tab .= "<td align=\"center\" width=\"65\">$row1[1]</td>\n";
                            $op2=1;
                        }
                        if($row1[0] == 'CUANTAS HABITACIONES HAY EN HOGAR' && $op3==0) {
                            $tab .= "<td align=\"center\" width=\"65\">$row1[1]</td>\n";
                            $op3=1;
                        }
                        if($row1[0] == 'ELIMINACION DE EXCRETAS' && $op4==0) {
                            $tab .= "<td align=\"center\" width=\"65\">$row1[1]</td>\n";
                            $op4=1;
                        }
                        if($row1[0] == 'ENERGIA ELECTRICA(EE)' && $op5==0) {
                            $tab .= "<td align=\"center\" width=\"65\">$row1[1]</td>\n";
                            $op5=1;
                        }
                        if($row1[0] == 'ESTADO CIVIL DEL JEFE DE FAMILIA' && $op6==0) {
                            $tab .= "<td align=\"center\" width=\"65\">$row1[1]</td>\n";
                            $op6=1;
                        }
                        if($row1[0] == 'GRUPO FAMILIAR' && $op7==0) {
                            $tab .= "<td align=\"center\" width=\"65\">$row1[1]</td>\n";
                            $op7=1;
                        }
                        if($row1[0] == 'INGRESOS FAMILIARES' && $op8==0) {
                            $tab .= "<td align=\"center\" width=\"65\">$row1[1]</td>\n";
                            $op8=1;
                        }
                        if($row1[0] == 'NIVEL DE INSTRUCCION DE LA MADRE' && $op9==0) {
                            $tab .= "<td align=\"center\" width=\"65\">$row1[1]</td>\n";
                            $op9=1;
                        }
                        if($row1[0] == 'NRO DE PERSONAS X DORMITORIO' && $op10==0) {
                            $tab .= "<td align=\"center\" width=\"65\">$row1[1]</td>\n";
                            $op10=1;
                        }
                        if($row1[0] == 'OCUPACION JEFE DE LA FAMILIA' && $op11==0) {
                            $tab .= "<td align=\"center\" width=\"65\">$row1[1]</td>\n";
                            $op11=1;
                        }
                        if($row1[0] == 'SALUD EN EL HOGAR' && $op12==0) {
                            $temp .= $row1[1].',';
                            $tab .= "<td align=\"center\" width=\"65\">".substr($temp, 0, -1)."</td>\n";
                            $op12=1;
                            
                        }
                        if($row1[0] == 'TENENCIA DE LA VIVIENDA' && $op13==0) {
                            $tab .= "<td align=\"center\" width=\"65\">$row1[1]</td>\n";
                            $op13=1;
                        }else{
                            //$tab .= "<td align=\"center\" width=\"65\">-</td>";
                        }

                        $var = $row1[0];

                        $cont++;
                        
                        $i++;
                    }
                }
                $opc .= "<tr align=\"center\">$tab<td align=\"center\" width=\"65\">$value</td></tr>\n";
                $tab="";
                $temp='';
                $j++;
                $i=0;
            }
        }
        $contenido.="$opc</table>";
      
        
$tbl = <<<EOD
$opc
EOD;
$pdf->writeHTML($contenido, true, false, false, false, '');
$pdf->Output('reporte_estadistico.pdf', 'I');
?>
<script type="text/javascript">
    alert(<?php echo $contenido;?>);
</script>