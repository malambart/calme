-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost
-- Généré le :  Jeu 27 Octobre 2016 à 15:14
-- Version du serveur :  5.7.10
-- Version de PHP :  7.0.2-4+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `calme`
--

-- --------------------------------------------------------

--
-- Structure de la table `questionnaires`
--

CREATE TABLE `questionnaires` (
  `id` int(10) UNSIGNED NOT NULL,
  `ls_id` int(10) UNSIGNED NOT NULL,
  `temps` int(10) UNSIGNED NOT NULL,
  `rep` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `questionnaires`
--

INSERT INTO `questionnaires` (`id`, `ls_id`, `temps`, `rep`,`titre`,`created_at`, `updated_at`) VALUES
(1, 798474, 1, 'JE','Questionnaire du jeune',  '2016-10-27 00:00:00','2016-10-20 00:00:00'),
(3, 397422, 1, 'EN',"Questionnaire de l'enseignant", '2016-10-27 00:00:00', '2016-10-27 00:00:00'),
(6, 349391, 1, 'PA',"Questionnaire du parent",'2016-10-27 00:00:00', '2016-10-27 00:00:00');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `questionnaires`
--
ALTER TABLE `questionnaires`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `questionnaires`
--
ALTER TABLE `questionnaires`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
