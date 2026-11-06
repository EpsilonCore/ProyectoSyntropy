-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-11-2026 a las 22:34:14
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

CREATE TABLE `camion` (
  `matricula` varchar(8) NOT NULL,
  `tipo` varchar(15) DEFAULT NULL,
  `capacidadCarga` int(11) DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `camion`
--

INSERT INTO `camion` (`matricula`, `tipo`, `capacidadCarga`, `estado`) VALUES
('45hjgr54', 'Caja Abierta', 10000, 'En Servicio'),
('SBA2145', 'Caja Abierta', 9000, 'Disponible'),
('SBA21453', 'Caja Abierta', 9000, 'Disponible'),
('SBC3872', 'Caja Cerrada', 12000, 'Disponible'),
('SBC38722', 'Caja Cerrada', 12000, 'Disponible'),
('SCD1904', 'Caja Abierta', 10000, 'Disponible'),
('SCD19042', 'Caja Abierta', 10000, 'Disponible'),
('SDE4421', 'Caja Cerrada', 11000, 'Disponible'),
('SDE44212', 'Caja Cerrada', 11000, 'Disponible'),
('SEF7730', 'Caja Abierta', 8000, 'Mantenimiento'),
('SEF77302', 'Caja Abierta', 8000, 'Mantenimiento'),
('SFG1058', 'Caja Cerrada', 12000, 'Disponible'),
('SFG10582', 'Caja Cerrada', 12000, 'Disponible'),
('SGH6293', 'Caja Abierta', 10000, 'En Servicio'),
('SGH62932', 'Caja Abierta', 10000, 'En Servicio'),
('SHJ8417', 'Caja Cerrada', 11000, 'En Servicio'),
('SHJ84172', 'Caja Cerrada', 11000, 'En Servicio'),
('SJK3366', 'Caja Abierta', 9000, 'Averiado'),
('SJK33662', 'Caja Abierta', 9000, 'Averiado'),
('SKL5509', 'Caja Cerrada', 10000, 'Mantenimiento'),
('SKL55092', 'Caja Cerrada', 10000, 'Mantenimiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camioncuadrilla`
--

CREATE TABLE `camioncuadrilla` (
  `ID_cuadrilla` int(11) NOT NULL,
  `matricula` varchar(8) NOT NULL,
  `fecha` date NOT NULL,
  `fecha_liberacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `camioncuadrilla`
--

INSERT INTO `camioncuadrilla` (`ID_cuadrilla`, `matricula`, `fecha`, `fecha_liberacion`) VALUES
(3, '45hjgr54', '2026-10-02', '2026-10-03 15:59:05'),
(3, '45hjgr54', '2026-10-23', '2026-10-23 10:22:26'),
(3, '45hjgr54', '2026-10-24', '2026-10-24 21:19:02'),
(3, '45hjgr54', '2026-10-30', '2026-11-01 11:24:07'),
(3, '45hjgr54', '2026-11-02', '2026-11-03 17:46:58'),
(3, '45hjgr54', '2026-11-06', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canton`
--

CREATE TABLE `canton` (
  `ID_canton` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro_acopio`
--

CREATE TABLE `centro_acopio` (
  `ID_acopio` int(11) NOT NULL,
  `barrio` varchar(100) NOT NULL,
  `calle` varchar(100) NOT NULL,
  `numero` int(255) NOT NULL,
  `tipoResiduo` varchar(100) DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL,
  `lat` decimal(10,7) NOT NULL,
  `lon` decimal(10,7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `centro_acopio`
--

INSERT INTO `centro_acopio` (`ID_acopio`, `barrio`, `calle`, `numero`, `tipoResiduo`, `capacidad`, `lat`, `lon`) VALUES
(2, 'Buceo', 'Juan Espinosa', 1544, 'Carton', 100, -34.8951370, -56.1238020),
(3, 'Buceo', 'Av. Italia', 3500, 'Naranja', 20000, -34.8867520, -56.1264680),
(5, 'Buceo', 'Av. Italia', 4200, 'Plastico', 15000, -34.8867520, -56.1264680),
(6, 'Prado', 'Av. Millán', 3800, 'Metalico', 25000, -34.8581220, -56.1960580),
(7, 'Buceo', 'Av Ramon Anador', 3900, 'Naranja', 20000, -34.8944000, -56.1346000),
(8, 'Union', 'Dionisio Lopez', 2350, 'Plastico', 12000, -34.8836000, -56.1368000),
(9, 'Tres Cruces', 'Cassinoni', 1250, 'Metalico', 18000, -34.9008000, -56.1648000),
(10, 'Buceo', 'Juan Espinosa', 1780, 'Carton', 8000, -34.8947000, -56.1245000),
(11, 'Buceo', 'Alto Peru', 2150, 'Plastico', 14000, -34.8860000, -56.1232000),
(12, 'Prado', 'Av. Millán', 3500, 'Naranja', 25000, -34.8604000, -56.1952000),
(13, 'Punta Carretas', 'José Ellauri', 420, 'Metalico', 16000, -34.9221000, -56.1581000),
(14, 'Ciudad Vieja', 'Pérez Castellano', 1569, 'Carton', 9000, -34.9068000, -56.2092000),
(15, 'Goes', 'Av. San Martín', 2800, 'Metalico', 13000, -34.8892000, -56.1840000),
(16, 'Union', 'Dionisio Lopez', 2000, 'Naranja', 17000, -34.8846000, -56.1352000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenedor`
--

CREATE TABLE `contenedor` (
  `ID_contenedor` int(11) NOT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `capacidadCarga` int(11) DEFAULT 0,
  `estado` varchar(30) DEFAULT 'roto',
  `calle` varchar(50) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `barrio` varchar(50) DEFAULT NULL,
  `lat` decimal(10,7) NOT NULL,
  `lon` decimal(10,7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contenedor`
--

INSERT INTO `contenedor` (`ID_contenedor`, `tipo`, `capacidadCarga`, `estado`, `calle`, `numero`, `barrio`, `lat`, `lon`) VALUES
(5, 'Naranja', 200, 'Desbordado', 'Cassinoni', 1434, 'Tres Cruces', -34.9014020, -56.1655040),
(7, 'Plastico', 200, 'Vacio', 'Alto Peru', 1923, 'Buceo', -34.8866360, -56.1238250),
(9, 'Plastico', 500, 'Lleno', 'Mariscala', 2022, 'Malvin', -34.8850360, -56.1191120),
(10, 'Naranja', 200, 'Media capacidad', 'Av. 18 de Julio', 1824, 'Cordón', -34.9047000, -56.1832000),
(11, 'Metalico', 200, 'Lleno', 'Av. Italia', 2870, 'Parque Batlle', -34.8885000, -56.1664000),
(12, 'Naranja', 200, 'Desbordado', 'Av. Luis Alberto de Herrera', 1290, 'Buceo', -34.9045000, -56.1376000),
(13, 'Plastico', 200, 'Media capacidad', 'José Ellauri', 350, 'Punta Carretas', -34.9226000, -56.1577000),
(14, 'Naranja', 200, 'Vacio', 'Julio Herrera y Reissig', 565, 'Parque Rodó', -34.9183000, -56.1668000),
(15, 'Metalico', 200, 'Lleno', 'Piedras', 237, 'Ciudad Vieja', -34.9070000, -56.2091000),
(16, 'Naranja', 200, 'Media capacidad', 'Buenos Aires', 678, 'Ciudad Vieja', -34.9075000, -56.2018000),
(17, 'Metalico', 200, 'Vacio', 'Av. 18 de Julio', 1360, 'Centro', -34.9057000, -56.1889000),
(18, 'Plastico', 200, 'Lleno', '25 de Mayo', 174, 'Ciudad Vieja', -34.9067000, -56.2056000),
(19, 'Plastico', 200, 'Vacio', 'Bulevar Artigas', 1825, 'Tres Cruces', -34.8939000, -56.1660000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuadrilla`
--

CREATE TABLE `cuadrilla` (
  `ID_cuadrilla` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cuadrilla`
--

INSERT INTO `cuadrilla` (`ID_cuadrilla`, `nombre`, `fecha_creacion`, `estado`) VALUES
(1, 'Cuadrilla 007', '2026-09-11 10:37:47', 'Inactiva'),
(2, 'Cuadrilla 001', '2026-09-11 18:43:07', 'Inactiva'),
(3, 'Cuadrilla 005', '2026-10-02 08:08:22', 'Activa'),
(4, 'Cuadrilla 002', '2026-10-05 08:12:10', 'Inactiva'),
(5, 'Cuadrilla 003', '2026-10-06 09:30:45', 'Inactiva'),
(6, 'Cuadrilla 004', '2026-10-14 10:05:22', 'Inactiva'),
(7, 'Cuadrilla 006', '2026-10-21 08:40:31', 'Inactiva'),
(8, 'Cuadrilla 008', '2026-10-22 09:15:08', 'Inactiva'),
(9, 'Cuadrilla 009', '2026-10-28 11:20:54', 'Inactiva'),
(10, 'Cuadrilla 010', '2026-10-29 14:02:37', 'Inactiva'),
(11, 'Cuadrilla 011', '2026-11-02 08:55:19', 'Inactiva'),
(12, 'Cuadrilla 012', '2026-11-03 09:47:03', 'Inactiva'),
(13, 'Cuadrilla 013', '2026-11-04 10:33:26', 'Inactiva');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descarga`
--

CREATE TABLE `descarga` (
  `ID_descarga` int(11) NOT NULL,
  `matricula` varchar(8) DEFAULT NULL,
  `ID_acopio` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envio_residuos`
--

CREATE TABLE `envio_residuos` (
  `ID_envio` int(11) NOT NULL,
  `ID_acopio` int(11) DEFAULT NULL,
  `ID_vertedero` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historiallogin`
--

CREATE TABLE `historiallogin` (
  `ID_Login` int(11) NOT NULL,
  `Estado` varchar(200) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(83, 'Exitoso', '2026-08-28 07:31:48', NULL),
(84, 'Exitoso', '2026-09-01 08:13:21', NULL),
(85, 'Exitoso', '2026-09-01 08:14:25', NULL),
(86, 'Exitoso', '2026-09-01 08:15:18', NULL),
(87, 'Exitoso', '2026-09-01 08:23:35', NULL),
(88, 'Exitoso', '2026-09-01 10:45:52', NULL),
(89, 'Exitoso', '2026-09-01 10:46:09', NULL),
(90, 'Exitoso', '2026-09-01 10:46:11', NULL),
(91, 'Exitoso', '2026-09-01 10:46:18', NULL),
(92, 'Exitoso', '2026-09-01 10:47:35', NULL),
(93, 'Exitoso', '2026-09-01 10:47:41', NULL),
(94, 'Exitoso', '2026-09-01 10:48:48', NULL),
(95, 'Exitoso', '2026-09-01 10:48:56', NULL),
(96, 'Exitoso', '2026-09-01 10:52:55', NULL),
(97, 'Exitoso', '2026-09-01 10:53:09', NULL),
(98, 'Exitoso', '2026-09-01 10:53:53', NULL),
(99, 'Exitoso', '2026-09-01 10:55:24', NULL),
(100, 'Exitoso', '2026-09-01 10:55:38', NULL),
(101, 'Fallido - Cuenta pendiente', '2026-09-01 11:15:03', 'franalmiron@gmail.com'),
(102, 'Exitoso', '2026-09-01 11:15:38', NULL),
(103, 'Exitoso', '2026-09-01 11:16:42', NULL),
(104, 'Fallido - Cuenta pendiente', '2026-09-01 11:18:58', 'francovich@gmail.com'),
(105, 'Exitoso', '2026-09-01 11:19:04', NULL),
(106, 'Exitoso', '2026-09-01 11:20:46', NULL),
(107, 'Exitoso', '2026-09-02 15:44:12', NULL),
(108, 'Exitoso', '2026-09-02 15:52:30', NULL),
(109, 'Exitoso', '2026-09-02 15:53:21', 'kcarballo625@gmail.com'),
(110, 'Exitoso', '2026-09-02 15:53:49', 'gonzallovet@gmail.com'),
(111, 'Exitoso', '2026-09-02 15:54:02', NULL),
(112, 'Exitoso', '2026-09-03 08:52:21', NULL),
(113, 'Exitoso', '2026-09-03 08:57:36', NULL),
(114, 'Exitoso', '2026-09-03 08:59:07', NULL),
(115, 'Exitoso', '2026-09-04 09:35:40', NULL),
(116, 'Exitoso', '2026-09-04 19:32:59', NULL),
(117, 'Exitoso', '2026-09-04 20:31:05', NULL),
(118, 'Exitoso', '2026-09-04 20:31:06', NULL),
(119, 'Exitoso', '2026-09-04 21:05:14', 'emietc@gmail.com'),
(120, 'Exitoso', '2026-09-04 21:14:44', NULL),
(121, 'Exitoso', '2026-09-05 15:51:28', NULL),
(122, 'Exitoso', '2026-09-06 16:22:33', 'kcarballo625@gmail.com'),
(123, 'Exitoso', '2026-09-06 16:38:30', NULL),
(124, 'Exitoso', '2026-09-06 16:41:08', 'kcarballo625@gmail.com'),
(125, 'Exitoso', '2026-09-06 16:44:25', NULL),
(126, 'Exitoso', '2026-09-06 16:44:50', NULL),
(127, 'Exitoso', '2026-09-06 16:45:58', 'kcarballo625@gmail.com'),
(128, 'Exitoso', '2026-09-06 16:47:25', NULL),
(129, 'Exitoso', '2026-09-06 22:22:39', 'kcarballo625@gmail.com'),
(130, 'Exitoso', '2026-09-06 22:29:39', NULL),
(131, 'Exitoso', '2026-09-08 09:04:44', 'kcarballo625@gmail.com'),
(132, 'Exitoso', '2026-09-08 09:13:54', NULL),
(133, 'Exitoso', '2026-09-08 09:38:03', NULL),
(134, 'Exitoso', '2026-09-08 10:36:54', NULL),
(135, 'Exitoso', '2026-09-10 08:34:40', NULL),
(136, 'Exitoso', '2026-09-10 08:49:27', 'kcarballo625@gmail.com'),
(137, 'Exitoso', '2026-09-10 08:49:49', 'gonzallovet@gmail.com'),
(138, 'Exitoso', '2026-09-10 08:51:01', NULL),
(139, 'Fallido - Cuenta pendiente', '2026-09-10 09:04:05', 'jm4092395@gmail.com'),
(140, 'Exitoso', '2026-09-10 09:04:18', NULL),
(141, 'Exitoso', '2026-09-10 09:04:42', 'jm4092395@gmail.com'),
(142, 'Exitoso', '2026-09-10 09:08:06', NULL),
(143, 'Exitoso', '2026-09-10 09:43:13', NULL),
(144, 'Exitoso', '2026-09-10 18:31:27', NULL),
(145, 'Exitoso', '2026-09-10 18:59:05', NULL),
(146, 'Exitoso', '2026-09-11 08:05:55', NULL),
(147, 'Exitoso', '2026-09-11 08:15:58', NULL),
(148, 'Exitoso', '2026-09-11 08:16:33', NULL),
(149, 'Exitoso', '2026-09-11 08:45:45', NULL),
(150, 'Exitoso', '2026-09-11 08:54:49', NULL),
(151, 'Exitoso', '2026-09-11 08:59:30', NULL),
(152, 'Exitoso', '2026-09-11 09:01:52', NULL),
(153, 'Exitoso', '2026-09-11 10:15:07', NULL),
(154, 'Exitoso', '2026-09-11 10:36:05', NULL),
(155, 'Exitoso', '2026-09-11 10:36:24', 'oramasfacu@gmail.com'),
(156, 'Exitoso', '2026-09-11 10:36:34', NULL),
(157, 'Exitoso', '2026-09-11 10:38:18', NULL),
(158, 'Exitoso', '2026-09-17 08:50:23', NULL),
(159, 'Exitoso', '2026-09-17 10:15:48', NULL),
(160, 'Exitoso', '2026-09-17 10:21:42', NULL),
(161, 'Exitoso', '2026-09-17 10:22:29', NULL),
(162, 'Exitoso', '2026-09-17 10:23:25', NULL),
(163, 'Exitoso', '2026-09-17 10:23:43', 'kcarballo625@gmail.com'),
(164, 'Exitoso', '2026-09-17 10:25:27', NULL),
(165, 'Exitoso', '2026-09-17 10:26:05', 'jaab@gmail'),
(166, 'Exitoso', '2026-09-17 10:26:23', 'jaab@gmail'),
(167, 'Exitoso', '2026-09-19 10:48:32', NULL),
(168, 'Exitoso', '2026-09-19 11:30:22', 'kcarballo625@gmail.com'),
(169, 'Exitoso', '2026-09-19 11:31:01', NULL),
(170, 'Exitoso', '2026-09-19 11:31:20', 'kcarballo625@gmail.com'),
(171, 'Exitoso', '2026-09-23 21:34:43', 'kcarballo625@gmail.com'),
(172, 'Exitoso', '2026-09-23 21:36:25', NULL),
(173, 'Exitoso', '2026-09-23 21:40:57', NULL),
(174, 'Exitoso', '2026-09-23 21:41:04', 'kcarballo625@gmail.com'),
(175, 'Exitoso', '2026-09-23 22:00:54', NULL),
(176, 'Exitoso', '2026-09-26 12:40:41', NULL),
(177, 'Exitoso', '2026-09-26 12:40:51', 'kcarballo625@gmail.com'),
(178, 'Exitoso', '2026-09-26 12:41:41', NULL),
(179, 'Exitoso', '2026-09-26 13:08:57', 'kcarballo625@gmail.com'),
(180, 'Exitoso', '2026-09-30 18:50:08', NULL),
(181, 'Exitoso', '2026-09-30 18:50:23', NULL),
(182, 'Exitoso', '2026-09-30 18:50:41', 'facundocarlosvillanueva@gmail.com'),
(183, 'Exitoso', '2026-09-30 18:54:24', NULL),
(184, 'Exitoso', '2026-09-30 18:55:51', NULL),
(185, 'Exitoso', '2026-09-30 18:56:06', 'facundocarlosvillanueva@gmail.com'),
(186, 'Exitoso', '2026-09-30 18:56:36', NULL),
(187, 'Exitoso', '2026-09-30 18:57:02', 'facundocarlosvillanueva@gmail.com'),
(188, 'Exitoso', '2026-09-30 18:57:06', 'facundocarlosvillanueva@gmail.com'),
(189, 'Exitoso', '2026-09-30 18:59:40', NULL),
(190, 'Exitoso', '2026-09-30 18:59:53', 'facundocarlosvillanueva@gmail.com'),
(191, 'Exitoso', '2026-10-01 09:02:11', NULL),
(192, 'Exitoso', '2026-10-01 09:41:21', 'francovich@gmail.com'),
(193, 'Exitoso', '2026-10-01 09:41:34', NULL),
(194, 'Exitoso', '2026-10-01 09:42:15', 'francovich@gmail.com'),
(195, 'Exitoso', '2026-10-01 09:43:45', 'francovich@gmail.com'),
(196, 'Exitoso', '2026-10-01 09:48:14', NULL),
(197, 'Exitoso', '2026-10-01 09:48:27', 'francovich@gmail.com'),
(198, 'Exitoso', '2026-10-01 09:52:44', NULL),
(199, 'Exitoso', '2026-10-01 09:53:01', 'francovich@gmail.com'),
(200, 'Exitoso', '2026-10-01 20:30:06', 'francovich@gmail.com'),
(201, 'Exitoso', '2026-10-01 20:42:49', 'francovich@gmail.com'),
(202, 'Exitoso', '2026-10-02 08:07:19', 'kcarballo625@gmail.com'),
(203, 'Exitoso', '2026-10-02 08:07:57', NULL),
(204, 'Exitoso', '2026-10-02 08:08:35', 'kcarballo625@gmail.com'),
(205, 'Exitoso', '2026-10-02 08:09:12', NULL),
(206, 'Exitoso', '2026-10-02 08:09:39', 'kcarballo625@gmail.com'),
(207, 'Exitoso', '2026-10-02 08:10:07', 'francovich@gmail.com'),
(208, 'Exitoso', '2026-10-02 08:10:35', 'kcarballo625@gmail.com'),
(209, 'Exitoso', '2026-10-02 08:33:19', NULL),
(210, 'Exitoso', '2026-10-02 08:33:56', 'francovich@gmail.com'),
(211, 'Exitoso', '2026-10-02 08:34:14', 'francovich@gmail.com'),
(212, 'Exitoso', '2026-10-02 08:34:24', 'kcarballo625@gmail.com'),
(213, 'Exitoso', '2026-10-03 15:58:43', 'kcarballo625@gmail.com'),
(214, 'Exitoso', '2026-10-03 15:58:57', 'francovich@gmail.com'),
(215, 'Exitoso', '2026-10-03 15:59:18', NULL),
(216, 'Exitoso', '2026-10-03 15:59:26', 'kcarballo625@gmail.com'),
(217, 'Exitoso', '2026-10-03 20:35:16', 'kcarballo625@gmail.com'),
(218, 'Exitoso', '2026-10-03 20:36:14', 'kcarballo625@gmail.com'),
(219, 'Exitoso', '2026-10-03 20:37:15', NULL),
(220, 'Exitoso', '2026-10-03 21:52:49', NULL),
(221, 'Exitoso', '2026-10-04 20:11:58', NULL),
(222, 'Exitoso', '2026-10-04 20:20:58', NULL),
(223, 'Exitoso', '2026-10-05 21:46:46', NULL),
(224, 'Exitoso', '2026-10-06 07:44:54', NULL),
(225, 'Exitoso', '2026-10-06 07:45:05', 'kcarballo625@gmail.com'),
(226, 'Exitoso', '2026-10-06 07:45:42', 'francovich@gmail.com'),
(227, 'Exitoso', '2026-10-06 07:48:15', 'kcarballo625@gmail.com'),
(228, 'Exitoso', '2026-10-08 09:13:46', 'kcarballo625@gmail.com'),
(229, 'Exitoso', '2026-10-08 10:14:27', 'kcarballo625@gmail.com'),
(230, 'Exitoso', '2026-10-08 20:06:27', 'kcarballo625@gmail.com'),
(231, 'Exitoso', '2026-10-09 18:26:46', 'kcarballo625@gmail.com'),
(232, 'Exitoso', '2026-10-09 19:08:17', 'kcarballo625@gmail.com'),
(233, 'Exitoso', '2026-10-09 19:10:13', NULL),
(234, 'Exitoso', '2026-10-14 20:17:39', NULL),
(235, 'Exitoso', '2026-10-15 09:20:33', NULL),
(236, 'Exitoso', '2026-10-15 09:20:59', NULL),
(237, 'Exitoso', '2026-10-16 20:54:48', NULL),
(238, 'Exitoso', '2026-10-17 19:40:04', NULL),
(239, 'Exitoso', '2026-10-18 12:51:05', NULL),
(240, 'Exitoso', '2026-10-20 18:11:45', NULL),
(241, 'Exitoso', '2026-10-20 18:11:53', 'kcarballo625@gmail.com'),
(242, 'Exitoso', '2026-10-23 09:38:50', 'kcarballo625@gmail.com'),
(243, 'Exitoso', '2026-10-23 09:38:50', 'kcarballo625@gmail.com'),
(244, 'Exitoso', '2026-10-23 09:39:08', NULL),
(245, 'Exitoso', '2026-10-23 09:39:12', NULL),
(246, 'Exitoso', '2026-10-23 09:39:28', 'kcarballo625@gmail.com'),
(247, 'Exitoso', '2026-10-23 09:40:48', NULL),
(248, 'Exitoso', '2026-10-23 09:43:14', NULL),
(249, 'Exitoso', '2026-10-23 09:43:33', 'kcarballo625@gmail.com'),
(250, 'Exitoso', '2026-10-23 09:49:16', 'kcarballo625@gmail.com'),
(251, 'Exitoso', '2026-10-23 09:51:37', 'francovich@gmail.com'),
(252, 'Exitoso', '2026-10-23 10:16:15', NULL),
(253, 'Exitoso', '2026-10-23 10:19:19', 'kcarballo625@gmail.com'),
(254, 'Exitoso', '2026-10-23 10:21:06', NULL),
(255, 'Exitoso', '2026-10-23 10:21:36', 'francovich@gmail.com'),
(256, 'Exitoso', '2026-10-23 10:22:32', NULL),
(257, 'Exitoso', '2026-10-23 10:22:50', 'kcarballo625@gmail.com'),
(258, 'Exitoso', '2026-10-23 10:24:13', NULL),
(259, 'Exitoso', '2026-10-24 21:15:22', NULL),
(260, 'Exitoso', '2026-10-24 21:15:30', 'kcarballo625@gmail.com'),
(261, 'Exitoso', '2026-10-24 21:15:38', NULL),
(262, 'Exitoso', '2026-10-24 21:15:56', 'kcarballo625@gmail.com'),
(263, 'Exitoso', '2026-10-24 21:16:48', NULL),
(264, 'Exitoso', '2026-10-24 21:16:52', NULL),
(265, 'Exitoso', '2026-10-24 21:17:09', 'kcarballo625@gmail.com'),
(266, 'Exitoso', '2026-10-24 21:17:33', NULL),
(267, 'Exitoso', '2026-10-24 21:18:26', 'kcarballo625@gmail.com'),
(268, 'Exitoso', '2026-10-24 21:18:47', 'francovich@gmail.com'),
(269, 'Exitoso', '2026-10-27 12:19:50', NULL),
(270, 'Exitoso', '2026-10-29 09:28:12', NULL),
(271, 'Exitoso', '2026-10-29 09:32:51', 'kcarballo625@gmail.com'),
(272, 'Exitoso', '2026-10-29 09:38:35', NULL),
(273, 'Exitoso', '2026-10-30 17:37:28', NULL),
(274, 'Exitoso', '2026-10-30 17:44:54', 'kcarballo625@gmail.com'),
(275, 'Exitoso', '2026-10-30 17:45:05', NULL),
(276, 'Exitoso', '2026-10-30 17:45:23', 'francovich@gmail.com'),
(277, 'Exitoso', '2026-10-30 17:45:38', 'kcarballo625@gmail.com'),
(278, 'Exitoso', '2026-10-30 17:46:51', 'francovich@gmail.com'),
(279, 'Exitoso', '2026-11-01 11:23:46', 'kcarballo625@gmail.com'),
(280, 'Exitoso', '2026-11-01 11:23:59', 'francovich@gmail.com'),
(281, 'Exitoso', '2026-11-01 17:58:42', 'kcarballo625@gmail.com'),
(282, 'Exitoso', '2026-11-01 17:58:51', NULL),
(283, 'Exitoso', '2026-11-02 19:37:12', NULL),
(284, 'Exitoso', '2026-11-02 19:54:07', 'francovich@gmail.com'),
(285, 'Exitoso', '2026-11-02 19:54:30', 'kcarballo625@gmail.com'),
(286, 'Exitoso', '2026-11-02 19:55:04', NULL),
(287, 'Exitoso', '2026-11-02 19:56:13', 'kcarballo625@gmail.com'),
(288, 'Exitoso', '2026-11-02 19:56:35', 'francovich@gmail.com'),
(289, 'Exitoso', '2026-11-03 17:45:05', 'francovich@gmail.com'),
(290, 'Exitoso', '2026-11-03 18:19:32', NULL),
(291, 'Exitoso', '2026-11-06 09:25:08', NULL),
(292, 'Exitoso', '2026-11-06 09:28:26', NULL),
(293, 'Exitoso', '2026-11-06 18:04:15', NULL),
(294, 'Exitoso', '2026-11-06 18:04:33', 'kcarballo625@gmail.com'),
(295, 'Exitoso', '2026-11-06 18:06:07', NULL),
(296, 'Exitoso', '2026-11-06 18:06:26', NULL),
(297, 'Exitoso', '2026-11-06 18:32:12', 'kcarballo625@gmail.com'),
(298, 'Exitoso', '2026-11-06 18:32:27', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencia`
--

CREATE TABLE `incidencia` (
  `ID_incidencia` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `ID_operario` varchar(150) DEFAULT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL,
  `imagen` longtext DEFAULT NULL,
  `calle` varchar(50) DEFAULT NULL,
  `numero` int(50) DEFAULT NULL,
  `barrio` varchar(50) DEFAULT NULL,
  `lat` decimal(10,7) NOT NULL,
  `lon` decimal(10,7) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `tipoContenedor` varchar(100) NOT NULL,
  `ID_cuadrilla` int(11) DEFAULT NULL,
  `ID_contenedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `incidencia`
--

INSERT INTO `incidencia` (`ID_incidencia`, `mail`, `ID_operario`, `tipo`, `estado`, `imagen`, `calle`, `numero`, `barrio`, `lat`, `lon`, `fecha_creacion`, `tipoContenedor`, `ID_cuadrilla`, `ID_contenedor`) VALUES
(18, 'kcarballo625@gmail.com', 'Kevin Carballo', 'rotura', 'Terminada', '', 'Av Ramon Anador', 3681, 'Buceo', -34.8939180, -56.1357610, '2026-10-23 09:40:38', 'Naranja', 3, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `integrante_cuadrilla`
--

CREATE TABLE `integrante_cuadrilla` (
  `ID_cuadrilla` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `rol` varchar(10) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `integrante_cuadrilla`
--

INSERT INTO `integrante_cuadrilla` (`ID_cuadrilla`, `mail`, `rol`, `fecha`) VALUES
(1, 'gonzallovet@gmail.com', 'Recolector', '2026-09-11'),
(1, 'jm4092395@gmail.com', 'Recolector', '2026-09-11'),
(1, 'kcarballo625@gmail.com', 'Recolector', '2026-09-11'),
(1, 'oramasfacu@gmail.com', 'Recolector', '2026-09-11'),
(2, 'gonzallovet@gmail.com', 'Recolector', '2026-09-11'),
(2, 'jm4092395@gmail.com', 'Recolector', '2026-09-11'),
(2, 'kcarballo625@gmail.com', 'Recolector', '2026-09-11'),
(2, 'oramasfacu@gmail.com', 'Recolector', '2026-09-11'),
(3, 'francovich@gmail.com', 'Recolector', '2026-10-02'),
(3, 'gonzallovet@gmail.com', 'Recolector', '2026-10-02'),
(3, 'jm4092395@gmail.com', 'Recolector', '2026-10-02'),
(3, 'oramasfacu@gmail.com', 'Recolector', '2026-10-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento`
--

CREATE TABLE `mantenimiento` (
  `ID_mantenimiento` int(11) NOT NULL,
  `matricula` varchar(8) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion`
--

CREATE TABLE `notificacion` (
  `ID_notificacion` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `ID_incidencia` int(11) NOT NULL,
  `mensaje` varchar(255) NOT NULL,
  `leida` tinyint(1) NOT NULL DEFAULT 0,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recoleccion`
--

CREATE TABLE `recoleccion` (
  `ID_recoleccion` int(11) NOT NULL,
  `matricula` varchar(8) DEFAULT NULL,
  `ID_contenedor` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recorrido`
--

CREATE TABLE `recorrido` (
  `ID_recorrido` int(11) NOT NULL,
  `ID_ruta` int(11) DEFAULT NULL,
  `ID_cuadrilla` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `ID_registro` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `estado` varchar(30) DEFAULT 'Pendiente',
  `mailAdmin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`ID_registro`, `mail`, `fecha`, `estado`, `mailAdmin`) VALUES
(2, 'kcarballo625@gmail.com', '2026-07-18 19:04:32', 'Aceptado', NULL),
(3, 'gonzallovet@gmail.com', '2026-07-20 19:45:17', 'Aceptado', NULL),
(4, 'nachotrullen@gmail.com', '2026-07-20 20:15:45', 'Aceptado', NULL),
(5, 'aguslandin@gmail.com', '2026-07-20 20:28:41', 'Rechazado', NULL),
(6, 'laracasanova@gmail.com', '2026-07-20 20:29:14', 'Aceptado', NULL),
(7, 'francoalmiron@gmail.com', '2026-07-20 20:29:39', 'Rechazado', NULL),
(8, 'juanteper@gmail.com', '2026-07-23 10:38:21', 'Aceptado', NULL),
(9, 'pedro@gmail', '2026-07-24 09:25:24', 'Rechazado', NULL),
(11, 'franalmiron@gmail.com', '2026-09-01 11:14:45', 'Aceptado', NULL),
(12, 'francovich@gmail.com', '2026-09-01 11:18:51', 'Aceptado', NULL),
(13, 'jm4092395@gmail.com', '2026-09-10 09:03:51', 'Aceptado', NULL),
(14, 'oramasfacu@gmail.com', '2026-09-11 10:35:59', 'Aceptado', NULL),
(15, 'yurietchebarne@gmail.com', '2026-09-11 10:39:09', 'Aceptado', NULL),
(16, 'facundocarlosvillanueva@gmail.com', '2026-09-11 10:40:25', 'Aceptado', NULL),
(17, 'jaab@gmail', '2026-09-17 10:21:13', 'Aceptado', NULL),
(18, 'jaab@gmail.com', '2026-09-17 10:25:18', 'Aceptado', NULL),
(19, 'franco2008almiron@gmail.com', '2026-11-06 09:28:03', 'Aceptado', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta`
--

CREATE TABLE `ruta` (
  `ID_ruta` int(11) NOT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `ID_Cuadrilla` int(11) DEFAULT NULL,
  `estado` varchar(100) NOT NULL DEFAULT 'Pendiente',
  `nombre` varchar(100) NOT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `iniciada_por` varchar(255) DEFAULT NULL,
  `finalizada_por` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ruta`
--

INSERT INTO `ruta` (`ID_ruta`, `fecha_creacion`, `ID_Cuadrilla`, `estado`, `nombre`, `fecha_inicio`, `fecha_fin`, `iniciada_por`, `finalizada_por`) VALUES
(19, '2026-11-02 19:56:01', 3, 'Finalizada', 'Ruta9', '2026-11-02 19:56:41', '2026-11-03 17:46:58', 'francovich@gmail.com', 'francovich@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutacanton`
--

CREATE TABLE `rutacanton` (
  `ID_ruta` int(11) DEFAULT NULL,
  `ID_canton` int(11) DEFAULT NULL,
  `tipo` enum('Inicia','Termina') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutaparada`
--

CREATE TABLE `rutaparada` (
  `ID_parada` int(11) NOT NULL,
  `ID_ruta` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  `ID_contenedor` int(11) DEFAULT NULL,
  `ID_acopio` int(11) DEFAULT NULL,
  `lat` decimal(10,7) NOT NULL,
  `lon` decimal(10,7) NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rutaparada`
--

INSERT INTO `rutaparada` (`ID_parada`, `ID_ruta`, `orden`, `ID_contenedor`, `ID_acopio`, `lat`, `lon`, `estado`) VALUES
(38, 19, 1, NULL, 5, -34.8867520, -56.1264680, 'Pendiente'),
(39, 19, 2, 7, NULL, -34.8866360, -56.1238250, 'Recogido'),
(40, 19, 3, NULL, 5, -34.8867520, -56.1264680, 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `a2f` tinyint(1) DEFAULT 0,
  `estado` enum('Activo','Inactivo') DEFAULT 'Activo',
  `rol` enum('Administrador','Operario','Recolector','Vecino') NOT NULL,
  `nickname` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre`, `apellido`, `mail`, `contrasena`, `a2f`, `estado`, `rol`, `nickname`) VALUES
('Agustina', 'Landin', 'aguslandin@gmail.com', '$2y$10$m6MJybdsj7EUGPXJeBYMm.DzRkqfbEm6VxsPBz60rIhB9XCUW/AEe', 0, 'Inactivo', 'Vecino', 'agus'),
('Emilia', 'Etchebarne', 'emietc@gmail.com', '$2y$10$nBuEGe9lkfGKpQLnnL00M.i/CtmhN9zYZNYT2iYoJc8gmmTDwrbLG', 0, 'Activo', 'Administrador', 'memi'),
('Facundo', 'Villanueva', 'facundocarlosvillanueva@gmail.com', '$2y$10$bMlPxZfBaWn66TVcuWaVgenUDy6WWuagwFoFMBK9ZlnIq0dzmdj/K', 0, 'Activo', 'Vecino', 'facu9942'),
('Franco', 'Almiron', 'franalmiron@gmail.com', '$2y$10$Bx9g4s0RMuGOMlJ8vPstgOzQ9uDg1ncjKg4irhnbV.musPl6IcMwS', 0, 'Inactivo', 'Vecino', 'frann'),
('franco', 'almiron', 'franco2008almiron@gmail.com', '$2y$10$DrHR0aLnyalvQ/i2XddVHe7jaKSH68cMb4.54KibO.J7jqJiZ9zYW', 0, 'Activo', 'Operario', 'franco'),
('Franco', 'Almiron', 'francoalmiron@gmail.com', '$2y$10$og7x4RxPr3O/rdzpA60c4ut2sKRjrltOzcPCy3JHn0ziojcC89Sxi', 0, 'Inactivo', 'Vecino', 'franco'),
('franco', 'almiron', 'francovich@gmail.com', '$2y$10$pL5DMZz4QWlSw1GOBqPq/Omj.9jqWyB5yZ0OsY09OQ6L2AS66Gepe', 0, 'Activo', 'Recolector', 'frann'),
('Gonza', 'Llovet', 'gonzallovet@gmail.com', '$2y$10$ffKmrTCCRrVz4fv8Ekn/N.T0aV6Z97PcBEeh8oTZ3/OQo80j54l/a', 0, 'Activo', 'Recolector', 'gonzanmapa'),
('jorge', 'alvarez', 'jaab@gmail', '$2y$10$lgCOnzk/uzEVZSwVjlnZ9OsUzXEUXiq8.T145NfWQO6PUS7Pn4fr6', 0, 'Activo', 'Administrador', 'jorgeDanubio'),
('jorge', 'alvarez', 'jaab@gmail.com', '$2y$10$.XTeLJGRuckXfGTkrgylPuBuh7NpsG4aYTs443VjyMxdzutuQSsQW', 0, 'Activo', 'Vecino', 'JorgeAlvarez'),
('Juan', 'Ponce', 'jm4092395@gmail.com', '$2y$10$LOeBLdLrHz3cGi45PcH4PeHUDsmUsKqTawfhLYzdS.5TjbXztMJN6', 0, 'Activo', 'Recolector', 'juancho'),
('Juan', 'Teper', 'juanteper@gmail.com', '$2y$10$MmWiZTzKd5UtpikaKLeYUucbd47CvBlcQBtYNM65M4vc9.qldaGR.', 0, 'Inactivo', 'Vecino', 'jjuan'),
('Kevin', 'Carballo', 'kcarballo625@gmail.com', '$2y$10$kv2WHmqiAx/KCMrIoxjzQ.n8.gk/IGRqIRzqmA6JuMMpv9KRuVIqi', 0, 'Activo', 'Operario', 'Kevshok'),
('Lara', 'Casanova', 'laracasanova@gmail.com', '$2y$10$9J0Uw8mk6Ab32wW/eP5g1eqK9lw9thuwNVA8q6AHl864aOaZdhIWi', 0, 'Inactivo', 'Vecino', 'lara'),
('Nacho', 'tulle', 'nachotrullen@gmail.com', '$2y$10$5qhoIL6bIfdHpTjzYDm3k.K7gEpBCsjx2pxm58MINamvOtZ8bgtSi', 0, 'Inactivo', 'Vecino', 'nacho'),
('Facundo', 'Oramash', 'oramasfacu@gmail.com', '$2y$10$OTYFKeixuLyulYRdkeeQc.3q7v63b8gMc2EpCfut9oVa9dXDKFufe', 0, 'Activo', 'Recolector', 'El_C4cas'),
('111111', 'gonza', 'pedro@gmail', '$2y$10$gCEAu946UirM.t.5g2L6SOuI9Q2ti.6kfPDgfuJTD.BzxwOMYZEp.', 0, 'Inactivo', 'Vecino', 'pepe'),
('Yuri', 'Etchebarne', 'yurietchebarne@gmail.com', '$2y$10$Ggd.tTUMJckxcI5MSkFd7uaSnfi.F7uWgCYxlmQkojkbuwUkYNaiG', 0, 'Activo', 'Vecino', 'yurietc');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vertedero`
--

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
  ADD KEY `mail` (`mail`),
  ADD KEY `fk_id_cuadrilla` (`ID_cuadrilla`),
  ADD KEY `ID_contenedor` (`ID_contenedor`);

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
-- Indices de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD PRIMARY KEY (`ID_notificacion`);

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
  ADD PRIMARY KEY (`ID_ruta`),
  ADD KEY `fk_ruta_cuadrilla` (`ID_Cuadrilla`),
  ADD KEY `fk_ruta_iniciada_por` (`iniciada_por`),
  ADD KEY `fk_ruta_finalizada_por` (`finalizada_por`);

--
-- Indices de la tabla `rutaparada`
--
ALTER TABLE `rutaparada`
  ADD PRIMARY KEY (`ID_parada`),
  ADD KEY `rutaid` (`ID_ruta`),
  ADD KEY `rutacontenedor` (`ID_contenedor`),
  ADD KEY `rutaacopio` (`ID_acopio`);

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
  MODIFY `ID_cuadrilla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `canton`
--
ALTER TABLE `canton`
  MODIFY `ID_canton` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `centro_acopio`
--
ALTER TABLE `centro_acopio`
  MODIFY `ID_acopio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `contenedor`
--
ALTER TABLE `contenedor`
  MODIFY `ID_contenedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `cuadrilla`
--
ALTER TABLE `cuadrilla`
  MODIFY `ID_cuadrilla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `ID_Login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=299;

--
-- AUTO_INCREMENT de la tabla `incidencia`
--
ALTER TABLE `incidencia`
  MODIFY `ID_incidencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  MODIFY `ID_mantenimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  MODIFY `ID_notificacion` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `ID_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `ruta`
--
ALTER TABLE `ruta`
  MODIFY `ID_ruta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `rutaparada`
--
ALTER TABLE `rutaparada`
  MODIFY `ID_parada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `vertedero`
--
ALTER TABLE `vertedero`
  MODIFY `ID_vertedero` int(11) NOT NULL AUTO_INCREMENT;

--
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
  ADD CONSTRAINT `fk_id_cuadrilla` FOREIGN KEY (`ID_cuadrilla`) REFERENCES `cuadrilla` (`ID_cuadrilla`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `incidencia_ibfk_1` FOREIGN KEY (`mail`) REFERENCES `usuario` (`mail`),
  ADD CONSTRAINT `incidencia_ibfk_contenedor` FOREIGN KEY (`ID_contenedor`) REFERENCES `contenedor` (`ID_contenedor`) ON DELETE SET NULL;

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

--
-- Filtros para la tabla `ruta`
--
ALTER TABLE `ruta`
  ADD CONSTRAINT `fk_ruta_cuadrilla` FOREIGN KEY (`ID_Cuadrilla`) REFERENCES `cuadrilla` (`ID_cuadrilla`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ruta_finalizada_por` FOREIGN KEY (`finalizada_por`) REFERENCES `usuario` (`mail`),
  ADD CONSTRAINT `fk_ruta_iniciada_por` FOREIGN KEY (`iniciada_por`) REFERENCES `usuario` (`mail`);

--
-- Filtros para la tabla `rutaparada`
--
ALTER TABLE `rutaparada`
  ADD CONSTRAINT `rutaacopio` FOREIGN KEY (`ID_acopio`) REFERENCES `centro_acopio` (`ID_acopio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rutacontenedor` FOREIGN KEY (`ID_contenedor`) REFERENCES `contenedor` (`ID_contenedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rutaid` FOREIGN KEY (`ID_ruta`) REFERENCES `ruta` (`ID_ruta`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
