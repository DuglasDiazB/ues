-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-11-2020 a las 03:39:21
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ucsf`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblasistencias`
--

CREATE TABLE `tblasistencias` (
  `id_asistencia` int(11) NOT NULL,
  `id_exam` int(11) NOT NULL,
  `asistencia` enum('Si','No') COLLATE utf8_bin NOT NULL,
  `fecha_asist_capacit` date DEFAULT NULL,
  `usermod` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `fechamodasistencia` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tblasistencias`
--

INSERT INTO `tblasistencias` (`id_asistencia`, `id_exam`, `asistencia`, `fecha_asist_capacit`, `usermod`, `fechamodasistencia`) VALUES
(11, 21, 'No', NULL, NULL, '2020-11-25 19:30:48'),
(12, 22, 'Si', '2020-11-28', 'Tatita', '2020-11-28 09:34:00'),
(13, 23, 'Si', '2020-11-25', 'Tatita', '2020-11-25 19:31:38'),
(14, 24, 'Si', '2020-11-28', 'Tatita', '2020-11-28 09:39:25'),
(15, 25, 'No', NULL, NULL, NULL),
(16, 26, 'No', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcredenciales`
--

CREATE TABLE `tblcredenciales` (
  `id_creden` int(11) NOT NULL,
  `id_manip` int(11) NOT NULL,
  `estado_creden` enum('Activo','Inactivo') COLLATE utf8_bin NOT NULL,
  `fecha_emis_creden` date DEFAULT NULL,
  `fecha_exped_creden` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tblcredenciales`
--

INSERT INTO `tblcredenciales` (`id_creden`, `id_manip`, `estado_creden`, `fecha_emis_creden`, `fecha_exped_creden`) VALUES
(9, 26, 'Inactivo', NULL, NULL),
(10, 27, 'Activo', '2020-11-28', '2021-11-28'),
(11, 28, 'Activo', '2020-11-28', '2021-11-28'),
(12, 29, 'Inactivo', NULL, NULL),
(13, 30, 'Inactivo', NULL, NULL),
(14, 31, 'Inactivo', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblestablecimientos`
--

CREATE TABLE `tblestablecimientos` (
  `id_estab` int(11) NOT NULL,
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
  `usermod` varchar(15) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tblestablecimientos`
--

INSERT INTO `tblestablecimientos` (`id_estab`, `nombre_estab`, `dui_prop`, `nombre_prop`, `apellido_prop`, `direccion_estab`, `cat_estab`, `tipo_estab`, `apartado_especifico`, `telefono_estab`, `municipio_estab`, `departamento_estab`, `estado_estab`, `fecha_reg_estab`, `fecha_mod_estab`, `usermod`) VALUES
(1, 'Wendys', '12345678-8', 'Luis Fernando', 'Hernandez', 'San Miguel', 'Restaurante', 'Formal', 'A', '1111-1111', 'San Miguel', 'San Miguel', 'Inactivo', '2020-11-23', '2020-11-23 22:08:34', 'Tatita'),
(2, 'Wendys', '12345678-8', 'Luis', 'Hernandez', 'San Miguel', 'Restaurante', 'Formal', 'A', '1111-1111', 'San Miguel', 'San Miguel', 'Inactivo', '2020-11-18', '2020-11-18 22:06:08', 'Tatita'),
(3, 'Kentucky Fried Chicken KFC', '12345678-8', 'Erick', 'Joya', 'San Miguel', 'Restaurante', 'Informal', 'A', '1111-1111', 'San Miguel', 'San Miguel', 'Activo', '2020-11-24', '2020-11-24 14:37:14', 'Tatita'),
(4, 'Pollo Campero', '12345678-8', 'Yanci', 'Martinez', 'San Miguel', 'Restaurante', 'Formal', 'A', '1111-1111', 'San Miguel', 'San Miguel', 'Activo', '2020-11-23', '2020-11-23 22:22:59', 'Tatita'),
(5, 'Pasteleria Lorena', '12345678-8', 'Douglas', 'Diaz', 'San Miguel', 'Restaurante', 'Formal', 'A', '1111-1111', 'San Miguel', 'San Miguel', 'Activo', '2020-11-23', '2020-11-23 22:23:29', 'Tatita'),
(6, 'Burguerking', '12345678-8', 'Yesenia', 'Bolaos', 'San Miguel', 'Restaurante', 'Informal', 'A', '1111-1111', 'San Miguel', 'San Miguel', 'Activo', '2020-11-23', '2020-11-23 22:24:06', 'Tatita'),
(7, 'Wendys', '12345678-8', 'Luis', 'Hernandez', 'San Miguel', 'Restaurante', 'Formal', 'A', '1111-1111', 'San Miguel', 'San Miguel', 'Activo', '2020-11-18', '2020-11-18 22:06:08', 'Tatita'),
(8, 'Wendys', '12345678-8', 'Luis', 'Hernandez', 'San Miguel', 'Restaurante', 'Formal', 'A', '1111-1111', 'San Miguel', 'San Miguel', 'Activo', '2020-11-18', '2020-11-18 22:06:08', 'Tatita'),
(9, 'Wendys', '12345678-8', 'Luis', 'Hernandez', 'San Miguel', 'Restaurante', 'Formal', 'A', '1111-1111', 'San Miguel', 'San Miguel', 'Activo', '2020-11-18', '2020-11-18 22:06:08', 'Tatita'),
(10, 'Wendys', '12345678-8', 'Luis', 'Hernandez', 'San Miguel', 'Restaurante', 'Formal', 'A', '1111-1111', 'San Miguel', 'San Miguel', 'Activo', '2020-11-18', '2020-11-18 22:06:08', 'Tatita'),
(11, 'Wendys', '12345678-8', 'Luis', 'Hernandez', 'San Miguel', 'Restaurante', 'Formal', 'A', '1111-1111', 'San Miguel', 'San Miguel', 'Activo', '2020-11-18', '2020-11-18 22:06:08', 'Tatita'),
(12, 'Wendys', '12345678-8', 'Luis', 'Hernandez', 'San Miguel', 'Restaurante', 'Formal', 'A', '1111-1111', 'San Miguel', 'San Miguel', 'Activo', '2020-11-18', '2020-11-18 22:06:08', 'Tatita'),
(13, 'Wendys', '12345678-8', 'Luis', 'Hernandez', 'San Miguel', 'Restaurante', 'Formal', 'A', '1111-1111', 'San Miguel', 'San Miguel', 'Activo', '2020-11-18', '2020-11-18 22:06:08', 'Tatita'),
(14, 'Wendys', '12345678-8', 'Luis', 'Hernandez', 'San Miguel', 'Restaurante', 'Formal', 'A', '1111-1111', 'San Miguel', 'San Miguel', 'Inactivo', '2020-11-18', '2020-11-18 22:06:08', 'Tatita'),
(15, 'Wendys', '12345678-8', 'Luis', 'Hernandez', 'San Miguel', 'Restaurante', 'Formal', 'A', '1111-1111', 'San Miguel', 'San Miguel', 'Activo', '2020-11-18', '2020-11-18 22:06:08', 'Tatita'),
(16, 'La fonda de doa florinda', '00900909-9', 'Florinda', 'Mesa', 'Colonia ciudad pacifica Pol C', 'Fonda', 'Informal', 'A', '0909-0909', 'San Miguel', 'San Miguel', 'Activo', '2020-11-18', '2020-11-18 22:30:09', 'Tatita'),
(17, 'Pupuseria Roxi', '12091287-3', 'Roxana', 'De la O', 'Colonia ciudad pacifica Pol C', 'Pupuseria', 'Formal', 'A', '0909-0909', 'San Miguel', 'San Miguel', 'Activo', '2020-11-23', '2020-11-23 22:17:29', 'Tatita'),
(18, 'Wendys', '65123454-0', 'Julio', 'Cesar', 'Colonia ciudad pacifica Pol C', 'Fonda', 'Formal', 'A', '0909-0909', 'San Miguel', 'San Miguel', 'Activo', '2020-11-24', '2020-11-24 13:50:28', 'Tatita'),
(19, 'ejemplo', '12345678-1', 'Juan', 'Perez', 'Direccion de ejemplo', 'restaurante', 'Informal', 'B', '7777-7777', 'San Miguel', 'San Miguel', 'Inactivo', '2020-11-25', '2020-11-25 19:22:35', 'Tatita');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblexamenes`
--

CREATE TABLE `tblexamenes` (
  `id_exam` int(11) NOT NULL,
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
  `usermod` varchar(15) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tblexamenes`
--

INSERT INTO `tblexamenes` (`id_exam`, `id_manip`, `fecha_entrega_so`, `exam_s`, `exam_o`, `fecha_entrega_so2`, `exam_s2`, `exam_o2`, `estado_exam`, `fecha_exped_exam`, `fechamodexamen`, `usermod`) VALUES
(21, 26, '2020-11-25', 'DN', 'FN', '2020-11-25', 'DN', 'DN', 'Acto', '2020-12-05', '2020-11-25 15:32:06', 'Tatita'),
(22, 27, '2020-11-28', 'FN', 'DN', '2020-11-28', 'DN', 'DN', 'Acto', '2020-12-02', '2020-11-28 10:05:49', 'Tatita'),
(23, 28, '2020-11-25', 'DN', 'FN', '2020-11-30', 'DN', 'DN', 'Acto', '2020-11-28', '2020-11-25 19:28:27', 'Tatita'),
(24, 29, NULL, 'No entregado', 'No entregado', NULL, 'No entregado', 'No entregado', 'No acto', NULL, NULL, NULL),
(25, 30, '2020-11-28', 'DN', 'DN', NULL, 'No entregado', 'No entregado', 'Acto', '2021-05-28', '2020-11-28 10:04:21', 'Tatita'),
(26, 31, NULL, 'No entregado', 'No entregado', NULL, 'No entregado', 'No entregado', 'No acto', NULL, NULL, NULL);

--
-- Disparadores `tblexamenes`
--
DELIMITER $$
CREATE TRIGGER `after_exam_insert_on_asistencia` AFTER INSERT ON `tblexamenes` FOR EACH ROW INSERT INTO tblasistencias(id_exam, asistencia)
        VALUES(new.id_exam, 'No')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblfechacapacitaciones`
--

CREATE TABLE `tblfechacapacitaciones` (
  `id_fechacapacit` int(11) NOT NULL,
  `fecha_inicio_capacit` date DEFAULT NULL,
  `fecha_fin_capacit` date DEFAULT NULL,
  `fechamodcapacit` datetime DEFAULT NULL,
  `usermod` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `ejecutado` enum('Si','No') COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tblfechacapacitaciones`
--

INSERT INTO `tblfechacapacitaciones` (`id_fechacapacit`, `fecha_inicio_capacit`, `fecha_fin_capacit`, `fechamodcapacit`, `usermod`, `ejecutado`) VALUES
(1, '2020-11-25', '2020-11-28', '2020-11-25 19:30:48', 'Tatita', 'Si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblinspecciones`
--

CREATE TABLE `tblinspecciones` (
  `id_inspec` int(11) NOT NULL,
  `inspec_para` enum('Autorización nueva','Renovación','Control') COLLATE utf8_bin NOT NULL,
  `fecha_inspec` date DEFAULT NULL,
  `objeto_visita` enum('Tramite de permiso','Inspección de control','Denuncia') COLLATE utf8_bin NOT NULL,
  `nombre_inspector` varchar(50) COLLATE utf8_bin NOT NULL,
  `cal_primer_inspec` float DEFAULT NULL,
  `primer_reinspec_fecha` date DEFAULT NULL,
  `primer_reinspec_cal` float DEFAULT NULL,
  `segunda_reinspec_fecha` date DEFAULT NULL,
  `segunda_reinspec_cal` float DEFAULT NULL,
  `id_estab` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tblinspecciones`
--

INSERT INTO `tblinspecciones` (`id_inspec`, `inspec_para`, `fecha_inspec`, `objeto_visita`, `nombre_inspector`, `cal_primer_inspec`, `primer_reinspec_fecha`, `primer_reinspec_cal`, `segunda_reinspec_fecha`, `segunda_reinspec_cal`, `id_estab`) VALUES
(8, 'Control', '2020-08-19', 'Denuncia', 'Maria Yanci Martinez Garcia', 9, '2020-08-19', 9, '2020-08-19', 9, 1),
(15, 'Renovación', '2020-09-14', 'Inspección de control', 'Maria Yanci Martinez Garcia', 5, '2020-09-14', 8, '2020-09-07', 8, 2),
(16, 'Control', '2020-09-22', 'Denuncia', 'Maria Yanci Martinez Garcia', 4, '2020-09-15', 4, '2020-09-21', 7, 3),
(17, 'Autorización nueva', '2020-09-17', 'Tramite de permiso', 'Maria Yanci Martinez Garcia', 5, '2020-09-17', 4, '2020-09-10', 8, 5),
(18, 'Autorización nueva', '2020-09-08', 'Tramite de permiso', 'Maria Yanci Martinez Garcia', 5, '2020-09-08', 8, '2020-09-07', 5, 4),
(19, 'Autorización nueva', '2020-09-15', 'Tramite de permiso', 'Maria Yanci Martinez Garcia', 7, '2020-09-08', 7, '2020-09-01', 5, 6),
(20, 'Autorización nueva', '2020-09-23', 'Tramite de permiso', 'Maria Yanci Martinez Garcia', 6, '2020-09-08', 8, '2020-09-09', 4, 7),
(21, 'Renovación', '2020-09-15', 'Inspección de control', 'Maria Yanci Martinez Garcia', 7, '2020-09-08', 5, '2020-09-23', 8, 8),
(22, 'Autorización nueva', '2020-09-15', 'Tramite de permiso', 'Maria Yanci Martinez Garcia', 7, '2020-09-14', 5, '2020-09-08', 8, 9),
(23, 'Control', '2020-09-15', 'Denuncia', 'Maria Yanci Martinez Garcia', 7, '2020-09-22', 5, '2020-09-07', 8, 10),
(24, 'Autorización nueva', '2020-09-15', 'Tramite de permiso', 'Maria Yanci Martinez Garcia', 4, '2020-09-22', 4, '2020-09-15', 8, 11),
(25, 'Control', '2020-09-15', 'Inspección de control', 'Maria Yanci Martinez Garcia', 7, '2020-09-15', 5, '2020-09-10', 8, 12),
(26, 'Renovación', '2020-10-30', 'Inspección de control', 'Maria Yanci Martinez Garcia', 98, '2020-10-30', 98, NULL, NULL, 13),
(27, 'Autorización nueva', '2020-11-25', 'Tramite de permiso', 'Maria Yanci Martinez Garcia', 68, '2020-11-25', 68, '2020-11-25', 98, 14),
(28, 'Renovación', '2020-11-25', 'Tramite de permiso', 'Maria Yanci Martinez Garcia', 50, '2020-11-25', 50, '2020-11-25', 50, 19),
(29, 'Autorización nueva', '2020-11-29', 'Tramite de permiso', 'Maria Yanci Martinez Garcia', 0, NULL, NULL, NULL, NULL, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbllog`
--

CREATE TABLE `tbllog` (
  `id_log` int(11) NOT NULL,
  `uri` varchar(100) COLLATE utf8_bin NOT NULL,
  `metodo` varchar(6) COLLATE utf8_bin NOT NULL,
  `direccion_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `usuario_log` varchar(50) COLLATE utf8_bin NOT NULL,
  `fecha_log` datetime NOT NULL,
  `respuesta_log` enum('Exitosa','No exitosa') COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbllog`
--

INSERT INTO `tbllog` (`id_log`, `uri`, `metodo`, `direccion_ip`, `usuario_log`, `fecha_log`, `respuesta_log`) VALUES
(1, '/ues/bitacoras', 'GET', '192.168.0.1', 'yanci', '2020-08-12 17:57:46', 'Exitosa'),
(4, '/ues/inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-08-22 19:08:21', 'No exitosa'),
(5, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-08-22 19:18:50', 'No exitosa'),
(6, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-09-10 17:01:03', 'No exitosa'),
(7, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-09-10 17:02:01', 'Exitosa'),
(8, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-09-10 18:43:43', 'No exitosa'),
(9, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-09-10 18:47:46', 'No exitosa'),
(10, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-09-10 18:49:12', 'No exitosa'),
(11, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-09-12 15:47:10', 'Exitosa'),
(12, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-09-13 18:29:21', 'Exitosa'),
(13, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-09-13 18:29:57', 'Exitosa'),
(14, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Fercastle', '2020-09-13 18:33:08', 'Exitosa'),
(15, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Fercastle', '2020-09-13 18:34:44', 'Exitosa'),
(16, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-09-13 19:01:27', 'No exitosa'),
(17, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-09-13 19:01:33', 'No exitosa'),
(18, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-09-13 19:02:07', 'No exitosa'),
(19, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-09-13 19:02:12', 'No exitosa'),
(20, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-09-13 19:02:18', 'No exitosa'),
(21, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-09-13 19:07:30', 'No exitosa'),
(22, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-09-13 19:07:37', 'No exitosa'),
(23, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-09-13 20:52:55', 'No exitosa'),
(24, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-09-17 19:25:23', 'No exitosa'),
(25, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-09-17 19:51:07', 'Exitosa'),
(26, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-09-17 19:51:49', 'Exitosa'),
(27, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-09-20 21:16:23', 'Exitosa'),
(28, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-09-25 13:48:52', 'Exitosa'),
(29, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-09-25 13:49:19', 'Exitosa'),
(30, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-09-25 13:49:21', 'No exitosa'),
(31, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-09-25 13:49:52', 'Exitosa'),
(32, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-09-25 13:50:12', 'Exitosa'),
(33, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-09-25 13:50:45', 'Exitosa'),
(34, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-09-25 13:51:26', 'Exitosa'),
(35, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-09-25 13:52:02', 'Exitosa'),
(36, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-09-25 13:52:34', 'Exitosa'),
(37, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-10-26 15:36:41', 'No exitosa'),
(38, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-10-26 16:01:06', 'Exitosa'),
(39, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-10-27 14:34:37', 'No exitosa'),
(40, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-11-13 10:53:32', 'Exitosa'),
(41, 'asistencias/actualizarAsistencia/', 'POST', '::1', 'Tatita', '2020-11-25 15:36:09', 'Exitosa'),
(42, 'asistencias/actualizarAsistencia/', 'POST', '::1', 'Tatita', '2020-11-25 15:36:52', 'Exitosa'),
(43, 'asistencias/actualizarAsistencia/', 'POST', '::1', 'Tatita', '2020-11-25 15:41:42', 'Exitosa'),
(44, 'asistencias/actualizarAsistencia/', 'POST', '::1', 'Tatita', '2020-11-25 15:41:48', 'Exitosa'),
(45, 'asistencias/actualizarAsistencia/', 'POST', '::1', 'Tatita', '2020-11-25 15:58:23', 'Exitosa'),
(46, 'asistencias/actualizarAsistencia/', 'POST', '::1', 'Tatita', '2020-11-25 19:26:41', 'Exitosa'),
(47, 'asistencias/actualizarAsistencia/', 'POST', '::1', 'Tatita', '2020-11-25 19:31:38', 'Exitosa'),
(48, 'inspecciones/nuevaInspeccion', 'POST', '::1', 'Tatita', '2020-11-25 19:34:12', 'Exitosa'),
(49, 'asistencias/actualizarAsistencia/', 'POST', '::1', 'Tatita', '2020-11-28 09:34:00', 'Exitosa'),
(50, 'asistencias/actualizarAsistencia/', 'POST', '::1', 'Tatita', '2020-11-28 09:39:26', 'Exitosa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblmanipuladores`
--

CREATE TABLE `tblmanipuladores` (
  `id_manip` int(11) NOT NULL,
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
  `asistencia_check` enum('Si','No') COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tblmanipuladores`
--

INSERT INTO `tblmanipuladores` (`id_manip`, `dui_manip`, `nombre_manip`, `apellido_manip`, `genero_manip`, `fecha_nacim_manip`, `puesto_manip`, `token`, `estado_manip`, `id_estab`, `fecha_registro_manip`, `fecha_mod_manip`, `usermod`, `asistencia_check`) VALUES
(26, '12345678-0', 'Luis Fernando', 'Hernadez Castillo', 'Hombre', '2020-11-25', 'Cocinero', NULL, 'Activo', 1, '2020-11-25', '2020-11-25 14:12:12', 'Tatita', 'Si'),
(27, '12345678-1', 'Maria Yanci', 'Martinez Garcia', 'Hombre', '2020-11-25', 'Vendedora', 'eyVRmGaATlWI3qKNjAMqzJ:APA91bGqOsW6EHNnhxHIlo6gyOvXQv9KbLPE03Wwp3xKp9Iuj8GwTcxhZeqktKXPiMeQvTlTWNC7ycm_4lArLx-vCnNHJGC-XWnfc8N6ktzNf9MvuuCqwXPjXEFYj3XV91YE7WEDflz2', 'Activo', 17, '2020-11-25', '2020-11-25 18:47:24', 'Tatita', 'Si'),
(28, '12345678-2', 'Juan', 'Perez', 'Hombre', '2020-11-28', 'Cocinero', NULL, 'Activo', 3, '2020-11-28', '2020-11-28 09:32:26', 'Tatita', 'Si'),
(29, '12345678-3', 'Duglas Enrique', 'Diaz Barahona', 'Hombre', '2020-11-28', 'Panificador', NULL, 'Activo', 3, '2020-11-28', '2020-11-28 09:38:25', 'Tatita', 'Si'),
(30, '12345678-4', 'Erick Adalberto', 'Lopez', 'Hombre', '1995-11-01', 'Vendedor', NULL, 'Activo', 5, '2020-11-28', '2020-11-28 10:04:04', 'Tatita', 'Si'),
(31, '12345678-5', 'Diana Marcela', 'Hernandez', 'Hombre', '1995-01-02', 'Cocinero', NULL, 'Activo', 16, '2020-11-28', '2020-11-28 10:09:06', 'Tatita', 'Si');

--
-- Disparadores `tblmanipuladores`
--
DELIMITER $$
CREATE TRIGGER `after_manip_insert_on_credenciales` AFTER INSERT ON `tblmanipuladores` FOR EACH ROW INSERT INTO tblcredenciales(id_manip, estado_creden)
        VALUES(new.id_manip, 'Inactivo')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_manipulador_insert_on_exam` AFTER INSERT ON `tblmanipuladores` FOR EACH ROW INSERT INTO tblexamenes(id_manip, exam_s, exam_o, exam_s2, exam_o2, estado_exam)
        VALUES(new.id_manip, 'No entregado', 'No entregado', 'No entregado', 'No entregado', 'No acto')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuarios`
--

CREATE TABLE `tipousuarios` (
  `idtipousuario` int(11) NOT NULL,
  `tipousuario` varchar(15) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tipousuarios`
--

INSERT INTO `tipousuarios` (`idtipousuario`, `tipousuario`) VALUES
(1, 'Administrador'),
(2, 'Usuario Normal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
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
  `usermod` varchar(15) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nombreusuario`, `apellidousuario`, `direccionusuario`, `telefonousuario`, `duiusuario`, `sexousuario`, `fechanacimientousuario`, `estadousuario`, `username`, `password`, `idtipousuario`, `fecharegistro`, `fechamodusuario`, `usermod`) VALUES
(1, 'Luis Fernando', 'Hernandez Castillo', 'Col. Via Satelite Av. Reginal Casa # 11', '7975-4615', '00000000-1', 1, '1990-04-19', 2, 'Administrador', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-09', '2020-08-14 12:20:19', 'Tatita'),
(2, 'Maria Yanci', 'Martinez Garcia', 'San Francisco Gotera, Morazan', '7392-7419', '12345678-6', 2, '1994-03-07', 1, 'Tatita', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-03-03', '2020-10-19 21:29:23', 'Admin'),
(3, 'nombre', 'apellido', 'Direccion 1', '7777-7777', '123456789', 1, '1990-03-19', 1, 'User Name 1', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-03-27', '2020-07-18 18:47:27', 'Belisario'),
(4, 'nombre 2', 'apellido 2', 'direccion 2', '1234567', '12334567', 1, '1994-03-07', 1, 'username2', '123', 1, '2020-03-27', '0000-00-00 00:00:00', ''),
(5, 'nombre 3', 'apellido 3', 'direccion 3', '122344556', '12123543', 1, '1990-03-19', 1, 'user name 2', '123456', 1, '2020-03-27', '0000-00-00 00:00:00', ''),
(6, 'nombre 4', 'apellido 4', 'direccion 4', '1234', '123', 1, '1994-03-07', 1, 'username4', '123', 1, '2020-03-27', '0000-00-00 00:00:00', ''),
(8, 'nombre 7', 'apellido 67', 'direccion 7', '122344556', '123456789', 1, '1990-03-19', 1, 'username 7', '123', 1, '2020-03-27', '0000-00-00 00:00:00', ''),
(9, 'nombre 8', 'apellido 8', 'direccion 8', '1234', '123', 1, '2000-03-27', 1, 'username 8', '123456', 1, '2020-03-27', '0000-00-00 00:00:00', ''),
(10, 'Nelson Belisario', 'Hernandez Mendez', 'Col. Via. Satelite Av. Regional Casa #11', '7878-7878', '09876543-1', 1, '1969-04-09', 1, 'Belisario', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-03-31', '2020-07-18 18:43:14', 'Tatita'),
(11, 'Berta Luz', 'Castillo', 'Col. Via Satelite Av. Regional Casa #11', '7171-7171', '65432178-0', 1, '1970-03-21', 1, 'Luz', '123', 1, '2020-03-31', '0000-00-00 00:00:00', ''),
(12, 'Diana Marcela ', 'Hernandez Castillo', 'Col. VIa. Satelite Av. Buenos Aires Casa # 11', '7979-7979', '78695043-1', 1, '1994-02-03', 1, 'dianam', '123', 1, '2020-03-31', '0000-00-00 00:00:00', ''),
(13, 'Nelson Alexander', 'Hernandez Castillo', 'Col. Via Satelite Av. Buenos Aires Casa #11', '7272-7272', '01010101-1', 1, '1988-11-10', 1, 'Nelson', '123', 1, '2020-03-31', '0000-00-00 00:00:00', ''),
(14, 'Duglas Enrrique', 'Díaz Barahona', 'Ciudad Pacifica Bloque # 3 Pasaje # 7', '7575-7575', '90909090-2', 1, '1993-07-12', 1, 'duglas', '123', 1, '2020-03-31', '0000-00-00 00:00:00', ''),
(15, 'Erick Adalberto', 'López Joya', 'Usulutan', '7676-7676', '34343434-0', 1, '1995-06-11', 1, 'erick', '123', 1, '2020-03-31', '0000-00-00 00:00:00', ''),
(16, 'Giorgio Churruca', 'Uceda', 'Puerta Nueva, 78\r\n35560 Tinajo ', '7796-9680', '29072206-1', 1, '1991-11-28', 1, 'churruca', '123', 1, '2020-03-31', '0000-00-00 00:00:00', ''),
(17, 'Nilce Ozuna ', 'Salcedo', 'La Fontanilla, 46\r\n14470 El Viso ', '6245-8183', '38549224-2', 1, '1937-03-04', 1, 'ozuna', '123', 1, '2020-03-31', '0000-00-00 00:00:00', ''),
(18, 'Ansaldo ', 'Granados Hinojosa', 'Celso Emilio Ferreiro, 80\r\n50520 Magallón ', '6749-6099', '41925631-0', 1, '1973-10-28', 1, 'ansaldo', '123', 1, '2020-03-31', '0000-00-00 00:00:00', ''),
(19, 'Boris ', 'Montano Tirado', 'Camiño Ancho, 3\r\n37790 Fuentes de Béjar ', '7128-0813', '40438106-1', 1, '1949-06-24', 1, 'tirado', '123', 1, '2020-03-31', '0000-00-00 00:00:00', ''),
(20, 'Celestino ', 'Santillán Pagan', 'Calvo Sotelo, 71\r\n47300 Peñafiel ', '6134-0177', '41543381-0', 1, '1998-07-26', 1, 'celestino', '123', 1, '2020-03-31', '0000-00-00 00:00:00', ''),
(21, 'Cannan ', 'Melgar Estévez', 'Calle Proc. San Sebastián, 81\r\n13110 Horcajo de los Montes ', '6960-3803', '39329877-0', 1, '1960-09-14', 1, 'cannan', '123', 1, '2020-03-31', '0000-00-00 00:00:00', ''),
(22, 'Daff ', 'Zaragoza Centeno', 'Castelao, 81\r\n49155 La Bóveda de Toro ', '7924-3118', '41428817-1', 1, '1942-12-27', 1, 'daff', '123', 1, '2020-03-31', '0000-00-00 00:00:00', ''),
(23, 'Argenta ', 'Montez Verduzco', 'Cercas Bajas, 8\r\n08181 Sentmenat ', '7479-6297', '41611221-2', 1, '1945-11-18', 1, 'verduzco', '123', 1, '2020-03-31', '0000-00-00 00:00:00', ''),
(24, 'Iliana ', 'Salcido Zambrano', 'Antonio Vázquez, 74\r\n38712 Breña Baja ', '7767-7785', '28878258-1', 1, '1968-09-04', 1, 'salcido', '123', 1, '2020-03-31', '0000-00-00 00:00:00', ''),
(25, 'Aminta ', 'Alvarez Limón', 'Celso Emilio Ferreiro, 27\r\n50340 Maluenda ', '7321-7508', '41292273-0', 1, '1991-09-19', 1, 'aminta', '123', 1, '2020-03-31', '0000-00-00 00:00:00', ''),
(26, 'Eugene', 'Quiñones Botello', 'Avda. Los llanos, 29\r\n26259 Grañón ', '6007-4628', '42462934-1', 1, '1949-05-23', 1, 'botello', '123', 1, '2020-03-31', '0000-00-00 00:00:00', ''),
(27, 'Flaminia', 'Padilla Meza', 'Calle Aduana, 61\r\n01218 Berantevilla ', '7768-4634', '42699627-0', 1, '1960-03-07', 1, 'flamina', '123', 1, '2020-03-31', '0000-00-00 00:00:00', ''),
(28, 'Kalid', 'Pacheco Gaona', 'Plaza Colón, 87\r\n24420 Fabero ', '6958-2487', '42814122-0', 1, '1958-05-30', 1, 'kalid', '123', 1, '2020-03-31', '0000-00-00 00:00:00', ''),
(29, 'Griego', 'Juárez Venegas', 'Castelao, 28\r\n48710 Berriatua ', '6256-5328', '43258339-0', 1, '1988-02-22', 1, 'griego', '123', 2, '2020-03-31', '0000-00-00 00:00:00', ''),
(30, 'Helene', 'Curiel Almanza', 'Outid de Arriba, 30\r\n43560 La Sénia ', '7637-1247', '4057885-1', 1, '1978-04-03', 1, 'curiel', '123', 1, '2020-03-31', '0000-00-00 00:00:00', ''),
(31, 'Constance', 'Reséndez Amaya', 'Calle Carril de la Fuente, 92\r\n13200 Manzanares ', '7867-0018', '38907024-1', 1, '1989-05-04', 1, 'amaya', '123', 2, '2020-03-31', '0000-00-00 00:00:00', ''),
(32, 'Tiana ', 'Quintana Vázquez', 'Avda. Los llanos, 83\r\n26240 Castañares de Rioja', '6679-9744', '42576891-0', 1, '1985-12-02', 1, 'tiana', '123', 1, '2020-03-31', '0000-00-00 00:00:00', ''),
(33, 'Almira ', 'Matías Montero', 'Socampo, 44\r\n37630 Cabrillas ', '6559-7144', '4079699-0 ', 1, '1986-06-26', 1, 'almira', '123', 1, '2020-03-31', '0000-00-00 00:00:00', ''),
(34, 'Iracema', 'Parra Covas', 'Atamaria, 30\r\n36670 Cuntis ', '7650-0398', '42592489-1', 1, '1971-04-19', 1, 'iracema', '123', 2, '2020-03-31', '0000-00-00 00:00:00', ''),
(35, 'Cyndi', 'Rivas Tamayo', 'Ctra. Villena, 44\r\n34140 Villarramiel ', '64364-464', '4197-6183', 1, '1978-06-20', 1, 'cyndi', '123', 1, '2020-03-31', '0000-00-00 00:00:00', ''),
(36, 'Landolf', 'Guzmán Jáquez', 'Escuadro, 57\r\n46910 Sedaví ', '6489-5013', '39472701-0', 1, '1984-12-09', 1, 'landoft', '123', 1, '2020-03-31', '0000-00-00 00:00:00', ''),
(37, 'Homero', 'Toledo Linares', 'Ctra. de la Puerta, 72\r\n26587 Villarroya ', '6985-5090', '42192284-1', 1, '1979-09-25', 1, 'homero', '123456', 1, '2020-03-31', '0000-00-00 00:00:00', ''),
(38, 'Troilo', 'Saldana Salgado', 'C/ Libertad, 62\r\n05230 Las Navas del Marqués ', '6411-0458', '40546198-1', 1, '1975-05-20', 1, 'troilo', '123', 1, '2020-03-31', '0000-00-00 00:00:00', ''),
(39, 'Alterio', 'Galvez Lebrón', 'Plaza Colón, 73\r\n25000 Lleida ', '6407-0198', '41628899-1', 1, '1999-04-12', 1, 'lebron', '123', 1, '2020-03-31', '0000-00-00 00:00:00', ''),
(40, 'Friedrich', 'Lozada Urena', 'Carretera Cádiz-Málaga, 55\r\n20496 Bidegoyan ', '6381-6791', '4321687-0', 1, '1988-05-18', 1, 'friedrich', '123', 2, '2020-03-31', '0000-00-00 00:00:00', ''),
(41, 'nombre 8', 'apellido 8', 'direccion 8', '1234567', '123456789', 1, '1969-04-09', 1, 'username 8', '123', 1, '2020-03-23', '0000-00-00 00:00:00', ''),
(42, 'nombre 9', 'apellido 9', 'direccion 9', '7777-8888', '12334567', 1, '1970-03-21', 1, 'username 9', '123', 1, '2020-04-01', '0000-00-00 00:00:00', ''),
(43, 'nombre 9', 'apellido 9', 'direccion 9', '1234567', '123456789', 1, '1969-04-09', 1, 'username 9', '123', 1, '2020-04-01', '0000-00-00 00:00:00', ''),
(44, 'nombre 10', 'apellido 10', 'direccion 10', '7676-7676', '12334567', 1, '1937-03-04', 1, 'username 10', '123', 2, '2020-04-01', '0000-00-00 00:00:00', ''),
(45, 'nombre 11', 'apellido 11', 'direccion 11', '6007-4628', '42462934-1', 1, '1984-12-09', 1, 'user name 11', '4444', 1, '2020-04-01', '0000-00-00 00:00:00', ''),
(46, 'nombre 12', 'apellido 12', 'direccion 12', '6985-5090', '65432178-0', 1, '1995-06-11', 1, 'username 12', '555', 2, '2020-04-01', '0000-00-00 00:00:00', ''),
(47, 'Luis', 'Hernandez', 'coloni la colonia', '7796-9680', '09876543-1', 1, '1990-03-19', 1, 'fercastle', '123', 1, '2020-06-02', '0000-00-00 00:00:00', ''),
(48, 'Luis', 'Castillo', 'Col. Via. Satelite, Av. Regional', '7777-7777', '65432178-9', 1, '1990-04-19', 1, 'fmln', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-02', '0000-00-00 00:00:00', ''),
(49, 'Luis', 'Castillo', 'Col. Via. Satelite, Av. Regional', '7777-7777', '42462934-2', 1, '1990-04-19', 1, 'arena', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-02', '0000-00-00 00:00:00', ''),
(50, 'Luis', 'Hernandez', 'Col. Via. Satelite, Av. Regional', '7777-7777', '42462934-2', 1, '1990-04-19', 1, 'fercastle', '', 1, '2020-06-02', '0000-00-00 00:00:00', ''),
(51, 'Luis', 'Hernandez', 'Col. Via. Satelite, Av. Regional', '7777-7777', '42462934-3', 1, '1990-04-19', 1, 'fercastle', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-02', '0000-00-00 00:00:00', ''),
(52, 'Luis', 'Hernandez', 'Col. Via. Satelite, Av. Regional', '7777-7777', '42462934-3', 1, '1990-04-19', 1, 'fercastle', '', 1, '2020-06-02', '0000-00-00 00:00:00', ''),
(53, 'Luis', 'Hernandez', 'Col. Via. Satelite, Av. Regional', '7777-7777', '42462934-4', 1, '1990-04-19', 1, 'fercastle', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-02', '0000-00-00 00:00:00', ''),
(54, 'Luis', 'hernandez', 'Col. Via. Satelite, Av. Regional', '7777-7777', '12345678-5', 1, '1990-04-19', 1, 'Luiss', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-02', '0000-00-00 00:00:00', ''),
(55, 'Maria', 'Martinez', 'Col. Via. Satelite, Av. Regional', '7777-7777', '22222222-2', 2, '1994-04-19', 1, 'Maria', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 2, '2020-06-02', '0000-00-00 00:00:00', ''),
(56, 'luis fernando', 'hernandez', 'Colonia Colonial', '1212-1212', '12121212-2', 1, '1990-04-19', 1, 'Fercastle', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-04', '0000-00-00 00:00:00', ''),
(57, 'Luis Fernando', 'hernandez', 'Colonia Colonial', '1212-1212', '23232323-3', 1, '1993-02-19', 1, 'Fercastle', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 2, '2020-06-04', '0000-00-00 00:00:00', ''),
(58, 'Luis Hernandez', 'hernandez', 'Colonia Colonial', '1212-1212', '21212121-1', 1, '1990-04-19', 1, 'Fercastle', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-04', '0000-00-00 00:00:00', ''),
(59, 'Luis Fernando', 'hernandez', 'Colonia Colonial', '1212-1212', '19901990-9', 1, '1990-04-19', 1, 'Fercastle', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-04', '0000-00-00 00:00:00', ''),
(60, 'Marian Marlene', 'Reyes', 'Col. Via. Satelite, Av. Regional', '2222-2222', '12345678-9', 1, '2001-01-01', 1, 'Maria', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-04', '0000-00-00 00:00:00', ''),
(61, 'nuevo usuario nombre', 'nuevo usuario apellido', 'Nueva Direccion', '8888-8888', '88888888-9', 1, '2020-06-09', 1, 'Nuevo', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-09', '2020-06-09 13:24:01', 'Admin'),
(62, 'nuevo usuario nombre', 'nuevo usuario apellido', 'Nueva Direccion', '2222-2222', '77777777-2', 1, '2020-06-09', 1, 'Fmln', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-09', '2020-06-09 13:26:08', 'Admin'),
(63, 'nuevo usuario nombre', 'nuevo usuario apellido', 'Nueva Direccion', '2222-2222', '01010101-2', 1, '2020-06-02', 1, 'Maria', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-09', '2020-06-09 13:32:31', 'Admin'),
(64, 'Doky', 'Hernandez', 'colonia la colonia', '3333-3333', '88888888-8', 1, '2020-05-30', 1, 'doky', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-09', '2020-06-09 17:33:09', 'Admin'),
(65, 'Doky', 'Hernandez castillo', 'colonia', '3333-3333', '12123434-3', 1, '2020-05-26', 1, 'doky', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-09', '2020-06-09 17:41:29', 'Tatita'),
(66, 'Luis', 'Hernandez', 'colonia la colonia', '7777-1234', '12123434-4', 1, '2020-06-09', 1, 'doky', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-09', '2020-06-09 18:32:12', 'Tatita'),
(67, 'Luis', 'Hernandez', 'colonia la colonia', '7777-1234', '00000000-0', 1, '2020-05-26', 1, 'doky', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-09', '2020-06-09 18:36:01', 'Tatita'),
(68, 'Luis', 'Hernandez', 'colonia la colonia', '7777-1234', '00000000-0', 1, '2020-05-26', 1, 'doky', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-09', '2020-06-09 18:38:05', 'Tatita'),
(69, 'Luis', 'Hernandez', 'colonia la colonia', '7777-1234', '00000000-0', 1, '2020-05-26', 1, 'doky', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-09', '2020-06-09 18:38:49', 'Tatita'),
(70, 'Luis', 'Hernandez', 'colonia la colonia', '7777-1234', '00000000-0', 1, '2020-05-26', 1, 'doky', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-09', '2020-06-09 18:39:39', 'Tatita'),
(71, 'Luis', 'Hernandez', 'colonia la colonia', '7777-1234', '00000000-2', 1, '2020-05-26', 1, 'doky', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-09', '2020-06-09 18:39:50', 'Tatita'),
(72, 'Luis', 'Hernandez', 'colonia la colonia', '1212-1212', '12123434-5', 1, '2020-05-25', 1, 'Admin', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-09', '2020-06-09 18:41:11', 'Tatita'),
(73, 'Luis', 'Hernandez', 'colonia', '7777-1234', '12123434-7', 1, '2020-06-09', 1, 'Admin', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-09', '2020-06-09 18:48:09', 'Tatita'),
(74, 'Luis', 'Hernandez', 'colonia', '7777-1234', '12123434-7', 1, '2020-06-09', 1, 'Admin', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-09', '2020-06-09 18:49:04', 'Tatita'),
(75, 'Luis', 'Hernandez', 'colonia', '7777-1234', '12123434-8', 1, '2020-06-09', 1, 'Admin', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-09', '2020-06-09 18:49:17', 'Tatita'),
(76, 'Luis', 'Hernandez', 'colonia', '7777-1234', '12123434-8', 1, '2020-06-09', 1, 'Admin', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-09', '2020-06-09 18:50:54', 'Tatita'),
(77, 'Luis', 'Hernandez', 'colonia', '7777-1234', '12123434-1', 1, '2020-06-09', 1, 'Admin', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-09', '2020-06-09 18:52:13', 'Tatita'),
(78, 'Luis', 'Hernandez', 'colonia', '7777-1234', '12123434-1', 1, '2020-06-09', 1, 'Admin', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-09', '2020-06-09 18:54:10', 'Tatita'),
(79, 'Luis', 'Hernandez', 'colonia', '7777-1234', '12123434-2', 1, '2020-06-09', 1, 'Admin', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-09', '2020-06-09 18:54:36', 'Tatita'),
(80, 'Luis', 'Hernandez', 'colonia', '7777-1234', '12123434-2', 1, '2020-06-09', 1, 'Admin', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-09', '2020-06-09 18:57:38', 'Tatita'),
(81, 'Luis', 'Hernandez', 'colonia', '7777-1234', '12123434-8', 1, '2020-06-09', 1, 'Admin', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-09', '2020-06-09 18:57:59', 'Tatita'),
(82, 'Luis', 'Hernandez', 'colonia', '7777-1234', '12123434-9', 1, '2020-06-09', 1, 'Admin', 'b5ba77af1f7bda735894e746a199acb1d2c836424da2fc46bebb55423dccbff871877a30fab77a31e47b0a29ea0154882e532e9a29b220a8f2958773313bbb2a', 1, '2020-06-09', '2020-06-09 18:58:25', 'Tatita'),
(83, 'nombre  nombre', 'apellido  apellido', 'colonia', '7777-1234', '00000000-0', 1, '2020-06-03', 1, 'Doky', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-09', '2020-06-09 19:06:05', 'Tatita'),
(84, 'nombre  nombre', 'apellido  apellido', 'colonia', '7777-1234', '00000000-0', 1, '2020-06-03', 1, 'Doky', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-06-09', '2020-06-09 19:07:05', 'Tatita'),
(85, 'nuevo', 'nuevo', 'direccion', '7777-1234', '12123434-3', 1, '1999-04-01', 1, 'Doky', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-07-07', '2020-07-07 17:50:26', 'Fmln'),
(86, 'nuevo', 'nuevo', 'direccion', '7777-1234', '12123434-4', 1, '1999-04-01', 1, 'Dos', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-07-07', '2020-07-07 17:51:01', 'Fmln'),
(87, 'nuevo', 'nuevo', 'direccion', '7777-1234', '12123432-2', 1, '1999-04-01', 1, 'Dos', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-07-07', '2020-07-07 17:51:23', 'Fmln'),
(88, 'nuevo', 'nuevo', 'direccion', '7777-1234', '12123432-2', 1, '1999-04-01', 1, 'Tres', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-07-07', '2020-07-07 17:51:53', 'Fmln'),
(89, 'nuevo', 'nuevo', 'direccion', '7777-1234', '00000000-3', 1, '1999-04-01', 1, 'Tress', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-07-07', '2020-07-07 17:52:33', 'Fmln'),
(90, 'farcry nombre', 'farcry apellido', 'colonia la colonia colonial', '1212-1212', '00001000-0', 1, '2020-07-17', 1, 'Farcry', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-07-17', '2020-07-17 19:39:17', 'Tatita'),
(91, 'Complemento Nombre', 'Complemento Apellido', 'Colonia La Colonia', '1212-1212', '99999999-0', 1, '2020-07-01', 1, 'Dokin', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-07-18', '2020-07-18 01:30:40', 'Tatita'),
(92, 'Complemento Nombre', 'Complemento Apellido', 'Colonia La Colonia Colonial', '1212-1212', '99999999-1', 1, '2020-07-01', 1, 'Doking', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-07-18', '2020-07-18 01:36:33', 'Tatita'),
(93, 'Lorena', 'Diaz', 'Colonia Ciudad Pacifica, Pol. 2-c #39', '7363-6363', '76541234-1', 2, '2020-11-11', 1, 'Lorena', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-11-23', '2020-11-23 22:19:35', 'Tatita'),
(94, 'Oscar', 'Barahona', 'Colonia Ciudad Pacifica, Pol. 2-c #39', '7363-6363', '12430987-2', 1, '2020-11-19', 1, 'Oscarr', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-11-23', '2020-11-23 22:20:13', 'Tatita');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tblasistencias`
--
ALTER TABLE `tblasistencias`
  ADD PRIMARY KEY (`id_asistencia`),
  ADD KEY `fecha_asist_capacit` (`fecha_asist_capacit`),
  ADD KEY `id_exam` (`id_exam`);

--
-- Indices de la tabla `tblcredenciales`
--
ALTER TABLE `tblcredenciales`
  ADD PRIMARY KEY (`id_creden`),
  ADD KEY `id_manip` (`id_manip`);

--
-- Indices de la tabla `tblestablecimientos`
--
ALTER TABLE `tblestablecimientos`
  ADD PRIMARY KEY (`id_estab`);

--
-- Indices de la tabla `tblexamenes`
--
ALTER TABLE `tblexamenes`
  ADD PRIMARY KEY (`id_exam`),
  ADD KEY `id_manip` (`id_manip`);

--
-- Indices de la tabla `tblfechacapacitaciones`
--
ALTER TABLE `tblfechacapacitaciones`
  ADD PRIMARY KEY (`id_fechacapacit`);

--
-- Indices de la tabla `tblinspecciones`
--
ALTER TABLE `tblinspecciones`
  ADD PRIMARY KEY (`id_inspec`),
  ADD KEY `id_estab` (`id_estab`);

--
-- Indices de la tabla `tbllog`
--
ALTER TABLE `tbllog`
  ADD PRIMARY KEY (`id_log`);

--
-- Indices de la tabla `tblmanipuladores`
--
ALTER TABLE `tblmanipuladores`
  ADD PRIMARY KEY (`id_manip`),
  ADD KEY `id_estab` (`id_estab`);

--
-- Indices de la tabla `tipousuarios`
--
ALTER TABLE `tipousuarios`
  ADD PRIMARY KEY (`idtipousuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `idtipousuario` (`idtipousuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tblasistencias`
--
ALTER TABLE `tblasistencias`
  MODIFY `id_asistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tblcredenciales`
--
ALTER TABLE `tblcredenciales`
  MODIFY `id_creden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tblestablecimientos`
--
ALTER TABLE `tblestablecimientos`
  MODIFY `id_estab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `tblexamenes`
--
ALTER TABLE `tblexamenes`
  MODIFY `id_exam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `tblfechacapacitaciones`
--
ALTER TABLE `tblfechacapacitaciones`
  MODIFY `id_fechacapacit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tblinspecciones`
--
ALTER TABLE `tblinspecciones`
  MODIFY `id_inspec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `tbllog`
--
ALTER TABLE `tbllog`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `tblmanipuladores`
--
ALTER TABLE `tblmanipuladores`
  MODIFY `id_manip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `tipousuarios`
--
ALTER TABLE `tipousuarios`
  MODIFY `idtipousuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
