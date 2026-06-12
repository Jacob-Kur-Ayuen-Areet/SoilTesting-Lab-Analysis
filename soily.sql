-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2026 at 12:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soily`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `city_name` varchar(255) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `country_id`, `city_name`, `district_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'City Name', 1, '2023-07-14 09:11:44', '2023-07-14 09:11:44'),
(2, 1, 'City Name', 1, '2023-07-14 09:11:45', '2023-07-14 09:11:45'),
(3, 1, 'City Name', 1, '2023-07-14 09:18:28', '2023-07-14 09:18:28'),
(4, 1, 'City Name', 1, '2023-07-14 09:49:58', '2023-07-14 09:49:58'),
(5, 1, 'City Name', 1, '2023-07-14 09:50:15', '2023-07-14 09:50:15'),
(6, 1, 'City Name', 1, '2023-07-14 09:51:25', '2023-07-14 09:51:25'),
(7, 1, 'City Name', 1, '2023-07-14 09:52:44', '2023-07-14 09:52:44'),
(8, 1, 'City Name', 1, '2023-07-14 09:56:07', '2023-07-14 09:56:07'),
(9, 1, 'City Name', 1, '2023-07-14 09:56:38', '2023-07-14 09:56:38'),
(10, 1, 'City Name', 1, '2023-07-14 09:57:25', '2023-07-14 09:57:25'),
(11, 1, 'City Name', 1, '2023-07-14 09:58:06', '2023-07-14 09:58:06'),
(12, 1, 'City Name', 1, '2023-07-14 09:58:40', '2023-07-14 09:58:40'),
(13, 1, 'City Name', 1, '2023-07-14 09:59:15', '2023-07-14 09:59:15');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'Zimbabwe', 263, '2023-07-14 09:11:44', '2023-07-14 09:11:44');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `district_name` varchar(255) DEFAULT NULL,
  `province_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`district_id`, `district_name`, `province_id`, `created_at`, `updated_at`) VALUES
(776, 'Harare', 43, NULL, NULL),
(777, 'Buhera', 47, NULL, NULL),
(778, 'Chimanimani', 47, NULL, NULL),
(779, 'Chipinge', 47, NULL, NULL),
(780, 'Makoni', 47, NULL, NULL),
(781, 'Mutare', 47, NULL, NULL),
(782, 'Mutasa', 47, NULL, NULL),
(783, 'Nyanga', 47, NULL, NULL),
(784, 'Bindura', 38, NULL, NULL),
(785, 'Guruve', 38, NULL, NULL),
(786, 'Mazowe', 38, NULL, NULL),
(787, 'Mbire', 38, NULL, NULL),
(788, 'Mukumbura', 38, NULL, NULL),
(789, 'Muzarabani', 38, NULL, NULL),
(790, 'Rushinga', 38, NULL, NULL),
(791, 'Shamva', 38, NULL, NULL),
(792, 'Chikomba', 45, NULL, NULL),
(793, 'Goromonzi', 45, NULL, NULL),
(794, 'Hwedza (Wedza)', 45, NULL, NULL),
(795, 'Marondera', 45, NULL, NULL),
(796, 'Mudzi', 45, NULL, NULL),
(797, 'Murehwa', 45, NULL, NULL),
(798, 'Mutoko', 45, NULL, NULL),
(799, 'Seke', 45, NULL, NULL),
(800, 'Uzumba-Maramba-Pfungwe', 45, NULL, NULL),
(801, 'Chegutu', 40, NULL, NULL),
(802, 'Hurungwe', 40, NULL, NULL),
(803, 'Kadoma', 40, NULL, NULL),
(804, 'Kariba', 40, NULL, NULL),
(805, 'Makonde', 40, NULL, NULL),
(806, 'Zvimba', 40, NULL, NULL),
(807, 'Bikita', 46, NULL, NULL),
(808, 'Chiredzi', 46, NULL, NULL),
(809, 'Chivi', 46, NULL, NULL),
(810, 'Gutu', 46, NULL, NULL),
(811, 'Masvingo', 46, NULL, NULL),
(812, 'Mwenezi', 46, NULL, NULL),
(813, 'Zaka', 46, NULL, NULL),
(814, 'Binga', 44, NULL, NULL),
(815, 'Bubi', 44, NULL, NULL),
(816, 'Hwange', 44, NULL, NULL),
(817, 'Lupane', 44, NULL, NULL),
(818, 'Nkayi', 44, NULL, NULL),
(819, 'Tsholotsho', 44, NULL, NULL),
(820, 'Umguza', 44, NULL, NULL),
(821, 'Beitbridge', 41, NULL, NULL),
(822, 'Bulilimamangwe', 41, NULL, NULL),
(823, 'Gwanda', 41, NULL, NULL),
(824, 'Insiza', 41, NULL, NULL),
(825, 'Matobo', 41, NULL, NULL),
(826, 'Umzingwane', 41, NULL, NULL),
(827, 'Insiza', 41, NULL, NULL),
(828, 'Chirumhanzu', 42, NULL, NULL),
(829, 'Gokwe North', 42, NULL, NULL),
(830, 'Gokwe South', 42, NULL, NULL),
(831, 'Gweru', 42, NULL, NULL),
(832, 'Kwekwe', 42, NULL, NULL),
(833, 'Mberengwa', 42, NULL, NULL),
(834, 'Shurugwi', 42, NULL, NULL),
(835, 'Zvishavane', 42, NULL, NULL),
(836, 'Bulawayo', 39, NULL, NULL);

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
-- Table structure for table `farmers`
--

CREATE TABLE `farmers` (
  `farmer_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `province_id` bigint(20) UNSIGNED DEFAULT NULL,
  `district_id` bigint(20) UNSIGNED DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `farmer_name` varchar(255) DEFAULT NULL,
  `surname` text DEFAULT NULL,
  `receipt_number` varchar(255) DEFAULT NULL,
  `postal_address` varchar(255) DEFAULT NULL,
  `contact_phone` bigint(255) DEFAULT NULL,
  `email` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `farmers`
