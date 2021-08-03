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
class CatalogoExamenLaboratorio{
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }

    public function mostrarCatalogoExamenLaboratorioDatagrid(){
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
        $query="SELECT COUNT(*) FROM catalogoExamenLaboratorio WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idcatalogoExamenLaboratorio,idcatalogoPerfilLaboratorio,tipoExamen,nombreExamenLaboratorio,unidades,rangosNormales,opExamen FROM catalogoExamenLaboratorio WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";

        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarCatalogoExamenLaboratorioVector($idcatalogoExamenLaboratorio){
        $query = "SELECT idcatalogoExamenLaboratorio,idcatalogoPerfilLaboratorio,tipoExamen,nombreExamenLaboratorio,unidades,rangosNormales,opExamen FROM catalogoExamenLaboratorio WHERE idcatalogoExamenLaboratorio = '$idcatalogoExamenLaboratorio'  ";
        $row = mysql_fetch_array(mysql_query($query));
        return $row['idcatalogoExamenLaboratorio'].'+'.$row['idcatalogoPerfilLaboratorio'].'+'.$row['tipoExamen'].'+'.$row['nombreExamenLaboratorio'].'+'.$row['unidades'].'+'.$row['rangosNormales'].'+'.$row['opExamen'];
    }

    public function mostrarCatalogoExamenLaboratorioCombobox($select){
        $query = "SELECT idcatalogoExamenLaboratorio,idcatalogoPerfilLaboratorio,tipoExamen,nombreExamenLaboratorio,unidades,rangosNormales,opExamen FROM catalogoExamenLaboratorio WHERE 1=1 $wh";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarCatalogoExamenLaboratorio($idcatalogoExamenLaboratorio,$idcatalogoPerfilLaboratorio,$tipoExamen,$nombreExamenLaboratorio,$unidades,$rangosNormales,$opExamen){
        $data = verificarDatos('add', array('idcatalogoExamenLaboratorio'=>$idcatalogoExamenLaboratorio,'idcatalogoPerfilLaboratorio'=>$idcatalogoPerfilLaboratorio,'tipoExamen'=>$tipoExamen,'nombreExamenLaboratorio'=>$nombreExamenLaboratorio,'unidades'=>$unidades,'rangosNormales'=>$rangosNormales,'opExamen'=>$opExamen));
        if($data[0]!=''){
            $query = "INSERT INTO catalogoExamenLaboratorio($data[0]) VALUES($data[1])";
            mysql_query($query);
        }
    }
    
    public function actualizarCatalogoExamenLaboratorio($idcatalogoExamenLaboratorio,$idcatalogoPerfilLaboratorio,$tipoExamen,$nombreExamenLaboratorio,$unidades,$rangosNormales,$opExamen){
        $data = verificarDatos('edit', array('idcatalogoExamenLaboratorio'=>$idcatalogoExamenLaboratorio,'idcatalogoPerfilLaboratorio'=>$idcatalogoPerfilLaboratorio,'tipoExamen'=>$tipoExamen,'nombreExamenLaboratorio'=>$nombreExamenLaboratorio,'unidades'=>$unidades,'rangosNormales'=>$rangosNormales,'opExamen'=>$opExamen)); 
        if($data[0]!=''){
            $query = "UPDATE catalogoExamenLaboratorio SET $data[0] WHERE idcatalogoExamenLaboratorio = '$idcatalogoExamenLaboratorio' ";
            mysql_query($query);
        }
    }
    
    public function eliminarCatalogoExamenLaboratorio($idcatalogoExamenLaboratorio){
        $query = "DELETE FROM catalogoExamenLaboratorio WHERE idcatalogoExamenLaboratorio = '$idcatalogoExamenLaboratorio' ";
        mysql_query($query);
    }

}
?>
