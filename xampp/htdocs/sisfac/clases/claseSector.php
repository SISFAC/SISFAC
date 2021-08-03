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
class Sector {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function mostrarSectorDatagrid($idcomunidad){
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
        
        $wh.=" AND sec.claveGeneral = '$_SESSION[claveGeneral]'";
        if($idcomunidad!="") $wh.=" AND com.idcomunidad = $idcomunidad";
        
        $query="SELECT COUNT(*) FROM sector sec INNER JOIN comunidad com ON sec.idcomunidad=com.idcomunidad WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idsector, com.idcomunidad, com.nombreComunidad, nombreSector, sec.descripcion 
                FROM sector sec INNER JOIN comunidad com ON sec.idcomunidad=com.idcomunidad AND sec.claveGeneral = com.claveGeneral
                WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";
        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarSectorEstablecimientoDatagrid($idestablecimiento, $idtrabajador){
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
        $sector = new Sector();
        $temp = $sector->buscarSectorTrabajador($_REQUEST[idtrabajador]);
        $wh.=" AND est.claveGeneral = '$_SESSION[claveGeneral]'";
        if($idestablecimiento!="") $wh.=" AND est.idestablecimiento = $idestablecimiento";
        
        $query="SELECT COUNT(*) FROM establecimiento est INNER JOIN comunidad com ON est.idestablecimiento=com.idestablecimiento AND est.claveGeneral=com.claveGeneral
            INNER JOIN sector sec ON sec.idcomunidad =com.idcomunidad AND sec.claveGeneral=com.claveGeneral WHERE 1=1 $wh ";

        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
      /*  $query="SELECT sec.idsector,nombreEstablecimiento,nombreSector,nombreComunidad
            FROM establecimiento est INNER JOIN comunidad com ON est.idestablecimiento=com.idestablecimiento AND est.claveGeneral=com.claveGeneral
            INNER JOIN sector sec ON sec.idcomunidad =com.idcomunidad AND sec.claveGeneral=com.claveGeneral
            WHERE 1 = 1 $wh AND idsector NOT IN ($temp) ORDER BY $sidx $sord LIMIT $start,$limit";
*/
            $query="SELECT sec.idsector,nombreEstablecimiento,nombreSector,nombreComunidad, ts.idtrabajadorSector
            FROM establecimiento est INNER JOIN comunidad com ON est.idestablecimiento=com.idestablecimiento AND est.claveGeneral=com.claveGeneral
            INNER JOIN sector sec ON sec.idcomunidad =com.idcomunidad AND sec.claveGeneral=com.claveGeneral left outer join trabajadorsector ts on(ts.idtrabajador=$idtrabajador and sec.idsector=ts.idsector)
            WHERE 1 = 1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";

       
        obtenerXML($page, $count, $total_pages, $query);
    }
    /*MBF*/
    public function getSectoresEstablecimiento($idestablecimiento, $idtrabajador){

        $sector = new Sector();
        $temp = $sector->buscarSectorTrabajador($idtrabajador);
        $wh =" AND est.claveGeneral = '$_SESSION[claveGeneral]'";
        
  
            $query="SELECT sec.idsector,nombreEstablecimiento,nombreSector,nombreComunidad, ts.idtrabajadorSector
            FROM establecimiento est INNER JOIN comunidad com ON est.idestablecimiento=com.idestablecimiento AND est.claveGeneral=com.claveGeneral
            INNER JOIN sector sec ON sec.idcomunidad =com.idcomunidad AND sec.claveGeneral=com.claveGeneral left outer join trabajadorsector ts on(ts.idtrabajador=$idtrabajador and sec.idsector=ts.idsector)
            WHERE 1 = 1 $wh";

       $result = mysql_query($query);
        for($rows = array(); $row = mysql_fetch_assoc($result); $rows[] = $row);
       echo json_encode($rows);
    }
    
    public function buscarSectorTrabajador($idtrabajador){
        $result = mysql_query("SELECT idsector FROM trabajadorSector WHERE claveGeneral = '$_SESSION[claveGeneral]'");
        //echo "SELECT idsector FROM trabajadorSector WHERE idtrabajador=$idtrabajador AND claveGeneral = $_SESSION[claveGeneral]";
        $temp='';
        while ($row = mysql_fetch_row($result)) {
            if($row[0]!='') $temp .= $row[0].",";
        }
        return $temp.'-1';
    }
    
    public function mostrarSectorCombobox($idcomunidad, $select, $claveGeneral,$nombreComunidad){
        //$wh.=" AND claveGeneral = '$_SESSION[claveGeneral]'";
        if($idcomunidad!='') $wh.=" AND com.idcomunidad = $idcomunidad";
        if($nombreComunidad!='') $wh.=" AND com.nombreComunidad = '$nombreComunidad'";
        if($claveGeneral!='') $wh.=" AND sec.claveGeneral = '$claveGeneral'";
        $query = "SELECT sec.idsector,nombreSector FROM sector sec INNER JOIN comunidad com ON sec.idcomunidad=com.idcomunidad AND sec.claveGeneral = com.claveGeneral  WHERE 1=1 $wh ORDER BY nombreSector";
        echo $query;
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function mostrarSectorTotalCombobox($select){
        $query = "SELECT DISTINCT nombreSector,CONCAT_WS('--',nombreSector,nombreEstablecimiento) as nombre FROM sector sec INNER JOIN comunidad com ON sec.idcomunidad=com.idcomunidad AND sec.claveGeneral=com.claveGeneral 
                INNER JOIN establecimiento est ON est.idestablecimiento=com.idestablecimiento AND est.claveGeneral=com.claveGeneral ORDER BY nombreSector";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarSector($claveGeneral ,$idsector, $idcomunidad, $nombreSector, $descripcion){
        $data = verificarDatos('add', array('claveGeneral' => $claveGeneral, 'idsector'=>$idsector,'idcomunidad'=>$idcomunidad,'nombreSector'=>$nombreSector,'descripcion'=>$descripcion));
        if($data[0]!=''){
            $query = "INSERT INTO sector($data[0]) VALUES($data[1])";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function actualizarSector($claveGeneral, $idsector, $idcomunidad, $nombreSector, $descripcion){
        $data = verificarDatos('update', array('idcomunidad'=>$idcomunidad,'nombreSector'=>$nombreSector,'descripcion'=>$descripcion));
        if($data[0]!=''){
            $query = "UPDATE sector SET $data[0] WHERE idsector = $idsector AND claveGeneral = '$claveGeneral'";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function eliminarSector($idsector,$claveGeneral){
        $query = "DELETE FROM sector WHERE idsector = $idsector AND claveGeneral = '$claveGeneral'";
        mysql_query($query);
    }
    
    
}
?>