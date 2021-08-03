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
                <script type="text/javascript" src="/sisfac/js/grid.locale-es.js" ></script>
                <script src="/sisfac/highcharts/js/highcharts.js"></script>
                <script src="/sisfac/highcharts/js/themes/grid.js"></script>
                <script src="/sisfac/highcharts/js/modules/data.js"></script>
                <script src="/sisfac/highcharts/js/modules/exporting.js"></script>
		<!--script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script-->
		<style type="text/css">
                    ${demo.css}
    		</style>
                <?php
                    $fechaInicio = formatoFecha($_REQUEST[fechaInicio]);
                    $fechaFin = formatoFecha($_REQUEST[fechaFin]);
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
                    $query = "SELECT fecha, DATE_FORMAT(fecha,'%Y') ,DATE_FORMAT(fecha,'%m') -1,DATE_FORMAT(fecha,'%d'), edad,
                                COUNT(*) as total FROM( SELECT DISTINCT STR_TO_DATE(DATE_FORMAT(fam.fechaHistorial,'%Y/%m/%d'),'%Y/%m/%d') as fecha,
                        CASE
                        WHEN fechaNacimiento = 0 THEN 'NO REGISTRAN EDAD'
                        WHEN YEAR(CURDATE()) - YEAR(fechaNacimiento)<12 THEN 'ETAPA NIÑO(0-11 AÑOS)'
                        WHEN  YEAR(CURDATE()) - YEAR(fechaNacimiento)<18 THEN 'ETAPA ADOLESCENTE(12-17 AÑOS)'
                        WHEN  YEAR(CURDATE()) - YEAR(fechaNacimiento)<30 THEN 'ETAPA JOVEN(18-29 AÑOS)'
                        WHEN  YEAR(CURDATE()) - YEAR(fechaNacimiento)<60 THEN 'ETAPA ADULTO(30-59 AÑOS)'
                        ELSE 'ETAPA ADULTO MAYOR(60 AÑOS A MAS)'
                        END as edad,  fechaNacimiento
                        FROM familiaH fam INNER JOIN personaH per ON fam.idfamiliaH = per.idfamiliaH AND fam.claveGeneral = per.claveGeneral
                        WHERE $campo = '$valor' AND fechaHistorial>='$fechaInicio 23:59:59' AND fechaHistorial<='$fechaFin 23:59:59' GROUP BY dni) AS T
                        GROUP BY 1,2,3,4,5 ORDER BY 1,2;";

                    $result = mysql_query($query);
                    $result1 = mysql_query($query);
                    $result2 = mysql_query($query);
                    $result3 = mysql_query($query);
                    $result4 = mysql_query($query);
                    $result5 = mysql_query($query);
                    
                ?>
		<script type="text/javascript">
                    jQuery(function () {
                        jQuery('#container').highcharts({                  
                            chart: {
                                type: 'spline'
                            },
                            title: {
                                text: 'Reporte tendencia: Número de personas por etapa de vida'
                            },
                            subtitle: {
                                text: <?php echo "'$_REQUEST[atributo]: $_REQUEST[seleccion]<br/><br/> Del $_REQUEST[fechaInicio] al $_REQUEST[fechaFin]'";?>
                                
                            },
                            xAxis: {
                                type: 'datetime',
                                dateTimeLabelFormats: { // don't display the dummy year
                                    month: '%e/%b/%y',
                                    year: '%b'
                                },
                                title: {
                                    text: 'Etapa de vida'
                                }
                            },
                            yAxis: {
                                title: {
                                    text: 'Número de personas'
                                },
                                min: 0
                            },
                            tooltip: {
                                headerFormat: '<b>{series.name}</b><br>',
                                pointFormat: '{point.x:%e. %b}: {point.y:.f} persona(s)'
                            },

                            plotOptions: {
                                spline: {
                                    marker: {
                                        enabled: true
                                    }
                                }
                            },

                            series: [{
                                name: "NO REGISTRAN EDAD",
                                // Define the data points. All series have a dummy year
                                // of 1970/71 in order to be compared on the same x axis. Note
                                // that in JavaScript, months start at 0 for January, 1 for February etc.
                                data: [
                                    
                                    <?php
                                            $suma=0;
                                        while ($row = mysql_fetch_array($result)) {
                                            if($row[4] == 'NO REGISTRAN EDAD'){
                                                $suma = $row[5];
                                                echo "[";?> Date.UTC(<?php echo "$row[1],$row[2],$row[3]" ;?> ) <?php echo ",$suma],";
                                            }
                                        }
                                    ?>
                                ]
                            },{
                                name: "ETAPA NIÑO(0-11 AÑOS)",
                                data: [
                                    
                                    <?php
                                        $suma=0;
                                        while ($row = mysql_fetch_array($result1)) {
                                            if($row[4] == 'ETAPA NIÑO(0-11 AÑOS)'){
                                                $suma = $row[5];
                                                echo "[";?> Date.UTC(<?php echo "$row[1],$row[2],$row[3]" ;?> ) <?php echo ",$suma],";
                                            }
                                        }
                                    ?>
                                ]
                            },{
                                name: "ETAPA ADOLESCENTE(12-17 AÑOS)",
                                data: [
                                    
                                    <?php
                                        $suma=0;
                                        while ($row = mysql_fetch_array($result2)) {
                                            if($row[4] == 'ETAPA ADOLESCENTE(12-17 AÑOS)'){
                                                $suma = $row[5];
                                                echo "[";?> Date.UTC(<?php echo "$row[1],$row[2],$row[3]" ;?> ) <?php echo ",$suma],";
                                            }
                                        }
                                    ?>
                                ]
                            },{
                                name: "ETAPA JOVEN(18-29 AÑOS)",
                                data: [
                                    
                                    <?php
                                        $suma=0;
                                        while ($row = mysql_fetch_array($result3)) {
                                            if($row[4] == 'ETAPA JOVEN(18-29 AÑOS)'){
                                                $suma = $row[5];
                                                echo "[";?> Date.UTC(<?php echo "$row[1],$row[2],$row[3]" ;?> ) <?php echo ",$suma],";
                                            }
                                        }
                                    ?>
                                ]
                            },{
                                name: "ETAPA ADULTO(30-59 AÑOS)",
                                data: [
                                    
                                    <?php
                                    $suma=0;
                                        while ($row = mysql_fetch_array($result4)) {
                                            if($row[4] == 'ETAPA ADULTO(30-59 AÑOS)'){
                                                $suma = $row[5];
                                                echo "[";?> Date.UTC(<?php echo "$row[1],$row[2],$row[3]" ;?> ) <?php echo ",$suma],";
                                            }
                                        }
                                    ?>
                                ]
                            },{
                                name: "ETAPA ADULTO MAYOR(60 AÑOS A MAS)",
                                data: [
                                    <?php
                                    $suma=0;
                                        while ($row = mysql_fetch_array($result5)) {
                                            if($row[4] == 'ETAPA ADULTO MAYOR(60 AÑOS A MAS)'){
                                                $suma = $row[5];
                                                echo "[";?> Date.UTC(<?php echo "$row[1],$row[2],$row[3]" ;?> ) <?php echo ",$suma],";
                                            }
                                        }
                                    ?>
                                ]
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
        $array[$row[0]] = $row[4];
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