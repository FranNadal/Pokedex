-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-04-2025 a las 03:11:51
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pokedex`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`id`, `nombre`, `imagen`) VALUES
(1, 'planta', 'recursos/img/tipos/planta.png'),
(2, 'fuego', 'recursos/img/tipos/fuego.png'),
(3, 'agua', 'recursos/img/tipos/agua.png'),
(4, 'eléctrico', 'recursos/img/tipos/electrico.png'),
(5, 'psíquico', 'recursos/img/tipos/psiquico.png'),
(6, 'hielo', 'recursos/img/tipos/hielo.png'),
(7, 'roca', 'recursos/img/tipos/roca.png'),
(8, 'bicho', 'recursos/img/tipos/bicho.png'),
(9, 'fantasma', 'recursos/img/tipos/fantasma.png'),
(10, 'dragón', 'recursos/img/tipos/dragon.png'),
(11, 'volador', 'recursos/img/tipos/volador.png'),
(12, 'normal', 'recursos/img/tipos/normal.png'),
(13, 'lucha', 'recursos/img/tipos/lucha.png'),
(14, 'veneno', 'recursos/img/tipos/veneno.png'),
(15, 'tierra', 'recursos/img/tipos/tierra.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
