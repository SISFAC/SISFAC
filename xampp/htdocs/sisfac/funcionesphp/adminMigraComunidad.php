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

$establecimiento_origen = $_REQUEST['establecimiento_origen'];
$comunidad_origen = $_REQUEST['comunidad_origen'];
$establecimiento_destino = $_REQUEST['establecimiento_destino'];

if(isset($establecimiento_origen) && isset($comunidad_origen) && isset($establecimiento_destino)){


	if($establecimiento_origen != $establecimiento_destino){

		$contenido = $migracionComunidad->migraComunidad( $establecimiento_origen, $comunidad_origen, $establecimiento_destino );
	    $nombrearchivo = "backup/comunidad_".date("Y_M_d_H_i_s").".txt";
	    $fp = fopen($nombrearchivo,"x");
	    fwrite($fp,$contenido);
	    fclose($fp);
	    header("Location: $nombrearchivo");

	}

}else{

	echo "Ocurrió un error.";
}


?>