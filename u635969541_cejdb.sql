-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 16, 2025 at 10:55 AM
-- Server version: 10.11.10-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u635969541_cejdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `donor_id` bigint(20) UNSIGNED NOT NULL,
  `donation_type` varchar(255) NOT NULL,
  `donation_amount` decimal(15,2) NOT NULL,
  `donation_currency` varchar(255) NOT NULL,
  `transaction_token` varchar(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `company_ref` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Submitted',
  `ccd_approval` varchar(255) DEFAULT NULL,
  `pnr_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `donor_id`, `donation_type`, `donation_amount`, `donation_currency`, `transaction_token`, `transaction_id`, `company_ref`, `status`, `ccd_approval`, `pnr_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'once', 10.00, 'ZMW', '0363DA23-F90F-44D6-B75B-AE21F4118914', 'R65368138', 'EA461', 'Submitted', NULL, NULL, '2025-02-18 11:21:52', '2025-02-18 11:21:52'),
(2, 1, 'recurring', 10.00, 'ZMW', 'A2F8CDE4-BA3B-49D8-A432-E83576C01D8F', 'R65368326', '870E0', 'Submitted', NULL, NULL, '2025-02-18 11:29:04', '2025-02-18 11:29:04'),
(3, 1, 'once', 10.00, 'ZMW', 'C43416DD-6AD8-4090-92D5-E2BAEB554B17', 'R65368639', '482D5', 'Submitted', NULL, NULL, '2025-02-18 11:41:39', '2025-02-18 11:41:39'),
(4, 1, 'once', 10.00, 'ZMW', '3B427FA8-860E-4C6E-9191-5386EF491FBC', 'R65368744', '8EB06', 'Submitted', NULL, NULL, '2025-02-18 11:45:24', '2025-02-18 11:45:24'),
(5, 1, 'monthly', 1.00, 'ZMW', '2A586C65-4EA6-4C35-B9A5-B466015F88DF', 'R65369540', 'C6817', 'Submitted', NULL, NULL, '2025-02-18 12:12:48', '2025-02-18 12:12:48'),
(6, 1, 'monthly', 1.00, 'ZMW', '98C5E7D7-C6CF-4F14-87DA-D535D2550B90', '98C5E7D7-C6CF-4F14-87DA-D535D2550B90', 'DONA1E52', 'completed', '6513592998', NULL, '2025-02-18 12:16:19', '2025-02-18 12:39:49'),
(7, 2, 'recurring', 10.00, 'ZMW', '11E3D63F-37F3-46E3-9B1D-E87425EEE600', 'R65468121', 'F6419', 'Submitted', NULL, NULL, '2025-02-21 17:18:32', '2025-02-21 17:18:32'),
(40, 17, 'once', 1.00, 'ZMW', '66C9057D-B88D-43DA-9E49-661FBB8612DC', 'R65495606', 'F2637', 'Submitted', NULL, NULL, '2025-02-22 18:02:41', '2025-02-22 18:02:41'),
(41, 18, 'recurring', 1.00, 'ZMW', '14DEA0DE-E2F4-4199-9347-D5F87DF9CFD4', 'R65495839', '65BE3', 'Submitted', NULL, NULL, '2025-02-22 18:13:07', '2025-02-22 18:13:07'),
(42, 19, 'once', 1.00, 'ZMW', '76DCCA46-498F-4A3E-A6B9-213E8A707CA7', 'R65496347', 'F4DBE', 'Submitted', NULL, NULL, '2025-02-22 18:41:14', '2025-02-22 18:41:14'),
(43, 20, 'once', 1.00, 'ZMW', '3FB1323B-CD6F-47BC-8F7C-93EB8806E800', 'R65496581', 'B53D0', 'Submitted', NULL, NULL, '2025-02-22 18:53:39', '2025-02-22 18:53:39'),
(44, 20, 'once', 1.00, 'ZMW', '82F9EFCB-87AE-4454-BE21-888A9021B3A6', 'R65496633', '8192D', 'Submitted', NULL, NULL, '2025-02-22 18:56:46', '2025-02-22 18:56:46'),
(45, 21, 'once', 1.00, 'ZMW', 'A88AA176-576C-409A-A57E-778ABAB04686', 'R65496776', 'FA9CC', 'Submitted', NULL, NULL, '2025-02-22 19:03:44', '2025-02-22 19:03:44'),
(46, 22, 'once', 1.00, 'ZMW', '32483521-4451-40AD-9915-5D2BE77B7B4B', 'R65608869', '9282D', 'Submitted', NULL, NULL, '2025-02-26 13:04:36', '2025-02-26 13:04:36'),
(47, 23, 'once', 10.00, 'USD', '3432A85A-5773-4BBD-BF31-B865ED9B3196', 'R65608913', '299F2', 'Submitted', NULL, NULL, '2025-02-26 13:05:54', '2025-02-26 13:05:54'),
(48, 24, 'once', 1.00, 'ZMW', '1A69D342-A81F-4815-B18B-1F3F74E2A17D', 'R65832117', 'C81B3', 'Submitted', NULL, NULL, '2025-03-05 08:44:18', '2025-03-05 08:44:18'),
(49, 25, 'recurring', 1.00, 'ZMW', 'DBF2772D-776D-4828-8047-5D6E3279BCCF', 'R66210146', 'BD654', 'Submitted', NULL, NULL, '2025-03-17 12:44:35', '2025-03-17 12:44:35'),
(50, 26, 'once', 1.00, 'ZMW', '75BE8F5A-5970-4697-AA4D-0F7AAE8FB4FF', 'R66210947', 'D69A7', 'Submitted', NULL, NULL, '2025-03-17 13:12:10', '2025-03-17 13:12:10'),
(51, 1, 'monthly', 10.00, 'ZMW', '0C5B7DF6-B4EA-4C1D-B015-B5CEB10AE357', 'R67555578', '85EDA', 'Submitted', NULL, NULL, '2025-04-29 09:45:10', '2025-04-29 09:45:10'),
(52, 1, 'recurring', 1.00, 'ZMW', 'CE62A973-019A-4320-947D-27208BF2EFA7', 'R67555599', '6E1E0', 'completed', NULL, NULL, '2025-04-29 09:46:14', '2025-04-29 09:48:12'),
(53, 27, 'once', 1.00, 'ZMW', '95368A10-E031-44F2-BB17-70D2DDE1613F', 'R68057242', '59632', 'completed', NULL, NULL, '2025-05-15 09:41:38', '2025-05-15 09:47:13'),
(54, 27, 'once', 1.00, 'ZMW', '1B23073D-FBFC-40E7-905A-75305447A90C', 'R68057809', '357B4', 'Submitted', NULL, NULL, '2025-05-15 09:59:43', '2025-05-15 09:59:43'),
(55, 1, 'once', 1.00, 'ZMW', 'E166E61A-F2A6-484A-879F-6B288C4E6FCA', 'R68058142', 'E9150', 'Submitted', NULL, NULL, '2025-05-15 10:09:21', '2025-05-15 10:09:21'),
(56, 1, 'once', 1.00, 'ZMW', '7AD61D89-E9F5-4A43-8DE4-489D5698B4F3', 'R68058623', '206E0', 'Submitted', NULL, NULL, '2025-05-15 10:23:40', '2025-05-15 10:23:40'),
(57, 1, 'once', 1.00, 'ZMW', 'CE8B4D5A-19B6-42F1-87EA-D4A8A386C8A9', 'R68059012', 'FF823', 'Submitted', NULL, NULL, '2025-05-15 10:34:27', '2025-05-15 10:34:27'),
(58, 27, 'once', 1.00, 'ZMW', '868B691B-8CE7-4C59-8886-175DE1B88FD2', 'R68059180', '02276', 'Submitted', NULL, NULL, '2025-05-15 10:39:09', '2025-05-15 10:39:09'),
(59, 27, 'once', 1.00, 'ZMW', '7E5DA81B-69B0-454A-B56F-56EAE657906B', 'R68059222', '9A9B2', 'Submitted', NULL, NULL, '2025-05-15 10:40:25', '2025-05-15 10:40:25'),
(60, 27, 'once', 1.00, 'ZMW', '9572EEA4-F4F4-49AF-898D-56EF8778F2A4', 'R68059824', '701CD', 'Submitted', NULL, NULL, '2025-05-15 10:56:25', '2025-05-15 10:56:25'),
(61, 1, 'recurring', 1.00, 'ZMW', '930702EB-F7CB-4571-BED0-391E4F87D85F', '930702EB-F7CB-4571-BED0-391E4F87D85F', '', 'completed', '314327', NULL, '2025-05-15 11:05:18', '2025-05-15 11:07:02'),
(62, 27, 'once', 1.00, 'ZMW', '7151527E-BC43-4DE1-B0C4-05E4E395B883', '7151527E-BC43-4DE1-B0C4-05E4E395B883', '', 'completed', '315595', NULL, '2025-05-15 11:11:58', '2025-05-15 11:15:06');

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `organization_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`id`, `email`, `first_name`, `last_name`, `address`, `phone_number`, `organization_name`, `created_at`, `updated_at`) VALUES
(1, 'katongobupe444@gmail.com', 'Bupe Katongo', '', '4605 PAMODZI ROAD, PAMODZI, NDOLA, COPPERBELT PROVINCE, ZAMBIA', '', 'PIKO TECHNOLOGY SERVICES', '2025-02-18 11:21:52', '2025-02-18 11:21:52'),
(2, 'bopyq@mailinator.com', 'Susan Vinson', '', 'Aute esse alias volu', '', 'Roberson and Woods Associates', '2025-02-21 17:18:32', '2025-02-21 17:18:32'),
(3, 'wodepekera@mailinator.com', 'Erich Santana', '', 'Odit quos aut ut rep', '', 'Haley and Mercado Plc', '2025-02-21 17:27:03', '2025-02-21 17:27:03'),
(4, 'nivyrepehy@mailinator.com', 'Finn Acevedo', '', 'Qui consequatur reru', '', 'Gonzales Montgomery Inc', '2025-02-21 17:52:43', '2025-02-21 17:52:43'),
(5, 'biled@mailinator.com', 'Cynthia Frost', '', 'Quia qui et dolores', '', 'Kramer and Stevens Inc', '2025-02-21 17:58:53', '2025-02-21 17:58:53'),
(6, 'rumoloce@mailinator.com', 'Reece Castro', '', 'Velit consequuntur h', '', 'Castaneda and Goff Trading', '2025-02-21 18:06:44', '2025-02-21 18:06:44'),
(7, 'cicevy@mailinator.com', 'Joy Walton', '', 'Sit quo pariatur Qu', '', 'Dyer and Sampson Inc', '2025-02-21 18:28:37', '2025-02-21 18:28:37'),
(8, 'xawyqo@mailinator.com', 'Kiayada Raymond', '', 'Doloremque neque est', '', 'Rosario and Ross Plc', '2025-02-21 18:33:14', '2025-02-21 18:33:14'),
(9, 'sywib@mailinator.com', 'Clementine Norris', '', 'Vel aut non iure et', '', 'Mitchell and Allen Associates', '2025-02-21 18:37:55', '2025-02-21 18:37:55'),
(10, 'guky@mailinator.com', 'Solomon Kirkland', '', 'Cillum optio ipsum', '', 'Mcconnell and Phelps Traders', '2025-02-21 18:42:43', '2025-02-21 18:42:43'),
(11, 'jycef@mailinator.com', 'Zoe Sweet', '', 'Iste minus dolor aut', '', 'Garner and Larsen Co', '2025-02-21 18:58:00', '2025-02-21 18:58:00'),
(12, 'cidybovazy@mailinator.com', 'Jared Robinson', '', 'Dolores expedita eum', '', 'Petty and Barrera Trading', '2025-02-22 08:09:14', '2025-02-22 08:09:14'),
(13, 'hujolem@mailinator.com', 'Daryl Alston', '', 'Assumenda quo eum el', '', 'Potter and Leblanc Traders', '2025-02-22 08:40:13', '2025-02-22 08:40:13'),
(14, 'verunixima@mailinator.com', 'Shea Dotson', '', 'Aute ut et quibusdam', '', 'Parrish Middleton Inc', '2025-02-22 08:46:22', '2025-02-22 08:46:22'),
(15, 'luroqy@mailinator.com', 'Hakeem Clemons', '', 'Ea reiciendis quo su', '', 'Riggs and Pope Co', '2025-02-22 08:49:23', '2025-02-22 08:49:23'),
(16, 'tysutasut@mailinator.com', 'Rigel Farmer', '', 'Vel duis dolorem acc', '', 'Bell Daniel Inc', '2025-02-22 13:52:37', '2025-02-22 13:52:37'),
(17, 'lafo@mailinator.com', 'Indira Carroll', '', 'Irure nulla repudian', '', 'Shaffer Vaughan Plc', '2025-02-22 18:02:41', '2025-02-22 18:02:41'),
(18, 'rihad@mailinator.com', 'Dalton Haynes', '', 'Officiis delectus c', '', 'Hodges and Vang Associates', '2025-02-22 18:13:07', '2025-02-22 18:13:07'),
(19, 'zabome@mailinator.com', 'Tara Molina', '', 'Vero officia animi', '', 'Mitchell and Vincent Trading', '2025-02-22 18:41:14', '2025-02-22 18:41:14'),
(20, 'nuhasubok@mailinator.com', 'Dustin Stout', '', 'Ullam et molestiae r', '', 'Hahn Benton Inc', '2025-02-22 18:53:39', '2025-02-22 18:53:39'),
(21, 'kagegy@mailinator.com', 'Amena Bass', '', 'Enim voluptas et qua', '', 'Levy Hebert Traders', '2025-02-22 19:03:44', '2025-02-22 19:03:44'),
(22, 'piko@zambia.com', 'BUpe', '', '12344', '', 'Piko', '2025-02-26 13:04:36', '2025-02-26 13:04:36'),
(23, 'falesiembewe@gmail.com', 'Falesi Mbewe', '', 'Kamwala South', '', 'ZSLI', '2025-02-26 13:05:54', '2025-02-26 13:05:54'),
(24, 'kyvade@mailinator.com', 'Calista Lang', '', 'Necessitatibus est', '', 'Wilkerson and Rhodes Co', '2025-03-05 08:44:18', '2025-03-05 08:44:18'),
(25, 'dymoroqyr@mailinator.com', 'Brielle Schneider', '', 'Non quidem alias sim', '', 'Gilliam Goodman LLC', '2025-03-17 12:44:35', '2025-03-17 12:44:35'),
(26, 'bupe@tradesmartzm.com', 'Sean Cleveland', '', 'Plot 10, DBZ Second floor', '', 'Tradesmart Supplies Limited', '2025-03-17 13:12:10', '2025-03-17 13:12:10'),
(27, 'developer.cej@gmail.com', 'Falesi Mbewe', '', 'Kamwala South', '', 'Centre for Environment Justice', '2025-05-15 09:41:38', '2025-05-15 09:41:38');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
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
(4, '2025_02_08_142004_create_personal_access_tokens_table', 1),
(5, '2025_02_18_072739_create_donors_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('Ae2we2sN5p8iiig531zmA5lgP1M9UkLZs0Pv2YN6', NULL, '2a02:4780:b:7::9', 'Go-http-client/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSlpmckdwTllFd00zMTJsS3FxSWp4NkpNRlJCRGRndmIwcnkzc3ZrdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vZG9uYXRlLmNlanphbWJpYS5vcmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1746955142),
('atL8i9sSY3BeEKtGA53rFfPA0JVFMAU5aIpVQ232', NULL, '66.249.77.77', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.7103.59 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOVRLQXBmVHE3bDN0UVk1cmFPdUNwaUVmTk55YUs3ZVhGRUF1OFQyMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vZG9uYXRlLmNlanphbWJpYS5vcmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1746943788),
('bP3REhpqMViuSKNn7613REUrdLUNPgL5NZ18H6B0', NULL, '2a02:4780:b:7::9', 'Go-http-client/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQk8wVnB4RmV5SlJDaEpBOFdvdVFiSTJHZGpYQU9qbmlmMUJmZEFqbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vZG9uYXRlLmNlanphbWJpYS5vcmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1747195968),
('DuZmsKfjbW31UK1iqbyrZRdVbUVXmVCDQViXzePa', NULL, '2a03:2880:f806:15::', 'meta-externalagent/1.1 (+https://developers.facebook.com/docs/sharing/webmasters/crawler)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidTBHeUFZa0x0ZmFyUlZkamdPSWl3emp3MWZGZXhoa1hqS1pGSkhXRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vZG9uYXRlLmNlanphbWJpYS5vcmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1747317187),
('EOvPzXy6P0gAw64Z3Blfazc73xeXxOpJocdwW5SO', NULL, '2a05:d014:2ad:5700:8a03:27f3:960d:2a24', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Edge/120.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMmR5RllnSUVFS0hMSEtnNGxxMWNuVG1YcEhzb3g2U21SN05RTzRIaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vZG9uYXRlLmNlanphbWJpYS5vcmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1746902844),
('I4Ud0ij10ijdkwYUV7PXd10hOa4F6M9QM6QZUNRw', 2, '41.223.119.44', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieFhXMmJTMEVTakdNQlpXUDM2MjlKSmpHRXltV1l0Q01wTDN1dzQwZyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDY6Imh0dHBzOi8vZG9uYXRlLmNlanphbWJpYS5vcmcvZGFzaGJvYXJkL3JlcG9ydHMiO31zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjM4OiJodHRwczovL2RvbmF0ZS5jZWp6YW1iaWEub3JnL2Rhc2hib2FyZCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1747308139),
('JGdTuwaCAWKsf2TABuaBc6oaa1Z9fNzBJ4TfWKaH', NULL, '2a02:4780:b:7::9', 'Go-http-client/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUmEyR2RRanJRM1VhM2J1QVY2aTMza3NPaGpwRjZ2Zks0TkM5REQ4MiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vZG9uYXRlLmNlanphbWJpYS5vcmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1747113727),
('kDsX0q8sIhfVAUkfhZpXy36ScMnn3cTLAImXY1jx', NULL, '66.249.66.192', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.7103.92 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidHZHWGN0bWpvbUpSMVBuMVZwdUNlUVdWUjloY2xKZTJYU1c0TXJKMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vZG9uYXRlLmNlanphbWJpYS5vcmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1747360279),
('kl9ciQIfiNnTmhHaneJGUSaGvO0JTJUp3sXqsrqB', NULL, '2a05:d014:2ad:5700:8a03:27f3:960d:2a24', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZDlqeVJWQVI2WDRJeHU5MDRaV2tpbE1VUlo5bzdPTjFIeHJDYlVPbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vZG9uYXRlLmNlanphbWJpYS5vcmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1746968813),
('m3v3HMuxI5bQD1WnhDjdI1fHHrkg94Q2p1xH3EZg', NULL, '66.249.66.33', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.7103.92 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibFdKTEFTVzhSaE1xOHVpTEZVSFBObUk5MWo0R1BJOGNJWktONG9BSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vZG9uYXRlLmNlanphbWJpYS5vcmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1747102579),
('Mq1xAvl7K2E5e7UEEQql6B8prPw3vbAQ4UmiTmXl', NULL, '2a05:d014:2ad:5700:8a03:27f3:960d:2a24', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:123.0) Gecko/20100101 Firefox/123.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaHpaaXRHajRwNXBYWk85NVFYNGdtTTUxVGpDYVhoaHJhaU1tS2hwMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vZG9uYXRlLmNlanphbWJpYS5vcmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1746969455),
('OAVNjUJa8pPf6KfdbrflW468nQQrT0iHmHw1fSd3', NULL, '2c0f:2a80:2530:a410:edd9:e748:4b3a:e12a', 'WhatsApp/2.2518.3 W', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQmFYMEh0VGw2SjJtZjVHVTRZdm5PaTNJNkZyS1BiTTREeGxqaHo4ayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vZG9uYXRlLmNlanphbWJpYS5vcmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1747307835),
('PhINQqpfwRBgaY3WYwxellpyXBbssbqNRr0PRDXj', NULL, '2a02:4780:b:7::9', 'Go-http-client/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTmlpQ2o3QllWYktTd21DcHpabk94d2l6OTFSRXZwdWhjM0JUejlxbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vZG9uYXRlLmNlanphbWJpYS5vcmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1747310706),
('PKGwdJiW7DLMpQLr2OFmRX7j9Y0XHVuurWuQAFhw', NULL, '2a05:d014:2ad:5700:8a03:27f3:960d:2a24', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:123.0) Gecko/20100101 Firefox/123.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidjRhQzNBWm1Vcnp0cVFmc0VpTWR5TGFRblRaekMyODhrWHFSejdZVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vZG9uYXRlLmNlanphbWJpYS5vcmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1746884568),
('ROG61Gm3LW1hG1oJSdoOi46xJu33EJiILd4lq7GM', NULL, '44.234.27.155', 'Mozilla/5.0 (compatible; wpbot/1.3; +https://forms.gle/ajBaxygz9jSR8p8G9)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRlk5WUFWSTVQcEtZbVUwTGdQRkkwUmR5Mm1ya3JON0ZaMnBQc0poayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vZG9uYXRlLmNlanphbWJpYS5vcmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1747167651),
('rWHBTZHX5zdCng3fE98odbxzKVqBjwc1opCfU0Cx', NULL, '174.138.64.5', 'Mozilla/5.0 (X11; Linux x86_64; rv:136.0) Gecko/20100101 Firefox/136.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoialNIMGFZdFgzR3RBb0gzSzBuR0tobUdRc3BnWlg5SkFWVjEwN3lYOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vZG9uYXRlLmNlanphbWJpYS5vcmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1746874544),
('sf7m48gVc9sNC9WCEHZpPcapn1Tbbqk45cgn5Dra', NULL, '102.212.182.17', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVjQ3dXkxRVJ5ZkR2aUxha0kxR2FWMVhUbDhEd3Y0VjVZZFhpdG5DYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vZG9uYXRlLmNlanphbWJpYS5vcmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1746877061),
('T5VDKlIpTrVo9ODSIvsSnppbaJT5QvbVEAKG71IX', NULL, '2a02:4780:b:7::9', 'Go-http-client/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaFNPUUVEZko5WVZJU2JqdktkZU85UnZwaVZuYXpyNm5Jdkt6RGF3SSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vZG9uYXRlLmNlanphbWJpYS5vcmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1747031422),
('T7WbYnJgsInLHdcqPrrbhBBA98bmoMRJ7RWbs0Ni', NULL, '104.152.52.55', 'curl/7.61.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOXBRS0wwQktSNkZwT3NtUDVOdjBMa25rMnNmbUhkREpzZVBGVFFjTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vZG9uYXRlLmNlanphbWJpYS5vcmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1747071549),
('TNiUDdIfrPZ4h9mY5kB4EjooJkEB1EcrIilD4hx0', NULL, '2a05:d014:2ad:5700:8a03:27f3:960d:2a24', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNWlXVDZRalQ3UWlZanJjM3E4Vlc3Z0ltbGtweUoydjh2MVFHajljSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vZG9uYXRlLmNlanphbWJpYS5vcmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1747056967),
('WPmNY1KWpRcAaDSJ1k6M0E9ri7hFrh3nAiYXkBGR', NULL, '2c0f:2a80:2530:a410:edd9:e748:4b3a:e12a', 'WhatsApp/2.2518.3 W', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWlI4QUFVa2I1SlJNTnVJUmp6SXhQTVlFMzhzVDl2OUdFWFlVcE94TiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozODoiaHR0cHM6Ly9kb25hdGUuY2VqemFtYmlhLm9yZy9kYXNoYm9hcmQiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozOToiaHR0cHM6Ly9kb25hdGUuY2VqemFtYmlhLm9yZy9hdXRoL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1747307839),
('xQRUccj0zCP1F6uEtXcAhAbFyFHV8Es2mt7Kkkfp', NULL, '54.170.110.170', 'Mozilla/5.0 (compatible; NetcraftSurveyAgent/1.0; +info@netcraft.com)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNTk1Qk1DR3FCNXBKczd1TmQ2NUtrSE0yNnBlMTJSVUlTZ2pYMVpOeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vZG9uYXRlLmNlanphbWJpYS5vcmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1747238277),
('XRCo6uXkUrHGpuOQu7OdiUJVyby4vr7V3iOx2I5O', NULL, '2c0f:2a80:2530:a410:edd9:e748:4b3a:e12a', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN1NtYkVCWExXQ2ZpMU96dWFuTlpkbWQwZlVSNDZVUWVxYzlONlpsYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHBzOi8vZG9uYXRlLmNlanphbWJpYS5vcmcvYXV0aC9yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6Mzg6Imh0dHBzOi8vZG9uYXRlLmNlanphbWJpYS5vcmcvZGFzaGJvYXJkIjt9fQ==', 1747307974),
('xu6YmFmcpgfkuSDFhHOMch2gZuSw7zVExmO2Oh7K', NULL, '2a02:4780:b:7::9', 'Go-http-client/2.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSThqQWxhZjNhNm9mRmR4dk1yNnVyQkVZYks1cXpBbmZUcnFKdU9XaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vZG9uYXRlLmNlanphbWJpYS5vcmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1747368856),
('YVlXdKbUsWovdZgsB4URyeEk0TFLG4eIzQX9b99K', NULL, '2c0f:2a80:2530:a410:edd9:e748:4b3a:e12a', 'WhatsApp/2.2518.3 W', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibHowRG80RFJPUTNiZnlhbzNvS2ZNeHdmQkx6ZHZuZlZxcmlZYUlnUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHBzOi8vZG9uYXRlLmNlanphbWJpYS5vcmcvYXV0aC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1747307832),
('Zt243MIcY2WtGqmhAY93CN66xyf7ANYhpkrrIhQX', NULL, '107.174.244.108', 'Mozilla/5.0 (X11; Linux x86_64; rv:132.0) Gecko/20100101 Firefox/132.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib2pZNkZFSzQwSnVvNWFoQmp6UUhQbUI4Z0R4SUgyRU1uTDB3S2lZWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHBzOi8vZG9uYXRlLmNlanphbWJpYS5vcmciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1746935288);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `position`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Bupe', 'Katongo', NULL, 'user', 'katongobupe444@gmail.com', NULL, '$2y$12$edgXnbL/d37u8tewIWKdreCcvYdwkc1Gt/.qo3kWc2HFNncCNguqe', NULL, '2025-02-18 14:26:53', '2025-02-24 18:02:09'),
(2, 'CEJ', 'Zambia', NULL, 'user', 'developer.cej@gmail.com', NULL, '$2y$12$XGOHOoCOh7bAXwpOYHmiMu9HsiDoKmm1JQH8iNWEFyeUA8wM37zfe', NULL, '2025-02-25 10:03:58', '2025-02-25 10:03:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
