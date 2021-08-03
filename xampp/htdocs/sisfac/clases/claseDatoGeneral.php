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
class DatoGeneral {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function obtenerMaximoID($codigo, $tabla){
        $row = mysql_fetch_array(mysql_query("SELECT MAX($codigo) + 1 FROM $tabla"));
        if(!$row[0]) return 1;
        else return $row[0];
    }
    
    public function obtenerMaximoIDHistorial($codigo, $tabla){
        $row = mysql_fetch_array(mysql_query("SELECT MAX($codigo) + 1 FROM $tabla WHERE claveGeneral = '$_SESSION[claveGeneral]'"));
        if(!$row[0]) return 1;
        else return $row[0];
    }
    
    public function agregarDatoGeneral($claves,$claveGeneral,$lugarCentral,$claveGeneralAnterior) {
        $claveGeneral = aMayusculas($claveGeneral);
        $lugarCentral = aMayusculas($lugarCentral);
        
        $row = mysql_fetch_array(mysql_query("SELECT claveGeneral,claves FROM datoGeneral"));
        if($row[0] == '' && $row[1] == ''){
            mysql_query("INSERT INTO datoGeneral(claves,claveGeneral,lugarCentral) VALUES('$claves','$claveGeneral','$lugarCentral')");
        }else{
            mysql_query("UPDATE datoGeneral SET claves='$claves' ,claveGeneral='$claveGeneral' WHERE claveGeneral ='$row[0]'");
        }
        
        if($row[0]!= ''){
            $result = mysql_query("SHOW FULL TABLES FROM bdsicfic") ;
            while ($row = mysql_fetch_array($result)) {
                $query = "UPDATE $row[0] SET claveGeneral = '$claveGeneral' WHERE claveGeneral = '$claveGeneralAnterior'";
                mysql_query($query);
                //echo $query;
            }
        }
        $_SESSION['claveGeneral'] = "$claveGeneral";
        $_SESSION['claves'] = "$claves";
        $_SESSION['lugarCentral'] = "$lugarCentral";
        /*
        
        mysql_query("UPDATE vista SET claveGeneral = '$claveGeneral'");
        mysql_query("UPDATE usuario SET claveGeneral = '$claveGeneral'");
        mysql_query("UPDATE vistaUsuario SET claveGeneral = '$claveGeneral'");
        mysql_query("UPDATE region SET claveGeneral = '$claveGeneral'");
        mysql_query("UPDATE provincia SET claveGeneral = '$claveGeneral'");
        mysql_query("UPDATE distrito SET claveGeneral = '$claveGeneral'");
        mysql_query("UPDATE establecimiento SET claveGeneral = '$claveGeneral'");
        mysql_query("UPDATE diresa SET claveGeneral = '$claveGeneral'");
        mysql_query("UPDATE red SET claveGeneral = '$claveGeneral'");
        mysql_query("UPDATE microred SET claveGeneral = '$claveGeneral'");
        mysql_query("UPDATE nucleo SET claveGeneral = '$claveGeneral'");
        
        $_SESSION['claveGeneral'] = "$claveGeneral";
        $_SESSION['claves'] = "$claves";
        $_SESSION['lugarCentral'] = "$lugarCentral";
         * 
         */
    }
    
    public function actualizaEstablecimiento($claveGeneral,$claveGeneralAnterior){
        if($claveGeneralAnterior != ''){
            $result = mysql_query("SHOW FULL TABLES FROM bdsicfic") ;
            while ($row = mysql_fetch_array($result)) {
                $query = "UPDATE $row[0] SET claveGeneral = '$claveGeneral' WHERE claveGeneral = '$claveGeneralAnterior'";
                mysql_query($query);
                echo $query;
            }
        }
        
    }
    
    public function sumarFechas($fecha1, $dias){
        $row = mysql_fetch_array(mysql_query("SELECT DATE_FORMAT(DATE_ADD('$fecha1', INTERVAL $dias DAY),'%d/%m/%Y')"));
        return $row[0];
    }
    
    public function obtenerIdEtapaVida($nombreEtapa) {
        $row = mysql_fetch_array(mysql_query("SELECT idetapaVida FROM etapaVida WHERE nombreEtapa = '$nombreEtapa'"));
        return $row[0];
    }
    
}
?>