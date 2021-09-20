-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 20 sep. 2021 à 09:29
-- Version du serveur :  5.7.21
-- Version de PHP :  7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dpdgsn`
--

-- --------------------------------------------------------

--
-- Structure de la table `typesexam`
--

DROP TABLE IF EXISTS `typesexam`;
CREATE TABLE IF NOT EXISTS `typesexam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `typesexam`
--

INSERT INTO `typesexam` (`id`, `nom`) VALUES
(1, 'RX'),
(2, 'RMN'),
(3, 'CT'),
(4, 'Echographie'),
(5, 'Dopler'),
(6, 'Echographie'),
(7, 'Mammographie'),
(8, 'Angiographie'),
(9, 'Coloscopie'),
(10, 'ECG'),
(11, 'Scintigraphie'),
(12, 'Ostéodensitométrie'),
(13, 'Urographie IV'),
(14, 'Hysterographie');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
