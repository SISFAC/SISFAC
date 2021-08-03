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
class DetalleConsejeria{
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }

    public function mostrarDetalleConsejeriaDatagrid($idprestacionConsejeria, $claveGeneral){
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
        
        if($idprestacionConsejeria!='') $wh.=" AND idprestacionConsejeria = $idprestacionConsejeria";
        if($claveGeneral!='') $wh.=" AND claveGeneral = '$claveGeneral'";
        
        $query="SELECT COUNT(*) FROM detalleConsejeria WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT iddetalleConsejeria,claveGeneral,idprestacionConsejeria,idcatalogoConsejeria,nombreCatalogo,nroSesion,tema FROM detalleConsejeria WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";

        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarDetalleConsejeriaVector($iddetalleConsejeria,$claveGeneral){
        $query = "SELECT iddetalleConsejeria,claveGeneral,idprestacionConsejeria,idcatalogoConsejeria,nombreCatalogo,nroSesion,tema FROM detalleConsejeria WHERE iddetalleConsejeria = '$iddetalleConsejeria' AND claveGeneral = '$claveGeneral'  ";
        $row = mysql_fetch_array(mysql_query($query));
        return $row['iddetalleConsejeria'].'+'.$row['claveGeneral'].'+'.$row['idprestacionConsejeria'].'+'.$row['idcatalogoConsejeria'].'+'.$row['nombreCatalogo'].'+'.$row['nroSesion'].'+'.$row['tema'];
    }

    public function mostrarDetalleConsejeriaCombobox($select){
        $query = "SELECT iddetalleConsejeria,claveGeneral,idprestacionConsejeria,idcatalogoConsejeria,nombreCatalogo,nroSesion,tema FROM detalleConsejeria WHERE 1=1 $wh";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarDetalleConsejeria($iddetalleConsejeria,$claveGeneral,$idprestacionConsejeria,$idcatalogoConsejeria,$nombreCatalogo,$nroSesion,$tema){
        $data = verificarDatos('add', array('iddetalleConsejeria'=>$iddetalleConsejeria,'claveGeneral'=>$claveGeneral,'idprestacionConsejeria'=>$idprestacionConsejeria,'idcatalogoConsejeria'=>$idcatalogoConsejeria,'nombreCatalogo'=>$nombreCatalogo,'nroSesion'=>$nroSesion,'tema'=>$tema));
        if($data[0]!=''){
            $query = "INSERT INTO detalleConsejeria($data[0]) VALUES($data[1])";
            mysql_query($query);
        }
    }
    
    public function actualizarDetalleConsejeria($iddetalleConsejeria,$claveGeneral,$idprestacionConsejeria,$idcatalogoConsejeria,$nombreCatalogo,$nroSesion,$tema){
        $data = verificarDatos('edit', array('iddetalleConsejeria'=>$iddetalleConsejeria,'claveGeneral'=>$claveGeneral,'idprestacionConsejeria'=>$idprestacionConsejeria,'idcatalogoConsejeria'=>$idcatalogoConsejeria,'nombreCatalogo'=>$nombreCatalogo,'nroSesion'=>$nroSesion,'tema'=>$tema)); 
        if($data[0]!=''){
            $query = "UPDATE detalleConsejeria SET $data[0] WHERE iddetalleConsejeria = '$iddetalleConsejeria' AND claveGeneral = '$claveGeneral' ";
            mysql_query($query);
        }
    }
    
    public function eliminarDetalleConsejeria($iddetalleConsejeria,$claveGeneral){
        $query = "DELETE FROM detalleConsejeria WHERE iddetalleConsejeria = '$iddetalleConsejeria' AND claveGeneral = '$claveGeneral' ";
        mysql_query($query);
    }

}
?>
