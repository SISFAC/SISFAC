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
class CatalogoCPT{
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }

    public function mostrarCatalogoCPTDatagrid(){
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
        $query="SELECT COUNT(*) FROM catalogoCPT WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idcatalogoCPT,codigoCPT,nombre,estado FROM catalogoCPT WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";

        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function buscarCatalogoCPTVector($codigoCPT){
        $query = "SELECT idcatalogoCPT,CONCAT(codigoCPT,'-',nombre) FROM catalogoCPT WHERE codigoCPT = '$codigoCPT'";
        $row = mysql_fetch_array(mysql_query($query));
        return $row[0].'+'.$row[1];
    }
    
    public function mostrarCatalogoCPTVector($filtro, $limit){
        $query = "SELECT idcatalogoCPT,CONCAT(codigoCPT,'-',nombre) FROM catalogoCPT WHERE CONCAT(codigoCPT,'-',nombre) LIKE '%$filtro%'";
        $result = mysql_query($query);
        $catalogo = array();
        while($row = mysql_fetch_array($result)){
            array_push($catalogo, array("value"=>$row[0],"label"=>$row[1]));
            if(count($catalogo)>$limit) break;
        }
        
        return array_to_json($catalogo);
    }

    public function mostrarCatalogoCPTCombobox($select){
        $query = "SELECT idcatalogoCPT,codigoCPT,nombre,estado FROM catalogoCPT WHERE 1=1 $wh";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarCatalogoCPT($idcatalogoCPT,$codigoCPT,$nombre,$estado){
        $data = verificarDatos('add', array('idcatalogoCPT'=>$idcatalogoCPT,'codigoCPT'=>$codigoCPT,'nombre'=>$nombre,'estado'=>$estado));
        if($data[0]!=''){
            $query = "INSERT INTO catalogoCPT($data[0]) VALUES($data[1])";
            mysql_query($query);
        }
    }
    
    public function actualizarCatalogoCPT($idcatalogoCPT,$codigoCPT,$nombre,$estado){
        $data = verificarDatos('edit', array('idcatalogoCPT'=>$idcatalogoCPT,'codigoCPT'=>$codigoCPT,'nombre'=>$nombre,'estado'=>$estado)); 
        if($data[0]!=''){
            $query = "UPDATE catalogoCPT SET $data[0] WHERE idcatalogoCPT = '$idcatalogoCPT' ";
            mysql_query($query);
        }
    }
    
    public function eliminarCatalogoCPT($idcatalogoCPT){
        $query = "DELETE FROM catalogoCPT WHERE idcatalogoCPT = '$idcatalogoCPT' ";
        mysql_query($query);
    }

}
?>
