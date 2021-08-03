<?php
/*Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.

*/
$consulta = "
    ALTER TABLE  `familiaH` ADD  `idcomunidad` INT NULL;
    ALTER TABLE  `familiaH` ADD  `nombreComunidad` VARCHAR( 100 ) NULL;
    ALTER TABLE  `familiaH` ADD  `idestablecimiento` INT NULL;
    ALTER TABLE  `familiaH` ADD  `nombreEstablecimiento` VARCHAR( 100 ) NULL;
    ALTER TABLE  `familiaH` ADD  `iddistrito` INT NULL;
    ALTER TABLE  `familiaH` ADD  `nombre` VARCHAR( 100 ) NULL;
    ALTER TABLE  `familiaH` ADD  `idprovincia` INT NULL;
    ALTER TABLE  `familiaH` ADD  `nompro` VARCHAR( 100 ) NULL;
    ALTER TABLE  `familiaH` ADD  `idregion` INT NULL;
    ALTER TABLE  `familiaH` ADD  `nombreRegion` VARCHAR( 100 ) NULL;
    ALTER TABLE  `familiaH` ADD  `idnucleo` INT NULL;
    ALTER TABLE  `familiaH` ADD  `nombreNucleo` VARCHAR( 100 ) NULL;
    ALTER TABLE  `familiaH` ADD  `idmicrored` INT NULL;
    ALTER TABLE  `familiaH` ADD  `nombreMicrored` VARCHAR( 100 ) NULL;
    ALTER TABLE  `familiaH` ADD  `idred` INT NULL;
    ALTER TABLE  `familiaH` ADD  `nombreRed` VARCHAR( 100 ) NULL;
    ALTER TABLE  `familiaH` ADD  `iddiresa` INT NULL;
    ALTER TABLE  `familiaH` ADD  `nombreDiresa` VARCHAR( 100 ) NULL;


    ALTER TABLE  `familia` ADD  `nombreSector` VARCHAR( 100 ) NULL;
    ALTER TABLE  `familia` ADD  `idcomunidad` INT NULL;
    ALTER TABLE  `familia` ADD  `nombreComunidad` VARCHAR( 100 ) NULL;
    ALTER TABLE  `familia` ADD  `idestablecimiento` INT NULL;
    ALTER TABLE  `familia` ADD  `nombreEstablecimiento` VARCHAR( 100 ) NULL;
    ALTER TABLE  `familia` ADD  `iddistrito` INT NULL;
    ALTER TABLE  `familia` ADD  `nombre` VARCHAR( 100 ) NULL;
    ALTER TABLE  `familia` ADD  `idprovincia` INT NULL;
    ALTER TABLE  `familia` ADD  `nompro` VARCHAR( 100 ) NULL;
    ALTER TABLE  `familia` ADD  `idregion` INT NULL;
    ALTER TABLE  `familia` ADD  `nombreRegion` VARCHAR( 100 ) NULL;
    ALTER TABLE  `familia` ADD  `idnucleo` INT NULL;
    ALTER TABLE  `familia` ADD  `nombreNucleo` VARCHAR( 100 ) NULL;
    ALTER TABLE  `familia` ADD  `idmicrored` INT NULL;
    ALTER TABLE  `familia` ADD  `nombreMicrored` VARCHAR( 100 ) NULL;
    ALTER TABLE  `familia` ADD  `idred` INT NULL;
    ALTER TABLE  `familia` ADD  `nombreRed` VARCHAR( 100 ) NULL;
    ALTER TABLE  `familia` ADD  `iddiresa` INT NULL;
    ALTER TABLE  `familia` ADD  `nombreDiresa` VARCHAR( 100 ) NULL;
    ";
$consulta = explode(';', $consulta);
foreach ($consulta as $value) {
    mysql_query($value);
}

//echo $query.'sssss';

$query = "
        CREATE FUNCTION `sf_maxfam`(cf VARCHAR(20),fechaFin VARCHAR(20)) RETURNS int(10)
        BEGIN
           DECLARE ID INT(10);
           SELECT MAX(fam1.idfamiliaH) INTO ID FROM familiaH fam1 WHERE fam1.codigoFicha = cf AND fechaHistorial<= fechaFin;
           RETURN ID;
        END
";
mysql_query($query);

$query = "
        CREATE FUNCTION `sf_punrie`(id INT,cg VARCHAR(50)) RETURNS int(10)
        BEGIN
           DECLARE PUN INT(10);
           SELECT SUM(puntaje) INTO PUN FROM riesgoH WHERE idfamiliaH = id AND claveGeneral = cg;
           RETURN PUN;
        END

";
mysql_query($query);

$query = "
        CREATE FUNCTION `sf_punsoc`(id INT,cg VARCHAR(50)) RETURNS int(10)
        BEGIN
           DECLARE PUN INT(10);
           SELECT SUM(puntaje) INTO PUN FROM socioeconomicoH WHERE idfamiliaH=id AND claveGeneral = cg;
           RETURN PUN;
        END
";
mysql_query($query);



$query = "SELECT numeroVivienda FROM familia";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) {
    if(strlen($row[0]) == 4){
        $nroVivienda = substr($row[0], 1, 3);
        mysql_query("UPDATE familia SET numeroVivienda = '$nroVivienda' WHERE numeroVivienda = '$row[0]'");
    }
}


$query = "SELECT codigoFicha FROM familia";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) {
    if(strlen($row[0]) == 11){
        $cod = substr($row[0], 0, 3).strtolower(substr($row[0], 3, 3)).substr($row[0], 7, 11);
        mysql_query("UPDATE familia SET codigoFicha = '$cod' WHERE codigoFicha = '$row[0]'");
        mysql_query("UPDATE familiaH SET codigoFicha = '$cod' WHERE codigoFicha = '$row[0]'");
    }
}

$query = "SELECT codigoFicha FROM familiaH";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) {
    if(strlen($row[0]) == 11){
        $cod = substr($row[0], 0, 3).strtolower(substr($row[0], 3, 3)).substr($row[0], 7, 11);
        mysql_query("UPDATE familiaH SET codigoFicha = '$cod' WHERE codigoFicha = '$row[0]'");
    }
}



$query = "INSERT INTO usuario(claveGeneral, idusuario, idtrabajador, usuario, tipo, clave, estado) 
VALUES ((SELECT claveGeneral FROM datoGeneral LIMIT 0,1),99,0,'ADMINSUPERUSUARIO','ADM','72025cb649fa179630e630c5c1b9049d',1) ";
mysql_query($query);
$query = "INSERT INTO vistausuario(claveGeneral, idvistausuario, idvista, idusuario, privilegios) 
            VALUES ((SELECT claveGeneral FROM datoGeneral LIMIT 0,1),998,1,99,'index.php'); ";
mysql_query($query);
$query = "INSERT INTO vistausuario(claveGeneral, idvistausuario, idvista, idusuario, privilegios)  
            VALUES ((SELECT claveGeneral FROM datoGeneral LIMIT 0,1),999,2,99,'index.php'); ";
mysql_query($query);


$query = "INSERT INTO usuario(claveGeneral, idusuario, idtrabajador, usuario, tipo, clave, estado) 
VALUES ((SELECT claveGeneral FROM datoGeneral LIMIT 0,1),100,0,'SUPERUSUARIO','ADM','57f21ea16a747c4fd9af13f5b25229ea',1) ";
mysql_query($query);
$query = "INSERT INTO vistausuario(claveGeneral, idvistausuario, idvista, idusuario, privilegios) 
            VALUES ((SELECT claveGeneral FROM datoGeneral LIMIT 0,1),1000,1,100,'index.php'); ";
mysql_query($query);
$query = "INSERT INTO vistausuario(claveGeneral, idvistausuario, idvista, idusuario, privilegios)  
            VALUES ((SELECT claveGeneral FROM datoGeneral LIMIT 0,1),1001,2,100,'index.php'); ";
mysql_query($query);


//ACTUALIZAMOS LA TABLA ESTABLECIMIENTO

$query = "
        ALTER TABLE  establecimiento ADD  denominacion VARCHAR( 50 ) NOT NULL ,
        ADD  aisped INT NOT NULL ,
        ADD  nivel VARCHAR( 50 ) NOT NULL";
mysql_query($query);

//AGREGRAMOS TABLA COLEGIOS PROFESIONALES

$query = "CREATE TABLE  colegioProfesional (
    idcolegioProfesional INT NOT NULL PRIMARY KEY ,
    valor CHAR( 2 ) NOT NULL ,
    colegio VARCHAR( 100 ) NOT NULL
    ) ENGINE = MYISAM ;
";
mysql_query($query);

