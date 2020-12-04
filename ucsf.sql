-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-12-2020 a las 22:09:06
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.28

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
-- Disparadores `tblexamenes`
--
DELIMITER $$
CREATE TRIGGER `after_exam_insert_on_asistencia` AFTER INSERT ON `tblexamenes` FOR EACH ROW INSERT INTO tblasistencias(id_exam, asistencia, fecha_asist_capacit, usermod, fechamodasistencia)
        VALUES(new.id_exam, 'No', 'NULL', 'NULL', 'NULL')
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
-- Disparadores `tblmanipuladores`
--
DELIMITER $$
CREATE TRIGGER `after_manip_insert_on_credenciales` AFTER INSERT ON `tblmanipuladores` FOR EACH ROW INSERT INTO tblcredenciales(id_manip, estado_creden, fecha_emis_creden, fecha_exped_creden)
        VALUES(new.id_manip, 'Inactivo', 'NULL', 'NULL')
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
(2, 'Maria Yanci', 'Martinez Garcia', 'San Francisco Gotera, Morazan', '7392-7419', '12345678-6', 2, '1994-03-07', 1, 'Tatita', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, '2020-03-03', '2020-10-19 21:29:23', 'Admin');

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
  MODIFY `id_asistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tblcredenciales`
--
ALTER TABLE `tblcredenciales`
  MODIFY `id_creden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tblestablecimientos`
--
ALTER TABLE `tblestablecimientos`
  MODIFY `id_estab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `tblexamenes`
--
ALTER TABLE `tblexamenes`
  MODIFY `id_exam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT de la tabla `tblmanipuladores`
--
ALTER TABLE `tblmanipuladores`
  MODIFY `id_manip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `tipousuarios`
--
ALTER TABLE `tipousuarios`
  MODIFY `idtipousuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tblasistencias`
--
ALTER TABLE `tblasistencias`
  ADD CONSTRAINT `tblasistencias_ibfk_2` FOREIGN KEY (`id_exam`) REFERENCES `tblexamenes` (`id_exam`);

--
-- Filtros para la tabla `tblcredenciales`
--
ALTER TABLE `tblcredenciales`
  ADD CONSTRAINT `tblcredenciales_ibfk_1` FOREIGN KEY (`id_manip`) REFERENCES `tblmanipuladores` (`id_manip`);

--
-- Filtros para la tabla `tblexamenes`
--
ALTER TABLE `tblexamenes`
  ADD CONSTRAINT `tblexamenes_ibfk_1` FOREIGN KEY (`id_manip`) REFERENCES `tblmanipuladores` (`id_manip`);

--
-- Filtros para la tabla `tblinspecciones`
--
ALTER TABLE `tblinspecciones`
  ADD CONSTRAINT `tblinspecciones_ibfk_1` FOREIGN KEY (`id_estab`) REFERENCES `tblestablecimientos` (`id_estab`);

--
-- Filtros para la tabla `tblmanipuladores`
--
ALTER TABLE `tblmanipuladores`
  ADD CONSTRAINT `tblmanipuladores_ibfk_1` FOREIGN KEY (`id_estab`) REFERENCES `tblestablecimientos` (`id_estab`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idtipousuario`) REFERENCES `tipousuarios` (`idtipousuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
