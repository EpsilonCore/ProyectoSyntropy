-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
<<<<<<< HEAD
-- Tiempo de generación: 24-07-2026 a las 14:34:53
=======
-- Tiempo de generación: 28-08-2026 a las 14:52:56
>>>>>>> ad5a51dd135b9bac8eb001731f8b37fca533a183
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `syntropy`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camion`
--

<<<<<<< HEAD
CREATE TABLE `camion` (
=======
CREATE TABLE IF NOT EXISTS `camion` (
>>>>>>> ad5a51dd135b9bac8eb001731f8b37fca533a183
  `matricula` varchar(8) NOT NULL,
  `tipo` varchar(15) DEFAULT NULL,
  `capacidadCarga` int(11) DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
<<<<<<< HEAD
  `ubicacion` varchar(100) DEFAULT NULL
=======
  `ubicacion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`matricula`)
>>>>>>> ad5a51dd135b9bac8eb001731f8b37fca533a183
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camioncuadrilla`
--

<<<<<<< HEAD
CREATE TABLE `camioncuadrilla` (
  `ID_cuadrilla` int(11) NOT NULL,
  `matricula` varchar(8) NOT NULL,
  `fecha` date NOT NULL
=======
CREATE TABLE IF NOT EXISTS `camioncuadrilla` (
  `ID_cuadrilla` int(11) NOT NULL AUTO_INCREMENT,
  `matricula` varchar(8) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`ID_cuadrilla`,`matricula`,`fecha`),
  KEY `matricula` (`matricula`)
>>>>>>> ad5a51dd135b9bac8eb001731f8b37fca533a183
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canton`
--

