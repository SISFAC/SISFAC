<?php

/*
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.


*/
session_start();
require_once('../../conexion/Conexion.php');
$cnn = new Conexion();
$cnn->abrirConexion();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Reporte</title>

                <script type="text/javascript" src="/sisfac/js/jquery-1.5.2.min.js"></script>
                <script src="/sisfac/highcharts/js/highcharts.js"></script>
                <script src="/sisfac/highcharts/js/themes/grid.js"></script>
                <script src="/sisfac/highcharts/js/modules/data.js"></script>
                <script src="/sisfac/highcharts/js/modules/exporting.js"></script>
		<!--script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script-->
		<style type="text/css">
                    ${demo.css}
    		</style>
                <?php
                    $fechaFin = "$_REQUEST[fechaFin]";
                    $fechaFin = formatoFecha($fechaFin);
                    if($_REQUEST[atributo] == 'DISA/DIRESA') $campo = "fam.iddiresa";
                    elseif($_REQUEST[atributo] == 'REGION') $campo = "fam.idregion";
                    elseif($_REQUEST[atributo] == 'PROVINCIA') $campo = "fam.idprovincia";
                    elseif($_REQUEST[atributo] == 'DISTRITO') $campo = "fam.iddistrito";
                    elseif($_REQUEST[atributo] == 'COMUNIDAD') $campo = "fam.idcomunidad";
                    elseif($_REQUEST[atributo] == 'SECTOR') $campo = "fam.idsector";
                    elseif($_REQUEST[atributo] == 'RED') $campo = "fam.idred";
                    elseif($_REQUEST[atributo] == 'MICRORED') $campo = "fam.idmicrored";
                    elseif($_REQUEST[atributo] == 'NUCLEO') $campo = "fam.idnucleo";
                    elseif($_REQUEST[atributo] == 'ESTABLECIMIENTO') $campo = "fam.idestablecimiento";

                    $valor = "$_REQUEST[seleccion1]";
