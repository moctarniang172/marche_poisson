-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 11 déc. 2025 à 16:06
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `marcher`
--

-- --------------------------------------------------------

--
-- Structure de la table `depances`
--

CREATE TABLE `depances` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `motif` varchar(255) NOT NULL,
  `date_depense` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `depances`
--

INSERT INTO `depances` (`id`, `user_id`, `montant`, `motif`, `date_depense`) VALUES
(1, 1, 500, 'sario', '2025-12-06 00:00:00'),
(2, 1, 500, 'sario', '2025-12-06 00:00:00'),
(3, 1, 500, 'sario', '2025-12-06 00:00:00'),
(4, 1, 500, 'sario', '2025-12-06 00:00:00'),
(5, 1, 500, 'sario', '2025-12-06 00:00:00'),
(6, 1, 500, 'sario', '2025-12-06 00:00:00'),
(7, 1, 1000, 'sario', '2025-12-06 00:00:00'),
(8, 1, 2000, 'sario', '2025-12-06 00:00:00'),
(9, 1, 2000, 'sario', '2025-12-06 00:00:00'),
(10, 1, 2000, 'sario', '2025-12-06 00:00:00'),
(11, 1, 2000, 'sario', '2025-12-06 00:00:00'),
(12, 1, 2000, 'sario', '2025-12-06 00:00:00'),
(13, 4, 50000, 'transport', '2025-12-10 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `paiements`
--

CREATE TABLE `paiements` (
  `id` int(11) NOT NULL,
  `id_vente` int(11) NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `date_paiement` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `paiements`
--

INSERT INTO `paiements` (`id`, `id_vente`, `montant`, `date_paiement`) VALUES
(1, 1, 300000.00, '2025-11-24 00:00:00'),
(2, 1, 300000.00, '2025-11-24 00:00:00'),
(3, 5, 100000.00, '2025-12-04 22:01:24'),
(4, 5, 100000.00, '2025-12-04 22:58:03'),
(5, 6, 1000000.00, '2025-12-05 00:15:33'),
(6, 7, 100000.00, '2025-12-05 00:46:10'),
(7, 8, 200000.00, '2025-12-05 21:14:51'),
(8, 7, 50000.00, '2025-12-07 20:01:59'),
(9, 10, 100000.00, '2025-12-08 13:15:25'),
(10, 11, 30000.00, '2025-12-08 14:13:00'),
(11, 16, 300000.00, '2025-12-10 19:39:25'),
(12, 17, 300000.00, '2025-12-10 21:17:07');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT '''users''',
  `mdp1` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `telephone`, `role`, `mdp1`) VALUES
(1, 'niang', 'moctar', '771728967', 'users', '1234'),
(2, 'niang', 'Moctar', '771728967', 'users', '1234'),
(3, 'niang', 'Moctar', '771728967', 'users', '1234'),
(4, 'niang', 'Moctar', '776253428', 'users', '$2y$10$C.HbJea6iZ7alZszb9ytBO6aF7qtxYhXI5VtH//WWHEHfjEVJawJm'),
(5, 'mariama', 'diop', '788142774', 'users', '$2y$10$FdSmklSDUI59Cw5W5zn6qOgVBT1yNKPGeP9o/CYDju9pD5X6Tz2ua'),
(6, 'bare', 'amina', '761829170', 'admin', '$2y$10$AcyD5fKrn2vjAYqjT2aFAO3eODlCgMCzy86BMq9IQGjOOQU0r6pLW'),
(7, 'moukhamed ', 'niang', '775058511', 'admin', '$2y$10$Xd7K3GZ0CWE3ve37zctSVe20i6fHR.5Nz/Yvhb42pvMuSY4WhNp02'),
(8, 'Niang', 'oumi', '777203480', '\'users\'', '$2y$10$b/aJg2Z72RnEpiZ/76Q1Fu19nL/NECFBehPEu6eKPddETNRoJsdYm');

-- --------------------------------------------------------

--
-- Structure de la table `ventes`
--

CREATE TABLE `ventes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nom_client` varchar(100) NOT NULL,
  `poisson` varchar(50) DEFAULT NULL,
  `poids` decimal(10,2) NOT NULL,
  `prix_unitaire` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `avance` decimal(10,2) DEFAULT 0.00,
  `reste` decimal(10,2) NOT NULL,
  `date_vente` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ventes`
--

INSERT INTO `ventes` (`id`, `user_id`, `nom_client`, `poisson`, `poids`, `prix_unitaire`, `total`, `avance`, `reste`, `date_vente`) VALUES
(1, 1, 'moctar', 'Sardine', 400.00, 2000.00, 800000.00, 400000.00, 0.00, '2025-11-21'),
(2, 1, 'moctar', 'Sardine', 400.00, 2000.00, 800000.00, 400000.00, 400000.00, '2025-11-21'),
(3, 1, 'atou', 'Sardine', 2000.00, 3000.00, 6000000.00, 0.00, 6000000.00, '2025-11-21'),
(4, 1, 'moctar', 'Sardine', 200.00, 3000.00, 600000.00, 0.00, 600000.00, '2025-11-21'),
(5, 1, 'moctar', 'Tilapia', 300.00, 1500.00, 450000.00, 300000.00, 150000.00, '2025-12-03'),
(6, 1, 'aminata', 'Thon', 2000.00, 1000.00, 2000000.00, 2000000.00, 0.00, '2025-12-05'),
(7, 1, 'OUSSEYNOU SARR', 'Thon', 100.00, 3000.00, 300000.00, 300000.00, 0.00, '2025-12-05'),
(8, 1, 'ndoumbe', 'Thon', 200.00, 3000.00, 600000.00, 500000.00, 100000.00, '2025-12-05'),
(9, 1, 'alpha', 'Thon', 150.00, 3400.00, 510000.00, 150000.00, 360000.00, '2025-12-06'),
(10, 1, 'Aminata', 'Thon', 100.00, 3000.00, 300000.00, 200000.00, 100000.00, '2025-12-08'),
(11, 1, 'ndaye ami', 'Thon', 200.00, 4000.00, 800000.00, 230000.00, 570000.00, '2025-12-08'),
(12, 1, 'daba', 'Thon', 300.00, 3000.00, 900000.00, 250000.00, 650000.00, '2025-12-08'),
(13, 1, 'ndaye ami', 'Thon', 200.00, 3000.00, 600000.00, 200000.00, 400000.00, '2025-12-09'),
(14, 4, 'marame niang', 'Tilapia', 200.00, 2000.00, 400000.00, 200000.00, 200000.00, '2025-12-10'),
(15, 5, 'MARAIME', 'Tilapia', 300.00, 2000.00, 600000.00, 200000.00, 400000.00, '2025-12-10'),
(16, 6, 'adama', 'Sardine', 2000.00, 5000.00, 10000000.00, 300000.00, 9700000.00, '2025-12-10'),
(17, 6, 'niang', 'Sardine', 400.00, 3500.00, 1400000.00, 700000.00, 700000.00, '2025-12-10'),
(18, 8, 'yatma', 'Thon', 300.00, 3700.00, 1110000.00, 400000.00, 710000.00, '2025-12-11'),
(19, 8, 'oumi niang', 'Tilapia', 200.00, 3000.00, 600000.00, 200000.00, 400000.00, '2025-12-11');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `depances`
--
ALTER TABLE `depances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `paiements`
--
ALTER TABLE `paiements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_vente` (`id_vente`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `depances`
--
ALTER TABLE `depances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `paiements`
--
ALTER TABLE `paiements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `ventes`
--
ALTER TABLE `ventes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `depances`
--
ALTER TABLE `depances`
  ADD CONSTRAINT `fk_depances_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `paiements`
--
ALTER TABLE `paiements`
  ADD CONSTRAINT `paiements_ibfk_1` FOREIGN KEY (`id_vente`) REFERENCES `ventes` (`id`);

--
-- Contraintes pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD CONSTRAINT `fk_ventes_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
