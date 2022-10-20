-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 15 oct. 2022 à 22:36
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
-- Base de données :  `dppdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `admissions`
--

DROP TABLE IF EXISTS `admissions`;
CREATE TABLE IF NOT EXISTS `admissions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `demande_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `id_rdvHosp` int(11) DEFAULT NULL,
  `pieces` varchar(20) NOT NULL,
  `etat` tinyint(1) DEFAULT NULL COMMENT 'null:encours,1:validée',
  PRIMARY KEY (`id`),
  KEY `admissions_id_rdvHosp_foreign` (`id_rdvHosp`) USING BTREE,
  KEY `fk_admission_demandeHosp` (`demande_id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admissions`
--

INSERT INTO `admissions` (`id`, `demande_id`, `date`, `id_rdvHosp`, `pieces`, `etat`) VALUES
(1, 47, '2021-07-10 14:01:27', 3, '', NULL),
(3, 48, '2021-07-12 10:48:44', NULL, '', 1),
(4, 52, '2021-07-12 13:29:31', 11, '', NULL),
(5, 50, '2021-07-13 08:58:56', 4, '', NULL),
(6, 53, '2021-07-13 09:02:55', 13, '', NULL),
(8, 54, '2021-07-24 16:54:42', NULL, '', NULL),
(9, 71, '2022-03-30 10:04:12', NULL, '', 1),
(10, 73, '2022-03-30 10:04:20', NULL, '', NULL),
(11, 75, '2022-03-30 10:43:22', NULL, '', NULL),
(12, 67, '2022-04-03 09:20:23', 16, '', NULL),
(14, 70, '2022-04-07 15:34:26', 18, '', 1),
(15, 76, '2022-04-14 08:29:03', 19, '', 1),
(16, 82, '2022-04-14 16:08:57', 20, '', 1),
(17, 81, '2022-04-14 16:29:53', 21, '', 1),
(18, 83, '2022-04-14 17:17:55', 22, '', NULL),
(19, 84, '2022-04-14 17:37:37', 23, '', NULL),
(20, 77, '2022-04-19 10:04:49', 25, '', 1),
(21, 86, '2022-05-12 10:16:11', 26, '', 1),
(22, 74, '2022-05-12 14:27:41', 27, '', NULL),
(23, 72, '2022-05-12 14:27:45', 28, '', NULL),
(32, 89, '2022-05-18 12:23:04', NULL, '', NULL),
(33, 89, '2022-05-18 12:23:33', NULL, '', NULL),
(34, 87, '2022-05-18 13:34:49', 30, '', NULL),
(35, 105, '2022-07-25 14:50:04', 45, '', NULL),
(36, 102, '2022-07-25 14:50:15', 44, '', NULL),
(37, 95, '2022-07-25 14:52:34', 40, '', NULL),
(38, 109, '2022-09-06 14:21:34', 47, '', NULL),
(39, 111, '2022-09-26 15:23:12', 49, '', NULL),
(40, 68, '2022-09-26 16:05:19', 50, '', NULL),
(48, 92, '2022-10-15 00:00:00', 51, '[\"0\",\"1\",\"2\"]', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `admissions`
--
ALTER TABLE `admissions`
  ADD CONSTRAINT `fk_adm_dem` FOREIGN KEY (`demande_id`) REFERENCES `demandehospitalisations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_adm_rdvh` FOREIGN KEY (`id_rdvHosp`) REFERENCES `rdv_hospitalisations` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