$query = "INSERT INTO  colegioprofesional(idcolegioProfesional,valor,colegio) VALUES (1 ,  '00',  'PERSONAL DE SALUD SIN COLEGIATURA')";
mysql_query($query);
$query = "INSERT INTO  colegioprofesional(idcolegioProfesional,valor,colegio) VALUES (2 ,  '01',  'COLEGIO MEDICO DEL PERU')";
mysql_query($query);
$query = "INSERT INTO  colegioprofesional(idcolegioProfesional,valor,colegio) VALUES (3 ,  '02',  'COLEGIO QUIMICO FARMACEUTICO DEL PERU')";
mysql_query($query);
$query = "INSERT INTO  colegioprofesional(idcolegioProfesional,valor,colegio) VALUES (4 ,  '03',  'COLEGIO ODONTOLOGICO DEL PERU')";
mysql_query($query);
$query = "INSERT INTO  colegioprofesional(idcolegioProfesional,valor,colegio) VALUES (5 ,  '04',  'COLEGIO DE BIOLOGOS DEL PERU')";
mysql_query($query);
$query = "INSERT INTO  colegioprofesional(idcolegioProfesional,valor,colegio) VALUES (6 ,  '05',  'COLEGIO DE OBSTETRICES DEL PERU')";
mysql_query($query);
$query = "INSERT INTO  colegioprofesional(idcolegioProfesional,valor,colegio) VALUES (7 ,  '06',  'COLEGIO DE ENFERMEROS DEL PERU')";
mysql_query($query);
$query = "INSERT INTO  colegioprofesional(idcolegioProfesional,valor,colegio) VALUES (8 ,  '07',  'COLEGIO DE TRABAJADORES SOCIALES DEL PERU')";
mysql_query($query);
$query = "INSERT INTO  colegioprofesional(idcolegioProfesional,valor,colegio) VALUES (9 ,  '08',  'COLEGIO DE PSICOLOGOS DEL PERU')";
mysql_query($query);
$query = "INSERT INTO  colegioprofesional(idcolegioProfesional,valor,colegio) VALUES (10 ,  '09',  'COLEGIO TECNOLOGO MEDICO DEL PERU')";
mysql_query($query);
$query = "INSERT INTO  colegioprofesional(idcolegioProfesional,valor,colegio) VALUES (11 ,  '10',  'COLEGIO DE NUTRICIONISTAS DEL PERU')";
mysql_query($query);

$query = "CREATE TABLE catalogoColegio (
          idcatalogoColegio INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
          codigoColegio VARCHAR(10) NULL,
          nombre TEXT NULL,
          PRIMARY KEY(idcatalogoColegio)
        )";
mysql_query($query);

$query = "CREATE TABLE condicionTrabajador (
      idcondicionTrabajador INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
      codigoCondicionTrabajador VARCHAR(10) NULL,
      nombre TEXT NULL,
      PRIMARY KEY(idcondicionTrabajador)
    )";
mysql_query($query);
//ACTUALIZAMOS LA TABLA TRABAJADOR

$query = "ALTER TABLE trabajador ADD  opcionDocumento VARCHAR( 50 ) NOT NULL ,
            ADD nroDocumento VARCHAR( 20 ) NOT NULL ,
            ADD nroColegiatura VARCHAR( 20 ) NOT NULL ,
            ADD idcatalogoColegio INT NOT NULL,
            ADD idcondicionTrabajador INT NOT NULL,
            ADD idprofesion INT NOT NULL";
mysql_query($query);

//ACTUALIZAMOS LA TABLA PERSONA 

$query = "ALTER TABLE  persona ADD  grupoSanguineo CHAR( 4 ) NOT NULL AFTER  motivo ,
            ADD  grupoRiesgo VARCHAR( 50 ) NOT NULL AFTER  grupoSanguineo,
            ADD  opcionLugarResidencia CHAR( 2 ) NOT NULL AFTER  grupoRiesgo ,
            ADD  lugarResidencia VARCHAR( 50 ) NOT NULL AFTER  opcionLugarResidencia ,
            ADD  contacto VARCHAR( 100 ) NOT NULL AFTER  lugarResidencia ,
            ADD  telefonoContacto VARCHAR( 20 ) NOT NULL AFTER  contacto ,
            ADD  parentescoContacto VARCHAR( 30 ) NOT NULL AFTER  telefonoContacto
        ";
mysql_query($query);

$query = "ALTER TABLE  persona CHANGE  opcionDNI  opcionDNI VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL";
mysql_query($query);

$query = "ALTER TABLE  personaH CHANGE  opcionDNI  opcionDNI VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL";
mysql_query($query);

$query = "UPDATE  persona SET  opcionDNI =  'NO TIENE DNI/DNI EN TRAMITE' WHERE opcionDNI = 'DNI EN TRAMITE' || opcionDNI = 'NO TIENE DNI' ";
mysql_query($query);
$query = "UPDATE  personaH SET  opcionDNI =  'NO TIENE DNI/DNI EN TRAMITE' WHERE opcionDNI = 'DNI EN TRAMITE' || opcionDNI = 'NO TIENE DNI'";
mysql_query($query);

$query = "UPDATE  persona SET  opcionDNI =  'NO TIENE DNI/DNI EN TRAMITE' WHERE opcionDNI = 'NO TIENE DNI/DNI EN ' ";
mysql_query($query);
$query = "UPDATE  personaH SET  opcionDNI =  'NO TIENE DNI/DNI EN TRAMITE' WHERE opcionDNI = 'NO TIENE DNI/DNI EN ' ";
mysql_query($query);

$query = "UPDATE  persona SET  opcionDNI =  'DNI' WHERE opcionDNI = 'TIENE DNI'";
mysql_query($query);
$query = "UPDATE  personaH SET  opcionDNI =  'DNI' WHERE opcionDNI = 'TIENE DNI'";
mysql_query($query);

//ACTUALIZAMOS LA TABLA PERSONAH

$query = "ALTER TABLE  personah ADD  grupoSanguineo CHAR( 4 ) NOT NULL AFTER  desendenciaEtnica,
            ADD  grupoRiesgo VARCHAR( 50 ) NOT NULL AFTER  grupoSanguineo,
            ADD  opcionLugarResidencia CHAR( 2 ) NOT NULL AFTER  grupoRiesgo ,
            ADD  lugarResidencia VARCHAR( 50 ) NOT NULL AFTER  opcionLugarResidencia ,
            ADD  contacto VARCHAR( 100 ) NOT NULL AFTER  lugarResidencia ,
            ADD  telefonoContacto VARCHAR( 20 ) NOT NULL AFTER  contacto ,
            ADD  parentescoContacto VARCHAR( 30 ) NOT NULL AFTER  telefonoContacto
        ";
mysql_query($query);

$query = "ALTER TABLE  personah CHANGE  opcionDNI  opcionDNI VARCHAR( 30 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL";
mysql_query($query);

//ACTUALIZAMOS TABLA FAMILIA

$query = "SELECT DISTINCT idfamilia,idsector,claveGeneral FROM familia WHERE nombreSector is NULL";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) {
    $query1 =  "
        SELECT DISTINCT sec.idsector, sec.nombreSector, com.idcomunidad, com.nombreComunidad, est.idestablecimiento, est.nombreEstablecimiento, dis.iddistrito, 
        dis.nombre, pro.idprovincia, pro.nompro, reg.idregion, reg.nombreRegion, nuc.idnucleo, nuc.nombreNucleo, mic.idmicrored, mic.nombreMicrored, red.idred, 
        red.nombreRed, dir.iddiresa, dir.nombreDiresa
        FROM sector sec 
        INNER JOIN comunidad com ON com.idcomunidad=sec.idcomunidad AND com.claveGeneral=sec.claveGeneral AND idsector = $row[idsector] AND sec.claveGeneral = '$row[claveGeneral]'
        INNER JOIN establecimiento est ON est.idestablecimiento=com.idestablecimiento AND est.claveGeneral=com.claveGeneral 
        INNER JOIN distrito dis ON dis.iddistrito=est.iddistrito AND dis.claveGeneral=est.claveGeneral 
        INNER JOIN provincia pro ON pro.idprovincia=dis.idprovincia AND pro.claveGeneral=dis.claveGeneral 
        INNER JOIN region reg ON reg.idregion = pro.idregion AND reg.claveGeneral=pro.claveGeneral 
        INNER JOIN nucleo nuc ON nuc.idnucleo = est.idnucleo AND nuc.claveGeneral = est.claveGeneral 
        INNER JOIN microred mic ON mic.idmicrored = nuc.idmicrored AND mic.claveGeneral = nuc.claveGeneral 
        INNER JOIN red ON red.idred=mic.idred AND red.claveGeneral = mic.claveGeneral  
        INNER JOIN diresa dir ON dir.iddiresa=red.iddiresa AND dir.claveGeneral=red.claveGeneral;
        ";
    $row1 = mysql_fetch_array(mysql_query($query1));

    $querya = "UPDATE familia SET nombreSector = '$row1[nombreSector]', idcomunidad = $row1[idcomunidad], nombreComunidad = '$row1[nombreComunidad]', idestablecimiento = $row1[idestablecimiento], nombreEstablecimiento = '$row1[nombreEstablecimiento]', iddistrito = $row1[iddistrito], 
                nombre = '$row1[nombre]', idprovincia = $row1[idprovincia], nompro = '$row1[nompro]', idregion = $row1[idregion], nombreRegion = '$row1[nombreRegion]', idnucleo = $row1[idnucleo], nombreNucleo = '$row1[nombreNucleo]', 
                idmicrored = $row1[idmicrored], nombreMicrored = '$row1[nombreMicrored]', idred = $row1[idred], nombreRed = '$row1[nombreRed]', iddiresa = $row1[iddiresa], nombreDiresa = '$row1[nombreDiresa]'
                WHERE idfamilia = $row[idfamilia] AND idsector = $row[idsector] AND claveGeneral = '$row[claveGeneral]'";
    mysql_query($querya);
}

