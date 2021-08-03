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
class Historial {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }

    public function limpiarHistorial($codigoFicha, $claveGeneral){

       
        $query = "SELECT claveGeneral, idfamiliaH, fechaHistorial FROM familiaH where codigoFicha='$codigoFicha' and claveGeneral='$claveGeneral' order by fechaHistorial desc";
        $result = mysql_query($query);

        $year = '';
        $month = '';

        $first = false;
        $last = false;


        $cyear = date("Y");

        while($row = mysql_fetch_assoc($result)) {

           $time = strtotime($row[fechaHistorial]);
         
            if(date('Y', $time) == $cyear){

                if($month==date('m', $time)){

                    $this->eliminarHistorial($row[idfamiliaH], $row[claveGeneral]);
                    $this->eliminarCondicionHistorial($row[idfamiliaH], $row[claveGeneral]);

                }            

           }else if(date('Y', $time) < $cyear){

                if($year != date('Y', $time) || $month != date('m', $time)){

                    if($year != date('Y', $time)){

                        $first = false;
                        $last = false;

                    }
                   
                    if(date('j', $time)>6 && !$last){

                        $last = true;

                    }else if(date('j', $time)>6 && $last){


                        $this->eliminarHistorial($row[idfamiliaH], $row[claveGeneral]);
                        $this->eliminarCondicionHistorial($row[idfamiliaH], $row[claveGeneral]);

                    }else if(date('j', $time)<=6 && !$first){

                        $first = true;

                    }else if(date('j', $time)<=6 && $first){


                        $this->eliminarHistorial($row[idfamiliaH], $row[claveGeneral]);
                        $this->eliminarCondicionHistorial($row[idfamiliaH], $row[claveGeneral]);

                    }

                }else{


                    $this->eliminarHistorial($row[idfamiliaH], $row[claveGeneral]);
                    $this->eliminarCondicionHistorial($row[idfamiliaH], $row[claveGeneral]);

                }

           }


            $year = date('Y', $time);
            $month = date('m', $time);

        }
    }

    public function limpiarHistorialCompleto(){
         
        $query = "select codigoFicha, claveGeneral from familia";
        $result = mysql_query($query);
        while ($row = mysql_fetch_assoc($result)) {
            $this->limpiarHistorial($row['codigoFicha'], $row['claveGeneral']); 
        }
            
    }

    public function mostrarFamiliaHistoricoDatagrid($activo, $fechaInicio, $fechaFin){
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
                    case 'codigoFicha':
                    case 'nombreFamilia':
                    case 'registrador':
                    case 'trabajador':
                        $wh .= " AND $k LIKE '%$v%'";
                        break;
                }
            }
        }
        
        if($fechaInicio!='' && $fechaFin!='') $wh.=" AND fechaHistorial>='$fechaInicio 00:00:00' AND fechaHistorial<='$fechaFin 23:59:59'";
        if($activo != '') $wh.=" AND activo = '$activo'";
        
        $query="SELECT COUNT(*) FROM familiaH WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT CONCAT_WS(',',claveGeneral,idfamiliaH) id,idfamiliaH, fechaHistorial, idsector, nombreSector, codigoFicha, fechaApertura, nombreFamilia, registrador, trabajador ,claveGeneral
                FROM familiaH WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";
        //echo $query;
        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function obtenerIDFamiliaHistorial($claveGeneral){
        $row = mysql_fetch_array(mysql_query("SELECT MAX(idfamiliaH) FROM familiaH WHERE claveGeneral = '$claveGeneral'"));
        return $row[0];
    }
    
    public function agregarFamiliaHistorial($claveGeneral, $idfamiliaH, $idfamilia, $registrador, $trabajador, $fechaHistorial){
        echo $fechaHistorial."<br></br>";
        if($fechaHistorial) $fecha = $fechaHistorial;
        else $fecha = date('c');
        $query = "INSERT INTO familiaH(claveGeneral, idfamiliaH, fechaHistorial, idsector, nombreSector, codigoFicha, fechaApertura, nombreFamilia, lote, telefono, correo, 
                referencia, tipoEntorno, idioma1, idioma2, idioma3, tiempoDemora, tiempoDomicilio, viviendaAnterior, medioTransporte, religion, diaVisita, horaVisita, tipoFamilia, 
                activo, motivo, registrador, trabajador, idcomunidad, nombreComunidad, idestablecimiento, nombreEstablecimiento, iddistrito, nombre, idprovincia, nompro, idregion, 
                nombreRegion, idnucleo, nombreNucleo, idmicrored, nombreMicrored, idred, nombreRed, iddiresa, nombreDiresa)
                SELECT '$claveGeneral', $idfamiliaH, '$fecha', fam.idsector, sec.nombreSector, codigoFicha, fechaApertura, nombreFamilia, lote, telefono, correo, 
                referencia, tipoEntorno, idioma1, idioma2, idioma3, tiempoDemora, tiempoDomicilio, viviendaAnterior, medioTransporte, religion, diaVisita, horaVisita, tipoFamilia, 
                activo, motivo , '$registrador', '$trabajador', fam.idcomunidad, fam.nombreComunidad, fam.idestablecimiento, fam.nombreEstablecimiento, fam.iddistrito, 
                fam.nombre, fam.idprovincia, fam.nompro, fam.idregion, fam.nombreRegion, fam.idnucleo, fam.nombreNucleo, fam.idmicrored, fam.nombreMicrored, fam.idred, 
                fam.nombreRed, fam.iddiresa, fam.nombreDiresa
                FROM familia fam INNER JOIN sector sec ON fam.idsector=sec.idsector AND fam.claveGeneral=sec.claveGeneral WHERE idfamilia = $idfamilia AND fam.claveGeneral = '$claveGeneral'";
        //echo $query;
        mysql_query($query);
    }
    
    public function actualizarHistorial($codigo, $claveGeneral){
        $query = "UPDATE familiaH SET activo='IN' WHERE codigoFicha = '$codigo' AND claveGeneral = '$claveGeneral'";
        //echo $query;
        mysql_query($query);
    }
    
    public function agregarCicloHistorial($claveGeneral, $idcicloH, $idfamiliaH, $nombreCiclo){
        //$query = "INSERT INTO cicloH(claveGeneral,idcicloH,idfamiliaH, nombreCiclo)
                    //SELECT '$claveGeneral',$idcicloH,$idfamiliaH, nombreCiclo FROM ciclo WHERE idfamilia = $idfamilia AND claveGeneral = '$claveGeneral'";
        
        $query = "INSERT INTO cicloH(claveGeneral,idcicloH,idfamiliaH, nombreCiclo)
                    VALUES('$claveGeneral',$idcicloH,$idfamiliaH, '$nombreCiclo')";
        //echo $query;
        mysql_query($query);
    }
    
    public function agregarEntornoHistorial($claveGeneral,$identornoH,$idfamiliaH, $tipo,$descripcion){
        //$query = "INSERT INTO entornoH(claveGeneral, identornoH, idfamiliaH, tipo, descripcion)
          //          SELECT '$claveGeneral',$identornoH,$idfamiliaH, tipo, descripcion FROM entorno WHERE idfamilia = $idfamilia AND claveGeneral = '$claveGeneral'";
        $query = "INSERT INTO entornoH(claveGeneral, identornoH, idfamiliaH, tipo, descripcion)
                    VALUES('$claveGeneral',$identornoH,$idfamiliaH, '$tipo', '$descripcion')";
        //echo $query;
        mysql_query($query);
    }
    
    public function agregarSocioEconomicoHistorial($claveGeneral, $idsocioeconomicoH,$idfamiliaH, $tipo, $descripcion, $puntaje){
        //$query = "INSERT INTO socioeconomicoH(claveGeneral,idsocioeconomicoH,idfamiliaH, tipo, descripcion, puntaje)
          //      SELECT '$claveGeneral',$idsocioeconomicoH,$idfamiliaH, tipo, descripcion, puntaje FROM socioeconomico WHERE idfamilia = $idfamilia AND claveGeneral = '$claveGeneral'";
        $query = "INSERT INTO socioeconomicoH(claveGeneral,idsocioeconomicoH,idfamiliaH, tipo, descripcion, puntaje)
                VALUES ('$claveGeneral',$idsocioeconomicoH,$idfamiliaH, '$tipo', '$descripcion', '$puntaje')";
        //echo $query;
        mysql_query($query);
    }
    
    public function agregarVisitaHistorial($claveGeneral, $idvisitaH, $idfamiliaH, $fechaVisita, $resultado, $fechaCita, $estadoCita, $motivo, $nombreCompleto){
        /*$query = "INSERT INTO visitaH(claveGeneral,idvisitaH,idfamiliaH, fechaVisita, resultado, fechaCita, estadoCita, motivo, trabajador)
                    SELECT '$claveGeneral',$idvisitaH,$idfamiliaH, fechaVisita, resultado, fechaCita, estadoCita, motivo, nombreCompleto 
                    FROM visita vis INNER JOIN trabajador tra ON vis.idtrabajador=tra.idtrabajador WHERE idfamilia = $idfamilia AND vis.claveGeneral='$claveGeneral'";*/
        $query = "INSERT INTO visitaH(claveGeneral,idvisitaH,idfamiliaH, fechaVisita, resultado, fechaCita, estadoCita, motivo, trabajador)
                    VALUES('$claveGeneral',$idvisitaH,$idfamiliaH, '$fechaVisita', '$resultado', '$fechaCita', '$estadoCita', '$motivo', '$nombreCompleto' )";
        //echo $query;
        mysql_query($query);
    }
    
    public function agregarRiesgoHistorial($claveGeneral, $idriesgoH, $idpersonaH, $idfamiliaH, $etapa, $nombreRiesgo, $puntaje){
        if($idpersonaH!=''){
            $c = ",idpersonaH";
            $v = ",$idpersonaH";
        }
        $query = "INSERT INTO riesgoH(claveGeneral, idriesgoH, idfamiliaH, etapa, nombreRiesgo, puntaje $c) 
                    VALUES('$claveGeneral', $idriesgoH ,$idfamiliaH, '$etapa', '$nombreRiesgo', '$puntaje' $v)";
        //echo $query;
        mysql_query($query);
    }
    
    public function agregarCondicionHistorial($claveGeneral, $idcondicionH, $idpersonaH, $codigoCondicion, $nombreCondicion){
        if($idpersonaH!=''){
            $c = ",idpersonaH";
            $v = ",$idpersonaH";
        }
        $query = "INSERT INTO condicionH(claveGeneral, idcondicionH,codigoCondicion, nombreCondicion $c) 
                    VALUES('$claveGeneral', $idcondicionH, $codigoCondicion, '$nombreCondicion' $v)";
        //echo $query;
        mysql_query($query);
    }
    
    public function agregarSindromeCulturalHistorial($claveGeneral, $idH, $idpersonaH, $codigo, $nombre){
        if($idpersonaH!=''){
            $c = ",idpersonaH";
            $v = ",$idpersonaH";
        }
        $query = "INSERT INTO sindromeCulturalH(claveGeneral, idsindromeculturalH,codigo, nombre $c) 
                    VALUES('$claveGeneral', $idH, $codigo, '$nombre' $v)";
        //echo $query;
        mysql_query($query);
    }
    
    public function obtenerPersonaHistorial($idfamiliaH){
        $query = "SELECT idpersonaH FROM personaH WHERE idfamiliaH=$idfamiliaH";
        return mysql_query($query);
    }
    
    public function obtenerIDFamiliaCodigoFicha($codigoFicha,$claveGeneral){
        $query = "SELECT idfamiliaH FROM familiaH WHERE codigoFicha = '$codigoFicha' AND claveGeneral = '$claveGeneral'";
        return mysql_query($query);
    }
    
    public function obtenerPersonaVector($idfamilia, $claveGeneral){
        $query = "SELECT idpersona, idfamilia, iddistrito, numeroHC, opcionDNI, dni, nombre, apellidoPaterno, apellidoMaterno, sexo, fechaNacimiento, gradoInstruccion, seguroMedico, numeroSeguro, ocupacion, tipoOcupacion, parentesco, estadoCivil, jefeFamilia, pertenenciaEtnica, desendenciaEtnica,activo, motivo, grupoSanguineo, grupoRiesgo, opcionLugarResidencia, lugarResidencia, contacto, telefonoContacto, parentescoContacto
                FROM persona WHERE idfamilia = $idfamilia AND claveGeneral = '$claveGeneral'";
        return mysql_query($query);
    }
    
    public function agregarPersonaHistorial($claveGeneral, $idpersonaH, $iddistrito, $idfamilia, $numeroHC, $opcionDNI, $dni, $nombre, $apellidoPaterno, $apellidoMaterno, $sexo, $fechaNacimiento, $gradoInstruccion, $seguroMedico, $numeroSeguro, $ocupacion, $tipoOcupacion, $parentesco, $estadoCivil, $jefeFamilia, $pertenenciaEtnica, $desendenciaEtnica,$activo, $motivo, $grupoSanguineo, $grupoRiesgo, $opcionLugarResidencia, $lugarResidencia, $contacto, $telefonoContacto, $parentescoContacto){
        $data = verificarDatos( 'add', array('claveGeneral'=>$claveGeneral, 'idpersonaH'=>$idpersonaH, 'idfamiliaH'=>$idfamilia, 'iddistrito'=>$iddistrito, 'numeroHC'=>$numeroHC, 'opcionDNI'=>$opcionDNI, 'dni'=>$dni,'nombre'=>$nombre, 'apellidoMaterno'=>$apellidoMaterno, 'apellidoPaterno'=>$apellidoPaterno, 'sexo'=>$sexo, 'fechaNacimiento'=>$fechaNacimiento, 'gradoInstruccion'=>$gradoInstruccion, 'seguroMedico'=>$seguroMedico, 'numeroSeguro'=>$numeroSeguro,'ocupacion'=>$ocupacion, 'tipoOcupacion'=>$tipoOcupacion, 'condicion'=>$condicion, 'parentesco'=>$parentesco, 'estadoCivil'=>$estadoCivil, 'jefeFamilia'=>$jefeFamilia, 'pertenenciaEtnica'=>$pertenenciaEtnica, 'desendenciaEtnica'=>$desendenciaEtnica,'activo'=>$activo, 'motivo'=>$motivo, 'grupoSanguineo'=>$grupoSanguineo, 'grupoRiesgo'=>$grupoRiesgo, 'opcionLugarResidencia'=>$opcionLugarResidencia, 'lugarResidencia'=>$lugarResidencia, 'contacto'=>$contacto, 'telefonoContacto'=>$telefonoContacto, 'parentescoContacto'=>$parentescoContacto)); 
        if($data[0]!=''){
            $query = "INSERT INTO personaH($data[0]) VALUES($data[1])";
            mysql_query($query);
            //echo $query;
        }
    }
    
    public function obtenerIDPersonaHistorial($claveGeneral){
        $row = mysql_fetch_array(mysql_query("SELECT MAX(idpersonaH) FROM personaH WHERE claveGeneral = '$claveGeneral'"));
        return $row[0];
    }
    
    public function obtenerRiesgo($idpersona, $idfamilia, $claveGeneral){
        $query = "SELECT etapa, nombreRiesgo, puntaje FROM riesgo WHERE idfamilia = $idfamilia AND idpersona = $idpersona AND claveGeneral = '$claveGeneral'";
        return mysql_query($query);
    }
    
    public function obtenerCondicion($idpersona,$claveGeneral){
        $query = "SELECT codigoCondicion, nombreCondicion FROM condicion WHERE idpersona = $idpersona AND claveGeneral = '$claveGeneral'  order by nombreCondicion";
        //echo $query;
        return mysql_query($query);
    }
    
    
    public function obtenerSindromeCultural($idpersona,$claveGeneral){
        $query = "SELECT codigo, nombre FROM sindromecultural WHERE idpersona = $idpersona AND claveGeneral = '$claveGeneral'  order by nombre";
        //echo $query;
        return mysql_query($query);
    }
    
    public function obtenerRiesgoFamilia($idfamilia){
        $query = "SELECT etapa, nombreRiesgo, puntaje FROM riesgo WHERE idfamilia = $idfamilia AND idpersona IS NULL";
        //echo $query;
        return mysql_query($query);
    }
    
    public function obtenerCicloFamilia($idfamilia,$claveGeneral){
        $query = "SELECT claveGeneral, nombreCiclo FROM ciclo WHERE idfamilia = $idfamilia AND claveGeneral = '$claveGeneral'";
        return mysql_query($query);
    }
    
    public function obtenerEntornoFamilia($idfamilia,$claveGeneral){
        $query = "SELECT claveGeneral, tipo, descripcion FROM entorno WHERE idfamilia = $idfamilia AND claveGeneral = '$claveGeneral'";
        return mysql_query($query);
    }
    
    public function obtenerSocioeconomicoFamilia($idfamilia,$claveGeneral){
        $query = "SELECT claveGeneral ,tipo, descripcion, puntaje FROM socioeconomico WHERE idfamilia = $idfamilia AND claveGeneral = '$claveGeneral'";
        //echo $query;
        return mysql_query($query);
    }
    
    
    public function obtenerVisitaFamilia($idfamilia,$claveGeneral){
        $query = "SELECT vis.claveGeneral, fechaVisita, resultado, fechaCita, estadoCita, motivo, nombreCompleto FROM visita vis INNER JOIN trabajador tra ON vis.idtrabajador=tra.idtrabajador AND vis.claveGeneral=tra.claveGeneral WHERE vis.idfamilia = $idfamilia AND vis.claveGeneral = '$claveGeneral'";
        return mysql_query($query);
    }
    
    public function buscarIdHistorialMaximo($codigo,$claveGeneral){
        $query = "SELECT MAX(idfamiliaH) FROM familiaH WHERE codigoFicha = '$codigo' AND claveGeneral = '$claveGeneral'";
        $row = mysql_fetch_array(mysql_query($query));
        return $row[0];
    }
    
    public function buscarFechaHistorialMaximo($idfamiliaH,$claveGeneral){
        $query = "SELECT MAX(fechaHistorial) FROM familiaH WHERE idfamiliaH = $idfamiliaH AND claveGeneral = '$claveGeneral'";
        echo $query."<br><br>";
        $row = mysql_fetch_array(mysql_query($query));
        return $row[0];
    }
    
    
    public function eliminarHistorial($id, $claveGeneral){
        mysql_query("DELETE FROM cicloH WHERE idfamiliaH = $id AND claveGeneral = '$claveGeneral'");
        mysql_query("DELETE FROM entornoH WHERE idfamiliaH = $id AND claveGeneral = '$claveGeneral'");
        mysql_query("DELETE FROM socioeconomicoH WHERE idfamiliaH = $id AND claveGeneral = '$claveGeneral'");
        mysql_query("DELETE FROM riesgoH WHERE idfamiliaH = $id AND claveGeneral = '$claveGeneral'");
        mysql_query("DELETE FROM personaH WHERE idfamiliaH = $id AND claveGeneral = '$claveGeneral'");
        mysql_query("DELETE FROM visitaH WHERE idfamiliaH = $id AND claveGeneral = '$claveGeneral'");   
        mysql_query("DELETE FROM familiaH WHERE idfamiliaH = $id AND claveGeneral = '$claveGeneral'");
    }
    
    public function eliminarCondicionHistorial($id, $claveGeneral){
        $query = "SELECT idpersonaH FROM personaH WHERE idfamiliaH = $id AND claveGeneral = '$claveGeneral'";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result)) {
            $row1 = mysql_fetch_array(mysql_query("SELECT MAX(idcondicionH) FROM condicionH  WHERE idpersonaH = $row[0] AND claveGeneral = '$claveGeneral'"));
            mysql_query("DELETE FROM condicionH WHERE idcondicionH = $row1[0]");
        }
    }
    
    public function eliminarSindromeCulturalHistorial($id, $claveGeneral){
        $query = "SELECT idpersonaH FROM personaH WHERE idfamiliaH = $id AND claveGeneral = '$claveGeneral'";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result)) {
            $row1 = mysql_fetch_array(mysql_query("SELECT MAX(idsindromeculturalH) FROM sindromeculturalH  WHERE idpersonaH = $row[0] AND claveGeneral = '$claveGeneral'"));
            mysql_query("DELETE FROM sindromeculturalH WHERE idsindromeculturalH = $row1[0]");
        }
    }
    
    public function actualizarCodigoFichaHistorial($claveGeneral,$codigoFicha,$codigoFichaAnterior, $nombreSector, $idcomunidad, $nombreComunidad, $idestablecimiento, $nombreEstablecimiento, $iddistrito, 
            $nombre, $idprovincia, $nompro, $idregion, $nombreRegion, $idnucleo, $nombreNucleo, $idmicrored, $nombreMicrored, $idred, $nombreRed, $iddiresa, $nombreDiresa){
        $data = verificarDatos('edit', array(
                                            'nombreSector'=>$nombreSector, 'idcomunidad'=>$idcomunidad, 'nombreComunidad'=>$nombreComunidad, 'idestablecimiento'=>$idestablecimiento, 'nombreEstablecimiento'=>$nombreEstablecimiento, 'iddistrito'=>$iddistrito, 'nombre'=>$nombre, 
                                            'idprovincia'=>$idprovincia, 'nompro'=>$nompro, 'idregion'=>$idregion, 'nombreRegion'=>$nombreRegion, 'idnucleo'=>$idnucleo, 'nombreNucleo'=>$nombreNucleo, 'idmicrored'=>$idmicrored, 'nombreMicrored'=>$nombreMicrored, 'idred'=>$idred, 
                                            'nombreRed'=>$nombreRed, 'iddiresa'=>$iddiresa, 'nombreDiresa'=>$nombreDiresa));
        
        $query = "UPDATE familiaH SET codigoFicha = '$codigoFicha', $data[0] WHERE claveGeneral = '$claveGeneral' AND codigoFicha = '$codigoFichaAnterior'";
        echo $query;
        mysql_query($query);
    }
    
    
}
?>