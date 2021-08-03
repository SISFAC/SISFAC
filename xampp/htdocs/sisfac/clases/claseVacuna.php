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
class Vacuna{
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }

    public function mostrarVacunaDatagrid($idpersona, $claveGeneral){
        $limit = $_REQUEST['rows'];
        $page = $_REQUEST['page'];
        $sidx = $_REQUEST['sidx'];
        $sord = $_REQUEST['sord'];
        if(!$sidx) $sidx =1;
        $wh = '';
        $searchOn = Strip($_REQUEST['_search']);
        if($searchOn=='true') {
            $sarr = Strip($_REQUEST);
            foreach( $sarr as $k=>$v) {
                switch ($k) {
                    case 'campo':
                        
                        break;
                }
            }
        }
        
        if($idpersona!='') $wh .= " AND idpersona = $idpersona";
        if($claveGeneral!='') $wh .= " AND claveGeneral = '$claveGeneral'";
        
        $query="SELECT COUNT(*) FROM vacuna WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idvacuna,claveGeneral,idpersona,vac.idcatalogoVacuna,nombreCatalogo,dosis,estadoVacuna FROM vacuna vac INNER JOIN catalogoVacuna cva ON vac.idcatalogoVacuna=cva.idcatalogoVacuna WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";
        //echo $query;
        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarVacunaVector($idvacuna,$claveGeneral){
        $query = "SELECT idvacuna,claveGeneral,idpersona,idcatalogoVacuna,nombreCatalogo,estadoVacuna FROM vacuna WHERE idvacuna = '$idvacuna' AND claveGeneral = '$claveGeneral'  ";
        $row = mysql_fetch_array(mysql_query($query));
        return $row['idvacuna'].'+'.$row['claveGeneral'].'+'.$row['idpersona'].'+'.$row['idcatalogoVacuna'].'+'.$row['nombreCatalogo'].'+'.$row['estadoVacuna'];
    }

    public function mostrarVacunaCombobox($select){
        $query = "SELECT idvacuna,claveGeneral,idpersona,idcatalogoVacuna,nombreCatalogo,estadoVacuna FROM vacuna WHERE 1=1 $wh";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarVacuna($idvacuna,$claveGeneral,$idpersona,$idcatalogoVacuna,$nombreCatalogo,$estadoVacuna){
        $data = verificarDatos('add', array('idvacuna'=>$idvacuna,'claveGeneral'=>$claveGeneral,'idpersona'=>$idpersona,'idcatalogoVacuna'=>$idcatalogoVacuna,'nombreCatalogo'=>$nombreCatalogo,'estadoVacuna'=>$estadoVacuna));
        if($data[0]!=''){
            $query = "INSERT INTO vacuna($data[0]) VALUES($data[1])";
            mysql_query($query);
        }
    }
    
    public function actualizarVacuna($idvacuna,$claveGeneral,$idpersona,$idcatalogoVacuna,$nombreCatalogo,$estadoVacuna){
        $data = verificarDatos('edit', array('idvacuna'=>$idvacuna,'claveGeneral'=>$claveGeneral,'idpersona'=>$idpersona,'idcatalogoVacuna'=>$idcatalogoVacuna,'nombreCatalogo'=>$nombreCatalogo,'estadoVacuna'=>$estadoVacuna)); 
        if($data[0]!=''){
            $query = "UPDATE vacuna SET $data[0] WHERE idvacuna = '$idvacuna' AND claveGeneral = '$claveGeneral' ";
            mysql_query($query);
        }
    }
    
    public function eliminarVacuna($idvacuna,$claveGeneral){
        $query = "DELETE FROM vacuna WHERE idvacuna = '$idvacuna' AND claveGeneral = '$claveGeneral' ";
        mysql_query($query);
    }

}
?>
