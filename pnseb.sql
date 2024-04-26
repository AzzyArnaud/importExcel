-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 21 jan. 2024 à 12:47
-- Version du serveur :  10.1.31-MariaDB
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
-- Base de données :  `pnseb`
--

-- --------------------------------------------------------

--
-- Structure de la table `config_droits`
--

CREATE TABLE `config_droits` (
  `ID_DROIT` int(11) NOT NULL,
  `DESCRIPTION` varchar(200) NOT NULL,
  `ID_SOCIETE` int(11) NOT NULL,
  `ENVOIE` int(11) NOT NULL DEFAULT '0',
  `DATE_TIME` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `config_droits`
--

INSERT INTO `config_droits` (`ID_DROIT`, `DESCRIPTION`, `ID_SOCIETE`, `ENVOIE`, `DATE_TIME`) VALUES
(1, 'Profil & Droit', 0, 1, '2023-02-01 19:55:44'),
(2, 'Utilisateurs', 0, 1, '2023-02-01 19:55:44'),
(3, 'Rapports', 0, 1, '2023-02-01 19:55:44'),
(4, 'Ventes', 0, 1, '2023-02-01 19:55:44'),
(5, 'Generation Bar Code', 0, 1, '2023-02-01 19:55:44'),
(6, 'Promotion', 0, 1, '2023-02-01 19:55:44'),
(7, 'Assurance', 0, 1, '2023-02-01 19:55:44'),
(8, 'Client', 0, 1, '2023-02-01 19:55:44'),
(9, 'Societés', 1, 1, '2023-02-04 18:16:00'),
(10, 'Fournisseur', 0, 1, '2023-02-01 19:55:44'),
(11, 'Type Remise', 0, 1, '2023-02-01 19:55:44'),
(12, 'Produit', 0, 1, '2023-02-01 19:55:44'),
(13, 'Requisition', 0, 1, '2023-02-01 19:55:44'),
(14, 'Vente', 0, 1, '2023-02-01 19:55:44'),
(15, 'Rapport', 0, 1, '2023-02-01 19:55:44'),
(16, '-', 0, 1, '2023-02-01 19:55:44');

-- --------------------------------------------------------

--
-- Structure de la table `config_profil`
--

CREATE TABLE `config_profil` (
  `PROFIL_ID` int(11) NOT NULL,
  `DESCRIPTION` varchar(100) NOT NULL,
  `ID_SOCIETE` int(11) NOT NULL,
  `ENVOIE` int(11) NOT NULL DEFAULT '0',
  `DATE_TIME` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `config_profil`
--

INSERT INTO `config_profil` (`PROFIL_ID`, `DESCRIPTION`, `ID_SOCIETE`, `ENVOIE`, `DATE_TIME`) VALUES
(1, 'Administrateur', 0, 1, '2023-02-01 19:56:42'),
(2, 'pharmacien', 1, 1, '2023-02-01 19:56:42'),
(3, 'Agent de Réquisition', 1, 1, '2023-02-04 17:48:29');

-- --------------------------------------------------------

--
-- Structure de la table `config_profil_droit`
--

CREATE TABLE `config_profil_droit` (
  `ID_DROIT_USER` int(11) NOT NULL,
  `PROFIL_ID` tinyint(4) NOT NULL,
  `ID_DROIT` tinyint(4) NOT NULL,
  `ENVOIE` int(11) NOT NULL DEFAULT '0',
  `DATE_TIME` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `config_profil_droit`
--

INSERT INTO `config_profil_droit` (`ID_DROIT_USER`, `PROFIL_ID`, `ID_DROIT`, `ENVOIE`, `DATE_TIME`) VALUES
(1, 1, 1, 1, '2023-02-01 19:57:08'),
(2, 1, 2, 1, '2023-02-01 19:57:08'),
(3, 1, 3, 1, '2023-02-01 19:57:08'),
(4, 1, 4, 1, '2023-02-01 19:57:08'),
(5, 1, 5, 1, '2023-02-01 19:57:08'),
(6, 1, 6, 1, '2023-02-01 19:57:08'),
(7, 1, 7, 1, '2023-02-01 19:57:08'),
(8, 1, 8, 1, '2023-02-01 19:57:08'),
(9, 1, 9, 1, '2023-02-01 19:57:08'),
(10, 1, 10, 1, '2023-02-01 19:57:08'),
(11, 1, 11, 1, '2023-02-01 19:57:08'),
(12, 1, 12, 1, '2023-02-01 19:57:08'),
(13, 1, 13, 1, '2023-02-01 19:57:08'),
(14, 1, 14, 1, '2023-02-01 19:57:08'),
(15, 1, 15, 1, '2023-02-01 19:57:08'),
(16, 1, 16, 1, '2023-02-01 19:57:08'),
(24, 3, 7, 1, '2023-02-04 18:10:01'),
(25, 3, 10, 1, '2023-02-04 18:10:01'),
(26, 3, 5, 1, '2023-02-04 18:10:01'),
(27, 3, 12, 1, '2023-02-04 18:10:01'),
(28, 3, 13, 1, '2023-02-04 18:10:01'),
(29, 2, 16, 1, '2023-02-04 18:20:30'),
(30, 2, 7, 1, '2023-02-04 18:20:30'),
(31, 2, 8, 1, '2023-02-04 18:20:30'),
(32, 2, 10, 1, '2023-02-04 18:20:30'),
(33, 2, 5, 1, '2023-02-04 18:20:30'),
(34, 2, 12, 1, '2023-02-04 18:20:31'),
(35, 2, 6, 1, '2023-02-04 18:20:31'),
(36, 2, 15, 1, '2023-02-04 18:20:31'),
(37, 2, 13, 1, '2023-02-04 18:20:31'),
(38, 2, 9, 1, '2023-02-04 18:20:31'),
(39, 2, 14, 1, '2023-02-04 18:20:31'),
(40, 2, 4, 1, '2023-02-04 18:20:31');

-- --------------------------------------------------------

--
-- Structure de la table `config_societe`
--

CREATE TABLE `config_societe` (
  `ID_SOCIETE` int(11) NOT NULL,
  `SOCIETE` varchar(50) NOT NULL,
  `ENVOIE` int(11) NOT NULL DEFAULT '0',
  `STATUS` int(11) NOT NULL DEFAULT '1',
  `DATE_TIME` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `config_societe`
--

INSERT INTO `config_societe` (`ID_SOCIETE`, `SOCIETE`, `ENVOIE`, `STATUS`, `DATE_TIME`) VALUES
(1, 'Pharmacie st Raphael', 1, 1, '2023-02-01 19:57:25'),
(2, 'Rapporteur phar', 1, 1, '2023-02-23 18:24:27'),
(3, 'Niwigyimana Isaac', 1, 1, '2023-02-23 18:25:21'),
(4, 'NYAMBERE Tharcisse', 1, 1, '2023-03-03 07:45:56'),
(5, 'ATLANTIS Malt', 1, 1, '2023-03-03 16:52:16');

-- --------------------------------------------------------

--
-- Structure de la table `config_user`
--

CREATE TABLE `config_user` (
  `ID_USER` int(11) NOT NULL,
  `NOM` varchar(30) NOT NULL,
  `PRENOM` varchar(30) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` text NOT NULL,
  `PROFIL_ID` int(11) NOT NULL DEFAULT '0',
  `ID_EMPLOYE` int(11) DEFAULT '0',
  `STATUS` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 si actif et 0 si pas actif',
  `ID_SOCIETE` int(11) NOT NULL,
  `ENVOIE` int(11) NOT NULL DEFAULT '0',
  `DATE_TIME` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `config_user`
--

INSERT INTO `config_user` (`ID_USER`, `NOM`, `PRENOM`, `USERNAME`, `PASSWORD`, `PROFIL_ID`, `ID_EMPLOYE`, `STATUS`, `ID_SOCIETE`, `ENVOIE`, `DATE_TIME`) VALUES
(1, 'Admin', 'St Raphael', 'admin@straphael.bi', '827ccb0eea8a706c4c34a16891f84e7b', 1, 0, 1, 1, 1, '2023-02-01 19:58:14'),
(2, 'IRADUKUNDA', 'ESTELLA', 'estella', '493799289ead2e0fcfc21ceef9d569eb', 1, 0, 1, 1, 1, '2023-02-01 19:58:14'),
(3, 'NSHIMIRIMANA', 'Gaudence', 'Gaudence', 'cf79ae6addba60ad018347359bd144d2', 1, 0, 1, 1, 1, '2023-02-01 19:58:14'),
(4, 'HATEGEKIMANA', 'Manasse', 'Manasse', '392b3c57ed84f1215868c2587736a9b0', 2, 0, 1, 1, 1, '2023-02-01 19:58:14'),
(5, 'manirambona', 'fabrice', 'fab', 'c20ad4d76fe97759aa27a0c99bff6710', 1, 0, 1, 1, 1, '2023-02-01 19:58:14'),
(6, 'NDAYIKENGURUKIYE', 'Jeanne', 'jeanne', 'ea6b2efbdd4255a9f1b3bbc6399b58f4', 2, 0, 1, 1, 1, '2023-02-01 19:58:14'),
(7, 'AHISHAKIYE ', 'Nadia', 'nadia', '40b61d94e9959df5f32eca7ef0e89b36', 2, 0, 1, 1, 1, '2023-02-01 19:58:14'),
(8, 'NZISABIRA', 'Alexis', 'alex', '73c5252192bf3b5b890e0a702765c45f', 2, 0, 1, 1, 1, '2023-02-01 19:58:14'),
(9, 'hakizimana ', 'sarah', 'sarah', '33097f12513de2fe96922a4b3bcd26db', 2, 0, 1, 1, 1, '2023-02-01 19:58:14'),
(10, 'IRANKEJE', 'ARSENE', 'arsene', '54fda78aa8a09b4d77b5aaec57b75028', 3, 0, 1, 1, 1, '2023-02-01 19:58:14'),
(11, 'KORISHIMWE ', 'Nicaise', 'nicaise', '00875e3e197ce7b04a79233eb58fd7db', 1, 0, 1, 1, 1, '2023-02-01 19:58:14'),
(12, 'Nzisabira', 'Alexis', 'alexnzisa@straphael.bi', '73c5252192bf3b5b890e0a702765c45f', 2, 0, 0, 1, 1, '2023-02-01 19:58:14'),
(13, 'Niyonkuru', 'Isaac', 'Isaac', 'ba930eb16f21759853a7428073b80561', 2, 0, 1, 1, 1, '2023-02-01 19:58:14'),
(14, 'uwimbabazi ', 'Consolée', 'coco', 'c6df4090abf26d85eb053720a8e7bf01', 2, 0, 1, 1, 1, '2023-02-01 19:58:14'),
(15, 'Antonio', 'Zivieri', 'antonio', '827ccb0eea8a706c4c34a16891f84e7b', 1, 0, 1, 1, 1, '2023-02-11 11:04:20');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `config_droits`
--
ALTER TABLE `config_droits`
  ADD PRIMARY KEY (`ID_DROIT`);

--
-- Index pour la table `config_profil`
--
ALTER TABLE `config_profil`
  ADD PRIMARY KEY (`PROFIL_ID`);

--
-- Index pour la table `config_profil_droit`
--
ALTER TABLE `config_profil_droit`
  ADD PRIMARY KEY (`ID_DROIT_USER`);

--
-- Index pour la table `config_societe`
--
ALTER TABLE `config_societe`
  ADD PRIMARY KEY (`ID_SOCIETE`);

--
-- Index pour la table `config_user`
--
ALTER TABLE `config_user`
  ADD PRIMARY KEY (`ID_USER`),
  ADD KEY `PROFIL_ID` (`PROFIL_ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `config_droits`
--
ALTER TABLE `config_droits`
  MODIFY `ID_DROIT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `config_profil`
--
ALTER TABLE `config_profil`
  MODIFY `PROFIL_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `config_profil_droit`
--
ALTER TABLE `config_profil_droit`
  MODIFY `ID_DROIT_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `config_societe`
--
ALTER TABLE `config_societe`
  MODIFY `ID_SOCIETE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `config_user`
--
ALTER TABLE `config_user`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
