-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 02 Novembre 2020 à 05:15
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `teste`
--

-- --------------------------------------------------------

--
-- Structure de la table `etat_sortie`
--

CREATE TABLE `etat_sortie` (
  `id` int(11) NOT NULL,
  `titre` varchar(200) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `typeEtat` varchar(100) DEFAULT NULL,
  `datafile` longblob,
  `id_visite` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `etat_sortie`
--

INSERT INTO `etat_sortie` (`id`, `titre`, `description`, `typeEtat`, `datafile`, `id_visite`) VALUES
(4, 'nnnnnnn', 'nnnn', 'hospitalisation', 0x496b4d365846786d5957746c63474630614678634e544975616e426e49673d3d, 1067),
(3, 'nnnnnnn', 'nnnn', 'hospitalisation', 0x496b4d365846786d5957746c63474630614678634e544975616e426e49673d3d, 1067);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `etat_sortie`
--
ALTER TABLE `etat_sortie`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `etat_sortie`
--
ALTER TABLE `etat_sortie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
