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
                    $query = "SELECT fecha, DATE_FORMAT(fecha,'%Y') ,DATE_FORMAT(fecha,'%m') -1,DATE_FORMAT(fecha,'%d'), tipo,count(*) total,(SELECT gradoInstruccion FROM personaH WHERE dni=T.dni ORDER BY idpersonaH asc LIMIT 1 OFFSET 0) tipo1,(SELECT CASE WHEN tipo=gradoInstruccion THEN 0 ELSE -1 END FROM personaH WHERE dni=T.dni ORDER BY idpersonaH asc LIMIT 1 OFFSET 0) total2
                                FROM (SELECT DISTINCT STR_TO_DATE(DATE_FORMAT(fam.fechaHistorial,'%Y/%m/%d'),'%Y/%m/%d') as fecha, sexo ,gradoInstruccion as tipo,dni, CONCAT(per.nombre,apellidoPaterno,apellidoMaterno) as nombres
                                FROM familiaH fam INNER JOIN personaH per ON fam.idfamiliaH = per.idfamiliaH  AND fam.claveGeneral=per.claveGeneral 
                                WHERE $campo = '$valor' AND per.activo = 'AC' AND fechaHistorial>='$fechaInicio 00:00:00' AND fechaHistorial<='$fechaFin 23:59:59' AND gradoInstruccion<>'' GROUP BY nombres,tipo) AS T
                                GROUP BY 1,2,3,4 ORDER BY 1;";
                    //echo $query;
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
                                text: 'Reporte tendencia: Número de personas por grado de instrucción'
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
                                    text: 'Grado de instrucción'
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
                                name: "ANALFABETO",
                                // Define the data points. All series have a dummy year
                                // of 1970/71 in order to be compared on the same x axis. Note
                                // that in JavaScript, months start at 0 for January, 1 for February etc.
                                data: [
                                    
                                    <?php
                                    $suma=0;
                                        while ($row = mysql_fetch_array($result)) {
                                            if($row[4] == 'ANALFABETO'){
                                                $suma = $row[5];
                                                echo "[";?> Date.UTC(<?php echo "$row[1],$row[2],$row[3]" ;?> ) <?php echo ",$suma],";
                                            }
                                        }
                                    ?>
                                ]
                            },{
                                name: "PRIMARIA",
                                data: [
                                    
                                    <?php
                                    $suma=0;
                                        while ($row = mysql_fetch_array($result1)) {
                                            if($row[4] == 'PRIMARIA'){
                                                $suma = $row[5];
                                                echo "[";?> Date.UTC(<?php echo "$row[1],$row[2],$row[3]" ;?> ) <?php echo ",$suma],";
                                            }
                                        }
                                    ?>
                                ]
                            },{
                                name: "SECUNDARIA",
                                data: [
                                    
                                    <?php
                                    $suma=0;
                                        while ($row = mysql_fetch_array($result2)) {
                                            if($row[4] == 'SECUNDARIA'){
                                                $suma = $row[5];
                                                echo "[";?> Date.UTC(<?php echo "$row[1],$row[2],$row[3]" ;?> ) <?php echo ",$suma],";
                                            }
                                        }
                                    ?>
                                ]
                            },{
                                name: "SUPERIOR",
                                data: [
                                    
                                    <?php
                                    $suma=0;
                                        while ($row = mysql_fetch_array($result3)) {
                                            if($row[4] == 'SUPERIOR'){
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
<div id="altauto"></div>
<div id="pie" align="center">
            <?PHP echo $_SESSION['pie'];?>
        </div>
	</body>
</html>
<?php
$cnn->cerrarConexion();
?>