--

INSERT INTO `farmers` (`farmer_id`, `user_id`, `country_id`, `province_id`, `district_id`, `city_id`, `farmer_name`, `surname`, `receipt_number`, `postal_address`, `contact_phone`, `email`, `created_at`, `updated_at`) VALUES
(20, 24, NULL, NULL, 799, NULL, 'Amon Pirukai', NULL, NULL, '18738 Unit L Seke Chitugwiza Zimbabwe', 775029461, 'pirukai@soili.com', '2023-08-29 10:24:11', '2023-08-29 10:24:11'),
(22, 26, NULL, NULL, 776, NULL, 'E Chetse', NULL, NULL, 'Musasa Farm', 772244203, 'chetse@soili.com', '2023-08-30 07:54:27', '2023-08-30 07:54:27'),
(23, 29, NULL, NULL, 776, NULL, 'Samanther Juno', NULL, NULL, NULL, 771531660, '771531660@soili.com', '2023-08-30 12:17:37', '2023-08-30 12:17:37'),
(24, 30, NULL, NULL, 776, NULL, 'Mordecai Karira', NULL, NULL, NULL, 776894114, '776894114@soili.com', '2023-08-30 12:20:59', '2023-08-30 12:20:59'),
(25, 31, NULL, NULL, 776, NULL, 'Mucherengi Mhangura', NULL, NULL, NULL, 773227310, '0773227310@soili.com', '2023-08-30 12:22:38', '2023-08-30 12:22:38'),
(26, 32, NULL, NULL, 776, NULL, 'David Chahwanda', NULL, NULL, NULL, 771499455, '0771499455@soili.com', '2023-08-30 12:23:33', '2023-08-30 12:23:33'),
(27, 33, NULL, NULL, 776, NULL, 'Angeline Chahwanda', NULL, NULL, NULL, 775056798, '0775056798@soili.com', '2023-08-30 12:24:56', '2023-08-30 12:24:56'),
(29, 35, NULL, NULL, 802, NULL, 'Chirasha Munyaradzi', NULL, NULL, '+263773361615 Plot 9 Katama Farm', 263717983240, 'charasham@gmail.com', '2023-08-31 05:23:30', '2023-08-31 05:23:30'),
(30, 36, NULL, NULL, 776, NULL, 'Sigauke_Noah', NULL, NULL, '+263712132274 Noah Box 1064, Westgate', 771921883, 'sigauke@gmail.com', '2023-08-31 05:28:11', '2023-08-31 05:28:11'),
(31, 37, NULL, NULL, 795, NULL, 'Chisvo', NULL, NULL, 'Mitembe Farm', 773097157, 'chisvo@gmail.com', '2023-08-31 05:30:11', '2023-08-31 05:30:11'),
(32, 38, NULL, NULL, 803, NULL, 'Mabari Francis', NULL, NULL, '+263716075866 Solitude Plot 50 Mhondoro-Ngezi', 773436619, 'mabarif@gmail.com', '2023-08-31 06:14:07', '2023-08-31 06:14:07'),
(33, 39, NULL, NULL, 803, NULL, 'Kandororo Misheck', NULL, NULL, 'Solitude Plot 50, Mhondoro-Ngezi', 773509170, 'kandororm@gmail.com', '2023-08-31 06:16:49', '2023-08-31 06:16:49'),
(34, 40, NULL, NULL, 776, NULL, 'Nyabeze Blessing', NULL, NULL, '17771 Tredgold drive, Belvedere', 776133551, 'bnyabeze@soili.com', '2023-08-31 08:12:58', '2023-08-31 08:12:58'),
(35, 41, NULL, NULL, 776, NULL, 'Nyabeze Blessing Mr', NULL, NULL, '17771 Tredgold Drive, Belvedere. +263 776133551', 263712743189, 'bnyabeze@gmail.com', '2023-08-31 08:16:00', '2023-08-31 08:16:00'),
(36, 45, NULL, NULL, 776, NULL, 'Mazvimba John', NULL, NULL, 'Urundi Primary School\r\n0719485408\r\n0778854071', 719654770, 'mazvimbaj@gmail.com', '2023-08-31 10:32:38', '2023-08-31 10:32:38'),
(37, 46, NULL, NULL, 776, NULL, 'Makanga Ian', NULL, NULL, '414 Pomona, Borrowdale', 263774321313, 'makangai@gmail.com', '2023-08-31 10:37:07', '2023-08-31 10:37:07'),
(38, 47, NULL, NULL, 776, NULL, 'Taso F.', NULL, NULL, '446 Highlands', 263775030555, 'tasof@gmail.com', '2023-08-31 10:39:14', '2023-08-31 10:39:14'),
(39, 48, NULL, NULL, 782, NULL, 'Tabarira Jefta', NULL, NULL, 'Plot 15 coldstream muchena penhalonga', 772587600, 'jtabarura@gmail.com', '2023-08-31 12:04:05', '2023-08-31 12:04:05'),
(40, 50, NULL, NULL, 782, NULL, 'kenny', NULL, NULL, 'ggfggfgg', 77777777, 'simbik@gmail.com', '2023-11-28 08:29:40', '2023-11-28 08:29:40'),
(41, 51, NULL, NULL, NULL, NULL, 'terry gomera', NULL, NULL, NULL, 782879773, 'terrytinashe@outlook.com', '2025-06-22 20:27:22', '2025-06-22 20:27:22'),
(42, 52, NULL, NULL, NULL, NULL, 'terry', NULL, NULL, NULL, 7828797123, 'test@admin.com', '2026-03-03 09:41:42', '2026-03-03 09:41:42');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_requests`
--

CREATE TABLE `farmer_requests` (
  `request_id` bigint(20) UNSIGNED NOT NULL,
  `farmer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `farm_id` bigint(20) DEFAULT NULL,
  `receipt_number` varchar(255) DEFAULT NULL,
  `postal_address` varchar(255) DEFAULT NULL,
  `contact_phone` bigint(255) DEFAULT NULL,
  `number_of_samples` int(11) DEFAULT NULL,
  `earliest_date_of_collection` date DEFAULT NULL,
  `farm_name` varchar(255) DEFAULT NULL,
  `date_received` date DEFAULT NULL,
  `date_sampled` date DEFAULT NULL,
  `ica_locality` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `advisor_name` varchar(255) DEFAULT NULL,
  `approved` enum('Y','N') DEFAULT NULL,
  `average_sub_samples_taken` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `farmer_requests`
