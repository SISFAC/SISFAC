<?php 
/*
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.


*/
/* wrapper for Java.inc */ 

if(!function_exists("java_get_base")) require_once("Java.inc"); 

if ($java_script_orig = $java_script = java_getHeader("X_JAVABRIDGE_INCLUDE", $_SERVER)) {

  if ($java_script!="@") {
    if (($_SERVER['REMOTE_ADDR']=='127.0.0.1') || (($java_script = realpath($java_script)) && (!strncmp($_SERVER['DOCUMENT_ROOT'], $java_script, strlen($_SERVER['DOCUMENT_ROOT']))))) {
      chdir (dirname ($java_script));
      require_once($java_script);
    } else {
      trigger_error("illegal access: ".$java_script_orig, E_USER_ERROR);
    }
  }

  java_call_with_continuation();
}
?>
