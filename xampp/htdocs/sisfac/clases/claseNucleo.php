<?php
/*
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.


*/
require_once '../conexion/Conexion.php';
class Nucleo {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function mostrarNucleoDatagrid($idmicrored){
        $limit = $_REQUEST['rows'];
        $page = $_REQUEST['page'];
        $sidx = $_REQUEST['sidx'];
        $sord = $_REQUEST['sord'];
        if(!$sidx) $sidx =1;
        $wh = "";
        $searchOn = Strip($_REQUEST['_search']);
        if($searchOn=='true') {
            $sarr = Strip($_REQUEST);
            foreach( $sarr as $k=>$v) {
                switch ($k) {
                    case 'nombreNucleo':
                        $wh .= " AND $k LIKE '%$v%'";
                        break;
                    case 'departamento':
                        $wh .= " AND $k = '$v'";
                        break;
                }
            }
        }
        
        //$wh .=" AND claveGeneral = '$_SESSION[claveGeneral]'";
        if($idmicrored!='') $wh.= " AND idmicrored = $idmicrored";
        $query="SELECT COUNT(*) FROM nucleo WHERE 1=1 $wh ";
        //echo $query;
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idnucleo, nombreNucleo FROM nucleo
                WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";
        //echo $query;
        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarNucleoCombobox($idmicrored,$select){
        if($idmicrored!='') $wh .= " AND idmicrored = $idmicrored";
        $query = "SELECT idnucleo, nombreNucleo FROM nucleo WHERE 1=1 $wh ORDER BY nombreNucleo";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function mostrarNucleoTotalCombobox($select){
        $query = "SELECT DISTINCT nombreNucleo,CONCAT_WS('--',nombreNucleo,nombreRegion) nombre 
                FROM nucleo nuc INNER JOIN microred mic ON nuc.idmicrored=mic.idmicrored INNER JOIN red ON mic.idred=red.idred 
                INNER JOIN provincia pro ON pro.idprovincia=red.idprovincia INNER JOIN region reg ON reg.idregion=pro.idregion ORDER BY nombreNucleo";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarNucleo($idnucleo, $idmicrored, $nombreNucleo){
        $nombreNucleo = aMayusculas($nombreNucleo);
        $query = "INSERT INTO nucleo(idnucleo, idmicrored,nombreNucleo) VALUES('$idnucleo','$idmicrored','$nombreNucleo')";
        mysql_query($query);
    }
    
    public function actualizarNucleo($idnucleo, $nombreNucleo){
        $nombreNucleo = aMayusculas($nombreNucleo);
        $query = "UPDATE nucleo SET nombreNucleo = '$nombreNucleo' WHERE idnucleo = $idnucleo";
        mysql_query($query);
    }
    
    public function eliminarNucleo($idnucleo){
        $query = "DELETE FROM nucleo WHERE idnucleo = $idnucleo";
        mysql_query($query);
    }
    
}
?>