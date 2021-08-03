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
class Provincia {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function mostrarProvinciaDatagrid($idregion){
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
        
        if($idregion!='') $wh.=" AND reg.idregion = $idregion";
        
        $query="SELECT COUNT(*) FROM provincia pro INNER JOIN region reg ON pro.idregion=reg.idregion WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idprovincia,reg.idregion,nombreRegion,nompro,codigoProvincia
                FROM provincia pro INNER JOIN region reg ON pro.idregion=reg.idregion
                WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";
//        echo $query ;
        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarProvinciaCombobox($idregion,$select){
        if($idregion!='') $wh .= " AND idregion = $idregion";
        $query = "SELECT idprovincia,nompro FROM provincia WHERE 1=1 $wh ORDER BY nompro";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function mostrarProvinciaTotalCombobox($select){
        $query = "SELECT DISTINCT nompro,CONCAT_WS('--',nompro,nombreRegion) FROM provincia pro INNER JOIN region reg ON pro.idregion=reg.idregion ORDER BY nompro";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarProvincia($idprovincia, $idregion,$nompro){
        $nompro = aMayusculas($nompro);
        $query = "INSERT INTO provincia(idprovincia,idregion,nompro) VALUES($idprovincia,'$idregion','$nompro')";
        echo $query;
        mysql_query($query);
    }
    
    public function actualizarProvincia($idprovincia,$idregion,$nompro){
        $nompro = aMayusculas($nompro);
        $query = "UPDATE provincia SET idregion='$idregion', nompro='$nompro' WHERE idprovincia = $idprovincia";
        mysql_query($query);
    }
    
    public function eliminarProvincia($idprovincia){
        $query = "DELETE FROM provincia WHERE idprovincia = $idprovincia ";
        mysql_query($query);
    }
    
    public function obtenerProvinciaNucleo($idnucleo){
        $query = "SELECT DISTINCT pro.idprovincia FROM nucleo nuc INNER JOIN microred mic ON nuc.idmicrored = mic.idmicrored 
                    INNER JOIN red ON red.idred=mic.idred INNER JOIN diresa dir ON dir.iddiresa = red.iddiresa INNER JOIN provincia pro ON pro.idregion=dir.idregion 
                    INNER JOIN distrito dis ON dis.idprovincia=pro.idprovincia 
                    WHERE idnucleo = $idnucleo ";
        $row = mysql_fetch_array(mysql_query($query));
        return $row[0];
    }
    
}
?>