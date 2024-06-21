-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-06-2024 a las 00:39:32
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
-- Base de datos: `db_aerolineas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aerolineas_argentinas`
--

CREATE TABLE `aerolineas_argentinas` (
  `ID` int(11) NOT NULL,
  `Aeronave` varchar(100) NOT NULL,
  `Precio` float NOT NULL,
  `Fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `aerolineas_argentinas`
--

INSERT INTO `aerolineas_argentinas` (`ID`, `Aeronave`, `Precio`, `Fecha`) VALUES
(2, 'Boeing 747', 2000000, '2024-08-14 16:30:00'),
(6, 'Boeing 500', 1500000, '2024-05-18 19:53:00'),
(12, 'Londres ', 1600000, '2024-06-13 19:28:29'),
(13, 'Madrid', 2000000, '2024-06-30 19:28:29'),
(14, 'Nueva York', 3000000, '2024-06-26 19:31:25'),
(15, 'Paris', 50000000, '2024-06-18 19:31:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `Password` varchar(250) NOT NULL,
  `Range` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_users`, `name`, `Password`, `Range`) VALUES
(1, 'webadmin', '$2y$10$hFXrttNIm.fjXjfa1AanRuAHUl5WW77cpMDCj5r2wk0l/T.qOK7C6', 'Admi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vuelos`
--

CREATE TABLE `vuelos` (
  `ID_Vuelos` int(11) NOT NULL,
  `Destino` varchar(100) NOT NULL,
  `Pilotos` varchar(250) NOT NULL,
  `id_aerolinea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vuelos`
--

INSERT INTO `vuelos` (`ID_Vuelos`, `Destino`, `Pilotos`, `id_aerolinea`) VALUES
(1, 'Francia', 'Juan y Pepito', 2),
(5, 'Estados Unidos', 'Ariel y Juan ', 6),
(6, 'Italia', 'Cristian y Luis', 6),
(9, 'Japon', 'Braian y Diego', 14),
(10, 'España', 'Mariano y Matias ', 15);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aerolineas_argentinas`
--
ALTER TABLE `aerolineas_argentinas`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- Indices de la tabla `vuelos`
--
ALTER TABLE `vuelos`
  ADD PRIMARY KEY (`ID_Vuelos`),
  ADD KEY `FK_VUELO_AEROLINEA` (`id_aerolinea`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aerolineas_argentinas`
--
ALTER TABLE `aerolineas_argentinas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `vuelos`
--
ALTER TABLE `vuelos`
  MODIFY `ID_Vuelos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `vuelos`
--
ALTER TABLE `vuelos`
  ADD CONSTRAINT `FK_VUELO_AEROLINEA` FOREIGN KEY (`id_aerolinea`) REFERENCES `aerolineas_argentinas` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
