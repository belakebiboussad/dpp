-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 15 mars 2022 à 17:47
-- Version du serveur :  5.7.23
-- Version de PHP : 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dpdgsn`
--

-- --------------------------------------------------------

--
-- Structure de la vue `nextrdvs`
--

DROP VIEW IF EXISTS `nextrdvs`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `nextrdvs`  AS SELECT `rdvs`.`id` AS `id`, date_format(`rdvs`.`date`,'%Y-%m-%d') AS `DateRdv`, `rdvs`.`patient_id` AS `patientId`, `patients`.`IPP` AS `IPP`, `patients`.`Nom` AS `Nom`, `patients`.`Prenom` AS `Prenom`, `patients`.`Sexe` AS `Sexe`, date_format(ifnull(`patients`.`Dat_Naissance`,'19700101'),'%Y-%m-%d') AS `DateNaissance`, `specialites`.`id` AS `specialiteId` FROM ((`rdvs` join `patients` on((`rdvs`.`patient_id` = `patients`.`id`))) join `specialites` on((`rdvs`.`specialite_id` = `specialites`.`id`))) WHERE ((`rdvs`.`date` between (curdate() + interval 1 day) and (curdate() + interval 2 day)) AND isnull(`rdvs`.`etat`)) ORDER BY `rdvs`.`date` DESC ;

--
-- VIEW `nextrdvs`
-- Données : Aucun(e)
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
