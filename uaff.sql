-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 26 Novembre 2017 à 22:55
-- Version du serveur: 5.5.43-0+deb7u1-log
-- Version de PHP: 5.2.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `uaff`
--
CREATE DATABASE `uaff` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `uaff`;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `created` date NOT NULL,
  `auteur` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `top` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `created`, `auteur`, `active`, `top`) VALUES
(10, 'La FRANCE a l''EURO Futsal 2018 !!!                                                                ', 'En s''imposant (5-4) face Ã  la Croatie le 26 septembre Ã  Dubrovnik, en match de barrage retour, l''Ã‰quipe de France de Futsal a dÃ©crochÃ© son billet pour l''Euro 2018. Une premiÃ¨re historique.\r\n', '2017-10-02', 'toufutsal', 1, 0),
(11, 'LA REPRISE 1/2', 'Trois matchs au programme ce dimanche pour la reprise du championnat U15.\r\nOMJA 1- PARIS ACASA qui s''est soldÃ© par un report du match.\r\nle FCG -JA qui a accouche d une belle prestation goussainvilloise face a une Ã©quipe  accrocheuse d''Aulnays venus en dÃ©coudre sur le parquet Goussainvillois,score 3-3.\r\n', '2017-10-13', 'John Shaft', 1, 0),
(12, 'LA REPRISE 2/2', 'Et pour finir les dionysiens de l ile st denis Ã©taient opposes au tenant du titre l OMJA 2 qui rÃ©affirme son statut de favoris en continuite  directe avant la saison passÃ©e en s imposant sur le score fleuve de 11-2 plaÃ§ant aussi ,les aubervillois directement a la premiÃ¨re place de ce classement et favoris directe a leur propre succession .', '2017-10-13', 'John Shaft', 1, 0),
(13, 'la rentrer des U13', 'Pour leur premiÃ¨re, la rencontre opposant le FC Goussainville au FC Clichois fut un match exceptionnel riches en rebondissement et en buts et que dire du bijoux du joueur du FC Goussainville qui inscrit un somptueux coup franc imparable par le gardien qui se logea en pleine lulu!!! le FC Goussainville s impose sur le score de 7-2.En attendant le derby aubervillois qui se dÃ©roulera le 22 octobre le FCG occupe la premiÃ¨re place du classement', '2017-10-16', 'toufutsal', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `championnat`
--

CREATE TABLE IF NOT EXISTS `championnat` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description_short` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `genre` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `championnat`
--

INSERT INTO `championnat` (`id`, `name`, `description_short`, `description`, `genre`) VALUES
(1, 'uaff u9', '', '', 'G'),
(2, 'uaff u11', '', '', 'G'),
(3, 'uaff 13', '', '', 'G'),
(4, 'uaff u15', '', '', 'G'),
(5, 'uaff u9f', '', '', 'F'),
(6, 'uaff u11f', '', '', 'F'),
(7, 'uaff u13f', '', '', 'F'),
(8, 'uaff u15f', '', '', 'F');

-- --------------------------------------------------------

--
-- Structure de la table `classement`
--

CREATE TABLE IF NOT EXISTS `classement` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `equipe` varchar(50) NOT NULL,
  `mj` tinyint(3) unsigned NOT NULL,
  `g` tinyint(3) unsigned NOT NULL,
  `n` tinyint(3) unsigned NOT NULL,
  `p` tinyint(3) unsigned NOT NULL,
  `bp` tinyint(3) unsigned NOT NULL,
  `bc` tinyint(3) unsigned NOT NULL,
  `db` tinyint(3) NOT NULL,
  `pts` int(3) unsigned NOT NULL,
  `championnat_id` int(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `championnat_id` (`championnat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=192 ;

--
-- Contenu de la table `classement`
--

INSERT INTO `classement` (`id`, `equipe`, `mj`, `g`, `n`, `p`, `bp`, `bc`, `db`, `pts`, `championnat_id`) VALUES
(176, 'Clichy S/bois', 2, 1, 0, 1, 16, 10, 6, 5, 3),
(177, 'FC GOUSSAINVILLE :', 2, 2, 0, 0, 11, 5, 6, 8, 3),
(178, 'OMJA 1', 2, 1, 0, 1, 12, 6, 6, 5, 3),
(179, 'OMJA 2', 2, 0, 0, 2, 5, 23, -18, 2, 3),
(186, 'JEUNESSE AULNAYSIENNE', 3, 0, 1, 2, 10, 22, -12, 4, 4),
(187, 'OMJA 2', 3, 3, 0, 0, 37, 8, 29, 12, 4),
(188, 'OMJA 1', 3, 0, 1, 2, 12, 32, -20, 4, 4),
(189, 'ILE SAINT DENIS', 2, 0, 1, 1, 9, 18, -9, 3, 4),
(190, 'FC GOUSSAINVILLE', 3, 1, 1, 1, 18, 20, -2, 7, 4),
(191, 'PARIS ACASA', 2, 2, 0, 0, 18, 4, 14, 8, 4);

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

CREATE TABLE IF NOT EXISTS `equipe` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `description_short` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `logo` varchar(255) NOT NULL,
  `championnat_id` int(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `championnat_id` (`championnat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `equipe`
--

INSERT INTO `equipe` (`id`, `name`, `description_short`, `description`, `logo`, `championnat_id`) VALUES
(11, 'JEUNESSE AULNAYSIENNE', '', '', '', 4),
(12, 'OMJA 2', '', '', '', 4),
(13, 'OMJA 1', '', '', '', 4),
(14, 'ILE SAINT DENIS', '', '', '', 4),
(15, 'FC GOUSSAINVILLE', '', '', '', 4),
(16, 'PARIS ACASA', '', '', '', 4),
(17, 'Clichy S/bois', '', '', '', 3),
(18, 'FC GOUSSAINVILLE :', '', '', '', 3),
(19, 'OMJA 1', '', '', '', 3),
(20, 'OMJA 2', '', '', '', 3);

-- --------------------------------------------------------

--
-- Structure de la table `match`
--

CREATE TABLE IF NOT EXISTS `match` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `championnat_id` int(3) unsigned NOT NULL,
  `equipe1` int(3) unsigned NOT NULL,
  `equipe2` int(3) unsigned NOT NULL,
  `journee` tinyint(2) unsigned NOT NULL,
  `date` date NOT NULL,
  `heure` time NOT NULL,
  `score1` tinyint(2) unsigned NOT NULL,
  `score2` tinyint(2) unsigned NOT NULL,
  `etat` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `championnat_id` (`championnat_id`),
  KEY `equipe1` (`equipe1`),
  KEY `equipe2` (`equipe2`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- Contenu de la table `match`
--

INSERT INTO `match` (`id`, `championnat_id`, `equipe1`, `equipe2`, `journee`, `date`, `heure`, `score1`, `score2`, `etat`) VALUES
(16, 4, 15, 11, 1, '2017-10-08', '09:00:00', 3, 3, 1),
(17, 4, 13, 16, 1, '2017-10-29', '08:00:00', 0, 13, 1),
(18, 4, 12, 14, 1, '2017-10-08', '10:00:00', 11, 2, 1),
(19, 4, 15, 12, 2, '2017-11-12', '09:00:00', 3, 12, 1),
(20, 4, 16, 11, 2, '2017-11-12', '10:00:00', 5, 4, 1),
(21, 4, 14, 13, 2, '2017-11-12', '08:00:00', 7, 7, 1),
(22, 4, 13, 15, 3, '2017-11-26', '08:00:00', 5, 12, 1),
(23, 4, 12, 11, 3, '2017-11-26', '09:00:00', 14, 3, 1),
(24, 4, 14, 16, 3, '2017-12-03', '10:00:00', 0, 0, 0),
(25, 4, 15, 14, 4, '2017-12-10', '09:00:00', 255, 255, 0),
(26, 4, 13, 11, 4, '2017-12-10', '08:00:00', 255, 255, 0),
(27, 4, 12, 16, 4, '2017-12-10', '10:00:00', 255, 255, 0),
(28, 4, 13, 12, 5, '2018-01-14', '08:00:00', 255, 255, 0),
(29, 4, 16, 15, 5, '2018-01-14', '09:00:00', 0, 0, 0),
(30, 4, 14, 11, 5, '2018-01-14', '10:00:00', 255, 255, 0),
(31, 4, 16, 13, 6, '2018-01-28', '08:00:00', 255, 255, 0),
(32, 4, 11, 15, 6, '2018-01-28', '09:00:00', 255, 255, 0),
(33, 4, 14, 12, 6, '2018-01-28', '10:00:00', 255, 255, 0),
(34, 4, 12, 15, 7, '2018-02-11', '09:00:00', 255, 255, 0),
(35, 4, 16, 11, 7, '2018-02-11', '10:00:00', 255, 255, 0),
(36, 4, 14, 13, 7, '2018-02-11', '08:00:00', 255, 255, 0),
(37, 4, 13, 15, 8, '2018-03-18', '08:00:00', 255, 255, 0),
(38, 4, 12, 11, 8, '2018-03-18', '10:00:00', 255, 255, 0),
(39, 4, 14, 16, 8, '2018-03-18', '09:00:00', 255, 255, 0),
(40, 4, 14, 15, 9, '2018-04-01', '09:00:00', 255, 255, 0),
(41, 4, 13, 11, 9, '2018-04-01', '08:00:00', 255, 255, 0),
(42, 4, 12, 16, 9, '2018-04-01', '10:00:00', 255, 255, 0),
(43, 4, 13, 12, 10, '2018-05-06', '08:00:00', 255, 255, 0),
(44, 4, 16, 15, 10, '2018-05-06', '09:00:00', 255, 255, 0),
(45, 4, 14, 11, 10, '2018-05-06', '10:00:00', 255, 255, 0),
(46, 3, 18, 17, 1, '2017-10-15', '10:00:00', 7, 2, 1),
(48, 3, 19, 18, 2, '2017-11-19', '08:00:00', 3, 4, 1),
(49, 3, 20, 17, 2, '2017-11-19', '10:00:00', 3, 14, 1),
(50, 3, 19, 17, 3, '2017-12-03', '08:00:00', 255, 255, 0),
(51, 3, 18, 20, 3, '2017-12-03', '10:00:00', 255, 255, 0),
(52, 3, 20, 19, 4, '2017-12-17', '08:00:00', 255, 255, 0),
(53, 3, 17, 18, 4, '2017-12-17', '10:00:00', 255, 255, 0),
(54, 3, 18, 19, 5, '2018-01-21', '08:00:00', 255, 255, 0),
(55, 3, 17, 20, 5, '2018-01-21', '10:00:00', 255, 255, 0),
(56, 3, 17, 19, 6, '2018-02-04', '08:00:00', 255, 255, 0),
(57, 3, 20, 18, 6, '2018-02-04', '10:00:00', 255, 255, 0),
(58, 3, 19, 20, 1, '2017-10-22', '08:00:00', 9, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `rebours`
--

CREATE TABLE IF NOT EXISTS `rebours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `final_date` datetime NOT NULL,
  `date_fr` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `rebours`
--

INSERT INTO `rebours` (`id`, `final_date`, `date_fr`) VALUES
(1, '2017-09-09 10:10:00', '09/09/17 10:10:00');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `classement`
--
ALTER TABLE `classement`
  ADD CONSTRAINT `classement_ibfk_1` FOREIGN KEY (`championnat_id`) REFERENCES `championnat` (`id`);

--
-- Contraintes pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD CONSTRAINT `equipe_ibfk_1` FOREIGN KEY (`championnat_id`) REFERENCES `championnat` (`id`);

--
-- Contraintes pour la table `match`
--
ALTER TABLE `match`
  ADD CONSTRAINT `match_ibfk_1` FOREIGN KEY (`championnat_id`) REFERENCES `championnat` (`id`),
  ADD CONSTRAINT `match_ibfk_2` FOREIGN KEY (`equipe1`) REFERENCES `equipe` (`id`),
  ADD CONSTRAINT `match_ibfk_3` FOREIGN KEY (`equipe2`) REFERENCES `equipe` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
