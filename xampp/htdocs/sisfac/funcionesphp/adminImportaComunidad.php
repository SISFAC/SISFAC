<?php
/*
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.


*/
require_once '../clases/claseMigracionComunidad.php';

$migracionComunidad = new MigracionComunidad();

$uploadfile = $uploaddir .basename($_FILES['userfile']['name']);

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    $contenido = file_get_contents($uploadfile);
    $array = explode('**',$contenido);

    foreach ($array as $value) {

        if(trim($value) !='' ){
            $mq = mysql_query($value);

            if($mq==false){
                echo mysql_error();
            }
        
        }
        
    }


    $comunidadR = mysql_query("select idcomunidad, claveGeneral, idestablecimiento from comunidad where claveGeneral like 'M%'");

    $comunidad = mysql_fetch_array($comunidadR);

    $idComunidad = $comunidad[0];
    $claveGeneralT = $comunidad[1];
    $claveGeneral = str_replace("M", "0", $claveGeneralT);
    $idEstablecimiento = $comunidad[2];
    

    $maxR = mysql_query("select ifnull(max(idcomunidad), 0) from comunidad where claveGeneral='$claveGeneral'");
    $maxA = mysql_fetch_array($maxR);
    $idComunidad = $maxA[0]+1;

    mysql_query("update comunidad set idComunidad=$idComunidad, claveGeneral='$claveGeneral' where claveGeneral='$claveGeneralT'");


    $mnR = mysql_query("select ifnull(min(idfamilia), 0) from familia where claveGeneral='$claveGeneralT'");
    $mnA = mysql_fetch_array($mnR);
    $mnValue = $mnA[0]; 

    $mxR = mysql_query("select ifnull(max(idfamilia), 0) from familia where claveGeneral='$claveGeneral'");
    $mxA = mysql_fetch_array($mxR);
    $mxValue = $mxA[0];

    $diff = $mxValue-$mnValue+1; 

    mysql_query("update familia set idfamilia=idfamilia+$diff, idcomunidad=$idComunidad, claveGeneral='$claveGeneral' where claveGeneral='$claveGeneralT'");


    $mnR = mysql_query("select ifnull(min(idpersona), 0) from persona where claveGeneral='$claveGeneralT'");
    $mnA = mysql_fetch_array($mnR);
    $mnValue = $mnA[0]; 

    $mxR = mysql_query("select ifnull(max(idpersona), 0) from persona where claveGeneral='$claveGeneral'");
    $mxA = mysql_fetch_array($mxR);
    $mxValue = $mxA[0];

    $difp = $mxValue-$mnValue+1; 

    mysql_query("update persona set idpersona=idpersona+$difp, claveGeneral='$claveGeneral'  where claveGeneral='$claveGeneralT'");



        $tables =  mysql_query("SELECT TABLE_NAME, COLUMN_NAME, COUNT(TABLE_NAME)
                        FROM information_schema.columns WHERE
                        (column_name = 'idpersona' OR COLUMN_NAME='idfamilia') and TABLE_NAME<>'familia'
                        GROUP BY TABLE_NAME");


        while ($row = mysql_fetch_array($tables)) {

            $resultcampos = mysql_query("DESCRIBE $row[0]");
            $arraycampos = [];

            $rowcampos = mysql_fetch_array($resultcampos);

            $idField = $rowcampos[0];
           
            $mnR = mysql_query("select ifnull(min($idField), 0) from $row[0] where claveGeneral='$claveGeneralT'");
            $mnA = mysql_fetch_array($mnR);
            $mnValue = $mnA[0]; 

            $mxR = mysql_query("select ifnull(max($idField), 0) from $row[0] where claveGeneral='$claveGeneral'");
            $mxA = mysql_fetch_array($mxR);
            $mxValue = $mxA[0];

            $factor = $mxValue-$mnValue; 

            $result = mysql_query("SELECT $idField FROM $row[0] WHERE claveGeneral='$claveGeneralT'");   

            while ($tr = mysql_fetch_array($result)) {  

                $idValue = $tr[0]+$factor+1;  

                if($row[2]==1 && $row[1]=="idfamilia"){

                    mysql_query("update $row[0] set $idField=$idValue, idfamilia=idfamilia+$diff, claveGeneral='$claveGeneral' where $idField=$tr[0] and claveGeneral='$claveGeneralT'");

                }elseif($row[2]==1 && $row[1]=="idpersona"){

                    mysql_query("update $row[0] set $idField=$idValue, idpersona=idpersona+$difp, claveGeneral='$claveGeneral' where $idField=$tr[0] and claveGeneral='$claveGeneralT'");

                }else{

                    mysql_query("update $row[0] set $idField=$idValue, idfamilia=idfamilia+$diff, idpersona=idpersona+$difp, claveGeneral='$claveGeneral' where $idField=$tr[0] and claveGeneral='$claveGeneralT'");

                }
            }

          
        }       





   
 
    if(needToUpgrade()){

        upgrade();
    }      

}
else {
    echo "error";
}

?>