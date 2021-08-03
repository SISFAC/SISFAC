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
                    $query = "SELECT nombreCiclo,COUNT(*) as total FROM (SELECT CASE WHEN INSTR(nombreCiclo, 'FAMILIA EXPANSION')>0 THEN 'FAMILIA EN EXPANSION' ELSE nombreCiclo END as nombreCiclo, codigoFicha, fam.claveGeneral
                                FROM familia fam INNER JOIN ciclo cic ON fam.idfamilia = cic.idfamilia AND fam.claveGeneral = cic.claveGeneral 
                                WHERE fam.activo='AC' and $campo= '$valor' AND nombreCiclo<>'') AS T GROUP BY 1 ORDER BY 1 desc";

                    //echo $query;
                    $result = mysql_query($query);
                ?>
		<script type="text/javascript">
                    jQuery(function () {
                        jQuery('#container').highcharts({
                            /*data: {
                                table: 'datatable'
                            }*/
                            series: [{
                                name: 'Familia:',
                                data: [
                                    <?php
                                        while ($row = mysql_fetch_array($result)) {
                                            echo "['$row[0]',$row[1]],";
                                        }
                                    ?>
                                ],
                                dataLabels: {
                                    enabled: true,
                                    //rotation: -90,
                                    color: '#FFFFFF',
                                    align: 'center',
                                    //format: '{point.y:.1f}', // one decimal
                                    y: 10, // 10 pixels down from the top
                                    style: {
                                        fontSize: '13px',
                                        fontFamily: 'Verdana, sans-serif'
                                    }
                                }
                            }],
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Reporte n\xFAmero de familia por ciclo vital',
                                style: {
                                        color: '#FF7474',
                                        fontSize: '30px'
                                }
                            },
                            subtitle: {
                                text: <?php echo "'$_REQUEST[atributo]: $_REQUEST[seleccion] <br> Fecha reporte: $_REQUEST[fechaFin]'";?>
                            },
                            xAxis: {
                                type: 'category',
                                labels: {
                                    //rotation: -45,
                                    style: {
                                        fontSize: '13px',
                                        fontFamily: 'Verdana, sans-serif'
                                    }
                                }
                            },
                            yAxis: {
                                allowDecimals: false,
                                title: {
                                    text: 'N\xFAmero de familias',
                                    style: {
                                            color: '#FF7474',
                                            fontSize: '20px'
                                    }
                                }
                            },
                            legend: {
                                enabled: false
                            },
                            tooltip: {
                                formatter: function () {
                                    return '<b>' + this.series.name + '</b><br/>' +
                                        this.point.y + ' ' + this.point.name.toLowerCase();
                                }
                            }
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