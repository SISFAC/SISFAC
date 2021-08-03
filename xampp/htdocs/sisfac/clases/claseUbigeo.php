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
class Ubigeo {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function getCombo($tipo, $ubigeo_id){

        if ($tipo == "diresa"){
            
            $query = "SELECT iddiresa, nombreDiresa FROM diresa ORDER BY nombreDiresa";
            $result = mysql_query($query);
              if (!$result) {
                echo 'No se pudo ejecutar la consulta: ' . mysql_error();
                exit;
            } 
            $select = "<select>";
            $select .= "<option value=\"0\">Selecciona</option>";
             
            while ($row = mysql_fetch_row($result)) {
                $select .= "<option value = ".$row[0].">".$row[1]."</option>";
            }
            $select .= "</select>";

            return $select;

        }else if($tipo == "red" && isset($ubigeo_id)){

            $query = "SELECT idred, nombrered FROM red where iddiresa=$ubigeo_id ORDER BY nombrered";
        
            $result = mysql_query($query);

            $select = "<select>";
            $select .= "<option value=\"0\">Selecciona</option>";
                //$iddiresa = explode('-', $_SESSION[claves]);
            while ($row = mysql_fetch_row($result)) {
                $select .= "<option value = ".$row[0].">".$row[1]."</option>";
            }
            $select .= "</select>";

            return $select;


        }else if($tipo == "microred" && isset($ubigeo_id)){

            $query = "SELECT idmicrored, nombremicrored FROM microred where idred=$ubigeo_id ORDER BY nombremicrored";
            $result = mysql_query($query);
            $select = "<select>";
            $select .= "<option value=\"0\">Selecciona</option>";
                //$iddiresa = explode('-', $_SESSION[claves]);
            while ($row = mysql_fetch_row($result)) {
                $select .= "<option value = ".$row[0].">".$row[1]."</option>";
            }
            $select .= "</select>";

            return $select;


        }else if($tipo == "establecimiento" && isset($ubigeo_id)){

            $query = "SELECT e.idestablecimiento, e.nombreestablecimiento FROM establecimiento e inner join nucleo n on (n.idnucleo=e.idnucleo) where idmicrored=$ubigeo_id ORDER BY e.nombreestablecimiento";
            $result = mysql_query($query);
            $select = "<select>";
            $select .= "<option value=\"0\">Selecciona</option>";
                //$iddiresa = explode('-', $_SESSION[claves]);
            while ($row = mysql_fetch_row($result)) {
                $select .= "<option value = ".$row[0].">".$row[1]."</option>";
            }
            $select .= "</select>";

            return $select;


        }else if($tipo == "comunidad"){

            $query = "SELECT idcomunidad, nombrecomunidad FROM comunidad where idestablecimiento=$ubigeo_id  ORDER BY nombrecomunidad";
            $result = mysql_query($query);
            $select = "<select>";
            $select .= "<option value=\"0\">Selecciona</option>";
            while ($row = mysql_fetch_row($result)) {
                $select .= "<option value = ".$row[0].">".$row[1]."</option>";
            }
            $select .= "</select>";

            return $select;

        }
    }
    
}
?>