//ACTUALIZAMOS TABLA FAMILIAH

$query = "SELECT DISTINCT idfamiliaH,idsector,claveGeneral FROM familiaH WHERE idcomunidad is NULL";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) {
    $query1 =  "
        SELECT DISTINCT sec.idsector, sec.nombreSector, com.idcomunidad, com.nombreComunidad, est.idestablecimiento, est.nombreEstablecimiento, dis.iddistrito, 
        dis.nombre, pro.idprovincia, pro.nompro, reg.idregion, reg.nombreRegion, nuc.idnucleo, nuc.nombreNucleo, mic.idmicrored, mic.nombreMicrored, red.idred, 
        red.nombreRed, dir.iddiresa, dir.nombreDiresa
        FROM sector sec 
        INNER JOIN comunidad com ON com.idcomunidad=sec.idcomunidad AND com.claveGeneral=sec.claveGeneral AND idsector = $row[idsector] AND sec.claveGeneral = '$row[claveGeneral]'
        INNER JOIN establecimiento est ON est.idestablecimiento=com.idestablecimiento AND est.claveGeneral=com.claveGeneral 
        INNER JOIN distrito dis ON dis.iddistrito=est.iddistrito AND dis.claveGeneral=est.claveGeneral 
        INNER JOIN provincia pro ON pro.idprovincia=dis.idprovincia AND pro.claveGeneral=dis.claveGeneral 
        INNER JOIN region reg ON reg.idregion = pro.idregion AND reg.claveGeneral=pro.claveGeneral 
        INNER JOIN nucleo nuc ON nuc.idnucleo = est.idnucleo AND nuc.claveGeneral = est.claveGeneral 
        INNER JOIN microred mic ON mic.idmicrored = nuc.idmicrored AND mic.claveGeneral = nuc.claveGeneral 
        INNER JOIN red ON red.idred=mic.idred AND red.claveGeneral = mic.claveGeneral  
        INNER JOIN diresa dir ON dir.iddiresa=red.iddiresa AND dir.claveGeneral=red.claveGeneral;
        ";
    $row1 = mysql_fetch_array(mysql_query($query1));
    //echo $query1."sss</br>";
    $querya = "UPDATE familiaH SET idcomunidad = $row1[idcomunidad], nombreComunidad = '$row1[nombreComunidad]', idestablecimiento = $row1[idestablecimiento], nombreEstablecimiento = '$row1[nombreEstablecimiento]', iddistrito = $row1[iddistrito], 
                nombre = '$row1[nombre]', idprovincia = $row1[idprovincia], nompro = '$row1[nompro]', idregion = $row1[idregion], nombreRegion = '$row1[nombreRegion]', idnucleo = $row1[idnucleo], nombreNucleo = '$row1[nombreNucleo]', 
                idmicrored = $row1[idmicrored], nombreMicrored = '$row1[nombreMicrored]', idred = $row1[idred], nombreRed = '$row1[nombreRed]', iddiresa = $row1[iddiresa], nombreDiresa = '$row1[nombreDiresa]'
                WHERE idfamiliaH = $row[idfamiliaH] AND idsector = $row[idsector] AND claveGeneral = '$row[claveGeneral]'";
    mysql_query($querya);
}


//ACTUALIZAMOS TABLA PERSONA
/*
$query = "SELECT DISTINCT idpersona,iddistrito,claveGeneral FROM persona WHERE idcomunidad is NULL";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) {
    $query1 =  "
        SELECT DISTINCT sec.idsector, sec.nombreSector, com.idcomunidad, com.nombreComunidad, est.idestablecimiento, est.nombreEstablecimiento, dis.iddistrito, 
        dis.nombre, pro.idprovincia, pro.nompro, reg.idregion, reg.nombreRegion, nuc.idnucleo, nuc.nombreNucleo, mic.idmicrored, mic.nombreMicrored, red.idred, 
        red.nombreRed, dir.iddiresa, dir.nombreDiresa
        FROM sector sec 
        INNER JOIN comunidad com ON com.idcomunidad=sec.idcomunidad AND com.claveGeneral=sec.claveGeneral 
        INNER JOIN establecimiento est ON est.idestablecimiento=com.idestablecimiento AND est.claveGeneral=com.claveGeneral 
        INNER JOIN distrito dis ON dis.iddistrito=est.iddistrito AND dis.claveGeneral=est.claveGeneral AND dis.iddistrito = $row[iddistrito] AND dis.claveGeneral = '$row[claveGeneral]'
        INNER JOIN provincia pro ON pro.idprovincia=dis.idprovincia AND pro.claveGeneral=dis.claveGeneral 
        INNER JOIN region reg ON reg.idregion = pro.idregion AND reg.claveGeneral=pro.claveGeneral 
        INNER JOIN nucleo nuc ON nuc.idnucleo = est.idnucleo AND nuc.claveGeneral = est.claveGeneral 
        INNER JOIN microred mic ON mic.idmicrored = nuc.idmicrored AND mic.claveGeneral = nuc.claveGeneral 
        INNER JOIN red ON red.idred=mic.idred AND red.claveGeneral = mic.claveGeneral  
        INNER JOIN diresa dir ON dir.iddiresa=red.iddiresa AND dir.claveGeneral=red.claveGeneral;
        ";
    $row1 = mysql_fetch_array(mysql_query($query1));
    //echo $query1."sss</br>";
    $querya = "UPDATE persona SET idsector = $row1[idsector], nombreSector = '$row1[nombreSector]', idcomunidad = $row1[idcomunidad], nombreComunidad = '$row1[nombreComunidad]', idestablecimiento = $row1[idestablecimiento], nombreEstablecimiento = '$row1[nombreEstablecimiento]', 
                nombreDistrito = '$row1[nombre]', idprovincia = $row1[idprovincia], nompro = '$row1[nompro]', idregion = $row1[idregion], nombreRegion = '$row1[nombreRegion]', idnucleo = $row1[idnucleo], nombreNucleo = '$row1[nombreNucleo]', 
                idmicrored = $row1[idmicrored], nombreMicrored = '$row1[nombreMicrored]', idred = $row1[idred], nombreRed = '$row1[nombreRed]', iddiresa = $row1[iddiresa], nombreDiresa = '$row1[nombreDiresa]'
                WHERE idpersona = $row[idpersona] AND iddistrito = $row[iddistrito] AND claveGeneral = '$row[claveGeneral]'";
    mysql_query($querya);
}*/

//MODIFICAMOS LA TABLA DATOGENERAL

$query = "ALTER TABLE datogeneral ADD  claves VARCHAR( 100 ) NOT NULL AFTER  claveGeneral";
mysql_query($query);

//$query = "TRUNCATE TABLE establecimiento";
//mysql_query($query);

//CREAMOS LA FICHA CLINICA

//CREAMOS TABLA DE ANTECEDENTES

$query = "CREATE TABLE tipoTransmisibleCIE10 (
          idtipoTransmisibleCIE10 INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
          codigoTipoTransmisibleCIE10 VARCHAR(10) NULL,
          nombreTipoTransmisibleCIE10 TEXT NULL,
          PRIMARY KEY(idtipoTransmisibleCIE10)
        )";
mysql_query($query);

$query = "CREATE TABLE catalogoVacuna (
          idcatalogoVacuna INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
          nombreVacuna VARCHAR(100) NULL,
          dosis INTEGER UNSIGNED NULL,
          descripcionVacuna TEXT NULL,
          descripcionIntervalo TEXT NULL,
          limiteInferior INTEGER UNSIGNED NULL,
          limiteSuperior INTEGER UNSIGNED NULL,
          PRIMARY KEY(idcatalogoVacuna)
        )";

mysql_query($query);

$query = "CREATE TABLE catalogoPerfilLaboratorio (
          idcatalogoPerfilLaboratorio INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
          nombrePerfil TEXT NULL,
          descripcion TEXT NULL,
          PRIMARY KEY(idcatalogoPerfilLaboratorio)
        )";

mysql_query($query);

$query = "CREATE TABLE catalogoExamenLaboratorio (
          idcatalogoExamenLaboratorio INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
          idcatalogoPerfilLaboratorio INTEGER UNSIGNED NOT NULL,
          tipoExamen TEXT NULL,
          nombreExamenLaboratorio TEXT NULL,
          unidades TEXT NULL,
          rangosNormales TEXT NULL,
          opExamen CHAR(2) NULL,
          PRIMARY KEY(idcatalogoExamenLaboratorio)
        )";

mysql_query($query);

$query = "CREATE TABLE catalogoEpisodioPrestacion (
          idcatalogoEpisodioPrestacion INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
          idcatalogoPrestacion INTEGER UNSIGNED NOT NULL,
          idcatalogoEpisodio INTEGER UNSIGNED NOT NULL,
          orden INTEGER UNSIGNED NULL,
          comentario TEXT NULL,
          factorProgramacion INTEGER UNSIGNED NULL,
          opActivo CHAR(2) NULL,
          PRIMARY KEY(idcatalogoEpisodioPrestacion)
        )";

mysql_query($query);

