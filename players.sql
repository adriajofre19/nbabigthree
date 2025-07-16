-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-07-2025 a las 14:46:19
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
-- Estructura de tabla para la tabla `players`
--

CREATE TABLE `players` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `team` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `player_code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `players`
--

INSERT INTO `players` (`id`, `name`, `avatar`, `position`, `team`, `role`, `user_id`, `player_code`, `created_at`, `updated_at`) VALUES
(992, 'Devin Booker', 'https://cdn.nba.com/headshots/nba/latest/1040x760/1626164.png', 'escolta', 'Phoenix Suns', 'titular', 24, 'b/bookede01', '2024-10-23 11:30:57', '2024-10-23 13:11:33'),
(993, 'Jordan Clarkson', 'https://cdn.nba.com/headshots/nba/latest/1040x760/203903.png', 'escolta', 'Utah Jazz', 'suplente', 1, 'c/clarkjo01', '2024-10-23 11:30:57', '2024-12-08 18:41:53'),
(994, 'Luguentz Dort', 'https://cdn.nba.com/headshots/nba/latest/1040x760/1629652.png', 'ala-pivot', 'Oklahoma City Thunder', 'suplente', 1, 'd/dortlu01', '2024-10-23 11:30:57', '2024-10-28 18:18:27'),
(995, 'Walker Kessler', 'https://cdn.nba.com/headshots/nba/latest/1040x760/1631117.png', 'pivot', 'Utah Jazz', 'titular', 1, 'k/kesslwa01', '2024-10-23 11:30:57', '2024-10-23 11:30:57'),
(996, 'Tyrese Maxey', 'https://cdn.nba.com/headshots/nba/latest/1040x760/1630178.png', 'base', 'Philadelphia 76ers', 'titular', 3, 'm/maxeyty01', '2024-10-23 11:30:57', '2024-10-24 09:37:30'),
(997, 'Domantas Sabonis', 'https://cdn.nba.com/headshots/nba/latest/1040x760/1627734.png', 'pivot', 'Sacramento Kings', 'titular', 1, 's/sabondo01', '2024-10-23 11:30:57', '2024-10-28 18:18:36'),
(998, 'Marcus Smart', 'https://cdn.nba.com/headshots/nba/latest/1040x760/203935.png', 'base', 'Memphis Grizzlies', 'suplente', 1, 's/smartma01', '2024-10-23 11:30:57', '2024-12-08 18:41:14'),
(999, 'Jeremy Sochan', 'https://cdn.nba.com/headshots/nba/latest/1040x760/1631110.png', 'base', 'San Antonio Spurs', 'titular', 1, 's/sochaje01', '2024-10-23 11:30:57', '2024-12-08 18:41:26'),
(1000, 'Andrew Wiggins', 'https://cdn.nba.com/headshots/nba/latest/1040x760/203952.png', 'pivot', 'Golden State Warriors', 'titular', 3, 'w/wiggian01', '2024-10-23 11:30:57', '2024-10-24 09:14:29'),
(1001, 'Grayson Allen', 'https://cdn.nba.com/headshots/nba/latest/1040x760/1628960.png', 'escolta', 'Phoenix Suns', 'titular', 1, 'a/allengr01', '2024-10-23 11:30:57', '2024-12-08 18:41:53'),
(1002, 'Wendell Carter Jr.', 'https://cdn.nba.com/headshots/nba/latest/1040x760/1628976.png', 'pivot', 'Orlando Magic', 'titular', 3, 'c/cartewe01', '2024-10-23 11:30:57', '2024-10-23 11:30:57'),
(1003, 'Stephen Curry', 'https://cdn.nba.com/headshots/nba/latest/1040x760/201939.png', 'escolta', 'Golden State Warriors', 'suplente', 1, 'c/curryst01', '2024-10-23 11:30:57', '2024-12-08 20:09:13'),
(1004, 'Jalen Green', 'https://cdn.nba.com/headshots/nba/latest/1040x760/1630224.png', 'escolta', 'Houston Rockets', 'titular', 3, 'g/greenja01', '2024-10-23 11:30:57', '2024-10-23 11:30:57'),
(1005, 'Caris LeVert', 'https://cdn.nba.com/headshots/nba/latest/1040x760/1627747.png', 'pivot', 'Cleveland Cavaliers', 'titular', 3, 'l/leverca01', '2024-10-23 11:30:57', '2024-10-23 11:30:57'),
(1006, 'Trey Murphy III', 'https://cdn.nba.com/headshots/nba/latest/1040x760/1630530.png', 'base', 'New Orleans Pelicans', 'suplente', 3, 'm/murphtr01', '2024-10-23 11:30:57', '2024-10-23 11:30:57'),
(1007, 'Keegan Murray', 'https://cdn.nba.com/headshots/nba/latest/1040x760/1631099.png', 'base', 'Sacramento Kings', 'suplente', 3, 'm/murrake01', '2024-10-23 11:30:57', '2024-10-23 11:30:57'),
(1008, 'Michael Porter Jr.', 'https://cdn.nba.com/headshots/nba/latest/1040x760/1629008.png', 'alero', 'Denver Nuggets', 'suplente', 3, 'p/portemi01', '2024-10-23 11:30:57', '2024-10-23 11:30:57'),
(1009, 'Pascal Siakam', 'https://cdn.nba.com/headshots/nba/latest/1040x760/1627783.png', 'pivot', 'Toronto Raptors', 'suplente', 3, 's/siakapa01', '2024-10-23 11:30:57', '2024-10-23 11:30:57'),
(1010, 'Alex Caruso', 'https://cdn.nba.com/headshots/nba/latest/1040x760/1627936.png', 'base', 'Chicago Bulls', 'titular', 4, 'c/carusal01', '2024-10-23 11:30:57', '2024-10-23 11:30:57'),
(1011, 'Rob Dillingham', 'https://cdn.nba.com/headshots/nba/latest/1040x760/1642265.png', 'ala-pivot', 'Sin equipo', 'titular', 4, 'd/dilliro01', '2024-10-23 11:30:57', '2024-10-23 11:30:57'),
(1012, 'Joel Embiid', 'https://cdn.nba.com/headshots/nba/latest/1040x760/203954.png', 'base', 'Philadelphia 76ers', 'titular', 4, 'e/embiijo01', '2024-10-23 11:30:57', '2024-10-23 11:30:57'),
(1013, 'Josh Giddey', 'https://cdn.nba.com/headshots/nba/latest/1040x760/1630581.png', 'base', 'Oklahoma City Thunder', 'titular', 4, 'g/giddejo01', '2024-10-23 11:30:57', '2024-10-23 11:30:57'),
(1014, 'Isaiah Hartenstein', 'https://cdn.nba.com/headshots/nba/latest/1040x760/1628392.png', 'escolta', 'Oklahoma City Thunder', 'titular', 4, 'h/harteis01', '2024-10-23 11:30:57', '2024-10-23 11:30:57'),
(1015, 'Malik Monk', 'https://cdn.nba.com/headshots/nba/latest/1040x760/1628370.png', 'pivot', 'Sacramento Kings', 'suplente', 4, 'm/monkma01', '2024-10-23 11:30:57', '2024-10-23 11:30:57'),
(1016, 'Alexandre Sarr', 'https://cdn.nba.com/headshots/nba/latest/1040x760/1642259.png', 'alero', 'Sin equipo', 'suplente', 4, 's/sarral01', '2024-10-23 11:30:57', '2024-10-23 11:30:57');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`),
  ADD KEY `players_user_id_index` (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `players`
--
ALTER TABLE `players`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1172;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
