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

class ClaseCopiaBD {
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }
    
    public function exportarBD(){



        $querytablas = "SHOW TABLES";
        $resulttablas = mysql_query($querytablas);
        while ($rowtablas = mysql_fetch_array($resulttablas)) {
            if($rowtablas[0] == 'usuario'){}
            elseif($rowtablas[0] == 'vistausuario'){}
            elseif($rowtablas[0] == 'vista'){}
            elseif($rowtablas[0] == 'region'){}
            elseif($rowtablas[0] == 'provincia'){}
            elseif($rowtablas[0] == 'distrito'){}
            elseif($rowtablas[0] == 'diresa'){}
            elseif($rowtablas[0] == 'red'){}
            elseif($rowtablas[0] == 'microred'){}
            elseif($rowtablas[0] == 'nucleo'){}
            elseif($rowtablas[0] == 'acopio'){}
            //elseif($rowtablas[0] == 'establecimiento'){}
            elseif($rowtablas[0] == 'capitulocie10'){}
            elseif($rowtablas[0] == 'catalogocie10'){}
            elseif($rowtablas[0] == 'catalogoColegio'){}
            elseif($rowtablas[0] == 'catalogoconsejeria'){}
            elseif($rowtablas[0] == 'catalogocpt'){}
            elseif($rowtablas[0] == 'catalogoepisodio'){}
            elseif($rowtablas[0] == 'catalogoepisodioprestacion'){}
            elseif($rowtablas[0] == 'catalogoexamenlaboratorio'){}
            elseif($rowtablas[0] == 'catalogoinsumo'){}
            elseif($rowtablas[0] == 'catalogomedicamento'){}
            elseif($rowtablas[0] == 'catalogoperfil'){}
            elseif($rowtablas[0] == 'catalogoperfillaboratorio'){}
            elseif($rowtablas[0] == 'catalogoprestacion'){}
            elseif($rowtablas[0] == 'catalogoprestacionperfil'){}
            elseif($rowtablas[0] == 'catalogoups'){}
            elseif($rowtablas[0] == 'catalogovacuna'){}
            elseif($rowtablas[0] == 'categoriacie10'){}
            elseif($rowtablas[0] == 'colegioprofesional'){}
            elseif($rowtablas[0] == 'condiciontrabajador'){}
            elseif($rowtablas[0] == 'equivalenciascodigo'){}
            elseif($rowtablas[0] == 'establecimiento'){}
            elseif($rowtablas[0] == 'etapavida'){}
            elseif($rowtablas[0] == 'grupocie10'){}
            elseif($rowtablas[0] == 'profesion'){}
            elseif($rowtablas[0] == 'programacionvacuna'){}
            elseif($rowtablas[0] == 'tipotransmisiblecie10'){}
            else{
                $querycampos = "DESCRIBE $rowtablas[0]";
                $resultcampos = mysql_query($querycampos);
                while ($rowcampos = mysql_fetch_array($resultcampos)) {
                    $campos .= "$coma $rowcampos[0]";
                    $arraycampos[] = "$rowcampos[0]";
                    $nrocampos++;
                    $coma=",";
                }
                $coma = "";

                if($rowtablas[0] != 'datogeneral') $wh = " ORDER BY id$rowtablas[0] desc";
                else $wh = "";
                
                if(strpos($campos, 'claveGeneral')!==false) {
                    $querydatos = "SELECT $campos FROM $rowtablas[0] WHERE claveGeneral = '$_SESSION[claveGeneral]' $wh";
                    $resultdatos = mysql_query($querydatos);
                    //echo $querydatos;
                    //$contenido.=$querydatos.';';
                    $tregistros = mysql_num_rows($resultdatos);
                    if($tregistros) $contenido .= "INSERT INTO $rowtablas[0]($campos) VALUES ";
                    $j=0;
                    while ($rowdatos = mysql_fetch_array($resultdatos)) {
                        $datos=$coma=$coma1="";
                        for ($i = 0; $i < $nrocampos; $i++) {
                            $datos.=$coma."'".$rowdatos[$arraycampos[$i]]."'";
                            $coma=",";
                        }
                        if($j==$tregistros-1) $coma1="**";
                        else $coma1=",";
                        $contenido .= " ($datos)$coma1 ";
                        $j++;
                    }
                }else{
                    
                }
                
                
                $nrocampos=0;
                $campos=$coma="";
                unset($arraycampos);
                $campos=$coma="";
            }
            
        }
        return $contenido;
    }
    
    public function restaurarBD(){
        $querytablas = "SHOW TABLES";
        $resulttablas = mysql_query($querytablas);
        while ($rowtablas = mysql_fetch_array($resulttablas)) {
            if($rowtablas[0] == 'usuario'){}
            elseif($rowtablas[0] == 'vistausuario'){}
            elseif($rowtablas[0] == 'vista'){}
            elseif($rowtablas[0] == 'region'){}
            elseif($rowtablas[0] == 'provincia'){}
            elseif($rowtablas[0] == 'distrito'){}
            elseif($rowtablas[0] == 'diresa'){}
            elseif($rowtablas[0] == 'red'){}
            elseif($rowtablas[0] == 'microred'){}
            elseif($rowtablas[0] == 'nucleo'){}
            elseif($rowtablas[0] == 'capitulocie10'){}
            elseif($rowtablas[0] == 'catalogocie10'){}
            elseif($rowtablas[0] == 'catalogoColegio'){}
            elseif($rowtablas[0] == 'catalogoconsejeria'){}
            elseif($rowtablas[0] == 'catalogocpt'){}
            elseif($rowtablas[0] == 'catalogoepisodio'){}
            elseif($rowtablas[0] == 'catalogoepisodioprestacion'){}
            elseif($rowtablas[0] == 'catalogoexamenlaboratorio'){}
            elseif($rowtablas[0] == 'catalogoinsumo'){}
            elseif($rowtablas[0] == 'catalogomedicamento'){}
            elseif($rowtablas[0] == 'catalogoperfil'){}
            elseif($rowtablas[0] == 'catalogoperfillaboratorio'){}
            elseif($rowtablas[0] == 'catalogoprestacion'){}
            elseif($rowtablas[0] == 'catalogoprestacionperfil'){}
            elseif($rowtablas[0] == 'catalogoups'){}
            elseif($rowtablas[0] == 'catalogovacuna'){}
            elseif($rowtablas[0] == 'categoriacie10'){}
            elseif($rowtablas[0] == 'colegioprofesional'){}
            elseif($rowtablas[0] == 'condiciontrabajador'){}
            elseif($rowtablas[0] == 'equivalenciascodigo'){}
            elseif($rowtablas[0] == 'establecimiento'){}
            elseif($rowtablas[0] == 'etapavida'){}
            elseif($rowtablas[0] == 'grupocie10'){}
            elseif($rowtablas[0] == 'profesion'){}
            elseif($rowtablas[0] == 'programacionvacuna'){}
            elseif($rowtablas[0] == 'tipotransmisiblecie10'){}
            else{
                $querycampos = "DESCRIBE $rowtablas[0]";
                $resultcampos = mysql_query($querycampos);
                while ($rowcampos = mysql_fetch_array($resultcampos)) {
                    $campos .= "$coma $rowcampos[0]";
                    $coma=",";
                }
                $coma = "";
                if(strpos($campos, 'claveGeneral')!==false) {
                    $querydatos = "DELETE FROM $rowtablas[0] WHERE claveGeneral <> '$_SESSION[claveGeneral]'";
                    mysql_query($querydatos);
                }
            }
            $campos = "";
        }
         $query = "DELETE FROM acopio";
         mysql_query($query);
    }
    
    public function importarBD($datos){

        if(trim($datos) !='' ){
            $mq = mysql_query($datos);

            if($mq==false){
                echo mysql_error();
            }
        
        }
    }
    
    public function insertarAcopio($notin){

        $query = "select distinct f.claveGeneral, e.nombreestablecimiento from familia f inner join establecimiento e on(f.claveGeneral = e.claveGeneral) where f.claveGeneral not in($notin)";
        $result = mysql_query($query);

     
        while ($row = mysql_fetch_row($result)) {

            $query = "insert into acopio(idacopio, claveGeneral, fecha, nombreestablecimiento) values(".$this->obtenerMaxAcopioId().", '".$row[0]."', NOW(), '".$row[1]."')";

            $mq=mysql_query($query);
            if($mq==false){
                echo mysql_error();
            }
        }
        
    }

     public function obtenerMaxAcopioId(){
         $row = mysql_fetch_array(mysql_query("SELECT MAX(idacopio) + 1 FROM acopio"));
         if(!$row[0]) return 1;
          else return $row[0];
     }

     public function obtenerClavesGenerales(){

        $query = "SELECT distinct claveGeneral FROM familia";

        $result = mysql_query($query);

        $ids = array();

        if(mysql_num_rows($result) > 0){
            while ($row = mysql_fetch_row($result)) {
                    $ids[] = "'".$row[0]."'";
            }
        }

        return implode(",", $ids);

     }
    
}


?>