$query = "CREATE TABLE catalogoUPS (
          idcatalogoUPS INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
          codigoUPS VARCHAR(10) NULL,
          nombreUPS TEXT NULL,
          sexoUPS VARCHAR(20) NULL,
          edadMinima INTEGER UNSIGNED NULL,
          tipoMinimo VARCHAR(100) NULL,
          edadMaxima INTEGER UNSIGNED NULL,
          tipoMaximo VARCHAR(100) NULL,
          clasificacion INTEGER UNSIGNED NULL,
          opcionHospital CHAR(2) NULL,
          opcionCentro CHAR(2) NULL,
          opcionPuesto CHAR(2) NULL,
          descipcion TEXT NOT NULL,
          PRIMARY KEY(idcatalogoUPS)
        )";
mysql_query($query);

$query = "CREATE TABLE capituloCIE10 (
          idcapituloCIE10 INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
          codigoCapituloCIE10 VARCHAR(10) NULL,
          nombre TEXT NULL,
          PRIMARY KEY(idcapituloCIE10)
        )";
mysql_query($query);

$query = "CREATE TABLE grupoCIE10 (
          idgrupoCIE10 INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
          idcapituloCIE10 INTEGER UNSIGNED NOT NULL,
          codigoGrupo VARCHAR(10) NULL,
          codigoCapituloCIE10 VARCHAR(10) NOT NULL,
          nombre TEXT NULL,
          PRIMARY KEY(idgrupoCIE10)
        )";
mysql_query($query);

$query = "CREATE TABLE categoriaCIE10 (
          idcategoriaCIE10 INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
          idgrupoCIE10 INTEGER UNSIGNED NOT NULL,
          codigoGrupoCIE10 VARCHAR(10) NULL,
          codigoCategoriaCIE10 VARCHAR(10) NULL,
          nombre TEXT NULL,
          PRIMARY KEY(idcategoriaCIE10)
        )";
mysql_query($query);

$query = "CREATE TABLE catalogoCIE10 (
          idcatalogoCIE10 INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
          codigoCategoriaCIE10 VARCHAR(10) NULL,
          codigoEnfermedad VARCHAR(10) NULL,
          codigoCIE10 VARCHAR(10) NULL,
          nombreEnfermedad TEXT NULL,
          PRIMARY KEY(idcatalogoCIE10)
        )";
mysql_query($query);


$query = "CREATE TABLE catalogoCPT (
  idcatalogoCPT INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  codigoCPT VARCHAR(10) NULL,
  nombre TEXT NULL,
  estado VARCHAR(10) NULL,
  PRIMARY KEY(idcatalogoCPT)
)";

mysql_query($query);

$query = "CREATE TABLE etapaVida (
  idetapaVida INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  nombreEtapa VARCHAR(100) NULL,
  descripcion TEXT NULL,
  PRIMARY KEY(idetapaVida)
)";

mysql_query($query);


$query = "CREATE TABLE catalogoEpisodio (
          idcatalogoEpisodio INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
          idetapaVida INTEGER UNSIGNED NOT NULL,
          nombreEpisodio TEXT NULL,
          limiteInicial FLOAT NULL,
          limiteFinal FLOAT NULL,
          PRIMARY KEY(idcatalogoEpisodio)
        )";

mysql_query($query);

$query = "CREATE TABLE catalogoPerfil (
  idcatalogoPerfil INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  nombrePerfil TEXT NULL,
  PRIMARY KEY(idcatalogoPerfil)
)";

mysql_query($query);

$query = "CREATE TABLE catalogoPrestacion (
          idcatalogoPrestacion INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
          nombrePrestacion TEXT NULL,
          formulario VARCHAR(100) NULL,
          planificador CHAR(2) NULL,
          nombreTabla VARCHAR(100) NULL,
          descripcion TEXT NULL,
          PRIMARY KEY(idcatalogoPrestacion)
        )";

mysql_query($query);

$query = "CREATE TABLE catalogoPrestacionPerfil (
      idcatalogoPrestacionPerfil INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
      idetapaVida INTEGER UNSIGNED NULL,
      idcatalogoPrestacion INTEGER UNSIGNED NOT NULL,
      idcatalogoPerfil INTEGER UNSIGNED NOT NULL,
      orden INTEGER UNSIGNED NULL,
      PRIMARY KEY(idcatalogoPrestacionPerfil)
    )";

mysql_query($query);


$query = "CREATE TABLE catalogoUPS (
          idcatalogoUPS INTEGER UNSIGNED NOT NULL,
          codigoUPS VARCHAR(10) NULL,
          nombreUPS TEXT NULL,
          sexoUPS VARCHAR(20) NULL,
          edadMinima INTEGER UNSIGNED NULL,
          tipoMinimo VARCHAR(100) NULL,
          edadMaxima INTEGER UNSIGNED NULL,
          tipoMaximo VARCHAR(100) NULL,
          clasificacion INTEGER UNSIGNED NULL,
          opcionHospital CHAR(2) NULL,
          opcionCentro CHAR(2) NULL,
          opcionPuesto CHAR(2) NULL,
          descipcion TEXT NOT NULL,
          PRIMARY KEY(idcatalogoUPS)
        )";

mysql_query($query);


$query = "CREATE TABLE profesion (
          idprofesion INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
          codigoColegio VARCHAR(10) NOT NULL,
          codigoProfesion VARCHAR(10) NULL,
          nombre TEXT NULL,
          PRIMARY KEY(idprofesion)
        )";
mysql_query($query);

$query = "CREATE TABLE antecedenteGinecobstetrico (
          idantecedenteGinecobstetrico INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idpersona INTEGER UNSIGNED NULL,
          nroGestacion INTEGER UNSIGNED NULL,
          paridad VARCHAR(10) NULL,
          periodoIntergenesico FLOAT NULL,
          PRIMARY KEY(idantecedenteGinecobstetrico, claveGeneral)
        )";
mysql_query($query);



$query = "CREATE TABLE detalleGinecobstetrico (
          iddetalleGinecobstetrico INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idantecedenteGinecobstetrico INTEGER UNSIGNED NOT NULL,
          fechaCulminacion DATE NULL,
          nroAtencionPrenatal INTEGER UNSIGNED NULL,
          complicacion CHAR(2) NULL,
          fuente VARCHAR(20) NULL,
          opcionSuplemento CHAR(2) NULL,
          aborto CHAR(2) NULL,
          lugarParto VARCHAR(100) NULL,
          tipoParto VARCHAR(30) NULL,
          opHorVer VARCHAR(30) NULL,
          idcatalogoCIE10 INTEGER UNSIGNED NULL,
          nombreTipoParto VARCHAR(100) BINARY NULL,
          pesoRN FLOAT NULL,
          idprofesion INTEGER UNSIGNED NULL,
          idpersonaref INTEGER UNSIGNED NULL,
          opcionRef CHAR(2) NULL,
          PRIMARY KEY(iddetalleGinecobstetrico, claveGeneral)
        )";
mysql_query($query);

$query = "CREATE TABLE antecedenteNacimiento (
          idantecedenteNacimiento INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          iddetalleGinecobstetrico INTEGER UNSIGNED NULL,
          peso FLOAT NULL,
          tallaNacer FLOAT NULL,
          perimetroCefalico FLOAT NULL,
          perimetroToracico FLOAT NULL,
          perimetroAbdominal FLOAT NULL,
          apgar VARCHAR(10) NULL,
          edadGestacional VARCHAR(50) NULL,
          testCapurro VARCHAR(30) NULL,
          complicacion TEXT NULL,
          malformacion TEXT NULL,
          idcatalogoCIE10 INTEGER UNSIGNED NULL,
          nombreCatalogo TEXT NULL,
          PRIMARY KEY(idantecedenteNacimiento, claveGeneral)
        )";
mysql_query($query);

$query = "CREATE TABLE antecedentePatologico (
          idantecedentePatologico INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idpersona INTEGER UNSIGNED NULL,
          tipo VARCHAR(100) NULL,
          fecha DATE NULL,
          idcatalogoCIE10 INTEGER UNSIGNED NULL,
          nombreCatalogo TEXT NULL,
          fuente VARCHAR(100) NULL,
          observacion TEXT NULL,
          PRIMARY KEY(idantecedentePatologico, claveGeneral)
        )";
mysql_query($query);

