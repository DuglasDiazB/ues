SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
--
-- Database: `ucsf`
--




CREATE TABLE IF NOT EXISTS `tblasistencias` (
  `id_asistencia` int(11) NOT NULL AUTO_INCREMENT,
  `id_exam` int(11) NOT NULL,
  `asistencia` enum('Si','No') COLLATE utf8_bin NOT NULL,
  `fecha_asist_capacit` date DEFAULT NULL,
  `usermod` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `fechamodasistencia` datetime DEFAULT NULL,
  PRIMARY KEY (`id_asistencia`),
  KEY `fecha_asist_capacit` (`fecha_asist_capacit`),
  KEY `id_exam` (`id_exam`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



CREATE TABLE IF NOT EXISTS `tblcredenciales` (
  `id_creden` int(11) NOT NULL AUTO_INCREMENT,
  `id_manip` int(11) NOT NULL,
  `estado_creden` enum('Activo','Inactivo') COLLATE utf8_bin NOT NULL,
  `fecha_emis_creden` date DEFAULT NULL,
  `fecha_exped_creden` date DEFAULT NULL,
  PRIMARY KEY (`id_creden`),
  KEY `id_manip` (`id_manip`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



CREATE TABLE IF NOT EXISTS `tblestablecimientos` (
  `id_estab` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_estab` varchar(100) COLLATE utf8_bin NOT NULL,
  `dui_prop` varchar(10) COLLATE utf8_bin NOT NULL,
  `nombre_prop` varchar(50) COLLATE utf8_bin NOT NULL,
  `apellido_prop` varchar(50) COLLATE utf8_bin NOT NULL,
  `direccion_estab` varchar(200) COLLATE utf8_bin NOT NULL,
  `cat_estab` varchar(100) COLLATE utf8_bin NOT NULL,
  `tipo_estab` enum('Formal','Informal') COLLATE utf8_bin NOT NULL,
  `apartado_especifico` enum('A','B','C','D','E','F','G','H') COLLATE utf8_bin NOT NULL,
  `telefono_estab` varchar(10) COLLATE utf8_bin NOT NULL,
  `municipio_estab` varchar(30) COLLATE utf8_bin NOT NULL,
  `departamento_estab` varchar(20) COLLATE utf8_bin NOT NULL,
  `estado_estab` enum('Activo','Inactivo') COLLATE utf8_bin NOT NULL,
  `fecha_reg_estab` date NOT NULL,
  `fecha_mod_estab` datetime NOT NULL,
  `usermod` varchar(15) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_estab`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



CREATE TABLE IF NOT EXISTS `tblexamenes` (
  `id_exam` int(11) NOT NULL AUTO_INCREMENT,
  `id_manip` int(11) NOT NULL,
  `fecha_entrega_so` date DEFAULT NULL,
  `exam_s` enum('No entregado','DN','FN') COLLATE utf8_bin NOT NULL,
  `exam_o` enum('No entregado','DN','FN') COLLATE utf8_bin NOT NULL,
  `fecha_entrega_so2` date DEFAULT NULL,
  `exam_s2` enum('No entregado','DN','FN') COLLATE utf8_bin NOT NULL,
  `exam_o2` enum('No entregado','DN','FN') COLLATE utf8_bin NOT NULL,
  `estado_exam` enum('Acto','No acto') COLLATE utf8_bin NOT NULL,
  `fecha_exped_exam` date DEFAULT NULL,
  `fechamodexamen` datetime DEFAULT NULL,
  `usermod` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id_exam`),
  KEY `id_manip` (`id_manip`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



CREATE TABLE IF NOT EXISTS `tblfechacapacitaciones` (
  `id_fechacapacit` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_inicio_capacit` date DEFAULT NULL,
  `fecha_fin_capacit` date DEFAULT NULL,
  `fechamodcapacit` datetime DEFAULT NULL,
  `usermod` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `ejecutado` enum('Si','No') COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_fechacapacit`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



CREATE TABLE IF NOT EXISTS `tblinspecciones` (
  `id_inspec` int(11) NOT NULL AUTO_INCREMENT,
  `inspec_para` enum('Autorización nueva','Renovación','Control') COLLATE utf8_bin NOT NULL,
  `fecha_inspec` date DEFAULT NULL,
  `objeto_visita` enum('Tramite de permiso','Inspección de control','Denuncia') COLLATE utf8_bin NOT NULL,
  `nombre_inspector` varchar(50) COLLATE utf8_bin NOT NULL,
  `cal_primer_inspec` float DEFAULT NULL,
  `primer_reinspec_fecha` date DEFAULT NULL,
  `primer_reinspec_cal` float DEFAULT NULL,
  `segunda_reinspec_fecha` date DEFAULT NULL,
  `segunda_reinspec_cal` float DEFAULT NULL,
  `id_estab` int(11) NOT NULL,
  PRIMARY KEY (`id_inspec`),
  KEY `id_estab` (`id_estab`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



CREATE TABLE IF NOT EXISTS `tbllog` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(100) COLLATE utf8_bin NOT NULL,
  `metodo` varchar(6) COLLATE utf8_bin NOT NULL,
  `direccion_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `usuario_log` varchar(50) COLLATE utf8_bin NOT NULL,
  `fecha_log` datetime NOT NULL,
  `respuesta_log` enum('Exitosa','No exitosa') COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



CREATE TABLE IF NOT EXISTS `tblmanipuladores` (
  `id_manip` int(11) NOT NULL AUTO_INCREMENT,
  `dui_manip` varchar(12) COLLATE utf8_bin NOT NULL,
  `nombre_manip` varchar(50) COLLATE utf8_bin NOT NULL,
  `apellido_manip` varchar(50) COLLATE utf8_bin NOT NULL,
  `genero_manip` enum('Hombre','Mujer') COLLATE utf8_bin NOT NULL,
  `fecha_nacim_manip` date NOT NULL,
  `puesto_manip` varchar(50) COLLATE utf8_bin NOT NULL,
  `token` varchar(350) COLLATE utf8_bin DEFAULT NULL,
  `estado_manip` enum('Activo','Inactivo') COLLATE utf8_bin NOT NULL,
  `id_estab` int(11) NOT NULL,
  `fecha_registro_manip` date NOT NULL,
  `fecha_mod_manip` datetime NOT NULL,
  `usermod` varchar(15) COLLATE utf8_bin NOT NULL,
  `asistencia_check` enum('Si','No') COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_manip`),
  KEY `id_estab` (`id_estab`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



CREATE TABLE IF NOT EXISTS `tipousuarios` (
  `idtipousuario` int(11) NOT NULL AUTO_INCREMENT,
  `tipousuario` varchar(15) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idtipousuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombreusuario` varchar(50) COLLATE utf8_bin NOT NULL,
  `apellidousuario` varchar(50) COLLATE utf8_bin NOT NULL,
  `direccionusuario` varchar(250) COLLATE utf8_bin NOT NULL,
  `telefonousuario` varchar(10) COLLATE utf8_bin NOT NULL,
  `duiusuario` varchar(10) COLLATE utf8_bin NOT NULL,
  `sexousuario` int(11) NOT NULL,
  `fechanacimientousuario` date NOT NULL,
  `estadousuario` int(11) NOT NULL,
  `username` varchar(15) COLLATE utf8_bin NOT NULL,
  `password` varchar(300) COLLATE utf8_bin NOT NULL,
  `idtipousuario` int(11) NOT NULL,
  `fecharegistro` date NOT NULL,
  `fechamodusuario` datetime NOT NULL,
  `usermod` varchar(15) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idusuario`),
  KEY `idtipousuario` (`idtipousuario`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


INSERT INTO tblasistencias VALUES
("1","1","No","","",""),
("3","2","No","","",""),
("4","11","No","0000-00-00","NULL","0000-00-00 00:00:00"),
("5","12","No","0000-00-00","NULL","0000-00-00 00:00:00"),
("6","13","No","0000-00-00","NULL","0000-00-00 00:00:00"),
("7","14","No","0000-00-00","NULL","0000-00-00 00:00:00"),
("8","15","No","0000-00-00","NULL","0000-00-00 00:00:00"),
("9","19","No","","",""),
("10","20","No","","","");



INSERT INTO tblcredenciales VALUES
("1","1","Inactivo","",""),
("2","2","Inactivo","",""),
("3","16","Inactivo","",""),
("4","17","Inactivo","0000-00-00","0000-00-00"),
("6","19","Inactivo","",""),
("7","20","Inactivo","",""),
("8","25","Inactivo","","");



INSERT INTO tblestablecimientos VALUES
("1","Wendys","12345678-8","Luis Fernando","Hernandez","San Miguel","Restaurante","Formal","A","1111-1111","San Miguel","San Miguel","Activo","2020-11-23","2020-11-23 22:08:34","Tatita"),
("2","Wendys","12345678-8","Luis","Hernandez","San Miguel","Restaurante","Formal","A","1111-1111","San Miguel","San Miguel","Inactivo","2020-11-18","2020-11-18 22:06:08","Tatita"),
("3","Kentucky Fried Chicken KFC","12345678-8","Erick","Joya","San Miguel","Restaurante","Informal","A","1111-1111","San Miguel","San Miguel","Activo","2020-11-24","2020-11-24 14:37:14","Tatita"),
("4","Pollo Campero","12345678-8","Yanci","Martinez","San Miguel","Restaurante","Formal","A","1111-1111","San Miguel","San Miguel","Activo","2020-11-23","2020-11-23 22:22:59","Tatita"),
("5","Pasteleria Lorena","12345678-8","Douglas","Diaz","San Miguel","Restaurante","Formal","A","1111-1111","San Miguel","San Miguel","Activo","2020-11-23","2020-11-23 22:23:29","Tatita"),
("6","Burguerking","12345678-8","Yesenia","Bolaos","San Miguel","Restaurante","Informal","A","1111-1111","San Miguel","San Miguel","Activo","2020-11-23","2020-11-23 22:24:06","Tatita"),
("7","Wendys","12345678-8","Luis","Hernandez","San Miguel","Restaurante","Formal","A","1111-1111","San Miguel","San Miguel","Activo","2020-11-18","2020-11-18 22:06:08","Tatita"),
("8","Wendys","12345678-8","Luis","Hernandez","San Miguel","Restaurante","Formal","A","1111-1111","San Miguel","San Miguel","Activo","2020-11-18","2020-11-18 22:06:08","Tatita"),
("9","Wendys","12345678-8","Luis","Hernandez","San Miguel","Restaurante","Formal","A","1111-1111","San Miguel","San Miguel","Activo","2020-11-18","2020-11-18 22:06:08","Tatita"),
("10","Wendys","12345678-8","Luis","Hernandez","San Miguel","Restaurante","Formal","A","1111-1111","San Miguel","San Miguel","Activo","2020-11-18","2020-11-18 22:06:08","Tatita"),
("11","Wendys","12345678-8","Luis","Hernandez","San Miguel","Restaurante","Formal","A","1111-1111","San Miguel","San Miguel","Activo","2020-11-18","2020-11-18 22:06:08","Tatita"),
("12","Wendys","12345678-8","Luis","Hernandez","San Miguel","Restaurante","Formal","A","1111-1111","San Miguel","San Miguel","Activo","2020-11-18","2020-11-18 22:06:08","Tatita"),
("13","Wendys","12345678-8","Luis","Hernandez","San Miguel","Restaurante","Formal","A","1111-1111","San Miguel","San Miguel","Activo","2020-11-18","2020-11-18 22:06:08","Tatita"),
("14","Wendys","12345678-8","Luis","Hernandez","San Miguel","Restaurante","Formal","A","1111-1111","San Miguel","San Miguel","Activo","2020-11-18","2020-11-18 22:06:08","Tatita"),
("15","Wendys","12345678-8","Luis","Hernandez","San Miguel","Restaurante","Formal","A","1111-1111","San Miguel","San Miguel","Activo","2020-11-18","2020-11-18 22:06:08","Tatita"),
("16","La fonda de doa florinda","00900909-9","Florinda","Mesa","Colonia ciudad pacifica Pol C","Fonda","Informal","A","0909-0909","San Miguel","San Miguel","Activo","2020-11-18","2020-11-18 22:30:09","Tatita"),
("17","Pupuseria Roxi","12091287-3","Roxana","De la O","Colonia ciudad pacifica Pol C","Pupuseria","Formal","A","0909-0909","San Miguel","San Miguel","Activo","2020-11-23","2020-11-23 22:17:29","Tatita"),
("18","Wendys","65123454-0","Julio","Cesar","Colonia ciudad pacifica Pol C","Fonda","Formal","A","0909-0909","San Miguel","San Miguel","Activo","2020-11-24","2020-11-24 13:50:28","Tatita");



INSERT INTO tblexamenes VALUES
("1","1","2020-11-13","DN","DN","","No entregado","No entregado","Acto","2021-05-13","2020-11-13 15:59:00","Tatita"),
("2","2","","No entregado","No entregado","","No entregado","No entregado","No acto","","2020-11-13 10:37:51","Tatita"),
("3","6","","No entregado","No entregado","","No entregado","No entregado","No acto","","",""),
("4","7","","No entregado","No entregado","","No entregado","No entregado","No acto","","",""),
("5","8","","No entregado","No entregado","","No entregado","No entregado","No acto","","",""),
("6","9","","No entregado","No entregado","","No entregado","No entregado","No acto","","",""),
("7","10","","No entregado","No entregado","","No entregado","No entregado","No acto","","",""),
("10","13","","No entregado","No entregado","","No entregado","No entregado","No acto","","",""),
("11","14","","No entregado","No entregado","","No entregado","No entregado","No acto","","",""),
("12","15","","No entregado","No entregado","","No entregado","No entregado","No acto","","",""),
("13","16","","No entregado","No entregado","","No entregado","No entregado","No acto","","",""),
("14","19","","No entregado","No entregado","","No entregado","No entregado","No acto","","",""),
("15","20","","No entregado","No entregado","","No entregado","No entregado","No acto","","",""),
("16","21","","No entregado","No entregado","","No entregado","No entregado","No acto","","",""),
("19","24","","No entregado","No entregado","","No entregado","No entregado","No acto","","",""),
("20","25","","No entregado","No entregado","","No entregado","No entregado","No acto","","","");



INSERT INTO tblfechacapacitaciones VALUES
("1","2020-11-13","2020-11-20","2020-11-13 16:03:10","Tatita","Si");



INSERT INTO tblinspecciones VALUES
("8","Control","2020-08-19","Denuncia","Maria Yanci Martinez Garcia","9","2020-08-19","9","2020-08-19","9","1"),
("15","Renovación","2020-09-14","Inspección de control","Maria Yanci Martinez Garcia","5","2020-09-14","8","2020-09-07","8","2"),
("16","Control","2020-09-22","Denuncia","Maria Yanci Martinez Garcia","4","2020-09-15","4","2020-09-21","7","3"),
("17","Autorización nueva","2020-09-17","Tramite de permiso","Maria Yanci Martinez Garcia","5","2020-09-17","4","2020-09-10","8","5"),
("18","Autorización nueva","2020-09-08","Tramite de permiso","Maria Yanci Martinez Garcia","5","2020-09-08","8","2020-09-07","5","4"),
("19","Autorización nueva","2020-09-15","Tramite de permiso","Maria Yanci Martinez Garcia","7","2020-09-08","7","2020-09-01","5","6"),
("20","Autorización nueva","2020-09-23","Tramite de permiso","Maria Yanci Martinez Garcia","6","2020-09-08","8","2020-09-09","4","7"),
("21","Renovación","2020-09-15","Inspección de control","Maria Yanci Martinez Garcia","7","2020-09-08","5","2020-09-23","8","8"),
("22","Autorización nueva","2020-09-15","Tramite de permiso","Maria Yanci Martinez Garcia","7","2020-09-14","5","2020-09-08","8","9"),
("23","Control","2020-09-15","Denuncia","Maria Yanci Martinez Garcia","7","2020-09-22","5","2020-09-07","8","10"),
("24","Autorización nueva","2020-09-15","Tramite de permiso","Maria Yanci Martinez Garcia","4","2020-09-22","4","2020-09-15","8","11"),
("25","Control","2020-09-15","Inspección de control","Maria Yanci Martinez Garcia","7","2020-09-15","5","2020-09-10","8","12"),
("26","Renovación","2020-10-30","Inspección de control","Maria Yanci Martinez Garcia","98","2020-10-30","98","","","13"),
("27","Autorización nueva","2020-11-11","Tramite de permiso","Maria Yanci Martinez Garcia","7","","","","","14");



INSERT INTO tbllog VALUES
("1","/ues/bitacoras","GET","192.168.0.1","yanci","2020-08-12 17:57:46","Exitosa"),
("4","/ues/inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-08-22 19:08:21","No exitosa"),
("5","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-08-22 19:18:50","No exitosa"),
("6","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-09-10 17:01:03","No exitosa"),
("7","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-09-10 17:02:01","Exitosa"),
("8","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-09-10 18:43:43","No exitosa"),
("9","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-09-10 18:47:46","No exitosa"),
("10","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-09-10 18:49:12","No exitosa"),
("11","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-09-12 15:47:10","Exitosa"),
("12","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-09-13 18:29:21","Exitosa"),
("13","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-09-13 18:29:57","Exitosa"),
("14","inspecciones/nuevaInspeccion","POST","::1","Fercastle","2020-09-13 18:33:08","Exitosa"),
("15","inspecciones/nuevaInspeccion","POST","::1","Fercastle","2020-09-13 18:34:44","Exitosa"),
("16","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-09-13 19:01:27","No exitosa"),
("17","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-09-13 19:01:33","No exitosa"),
("18","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-09-13 19:02:07","No exitosa"),
("19","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-09-13 19:02:12","No exitosa"),
("20","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-09-13 19:02:18","No exitosa"),
("21","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-09-13 19:07:30","No exitosa"),
("22","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-09-13 19:07:37","No exitosa"),
("23","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-09-13 20:52:55","No exitosa"),
("24","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-09-17 19:25:23","No exitosa"),
("25","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-09-17 19:51:07","Exitosa"),
("26","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-09-17 19:51:49","Exitosa"),
("27","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-09-20 21:16:23","Exitosa"),
("28","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-09-25 13:48:52","Exitosa"),
("29","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-09-25 13:49:19","Exitosa"),
("30","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-09-25 13:49:21","No exitosa"),
("31","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-09-25 13:49:52","Exitosa"),
("32","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-09-25 13:50:12","Exitosa"),
("33","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-09-25 13:50:45","Exitosa"),
("34","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-09-25 13:51:26","Exitosa"),
("35","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-09-25 13:52:02","Exitosa"),
("36","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-09-25 13:52:34","Exitosa"),
("37","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-10-26 15:36:41","No exitosa"),
("38","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-10-26 16:01:06","Exitosa"),
("39","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-10-27 14:34:37","No exitosa"),
("40","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-11-13 10:53:32","Exitosa");



INSERT INTO tblmanipuladores VALUES
("1","12345678-1","Luis Fernando","Hernandez Castillo","Hombre","1990-04-19","Vendedor","fbM9ZzR_QJGOC5o_OgaZj3:APA91bG6vnmlKoF5MVpIHRV0P9ypyd9si2gGJnBvdZCxYOm9VHc6MF6Ar0Ekl0Z0dxVcawceJZmHkXapsOAtj7XfoBVRiAnEm6nzomhTYJijPxHHHhR-MGZaUSa1d0ylSPbK0ENcqE04","Inactivo","10","0000-00-00","0000-00-00 00:00:00","",""),
("2","12345678-2","Maria Yanci","Martinez Garcia","Mujer","2020-11-24","Cocinera","","Activo","17","2020-11-24","2020-11-24 13:27:06","Tatita","Si"),
("3","00098765-3","Marco Antonio","Solis","Hombre","2020-11-24","Cajero","","Activo","3","2020-11-24","2020-11-24 11:58:21","Tatita","Si"),
("4","09765432-1","Ana Maria","Polo","Mujer","2020-11-12","Cajero","","Activo","1","2020-11-18","2020-11-18 23:47:53","Tatita","No"),
("6","12121212-2","Rosa","Chavez","Mujer","2020-11-03","Cajero","","Activo","1","2020-11-18","2020-11-18 23:51:04","Tatita","Si"),
("7","03018721-4","Monica","Garcia","Mujer","2020-11-24","Cajero","","Activo","17","2020-11-24","2020-11-24 13:26:37","Tatita","Si"),
("8","65431298-0","Rodrigo","Agreda","Hombre","2020-11-24","Gerente","","Activo","17","2020-11-24","2020-11-24 13:26:47","Tatita","Si"),
("9","65431298-0","Rodrigo","Agreda","Hombre","2020-11-24","Gerente","","Activo","17","2020-11-24","2020-11-24 13:26:57","Tatita","Si"),
("10","09876543-1","Enrique","Peanieto","Hombre","2020-11-24","Chef","","Activo","17","2020-11-24","2020-11-24 11:47:21","Tatita","Si"),
("13","75589312-9","Jorge","Ramos","Hombre","2020-11-03","Chef","","Activo","17","2020-11-24","2020-11-24 00:49:35","Tatita","Si"),
("14","00095665-1","Maria","Elena","Mujer","2020-11-19","Gerente","","Activo","1","2020-11-24","2020-11-24 00:55:23","Tatita","Si"),
("15","09423512-0","Manuel","Arce","Hombre","2020-11-26","Chef","","Activo","17","2020-11-24","2020-11-24 13:27:53","Tatita","Si"),
("16","65432312-3","Nombre","Apellido","Hombre","2020-11-03","Cajero","","Activo","17","2020-11-24","2020-11-24 14:59:09","Tatita","Si"),
("17","12345678-7","Luis Enrique","Hernadez Martinez","Hombre","2016-07-13","Mesero","","Activo","1","2020-11-24","2020-11-24 16:33:24","Tatita","Si"),
("19","09541212-1","Julia","Perez","Hombre","2020-11-10","Mesero","","Activo","1","2020-11-24","2020-11-24 17:53:01","Tatita","Si"),
("20","76541209-2","Jehudi","Lopez","Hombre","2020-11-04","Pupuser","","Activo","1","2020-11-24","2020-11-24 17:54:35","Tatita","Si"),
("21","87431254-2","Maria","Maria","Hombre","2020-11-11","Cajera","","Activo","1","2020-11-24","2020-11-24 18:17:14","Tatita","Si"),
("24","65231298-2","Maria","Tomafotos","Mujer","2020-11-04","mesera","","Activo","1","2020-11-24","2020-11-24 18:29:28","Tatita","Si"),
("25","98121298-1","Paquita","Del Barrio","Mujer","2020-11-12","Barrendera","","Activo","1","2020-11-24","2020-11-24 18:33:36","Tatita","Si");



INSERT INTO tipousuarios VALUES
("1","Administrador"),
("2","Usuario Normal");



INSERT INTO usuarios VALUES
("1","Luis Fernando","Hernandez Castillo","Col. Via Satelite Av. Reginal Casa # 11","7975-4615","00000000-1","1","1990-04-19","1","Administrador","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-09","2020-08-14 12:20:19","Tatita"),
("2","Maria Yanci","Martinez Garcia","San Francisco Gotera, Morazan","7392-7419","12345678-6","2","1994-03-07","1","Tatita","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-03-03","2020-10-19 21:29:23","Admin"),
("3","nombre","apellido","Direccion 1","7777-7777","123456789","1","1990-03-19","1","User Name 1","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-03-27","2020-07-18 18:47:27","Belisario"),
("4","nombre 2","apellido 2","direccion 2","1234567","12334567","1","1994-03-07","1","username2","123","1","2020-03-27","0000-00-00 00:00:00",""),
("5","nombre 3","apellido 3","direccion 3","122344556","12123543","1","1990-03-19","1","user name 2","123456","1","2020-03-27","0000-00-00 00:00:00",""),
("6","nombre 4","apellido 4","direccion 4","1234","123","1","1994-03-07","1","username4","123","1","2020-03-27","0000-00-00 00:00:00",""),
("8","nombre 7","apellido 67","direccion 7","122344556","123456789","1","1990-03-19","1","username 7","123","1","2020-03-27","0000-00-00 00:00:00",""),
("9","nombre 8","apellido 8","direccion 8","1234","123","1","2000-03-27","1","username 8","123456","1","2020-03-27","0000-00-00 00:00:00",""),
("10","Nelson Belisario","Hernandez Mendez","Col. Via. Satelite Av. Regional Casa #11","7878-7878","09876543-1","1","1969-04-09","1","Belisario","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-03-31","2020-07-18 18:43:14","Tatita"),
("11","Berta Luz","Castillo","Col. Via Satelite Av. Regional Casa #11","7171-7171","65432178-0","1","1970-03-21","1","Luz","123","1","2020-03-31","0000-00-00 00:00:00",""),
("12","Diana Marcela ","Hernandez Castillo","Col. VIa. Satelite Av. Buenos Aires Casa # 11","7979-7979","78695043-1","1","1994-02-03","1","dianam","123","1","2020-03-31","0000-00-00 00:00:00",""),
("13","Nelson Alexander","Hernandez Castillo","Col. Via Satelite Av. Buenos Aires Casa #11","7272-7272","01010101-1","1","1988-11-10","1","Nelson","123","1","2020-03-31","0000-00-00 00:00:00",""),
("14","Duglas Enrrique","Díaz Barahona","Ciudad Pacifica Bloque # 3 Pasaje # 7","7575-7575","90909090-2","1","1993-07-12","1","duglas","123","1","2020-03-31","0000-00-00 00:00:00",""),
("15","Erick Adalberto","López Joya","Usulutan","7676-7676","34343434-0","1","1995-06-11","1","erick","123","1","2020-03-31","0000-00-00 00:00:00",""),
("16","Giorgio Churruca","Uceda","Puerta Nueva, 78\n35560 Tinajo ","7796-9680","29072206-1","1","1991-11-28","1","churruca","123","1","2020-03-31","0000-00-00 00:00:00",""),
("17","Nilce Ozuna ","Salcedo","La Fontanilla, 46\n14470 El Viso ","6245-8183","38549224-2","1","1937-03-04","1","ozuna","123","1","2020-03-31","0000-00-00 00:00:00",""),
("18","Ansaldo ","Granados Hinojosa","Celso Emilio Ferreiro, 80\n50520 Magallón ","6749-6099","41925631-0","1","1973-10-28","1","ansaldo","123","1","2020-03-31","0000-00-00 00:00:00",""),
("19","Boris ","Montano Tirado","Camiño Ancho, 3\n37790 Fuentes de Béjar ","7128-0813","40438106-1","1","1949-06-24","1","tirado","123","1","2020-03-31","0000-00-00 00:00:00",""),
("20","Celestino ","Santillán Pagan","Calvo Sotelo, 71\n47300 Peñafiel ","6134-0177","41543381-0","1","1998-07-26","1","celestino","123","1","2020-03-31","0000-00-00 00:00:00",""),
("21","Cannan ","Melgar Estévez","Calle Proc. San Sebastián, 81\n13110 Horcajo de los Montes ","6960-3803","39329877-0","1","1960-09-14","1","cannan","123","1","2020-03-31","0000-00-00 00:00:00",""),
("22","Daff ","Zaragoza Centeno","Castelao, 81\n49155 La Bóveda de Toro ","7924-3118","41428817-1","1","1942-12-27","1","daff","123","1","2020-03-31","0000-00-00 00:00:00",""),
("23","Argenta ","Montez Verduzco","Cercas Bajas, 8\n08181 Sentmenat ","7479-6297","41611221-2","1","1945-11-18","1","verduzco","123","1","2020-03-31","0000-00-00 00:00:00",""),
("24","Iliana ","Salcido Zambrano","Antonio Vázquez, 74\n38712 Breña Baja ","7767-7785","28878258-1","1","1968-09-04","1","salcido","123","1","2020-03-31","0000-00-00 00:00:00",""),
("25","Aminta ","Alvarez Limón","Celso Emilio Ferreiro, 27\n50340 Maluenda ","7321-7508","41292273-0","1","1991-09-19","1","aminta","123","1","2020-03-31","0000-00-00 00:00:00",""),
("26","Eugene","Quiñones Botello","Avda. Los llanos, 29\n26259 Grañón ","6007-4628","42462934-1","1","1949-05-23","1","botello","123","1","2020-03-31","0000-00-00 00:00:00",""),
("27","Flaminia","Padilla Meza","Calle Aduana, 61\n01218 Berantevilla ","7768-4634","42699627-0","1","1960-03-07","1","flamina","123","1","2020-03-31","0000-00-00 00:00:00",""),
("28","Kalid","Pacheco Gaona","Plaza Colón, 87\n24420 Fabero ","6958-2487","42814122-0","1","1958-05-30","1","kalid","123","1","2020-03-31","0000-00-00 00:00:00",""),
("29","Griego","Juárez Venegas","Castelao, 28\n48710 Berriatua ","6256-5328","43258339-0","1","1988-02-22","1","griego","123","2","2020-03-31","0000-00-00 00:00:00",""),
("30","Helene","Curiel Almanza","Outid de Arriba, 30\n43560 La Sénia ","7637-1247","4057885-1","1","1978-04-03","1","curiel","123","1","2020-03-31","0000-00-00 00:00:00",""),
("31","Constance","Reséndez Amaya","Calle Carril de la Fuente, 92\n13200 Manzanares ","7867-0018","38907024-1","1","1989-05-04","1","amaya","123","2","2020-03-31","0000-00-00 00:00:00",""),
("32","Tiana ","Quintana Vázquez","Avda. Los llanos, 83\n26240 Castañares de Rioja","6679-9744","42576891-0","1","1985-12-02","1","tiana","123","1","2020-03-31","0000-00-00 00:00:00",""),
("33","Almira ","Matías Montero","Socampo, 44\n37630 Cabrillas ","6559-7144","4079699-0 ","1","1986-06-26","1","almira","123","1","2020-03-31","0000-00-00 00:00:00",""),
("34","Iracema","Parra Covas","Atamaria, 30\n36670 Cuntis ","7650-0398","42592489-1","1","1971-04-19","1","iracema","123","2","2020-03-31","0000-00-00 00:00:00",""),
("35","Cyndi","Rivas Tamayo","Ctra. Villena, 44\n34140 Villarramiel ","64364-464","4197-6183","1","1978-06-20","1","cyndi","123","1","2020-03-31","0000-00-00 00:00:00",""),
("36","Landolf","Guzmán Jáquez","Escuadro, 57\n46910 Sedaví ","6489-5013","39472701-0","1","1984-12-09","1","landoft","123","1","2020-03-31","0000-00-00 00:00:00",""),
("37","Homero","Toledo Linares","Ctra. de la Puerta, 72\n26587 Villarroya ","6985-5090","42192284-1","1","1979-09-25","1","homero","123456","1","2020-03-31","0000-00-00 00:00:00",""),
("38","Troilo","Saldana Salgado","C/ Libertad, 62\n05230 Las Navas del Marqués ","6411-0458","40546198-1","1","1975-05-20","1","troilo","123","1","2020-03-31","0000-00-00 00:00:00",""),
("39","Alterio","Galvez Lebrón","Plaza Colón, 73\n25000 Lleida ","6407-0198","41628899-1","1","1999-04-12","1","lebron","123","1","2020-03-31","0000-00-00 00:00:00",""),
("40","Friedrich","Lozada Urena","Carretera Cádiz-Málaga, 55\n20496 Bidegoyan ","6381-6791","4321687-0","1","1988-05-18","1","friedrich","123","2","2020-03-31","0000-00-00 00:00:00",""),
("41","nombre 8","apellido 8","direccion 8","1234567","123456789","1","1969-04-09","1","username 8","123","1","2020-03-23","0000-00-00 00:00:00",""),
("42","nombre 9","apellido 9","direccion 9","7777-8888","12334567","1","1970-03-21","1","username 9","123","1","2020-04-01","0000-00-00 00:00:00",""),
("43","nombre 9","apellido 9","direccion 9","1234567","123456789","1","1969-04-09","1","username 9","123","1","2020-04-01","0000-00-00 00:00:00",""),
("44","nombre 10","apellido 10","direccion 10","7676-7676","12334567","1","1937-03-04","1","username 10","123","2","2020-04-01","0000-00-00 00:00:00",""),
("45","nombre 11","apellido 11","direccion 11","6007-4628","42462934-1","1","1984-12-09","1","user name 11","4444","1","2020-04-01","0000-00-00 00:00:00",""),
("46","nombre 12","apellido 12","direccion 12","6985-5090","65432178-0","1","1995-06-11","1","username 12","555","2","2020-04-01","0000-00-00 00:00:00",""),
("47","Luis","Hernandez","coloni la colonia","7796-9680","09876543-1","1","1990-03-19","1","fercastle","123","1","2020-06-02","0000-00-00 00:00:00",""),
("48","Luis","Castillo","Col. Via. Satelite, Av. Regional","7777-7777","65432178-9","1","1990-04-19","1","fmln","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-02","0000-00-00 00:00:00",""),
("49","Luis","Castillo","Col. Via. Satelite, Av. Regional","7777-7777","42462934-2","1","1990-04-19","1","arena","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-02","0000-00-00 00:00:00",""),
("50","Luis","Hernandez","Col. Via. Satelite, Av. Regional","7777-7777","42462934-2","1","1990-04-19","1","fercastle","","1","2020-06-02","0000-00-00 00:00:00",""),
("51","Luis","Hernandez","Col. Via. Satelite, Av. Regional","7777-7777","42462934-3","1","1990-04-19","1","fercastle","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-02","0000-00-00 00:00:00",""),
("52","Luis","Hernandez","Col. Via. Satelite, Av. Regional","7777-7777","42462934-3","1","1990-04-19","1","fercastle","","1","2020-06-02","0000-00-00 00:00:00",""),
("53","Luis","Hernandez","Col. Via. Satelite, Av. Regional","7777-7777","42462934-4","1","1990-04-19","1","fercastle","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-02","0000-00-00 00:00:00",""),
("54","Luis","hernandez","Col. Via. Satelite, Av. Regional","7777-7777","12345678-5","1","1990-04-19","1","Luiss","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-02","0000-00-00 00:00:00",""),
("55","Maria","Martinez","Col. Via. Satelite, Av. Regional","7777-7777","22222222-2","2","1994-04-19","1","Maria","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","2","2020-06-02","0000-00-00 00:00:00",""),
("56","luis fernando","hernandez","Colonia Colonial","1212-1212","12121212-2","1","1990-04-19","1","Fercastle","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-04","0000-00-00 00:00:00",""),
("57","Luis Fernando","hernandez","Colonia Colonial","1212-1212","23232323-3","1","1993-02-19","1","Fercastle","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","2","2020-06-04","0000-00-00 00:00:00",""),
("58","Luis Hernandez","hernandez","Colonia Colonial","1212-1212","21212121-1","1","1990-04-19","1","Fercastle","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-04","0000-00-00 00:00:00",""),
("59","Luis Fernando","hernandez","Colonia Colonial","1212-1212","19901990-9","1","1990-04-19","1","Fercastle","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-04","0000-00-00 00:00:00",""),
("60","Marian Marlene","Reyes","Col. Via. Satelite, Av. Regional","2222-2222","12345678-9","1","2001-01-01","1","Maria","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-04","0000-00-00 00:00:00",""),
("61","nuevo usuario nombre","nuevo usuario apellido","Nueva Direccion","8888-8888","88888888-9","1","2020-06-09","1","Nuevo","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-09","2020-06-09 13:24:01","Admin"),
("62","nuevo usuario nombre","nuevo usuario apellido","Nueva Direccion","2222-2222","77777777-2","1","2020-06-09","1","Fmln","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-09","2020-06-09 13:26:08","Admin"),
("63","nuevo usuario nombre","nuevo usuario apellido","Nueva Direccion","2222-2222","01010101-2","1","2020-06-02","1","Maria","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-09","2020-06-09 13:32:31","Admin"),
("64","Doky","Hernandez","colonia la colonia","3333-3333","88888888-8","1","2020-05-30","1","doky","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-09","2020-06-09 17:33:09","Admin"),
("65","Doky","Hernandez castillo","colonia","3333-3333","12123434-3","1","2020-05-26","1","doky","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-09","2020-06-09 17:41:29","Tatita"),
("66","Luis","Hernandez","colonia la colonia","7777-1234","12123434-4","1","2020-06-09","1","doky","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-09","2020-06-09 18:32:12","Tatita"),
("67","Luis","Hernandez","colonia la colonia","7777-1234","00000000-0","1","2020-05-26","1","doky","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-09","2020-06-09 18:36:01","Tatita"),
("68","Luis","Hernandez","colonia la colonia","7777-1234","00000000-0","1","2020-05-26","1","doky","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-09","2020-06-09 18:38:05","Tatita"),
("69","Luis","Hernandez","colonia la colonia","7777-1234","00000000-0","1","2020-05-26","1","doky","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-09","2020-06-09 18:38:49","Tatita"),
("70","Luis","Hernandez","colonia la colonia","7777-1234","00000000-0","1","2020-05-26","1","doky","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-09","2020-06-09 18:39:39","Tatita"),
("71","Luis","Hernandez","colonia la colonia","7777-1234","00000000-2","1","2020-05-26","1","doky","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-09","2020-06-09 18:39:50","Tatita"),
("72","Luis","Hernandez","colonia la colonia","1212-1212","12123434-5","1","2020-05-25","1","Admin","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-09","2020-06-09 18:41:11","Tatita"),
("73","Luis","Hernandez","colonia","7777-1234","12123434-7","1","2020-06-09","1","Admin","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-09","2020-06-09 18:48:09","Tatita"),
("74","Luis","Hernandez","colonia","7777-1234","12123434-7","1","2020-06-09","1","Admin","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-09","2020-06-09 18:49:04","Tatita"),
("75","Luis","Hernandez","colonia","7777-1234","12123434-8","1","2020-06-09","1","Admin","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-09","2020-06-09 18:49:17","Tatita"),
("76","Luis","Hernandez","colonia","7777-1234","12123434-8","1","2020-06-09","1","Admin","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-09","2020-06-09 18:50:54","Tatita"),
("77","Luis","Hernandez","colonia","7777-1234","12123434-1","1","2020-06-09","1","Admin","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-09","2020-06-09 18:52:13","Tatita"),
("78","Luis","Hernandez","colonia","7777-1234","12123434-1","1","2020-06-09","1","Admin","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-09","2020-06-09 18:54:10","Tatita"),
("79","Luis","Hernandez","colonia","7777-1234","12123434-2","1","2020-06-09","1","Admin","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-09","2020-06-09 18:54:36","Tatita"),
("80","Luis","Hernandez","colonia","7777-1234","12123434-2","1","2020-06-09","1","Admin","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-09","2020-06-09 18:57:38","Tatita"),
("81","Luis","Hernandez","colonia","7777-1234","12123434-8","1","2020-06-09","1","Admin","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-09","2020-06-09 18:57:59","Tatita"),
("82","Luis","Hernandez","colonia","7777-1234","12123434-9","1","2020-06-09","1","Admin","b5ba77af1f7bda735894e746a199acb1d2c836424da2fc46bebb55423dccbff871877a30fab77a31e47b0a29ea0154882e532e9a29b220a8f2958773313bbb2a","1","2020-06-09","2020-06-09 18:58:25","Tatita"),
("83","nombre  nombre","apellido  apellido","colonia","7777-1234","00000000-0","1","2020-06-03","1","Doky","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-09","2020-06-09 19:06:05","Tatita"),
("84","nombre  nombre","apellido  apellido","colonia","7777-1234","00000000-0","1","2020-06-03","1","Doky","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-09","2020-06-09 19:07:05","Tatita"),
("85","nuevo","nuevo","direccion","7777-1234","12123434-3","1","1999-04-01","1","Doky","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-07-07","2020-07-07 17:50:26","Fmln"),
("86","nuevo","nuevo","direccion","7777-1234","12123434-4","1","1999-04-01","1","Dos","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-07-07","2020-07-07 17:51:01","Fmln"),
("87","nuevo","nuevo","direccion","7777-1234","12123432-2","1","1999-04-01","1","Dos","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-07-07","2020-07-07 17:51:23","Fmln"),
("88","nuevo","nuevo","direccion","7777-1234","12123432-2","1","1999-04-01","1","Tres","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-07-07","2020-07-07 17:51:53","Fmln"),
("89","nuevo","nuevo","direccion","7777-1234","00000000-3","1","1999-04-01","1","Tress","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-07-07","2020-07-07 17:52:33","Fmln"),
("90","farcry nombre","farcry apellido","colonia la colonia colonial","1212-1212","00001000-0","1","2020-07-17","1","Farcry","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-07-17","2020-07-17 19:39:17","Tatita"),
("91","Complemento Nombre","Complemento Apellido","Colonia La Colonia","1212-1212","99999999-0","1","2020-07-01","1","Dokin","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-07-18","2020-07-18 01:30:40","Tatita"),
("92","Complemento Nombre","Complemento Apellido","Colonia La Colonia Colonial","1212-1212","99999999-1","1","2020-07-01","1","Doking","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-07-18","2020-07-18 01:36:33","Tatita"),
("93","Lorena","Diaz","Colonia Ciudad Pacifica, Pol. 2-c #39","7363-6363","76541234-1","2","2020-11-11","1","Lorena","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-11-23","2020-11-23 22:19:35","Tatita"),
("94","Oscar","Barahona","Colonia Ciudad Pacifica, Pol. 2-c #39","7363-6363","12430987-2","1","2020-11-19","1","Oscarr","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-11-23","2020-11-23 22:20:13","Tatita");




/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;