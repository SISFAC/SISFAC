<?php
/*
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.

*/

//Class Starts

//conexion a Base de Datos maquina
$cfg_server='localhost';
//$cfg_server='mysql.nixiweb.com';
//$cfg_usuario='u250491459_kallp';//'bjb';
$cfg_usuario='root';//'bjb';
//$cfg_clave='siskallpa';
$cfg_clave='';
$cfg_basedatos='bdsicfic';
//$cfg_basedatos='u250491459_kallpa';
//otros
//$cfg_base='http://localhost/siskallpa/';
$cfg_base='http://localhost/sisfac/';
//tiempo de duracion de cookie (segundos)
$cfg_cookie=0;//un mes

class MyBackUp
{
//Class variable declaration
		var $server	= 'localhost';
		var $port	= 3306;
		var $usern	= 'root';
		var $userp	= 'Admin$123';
		var $dbase	= 'bdsicfic';
		var $link	=-1;
		var $connected	= false;
		var $error	="";
		var $filename	="backup/mySQL_bck.sql";
		var $mailTo	= "";
		var $mailFrom	= "dbm@mysite.com";
		var $body	= "";
		var $isDel	= false;

	function BackUp()
	{
		//Function which do all the needed calls
		if(!($this->connected = $this->_connect())) //connect to database
		{
			return false;
		}
		if(!($this->_saveFile())) //Creating and Saving the sql file.
		{
			return false;
		}
		
		return true;
		
	}
//PLEASE DONOT TRY TO CHANGE THE CODE--IT MAY AFFECT ITS WORKING.
	function _connect()
	{
		$value	= false;
		if(!$this->connected)
		{
			$host	= $this->server.":".$this->port;
			$this->link	= mysql_connect($host,$this->usern,$this->userp);
			
		}
		if($this->link !==-1)
		{
			
			$value	= mysql_select_db($this->dbase,$this->link);
		}
		else
		{
			$value	= mysql_select_db($this->dbase);
		}
		if(!$value)
		{
			$this->error = mysql_error();
			return false;
		}
		else
			return $value;
		
	}

	function _query($sql)
	{
		if ($this->link !== -1)
   		{
    	  		$result = mysql_query($sql, $this->link);
    		}
    		else
		{
			$result = mysql_query($sql);
		}
		if (!$result)
		{
			$this->error = mysql_error();
		}
		return $result;
	}

	function _getTables()
	{
		$value	= array();
		if(!($result = $this->_query("SHOW TABLES")))
		{
			return false;
		}
		while($row = mysql_fetch_row($result))
		{
			$value[] = $row[0];
		}
		if (!sizeof($value))
		{
			$this->error = 'No tables found in Database.';
			return false;
		}
    	return $value;
		
	}

	function _dumpData($table)
	{
		$value="";
		$this->_query("LOCK TABLES $table WRITE");
		$value .= "-- \n";
		$value .= "--  Table structure for table `$table`\n";
		$value .= "-- \n\n";
		if(!($result = $this->_query("SHOW CREATE TABLE $table")))
		{
			return false;
		}
		$row	= mysql_fetch_assoc($result);
		$value .= $row['Create Table'].";\n\n";
		$value .= "\n-- Dumping data for table `$table`\n\n";
		$value .= $this->_getInserts($table);
		$this->_query("UNLOCK TABLES");
    		return $value;
	}
	
	function _getInserts($table)
	{
		$value = '';
		if(!($result = $this->_query("SELECT * FROM $table")))
		{
			return false;
		}
		while($row = mysql_fetch_row($result))
		{
			$datum	= "";
			foreach($row as $data)
			{
				$datum .= "'".addslashes($data)."', ";
			}
			$datum	= substr($datum,0,-2);
                        //áéíóúÁÉÍÓÚñÑ
                        $busqueda = array('á','é','í','ó','ú','Á','É','Í','Ó','Ú','ñ','Ñ');
                        $reemplazo =array('Ã¡','Ã©','Ã­','Ã³','Ãº','Ã','Ã‰','Ã','Ã“','Ãš','Ã±','Ã‘');
                        $datum = str_replace($busqueda, $reemplazo, $datum);
			$value.= "INSERT INTO $table VALUES ($datum);\n";
		}
		return $value;
	}

	function _retrieve()
	{
		if(!$this->_connect())
		{
			return false;
		}
		$value	= "--  Database Dump\n";
		$value .="-- version 1.01b\n";
		$value .="-- Developed: Anish Karim C\n";
		$value .="-- Credits: http://www.phpclasses.org\n\n";
		$value .="-- Class Page: http://www.phpclasses.org/browse/package/5808.html\n\n";
		$value .="-- How To Blog: http://is.gd/5b3Xk\n\n";
		$value .="-- Host: $this->server\n";
		$value .="-- Generation Time: ".date('M d, Y')." at ".date('H:i')." \n";
		$value .="-- \n";
		$value .="-- MySQL version: ".mysql_get_server_info()."\n";
		$value .="-- PHP Version: ".phpversion()."\n";
		$value .="-- \n";
		if(!empty($this->database))
		{
			$value .="-- \n";
			$value .="-- Database: `$this->database`\n";
			$value .="-- \n";
		}
		if(!($tables = $this->_getTables()))
		{
			return false;
		}
		foreach($tables as $table)
		{
			if(!($dumpTable = $this->_dumpData($table)))
			{
				return false;
			}
			$value .=$dumpTable;
		}
		return $value;
	}

	function _saveFile()
	{
		if(!($fp = fopen($this->filename,"w")))
		{
			$this->error = "Unable to Open File";
			return false;
		}
		$data = $this->_retrieve();
		fwrite($fp,$data);
		fclose($fp);
		@chmod($this->filename,0744);
		return true;
	}
	
	function _mailer()
	{
		if($this->_checkMail($this->mailFrom) && $this->_checkMail($this->mailTo))
		{
			/*$size	= filesize($this->filename);
			$fp	= fopen($this->filename,"r");
			$datum	= fread($fp,$size);*/ //Changed with fileGetContents if it is not worked, please revert back.
			$datum	= file_get_contents($this->filename);
			//fclose($fp);
			$datum	= chunk_split(base64_encode($datum));
			$uid	= md5(uniqid(time()));
			$header = "From: ".$this->mailFrom."\r\n";
			$header .= "MIME-Version: 1.0\r\n";
			$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
			$header .= "This is a multi-part message in MIME format.\r\n";
			$header .= "--".$uid."\r\n";
			$header .= "Content-type:text/plain; charset=utf-8\r\n";
			$header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
			$header .= $this->body."\r\n\r\n";
			$header .= "--".$uid."\r\n";
			$header .= "Content-Type: text/plain\r\n";
			$header .= "Content-Transfer-Encoding: base64\r\n";
			$header .= "Content-Disposition: attachment; filename=\"".basename($this->filename)."\"\r\n\r\n";
			$header .= $datum."\r\n\r\n";
			$header .= "--".$uid."--";
			$subject = "Database BackUp on".date("D-M-Y");
			
		}else return false;
	}
	function _delete()
	{
		@chmod($this->filename,0777);
		if(!(unlink($this->filename)))
		{
			$this->error = "Unable to Delete File";
			return false;
		}
		return true;
	}
	function _checkMail($address)
	{
		$pattern	= '/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i';
		if(preg_match($pattern,$address))
			return true;
		else {
			$this->error = "Invalid email address";
			return false;
		}
	}
//FOR TESTING THE OUTPUTS OF DIFFERENT FUNCTIONS PURELY DEVELOPMENT USE.
	function test($arr)
	{
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
		die("printr ended");
	}
}
//Class Ends
?>
