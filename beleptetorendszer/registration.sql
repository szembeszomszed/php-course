-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2016. Aug 01. 12:49
-- Kiszolgáló verziója: 10.1.13-MariaDB
-- PHP verzió: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `loginrendszer`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `registration`
--

CREATE TABLE `registration` (
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `registration`
--

INSERT INTO `registration` (`name`, `email`, `password`) VALUES
('admin', 'admin@admin.hu', 'd033e22ae348aeb5660fc2140aec35850c4da997'),
('sanyi', 'sanyi@sanyi.hu', '1e219143fbfc9c8db14305e8b3cd94cfa32a98fc'),
('karcsi', 'karcsi@karcsi.hu', 'ad83f348f424408fdbbfcd94fe11c9e271efe048'),
('Sandor Szalacsi', 'sandor.szalacsi@oxigen.hu', 'a249fd0b9539861c463eac665d8ec5bcfc226851');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
