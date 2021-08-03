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

class Familia {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function mostrarFamiliaDatagrid($codigoFicha, $dni){
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
                    case 'nombreFamilia':
                    case 'tipocambio':
                        $wh .= " AND $k LIKE '%$v%'";
                        break;
                    case 'nombreComunidad':
                    case 'nombreSector':
                        $wh .= " AND $k LIKE '%$v%'";
                        break;
                    case 'activo':
                        $wh .= " AND fam.activo = '$v'";
                        break;
                }
            }
        }
        //$wh .= " AND fam.claveGeneral = '$_SESSION[claveGeneral]'";
        if($codigoFicha!='') $wh.=" AND codigoFicha LIKE '%$codigoFicha%'";
        if($dni!='') $wh.=" AND dni LIKE '$dni%'";
        
        $query="SELECT COUNT(*) FROM (SELECT DISTINCT CONCAT_WS('-',fam.idfamilia,fam.claveGeneral) as id
                FROM familia fam LEFT JOIN persona per ON fam.idfamilia=per.idfamilia AND fam.claveGeneral=per.claveGeneral WHERE 1=1 $wh ) AS T";
        //echo $query;
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages = $dato[2];
        $query="SELECT DISTINCT CONCAT_WS('-',fam.idfamilia,fam.claveGeneral) as id,fam.idfamilia, fam.idcomunidad, fam.idsector, idtrabajador, fam.idestablecimiento, 
                codigoFicha, nombreFamilia, fam.nombreComunidad, fam.nombreSector, fam.nombreEstablecimiento, fam.nombre, fam.nompro, fam.nombreRegion, 
                numeroVivienda, codigoFamilia, fechaApertura, lote, telefono, correo, referencia, tipoEntorno, idioma1, idioma2, idioma3, tiempoDemora, 
                tiempoDomicilio, viviendaAnterior, medioTransporte, religion, diaVisita, horaVisita, tipoFamilia, fam.activo, if(fam.activo<>'AC',fam.motivo,'') as motivo, registrador,opcion, fam.claveGeneral
                FROM familia fam LEFT JOIN persona per ON fam.idfamilia=per.idfamilia AND fam.claveGeneral=per.claveGeneral 
                WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $limit OFFSET $start";
        //echo $query;
        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function agregarFamilia($idfamilia, $claveGeneral, $idsector, $idtrabajador, $numeroVivienda, $codigoFamilia, $codigoFicha, $fechaApertura, $nombreSector, $idcomunidad, $nombreComunidad, $idestablecimiento, $nombreEstablecimiento, $iddistrito, 
            $nombre, $idprovincia, $nompro, $idregion, $nombreRegion, $idnucleo, $nombreNucleo, $idmicrored, $nombreMicrored, $idred, $nombreRed, $iddiresa, $nombreDiresa){
        $data = verificarDatos('add', array('idfamilia' => $idfamilia, 'claveGeneral' => $claveGeneral, 'idsector'=>$idsector,'idtrabajador'=>$idtrabajador, 'numeroVivienda'=>$numeroVivienda, 'codigoFamilia'=>$codigoFamilia, 'fechaApertura'=>$fechaApertura,
            'nombreSector'=>$nombreSector, 'idcomunidad'=>$idcomunidad, 'nombreComunidad'=>$nombreComunidad, 'idestablecimiento'=>$idestablecimiento, 'nombreEstablecimiento'=>$nombreEstablecimiento, 'iddistrito'=>$iddistrito, 'nombre'=>$nombre, 
            'idprovincia'=>$idprovincia, 'nompro'=>$nompro, 'idregion'=>$idregion, 'nombreRegion'=>$nombreRegion, 'idnucleo'=>$idnucleo, 'nombreNucleo'=>$nombreNucleo, 'idmicrored'=>$idmicrored, 'nombreMicrored'=>$nombreMicrored, 'idred'=>$idred, 
            'nombreRed'=>$nombreRed, 'iddiresa'=>$iddiresa, 'nombreDiresa'=>$nombreDiresa));


        $fechaModificacion = date('Y-m-d H:i:s');

        if($data[0]!=''){
            $query = "INSERT INTO familia($data[0],codigoFicha,fechaModificacion) VALUES($data[1],'$codigoFicha','$fechaModificacion')";
            mysql_query($query);
            //echo $query;
        }
    }
    
    public function actualizarFamilia($claveGeneral, $idfamilia, $idsector, $idtrabajador, $numeroVivienda, $codigoFamilia, $fechaApertura, $nombreFamilia, $lote, $telefono, $correo, $referencia, $tipoEntorno, $idioma1, $idioma2, $idioma3, $tiempoDemora, $tiempoDomicilio, $viviendaAnterior, $medioTransporte, $religion, $diaVisita, $horaVisita, $tipoFamilia, $activo, $motivo, $registrador, $opcion){

        

        $data = verificarDatos('edit', array('idsector'=>$idsector,'idtrabajador'=>$idtrabajador, 'numeroVivienda'=>$numeroVivienda, 'codigoFamilia'=>$codigoFamilia, 'fechaApertura'=>$fechaApertura, 'nombreFamilia'=>$nombreFamilia, 'lote'=>$lote, 'telefono'=>$telefono, 'referencia'=>$referencia, 'tipoEntorno'=>$tipoEntorno, 'idioma1'=>$idioma1, 'idioma2'=>$idioma2, 'idioma3'=>$idioma3, 'tiempoDemora'=>$tiempoDemora, 'tiempoDomicilio'=>$tiempoDomicilio, 'viviendaAnterior'=>$viviendaAnterior, 'medioTransporte'=>$medioTransporte, 'religion'=>$religion, 'diaVisita'=>$diaVisita, 'horaVisita'=>$horaVisita, 'tipoFamilia'=>$tipoFamilia, 'activo'=>$activo, 'motivo'=>$motivo,'registrador'=>$registrador,'opcion'=>$opcion));
        if($correo!=''){
            $c = ", correo = '$correo' ";
        }

        $fechaModificacion = ", fechaModificacion='".date('Y-m-d H:i:s')."'";

        if($data[0]!=''){
            $query = "UPDATE familia SET $data[0] $c $fechaModificacion WHERE idfamilia = $idfamilia AND claveGeneral = '$claveGeneral'";
            mysql_query($query);
          
        }
    }
    
    public function actualizarCodigoFicha($claveGeneral, $idfamilia, $codigoFicha, $idsector, $numeroVivienda, $codigoFamilia, $fechaApertura, $nombreSector, $idcomunidad, $nombreComunidad, $idestablecimiento, $nombreEstablecimiento, $iddistrito, 
            $nombre, $idprovincia, $nompro, $idregion, $nombreRegion, $idnucleo, $nombreNucleo, $idmicrored, $nombreMicrored, $idred, $nombreRed, $iddiresa, $nombreDiresa){


        $data = verificarDatos('edit', array('idsector'=>$idsector, 'numeroVivienda'=>$numeroVivienda, 'codigoFamilia'=>$codigoFamilia, 'fechaApertura'=>$fechaApertura,
            'nombreSector'=>$nombreSector, 'idcomunidad'=>$idcomunidad, 'nombreComunidad'=>$nombreComunidad, 'idestablecimiento'=>$idestablecimiento, 'nombreEstablecimiento'=>$nombreEstablecimiento, 'iddistrito'=>$iddistrito, 'nombre'=>$nombre, 
            'idprovincia'=>$idprovincia, 'nompro'=>$nompro, 'idregion'=>$idregion, 'nombreRegion'=>$nombreRegion, 'idnucleo'=>$idnucleo, 'nombreNucleo'=>$nombreNucleo, 'idmicrored'=>$idmicrored, 'nombreMicrored'=>$nombreMicrored, 'idred'=>$idred, 
            'nombreRed'=>$nombreRed, 'iddiresa'=>$iddiresa, 'nombreDiresa'=>$nombreDiresa));
        $query = "UPDATE familia SET codigoFicha='$codigoFicha', $data[0]  WHERE idfamilia = $idfamilia AND claveGeneral = '$claveGeneral'";
        //echo $query;
        mysql_query($query);
    }
    
    public function obtenerMaximaFamilia(){
        $query = "SELECT MAX(idfamilia) FROM familia";
        $row = mysql_fetch_array(mysql_query($query));
        return $row[0];
    }
    
    public function buscarCodFicha($codigo) {
        $query = "SELECT COUNT(*) FROM familia WHERE codigoFicha = '$codigo'";
        $row = mysql_fetch_array(mysql_query($query));
        return $row[0];
    }
    
    public function buscarCodigoFichaIdfamilia($idfamilia, $claveGeneral) {
        $query = "SELECT codigoFicha FROM familia WHERE idfamilia = '$idfamilia' AND claveGeneral = '$claveGeneral'";
        $row = mysql_fetch_array(mysql_query($query));
        return $row[0];
    }
    
    public function eliminarFicha($codigo,$claveGeneral){
        $query = "DELETE FROM visita WHERE idfamilia = $codigo AND claveGeneral = '$claveGeneral'";
        mysql_query($query);
        $query = "DELETE FROM socioeconomico WHERE idfamilia = $codigo AND claveGeneral = '$claveGeneral'";
        mysql_query($query);
        $query = "DELETE FROM entorno WHERE idfamilia = $codigo AND claveGeneral = '$claveGeneral'";
        mysql_query($query);
        $query = "DELETE FROM ciclo WHERE idfamilia = $codigo AND claveGeneral = '$claveGeneral'";
        mysql_query($query);
        $query = "DELETE FROM riesgo WHERE idfamilia = $codigo AND claveGeneral = '$claveGeneral'";
        mysql_query($query);
        $query = "DELETE FROM persona WHERE idfamilia = $codigo AND claveGeneral = '$claveGeneral'";
        mysql_query($query);
        $query = "DELETE FROM familia WHERE idfamilia = $codigo AND claveGeneral = '$claveGeneral'";
        mysql_query($query);
    }
    
    public function obtenerCantidadFicha($idcomunidad,$idsector,$claveGeneral) {
        if($idcomunidad!='') $wh .= " AND com.idcomunidad = $idcomunidad";
        if($idsector!='') $wh .= " AND sec.idsector = $idsector";
        $query = "SELECT COUNT(*)
                FROM familia fam INNER JOIN sector sec ON fam.idsector=sec.idsector AND fam.claveGeneral = sec.claveGeneral 
                INNER JOIN comunidad com ON com.idcomunidad=sec.idcomunidad AND com.claveGeneral=sec.claveGeneral
                WHERE 1=1 $wh AND fam.claveGeneral = '$claveGeneral'";
        $row = mysql_fetch_array(mysql_query($query));
        return $row[0];
    }
    
    public function mostrarFichaVector($filtro, $limit){
        $query = "SELECT codigoFicha FROM familiaH WHERE codigoFicha LIKE '%$filtro%'";
        $result = mysql_query($query);
        $catalogo = array();
        while($row = mysql_fetch_array($result)){
            array_push($catalogo, array("value"=>$row[0],"label"=>$row[0]));
            if(count($catalogo)>$limit) break;
        }
        
        return array_to_json($catalogo);
    }
}

?>
