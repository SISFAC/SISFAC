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
class CatalogoConsejeria{
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }

    public function mostrarCatalogoConsejeriaDatagrid(){
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
        $query="SELECT COUNT(*) FROM catalogoConsejeria WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idcatalogoConsejeria,nombreConsejeria,codigoCPT FROM catalogoConsejeria WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";

        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarCatalogoConsejeriaVector($idcatalogoConsejeria){
        $query = "SELECT idcatalogoConsejeria,nombreConsejeria,codigoCPT FROM catalogoConsejeria WHERE idcatalogoConsejeria = '$idcatalogoConsejeria'  ";
        $row = mysql_fetch_array(mysql_query($query));
        return $row['idcatalogoConsejeria'].'+'.$row['nombreConsejeria'].'+'.$row['codigoCPT'];
    }

    public function mostrarCatalogoConsejeriaCombobox($select){
        $query = "SELECT idcatalogoConsejeria,nombreConsejeria,codigoCPT FROM catalogoConsejeria WHERE 1=1 $wh";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]' cpt = '$row[2]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarCatalogoConsejeria($idcatalogoConsejeria,$nombreConsejeria,$codigoCPT){
        $data = verificarDatos('add', array('idcatalogoConsejeria'=>$idcatalogoConsejeria,'nombreConsejeria'=>$nombreConsejeria,'codigoCPT'=>$codigoCPT));
        if($data[0]!=''){
            $query = "INSERT INTO catalogoConsejeria($data[0]) VALUES($data[1])";
            mysql_query($query);
        }
    }
    
    public function actualizarCatalogoConsejeria($idcatalogoConsejeria,$nombreConsejeria,$codigoCPT){
        $data = verificarDatos('edit', array('idcatalogoConsejeria'=>$idcatalogoConsejeria,'nombreConsejeria'=>$nombreConsejeria,'codigoCPT'=>$codigoCPT)); 
        if($data[0]!=''){
            $query = "UPDATE catalogoConsejeria SET $data[0] WHERE idcatalogoConsejeria = '$idcatalogoConsejeria' ";
            mysql_query($query);
        }
    }
    
    public function eliminarCatalogoConsejeria($idcatalogoConsejeria){
        $query = "DELETE FROM catalogoConsejeria WHERE idcatalogoConsejeria = '$idcatalogoConsejeria' ";
        mysql_query($query);
    }

}
?>
