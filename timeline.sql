-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 07 Lis 2022, 04:18
-- Wersja serwera: 10.4.25-MariaDB
-- Wersja PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `timeline`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `typeId` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date DEFAULT NULL,
  `shortDescription` text NOT NULL,
  `longDescription` text NOT NULL,
  `imgUrl` text NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `events`
--

INSERT INTO `events` (`id`, `typeId`, `startDate`, `endDate`, `shortDescription`, `longDescription`, `imgUrl`, `name`) VALUES
(1, 2, '1992-10-14', '1998-02-19', 'to był piękny dzień', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap ', 'img/dojo.jpg', 'dodanie na nasdaq'),
(4, 1, '2012-11-07', '1970-01-01', 'to było ciężkie przeżycie dla wszystkich pracowników', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the wor', 'img/dojo.jpg', 'uderzenie pioruna w fabrykę'),
(15, 1, '2020-02-05', '2022-11-10', 'technologia się rozwija', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passag', 'img/prototype2.jpg', 'nowe patenty');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `types`
--

INSERT INTO `types` (`id`, `name`, `icon`) VALUES
(1, 'star green', 'star_green.png'),
(2, 'square blue', 'square_blue.png'),
(3, '234fd', 'flask.png'),
(7, 'typ4', 'report.png'),
(9, 'typ100test', 'test100.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(60) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `role`, `question`, `answer`) VALUES
(3, 'andrzej', '$2y$10$VfhQSnMHdHDf4.FFW8EbYuuVGYjaAB0mHi0aCje..3R154otKwpW.', 1, 'ocena z zaawansowanych aplikacji internetowych', '2'),
(4, 'daniel', '$2y$10$C9XhWUDZmHOgc8wyKyaldudv0OcXMqqNwTWHgYmL7Y5FVGqn6YmoS', 2, 'ocena z zaawansowanych aplikacji internetowych', '2');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type event` (`typeId`);

--
-- Indeksy dla tabeli `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT dla tabeli `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `type event` FOREIGN KEY (`typeId`) REFERENCES `types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
