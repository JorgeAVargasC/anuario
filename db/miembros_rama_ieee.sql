-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-07-2021 a las 21:20:08
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `miembros_rama_ieee`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admins`
--

CREATE TABLE `admins` (
  `id_admin` int(10) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`id_admin`, `usuario`, `nombre`, `password`) VALUES
(1, 'jvargas', 'Jorge Andrés Vargas', '$2y$12$K.sqU2VjnzgMF5kl71BXiuQgtysJZ4GiEqGj0.vXPDpKk2Mw0ubvO'),
(2, 'admin', 'Super Usuario', '$2y$12$G1p3YBNUfUvT2s5QbIMLQ.cF65Z0nZdVk4L3660ec4Tj7FxiGTtdu');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL,
  `cargo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id`, `cargo`) VALUES
(1, 'Coordinador TET'),
(2, 'Web Master'),
(3, 'Coordinadora WIE'),
(4, 'Presidente'),
(5, 'Viscepresidente'),
(6, 'Fiscal'),
(7, 'Tesorero'),
(8, 'Secretario'),
(9, 'Coordinador'),
(10, 'Voluntario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos_de_miembros`
--

CREATE TABLE `cargos_de_miembros` (
  `id` int(11) NOT NULL,
  `miembro` int(11) NOT NULL,
  `cargo` int(11) NOT NULL,
  `comite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cargos_de_miembros`
--

INSERT INTO `cargos_de_miembros` (`id`, `miembro`, `cargo`, `comite`) VALUES
(25, 16, 10, 5),
(26, 16, 4, NULL),
(27, 16, 6, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comites`
--

CREATE TABLE `comites` (
  `id` int(11) NOT NULL,
  `comite` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comites`
--

INSERT INTO `comites` (`id`, `comite`) VALUES
(1, 'Académico'),
(2, 'Lúdicas'),
(3, 'Logística'),
(4, 'Patrocinio'),
(5, 'Publicidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `miembros`
--

CREATE TABLE `miembros` (
  `id` int(11) NOT NULL,
  `primerNombre` varchar(30) NOT NULL,
  `segundoNombre` varchar(30) DEFAULT NULL,
  `nombrePreferido` tinyint(4) NOT NULL DEFAULT 1,
  `primerApellido` varchar(30) NOT NULL,
  `segundoApellido` varchar(30) DEFAULT NULL,
  `nombreEnRama` varchar(30) NOT NULL,
  `anioIngresoRama` year(4) NOT NULL,
  `anioSalidaRama` year(4) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `frase` varchar(400) NOT NULL,
  `urlFoto` varchar(400) NOT NULL,
  `urlLinkedin` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `miembros`
--

INSERT INTO `miembros` (`id`, `primerNombre`, `segundoNombre`, `nombrePreferido`, `primerApellido`, `segundoApellido`, `nombreEnRama`, `anioIngresoRama`, `anioSalidaRama`, `correo`, `celular`, `frase`, `urlFoto`, `urlLinkedin`) VALUES
(16, 'Valentina', '', 1, 'Solano', 'Mogollon', 'Valen', 2019, 2021, 'smvalentina@unicauca.edu.co', '3207775660', 'Hola', '../img/members/foto_valentina_solano_20210716_020729.jpg', 'www.fb.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cargos_de_miembros`
--
ALTER TABLE `cargos_de_miembros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `miembro` (`miembro`),
  ADD KEY `cargo` (`cargo`),
  ADD KEY `comite` (`comite`);

--
-- Indices de la tabla `comites`
--
ALTER TABLE `comites`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `miembros`
--
ALTER TABLE `miembros`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `cargos_de_miembros`
--
ALTER TABLE `cargos_de_miembros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `comites`
--
ALTER TABLE `comites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `miembros`
--
ALTER TABLE `miembros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cargos_de_miembros`
--
ALTER TABLE `cargos_de_miembros`
  ADD CONSTRAINT `cargos_de_miembros_ibfk_1` FOREIGN KEY (`miembro`) REFERENCES `miembros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cargos_de_miembros_ibfk_2` FOREIGN KEY (`cargo`) REFERENCES `cargos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cargos_de_miembros_ibfk_3` FOREIGN KEY (`comite`) REFERENCES `comites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
