<?php

/*
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.

*/
     //$filename = $_FILES['archivo']['tmp_name'];
    $array = array(
        //'capituloCIE10'=>'CAPITULOCIE10.csv',
        //'grupoCIE10'=>'GRUPOCIE10.csv',
        //'categoriaCIE10'=>'CATEGORIACIE10.csv',
        //'catalogoCIE10'=>'CATALOGOCIE10.csv',
        //'catalogoUPS'=>'CATALOGOUPS.csv',
        //'catalogoCPT'=>'CATALOGOCPT.csv',
        //'tipoTransmisibleCIE10'=>'TIPOTRANSMISIBLECIE10.csv',
        'etapaVida'=>'ETAPAVIDA.csv',
        //'catalogoEpisodio'=>'CATALOGOEPISODIO.csv',
        //'catalogoPerfil'=>'CATALOGOPERFIL.csv',
        //'catalogoPrestacion'=>'CATALOGOPRESTACION.csv',
        //'catalogoPrestacionPerfil'=>'CATALOGOPRESTACIONPERFIL.csv',
        //'catalogoVacuna'=>'CATALOGOVACUNA.csv',
        //'catalogoPerfilLaboratorio'=>'CATALOGOPERFILLABORATORIO.csv',
        //'catalogoExamenLaboratorio'=>'CATALOGOEXAMENLABORATORIO.csv',
        //'catalogoEpisodioPrestacion'=>'CATALOGOEPISODIOPRESTACION.csv',
        //'catalogoConsejeria'=>'CATALOGOCONSEJERIA.csv',
        //'programacionVacuna'=>'PROGRAMACIONVACUNA.csv',
        //'equivalenciasCodigo'=>'EQUIVALENCIASCODIGO.csv',
        //'catalogoMedicamento'=>'CATALOGOMEDICAMENTO.csv',
        //'catalogoInsumo'=>'CATALOGOINSUMO.csv',
        'catalogoColegio'=>'CATALOGOCOLEGIO.csv',
        'condicionTrabajador'=>'CONDICIONTRABAJADOR.csv',
        'profesion'=>'PROFESION.csv',
        'region'=>'REGION.csv',
        'provincia'=>'PROVINCIA.csv',
        'distrito'=>'DISTRITO.csv',
        'diresa'=>'DIRESA.csv',
        'red'=>'RED.csv',
        'microred'=>'MICRORED.csv',
        'nucleo'=>'NUCLEO.csv',
        'establecimiento'=>'ESTABLECIMIENTO.csv'
        );
    
    $temp=0;
    
    //$campos = mysql_num_fields(mysql_query("SELECT * FROM region"));
    //echo '---------'.numeroColumma('region', 'provincia.csv').'--------'.$campos;
    
    foreach ($array as $tabla => $archivo) {
        $filas = mysql_num_rows(mysql_query("SELECT * FROM $tabla"));

        $query = "SHOW COLUMNS FROM $tabla LIKE 'claveGeneral'";
        $temp = mysql_num_rows(mysql_query($query));
        if($temp > 0){
            if($tabla!='establecimiento'){
                $query1 = "ALTER TABLE $tabla DROP claveGeneral";
                mysql_query($query1);
            }        
        }
        
        if($filas != numeroRegistro($tabla, $archivo) || $temp>0 ){
            if($filas != numeroRegistro($tabla, $archivo)){
                $query2 = "TRUNCATE $tabla";
                mysql_query($query2);
                importarArchivo($tabla, $archivo);
            }
        }
        
        
        if($tabla == 'region'){
            $query = "SELECT codigoRegion FROM region LIMIT 0,1";
            $row = mysql_fetch_array(mysql_query($query));
            if($row[0] == ''){
                $query2 = "TRUNCATE $tabla";
                mysql_query($query2);
                importarArchivo($tabla, $archivo);
            }
        }
    }
    
    function importarArchivo($tabla, $archivo){
        $result = mysql_query("SELECT * FROM $tabla");
        $nroCampos = mysql_num_fields($result);
        $values = "";
        for ($i = 0; $i < $nroCampos; $i++) {
            $values .= "'$"."data[$i]',";
        }
        $values = substr($values, 0, -1);
        $handle = fopen("app/catalogos/$archivo", "r");
        
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE){
            //Insertamos los datos con los valores...
            eval("\$valores = \"$values\";");
            //$valores = str_replace('&#65279;', '', $valores);
            $sql = "INSERT IGNORE INTO $tabla VALUES(".$valores.")";
            //echo $sql;
            mysql_query($sql);// or die(mysql_error());
        }
        //cerramos la lectura del archivo "abrir archivo" con un "cerrar archivo"
        fclose($handle);
    }
    
    function numeroRegistro($tabla, $archivo){
        $handle = fopen("app/catalogos/$archivo", "r");
        $cont=0;
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE){
            $cont++;
        }
        fclose($handle);
        return $cont;
    }
    
    function numeroColumma($tabla, $archivo){
        $fila = 1;
        $handle = fopen("app/catalogos/$archivo", "r");
        while (($datos = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $numero = count($datos);
        }
        fclose($handle);
        return $numero;
    }
    
    /*
    foreach ($array as $tabla => $archivo) {
        //mysql_query("TRUNCATE TABLE $tabla");
        //echo "SELECT * FROM $tabla".'<br/>';
        $result = mysql_query("SELECT * FROM $tabla");
        $nroCampos = mysql_num_fields($result);
        $values = "";
        for ($i = 0; $i < $nroCampos; $i++) {
            $values .= "'$"."data[$i]',";
        }
        $values = substr($values, 0, -1);
        $handle = fopen("app/catalogos/$archivo", "r");
        
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE){
            //Insertamos los datos con los valores...
            eval("\$valores = \"$values\";");
            //$valores = str_replace('&#65279;', '', $valores);
            $sql = "INSERT IGNORE INTO $tabla VALUES(".$valores.")";
            //echo $sql;
            mysql_query($sql);// or die(mysql_error());
        }
        //cerramos la lectura del archivo "abrir archivo" con un "cerrar archivo"
        fclose($handle);
    }*/
?>


