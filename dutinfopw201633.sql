-- phpMyAdmin SQL Dump
-- version 5.2.1deb1+focal2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 23 jan. 2025 à 23:21
-- Version du serveur : 8.0.40-0ubuntu0.20.04.1
-- Version de PHP : 7.4.3-4ubuntu2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dutinfopw201633`
--

-- --------------------------------------------------------

--
-- Structure de la table `Depot`
--

CREATE TABLE `Depot` (
  `idDepot` int NOT NULL,
  `descriptif` varchar(50) NOT NULL,
  `dateAttendu` date NOT NULL,
  `idProjet` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Enseignant`
--

CREATE TABLE `Enseignant` (
  `idEns` int NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Enseignant`
--

INSERT INTO `Enseignant` (`idEns`, `nom`, `prenom`, `email`) VALUES
(1, 'el fayez', 'malika', 'brahimelfayez@yahoo.fr');

-- --------------------------------------------------------

--
-- Structure de la table `estAssigneComme`
--

CREATE TABLE `estAssigneComme` (
  `idEns` int NOT NULL,
  `idProjet` int NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `estDansCeProjet`
--

CREATE TABLE `estDansCeProjet` (
  `idProjet` int NOT NULL,
  `idGroupe` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `estDansLeGroupe`
--

CREATE TABLE `estDansLeGroupe` (
  `idGroupe` int NOT NULL,
  `idEtud` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `estEvaluePar`
--

CREATE TABLE `estEvaluePar` (
  `idEval` int NOT NULL,
  `idEns` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `estJury`
--

CREATE TABLE `estJury` (
  `idSoutenance` int NOT NULL,
  `idEns` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Etudiant`
--

CREATE TABLE `Etudiant` (
  `idEtud` int NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Etudiant`
--

INSERT INTO `Etudiant` (`idEtud`, `nom`, `prenom`, `email`) VALUES
(1, 'El Fayez', 'Nezha', 'nezhaelfayez@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `Evaluation`
--

CREATE TABLE `Evaluation` (
  `idEval` int NOT NULL,
  `note` float NOT NULL,
  `commentaire` varchar(50) NOT NULL,
  `coef` float NOT NULL,
  `idEns` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Groupe`
--

CREATE TABLE `Groupe` (
  `idGroupe` int NOT NULL,
  `nom` varchar(50) NOT NULL,
  `modifiable_par_etudiant` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Projet`
--

CREATE TABLE `Projet` (
  `idProjet` int NOT NULL,
  `titre` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `annee` int NOT NULL,
  `semestre` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Rendu`
--

CREATE TABLE `Rendu` (
  `idDepot` int NOT NULL,
  `idGroupe` int NOT NULL,
  `dateEnvoyee` date NOT NULL,
  `titre_rendu` varchar(50) NOT NULL,
  `url_rendu` varchar(200) NOT NULL,
  `idEval` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Ressource`
--

CREATE TABLE `Ressource` (
  `idRessource` int NOT NULL,
  `titre` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `url` varchar(200) NOT NULL,
  `mise_en_avant` tinyint(1) NOT NULL,
  `idProjet` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Soutenance`
--

CREATE TABLE `Soutenance` (
  `idSoutenance` int NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `dateSout` date NOT NULL,
  `lieu` varchar(50) NOT NULL,
  `heureDebut` time NOT NULL,
  `heureFin` time NOT NULL,
  `idGroupe` int NOT NULL,
  `idProjet` int NOT NULL,
  `idEval` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `idUtilisateur` bigint UNSIGNED NOT NULL,
  `nom` varchar(500) NOT NULL,
  `prenom` varchar(500) NOT NULL,
  `login` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `profil` varchar(500) NOT NULL,
  `activation_key` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`idUtilisateur`, `nom`, `prenom`, `login`, `password`, `profil`, `activation_key`) VALUES
(1, 'el fayez', 'nezha', 'nezhaelfayez@gmail.com', 'test', 'etudiant', 1234),
(2, 'enseignant', 'brahim', 'brahim@test.com', 'test', 'enseignant', 1234),
(4, 'el fayez', 'malika', 'brahimelfayez@yahoo.fr', 'tests', 'enseignant', 12345);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Depot`
--
ALTER TABLE `Depot`
  ADD PRIMARY KEY (`idDepot`),
  ADD KEY `Depot_Projet0_FK` (`idProjet`);

--
-- Index pour la table `Enseignant`
--
ALTER TABLE `Enseignant`
  ADD PRIMARY KEY (`idEns`);

--
-- Index pour la table `estAssigneComme`
--
ALTER TABLE `estAssigneComme`
  ADD PRIMARY KEY (`idEns`,`idProjet`),
  ADD KEY `estAssigneComme_Projet0_FK` (`idProjet`);

--
-- Index pour la table `estDansCeProjet`
--
ALTER TABLE `estDansCeProjet`
  ADD PRIMARY KEY (`idProjet`,`idGroupe`),
  ADD KEY `estDansCeProjet_Groupe0_FK` (`idGroupe`);

--
-- Index pour la table `estDansLeGroupe`
--
ALTER TABLE `estDansLeGroupe`
  ADD PRIMARY KEY (`idGroupe`,`idEtud`),
  ADD KEY `estDansLeGroupe_Etudiant0_FK` (`idEtud`);

--
-- Index pour la table `estEvaluePar`
--
ALTER TABLE `estEvaluePar`
  ADD PRIMARY KEY (`idEval`,`idEns`),
  ADD KEY `estEvaluePar_Enseignant_FK` (`idEns`);

--
-- Index pour la table `estJury`
--
ALTER TABLE `estJury`
  ADD PRIMARY KEY (`idSoutenance`,`idEns`),
  ADD KEY `estJury_Enseignant0_FK` (`idEns`);

--
-- Index pour la table `Etudiant`
--
ALTER TABLE `Etudiant`
  ADD PRIMARY KEY (`idEtud`);

--
-- Index pour la table `Evaluation`
--
ALTER TABLE `Evaluation`
  ADD PRIMARY KEY (`idEval`),
  ADD KEY `Evaluation_Enseignant0_FK` (`idEns`);

--
-- Index pour la table `Groupe`
--
ALTER TABLE `Groupe`
  ADD PRIMARY KEY (`idGroupe`);

--
-- Index pour la table `Projet`
--
ALTER TABLE `Projet`
  ADD PRIMARY KEY (`idProjet`);

--
-- Index pour la table `Rendu`
--
ALTER TABLE `Rendu`
  ADD PRIMARY KEY (`idDepot`,`idGroupe`),
  ADD KEY `Rendu_Groupe_FK` (`idGroupe`),
  ADD KEY `Rendu_Evaluation_FK` (`idEval`);

--
-- Index pour la table `Ressource`
--
ALTER TABLE `Ressource`
  ADD PRIMARY KEY (`idRessource`),
  ADD KEY `Ressource_Projet_FK` (`idProjet`);

--
-- Index pour la table `Soutenance`
--
ALTER TABLE `Soutenance`
  ADD PRIMARY KEY (`idSoutenance`),
  ADD KEY `Soutenance_Groupe_FK` (`idGroupe`),
  ADD KEY `Soutenance_Projet0_FK` (`idProjet`),
  ADD KEY `Soutenance_Evaluation_FK` (`idEval`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD UNIQUE KEY `idUtilisateur` (`idUtilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Depot`
--
ALTER TABLE `Depot`
  MODIFY `idDepot` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Enseignant`
--
ALTER TABLE `Enseignant`
  MODIFY `idEns` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `Etudiant`
--
ALTER TABLE `Etudiant`
  MODIFY `idEtud` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `Evaluation`
--
ALTER TABLE `Evaluation`
  MODIFY `idEval` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Groupe`
--
ALTER TABLE `Groupe`
  MODIFY `idGroupe` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Projet`
--
ALTER TABLE `Projet`
  MODIFY `idProjet` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Ressource`
--
ALTER TABLE `Ressource`
  MODIFY `idRessource` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Soutenance`
--
ALTER TABLE `Soutenance`
  MODIFY `idSoutenance` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `idUtilisateur` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Depot`
--
ALTER TABLE `Depot`
  ADD CONSTRAINT `Depot_Projet0_FK` FOREIGN KEY (`idProjet`) REFERENCES `Projet` (`idProjet`);

--
-- Contraintes pour la table `estAssigneComme`
--
ALTER TABLE `estAssigneComme`
  ADD CONSTRAINT `estAssigneComme_Enseignant_FK` FOREIGN KEY (`idEns`) REFERENCES `Enseignant` (`idEns`),
  ADD CONSTRAINT `estAssigneComme_Projet0_FK` FOREIGN KEY (`idProjet`) REFERENCES `Projet` (`idProjet`);

--
-- Contraintes pour la table `estDansCeProjet`
--
ALTER TABLE `estDansCeProjet`
  ADD CONSTRAINT `estDansCeProjet_Groupe0_FK` FOREIGN KEY (`idGroupe`) REFERENCES `Groupe` (`idGroupe`),
  ADD CONSTRAINT `estDansCeProjet_Projet_FK` FOREIGN KEY (`idProjet`) REFERENCES `Projet` (`idProjet`);

--
-- Contraintes pour la table `estDansLeGroupe`
--
ALTER TABLE `estDansLeGroupe`
  ADD CONSTRAINT `estDansLeGroupe_Etudiant0_FK` FOREIGN KEY (`idEtud`) REFERENCES `Etudiant` (`idEtud`),
  ADD CONSTRAINT `estDansLeGroupe_Groupe_FK` FOREIGN KEY (`idGroupe`) REFERENCES `Groupe` (`idGroupe`);

--
-- Contraintes pour la table `estEvaluePar`
--
ALTER TABLE `estEvaluePar`
  ADD CONSTRAINT `estEvaluePar_Enseignant_FK` FOREIGN KEY (`idEns`) REFERENCES `Enseignant` (`idEns`),
  ADD CONSTRAINT `estEvaluePar_Evaluation_FK` FOREIGN KEY (`idEval`) REFERENCES `Evaluation` (`idEval`);

--
-- Contraintes pour la table `estJury`
--
ALTER TABLE `estJury`
  ADD CONSTRAINT `estJury_Enseignant0_FK` FOREIGN KEY (`idEns`) REFERENCES `Enseignant` (`idEns`),
  ADD CONSTRAINT `estJury_Soutenance_FK` FOREIGN KEY (`idSoutenance`) REFERENCES `Soutenance` (`idSoutenance`);

--
-- Contraintes pour la table `Evaluation`
--
ALTER TABLE `Evaluation`
  ADD CONSTRAINT `Evaluation_Enseignant0_FK` FOREIGN KEY (`idEns`) REFERENCES `Enseignant` (`idEns`);

--
-- Contraintes pour la table `Rendu`
--
ALTER TABLE `Rendu`
  ADD CONSTRAINT `Rendu_Depot_FK` FOREIGN KEY (`idDepot`) REFERENCES `Depot` (`idDepot`),
  ADD CONSTRAINT `Rendu_Evaluation_FK` FOREIGN KEY (`idEval`) REFERENCES `Evaluation` (`idEval`),
  ADD CONSTRAINT `Rendu_Groupe_FK` FOREIGN KEY (`idGroupe`) REFERENCES `Groupe` (`idGroupe`);

--
-- Contraintes pour la table `Ressource`
--
ALTER TABLE `Ressource`
  ADD CONSTRAINT `Ressource_Projet_FK` FOREIGN KEY (`idProjet`) REFERENCES `Projet` (`idProjet`);

--
-- Contraintes pour la table `Soutenance`
--
ALTER TABLE `Soutenance`
  ADD CONSTRAINT `Soutenance_Evaluation_FK` FOREIGN KEY (`idEval`) REFERENCES `Evaluation` (`idEval`),
  ADD CONSTRAINT `Soutenance_Groupe_FK` FOREIGN KEY (`idGroupe`) REFERENCES `Groupe` (`idGroupe`),
  ADD CONSTRAINT `Soutenance_Projet0_FK` FOREIGN KEY (`idProjet`) REFERENCES `Projet` (`idProjet`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