/*
                    $query = "SELECT TIMESTAMPDIFF(YEAR, fechaNacimiento, CURDATE()) edad, sexo, COUNT(*)  FROM (
                            SELECT DISTINCT per.idpersonaH,sexo,codigoFicha, fechaNacimiento 
                            FROM familiaH fam INNER JOIN personaH per ON fam.idfamiliaH = per.idfamiliaH AND fam.claveGeneral = per.claveGeneral 
                            WHERE fam.activo = 'AC' AND per.activo = 'AC' AND YEAR(CURDATE()) - YEAR(fechaNacimiento)>=0 AND YEAR(CURDATE()) - YEAR(fechaNacimiento)<150 AND $campo = '$valor') AS T GROUP BY 1,2";
*/
                    $query = "SELECT TIMESTAMPDIFF(YEAR, fechaNacimiento, CURDATE()) edad, sexo, COUNT(*)  FROM (
                            SELECT per.idpersona,sexo,codigoFicha, fechaNacimiento 
                            FROM familia fam INNER JOIN persona per ON fam.idfamilia = per.idfamilia AND fam.claveGeneral = per.claveGeneral 
                            WHERE fam.activo = 'AC' AND per.activo = 'AC' AND YEAR(CURDATE()) - YEAR(fechaNacimiento)>=0 AND YEAR(CURDATE()) - YEAR(fechaNacimiento)<150 AND $campo = '$valor') AS T where TIMESTAMPDIFF(YEAR, fechaNacimiento, CURDATE()) is not null GROUP BY 1,2";
                  
                    $i=0;
                    $ini = 4; $suma = 5;
                    $j=0;
                    $result = mysql_query($query);
                    while ($row = mysql_fetch_array($result)) {
                        if($row[1] == 'F'){
                            if($i==$row[0]) {
                                $valores[$i] = array($row[1]=>$row[2]);
                            }else{
                                while($i!=$row[0]){
                                    $valores[$i] = array('F'=>0);
                                    $i++;
                                    if($i==$row[0]) {
                                        $op=1;
                                    }
                                }    
                            }
                            if($op==1) {
                                $op=0;
                                $valores[$i] = array($row[1]=>$row[2]);
                            }
                            $i++;
                            
                        }
                    }
                    
                    $numrow = mysql_num_rows(mysql_query($query));
                    if($numrow>0){
                        foreach ($valores as $key => $value) {
                            foreach ($value as $k => $v) {
                                //echo $key.'-'.$ini.'-'.$v.'.'.'<br/>';
                                if($key<100){
                                    if($key<=$ini+1){
                                        $temp +=$v;
                                    }
                                    if($key==$ini){
                                        $array[$ini] = $temp;
                                        $temp=0;
                                        $ini +=$suma;
                                    }
                                }
                                elseif($key>=100){
                                    $array[100] += $v;
                                }
                            }
                        }
                        if($temp>0) $array[$key] = $temp;
                        //print_r($array);
                        
                        
                        $i=0;
                        $ini = 4; $suma = 5;
                        $j=0; $temp=0; $op=0;
                        $result = mysql_query($query);
                        while ($row = mysql_fetch_array($result)) {
                            if($row[1] == 'M'){
                                if($i==$row[0]) {
                                    $valores1[$i] = array($row[1]=>$row[2]);
                                }else{
                                    while($i!=$row[0]){
                                        $valores1[$i] = array('M'=>0);
                                        $i++;
                                        if($i==$row[0]) {
                                            $op=1;
                                        }
                                    }
                                }
                                if($op==1) {
                                    $op=0;
                                    $valores1[$i] = array($row[1]=>$row[2]);
                                }
                                $i++;
                                $ban=1;
                            }  
                            
                        }
                        //echo "$ban. <br>";
                        //print_r($valores1);     
                        if($ban==1) {
                            foreach ($valores1 as $key => $value) {
                                foreach ($value as $k => $v) {
                                    if($key<100){
                                        if($key<=$ini+1){
                                            $temp +=$v;
                                        }
                                        if($key==$ini){
                                            $array1[$ini] = $temp*(-1);
                                            $temp=0;
                                            $ini +=$suma;
                                        }
                                    }
                                    elseif($key>=100){
                                        $array1[100] += $v*(-1);
                                    }
                                }
                            }
                            if($temp>0) $array1[$key] = $temp*(-1);
                        }else{
                            $array1[]=0;
                        }
                        //print_r($array1);     
                    }
                    $fecha = date('d/m/Y');
                ?>
		<script type="text/javascript">
                    jQuery(function () {
                        
                        var categories = ['0-4', '5-9', '10-14', '15-19',
                                            '20-24', '25-29', '30-34', '35-39', '40-44',
                                            '45-49', '50-54', '55-59', '60-64', '65-69',
                                            '70-74', '75-79', '80-84', '85-89', '90-94',
                                            '95-99', '100 + '];
                        
                        jQuery('#container').highcharts({
                            chart: {
                                type: 'bar'
                            },
                            title: {
                                text: 'Piramide Poblacional',
                                style: {
                                        color: '#FF7474',
                                        fontSize: '30px'
                                }
                            },
                            subtitle: {
                                text: <?php echo "'$_REQUEST[atributo]: $_REQUEST[seleccion] - Fecha reporte: $fecha'";?>
                            },
                            xAxis: [{
                                categories: categories,
                                reversed: false,
                                labels: {
                                    step: 1
                                },
                                title: {
                                    text: 'Rango de edad',
                                    style: {
                                            color: '#FF7474',
                                            fontSize: '20px'
                                    }
                                }
                            }, { // mirror axis on right side
                                opposite: true,
                                reversed: false,
                                categories: categories,
                                linkedTo: 0,
                                labels: {
                                    step: 1
                                }
                            }],
                            yAxis: {
                                title: {
                                    text: 'N\xFAmero de personas',
                                    style: {
                                            color: '#FF7474',
                                            fontSize: '20px'
                                    }
                                },
                                labels: {
                                    formatter: function () {
                                        return Math.abs(this.value) //+ '%';
                                    }
                                }
                            },

                            plotOptions: {
                                series: {
                                    stacking: 'normal'
                                }
                            },
                            tooltip: {
                                formatter: function () {
                                    return '<b>' + this.series.name + ', edad ' + this.point.category + '</b><br/>' +
                                        'N\xFAmero de personas: ' + Highcharts.numberFormat(Math.abs(this.point.y), 0);
                                }
                            },

                            series: [{
                                name: 'Masculino',
                                data: [<?php echo implode(',', $array1);?>]
                            }, {
                                name: 'Femenino',
                                data: [<?php echo implode(',', $array);?>]
                            }]
                        });
                    });
                    jQuery('#container').attr('style','background-color: #000000;')
		</script>
	</head>
	<body>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<?php
    $array = array();
    while ($row = mysql_fetch_array($result)) {
        $array[$row[0]] = $row[1];
    }
    echo "<table id=\"datatable\">
	<thead>
		<tr>
                <th></th>
                <th></th>
                </tr>
    ";
    foreach ($array as $key => $value) {
        //echo "<tr><th>$value</th></tr>";
    }
    echo "</thead><tbody>";
    $i=0;
    foreach ($array as $key => $value) {
        echo "<tr>";
        echo "<td>$key</td>";
        echo "<td>$value</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
?>
<div id="altauto"></div>
<div id="pie" align="center">
            <?PHP echo $_SESSION['pie'];?>
        </div>
	</body>
</html>
<?php
$cnn->cerrarConexion();
?>