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
        'profesion'=>'PROFESION.csv',
        'establecimiento'=>'ESTABLECIMIENTO.csv',
        'capituloCIE10'=>'CAPITULOCIE10.csv',
        'grupoCIE10'=>'GRUPOCIE10.csv',
        'categoriaCIE10'=>'CATEGORIACIE10.csv',
        'catalogoCIE10'=>'CATALOGOCIE10.csv',
        'catalogoUPS'=>'CATALOGOUPS.csv',
        'catalogoCPT'=>'CATALOGOCPT.csv',
        'tipoTransmisibleCIE10'=>'TIPOTRANSMISIBLECIE10.csv',
        'etapaVida'=>'ETAPAVIDA.csv',
        'catalogoEpisodio'=>'CATALOGOEPISODIO.csv',
        'catalogoPerfil'=>'CATALOGOPERFIL.csv',
        'catalogoPrestacion'=>'CATALOGOPRESTACION.csv',
        'catalogoPrestacionPerfil'=>'CATALOGOPRESTACIONPERFIL.csv',
        'catalogoVacuna'=>'CATALOGOVACUNA.csv',
        'catalogoPerfilLaboratorio'=>'CATALOGOPERFILLABORATORIO.csv',
        'catalogoExamenLaboratorio'=>'CATALOGOEXAMENLABORATORIO.csv',
        'catalogoEpisodioPrestacion'=>'CATALOGOEPISODIOPRESTACION.csv',
        'catalogoConsejeria'=>'CATALOGOCONSEJERIA.csv',
        'programacionVacuna'=>'PROGRAMACIONVACUNA.csv',
        'equivalenciasCodigo'=>'EQUIVALENCIASCODIGO.csv',
        'catalogoMedicamento'=>'CATALOGOMEDICAMENTO.csv',
        'catalogoInsumo'=>'CATALOGOINSUMO.csv',
        'catalogoColegio'=>'CATALOGOCOLEGIO.csv',
        'condicionTrabajador'=>'CONDICIONTRABAJADOR.csv',
        );
    //echo "'$_REQUEST[tabla]' '$_REQUEST[archivo]'";
    
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
        
        //$a = str_replace('&#65279;', '');
        
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE){
            //Insertamos los datos con los valores...
            eval("\$valores = \"$values\";");
            $sql = "INSERT IGNORE INTO $tabla VALUES(".$valores.")";
            mysql_query($sql);// or die(mysql_error());
        }
        //cerramos la lectura del archivo "abrir archivo" con un "cerrar archivo"
        fclose($handle);
    }
?>