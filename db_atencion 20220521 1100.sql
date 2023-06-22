-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.22-MariaDB


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema db_hospital
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ db_hospital;
USE db_hospital;

--
-- Table structure for table `db_hospital`.`atencion`
--

DROP TABLE IF EXISTS `atencion`;
CREATE TABLE `atencion` (
  `idatencion` int(11) NOT NULL AUTO_INCREMENT,
  `fech_ate` date NOT NULL,
  `hora_ate` time NOT NULL,
  `peso` decimal(9,2) NOT NULL DEFAULT 0.00,
  `talla` decimal(9,2) NOT NULL DEFAULT 0.00,
  `imc` decimal(9,2) NOT NULL DEFAULT 0.00,
  `temperatura` decimal(9,2) NOT NULL DEFAULT 0.00,
  `presion_art` varchar(45) NOT NULL,
  `frec_cardio` int(11) NOT NULL,
  `satur_o2` int(11) NOT NULL,
  `motivocons` varchar(500) NOT NULL,
  `tiempo_enferm` varchar(45) NOT NULL,
  `diagnostico` varchar(500) NOT NULL,
  `tratamiento` varchar(500) NOT NULL,
  `referencia` varchar(100) DEFAULT NULL,
  `fech_pxcita` date DEFAULT NULL,
  `firma` varchar(100) DEFAULT NULL,
  `idcita` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idatencion`),
  KEY `idcita` (`idcita`),
  CONSTRAINT `atencion_ibfk_2` FOREIGN KEY (`idcita`) REFERENCES `cita` (`idcita`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_hospital`.`atencion`
--

/*!40000 ALTER TABLE `atencion` DISABLE KEYS */;
INSERT INTO `atencion` (`idatencion`,`fech_ate`,`hora_ate`,`peso`,`talla`,`imc`,`temperatura`,`presion_art`,`frec_cardio`,`satur_o2`,`motivocons`,`tiempo_enferm`,`diagnostico`,`tratamiento`,`referencia`,`fech_pxcita`,`firma`,`idcita`) VALUES 
 (4,'2022-05-15','14:50:33','67.00','2.00','26.00','37.00','120/80',120,97,'','','','',NULL,NULL,NULL,3),
 (5,'2022-05-15','15:22:10','70.00','2.00','17.00','37.00','120/80',120,97,'','','','',NULL,NULL,NULL,2),
 (6,'2022-05-15','20:57:23','50.00','2.00','20.00','36.00','120/80',120,97,'','','','',NULL,NULL,NULL,5),
 (7,'2022-05-17','18:35:41','60.00','2.00','20.00','37.00','120/80',120,97,'','','','',NULL,NULL,NULL,6),
 (8,'2022-05-17','19:37:52','68.70','1.80','21.20','35.90','120/80',120,97,'','','','',NULL,NULL,NULL,7),
 (9,'2022-05-19','16:35:13','60.00','1.72','20.28','36.50','120/80',120,97,'DOLOR DE CABEZA, MAREOS Y VISION BORROSA','4','CEFALEA POSTPUNCIóN','FARMACOTERAPIA','','0000-00-00','DR. MARITZA AYALA JARAMILLO',8),
 (10,'2022-05-19','22:11:06','68.00','1.78','21.46','36.80','120/80',120,97,'FIEBRE, DOLOR EN EL ESTOMAGO, SATURACION','7','ANEMIA','FARMACOTERAPIA','','0000-00-00','DR. MARITZA AYALA JARAMILLO',9),
 (11,'2022-05-19','22:04:33','85.00','1.60','33.20','36.00','120/80',120,97,'','','','',NULL,NULL,NULL,10);
INSERT INTO `atencion` (`idatencion`,`fech_ate`,`hora_ate`,`peso`,`talla`,`imc`,`temperatura`,`presion_art`,`frec_cardio`,`satur_o2`,`motivocons`,`tiempo_enferm`,`diagnostico`,`tratamiento`,`referencia`,`fech_pxcita`,`firma`,`idcita`) VALUES 
 (12,'2022-05-19','22:07:32','85.00','1.75','27.76','35.00','120/80',120,97,'','','','',NULL,NULL,NULL,11),
 (13,'2022-05-20','16:30:56','65.00','1.75','21.22','37.00','120/80',120,97,'DOLOR EN LAS MANOS, LUEGO DE CAIDA DE LAS ESCALERAS, CEFALEAS, Y MAREOS, HEMATOMAS ','3','CONTUSIóN/HEMATOMA:','FARMACOTERAPIA','','0000-00-00','DR. PAULINA MARIA JAQUE VILLANUEVA',13),
 (14,'2022-05-20','17:11:00','75.00','1.50','33.33','38.00','120/80',120,95,'DOLOR EN LAS MANOS, LUEGO DE CAIDA DE LAS ESCALERAS, CEFALEAS, Y MAREOS, HEMATOMAS ','3','CONTUSIóN/HEMATOMA:','FARMACOTERAPIA','','0000-00-00','DR. PAULINA MARIA JAQUE VILLANUEVA',17);
/*!40000 ALTER TABLE `atencion` ENABLE KEYS */;


--
-- Table structure for table `db_hospital`.`cita`
--

DROP TABLE IF EXISTS `cita`;
CREATE TABLE `cita` (
  `idcita` int(11) NOT NULL AUTO_INCREMENT,
  `fech_cita` date NOT NULL,
  `hora_cita` time NOT NULL,
  `idpaciente` int(11) NOT NULL,
  `idhorario_especialidad` int(11) NOT NULL DEFAULT 0,
  `idestado` int(11) NOT NULL DEFAULT 0,
  `idpers_adm` int(11) NOT NULL DEFAULT 0,
  `fech_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`idcita`),
  KEY `idpaciente` (`idpaciente`),
  KEY `idhorario_especialidad` (`idhorario_especialidad`),
  KEY `idpers_adm` (`idpers_adm`),
  KEY `idestado` (`idestado`),
  CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`idpaciente`) REFERENCES `paciente` (`idpaciente`),
  CONSTRAINT `cita_ibfk_3` FOREIGN KEY (`idhorario_especialidad`) REFERENCES `horario_especialidad` (`idhorario_especialidad`),
  CONSTRAINT `cita_ibfk_4` FOREIGN KEY (`idpers_adm`) REFERENCES `pers_adm` (`idpers_adm`),
  CONSTRAINT `cita_ibfk_5` FOREIGN KEY (`idestado`) REFERENCES `estado` (`idestado`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_hospital`.`cita`
--

/*!40000 ALTER TABLE `cita` DISABLE KEYS */;
INSERT INTO `cita` (`idcita`,`fech_cita`,`hora_cita`,`idpaciente`,`idhorario_especialidad`,`idestado`,`idpers_adm`,`fech_registro`) VALUES 
 (2,'2022-05-15','08:30:00',1,9,3,1,'0000-00-00 00:00:00'),
 (3,'2022-05-15','08:00:00',4,10,3,1,'2022-05-14 00:00:00'),
 (5,'2022-05-15','08:50:00',9,9,3,1,'2022-05-15 20:46:09'),
 (6,'2022-05-17','08:00:00',9,12,3,1,'2022-05-17 18:34:43'),
 (7,'2022-05-17','08:20:00',10,12,3,1,'2022-05-17 19:37:08'),
 (8,'2022-05-19','08:00:00',3,15,2,1,'2022-05-19 08:52:36'),
 (9,'2022-05-19','08:20:00',4,15,2,1,'2022-05-19 08:52:53'),
 (10,'2022-05-19','08:40:00',10,15,3,1,'2022-05-19 08:53:17'),
 (11,'2022-05-19','08:00:00',9,15,3,1,'2022-05-19 08:53:36'),
 (12,'2022-05-21','08:00:00',12,16,1,1,'2022-05-19 21:50:23'),
 (13,'2022-05-20','08:00:00',12,14,2,1,'2022-05-19 21:51:16'),
 (14,'2022-05-20','08:20:00',9,14,1,1,'2022-05-19 21:51:54'),
 (15,'2022-05-19','15:00:00',9,17,3,1,'2022-05-19 22:06:46'),
 (16,'2022-05-21','08:20:00',4,16,1,1,'2022-05-20 14:49:10'),
 (17,'2022-05-20','08:40:00',4,14,2,1,'2022-05-20 16:23:42');
/*!40000 ALTER TABLE `cita` ENABLE KEYS */;


--
-- Table structure for table `db_hospital`.`consultorio`
--

DROP TABLE IF EXISTS `consultorio`;
CREATE TABLE `consultorio` (
  `idconsultorio` int(11) NOT NULL AUTO_INCREMENT,
  `numcons` varchar(10) NOT NULL,
  `nomcons` varchar(45) NOT NULL,
  PRIMARY KEY (`idconsultorio`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_hospital`.`consultorio`
--

/*!40000 ALTER TABLE `consultorio` DISABLE KEYS */;
INSERT INTO `consultorio` (`idconsultorio`,`numcons`,`nomcons`) VALUES 
 (1,'0001','ECO'),
 (2,'0002','GINE'),
 (3,'0003','MED01'),
 (4,'0004','MED02'),
 (5,'0005','MED03'),
 (6,'0006','NUTRI'),
 (7,'0007','ODON01'),
 (8,'0008','ODON02');
/*!40000 ALTER TABLE `consultorio` ENABLE KEYS */;


--
-- Table structure for table `db_hospital`.`detalle_receta`
--

DROP TABLE IF EXISTS `detalle_receta`;
CREATE TABLE `detalle_receta` (
  `iddetalle_receta` int(11) NOT NULL AUTO_INCREMENT,
  `idmedicina` int(11) NOT NULL,
  `idreceta` int(11) NOT NULL,
  `dias` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `indicacion` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`iddetalle_receta`),
  KEY `idmedicina` (`idmedicina`),
  KEY `idreceta` (`idreceta`),
  CONSTRAINT `detalle_receta_ibfk_1` FOREIGN KEY (`idmedicina`) REFERENCES `medicina` (`idmedicina`),
  CONSTRAINT `detalle_receta_ibfk_2` FOREIGN KEY (`idreceta`) REFERENCES `receta` (`idreceta`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_hospital`.`detalle_receta`
--

/*!40000 ALTER TABLE `detalle_receta` DISABLE KEYS */;
INSERT INTO `detalle_receta` (`iddetalle_receta`,`idmedicina`,`idreceta`,`dias`,`cantidad`,`indicacion`) VALUES 
 (13,1,27,4,12,'1 tableta cada 8 horas por 4 dias'),
 (17,5,28,3,9,'1 TAB CADA 8 HORAS X 3 DIAS'),
 (18,1,29,5,15,'1 TAB DESPUES DE CADA COMIDA POR 5 DIAS'),
 (19,5,29,3,6,'TOMAR CADA VEZ QUE SE TENGA DOLOR DE MANOS Y PIES X 6 DIAS');
/*!40000 ALTER TABLE `detalle_receta` ENABLE KEYS */;


--
-- Table structure for table `db_hospital`.`espec_medico`
--

DROP TABLE IF EXISTS `espec_medico`;
CREATE TABLE `espec_medico` (
  `idespec_medico` int(11) NOT NULL AUTO_INCREMENT,
  `idmedico` int(10) NOT NULL,
  `idespecialidad` int(11) NOT NULL,
  PRIMARY KEY (`idespec_medico`),
  KEY `idmedico` (`idmedico`),
  KEY `idespecialidad` (`idespecialidad`),
  CONSTRAINT `espec_medico_ibfk_1` FOREIGN KEY (`idmedico`) REFERENCES `medico` (`idmedico`),
  CONSTRAINT `espec_medico_ibfk_2` FOREIGN KEY (`idespecialidad`) REFERENCES `especialidad` (`idespecialidad`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_hospital`.`espec_medico`
--

/*!40000 ALTER TABLE `espec_medico` DISABLE KEYS */;
INSERT INTO `espec_medico` (`idespec_medico`,`idmedico`,`idespecialidad`) VALUES 
 (1,1,4),
 (5,4,5),
 (6,6,4);
/*!40000 ALTER TABLE `espec_medico` ENABLE KEYS */;


--
-- Table structure for table `db_hospital`.`especialidad`
--

DROP TABLE IF EXISTS `especialidad`;
CREATE TABLE `especialidad` (
  `idespecialidad` int(11) NOT NULL AUTO_INCREMENT,
  `especialidad` varchar(45) NOT NULL,
  PRIMARY KEY (`idespecialidad`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_hospital`.`especialidad`
--

/*!40000 ALTER TABLE `especialidad` DISABLE KEYS */;
INSERT INTO `especialidad` (`idespecialidad`,`especialidad`) VALUES 
 (1,'Ecografía'),
 (2,'Ginecología'),
 (3,'Medicina Física y Rehabilitación'),
 (4,'Medicina General'),
 (5,'Nutrición '),
 (6,'Odontología'),
 (7,'Obstetricia'),
 (8,'Pediatría'),
 (9,'Psicología');
/*!40000 ALTER TABLE `especialidad` ENABLE KEYS */;


--
-- Table structure for table `db_hospital`.`estado`
--

DROP TABLE IF EXISTS `estado`;
CREATE TABLE `estado` (
  `idestado` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(45) NOT NULL,
  PRIMARY KEY (`idestado`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_hospital`.`estado`
--

/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` (`idestado`,`estado`) VALUES 
 (1,'Registrado'),
 (2,'Atendido'),
 (3,'No Asistió'),
 (4,'Triaje'),
 (6,'Por Recoger'),
 (7,'Recogido'),
 (8,'No Recogido');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;


--
-- Table structure for table `db_hospital`.`hist_clinica`
--

DROP TABLE IF EXISTS `hist_clinica`;
CREATE TABLE `hist_clinica` (
  `idhist_clinica` int(11) NOT NULL AUTO_INCREMENT,
  `num_hc` varchar(20) NOT NULL,
  `establec` varchar(150) NOT NULL DEFAULT '',
  `fech_create` datetime DEFAULT NULL,
  PRIMARY KEY (`idhist_clinica`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_hospital`.`hist_clinica`
--

/*!40000 ALTER TABLE `hist_clinica` DISABLE KEYS */;
INSERT INTO `hist_clinica` (`idhist_clinica`,`num_hc`,`establec`,`fech_create`) VALUES 
 (1,'000001','021601A101 ',NULL),
 (3,'000003','021601A101',NULL),
 (4,'000004','021601A101',NULL),
 (8,'000005','021601A101 RENAES: 0000001765 - HACDP',NULL),
 (9,'000009','021601A101 (RENAES:0000001765-HACDP)',NULL),
 (10,'000010','021601A101 (RENAES:0000001765-HACDP)','2022-05-17 19:36:13'),
 (11,'000011','021601A101 (RENAES:0000001765-HACDP)','2022-05-19 20:42:44'),
 (12,'000012','021601A101 (RENAES:0000001765-HACDP)','2022-05-19 21:43:27');
/*!40000 ALTER TABLE `hist_clinica` ENABLE KEYS */;


--
-- Table structure for table `db_hospital`.`horario`
--

DROP TABLE IF EXISTS `horario`;
CREATE TABLE `horario` (
  `idhorario` int(11) NOT NULL AUTO_INCREMENT,
  `hora_ini` time NOT NULL,
  `hora_fin` time NOT NULL,
  `turno` varchar(45) NOT NULL,
  PRIMARY KEY (`idhorario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_hospital`.`horario`
--

/*!40000 ALTER TABLE `horario` DISABLE KEYS */;
INSERT INTO `horario` (`idhorario`,`hora_ini`,`hora_fin`,`turno`) VALUES 
 (1,'08:00:00','13:00:00','Mañana'),
 (2,'15:00:00','17:00:00','Tarde');
/*!40000 ALTER TABLE `horario` ENABLE KEYS */;


--
-- Table structure for table `db_hospital`.`horario_especialidad`
--

DROP TABLE IF EXISTS `horario_especialidad`;
CREATE TABLE `horario_especialidad` (
  `idhorario_especialidad` int(11) NOT NULL AUTO_INCREMENT,
  `cupos` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idhorario` int(11) NOT NULL,
  `idconsultorio` int(11) NOT NULL DEFAULT 0,
  `idespec_medico` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idhorario_especialidad`),
  KEY `idhorario` (`idhorario`),
  KEY `idconsultorio` (`idconsultorio`),
  KEY `horario_especialidad_ibfk_4` (`idespec_medico`),
  CONSTRAINT `horario_especialidad_ibfk_1` FOREIGN KEY (`idhorario`) REFERENCES `horario` (`idhorario`),
  CONSTRAINT `horario_especialidad_ibfk_3` FOREIGN KEY (`idconsultorio`) REFERENCES `consultorio` (`idconsultorio`),
  CONSTRAINT `horario_especialidad_ibfk_4` FOREIGN KEY (`idespec_medico`) REFERENCES `espec_medico` (`idespec_medico`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_hospital`.`horario_especialidad`
--

/*!40000 ALTER TABLE `horario_especialidad` DISABLE KEYS */;
INSERT INTO `horario_especialidad` (`idhorario_especialidad`,`cupos`,`fecha`,`idhorario`,`idconsultorio`,`idespec_medico`) VALUES 
 (2,20,'2022-03-13',1,3,1),
 (3,20,'2022-05-05',1,4,1),
 (4,20,'2022-05-05',1,6,5),
 (6,20,'2022-05-07',1,4,6),
 (7,20,'2022-05-12',1,6,5),
 (8,10,'2022-05-07',2,5,6),
 (9,17,'2022-05-15',1,3,1),
 (10,9,'2022-05-15',1,6,5),
 (11,10,'2022-05-15',2,4,1),
 (12,18,'2022-05-17',1,4,1),
 (13,10,'2022-05-18',1,4,1),
 (14,17,'2022-05-20',1,3,1),
 (15,6,'2022-05-19',1,5,6),
 (16,18,'2022-05-21',1,3,6),
 (17,9,'2022-05-19',2,6,5);
/*!40000 ALTER TABLE `horario_especialidad` ENABLE KEYS */;


--
-- Table structure for table `db_hospital`.`medicina`
--

DROP TABLE IF EXISTS `medicina`;
CREATE TABLE `medicina` (
  `idmedicina` int(11) NOT NULL AUTO_INCREMENT,
  `denom` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL,
  `fech_venc` date NOT NULL,
  `idtipo` int(11) NOT NULL,
  PRIMARY KEY (`idmedicina`),
  KEY `idtipo` (`idtipo`),
  CONSTRAINT `medicina_ibfk_1` FOREIGN KEY (`idtipo`) REFERENCES `tipo` (`idtipo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_hospital`.`medicina`
--

/*!40000 ALTER TABLE `medicina` DISABLE KEYS */;
INSERT INTO `medicina` (`idmedicina`,`denom`,`stock`,`fech_venc`,`idtipo`) VALUES 
 (1,'PARACETAMOL 500mg',500,'2024-02-01',1),
 (2,'PARACETAMOL 300mg',500,'2024-02-01',5),
 (3,'PARACETAMOL 100mg/ml',500,'2024-02-01',6),
 (4,'PARACETAMOL 100mg',500,'2024-02-01',5),
 (5,'IBUPROFENO',500,'2024-02-01',5);
/*!40000 ALTER TABLE `medicina` ENABLE KEYS */;


--
-- Table structure for table `db_hospital`.`medico`
--

DROP TABLE IF EXISTS `medico`;
CREATE TABLE `medico` (
  `idmedico` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) NOT NULL,
  `idpersona` int(11) NOT NULL,
  PRIMARY KEY (`idmedico`),
  KEY `idpersona` (`idpersona`),
  CONSTRAINT `medico_ibfk_1` FOREIGN KEY (`idpersona`) REFERENCES `persona` (`idpersona`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_hospital`.`medico`
--

/*!40000 ALTER TABLE `medico` DISABLE KEYS */;
INSERT INTO `medico` (`idmedico`,`codigo`,`idpersona`) VALUES 
 (1,'757485',3),
 (4,'123456',9),
 (6,'020202',12);
/*!40000 ALTER TABLE `medico` ENABLE KEYS */;


--
-- Table structure for table `db_hospital`.`paciente`
--

DROP TABLE IF EXISTS `paciente`;
CREATE TABLE `paciente` (
  `idpaciente` int(11) NOT NULL AUTO_INCREMENT,
  `alergia_medi` varchar(100) DEFAULT NULL,
  `idpersona` int(11) NOT NULL,
  `idhist_clinica` int(11) NOT NULL,
  PRIMARY KEY (`idpaciente`),
  KEY `idpersona` (`idpersona`),
  KEY `idhist_clinica` (`idhist_clinica`),
  CONSTRAINT `paciente_ibfk_1` FOREIGN KEY (`idpersona`) REFERENCES `persona` (`idpersona`),
  CONSTRAINT `paciente_ibfk_2` FOREIGN KEY (`idhist_clinica`) REFERENCES `hist_clinica` (`idhist_clinica`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_hospital`.`paciente`
--

/*!40000 ALTER TABLE `paciente` DISABLE KEYS */;
INSERT INTO `paciente` (`idpaciente`,`alergia_medi`,`idpersona`,`idhist_clinica`) VALUES 
 (1,'Ninguna',4,1),
 (3,'NINGUNA',2,3),
 (4,'NINGUNA',7,4),
 (9,'NINGUNA',20,9),
 (10,'NINGUNA',26,10),
 (11,'NINGUNA',27,11),
 (12,'NINGUNA',28,12);
/*!40000 ALTER TABLE `paciente` ENABLE KEYS */;


--
-- Table structure for table `db_hospital`.`pers_adm`
--

DROP TABLE IF EXISTS `pers_adm`;
CREATE TABLE `pers_adm` (
  `idpers_adm` int(11) NOT NULL AUTO_INCREMENT,
  `idpersona` int(11) NOT NULL,
  PRIMARY KEY (`idpers_adm`),
  KEY `idpersona` (`idpersona`),
  CONSTRAINT `pers_adm_ibfk_1` FOREIGN KEY (`idpersona`) REFERENCES `persona` (`idpersona`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_hospital`.`pers_adm`
--

/*!40000 ALTER TABLE `pers_adm` DISABLE KEYS */;
INSERT INTO `pers_adm` (`idpers_adm`,`idpersona`) VALUES 
 (1,2),
 (16,11),
 (5,13);
/*!40000 ALTER TABLE `pers_adm` ENABLE KEYS */;


--
-- Table structure for table `db_hospital`.`persona`
--

DROP TABLE IF EXISTS `persona`;
CREATE TABLE `persona` (
  `idpersona` int(11) NOT NULL AUTO_INCREMENT,
  `dni` varchar(8) NOT NULL,
  `ap_paterno` varchar(50) NOT NULL,
  `ap_materno` varchar(50) NOT NULL,
  `nombres` varchar(50) NOT NULL DEFAULT '',
  `sexo` varchar(45) NOT NULL DEFAULT '',
  `fech_nac` date DEFAULT NULL,
  `lugar_nac` varchar(50) NOT NULL,
  `edad` varchar(40) DEFAULT NULL,
  `direccion` varchar(100) NOT NULL,
  `g_sangui` varchar(10) DEFAULT NULL,
  `factor_rh` varchar(10) DEFAULT NULL,
  `telefono` varchar(9) NOT NULL DEFAULT '',
  PRIMARY KEY (`idpersona`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_hospital`.`persona`
--

/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` (`idpersona`,`dni`,`ap_paterno`,`ap_materno`,`nombres`,`sexo`,`fech_nac`,`lugar_nac`,`edad`,`direccion`,`g_sangui`,`factor_rh`,`telefono`) VALUES 
 (1,'74857582','MARTINEZ','JAMANCA','ROGER MARTIN','Masculino','1990-05-21','Pomabamba','32','JR. HUARAZ 610','O','Positivo','968599698'),
 (2,'72224693','LLALLIHUAMAN','GIRALDO','JOEL VLADIMIR','Masculino','1999-09-09','Sihuas','22 AñO(S), 7 MES(ES) Y 27 DíA(S).','JR SAN FRANCISCO 410','O','Positivo','910959104'),
 (3,'74125638','JAQUE','VILLANUEVA','PAULINA MARIA','Femenino','1995-11-01','Pomabamba','27','AV. JORGE CHAVEZ 308','AB','Negativo','986858748'),
 (4,'85412564','Vargas','Vega','Joseph','Masculino','1998-03-21','Huayllan','23','Jr. Peru S/N','A','Negativo',''),
 (7,'32610292','GIRALDO','CORZO','TERESA','Femenino','1972-10-10','','49 AñO(S), 6 MES(ES) Y 26 DíA(S).','JR PERU','O','Positivo','875487548'),
 (9,'72457475','CARRILLO','ALTAMIRANO','SAMANTA','','0000-00-00','','0','JR PERU1','','','966857454'),
 (11,'75858855','MORENO','CHAUCA','ANDRES','','0000-00-00','','0','JR HUARAZ','','','968589688'),
 (12,'75858485','AYALA','JARAMILLO','MARITZA YENNY','','0000-00-00','','0','JR LIMA','','','748585874');
INSERT INTO `persona` (`idpersona`,`dni`,`ap_paterno`,`ap_materno`,`nombres`,`sexo`,`fech_nac`,`lugar_nac`,`edad`,`direccion`,`g_sangui`,`factor_rh`,`telefono`) VALUES 
 (13,'12334353','PACHECO','TORRES','JUAN','','0000-00-00','','0','JR HUAMACHUCO','','','123234534'),
 (18,'41454842','VILLANUEVA','SOLORZANO','ELIZABETH','Femenino','1998-12-10','POMABAMBA','23 AñO(S), 6 MES(ES) Y 24 DíA(S).','JR ARICA 456','A','Positivo','989696959'),
 (19,'74785857','CAMPOMANES','TARAZONA','MISHELL MIRELLI','','0000-00-00','','','JR. LUIS NEGREIROS 210','','','985968528'),
 (20,'74857485','MORENO','VILLANUEVA','ROSA MARIA','Femenino','1995-07-12','POMABAMBA','26 AñO(S), 5 MES(ES) Y 7 DíA(S).','JR CHACHAPOYAS 456','O','Positivo','985696858'),
 (21,'74747858','MARTINEZ','CRUZ','SAUL ENRIQUE','Masculino','1990-12-12','POMABAMBA','31 AñO(S), 5 MES(ES) Y 6 DíA(S).','JR. JORGE CHAVEZ 56','O','Positivo','985685968'),
 (22,'74747858','MARTINEZ','CRUZ','SAUL ENRIQUE','Masculino','1990-12-12','POMABAMBA','31 AñO(S), 5 MES(ES) Y 6 DíA(S).','JR. JORGE CHAVEZ 56','O','Positivo','985685968'),
 (23,'85748585','GARCIA','GARCIA','SAUL ENRIQUE','Masculino','1990-12-12','POMABAMBA','31 AñO(S), 5 MES(ES) Y 6 DíA(S).','JR. JORGE CHAVEZ - CONVENTO','O','Positivo','968585825');
INSERT INTO `persona` (`idpersona`,`dni`,`ap_paterno`,`ap_materno`,`nombres`,`sexo`,`fech_nac`,`lugar_nac`,`edad`,`direccion`,`g_sangui`,`factor_rh`,`telefono`) VALUES 
 (24,'85748585','GARCIA','GARCIA','SAUL ENRIQUE','Masculino','1990-12-12','POMABAMBA','31 AñO(S), 5 MES(ES) Y 6 DíA(S).','JR. JORGE CHAVEZ - CONVENTO','O','Positivo','968585825'),
 (25,'78584741','GARCIA','GARCIA','ENRIQUE SAUL','Masculino','1990-12-12','POMABAMBA','31 AñO(S), 5 MES(ES) Y 6 DíA(S).','JR. JORGE CHAVEZ','B','Negativo','968589512'),
 (26,'75585258','GARCIA','CALDAS','ENRIQUE JOSE','Masculino','1990-12-12','POMABAMBA','31 AñO(S), 5 MES(ES) Y 6 DíA(S).','JR. JORGE CHAVEZ','A','Positivo','985695652'),
 (27,'72224683','LLALLIHUAMAN','GIRALDO','PILAR KATHERINE','Femenino','2003-05-21','POMABAMBA','18 AÑO(S) 11 MES(ES) 28 DÍA(S)','JR SAN FRANCISCO S/N','O','Positivo','965841269'),
 (28,'52651258','MATIAS','ROJAS','ZAIDY','Femenino','1999-08-15','SHILLA','2022 AÑO(S) 5 MES(ES) 19 DÍA(S)','SHILLA','O','Positivo','985264126');
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;


--
-- Table structure for table `db_hospital`.`receta`
--

DROP TABLE IF EXISTS `receta`;
CREATE TABLE `receta` (
  `idreceta` int(11) NOT NULL AUTO_INCREMENT,
  `idatencion` int(11) NOT NULL,
  `fech_importe` date NOT NULL,
  `hora_importe` time NOT NULL DEFAULT '00:00:00',
  `estado` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`idreceta`),
  KEY `idatencion` (`idatencion`),
  CONSTRAINT `receta_ibfk_1` FOREIGN KEY (`idatencion`) REFERENCES `atencion` (`idatencion`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_hospital`.`receta`
--

/*!40000 ALTER TABLE `receta` DISABLE KEYS */;
INSERT INTO `receta` (`idreceta`,`idatencion`,`fech_importe`,`hora_importe`,`estado`) VALUES 
 (27,9,'2022-05-19','16:35:14','Recogido'),
 (28,10,'2022-05-19','22:11:06','Recogido'),
 (29,13,'2022-05-20','16:30:56','Recogido'),
 (30,14,'2022-05-20','17:11:01','Por Recoger');
/*!40000 ALTER TABLE `receta` ENABLE KEYS */;


--
-- Table structure for table `db_hospital`.`roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `idroles` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(200) NOT NULL,
  PRIMARY KEY (`idroles`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_hospital`.`roles`
--

/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`idroles`,`rol`) VALUES 
 (1,'ADMIN'),
 (2,'RECEPCIONISTA'),
 (3,'MÉDICO'),
 (4,'ENFERMERA(O)'),
 (5,'FARMACÉUTICO(A)');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


--
-- Table structure for table `db_hospital`.`tipo`
--

DROP TABLE IF EXISTS `tipo`;
CREATE TABLE `tipo` (
  `idtipo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`idtipo`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_hospital`.`tipo`
--

/*!40000 ALTER TABLE `tipo` DISABLE KEYS */;
INSERT INTO `tipo` (`idtipo`,`tipo`) VALUES 
 (1,'Tableta'),
 (2,'Tableta Soluble'),
 (3,'Comprimido'),
 (4,'Solución Inyectable'),
 (5,'Supositorio'),
 (6,'Solución oral'),
 (7,'Tableta sublingual'),
 (8,'Parche'),
 (9,'Crema'),
 (10,'cápsula de '),
 (11,'Emulsión inyectable '),
 (12,'Elixir');
/*!40000 ALTER TABLE `tipo` ENABLE KEYS */;


--
-- Table structure for table `db_hospital`.`usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `idusuarios` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `contraseña` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fecharegistro` datetime NOT NULL,
  `ultacceso` datetime DEFAULT NULL,
  `fechaedicion` datetime NOT NULL,
  `estado` varchar(50) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `idroles` int(11) NOT NULL,
  PRIMARY KEY (`idusuarios`),
  KEY `idroles` (`idroles`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idroles`) REFERENCES `roles` (`idroles`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_hospital`.`usuarios`
--

/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`idusuarios`,`nombre`,`dni`,`contraseña`,`email`,`fecharegistro`,`ultacceso`,`fechaedicion`,`estado`,`foto`,`idroles`) VALUES 
 (1,'Admin','74857582','123456789','Admin@gmail.com','2022-03-20 12:29:38','2022-03-20 12:29:38','2022-05-03 09:09:55','ACTIVO','files/images/1/logo.png',1),
 (3,'TeresaGC','32610292','123','teresa12@gmail.com','2022-05-02 11:37:13','0000-00-00 00:00:00','2022-05-20 15:29:55','ACTIVO','files/images/0/persona.png',5),
 (4,'JoelLG','72224693','123','joel@gmail.com','2022-05-02 13:55:20','0000-00-00 00:00:00','2022-05-19 22:05:24','ACTIVO','files/images/4/4_2022_72224693.jpg',2),
 (5,'PaulinaJV','74125638','123','jaque@gmail.com','2022-05-02 14:05:24','0000-00-00 00:00:00','2022-05-19 21:11:30','ACTIVO','files/images/5/5_2022_74125638.jpg',3),
 (7,'SamantaCA','72457475','147','samanta@hotmail.com','2022-05-02 17:06:57','0000-00-00 00:00:00','2022-05-02 17:06:57','DESACTIVADO','files/images/0/persona.png',3),
 (9,'AndresMC','75858855','123','andres@gmail.com','2022-05-03 09:19:14','0000-00-00 00:00:00','2022-05-03 09:19:14','ACTIVO','files/images/0/persona.png',2),
 (10,'MaritzaAJ','75858485','123','mari_12@hotmail.com','2022-05-03 09:47:47','0000-00-00 00:00:00','2022-05-19 22:24:06','ACTIVO','files/images/0/persona.png',3);
INSERT INTO `usuarios` (`idusuarios`,`nombre`,`dni`,`contraseña`,`email`,`fecharegistro`,`ultacceso`,`fechaedicion`,`estado`,`foto`,`idroles`) VALUES 
 (11,'JuanPT','12334353','345','pacheco@gmail.com','2022-05-03 10:08:48','0000-00-00 00:00:00','2022-05-03 10:08:55','ACTIVO','files/images/0/persona.png',2),
 (13,'MishellCT','74785857','789456','mishel@gmail.com','2022-05-06 12:58:32','0000-00-00 00:00:00','2022-05-15 15:29:00','DESACTIVADO','files/images/0/persona.png',5);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;


--
-- Function `db_hospital`.`calc_edad`
--

DROP FUNCTION IF EXISTS `calc_edad`;
DELIMITER $$

CREATE DEFINER=`root`@`localhost` FUNCTION `calc_edad`(fecha datetime) RETURNS varchar(50) CHARSET utf8mb4
Begin
  declare años varchar(6) default '';
  declare meses varchar(6) default '';
  declare dias varchar(6) default '';
  declare cadena varchar(50) default '';
	set años=YEAR(CURDATE()) - YEAR(fecha) - IF(MONTH(CURDATE()) < MONTH(fecha), 1,
IF(MONTH(CURDATE()) = MONTH(fecha),
IF(DAY(CURDATE()) < DAY(fecha),1,0 ),0));
  set meses=MONTH(CURDATE()) - MONTH(fecha) + 12 *

IF(MONTH(CURDATE())<MONTH(fecha), 1,IF(MONTH(CURDATE())=MONTH(fecha),IF (DAY(CURDATE())<DAY(fecha),1,0),0))
- IF(MONTH(CURDATE())<>MONTH(fecha),(DAY(CURDATE())<DAY(fecha)), IF (DAY(CURDATE())<DAY(fecha),1,0 ) );
  set dias=(DAY(CURDATE()) - DAY( fecha ) +30 * ( DAY(CURDATE()) < DAY(fecha))) ;
  set cadena=concat(años,' AÑO(S) ',meses,' MES(ES) ',dias,' DÍA(S)');
Return cadena;

End $$

DELIMITER ;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