--

INSERT INTO `farmer_requests` (`request_id`, `farmer_id`, `farm_id`, `receipt_number`, `postal_address`, `contact_phone`, `number_of_samples`, `earliest_date_of_collection`, `farm_name`, `date_received`, `date_sampled`, `ica_locality`, `email`, `advisor_name`, `approved`, `average_sub_samples_taken`, `created_at`, `updated_at`) VALUES
(33, 20, 11, NULL, '18738 Unit L Seke Chitugwiza Zimbabwe', 775029461, 4, '2023-08-31', 'Chitungwiza', '2023-08-29', NULL, NULL, 'pirukai@soili.com', NULL, 'N', 10, '2023-08-29 10:27:14', '2023-08-29 10:27:14'),
(34, 22, 12, NULL, 'Musasa Farm', 772244203, 1, '2023-09-07', 'Musasa', '2023-08-30', NULL, NULL, 'chetse@soili.com', NULL, 'N', 10, '2023-08-30 07:59:56', '2023-08-30 07:59:56'),
(35, 39, 14, NULL, 'Plot 15 coldstream muchena penhalonga', 772587600, 2, '2023-09-08', 'Plot 15 Coldstream Muchena', '2023-08-31', NULL, NULL, 'jtabarura@gmail.com', NULL, 'N', 10, '2023-08-31 12:08:04', '2023-08-31 12:08:04'),
(36, 40, 15, NULL, 'ggfggfgg', 77777777, 8, '2023-11-22', 'farm 1', '2023-11-27', '2023-11-29', NULL, 'simbik@gmail.com', NULL, 'N', 10, '2023-11-28 08:32:49', '2023-11-28 08:32:49');

-- --------------------------------------------------------

--
-- Table structure for table `farms`
--

