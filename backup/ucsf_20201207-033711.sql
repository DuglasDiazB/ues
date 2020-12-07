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
  KEY `id_exam` (`id_exam`),
  CONSTRAINT `tblasistencias_ibfk_2` FOREIGN KEY (`id_exam`) REFERENCES `tblexamenes` (`id_exam`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



CREATE TABLE IF NOT EXISTS `tblcredenciales` (
  `id_creden` int(11) NOT NULL AUTO_INCREMENT,
  `id_manip` int(11) NOT NULL,
  `estado_creden` enum('Activo','Inactivo') COLLATE utf8_bin NOT NULL,
  `fecha_emis_creden` date DEFAULT NULL,
  `fecha_exped_creden` date DEFAULT NULL,
  PRIMARY KEY (`id_creden`),
  KEY `id_manip` (`id_manip`),
  CONSTRAINT `tblcredenciales_ibfk_1` FOREIGN KEY (`id_manip`) REFERENCES `tblmanipuladores` (`id_manip`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



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
  KEY `id_manip` (`id_manip`),
  CONSTRAINT `tblexamenes_ibfk_1` FOREIGN KEY (`id_manip`) REFERENCES `tblmanipuladores` (`id_manip`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



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
  KEY `id_estab` (`id_estab`),
  CONSTRAINT `tblinspecciones_ibfk_1` FOREIGN KEY (`id_estab`) REFERENCES `tblestablecimientos` (`id_estab`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



CREATE TABLE IF NOT EXISTS `tbllog` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(100) COLLATE utf8_bin NOT NULL,
  `metodo` varchar(6) COLLATE utf8_bin NOT NULL,
  `direccion_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `usuario_log` varchar(50) COLLATE utf8_bin NOT NULL,
  `fecha_log` datetime NOT NULL,
  `respuesta_log` enum('Exitosa','No exitosa') COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB AUTO_INCREMENT=185 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



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
  KEY `id_estab` (`id_estab`),
  CONSTRAINT `tblmanipuladores_ibfk_1` FOREIGN KEY (`id_estab`) REFERENCES `tblestablecimientos` (`id_estab`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



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
  KEY `idtipousuario` (`idtipousuario`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idtipousuario`) REFERENCES `tipousuarios` (`idtipousuario`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


INSERT INTO tblasistencias VALUES
("12","19","Si","2020-12-06","Tatita","2020-12-06 15:46:06"),
("13","20","No","0000-00-00","NULL","0000-00-00 00:00:00"),
("14","21","Si","0000-00-00","NULL","0000-00-00 00:00:00"),
("15","22","Si","0000-00-00","NULL","0000-00-00 00:00:00"),
("16","23","Si","0000-00-00","NULL","0000-00-00 00:00:00"),
("17","25","No","0000-00-00","NULL","0000-00-00 00:00:00");



INSERT INTO tblcredenciales VALUES
("9","22","Activo","2020-12-06","2021-12-06"),
("10","23","Inactivo","0000-00-00","0000-00-00"),
("11","24","Inactivo","0000-00-00","0000-00-00"),
("12","25","Inactivo","0000-00-00","0000-00-00"),
("13","26","Inactivo","0000-00-00","0000-00-00"),
("15","28","Inactivo","0000-00-00","0000-00-00");



INSERT INTO tblestablecimientos VALUES
("20","Pupuseria Roxy","00900909-9","Tomas Jose","Acosta Campo","Colonia ciudad pacifica Pol C","Pupuseria","Formal","D","7954-0125","San Miguel","San Miguel","Activo","2020-12-06","2020-12-06 20:14:40","Tatita"),
("21","Burguerking","00900909-9","Duglas","Diaz","Colonia ciudad pacifica Pol C","Restaurante","Informal","B","7485-8965","San Miguel","San Miguel","Activo","2020-12-06","2020-12-06 20:22:15","Tatita");



INSERT INTO tblexamenes VALUES
("19","22","2020-12-06","FN","FN","2020-12-06","DN","DN","Acto","2021-06-06","2020-12-06 12:34:25","Tatita"),
("20","23","","No entregado","No entregado","","No entregado","No entregado","No acto","","",""),
("21","24","","No entregado","No entregado","","No entregado","No entregado","No acto","","",""),
("22","25","","No entregado","No entregado","","No entregado","No entregado","No acto","","",""),
("23","26","","No entregado","No entregado","","No entregado","No entregado","No acto","","",""),
("25","28","","No entregado","No entregado","","No entregado","No entregado","No acto","","","");






INSERT INTO tblinspecciones VALUES
("30","Autorización nueva","","Tramite de permiso","Maria Yanci Martinez Garcia","","","","","","20");



INSERT INTO tbllog VALUES
("158","establecimientos/nuevoEstablecimiento","POST","::1","Tatita","2020-12-06 12:31:52","No exitosa"),
("159","establecimientos/nuevoEstablecimiento","POST","::1","Tatita","2020-12-06 12:31:58","Exitosa"),
("160","manipuladores/nuevoManipulador","POST","::1","Tatita","2020-12-06 12:33:20","Exitosa"),
("161","examenes/actualizarExamen/","POST","::1","Tatita","2020-12-06 12:33:59","Exitosa"),
("162","examenes/actualizarExamen/","POST","::1","Tatita","2020-12-06 12:34:25","Exitosa"),
("163","asistencias/fechaCapacitacion","POST","::1","Tatita","2020-12-06 15:43:09","No exitosa"),
("164","asistencias/fechaCapacitacion","POST","::1","Tatita","2020-12-06 15:43:28","No exitosa"),
("165","asistencias/fechaCapacitacion","POST","::1","Tatita","2020-12-06 15:43:30","No exitosa"),
("166","asistencias/actualizarAsistencia/","POST","::1","Tatita","2020-12-06 15:46:06","Exitosa"),
("167","manipuladores/actualizarManipulador/22","POST","::1","Tatita","2020-12-06 19:31:20","Exitosa"),
("168","manipuladores/actualizarManipulador/22","POST","::1","Tatita","2020-12-06 19:31:55","Exitosa"),
("169","manipuladores/actualizarManipulador/22","POST","::1","Tatita","2020-12-06 19:32:08","Exitosa"),
("170","manipuladores/nuevoManipulador","POST","::1","Tatita","2020-12-06 19:34:49","Exitosa"),
("171","manipuladores/nuevoManipulador","POST","::1","Tatita","2020-12-06 19:46:05","Exitosa"),
("172","manipuladores/nuevoManipulador","POST","::1","Tatita","2020-12-06 19:47:11","Exitosa"),
("173","manipuladores/nuevoManipulador","POST","::1","Tatita","2020-12-06 19:48:13","Exitosa"),
("174","manipuladores/nuevoManipulador","POST","::1","Tatita","2020-12-06 20:09:31","Exitosa"),
("175","manipuladores/actualizarManipulador/22","POST","::1","Tatita","2020-12-06 20:12:30","Exitosa"),
("176","manipuladores/actualizarManipulador/24","POST","::1","Tatita","2020-12-06 20:12:52","Exitosa"),
("177","manipuladores/actualizarManipulador/24","POST","::1","Tatita","2020-12-06 20:13:30","Exitosa"),
("178","establecimientos/actualizarEstablecimiento/20","POST","::1","Tatita","2020-12-06 20:14:40","Exitosa"),
("179","inspecciones/nuevaInspeccion","POST","::1","Tatita","2020-12-06 20:18:28","Exitosa"),
("180","inspecciones/actualizarInspeccion/30","POST","::1","Tatita","2020-12-06 20:18:52","Exitosa"),
("181","inspecciones/actualizarInspeccion/30","POST","::1","Tatita","2020-12-06 20:19:02","Exitosa"),
("182","establecimientos/nuevoEstablecimiento","POST","::1","Tatita","2020-12-06 20:22:11","No exitosa"),
("183","establecimientos/nuevoEstablecimiento","POST","::1","Tatita","2020-12-06 20:22:15","Exitosa"),
("184","inspecciones/actualizarInspeccion/30","POST","::1","Tatita","2020-12-06 20:23:19","No exitosa");



INSERT INTO tblmanipuladores VALUES
("22","76523212-3","Jesus David","Alvarado Barbosa","Hombre","1990-12-31","Cocinero","","Activo","20","2020-12-06","2020-12-06 20:12:30","Tatita","Si"),
("23","02098765-3","Erick","Lopez","Hombre","1999-05-10","Chef","","Activo","20","2020-12-06","2020-12-06 19:34:49","Tatita","Si"),
("24","09564321-9","Yanci","Martinez","Mujer","2000-09-09","Cocinero","","Activo","20","2020-12-06","2020-12-06 20:13:30","Tatita","Si"),
("25","04891509-2","Duglas","Diaz","Hombre","1993-09-20","Cajero","","Activo","20","2020-12-06","2020-12-06 19:47:11","Tatita","No"),
("26","09875432-1","Luis","Hernandez","Hombre","1993-12-12","Chef","","Activo","20","2020-12-06","2020-12-06 19:48:13","Tatita","No"),
("28","65431209-2","Jorge","Sanchez","Hombre","1990-12-12","Chef","","Activo","20","2020-12-06","2020-12-06 20:09:31","Tatita","Si");



INSERT INTO tipousuarios VALUES
("1","Administrador"),
("2","Usuario Normal");



INSERT INTO usuarios VALUES
("1","Luis Fernando","Hernandez Castillo","Col. Via Satelite Av. Reginal Casa # 11","7975-4615","00000000-1","1","1990-04-19","2","Administrador","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-06-09","2020-08-14 12:20:19","Tatita"),
("2","Maria Yanci","Martinez Garcia","San Francisco Gotera, Morazan","7392-7419","12345678-6","2","1994-03-07","1","Tatita","3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2","1","2020-03-03","2020-10-19 21:29:23","Admin");




/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;