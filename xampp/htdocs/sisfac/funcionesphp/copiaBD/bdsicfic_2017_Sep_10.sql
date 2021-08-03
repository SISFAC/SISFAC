--  Database Dump
-- version 1.01b
-- Developed: Anish Karim C
-- Credits: http://www.phpclasses.org

-- Class Page: http://www.phpclasses.org/browse/package/5808.html

-- How To Blog: http://is.gd/5b3Xk

-- Host: localhost
-- Generation Time: Sep 10, 2017 at 10:58 
-- 
-- MySQL version: 5.5.5-10.1.9-MariaDB
-- PHP Version: 5.6.15
-- 
-- 
--  Table structure for table `administracionmicronutrientesnino`
-- 

CREATE TABLE `administracionmicronutrientesnino` (
  `idadministracionMicronutrientesNino` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idcatalogoPrestacion` int(10) unsigned DEFAULT NULL,
  `idepisodio` int(10) unsigned DEFAULT NULL,
  `idpersona` int(10) unsigned DEFAULT NULL,
  `idcatalogoUPS` int(10) unsigned DEFAULT NULL,
  `nombreCatalogo` text,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `estado` text,
  `hierro` char(2) DEFAULT NULL,
  `esquemaHierro` text,
  `vitamina` char(2) DEFAULT NULL,
  `esquemaVitamina` text,
  `multimicronutrientes` char(2) DEFAULT NULL,
  `esquemaMultimicronutrientes` text,
  `fechaMicronutriente` date DEFAULT NULL,
  `estadoMicronutriente` varchar(30) DEFAULT NULL,
  `segimientoDomicilio1` date DEFAULT NULL,
  `estadoSeguimiento1` varchar(30) DEFAULT NULL,
  `segimientoDomicilio2` date DEFAULT NULL,
  `estadoSeguimiento2` varchar(30) DEFAULT NULL,
  `segimientoDomicilio3` date DEFAULT NULL,
  `estadoSeguimiento3` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idadministracionMicronutrientesNino`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `administracionmicronutrientesnino`

-- 
--  Table structure for table `antecedentefamiliar`
-- 

CREATE TABLE `antecedentefamiliar` (
  `idantecedenteFamiliar` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idpersona` int(10) unsigned DEFAULT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `parentesco` varchar(30) DEFAULT NULL,
  `opcionPatologia` char(2) DEFAULT NULL,
  `idcatalogoCIE10` int(10) unsigned DEFAULT NULL,
  `nombreCIE10` text,
  `fuente` varchar(50) DEFAULT NULL,
  `descripcion` text,
  `observacion` text,
  PRIMARY KEY (`idantecedenteFamiliar`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `antecedentefamiliar`

-- 
--  Table structure for table `antecedentefisiologico`
-- 

CREATE TABLE `antecedentefisiologico` (
  `idantecedenteFisiologico` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idpersona` int(10) unsigned DEFAULT NULL,
  `alimentacionMes` varchar(30) DEFAULT NULL,
  `alimentacion` varchar(30) DEFAULT NULL,
  `higieneDental` varchar(30) DEFAULT NULL,
  `revisionDental` varchar(30) DEFAULT NULL,
  `fechaVisitaDental` varchar(10) DEFAULT NULL,
  `opcionActividadFisica` char(2) DEFAULT NULL,
  `frecuenciaActividadFisica` varchar(20) DEFAULT NULL,
  `nroVecesActividadFisica` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idantecedenteFisiologico`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `antecedentefisiologico`

-- 
--  Table structure for table `antecedenteginecobstetrico`
-- 

CREATE TABLE `antecedenteginecobstetrico` (
  `idantecedenteGinecobstetrico` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idpersona` int(10) unsigned DEFAULT NULL,
  `nroGestacion` int(10) unsigned DEFAULT NULL,
  `paridad` varchar(10) DEFAULT NULL,
  `periodoIntergenesico` float DEFAULT NULL,
  PRIMARY KEY (`idantecedenteGinecobstetrico`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `antecedenteginecobstetrico`

-- 
--  Table structure for table `antecedenteinmunizacion`
-- 

CREATE TABLE `antecedenteinmunizacion` (
  `idantecedenteInmunizacion` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idpersona` int(10) unsigned DEFAULT NULL,
  `idcatalogoVacuna` int(10) unsigned DEFAULT NULL,
  `nombreCatalogo` varchar(100) DEFAULT NULL,
  `nroDosis` int(10) unsigned DEFAULT NULL,
  `fechaAplicacion` varchar(10) DEFAULT NULL,
  `lugarAplicacion` varchar(100) DEFAULT NULL,
  `descripcion` text,
  PRIMARY KEY (`idantecedenteInmunizacion`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `antecedenteinmunizacion`

-- 
--  Table structure for table `antecedentemedicamento`
-- 

CREATE TABLE `antecedentemedicamento` (
  `idantecedenteMedicamento` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idpersona` int(10) unsigned DEFAULT NULL,
  `tipoMedicamento` varchar(100) DEFAULT NULL,
  `medicacion` varchar(100) DEFAULT NULL,
  `tiempoUso` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idantecedenteMedicamento`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `antecedentemedicamento`

-- 
--  Table structure for table `antecedentenacimiento`
-- 

CREATE TABLE `antecedentenacimiento` (
  `idantecedenteNacimiento` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `iddetalleGinecobstetrico` int(10) unsigned DEFAULT NULL,
  `peso` float DEFAULT NULL,
  `tallaNacer` float DEFAULT NULL,
  `perimetroCefalico` float DEFAULT NULL,
  `perimetroToracico` float DEFAULT NULL,
  `perimetroAbdominal` float DEFAULT NULL,
  `apgar` varchar(10) DEFAULT NULL,
  `edadGestacional` varchar(50) DEFAULT NULL,
  `testCapurro` varchar(30) DEFAULT NULL,
  `complicacion` text,
  `malformacion` text,
  `idcatalogoCIE10` int(10) unsigned DEFAULT NULL,
  `nombreCatalogo` text,
  PRIMARY KEY (`idantecedenteNacimiento`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `antecedentenacimiento`

-- 
--  Table structure for table `antecedentepatologico`
-- 

CREATE TABLE `antecedentepatologico` (
  `idantecedentePatologico` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idpersona` int(10) unsigned DEFAULT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `idcatalogoCIE10` int(10) unsigned DEFAULT NULL,
  `nombreCatalogo` text,
  `fuente` varchar(100) DEFAULT NULL,
  `observacion` text,
  PRIMARY KEY (`idantecedentePatologico`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `antecedentepatologico`

-- 
--  Table structure for table `antecedentepsicosocial`
-- 

CREATE TABLE `antecedentepsicosocial` (
  `idantecedentePsicosocial` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idpersona` int(10) unsigned DEFAULT NULL,
  `opcionAlcohol` char(2) DEFAULT NULL,
  `cantidadAlcohol` float DEFAULT NULL,
  `frecuenciaAlcohol` varchar(10) DEFAULT NULL,
  `nroVecesAlcohol` int(10) unsigned DEFAULT NULL,
  `opcionTabaco` char(2) DEFAULT NULL,
  `nroCigarros` int(10) unsigned DEFAULT NULL,
  `nroCajetillas` int(10) unsigned DEFAULT NULL,
  `frecuenciaTabaco` varchar(10) DEFAULT NULL,
  `nroVecesTabaco` int(10) unsigned DEFAULT NULL,
  `opcionDroga` char(2) DEFAULT NULL,
  `frecuenciaDroga` varchar(10) DEFAULT NULL,
  `nroVecesDroga` int(10) unsigned DEFAULT NULL,
  `opcionHojaCoca` char(2) DEFAULT NULL,
  `frecuenciaHojaCoca` varchar(10) DEFAULT NULL,
  `nroVecesHojaCoca` int(10) unsigned DEFAULT NULL,
  `opcionPornografia` char(2) DEFAULT NULL,
  `horasPornografia` int(10) unsigned DEFAULT NULL,
  `opcionPandilla` char(2) DEFAULT NULL,
  `opcionVideoJuego` char(2) DEFAULT NULL,
  `horaVideoJuego` int(10) unsigned DEFAULT NULL,
  `opcionDelincuencia` char(2) DEFAULT NULL,
  `opcionViolenciaFisica` char(2) DEFAULT NULL,
  `opcionViolenciaPsicologica` char(2) DEFAULT NULL,
  `opcionViolenciaSexual` char(2) DEFAULT NULL,
  `opcionBullyng` char(2) DEFAULT NULL,
  `opcionTrabaja` char(2) DEFAULT NULL,
  `edadInicioTrabajo` int(10) unsigned DEFAULT NULL,
  `tipoTrabajo` varchar(20) DEFAULT NULL,
  `riesgoOcupacional` varchar(20) DEFAULT NULL,
  `opcionAnorexia` char(2) DEFAULT NULL,
  `opcionSuicidio` char(2) DEFAULT NULL,
  `opcionDesercion` char(2) DEFAULT NULL,
  `opcionRepitencia` char(2) DEFAULT NULL,
  `opcionViolenciaNegligencia` char(2) DEFAULT NULL,
  `opcionViolenciaPolitica` char(2) DEFAULT NULL,
  PRIMARY KEY (`idantecedentePsicosocial`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `antecedentepsicosocial`

-- 
--  Table structure for table `antecedentesexual`
-- 

CREATE TABLE `antecedentesexual` (
  `idantecedenteSexual` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idpersona` int(10) unsigned DEFAULT NULL,
  `menarquia` int(10) unsigned DEFAULT NULL,
  `regimenCatamenial` int(10) unsigned DEFAULT NULL,
  `opcionPAP` char(2) DEFAULT NULL,
  `mesAnioPAP` varchar(10) DEFAULT NULL,
  `resultadoPAP` varchar(30) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `detallePAP` varchar(30) DEFAULT NULL,
  `opcionIVAA` char(2) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `mesAnioIVAA` varchar(10) DEFAULT NULL,
  `resultadoIVAA` varchar(30) DEFAULT NULL,
  `idcatalogoCIE10IVAA` int(10) unsigned DEFAULT NULL,
  `nombreCIE10IVAA` text,
  `opcionMamas` char(2) DEFAULT NULL,
  `mesAnioMamas` varchar(10) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `tipoMamas` varchar(50) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `resultadoMamas` varchar(30) DEFAULT NULL,
  `idcatalogoCIE10Mamas` int(10) unsigned DEFAULT NULL,
  `nombreCIE10Mamas` text,
  `opcionProstatico` char(2) DEFAULT NULL,
  `mesAnioProstatico` varchar(10) DEFAULT NULL,
  `resultadoProstatico` varchar(30) DEFAULT NULL,
  `idcatalogoCIE10Prostatico` int(10) unsigned DEFAULT NULL,
  `nombreCIE10Prostatico` text,
  `opcionTactoRectal` char(2) DEFAULT NULL,
  `resultadoTactoRectal` varchar(30) DEFAULT NULL,
  `idcatalogoCIE10Tacto` int(10) unsigned DEFAULT NULL,
  `nombreCIE10Tacto` text,
  `edadInicioRelacion` int(10) unsigned DEFAULT NULL,
  `opcionParejaSexual` char(2) DEFAULT NULL,
  `nroParejaSexual` int(10) unsigned DEFAULT NULL,
  `edadParejaSexual` int(10) unsigned DEFAULT NULL,
  `opcionActividadSexual` char(2) DEFAULT NULL,
  `opcionMetodoAnticonceptivo` char(2) DEFAULT NULL,
  `tiempoMetodo` char(5) DEFAULT NULL,
  `metodoAnticonceptivo` text,
  `tipo` varchar(100) DEFAULT NULL,
  `fechaRegistro` datetime DEFAULT NULL,
  PRIMARY KEY (`idantecedenteSexual`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `antecedentesexual`

-- 
--  Table structure for table `capitulocie10`
-- 

CREATE TABLE `capitulocie10` (
  `idcapituloCIE10` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigoCapituloCIE10` varchar(10) DEFAULT NULL,
  `nombre` text,
  PRIMARY KEY (`idcapituloCIE10`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `capitulocie10`

-- 
--  Table structure for table `catalogocie10`
-- 

CREATE TABLE `catalogocie10` (
  `idcatalogoCIE10` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigoCategoriaCIE10` varchar(10) DEFAULT NULL,
  `codigoEnfermedad` varchar(10) DEFAULT NULL,
  `codigoCIE10` varchar(10) DEFAULT NULL,
  `nombreEnfermedad` text,
  PRIMARY KEY (`idcatalogoCIE10`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `catalogocie10`

-- 
--  Table structure for table `catalogocolegio`
-- 

CREATE TABLE `catalogocolegio` (
  `idcatalogoColegio` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigoColegio` varchar(10) DEFAULT NULL,
  `nombre` text,
  PRIMARY KEY (`idcatalogoColegio`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;


-- Dumping data for table `catalogocolegio`

INSERT INTO catalogocolegio VALUES ('1', '00', 'PERSONAL DE SALUD SIN COLEGIATURA');
INSERT INTO catalogocolegio VALUES ('2', '01', 'COLEGIO MEDICO DE PERU');
INSERT INTO catalogocolegio VALUES ('3', '02', 'COLEGIO QUIMICO FARMACEUTICO DEL PERU');
INSERT INTO catalogocolegio VALUES ('4', '03', 'COLEGIO ODONTOLOGICO DEL PERU');
INSERT INTO catalogocolegio VALUES ('5', '04', 'COLEGIO DE BIOLOGOS DEL PERU');
INSERT INTO catalogocolegio VALUES ('6', '05', 'COLEGIO DE OBSTETRAS DEL PERU');
INSERT INTO catalogocolegio VALUES ('7', '06', 'COLEGIO DE ENFERMEROS DEL PERU');
INSERT INTO catalogocolegio VALUES ('8', '07', 'COLEGIO DE TRABAJADORES SOCIALES DEL PERU');
INSERT INTO catalogocolegio VALUES ('9', '08', 'COLEGIO DE PSICOLOGOS DEL PERU');
INSERT INTO catalogocolegio VALUES ('10', '09', 'COLEGIO TECNOLOGO MEDICO DEL PERU');
INSERT INTO catalogocolegio VALUES ('11', '10', 'COLEGIO DE NUTRICIONISTAS DEL PERU');
INSERT INTO catalogocolegio VALUES ('12', '11', 'COLEGIO MEDICO VETERINARIO DEL PERU');
-- 
--  Table structure for table `catalogoconsejeria`
-- 

CREATE TABLE `catalogoconsejeria` (
  `idcatalogoConsejeria` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombreConsejeria` text,
  `codigoCPT` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idcatalogoConsejeria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `catalogoconsejeria`

-- 
--  Table structure for table `catalogocpt`
-- 

CREATE TABLE `catalogocpt` (
  `idcatalogoCPT` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigoCPT` varchar(10) DEFAULT NULL,
  `nombre` text,
  `estado` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idcatalogoCPT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `catalogocpt`

-- 
--  Table structure for table `catalogoepisodio`
-- 

CREATE TABLE `catalogoepisodio` (
  `idcatalogoEpisodio` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idetapaVida` int(10) unsigned NOT NULL,
  `nombreEpisodio` text,
  `limiteInicial` float DEFAULT NULL,
  `limiteFinal` float DEFAULT NULL,
  PRIMARY KEY (`idcatalogoEpisodio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `catalogoepisodio`

-- 
--  Table structure for table `catalogoepisodioprestacion`
-- 

CREATE TABLE `catalogoepisodioprestacion` (
  `idcatalogoEpisodioPrestacion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idcatalogoPrestacion` int(10) unsigned NOT NULL,
  `idcatalogoEpisodio` int(10) unsigned NOT NULL,
  `orden` int(10) unsigned DEFAULT NULL,
  `comentario` text,
  `factorProgramacion` int(10) unsigned DEFAULT NULL,
  `opActivo` char(2) DEFAULT NULL,
  PRIMARY KEY (`idcatalogoEpisodioPrestacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `catalogoepisodioprestacion`

-- 
--  Table structure for table `catalogoexamenlaboratorio`
-- 

CREATE TABLE `catalogoexamenlaboratorio` (
  `idcatalogoExamenLaboratorio` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idcatalogoPerfilLaboratorio` int(10) unsigned NOT NULL,
  `tipoExamen` text,
  `nombreExamenLaboratorio` text,
  `unidades` text,
  `rangosNormales` text,
  `opExamen` char(2) DEFAULT NULL,
  PRIMARY KEY (`idcatalogoExamenLaboratorio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `catalogoexamenlaboratorio`

-- 
--  Table structure for table `catalogoinsumo`
-- 

CREATE TABLE `catalogoinsumo` (
  `idcatalogoInsumo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigoInsumo` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `stock` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idcatalogoInsumo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `catalogoinsumo`

-- 
--  Table structure for table `catalogomedicamento`
-- 

CREATE TABLE `catalogomedicamento` (
  `idcatalogoMedicamento` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigoMedicamento` varchar(100) DEFAULT NULL,
  `nombreMedicamento` text,
  `concentracion` varchar(50) DEFAULT NULL,
  `formulaF` text,
  `titular` text,
  `fechaAutorizacion` date DEFAULT NULL,
  `fechaVencimiento` date DEFAULT NULL,
  `fabricante` text,
  `pais` text,
  `condicionVenta` text,
  `grupoProd` text,
  `situacion` varchar(100) DEFAULT NULL,
  `codigoATC` varchar(100) DEFAULT NULL,
  `descripcionATC` text,
  `sustancia` text,
  PRIMARY KEY (`idcatalogoMedicamento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `catalogomedicamento`

-- 
--  Table structure for table `catalogoperfil`
-- 

CREATE TABLE `catalogoperfil` (
  `idcatalogoPerfil` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombrePerfil` text,
  PRIMARY KEY (`idcatalogoPerfil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `catalogoperfil`

-- 
--  Table structure for table `catalogoperfillaboratorio`
-- 

CREATE TABLE `catalogoperfillaboratorio` (
  `idcatalogoPerfilLaboratorio` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombrePerfil` text,
  `descripcion` text,
  PRIMARY KEY (`idcatalogoPerfilLaboratorio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `catalogoperfillaboratorio`

-- 
--  Table structure for table `catalogoprestacion`
-- 

CREATE TABLE `catalogoprestacion` (
  `idcatalogoPrestacion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombrePrestacion` text,
  `formulario` varchar(100) DEFAULT NULL,
  `planificador` char(2) DEFAULT NULL,
  `nombreTabla` varchar(100) DEFAULT NULL,
  `descripcion` text,
  PRIMARY KEY (`idcatalogoPrestacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `catalogoprestacion`

-- 
--  Table structure for table `catalogoprestacionperfil`
-- 

CREATE TABLE `catalogoprestacionperfil` (
  `idcatalogoPrestacionPerfil` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idetapaVida` int(10) unsigned DEFAULT NULL,
  `idcatalogoPrestacion` int(10) unsigned NOT NULL,
  `idcatalogoPerfil` int(10) unsigned NOT NULL,
  `orden` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idcatalogoPrestacionPerfil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `catalogoprestacionperfil`

-- 
--  Table structure for table `catalogoups`
-- 

CREATE TABLE `catalogoups` (
  `idcatalogoUPS` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigoUPS` varchar(10) DEFAULT NULL,
  `nombreUPS` text,
  `sexoUPS` varchar(20) DEFAULT NULL,
  `edadMinima` int(10) unsigned DEFAULT NULL,
  `tipoMinimo` varchar(100) DEFAULT NULL,
  `edadMaxima` int(10) unsigned DEFAULT NULL,
  `tipoMaximo` varchar(100) DEFAULT NULL,
  `clasificacion` int(10) unsigned DEFAULT NULL,
  `opcionHospital` char(2) DEFAULT NULL,
  `opcionCentro` char(2) DEFAULT NULL,
  `opcionPuesto` char(2) DEFAULT NULL,
  `descipcion` text NOT NULL,
  PRIMARY KEY (`idcatalogoUPS`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `catalogoups`

-- 
--  Table structure for table `catalogovacuna`
-- 

CREATE TABLE `catalogovacuna` (
  `idcatalogoVacuna` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombreVacuna` varchar(100) DEFAULT NULL,
  `dosis` int(10) unsigned DEFAULT NULL,
  `descripcionVacuna` text,
  `descripcionIntervalo` text,
  `limiteInferior` int(10) unsigned DEFAULT NULL,
  `limiteSuperior` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idcatalogoVacuna`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `catalogovacuna`

-- 
--  Table structure for table `categoriacie10`
-- 

CREATE TABLE `categoriacie10` (
  `idcategoriaCIE10` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idgrupoCIE10` int(10) unsigned NOT NULL,
  `codigoGrupoCIE10` varchar(10) DEFAULT NULL,
  `codigoCategoriaCIE10` varchar(10) DEFAULT NULL,
  `nombre` text,
  PRIMARY KEY (`idcategoriaCIE10`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `categoriacie10`

-- 
--  Table structure for table `ciclo`
-- 

CREATE TABLE `ciclo` (
  `idciclo` int(11) NOT NULL,
  `idfamilia` int(10) unsigned DEFAULT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `codigoCiclo` int(10) unsigned DEFAULT NULL,
  `nombreCiclo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idciclo`,`claveGeneral`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- Dumping data for table `ciclo`

-- 
--  Table structure for table `cicloh`
-- 

CREATE TABLE `cicloh` (
  `idcicloH` int(10) unsigned NOT NULL,
  `idfamiliaH` int(10) unsigned DEFAULT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `nombreCiclo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idcicloH`,`claveGeneral`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- Dumping data for table `cicloh`

-- 
--  Table structure for table `colegioprofesional`
-- 

CREATE TABLE `colegioprofesional` (
  `idcolegioProfesional` int(11) NOT NULL,
  `valor` char(2) NOT NULL,
  `colegio` varchar(100) NOT NULL,
  PRIMARY KEY (`idcolegioProfesional`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- Dumping data for table `colegioprofesional`

INSERT INTO colegioprofesional VALUES ('1', '00', 'PERSONAL DE SALUD SIN COLEGIATURA');
INSERT INTO colegioprofesional VALUES ('2', '01', 'COLEGIO MEDICO DEL PERU');
INSERT INTO colegioprofesional VALUES ('3', '02', 'COLEGIO QUIMICO FARMACEUTICO DEL PERU');
INSERT INTO colegioprofesional VALUES ('4', '03', 'COLEGIO ODONTOLOGICO DEL PERU');
INSERT INTO colegioprofesional VALUES ('5', '04', 'COLEGIO DE BIOLOGOS DEL PERU');
INSERT INTO colegioprofesional VALUES ('6', '05', 'COLEGIO DE OBSTETRICES DEL PERU');
INSERT INTO colegioprofesional VALUES ('7', '06', 'COLEGIO DE ENFERMEROS DEL PERU');
INSERT INTO colegioprofesional VALUES ('8', '07', 'COLEGIO DE TRABAJADORES SOCIALES DEL PERU');
INSERT INTO colegioprofesional VALUES ('9', '08', 'COLEGIO DE PSICOLOGOS DEL PERU');
INSERT INTO colegioprofesional VALUES ('10', '09', 'COLEGIO TECNOLOGO MEDICO DEL PERU');
INSERT INTO colegioprofesional VALUES ('11', '10', 'COLEGIO DE NUTRICIONISTAS DEL PERU');
-- 
--  Table structure for table `comunidad`
-- 

CREATE TABLE `comunidad` (
  `idcomunidad` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idestablecimiento` int(10) unsigned DEFAULT NULL,
  `nombreComunidad` varchar(100) DEFAULT NULL,
  `descripcion` text,
  PRIMARY KEY (`idcomunidad`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `comunidad`

-- 
--  Table structure for table `condicion`
-- 

CREATE TABLE `condicion` (
  `idcondicion` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idfamilia` int(10) unsigned DEFAULT NULL,
  `idpersona` int(10) unsigned DEFAULT NULL,
  `codigoCondicion` int(10) unsigned DEFAULT NULL,
  `nombreCondicion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idcondicion`,`claveGeneral`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- Dumping data for table `condicion`

-- 
--  Table structure for table `condicionh`
-- 

CREATE TABLE `condicionh` (
  `idcondicionH` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idfamiliaH` int(10) unsigned DEFAULT NULL,
  `idpersonaH` int(10) unsigned DEFAULT NULL,
  `codigoCondicion` int(10) unsigned DEFAULT NULL,
  `nombreCondicion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idcondicionH`,`claveGeneral`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- Dumping data for table `condicionh`

-- 
--  Table structure for table `condiciontrabajador`
-- 

CREATE TABLE `condiciontrabajador` (
  `idcondicionTrabajador` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigoCondicionTrabajador` varchar(10) DEFAULT NULL,
  `nombre` text,
  PRIMARY KEY (`idcondicionTrabajador`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;


-- Dumping data for table `condiciontrabajador`

INSERT INTO condiciontrabajador VALUES ('1', '01', 'NOMBRADO(A)');
INSERT INTO condiciontrabajador VALUES ('2', '02', 'CONTRATADO(A)');
INSERT INTO condiciontrabajador VALUES ('3', '03', 'SERUM');
INSERT INTO condiciontrabajador VALUES ('4', '04', 'RESIDENTE');
INSERT INTO condiciontrabajador VALUES ('5', '05', 'INTERNO(A)');
INSERT INTO condiciontrabajador VALUES ('6', '06', 'ALUMNO(A)');
INSERT INTO condiciontrabajador VALUES ('7', '07', 'AGENTE COMUNITARIO');
INSERT INTO condiciontrabajador VALUES ('8', '09', 'OTROS');
INSERT INTO condiciontrabajador VALUES ('9', '10', 'DESTACADO');
-- 
--  Table structure for table `consejeria`
-- 

CREATE TABLE `consejeria` (
  `idconsejeria` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idepisodio` int(10) unsigned DEFAULT NULL,
  `consejeria` varchar(100) DEFAULT NULL,
  `nroSesion` int(10) unsigned DEFAULT NULL,
  `tema` text,
  PRIMARY KEY (`idconsejeria`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `consejeria`

-- 
--  Table structure for table `datogeneral`
-- 

CREATE TABLE `datogeneral` (
  `claveGeneral` varchar(100) NOT NULL,
  `claves` varchar(100) NOT NULL,
  `lugarCentral` char(2) DEFAULT 'NO',
  PRIMARY KEY (`claveGeneral`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- Dumping data for table `datogeneral`

INSERT INTO datogeneral VALUES ('000004086', '1-3-17-33-370', '');
-- 
--  Table structure for table `detalleconsejeria`
-- 

CREATE TABLE `detalleconsejeria` (
  `iddetalleConsejeria` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idprestacionConsejeria` int(10) unsigned NOT NULL,
  `idcatalogoConsejeria` int(10) unsigned DEFAULT NULL,
  `nombreCatalogo` text,
  `nroSesion` int(10) unsigned DEFAULT NULL,
  `tema` text,
  PRIMARY KEY (`iddetalleConsejeria`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `detalleconsejeria`

-- 
--  Table structure for table `detalleginecobstetrico`
-- 

CREATE TABLE `detalleginecobstetrico` (
  `iddetalleGinecobstetrico` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idantecedenteGinecobstetrico` int(10) unsigned NOT NULL,
  `fechaCulminacion` date DEFAULT NULL,
  `nroAtencionPrenatal` int(10) unsigned DEFAULT NULL,
  `complicacion` char(2) DEFAULT NULL,
  `fuente` varchar(20) DEFAULT NULL,
  `opcionSuplemento` char(2) DEFAULT NULL,
  `aborto` char(2) DEFAULT NULL,
  `lugarParto` varchar(100) DEFAULT NULL,
  `tipoParto` varchar(30) DEFAULT NULL,
  `opHorVer` varchar(30) DEFAULT NULL,
  `idcatalogoCIE10` int(10) unsigned DEFAULT NULL,
  `nombreTipoParto` varchar(100) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `pesoRN` float DEFAULT NULL,
  `idprofesion` int(10) unsigned DEFAULT NULL,
  `idpersonaref` int(10) unsigned DEFAULT NULL,
  `opcionRef` char(2) DEFAULT NULL,
  PRIMARY KEY (`iddetalleGinecobstetrico`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `detalleginecobstetrico`

-- 
--  Table structure for table `detallepais`
-- 

CREATE TABLE `detallepais` (
  `iddetallePAIS` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idcatalogoEpisodioPrestacion` int(10) unsigned NOT NULL,
  `idPAIS` int(10) unsigned NOT NULL,
  `tipoProgramacion` varchar(100) DEFAULT NULL,
  `fechaPlanificada` date DEFAULT NULL,
  PRIMARY KEY (`iddetallePAIS`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `detallepais`

-- 
--  Table structure for table `detallevacuna`
-- 

CREATE TABLE `detallevacuna` (
  `iddetalleVacuna` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idvacuna` int(10) unsigned NOT NULL,
  `nroDosis` int(10) unsigned DEFAULT NULL,
  `opProgramacion` varchar(20) DEFAULT NULL,
  `tipoProgramacion` varchar(100) DEFAULT NULL,
  `fechaProgramada` date DEFAULT NULL,
  `fechaAplicacion` date DEFAULT NULL,
  `estadoDosis` varchar(100) DEFAULT NULL,
  `lugarAplicacion` varchar(30) DEFAULT NULL,
  `observaciones` text,
  PRIMARY KEY (`iddetalleVacuna`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `detallevacuna`

-- 
--  Table structure for table `diagnostico`
-- 

CREATE TABLE `diagnostico` (
  `claveGeneral` varchar(100) NOT NULL,
  `iddiagnostico` int(10) unsigned NOT NULL,
  `idepisodio` int(10) unsigned DEFAULT NULL,
  `idcatalogoCIE10` int(10) unsigned DEFAULT NULL,
  `nombreCatalogo` text,
  `variableLab` varchar(100) DEFAULT NULL,
  `observacion` text,
  `opcionPacienteEst` varchar(100) DEFAULT NULL,
  `opcionPacienteServ` varchar(100) DEFAULT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `opReferencia` char(2) DEFAULT NULL,
  PRIMARY KEY (`claveGeneral`,`iddiagnostico`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `diagnostico`

-- 
--  Table structure for table `diresa`
-- 

CREATE TABLE `diresa` (
  `iddiresa` int(11) NOT NULL,
  `idregion` int(11) NOT NULL,
  `nombreDiresa` varchar(100) NOT NULL,
  `codigoDiresa` char(2) NOT NULL,
  PRIMARY KEY (`iddiresa`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- Dumping data for table `diresa`

INSERT INTO diresa VALUES ('1', '9', 'DIRESA HUANCAVELICA', '13');
INSERT INTO diresa VALUES ('2', '1', 'DIRESA AMAZONAS', '01');
INSERT INTO diresa VALUES ('3', '2', 'DIRESA ANCASH', '02');
INSERT INTO diresa VALUES ('4', '3', 'DIRESA APURIMAC I', '03');
INSERT INTO diresa VALUES ('5', '4', 'DIRESA AREQUIPA', '04');
INSERT INTO diresa VALUES ('6', '5', 'DIRESA AYACUCHO', '05');
INSERT INTO diresa VALUES ('7', '1', 'DIRESA BAGUA', '06');
INSERT INTO diresa VALUES ('8', '6', 'DIRESA CAJAMARCA I', '07');
INSERT INTO diresa VALUES ('9', '7', 'DIRESA CALLAO (LIMA I)', '08');
INSERT INTO diresa VALUES ('10', '3', 'DIRESA CHANKA-ANDAHUAYLAS APURIMAC II', '09');
INSERT INTO diresa VALUES ('11', '6', 'DIRESA CHOTA CAJAMARCA II', '10');
INSERT INTO diresa VALUES ('12', '8', 'DIRESA CUSCO', '11');
INSERT INTO diresa VALUES ('13', '6', 'DIRESA CUTERVO CAJAMARCA III', '12');
INSERT INTO diresa VALUES ('14', '10', 'DIRESA HUANUCO', '14');
INSERT INTO diresa VALUES ('15', '11', 'DIRESA ICA', '15');
INSERT INTO diresa VALUES ('16', '6', 'DIRESA JAEN', '16');
INSERT INTO diresa VALUES ('17', '12', 'DIRESA JUNIN', '17');
INSERT INTO diresa VALUES ('18', '13', 'DIRESA LA LIBERTAD', '18');
INSERT INTO diresa VALUES ('19', '14', 'DIRESA LAMBAYEQUE', '19');
INSERT INTO diresa VALUES ('20', '15', 'DIRESA LIMA CIUDAD (LIMA V)', '20');
INSERT INTO diresa VALUES ('21', '15', 'DIRESA LIMA ESTE (LIMA IV)', '21');
INSERT INTO diresa VALUES ('22', '15', 'DIRESA LIMA NORTE (LIMA III)', '22');
INSERT INTO diresa VALUES ('23', '15', 'DIRESA LIMA SUR (LIMA II)', '23');
INSERT INTO diresa VALUES ('24', '16', 'DIRESA LORETO', '24');
INSERT INTO diresa VALUES ('25', '17', 'DIRESA MADRE DE DIOS (PTO.MALDONADO)', '25');
INSERT INTO diresa VALUES ('26', '18', 'DIRESA MOQUEGUA', '26');
INSERT INTO diresa VALUES ('27', '19', 'DIRESA PASCO', '27');
INSERT INTO diresa VALUES ('28', '20', 'DIRESA PIURA I', '28');
INSERT INTO diresa VALUES ('29', '21', 'DIRESA PUNO', '29');
INSERT INTO diresa VALUES ('30', '22', 'DIRESA SAN MARTIN', '30');
INSERT INTO diresa VALUES ('31', '20', 'DIRESA SULLANA PIURA II', '31');
INSERT INTO diresa VALUES ('32', '23', 'DIRESA TACNA', '32');
INSERT INTO diresa VALUES ('33', '24', 'DIRESA TUMBES', '33');
INSERT INTO diresa VALUES ('34', '25', 'DIRESA UCAYALI', '34');
-- 
--  Table structure for table `distrito`
-- 

CREATE TABLE `distrito` (
  `iddistrito` int(10) unsigned NOT NULL,
  `idprovincia` int(10) unsigned DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `codigoDistrito` char(8) NOT NULL,
  PRIMARY KEY (`iddistrito`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `distrito`

INSERT INTO distrito VALUES ('1', '1', 'CHACHAPOYAS', '010101');
INSERT INTO distrito VALUES ('2', '1', 'ASUNCION', '010102');
INSERT INTO distrito VALUES ('3', '1', 'BALSAS', '010103');
INSERT INTO distrito VALUES ('4', '1', 'CHETO', '010104');
INSERT INTO distrito VALUES ('5', '1', 'CHILIQUIN', '010105');
INSERT INTO distrito VALUES ('6', '1', 'CHUQUIBAMBA', '010106');
INSERT INTO distrito VALUES ('7', '1', 'GRANADA', '010107');
INSERT INTO distrito VALUES ('8', '1', 'HUANCAS', '010108');
INSERT INTO distrito VALUES ('9', '1', 'LA JALCA', '010109');
INSERT INTO distrito VALUES ('10', '1', 'LEIMEBAMBA', '010110');
INSERT INTO distrito VALUES ('11', '1', 'LEVANTO', '010111');
INSERT INTO distrito VALUES ('12', '1', 'MAGDALENA', '010112');
INSERT INTO distrito VALUES ('13', '1', 'MARISCAL CASTILLA', '010113');
INSERT INTO distrito VALUES ('14', '1', 'MOLINOPAMPA', '010114');
INSERT INTO distrito VALUES ('15', '1', 'MONTEVIDEO', '010115');
INSERT INTO distrito VALUES ('16', '1', 'OLLEROS', '010116');
INSERT INTO distrito VALUES ('17', '1', 'QUINJALCA', '010117');
INSERT INTO distrito VALUES ('18', '1', 'SAN FRANCISCO DE DAGUAS', '010118');
INSERT INTO distrito VALUES ('19', '1', 'SAN ISIDRO DE MAINO', '010119');
INSERT INTO distrito VALUES ('20', '1', 'SOLOCO', '010120');
INSERT INTO distrito VALUES ('21', '1', 'SONCHE', '010121');
INSERT INTO distrito VALUES ('22', '2', 'BAGUA', '010201');
INSERT INTO distrito VALUES ('23', '2', 'ARAMANGO', '010202');
INSERT INTO distrito VALUES ('24', '2', 'COPALLIN', '010203');
INSERT INTO distrito VALUES ('25', '2', 'EL PARCO', '010204');
INSERT INTO distrito VALUES ('26', '2', 'IMAZA', '010205');
INSERT INTO distrito VALUES ('27', '3', 'JUMBILLA', '010301');
INSERT INTO distrito VALUES ('28', '3', 'CHISQUILLA', '010302');
INSERT INTO distrito VALUES ('29', '3', 'CHURUJA', '010303');
INSERT INTO distrito VALUES ('30', '3', 'COROSHA', '010304');
INSERT INTO distrito VALUES ('31', '3', 'CUISPES', '010305');
INSERT INTO distrito VALUES ('32', '3', 'FLORIDA', '010306');
INSERT INTO distrito VALUES ('33', '3', 'JAZAN', '010307');
INSERT INTO distrito VALUES ('34', '3', 'RECTA', '010308');
INSERT INTO distrito VALUES ('35', '3', 'SAN CARLOS', '010309');
INSERT INTO distrito VALUES ('36', '3', 'SHIPASBAMBA', '010310');
INSERT INTO distrito VALUES ('37', '3', 'VALERA', '010311');
INSERT INTO distrito VALUES ('38', '3', 'YAMBRASBAMBA', '010312');
INSERT INTO distrito VALUES ('39', '4', 'NIEVA', '010401');
INSERT INTO distrito VALUES ('40', '4', 'EL CENEPA', '010402');
INSERT INTO distrito VALUES ('41', '4', 'RIO SANTIAGO', '010403');
INSERT INTO distrito VALUES ('42', '5', 'LAMUD', '010501');
INSERT INTO distrito VALUES ('43', '5', 'CAMPORREDONDO', '010502');
INSERT INTO distrito VALUES ('44', '5', 'COCABAMBA', '010503');
INSERT INTO distrito VALUES ('45', '5', 'COLCAMAR', '010504');
INSERT INTO distrito VALUES ('46', '5', 'CONILA', '010505');
INSERT INTO distrito VALUES ('47', '5', 'INGUILPATA', '010506');
INSERT INTO distrito VALUES ('48', '5', 'LONGUITA', '010507');
INSERT INTO distrito VALUES ('49', '5', 'LONYA CHICO', '010508');
INSERT INTO distrito VALUES ('50', '5', 'LUYA', '010509');
INSERT INTO distrito VALUES ('51', '5', 'LUYA VIEJO', '010510');
INSERT INTO distrito VALUES ('52', '5', 'MARIA', '010511');
INSERT INTO distrito VALUES ('53', '5', 'OCALLI', '010512');
INSERT INTO distrito VALUES ('54', '5', 'OCUMAL', '010513');
INSERT INTO distrito VALUES ('55', '5', 'PISUQUIA', '010514');
INSERT INTO distrito VALUES ('56', '5', 'PROVIDENCIA', '010515');
INSERT INTO distrito VALUES ('57', '5', 'SAN CRISTOBAL', '010516');
INSERT INTO distrito VALUES ('58', '5', 'SAN FRANCISCO DEL YESO', '010517');
INSERT INTO distrito VALUES ('59', '5', 'SAN JERONIMO', '010518');
INSERT INTO distrito VALUES ('60', '5', 'SAN JUAN DE LOPECANCHA', '010519');
INSERT INTO distrito VALUES ('61', '5', 'SANTA CATALINA', '010520');
INSERT INTO distrito VALUES ('62', '5', 'SANTO TOMAS', '010521');
INSERT INTO distrito VALUES ('63', '5', 'TINGO', '010522');
INSERT INTO distrito VALUES ('64', '5', 'TRITA', '010523');
INSERT INTO distrito VALUES ('65', '6', 'SAN NICOLAS', '010601');
INSERT INTO distrito VALUES ('66', '6', 'CHIRIMOTO', '010602');
INSERT INTO distrito VALUES ('67', '6', 'COCHAMAL', '010603');
INSERT INTO distrito VALUES ('68', '6', 'HUAMBO', '010604');
INSERT INTO distrito VALUES ('69', '6', 'LIMABAMBA', '010605');
INSERT INTO distrito VALUES ('70', '6', 'LONGAR', '010606');
INSERT INTO distrito VALUES ('71', '6', 'MARISCAL BENAVIDES', '010607');
INSERT INTO distrito VALUES ('72', '6', 'MILPUC', '010608');
INSERT INTO distrito VALUES ('73', '6', 'OMIA', '010609');
INSERT INTO distrito VALUES ('74', '6', 'SANTA ROSA', '010610');
INSERT INTO distrito VALUES ('75', '6', 'TOTORA', '010611');
INSERT INTO distrito VALUES ('76', '6', 'VISTA ALEGRE', '010612');
INSERT INTO distrito VALUES ('77', '7', 'BAGUA GRANDE', '010701');
INSERT INTO distrito VALUES ('78', '7', 'CAJARURO', '010702');
INSERT INTO distrito VALUES ('79', '7', 'CUMBA', '010703');
INSERT INTO distrito VALUES ('80', '7', 'EL MILAGRO', '010704');
INSERT INTO distrito VALUES ('81', '7', 'JAMALCA', '010705');
INSERT INTO distrito VALUES ('82', '7', 'LONYA GRANDE', '010706');
INSERT INTO distrito VALUES ('83', '7', 'YAMON', '010707');
INSERT INTO distrito VALUES ('84', '8', 'HUARAZ', '020101');
INSERT INTO distrito VALUES ('85', '8', 'COCHABAMBA', '020102');
INSERT INTO distrito VALUES ('86', '8', 'COLCABAMBA', '020103');
INSERT INTO distrito VALUES ('87', '8', 'HUANCHAY', '020104');
INSERT INTO distrito VALUES ('88', '8', 'INDEPENDENCIA', '020105');
INSERT INTO distrito VALUES ('89', '8', 'JANGAS', '020106');
INSERT INTO distrito VALUES ('90', '8', 'LA LIBERTAD', '020107');
INSERT INTO distrito VALUES ('91', '8', 'OLLEROS', '020108');
INSERT INTO distrito VALUES ('92', '8', 'PAMPAS GRANDE', '020109');
INSERT INTO distrito VALUES ('93', '8', 'PARIACOTO', '020110');
INSERT INTO distrito VALUES ('94', '8', 'PIRA', '020111');
INSERT INTO distrito VALUES ('95', '8', 'TARICA', '020112');
INSERT INTO distrito VALUES ('96', '9', 'AIJA', '020201');
INSERT INTO distrito VALUES ('97', '9', 'CORIS', '020202');
INSERT INTO distrito VALUES ('98', '9', 'HUACLLAN', '020203');
INSERT INTO distrito VALUES ('99', '9', 'LA MERCED', '020204');
INSERT INTO distrito VALUES ('100', '9', 'SUCCHA', '020205');
INSERT INTO distrito VALUES ('101', '10', 'LLAMELLIN', '020301');
INSERT INTO distrito VALUES ('102', '10', 'ACZO', '020302');
INSERT INTO distrito VALUES ('103', '10', 'CHACCHO', '020303');
INSERT INTO distrito VALUES ('104', '10', 'CHINGAS', '020304');
INSERT INTO distrito VALUES ('105', '10', 'MIRGAS', '020305');
INSERT INTO distrito VALUES ('106', '10', 'SAN JUAN DE RONTOY', '020306');
INSERT INTO distrito VALUES ('107', '11', 'CHACAS', '020401');
INSERT INTO distrito VALUES ('108', '11', 'ACOCHACA', '020402');
INSERT INTO distrito VALUES ('109', '12', 'CHIQUIAN', '020501');
INSERT INTO distrito VALUES ('110', '12', 'ABELARDO PARDO LEZAMETA', '020502');
INSERT INTO distrito VALUES ('111', '12', 'ANTONIO RAYMONDI', '020503');
INSERT INTO distrito VALUES ('112', '12', 'AQUIA', '020504');
INSERT INTO distrito VALUES ('113', '12', 'CAJACAY', '020505');
INSERT INTO distrito VALUES ('114', '12', 'CANIS', '020506');
INSERT INTO distrito VALUES ('115', '12', 'COLQUIOC', '020507');
INSERT INTO distrito VALUES ('116', '12', 'HUALLANCA', '020508');
INSERT INTO distrito VALUES ('117', '12', 'HUASTA', '020509');
INSERT INTO distrito VALUES ('118', '12', 'HUAYLLACAYAN', '020510');
INSERT INTO distrito VALUES ('119', '12', 'LA PRIMAVERA', '020511');
INSERT INTO distrito VALUES ('120', '12', 'MANGAS', '020512');
INSERT INTO distrito VALUES ('121', '12', 'PACLLON', '020513');
INSERT INTO distrito VALUES ('122', '12', 'SAN MIGUEL DE CORPANQUI', '020514');
INSERT INTO distrito VALUES ('123', '12', 'TICLLOS', '020515');
INSERT INTO distrito VALUES ('124', '13', 'CARHUAZ', '020601');
INSERT INTO distrito VALUES ('125', '13', 'ACOPAMPA', '020602');
INSERT INTO distrito VALUES ('126', '13', 'AMASHCA', '020603');
INSERT INTO distrito VALUES ('127', '13', 'ANTA', '020604');
INSERT INTO distrito VALUES ('128', '13', 'ATAQUERO', '020605');
INSERT INTO distrito VALUES ('129', '13', 'MARCARA', '020606');
INSERT INTO distrito VALUES ('130', '13', 'PARIAHUANCA', '020607');
INSERT INTO distrito VALUES ('131', '13', 'SAN MIGUEL DE ACO', '020608');
INSERT INTO distrito VALUES ('132', '13', 'SHILLA', '020609');
INSERT INTO distrito VALUES ('133', '13', 'TINCO', '020610');
INSERT INTO distrito VALUES ('134', '13', 'YUNGAR', '020611');
INSERT INTO distrito VALUES ('135', '14', 'SAN LUIS', '020701');
INSERT INTO distrito VALUES ('136', '14', 'SAN NICOLAS', '020702');
INSERT INTO distrito VALUES ('137', '14', 'YAUYA', '020703');
INSERT INTO distrito VALUES ('138', '15', 'CASMA', '020801');
INSERT INTO distrito VALUES ('139', '15', 'BUENA VISTA ALTA', '020802');
INSERT INTO distrito VALUES ('140', '15', 'COMANDANTE NOEL', '020803');
INSERT INTO distrito VALUES ('141', '15', 'YAUTAN', '020804');
INSERT INTO distrito VALUES ('142', '16', 'CORONGO', '020901');
INSERT INTO distrito VALUES ('143', '16', 'ACO', '020902');
INSERT INTO distrito VALUES ('144', '16', 'BAMBAS', '020903');
INSERT INTO distrito VALUES ('145', '16', 'CUSCA', '020904');
INSERT INTO distrito VALUES ('146', '16', 'LA PAMPA', '020905');
INSERT INTO distrito VALUES ('147', '16', 'YANAC', '020906');
INSERT INTO distrito VALUES ('148', '16', 'YUPAN', '020907');
INSERT INTO distrito VALUES ('149', '17', 'HUARI', '021001');
INSERT INTO distrito VALUES ('150', '17', 'ANRA', '021002');
INSERT INTO distrito VALUES ('151', '17', 'CAJAY', '021003');
INSERT INTO distrito VALUES ('152', '17', 'CHAVIN DE HUANTAR', '021004');
INSERT INTO distrito VALUES ('153', '17', 'HUACACHI', '021005');
INSERT INTO distrito VALUES ('154', '17', 'HUACCHIS', '021006');
INSERT INTO distrito VALUES ('155', '17', 'HUACHIS', '021007');
INSERT INTO distrito VALUES ('156', '17', 'HUANTAR', '021008');
INSERT INTO distrito VALUES ('157', '17', 'MASIN', '021009');
INSERT INTO distrito VALUES ('158', '17', 'PAUCAS', '021010');
INSERT INTO distrito VALUES ('159', '17', 'PONTO', '021011');
INSERT INTO distrito VALUES ('160', '17', 'RAHUAPAMPA', '021012');
INSERT INTO distrito VALUES ('161', '17', 'RAPAYAN', '021013');
INSERT INTO distrito VALUES ('162', '17', 'SAN MARCOS', '021014');
INSERT INTO distrito VALUES ('163', '17', 'SAN PEDRO DE CHANA', '021015');
INSERT INTO distrito VALUES ('164', '17', 'UCO', '021016');
INSERT INTO distrito VALUES ('165', '18', 'HUARMEY', '021101');
INSERT INTO distrito VALUES ('166', '18', 'COCHAPETI', '021102');
INSERT INTO distrito VALUES ('167', '18', 'CULEBRAS', '021103');
INSERT INTO distrito VALUES ('168', '18', 'HUAYAN', '021104');
INSERT INTO distrito VALUES ('169', '18', 'MALVAS', '021105');
INSERT INTO distrito VALUES ('170', '19', 'CARAZ', '021201');
INSERT INTO distrito VALUES ('171', '19', 'HUALLANCA', '021202');
INSERT INTO distrito VALUES ('172', '19', 'HUATA', '021203');
INSERT INTO distrito VALUES ('173', '19', 'HUAYLAS', '021204');
INSERT INTO distrito VALUES ('174', '19', 'MATO', '021205');
INSERT INTO distrito VALUES ('175', '19', 'PAMPAROMAS', '021206');
INSERT INTO distrito VALUES ('176', '19', 'PUEBLO LIBRE', '021207');
INSERT INTO distrito VALUES ('177', '19', 'SANTA CRUZ', '021208');
INSERT INTO distrito VALUES ('178', '19', 'SANTO TORIBIO', '021209');
INSERT INTO distrito VALUES ('179', '19', 'YURACMARCA', '021210');
INSERT INTO distrito VALUES ('180', '20', 'PISCOBAMBA', '021301');
INSERT INTO distrito VALUES ('181', '20', 'CASCA', '021302');
INSERT INTO distrito VALUES ('182', '20', 'ELEAZAR GUZMAN BARRON', '021303');
INSERT INTO distrito VALUES ('183', '20', 'FIDEL OLIVAS ESCUDERO', '021304');
INSERT INTO distrito VALUES ('184', '20', 'LLAMA', '021305');
INSERT INTO distrito VALUES ('185', '20', 'LLUMPA', '021306');
INSERT INTO distrito VALUES ('186', '20', 'LUCMA', '021307');
INSERT INTO distrito VALUES ('187', '20', 'MUSGA', '021308');
INSERT INTO distrito VALUES ('188', '21', 'OCROS', '021401');
INSERT INTO distrito VALUES ('189', '21', 'ACAS', '021402');
INSERT INTO distrito VALUES ('190', '21', 'CAJAMARQUILLA', '021403');
INSERT INTO distrito VALUES ('191', '21', 'CARHUAPAMPA', '021404');
INSERT INTO distrito VALUES ('192', '21', 'COCHAS', '021405');
INSERT INTO distrito VALUES ('193', '21', 'CONGAS', '021406');
INSERT INTO distrito VALUES ('194', '21', 'LLIPA', '021407');
INSERT INTO distrito VALUES ('195', '21', 'SAN CRISTOBAL DE RAJAN', '021408');
INSERT INTO distrito VALUES ('196', '21', 'SAN PEDRO', '021409');
INSERT INTO distrito VALUES ('197', '21', 'SANTIAGO DE CHILCAS', '021410');
INSERT INTO distrito VALUES ('198', '22', 'CABANA', '021501');
INSERT INTO distrito VALUES ('199', '22', 'BOLOGNESI', '021502');
INSERT INTO distrito VALUES ('200', '22', 'CONCHUCOS', '021503');
INSERT INTO distrito VALUES ('201', '22', 'HUACASCHUQUE', '021504');
INSERT INTO distrito VALUES ('202', '22', 'HUANDOVAL', '021505');
INSERT INTO distrito VALUES ('203', '22', 'LACABAMBA', '021506');
INSERT INTO distrito VALUES ('204', '22', 'LLAPO', '021507');
INSERT INTO distrito VALUES ('205', '22', 'PALLASCA', '021508');
INSERT INTO distrito VALUES ('206', '22', 'PAMPAS', '021509');
INSERT INTO distrito VALUES ('207', '22', 'SANTA ROSA', '021510');
INSERT INTO distrito VALUES ('208', '22', 'TAUCA', '021511');
INSERT INTO distrito VALUES ('209', '23', 'POMABAMBA', '021601');
INSERT INTO distrito VALUES ('210', '23', 'HUAYLLAN', '021602');
INSERT INTO distrito VALUES ('211', '23', 'PAROBAMBA', '021603');
INSERT INTO distrito VALUES ('212', '23', 'QUINUABAMBA', '021604');
INSERT INTO distrito VALUES ('213', '24', 'RECUAY', '021701');
INSERT INTO distrito VALUES ('214', '24', 'CATAC', '021702');
INSERT INTO distrito VALUES ('215', '24', 'COTAPARACO', '021703');
INSERT INTO distrito VALUES ('216', '24', 'HUAYLLAPAMPA', '021704');
INSERT INTO distrito VALUES ('217', '24', 'LLACLLIN', '021705');
INSERT INTO distrito VALUES ('218', '24', 'MARCA', '021706');
INSERT INTO distrito VALUES ('219', '24', 'PAMPAS CHICO', '021707');
INSERT INTO distrito VALUES ('220', '24', 'PARARIN', '021708');
INSERT INTO distrito VALUES ('221', '24', 'TAPACOCHA', '021709');
INSERT INTO distrito VALUES ('222', '24', 'TICAPAMPA', '021710');
INSERT INTO distrito VALUES ('223', '25', 'CHIMBOTE', '021801');
INSERT INTO distrito VALUES ('224', '25', 'CACERES DEL PERU', '021802');
INSERT INTO distrito VALUES ('225', '25', 'COISHCO', '021803');
INSERT INTO distrito VALUES ('226', '25', 'MACATE', '021804');
INSERT INTO distrito VALUES ('227', '25', 'MORO', '021805');
INSERT INTO distrito VALUES ('228', '25', 'NEPENA', '021806');
INSERT INTO distrito VALUES ('229', '25', 'SAMANCO', '021807');
INSERT INTO distrito VALUES ('230', '25', 'SANTA', '021808');
INSERT INTO distrito VALUES ('231', '25', 'NUEVO CHIMBOTE', '021809');
INSERT INTO distrito VALUES ('232', '26', 'SIHUAS', '021901');
INSERT INTO distrito VALUES ('233', '26', 'ACOBAMBA', '021902');
INSERT INTO distrito VALUES ('234', '26', 'ALFONSO UGARTE', '021903');
INSERT INTO distrito VALUES ('235', '26', 'CASHAPAMPA', '021904');
INSERT INTO distrito VALUES ('236', '26', 'CHINGALPO', '021905');
INSERT INTO distrito VALUES ('237', '26', 'HUAYLLABAMBA', '021906');
INSERT INTO distrito VALUES ('238', '26', 'QUICHES', '021907');
INSERT INTO distrito VALUES ('239', '26', 'RAGASH', '021908');
INSERT INTO distrito VALUES ('240', '26', 'SAN JUAN', '021909');
INSERT INTO distrito VALUES ('241', '26', 'SICSIBAMBA', '021910');
INSERT INTO distrito VALUES ('242', '27', 'YUNGAY', '022001');
INSERT INTO distrito VALUES ('243', '27', 'CASCAPARA', '022002');
INSERT INTO distrito VALUES ('244', '27', 'MANCOS', '022003');
INSERT INTO distrito VALUES ('245', '27', 'MATACOTO', '022004');
INSERT INTO distrito VALUES ('246', '27', 'QUILLO', '022005');
INSERT INTO distrito VALUES ('247', '27', 'RANRAHIRCA', '022006');
INSERT INTO distrito VALUES ('248', '27', 'SHUPLUY', '022007');
INSERT INTO distrito VALUES ('249', '27', 'YANAMA', '022008');
INSERT INTO distrito VALUES ('250', '28', 'ABANCAY', '030101');
INSERT INTO distrito VALUES ('251', '28', 'CHACOCHE', '030102');
INSERT INTO distrito VALUES ('252', '28', 'CIRCA', '030103');
INSERT INTO distrito VALUES ('253', '28', 'CURAHUASI', '030104');
INSERT INTO distrito VALUES ('254', '28', 'HUANIPACA', '030105');
INSERT INTO distrito VALUES ('255', '28', 'LAMBRAMA', '030106');
INSERT INTO distrito VALUES ('256', '28', 'PICHIRHUA', '030107');
INSERT INTO distrito VALUES ('257', '28', 'SAN PEDRO DE CACHORA', '030108');
INSERT INTO distrito VALUES ('258', '28', 'TAMBURCO', '030109');
INSERT INTO distrito VALUES ('259', '29', 'ANDAHUAYLAS', '030201');
INSERT INTO distrito VALUES ('260', '29', 'ANDARAPA', '030202');
INSERT INTO distrito VALUES ('261', '29', 'CHIARA', '030203');
INSERT INTO distrito VALUES ('262', '29', 'HUANCARAMA', '030204');
INSERT INTO distrito VALUES ('263', '29', 'HUANCARAY', '030205');
INSERT INTO distrito VALUES ('264', '29', 'HUAYANA', '030206');
INSERT INTO distrito VALUES ('265', '29', 'KISHUARA', '030207');
INSERT INTO distrito VALUES ('266', '29', 'PACOBAMBA', '030208');
INSERT INTO distrito VALUES ('267', '29', 'PACUCHA', '030209');
INSERT INTO distrito VALUES ('268', '29', 'PAMPACHIRI', '030210');
INSERT INTO distrito VALUES ('269', '29', 'POMACOCHA', '030211');
INSERT INTO distrito VALUES ('270', '29', 'SAN ANTONIO DE CACHI', '030212');
INSERT INTO distrito VALUES ('271', '29', 'SAN JERONIMO', '030213');
INSERT INTO distrito VALUES ('272', '29', 'SAN MIGUEL DE CHACCRAMPA', '030214');
INSERT INTO distrito VALUES ('273', '29', 'SANTA MARIA DE CHICMO', '030215');
INSERT INTO distrito VALUES ('274', '29', 'TALAVERA', '030216');
INSERT INTO distrito VALUES ('275', '29', 'TUMAY HUARACA', '030217');
INSERT INTO distrito VALUES ('276', '29', 'TURPO', '030218');
INSERT INTO distrito VALUES ('277', '29', 'KAQUIABAMBA', '030219');
INSERT INTO distrito VALUES ('278', '30', 'ANTABAMBA', '030301');
INSERT INTO distrito VALUES ('279', '30', 'EL ORO', '030302');
INSERT INTO distrito VALUES ('280', '30', 'HUAQUIRCA', '030303');
INSERT INTO distrito VALUES ('281', '30', 'JUAN ESPINOZA MEDRANO', '030304');
INSERT INTO distrito VALUES ('282', '30', 'OROPESA', '030305');
INSERT INTO distrito VALUES ('283', '30', 'PACHACONAS', '030306');
INSERT INTO distrito VALUES ('284', '30', 'SABAINO', '030307');
INSERT INTO distrito VALUES ('285', '31', 'CHALHUANCA', '030401');
INSERT INTO distrito VALUES ('286', '31', 'CAPAYA', '030402');
INSERT INTO distrito VALUES ('287', '31', 'CARAYBAMBA', '030403');
INSERT INTO distrito VALUES ('288', '31', 'CHAPIMARCA', '030404');
INSERT INTO distrito VALUES ('289', '31', 'COLCABAMBA', '030405');
INSERT INTO distrito VALUES ('290', '31', 'COTARUSE', '030406');
INSERT INTO distrito VALUES ('291', '31', 'IHUAYLLO', '030407');
INSERT INTO distrito VALUES ('292', '31', 'JUSTO APU SAHUARAURA', '030408');
INSERT INTO distrito VALUES ('293', '31', 'LUCRE', '030409');
INSERT INTO distrito VALUES ('294', '31', 'POCOHUANCA', '030410');
INSERT INTO distrito VALUES ('295', '31', 'SAN JUAN DE CHACNA', '030411');
INSERT INTO distrito VALUES ('296', '31', 'SANAYCA', '030412');
INSERT INTO distrito VALUES ('297', '31', 'SORAYA', '030413');
INSERT INTO distrito VALUES ('298', '31', 'TAPAIRIHUA', '030414');
INSERT INTO distrito VALUES ('299', '31', 'TINTAY', '030415');
INSERT INTO distrito VALUES ('300', '31', 'TORAYA', '030416');
INSERT INTO distrito VALUES ('301', '31', 'YANACA', '030417');
INSERT INTO distrito VALUES ('302', '32', 'TAMBOBAMBA', '030501');
INSERT INTO distrito VALUES ('303', '32', 'COTABAMBAS', '030502');
INSERT INTO distrito VALUES ('304', '32', 'COYLLURQUI', '030503');
INSERT INTO distrito VALUES ('305', '32', 'HAQUIRA', '030504');
INSERT INTO distrito VALUES ('306', '32', 'MARA', '030505');
INSERT INTO distrito VALUES ('307', '32', 'CHALLHUAHUACHO', '030506');
INSERT INTO distrito VALUES ('308', '33', 'CHINCHEROS', '030601');
INSERT INTO distrito VALUES ('309', '33', 'ANCO_HUALLO', '030602');
INSERT INTO distrito VALUES ('310', '33', 'COCHARCAS', '030603');
INSERT INTO distrito VALUES ('311', '33', 'HUACCANA', '030604');
INSERT INTO distrito VALUES ('312', '33', 'OCOBAMBA', '030605');
INSERT INTO distrito VALUES ('313', '33', 'ONGOY', '030606');
INSERT INTO distrito VALUES ('314', '33', 'URANMARCA', '030607');
INSERT INTO distrito VALUES ('315', '33', 'RANRACANCHA', '030608');
INSERT INTO distrito VALUES ('316', '195', 'CHUQUIBAMBILLA', '030701');
INSERT INTO distrito VALUES ('317', '195', 'CURPAHUASI', '030702');
INSERT INTO distrito VALUES ('318', '195', 'GAMARRA', '030703');
INSERT INTO distrito VALUES ('319', '195', 'HUAYLLATI', '030704');
INSERT INTO distrito VALUES ('320', '195', 'MAMARA', '030705');
INSERT INTO distrito VALUES ('321', '195', 'MICAELA BASTIDAS', '030706');
INSERT INTO distrito VALUES ('322', '195', 'PATAYPAMPA', '030707');
INSERT INTO distrito VALUES ('323', '195', 'PROGRESO', '030708');
INSERT INTO distrito VALUES ('324', '195', 'SAN ANTONIO', '030709');
INSERT INTO distrito VALUES ('325', '195', 'SANTA ROSA', '030710');
INSERT INTO distrito VALUES ('326', '195', 'TURPAY', '030711');
INSERT INTO distrito VALUES ('327', '195', 'VILCABAMBA', '030712');
INSERT INTO distrito VALUES ('328', '195', 'VIRUNDO', '030713');
INSERT INTO distrito VALUES ('329', '195', 'CURASCO', '030714');
INSERT INTO distrito VALUES ('330', '34', 'AREQUIPA', '040101');
INSERT INTO distrito VALUES ('331', '34', 'ALTO SELVA ALEGRE', '040102');
INSERT INTO distrito VALUES ('332', '34', 'CAYMA', '040103');
INSERT INTO distrito VALUES ('333', '34', 'CERRO COLORADO', '040104');
INSERT INTO distrito VALUES ('334', '34', 'CHARACATO', '040105');
INSERT INTO distrito VALUES ('335', '34', 'CHIGUATA', '040106');
INSERT INTO distrito VALUES ('336', '34', 'JACOBO HUNTER', '040107');
INSERT INTO distrito VALUES ('337', '34', 'LA JOYA', '040108');
INSERT INTO distrito VALUES ('338', '34', 'MARIANO MELGAR', '040109');
INSERT INTO distrito VALUES ('339', '34', 'MIRAFLORES', '040110');
INSERT INTO distrito VALUES ('340', '34', 'MOLLEBAYA', '040111');
INSERT INTO distrito VALUES ('341', '34', 'PAUCARPATA', '040112');
INSERT INTO distrito VALUES ('342', '34', 'POCSI', '040113');
INSERT INTO distrito VALUES ('343', '34', 'POLOBAYA', '040114');
INSERT INTO distrito VALUES ('344', '34', 'QUEQUENA', '040115');
INSERT INTO distrito VALUES ('345', '34', 'SABANDIA', '040116');
INSERT INTO distrito VALUES ('346', '34', 'SACHACA', '040117');
INSERT INTO distrito VALUES ('347', '34', 'SAN JUAN DE SIGUAS', '040118');
INSERT INTO distrito VALUES ('348', '34', 'SAN JUAN DE TARUCANI', '040119');
INSERT INTO distrito VALUES ('349', '34', 'SANTA ISABEL DE SIGUAS', '040120');
INSERT INTO distrito VALUES ('350', '34', 'SANTA RITA DE SIGUAS', '040121');
INSERT INTO distrito VALUES ('351', '34', 'SOCABAYA', '040122');
INSERT INTO distrito VALUES ('352', '34', 'TIABAYA', '040123');
INSERT INTO distrito VALUES ('353', '34', 'UCHUMAYO', '040124');
INSERT INTO distrito VALUES ('354', '34', 'VITOR', '040125');
INSERT INTO distrito VALUES ('355', '34', 'YANAHUARA', '040126');
INSERT INTO distrito VALUES ('356', '34', 'YARABAMBA', '040127');
INSERT INTO distrito VALUES ('357', '34', 'YURA', '040128');
INSERT INTO distrito VALUES ('358', '34', 'JOSE LUIS BUSTAMANTE Y RIVERO', '040129');
INSERT INTO distrito VALUES ('359', '35', 'CAMANA', '040201');
INSERT INTO distrito VALUES ('360', '35', 'JOSE MARIA QUIMPER', '040202');
INSERT INTO distrito VALUES ('361', '35', 'MARIANO NICOLAS VALCARCEL', '040203');
INSERT INTO distrito VALUES ('362', '35', 'MARISCAL CACERES', '040204');
INSERT INTO distrito VALUES ('363', '35', 'NICOLAS DE PIEROLA', '040205');
INSERT INTO distrito VALUES ('364', '35', 'OCONA', '040206');
INSERT INTO distrito VALUES ('365', '35', 'QUILCA', '040207');
INSERT INTO distrito VALUES ('366', '35', 'SAMUEL PASTOR', '040208');
INSERT INTO distrito VALUES ('367', '36', 'CARAVELI', '040301');
INSERT INTO distrito VALUES ('368', '36', 'ACARI', '040302');
INSERT INTO distrito VALUES ('369', '36', 'ATICO', '040303');
INSERT INTO distrito VALUES ('370', '36', 'ATIQUIPA', '040304');
INSERT INTO distrito VALUES ('371', '36', 'BELLA UNION', '040305');
INSERT INTO distrito VALUES ('372', '36', 'CAHUACHO', '040306');
INSERT INTO distrito VALUES ('373', '36', 'CHALA', '040307');
INSERT INTO distrito VALUES ('374', '36', 'CHAPARRA', '040308');
INSERT INTO distrito VALUES ('375', '36', 'HUANUHUANU', '040309');
INSERT INTO distrito VALUES ('376', '36', 'JAQUI', '040310');
INSERT INTO distrito VALUES ('377', '36', 'LOMAS', '040311');
INSERT INTO distrito VALUES ('378', '36', 'QUICACHA', '040312');
INSERT INTO distrito VALUES ('379', '36', 'YAUCA', '040313');
INSERT INTO distrito VALUES ('380', '37', 'APLAO', '040401');
INSERT INTO distrito VALUES ('381', '37', 'ANDAGUA', '040402');
INSERT INTO distrito VALUES ('382', '37', 'AYO', '040403');
INSERT INTO distrito VALUES ('383', '37', 'CHACHAS', '040404');
INSERT INTO distrito VALUES ('384', '37', 'CHILCAYMARCA', '040405');
INSERT INTO distrito VALUES ('385', '37', 'CHOCO', '040406');
INSERT INTO distrito VALUES ('386', '37', 'HUANCARQUI', '040407');
INSERT INTO distrito VALUES ('387', '37', 'MACHAGUAY', '040408');
INSERT INTO distrito VALUES ('388', '37', 'ORCOPAMPA', '040409');
INSERT INTO distrito VALUES ('389', '37', 'PAMPACOLCA', '040410');
INSERT INTO distrito VALUES ('390', '37', 'TIPAN', '040411');
INSERT INTO distrito VALUES ('391', '37', 'UNON', '040412');
INSERT INTO distrito VALUES ('392', '37', 'URACA', '040413');
INSERT INTO distrito VALUES ('393', '37', 'VIRACO', '040414');
INSERT INTO distrito VALUES ('394', '38', 'CHIVAY', '040501');
INSERT INTO distrito VALUES ('395', '38', 'ACHOMA', '040502');
INSERT INTO distrito VALUES ('396', '38', 'CABANACONDE', '040503');
INSERT INTO distrito VALUES ('397', '38', 'CALLALLI', '040504');
INSERT INTO distrito VALUES ('398', '38', 'CAYLLOMA', '040505');
INSERT INTO distrito VALUES ('399', '38', 'COPORAQUE', '040506');
INSERT INTO distrito VALUES ('400', '38', 'HUAMBO', '040507');
INSERT INTO distrito VALUES ('401', '38', 'HUANCA', '040508');
INSERT INTO distrito VALUES ('402', '38', 'ICHUPAMPA', '040509');
INSERT INTO distrito VALUES ('403', '38', 'LARI', '040510');
INSERT INTO distrito VALUES ('404', '38', 'LLUTA', '040511');
INSERT INTO distrito VALUES ('405', '38', 'MACA', '040512');
INSERT INTO distrito VALUES ('406', '38', 'MADRIGAL', '040513');
INSERT INTO distrito VALUES ('407', '38', 'SAN ANTONIO DE CHUCA', '040514');
INSERT INTO distrito VALUES ('408', '38', 'SIBAYO', '040515');
INSERT INTO distrito VALUES ('409', '38', 'TAPAY', '040516');
INSERT INTO distrito VALUES ('410', '38', 'TISCO', '040517');
INSERT INTO distrito VALUES ('411', '38', 'TUTI', '040518');
INSERT INTO distrito VALUES ('412', '38', 'YANQUE', '040519');
INSERT INTO distrito VALUES ('413', '38', 'MAJES', '040520');
INSERT INTO distrito VALUES ('414', '39', 'CHUQUIBAMBA', '040601');
INSERT INTO distrito VALUES ('415', '39', 'ANDARAY', '040602');
INSERT INTO distrito VALUES ('416', '39', 'CAYARANI', '040603');
INSERT INTO distrito VALUES ('417', '39', 'CHICHAS', '040604');
INSERT INTO distrito VALUES ('418', '39', 'IRAY', '040605');
INSERT INTO distrito VALUES ('419', '39', 'RIO GRANDE', '040606');
INSERT INTO distrito VALUES ('420', '39', 'SALAMANCA', '040607');
INSERT INTO distrito VALUES ('421', '39', 'YANAQUIHUA', '040608');
INSERT INTO distrito VALUES ('422', '40', 'MOLLENDO', '040701');
INSERT INTO distrito VALUES ('423', '40', 'COCACHACRA', '040702');
INSERT INTO distrito VALUES ('424', '40', 'DEAN VALDIVIA', '040703');
INSERT INTO distrito VALUES ('425', '40', 'ISLAY', '040704');
INSERT INTO distrito VALUES ('426', '40', 'MEJIA', '040705');
INSERT INTO distrito VALUES ('427', '40', 'PUNTA DE BOMBON', '040706');
INSERT INTO distrito VALUES ('428', '41', 'COTAHUASI', '040801');
INSERT INTO distrito VALUES ('429', '41', 'ALCA', '040802');
INSERT INTO distrito VALUES ('430', '41', 'CHARCANA', '040803');
INSERT INTO distrito VALUES ('431', '41', 'HUAYNACOTAS', '040804');
INSERT INTO distrito VALUES ('432', '41', 'PAMPAMARCA', '040805');
INSERT INTO distrito VALUES ('433', '41', 'PUYCA', '040806');
INSERT INTO distrito VALUES ('434', '41', 'QUECHUALLA', '040807');
INSERT INTO distrito VALUES ('435', '41', 'SAYLA', '040808');
INSERT INTO distrito VALUES ('436', '41', 'TAURIA', '040809');
INSERT INTO distrito VALUES ('437', '41', 'TOMEPAMPA', '040810');
INSERT INTO distrito VALUES ('438', '41', 'TORO', '040811');
INSERT INTO distrito VALUES ('439', '42', 'AYACUCHO', '050101');
INSERT INTO distrito VALUES ('440', '42', 'ACOCRO', '050102');
INSERT INTO distrito VALUES ('441', '42', 'ACOS VINCHOS', '050103');
INSERT INTO distrito VALUES ('442', '42', 'CARMEN ALTO', '050104');
INSERT INTO distrito VALUES ('443', '42', 'CHIARA', '050105');
INSERT INTO distrito VALUES ('444', '42', 'OCROS', '050106');
INSERT INTO distrito VALUES ('445', '42', 'PACAYCASA', '050107');
INSERT INTO distrito VALUES ('446', '42', 'QUINUA', '050108');
INSERT INTO distrito VALUES ('447', '42', 'SAN JOSE DE TICLLAS', '050109');
INSERT INTO distrito VALUES ('448', '42', 'SAN JUAN BAUTISTA', '050110');
INSERT INTO distrito VALUES ('449', '42', 'SANTIAGO DE PISCHA', '050111');
INSERT INTO distrito VALUES ('450', '42', 'SOCOS', '050112');
INSERT INTO distrito VALUES ('451', '42', 'TAMBILLO', '050113');
INSERT INTO distrito VALUES ('452', '42', 'VINCHOS', '050114');
INSERT INTO distrito VALUES ('453', '42', 'JESUS NAZARENO', '050115');
INSERT INTO distrito VALUES ('454', '43', 'CANGALLO', '050201');
INSERT INTO distrito VALUES ('455', '43', 'CHUSCHI', '050202');
INSERT INTO distrito VALUES ('456', '43', 'LOS MOROCHUCOS', '050203');
INSERT INTO distrito VALUES ('457', '43', 'MARIA PARADO DE BELLIDO', '050204');
INSERT INTO distrito VALUES ('458', '43', 'PARAS', '050205');
INSERT INTO distrito VALUES ('459', '43', 'TOTOS', '050206');
INSERT INTO distrito VALUES ('460', '44', 'SANCOS', '050301');
INSERT INTO distrito VALUES ('461', '44', 'CARAPO', '050302');
INSERT INTO distrito VALUES ('462', '44', 'SACSAMARCA', '050303');
INSERT INTO distrito VALUES ('463', '44', 'SANTIAGO DE LUCANAMARCA', '050304');
INSERT INTO distrito VALUES ('464', '45', 'HUANTA', '050401');
INSERT INTO distrito VALUES ('465', '45', 'AYAHUANCO', '050402');
INSERT INTO distrito VALUES ('466', '45', 'HUAMANGUILLA', '050403');
INSERT INTO distrito VALUES ('467', '45', 'IGUAIN', '050404');
INSERT INTO distrito VALUES ('468', '45', 'LURICOCHA', '050405');
INSERT INTO distrito VALUES ('469', '45', 'SANTILLANA', '050406');
INSERT INTO distrito VALUES ('470', '45', 'SIVIA', '050407');
INSERT INTO distrito VALUES ('471', '45', 'LLOCHEGUA', '050408');
INSERT INTO distrito VALUES ('472', '46', 'SAN MIGUEL', '050501');
INSERT INTO distrito VALUES ('473', '46', 'ANCO', '050502');
INSERT INTO distrito VALUES ('474', '46', 'AYNA', '050503');
INSERT INTO distrito VALUES ('475', '46', 'CHILCAS', '050504');
INSERT INTO distrito VALUES ('476', '46', 'CHUNGUI', '050505');
INSERT INTO distrito VALUES ('477', '46', 'LUIS CARRANZA', '050506');
INSERT INTO distrito VALUES ('478', '46', 'SANTA ROSA', '050507');
INSERT INTO distrito VALUES ('479', '46', 'TAMBO', '050508');
INSERT INTO distrito VALUES ('480', '47', 'PUQUIO', '050601');
INSERT INTO distrito VALUES ('481', '47', 'AUCARA', '050602');
INSERT INTO distrito VALUES ('482', '47', 'CABANA', '050603');
INSERT INTO distrito VALUES ('483', '47', 'CARMEN SALCEDO', '050604');
INSERT INTO distrito VALUES ('484', '47', 'CHAVINA', '050605');
INSERT INTO distrito VALUES ('485', '47', 'CHIPAO', '050606');
INSERT INTO distrito VALUES ('486', '47', 'HUAC-HUAS', '050607');
INSERT INTO distrito VALUES ('487', '47', 'LARAMATE', '050608');
INSERT INTO distrito VALUES ('488', '47', 'LEONCIO PRADO', '050609');
INSERT INTO distrito VALUES ('489', '47', 'LLAUTA', '050610');
INSERT INTO distrito VALUES ('490', '47', 'LUCANAS', '050611');
INSERT INTO distrito VALUES ('491', '47', 'OCANA', '050612');
INSERT INTO distrito VALUES ('492', '47', 'OTOCA', '050613');
INSERT INTO distrito VALUES ('493', '47', 'SAISA', '050614');
INSERT INTO distrito VALUES ('494', '47', 'SAN CRISTOBAL', '050615');
INSERT INTO distrito VALUES ('495', '47', 'SAN JUAN', '050616');
INSERT INTO distrito VALUES ('496', '47', 'SAN PEDRO', '050617');
INSERT INTO distrito VALUES ('497', '47', 'SAN PEDRO DE PALCO', '050618');
INSERT INTO distrito VALUES ('498', '47', 'SANCOS', '050619');
INSERT INTO distrito VALUES ('499', '47', 'SANTA ANA DE HUAYCAHUACHO', '050620');
INSERT INTO distrito VALUES ('500', '47', 'SANTA LUCIA', '050621');
INSERT INTO distrito VALUES ('501', '48', 'CORACORA', '050701');
INSERT INTO distrito VALUES ('502', '48', 'CHUMPI', '050702');
INSERT INTO distrito VALUES ('503', '48', 'CORONEL CASTANEDA', '050703');
INSERT INTO distrito VALUES ('504', '48', 'PACAPAUSA', '050704');
INSERT INTO distrito VALUES ('505', '48', 'PULLO', '050705');
INSERT INTO distrito VALUES ('506', '48', 'PUYUSCA', '050706');
INSERT INTO distrito VALUES ('507', '48', 'SAN FRANCISCO DE RAVACAYCO', '050707');
INSERT INTO distrito VALUES ('508', '48', 'UPAHUACHO', '050708');
INSERT INTO distrito VALUES ('509', '49', 'PAUSA', '050801');
INSERT INTO distrito VALUES ('510', '49', 'COLTA', '050802');
INSERT INTO distrito VALUES ('511', '49', 'CORCULLA', '050803');
INSERT INTO distrito VALUES ('512', '49', 'LAMPA', '050804');
INSERT INTO distrito VALUES ('513', '49', 'MARCABAMBA', '050805');
INSERT INTO distrito VALUES ('514', '49', 'OYOLO', '050806');
INSERT INTO distrito VALUES ('515', '49', 'PARARCA', '050807');
INSERT INTO distrito VALUES ('516', '49', 'SAN JAVIER DE ALPABAMBA', '050808');
INSERT INTO distrito VALUES ('517', '49', 'SAN JOSE DE USHUA', '050809');
INSERT INTO distrito VALUES ('518', '49', 'SARA SARA', '050810');
INSERT INTO distrito VALUES ('519', '50', 'QUEROBAMBA', '050901');
INSERT INTO distrito VALUES ('520', '50', 'BELEN', '050902');
INSERT INTO distrito VALUES ('521', '50', 'CHALCOS', '050903');
INSERT INTO distrito VALUES ('522', '50', 'CHILCAYOC', '050904');
INSERT INTO distrito VALUES ('523', '50', 'HUACANA', '050905');
INSERT INTO distrito VALUES ('524', '50', 'MORCOLLA', '050906');
INSERT INTO distrito VALUES ('525', '50', 'PAICO', '050907');
INSERT INTO distrito VALUES ('526', '50', 'SAN PEDRO DE LARCAY', '050908');
INSERT INTO distrito VALUES ('527', '50', 'SAN SALVADOR DE QUIJE', '050909');
INSERT INTO distrito VALUES ('528', '50', 'SANTIAGO DE PAUCARAY', '050910');
INSERT INTO distrito VALUES ('529', '50', 'SORAS', '050911');
INSERT INTO distrito VALUES ('530', '51', 'HUANCAPI', '051001');
INSERT INTO distrito VALUES ('531', '51', 'ALCAMENCA', '051002');
INSERT INTO distrito VALUES ('532', '51', 'APONGO', '051003');
INSERT INTO distrito VALUES ('533', '51', 'ASQUIPATA', '051004');
INSERT INTO distrito VALUES ('534', '51', 'CANARIA', '051005');
INSERT INTO distrito VALUES ('535', '51', 'CAYARA', '051006');
INSERT INTO distrito VALUES ('536', '51', 'COLCA', '051007');
INSERT INTO distrito VALUES ('537', '51', 'HUAMANQUIQUIA', '051008');
INSERT INTO distrito VALUES ('538', '51', 'HUANCARAYLLA', '051009');
INSERT INTO distrito VALUES ('539', '51', 'HUAYA', '051010');
INSERT INTO distrito VALUES ('540', '51', 'SARHUA', '051011');
INSERT INTO distrito VALUES ('541', '51', 'VILCANCHOS', '051012');
INSERT INTO distrito VALUES ('542', '52', 'VILCAS HUAMAN', '051101');
INSERT INTO distrito VALUES ('543', '52', 'ACCOMARCA', '051102');
INSERT INTO distrito VALUES ('544', '52', 'CARHUANCA', '051103');
INSERT INTO distrito VALUES ('545', '52', 'CONCEPCION', '051104');
INSERT INTO distrito VALUES ('546', '52', 'HUAMBALPA', '051105');
INSERT INTO distrito VALUES ('547', '52', 'INDEPENDENCIA', '051106');
INSERT INTO distrito VALUES ('548', '52', 'SAURAMA', '051107');
INSERT INTO distrito VALUES ('549', '52', 'VISCHONGO', '051108');
INSERT INTO distrito VALUES ('550', '53', 'CAJAMARCA', '060101');
INSERT INTO distrito VALUES ('551', '53', 'ASUNCION', '060102');
INSERT INTO distrito VALUES ('552', '53', 'CHETILLA', '060103');
INSERT INTO distrito VALUES ('553', '53', 'COSPAN', '060104');
INSERT INTO distrito VALUES ('554', '53', 'ENCANADA', '060105');
INSERT INTO distrito VALUES ('555', '53', 'JESUS', '060106');
INSERT INTO distrito VALUES ('556', '53', 'LLACANORA', '060107');
INSERT INTO distrito VALUES ('557', '53', 'LOS BANOS DEL INCA', '060108');
INSERT INTO distrito VALUES ('558', '53', 'MAGDALENA', '060109');
INSERT INTO distrito VALUES ('559', '53', 'MATARA', '060110');
INSERT INTO distrito VALUES ('560', '53', 'NAMORA', '060111');
INSERT INTO distrito VALUES ('561', '53', 'SAN JUAN', '060112');
INSERT INTO distrito VALUES ('562', '54', 'CAJABAMBA', '060201');
INSERT INTO distrito VALUES ('563', '54', 'CACHACHI', '060202');
INSERT INTO distrito VALUES ('564', '54', 'CONDEBAMBA', '060203');
INSERT INTO distrito VALUES ('565', '54', 'SITACOCHA', '060204');
INSERT INTO distrito VALUES ('566', '55', 'CELENDIN', '060301');
INSERT INTO distrito VALUES ('567', '55', 'CHUMUCH', '060302');
INSERT INTO distrito VALUES ('568', '55', 'CORTEGANA', '060303');
INSERT INTO distrito VALUES ('569', '55', 'HUASMIN', '060304');
INSERT INTO distrito VALUES ('570', '55', 'JORGE CHAVEZ', '060305');
INSERT INTO distrito VALUES ('571', '55', 'JOSE GALVEZ', '060306');
INSERT INTO distrito VALUES ('572', '55', 'MIGUEL IGLESIAS', '060307');
INSERT INTO distrito VALUES ('573', '55', 'OXAMARCA', '060308');
INSERT INTO distrito VALUES ('574', '55', 'SOROCHUCO', '060309');
INSERT INTO distrito VALUES ('575', '55', 'SUCRE', '060310');
INSERT INTO distrito VALUES ('576', '55', 'UTCO', '060311');
INSERT INTO distrito VALUES ('577', '55', 'LA LIBERTAD DE PALLAN', '060312');
INSERT INTO distrito VALUES ('578', '56', 'CHOTA', '060401');
INSERT INTO distrito VALUES ('579', '56', 'ANGUIA', '060402');
INSERT INTO distrito VALUES ('580', '56', 'CHADIN', '060403');
INSERT INTO distrito VALUES ('581', '56', 'CHIGUIRIP', '060404');
INSERT INTO distrito VALUES ('582', '56', 'CHIMBAN', '060405');
INSERT INTO distrito VALUES ('583', '56', 'CHOROPAMPA', '060406');
INSERT INTO distrito VALUES ('584', '56', 'COCHABAMBA', '060407');
INSERT INTO distrito VALUES ('585', '56', 'CONCHAN', '060408');
INSERT INTO distrito VALUES ('586', '56', 'HUAMBOS', '060409');
INSERT INTO distrito VALUES ('587', '56', 'LAJAS', '060410');
INSERT INTO distrito VALUES ('588', '56', 'LLAMA', '060411');
INSERT INTO distrito VALUES ('589', '56', 'MIRACOSTA', '060412');
INSERT INTO distrito VALUES ('590', '56', 'PACCHA', '060413');
INSERT INTO distrito VALUES ('591', '56', 'PION', '060414');
INSERT INTO distrito VALUES ('592', '56', 'QUEROCOTO', '060415');
INSERT INTO distrito VALUES ('593', '56', 'SAN JUAN DE LICUPIS', '060416');
INSERT INTO distrito VALUES ('594', '56', 'TACABAMBA', '060417');
INSERT INTO distrito VALUES ('595', '56', 'TOCMOCHE', '060418');
INSERT INTO distrito VALUES ('596', '56', 'CHALAMARCA', '060419');
INSERT INTO distrito VALUES ('597', '57', 'CONTUMAZA', '060501');
INSERT INTO distrito VALUES ('598', '57', 'CHILETE', '060502');
INSERT INTO distrito VALUES ('599', '57', 'CUPISNIQUE', '060503');
INSERT INTO distrito VALUES ('600', '57', 'GUZMANGO', '060504');
INSERT INTO distrito VALUES ('601', '57', 'SAN BENITO', '060505');
INSERT INTO distrito VALUES ('602', '57', 'SANTA CRUZ DE TOLED', '060506');
INSERT INTO distrito VALUES ('603', '57', 'TANTARICA', '060507');
INSERT INTO distrito VALUES ('604', '57', 'YONAN', '060508');
INSERT INTO distrito VALUES ('605', '58', 'CUTERVO', '060601');
INSERT INTO distrito VALUES ('606', '58', 'CALLAYUC', '060602');
INSERT INTO distrito VALUES ('607', '58', 'CHOROS', '060603');
INSERT INTO distrito VALUES ('608', '58', 'CUJILLO', '060604');
INSERT INTO distrito VALUES ('609', '58', 'LA RAMADA', '060605');
INSERT INTO distrito VALUES ('610', '58', 'PIMPINGOS', '060606');
INSERT INTO distrito VALUES ('611', '58', 'QUEROCOTILLO', '060607');
INSERT INTO distrito VALUES ('612', '58', 'SAN ANDRES DE CUTERVO', '060608');
INSERT INTO distrito VALUES ('613', '58', 'SAN JUAN DE CUTERVO', '060609');
INSERT INTO distrito VALUES ('614', '58', 'SAN LUIS DE LUCMA', '060610');
INSERT INTO distrito VALUES ('615', '58', 'SANTA CRUZ', '060611');
INSERT INTO distrito VALUES ('616', '58', 'SANTO DOMINGO DE LA CAPILLA', '060612');
INSERT INTO distrito VALUES ('617', '58', 'SANTO TOMAS', '060613');
INSERT INTO distrito VALUES ('618', '58', 'SOCOTA', '060614');
INSERT INTO distrito VALUES ('619', '58', 'TORIBIO CASANOVA', '060615');
INSERT INTO distrito VALUES ('620', '59', 'BAMBAMARCA', '060701');
INSERT INTO distrito VALUES ('621', '59', 'CHUGUR', '060702');
INSERT INTO distrito VALUES ('622', '59', 'HUALGAYOC', '060703');
INSERT INTO distrito VALUES ('623', '60', 'JAEN', '060801');
INSERT INTO distrito VALUES ('624', '60', 'BELLAVISTA', '060802');
INSERT INTO distrito VALUES ('625', '60', 'CHONTALI', '060803');
INSERT INTO distrito VALUES ('626', '60', 'COLASAY', '060804');
INSERT INTO distrito VALUES ('627', '60', 'HUABAL', '060805');
INSERT INTO distrito VALUES ('628', '60', 'LAS PIRIAS', '060806');
INSERT INTO distrito VALUES ('629', '60', 'POMAHUACA', '060807');
INSERT INTO distrito VALUES ('630', '60', 'PUCARA', '060808');
INSERT INTO distrito VALUES ('631', '60', 'SALLIQUE', '060809');
INSERT INTO distrito VALUES ('632', '60', 'SAN FELIPE', '060810');
INSERT INTO distrito VALUES ('633', '60', 'SAN JOSE DEL ALTO', '060811');
INSERT INTO distrito VALUES ('634', '60', 'SANTA ROSA', '060812');
INSERT INTO distrito VALUES ('635', '61', 'SAN IGNACIO', '060901');
INSERT INTO distrito VALUES ('636', '61', 'CHIRINOS', '060902');
INSERT INTO distrito VALUES ('637', '61', 'HUARANGO', '060903');
INSERT INTO distrito VALUES ('638', '61', 'LA COIPA', '060904');
INSERT INTO distrito VALUES ('639', '61', 'NAMBALLE', '060905');
INSERT INTO distrito VALUES ('640', '61', 'SAN JOSE DE LOURDES', '060906');
INSERT INTO distrito VALUES ('641', '61', 'TABACONAS', '060907');
INSERT INTO distrito VALUES ('642', '62', 'PEDRO GALVEZ', '061001');
INSERT INTO distrito VALUES ('643', '62', 'CHANCAY', '061002');
INSERT INTO distrito VALUES ('644', '62', 'EDUARDO VILLANUEVA', '061003');
INSERT INTO distrito VALUES ('645', '62', 'GREGORIO PITA', '061004');
INSERT INTO distrito VALUES ('646', '62', 'ICHOCAN', '061005');
INSERT INTO distrito VALUES ('647', '62', 'JOSE MANUEL QUIROZ', '061006');
INSERT INTO distrito VALUES ('648', '62', 'JOSE SABOGAL', '061007');
INSERT INTO distrito VALUES ('649', '63', 'SAN MIGUEL', '061101');
INSERT INTO distrito VALUES ('650', '63', 'BOLIVAR', '061102');
INSERT INTO distrito VALUES ('651', '63', 'CALQUIS', '061103');
INSERT INTO distrito VALUES ('652', '63', 'CATILLUC', '061104');
INSERT INTO distrito VALUES ('653', '63', 'EL PRADO', '061105');
INSERT INTO distrito VALUES ('654', '63', 'LA FLORIDA', '061106');
INSERT INTO distrito VALUES ('655', '63', 'LLAPA', '061107');
INSERT INTO distrito VALUES ('656', '63', 'NANCHOC', '061108');
INSERT INTO distrito VALUES ('657', '63', 'NIEPOS', '061109');
INSERT INTO distrito VALUES ('658', '63', 'SAN GREGORIO', '061110');
INSERT INTO distrito VALUES ('659', '63', 'SAN SILVESTRE DE COCHAN', '061111');
INSERT INTO distrito VALUES ('660', '63', 'TONGOD', '061112');
INSERT INTO distrito VALUES ('661', '63', 'UNION AGUA BLANCA', '061113');
INSERT INTO distrito VALUES ('662', '64', 'SAN PABLO', '061201');
INSERT INTO distrito VALUES ('663', '64', 'SAN BERNARDINO', '061202');
INSERT INTO distrito VALUES ('664', '64', 'SAN LUIS', '061203');
INSERT INTO distrito VALUES ('665', '64', 'TUMBADEN', '061204');
INSERT INTO distrito VALUES ('666', '65', 'SANTA CRUZ', '061301');
INSERT INTO distrito VALUES ('667', '65', 'ANDABAMBA', '061302');
INSERT INTO distrito VALUES ('668', '65', 'CATACHE', '061303');
INSERT INTO distrito VALUES ('669', '65', 'CHANCAYBANOS', '061304');
INSERT INTO distrito VALUES ('670', '65', 'LA ESPERANZA', '061305');
INSERT INTO distrito VALUES ('671', '65', 'NINABAMBA', '061306');
INSERT INTO distrito VALUES ('672', '65', 'PULAN', '061307');
INSERT INTO distrito VALUES ('673', '65', 'SAUCEPAMPA', '061308');
INSERT INTO distrito VALUES ('674', '65', 'SEXI', '061309');
INSERT INTO distrito VALUES ('675', '65', 'UTICYACU', '061310');
INSERT INTO distrito VALUES ('676', '65', 'YAUYUCAN', '061311');
INSERT INTO distrito VALUES ('677', '66', 'CALLAO', '070101');
INSERT INTO distrito VALUES ('678', '66', 'BELLAVISTA', '070102');
INSERT INTO distrito VALUES ('679', '66', 'CARMEN DE LA LEGUA REYNOSO', '070103');
INSERT INTO distrito VALUES ('680', '66', 'LA PERLA', '070104');
INSERT INTO distrito VALUES ('681', '66', 'LA PUNTA', '070105');
INSERT INTO distrito VALUES ('682', '66', 'VENTANILLA', '070106');
INSERT INTO distrito VALUES ('683', '67', 'CUSCO', '080101');
INSERT INTO distrito VALUES ('684', '67', 'CCORCA', '080102');
INSERT INTO distrito VALUES ('685', '67', 'POROY', '080103');
INSERT INTO distrito VALUES ('686', '67', 'SAN JERONIMO', '080104');
INSERT INTO distrito VALUES ('687', '67', 'SAN SEBASTIAN', '080105');
INSERT INTO distrito VALUES ('688', '67', 'SANTIAGO', '080106');
INSERT INTO distrito VALUES ('689', '67', 'SAYLLA', '080107');
INSERT INTO distrito VALUES ('690', '67', 'WANCHAQ', '080108');
INSERT INTO distrito VALUES ('691', '68', 'ACOMAYO', '080201');
INSERT INTO distrito VALUES ('692', '68', 'ACOPIA', '080202');
INSERT INTO distrito VALUES ('693', '68', 'ACOS', '080203');
INSERT INTO distrito VALUES ('694', '68', 'MOSOC LLACTA', '080204');
INSERT INTO distrito VALUES ('695', '68', 'POMACANCHI', '080205');
INSERT INTO distrito VALUES ('696', '68', 'RONDOCAN', '080206');
INSERT INTO distrito VALUES ('697', '68', 'SANGARARA', '080207');
INSERT INTO distrito VALUES ('698', '69', 'ANTA', '080301');
INSERT INTO distrito VALUES ('699', '69', 'ANCAHUASI', '080302');
INSERT INTO distrito VALUES ('700', '69', 'CACHIMAYO', '080303');
INSERT INTO distrito VALUES ('701', '69', 'CHINCHAYPUJIO', '080304');
INSERT INTO distrito VALUES ('702', '69', 'HUAROCONDO', '080305');
INSERT INTO distrito VALUES ('703', '69', 'LIMATAMBO', '080306');
INSERT INTO distrito VALUES ('704', '69', 'MOLLEPATA', '080307');
INSERT INTO distrito VALUES ('705', '69', 'PUCYURA', '080308');
INSERT INTO distrito VALUES ('706', '70', 'CALCA', '080401');
INSERT INTO distrito VALUES ('707', '70', 'COYA', '080402');
INSERT INTO distrito VALUES ('708', '70', 'LAMAY', '080403');
INSERT INTO distrito VALUES ('709', '70', 'LARES', '080404');
INSERT INTO distrito VALUES ('710', '70', 'PISAC', '080405');
INSERT INTO distrito VALUES ('711', '70', 'SAN SALVADOR', '080406');
INSERT INTO distrito VALUES ('712', '70', 'TARAY', '080407');
INSERT INTO distrito VALUES ('713', '70', 'YANATILE', '080408');
INSERT INTO distrito VALUES ('714', '71', 'YANAOCA', '080501');
INSERT INTO distrito VALUES ('715', '71', 'CHECCA', '080502');
INSERT INTO distrito VALUES ('716', '71', 'KUNTURKANKI', '080503');
INSERT INTO distrito VALUES ('717', '71', 'LANGUI', '080504');
INSERT INTO distrito VALUES ('718', '71', 'LAYO', '080505');
INSERT INTO distrito VALUES ('719', '71', 'PAMPAMARCA', '080506');
INSERT INTO distrito VALUES ('720', '71', 'QUEHUE', '080507');
INSERT INTO distrito VALUES ('721', '71', 'TUPAC AMARU', '080508');
INSERT INTO distrito VALUES ('722', '72', 'SICUANI', '080601');
INSERT INTO distrito VALUES ('723', '72', 'CHECACUPE', '080602');
INSERT INTO distrito VALUES ('724', '72', 'COMBAPATA', '080603');
INSERT INTO distrito VALUES ('725', '72', 'MARANGANI', '080604');
INSERT INTO distrito VALUES ('726', '72', 'PITUMARCA', '080605');
INSERT INTO distrito VALUES ('727', '72', 'SAN PABLO', '080606');
INSERT INTO distrito VALUES ('728', '72', 'SAN PEDRO', '080607');
INSERT INTO distrito VALUES ('729', '72', 'TINTA', '080608');
INSERT INTO distrito VALUES ('730', '73', 'SANTO TOMAS', '080701');
INSERT INTO distrito VALUES ('731', '73', 'CAPACMARCA', '080702');
INSERT INTO distrito VALUES ('732', '73', 'CHAMACA', '080703');
INSERT INTO distrito VALUES ('733', '73', 'COLQUEMARCA', '080704');
INSERT INTO distrito VALUES ('734', '73', 'LIVITACA', '080705');
INSERT INTO distrito VALUES ('735', '73', 'LLUSCO', '080706');
INSERT INTO distrito VALUES ('736', '73', 'QUINOTA', '080707');
INSERT INTO distrito VALUES ('737', '73', 'VELILLE', '080708');
INSERT INTO distrito VALUES ('738', '74', 'ESPINAR', '080801');
INSERT INTO distrito VALUES ('739', '74', 'CONDOROMA', '080802');
INSERT INTO distrito VALUES ('740', '74', 'COPORAQUE', '080803');
INSERT INTO distrito VALUES ('741', '74', 'OCORURO', '080804');
INSERT INTO distrito VALUES ('742', '74', 'PALLPATA', '080805');
INSERT INTO distrito VALUES ('743', '74', 'PICHIGUA', '080806');
INSERT INTO distrito VALUES ('744', '74', 'SUYCKUTAMBO', '080807');
INSERT INTO distrito VALUES ('745', '74', 'ALTO PICHIGUA', '080808');
INSERT INTO distrito VALUES ('746', '75', 'SANTA ANA', '080901');
INSERT INTO distrito VALUES ('747', '75', 'ECHARATE', '080902');
INSERT INTO distrito VALUES ('748', '75', 'HUAYOPATA', '080903');
INSERT INTO distrito VALUES ('749', '75', 'MARANURA', '080904');
INSERT INTO distrito VALUES ('750', '75', 'OCOBAMBA', '080905');
INSERT INTO distrito VALUES ('751', '75', 'QUELLOUNO', '080906');
INSERT INTO distrito VALUES ('752', '75', 'KIMBIRI', '080907');
INSERT INTO distrito VALUES ('753', '75', 'SANTA TERESA', '080908');
INSERT INTO distrito VALUES ('754', '75', 'VILCABAMBA', '080909');
INSERT INTO distrito VALUES ('755', '75', 'PICHARI', '080910');
INSERT INTO distrito VALUES ('756', '76', 'PARURO', '081001');
INSERT INTO distrito VALUES ('757', '76', 'ACCHA', '081002');
INSERT INTO distrito VALUES ('758', '76', 'CCAPI', '081003');
INSERT INTO distrito VALUES ('759', '76', 'COLCHA', '081004');
INSERT INTO distrito VALUES ('760', '76', 'HUANOQUITE', '081005');
INSERT INTO distrito VALUES ('761', '76', 'OMACHA', '081006');
INSERT INTO distrito VALUES ('762', '76', 'PACCARITAMBO', '081007');
INSERT INTO distrito VALUES ('763', '76', 'PILLPINTO', '081008');
INSERT INTO distrito VALUES ('764', '76', 'YAURISQUE', '081009');
INSERT INTO distrito VALUES ('765', '77', 'PAUCARTAMBO', '081101');
INSERT INTO distrito VALUES ('766', '77', 'CAICAY', '081102');
INSERT INTO distrito VALUES ('767', '77', 'CHALLABAMBA', '081103');
INSERT INTO distrito VALUES ('768', '77', 'COLQUEPATA', '081104');
INSERT INTO distrito VALUES ('769', '77', 'HUANCARANI', '081105');
INSERT INTO distrito VALUES ('770', '77', 'KOSNIPATA', '081106');
INSERT INTO distrito VALUES ('771', '78', 'URCOS', '081201');
INSERT INTO distrito VALUES ('772', '78', 'ANDAHUAYLILLAS', '081202');
INSERT INTO distrito VALUES ('773', '78', 'CAMANTI', '081203');
INSERT INTO distrito VALUES ('774', '78', 'CCARHUAYO', '081204');
INSERT INTO distrito VALUES ('775', '78', 'CCATCA', '081205');
INSERT INTO distrito VALUES ('776', '78', 'CUSIPATA', '081206');
INSERT INTO distrito VALUES ('777', '78', 'HUARO', '081207');
INSERT INTO distrito VALUES ('778', '78', 'LUCRE', '081208');
INSERT INTO distrito VALUES ('779', '78', 'MARCAPATA', '081209');
INSERT INTO distrito VALUES ('780', '78', 'OCONGATE', '081210');
INSERT INTO distrito VALUES ('781', '78', 'OROPESA', '081211');
INSERT INTO distrito VALUES ('782', '78', 'QUIQUIJANA', '081212');
INSERT INTO distrito VALUES ('783', '79', 'URUBAMBA', '081301');
INSERT INTO distrito VALUES ('784', '79', 'CHINCHERO', '081302');
INSERT INTO distrito VALUES ('785', '79', 'HUAYLLABAMBA', '081303');
INSERT INTO distrito VALUES ('786', '79', 'MACHUPICCHU', '081304');
INSERT INTO distrito VALUES ('787', '79', 'MARAS', '081305');
INSERT INTO distrito VALUES ('788', '79', 'OLLANTAYTAMBO', '081306');
INSERT INTO distrito VALUES ('789', '79', 'YUCAY', '081307');
INSERT INTO distrito VALUES ('790', '80', 'HUANCAVELICA', '090101');
INSERT INTO distrito VALUES ('791', '80', 'ACOBAMBILLA', '090102');
INSERT INTO distrito VALUES ('792', '80', 'ACORIA', '090103');
INSERT INTO distrito VALUES ('793', '80', 'CONAYCA', '090104');
INSERT INTO distrito VALUES ('794', '80', 'CUENCA', '090105');
INSERT INTO distrito VALUES ('795', '80', 'HUACHOCOLPA', '090106');
INSERT INTO distrito VALUES ('796', '80', 'HUAYLLAHUARA', '090107');
INSERT INTO distrito VALUES ('797', '80', 'IZCUCHACA', '090108');
INSERT INTO distrito VALUES ('798', '80', 'LARIA', '090109');
INSERT INTO distrito VALUES ('799', '80', 'MANTA', '090110');
INSERT INTO distrito VALUES ('800', '80', 'MARISCAL CACERES', '090111');
INSERT INTO distrito VALUES ('801', '80', 'MOYA', '090112');
INSERT INTO distrito VALUES ('802', '80', 'NUEVO OCCORO', '090113');
INSERT INTO distrito VALUES ('803', '80', 'PALCA', '090114');
INSERT INTO distrito VALUES ('804', '80', 'PILCHACA', '090115');
INSERT INTO distrito VALUES ('805', '80', 'VILCA', '090116');
INSERT INTO distrito VALUES ('806', '80', 'YAULI', '090117');
INSERT INTO distrito VALUES ('807', '80', 'ASCENSION', '090118');
INSERT INTO distrito VALUES ('808', '80', 'HUANDO', '090119');
INSERT INTO distrito VALUES ('809', '81', 'ACOBAMBA', '090201');
INSERT INTO distrito VALUES ('810', '81', 'ANDABAMBA', '090202');
INSERT INTO distrito VALUES ('811', '81', 'ANTA', '090203');
INSERT INTO distrito VALUES ('812', '81', 'CAJA', '090204');
INSERT INTO distrito VALUES ('813', '81', 'MARCAS', '090205');
INSERT INTO distrito VALUES ('814', '81', 'PAUCARA', '090206');
INSERT INTO distrito VALUES ('815', '81', 'POMACOCHA', '090207');
INSERT INTO distrito VALUES ('816', '81', 'ROSARIO', '090208');
INSERT INTO distrito VALUES ('817', '82', 'LIRCAY', '090301');
INSERT INTO distrito VALUES ('818', '82', 'ANCHONGA', '090302');
INSERT INTO distrito VALUES ('819', '82', 'CALLANMARCA', '090303');
INSERT INTO distrito VALUES ('820', '82', 'CCOCHACCASA', '090304');
INSERT INTO distrito VALUES ('821', '82', 'CHINCHO', '090305');
INSERT INTO distrito VALUES ('822', '82', 'CONGALLA', '090306');
INSERT INTO distrito VALUES ('823', '82', 'HUANCA-HUANCA', '090307');
INSERT INTO distrito VALUES ('824', '82', 'HUAYLLAY GRANDE', '090308');
INSERT INTO distrito VALUES ('825', '82', 'JULCAMARCA', '090309');
INSERT INTO distrito VALUES ('826', '82', 'SAN ANTONIO DE ANTAPARCO', '090310');
INSERT INTO distrito VALUES ('827', '82', 'SANTO TOMAS DE PATA', '090311');
INSERT INTO distrito VALUES ('828', '82', 'SECCLLA', '090312');
INSERT INTO distrito VALUES ('829', '83', 'CASTROVIRREYNA', '090401');
INSERT INTO distrito VALUES ('830', '83', 'ARMA', '090402');
INSERT INTO distrito VALUES ('831', '83', 'AURAHUA', '090403');
INSERT INTO distrito VALUES ('832', '83', 'CAPILLAS', '090404');
INSERT INTO distrito VALUES ('833', '83', 'CHUPAMARCA', '090405');
INSERT INTO distrito VALUES ('834', '83', 'COCAS', '090406');
INSERT INTO distrito VALUES ('835', '83', 'HUACHOS', '090407');
INSERT INTO distrito VALUES ('836', '83', 'HUAMATAMBO', '090408');
INSERT INTO distrito VALUES ('837', '83', 'MOLLEPAMPA', '090409');
INSERT INTO distrito VALUES ('838', '83', 'SAN JUAN', '090410');
INSERT INTO distrito VALUES ('839', '83', 'SANTA ANA', '090411');
INSERT INTO distrito VALUES ('840', '83', 'TANTARA', '090412');
INSERT INTO distrito VALUES ('841', '83', 'TICRAPO', '090413');
INSERT INTO distrito VALUES ('842', '84', 'CHURCAMPA', '090501');
INSERT INTO distrito VALUES ('843', '84', 'ANCO', '090502');
INSERT INTO distrito VALUES ('844', '84', 'CHINCHIHUASI', '090503');
INSERT INTO distrito VALUES ('845', '84', 'EL CARMEN', '090504');
INSERT INTO distrito VALUES ('846', '84', 'LA MERCED', '090505');
INSERT INTO distrito VALUES ('847', '84', 'LOCROJA', '090506');
INSERT INTO distrito VALUES ('848', '84', 'PAUCARBAMABA', '090507');
INSERT INTO distrito VALUES ('849', '84', 'SAN MIGUEL DE MAYOCC', '090508');
INSERT INTO distrito VALUES ('850', '84', 'SAN PEDRO DE CORIS', '090509');
INSERT INTO distrito VALUES ('851', '84', 'PACHAMARCA', '090510');
INSERT INTO distrito VALUES ('852', '85', 'HUAYTARA', '090601');
INSERT INTO distrito VALUES ('853', '85', 'AYAVI', '090602');
INSERT INTO distrito VALUES ('854', '85', 'CORDOVA', '090603');
INSERT INTO distrito VALUES ('855', '85', 'HUAYACUNDO ARMA', '090604');
INSERT INTO distrito VALUES ('856', '85', 'LARAMARCA', '090605');
INSERT INTO distrito VALUES ('857', '85', 'OCOYO', '090606');
INSERT INTO distrito VALUES ('858', '85', 'PILPICHACA', '090607');
INSERT INTO distrito VALUES ('859', '85', 'QUERCO', '090608');
INSERT INTO distrito VALUES ('860', '85', 'QUITO-ARMA', '090609');
INSERT INTO distrito VALUES ('861', '85', 'SAN ANTONIO DE CUSICANCHA', '090610');
INSERT INTO distrito VALUES ('862', '85', 'SAN FRANCISCO DE SANGAYAICO', '090611');
INSERT INTO distrito VALUES ('863', '85', 'SAN ISIDRO', '090612');
INSERT INTO distrito VALUES ('864', '85', 'SANTIAGO DE CHOCORVOS', '090613');
INSERT INTO distrito VALUES ('865', '85', 'SANTIAGO DE QUIRAHUARA', '090614');
INSERT INTO distrito VALUES ('866', '85', 'SANTO DOMINGO DE CAPILLAS', '090615');
INSERT INTO distrito VALUES ('867', '85', 'TAMBO', '090616');
INSERT INTO distrito VALUES ('868', '86', 'PAMPAS', '090701');
INSERT INTO distrito VALUES ('869', '86', 'ACOSTAMBO', '090702');
INSERT INTO distrito VALUES ('870', '86', 'ACRAQUIA', '090703');
INSERT INTO distrito VALUES ('871', '86', 'AHUAYCHA', '090704');
INSERT INTO distrito VALUES ('872', '86', 'COLCABAMBA', '090705');
INSERT INTO distrito VALUES ('873', '86', 'DANIEL HERNANDEZ', '090706');
INSERT INTO distrito VALUES ('874', '86', 'HUACHOCOLPA', '090707');
INSERT INTO distrito VALUES ('875', '86', 'HUARIBAMBA', '090709');
INSERT INTO distrito VALUES ('876', '86', 'NAHUIMPUQUIO', '090710');
INSERT INTO distrito VALUES ('877', '86', 'PAZOS', '090711');
INSERT INTO distrito VALUES ('878', '86', 'QUISHUAR', '090713');
INSERT INTO distrito VALUES ('879', '86', 'SALCABAMBA', '090714');
INSERT INTO distrito VALUES ('880', '86', 'SALCAHUASI', '090715');
INSERT INTO distrito VALUES ('881', '86', 'SAN MARCOS DE ROCCHAC', '090716');
INSERT INTO distrito VALUES ('882', '86', 'SURCUBAMBA', '090717');
INSERT INTO distrito VALUES ('883', '86', 'TINTAY PUNCU', '090718');
INSERT INTO distrito VALUES ('884', '87', 'HUANUCO', '100101');
INSERT INTO distrito VALUES ('885', '87', 'AMARILIS', '100102');
INSERT INTO distrito VALUES ('886', '87', 'CHINCHAO', '100103');
INSERT INTO distrito VALUES ('887', '87', 'CHURUBAMBA', '100104');
INSERT INTO distrito VALUES ('888', '87', 'MARGOS', '100105');
INSERT INTO distrito VALUES ('889', '87', 'QUISQUI (KICHKI)', '100106');
INSERT INTO distrito VALUES ('890', '87', 'SAN FRANCISCO DE CAYRAN', '100107');
INSERT INTO distrito VALUES ('891', '87', 'SAN PEDRO DE CHAULAN', '100108');
INSERT INTO distrito VALUES ('892', '87', 'SANTA MARIA DEL VALLE', '100109');
INSERT INTO distrito VALUES ('893', '87', 'YARUMAYO', '100110');
INSERT INTO distrito VALUES ('894', '87', 'PILLCO MARCA', '100111');
INSERT INTO distrito VALUES ('895', '88', 'AMBO', '100201');
INSERT INTO distrito VALUES ('896', '88', 'CAYNA', '100202');
INSERT INTO distrito VALUES ('897', '88', 'COLPAS', '100203');
INSERT INTO distrito VALUES ('898', '88', 'CONCHAMARCA', '100204');
INSERT INTO distrito VALUES ('899', '88', 'HUACAR', '100205');
INSERT INTO distrito VALUES ('900', '88', 'SAN FRANCISCO', '100206');
INSERT INTO distrito VALUES ('901', '88', 'SAN RAFAEL', '100207');
INSERT INTO distrito VALUES ('902', '88', 'TOMAY KICHWA', '100208');
INSERT INTO distrito VALUES ('903', '89', 'LA UNION', '100301');
INSERT INTO distrito VALUES ('904', '89', 'CHUQUIS', '100307');
INSERT INTO distrito VALUES ('905', '89', 'MARIAS', '100311');
INSERT INTO distrito VALUES ('906', '89', 'PACHAS', '100313');
INSERT INTO distrito VALUES ('907', '89', 'QUIVILLA', '100316');
INSERT INTO distrito VALUES ('908', '89', 'RIPAN', '100317');
INSERT INTO distrito VALUES ('909', '89', 'SHUNQUI', '100321');
INSERT INTO distrito VALUES ('910', '89', 'SILLAPATA', '100322');
INSERT INTO distrito VALUES ('911', '89', 'YANAS', '100323');
INSERT INTO distrito VALUES ('912', '90', 'HUACAYBAMBA', '100401');
INSERT INTO distrito VALUES ('913', '90', 'CANCHABAMBA', '100402');
INSERT INTO distrito VALUES ('914', '90', 'COCHABAMBA', '100403');
INSERT INTO distrito VALUES ('915', '90', 'PINRA', '100404');
INSERT INTO distrito VALUES ('916', '91', 'LLATA', '100501');
INSERT INTO distrito VALUES ('917', '91', 'ARANCAY', '100502');
INSERT INTO distrito VALUES ('918', '91', 'CHAVIN DE PARIARCA', '100503');
INSERT INTO distrito VALUES ('919', '91', 'JACAS GRANDE', '100504');
INSERT INTO distrito VALUES ('920', '91', 'JIRCAN', '100505');
INSERT INTO distrito VALUES ('921', '91', 'MIRAFLORES', '100506');
INSERT INTO distrito VALUES ('922', '91', 'MONZON', '100507');
INSERT INTO distrito VALUES ('923', '91', 'PUNCHAO', '100508');
INSERT INTO distrito VALUES ('924', '91', 'PUNOS', '100509');
INSERT INTO distrito VALUES ('925', '91', 'SINGA', '100510');
INSERT INTO distrito VALUES ('926', '91', 'TANTAMAYO', '100511');
INSERT INTO distrito VALUES ('927', '92', 'RUPA-RUPA', '100601');
INSERT INTO distrito VALUES ('928', '92', 'DANIEL ALOMIA ROBLES', '100602');
INSERT INTO distrito VALUES ('929', '92', 'HERMILIO VALDIZAN', '100603');
INSERT INTO distrito VALUES ('930', '92', 'JOSE CRESPO Y CASTILLO', '100604');
INSERT INTO distrito VALUES ('931', '92', 'LUYANDO', '100605');
INSERT INTO distrito VALUES ('932', '92', 'MARIANO DAMASO BERAUN', '100606');
INSERT INTO distrito VALUES ('933', '93', 'HUACRACHUCO', '100701');
INSERT INTO distrito VALUES ('934', '93', 'CHOLON', '100702');
INSERT INTO distrito VALUES ('935', '93', 'SAN BUENAVENTURA', '100703');
INSERT INTO distrito VALUES ('936', '94', 'PANAO', '100801');
INSERT INTO distrito VALUES ('937', '94', 'CHAGLLA', '100802');
INSERT INTO distrito VALUES ('938', '94', 'MOLINO', '100803');
INSERT INTO distrito VALUES ('939', '94', 'UMARI', '100804');
INSERT INTO distrito VALUES ('940', '95', 'PUERTO INCA', '100901');
INSERT INTO distrito VALUES ('941', '95', 'CODO DEL POZUZO', '100902');
INSERT INTO distrito VALUES ('942', '95', 'HONORIA', '100903');
INSERT INTO distrito VALUES ('943', '95', 'TOURNAVISTA', '100904');
INSERT INTO distrito VALUES ('944', '95', 'YUYAPICHIS', '100905');
INSERT INTO distrito VALUES ('945', '96', 'JESUS', '101001');
INSERT INTO distrito VALUES ('946', '96', 'BANOS', '101002');
INSERT INTO distrito VALUES ('947', '96', 'JIVIA', '101003');
INSERT INTO distrito VALUES ('948', '96', 'QUEROPALCA', '101004');
INSERT INTO distrito VALUES ('949', '96', 'RONDOS', '101005');
INSERT INTO distrito VALUES ('950', '96', 'SAN FRANCISCO DE ASIS', '101006');
INSERT INTO distrito VALUES ('951', '96', 'SAN MIGUEL DE CAURI', '101007');
INSERT INTO distrito VALUES ('952', '97', 'CHAVINILLO', '101101');
INSERT INTO distrito VALUES ('953', '97', 'CAHUAC', '101102');
INSERT INTO distrito VALUES ('954', '97', 'CHACABAMBA', '101103');
INSERT INTO distrito VALUES ('955', '97', 'APARICIO POMARES', '101104');
INSERT INTO distrito VALUES ('956', '97', 'JACAS CHICO', '101105');
INSERT INTO distrito VALUES ('957', '97', 'OBAS', '101106');
INSERT INTO distrito VALUES ('958', '97', 'PAMPAMARCA', '101107');
INSERT INTO distrito VALUES ('959', '97', 'CHORAS', '101108');
INSERT INTO distrito VALUES ('960', '98', 'ICA', '110101');
INSERT INTO distrito VALUES ('961', '98', 'LA TINGUINA', '110102');
INSERT INTO distrito VALUES ('962', '98', 'LOS AQUIJES', '110103');
INSERT INTO distrito VALUES ('963', '98', 'OCUCAJE', '110104');
INSERT INTO distrito VALUES ('964', '98', 'PACHACUTEC', '110105');
INSERT INTO distrito VALUES ('965', '98', 'PARCONA', '110106');
INSERT INTO distrito VALUES ('966', '98', 'PUEBLO NUEVO', '110107');
INSERT INTO distrito VALUES ('967', '98', 'SALAS', '110108');
INSERT INTO distrito VALUES ('968', '98', 'SAN JOSE DE LOS MOLINOS', '110109');
INSERT INTO distrito VALUES ('969', '98', 'SAN JUAN BAUTISTA', '110110');
INSERT INTO distrito VALUES ('970', '98', 'SANTIAGO', '110111');
INSERT INTO distrito VALUES ('971', '98', 'SUBTANJALLA', '110112');
INSERT INTO distrito VALUES ('972', '98', 'TATE', '110113');
INSERT INTO distrito VALUES ('973', '98', 'YAUCA DEL ROSARIO', '110114');
INSERT INTO distrito VALUES ('974', '99', 'CHINCHA ALTA', '110201');
INSERT INTO distrito VALUES ('975', '99', 'ALTO LARAN', '110202');
INSERT INTO distrito VALUES ('976', '99', 'CHAVIN', '110203');
INSERT INTO distrito VALUES ('977', '99', 'CHINCHA BAJA', '110204');
INSERT INTO distrito VALUES ('978', '99', 'EL CARMEN', '110205');
INSERT INTO distrito VALUES ('979', '99', 'GROCIO PRADO', '110206');
INSERT INTO distrito VALUES ('980', '99', 'PUEBLO NUEVO', '110207');
INSERT INTO distrito VALUES ('981', '99', 'SAN JUAN DE YANAC', '110208');
INSERT INTO distrito VALUES ('982', '99', 'SAN PEDRO DE HUACARPANA', '110209');
INSERT INTO distrito VALUES ('983', '99', 'SUNAMPE', '110210');
INSERT INTO distrito VALUES ('984', '99', 'TAMBO DE MORA', '110211');
INSERT INTO distrito VALUES ('985', '100', 'NAZCA', '110301');
INSERT INTO distrito VALUES ('986', '100', 'CHANGUILLO', '110302');
INSERT INTO distrito VALUES ('987', '100', 'EL INGENIO', '110303');
INSERT INTO distrito VALUES ('988', '100', 'MARCONA', '110304');
INSERT INTO distrito VALUES ('989', '100', 'VISTA ALEGRE', '110305');
INSERT INTO distrito VALUES ('990', '101', 'PALPA', '110401');
INSERT INTO distrito VALUES ('991', '101', 'LLIPATA', '110402');
INSERT INTO distrito VALUES ('992', '101', 'RIO GRANDE', '110403');
INSERT INTO distrito VALUES ('993', '101', 'SANTA CRUZ', '110404');
INSERT INTO distrito VALUES ('994', '101', 'TIBILLO', '110405');
INSERT INTO distrito VALUES ('995', '102', 'PISCO', '110501');
INSERT INTO distrito VALUES ('996', '102', 'HUANCANO', '110502');
INSERT INTO distrito VALUES ('997', '102', 'HUMAY', '110503');
INSERT INTO distrito VALUES ('998', '102', 'INDEPENDENCIA', '110504');
INSERT INTO distrito VALUES ('999', '102', 'PARACAS', '110505');
INSERT INTO distrito VALUES ('1000', '102', 'SAN ANDRES', '110506');
INSERT INTO distrito VALUES ('1001', '102', 'SAN CLEMENTE', '110507');
INSERT INTO distrito VALUES ('1002', '102', 'TUPAC AMARU INCA', '110508');
INSERT INTO distrito VALUES ('1003', '103', 'HUANCAYO', '120101');
INSERT INTO distrito VALUES ('1004', '103', 'CARHUACALLANGA', '120104');
INSERT INTO distrito VALUES ('1005', '103', 'CHACAPAMPA', '120105');
INSERT INTO distrito VALUES ('1006', '103', 'CHICCHE', '120106');
INSERT INTO distrito VALUES ('1007', '103', 'CHILCA', '120107');
INSERT INTO distrito VALUES ('1008', '103', 'CHONGOS ALTO', '120108');
INSERT INTO distrito VALUES ('1009', '103', 'CHUPURO', '120111');
INSERT INTO distrito VALUES ('1010', '103', 'COLCA', '120112');
INSERT INTO distrito VALUES ('1011', '103', 'CULLHUAS', '120113');
INSERT INTO distrito VALUES ('1012', '103', 'EL TAMBO', '120114');
INSERT INTO distrito VALUES ('1013', '103', 'HUACRAPUQUIO', '120116');
INSERT INTO distrito VALUES ('1014', '103', 'HUALHUAS', '120117');
INSERT INTO distrito VALUES ('1015', '103', 'HUANCAN', '120119');
INSERT INTO distrito VALUES ('1016', '103', 'HUASICANCHA', '120120');
INSERT INTO distrito VALUES ('1017', '103', 'HUAYUCACHI', '120121');
INSERT INTO distrito VALUES ('1018', '103', 'INGENIO', '120122');
INSERT INTO distrito VALUES ('1019', '103', 'PARIAHUANCA', '120124');
INSERT INTO distrito VALUES ('1020', '103', 'PILCOMAYO', '120125');
INSERT INTO distrito VALUES ('1021', '103', 'PUCARA', '120126');
INSERT INTO distrito VALUES ('1022', '103', 'QUICHUAY', '120127');
INSERT INTO distrito VALUES ('1023', '103', 'QUILCAS', '120128');
INSERT INTO distrito VALUES ('1024', '103', 'SAN AGUSTIN', '120129');
INSERT INTO distrito VALUES ('1025', '103', 'SAN JERONIMO DE TUNAN', '120130');
INSERT INTO distrito VALUES ('1026', '103', 'SANO', '120132');
INSERT INTO distrito VALUES ('1027', '103', 'SAPALLANGA', '120133');
INSERT INTO distrito VALUES ('1028', '103', 'SICAYA', '120134');
INSERT INTO distrito VALUES ('1029', '103', 'SANTO DOMINGO DE ACOBAMBA', '120135');
INSERT INTO distrito VALUES ('1030', '103', 'VIQUES', '120136');
INSERT INTO distrito VALUES ('1031', '104', 'CONCEPCION', '120201');
INSERT INTO distrito VALUES ('1032', '104', 'ACO', '120202');
INSERT INTO distrito VALUES ('1033', '104', 'ANDAMARCA', '120203');
INSERT INTO distrito VALUES ('1034', '104', 'CHAMBARA', '120204');
INSERT INTO distrito VALUES ('1035', '104', 'COCHAS', '120205');
INSERT INTO distrito VALUES ('1036', '104', 'COMAS', '120206');
INSERT INTO distrito VALUES ('1037', '104', 'HEROINAS TOLEDO', '120207');
INSERT INTO distrito VALUES ('1038', '104', 'MANZANARES', '120208');
INSERT INTO distrito VALUES ('1039', '104', 'MARISCAL CASTILLA', '120209');
INSERT INTO distrito VALUES ('1040', '104', 'MATAHUASI', '120210');
INSERT INTO distrito VALUES ('1041', '104', 'MITO', '120211');
INSERT INTO distrito VALUES ('1042', '104', 'NUEVE DE JULIO', '120212');
INSERT INTO distrito VALUES ('1043', '104', 'ORCOTUNA', '120213');
INSERT INTO distrito VALUES ('1044', '104', 'SAN JOSE DE QUERO', '120214');
INSERT INTO distrito VALUES ('1045', '104', 'SANTA ROSA DE OCOPA', '120215');
INSERT INTO distrito VALUES ('1046', '105', 'CHANCHAMAYO', '120301');
INSERT INTO distrito VALUES ('1047', '105', 'PERENE', '120302');
INSERT INTO distrito VALUES ('1048', '105', 'PICHANAQUI', '120303');
INSERT INTO distrito VALUES ('1049', '105', 'SAN LUIS DE SHUARO', '120304');
INSERT INTO distrito VALUES ('1050', '105', 'SAN RAMON', '120305');
INSERT INTO distrito VALUES ('1051', '105', 'VITOC', '120306');
INSERT INTO distrito VALUES ('1052', '106', 'JAUJA', '120401');
INSERT INTO distrito VALUES ('1053', '106', 'ACOLLA', '120402');
INSERT INTO distrito VALUES ('1054', '106', 'APATA', '120403');
INSERT INTO distrito VALUES ('1055', '106', 'ATAURA', '120404');
INSERT INTO distrito VALUES ('1056', '106', 'CANCHAYLLO', '120405');
INSERT INTO distrito VALUES ('1057', '106', 'CURICACA', '120406');
INSERT INTO distrito VALUES ('1058', '106', 'EL MANTARO', '120407');
INSERT INTO distrito VALUES ('1059', '106', 'HUAMALI', '120408');
INSERT INTO distrito VALUES ('1060', '106', 'HUARIPAMPA', '120409');
INSERT INTO distrito VALUES ('1061', '106', 'HUERTAS', '120410');
INSERT INTO distrito VALUES ('1062', '106', 'JANJAILLO', '120411');
INSERT INTO distrito VALUES ('1063', '106', 'JULCAN', '120412');
INSERT INTO distrito VALUES ('1064', '106', 'LEONOR ORDONEZ', '120413');
INSERT INTO distrito VALUES ('1065', '106', 'LLOCLLAPAMPA', '120414');
INSERT INTO distrito VALUES ('1066', '106', 'MARCO', '120415');
INSERT INTO distrito VALUES ('1067', '106', 'MASMA', '120416');
INSERT INTO distrito VALUES ('1068', '106', 'MASMA CHICCHE', '120417');
INSERT INTO distrito VALUES ('1069', '106', 'MOLINOS', '120418');
INSERT INTO distrito VALUES ('1070', '106', 'MONOBAMBA', '120419');
INSERT INTO distrito VALUES ('1071', '106', 'MUQUI', '120420');
INSERT INTO distrito VALUES ('1072', '106', 'MUQUIYAUYO', '120421');
INSERT INTO distrito VALUES ('1073', '106', 'PACA', '120422');
INSERT INTO distrito VALUES ('1074', '106', 'PACCHA', '120423');
INSERT INTO distrito VALUES ('1075', '106', 'PANCAN', '120424');
INSERT INTO distrito VALUES ('1076', '106', 'PARCO', '120425');
INSERT INTO distrito VALUES ('1077', '106', 'POMACANCHA', '120426');
INSERT INTO distrito VALUES ('1078', '106', 'RICRAN', '120427');
INSERT INTO distrito VALUES ('1079', '106', 'SAN LORENZO', '120428');
INSERT INTO distrito VALUES ('1080', '106', 'SAN PEDRO DE CHUNAN', '120429');
INSERT INTO distrito VALUES ('1081', '106', 'SAUSA', '120430');
INSERT INTO distrito VALUES ('1082', '106', 'SINCOS', '120431');
INSERT INTO distrito VALUES ('1083', '106', 'TUNAN MARCA', '120432');
INSERT INTO distrito VALUES ('1084', '106', 'YAULI', '120433');
INSERT INTO distrito VALUES ('1085', '106', 'YAUYOS', '120434');
INSERT INTO distrito VALUES ('1086', '107', 'JUNIN', '120501');
INSERT INTO distrito VALUES ('1087', '107', 'CARHUAMAYO', '120502');
INSERT INTO distrito VALUES ('1088', '107', 'ONDORES', '120503');
INSERT INTO distrito VALUES ('1089', '107', 'ULCUMAYO', '120504');
INSERT INTO distrito VALUES ('1090', '108', 'SATIPO', '120601');
INSERT INTO distrito VALUES ('1091', '108', 'COVIRIALI', '120602');
INSERT INTO distrito VALUES ('1092', '108', 'LLAYLLA', '120603');
INSERT INTO distrito VALUES ('1093', '108', 'MAZAMARI', '120604');
INSERT INTO distrito VALUES ('1094', '108', 'PAMPA HERMOSA', '120605');
INSERT INTO distrito VALUES ('1095', '108', 'PANGOA', '120606');
INSERT INTO distrito VALUES ('1096', '108', 'RIO NEGRO', '120607');
INSERT INTO distrito VALUES ('1097', '108', 'RIO TAMBO', '120608');
INSERT INTO distrito VALUES ('1098', '109', 'TARMA', '120701');
INSERT INTO distrito VALUES ('1099', '109', 'ACOBAMBA', '120702');
INSERT INTO distrito VALUES ('1100', '109', 'HUARICOLCA', '120703');
INSERT INTO distrito VALUES ('1101', '109', 'HUASAHUASI', '120704');
INSERT INTO distrito VALUES ('1102', '109', 'LA UNION', '120705');
INSERT INTO distrito VALUES ('1103', '109', 'PALCA', '120706');
INSERT INTO distrito VALUES ('1104', '109', 'PALCAMAYO', '120707');
INSERT INTO distrito VALUES ('1105', '109', 'SAN PEDRO DE CAJAS', '120708');
INSERT INTO distrito VALUES ('1106', '109', 'TAPO', '120709');
INSERT INTO distrito VALUES ('1107', '110', 'LA OROYA', '120801');
INSERT INTO distrito VALUES ('1108', '110', 'CHACAPALPA', '120802');
INSERT INTO distrito VALUES ('1109', '110', 'HUAY-HUAY', '120803');
INSERT INTO distrito VALUES ('1110', '110', 'MARCAPOMACOCHA', '120804');
INSERT INTO distrito VALUES ('1111', '110', 'MOROCOCHA', '120805');
INSERT INTO distrito VALUES ('1112', '110', 'PACCHA', '120806');
INSERT INTO distrito VALUES ('1113', '110', 'SANTA BARBARA DE CARHUACAYAN', '120807');
INSERT INTO distrito VALUES ('1114', '110', 'SANTA ROSA DE SACCO', '120808');
INSERT INTO distrito VALUES ('1115', '110', 'SUITUCANCHA', '120809');
INSERT INTO distrito VALUES ('1116', '110', 'YAULI', '120810');
INSERT INTO distrito VALUES ('1117', '111', 'CHUPACA', '120901');
INSERT INTO distrito VALUES ('1118', '111', 'AHUAC', '120902');
INSERT INTO distrito VALUES ('1119', '111', 'CHONGOS BAJO', '120903');
INSERT INTO distrito VALUES ('1120', '111', 'HUACHAC', '120904');
INSERT INTO distrito VALUES ('1121', '111', 'HUAMANCACA CHICO', '120905');
INSERT INTO distrito VALUES ('1122', '111', 'SAN JUAN DE ISCOS', '120906');
INSERT INTO distrito VALUES ('1123', '111', 'SAN JUAN DE JARPA', '120907');
INSERT INTO distrito VALUES ('1124', '111', 'TRES DE DICIEMBRE', '120908');
INSERT INTO distrito VALUES ('1125', '111', 'YANACANCHA', '120909');
INSERT INTO distrito VALUES ('1126', '112', 'TRUJILLO', '130101');
INSERT INTO distrito VALUES ('1127', '112', 'EL PORVENIR', '130102');
INSERT INTO distrito VALUES ('1128', '112', 'FLORENCIA DE MORA', '130103');
INSERT INTO distrito VALUES ('1129', '112', 'HUANCHACO', '130104');
INSERT INTO distrito VALUES ('1130', '112', 'LA ESPERANZA', '130105');
INSERT INTO distrito VALUES ('1131', '112', 'LAREDO', '130106');
INSERT INTO distrito VALUES ('1132', '112', 'MOCHE', '130107');
INSERT INTO distrito VALUES ('1133', '112', 'POROTO', '130108');
INSERT INTO distrito VALUES ('1134', '112', 'SALAVERRY', '130109');
INSERT INTO distrito VALUES ('1135', '112', 'SIMBAL', '130110');
INSERT INTO distrito VALUES ('1136', '112', 'VICTOR LARCO HERRERA', '130111');
INSERT INTO distrito VALUES ('1137', '113', 'ASCOPE', '130201');
INSERT INTO distrito VALUES ('1138', '113', 'CHICAMA', '130202');
INSERT INTO distrito VALUES ('1139', '113', 'CHOCOPE', '130203');
INSERT INTO distrito VALUES ('1140', '113', 'MAGDALENA DE CAO', '130204');
INSERT INTO distrito VALUES ('1141', '113', 'PAIJAN', '130205');
INSERT INTO distrito VALUES ('1142', '113', 'RAZURI', '130206');
INSERT INTO distrito VALUES ('1143', '113', 'SANTIAGO DE CAO', '130207');
INSERT INTO distrito VALUES ('1144', '113', 'CASA GRANDE', '130208');
INSERT INTO distrito VALUES ('1145', '114', 'BOLIVAR', '130301');
INSERT INTO distrito VALUES ('1146', '114', 'BAMBAMARCA', '130302');
INSERT INTO distrito VALUES ('1147', '114', 'CONDORMARCA', '130303');
INSERT INTO distrito VALUES ('1148', '114', 'LONGOTEA', '130304');
INSERT INTO distrito VALUES ('1149', '114', 'UCHUMARCA', '130305');
INSERT INTO distrito VALUES ('1150', '114', 'UCUNCHA', '130306');
INSERT INTO distrito VALUES ('1151', '115', 'CHEPEN', '130401');
INSERT INTO distrito VALUES ('1152', '115', 'PACANGA', '130402');
INSERT INTO distrito VALUES ('1153', '115', 'PUEBLO NUEVO', '130403');
INSERT INTO distrito VALUES ('1154', '116', 'JULCAN', '130501');
INSERT INTO distrito VALUES ('1155', '116', 'CALAMARCA', '130502');
INSERT INTO distrito VALUES ('1156', '116', 'CARABAMBA', '130503');
INSERT INTO distrito VALUES ('1157', '116', 'HUASO', '130504');
INSERT INTO distrito VALUES ('1158', '117', 'OTUZCO', '130601');
INSERT INTO distrito VALUES ('1159', '117', 'AGALLPAMPA', '130602');
INSERT INTO distrito VALUES ('1160', '117', 'CHARAT', '130604');
INSERT INTO distrito VALUES ('1161', '117', 'HUARANCHAL', '130605');
INSERT INTO distrito VALUES ('1162', '117', 'LA CUESTA', '130606');
INSERT INTO distrito VALUES ('1163', '117', 'MACHE', '130608');
INSERT INTO distrito VALUES ('1164', '117', 'PARANDAY', '130610');
INSERT INTO distrito VALUES ('1165', '117', 'SALPO', '130611');
INSERT INTO distrito VALUES ('1166', '117', 'SINSICAP', '130613');
INSERT INTO distrito VALUES ('1167', '117', 'USQUIL', '130614');
INSERT INTO distrito VALUES ('1168', '118', 'SAN PEDRO DE LLOC', '130701');
INSERT INTO distrito VALUES ('1169', '118', 'GUADALUPE', '130702');
INSERT INTO distrito VALUES ('1170', '118', 'JEQUETEPEQUE', '130703');
INSERT INTO distrito VALUES ('1171', '118', 'PACASMAYO', '130704');
INSERT INTO distrito VALUES ('1172', '118', 'SAN JOSE', '130705');
INSERT INTO distrito VALUES ('1173', '119', 'TAYABAMBA', '130801');
INSERT INTO distrito VALUES ('1174', '119', 'BULDIBUYO', '130802');
INSERT INTO distrito VALUES ('1175', '119', 'CHILLIA', '130803');
INSERT INTO distrito VALUES ('1176', '119', 'HUANCASPATA', '130804');
INSERT INTO distrito VALUES ('1177', '119', 'HUAYLILLAS', '130805');
INSERT INTO distrito VALUES ('1178', '119', 'HUAYO', '130806');
INSERT INTO distrito VALUES ('1179', '119', 'ONGON', '130807');
INSERT INTO distrito VALUES ('1180', '119', 'PARCOY', '130808');
INSERT INTO distrito VALUES ('1181', '119', 'PATAZ', '130809');
INSERT INTO distrito VALUES ('1182', '119', 'PIAS', '130810');
INSERT INTO distrito VALUES ('1183', '119', 'SANTIAGO DE CHALLAS', '130811');
INSERT INTO distrito VALUES ('1184', '119', 'TAURIJA', '130812');
INSERT INTO distrito VALUES ('1185', '119', 'URPAY', '130813');
INSERT INTO distrito VALUES ('1186', '120', 'HUAMACHUCO', '130901');
INSERT INTO distrito VALUES ('1187', '120', 'CHUGAY', '130902');
INSERT INTO distrito VALUES ('1188', '120', 'COCHORCO', '130903');
INSERT INTO distrito VALUES ('1189', '120', 'CURGOS', '130904');
INSERT INTO distrito VALUES ('1190', '120', 'MARCABAL', '130905');
INSERT INTO distrito VALUES ('1191', '120', 'SANAGORAN', '130906');
INSERT INTO distrito VALUES ('1192', '120', 'SARIN', '130907');
INSERT INTO distrito VALUES ('1193', '120', 'SARTIMBAMBA', '130908');
INSERT INTO distrito VALUES ('1194', '121', 'SANTIAGO DE CHUCO', '131001');
INSERT INTO distrito VALUES ('1195', '121', 'ANGASMARCA', '131002');
INSERT INTO distrito VALUES ('1196', '121', 'CACHICADAN', '131003');
INSERT INTO distrito VALUES ('1197', '121', 'MOLLEBAMBA', '131004');
INSERT INTO distrito VALUES ('1198', '121', 'MOLLEPATA', '131005');
INSERT INTO distrito VALUES ('1199', '121', 'QUIRUVILCA', '131006');
INSERT INTO distrito VALUES ('1200', '121', 'SANTA CRUZ DE CHUCA', '131007');
INSERT INTO distrito VALUES ('1201', '121', 'SITABAMBA', '131008');
INSERT INTO distrito VALUES ('1202', '122', 'CASCAS', '131101');
INSERT INTO distrito VALUES ('1203', '122', 'LUCMA', '131102');
INSERT INTO distrito VALUES ('1204', '122', 'MARMOT', '131103');
INSERT INTO distrito VALUES ('1205', '122', 'SAYAPULLO', '131104');
INSERT INTO distrito VALUES ('1206', '123', 'VIRU', '131201');
INSERT INTO distrito VALUES ('1207', '123', 'CHAO', '131202');
INSERT INTO distrito VALUES ('1208', '123', 'GUADALUPITO', '131203');
INSERT INTO distrito VALUES ('1209', '124', 'CHICLAYO', '140101');
INSERT INTO distrito VALUES ('1210', '124', 'CHONGOYAPE', '140102');
INSERT INTO distrito VALUES ('1211', '124', 'ETEN', '140103');
INSERT INTO distrito VALUES ('1212', '124', 'ETEN PUERTO', '140104');
INSERT INTO distrito VALUES ('1213', '124', 'JOSE LEONARDO ORTIZ', '140105');
INSERT INTO distrito VALUES ('1214', '124', 'LA VICTORIA', '140106');
INSERT INTO distrito VALUES ('1215', '124', 'LAGUNAS', '140107');
INSERT INTO distrito VALUES ('1216', '124', 'MONSEFU', '140108');
INSERT INTO distrito VALUES ('1217', '124', 'NUEVA ARICA', '140109');
INSERT INTO distrito VALUES ('1218', '124', 'OYOTUN', '140110');
INSERT INTO distrito VALUES ('1219', '124', 'PICSI', '140111');
INSERT INTO distrito VALUES ('1220', '124', 'PIMENTEL', '140112');
INSERT INTO distrito VALUES ('1221', '124', 'REQUE', '140113');
INSERT INTO distrito VALUES ('1222', '124', 'SANTA ROSA', '140114');
INSERT INTO distrito VALUES ('1223', '124', 'SANA', '140115');
INSERT INTO distrito VALUES ('1224', '124', 'CAYALTI', '140116');
INSERT INTO distrito VALUES ('1225', '124', 'PATAPO', '140117');
INSERT INTO distrito VALUES ('1226', '124', 'POMALCA', '140118');
INSERT INTO distrito VALUES ('1227', '124', 'PUCALA', '140119');
INSERT INTO distrito VALUES ('1228', '124', 'TUMAN', '140120');
INSERT INTO distrito VALUES ('1229', '125', 'FERRENAFE', '140201');
INSERT INTO distrito VALUES ('1230', '125', 'CANARIS', '140202');
INSERT INTO distrito VALUES ('1231', '125', 'INCAHUASI', '140203');
INSERT INTO distrito VALUES ('1232', '125', 'MANUEL ANTONIO MESONES MURO', '140204');
INSERT INTO distrito VALUES ('1233', '125', 'PITIPO', '140205');
INSERT INTO distrito VALUES ('1234', '125', 'PUEBLO NUEVO', '140206');
INSERT INTO distrito VALUES ('1235', '126', 'LAMBAYEQUE', '140301');
INSERT INTO distrito VALUES ('1236', '126', 'CHOCHOPE', '140302');
INSERT INTO distrito VALUES ('1237', '126', 'ILLIMO', '140303');
INSERT INTO distrito VALUES ('1238', '126', 'JAYANCA', '140304');
INSERT INTO distrito VALUES ('1239', '126', 'MOCHUMI', '140305');
INSERT INTO distrito VALUES ('1240', '126', 'MORROPE', '140306');
INSERT INTO distrito VALUES ('1241', '126', 'MOTUPE', '140307');
INSERT INTO distrito VALUES ('1242', '126', 'OLMOS', '140308');
INSERT INTO distrito VALUES ('1243', '126', 'PACORA', '140309');
INSERT INTO distrito VALUES ('1244', '126', 'SALAS', '140310');
INSERT INTO distrito VALUES ('1245', '126', 'SAN JOSE', '140311');
INSERT INTO distrito VALUES ('1246', '126', 'TUCUME', '140312');
INSERT INTO distrito VALUES ('1247', '127', 'LIMA', '150101');
INSERT INTO distrito VALUES ('1248', '127', 'ANCON', '150102');
INSERT INTO distrito VALUES ('1249', '127', 'ATE', '150103');
INSERT INTO distrito VALUES ('1250', '127', 'BARRANCO', '150104');
INSERT INTO distrito VALUES ('1251', '127', 'BRENA', '150105');
INSERT INTO distrito VALUES ('1252', '127', 'CARABAYLLO', '150106');
INSERT INTO distrito VALUES ('1253', '127', 'CHACLACAYO', '150107');
INSERT INTO distrito VALUES ('1254', '127', 'CHORRILLOS', '150108');
INSERT INTO distrito VALUES ('1255', '127', 'CIENEGUILLA', '150109');
INSERT INTO distrito VALUES ('1256', '127', 'COMAS', '150110');
INSERT INTO distrito VALUES ('1257', '127', 'EL AGUSTINO', '150111');
INSERT INTO distrito VALUES ('1258', '127', 'INDEPENDENCIA', '150112');
INSERT INTO distrito VALUES ('1259', '127', 'JESUS MARIA', '150113');
INSERT INTO distrito VALUES ('1260', '127', 'LA MOLINA', '150114');
INSERT INTO distrito VALUES ('1261', '127', 'LA VICTORIA', '150115');
INSERT INTO distrito VALUES ('1262', '127', 'LINCE', '150116');
INSERT INTO distrito VALUES ('1263', '127', 'LOS OLIVOS', '150117');
INSERT INTO distrito VALUES ('1264', '127', 'LURIGANCHO', '150118');
INSERT INTO distrito VALUES ('1265', '127', 'LURIN', '150119');
INSERT INTO distrito VALUES ('1266', '127', 'MAGDALENA DEL MAR', '150120');
INSERT INTO distrito VALUES ('1267', '127', 'MAGDALENA VIEJA', '150121');
INSERT INTO distrito VALUES ('1268', '127', 'MIRAFLORES', '150122');
INSERT INTO distrito VALUES ('1269', '127', 'PACHACAMAC', '150123');
INSERT INTO distrito VALUES ('1270', '127', 'PUCUSANA', '150124');
INSERT INTO distrito VALUES ('1271', '127', 'PUENTE PIEDRA', '150125');
INSERT INTO distrito VALUES ('1272', '127', 'PUNTA HERMOSA', '150126');
INSERT INTO distrito VALUES ('1273', '127', 'PUNTA NEGRA', '150127');
INSERT INTO distrito VALUES ('1274', '127', 'RIMAC', '150128');
INSERT INTO distrito VALUES ('1275', '127', 'SAN BARTOLO', '150129');
INSERT INTO distrito VALUES ('1276', '127', 'SAN BORJA', '150130');
INSERT INTO distrito VALUES ('1277', '127', 'SAN ISIDRO', '150131');
INSERT INTO distrito VALUES ('1278', '127', 'SAN JUAN DE LURIGANCHO', '150132');
INSERT INTO distrito VALUES ('1279', '127', 'SAN JUAN DE MIRAFLORES', '150133');
INSERT INTO distrito VALUES ('1280', '127', 'SAN LUIS', '150134');
INSERT INTO distrito VALUES ('1281', '127', 'SAN MARTIN DE PORRES', '150135');
INSERT INTO distrito VALUES ('1282', '127', 'SAN MIGUEL', '150136');
INSERT INTO distrito VALUES ('1283', '127', 'SANTA ANITA', '150137');
INSERT INTO distrito VALUES ('1284', '127', 'SANTA MARIA DEL MAR', '150138');
INSERT INTO distrito VALUES ('1285', '127', 'SANTA ROSA', '150139');
INSERT INTO distrito VALUES ('1286', '127', 'SANTIAGO DE SURCO', '150140');
INSERT INTO distrito VALUES ('1287', '127', 'SURQUILLO', '150141');
INSERT INTO distrito VALUES ('1288', '127', 'VILLA EL SALVADOR', '150142');
INSERT INTO distrito VALUES ('1289', '127', 'VILLA MARIA DEL TRIUNFO', '150143');
INSERT INTO distrito VALUES ('1290', '128', 'BARRANCA', '150201');
INSERT INTO distrito VALUES ('1291', '128', 'PARAMONGA', '150202');
INSERT INTO distrito VALUES ('1292', '128', 'PATIVILCA', '150203');
INSERT INTO distrito VALUES ('1293', '128', 'SUPE', '150204');
INSERT INTO distrito VALUES ('1294', '128', 'SUPE PUERTO', '150205');
INSERT INTO distrito VALUES ('1295', '129', 'CAJATAMBO', '150301');
INSERT INTO distrito VALUES ('1296', '129', 'COPA', '150302');
INSERT INTO distrito VALUES ('1297', '129', 'GORGOR', '150303');
INSERT INTO distrito VALUES ('1298', '129', 'HUANCAPON', '150304');
INSERT INTO distrito VALUES ('1299', '129', 'MANAS', '150305');
INSERT INTO distrito VALUES ('1300', '130', 'CANTA', '150401');
INSERT INTO distrito VALUES ('1301', '130', 'ARAHUAY', '150402');
INSERT INTO distrito VALUES ('1302', '130', 'HUAMANTANGA', '150403');
INSERT INTO distrito VALUES ('1303', '130', 'HUAROS', '150404');
INSERT INTO distrito VALUES ('1304', '130', 'LACHAQUI', '150405');
INSERT INTO distrito VALUES ('1305', '130', 'SAN BUENAVENTURA', '150406');
INSERT INTO distrito VALUES ('1306', '130', 'SANTA ROSA DE QUIVES', '150407');
INSERT INTO distrito VALUES ('1307', '131', 'SAN VICENTE DE CANETE', '150501');
INSERT INTO distrito VALUES ('1308', '131', 'ASIA', '150502');
INSERT INTO distrito VALUES ('1309', '131', 'CALANGO', '150503');
INSERT INTO distrito VALUES ('1310', '131', 'CERRO AZUL', '150504');
INSERT INTO distrito VALUES ('1311', '131', 'CHILCA', '150505');
INSERT INTO distrito VALUES ('1312', '131', 'COAYLLO', '150506');
INSERT INTO distrito VALUES ('1313', '131', 'IMPERIAL', '150507');
INSERT INTO distrito VALUES ('1314', '131', 'LUNAHUANA', '150508');
INSERT INTO distrito VALUES ('1315', '131', 'MALA', '150509');
INSERT INTO distrito VALUES ('1316', '131', 'NUEVO IMPERIAL', '150510');
INSERT INTO distrito VALUES ('1317', '131', 'PACARAN', '150511');
INSERT INTO distrito VALUES ('1318', '131', 'QUILMANA', '150512');
INSERT INTO distrito VALUES ('1319', '131', 'SAN ANTONIO', '150513');
INSERT INTO distrito VALUES ('1320', '131', 'SAN LUIS', '150514');
INSERT INTO distrito VALUES ('1321', '131', 'SANTA CRUZ DE FLORES', '150515');
INSERT INTO distrito VALUES ('1322', '131', 'ZUNIGA', '150516');
INSERT INTO distrito VALUES ('1323', '132', 'HUARAL', '150601');
INSERT INTO distrito VALUES ('1324', '132', 'ATAVILLOS ALTO', '150602');
INSERT INTO distrito VALUES ('1325', '132', 'ATAVILLOS BAJO', '150603');
INSERT INTO distrito VALUES ('1326', '132', 'AUCALLAMA', '150604');
INSERT INTO distrito VALUES ('1327', '132', 'CHANCAY', '150605');
INSERT INTO distrito VALUES ('1328', '132', 'IHUARI', '150606');
INSERT INTO distrito VALUES ('1329', '132', 'LAMPIAN', '150607');
INSERT INTO distrito VALUES ('1330', '132', 'PACARAOS', '150608');
INSERT INTO distrito VALUES ('1331', '132', 'SAN MIGUEL DE ACOS', '150609');
INSERT INTO distrito VALUES ('1332', '132', 'SANTA CRUZ DE ANDAMARCA', '150610');
INSERT INTO distrito VALUES ('1333', '132', 'SUMBILCA', '150611');
INSERT INTO distrito VALUES ('1334', '132', 'VEINTISIETE DE NOVIEMBRE', '150612');
INSERT INTO distrito VALUES ('1335', '133', 'MATUCANA', '150701');
INSERT INTO distrito VALUES ('1336', '133', 'ANTIOQUIA', '150702');
INSERT INTO distrito VALUES ('1337', '133', 'CALLAHUANCA', '150703');
INSERT INTO distrito VALUES ('1338', '133', 'CARAMPOMA', '150704');
INSERT INTO distrito VALUES ('1339', '133', 'CHICLA', '150705');
INSERT INTO distrito VALUES ('1340', '133', 'CUENCA', '150706');
INSERT INTO distrito VALUES ('1341', '133', 'HUACHUPAMPA', '150707');
INSERT INTO distrito VALUES ('1342', '133', 'HUANZA', '150708');
INSERT INTO distrito VALUES ('1343', '133', 'HUAROCHIRI', '150709');
INSERT INTO distrito VALUES ('1344', '133', 'LAHUAYTAMBO', '150710');
INSERT INTO distrito VALUES ('1345', '133', 'LANGA', '150711');
INSERT INTO distrito VALUES ('1346', '133', 'LARAOS', '150712');
INSERT INTO distrito VALUES ('1347', '133', 'MARIATANA', '150713');
INSERT INTO distrito VALUES ('1348', '133', 'RICARDO PALMA', '150714');
INSERT INTO distrito VALUES ('1349', '133', 'SAN ANDRES DE TUPICOCHA', '150715');
INSERT INTO distrito VALUES ('1350', '133', 'SAN ANTONIO', '150716');
INSERT INTO distrito VALUES ('1351', '133', 'SAN BARTOLOME', '150717');
INSERT INTO distrito VALUES ('1352', '133', 'SAN DAMIAN', '150718');
INSERT INTO distrito VALUES ('1353', '133', 'SAN JUAN DE IRIS', '150719');
INSERT INTO distrito VALUES ('1354', '133', 'SAN JUAN DE TANTARANCHE', '150720');
INSERT INTO distrito VALUES ('1355', '133', 'SAN LORENZO DE QUINTI', '150721');
INSERT INTO distrito VALUES ('1356', '133', 'SAN MATEO', '150722');
INSERT INTO distrito VALUES ('1357', '133', 'SAN MATEO DE OTAO', '150723');
INSERT INTO distrito VALUES ('1358', '133', 'SAN PEDRO DE CASTA', '150724');
INSERT INTO distrito VALUES ('1359', '133', 'SAN PEDRO DE HUANCAYRE', '150725');
INSERT INTO distrito VALUES ('1360', '133', 'SANGALLAYA', '150726');
INSERT INTO distrito VALUES ('1361', '133', 'SANTA EULALIA', '150728');
INSERT INTO distrito VALUES ('1362', '133', 'SANTIAGO DE ANCHUCAYA', '150729');
INSERT INTO distrito VALUES ('1363', '133', 'SANTIAGO DE TUNA', '150730');
INSERT INTO distrito VALUES ('1364', '133', 'SANTO DOMINGO DE LOS OLLEROS', '150731');
INSERT INTO distrito VALUES ('1365', '133', 'SURCO', '150732');
INSERT INTO distrito VALUES ('1366', '134', 'HUACHO', '150801');
INSERT INTO distrito VALUES ('1367', '134', 'AMBAR', '150802');
INSERT INTO distrito VALUES ('1368', '134', 'CALETA DE CARQUIN', '150803');
INSERT INTO distrito VALUES ('1369', '134', 'CHERCAS', '150804');
INSERT INTO distrito VALUES ('1370', '134', 'HUALMAY', '150805');
INSERT INTO distrito VALUES ('1371', '134', 'HUAURA', '150806');
INSERT INTO distrito VALUES ('1372', '134', 'LEONCIO PRADO', '150807');
INSERT INTO distrito VALUES ('1373', '134', 'PACCHO', '150808');
INSERT INTO distrito VALUES ('1374', '134', 'SANTA LEONOR', '150809');
INSERT INTO distrito VALUES ('1375', '134', 'SANTA MARIA', '150810');
INSERT INTO distrito VALUES ('1376', '134', 'SAYAN', '150811');
INSERT INTO distrito VALUES ('1377', '134', 'VEGUETA', '150812');
INSERT INTO distrito VALUES ('1378', '135', 'OYON', '150901');
INSERT INTO distrito VALUES ('1379', '135', 'ANDAJES', '150902');
INSERT INTO distrito VALUES ('1380', '135', 'CAUJIL', '150903');
INSERT INTO distrito VALUES ('1381', '135', 'COCHAMARCA', '150904');
INSERT INTO distrito VALUES ('1382', '135', 'NAVAN', '150905');
INSERT INTO distrito VALUES ('1383', '135', 'PACHANGARA', '150906');
INSERT INTO distrito VALUES ('1384', '136', 'YAUYOS', '151001');
INSERT INTO distrito VALUES ('1385', '136', 'ALIS', '151002');
INSERT INTO distrito VALUES ('1386', '136', 'ALLAUCA', '151003');
INSERT INTO distrito VALUES ('1387', '136', 'AYAVIRI', '151004');
INSERT INTO distrito VALUES ('1388', '136', 'AZANGARO', '151005');
INSERT INTO distrito VALUES ('1389', '136', 'CACRA', '151006');
INSERT INTO distrito VALUES ('1390', '136', 'CARANIA', '151007');
INSERT INTO distrito VALUES ('1391', '136', 'CATAHUASI', '151008');
INSERT INTO distrito VALUES ('1392', '136', 'CHOCOS', '151009');
INSERT INTO distrito VALUES ('1393', '136', 'COCHAS', '151010');
INSERT INTO distrito VALUES ('1394', '136', 'COLONIA', '151011');
INSERT INTO distrito VALUES ('1395', '136', 'HONGOS', '151012');
INSERT INTO distrito VALUES ('1396', '136', 'HUAMPARA', '151013');
INSERT INTO distrito VALUES ('1397', '136', 'HUANCAYA', '151014');
INSERT INTO distrito VALUES ('1398', '136', 'HUANGASCAR', '151015');
INSERT INTO distrito VALUES ('1399', '136', 'HUANTAN', '151016');
INSERT INTO distrito VALUES ('1400', '136', 'HUANEC', '151017');
INSERT INTO distrito VALUES ('1401', '136', 'LARAOS', '151018');
INSERT INTO distrito VALUES ('1402', '136', 'LINCHA', '151019');
INSERT INTO distrito VALUES ('1403', '136', 'MADEAN', '151020');
INSERT INTO distrito VALUES ('1404', '136', 'MIRAFLORES', '151021');
INSERT INTO distrito VALUES ('1405', '136', 'OMAS', '151022');
INSERT INTO distrito VALUES ('1406', '136', 'PUTINZA', '151023');
INSERT INTO distrito VALUES ('1407', '136', 'QUINCHES', '151024');
INSERT INTO distrito VALUES ('1408', '136', 'QUINOCAY', '151025');
INSERT INTO distrito VALUES ('1409', '136', 'SAN JOAQUIN', '151026');
INSERT INTO distrito VALUES ('1410', '136', 'SAN PEDRO DE PILAS', '151027');
INSERT INTO distrito VALUES ('1411', '136', 'TANTA', '151028');
INSERT INTO distrito VALUES ('1412', '136', 'TAURIPAMPA', '151029');
INSERT INTO distrito VALUES ('1413', '136', 'TOMAS', '151030');
INSERT INTO distrito VALUES ('1414', '136', 'TUPE', '151031');
INSERT INTO distrito VALUES ('1415', '136', 'VINAC', '151032');
INSERT INTO distrito VALUES ('1416', '136', 'VITIS', '151033');
INSERT INTO distrito VALUES ('1417', '137', 'IQUITOS', '160101');
INSERT INTO distrito VALUES ('1418', '137', 'ALTO NANAY', '160102');
INSERT INTO distrito VALUES ('1419', '137', 'FERNANDO LORES', '160103');
INSERT INTO distrito VALUES ('1420', '137', 'INDIANA', '160104');
INSERT INTO distrito VALUES ('1421', '137', 'LAS AMAZONAS', '160105');
INSERT INTO distrito VALUES ('1422', '137', 'MAZAN', '160106');
INSERT INTO distrito VALUES ('1423', '137', 'NAPO', '160107');
INSERT INTO distrito VALUES ('1424', '137', 'PUNCHANA', '160108');
INSERT INTO distrito VALUES ('1425', '137', 'PUTUMAYO', '160109');
INSERT INTO distrito VALUES ('1426', '137', 'TORRES CAUSANA', '160110');
INSERT INTO distrito VALUES ('1427', '137', 'BELEN', '160112');
INSERT INTO distrito VALUES ('1428', '137', 'SAN JUAN BAUTISTA', '160113');
INSERT INTO distrito VALUES ('1429', '138', 'YURIMAGUAS', '160201');
INSERT INTO distrito VALUES ('1430', '138', 'BALSAPUERTO', '160202');
INSERT INTO distrito VALUES ('1431', '138', 'JEBEROS', '160205');
INSERT INTO distrito VALUES ('1432', '138', 'LAGUNAS', '160206');
INSERT INTO distrito VALUES ('1433', '138', 'SANTA CRUZ', '160210');
INSERT INTO distrito VALUES ('1434', '138', 'TENIENTE CESAR LOPEZ ROJAS', '160211');
INSERT INTO distrito VALUES ('1435', '139', 'NAUTA', '160301');
INSERT INTO distrito VALUES ('1436', '139', 'PARINARI', '160302');
INSERT INTO distrito VALUES ('1437', '139', 'TIGRE', '160303');
INSERT INTO distrito VALUES ('1438', '139', 'TROMPETEROS', '160304');
INSERT INTO distrito VALUES ('1439', '139', 'URARINAS', '160305');
INSERT INTO distrito VALUES ('1440', '140', 'RAMON CASTILLA', '160401');
INSERT INTO distrito VALUES ('1441', '140', 'PEBAS', '160402');
INSERT INTO distrito VALUES ('1442', '140', 'YAVARI', '160403');
INSERT INTO distrito VALUES ('1443', '140', 'SAN PABLO', '160404');
INSERT INTO distrito VALUES ('1444', '141', 'REQUENA', '160501');
INSERT INTO distrito VALUES ('1445', '141', 'ALTO TAPICHE', '160502');
INSERT INTO distrito VALUES ('1446', '141', 'CAPELO', '160503');
INSERT INTO distrito VALUES ('1447', '141', 'EMILIO SAN MARTIN', '160504');
INSERT INTO distrito VALUES ('1448', '141', 'MAQUIA', '160505');
INSERT INTO distrito VALUES ('1449', '141', 'PUINAHUA', '160506');
INSERT INTO distrito VALUES ('1450', '141', 'SAQUENA', '160507');
INSERT INTO distrito VALUES ('1451', '141', 'SOPLIN', '160508');
INSERT INTO distrito VALUES ('1452', '141', 'TAPICHE', '160509');
INSERT INTO distrito VALUES ('1453', '141', 'JENARO HERRERA', '160510');
INSERT INTO distrito VALUES ('1454', '141', 'YAQUERANA', '160511');
INSERT INTO distrito VALUES ('1455', '142', 'CONTAMANA', '160601');
INSERT INTO distrito VALUES ('1456', '142', 'INAHUAYA', '160602');
INSERT INTO distrito VALUES ('1457', '142', 'PADRE MARQUEZ', '160603');
INSERT INTO distrito VALUES ('1458', '142', 'PAMPA HERMOSA', '160604');
INSERT INTO distrito VALUES ('1459', '142', 'SARAYACU', '160605');
INSERT INTO distrito VALUES ('1460', '142', 'VARGAS GUERRA', '160606');
INSERT INTO distrito VALUES ('1461', '143', 'BARRANCA', '160701');
INSERT INTO distrito VALUES ('1462', '143', 'CAHUAPANAS', '160702');
INSERT INTO distrito VALUES ('1463', '143', 'MANSERICHE', '160703');
INSERT INTO distrito VALUES ('1464', '143', 'MORONA', '160704');
INSERT INTO distrito VALUES ('1465', '143', 'PASTAZA', '160705');
INSERT INTO distrito VALUES ('1466', '143', 'ANDOAS', '160706');
INSERT INTO distrito VALUES ('1467', '144', 'TAMBOPATA', '170101');
INSERT INTO distrito VALUES ('1468', '144', 'INAMBARI', '170102');
INSERT INTO distrito VALUES ('1469', '144', 'LAS PIEDRAS', '170103');
INSERT INTO distrito VALUES ('1470', '144', 'LABERINTO', '170104');
INSERT INTO distrito VALUES ('1471', '145', 'MANU', '170201');
INSERT INTO distrito VALUES ('1472', '145', 'FITZCARRALD', '170202');
INSERT INTO distrito VALUES ('1473', '145', 'MADRE DE DIOS', '170203');
INSERT INTO distrito VALUES ('1474', '145', 'HUEPETUHE', '170204');
INSERT INTO distrito VALUES ('1475', '146', 'INAPARI', '170301');
INSERT INTO distrito VALUES ('1476', '146', 'IBERIA', '170302');
INSERT INTO distrito VALUES ('1477', '146', 'TAHUAMANU', '170303');
INSERT INTO distrito VALUES ('1478', '147', 'MOQUEGUA', '180101');
INSERT INTO distrito VALUES ('1479', '147', 'CARUMAS', '180102');
INSERT INTO distrito VALUES ('1480', '147', 'CUCHUMBAYA', '180103');
INSERT INTO distrito VALUES ('1481', '147', 'SAMEGUA', '180104');
INSERT INTO distrito VALUES ('1482', '147', 'SAN CRISTOBAL', '180105');
INSERT INTO distrito VALUES ('1483', '147', 'TORATA', '180106');
INSERT INTO distrito VALUES ('1484', '148', 'OMATE', '180201');
INSERT INTO distrito VALUES ('1485', '148', 'CHOJATA', '180202');
INSERT INTO distrito VALUES ('1486', '148', 'COALAQUE', '180203');
INSERT INTO distrito VALUES ('1487', '148', 'ICHUNA', '180204');
INSERT INTO distrito VALUES ('1488', '148', 'LA CAPILLA', '180205');
INSERT INTO distrito VALUES ('1489', '148', 'LLOQUE', '180206');
INSERT INTO distrito VALUES ('1490', '148', 'MATALAQUE', '180207');
INSERT INTO distrito VALUES ('1491', '148', 'PUQUINA', '180208');
INSERT INTO distrito VALUES ('1492', '148', 'QUINISTAQUILLAS', '180209');
INSERT INTO distrito VALUES ('1493', '148', 'UBINAS', '180210');
INSERT INTO distrito VALUES ('1494', '148', 'YUNGA', '180211');
INSERT INTO distrito VALUES ('1495', '149', 'ILO', '180301');
INSERT INTO distrito VALUES ('1496', '149', 'EL ALGARROBAL', '180302');
INSERT INTO distrito VALUES ('1497', '149', 'PACOCHA', '180303');
INSERT INTO distrito VALUES ('1498', '150', 'CHAUPIMARCA', '190101');
INSERT INTO distrito VALUES ('1499', '150', 'HUACHON', '190102');
INSERT INTO distrito VALUES ('1500', '150', 'HUARIACA', '190103');
INSERT INTO distrito VALUES ('1501', '150', 'HUAYLLAY', '190104');
INSERT INTO distrito VALUES ('1502', '150', 'NINACACA', '190105');
INSERT INTO distrito VALUES ('1503', '150', 'PALLANCHACRA', '190106');
INSERT INTO distrito VALUES ('1504', '150', 'PAUCARTAMBO', '190107');
INSERT INTO distrito VALUES ('1505', '150', 'SAN FCO.DE ASIS DE YARUSYACAN', '190108');
INSERT INTO distrito VALUES ('1506', '150', 'SIMON BOLIVAR', '190109');
INSERT INTO distrito VALUES ('1507', '150', 'TICLACAYAN', '190110');
INSERT INTO distrito VALUES ('1508', '150', 'TINYAHUARCO', '190111');
INSERT INTO distrito VALUES ('1509', '150', 'VICCO', '190112');
INSERT INTO distrito VALUES ('1510', '150', 'YANACANCHA', '190113');
INSERT INTO distrito VALUES ('1511', '151', 'YANAHUANCA', '190201');
INSERT INTO distrito VALUES ('1512', '151', 'CHACAYAN', '190202');
INSERT INTO distrito VALUES ('1513', '151', 'GOYLLARISQUIZGA', '190203');
INSERT INTO distrito VALUES ('1514', '151', 'PAUCAR', '190204');
INSERT INTO distrito VALUES ('1515', '151', 'SAN PEDRO DE PILLAO', '190205');
INSERT INTO distrito VALUES ('1516', '151', 'SANTA ANA DE TUSI', '190206');
INSERT INTO distrito VALUES ('1517', '151', 'TAPUC', '190207');
INSERT INTO distrito VALUES ('1518', '151', 'VILCABAMBA', '190208');
INSERT INTO distrito VALUES ('1519', '152', 'OXAPAMPA', '190301');
INSERT INTO distrito VALUES ('1520', '152', 'CHONTABAMBA', '190302');
INSERT INTO distrito VALUES ('1521', '152', 'HUANCABAMBA', '190303');
INSERT INTO distrito VALUES ('1522', '152', 'PALCAZU', '190304');
INSERT INTO distrito VALUES ('1523', '152', 'POZUZO', '190305');
INSERT INTO distrito VALUES ('1524', '152', 'PUERTO BERMUDEZ', '190306');
INSERT INTO distrito VALUES ('1525', '152', 'VILLA RICA', '190307');
INSERT INTO distrito VALUES ('1526', '153', 'PIURA', '200101');
INSERT INTO distrito VALUES ('1527', '153', 'CASTILLA', '200104');
INSERT INTO distrito VALUES ('1528', '153', 'CATACAOS', '200105');
INSERT INTO distrito VALUES ('1529', '153', 'CURA MORI', '200107');
INSERT INTO distrito VALUES ('1530', '153', 'EL TALLAN', '200108');
INSERT INTO distrito VALUES ('1531', '153', 'LA ARENA', '200109');
INSERT INTO distrito VALUES ('1532', '153', 'LA UNION', '200110');
INSERT INTO distrito VALUES ('1533', '153', 'LAS LOMAS', '200111');
INSERT INTO distrito VALUES ('1534', '153', 'TAMBO GRANDE', '200114');
INSERT INTO distrito VALUES ('1535', '154', 'AYABACA', '200201');
INSERT INTO distrito VALUES ('1536', '154', 'FRIAS', '200202');
INSERT INTO distrito VALUES ('1537', '154', 'JILILI', '200203');
INSERT INTO distrito VALUES ('1538', '154', 'LAGUNAS', '200204');
INSERT INTO distrito VALUES ('1539', '154', 'MONTERO', '200205');
INSERT INTO distrito VALUES ('1540', '154', 'PACAIPAMPA', '200206');
INSERT INTO distrito VALUES ('1541', '154', 'PAIMAS', '200207');
INSERT INTO distrito VALUES ('1542', '154', 'SAPILLICA', '200208');
INSERT INTO distrito VALUES ('1543', '154', 'SICCHEZ', '200209');
INSERT INTO distrito VALUES ('1544', '154', 'SUYO', '200210');
INSERT INTO distrito VALUES ('1545', '155', 'HUANCABAMBA', '200301');
INSERT INTO distrito VALUES ('1546', '155', 'CANCHAQUE', '200302');
INSERT INTO distrito VALUES ('1547', '155', 'EL CARMEN DE LA FRONTERA', '200303');
INSERT INTO distrito VALUES ('1548', '155', 'HUARMACA', '200304');
INSERT INTO distrito VALUES ('1549', '155', 'LALAQUIZ', '200305');
INSERT INTO distrito VALUES ('1550', '155', 'SAN MIGUEL DE EL FAIQUE', '200306');
INSERT INTO distrito VALUES ('1551', '155', 'SONDOR', '200307');
INSERT INTO distrito VALUES ('1552', '155', 'SONDORILLO', '200308');
INSERT INTO distrito VALUES ('1553', '156', 'CHULUCANAS', '200401');
INSERT INTO distrito VALUES ('1554', '156', 'BUENOS AIRES', '200402');
INSERT INTO distrito VALUES ('1555', '156', 'CHALACO', '200403');
INSERT INTO distrito VALUES ('1556', '156', 'LA MATANZA', '200404');
INSERT INTO distrito VALUES ('1557', '156', 'MORROPON', '200405');
INSERT INTO distrito VALUES ('1558', '156', 'SALITRAL', '200406');
INSERT INTO distrito VALUES ('1559', '156', 'SAN JUAN DE BIGOTE', '200407');
INSERT INTO distrito VALUES ('1560', '156', 'SANTA CATALINA DE MOSSA', '200408');
INSERT INTO distrito VALUES ('1561', '156', 'SANTO DOMINGO', '200409');
INSERT INTO distrito VALUES ('1562', '156', 'YAMANGO', '200410');
INSERT INTO distrito VALUES ('1563', '157', 'PAITA', '200501');
INSERT INTO distrito VALUES ('1564', '157', 'AMOTAPE', '200502');
INSERT INTO distrito VALUES ('1565', '157', 'ARENAL', '200503');
INSERT INTO distrito VALUES ('1566', '157', 'COLAN', '200504');
INSERT INTO distrito VALUES ('1567', '157', 'LA HUACA', '200505');
INSERT INTO distrito VALUES ('1568', '157', 'TAMARINDO', '200506');
INSERT INTO distrito VALUES ('1569', '157', 'VICHAYAL', '200507');
INSERT INTO distrito VALUES ('1570', '158', 'SULLANA', '200601');
INSERT INTO distrito VALUES ('1571', '158', 'BELLAVISTA', '200602');
INSERT INTO distrito VALUES ('1572', '158', 'IGNACIO ESCUDERO', '200603');
INSERT INTO distrito VALUES ('1573', '158', 'LANCONES', '200604');
INSERT INTO distrito VALUES ('1574', '158', 'MARCAVELICA', '200605');
INSERT INTO distrito VALUES ('1575', '158', 'MIGUEL CHECA', '200606');
INSERT INTO distrito VALUES ('1576', '158', 'QUERECOTILLO', '200607');
INSERT INTO distrito VALUES ('1577', '159', 'PARINAS', '200701');
INSERT INTO distrito VALUES ('1578', '159', 'EL ALTO', '200702');
INSERT INTO distrito VALUES ('1579', '159', 'LA BREA', '200703');
INSERT INTO distrito VALUES ('1580', '159', 'LOBITOS', '200704');
INSERT INTO distrito VALUES ('1581', '159', 'LOS ORGANOS', '200705');
INSERT INTO distrito VALUES ('1582', '159', 'MANCORA', '200706');
INSERT INTO distrito VALUES ('1583', '160', 'SECHURA', '200801');
INSERT INTO distrito VALUES ('1584', '160', 'BELLAVISTA DE LA UNION', '200802');
INSERT INTO distrito VALUES ('1585', '160', 'BERNAL', '200803');
INSERT INTO distrito VALUES ('1586', '160', 'CRISTO NOS VALGA', '200804');
INSERT INTO distrito VALUES ('1587', '160', 'VICE', '200805');
INSERT INTO distrito VALUES ('1588', '160', 'RINCONADA LLICUAR', '200806');
INSERT INTO distrito VALUES ('1589', '161', 'PUNO', '210101');
INSERT INTO distrito VALUES ('1590', '161', 'ACORA', '210102');
INSERT INTO distrito VALUES ('1591', '161', 'AMANTANI', '210103');
INSERT INTO distrito VALUES ('1592', '161', 'ATUNCOLLA', '210104');
INSERT INTO distrito VALUES ('1593', '161', 'CAPACHICA', '210105');
INSERT INTO distrito VALUES ('1594', '161', 'CHUCUITO', '210106');
INSERT INTO distrito VALUES ('1595', '161', 'COATA', '210107');
INSERT INTO distrito VALUES ('1596', '161', 'HUATA', '210108');
INSERT INTO distrito VALUES ('1597', '161', 'MANAZO', '210109');
INSERT INTO distrito VALUES ('1598', '161', 'PAUCARCOLLA', '210110');
INSERT INTO distrito VALUES ('1599', '161', 'PICHACANI', '210111');
INSERT INTO distrito VALUES ('1600', '161', 'PLATERIA', '210112');
INSERT INTO distrito VALUES ('1601', '161', 'SAN ANTONIO', '210113');
INSERT INTO distrito VALUES ('1602', '161', 'TIQUILLACA', '210114');
INSERT INTO distrito VALUES ('1603', '162', 'AZANGARO', '210201');
INSERT INTO distrito VALUES ('1604', '162', 'ACHAYA', '210202');
INSERT INTO distrito VALUES ('1605', '162', 'ARAPA', '210203');
INSERT INTO distrito VALUES ('1606', '162', 'ASILLO', '210204');
INSERT INTO distrito VALUES ('1607', '162', 'CAMINACA', '210205');
INSERT INTO distrito VALUES ('1608', '162', 'CHUPA', '210206');
INSERT INTO distrito VALUES ('1609', '162', 'JOSE DOMINGO CHOQUEHUANCA', '210207');
INSERT INTO distrito VALUES ('1610', '162', 'MUNANI', '210208');
INSERT INTO distrito VALUES ('1611', '162', 'POTONI', '210209');
INSERT INTO distrito VALUES ('1612', '162', 'SAMAN', '210210');
INSERT INTO distrito VALUES ('1613', '162', 'SAN ANTON', '210211');
INSERT INTO distrito VALUES ('1614', '162', 'SAN JOSE', '210212');
INSERT INTO distrito VALUES ('1615', '162', 'SAN JUAN DE SALINAS', '210213');
INSERT INTO distrito VALUES ('1616', '162', 'SANTIAGO DE PUPUJA', '210214');
INSERT INTO distrito VALUES ('1617', '162', 'TIRAPATA', '210215');
INSERT INTO distrito VALUES ('1618', '163', 'MACUSANI', '210301');
INSERT INTO distrito VALUES ('1619', '163', 'AJOYANI', '210302');
INSERT INTO distrito VALUES ('1620', '163', 'AYAPATA', '210303');
INSERT INTO distrito VALUES ('1621', '163', 'COASA', '210304');
INSERT INTO distrito VALUES ('1622', '163', 'CORANI', '210305');
INSERT INTO distrito VALUES ('1623', '163', 'CRUCERO', '210306');
INSERT INTO distrito VALUES ('1624', '163', 'ITUATA', '210307');
INSERT INTO distrito VALUES ('1625', '163', 'OLLACHEA', '210308');
INSERT INTO distrito VALUES ('1626', '163', 'SAN GABAN', '210309');
INSERT INTO distrito VALUES ('1627', '163', 'USICAYOS', '210310');
INSERT INTO distrito VALUES ('1628', '164', 'JULI', '210401');
INSERT INTO distrito VALUES ('1629', '164', 'DESAGUADERO', '210402');
INSERT INTO distrito VALUES ('1630', '164', 'HUACULLANI', '210403');
INSERT INTO distrito VALUES ('1631', '164', 'KELLUYO', '210404');
INSERT INTO distrito VALUES ('1632', '164', 'PISACOMA', '210405');
INSERT INTO distrito VALUES ('1633', '164', 'POMATA', '210406');
INSERT INTO distrito VALUES ('1634', '164', 'ZEPITA', '210407');
INSERT INTO distrito VALUES ('1635', '165', 'ILAVE', '210501');
INSERT INTO distrito VALUES ('1636', '165', 'CAPAZO', '210502');
INSERT INTO distrito VALUES ('1637', '165', 'PILCUYO', '210503');
INSERT INTO distrito VALUES ('1638', '165', 'SANTA ROSA', '210504');
INSERT INTO distrito VALUES ('1639', '165', 'CONDURIRI', '210505');
INSERT INTO distrito VALUES ('1640', '166', 'HUANCANE', '210601');
INSERT INTO distrito VALUES ('1641', '166', 'COJATA', '210602');
INSERT INTO distrito VALUES ('1642', '166', 'HUATASANI', '210603');
INSERT INTO distrito VALUES ('1643', '166', 'INCHUPALLA', '210604');
INSERT INTO distrito VALUES ('1644', '166', 'PUSI', '210605');
INSERT INTO distrito VALUES ('1645', '166', 'ROSASPATA', '210606');
INSERT INTO distrito VALUES ('1646', '166', 'TARACO', '210607');
INSERT INTO distrito VALUES ('1647', '166', 'VILQUE CHICO', '210608');
INSERT INTO distrito VALUES ('1648', '167', 'LAMPA', '210701');
INSERT INTO distrito VALUES ('1649', '167', 'CABANILLA', '210702');
INSERT INTO distrito VALUES ('1650', '167', 'CALAPUJA', '210703');
INSERT INTO distrito VALUES ('1651', '167', 'NICASIO', '210704');
INSERT INTO distrito VALUES ('1652', '167', 'OCUVIRI', '210705');
INSERT INTO distrito VALUES ('1653', '167', 'PALCA', '210706');
INSERT INTO distrito VALUES ('1654', '167', 'PARATIA', '210707');
INSERT INTO distrito VALUES ('1655', '167', 'PUCARA', '210708');
INSERT INTO distrito VALUES ('1656', '167', 'SANTA LUCIA', '210709');
INSERT INTO distrito VALUES ('1657', '167', 'VILAVILA', '210710');
INSERT INTO distrito VALUES ('1658', '168', 'AYAVIRI', '210801');
INSERT INTO distrito VALUES ('1659', '168', 'ANTAUTA', '210802');
INSERT INTO distrito VALUES ('1660', '168', 'CUPI', '210803');
INSERT INTO distrito VALUES ('1661', '168', 'LLALLI', '210804');
INSERT INTO distrito VALUES ('1662', '168', 'MACARI', '210805');
INSERT INTO distrito VALUES ('1663', '168', 'NUNOA', '210806');
INSERT INTO distrito VALUES ('1664', '168', 'ORURILLO', '210807');
INSERT INTO distrito VALUES ('1665', '168', 'SANTA ROSA', '210808');
INSERT INTO distrito VALUES ('1666', '168', 'UMACHIRI', '210809');
INSERT INTO distrito VALUES ('1667', '169', 'MOHO', '210901');
INSERT INTO distrito VALUES ('1668', '169', 'CONIMA', '210902');
INSERT INTO distrito VALUES ('1669', '169', 'HUAYRAPATA', '210903');
INSERT INTO distrito VALUES ('1670', '169', 'TILALI', '210904');
INSERT INTO distrito VALUES ('1671', '170', 'PUTINA', '211001');
INSERT INTO distrito VALUES ('1672', '170', 'ANANEA', '211002');
INSERT INTO distrito VALUES ('1673', '170', 'PEDRO VILCA APAZA', '211003');
INSERT INTO distrito VALUES ('1674', '170', 'QUILCAPUNCU', '211004');
INSERT INTO distrito VALUES ('1675', '170', 'SINA', '211005');
INSERT INTO distrito VALUES ('1676', '171', 'JULIACA', '211101');
INSERT INTO distrito VALUES ('1677', '171', 'CABANA', '211102');
INSERT INTO distrito VALUES ('1678', '171', 'CABANILLAS', '211103');
INSERT INTO distrito VALUES ('1679', '171', 'CARACOTO', '211104');
INSERT INTO distrito VALUES ('1680', '172', 'SANDIA', '211201');
INSERT INTO distrito VALUES ('1681', '172', 'CUYOCUYO', '211202');
INSERT INTO distrito VALUES ('1682', '172', 'LIMBANI', '211203');
INSERT INTO distrito VALUES ('1683', '172', 'PATAMBUCO', '211204');
INSERT INTO distrito VALUES ('1684', '172', 'PHARA', '211205');
INSERT INTO distrito VALUES ('1685', '172', 'QUIACA', '211206');
INSERT INTO distrito VALUES ('1686', '172', 'SAN JUAN DEL ORO', '211207');
INSERT INTO distrito VALUES ('1687', '172', 'YANAHUAYA', '211208');
INSERT INTO distrito VALUES ('1688', '172', 'ALTO INANBARI', '211209');
INSERT INTO distrito VALUES ('1689', '173', 'YUNGUYO', '211301');
INSERT INTO distrito VALUES ('1690', '173', 'ANAPIA', '211302');
INSERT INTO distrito VALUES ('1691', '173', 'COPANI', '211303');
INSERT INTO distrito VALUES ('1692', '173', 'CUTURAPI', '211304');
INSERT INTO distrito VALUES ('1693', '173', 'OLLARAYA', '211305');
INSERT INTO distrito VALUES ('1694', '173', 'TINICACHI', '211306');
INSERT INTO distrito VALUES ('1695', '173', 'UNICACHI', '211307');
INSERT INTO distrito VALUES ('1696', '174', 'MOYOBAMBA', '220101');
INSERT INTO distrito VALUES ('1697', '174', 'CALZADA', '220102');
INSERT INTO distrito VALUES ('1698', '174', 'HANABA', '220103');
INSERT INTO distrito VALUES ('1699', '174', 'JEPELACIO', '220104');
INSERT INTO distrito VALUES ('1700', '174', 'SORITOR', '220105');
INSERT INTO distrito VALUES ('1701', '174', 'YANTALO', '220106');
INSERT INTO distrito VALUES ('1702', '175', 'BELLAVISTA', '220201');
INSERT INTO distrito VALUES ('1703', '175', 'ALTO BIAVO', '220202');
INSERT INTO distrito VALUES ('1704', '175', 'BAJO BIAVO', '220203');
INSERT INTO distrito VALUES ('1705', '175', 'HUALLAGA', '220204');
INSERT INTO distrito VALUES ('1706', '175', 'SAN PABLO', '220205');
INSERT INTO distrito VALUES ('1707', '175', 'SAN RAFAEL', '220206');
INSERT INTO distrito VALUES ('1708', '176', 'SAN JOSE DE SISA', '220301');
INSERT INTO distrito VALUES ('1709', '176', 'AGUA BLANCA', '220302');
INSERT INTO distrito VALUES ('1710', '176', 'SAN MARTIN', '220303');
INSERT INTO distrito VALUES ('1711', '176', 'SANTA ROSA', '220304');
INSERT INTO distrito VALUES ('1712', '176', 'SHATOJA', '220305');
INSERT INTO distrito VALUES ('1713', '177', 'SAPOSOA', '220401');
INSERT INTO distrito VALUES ('1714', '177', 'ALTO SAPOSOA', '220402');
INSERT INTO distrito VALUES ('1715', '177', 'EL ESLABON', '220403');
INSERT INTO distrito VALUES ('1716', '177', 'PISCOYACU', '220404');
INSERT INTO distrito VALUES ('1717', '177', 'SACANCHE', '220405');
INSERT INTO distrito VALUES ('1718', '177', 'TINGO DE SAPOSOA', '220406');
INSERT INTO distrito VALUES ('1719', '178', 'LAMAS', '220501');
INSERT INTO distrito VALUES ('1720', '178', 'ALONSO DE ALVARADO', '220502');
INSERT INTO distrito VALUES ('1721', '178', 'BARRANQUITA', '220503');
INSERT INTO distrito VALUES ('1722', '178', 'CAYNARACHI', '220504');
INSERT INTO distrito VALUES ('1723', '178', 'CUNUMBUQUI', '220505');
INSERT INTO distrito VALUES ('1724', '178', 'PINTO RECODO', '220506');
INSERT INTO distrito VALUES ('1725', '178', 'RUMISAPA', '220507');
INSERT INTO distrito VALUES ('1726', '178', 'SAN ROQUE DE CUMBAZA', '220508');
INSERT INTO distrito VALUES ('1727', '178', 'SHANAO', '220509');
INSERT INTO distrito VALUES ('1728', '178', 'TABALOSOS', '220510');
INSERT INTO distrito VALUES ('1729', '178', 'ZAPATERO', '220511');
INSERT INTO distrito VALUES ('1730', '179', 'JUANJUI', '220601');
INSERT INTO distrito VALUES ('1731', '179', 'CAMPANILLA', '220602');
INSERT INTO distrito VALUES ('1732', '179', 'HUICUNGO', '220603');
INSERT INTO distrito VALUES ('1733', '179', 'PACHIZA', '220604');
INSERT INTO distrito VALUES ('1734', '179', 'PAJARILLO', '220605');
INSERT INTO distrito VALUES ('1735', '180', 'PICOTA', '220701');
INSERT INTO distrito VALUES ('1736', '180', 'BUENOS AIRES', '220702');
INSERT INTO distrito VALUES ('1737', '180', 'CASPISAPA', '220703');
INSERT INTO distrito VALUES ('1738', '180', 'PILLUANA', '220704');
INSERT INTO distrito VALUES ('1739', '180', 'PUCACACA', '220705');
INSERT INTO distrito VALUES ('1740', '180', 'SAN CRISTOBAL', '220706');
INSERT INTO distrito VALUES ('1741', '180', 'SAN HILARION', '220707');
INSERT INTO distrito VALUES ('1742', '180', 'SHAMBOYACU', '220708');
INSERT INTO distrito VALUES ('1743', '180', 'TINGO DE PONASA', '220709');
INSERT INTO distrito VALUES ('1744', '180', 'TRES UNIDOS', '220710');
INSERT INTO distrito VALUES ('1745', '181', 'RIOJA', '220801');
INSERT INTO distrito VALUES ('1746', '181', 'AWAJUN', '220802');
INSERT INTO distrito VALUES ('1747', '181', 'ELIAS SOPLIN VARGAS', '220803');
INSERT INTO distrito VALUES ('1748', '181', 'NUEVA CAJAMARCA', '220804');
INSERT INTO distrito VALUES ('1749', '181', 'PARDO MIGUEL', '220805');
INSERT INTO distrito VALUES ('1750', '181', 'POSIC', '220806');
INSERT INTO distrito VALUES ('1751', '181', 'SAN FERNANDO', '220807');
INSERT INTO distrito VALUES ('1752', '181', 'YORONGOS', '220808');
INSERT INTO distrito VALUES ('1753', '181', 'YURACYACU', '220809');
INSERT INTO distrito VALUES ('1754', '182', 'TARAPOTO', '220901');
INSERT INTO distrito VALUES ('1755', '182', 'ALBERTO LEVEAU', '220902');
INSERT INTO distrito VALUES ('1756', '182', 'CACATACHI', '220903');
INSERT INTO distrito VALUES ('1757', '182', 'CHAZUTA', '220904');
INSERT INTO distrito VALUES ('1758', '182', 'CHIPURANA', '220905');
INSERT INTO distrito VALUES ('1759', '182', 'EL PORVENIR', '220906');
INSERT INTO distrito VALUES ('1760', '182', 'HUIMBAYOC', '220907');
INSERT INTO distrito VALUES ('1761', '182', 'JUAN GUERRA', '220908');
INSERT INTO distrito VALUES ('1762', '182', 'LA BANDA DE SHILCAYO', '220909');
INSERT INTO distrito VALUES ('1763', '182', 'MORALES', '220910');
INSERT INTO distrito VALUES ('1764', '182', 'PAPAPLAYA', '220911');
INSERT INTO distrito VALUES ('1765', '182', 'SAN ANTONIO', '220912');
INSERT INTO distrito VALUES ('1766', '182', 'SAUCE', '220913');
INSERT INTO distrito VALUES ('1767', '183', 'TOCACHE', '221001');
INSERT INTO distrito VALUES ('1768', '183', 'NUEVO PROGRESO', '221002');
INSERT INTO distrito VALUES ('1769', '183', 'POLVORA', '221003');
INSERT INTO distrito VALUES ('1770', '183', 'SHUNTE', '221004');
INSERT INTO distrito VALUES ('1771', '183', 'UCHIZA', '221005');
INSERT INTO distrito VALUES ('1772', '184', 'TACNA', '230101');
INSERT INTO distrito VALUES ('1773', '184', 'ALTO DE LA ALIANZA', '230102');
INSERT INTO distrito VALUES ('1774', '184', 'CALANA', '230103');
INSERT INTO distrito VALUES ('1775', '184', 'CIUDAD NUEVA', '230104');
INSERT INTO distrito VALUES ('1776', '184', 'INCLAN', '230105');
INSERT INTO distrito VALUES ('1777', '184', 'PACHIA', '230106');
INSERT INTO distrito VALUES ('1778', '184', 'PALCA', '230107');
INSERT INTO distrito VALUES ('1779', '184', 'POCOLLAY', '230108');
INSERT INTO distrito VALUES ('1780', '184', 'SAMA', '230109');
INSERT INTO distrito VALUES ('1781', '184', 'CORONEL GREGORIO ALBARRACIN LAN', '230110');
INSERT INTO distrito VALUES ('1782', '185', 'CANDARAVE', '230201');
INSERT INTO distrito VALUES ('1783', '185', 'CAIRANI', '230202');
INSERT INTO distrito VALUES ('1784', '185', 'CAMILACA', '230203');
INSERT INTO distrito VALUES ('1785', '185', 'CURIBAYA', '230204');
INSERT INTO distrito VALUES ('1786', '185', 'HUANUARA', '230205');
INSERT INTO distrito VALUES ('1787', '185', 'QUILAHUANI', '230206');
INSERT INTO distrito VALUES ('1788', '186', 'LOCUMBA', '230301');
INSERT INTO distrito VALUES ('1789', '186', 'ILABAYA', '230302');
INSERT INTO distrito VALUES ('1790', '186', 'ITE', '230303');
INSERT INTO distrito VALUES ('1791', '187', 'TARATA', '230401');
INSERT INTO distrito VALUES ('1792', '187', 'HEROES ALBARRACIN', '230402');
INSERT INTO distrito VALUES ('1793', '187', 'ESTIQUE', '230403');
INSERT INTO distrito VALUES ('1794', '187', 'ESTIQUE-PAMPA', '230404');
INSERT INTO distrito VALUES ('1795', '187', 'SITAJARA', '230405');
INSERT INTO distrito VALUES ('1796', '187', 'SUSAPAYA', '230406');
INSERT INTO distrito VALUES ('1797', '187', 'TARUCACHI', '230407');
INSERT INTO distrito VALUES ('1798', '187', 'TICACO', '230408');
INSERT INTO distrito VALUES ('1799', '188', 'TUMBES', '240101');
INSERT INTO distrito VALUES ('1800', '188', 'CORRALES', '240102');
INSERT INTO distrito VALUES ('1801', '188', 'LA CRUZ', '240103');
INSERT INTO distrito VALUES ('1802', '188', 'PAMPAS DE HOSPITAL', '240104');
INSERT INTO distrito VALUES ('1803', '188', 'SAN JACINTO', '240105');
INSERT INTO distrito VALUES ('1804', '188', 'SAN JUAN DE LA VIRGEN', '240106');
INSERT INTO distrito VALUES ('1805', '189', 'ZORRITOS', '240201');
INSERT INTO distrito VALUES ('1806', '189', 'CASITAS', '240202');
INSERT INTO distrito VALUES ('1807', '189', 'CANOAS DE PUNTA SAL', '240203');
INSERT INTO distrito VALUES ('1808', '190', 'ZARUMILLA', '240301');
INSERT INTO distrito VALUES ('1809', '190', 'AGUAS VERDES', '240302');
INSERT INTO distrito VALUES ('1810', '190', 'MATAPALO', '240303');
INSERT INTO distrito VALUES ('1811', '190', 'PAPAYAL', '240304');
INSERT INTO distrito VALUES ('1812', '191', 'CALLERIA', '250101');
INSERT INTO distrito VALUES ('1813', '191', 'CAMPOVERDE', '250102');
INSERT INTO distrito VALUES ('1814', '191', 'IPARIA', '250103');
INSERT INTO distrito VALUES ('1815', '191', 'MASISEA', '250104');
INSERT INTO distrito VALUES ('1816', '191', 'YARINACOCHA', '250105');
INSERT INTO distrito VALUES ('1817', '191', 'NUEVA REQUENA', '250106');
INSERT INTO distrito VALUES ('1818', '192', 'RAYMONDI', '250201');
INSERT INTO distrito VALUES ('1819', '192', 'SEPAHUA', '250202');
INSERT INTO distrito VALUES ('1820', '192', 'TAHUANIA', '250203');
INSERT INTO distrito VALUES ('1821', '192', 'YURUA', '250204');
INSERT INTO distrito VALUES ('1822', '193', 'PADRE ABAD', '250301');
INSERT INTO distrito VALUES ('1823', '193', 'IRAZOLA', '250302');
INSERT INTO distrito VALUES ('1824', '193', 'CURIMANA', '250303');
INSERT INTO distrito VALUES ('1825', '194', 'PURUS', '250401');
INSERT INTO distrito VALUES ('1826', '84', 'COSME', '090511');
INSERT INTO distrito VALUES ('1827', '2', 'LA PECA', '010206');
INSERT INTO distrito VALUES ('1828', '86', 'QUICHUAS', '090719');
INSERT INTO distrito VALUES ('1829', '133', 'SANTA CRUZ DE COCACHACRA', '150727');
INSERT INTO distrito VALUES ('1830', '196', 'PUTUMAYO', '160801');
INSERT INTO distrito VALUES ('1831', '158', 'SALITRAL', '200608');
INSERT INTO distrito VALUES ('1832', '161', 'VILQUE', '210115');
INSERT INTO distrito VALUES ('1833', '184', 'LA YARADA LOS PALOS', '230111');
INSERT INTO distrito VALUES ('1834', '182', 'SHAPAJA', '220914');
INSERT INTO distrito VALUES ('1835', '191', 'MANANTAY', '250107');
INSERT INTO distrito VALUES ('1836', '29', 'JOSE MARIA ARGUEDAS', '030220');
INSERT INTO distrito VALUES ('1837', '33', 'ROCCHACC', '030609');
INSERT INTO distrito VALUES ('1838', '33', 'EL PORVENIR', '030610');
INSERT INTO distrito VALUES ('1839', '33', 'LOS CHANKAS', '030611');
INSERT INTO distrito VALUES ('1840', '42', 'ANDRES AVELINO CACERES DORREGARAY', '050116');
INSERT INTO distrito VALUES ('1841', '45', 'CANAYRE', '050409');
INSERT INTO distrito VALUES ('1842', '45', 'UCHURACCAY', '050410');
INSERT INTO distrito VALUES ('1843', '45', 'PUCACOLPA', '050411');
INSERT INTO distrito VALUES ('1844', '45', 'CHACA', '050412');
INSERT INTO distrito VALUES ('1845', '46', 'SAMUGARI', '050509');
INSERT INTO distrito VALUES ('1846', '46', 'ANCHIHUAY', '050510');
INSERT INTO distrito VALUES ('1847', '46', 'ORONCCOY', '050511');
INSERT INTO distrito VALUES ('1848', '66', 'MI PERU', '070107');
INSERT INTO distrito VALUES ('1849', '69', 'ZURITE', '080309');
INSERT INTO distrito VALUES ('1850', '75', 'INCAWASI', '080911');
INSERT INTO distrito VALUES ('1851', '75', 'VILLA VIRGEN', '080912');
INSERT INTO distrito VALUES ('1852', '75', 'VILLA KINTIARINA', '080913');
INSERT INTO distrito VALUES ('1853', '75', 'MEGANTONI', '080914');
INSERT INTO distrito VALUES ('1854', '86', 'ANDAYMARCA', '090720');
INSERT INTO distrito VALUES ('1855', '86', 'ROBLE', '090721');
INSERT INTO distrito VALUES ('1856', '86', 'PICHOS', '090722');
INSERT INTO distrito VALUES ('1857', '86', 'SANTIAGO DE TUCUMA', '090723');
INSERT INTO distrito VALUES ('1858', '87', 'YACUS', '100112');
INSERT INTO distrito VALUES ('1859', '87', 'SAN PABLO DE PILLAO', '100113');
INSERT INTO distrito VALUES ('1860', '92', 'PUCAYACU', '100607');
INSERT INTO distrito VALUES ('1861', '92', 'CASTILLO GRANDE', '100608');
INSERT INTO distrito VALUES ('1862', '92', 'PUEBLO NUEVO', '100609');
INSERT INTO distrito VALUES ('1863', '92', 'SANTO DOMINGO DE ANDA', '100610');
INSERT INTO distrito VALUES ('1864', '93', 'LA MORADA', '100704');
INSERT INTO distrito VALUES ('1865', '93', 'SANTA ROSA DE ALTO YANAJANCA', '100705');
INSERT INTO distrito VALUES ('1866', '108', 'VIZCATAN DEL ENE', '120609');
INSERT INTO distrito VALUES ('1867', '196', 'ROSA PANDURO', '160802');
INSERT INTO distrito VALUES ('1868', '196', 'TENIENTE MANUEL CLAVERO', '160803');
INSERT INTO distrito VALUES ('1869', '196', 'YAGUAS', '160804');
INSERT INTO distrito VALUES ('1870', '152', 'CONSTITUCION', '190308');
INSERT INTO distrito VALUES ('1871', '153', 'VEINTISEIS DE OCTUBRE', '200115');
INSERT INTO distrito VALUES ('1872', '171', 'SAN MIGUEL', '211105');
INSERT INTO distrito VALUES ('1873', '172', 'SAN PEDRO DE PUTINA PUNCO', '211210');
INSERT INTO distrito VALUES ('1874', '193', 'NESHUYA', '250304');
INSERT INTO distrito VALUES ('1875', '193', 'ALEXANDER VON HUMBOLDT', '250305');
-- 
--  Table structure for table `entorno`
-- 

CREATE TABLE `entorno` (
  `identorno` int(10) unsigned NOT NULL,
  `idfamilia` int(10) unsigned DEFAULT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `codentorno` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`identorno`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `entorno`

-- 
--  Table structure for table `entornoh`
-- 

CREATE TABLE `entornoh` (
  `identornoH` int(10) unsigned NOT NULL,
  `idfamiliaH` int(10) unsigned DEFAULT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`identornoH`,`claveGeneral`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- Dumping data for table `entornoh`

-- 
--  Table structure for table `episodio`
-- 

CREATE TABLE `episodio` (
  `idepisodio` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idpersona` int(10) unsigned DEFAULT NULL,
  `claseAtencion` varchar(100) DEFAULT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `idcatalogoUPS` int(10) unsigned DEFAULT NULL,
  `nombreCatalogo` text,
  `situacion` varchar(100) DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `nombreEpisodio` varchar(100) DEFAULT NULL,
  `estadoEpisodio` varchar(100) DEFAULT NULL,
  `medioAcceso` varchar(100) DEFAULT NULL,
  `procedencia` varchar(100) DEFAULT NULL,
  `acompanante` varchar(100) DEFAULT NULL,
  `parentesco` varchar(100) DEFAULT NULL,
  `motivoConsulta` text,
  `sintomas` text,
  `sindromeCultura` text,
  `tiempoEnfermedad` int(10) unsigned DEFAULT NULL,
  `detalleTiempo` varchar(10) DEFAULT NULL,
  `semanaEpidemiologica` int(10) unsigned DEFAULT NULL,
  `opcionSemanaGestacional` varchar(10) DEFAULT NULL,
  `semanaGestacional` int(10) unsigned DEFAULT NULL,
  `sueno` varchar(50) DEFAULT NULL,
  `sed` varchar(50) DEFAULT NULL,
  `animo` varchar(50) DEFAULT NULL,
  `apetito` varchar(50) DEFAULT NULL,
  `orina` varchar(50) DEFAULT NULL,
  `deposiciones` varchar(50) DEFAULT NULL,
  `frecuenciaDeposiciones` int(10) unsigned DEFAULT NULL,
  `horaDiaDeposiciones` varchar(10) DEFAULT NULL,
  `perdidaPeso` char(2) DEFAULT NULL,
  `detallePesoKilos` int(10) unsigned DEFAULT NULL,
  `opcionPesoTiempo` varchar(10) DEFAULT NULL,
  `detallePesoTiempo` int(10) unsigned DEFAULT NULL,
  `tos` char(2) DEFAULT NULL,
  PRIMARY KEY (`idepisodio`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `episodio`

-- 
--  Table structure for table `equivalenciascodigo`
-- 

CREATE TABLE `equivalenciascodigo` (
  `idequivalenciasCodigo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idepisodio` int(10) unsigned DEFAULT NULL,
  `idcatalogoPrestacion` int(10) unsigned NOT NULL,
  `codigoCPT` varchar(100) DEFAULT NULL,
  `ophierro` char(2) DEFAULT NULL,
  `opmultimicronutriente` char(2) DEFAULT NULL,
  `opvitamina` char(2) DEFAULT NULL,
  `variableLAB` varchar(100) DEFAULT NULL,
  `tipoDiag` varchar(100) DEFAULT NULL,
  `codigoSIS` int(10) unsigned DEFAULT NULL,
  `codigoCIE10` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idequivalenciasCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `equivalenciascodigo`

-- 
--  Table structure for table `establecimiento`
-- 

CREATE TABLE `establecimiento` (
  `idestablecimiento` int(10) unsigned NOT NULL,
  `idnucleo` int(10) unsigned DEFAULT NULL,
  `iddistrito` int(10) unsigned DEFAULT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `nombreEstablecimiento` varchar(100) DEFAULT NULL,
  `tipo` char(3) DEFAULT NULL,
  `denominacion` varchar(50) NOT NULL,
  `aisped` int(11) NOT NULL,
  `nivel` varchar(50) NOT NULL,
  `tipoNucleo` int(11) NOT NULL,
  `codigoRegion` char(2) NOT NULL,
  `codigoProvincia` char(5) NOT NULL,
  `codigoDistrito` char(8) NOT NULL,
  `codigoDiresa` char(3) NOT NULL,
  `codigoRed` char(3) NOT NULL,
  `codigoMicrored` char(3) NOT NULL,
  `codigoNucleo` char(3) NOT NULL,
  PRIMARY KEY (`idestablecimiento`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `establecimiento`

INSERT INTO establecimiento VALUES ('1', '0', '790', '000003853', 'DPTAL.DE HUANCAVELICA', 'I-3', 'HOSPITAL', '0', '3', '1', '09', '0901', '090101', '13', '01', '00', '00');
INSERT INTO establecimiento VALUES ('2', '1', '790', '000003855', 'CALLQUI CHICO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090101', '13', '01', '01', '01');
INSERT INTO establecimiento VALUES ('3', '1', '790', '000003856', 'SACSAMARCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090101', '13', '01', '01', '01');
INSERT INTO establecimiento VALUES ('4', '14', '790', '000003859', 'SANTA ANA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0901', '090101', '13', '01', '11', '02');
INSERT INTO establecimiento VALUES ('5', '14', '790', '000003860', 'PUEBLO LIBRE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090101', '13', '01', '11', '02');
INSERT INTO establecimiento VALUES ('6', '102', '790', '000003861', 'SAN CRISTOBAL', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0901', '090101', '13', '01', '11', '58');
INSERT INTO establecimiento VALUES ('7', '102', '790', '000003863', 'ANTACCOCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090101', '13', '01', '11', '58');
INSERT INTO establecimiento VALUES ('8', '14', '790', '000011206', 'PAMPACHACRA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090101', '13', '01', '11', '02');
INSERT INTO establecimiento VALUES ('9', '1', '790', '000011350', 'SAN GERONIMO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090101', '13', '01', '01', '01');
INSERT INTO establecimiento VALUES ('10', '10', '791', '000003910', 'VINAS', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0901', '090102', '13', '01', '06', '09');
INSERT INTO establecimiento VALUES ('11', '10', '791', '000003911', 'SAN JOSE DE ACOBAMBILLA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090102', '13', '01', '06', '09');
INSERT INTO establecimiento VALUES ('12', '10', '791', '000003912', 'ANCCAPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090102', '13', '01', '06', '09');
INSERT INTO establecimiento VALUES ('13', '10', '791', '000003913', 'SAN MIGUEL DE ACOBAMBILLA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090102', '13', '01', '06', '09');
INSERT INTO establecimiento VALUES ('14', '10', '791', '000003914', 'SAN JOSE DE PUITUCO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090102', '13', '01', '01', '01');
INSERT INTO establecimiento VALUES ('15', '1', '791', '000003915', 'TELAPACCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090102', '13', '01', '01', '01');
INSERT INTO establecimiento VALUES ('16', '12', '792', '000003864', 'ACORIA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0901', '090103', '13', '01', '07', '11');
INSERT INTO establecimiento VALUES ('17', '13', '792', '000003865', 'ANANCUSI', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0901', '090103', '13', '01', '07', '55');
INSERT INTO establecimiento VALUES ('18', '5', '792', '000003873', 'AYACCOCHA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0901', '090103', '13', '01', '03', '05');
INSERT INTO establecimiento VALUES ('19', '5', '792', '000003874', 'ACHAPATA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090103', '13', '01', '03', '05');
INSERT INTO establecimiento VALUES ('20', '12', '792', '000003866', 'ANTAYMISA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090103', '13', '01', '07', '11');
INSERT INTO establecimiento VALUES ('21', '5', '792', '000003877', 'CCACCASIRI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090103', '13', '01', '03', '05');
INSERT INTO establecimiento VALUES ('22', '12', '792', '000003872', 'CCARHUARANRA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090103', '13', '01', '07', '11');
INSERT INTO establecimiento VALUES ('23', '8', '792', '000003895', 'CCOSNIPUQUIO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090103', '13', '01', '05', '07');
INSERT INTO establecimiento VALUES ('24', '12', '792', '000003867', 'CHAYNAPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090103', '13', '01', '07', '11');
INSERT INTO establecimiento VALUES ('25', '8', '792', '000003896', 'CHUPACA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090103', '13', '01', '05', '07');
INSERT INTO establecimiento VALUES ('26', '12', '792', '000003871', 'CONCHAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090103', '13', '01', '07', '11');
INSERT INTO establecimiento VALUES ('27', '5', '792', '000003876', 'HUANASPAMPA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090103', '13', '01', '03', '05');
INSERT INTO establecimiento VALUES ('28', '8', '792', '000011197', 'JOSE CARLOS MARIATEGUI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090103', '13', '01', '05', '07');
INSERT INTO establecimiento VALUES ('29', '5', '792', '000011209', 'LAIMINA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090103', '13', '01', '03', '05');
INSERT INTO establecimiento VALUES ('30', '12', '792', '000003870', 'LIRIO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090103', '13', '01', '07', '11');
INSERT INTO establecimiento VALUES ('31', '12', '792', '000007341', 'LLAHUECC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090103', '13', '01', '07', '11');
INSERT INTO establecimiento VALUES ('32', '5', '792', '000003875', 'LOS ANGELES DE CCARAHUASA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090103', '13', '01', '03', '05');
INSERT INTO establecimiento VALUES ('33', '12', '792', '000003868', 'MOTOY', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090103', '13', '01', '07', '11');
INSERT INTO establecimiento VALUES ('34', '13', '792', '000003869', 'PALLALLA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090103', '13', '01', '07', '55');
INSERT INTO establecimiento VALUES ('35', '5', '792', '000003878', 'PUCACCOCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090103', '13', '01', '03', '05');
INSERT INTO establecimiento VALUES ('36', '5', '792', '000009466', 'QUIMINA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090103', '13', '01', '03', '05');
INSERT INTO establecimiento VALUES ('37', '13', '792', '000009467', 'SAN ANTONIO (ANAYLLA)', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090103', '13', '01', '07', '55');
INSERT INTO establecimiento VALUES ('38', '13', '792', '000009713', 'SAN ISIDRO DE AMPURHUAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090103', '13', '01', '07', '55');
INSERT INTO establecimiento VALUES ('39', '9', '793', '000003904', 'CONAICA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0901', '090104', '13', '01', '05', '08');
INSERT INTO establecimiento VALUES ('40', '8', '794', '000003890', 'CUENCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090105', '13', '01', '05', '07');
INSERT INTO establecimiento VALUES ('41', '9', '794', '000003906', 'LUQUIA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090105', '13', '01', '05', '08');
INSERT INTO establecimiento VALUES ('42', '9', '794', '000003905', 'TOTORA JATUNPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090105', '13', '01', '05', '08');
INSERT INTO establecimiento VALUES ('43', '1', '795', '000003857', 'HUACHOCOLPA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090106', '13', '01', '01', '01');
INSERT INTO establecimiento VALUES ('44', '11', '796', '000004117', 'HUAYLLAHUARA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090107', '13', '01', '06', '10');
INSERT INTO establecimiento VALUES ('45', '8', '797', '000003889', 'IZCUCHACA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0901', '090108', '13', '01', '05', '07');
INSERT INTO establecimiento VALUES ('46', '9', '798', '000003907', 'SAN JOSE DE LARIA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090109', '13', '01', '05', '08');
INSERT INTO establecimiento VALUES ('47', '9', '798', '000003908', 'SAN JOSE DE BELEN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090109', '13', '01', '05', '08');
INSERT INTO establecimiento VALUES ('48', '10', '799', '000003916', 'MANTA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090110', '13', '01', '06', '09');
INSERT INTO establecimiento VALUES ('49', '10', '799', '000007301', 'SANTA ROSA DE MANTA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090110', '13', '01', '06', '09');
INSERT INTO establecimiento VALUES ('50', '10', '799', '000009714', 'COLLPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090110', '13', '01', '06', '09');
INSERT INTO establecimiento VALUES ('51', '8', '800', '000003891', 'MARISCAL CACERES', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090111', '13', '01', '05', '07');
INSERT INTO establecimiento VALUES ('52', '11', '801', '000004115', 'MOYA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0901', '090112', '13', '01', '06', '10');
INSERT INTO establecimiento VALUES ('53', '11', '801', '000004116', 'ISLAYCHUMPI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090112', '13', '01', '06', '10');
INSERT INTO establecimiento VALUES ('54', '101', '802', '000003909', 'NUEVO OCCORO', 'I-3', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090113', '13', '01', '05', '59');
INSERT INTO establecimiento VALUES ('55', '101', '802', '000012644', 'OCCORO VIEJO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090113', '13', '01', '05', '59');
INSERT INTO establecimiento VALUES ('56', '7', '803', '000003902', 'PALCA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0901', '090114', '13', '01', '04', '54');
INSERT INTO establecimiento VALUES ('57', '7', '803', '000003903', 'HUAYANAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090114', '13', '01', '04', '54');
INSERT INTO establecimiento VALUES ('58', '7', '803', '000007342', 'CHILLHUAPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090114', '13', '01', '04', '54');
INSERT INTO establecimiento VALUES ('59', '7', '803', '000011351', 'PUTACCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090114', '13', '01', '04', '54');
INSERT INTO establecimiento VALUES ('60', '11', '804', '000004118', 'PILCHACA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090115', '13', '01', '06', '10');
INSERT INTO establecimiento VALUES ('61', '11', '805', '000004119', 'VILCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090116', '13', '01', '06', '10');
INSERT INTO establecimiento VALUES ('62', '11', '805', '000004120', 'CHAQUICOCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090116', '13', '01', '06', '10');
INSERT INTO establecimiento VALUES ('63', '11', '805', '000004121', 'CHUYA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090116', '13', '01', '06', '10');
INSERT INTO establecimiento VALUES ('64', '11', '805', '000009499', 'CORICOCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090116', '13', '01', '06', '10');
INSERT INTO establecimiento VALUES ('65', '2', '806', '000003879', 'YAULI', 'I-4', 'CENTRO DE SALUD', '0', '1', '1', '09', '0901', '090117', '13', '01', '02', '03');
INSERT INTO establecimiento VALUES ('66', '2', '806', '000003880', 'AMBATO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090117', '13', '01', '02', '03');
INSERT INTO establecimiento VALUES ('67', '14', '806', '000003881', 'SANTA ROSA DE PACHACCLLA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090117', '13', '01', '11', '02');
INSERT INTO establecimiento VALUES ('68', '2', '806', '000003882', 'PUCAPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090117', '13', '01', '02', '03');
INSERT INTO establecimiento VALUES ('69', '2', '806', '000003883', 'UCHCUS - INCANAN', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090117', '13', '01', '02', '03');
INSERT INTO establecimiento VALUES ('70', '3', '806', '000003884', 'CCASAPATA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0901', '090117', '13', '01', '02', '04');
INSERT INTO establecimiento VALUES ('71', '4', '806', '000003885', 'SAN JUAN DE CCARHUACC', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0901', '090117', '13', '01', '02', '53');
INSERT INTO establecimiento VALUES ('72', '3', '806', '000003886', 'SANTA ROSA DE CHOPCCA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090117', '13', '01', '02', '04');
INSERT INTO establecimiento VALUES ('73', '4', '806', '000003887', 'PANTACHI NORTE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090117', '13', '01', '02', '53');
INSERT INTO establecimiento VALUES ('74', '2', '806', '000006821', 'CASTILLAPATA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090117', '13', '01', '02', '03');
INSERT INTO establecimiento VALUES ('75', '4', '806', '000006822', 'PANTACHI SUR', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090117', '13', '01', '02', '53');
INSERT INTO establecimiento VALUES ('76', '3', '806', '000006824', 'CHUCLLACCASA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090117', '13', '01', '02', '04');
INSERT INTO establecimiento VALUES ('77', '2', '806', '000007343', 'ATALLA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090117', '13', '01', '02', '03');
INSERT INTO establecimiento VALUES ('78', '2', '806', '000007406', 'PALTAMACHAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090117', '13', '01', '02', '03');
INSERT INTO establecimiento VALUES ('79', '2', '806', '000007454', 'CHACARILLA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090117', '13', '01', '02', '03');
INSERT INTO establecimiento VALUES ('80', '3', '806', '000011190', 'LOS ANDES DE SOTOPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090117', '13', '01', '02', '04');
INSERT INTO establecimiento VALUES ('81', '4', '806', '000011207', 'HUSNUPATA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090117', '13', '01', '02', '53');
INSERT INTO establecimiento VALUES ('82', '4', '806', '000011208', 'LIMAPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090117', '13', '01', '02', '53');
INSERT INTO establecimiento VALUES ('83', '2', '806', '000012641', 'TACSANA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090117', '13', '01', '02', '03');
INSERT INTO establecimiento VALUES ('84', '1', '807', '000003854', 'ASCENSION', 'I-4', 'CENTRO DE SALUD', '0', '1', '1', '09', '0901', '090118', '13', '01', '01', '01');
INSERT INTO establecimiento VALUES ('85', '6', '808', '000003899', 'HUANDO', 'I-4', 'CENTRO DE SALUD', '0', '1', '1', '09', '0901', '090119', '13', '01', '04', '06');
INSERT INTO establecimiento VALUES ('86', '6', '808', '000003900', 'CACHILLALLAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090119', '13', '01', '04', '06');
INSERT INTO establecimiento VALUES ('87', '6', '808', '000003901', 'TINYACCLLA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090119', '13', '01', '04', '06');
INSERT INTO establecimiento VALUES ('88', '6', '808', '000006820', 'NUEVA ACOBAMBILLA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090119', '13', '01', '04', '06');
INSERT INTO establecimiento VALUES ('89', '6', '808', '000007339', 'SAN JOSE DE MIRAFLORES', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090119', '13', '01', '04', '06');
INSERT INTO establecimiento VALUES ('90', '6', '808', '000007340', 'VISTA ALEGRE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090119', '13', '01', '04', '06');
INSERT INTO establecimiento VALUES ('91', '0', '809', '000003917', 'ACOBAMBA', 'I-4', 'CENTRO DE SALUD', '0', '1', '1', '09', '0902', '090201', '13', '02', '00', '00');
INSERT INTO establecimiento VALUES ('92', '15', '809', '000003918', 'CURIMARAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090201', '13', '02', '01', '12');
INSERT INTO establecimiento VALUES ('93', '15', '809', '000003919', 'POMAVILCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090201', '13', '02', '01', '12');
INSERT INTO establecimiento VALUES ('94', '15', '809', '000003920', 'CCARHUACC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090201', '13', '02', '01', '12');
INSERT INTO establecimiento VALUES ('95', '15', '809', '000003921', 'VILLA RICA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090201', '13', '02', '01', '12');
INSERT INTO establecimiento VALUES ('96', '15', '809', '000003922', 'CCARABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090201', '13', '02', '01', '12');
INSERT INTO establecimiento VALUES ('97', '15', '809', '000009502', 'TRES DE OCTUBRE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090201', '13', '02', '01', '12');
INSERT INTO establecimiento VALUES ('98', '17', '810', '000003934', 'ANDABAMBA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090202', '13', '02', '02', '14');
INSERT INTO establecimiento VALUES ('99', '17', '810', '000003936', 'MAYUNMARCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090202', '13', '02', '02', '14');
INSERT INTO establecimiento VALUES ('100', '17', '810', '000007705', 'HUANCAPITE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090202', '13', '02', '02', '14');
INSERT INTO establecimiento VALUES ('101', '17', '810', '000009513', 'VISTA ALEGRE DE ANDABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090202', '13', '02', '02', '14');
INSERT INTO establecimiento VALUES ('102', '20', '811', '000003939', 'ANTA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0902', '090203', '13', '02', '02', '17');
INSERT INTO establecimiento VALUES ('103', '103', '811', '000003940', 'HUAYANAY', 'I-3', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090203', '13', '02', '02', '17');
INSERT INTO establecimiento VALUES ('104', '20', '811', '000003941', 'MANYACC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090203', '13', '02', '02', '17');
INSERT INTO establecimiento VALUES ('105', '103', '811', '000007292', 'SANCAYPAMPA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090203', '13', '02', '02', '17');
INSERT INTO establecimiento VALUES ('106', '103', '811', '000007455', 'PATACANCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090203', '13', '02', '02', '17');
INSERT INTO establecimiento VALUES ('107', '20', '811', '000009469', 'VISTA ALEGRE DE ANTA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090203', '13', '02', '02', '17');
INSERT INTO establecimiento VALUES ('108', '103', '811', '000009501', 'SAN PEDRO DE NAHUINCUCHO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090203', '13', '02', '02', '17');
INSERT INTO establecimiento VALUES ('109', '103', '811', '000009504', 'TAMBRAICO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090203', '13', '02', '02', '17');
INSERT INTO establecimiento VALUES ('110', '20', '811', '000009697', 'CASACANCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090203', '13', '02', '02', '17');
INSERT INTO establecimiento VALUES ('111', '20', '811', '000011230', 'RAYANNIYOCC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090203', '13', '02', '02', '17');
INSERT INTO establecimiento VALUES ('112', '103', '811', '000011234', 'OCCORO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090203', '13', '02', '02', '17');
INSERT INTO establecimiento VALUES ('113', '16', '812', '000003926', 'CAJA ESPIRITU', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0902', '090204', '13', '02', '01', '13');
INSERT INTO establecimiento VALUES ('114', '16', '812', '000003927', 'POMACANCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090204', '13', '02', '01', '13');
INSERT INTO establecimiento VALUES ('115', '16', '812', '000007389', 'RURUNMARCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090204', '13', '02', '01', '13');
INSERT INTO establecimiento VALUES ('116', '16', '812', '000011225', 'HUANCCALLACO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090204', '13', '02', '01', '13');
INSERT INTO establecimiento VALUES ('117', '16', '813', '000003928', 'MARCAS', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090205', '13', '02', '01', '13');
INSERT INTO establecimiento VALUES ('118', '16', '813', '000003929', 'CUNI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090205', '13', '02', '01', '13');
INSERT INTO establecimiento VALUES ('119', '16', '813', '000011220', 'HUARPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090205', '13', '02', '01', '13');
INSERT INTO establecimiento VALUES ('120', '16', '813', '000011232', 'PALOMA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090205', '13', '02', '01', '13');
INSERT INTO establecimiento VALUES ('121', '3', '814', '000003888', 'CHUNUNAPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090206', '13', '02', '02', '04');
INSERT INTO establecimiento VALUES ('122', '17', '814', '000003930', 'PAUCARA', 'I-4', 'CENTRO DE SALUD', '0', '1', '1', '09', '0902', '090206', '13', '02', '02', '14');
INSERT INTO establecimiento VALUES ('123', '18', '814', '000003931', 'TINQUERCCASA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0902', '090206', '13', '02', '02', '15');
INSERT INTO establecimiento VALUES ('124', '18', '814', '000003932', 'HUACHHUA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090206', '13', '02', '02', '15');
INSERT INTO establecimiento VALUES ('125', '17', '814', '000003933', 'PUMARANRA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090206', '13', '02', '02', '14');
INSERT INTO establecimiento VALUES ('126', '18', '814', '000006823', 'CHOPCCAPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090206', '13', '02', '02', '15');
INSERT INTO establecimiento VALUES ('127', '17', '814', '000007456', 'PAMPAPUQUIO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090206', '13', '02', '02', '14');
INSERT INTO establecimiento VALUES ('128', '18', '814', '000009696', 'LIBERTADORES DE CHOPCCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090206', '13', '02', '02', '15');
INSERT INTO establecimiento VALUES ('129', '17', '814', '000009709', 'PACCHO MOLINOS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090206', '13', '02', '02', '14');
INSERT INTO establecimiento VALUES ('130', '17', '814', '000011229', 'PADRE RUMI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090206', '13', '02', '02', '14');
INSERT INTO establecimiento VALUES ('131', '15', '815', '000003923', 'POMACOCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090207', '13', '02', '01', '12');
INSERT INTO establecimiento VALUES ('132', '15', '815', '000003924', 'CHOCLOCOCHA', 'I-3', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090207', '13', '02', '01', '12');
INSERT INTO establecimiento VALUES ('133', '15', '815', '000003925', 'YANACCOCHA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090207', '13', '02', '01', '12');
INSERT INTO establecimiento VALUES ('134', '15', '815', '000009698', 'INCAPACCHAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090207', '13', '02', '01', '12');
INSERT INTO establecimiento VALUES ('135', '15', '815', '000009707', 'AYAHUASAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090207', '13', '02', '01', '12');
INSERT INTO establecimiento VALUES ('136', '19', '816', '000003937', 'ROSARIO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090208', '13', '02', '02', '16');
INSERT INTO establecimiento VALUES ('137', '19', '816', '000003938', 'PUCA CRUZ', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0902', '090208', '13', '02', '02', '16');
INSERT INTO establecimiento VALUES ('138', '19', '816', '000003942', 'CHANQUIL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090208', '13', '02', '02', '16');
INSERT INTO establecimiento VALUES ('139', '19', '816', '000007372', 'LLIPLLINA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090208', '13', '02', '02', '16');
INSERT INTO establecimiento VALUES ('140', '19', '816', '000007418', 'LECCLESPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090208', '13', '02', '02', '16');
INSERT INTO establecimiento VALUES ('141', '19', '816', '000009503', 'VILLA MANTARO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090208', '13', '02', '02', '16');
INSERT INTO establecimiento VALUES ('142', '19', '816', '000009693', 'PUNCHAYPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090208', '13', '02', '02', '16');
INSERT INTO establecimiento VALUES ('143', '19', '816', '000009706', 'TORORUMI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090208', '13', '02', '02', '16');
INSERT INTO establecimiento VALUES ('144', '19', '816', '000009710', 'ICHUPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090208', '13', '02', '02', '16');
INSERT INTO establecimiento VALUES ('145', '19', '816', '000011231', 'SANTA ROSA DE ACCOMACHAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090208', '13', '02', '02', '16');
INSERT INTO establecimiento VALUES ('146', '0', '817', '000003943', 'LIRCAY', 'I-4', 'CENTRO DE SALUD', '0', '1', '1', '09', '0903', '090301', '13', '04', '01', '31');
INSERT INTO establecimiento VALUES ('147', '106', '817', '000003944', 'BUENA VISTA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090301', '13', '04', '01', '31');
INSERT INTO establecimiento VALUES ('148', '104', '817', '000003945', 'CCARHUAPATA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090301', '13', '04', '01', '31');
INSERT INTO establecimiento VALUES ('149', '105', '817', '000003946', 'PIRCAPAHUANA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090301', '13', '04', '01', '31');
INSERT INTO establecimiento VALUES ('150', '104', '817', '000003947', 'CONSTANCIA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090301', '13', '04', '01', '31');
INSERT INTO establecimiento VALUES ('151', '105', '817', '000003948', 'UCHCUPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090301', '13', '04', '01', '31');
INSERT INTO establecimiento VALUES ('152', '106', '817', '000003949', 'CHAHUARMA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090301', '13', '04', '01', '31');
INSERT INTO establecimiento VALUES ('153', '105', '817', '000003950', 'CHALLHUAPUQUIO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090301', '13', '04', '01', '31');
INSERT INTO establecimiento VALUES ('154', '104', '817', '000003951', 'TUCSIPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090301', '13', '04', '01', '31');
INSERT INTO establecimiento VALUES ('155', '105', '817', '000007290', 'PERCAPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090301', '13', '04', '01', '31');
INSERT INTO establecimiento VALUES ('156', '106', '817', '000007373', 'SOCCLLABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090301', '13', '04', '01', '31');
INSERT INTO establecimiento VALUES ('157', '106', '817', '000007384', 'SAN JUAN DE AHUAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090301', '13', '04', '01', '31');
INSERT INTO establecimiento VALUES ('158', '105', '817', '000007385', 'SAN JUAN DE DIOS DE CCOLLPAPAMPA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090301', '13', '04', '01', '31');
INSERT INTO establecimiento VALUES ('159', '104', '817', '000011201', 'CIENEGUILLA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090301', '13', '04', '01', '31');
INSERT INTO establecimiento VALUES ('160', '104', '817', '000011202', 'PAMPAHUASI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090301', '13', '04', '01', '31');
INSERT INTO establecimiento VALUES ('161', '106', '817', '000011205', 'UNION PROGRESO PATAHUASI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090301', '13', '04', '01', '31');
INSERT INTO establecimiento VALUES ('162', '104', '817', '000011769', 'YANAUTUTO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090301', '13', '04', '01', '31');
INSERT INTO establecimiento VALUES ('163', '105', '818', '000003958', 'ANCHONGA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090302', '13', '04', '01', '31');
INSERT INTO establecimiento VALUES ('164', '36', '818', '000003959', 'PARCO ALTO', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0903', '090302', '13', '04', '02', '33');
INSERT INTO establecimiento VALUES ('165', '35', '818', '000003960', 'TUCO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090302', '13', '04', '02', '32');
INSERT INTO establecimiento VALUES ('166', '36', '818', '000003961', 'SAN PABLO DE OCCO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090302', '13', '04', '02', '33');
INSERT INTO establecimiento VALUES ('167', '36', '818', '000006901', 'BUENOS AIRES DE PARCO CHACAPUNCU', 'I-3', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090302', '13', '04', '02', '33');
INSERT INTO establecimiento VALUES ('168', '36', '818', '000006930', 'HUARIRUMI - CHONTACANCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090302', '13', '04', '02', '33');
INSERT INTO establecimiento VALUES ('169', '36', '818', '000011454', 'ALTO MARAYNIYOCC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090302', '13', '04', '02', '33');
INSERT INTO establecimiento VALUES ('170', '34', '819', '000003952', 'CALLANMARCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090303', '13', '04', '01', '31');
INSERT INTO establecimiento VALUES ('171', '35', '820', '000003955', 'CCOCHACCASA', 'I-3', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090304', '13', '04', '02', '32');
INSERT INTO establecimiento VALUES ('172', '35', '820', '000003956', 'SAN PEDRO DE MIMOSA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090304', '13', '04', '02', '32');
INSERT INTO establecimiento VALUES ('173', '35', '820', '000003957', 'CCASCCABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090304', '13', '04', '02', '32');
INSERT INTO establecimiento VALUES ('174', '35', '820', '000011204', 'VELASCO PUCAPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090304', '13', '04', '02', '32');
INSERT INTO establecimiento VALUES ('175', '37', '821', '000003963', 'CHINCHO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090305', '13', '04', '03', '34');
INSERT INTO establecimiento VALUES ('176', '37', '821', '000011787', 'LLAMOCCTACHI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090305', '13', '04', '03', '34');
INSERT INTO establecimiento VALUES ('177', '38', '822', '000003972', 'CONGALLA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090306', '13', '04', '03', '35');
INSERT INTO establecimiento VALUES ('178', '38', '822', '000003973', 'YUNYACCASA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090306', '13', '04', '03', '35');
INSERT INTO establecimiento VALUES ('179', '38', '822', '000003974', 'CARCOSI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090306', '13', '04', '03', '35');
INSERT INTO establecimiento VALUES ('180', '38', '822', '000003975', 'LIRCAYCCASA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090306', '13', '04', '03', '35');
INSERT INTO establecimiento VALUES ('181', '38', '822', '000011199', 'CHAYNABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090306', '13', '04', '03', '35');
INSERT INTO establecimiento VALUES ('182', '34', '823', '000003953', 'HUANCA HUANCA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090307', '13', '04', '01', '31');
INSERT INTO establecimiento VALUES ('183', '34', '823', '000011200', 'CCARAPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090307', '13', '04', '01', '31');
INSERT INTO establecimiento VALUES ('184', '34', '824', '000003954', 'HUAYLLAY GRANDE', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090308', '13', '04', '01', '31');
INSERT INTO establecimiento VALUES ('185', '37', '825', '000003962', 'JULCAMARCA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0903', '090309', '13', '04', '03', '34');
INSERT INTO establecimiento VALUES ('186', '37', '826', '000003965', 'SAN ANTONIO DE ANTAPARCO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090310', '13', '04', '03', '34');
INSERT INTO establecimiento VALUES ('187', '37', '826', '000003966', 'MAICENA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090310', '13', '04', '03', '34');
INSERT INTO establecimiento VALUES ('188', '37', '827', '000003967', 'SANTO TOMAS DE PATA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090311', '13', '04', '03', '34');
INSERT INTO establecimiento VALUES ('189', '37', '827', '000003968', 'CHUPACC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090311', '13', '04', '03', '34');
INSERT INTO establecimiento VALUES ('190', '37', '827', '000011768', 'CUTICSA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090311', '13', '04', '03', '34');
INSERT INTO establecimiento VALUES ('191', '38', '828', '000003969', 'SECCLLA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0903', '090312', '13', '04', '03', '35');
INSERT INTO establecimiento VALUES ('192', '38', '828', '000003970', 'QUISPICANCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090312', '13', '04', '03', '35');
INSERT INTO establecimiento VALUES ('193', '38', '828', '000003971', 'TRANCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0903', '090312', '13', '04', '03', '35');
INSERT INTO establecimiento VALUES ('194', '39', '829', '000004002', 'CASTROVIRREYNA', 'I-4', 'CENTRO DE SALUD', '0', '1', '1', '09', '0904', '090401', '13', '05', '01', '36');
INSERT INTO establecimiento VALUES ('195', '39', '829', '000004003', 'SINTO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0904', '090401', '13', '05', '01', '36');
INSERT INTO establecimiento VALUES ('196', '39', '829', '000004004', 'ESMERALDA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0904', '090401', '13', '05', '01', '36');
INSERT INTO establecimiento VALUES ('197', '39', '829', '000004005', 'COCHA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0904', '090401', '13', '05', '01', '36');
INSERT INTO establecimiento VALUES ('198', '41', '830', '000004017', 'VILLA DE ARMA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0904', '090402', '13', '05', '02', '38');
INSERT INTO establecimiento VALUES ('199', '41', '830', '000004018', 'COTAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0904', '090402', '13', '05', '02', '38');
INSERT INTO establecimiento VALUES ('200', '41', '830', '000013021', 'LUCMA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0904', '090402', '13', '05', '02', '38');
INSERT INTO establecimiento VALUES ('201', '41', '830', '000013022', 'TOTORA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0904', '090402', '13', '05', '02', '38');
INSERT INTO establecimiento VALUES ('202', '43', '831', '000004019', 'AURAHUA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0904', '090403', '13', '05', '03', '40');
INSERT INTO establecimiento VALUES ('203', '43', '831', '000004020', 'COCHAMARCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0904', '090403', '13', '05', '03', '40');
INSERT INTO establecimiento VALUES ('204', '40', '832', '000004014', 'PAURANGA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0904', '090404', '13', '05', '01', '37');
INSERT INTO establecimiento VALUES ('205', '42', '832', '000004027', 'CAPILLAS NORTE', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0904', '090404', '13', '05', '02', '39');
INSERT INTO establecimiento VALUES ('206', '42', '832', '000004028', 'MARCAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0904', '090404', '13', '05', '02', '39');
INSERT INTO establecimiento VALUES ('207', '42', '832', '000004029', 'CAJAMARCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0904', '090404', '13', '05', '02', '39');
INSERT INTO establecimiento VALUES ('208', '44', '833', '000004021', 'CHUPAMARCA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0904', '090405', '13', '05', '03', '41');
INSERT INTO establecimiento VALUES ('209', '43', '833', '000004022', 'CHANCAHUASI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0904', '090405', '13', '05', '03', '40');
INSERT INTO establecimiento VALUES ('210', '39', '834', '000004006', 'COCAS', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0904', '090406', '13', '05', '01', '36');
INSERT INTO establecimiento VALUES ('211', '39', '835', '000004007', 'SUYTUPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0904', '090407', '13', '05', '01', '36');
INSERT INTO establecimiento VALUES ('212', '42', '835', '000004024', 'HUACHOS', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0904', '090407', '13', '05', '02', '39');
INSERT INTO establecimiento VALUES ('213', '42', '835', '000004025', 'HUAJINTAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0904', '090407', '13', '05', '02', '39');
INSERT INTO establecimiento VALUES ('214', '42', '835', '000004026', 'PICHUTA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0904', '090407', '13', '05', '02', '39');
INSERT INTO establecimiento VALUES ('215', '44', '836', '000004032', 'HUAMATAMBO', 'I-1', 'CENTRO DE SALUD', '0', '1', '1', '09', '0904', '090408', '13', '05', '03', '41');
INSERT INTO establecimiento VALUES ('216', '40', '837', '000004015', 'MOLLEPAMPA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0904', '090409', '13', '05', '01', '37');
INSERT INTO establecimiento VALUES ('217', '40', '837', '000004016', 'CIUTAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0904', '090409', '13', '05', '01', '37');
INSERT INTO establecimiento VALUES ('218', '44', '838', '000004034', 'SAN JUAN DE CASTROVIRREYNA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0904', '090410', '13', '05', '03', '41');
INSERT INTO establecimiento VALUES ('219', '44', '838', '000004035', 'CAMAYOCC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0904', '090410', '13', '05', '03', '41');
INSERT INTO establecimiento VALUES ('220', '39', '839', '000003858', 'ASTOBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0904', '090411', '13', '05', '01', '36');
INSERT INTO establecimiento VALUES ('221', '39', '839', '000004008', 'SANTA ANA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0904', '090411', '13', '05', '01', '36');
INSERT INTO establecimiento VALUES ('222', '39', '839', '000004009', 'CHOCLOCOCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0904', '090411', '13', '05', '01', '36');
INSERT INTO establecimiento VALUES ('223', '39', '839', '000004010', 'SANTA ROSA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0904', '090411', '13', '05', '01', '36');
INSERT INTO establecimiento VALUES ('224', '44', '840', '000004030', 'TANTARA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0904', '090412', '13', '05', '03', '41');
INSERT INTO establecimiento VALUES ('225', '44', '840', '000004031', 'OCROCOCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0904', '090412', '13', '05', '03', '41');
INSERT INTO establecimiento VALUES ('226', '40', '841', '000004012', 'TICRAPO', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0904', '090413', '13', '05', '01', '37');
INSERT INTO establecimiento VALUES ('227', '40', '841', '000004013', 'CHACOYA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0904', '090413', '13', '05', '01', '37');
INSERT INTO establecimiento VALUES ('228', '45', '842', '000003976', 'CHURCAMPA', 'I-4', 'CENTRO DE SALUD', '0', '1', '1', '09', '0905', '090501', '13', '06', '01', '42');
INSERT INTO establecimiento VALUES ('229', '45', '842', '000003977', 'PACCAY', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090501', '13', '06', '01', '42');
INSERT INTO establecimiento VALUES ('230', '46', '843', '000003984', 'ANCO', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0905', '090502', '13', '06', '01', '43');
INSERT INTO establecimiento VALUES ('231', '46', '843', '000003985', 'CUYOCC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090502', '13', '06', '01', '43');
INSERT INTO establecimiento VALUES ('232', '46', '843', '000003986', 'MANZANAYOCC', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090502', '13', '06', '01', '43');
INSERT INTO establecimiento VALUES ('233', '46', '843', '000003999', 'SAN MIGUEL DE ARMA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090502', '13', '06', '01', '43');
INSERT INTO establecimiento VALUES ('234', '46', '1826', '000003897', 'COSME', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090511', '13', '06', '01', '43');
INSERT INTO establecimiento VALUES ('235', '46', '1826', '000007420', 'ANTACALLA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090511', '13', '06', '01', '43');
INSERT INTO establecimiento VALUES ('236', '46', '1826', '000012120', 'LLACUA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090511', '13', '06', '01', '43');
INSERT INTO establecimiento VALUES ('237', '47', '844', '000003992', 'CHINCHIHUASI', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090503', '13', '06', '02', '44');
INSERT INTO establecimiento VALUES ('238', '47', '844', '000003993', 'HUANCHOS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090503', '13', '06', '02', '44');
INSERT INTO establecimiento VALUES ('239', '47', '844', '000004097', 'SANTA ROSA DE OCCORO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090503', '13', '06', '02', '44');
INSERT INTO establecimiento VALUES ('240', '46', '845', '000003987', 'EL CARMEN', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090504', '13', '06', '01', '43');
INSERT INTO establecimiento VALUES ('241', '46', '845', '000003988', 'PALERMO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090504', '13', '06', '01', '43');
INSERT INTO establecimiento VALUES ('242', '45', '846', '000003983', 'LA MERCED', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090505', '13', '06', '01', '42');
INSERT INTO establecimiento VALUES ('243', '45', '847', '000003978', 'LOCROJA', 'I-3', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090506', '13', '06', '01', '42');
INSERT INTO establecimiento VALUES ('244', '45', '847', '000003979', 'YAURICAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090506', '13', '06', '01', '42');
INSERT INTO establecimiento VALUES ('245', '45', '847', '000003980', 'SAN JUAN DE OCCOPAMPA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090506', '13', '06', '01', '42');
INSERT INTO establecimiento VALUES ('246', '45', '847', '000012083', 'LA MERCED DE CHUPAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090506', '13', '06', '01', '42');
INSERT INTO establecimiento VALUES ('247', '47', '848', '000003989', 'PAUCARBAMBA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0905', '090507', '13', '06', '02', '44');
INSERT INTO establecimiento VALUES ('248', '47', '848', '000003990', 'SAN CRISTOBAL DE COCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090507', '13', '06', '02', '44');
INSERT INTO establecimiento VALUES ('249', '47', '848', '000003991', 'HUARIBAMBILLA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090507', '13', '06', '02', '44');
INSERT INTO establecimiento VALUES ('250', '47', '848', '000011210', 'SALLCCABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090507', '13', '06', '02', '44');
INSERT INTO establecimiento VALUES ('251', '45', '849', '000003981', 'SAN MIGUEL DE MAYOCC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090508', '13', '06', '01', '42');
INSERT INTO establecimiento VALUES ('252', '45', '849', '000003982', 'CCARANACC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090508', '13', '06', '01', '42');
INSERT INTO establecimiento VALUES ('253', '48', '850', '000003996', 'SAN PEDRO DE CORIS', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0905', '090509', '13', '06', '02', '45');
INSERT INTO establecimiento VALUES ('254', '48', '850', '000003997', 'CARHUANCHO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090509', '13', '06', '02', '45');
INSERT INTO establecimiento VALUES ('255', '48', '850', '000007708', 'COBRIZA (MACHAHUAY)', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090509', '13', '06', '02', '45');
INSERT INTO establecimiento VALUES ('256', '47', '851', '000003994', 'PACHAMARCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090510', '13', '06', '02', '44');
INSERT INTO establecimiento VALUES ('257', '47', '851', '000003995', 'PATALLACCTA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090510', '13', '06', '02', '44');
INSERT INTO establecimiento VALUES ('258', '48', '851', '000004000', 'PIO PACHAMARCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090510', '13', '06', '02', '45');
INSERT INTO establecimiento VALUES ('259', '48', '851', '000004001', 'PATIBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090510', '13', '06', '02', '45');
INSERT INTO establecimiento VALUES ('260', '47', '851', '000011211', 'CCOYLLORPANCCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090510', '13', '06', '02', '44');
INSERT INTO establecimiento VALUES ('261', '48', '851', '000011212', 'VILLAMAYO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090510', '13', '06', '02', '45');
INSERT INTO establecimiento VALUES ('262', '49', '852', '000004036', 'HUAYTARA', 'I-4', 'CENTRO DE SALUD', '0', '1', '1', '09', '0906', '090601', '13', '07', '01', '46');
INSERT INTO establecimiento VALUES ('263', '49', '852', '000004037', 'MUCHIC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090601', '13', '07', '01', '46');
INSERT INTO establecimiento VALUES ('266', '50', '853', '000004049', 'AYAVI', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090602', '13', '07', '01', '47');
INSERT INTO establecimiento VALUES ('267', '50', '853', '000004050', 'CHAULISMA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090602', '13', '07', '01', '47');
INSERT INTO establecimiento VALUES ('268', '52', '854', '000004064', 'CORDOVA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0906', '090603', '13', '07', '03', '49');
INSERT INTO establecimiento VALUES ('269', '52', '854', '000004065', 'HUACHOJAICO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090603', '13', '07', '03', '49');
INSERT INTO establecimiento VALUES ('270', '49', '855', '000004038', 'HUAYACUNDO ARMA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090604', '13', '07', '01', '46');
INSERT INTO establecimiento VALUES ('271', '53', '856', '000004069', 'LARAMARCA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090605', '13', '07', '03', '50');
INSERT INTO establecimiento VALUES ('272', '52', '856', '000004070', 'OCOBAMBA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090605', '13', '07', '03', '49');
INSERT INTO establecimiento VALUES ('273', '52', '857', '000004066', 'VICHURI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090606', '13', '07', '03', '49');
INSERT INTO establecimiento VALUES ('274', '53', '857', '000004071', 'OCOYO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090606', '13', '07', '03', '50');
INSERT INTO establecimiento VALUES ('275', '53', '857', '000004072', 'PACOMARCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090606', '13', '07', '03', '50');
INSERT INTO establecimiento VALUES ('276', '54', '858', '000004011', 'SANTA INES', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090607', '13', '07', '04', '51');
INSERT INTO establecimiento VALUES ('277', '54', '858', '000004042', 'PILPICHACA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0906', '090607', '13', '07', '04', '51');
INSERT INTO establecimiento VALUES ('278', '54', '858', '000004043', 'LLILLINTA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090607', '13', '07', '04', '51');
INSERT INTO establecimiento VALUES ('279', '54', '858', '000004044', 'SAN FELIPE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090607', '13', '07', '04', '51');
INSERT INTO establecimiento VALUES ('280', '54', '858', '000004045', 'CARHUANCHO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090607', '13', '07', '04', '51');
INSERT INTO establecimiento VALUES ('281', '54', '858', '000004046', 'INGAHUASI', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090607', '13', '07', '04', '51');
INSERT INTO establecimiento VALUES ('282', '54', '858', '000007358', 'PICHCCAHUASI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090607', '13', '07', '04', '51');
INSERT INTO establecimiento VALUES ('283', '54', '858', '000009690', 'NUEVA JERUSALEN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090607', '13', '07', '04', '51');
INSERT INTO establecimiento VALUES ('284', '54', '858', '000011497', 'PELAPATA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090607', '13', '07', '04', '51');
INSERT INTO establecimiento VALUES ('285', '53', '859', '000004068', 'QUERCO', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0906', '090608', '13', '07', '03', '50');
INSERT INTO establecimiento VALUES ('286', '49', '860', '000004039', 'QUITO ARMA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090609', '13', '07', '01', '46');
INSERT INTO establecimiento VALUES ('287', '49', '860', '000007709', 'HUAYANTO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090609', '13', '07', '01', '46');
INSERT INTO establecimiento VALUES ('288', '49', '861', '000004040', 'SAN ANTONIO DE CUSICANCHA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090610', '13', '07', '01', '46');
INSERT INTO establecimiento VALUES ('289', '49', '861', '000004041', 'QUISHUARPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090610', '13', '07', '01', '46');
INSERT INTO establecimiento VALUES ('290', '54', '862', '000004047', 'SAN JUAN DE OCCORO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090611', '13', '07', '04', '51');
INSERT INTO establecimiento VALUES ('291', '51', '862', '000004062', 'SAN FRANCISCO DE SANGAYAICO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090611', '13', '07', '02', '48');
INSERT INTO establecimiento VALUES ('292', '51', '862', '000004063', 'SANTA ROSA DE ACORA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090611', '13', '07', '02', '48');
INSERT INTO establecimiento VALUES ('293', '52', '863', '000004067', 'SAN ISIDRO DE HUIRPACANCHA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090612', '13', '07', '03', '49');
INSERT INTO establecimiento VALUES ('294', '51', '864', '000004054', 'SANTIAGO DE CHOCORVOS', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0906', '090613', '13', '07', '02', '48');
INSERT INTO establecimiento VALUES ('295', '51', '864', '000004055', 'ANDAYMARCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090613', '13', '07', '02', '48');
INSERT INTO establecimiento VALUES ('296', '51', '864', '000004056', 'LA MEJORADA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090613', '13', '07', '02', '48');
INSERT INTO establecimiento VALUES ('297', '51', '864', '000004057', 'SAN LUIS DE CORERAC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090613', '13', '07', '02', '48');
INSERT INTO establecimiento VALUES ('298', '51', '864', '000004058', 'SAN MIGUEL DE CURIS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090613', '13', '07', '02', '48');
INSERT INTO establecimiento VALUES ('299', '51', '864', '000004059', 'SANTA ROSA DE OLAYA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090613', '13', '07', '02', '48');
INSERT INTO establecimiento VALUES ('300', '51', '864', '000004060', 'SANTA ROSA DE OTUTO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090613', '13', '07', '02', '48');
INSERT INTO establecimiento VALUES ('301', '51', '864', '000004061', 'PALMACANCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090613', '13', '07', '02', '48');
INSERT INTO establecimiento VALUES ('302', '53', '865', '000004073', 'SANTIAGO DE QUIRAHUARA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090614', '13', '07', '03', '50');
INSERT INTO establecimiento VALUES ('303', '50', '866', '000004051', 'SANTO DOMINGO DE CAPILLAS SUR', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090615', '13', '07', '01', '47');
INSERT INTO establecimiento VALUES ('304', '50', '866', '000004052', 'VISTA ALEGRE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090615', '13', '07', '01', '47');
INSERT INTO establecimiento VALUES ('305', '50', '866', '000004053', 'HUANACANCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0906', '090615', '13', '07', '01', '47');
INSERT INTO establecimiento VALUES ('306', '50', '867', '000004048', 'SANTA ROSA DE TAMBO', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0906', '090616', '13', '07', '01', '47');
INSERT INTO establecimiento VALUES ('307', '28', '868', '000003898', 'MANTACRA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090701', '13', '03', '06', '29');
INSERT INTO establecimiento VALUES ('308', '0', '0', '000004074', 'PAMPAS', '', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090701', '13', '03', '00', '00');
INSERT INTO establecimiento VALUES ('309', '32', '1857', '000004075', 'SANTIAGO DE TUCUMA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090723', '13', '03', '08', '20');
INSERT INTO establecimiento VALUES ('310', '31', '868', '000004076', 'SOCORRO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090701', '13', '03', '07', '19');
INSERT INTO establecimiento VALUES ('311', '31', '868', '000007327', 'CASAY OCOBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090701', '13', '03', '07', '19');
INSERT INTO establecimiento VALUES ('312', '29', '869', '000004098', 'ACOSTAMBO', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0907', '090702', '13', '03', '06', '30');
INSERT INTO establecimiento VALUES ('313', '29', '869', '000004099', 'HUAYTA CORRAL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090702', '13', '03', '06', '30');
INSERT INTO establecimiento VALUES ('314', '29', '869', '000004100', 'CHUCUNA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090702', '13', '03', '06', '30');
INSERT INTO establecimiento VALUES ('315', '29', '869', '000004101', 'ALFAPATA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090702', '13', '03', '06', '30');
INSERT INTO establecimiento VALUES ('316', '29', '869', '000007108', 'QUINTAOJO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090702', '13', '03', '06', '30');
INSERT INTO establecimiento VALUES ('317', '29', '869', '000007395', 'VILLA REAL PACCHAPATA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090702', '13', '03', '06', '30');
INSERT INTO establecimiento VALUES ('318', '31', '870', '000004077', 'ACRAQUIA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0907', '090703', '13', '03', '07', '19');
INSERT INTO establecimiento VALUES ('319', '31', '870', '000004078', 'DOS DE MAYO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090703', '13', '03', '07', '19');
INSERT INTO establecimiento VALUES ('320', '31', '870', '000004079', 'MATASENCCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090703', '13', '03', '07', '19');
INSERT INTO establecimiento VALUES ('321', '31', '870', '000007396', 'LLAMACANCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090703', '13', '03', '07', '19');
INSERT INTO establecimiento VALUES ('322', '31', '871', '000003892', 'NUEVA ESPERANZA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090704', '13', '03', '07', '19');
INSERT INTO establecimiento VALUES ('323', '29', '871', '000003893', 'CCONOCC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090704', '13', '03', '06', '30');
INSERT INTO establecimiento VALUES ('324', '31', '871', '000004080', 'AHUAYCHA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090704', '13', '03', '07', '19');
INSERT INTO establecimiento VALUES ('325', '31', '871', '000004081', 'SAN MIGUEL DE HUALLHUA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090704', '13', '03', '07', '19');
INSERT INTO establecimiento VALUES ('326', '31', '871', '000004082', 'TUPAC AMARU', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090704', '13', '03', '07', '19');
INSERT INTO establecimiento VALUES ('327', '28', '1828', '000003894', 'QUICHUAS', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0907', '090719', '13', '03', '06', '30');
INSERT INTO establecimiento VALUES ('328', '23', '872', '000004090', 'COLCABAMBA', 'I-4', 'CENTRO DE SALUD', '0', '1', '1', '09', '0907', '090705', '13', '03', '03', '24');
INSERT INTO establecimiento VALUES ('329', '24', '1854', '000004091', 'ANDAYMARCA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0907', '090720', '13', '03', '03', '25');
INSERT INTO establecimiento VALUES ('330', '23', '872', '000004092', 'CARPAPATA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090705', '13', '03', '03', '24');
INSERT INTO establecimiento VALUES ('331', '23', '872', '000004093', 'POCCYACC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090705', '13', '03', '03', '24');
INSERT INTO establecimiento VALUES ('332', '23', '872', '000004094', 'OCORO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090705', '13', '03', '03', '24');
INSERT INTO establecimiento VALUES ('333', '23', '872', '000004095', 'TOCAS', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090705', '13', '03', '03', '24');
INSERT INTO establecimiento VALUES ('334', '32', '872', '000004096', 'TOCCLLACURI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090705', '13', '03', '08', '20');
INSERT INTO establecimiento VALUES ('335', '28', '1828', '000006914', 'SAN JOSE', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090719', '13', '03', '06', '30');
INSERT INTO establecimiento VALUES ('336', '28', '1828', '000007312', 'VIOLETAS ACCOYANCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090719', '13', '03', '06', '30');
INSERT INTO establecimiento VALUES ('337', '24', '1854', '000007386', 'HUARANHUAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090720', '13', '03', '03', '25');
INSERT INTO establecimiento VALUES ('338', '23', '872', '000007387', 'CHACHAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090705', '13', '03', '03', '24');
INSERT INTO establecimiento VALUES ('339', '24', '1854', '000007388', 'QUINTAO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090720', '13', '03', '03', '25');
INSERT INTO establecimiento VALUES ('340', '32', '872', '000007450', 'RUNDOVILCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090705', '13', '03', '08', '20');
INSERT INTO establecimiento VALUES ('341', '28', '1828', '000011185', 'COLCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090719', '13', '03', '06', '30');
INSERT INTO establecimiento VALUES ('342', '28', '1828', '000011431', 'SANTA ROSA DE MALLMA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090719', '13', '03', '06', '30');
INSERT INTO establecimiento VALUES ('343', '23', '872', '000012900', 'RANRA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090705', '13', '03', '03', '24');
INSERT INTO establecimiento VALUES ('344', '24', '1854', '000012904', 'PICHIU', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090720', '13', '03', '03', '25');
INSERT INTO establecimiento VALUES ('345', '32', '873', '000004083', 'DANIEL HERNANDEZ', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0907', '090706', '13', '03', '08', '20');
INSERT INTO establecimiento VALUES ('346', '32', '873', '000004084', 'MASHUAYLLO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090706', '13', '03', '08', '20');
INSERT INTO establecimiento VALUES ('347', '32', '873', '000004085', 'MARCOPATA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090706', '13', '03', '08', '20');
INSERT INTO establecimiento VALUES ('348', '32', '873', '000007394', 'SAN JUAN DE PALTARUMI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090706', '13', '03', '08', '20');
INSERT INTO establecimiento VALUES ('349', '100', '874', '000004129', 'HUACHOCOLPA', 'I-3', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090707', '13', '03', '05', '27');
INSERT INTO establecimiento VALUES ('350', '100', '874', '000004130', 'SANTA MARIA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090707', '13', '03', '05', '27');
INSERT INTO establecimiento VALUES ('351', '100', '874', '000007289', 'MARCAVALLE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090707', '13', '03', '05', '27');
INSERT INTO establecimiento VALUES ('352', '100', '874', '000013663', 'TAURIBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090707', '13', '03', '05', '27');
INSERT INTO establecimiento VALUES ('353', '22', '875', '000004109', 'HUARIBAMBA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0907', '090709', '13', '03', '02', '23');
INSERT INTO establecimiento VALUES ('354', '22', '875', '000004110', 'ANTA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090709', '13', '03', '02', '23');
INSERT INTO establecimiento VALUES ('355', '99', '1856', '000004111', 'SANTIAGO DE PICHUS', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0907', '090722', '13', '03', '02', '22');
INSERT INTO establecimiento VALUES ('356', '33', '875', '000004112', 'HUAYARQUI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090709', '13', '03', '08', '21');
INSERT INTO establecimiento VALUES ('357', '22', '875', '000004113', 'TAPO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090709', '13', '03', '02', '23');
INSERT INTO establecimiento VALUES ('358', '22', '875', '000004114', 'AYACANCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090709', '13', '03', '02', '23');
INSERT INTO establecimiento VALUES ('359', '99', '1856', '000007393', 'PARIACC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090722', '13', '03', '02', '22');
INSERT INTO establecimiento VALUES ('360', '33', '875', '000011188', 'SANTA CRUZ DE INYACC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090709', '13', '03', '08', '21');
INSERT INTO establecimiento VALUES ('361', '29', '876', '000004102', 'NAHUIMPUQUIO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090710', '13', '03', '06', '30');
INSERT INTO establecimiento VALUES ('362', '29', '876', '000004103', 'IMPERIAL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090710', '13', '03', '06', '30');
INSERT INTO establecimiento VALUES ('363', '21', '877', '000004104', 'PAZOS', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0907', '090711', '13', '03', '02', '22');
INSERT INTO establecimiento VALUES ('364', '21', '877', '000004105', 'COYLLORPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090711', '13', '03', '02', '22');
INSERT INTO establecimiento VALUES ('365', '21', '877', '000004106', 'SAN PEDRO DE MULLACA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090711', '13', '03', '02', '22');
INSERT INTO establecimiento VALUES ('366', '21', '877', '000004107', 'SAN LUCAS DE TONGOS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090711', '13', '03', '02', '22');
INSERT INTO establecimiento VALUES ('367', '21', '877', '000004108', 'SANTA CRUZ DE ILA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090711', '13', '03', '02', '22');
INSERT INTO establecimiento VALUES ('368', '21', '877', '000007390', 'CARAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090711', '13', '03', '02', '22');
INSERT INTO establecimiento VALUES ('369', '33', '878', '000004089', 'QUISHUAR', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090713', '13', '03', '08', '21');
INSERT INTO establecimiento VALUES ('370', '33', '879', '000004086', 'SALCABAMBA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0907', '090714', '13', '03', '08', '21');
INSERT INTO establecimiento VALUES ('371', '33', '879', '000004087', 'AYACCOCHA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090714', '13', '03', '08', '21');
INSERT INTO establecimiento VALUES ('372', '33', '879', '000004088', 'PATAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090714', '13', '03', '08', '21');
INSERT INTO establecimiento VALUES ('373', '25', '879', '000004125', 'CEDROPAMPA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090714', '13', '03', '04', '26');
INSERT INTO establecimiento VALUES ('374', '25', '880', '000004126', 'SALCAHUASI', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090715', '13', '03', '04', '26');
INSERT INTO establecimiento VALUES ('375', '25', '880', '000004127', 'SAN ANTONIO DE SALCABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090715', '13', '03', '04', '26');
INSERT INTO establecimiento VALUES ('376', '25', '880', '000007706', 'CHUYAPATA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090715', '13', '03', '04', '26');
INSERT INTO establecimiento VALUES ('377', '25', '880', '000011189', 'LA LOMA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090715', '13', '03', '04', '26');
INSERT INTO establecimiento VALUES ('378', '25', '881', '000004122', 'SAN ISIDRO DE ACOBAMBA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0907', '090716', '13', '03', '04', '26');
INSERT INTO establecimiento VALUES ('379', '25', '881', '000004123', 'SAN MARCOS DE ROCCHACC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090716', '13', '03', '04', '26');
INSERT INTO establecimiento VALUES ('380', '25', '881', '000004124', 'HUARI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090716', '13', '03', '04', '26');
INSERT INTO establecimiento VALUES ('381', '25', '881', '000007210', 'MONTECOLPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090716', '13', '03', '04', '26');
INSERT INTO establecimiento VALUES ('382', '26', '882', '000004128', 'SURCUBAMBA', 'I-4', 'CENTRO DE SALUD', '0', '1', '1', '09', '0907', '090717', '13', '03', '05', '27');
INSERT INTO establecimiento VALUES ('383', '26', '882', '000007090', 'VISTA ALEGRE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090717', '13', '03', '05', '27');
INSERT INTO establecimiento VALUES ('384', '26', '882', '000007291', 'PUEBLO LIBRE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090717', '13', '03', '05', '27');
INSERT INTO establecimiento VALUES ('385', '26', '882', '000007293', 'SOCOS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090717', '13', '03', '05', '27');
INSERT INTO establecimiento VALUES ('386', '26', '882', '000007707', 'SACHACOTO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090717', '13', '03', '05', '27');
INSERT INTO establecimiento VALUES ('387', '24', '882', '000012905', 'JATUSPATA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090717', '13', '03', '03', '25');
INSERT INTO establecimiento VALUES ('388', '26', '882', '000013662', 'YANANYAC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090717', '13', '03', '05', '27');
INSERT INTO establecimiento VALUES ('389', '27', '883', '000006628', 'TINTAY PUNCO', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '09', '0907', '090718', '13', '03', '05', '28');
INSERT INTO establecimiento VALUES ('390', '27', '883', '000006629', 'COCHABAMBA GRANDE', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090718', '13', '03', '05', '28');
INSERT INTO establecimiento VALUES ('391', '27', '1855', '000006630', 'PUERTO SAN ANTONIO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090721', '13', '03', '05', '27');
INSERT INTO establecimiento VALUES ('392', '27', '883', '000007294', 'SUNE GRANDE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090718', '13', '03', '05', '28');
INSERT INTO establecimiento VALUES ('393', '27', '883', '000007295', 'UCHUYSIHUIS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090718', '13', '03', '05', '28');
INSERT INTO establecimiento VALUES ('394', '14', '806', '000007133', 'VILLAPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090117', '13', '03', '11', '02');
INSERT INTO establecimiento VALUES ('395', '3', '806', '000007336', 'CONDORHUACHANA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090117', '13', '03', '02', '04');
INSERT INTO establecimiento VALUES ('396', '3', '806', '000007337', 'PUCACCASA CHOPCCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090117', '13', '03', '02', '04');
INSERT INTO establecimiento VALUES ('397', '3', '806', '000007338', 'CCOLLPACCASA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090117', '13', '03', '02', '04');
INSERT INTO establecimiento VALUES ('398', '13', '792', '000016896', 'ALHUARA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090103', '13', '03', '07', '55');
INSERT INTO establecimiento VALUES ('399', '8', '792', '000016204', 'ALIANZA ANDINO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090103', '13', '03', '05', '07');
INSERT INTO establecimiento VALUES ('400', '7', '803', '000018987', 'CONAICASA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090114', '13', '03', '04', '54');
INSERT INTO establecimiento VALUES ('401', '13', '792', '000016017', 'PATOCCOCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090114', '13', '03', '07', '55');
INSERT INTO establecimiento VALUES ('402', '102', '806', '000019140', 'SACHAPITE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090117', '13', '03', '11', '58');
INSERT INTO establecimiento VALUES ('403', '0', '0', '000003862', 'SANTA BARBARA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090101', '13', '03', '00', '00');
INSERT INTO establecimiento VALUES ('404', '12', '792', '000016016', 'SILVA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090103', '13', '03', '07', '11');
INSERT INTO establecimiento VALUES ('405', '0', '0', '000018258', 'SISTEMA DE ATENCION MOVIL DE URGENCIA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090118', '13', '03', '00', '00');
INSERT INTO establecimiento VALUES ('406', '8', '792', '000016723', 'UNION AMBO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0901', '090103', '13', '03', '05', '07');
INSERT INTO establecimiento VALUES ('407', '17', '814', '000018189', 'PROGRESO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090206', '13', '03', '02', '14');
INSERT INTO establecimiento VALUES ('408', '0', '0', '000003935', 'VISTA ALEGRE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0902', '090202', '13', '03', '00', '99');
INSERT INTO establecimiento VALUES ('409', '0', '0', '000004033', 'MUYUHUASI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0904', '090408', '13', '03', '00', '99');
INSERT INTO establecimiento VALUES ('410', '0', '0', '000004023', 'TIPICOCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0904', '090405', '13', '03', '00', '99');
INSERT INTO establecimiento VALUES ('411', '47', '844', '000019591', 'ARMA PATACANCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0905', '090503', '13', '03', '02', '44');
INSERT INTO establecimiento VALUES ('412', '33', '879', '000019233', 'SANTA ROSA DE CHANGUELETA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '09', '0907', '090714', '13', '03', '08', '20');
INSERT INTO establecimiento VALUES ('413', '0', '1', '000004839', 'P.S. TAQUIA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010101', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('414', '0', '1', '000004840', 'P.S. SAN ISIDRO DE UTCUBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010101', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('415', '0', '1', '000006754', 'C.S. 09 DE ENERO', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0101', '010101', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('416', '0', '1', '000007037', 'P.S. PEDRO CASTRO ALVA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010101', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('417', '0', '1', '000007038', 'P.S. EL MOLINO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010101', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('418', '0', '1', '000007039', 'P.S. HIGOS URCO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010101', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('419', '0', '1', '000007040', 'P.S. VIRGEN DE ASUNTA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010101', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('420', '0', '1', '000007360', 'P.S. FABIOLA SALAZAR LEGUIA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010101', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('421', '0', '1', '000013131', 'P.S. SENOR DE LOS MILAGROS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010101', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('422', '0', '2', '000004912', 'P.S. ASUNCION GONCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010102', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('423', '0', '3', '000004856', 'C.S. BALZAS', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0101', '010103', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('424', '0', '3', '000004857', 'P.S. GOLLON', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010103', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('425', '0', '3', '000007148', 'P.S. SAULLAMUR', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010103', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('426', '0', '4', '000004878', 'P.S. CHETO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010104', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('427', '0', '5', '000004879', 'P.S. VITUYA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010105', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('428', '0', '5', '000004880', 'P.S. CHILIQUIN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010105', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('429', '0', '5', '000007071', 'P.S. CUELCHO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010105', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('430', '0', '5', '000007072', 'P.S. SENGACHE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010105', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('431', '0', '6', '000004858', 'C.S. CHUQUIBAMBA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0101', '010106', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('432', '0', '6', '000007067', 'P.S. LA MORADA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010106', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('433', '0', '6', '000007068', 'P.S. CHUMBOL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010106', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('434', '0', '6', '000007174', 'P.S. COCHABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010106', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('435', '0', '6', '000007175', 'P.S. ATUEN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010106', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('436', '0', '6', '000007176', 'P.S. CANAAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010106', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('437', '0', '7', '000004868', 'P.S. GRANADA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010107', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('438', '0', '8', '000004841', 'P.S. HUANCAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010108', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('439', '0', '9', '000004904', 'C.S. YERBABUENA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0101', '010109', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('440', '0', '9', '000004905', 'C.S. JALCA GRANDE', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0101', '010109', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('441', '0', '9', '000004906', 'P.S. QUILLUNYA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010109', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('442', '0', '9', '000004951', 'P.S. NUEVA ESPERANZA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010109', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('443', '0', '9', '000004952', 'P.S. EL TRIUNFO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010109', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('444', '0', '9', '000007069', 'P.S. QUELUCAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010109', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('445', '0', '9', '000007070', 'P.S. BUIQUIL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010109', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('446', '0', '9', '000007280', 'P.S. PENGOTE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010109', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('447', '0', '9', '000007281', 'P.S. CUEYQUETA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010109', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('448', '0', '10', '000004859', 'C.S. LEYMEBAMBA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0101', '010110', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('449', '0', '10', '000004860', 'P.S. CHILCHOS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010110', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('450', '0', '10', '000004861', 'P.S. PLAZAPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010110', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('451', '0', '11', '000004842', 'P.S. LEVANTO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010111', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('452', '0', '12', '000004891', 'P.S. MAGDALENA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010112', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('453', '0', '13', '000004907', 'P.S. DURAZNOPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010113', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('454', '0', '13', '000004908', 'P.S. TACTA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010113', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('455', '0', '14', '000004869', 'C.S. MOLINOPAMPA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0101', '010114', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('456', '0', '14', '000004870', 'P.S. SAN JOSE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010114', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('457', '0', '14', '000004941', 'P.S. IZCUCHACA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010114', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('458', '0', '14', '000009667', 'P.S. CASMAL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010114', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('459', '0', '15', '000004909', 'P.S. MONTEVIDEO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010115', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('460', '0', '16', '000004871', 'P.S. OLLEROS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010116', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('461', '0', '16', '000004918', 'P.S. SAN MIGUEL DE LA REYNA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010116', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('462', '0', '17', '000004872', 'P.S. QUINJALCA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010117', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('463', '0', '17', '000006988', 'P.S. CHONTAPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010117', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('464', '0', '18', '000004881', 'C.S. PIPUS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010118', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('465', '0', '19', '000004892', 'P.S. MAYNO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010119', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('466', '0', '20', '000004882', 'P.S. SOLOCO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010120', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('467', '0', '20', '000004883', 'P.S. MITO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010120', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('468', '0', '20', '000007279', 'P.S. QUITACHI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010120', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('469', '0', '20', '000007282', 'P.S. OQUISH', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010120', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('470', '0', '21', '000004884', 'P.S. SONCHE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010121', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('471', '0', '21', '000007421', 'P.S. NUEVO OLMAL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0101', '010121', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('472', '0', '22', '000005045', 'P.S. ESPITAL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010201', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('473', '0', '22', '000005047', 'P.S. CRUCE ALENYA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010201', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('474', '0', '22', '000005048', 'P.S. TOMAQUE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010201', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('475', '0', '22', '000006998', 'C.S. BAGUA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0102', '010201', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('476', '0', '22', '000007007', 'P.S. ACERILLO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010201', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('477', '0', '22', '000007276', 'P.S. LA PRIMAVERA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010201', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('478', '0', '22', '000007300', 'P.S. NARANJOS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010201', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('479', '0', '22', '000007759', 'P.S. CASUAL', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010201', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('480', '0', '23', '000005053', 'C.S. ARAMANGO', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0102', '010202', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('481', '0', '23', '000005054', 'P.S. MIRAFLORES DE ARAMANGO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010202', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('482', '0', '23', '000005055', 'P.S. COPALLIN DE ARAMANGO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010202', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('483', '0', '23', '000005056', 'C.S. EL MUYO', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0102', '010202', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('484', '0', '23', '000005057', 'C.S. EL PORVENIR DE ARAMANGO', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0102', '010202', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('485', '0', '23', '000005058', 'P.S. NUMPARKET', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010202', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('486', '0', '23', '000005059', 'P.S. TUTUMBEROS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010202', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('487', '0', '23', '000005060', 'P.S. LA LIBERTAD', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010202', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('488', '0', '23', '000005061', 'P.S. SHAIM', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010202', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('489', '0', '23', '000005062', 'P.S. ZAPOTAL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010202', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('490', '0', '23', '000007008', 'P.S. CHINGANZA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010202', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('491', '0', '23', '000007009', 'P.S. MONTENEGRO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010202', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('492', '0', '23', '000007010', 'P.S. CAMPO BONITO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010202', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('493', '0', '23', '000007227', 'P.S. SELVA VERDE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010202', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('494', '0', '23', '000007228', 'P.S. NAJEM', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010202', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('495', '0', '23', '000007229', 'P.S. SANTA CLARA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010202', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('496', '0', '23', '000007263', 'P.S. GUAYAQUIL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010202', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('497', '0', '23', '000007264', 'P.S. EL CEDRON', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010202', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('498', '0', '24', '000005063', 'C.S. COPALLIN', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0102', '010203', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('499', '0', '24', '000005064', 'P.S. PAN DE AZUCAR', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010203', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('500', '0', '24', '000005065', 'P.S. CHONZA LAGUNA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010203', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('501', '0', '24', '000007004', 'P.S. LLUHUANA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010203', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('502', '0', '24', '000007005', 'P.S. SANTA CRUZ DE MOROCHAL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010203', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('503', '0', '24', '000007299', 'P.S. ALENYA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010203', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('504', '0', '25', '000005193', 'C.S. EL PARCO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010204', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('505', '0', '25', '000007262', 'P.S. TOLOPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010204', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('506', '0', '25', '000007758', 'P.S. UNION PROGRESO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010204', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('507', '0', '26', '000005070', 'C.S. IMAZA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('508', '0', '26', '000005071', 'C.S. CHIPE', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('509', '0', '26', '000005072', 'P.S. KUSU', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('510', '0', '26', '000005073', 'P.S. NUMPATKAIM', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('511', '0', '26', '000005074', 'P.S. JEMPEST-CHICAIS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('512', '0', '26', '000005075', 'C.S. TUPAC AMARU I', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('513', '0', '26', '000005076', 'P.S. YANAT', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('514', '0', '26', '000005077', 'P.S. TUNTUS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('515', '0', '26', '000005078', 'P.S. CHIJA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('516', '0', '26', '000005079', 'P.S. UUT', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('517', '0', '26', '000005080', 'P.S. SIJIAK', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('518', '0', '26', '000005081', 'C.S. WAYAMPIAK', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('519', '0', '26', '000005082', 'P.S. WAJUYAT', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('520', '0', '26', '000005083', 'P.S. BICHANAK', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('521', '0', '26', '000005084', 'C.S. CHIRIACO', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('522', '0', '26', '000005085', 'P.S. SHUSHUG', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('523', '0', '26', '000005086', 'P.S. WAWAIN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('524', '0', '26', '000005087', 'P.S. PAKUIT', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('525', '0', '26', '000005088', 'P.S. SAMAREN-YUPICUSA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('526', '0', '26', '000005089', 'P.S. WAWAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('527', '0', '26', '000005090', 'P.S. SHIMPUENTS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('528', '0', '26', '000005091', 'P.S. NAYUMPIN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('529', '0', '26', '000005194', 'P.S. KUNCHIN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('530', '0', '26', '000006719', 'P.S. CENTRO WAWIK', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('531', '0', '26', '000006986', 'P.S. WAWICO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('532', '0', '26', '000007001', 'P.S. SUKUTIN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('533', '0', '26', '000007002', 'P.S. WANTSA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('534', '0', '26', '000007003', 'P.S. NAZARETH', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('535', '0', '26', '000007136', 'P.S. SAN RAFAEL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('536', '0', '26', '000007230', 'P.S. YAMAYAKAT', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('537', '0', '26', '000007231', 'P.S. TENASHNUM', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('538', '0', '26', '000007232', 'P.S. NUEVA VIDA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('539', '0', '26', '000007233', 'P.S. SAN PABLO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('540', '0', '26', '000007234', 'P.S. LISTRA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('541', '0', '26', '000007435', 'P.S. MESONES MURO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('542', '0', '26', '000012774', 'P.S. SAN RAMON', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('543', '0', '26', '000014208', 'P.S. DURAND', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('544', '0', '26', '000014209', 'P.S. KUSU GRANDE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('545', '0', '26', '000014210', 'P.S. NUEVO BELEN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010205', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('546', '0', '1827', '000005046', 'P.S. SAN ISIDRO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010206', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('547', '0', '1827', '000005049', 'C.S. LA PECA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0102', '010206', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('548', '0', '1827', '000005050', 'P.S. CHONZA ALTA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010206', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('549', '0', '1827', '000005051', 'P.S. EL TRIUNFO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010206', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('550', '0', '1827', '000005052', 'P.S. ARRAYAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010206', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('551', '0', '1827', '000007006', 'P.S. SAN FRANCISCO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0102', '010206', '01', '02', '', '');
INSERT INTO establecimiento VALUES ('552', '0', '27', '000004917', 'C.S. JUMBILLA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0103', '010301', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('553', '0', '27', '000009679', 'P.S. LAS PALMAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0103', '010301', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('554', '0', '28', '000004915', 'P.S. CHISQUILLA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0103', '010302', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('555', '0', '29', '000004919', 'P.S. CHURUJA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0103', '010303', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('556', '0', '30', '000004916', 'P.S. COROSHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0103', '010304', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('557', '0', '31', '000004920', 'P.S. CUISPES', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0103', '010305', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('558', '0', '31', '000004921', 'P.S. FANRRE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0103', '010305', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('559', '0', '32', '000004932', 'C.S. POMACOCHAS', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0103', '010306', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('560', '0', '32', '000004933', 'P.S. CARRERA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0103', '010306', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('561', '0', '32', '000004934', 'P.S. GUALULO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0103', '010306', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('562', '0', '33', '000004922', 'C.S. PEDRO RUIZ GALLO', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0103', '010307', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('563', '0', '33', '000004923', 'P.S. CHOSGON', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0103', '010307', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('564', '0', '33', '000004924', 'P.S. SAN JERONIMO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0103', '010307', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('565', '0', '33', '000004925', 'P.S. LA UNION', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0103', '010307', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('566', '0', '33', '000007261', 'P.S. DUNIA CHICO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0103', '010307', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('567', '0', '34', '000004926', 'P.S. RECTA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0103', '010308', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('568', '0', '35', '000004927', 'P.S. SAN CARLOS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0103', '010309', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('569', '0', '36', '000004935', 'P.S. SHISPASBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0103', '010310', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('570', '0', '36', '000007051', 'P.S. LA FLORIDA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0103', '010310', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('571', '0', '36', '000007260', 'P.S. COMBOCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0103', '010310', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('572', '0', '37', '000004928', 'P.S. SAN PABLO DE VALERA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0103', '010311', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('573', '0', '37', '000004929', 'P.S. COCACHIMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0103', '010311', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('574', '0', '37', '000004930', 'P.S. MATIAZA RIMACHI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0103', '010311', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('575', '0', '37', '000007052', 'P.S. LA COCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0103', '010311', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('576', '0', '38', '000004936', 'P.S. PROGRESO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0103', '010312', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('577', '0', '38', '000004937', 'P.S. BUENOS AIRES', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0103', '010312', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('578', '0', '38', '000004938', 'P.S. YAMBRASBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0103', '010312', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('579', '0', '38', '000004939', 'P.S. LA ESPERANZA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0103', '010312', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('580', '0', '38', '000007055', 'P.S. LA FLORIDA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0103', '010312', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('581', '0', '38', '000007056', 'P.S. PERLA DE IMAZA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0103', '010312', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('582', '0', '38', '000007058', 'P.S. VILLA HERMOSA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0103', '010312', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('583', '0', '38', '000007378', 'P.S. CHAYUYAKU', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0103', '010312', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('584', '0', '39', '000005146', 'P.S. IPAKUMA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010401', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('585', '0', '39', '000005147', 'C.S. PUTUYAKAT', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0104', '010401', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('586', '0', '39', '000005148', 'P.S. PAKINTSA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010401', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('587', '0', '39', '000005149', 'C.S. KIGKIS', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0104', '010401', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('588', '0', '39', '000005150', 'P.S. NAPURUKA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010401', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('589', '0', '39', '000005152', 'P.S. CACHIACCO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010401', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('590', '0', '39', '000005153', 'P.S. PUMPUSHAK', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010401', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('591', '0', '39', '000005154', 'P.S. YUMINGKUS', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010401', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('592', '0', '39', '000005155', 'P.S. URAKUSA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010401', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('593', '0', '39', '000005156', 'P.S. ALTO KANAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010401', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('594', '0', '39', '000005157', 'P.S. NUEVO SEASME', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010401', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('595', '0', '39', '000005158', 'P.S. CIRO ALEGRIA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010401', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('596', '0', '39', '000005159', 'P.S. KAYAMAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010401', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('597', '0', '39', '000005160', 'P.S. CENTRO TUNDUZA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010401', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('598', '0', '39', '000005161', 'P.S. SAASA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010401', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('599', '0', '39', '000006922', 'P.S. TAYUNTSA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010401', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('600', '0', '39', '000007134', 'C.S. NIEVA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0104', '010401', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('601', '0', '39', '000007202', 'P.S. PAANTAM', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010401', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('602', '0', '39', '000007328', 'P.S. CUZUMATAK', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010401', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('603', '0', '39', '000007330', 'P.S. ALAN GARCIA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010401', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('604', '0', '39', '000007331', 'P.S. NUMPATKAIM', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010401', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('605', '0', '39', '000007376', 'P.S. BAJO PUPUNTAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010401', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('606', '0', '39', '000010302', 'P.S. CHORROS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010401', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('607', '0', '40', '000005162', 'C.S. HUAMPAMI', 'I-4', 'CENTRO DE SALUD', '0', '1', '1', '01', '0104', '010402', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('608', '0', '40', '000005163', 'P.S. KUSU PAGATA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010402', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('609', '0', '40', '000005164', 'P.S. TEESH', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010402', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('610', '0', '40', '000005165', 'P.S. KUSU KUBAIM', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010402', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('611', '0', '40', '000005166', 'P.S. MAMAYAQUE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010402', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('612', '0', '40', '000005167', 'P.S. ACHUIM', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010402', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('613', '0', '40', '000005168', 'P.S. SHAMATAK GRANDE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010402', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('614', '0', '40', '000005169', 'P.S. KUSU NUMPATKAIM', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010402', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('615', '0', '40', '000005170', 'P.S. PAMPA ENTZA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010402', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('616', '0', '40', '000005171', 'P.S. BUCHIGKIM', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010402', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('617', '0', '40', '000005172', 'P.S. WAWAIN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010402', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('618', '0', '40', '000005173', 'P.S. SHAIM', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010402', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('619', '0', '40', '000005174', 'P.S. TUANG ENTSA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010402', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('620', '0', '40', '000007329', 'P.S. ACHU', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010402', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('621', '0', '40', '000007377', 'P.S. TUTINO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010402', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('622', '0', '40', '000007724', 'P.S. CANGA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010402', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('623', '0', '41', '000005175', 'C.S. GALILEA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0104', '010403', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('624', '0', '41', '000005176', 'P.S. GUAYABAL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010403', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('625', '0', '41', '000005177', 'P.S. CHAPIZA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010403', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('626', '0', '41', '000005178', 'P.S. YUTUPIS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010403', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('627', '0', '41', '000005179', 'P.S. VILLA GONZALO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010403', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('628', '0', '41', '000005180', 'P.S. CANDUNGOS', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010403', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('629', '0', '41', '000005181', 'P.S. CHINGANAZA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010403', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('630', '0', '41', '000005182', 'P.S. YUJACKIM', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010403', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('631', '0', '41', '000005183', 'P.S. SOLEDAD', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010403', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('632', '0', '41', '000005184', 'P.S. BELEN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010403', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('633', '0', '41', '000005185', 'P.S. CUCUAZA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010403', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('634', '0', '41', '000005186', 'P.S. PAPAYACU', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010403', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('635', '0', '41', '000005187', 'P.S. SAN RAFAEL', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0104', '010403', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('636', '0', '41', '000005188', 'P.S. CATERPIZA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010403', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('637', '0', '41', '000005189', 'P.S. ALTO YUTUPIS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010403', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('638', '0', '41', '000005190', 'P.S. HUABAL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010403', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('639', '0', '41', '000005191', 'P.S. AITAM', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010403', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('640', '0', '41', '000005192', 'P.S. AMPAMA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010403', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('641', '0', '41', '000006663', 'P.S. PASHKUS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010403', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('642', '0', '41', '000007203', 'P.S. NAUTA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010403', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('643', '0', '41', '000007270', 'P.S. CHOSICA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010403', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('644', '0', '41', '000007728', 'P.S. AYAMBIS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0104', '010403', '01', '04', '', '');
INSERT INTO establecimiento VALUES ('645', '0', '42', '000004850', 'C.S. LAMUD', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010501', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('646', '0', '42', '000007379', 'P.S. CUEMAL', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0105', '010501', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('647', '0', '43', '000004873', 'C.S. CAMPORREDONDO', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0105', '010502', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('648', '0', '43', '000004874', 'P.S. COCOCHO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010502', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('649', '0', '43', '000004875', 'P.S. GUADALUPE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010502', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('650', '0', '43', '000007181', 'P.S. EL PALTO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010502', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('651', '0', '43', '000007333', 'P.S. LA LIBERTAD', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010502', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('652', '0', '44', '000004885', 'C.S. COCABAMBA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0105', '010503', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('653', '0', '44', '000004886', 'P.S. YOMBLON DE COCABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010503', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('654', '0', '44', '000004893', 'P.S. QUISQUIS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010503', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('655', '0', '44', '000004894', 'P.S. MENDAN', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010503', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('656', '0', '44', '000007066', 'P.S. CHUILON', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010503', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('657', '0', '44', '000007206', 'P.S. BALERIANA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010503', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('658', '0', '44', '000007334', 'P.S. BUENA VISTA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010503', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('659', '0', '45', '000004895', 'C.S. COLCAMAR', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0105', '010504', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('660', '0', '45', '000004896', 'P.S. PONAYA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010504', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('661', '0', '45', '000006987', 'P.S. QUILLILLIC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010504', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('662', '0', '45', '000009670', 'P.S. COCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010504', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('663', '0', '46', '000004863', 'P.S. CONILA COHECHAN', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010505', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('664', '0', '46', '000004931', 'P.S. SAN ISIDRO DE QUIUCMAL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010505', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('665', '0', '46', '000007274', 'P.S. NUEVO LUYA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010505', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('666', '0', '47', '000004864', 'P.S. INGUILPATA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010506', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('667', '0', '48', '000004897', 'P.S. LONGUITA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010507', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('668', '0', '48', '000004898', 'P.S. CHOCTAMAL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010507', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('669', '0', '49', '000004865', 'P.S. LONYA CHICO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010508', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('670', '0', '49', '000009674', 'P.S. SAN PEDRO Y SAN PABLO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010508', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('671', '0', '49', '000013019', 'P.S. CAMELIN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010508', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('672', '0', '50', '000004866', 'C.S. LUYA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0105', '010509', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('673', '0', '50', '000004867', 'P.S. CHOCTA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010509', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('674', '0', '50', '000007063', 'P.S. SHIPATA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010509', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('675', '0', '50', '000007332', 'P.S. COLMATA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010509', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('676', '0', '50', '000007380', 'P.S. COROBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010509', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('677', '0', '51', '000004851', 'P.S. LUYA VIEJO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010510', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('678', '0', '52', '000004899', 'C.S. MARIA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010511', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('679', '0', '53', '000004876', 'C.S. OCALLI', 'I-4', 'CENTRO DE SALUD', '0', '1', '1', '01', '0105', '010512', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('680', '0', '53', '000004877', 'P.S. QUISPE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010512', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('681', '0', '53', '000007059', 'P.S. TACTAMAL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010512', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('682', '0', '53', '000007153', 'P.S. CELCHO CUZCO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010512', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('683', '0', '54', '000004843', 'C.S. COLLONCE', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0105', '010513', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('684', '0', '54', '000004844', 'P.S. SAN JUAN DE OCUMAL', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010513', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('685', '0', '54', '000004845', 'P.S. CALDERA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010513', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('686', '0', '54', '000007060', 'P.S. YAULICACHI', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010513', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('687', '0', '54', '000007244', 'P.S. VISTA HERMOSA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010513', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('688', '0', '55', '000004846', 'P.S. PIRCAPAMPA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010514', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('689', '0', '55', '000004847', 'P.S. SAN MIGUEL DE PORO PORO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010514', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('690', '0', '55', '000004848', 'P.S. HUARANGUILLO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010514', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('691', '0', '55', '000004900', 'P.S. YOMBLON DE PISUQUIA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010514', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('692', '0', '55', '000004901', 'C.S. TRIBULON', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0105', '010514', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('693', '0', '55', '000004902', 'P.S. PISUQUIA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010514', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('694', '0', '55', '000007065', 'P.S. SAN RAMON', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010514', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('695', '0', '55', '000007419', 'P.S. EL REJO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010514', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('696', '0', '55', '000009671', 'P.S. PUEBLO NUEVO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010514', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('697', '0', '55', '000009894', 'P.S. MEMBRILLO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010514', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('698', '0', '56', '000004849', 'P.S. PROVIDENCIA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010515', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('699', '0', '56', '000007061', 'P.S. NUEVO CHOTA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010515', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('700', '0', '56', '000009130', 'P.S. PLAYA JUMETH', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010515', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('701', '0', '57', '000004852', 'P.S. SAN CRISTOBAL DE OLTO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010516', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('702', '0', '58', '000004862', 'P.S. SAN FRANCISCO DEL YESO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010517', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('703', '0', '59', '000004853', 'P.S. PACLAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010518', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('704', '0', '60', '000004910', 'P.S. SAN JUAN DE LOPECANCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010519', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('705', '0', '60', '000004911', 'P.S. EL MANGO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010519', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('706', '0', '61', '000004854', 'P.S. SANTA CATALINA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010520', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('707', '0', '61', '000004913', 'P.S. SALAZAR', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010520', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('708', '0', '61', '000004914', 'P.S. INGENIO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010520', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('709', '0', '61', '000009844', 'P.S. SAN JUAN DE PROVIDENCIA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010520', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('710', '0', '62', '000004887', 'C.S. SANTO TOMAS', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0105', '010521', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('711', '0', '62', '000004888', 'P.S. SAN SALVADOR', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010521', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('712', '0', '62', '000004889', 'P.S. MARAYPATA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010521', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('713', '0', '62', '000004890', 'P.S. LLACTAPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010521', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('714', '0', '62', '000007172', 'P.S. AGUA SANTA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010521', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('715', '0', '62', '000007381', 'P.S. TINTIN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010521', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('716', '0', '63', '000004903', 'C.S. TINGO', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0105', '010522', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('717', '0', '63', '000007064', 'P.S. KUELAP', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010522', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('718', '0', '64', '000004855', 'P.S. TRITA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010523', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('719', '0', '64', '000007062', 'P.S. CRUZPATA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0105', '010523', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('720', '0', '66', '000004953', 'P.S. CHIRIMOTO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010602', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('721', '0', '66', '000004954', 'C.S. ZARUMILLA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0106', '010602', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('722', '0', '66', '000006990', 'P.S. ACHAMAL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010602', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('723', '0', '66', '000007075', 'P.S. LUZ DEL ORIENTE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010602', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('724', '0', '66', '000007077', 'P.S. SAN ANTONIO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010602', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('725', '0', '66', '000007201', 'P.S. SANTO TORIBIO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010602', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('726', '0', '67', '000004942', 'P.S. COCHAMAL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010603', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('727', '0', '68', '000004943', 'C.S. HUAMBO', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0106', '010604', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('728', '0', '68', '000006989', 'P.S. NUEVO HORIZONTE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010604', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('729', '0', '68', '000007445', 'P.S. CHONTAPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010604', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('730', '0', '69', '000004955', 'P.S. LIMABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010605', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('731', '0', '69', '000007074', 'P.S. MONTEALEGRE', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010605', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('732', '0', '70', '000004944', 'C.S. LONGAR', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0106', '010606', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('733', '0', '70', '000011727', 'P.S. SHUCUSH', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010606', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('734', '0', '71', '000004945', 'C.S. MARISCAL BENAVIDES', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010607', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('735', '0', '71', '000007335', 'P.S. MICHINA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010607', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('736', '0', '72', '000004956', 'P.S. MILPUC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010608', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('737', '0', '72', '000007446', 'P.S. CHONTAPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010608', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('738', '0', '73', '000004946', 'C.S. OMIA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0106', '010609', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('739', '0', '73', '000004947', 'C.S. NUEVO CHIRIMOTO', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0106', '010609', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('740', '0', '73', '000004948', 'P.S. LEGIA CHICO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010609', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('741', '0', '73', '000004949', 'P.S. TOCUYA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010609', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('742', '0', '73', '000006991', 'P.S. EL LIBANO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010609', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('743', '0', '73', '000007054', 'P.S. EL DORADO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010609', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('744', '0', '73', '000007073', 'P.S. LA PRIMAVERA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010609', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('745', '0', '73', '000007076', 'P.S. NUEVO CHACHAPOYAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010609', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('746', '0', '73', '000007252', 'P.S. VISTA HERMOZA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010609', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('747', '0', '73', '000007382', 'P.S. EL GUAMBO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010609', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('748', '0', '73', '000009680', 'P.S. GARZAYACU', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010609', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('749', '0', '73', '000011169', 'P.S. NUEVO OMIA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010609', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('750', '0', '73', '000011723', 'P.S. MASHUYACU', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010609', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('751', '0', '73', '000011725', 'P.S. JAVRULOT', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010609', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('752', '0', '73', '000014169', 'P.S. PAUJIL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010609', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('753', '0', '74', '000004957', 'P.S. SANTA ROSA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010610', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('754', '0', '75', '000004958', 'C.S. TOTORA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0106', '010611', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('755', '0', '76', '000004940', 'P.S. VISTA ALEGRE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010612', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('756', '0', '76', '000007057', 'P.S. SALAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0106', '010612', '01', '01', '', '');
INSERT INTO establecimiento VALUES ('757', '0', '77', '000005126', 'C.S. MIRAFLORES', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('758', '0', '77', '000005127', 'P.S. TOMOCHO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('759', '0', '77', '000005128', 'P.S. BUENA VISTA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('760', '0', '77', '000005129', 'C.S. NUNYA JALCA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('761', '0', '77', '000005130', 'C.S. COLLICATE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('762', '0', '77', '000005131', 'P.S. JAHUANGA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('763', '0', '77', '000005132', 'P.S. NUEVO HORIZONTE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('764', '0', '77', '000005133', 'P.S. PONA ALTA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('765', '0', '77', '000005134', 'C.S. SAN MARTIN', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('766', '0', '77', '000005135', 'P.S. VISTA ALEGRE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('767', '0', '77', '000005136', 'C.S. LA VICTORIA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('768', '0', '77', '000005137', 'P.S. PUEBLO LIBRE', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('769', '0', '77', '000005138', 'P.S. ROSAPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('770', '0', '77', '000006717', 'P.S. PROGRESO SAN ANTONIO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('771', '0', '77', '000006718', 'P.S. NUEVO ORIENTE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('772', '0', '77', '000006805', 'P.S. VISTA HERMOSA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('773', '0', '77', '000006920', 'P.S. SANTA CLARA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('774', '0', '77', '000007043', 'P.S. UTCUBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('775', '0', '77', '000007198', 'P.S. ALTO PERU', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('776', '0', '77', '000007200', 'P.S. EL PINTOR', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('777', '0', '77', '000007225', 'P.S. MORROPON', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('778', '0', '77', '000007272', 'P.S. EL PORVENIR DE MIRAFLORES', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('779', '0', '77', '000007285', 'P.S. SAN LUIS', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('780', '0', '77', '000007287', 'P.S. MIRAFLORES DE BUENAVISTA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('781', '0', '77', '000007288', 'P.S. NUNYA TEMPLE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('782', '0', '77', '000007363', 'P.S. NUEVA INDEPENDENCIA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('783', '0', '77', '000007725', 'P.S. SACHAPOYAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('784', '0', '77', '000007726', 'P.S. EL BALCON', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('785', '0', '77', '000009282', 'P.S. PLAYA GRANDE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('786', '0', '77', '000011971', 'C.S. MAVILA MONTENEGRO MORI', 'I-4', 'CENTRO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('787', '0', '77', '000013126', 'P.S. LA PALMA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('788', '0', '77', '000014078', 'P.S. CAMPO ALEGRE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010701', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('789', '0', '78', '000005092', 'C.S. CAJARURO', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('790', '0', '78', '000005093', 'P.S. ALTO AMAZONAS', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('791', '0', '78', '000005094', 'P.S. MISQUIYACU ALTO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('792', '0', '78', '000005095', 'C.S. SAN JUAN DE LA LIBERTAD', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('793', '0', '78', '000005096', 'C.S. JOSE OLAYA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('794', '0', '78', '000005097', 'P.S. DIAMANTE ALTO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('795', '0', '78', '000005098', 'P.S. EL TIGRE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('796', '0', '78', '000005099', 'C.S. NARANJOS ALTOS', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('797', '0', '78', '000005100', 'P.S. LUNCHICATE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('798', '0', '78', '000005101', 'P.S. MISQUIYACU BAJO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('799', '0', '78', '000005102', 'P.S. BUENOS AIRES', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('800', '0', '78', '000005103', 'C.S. NARANJITOS', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('801', '0', '78', '000005104', 'C.S. SAN CRISTOBAL', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('802', '0', '78', '000005105', 'C.S. EL RON', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('803', '0', '78', '000005106', 'P.S. SEDA FLOR', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('804', '0', '78', '000005107', 'P.S. PROGRESO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('805', '0', '78', '000005108', 'P.S. MANDINGAS ALTO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('806', '0', '78', '000005109', 'P.S. LOS PATOS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('807', '0', '78', '000005110', 'P.S. SANTA CRUZ DE BUENA VISTA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('808', '0', '78', '000006659', 'C.S. ALTO AMAZONAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('809', '0', '78', '000006662', 'P.S. CHALACO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('810', '0', '78', '000006889', 'P.S. EL TRIUNFO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('811', '0', '78', '000007205', 'P.S. DIAMANTE BAJO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('812', '0', '78', '000007207', 'P.S. CHUNGUINA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('813', '0', '78', '000007242', 'P.S. ALTO UTCUBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('814', '0', '78', '000007258', 'P.S. SANTA ISABEL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('815', '0', '78', '000007259', 'P.S. LA UNION', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('816', '0', '78', '000007283', 'P.S. LA ESPERANZA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('817', '0', '78', '000007284', 'P.S. NUEVO PIURA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('818', '0', '78', '000007286', 'P.S. ALTO SAN JOSE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('819', '0', '78', '000007309', 'P.S. EL ALISO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('820', '0', '78', '000007729', 'P.S. SAN JOSE BAJO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('821', '0', '78', '000007730', 'P.S. LA FLORIDA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010702', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('822', '0', '79', '000005111', 'C.S. CUMBA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0107', '010703', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('823', '0', '79', '000005112', 'C.S. NUEVA ESPERANZA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0107', '010703', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('824', '0', '79', '000005113', 'P.S. HUALANGO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010703', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('825', '0', '79', '000005114', 'P.S. TACTAGO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010703', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('826', '0', '79', '000006806', 'P.S. EL REJO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010703', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('827', '0', '79', '000006807', 'P.S. MIRAFLORES', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010703', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('828', '0', '79', '000007250', 'P.S. VISTA HERMOZA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010703', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('829', '0', '79', '000007310', 'P.S. LA FLOR', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010703', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('830', '0', '79', '000007364', 'P.S. OCTUCHO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010703', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('831', '0', '80', '000005066', 'C.S. EL MILAGRO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010704', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('832', '0', '80', '000005067', 'P.S. JOROBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010704', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('833', '0', '80', '000005068', 'P.S. SAN PEDRO DE LA PAPAYA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010704', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('834', '0', '80', '000005069', 'P.S. HUARANGOPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010704', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('835', '0', '80', '000006789', 'P.S. EL REPOSO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010704', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('836', '0', '80', '000006808', 'P.S. SIEMPRE VIVA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010704', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('837', '0', '80', '000007273', 'P.S. EL VALOR', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010704', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('838', '0', '81', '000005139', 'C.S. JAMALCA', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0107', '010705', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('839', '0', '81', '000005140', 'P.S. TAMBOLIC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010705', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('840', '0', '81', '000005141', 'P.S. ASERRADERO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010705', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('841', '0', '81', '000005142', 'P.S. HUILLARAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010705', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('842', '0', '81', '000005143', 'P.S. PURURCO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010705', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('843', '0', '81', '000005144', 'P.S. EL SALAO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010705', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('844', '0', '81', '000006720', 'P.S. SAN MARTIN DE PORRAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010705', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('845', '0', '81', '000006721', 'P.S. DUELAC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010705', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('846', '0', '81', '000006921', 'P.S. VISTA HERMOSA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010705', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('847', '0', '81', '000007197', 'P.S. DUNIA GRANDE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010705', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('848', '0', '81', '000007243', 'P.S. EL LAUREL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010705', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('849', '0', '82', '000005120', 'C.S. LONYA GRANDE', 'I-3', 'CENTRO DE SALUD', '0', '1', '1', '01', '0107', '010706', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('850', '0', '82', '000005121', 'P.S. ROBLEPAMPA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010706', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('851', '0', '82', '000005122', 'P.S. ORTIZ ARRIETA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010706', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('852', '0', '82', '000005123', 'P.S. SAN MIGUEL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010706', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('853', '0', '82', '000005124', 'P.S. YUNGASUYO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010706', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('854', '0', '82', '000007182', 'P.S. SANTA ROSA DE JAIPE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010706', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('855', '0', '82', '000007184', 'P.S. SAN FELIPE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010706', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('856', '0', '82', '000007199', 'P.S. ZAPATALGO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010706', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('857', '0', '82', '000007204', 'P.S. LA UNION', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010706', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('858', '0', '82', '000007311', 'P.S. HUAMBOYA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010706', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('859', '0', '83', '000005115', 'C.S. VISTA ALEGRE DE YAMON', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010707', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('860', '0', '83', '000005116', 'P.S. YAMON', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010707', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('861', '0', '83', '000005117', 'C.S. EL PALTO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010707', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('862', '0', '83', '000005118', 'P.S. MALLETA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010707', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('863', '0', '83', '000005119', 'P.S. SAN RAMON', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010707', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('864', '0', '83', '000007141', 'P.S. PUEBLO NUEVO DE YAMON', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '01', '0107', '010707', '01', '03', '', '');
INSERT INTO establecimiento VALUES ('865', '0', '84', '000001544', 'P.S. MACASHCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020101', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('866', '0', '84', '000001545', 'P.S. HUALLCOR', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020101', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('867', '0', '84', '000001546', 'P.S. SAN NICOLAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020101', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('868', '0', '84', '000001547', 'P.S. YANACOHSCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020101', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('869', '0', '84', '000001548', 'P.S. SANTA CATALINA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020101', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('870', '0', '84', '000001549', 'P.S. HUAMARIN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020101', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('871', '0', '84', '000001555', 'P.S. ICHOCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020101', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('872', '0', '84', '000001556', 'P.S. P.S. COYLLUR', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020101', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('873', '0', '84', '000001562', 'C.S. CISEA HUARUPAMPA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020101', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('874', '0', '84', '000010997', 'P.S. SANTA ROSA DE CANSHAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020101', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('875', '0', '84', '000011002', 'P.S. JAUNA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020101', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('876', '0', '85', '000001730', 'P.S. COCHABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020102', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('877', '0', '85', '000001731', 'P.S. CHIPRE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020102', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('878', '0', '85', '000001732', 'P.S. PUMA PUCLLANAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020102', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('879', '0', '86', '000001733', 'P.S. COLCABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020103', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('880', '0', '87', '000001747', 'P.S. RAYPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020104', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('881', '0', '87', '000001748', 'P.S. HUANCHAY  HZ', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020104', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('882', '0', '88', '000001557', 'C.S. NICRUPAMPA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020105', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('883', '0', '88', '000001558', 'P.S. HUANCHAC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020105', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('884', '0', '88', '000001559', 'P.S. P.S. MARIAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020105', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('885', '0', '88', '000001560', 'P.S. UNCHUS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020105', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('886', '0', '88', '000001561', 'P.S. LLUPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020105', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('887', '0', '88', '000001563', 'P.S. ATIPAYAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020105', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('888', '0', '88', '000001564', 'P.S. HUAYAWILLCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020105', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('889', '0', '88', '000001565', 'P.S. QUENUAYOC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020105', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('890', '0', '88', '000001566', 'P.S. CHINCAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020105', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('891', '0', '88', '000001567', 'P.S. CASHACANCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020105', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('892', '0', '88', '000001568', 'C.S. PALMIRA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020105', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('893', '0', '88', '000001569', 'P.S. SHECTA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020105', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('894', '0', '88', '000001570', 'P.S. MARCAC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020105', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('895', '0', '88', '000001571', 'P.S. OCSHARUTUNA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020105', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('896', '0', '88', '000001572', 'P.S. CURHUAZ', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020105', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('897', '0', '88', '000001573', 'P.S. P.S. PARIA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020105', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('898', '0', '88', '000001574', 'C.S. MONTERREY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020105', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('899', '0', '88', '000001575', 'P.S. CHONTAYOC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020105', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('900', '0', '88', '000001576', 'P.S. CHAVIN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020105', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('901', '0', '88', '000001577', 'P.S. HUANJA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020105', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('902', '0', '89', '000001533', 'P.S. MATAQUITA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020106', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('903', '0', '89', '000001582', 'C.S. JANGAS', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020106', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('904', '0', '90', '000001583', 'P.S. CAJAMARQUILLA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020107', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('905', '0', '91', '000001550', 'P.S. MASHUAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020108', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('906', '0', '91', '000001551', 'P.S. OLLEROS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020108', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('907', '0', '91', '000001552', 'P.S. LLOCLLA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020108', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('908', '0', '91', '000001553', 'P.S. HUARIPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020108', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('909', '0', '91', '000001554', 'P.S. TAYAPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020108', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('910', '0', '92', '000001584', 'P.S. PAMPAS GRANDE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020109', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('911', '0', '93', '000001734', 'C.S. PARIACOTO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020110', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('912', '0', '93', '000001735', 'P.S. FORTALEZA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020110', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('913', '0', '93', '000001736', 'P.S. CHACCHAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020110', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('914', '0', '94', '000001585', 'P.S. PIRA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020111', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('915', '0', '94', '000001586', 'P.S. YUPASH', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020111', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('916', '0', '95', '000001578', 'P.S. TARICA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020112', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('917', '0', '95', '000001579', 'P.S. PALTAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020112', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('918', '0', '95', '000001580', 'P.S. PASHPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020112', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('919', '0', '95', '000001581', 'P.S. COLLON', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0201', '020112', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('920', '0', '96', '000001508', 'C.S. AIJA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0202', '020201', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('921', '0', '97', '000001509', 'P.S. CORIS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0202', '020202', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('922', '0', '97', '000001510', 'P.S. QUISHUAR', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0202', '020202', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('923', '0', '97', '000001511', 'P.S. SAN DAMIAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0202', '020202', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('924', '0', '98', '000001512', 'P.S. HUACLLAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0202', '020203', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('925', '0', '99', '000001513', 'P.S. LA MERCED', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0202', '020204', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('926', '0', '99', '000001514', 'P.S. SANTA  CRUZ', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0202', '020204', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('927', '0', '100', '000001515', 'P.S. SUCCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0202', '020205', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('928', '0', '100', '000006635', 'P.S. LLANQUISH', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0202', '020205', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('929', '0', '101', '000001847', 'C.S. LLAMELLIN', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0203', '020301', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('930', '0', '102', '000001839', 'P.S. UCHUPATA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0203', '020302', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('931', '0', '102', '000001848', 'P.S. ACZO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0203', '020302', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('932', '0', '102', '000001849', 'P.S. CHACAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0203', '020302', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('933', '0', '103', '000001850', 'P.S. CHACCHO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0203', '020303', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('934', '0', '104', '000001851', 'P.S. CHINGAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0203', '020304', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('935', '0', '105', '000001852', 'P.S. MIRGAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0203', '020305', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('936', '0', '105', '000001853', 'P.S. SAN MARTIN DE PARAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0203', '020305', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('937', '0', '105', '000001854', 'P.S. ILLAURO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0203', '020305', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('938', '0', '105', '000011900', 'P.S. SAN ANTONIO DE ACO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0203', '020305', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('939', '0', '106', '000001855', 'P.S. SAN JUAN DE RONTOY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0203', '020306', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('940', '0', '106', '000011236', 'P.S. FLOR DE CANTU', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0203', '020306', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('941', '0', '107', '000001540', 'C.S. HOSPITAL MAMA ASHU CHACAS', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0204', '020401', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('942', '0', '108', '000001541', 'P.S. ACOCHACA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0204', '020402', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('943', '0', '108', '000001542', 'P.S. SAPCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0204', '020402', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('944', '0', '109', '000001479', 'P.S. PAMPA DE LAMPAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0205', '020501', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('945', '0', '109', '000001493', 'C.S. CHIQUIAN', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0205', '020501', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('946', '0', '110', '000001502', 'P.S. LLACLLA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0205', '020502', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('947', '0', '111', '000001485', 'P.S. RAQUIA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0205', '020503', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('948', '0', '112', '000001494', 'P.S. AQUIA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0205', '020504', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('949', '0', '112', '000001495', 'P.S. RACRACHACA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0205', '020504', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('950', '0', '112', '000001496', 'P.S. PACHAPAQUI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0205', '020504', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('951', '0', '113', '000001483', 'P.S. COLCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0205', '020505', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('952', '0', '113', '000001484', 'C.S. CAJACAY', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0205', '020505', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('953', '0', '113', '000001486', 'P.S. SANTA ROSA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0205', '020505', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('954', '0', '114', '000001501', 'P.S. CANIS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0205', '020506', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('955', '0', '115', '000001490', 'P.S. CHASQUITAMBO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0205', '020507', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('956', '0', '116', '000001507', 'C.S. HUALLANCA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0205', '020508', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('957', '0', '117', '000001497', 'P.S. HUASTA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0205', '020509', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('958', '0', '117', '000001498', 'P.S. QUERO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0205', '020509', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('959', '0', '118', '000001491', 'P.S. HUAYLLACAYAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0205', '020510', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('960', '0', '118', '000001492', 'P.S. YUMPE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0205', '020510', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('961', '0', '119', '000001503', 'P.S. GORGORILLO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0205', '020511', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('962', '0', '120', '000001504', 'P.S. MANGAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0205', '020512', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('963', '0', '121', '000001499', 'P.S. PACLLON', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0205', '020513', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('964', '0', '121', '000001500', 'P.S. LLAMAC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0205', '020513', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('965', '0', '122', '000001505', 'P.S. CORPANQUI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0205', '020514', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('966', '0', '123', '000001506', 'P.S. TICLLOS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0205', '020515', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('967', '0', '124', '000001517', 'P.S. MAYA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0206', '020601', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('968', '0', '124', '000001518', 'P.S. TAURIPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0206', '020601', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('969', '0', '124', '000001519', 'P.S. RAMPAC GRANDE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0206', '020601', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('970', '0', '124', '000001520', 'P.S. PARIACACA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0206', '020601', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('971', '0', '124', '000007267', 'P.S. HUALCAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0206', '020601', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('972', '0', '125', '000001521', 'C.S. ACOPAMPA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0206', '020602', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('973', '0', '126', '000001524', 'P.S. AMASHCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0206', '020603', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('974', '0', '126', '000001525', 'P.S. PUNYAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0206', '020603', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('975', '0', '127', '000001528', 'C.S. ANTA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0206', '020604', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('976', '0', '128', '000001522', 'P.S. ATAQUERO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0206', '020605', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('977', '0', '129', '000001534', 'C.S. MARCARA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0206', '020606', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('978', '0', '129', '000001535', 'P.S. PURHUAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0206', '020606', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('979', '0', '129', '000001536', 'P.S. VICOS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0206', '020606', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('980', '0', '129', '000001537', 'P.S. RECUAYHUANCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0206', '020606', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('981', '0', '129', '000006636', 'P.S. COPA GRANDE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0206', '020606', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('982', '0', '130', '000001538', 'P.S. PARIHUANCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0206', '020607', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('983', '0', '131', '000001539', 'P.S. SAN MIGUEL  DE ACO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0206', '020608', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('984', '0', '132', '000001526', 'P.S. SHILLA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0206', '020609', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('985', '0', '133', '000001523', 'P.S. TINCO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0206', '020610', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('986', '0', '134', '000001529', 'C.S. YUNGAR', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0206', '020611', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('987', '0', '134', '000001530', 'P.S. POYOR', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0206', '020611', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('988', '0', '134', '000001531', 'P.S. SANTA ROSA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0206', '020611', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('989', '0', '134', '000001532', 'P.S. TRIGOPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0206', '020611', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('990', '0', '135', '000001856', 'C.S. SAN LUIS', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0207', '020701', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('991', '0', '135', '000001857', 'P.S. POMALLUCAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0207', '020701', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('992', '0', '135', '000001858', 'P.S. HUMANHUAUCO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0207', '020701', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('993', '0', '135', '000001859', 'P.S. UCHUSQUILLO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0207', '020701', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('994', '0', '135', '000001860', 'P.S. CANCHABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0207', '020701', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('995', '0', '136', '000001863', 'C.S. SAN NICOLAS', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0207', '020702', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('996', '0', '136', '000001864', 'P.S. RURISH', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0207', '020702', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('997', '0', '136', '000001865', 'P.S. PUESTO DE SALUD LLAMACA II', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0207', '020702', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('998', '0', '137', '000001861', 'C.S. YAUYA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0207', '020703', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('999', '0', '137', '000001862', 'P.S. CHINCHO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0207', '020703', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1000', '0', '137', '000006631', 'P.S. P.S. TAMBO REAL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0207', '020703', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1001', '0', '137', '000006632', 'P.S. P.S. SAN MIGUEL DE JUNCAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0207', '020703', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1002', '0', '137', '000016569', 'P.S. SAN FRANCISCO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0207', '020703', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1003', '0', '138', '000001720', 'P.S. SAN RAFAEL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0208', '020801', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1004', '0', '138', '000001721', 'P.S. LA GRAMITA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0208', '020801', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1005', '0', '138', '000001722', 'P.S. CASA BLANCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0208', '020801', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1006', '0', '139', '000001723', 'C.S. BUENAVISTA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0208', '020802', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1007', '0', '139', '000001724', 'P.S. HUANCHUY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0208', '020802', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1008', '0', '139', '000001725', 'P.S. EL OLIVAR', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0208', '020802', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1009', '0', '140', '000001726', 'P.S. COMANDANTE NOEL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0208', '020803', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1010', '0', '140', '000001727', 'P.S. TORTUGAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0208', '020803', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1011', '0', '141', '000001728', 'C.S. YAUTAN', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0208', '020804', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1012', '0', '141', '000001729', 'P.S. CACHIPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0208', '020804', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1013', '0', '142', '000001625', 'C.S. CORONGO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0209', '020901', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1014', '0', '143', '000001626', 'P.S. ACO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0209', '020902', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1015', '0', '144', '000001627', 'P.S. BAMBAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0209', '020903', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1016', '0', '145', '000001628', 'P.S. CUSCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0209', '020904', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1017', '0', '145', '000001629', 'P.S. TARICA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0209', '020904', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1018', '0', '145', '000001630', 'P.S. URCON', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0209', '020904', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1019', '0', '145', '000006637', 'P.S. A.R. HUALLCALLANCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0209', '020904', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1020', '0', '146', '000001631', 'P.S. LA PAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0209', '020905', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1021', '0', '147', '000001602', 'P.S. YANAC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0209', '020906', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1022', '0', '148', '000001632', 'P.S. YUPAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0209', '020907', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1023', '0', '149', '000001814', 'P.S. MALLAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021001', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1024', '0', '149', '000001815', 'P.S. COLCAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021001', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1025', '0', '149', '000001816', 'P.S. YACYA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021001', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1026', '0', '149', '000006638', 'P.S. PUESTO DE SALUD II DE HUAMPARAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021001', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1027', '0', '150', '000001842', 'P.S. ANRA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021002', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1028', '0', '151', '000001817', 'P.S. CAJAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021003', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1029', '0', '151', '000001818', 'P.S. QUERORACRA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021003', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1030', '0', '152', '000001824', 'C.S. CHAVIN', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021004', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1031', '0', '152', '000001825', 'P.S. MACHAC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021004', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1032', '0', '152', '000001826', 'P.S. CHICHUCANCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021004', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1033', '0', '152', '000001829', 'P.S. CHACPAR', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021004', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1034', '0', '153', '000001830', 'P.S. HUACACHI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021005', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1035', '0', '154', '000001841', 'P.S. HUACCHIS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021006', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1036', '0', '154', '000006644', 'P.S. YANAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021006', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1037', '0', '155', '000001831', 'P.S. HUACHIS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021007', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1038', '0', '155', '000001832', 'P.S. CHUPAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021007', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1039', '0', '156', '000001823', 'P.S. HUANTAR', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021008', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1040', '0', '156', '000006639', 'P.S. CHUCOS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021008', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1041', '0', '157', '000001840', 'P.S. MASIN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021009', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1042', '0', '157', '000006642', 'P.S. ACCHAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021009', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1043', '0', '158', '000001843', 'P.S. PAUCAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021010', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1044', '0', '158', '000001844', 'P.S. VISCAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021010', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1045', '0', '159', '000001833', 'P.S. PONTO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021011', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1046', '0', '159', '000001834', 'P.S. SAN MIGUEL DE PONTO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021011', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1047', '0', '159', '000011237', 'P.S. CONIN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021011', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1048', '0', '160', '000001835', 'P.S. YUNGUILLA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021012', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1049', '0', '160', '000001836', 'C.S. RAHUAPAMPA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021012', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1050', '0', '161', '000001845', 'P.S. RAPAYAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021013', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1051', '0', '162', '000001819', 'C.S. SAN MARCOS', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021014', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1052', '0', '162', '000001820', 'P.S. CARHUAYACO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021014', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1053', '0', '162', '000001821', 'P.S. SAN PEDRO DE PICHIU', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021014', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1054', '0', '162', '000001822', 'P.S. CHALHUAYACO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021014', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1055', '0', '162', '000001828', 'P.S. HUARIPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021014', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1056', '0', '163', '000001827', 'P.S. SANTA CRUZ DE PICHIU', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021015', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1057', '0', '163', '000001837', 'P.S. SAN PEDRO DE CHANA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021015', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1058', '0', '163', '000001838', 'P.S. VICHON', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021015', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1059', '0', '164', '000001846', 'P.S. UCO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0210', '021016', '02', '05', '', '');
INSERT INTO establecimiento VALUES ('1060', '0', '165', '000001742', 'P.S. PUERTO HUARMEY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0211', '021101', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1061', '0', '165', '000001744', 'P.S. LA VICTORIA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0211', '021101', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1062', '0', '165', '000001751', 'P.S. HUAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0211', '021101', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1063', '0', '166', '000001749', 'P.S. COCHAPETI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0211', '021102', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1064', '0', '166', '000001750', 'P.S. LAMPI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0211', '021102', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1065', '0', '167', '000001743', 'P.S. CULEBRAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0211', '021103', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1066', '0', '167', '000001745', 'P.S. MOLINO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0211', '021103', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1067', '0', '167', '000001746', 'P.S. QUIAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0211', '021103', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1068', '0', '168', '000001752', 'P.S. HUAYAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0211', '021104', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1069', '0', '169', '000001753', 'P.S. MALVAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0211', '021105', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1070', '0', '169', '000001801', 'P.S. SAN MIGUEL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0211', '021105', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1071', '0', '170', '000001588', 'P.S. PAVAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021201', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1072', '0', '170', '000001589', 'P.S. LLACSHU', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021201', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1073', '0', '170', '000001590', 'P.S. YURACOTO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021201', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1074', '0', '170', '000001591', 'P.S. COCHAMARCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021201', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1075', '0', '170', '000001592', 'P.S. PUESTO DE SALUD HUAUYA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021201', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1076', '0', '170', '000001593', 'P.S. PAMPACOCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021201', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1077', '0', '171', '000001596', 'C.S. HUALLANCA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021202', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1078', '0', '171', '000001597', 'P.S. CALLHUASH', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021202', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1079', '0', '171', '000001598', 'P.S. COLCAP', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021202', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1080', '0', '172', '000001603', 'P.S. HUATA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021203', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1081', '0', '172', '000001604', 'P.S. RACRACAYAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021203', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1082', '0', '173', '000001607', 'P.S. HUAYLAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021204', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1083', '0', '174', '000001605', 'C.S. MATO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021205', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1084', '0', '174', '000001606', 'P.S. ANCORACA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021205', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1085', '0', '175', '000001617', 'C.S. PAMPAROMAS', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021206', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1086', '0', '175', '000001618', 'P.S. PAMPAP', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021206', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1087', '0', '175', '000001619', 'P.S. ULLPAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021206', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1088', '0', '175', '000001620', 'P.S. CAJABAMBA BAJA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021206', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1089', '0', '175', '000001621', 'P.S. CHACLANCAYO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021206', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1090', '0', '175', '000001622', 'P.S. CHUNYA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021206', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1091', '0', '175', '000001623', 'P.S. PISHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021206', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1092', '0', '175', '000001624', 'P.S. PICHIU', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021206', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1093', '0', '176', '000001611', 'C.S. PUEBLO LIBRE', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021207', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1094', '0', '176', '000001612', 'P.S. CARHUA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021207', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1095', '0', '176', '000001613', 'P.S. HUANAYO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021207', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1096', '0', '176', '000001614', 'P.S. ACOYO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021207', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1097', '0', '176', '000001615', 'P.S. HUAMANCAYAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021207', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1098', '0', '176', '000001616', 'P.S. SAN JUAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021207', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1099', '0', '177', '000001594', 'P.S. SANTA CRUZ', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021208', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1100', '0', '177', '000001595', 'C.S. HUARIPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021208', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1101', '0', '177', '000001610', 'P.S. COLCAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021208', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1102', '0', '178', '000001608', 'P.S. SANTO TORIBIO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021209', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1103', '0', '178', '000001609', 'P.S. ISCAP', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021209', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1104', '0', '179', '000001599', 'P.S. YURACMARCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021210', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1105', '0', '179', '000001600', 'P.S. SANTA ROSA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021210', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1106', '0', '179', '000001601', 'P.S. QUITARACZA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0212', '021210', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1107', '0', '180', '000001783', 'C.S. PISCOBAMBA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0213', '021301', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1108', '0', '180', '000001784', 'P.S. SOCOSBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0213', '021301', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1109', '0', '181', '000001785', 'P.S. CASCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0213', '021302', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1110', '0', '182', '000001786', 'P.S. PAMPACHACRA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0213', '021303', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1111', '0', '182', '000001787', 'P.S. PUMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0213', '021303', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1112', '0', '183', '000001793', 'P.S. SANASHGAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0213', '021304', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1113', '0', '183', '000001794', 'P.S. PARCO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0213', '021304', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1114', '0', '184', '000001788', 'P.S. LLAMA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0213', '021305', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1115', '0', '185', '000001650', 'P.S. YURMA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0213', '021306', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1116', '0', '185', '000001789', 'P.S. LLUMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0213', '021306', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1117', '0', '185', '000009838', 'P.S. SALAPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0213', '021306', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1118', '0', '185', '000009839', 'P.S. CHINGUIL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0213', '021306', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1119', '0', '186', '000001790', 'P.S. LUCMA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0213', '021307', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1120', '0', '186', '000001791', 'P.S. SECCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0213', '021307', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1121', '0', '186', '000017687', 'P.S. P. S. MASQUI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0213', '021307', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1122', '0', '187', '000001792', 'P.S. MUSGA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0213', '021308', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1123', '0', '188', '000001755', 'P.S. OCROS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0214', '021401', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('1124', '0', '189', '000001756', 'P.S. ACAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0214', '021402', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('1125', '0', '190', '000001757', 'P.S. CAJAMARQUILLA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0214', '021403', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('1126', '0', '191', '000001758', 'P.S. ACO DE CARHUAPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0214', '021404', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('1127', '0', '192', '000001759', 'P.S. HUANCHAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0214', '021405', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('1128', '0', '193', '000001760', 'P.S. CONGAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0214', '021406', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('1129', '0', '194', '000001761', 'P.S. LLIPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0214', '021407', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('1130', '0', '195', '000001762', 'P.S. RAJAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0214', '021408', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('1131', '0', '196', '000001763', 'P.S. SAN PEDRO DE COPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0214', '021409', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('1132', '0', '197', '000001764', 'P.S. CHILCAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0214', '021410', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('1133', '0', '198', '000001684', 'C.S. CENTRO DE SALUD CABANA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0215', '021501', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1134', '0', '199', '000001685', 'P.S. PUESTO DE SALUD BOLOGNESI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0215', '021502', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1135', '0', '199', '000001686', 'P.S. FERRER', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0215', '021502', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1136', '0', '199', '000001694', 'P.S. CACHUBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0215', '021502', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1137', '0', '200', '000001688', 'C.S. CONCHUCOS', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0215', '021503', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1138', '0', '200', '000001689', 'P.S. MAYAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0215', '021503', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1139', '0', '200', '000001690', 'P.S. HUATAULLO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0215', '021503', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1140', '0', '200', '000001691', 'P.S. CHALAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0215', '021503', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1141', '0', '201', '000001693', 'P.S. HUACASCHUQUE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0215', '021504', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1142', '0', '202', '000001687', 'P.S. HUANDOVAL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0215', '021505', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1143', '0', '203', '000001692', 'P.S. LACABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0215', '021506', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1144', '0', '204', '000001702', 'P.S. LLAPO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0215', '021507', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1145', '0', '205', '000001695', 'C.S. PALLASCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0215', '021508', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1146', '0', '206', '000001696', 'C.S. CENTRO DE SALUD PAMPAS', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0215', '021509', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1147', '0', '206', '000001697', 'P.S. MONGON', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0215', '021509', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1148', '0', '206', '000001698', 'P.S. UCHUPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0215', '021509', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1149', '0', '206', '000006634', 'P.S. P.S. PUYALLI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0215', '021509', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1150', '0', '206', '000006761', 'P.S. PUYALI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0215', '021509', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1151', '0', '207', '000001699', 'P.S. PUESTO DE SALUD SANTA ROSA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0215', '021510', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1152', '0', '208', '000001700', 'P.S. CENTRO DE SALUD TAUCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0215', '021511', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1153', '0', '208', '000001701', 'P.S. HUALALAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0215', '021511', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1154', '0', '209', '000001766', 'P.S. SOCSI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0216', '021601', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1155', '0', '209', '000001767', 'P.S. CHUYAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0216', '021601', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1156', '0', '209', '000001768', 'P.S. VILCABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0216', '021601', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1157', '0', '209', '000001769', 'P.S. CONOPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0216', '021601', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1158', '0', '209', '000001770', 'P.S. JANCAPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0216', '021601', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1159', '0', '209', '000001771', 'P.S. CHOGO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0216', '021601', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1160', '0', '210', '000001772', 'P.S. HUAYLLAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0216', '021602', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1161', '0', '210', '000001773', 'P.S. ACOBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0216', '021602', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1162', '0', '210', '000001774', 'P.S. HUAYCHO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0216', '021602', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1163', '0', '211', '000001775', 'C.S. PAROBAMBA VIEJO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0216', '021603', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1164', '0', '211', '000001776', 'P.S. PAROBAMBA NUEVO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0216', '021603', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1165', '0', '211', '000001777', 'P.S. HUANCHAYLLO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0216', '021603', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1166', '0', '211', '000001778', 'P.S. SHUMPILLAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0216', '021603', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1167', '0', '211', '000001779', 'P.S. CAJAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0216', '021603', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1168', '0', '211', '000001780', 'P.S. CHANGA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0216', '021603', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1169', '0', '212', '000001781', 'P.S. QUINUABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0216', '021604', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1170', '0', '212', '000001782', 'P.S. YAMIAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0216', '021604', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1171', '0', '213', '000001473', 'P.S. COLLAHUASI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0217', '021701', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('1172', '0', '214', '000001476', 'C.S. CATAC', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0217', '021702', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('1173', '0', '215', '000001477', 'P.S. COTAPARACO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0217', '021703', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('1174', '0', '216', '000001480', 'P.S. HUAYLLAPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0217', '021704', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('1175', '0', '217', '000001487', 'P.S. LLACLLIN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0217', '021705', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('1176', '0', '217', '000001488', 'P.S. CHAUCAYAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0217', '021705', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('1177', '0', '218', '000001481', 'P.S. MARCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0217', '021706', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('1178', '0', '219', '000001482', 'P.S. PAMPAS CHICO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0217', '021707', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('1179', '0', '219', '000011003', 'P.S. MAYORARCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0217', '021707', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('1180', '0', '220', '000001489', 'P.S. PARARIN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0217', '021708', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('1181', '0', '221', '000001478', 'P.S. TAPACOCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0217', '021709', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('1182', '0', '222', '000001474', 'P.S. TICAPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0217', '021710', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('1183', '0', '222', '000001475', 'P.S. CAYAC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0217', '021710', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('1184', '0', '223', '000001653', 'P.S. PUESTO DE SALUD SAN JUAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021801', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1185', '0', '223', '000001654', 'C.S. MIRAFLORES ALTO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021801', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1186', '0', '223', '000001655', 'C.S. FLORIDA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021801', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1187', '0', '223', '000001656', 'P.S. CAMBIO PUENTE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021801', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1188', '0', '223', '000001657', 'P.S. CHACHAPOYAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021801', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1189', '0', '223', '000001658', 'P.S. 14 INCAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021801', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1190', '0', '223', '000001659', 'C.S. CENTRO DE SALUD PROGRESO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021801', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1191', '0', '223', '000001660', 'P.S. LA UNION', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021801', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1192', '0', '223', '000001661', 'P.S. PUESTO DE SALUD SAN PEDRO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021801', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1193', '0', '223', '000001662', 'P.S. VICTOR  RAUL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021801', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1194', '0', '223', '000001663', 'P.S. PUESTO DE SALUD TUPAC AMARU', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021801', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1195', '0', '223', '000001664', 'P.S. LA ESPERANZA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021801', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1196', '0', '223', '000001665', 'P.S. CASCAJAL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021801', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1197', '0', '223', '000001666', 'P.S. LACRAMARCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021801', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1198', '0', '223', '000001667', 'P.S. P.S. LUPAHUARY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021801', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1199', '0', '223', '000001669', 'P.S. P.S. MAGDALENA NUEVA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021801', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1200', '0', '223', '000001670', 'P.S. SANTA ANA COSTA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021801', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1201', '0', '223', '000001671', 'P.S. DOS DE MAYO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021801', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1202', '0', '224', '000001708', 'P.S. JIMBE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021802', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1203', '0', '224', '000001709', 'P.S. LAMPANIN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021802', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1204', '0', '224', '000001710', 'P.S. COLCAP', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021802', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1205', '0', '225', '000001675', 'C.S. C.S. COISHCO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021803', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1206', '0', '226', '000001668', 'P.S. SANTA ANA SIERRA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021804', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1207', '0', '226', '000001672', 'P.S. P.S. SANTA ROSA DE PAQUIRCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021804', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1208', '0', '226', '000001673', 'P.S. MACATE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021804', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1209', '0', '226', '000001674', 'P.S. HUANROC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021804', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1210', '0', '227', '000001716', 'C.S. MORO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021805', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1211', '0', '227', '000001717', 'P.S. POCOS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021805', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1212', '0', '227', '000001718', 'P.S. CAPTUY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021805', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1213', '0', '228', '000001714', 'C.S. NEPENA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021806', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1214', '0', '228', '000001715', 'C.S. SAN JACINTO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021806', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1215', '0', '229', '000001711', 'P.S. SAMANCO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021807', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('1216', '0', '229', '000001712', 'P.S. LOS CHIMUS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021807', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('1217', '0', '229', '000001713', 'P.S. HUAMBACHO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021807', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('1218', '0', '230', '000001676', 'C.S. CENTRO DE SALUD SANTA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021808', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1219', '0', '230', '000001677', 'P.S. PUERTO SANTA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021808', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1220', '0', '230', '000001678', 'P.S. PUESTO DE SALUD RINCONADA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021808', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1221', '0', '230', '000001679', 'P.S. TAMBO REAL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021808', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1222', '0', '230', '000001680', 'P.S. VINZOS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021808', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1223', '0', '230', '000001681', 'P.S. PUESTO DE SALUD ALTO PERU', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021808', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1224', '0', '230', '000001682', 'P.S. PAMPA DE VINZOS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021808', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1225', '0', '230', '000001683', 'P.S. SUCHIMAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021808', '02', '04', '', '');
INSERT INTO establecimiento VALUES ('1226', '0', '231', '000001704', 'C.S. YUGOSLAVIA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021809', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1227', '0', '231', '000001705', 'P.S. 3 DE OCTUBRE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021809', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1228', '0', '231', '000001706', 'P.S. VILLA MARIA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021809', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1229', '0', '231', '000001707', 'P.S. SATELITE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021809', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1230', '0', '231', '000007266', 'P.S. NICOLAS DE GARATEA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0218', '021809', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1231', '0', '232', '000009731', 'P.S. SAURAPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0219', '021901', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1232', '0', '233', '000001799', 'P.S. ACOBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0219', '021902', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1233', '0', '234', '000001805', 'P.S. ULLOLLUCO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0219', '021903', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1234', '0', '235', '000001797', 'P.S. CASHAPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0219', '021904', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1235', '0', '235', '000001798', 'P.S. PASACANCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0219', '021904', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1236', '0', '236', '000001754', 'P.S. SAN MIGUEL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0219', '021905', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1237', '0', '236', '000001800', 'P.S. CHINGALPO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0219', '021905', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1238', '0', '237', '000001802', 'C.S. HUAYLLABAMBA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0219', '021906', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1239', '0', '237', '000001803', 'P.S. SANTA CLARA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0219', '021906', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1240', '0', '237', '000001804', 'P.S. PIRPO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0219', '021906', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1241', '0', '238', '000001806', 'C.S. QUICHES', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0219', '021907', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1242', '0', '238', '000001807', 'P.S. JOCOSBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0219', '021907', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1243', '0', '239', '000001796', 'P.S. RAGASH', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0219', '021908', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1244', '0', '239', '000009734', 'P.S. QUINGAO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0219', '021908', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1245', '0', '240', '000001808', 'P.S. SAN JUAN CHULLIN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0219', '021909', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1246', '0', '240', '000001809', 'P.S. ANDAYMAYO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0219', '021909', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1247', '0', '240', '000001810', 'P.S. CHINCHOBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0219', '021909', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1248', '0', '240', '000007449', 'P.S. PARIASHPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0219', '021909', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1249', '0', '241', '000001811', 'P.S. SICSIBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0219', '021910', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1250', '0', '241', '000001812', 'P.S. UMBE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0219', '021910', '02', '06', '', '');
INSERT INTO establecimiento VALUES ('1251', '0', '242', '000001634', 'P.S. HUASHAO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022001', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1252', '0', '242', '000001635', 'P.S. CHILCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022001', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1253', '0', '242', '000001636', 'P.S. HUARCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022001', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1254', '0', '242', '000001637', 'P.S. RAYAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022001', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1255', '0', '242', '000001644', 'P.S. MUSHO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022001', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1256', '0', '242', '000001645', 'C.S. TUMPA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022001', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1257', '0', '243', '000001640', 'P.S. CASCAPARA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022002', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1258', '0', '244', '000001527', 'P.S. HUAYPAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022003', '02', '01', '', '');
INSERT INTO establecimiento VALUES ('1259', '0', '244', '000001641', 'C.S. MANCOS', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022003', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1260', '0', '244', '000001642', 'P.S. TINGUA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022003', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1261', '0', '244', '000001643', 'P.S. UTUPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022003', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1262', '0', '244', '000006640', 'P.S. HUASHCAO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022003', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1263', '0', '245', '000001638', 'P.S. MATACOTO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022004', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1264', '0', '246', '000001738', 'C.S. QUILLO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022005', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1265', '0', '246', '000001739', 'P.S. HUACHO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022005', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1266', '0', '246', '000001740', 'P.S. PAMPAC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022005', '02', '00', '', '');
INSERT INTO establecimiento VALUES ('1267', '0', '246', '000006645', 'P.S. PUNAP', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022005', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1268', '0', '247', '000001646', 'P.S. RANRAHIRCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022006', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1269', '0', '247', '000006641', 'P.S. ARHUAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022006', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1270', '0', '248', '000001639', 'P.S. PUTACA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022007', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1271', '0', '248', '000001647', 'P.S. SHUPLUY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022007', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1272', '0', '248', '000001737', 'P.S. PAMPACANCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022007', '02', '03', '', '');
INSERT INTO establecimiento VALUES ('1273', '0', '248', '000006633', 'P.S. TAMBRA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022007', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1274', '0', '248', '000006646', 'P.S. PONCOS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022007', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1275', '0', '249', '000001648', 'C.S. YANAMA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022008', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1276', '0', '249', '000001649', 'P.S. CUNYA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022008', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1277', '0', '249', '000001651', 'P.S. ALPABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022008', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1278', '0', '249', '000006647', 'P.S. LLANLLA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022008', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1279', '0', '249', '000006648', 'P.S. YERBA BUENA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022008', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1280', '0', '249', '000006649', 'P.S. PACARISCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '02', '0220', '022008', '02', '02', '', '');
INSERT INTO establecimiento VALUES ('1281', '0', '250', '000002659', 'C.S. PUEBLO JOVEN CENTENARIO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030101', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1282', '0', '250', '000002660', 'P.S. KARCATERA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030101', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1283', '0', '250', '000002661', 'P.S. MARCAHUASI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030101', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1284', '0', '250', '000002662', 'P.S. QUISAPATA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030101', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1285', '0', '250', '000002663', 'C.S. VILLAGLORIA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030101', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1286', '0', '250', '000002664', 'C.S. BELLAVISTA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030101', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1287', '0', '250', '000007452', 'C.S. METROPOLITANO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030101', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1288', '0', '250', '000007689', 'P.S. HUAYLLABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030101', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1289', '0', '250', '000008824', 'P.S. ATUMPATA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030101', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1290', '0', '250', '000008828', 'P.S. SAN MARTIN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030101', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1291', '0', '250', '000011853', 'P.S. PATIBAMBA BAJA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030101', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1292', '0', '250', '000011976', 'P.S. TABLADA ALTA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030101', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1293', '0', '251', '000002665', 'C.S. CASINCHIHUA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030102', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1294', '0', '251', '000002666', 'P.S. CHACOCHE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030102', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1295', '0', '251', '000008823', 'P.S. ANCHICHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030102', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1296', '0', '252', '000002667', 'P.S. CIRCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030103', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1297', '0', '252', '000002668', 'P.S. OCOBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030103', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1298', '0', '252', '000002669', 'P.S. TAMBURQUI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030103', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1299', '0', '252', '000002684', 'P.S. HUIRAHUACHO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030103', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1300', '0', '253', '000002630', 'C.S. CURAHUASI', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030104', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1301', '0', '253', '000002631', 'P.S. ANTILLA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030104', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1302', '0', '253', '000002632', 'P.S. BACAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030104', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1303', '0', '253', '000002633', 'P.S. CCOLLPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030104', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1304', '0', '253', '000002634', 'P.S. CONCACHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030104', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1305', '0', '253', '000002635', 'P.S. OCCORURO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030104', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1306', '0', '253', '000002636', 'P.S. PISONAYPATA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030104', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1307', '0', '253', '000002637', 'P.S. PROGRESO LARATA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030104', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1308', '0', '253', '000002638', 'P.S. EL CARMEN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030104', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1309', '0', '253', '000002639', 'P.S. SAN LUIS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030104', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1310', '0', '253', '000002689', 'P.S. CCOCHUA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030104', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1311', '0', '253', '000007177', 'P.S. CHUNA MARJUNI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030104', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1312', '0', '253', '000007430', 'P.S. TOTORAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030104', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1313', '0', '254', '000002670', 'C.S. HUANIPACA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030105', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1314', '0', '254', '000002671', 'P.S. KIUNALLA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030105', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1315', '0', '254', '000002672', 'P.S. TACMARA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030105', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1316', '0', '254', '000007690', 'P.S. HUANCHULLA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030105', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1317', '0', '254', '000008822', 'P.S. CCOYA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030105', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1318', '0', '254', '000011639', 'P.S. KARQUEQUI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030105', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1319', '0', '255', '000002647', 'C.S. LAMBRAMA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030106', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1320', '0', '255', '000002648', 'P.S. ATANCAMA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030106', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1321', '0', '255', '000002649', 'P.S. CAYPE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030106', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1322', '0', '255', '000002650', 'P.S. MARJUNI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030106', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1323', '0', '255', '000002651', 'P.S. SIUSAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030106', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1324', '0', '255', '000002652', 'P.S. SUNCHO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030106', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1325', '0', '255', '000002691', 'P.S. CRUZ PATA (LAMBRAMA)', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030106', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1326', '0', '256', '000002673', 'P.S. COTARMA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030107', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1327', '0', '256', '000002674', 'P.S. CHALHUANI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030107', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1328', '0', '256', '000002675', 'P.S. LUCUCHANGA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030107', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1329', '0', '256', '000002676', 'P.S. PICHIRHUA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030107', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1330', '0', '256', '000002677', 'P.S. PISCAYA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030107', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1331', '0', '256', '000002678', 'P.S. ACCOPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030107', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1332', '0', '256', '000002682', 'P.S. AUQUIBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030107', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1333', '0', '256', '000008821', 'P.S. OCRABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030107', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1334', '0', '256', '000013553', 'P.S. ALLPACHACA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030107', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1335', '0', '257', '000002679', 'C.S. CACHORA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030108', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1336', '0', '258', '000002680', 'C.S. TAMBURCO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030109', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1337', '0', '258', '000002681', 'P.S. SAN ANTONIO (TAMBURCO)', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030109', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1338', '0', '258', '000009986', 'P.S. KERAPATA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0301', '030109', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1339', '0', '259', '000004172', 'C.S. HUANCABAMBA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030201', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1340', '0', '259', '000004173', 'P.S. HUINCHOS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030201', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1341', '0', '259', '000004174', 'P.S. SACCLAYA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030201', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1342', '0', '259', '000004175', 'P.S. CCENUARAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030201', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1343', '0', '259', '000004176', 'P.S. SOCCNACANCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030201', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1344', '0', '259', '000004194', 'P.S. CHOCCEPUQUIO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030201', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1345', '0', '259', '000006804', 'C.S. ANDAHUAYLAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030201', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1346', '0', '259', '000012994', 'P.S. SUCARAYLLA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030201', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1347', '0', '260', '000004132', 'C.S. ANDARAPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030202', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1348', '0', '260', '000004133', 'P.S. HUANCAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030202', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1349', '0', '260', '000004134', 'P.S. HUAMPICA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030202', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1350', '0', '260', '000004135', 'P.S. ILLAHUASI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030202', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1351', '0', '260', '000004136', 'C.S. PUYHUALLA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030202', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1352', '0', '260', '000007251', 'P.S. CHANTA UMACA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030202', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1353', '0', '260', '000019629', 'P.S. SAN JUAN DE MIRAFLORES', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030202', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1354', '0', '260', '000019630', 'P.S. SAN JUAN DE MIRAFLORES', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030202', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1355', '0', '261', '000004156', 'P.S. CHIARA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030203', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1356', '0', '261', '000004157', 'P.S. NUEVA HUILLCAYHUA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030203', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1357', '0', '261', '000007165', 'P.S. SANTIAGO DE YAURECC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030203', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1358', '0', '262', '000002640', 'C.S. HUANCARAMA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030204', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1359', '0', '262', '000002641', 'P.S. SAN JOSE DE ARCAHUA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030204', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1360', '0', '262', '000002642', 'P.S. KARHUAKAHUA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030204', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1361', '0', '262', '000002695', 'P.S. PICHIUPATA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030204', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1362', '0', '262', '000002696', 'P.S. SOTAPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030204', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1363', '0', '262', '000007350', 'P.S. LOS ANGELES', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030204', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1364', '0', '262', '000007351', 'P.S. SAYHUA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030204', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1365', '0', '262', '000007352', 'P.S. PAMPAHURA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030204', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1366', '0', '262', '000007353', 'P.S. MATECCLLA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030204', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1367', '0', '262', '000007354', 'P.S. LLACTABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030204', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1368', '0', '263', '000004158', 'C.S. HUANCARAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030205', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1369', '0', '263', '000004159', 'P.S. MOLLEPATA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030205', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1370', '0', '263', '000012990', 'P.S. CCANCCAYLLO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030205', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1371', '0', '263', '000013001', 'P.S. OCCOCHO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030205', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1372', '0', '264', '000004166', 'P.S. HUAYANA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030206', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1373', '0', '264', '000012268', 'P.S. CHECCCHEPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030206', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1374', '0', '265', '000004183', 'C.S. KISHUARA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030207', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1375', '0', '265', '000004184', 'P.S. CAVIRA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030207', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1376', '0', '265', '000004185', 'C.S. MATAPUQUIO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030207', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1377', '0', '265', '000004186', 'P.S. QUILLABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030207', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1378', '0', '265', '000004187', 'P.S. COLPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030207', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1379', '0', '265', '000006915', 'P.S. TINTAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030207', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1380', '0', '265', '000012269', 'P.S. SOTCCOMAYO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030207', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1381', '0', '266', '000002643', 'P.S. HUAMBO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030208', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1382', '0', '266', '000002644', 'P.S. HUASCATAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030208', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1383', '0', '266', '000002645', 'C.S. PACOBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030208', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1384', '0', '266', '000002646', 'P.S. HUIRONAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030208', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1385', '0', '266', '000002697', 'P.S. CCERABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030208', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1386', '0', '266', '000007026', 'P.S. TACMARA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030208', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1387', '0', '266', '000007691', 'P.S. CCALLASPUQUIO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030208', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1388', '0', '267', '000004189', 'C.S. PACUCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030209', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1389', '0', '267', '000004190', 'P.S. PUCULLOCCOCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030209', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1390', '0', '267', '000004191', 'P.S. COTAHUACHO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030209', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1391', '0', '267', '000004192', 'P.S. ARGAMA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030209', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1392', '0', '267', '000004193', 'P.S. CHURRUBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030209', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1393', '0', '267', '000007154', 'P.S. LAGUNA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030209', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1394', '0', '268', '000004167', 'C.S. PAMPACHIRI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030210', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1395', '0', '268', '000004168', 'P.S. CHILLIHUA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030210', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1396', '0', '268', '000004169', 'P.S. LLANCAMA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030210', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1397', '0', '269', '000004170', 'P.S. POMACOCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030211', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1398', '0', '270', '000004160', 'P.S. SAN ANTONIO DE CACHI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030212', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1399', '0', '270', '000004161', 'P.S. CHULLIZANA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030212', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1400', '0', '270', '000004207', 'P.S. TANQUIYAURECC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030212', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1401', '0', '270', '000012940', 'P.S. SAN JUAN DE CULA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030212', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1402', '0', '271', '000004177', 'C.S. SAN JERONIMO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030213', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1403', '0', '271', '000004178', 'P.S. ANCATIRA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030213', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1404', '0', '271', '000004179', 'P.S. CHOCCECANCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030213', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1405', '0', '271', '000004180', 'P.S. CHAMPACCOCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030213', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1406', '0', '271', '000004181', 'C.S. LLIUPAPUQUIO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030213', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1407', '0', '271', '000004182', 'P.S. POLTOCCSA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030213', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1408', '0', '271', '000011899', 'P.S. CHULLCUISA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030213', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1409', '0', '271', '000012017', 'P.S. CUPISA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030213', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1410', '0', '271', '000018568', 'P.S. OLLABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030213', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1411', '0', '272', '000004162', 'P.S. CHACCRAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030214', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1412', '0', '272', '000007236', 'P.S. IGLESIA PATA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030214', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1413', '0', '272', '000018538', 'P.S. SAN JUAN PAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030214', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1414', '0', '272', '000018539', 'P.S. SANTIAGO DE YANACULLO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030214', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1415', '0', '273', '000004202', 'C.S. CHICMO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030215', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1416', '0', '273', '000004203', 'C.S. CASCABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030215', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1417', '0', '273', '000004204', 'C.S. NUEVA ESPERANZA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030215', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1418', '0', '273', '000004205', 'P.S. TARAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030215', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1419', '0', '273', '000007164', 'P.S. REBELDE HUAYRANA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030215', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1420', '0', '273', '000012943', 'P.S. MOYABAMBA BAJA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030215', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1421', '0', '273', '000013941', 'P.S. LAMAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030215', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1422', '0', '274', '000004195', 'C.S. TALAVERA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030216', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1423', '0', '274', '000004196', 'P.S. UCHUHUANCARAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030216', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1424', '0', '274', '000004197', 'P.S. LUIS PATA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030216', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1425', '0', '274', '000004198', 'P.S. PAMPAMARCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030216', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1426', '0', '274', '000004199', 'P.S. LLANTUYHUANCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030216', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1427', '0', '274', '000004200', 'P.S. CCACCACHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030216', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1428', '0', '274', '000007162', 'P.S. MULACANCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030216', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1429', '0', '274', '000013000', 'P.S. OSCCOLLOPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030216', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1430', '0', '275', '000004171', 'C.S. UMAMARCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030217', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1431', '0', '275', '000007155', 'P.S. VILLA SANTA ROSA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030217', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1432', '0', '275', '000010009', 'P.S. CCOCHAPUCRO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030217', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1433', '0', '276', '000004163', 'C.S. TURPO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030218', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1434', '0', '276', '000004164', 'P.S. PALLACCOCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030218', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1435', '0', '276', '000004165', 'P.S. BELEN DE ANTA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030218', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1436', '0', '276', '000006917', 'P.S. TAYPICHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030218', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1437', '0', '276', '000013002', 'P.S. TORACCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030218', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1438', '0', '276', '000018464', 'P.S. YANACCMA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030218', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1439', '0', '276', '000019539', 'P.S. SAN JUAN DE OCCOLLO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030218', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1440', '0', '277', '000004188', 'C.S. KAQUIABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030219', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1441', '0', '277', '000011447', 'P.S. PULLURI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0302', '030219', '03', '03', '', '');
INSERT INTO establecimiento VALUES ('1442', '0', '278', '000002552', 'C.S. CENTRO DE SALUD ANTABAMBA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0303', '030301', '03', '06', '', '');
INSERT INTO establecimiento VALUES ('1443', '0', '278', '000002553', 'P.S. CURANCO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0303', '030301', '03', '06', '', '');
INSERT INTO establecimiento VALUES ('1444', '0', '278', '000002554', 'P.S. CHUNOHUACHO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0303', '030301', '03', '06', '', '');
INSERT INTO establecimiento VALUES ('1445', '0', '279', '000002555', 'P.S. AYAHUAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0303', '030302', '03', '06', '', '');
INSERT INTO establecimiento VALUES ('1446', '0', '280', '000002556', 'P.S. HUAQUIRCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0303', '030303', '03', '06', '', '');
INSERT INTO establecimiento VALUES ('1447', '0', '280', '000002557', 'P.S. MATARA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0303', '030303', '03', '06', '', '');
INSERT INTO establecimiento VALUES ('1448', '0', '280', '000011590', 'P.S. MUTKANI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0303', '030303', '03', '06', '', '');
INSERT INTO establecimiento VALUES ('1449', '0', '280', '000011932', 'P.S. LLANACCOLLPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0303', '030303', '03', '06', '', '');
INSERT INTO establecimiento VALUES ('1450', '0', '281', '000002558', 'C.S. MOLLEBAMBA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0303', '030304', '03', '06', '', '');
INSERT INTO establecimiento VALUES ('1451', '0', '281', '000002559', 'P.S. CALCAUSO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0303', '030304', '03', '06', '', '');
INSERT INTO establecimiento VALUES ('1452', '0', '281', '000002560', 'P.S. VITO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0303', '030304', '03', '06', '', '');
INSERT INTO establecimiento VALUES ('1453', '0', '281', '000002685', 'P.S. SILCO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0303', '030304', '03', '06', '', '');
INSERT INTO establecimiento VALUES ('1454', '0', '281', '000013559', 'P.S. SANTA ROSA DE CALCAUSO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0303', '030304', '03', '06', '', '');
INSERT INTO establecimiento VALUES ('1455', '0', '282', '000002594', 'C.S. TOTORA OROPESA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0303', '030305', '03', '06', '', '');
INSERT INTO establecimiento VALUES ('1456', '0', '282', '000002690', 'P.S. YUMIRI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0303', '030305', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1457', '0', '282', '000007348', 'P.S. HUACULLO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0303', '030305', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1458', '0', '282', '000007438', 'P.S. SONCCOCCOCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0303', '030305', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1459', '0', '282', '000011640', 'P.S. KILCATA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0303', '030305', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1460', '0', '283', '000002561', 'C.S. PACHACONAS', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0303', '030306', '03', '06', '', '');
INSERT INTO establecimiento VALUES ('1461', '0', '283', '000002562', 'P.S. HUANCARAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0303', '030306', '03', '06', '', '');
INSERT INTO establecimiento VALUES ('1462', '0', '283', '000006909', 'P.S. PALCAYNO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0303', '030306', '03', '06', '', '');
INSERT INTO establecimiento VALUES ('1463', '0', '284', '000002563', 'P.S. ANTILLA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0303', '030307', '03', '06', '', '');
INSERT INTO establecimiento VALUES ('1464', '0', '284', '000002564', 'P.S. SABAYNO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0303', '030307', '03', '06', '', '');
INSERT INTO establecimiento VALUES ('1465', '0', '285', '000002569', 'C.S. CHALHUANCA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030401', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1466', '0', '285', '000007441', 'P.S. MUTCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030401', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1467', '0', '285', '000007442', 'P.S. PINCAHUACHO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030401', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1468', '0', '286', '000002566', 'P.S. CAPAYA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030402', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1469', '0', '286', '000002567', 'P.S. CHACAPUENTE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030402', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1470', '0', '286', '000007439', 'P.S. MOSECCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030402', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1471', '0', '287', '000002568', 'P.S. CARAYBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030403', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1472', '0', '287', '000002593', 'P.S. COLCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030403', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1473', '0', '288', '000002570', 'C.S. SANTA ROSA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030404', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1474', '0', '288', '000002571', 'P.S. ANCOBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030404', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1475', '0', '288', '000002572', 'P.S. CHAPIMARCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030404', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1476', '0', '288', '000002573', 'P.S. PAMPALLACTA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030404', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1477', '0', '289', '000002574', 'P.S. COLCABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030405', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1478', '0', '290', '000002575', 'C.S. COTARUSE', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030406', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1479', '0', '290', '000002576', 'P.S. KILCACCASA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030406', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1480', '0', '290', '000002577', 'P.S. PISQUICOCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030406', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1481', '0', '290', '000002686', 'P.S. PAMPAMARCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030406', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1482', '0', '290', '000002688', 'P.S. TOTORA DE AYMARAES', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030406', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1483', '0', '290', '000007344', 'P.S. CCELLOPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030406', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1484', '0', '290', '000007443', 'P.S. LAHUALAHUA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030406', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1485', '0', '290', '000008826', 'P.S. IZCAHUACA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030406', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1486', '0', '291', '000002578', 'P.S. IHUAYLLO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030407', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1487', '0', '291', '000002579', 'P.S. HUAYQUIPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030407', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1488', '0', '292', '000002580', 'P.S. PICHIHUA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030408', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1489', '0', '292', '000007414', 'P.S. CHECCASA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030408', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1490', '0', '293', '000002581', 'C.S. LUCRE', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030409', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1491', '0', '293', '000007346', 'P.S. SICUNA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030409', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1492', '0', '293', '000007415', 'P.S. JUTA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030409', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1493', '0', '293', '000007416', 'P.S. CAYHUACHAHUA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030409', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1494', '0', '294', '000002582', 'P.S. HUANCAPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030410', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1495', '0', '294', '000002583', 'P.S. POCOHUANCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030410', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1496', '0', '294', '000002584', 'P.S. TIAPARO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030410', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1497', '0', '294', '000007027', 'P.S. CHANTA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030410', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1498', '0', '295', '000002687', 'P.S. SAN JUAN DE CHACNA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030411', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1499', '0', '296', '000002585', 'P.S. SANAYCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030412', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1500', '0', '296', '000007129', 'P.S. HUARQUIZA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030412', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1501', '0', '296', '000008825', 'P.S. OCCARALLA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030412', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1502', '0', '297', '000002565', 'P.S. SORAYA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030413', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1503', '0', '297', '000007440', 'P.S. CCARAHUATANI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030413', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1504', '0', '298', '000002586', 'C.S. TAPAYRIHUA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030414', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1505', '0', '298', '000002587', 'P.S. SOCCO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030414', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1506', '0', '298', '000007693', 'P.S. LAYME', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030414', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1507', '0', '299', '000002588', 'C.S. TINTAY', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030415', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1508', '0', '299', '000002589', 'P.S. SAN MATEO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030415', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1509', '0', '299', '000002683', 'P.S. TAQUEBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030415', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1510', '0', '299', '000007028', 'P.S. HUANCARPUQUIO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030415', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1511', '0', '300', '000002590', 'P.S. TORAYA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030416', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1512', '0', '300', '000006650', 'P.S. LLINQUI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030416', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1513', '0', '300', '000007345', 'P.S. TANTA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030416', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1514', '0', '300', '000007692', 'P.S. CONDEBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030416', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1515', '0', '301', '000002591', 'P.S. SARAYCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030417', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1516', '0', '301', '000002592', 'P.S. YANACA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0304', '030417', '03', '07', '', '');
INSERT INTO establecimiento VALUES ('1517', '0', '302', '000002626', 'P.S. CHACCARO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030501', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1518', '0', '302', '000002627', 'P.S. PAMPURA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030501', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1519', '0', '302', '000002628', 'P.S. ASACCASI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030501', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1520', '0', '302', '000002629', 'P.S. OCCACCAHUA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030501', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1521', '0', '302', '000007025', 'P.S. CHOCQUECCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030501', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1522', '0', '302', '000007128', 'P.S. APUMARCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030501', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1523', '0', '302', '000007211', 'P.S. OCRABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030501', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1524', '0', '302', '000007212', 'P.S. PUMAMARCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030501', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1525', '0', '302', '000007219', 'P.S. OCCORURO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030501', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1526', '0', '302', '000008827', 'P.S. HUMAHUIRE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030501', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1527', '0', '302', '000017931', 'P.S. CHOCCOLLO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030501', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1528', '0', '302', '000017935', 'P.S. QQUELLO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030501', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1529', '0', '302', '000018006', 'P.S. CHUROC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030501', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1530', '0', '303', '000002612', 'C.S. COTABAMBAS', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030502', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1531', '0', '303', '000002613', 'P.S. SAN JUAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030502', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1532', '0', '303', '000002692', 'P.S. COLCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030502', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1533', '0', '303', '000013562', 'P.S. CCOCHAPATA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030502', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1534', '0', '303', '000013563', 'P.S. ANARQUI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030502', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1535', '0', '304', '000002614', 'C.S. COYLLURQUI', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030503', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1536', '0', '304', '000002615', 'P.S. NAHUINLLA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030503', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1537', '0', '304', '000002616', 'P.S. VILCARO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030503', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1538', '0', '304', '000002693', 'P.S. PFACO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030503', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1539', '0', '304', '000002694', 'P.S. SORCCO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030503', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1540', '0', '304', '000007130', 'P.S. CHISCCAHUAYLLA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030503', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1541', '0', '304', '000018007', 'P.S. YADQUIRE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030503', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1542', '0', '305', '000002617', 'C.S. HAQUIRA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030504', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1543', '0', '305', '000002618', 'P.S. HUANCCASCCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030504', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1544', '0', '305', '000002619', 'P.S. LLAC-CHUA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030504', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1545', '0', '305', '000002620', 'P.S. PATAN', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030504', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1546', '0', '305', '000002621', 'P.S. CCOCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030504', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1547', '0', '305', '000007216', 'P.S. MUTUHUASI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030504', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1548', '0', '305', '000007217', 'P.S. MOCABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030504', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1549', '0', '305', '000007218', 'P.S. HAPURO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030504', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1550', '0', '305', '000007245', 'P.S. PAMPA SAN JOSE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030504', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1551', '0', '305', '000007246', 'P.S. HUANCA UMUYTO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030504', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1552', '0', '305', '000007355', 'P.S. ANTAPUNCO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030504', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1553', '0', '305', '000011610', 'P.S. QQUEUNAPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030504', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1554', '0', '305', '000017936', 'P.S. CHOQUEMAYO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030504', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1555', '0', '305', '000017937', 'P.S. PISCOCALLA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030504', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1556', '0', '306', '000002622', 'C.S. MARA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030505', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1557', '0', '306', '000002624', 'P.S. PISACCASA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030505', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1558', '0', '306', '000007356', 'P.S. CHACAMACHAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030505', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1559', '0', '306', '000007695', 'P.S. CURCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030505', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1560', '0', '306', '000011591', 'P.S. HUARAQUERAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030505', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1561', '0', '307', '000002611', 'C.S. CHALHUAHUACHO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030506', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1562', '0', '307', '000002623', 'P.S. TAMBULLA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030506', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1563', '0', '307', '000007213', 'P.S. KUCHUHUACHO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030506', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1564', '0', '307', '000007214', 'P.S. MINASCUCHO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030506', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1565', '0', '307', '000007215', 'P.S. ANTA ANTA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030506', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1566', '0', '307', '000008837', 'P.S. FUERABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030506', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1567', '0', '307', '000017933', 'P.S. PATARIO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030506', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1568', '0', '307', '000017934', 'P.S. CCASA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0305', '030506', '03', '08', '', '');
INSERT INTO establecimiento VALUES ('1569', '0', '308', '000004141', 'P.S. CAYARA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030601', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1570', '0', '308', '000007163', 'P.S. CALLEBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030601', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1571', '0', '308', '000007235', 'P.S. CASABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030601', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1572', '0', '309', '000004137', 'C.S. URIPA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030602', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1573', '0', '309', '000004138', 'P.S. TOTORABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030602', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1574', '0', '309', '000004139', 'P.S. MUNAPUCRO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030602', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1575', '0', '309', '000012232', 'P.S. CENTRO MEDICO  PARROQUIAL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030602', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1576', '0', '309', '000012534', 'P.S. CHUPARO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030602', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1577', '0', '310', '000004142', 'P.S. COCHARCAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030603', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1578', '0', '310', '000010010', 'P.S. OSCCOLLO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030603', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1579', '0', '310', '000010011', 'P.S. URUCANCHA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030603', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1580', '0', '311', '000004145', 'C.S. HUACCANA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030604', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1581', '0', '311', '000004146', 'P.S. AHUAYRO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030604', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1582', '0', '311', '000004147', 'P.S. RIO BLANCO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030604', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1583', '0', '311', '000004148', 'C.S. SAURI', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030604', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1584', '0', '311', '000004149', 'P.S. POMACHUCO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030604', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1585', '0', '311', '000007158', 'P.S. MARA MARA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030604', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1586', '0', '311', '000010012', 'P.S. CHUYAMA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030604', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1587', '0', '311', '000011895', 'P.S. MOYACCASA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030604', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1588', '0', '311', '000011896', 'P.S. SIMPE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030604', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1589', '0', '312', '000004153', 'C.S. OCOBAMBA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030605', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1590', '0', '312', '000004154', 'P.S. CHALLHUANI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030605', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1591', '0', '312', '000004155', 'P.S. PISCOBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030605', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1592', '0', '312', '000004201', 'P.S. SACHAPUNA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030605', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1593', '0', '312', '000007736', 'P.S. UMACA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030605', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1594', '0', '312', '000012649', 'P.S. CHOCCEPUQUIO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030605', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1595', '0', '313', '000004150', 'C.S. ONGOY', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030606', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1596', '0', '313', '000004151', 'P.S. HUAMBURQUE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030606', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1597', '0', '313', '000004152', 'C.S. ROCCHACC', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030606', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1598', '0', '313', '000004208', 'P.S. PORVENIR', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030606', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1599', '0', '313', '000006916', 'P.S. SANTA ROSA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030606', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1600', '0', '313', '000007156', 'P.S. TURURO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030606', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1601', '0', '313', '000007157', 'P.S. MOZOBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030606', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1602', '0', '313', '000007159', 'P.S. CALLAPAYOCC', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030606', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1603', '0', '313', '000012535', 'P.S. CABANA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030606', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1604', '0', '314', '000004144', 'P.S. URANMARCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030607', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1605', '0', '314', '000004206', 'P.S. HUANCANE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030607', '03', '05', '', '');
INSERT INTO establecimiento VALUES ('1606', '0', '314', '000007160', 'P.S. TANCAYLLO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030607', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1607', '0', '315', '000004143', 'C.S. RANRACANCHA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030608', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1608', '0', '315', '000004209', 'P.S. HUARIBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030608', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1609', '0', '315', '000007161', 'P.S. MOTOY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030608', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1610', '0', '315', '000011170', 'P.S. OCCEPATA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030608', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1611', '0', '315', '000011897', 'P.S. SAN CRISTOBAL', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030608', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1612', '0', '315', '000011898', 'P.S. PADRE RUMI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0306', '030608', '03', '04', '', '');
INSERT INTO establecimiento VALUES ('1613', '0', '316', '000002595', 'C.S. SAN CAMILO DE LELIS (CHUQUIBAMBILLA)', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030701', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1614', '0', '316', '000002596', 'P.S. COTAHUARCAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030701', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1615', '0', '316', '000007422', 'P.S. HUICHIHUA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030701', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1616', '0', '316', '000007423', 'P.S. CHAPIMARCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030701', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1617', '0', '316', '000007424', 'P.S. PATA PATA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030701', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1618', '0', '316', '000008820', 'P.S. MARCCECCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030701', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1619', '0', '316', '000011938', 'P.S. CHISE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030701', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1620', '0', '317', '000002598', 'P.S. CURPAHUASI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030702', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1621', '0', '317', '000002653', 'P.S. TAMBORACCAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030702', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1622', '0', '317', '000007425', 'P.S. RATCAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030702', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1623', '0', '317', '000007426', 'P.S. HUAYO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030702', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1624', '0', '318', '000002654', 'C.S. PALPACACHI', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030703', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1625', '0', '318', '000002655', 'P.S. LLICCHIVILCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030703', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1626', '0', '318', '000002656', 'C.S. PACCAYPATA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030703', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1627', '0', '318', '000002657', 'P.S. PITUHUANCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030703', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1628', '0', '318', '000002658', 'P.S. PICHIBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030703', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1629', '0', '318', '000006651', 'P.S. CRUZ PATA (PALPACACHI)', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030703', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1630', '0', '318', '000008940', 'P.S. CCOLLAURO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030703', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1631', '0', '318', '000011520', 'P.S. TARIBAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030703', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1632', '0', '318', '000011523', 'P.S. UTAPARO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030703', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1633', '0', '318', '000011524', 'P.S. SAPSI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030703', '03', '01', '', '');
INSERT INTO establecimiento VALUES ('1634', '0', '319', '000002599', 'P.S. HUAYLLATI', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030704', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1635', '0', '319', '000002604', 'P.S. PAMPAHUITE', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030704', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1636', '0', '319', '000007427', 'P.S. CCORICHICHINA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030704', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1637', '0', '319', '000013211', 'P.S. KULLCO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030704', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1638', '0', '319', '000013212', 'P.S. TAMBO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030704', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1639', '0', '320', '000002600', 'P.S. MAMARA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030705', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1640', '0', '321', '000002601', 'P.S. AYRIHUANCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030706', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1641', '0', '322', '000002602', 'P.S. PATAYPAMPA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030707', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1642', '0', '322', '000007437', 'P.S. PIYAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030707', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1643', '0', '323', '000002603', 'P.S. CCONCCACCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030708', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1644', '0', '323', '000002605', 'C.S. PROGRESO', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030708', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1645', '0', '323', '000007349', 'P.S. PACCAYURA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030708', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1646', '0', '323', '000007428', 'P.S. PICOSAYHUAS', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030708', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1647', '0', '323', '000007429', 'P.S. CCONCHACCOTA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030708', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1648', '0', '324', '000002606', 'P.S. SAN ANTONIO (VILCABAMBA)', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030709', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1649', '0', '325', '000002607', 'P.S. SANTA ROSA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030710', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1650', '0', '325', '000007436', 'P.S. QUISCABAMBA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030710', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1651', '0', '326', '000002608', 'P.S. TURPAY', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030711', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1652', '0', '327', '000002609', 'C.S. VILCABAMBA', 'I-2', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030712', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1653', '0', '328', '000002610', 'P.S. VIRUNDO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030713', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1654', '0', '329', '000002597', 'P.S. CURASCO', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030714', '03', '02', '', '');
INSERT INTO establecimiento VALUES ('1655', '0', '329', '000007347', 'P.S. CCASANCCA', 'I-1', 'PUESTO DE SALUD', '0', '1', '1', '03', '0307', '030714', '03', '02', '', '');
-- 
--  Table structure for table `etapavida`
-- 

CREATE TABLE `etapavida` (
  `idetapaVida` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombreEtapa` varchar(100) DEFAULT NULL,
  `descripcion` text,
  PRIMARY KEY (`idetapaVida`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;


-- Dumping data for table `etapavida`

INSERT INTO etapavida VALUES ('1', 'NINO', 'Desde 0 a?os, 0meses, 1 dias  hasta 11 a?os, 11 meses 29 dias ');
INSERT INTO etapavida VALUES ('2', 'ADOLESCENTE', 'Desde 11 a?os, 11 meses, 30 dias  hasta 17 a?os, 11 meses 29 dias ');
INSERT INTO etapavida VALUES ('3', 'JOVEN', 'Desde 17 a?os, 11 meses, 30 dias  hasta 29 a?os, 11 meses 29 dias');
INSERT INTO etapavida VALUES ('4', 'ADULTO', 'Desde 29 a?os, 11 meses, 30 dias  hasta 59 a?os, 11 meses 29 dias ');
INSERT INTO etapavida VALUES ('5', 'ADULTO MAYOR', 'Desde 59 a?os, 11 meses, 30 dias  a m?s');
INSERT INTO etapavida VALUES ('6', 'GESTANTE', '');
-- 
--  Table structure for table `evaluaciondesarrollo`
-- 

CREATE TABLE `evaluaciondesarrollo` (
  `idevaluacionDesarrollo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `claveGeneral` varchar(100) NOT NULL,
  `idcatalogoPrestacion` int(10) unsigned DEFAULT NULL,
  `idepisodio` int(10) unsigned DEFAULT NULL,
  `idpersona` int(10) unsigned DEFAULT NULL,
  `idcatalogoUPS` int(10) unsigned DEFAULT NULL,
  `nombreCatalogo` text,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `resultado` varchar(100) DEFAULT NULL,
  `observaciones` text,
  PRIMARY KEY (`idevaluacionDesarrollo`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `evaluaciondesarrollo`

-- 
--  Table structure for table `familia`
-- 

CREATE TABLE `familia` (
  `claveGeneral` varchar(100) NOT NULL,
  `idfamilia` int(10) unsigned NOT NULL,
  `idsector` int(10) unsigned DEFAULT NULL,
  `idtrabajador` int(10) unsigned DEFAULT NULL,
  `numeroVivienda` char(5) DEFAULT NULL,
  `codigoFamilia` char(1) DEFAULT NULL,
  `codigoFicha` varchar(20) DEFAULT NULL,
  `fechaApertura` date DEFAULT NULL,
  `nombreFamilia` varchar(100) DEFAULT NULL,
  `idioma1` varchar(50) DEFAULT NULL,
  `idioma2` varchar(50) DEFAULT NULL,
  `idioma3` varchar(50) DEFAULT NULL,
  `tiempoDemora` varchar(100) DEFAULT NULL,
  `lote` varchar(100) DEFAULT NULL,
  `tiempoDomicilio` varchar(100) DEFAULT NULL,
  `viviendaAnterior` varchar(100) DEFAULT NULL,
  `medioTransporte` varchar(100) DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `diaVisita` varchar(20) DEFAULT NULL,
  `horaVisita` char(5) DEFAULT NULL,
  `tipoFamilia` text,
  `activo` char(2) DEFAULT 'AC',
  `motivo` varchar(20) DEFAULT NULL,
  `registrador` varchar(100) DEFAULT NULL,
  `opcion` char(2) DEFAULT 'SI',
  `telefono` varchar(30) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `referencia` varchar(100) DEFAULT NULL,
  `tipoEntorno` varchar(100) DEFAULT NULL,
  `nombreSector` varchar(100) DEFAULT NULL,
  `idcomunidad` int(11) DEFAULT NULL,
  `nombreComunidad` varchar(100) DEFAULT NULL,
  `idestablecimiento` int(11) DEFAULT NULL,
  `nombreEstablecimiento` varchar(100) DEFAULT NULL,
  `iddistrito` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `idprovincia` int(11) DEFAULT NULL,
  `nompro` varchar(100) DEFAULT NULL,
  `idregion` int(11) DEFAULT NULL,
  `nombreRegion` varchar(100) DEFAULT NULL,
  `idnucleo` int(11) DEFAULT NULL,
  `nombreNucleo` varchar(100) DEFAULT NULL,
  `idmicrored` int(11) DEFAULT NULL,
  `nombreMicrored` varchar(100) DEFAULT NULL,
  `idred` int(11) DEFAULT NULL,
  `nombreRed` varchar(100) DEFAULT NULL,
  `iddiresa` int(11) DEFAULT NULL,
  `nombreDiresa` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`claveGeneral`,`idfamilia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `familia`

-- 
--  Table structure for table `familiah`
-- 

CREATE TABLE `familiah` (
  `claveGeneral` varchar(100) NOT NULL,
  `idfamiliaH` int(10) unsigned NOT NULL,
  `fechaHistorial` datetime DEFAULT NULL,
  `idsector` int(10) unsigned DEFAULT NULL,
  `nombreSector` varchar(100) DEFAULT NULL,
  `codigoFicha` varchar(20) DEFAULT NULL,
  `fechaApertura` datetime DEFAULT NULL,
  `nombreFamilia` varchar(100) DEFAULT NULL,
  `lote` varchar(100) DEFAULT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `referencia` varchar(100) DEFAULT NULL,
  `tipoEntorno` varchar(100) DEFAULT NULL,
  `idioma1` varchar(50) DEFAULT NULL,
  `idioma2` varchar(50) DEFAULT NULL,
  `idioma3` varchar(50) DEFAULT NULL,
  `tiempoDemora` varchar(100) DEFAULT NULL,
  `tiempoDomicilio` varchar(100) DEFAULT NULL,
  `viviendaAnterior` varchar(100) DEFAULT NULL,
  `medioTransporte` varchar(100) DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `diaVisita` varchar(20) DEFAULT NULL,
  `horaVisita` varchar(5) DEFAULT NULL,
  `tipoFamilia` text,
  `activo` char(2) DEFAULT NULL,
  `motivo` varchar(20) DEFAULT NULL,
  `registrador` varchar(100) DEFAULT NULL,
  `trabajador` varchar(100) DEFAULT NULL,
  `idcomunidad` int(11) DEFAULT NULL,
  `nombreComunidad` varchar(100) DEFAULT NULL,
  `idestablecimiento` int(11) DEFAULT NULL,
  `nombreEstablecimiento` varchar(100) DEFAULT NULL,
  `iddistrito` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `idprovincia` int(11) DEFAULT NULL,
  `nompro` varchar(100) DEFAULT NULL,
  `idregion` int(11) DEFAULT NULL,
  `nombreRegion` varchar(100) DEFAULT NULL,
  `idnucleo` int(11) DEFAULT NULL,
  `nombreNucleo` varchar(100) DEFAULT NULL,
  `idmicrored` int(11) DEFAULT NULL,
  `nombreMicrored` varchar(100) DEFAULT NULL,
  `idred` int(11) DEFAULT NULL,
  `nombreRed` varchar(100) DEFAULT NULL,
  `iddiresa` int(11) DEFAULT NULL,
  `nombreDiresa` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`claveGeneral`,`idfamiliaH`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- Dumping data for table `familiah`

-- 
--  Table structure for table `grupocie10`
-- 

CREATE TABLE `grupocie10` (
  `idgrupoCIE10` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idcapituloCIE10` int(10) unsigned NOT NULL,
  `codigoGrupo` varchar(10) DEFAULT NULL,
  `codigoCapituloCIE10` varchar(10) NOT NULL,
  `nombre` text,
  PRIMARY KEY (`idgrupoCIE10`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `grupocie10`

-- 
--  Table structure for table `his`
-- 

CREATE TABLE `his` (
  `idHIS` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idepisodio` int(10) unsigned NOT NULL,
  `tipoCatalogo` varchar(100) DEFAULT NULL,
  `idcatalogo` int(10) unsigned DEFAULT NULL,
  `nombreCatalogo` text,
  `variableLAB` varchar(100) DEFAULT NULL,
  `tipoDiagnostico` varchar(100) DEFAULT NULL,
  `opPacienteEst` varchar(100) DEFAULT NULL,
  `opPacienteServ` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idHIS`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `his`

-- 
--  Table structure for table `insumos`
-- 

CREATE TABLE `insumos` (
  `idinsumos` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idepisodio` int(10) unsigned DEFAULT NULL,
  `idcatalogoInsumo` int(10) unsigned DEFAULT NULL,
  `nombreCatalogo` text,
  `cantidad` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idinsumos`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `insumos`

-- 
--  Table structure for table `interconsulta`
-- 

CREATE TABLE `interconsulta` (
  `idinterconsulta` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idepisodio` int(10) unsigned DEFAULT NULL,
  `idcatalogoUPS` int(10) unsigned DEFAULT NULL,
  `nombreCatalogo` text,
  `motivoInterconsulta` text,
  PRIMARY KEY (`idinterconsulta`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `interconsulta`

-- 
--  Table structure for table `microred`
-- 

CREATE TABLE `microred` (
  `idmicrored` int(10) unsigned NOT NULL,
  `idred` int(10) unsigned DEFAULT NULL,
  `nombreMicrored` varchar(100) DEFAULT NULL,
  `codigoMicrored` char(3) NOT NULL,
  `codigoDiresa` char(3) NOT NULL,
  `codigoRed` char(3) NOT NULL,
  PRIMARY KEY (`idmicrored`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- Dumping data for table `microred`

INSERT INTO microred VALUES ('1', '1', 'ASCENSION', '01', '13', '01');
INSERT INTO microred VALUES ('2', '1', 'YAULI', '02', '13', '01');
INSERT INTO microred VALUES ('3', '1', 'AYACCOCHA', '03', '13', '01');
INSERT INTO microred VALUES ('4', '1', 'HUANDO', '04', '13', '01');
INSERT INTO microred VALUES ('5', '1', 'IZCUCHACA', '05', '13', '01');
INSERT INTO microred VALUES ('6', '1', 'MOYA', '06', '13', '01');
INSERT INTO microred VALUES ('7', '1', 'ACORIA', '07', '13', '01');
INSERT INTO microred VALUES ('8', '1', 'SANTA ANA', '11', '13', '01');
INSERT INTO microred VALUES ('9', '2', 'ACOBAMBA', '01', '13', '02');
INSERT INTO microred VALUES ('10', '2', 'PAUCARA', '02', '13', '02');
INSERT INTO microred VALUES ('11', '3', 'PAZOS', '02', '13', '03');
INSERT INTO microred VALUES ('12', '3', 'COLCABAMBA', '03', '13', '03');
INSERT INTO microred VALUES ('13', '3', 'SAN ISIDRO DE ACOBAMBA', '04', '13', '03');
INSERT INTO microred VALUES ('14', '3', 'SURCUBAMBA', '05', '13', '03');
INSERT INTO microred VALUES ('15', '3', 'ACOSTAMBO', '06', '13', '03');
INSERT INTO microred VALUES ('16', '3', 'ACRAQUIA', '07', '13', '03');
INSERT INTO microred VALUES ('17', '3', 'DANIEL HERNANDEZ', '08', '13', '03');
INSERT INTO microred VALUES ('18', '4', 'LIRCAY', '01', '13', '04');
INSERT INTO microred VALUES ('19', '4', 'CCOCHACCASA', '02', '13', '04');
INSERT INTO microred VALUES ('20', '4', 'SECCLLA', '03', '13', '04');
INSERT INTO microred VALUES ('21', '5', 'CASTROVIRREYNA', '01', '13', '05');
INSERT INTO microred VALUES ('22', '5', 'HUACHOS', '02', '13', '05');
INSERT INTO microred VALUES ('23', '5', 'TANTARA', '03', '13', '05');
INSERT INTO microred VALUES ('24', '6', 'CHURCAMPA', '01', '13', '06');
INSERT INTO microred VALUES ('25', '6', 'PAUCARBAMBA', '02', '13', '06');
INSERT INTO microred VALUES ('26', '7', 'HUAYTARA', '01', '13', '07');
INSERT INTO microred VALUES ('27', '7', 'SANTIAGO DE CHOCORVOS', '02', '13', '07');
INSERT INTO microred VALUES ('28', '7', 'CORDOVA', '03', '13', '07');
INSERT INTO microred VALUES ('29', '7', 'PILPICHACA', '04', '13', '07');
INSERT INTO microred VALUES ('30', '0', 'PAMPAS', '0', '13', '0');
INSERT INTO microred VALUES ('31', '8', 'MR CHACHAPOYAS', '01', '01', '01');
INSERT INTO microred VALUES ('32', '8', 'MR PEDRO  RUIZ', '02', '01', '01');
INSERT INTO microred VALUES ('33', '8', 'MR POMACOCHAS', '03', '01', '01');
INSERT INTO microred VALUES ('34', '8', 'MR JUMBILLA', '04', '01', '01');
INSERT INTO microred VALUES ('35', '8', 'MR OCALLI', '05', '01', '01');
INSERT INTO microred VALUES ('36', '8', 'MR COLLONCE', '06', '01', '01');
INSERT INTO microred VALUES ('37', '8', 'MR LAMUD', '07', '01', '01');
INSERT INTO microred VALUES ('38', '8', 'MR TINGO', '08', '01', '01');
INSERT INTO microred VALUES ('39', '8', 'MR YERBABUENA', '09', '01', '01');
INSERT INTO microred VALUES ('40', '8', 'MR LEYMEBAMBA', '10', '01', '01');
INSERT INTO microred VALUES ('41', '8', 'MR PIPUS', '11', '01', '01');
INSERT INTO microred VALUES ('42', '8', 'MR RODRIGUEZ  DE MENDOZA', '12', '01', '01');
INSERT INTO microred VALUES ('43', '8', 'MR LUYA', '13', '01', '01');
INSERT INTO microred VALUES ('44', '8', 'MR TOTORA', '14', '01', '01');
INSERT INTO microred VALUES ('45', '8', 'MR SANTO TOMAS', '15', '01', '01');
INSERT INTO microred VALUES ('46', '8', 'MR MOLINOPAMPA', '16', '01', '01');
INSERT INTO microred VALUES ('47', '8', 'MR NUEVO CHIRIMOTO', '17', '01', '01');
INSERT INTO microred VALUES ('48', '8', 'MR OMIA', '18', '01', '01');
INSERT INTO microred VALUES ('49', '8', 'MR HUAMBO', '19', '01', '01');
INSERT INTO microred VALUES ('50', '8', 'MR LONGAR', '20', '01', '01');
INSERT INTO microred VALUES ('51', '8', 'MR ZARUMILLA', '21', '01', '01');
INSERT INTO microred VALUES ('52', '9', 'MR LA PECA', '01', '01', '02');
INSERT INTO microred VALUES ('53', '9', 'MR ARAMANGO', '02', '01', '02');
INSERT INTO microred VALUES ('54', '9', 'MR COPALLIN', '03', '01', '02');
INSERT INTO microred VALUES ('55', '9', 'MR IMAZA', '04', '01', '02');
INSERT INTO microred VALUES ('56', '9', 'MR CHIRIACO', '05', '01', '02');
INSERT INTO microred VALUES ('57', '9', 'MR BAGUA', '06', '01', '02');
INSERT INTO microred VALUES ('58', '9', 'MR WAYAMPIAK', '07', '01', '02');
INSERT INTO microred VALUES ('59', '9', 'MR TUPAC AMARU', '08', '01', '02');
INSERT INTO microred VALUES ('60', '10', 'MR BAGUA GRANDE', '01', '01', '03');
INSERT INTO microred VALUES ('61', '10', 'MR CAJARURO', '02', '01', '03');
INSERT INTO microred VALUES ('62', '10', 'MR ALTO AMAZONAS', '03', '01', '03');
INSERT INTO microred VALUES ('63', '10', 'MR NARANJITOS', '04', '01', '03');
INSERT INTO microred VALUES ('64', '10', 'MR JAMALCA', '05', '01', '03');
INSERT INTO microred VALUES ('65', '10', 'MR EL MILAGRO', '06', '01', '03');
INSERT INTO microred VALUES ('66', '10', 'MR CUMBA', '07', '01', '03');
INSERT INTO microred VALUES ('67', '10', 'MR LONYA GRANDE', '08', '01', '03');
INSERT INTO microred VALUES ('68', '10', 'MR NUNYA JALCA', '09', '01', '03');
INSERT INTO microred VALUES ('69', '10', 'MR COLLICATE', '10', '01', '03');
INSERT INTO microred VALUES ('70', '10', 'MR MIRAFLORES', '11', '01', '03');
INSERT INTO microred VALUES ('71', '11', 'MR NIEVA', '01', '01', '04');
INSERT INTO microred VALUES ('72', '11', 'MR GALILEA', '02', '01', '04');
INSERT INTO microred VALUES ('73', '11', 'MR KINGKIS', '03', '01', '04');
INSERT INTO microred VALUES ('74', '11', 'MR HUAMPAMI', '04', '01', '04');
INSERT INTO microred VALUES ('75', '12', 'MR RECUAY', '', '', '');
INSERT INTO microred VALUES ('76', '12', 'MR CATAC', '', '', '');
INSERT INTO microred VALUES ('77', '12', 'MR AIJA', '', '', '');
INSERT INTO microred VALUES ('78', '12', 'MR HUALLANCA', '', '', '');
INSERT INTO microred VALUES ('79', '12', 'MR CHIQUIAN', '', '', '');
INSERT INTO microred VALUES ('80', '12', 'MR CORPANQUI', '', '', '');
INSERT INTO microred VALUES ('81', '12', 'MR CAJACAY', '', '', '');
INSERT INTO microred VALUES ('82', '12', 'MR CHASQUITAMBO', '', '', '');
INSERT INTO microred VALUES ('83', '12', 'MR SAN NICOLAS', '', '', '');
INSERT INTO microred VALUES ('84', '12', 'MR HUARUPAMPA', '', '', '');
INSERT INTO microred VALUES ('85', '12', 'MR NICRUPAMPA', '', '', '');
INSERT INTO microred VALUES ('86', '12', 'MR PALMIRA', '', '', '');
INSERT INTO microred VALUES ('87', '12', 'MR MONTERREY', '', '', '');
INSERT INTO microred VALUES ('88', '12', 'MR PIRA', '', '', '');
INSERT INTO microred VALUES ('89', '12', 'MR OCROS', '', '', '');
INSERT INTO microred VALUES ('90', '12', 'MR CARHUAZ', '', '', '');
INSERT INTO microred VALUES ('91', '12', 'MR MARCARA', '', '', '');
INSERT INTO microred VALUES ('92', '12', 'MR ANTA', '', '', '');
INSERT INTO microred VALUES ('93', '12', 'MR CHACAS', '', '', '');
INSERT INTO microred VALUES ('94', '12', 'MR SHILLA', '', '', '');
INSERT INTO microred VALUES ('95', '13', 'MR CARAZ', '', '', '');
INSERT INTO microred VALUES ('96', '13', 'MR HUARIPAMPA', '', '', '');
INSERT INTO microred VALUES ('97', '13', 'MR MATO', '', '', '');
INSERT INTO microred VALUES ('98', '13', 'MR HUAYLAS', '', '', '');
INSERT INTO microred VALUES ('99', '13', 'MR PUEBLO LIBRE', '', '', '');
INSERT INTO microred VALUES ('100', '13', 'MR YURAMARCA', '', '', '');
INSERT INTO microred VALUES ('101', '13', 'MR PAMPAROMAS', '', '', '');
INSERT INTO microred VALUES ('102', '13', 'MR PICHIU', '', '', '');
INSERT INTO microred VALUES ('103', '13', 'MR CORONGO', '', '', '');
INSERT INTO microred VALUES ('104', '13', 'MR YUNGAY', '', '', '');
INSERT INTO microred VALUES ('105', '13', 'MR MANCOS', '', '', '');
INSERT INTO microred VALUES ('106', '13', 'MR YANAMA', '', '', '');
INSERT INTO microred VALUES ('107', '14', 'MR YUGOSLAVIA', '', '', '');
INSERT INTO microred VALUES ('108', '14', 'MR SAN JACINTO', '', '', '');
INSERT INTO microred VALUES ('109', '14', 'MR CASMA', '', '', '');
INSERT INTO microred VALUES ('110', '14', 'MR YAUTAN', '', '', '');
INSERT INTO microred VALUES ('111', '14', 'MR QUILLO', '', '', '');
INSERT INTO microred VALUES ('112', '14', 'MR HUARMEY', '', '', '');
INSERT INTO microred VALUES ('113', '15', 'MR PROGRESO', '', '', '');
INSERT INTO microred VALUES ('114', '15', 'MR MIRAFLORES ALTO', '', '', '');
INSERT INTO microred VALUES ('115', '15', 'MR MAGDALENA NUEVA', '', '', '');
INSERT INTO microred VALUES ('116', '15', 'MR SANTA', '', '', '');
INSERT INTO microred VALUES ('117', '15', 'MR CABANA', '', '', '');
INSERT INTO microred VALUES ('118', '15', 'MR PALLASCA', '', '', '');
INSERT INTO microred VALUES ('119', '16', 'MR HUARI', '', '', '');
INSERT INTO microred VALUES ('120', '16', 'MR C.R. PUCHKA', '', '', '');
INSERT INTO microred VALUES ('121', '16', 'MR C.R. LLAMELLIN', '', '', '');
INSERT INTO microred VALUES ('122', '16', 'MR C.R. UCO', '', '', '');
INSERT INTO microred VALUES ('123', '16', 'MR CHAVIN', '', '', '');
INSERT INTO microred VALUES ('124', '16', 'MR SAN MARCOS', '', '', '');
INSERT INTO microred VALUES ('125', '16', 'MR C.R. SAN LUIS', '', '', '');
INSERT INTO microred VALUES ('126', '17', 'MR POMABAMBA', '', '', '');
INSERT INTO microred VALUES ('127', '17', 'MR PISCO BAMBA', '', '', '');
INSERT INTO microred VALUES ('128', '17', 'MR PAROBAMBA', '', '', '');
INSERT INTO microred VALUES ('129', '17', 'MR SIHUAS', '', '', '');
INSERT INTO microred VALUES ('130', '17', 'MR QUICHES', '', '', '');
INSERT INTO microred VALUES ('131', '18', 'MR CENTENARIO', '', '', '');
INSERT INTO microred VALUES ('132', '18', 'MR CURAHUASI', '', '', '');
INSERT INTO microred VALUES ('133', '18', 'MR HUANCARAMA', '', '', '');
INSERT INTO microred VALUES ('134', '18', 'MICAELA BASTIDAS', '', '', '');
INSERT INTO microred VALUES ('135', '18', 'MR LAMBRAMA', '', '', '');
INSERT INTO microred VALUES ('136', '19', 'MR CHUQUIBAMBILLA', '', '', '');
INSERT INTO microred VALUES ('137', '19', 'MR VILCABAMBA', '', '', '');
INSERT INTO microred VALUES ('138', '20', 'MR SAN JERONIMO', '', '', '');
INSERT INTO microred VALUES ('139', '20', 'MR PACUCHA', '', '', '');
INSERT INTO microred VALUES ('140', '20', 'MR KISHUARA', '', '', '');
INSERT INTO microred VALUES ('141', '20', 'MR ANDARAPA', '', '', '');
INSERT INTO microred VALUES ('142', '21', 'MR URIPA', '', '', '');
INSERT INTO microred VALUES ('143', '21', 'MR OCOBAMBA', '', '', '');
INSERT INTO microred VALUES ('144', '21', 'MR HUACCANA', '', '', '');
INSERT INTO microred VALUES ('145', '22', 'MR HUANCARAY', '', '', '');
INSERT INTO microred VALUES ('146', '22', 'MR HUANCABAMBA', '', '', '');
INSERT INTO microred VALUES ('147', '22', 'MR TALAVERA', '', '', '');
INSERT INTO microred VALUES ('148', '22', 'MR PAMPACHIRI', '', '', '');
INSERT INTO microred VALUES ('149', '22', 'MR CHICMO', '', '', '');
INSERT INTO microred VALUES ('150', '23', 'MR ANTABAMBA', '', '', '');
INSERT INTO microred VALUES ('151', '24', 'MR CHALHUANCA', '', '', '');
INSERT INTO microred VALUES ('152', '24', 'MR SANTA ROSA', '', '', '');
INSERT INTO microred VALUES ('153', '25', 'MR HAQUIRA', '', '', '');
INSERT INTO microred VALUES ('154', '25', 'MR TAMBOBAMBA', '', '', '');
INSERT INTO microred VALUES ('155', '25', 'MR COTABAMBA', '', '', '');
INSERT INTO microred VALUES ('156', '26', 'MR SAN JOSE', '', '', '');
INSERT INTO microred VALUES ('157', '26', 'MR LA PAMPA', '', '', '');
INSERT INTO microred VALUES ('158', '26', 'MR SAN GREGORIO', '', '', '');
INSERT INTO microred VALUES ('159', '26', 'MR OCONA', '', '', '');
INSERT INTO microred VALUES ('160', '26', 'MR IQUIPI', '', '', '');
INSERT INTO microred VALUES ('161', '26', 'MR CARAVELI', '', '', '');
INSERT INTO microred VALUES ('162', '26', 'MR CHALA', '', '', '');
INSERT INTO microred VALUES ('163', '26', 'MR ACARI', '', '', '');
INSERT INTO microred VALUES ('164', '27', 'MR HUANCARQUI', '', '', '');
INSERT INTO microred VALUES ('165', '27', 'MR PAMAPACOLCA', '', '', '');
INSERT INTO microred VALUES ('166', '27', 'MR ANDAGUA', '', '', '');
INSERT INTO microred VALUES ('167', '27', 'MR VIRACO', '', '', '');
INSERT INTO microred VALUES ('168', '27', 'MR CORIRE', '', '', '');
INSERT INTO microred VALUES ('169', '27', 'MR CHUQUIBAMBA', '', '', '');
INSERT INTO microred VALUES ('170', '27', 'MR COTAHUASI', '', '', '');
INSERT INTO microred VALUES ('171', '27', 'MR ALCA', '', '', '');
INSERT INTO microred VALUES ('172', '28', 'MR CHIVAY', '', '', '');
INSERT INTO microred VALUES ('173', '28', 'MR CALLALLI', '', '', '');
INSERT INTO microred VALUES ('174', '28', 'MR CABANACONDE', '', '', '');
INSERT INTO microred VALUES ('175', '28', 'MR CAYLLOMA', '', '', '');
INSERT INTO microred VALUES ('176', '28', 'MR FRANCISCO BOLOGNESI', '', '', '');
INSERT INTO microred VALUES ('177', '28', 'MR BUENOS AIRES DE CAYMA', '', '', '');
INSERT INTO microred VALUES ('178', '28', 'MR CERRO COLORADO', '', '', '');
INSERT INTO microred VALUES ('179', '28', 'MR MARISCAL CASTILLA', '', '', '');
INSERT INTO microred VALUES ('180', '28', 'MR MARITZA CAMPOS DIAZ', '', '', '');
INSERT INTO microred VALUES ('181', '28', 'MR YANAHUARA', '', '', '');
INSERT INTO microred VALUES ('182', '28', 'MR CIUDAD DE DIOS', '', '', '');
INSERT INTO microred VALUES ('183', '28', 'MR EL PEDREGAL', '', '', '');
INSERT INTO microred VALUES ('184', '28', 'MR ALTO SELVA ALEGRE', '', '', '');
INSERT INTO microred VALUES ('185', '28', 'MR MARIANO MELGAR', '', '', '');
INSERT INTO microred VALUES ('186', '28', 'MR GRLMO. SAN MARTIN', '', '', '');
INSERT INTO microred VALUES ('187', '28', 'MR EDIFICADORES MISTI', '', '', '');
INSERT INTO microred VALUES ('188', '28', 'MR 15 DE AGOSTO', '', '', '');
INSERT INTO microred VALUES ('189', '28', 'MR AMPLIACION PAUCARPATA', '', '', '');
INSERT INTO microred VALUES ('190', '28', 'MR CIUDAD BLANCA', '', '', '');
INSERT INTO microred VALUES ('191', '28', 'MR CHIGUATA', '', '', '');
INSERT INTO microred VALUES ('192', '28', 'MR CHARACATO', '', '', '');
INSERT INTO microred VALUES ('193', '28', 'MR HUNTER', '', '', '');
INSERT INTO microred VALUES ('194', '28', 'MR VICTOR RAUL HINOJOZA', '', '', '');
INSERT INTO microred VALUES ('195', '28', 'MR TIABAYA', '', '', '');
INSERT INTO microred VALUES ('196', '28', 'MR SAN MARTIN DE SOCABAYA', '', '', '');
INSERT INTO microred VALUES ('197', '28', 'MR LA JOYA', '', '', '');
INSERT INTO microred VALUES ('198', '28', 'MR SAN ISIDRO', '', '', '');
INSERT INTO microred VALUES ('199', '28', 'MR VITOR', '', '', '');
INSERT INTO microred VALUES ('200', '29', 'MR ALTO INCLAN', '', '', '');
INSERT INTO microred VALUES ('201', '29', 'MR LA PUNTA', '', '', '');
INSERT INTO microred VALUES ('202', '29', 'MR COCACHACRA', '', '', '');
INSERT INTO microred VALUES ('203', '30', 'MR MUYURINA', '', '', '');
INSERT INTO microred VALUES ('204', '30', 'MR BELEN', '', '', '');
INSERT INTO microred VALUES ('205', '30', 'MR SAN JUAN BAUTISTA', '', '', '');
INSERT INTO microred VALUES ('206', '30', 'MR NAZARENAS', '', '', '');
INSERT INTO microred VALUES ('207', '30', 'MR CARMEN ALTO', '', '', '');
INSERT INTO microred VALUES ('208', '30', 'MR SANTA ELENA', '', '', '');
INSERT INTO microred VALUES ('209', '30', 'MR CHONTACA', '', '', '');
INSERT INTO microred VALUES ('210', '30', 'MR PUTACCA', '', '', '');
INSERT INTO microred VALUES ('211', '30', 'MR VINCHOS', '', '', '');
INSERT INTO microred VALUES ('212', '30', 'MR TOTOS', '', '', '');
INSERT INTO microred VALUES ('213', '30', 'MR LICENCIADOS', '', '', '');
INSERT INTO microred VALUES ('214', '30', 'MR QUINUA', '', '', '');
INSERT INTO microred VALUES ('215', '30', 'MR CHIARA', '', '', '');
INSERT INTO microred VALUES ('216', '30', 'MR PARAS', '', '', '');
INSERT INTO microred VALUES ('217', '30', 'MR SOCOS', '', '', '');
INSERT INTO microred VALUES ('218', '30', 'MR OCROS', '', '', '');
INSERT INTO microred VALUES ('219', '31', 'MR SAN JOSE DE SECCE', '', '', '');
INSERT INTO microred VALUES ('220', '31', 'MR HUALLHUA', '', '', '');
INSERT INTO microred VALUES ('221', '31', 'MR VIRACOCHAN', '', '', '');
INSERT INTO microred VALUES ('222', '31', 'MR LURICOCHA', '', '', '');
INSERT INTO microred VALUES ('223', '31', 'MR HUAMANGUILLA', '', '', '');
INSERT INTO microred VALUES ('224', '32', 'MR TAMBO', '', '', '');
INSERT INTO microred VALUES ('225', '32', 'MR SACHARACCAY', '', '', '');
INSERT INTO microred VALUES ('226', '32', 'MR CHUNGUI', '', '', '');
INSERT INTO microred VALUES ('227', '32', 'MR NINABAMBA', '', '', '');
INSERT INTO microred VALUES ('228', '33', 'MR LLOCHEGUA', '', '', '');
INSERT INTO microred VALUES ('229', '33', 'MR SAN MARTIN', '', '', '');
INSERT INTO microred VALUES ('230', '33', 'MR SANTA ROSA', '', '', '');
INSERT INTO microred VALUES ('231', '33', 'MR PALMAPAMPA', '', '', '');
INSERT INTO microred VALUES ('232', '33', 'MR TRIBOLINE', '', '', '');
INSERT INTO microred VALUES ('233', '33', 'MR MACHENTE', '', '', '');
INSERT INTO microred VALUES ('234', '34', 'MR POMABAMBA', '', '', '');
INSERT INTO microred VALUES ('235', '34', 'MR VILCASHUAMAN', '', '', '');
INSERT INTO microred VALUES ('236', '34', 'MR VICTOR FAJARDO', '', '', '');
INSERT INTO microred VALUES ('237', '34', 'MR HUANCASANCOS', '', '', '');
INSERT INTO microred VALUES ('238', '34', 'MR SUCRE', '', '', '');
INSERT INTO microred VALUES ('239', '34', 'MR PAMPA CANGALLO', '', '', '');
INSERT INTO microred VALUES ('240', '35', 'MR CHUMPI', '', '', '');
INSERT INTO microred VALUES ('241', '35', 'MR PAUSA', '', '', '');
INSERT INTO microred VALUES ('242', '35', 'MR INCUYO', '', '', '');
INSERT INTO microred VALUES ('243', '35', 'MR PACAPAUSA', '', '', '');
INSERT INTO microred VALUES ('244', '35', 'MR CHAVINA', '', '', '');
INSERT INTO microred VALUES ('245', '36', 'MR LARAMATE', '', '', '');
INSERT INTO microred VALUES ('246', '36', 'MR ANDAMARCA', '', '', '');
INSERT INTO microred VALUES ('247', '36', 'MR LUCANAS', '', '', '');
INSERT INTO microred VALUES ('248', '36', 'MR OTOCA', '', '', '');
INSERT INTO microred VALUES ('249', '36', 'MR OCANA', '', '', '');
INSERT INTO microred VALUES ('250', '36', 'MR SAN PEDRO', '', '', '');
INSERT INTO microred VALUES ('251', '37', 'MR BANOS DEL INCA', '', '', '');
INSERT INTO microred VALUES ('252', '37', 'MR ENCANADA', '', '', '');
INSERT INTO microred VALUES ('253', '37', 'MR MAGNA VALLEJO', '', '', '');
INSERT INTO microred VALUES ('254', '37', 'MR JESUS', '', '', '');
INSERT INTO microred VALUES ('255', '37', 'MR HUAMBOCANCHA BAJA', '', '', '');
INSERT INTO microred VALUES ('256', '37', 'MR PACHACUTEC', '', '', '');
INSERT INTO microred VALUES ('257', '37', 'MR MAGDALENA', '', '', '');
INSERT INTO microred VALUES ('258', '38', 'MR CELENDIN', '', '', '');
INSERT INTO microred VALUES ('259', '38', 'MR SUCRE', '', '', '');
INSERT INTO microred VALUES ('260', '38', 'MR MIGUEL IGLESIAS', '', '', '');
INSERT INTO microred VALUES ('261', '38', 'MR CORTEGANA', '', '', '');
INSERT INTO microred VALUES ('262', '39', 'MR CAJABAMBA', '', '', '');
INSERT INTO microred VALUES ('263', '39', 'MR LLUCHUBAMBA', '', '', '');
INSERT INTO microred VALUES ('264', '39', 'MR MALCAS', '', '', '');
INSERT INTO microred VALUES ('265', '40', 'MR CONTUMAZA', '', '', '');
INSERT INTO microred VALUES ('266', '40', 'MR CHILETE', '', '', '');
INSERT INTO microred VALUES ('267', '40', 'MR TEMBLADERA', '', '', '');
INSERT INTO microred VALUES ('268', '41', 'MR SAN MARCOS', '', '', '');
INSERT INTO microred VALUES ('269', '41', 'MR JOSE SABOGAL', '', '', '');
INSERT INTO microred VALUES ('270', '41', 'MR ICHOCAN', '', '', '');
INSERT INTO microred VALUES ('271', '42', 'MR SAN MIGUEL', '', '', '');
INSERT INTO microred VALUES ('272', '42', 'MR LLAPA', '', '', '');
INSERT INTO microred VALUES ('273', '42', 'MR NANCHOC', '', '', '');
INSERT INTO microred VALUES ('274', '42', 'MR LA FLORIDA', '', '', '');
INSERT INTO microred VALUES ('275', '43', 'MR SAN PABLO', '', '', '');
INSERT INTO microred VALUES ('276', '43', 'MR SAN BERNARDINO', '', '', '');
INSERT INTO microred VALUES ('277', '43', 'MR TUMBADEN', '', '', '');
INSERT INTO microred VALUES ('278', '44', 'MR CHALAMARCA', '', '', '');
INSERT INTO microred VALUES ('279', '44', 'MR CHOTA', '', '', '');
INSERT INTO microred VALUES ('280', '44', 'MR CONCHAN', '', '', '');
INSERT INTO microred VALUES ('281', '44', 'MR HUAMBOS', '', '', '');
INSERT INTO microred VALUES ('282', '44', 'MR LAJAS', '', '', '');
INSERT INTO microred VALUES ('283', '44', 'MR RAMADA LLAMA', '', '', '');
INSERT INTO microred VALUES ('284', '44', 'MR LLAMA', '', '', '');
INSERT INTO microred VALUES ('285', '44', 'MR PACCHA', '', '', '');
INSERT INTO microred VALUES ('286', '44', 'MR TACABAMBA', '', '', '');
INSERT INTO microred VALUES ('287', '44', 'MR TOCMOCHE', '', '', '');
INSERT INTO microred VALUES ('288', '45', 'MR EL TAMBO', '', '', '');
INSERT INTO microred VALUES ('289', '45', 'MR HUALGAYOC', '', '', '');
INSERT INTO microred VALUES ('290', '45', 'MR LLAUCAN', '', '', '');
INSERT INTO microred VALUES ('291', '45', 'MR SAN ANTONIO', '', '', '');
INSERT INTO microred VALUES ('292', '45', 'MR VIRGEN DEL CARMEN', '', '', '');
INSERT INTO microred VALUES ('293', '46', 'MR CATACHE', '', '', '');
INSERT INTO microred VALUES ('294', '46', 'MR CHANCAY BANOS', '', '', '');
INSERT INTO microred VALUES ('295', '46', 'MR SANTA CRUZ', '', '', '');
INSERT INTO microred VALUES ('296', '47', 'MR CUTERVO', '', '', '');
INSERT INTO microred VALUES ('297', '47', 'MR QUEROCOTILLO', '', '', '');
INSERT INTO microred VALUES ('298', '47', 'MR CHIPLE', '', '', '');
INSERT INTO microred VALUES ('299', '47', 'MR NARANJITO DE CAMSE', '', '', '');
INSERT INTO microred VALUES ('300', '47', 'MR SANTO DOMINGO DE LA CAPILLA', '', '', '');
INSERT INTO microred VALUES ('301', '48', 'MR SOCOTA', '', '', '');
INSERT INTO microred VALUES ('302', '48', 'MR SAN ANDRES', '', '', '');
INSERT INTO microred VALUES ('303', '48', 'MR LA RAMADA', '', '', '');
INSERT INTO microred VALUES ('304', '48', 'MR SANTO TOMAS', '', '', '');
INSERT INTO microred VALUES ('305', '48', 'MR CHOROS', '', '', '');
INSERT INTO microred VALUES ('306', '49', 'MR MORRO SOLAR', '', '', '');
INSERT INTO microred VALUES ('307', '49', 'MR MAGLLANAL', '', '', '');
INSERT INTO microred VALUES ('308', '49', 'MR PUCARA', '', '', '');
INSERT INTO microred VALUES ('309', '49', 'MR AMBATO TAMBORAPA', '', '', '');
INSERT INTO microred VALUES ('310', '49', 'MR SANTA ROSA', '', '', '');
INSERT INTO microred VALUES ('311', '49', 'MR COCHALAN', '', '', '');
INSERT INTO microred VALUES ('312', '49', 'MR TAMBORAPA PUEBLO', '', '', '');
INSERT INTO microred VALUES ('313', '49', 'MR CHONTALI', '', '', '');
INSERT INTO microred VALUES ('314', '49', 'MR LA COIPA', '', '', '');
INSERT INTO microred VALUES ('315', '49', 'MR CHIRINOS', '', '', '');
INSERT INTO microred VALUES ('316', '50', 'MR SAN IGNACIO', '', '', '');
INSERT INTO microred VALUES ('317', '50', 'MR NAMBALLE', '', '', '');
INSERT INTO microred VALUES ('318', '50', 'MR SAN JOSE DE LOURDES', '', '', '');
INSERT INTO microred VALUES ('319', '50', 'MR HUARANGO', '', '', '');
INSERT INTO microred VALUES ('320', '51', 'MR BONILLA', '', '', '');
INSERT INTO microred VALUES ('321', '51', 'MR SANTA FE', '', '', '');
INSERT INTO microred VALUES ('322', '51', 'MR JOSE OLAYA', '', '', '');
INSERT INTO microred VALUES ('323', '51', 'MR ACAPULCO', '', '', '');
INSERT INTO microred VALUES ('324', '51', 'MR NESTOR GAMBETTA', '', '', '');
INSERT INTO microred VALUES ('325', '52', 'MR FAUCETT', '', '', '');
INSERT INTO microred VALUES ('326', '52', 'MR SESQUICENTENARIO', '', '', '');
INSERT INTO microred VALUES ('327', '52', 'MR AEROPUERTO', '', '', '');
INSERT INTO microred VALUES ('328', '52', 'MR BELLAVISTA', '', '', '');
INSERT INTO microred VALUES ('329', '53', 'MR ANGAMOS', '', '', '');
INSERT INTO microred VALUES ('330', '53', 'MR MARQUEZ', '', '', '');
INSERT INTO microred VALUES ('331', '53', 'MR PACHACUTEC', '', '', '');
INSERT INTO microred VALUES ('332', '53', 'MR VILLA DE LOS REYES', '', '', '');
INSERT INTO microred VALUES ('333', '54', 'MR SAN JERONIMO', '', '', '');
INSERT INTO microred VALUES ('334', '54', 'MR SAN SEBASTIAN', '', '', '');
INSERT INTO microred VALUES ('335', '54', 'MR PARURO', '', '', '');
INSERT INTO microred VALUES ('336', '54', 'MR ACCHA', '', '', '');
INSERT INTO microred VALUES ('337', '54', 'MR YAURISQUE', '', '', '');
INSERT INTO microred VALUES ('338', '54', 'MR PAUCARTAMBO', '', '', '');
INSERT INTO microred VALUES ('339', '54', 'MR KOSNIPATA', '', '', '');
INSERT INTO microred VALUES ('340', '54', 'MR HUANCARANI', '', '', '');
INSERT INTO microred VALUES ('341', '54', 'MR SANTO TOMAS', '', '', '');
INSERT INTO microred VALUES ('342', '54', 'MR VELILLE', '', '', '');
INSERT INTO microred VALUES ('343', '54', 'MR COLQUEMARCA', '', '', '');
INSERT INTO microred VALUES ('344', '54', 'MR URCOS', '', '', '');
INSERT INTO microred VALUES ('345', '54', 'MR ACOMAYO', '', '', '');
INSERT INTO microred VALUES ('346', '54', 'MR POMACANCHI', '', '', '');
INSERT INTO microred VALUES ('347', '54', 'MR OCONGATE', '', '', '');
INSERT INTO microred VALUES ('348', '55', 'MR BELEMPAMPA', '', '', '');
INSERT INTO microred VALUES ('349', '55', 'MR WANCHAQ', '', '', '');
INSERT INTO microred VALUES ('350', '55', 'MR ANTA', '', '', '');
INSERT INTO microred VALUES ('351', '55', 'MR LIMATAMBO', '', '', '');
INSERT INTO microred VALUES ('352', '55', 'MR PISAC', '', '', '');
INSERT INTO microred VALUES ('353', '55', 'MR CALCA', '', '', '');
INSERT INTO microred VALUES ('354', '55', 'MR URUBAMBA', '', '', '');
INSERT INTO microred VALUES ('355', '55', 'MR YANATILE', '', '', '');
INSERT INTO microred VALUES ('356', '55', 'MR SIETE CUARTONES', '', '', '');
INSERT INTO microred VALUES ('357', '56', 'MR SANTA ANA', '', '', '');
INSERT INTO microred VALUES ('358', '56', 'MR MARANURA', '', '', '');
INSERT INTO microred VALUES ('359', '56', 'MR QUELLOUNO', '', '', '');
INSERT INTO microred VALUES ('360', '56', 'MR KITENI', '', '', '');
INSERT INTO microred VALUES ('361', '56', 'MR KAMISEA', '', '', '');
INSERT INTO microred VALUES ('362', '56', 'MR PUCYURA', '', '', '');
INSERT INTO microred VALUES ('363', '57', 'MR YANAOCA', '', '', '');
INSERT INTO microred VALUES ('364', '57', 'MR EL DESCANSO', '', '', '');
INSERT INTO microred VALUES ('365', '57', 'MR COMBAPATA', '', '', '');
INSERT INTO microred VALUES ('366', '57', 'MR TECHO OBRERO', '', '', '');
INSERT INTO microred VALUES ('367', '57', 'MR PAMPAPHALLA', '', '', '');
INSERT INTO microred VALUES ('368', '57', 'MR YAURI', '', '', '');
INSERT INTO microred VALUES ('369', '58', 'MR KIMBIRI', '', '', '');
INSERT INTO microred VALUES ('370', '58', 'MR PICHARI', '', '', '');
INSERT INTO microred VALUES ('371', '71', 'MR ICA', '', '', '');
INSERT INTO microred VALUES ('372', '71', 'MR SAN JOAQUIN', '', '', '');
INSERT INTO microred VALUES ('373', '71', 'MR LA TINGUINA/PARCONA', '', '', '');
INSERT INTO microred VALUES ('374', '71', 'MR LA PALMA', '', '', '');
INSERT INTO microred VALUES ('375', '71', 'MR PUEBLO NUEVO', '', '', '');
INSERT INTO microred VALUES ('376', '71', 'MR SANTIAGO', '', '', '');
INSERT INTO microred VALUES ('377', '71', 'MR PALPA', '', '', '');
INSERT INTO microred VALUES ('378', '71', 'MR NASCA', '', '', '');
INSERT INTO microred VALUES ('379', '72', 'MR CHINCHA', '', '', '');
INSERT INTO microred VALUES ('380', '72', 'MR PUEBLO NUEVO', '', '', '');
INSERT INTO microred VALUES ('381', '72', 'MR CHINCHA BAJA', '', '', '');
INSERT INTO microred VALUES ('382', '72', 'MR SAN CLEMENTE', '', '', '');
INSERT INTO microred VALUES ('383', '72', 'MR TUPAC AMARU INCA', '', '', '');
INSERT INTO microred VALUES ('384', '72', 'MR PISCO', '', '', '');
INSERT INTO microred VALUES ('385', '73', 'MR CHUPACA', '', '', '');
INSERT INTO microred VALUES ('386', '73', 'MR CONCEPCION', '', '', '');
INSERT INTO microred VALUES ('387', '73', 'MR COMAS', '', '', '');
INSERT INTO microred VALUES ('388', '73', 'MR CANIPACO', '', '', '');
INSERT INTO microred VALUES ('389', '73', 'MR EL TAMBO', '', '', '');
INSERT INTO microred VALUES ('390', '73', 'MR CHILCA', '', '', '');
INSERT INTO microred VALUES ('391', '73', 'MR LA LIBERTAD', '', '', '');
INSERT INTO microred VALUES ('392', '74', 'MR HATUN XAUXA', '', '', '');
INSERT INTO microred VALUES ('393', '74', 'MR VALLE DE YANAMARCA', '', '', '');
INSERT INTO microred VALUES ('394', '74', 'MR QUEBRADA DEL MANTARO', '', '', '');
INSERT INTO microred VALUES ('395', '74', 'MR YAULI-OROYA', '', '', '');
INSERT INTO microred VALUES ('396', '74', 'MR MARGEN IZQUIERDA', '', '', '');
INSERT INTO microred VALUES ('397', '74', 'MR VALLE AZUL', '', '', '');
INSERT INTO microred VALUES ('398', '74', 'MR MARGEN DERECHA', '', '', '');
INSERT INTO microred VALUES ('399', '74', 'MR VALLE DE YACUS', '', '', '');
INSERT INTO microred VALUES ('400', '75', 'MR TARMA', '', '', '');
INSERT INTO microred VALUES ('401', '75', 'MR PALCA', '', '', '');
INSERT INTO microred VALUES ('402', '75', 'MR ACOBAMBA', '', '', '');
INSERT INTO microred VALUES ('403', '75', 'MR HUASAHUASI', '', '', '');
INSERT INTO microred VALUES ('404', '76', 'MR SAN LUIS DE SHUARO', '', '', '');
INSERT INTO microred VALUES ('405', '76', 'MR SAN RAMON', '', '', '');
INSERT INTO microred VALUES ('406', '76', 'MR PERENE', '', '', '');
INSERT INTO microred VALUES ('407', '76', 'MR PICHANAKI', '', '', '');
INSERT INTO microred VALUES ('408', '77', 'MR RIO NEGRO-SATIPO', '', '', '');
INSERT INTO microred VALUES ('409', '77', 'MR MAZAMARI', '', '', '');
INSERT INTO microred VALUES ('410', '77', 'MR PANGOA', '', '', '');
INSERT INTO microred VALUES ('411', '77', 'MR PUERTO OCOPA', '', '', '');
INSERT INTO microred VALUES ('412', '77', 'MR POYENI', '', '', '');
INSERT INTO microred VALUES ('413', '77', 'MR VALLE ESMERALDA', '', '', '');
INSERT INTO microred VALUES ('414', '78', 'MR JUNIN', '', '', '');
INSERT INTO microred VALUES ('415', '78', 'MR CARHUAMAYO', '', '', '');
INSERT INTO microred VALUES ('416', '78', 'MR ULCUMAYO', '', '', '');
INSERT INTO microred VALUES ('417', '79', 'MR SAN MARTIN DE PORRAS', '', '', '');
INSERT INTO microred VALUES ('418', '79', 'MR SANTA ROSA DE LIMA', '', '', '');
INSERT INTO microred VALUES ('419', '80', 'MR ASCOPE', '', '', '');
INSERT INTO microred VALUES ('420', '80', 'MR CHICAMA', '', '', '');
INSERT INTO microred VALUES ('421', '80', 'MR CHOCOPE', '', '', '');
INSERT INTO microred VALUES ('422', '80', 'MR PAIJAN', '', '', '');
INSERT INTO microred VALUES ('423', '81', 'MR CLAS RAMON CASTILLA', '', '', '');
INSERT INTO microred VALUES ('424', '81', 'MR CLAS AGALLPAMPA', '', '', '');
INSERT INTO microred VALUES ('425', '81', 'MR CLAS CALLANCAS', '', '', '');
INSERT INTO microred VALUES ('426', '81', 'MR CLAS USQUIL', '', '', '');
INSERT INTO microred VALUES ('427', '82', 'MR CIUDAD DE DIOS', '', '', '');
INSERT INTO microred VALUES ('428', '82', 'MR SANTA CATALINA', '', '', '');
INSERT INTO microred VALUES ('429', '82', 'MR PACASMAYO', '', '', '');
INSERT INTO microred VALUES ('430', '83', 'MR TRUJILLO - METROPOLITANO', '', '', '');
INSERT INTO microred VALUES ('431', '83', 'MR FLORENCIA DE MORA', '', '', '');
INSERT INTO microred VALUES ('432', '83', 'MR HUANCHACO', '', '', '');
INSERT INTO microred VALUES ('433', '83', 'MR LA ESPERANZA', '', '', '');
INSERT INTO microred VALUES ('434', '83', 'MR LAREDO', '', '', '');
INSERT INTO microred VALUES ('435', '83', 'MR MOCHE', '', '', '');
INSERT INTO microred VALUES ('436', '83', 'MR PORVENIR', '', '', '');
INSERT INTO microred VALUES ('437', '83', 'MR SALAVERRY', '', '', '');
INSERT INTO microred VALUES ('438', '83', 'MR VICTOR LARCO', '', '', '');
INSERT INTO microred VALUES ('439', '84', 'MR VIRU', '', '', '');
INSERT INTO microred VALUES ('440', '84', 'MR CHAO', '', '', '');
INSERT INTO microred VALUES ('441', '85', 'MR CASCAS', '', '', '');
INSERT INTO microred VALUES ('442', '85', 'MR EL MOLINO', '', '', '');
INSERT INTO microred VALUES ('443', '85', 'MR SAYAPULLO', '', '', '');
INSERT INTO microred VALUES ('444', '85', 'MR COMPIN', '', '', '');
INSERT INTO microred VALUES ('445', '86', 'MR BOLIVAR NORTE', '', '', '');
INSERT INTO microred VALUES ('446', '86', 'MR BOLIVAR SUR', '', '', '');
INSERT INTO microred VALUES ('447', '87', 'MR PATAZ NORTE', '', '', '');
INSERT INTO microred VALUES ('448', '87', 'MR PATAZ SUR', '', '', '');
INSERT INTO microred VALUES ('449', '88', 'MR MARKAHUAMACHUCO', '', '', '');
INSERT INTO microred VALUES ('450', '88', 'MR EL PALLAR', '', '', '');
INSERT INTO microred VALUES ('451', '88', 'MR CURGOS', '', '', '');
INSERT INTO microred VALUES ('452', '88', 'MR CHUGAY', '', '', '');
INSERT INTO microred VALUES ('453', '88', 'MR SARIN', '', '', '');
INSERT INTO microred VALUES ('454', '88', 'MR SANAGORAN', '', '', '');
INSERT INTO microred VALUES ('455', '88', 'MR ARICAPAMPA-SARTIMBABA', '', '', '');
INSERT INTO microred VALUES ('456', '88', 'MR MARCABAL GRANDE', '', '', '');
INSERT INTO microred VALUES ('457', '88', 'MR MARCABALITO', '', '', '');
INSERT INTO microred VALUES ('458', '88', 'MR HUAMACHUCO', '', '', '');
INSERT INTO microred VALUES ('459', '89', 'MR CALIPUY', '', '', '');
INSERT INTO microred VALUES ('460', '89', 'MR MOLLEBAMBA', '', '', '');
INSERT INTO microred VALUES ('461', '89', 'MR CACHICADAN', '', '', '');
INSERT INTO microred VALUES ('462', '89', 'MR QUIRUVILCA', '', '', '');
INSERT INTO microred VALUES ('463', '89', 'MR PIJOBAMBA', '', '', '');
INSERT INTO microred VALUES ('464', '90', 'MR JULCAN', '', '', '');
INSERT INTO microred VALUES ('465', '90', 'MR HUASO', '', '', '');
INSERT INTO microred VALUES ('466', '90', 'MR CALAMARCA', '', '', '');
INSERT INTO microred VALUES ('467', '91', 'MR CHICLAYO', '', '', '');
INSERT INTO microred VALUES ('468', '91', 'MR JOSE LEONARDO ORTIZ', '', '', '');
INSERT INTO microred VALUES ('469', '91', 'MR CHONGOYAPE', '', '', '');
INSERT INTO microred VALUES ('470', '91', 'MR POSOPE ALTO', '', '', '');
INSERT INTO microred VALUES ('471', '91', 'MR LA VICTORIA', '', '', '');
INSERT INTO microred VALUES ('472', '91', 'MR PICSI', '', '', '');
INSERT INTO microred VALUES ('473', '91', 'MR POMALCA', '', '', '');
INSERT INTO microred VALUES ('474', '91', 'MR CAYALTI-ZANA', '', '', '');
INSERT INTO microred VALUES ('475', '91', 'MR REQUE-LAGUNAS', '', '', '');
INSERT INTO microred VALUES ('476', '91', 'MR CIRCUITO DE PLAYA', '', '', '');
INSERT INTO microred VALUES ('477', '91', 'MR PIMENTEL', '', '', '');
INSERT INTO microred VALUES ('478', '91', 'MR OYOTUN', '', '', '');
INSERT INTO microred VALUES ('479', '91', 'MR SAN JOSE', '', '', '');
INSERT INTO microred VALUES ('480', '92', 'MR FERRENAFE', '', '', '');
INSERT INTO microred VALUES ('481', '92', 'MR PITIPO', '', '', '');
INSERT INTO microred VALUES ('482', '92', 'MR INKAWASI', '', '', '');
INSERT INTO microred VALUES ('483', '93', 'MR LAMBAYEQUE', '', '', '');
INSERT INTO microred VALUES ('484', '93', 'MR MOCHUMI', '', '', '');
INSERT INTO microred VALUES ('485', '93', 'MR MORROPE', '', '', '');
INSERT INTO microred VALUES ('486', '93', 'MR CRUZ DEL MEDANO', '', '', '');
INSERT INTO microred VALUES ('487', '93', 'MR ILLIMO', '', '', '');
INSERT INTO microred VALUES ('488', '93', 'MR TUCUME', '', '', '');
INSERT INTO microred VALUES ('489', '93', 'MR JAYANCA', '', '', '');
INSERT INTO microred VALUES ('490', '93', 'MR SALAS', '', '', '');
INSERT INTO microred VALUES ('491', '93', 'MR MOTUPE', '', '', '');
INSERT INTO microred VALUES ('492', '93', 'MR OLMOS', '', '', '');
INSERT INTO microred VALUES ('493', '93', 'MR CANARIS', '', '', '');
INSERT INTO microred VALUES ('494', '95', 'MR C.S. SAN SEBASTIAN - 1', '', '', '');
INSERT INTO microred VALUES ('495', '95', 'MR C.S. MAGDALENA - 2', '', '', '');
INSERT INTO microred VALUES ('496', '95', 'MR C.S. MAX ARIAS SCHEREIBER - 3', '', '', '');
INSERT INTO microred VALUES ('497', '95', 'MR C.S. SURQUILLO - 4', '', '', '');
INSERT INTO microred VALUES ('498', '96', 'MR TAHUANTINSUYO BAJO', '', '', '');
INSERT INTO microred VALUES ('499', '96', 'MR SANTA LUZMILA I', '', '', '');
INSERT INTO microred VALUES ('500', '96', 'MR COLLIQUE 3ERA. ZONA', '', '', '');
INSERT INTO microred VALUES ('501', '96', 'MR CARABAYLLO', '', '', '');
INSERT INTO microred VALUES ('502', '97', 'MR RIMAC', '', '', '');
INSERT INTO microred VALUES ('503', '97', 'MR SMP', '', '', '');
INSERT INTO microred VALUES ('504', '97', 'MR LOS OLIVOS', '', '', '');
INSERT INTO microred VALUES ('505', '98', 'MR SURENOS', '', '', '');
INSERT INTO microred VALUES ('506', '98', 'MR ZAPALLAL', '', '', '');
INSERT INTO microred VALUES ('507', '99', 'MR EL AGUSTINO', '', '', '');
INSERT INTO microred VALUES ('508', '99', 'MR SANTA ANITA', '', '', '');
INSERT INTO microred VALUES ('509', '99', 'MR ATE I', '', '', '');
INSERT INTO microred VALUES ('510', '99', 'MR ATE II', '', '', '');
INSERT INTO microred VALUES ('511', '99', 'MR ATE III', '', '', '');
INSERT INTO microred VALUES ('512', '99', 'MR LA MOLINA CIENEGUILLA', '', '', '');
INSERT INTO microred VALUES ('513', '99', 'MR CHACLACAYO', '', '', '');
INSERT INTO microred VALUES ('514', '99', 'MR CHOSICA I', '', '', '');
INSERT INTO microred VALUES ('515', '99', 'MR CHOSICA II', '', '', '');
INSERT INTO microred VALUES ('516', '100', 'MR PIEDRA LIZA', '', '', '');
INSERT INTO microred VALUES ('517', '100', 'MR SAN FERNANDO', '', '', '');
INSERT INTO microred VALUES ('518', '100', 'MR GANIMEDES', '', '', '');
INSERT INTO microred VALUES ('519', '100', 'MR JAIME ZUBIETA', '', '', '');
INSERT INTO microred VALUES ('520', '100', 'MR JOSE CARLOS MARIATEGUI', '', '', '');
INSERT INTO microred VALUES ('521', '101', 'MR LAURIAMA', '', '', '');
INSERT INTO microred VALUES ('522', '101', 'MR PARAMONGA', '', '', '');
INSERT INTO microred VALUES ('523', '101', 'MR PATIVILCA', '', '', '');
INSERT INTO microred VALUES ('524', '101', 'MR PUERTO SUPE', '', '', '');
INSERT INTO microred VALUES ('525', '101', 'MR CAJATAMBO', '', '', '');
INSERT INTO microred VALUES ('526', '101', 'MR MANAS', '', '', '');
INSERT INTO microred VALUES ('527', '102', 'MR HUALMAY', '', '', '');
INSERT INTO microred VALUES ('528', '102', 'MR VEGUETA', '', '', '');
INSERT INTO microred VALUES ('529', '102', 'MR HUAURA', '', '', '');
INSERT INTO microred VALUES ('530', '102', 'MR SAYAN', '', '', '');
INSERT INTO microred VALUES ('531', '102', 'MR CHURIN-OYON', '', '', '');
INSERT INTO microred VALUES ('532', '103', 'MR HUARAL-YUNGUY', '', '', '');
INSERT INTO microred VALUES ('533', '103', 'MR ACOS-SANTA CRUZ DE ANDAMARCA', '', '', '');
INSERT INTO microred VALUES ('534', '103', 'MR PERALVILLO', '', '', '');
INSERT INTO microred VALUES ('535', '103', 'MR HUARAL', '', '', '');
INSERT INTO microred VALUES ('536', '103', 'MR YUNGUY', '', '', '');
INSERT INTO microred VALUES ('537', '103', 'MR ACOS', '', '', '');
INSERT INTO microred VALUES ('538', '103', 'MR SANTA CRUZ', '', '', '');
INSERT INTO microred VALUES ('539', '103', 'MR ANASMAYO', '', '', '');
INSERT INTO microred VALUES ('540', '104', 'MR SANTA LUZMILA', '', '', '');
INSERT INTO microred VALUES ('541', '105', 'MR SAN VICENTE', '', '', '');
INSERT INTO microred VALUES ('542', '105', 'MR IMPERIAL', '', '', '');
INSERT INTO microred VALUES ('543', '105', 'MR LUNAHUANA', '', '', '');
INSERT INTO microred VALUES ('544', '105', 'MR YAUYOS', '', '', '');
INSERT INTO microred VALUES ('545', '105', 'MR TOMAS', '', '', '');
INSERT INTO microred VALUES ('546', '105', 'MR HUANCAHUASI', '', '', '');
INSERT INTO microred VALUES ('547', '105', 'MR CATAHUASI', '', '', '');
INSERT INTO microred VALUES ('548', '106', 'MR ASIA-COAYLLO', '', '', '');
INSERT INTO microred VALUES ('549', '106', 'MR CHILCA', '', '', '');
INSERT INTO microred VALUES ('550', '106', 'MR MALA', '', '', '');
INSERT INTO microred VALUES ('551', '106', 'MR OMAS - AYAVIRI', '', '', '');
INSERT INTO microred VALUES ('552', '106', 'MR QUINCHES', '', '', '');
INSERT INTO microred VALUES ('553', '106', 'MR CUCULI', '', '', '');
INSERT INTO microred VALUES ('554', '107', 'MR HUAROCHIRI', '', '', '');
INSERT INTO microred VALUES ('555', '107', 'MR LANGA', '', '', '');
INSERT INTO microred VALUES ('556', '107', 'MR RICARDO PALMA', '', '', '');
INSERT INTO microred VALUES ('557', '107', 'MR MATUCANA', '', '', '');
INSERT INTO microred VALUES ('558', '107', 'MR HUINCO', '', '', '');
INSERT INTO microred VALUES ('559', '108', 'MR YANGAS', '', '', '');
INSERT INTO microred VALUES ('560', '108', 'MR CANTA', '', '', '');
INSERT INTO microred VALUES ('561', '109', 'MR URBANA', '', '', '');
INSERT INTO microred VALUES ('562', '109', 'MR VILLA', '', '', '');
INSERT INTO microred VALUES ('563', '109', 'MR SURCO', '', '', '');
INSERT INTO microred VALUES ('564', '110', 'MR TREBOL AZUL - SAN JUAN', '', '', '');
INSERT INTO microred VALUES ('565', '110', 'MR LEONOR SAAVEDRA - VILLA SAN LUIS', '', '', '');
INSERT INTO microred VALUES ('566', '110', 'MR MANUEL BARRETO', '', '', '');
INSERT INTO microred VALUES ('567', '110', 'MR OLLANTAY', '', '', '');
INSERT INTO microred VALUES ('568', '110', 'MR VILLA MARIA - JOSE CARLOS MARIATEGUI', '', '', '');
INSERT INTO microred VALUES ('569', '110', 'MR JOSE GALVEZ - NUEVA ESPERANZA', '', '', '');
INSERT INTO microred VALUES ('570', '110', 'MR DANIEL ALCIDES CARRION - TABLADA DE LURIN', '', '', '');
INSERT INTO microred VALUES ('571', '111', 'MR SAN JOSE', '', '', '');
INSERT INTO microred VALUES ('572', '111', 'MR JUAN PABLO II', '', '', '');
INSERT INTO microred VALUES ('573', '111', 'MR CESAR LOPEZ SILVA', '', '', '');
INSERT INTO microred VALUES ('574', '111', 'MR SAN MARTIN DE PORRES', '', '', '');
INSERT INTO microred VALUES ('575', '111', 'MR LURIN', '', '', '');
INSERT INTO microred VALUES ('576', '111', 'MR PACHACAMAC', '', '', '');
INSERT INTO microred VALUES ('577', '111', 'MR SAN BARTOLO', '', '', '');
INSERT INTO microred VALUES ('578', '111', 'MR PORTADA DE MANCHAY', '', '', '');
INSERT INTO microred VALUES ('579', '112', 'MR IQUITOS NORTE', '', '', '');
INSERT INTO microred VALUES ('580', '112', 'MR IQUITOS SUR', '', '', '');
INSERT INTO microred VALUES ('581', '112', 'MR BELEN', '', '', '');
INSERT INTO microred VALUES ('582', '112', 'MR PUNCHANA', '', '', '');
INSERT INTO microred VALUES ('583', '113', 'MR PUTUMAYO', '', '', '');
INSERT INTO microred VALUES ('584', '113', 'MR SANTA CLOTILDE', '', '', '');
INSERT INTO microred VALUES ('585', '113', 'MR MAZAN', '', '', '');
INSERT INTO microred VALUES ('586', '113', 'MR TAMSHIYACU', '', '', '');
INSERT INTO microred VALUES ('587', '113', 'MR ANGAMOS', '', '', '');
INSERT INTO microred VALUES ('588', '114', 'MR CABALLO COCHA', '', '', '');
INSERT INTO microred VALUES ('589', '114', 'MR SAN PABLO', '', '', '');
INSERT INTO microred VALUES ('590', '114', 'MR PEVAS', '', '', '');
INSERT INTO microred VALUES ('591', '114', 'MR ISLANDIA', '', '', '');
INSERT INTO microred VALUES ('592', '115', 'MR NAUTA', '', '', '');
INSERT INTO microred VALUES ('593', '115', 'MR VILLA TROMPETERO', '', '', '');
INSERT INTO microred VALUES ('594', '115', 'MR MAYPUCO', '', '', '');
INSERT INTO microred VALUES ('595', '115', 'MR INTUTO', '', '', '');
INSERT INTO microred VALUES ('596', '116', 'MR CONTAMANA', '', '', '');
INSERT INTO microred VALUES ('597', '116', 'MR SARAYACU', '', '', '');
INSERT INTO microred VALUES ('598', '116', 'MR PADRE MARQUEZ', '', '', '');
INSERT INTO microred VALUES ('599', '117', 'MR REQUENA', '', '', '');
INSERT INTO microred VALUES ('600', '117', 'MR BRETANA', '', '', '');
INSERT INTO microred VALUES ('601', '117', 'MR SAN MARTIN CAPELO', '', '', '');
INSERT INTO microred VALUES ('602', '118', 'MR YURIMAGUAS', '', '', '');
INSERT INTO microred VALUES ('603', '118', 'MR SHUCUSHYACU', '', '', '');
INSERT INTO microred VALUES ('604', '118', 'MR BALSAPUERTO', '', '', '');
INSERT INTO microred VALUES ('605', '118', 'MR SANTA CRUZ', '', '', '');
INSERT INTO microred VALUES ('606', '118', 'MR LAGUNAS', '', '', '');
INSERT INTO microred VALUES ('607', '118', 'MR JEBEROS', '', '', '');
INSERT INTO microred VALUES ('608', '119', 'MR MANSERICHE', '', '', '');
INSERT INTO microred VALUES ('609', '119', 'MR BARRANCA', '', '', '');
INSERT INTO microred VALUES ('610', '119', 'MR PASTAZA', '', '', '');
INSERT INTO microred VALUES ('611', '119', 'MR MORONA', '', '', '');
INSERT INTO microred VALUES ('612', '119', 'MR ANDOAS', '', '', '');
INSERT INTO microred VALUES ('613', '119', 'MR CAHUAPANAS', '', '', '');
INSERT INTO microred VALUES ('614', '120', 'MR JORGE CHAVEZ', '', '', '');
INSERT INTO microred VALUES ('615', '120', 'MR NUEVO MILENIO', '', '', '');
INSERT INTO microred VALUES ('616', '120', 'MR LABERINTO', '', '', '');
INSERT INTO microred VALUES ('617', '120', 'MR PLANCHON', '', '', '');
INSERT INTO microred VALUES ('618', '120', 'MR BOCA COLORADO', '', '', '');
INSERT INTO microred VALUES ('619', '120', 'MR MAZUKO', '', '', '');
INSERT INTO microred VALUES ('620', '120', 'MR HUEPETUHE', '', '', '');
INSERT INTO microred VALUES ('621', '120', 'MR IBERIA', '', '', '');
INSERT INTO microred VALUES ('622', '121', 'MR MOQUEGUA', '', '', '');
INSERT INTO microred VALUES ('623', '121', 'MR CARUMAS', '', '', '');
INSERT INTO microred VALUES ('624', '121', 'MR OMATE', '', '', '');
INSERT INTO microred VALUES ('625', '121', 'MR UBINAS', '', '', '');
INSERT INTO microred VALUES ('626', '121', 'MR ICHUNA', '', '', '');
INSERT INTO microred VALUES ('627', '122', 'MR ILO', '', '', '');
INSERT INTO microred VALUES ('628', '123', 'MR CENTRO', '', '', '');
INSERT INTO microred VALUES ('629', '123', 'MR HUARIACA', '', '', '');
INSERT INTO microred VALUES ('630', '123', 'MR MESETA', '', '', '');
INSERT INTO microred VALUES ('631', '123', 'MR PAUCARTAMBO', '', '', '');
INSERT INTO microred VALUES ('632', '123', 'MR SIMON BOLIVAR', '', '', '');
INSERT INTO microred VALUES ('633', '124', 'MR CHAUPIHUARANGA', '', '', '');
INSERT INTO microred VALUES ('634', '124', 'MR TUSI', '', '', '');
INSERT INTO microred VALUES ('635', '124', 'MR YANAHUANCA', '', '', '');
INSERT INTO microred VALUES ('636', '125', 'MR OXAPAMPA, HUANCABAMBA, CHONTABAMBA', '', '', '');
INSERT INTO microred VALUES ('637', '125', 'MR POZUZO', '', '', '');
INSERT INTO microred VALUES ('638', '125', 'MR VILLA RICA', '', '', '');
INSERT INTO microred VALUES ('639', '125', 'MR PALCAZU', '', '', '');
INSERT INTO microred VALUES ('640', '125', 'MR PUERTO BERMUDEZ', '', '', '');
INSERT INTO microred VALUES ('641', '125', 'MR CIUDAD CONSTITUCION', '', '', '');
INSERT INTO microred VALUES ('642', '126', 'MR PIURA', '', '', '');
INSERT INTO microred VALUES ('643', '126', 'MR CASTILLA', '', '', '');
INSERT INTO microred VALUES ('644', '127', 'MR CATACAOS', '', '', '');
INSERT INTO microred VALUES ('645', '127', 'MR SECHURA', '', '', '');
INSERT INTO microred VALUES ('646', '128', 'MR CHULUCANAS', '', '', '');
INSERT INTO microred VALUES ('647', '128', 'MR MORROPON', '', '', '');
INSERT INTO microred VALUES ('648', '128', 'MR SALITRAL', '', '', '');
INSERT INTO microred VALUES ('649', '128', 'MR CHALACO', '', '', '');
INSERT INTO microred VALUES ('650', '128', 'MR CANCHAQUE', '', '', '');
INSERT INTO microred VALUES ('651', '129', 'MR HUANCABAMBA', '', '', '');
INSERT INTO microred VALUES ('652', '130', 'MR HUARMACA', '', '', '');
INSERT INTO microred VALUES ('653', '131', 'MR BELLAVISTA', '', '', '');
INSERT INTO microred VALUES ('654', '131', 'MR QUERECOTILLO', '', '', '');
INSERT INTO microred VALUES ('655', '131', 'MR MARCAVELICA', '', '', '');
INSERT INTO microred VALUES ('656', '131', 'MR PAITA', '', '', '');
INSERT INTO microred VALUES ('657', '131', 'MR LANCONES', '', '', '');
INSERT INTO microred VALUES ('658', '131', 'MR TALARA', '', '', '');
INSERT INTO microred VALUES ('659', '131', 'MR LOS ORGANOS', '', '', '');
INSERT INTO microred VALUES ('660', '132', 'MR TAMBOGRANDE', '', '', '');
INSERT INTO microred VALUES ('661', '132', 'MR LAS LOMAS', '', '', '');
INSERT INTO microred VALUES ('662', '132', 'MR PAIMAS', '', '', '');
INSERT INTO microred VALUES ('663', '132', 'MR AYABACA', '', '', '');
INSERT INTO microred VALUES ('664', '133', 'MR PUNO', '', '', '');
INSERT INTO microred VALUES ('665', '133', 'MR LARAQUERIMR LARAQUERI', '', '', '');
INSERT INTO microred VALUES ('666', '133', 'MR MANAZO', '', '', '');
INSERT INTO microred VALUES ('667', '133', 'MR ACORA', '', '', '');
INSERT INTO microred VALUES ('668', '133', 'MR METROPOLITANO', '', '', '');
INSERT INTO microred VALUES ('669', '133', 'MR JOSE ANTONIO ENCINAS', '', '', '');
INSERT INTO microred VALUES ('670', '133', 'MR SIMON BOLIVAR', '', '', '');
INSERT INTO microred VALUES ('671', '133', 'MR CAPACHICA', '', '', '');
INSERT INTO microred VALUES ('672', '134', 'MR ALIANZA', '', '', '');
INSERT INTO microred VALUES ('673', '134', 'MR ARAPA', '', '', '');
INSERT INTO microred VALUES ('674', '134', 'MR ASILLO', '', '', '');
INSERT INTO microred VALUES ('675', '134', 'MR CHUPA', '', '', '');
INSERT INTO microred VALUES ('676', '134', 'MR JOSE DOMINGO CHOQUEHUANCA', '', '', '');
INSERT INTO microred VALUES ('677', '134', 'MR MUNANI', '', '', '');
INSERT INTO microred VALUES ('678', '134', 'MR SAN ANTON', '', '', '');
INSERT INTO microred VALUES ('679', '135', 'MR SANDIA', '', '', '');
INSERT INTO microred VALUES ('680', '135', 'MR CUYO CUYO', '', '', '');
INSERT INTO microred VALUES ('681', '135', 'MR MASIAPO', '', '', '');
INSERT INTO microred VALUES ('682', '135', 'MR SAN JUAN DEL ORO', '', '', '');
INSERT INTO microred VALUES ('683', '135', 'MR PUTINA PUNCO', '', '', '');
INSERT INTO microred VALUES ('684', '136', 'MR YUNGUYO', '', '', '');
INSERT INTO microred VALUES ('685', '136', 'MR COPANI', '', '', '');
INSERT INTO microred VALUES ('686', '136', 'MR OLLARAYA', '', '', '');
INSERT INTO microred VALUES ('687', '136', 'MR AYCHUYO', '', '', '');
INSERT INTO microred VALUES ('688', '137', 'MR MACUSANI', '', '', '');
INSERT INTO microred VALUES ('689', '137', 'MR AYAPATA', '', '', '');
INSERT INTO microred VALUES ('690', '137', 'MR SAN GABAN', '', '', '');
INSERT INTO microred VALUES ('691', '137', 'MR ISIVILLA', '', '', '');
INSERT INTO microred VALUES ('692', '138', 'MR MOLINO', '', '', '');
INSERT INTO microred VALUES ('693', '138', 'MR POMATA', '', '', '');
INSERT INTO microred VALUES ('694', '138', 'MR ZEPITA', '', '', '');
INSERT INTO microred VALUES ('695', '138', 'MR DESAGUADERO', '', '', '');
INSERT INTO microred VALUES ('696', '139', 'MR MULLACONTIHUECO', '', '', '');
INSERT INTO microred VALUES ('697', '139', 'MR CAMICACHI', '', '', '');
INSERT INTO microred VALUES ('698', '139', 'MR CHECCA', '', '', '');
INSERT INTO microred VALUES ('699', '139', 'MR PILCUYO', '', '', '');
INSERT INTO microred VALUES ('700', '139', 'MR MAZOCRUZ', '', '', '');
INSERT INTO microred VALUES ('701', '140', 'MR HUANCANE', '', '', '');
INSERT INTO microred VALUES ('702', '140', 'MR VILQUECHICO', '', '', '');
INSERT INTO microred VALUES ('703', '140', 'MR ROSASPATA', '', '', '');
INSERT INTO microred VALUES ('704', '140', 'MR MOHO', '', '', '');
INSERT INTO microred VALUES ('705', '140', 'MR CONIMA', '', '', '');
INSERT INTO microred VALUES ('706', '140', 'MR COJATA', '', '', '');
INSERT INTO microred VALUES ('707', '140', 'MR PUTINA', '', '', '');
INSERT INTO microred VALUES ('708', '140', 'MR ANANEA', '', '', '');
INSERT INTO microred VALUES ('709', '141', 'MR LAMPA', '', '', '');
INSERT INTO microred VALUES ('710', '141', 'MR CABANILLA', '', '', '');
INSERT INTO microred VALUES ('711', '141', 'MR PALCA', '', '', '');
INSERT INTO microred VALUES ('712', '141', 'MR SANTA LUCIA', '', '', '');
INSERT INTO microred VALUES ('713', '142', 'MR AYAVIRI', '', '', '');
INSERT INTO microred VALUES ('714', '142', 'MR NUNOA', '', '', '');
INSERT INTO microred VALUES ('715', '142', 'MR CRUCERO', '', '', '');
INSERT INTO microred VALUES ('716', '142', 'MR LLALLI', '', '', '');
INSERT INTO microred VALUES ('717', '142', 'MR ORURILLO', '', '', '');
INSERT INTO microred VALUES ('718', '142', 'MR PHARA', '', '', '');
INSERT INTO microred VALUES ('719', '142', 'MR SANTA ROSA', '', '', '');
INSERT INTO microred VALUES ('720', '142', 'MR COAZA', '', '', '');
INSERT INTO microred VALUES ('721', '143', 'MR JULIACA', '', '', '');
INSERT INTO microred VALUES ('722', '143', 'MR CONO SUR', '', '', '');
INSERT INTO microred VALUES ('723', '143', 'MR SANTA ADRIANA', '', '', '');
INSERT INTO microred VALUES ('724', '143', 'MR TARACO', '', '', '');
INSERT INTO microred VALUES ('725', '143', 'MR SAMAN', '', '', '');
INSERT INTO microred VALUES ('726', '143', 'MR CABANILLAS', '', '', '');
INSERT INTO microred VALUES ('727', '144', 'MR CHAZUTA', '', '', '');
INSERT INTO microred VALUES ('728', '144', 'MR HUIMBAYOC', '', '', '');
INSERT INTO microred VALUES ('729', '144', 'MR SAUCE', '', '', '');
INSERT INTO microred VALUES ('730', '144', 'MR PAPAPLAYA', '', '', '');
INSERT INTO microred VALUES ('731', '144', 'MR BANDA DE SHILCAYO', '', '', '');
INSERT INTO microred VALUES ('732', '144', 'MR TARAPOTO', '', '', '');
INSERT INTO microred VALUES ('733', '144', 'MR MORALES', '', '', '');
INSERT INTO microred VALUES ('734', '144', 'MR JUAN GUERRA', '', '', '');
INSERT INTO microred VALUES ('735', '145', 'MR HOSPITAL LAMAS', '', '', '');
INSERT INTO microred VALUES ('736', '145', 'MR BARRANQUITA', '', '', '');
INSERT INTO microred VALUES ('737', '145', 'MR CAYNARACHI', '', '', '');
INSERT INTO microred VALUES ('738', '145', 'MR TABALOSOS', '', '', '');
INSERT INTO microred VALUES ('739', '145', 'MR CUNUMBUQUI', '', '', '');
INSERT INTO microred VALUES ('740', '145', 'MR PACAYZAPA', '', '', '');
INSERT INTO microred VALUES ('741', '146', 'MR SAN JOSE DE SISA', '', '', '');
INSERT INTO microred VALUES ('742', '146', 'MR AGUA BLANCA', '', '', '');
INSERT INTO microred VALUES ('743', '146', 'MR SAN MARTIN ALAO', '', '', '');
INSERT INTO microred VALUES ('744', '147', 'MR PICOTA', '', '', '');
INSERT INTO microred VALUES ('745', '147', 'MR LEONCIO PRADO', '', '', '');
INSERT INTO microred VALUES ('746', '147', 'MR PUCACACA', '', '', '');
INSERT INTO microred VALUES ('747', '148', 'MR LLUILLUCUCHA', '', '', '');
INSERT INTO microred VALUES ('748', '148', 'MR JERILLO', '', '', '');
INSERT INTO microred VALUES ('749', '148', 'MR YANTALO', '', '', '');
INSERT INTO microred VALUES ('750', '148', 'MR SORITOR', '', '', '');
INSERT INTO microred VALUES ('751', '148', 'MR JEPELACIO', '', '', '');
INSERT INTO microred VALUES ('752', '148', 'MR ALONSO DE ALVARADO ROQUE', '', '', '');
INSERT INTO microred VALUES ('753', '148', 'MR CALZADA', '', '', '');
INSERT INTO microred VALUES ('754', '148', 'MR PUEBLO LIBRE', '', '', '');
INSERT INTO microred VALUES ('755', '149', 'MR NUEVO RIOJA', '', '', '');
INSERT INTO microred VALUES ('756', '149', 'MR NUEVA CAJAMARCA', '', '', '');
INSERT INTO microred VALUES ('757', '149', 'MR NARANJOS', '', '', '');
INSERT INTO microred VALUES ('758', '149', 'MR SAN FERNANDO', '', '', '');
INSERT INTO microred VALUES ('759', '149', 'MR SAN JUAN DE RIO SORITOR', '', '', '');
INSERT INTO microred VALUES ('760', '149', 'MR SEGUNDA JERUSALEN', '', '', '');
INSERT INTO microred VALUES ('761', '149', 'MR BAJO NARANJILLO', '', '', '');
INSERT INTO microred VALUES ('762', '149', 'MR YURAYACU', '', '', '');
INSERT INTO microred VALUES ('763', '150', 'MR JUANJUI', '', '', '');
INSERT INTO microred VALUES ('764', '150', 'MR COSTA RICA', '', '', '');
INSERT INTO microred VALUES ('765', '150', 'MR CAMPANILLA', '', '', '');
INSERT INTO microred VALUES ('766', '150', 'MR HUICUNGO', '', '', '');
INSERT INTO microred VALUES ('767', '151', 'MR SAPOSOA', '', '', '');
INSERT INTO microred VALUES ('768', '151', 'MR SACANCHE', '', '', '');
INSERT INTO microred VALUES ('769', '152', 'MR BELLAVISTA', '', '', '');
INSERT INTO microred VALUES ('770', '152', 'MR BAJO BIAVO', '', '', '');
INSERT INTO microred VALUES ('771', '152', 'MR SAN PABLO-CONSUELO', '', '', '');
INSERT INTO microred VALUES ('772', '152', 'MR ALTO BIAVO', '', '', '');
INSERT INTO microred VALUES ('773', '153', 'MR TOCACHE', '', '', '');
INSERT INTO microred VALUES ('774', '153', 'MR NUEVO PROGRESO', '', '', '');
INSERT INTO microred VALUES ('775', '153', 'MR POLVORA', '', '', '');
INSERT INTO microred VALUES ('776', '153', 'MR UCHIZA', '', '', '');
INSERT INTO microred VALUES ('777', '154', 'MR METROPOLITANA', '', '', '');
INSERT INTO microred VALUES ('778', '154', 'MR CONO SUR', '', '', '');
INSERT INTO microred VALUES ('779', '154', 'MR CONO NORTE', '', '', '');
INSERT INTO microred VALUES ('780', '154', 'MR LITORAL', '', '', '');
INSERT INTO microred VALUES ('781', '154', 'MR JORGE BASADRE', '', '', '');
INSERT INTO microred VALUES ('782', '154', 'MR FRONTERA', '', '', '');
INSERT INTO microred VALUES ('783', '154', 'MR TARATA', '', '', '');
INSERT INTO microred VALUES ('784', '154', 'MR CANDARAVE', '', '', '');
INSERT INTO microred VALUES ('785', '154', 'MR ALTO ANDINO', '', '', '');
INSERT INTO microred VALUES ('786', '155', 'MR ZARUMILLA', '', '', '');
INSERT INTO microred VALUES ('787', '155', 'MR PAMPA GRANDE', '', '', '');
INSERT INTO microred VALUES ('788', '155', 'MR CORRALES', '', '', '');
INSERT INTO microred VALUES ('789', '155', 'MR ZORRITOS', '', '', '');
INSERT INTO microred VALUES ('790', '156', 'MR SAN FERNANDO', '', '', '');
INSERT INTO microred VALUES ('791', '156', 'MR 09 DE OCTUBRE', '', '', '');
INSERT INTO microred VALUES ('792', '156', 'MR MASISEA', '', '', '');
INSERT INTO microred VALUES ('793', '156', 'MR IPARIA', '', '', '');
INSERT INTO microred VALUES ('794', '156', 'MR PURUS', '', '', '');
INSERT INTO microred VALUES ('795', '157', 'MR NUEVO PARAISO', '', '', '');
INSERT INTO microred VALUES ('796', '157', 'MR SAN JOSE DE YARINACOCHA', '', '', '');
INSERT INTO microred VALUES ('797', '157', 'MR CAMPO VERDE', '', '', '');
INSERT INTO microred VALUES ('798', '157', 'MR NUEVA REQUENA', '', '', '');
INSERT INTO microred VALUES ('799', '157', 'MR MONTE ALEGRE-CURIMANA', '', '', '');
INSERT INTO microred VALUES ('800', '158', 'MR ATALAYA', '', '', '');
INSERT INTO microred VALUES ('801', '158', 'MR SEPAHUA', '', '', '');
INSERT INTO microred VALUES ('802', '158', 'MR BOLOGNESI', '', '', '');
INSERT INTO microred VALUES ('803', '159', 'MR AGUAYTIA', '', '', '');
INSERT INTO microred VALUES ('804', '159', 'MR SAN ALEJANDRO', '', '', '');
-- 
--  Table structure for table `nucleo`
-- 

CREATE TABLE `nucleo` (
  `idnucleo` int(10) unsigned NOT NULL,
  `idmicrored` int(10) unsigned DEFAULT NULL,
  `nombreNucleo` varchar(100) DEFAULT NULL,
  `codigoNucleo` char(3) NOT NULL,
  `codigoDiresa` char(3) NOT NULL,
  `codigoRed` char(3) NOT NULL,
  `codigoMicrored` char(3) NOT NULL,
  PRIMARY KEY (`idnucleo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- Dumping data for table `nucleo`

INSERT INTO nucleo VALUES ('1', '1', 'NUCLEO ASCENCION', '01', '13', '01', '01');
INSERT INTO nucleo VALUES ('2', '2', 'NUCLEO YAULI', '03', '13', '01', '02');
INSERT INTO nucleo VALUES ('3', '2', 'NUCLEO CCASAPATA', '04', '13', '01', '02');
INSERT INTO nucleo VALUES ('4', '2', 'NUCLEO SAN JUAN DE CCARHUACC', '53', '13', '01', '02');
INSERT INTO nucleo VALUES ('5', '3', 'NUCLEO AYACCOCHA', '05', '13', '01', '03');
INSERT INTO nucleo VALUES ('6', '4', 'NUCLEO HUANDO', '06', '13', '01', '04');
INSERT INTO nucleo VALUES ('7', '4', 'NUCLEO PALCA', '54', '13', '01', '04');
INSERT INTO nucleo VALUES ('8', '5', 'NUCLEO IZCUCHACA', '07', '13', '01', '05');
INSERT INTO nucleo VALUES ('9', '5', 'NUCLEO CONAICA', '08', '13', '01', '05');
INSERT INTO nucleo VALUES ('10', '6', 'NUCLEO VINAS', '09', '13', '01', '06');
INSERT INTO nucleo VALUES ('11', '6', 'NUCLEO MOYA', '10', '13', '01', '06');
INSERT INTO nucleo VALUES ('12', '7', 'NUCLEO ACORIA', '11', '13', '01', '07');
INSERT INTO nucleo VALUES ('13', '7', 'NUCLEO ANANCUSI', '55', '13', '01', '07');
INSERT INTO nucleo VALUES ('14', '8', 'NUCLEO SANTA ANA', '02', '13', '01', '11');
INSERT INTO nucleo VALUES ('15', '9', 'NUCLEO ACOBAMBA', '12', '13', '02', '01');
INSERT INTO nucleo VALUES ('16', '9', 'NUCLEO CAJA ESPIRITU', '13', '13', '02', '01');
INSERT INTO nucleo VALUES ('17', '10', 'NUCLEO PAUCARA', '14', '13', '02', '02');
INSERT INTO nucleo VALUES ('18', '10', 'NUCLEO TINQUERCCASA', '15', '13', '02', '02');
INSERT INTO nucleo VALUES ('19', '10', 'NUCLEO PUCA CRUZ', '16', '13', '02', '02');
INSERT INTO nucleo VALUES ('20', '10', 'NUCLEO ANTA', '17', '13', '02', '02');
INSERT INTO nucleo VALUES ('21', '11', 'NUCLEO PAZOS', '22', '13', '03', '02');
INSERT INTO nucleo VALUES ('22', '11', 'NUCLEO HUARIBAMBA', '23', '13', '03', '02');
INSERT INTO nucleo VALUES ('23', '12', 'NUCLEO COLCABAMBA', '24', '13', '03', '03');
INSERT INTO nucleo VALUES ('24', '12', 'NUCLEO ANDAYMARCA', '25', '13', '03', '03');
INSERT INTO nucleo VALUES ('25', '13', 'NUCLEO SAN ISIDRO DE ACOBAMBA', '26', '13', '03', '04');
INSERT INTO nucleo VALUES ('26', '14', 'NUCLEO SURCUBAMBA', '27', '13', '03', '05');
INSERT INTO nucleo VALUES ('27', '14', 'NUCLEO TINTAY PUNCO', '28', '13', '03', '05');
INSERT INTO nucleo VALUES ('28', '15', 'NUCLEO QUICHUAS', '29', '13', '03', '06');
INSERT INTO nucleo VALUES ('29', '15', 'NUCLEO ACOSTAMBO', '30', '13', '03', '06');
INSERT INTO nucleo VALUES ('30', '30', 'NUCLEO PAMPAS', '0', '13', '0', '0');
INSERT INTO nucleo VALUES ('31', '16', 'NUCLEO ACRAQUIA', '19', '13', '03', '07');
INSERT INTO nucleo VALUES ('32', '17', 'NUCLEO DANIEL HERNANDEZ', '20', '13', '03', '08');
INSERT INTO nucleo VALUES ('33', '17', 'NUCLEO SALCABAMBA', '21', '13', '03', '08');
INSERT INTO nucleo VALUES ('34', '18', 'NUCLEO HUAYLLAY GRANDE', '31', '13', '04', '01');
INSERT INTO nucleo VALUES ('35', '19', 'NUCLEO CCOCHACCASA', '32', '13', '04', '02');
INSERT INTO nucleo VALUES ('36', '19', 'NUCLEO PARCO ALTO', '33', '13', '04', '02');
INSERT INTO nucleo VALUES ('37', '20', 'NUCLEO JULCAMARCA', '34', '13', '04', '03');
INSERT INTO nucleo VALUES ('38', '20', 'NUCLEO SECCLLA', '35', '13', '04', '03');
INSERT INTO nucleo VALUES ('39', '21', 'NUCLEO CASTROVIRREYNA', '36', '13', '05', '01');
INSERT INTO nucleo VALUES ('40', '21', 'NUCLEO TICRAPO', '37', '13', '05', '01');
INSERT INTO nucleo VALUES ('41', '22', 'NUCLEO VILLA DE ARMA', '38', '13', '05', '02');
INSERT INTO nucleo VALUES ('42', '22', 'NUCLEO HUACHOS', '39', '13', '05', '02');
INSERT INTO nucleo VALUES ('43', '23', 'NUCLEO AURAHUA', '40', '13', '05', '03');
INSERT INTO nucleo VALUES ('44', '23', 'NUCLEO TANTARA', '41', '13', '05', '03');
INSERT INTO nucleo VALUES ('45', '24', 'NUCLEO CHURCAMPA', '42', '13', '06', '01');
INSERT INTO nucleo VALUES ('46', '24', 'NUCLEO ANCO', '43', '13', '06', '01');
INSERT INTO nucleo VALUES ('47', '25', 'NUCLEO PAUCARBAMBA', '44', '13', '06', '02');
INSERT INTO nucleo VALUES ('48', '25', 'NUCLEO SAN PEDRO  DE CORIS', '45', '13', '06', '02');
INSERT INTO nucleo VALUES ('49', '26', 'NUCLEO HUAYTARA', '46', '13', '07', '01');
INSERT INTO nucleo VALUES ('50', '26', 'NUCLEO SANTA ROSA DE TAMBO', '47', '13', '07', '01');
INSERT INTO nucleo VALUES ('51', '27', 'NUCLEO SANTIAGO DE CHOCORVOS', '48', '13', '07', '02');
INSERT INTO nucleo VALUES ('52', '28', 'NUCLEO CORDOVA', '49', '13', '07', '03');
INSERT INTO nucleo VALUES ('53', '28', 'NUCLEO QUERCO', '50', '13', '07', '03');
INSERT INTO nucleo VALUES ('54', '29', 'NUCLEO PILPICHACA', '51', '13', '07', '04');
INSERT INTO nucleo VALUES ('55', '31', 'NUCLEO CHACHAPOYAS', '01', '01', '01', '01');
INSERT INTO nucleo VALUES ('56', '32', 'NUCLEO PEDRO  RUIZ', '02', '01', '01', '02');
INSERT INTO nucleo VALUES ('57', '33', 'NUCLEO POMACOCHAS', '03', '01', '01', '03');
INSERT INTO nucleo VALUES ('58', '34', 'NUCLEO JUMBILLA', '04', '01', '01', '04');
INSERT INTO nucleo VALUES ('59', '35', 'NUCLEO OCALLI', '05', '01', '01', '05');
INSERT INTO nucleo VALUES ('60', '36', 'NUCLEO COLLONCE', '06', '01', '01', '06');
INSERT INTO nucleo VALUES ('61', '37', 'NUCLEO LAMUD', '07', '01', '01', '07');
INSERT INTO nucleo VALUES ('62', '38', 'NUCLEO TINGO', '08', '01', '01', '08');
INSERT INTO nucleo VALUES ('63', '39', 'NUCLEO YERBABUENA', '09', '01', '01', '09');
INSERT INTO nucleo VALUES ('64', '40', 'NUCLEO LEYMEBAMBA', '10', '01', '01', '10');
INSERT INTO nucleo VALUES ('65', '41', 'NUCLEO PIPUS', '11', '01', '01', '11');
INSERT INTO nucleo VALUES ('66', '42', 'NUCLEO RODRIGUEZ  DE MENDOZA', '12', '01', '01', '12');
INSERT INTO nucleo VALUES ('67', '43', 'NUCLEO LUYA', '13', '01', '01', '13');
INSERT INTO nucleo VALUES ('68', '44', 'NUCLEO TOTORA', '14', '01', '01', '14');
INSERT INTO nucleo VALUES ('69', '45', 'NUCLEO SANTO TOMAS', '15', '01', '01', '15');
INSERT INTO nucleo VALUES ('70', '46', 'NUCLEO MOLINOPAMPA', '16', '01', '01', '16');
INSERT INTO nucleo VALUES ('71', '47', 'NUCLEO NUEVO CHIRIMOTO', '17', '01', '01', '17');
INSERT INTO nucleo VALUES ('72', '48', 'NUCLEO OMIA', '18', '01', '01', '18');
INSERT INTO nucleo VALUES ('73', '49', 'NUCLEO HUAMBO', '19', '01', '01', '19');
INSERT INTO nucleo VALUES ('74', '50', 'NUCLEO LONGAR', '20', '01', '01', '20');
INSERT INTO nucleo VALUES ('75', '51', 'NUCLEO ZARUMILLA', '21', '01', '01', '21');
INSERT INTO nucleo VALUES ('76', '52', 'NUCLEO LA PECA', '01', '01', '02', '01');
INSERT INTO nucleo VALUES ('77', '53', 'NUCLEO ARAMANGO', '02', '01', '02', '02');
INSERT INTO nucleo VALUES ('78', '54', 'NUCLEO COPALLIN', '03', '01', '02', '03');
INSERT INTO nucleo VALUES ('79', '55', 'NUCLEO IMAZA', '04', '01', '02', '04');
INSERT INTO nucleo VALUES ('80', '56', 'NUCLEO CHIRIACO', '05', '01', '02', '05');
INSERT INTO nucleo VALUES ('81', '57', 'NUCLEO BAGUA', '06', '01', '02', '06');
INSERT INTO nucleo VALUES ('82', '58', 'NUCLEO WAYAMPIAK', '07', '01', '02', '07');
INSERT INTO nucleo VALUES ('83', '59', 'NUCLEO TUPAC AMARU', '08', '01', '02', '08');
INSERT INTO nucleo VALUES ('84', '60', 'NUCLEO BAGUA GRANDE', '01', '01', '03', '01');
INSERT INTO nucleo VALUES ('85', '61', 'NUCLEO CAJARURO', '02', '01', '03', '02');
INSERT INTO nucleo VALUES ('86', '62', 'NUCLEO ALTO AMAZONAS', '03', '01', '03', '03');
INSERT INTO nucleo VALUES ('87', '63', 'NUCLEO NARANJITOS', '04', '01', '03', '04');
INSERT INTO nucleo VALUES ('88', '64', 'NUCLEO JAMALCA', '05', '01', '03', '05');
INSERT INTO nucleo VALUES ('89', '65', 'NUCLEO EL MILAGRO', '06', '01', '03', '06');
INSERT INTO nucleo VALUES ('90', '66', 'NUCLEO CUMBA', '07', '01', '03', '07');
INSERT INTO nucleo VALUES ('91', '67', 'NUCLEO LONYA GRANDE', '08', '01', '03', '08');
INSERT INTO nucleo VALUES ('92', '68', 'NUCLEO NUNYA JALCA', '09', '01', '03', '09');
INSERT INTO nucleo VALUES ('93', '69', 'NUCLEO COLLICATE', '10', '01', '03', '10');
INSERT INTO nucleo VALUES ('94', '70', 'NUCLEO MIRAFLORES', '11', '01', '03', '11');
INSERT INTO nucleo VALUES ('95', '71', 'NUCLEO NIEVA', '01', '01', '04', '01');
INSERT INTO nucleo VALUES ('96', '72', 'NUCLEO GALILEA', '02', '01', '04', '02');
INSERT INTO nucleo VALUES ('97', '73', 'NUCLEO KINGKIS', '03', '01', '04', '03');
INSERT INTO nucleo VALUES ('98', '74', 'NUCLEO HUAMPAMI', '04', '01', '04', '04');
INSERT INTO nucleo VALUES ('99', '11', 'NUCLEO SANTIAGO DE PICHUS', '24', '13', '03', '02');
INSERT INTO nucleo VALUES ('100', '14', 'NUCLEO HUACHOCOLPA', '29', '13', '03', '05');
INSERT INTO nucleo VALUES ('101', '5', 'NUCLEO NUEVO OCCORO', '59', '13', '01', '05');
INSERT INTO nucleo VALUES ('102', '8', 'NUCLEO SAN CRISTOBAL', '58', '13', '01', '11');
INSERT INTO nucleo VALUES ('103', '10', 'NUCLEO HUAYANAY', '61', '13', '02', '02');
INSERT INTO nucleo VALUES ('104', '18', 'NUCLEO CCARHUAPATA', '63', '13', '04', '01');
INSERT INTO nucleo VALUES ('105', '18', 'NUCLEO SAN JUAN DE DIOS DE CCOLLPAPAMPA', '64', '13', '04', '01');
INSERT INTO nucleo VALUES ('106', '18', 'NUCLEO BUENA VISTA', '65', '13', '04', '01');
-- 
--  Table structure for table `pais`
-- 

CREATE TABLE `pais` (
  `idPAIS` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idpersona` int(10) unsigned NOT NULL,
  `idetapaVida` int(10) unsigned NOT NULL,
  `estadoPlan` varchar(100) DEFAULT NULL,
  `anio` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idPAIS`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `pais`

-- 
--  Table structure for table `persona`
-- 

CREATE TABLE `persona` (
  `idpersona` int(10) unsigned NOT NULL,
  `idfamilia` int(10) unsigned DEFAULT NULL,
  `iddistrito` int(10) unsigned DEFAULT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `numeroHC` varchar(20) DEFAULT NULL,
  `opcionDNI` varchar(50) DEFAULT NULL,
  `dni` varchar(10) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellidoMaterno` varchar(100) DEFAULT NULL,
  `apellidoPaterno` varchar(100) DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `gradoInstruccion` varchar(100) DEFAULT NULL,
  `seguroMedico` varchar(100) DEFAULT NULL,
  `numeroSeguro` char(8) DEFAULT NULL,
  `ocupacion` varchar(100) DEFAULT NULL,
  `tipoOcupacion` varchar(100) DEFAULT NULL,
  `parentesco` varchar(100) DEFAULT NULL,
  `estadoCivil` char(2) DEFAULT NULL,
  `jefeFamilia` char(2) DEFAULT NULL,
  `pertenenciaEtnica` varchar(100) DEFAULT NULL,
  `desendenciaEtnica` varchar(100) DEFAULT NULL,
  `activo` char(2) DEFAULT 'AC',
  `motivo` varchar(100) DEFAULT NULL,
  `grupoSanguineo` char(4) NOT NULL,
  `grupoRiesgo` varchar(50) NOT NULL,
  `opcionLugarResidencia` char(2) NOT NULL,
  `lugarResidencia` varchar(50) NOT NULL,
  `contacto` varchar(100) NOT NULL,
  `telefonoContacto` varchar(20) NOT NULL,
  `parentescoContacto` varchar(30) NOT NULL,
  `estudia` varchar(10) NOT NULL,
  PRIMARY KEY (`idpersona`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `persona`

-- 
--  Table structure for table `personah`
-- 

CREATE TABLE `personah` (
  `claveGeneral` varchar(100) NOT NULL,
  `idpersonaH` int(10) unsigned NOT NULL,
  `idfamiliaH` int(10) unsigned DEFAULT NULL,
  `numeroHC` varchar(20) DEFAULT NULL,
  `opcionDNI` varchar(50) DEFAULT NULL,
  `dni` varchar(10) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellidoPaterno` varchar(100) DEFAULT NULL,
  `apellidoMaterno` varchar(100) DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `gradoInstruccion` varchar(100) DEFAULT NULL,
  `seguroMedico` varchar(100) DEFAULT NULL,
  `numeroSeguro` char(8) DEFAULT NULL,
  `ocupacion` varchar(100) DEFAULT NULL,
  `tipoOcupacion` varchar(100) DEFAULT NULL,
  `parentesco` varchar(100) DEFAULT NULL,
  `estadoCivil` char(2) DEFAULT NULL,
  `jefeFamilia` char(2) DEFAULT NULL,
  `pertenenciaEtnica` varchar(100) DEFAULT NULL,
  `activo` char(2) DEFAULT NULL,
  `motivo` varchar(100) DEFAULT NULL,
  `iddistrito` int(10) unsigned DEFAULT NULL,
  `nombreDistrito` varchar(100) DEFAULT NULL,
  `desendenciaEtnica` varchar(100) DEFAULT NULL,
  `grupoSanguineo` char(4) NOT NULL,
  `grupoRiesgo` varchar(50) NOT NULL,
  `opcionLugarResidencia` char(2) NOT NULL,
  `lugarResidencia` varchar(50) NOT NULL,
  `contacto` varchar(100) NOT NULL,
  `telefonoContacto` varchar(20) NOT NULL,
  `parentescoContacto` varchar(30) NOT NULL,
  `estudia` varchar(10) NOT NULL,
  PRIMARY KEY (`claveGeneral`,`idpersonaH`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- Dumping data for table `personah`

-- 
--  Table structure for table `plantamedicinal`
-- 

CREATE TABLE `plantamedicinal` (
  `idplantaMedicinal` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idepisodio` int(10) unsigned DEFAULT NULL,
  `planta` text,
  PRIMARY KEY (`idplantaMedicinal`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `plantamedicinal`

-- 
--  Table structure for table `prestacionaiepi`
-- 

CREATE TABLE `prestacionaiepi` (
  `idprestacionAiepi` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idcatalogoPrestacion` int(10) unsigned DEFAULT NULL,
  `idpersona` int(10) unsigned DEFAULT NULL,
  `idepisodio` int(10) unsigned DEFAULT NULL,
  `idcatalogoUPS` int(10) unsigned DEFAULT NULL,
  `nombreCatalogo` text,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `infeccionBacteriana` char(2) DEFAULT NULL,
  `respiracionesPorMinuto` int(10) unsigned DEFAULT NULL,
  `respiracionRapida` char(2) DEFAULT NULL,
  `tirajeSubcostal` char(2) DEFAULT NULL,
  `aleteoNasal` char(2) DEFAULT NULL,
  `quejido` char(2) DEFAULT NULL,
  `estadoFontanela` text,
  `supuracionOido` char(2) DEFAULT NULL,
  `estadoOmbligo` varchar(20) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `temperatura` char(2) DEFAULT NULL,
  `pielPustulas` char(2) DEFAULT NULL,
  `letargio` char(2) DEFAULT NULL,
  `movimientoAnormal` char(2) DEFAULT NULL,
  `secrecionOjos` char(2) DEFAULT NULL,
  `diarrea` char(2) DEFAULT NULL,
  `tiempoDiarrea` int(10) unsigned DEFAULT NULL,
  `sangreHeces` char(2) DEFAULT NULL,
  `estadoGeneral` varchar(30) DEFAULT NULL,
  `ojosHundidos` char(2) DEFAULT NULL,
  `signoCutaneo` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idprestacionAiepi`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `prestacionaiepi`

-- 
--  Table structure for table `prestacionalimentacionrn`
-- 

CREATE TABLE `prestacionalimentacionrn` (
  `idprestacionAlimentacionRN` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idcatalogoPrestacion` int(10) unsigned DEFAULT NULL,
  `idepisodio` int(10) unsigned DEFAULT NULL,
  `idpersona` int(10) unsigned DEFAULT NULL,
  `idcatalogoUPS` int(10) unsigned DEFAULT NULL,
  `nombreCatalogo` varchar(100) DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `tomaPecho` char(2) DEFAULT NULL,
  `nroVecesPecho` int(10) unsigned DEFAULT NULL,
  `opcomidas` char(2) DEFAULT NULL,
  `cualesComidas` text,
  `cambioDuranteEnfermedad` char(2) DEFAULT NULL,
  `cualesEnfermedades` text,
  `ulcerasBocaBajoPeso` char(2) DEFAULT NULL,
  `alimentacionUltimaHora` char(2) DEFAULT NULL,
  `opAmarre` char(2) DEFAULT NULL,
  `mamaCorrecto` varchar(50) DEFAULT NULL,
  `ulcerasBoca` char(2) DEFAULT NULL,
  `buenaPosicion` char(2) DEFAULT NULL,
  `observaciones` text,
  PRIMARY KEY (`idprestacionAlimentacionRN`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `prestacionalimentacionrn`

-- 
--  Table structure for table `prestacionconsejeria`
-- 

CREATE TABLE `prestacionconsejeria` (
  `idprestacionConsejeria` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idcatalogoPrestacion` int(10) unsigned DEFAULT NULL,
  `idepisodio` int(10) unsigned DEFAULT NULL,
  `idpersona` int(10) unsigned DEFAULT NULL,
  `idcatalogoUPS` int(10) unsigned DEFAULT NULL,
  `nombreCatalogo` text,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idprestacionConsejeria`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `prestacionconsejeria`

-- 
--  Table structure for table `prestacionevaluacionlme`
-- 

CREATE TABLE `prestacionevaluacionlme` (
  `idprestacionEvaluacionLME` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idcatalogoPrestacion` int(10) unsigned DEFAULT NULL,
  `idepisodio` int(10) unsigned DEFAULT NULL,
  `idpersona` int(10) unsigned DEFAULT NULL,
  `idcatalogoUPS` int(10) unsigned DEFAULT NULL,
  `nombreCatalogo` varchar(200) DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `lactanciaLM` char(2) DEFAULT NULL,
  `tecnicaLM` char(2) DEFAULT NULL,
  `frecuenciaLM` char(2) DEFAULT NULL,
  `lecheNoMaterna` char(2) DEFAULT NULL,
  `recibeAguitas` char(2) DEFAULT NULL,
  `otroAlimento` char(2) DEFAULT NULL,
  `consistenciaAdecuada` char(2) DEFAULT NULL,
  `cantidadAdecuada` char(2) DEFAULT NULL,
  `frecuenciaAdecuada` char(2) DEFAULT NULL,
  `consumoAlimentosAnimal` char(2) DEFAULT NULL,
  `consumoFrutasVerduras` char(2) DEFAULT NULL,
  `consumoMantequilla` char(2) DEFAULT NULL,
  `alimentosEnPlato` char(2) DEFAULT NULL,
  `usaSalYodada` char(2) DEFAULT NULL,
  `tomaSuplementoHierro` char(2) DEFAULT NULL,
  `tomaSuplementoVitamina` char(2) DEFAULT NULL,
  `recibeMicronutrientes` char(2) DEFAULT NULL,
  `opcionBeneficiarioPrograma` char(2) NOT NULL,
  `descripcionPrograma` text,
  PRIMARY KEY (`idprestacionEvaluacionLME`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `prestacionevaluacionlme`

-- 
--  Table structure for table `prestacionevaluacionnino`
-- 

CREATE TABLE `prestacionevaluacionnino` (
  `idprestacionEvaluacionNino` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idcatalogoPrestacion` int(10) unsigned DEFAULT NULL,
  `idpersona` int(10) unsigned DEFAULT NULL,
  `idepisodio` int(10) unsigned DEFAULT NULL,
  `idcatalogoUPS` int(10) unsigned DEFAULT NULL,
  `nombreCatalogo` text,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `signosPeligro` char(2) DEFAULT NULL,
  `remedioRecibidos` text,
  `opTos` char(2) DEFAULT NULL,
  `diasTiempoTos` int(10) unsigned DEFAULT NULL,
  `supuracionOido` char(2) DEFAULT NULL,
  `diasSupuracion` int(10) unsigned DEFAULT NULL,
  `tumefaccionOreja` char(2) DEFAULT NULL,
  `dolorGarganta` char(2) DEFAULT NULL,
  `exudado` char(2) DEFAULT NULL,
  `gangliosDolorosos` char(2) DEFAULT NULL,
  `diarrea` char(2) DEFAULT NULL,
  `tiempoDiarrea` int(10) unsigned DEFAULT NULL,
  `estadoGeneral` text,
  `sangreHeces` varchar(50) DEFAULT NULL,
  `ojosHundidos` varchar(100) DEFAULT NULL,
  `signosPliegue` varchar(100) DEFAULT NULL,
  `fiebre` char(2) DEFAULT NULL,
  `riesgoMalaria` char(2) DEFAULT NULL,
  `observaciones` text,
  PRIMARY KEY (`idprestacionEvaluacionNino`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `prestacionevaluacionnino`

-- 
--  Table structure for table `prestacionexamenintegral`
-- 

CREATE TABLE `prestacionexamenintegral` (
  `idprestacionExamenIntegral` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idcatalogoPrestacion` int(10) unsigned DEFAULT NULL,
  `idepisodio` int(10) unsigned DEFAULT NULL,
  `idpersona` int(10) unsigned DEFAULT NULL,
  `idcatalogoUPS` int(10) unsigned DEFAULT NULL,
  `nombreCatalogo` text,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `opcionPiel` varchar(30) DEFAULT NULL,
  `descripcionPiel` text,
  `opcionCabeza` varchar(30) DEFAULT NULL,
  `descripcionCabeza` text,
  `opcionCabello` varchar(30) DEFAULT NULL,
  `descripcionCabello` text,
  `opcionOjos` varchar(30) DEFAULT NULL,
  `descripcionOjoD` text,
  `descripcionOjoI` text,
  `opcionOidos` varchar(30) DEFAULT NULL,
  `descripcionOidoD` text,
  `descripcionOidoI` text,
  `opcionNariz` varchar(30) DEFAULT NULL,
  `descripcionNariz` text,
  `opcionBoca` varchar(30) DEFAULT NULL,
  `descripcionBoca` text,
  `opcionOrofaringe` varchar(30) DEFAULT NULL,
  `descripcionOrofaringe` text,
  `opcionCuello` varchar(30) DEFAULT NULL,
  `descripcionCuello` text,
  `opcionRespiratorio` varchar(30) DEFAULT NULL,
  `descripcionRespiratorio` text,
  `opcionCardiovascular` varchar(30) DEFAULT NULL,
  `descripcionCardiovascular` text,
  `opcionDigestivo` varchar(30) DEFAULT NULL,
  `descripcionDigestivo` text,
  `opcionGenitourinario` varchar(30) DEFAULT NULL,
  `descripcionGenitourinario` text,
  `opcionLocomotor` varchar(30) DEFAULT NULL,
  `descripcionLocomotor` text,
  `opcionMarcha` varchar(30) DEFAULT NULL,
  `descripcionMarcha` text,
  `opcionColumna` varchar(30) DEFAULT NULL,
  `descripcionColumna` text,
  `opcionSuperior` varchar(30) DEFAULT NULL,
  `descripcionSuperior` text,
  `opcionInferior` varchar(30) DEFAULT NULL,
  `descripcionInferior` text,
  `opcionLinfatico` varchar(30) DEFAULT NULL,
  `descripcionLinfatico` text,
  PRIMARY KEY (`idprestacionExamenIntegral`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `prestacionexamenintegral`

-- 
--  Table structure for table `procedimiento`
-- 

CREATE TABLE `procedimiento` (
  `idprocedimiento` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idepisodio` int(10) unsigned DEFAULT NULL,
  `idcatalogoCPT` int(10) unsigned DEFAULT NULL,
  `nombreCatalogo` text,
  `nombre` varchar(100) DEFAULT NULL,
  `frecuencia` varchar(20) DEFAULT NULL,
  `observacion` text,
  PRIMARY KEY (`idprocedimiento`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `procedimiento`

-- 
--  Table structure for table `profesion`
-- 

CREATE TABLE `profesion` (
  `idprofesion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigoColegio` varchar(10) NOT NULL,
  `codigoProfesion` varchar(10) DEFAULT NULL,
  `nombre` text,
  `primer_nivel` int(11) NOT NULL,
  `segundo_nivel` int(11) NOT NULL,
  `tercer_nivel` int(11) NOT NULL,
  PRIMARY KEY (`idprofesion`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;


-- Dumping data for table `profesion`

INSERT INTO profesion VALUES ('1', '01', '01', 'MEDICO GENERAL', '1', '0', '0');
INSERT INTO profesion VALUES ('2', '01', '02', 'MEDICO NEUMOLOGO', '0', '0', '0');
INSERT INTO profesion VALUES ('3', '01', '03', 'MEDICO CARDIOLOGO', '0', '0', '0');
INSERT INTO profesion VALUES ('4', '01', '04', 'MEDICO NEUROLOGO', '0', '0', '0');
INSERT INTO profesion VALUES ('5', '01', '05', 'MEDICO GASTROENTEROLOGO', '0', '0', '0');
INSERT INTO profesion VALUES ('6', '01', '06', 'MEDICO DERMATOLOGO', '0', '0', '0');
INSERT INTO profesion VALUES ('7', '01', '07', 'MEDICO NEFROLOGO', '0', '0', '0');
INSERT INTO profesion VALUES ('8', '01', '08', 'MEDICO ONCOLOGO', '0', '0', '0');
INSERT INTO profesion VALUES ('9', '01', '09', 'MEDICO PSIQUIATRA', '0', '0', '0');
INSERT INTO profesion VALUES ('10', '01', '10', 'MEDICO CIRUJANO GENERAL', '0', '0', '0');
INSERT INTO profesion VALUES ('11', '01', '11', 'MEDICO TRAUMATOLOGO ORTOPEDISTA', '0', '0', '0');
INSERT INTO profesion VALUES ('12', '01', '12', 'MEDICO OTORRINOLARINGOLOGO', '0', '0', '0');
INSERT INTO profesion VALUES ('13', '01', '13', 'MEDICO OFTALMOLOGO', '0', '0', '0');
INSERT INTO profesion VALUES ('14', '01', '14', 'MEDICO UROLOGO', '0', '0', '0');
INSERT INTO profesion VALUES ('15', '01', '15', 'MEDICO CIRUJANO ONCOLOGO', '0', '0', '0');
INSERT INTO profesion VALUES ('16', '01', '16', 'MEDICO PATOLOGO', '0', '0', '0');
INSERT INTO profesion VALUES ('17', '01', '17', 'MEDICO OTROS CIRUGIA', '0', '0', '0');
INSERT INTO profesion VALUES ('18', '01', '18', 'MEDICO PEDIATRA', '0', '0', '0');
INSERT INTO profesion VALUES ('19', '01', '19', 'MEDICO GINECO-OBSTETRA', '0', '0', '0');
INSERT INTO profesion VALUES ('20', '01', '20', 'MEDICO EPIDEMIOLOGO', '0', '0', '0');
INSERT INTO profesion VALUES ('21', '01', '21', 'MEDICO RADIOLOGO', '0', '0', '0');
INSERT INTO profesion VALUES ('22', '01', '22', 'MEDICO OTRAS ESPECIALIDADES', '1', '0', '0');
INSERT INTO profesion VALUES ('23', '05', '23', 'OBSTETRA', '1', '0', '0');
INSERT INTO profesion VALUES ('24', '10', '24', 'NUTRICIONISTA', '1', '0', '0');
INSERT INTO profesion VALUES ('25', '03', '25', 'ODONTOLOGO', '1', '0', '0');
INSERT INTO profesion VALUES ('26', '02', '26', 'QUIMICO FARMACEUTICO', '1', '0', '0');
INSERT INTO profesion VALUES ('27', '00', '27', 'RADIOTERAPEUTA', '0', '0', '0');
INSERT INTO profesion VALUES ('28', '08', '28', 'PSICOLOGO', '1', '0', '0');
INSERT INTO profesion VALUES ('29', '06', '29', 'ENFERMERA (O)', '1', '0', '0');
INSERT INTO profesion VALUES ('30', '09', '30', 'TECNOLOGO MEDICO', '0', '0', '0');
INSERT INTO profesion VALUES ('31', '04', '31', 'BIOLOGO', '1', '0', '0');
INSERT INTO profesion VALUES ('32', '11', '32', 'VETERINARIO', '0', '0', '0');
INSERT INTO profesion VALUES ('33', '07', '33', 'ASISTENTA SOCIAL', '1', '0', '0');
INSERT INTO profesion VALUES ('34', '00', '34', 'TECNICOS DE SALUD', '1', '0', '0');
INSERT INTO profesion VALUES ('35', '00', '35', 'TECNICAS DE ENFERMERIA', '1', '0', '0');
INSERT INTO profesion VALUES ('36', '00', '36', 'TECNICO DE LABORATORIO', '1', '0', '0');
INSERT INTO profesion VALUES ('37', '00', '37', 'TECNICO RADIOLOGO', '1', '0', '0');
INSERT INTO profesion VALUES ('38', '00', '38', 'TECNICO DENTAL', '1', '0', '0');
INSERT INTO profesion VALUES ('39', '00', '39', 'TECNICO SANEAMIENTO AMBIENTAL', '1', '0', '0');
INSERT INTO profesion VALUES ('40', '00', '40', 'AUXILIARES DE SALUD', '1', '0', '0');
INSERT INTO profesion VALUES ('41', '00', '41', 'OTROS TECNICOS Y AUXILIARES', '0', '0', '0');
INSERT INTO profesion VALUES ('42', '00', '42', 'OTROS NO ESPECIFICADOS', '0', '0', '0');
INSERT INTO profesion VALUES ('43', '00', '43', 'INTERNO DE MEDICINA', '0', '0', '0');
INSERT INTO profesion VALUES ('44', '00', '44', 'INTERNOS NO MEDICOS', '0', '0', '0');
INSERT INTO profesion VALUES ('45', '01', '45', 'SERUMISTA MEDICO', '1', '0', '0');
INSERT INTO profesion VALUES ('46', '06', '46', 'SERUMISTA ENFERMERA', '1', '0', '0');
INSERT INTO profesion VALUES ('47', '03', '47', 'SERUMISTA ODONTOLOGO', '1', '0', '0');
INSERT INTO profesion VALUES ('48', '05', '48', 'SERUMISTA OBSTETRA', '1', '0', '0');
INSERT INTO profesion VALUES ('49', '07', '49', 'SERUMISTA SERVICIO SOCIAL', '1', '0', '0');
INSERT INTO profesion VALUES ('50', '08', '50', 'SERUMISTA PSICOLOGO', '1', '0', '0');
INSERT INTO profesion VALUES ('51', '01', '51', 'MEDICO RESIDENTE', '0', '0', '0');
INSERT INTO profesion VALUES ('52', '00', '52', 'AGENTE COMUNITARIO', '0', '0', '0');
INSERT INTO profesion VALUES ('53', '00', '53', 'ESTADISTICO', '0', '0', '0');
INSERT INTO profesion VALUES ('54', '00', '54', 'TECNICO INFORMÃTICO', '1', '0', '0');
INSERT INTO profesion VALUES ('55', '00', '55', 'TECNICO EN FARMACIA', '1', '0', '0');
INSERT INTO profesion VALUES ('56', '00', '56', 'CONDUCTOR', '1', '0', '0');
INSERT INTO profesion VALUES ('57', '00', '57', 'INGENIERO DE SISTEMAS', '1', '0', '0');
-- 
--  Table structure for table `programacionvacuna`
-- 

CREATE TABLE `programacionvacuna` (
  `idprogramacionVacuna` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idcatalogoVacuna` int(10) unsigned DEFAULT NULL,
  `nombreDosis` int(10) unsigned DEFAULT NULL,
  `opProgramacion` char(2) DEFAULT NULL,
  `limiteInicial` varchar(100) DEFAULT NULL,
  `factor` int(10) unsigned DEFAULT NULL,
  `detalleProgramacion` text,
  PRIMARY KEY (`idprogramacionVacuna`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `programacionvacuna`

-- 
--  Table structure for table `provincia`
-- 

CREATE TABLE `provincia` (
  `idprovincia` int(10) unsigned NOT NULL,
  `idregion` int(10) unsigned DEFAULT NULL,
  `nompro` varchar(255) DEFAULT NULL,
  `codigoProvincia` char(5) NOT NULL,
  `codigoRegion` char(2) NOT NULL,
  `capital` varchar(255) NOT NULL,
  PRIMARY KEY (`idprovincia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `provincia`

INSERT INTO provincia VALUES ('1', '1', 'CHACHAPOYAS', '0101', '01', 'CHACHAPOYAS');
INSERT INTO provincia VALUES ('2', '1', 'BAGUA', '0102', '01', 'BAGUA');
INSERT INTO provincia VALUES ('3', '1', 'BONGARA', '0103', '01', 'JUMBILLA');
INSERT INTO provincia VALUES ('4', '1', 'CONDORCANQUI', '0104', '01', 'SANTA MARIA DE NIEVA');
INSERT INTO provincia VALUES ('5', '1', 'LUYA', '0105', '01', 'LAMUD');
INSERT INTO provincia VALUES ('6', '1', 'RODRIGUEZ DE MENDOZA', '0106', '01', 'MENDOZA');
INSERT INTO provincia VALUES ('7', '1', 'UTCUBAMBA', '0107', '01', 'BAGUA GRANDE');
INSERT INTO provincia VALUES ('8', '2', 'HUARAZ', '0201', '02', 'HUARAZ');
INSERT INTO provincia VALUES ('9', '2', 'AIJA', '0202', '02', 'AIJA');
INSERT INTO provincia VALUES ('10', '2', 'ANTONIO RAYMONDI', '0203', '02', 'LLAMELLIN');
INSERT INTO provincia VALUES ('11', '2', 'ASUNCION', '0204', '02', 'CHACAS');
INSERT INTO provincia VALUES ('12', '2', 'BOLOGNESI', '0205', '02', 'CHIQUIAN');
INSERT INTO provincia VALUES ('13', '2', 'CARHUAZ', '0206', '02', 'CARHUAZ');
INSERT INTO provincia VALUES ('14', '2', 'CARLOS FERMIN FITZCARRALD', '0207', '02', 'SAN LUIS');
INSERT INTO provincia VALUES ('15', '2', 'CASMA', '0208', '02', 'CASMA');
INSERT INTO provincia VALUES ('16', '2', 'CORONGO', '0209', '02', 'CORONGO');
INSERT INTO provincia VALUES ('17', '2', 'HUARI', '0210', '02', 'HUARI');
INSERT INTO provincia VALUES ('18', '2', 'HUARMEY', '0211', '02', 'HUARMEY');
INSERT INTO provincia VALUES ('19', '2', 'HUAYLAS', '0212', '02', 'CARAZ');
INSERT INTO provincia VALUES ('20', '2', 'MARISCAL LUZURIAGA', '0213', '02', 'PISCOBAMBA');
INSERT INTO provincia VALUES ('21', '2', 'OCROS', '0214', '02', 'OCROS');
INSERT INTO provincia VALUES ('22', '2', 'PALLASCA', '0215', '02', 'CABANA');
INSERT INTO provincia VALUES ('23', '2', 'POMABAMBA', '0216', '02', 'POMABAMBA');
INSERT INTO provincia VALUES ('24', '2', 'RECUAY', '0217', '02', 'RECUAY');
INSERT INTO provincia VALUES ('25', '2', 'SANTA', '0218', '02', 'CHIMBOTE');
INSERT INTO provincia VALUES ('26', '2', 'SIHUAS', '0219', '02', 'SIHUAS');
INSERT INTO provincia VALUES ('27', '2', 'YUNGAY', '0220', '02', 'YUNGAY');
INSERT INTO provincia VALUES ('28', '3', 'ABANCAY', '0301', '03', 'ABANCAY');
INSERT INTO provincia VALUES ('29', '3', 'ANDAHUAYLAS', '0302', '03', 'ANDAHUAYLAS');
INSERT INTO provincia VALUES ('30', '3', 'ANTABAMBA', '0303', '03', 'ANTABAMBA');
INSERT INTO provincia VALUES ('31', '3', 'AYMARAES', '0304', '03', 'CHALHUANCA');
INSERT INTO provincia VALUES ('32', '3', 'COTABAMBAS', '0305', '03', 'TAMBOBAMBA');
INSERT INTO provincia VALUES ('33', '3', 'CHINCHEROS', '0306', '03', 'CHINCHEROS');
INSERT INTO provincia VALUES ('34', '4', 'AREQUIPA', '0401', '04', 'AREQUIPA');
INSERT INTO provincia VALUES ('35', '4', 'CAMANA', '0402', '04', 'CAMANA');
INSERT INTO provincia VALUES ('36', '4', 'CARAVELI', '0403', '04', 'CARAVELI');
INSERT INTO provincia VALUES ('37', '4', 'CASTILLA', '0404', '04', 'APLAO');
INSERT INTO provincia VALUES ('38', '4', 'CAYLLOMA', '0405', '04', 'CHIVAY');
INSERT INTO provincia VALUES ('39', '4', 'CONDESUYOS', '0406', '04', 'CHUQUIBAMBA');
INSERT INTO provincia VALUES ('40', '4', 'ISLAY', '0407', '04', 'MOLLENDO');
INSERT INTO provincia VALUES ('41', '4', 'LA UNION', '0408', '04', 'COTAHUASI');
INSERT INTO provincia VALUES ('42', '5', 'HUAMANGA', '0501', '05', 'AYACUCHO');
INSERT INTO provincia VALUES ('43', '5', 'CANGALLO', '0502', '05', 'CANGALLO');
INSERT INTO provincia VALUES ('44', '5', 'HUANCA SANCOS', '0503', '05', 'HUANCA SANCOS');
INSERT INTO provincia VALUES ('45', '5', 'HUANTA', '0504', '05', 'HUANTA');
INSERT INTO provincia VALUES ('46', '5', 'LA MAR', '0505', '05', 'SAN MIGUEL');
INSERT INTO provincia VALUES ('47', '5', 'LUCANAS', '0506', '05', 'PUQUIO');
INSERT INTO provincia VALUES ('48', '5', 'PARINACOCHAS', '0507', '05', 'CORACORA');
INSERT INTO provincia VALUES ('49', '5', 'PAUCAR DEL SARA SARA', '0508', '05', 'PAUSA');
INSERT INTO provincia VALUES ('50', '5', 'SUCRE', '0509', '05', 'QUEROBAMBA');
INSERT INTO provincia VALUES ('51', '5', 'VICTOR FAJARDO', '0510', '05', 'HUANCAPI');
INSERT INTO provincia VALUES ('52', '5', 'VILCAS HUAMAN', '0511', '05', 'VILCAS HUAMAN');
INSERT INTO provincia VALUES ('53', '6', 'CAJAMARCA', '0601', '06', 'CAJAMARCA');
INSERT INTO provincia VALUES ('54', '6', 'CAJABAMBA', '0602', '06', 'CAJABAMBA');
INSERT INTO provincia VALUES ('55', '6', 'CELENDIN', '0603', '06', 'CELENDIN');
INSERT INTO provincia VALUES ('56', '6', 'CHOTA', '0604', '06', 'CHOTA');
INSERT INTO provincia VALUES ('57', '6', 'CONTUMAZA', '0605', '06', 'CONTUMAZA');
INSERT INTO provincia VALUES ('58', '6', 'CUTERVO', '0606', '06', 'CUTERVO');
INSERT INTO provincia VALUES ('59', '6', 'HUALGAYOC', '0607', '06', 'BAMBAMARCA');
INSERT INTO provincia VALUES ('60', '6', 'JAEN', '0608', '06', 'JAEN');
INSERT INTO provincia VALUES ('61', '6', 'SAN IGNACIO', '0609', '06', 'SAN IGNACIO');
INSERT INTO provincia VALUES ('62', '6', 'SAN MARCOS', '0610', '06', 'SAN MARCOS');
INSERT INTO provincia VALUES ('63', '6', 'SAN MIGUEL', '0611', '06', 'SAN MIGUEL DE PALLAQUES');
INSERT INTO provincia VALUES ('64', '6', 'SAN PABLO', '0612', '06', 'SAN PABLO');
INSERT INTO provincia VALUES ('65', '6', 'SANTA CRUZ', '0613', '06', 'SANTA CRUZ DE SUCCHABAMBA');
INSERT INTO provincia VALUES ('66', '7', 'CALLAO', '0701', '07', 'CALLAO');
INSERT INTO provincia VALUES ('67', '8', 'CUSCO', '0801', '08', 'CUSCO');
INSERT INTO provincia VALUES ('68', '8', 'ACOMAYO', '0802', '08', 'ACOMAYO');
INSERT INTO provincia VALUES ('69', '8', 'ANTA', '0803', '08', 'ANTA');
INSERT INTO provincia VALUES ('70', '8', 'CALCA', '0804', '08', 'CALCA');
INSERT INTO provincia VALUES ('71', '8', 'CANAS', '0805', '08', 'YANAOCA');
INSERT INTO provincia VALUES ('72', '8', 'CANCHIS', '0806', '08', 'SICUANI');
INSERT INTO provincia VALUES ('73', '8', 'CHUMBIVILCAS', '0807', '08', 'SANTO TOMAS');
INSERT INTO provincia VALUES ('74', '8', 'ESPINAR', '0808', '08', 'ESPINAR (YAURI)');
INSERT INTO provincia VALUES ('75', '8', 'LA CONVENCION', '0809', '08', 'QUILLABAMBA');
INSERT INTO provincia VALUES ('76', '8', 'PARURO', '0810', '08', 'PARURO');
INSERT INTO provincia VALUES ('77', '8', 'PAUCARTAMBO', '0811', '08', 'PAUCARTAMBO');
INSERT INTO provincia VALUES ('78', '8', 'QUISPICANCHI', '0812', '08', 'URCOS');
INSERT INTO provincia VALUES ('79', '8', 'URUBAMBA', '0813', '08', 'URUBAMBA');
INSERT INTO provincia VALUES ('80', '9', 'HUANCAVELICA', '0901', '09', 'HUANCAVELICA');
INSERT INTO provincia VALUES ('81', '9', 'ACOBAMBA', '0902', '09', 'ACOBAMBA');
INSERT INTO provincia VALUES ('82', '9', 'ANGARES', '0903', '09', 'LIRCAY');
INSERT INTO provincia VALUES ('83', '9', 'CASTROVIRREYNA', '0904', '09', 'CASTROVIRREYNA');
INSERT INTO provincia VALUES ('84', '9', 'CHURCAMPA', '0905', '09', 'CHURCAMPA');
INSERT INTO provincia VALUES ('85', '9', 'HUAYTARA', '0906', '09', 'HUAYTARA');
INSERT INTO provincia VALUES ('86', '9', 'TAYACAJA', '0907', '09', 'PAMPAS');
INSERT INTO provincia VALUES ('87', '10', 'HUANUCO', '1001', '10', 'HUANUCO');
INSERT INTO provincia VALUES ('88', '10', 'AMBO', '1002', '10', 'AMBO');
INSERT INTO provincia VALUES ('89', '10', 'DOS DE MAYO', '1003', '10', 'LA UNION');
INSERT INTO provincia VALUES ('90', '10', 'HUACAYBAMBA', '1004', '10', 'HUACAYBAMBA');
INSERT INTO provincia VALUES ('91', '10', 'HUAMALIES', '1005', '10', 'LLATA');
INSERT INTO provincia VALUES ('92', '10', 'LEONCIO PRADO', '1006', '10', 'TINGO MARIA');
INSERT INTO provincia VALUES ('93', '10', 'MARAÃ‘ON', '1007', '10', 'HUACRACHUCO');
INSERT INTO provincia VALUES ('94', '10', 'PACHITEA', '1008', '10', 'PANAO');
INSERT INTO provincia VALUES ('95', '10', 'PUERTO INCA', '1009', '10', 'PUERTO INCA');
INSERT INTO provincia VALUES ('96', '10', 'LAURICOCHA', '1010', '10', 'JESUS');
INSERT INTO provincia VALUES ('97', '10', 'YAROWILCA', '1011', '10', 'CHAVINILLO');
INSERT INTO provincia VALUES ('98', '11', 'ICA', '1101', '11', 'ICA');
INSERT INTO provincia VALUES ('99', '11', 'CHINCHA', '1102', '11', 'CHINCHA ALTA');
INSERT INTO provincia VALUES ('100', '11', 'NAZCA', '1103', '11', 'NAZCA');
INSERT INTO provincia VALUES ('101', '11', 'PALPA', '1104', '11', 'PALPA');
INSERT INTO provincia VALUES ('102', '11', 'PISCO', '1105', '11', 'PISCO');
INSERT INTO provincia VALUES ('103', '12', 'HUANCAYO', '1201', '12', 'HUANCAYO');
INSERT INTO provincia VALUES ('104', '12', 'CONCEPCION', '1202', '12', 'CONCEPCION');
INSERT INTO provincia VALUES ('105', '12', 'CHANCHAMAYO', '1203', '12', 'LA MERCED');
INSERT INTO provincia VALUES ('106', '12', 'JAUJA', '1204', '12', 'JAUJA');
INSERT INTO provincia VALUES ('107', '12', 'JUNIN', '1205', '12', 'JUNIN');
INSERT INTO provincia VALUES ('108', '12', 'SATIPO', '1206', '12', 'SATIPO');
INSERT INTO provincia VALUES ('109', '12', 'TARMA', '1207', '12', 'TARMA');
INSERT INTO provincia VALUES ('110', '12', 'YAULI', '1208', '12', 'LA OROYA');
INSERT INTO provincia VALUES ('111', '12', 'CHUPACA', '1209', '12', 'CHUPACA');
INSERT INTO provincia VALUES ('112', '13', 'TRUJILLO', '1301', '13', 'TRUJILLO');
INSERT INTO provincia VALUES ('113', '13', 'ASCOPE', '1302', '13', 'ASCOPE');
INSERT INTO provincia VALUES ('114', '13', 'BOLIVAR', '1303', '13', 'BOLIVAR');
INSERT INTO provincia VALUES ('115', '13', 'CHEPEN', '1304', '13', 'CHEPEN');
INSERT INTO provincia VALUES ('116', '13', 'JULCAN', '1305', '13', 'JULCAN');
INSERT INTO provincia VALUES ('117', '13', 'OTUZCO', '1306', '13', 'OTUZCO');
INSERT INTO provincia VALUES ('118', '13', 'PACASMAYO', '1307', '13', 'SAN PEDRO DE LLOC');
INSERT INTO provincia VALUES ('119', '13', 'PATAZ', '1308', '13', 'TAYABAMBA');
INSERT INTO provincia VALUES ('120', '13', 'SANCHEZ CARRION', '1309', '13', 'HUAMACHUCO');
INSERT INTO provincia VALUES ('121', '13', 'SANTIAGO DE CHUCO', '1310', '13', 'SANTIAGO DE CHUCO');
INSERT INTO provincia VALUES ('122', '13', 'GRAN CHIMU', '1311', '13', 'CASCAS');
INSERT INTO provincia VALUES ('123', '13', 'VIRU', '1312', '13', 'VIRU');
INSERT INTO provincia VALUES ('124', '14', 'CHICLAYO', '1401', '14', 'CHICLAYO');
INSERT INTO provincia VALUES ('125', '14', 'FERREÃ‘AFE', '1402', '14', 'FERRENAFE');
INSERT INTO provincia VALUES ('126', '14', 'LAMBAYEQUE', '1403', '14', 'LAMBAYEQUE');
INSERT INTO provincia VALUES ('127', '15', 'LIMA', '1501', '15', 'LIMA');
INSERT INTO provincia VALUES ('128', '15', 'BARRANCA', '1502', '15', 'BARRANCA');
INSERT INTO provincia VALUES ('129', '15', 'CAJATAMBO', '1503', '15', 'CAJATAMBO');
INSERT INTO provincia VALUES ('130', '15', 'CANTA', '1504', '15', 'CANTA');
INSERT INTO provincia VALUES ('131', '15', 'CANETE', '1505', '15', 'SAN VICENTE DE CANETE');
INSERT INTO provincia VALUES ('132', '15', 'HUARAL', '1506', '15', 'HUARAL');
INSERT INTO provincia VALUES ('133', '15', 'HUAROCHIRI', '1507', '15', 'MATUCANA');
INSERT INTO provincia VALUES ('134', '15', 'HUAURA', '1508', '15', 'HUACHO');
INSERT INTO provincia VALUES ('135', '15', 'OYON', '1509', '15', 'OYON');
INSERT INTO provincia VALUES ('136', '15', 'YAUYOS', '1510', '15', 'YAUYOS');
INSERT INTO provincia VALUES ('137', '16', 'MAYNAS', '1601', '16', 'IQUITOS');
INSERT INTO provincia VALUES ('138', '16', 'ALTO AMAZONAS', '1602', '16', 'YURIMAGUAS');
INSERT INTO provincia VALUES ('139', '16', 'LORETO', '1603', '16', 'NAUTA');
INSERT INTO provincia VALUES ('140', '16', 'MARISCAL RAMON CASTILLA', '1604', '16', 'CABALLOCOCHA');
INSERT INTO provincia VALUES ('141', '16', 'REQUENA', '1605', '16', 'REQUENA');
INSERT INTO provincia VALUES ('142', '16', 'UCAYALI', '1606', '16', 'CONTAMANA');
INSERT INTO provincia VALUES ('143', '16', 'DATEM DEM MARAÃ‘ON', '1607', '16', 'SAN LORENZO');
INSERT INTO provincia VALUES ('144', '17', 'TAMBOPATA', '1701', '17', 'PUERTO MALDONADO');
INSERT INTO provincia VALUES ('145', '17', 'MANU', '1702', '17', 'SALVACION');
INSERT INTO provincia VALUES ('146', '17', 'TAHUAMANU', '1703', '17', 'INAPARI');
INSERT INTO provincia VALUES ('147', '18', 'MARISCAL NIETO', '1801', '18', 'MOQUEGUA');
INSERT INTO provincia VALUES ('148', '18', 'GENERAL SANCHEZ CERRO', '1802', '18', 'OMATE');
INSERT INTO provincia VALUES ('149', '18', 'ILO', '1803', '18', 'ILO');
INSERT INTO provincia VALUES ('150', '19', 'PASCO', '1901', '19', 'CERRO DE PASCO');
INSERT INTO provincia VALUES ('151', '19', 'DANIEL ALCIDES CARRION', '1902', '19', 'YANAHUANCA');
INSERT INTO provincia VALUES ('152', '19', 'OXAPAMPA', '1903', '19', 'OXAPAMPA');
INSERT INTO provincia VALUES ('153', '20', 'PIURA', '2001', '20', 'PIURA');
INSERT INTO provincia VALUES ('154', '20', 'AYABACA', '2002', '20', 'AYABACA');
INSERT INTO provincia VALUES ('155', '20', 'HUANCABAMBA', '2003', '20', 'HUANCABAMBA');
INSERT INTO provincia VALUES ('156', '20', 'MORROPON', '2004', '20', 'CHULUCANAS');
INSERT INTO provincia VALUES ('157', '20', 'PAITA', '2005', '20', 'PAITA');
INSERT INTO provincia VALUES ('158', '20', 'SULLANA', '2006', '20', 'SULLANA');
INSERT INTO provincia VALUES ('159', '20', 'TALARA', '2007', '20', 'TALARA');
INSERT INTO provincia VALUES ('160', '20', 'SECHURA', '2008', '20', 'SECHURA');
INSERT INTO provincia VALUES ('161', '21', 'PUNO', '2101', '21', 'PUNO');
INSERT INTO provincia VALUES ('162', '21', 'AZANGARO', '2102', '21', 'AZANGARO');
INSERT INTO provincia VALUES ('163', '21', 'CARABAYA', '2103', '21', 'MACUSANI');
INSERT INTO provincia VALUES ('164', '21', 'CHUCUITO', '2104', '21', 'JULI');
INSERT INTO provincia VALUES ('165', '21', 'EL COLLAO', '2105', '21', 'ILAVE');
INSERT INTO provincia VALUES ('166', '21', 'HUANCANE', '2106', '21', 'HUANCANE');
INSERT INTO provincia VALUES ('167', '21', 'LAMPA', '2107', '21', 'LAMPA');
INSERT INTO provincia VALUES ('168', '21', 'MELGAR', '2108', '21', 'AYAVIRI');
INSERT INTO provincia VALUES ('169', '21', 'MOHO', '2109', '21', 'MOHO');
INSERT INTO provincia VALUES ('170', '21', 'SAN ANTONIO DE PUTINA', '2110', '21', 'PUTINA');
INSERT INTO provincia VALUES ('171', '21', 'SAN ROMAN', '2111', '21', 'JULIACA');
INSERT INTO provincia VALUES ('172', '21', 'SANDIA', '2112', '21', 'SANDIA');
INSERT INTO provincia VALUES ('173', '21', 'YUNGUYO', '2113', '21', 'YUNGUYO');
INSERT INTO provincia VALUES ('174', '22', 'MOYOBAMBA', '2201', '22', 'MOYOBAMBA');
INSERT INTO provincia VALUES ('175', '22', 'BELLAVISTA', '2202', '22', 'BELLAVISTA');
INSERT INTO provincia VALUES ('176', '22', 'EL DORADO', '2203', '22', 'SAN JOSE DE SISA');
INSERT INTO provincia VALUES ('177', '22', 'HUALLAGA', '2204', '22', 'SAPOSOA');
INSERT INTO provincia VALUES ('178', '22', 'LAMAS', '2205', '22', 'LAMAS');
INSERT INTO provincia VALUES ('179', '22', 'MARISCAL CACERES', '2206', '22', 'JUANJUI');
INSERT INTO provincia VALUES ('180', '22', 'PICOTA', '2207', '22', 'PICOTA');
INSERT INTO provincia VALUES ('181', '22', 'RIOJA', '2208', '22', 'RIOJA');
INSERT INTO provincia VALUES ('182', '22', 'SAN MARTIN', '2209', '22', 'TARAPOTO');
INSERT INTO provincia VALUES ('183', '22', 'TOCACHE', '2210', '22', 'TOCACHE NUEVO');
INSERT INTO provincia VALUES ('184', '23', 'TACNA', '2301', '23', 'TACNA');
INSERT INTO provincia VALUES ('185', '23', 'CANDARAVE', '2302', '23', 'CANDARAVE');
INSERT INTO provincia VALUES ('186', '23', 'JORGE BASADRE', '2303', '23', 'LOCUMBA');
INSERT INTO provincia VALUES ('187', '23', 'TARATA', '2304', '23', 'TARATA');
INSERT INTO provincia VALUES ('188', '24', 'TUMBES', '2401', '24', 'TUMBES');
INSERT INTO provincia VALUES ('189', '24', 'CONTRALMIRANTE VILLAR', '2402', '24', 'ZORRITOS');
INSERT INTO provincia VALUES ('190', '24', 'ZARUMILLA', '2403', '24', 'ZARUMILLA');
INSERT INTO provincia VALUES ('191', '25', 'CORONEL PORTILLO', '2501', '25', 'PUCALLPA');
INSERT INTO provincia VALUES ('192', '25', 'ATALAYA', '2502', '25', 'ATALAYA');
INSERT INTO provincia VALUES ('193', '25', 'PADRE ABAD', '2503', '25', 'AGUAYTIA');
INSERT INTO provincia VALUES ('194', '25', 'PURUS', '2504', '25', 'ESPERANZA');
INSERT INTO provincia VALUES ('195', '3', 'GRAU', '0307', '03', 'CHUQUIBAMBILLA');
INSERT INTO provincia VALUES ('196', '16', 'PUTUMAYO', '1608', '16', '');
-- 
--  Table structure for table `red`
-- 

CREATE TABLE `red` (
  `idred` int(10) unsigned NOT NULL,
  `iddiresa` int(11) NOT NULL,
  `idprovincia` int(10) unsigned DEFAULT NULL,
  `nombreRed` varchar(100) DEFAULT NULL,
  `codigoDiresa` char(3) NOT NULL,
  `codigoRed` char(3) NOT NULL,
  PRIMARY KEY (`idred`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- Dumping data for table `red`

INSERT INTO red VALUES ('1', '1', '80', 'RED HUANCAVELICA', '13', '01');
INSERT INTO red VALUES ('2', '1', '81', 'RED ACOBAMBA', '13', '02');
INSERT INTO red VALUES ('3', '1', '86', 'RED TAYACAJA', '13', '03');
INSERT INTO red VALUES ('4', '1', '82', 'RED ANGARES', '13', '04');
INSERT INTO red VALUES ('5', '1', '83', 'RED CASTROVIRREYNA', '13', '05');
INSERT INTO red VALUES ('6', '1', '84', 'RED CHURCAMPA', '13', '06');
INSERT INTO red VALUES ('7', '1', '85', 'RED HUAYTARA', '13', '07');
INSERT INTO red VALUES ('8', '2', '1', 'RED CHACHAPOYAS', '01', '01');
INSERT INTO red VALUES ('9', '2', '2', 'RED BAGUA', '01', '02');
INSERT INTO red VALUES ('10', '2', '7', 'RED UTCUBAMBA', '01', '03');
INSERT INTO red VALUES ('11', '2', '4', 'RED CONDORCANQUI', '01', '04');
INSERT INTO red VALUES ('12', '3', '25', 'RED HUAYLAS SUR', '', '');
INSERT INTO red VALUES ('13', '3', '19', 'RED HUAYLAS NORTE', '', '');
INSERT INTO red VALUES ('14', '3', '25', 'RED PACIFICO SUR', '', '');
INSERT INTO red VALUES ('15', '3', '25', 'RED PACIFICO NORTE', '', '');
INSERT INTO red VALUES ('16', '3', '17', 'RED CONCHUCOS SUR', '', '');
INSERT INTO red VALUES ('17', '3', '23', 'RED CONCHUCOS NORTE', '', '');
INSERT INTO red VALUES ('18', '4', '28', 'RED ABANCAY', '', '');
INSERT INTO red VALUES ('19', '4', '195', 'RED GRAU', '', '');
INSERT INTO red VALUES ('20', '4', '29', 'RED SONDOR', '', '');
INSERT INTO red VALUES ('21', '4', '33', 'RED COCHARCAS', '', '');
INSERT INTO red VALUES ('22', '4', '29', 'RED JOSE MARIA ARGUEDAS', '', '');
INSERT INTO red VALUES ('23', '4', '30', 'RED ANTABAMBA', '', '');
INSERT INTO red VALUES ('24', '4', '31', 'RED AYMARAES', '', '');
INSERT INTO red VALUES ('25', '4', '32', 'RED COTABAMBAS', '', '');
INSERT INTO red VALUES ('26', '5', '35', 'RED CAMANA CARAVELLI', '', '');
INSERT INTO red VALUES ('27', '5', '41', 'RED CASTILLA CONDESUYOS - LA UNION', '', '');
INSERT INTO red VALUES ('28', '5', '38', 'RED AREQUIPA CAYLLOMA', '', '');
INSERT INTO red VALUES ('29', '5', '40', 'RED ISLAY', '', '');
INSERT INTO red VALUES ('30', '6', '42', 'RED HUAMANGA', '', '');
INSERT INTO red VALUES ('31', '6', '45', 'RED HUANTA', '', '');
INSERT INTO red VALUES ('32', '6', '46', 'RED SAN MIGUEL', '', '');
INSERT INTO red VALUES ('33', '6', '42', 'RED SAN FRANCISCO', '', '');
INSERT INTO red VALUES ('34', '6', '42', 'RED AYACUCHO CENTRO', '', '');
INSERT INTO red VALUES ('35', '6', '48', 'RED CORACORA', '', '');
INSERT INTO red VALUES ('36', '6', '47', 'RED LUCANAS', '', '');
INSERT INTO red VALUES ('37', '8', '53', 'RED CAJAMARCA', '', '');
INSERT INTO red VALUES ('38', '8', '55', 'RED CELENDIN', '', '');
INSERT INTO red VALUES ('39', '8', '54', 'RED CAJABAMBA', '', '');
INSERT INTO red VALUES ('40', '8', '57', 'RED CONTUMAZA', '', '');
INSERT INTO red VALUES ('41', '8', '62', 'RED SAN MARCOS', '', '');
INSERT INTO red VALUES ('42', '8', '63', 'RED SAN MIGUEL', '', '');
INSERT INTO red VALUES ('43', '8', '64', 'RED SAN PABLO', '', '');
INSERT INTO red VALUES ('44', '8', '56', 'RED CHOTA', '', '');
INSERT INTO red VALUES ('45', '8', '59', 'RED BAMBAMARCA', '', '');
INSERT INTO red VALUES ('46', '8', '65', 'RED SANTA CRUZ', '', '');
INSERT INTO red VALUES ('47', '8', '58', 'RED CUTERVO', '', '');
INSERT INTO red VALUES ('48', '8', '58', 'RED SOCOTA', '', '');
INSERT INTO red VALUES ('49', '8', '60', 'RED JAEN', '', '');
INSERT INTO red VALUES ('50', '8', '61', 'RED SAN IGNACIO', '', '');
INSERT INTO red VALUES ('51', '9', '66', 'RED BONILLA - LA PUNTA', '', '');
INSERT INTO red VALUES ('52', '9', '66', 'RED BEPECA', '', '');
INSERT INTO red VALUES ('53', '9', '66', 'RED VENTANILLA', '', '');
INSERT INTO red VALUES ('54', '12', '67', 'RED CUSCO SUR', '', '');
INSERT INTO red VALUES ('55', '12', '67', 'RED CUSCO NORTE', '', '');
INSERT INTO red VALUES ('56', '12', '75', 'RED LA CONVENCION', '', '');
INSERT INTO red VALUES ('57', '12', '72', 'RED CANAS-CANCHIS-ESPINAR', '', '');
INSERT INTO red VALUES ('58', '12', '75', 'RED KIMBIRI PICHARI', '', '');
INSERT INTO red VALUES ('59', '14', '87', 'RED HUANUCO', '', '');
INSERT INTO red VALUES ('60', '14', '93', 'RED MARANON', '', '');
INSERT INTO red VALUES ('61', '14', '92', 'RED LEONCIO PRADO', '', '');
INSERT INTO red VALUES ('62', '14', '89', 'RED DOS DE MAYO', '', '');
INSERT INTO red VALUES ('63', '14', '91', 'RED HUAMALIES', '', '');
INSERT INTO red VALUES ('64', '14', '88', 'RED AMBO (RED FUNCIONAL)', '', '');
INSERT INTO red VALUES ('65', '14', '95', 'RED PUERTO INCA (RED FUNCIONAL)', '', '');
INSERT INTO red VALUES ('66', '14', '96', 'RED LAURICOCHA (RED FUNCIONAL)', '', '');
INSERT INTO red VALUES ('67', '14', '90', 'RED HUACAYBAMBA (RED FUNCIONAL)', '', '');
INSERT INTO red VALUES ('68', '14', '97', 'RED YAROWILCA', '', '');
INSERT INTO red VALUES ('69', '14', '94', 'RED PACHITEA (RED FUNCIONAL)', '', '');
INSERT INTO red VALUES ('70', '14', '88', 'RED AMBO', '', '');
INSERT INTO red VALUES ('71', '15', '98', 'RED ICA-PALPA-NAZCA', '', '');
INSERT INTO red VALUES ('72', '15', '102', 'RED CHINCHA - PISCO', '', '');
INSERT INTO red VALUES ('73', '17', '103', 'RED VALLE DEL MANTARO', '', '');
INSERT INTO red VALUES ('74', '17', '106', 'RED JAUJA', '', '');
INSERT INTO red VALUES ('75', '17', '109', 'RED TARMA', '', '');
INSERT INTO red VALUES ('76', '17', '105', 'RED CHANCHAMAYO', '', '');
INSERT INTO red VALUES ('77', '17', '108', 'RED SATIPO', '', '');
INSERT INTO red VALUES ('78', '17', '107', 'RED JUNIN', '', '');
INSERT INTO red VALUES ('79', '18', '115', 'RED CHEPEN', '', '');
INSERT INTO red VALUES ('80', '18', '113', 'RED ASCOPE', '', '');
INSERT INTO red VALUES ('81', '18', '117', 'RED OTUZCO', '', '');
INSERT INTO red VALUES ('82', '18', '118', 'RED PACASMAYO', '', '');
INSERT INTO red VALUES ('83', '18', '112', 'RED TRUJILLO', '', '');
INSERT INTO red VALUES ('84', '18', '123', 'RED VIRU', '', '');
INSERT INTO red VALUES ('85', '18', '122', 'RED GRAN CHIMU', '', '');
INSERT INTO red VALUES ('86', '18', '114', 'RED BOLIVAR', '', '');
INSERT INTO red VALUES ('87', '18', '119', 'RED PATAZ', '', '');
INSERT INTO red VALUES ('88', '18', '120', 'RED SANCHEZ CARRION', '', '');
INSERT INTO red VALUES ('89', '18', '121', 'RED SANTIAGO DE CHUCO', '', '');
INSERT INTO red VALUES ('90', '18', '116', 'RED JULCAN', '', '');
INSERT INTO red VALUES ('91', '19', '124', 'RED CHICLAYO', '', '');
INSERT INTO red VALUES ('92', '19', '125', 'RED FERRENAFE', '', '');
INSERT INTO red VALUES ('93', '19', '126', 'RED LAMBAYEQUE', '', '');
INSERT INTO red VALUES ('95', '20', '127', 'RED LIMA CIUDAD', '', '');
INSERT INTO red VALUES ('96', '20', '127', 'RED TUPAC AMARU', '', '');
INSERT INTO red VALUES ('97', '20', '127', 'RED V RIMAC-SMP-LO', '', '');
INSERT INTO red VALUES ('98', '20', '127', 'RED DE SALUD LIMA NORTE IV', '', '');
INSERT INTO red VALUES ('99', '21', '127', 'RED LIMA ESTE METROPOLITANA', '', '');
INSERT INTO red VALUES ('100', '21', '127', 'RED SAN JUAN DE LURIGANCHO', '', '');
INSERT INTO red VALUES ('101', '22', '129', 'RED I BARRANCA - CAJATAMBO', '', '');
INSERT INTO red VALUES ('102', '22', '135', 'RED II HUAURA - OYON', '', '');
INSERT INTO red VALUES ('103', '22', '132', 'RED III HUARAL - CHANCAY', '', '');
INSERT INTO red VALUES ('104', '22', '128', 'RED VI TUPAC AMARU', '', '');
INSERT INTO red VALUES ('105', '22', '136', 'RED VII CANETE - YAUYOS', '', '');
INSERT INTO red VALUES ('106', '22', '128', 'RED VIII CHILCA - MALA', '', '');
INSERT INTO red VALUES ('107', '22', '133', 'RED IX HUAROCHIRI', '', '');
INSERT INTO red VALUES ('108', '22', '130', 'RED CANTA', '', '');
INSERT INTO red VALUES ('109', '23', '127', 'RED BARRANCO - CHORRILLOS - SURCO', '', '');
INSERT INTO red VALUES ('110', '23', '127', 'RED SAN JUAN DE MIRAFLORES - VILLA MARIA', '', '');
INSERT INTO red VALUES ('111', '23', '127', 'RED VILLA EL SALVADOR - LURIN - PACHACAM', '', '');
INSERT INTO red VALUES ('112', '24', '137', 'RED MAYNAS CIUDAD', '', '');
INSERT INTO red VALUES ('113', '24', '137', 'RED MAYNAS PERIFERIE', '', '');
INSERT INTO red VALUES ('114', '24', '140', 'RED RAMON CASTILLA', '', '');
INSERT INTO red VALUES ('115', '24', '139', 'RED LORETO', '', '');
INSERT INTO red VALUES ('116', '24', '142', 'RED UCAYALI', '', '');
INSERT INTO red VALUES ('117', '24', '141', 'RED REQUENA', '', '');
INSERT INTO red VALUES ('118', '24', '138', 'RED ALTO AMAZONAS', '', '');
INSERT INTO red VALUES ('119', '24', '143', 'RED DATEM DEL MARANON', '', '');
INSERT INTO red VALUES ('120', '25', '145', 'RED MADRE DE DIOS', '', '');
INSERT INTO red VALUES ('121', '26', '147', 'RED MOQUEGUA', '', '');
INSERT INTO red VALUES ('122', '26', '149', 'RED ILO', '', '');
INSERT INTO red VALUES ('123', '27', '150', 'RED PASCO', '', '');
INSERT INTO red VALUES ('124', '27', '151', 'RED DANIEL CARRION', '', '');
INSERT INTO red VALUES ('125', '27', '152', 'RED OXAPAMPA', '', '');
INSERT INTO red VALUES ('126', '28', '153', 'RED PIURA CASTILLA', '', '');
INSERT INTO red VALUES ('127', '28', '153', 'RED BAJO PIURA', '', '');
INSERT INTO red VALUES ('128', '28', '156', 'RED MORROPON CHULUCANAS', '', '');
INSERT INTO red VALUES ('129', '28', '155', 'RED HUANCABAMBA', '', '');
INSERT INTO red VALUES ('130', '28', '155', 'RED HUARMACA', '', '');
INSERT INTO red VALUES ('131', '28', '158', 'RED SULLANA', '', '');
INSERT INTO red VALUES ('132', '28', '154', 'RED AYABACA', '', '');
INSERT INTO red VALUES ('133', '29', '161', 'RED PUNO', '', '');
INSERT INTO red VALUES ('134', '29', '162', 'RED AZANGARO', '', '');
INSERT INTO red VALUES ('135', '29', '172', 'RED SANDIA', '', '');
INSERT INTO red VALUES ('136', '29', '173', 'RED YUNGUYO', '', '');
INSERT INTO red VALUES ('137', '29', '163', 'RED MACUSANI', '', '');
INSERT INTO red VALUES ('138', '29', '164', 'RED CHUCUITO', '', '');
INSERT INTO red VALUES ('139', '29', '165', 'RED COLLAO', '', '');
INSERT INTO red VALUES ('140', '29', '166', 'RED HUANCANE', '', '');
INSERT INTO red VALUES ('141', '29', '167', 'RED LAMPA', '', '');
INSERT INTO red VALUES ('142', '29', '168', 'RED MELGAR', '', '');
INSERT INTO red VALUES ('143', '29', '171', 'RED SAN ROMAN', '', '');
INSERT INTO red VALUES ('144', '30', '182', 'RED SAN MARTIN', '', '');
INSERT INTO red VALUES ('145', '30', '178', 'RED LAMAS', '', '');
INSERT INTO red VALUES ('146', '30', '176', 'RED EL DORADO', '', '');
INSERT INTO red VALUES ('147', '30', '180', 'RED PICOTA', '', '');
INSERT INTO red VALUES ('148', '30', '174', 'RED MOYOBAMBA', '', '');
INSERT INTO red VALUES ('149', '30', '181', 'RED RIOJA', '', '');
INSERT INTO red VALUES ('150', '30', '179', 'RED MARISCAL CACERES', '', '');
INSERT INTO red VALUES ('151', '30', '177', 'RED HUALLAGA', '', '');
INSERT INTO red VALUES ('152', '30', '175', 'RED BELLAVISTA', '', '');
INSERT INTO red VALUES ('153', '30', '183', 'RED TOCACHE', '', '');
INSERT INTO red VALUES ('154', '32', '184', 'RED TACNA', '', '');
INSERT INTO red VALUES ('155', '33', '188', 'RED TUMBES', '', '');
INSERT INTO red VALUES ('156', '34', '191', 'RED CORONEL  PORTILLO', '', '');
INSERT INTO red VALUES ('157', '34', '191', 'RED FEDERICO BASADRE - YARINACOCHA', '', '');
INSERT INTO red VALUES ('158', '34', '192', 'RED ATALAYA', '', '');
INSERT INTO red VALUES ('159', '34', '193', 'RED AGUAYTIA', '', '');
-- 
--  Table structure for table `referencia`
-- 

CREATE TABLE `referencia` (
  `idreferencia` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idepisodio` int(10) unsigned DEFAULT NULL,
  `idcatalogoReferencia` int(10) unsigned DEFAULT NULL,
  `nombreReferencia` varchar(100) DEFAULT NULL,
  `idcatalogoUPS` int(10) unsigned DEFAULT NULL,
  `nombreCatalogo` text,
  `fechaIngreso` date DEFAULT NULL,
  `idtrabajadorReferencia` int(10) unsigned DEFAULT NULL,
  `idtrabajadorResponsable` int(10) unsigned DEFAULT NULL,
  `idtrabajadorCompania` int(10) unsigned DEFAULT NULL,
  `condicionRecepcion` varchar(100) DEFAULT NULL,
  `fechaRecepcion` date DEFAULT NULL,
  `responsableRecepcion` varchar(100) DEFAULT NULL,
  `colegiaturaRecepcion` varchar(100) DEFAULT NULL,
  `idprofesionRecepcion` int(10) unsigned DEFAULT NULL,
  `condicionPaciente` varchar(30) DEFAULT NULL,
  `estadoReferencia` varchar(100) NOT NULL,
  `fechaReingreso` date DEFAULT NULL,
  `iddiagnostico1` int(10) unsigned DEFAULT NULL,
  `diagnostico1` varchar(100) DEFAULT NULL,
  `iddiagnostico2` int(10) unsigned DEFAULT NULL,
  `diagnostico2` varchar(100) DEFAULT NULL,
  `iddiagnostico3` int(10) unsigned DEFAULT NULL,
  `diagnostico3` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idreferencia`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `referencia`

-- 
--  Table structure for table `region`
-- 

CREATE TABLE `region` (
  `idregion` int(10) unsigned NOT NULL,
  `nombreRegion` varchar(100) DEFAULT NULL,
  `codigoRegion` char(2) NOT NULL,
  PRIMARY KEY (`idregion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- Dumping data for table `region`

INSERT INTO region VALUES ('1', 'AMAZONAS', '01');
INSERT INTO region VALUES ('2', 'ANCASH', '02');
INSERT INTO region VALUES ('3', 'APURIMAC', '03');
INSERT INTO region VALUES ('4', 'AREQUIPA', '04');
INSERT INTO region VALUES ('5', 'AYACUCHO', '05');
INSERT INTO region VALUES ('6', 'CAJAMARCA', '06');
INSERT INTO region VALUES ('7', 'PROV.CONST. DEL CALLAO', '07');
INSERT INTO region VALUES ('8', 'CUSCO', '08');
INSERT INTO region VALUES ('9', 'HUANCAVELICA', '09');
INSERT INTO region VALUES ('10', 'HUANUCO', '10');
INSERT INTO region VALUES ('11', 'ICA', '11');
INSERT INTO region VALUES ('12', 'JUNIN', '12');
INSERT INTO region VALUES ('13', 'LA LIBERTAD', '13');
INSERT INTO region VALUES ('14', 'LAMBAYEQUE', '14');
INSERT INTO region VALUES ('15', 'LIMA', '15');
INSERT INTO region VALUES ('16', 'LORETO', '16');
INSERT INTO region VALUES ('17', 'MADRE DE DIOS', '17');
INSERT INTO region VALUES ('18', 'MOQUEGUA', '18');
INSERT INTO region VALUES ('19', 'PASCO', '19');
INSERT INTO region VALUES ('20', 'PIURA', '20');
INSERT INTO region VALUES ('21', 'PUNO', '21');
INSERT INTO region VALUES ('22', 'SAN MARTIN', '22');
INSERT INTO region VALUES ('23', 'TACNA', '23');
INSERT INTO region VALUES ('24', 'TUMBES', '24');
INSERT INTO region VALUES ('25', 'UCAYALI', '25');
-- 
--  Table structure for table `riesgo`
-- 

CREATE TABLE `riesgo` (
  `idriesgo` int(10) unsigned NOT NULL,
  `idpersona` int(10) unsigned DEFAULT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idfamilia` int(10) unsigned DEFAULT NULL,
  `etapa` varchar(100) DEFAULT NULL,
  `nombreRiesgo` varchar(100) DEFAULT NULL,
  `codriesgo` int(10) unsigned DEFAULT NULL,
  `puntaje` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idriesgo`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `riesgo`

-- 
--  Table structure for table `riesgoh`
-- 

CREATE TABLE `riesgoh` (
  `idriesgoH` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idpersonaH` int(10) unsigned DEFAULT NULL,
  `idfamiliaH` int(10) unsigned DEFAULT NULL,
  `etapa` varchar(100) DEFAULT NULL,
  `nombreRiesgo` varchar(100) DEFAULT NULL,
  `puntaje` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idriesgoH`,`claveGeneral`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- Dumping data for table `riesgoh`

-- 
--  Table structure for table `sector`
-- 

CREATE TABLE `sector` (
  `claveGeneral` varchar(100) NOT NULL,
  `idsector` int(10) unsigned NOT NULL,
  `idcomunidad` int(10) unsigned DEFAULT NULL,
  `nombreSector` varchar(100) DEFAULT NULL,
  `descripcion` text,
  PRIMARY KEY (`claveGeneral`,`idsector`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `sector`

-- 
--  Table structure for table `socioeconomico`
-- 

CREATE TABLE `socioeconomico` (
  `idsocioeconomico` int(10) unsigned NOT NULL,
  `idfamilia` int(10) unsigned DEFAULT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `puntaje` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`idsocioeconomico`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `socioeconomico`

-- 
--  Table structure for table `socioeconomicoh`
-- 

CREATE TABLE `socioeconomicoh` (
  `idsocioeconomicoH` int(10) unsigned NOT NULL,
  `idfamiliaH` int(10) unsigned DEFAULT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `puntaje` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idsocioeconomicoH`,`claveGeneral`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- Dumping data for table `socioeconomicoh`

-- 
--  Table structure for table `tipotransmisiblecie10`
-- 

CREATE TABLE `tipotransmisiblecie10` (
  `idtipoTransmisibleCIE10` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigoTipoTransmisibleCIE10` varchar(10) DEFAULT NULL,
  `nombreTipoTransmisibleCIE10` text,
  PRIMARY KEY (`idtipoTransmisibleCIE10`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `tipotransmisiblecie10`

-- 
--  Table structure for table `trabajador`
-- 

CREATE TABLE `trabajador` (
  `idtrabajador` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idestablecimiento` int(10) unsigned DEFAULT NULL,
  `nombreCompleto` varchar(255) DEFAULT NULL,
  `grupoProfesional` varchar(100) DEFAULT NULL,
  `opcionDocumento` varchar(50) NOT NULL,
  `nroDocumento` varchar(20) NOT NULL,
  `nroColegiatura` varchar(20) NOT NULL,
  `idcatalogoColegio` int(11) NOT NULL,
  `idcondicionTrabajador` int(11) NOT NULL,
  `idprofesion` int(11) NOT NULL,
  PRIMARY KEY (`idtrabajador`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `trabajador`

-- 
--  Table structure for table `trabajadorsector`
-- 

CREATE TABLE `trabajadorsector` (
  `idtrabajadorSector` int(10) unsigned NOT NULL,
  `idtrabajador` int(10) unsigned NOT NULL DEFAULT '0',
  `claveGeneral` varchar(100) NOT NULL,
  `idsector` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idtrabajadorSector`,`claveGeneral`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- Dumping data for table `trabajadorsector`

-- 
--  Table structure for table `tratamientopreventivo`
-- 

CREATE TABLE `tratamientopreventivo` (
  `idtratamientoPreventivo` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idepisodio` int(10) unsigned DEFAULT NULL,
  `tratamiento` varchar(100) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `dosis` varchar(20) DEFAULT NULL,
  `via` varchar(20) DEFAULT NULL,
  `frecuencia` varchar(20) DEFAULT NULL,
  `nroDias` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idtratamientoPreventivo`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `tratamientopreventivo`

-- 
--  Table structure for table `tratamientoresolutivo`
-- 

CREATE TABLE `tratamientoresolutivo` (
  `idtratamientoResolutivo` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idepisodio` int(10) unsigned DEFAULT NULL,
  `idcatalogoMedicamento` int(10) unsigned DEFAULT NULL,
  `nombreCatalogo` text,
  `medicamento` varchar(100) DEFAULT NULL,
  `dosis` varchar(20) DEFAULT NULL,
  `via` varchar(20) DEFAULT NULL,
  `frecuencia` varchar(20) DEFAULT NULL,
  `nroDias` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idtratamientoResolutivo`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `tratamientoresolutivo`

-- 
--  Table structure for table `usuario`
-- 

CREATE TABLE `usuario` (
  `claveGeneral` varchar(100) NOT NULL,
  `idusuario` int(10) unsigned NOT NULL,
  `idtrabajador` int(10) unsigned DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `tipo` char(3) DEFAULT NULL,
  `clave` text,
  `estado` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`claveGeneral`,`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `usuario`

INSERT INTO usuario VALUES ('', '1', '0', 'soporte', 'ADM', '855fa866d6d3f72f6a50bc213244e36d', '1');
-- 
--  Table structure for table `vacuna`
-- 

CREATE TABLE `vacuna` (
  `idvacuna` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idpersona` int(10) unsigned DEFAULT NULL,
  `idcatalogoVacuna` int(10) unsigned DEFAULT NULL,
  `nombreCatalogo` text,
  `estadoVacuna` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idvacuna`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `vacuna`

-- 
--  Table structure for table `variableantropometrica`
-- 

CREATE TABLE `variableantropometrica` (
  `idvariableAntropometrica` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idepisodio` int(10) unsigned DEFAULT NULL,
  `peso` float DEFAULT NULL,
  `talla` float DEFAULT NULL,
  `IMC` float DEFAULT NULL,
  `perimetroCefalico` float DEFAULT NULL,
  `perimetroToracico` float DEFAULT NULL,
  `frecuenciaCardiaca` float DEFAULT NULL,
  `frecuenciaRespiratoria` float DEFAULT NULL,
  `temperatura` float DEFAULT NULL,
  `presionArterialNum` float DEFAULT NULL,
  `presionArterialDenom` float DEFAULT NULL,
  `presionArterialMediaNum` int(10) unsigned DEFAULT NULL,
  `presionArterialMediaDenom` int(10) unsigned DEFAULT NULL,
  `perimetroAbdominal` float DEFAULT NULL,
  `pesoPregestacional` float DEFAULT NULL,
  `FUR` date DEFAULT NULL,
  `FPP` date DEFAULT NULL,
  `presionArterialBasalNum` int(10) unsigned DEFAULT NULL,
  `presionArterialBasalDenom` int(10) unsigned DEFAULT NULL,
  `factorRiesgo` float DEFAULT NULL,
  PRIMARY KEY (`idvariableAntropometrica`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `variableantropometrica`

-- 
--  Table structure for table `visita`
-- 

CREATE TABLE `visita` (
  `idvisita` int(10) unsigned NOT NULL,
  `claveGeneral` varchar(100) NOT NULL,
  `idfamilia` int(10) unsigned DEFAULT NULL,
  `idtrabajador` int(10) unsigned DEFAULT NULL,
  `fechavisita` date DEFAULT NULL,
  `resultado` varchar(20) DEFAULT NULL,
  `fechacita` date DEFAULT NULL,
  `estadoCita` varchar(20) DEFAULT NULL,
  `motivo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idvisita`,`claveGeneral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `visita`

-- 
--  Table structure for table `visitah`
-- 

CREATE TABLE `visitah` (
  `idvisitaH` int(10) unsigned NOT NULL,
  `idfamiliaH` int(10) unsigned NOT NULL DEFAULT '0',
  `claveGeneral` varchar(100) NOT NULL,
  `fechaVisita` date DEFAULT NULL,
  `resultado` varchar(20) DEFAULT NULL,
  `fechaCita` date DEFAULT NULL,
  `estadoCita` varchar(20) DEFAULT NULL,
  `motivo` varchar(100) DEFAULT NULL,
  `trabajador` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idvisitaH`,`claveGeneral`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- Dumping data for table `visitah`

-- 
--  Table structure for table `vista`
-- 

CREATE TABLE `vista` (
  `claveGeneral` varchar(100) NOT NULL,
  `idvista` int(10) unsigned NOT NULL,
  `vista` varchar(100) DEFAULT NULL,
  `descripcion` text,
  PRIMARY KEY (`claveGeneral`,`idvista`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `vista`

INSERT INTO vista VALUES ('000004086', '1', 'app', 'Aplicacion del sistema');
INSERT INTO vista VALUES ('000004086', '2', 'adm', 'Administracion del sistema');
-- 
--  Table structure for table `vistausuario`
-- 

CREATE TABLE `vistausuario` (
  `claveGeneral` varchar(100) NOT NULL,
  `idvistausuario` int(10) unsigned NOT NULL,
  `idusuario` int(10) unsigned DEFAULT NULL,
  `idvista` int(10) unsigned DEFAULT NULL,
  `privilegios` text,
  PRIMARY KEY (`claveGeneral`,`idvistausuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Dumping data for table `vistausuario`

INSERT INTO vistausuario VALUES ('000004086', '1', '1', '1', 'index.php');
INSERT INTO vistausuario VALUES ('000004086', '2', '1', '2', 'index.php');
