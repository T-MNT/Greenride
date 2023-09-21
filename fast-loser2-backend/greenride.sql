-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 18 mai 2023 à 22:29
-- Version du serveur : 5.7.36
-- Version de PHP : 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `greenride`
--

-- --------------------------------------------------------

--
-- Structure de la table `alert`
--

CREATE TABLE `alert` (
  `id` int(11) NOT NULL,
  `user_plaint` int(11) NOT NULL,
  `user_signal` int(11) NOT NULL,
  `trajet` int(11) NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commentaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `alert`
--

INSERT INTO `alert` (`id`, `user_plaint`, `user_signal`, `trajet`, `date`, `commentaire`, `reason`) VALUES
(3, 12, 3, 3, '10/05/2023', 'Je suis arrivé en retard car le conducteur à manquer l\'accident de peu.', 'conduite dangereuse');

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

CREATE TABLE `annonces` (
  `id` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `date` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendeur_id` int(11) NOT NULL,
  `nb_tokens` int(11) NOT NULL,
  `statut` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en cours',
  `acheteur_id` int(11) NOT NULL,
  `date_achat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `car`
--

CREATE TABLE `car` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photos_url` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `car`
--

INSERT INTO `car` (`id`, `brand`, `model`, `photos_url`, `id_user`) VALUES
(1, 'Bugatti', 'Chiron', '/src/app/assets/img/voitures/infos_trajet_test1.jpg,/src/app/assets/img/voitures/infos_trajet_test2.jpg,/src/app/assets/img/voitures/infos_trajet_test3.jpg,/src/app/assets/img/voitures/infos_trajet_test4.jpg,', 1),
(2, 'Renault', 'Clio RS', '/src/app/assets/img/voitures/clioRS_1.jpg,/src/app/assets/img/voitures/clioRS_2.jpg', 14),
(3, 'Renault', 'Clio', '/src/app/assets/img/voitures/clioRS_1.jpg,/src/app/assets/img/voitures/clioRS_2.jpg', 7),
(4, 'Peugeot', '308', ' /src/app/assets/img/voitures/peugeot-308.jpg', 12),
(6, 'testt', 'testt', 'https://firebasestorage.googleapis.com/v0/b/greenride-fast-loser2.appspot.com/o/images_car%2Ftest2%40test.fr%2Ftest2%40test.fr-2023-05-16T07%3A43%3A04.070Z?alt=media&token=d3817a29-a4af-4cc6-b166-9c78091d2c28,https://firebasestorage.googleapis.com/v0/b/greenride-fast-loser2.appspot.com/o/images_car%2Ftest2%40test.fr%2Ftest2%40test.fr-2023-05-16T07%3A44%3A52.550Z?alt=media&token=aba5b926-ec69-423d-b64a-b64b179352a6,https://firebasestorage.googleapis.com/v0/b/greenride-fast-loser2.appspot.com/o/images_car%2Ftest2%40test.fr%2Ftest2%40test.fr-2023-05-17T08%3A40%3A31.751Z?alt=media&token=eb55bf1c-c137-4a0a-af5b-17590fb3e5d6,https://firebasestorage.googleapis.com/v0/b/greenride-fast-loser2.appspot.com/o/images_car%2Ftest2%40test.fr%2Ftest2%40test.fr-2023-05-17T08%3A40%3A34.881Z?alt=media&token=7a7365a6-8a8f-44d0-986f-369f7861429b,https://firebasestorage.googleapis.com/v0/b/greenride-fast-loser2.appspot.com/o/images_car%2Ftest2%40test.fr%2Ftest2%40test.fr-2023-05-17T08%3A40%3A36.846Z?alt=media&token=2e24cc3f-8d01-4f1d-901c-48161c246588', 18);

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `date` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user_1` int(11) NOT NULL,
  `id_user_2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `chat`
--

INSERT INTO `chat` (`id`, `date`, `id_user_1`, `id_user_2`) VALUES
(1, '19/04/2023', 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `rating_user_id_id` int(11) NOT NULL,
  `rated_user_id_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `rating_user_id_id`, `rated_user_id_id`, `rate`, `content`) VALUES
(1, 18, 18, 5, 'Génial ce conducteur !'),
(2, 18, 18, 5, 'Génial ce conducteur !'),
(3, 18, 18, 5, 'test'),
(4, 18, 18, 5, 'test'),
(5, 18, 18, 5, 'oui'),
(6, 18, 18, 4, 'test'),
(7, 18, 18, 2, 'pas ouf');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `id_user_id` int(11) NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `objet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `id_user_id`, `message`, `date`, `objet`) VALUES
(1, 12, 'Ceci est un test', '10-05-23', 'Test'),
(2, 12, 'Test2', '12-05-2023', 'Test 2');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230320154907', '2023-03-20 15:49:15', 663),
('DoctrineMigrations\\Version20230321104119', '2023-03-21 10:41:29', 450),
('DoctrineMigrations\\Version20230421094510', '2023-04-21 09:46:49', 156),
('DoctrineMigrations\\Version20230511075132', '2023-05-11 07:51:42', 619),
('DoctrineMigrations\\Version20230511094954', '2023-05-11 09:50:02', 67),
('DoctrineMigrations\\Version20230511095344', '2023-05-11 09:53:51', 100),
('DoctrineMigrations\\Version20230511100057', '2023-05-11 10:01:03', 91),
('DoctrineMigrations\\Version20230511125009', '2023-05-11 12:50:16', 104);

-- --------------------------------------------------------

--
-- Structure de la table `message_chat`
--

CREATE TABLE `message_chat` (
  `id` int(11) NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_chat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `message_chat`
--

INSERT INTO `message_chat` (`id`, `text`, `id_user`, `id_chat`) VALUES
(1, 'Salut', 2, 1),
(2, 'ça marche !!!!', 2, 1),
(3, '', 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` int(11) NOT NULL,
  `body` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL,
  `delivered_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `music`
--

CREATE TABLE `music` (
  `id` int(11) NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `music`
--

INSERT INTO `music` (`id`, `value`) VALUES
(1, 'Tout'),
(2, 'Rap'),
(3, 'Rock'),
(4, 'Electro'),
(5, 'Pop');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `value` varchar(24) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `value`) VALUES
(1, 'ROLE_ADMIN'),
(2, 'ROLE_USER');

-- --------------------------------------------------------

--
-- Structure de la table `trajet`
--

CREATE TABLE `trajet` (
  `id` int(11) NOT NULL,
  `depart_date` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `depart_hour` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `depart` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etapes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `places` int(11) NOT NULL,
  `bagages_petits` int(11) NOT NULL,
  `bagages_grands` int(11) NOT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_account` int(11) NOT NULL,
  `id_car` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `trajet`
--

INSERT INTO `trajet` (`id`, `depart_date`, `depart_hour`, `depart`, `destination`, `etapes`, `places`, `bagages_petits`, `bagages_grands`, `notes`, `id_account`, `id_car`) VALUES
(1, '03-04-2023', '10:02', 'Paris', 'Strasbourg', NULL, 3, 2, 1, 'Aucune', 12, 1),
(2, '02-05-2023', '12:00', 'Marseille', 'Paris', NULL, 3, 2, 2, 'Aucune', 3, 2),
(3, '04-04-2023', '10:30', 'Armentières', 'Hazebrouck', NULL, 2, 3, 4, 'Aucune', 3, 2),
(7, '01-05-2023', '15:00', 'Lyon', 'Paris', NULL, 3, 3, 3, 'Animaux autorisés', 7, 1),
(8, '10-05-2023', '14:00', 'Lille', 'Strasbourg', 'Reims', 3, 2, 2, 'Aucun', 7, 1),
(9, '16-05-2023', '14:00', 'Saint-Michel', 'Paris', '', 3, 2, 2, 'J\'adore le rock !', 12, 1),
(10, '18-05-2023', '14:00', 'Paris', 'Berlin', 'Strasbourg', 2, 2, 1, 'Je pars en mission ce jour là !', 14, 1),
(11, '24-05-2023', '03:00', 'Paris', 'Brest', 'Rennes', 3, 2, 2, 'Captain: Mission Bretagne', 14, 1),
(12, '17-05-2023', '10:49', 'Lille', 'Paris', 'rien', 3, 1, 4, 'test', 18, 1),
(13, '18-05-2023', '12:50', 'Montpellier', 'Bordeaux', 'rien', 3, 3, 5, 'test2', 18, 1),
(14, '19-05-2023', '11:53', 'Lyon', 'Brest', 'rien', 2, 4, 2, 'test3', 18, 6);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp` int(11) DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img_profil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tokens` int(11) NOT NULL,
  `date_naissance` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_music` int(11) NOT NULL,
  `silence` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_unban` int(11) DEFAULT NULL,
  `avertissements` int(11) DEFAULT NULL,
  `date_inscrit` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `ville`, `cp`, `adresse`, `img_profil`, `tokens`, `date_naissance`, `id_music`, `silence`, `description`, `date_unban`, `avertissements`, `date_inscrit`) VALUES
