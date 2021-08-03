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
class TratamientoResolutivo {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function mostrarTratamientoResolutivoDatagrid($idepisodio, $claveGeneral){
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
        
        if($idepisodio != '') $wh.=" AND idepisodio = $idepisodio";
        if($claveGeneral != '') $wh.=" AND claveGeneral = '$claveGeneral'";
        
        $query="SELECT COUNT(*) FROM tratamientoResolutivo WHERE 1=1 $wh ";
        //echo $query;
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idtratamientoResolutivo, idcatalogoMedicamento, nombreCatalogo, medicamento, dosis, via, frecuencia, nroDias
                FROM tratamientoResolutivo WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";
        //echo $query;
        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function agregarTratamientoResolutivo($idtratamientoResolutivo, $claveGeneral, $idepisodio, $idcatalogoMedicamento, $nombreCatalogo, $medicamento, $dosis, $via, $frecuencia, $nroDias){
        $data = verificarDatos('add', array('idtratamientoResolutivo'=>$idtratamientoResolutivo,'claveGeneral'=>$claveGeneral, 'idepisodio'=>$idepisodio, 'idcatalogoMedicamento'=>$idcatalogoMedicamento, 'nombreCatalogo'=>$nombreCatalogo, 'tratamiento'=>$tratamiento, 'medicamento'=>$medicamento, 'dosis'=>$dosis, 'via'=>$via, 'frecuencia'=>$frecuencia, 'nroDias'=>$nroDias));
        if($data[0]!=''){
            $query = "INSERT INTO tratamientoResolutivo($data[0]) VALUES($data[1])";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function actualizarTratamientoResolutivo($idtratamientoResolutivo, $claveGeneral, $idepisodio, $idcatalogoMedicamento, $nombreCatalogo, $medicamento, $dosis, $via, $frecuencia, $nroDias){
        $data = verificarDatos('edit', array('idtratamientoResolutivo'=>$idtratamientoResolutivo,'claveGeneral'=>$claveGeneral, 'idepisodio'=>$idepisodio, 'idcatalogoMedicamento'=>$idcatalogoMedicamento, 'nombreCatalogo'=>$nombreCatalogo, 'tratamiento'=>$tratamiento, 'medicamento'=>$medicamento, 'dosis'=>$dosis, 'via'=>$via, 'frecuencia'=>$frecuencia, 'nroDias'=>$nroDias));
        if($data[0]!=''){
            $query = "UPDATE tratamientoResolutivo SET $data[0] WHERE idtratamientoResolutivo = $idtratamientoResolutivo AND claveGeneral = '$claveGeneral'";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function eliminarTratamientoResolutivo($id, $claveGeneral){
        $query = "DELETE FROM tratamientoResolutivo WHERE idtratamientoResolutivo = $id AND claveGeneral = '$claveGeneral'";
        mysql_query($query);
    }
}
?>