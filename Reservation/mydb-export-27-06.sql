-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 27 juin 2019 à 14:13
-- Version du serveur :  5.7.24
-- Version de PHP :  7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mydb`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `login` varchar(10) NOT NULL,
  `mdp` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`login`, `mdp`) VALUES
('Admin', '308a32728fbb980c34e5b4a9386db376265ba7167417ccc0dee0a7cdc4de5a30');

-- --------------------------------------------------------

--
-- Structure de la table `chambres`
--

DROP TABLE IF EXISTS `chambres`;
CREATE TABLE IF NOT EXISTS `chambres` (
  `id_chambre` int(11) NOT NULL AUTO_INCREMENT,
  `nb_places` smallint(20) NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  `disponible` tinyint(1) NOT NULL,
  `id_client` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_chambre`),
  KEY `fk_Chambres_Clients_idx` (`id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chambres`
--

INSERT INTO `chambres` (`id_chambre`, `nb_places`, `prix`, `disponible`, `id_client`) VALUES
(1, 4, '112', 0, 3),
(2, 5, '230', 0, 3),
(3, 4, '112', 1, NULL),
(4, 4, '112', 1, NULL),
(5, 8, '666', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(60) NOT NULL,
  `Prenom` varchar(45) NOT NULL,
  `Adresse` varchar(150) NOT NULL,
  `Numéro` varchar(30) DEFAULT NULL,
  `confirmer` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id_client`, `Nom`, `Prenom`, `Adresse`, `Numéro`, `confirmer`) VALUES
(3, 'Terminator', 'Arnold', 'Hell', '666', NULL),
(6, 'Jonathan', 'Issou', 'Avenue de l\'étoile 42', '04444444444', NULL),
(7, 'Man', 'Super', 'Avenue de l\'étoile 42', '04444444444', NULL),
(8, 'Lama', 'Dalai', 'Avenue Hubert 12', '0462327781', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `txt_en`
--

DROP TABLE IF EXISTS `txt_en`;
CREATE TABLE IF NOT EXISTS `txt_en` (
  `id_texte` int(11) NOT NULL AUTO_INCREMENT,
  `texte` text,
  PRIMARY KEY (`id_texte`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `txt_en`
--

INSERT INTO `txt_en` (`id_texte`, `texte`) VALUES
(1, 'texte en 1'),
(2, 'texte en 2'),
(3, 'texte en 3');

-- --------------------------------------------------------

--
-- Structure de la table `txt_es`
--

DROP TABLE IF EXISTS `txt_es`;
CREATE TABLE IF NOT EXISTS `txt_es` (
  `id_texte` int(11) NOT NULL AUTO_INCREMENT,
  `texte` text,
  PRIMARY KEY (`id_texte`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `txt_es`
--

INSERT INTO `txt_es` (`id_texte`, `texte`) VALUES
(1, 'texte es 1'),
(2, 'texte es 2'),
(3, 'ay lmao 3');

-- --------------------------------------------------------

--
-- Structure de la table `txt_fr`
--

DROP TABLE IF EXISTS `txt_fr`;
CREATE TABLE IF NOT EXISTS `txt_fr` (
  `id_texte` int(11) NOT NULL AUTO_INCREMENT,
  `texte` text,
  PRIMARY KEY (`id_texte`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `txt_fr`
--

INSERT INTO `txt_fr` (`id_texte`, `texte`) VALUES
(1, 'texte fr 1'),
(2, 'texte fr 2'),
(3, 'texte fr 3');

-- --------------------------------------------------------

--
-- Structure de la table `txt_nl`
--

DROP TABLE IF EXISTS `txt_nl`;
CREATE TABLE IF NOT EXISTS `txt_nl` (
  `id_texte` int(11) NOT NULL AUTO_INCREMENT,
  `texte` text,
  PRIMARY KEY (`id_texte`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `txt_nl`
--

INSERT INTO `txt_nl` (`id_texte`, `texte`) VALUES
(1, 'texte nl 1'),
(2, 'texte nl 2'),
(3, 'texte nl 3');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chambres`
--
ALTER TABLE `chambres`
  ADD CONSTRAINT `fk_Chambres_Clients` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id_client`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
