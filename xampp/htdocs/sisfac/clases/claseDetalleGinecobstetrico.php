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
class DetalleGinecobstetrico {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function mostrarDetalleGinecobstetricoDatagrid($idantecedenteGinecobstetrico, $idpersonaref, $op, $opcMadre, $_REQUEST){
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
        
        if($idantecedenteGinecobstetrico!= '') $wh .= " AND idantecedenteGinecobstetrico = $idantecedenteGinecobstetrico";
        else $wh .= " AND idantecedenteGinecobstetrico = 0";
        $wh .= " AND claveGeneral = '$_SESSION[claveGeneral]'";
        
        if($opcMadre=='M') $wh.="";
        elseif($idpersonaref!='' && $op == true) $wh.=" AND idpersonaref = $idpersonaref";
        else $wh.=" AND opcionRef = 'NO'";
        
        $query="SELECT COUNT(*) FROM detalleGinecobstetrico WHERE 1=1 $wh ";
        //echo $query;
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT iddetalleGinecobstetrico, fechaCulminacion, nroAtencionPrenatal, complicacion, fuente, opcionSuplemento, aborto, lugarParto, tipoParto, opHorVer, idcatalogoCIE10, nombreTipoParto, pesoRN, pr.idprofesion, pr.nombre
                FROM detalleGinecobstetrico dg LEFT JOIN profesion pr ON dg.idprofesion = pr.idprofesion 
                WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";
        //echo $query;
        obtenerXML($page, $count, $total_pages, $query);   
    }
    
    public function cuentaDetalleGinecobstetrico($idantecedenteGinecobstetrico, $idpersonaref){
        if($idantecedenteGinecobstetrico!= '') $wh .= " AND idantecedenteGinecobstetrico = $idantecedenteGinecobstetrico";
        else $wh .= " AND idantecedenteGinecobstetrico = 0";
        $wh .= " AND claveGeneral = '$_SESSION[claveGeneral]'";
        
        $row = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM detalleGinecobstetrico WHERE idpersonaref = $idpersonaref $wh")) ;
        
        //echo "SELECT COUNT(*) FROM detalleGinecobstetrico WHERE idpersonaref = $idpersonaref $wh";
        return $row[0];
    }
    
    public function agregarDetalleGinecobstetrico($iddetalleGinecobstetrico, $claveGeneral, $idantecedenteGinecobstetrico, $fechaCulminacion, $nroAtencionPrenatal, $complicacion, $fuente, $opcionSuplemento, $aborto, $lugarParto, $tipoParto, $opHorVer, $idcatalogoCIE10, $nombreTipoParto, $pesoRN, $idprofesion, $idpersonaref, $opcionRef){
        $data = verificarDatos('add', array('iddetalleGinecobstetrico'=>$iddetalleGinecobstetrico, 'claveGeneral'=>$claveGeneral, 'idantecedenteGinecobstetrico'=>$idantecedenteGinecobstetrico, 'fechaCulminacion'=>$fechaCulminacion, 'nroAtencionPrenatal'=>$nroAtencionPrenatal, 'complicacion'=>$complicacion, 'fuente'=>$fuente, 'opcionSuplemento'=>$opcionSuplemento, 'aborto'=>$aborto, 'lugarParto'=>$lugarParto, 'tipoParto'=>$tipoParto, 'opHorVer'=>$opHorVer, 'idcatalogoCIE10'=>$idcatalogoCIE10, 'nombreTipoParto'=>$nombreTipoParto, 'pesoRN'=>$pesoRN, 'idprofesion'=>$idprofesion, 'idpersonaref'=>$idpersonaref, 'opcionRef'=>$opcionRef));
        if($data[0]!=''){
            $query = "INSERT INTO detalleGinecobstetrico ($data[0]) VALUES($data[1])";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function actualizarDetalleGinecobstetrico($iddetalleGinecobstetrico, $claveGeneral, $idantecedenteGinecobstetrico, $fechaCulminacion, $nroAtencionPrenatal, $complicacion, $fuente, $opcionSuplemento, $aborto, $lugarParto, $tipoParto, $opHorVer, $idcatalogoCIE10, $nombreTipoParto, $pesoRN, $idprofesion, $idpersonaref, $opcionRef){
        $data = verificarDatos('edit', array('iddetalleGinecobstetrico'=>$iddetalleGinecobstetrico, 'claveGeneral'=>$claveGeneral, 'idantecedenteGinecobstetrico'=>$idantecedenteGinecobstetrico, 'fechaCulminacion'=>$fechaCulminacion, 'nroAtencionPrenatal'=>$nroAtencionPrenatal, 'complicacion'=>$complicacion, 'fuente'=>$fuente, 'opcionSuplemento'=>$opcionSuplemento, 'aborto'=>$aborto, 'lugarParto'=>$lugarParto, 'tipoParto'=>$tipoParto, 'opHorVer'=>$opHorVer, 'idcatalogoCIE10'=>$idcatalogoCIE10, 'nombreTipoParto'=>$nombreTipoParto, 'pesoRN'=>$pesoRN, 'idprofesion'=>$idprofesion, 'idpersonaref'=>$idpersonaref, 'opcionRef'=>$opcionRef));
        if($data[0]!=''){
            $query = "UPDATE detalleGinecobstetrico SET $data[0] WHERE iddetalleGinecobstetrico = $iddetalleGinecobstetrico AND claveGeneral = '$claveGeneral'";
            mysql_query($query);
            echo $query;
        }
    }
    
    public function eliminarDetalleGinecobstetrico($iddetalleGinecobstetrico, $claveGeneral){
        $query = "DELETE FROM detalleGinecobstetrico WHERE iddetalleGinecobstetrico = $iddetalleGinecobstetrico AND claveGeneral = '$claveGeneral'";
        mysql_query($query);
    }
}
?>