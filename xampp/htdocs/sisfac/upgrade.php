<?php
/*
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.

*/
ini_set('max_execution_time', 3000000);
error_reporting(E_ALL);
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);


function needToUpgrade() {

	$upgrade = false;

    $cnn = new Conexion();

    $cnn->abrirConexion();

    $result = mysql_query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES
        WHERE TABLE_SCHEMA = 'bdsicfic' 
        AND ENGINE = 'INNODB'");

    if(mysql_num_rows($result)>0)
    {
        $upgrade = true;
    }

    if(!$upgrade){
	    $result = mysql_query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES
        WHERE TABLE_NAME='sindromecultural'");

	    if(mysql_num_rows($result)==0)
	    {  
	        $upgrade = true;
	    }
    }

    if(!$upgrade){
	    $result = mysql_query("SHOW FUNCTION STATUS WHERE NAME='udf_cleanString'");

	    if(mysql_num_rows($result)==0)
	    {
	        $upgrade = true;
	    }
    }

    if(!$upgrade){
	    $r1 = mysql_query("select idfamilia from familia where claveGeneral like 'M%'");
	    $r2 = mysql_query("select idpersona from persona where claveGeneral like 'M%'");
	    $r3 = mysql_query("select idfamiliah from familiah where claveGeneral like 'M%'");
	    $r4 = mysql_query("select idpersonah from personah where claveGeneral like 'M%'");
	    $r5 = mysql_query("select idcomunidad from comunidad where claveGeneral like 'M%'");

	    if(mysql_num_rows($r1)>0 || mysql_num_rows($r2)>0 || mysql_num_rows($r3)>0 || mysql_num_rows($r4)>0|| mysql_num_rows($r5)>0)
	    {
	        $upgrade = true;
	    }
    }


    if(!$upgrade){

	    $result = mysql_query("SHOW COLUMNS FROM familia LIKE 'fechaModificacion'");
	    
	    if(mysql_num_rows($result)==0){
	       $upgrade = true;
	    }else{

			$r = mysql_query("SELECT claveGeneral, codigoFicha, fechaApertura FROM familia where fechaModificacion is null");
			if(mysql_num_rows($r)>0){
	       		$upgrade = true;
			}
	    }
    }

    if(!$upgrade){

    	$result = mysql_query("SELECT table_name FROM information_schema.tables WHERE table_name = 'acopio'");

	    if(mysql_num_rows($result)==0) {
	       $upgrade = true;
	    }else{

		    $result = mysql_query("SHOW KEYS FROM acopio WHERE Key_name = 'PRIMARY' AND COLUMN_NAME='claveGeneral'");
		    if(mysql_num_rows($result)==0){
	       		$upgrade = true;
		    }

	    }


    }


    if(!$upgrade){

	    $result = mysql_query("SELECT familia.claveGeneral, familia.idfamilia FROM familia LEFT OUTER JOIN familiaH ON(familia.codigoFicha=familiaH.codigoFicha) WHERE familiaH.codigoFicha IS null");

	    if(mysql_num_rows($result)>0){

	        $upgrade = true;
	    }

    }

    
    if(!$upgrade){

	    $result = mysql_query("SELECT count(dni) q, dni FROM persona WHERE dni<>'' AND dni<>'00000000' and dni is not null GROUP BY dni HAVING q>1");
	    if(mysql_num_rows($result)>0){
	       $upgrade = true;
	    
	    }
    }

    
    if(!$upgrade){

	    $result = mysql_query("SELECT persona.* FROM persona LEFT OUTER JOIN familia ON persona.idfamilia=familia.idfamilia WHERE familia.idfamilia IS NULL");
	    if(mysql_num_rows($result)>0){
	       $upgrade = true;
	    }
    }



    if(!$upgrade){

			$result = mysql_query("select * from persona 
			where desendenciaEtnica IN('80.MESTIZO','81.AFRODESCENDIENTE','01.AYMARA','02.URO','03.JAQARU,KAM (JAQI,CAUQUI)','04.CHANCAS','05.CHOPCCAS','06.Q EROS','07.WANCAS','08.OTROS GRUPOS QUECHUAS DEL AREA ANDINA','09.ACHUAR,ACHUAL','10.AMAHUACA','11.AMAIWERI-KISAMBAERI','12.AMARAKAERI','13.ANDOA-SHIMIGAE','14.ANDOKE','15.ARABELLA(CHIRUPINO)','16.ARASAIRE','17.ASHANINKA','18.ASHENINKA','19.AWAJUN(AGUARUNA,AENTS)','20.BORA(MIAMUNA)','21.CACATAIBO(UNI)','22.CAHUARANA(MOROCANO)','23.CANDOSHI-MURATO','24.CAPANAHUA(JUNIKUIN)','25.CAQUINTE(POYENISATI)','26.CASHINAHUA(JUNIKUIN)','27.CHAMICURO(CHAMEKOLO)','28.CHITONAHUA','29.COCAMA-COCAMILLA','30.CUJARENO(INAPARI)','31.CULINA(MADIJA)','32.ESE EJA(HUARAYO)','33.HARAKMBUT','34.HUACHIPAIRE','35.HUAORANI(TAGAERI,TAROMENANE)','36.HUITOTO(INCLUYE MURUI,MENECA,MUNAINE)','37.IQUITO','38.ISCONAHUA','39.JEBERO(SHIWILU,SEWCLO)','40.JIBARO','41.LAMISTO','42.MACHIGUENGA(MATSIGENKA)','43.MASHCO-PIRO','44.MASTANAHUA','45.MAYORUNA(MATSC)','46.MURUNAHUA','47.NANTI','48.NOMATSIGUENGA','49.OCAINA(IVO TSA)','50.OMAGUA','51.OREJON(MAI.HUNA,MAIJUNA)','52.PISABO(MAYO, KANIBO)','53.PUKIRIERI','54.QUICHUA-QUICHUA RUNA,KICHWA','55.RESIGARO','56.SAPITERI','57.SECOYA','58.CHAPRA','59.SHARANAHUA/MARINAHUA','60.SHAWI','61.SHIPIBO-CONIBO-SHETEBO','62.SHUAR','63.TAUSHIRO(PINCHE)','64.TICUNA(DUAXAGU)','65.TOYOERI','66.URARINA(ITUKALE,SHIMACO,KACH)','67.WAMPIS(HUAMBISA)','68.YAGUA(YAWA, NIHAMWO)','69.YAMINAHUA','70.YANESHA(AMUECHA)','71.YINE-YAMI(PIRO)','72.YORA(NAHUA,PARQUENAHUA)','73.OTROS GRUPOS INDIGENAS AMAZONICOS','82.ASIATICODESCENDIENTE','83.OTRO')");

	    if(mysql_num_rows($result)>0){
	       $upgrade = true;
	    }


    }


    
    if(!$upgrade){

	    $result = mysql_query("SELECT idestablecimiento FROM establecimiento WHERE nombreEstablecimiento like 'P.S.%' or  nombreEstablecimiento like 'C.S.%'");
	    if(mysql_num_rows($result)>0){
	       $upgrade = true;
	    }
    }
    
    if(!$upgrade){

	    $result = mysql_query("SELECT idestablecimiento FROM establecimiento WHERE nombreEstablecimiento like 'P. S.%' or  nombreEstablecimiento like 'C. S.%'");
	    if(mysql_num_rows($result)>0){
	       $upgrade = true;
	    }
    }
 
    
    if(!$upgrade){

	    $result = mysql_query("SELECT idfamilia FROM familia WHERE nombreEstablecimiento like 'P.S.%' or  nombreEstablecimiento like 'C.S.%'");
	    if(mysql_num_rows($result)>0){
	       $upgrade = true;
	    }
    }
 
    
    if(!$upgrade){

	    $result = mysql_query("SELECT idfamilia FROM familia WHERE nombreEstablecimiento like 'P. S.%' or  nombreEstablecimiento like 'C. S.%'");
	    if(mysql_num_rows($result)>0){
	       $upgrade = true;
	    }
    }
 
    
    if(!$upgrade){

	    $result = mysql_query("SELECT idfamiliaH FROM familiaH WHERE nombreEstablecimiento like 'P.S.%' or  nombreEstablecimiento like 'C.S.%'");
	    if(mysql_num_rows($result)>0){
	       $upgrade = true;
	    }
    }
 
    
    if(!$upgrade){

	    $result = mysql_query("SELECT idfamiliaH FROM familiaH WHERE nombreEstablecimiento like 'P. S.%' or  nombreEstablecimiento like 'C. S.%'");
	    if(mysql_num_rows($result)>0){
	       $upgrade = true;
	    }
    }

    return $upgrade;

}

function upgrade() {

    $cnn = new Conexion();

    $cnn->abrirConexion();

    $sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES
        WHERE TABLE_SCHEMA = 'bdsicfic' 
        AND ENGINE = 'INNODB'";

    $rs = mysql_query($sql);

    while($row = mysql_fetch_array($rs))
    {
        $tbl = $row[0];
        $sql = "ALTER TABLE `$tbl` ENGINE=MYISAM";
        mysql_query($sql);
    }


	$result = mysql_query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES
        WHERE TABLE_NAME='sindromecultural'");

	if(mysql_num_rows($result)==0)
	{
	        mysql_query("CREATE TABLE `sindromecultural` (
	        	`idsindromecultural` INT(10) UNSIGNED NOT NULL,
	        	`claveGeneral` VARCHAR(100) NOT NULL,
	        	`idfamilia` INT(10) UNSIGNED NULL DEFAULT NULL,
	        	`idpersona` INT(10) UNSIGNED NULL DEFAULT NULL,
	        	`codigo` INT(10) UNSIGNED NULL DEFAULT NULL,
	        	`nombre` VARCHAR(100) NULL DEFAULT NULL,
	        	PRIMARY KEY (`idsindromecultural`, `claveGeneral`)
	        )
	        COLLATE='latin1_swedish_ci'
	        ENGINE=MyISAM");
	}
  


	$result = mysql_query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES
        WHERE TABLE_NAME='sindromeculturalh'");

	if(mysql_num_rows($result)==0)
	{
	        mysql_query("CREATE TABLE `sindromeculturalh` (
			`idsindromeculturalH` INT(10) UNSIGNED NOT NULL,
			`claveGeneral` VARCHAR(100) NOT NULL,
			`idfamiliaH` INT(10) UNSIGNED NULL DEFAULT NULL,
			`idpersonaH` INT(10) UNSIGNED NULL DEFAULT NULL,
			`codigo` INT(10) UNSIGNED NULL DEFAULT NULL,
			`nombre` VARCHAR(100) NULL DEFAULT NULL,
			PRIMARY KEY (`idsindromeculturalH`, `claveGeneral`)
				)
				COLLATE='latin1_swedish_ci'
				ENGINE=MyISAM");

	}



	$result = mysql_query("SHOW FUNCTION STATUS WHERE NAME='udf_cleanString'");


	if(mysql_num_rows($result)==0){

		$sql = "CREATE FUNCTION `udf_cleanString`(`in_str` varchar(4096)) RETURNS varchar(4096) CHARSET utf8
		BEGIN

		      DECLARE out_str VARCHAR(4096) DEFAULT '';
		      DECLARE c VARCHAR(4096) DEFAULT '';
		      DECLARE pointer INT DEFAULT 1;

		      IF ISNULL(in_str) THEN
		            RETURN NULL;
		      ELSE
		            WHILE pointer <= LENGTH(in_str) DO
		                   
		                  SET c = MID(in_str, pointer, 1);

		                  IF ASCII(c) > 31 AND ASCII(c) < 127 THEN
		                        SET out_str = CONCAT(out_str, c);
		                  END IF;

		                  SET pointer = pointer + 1;
		            END WHILE;
		      END IF;

		      RETURN out_str;
		END";
		 mysql_query($sql);
	}
 

    $res = mysql_query("SELECT * from familia where nombrefamilia <> CONVERT(nombrefamilia USING ASCII)");

    if(mysql_num_rows($res)>0){


		mysql_query("UPDATE familia SET nombrefamilia=udf_cleanString(nombrefamilia)  
			WHERE nombrefamilia <> CONVERT(nombrefamilia USING ASCII)");

		mysql_query("UPDATE familia SET nombrefamilia=REPLACE(nombrefamilia, '?', '')
			WHERE nombrefamilia LIKE '%?%'");

    }

    $res = mysql_query("SELECT * from persona where nombre <> CONVERT(nombre USING ASCII)");

    if(mysql_num_rows($res)>0){


		mysql_query("UPDATE persona SET nombre=udf_cleanString(nombre)  
			WHERE nombre <> CONVERT(nombre USING ASCII)");

		mysql_query("UPDATE persona SET nombre=REPLACE(nombre, '?', '')
			WHERE nombre LIKE '%?%'");

    }

    $res = mysql_query("SELECT * from persona where apellidoPaterno <> CONVERT(apellidoPaterno USING ASCII)");

    if(mysql_num_rows($res)>0){


		mysql_query("UPDATE persona SET apellidoPaterno=udf_cleanString(apellidoPaterno)  
			WHERE apellidoPaterno <> CONVERT(apellidoPaterno USING ASCII)");

		mysql_query("UPDATE persona SET apellidoPaterno=REPLACE(apellidoPaterno, '?', '')
			WHERE apellidoPaterno LIKE '%?%'");

    }

    $res = mysql_query("SELECT * from persona where apellidoMaterno <> CONVERT(apellidoMaterno USING ASCII)");

    if(mysql_num_rows($res)>0){


		mysql_query("UPDATE persona SET apellidoMaterno=udf_cleanString(apellidoMaterno)  
			WHERE apellidoMaterno <> CONVERT(apellidoMaterno USING ASCII)");

		mysql_query("UPDATE persona SET apellidoMaterno=REPLACE(apellidoMaterno, '?', '')
			WHERE apellidoMaterno LIKE '%?%'");

    }



	$resultfmc = mysql_query("SHOW COLUMNS FROM familia LIKE 'fechaModificacion'");
	if(mysql_num_rows($resultfmc)==0){

	    mysql_query("ALTER TABLE familia ADD COLUMN fechaModificacion DATETIME NULL");

	}



	$resultfm = mysql_query("SELECT claveGeneral, codigoFicha, fechaApertura FROM familia where fechaModificacion is null");

	while ($row = mysql_fetch_array($resultfm)) {
	        $fecha = $row["fechaApertura"];
	        $query = "SELECT max(fechaHistorial) as fecha FROM familiah where codigoFicha='".$row["codigoFicha"]."' and claveGeneral='".$row["claveGeneral"]."'";
	            $resultfm2 = mysql_query($query);
	            
	            $q = mysql_num_rows($resultfm2);
	            if($q>0){
	                $fila = mysql_fetch_row($resultfm2);
	                $fecha = $fila[0];
	                mysql_free_result($resultfm2);
	            }
	        $query = "update familia set fechaModificacion='".$fecha."' where codigoFicha='".$row["codigoFicha"]."' and claveGeneral='".$row["claveGeneral"]."'";
	        mysql_query($query);
	}
	mysql_free_result($resultfm);


	$resulta = mysql_query("SELECT table_name FROM information_schema.tables WHERE table_name = 'acopio'");
	if(mysql_num_rows($resulta)==0){

	    mysql_query("CREATE TABLE acopio (
	    idacopio int(11) NOT NULL,
	    claveGeneral varchar(100) NOT NULL,
	    fecha datetime NOT NULL,
	    nombreestablecimiento varchar(100) NOT NULL,
	    PRIMARY KEY (idacopio, claveGeneral)
	    ) ENGINE=MyISAM DEFAULT CHARSET=latin1");
	}

	mysql_free_result($resulta);

	$resultak = mysql_query("SHOW KEYS FROM acopio WHERE Key_name = 'PRIMARY' AND COLUMN_NAME='claveGeneral'");

	if(mysql_num_rows($resultak)==0){

	    mysql_query("drop TABLE acopio");

	    mysql_query("CREATE TABLE acopio (
	    idacopio int(11) NOT NULL,
	    claveGeneral varchar(100) NOT NULL,
	    fecha datetime NOT NULL,
	    nombreestablecimiento varchar(100) NOT NULL,
	    PRIMARY KEY (idacopio, claveGeneral)
	    ) ENGINE=MyISAM DEFAULT CHARSET=latin1");
	}



	$resultf = mysql_query("SELECT familia.claveGeneral, familia.idfamilia FROM familia LEFT OUTER JOIN familiaH ON(familia.codigoFicha=familiaH.codigoFicha) WHERE familiaH.codigoFicha IS null");


	if(mysql_num_rows($resultf)>0){

	    while ($row = mysql_fetch_array($resultf)) {
	        mysql_query("DELETE FROM ciclo where idfamilia=".$row["idfamilia"]." and claveGeneral='".$row["claveGeneral"]."'");
	        mysql_query("DELETE FROM condicion where idfamilia=".$row["idfamilia"]." and claveGeneral='".$row["claveGeneral"]."'");
	        mysql_query("DELETE FROM entorno where idfamilia=".$row["idfamilia"]." and claveGeneral='".$row["claveGeneral"]."'");
	        mysql_query("DELETE FROM persona where idfamilia=".$row["idfamilia"]." and claveGeneral='".$row["claveGeneral"]."'");
	        mysql_query("DELETE FROM riesgo where idfamilia=".$row["idfamilia"]." and claveGeneral='".$row["claveGeneral"]."'");
	         mysql_query("DELETE FROM socioeconomico where idfamilia=".$row["idfamilia"]." and claveGeneral='".$row["claveGeneral"]."'");
	        mysql_query("DELETE FROM visita where idfamilia=".$row["idfamilia"]." and claveGeneral='".$row["claveGeneral"]."'");
	        mysql_query("DELETE FROM familia where idfamilia=".$row["idfamilia"]." and claveGeneral='".$row["claveGeneral"]."'");

	    }

	}

	$r1 = mysql_query("select idfamilia from familia where claveGeneral like 'M%'");
    $r2 = mysql_query("select idpersona from persona where claveGeneral like 'M%'");
    $r3 = mysql_query("select idfamiliah from familiah where claveGeneral like 'M%'");
    $r4 = mysql_query("select idpersonah from personah where claveGeneral like 'M%'");
    $r5 = mysql_query("select idcomunidad from comunidad where claveGeneral like 'M%'");

    if(mysql_num_rows($r1)>0 || mysql_num_rows($r2)>0 || mysql_num_rows($r3)>0 || mysql_num_rows($r4)>0|| mysql_num_rows($r5)>0)
    {
	       
		mysql_query("delete from familia where claveGeneral like 'M%'");
	    mysql_query("delete from persona where claveGeneral like 'M%'");
	    mysql_query("delete from familiah where claveGeneral like 'M%'");
	    mysql_query("delete from personah where claveGeneral like 'M%'");
	    mysql_query("delete from comunidad where claveGeneral like 'M%'"); 
    }
  

	$resultdni = mysql_query("SELECT count(dni) q, dni FROM persona WHERE dni<>'' AND dni<>'00000000' and dni is not null GROUP BY dni HAVING q>1");


	if(mysql_num_rows($resultdni)>0){

	    while ($row = mysql_fetch_array($resultdni)) {

	        $resultdni2 = mysql_query("select max(idpersona) as idpersona from persona where dni='".$row["dni"]."'");

	        $row2 = mysql_fetch_array($resultdni2);


	        $resultdni3 = mysql_query("select idpersona, claveGeneral from persona where dni='".$row["dni"]."' and idpersona<".$row2["idpersona"]);


	        
	        if(mysql_num_rows($resultdni3)){

	            while ($row3 = mysql_fetch_array($resultdni3)) {
	                mysql_query("DELETE FROM administracionmicronutrientesnino where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM antecedentefamiliar where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM antecedentefisiologico where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM antecedenteginecobstetrico where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM antecedenteinmunizacion where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM antecedentemedicamento where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM antecedentepatologico where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM antecedentepsicosocial where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM antecedentesexual where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM condicion where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM sindromecultural where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM episodio where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM evaluaciondesarrollo where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM pais where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM prestacionaiepi where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM prestacionalimentacionrn where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM prestacionconsejeria where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM prestacionevaluacionlme where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM prestacionevaluacionnino where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM prestacionexamenintegral where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM riesgo where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM vacuna where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM persona where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	            }
	        }
	    }

	}

	$resultff = mysql_query("SELECT familia.claveGeneral, familia.idfamilia FROM familia
	LEFT OUTER JOIN persona ON(familia.idfamilia=persona.idfamilia)
	WHERE familia.fechaModificacion is null OR persona.idfamilia IS null");

	if(mysql_num_rows($resultff)>0){
	    while ($row = mysql_fetch_array($resultff)) {
	        mysql_query("DELETE FROM ciclo where idfamilia=".$row["idfamilia"]." and claveGeneral='".$row["claveGeneral"]."'");
	        mysql_query("DELETE FROM entorno where idfamilia=".$row["idfamilia"]." and claveGeneral='".$row["claveGeneral"]."'");
	        mysql_query("DELETE FROM persona where idfamilia=".$row["idfamilia"]." and claveGeneral='".$row["claveGeneral"]."'");
	        mysql_query("DELETE FROM riesgo where idfamilia=".$row["idfamilia"]." and claveGeneral='".$row["claveGeneral"]."'");
	        mysql_query("DELETE FROM socioeconomico where idfamilia=".$row["idfamilia"]." and claveGeneral='".$row["claveGeneral"]."'");
	        mysql_query("DELETE FROM visita where idfamilia=".$row["idfamilia"]." and claveGeneral='".$row["claveGeneral"]."'");
	        mysql_query("DELETE FROM familia where idfamilia=".$row["idfamilia"]." and claveGeneral='".$row["claveGeneral"]."'");

	    }
	}


    
    $result = mysql_query("SELECT persona.idpersona, persona.claveGeneral FROM persona LEFT OUTER JOIN familia ON persona.idfamilia=familia.idfamilia WHERE familia.idfamilia IS NULL");
	        if(mysql_num_rows($result)){

	            while ($row3 = mysql_fetch_array($result)) {
	                mysql_query("DELETE FROM administracionmicronutrientesnino where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM antecedentefamiliar where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM antecedentefisiologico where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM antecedenteginecobstetrico where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM antecedenteinmunizacion where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM antecedentemedicamento where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM antecedentepatologico where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM antecedentepsicosocial where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM antecedentesexual where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM condicion where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM episodio where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM evaluaciondesarrollo where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM pais where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM prestacionaiepi where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM prestacionalimentacionrn where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM prestacionconsejeria where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM prestacionevaluacionlme where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM prestacionevaluacionnino where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM prestacionexamenintegral where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM riesgo where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM vacuna where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	                mysql_query("DELETE FROM persona where idpersona=".$row3["idpersona"]." and claveGeneral='".$row3["claveGeneral"]."'");
	            }
	        }

	$result = mysql_query("select * from persona 
			where desendenciaEtnica IN('80.MESTIZO','81.AFRODESCENDIENTE','01.AYMARA','02.URO','03.JAQARU,KAM (JAQI,CAUQUI)','04.CHANCAS','05.CHOPCCAS','06.Q EROS','07.WANCAS','08.OTROS GRUPOS QUECHUAS DEL AREA ANDINA','09.ACHUAR,ACHUAL','10.AMAHUACA','11.AMAIWERI-KISAMBAERI','12.AMARAKAERI','13.ANDOA-SHIMIGAE','14.ANDOKE','15.ARABELLA(CHIRUPINO)','16.ARASAIRE','17.ASHANINKA','18.ASHENINKA','19.AWAJUN(AGUARUNA,AENTS)','20.BORA(MIAMUNA)','21.CACATAIBO(UNI)','22.CAHUARANA(MOROCANO)','23.CANDOSHI-MURATO','24.CAPANAHUA(JUNIKUIN)','25.CAQUINTE(POYENISATI)','26.CASHINAHUA(JUNIKUIN)','27.CHAMICURO(CHAMEKOLO)','28.CHITONAHUA','29.COCAMA-COCAMILLA','30.CUJARENO(INAPARI)','31.CULINA(MADIJA)','32.ESE EJA(HUARAYO)','33.HARAKMBUT','34.HUACHIPAIRE','35.HUAORANI(TAGAERI,TAROMENANE)','36.HUITOTO(INCLUYE MURUI,MENECA,MUNAINE)','37.IQUITO','38.ISCONAHUA','39.JEBERO(SHIWILU,SEWCLO)','40.JIBARO','41.LAMISTO','42.MACHIGUENGA(MATSIGENKA)','43.MASHCO-PIRO','44.MASTANAHUA','45.MAYORUNA(MATSC)','46.MURUNAHUA','47.NANTI','48.NOMATSIGUENGA','49.OCAINA(IVO TSA)','50.OMAGUA','51.OREJON(MAI.HUNA,MAIJUNA)','52.PISABO(MAYO, KANIBO)','53.PUKIRIERI','54.QUICHUA-QUICHUA RUNA,KICHWA','55.RESIGARO','56.SAPITERI','57.SECOYA','58.CHAPRA','59.SHARANAHUA/MARINAHUA','60.SHAWI','61.SHIPIBO-CONIBO-SHETEBO','62.SHUAR','63.TAUSHIRO(PINCHE)','64.TICUNA(DUAXAGU)','65.TOYOERI','66.URARINA(ITUKALE,SHIMACO,KACH)','67.WAMPIS(HUAMBISA)','68.YAGUA(YAWA, NIHAMWO)','69.YAMINAHUA','70.YANESHA(AMUECHA)','71.YINE-YAMI(PIRO)','72.YORA(NAHUA,PARQUENAHUA)','73.OTROS GRUPOS INDIGENAS AMAZONICOS','82.ASIATICODESCENDIENTE','83.OTRO')");

	if(mysql_num_rows($result)>0){
				mysql_query("update persona 
				set desendenciaEtnica='58.MESTIZO' 
				where desendenciaEtnica='80.MESTIZO'");

				mysql_query("update persona 
				set desendenciaEtnica='56.AFROPERUANO' 
				where desendenciaEtnica='81.AFRODESCENDIENTE'");

				mysql_query("update persona 
				set desendenciaEtnica='02.AIMARA' 
				where desendenciaEtnica='01.AYMARA'");

				mysql_query("update persona 
				set desendenciaEtnica='49.URO' 
				where desendenciaEtnica='02.URO'");

				mysql_query("update persona 
				set desendenciaEtnica='19.JAQARU' 
				where desendenciaEtnica='03.JAQARU,KAM (JAQI,CAUQUI)'");

				mysql_query("update persona 
				set desendenciaEtnica='40.QUECHUAS' 
				where desendenciaEtnica IN('04.CHANCAS', '05.CHOPCCAS', '06.Q EROS', '07.WANCAS', '08.OTROS GRUPOS QUECHUAS DEL AREA ANDINA')");

				mysql_query("update persona 
				set desendenciaEtnica='04.ARABELA' 
				where desendenciaEtnica='15.ARABELLA(CHIRUPINO)'");

				mysql_query("update persona 
				set desendenciaEtnica='01.ACHUAR' 
				where desendenciaEtnica='09.ACHUAR,ACHUAL'");

				mysql_query("update persona 
				set desendenciaEtnica='03.AMAHUACA' 
				where desendenciaEtnica='10.AMAHUACA'");

				mysql_query("update persona 
				set desendenciaEtnica='15.HARAKBUT' 
				where desendenciaEtnica 
				IN ('11.AMAIWERI-KISAMBAERI','12.AMARAKAERI','16.ARASAIRE','33.HARAKMBUT','34.HUACHIPAIRE','53.PUKIRIERI','56.SAPITERI','65.TOYOERI')");

				mysql_query("update persona 
				set desendenciaEtnica='05.ASHANINKA' 
				where desendenciaEtnica='17.ASHANINKA'");

				mysql_query("update persona 
				set desendenciaEtnica='06.ASHENINKA' 
				where desendenciaEtnica='18.ASHENINKA'");

				mysql_query("update persona 
				set desendenciaEtnica='07.AWAJUN' 
				where desendenciaEtnica='19.AWAJUN(AGUARUNA,AENTS)'");

				mysql_query("update persona 
				set desendenciaEtnica='08.BORA' 
				where desendenciaEtnica='20.BORA(MIAMUNA)'");

				mysql_query("update persona 
				set desendenciaEtnica='21.KAKATAIBO' 
				where desendenciaEtnica='21.CACATAIBO(UNI)'");

				mysql_query("update persona 
				set desendenciaEtnica='23.KANDOZI' 
				where desendenciaEtnica='23.CANDOSHI-MURATO'");

				mysql_query("update persona 
				set desendenciaEtnica='09.CAPANAHUA' 
				where desendenciaEtnica='24.CAPANAHUA(JUNIKUIN)'");

				mysql_query("update persona 
				set desendenciaEtnica='22.KAKINTE' 
				where desendenciaEtnica='25.CAQUINTE(POYENISATI)'");

				mysql_query("update persona 
				set desendenciaEtnica='10.CASHINAHUA' 
				where desendenciaEtnica='26.CASHINAHUA(JUNIKUIN)'");

				mysql_query("update persona 
				set desendenciaEtnica='11.CHAMICURO' 
				where desendenciaEtnica='27.CHAMICURO(CHAMEKOLO)'");

				mysql_query("update persona 
				set desendenciaEtnica='13.CHITONAHUA' 
				where desendenciaEtnica='28.CHITONAHUA'");

				mysql_query("update persona 
				set desendenciaEtnica='25.KUKAMA KUKAMIRIA' 
				where desendenciaEtnica='29.COCAMA-COCAMILLA'");

				mysql_query("update persona 
				set desendenciaEtnica='29.MASHCO PIRO' 
				where desendenciaEtnica='30.CUJARENO(INAPARI)'");

				mysql_query("update persona 
				set desendenciaEtnica='26.MADIJA' 
				where desendenciaEtnica='31.CULINA(MADIJA)'");

				mysql_query("update persona 
				set desendenciaEtnica='14.ESE EJA' 
				where desendenciaEtnica='32.ESE EJA(HUARAYO)'");

				mysql_query("update persona 
				set desendenciaEtnica='34.MURUI-MUINANI' 
				where desendenciaEtnica='36.HUITOTO(INCLUYE MURUI,MENECA,MUNAINE)'");

				mysql_query("update persona 
				set desendenciaEtnica='16.IKITU' 
				where desendenciaEtnica='37.IQUITO'");

				mysql_query("update persona 
				set desendenciaEtnica='18.ISCONAHUA' 
				where desendenciaEtnica='38.ISCONAHUA'");

				mysql_query("update persona 
				set desendenciaEtnica='46.SHIWILU' 
				where desendenciaEtnica='39.JEBERO(SHIWILU,SEWCLO)'");

				mysql_query("update persona 
				set desendenciaEtnica='20.JIBARO' 
				where desendenciaEtnica='40.JIBARO'");

				mysql_query("update persona 
				set desendenciaEtnica='24.KICHWA' 
				where desendenciaEtnica in ('41.LAMISTO', '54.QUICHUA-QUICHUA RUNA,KICHWA')");

				mysql_query("update persona 
				set desendenciaEtnica='32.MATSIGENKA' 
				where desendenciaEtnica='42.MACHIGUENGA(MATSIGENKA)'");

				mysql_query("update persona 
				set desendenciaEtnica='29.MASHCO PIRO' 
				where desendenciaEtnica='43.MASHCO-PIRO'");

				mysql_query("update persona 
				set desendenciaEtnica='30.MASTANAHUA' 
				where desendenciaEtnica='44.MASTANAHUA'");

				mysql_query("update persona 
				set desendenciaEtnica='31.MATSES' 
				where desendenciaEtnica='45.MAYORUNA(MATSC)'");

				mysql_query("update persona 
				set desendenciaEtnica='13.CHITONAHUA' 
				where desendenciaEtnica='46.MURUNAHUA'");

				mysql_query("update persona 
				set desendenciaEtnica='36.NANTI' 
				where desendenciaEtnica='47.NANTI'");

				mysql_query("update persona 
				set desendenciaEtnica='37.NOMATSIGENGA' 
				where desendenciaEtnica='48.NOMATSIGUENGA'");

				mysql_query("update persona 
				set desendenciaEtnica='38.OCAINA' 
				where desendenciaEtnica='49.OCAINA(IVO TSA)'");

				mysql_query("update persona 
				set desendenciaEtnica='39.OMAGUA' 
				where desendenciaEtnica='50.OMAGUA'");

				mysql_query("update persona 
				set desendenciaEtnica='27.MAIJUNA' 
				where desendenciaEtnica='51.OREJON(MAI.HUNA,MAIJUNA)'");

				mysql_query("update persona 
				set desendenciaEtnica='41.RESIGARO' 
				where desendenciaEtnica='55.RESIGARO'");

				mysql_query("update persona 
				set desendenciaEtnica='42.SECOYA' 
				where desendenciaEtnica='57.SECOYA'");

				mysql_query("update persona 
				set desendenciaEtnica='12.CHAPRA' 
				where desendenciaEtnica='58.CHAPRA'");

				mysql_query("update persona 
				set desendenciaEtnica='43.SHARANAHUA' 
				where desendenciaEtnica='59.SHARANAHUA/MARINAHUA'");

				mysql_query("update persona 
				set desendenciaEtnica='44.SHAWI' 
				where desendenciaEtnica='60.SHAWI'");

				mysql_query("update persona 
				set desendenciaEtnica='45.SHIPIBO-KONIBO' 
				where desendenciaEtnica='61.SHIPIBO-CONIBO-SHETEBO'");

				mysql_query("update persona 
				set desendenciaEtnica='01.ACHUAR' 
				where desendenciaEtnica='62.SHUAR'");

				mysql_query("update persona 
				set desendenciaEtnica='47.TIKUNA' 
				where desendenciaEtnica='64.TICUNA(DUAXAGU)'");

				mysql_query("update persona 
				set desendenciaEtnica='48.URARINA' 
				where desendenciaEtnica='66.URARINA(ITUKALE,SHIMACO,KACH)'");

				mysql_query("update persona 
				set desendenciaEtnica='51.WAMPIS' 
				where desendenciaEtnica='67.WAMPIS(HUAMBISA)'");

				mysql_query("update persona 
				set desendenciaEtnica='52.YAGUA' 
				where desendenciaEtnica='68.YAGUA(YAWA, NIHAMWO)'");

				mysql_query("update persona 
				set desendenciaEtnica='53.YAMINAHUA' 
				where desendenciaEtnica='69.YAMINAHUA'");

				mysql_query("update persona 
				set desendenciaEtnica='54.YANESHA' 
				where desendenciaEtnica='70.YANESHA(AMUECHA)'");

				mysql_query("update persona 
				set desendenciaEtnica='55.YINE' 
				where desendenciaEtnica='71.YINE-YAMI(PIRO)'");

				mysql_query("update persona 
				set desendenciaEtnica='35.NAHUA' 
				where desendenciaEtnica='72.YORA(NAHUA,PARQUENAHUA)'");

				mysql_query("update persona 
				set desendenciaEtnica='59.ASIATICO DESCENDIENTE' 
				where desendenciaEtnica='82.ASIATICODESCENDIENTE'");

				mysql_query("update persona 
				set desendenciaEtnica='60.OTRO' 
				where desendenciaEtnica in ('83.OTRO', '13.ANDOA-SHIMIGAE', '14.ANDOKE', '22.CAHUARANA(MOROCANO)', '35.HUAORANI(TAGAERI,TAROMENANE)','52.PISABO(MAYO, KANIBO)','63.TAUSHIRO(PINCHE)','73.OTROS GRUPOS INDIGENAS AMAZONICOS')");
		    

		    }
////////////////////
	$result = mysql_query("SELECT idestablecimiento FROM establecimiento WHERE nombreEstablecimiento like 'P.S.%' or nombreEstablecimiento like 'C.S.%'");
    
	if(mysql_num_rows($result)>0){
		mysql_query("update establecimiento set nombreEstablecimiento=trim(substr(nombreEstablecimiento,5)) WHERE nombreEstablecimiento like 'P.S.%' or nombreEstablecimiento like 'C.S.%'");
    }

	$result = mysql_query("SELECT idestablecimiento FROM establecimiento WHERE nombreEstablecimiento like 'P.S.%' or nombreEstablecimiento like 'C.S.%'");
    
	if(mysql_num_rows($result)>0){
		mysql_query("update establecimiento set nombreEstablecimiento=trim(substr(nombreEstablecimiento,5)) WHERE nombreEstablecimiento like 'P.S.%' or nombreEstablecimiento like 'C.S.%'");
    }

	$result = mysql_query("SELECT idestablecimiento FROM establecimiento WHERE nombreEstablecimiento like 'P. S.%' or nombreEstablecimiento like 'C. S.%'");
    
	if(mysql_num_rows($result)>0){
		mysql_query("update establecimiento set nombreEstablecimiento=trim(substr(nombreEstablecimiento,6)) WHERE nombreEstablecimiento like 'P. S.%' or nombreEstablecimiento like 'C. S.%'");
    }
///////////////////////////
	$result = mysql_query("SELECT idfamilia FROM familia WHERE nombreEstablecimiento like 'P.S.%' or  nombreEstablecimiento like 'C.S.%'");

	if(mysql_num_rows($result)>0){
		mysql_query("update familia set nombreEstablecimiento=trim(substr(nombreEstablecimiento,5)) WHERE nombreEstablecimiento like 'P.S.%' or nombreEstablecimiento like 'C.S.%'");
    }
	$result = mysql_query("SELECT idfamilia FROM familia WHERE nombreEstablecimiento like 'P.S.%' or  nombreEstablecimiento like 'C.S.%'");

	if(mysql_num_rows($result)>0){
		mysql_query("update familia set nombreEstablecimiento=trim(substr(nombreEstablecimiento,5)) WHERE nombreEstablecimiento like 'P.S.%' or nombreEstablecimiento like 'C.S.%'");
    }

	$result = mysql_query("SELECT idfamilia FROM familia WHERE nombreEstablecimiento like 'P. S.%' or  nombreEstablecimiento like 'C. S.%'");

	if(mysql_num_rows($result)>0){
		mysql_query("update familia set nombreEstablecimiento=trim(substr(nombreEstablecimiento,6)) WHERE nombreEstablecimiento like 'P. S.%' or nombreEstablecimiento like 'C. S.%'");
    }
///////////////////////////

	$result = mysql_query("SELECT idfamiliaH FROM familiaH WHERE nombreEstablecimiento like 'P.S.%' or  nombreEstablecimiento like 'C.S.%'");

	if(mysql_num_rows($result)>0){
		mysql_query("update familiaH set nombreEstablecimiento=trim(substr(nombreEstablecimiento,5)) WHERE nombreEstablecimiento like 'P.S.%' or nombreEstablecimiento like 'C.S.%'");
    }

	$result = mysql_query("SELECT idfamiliaH FROM familiaH WHERE nombreEstablecimiento like 'P.S.%' or  nombreEstablecimiento like 'C.S.%'");

	if(mysql_num_rows($result)>0){
		mysql_query("update familiaH set nombreEstablecimiento=trim(substr(nombreEstablecimiento,5)) WHERE nombreEstablecimiento like 'P.S.%' or nombreEstablecimiento like 'C.S.%'");
    }

	$result = mysql_query("SELECT idfamiliaH FROM familiaH WHERE nombreEstablecimiento like 'P. S.%' or  nombreEstablecimiento like 'C. S.%'");

	if(mysql_num_rows($result)>0){
		mysql_query("update familiaH set nombreEstablecimiento=trim(substr(nombreEstablecimiento,6)) WHERE nombreEstablecimiento like 'P. S.%' or nombreEstablecimiento like 'C. S.%'");
    }

}
?>