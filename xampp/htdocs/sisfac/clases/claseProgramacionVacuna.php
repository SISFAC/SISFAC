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
class ProgramacionVacuna{
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }

    public function mostrarProgramacionVacunaDatagrid(){
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
        $query="SELECT COUNT(*) FROM programacionVacuna WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idprogramacionVacuna,idcatalogoVacuna,nombreDosis,opProgramacion,limiteInicial,factor,detalleProgramacion FROM programacionVacuna WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";

        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarProgramacionVacunaVector($idcatalogoVacuna,$nombreDosis, $opc){
        if($nombreDosis!='') $wh .= " AND nombreDosis = '$nombreDosis'";
        $query = "SELECT idprogramacionVacuna,idcatalogoVacuna,nombreDosis,opProgramacion,limiteInicial,factor,detalleProgramacion FROM programacionVacuna WHERE idcatalogoVacuna = '$idcatalogoVacuna'  $wh";
        if($opc == true) return mysql_query($query);
        else{
            $row = mysql_fetch_array(mysql_query($query));
            return $row['idprogramacionVacuna'].'+'.$row['idcatalogoVacuna'].'+'.$row['nombreDosis'].'+'.$row['opProgramacion'].'+'.$row['limiteInicial'].'+'.$row['factor'].'+'.$row['detalleProgramacion'];
        }
    }

    public function mostrarProgramacionVacunaCombobox($select){
        $query = "SELECT idprogramacionVacuna,idcatalogoVacuna,nombreDosis,opProgramacion,limiteInicial,factor,detalleProgramacion FROM programacionVacuna WHERE 1=1 $wh";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarProgramacionVacuna($idprogramacionVacuna,$idcatalogoVacuna,$nombreDosis,$opProgramacion,$limiteInicial,$factor,$detalleProgramacion){
        $data = verificarDatos('add', array('idprogramacionVacuna'=>$idprogramacionVacuna,'idcatalogoVacuna'=>$idcatalogoVacuna,'nombreDosis'=>$nombreDosis,'opProgramacion'=>$opProgramacion,'limiteInicial'=>$limiteInicial,'factor'=>$factor,'detalleProgramacion'=>$detalleProgramacion));
        if($data[0]!=''){
            $query = "INSERT INTO programacionVacuna($data[0]) VALUES($data[1])";
            mysql_query($query);
        }
    }
    
    public function actualizarProgramacionVacuna($idprogramacionVacuna,$idcatalogoVacuna,$nombreDosis,$opProgramacion,$limiteInicial,$factor,$detalleProgramacion){
        $data = verificarDatos('edit', array('idprogramacionVacuna'=>$idprogramacionVacuna,'idcatalogoVacuna'=>$idcatalogoVacuna,'nombreDosis'=>$nombreDosis,'opProgramacion'=>$opProgramacion,'limiteInicial'=>$limiteInicial,'factor'=>$factor,'detalleProgramacion'=>$detalleProgramacion)); 
        if($data[0]!=''){
            $query = "UPDATE programacionVacuna SET $data[0] WHERE idprogramacionVacuna = '$idprogramacionVacuna' ";
            mysql_query($query);
        }
    }
    
    public function eliminarProgramacionVacuna($idprogramacionVacuna){
        $query = "DELETE FROM programacionVacuna WHERE idprogramacionVacuna = '$idprogramacionVacuna' ";
        mysql_query($query);
    }

}
?>
