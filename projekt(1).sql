-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 30. Apr 2013 um 22:22
-- Server Version: 5.5.27
-- PHP-Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `projekt`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artikel`
--

CREATE TABLE IF NOT EXISTS `artikel` (
  `Artikelnummer` int(11) NOT NULL,
  `Name` text COLLATE latin1_german1_ci NOT NULL,
  `Preis` float NOT NULL,
  `Bild` text COLLATE latin1_german1_ci NOT NULL,
  `Bestand` int(11) NOT NULL,
  `Verein` text COLLATE latin1_german1_ci NOT NULL,
  PRIMARY KEY (`Artikelnummer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

--
-- Daten für Tabelle `artikel`
--

INSERT INTO `artikel` (`Artikelnummer`, `Name`, `Preis`, `Bild`, `Bestand`, `Verein`) VALUES
(1000, 'Schal', 9.99, 'stuttgartschal.jpg', 24, 'VFB Stuttgart'),
(1100, 'Tasse', 14.95, 'stuttgarttasse.jpg', 20, 'VFB Stuttgart'),
(1200, 'Fahne', 19.99, 'stuttgartfahne.jpg', 18, 'VFB Stuttgart'),
(2000, 'Schal', 12, 'dortmundschal.jpg', 21, 'Borussia Dortmund'),
(2100, 'Tasse', 9.99, 'dortmundtasse.jpg', 20, 'Borussia Dortmund'),
(3000, 'Schal', 15, 'muenchenschal.jpg', 12, 'FC Bayern München'),
(3100, 'Tasse', 16, 'muenchentasse.jpg', 11, 'FC Bayern München'),
(3200, 'Fahne', 19.99, 'muenchenfahne.jpg', 13, 'FC Bayern München');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellung`
--

CREATE TABLE IF NOT EXISTS `bestellung` (
  `Artikelnummer` int(11) NOT NULL,
  `Usernummer` int(11) NOT NULL,
  `Anzahl` int(11) NOT NULL,
  `Bestellzeitpunkt` text NOT NULL,
  `Gesamtpreis` int(11) NOT NULL,
  `Kommentar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `Name` text COLLATE latin1_german1_ci NOT NULL,
  `Vorname` text COLLATE latin1_german1_ci NOT NULL,
  `Mail` text COLLATE latin1_german1_ci NOT NULL,
  `Strasse` text COLLATE latin1_german1_ci NOT NULL,
  `Hausnummer` int(11) NOT NULL,
  `PLZ` int(5) NOT NULL,
  `Ort` text COLLATE latin1_german1_ci NOT NULL,
  `Passwort` text COLLATE latin1_german1_ci NOT NULL,
  `Verein` text COLLATE latin1_german1_ci NOT NULL,
  `Nummer` int(11) NOT NULL,
  PRIMARY KEY (`Nummer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`Name`, `Vorname`, `Mail`, `Strasse`, `Hausnummer`, `PLZ`, `Ort`, `Passwort`, `Verein`, `Nummer`) VALUES
('Händler', '', 'handler@shop.de', '', 67, 34534, '', 'Zolg123', 'VFB Stuttgart', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `warenkorb`
--

CREATE TABLE IF NOT EXISTS `warenkorb` (
  `Usernummer` int(11) NOT NULL,
  `Artikelnummer` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Verein` text NOT NULL,
  `Preis` int(11) NOT NULL,
  `Anzahl` int(11) NOT NULL,
  `Gesamtpreis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
