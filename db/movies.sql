-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 23 aug 2022 om 22:29
-- Serverversie: 10.4.24-MariaDB
-- PHP-versie: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movies`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `fname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `comment` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `user_rating` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `comment`
--

INSERT INTO `comment` (`comment_id`, `fname`, `comment`, `user_rating`, `date`, `user_id`, `movie_id`) VALUES
(11, 'kerim', 'This is one of the best movie I have ever seen before!!!!', 3, '2022-08-15 20:03:23', 3, 5),
(13, 'jhon', 'Novi komentar o ovom filmu .....', 4, '2022-08-15 20:14:43', 5, 5),
(14, 'kerim', 'Fisrt comment about this movie!', 5, '2022-08-19 23:05:46', 3, 20),
(16, 'kerim', 'Very nice movie', 5, '2022-08-20 17:09:15', 3, 18),
(23, 'jhon', 'Very nice movie!', 5, '2022-08-20 20:47:13', 5, 18),
(24, 'kerim', 'nice', 4, '2022-08-21 22:12:19', 3, 7),
(27, 'kerim', 'nice', 3, '2022-08-23 17:12:00', 3, 7);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `movie`
--

CREATE TABLE `movie` (
  `id` int(11) NOT NULL,
  `movie_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `img` longblob NOT NULL,
  `descriptions` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `year` int(11) NOT NULL,
  `category` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `movie`
--

INSERT INTO `movie` (`id`, `movie_name`, `img`, `descriptions`, `year`, `category`) VALUES
(5, 'Minions', 0x6d696e696f6e732e6a7067, 'In de jaren zeventig probeert de jonge Gru zich aan te sluiten bij een groep supervillains genaamd de Vicious 6 nadat ze hun leider hebben afgezet - de legendarische vechter Wild Knuckles. Wanneer het gesprek rampzalig afloopt, gaan Gru en zijn Minions op de vlucht met de Vicious 6 op hun hielen.', 2022, 'comedy'),
(6, 'Avatar', 0x6176617461722e6a7067, 'Avatar is een Amerikaanse stereoscopische (3D) sciencefiction film uit 2009 geregisseerd door James Cameron. De film ging op 16 december 2009 in première in de Verenigde Staten en bracht op die dag ruim 27 miljoen dollar op. Daarna bracht de film meer dan 2,7 miljard Amerikaanse dollar op en is daarmee de succesvolste film ooit.[4] Avatar won onder meer twee Golden Globes en drie Oscars.', 2007, 'action'),
(7, 'Movie', 0x6176617461722e6a7067, 'In de jaren zeventig probeert de jonge Gru zich aan te sluiten bij een groep supervillains genaamd de Vicious 6 nadat ze hun leider hebben afgezet - de legendarische vechter Wild Knuckles. Wanneer het gesprek rampzalig afloopt, gaan Gru en zijn Minions op de vlucht met de Vicious 6 op hun hielen.', 2007, 'Fantasy'),
(14, 'Avangers2', 0x393135326c4c737941614c2e6a7067, 'Het', 2010, 'Fantasy'),
(15, 'Superman', 0x73757065726d616e2e6a7067, 'Superman is een vast personage binnen het DC Universum en heeft model gestaan voor tal van andere superhelden. Door de jaren heen is het personage steeds verder ontwikkeld en kreeg hij meer superkrachten, een gedetailleerdere afkomst en uitgebreide cast van nevenpersonages, zoals Superboy (een kloon van superman die half mens en half kryptoniaans is), Supergirl, Krypto, Lois Lane en zijn aartsvijanden Lex Luthor, Doomsday, Darkseid, General Zod, Parasite, Toyman en Brainiac.', 1978, 'action'),
(16, 'Rush Hour', 0x727573682d686f75722e6a7067, 'Inspecteur Lee, de trots van de Hongkongse politie, reist naar Los Angeles, waar de elfjarige dochter van de Chinese consul werd ontvoerd. De FBI zit niet te wachten op een bemoeizieke buitenstaander en zet agent James Carter in om op Lee te passen.', 1998, 'comedy'),
(17, 'Rush Hour 2', 0x727573682d686f7572322e6a7067, 'Inspecteur Lee, de trots van de Hongkongse politie, reist naar Los Angeles, waar de elfjarige dochter van de Chinese consul werd ontvoerd. De FBI zit niet te wachten op een bemoeizieke buitenstaander en zet agent James Carter in om op Lee te passen.', 2000, 'comedy'),
(18, 'Rush Hour 3', 0x727573682d686f7572332e6a7067, 'Inspecteur Lee, de trots van de Hongkongse politie, reist naar Los Angeles, waar de elfjarige dochter van de Chinese consul werd ontvoerd. De FBI zit niet te wachten op een bemoeizieke buitenstaander en zet agent James Carter in om op Lee te passen.', 2007, 'comedy'),
(19, 'The conjuring 2', 0x54686520636f6e6a7572696e6720322e6a7067, 'Experts op het gebied van het paranormale, Lorraine en Ed, proberen een gezin te helpen dat wordt aangevallen door onzichtbare krachten. Lorraine en Ed komen uiteindelijk oog in oog te staan met een demonische entiteit.', 2021, 'Horror'),
(20, 'Annabelle', 0x416e6e6162656c6c652e6a7067, 'Vastbesloten om te voorkomen dat Annabelle nog meer schade aanricht, sluiten paranormale onderzoekers Ed en Lorraine Warren de bezeten pop op in de artefactenkamer in hun huis.', 2019, 'Horror'),
(21, 'Titanic', 0x746974616e69632e6a7067, 'Een vrouw uit een hoge sociale klasse wordt verliefd op een jonge kunstenaar en verlaat haar hooghartige verloofde. Het verhaal speelt zich af op een luxueus schip dat een slecht lot treft.', 1997, 'drama'),
(22, 'The princess game', 0x546865207072696e636573732067616d652e6a7067, 'Wanneer een eigenzinnige prinses weigert te trouwen met een sociopaat, wordt ze opgesloten in een toren. Met haar geminachte, wraakzuchtige minnaar gebrand op de troon van haar vader, moet de prinses haar familie beschermen en het koninkrijk redden.', 2022, 'Fantasy'),
(23, 'Falling in love', 0x46616c6c696e6620696e206c6f76652e6a7067, 'Wanneer een eigenzinnige prinses weigert te trouwen met een sociopaat, wordt ze opgesloten in een toren. Met haar geminachte, wraakzuchtige minnaar gebrand op de troon van haar vader, moet de prinses haar familie beschermen en het koninkrijk redden.', 2015, 'Romace');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `stars`
--

CREATE TABLE `stars` (
  `id` int(11) NOT NULL,
  `rateIndex` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `type`) VALUES
(3, 'kerim', '1234', 'test@test.com', 0),
(4, 'azra', '1234', 'azra@azra.com', 1),
(5, 'jhon', '123456', 'jhon@wayne.com', 0),
(23, 'spiderman', '$2y$10$IvX3Kid8jYZHl58x/xQ3Euaj1Ef4yYAEtl/G4C5Bs9uCFnw0BMCvm', 'spider@man.com', 0),
(24, 'novikorisnik', '$2y$10$C8k/VUwdBaZTPqzDi/e25u7CazB8vy6MOSkbo9ekDWp7fSCMB/WIW', 'novi@korisnik.com', 0),
(25, 'azraramic', '$2y$10$oIc.U0R7C7pb5BsFXmE5iujjj83PNcJ15LgBRAt9vvyUutt.cQeyG', 'azra@ramic.com', 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comment-movie` (`movie_id`),
  ADD KEY `comment-user` (`user_id`);

--
-- Indexen voor tabel `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `stars`
--
ALTER TABLE `stars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user-key` (`user_id`),
  ADD KEY `movie_key` (`movie_id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT voor een tabel `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT voor een tabel `stars`
--
ALTER TABLE `stars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment-movie` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment-user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `stars`
--
ALTER TABLE `stars`
  ADD CONSTRAINT `movie_key` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
