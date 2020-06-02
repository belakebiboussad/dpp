-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 02 juin 2020 à 10:21
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

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
-- Structure de la vue `nextrdvs`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `nextrdvs`  AS  select `rdvs`.`id` AS `id`,`rdvs`.`Date_RDV` AS `Date_RDV`,`rdvs`.`Patient_ID_Patient` AS `patientId`,`patients`.`IPP` AS `IPP`,`patients`.`Nom` AS `Nom`,`patients`.`Prenom` AS `Prenom`,`specialites`.`nom` AS `specialite` from ((`rdvs` join `patients` on((`rdvs`.`Patient_ID_Patient` = `patients`.`id`))) join `specialites` on((`rdvs`.`specialite` = `specialites`.`id`))) where (`rdvs`.`Date_RDV` between (curdate() + interval 1 day) and (curdate() + interval 2 day)) order by `rdvs`.`Date_RDV` desc ;

--
-- VIEW  `nextrdvs`
-- Données :  Aucun(e)
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
