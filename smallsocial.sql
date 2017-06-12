-- phpMyAdmin SQL Dump
-- version 4.4.15.8
-- https://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 26-05-2017 a las 18:21:08
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
-- Estructura de tabla para la tabla `jhss_attachment`
--

CREATE TABLE IF NOT EXISTS `jhss_attachment` (
  `id` bigint(20) NOT NULL,
  `ruta` varchar(250) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `usuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `ext` varchar(20) NOT NULL,
  `peso` varchar(100) NOT NULL,
  `permalink` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jhss_comments`
--

CREATE TABLE IF NOT EXISTS `jhss_comments` (
  `id` bigint(11) NOT NULL,
  `comentario` varchar(250) NOT NULL,
  `post` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jhss_contacts`
--

CREATE TABLE IF NOT EXISTS `jhss_contacts` (
  `id` bigint(20) NOT NULL,
  `one` int(11) NOT NULL,
  `two` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jhss_conversation`
--

CREATE TABLE IF NOT EXISTS `jhss_conversation` (
  `id` bigint(11) NOT NULL,
  `de` int(11) NOT NULL,
  `para` int(11) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jhss_conversationreply`
--

CREATE TABLE IF NOT EXISTS `jhss_conversationreply` (
  `id` bigint(11) NOT NULL,
  `conversation` int(11) NOT NULL,
  `mensaje` varchar(250) NOT NULL,
  `usuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `visto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jhss_followers`
--

CREATE TABLE IF NOT EXISTS `jhss_followers` (
  `id` bigint(20) NOT NULL,
  `follow` int(11) NOT NULL,
  `fromthe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jhss_imagespost`
--

CREATE TABLE IF NOT EXISTS `jhss_imagespost` (
  `id` bigint(11) NOT NULL,
  `ruta` varchar(250) NOT NULL,
  `usuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `album` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `jhss_imagespost`
--

INSERT INTO `jhss_imagespost` (`id`, `ruta`, `usuario`, `fecha`, `album`, `type`) VALUES
(1, 'images/photos/2/normal-GzgEJgnhyZg8SWK5UsAeHTDSZduaXFDcwcdfyb7JMY7eLIaGbC4HN6SFOIGI2017-05-25.jpg', 2, '2017-05-25 12:34:23', 1, 1),
(2, 'images/photos/2/normal-38DITPqQCHzf2iDmJBeyuesx0ayxsxXgREgMgNzixrXx5exnPEJToYCha6if2017-05-25.jpg', 2, '2017-05-25 03:44:21', 1, 1),
(3, 'images/photos/2/normal-tpi3wi2zsfli0eqepwkvyvoncu7xqqofg28edqfis9e2kkpo37gm420m2l7wqvu5i0bk8t7y6xk2017-05-25.jpg', 2, '2017-05-25 04:03:43', 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jhss_information`
--

CREATE TABLE IF NOT EXISTS `jhss_information` (
  `id` bigint(20) NOT NULL,
  `usuario` int(11) NOT NULL,
  `description` text NOT NULL,
  `emailshow` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `jhss_information`
--

INSERT INTO `jhss_information` (`id`, `usuario`, `description`, `emailshow`) VALUES
(1, 3, 'Aqui puedes editar tu información :)', 1),
(2, 0, 'Aqui puedes editar tu información :)', 1),
(3, 0, 'Aqui puedes editar tu información :)', 1),
(4, 2, 'Aqui puedes editar tu información :)', 1),
(5, 3, 'Aqui puedes editar tu información :)', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jhss_likepost`
--

CREATE TABLE IF NOT EXISTS `jhss_likepost` (
  `id` bigint(11) NOT NULL,
  `post` int(11) NOT NULL,
  `usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jhss_notifications`
--

CREATE TABLE IF NOT EXISTS `jhss_notifications` (
  `id` bigint(20) NOT NULL,
  `para` int(11) NOT NULL,
  `de` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `post` int(11) DEFAULT NULL,
  `leido` int(11) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jhss_posts`
--

CREATE TABLE IF NOT EXISTS `jhss_posts` (
  `id` bigint(11) NOT NULL,
  `post` text NOT NULL,
  `usuario` int(11) NOT NULL,
  `permalink` varchar(250) NOT NULL,
  `fecha` datetime NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `jhss_posts`
--

INSERT INTO `jhss_posts` (`id`, `post`, `usuario`, `permalink`, `fecha`, `tipo`) VALUES
(1, '1', 2, 'f8d0da239188939202ef1d93e1758b9eb2494840', '2017-05-25 12:34:23', 1),
(2, '2', 2, '87fdc85f4171a3a8923af7f95a8989d164ee3a6b', '2017-05-25 03:44:21', 1),
(3, '3', 2, '514bdaa76ac48e2e98e0f6c51c021afe9837b537', '2017-05-25 04:03:43', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jhss_socialconfig`
--

CREATE TABLE IF NOT EXISTS `jhss_socialconfig` (
  `id` int(11) NOT NULL,
  `sitename` varchar(100) NOT NULL,
  `login` int(11) DEFAULT NULL,
  `register` int(11) DEFAULT NULL,
  `forgot` int(11) DEFAULT NULL,
  `smtp` varchar(100) DEFAULT NULL,
  `port` int(11) DEFAULT NULL,
  `fromname` varchar(100) DEFAULT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `messagemail` text,
  `messagechange` text,
  `renewmessage` text,
  `archiveextensions` varchar(250) NOT NULL,
  `requiredemail` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `jhss_socialconfig`
--

INSERT INTO `jhss_socialconfig` (`id`, `sitename`, `login`, `register`, `forgot`, `smtp`, `port`, `fromname`, `mail`, `password`, `url`, `messagemail`, `messagechange`, `renewmessage`, `archiveextensions`, `requiredemail`) VALUES
(1, 'SmallSocial', 1, 1, 1, 'mail.localhost.com', 587, 'Webmaster', 'noreply@site.com', 'passemail', 'http://wwww.thesiteurl.com/', '1', '2', '3', 'jpg|rar|txt|zip', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jhss_usuarios`
--

CREATE TABLE IF NOT EXISTS `jhss_usuarios` (
  `id` bigint(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `apellido` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `apodo` varchar(100) DEFAULT NULL,
  `nacimiento` date NOT NULL,
  `type_user` varchar(50) NOT NULL,
  `type_equipo` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `localidad` text NOT NULL,
  `registro` date NOT NULL,
  `permalink` varchar(100) NOT NULL,
  `rango` int(11) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `jhss_usuarios`
--

INSERT INTO `jhss_usuarios` (`id`, `nombre`, `apellido`, `email`, `password`, `apodo`, `nacimiento`, `type_user`, `type_equipo`, `gender`, `position`, `localidad`, `registro`, `permalink`, `rango`, `activo`) VALUES
(1, 'Administrator', 'Test', 'admin@jhcodes.com', '8fb5df6129546683fddff8746112e97f1c5dedf4', NULL, '1989-06-08', '', '', '', '', '', '2016-12-27', 'd5cbbda80241af7', 2, 2),
(2, 'test', 'test', 'test@gmail.com', '1a842264e7fa18d3dfc6de22d7386f963a36bfdd', NULL, '1936-04-18', 'Equipo', 'Federado', '', '', 'Polk City, Florida, Estados Unidos', '2017-05-25', '41416466892b1cc', 1, 2),
(3, 'hgfhfg', 'fghfgh', 'fghf@gmail.com', '1a842264e7fa18d3dfc6de22d7386f963a36bfdd', NULL, '1990-11-18', 'Equipo', 'Amateur', '', '', 'París, Francia', '2017-05-25', 'c44718d53be95a8', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jhss_verify`
--

CREATE TABLE IF NOT EXISTS `jhss_verify` (
  `id` bigint(20) NOT NULL,
  `token` varchar(250) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `jhss_attachment`
--
ALTER TABLE `jhss_attachment`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jhss_comments`
--
ALTER TABLE `jhss_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jhss_contacts`
--
ALTER TABLE `jhss_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jhss_conversation`
--
ALTER TABLE `jhss_conversation`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jhss_conversationreply`
--
ALTER TABLE `jhss_conversationreply`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jhss_followers`
--
ALTER TABLE `jhss_followers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jhss_imagespost`
--
ALTER TABLE `jhss_imagespost`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jhss_information`
--
ALTER TABLE `jhss_information`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jhss_likepost`
--
ALTER TABLE `jhss_likepost`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jhss_notifications`
--
ALTER TABLE `jhss_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jhss_posts`
--
ALTER TABLE `jhss_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jhss_socialconfig`
--
ALTER TABLE `jhss_socialconfig`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jhss_usuarios`
--
ALTER TABLE `jhss_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jhss_verify`
--
ALTER TABLE `jhss_verify`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `jhss_attachment`
--
ALTER TABLE `jhss_attachment`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `jhss_comments`
--
ALTER TABLE `jhss_comments`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `jhss_contacts`
--
ALTER TABLE `jhss_contacts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `jhss_conversation`
--
ALTER TABLE `jhss_conversation`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `jhss_conversationreply`
--
ALTER TABLE `jhss_conversationreply`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `jhss_followers`
--
ALTER TABLE `jhss_followers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `jhss_imagespost`
--
ALTER TABLE `jhss_imagespost`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `jhss_information`
--
ALTER TABLE `jhss_information`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `jhss_likepost`
--
ALTER TABLE `jhss_likepost`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `jhss_notifications`
--
ALTER TABLE `jhss_notifications`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `jhss_posts`
--
ALTER TABLE `jhss_posts`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `jhss_socialconfig`
--
ALTER TABLE `jhss_socialconfig`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `jhss_usuarios`
--
ALTER TABLE `jhss_usuarios`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `jhss_verify`
--
ALTER TABLE `jhss_verify`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