CREATE TABLE `farms` (
  `farm_id` bigint(20) UNSIGNED NOT NULL,
  `farm_name` varchar(255) DEFAULT NULL,
  `farmer_id` bigint(20) UNSIGNED NOT NULL,
  `postal_address` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(255) DEFAULT NULL,
  `size` varchar(30) DEFAULT NULL,
  `lat` varchar(30) DEFAULT NULL,
  `long` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `farms`
--

INSERT INTO `farms` (`farm_id`, `farm_name`, `farmer_id`, `postal_address`, `contact_phone`, `size`, `lat`, `long`, `created_at`, `updated_at`) VALUES
(11, 'Chitungwiza', 20, '18738 Unit L Seke Chitugwiza Zimbabwe', '775029461', NULL, NULL, NULL, '2023-08-29 10:25:25', '2023-08-29 10:25:25'),
(12, 'Musasa', 22, 'Musasa Farm', '772244203', '0', NULL, NULL, '2023-08-30 07:55:52', '2023-08-30 07:55:52'),
(13, 'Mucherengi', 25, 'Mhangura', '773227310', '0', '0', '0', '2023-08-31 05:12:44', '2023-08-31 05:12:44'),
(14, 'Plot 15 Coldstream Muchena', 39, 'Plot 15 coldstream muchena penhalonga', '772587600', '5', NULL, NULL, '2023-08-31 12:06:20', '2023-08-31 12:06:20'),
(15, 'farm 1', 40, 'ggfggfgg', '77777777', '23', '3', '344', '2023-11-28 08:31:15', '2023-11-28 08:31:15'),
(16, 'farm 2', 40, 'ggfggfgg', '77777777', 'u667', '77', '88', '2023-11-28 08:31:33', '2023-11-28 08:31:33');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '20230711000001_create_countries_table', 1),
(6, '20230711000002_create_cities_table', 1),
(7, '20230711000003_create_provinces_table', 1),
(8, '20230711000004_create_districts_table', 1),
(9, '20230711000005_create_partners_table', 1),
(10, '20230711000006_create_staff_table', 1),
(11, '20230711000007_create_farmers_table', 2),
(12, '20230711000008_create_farmer_requests_table', 2),
(13, '20230711000009_create_farms_table', 2),
(14, '20230711000010_create_plot_table', 2),
(15, '20230711000011_create_recommendations_table', 3),
(16, '20230711000012_create_soil_samples_table', 3),
(17, '20230711000013_create_soil_sample_results_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `partner_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`partner_id`, `user_id`, `name`, `surname`, `address`, `phone`, `email`, `created_at`, `updated_at`) VALUES
(1, 1, 'Partner Name', 'Partner Surname', 'Partner Address', 'Partner Phone', 'partner@example.com', '2023-07-14 09:56:38', '2023-07-14 09:56:38'),
(2, 1, 'Partner Name', 'Partner Surname', 'Partner Address', 'Partner Phone', 'partner@example.com', '2023-07-14 09:57:25', '2023-07-14 09:57:25'),
(3, 1, 'Partner Name', 'Partner Surname', 'Partner Address', 'Partner Phone', 'partner@example.com', '2023-07-14 09:58:06', '2023-07-14 09:58:06'),
(4, 1, 'Partner Name', 'Partner Surname', 'Partner Address', 'Partner Phone', 'partner@example.com', '2023-07-14 09:58:40', '2023-07-14 09:58:40'),
(5, 1, 'Partner Name', 'Partner Surname', 'Partner Address', 'Partner Phone', 'partner@example.com', '2023-07-14 09:59:15', '2023-07-14 09:59:15');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
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
-- Table structure for table `plot`
--

CREATE TABLE `plot` (
  `plot_id` bigint(20) UNSIGNED NOT NULL,
  `farm_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `province_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`province_id`, `country_id`, `name`, `created_at`, `updated_at`) VALUES
(38, 1, 'Mashonaland Central', NULL, NULL),
(39, 1, 'Bulawayo', NULL, NULL),
(40, 1, 'Mashonaland West', NULL, NULL),
(41, 1, 'Matabeleland South', NULL, NULL),
(42, 1, 'Midlands', NULL, NULL),
(43, 1, 'Harare', NULL, NULL),
(44, 1, 'Matabeleland North', NULL, NULL),
(45, 1, 'Mashonaland East', NULL, NULL),
(46, 1, 'Masvingo', NULL, NULL),
(47, 1, 'Manicaland', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `recommendations`
--

CREATE TABLE `recommendations` (
  `reco_id` bigint(20) UNSIGNED NOT NULL,
  `request_id` bigint(20) UNSIGNED NOT NULL,
  `sample_id` bigint(20) DEFAULT NULL,
  `partner_id` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `approved` enum('Y','N') DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `uploaded_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recommendations`
--

INSERT INTO `recommendations` (`reco_id`, `request_id`, `sample_id`, `partner_id`, `file_path`, `approved`, `notes`, `uploaded_date`, `created_at`, `updated_at`) VALUES
(19, 36, NULL, 1, NULL, 'N', 'uiu', '2023-11-28 11:35:50', '2023-11-28 09:35:50', '2023-11-28 09:35:50'),
(20, 33, NULL, 1, 'uploads/recommendationfiles/33.pdf', 'Y', 'tesdssss', '2024-04-30 11:31:49', '2024-04-30 09:31:49', '2024-04-30 10:17:17');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `display_name` varchar(191) DEFAULT NULL,
  `description` varchar(191) DEFAULT NULL,
  `user_type` enum('Admin','Farmer','Staff','Staff_Admin','Partner') NOT NULL,
  `is_default` enum('No','Yes') NOT NULL DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `user_type`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin', 'Admin', 'Admin', 'No', NULL, NULL),
(2, 'Farmer', 'Farmer', 'Farmer', 'Farmer', 'Yes', NULL, NULL),
(3, 'Labtech', 'Lab Tech', 'Lab Tech', 'Staff', 'No', NULL, NULL),
(4, 'Labmanager', 'lab manager', 'lab manager', 'Staff_Admin', 'No', NULL, NULL),
(5, 'Partner', 'Partner', 'Partner', 'Partner', 'No', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `soil_samples`
--

CREATE TABLE `soil_samples` (
  `sample_id` bigint(20) UNSIGNED NOT NULL,
  `request_id` bigint(20) UNSIGNED NOT NULL,
  `laboratory_number` varchar(255) DEFAULT NULL,
  `plot_id` bigint(20) UNSIGNED NOT NULL,
  `sample_reference` varchar(255) DEFAULT NULL,
  `type_of_previous_crop` varchar(255) DEFAULT NULL,
  `date_of_ploughing` date DEFAULT NULL,
  `date_planted` date DEFAULT NULL,
  `previous_crop_yield` varchar(255) DEFAULT NULL,
  `crop` varchar(255) DEFAULT NULL,
  `crop_to_be_irrigated` enum('Y','N') DEFAULT NULL,
  `planting_date` date DEFAULT NULL,
  `plant_pop_per_ha` int(11) DEFAULT NULL,
  `yield_target_kg_per_ha` varchar(255) DEFAULT NULL,
  `land_size` varchar(255) DEFAULT NULL,
  `manure_to_be_used` enum('Y','N') DEFAULT NULL,
  `fertilizer_to_be_used` enum('Y','N') DEFAULT NULL,
  `lat` varchar(20) DEFAULT NULL,
  `long` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `soil_samples`
--

INSERT INTO `soil_samples` (`sample_id`, `request_id`, `laboratory_number`, `plot_id`, `sample_reference`, `type_of_previous_crop`, `date_of_ploughing`, `date_planted`, `previous_crop_yield`, `crop`, `crop_to_be_irrigated`, `planting_date`, `plant_pop_per_ha`, `yield_target_kg_per_ha`, `land_size`, `manure_to_be_used`, `fertilizer_to_be_used`, `lat`, `long`, `created_at`, `updated_at`) VALUES
(28, 33, 'AA00001', 1, 'field d1', 'maize', NULL, NULL, NULL, 'wheat', 'N', NULL, NULL, NULL, '0', 'N', 'N', '0', '0', '2023-08-29 10:29:27', '2023-08-29 10:29:27'),
(29, 34, 'AA00002', 1, 'sample 1', 'maize', NULL, NULL, NULL, 'wheat', 'N', NULL, NULL, NULL, '0', 'N', 'N', '0', '0', '2023-08-30 08:02:57', '2023-08-30 08:02:57'),
(30, 35, 'AA00003', 1, 'field', 'maize', '2023-08-09', '2023-08-22', '4', 'wheat', 'Y', '2023-08-30', 5, '5', '5', 'Y', 'Y', '0', '0', '2023-08-31 12:09:09', '2023-08-31 12:09:09'),
(31, 36, 'AA00004', 1, 'jiuiu', 'msize', '2023-11-29', '2023-11-27', '99', 'soya', 'N', NULL, NULL, NULL, '20', 'N', 'N', '77', '344', '2023-11-28 08:35:28', '2023-11-28 08:35:28'),
(32, 36, 'AA99999', 2, 'ololo', 'msizeolo', NULL, NULL, NULL, 'soya jj', 'N', NULL, NULL, NULL, '7', 'N', 'N', '3', '344', '2023-11-28 08:37:03', '2023-11-28 08:37:03'),
(33, 36, 'AB00001', 1, 'ololoo', 'kkjm', NULL, NULL, NULL, 'soya', 'N', NULL, NULL, NULL, '8', 'N', 'N', '3', '88', '2023-11-28 08:39:31', '2023-11-28 08:39:31');

-- --------------------------------------------------------

--
-- Table structure for table `soil_sample_results`
--

CREATE TABLE `soil_sample_results` (
  `result_id` bigint(20) UNSIGNED NOT NULL,
  `request_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sample_id` bigint(20) UNSIGNED DEFAULT NULL,
  `laboratory_number` varchar(255) DEFAULT NULL,
  `lab_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `texturemethod` text DEFAULT NULL,
  `phosphorousmethods` text DEFAULT NULL,
  `micronutrientsmethods` text DEFAULT NULL,
  `exchangeablemethods` text DEFAULT NULL,
  `phmethod` text DEFAULT NULL,
  `dilutionratio` text DEFAULT NULL,
  `ph_cacl2` decimal(4,2) DEFAULT NULL,
  `colour` varchar(255) DEFAULT NULL,
  `texture` varchar(255) DEFAULT NULL,
  `percentage_sand` double(5,2) DEFAULT NULL,
  `percentage_silt` decimal(5,2) DEFAULT NULL,
  `percentage_clay` decimal(5,2) DEFAULT NULL,
  `min_initial_n` decimal(5,2) DEFAULT NULL,
  `p2o5_ppm` decimal(5,2) DEFAULT NULL,
  `k` decimal(5,2) DEFAULT NULL,
  `mg` decimal(5,2) DEFAULT NULL,
  `ca` decimal(5,2) DEFAULT NULL,
  `zn` decimal(5,2) DEFAULT NULL,
  `cu` decimal(5,2) DEFAULT NULL,
  `mn` decimal(5,2) DEFAULT NULL,
  `fe` decimal(5,2) DEFAULT NULL,
  `approved` enum('Y','N') DEFAULT NULL,
  `approved_by_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `soil_sample_results`
--

INSERT INTO `soil_sample_results` (`result_id`, `request_id`, `sample_id`, `laboratory_number`, `lab_user_id`, `texturemethod`, `phosphorousmethods`, `micronutrientsmethods`, `exchangeablemethods`, `phmethod`, `dilutionratio`, `ph_cacl2`, `colour`, `texture`, `percentage_sand`, `percentage_silt`, `percentage_clay`, `min_initial_n`, `p2o5_ppm`, `k`, `mg`, `ca`, `zn`, `cu`, `mn`, `fe`, `approved`, `approved_by_user_id`, `created_at`, `updated_at`) VALUES
(8, 34, 29, 'AA00002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4.20, 'brown', 'S', 16.00, 8.00, 76.00, 7.00, 14.00, 0.10, 2.20, 4.50, 0.09, 0.02, NULL, NULL, NULL, NULL, '2023-08-30 08:10:07', '2023-08-30 08:10:07'),
(9, 35, 30, 'AA00003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5.00, 'brown', 'S', 5.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-31 12:09:49', '2023-08-31 12:09:49'),
(10, 36, 31, 'AA00004', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5.00, '2', 'LS', 2.00, 6.00, 6.00, 6.00, NULL, 4.00, 4.00, 3.00, 6.00, 5.00, NULL, NULL, NULL, NULL, '2023-11-28 08:47:08', '2023-11-28 08:51:20'),
(11, 36, 32, 'AA99999', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2.00, '4', 'SCL', 5.00, 4.00, 4.00, 5.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-28 08:52:57', '2023-11-28 08:52:57'),
(12, 36, 33, 'AB00001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5.00, 'strongbrown', NULL, NULL, 67.00, 7.00, 7.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-28 08:53:37', '2023-11-28 08:54:47'),
(13, 33, 28, 'AA00001', NULL, 'hydrometer', 'olsen', 'dtpa', NULL, '1M KCl', '1:1', 3.00, 'red', 'V', 40.00, 40.00, 20.00, 56.00, 10.00, 7.00, 5.00, 5.00, 5.00, 5.00, 5.00, 5.00, NULL, NULL, '2024-04-25 09:15:30', '2024-04-25 11:57:20');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `user_id`, `name`, `surname`, `address`, `phone`, `email`, `created_at`, `updated_at`) VALUES
(1, 1, 'Staff Name', 'Staff Surname', 'Staff Address', 'Staff Phone', 'staff@example.com', '2023-07-14 09:56:38', '2023-07-14 09:56:38'),
(2, 2, 'Staff Name', 'Staff Surname', 'Staff Address', 'Staff Phone', 'staff@example.com', '2023-07-14 09:57:25', '2023-07-14 09:57:25'),
(3, 3, 'Staff Name', 'Staff Surname', 'Staff Address', 'Staff Phone', 'staff@example.com', '2023-07-14 09:58:06', '2023-07-14 09:58:06'),
(4, 4, 'Staff Name', 'Staff Surname', 'Staff Address', 'Staff Phone', 'staff@example.com', '2023-07-14 09:58:40', '2023-07-14 09:58:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` text DEFAULT NULL,
  `phone` bigint(20) NOT NULL,
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

INSERT INTO `users` (`id`, `role_id`, `name`, `last_name`, `phone`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'terry tinashe gomera', '', 782879772, 'admin@gmail.com', NULL, '$2y$10$mrfUNDYNgySVpA/T04JFw.lJyy2jBIS3yLbuleGQiJ4FWX6j2k.EK', NULL, '2023-07-12 09:36:14', '2023-07-12 09:36:14'),
(2, 0, 'terry', '', 1, 'terry.gomera@gmail.com', NULL, '$2y$12$ViU21DMlLTZqCvXf4JcgR.tqZYWUAx.Fa50yrUQFah3jyvA67pTwq', NULL, '2023-07-14 08:17:21', '2023-07-14 08:17:21'),
(3, 0, 'taku', '', 2, 'tuku@gmail.com', NULL, '$2y$10$u4fFjX9uQ.wEca2pmXqdfeR3g7AdYix5fAf3jwJl/zc281CG6Y.de', NULL, '2023-07-14 08:22:44', '2023-07-14 08:22:44'),
(4, 0, 'User Name', '', 3, 'user@example.com', '2023-07-14 09:18:28', '$2y$10$b.QBp.9m5KgosL2lVewtM.Y/9Eeuie2tRUZf.ORzdx.Vp6mDdujrW', NULL, '2023-07-14 09:18:28', '2023-07-14 09:18:28'),
(13, 0, 'name', '', 4, 'tes2t@gmail.com', NULL, '$2y$10$vsldSCUBkVstRy8pkrDjBuyGi/bFNkt9w4YbXDtba6U09zYHkSwaS', NULL, '2023-07-25 07:05:44', '2023-07-25 07:05:44'),
(14, 0, 'Test New', '', 5, 'test123@gmail.com', NULL, '$2y$10$VLBFTtnpLrQ24pNrsEaWfu9sDwF5Y781I1wtRfYNTfaue6yv1la2m', NULL, '2023-07-25 07:58:07', '2023-07-25 07:58:07'),
(15, 0, 'tinashe', '', 6, 'test3@gmail.com', NULL, '$2y$10$flEG/mveu76PeXDwTHb/xuXDPFbyTuHqQDHQ/nQkmnL0WAxChTfSu', NULL, '2023-07-25 11:40:31', '2023-07-25 11:40:31'),
(16, 2, 'Terry T Gomera', NULL, 782879779, 'tt@gmail.com', NULL, '$2y$10$1YZAHqtSX2DEuT5/.wgRHufpgQbVVf/uJrQAUCVzdscQXtXUIsI/m', NULL, '2023-07-26 17:22:19', '2023-07-26 17:22:19'),
(17, 2, 'Terry T Gomera', NULL, 7828797799, 'tttttt@gmail.com', NULL, '$2y$10$tMtPwNaIX2tiaL8bnWO4iOHbSkaW6iLozAsSVAmXEXH12jyWMi/Ze', NULL, '2023-07-26 17:30:27', '2023-07-26 17:30:27'),
(18, 2, 'Terry T Gomera', NULL, 782879770, 'tttmmm@gmail.com', NULL, '$2y$10$C9xM.nw48u.DjdF2JqkrnOcBLnfxdNTie6yLEiylt4mzosJU1smZK', NULL, '2023-07-26 17:43:15', '2023-07-26 17:43:15'),
(19, 2, 'terry', NULL, 782879782, 'nnnn@gmail.com', NULL, '$2y$10$Pk30V0uskWuaCIyZ9eA3teHz7eNcWfEmEVrsifPC9g2fo/7GEmxAq', NULL, '2023-07-26 18:14:52', '2023-07-26 18:14:52'),
(20, 2, 'Terry T Gomera', NULL, 782879123, 'm@gmail.com', NULL, '$2y$10$AsQ9ajAxJdEa6PwLgcXiou/woo40kg/d2M1DjfxT1btBS60MxBz9a', NULL, '2023-07-26 18:41:54', '2023-07-26 18:41:54'),
(21, 2, 'Terry T Gomera', NULL, 782879124, '123@gmail.com', NULL, '$2y$10$X6VT9HQl8z/0y1TvxVAjke5Rf51oSBSJn2ob.r03rgOaFgecf0T4G', NULL, '2023-07-26 18:45:28', '2023-07-26 18:45:28'),
(22, 2, 'terry gomera', NULL, 772748495, 'test@gmail.com', NULL, '$2y$10$flEG/mveu76PeXDwTHb/xuXDPFbyTuHqQDHQ/nQkmnL0WAxChTfSu', NULL, '2023-07-27 05:25:17', '2023-07-27 05:25:17'),
(23, 1, 'kenny', NULL, 7777777, 'kenny@soili.com', NULL, '$2y$10$OTIeCI1Z6hFWAfhxWYz0B.KJ2yctK1dKpQHJpOI5iyaDTbDeZPCKa', NULL, '2023-08-29 08:53:14', '2023-08-29 08:53:14'),
(24, 2, 'Amon Pirukai', NULL, 775029461, 'pirukai@soili.com', NULL, '$2y$10$NXOuC9c6egVgzwQS43vesOmFRXcDcQt7VKZlyP13uB6s7n8LJxOEa', NULL, '2023-08-29 10:24:11', '2023-08-29 10:24:11'),
(25, 1, 'Tapfuma Joram', NULL, 712377106, 'tapfumaj@africau.edu', NULL, '$2y$10$OTIeCI1Z6hFWAfhxWYz0B.KJ2yctK1dKpQHJpOI5iyaDTbDeZPCKa', NULL, '2023-08-30 07:23:32', '2023-08-30 07:23:32'),
(26, 2, 'E Chetse', NULL, 772244203, 'chetse@soili.com', NULL, '$2y$10$C92d7wsWzTVUDgn5TzR2Mus.fgihUunGQaDK4yEd8TNHfo6RUZQHm', NULL, '2023-08-30 07:54:27', '2023-08-30 07:54:27'),
(29, 2, 'Samanther Juno', NULL, 771531660, '771531660@soili.com', NULL, '$2y$10$LdS0eCvbm7T.6y.A.PyYkeOhk09YErkePI/MB3uv1NboSgcsEchc6', NULL, '2023-08-30 12:17:37', '2023-08-30 12:17:37'),
(30, 2, 'Mordecai Karira', NULL, 776894114, '776894114@soili.com', NULL, '$2y$10$nqkRp9Vuv3vwXBZ92fUAFeOze/VUWUnXzKFu7m.04EQo7MU/bS6A.', NULL, '2023-08-30 12:20:59', '2023-08-30 12:20:59'),
(31, 2, 'Mucherengi Mhangura', NULL, 773227310, '0773227310@soili.com', NULL, '$2y$10$.1fOjvHvEJZOKGGEAA.Ax.TdIvHknu23sxI56aqMBpjf.mAut7Vke', NULL, '2023-08-30 12:22:38', '2023-08-30 12:22:38'),
(32, 2, 'David Chahwanda', NULL, 771499455, '0771499455@soili.com', NULL, '$2y$10$oLnh9pIRxHzTvtalcKiU2OcNOsyBAoESlBpbrFrKtqOu4und79kK2', NULL, '2023-08-30 12:23:33', '2023-08-30 12:23:33'),
(33, 2, 'Angeline Chahwanda', NULL, 775056798, '0775056798@soili.com', NULL, '$2y$10$C1gbzt2i4fZF7QobkA.h3.ZTDBmeQEqoBvMz8s2Gg6HTylVBsyQ6O', NULL, '2023-08-30 12:24:56', '2023-08-30 12:24:56'),
(35, 2, 'Chirasha Munyaradzi', NULL, 263717983240, 'charasham@gmail.com', NULL, '$2y$10$FjFOWRmno0oYnuZMxiC9gu6UK2PclYW/u5bG3tcI1S0TeFdQ6.75.', NULL, '2023-08-31 05:23:30', '2023-08-31 05:23:30'),
(36, 2, 'Sigauke_Noah', NULL, 771921883, 'sigauke@gmail.com', NULL, '$2y$10$.zi8liBj.mcaRk6OeT7WmOiAOnXnYl5SM0jBw53OoEs5r5jZ1kCJW', NULL, '2023-08-31 05:28:11', '2023-08-31 05:28:11'),
(37, 2, 'Chisvo', NULL, 773097157, 'chisvo@gmail.com', NULL, '$2y$10$ado7EvOSZJJdQ8wPtJ2h9eIFW5faFbKDd73SEp8Xe8wmfGd3RoGeq', NULL, '2023-08-31 05:30:11', '2023-08-31 05:30:11'),
(38, 2, 'Mabari Francis', NULL, 773436619, 'mabarif@gmail.com', NULL, '$2y$10$L6typcW.Us7tJhOVoxPYBe36rLUi7LvJ5f9J0u9Bj2VqKao6BNAki', NULL, '2023-08-31 06:14:07', '2023-08-31 06:14:07'),
(39, 2, 'Kandororo Misheck', NULL, 773509170, 'kandororm@gmail.com', NULL, '$2y$10$t8ekb/HjuSdX4WghNk8fMuFBeV3fNhO.l5ENpAhZVYx9hXvJ4jlJG', NULL, '2023-08-31 06:16:49', '2023-08-31 06:16:49'),
(40, 2, 'Nyabeze Blessing', NULL, 776133551, 'bnyabeze@soili.com', NULL, '$2y$10$oQX.CfhuU.voKU4Ej/4DduuZMrtxAsDK46HP/DbF5Ysd9MTQzitum', NULL, '2023-08-31 08:12:58', '2023-08-31 08:12:58'),
(41, 2, 'Nyabeze Blessing Mr', NULL, 263712743189, 'bnyabeze@gmail.com', NULL, '$2y$10$kJNfvX2wDCQnn2DLK5DteeRkvwO2iE1lc/mmmyo4riCMczO1h/C1y', NULL, '2023-08-31 08:16:00', '2023-08-31 08:16:00'),
(45, 2, 'Mazvimba John', NULL, 719654770, 'mazvimbaj@gmail.com', NULL, '$2y$10$muFWA1PCTLc0eAL1EMQOxu9S7Xy5aHi0Z4toZ6VlDagvXvopBdiMy', NULL, '2023-08-31 10:32:38', '2023-08-31 10:32:38'),
(46, 2, 'Makanga Ian', NULL, 263774321313, 'makangai@gmail.com', NULL, '$2y$10$2Vhr.VRKsNd1grShQwECUOtcYUCVTImYzsN6o0oveqP0P67.Nce3q', NULL, '2023-08-31 10:37:07', '2023-08-31 10:37:07'),
(47, 2, 'Taso F.', NULL, 263775030555, 'tasof@gmail.com', NULL, '$2y$10$SkLyqq8WeFj7C9kDr6dLjuUtE0n98xvykXWVkK.TA5H9hv.qtgtza', NULL, '2023-08-31 10:39:14', '2023-08-31 10:39:14'),
(48, 2, 'Tabarira Jefta', NULL, 772587600, 'jtabarura@gmail.com', NULL, '$2y$10$RhEOvoQNJVWWfiveRyHyKefw8hZCA7XkAYjh/8zhdLc7E7y6zX6vy', NULL, '2023-08-31 12:04:05', '2023-08-31 12:04:05'),
(50, 2, 'kenny', NULL, 77777777, 'simbik@gmail.com', NULL, '$2y$10$SlTZjm5nQ7MspjeGJuzyFuuaw.uWBvl23sqR6pgiQAYgLX216zJhy', NULL, '2023-11-28 08:29:40', '2023-11-28 08:29:40'),
(51, 2, 'terry gomera', NULL, 782879773, 'terrytinashe@outlook.com', NULL, '$2y$10$cH38ixieOolBSvI07X56euWAVYKYI79MM2olehxNv3QpkvAxHaizS', NULL, '2025-06-22 20:27:22', '2025-06-22 20:27:22'),
(52, 2, 'terry', NULL, 7828797123, 'test@admin.com', NULL, '$2y$10$mrfUNDYNgySVpA/T04JFw.lJyy2jBIS3yLbuleGQiJ4FWX6j2k.EK', NULL, '2026-03-03 09:41:42', '2026-03-03 09:41:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `cities_country_id_foreign` (`country_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`district_id`),
  ADD KEY `districts_province_id_foreign` (`province_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `farmers`
--
ALTER TABLE `farmers`
  ADD PRIMARY KEY (`farmer_id`),
  ADD KEY `farmers_user_id_foreign` (`user_id`),
  ADD KEY `farmers_country_id_foreign` (`country_id`),
  ADD KEY `farmers_province_id_foreign` (`province_id`),
  ADD KEY `farmers_district_id_foreign` (`district_id`),
  ADD KEY `farmers_city_id_foreign` (`city_id`);

--
-- Indexes for table `farmer_requests`
--
ALTER TABLE `farmer_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `farmer_requests_farmer_id_foreign` (`farmer_id`);

--
-- Indexes for table `farms`
--
ALTER TABLE `farms`
  ADD PRIMARY KEY (`farm_id`),
  ADD KEY `farms_farmer_id_foreign` (`farmer_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`partner_id`),
  ADD KEY `partners_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `plot`
--
ALTER TABLE `plot`
  ADD PRIMARY KEY (`plot_id`),
  ADD KEY `plot_farm_id_foreign` (`farm_id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`province_id`),
  ADD KEY `provinces_country_id_foreign` (`country_id`);

--
-- Indexes for table `recommendations`
--
ALTER TABLE `recommendations`
  ADD PRIMARY KEY (`reco_id`),
  ADD KEY `recommendations_request_id_foreign` (`request_id`),
  ADD KEY `recommendations_partner_id_foreign` (`partner_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soil_samples`
--
ALTER TABLE `soil_samples`
  ADD PRIMARY KEY (`sample_id`),
  ADD UNIQUE KEY `soil_samples_laboratory_number_unique` (`laboratory_number`),
  ADD KEY `soil_samples_request_id_foreign` (`request_id`),
  ADD KEY `soil_samples_plot_id_foreign` (`plot_id`);

--
-- Indexes for table `soil_sample_results`
--
ALTER TABLE `soil_sample_results`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `soil_sample_results_request_id_foreign` (`request_id`),
  ADD KEY `soil_sample_results_sample_id_foreign` (`sample_id`),
  ADD KEY `soil_sample_results_lab_user_id_foreign` (`lab_user_id`),
  ADD KEY `soil_sample_results_approved_by_user_id_foreign` (`approved_by_user_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `staff_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `district_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=837;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
  MODIFY `farmer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `farmer_requests`
--
ALTER TABLE `farmer_requests`
  MODIFY `request_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `farms`
--
ALTER TABLE `farms`
  MODIFY `farm_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `partner_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plot`
--
ALTER TABLE `plot`
  MODIFY `plot_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `province_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `recommendations`
--
ALTER TABLE `recommendations`
  MODIFY `reco_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `soil_samples`
--
ALTER TABLE `soil_samples`
  MODIFY `sample_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `soil_sample_results`
--
ALTER TABLE `soil_sample_results`
  MODIFY `result_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`country_id`);

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`province_id`);

--
-- Constraints for table `farmer_requests`
--
ALTER TABLE `farmer_requests`
  ADD CONSTRAINT `farmer_requests_farmer_id_foreign` FOREIGN KEY (`farmer_id`) REFERENCES `farmers` (`farmer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
