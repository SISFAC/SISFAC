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
class TrabajadorSector {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function mostrarTrabajadorSectorDatagrid($idtrabajador){
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
                    case 'nombre':
                    case 'tipocambio':
                        $wh .= " AND $k LIKE '%$v%'";
                        break;
                    case 'mesas':
                        $wh .= " AND $k = $v";
                        break;
                }
            }
        }
        $wh .= " AND tse.claveGeneral = '$_SESSION[claveGeneral]'";
        if($idtrabajador!='') $wh .= " AND tse.idtrabajador = '$idtrabajador'";
        
        $query="SELECT COUNT(*) FROM trabajadorSector tse LEFT JOIN sector sec ON tse.idsector = sec.idsector AND sec.claveGeneral = tse.claveGeneral WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages = $dato[2];
        $query="SELECT DISTINCT tse.idtrabajadorSector,sec.idsector,nombreCompleto,nombreComunidad,nombreSector
                FROM trabajadorSector tse LEFT JOIN sector sec ON tse.idsector = sec.idsector AND sec.claveGeneral = tse.claveGeneral LEFT JOIN comunidad com ON 
                com.idcomunidad=sec.idcomunidad LEFT JOIN trabajador tra ON tra.idtrabajador=tse.idtrabajador AND tra.idtrabajador=tse.idtrabajador
                WHERE 1 = 1 $wh ORDER BY $sidx $sord LIMIT $limit OFFSET $start";
        //echo $query;
        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function obtenerTrabajador($idsector, $idtrabajador){
        if($idsector!='') $wh = " AND idsector = $idsector";
        $query = "SELECT COUNT(*) FROM trabajadorSector WHERE idtrabajador = $idtrabajador AND claveGeneral = '$_SESSION[claveGeneral]' $wh";
        $row = mysql_fetch_array(mysql_query($query));
        return $row[0];
    }
    
    public function agregarTrabajadorSector($claveGeneral, $idtrabajadorSector, $idsector, $idtrabajador){
        $data = verificarDatos('add', array('claveGeneral'=>$claveGeneral, 'idtrabajadorSector'=>$idtrabajadorSector,'idsector'=>$idsector,'idtrabajador'=>$idtrabajador));
        if($data[0]!=''){

            $query = "INSERT INTO trabajadorSector($data[0]) VALUES($data[1])";
            mysql_query($query);
        }
    }
    
    public function eliminarTrabajadorSector($id, $claveGeneral){
        $query = "DELETE FROM trabajadorSector WHERE idtrabajadorSector = $id AND claveGeneral = '$claveGeneral'";
        mysql_query($query);
    }
    
    public function buscarTrabajadorSector($id, $claveGeneral){
        $query = "SELECT COUNT(*) FROM trabajadorSector WHERE idtrabajador = $id AND claveGeneral = '$claveGeneral'";
        $row = mysql_fetch_array(mysql_query($query));
        return $row[0];
    }
}
?>