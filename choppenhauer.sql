-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 24-11-2017 a las 19:28:16
-- Versión del servidor: 5.6.25-log
-- Versión de PHP: 5.6.31

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` bigint(20) NOT NULL,
  `cliente` int(11) NOT NULL,
  `sucursal` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(15, 0, 'Alberto', 'Armando', 'Gallinero', 'Mar del Plata', '132', '12345678', 'armando@gallinero.com', '202cb962ac59075b964b07152d234b70', 0);

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `envxcer`
--
ALTER TABLE `envxcer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT de la tabla `lineapedido`
--
ALTER TABLE `lineapedido`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
