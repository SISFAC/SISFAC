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
class Distrito {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function mostrarDistritoDatagrid($idprovincia){
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
                    case 'dni':
                    case 'fechanacimiento':
                        $wh .= " AND $k LIKE '%$v%'";
                        break;
                    case 'estado':
                    case 'sexo':
                        $wh .= " AND $k = '$v'";
                        break;
                }
            }
        }
        
        if($idprovincia!='') $wh .=" AND dis.idprovincia = $idprovincia"; 
        
        $query="SELECT COUNT(*) FROM distrito dis INNER JOIN provincia pro ON dis.idprovincia=pro.idprovincia 
                WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT iddistrito,pro.idprovincia,dis.nombre,codigoDistrito
                FROM distrito dis INNER JOIN provincia pro ON dis.idprovincia=pro.idprovincia 
                WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";
        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarDistritoCombobox($idprovincia, $select){
        if($idprovincia!='') $wh.=" AND idprovincia = $idprovincia";
        $query = "SELECT iddistrito,nombre FROM distrito WHERE 1=1 $wh ORDER BY nombre";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function mostrarDistritoTotalCombobox($select){
        $query = "SELECT DISTINCT dis.nombre,CONCAT_WS('--',dis.nombre,reg.nombreRegion) as nombre FROM distrito dis INNER JOIN provincia pro ON dis.idprovincia=pro.idprovincia 
                    INNER JOIN region reg ON reg.idregion=pro.idregion ORDER BY nombre";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarDistrito($iddistrito, $idprovincia, $nombre){
        $nombre = aMayusculas($nombre);
        $query = "INSERT INTO distrito(iddistrito, idprovincia, nombre) VALUES($iddistrito, $idprovincia,'$nombre')";
        mysql_query($query);
    }
    
    public function actualizarDistrito($iddistrito,$idprovincia,$nombre){
        $nombre = aMayusculas($nombre);
        $query = "UPDATE distrito SET idprovincia = $idprovincia, nombre = '$nombre' WHERE iddistrito = $iddistrito";
        mysql_query($query);
    }
    
    public function eliminarDistrito($iddistrito){
        $query = "DELETE FROM distrito WHERE iddistrito = $iddistrito";
        mysql_query($query);
    }
    
    
}
?>