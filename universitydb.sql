-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Gegenereerd op: 01 feb 2021 om 12:14
-- Serverversie: 8.0.22-0ubuntu0.20.04.3
-- PHP-versie: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `universitydb`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `students`
--

CREATE TABLE `students` (
  `id` int NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `study` varchar(100) NOT NULL,
  `class` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `students`
--

INSERT INTO `students` (`id`, `firstname`, `lastname`, `dateOfBirth`, `study`, `class`, `email`, `date`) VALUES
(3, 'Lou', 'Creemers', '1998-12-16', 'Informatica', 'INF2C', '641347@student.inholland.nl', '2021-01-31'),
(4, 'Leon', 'van Stein Callenfels', '1996-11-02', 'Communicatie', 'COM2B', '631032@student.inholland.nl', '2021-01-31'),
(5, 'Lucilja', 'Gijbels', '2001-04-06', 'PABO', 'PB4D', '628193@student.inholland.nl', '2021-01-31'),
(7, 'Jan', 'de Maker', '2001-12-02', 'Communicatie', 'INF1B', '398421@student.inholland.nl', '2021-01-31');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`) VALUES
(1, 'Lou', 'Lou', 'lou@lou.com', '0929cfaf16017686a3f0075e78133064'),
(2, 'Hans', 'de Haas', 'hansdehaas@gmail.com', '43438afbe18cbe8e55f27a5d1436a58b'),
(3, 'Elizabeth ', 'de Meij', 'sjorsdemeij@gmail.com', 'ae0551adcbe5fa2c7215973730d68346'),
(5, 'admin', 'admin', 'Admin@gmail.com', 'fe8d5ddadc718376afe9041321104a13');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `students`
--
ALTER TABLE `students`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
