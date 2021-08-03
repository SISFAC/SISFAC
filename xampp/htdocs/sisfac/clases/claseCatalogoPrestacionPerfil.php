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
class CatalogoPrestacionPerfil{
    //put your code here
    private $cnn;
    public function __construct() {
        $this->cnn = new Conexion();
        $this->cnn = $this->cnn->abrirConexion();
    }

    public function mostrarCatalogoPrestacionPerfilDatagrid(){
        $limit = $_REQUEST['rows'];
        $page = $_REQUEST['page'];
        $sidx = $_REQUEST['sidx'];
        $sord = $_REQUEST['sord'];
        if(!$sidx) $sidx =1;
        $wh = '';
        $searchOn = Strip($_REQUEST['_search']);
        if($searchOn=='true') {
            $sarr = Strip($_REQUEST);
            foreach( $sarr as $k=>$v) {
                switch ($k) {
                    case 'campo':
                        
                        break;
                }
            }
        }
        $query="SELECT COUNT(*) FROM catalogoPrestacionPerfil WHERE 1=1 $wh ";
        $dato = obtenerPaginacion($query, $limit, $page);
        $start = $dato[0];$count = $dato[1];$total_pages=$dato[2];
        $query="SELECT idcatalogoPrestacionPerfil,cpp.idcatalogoPrestacion,nombrePrestacion,cpp.idcatalogoPerfil, nombrePerfil
                FROM catalogoPrestacionPerfil cpp INNER JOIN catalogoPrestacion cpr ON cpp.idcatalogoPrestacion=cpr.idcatalogoPrestacion
                INNER JOIN catalogoPerfil cpe ON cpe.idcatalogoPerfil=cpp.idcatalogoPerfil WHERE 1=1 $wh ORDER BY $sidx $sord LIMIT $start,$limit";

        obtenerXML($page, $count, $total_pages, $query);
    }
    
    public function mostrarCatalogoPrestacionPerfilVector($idcatalogoPrestacionPerfil){
        $query = "SELECT idcatalogoPrestacionPerfil,idcatalogoPrestacion,idcatalogoPerfil FROM antecedentePsicosocial WHERE idcatalogoPrestacionPerfil = '$idcatalogoPrestacionPerfil'  ";
        $row = mysql_fetch_array(mysql_query($query));
        return $row['idcatalogoPrestacionPerfil'].'+'.$row['idcatalogoPrestacion'].'+'.$row['idcatalogoPerfil'];
    }

    public function mostrarCatalogoPrestacionPerfilCombobox($select){
        $query = "SELECT idcatalogoPrestacionPerfil,idcatalogoPrestacion,idcatalogoPerfil FROM catalogoPrestacionPerfil WHERE 1=1 $wh";
        $result = mysql_query($query);
        if($select) echo "<select>";
        while ($row = mysql_fetch_row($result)) {
            echo "<option value = '$row[0]'>$row[1]</option>";
        }
        if($select) echo "</select>";
    }
    
    public function agregarCatalogoPrestacionPerfil($idcatalogoPrestacionPerfil,$idcatalogoPrestacion,$idcatalogoPerfil){
        $data = verificarDatos('add', array('idcatalogoPrestacionPerfil'=>$idcatalogoPrestacionPerfil,'idcatalogoPrestacion'=>$idcatalogoPrestacion,'idcatalogoPerfil'=>$idcatalogoPerfil));
        if($data[0]!=''){
            $query = "INSERT INTO catalogoPrestacionPerfil($data[0]) VALUES($data[1])";
            mysql_query($query);
        }
    }
    
    public function actualizarCatalogoPrestacionPerfil($idcatalogoPrestacionPerfil,$idcatalogoPrestacion,$idcatalogoPerfil){
        $data = verificarDatos('edit', array('idcatalogoPrestacionPerfil'=>$idcatalogoPrestacionPerfil,'idcatalogoPrestacion'=>$idcatalogoPrestacion,'idcatalogoPerfil'=>$idcatalogoPerfil)); 
        if($data[0]!=''){
            $query = "UPDATE catalogoPrestacionPerfil SET $data[0] WHERE idcatalogoPrestacionPerfil = '$idcatalogoPrestacionPerfil' ";
            mysql_query($query);
        }
    }
    
