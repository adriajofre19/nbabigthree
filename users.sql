-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-07-2025 a las 14:48:21
-- Versión del servidor: 11.5.2-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `external_id` varchar(255) DEFAULT NULL,
  `team_name` varchar(255) NOT NULL DEFAULT 'Mi Equipo',
  `remember_token` varchar(100) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `avatar`, `external_id`, `team_name`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Adria Jofre Canton', 'adria.ordis@gmail.com', NULL, NULL, 'https://lh3.googleusercontent.com/a/ACg8ocLdaB00LNZsRygtcpojB40hExHWHMQAfZa1bSVeEWGTPNC1hw=s96-c', '113727025255846665365', 'Reglamento AEBA', NULL, 'admin', '2024-10-03 10:31:10', '2024-10-20 19:21:14'),
(3, 'Lopez y Jofre', 'theyofe@gmail.com', NULL, NULL, 'https://lh3.googleusercontent.com/a/ACg8ocIli4-y39ReGLF49SPiQNqxpotpcKeKXOtr2VoYiRU762w7vA=s96-c', '109561150389161378483', 'Mi Equipo', NULL, 'user', '2024-10-21 12:20:48', '2024-10-21 12:20:48'),
(4, 'John Doe', 'johndoe@example.com', '2024-10-01 08:00:00', 'password123', 'avatar1.png', 'ext12345', 'The Raptors', NULL, 'admin', '2024-10-01 08:00:00', '2024-10-01 08:00:00'),
(5, 'Jane Smith', 'janesmith@example.com', NULL, 'password456', 'avatar2.png', 'ext67890', 'Tigers FC', 'abcd1234', 'user', '2024-10-02 09:00:00', '2024-10-02 09:00:00'),
(6, 'Alice Johnson', 'alicej@example.com', '2024-10-03 10:00:00', 'password789', NULL, 'ext24680', 'Thunderbolts', NULL, 'user', '2024-10-03 10:00:00', '2024-10-03 10:00:00'),
(7, 'Bob Brown', 'bobbrown@example.com', NULL, 'pass1111', 'avatar3.png', NULL, 'Lions', 'qwer5678', 'user', '2024-10-04 07:00:00', '2024-10-04 07:00:00'),
(8, 'Charlie Green', 'charlieg@example.com', '2024-10-05 12:00:00', 'pass2222', 'avatar4.png', 'ext35791', 'The Hawks', 'zxcv6789', 'user', '2024-10-05 12:00:00', '2024-10-05 12:00:00'),
(9, 'Diana White', 'dianaw@example.com', NULL, 'pass3333', NULL, NULL, 'Eagles', 'asdf1234', 'user', '2024-10-06 13:00:00', '2024-10-06 13:00:00'),
(10, 'Edward Black', 'edwardb@example.com', '2024-10-07 14:00:00', 'pass4444', 'avatar5.png', 'ext12398', 'Sharks', NULL, 'user', '2024-10-07 14:00:00', '2024-10-07 14:00:00'),
(11, 'Fiona Blue', 'fionab@example.com', NULL, 'pass5555', 'avatar6.png', 'ext56473', 'The Bears', 'wert6789', 'admin', '2024-10-08 15:00:00', '2024-10-08 15:00:00'),
(12, 'George Red', 'georger@example.com', '2024-10-09 16:00:00', 'pass6666', NULL, 'ext98375', 'Wolves', NULL, 'user', '2024-10-09 16:00:00', '2024-10-09 16:00:00'),
(13, 'Hannah Yellow', 'hannahy@example.com', '2024-10-10 17:00:00', 'pass7777', 'avatar7.png', NULL, 'The Bulls', 'plok3456', 'user', '2024-10-10 17:00:00', '2024-10-10 17:00:00'),
(15, 'John Doe', 'johndoe1@example.com', '2024-10-01 08:00:00', 'password123', 'avatar1.png', 'ext12345', 'The Raptors', NULL, 'admin', '2024-10-01 08:00:00', '2024-10-01 08:00:00'),
(16, 'Jane Smith', 'janesmith1@example.com', NULL, 'password456', 'avatar2.png', 'ext67890', 'Tigers FC', 'abcd1234', 'user', '2024-10-02 09:00:00', '2024-10-02 09:00:00'),
(17, 'Alice Johnson', 'alic1ej@example.com', '2024-10-03 10:00:00', 'password789', NULL, 'ext24680', 'Thunderbolts', NULL, 'user', '2024-10-03 10:00:00', '2024-10-03 10:00:00'),
(18, 'Bob Brown', 'bobbr1own@example.com', NULL, 'pass1111', 'avatar3.png', NULL, 'Lions', 'qwer5678', 'user', '2024-10-04 07:00:00', '2024-10-04 07:00:00'),
(19, 'Charlie Green', 'charli1eg@example.com', '2024-10-05 12:00:00', 'pass2222', 'avatar4.png', 'ext35791', 'The Hawks', 'zxcv6789', 'user', '2024-10-05 12:00:00', '2024-10-05 12:00:00'),
(20, 'Diana White', 'dian1aw@example.com', NULL, 'pass3333', NULL, NULL, 'Eagles', 'asdf1234', 'user', '2024-10-06 13:00:00', '2024-10-06 13:00:00'),
(21, 'Edward Black', 'edwa1rdb@example.com', '2024-10-07 14:00:00', 'pass4444', 'avatar5.png', 'ext12398', 'Sharks', NULL, 'user', '2024-10-07 14:00:00', '2024-10-07 14:00:00'),
(22, 'Fiona Blue', 'fiona1b@example.com', NULL, 'pass5555', 'avatar6.png', 'ext56473', 'The Bears', 'wert6789', 'admin', '2024-10-08 15:00:00', '2024-10-08 15:00:00'),
(23, 'George Red', 'georg1er@example.com', '2024-10-09 16:00:00', 'pass6666', NULL, 'ext98375', 'Wolves', NULL, 'user', '2024-10-09 16:00:00', '2024-10-09 16:00:00'),
(24, 'Hannah Yellow', 'hannah1y@example.com', '2024-10-10 17:00:00', 'pass7777', 'avatar7.png', NULL, 'The Bulls', 'plok3456', 'user', '2024-10-10 17:00:00', '2024-10-10 17:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