<<<<<<< HEAD
CREATE TABLE `canton` (
  `ID_canton` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL
=======
CREATE TABLE IF NOT EXISTS `canton` (
  `ID_canton` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_canton`)
>>>>>>> ad5a51dd135b9bac8eb001731f8b37fca533a183
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro_acopio`
--

<<<<<<< HEAD
CREATE TABLE `centro_acopio` (
  `ID_acopio` int(11) NOT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `tipoResiduo` varchar(100) DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL
=======
CREATE TABLE IF NOT EXISTS `centro_acopio` (
  `ID_acopio` int(11) NOT NULL AUTO_INCREMENT,
  `direccion` varchar(50) DEFAULT NULL,
  `tipoResiduo` varchar(100) DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_acopio`)
>>>>>>> ad5a51dd135b9bac8eb001731f8b37fca533a183
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenedor`
--

<<<<<<< HEAD
CREATE TABLE `contenedor` (
  `ID_contenedor` int(11) NOT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `capacidadCarga` int(11) DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `calle` varchar(30) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `barrio` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
=======
CREATE TABLE IF NOT EXISTS `contenedor` (
  `ID_contenedor` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(20) DEFAULT NULL,
  `capacidadCarga` int(11) DEFAULT 0,
  `estado` varchar(30) DEFAULT 'roto',
  `calle` varchar(30) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `barrio` varchar(20) DEFAULT NULL,
  `lat` decimal(10,7) NOT NULL,
  `lon` decimal(10,7) NOT NULL,
  PRIMARY KEY (`ID_contenedor`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contenedor`
--

INSERT INTO `contenedor` (`ID_contenedor`, `tipo`, `capacidadCarga`, `estado`, `calle`, `numero`, `barrio`, `lat`, `lon`) VALUES
(2, 'Naranja', 100, 'Vacio', 'Alto Peru', 1923, 'Buceo', -34.8866360, -56.1238250),
(3, 'Naranja', 200, 'Lleno', 'Av Ramon Anador', 3681, 'Buceo', -34.8939180, -56.1357610),
(4, 'Naranja', 200, 'Media capacidad', 'Dionisio Lopez', 2123, 'Union', -34.8841600, -56.1360860),
(5, 'Naranja', 200, 'Desbordado', 'Cassinoni', 1434, 'Tres Cruces', -34.9014020, -56.1655040);
>>>>>>> ad5a51dd135b9bac8eb001731f8b37fca533a183

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuadrilla`
--

<<<<<<< HEAD
CREATE TABLE `cuadrilla` (
  `ID_cuadrilla` int(11) NOT NULL
=======
CREATE TABLE IF NOT EXISTS `cuadrilla` (
  `ID_cuadrilla` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID_cuadrilla`)
>>>>>>> ad5a51dd135b9bac8eb001731f8b37fca533a183
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descarga`
--

<<<<<<< HEAD
CREATE TABLE `descarga` (
  `ID_descarga` int(11) NOT NULL,
  `matricula` varchar(8) DEFAULT NULL,
  `ID_acopio` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL
=======
CREATE TABLE IF NOT EXISTS `descarga` (
  `ID_descarga` int(11) NOT NULL AUTO_INCREMENT,
  `matricula` varchar(8) DEFAULT NULL,
  `ID_acopio` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`ID_descarga`),
  KEY `matricula` (`matricula`),
  KEY `ID_acopio` (`ID_acopio`)
>>>>>>> ad5a51dd135b9bac8eb001731f8b37fca533a183
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envio_residuos`
--

<<<<<<< HEAD
CREATE TABLE `envio_residuos` (
  `ID_envio` int(11) NOT NULL,
  `ID_acopio` int(11) DEFAULT NULL,
  `ID_vertedero` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL
=======
CREATE TABLE IF NOT EXISTS `envio_residuos` (
  `ID_envio` int(11) NOT NULL AUTO_INCREMENT,
  `ID_acopio` int(11) DEFAULT NULL,
  `ID_vertedero` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`ID_envio`),
  KEY `ID_acopio` (`ID_acopio`),
  KEY `ID_vertedero` (`ID_vertedero`)
>>>>>>> ad5a51dd135b9bac8eb001731f8b37fca533a183
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historiallogin`
--

<<<<<<< HEAD
CREATE TABLE `historiallogin` (
  `ID_Login` int(11) NOT NULL,
  `Estado` varchar(200) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
=======
CREATE TABLE IF NOT EXISTS `historiallogin` (
  `ID_Login` int(11) NOT NULL AUTO_INCREMENT,
  `Estado` varchar(200) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_Login`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
>>>>>>> ad5a51dd135b9bac8eb001731f8b37fca533a183

--
-- Volcado de datos para la tabla `historiallogin`
--

INSERT INTO `historiallogin` (`ID_Login`, `Estado`, `fecha`, `mail`) VALUES
(4, 'Exitoso', '2026-07-16 09:38:28', 'emietc@gmail.com'),
(5, 'Exitoso', '2026-07-16 09:51:52', NULL),
(6, 'Exitoso', '2026-07-16 09:51:58', NULL),
(7, 'Exitoso', '2026-07-16 09:53:30', NULL),
(8, 'Exitoso', '2026-07-16 09:53:39', NULL),
(9, 'Fallido - Cuenta pendiente', '2026-07-16 09:56:07', 'emietc@gmail.com'),
(10, 'Exitoso', '2026-07-16 09:59:24', 'emietc@gmail.com'),
(11, 'Exitoso', '2026-07-18 18:55:10', 'emietc@gmail.com'),
(12, 'Exitoso', '2026-07-18 18:58:27', 'emietc@gmail.com'),
(13, 'Exitoso', '2026-07-18 19:00:59', 'emietc@gmail.com'),
(14, 'Fallido - Cuenta pendiente', '2026-07-18 19:04:46', 'kcarballo625@gmail.com'),
(15, 'Exitoso', '2026-07-20 19:29:57', NULL),
(16, 'Exitoso', '2026-07-20 19:40:47', NULL),
(17, 'Exitoso', '2026-07-20 19:40:57', NULL),
(18, 'Exitoso', '2026-07-20 19:45:28', NULL),
(19, 'Exitoso', '2026-07-20 19:46:16', NULL),
(20, 'Exitoso', '2026-07-20 19:46:25', NULL),
(21, 'Exitoso', '2026-07-20 19:46:27', NULL),
(22, 'Exitoso', '2026-07-20 19:55:13', NULL),
(23, 'Exitoso', '2026-07-20 20:15:54', NULL),
(24, 'Fallido - Cuenta pendiente', '2026-07-20 20:31:32', 'nachotrullen@gmail.com'),
(25, 'Fallido - Cuenta pendiente', '2026-07-20 20:32:40', 'nachotrullen@gmail.com'),
(26, 'Fallido - Cuenta pendiente', '2026-07-20 20:33:49', 'nachotrullen@gmail.com'),
(27, 'Fallido - Cuenta pendiente', '2026-07-20 20:34:03', 'nachotrullen@gmail.com'),
(28, 'Fallido - Cuenta pendiente', '2026-07-20 20:38:43', 'nachotrullen@gmail.com'),
(29, 'Fallido - Cuenta pendiente', '2026-07-20 20:43:33', 'nachotrullen@gmail.com'),
(30, 'Fallido - Cuenta pendiente', '2026-07-20 20:43:56', 'nachotrullen@gmail.com'),
(31, 'Fallido - Cuenta pendiente', '2026-07-20 20:44:09', 'nachotrullen@gmail.com'),
(32, 'Exitoso', '2026-07-20 20:44:21', NULL),
(33, 'Fallido - Cuenta pendiente', '2026-07-20 20:52:26', 'nachotrullen@gmail.com'),
(34, 'Exitoso', '2026-07-20 20:52:34', NULL),
(35, 'Exitoso', '2026-07-20 20:54:28', NULL),
(36, 'Exitoso', '2026-07-20 20:56:59', 'nachotrullen@gmail.com'),
(37, 'Exitoso', '2026-07-23 10:37:27', NULL),
(38, 'Exitoso', '2026-07-23 10:38:31', NULL),
(39, 'Exitoso', '2026-07-23 15:52:28', NULL),
<<<<<<< HEAD
(40, 'Fallido - Cuenta pendiente', '2026-07-24 09:26:16', 'pedro@gmail');
=======
(40, 'Fallido - Cuenta pendiente', '2026-07-24 09:26:16', 'pedro@gmail'),
(41, 'Exitoso', '2026-07-25 17:35:23', 'emietc@gmail.com'),
(42, 'Exitoso', '2026-07-25 17:35:44', 'emietc@gmail.com'),
(43, 'Exitoso', '2026-07-25 17:37:12', 'emietc@gmail.com'),
(44, 'Exitoso', '2026-07-25 17:39:05', NULL),
(45, 'Exitoso', '2026-07-25 17:44:55', 'emietc@gmail.com'),
(46, 'Exitoso', '2026-07-25 17:45:23', NULL),
(47, 'Exitoso', '2026-07-25 17:59:03', 'emietc@gmail.com'),
(48, 'Exitoso', '2026-07-25 18:00:07', 'emietc@gmail.com'),
(49, 'Exitoso', '2026-07-25 18:08:48', 'emietc@gmail.com'),
(50, 'Exitoso', '2026-08-14 19:27:20', 'kcarballo625@gmail.com'),
(51, 'Exitoso', '2026-08-14 19:36:03', NULL),
(52, 'Exitoso', '2026-08-14 19:36:22', 'kcarballo625@gmail.com'),
(53, 'Exitoso', '2026-08-14 19:37:14', NULL),
(54, 'Exitoso', '2026-08-14 19:39:33', 'kcarballo625@gmail.com'),
(55, 'Exitoso', '2026-08-14 19:40:03', 'gonzallovet@gmail.com'),
(56, 'Exitoso', '2026-08-14 19:40:42', NULL),
(57, 'Exitoso', '2026-08-14 19:52:07', 'kcarballo625@gmail.com'),
(58, 'Exitoso', '2026-08-19 17:39:56', NULL),
(59, 'Exitoso', '2026-08-19 17:40:16', NULL),
(60, 'Exitoso', '2026-08-19 17:44:10', 'kcarballo625@gmail.com'),
(61, 'Exitoso', '2026-08-19 17:49:44', 'gonzallovet@gmail.com'),
(62, 'Exitoso', '2026-08-19 18:04:45', NULL),
(63, 'Exitoso', '2026-08-19 18:07:01', NULL),
(64, 'Exitoso', '2026-08-19 18:07:46', NULL),
(65, 'Exitoso', '2026-08-19 18:08:51', NULL),
(66, 'Exitoso', '2026-08-19 18:13:22', NULL),
(67, 'Exitoso', '2026-08-20 09:15:00', 'kcarballo625@gmail.com'),
(68, 'Exitoso', '2026-08-20 09:15:01', 'kcarballo625@gmail.com'),
(69, 'Exitoso', '2026-08-20 09:15:01', 'kcarballo625@gmail.com'),
(70, 'Exitoso', '2026-08-20 09:15:02', 'kcarballo625@gmail.com'),
(71, 'Exitoso', '2026-08-20 09:15:06', 'kcarballo625@gmail.com'),
(72, 'Exitoso', '2026-08-20 09:35:42', NULL),
(73, 'Exitoso', '2026-08-20 21:26:18', NULL),
(74, 'Exitoso', '2026-08-21 09:21:40', 'kcarballo625@gmail.com'),
(75, 'Exitoso', '2026-08-21 22:02:51', 'kcarballo625@gmail.com'),
(76, 'Exitoso', '2026-08-21 22:02:51', 'kcarballo625@gmail.com'),
(77, 'Exitoso', '2026-08-21 22:55:31', NULL),
(78, 'Exitoso', '2026-08-21 22:56:36', NULL),
(79, 'Exitoso', '2026-08-21 22:58:04', 'kcarballo625@gmail.com'),
(80, 'Exitoso', '2026-08-21 23:00:38', NULL),
(81, 'Exitoso', '2026-08-27 08:40:28', NULL),
(82, 'Exitoso', '2026-08-27 10:28:53', NULL),
(83, 'Exitoso', '2026-08-28 07:31:48', NULL);
>>>>>>> ad5a51dd135b9bac8eb001731f8b37fca533a183

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencia`
--

<<<<<<< HEAD
CREATE TABLE `incidencia` (
  `ID_incidencia` int(11) NOT NULL,
=======
CREATE TABLE IF NOT EXISTS `incidencia` (
  `ID_incidencia` int(11) NOT NULL AUTO_INCREMENT,
>>>>>>> ad5a51dd135b9bac8eb001731f8b37fca533a183
  `mail` varchar(255) NOT NULL,
  `ID_operario` int(11) DEFAULT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL,
<<<<<<< HEAD
  `ubicacion` varchar(100) DEFAULT NULL,
  `imagen` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
=======
  `imagen` mediumblob DEFAULT NULL,
  `calle` varchar(50) DEFAULT NULL,
  `numero` int(50) DEFAULT NULL,
  `barrio` varchar(50) DEFAULT NULL,
  `lat` decimal(10,7) NOT NULL,
  `lon` decimal(10,7) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `tipoContenedor` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_incidencia`),
  KEY `mail` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `incidencia`
--

INSERT INTO `incidencia` (`ID_incidencia`, `mail`, `ID_operario`, `tipo`, `estado`, `imagen`, `calle`, `numero`, `barrio`, `lat`, `lon`, `fecha_creacion`, `tipoContenedor`) VALUES
(6, 'emietc@gmail.com', 0, 'lleno', 'Pendiente', 0x68747470733a2f2f656e637279707465642d74626e302e677374617469632e636f6d2f696d616765733f713d74626e3a414e643947635178726c79627a724b465f39494a544b322d3257776d6b45566d416e6f564a794549713579695f7a5830316726733d3130, 'Juan Jacobo Rousseau', 3530, 'Union', -34.8762900, -56.1466850, '2026-08-28 08:28:02', 'Plastico');
>>>>>>> ad5a51dd135b9bac8eb001731f8b37fca533a183

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `integrante_cuadrilla`
--

<<<<<<< HEAD
CREATE TABLE `integrante_cuadrilla` (
  `ID_cuadrilla` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `rol` varchar(10) DEFAULT NULL,
  `fecha` date DEFAULT NULL
=======
CREATE TABLE IF NOT EXISTS `integrante_cuadrilla` (
  `ID_cuadrilla` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `rol` varchar(10) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`ID_cuadrilla`,`mail`),
  KEY `mail` (`mail`)
>>>>>>> ad5a51dd135b9bac8eb001731f8b37fca533a183
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento`
--

<<<<<<< HEAD
CREATE TABLE `mantenimiento` (
  `ID_mantenimiento` int(11) NOT NULL,
  `matricula` varchar(8) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL
=======
CREATE TABLE IF NOT EXISTS `mantenimiento` (
  `ID_mantenimiento` int(11) NOT NULL AUTO_INCREMENT,
  `matricula` varchar(8) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`ID_mantenimiento`),
  KEY `matricula` (`matricula`)
>>>>>>> ad5a51dd135b9bac8eb001731f8b37fca533a183
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recoleccion`
--

<<<<<<< HEAD
CREATE TABLE `recoleccion` (
  `ID_recoleccion` int(11) NOT NULL,
  `matricula` varchar(8) DEFAULT NULL,
  `ID_contenedor` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL
=======
CREATE TABLE IF NOT EXISTS `recoleccion` (
  `ID_recoleccion` int(11) NOT NULL AUTO_INCREMENT,
  `matricula` varchar(8) DEFAULT NULL,
  `ID_contenedor` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`ID_recoleccion`),
  KEY `matricula` (`matricula`),
  KEY `ID_contenedor` (`ID_contenedor`)
>>>>>>> ad5a51dd135b9bac8eb001731f8b37fca533a183
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recorrido`
--

<<<<<<< HEAD
CREATE TABLE `recorrido` (
  `ID_recorrido` int(11) NOT NULL,
  `ID_ruta` int(11) DEFAULT NULL,
  `ID_cuadrilla` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL
=======
CREATE TABLE IF NOT EXISTS `recorrido` (
  `ID_recorrido` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ruta` int(11) DEFAULT NULL,
  `ID_cuadrilla` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`ID_recorrido`),
  KEY `ID_ruta` (`ID_ruta`),
  KEY `ID_cuadrilla` (`ID_cuadrilla`)
>>>>>>> ad5a51dd135b9bac8eb001731f8b37fca533a183
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

<<<<<<< HEAD
CREATE TABLE `registro` (
  `ID_registro` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `estado` varchar(30) DEFAULT 'Pendiente',
  `mailAdmin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
=======
CREATE TABLE IF NOT EXISTS `registro` (
  `ID_registro` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `estado` varchar(30) DEFAULT 'Pendiente',
  `mailAdmin` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_registro`),
  KEY `mail` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
>>>>>>> ad5a51dd135b9bac8eb001731f8b37fca533a183

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`ID_registro`, `mail`, `fecha`, `estado`, `mailAdmin`) VALUES
(2, 'kcarballo625@gmail.com', '2026-07-18 19:04:32', 'Aceptado', NULL),
(3, 'gonzallovet@gmail.com', '2026-07-20 19:45:17', 'Aceptado', NULL),
(4, 'nachotrullen@gmail.com', '2026-07-20 20:15:45', 'Aceptado', NULL),
(5, 'aguslandin@gmail.com', '2026-07-20 20:28:41', 'Pendiente', NULL),
(6, 'laracasanova@gmail.com', '2026-07-20 20:29:14', 'Pendiente', NULL),
(7, 'francoalmiron@gmail.com', '2026-07-20 20:29:39', 'Pendiente', NULL),
(8, 'juanteper@gmail.com', '2026-07-23 10:38:21', 'Aceptado', NULL),
(9, 'pedro@gmail', '2026-07-24 09:25:24', 'Pendiente', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta`
--

<<<<<<< HEAD
CREATE TABLE `ruta` (
  `ID_ruta` int(11) NOT NULL,
  `horario` varchar(15) DEFAULT NULL,
  `direccionInicio` varchar(150) DEFAULT NULL,
  `direccionFinal` varchar(150) DEFAULT NULL,
  `recorridoKM` int(11) DEFAULT NULL
=======
CREATE TABLE IF NOT EXISTS `ruta` (
  `ID_ruta` int(11) NOT NULL AUTO_INCREMENT,
  `horario` varchar(15) DEFAULT NULL,
  `direccionInicio` varchar(150) DEFAULT NULL,
  `direccionFinal` varchar(150) DEFAULT NULL,
  `recorridoKM` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_ruta`)
>>>>>>> ad5a51dd135b9bac8eb001731f8b37fca533a183
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutacanton`
--

<<<<<<< HEAD
CREATE TABLE `rutacanton` (
=======
CREATE TABLE IF NOT EXISTS `rutacanton` (
>>>>>>> ad5a51dd135b9bac8eb001731f8b37fca533a183
  `ID_ruta` int(11) DEFAULT NULL,
  `ID_canton` int(11) DEFAULT NULL,
  `tipo` enum('Inicia','Termina') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

<<<<<<< HEAD
CREATE TABLE `usuario` (
=======
CREATE TABLE IF NOT EXISTS `usuario` (
>>>>>>> ad5a51dd135b9bac8eb001731f8b37fca533a183
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `a2f` tinyint(1) DEFAULT 0,
  `estado` enum('Activo','Inactivo') DEFAULT 'Activo',
  `rol` enum('Administrador','Operario','Recolector','Vecino') NOT NULL,
<<<<<<< HEAD
  `nickname` varchar(20) DEFAULT NULL
=======
  `nickname` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`mail`),
  UNIQUE KEY `mail` (`mail`)
>>>>>>> ad5a51dd135b9bac8eb001731f8b37fca533a183
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre`, `apellido`, `mail`, `contrasena`, `a2f`, `estado`, `rol`, `nickname`) VALUES
('Agustina', 'Landin', 'aguslandin@gmail.com', '$2y$10$m6MJybdsj7EUGPXJeBYMm.DzRkqfbEm6VxsPBz60rIhB9XCUW/AEe', 0, 'Activo', 'Vecino', 'agus'),
('Emilia', 'Etchebarne', 'emietc@gmail.com', '$2y$10$nBuEGe9lkfGKpQLnnL00M.i/CtmhN9zYZNYT2iYoJc8gmmTDwrbLG', 0, 'Activo', 'Administrador', 'memi'),
('Franco', 'Almiron', 'francoalmiron@gmail.com', '$2y$10$og7x4RxPr3O/rdzpA60c4ut2sKRjrltOzcPCy3JHn0ziojcC89Sxi', 0, 'Activo', 'Vecino', 'franco'),
('Gonza', 'Llovet', 'gonzallovet@gmail.com', '$2y$10$ffKmrTCCRrVz4fv8Ekn/N.T0aV6Z97PcBEeh8oTZ3/OQo80j54l/a', 0, 'Activo', 'Vecino', 'gonzanmapa'),
<<<<<<< HEAD
('Juan', 'Teper', 'juanteper@gmail.com', '$2y$10$MmWiZTzKd5UtpikaKLeYUucbd47CvBlcQBtYNM65M4vc9.qldaGR.', 0, 'Activo', 'Vecino', 'jjuan'),
('Kevin', 'Carballo', 'kcarballo625@gmail.com', '$2y$10$kv2WHmqiAx/KCMrIoxjzQ.n8.gk/IGRqIRzqmA6JuMMpv9KRuVIqi', 0, 'Activo', 'Vecino', 'Quebin'),
('Lara', 'Casanova', 'laracasanova@gmail.com', '$2y$10$9J0Uw8mk6Ab32wW/eP5g1eqK9lw9thuwNVA8q6AHl864aOaZdhIWi', 0, 'Activo', 'Vecino', 'lara'),
('Nacho', 'tulle', 'nachotrullen@gmail.com', '$2y$10$5qhoIL6bIfdHpTjzYDm3k.K7gEpBCsjx2pxm58MINamvOtZ8bgtSi', 0, 'Activo', 'Vecino', 'nacho'),
('111111', 'gonza', 'pedro@gmail', '$2y$10$gCEAu946UirM.t.5g2L6SOuI9Q2ti.6kfPDgfuJTD.BzxwOMYZEp.', 0, 'Activo', 'Vecino', 'pepe');
=======
('Juan', 'Teper', 'juanteper@gmail.com', '$2y$10$MmWiZTzKd5UtpikaKLeYUucbd47CvBlcQBtYNM65M4vc9.qldaGR.', 0, 'Inactivo', 'Vecino', 'jjuan'),
('Kevin', 'Carballo', 'kcarballo625@gmail.com', '$2y$10$kv2WHmqiAx/KCMrIoxjzQ.n8.gk/IGRqIRzqmA6JuMMpv9KRuVIqi', 0, 'Activo', 'Operario', 'Kevshok'),
('Lara', 'Casanova', 'laracasanova@gmail.com', '$2y$10$9J0Uw8mk6Ab32wW/eP5g1eqK9lw9thuwNVA8q6AHl864aOaZdhIWi', 0, 'Activo', 'Vecino', 'lara'),
('Nacho', 'tulle', 'nachotrullen@gmail.com', '$2y$10$5qhoIL6bIfdHpTjzYDm3k.K7gEpBCsjx2pxm58MINamvOtZ8bgtSi', 0, 'Inactivo', 'Vecino', 'nacho'),
('111111', 'gonza', 'pedro@gmail', '$2y$10$gCEAu946UirM.t.5g2L6SOuI9Q2ti.6kfPDgfuJTD.BzxwOMYZEp.', 0, 'Inactivo', 'Vecino', 'pepe');
>>>>>>> ad5a51dd135b9bac8eb001731f8b37fca533a183

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vertedero`
--

<<<<<<< HEAD
CREATE TABLE `vertedero` (
  `ID_vertedero` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `ubicacion` varchar(50) DEFAULT NULL,
  `horario` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `camion`
--
ALTER TABLE `camion`
  ADD PRIMARY KEY (`matricula`);

--
-- Indices de la tabla `camioncuadrilla`
--
ALTER TABLE `camioncuadrilla`
  ADD PRIMARY KEY (`ID_cuadrilla`,`matricula`,`fecha`),
  ADD KEY `matricula` (`matricula`);

--
-- Indices de la tabla `canton`
--
ALTER TABLE `canton`
  ADD PRIMARY KEY (`ID_canton`);

--
-- Indices de la tabla `centro_acopio`
--
ALTER TABLE `centro_acopio`
  ADD PRIMARY KEY (`ID_acopio`);

--
-- Indices de la tabla `contenedor`
--
ALTER TABLE `contenedor`
  ADD PRIMARY KEY (`ID_contenedor`);

--
-- Indices de la tabla `cuadrilla`
--
ALTER TABLE `cuadrilla`
  ADD PRIMARY KEY (`ID_cuadrilla`);

--
-- Indices de la tabla `descarga`
--
ALTER TABLE `descarga`
  ADD PRIMARY KEY (`ID_descarga`),
  ADD KEY `matricula` (`matricula`),
  ADD KEY `ID_acopio` (`ID_acopio`);

--
-- Indices de la tabla `envio_residuos`
--
ALTER TABLE `envio_residuos`
  ADD PRIMARY KEY (`ID_envio`),
  ADD KEY `ID_acopio` (`ID_acopio`),
  ADD KEY `ID_vertedero` (`ID_vertedero`);

--
-- Indices de la tabla `historiallogin`
--
ALTER TABLE `historiallogin`
  ADD PRIMARY KEY (`ID_Login`);

--
-- Indices de la tabla `incidencia`
--
ALTER TABLE `incidencia`
  ADD PRIMARY KEY (`ID_incidencia`),
  ADD KEY `mail` (`mail`);

--
-- Indices de la tabla `integrante_cuadrilla`
--
ALTER TABLE `integrante_cuadrilla`
  ADD PRIMARY KEY (`ID_cuadrilla`,`mail`),
  ADD KEY `mail` (`mail`);

--
-- Indices de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD PRIMARY KEY (`ID_mantenimiento`),
  ADD KEY `matricula` (`matricula`);

--
-- Indices de la tabla `recoleccion`
--
ALTER TABLE `recoleccion`
  ADD PRIMARY KEY (`ID_recoleccion`),
  ADD KEY `matricula` (`matricula`),
  ADD KEY `ID_contenedor` (`ID_contenedor`);

--
-- Indices de la tabla `recorrido`
--
ALTER TABLE `recorrido`
  ADD PRIMARY KEY (`ID_recorrido`),
  ADD KEY `ID_ruta` (`ID_ruta`),
  ADD KEY `ID_cuadrilla` (`ID_cuadrilla`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`ID_registro`),
  ADD KEY `mail` (`mail`);

--
-- Indices de la tabla `ruta`
--
ALTER TABLE `ruta`
  ADD PRIMARY KEY (`ID_ruta`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`mail`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Indices de la tabla `vertedero`
--
ALTER TABLE `vertedero`
  ADD PRIMARY KEY (`ID_vertedero`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `camioncuadrilla`
--
ALTER TABLE `camioncuadrilla`
  MODIFY `ID_cuadrilla` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `canton`
--
ALTER TABLE `canton`
  MODIFY `ID_canton` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `centro_acopio`
--
ALTER TABLE `centro_acopio`
  MODIFY `ID_acopio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contenedor`
--
ALTER TABLE `contenedor`
  MODIFY `ID_contenedor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuadrilla`
--
ALTER TABLE `cuadrilla`
  MODIFY `ID_cuadrilla` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `descarga`
--
ALTER TABLE `descarga`
  MODIFY `ID_descarga` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `envio_residuos`
--
ALTER TABLE `envio_residuos`
  MODIFY `ID_envio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historiallogin`
--
ALTER TABLE `historiallogin`
  MODIFY `ID_Login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `incidencia`
--
ALTER TABLE `incidencia`
  MODIFY `ID_incidencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  MODIFY `ID_mantenimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recoleccion`
--
ALTER TABLE `recoleccion`
  MODIFY `ID_recoleccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recorrido`
--
ALTER TABLE `recorrido`
  MODIFY `ID_recorrido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `ID_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ruta`
--
ALTER TABLE `ruta`
  MODIFY `ID_ruta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vertedero`
--
ALTER TABLE `vertedero`
  MODIFY `ID_vertedero` int(11) NOT NULL AUTO_INCREMENT;

--
=======
CREATE TABLE IF NOT EXISTS `vertedero` (
  `ID_vertedero` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `ubicacion` varchar(50) DEFAULT NULL,
  `horario` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID_vertedero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
>>>>>>> ad5a51dd135b9bac8eb001731f8b37fca533a183
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `camioncuadrilla`
--
ALTER TABLE `camioncuadrilla`
  ADD CONSTRAINT `camioncuadrilla_ibfk_1` FOREIGN KEY (`ID_cuadrilla`) REFERENCES `cuadrilla` (`ID_cuadrilla`),
  ADD CONSTRAINT `camioncuadrilla_ibfk_2` FOREIGN KEY (`matricula`) REFERENCES `camion` (`matricula`);

--
-- Filtros para la tabla `descarga`
--
ALTER TABLE `descarga`
  ADD CONSTRAINT `descarga_ibfk_1` FOREIGN KEY (`matricula`) REFERENCES `camion` (`matricula`),
  ADD CONSTRAINT `descarga_ibfk_2` FOREIGN KEY (`ID_acopio`) REFERENCES `centro_acopio` (`ID_acopio`);

--
-- Filtros para la tabla `envio_residuos`
--
ALTER TABLE `envio_residuos`
  ADD CONSTRAINT `envio_residuos_ibfk_1` FOREIGN KEY (`ID_acopio`) REFERENCES `centro_acopio` (`ID_acopio`),
  ADD CONSTRAINT `envio_residuos_ibfk_2` FOREIGN KEY (`ID_vertedero`) REFERENCES `vertedero` (`ID_vertedero`);

--
-- Filtros para la tabla `incidencia`
--
ALTER TABLE `incidencia`
  ADD CONSTRAINT `incidencia_ibfk_1` FOREIGN KEY (`mail`) REFERENCES `usuario` (`mail`);

--
-- Filtros para la tabla `integrante_cuadrilla`
--
ALTER TABLE `integrante_cuadrilla`
  ADD CONSTRAINT `integrante_cuadrilla_ibfk_1` FOREIGN KEY (`ID_cuadrilla`) REFERENCES `cuadrilla` (`ID_cuadrilla`),
  ADD CONSTRAINT `integrante_cuadrilla_ibfk_2` FOREIGN KEY (`mail`) REFERENCES `usuario` (`mail`);

--
-- Filtros para la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD CONSTRAINT `mantenimiento_ibfk_1` FOREIGN KEY (`matricula`) REFERENCES `camion` (`matricula`);

--
-- Filtros para la tabla `recoleccion`
--
ALTER TABLE `recoleccion`
  ADD CONSTRAINT `recoleccion_ibfk_1` FOREIGN KEY (`matricula`) REFERENCES `camion` (`matricula`),
  ADD CONSTRAINT `recoleccion_ibfk_2` FOREIGN KEY (`ID_contenedor`) REFERENCES `contenedor` (`ID_contenedor`);

--
-- Filtros para la tabla `recorrido`
--
ALTER TABLE `recorrido`
  ADD CONSTRAINT `recorrido_ibfk_1` FOREIGN KEY (`ID_ruta`) REFERENCES `ruta` (`ID_ruta`),
  ADD CONSTRAINT `recorrido_ibfk_2` FOREIGN KEY (`ID_cuadrilla`) REFERENCES `cuadrilla` (`ID_cuadrilla`);

--
-- Filtros para la tabla `registro`
--
ALTER TABLE `registro`
  ADD CONSTRAINT `registro_ibfk_1` FOREIGN KEY (`mail`) REFERENCES `usuario` (`mail`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
