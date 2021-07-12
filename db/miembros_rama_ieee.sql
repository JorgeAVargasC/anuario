-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2021 at 05:23 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `miembros_rama_ieee`
--

-- --------------------------------------------------------

--
-- Table structure for table `cargos`
--

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL,
  `cargo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cargos`
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
-- Table structure for table `cargos_de_miembros`
--

CREATE TABLE `cargos_de_miembros` (
  `id` int(11) NOT NULL,
  `miembro` int(11) NOT NULL,
  `cargo` int(11) NOT NULL,
  `comite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cargos_de_miembros`
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
-- Table structure for table `comites`
--

CREATE TABLE `comites` (
  `id` int(11) NOT NULL,
  `comite` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comites`
--

INSERT INTO `comites` (`id`, `comite`) VALUES
(1, 'Académico'),
(2, 'Lúdicas'),
(3, 'Logística'),
(4, 'Patrocinio'),
(5, 'Publicidad');

-- --------------------------------------------------------

--
-- Table structure for table `miembros`
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
-- Dumping data for table `miembros`
--

INSERT INTO `miembros` (`id`, `primerNombre`, `segundoNombre`, `nombrePreferido`, `primerApellido`, `segundoApellido`, `nombreEnRama`, `anioIngresoRama`, `anioSalidaRama`, `correo`, `celular`, `frase`, `urlFoto`, `urlLinkedin`) VALUES
(1, 'Jhon', 'Fredy', 2, 'Romero', 'Núñez', 'Fredy', 2021, 2022, 'jhonrom@unicauca.edu.com', '3014822371', 'Mi mamá me dio la vida y la rama IEEE las ganas de vivirla', '', 'https://www.linkedin.com/in/jhon-fredy-romero-n%C3%BA%C3%B1ez-25b4b9174/'),
(2, 'Jorge', 'Andrés', 1, 'Vargas', 'Cordoba', 'Jorge', 2020, 2022, 'javargas216@unicauca.edu.co', '3143097657', 'Bla bla bla', '', 'https://www.linkedin.com/in/jhon-fredy-romero-n%C3%BA%C3%B1ez-25b4b9174/'),
(3, 'Johan ', 'Santiago ', 2, 'Yangana ', 'Montoya', 'Santi', 2021, 2022, 'johanyangana@unicauca.edu.co', '3122275035', 'Aunque me cueste morir no dejare la bebida', '', ''),
(4, 'Santiago', 'de Jesús', 1, 'Martinez', 'Semanate', 'Santi', 2018, 2022, 'santimartinez@unicauca.edu.co', '3124285279', 'Nose', '', ''),
(5, 'Angel', 'Gabriel', 1, 'Pasaje', 'Erazo', 'Angel', 2021, 2022, 'apasaje@unicauca.edu.co', '3204391332', 'si', '', ''),
(6, 'Jose', 'Miguel', 1, 'Betancourt', 'Chaves', 'Betan', 2020, 2022, 'josebetancourt@unicauca.edu.co', '3046076944', 'Bla bla bla', '', ''),
(7, 'Daniel', '', 1, 'Gomez', 'Mendez', 'Negru', 2021, 2022, 'dgomez216@unicauca.edu.co', '3218933997', 'Bla bla bla', '', ''),
(8, 'Valentina', '', 1, 'Solano', 'Mogollón', 'Valen', 2019, 2022, 'smvalentina@unicauca.edu.co', '3207775660', 'La Rama me enseño a potenciar habilidades como el liderazgo y la organización de proyectos', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cargos_de_miembros`
--
ALTER TABLE `cargos_de_miembros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `miembro` (`miembro`),
  ADD KEY `cargo` (`cargo`),
  ADD KEY `comite` (`comite`);

--
-- Indexes for table `comites`
--
ALTER TABLE `comites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `miembros`
--
ALTER TABLE `miembros`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cargos_de_miembros`
--
ALTER TABLE `cargos_de_miembros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `comites`
--
ALTER TABLE `comites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `miembros`
--
ALTER TABLE `miembros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cargos_de_miembros`
--
ALTER TABLE `cargos_de_miembros`
  ADD CONSTRAINT `cargos_de_miembros_ibfk_1` FOREIGN KEY (`miembro`) REFERENCES `miembros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cargos_de_miembros_ibfk_2` FOREIGN KEY (`cargo`) REFERENCES `cargos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cargos_de_miembros_ibfk_3` FOREIGN KEY (`comite`) REFERENCES `comites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
