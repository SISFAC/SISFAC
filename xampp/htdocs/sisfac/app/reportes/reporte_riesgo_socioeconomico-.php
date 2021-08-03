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
require_once('../../dompdf/convertToPDF.php');
require_once('../../conexion/Conexion.php');
$cnn = new Conexion();

$cnn->abrirConexion();

$style = "body{
font:12px Arial, Tahoma, Verdana, Helvetica, sans-serif;
background-color:#BECEDC;
color:#000;
}

a h1{
font-size:35px;	
color:#FFF;
}

h2{
color:#FC0;
font-size:15px;	
}

table{
width:100%;
height:auto;
margin:10px 0 10px 0;
border-collapse:collapse;
text-align:center;
background-color:#365985;
color:#FFF;
}

table td,th{
border:1px solid black;
}

table th{
color:#FC0;	
}

.menu{
background-color:#69C;
color:#FFF;
}

.menu a{
color:#FFF;	
}";
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

$fechaFin = formatoFecha($_REQUEST['fechaFin']);


$resultgen = mysql_query($querygen);

while($rowgen = mysql_fetch_array($resultgen)){
    $fun = "sf_punsoc(fam.idfamiliaH,fam.claveGeneral)";
    /*if($_REQUEST[atributo1]=='ALTO RIESGO') $punt = array("ALTO RIESGO"=>" AND $fun<=100 AND $fun>=37");
    elseif($_REQUEST[atributo1]=='MEDIANO RIESGO') $punt = array("MEDIANO RIESGO"=>" AND $fun<=36 AND $fun>=24");
    elseif($_REQUEST[atributo1]=='BAJO RIESGO') $punt = array("BAJO RIESGO"=>" AND $fun<=23 AND $fun>=11");
    else $punt = array("ALTO RIESGO"=>"AND $fun<=100 AND $fun>=37","MEDIANO RIESGO"=>"AND $fun<=36 AND $fun>=24","BAJO RIESGO"=>"AND $fun<=23 AND $fun>=0");
    if($_REQUEST['atributo1']=='ALTO RIESGO') $punt = array("ALTO RIESGO"=>" AND $fun BETWEEN 37 AND 100");
    elseif($_REQUEST['atributo1']=='MEDIANO RIESGO') $punt = array("MEDIANO RIESGO"=>" AND $fun BETWEEN 24 AND 37");
    elseif($_REQUEST['atributo1']=='BAJO RIESGO') $punt = array("BAJO RIESGO"=>" AND $fun BETWEEN 11 AND 24");
    else $punt = array("ALTO RIESGO"=>" AND $fun BETWEEN 37 AND 100","MEDIANO RIESGO"=>" AND $fun BETWEEN 24 AND 37","BAJO RIESGO"=>" AND $fun BETWEEN 11 AND 24");*/
    if($_REQUEST['atributo1']=='ALTO RIESGO') $punt = array("ALTO RIESGO"=>" AND $fun BETWEEN 37 AND 100");
    elseif($_REQUEST['atributo1']=='MEDIANO RIESGO') $punt = array("MEDIANO RIESGO"=>" AND $fun BETWEEN 24 AND 36");
    elseif($_REQUEST['atributo1']=='BAJO RIESGO') $punt = array("BAJO RIESGO"=>" AND $fun BETWEEN 11 AND 23");
    else $punt = array("ALTO RIESGO"=>" AND $fun BETWEEN 37 AND 100","MEDIANO RIESGO"=>" AND $fun BETWEEN 24 AND 36","BAJO RIESGO"=>" AND $fun BETWEEN 11 AND 23");
    
    
    foreach ($punt as $key => $wh) {
        //echo $wh;
    $query1 = "SELECT DISTINCT fam.nombrefamilia, soc.tipo, soc.descripcion, puntaje, '' as totalpuntaje, fam.claveGeneral
                FROM socioeconomicoH soc INNER JOIN familiaH fam ON soc.idfamiliaH = fam.idfamiliaH AND soc.claveGeneral=fam.claveGeneral INNER JOIN familia fam1 ON 
                fam1.codigoFicha = fam.codigoFicha 
                WHERE fam.activo='AC' AND $campo = $rowgen[0] AND fechaHistorial<='$fechaFin 23:59:59' ORDER BY 5 desc,1, 2 ";
    $result1 = mysql_query($query1);
    //echo $query1;
        $contenido= "
            <h3>$key</h3>
            <table border=\"0.5\">
                <b>$rowgen[1]</b><br/>
                <tr align=\"center\">";
            
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
            $array1 = array('');
            unset($array1[0]);
            $i=0; $nroColumna = 12;//mysql_numrows($result1);// NUMERO DE COLUMNAS
            //echo $nroColumna ;
            $puntaje=0;$t='';
            while($row1 = mysql_fetch_array($result1)){
                if($row1[1]!='SALUD EN EL HOGAR'){
                    $puntaje += $row1[3];
                    if($i%$nroColumna==0) {
                        $array1[] = $row1[0];
                        $i=0;
                    }
                }
                
                if($row1[1]=='SALUD EN EL HOGAR'){
                    $t .= $row1[2].'-';
                }
                elseif($t!='') {
                    $array1[] = $t;
                    
                    $t='';
                    if($i==$nroColumna - 1){
                        $array1[] = $puntaje;
                        $puntaje=0;
                    }
                    $i++;
                }
                if($t==''){
                    $array1[] = $row1[2];
                    if($i==$nroColumna - 1){
                        $array1[] = $puntaje;
                        $puntaje=0;
                    }
                    $i++;
                }
            }
            //$array = array_unique($array);//BORRAR DATOS DUPLICADOS
            //$array[$nroColumna + 1] = 'PUNTAJE';
            
            foreach ($array as $value) {
                $contenido .= "<td align=\"center\" width=\"65\"><b>$value</b></td>";
            }
            $contenido .="</tr><tr align=\"center\">";
            $i=0;
            foreach ($array1 as $key => $value) {
                $contenido .= "<td align=\"center\" width=\"65\">$value</td>";
                if($i%($nroColumna + 1)==0 && $i>0) {
                    $contenido .="</tr><tr>";
                    $i=0;
                }else $i++;
            }
            
            unset($array);
            unset($array1);
            $contenido.="</tr></table><br/><br/>";
            //doPDF('ejemplo',$contenido,false); 
            doPDF('ejemplo',$contenido,true,'style.css',false,'letter','landscape');  

}
    }

?>