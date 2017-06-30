-- phpMyAdmin SQL Dump
-- version 4.4.15.8
-- https://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 28-06-2017 a las 21:39:54
-- Versión del servidor: 5.6.31
-- Versión de PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `smallsocial`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jhss_gallery`
--

CREATE TABLE IF NOT EXISTS `jhss_gallery` (
  `id` int(11) NOT NULL,
  `ruta` varchar(300) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `usuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `ext` varchar(20) NOT NULL,
  `peso` varchar(100) NOT NULL,
  `permalink` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `jhss_gallery`
--

INSERT INTO `jhss_gallery` (`id`, `ruta`, `nombre`, `usuario`, `fecha`, `ext`, `peso`, `permalink`) VALUES
(1, '/images/gallery/2/2017/06/91b8bdca92214231f44dc19d995922a945a17160.pn', 'cucumber.png', 2, '2017-06-28 09:20:11', 'png', '182182', '91b8bdca92214231f44dc19d995922a945a17160'),
(2, 'images/gallery/2/2017/06/06e45dac6e19d09b82ef25173df0a4eda408c4e9.jpeg', 'Design-8437.jpeg', 2, '2017-06-28 09:20:56', 'jpeg', '536715', '06e45dac6e19d09b82ef25173df0a4eda408c4e9'),
(3, 'images/gallery/2/2017/06/2fed28c00349e51acdaa4a185abb8eb71112afd3.png', '11686681_connectmiles.png', 2, '2017-06-28 09:22:15', 'png', '20242', '2fed28c00349e51acdaa4a185abb8eb71112afd3'),
(4, 'images/gallery/2/2017/06/1903ccf5f253811715ed56b2a92805e8b4d94359.png', 'cucumber.png', 2, '2017-06-28 09:23:25', 'png', '182182', '1903ccf5f253811715ed56b2a92805e8b4d94359');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `jhss_gallery`
--
ALTER TABLE `jhss_gallery`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `jhss_gallery`
--
ALTER TABLE `jhss_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
