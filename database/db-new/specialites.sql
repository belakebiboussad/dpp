-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 20 sep. 2021 à 09:27
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
-- Structure de la table `specialites`
--

DROP TABLE IF EXISTS `specialites`;
CREATE TABLE IF NOT EXISTS `specialites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(70) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL COMMENT 'null:autre,0:medicale,1:chirgical',
  `exmsbio` json NOT NULL,
  `exmsImg` json NOT NULL,
  `nbMax` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `specialites`
--

INSERT INTO `specialites` (`id`, `nom`, `type`, `exmsbio`, `exmsImg`, `nbMax`) VALUES
(1, 'Cardiologie', 0, '[\"3\", \"13\", \"26\", \"35\", \"39\", \"46\", \"59\", \"60\", \"81\"]', '[\"1\", \"2\", \"3\", \"4\", \"5\", \"10\"]', NULL),
(2, 'Ophtalmologie', 0, 'null', 'null', NULL),
(3, 'Pédiatrie', 0, 'null', 'null', NULL),
(4, 'ORL', 0, 'null', 'null', NULL),
(5, 'Génécologie', 0, 'null', 'null', NULL),
(6, 'Chirurgie dentaire', 1, 'null', 'null', NULL),
(7, 'L’angiographie', 0, 'null', 'null', NULL),
(8, 'Gériatrie', 0, 'null', 'null', NULL),
(9, 'Néphrologie', 0, 'null', 'null', NULL),
(10, 'Gastrologie', 0, 'null', 'null', NULL),
(11, 'Médecine interne', 0, 'null', 'null', NULL),
(12, 'Pré-anesthésie', 1, 'null', 'null', NULL),
(13, 'Radiologie', 0, 'null', 'null', NULL),
(14, 'PHARMACIE', 0, 'null', 'null', NULL),
(15, 'Autre', NULL, 'null', 'null', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
