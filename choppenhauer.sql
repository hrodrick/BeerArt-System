-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-11-2017 a las 19:06:41
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `choppenhauer`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cervezas`
--

CREATE TABLE `cervezas` (
  `id` int(11) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `descripcion` text NOT NULL,
  `precioXLitro` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `standBy` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cervezas`
--

INSERT INTO `cervezas` (`id`, `tipo`, `descripcion`, `precioXLitro`, `foto`, `standBy`) VALUES
(1, 'Nietzsche Ale', 'Cerveza más allá del bien y del mal', 120, 'Nietzsche_Ale.jpg', 0),
(2, 'Foucault Ale', 'El nacimiento de la cerveza', 135, 'Foucault_Ale.jpg', 0),
(3, 'Seneca Bier', 'La brevedad de la cerveza', 125, 'Seneca_Bier.jpg', 0),
(4, 'Epicuro Ale', 'El placer y la cerveza', 90, 'Epicuro_Ale.jpg', 0),
(5, 'Golden Socrates Ale', 'Tomá cerveza, no cicuta', 150, 'Golden_Socrates_Ale.png', 0),
(6, 'Platon Ale', 'La Cerveza Platónica', 155, 'Platon_Ale.jpg', 0),
(7, 'Dark Sartre Ale', 'Los caminos de la cerveza', 140, 'Dark_Sartre_Ale.jpg', 0),
(8, 'Marx Red Ale', 'La cerveza para todos', 130, 'Marx_Red_Ale.jpg', 0),
(9, 'Kant Ale', 'Una cerveza empírica', 120, 'Kant_Ale.jpg', 0),
(10, 'Bock Amo Bier', 'Bock Amo Bier', 160, 'Bock_Amo_Bier.jpg', 0),
(11, 'Heidegger', 'Heidegger', 150, 'Heidegger.jpg', 0),
(12, 'Kierkegaard Bier', 'Kierkegaard Bier', 155, 'Kierkegaard_Bier.jpg', 0),
(13, 'Aristoteles Greek Beer', 'La Cerveza Peripatética', 300, '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envases`
--

CREATE TABLE `envases` (
  `id` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `capacidad` float NOT NULL,
  `coeficiente` float NOT NULL,
  `foto` varchar(30) NOT NULL,
  `standBy` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `envases`
--

INSERT INTO `envases` (`id`, `tipo`, `capacidad`, `coeficiente`, `foto`, `standBy`) VALUES
(1, 'Porron', 0.33, 0.5, '', 0),
(2, 'Lata', 0.33, 0.6, '', 0),
(3, 'Botella', 1, 1, '', 0),
(4, 'Botellon', 2, 1.8, '', 0),
(5, 'Barril', 5, 4.5, '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envios`
--

CREATE TABLE `envios` (
  `id` bigint(20) NOT NULL,
  `idPedido` bigint(20) NOT NULL,
  `domicilio` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `envios`
--

INSERT INTO `envios` (`id`, `idPedido`, `domicilio`) VALUES
(1, 1, 'Hernandarias 4122'),
(2, 2, 'Hernandarias 4122'),
(3, 3, 'Hernandarias 4122'),
(4, 4, 'Hernandarias 4122'),
(5, 5, 'Hernandarias 4122'),
(6, 6, 'Hernandarias 4122'),
(7, 9, 'Hernandarias 4122'),
(8, 12, 'Hernandarias 4122'),
(9, 14, 'mi casa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envxcer`
--

CREATE TABLE `envxcer` (
  `id` int(11) NOT NULL,
  `idcer` int(11) NOT NULL,
  `idenv` int(11) NOT NULL,
  `tiene` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `envxcer`
--

INSERT INTO `envxcer` (`id`, `idcer`, `idenv`, `tiene`) VALUES
(1, 1, 5, 1),
(2, 1, 3, 1),
(3, 1, 4, 1),
(4, 1, 2, 1),
(5, 1, 1, 1),
(6, 2, 5, 1),
(7, 2, 3, 1),
(8, 2, 4, 1),
(9, 2, 2, 1),
(10, 2, 1, 1),
(11, 3, 5, 1),
(12, 3, 3, 1),
(13, 3, 4, 1),
(14, 3, 2, 1),
(15, 3, 1, 1),
(16, 4, 5, 1),
(17, 4, 3, 1),
(18, 4, 4, 1),
(19, 4, 2, 1),
(20, 4, 1, 1),
(21, 5, 5, 1),
(22, 5, 3, 1),
(23, 5, 4, 1),
(24, 5, 2, 1),
(25, 5, 1, 1),
(26, 6, 5, 1),
(27, 6, 3, 1),
(28, 6, 4, 1),
(29, 6, 2, 1),
(30, 6, 1, 1),
(31, 7, 5, 1),
(32, 7, 3, 1),
(33, 7, 4, 1),
(34, 7, 2, 1),
(35, 7, 1, 1),
(36, 8, 5, 1),
(37, 8, 3, 1),
(38, 8, 4, 1),
(39, 8, 2, 1),
(40, 8, 1, 1),
(41, 9, 5, 1),
(42, 9, 3, 1),
(43, 9, 4, 1),
(44, 9, 2, 1),
(45, 9, 1, 1),
(46, 10, 5, 1),
(47, 10, 3, 1),
(48, 10, 4, 1),
(49, 10, 2, 1),
(50, 10, 1, 1),
(51, 11, 5, 1),
(52, 11, 3, 1),
(53, 11, 4, 1),
(54, 11, 2, 1),
(55, 11, 1, 1),
(56, 12, 5, 1),
(57, 12, 3, 1),
(58, 12, 4, 1),
(59, 12, 2, 1),
(60, 12, 1, 1),
(61, 13, 5, 0),
(62, 13, 3, 0),
(63, 13, 4, 1),
(64, 13, 2, 1),
(65, 13, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineapedido`
--

CREATE TABLE `lineapedido` (
  `id` bigint(20) NOT NULL,
  `idPedido` bigint(20) NOT NULL,
  `idCerveza` bigint(20) NOT NULL,
  `idEnvase` bigint(20) NOT NULL,
  `precioUnitario` decimal(10,0) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `lineapedido`
--

INSERT INTO `lineapedido` (`id`, `idPedido`, `idCerveza`, `idEnvase`, `precioUnitario`, `cantidad`) VALUES
(1, 1, 7, 1, '70', 1),
(2, 2, 10, 1, '80', 1),
(3, 3, 13, 1, '150', 1),
(4, 4, 10, 1, '80', 1),
(5, 5, 10, 1, '80', 1),
(6, 5, 7, 1, '70', 1),
(7, 5, 7, 3, '140', 1),
(8, 5, 11, 1, '75', 1),
(9, 6, 10, 3, '160', 1),
(10, 6, 13, 4, '540', 4),
(11, 7, 9, 1, '60', 1),
(12, 8, 10, 1, '80', 1),
(13, 8, 10, 3, '160', 1),
(14, 9, 4, 1, '45', 1),
(15, 9, 4, 2, '54', 2),
(16, 10, 10, 1, '80', 1),
(17, 10, 10, 2, '96', 1),
(18, 10, 10, 3, '160', 1),
(19, 11, 9, 1, '60', 1),
(20, 11, 9, 2, '72', 1),
(21, 12, 7, 4, '252', 10),
(26, 14, 7, 4, '252', 2),
(27, 15, 13, 4, '540', 1),
(28, 15, 5, 3, '150', 2),
(29, 15, 9, 1, '60', 10),
(30, 16, 2, 4, '243', 10),
(31, 16, 7, 1, '70', 1),
(32, 17, 5, 3, '150', 2),
(33, 17, 5, 2, '90', 2),
(34, 18, 7, 3, '140', 3),
(35, 19, 7, 2, '84', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` bigint(20) NOT NULL,
  `cliente` int(11) NOT NULL,
  `sucursal` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `fechaEntrega` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `cliente`, `sucursal`, `fecha`, `estado`, `fechaEntrega`) VALUES
(1, 10, 1, '2017-11-22 20:44:24', 2, '2017-11-22 20:44:24'),
(2, 10, 1, '2017-11-24 20:48:06', 2, '2017-11-29 20:44:24'),
(3, 10, 1, '2017-11-24 20:51:13', 2, '2017-11-29 20:44:24'),
(4, 10, 1, '2017-11-24 21:07:39', 2, '2017-11-29 20:44:24'),
(5, 10, 1, '2017-11-24 21:53:08', 2, '2017-11-29 20:44:24'),
(6, 10, 1, '2017-11-25 00:10:20', 1, '2017-12-12 12:30:40'),
(7, 10, 2, '2017-11-25 00:28:09', 1, '2017-11-29 20:32:59'),
(8, 10, 2, '2017-11-25 00:38:47', 1, '2017-11-29 12:44:24'),
(9, 10, 1, '2017-12-03 09:32:10', 0, '2017-11-29 20:44:24'),
(10, 8, 2, '2017-11-25 10:09:06', 0, '2017-11-29 20:44:24'),
(11, 10, 2, '2017-11-26 11:00:52', 0, '2017-11-29 20:44:24'),
(12, 10, 1, '2017-11-29 11:13:01', 0, '2017-11-29 20:44:24'),
(14, 17, 1, '2017-11-26 21:47:15', 0, '2017-11-29 20:44:24'),
(15, 17, 3, '2017-11-26 22:58:18', 0, '2018-01-19 20:30:00'),
(16, 17, 3, '2017-11-23 03:27:24', 0, '2017-12-29 20:30:00'),
(17, 8, 2, '2017-11-27 15:52:46', 0, '2017-11-29 03:44:00'),
(18, 8, 2, '2017-11-27 15:55:17', 0, '2018-03-15 12:30:00'),
(19, 8, 3, '2017-11-27 17:44:55', 0, '2017-11-14 12:32:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `rol` varchar(30) NOT NULL,
  `descripcion` text NOT NULL,
  `permisos` tinyint(4) NOT NULL,
  `standBy` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `rol`, `descripcion`, `permisos`, `standBy`) VALUES
(1, 'Administrador', 'Acceso total', 1, 0),
(2, 'Personal', 'Acceso restringido', 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `domicilio` varchar(30) NOT NULL,
  `localidad` varchar(30) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `standBy` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`id`, `nombre`, `domicilio`, `localidad`, `telefono`, `standBy`) VALUES
(1, 'Del Centro', 'San Martin 2500', 'Mar del Plata', '22352561235', 0),
(2, 'Del Puerto', 'San Martin 3500', 'Mar del Plata', '22352561235', 0),
(3, 'Que Gauchito', 'Gaucho 2521', 'Mar del Plata', '22352561235', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `idRol` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `domicilio` varchar(50) NOT NULL,
  `localidad` varchar(50) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `dni` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `standBy` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `idRol`, `nombre`, `apellido`, `domicilio`, `localidad`, `telefono`, `dni`, `email`, `password`, `standBy`) VALUES
(3, 0, 'Pepe', 'Potamo', 'Arenales 2115', 'Mar del Plata', '15648978', '12345645', 'pepe1@argento.com', '202cb962ac59075b964b07152d234b70', 0),
(4, 0, 'Juan', 'Perez', 'Maipu 2514', 'Mar del Plata', '12345678', '12345678', 'pepe2@argento.com', '7363a0d0604902af7b70b271a0b96480', 0),
(5, 0, 'Cristian', 'Piperno', 'Arenales 2115', 'Mar del Plata', '123456', '12345678', 'pepe@argento.com', '202cb962ac59075b964b07152d234b70', 0),
(6, 0, 'Norbert', 'Degoas', 'La Paulina 255', 'Mar del Plata', '1234567', '13245678', 'norbert@degoas.com', '202cb962ac59075b964b07152d234b70', 0),
(7, 0, 'Manuel', 'De Falla', 'Santa Cecilia 3125', 'Mar del Plata', '13245678', '12345678', 'manuel@defalla.com', '202cb962ac59075b964b07152d234b70', 0),
(8, 1, 'enano', 'maldito', 'enano maldio 36', 'Mar del Plata', '12345678', '12456321', 'enano@maldito.com.ar', 'df8f0bfa05a8b904dcc9e2759ac2688c', 0),
(10, 1, 'Sergio', 'Garguir', 'Hernandarias 4122', 'Mar del Plata', '2235256630', '14676996', 'sergio@garguir.com.ar', 'ef9f94a6b2790f1a09a8f6cd94b85d5e', 0),
(11, 1, 'Pepe', 'Argento', 'Arenales 2115', 'Mar del Plata', '123456', '12345678', 'argento1.pepe@live.com.ar', '1cc39ffd758234422e1f75beadfc5fb2', 0),
(12, 1, 'prueba', 'pu', 'prueba', 'prubeba', '12345', '12345678', 'argento3.pepe@live.com.ar', '0bf1aa00e9f75572741f02de8c641d75', 0),
(13, 0, 'Pepe1', 'Argentos', 'Arenales 2115', 'Mar del Plata', '1234567', '13245678', 'pepe@argentos.com', '30cd2f99101cdd52cc5fda1e996ee137', 0),
(14, 0, 'Diego', 'Maradona', 'La Pelota 135', 'Quilmes', '123456', '12345678', 'diego@maradona.com', '202cb962ac59075b964b07152d234b70', 0),
(17, 0, 'Rodrigo', 'Soria', '', '', '', '', 'rodrigo.soria98@hotmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(18, 0, 'sadasd', 'asdasdas', 'adsdassdadas', 'sadasadsdas', 'dasddasasddas', '23112331', 'gajsowms@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cervezas`
--
ALTER TABLE `cervezas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `envases`
--
ALTER TABLE `envases`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `envios`
--
ALTER TABLE `envios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `envxcer`
--
ALTER TABLE `envxcer`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lineapedido`
--
ALTER TABLE `lineapedido`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cervezas`
--
ALTER TABLE `cervezas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `envases`
--
ALTER TABLE `envases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `envios`
--
ALTER TABLE `envios`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `envxcer`
--
ALTER TABLE `envxcer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `lineapedido`
--
ALTER TABLE `lineapedido`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
