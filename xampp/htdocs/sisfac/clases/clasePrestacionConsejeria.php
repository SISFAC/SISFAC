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
class PrestacionConsejeria{
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }

    public function mostrarPrestacionConsejeriaDatagrid(){
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
        $query="SELECT COUNT(*) FROM prestacionConsejeria WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idprestacionConsejeria,claveGeneral,idcatalogoPrestacion,idepisodio,idpersona,idcatalogoUPS,nombreCatalogo,fechaInicio,fechaFin,estado FROM prestacionConsejeria WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";

        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarPrestacionConsejeriaVector($idcatalogoPrestacion,$idpersona,$idepisodio,$claveGeneral){
        $query = "SELECT idprestacionConsejeria,claveGeneral,idcatalogoPrestacion,idepisodio,idpersona,idcatalogoUPS,nombreCatalogo,DATE_FORMAT(fechaInicio,'%d/%m/%Y') as fechaInicio,DATE_FORMAT(fechaFin,'%d/%m/%Y') fechaFin,estado FROM prestacionConsejeria WHERE idcatalogoPrestacion = $idcatalogoPrestacion AND idpersona = $idpersona AND idepisodio = $idepisodio AND claveGeneral = '$claveGeneral'";
        $row = mysql_fetch_array(mysql_query($query));
        return $row['idprestacionConsejeria'].'+'.$row['claveGeneral'].'+'.$row['idcatalogoPrestacion'].'+'.$row['idepisodio'].'+'.$row['idpersona'].'+'.$row['idcatalogoUPS'].'+'.$row['nombreCatalogo'].'+'.$row['fechaInicio'].'+'.$row['fechaFin'].'+'.$row['estado'];
    }

    public function mostrarPrestacionConsejeriaCombobox($select){
        $query = "SELECT idprestacionConsejeria,claveGeneral,idcatalogoPrestacion,idepisodio,idpersona,idcatalogoUPS,nombreCatalogo,fechaInicio,fechaFin,estado FROM prestacionConsejeria WHERE 1=1 $wh";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarPrestacionConsejeria($idprestacionConsejeria,$claveGeneral,$idcatalogoPrestacion,$idepisodio,$idpersona,$idcatalogoUPS,$nombreCatalogo,$fechaInicio,$fechaFin,$estado){
        $data = verificarDatos('add', array('idprestacionConsejeria'=>$idprestacionConsejeria,'claveGeneral'=>$claveGeneral,'idcatalogoPrestacion'=>$idcatalogoPrestacion,'idepisodio'=>$idepisodio,'idpersona'=>$idpersona,'idcatalogoUPS'=>$idcatalogoUPS,'nombreCatalogo'=>$nombreCatalogo,'fechaInicio'=>$fechaInicio,'fechaFin'=>$fechaFin,'estado'=>$estado));
        if($data[0]!=''){
            $query = "INSERT INTO prestacionConsejeria($data[0]) VALUES($data[1])";
            mysql_query($query);
        }
    }
    
    public function actualizarPrestacionConsejeria($idprestacionConsejeria,$claveGeneral,$idcatalogoPrestacion,$idepisodio,$idpersona,$idcatalogoUPS,$nombreCatalogo,$fechaInicio,$fechaFin,$estado){
        $data = verificarDatos('edit', array('idprestacionConsejeria'=>$idprestacionConsejeria,'claveGeneral'=>$claveGeneral,'idcatalogoPrestacion'=>$idcatalogoPrestacion,'idepisodio'=>$idepisodio,'idpersona'=>$idpersona,'idcatalogoUPS'=>$idcatalogoUPS,'nombreCatalogo'=>$nombreCatalogo,'fechaInicio'=>$fechaInicio,'fechaFin'=>$fechaFin,'estado'=>$estado)); 
        if($data[0]!=''){
            $query = "UPDATE prestacionConsejeria SET $data[0] WHERE idcatalogoPrestacion = $idcatalogoPrestacion AND idpersona = $idpersona AND idepisodio = $idepisodio AND claveGeneral = '$claveGeneral'";
            mysql_query($query);
        }
    }
    
    public function eliminarPrestacionConsejeria($idprestacionConsejeria,$claveGeneral){
        $query = "DELETE FROM prestacionConsejeria WHERE idprestacionConsejeria = '$idprestacionConsejeria' AND claveGeneral = '$claveGeneral' ";
        mysql_query($query);
    }

}
?>