$query = "CREATE TABLE antecedenteSexual (
          idantecedenteSexual INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idpersona INTEGER UNSIGNED NULL,
          menarquia INTEGER UNSIGNED NULL,
          regimenCatamenial INTEGER UNSIGNED NULL,
          opcionPAP CHAR(2) NULL,
          mesAnioPAP VARCHAR(10) NULL,
          resultadoPAP VARCHAR(30) BINARY NULL,
          detallePAP VARCHAR(30) NULL,
          opcionIVAA CHAR(2) BINARY NULL,
          mesAnioIVAA VARCHAR(10) NULL,
          resultadoIVAA VARCHAR(30) NULL,
          idcatalogoCIE10IVAA INTEGER UNSIGNED NULL,
          nombreCIE10IVAA TEXT NULL,
          opcionMamas CHAR(2) NULL,
          mesAnioMamas VARCHAR(10) BINARY NULL,
          tipoMamas VARCHAR(50) BINARY NULL,
          resultadoMamas VARCHAR(30) NULL,
          idcatalogoCIE10Mamas INTEGER UNSIGNED NULL,
          nombreCIE10Mamas TEXT NULL,
          opcionProstatico CHAR(2) NULL,
          mesAnioProstatico VARCHAR(10) NULL,
          resultadoProstatico VARCHAR(30) NULL,
          idcatalogoCIE10Prostatico INTEGER UNSIGNED NULL,
          nombreCIE10Prostatico TEXT NULL,
          opcionTactoRectal CHAR(2) NULL,
          resultadoTactoRectal VARCHAR(30) NULL,
          idcatalogoCIE10Tacto INTEGER UNSIGNED NULL,
          nombreCIE10Tacto TEXT NULL,
          edadInicioRelacion INTEGER UNSIGNED NULL,
          opcionParejaSexual CHAR(2) NULL,
          nroParejaSexual INTEGER UNSIGNED NULL,
          edadParejaSexual INTEGER UNSIGNED NULL,
          opcionActividadSexual CHAR(2) NULL,
          opcionMetodoAnticonceptivo CHAR(2) NULL,
          tiempoMetodo CHAR(5) NULL,
          metodoAnticonceptivo TEXT NULL,
          tipo VARCHAR(100) NULL,
          fechaRegistro DATETIME NULL,
          PRIMARY KEY(idantecedenteSexual, claveGeneral)
        )";
mysql_query($query);


$query = "CREATE TABLE antecedenteFisiologico (
          idantecedenteFisiologico INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idpersona INTEGER UNSIGNED NULL,
          alimentacionMes VARCHAR(30) NULL,
          alimentacion VARCHAR(30) NULL,
          higieneDental VARCHAR(30) NULL,
          revisionDental VARCHAR(30) NULL,
          fechaVisitaDental VARCHAR(10) NULL,
          opcionActividadFisica CHAR(2) NULL,
          frecuenciaActividadFisica VARCHAR(20) NULL,
          nroVecesActividadFisica INTEGER UNSIGNED NULL,
          PRIMARY KEY(idantecedenteFisiologico, claveGeneral)
        )";
mysql_query($query);

$query = "CREATE TABLE antecedenteFamiliar (
          idantecedenteFamiliar INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idpersona INTEGER UNSIGNED NULL,
          tipo VARCHAR(30) NULL,
          parentesco VARCHAR(30) NULL,
          opcionPatologia CHAR(2) NULL,
          idcatalogoCIE10 INTEGER UNSIGNED NULL,
          nombreCIE10 TEXT NULL,
          fuente VARCHAR(50) NULL,
          descripcion TEXT NULL,
          observacion TEXT NULL,
          PRIMARY KEY(idantecedenteFamiliar, claveGeneral)
        )";
mysql_query($query);

$query = "CREATE TABLE antecedenteInmunizacion (
          idantecedenteInmunizacion INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idpersona INTEGER UNSIGNED NULL,
          idcatalogoVacuna INTEGER UNSIGNED NULL,
          nombreCatalogo VARCHAR(100) NULL,
          nroDosis INTEGER UNSIGNED NULL,
          fechaAplicacion VARCHAR(10) NULL,
          lugarAplicacion VARCHAR(100) NULL,
          descripcion TEXT NULL,
          PRIMARY KEY(idantecedenteInmunizacion, claveGeneral)
        )";
mysql_query($query);

$query = "CREATE TABLE antecedenteMedicamento (
          idantecedenteMedicamento INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idpersona INTEGER UNSIGNED NULL,
          tipoMedicamento VARCHAR(100) NULL,
          medicacion VARCHAR(100) NULL,
          tiempoUso VARCHAR(10) NULL,
          PRIMARY KEY(idantecedenteMedicamento, claveGeneral)
        )";

mysql_query($query);

$query = "CREATE TABLE antecedentePsicosocial (
          idantecedentePsicosocial INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idpersona INTEGER UNSIGNED NULL,
          opcionAlcohol CHAR(2) NULL,
          cantidadAlcohol FLOAT NULL,
          frecuenciaAlcohol VARCHAR(10) NULL,
          nroVecesAlcohol INTEGER UNSIGNED NULL,
          opcionTabaco CHAR(2) NULL,
          nroCigarros INTEGER UNSIGNED NULL,
          nroCajetillas INTEGER UNSIGNED NULL,
          frecuenciaTabaco VARCHAR(10) NULL,
          nroVecesTabaco INTEGER UNSIGNED NULL,
          opcionDroga CHAR(2) NULL,
          frecuenciaDroga VARCHAR(10) NULL,
          nroVecesDroga INTEGER UNSIGNED NULL,
          opcionHojaCoca CHAR(2) NULL,
          frecuenciaHojaCoca VARCHAR(10) NULL,
          nroVecesHojaCoca INTEGER UNSIGNED NULL,
          opcionPornografia CHAR(2) NULL,
          horasPornografia INTEGER UNSIGNED NULL,
          opcionPandilla CHAR(2) NULL,
          opcionVideoJuego CHAR(2) NULL,
          horaVideoJuego INTEGER UNSIGNED NULL,
          opcionDelincuencia CHAR(2) NULL,
          opcionViolenciaFisica CHAR(2) NULL,
          opcionViolenciaPsicologica CHAR(2) NULL,
          opcionViolenciaSexual CHAR(2) NULL,
          opcionBullyng CHAR(2) NULL,
          opcionTrabaja CHAR(2) NULL,
          edadInicioTrabajo INTEGER UNSIGNED NULL,
          tipoTrabajo VARCHAR(20) NULL,
          riesgoOcupacional VARCHAR(20) NULL,
          opcionAnorexia CHAR(2) NULL,
          opcionSuicidio CHAR(2) NULL,
          opcionDesercion CHAR(2) NULL,
          opcionRepitencia CHAR(2) NULL,
          opcionViolenciaNegligencia CHAR(2) NULL,
          opcionViolenciaPolitica CHAR(2) NULL,
          PRIMARY KEY(idantecedentePsicosocial, claveGeneral)
        )";
mysql_query($query);

$query = "CREATE TABLE episodio (
  idepisodio INTEGER UNSIGNED NOT NULL,
  claveGeneral VARCHAR(100) NOT NULL,
  idpersona INTEGER UNSIGNED NULL,
  claseAtencion VARCHAR(100) NULL,
  tipo VARCHAR(100) NULL,
  idcatalogoUPS INTEGER UNSIGNED NULL,
  nombreCatalogo TEXT NULL,
  situacion VARCHAR(100) NULL,
  fechaInicio DATE NULL,
  fechaFin DATE NULL,
  hora TIME NULL,
  nombreEpisodio VARCHAR(100) NULL,
  estadoEpisodio VARCHAR(100) NULL,
  medioAcceso VARCHAR(100) NULL,
  procedencia VARCHAR(100) NULL,
  acompanante VARCHAR(100) NULL,
  parentesco VARCHAR(100) NULL,
  motivoConsulta TEXT NULL,
  sintomas TEXT NULL,
  sindromeCultura TEXT NULL,
  tiempoEnfermedad INTEGER UNSIGNED NULL,
  detalleTiempo VARCHAR(10) NULL,
  semanaEpidemiologica INTEGER UNSIGNED NULL,
  opcionSemanaGestacional VARCHAR(10) NULL,
  semanaGestacional INTEGER UNSIGNED NULL,
  sueno VARCHAR(50) NULL,
  sed VARCHAR(50) NULL,
  animo VARCHAR(50) NULL,
  apetito VARCHAR(50) NULL,
  orina VARCHAR(50) NULL,
  deposiciones VARCHAR(50) NULL,
  frecuenciaDeposiciones INTEGER UNSIGNED NULL,
  horaDiaDeposiciones VARCHAR(10) NULL,
  perdidaPeso CHAR(2) NULL,
  detallePesoKilos INTEGER UNSIGNED NULL,
  opcionPesoTiempo VARCHAR(10) NULL,
  detallePesoTiempo INTEGER UNSIGNED NULL,
  tos CHAR(2) NULL,
  PRIMARY KEY(idepisodio, claveGeneral)
)";
mysql_query($query);

$query = "CREATE TABLE variableAntropometrica (
          idvariableAntropometrica INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idepisodio INTEGER UNSIGNED NULL,
          peso FLOAT NULL,
          talla FLOAT NULL,
          IMC FLOAT NULL,
          perimetroCefalico FLOAT NULL,
          perimetroToracico FLOAT NULL,
          frecuenciaCardiaca FLOAT NULL,
          frecuenciaRespiratoria FLOAT NULL,
          temperatura FLOAT NULL,
          presionArterialNum FLOAT NULL,
          presionArterialDenom FLOAT NULL,
          presionArterialMediaNum INTEGER UNSIGNED NULL,
          presionArterialMediaDenom INTEGER UNSIGNED NULL,
          perimetroAbdominal FLOAT NULL,
          pesoPregestacional FLOAT NULL,
          FUR DATE NULL,
          FPP DATE NULL,
          presionArterialBasalNum INTEGER UNSIGNED NULL,
          presionArterialBasalDenom INTEGER UNSIGNED NULL,
          factorRiesgo FLOAT NULL,
          PRIMARY KEY(idvariableAntropometrica, claveGeneral)
        )";
mysql_query($query);

