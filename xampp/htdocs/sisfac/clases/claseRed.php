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
class Red {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function mostrarRedDatagrid($iddiresa){
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
                    case 'nombreRed':
                        $wh .= " AND $k LIKE '%$v%'";
                        break;
                    case 'departamento':
                        $wh .= " AND $k = '$v'";
                        break;
                }
            }
        }
        
        if($iddiresa!='') $wh .= " AND iddiresa = $iddiresa";
        
        //$wh .= " AND red.claveGeneral = '$_SESSION[claveGeneral]'";
        
        $query="SELECT COUNT(*) FROM red LEFT JOIN provincia pro ON red.idprovincia = pro.idprovincia WHERE 1=1 $wh ";
        //echo $query;
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idred,nombreRed,nompro,pro.idprovincia FROM red LEFT JOIN provincia pro ON red.idprovincia = pro.idprovincia 
                WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";
        //echo $query;
        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarRedCombobox($idregion,$iddiresa,$select){
        if($idregion!='') $wh .= " AND idregion = $idregion";
        if($iddiresa!='') $wh .= " AND iddiresa = $iddiresa";
        
        $query = "SELECT idred, nombreRed FROM red WHERE 1=1 $wh ORDER BY nombreRed";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function mostrarRedTotalCombobox($select){
        $query = "SELECT DISTINCT nombreRed,CONCAT_WS('--',nombreRed,nombreRegion) nombre FROM red INNER JOIN provincia pro ON red.idprovincia=pro.idprovincia 
                INNER JOIN region reg ON reg.idregion=pro.idregion ORDER BY nombreRed";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarRed($idred, $iddiresa, $idprovincia, $nombreRed){
        $data = verificarDatos('add', array('idred'=>$idred, 'iddiresa'=>$iddiresa, 'idprovincia'=>$idprovincia,'nombreRed'=>$nombreRed)); 
        if($data[0]!=''){
            $query = "INSERT INTO red($data[0]) VALUES($data[1])";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function actualizarRed($idred, $iddiresa, $idprovincia, $nombreRed){
        $data = verificarDatos('edit', array('idprovincia'=>$idprovincia,'nombreRed'=>$nombreRed, 'iddiresa'=>$iddiresa)); 
        if($data[0]!='' && $idred!=''){
            $query = "UPDATE red SET $data[0] WHERE idred = $idred";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function eliminarRed($idred){
        $query = "DELETE FROM red WHERE idred = $idred";
        mysql_query($query);
    }
    
}
?>