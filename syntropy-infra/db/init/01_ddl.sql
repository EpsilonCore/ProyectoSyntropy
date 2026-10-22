-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2026 a las 22:33:46
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
CREATE DATABASE IF NOT EXISTS `syntropy` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `syntropy`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camion`
--

CREATE TABLE `camion` (
  `matricula` varchar(8) NOT NULL,
  `tipo` varchar(15) DEFAULT NULL,
  `capacidadCarga` int(11) DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `ubicacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta`
--

CREATE TABLE `ruta` (
  `ID_ruta` int(11) NOT NULL,
  `fecha_creacion` varchar(15) DEFAULT NULL,
  `ID_Cuadrilla` int(11) DEFAULT NULL,
  `estado` varchar(100) NOT NULL DEFAULT 'Pendiente',
  `nombre` varchar(100) NOT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `iniciada_por` varchar(255) DEFAULT NULL,
  `finalizada_por` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `ID_Login` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `ID_registro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ruta`
--
ALTER TABLE `ruta`
  MODIFY `ID_ruta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rutaparada`
--
ALTER TABLE `rutaparada`
  MODIFY `ID_parada` int(11) NOT NULL AUTO_INCREMENT;

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
