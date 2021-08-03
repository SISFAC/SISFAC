<?php ?><?php
/*
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.

*/
class Conexion {
    //put your code here
    private $cnn;
    //private $cadenaConexion=;
    public function __construct() {;
    }
    public function abrirConexion() {
        $this->cnn = mysql_connect('localhost', 'root', 'Admin$123') or die(mysql_error());
        mysql_select_db('bdsicfic') or die(mysql_error());
        return $this->cnn;
    }
    public function cerrarConexion() {
        if (!mysql_close($this->cnn)) {
            mysql_close($this->cnn);
        } else {
            $this->abrirConexion();
        }
    }
}
function Strip($value) {
    if (get_magic_quotes_gpc() != 0) {
        if (is_array($value)) if (array_is_associative($value)) {
            foreach ($value as $k => $v) $tmp_val[$k] = stripslashes($v);
            $value = $tmp_val;
        } else for ($j = 0;$j < sizeof($value);$j++) $value[$j] = stripslashes($value[$j]);
        else $value = stripslashes($value);
    }
    return $value;
}
function array_is_associative($array) {
    if (is_array($array) && !empty($array)) {
        for ($iterator = count($array) - 1;$iterator;$iterator--) {
            if (!array_key_exists($iterator, $array)) {
                return true;
            }
        }
        return !array_key_exists(0, $array);
    }
    return false;
}
function obtenerPaginacion($query, $limit, $page) {
    $result = mysql_query($query);
    $row = mysql_fetch_array($result);
    $count = $row[0];
    if ($count > 0) {
        $total_pages = ceil($count / $limit);
    } else {
        $total_pages = 0;
    }
    if ($page > $total_pages) $page = $total_pages;
    $start = $limit * $page - $limit;
    if ($start < 0) $start = 0;
    $array = array();
    $array[0] = $start;
    $array[1] = $count;
    $array[2] = $total_pages;
    return $array;
}
function obtenerXML($page, $count, $total_pages, $query) {
    $result = mysql_query($query);
    $numeroCampo = mysql_num_fields($result);
    if (stristr($_SERVER["HTTP_ACCEPT"], "application/xhtml+xml")) {
        header("Content-type: application/xhtml+xml;charset=utf-8");
    } else {
        header("Content-type: text/xml;charset=utf-8");
    }
    $et = ">";
    echo "<?xml version='1.0' encoding='utf-8'?$et
";
    echo "<rows>";
    echo "<page>" . $page . "</page>";
    echo "<total>" . $total_pages . "</total>";
    echo "<records>" . $count . "</records>";
    while ($row = mysql_fetch_array($result)) {
        echo "<row id='" . $row[0] . "'>";
        for ($i = 0;$i < $numeroCampo;$i++) {
            //echo "<cell>". utf8_decode($row[$i])."</cell>";
            echo "<cell>" . utf8_encode($row[$i]) . "</cell>";
            //echo "<cell>". $row[$i]."</cell>";
            
        }
        echo "</row>";
    }
    echo "</rows>";
}
function formatoFecha($fecha) {
    if (trim($fecha) == '') return '';
    else {
        $fecha = explode('/', $fecha);
        return $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];
    }
}
function array_to_json($array) {
    if (!is_array($array)) {
        return false;
    }
    $associative = count(array_diff(array_keys($array), array_keys(array_keys($array))));
    if ($associative) {
        $construct = array();
        foreach ($array as $key => $value) {
            // We first copy each key/value pair into a staging array,
            // formatting each key and value properly as we go.
            // Format the key:
            if (is_numeric($key)) {
                $key = "key_$key";
            }
            $key = "\"" . addslashes($key) . "\"";
            // Format the value:
            if (is_array($value)) {
                $value = array_to_json($value);
            } else if (!is_numeric($value) || is_string($value)) {
                $value = "\"" . addslashes($value) . "\"";
            }
            // Add to staging array:
            $construct[] = "$key: $value";
        }
        // Then we collapse the staging array into the JSON form:
        $result = "{ " . implode(", ", $construct) . " }";
    } else { // If the array is a vector (not associative):
        $construct = array();
        foreach ($array as $value) {
            // Format the value:
            if (is_array($value)) {
                $value = array_to_json($value);
            } else if (!is_numeric($value) || is_string($value)) {
                $value = "'" . addslashes($value) . "'";
            }
            // Add to staging array:
            $construct[] = $value;
        }
        // Then we collapse the staging array into the JSON form:
        $result = "[ " . implode(", ", $construct) . " ]";
    }
    return $result;
}
function formatoNumero($numero, $decimales) {
    if ($numero == '') $numero = 0;
    return number_format($numero, $decimales, '.', '');
}
function numerosCeros($digitos) {
    for ($i = 0;$i < $digitos;$i++) {
        $temp.= '0';
    }
    return $temp;
}
function obtenerMes($mes) {
    if ($mes == 1) $mes = "ENERO";
    elseif ($mes == 2) $mes = "FEBRERO";
    elseif ($mes == 3) $mes = "MARZO";
    elseif ($mes == 4) $mes = "ABRIL";
    elseif ($mes == 5) $mes = "MAYO";
    elseif ($mes == 6) $mes = "JUNIO";
    elseif ($mes == 7) $mes = "JULIO";
    elseif ($mes == 8) $mes = "AGOSTO";
    elseif ($mes == 9) $mes = "SEPTIEMBRE";
    elseif ($mes == 10) $mes = "OCTUBRE";
    elseif ($mes == 11) $mes = "NOVIEMBRE";
    elseif ($mes == 12) $mes = "DICIEMBRE";
    return $mes;
}
function aMayusculas($cadena) {
    //$cadena = strtr(strtoupper($cadena),'&#224;&#225;&#226;&#227;&#228;&#229;&#230;&#231;&#232;&#233;&#234;&#235;&#236;&#237;&#238;&#239;&#240;&#241;&#242;&#243;&#244;&#245;&#246;&#248;&#249;&#252;&#250;','&#192;&#193;&#194;&#195;&#196;&#197;&#198;&#199;&#200;&#201;&#202;&#203;&#204;&#205;&#206;&#207;&#208;&#209;&#210;&#211;&#212;&#213;&#214;&#216;&#217;&#220;&#218;');
    $cadena = mb_strtoupper($cadena, "utf-8");
    //$cadena = strtr(strtoupper($cadena),'&#225;&#233;&#237;&#243;&#250;','&#193;&#201;&#205;&#211;&#218;');
    return $cadena;
}
function verificarDatos($accion, $data) {
    if ($accion == 'add') {
        foreach ($data as $nombre => $value) {
            $value = aMayusculas($value);
            if (trim($value)) {
                $c.= ",$nombre";
                $v.= ",'$value'";
            }
        }
    } else {
        foreach ($data as $nombre => $value) {
            $value = aMayusculas($value);
            if (trim($value)) $c.= ",$nombre='$value'";
        }
    }
    $array = array();
    $array[0] = substr($c, 1);
    $array[1] = substr($v, 1);
    return $array;
}
function obtenerEdad($fecha_de_nacimiento) {
    $array_nacimiento = explode("-", $fecha_de_nacimiento);
    $array_actual = explode("-", date("Y-m-d"));
    //echo $array_actual[0]."<br>";
    //echo $fecha_de_nacimiento;
    $anos = $array_actual[0] - $array_nacimiento[0]; // calculamos a&#241;os
    $meses = $array_actual[1] - $array_nacimiento[1]; // calculamos meses
    $dias = $array_actual[2] - $array_nacimiento[2]; // calculamos d&#237;as
    //ajuste de posible negativo en $d&#237;as
    if ($dias < 0) {
        --$meses;
        //ahora hay que sumar a $dias los dias que tiene el mes anterior de la fecha actual
        switch ($array_actual[1]) {
            case 1:
                $dias_mes_anterior = 31;
            break;
            case 2:
                $dias_mes_anterior = 31;
            break;
            case 3:
                if (bisiesto($array_actual[0])) {
                    $dias_mes_anterior = 29;
                    break;
                } else {
                    $dias_mes_anterior = 28;
                    break;
                }
            case 4:
                $dias_mes_anterior = 31;
            break;
            case 5:
                $dias_mes_anterior = 30;
            break;
            case 6:
                $dias_mes_anterior = 31;
            break;
            case 7:
                $dias_mes_anterior = 30;
            break;
            case 8:
                $dias_mes_anterior = 31;
            break;
            case 9:
                $dias_mes_anterior = 31;
            break;
            case 10:
                $dias_mes_anterior = 30;
            break;
            case 11:
                $dias_mes_anterior = 31;
            break;
            case 12:
                $dias_mes_anterior = 30;
            break;
        }
        $dias = $dias + $dias_mes_anterior;
    }
    //ajuste de posible negativo en $meses
    if ($meses < 0) {
        --$anos;
        $meses = $meses + 12;
    }
    return "$anos anios, $meses meses y $dias dias";
}
function bisiesto($anio_actual) {
    $bisiesto = false;
    //probamos si el mes de febrero del a&#241;o actual tiene 29 d&#237;as
    if (checkdate(2, 29, $anio_actual)) {
        $bisiesto = true;
    }
    return $bisiesto;
}
function datoReporte($atributo, $seleccion) {
    if ($atributo == 'DISA/DIRESA') {
        if ($seleccion != '') $wh = " AND fam.iddiresa = '$seleccion'";
        $querygen = "SELECT DISTINCT iddiresa, nombreDiresa FROM diresa dir WHERE iddiresa = '$seleccion'";
        $campo = 'fam.iddiresa';
    } elseif ($atributo == 'REGION') {
        if ($seleccion != '') $wh = " AND fam.idregion = '$seleccion'";
        $querygen = "SELECT DISTINCT idregion, nombreRegion FROM region reg WHERE idregion = '$seleccion'";
        $campo = 'fam.idregion';
    } elseif ($atributo == 'PROVINCIA') {
        if ($seleccion != '') $wh = " AND fam.idprovincia = '$seleccion'";
        $querygen = "SELECT DISTINCT idprovincia, nompro FROM provincia pro WHERE idprovincia = '$seleccion'";
        $campo = 'fam.idprovincia';
    } elseif ($atributo == 'DISTRITO') {
        if ($seleccion != '') $wh = " AND fam.iddistrito = '$seleccion'";
        $querygen = "SELECT DISTINCT iddistrito, nombre FROM distrito dis WHERE iddistrito = '$seleccion'";
        $campo = 'fam.iddistrito';
    } elseif ($atributo == 'SECTOR') {
        if ($seleccion != '') $wh = " AND fam.idsector = '$seleccion'";
        $querygen = "SELECT DISTINCT idsector, nombreSector FROM sector sec INNER JOIN comunidad com ON sec.idcomunidad=com.idcomunidad WHERE idsector = '$seleccion'";
        $campo = 'fam.idsector';
    } elseif ($atributo == 'COMUNIDAD') {
        if ($seleccion != '') $wh = " AND fam.idcomunidad = '$seleccion'";
        $querygen = "SELECT DISTINCT idcomunidad, nombreComunidad FROM comunidad com WHERE idcomunidad = '$seleccion'";
        $campo = 'fam.idcomunidad';
    } elseif ($atributo == 'ESTABLECIMIENTO') {
        if ($seleccion != '') $wh = " AND fam.idestablecimiento = '$seleccion'";
        $querygen = "SELECT DISTINCT idestablecimiento, nombreEstablecimiento FROM establecimiento est WHERE idestablecimiento = '$seleccion'";
        $campo = 'fam.idestablecimiento';
    } elseif ($atributo == 'RED') {
        if ($seleccion != '') $wh = " AND fam.idred = '$seleccion'";
        $querygen = "SELECT DISTINCT idred, nombreRed FROM red WHERE idred = '$seleccion'";
        $campo = 'fam.idred';
    } elseif ($atributo == 'MICRORED') {
        if ($seleccion != '') $wh = " AND fam.idmicrored = '$seleccion'";
        $querygen = "SELECT DISTINCT idmicrored, nombreMicrored FROM microred mic WHERE idmicrored = '$seleccion'";
        $campo = 'fam.idmicrored';
    } elseif ($atributo == 'NUCLEO') {
        if ($seleccion != '') $wh = " AND fam.idnucleo = '$seleccion'";
        $querygen = "SELECT DISTINCT idnucleo, nombreNucleo FROM nucleo nuc WHERE idnucleo = '$seleccion'";
        $campo = 'fam.idnucleo';
    }
    return $wh . '-' . $querygen . '-' . $campo;
}
?>