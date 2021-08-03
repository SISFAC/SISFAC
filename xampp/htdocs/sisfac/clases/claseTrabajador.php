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
class Trabajador {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function mostrarTrabajadorDatagrid($idestablecimiento){
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
                    case 'dni':
                    case 'fechanacimiento':
                        $wh .= " AND $k LIKE '%$v%'";
                        break;
                    case 'estado':
                    case 'sexo':
                        $wh .= " AND $k = '$v'";
                        break;
                }
            }
        }
        
        $wh.=" AND tra.claveGeneral = '$_SESSION[claveGeneral]'";
        if($idestablecimiento!='') $wh.=" AND est.idestablecimiento = $idestablecimiento";
        
        $query="SELECT COUNT(*) FROM trabajador tra INNER JOIN establecimiento est ON est.idestablecimiento = tra.idestablecimiento AND est.claveGeneral =tra.claveGeneral INNER JOIN profesion pro ON tra.idprofesion = pro.idprofesion
                WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT CONCAT_WS('-',tra.idtrabajador) as id, tra.idtrabajador, '' as idtrabajadorSector, '' as idsector,est.idestablecimiento, est.nombreEstablecimiento,nombreCompleto, pro.nombre, grupoProfesional, '' as s, 'Doble click para ingresar sectores' as op
                FROM trabajador tra INNER JOIN establecimiento est ON est.idestablecimiento = tra.idestablecimiento AND est.claveGeneral =tra.claveGeneral LEFT JOIN profesion pro ON tra.idprofesion = pro.idprofesion
                WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";
        //echo $query;
        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarTrabajadorUsuarioDatagrid($idestablecimiento){
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
                    case 'dni':
                    case 'fechanacimiento':
                        $wh .= " AND $k LIKE '%$v%'";
                        break;
                    case 'estado':
                    case 'sexo':
                        $wh .= " AND $k = '$v'";
                        break;
                }
            }
        }
        
        $wh.=" AND tra.claveGeneral = '$_SESSION[claveGeneral]'";
        if($idestablecimiento!='') $wh.=" AND est.idestablecimiento = $idestablecimiento";
        
        $query="SELECT COUNT(*) FROM trabajador tra LEFT JOIN catalogoColegio cco ON tra.idcatalogoColegio=cco.idcatalogoColegio 
                LEFT JOIN profesion prf ON tra.idprofesion=prf.idprofesion LEFT JOIN condicionTrabajador ctr ON ctr.idCondicionTrabajador=tra.idCondicionTrabajador
                LEFT JOIN establecimiento est ON est.idestablecimiento = tra.idestablecimiento AND est.claveGeneral = tra.claveGeneral
                LEFT JOIN nucleo nuc ON nuc.idnucleo = est.idnucleo LEFT JOIN microred mic ON mic.idmicrored = nuc.idmicrored 
                LEFT JOIN red ON red.idred = mic.idred LEFT JOIN diresa dir ON dir.iddiresa = red.iddiresa 
                WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT DISTINCT tra.idtrabajador, dir.iddiresa, red.idred, mic.idmicrored, nuc.idnucleo, est.idestablecimiento, dir.nombreDiresa, red.nombreRed, mic.nombreMicrored, nuc.nombreNucleo, 
                est.nombreEstablecimiento,nombreCompleto, grupoProfesional, '', 'Doble click para ingresar sectores' as op, cco.codigoColegio, cco.nombre, prf.idprofesion, prf.nombre, ctr.idCondicionTrabajador, ctr.nombre, tra.opcionDocumento, tra.nroDocumento, tra.nroColegiatura
                FROM trabajador tra LEFT JOIN catalogoColegio cco ON tra.idcatalogoColegio=cco.idcatalogoColegio 
                LEFT JOIN profesion prf ON tra.idprofesion=prf.idprofesion LEFT JOIN condicionTrabajador ctr ON ctr.idCondicionTrabajador=tra.idCondicionTrabajador
                LEFT JOIN establecimiento est ON est.idestablecimiento = tra.idestablecimiento AND est.claveGeneral = tra.claveGeneral
                LEFT JOIN nucleo nuc ON nuc.idnucleo = est.idnucleo LEFT JOIN microred mic ON mic.idmicrored = nuc.idmicrored 
                LEFT JOIN red ON red.idred = mic.idred LEFT JOIN diresa dir ON dir.iddiresa = red.iddiresa 
                WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";
        //echo $query;
        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarTrabajadorCombobox($idestablecimiento, $select){
        $wh.=" AND claveGeneral = '$_SESSION[claveGeneral]'";
        if($idestablecimiento!='') $wh = " AND idestablecimiento = $idestablecimiento";
        $query = "SELECT idtrabajador, nombreCompleto FROM trabajador WHERE 1 = 1 $wh";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarTrabajador($claveGeneral,$idtrabajador,$idestablecimiento, $nombreCompleto, $grupoProfesional, $opcionDocumento, $nroDocumento, $nroColegiatura, $idcatalogoColegio, $idcondicionTrabajador, $idprofesion){
        $data = verificarDatos('add', array('claveGeneral'=>$claveGeneral,'idtrabajador'=>$idtrabajador,'idestablecimiento'=>$idestablecimiento, 'nombreCompleto'=>$nombreCompleto,'grupoProfesional'=>$grupoProfesional,'opcionDocumento'=>$opcionDocumento, 'nroColegiatura'=>$nroColegiatura, 'nroDocumento'=>$nroDocumento, 'idcatalogoColegio'=>$idcatalogoColegio, 'idcondicionTrabajador'=>$idcondicionTrabajador, 'idprofesion'=>$idprofesion));
        if($data[0]!=''){
            $query = "INSERT INTO trabajador($data[0]) VALUES($data[1])";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function actualizarTrabajador($claveGeneral,$idtrabajador, $idestablecimiento, $nombreCompleto, $grupoProfesional, $opcionDocumento, $nroDocumento, $nroColegiatura, $idcatalogoColegio,$idcondicionTrabajador, $idprofesion){
        $data = verificarDatos('update', array('idestablecimiento'=>$idestablecimiento, 'nombreCompleto'=>$nombreCompleto,'grupoProfesional'=>$grupoProfesional, 'opcionDocumento'=>$opcionDocumento, 'nroColegiatura'=>$nroColegiatura, 'nroDocumento'=>$nroDocumento, 'idcatalogoColegio'=>$idcatalogoColegio, 'idcondicionTrabajador'=>$idcondicionTrabajador, 'idprofesion'=>$idprofesion));
        if($data[0]!=''){
            $query = "UPDATE trabajador SET $data[0] WHERE idtrabajador = $idtrabajador AND claveGeneral = '$claveGeneral'";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function eliminarTrabajador($idtrabajador,$claveGeneral){
        $query = "DELETE FROM trabajador WHERE idtrabajador = $idtrabajador AND claveGeneral = '$claveGeneral'";
        mysql_query($query);
    }
    
    
}
?>