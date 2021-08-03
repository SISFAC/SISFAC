<?
/*
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.


*/
require_once '../conexion/Conexion.php';
class Persona {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function mostrarPersonaDatagrid($idfamilia, $claveGeneral){
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
        
        //$wh .= " AND per.claveGeneral = '$_SESSION[claveGeneral]'";
        $wh .= " AND per.claveGeneral = '$claveGeneral'";
        if($idfamilia!='') $wh .= " AND idfamilia = '$idfamilia'";
        
        $query="SELECT COUNT(*) FROM persona per INNER JOIN distrito dis ON per.iddistrito=dis.iddistrito
                INNER JOIN provincia pro ON pro.idprovincia=dis.idprovincia 
                INNER JOIN region reg ON reg.idregion=pro.idregion WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idpersona, dis.iddistrito, pro.idprovincia, reg.idregion ,idfamilia, numeroHC, opcionDNI, dni, per.nombre, apellidoPaterno, apellidoMaterno, sexo, 
                fechaNacimiento, gradoInstruccion, seguroMedico, numeroSeguro, ocupacion, tipoOcupacion, parentesco, estadoCivil, 
                jefeFamilia, pertenenciaEtnica, desendenciaEtnica, activo, if(activo<>'AC', motivo, null) as motivo, YEAR(CURDATE()) - YEAR(fechaNacimiento) AS edad, grupoSanguineo, grupoRiesgo, opcionLugarResidencia, lugarResidencia, contacto, telefonoContacto, parentescoContacto,DATE_FORMAT(fechaNacimiento,'%d/%m/%Y') as edad1
                FROM persona per INNER JOIN distrito dis ON per.iddistrito=dis.iddistrito
                INNER JOIN provincia pro ON pro.idprovincia=dis.idprovincia 
                INNER JOIN region reg ON reg.idregion=pro.idregion 
                WHERE (per.motivo is null or per.motivo<>'DEFUNCION') $wh ORDER BY $sidx $sord LIMIT $start,$limit";
       // echo $query;exit();
        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function obtenerMaximaPersona(){
        $query = "SELECT MAX(idpersona) FROM persona WHERE claveGeneral = '$_SESSION[claveGeneral]'";
        $row = mysql_fetch_array(mysql_query($query));
        return $row[0];
    }
    
    public function agregarPersona($claveGeneral, $idpersona, $iddistrito, $idfamilia, $numeroHC, $opcionDNI, $dni, $nombre, $apellidoPaterno, $apellidoMaterno, $sexo, $fechaNacimiento, $gradoInstruccion, $seguroMedico, $numeroSeguro, $ocupacion, $tipoOcupacion, $parentesco, $estadoCivil, $jefeFamilia, $pertenenciaEtnica, $desendenciaEtnica, $activo, $motivo, $grupoSanguineo, $grupoRiesgo, $opcionLugarResidencia, $lugarResidencia, $contacto, $telefonoContacto, $parentescoContacto, $estudia){

        $motivo="";


        $data = verificarDatos( 'add', array('claveGeneral'=>$claveGeneral, 'idpersona'=>$idpersona, 'idfamilia'=>$idfamilia, 'iddistrito'=>$iddistrito, 'numeroHC'=>$numeroHC, 'opcionDNI'=>$opcionDNI, 'dni'=>$dni,'nombre'=>$nombre, 'apellidoMaterno'=>$apellidoMaterno, 'apellidoPaterno'=>$apellidoPaterno, 'sexo'=>$sexo, 'fechaNacimiento'=>$fechaNacimiento, 'gradoInstruccion'=>$gradoInstruccion, 'seguroMedico'=>$seguroMedico, 'numeroSeguro'=>$numeroSeguro,'ocupacion'=>$ocupacion, 'tipoOcupacion'=>$tipoOcupacion, 'parentesco'=>$parentesco, 'estadoCivil'=>$estadoCivil, 'jefeFamilia'=>$jefeFamilia, 'pertenenciaEtnica'=>$pertenenciaEtnica, 'desendenciaEtnica'=>$desendenciaEtnica, 'activo'=>$activo, 'motivo'=>$motivo, 'grupoSanguineo'=>$grupoSanguineo, 'grupoRiesgo'=>$grupoRiesgo, 'opcionLugarResidencia'=>$opcionLugarResidencia, 'lugarResidencia'=>$lugarResidencia, 'contacto'=>$contacto, 'telefonoContacto'=>$telefonoContacto, 'parentescoContacto'=>$parentescoContacto, 'estudia'=>$estudia)); 
        if($data[0]!=''){
            $query = "INSERT INTO persona($data[0]) VALUES($data[1])";
            mysql_query($query);
        }
    }
    
