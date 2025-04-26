-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-04-2025 a las 04:26:18
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
-- Estructura de tabla para la tabla `pokemones`
--

CREATE TABLE `pokemones` (
  `id` int(11) NOT NULL,
  `numero` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `tipo_id2` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `pokemones`
--

INSERT INTO `pokemones` (`id`, `numero`, `nombre`, `tipo_id`, `tipo_id2`, `descripcion`, `imagen`) VALUES
(1, 1, 'Bulbasaur', 1, 14, 'Un Pokémon de tipo planta/veneno. Tiene una semilla en su espalda.', 'recursos/img/001.png'),
(2, 2, 'Ivysaur', 1, 14, 'La semilla en su espalda crece conforme él también lo hace.', 'recursos/img/002.png'),
(3, 3, 'Venusaur', 1, 14, 'Cuando está completamente abierto, el gran brote de su espalda emite un aroma dulce.', 'recursos/img/003.png'),
(4, 4, 'Charmander', 2, NULL, 'Prefiere cosas calientes. Dicen que cuando llueve sale vapor de la punta de su cola.', 'recursos/img/004.png'),
(5, 5, 'Charmeleon', 2, NULL, 'Tiene un temperamento agresivo. Siempre está buscando rivales.', 'recursos/img/005.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pokemones`
--
ALTER TABLE `pokemones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero` (`numero`),
  ADD KEY `fk_tipo2` (`tipo_id2`),
  ADD KEY `fk_tipo1` (`tipo_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pokemones`
--
ALTER TABLE `pokemones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pokemones`
--
ALTER TABLE `pokemones`
  ADD CONSTRAINT `fk_tipo1` FOREIGN KEY (`tipo_id`) REFERENCES `tipos` (`id`),
  ADD CONSTRAINT `fk_tipo2` FOREIGN KEY (`tipo_id2`) REFERENCES `tipos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
