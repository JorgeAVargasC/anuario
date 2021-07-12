-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-07-2021 a las 18:51:45
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
(1, 4, 9, 2),
(2, 8, 4, NULL),
(3, 8, 6, NULL),
(4, 2, 2, NULL),
(5, 6, 7, NULL),
(6, 1, 2, NULL),
(7, 3, 2, NULL),
(8, 6, 2, NULL),
(9, 1, 10, 5),
(10, 2, 10, 5),
(11, 3, 10, 5),
(12, 4, 10, 2),
(13, 5, 10, 5),
(14, 6, 10, 5),
(15, 7, 10, 5),
(16, 8, 10, 5);

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
(1, 'Jhon', 'Fredy', 2, 'Romero', 'Núñez', 'Fredy', 2021, 2022, 'jhonrom@unicauca.edu.com', '3014822371', 'Mi mamá me dio la vida y la rama IEEE las ganas de vivirla', 'https://scontent.fbog11-1.fna.fbcdn.net/v/t1.6435-9/48383175_1989141267869104_6153743641794838528_n.jpg?_nc_cat=102&ccb=1-3&_nc_sid=09cbfe&_nc_ohc=upvBfaWOr_AAX8r2UYu&_nc_ht=scontent.fbog11-1.fna&oh=90fa7987e4e98019b7087336d3f41267&oe=60F1B200', 'https://www.linkedin.com/in/jhon-fredy-romero-n%C3%BA%C3%B1ez-25b4b9174/'),
(2, 'Jorge', 'Andrés', 1, 'Vargas', 'Cordoba', 'Jorge', 2020, 2022, 'javargas216@unicauca.edu.co', '3143097657', 'Primero muerto antes que perder la vida', 'https://scontent.fbog11-1.fna.fbcdn.net/v/t1.6435-9/169342125_4021209251257984_4760993059613347327_n.jpg?_nc_cat=111&ccb=1-3&_nc_sid=09cbfe&_nc_ohc=1iScoUqo74cAX9fTZJF&tn=hlhndVaddNSeA_1I&_nc_ht=scontent.fbog11-1.fna&oh=d9e1eda01743670fd486d601fe68c81e&oe=60F1F744', 'https://www.linkedin.com/in/jorge-vargas-349a5b173/'),
(3, 'Johan ', 'Santiago ', 2, 'Yangana ', 'Montoya', 'Santi', 2021, 2022, 'johanyangana@unicauca.edu.co', '3122275035', 'Aunque me cueste morir no dejare la bebida', 'https://scontent.fbog11-1.fna.fbcdn.net/v/t1.6435-9/60079521_2498972156779463_6976517598837997568_n.jpg?_nc_cat=102&ccb=1-3&_nc_sid=174925&_nc_ohc=lDUfJiroFpMAX_tzCTU&tn=hlhndVaddNSeA_1I&_nc_ht=scontent.fbog11-1.fna&oh=318328e267761131e5af8b28ec354693&oe=60F20704', ''),
(4, 'Santiago', 'de Jesús', 1, 'Martinez', 'Semanate', 'Santi', 2018, 2022, 'santimartinez@unicauca.edu.co', '3124285279', 'Nose', 'https://scontent.fbog11-1.fna.fbcdn.net/v/t1.6435-9/71961728_10220419499493213_5092383615803719680_n.jpg?_nc_cat=110&ccb=1-3&_nc_sid=09cbfe&_nc_ohc=WUwXUOoTO4wAX_XHcIc&tn=hlhndVaddNSeA_1I&_nc_ht=scontent.fbog11-1.fna&oh=28b9ceff98e7cd8098876970a9c1e2cd&oe=60F0EE21', ''),
(5, 'Angel', 'Gabriel', 1, 'Pasaje', 'Erazo', 'Angel', 2021, 2022, 'apasaje@unicauca.edu.co', '3204391332', 'si', '', ''),
(6, 'Jose', 'Miguel', 1, 'Betancourt', 'Chaves', 'Betan', 2020, 2022, 'josebetancourt@unicauca.edu.co', '3046076944', 'Bla bla bla', 'https://scontent.fbog10-1.fna.fbcdn.net/v/t1.6435-9/52597958_10215573045017727_5337622464539131904_n.jpg?_nc_cat=100&ccb=1-3&_nc_sid=09cbfe&_nc_ohc=kVSHm7UvGYoAX-vL7se&_nc_ht=scontent.fbog10-1.fna&oh=e03314c06cabc5ef7c62c241acbd3b71&oe=60F19758', ''),
(7, 'Daniel', '', 1, 'Gomez', 'Mendez', 'Negru', 2021, 2022, 'dgomez216@unicauca.edu.co', '3218933997', 'Bla bla bla', 'https://scontent.fbog10-1.fna.fbcdn.net/v/t1.6435-9/183589837_4155850617798436_1924416984467454886_n.jpg?_nc_cat=100&ccb=1-3&_nc_sid=09cbfe&_nc_ohc=BjDtD3q2sBUAX8nQRtb&_nc_ht=scontent.fbog10-1.fna&oh=9e2df2adf322806355d2d53bedbb11d5&oe=60F1A79D', ''),
(8, 'Valentina', '', 1, 'Solano', 'Mogollón', 'Valen', 2019, 2022, 'smvalentina@unicauca.edu.co', '3207775660', 'La Rama me enseño a potenciar habilidades como el liderazgo y la organización de proyectos', 'https://scontent.fbog10-1.fna.fbcdn.net/v/t1.6435-9/116284688_10223462839622887_23811892771767785_n.jpg?_nc_cat=109&ccb=1-3&_nc_sid=8bfeb9&_nc_ohc=GkRYTcBnHrEAX9gZ33W&_nc_ht=scontent.fbog10-1.fna&oh=72329e0de464362244eeabfae69c7b2e&oe=60F097E0', '');

--
-- Índices para tablas volcadas
--

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
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `cargos_de_miembros`
--
ALTER TABLE `cargos_de_miembros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `comites`
--
ALTER TABLE `comites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `miembros`
--
ALTER TABLE `miembros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
