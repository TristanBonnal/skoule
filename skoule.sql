-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 02 avr. 2022 à 14:28
-- Version du serveur :  8.0.28-0ubuntu0.20.04.3
-- Version de PHP : 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `skoule`
--

-- --------------------------------------------------------

--
-- Structure de la table `app_user`
--

CREATE TABLE `app_user` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(128) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `role` enum('user','admin') NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `app_user`
--

INSERT INTO `app_user` (`id`, `email`, `name`, `password`, `role`, `status`, `created_at`, `updated_at`) VALUES
(3, 'bonnal.tristan@hotmail.fr', 'Tristan Bonnal', '$2y$10$MngTqDeZaNJmJ/S8WdgRrOHsqQlIcDd5Du8fw2kWrNVIrcFRCyE9m', 'admin', 1, '2022-04-02 12:27:23', NULL),
(4, 'user.normal@hotmail.fr', 'Sous-fifre', '$2y$10$w4iXPPdxYAM0Cm/pINuKN.YxiUnYRGBLxKJiZ8UlEZx9D2/d2AR/W', 'user', 1, '2022-04-02 12:28:09', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `student`
--

CREATE TABLE `student` (
  `id` int UNSIGNED NOT NULL,
  `firstname` varchar(64) DEFAULT NULL,
  `lastname` varchar(64) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `teacher_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `student`
--

INSERT INTO `student` (`id`, `firstname`, `lastname`, `status`, `created_at`, `updated_at`, `teacher_id`) VALUES
(1, 'Théodore', 'Bagwell', 1, '2022-03-24 13:16:46', '2022-04-02 12:15:08', 1),
(2, 'Johnny', 'Bravo', 1, '2022-03-24 13:16:46', '2022-04-02 12:15:35', 1),
(3, 'Marty', 'Macfly', 1, '2022-03-24 13:16:46', '2022-04-02 12:15:56', 1);

-- --------------------------------------------------------

--
-- Structure de la table `teacher`
--

CREATE TABLE `teacher` (
  `id` int UNSIGNED NOT NULL,
  `firstname` varchar(64) DEFAULT NULL,
  `lastname` varchar(64) DEFAULT NULL,
  `job` varchar(64) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `teacher`
--

INSERT INTO `teacher` (`id`, `firstname`, `lastname`, `job`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Jean', 'Passe', 'Formateur PHP/MySQL', 1, '2022-03-24 13:16:46', '2022-04-02 12:13:21'),
(2, 'Paul', 'Ochon', 'Formateur PHP/MySQL', 1, '2022-03-24 13:16:46', '2022-04-02 12:13:44'),
(3, 'Annie', 'Versaire', 'Formateur PHP/MySQL', 1, '2022-03-24 13:16:46', '2022-04-02 12:14:12');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `app_user`
--
ALTER TABLE `app_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Index pour la table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_student_teacher_idx` (`teacher_id`);

--
-- Index pour la table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `app_user`
--
ALTER TABLE `app_user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `student`
--
ALTER TABLE `student`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