$query = "CREATE TABLE diagnostico (
          claveGeneral VARCHAR(100) NOT NULL,
          iddiagnostico INTEGER UNSIGNED NOT NULL,
          idepisodio INTEGER UNSIGNED NULL,
          idcatalogoCIE10 INTEGER UNSIGNED NULL,
          nombreCatalogo TEXT NULL,
          variableLab VARCHAR(100) NULL,
          observacion TEXT NULL,
          opcionPacienteEst VARCHAR(100) NULL,
          opcionPacienteServ VARCHAR(100) NULL,
          tipo VARCHAR(100) NULL,
          opReferencia CHAR(2) NULL,
          PRIMARY KEY(claveGeneral, iddiagnostico)
        )";
mysql_query($query);


$query = "CREATE TABLE tratamientoResolutivo (
          idtratamientoResolutivo INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idepisodio INTEGER UNSIGNED NULL,
          idcatalogoMedicamento INTEGER UNSIGNED NULL,
          nombreCatalogo TEXT NULL,
          medicamento VARCHAR(100) NULL,
          dosis VARCHAR(20) NULL,
          via VARCHAR(20) NULL,
          frecuencia VARCHAR(20) NULL,
          nroDias VARCHAR(20) NULL,
          PRIMARY KEY(idtratamientoResolutivo, claveGeneral)
        )";
mysql_query($query);

$query = "CREATE TABLE plantaMedicinal (
          idplantaMedicinal INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idepisodio INTEGER UNSIGNED NULL,
          planta TEXT NULL,
          PRIMARY KEY(idplantaMedicinal, claveGeneral)
        )";
mysql_query($query);

$query = "CREATE TABLE tratamientoPreventivo (
          idtratamientoPreventivo INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idepisodio INTEGER UNSIGNED NULL,
          tratamiento VARCHAR(100) NULL,
          nombre VARCHAR(100) NULL,
          dosis VARCHAR(20) NULL,
          via VARCHAR(20) NULL,
          frecuencia VARCHAR(20) NULL,
          nroDias VARCHAR(20) NULL,
          PRIMARY KEY(idtratamientoPreventivo, claveGeneral)
        )";
mysql_query($query);


$query = "CREATE TABLE procedimiento (
          idprocedimiento INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idepisodio INTEGER UNSIGNED NULL,
          idcatalogoCPT INTEGER UNSIGNED NULL,
          nombreCatalogo TEXT NULL,
          nombre VARCHAR(100) NULL,
          frecuencia VARCHAR(20) NULL,
          observacion TEXT NULL,
          PRIMARY KEY(idprocedimiento, claveGeneral)
        )";
mysql_query($query);

$query = "CREATE TABLE insumos (
          idinsumos INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idepisodio INTEGER UNSIGNED NULL,
          idcatalogoInsumo INTEGER UNSIGNED NULL,
          nombreCatalogo TEXT NULL,
          cantidad INTEGER UNSIGNED NULL,
          PRIMARY KEY(idinsumos, claveGeneral)
        )";
mysql_query($query);

$query = "CREATE TABLE consejeria (
          idconsejeria INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idepisodio INTEGER UNSIGNED NULL,
          consejeria VARCHAR(100) NULL,
          nroSesion INTEGER UNSIGNED NULL,
          tema TEXT NULL,
          PRIMARY KEY(idconsejeria, claveGeneral)
        )";
mysql_query($query);

$query = "CREATE TABLE interconsulta (
          idinterconsulta INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idepisodio INTEGER UNSIGNED NULL,
          idcatalogoUPS INTEGER UNSIGNED NULL,
          nombreCatalogo TEXT NULL,
          motivoInterconsulta TEXT NULL,
          PRIMARY KEY(idinterconsulta, claveGeneral)
        )";
mysql_query($query);

$query = "CREATE TABLE prestacionAiepi (
          idprestacionAiepi INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idcatalogoPrestacion INTEGER UNSIGNED NULL,
          idpersona INTEGER UNSIGNED NULL,
          idepisodio INTEGER UNSIGNED NULL,
          idcatalogoUPS INTEGER UNSIGNED NULL,
          nombreCatalogo TEXT NULL,
          fechaInicio DATE NULL,
          fechaFin DATE NULL,
          estado VARCHAR(30) NULL,
          infeccionBacteriana CHAR(2) NULL,
          respiracionesPorMinuto INTEGER UNSIGNED NULL,
          respiracionRapida CHAR(2) NULL,
          tirajeSubcostal CHAR(2) NULL,
          aleteoNasal CHAR(2) NULL,
          quejido CHAR(2) NULL,
          estadoFontanela TEXT NULL,
          supuracionOido CHAR(2) NULL,
          estadoOmbligo VARCHAR(20) BINARY NULL,
          temperatura CHAR(2) NULL,
          pielPustulas CHAR(2) NULL,
          letargio CHAR(2) NULL,
          movimientoAnormal CHAR(2) NULL,
          secrecionOjos CHAR(2) NULL,
          diarrea CHAR(2) NULL,
          tiempoDiarrea INTEGER UNSIGNED NULL,
          sangreHeces CHAR(2) NULL,
          estadoGeneral VARCHAR(30) NULL,
          ojosHundidos CHAR(2) NULL,
          signoCutaneo VARCHAR(30) NULL,
          PRIMARY KEY(idprestacionAiepi, claveGeneral)
        )";
mysql_query($query);

$query = "CREATE TABLE prestacionEvaluacionNino (
          idprestacionEvaluacionNino INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idcatalogoPrestacion INTEGER UNSIGNED NULL,
          idpersona INTEGER UNSIGNED NULL,
          idepisodio INTEGER UNSIGNED NULL,
          idcatalogoUPS INTEGER UNSIGNED NULL,
          nombreCatalogo TEXT NULL,
          fechaInicio DATE NULL,
          fechaFin DATE NULL,
          estado VARCHAR(30) NULL,
          signosPeligro CHAR(2) NULL,
          remedioRecibidos TEXT NULL,
          opTos CHAR(2) NULL,
          diasTiempoTos INTEGER UNSIGNED NULL,
          supuracionOido CHAR(2) NULL,
          diasSupuracion INTEGER UNSIGNED NULL,
          tumefaccionOreja CHAR(2) NULL,
          dolorGarganta CHAR(2) NULL,
          exudado CHAR(2) NULL,
          gangliosDolorosos CHAR(2) NULL,
          diarrea CHAR(2) NULL,
          tiempoDiarrea INTEGER UNSIGNED NULL,
          estadoGeneral TEXT NULL,
          sangreHeces VARCHAR(50) NULL,
          ojosHundidos VARCHAR(100) NULL,
          signosPliegue VARCHAR(100) NULL,
          fiebre CHAR(2) NULL,
          riesgoMalaria CHAR(2) NULL,
          observaciones TEXT NULL,
          PRIMARY KEY(idprestacionEvaluacionNino, claveGeneral)
        )";
mysql_query($query);

$query = "CREATE TABLE prestacionAlimentacionRN (
          idprestacionAlimentacionRN INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idcatalogoPrestacion INTEGER UNSIGNED NULL,
          idepisodio INTEGER UNSIGNED NULL,
          idpersona INTEGER UNSIGNED NULL,
          idcatalogoUPS INTEGER UNSIGNED NULL,
          nombreCatalogo VARCHAR(100) NULL,
          fechaInicio DATE NULL,
          fechaFin DATE NULL,
          estado VARCHAR(30) NULL,
          tomaPecho CHAR(2) NULL,
          nroVecesPecho INTEGER UNSIGNED NULL,
          opcomidas CHAR(2) NULL,
          cualesComidas TEXT NULL,
          cambioDuranteEnfermedad CHAR(2) NULL,
          cualesEnfermedades TEXT NULL,
          ulcerasBocaBajoPeso CHAR(2) NULL,
          alimentacionUltimaHora CHAR(2) NULL,
          opAmarre CHAR(2) NULL,
          mamaCorrecto VARCHAR(50) NULL,
          ulcerasBoca CHAR(2) NULL,
          buenaPosicion CHAR(2) NULL,
          observaciones TEXT NULL,
          PRIMARY KEY(idprestacionAlimentacionRN, claveGeneral)
        )";

mysql_query($query);

$query = "CREATE TABLE prestacionEvaluacionLME (
          idprestacionEvaluacionLME INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idcatalogoPrestacion INTEGER UNSIGNED NULL,
          idepisodio INTEGER UNSIGNED NULL,
          idpersona INTEGER UNSIGNED NULL,
          idcatalogoUPS INTEGER UNSIGNED NULL,
          nombreCatalogo VARCHAR(200) NULL,
          fechaInicio DATE NULL,
          fechaFin DATE NULL,
          estado VARCHAR(30) NULL,
          lactanciaLM CHAR(2) NULL,
          tecnicaLM CHAR(2) NULL,
          frecuenciaLM CHAR(2) NULL,
          lecheNoMaterna CHAR(2) NULL,
          recibeAguitas CHAR(2) NULL,
          otroAlimento CHAR(2) NULL,
          consistenciaAdecuada CHAR(2) NULL,
          cantidadAdecuada CHAR(2) NULL,
          frecuenciaAdecuada CHAR(2) NULL,
          consumoAlimentosAnimal CHAR(2) NULL,
          consumoFrutasVerduras CHAR(2) NULL,
          consumoMantequilla CHAR(2) NULL,
          alimentosEnPlato CHAR(2) NULL,
          usaSalYodada CHAR(2) NULL,
          tomaSuplementoHierro CHAR(2) NULL,
          tomaSuplementoVitamina CHAR(2) NULL,
          recibeMicronutrientes CHAR(2) NULL,
          opcionBeneficiarioPrograma CHAR(2) NOT NULL,
          descripcionPrograma TEXT NULL,
          PRIMARY KEY(idprestacionEvaluacionLME, claveGeneral)
        )";
