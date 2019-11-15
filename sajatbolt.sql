-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1:3307
-- Létrehozás ideje: 2019. Nov 15. 09:21
-- Kiszolgáló verziója: 10.1.34-MariaDB
-- PHP verzió: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `sajatbolt`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kavefozok`
--

CREATE TABLE `kavefozok` (
  `id` int(11) NOT NULL,
  `nev` varchar(30) COLLATE utf8_hungarian_ci NOT NULL,
  `ar` int(11) NOT NULL,
  `gyartas_ideje` date NOT NULL,
  `daralo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `kavefozok`
--

INSERT INTO `kavefozok` (`id`, `nev`, `ar`, `gyartas_ideje`, `daralo`) VALUES
(1, 'Sencor SES4040BK', 42000, '2019-11-12', 0),
(10, 'Sencor SES4040BK', 52000, '2019-11-14', 1),
(11, 'Sencor SES4040BK', 12000, '2019-11-12', 1),
(13, 'Sencor SES4040BK', 30000, '2019-11-08', 1);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `kavefozok`
--
ALTER TABLE `kavefozok`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `kavefozok`
--
ALTER TABLE `kavefozok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
