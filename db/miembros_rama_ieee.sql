-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2021 at 10:43 PM
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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id_admin` int(10) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id_admin`, `usuario`, `nombre`, `password`) VALUES
(1, 'jvargas', 'Jorge Andrés Vargas', '$2y$12$K.sqU2VjnzgMF5kl71BXiuQgtysJZ4GiEqGj0.vXPDpKk2Mw0ubvO'),
(2, 'admin', 'Super Usuario', '$2y$12$G1p3YBNUfUvT2s5QbIMLQ.cF65Z0nZdVk4L3660ec4Tj7FxiGTtdu'),
(3, 'jfredy', 'Jhon Fredy Romero', '$2y$12$UtGFTrh1NLV3U1qUmn9ZIOxcbdGjzjqdWThew70SOTDlXSN8niUWa'),
(4, 'dgomez', 'Daniel Gomez', '$2y$12$DbNTVBHUbYk7kEX2R2ERKeRhzG0hJsjvqh3yKbzpGCHlKzmatVzs2');

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
(1, 22, 9, 2),
(2, 26, 4, NULL),
(3, 26, 6, NULL),
(4, 20, 2, NULL),
(5, 24, 7, NULL),
(6, 19, 2, NULL),
(7, 21, 2, NULL),
(8, 24, 2, NULL),
(9, 19, 10, 5),
(10, 20, 10, 5),
(11, 21, 10, 5),
(12, 22, 10, 2),
(13, 23, 10, 5),
(14, 24, 10, 5),
(15, 25, 10, 5),
(16, 26, 10, 5),
(17, 1, 10, 5),
(18, 1, 10, 3),
(19, 1, 10, 4),
(20, 1, 9, 5),
(21, 1, 9, 3),
(22, 1, 9, 4),
(23, 1, 2, NULL),
(24, 2, 10, 2),
(25, 2, 10, 1),
(26, 2, 10, 5),
(27, 2, 10, 3),
(28, 2, 6, NULL),
(29, 3, 10, 3),
(30, 4, 10, 3),
(31, 4, 2, NULL),
(32, 5, 10, 1),
(33, 5, 10, 3),
(34, 5, 10, 4),
(35, 5, 9, 1),
(36, 5, 5, NULL),
(37, 6, 10, 5),
(38, 6, 5, NULL),
(39, 6, 4, NULL),
(40, 7, 10, 2),
(41, 8, 10, 3),
(42, 9, 10, 2),
(43, 9, 9, 2),
(44, 10, 10, 4),
(45, 10, 4, NULL),
(46, 11, 10, 3),
(47, 12, 10, 3),
(48, 13, 10, 5),
(49, 13, 10, 3),
(50, 14, 10, 3),
(51, 14, 6, NULL),
(52, 14, 7, NULL),
(53, 15, 10, 1),
(54, 15, 9, 3),
(55, 16, 10, 4),
(56, 16, 9, 3),
(57, 16, 7, NULL),
(58, 16, 3, NULL),
(59, 17, 10, 2),
(60, 17, 10, 3),
(61, 17, 9, 2),
(62, 17, 9, 3),
(63, 18, 10, 2),
(64, 18, 10, 5),
(65, 18, 10, 3),
(66, 18, 10, 4);

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
  `urlLinkedin` varchar(400) DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT 0,
  `ocupacionActual` varchar(30) DEFAULT NULL,
  `contactos` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `miembros`
--

