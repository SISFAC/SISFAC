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
require_once '../upgrade.php';
class MigracionComunidad {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function migraComunidad($establecimiento_origen, $comunidad_origen, $establecimiento_destino){
    
        $sql = "";
        $sql2 = "";

        $corigen = mysql_query("select nombreComunidad from comunidad where idcomunidad = $comunidad_origen and idestablecimiento = $establecimiento_origen");

        $origen = mysql_query("select claveGeneral, nombreestablecimiento from establecimiento where idestablecimiento = $establecimiento_origen");

        $destino = mysql_query("select claveGeneral, nombreestablecimiento from establecimiento where idestablecimiento = $establecimiento_destino");

 
        if(mysql_num_rows($origen)>0 && mysql_num_rows($destino)>0){


            $r = mysql_fetch_array($origen);
            $claveGeneralO = $r[0];

            $r = mysql_fetch_array($corigen);
            $nombreC = $r[0];

            $r = mysql_fetch_array($destino);
            $claveGeneralE = "M" . substr($r[0], 1);
            $claveGeneralD = $r[0];
            $nombreE = $r[1];


            $sql .= "INSERT INTO comunidad(idcomunidad, claveGeneral, idestablecimiento, nombreComunidad) VALUES(1,'$claveGeneralE',$establecimiento_destino,'$nombreC')** ";

            $sql2 .= "delete from comunidad where idcomunidad=$comunidad_origen and claveGeneral='$claveGeneralO'; ";


            $tables =  mysql_query("SELECT
                        TABLE_NAME, COLUMN_NAME, COUNT(TABLE_NAME)
                        FROM information_schema.columns WHERE
                        column_name = 'idpersona' OR COLUMN_NAME='idfamilia'
                        GROUP BY TABLE_NAME");


            while ($row = mysql_fetch_array($tables)) {

                $resultcampos = mysql_query("DESCRIBE $row[0]");
                $arraycampos = [];

                while ($rowcampos = mysql_fetch_array($resultcampos)) {

                    $arraycampos[] = "$rowcampos[0]";

                }
                $campos = implode(",", $arraycampos);

                if(strpos($campos, 'claveGeneral')!==false) {


                    if($row[2]==1 && $row[1]=="idfamilia"){


                        $querydatos = "SELECT $campos FROM $row[0] WHERE claveGeneral='$claveGeneralO' and idfamilia 
                            IN (select idfamilia from familia 
                            where idestablecimiento = $establecimiento_origen and idcomunidad = $comunidad_origen)";


                        if($row[0]!="familia"){

                            $sql2 .= "delete $row[0] from $row[0] left join familia on($row[0].idfamilia=familia.idfamilia and $row[0].claveGeneral=familia.claveGeneral) WHERE $row[0].claveGeneral='$claveGeneralO' and familia.idestablecimiento = $establecimiento_origen and familia.idcomunidad = $comunidad_origen;";
                            
                        }
                    }else{


                        $querydatos = "SELECT $campos FROM $row[0] WHERE claveGeneral='$claveGeneralO' and idpersona 
                                IN (select p.idpersona from persona p inner join familia f on(f.idfamilia=p.idfamilia and f.claveGeneral=p.claveGeneral) 
                                where f.idestablecimiento = $establecimiento_origen and f.idcomunidad = $comunidad_origen)";


                        if($row[0]!="persona"){

                            $sql2 .= "delete $row[0] from $row[0] left join persona on($row[0].idpersona=persona.idpersona and $row[0].claveGeneral=persona.claveGeneral) left join familia on(persona.idfamilia=familia.idfamilia and persona.claveGeneral=familia.claveGeneral) WHERE $row[0].claveGeneral='$claveGeneralO' and familia.idestablecimiento = $establecimiento_origen and familia.idcomunidad = $comunidad_origen;";
                            
                        }


                    }

                    $resultdatos = mysql_query($querydatos);
                    $tregistros = mysql_num_rows($resultdatos);
                    if($tregistros>0){

                        $sql .= "INSERT INTO $row[0]($campos) VALUES ";

                        $j=0;
                        while ($rowdatos = mysql_fetch_array($resultdatos)) {
                            $datos=$coma=$coma1="";
                            for ($i = 0; $i < count($arraycampos); $i++) {

                                if($arraycampos[$i] == "claveGeneral"){
                                    $datos .= $coma."'$claveGeneralE'";
                                }elseif($row[0]=="familia" && $arraycampos[$i] == "idcomunidad"){
                                    $datos .= $coma."0";
                                }elseif($row[0]=="familia" && $arraycampos[$i] == "nombreComunidad"){
                                    $datos .= $coma."'$nombreC'";
                                }elseif($row[0]=="familia" && $arraycampos[$i] == "idestablecimiento"){
                                    $datos .= $coma.$establecimiento_destino;
                                }elseif($row[0]=="familia" && $arraycampos[$i] == "nombreEstablecimiento"){
                                    $datos .= $coma."'$nombreE'";
                                }else{
                                    $datos .= $coma."'".$rowdatos[$arraycampos[$i]]."'";
                                }


                                $coma=",";
                            }
                            if($j==$tregistros-1) $coma1="**";
                            else $coma1=",";
                            $sql .= " ($datos)$coma1 ";
                            $j++;
                        }
                    }

                }
            }

            $sql2 .= "delete persona from persona left join familia on(persona.idfamilia=familia.idfamilia and familia.claveGeneral=persona.claveGeneral) WHERE persona.claveGeneral='$claveGeneralO' and familia.idestablecimiento = $establecimiento_origen and familia.idcomunidad = $comunidad_origen;";
            $sql2 .= "delete from familia where idestablecimiento = $establecimiento_origen and idcomunidad = $comunidad_origen;";


            $tables =  mysql_query("SELECT
                        TABLE_NAME, COLUMN_NAME, COUNT(TABLE_NAME)
                        FROM information_schema.columns WHERE
                        column_name = 'idpersonaH' OR COLUMN_NAME='idfamiliaH'
                        GROUP BY TABLE_NAME");

            while ($row = mysql_fetch_array($tables)) {

                $resultcampos = mysql_query("DESCRIBE $row[0]");
                $arraycampos = [];

                while ($rowcampos = mysql_fetch_array($resultcampos)) {

                    $arraycampos[] = "$rowcampos[0]";

                }
                $campos = implode(",", $arraycampos);

                if(strpos($campos, 'claveGeneral')!==false) {


                    if($row[2]==1 && $row[1]=="idfamiliaH"){


                        $querydatos = "SELECT $campos FROM $row[0] WHERE claveGeneral='$claveGeneralO' and idfamiliaH 
                            IN (select idfamiliaH from familiaH 
                            where idestablecimiento = $establecimiento_origen and idcomunidad = $comunidad_origen)";

                        if($row[0]!="familiah"){

                            $sql2 .= "delete $row[0] from $row[0] left join familiah on($row[0].idfamiliaH=familiah.idfamiliaH and $row[0].claveGeneral=familiah.claveGeneral) WHERE $row[0].claveGeneral='$claveGeneralO' and familiah.idestablecimiento = $establecimiento_origen and familiah.idcomunidad = $comunidad_origen;";

                        }

                    }else{


                        $querydatos = "SELECT $campos FROM $row[0] WHERE claveGeneral='$claveGeneralO' and idpersonaH 
                                IN (select p.idpersonaH from personaH p inner join familiaH f on(f.idfamiliaH=p.idfamiliaH and f.claveGeneral=p.claveGeneral) 
                                where f.idestablecimiento = $establecimiento_origen and f.idcomunidad = $comunidad_origen)";

                        if($row[0]!="personah"){


                            $sql2 .= "delete $row[0] from $row[0] left join personah on($row[0].idpersonah=personah.idpersonah and $row[0].claveGeneral=personah.claveGeneral) left join familiah on(personah.idfamiliaH=familiah.idfamiliaH and personah.claveGeneral=familiah.claveGeneral) WHERE $row[0].claveGeneral='$claveGeneralO' and familiah.idestablecimiento = $establecimiento_origen and familiah.idcomunidad = $comunidad_origen;";
                        }

                    }

                    $resultdatos = mysql_query($querydatos);
                    $tregistros = mysql_num_rows($resultdatos);
                    if($tregistros>0){

                        $sql .= "INSERT INTO $row[0]($campos) VALUES ";

                        $j=0;
                        while ($rowdatos = mysql_fetch_array($resultdatos)) {
                            $datos=$coma=$coma1="";
                            for ($i = 0; $i < count($arraycampos); $i++) {

                                if($arraycampos[$i] == "claveGeneral"){
                                    $datos .= $coma."'$claveGeneralE'";
                                }elseif($row[0]=="familiaH" && $arraycampos[$i] == "idcomunidad"){
                                    $datos .= $coma."0";
                                }elseif($row[0]=="familiaH" && $arraycampos[$i] == "nombreComunidad"){
                                    $datos .= $coma."'$nombreC'";
                                }elseif($row[0]=="familiaH" && $arraycampos[$i] == "idestablecimiento"){
                                    $datos .= $coma.$establecimiento_destino;
                                }elseif($row[0]=="familiaH" && $arraycampos[$i] == "nombreEstablecimiento"){
                                    $datos .= $coma."'$nombreE'";
                                }else{
                                    $datos .= $coma."'".$rowdatos[$arraycampos[$i]]."'";
                                }


                                $coma=",";
                            }
                            if($j==$tregistros-1) $coma1="**";
                            else $coma1=",";
                            $sql .= " ($datos)$coma1 ";
                            $j++;
                        }
                    }

                    
                }
            }
                    $sql2 .= "delete personah from personah left join familiah on(personah.idfamiliah=familiah.idfamiliah and familiah.claveGeneral=personah.claveGeneral) WHERE personah.claveGeneral='$claveGeneralO' and familiah.idestablecimiento = $establecimiento_origen and familiah.idcomunidad = $comunidad_origen;";

                    $sql2 .= "delete from familiah where idestablecimiento = $establecimiento_origen and idcomunidad = $comunidad_origen;";

        }

        mysql_query($sql2);
        return $sql;
  

    }
    
}
?>