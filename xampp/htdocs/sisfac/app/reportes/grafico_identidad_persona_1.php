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
                    $query = "SELECT sexo, opcionDNI, COUNT(*) as total 
                            FROM(SELECT DISTINCT CONCAT_WS(' ',per.nombre, apellidoPaterno, apellidoMaterno) as nombres, sexo, opcionDNI , 
                            YEAR(CURDATE()) - YEAR(fechaNacimiento) AS edad ,per.idpersonaH, codigoFicha  FROM familiaH fam INNER JOIN personaH per ON fam.idfamiliaH = per.idfamiliaH AND 
                            fam.claveGeneral=per.claveGeneral WHERE $campo = '$valor' AND per.activo = 'AC' AND opcionDNI<>'' AND fechaHistorial<='$fechaFin'  
                            AND  fam.activo='AC' ) AS T GROUP BY 1,2
                            ORDER BY 1";

                    $result = mysql_query($query);
                ?>
		<script type="text/javascript">
                    jQuery(function () {
                        jQuery('#container').highcharts({
                            chart: {
                                type: 'bar'
                            },
                            title: {
                                text: 'Reporte de identidad'
                            },
                            subtitle: {
                                text: <?php echo "'$_REQUEST[atributo]: $_REQUEST[seleccion]'";?>
                            },
                            xAxis: {
                                categories: [<?php 
                                    //$temp = "";
                                    while ($row = mysql_fetch_array($result)) {
                                        $array_campos[] = "'$row[1]'";
                                    }
                                    $cadena = array_unique($array_campos);
                                    $cadena = implode(',', $cadena);
                                    echo "$cadena";
                                ?>],
                                title: {
                                    text: null
                                }
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: 'Numero de personas',
                                    align: 'high'
                                },
                                labels: {
                                    overflow: 'justify'
                                }
                            },
                            tooltip: {
                                valueSuffix: ' personas'
                            },
                            plotOptions: {
                                bar: {
                                    dataLabels: {
                                        enabled: true
                                    }
                                }
                            },
                            legend: {
                                layout: 'vertical',
                                align: 'right',
                                verticalAlign: 'top',
                                x: -40,
                                y: 80,
                                floating: true,
                                borderWidth: 1,
                                backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                                shadow: true
                            },
                            credits: {
                                enabled: false
                            },
                            series: [{
                                name: 'Femenino',
                                data: [
                                    <?php
                                    $result = mysql_query($query);
                                    while ($row = mysql_fetch_array($result)) {
                                        //echo "$row[0].ss,";
                                        if($row[0] == 'F') $array_campos1[] = "$row[2]";
                                    }
                                    $cadena = array_unique($array_campos1);
                                    $cadena = substr(implode(',', $cadena), 0, -1);
                                    echo "$cadena";
                                    
                                    ?>]
                            }, {
                                name: 'Masculino',
                                data: [
                                    <?php
                                    $result = mysql_query($query);
                                    while ($row = mysql_fetch_array($result)) {
                                        if($row[0] == 'M') $array_campos2[] = "$row[2]";
                                    }
                                    $cadena = array_unique($array_campos2);
                                    $cadena = substr(implode(',', $cadena), 0, -1);
                                    echo "$cadena";
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
/*
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
    echo "</tbody></table>";*/
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