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
class DetalleVacuna{
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }

    public function mostrarDetalleVacunaDatagrid($idvacuna, $claveGeneral){
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
        
        if($idvacuna != '') $wh.= " AND dva.idvacuna = $idvacuna";
        if($claveGeneral != '') $wh .= " AND dva.claveGeneral = '$claveGeneral'";
        
        $query="SELECT COUNT(*) FROM detalleVacuna dva WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT dva.iddetalleVacuna,dva.claveGeneral,dva.idvacuna,dva.nroDosis,opProgramacion,tipoProgramacion,fechaProgramada,fechaAplicacion,estadoDosis,lugarAplicacion,observaciones,opProgramacion
                FROM detalleVacuna dva WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";
        //echo $query;
        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarDetalleVacunaVector($iddetalleVacuna,$claveGeneral){
        $query = "SELECT iddetalleVacuna,claveGeneral,idvacuna,nroDosis,tipoProgramacion,fechaProgramada,fechaAplicacion,estadoDosis,observaciones FROM detalleVacuna WHERE iddetalleVacuna = '$iddetalleVacuna' AND claveGeneral = '$claveGeneral'  ";
        $row = mysql_fetch_array(mysql_query($query));
        return $row['iddetalleVacuna'].'+'.$row['claveGeneral'].'+'.$row['idvacuna'].'+'.$row['nroDosis'].'+'.$row['tipoProgramacion'].'+'.$row['fechaProgramada'].'+'.$row['fechaAplicacion'].'+'.$row['estadoDosis'].'+'.$row['observaciones'];
    }
    
    public function mostrarDetalleVacunaDosisVector($idvacuna, $nroDosis, $claveGeneral){
        $query = "SELECT iddetalleVacuna,claveGeneral,idvacuna,nroDosis,tipoProgramacion,fechaProgramada,fechaAplicacion,estadoDosis,observaciones FROM detalleVacuna WHERE idvacuna = '$idvacuna' AND nroDosis = $nroDosis AND claveGeneral = '$claveGeneral'  ";
        $row = mysql_fetch_array(mysql_query($query));
        return $row['iddetalleVacuna'].'+'.$row['claveGeneral'].'+'.$row['idvacuna'].'+'.$row['nroDosis'].'+'.$row['tipoProgramacion'].'+'.$row['fechaProgramada'].'+'.$row['fechaAplicacion'].'+'.$row['estadoDosis'].'+'.$row['observaciones'];
    }

    public function mostrarDetalleVacunaCombobox($select){
        $query = "SELECT iddetalleVacuna,claveGeneral,idvacuna,nroDosis,tipoProgramacion,fechaProgramada,fechaAplicacion,estadoDosis,observaciones FROM detalleVacuna WHERE 1=1 $wh";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarDetalleVacuna($iddetalleVacuna,$claveGeneral,$idvacuna,$nroDosis,$opProgramacion,$tipoProgramacion,$fechaProgramada,$fechaAplicacion,$estadoDosis,$lugarAplicacion,$observaciones){
        $data = verificarDatos('add', array('iddetalleVacuna'=>$iddetalleVacuna,'claveGeneral'=>$claveGeneral,'idvacuna'=>$idvacuna,'nroDosis'=>$nroDosis,'opProgramacion'=>$opProgramacion,'tipoProgramacion'=>$tipoProgramacion,'fechaProgramada'=>$fechaProgramada,'fechaAplicacion'=>$fechaAplicacion,'estadoDosis'=>$estadoDosis,'lugarAplicacion'=>$lugarAplicacion,'observaciones'=>$observaciones));
        if($data[0]!=''){
            $query = "INSERT INTO detalleVacuna($data[0]) VALUES($data[1])";
            mysql_query($query);
        }
    }
    
    public function actualizarDetalleVacuna($iddetalleVacuna,$claveGeneral,$idvacuna,$nroDosis,$tipoProgramacion,$fechaProgramada,$fechaAplicacion,$estadoDosis,$lugarAplicacion,$observaciones){
        $data = verificarDatos('edit', array('iddetalleVacuna'=>$iddetalleVacuna,'claveGeneral'=>$claveGeneral,'idvacuna'=>$idvacuna,'nroDosis'=>$nroDosis,'tipoProgramacion'=>$tipoProgramacion,'fechaProgramada'=>$fechaProgramada,'fechaAplicacion'=>$fechaAplicacion,'estadoDosis'=>$estadoDosis,'lugarAplicacion'=>$lugarAplicacion,'observaciones'=>$observaciones)); 
        if($data[0]!=''){
            $query = "UPDATE detalleVacuna SET $data[0] WHERE iddetalleVacuna = '$iddetalleVacuna' AND claveGeneral = '$claveGeneral' ";
            echo $query;
            mysql_query($query);
        }
    }
    
    public function eliminarDetalleVacuna($iddetalleVacuna,$claveGeneral){
        $query = "DELETE FROM detalleVacuna WHERE iddetalleVacuna = '$iddetalleVacuna' AND claveGeneral = '$claveGeneral' ";
        mysql_query($query);
    }

}
?>