    public function actualizarPersona($claveGeneral, $idpersona, $iddistrito, $idfamilia, $numeroHC, $opcionDNI, $dni, $nombre, $apellidoPaterno, $apellidoMaterno, $sexo, $fechaNacimiento, $gradoInstruccion, $seguroMedico, $numeroSeguro, $ocupacion, $tipoOcupacion, $parentesco, $estadoCivil, $jefeFamilia, $pertenenciaEtnica, $desendenciaEtnica, $activo, $motivo, $grupoSanguineo, $grupoRiesgo, $opcionLugarResidencia, $lugarResidencia, $contacto, $telefonoContacto, $parentescoContacto, $estudia){
        $data = verificarDatos( 'edit', array('idfamilia'=>$idfamilia, 'iddistrito'=>$iddistrito, 'numeroHC'=>$numeroHC, 'opcionDNI'=>$opcionDNI, 'dni'=>$dni,'nombre'=>$nombre, 'apellidoMaterno'=>$apellidoMaterno, 'apellidoPaterno'=>$apellidoPaterno, 'sexo'=>$sexo, 'fechaNacimiento'=>$fechaNacimiento, 'gradoInstruccion'=>$gradoInstruccion, 'seguroMedico'=>$seguroMedico, 'numeroSeguro'=>$numeroSeguro,'ocupacion'=>$ocupacion, 'tipoOcupacion'=>$tipoOcupacion, 'condicion'=>$condicion, 'parentesco'=>$parentesco, 'estadoCivil'=>$estadoCivil, 'jefeFamilia'=>$jefeFamilia, 'pertenenciaEtnica'=>$pertenenciaEtnica, 'desendenciaEtnica'=>$desendenciaEtnica,'activo'=>$activo, 'motivo'=>$motivo, 'grupoSanguineo'=>$grupoSanguineo, 'grupoRiesgo'=>$grupoRiesgo, 'opcionLugarResidencia'=>$opcionLugarResidencia, 'lugarResidencia'=>$lugarResidencia, 'contacto'=>$contacto, 'telefonoContacto'=>$telefonoContacto, 'parentescoContacto'=>$parentescoContacto, 'estudia'=>$estudia)); 
        if($data[0]!='' && $idpersona!=''){
            $query = "UPDATE persona SET $data[0] WHERE idpersona = $idpersona AND claveGeneral='$claveGeneral'";
            mysql_query($query);
        }
    }
    
    public function activarPersona($claveGeneral, $idpersona, $activo, $motivo){
        $data = verificarDatos( 'edit', array('activo'=>$activo, 'motivo'=>$motivo)); 
        if($data[0]!='' && $idpersona!=''){
            $query = "UPDATE persona SET $data[0] WHERE idpersona = $idpersona AND claveGeneral='$claveGeneral'";
            mysql_query($query);
        }
    }
    
    public function eliminarPersona($claveGeneral, $idpersona){

        $query = "DELETE FROM persona WHERE idpersona = $idpersona AND claveGeneral = '$claveGeneral'";
        mysql_query($query);
    }
    
    public function obtenerDNIPersona($claveGeneral, $codigoFicha){
        $query = "SELECT opcionDNI, dni FROM persona pe INNER JOIN familia fa ON pe.claveGeneral = fa.claveGeneral AND pe.idfamilia = fa.idfamilia
                    WHERE idpersona = $idpersona AND codigoFicha = '$codigoFicha' AND (parentesco = 'MADRE' OR parentesco = 'PADRE' OR parentesco = 'OTRO') LIMIT 0,1";
        $row = mysql_fetch_array(mysql_query($query));
        return $row[0].'-'.$row[1];
    }
    
    public function obtenerNroHijos($claveGeneral, $codigoFicha){
        $query = "SELECT COUNT(*) WHERE idpersona = $idpersona AND codigoFicha = '$codigoFicha' AND parentesco = 'HIJO/HIJA'";
        $row = mysql_fetch_array(mysql_query($query));
        return $row[0];
    }

    public function buscarFichaClinica($claveGeneral,$dni, $codigoFicha, $numeroHC, $nombresApellidos, $nombreRegion, $nompro){
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
        
        $wh .= " AND per.claveGeneral = '$claveGeneral'";
        
        if($dni!='') $wh .= " AND dni = '$dni'";
        if($codigoFicha!='') $wh .= " AND codigoFicha = '$codigoFicha'";
        if($numeroHC !='') $wh .= " AND numeroHC = '$numeroHC'";
        if($nombresApellidos!='') $wh .= " AND CONCAT_WS(' ',per.nombre, apellidoPaterno, apellidoMaterno) = '$nombresApellidos'";
        if($nombreRegion!='') $wh .= " AND reg.nombreRegion = '$nombreRegion'";
        if($nompro!='') $wh .= " AND pro.nompro = '$nompro'";
        
        
        $query="SELECT COUNT(*) 
                FROM familia fam INNER JOIN persona per ON fam.idfamilia=per.idfamilia AND per.claveGeneral = '$claveGeneral' 
                INNER JOIN distrito dis ON dis.iddistrito = per.iddistrito INNER JOIN provincia pro ON pro.idprovincia = dis.idprovincia 
                INNER JOIN region reg ON reg.idregion=pro.idregion
                WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];//'".obtenerEdad(formatoFecha("fechaNacimiento"))."' 
        $query="SELECT idpersona, codigoFicha, numeroHC, opcionDNI, dni, CONCAT_WS(' ',per.nombre, apellidoPaterno, apellidoMaterno) as nombres, sexo, 
                fechaNacimiento,DATE_FORMAT(fechaNacimiento,'%d/%m/%Y') as edad, seguroMedico, numeroSeguro, parentesco,'' as etapa,DATEDIFF(CURDATE(),fechaNacimiento) as dias, desendenciaEtnica
                FROM familia fam INNER JOIN persona per ON fam.idfamilia=per.idfamilia AND per.claveGeneral = '$claveGeneral'
                INNER JOIN distrito dis ON dis.iddistrito = per.iddistrito INNER JOIN provincia pro ON pro.idprovincia = dis.idprovincia INNER JOIN region reg ON reg.idregion=pro.idregion
                WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";
        //echo $query;
        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function buscarPersonaParentesco($codigoFicha, $claveGeneral){
        $query = "SELECT idpersona FROM persona per INNER JOIN familia fam ON per.idfamilia=fam.idfamilia AND per.claveGeneral = fam.claveGeneral 
                    WHERE codigoFicha = '$codigoFicha' AND per.claveGeneral = '$claveGeneral' AND parentesco = 'M'";
        //echo $query;
        $row = mysql_fetch_array(mysql_query($query));
        return $row[0];
    }
}
?>