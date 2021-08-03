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
class Region {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function mostrarRegionDatagrid(){
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
                    case 'nompro':
                        $wh .= " AND $k iLIKE '%$v%'";
                        break;
                    case 'departamento':
                        $wh .= " AND $k = '$v'";
                        break;
                }
            }
        }
        
        //$wh.=" AND claveGeneral = '$_SESSION[claveGeneral]'";
        
        $query="SELECT COUNT(*) FROM region WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idregion, nombreRegion,codigoRegion FROM region
                WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";
        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarRegionCombobox($select){
        //$wh.=" AND claveGeneral = '$_SESSION[claveGeneral]'";
        $query = "SELECT idregion, nombreRegion FROM region WHERE 1=1 $wh ORDER BY nombreRegion";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function mostrarRegionTotalCombobox($select){
        $query = "SELECT DISTINCT nombreRegion FROM region ORDER BY nombreRegion";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[0]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarRegion($idregion, $nombreRegion){
        $nombreRegion = aMayusculas($nombreRegion);
        $query = "INSERT INTO region(idregion, nombreRegion) VALUES('$idregion', '$nombreRegion')";
        mysql_query($query);
    }
    
    public function actualizarRegion($idregion,$nombreRegion){
        $nombreRegion = aMayusculas($nombreRegion);
        $query = "UPDATE region SET nombreRegion= '$nombreRegion' WHERE idregion = $idregion";
        mysql_query($query);
    }
    
    public function eliminarRegion($idregion){
        $query = "DELETE FROM region WHERE idregion = $idregion";
        mysql_query($query);
    }
    
    
}
?>