(1, 'test@test.fr', '[\"ROLE_ADMIN\"]', 'Testpass10!', 'Merlo', 'Florian', 'Armentières', 59280, 'test', '', 50, '20-10/-200', 1, 'true', '', NULL, 0, '02-04-2023'),
(2, 'cedric@gmail.fr', '[\"ROLE_ADMIN\"]', '$2y$13$sTwT/rE1Z1fAB0EJlnoZIeSh23AFL7ym3fA0lEcMWeGBbKrN2c.wG', 'Chimot', 'Cédric', 'Paris', 75000, '10 rue de la Paix', 'https://firebasestorage.googleapis.com/v0/b/greenride-fast-loser2.appspot.com/o/images_profil%2Fcedric_samus%20avatar.png?alt=media&token=ffeda711-0bd1-4af0-9c9b-7e4a65854b17', 50, '10-10-2000', 3, 'true', '', NULL, 0, '02-04-2023'),
(3, 'toto@gmail.fr', '[\"ROLE_USER\"]', '$2y$13$jd/jxpkNqi7Lbdst0KUe.OeYVu.EGbv3N5zymK69h96Xr85tg/k1u', 'Toto', 'Toto', 'Marseille', 13000, 'Rue des Clowns', 'https://firebasestorage.googleapis.com/v0/b/greenride-fast-loser2.appspot.com/o/images_profil%2Ftoto%40gmail.fr?alt=media&token=7ac798f5-bd6a-4a6e-96eb-c175e1e47274', 600, '01-01-2001', 3, 'true', 'Coucou', NULL, 1, '07-04-2023'),
(7, 'blake@gmail.fr', '[\"ROLE_USER\"]', '$2y$13$w5EKmXgDSmwJi1JWtahGwu1uX.9.gwf7HbTHld3Q3XnRXLimXH7LK', 'Blake', 'Francis', 'Londres', 25224, '15 rue des Espions', 'https://firebasestorage.googleapis.com/v0/b/greenride-fast-loser2.appspot.com/o/images_profil%2Fblake%40gmail.fr?alt=media&token=53ee9bb3-e1e5-41a2-86a7-cfa5a802ac77', 50, '14-05-1935', 1, 'false', 'Je suis un espion des services secrets anglais, je vis de folles aventures et j\'adore les frites ;)', NULL, 0, '02-05-2023'),
(12, 'cedric10@gmail.fr', '[\"ROLE_USER\"]', '$2y$13$lAeEpPqHy89EBM/OLKLHhuf7PoDVX55p5Au62wwm0eqhwx10CPygW', 'Chimot', 'Cédric', 'Paris', 75000, 'rue des Développeurs', 'https://firebasestorage.googleapis.com/v0/b/greenride-fast-loser2.appspot.com/o/images_profil%2Fcedric10%40gmail.fr?alt=media&token=a70fe3f9-fa71-43c0-8aa8-faf7e17a2357', 500, '02-02-2002', 3, 'false', 'Coucou !', NULL, 0, '02-05-2023'),
(13, 'ironman@gmail.fr', '[\"ROLE_USER\"]', '$2y$13$4y/L6JHide.BKAB/4imeBuu9G/D0mtAOmQgDZMWRcp54aYfvMwDbe', 'Stark', 'Tony', 'Paris', 75001, 'rue de la Paix', 'https://firebasestorage.googleapis.com/v0/b/greenride-fast-loser2.appspot.com/o/images_profil%2Fironman%40gmail.fr?alt=media&token=42e2a57b-42db-4d9a-8719-d5f41b3c589f', 50, '12-09-1970', 3, 'false', 'I am Iron Man', NULL, 0, '10-05-2023'),
(14, 'captain@gmail.fr', '[\"ROLE_USER\"]', '$2y$13$Dl4SJBpMCNQ6/2N7thTktuhO35KM3rEo/7GAa/ZNnWPXgdFzqaO.K', 'Rogers', 'Steve', 'Paris', 75000, '15 rue des Héros', 'https://firebasestorage.googleapis.com/v0/b/greenride-fast-loser2.appspot.com/o/images_profil%2Fcaptain%40gmail.fr?alt=media&token=d5e2f588-86f4-46c3-ae4b-7633fdc87541', 50, '10-12-1919', 3, 'true', 'Je suis Captain America ;)', NULL, 0, '10-05-2023'),
(18, 'test2@test.fr', '[\"ROLE_USER\"]', '$2y$13$e6eVIcK/UrAbkqYy6DfnqeiIY0QHOLe2kscgQ7o491HYfKzDfcoXm', 'MERLO', 'Florian', 'Armentières', 59280, '94/10 rue des fusilléss', 'https://firebasestorage.googleapis.com/v0/b/greenride-fast-loser2.appspot.com/o/images_profil%2Ftest2%40test.fr?alt=media&token=c1f3555d-631d-48f1-8b08-7a84fc797a7d', 500, '20-10-2000', 3, 'true', 'tyest', NULL, 1, '');

