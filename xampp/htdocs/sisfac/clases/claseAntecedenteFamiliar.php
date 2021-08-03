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
class AntecedenteFamiliar {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function mostrarAntecedenteFamiliarDatagrid($idpersona, $claveGeneral, $opc, $_REQUEST){
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
        
        //echo $opc;
        if($opc==1) $wh .=" AND tipo = 'FAMILIAR'";
        else $wh .=" AND tipo <> 'FAMILIAR'";
        
        $query="SELECT COUNT(*) FROM antecedenteFamiliar WHERE 1=1 $wh ";
        //echo $query;
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idantecedenteFamiliar, tipo, parentesco, opcionPatologia, idcatalogoCIE10, nombreCIE10, fuente,  observacion, descripcion
                FROM antecedenteFamiliar WHERE idpersona = $idpersona AND claveGeneral = '$claveGeneral' $wh ORDER BY $sidx $sord LIMIT $start,$limit";
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
    
    public function agregarAntecedenteFamiliar($idantecedenteFamiliar, $claveGeneral, $idpersona, $tipo, $parentesco, $opcionPatologia, $idcatalogoCIE10, $nombreCIE10, $fuente, $descripcion, $observacion){
        $data = verificarDatos('add', array('idantecedenteFamiliar'=>$idantecedenteFamiliar, 'claveGeneral'=>$claveGeneral, 'idpersona'=>$idpersona, 'tipo'=>$tipo, 'parentesco'=>$parentesco, 'opcionPatologia'=>$opcionPatologia, 'idcatalogoCIE10'=>$idcatalogoCIE10, 'nombreCIE10'=>$nombreCIE10, 'fuente'=>$fuente, 'descripcion'=>$descripcion, 'observacion'=>$observacion));
        if($data[0]!=''){
            $query = "INSERT INTO antecedenteFamiliar($data[0]) VALUES($data[1])";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function actualizarAntecedenteFamiliar($idantecedenteFamiliar, $claveGeneral, $idpersona, $tipo, $parentesco, $opcionPatologia, $idcatalogoCIE10, $nombreCIE10, $fuente, $descripcion, $observacion){
        $data = verificarDatos('edit', array('idantecedenteFamiliar'=>$idantecedenteFamiliar, 'claveGeneral'=>$claveGeneral, 'idpersona'=>$idpersona, 'tipo'=>$tipo, 'parentesco'=>$parentesco, 'opcionPatologia'=>$opcionPatologia, 'idcatalogoCIE10'=>$idcatalogoCIE10, 'nombreCIE10'=>$nombreCIE10, 'fuente'=>$fuente, 'descripcion'=>$descripcion, 'observacion'=>$observacion));
        if($data[0]!=''){
            $query = "UPDATE antecedenteFamiliar SET $data[0] WHERE idantecedenteFamiliar = $idantecedenteFamiliar AND claveGeneral = '$claveGeneral'";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function eliminarAntecedenteFamiliar($id, $claveGeneral){
        $query = "DELETE FROM antecedenteFamiliar WHERE idantecedenteFamiliar = $idantecedenteFamiliar AND claveGeneral = '$claveGeneral'";
        mysql_query($query);
    }
}
?>