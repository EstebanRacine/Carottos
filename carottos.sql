-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 24 mars 2023 à 09:25
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `carottos`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `idAvis` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `nbEtoiles` int(11) NOT NULL,
  `txtAvis` text NOT NULL,
  `userAvis` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`idAvis`, `idProduit`, `nbEtoiles`, `txtAvis`, `userAvis`) VALUES
(1, 2, 4, 'Ces carottes étaient parfaites pour mes différents plats. Que ce soit en gratin, en rondelle avec un peu d\'huile d\'olive. Seul petit point négatif, un peu terreuses à la réception.', 'Charlotte C'),
(2, 2, 2, 'Pas ouf', 'Michel B'),
(3, 2, 5, 'C\'est cool, perso mes rennes étaient giga contents !', 'Père N');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `idCommande` int(11) NOT NULL,
  `dateCommande` date NOT NULL DEFAULT current_timestamp(),
  `idUser` int(11) NOT NULL,
  `idPtLiv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`idCommande`, `dateCommande`, `idUser`, `idPtLiv`) VALUES
(1, '2023-03-22', 3, 4);

-- --------------------------------------------------------

--
-- Structure de la table `contenu`
--

CREATE TABLE `contenu` (
  `idProduit` int(11) NOT NULL,
  `idCommande` int(11) NOT NULL,
  `qteProd` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `contenu`
--

INSERT INTO `contenu` (`idProduit`, `idCommande`, `qteProd`) VALUES
(1, 1, 3),
(3, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `libelle` varchar(60) NOT NULL,
  `prix` float NOT NULL,
  `description` text NOT NULL,
  `joursAvantLivraison` int(11) NOT NULL,
  `img` varchar(80) NOT NULL,
  `QteStock` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `libelle`, `prix`, `description`, `joursAvantLivraison`, `img`, `QteStock`) VALUES
(1, 'Carottes Blanches', 4.3, 'Les carottes blanches sont spécialement riches en fibres, nutriments qui font d’elles un aliment excellent pour la santé. La qualité de leurs nutriments rend les carottes blanches bénéfiques à notre corps. Par la présence en grande quantité de fibres, elles sont très bonnes pour le transit et permettent de prévenir du diabète et du cholestérol et de lutter contre la constipation.', 2, 'images/produits/carottesBlanches.jpg', 14),
(2, 'Carottes Jaunes', 2.99, 'Il s\'agit d\'une variété de carotte presque oubliée, mais cultivée à nouveau pour son caractère original et son goût fin. Préférez-la en crudités où elle révèle toutes ses saveurs.', 3, 'images/produits/carottesJaunes.jpg', 0),
(3, 'Carottes Touchons', 3.9, 'La Carotte Touchon est une variété précoce, recommandée pour culture de printemps produisant des racines demi-longue et droite, sans cœur à la chair très ferme reconnue d\'un goût exceptionnel.  ', 45, 'images/produits/carottesTouchons.jpg', 25);

-- --------------------------------------------------------

--
-- Structure de la table `ptlivraisons`
--

CREATE TABLE `ptlivraisons` (
  `idPtLiv` int(11) NOT NULL,
  `nomPtLiv` varchar(40) NOT NULL,
  `adressePtLiv` varchar(100) NOT NULL,
  `villePtLiv` varchar(30) NOT NULL,
  `telPtLiv` varchar(17) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ptlivraisons`
--

INSERT INTO `ptlivraisons` (`idPtLiv`, `nomPtLiv`, `adressePtLiv`, `villePtLiv`, `telPtLiv`) VALUES
(1, 'Relais H', '350 Av. Jacques Cœur', 'Poitiers', '+33 5 49 37 25 39'),
(2, 'Agence Chronopst Poitiers', '10 Rue Claude Berthollet ZI n° 3', 'Poitiers', '+33 9 69 39 13 91'),
(3, 'UPS Access Point', '168 Av. de la Libération', 'Poitiers', '01 73 00 66 61'),
(4, 'Au Khédive', '6 Rue du Palais', 'Poitiers', '05 49 41 45 77'),
(5, 'Vapor\'Vape', '22 Rue de Bignoux', 'Poitiers', '09 54 16 45 93'),
(6, 'LP Noam Service', '47 Rue du Faubourg du Pont Neuf', 'Poitiers', '07 52 21 48 47'),
(7, 'Fiam Mohamed', '2 Rue des Lilas', 'Fontaine-le-Comte', '05 49 45 22 87'),
(8, 'Chez So', '15 Bd d\'Estrées', 'Châtellerault', '05 82 84 84 10');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `idUser` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `nomUser` varchar(30) NOT NULL,
  `prenomUser` varchar(30) NOT NULL,
  `dateNaissance` date NOT NULL,
  `villeUser` varchar(30) NOT NULL,
  `mailUser` varchar(50) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idUser`, `login`, `password`, `nomUser`, `prenomUser`, `dateNaissance`, `villeUser`, `mailUser`, `admin`) VALUES
(3, 'admin', '$2y$10$.WlAFtVl9j4zX40dswM0n.xouWaLXwTtGKLMZtEHWY131cWln0S5y', 'Admin', 'Admin', '2023-03-10', 'Poitiers', 'admin.admin@admin.com', 1),
(6, 'jtest', '$2y$10$bhwe8EvxEJj2jWChAIL8Zu0rAELcftFCH3JiRXpa4jXx9CDSH0ic2', 'Testeur', 'Josh', '2004-01-08', 'Besançon', 'josh.test@orange.fr', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`idAvis`),
  ADD KEY `FK_avis_produits` (`idProduit`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`idCommande`),
  ADD KEY `FK_commande_ptLivraison` (`idPtLiv`),
  ADD KEY `FK_commande_users` (`idUser`);

--
-- Index pour la table `contenu`
--
ALTER TABLE `contenu`
  ADD PRIMARY KEY (`idProduit`,`idCommande`),
  ADD KEY `FK_contenu_commande` (`idCommande`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ptlivraisons`
--
ALTER TABLE `ptlivraisons`
  ADD PRIMARY KEY (`idPtLiv`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `idAvis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `idCommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `ptlivraisons`
--
ALTER TABLE `ptlivraisons`
  MODIFY `idPtLiv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `FK_avis_produits` FOREIGN KEY (`idProduit`) REFERENCES `produits` (`id`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_commande_ptLivraison` FOREIGN KEY (`idPtLiv`) REFERENCES `ptlivraisons` (`idPtLiv`),
  ADD CONSTRAINT `FK_commande_users` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`);

--
-- Contraintes pour la table `contenu`
--
ALTER TABLE `contenu`
  ADD CONSTRAINT `FK_contenu_commande` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`idCommande`),
  ADD CONSTRAINT `FK_contenu_produits` FOREIGN KEY (`idProduit`) REFERENCES `produits` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
