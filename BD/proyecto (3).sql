-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-10-2020 a las 18:09:32
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
(1, 'Informática 1', 'Pertenece al área adsi'),
(2, 'Informática 2', 'Pertenece al área adsi'),
(3, 'Informática 3', 'Pertenece al area adsi');

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
(1, 'Planear', 'Analizar y especificar requisitos de proyecto'),
(2, 'Hacer', 'Desarrollo de interfaces'),
(3, 'Verificar', 'Pruebas de software');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_horario`
--

CREATE TABLE `detalles_horario` (
  `id_Detalles_Horario` int(11) NOT NULL,
  `Dia` varchar(50) NOT NULL,
  `Hora_Inicio` time NOT NULL,
  `Hora_Fin` time NOT NULL,
  `id_Ambiente` int(11) NOT NULL,
  `id_Competencia` int(11) NOT NULL,
  `id_Instructor` int(11) NOT NULL,
  `id_Horario` int(11) NOT NULL,
  `id_Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalles_horario`
--

INSERT INTO `detalles_horario` (`id_Detalles_Horario`, `Dia`, `Hora_Inicio`, `Hora_Fin`, `id_Ambiente`, `id_Competencia`, `id_Instructor`, `id_Horario`, `id_Usuario`) VALUES
(2, 'Lunes', '09:00:00', '12:00:00', 1, 1, 1, 1, 1),
(3, 'Martes', '06:00:00', '09:00:00', 1, 1, 2, 1, 1),
(4, 'Miercoles', '09:00:00', '12:00:00', 2, 3, 3, 1, 1),
(5, 'Martes', '15:00:00', '18:00:00', 3, 2, 1, 1, 1),
(6, 'Jueves', '12:00:00', '15:00:00', 2, 3, 2, 1, 1),
(7, 'Lunes', '18:00:00', '21:00:00', 2, 2, 3, 1, 1),
(8, 'Miercoles', '18:00:00', '21:00:00', 3, 1, 3, 1, 1),
(9, 'Viernes', '15:00:00', '18:00:00', 2, 2, 1, 1, 1),
(10, 'Viernes', '18:00:00', '21:00:00', 2, 1, 2, 1, 1),
(11, 'Viernes', '06:00:00', '09:00:00', 1, 1, 3, 1, 1),
(12, 'Viernes', '09:00:00', '12:00:00', 1, 1, 3, 2, 1),
(13, 'Jueves', '09:00:00', '12:00:00', 2, 1, 1, 3, 1);

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
(1, 'Edwy Alexander Patiño', '1835082', 1),
(2, 'Juan Pablo', '123456', 1),
(3, 'Edilfredo Pineda Florez', '1234567', 2);

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
(1, 'Trimestre 1', '2020-10-03', '2020-10-31', 1),
(2, 'Trimestre 2', '2020-10-03', '2020-10-31', 2),
(3, 'Trimestre 1', '2020-10-07', '2020-10-30', 3);

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
(1, 'Edwy', 'Patiño', '123456789', 'edwy@sena.edu.co', '#e70808', 1),
(2, 'Lee', 'Escobar', '987654321', 'lee@sena.edu.com', '#00bfff', 2),
(3, 'Edilfredo', 'Pineda', '987612345', 'edilfredo@sena.edu.co', '#3dfd08', 2);

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
(1, 'ADSI', 'Análisis y Desarrollo de Sistemas de Informacio'),
(2, 'SST', 'Seguridad y Salud en el Trabajo');

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
(1, 'Juan', 'Guevara', 'juanpa2062@hotmail.com', 'e32f53597fa0afc5afa07fd629314774', NULL, NULL),
(2, 'Juan', 'Guevara', 'proyectowemsena@gmail.com', 'e32f53597fa0afc5afa07fd629314774', NULL, NULL);

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
  MODIFY `id_Ambiente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `competencia`
--
ALTER TABLE `competencia`
  MODIFY `id_Competencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `detalles_horario`
--
ALTER TABLE `detalles_horario`
  MODIFY `id_Detalles_Horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `ficha`
--
ALTER TABLE `ficha`
  MODIFY `id_Ficha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `id_Horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `instructor`
--
ALTER TABLE `instructor`
  MODIFY `id_Instructor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `programa_formacion`
--
ALTER TABLE `programa_formacion`
  MODIFY `id_Programa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_Rol` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipocontrato`
--
ALTER TABLE `tipocontrato`
  MODIFY `id_TipoContrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
