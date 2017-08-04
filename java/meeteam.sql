--
-- Base de datos: `meeteam`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_imagen`
--

CREATE TABLE `perfil_imagen` (
  `cod_usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `imagenurl` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `perfil_imagen`
--

INSERT INTO `perfil_imagen` (`cod_usuario`, `imagenurl`) VALUES
('Borja1', 'C:\\Users\\Borja\\Documents\\NetBeansProjects\\MeeTeam\\web\\imagenPerfil\\Koala.jpg'),
('Ibaibide fs1', 'C:\\Users\\Borja\\Documents\\NetBeansProjects\\MeeTeam\\web\\imagenPerfil\\Biohazard.jpg'),
('Kris1', 'C:\\Users\\Borja\\Documents\\NetBeansProjects\\MeeTeam\\web\\imagenPerfil\\Lighthouse.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_usuario`
--

CREATE TABLE `perfil_usuario` (
  `cod_usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `elclub` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `trayectoria` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `quebusco` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `sobremi` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `experiencia` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `perfil_usuario`
--

INSERT INTO `perfil_usuario` (`cod_usuario`, `elclub`, `trayectoria`, `quebusco`, `sobremi`, `experiencia`) VALUES
('Ibaibide fs1', 'Somos un equipo serio de basauri.', 'Hemos jugado en segunda regional, primera regional y preferente.', 'Buscamos jugadores comprometidos y con ganas.', '', ''),
('Kris1', '', '', 'Un equipo que se tome las cosas en serio.', 'Soy una entrenadora con ganas de estar en un equipo serio.', 'He estado en las categorias inferiores del Ibaibide FS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `cod_usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre_usu` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contrasena` varchar(128) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `seguridad` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `localidad` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `edad` int(11) NOT NULL,
  `sexo` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo_usu` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo_equipo` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `posicion` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `entrenar_equipo` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_alta` date NOT NULL,
  `online` tinyint(1) NOT NULL,
  `nick` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contvisitas` int(11) NOT NULL,
  `contfavoritos` int(11) NOT NULL,
  `contmensajes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`cod_usuario`, `nombre_usu`, `contrasena`, `seguridad`, `localidad`, `edad`, `sexo`, `tipo_usu`, `tipo_equipo`, `posicion`, `entrenar_equipo`, `email`, `fecha_alta`, `online`, `nick`, `contvisitas`, `contfavoritos`, `contmensajes`) VALUES
('Alfonso1', 'Alfonso', '$2a$10$yw3DFRCfLke.BoXPWuO5Oe/U8i0yASHqBROE/475flz9jAuqwNxIe', '12345', 'Madrid, España', 21, 'chico', 'Jugador', NULL, 'Portero', NULL, 'prueba4@yahoo.es', '2017-03-23', 0, 'Alfonsi', 19, 1, 0),
('Anita1', 'Anita', '$2a$10$tli0jOe.1ih1FcPa3u1q1OFzdIu1NGaS.BCoLtBOgqpv011b62J5y', '12345', 'Durango, España', 25, 'chica', 'Jugador', NULL, 'Pivote', NULL, 'prueba12@yahoo.es', '2017-03-23', 0, 'Nita', 3, 1, 0),
('Antonia1', 'Antonia', '$2a$10$Dvp0kKfyxogHYHqzuc36yuQ/a8WKz89sP3Fpkrg026LNVJ45U8lwK', '12345', 'Cádiz, España', 14, 'chica', 'Jugador', NULL, 'Cierre', NULL, 'prueba10@yahoo.es', '2017-03-23', 0, 'Toni', 3, 1, 0),
('Borja1', 'Borja', '$2a$10$SHZD.yafa4MqT9lugumKe.QKmGgwqdyqwhLmeLAAkzZWUirVUVVS6', '123456', 'Basauri, España', 32, 'chico', 'Jugador', NULL, 'Cierre', NULL, 'prueba@yahoo.es', '2017-01-31', 1, 'Carpe', 0, 0, 0),
('Cadete club1', 'Cadete club', '$2a$10$E1BKnDt1oGLDji8i03bCwet4AGay5lD4.tGGzLrgnpYokxR7NkXyW', '12345', 'Santurce, España', 10, NULL, 'Equipo', 'Federado', NULL, NULL, 'prueba15@yahoo.es', '2017-03-23', 0, 'Real Cadete', 6, 1, 0),
('Carlos1', 'Carlos', '$2a$10$JIC9oxwubzaPkuNPogK8q./RSfuG0h8ygA7VuMC55Dn5F9j6Dh9Nq', '12345', 'Portugalete, España', 38, 'chico', 'Jugador', NULL, 'Cualquiera', NULL, 'prueba9@yahoo.es', '2017-03-23', 0, 'Diem', 9, 1, 0),
('Ibaibide fs1', 'Ibaibide fs', '$2a$10$ZYHoXxD8tImaerLdOXtdiuNFsVD7S1rOCzf/wzEuuaVUZuxf4Ga6e', '123456', 'Basauri, España', 1, NULL, 'Equipo', 'Federado', NULL, NULL, 'prueba2@yahoo.es', '2017-02-06', 1, 'Bidebieta', 7, 0, 0),
('Kris1', 'Kris', '$2a$10$TVO/Q5ymA2kY/h.5m3cFt.KrBzNHJX7HswdNh3tcISvhY0twIudWe', '123456', 'Santurce, España', 45, 'chica', 'Entrenador', NULL, NULL, 'Cualquiera', 'prueba3@yahoo.es', '2017-02-08', 0, 'Kristis', 4, 1, 0),
('Los borrachines1', 'Los borrachines', '$2a$10$.xzZrKqnWIv8rxYHCNhdTuRwlqW/zWaOVvrYIrRKwguVgJCHkPISW', '12345', 'Cádiz, España', 2, NULL, 'Equipo', 'Amateur', NULL, NULL, 'prueba17@yahoo.es', '2017-03-23', 0, 'Los borrachines', 2, 1, 0),
('Los ninos1', 'Los ninos', '$2a$10$zNzJAQBinueT.KzMgINjXOif.PnWlGAUvuYHSk.kWRdgrEAlhbkDW', '12345', 'Basauri, España', 1, NULL, 'Equipo', 'Amateur', NULL, NULL, 'prueba16@yahoo.es', '2017-03-23', 0, 'Los niños', 9, 0, 0),
('Luis1', 'Luis', '$2a$10$esxKTS77LKhdT.n/mRxT8OnYIBZ8H59Kc0iSYxVZJaAkxM8etWTkS', '12345', 'Durango, España', 45, 'chico', 'Entrenador', NULL, NULL, 'Cualquiera', 'prueba20@yahoo.es', '2017-03-23', 0, 'Luis', 0, 0, 0),
('Luismi1', 'Luismi', '$2a$10$cAAOJUM/Dd48OA2B4c1EQuirzM7Rz688inJmH6cupubEHAknS0gIa', '12345', 'Guernica-Luno, España', 25, 'chico', 'Jugador', NULL, 'Ala', NULL, 'prueba7@yahoo.es', '2017-03-23', 0, 'tini', 1, 0, 0),
('Maialen1', 'Maialen', '$2a$10$E/nMirH4OjYLv.T8VSZPTeCuqYLracmtsUnLm0x3tVNkERpxr1Q.a', '12345', 'Galdakao, España', 32, 'chica', 'Jugador', NULL, 'Cualquiera', NULL, 'prueba13@yahoo.es', '2017-03-23', 0, 'Len', 0, 0, 0),
('Manolo1', 'Manolo', '$2a$10$Hn2TvPks6LBAuyyHyjpZUukAqtFjLZhC4UdpDkBhKqdqYZPeFwq9W', '12345', 'Basauri, España', 54, 'chico', 'Entrenador', NULL, NULL, 'Federado', 'prueba18@yahoo.es', '2017-03-23', 0, 'Manu', 2, 0, 0),
('Miguel1', 'Miguel', '$2a$10$l5Np6/cVcxgN2BQwQ79OxOz3odkYXRYZu6WkQgBOb9sD2v9ndYfyK', '12345', 'Barakaldo, España', 44, 'chico', 'Jugador', NULL, 'Cierre', NULL, 'prueba6@yahoo.es', '2017-03-23', 0, 'X-men', 0, 0, 0),
('Miguelillo1', 'Miguelillo', '$2a$10$iAHBMbos/7Movz0lWnPge.LnK8VuygC1iYOgAe9rRxmCTElWTmIY.', '12345', 'Bilbao, España', 12, 'chico', 'Jugador', NULL, 'Pivote', NULL, 'prueba8@yahoo.es', '2017-03-23', 0, 'litri', 0, 0, 0),
('Roberta1', 'Roberta', '$2a$10$yXh4m.K2mJwHhBAkpinS0.GHZCxwbM883Gtpmx1/BPUG//6oPVRwW', '12345', 'Santurce, España', 35, 'chica', 'Jugador', NULL, 'Ala', NULL, 'prueba11@yahoo.es', '2017-03-23', 0, 'pepa', 0, 0, 0),
('San antonio fs1', 'San antonio fs', '$2a$10$HFWGBY/ecSHvzM6MG6zh7uPiRRQPEkFu/apUNb0MhqcWGx8VrbZ8a', '12345', 'Etxebarri, España', 2, NULL, 'Equipo', 'Federado', NULL, NULL, 'prueba14@yahoo.es', '2017-03-23', 0, 'San Antonio F.S.', 1, 0, 0),
('Sandra1', 'Sandra', '$2a$10$pYZ/ySZPN0W/cQEWiOXndOJs1cD5uCpei2WAhfZjQt7xrRxJbhNn.', '12345', 'Santurce, España', 35, 'chica', 'Entrenador', NULL, NULL, 'Amateur', 'prueba19@yahoo.es', '2017-03-23', 0, 'Nicky', 1, 0, 0),
('Vanessa1', 'Vanessa', '$2a$10$8YoYraJLlXU29wptMWnaTuurIuFnPztSsx/hMrbOqzRfP2CYhaZbC', '12345', 'Galdakao, España', 18, 'chica', 'Jugador', NULL, 'Portero', NULL, 'prueba5@yahoo.es', '2017-03-23', 0, 'Van', 1, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariosbloqueados`
--

CREATE TABLE `usuariosbloqueados` (
  `cod_usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `usu_bloqueado` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nickusu_bloq` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuariosbloqueados`
--

INSERT INTO `usuariosbloqueados` (`cod_usuario`, `usu_bloqueado`, `nickusu_bloq`) VALUES
('Borja1', 'Alfonso1', 'Alfonsi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariosfavoritos`
--

CREATE TABLE `usuariosfavoritos` (
  `cod_usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `usu_favorito` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nickusu_favorito` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuariosfavoritos`
--

INSERT INTO `usuariosfavoritos` (`cod_usuario`, `usu_favorito`, `nickusu_favorito`) VALUES
('Borja1', 'Alfonso1', 'Alfonsi'),
('Borja1', 'Anita1', 'Nita'),
('Borja1', 'Antonia1', 'Toni'),
('Borja1', 'Cadete club1', 'Real Cadete'),
('Borja1', 'Carlos1', 'Diem'),
('Borja1', 'Kris1', 'Kristis'),
('Borja1', 'Los borrachines1', 'Los borrachines');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariosvisitas`
--

CREATE TABLE `usuariosvisitas` (
  `cod_usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cod_usuario_visita` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nickusu_visita` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cuandovisita` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuariosvisitas`
--

INSERT INTO `usuariosvisitas` (`cod_usuario`, `cod_usuario_visita`, `nickusu_visita`, `cuandovisita`) VALUES
('Borja1', 'Alfonso1', 'Alfonsi', '2017-04-11 16:08:09'),
('Borja1', 'Anita1', 'Nita', '2017-04-06 22:15:05'),
('Borja1', 'Antonia1', 'Toni', '2017-04-10 18:46:08'),
('Borja1', 'Cadete club1', 'Real Cadete', '2017-04-10 20:47:00'),
('Borja1', 'Carlos1', 'Diem', '2017-04-11 16:05:38'),
('Borja1', 'Ibaibide fs1', 'Bidebieta', '2017-04-11 16:04:39'),
('Borja1', 'Kris1', 'Kristis', '2017-04-06 22:16:34'),
('Borja1', 'Los borrachines1', 'Los borrachines', '2017-04-10 20:54:41'),
('Borja1', 'Los ninos1', 'Los niños', '2017-04-11 16:04:52'),
('Borja1', 'Los niños1', 'Los niños', '2017-03-23 19:51:59'),
('Borja1', 'Luismi1', 'tini', '2017-03-23 20:06:18'),
('Borja1', 'Manolo1', 'Manu', '2017-04-10 17:37:59'),
('Borja1', 'San antonio fs1', 'San Antonio F.S.', '2017-06-07 22:59:52'),
('Borja1', 'Sandra1', 'Nicky', '2017-03-23 19:51:52'),
('Borja1', 'Vanessa1', 'Van', '2017-03-23 20:11:45'),
('Ibaibide fs1', 'Cadete club1', 'Real Cadete', '2017-04-11 15:56:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `perfil_imagen`
--
ALTER TABLE `perfil_imagen`
  ADD PRIMARY KEY (`cod_usuario`);

--
-- Indices de la tabla `perfil_usuario`
--
ALTER TABLE `perfil_usuario`
  ADD PRIMARY KEY (`cod_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cod_usuario`,`nick`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `usuariosbloqueados`
--
ALTER TABLE `usuariosbloqueados`
  ADD PRIMARY KEY (`cod_usuario`,`usu_bloqueado`,`nickusu_bloq`);

--
-- Indices de la tabla `usuariosfavoritos`
--
ALTER TABLE `usuariosfavoritos`
  ADD PRIMARY KEY (`cod_usuario`,`usu_favorito`,`nickusu_favorito`);

--
-- Indices de la tabla `usuariosvisitas`
--
ALTER TABLE `usuariosvisitas`
  ADD PRIMARY KEY (`cod_usuario`,`cod_usuario_visita`,`nickusu_visita`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `perfil_imagen`
--
ALTER TABLE `perfil_imagen`
  ADD CONSTRAINT `fkimagen` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`);

--
-- Filtros para la tabla `perfil_usuario`
--
ALTER TABLE `perfil_usuario`
  ADD CONSTRAINT `fkperfil` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`);

--
-- Filtros para la tabla `usuariosbloqueados`
--
ALTER TABLE `usuariosbloqueados`
  ADD CONSTRAINT `fkbloqueado` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`);

--
-- Filtros para la tabla `usuariosfavoritos`
--
ALTER TABLE `usuariosfavoritos`
  ADD CONSTRAINT `fkfavoritos` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`);

--
-- Filtros para la tabla `usuariosvisitas`
--
ALTER TABLE `usuariosvisitas`
  ADD CONSTRAINT `fkvisitas` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
