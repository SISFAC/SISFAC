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
class AntecedentePatologico {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function mostrarAntecedentePatologicoDatagrid($_REQUEST, $tipo, $idpersona){
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
                    case 'campo':
                        $wh .= " AND $k iLIKE '%$v%'";
                        break;
                }
            }
        }
        
        if($idpersona != '') $wh .= " AND idpersona = $idpersona";
        $wh .= " AND claveGeneral = '$_SESSION[claveGeneral]'";
        
        $query="SELECT COUNT(*) FROM antecedentePatologico WHERE 1=1 AND tipo = '$tipo' $wh ";
        //echo $query;
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idantecedentePatologico, tipo, fecha, idcatalogoCIE10, nombreCatalogo, fuente, observacion FROM antecedentePatologico WHERE 1=1 AND tipo = '$tipo' $wh ORDER BY $sidx $sord LIMIT $start,$limit";
        //echo $query;
        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarCombobox($select){
        $query = "SELECT campo FROM tabla WHERE 1=1 $wh";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarAntecedentePatologico($idantecedentePatologico, $claveGeneral, $idpersona, $tipo, $fecha, $idcatalogoCIE10, $nombreCatalogo, $fuente, $observacion){
        $data = verificarDatos('add', array('idantecedentePatologico'=>$idantecedentePatologico,'claveGeneral'=>$claveGeneral, 'idpersona'=>$idpersona, 'tipo'=>$tipo, 'fecha'=>$fecha, 'idcatalogoCIE10'=>$idcatalogoCIE10, 'nombreCatalogo'=>$nombreCatalogo, 'fuente'=>$fuente, 'observacion'=>$observacion));
        if($data[0]!=''){
            $query = "INSERT INTO antecedentePatologico($data[0]) VALUES($data[1])";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function actualizarAntecedentePatologico($idantecedentePatologico, $claveGeneral, $idpersona, $tipo, $fecha, $idcatalogoCIE10, $nombreCatalogo, $fuente, $observacion){
        $data = verificarDatos('edit', array('idantecedentePatologico'=>$idantecedentePatologico,'claveGeneral'=>$claveGeneral, 'idpersona'=>$idpersona, 'tipo'=>$tipo, 'fecha'=>$fecha, 'idcatalogoCIE10'=>$idcatalogoCIE10, 'nombreCatalogo'=>$nombreCatalogo, 'fuente'=>$fuente, 'observacion'=>$observacion));
        if($data[0]!=''){
            $query = "UPDATE antecedentePatologico SET $data[0] WHERE idantecedentePatologico = $idantecedentePatologico AND claveGeneral = '$claveGeneral'";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function eliminarAntecedentePatologico($idantecedentePatologico, $claveGeneral){
        $query = "DELETE FROM antecedentePatologico WHERE idantecedentePatologico = $idantecedentePatologico  AND claveGeneral = '$claveGeneral'";
        mysql_query($query);
    }
}
?>