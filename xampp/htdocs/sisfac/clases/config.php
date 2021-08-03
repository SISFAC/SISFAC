<?php
/*
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.


*/
***FileFor: MySQL Database BackUP[config.php]***********                        *   *   *
***CreatedOn: 19th November 2009*****************************                     * * *
***Modified On: 03 December 2009 *******************************             * * *  C  * * *
     ***************************************************************     		  * * *
***Details: configuration file. All data enters here**********			        *   *   *
***Suggestions and Comments are welcome******************		              *     *     *
*/

$backUpFolder	= "copiaBD"; // The folder which the sql file stored. It is needed

@mkdir($backUpFolder);	//Create  Back Up Directory
@chmod($backUpFolder,0777); // Make it writable. In Case it already there.

//Database Server Details*

$server['host']	= "localhost";	//The hostname
$server['port']	= "";	//Give the port number allocated for MySQL. Leave blank if it is default[3306]
//$server['user']	= "root";	//MySQLDatabase Username. Need to have all permission to the database.
$server['user']	= "root";	//MySQLDatabase Username. Need to have all permission to the database.
$server['pass']	= "Admin$123";	//MySQLDatabase Password.
$server['database'] = "bdsicfic";	//MySQLDatabase Name.

?>
