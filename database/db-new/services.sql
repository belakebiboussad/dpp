-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 26 juil. 2022 à 23:08
-- Version du serveur :  5.7.21
-- Version de PHP :  7.2.4

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
-- Structure de la table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(500) NOT NULL,
  `responsable_id` int(11) DEFAULT NULL,
  `hebergement` tinyint(1) DEFAULT '1' COMMENT '0:non,1:oui',
  `urgence` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:non ,1:urgence',
  `type` enum('0','1','2','3') DEFAULT '1' COMMENT '0:medicale,1:chirurgicale,2:paramédical,3:administratif',
  `specialite_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `responsable_id` (`responsable_id`),
  KEY `FK_service_type` (`type`),
  KEY `fk_service_specialite` (`specialite_id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `nom`, `responsable_id`, `hebergement`, `urgence`, `type`, `specialite_id`) VALUES
(1, 'CARDIOLOGIE', 100, 1, 0, '0', 1),
(2, 'OPHTALMOLOGIE', 88, 0, 0, '0', 2),
(3, 'PEDIATRIE', 103, 1, 0, '0', 3),
(4, 'ORL', 79, 0, 0, '0', 4),
(5, 'GENECOLOGIE', 116, 1, 0, '0', 5),
(6, 'CHIRURGIE DENTAIRE', 88, 0, 0, '0', 6),
(7, 'L’ANGIOGRAPHIE', 80, 0, 0, '0', 7),
(8, 'GERIATRIE', 117, 1, 0, '1', 8),
(9, 'NEPHROLOGIE', 94, 0, 0, '0', 9),
(10, 'GASTROLOGIE', 1, 0, 0, '0', 10),
(11, 'MEDECINE INTERNE', 80, 1, 0, '0', 11),
(12, 'PRE-ANESTHESIE', 68, 0, 0, '0', 12),
(13, 'RADIOLOGIE', 101, 0, 0, '2', 13),
(14, 'PHARMACIE', 99, 0, 0, '2', 14),
(17, 'Chirurgie', 103, 0, 1, '1', 15),
(18, 'Laboratoire Biologique', 97, 0, 0, '2', NULL),
(19, 'Radiologie', 101, 0, 0, '2', NULL),
(20, 'BUREAU DES ADMISSIONS', 95, 0, 0, '3', NULL),
(21, 'Direction', 101, 0, 0, '3', NULL),
(22, 'Consultations externes', 123, 0, 0, '0', 16),
(87, 'Sécretariat', NULL, 0, 0, '3', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `fk_service_specialite` FOREIGN KEY (`specialite_id`) REFERENCES `specialites` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
