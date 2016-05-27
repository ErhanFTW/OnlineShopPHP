-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 27. Mai 2016 um 13:20
-- Server-Version: 10.1.13-MariaDB
-- PHP-Version: 5.6.21

/**
Autor: Sezgin Arslan
 */

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `Kamehameha`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Benutzer`
--

CREATE TABLE `Benutzer` (
  `User_ID` int(11) NOT NULL,
  `Passwort` varchar(32) NOT NULL,
  `Vorname` varchar(32) NOT NULL,
  `Nachname` varchar(32) NOT NULL,
  `E-Mail` varchar(1024) NOT NULL,
  `Aktivierung` int(11) NOT NULL DEFAULT '0',
  `Benutzername` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `Benutzer`
--

INSERT INTO `Benutzer` (`User_ID`, `Passwort`, `Vorname`, `Nachname`, `E-Mail`, `Aktivierung`, `Benutzername`) VALUES
(1, '5f4dcc3b5aa765d61d8327deb882cf99', 'Seza', 'Arslan', 'seza@superrito.com', 0, 'SezaA');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `warenkorb`
--

CREATE TABLE IF NOT EXISTS `warenkorb` (
  `ID` int(11) NOT NULL,
  `Artikelnummer` VARCHAR (10) NOT NULL,
  `Name` text NOT NULL,
  `Preis` int(11) NOT NULL,
  `Anzahl` int(11) NOT NULL,
  `Gesamtpreis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artikel`
--

CREATE TABLE IF NOT EXISTS `artikel` (
  `Artikelnummer` VARCHAR (10) NOT NULL,
  `Name` text COLLATE latin1_german1_ci NOT NULL,
  `Preis` float NOT NULL,
  `Bild` text COLLATE latin1_german1_ci NOT NULL,
  `Bestand` int(11) NOT NULL,
  PRIMARY KEY (`Artikelnummer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

--
-- Daten für Tabelle `artikel`
--

INSERT INTO `artikel` (`Artikelnummer`, `Name`, `Preis`, `Bild`, `Bestand`) VALUES

(549619H, 'Hose', 60, 'venumhoserot.jpg', 100),
(549619HA,'Handschuhe', 70, 'venumhandschuhe.jpg', 100),
(549619K, 'Kopfschutz', 90, 'venumkopfschutz.jpg', 100),
(549619S, 'Schienbeinschoner', 60, 'venumschienbeinschutz.jpg', 100),
(549619M, 'Mundschutz', 15, 'venummundschutz.jpg', 100),
(549619T, 'Tiefenschutz', 30, 'venumtiefenschutz.jpg', 100),


-- --------------------------------------------------------

