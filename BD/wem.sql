-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-11-2020 a las 22:13:33
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
-- Base de datos: `wem`
--
CREATE DATABASE IF NOT EXISTS `wem` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `wem`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ambiente`
--

CREATE TABLE `ambiente` (
  `id_Ambiente` int(11) NOT NULL,
  `Nombre_Ambiente` varchar(150) NOT NULL,
  `Descripcion_Ambiente` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competencia`
--

CREATE TABLE `competencia` (
  `id_Competencia` int(11) NOT NULL,
  `Nombre_Competencia` varchar(150) NOT NULL,
  `Descripcion_Competencia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha`
--

CREATE TABLE `ficha` (
  `id_Ficha` int(11) NOT NULL,
  `Nombre_Gestor` varchar(120) NOT NULL,
  `Cel_Gestor` varchar(30) DEFAULT NULL,
  `Numero_Ficha` varchar(30) NOT NULL,
  `id_Programa` int(11) NOT NULL,
  `Nombre_Vocero` varchar(120) DEFAULT NULL,
  `Cel_Vocero` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `id_Horario` int(11) NOT NULL,
  `Dia` varchar(50) NOT NULL,
  `Hora_Inicio` time NOT NULL,
  `Hora_Fin` time NOT NULL,
  `id_Ambiente` int(11) NOT NULL,
  `id_Competencia` int(11) NOT NULL,
  `id_Instructor` int(11) NOT NULL,
  `id_Trimestre` int(11) NOT NULL,
  `id_Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Disparadores `horario`
--
DELIMITER $$
CREATE TRIGGER `after_insert_horario` AFTER INSERT ON `horario` FOR EACH ROW insert into trazabilidad
   set Accion = "creacion",
   id_Usuario = NEW.id_Usuario,
   id_Competencia = NEW.id_Competencia,
   id_Trimestre = NEW.id_Trimestre,
   id_Ambiente = NEW.id_Ambiente,
   id_Instructor = NEW.id_Instructor,
   Fecha = now()
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_horario` BEFORE DELETE ON `horario` FOR EACH ROW insert into trazabilidad
   set Accion = "eliminacion",
   id_Usuario = OLD.id_Usuario,
   id_Competencia = OLD.id_Competencia,
   id_Trimestre = OLD.id_Trimestre,
   id_Ambiente = OLD.id_Ambiente,
   id_Instructor = OLD.id_Instructor,
   Fecha = now()
$$
DELIMITER ;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa_formacion`
--

CREATE TABLE `programa_formacion` (
  `id_Programa` int(11) NOT NULL,
  `Nombre_Programa` varchar(120) NOT NULL,
  `Descripcion_Programa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_Rol` int(11) NOT NULL,
  `Nombre_Rol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_Rol`, `Nombre_Rol`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocontrato`
--

CREATE TABLE `tipocontrato` (
  `id_TipoContrato` int(11) NOT NULL,
  `Descripcion_TipoContrato` varchar(255) NOT NULL,
  `Horas_TipoContrato` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trazabilidad`
--

CREATE TABLE `trazabilidad` (
  `id_Trazabilidad` int(11) NOT NULL,
  `id_Usuario` int(11) NOT NULL,
  `id_Competencia` int(11) NOT NULL,
  `id_Trimestre` int(11) NOT NULL,
  `id_Ambiente` int(11) NOT NULL,
  `id_Instructor` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Accion` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trimestre`
--

CREATE TABLE `trimestre` (
  `id_Trimestre` int(11) NOT NULL,
  `Trimestre` varchar(50) NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Fin` date NOT NULL,
  `id_Ficha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `Token` varchar(50) NOT NULL,
  `id_Rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_Usuario`, `Nombres`, `Apellidos`, `Correo`, `Contrasena`, `Token`, `id_Rol`) VALUES
(2, 'Admin', 'Admin', 'admin@admin.com', 'e32f53597fa0afc5afa07fd629314774', '', 1);

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
  ADD KEY `id_Ambiente` (`id_Ambiente`),
  ADD KEY `id_Competencia` (`id_Competencia`),
  ADD KEY `id_Instructor` (`id_Instructor`),
  ADD KEY `id_Trimestre` (`id_Trimestre`),
  ADD KEY `id_Usuario` (`id_Usuario`);

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
  ADD PRIMARY KEY (`id_TipoContrato`);

--
-- Indices de la tabla `trazabilidad`
--
ALTER TABLE `trazabilidad`
  ADD PRIMARY KEY (`id_Trazabilidad`),
  ADD KEY `id_Usuario` (`id_Usuario`),
  ADD KEY `id_Ambiente` (`id_Ambiente`),
  ADD KEY `id_Competencia` (`id_Competencia`),
  ADD KEY `id_Trimestre` (`id_Trimestre`),
  ADD KEY `id_Instructor` (`id_Instructor`);

--
-- Indices de la tabla `trimestre`
--
ALTER TABLE `trimestre`
  ADD PRIMARY KEY (`id_Trimestre`),
  ADD KEY `id_Ficha` (`id_Ficha`);

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
  MODIFY `id_Ambiente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `competencia`
--
ALTER TABLE `competencia`
  MODIFY `id_Competencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ficha`
--
ALTER TABLE `ficha`
  MODIFY `id_Ficha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `id_Horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;

--
-- AUTO_INCREMENT de la tabla `instructor`
--
ALTER TABLE `instructor`
  MODIFY `id_Instructor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `programa_formacion`
--
ALTER TABLE `programa_formacion`
  MODIFY `id_Programa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_Rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipocontrato`
--
ALTER TABLE `tipocontrato`
  MODIFY `id_TipoContrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `trazabilidad`
--
ALTER TABLE `trazabilidad`
  MODIFY `id_Trazabilidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `trimestre`
--
ALTER TABLE `trimestre`
  MODIFY `id_Trimestre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD CONSTRAINT `ficha_ibfk_1` FOREIGN KEY (`id_Programa`) REFERENCES `programa_formacion` (`id_Programa`);

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`id_Ambiente`) REFERENCES `ambiente` (`id_Ambiente`),
  ADD CONSTRAINT `horario_ibfk_2` FOREIGN KEY (`id_Competencia`) REFERENCES `competencia` (`id_Competencia`),
  ADD CONSTRAINT `horario_ibfk_3` FOREIGN KEY (`id_Instructor`) REFERENCES `instructor` (`id_Instructor`),
  ADD CONSTRAINT `horario_ibfk_4` FOREIGN KEY (`id_Trimestre`) REFERENCES `trimestre` (`id_Trimestre`),
  ADD CONSTRAINT `horario_ibfk_5` FOREIGN KEY (`id_Usuario`) REFERENCES `usuario` (`id_Usuario`);

--
-- Filtros para la tabla `instructor`
--
ALTER TABLE `instructor`
  ADD CONSTRAINT `instructor_ibfk_1` FOREIGN KEY (`id_TipoContrato`) REFERENCES `tipocontrato` (`id_TipoContrato`);

--
-- Filtros para la tabla `trazabilidad`
--
ALTER TABLE `trazabilidad`
  ADD CONSTRAINT `trazabilidad_ibfk_1` FOREIGN KEY (`id_Usuario`) REFERENCES `usuario` (`id_Usuario`),
  ADD CONSTRAINT `trazabilidad_ibfk_2` FOREIGN KEY (`id_Ambiente`) REFERENCES `ambiente` (`id_Ambiente`),
  ADD CONSTRAINT `trazabilidad_ibfk_3` FOREIGN KEY (`id_Competencia`) REFERENCES `competencia` (`id_Competencia`),
  ADD CONSTRAINT `trazabilidad_ibfk_4` FOREIGN KEY (`id_Trimestre`) REFERENCES `trimestre` (`id_Trimestre`),
  ADD CONSTRAINT `trazabilidad_ibfk_5` FOREIGN KEY (`id_Instructor`) REFERENCES `instructor` (`id_Instructor`);

--
-- Filtros para la tabla `trimestre`
--
ALTER TABLE `trimestre`
  ADD CONSTRAINT `trimestre_ibfk_2` FOREIGN KEY (`id_Ficha`) REFERENCES `ficha` (`id_Ficha`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_Rol`) REFERENCES `rol` (`id_Rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
