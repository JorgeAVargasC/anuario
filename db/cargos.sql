-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2021 at 08:02 PM
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
  `cargo` varchar(20) NOT NULL,
  `urlLogo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cargos`
--

INSERT INTO `cargos` (`id`, `cargo`, `urlLogo`) VALUES
(1, 'Coordinador TET', '/anuario/img/medallas/medallaTET.svg'),
(2, 'Web Master', '/anuario/img/medallas/medallaWebMaster.svg'),
(3, 'Coordinadora WIE', '/anuario/img/medallas/medallaWIE.svg'),
(4, 'Presidente', '/anuario/img/medallas/medallaPresidente.svg'),
(5, 'Viscepresidente', '/anuario/img/medallas/medallaVice.svg'),
(6, 'Fiscal', '/anuario/img/medallas/medallaFiscal.svg'),
(7, 'Tesorero', '/anuario/img/medallas/medallaTesorero.svg'),
(8, 'Secretario', '/anuario/img/medallas/medallaSecretario.svg'),
(9, 'Coordinador', '/anuario/img/medallas/medallaCoordinador.svg'),
(10, 'Voluntario', '/anuario/img/medallas/medallaVoluntario.svg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
