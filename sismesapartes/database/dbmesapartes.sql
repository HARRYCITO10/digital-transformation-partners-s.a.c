-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 19-09-2023 a las 00:29:38
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbmesapartes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `descripcion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `nombre`, `descripcion`) VALUES
(3, 'MESA DE PARTES', 'el administrador principal'),
(10, 'GESTION', 'todo lo relacionado a ello'),
(11, 'ESTADISTICAS', 'jsdjdj'),
(13, 'CONTABILIDAD', 'hgshsdh');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expedientes`
--

CREATE TABLE `expedientes` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `remitente` varchar(250) NOT NULL,
  `tipo_doc` varchar(250) NOT NULL,
  `asunto` varchar(250) NOT NULL,
  `folio` varchar(250) NOT NULL,
  `archivo` varchar(250) NOT NULL,
  `tipo_persona` varchar(250) NOT NULL,
  `num_doc` varchar(250) NOT NULL,
  `correo` varchar(250) NOT NULL,
  `telefono` varchar(250) NOT NULL,
  `num_expediente` varchar(250) NOT NULL,
  `cod_seguridad` varchar(250) NOT NULL,
  `estado` varchar(250) NOT NULL,
  `idarea_destino` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `expedientes`
--

INSERT INTO `expedientes` (`id`, `fecha`, `hora`, `remitente`, `tipo_doc`, `asunto`, `folio`, `archivo`, `tipo_persona`, `num_doc`, `correo`, `telefono`, `num_expediente`, `cod_seguridad`, `estado`, `idarea_destino`) VALUES
(58, '2023-07-25', '16:36:59', 'maria Brass', 'SOLICITUD', 'SOLICITUD DE RECORD ACADEMICO', '1', '1690321019_venta.pdf', 'Natural', '3474378348', 'maria@gmail.com', '4578457458', '00001', '64372', 'en tramite', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tramites`
--

CREATE TABLE `tramites` (
  `id` int(11) NOT NULL,
  `idexpediente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `descripcion` text NOT NULL,
  `adjunto` varchar(250) NOT NULL,
  `usuario` varchar(250) NOT NULL,
  `area` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tramites`
--

INSERT INTO `tramites` (`id`, `idexpediente`, `fecha`, `hora`, `descripcion`, `adjunto`, `usuario`, `area`) VALUES
(122, 58, '2023-07-25', '16:40:57', 'le estoy derivando al area de estadisticas', '1690321257_venta.pdf', 'Luis miguel', '10'),
(123, 58, '2023-07-25', '16:43:28', 'te estoy enviando tu record academico', '1690321408_venta.pdf', 'joel perez', '11'),
(124, 58, '2023-07-25', '16:45:30', 'nuevamente tes etsoy enviando el documento final de record ', '1690321530_venta.pdf', 'Tarea Completo', '3'),
(125, 59, '2023-07-25', '16:48:41', 'por favor corrige tu documento', '1690321721_venta.pdf', 'Tarea Completo', '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombres` varchar(250) NOT NULL,
  `usuario` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `correo` varchar(250) NOT NULL,
  `idarea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `usuario`, `password`, `correo`, `idarea`) VALUES
(1, 'Tarea Completo', 'admin', 'admin', 'admin@gmail.com', 3),
(7, 'Luis miguel', 'luis', 'luis', 'luis@gmail.com', 10),
(8, 'joel perez', 'joel', 'joel', 'joel@gmail.com', 11);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `expedientes`
--
ALTER TABLE `expedientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idarea_destino` (`idarea_destino`);

--
-- Indices de la tabla `tramites`
--
ALTER TABLE `tramites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idexpediente` (`idexpediente`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idarea` (`idarea`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `expedientes`
--
ALTER TABLE `expedientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `tramites`
--
ALTER TABLE `tramites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idarea`) REFERENCES `areas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
