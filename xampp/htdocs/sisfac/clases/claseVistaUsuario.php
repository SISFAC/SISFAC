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

class VistaUsuario {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function mostrarVistaUsuarioDatagrid($idusuario){
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
                    case 'nombre':
                    case 'tipocambio':
                        $wh .= " AND $k LIKE '%$v%'";
                        break;
                    case 'mesas':
                        $wh .= " AND $k = $v";
                        break;
                }
            }
        }
        
        $wh .= " AND vu.claveGeneral = '$_SESSION[claveGeneral]'";
        
        $query="SELECT COUNT(*) FROM vistausuario vu INNER JOIN vista v ON vu.idvista=v.idvista AND vu.claveGeneral = v.claveGeneral WHERE idusuario=$idusuario $wh";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT vu.idvistausuario,vu.idusuario,v.idvista,v.vista,vu.privilegios
                FROM vistausuario vu INNER JOIN vista v ON vu.idvista=v.idvista AND vu.claveGeneral = v.claveGeneral
                WHERE idusuario=$idusuario $wh ORDER BY $sidx $sord LIMIT $limit OFFSET $start";
        obtenerXML($page, $count, $total_pages, $query);
    }
    
    function agregarVistaUsuario($claveGeneral,$idvistausuario, $idusuario,$idvista,$privilegios){
        $query = "INSERT INTO vistausuario(claveGeneral,idvistausuario, idusuario,idvista,privilegios) VALUES('$claveGeneral',$idvistausuario,$idusuario,$idvista,'$privilegios')";
        mysql_query($query);
    }
    
    function actualizarVistaUsuario($claveGeneral, $idvistausuario,$idusuario,$idvista,$privilegios){
        $query = "UPDATE vistausuario SET idusuario=$idusuario,idvista=$idvista,privilegios='$privilegios' WHERE idvistausuario=$idvistausuario AND claveGeneral = '$claveGeneral'";
        mysql_query($query);
    }
    
    function elimianrVistaUsuario($claveGeneral, $idusuario){
        $query = "DELETE FROM vistausuario WHERE idusuario = $idusuario AND claveGeneral = '$claveGeneral'";
        mysql_query($query);
        echo $query;
    }
    
}

?>
