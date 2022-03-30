-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 29 mars 2022 à 23:14
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
-- Structure de la table `demandehospitalisations`
--

DROP TABLE IF EXISTS `demandehospitalisations`;
CREATE TABLE IF NOT EXISTS `demandehospitalisations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service` int(11) DEFAULT NULL,
  `specialite` int(11) NOT NULL,
  `modeAdmission` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:Programme,1:Ambulatoire,2:Urgence',
  `degree_urgence` enum('F','M','H') DEFAULT NULL,
  `etat` tinyint(1) DEFAULT NULL COMMENT '	null=''en cours'',1=''programme'',0=''annule'',2=''admise'',3=''hospitalisation'',4=''en Attente'',5="Valide"	',
  `id_consultation` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_consultation`),
  KEY `fk_DemandeHospitalisation_Consultation1_idx` (`id_consultation`),
  KEY `service` (`service`),
  KEY `fk_dh_specialite` (`specialite`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `demandehospitalisations`
--
ALTER TABLE `demandehospitalisations`
  ADD CONSTRAINT `fk_dh_consultation` FOREIGN KEY (`id_consultation`) REFERENCES `consultations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dh_service` FOREIGN KEY (`service`) REFERENCES `services` (`id`),
  ADD CONSTRAINT `fk_dh_specialite` FOREIGN KEY (`specialite`) REFERENCES `specialites` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