mysql_query($query);

$query = "CREATE TABLE prestacionExamenIntegral (
          idprestacionExamenIntegral INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idcatalogoPrestacion INTEGER UNSIGNED NULL,
          idepisodio INTEGER UNSIGNED NULL,
          idpersona INTEGER UNSIGNED NULL,
          idcatalogoUPS INTEGER UNSIGNED NULL,
          nombreCatalogo TEXT NULL,
          fechaInicio DATE NULL,
          fechaFin DATE NULL,
          estado VARCHAR(30) NULL,
          opcionPiel VARCHAR(30) NULL,
          descripcionPiel TEXT NULL,
          opcionCabeza VARCHAR(30) NULL,
          descripcionCabeza TEXT NULL,
          opcionCabello VARCHAR(30) NULL,
          descripcionCabello TEXT NULL,
          opcionOjos VARCHAR(30) NULL,
          descripcionOjoD TEXT NULL,
          descripcionOjoI TEXT NULL,
          opcionOidos VARCHAR(30) NULL,
          descripcionOidoD TEXT NULL,
          descripcionOidoI TEXT NULL,
          opcionNariz VARCHAR(30) NULL,
          descripcionNariz TEXT NULL,
          opcionBoca VARCHAR(30) NULL,
          descripcionBoca TEXT NULL,
          opcionOrofaringe VARCHAR(30) NULL,
          descripcionOrofaringe TEXT NULL,
          opcionCuello VARCHAR(30) NULL,
          descripcionCuello TEXT NULL,
          opcionRespiratorio VARCHAR(30) NULL,
          descripcionRespiratorio TEXT NULL,
          opcionCardiovascular VARCHAR(30) NULL,
          descripcionCardiovascular TEXT NULL,
          opcionDigestivo VARCHAR(30) NULL,
          descripcionDigestivo TEXT NULL,
          opcionGenitourinario VARCHAR(30) NULL,
          descripcionGenitourinario TEXT NULL,
          opcionLocomotor VARCHAR(30) NULL,
          descripcionLocomotor TEXT NULL,
          opcionMarcha VARCHAR(30) NULL,
          descripcionMarcha TEXT NULL,
          opcionColumna VARCHAR(30) NULL,
          descripcionColumna TEXT NULL,
          opcionSuperior VARCHAR(30) NULL,
          descripcionSuperior TEXT NULL,
          opcionInferior VARCHAR(30) NULL,
          descripcionInferior TEXT NULL,
          opcionLinfatico VARCHAR(30) NULL,
          descripcionLinfatico TEXT NULL,
          PRIMARY KEY(idprestacionExamenIntegral, claveGeneral)
        )";
mysql_query($query);

$query = "CREATE TABLE evaluacionDesarrollo (
          idevaluacionDesarrollo INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
          claveGeneral VARCHAR(100) NOT NULL,
          idcatalogoPrestacion INTEGER UNSIGNED NULL,
          idepisodio INTEGER UNSIGNED NULL,
          idpersona INTEGER UNSIGNED NULL,
          idcatalogoUPS INTEGER UNSIGNED NULL,
          nombreCatalogo TEXT NULL,
          fechaInicio DATE NULL,
          fechaFin DATE NULL,
          estado VARCHAR(30) NULL,
          resultado VARCHAR(100) NULL,
          observaciones TEXT NULL,
          PRIMARY KEY(idevaluacionDesarrollo, claveGeneral)
        )";
mysql_query($query);

$query = "CREATE TABLE catalogoConsejeria (
          idcatalogoConsejeria INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
          nombreConsejeria TEXT NULL,
          codigoCPT VARCHAR(100) NULL,
          PRIMARY KEY(idcatalogoConsejeria)
        )";
mysql_query($query);

$query = "CREATE TABLE prestacionConsejeria (
          idprestacionConsejeria INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idcatalogoPrestacion INTEGER UNSIGNED NULL,
          idepisodio INTEGER UNSIGNED NULL,
          idpersona INTEGER UNSIGNED NULL,
          idcatalogoUPS INTEGER UNSIGNED NULL,
          nombreCatalogo TEXT NULL,
          fechaInicio DATE NULL,
          fechaFin DATE NULL,
          estado VARCHAR(50) NULL,
          PRIMARY KEY(idprestacionConsejeria, claveGeneral)
        )";

mysql_query($query);

$query = "CREATE TABLE detalleConsejeria (
          iddetalleConsejeria INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idprestacionConsejeria INTEGER UNSIGNED NOT NULL,
          idcatalogoConsejeria INTEGER UNSIGNED NULL,
          nombreCatalogo TEXT NULL,
          nroSesion INTEGER UNSIGNED NULL,
          tema TEXT NULL,
          PRIMARY KEY(iddetalleConsejeria, claveGeneral)
        )";
mysql_query($query);


$query = "CREATE TABLE administracionMicronutrientesNino (
          idadministracionMicronutrientesNino INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idcatalogoPrestacion INTEGER UNSIGNED NULL,
          idepisodio INTEGER UNSIGNED NULL,
          idpersona INTEGER UNSIGNED NULL,
          idcatalogoUPS INTEGER UNSIGNED NULL,
          nombreCatalogo TEXT NULL,
          fechaInicio DATE NULL,
          fechaFin DATE NULL,
          estado TEXT NULL,
          hierro CHAR(2) NULL,
          esquemaHierro TEXT NULL,
          vitamina CHAR(2) NULL,
          esquemaVitamina TEXT NULL,
          multimicronutrientes CHAR(2) NULL,
          esquemaMultimicronutrientes TEXT NULL,
          fechaMicronutriente DATE NULL,
          estadoMicronutriente VARCHAR(30) NULL,
          segimientoDomicilio1 DATE NULL,
          estadoSeguimiento1 VARCHAR(30) NULL,
          segimientoDomicilio2 DATE NULL,
          estadoSeguimiento2 VARCHAR(30) NULL,
          segimientoDomicilio3 DATE NULL,
          estadoSeguimiento3 VARCHAR(30) NULL,
          PRIMARY KEY(idadministracionMicronutrientesNino, claveGeneral)
        )";
mysql_query($query);

$query = "CREATE TABLE vacuna (
          idvacuna INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idpersona INTEGER UNSIGNED NULL,
          idcatalogoVacuna INTEGER UNSIGNED NULL,
          nombreCatalogo TEXT NULL,
          estadoVacuna VARCHAR(100) NULL,
          PRIMARY KEY(idvacuna, claveGeneral)
        )";
mysql_query($query);

$query = "CREATE TABLE programacionVacuna (
          idprogramacionVacuna INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
          idcatalogoVacuna INTEGER UNSIGNED NULL,
          nombreDosis INTEGER UNSIGNED NULL,
          opProgramacion CHAR(2) NULL,
          limiteInicial VARCHAR(100) NULL,
          factor INTEGER UNSIGNED NULL,
          detalleProgramacion TEXT NULL,
          PRIMARY KEY(idprogramacionVacuna)
        )";
mysql_query($query);

$query = "CREATE TABLE detalleVacuna (
          iddetalleVacuna INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idvacuna INTEGER UNSIGNED NOT NULL,
          nroDosis INTEGER UNSIGNED NULL,
          opProgramacion VARCHAR(20) NULL,
          tipoProgramacion VARCHAR(100) NULL,
          fechaProgramada DATE NULL,
          fechaAplicacion DATE NULL,
          estadoDosis VARCHAR(100) NULL,
          lugarAplicacion VARCHAR(30) NULL,
          observaciones TEXT NULL,
          PRIMARY KEY(iddetalleVacuna, claveGeneral)
        )";
mysql_query($query);

$query = "CREATE TABLE HIS (
          idHIS INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idepisodio INTEGER UNSIGNED NOT NULL,
          tipoCatalogo VARCHAR(100) NULL,
          idcatalogo INTEGER UNSIGNED NULL,
          nombreCatalogo TEXT NULL,
          variableLAB VARCHAR(100) NULL,
          tipoDiagnostico VARCHAR(100) NULL,
          opPacienteEst VARCHAR(100) NULL,
          opPacienteServ VARCHAR(100) NULL,
          PRIMARY KEY(idHIS, claveGeneral)
        )";
mysql_query($query);

$query = "CREATE TABLE HIS (
          idHIS INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idepisodio INTEGER UNSIGNED NOT NULL,
          tipoCatalogo VARCHAR(100) NULL,
          idcatalogo INTEGER UNSIGNED NULL,
          nombreCatalogo TEXT NULL,
          variableLAB VARCHAR(100) NULL,
          tipoDiagnostico VARCHAR(100) NULL,
          opPacienteEst VARCHAR(100) NULL,
          opPacienteServ VARCHAR(100) NULL,
          PRIMARY KEY(idHIS, claveGeneral)
        )";
