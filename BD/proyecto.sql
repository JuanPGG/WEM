-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-10-2020 a las 16:25:40
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--
CREATE DATABASE IF NOT EXISTS `proyecto` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `proyecto`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ambiente`
--

CREATE TABLE `ambiente` (
  `id_Ambiente` int(11) NOT NULL,
  `Nombre_Ambiente` varchar(80) NOT NULL,
  `Descripcion_Ambiente` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ambiente`
--

INSERT INTO `ambiente` (`id_Ambiente`, `Nombre_Ambiente`, `Descripcion_Ambiente`) VALUES
(1, 'Informática 3', 'Pertenece al área adsi'),
(2, 'Informática 2', 'Pertenece al área adsi'),
(10, 'Informatica 1', 'aa'),
(12, 'Aula 5', 'No se');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competencia`
--

CREATE TABLE `competencia` (
  `id_Competencia` int(11) NOT NULL,
  `Nombre_Comp` varchar(150) NOT NULL,
  `Descripcion_Comp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `competencia`
--

INSERT INTO `competencia` (`id_Competencia`, `Nombre_Comp`, `Descripcion_Comp`) VALUES
(1, 'Analizar', 'Analisis del proyecto'),
(2, 'Especificar', 'Especificar requisitos de proyecto'),
(6, 'Hola', 'Que tal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_horario`
--

CREATE TABLE `detalles_horario` (
  `id_Detalles_Horario` int(11) NOT NULL,
  `dia` varchar(50) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `id_Ambiente` int(11) NOT NULL,
  `id_Competencia` int(11) NOT NULL,
  `id_Instructor` int(11) NOT NULL,
  `id_Horario` int(11) NOT NULL,
  `id_Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalles_horario`
--

INSERT INTO `detalles_horario` (`id_Detalles_Horario`, `dia`, `hora_inicio`, `hora_fin`, `id_Ambiente`, `id_Competencia`, `id_Instructor`, `id_Horario`, `id_Usuario`) VALUES
(76, 'Martes', '09:00:00', '12:00:00', 1, 1, 49, 26, 2),
(77, 'Martes', '09:00:00', '12:00:00', 1, 1, 49, 26, 2),
(78, 'Martes', '09:00:00', '12:00:00', 1, 1, 49, 26, 2),
(79, 'Martes', '09:00:00', '12:00:00', 1, 1, 49, 26, 2),
(80, 'Martes', '09:00:00', '12:00:00', 1, 1, 49, 26, 2),
(81, 'Martes', '09:00:00', '12:00:00', 1, 1, 49, 26, 2),
(82, 'Miercoles', '09:00:00', '12:00:00', 2, 2, 49, 26, 2),
(83, 'Lunes', '09:00:00', '12:00:00', 1, 2, 49, 26, 2),
(84, 'Viernes', '09:00:00', '12:00:00', 10, 1, 49, 26, 2),
(85, 'Jueves', '09:00:00', '12:00:00', 12, 6, 40, 26, 2),
(86, 'Jueves', '09:00:00', '12:00:00', 2, 2, 49, 26, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha`
--

CREATE TABLE `ficha` (
  `id_Ficha` int(11) NOT NULL,
  `Nombre_Gestor` varchar(120) NOT NULL,
  `Numero_Ficha` varchar(30) NOT NULL,
  `id_Programa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ficha`
--

INSERT INTO `ficha` (`id_Ficha`, `Nombre_Gestor`, `Numero_Ficha`, `id_Programa`) VALUES
(29, 'Edwy Alexander Patiño', '1835082', 1),
(30, 'Juan Pablo', '1234567', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `id_Horario` int(11) NOT NULL,
  `Trimestre` varchar(50) NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Fin` date NOT NULL,
  `id_Ficha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`id_Horario`, `Trimestre`, `Fecha_Inicio`, `Fecha_Fin`, `id_Ficha`) VALUES
(26, 'Trimestre 1', '2020-09-18', '2020-12-18', 29),
(27, 'Trimestre 2', '2020-09-18', '2020-09-24', 29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instructor`
--

CREATE TABLE `instructor` (
  `id_Instructor` int(11) NOT NULL,
  `Nombres` varchar(80) NOT NULL,
  `Apellidos` varchar(80) NOT NULL,
  `Documento` varchar(30) NOT NULL,
  `Correo` varchar(150) NOT NULL,
  `Color` varchar(30) NOT NULL,
  `id_TipoContrato` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `instructor`
--

INSERT INTO `instructor` (`id_Instructor`, `Nombres`, `Apellidos`, `Documento`, `Correo`, `Color`, `id_TipoContrato`) VALUES
(40, 'Lee', 'Escobar', '123', 'lee@misena.edu.co', '#eb5505', 1),
(49, 'Edwy', 'Patiño', '1', 'edwy@misena.edu.co', '#0a47ff', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa_formacion`
--

CREATE TABLE `programa_formacion` (
  `id_Programa` int(11) NOT NULL,
  `Nombre_Programa` varchar(120) NOT NULL,
  `Descripcion_Programa` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `programa_formacion`
--

INSERT INTO `programa_formacion` (`id_Programa`, `Nombre_Programa`, `Descripcion_Programa`) VALUES
(1, 'ADSI', 'Análisis y Desarrollo de Sistemas de Informacion'),
(10, 'SST', 'Seguridad y Salud en el Trabajo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_Rol` int(11) NOT NULL,
  `Nombre_Rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocontrato`
--

CREATE TABLE `tipocontrato` (
  `id_TipoContrato` int(11) NOT NULL,
  `Descripcion_TipoContrato` varchar(255) NOT NULL,
  `Horas_TipoContrato` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipocontrato`
--

INSERT INTO `tipocontrato` (`id_TipoContrato`, `Descripcion_TipoContrato`, `Horas_TipoContrato`) VALUES
(1, 'Planta', 32),
(2, 'Contratista', 40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_Usuario` int(11) NOT NULL,
  `Nombres` varchar(80) NOT NULL,
  `Apellidos` varchar(80) NOT NULL,
  `Correo` varchar(150) NOT NULL,
  `Contrasena` varchar(150) NOT NULL,
  `Token` varchar(50) DEFAULT NULL,
  `id_Rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_Usuario`, `Nombres`, `Apellidos`, `Correo`, `Contrasena`, `Token`, `id_Rol`) VALUES
(2, 'Juan Pablo', 'Guevara', 'juanpa2062@hotmail.com', '81dc9bdb52d04dc20036dbd8313ed055', NULL, NULL),
(3, 'Proyecto Wem', 'Sena', 'proyectowemsena@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ambiente`
--
ALTER TABLE `ambiente`
  ADD PRIMARY KEY (`id_Ambiente`);

--
-- Indices de la tabla `competencia`
--
ALTER TABLE `competencia`
  ADD PRIMARY KEY (`id_Competencia`);

--
-- Indices de la tabla `detalles_horario`
--
ALTER TABLE `detalles_horario`
  ADD PRIMARY KEY (`id_Detalles_Horario`),
  ADD KEY `id_Ambiente` (`id_Ambiente`),
  ADD KEY `id_Instructor` (`id_Instructor`),
  ADD KEY `id_Horario` (`id_Horario`),
  ADD KEY `id_Usuario` (`id_Usuario`),
  ADD KEY `id_Competencia` (`id_Competencia`);

--
-- Indices de la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD PRIMARY KEY (`id_Ficha`),
  ADD KEY `id_Programa` (`id_Programa`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id_Horario`),
  ADD KEY `id_Ficha` (`id_Ficha`);

--
-- Indices de la tabla `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`id_Instructor`),
  ADD KEY `id_TipoContrato` (`id_TipoContrato`);

--
-- Indices de la tabla `programa_formacion`
--
ALTER TABLE `programa_formacion`
  ADD PRIMARY KEY (`id_Programa`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_Rol`);

--
-- Indices de la tabla `tipocontrato`
--
ALTER TABLE `tipocontrato`
  ADD PRIMARY KEY (`id_TipoContrato`) USING BTREE;

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_Usuario`),
  ADD KEY `id_Rol` (`id_Rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ambiente`
--
ALTER TABLE `ambiente`
  MODIFY `id_Ambiente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `competencia`
--
ALTER TABLE `competencia`
  MODIFY `id_Competencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalles_horario`
--
ALTER TABLE `detalles_horario`
  MODIFY `id_Detalles_Horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de la tabla `ficha`
--
ALTER TABLE `ficha`
  MODIFY `id_Ficha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `id_Horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `instructor`
--
ALTER TABLE `instructor`
  MODIFY `id_Instructor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `programa_formacion`
--
ALTER TABLE `programa_formacion`
  MODIFY `id_Programa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_Rol` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipocontrato`
--
ALTER TABLE `tipocontrato`
  MODIFY `id_TipoContrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles_horario`
--
ALTER TABLE `detalles_horario`
  ADD CONSTRAINT `detalles_horario_ibfk_1` FOREIGN KEY (`id_Competencia`) REFERENCES `competencia` (`id_Competencia`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
