-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 11, 2026 at 06:00 PM
-- Server version: 11.8.8-MariaDB-1 from Debian
-- PHP Version: 8.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bgfi_complains`
--

-- --------------------------------------------------------

--
-- Table structure for table `agences`
--

CREATE TABLE `agences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agences`
--

INSERT INTO `agences` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'New PatriciahavenBenin', '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(2, 'South LydavilleBenin', '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(3, 'South KolbyBenin', '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(4, 'Port AdrielBenin', '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(5, 'LeonoratownBenin', '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(6, 'North TrudiefurtBenin', '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(7, 'FletastadBenin', '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(8, 'SchadenmouthBenin', '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(9, 'West EliseBenin', '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(10, 'NelliefurtBenin', '2026-08-12 20:26:35', '2026-08-12 20:26:35');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-responsable@bgfigroupe.com|127.0.0.1', 'i:1;', 1788953168),
('laravel-cache-responsable@bgfigroupe.com|127.0.0.1:timer', 'i:1788953168;', 1788953168);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Carte bancaire', '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(2, 'Application mobile', '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(3, 'Virement', '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(4, 'Crédit', '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(5, 'Compte bancaire', '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(6, 'Frais bancaires', '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(7, 'Distributeur automatique', '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(9, 'Application', '2026-08-31 12:30:18', '2026-09-09 02:43:28', NULL),
(10, 'Accompagnement', '2026-09-11 01:47:16', '2026-09-11 15:13:53', '2026-09-11 15:13:53');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenoms` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `agence_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `prenoms`, `telephone`, `email`, `agence_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Lynch', 'Justen', '(231) 787-9185', 'dborer@example.org', 4, '2026-08-12 20:26:35', '2026-08-13 11:30:59', NULL),
(2, 'Gerhold', 'Maya', '+1-559-696-5273', 'hkuhn@example.net', 2, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(3, 'Cummings', 'Brendan', '1-213-742-4630', 'stamm.nathen@example.com', 7, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(4, 'Bednar', 'Jordy', '678.799.3306', 'cayla.flatley@example.net', 2, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(5, 'Ankunding', 'Mariela', '(985) 744-6596', 'daron.howe@example.net', 7, '2026-08-12 20:26:35', '2026-08-14 12:38:08', NULL),
(6, 'Lakin', 'Jarred', '667.951.2170', 'emmerich.quinn@example.net', 10, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(7, 'Gutkowski', 'Trycia', '+12679670336', 'opacocha@example.org', 8, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(8, 'Eichmann', 'Rene', '+17606879283', 'katelynn85@example.com', 9, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(9, 'McGlynn', 'Skye', '757.850.3640', 'schowalter.hobart@example.net', 6, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(10, 'Corkery', 'Vita', '256-648-8832', 'jalon89@example.net', 4, '2026-08-12 20:26:35', '2026-08-13 20:43:19', '2026-08-13 20:43:19'),
(11, 'Johnson', 'Chester', '+1.520.248.2965', 'nbreitenberg@example.net', 8, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(12, 'Carroll', 'Terry', '724-792-6010', 'kari41@example.org', 2, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(13, 'Olson', 'Adrien', '+1.424.530.3459', 'elyssa65@example.org', 9, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(14, 'Wintheiser', 'Lucie', '1-478-443-2800', 'jazlyn.dooley@example.com', 8, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(15, 'Osinski', 'Jayce', '463.788.0812', 'xrau@example.net', 10, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(16, 'Gislason', 'Dean', '505.322.6052', 'cemard@example.org', 10, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(17, 'Christiansen', 'Juvenal', '1-434-226-8746', 'amara51@example.com', 9, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(18, 'Will', 'Ricky', '1-520-469-6914', 'moses25@example.org', 4, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(19, 'Bashirian', 'Madalyn', '(325) 402-8183', 'marks.caterina@example.net', 6, '2026-08-12 20:26:35', '2026-08-13 21:35:40', '2026-08-13 21:35:40'),
(20, 'Mayert', 'Kennedy', '856.857.9304', 'piper56@example.org', 6, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(21, 'Hermann', 'Jewel', '726-470-7664', 'hermann77@example.com', 9, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(22, 'McClure', 'Kareem', '+1-925-585-0882', 'nitzsche.sean@example.net', 5, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(23, 'Paucek', 'Kellen', '+1 (283) 234-6315', 'dorothy08@example.net', 6, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(24, 'Keebler', 'Crystel', '469-376-7034', 'hartmann.fermin@example.net', 5, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(25, 'Howell', 'Beth', '+1-628-874-5866', 'myrna55@example.com', 2, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(26, 'Rath', 'Emanuel', '+1-310-217-0711', 'nkerluke@example.net', 8, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(27, 'Zulauf', 'Carolanne', '(757) 995-5975', 'edison23@example.com', 4, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(28, 'Bode', 'Ethel', '+1-551-771-4832', 'marina.white@example.org', 8, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(29, 'O\'Reilly', 'Chanelle', '+1-386-362-8576', 'tgrady@example.com', 4, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(30, 'Jenkins', 'Valentin', '+1.412.218.2226', 'lyric.roob@example.org', 10, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(31, 'Kling', 'Natasha', '+1-954-420-5876', 'aheller@example.org', 7, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(32, 'Pollich', 'Monty', '(330) 255-4351', 'lueilwitz.elton@example.org', 5, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(33, 'Schuster', 'Mabelle', '818-292-7860', 'rolando.rolfson@example.com', 10, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(34, 'Hirthe', 'Kiarra', '(386) 563-0997', 'mrowe@example.net', 8, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(35, 'Mueller', 'Nadia', '380.261.3577', 'prosacco.marian@example.com', 3, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(36, 'Gorczany', 'Marion', '361-897-6858', 'damore.cyrus@example.org', 3, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(37, 'McKenzie', 'Megane', '+1.615.265.2142', 'caterina48@example.net', 10, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(38, 'Hickle', 'Pink', '+17707068829', 'gonzalo.dickens@example.org', 8, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(39, 'Jakubowski', 'Christian', '(651) 623-1638', 'delphia38@example.org', 9, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(40, 'Schmeler', 'Genesis', '430.232.3410', 'bwisoky@example.org', 1, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(41, 'Padberg', 'Christy', '539-822-1690', 'hwintheiser@example.org', 3, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(42, 'Haag', 'Annamarie', '469-364-2411', 'harvey.waldo@example.org', 6, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(43, 'Prosacco', 'Laura', '505-606-1026', 'block.rossie@example.net', 3, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(44, 'Rohan', 'Jace', '+1-559-293-4347', 'nrath@example.com', 4, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(45, 'Hoppe', 'Dejuan', '+1-801-513-7986', 'felipe52@example.com', 4, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(46, 'Hane', 'Angel', '(310) 691-0165', 'vkozey@example.net', 4, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(47, 'Rempel', 'Lane', '1-502-895-2440', 'nicholaus23@example.net', 7, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(48, 'Olson', 'Odell', '+1-405-360-5227', 'jparisian@example.com', 1, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(49, 'Moen', 'Rosemary', '1-409-854-6232', 'antonietta24@example.org', 3, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(50, 'Ondricka', 'Hallie', '+1.678.549.8626', 'lvon@example.org', 3, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(51, 'H.', 'Dieudonne', '+228 785612984523', 'dieudonne.h@gmail.com', 4, '2026-08-12 20:35:24', '2026-08-12 20:35:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reclamation_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('commentaire','action') NOT NULL DEFAULT 'commentaire',
  `contenu` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `commentaires`
--

INSERT INTO `commentaires` (`id`, `reclamation_id`, `user_id`, `type`, `contenu`, `created_at`, `updated_at`) VALUES
(1, 1, 15, 'commentaire', 'Finalisation d\'urgence', '2026-08-31 13:09:40', '2026-08-31 13:09:40'),
(2, 1, 15, 'action', 'RUSH', '2026-08-31 13:10:02', '2026-08-31 13:10:02'),
(3, 11, 15, 'commentaire', 'Affectation d\'urgence', '2026-09-11 01:38:46', '2026-09-11 01:38:46');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `historiques`
--

CREATE TABLE `historiques` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_reclam` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `old_val` varchar(255) DEFAULT NULL,
  `new_val` varchar(255) DEFAULT NULL,
  `action` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `historiques`
--

INSERT INTO `historiques` (`id`, `id_reclam`, `id_user`, `date`, `old_val`, `new_val`, `action`) VALUES
(1, 4, 15, '2026-08-12 17:11:00', 'Nouvelle', 'En cours de traitement', 'Changement de statut'),
(2, 4, 15, '2026-08-12 17:11:00', 'Faible', 'Moyenne', 'Changement de priorité'),
(3, 4, 15, '2026-08-12 17:15:56', 'En cours de traitement', 'En attente client', 'Changement de statut'),
(4, 4, 15, '2026-08-12 17:15:56', 'Moyenne', 'Faible', 'Changement de priorité'),
(5, 3, 15, '2026-08-12 17:22:04', 'Nouvelle', 'Affectée', 'Changement de statut'),
(6, 3, 15, '2026-08-12 17:22:04', 'Haute', 'Haute', 'Changement de priorité'),
(7, 4, 15, '2026-08-13 07:23:14', 'Faible', 'Moyenne', 'Changement de priorité'),
(8, 4, 15, '2026-08-13 07:23:14', 'Assurance', 'Monetique', 'Changement de service'),
(9, 4, 15, '2026-08-13 07:23:14', 'Compte bancaire', 'Compte bancaire', 'Changement de catégorie'),
(10, 4, 15, '2026-08-13 07:23:14', 'Email', 'Téléphone', 'Changement de canal'),
(11, 5, 15, '2026-08-13 09:00:55', 'Nouvelle', 'Affectée', 'Changement de statut'),
(12, 5, 15, '2026-08-13 09:00:55', 'Haute', 'Critique', 'Changement de priorité'),
(13, 5, 15, '2026-08-13 09:00:55', 'Monetique', 'Monetique', 'Changement de service'),
(14, 5, 15, '2026-08-13 09:00:55', 'Compte bancaire', 'Compte bancaire', 'Changement de catégorie'),
(15, 5, 15, '2026-08-13 09:07:47', 'Affectée', 'En cours de traitement', 'Changement de statut'),
(16, 5, 15, '2026-08-13 09:07:47', 'Critique', 'Moyenne', 'Changement de priorité'),
(17, 5, 15, '2026-08-13 09:07:47', 'Monetique', 'Monetique', 'Changement de service'),
(18, 5, 15, '2026-08-13 09:07:47', 'Compte bancaire', 'Compte bancaire', 'Changement de catégorie'),
(19, 1, 15, '2026-08-13 17:29:29', 'Critique', 'Faible', 'Changement de priorité'),
(20, 1, 15, '2026-08-13 17:29:29', 'Assurance', 'Assurance', 'Changement de service'),
(21, 1, 15, '2026-08-13 17:29:29', 'Carte bancaire', 'Carte bancaire', 'Changement de catégorie'),
(22, 5, 15, '2026-08-13 17:48:08', 'En cours de traitement', 'En attente client', 'Changement de statut'),
(23, 5, 15, '2026-08-13 17:48:08', 'Moyenne', 'Critique', 'Changement de priorité'),
(24, 5, 15, '2026-08-13 17:48:08', 'Monetique', 'Monetique', 'Changement de service'),
(25, 5, 15, '2026-08-13 17:48:08', 'Compte bancaire', 'Compte bancaire', 'Changement de catégorie'),
(26, 2, 15, '2026-08-17 15:08:23', 'Nouvelle', 'Affectée', 'Changement de statut'),
(27, 2, 15, '2026-08-17 15:08:23', 'Moyenne', 'Haute', 'Changement de priorité'),
(28, 2, 15, '2026-08-17 15:08:23', 'Epargne', 'Epargne', 'Changement de service'),
(29, 2, 15, '2026-08-17 15:08:23', 'Crédit', 'Crédit', 'Changement de catégorie'),
(30, 3, 15, '2026-08-17 15:09:35', 'Affectée', 'En cours de traitement', 'Changement de statut'),
(31, 3, 15, '2026-08-17 15:09:35', 'Haute', 'Moyenne', 'Changement de priorité'),
(32, 3, 15, '2026-08-17 15:09:35', 'Monetique', 'Monetique', 'Changement de service'),
(33, 3, 15, '2026-08-17 15:09:35', 'Virement', 'Virement', 'Changement de catégorie'),
(34, 1, 15, '2026-08-17 15:27:03', 'Nouvelle', 'En attente client', 'Changement de statut'),
(35, 1, 15, '2026-08-17 15:27:03', 'Faible', 'Moyenne', 'Changement de priorité'),
(36, 1, 15, '2026-08-17 15:27:03', 'Assurance', 'Assurance', 'Changement de service'),
(37, 1, 15, '2026-08-17 15:27:03', 'Carte bancaire', 'Carte bancaire', 'Changement de catégorie'),
(38, 5, 15, '2026-08-17 15:27:35', 'En attente client', 'Clôturée', 'Changement de statut'),
(39, 5, 15, '2026-08-17 15:27:35', 'Critique', 'Critique', 'Changement de priorité'),
(40, 5, 15, '2026-08-17 15:27:35', 'Monetique', 'Monetique', 'Changement de service'),
(41, 5, 15, '2026-08-17 15:27:35', 'Compte bancaire', 'Compte bancaire', 'Changement de catégorie'),
(42, 8, 15, '2026-08-17 16:34:55', 'Nouvelle', 'Affectée', 'Changement de statut'),
(43, 8, 15, '2026-08-17 16:34:55', 'Extrême', 'Extrême', 'Changement de priorité'),
(44, 8, 15, '2026-08-17 16:34:55', 'Monetique', 'Monetique', 'Changement de service'),
(45, 8, 15, '2026-08-17 16:34:55', 'Compte bancaire', 'Compte bancaire', 'Changement de catégorie'),
(46, 6, 15, '2026-08-17 16:53:17', 'Nouvelle', 'Affectée', 'Changement de statut'),
(47, 6, 15, '2026-08-17 16:53:17', 'Haute', 'Critique', 'Changement de priorité'),
(48, 6, 15, '2026-08-17 16:53:17', 'Informatique', 'Informatique', 'Changement de service'),
(49, 6, 15, '2026-08-17 16:53:17', 'Application mobile', 'Application mobile', 'Changement de catégorie'),
(50, 7, 15, '2026-08-29 19:37:43', 'Inconnue', 'Critique', 'Changement de priorité'),
(51, 7, 15, '2026-08-29 19:37:43', 'Informatique', 'Informatique', 'Changement de service'),
(52, 7, 15, '2026-08-29 19:37:43', 'Distributeur automatique', 'Distributeur automatique', 'Changement de catégorie'),
(53, 7, 15, '2026-08-29 20:14:28', 'Critique', 'Critique', 'Changement de priorité'),
(54, 7, 15, '2026-08-29 20:14:28', 'Informatique', 'Informatique', 'Changement de service'),
(55, 7, 15, '2026-08-29 20:14:28', 'Distributeur automatique', 'Distributeur automatique', 'Changement de catégorie'),
(56, 7, 15, '2026-08-29 20:34:40', 'Critique', 'Critique', 'Changement de priorité'),
(57, 7, 15, '2026-08-29 20:34:40', 'Informatique', 'Crédit', 'Changement de service'),
(58, 7, 15, '2026-08-29 20:34:40', 'Distributeur automatique', 'Distributeur automatique', 'Changement de catégorie'),
(59, 6, 15, '2026-08-29 20:38:48', 'Critique', 'Critique', 'Changement de priorité'),
(60, 6, 15, '2026-08-29 20:38:48', 'Informatique', 'Informatique', 'Changement de service'),
(61, 6, 15, '2026-08-29 20:38:48', 'Application mobile', 'Application mobile', 'Changement de catégorie'),
(62, 6, 15, '2026-08-29 20:38:48', 'Aucun', 'Agent Test, Agent Test 2', 'Changement d\'équipe assignée'),
(63, 6, 15, '2026-08-29 20:39:20', 'Critique', 'Critique', 'Changement de priorité'),
(64, 6, 15, '2026-08-29 20:39:20', 'Informatique', 'Informatique', 'Changement de service'),
(65, 6, 15, '2026-08-29 20:39:20', 'Application mobile', 'Application mobile', 'Changement de catégorie'),
(66, 6, 15, '2026-08-29 20:39:20', 'Agent Test, Agent Test 2', 'Agent Test', 'Changement d\'équipe assignée'),
(67, 1, 15, '2026-08-31 08:56:48', 'En attente client', 'Clôturée', 'Changement de statut'),
(68, 1, 15, '2026-08-31 08:56:48', 'Moyenne', 'Critique', 'Changement de priorité'),
(69, 1, 15, '2026-08-31 08:56:48', 'Assurance', 'Assurance', 'Changement de service'),
(70, 1, 15, '2026-08-31 08:56:48', 'Carte bancaire', 'Carte bancaire', 'Changement de catégorie'),
(71, 1, 15, '2026-08-31 08:56:48', 'Aucun', 'Dr. Emmanuel Gutmann, Agent Test, Agent Test 2', 'Changement d\'équipe assignée'),
(72, 2, 15, '2026-09-02 09:15:51', 'Affectée', 'En attente client', 'Changement de statut'),
(73, 2, 15, '2026-09-02 09:15:51', 'Haute', 'Moyenne', 'Changement de priorité'),
(74, 2, 15, '2026-09-02 09:15:51', 'Epargne', 'Epargne', 'Changement de service'),
(75, 2, 15, '2026-09-02 09:15:51', 'Crédit', 'Crédit', 'Changement de catégorie'),
(76, 8, 15, '2026-09-02 17:01:59', 'Affectée', 'En attente client', 'Changement de statut'),
(77, 8, 15, '2026-09-02 17:01:59', 'Extrême', 'Moyenne', 'Changement de priorité'),
(78, 8, 15, '2026-09-02 17:01:59', 'Monetique', 'Monetique', 'Changement de service'),
(79, 8, 15, '2026-09-02 17:01:59', 'Compte bancaire', 'Compte bancaire', 'Changement de catégorie'),
(80, 9, 15, '2026-09-02 17:03:22', 'Nouvelle', 'En cours de traitement', 'Changement de statut'),
(81, 9, 15, '2026-09-02 17:03:22', 'Faible', 'Faible', 'Changement de priorité'),
(82, 9, 15, '2026-09-02 17:03:22', 'Emprunt', 'Emprunt', 'Changement de service'),
(83, 9, 15, '2026-09-02 17:03:22', 'Compte bancaire', 'Compte bancaire', 'Changement de catégorie'),
(84, 9, 15, '2026-09-02 17:03:22', 'Aucun', 'Reece Moore', 'Changement d\'équipe assignée'),
(85, 7, 15, '2026-09-02 17:03:37', 'Nouvelle', 'En cours de traitement', 'Changement de statut'),
(86, 7, 15, '2026-09-02 17:03:37', 'Critique', 'Moyenne', 'Changement de priorité'),
(87, 7, 15, '2026-09-02 17:03:37', 'Crédit', 'Crédit', 'Changement de service'),
(88, 7, 15, '2026-09-02 17:03:37', 'Distributeur automatique', 'Distributeur automatique', 'Changement de catégorie'),
(89, 7, 15, '2026-09-02 17:03:37', 'Agent Test', 'Dr. Emmanuel Gutmann', 'Changement d\'équipe assignée'),
(90, 6, 15, '2026-09-02 17:03:47', 'Critique', 'Critique', 'Changement de priorité'),
(91, 6, 15, '2026-09-02 17:03:47', 'Informatique', 'Informatique', 'Changement de service'),
(92, 6, 15, '2026-09-02 17:03:47', 'Application mobile', 'Application mobile', 'Changement de catégorie'),
(93, 6, 15, '2026-09-02 17:03:47', 'Agent Test', 'Dr. Emmanuel Gutmann', 'Changement d\'équipe assignée'),
(94, 6, 15, '2026-09-02 17:04:03', 'Affectée', 'En attente client', 'Changement de statut'),
(95, 6, 15, '2026-09-02 17:04:03', 'Critique', 'Moyenne', 'Changement de priorité'),
(96, 6, 15, '2026-09-02 17:04:03', 'Informatique', 'Informatique', 'Changement de service'),
(97, 6, 15, '2026-09-02 17:04:03', 'Application mobile', 'Application mobile', 'Changement de catégorie'),
(98, 6, 15, '2026-09-02 17:04:03', 'Dr. Emmanuel Gutmann', 'Dr. Emmanuel Gutmann, Geoffrey Stiedemann', 'Changement d\'équipe assignée'),
(99, 4, 15, '2026-09-02 17:04:50', 'En attente client', 'Résolue', 'Changement de statut'),
(100, 4, 15, '2026-09-02 17:04:50', 'Moyenne', 'Critique', 'Changement de priorité'),
(101, 4, 15, '2026-09-02 17:04:50', 'Monetique', 'Monetique', 'Changement de service'),
(102, 4, 15, '2026-09-02 17:04:50', 'Compte bancaire', 'Compte bancaire', 'Changement de catégorie'),
(103, 3, 15, '2026-09-02 17:05:35', 'En cours de traitement', 'En attente client', 'Changement de statut'),
(104, 3, 15, '2026-09-02 17:05:35', 'Moyenne', 'Faible', 'Changement de priorité'),
(105, 3, 15, '2026-09-02 17:05:35', 'Monetique', 'Monetique', 'Changement de service'),
(106, 3, 15, '2026-09-02 17:05:35', 'Virement', 'Virement', 'Changement de catégorie'),
(107, 3, 15, '2026-09-02 17:05:35', 'Aucun', 'Agent Test, Agent Test 2, RESPO', 'Changement d\'équipe assignée'),
(108, 10, 15, '2026-09-07 14:51:42', 'Nouvelle', 'Affectée', 'Changement de statut'),
(109, 10, 15, '2026-09-07 14:51:42', 'Moyenne', 'Haute', 'Changement de priorité'),
(110, 10, 15, '2026-09-07 14:51:42', 'Epargne', 'Epargne', 'Changement de service'),
(111, 10, 15, '2026-09-07 14:51:42', 'Application mobile', 'Application mobile', 'Changement de catégorie'),
(112, 10, 15, '2026-09-08 07:10:57', 'Affectée', 'En cours de traitement', 'Changement de statut'),
(113, 10, 15, '2026-09-08 07:10:57', 'Haute', 'Moyenne', 'Changement de priorité'),
(114, 10, 15, '2026-09-08 07:10:57', 'Epargne', 'Epargne', 'Changement de service'),
(115, 10, 15, '2026-09-08 07:10:57', 'Application mobile', 'Application mobile', 'Changement de catégorie'),
(116, 10, 15, '2026-09-08 07:10:57', 'Aucun', 'Dr. Emmanuel Gutmann, Geoffrey Stiedemann', 'Changement d\'équipe assignée'),
(117, 6, 15, '2026-09-08 07:51:26', 'En attente client', 'Clôturée', 'Changement de statut'),
(118, 6, 15, '2026-09-08 07:51:26', 'Moyenne', 'Critique', 'Changement de priorité'),
(119, 6, 15, '2026-09-08 07:51:26', 'Informatique', 'Informatique', 'Changement de service'),
(120, 6, 15, '2026-09-08 07:51:26', 'Application mobile', 'Application mobile', 'Changement de catégorie'),
(121, 6, 15, '2026-09-08 07:51:26', 'Dr. Emmanuel Gutmann, Geoffrey Stiedemann', 'RESPO', 'Changement d\'équipe assignée'),
(122, 7, 15, '2026-09-09 08:00:55', 'En cours de traitement', 'En attente client', 'Changement de statut'),
(123, 7, 15, '2026-09-09 08:00:55', 'Moyenne', 'Extrême', 'Changement de priorité'),
(124, 7, 15, '2026-09-09 08:00:55', 'Crédit', 'Crédit', 'Changement de service'),
(125, 7, 15, '2026-09-09 08:00:55', 'Distributeur automatique', 'Distributeur automatique', 'Changement de catégorie'),
(126, 9, 15, '2026-09-09 17:01:27', 'En cours de traitement', 'En attente client', 'Changement de statut'),
(127, 9, 15, '2026-09-09 17:01:27', 'Faible', 'Faible', 'Changement de priorité'),
(128, 9, 15, '2026-09-09 17:01:27', 'Emprunt', 'Emprunt', 'Changement de service'),
(129, 9, 15, '2026-09-09 17:01:27', 'Compte bancaire', 'Compte bancaire', 'Changement de catégorie'),
(130, 9, 15, '2026-09-09 17:01:27', 'Reece Moore', 'Agent Test, Agent Test 2, Agent', 'Changement d\'équipe assignée'),
(131, 2, 15, '2026-09-10 14:28:10', 'Moyenne', 'Faible', 'Changement de priorité'),
(132, 2, 15, '2026-09-10 14:28:10', 'Epargne', 'Epargne', 'Changement de service'),
(133, 2, 15, '2026-09-10 14:28:10', 'Crédit', 'Crédit', 'Changement de catégorie'),
(134, 11, 15, '2026-09-10 15:51:42', 'Haute', 'Haute', 'Changement de priorité'),
(135, 11, 15, '2026-09-10 15:51:42', 'Monetique', 'Monetique', 'Changement de service'),
(136, 11, 15, '2026-09-10 15:51:42', 'Frais bancaires', 'Frais bancaires', 'Changement de catégorie'),
(137, 11, 15, '2026-09-10 15:51:42', 'Aucun', 'Mrs. Myrtis Greenfelder Jr.', 'Changement d\'équipe assignée'),
(138, 11, 15, '2026-09-10 21:37:53', 'Nouvelle', 'Affectée', 'Changement de statut'),
(139, 11, 15, '2026-09-10 21:37:53', 'Haute', 'Haute', 'Changement de priorité'),
(140, 11, 15, '2026-09-10 21:37:53', 'Monetique', 'Monetique', 'Changement de service'),
(141, 11, 15, '2026-09-10 21:37:53', 'Frais bancaires', 'Frais bancaires', 'Changement de catégorie'),
(142, 3, 15, '2026-09-11 11:33:50', 'Faible', 'Moyenne', 'Changement de priorité'),
(143, 3, 15, '2026-09-11 11:33:50', 'Monetique', 'Monetique', 'Changement de service'),
(144, 3, 15, '2026-09-11 11:33:50', 'Virement', 'Virement', 'Changement de catégorie'),
(145, 9, 21, '2026-09-11 16:36:29', 'En attente client', 'Résolue', 'Changement de statut'),
(146, 9, 21, '2026-09-11 16:36:29', 'Faible', 'Haute', 'Changement de priorité'),
(147, 9, 21, '2026-09-11 16:36:29', 'Emprunt', 'Emprunt', 'Changement de service'),
(148, 9, 21, '2026-09-11 16:36:29', 'Compte bancaire', 'Compte bancaire', 'Changement de catégorie'),
(149, 9, 21, '2026-09-11 16:36:29', 'Agent Test, Agent Test 2, Agent', 'Aucun', 'Changement d\'équipe assignée');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_01_01_000000_create_passkeys_table', 1),
(5, '2025_08_14_170933_add_two_factor_columns_to_users_table', 1),
(6, '2026_01_27_000001_create_teams_table', 1),
(7, '2026_01_27_000002_add_current_team_id_to_users_table', 1),
(8, '2026_08_06_144100_create_priorites_table', 1),
(9, '2026_08_06_144101_create_agences_table', 1),
(10, '2026_08_06_144102_create_services_table', 1),
(11, '2026_08_06_144103_create_clients_table', 1),
(12, '2026_08_06_144104_create_categories_table', 1),
(13, '2026_08_06_144105_create_reclamations_table', 1),
(15, '2026_08_06_144106_create_historiques_table', 2),
(16, '2026_08_13_160549_add_soft_deletes_to_clients_table', 3),
(17, '2026_08_15_161247_add_soft_deletes_to_priorites_table', 4),
(18, '2026_08_17_170628_add_user_id_to_reclamations_table', 5),
(19, '2026_08_29_002237_create_reclamation_user_table', 6),
(20, '2026_08_31_083447_create_commentaires_table', 7),
(21, '2026_09_01_113623_add_deleted_at_to_reclamations_table', 8),
(22, '2026_09_09_163020_create_notifications_table', 9),
(23, '2026_09_11_105326_add_soft_deletes_to_categories_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('108c77cd-c6fc-44cc-93d2-9bb5dc3a0417', 'App\\Notifications\\ReclamationNotification', 'App\\Models\\User', 17, '{\"reclamation_id\":9,\"numero\":\"REC-20260817-KUY9\",\"action\":\"Nouvelle assignation\",\"message\":\"Vous avez \\u00e9t\\u00e9 assign\\u00e9(e) \\u00e0 la r\\u00e9clamation REC-20260817-KUY9\",\"created_at\":\"2026-09-09 17:01:27\"}', NULL, '2026-09-09 21:01:27', '2026-09-09 21:01:27'),
('5b4c2e1a-fc4b-44f5-a698-f3af0898c8bb', 'App\\Notifications\\ReclamationNotification', 'App\\Models\\User', 5, '{\"reclamation_id\":11,\"numero\":\"REC-20260910-VJ75\",\"action\":\"Nouvelle assignation\",\"message\":\"Vous avez \\u00e9t\\u00e9 assign\\u00e9(e) \\u00e0 la r\\u00e9clamation REC-20260910-VJ75\",\"created_at\":\"2026-09-10 15:51:42\"}', NULL, '2026-09-10 19:51:42', '2026-09-10 19:51:42'),
('883c872f-4b03-4afa-b87a-dfb8e5a7a25c', 'App\\Notifications\\ReclamationNotification', 'App\\Models\\User', 21, '{\"reclamation_id\":9,\"numero\":\"REC-20260817-KUY9\",\"action\":\"Nouvelle assignation\",\"message\":\"Vous avez \\u00e9t\\u00e9 assign\\u00e9(e) \\u00e0 la r\\u00e9clamation REC-20260817-KUY9\",\"created_at\":\"2026-09-09 17:01:27\"}', '2026-09-09 21:21:44', '2026-09-09 21:01:27', '2026-09-09 21:21:44'),
('e9c303cb-a9ef-4f41-9132-059562a67722', 'App\\Notifications\\ReclamationNotification', 'App\\Models\\User', 18, '{\"reclamation_id\":9,\"numero\":\"REC-20260817-KUY9\",\"action\":\"Nouvelle assignation\",\"message\":\"Vous avez \\u00e9t\\u00e9 assign\\u00e9(e) \\u00e0 la r\\u00e9clamation REC-20260817-KUY9\",\"created_at\":\"2026-09-09 17:01:27\"}', NULL, '2026-09-09 21:01:27', '2026-09-09 21:01:27');

-- --------------------------------------------------------

--
-- Table structure for table `passkeys`
--

CREATE TABLE `passkeys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `credential_id` varchar(255) NOT NULL,
  `credential` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`credential`)),
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('sudo@bgfigroupe.com', '$2y$12$.YBat.r5e2iUv64RnEh3C.6VeQvftdF1ijdfzxGSu9tiWgfPoTNPa', '2026-09-11 21:33:39');

-- --------------------------------------------------------

--
-- Table structure for table `priorites`
--

CREATE TABLE `priorites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `delay` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `priorites`
--

INSERT INTO `priorites` (`id`, `name`, `delay`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Critique', '24 heures', '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(2, 'Haute', '48 heures', '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(3, 'Moyenne', '5 jours', '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(4, 'Faible', '10 jours', '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(5, 'Urgente', '3 jours', '2026-08-14 18:52:17', '2026-08-18 18:21:33', '2026-08-18 18:21:33'),
(6, 'Extrême', '12 heures', '2026-08-17 20:14:40', '2026-08-17 20:14:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reclamations`
--

CREATE TABLE `reclamations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `numero` varchar(255) NOT NULL,
  `date_creation` date NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `canal` enum('Agence','Téléphone','Email','Application mobile') NOT NULL,
  `categorie_id` bigint(20) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `priorite_id` bigint(20) UNSIGNED NOT NULL,
  `statut` enum('Nouvelle','Affectée','En cours de traitement','En attente client','Résolue','Clôturée') NOT NULL DEFAULT 'Nouvelle',
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_limite` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reclamations`
--

INSERT INTO `reclamations` (`id`, `numero`, `date_creation`, `client_id`, `canal`, `categorie_id`, `description`, `priorite_id`, `statut`, `service_id`, `user_id`, `date_limite`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'REC-20260812-UFRA', '2026-08-12', 19, 'Agence', 1, 'ijevvewgg', 1, 'Clôturée', 1, 15, '2026-09-01', '2026-08-12 20:33:18', '2026-08-31 12:56:48', NULL),
(2, 'REC-20260812-WGUR', '2026-08-12', 3, 'Téléphone', 4, 'evbbe', 4, 'En attente client', 2, 15, '2026-09-20', '2026-08-12 20:33:33', '2026-09-10 18:28:10', NULL),
(3, 'REC-20260812-Z9T4', '2026-08-12', 38, 'Application mobile', 3, 'ebebbbe', 3, 'En attente client', 6, 15, '2026-09-16', '2026-08-12 20:33:51', '2026-09-11 15:33:50', NULL),
(4, 'REC-20260812-DKBH', '2026-08-12', 15, 'Téléphone', 5, 'rsjrjrjjdj', 1, 'Résolue', 6, 15, '2026-09-03', '2026-08-12 20:34:15', '2026-09-11 19:31:08', NULL),
(5, 'REC-20260813-B7PI', '2026-08-13', 51, 'Téléphone', 5, 'compte suspendu', 1, 'Clôturée', 6, 15, '2026-08-18', '2026-08-13 12:58:41', '2026-09-11 19:30:57', NULL),
(6, 'REC-20260814-OQ3K', '2026-08-14', 36, 'Téléphone', 2, 'Souci technique', 1, 'Clôturée', 8, 15, '2026-09-09', '2026-08-14 11:39:55', '2026-09-08 11:51:26', NULL),
(7, 'REC-20260817-H0B7', '2026-08-17', 27, 'Téléphone', 7, 'Plante', 6, 'En attente client', 3, 15, '2026-09-09', '2026-08-17 15:38:52', '2026-09-09 12:00:55', NULL),
(8, 'REC-20260817-O9DT', '2026-08-17', 42, 'Téléphone', 5, 'Blocage', 3, 'En attente client', 6, 15, '2026-09-07', '2026-08-17 20:15:20', '2026-09-02 21:01:59', NULL),
(9, 'REC-20260817-KUY9', '2026-08-17', 12, 'Téléphone', 5, 'Echec d\'emprunt', 2, 'Résolue', 4, 15, '2026-09-13', '2026-08-17 21:24:47', '2026-09-11 20:36:29', NULL),
(10, 'REC-20260902-EI7V', '2026-09-02', 16, 'Téléphone', 2, 'einveiznziop', 3, 'En cours de traitement', 2, 15, '2026-09-13', '2026-09-02 21:07:57', '2026-09-08 11:10:57', NULL),
(11, 'REC-20260910-VJ75', '2026-09-10', 26, 'Téléphone', 6, 'Accès solde', 2, 'Affectée', 6, 15, '2026-09-12', '2026-09-10 19:49:35', '2026-09-11 01:37:53', NULL),
(12, 'REC-20260910-XBZX', '2026-09-10', 29, 'Email', 2, 'Souci technique', 4, 'Nouvelle', 8, 15, '2026-09-20', '2026-09-11 01:45:21', '2026-09-11 01:45:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reclamation_user`
--

CREATE TABLE `reclamation_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reclamation_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reclamation_user`
--

INSERT INTO `reclamation_user` (`id`, `reclamation_id`, `user_id`, `created_at`, `updated_at`) VALUES
(7, 1, 17, '2026-08-31 12:56:48', '2026-08-31 12:56:48'),
(8, 1, 18, '2026-08-31 12:56:48', '2026-08-31 12:56:48'),
(9, 1, 10, '2026-08-31 12:56:48', '2026-08-31 12:56:48'),
(11, 7, 10, '2026-09-02 21:03:37', '2026-09-02 21:03:37'),
(14, 3, 17, '2026-09-02 21:05:35', '2026-09-02 21:05:35'),
(15, 3, 18, '2026-09-02 21:05:35', '2026-09-02 21:05:35'),
(16, 3, 19, '2026-09-02 21:05:35', '2026-09-02 21:05:35'),
(17, 10, 10, '2026-09-08 11:10:57', '2026-09-08 11:10:57'),
(18, 10, 13, '2026-09-08 11:10:57', '2026-09-08 11:10:57'),
(19, 6, 19, '2026-09-08 11:51:26', '2026-09-08 11:51:26'),
(23, 11, 5, '2026-09-10 19:51:42', '2026-09-10 19:51:42');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Assurance', '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(2, 'Epargne', '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(3, 'Crédit', '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(4, 'Emprunt', '2026-08-13 00:26:35', '2026-08-13 05:26:35'),
(5, 'Ventes', '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(6, 'Monetique', '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(7, 'Crédit', '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(8, 'Informatique', '2026-08-14 07:36:41', '2026-08-14 07:36:41');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2WYe8ILNCDohHjUs9XdikgFenMu00D5PKeQcqKVa', 15, '10.190.223.213', 'Mozilla/5.0 (Linux; Android 13; TECNO KJ5 Build/TP1A.220624.014; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/151.0.7922.199 Mobile Safari/537.36', 'eyJfdG9rZW4iOiJoYVBlSG5Gem1qc1REbWVseFUyVjJRM3hSZ3poZDNsR3FvNkFmSVBJIiwidXJsIjpbXSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEwLjE5MC4yMjMuMjk6ODA4MFwvcmVjbGFtYXRpb25zIiwicm91dGUiOiJyZWNsYW1hdGlvbnMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MTV9', 1789147126),
('7s0tsWCZxNjbDvLNoq9dsj6gGYVFOkOUGVn1cQ32', NULL, '10.190.223.213', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Mobile Safari/537.36', 'eyJfdG9rZW4iOiJ0UlNtMDNUbmVHdHo2TGtwZ0dlbWg5V25JT0F3eEpSQThISXNtTklKIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvMTAuMTkwLjIyMy4yOTo4MDgwXC9kYXNoYm9hcmQifSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEwLjE5MC4yMjMuMjk6ODA4MFwvbG9naW4iLCJyb3V0ZSI6ImxvZ2luIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1789147000),
('EmaQmoA2qGxTMr1BrUjTXApH8yOhRaPzNCqQSznV', 15, '10.190.223.213', 'Mozilla/5.0 (X11; Linux x86_64; rv:155.0) Gecko/20100101 Firefox/155.0', 'eyJfdG9rZW4iOiJFQnhJcTBtWVNMN2EzUGRDd2U1U3c1WlN5TWgzbXFCcTF2M3JXRVAyIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTAuMTkwLjIyMy4yOTo4MDgwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MTV9', 1789146893),
('mA7B4d5T1vd6NXwGsGIXJzyRqnna7xpCdVcfPuTn', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:155.0) Gecko/20100101 Firefox/155.0', 'eyJfdG9rZW4iOiJ0c05WM1FJemYzMjZON04xeExoZ2VqaDFIODJFUHY4Y0E4ZjNSV1YyIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL2xvZ2luIiwicm91dGUiOiJsb2dpbiJ9fQ==', 1789144660),
('q6ZWZoC5frCCTkBIB1VoyeBFu0VVOp5ZuxUhb3XG', 15, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:155.0) Gecko/20100101 Firefox/155.0', 'eyJfdG9rZW4iOiJwWnFmNzUzeURtODN6aEpTeW9FeFFBZ1BFeVVpZkdXeUpWeTF4WUZpIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL2NhdGVnb3JpZXMiLCJyb3V0ZSI6ImNhdGVnb3JpZXMuaW5kZXgifSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjE1fQ==', 1789144530),
('Qra1ZFpNHu7QbJeyiU0HVSSl4rVrC9hIHbSq24Wl', NULL, '10.190.223.29', 'Mozilla/5.0 (X11; Linux x86_64; rv:155.0) Gecko/20100101 Firefox/155.0', 'eyJfdG9rZW4iOiJPcU5sYVk5UDdrRXF1YmNtZzdjSXJQRjRHSmM3YURUTVh5Ymlld0JUIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTAuMTkwLjIyMy4yOTo4MDgwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifX0=', 1789148090),
('vnDkuidr3vsTj8EvFwCSrru7n8D2cXgyVAGcHZgU', 15, '10.190.223.29', 'Mozilla/5.0 (X11; Linux x86_64; rv:155.0) Gecko/20100101 Firefox/155.0', 'eyJfdG9rZW4iOiJuMEx5aE9KTDhiZmdNc0tlN2NocHlWVXp3YzJidXZKc0dxUjNUemlVIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEwLjE5MC4yMjMuMjk6ODA4MFwvY2xpZW50cyIsInJvdXRlIjoiY2xpZW50cy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxNX0=', 1789147670);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `is_personal` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `slug`, `is_personal`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Michelle Jerde\'s Team', 'bailey-murphy-and-haley', 1, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(2, 'Reece Moore\'s Team', 'hansen-zemlak-and-beatty', 1, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(3, 'Casimer Mayert\'s Team', 'mayer-krajcik-and-strosin', 1, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(4, 'Mrs. Myrtis Greenfelder Jr.\'s Team', 'schmeler-reinger-and-gutkowski', 1, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(5, 'Stuart Schuppe\'s Team', 'tillman-beier-and-smitham', 1, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(6, 'Prof. Cindy Prohaska\'s Team', 'lesch-and-sons', 1, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(7, 'Katlynn Hand DVM\'s Team', 'ziemann-group', 1, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(8, 'Katlynn Roberts II\'s Team', 'jones-rogahn', 1, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(9, 'Dr. Emmanuel Gutmann\'s Team', 'hansen-ltd', 1, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(10, 'Mr. Kamren Fahey I\'s Team', 'stokes-group', 1, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(11, 'Taylor Schiller\'s Team', 'ondricka-quitzon-and-kilback', 1, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(12, 'Geoffrey Stiedemann\'s Team', 'renner-kassulke', 1, '2026-08-12 20:26:35', '2026-08-12 20:26:35', NULL),
(13, 'Prof. Travis Osinski Jr.\'s Team', 'braun-ohara', 1, '2026-08-12 20:26:36', '2026-08-12 20:26:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `team_invitations`
--

CREATE TABLE `team_invitations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(64) NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `invited_by` bigint(20) UNSIGNED NOT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `accepted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`id`, `team_id`, `user_id`, `role`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'owner', '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(2, 2, 3, 'owner', '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(3, 3, 4, 'owner', '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(4, 4, 5, 'owner', '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(5, 5, 6, 'owner', '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(6, 6, 7, 'owner', '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(7, 7, 8, 'owner', '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(8, 8, 9, 'owner', '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(9, 9, 10, 'owner', '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(10, 10, 11, 'owner', '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(11, 11, 12, 'owner', '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(12, 12, 13, 'owner', '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(13, 13, 14, 'owner', '2026-08-12 20:26:36', '2026-08-12 20:26:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `role` enum('admin','agent','responsable') NOT NULL DEFAULT 'agent',
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `current_team_id`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `role`, `service_id`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@bgfigroupe.com', NULL, '$2y$12$5gSc2EbXLnmPyZCkJ1wxeu/Ky8LwK3SdKLLKpGVMsUqSjaPpPLKte', NULL, NULL, NULL, NULL, NULL, 'admin', NULL, '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(2, 'Michelle Jerde', 'mattie64@example.net', '2026-08-12 20:26:35', '$2y$12$tOiNDpBvjHdYcmu/edAaauJbtfYK.lPVeWnGEEFlVgoGAeTQbWLGy', 1, NULL, NULL, NULL, 'Clg8kuRiLi', 'responsable', 4, '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(3, 'Reece Moore', 'seichmann@example.com', '2026-08-12 20:26:35', '$2y$12$tOiNDpBvjHdYcmu/edAaauJbtfYK.lPVeWnGEEFlVgoGAeTQbWLGy', 2, NULL, NULL, NULL, 'HWSmL5PlpH', 'responsable', 4, '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(4, 'Casimer Mayert', 'xfay@example.net', '2026-08-12 20:26:35', '$2y$12$tOiNDpBvjHdYcmu/edAaauJbtfYK.lPVeWnGEEFlVgoGAeTQbWLGy', 3, NULL, NULL, NULL, 'wpM1K1iUG9', 'responsable', 4, '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(5, 'Mrs. Myrtis Greenfelder Jr.', 'zgrady@example.com', '2026-08-12 20:26:35', '$2y$12$tOiNDpBvjHdYcmu/edAaauJbtfYK.lPVeWnGEEFlVgoGAeTQbWLGy', 4, NULL, NULL, NULL, '2NCEfqzJh8', 'agent', 6, '2026-08-12 20:26:35', '2026-09-01 02:09:31'),
(6, 'Stuart Schuppe', 'herminia43@example.com', '2026-08-12 20:26:35', '$2y$12$tOiNDpBvjHdYcmu/edAaauJbtfYK.lPVeWnGEEFlVgoGAeTQbWLGy', 5, NULL, NULL, NULL, 'rug5UVrbTY', 'agent', 7, '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(7, 'Prof. Cindy Prohaska', 'arnulfo53@example.org', '2026-08-12 20:26:35', '$2y$12$tOiNDpBvjHdYcmu/edAaauJbtfYK.lPVeWnGEEFlVgoGAeTQbWLGy', 6, NULL, NULL, NULL, 'Fmmsnk5H6r', 'agent', 7, '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(8, 'Katlynn Hand DVM', 'iswift@example.com', '2026-08-12 20:26:35', '$2y$12$tOiNDpBvjHdYcmu/edAaauJbtfYK.lPVeWnGEEFlVgoGAeTQbWLGy', 7, NULL, NULL, NULL, 'gMfaWvfe0S', 'agent', 7, '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(9, 'Katlynn Roberts II', 'brendan57@example.net', '2026-08-12 20:26:35', '$2y$12$tOiNDpBvjHdYcmu/edAaauJbtfYK.lPVeWnGEEFlVgoGAeTQbWLGy', 8, NULL, NULL, NULL, '3N1w8KQ3og', 'agent', 7, '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(10, 'Dr. Emmanuel Gutmann', 'hobart89@example.net', '2026-08-12 20:26:35', '$2y$12$tOiNDpBvjHdYcmu/edAaauJbtfYK.lPVeWnGEEFlVgoGAeTQbWLGy', 9, NULL, NULL, NULL, 'KyGqVeiUoW', 'agent', 7, '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(11, 'Mr. Kamren Fahey I', 'boyle.kenyatta@example.com', '2026-08-12 20:26:35', '$2y$12$tOiNDpBvjHdYcmu/edAaauJbtfYK.lPVeWnGEEFlVgoGAeTQbWLGy', 10, NULL, NULL, NULL, 'SVuCXycCQU', 'agent', 7, '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(12, 'Taylor Schiller', 'alejandra.mayer@example.org', '2026-08-12 20:26:35', '$2y$12$tOiNDpBvjHdYcmu/edAaauJbtfYK.lPVeWnGEEFlVgoGAeTQbWLGy', 11, NULL, NULL, NULL, 'Srtis2FOui', 'agent', 7, '2026-08-12 20:26:35', '2026-08-12 20:26:35'),
(13, 'Geoffrey Stiedemann', 'swift.leonardo@example.com', '2026-08-12 20:26:35', '$2y$12$tOiNDpBvjHdYcmu/edAaauJbtfYK.lPVeWnGEEFlVgoGAeTQbWLGy', 12, NULL, NULL, NULL, 'tKXey5vwOZ', 'agent', 7, '2026-08-12 20:26:35', '2026-08-12 20:26:36'),
(14, 'Prof. Travis Osinski Jr.', 'eduardo74@example.net', '2026-08-12 20:26:35', '$2y$12$tOiNDpBvjHdYcmu/edAaauJbtfYK.lPVeWnGEEFlVgoGAeTQbWLGy', 13, NULL, NULL, NULL, 'cKhtiUCxJy', 'agent', 7, '2026-08-12 20:26:35', '2026-08-12 20:26:36'),
(15, 'SUDO', 'sudo@bgfigroupe.com', NULL, '$2y$12$ZtPI9FEW63BLJvhvaVHbV.kh5UiEFdeoQkjYZU2VOOtF191f/sd7m', NULL, NULL, NULL, NULL, NULL, 'admin', 8, '2026-08-12 20:32:11', '2026-08-12 20:32:11'),
(17, 'Agent Test', 'agent0@bgfigroupe.com', NULL, '$2y$12$4lx13PNzeLiCI6Aq7sxPne6RklMvIJaWcK5fKDEMzV0mnGl5/9QoW', NULL, NULL, NULL, NULL, NULL, 'agent', 8, '2026-08-27 13:30:24', '2026-08-27 13:30:24'),
(18, 'Agent Test 2', 'agent1@bgfigroupe.com', NULL, '$2y$12$wQ0eWY4R7ZCw.U0FFYfcIOLi1mywGiYMJVQhxp5Ov9W6CuHHrM.im', NULL, NULL, NULL, NULL, NULL, 'agent', 8, '2026-08-30 00:37:40', '2026-08-30 00:37:40'),
(19, 'RESPO', 'responsable@bgfigroupe.com', NULL, '$2y$12$cUs1/XNGaRvo3As/oUvs1.Yx/smvHeXQBWjK/vvpdwkt6zl5HFmdK', NULL, NULL, NULL, NULL, NULL, 'responsable', 8, '2026-09-01 01:45:14', '2026-09-01 01:45:14'),
(20, 'Respo', 'respo@bgfigroupe.com', NULL, '$2y$12$t881Mc55UcM6FSfTXgQCQ.ZMWMHMEIfVv/BGW25sMzjhrA89MB1Ta', NULL, NULL, NULL, NULL, NULL, 'responsable', 5, '2026-09-09 15:27:52', '2026-09-09 15:27:52'),
(21, 'Agent', 'agent@bgfigroupe.com', NULL, '$2y$12$iOMi.Kt6YCSOOdz4Dq36xeCT1npkcnnxLUMIweWopHEl1GRFEo06S', NULL, NULL, NULL, NULL, NULL, 'agent', 4, '2026-09-09 15:33:12', '2026-09-09 15:33:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agences`
--
ALTER TABLE `agences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_email_unique` (`email`),
  ADD KEY `clients_agence_id_foreign` (`agence_id`);

--
-- Indexes for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commentaires_reclamation_id_foreign` (`reclamation_id`),
  ADD KEY `commentaires_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `historiques`
--
ALTER TABLE `historiques`
  ADD PRIMARY KEY (`id`),
  ADD KEY `historiques_id_reclam_foreign` (`id_reclam`),
  ADD KEY `historiques_id_user_foreign` (`id_user`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `passkeys`
--
ALTER TABLE `passkeys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `passkeys_credential_id_unique` (`credential_id`),
  ADD KEY `passkeys_user_id_index` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `priorites`
--
ALTER TABLE `priorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reclamations`
--
ALTER TABLE `reclamations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reclamations_numero_unique` (`numero`),
  ADD KEY `reclamations_client_id_foreign` (`client_id`),
  ADD KEY `reclamations_categorie_id_foreign` (`categorie_id`),
  ADD KEY `reclamations_priorite_id_foreign` (`priorite_id`),
  ADD KEY `reclamations_service_id_foreign` (`service_id`),
  ADD KEY `reclamations_user_id_foreign` (`user_id`);

--
-- Indexes for table `reclamation_user`
--
ALTER TABLE `reclamation_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reclamation_user_reclamation_id_foreign` (`reclamation_id`),
  ADD KEY `reclamation_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teams_slug_unique` (`slug`);

--
-- Indexes for table `team_invitations`
--
ALTER TABLE `team_invitations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_invitations_code_unique` (`code`),
  ADD KEY `team_invitations_team_id_foreign` (`team_id`),
  ADD KEY `team_invitations_invited_by_foreign` (`invited_by`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_members_team_id_user_id_unique` (`team_id`,`user_id`),
  ADD KEY `team_members_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_current_team_id_foreign` (`current_team_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agences`
--
ALTER TABLE `agences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `historiques`
--
ALTER TABLE `historiques`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `passkeys`
--
ALTER TABLE `passkeys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `priorites`
--
ALTER TABLE `priorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reclamations`
--
ALTER TABLE `reclamations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reclamation_user`
--
ALTER TABLE `reclamation_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `team_invitations`
--
ALTER TABLE `team_invitations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_agence_id_foreign` FOREIGN KEY (`agence_id`) REFERENCES `agences` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_reclamation_id_foreign` FOREIGN KEY (`reclamation_id`) REFERENCES `reclamations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `commentaires_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `historiques`
--
ALTER TABLE `historiques`
  ADD CONSTRAINT `historiques_id_reclam_foreign` FOREIGN KEY (`id_reclam`) REFERENCES `reclamations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `historiques_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `passkeys`
--
ALTER TABLE `passkeys`
  ADD CONSTRAINT `passkeys_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reclamations`
--
ALTER TABLE `reclamations`
  ADD CONSTRAINT `reclamations_categorie_id_foreign` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reclamations_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reclamations_priorite_id_foreign` FOREIGN KEY (`priorite_id`) REFERENCES `priorites` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reclamations_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reclamations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `reclamation_user`
--
ALTER TABLE `reclamation_user`
  ADD CONSTRAINT `reclamation_user_reclamation_id_foreign` FOREIGN KEY (`reclamation_id`) REFERENCES `reclamations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reclamation_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `team_invitations`
--
ALTER TABLE `team_invitations`
  ADD CONSTRAINT `team_invitations_invited_by_foreign` FOREIGN KEY (`invited_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `team_invitations_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `team_members`
--
ALTER TABLE `team_members`
  ADD CONSTRAINT `team_members_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `team_members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_current_team_id_foreign` FOREIGN KEY (`current_team_id`) REFERENCES `teams` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