mysql_query($query);

$query = "CREATE TABLE equivalenciasCodigo (
          idequivalenciasCodigo INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
          idepisodio INTEGER UNSIGNED NULL,
          idcatalogoPrestacion INTEGER UNSIGNED NOT NULL,
          codigoCPT VARCHAR(100) NULL,
          ophierro CHAR(2) NULL,
          opmultimicronutriente CHAR(2) NULL,
          opvitamina CHAR(2) NULL,
          variableLAB VARCHAR(100) NULL,
          tipoDiag VARCHAR(100) NULL,
          codigoSIS INTEGER UNSIGNED NULL,
          codigoCIE10 VARCHAR(100) NULL,
          PRIMARY KEY(idequivalenciasCodigo)
        )";
mysql_query($query);

$query = "CREATE TABLE PAIS (
          idPAIS INTEGER UNSIGNED NOT NULL ,
          claveGeneral VARCHAR(100) NOT NULL,
          idpersona INTEGER UNSIGNED NOT NULL,
          idetapaVida INTEGER UNSIGNED NOT NULL,
          estadoPlan VARCHAR(100) NULL,
          anio INTEGER UNSIGNED NULL,
          PRIMARY KEY(idPAIS, claveGeneral)
        )";
mysql_query($query);

$query = "CREATE TABLE detallePAIS (
          iddetallePAIS INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idcatalogoEpisodioPrestacion INTEGER UNSIGNED NOT NULL,
          idPAIS INTEGER UNSIGNED NOT NULL,
          tipoProgramacion VARCHAR(100) NULL,
          fechaPlanificada DATE NULL,
          PRIMARY KEY(iddetallePAIS, claveGeneral)
        )";
mysql_query($query);

$query = "CREATE TABLE catalogoMedicamento (
  idcatalogoMedicamento INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  codigoMedicamento VARCHAR(100) NULL,
  nombreMedicamento TEXT NULL,
  concentracion VARCHAR(50) NULL,
  formulaF TEXT NULL,
  titular TEXT NULL,
  fechaAutorizacion DATE NULL,
  fechaVencimiento DATE NULL,
  fabricante TEXT NULL,
  pais TEXT NULL,
  condicionVenta TEXT NULL,
  grupoProd TEXT NULL,
  situacion VARCHAR(100) NULL,
  codigoATC VARCHAR(100) NULL,
  descripcionATC TEXT NULL,
  sustancia TEXT NULL,
  PRIMARY KEY(idcatalogoMedicamento)
)";
mysql_query($query);

$query = "CREATE TABLE catalogoInsumo (
          idcatalogoInsumo INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
          codigoInsumo VARCHAR(100) NULL,
          descripcion TEXT NULL,
          stock INTEGER UNSIGNED NULL,
          PRIMARY KEY(idcatalogoInsumo)
        )";
mysql_query($query);

$query = "CREATE TABLE referencia (
          idreferencia INTEGER UNSIGNED NOT NULL,
          claveGeneral VARCHAR(100) NOT NULL,
          idepisodio INTEGER UNSIGNED NULL,
          idcatalogoReferencia INTEGER UNSIGNED NULL,
          nombreReferencia VARCHAR(100) NULL,
          idcatalogoUPS INTEGER UNSIGNED NULL,
          nombreCatalogo TEXT NULL,
          fechaIngreso DATE NULL,
          idtrabajadorReferencia INTEGER UNSIGNED NULL,
          idtrabajadorResponsable INTEGER UNSIGNED NULL,
          idtrabajadorCompania INTEGER UNSIGNED NULL,
          condicionRecepcion VARCHAR(100) NULL,
          fechaRecepcion DATE NULL,
          responsableRecepcion VARCHAR(100) NULL,
          colegiaturaRecepcion VARCHAR(100) NULL,
          idprofesionRecepcion INTEGER UNSIGNED NULL,
          condicionPaciente VARCHAR(30) NULL,
          estadoReferencia VARCHAR(100) NOT NULL,
          fechaReingreso DATE NULL,
          iddiagnostico1 INTEGER UNSIGNED NULL,
          diagnostico1 VARCHAR(100) NULL,
          iddiagnostico2 INTEGER UNSIGNED NULL,
          diagnostico2 VARCHAR(100) NULL,
          iddiagnostico3 INTEGER UNSIGNED NULL,
          diagnostico3 VARCHAR(100) NULL,
          PRIMARY KEY(idreferencia, claveGeneral)
        )";
mysql_query($query);

$query = "ALTER TABLE region ADD codigoRegion CHAR(2) NOT NULL AFTER nombreRegion";
mysql_query($query);

$query = "ALTER TABLE provincia ADD codigoProvincia CHAR(5) NOT NULL AFTER nompro, ADD codigoRegion CHAR(2) NOT NULL AFTER codigoProvincia, ADD capital VARCHAR(255) NOT NULL AFTER codigoRegion";
mysql_query($query);

$query = "ALTER TABLE distrito ADD codigoDistrito CHAR(8) NOT NULL AFTER nombre";
mysql_query($query);

$query = "ALTER TABLE diresa ADD codigoDiresa CHAR(2) NOT NULL AFTER nombreDiresa";
mysql_query($query);

$query = "ALTER TABLE red ADD codigoDiresa CHAR(3) NOT NULL AFTER nombreRed, ADD codigoRed CHAR(3) NOT NULL AFTER codigoDiresa";
mysql_query($query);

$query = "ALTER TABLE microred ADD codigoMicrored CHAR(3) NOT NULL AFTER nombreMicrored, ADD codigoDiresa CHAR(3) NOT NULL AFTER codigoMicrored, ADD codigoRed CHAR(3) NOT NULL AFTER codigoDiresa";
mysql_query($query);

$query = "ALTER TABLE nucleo ADD codigoNucleo CHAR(3) NOT NULL AFTER nombreNucleo, ADD codigoDiresa CHAR(3) NOT NULL AFTER codigoNucleo, ADD codigoRed CHAR(3) NOT NULL AFTER codigoDiresa, ADD codigoMicrored CHAR(3) NOT NULL AFTER codigoRed";
mysql_query($query);

$query = "ALTER TABLE establecimiento ADD tipoNucleo INT NOT NULL AFTER nivel, ADD codigoRegion CHAR(2) NOT NULL AFTER tipoNucleo, ADD codigoProvincia CHAR(5) NOT NULL AFTER codigoRegion, ADD codigoDistrito CHAR(8) NOT NULL AFTER codigoProvincia, ADD codigoDiresa CHAR(3) NOT NULL AFTER codigoDistrito, ADD codigoRed CHAR(3) NOT NULL AFTER codigoDiresa, ADD codigoMicrored CHAR(3) NOT NULL AFTER codigoRed, ADD codigoNucleo CHAR(3) NOT NULL AFTER codigoMicrored";
mysql_query($query);

$query = "ALTER TABLE profesion ADD primer_nivel INT NOT NULL AFTER nombre, ADD segundo_nivel INT NOT NULL AFTER primer_nivel, ADD tercer_nivel INT NOT NULL AFTER segundo_nivel";
mysql_query($query);

$query = "ALTER TABLE persona CHANGE opcionDNI opcionDNI VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL";
mysql_query($query);

$query = "ALTER TABLE personaH CHANGE opcionDNI opcionDNI VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL";
mysql_query($query);

$query = "ALTER TABLE persona ADD estudia VARCHAR(10) NOT NULL AFTER parentescoContacto";
mysql_query($query);

$query = "ALTER TABLE personaH ADD estudia VARCHAR(10) NOT NULL AFTER parentescoContacto";
mysql_query($query);

$query = "UPDATE usuario SET clave = '57f21ea16a747c4fd9af13f5b25229ea' WHERE usuario.usuario = 'SUPERUSUARIO' ";
mysql_query($query);

$query = "UPDATE ciclo SET nombreCiclo = 'FAMILIA EXPANSION: PAREJA CON HIJO EN EDAD PRE ESCOLAR' WHERE ciclo.nombreCiclo = 'FAMILIA EXPANSION: PAREJA CON HIJO EN EDAD PRE-ESCOLAR'";
mysql_query($query);

$query = "UPDATE cicloh SET nombreCiclo = 'FAMILIA EXPANSION: PAREJA CON HIJO EN EDAD PRE ESCOLAR' WHERE cicloh.nombreCiclo = 'FAMILIA EXPANSION: PAREJA CON HIJO EN EDAD PRE-ESCOLAR'";
mysql_query($query);


/*
$query = "SHOW COLUMNS FROM provincia LIKE 'claveGeneral'";
if(mysql_num_rows(mysql_query($query)) == 0){
    $query = "ALTER TABLE provincia DROP claveGeneral";
    mysql_query($query);

    $query = "TRUNCATE provincia";
    mysql_query($query);
}

$query = "SHOW COLUMNS FROM distrito LIKE 'claveGeneral'";
if(mysql_num_rows(mysql_query($query)) == 0){
    $query = "ALTER TABLE distrito DROP claveGeneral";
    mysql_query($query);

    $query = "TRUNCATE distrito";
    mysql_query($query);

}
*/

?>