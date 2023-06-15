-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-04-2023 a las 11:27:44
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pacheco`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE `consultas` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Telefono` varchar(9) NOT NULL,
  `Titulo_Consulta` varchar(20) NOT NULL,
  `Consulta` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platos`
--

CREATE TABLE `platos` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Descripcion` varchar(120) NOT NULL,
  `Tipo_Plato` varchar(10) NOT NULL,
  `Foto` varchar(50) NOT NULL,
  `id_trabajador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `platos`
--

INSERT INTO `platos` (`id`, `Nombre`, `Descripcion`, `Tipo_Plato`, `Foto`, `id_trabajador`) VALUES
(33, 'Vino', 'Vino tinto', 'Bebidas', 'vino.jpg', 41),
(34, 'Pizza', 'Pizza normal', 'Segundo', 'pizza.jpg', 41),
(35, 'Ensalada pasta', 'Enlasada pasta fria', 'Primero', 'ensalada pasta.jpg', 41),
(36, 'Tarta queso', 'Tarta Queso ', 'Postre', 'tartaqueso.jpg', 41);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Telefono` varchar(20) NOT NULL,
  `Asistentes` int(2) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `Discapacidad` tinyint(1) DEFAULT NULL,
  `Mensaje` varchar(156) NOT NULL,
  `id_trabajador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador`
--

CREATE TABLE `trabajador` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Primer_Apellido` varchar(20) NOT NULL,
  `Segundo_Apellido` varchar(20) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Tipo_Cargo` varchar(20) NOT NULL,
  `Password` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `trabajador`
--

INSERT INTO `trabajador` (`id`, `Nombre`, `Primer_Apellido`, `Segundo_Apellido`, `Email`, `Tipo_Cargo`, `Password`) VALUES
(41, 'Cristian', 'Lafoz', 'clafoz@gmail.com', 'clafoz@gmail.com', 'Administrador', '$2y$10$Iwr9A7y0L9tDXBJ2fUVjiuR4N2peRCYn2EoSa7L/kiiv1zB9LBOo6'),
(51, 'Cliente Anonimo', 'Cliente', 'Anonimo', 'Cliente Anonimo', '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `platos`
--
ALTER TABLE `platos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_trabajador` (`id_trabajador`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_reservas_trabajadores` (`id_trabajador`);

--
-- Indices de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `platos`
--
ALTER TABLE `platos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `platos`
--
ALTER TABLE `platos`
  ADD CONSTRAINT `platos_ibfk_1` FOREIGN KEY (`id_trabajador`) REFERENCES `trabajador` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `FK_reservas_trabajadores` FOREIGN KEY (`id_trabajador`) REFERENCES `trabajador` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_trabajador`) REFERENCES `trabajador` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
