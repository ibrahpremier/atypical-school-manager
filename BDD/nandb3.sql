-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 17 avr. 2018 à 08:42
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `nandb3`
--

-- --------------------------------------------------------

--
-- Structure de la table `appartenir_equipe`
--

DROP TABLE IF EXISTS `appartenir_equipe`;
CREATE TABLE IF NOT EXISTS `appartenir_equipe` (
  `id_app_equipe` int(5) NOT NULL AUTO_INCREMENT,
  `id_etudiant` int(5) NOT NULL,
  `id_equipe` int(5) NOT NULL,
  `date_ajout_equipe` date NOT NULL,
  `commentaire` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id_app_equipe`),
  KEY `id_Etudiant` (`id_etudiant`,`id_equipe`),
  KEY `id_Equipe` (`id_equipe`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `appartenir_equipe`
--

INSERT INTO `appartenir_equipe` (`id_app_equipe`, `id_etudiant`, `id_equipe`, `date_ajout_equipe`, `commentaire`) VALUES
(1, 2, 1, '2018-04-10', NULL),
(2, 3, 1, '2018-04-10', NULL),
(3, 4, 2, '2018-04-10', NULL),
(6, 7, 2, '2018-03-01', NULL),
(8, 5, 2, '2018-04-11', 'Revenu de son voyage Ã  l\'Ã©tranger'),
(11, 7, 10, '2018-04-11', ''),
(12, 5, 10, '2018-02-15', 'voyage hors du pays'),
(13, 1, 10, '2018-04-11', 'indisponibilitÃ© pour continuer la formation'),
(14, 1, 2, '2018-02-10', ''),
(15, 2, 1, '2018-04-12', 'Depart en voyage'),
(16, 6, 10, '2018-04-13', ''),
(18, 7, 2, '2018-04-15', ''),
(19, 4, 1, '2018-04-16', ''),
(20, 2, 2, '2018-04-16', '');

-- --------------------------------------------------------

--
-- Structure de la table `appartenir_groupe`
--

DROP TABLE IF EXISTS `appartenir_groupe`;
CREATE TABLE IF NOT EXISTS `appartenir_groupe` (
  `id_app_groupe` int(5) NOT NULL AUTO_INCREMENT,
  `id_etudiant` int(5) NOT NULL,
  `id_groupe` int(5) NOT NULL,
  `porte_parole` int(11) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  PRIMARY KEY (`id_app_groupe`),
  KEY `id_Etudiant` (`id_etudiant`,`id_groupe`),
  KEY `id_Groupe` (`id_groupe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `archive`
--

DROP TABLE IF EXISTS `archive`;
CREATE TABLE IF NOT EXISTS `archive` (
  `id_archive` int(5) NOT NULL AUTO_INCREMENT,
  `id_etudiant` int(5) NOT NULL,
  `date_archive` date NOT NULL,
  `motif_archive` text NOT NULL,
  PRIMARY KEY (`id_archive`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `composition`
--

DROP TABLE IF EXISTS `composition`;
CREATE TABLE IF NOT EXISTS `composition` (
  `id_composition` int(5) NOT NULL AUTO_INCREMENT,
  `libelle_composition` varchar(255) NOT NULL,
  `date_composition` date NOT NULL,
  `nbr_question` int(11) DEFAULT NULL,
  `quota` int(11) DEFAULT NULL,
  `sujet_composition` text,
  `id_type_composition` int(5) NOT NULL,
  PRIMARY KEY (`id_composition`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `composition`
--

INSERT INTO `composition` (`id_composition`, `libelle_composition`, `date_composition`, `nbr_question`, `quota`, `sujet_composition`, `id_type_composition`) VALUES
(1, 'QUIZ #3 WEB', '2018-04-21', 10, 70, '', 1),
(2, 'PROJET WEB1', '2018-04-21', 0, 0, '', 2),
(3, 'PROJET WEB', '2018-04-13', 0, 0, '', 2),
(4, 'LINUX', '2018-04-14', 30, 80, '', 1),
(5, 'MACOS HIGHT SIEERA', '2018-04-14', 50, 70, '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

DROP TABLE IF EXISTS `equipe`;
CREATE TABLE IF NOT EXISTS `equipe` (
  `id_equipe` int(5) NOT NULL AUTO_INCREMENT,
  `nom_equipe` varchar(100) NOT NULL,
  `date_creation_equipe` date NOT NULL,
  PRIMARY KEY (`id_equipe`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `equipe`
--

INSERT INTO `equipe` (`id_equipe`, `nom_equipe`, `date_creation_equipe`) VALUES
(1, 'Equipe A', '2018-04-02'),
(2, 'Equipe Z', '2018-04-02'),
(10, 'Archive', '2018-04-01');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `id_etudiant` int(5) NOT NULL AUTO_INCREMENT,
  `id_machine` varchar(10) DEFAULT NULL,
  `nom` varchar(70) DEFAULT NULL,
  `prenom` varchar(150) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `photo` varchar(150) DEFAULT NULL,
  `activite` varchar(100) DEFAULT NULL,
  `id_localite` int(5) NOT NULL,
  `id_sexe` int(5) NOT NULL,
  `bonus` int(11) NOT NULL DEFAULT '0',
  `liked` int(11) NOT NULL DEFAULT '0',
  `commentaire` text,
  `statut` int(11) DEFAULT NULL,
  `equipe_actu` int(2) DEFAULT NULL,
  `date_inscription` date DEFAULT NULL,
  PRIMARY KEY (`id_etudiant`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id_etudiant`, `id_machine`, `nom`, `prenom`, `date_naissance`, `email`, `telephone`, `photo`, `activite`, `id_localite`, `id_sexe`, `bonus`, `liked`, `commentaire`, `statut`, `equipe_actu`, `date_inscription`) VALUES
(1, NULL, 'kone', 'hamed', '2018-04-09', 'azer@hgjk.com', '', 'zertyu/fghjk/fghj.jpg', 'etudiant', 17, 1, 1, 0, NULL, 1, 2, '2018-04-10'),
(2, NULL, 'dozo', 'israela', NULL, 'azerty@ert.com', '77885544', NULL, NULL, 4, 2, 0, -1, NULL, 1, 2, '2018-04-10'),
(3, NULL, 'Ouattara', 'alassane', NULL, 'azerty@ert.com', '77885544', NULL, NULL, 17, 1, 0, 0, NULL, 1, 1, '2018-04-10'),
(4, NULL, 'fofana', 'lacine', NULL, 'azerty@ert.com', '77885544', NULL, NULL, 2, 1, 0, -1, NULL, 1, 1, '2018-04-10'),
(5, NULL, 'coulibaly', 'moise', NULL, 'zerty@kjhg.com', '77885544', NULL, NULL, 17, 1, 5, 1, NULL, 1, 2, '2018-04-10'),
(6, NULL, 'azer', 'tyffanie', NULL, 'zerty@kjhg.com', '77885544', NULL, NULL, 17, 2, 7, 1, NULL, 1, 10, '2018-04-10'),
(7, NULL, 'Karamoko', 'Aziz', NULL, 'zerty@kjhg.com', '77885544', NULL, NULL, 2, 1, -1, -1, NULL, 1, 2, '2018-04-10');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `id_groupe` int(5) NOT NULL AUTO_INCREMENT,
  `nom_goupe` varchar(100) NOT NULL,
  `date_creation_groupe` date NOT NULL,
  `id_porte_parole` int(5) NOT NULL,
  PRIMARY KEY (`id_groupe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `localite`
--

DROP TABLE IF EXISTS `localite`;
CREATE TABLE IF NOT EXISTS `localite` (
  `id_localite` int(5) NOT NULL AUTO_INCREMENT,
  `libelle_localite` varchar(150) NOT NULL,
  PRIMARY KEY (`id_localite`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `localite`
--

INSERT INTO `localite` (`id_localite`, `libelle_localite`) VALUES
(2, 'bingerville'),
(4, 'cocody'),
(17, 'koumassi'),
(23, 'yopougon'),
(25, 'abobo'),
(26, 'angre');

-- --------------------------------------------------------

--
-- Structure de la table `noter_composition`
--

DROP TABLE IF EXISTS `noter_composition`;
CREATE TABLE IF NOT EXISTS `noter_composition` (
  `id_noter_composition` int(5) NOT NULL AUTO_INCREMENT,
  `id_etudiant` int(11) NOT NULL,
  `id_composition` int(11) NOT NULL,
  `note` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_noter_composition`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `noter_composition`
--

INSERT INTO `noter_composition` (`id_noter_composition`, `id_etudiant`, `id_composition`, `note`) VALUES
(17, 4, 1, 65),
(18, 4, 4, 82),
(19, 4, 2, 95),
(20, 4, 3, 75),
(21, 5, 2, 80),
(22, 7, 2, 50),
(23, 5, 3, 88),
(24, 7, 3, 61),
(25, 1, 3, 74),
(26, 5, 5, 100),
(27, 4, 5, 85),
(28, 7, 5, 69),
(29, 1, 5, 58),
(30, 1, 2, 80),
(31, 5, 4, 58),
(32, 7, 4, 70),
(33, 1, 4, 96),
(34, 5, 1, 45),
(35, 2, 1, 85),
(36, 7, 1, 96),
(37, 1, 1, 36),
(38, 2, 3, 50),
(39, 2, 2, 30),
(40, 2, 4, 58),
(41, 2, 5, 45);

-- --------------------------------------------------------

--
-- Structure de la table `noter_projet_groupe`
--

DROP TABLE IF EXISTS `noter_projet_groupe`;
CREATE TABLE IF NOT EXISTS `noter_projet_groupe` (
  `id_noter_groupe` int(5) NOT NULL AUTO_INCREMENT,
  `id_groupe` int(5) NOT NULL,
  `id_projet_groupe` int(5) NOT NULL,
  `note` int(11) NOT NULL,
  PRIMARY KEY (`id_noter_groupe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `presence`
--

DROP TABLE IF EXISTS `presence`;
CREATE TABLE IF NOT EXISTS `presence` (
  `id_presence` int(5) NOT NULL AUTO_INCREMENT,
  `type_presence` varchar(10) NOT NULL,
  `date_presence` date NOT NULL,
  `id_etudiant` int(5) NOT NULL,
  `commentaire` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_presence`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `presence`
--

INSERT INTO `presence` (`id_presence`, `type_presence`, `date_presence`, `id_etudiant`, `commentaire`) VALUES
(38, 'present', '2018-04-12', 5, NULL),
(39, 'present', '2018-04-12', 7, NULL),
(40, 'absent', '2018-04-12', 1, NULL),
(41, 'absent', '2018-04-12', 4, NULL),
(42, 'present', '2018-04-13', 4, NULL),
(43, 'present', '2018-04-13', 7, NULL),
(44, 'present', '2018-04-13', 1, NULL),
(45, 'present', '2018-04-13', 5, NULL),
(46, 'present', '2018-04-15', 7, NULL),
(47, 'present', '2018-04-15', 4, NULL),
(48, 'present', '2018-04-15', 5, NULL),
(49, 'absent', '2018-04-15', 1, NULL),
(58, 'present', '2018-04-16', 5, NULL),
(59, 'present', '2018-04-16', 2, NULL),
(60, 'present', '2018-04-17', 5, NULL),
(61, 'present', '2018-04-17', 7, NULL),
(62, 'present', '2018-04-17', 1, NULL),
(63, 'present', '2018-04-17', 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `projet_groupe`
--

DROP TABLE IF EXISTS `projet_groupe`;
CREATE TABLE IF NOT EXISTS `projet_groupe` (
  `id_projet_groupe` int(5) NOT NULL AUTO_INCREMENT,
  `libelle_projet_groupe` text NOT NULL,
  `Date_creation_groupe` date NOT NULL,
  PRIMARY KEY (`id_projet_groupe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sexe`
--

DROP TABLE IF EXISTS `sexe`;
CREATE TABLE IF NOT EXISTS `sexe` (
  `id_sexe` int(5) NOT NULL AUTO_INCREMENT,
  `libelle_sexe` varchar(40) NOT NULL,
  PRIMARY KEY (`id_sexe`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sexe`
--

INSERT INTO `sexe` (`id_sexe`, `libelle_sexe`) VALUES
(1, 'homme'),
(2, 'femme');

-- --------------------------------------------------------

--
-- Structure de la table `type_composition`
--

DROP TABLE IF EXISTS `type_composition`;
CREATE TABLE IF NOT EXISTS `type_composition` (
  `id_type_composition` int(5) NOT NULL AUTO_INCREMENT,
  `libelle_type_composition` varchar(150) NOT NULL,
  PRIMARY KEY (`id_type_composition`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type_composition`
--

INSERT INTO `type_composition` (`id_type_composition`, `libelle_type_composition`) VALUES
(1, 'quiz'),
(2, 'projet personnel'),
(3, 'projet de groupe');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(5) NOT NULL AUTO_INCREMENT,
  `nom_user` varchar(15) NOT NULL,
  `prenom_user` varchar(30) NOT NULL,
  `email_user` varchar(100) NOT NULL,
  `privilege` int(2) NOT NULL,
  `photo_user` varchar(100) NOT NULL,
  `date_creation` date NOT NULL,
  `passw` varchar(100) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `nom_user`, `prenom_user`, `email_user`, `privilege`, `photo_user`, `date_creation`, `passw`) VALUES
(1, 'leny', 'borja', 'azerty@gmail.com', 1, 'image.jpg', '2018-04-01', 'user');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appartenir_equipe`
--
ALTER TABLE `appartenir_equipe`
  ADD CONSTRAINT `appartenir_equipe_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`),
  ADD CONSTRAINT `appartenir_equipe_ibfk_2` FOREIGN KEY (`id_equipe`) REFERENCES `equipe` (`id_equipe`);

--
-- Contraintes pour la table `appartenir_groupe`
--
ALTER TABLE `appartenir_groupe`
  ADD CONSTRAINT `appartenir_groupe_ibfk_1` FOREIGN KEY (`id_groupe`) REFERENCES `groupe` (`id_groupe`),
  ADD CONSTRAINT `appartenir_groupe_ibfk_2` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
