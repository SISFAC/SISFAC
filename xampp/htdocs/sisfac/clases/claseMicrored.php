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
class Microred {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function mostrarMicroredDatagrid($idred){
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
                    case 'nombreMicrored':
                        $wh .= " AND $k LIKE '%$v%'";
                        break;
                    case 'departamento':
                        $wh .= " AND $k = '$v'";
                        break;
                }
            }
        }
        
        //$wh.= " AND claveGeneral = '$_SESSION[claveGeneral]'";
        
        if($idred!='') $wh.= " AND idred=$idred";
        
        $query="SELECT COUNT(*) FROM microred WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idmicrored,nombreMicrored FROM microred WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";
        //echo $query;
        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarMicroredCombobox($idred,$select){
        if($idred!='') $wh.= " AND idred = $idred";
        $query = "SELECT idmicrored, nombreMicrored FROM microred WHERE 1=1 $wh ORDER BY nombreMicrored";
        
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function mostrarMicroredTotalCombobox($select){
        $query = "SELECT DISTINCT nombreMicrored,CONCAT_WS('--',nombreMicrored,nombreRegion) nombre FROM microred mic INNER JOIN red ON mic.idred=red.idred 
                    INNER JOIN provincia pro ON pro.idprovincia=red.idprovincia INNER JOIN region reg ON reg.idregion=pro.idregion ORDER BY nombreMicrored";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarMicrored($idmicrored, $idred, $nombreMicrored){
        $nombreMicrored = aMayusculas($nombreMicrored);
        $query = "INSERT INTO microred(idmicrored, idred,nombreMicrored) VALUES($idmicrored,'$idred','$nombreMicrored')";
        mysql_query($query);
    }
    
    public function actualizarMicrored($idmicrored, $nombreMicrored){
        $nombreMicrored = aMayusculas($nombreMicrored);
        $query = "UPDATE microred SET nombreMicrored='$nombreMicrored' WHERE idmicrored = $idmicrored";
        mysql_query($query);
    }
    
    public function eliminarMicrored($idmicrored){
        $query = "DELETE FROM microred WHERE idmicrored = $idmicrored ";
        mysql_query($query);
    }
    
}
?>