-- --------------------------------------------------------

--
-- Structure de la table `user_trajet`
--

CREATE TABLE `user_trajet` (
  `id_user` int(11) NOT NULL,
  `id_trajet` int(11) NOT NULL,
  `is_validate` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_trajet`
--

INSERT INTO `user_trajet` (`id_user`, `id_trajet`, `is_validate`) VALUES
(18, 9, 1),
(18, 10, 1),
(2, 13, 0),
(3, 13, 0),
(7, 13, 0),
(12, 14, 0),
(13, 14, 0),
(14, 14, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `alert`
--
ALTER TABLE `alert`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_17FD46C12B5BA98C` (`trajet`),
  ADD KEY `IDX_17FD46C1115E8EC8` (`user_signal`),
  ADD KEY `IDX_17FD46C1EBFABED6` (`user_plaint`);

--
-- Index pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CB988C6F858C065E` (`vendeur_id`),
  ADD KEY `acheteur_id` (`acheteur_id`);

--
-- Index pour la table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_773DE69D6B3CA4B` (`id_user`);

--
-- Index pour la table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9474526C7D700B4B` (`rating_user_id_id`),
  ADD KEY `IDX_9474526C11B965DB` (`rated_user_id_id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4C62E63879F37AE5` (`id_user_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `message_chat`
--
ALTER TABLE `message_chat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `trajet`
--
ALTER TABLE `trajet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2B5BA98CA3ABFFD4` (`id_account`),
  ADD KEY `IDX_2B5BA98CE9990EC7` (`id_car`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD KEY `IDX_8D93D64923D7637A` (`id_music`);

--
-- Index pour la table `user_trajet`
--
ALTER TABLE `user_trajet`
  ADD PRIMARY KEY (`id_trajet`,`id_user`),
  ADD KEY `IDX_4E09B2B1D6C1C61` (`id_trajet`),
  ADD KEY `IDX_4E09B2B16B3CA4B` (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `alert`
--
ALTER TABLE `alert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `annonces`
--
ALTER TABLE `annonces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `car`
--
ALTER TABLE `car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `message_chat`
--
ALTER TABLE `message_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `music`
--
ALTER TABLE `music`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `trajet`
--
ALTER TABLE `trajet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `alert`
--
ALTER TABLE `alert`
  ADD CONSTRAINT `FK_17FD46C1115E8EC8` FOREIGN KEY (`user_signal`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_17FD46C12B5BA98C` FOREIGN KEY (`trajet`) REFERENCES `trajet` (`id`),
  ADD CONSTRAINT `FK_17FD46C1EBFABED6` FOREIGN KEY (`user_plaint`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD CONSTRAINT `FK_CB988C6F858C065E` FOREIGN KEY (`vendeur_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `annonces_ibfk_1` FOREIGN KEY (`acheteur_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `FK_User_ID_car` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C11B965DB` FOREIGN KEY (`rated_user_id_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_9474526C7D700B4B` FOREIGN KEY (`rating_user_id_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `FK_4C62E63879F37AE5` FOREIGN KEY (`id_user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `trajet`
--
ALTER TABLE `trajet`
  ADD CONSTRAINT `trajet_ibfk_1` FOREIGN KEY (`id_account`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `trajet_ibfk_2` FOREIGN KEY (`id_car`) REFERENCES `car` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_USER_1` FOREIGN KEY (`id_music`) REFERENCES `music` (`id`);

--
-- Contraintes pour la table `user_trajet`
--
ALTER TABLE `user_trajet`
  ADD CONSTRAINT `FK_4E09B2B16B3CA4B` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_4E09B2B1D6C1C61` FOREIGN KEY (`id_trajet`) REFERENCES `trajet` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
