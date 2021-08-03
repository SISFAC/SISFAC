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
class Visita {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function mostrarVisitaDatagrid($idfamilia, $claveGeneral){
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
        
        //$wh .=" AND vi.claveGeneral = '$_SESSION[claveGeneral]'"; 
        $wh .=" AND vi.claveGeneral = '$claveGeneral'"; 
        if($idfamilia!='') $wh .=" AND vi.idfamilia = $idfamilia"; 
        
        $query="SELECT COUNT(*) FROM visita vi INNER JOIN trabajador tr ON vi.idtrabajador=tr.idtrabajador AND vi.claveGeneral=tr.claveGeneral WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT vi.idvisita, vi.idfamilia, vi.fechavisita, vi.idtrabajador, tr.nombreCompleto, resultado, fechacita, estadoCita, motivo
                FROM visita vi INNER JOIN trabajador tr ON vi.idtrabajador=tr.idtrabajador AND vi.claveGeneral =tr.claveGeneral
                WHERE 1 = 1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";
        //echo $query;
        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function agregarVisita($claveGeneral, $idvisita, $idfamilia, $idtrabajador, $fechavisita, $resultado, $fechacita, $estadoCita){
        $data = verificarDatos('add', array('claveGeneral'=>$claveGeneral, 'idvisita'=>$idvisita, 'idfamilia'=>$idfamilia, 'idtrabajador'=>$idtrabajador, 'fechavisita'=>$fechavisita,'resultado'=>$resultado,'fechacita'=>$fechacita, 'estadoCita'=>$estadoCita));
        if($data[0]!=''){
            $query = "INSERT INTO visita($data[0]) VALUES($data[1])";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function actualizarVisita($claveGeneral, $idvisita, $idfamilia, $idtrabajador, $fechavisita, $resultado, $fechacita, $estadoCita, $motivo){
        $data = verificarDatos('edit', array('idfamilia'=>$idfamilia, 'idtrabajador'=>$idtrabajador, 'fechavisita'=>$fechavisita,'resultado'=>$resultado,'fechacita'=>$fechacita, 'estadoCita'=>$estadoCita, 'motivo'=>$motivo));
        if($data[0]!=''){
            $query = "UPDATE visita SET $data[0] WHERE idvisita = $idvisita AND claveGeneral='$claveGeneral'";
            mysql_query($query);
            echo $query;
        }
    }
    public function actualizarVisitaGeneral($claveGeneral){
        $fecha = date('Y-m-d');
        $query = "UPDATE visita SET estadoCita='NO CUMPLIO' WHERE DATEDIFF(fechaCita,'$fecha') <= -1 AND claveGeneral = '$claveGeneral' AND 
                    estadoCita='PENDIENTE'";
        //echo $query;
        mysql_query($query);
    }
    
    public function eliminarVisita($idvisita,$claveGeneral){
        $query = "DELETE FROM visita WHERE idvisita = $idvisita AND claveGeneral='$claveGeneral'";
        mysql_query($query);
    }
    
    public function obtenerMaximaVisita(){
        $query = "SELECT MAX(idvisita) FROM visita";
        $row = mysql_fetch_array(mysql_query($query));
        return $row[0];
    }
    
    public function mostrarVisitaAlerta(){
        $fecha = date('Y-m-d');
        $query = "SELECT DATE_FORMAT(fechaCita,'%d/%m/%Y') as fec
            ,CONCAT_WS(' ','Hoy se tiene que visitar a la familia ', nombreFamilia,' - ',DATE_FORMAT(fechaCita,'%d/%m/%Y') ) as data1
            ,CONCAT_WS(' ','Se acerca la fecha para visitar a la familia ', nombreFamilia,' el d&iacute;a ',DATE_FORMAT(fechaCita,'%d/%m/%Y') ) as data2
            ,DATEDIFF(fechaCita,'$fecha') as dias
            FROM familiaH famh INNER JOIN visitaH vih ON famh.idfamiliaH=vih.idfamiliaH AND famh.claveGeneral = vih.claveGeneral
            WHERE famh.activo = 'AC' AND DATE_FORMAT(fechaCita,'%m') = DATE_FORMAT('$fecha','%m')
            AND (DATE_FORMAT(fechaCita,'%d')-DATE_FORMAT('$fecha','%d')) BETWEEN 0 AND 3 AND famh.claveGeneral = '$_SESSION[claveGeneral]' AND vih.estadoCita='PENDIENTE'";//MUESTRA LA ALERTA A 2 DIAS DE SU FECHA NACIMIENTO
        $result=  mysql_query($query);
        //echo $query;
        while ($row = mysql_fetch_array($result)) {
            $temp = ($row[3]==0?$row[1]:$row[2]);
            $mensaje .= "
                jQuery.pnotify({
                    pnotify_title: 'Visitas familiares pendientes',
                    pnotify_text: '$temp',
                    pnotify_animation: 'show',
                    pnotify_notice_icon: 'ui-icon ui-icon-mail-closed',
                    pnotify_addclass: 'stack-bottomright',
                    pnotify_stack: posicionAlerta
                });
                ";
        }
        return $mensaje;
    }
    
    public function mostrarVisitaNoCumplioAlerta(){
        $query = "SELECT DATE_FORMAT(fechaCita,'%d/%m/%Y') as fec ,CONCAT_WS(' ','No se visito a la familia ', nombreFamilia,' el d&iacute;a ',DATE_FORMAT(fechaCita,'%d/%m/%Y') ) as 
                    data1,DATEDIFF(fechaCita,'2013-07-14') as dias
                    FROM familia fam INNER JOIN visita vi ON fam.idfamilia=vi.idfamilia AND fam.claveGeneral = vi.claveGeneral
                    WHERE fam.activo = 'AC' AND fam.claveGeneral = '$_SESSION[claveGeneral]' AND estadoCita='NO CUMPLIO'";
        $result=  mysql_query($query);
        //echo $query;
        while ($row = mysql_fetch_array($result)) {
            $temp = $row[1];
            $mensaje .= "
                jQuery.pnotify({
                    pnotify_title: 'Visitas familiares no cumplidas',
                    pnotify_text: '$temp',
                    pnotify_type: 'error',
                    pnotify_animation: 'show',
                    pnotify_notice_icon: 'ui-icon ui-icon-mail-closed',
                    pnotify_addclass: 'stack-bottomright',
                    pnotify_stack: posicionAlerta
                });
                ";
        }
        return $mensaje;
    }
}
?>