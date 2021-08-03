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
class Paifam {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }


    public function mostrarFamiliaDatagrid($activo, $fechaInicio, $fechaFin){
        $limit = $_REQUEST['rows'];
        $page = $_REQUEST['page'];
     
        $sord = $_REQUEST['sord'];
        if(!$sidx) $sidx =1;
        $wh = "";
        $searchOn = Strip($_REQUEST['_search']);
        if($searchOn=='true') {
            $sarr = Strip($_REQUEST);
            foreach( $sarr as $k=>$v) {
                switch ($k) {
                    case 'codigoFicha':
                    case 'nombreFamilia':
                    case 'registrador':
                    case 'trabajador':
                        $wh .= " AND $k LIKE '%$v%'";
                        break;
                }
            }
        }
        
     
        if($activo != '') $wh.=" AND activo = '$activo'";
        
        $query="SELECT COUNT(*) FROM familia WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT CONCAT_WS(',',f.claveGeneral,f.idfamilia) id,f.idfamilia, f.fechaModificacion, f.idsector, f.nombreSector, f.codigoFicha, f.fechaApertura, f.nombreFamilia, f.registrador, f.idtrabajador ,f.claveGeneral
                FROM familia f left outer join trabajador t on(t.idtrabajador=f.idtrabajador and t.clavegeneral=f.clavegeneral) WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";
      
        obtenerXML($page, $count, $total_pages, $query);
    }
 
    
}
?>