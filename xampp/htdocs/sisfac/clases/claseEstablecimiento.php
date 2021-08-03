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
class Establecimiento {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function mostrarEstablecimientoDatagrid($iddistrito, $idnucleo, $idprovincia){
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
                    case 'nombreEstablecimiento':
                        $wh .= " AND $k LIKE '%$v%'";
                        break;
                    case 'est':
                        $wh .= " AND CONCAT(est.claveGeneral,'-', nombreEstablecimiento)  LIKE '%$v%'";
                        break;
                }
            }
        }
        
        //$wh .=" AND est.claveGeneral = '$_SESSION[claveGeneral]'";
        
        if($iddistrito!='') $wh.=" AND dis.iddistrito = $iddistrito";
        if($idnucleo!='') $wh.=" AND nuc.idnucleo = $idnucleo";
        if($idprovincia!='') $wh.=" AND pro.idprovincia = $idprovincia";
        
        $query="SELECT COUNT(*) FROM establecimiento est LEFT JOIN nucleo nuc ON est.idnucleo=nuc.idnucleo 
                LEFT JOIN distrito dis ON dis.iddistrito=est.iddistrito 
                LEFT JOIN provincia pro ON pro.idprovincia = dis.idprovincia WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idestablecimiento, dis.iddistrito, dis.nombre ,nuc.idnucleo, nuc.nombreNucleo, nombreEstablecimiento, tipo, est.claveGeneral, CONCAT(est.claveGeneral,'-', nombreEstablecimiento) as est
                FROM establecimiento est LEFT JOIN nucleo nuc ON est.idnucleo=nuc.idnucleo 
                LEFT JOIN distrito dis ON dis.iddistrito=est.iddistrito 
                LEFT JOIN provincia pro ON pro.idprovincia = dis.idprovincia
                WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";
        //echo $query;
        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarEstablecimientoCombobox($iddistrito, $idnucleo, $idclaveGeneral,$select){
        //$wh .=" AND claveGeneral = '$_SESSION[claveGeneral]'";
        
        if($iddistrito!='') $wh.=" AND iddistrito = $iddistrito";
        if($idnucleo!='') $wh.=" AND idnucleo = $idnucleo";
        if($idclaveGeneral!='') $wh.=" AND idclaveGeneral = $idclaveGeneral";
        $query = "SELECT idestablecimiento,nombreEstablecimiento FROM establecimiento WHERE 1=1 $wh ORDER BY nombreEstablecimiento";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function mostrarEstablecimientoTrabajadorCombobox($iddistrito, $idnucleo, $select){
        $wh .=" AND est.claveGeneral = '$_SESSION[claveGeneral]'";
        
        if($iddistrito!='') $wh.=" AND dis.iddistrito = $iddistrito";
        if($idnucleo!='') $wh.=" AND idnucleo = $idnucleo";
        $query = "SELECT est.idestablecimiento,CONCAT_WS('--',nombreEstablecimiento,nombreRed,nombreRegion)  as nombre
                FROM establecimiento est INNER JOIN distrito dis ON est.iddistrito=dis.iddistrito 
                INNER JOIN provincia pro ON pro.idprovincia=dis.idprovincia INNER JOIN region reg ON 
                reg.idregion=pro.idregion INNER JOIN red ON red.idprovincia=pro.idprovincia  
                WHERE 1=1 $wh ORDER BY nombreEstablecimiento";
        $result = mysql_query($query);
        //echo $query;
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function mostrarEstablecimientoTotalCombobox($select){
        $query = "SELECT DISTINCT nombreEstablecimiento,CONCAT_WS('--',nombreEstablecimiento,nompro,nombreRegion) as nombre FROM establecimiento est INNER JOIN distrito dis ON est.iddistrito=dis.iddistrito 
                INNER JOIN provincia pro ON pro.idprovincia=dis.idprovincia INNER JOIN region reg ON reg.idregion=pro.idregion ORDER BY nombreEstablecimiento";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarEstablecimiento($claveGeneral, $idestablecimiento, $iddistrito, $idnucleo, $nombreEstablecimiento, $tipo){
        $data = verificarDatos('add', array('claveGeneral' => $claveGeneral, 'idestablecimiento' => $idestablecimiento, 'iddistrito'=>$iddistrito, 'idnucleo'=>$idnucleo, 'nombreEstablecimiento '=>$nombreEstablecimiento, 'tipo'=>$tipo));
        if($data[0]!=''){
            $query = "INSERT INTO establecimiento($data[0]) VALUES($data[1])";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function actualizarEstablecimiento($claveGeneral, $idestablecimiento, $iddistrito, $idnucleo, $nombreEstablecimiento, $tipo){
        $data = verificarDatos('edit', array('iddistrito'=>$iddistrito, 'idnucleo'=>$idnucleo, 'nombreEstablecimiento'=>$nombreEstablecimiento, 'tipo'=>$tipo));
        print_r($data);
        if($data[0]!='' && $idestablecimiento!=''){
            //$query = "UPDATE establecimiento SET $data[0] WHERE idestablecimiento = $idestablecimiento AND claveGeneral = '$claveGeneral'";
            $query = "UPDATE establecimiento SET $data[0] WHERE idestablecimiento = $idestablecimiento";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function eliminarEstablecimiento($idestablecimiento, $claveGeneral){
        $query = "DELETE FROM establecimiento WHERE idestablecimiento = $idestablecimiento AND claveGeneral = '$claveGeneral'";
        mysql_query($query);
    }
    
    public function mostrarEstablecimientoTrabajadorVector($filtro, $limit, $iddiresa) {
        $query = "SELECT DISTINCT idestablecimiento, nombreEstablecimiento
                    FROM diresa dir INNER JOIN region reg ON dir.idregion=reg.idregion INNER JOIN provincia pro ON
                    pro.idregion = reg.idregion INNER JOIN distrito dis ON dis.idprovincia=pro.idprovincia 
                    INNER JOIN establecimiento est ON est.iddistrito = dis.iddistrito WHERE iddiresa = $iddiresa AND nombreEstablecimiento LIKE '%$filtro%'";
        
        $result = mysql_query($query);
        $catalogo = array();
        while($row = mysql_fetch_array($result)){
            array_push($catalogo, array("value"=>$row[0],"label"=>$row[1]));
            if(count($catalogo)>$limit) break;
        }
        return array_to_json($catalogo);
    }
    
}
?>