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
class Diresa {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function mostrarDiresaDatagrid(){
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
                    case 'nombreDiresa':
                        $wh .= " AND $k LIKE '%$v%'";
                        break;
                    case 'departamento':
                        $wh .= " AND $k = '$v'";
                        break;
                }
            }
        }
        
        //$wh .= " AND dir.claveGeneral = '$_SESSION[claveGeneral]'";
        
        $query="SELECT COUNT(*) FROM diresa dir LEFT JOIN region reg ON dir.idregion=reg.idregion WHERE 1=1 $wh ";
        //echo $query;
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT iddiresa,nombreDiresa,nombreRegion,dir.idregion FROM diresa dir LEFT JOIN region reg ON dir.idregion=reg.idregion 
                WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";
        //echo $query;
        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarDiresaCombobox($idregion,$select,$iddiresa){
        if($idregion!='') $wh = " AND idregion = $idregion";
        $query = "SELECT iddiresa, nombreDiresa FROM diresa WHERE 1=1 $wh ORDER BY nombreDiresa";
        $result = mysql_query($query);
        if($select) echo "<select>";
        //$iddiresa = explode('-', $_SESSION[claves]);
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'".($row[0]=="$iddiresa"?'selected':'').">$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function mostrarDiresaTotalCombobox($select){
        $query = "SELECT DISTINCT nombreDiresa,CONCAT_WS('--',nombreDiresa,nombreRegion) FROM diresa dir INNER JOIN region reg ON dir.idregion=reg.idregion
                ORDER BY nombreDiresa";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarDiresa($iddiresa, $idregion, $nombreDiresa){
        $data = verificarDatos('add', array('iddiresa'=>$iddiresa, 'idregion'=>$idregion,'nombreDiresa'=>$nombreDiresa));
        if($data[0]!=''){
            $query = "INSERT INTO diresa($data[0]) VALUES($data[1])";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function actualizarDiresa($iddiresa, $idregion, $nombreDiresa){
        $data = verificarDatos('edit', array('idregion'=>$idregion,'nombreDiresa'=>$nombreDiresa)); 
        if($data[0]!='' && $iddiresa!=''){
            $query = "UPDATE diresa SET $data[0] WHERE iddiresa = $iddiresa";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function eliminarDiresa($iddiresa){
        $query = "DELETE FROM diresa WHERE iddiresa = $iddiresa";
        mysql_query($query);
    }
    
    public function buscarIDSNombres($idsector,$claveGeneral){
        $query =  "
            SELECT DISTINCT sec.idsector, sec.nombreSector, com.idcomunidad, com.nombreComunidad, est.idestablecimiento, est.nombreEstablecimiento, dis.iddistrito, 
            dis.nombre, pro.idprovincia, pro.nompro, reg.idregion, reg.nombreRegion, nuc.idnucleo, nuc.nombreNucleo, mic.idmicrored, mic.nombreMicrored, red.idred, 
            red.nombreRed, dir.iddiresa, dir.nombreDiresa
            FROM sector sec 
            INNER JOIN comunidad com ON com.idcomunidad=sec.idcomunidad AND com.claveGeneral=sec.claveGeneral AND idsector = $idsector AND sec.claveGeneral = '$claveGeneral'
            INNER JOIN establecimiento est ON est.idestablecimiento=com.idestablecimiento AND est.claveGeneral=com.claveGeneral INNER JOIN distrito dis ON dis.iddistrito=est.iddistrito
            INNER JOIN provincia pro ON pro.idprovincia=dis.idprovincia INNER JOIN region reg ON reg.idregion = pro.idregion
            INNER JOIN nucleo nuc ON nuc.idnucleo = est.idnucleo INNER JOIN microred mic ON mic.idmicrored = nuc.idmicrored
            INNER JOIN red ON red.idred=mic.idred INNER JOIN diresa dir ON dir.iddiresa=red.iddiresa";
        //echo $query1;
        $row = mysql_fetch_array(mysql_query($query));
        return $row[idsector].'-'.$row[nombreSector].'-'.$row[idcomunidad].'-'.$row[nombreComunidad].'-'.$row[idestablecimiento].'-'.$row[nombreEstablecimiento].'-'.$row[iddistrito].'-'.$row[nombre].'-'.$row[idprovincia].'-'.$row[nompro].'-'.$row[idregion].'-'.$row[nombreRegion].'-'.$row[idnucleo].'-'.$row[nombreNucleo].'-'.$row[idmicrored].'-'.$row[nombreMicrored].'-'.$row[idred].'-'.$row[nombreRed].'-'.$row[iddiresa].'-'.$row[nombreDiresa];
    }
    
}
?>