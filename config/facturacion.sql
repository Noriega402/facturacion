-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-06-2020 a las 03:39:09
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `facturacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `codigo` int(11) NOT NULL,
  `descripcion` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`codigo`, `descripcion`, `precio`) VALUES
(1, 'Arroz 5 lb', '15.99'),
(2, 'Frijol 5 lb', '15.99'),
(3, 'Azucar 1 lb', '5.99'),
(4, 'Helado de Fresa 1 gl', '34.95'),
(5, 'Chocolate LALA', '29.65'),
(6, 'yougurt LALA 8 onz', '6.94'),
(7, 'Pack de cerveza Gallo ', '55.49'),
(8, 'Coca Cola 2 lt', '14.80'),
(9, 'Sprite 1.5 lt', '12.35'),
(10, 'Grapette 3 lt', '17.89'),
(11, 'Coca Cola 3 lt', '22.15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `nit` decimal(8,0) NOT NULL,
  `nombre` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` decimal(8,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`nit`, `nombre`, `telefono`) VALUES
('10203040', 'Cindy Lorena Chajon ArdÃ³n', '41900027'),
('12345678', 'Belen Noriega', '45261202'),
('37348051', 'Daniel Enrique Noriega ChajÃ³n', '55973682');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `idDetalle` int(11) NOT NULL,
  `idVenta` int(11) NOT NULL,
  `idArticulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`idDetalle`, `idVenta`, `idArticulo`, `cantidad`) VALUES
(1, 1, 10, 3),
(2, 2, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `idVenta` int(11) NOT NULL,
  `nit` decimal(8,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`idVenta`, `nit`) VALUES
(2, '10203040'),
(1, '37348051');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`nit`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`idDetalle`),
  ADD KEY `fk_venta_ventas` (`idVenta`),
  ADD KEY `fk_idArticulo_articulos` (`idArticulo`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`idVenta`),
  ADD KEY `fk_nit_ventas` (`nit`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `idDetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `idVenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `fk_idArticulo_articulos` FOREIGN KEY (`idArticulo`) REFERENCES `articulos` (`codigo`),
  ADD CONSTRAINT `fk_venta_ventas` FOREIGN KEY (`idVenta`) REFERENCES `ventas` (`idVenta`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_nit_ventas` FOREIGN KEY (`nit`) REFERENCES `clientes` (`nit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
