<?php
/*
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.


*/
require_once ('../../jpgraph/src/jpgraph.php');
require_once ('../../jpgraph/src/jpgraph_bar.php');

require_once('../../conexion/Conexion.php');
$cnn = new Conexion();
$cnn->abrirConexion();

$ejex = array();
$ejey =array();

if($_REQUEST['atributo'] == 'REGION') {
    if($_REQUEST['seleccion']!='') $wh = " AND reg.idregion = $_REQUEST[seleccion]";
    $querygen = "SELECT idregion, nombreRegion FROM region reg WHERE 1=1 $wh";
    $campo = 'reg.idregion';
}
elseif($_REQUEST['atributo'] == 'PROVINCIA') {
    if($_REQUEST['seleccion']!='') $wh = " AND pro.idprovincia = $_REQUEST[seleccion]";
    $querygen = "SELECT idprovincia, nompro FROM provincia pro WHERE 1=1 $wh";
    $campo = 'pro.idprovincia';
}
elseif($_REQUEST['atributo'] == 'DISTRITO') {
    if($_REQUEST['seleccion']!='') $wh = " AND dis.iddistrito = $_REQUEST[seleccion]";
    $querygen = "SELECT iddistrito, nombre FROM distrito dis WHERE 1=1 $wh";
    $campo = 'dis.iddistrito';
}
elseif($_REQUEST['atributo'] == 'SECTOR') {
    if($_REQUEST['seleccion']!='') $wh = " AND sec.nombreSector = '$_REQUEST[seleccion]' AND com.nombreComunidad = '$_REQUEST[codigo1]'";
    $querygen = "SELECT idsector, nombreSector FROM sector sec INNER JOIN comunidad com ON sec.idcomunidad=com.idcomunidad WHERE 1=1 $wh";
    $campo = 'sec.idsector';
}
elseif($_REQUEST['atributo'] == 'COMUNIDAD') {
    if($_REQUEST['seleccion']!='') $wh = " AND com.idcomunidad = $_REQUEST[seleccion]";
    $querygen = "SELECT idcomunidad, nombreComunidad FROM comunidad com WHERE 1=1 $wh";
    $campo = 'com.idcomunidad';
}
elseif($_REQUEST['atributo'] == 'ESTABLECIMIENTO') {
    if($_REQUEST['seleccion']!='') $wh = " AND est.idestablecimiento = $_REQUEST[seleccion]";
    $querygen = "SELECT idestablecimiento, nombreEstablecimiento FROM establecimiento est WHERE 1=1 $wh";
    $campo = 'est.idestablecimiento';
}

$resultgen = mysql_query($querygen);

while($rowgen = mysql_fetch_array($resultgen)){
    $query1 = "SELECT etapa, COUNT(*) FROM familia fam INNER JOIN persona per ON fam.idfamilia = per.idfamilia INNER JOIN riesgo rie ON (rie.idpersona = per.idpersona OR rie.idfamilia = fam.idfamilia)
                INNER JOIN sector sec ON fam.idsector=sec.idsector INNER JOIN comunidad com ON com.idcomunidad=sec.idcomunidad INNER JOIN establecimiento est ON est.idestablecimiento = com.idestablecimiento 
                INNER JOIN distrito dis ON dis.iddistrito=est.iddistrito INNER JOIN provincia pro ON pro.idprovincia=dis.iddistrito INNER JOIN region reg ON reg.idregion=pro.idregion 
                WHERE 1=1 $wh GROUP BY 1 ORDER BY 1 ";
    $result1 = mysql_query($query1);
    
    while ($row = mysql_fetch_array($result1)) {
        $ejex[] = $row[0];
        $ejey[] = $row[1];
    }
}

if($ejex) {
    // Creamos el grafico
    $grafico = new Graph(1000, 400, 'auto');
    $grafico->SetScale("textint");
    $grafico->title->Set("NRO DE PERSONAS POR ETAPA DE VIDA");
    $grafico->xaxis->title->Set("Etapas");
    $grafico->xaxis->SetTickLabels($ejex);
    $grafico->yaxis->title->Set("Nro de personas");
    $barplot1 =new BarPlot($ejey);
    // Un gradiente Horizontal de morados
    $barplot1->SetFillGradient("#0074C7", "#0074C7", GRAD_HOR);
    // 30 pixeles de ancho para cada barra
    $barplot1->SetWidth(30);
    $grafico->Add($barplot1);
    $grafico->Stroke();
}
?>