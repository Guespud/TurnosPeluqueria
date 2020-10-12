-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-04-2020 a las 23:55:29
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectogradosena`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `idCita` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `descripcion` text NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idEstilista` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `estado` enum('Pendiente','Realizado','Cancelado','Facturado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`idCita`, `fecha`, `hora`, `descripcion`, `idCliente`, `idEstilista`, `idProducto`, `estado`) VALUES
(21, '2020-04-16', '03:46:00', 'FADE POMPADOUR', 14, 10, 10, 'Realizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `telefono` int(11) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombre`, `direccion`, `telefono`, `email`) VALUES
(1, 'juan perez', 'cra41', 654456, 'juanp22@hotmail.com'),
(2, '', ' ', 0, ''),
(3, 'miguel lopez', 'cll 34 ', 363, 'mlopez@prueba.com.co'),
(4, '', ' ', 0, 'elguapo@gmail.com'),
(5, 'pajarito', 'cra85 ', 654654, 'pajarito@prueba.com.co'),
(6, 'sdasd', 'sdsdf ', 32323, 'asdasd@asd.asd'),
(7, 'fgdfdf', 'dfgdfg ', 3456, 'cvbvb@cvc.cv'),
(8, 'qweqwr', 'qweqwe ', 3232, 'qwewe@assa.qw'),
(9, 'qwqwe', 'wqe ', 13123, 'qqw@.wqw.qeqw'),
(10, 'miguel montoya', 'cra854 ', 332, 'miguele@gmail.com'),
(11, 'miguel murillo', 'cra854 ', 32, 'miguelmurillo@gmail.com'),
(12, 'julian casablancas', 'cra51 ', 546545, 'jcasablancas@gmail.com'),
(13, 'asdasd', 'carrera 47 a #13-15 ', 2147483647, 'aguespud.playtechla@gmail.com'),
(14, 'ALejandro', 'cali ', 2147483647, 'alejo.habbacuc@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estilista`
--

CREATE TABLE `estilista` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `telefono` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estilista`
--

INSERT INTO `estilista` (`id`, `nombre`, `direccion`, `telefono`) VALUES
(7, 'CLOE MEYER', 'cali', 2147483647),
(9, 'RACHEL CLINTON', 'cali', 2147483647),
(10, 'DAVE BUFF', 'cali', 2147483647),
(11, 'NICOLE SIMONS', 'cali', 2147483647);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `idFactura` int(11) NOT NULL,
  `idCita` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `subtotal` int(11) NOT NULL,
  `impuesto` int(11) NOT NULL,
  `descuento` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`idFactura`, `idCita`, `fecha`, `hora`, `subtotal`, `impuesto`, `descuento`, `total`) VALUES
(1, 2, '2020-04-04', '08:04:58', 2147483647, 1, 500, 2147483647),
(2, 14, '2020-04-04', '09:04:40', 2147483647, 1, 20000, 2147483647),
(3, 14, '2020-04-04', '10:04:48', 2147483647, 0, 0, 2147483647),
(4, 14, '2020-04-05', '04:04:08', 2147483647, 1, 550000, 2147483647),
(5, 21, '2020-04-05', '04:04:26', 45000, 5000, 5000, 50000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL,
  `nombreProducto` varchar(50) NOT NULL,
  `desProducto` text NOT NULL,
  `valorProducto` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `nombreProducto`, `desProducto`, `valorProducto`) VALUES
(10, 'CUIDADO DEL CABELLO', 'ninguno', '50000'),
(11, 'MANICURE PEDICURE', 'ninguno', '20000'),
(12, 'MAQUILLAJE', 'ninguno', '30000'),
(13, 'TARTAMIENTO CORPORAL', 'ninguno', '50000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` date NOT NULL,
  `usuario` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `password`, `created_at`, `usuario`) VALUES
(13, 'ALEJANDRO', ' GUESPUD ', '112233 ', '0000-00-00', 'aguespud'),
(14, 'admin', 'admin', 'admin ', '0000-00-00', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`idCita`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `estilista`
--
ALTER TABLE `estilista`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idFactura`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `idCita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `estilista`
--
ALTER TABLE `estilista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
