-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 25 oct. 2020 à 18:50
-- Version du serveur :  5.7.31
-- Version de PHP : 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_jntsoft`
--

-- --------------------------------------------------------

--
-- Structure de la table `agent`
--

DROP TABLE IF EXISTS `agent`;
CREATE TABLE IF NOT EXISTS `agent` (
  `id_agent` int(11) NOT NULL AUTO_INCREMENT,
  `nom_agent` varchar(100) NOT NULL,
  `postnom_agent` varchar(100) NOT NULL,
  `prenom_agent` varchar(100) NOT NULL,
  `sexe_agent` varchar(9) NOT NULL,
  `lieu_naissance` varchar(100) NOT NULL,
  `date_naissance` date NOT NULL,
  `photo` varchar(255) NOT NULL,
  `fonction_agent` varchar(100) NOT NULL,
  `entreprise_agent_id` int(11) NOT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `etat_carte` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_agent`),
  KEY `entreprise_agent_id` (`entreprise_agent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `agent`
--

INSERT INTO `agent` (`id_agent`, `nom_agent`, `postnom_agent`, `prenom_agent`, `sexe_agent`, `lieu_naissance`, `date_naissance`, `photo`, `fonction_agent`, `entreprise_agent_id`, `create_date`, `etat_carte`) VALUES
(1, 'TATI', 'TOTO', 'TUTO', 'Masculin', 'LUBUMBASHI', '2020-10-22', 'uploads/p2.png', 'Chef de Bureau', 1, '2020-10-24 21:00:46', 1),
(2, 'KAWEJ', 'MBAAZ', 'GIVEN', 'Masculin', 'Likasi', '1997-12-08', 'uploads/p3.png', 'INFORMATICIEN', 3, '2020-10-25 18:23:48', 1);

-- --------------------------------------------------------

--
-- Structure de la table `carte_agent`
--

DROP TABLE IF EXISTS `carte_agent`;
CREATE TABLE IF NOT EXISTS `carte_agent` (
  `id_carte` int(11) NOT NULL AUTO_INCREMENT,
  `code_unique` varchar(100) NOT NULL,
  `nbre_enfant` int(11) NOT NULL,
  `date_etablissement` date NOT NULL,
  `agent_id` int(11) NOT NULL,
  PRIMARY KEY (`id_carte`),
  KEY `agent_id` (`agent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `carte_agent`
--

INSERT INTO `carte_agent` (`id_carte`, `code_unique`, `nbre_enfant`, `date_etablissement`, `agent_id`) VALUES
(1, '106180', 3, '2020-10-25', 1),
(2, '88150', 1, '2020-10-25', 2);

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

DROP TABLE IF EXISTS `demande`;
CREATE TABLE IF NOT EXISTS `demande` (
  `id_demande` int(11) NOT NULL AUTO_INCREMENT,
  `nbre_travailleurs` int(11) NOT NULL,
  `date_demande` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `entreprise_id` int(11) NOT NULL,
  `demande_acceptee` tinyint(4) NOT NULL DEFAULT '0',
  `date_validation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_demande`),
  KEY `entreprise_id` (`entreprise_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `demande`
--

INSERT INTO `demande` (`id_demande`, `nbre_travailleurs`, `date_demande`, `entreprise_id`, `demande_acceptee`, `date_validation`) VALUES
(1, 20, '2020-10-24 13:50:54', 1, 1, '2020-10-24 14:53:10'),
(2, 30, '2020-10-25 17:28:28', 2, 0, '2020-10-25 17:28:28'),
(3, 15, '2020-10-25 18:09:55', 3, 1, '2020-10-25 18:16:45');

-- --------------------------------------------------------

--
-- Structure de la table `employeur`
--

DROP TABLE IF EXISTS `employeur`;
CREATE TABLE IF NOT EXISTS `employeur` (
  `id_employeur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_employeur` varchar(100) NOT NULL,
  `adresse_domicile` varchar(255) NOT NULL,
  `adress_email` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_employeur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `employeur`
--

INSERT INTO `employeur` (`id_employeur`, `nom_employeur`, `adresse_domicile`, `adress_email`, `date_created`) VALUES
(1, 'DAUDET', 'Kampemba', 'daudet@gmail.com', '2020-10-24 13:49:13'),
(2, 'TATU', 'LUBUMBASHI KAMPEMBA', 'tatu@gmail.com', '2020-10-25 17:27:31'),
(3, 'NTUMBA', 'QUARTIER INDUSTRIEL, C/KAMPEMBA', 'juniorntumbaj7@gmail.com', '2020-10-25 18:07:47');

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise` (
  `id_entreprise` int(11) NOT NULL AUTO_INCREMENT,
  `nom_entreprise` varchar(100) NOT NULL,
  `Rcc_entreprise` varchar(100) NOT NULL,
  `email_entreprise` varchar(255) NOT NULL,
  `adresse_domiciliere` varchar(255) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `employeur_id` int(11) NOT NULL,
  PRIMARY KEY (`id_entreprise`),
  KEY `employeur_id` (`employeur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id_entreprise`, `nom_entreprise`, `Rcc_entreprise`, `email_entreprise`, `adresse_domiciliere`, `date_creation`, `employeur_id`) VALUES
(1, 'DAUDET SARL', 'A2910AQ1QJ101', 'daudetsarl@daudetsarl.com', 'KAMPEMBA', '2020-10-24 13:50:20', 1),
(2, 'TATU SARL', 'A12912A1', 'tatusarl@tatusarl.com', 'KAMPEMBA', '2020-10-25 17:28:18', 2),
(3, 'RUASHI-MINING', '98765433', 'juniorntumbaj7@gmail.com', 'ENTRE DE LA VILLE LUBUMBASHI', '2020-10-25 18:09:39', 3);

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `id_facture` int(11) NOT NULL AUTO_INCREMENT,
  `type_fac` varchar(100) NOT NULL,
  `prix_unit` int(11) NOT NULL,
  `nbres` int(11) NOT NULL,
  `entreprise_fac_id` int(11) NOT NULL,
  `create_dates` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_facture`),
  KEY `entreprise_fac_id` (`entreprise_fac_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`id_facture`, `type_fac`, `prix_unit`, `nbres`, `entreprise_fac_id`, `create_dates`) VALUES
(1, 'Mensuelle', 2, 20, 1, '2020-10-25 14:59:02'),
(2, 'Mensuelle', 10000, 1, 3, '2020-10-25 18:43:21');

-- --------------------------------------------------------

--
-- Structure de la table `frais`
--

DROP TABLE IF EXISTS `frais`;
CREATE TABLE IF NOT EXISTS `frais` (
  `id_frais` int(11) NOT NULL AUTO_INCREMENT,
  `type_frais` varchar(100) NOT NULL,
  `prix_unitaire` int(11) NOT NULL,
  `demande_val_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_frais`),
  KEY `demande_val_id` (`demande_val_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `frais`
--

INSERT INTO `frais` (`id_frais`, `type_frais`, `prix_unitaire`, `demande_val_id`, `created_at`) VALUES
(1, 'Abonnement', 2, 1, '2020-10-25 12:45:38'),
(2, 'FRAIS D\'ABONNEMENT', 2000, 3, '2020-10-25 18:41:39');

-- --------------------------------------------------------

--
-- Structure de la table `protocole_accord`
--

DROP TABLE IF EXISTS `protocole_accord`;
CREATE TABLE IF NOT EXISTS `protocole_accord` (
  `id_protocole` int(11) NOT NULL AUTO_INCREMENT,
  `description_protocole` varchar(255) NOT NULL,
  `demande_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_protocole`),
  KEY `demande_id` (`demande_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `protocole_accord`
--

INSERT INTO `protocole_accord` (`id_protocole`, `description_protocole`, `demande_id`, `date_created`) VALUES
(1, 'JUNIOR NTUMBA', 1, '2020-10-25 02:12:02'),
(2, 'JUNIOR NTUMBA', 3, '2020-10-25 18:39:41');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roles` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `roles`) VALUES
(1, 'Comptable'),
(2, 'Chef Administratif'),
(3, 'Receptinniste'),
(4, 'Gestionnaire');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `postnom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `sexe` varchar(20) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `login_user` varchar(255) NOT NULL,
  `motdepasse` varchar(255) NOT NULL,
  `type_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type_utilisateur` (`type_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `postnom`, `prenom`, `sexe`, `telephone`, `login_user`, `motdepasse`, `type_utilisateur`) VALUES
(1, 'NTUMBA', 'TSHINANGA', 'JUNIOR', 'Masculin', '09291', 'JNTSOFT', '11111', 2),
(2, 'JUNIOR', 'JUNIOR', 'JUNIOR', 'Masculin', '09281', 'JUNIOR', '1112', 4),
(3, 'DAUDET', 'DAUDET', 'DAUDET', 'Masculin', '09192', 'DAUDET', '1113', 1),
(4, 'DADIE', 'DADIE', 'DADIE', 'Masculin', '92101', 'DADIE', '1114', 3);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `agent`
--
ALTER TABLE `agent`
  ADD CONSTRAINT `agent_ibfk_1` FOREIGN KEY (`entreprise_agent_id`) REFERENCES `entreprise` (`id_entreprise`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `carte_agent`
--
ALTER TABLE `carte_agent`
  ADD CONSTRAINT `carte_agent_ibfk_1` FOREIGN KEY (`agent_id`) REFERENCES `agent` (`id_agent`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `demande`
--
ALTER TABLE `demande`
  ADD CONSTRAINT `demande_ibfk_1` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`id_entreprise`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD CONSTRAINT `entreprise_ibfk_1` FOREIGN KEY (`employeur_id`) REFERENCES `employeur` (`id_employeur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `facture_ibfk_1` FOREIGN KEY (`entreprise_fac_id`) REFERENCES `entreprise` (`id_entreprise`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `frais`
--
ALTER TABLE `frais`
  ADD CONSTRAINT `frais_ibfk_1` FOREIGN KEY (`demande_val_id`) REFERENCES `demande` (`id_demande`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `protocole_accord`
--
ALTER TABLE `protocole_accord`
  ADD CONSTRAINT `protocole_accord_ibfk_1` FOREIGN KEY (`demande_id`) REFERENCES `demande` (`id_demande`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`type_utilisateur`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