INSERT INTO `miembros` (`id`, `primerNombre`, `segundoNombre`, `nombrePreferido`, `primerApellido`, `segundoApellido`, `nombreEnRama`, `anioIngresoRama`, `anioSalidaRama`, `correo`, `celular`, `frase`, `urlFoto`, `urlLinkedin`, `estado`, `ocupacionActual`, `contactos`) VALUES
(1, 'Diego ', '', 1, 'Mosquera ', 'Betancourt', 'Diego ', 2006, 2012, 'mosquerabetancourt@gmail.com', '3006929993', 'La rama IEEE aportó en mí la cultura corporativa y el liderazgo.', '../img/members/foto_diego _mosquera _20210722_102305.jpg', '', 1, '', ''),
(2, 'Dario ', 'Fernando ', 1, 'Gustin ', 'Insuasty', 'Dario ', 2016, 2018, 'dariogustin@hotmail.com', '3115637110', 'El relacionamiento con personas y entidades.', '../img/members/foto_dario _gustin _20210722_102421.jpg', '', 1, '', ''),
(3, 'Sebastian ', '', 1, 'Orozco', '', 'Sebastian ', 2011, 2014, 'seorozco19@gmail.com', '3013446877', 'Buenos momentos, networking, amigos.', '../img/members/foto_sebastian _orozco_20210722_101815.jpeg', '', 1, '', ''),
(4, 'Carlos ', 'Andres ', 1, 'Ararat ', 'Mina', 'Carlos ', 2011, 2015, 'camlx2@gmail.com', '3104710476', 'Relaciones personales y conocimiento del mundo laboral.', '../img/members/foto_carlos _ararat _20210722_102614.png', '', 1, '', ''),
(5, 'Johan ', '', 1, 'Tique', '', 'Johan ', 2010, 2012, 'johan.tique@gmail.com', '3137568475', 'Amigos que con el transcurso de los años se han convertido en familia. Adicionalmente a eso aportó contactos, experiencia de logística, mejora del liderazgo y aventuras.', '../img/members/foto_johan _tique_20210722_103154.jpg', '', 1, '', ''),
(6, 'Diego ', '', 1, 'Calero', '', 'Diego ', 2011, 2014, 'diegof9310@gmail.com', '3014442049', 'Considero que la rama me dejo primero, un gran grupo de amigos muy valiosos. A nivel profesional, me ayudo a poder aprender y desarrollar diferentes habilidades que no conocía, habilidades que en la industria se denominan softskills o habilidades blandas.', '../img/members/foto_diego _calero_20210722_102232.jpg', '', 1, '', ''),
(7, 'Diana ', '', 1, 'Samboní', '', 'Diana ', 2013, 2015, 'dianasamboni22@gmail.com', '3003519066', 'Entender que desde cualquier rama de trabajo es posible impactar positivamente la vida de las personas, en mi experiencia personal estuve muy ligada al trabajo con la WIE y fue muy grato poder llevar alegría a tantas personas.', '../img/members/foto_diana _samboni_20210722_102347.jpg', '', 1, '', ''),
(8, 'Herlan', '', 1, 'Alban ', 'Diaz', 'Herlan', 2005, 2008, 'healban@unicauca.edu.co', '3005242562', 'Espacios para relacionamiento con compañeros local y regionalmente, aprendizaje, organización y emprendimiento.', '../img/members/foto_herlan_alban _20210722_103018.jpg', '', 1, '', ''),
(9, 'Santiago ', 'Andrés', 1, 'Agredo ', 'Parra', 'Santiago ', 2009, 2011, 'Sant1ago@msn.com', '3002693668', 'Liderazgo, proactividad, networking, ', '../img/members/foto_santiago _agredo _20210722_101856.jpg', '', 1, '', ''),
(10, 'Juan ', 'Andrés ', 1, 'Cárdenas ', 'Diaz', 'Juan ', 2008, 2011, 'juancadi28@gmail.com', '3014014267', 'Fue una gran experiencia que me permitió fortalecer grandes lazos de amistad, desarrollar habilidades blandas de gran utilidad para la vida laboral, relacionarme con empresas del sector de las TI y profesionales académicos de universidades de todo el país (Networking) y sobre todo poder aportar como voluntario al desarrollo de la comunidad académica de la FIET a través de diferentes eventos coordi', '../img/members/foto_juan _cardenas _20210722_102151.jpg', '', 1, '', ''),
(11, 'Jairo ', 'Andrés ', 1, 'Castaño', 'Rosero', 'Jairo ', 2006, 2008, 'jacastano@gmail.com', '3163413155', 'Me aportó ganas, trabajo en equipo.', '../img/members/foto_jairo _castano_20210722_103059.jpg', '', 1, '', ''),
(12, 'Danny ', 'Alejandro ', 1, 'Solano ', 'Concha', 'Danny ', 2008, 2011, 'dannysenju@gmail.com', '3012503312', 'Contactos, experiencia en grupos, organización de procesos y eventos, amistades.', '../img/members/foto_danny _solano _20210722_102447.jpeg', '', 1, '', ''),
(13, 'Daniela ', 'Alexandra ', 1, 'Embus ', 'Gaviria', 'Daniela ', 2013, 2016, 'daeg95@gmail.com', '3113733453', 'Me ayudo a quitar un poco la timidez, ya que debíamos realizar saloneos y además de conseguir patrocinios. Por medio de la visita técnica, me dio una perspectiva  del mundo laboral en esta carrera. Fomento la parte social a través de las actividades que realizaba la WIE.', '../img/members/foto_daniela _embus _20210722_102522.png', '', 1, '', ''),
(14, 'Eileen ', '', 1, 'Martínez', ' Gómez', 'Eileen M', 2012, 2014, 'eileenjohanam@gmail.com', '3187944450', 'La Rama Estudiantil IEEE me permitió fortalecer habilidades blandas muy necesarias en el mundo laboral como el liderazgo, el trabajo en equipo, la transparencia, entre otras. También me permitió compartir momentos únicos y anécdotas inolvidables.', 'https://thumbs.dreamstime.com/b/icono-inc%C3%B3gnito-sirva-la-cara-con-los-vidrios-barba-y-el-sombrero-apoyos-de-foto-vector-109640094.jpg', '', 1, '', ''),
(15, 'Maria ', 'Camila ', 1, 'Chavez ', 'Tobar', 'Maria ', 2015, 2017, 'camichavez19@gmail.com', '3', 'Trabajar en equipo. Soy una persona impaciente, que le gusta que las cosas se hagan bien y lo más rapido posible y me choqué un par de veces trabajando en grupo, pero entendí que todos tenemos un ritmo diferente y que el objetivo primordial es la realizacion de los objetivos y metas.', '../img/members/foto_maria _chavez _20210722_102105.jpg', '', 1, '', ''),
(16, 'Isabel ', 'Cristina ', 1, 'Chávez ', 'Tobar', 'Isabel ', 2011, 2014, 'isabelchaveztobar@gmail.com', '3014477761', 'La rama estudiantil permite fortalecer habilidades blandas importantes para la vida laboral. Me aportó amigos valiosos con los que aun cuento. Pertenecer a la rama fue muy importante, me enseño no solo a pensar en lo académico si no poder aportar en tema sociales y buscar en generar espacios de aprendizaje como también lúdicos para todos los estudiantes de ingeniería. \n', 'https://thumbs.dreamstime.com/b/icono-inc%C3%B3gnito-sirva-la-cara-con-los-vidrios-barba-y-el-sombrero-apoyos-de-foto-vector-109640094.jpg', '', 1, '', ''),
(17, 'Jhonnier ', 'Alberto ', 1, 'Sanchez ', 'Dorado', 'Jhonnier ', 2011, 2012, 'jhonnier.sanchez@gmail.com', '3104615833', 'Me aportó gestión, autodisciplina, colaboración, trabajo en grupo.', 'https://thumbs.dreamstime.com/b/icono-inc%C3%B3gnito-sirva-la-cara-con-los-vidrios-barba-y-el-sombrero-apoyos-de-foto-vector-109640094.jpg', '', 1, '', ''),
(18, 'Silvana', ' Lorena ', 1, 'Criollo ', 'Obando', 'Silvana', 2010, 2014, 'silvanaco87@gmail.com', '3005137747', 'La rama me permitió desarrollar habilidades blandas que fueron un excelente complemento a mi formación académica. Adicional que encontré grandes amigos con los que a hoy en día sigo en contacto. Coordinadora del capítulo de Computer Society. ', '../img/members/foto_silvana_criollo _20210722_101701.jpeg', '', 1, '', ''),
(19, 'Jhon', 'Fredy', 2, 'Romero', 'Núñez', 'Fredy', 2021, 2021, 'jhonrom@unicauca.edu.com', '3014822371', 'Mi mamá me dio la vida y la rama IEEE las ganas de vivirla', '../img/members/foto_jhon_romero_20210722_105121.jpg', 'https://www.linkedin.com/in/jhon-fredy-romero-n%C3%BA%C3%B1ez-25b4b9174/', 1, '', ''),
(20, 'Jorge', 'Andrés', 1, 'Vargas', 'Cordoba', 'Jorge', 2020, 2021, 'javargas216@unicauca.edu.co', '3143097657', 'Primero muerto antes que perder la vida', '../img/members/foto_jorge_vargas_20210722_121912.jpg', 'https://www.linkedin.com/in/jorge-vargas-349a5b173/', 1, '', ''),
(21, 'Johan ', 'Santiago ', 2, 'Yangana ', 'Montoya', 'Santi', 2021, 2021, 'johanyangana@unicauca.edu.co', '3122275035', 'Aunque me cueste morir no dejare la bebida', '../img/members/foto_johan _yangana _20210722_123153.jpg', '', 1, '', ''),
(22, 'Santiago', 'de Jesús', 1, 'Martinez', 'Semanate', 'Santi', 2018, 2021, 'santimartinez@unicauca.edu.co', '3124285279', 'Nose', '../img/members/foto_santiago_martinez_20210722_124038.jpg', '', 1, '', ''),
(23, 'Angel', 'Gabriel', 1, 'Pasaje', 'Erazo', 'Angel', 2021, 2022, 'apasaje@unicauca.edu.co', '3204391332', 'si', 'https://thumbs.dreamstime.com/b/icono-inc%C3%B3gnito-sirva-la-cara-con-los-vidrios-barba-y-el-sombrero-apoyos-de-foto-vector-109640094.jpg', '', 1, '', ''),
(24, 'Jose', 'Miguel', 1, 'Betancourt', 'Chaves', 'Betan', 2020, 2021, 'josebetancourt@unicauca.edu.co', '3046076944', 'Bla bla bla', '../img/members/foto_jose_betancourt_20210722_123718.jpg', '', 1, '', ''),
(25, 'Daniel', '', 1, 'Gomez', 'Mendez', 'Negru', 2021, 2021, 'dgomez216@unicauca.edu.co', '3218933997', 'Bla bla bla', '../img/members/foto_daniel_gomez_20210722_123744.jpg', '', 1, '', ''),
(26, 'Valentina', '', 1, 'Solano', 'Mogollón', 'Valen', 2019, 2022, 'smvalentina@unicauca.edu.co', '3207775660', 'La Rama me enseño a potenciar habilidades como el liderazgo y la organización de proyectos', 'https://thumbs.dreamstime.com/b/icono-inc%C3%B3gnito-sirva-la-cara-con-los-vidrios-barba-y-el-sombrero-apoyos-de-foto-vector-109640094.jpg', '', 1, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `usuario` (`usuario`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cargos_de_miembros`
--
ALTER TABLE `cargos_de_miembros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `comites`
--
ALTER TABLE `comites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `miembros`
--
ALTER TABLE `miembros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cargos_de_miembros`
--
ALTER TABLE `cargos_de_miembros`
  ADD CONSTRAINT `cargo_del_miembro` FOREIGN KEY (`cargo`) REFERENCES `cargos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comite_del_cargo_del_miembro` FOREIGN KEY (`comite`) REFERENCES `comites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `miembro_del_cargo` FOREIGN KEY (`miembro`) REFERENCES `miembros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
