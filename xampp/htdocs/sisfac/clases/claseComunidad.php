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
class Comunidad {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function mostrarComunidadDatagrid($idestablecimiento){



        $r = mysql_query("select ");

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

        
        
        if($idestablecimiento!='') $wh.=" AND idestablecimiento = $idestablecimiento";
        $query="SELECT COUNT(*) FROM comunidad WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idcomunidad, nombreComunidad, descripcion FROM comunidad
                WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";

        

        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarComunidadCombobox($idestablecimiento,$select,$claveGeneral){
        //$wh .= " AND claveGeneral = '$_SESSION[claveGeneral]'";
        if($idestablecimiento!='') $wh .=" AND idestablecimiento = $idestablecimiento";
        if($claveGeneral!='') $wh .=" AND claveGeneral = '$claveGeneral'";
        $query = "SELECT idcomunidad,nombreComunidad FROM comunidad WHERE 1=1 $wh ORDER BY nombreComunidad";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function mostrarComunidadTotalCombobox($select){
        $query = "SELECT DISTINCT nombreComunidad,CONCAT_WS('--',nombreComunidad,nombreEstablecimiento) as nombre
                FROM comunidad com INNER JOIN establecimiento est ON com.idestablecimiento=est.idestablecimiento AND com.claveGeneral=est.claveGeneral 
                INNER JOIN distrito dis ON est.iddistrito=dis.iddistrito INNER JOIN provincia pro ON 
                pro.idprovincia=dis.idprovincia INNER JOIN region reg ON reg.idregion=pro.idregion ORDER BY nombreComunidad";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarComunidad($claveGeneral, $idcomunidad, $idestablecimiento, $nombreComunidad, $descripcion){
        $data = verificarDatos('add', array('claveGeneral'=>$claveGeneral,'idcomunidad'=>$idcomunidad,'idestablecimiento'=>$idestablecimiento,'nombreComunidad'=>$nombreComunidad,'descripcion'=>$descripcion));
        if($data[0]!=''){
            $query = "INSERT INTO comunidad($data[0]) VALUES($data[1])";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function actualizarComunidad($claveGeneral, $idcomunidad,$idestablecimiento, $nombreComunidad, $descripcion){
        $data = verificarDatos('update', array('idestablecimiento'=>$idestablecimiento,'nombreComunidad'=>$nombreComunidad,'descripcion'=>$descripcion));
        if($data[0]!=''){
            $query = "UPDATE comunidad SET $data[0] WHERE idcomunidad = $idcomunidad AND claveGeneral = '$claveGeneral'";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function eliminarComunidad($idcomunidad, $claveGeneral){
        $query = "DELETE FROM comunidad WHERE idcomunidad = $idcomunidad AND claveGeneral = '$claveGeneral'";
        mysql_query($query);
    }
    
    
    public function obtenerDatosPorComunidad($idcomunidad) {
        $query = "SELECT nombreRegion,nompro,dis.nombre,nombreEstablecimiento FROM comunidad com INNER JOIN establecimiento est ON 
                com.idestablecimiento =est.idestablecimiento AND com.claveGeneral = est.claveGeneral INNER JOIN distrito dis ON est.iddistrito=dis.iddistrito
                INNER JOIN provincia pro ON pro.idprovincia=dis.idprovincia INNER JOIN region reg ON reg.idregion = pro.idregion 
                WHERE idcomunidad = $idcomunidad  AND com.claveGeneral = '$_SESSION[claveGeneral]'";
        $row = mysql_fetch_array(mysql_query($query));
        return $row[0].'-'.$row[1].'-'.$row[2].'-'.$row[3];
    }
    
    
}
?>