    public function eliminarCatalogoPrestacionPerfil($idcatalogoPrestacionPerfil){
        $query = "DELETE FROM catalogoPrestacionPerfil WHERE idcatalogoPrestacionPerfil = '$idcatalogoPrestacionPerfil' ";
        mysql_query($query);
    }

    public function buscarPrestacionPerfilTabla($nombreEtapa, $dias, $idpersona, $idPAIS, $fechaNacimiento){
        //BUSCAMOS LA ETAPA DE VIDA
        $query = "SELECT idetapaVida FROM etapaVida WHERE nombreEtapa = '$nombreEtapa' ";
        $row = mysql_fetch_array(mysql_query($query));
        $idetapaVida = $row[0];
        
        //BUSCAMOS LOS NOMBRES DE EPISODIOS
        $sql = "SELECT DISTINCT cae.idcatalogoEpisodio, cae.nombreEpisodio
                FROM catalogoEpisodioPrestacion cep INNER JOIN catalogoPrestacion cpr ON cep.idcatalogoPrestacion=cpr.idcatalogoPrestacion 
                INNER JOIN catalogoEpisodio cae ON cep.idcatalogoEpisodio=cae.idcatalogoEpisodio 
                WHERE idetapaVida = $idetapaVida AND limiteFinal>$dias AND planificador = 'SI' ORDER BY cae.idcatalogoepisodio";
        $columna = mysql_query($sql);
        
        //BUSCAMOS LAS PRESTACIONES DEL EPISODIO
        $query = "SELECT DISTINCT cpr.idcatalogoPrestacion, cpr.nombrePrestacion 
                FROM catalogoPrestacion cpr INNER JOIN catalogoEpisodioPrestacion cep ON cpr.idcatalogoPrestacion=cep.idcatalogoPrestacion 
                INNER JOIN catalogoEpisodio cae ON cae.idcatalogoEpisodio=cep.idcatalogoEpisodio
                WHERE idetapaVida = $idetapaVida AND limiteFinal>$dias AND planificador = 'SI' AND opActivo = 'SI' ORDER BY cep.orden asc";
        //echo $query;
        $result = mysql_query($query);
        $array = array();
        echo "<div><table border='1' width='100%' cellspacing='0' cellpadding='0'><tr><td></td>";
        while ($col = mysql_fetch_array($columna)) {
            $array[] = $col[0];
            echo "<td align='center'><h2>$col[0]-$col[1]</h2></td>";
        }
        echo "</tr>";
        $i=0;
        $sql = "SELECT DISTINCT cae.idcatalogoEpisodio, cae.nombreEpisodio
                FROM catalogoEpisodioPrestacion cep INNER JOIN catalogoPrestacion cpr ON cep.idcatalogoPrestacion=cpr.idcatalogoPrestacion 
                INNER JOIN catalogoEpisodio cae ON cep.idcatalogoEpisodio=cae.idcatalogoEpisodio 
                WHERE idetapaVida = $idetapaVida AND limiteFinal>$dias AND planificador = 'SI' ORDER BY cae.idcatalogoepisodio";
        $columna = mysql_query($sql);
        
        
        while ($row = mysql_fetch_array($result)) {
            echo "<tr class='ui-widget-content jqgrow ui-row-ltr'>";
            echo "<td width='30%'><span>$row[nombrePrestacion]</span></td>";
            $query1 = "SELECT DISTINCT idcatalogoEpisodioPrestacion, cae.nombreEpisodio, opActivo, factorProgramacion, nombreTabla, cae.idcatalogoEpisodio,DATE_FORMAT(DATE_ADD('$fechaNacimiento', INTERVAL factorProgramacion DAY),'%d/%m/%Y') as fechaCalculada,cep.idcatalogoPrestacion 
                        FROM catalogoEpisodioPrestacion cep INNER JOIN catalogoPrestacion cpr ON cep.idcatalogoPrestacion=cpr.idcatalogoPrestacion INNER JOIN catalogoEpisodio cae ON cep.idcatalogoEpisodio=cae.idcatalogoEpisodio 
                        WHERE idetapaVida = $idetapaVida AND limiteFinal>$dias AND cep.idcatalogoPrestacion=$row[idcatalogoPrestacion]  AND planificador = 'SI' AND opActivo='NO' ORDER BY cae.idcatalogoEpisodio";
            //echo $query1;
            $result1 = mysql_query($query1);
            
            while ($row1 = mysql_fetch_array($result1)) {
                //echo "<td width='15%'>$array[$i]-$row1[idcatalogoEpisodio]</td>";
                $i=0;
                foreach ($array as $value) {
                    //echo "<td width='15%'>$value - $row1[idcatalogoEpisodio] - $i</td>";
                    if($value == $row1[idcatalogoEpisodio]) {
                        echo "<td width='15%'>$value - $row1[idcatalogoEpisodio] - $i</td>";
                        $i++;
                    }
                    else echo "<td width='15%'></td>";
                    break;
                }
                if($i==0) echo "<td width='15%'></td>";
                //if($array[$i++] == $row1[idcatalogoEpisodio]) echo "<td width='15%'>$row1[idcatalogoEpisodio]</td>";
                //else echo "<td width='15%'></td>";
                //$i++;
                
                /*
                if($row1[2]=='NO') echo "<td width='15%'></td>";
                else {
                    if($row1[nombreTabla]!='' && $idpersona!=''){
                        $tabla = mysql_num_rows(mysql_query("SHOW TABLES like '$row1[nombreTabla]'")) ;
                        if($tabla>0){
                            $cprestacion = "SELECT tab.idpersona,tab.fechaFin,tab.estado,cep.idcatalogoEpisodio FROM $row1[nombreTabla] tab 
                            INNER JOIN catalogoPrestacion cpr ON tab.idcatalogoPrestacion = cpr.idcatalogoPrestacion INNER JOIN catalogoEpisodioPrestacion cep ON cep.idcatalogoPrestacion = cpr.idcatalogoPrestacion 
                            WHERE idpersona = '$idpersona' AND cep.idcatalogoPrestacion = '$row1[idcatalogoPrestacion]' AND cep.idcatalogoEpisodio = '$row1[idcatalogoEpisodio]'";
                            //echo $i.'-'.$cprestacion.'<br><br>' ;
                            //$i++;
                            //$prestacion = mysql_fetch_array(mysql_query($cprestacion));
                            //echo $prestacion[fechaFin].'<br><br>' ;
                        }else{
                            $prestacion = '';
                        }
                    }

                    $cdetallePAIS = "SELECT iddetallePAIS, claveGeneral, idcatalogoEpisodioPrestacion, idPAIS, tipoProgramacion, fechaPlanificada 
                                FROM detallePAIS WHERE idPAIS = '$idPAIS' AND idcatalogoEpisodioPrestacion = '$row1[idcatalogoEpisodioPrestacion]'";
                    $detallePAIS = mysql_fetch_array(mysql_query($cdetallePAIS));



                    echo "<td width='15%'><br/>
                        <table border='0' id='$row1[idcatalogoEpisodioPrestacion]' name='taEpisodioPrestacion'>
                            <tr>
                                <td>Prog.$i</td>
                                <td>
                                    <select name='cbProgramacion' idcatalogoPrestacion = '$row[idcatalogoPrestacion]' idcatalogoEpisodio = '$row1[idcatalogoEpisodio]' onchange='ejecutarFuncion(this,$row1[idcatalogoEpisodioPrestacion]);' onload='ejecutarFuncion(this,$row1[idcatalogoEpisodioPrestacion]);'>
                                    <option value='MANUAL' ".($detallePAIS[tipoProgramacion]=='MANUAL'?'selected':'').">MANUAL</option>
                                    <option value='AUTOMATICA' ".(($detallePAIS[tipoProgramacion]=='AUTOMATICA')?'selected':'').">AUTOMATICA</option>
                                </select>
                                </td>
                            </tr>
                            <tr>
                                <td>FP</td>
                                <td><input name='tbFechaProgramana' style='width: 90px'>".$detallePAIS[fechaPlanificada]."</input></td>
                            </tr>
                            <tr>
                                <td>FE</td>
                                <td><label name='tbFechaEjecutada' style='width: 90px'>".$prestacion[fechaFin]."</label></td><input type='hidden' name='tbFactorProgramacion' val = '$row1[factorProgramacion]'></input>
                            </tr>
                            <tr>
                                <td>Est.</td>
                                <td>".($prestacion[fechaFin]!=''?'CONCLUIDO':'PENDIENTE')."</td>
                            </tr>
                        </table><br/>
                    </td>";
                }
                */
            }
        }
        echo "</tr>";
        
        echo "</table></div>";
        
    }
}
?>
