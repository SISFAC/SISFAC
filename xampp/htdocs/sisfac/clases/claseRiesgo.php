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
class Riesgo {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function mostrarRiesgoDatagrid(){
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
        
        $query="SELECT COUNT(*) FROM  WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT  FROM  WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";
        obtenerXML($page, $count, $total_pages, $query);
    }
    
    
   public function agregarRiesgo($claveGeneral, $idriesgo, $idpersona, $idfamilia, $etapa, $nombreRiesgo, $codriesgo, $puntaje){
       $data=verificarDatos( 'add', array('claveGeneral'=>$claveGeneral, 'idriesgo'=>$idriesgo, 'idpersona'=>$idpersona, 'idfamilia'=>$idfamilia, 'etapa'=>$etapa, 'fecha'=>$fecha, 'nombreRiesgo'=>$nombreRiesgo,'codriesgo'=>$codriesgo,'puntaje'=>$puntaje)); 
	if($data[0]!=''){
            $query = "INSERT INTO riesgo($data[0]) VALUES($data[1])";
            mysql_query($query);
            echo $query;
        }
   }
   
   public function eliminarRiesgo($codriesgo,$idpersona,$idfamilia,$claveGeneral){
       $wh.= " AND claveGeneral = '$claveGeneral'";
       if($idpersona!='') $wh.= " AND idpersona = $idpersona";
       if($idfamilia!='') $wh.= " AND idfamilia = $idfamilia";
       $query = "DELETE FROM riesgo WHERE codriesgo = '$codriesgo' $wh";
       mysql_query($query);
   }
   
   public function obtenerRiesgoVector($claveGeneral,$idfamilia,$idpersona){
       $wh.= " AND claveGeneral = '$claveGeneral'";
       $temp = array(0);
       if($idfamilia!='') $wh.= " AND idfamilia = $idfamilia";
       if($idpersona!='') $wh.= " AND idpersona = $idpersona";
       $query = "SELECT codriesgo FROM riesgo WHERE 1=1 $wh ORDER BY 1";
       //echo $query;
       $result = mysql_query($query);
       while ($row = mysql_fetch_row($result)) {
           $temp[] = $row[0];
       }
       echo implode('-', $temp);
   }
   
   public function obtenerRiesgoGestante($claveGeneral,$idfamilia,$idpersona){
       $wh.= " AND claveGeneral = '$claveGeneral'";
       if($idfamilia!='') $wh.= " AND idfamilia = $idfamilia";
       if($idpersona!='') $wh.= " AND idpersona = $idpersona";
       $query = "SELECT COUNT(*) FROM condicion WHERE nombreCondicion = 'GESTANTE' $wh";
       $row = mysql_fetch_array(mysql_query($query));
       echo $row[0];
   }
   
   public function obtenerRiesgo($codriesgo, $idpersona, $idfamilia){
       $wh.= " AND claveGeneral = '$_SESSION[claveGeneral]'";
       if($codriesgo!='') $wh.= " AND codriesgo = $codriesgo";
       if($idpersona!='') $wh.= " AND idpersona = $idpersona";
       if($idfamilia!='') $wh.= " AND idfamilia = $idfamilia";
       $query = "SELECT COUNT(*) FROM riesgo WHERE 1=1 $wh";
       $row = mysql_fetch_array(mysql_query($query));
       return $row[0];
   }
}
?>

