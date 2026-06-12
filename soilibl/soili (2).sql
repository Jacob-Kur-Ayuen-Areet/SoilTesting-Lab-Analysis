-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2023 at 11:21 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soili`
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
(1, 1, 1, 1, 1, 1, 'Farmer Name', '0', 'Receipt Number', 'Postal Address', 0, '', '2023-07-14 09:51:25', '2023-07-14 09:51:25'),
(3, 2, 1, 1, 1, 1, 'Farmer Name', '0', 'Receipt Number', 'Postal Address', 0, '', '2023-07-14 09:52:44', '2023-07-14 09:52:44'),
(4, 3, 1, 1, 1, 1, 'Farmer Name', '0', 'Receipt Number', 'Postal Address', 0, '', '2023-07-14 09:56:07', '2023-07-14 09:56:07'),
(5, 4, 1, 1, 1, 1, 'Farmer Name', '0', 'Receipt Number', 'Postal Address', 0, '', '2023-07-14 09:56:38', '2023-07-14 09:56:38'),
(10, 13, NULL, NULL, NULL, NULL, 'name', '0', NULL, '45\r\n67', 782879772, '', '2023-07-25 07:05:44', '2023-07-25 07:05:44'),
(11, 14, NULL, NULL, NULL, NULL, 'Test New', '0', NULL, '8 mhofu Mufakose Harare', 782879773, '', '2023-07-25 07:58:07', '2023-07-25 07:58:07'),
(12, 15, NULL, NULL, NULL, NULL, 'tinashe', '0', NULL, 'hgjhg jhgk', 777777777, '', '2023-07-25 11:40:31', '2023-07-25 11:40:31'),
(13, 17, NULL, NULL, NULL, NULL, 'Terry T Gomera', NULL, NULL, NULL, 782879779, 'tttttt@gmail.com', '2023-07-26 17:30:27', '2023-07-26 17:30:27'),
(14, 18, NULL, NULL, NULL, NULL, 'Terry T Gomera', NULL, NULL, NULL, 782879770, 'tttmmm@gmail.com', '2023-07-26 17:43:15', '2023-07-26 17:43:15'),
(15, 19, NULL, NULL, 778, NULL, 'terry', NULL, NULL, '8 mhofu Mufakose Harare', 782879782, 'nnnn@gmail.com', '2023-07-26 18:14:52', '2023-07-26 18:14:52'),
(16, 20, NULL, NULL, NULL, NULL, 'Terry T Gomera', NULL, NULL, NULL, 782879123, '123@gmail.com', '2023-07-26 18:41:54', '2023-07-26 18:41:54'),
(17, 21, NULL, NULL, NULL, NULL, 'Terry T Gomera', NULL, NULL, NULL, 782879124, '123@gmail.com', '2023-07-26 18:45:28', '2023-07-26 18:45:28'),
(18, 22, NULL, NULL, NULL, NULL, 'terry gomera', NULL, NULL, NULL, 772748495, 'gomera@gmail.com', '2023-07-27 05:25:17', '2023-07-27 05:25:17');

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
(1, 1, 1, '1234', 'Postal Address', 0, NULL, NULL, 'Farm Name', '2023-07-14', '2023-07-14', 'ICA Locality', 'email@example.com', 'Advisor Name', 'Y', 3, '2023-07-14 09:56:38', '2023-07-25 14:58:34'),
(3, 1, 1, 'Receipt Number', 'Postal Address', 0, 5, '2023-07-14', 'Farm Name', '2023-07-14', '2023-07-14', 'ICA Locality', 'email@example.com', 'Advisor Name', 'Y', 3, '2023-07-14 09:57:25', '2023-07-14 09:57:25'),
(4, 1, 1, 'Receipt Number', 'Postal Address', 0, 5, '2023-07-14', 'Farm Name', '2023-07-14', '2023-07-14', 'ICA Locality', 'email@example.com', 'Advisor Name', 'Y', 3, '2023-07-14 09:58:06', '2023-07-14 09:58:06'),
(5, 1, 1, 'Receipt Number', 'Postal Address', 0, 5, '2023-07-14', 'Farm Name', '2023-07-14', '2023-07-14', 'ICA Locality', 'email@example.com', 'Advisor Name', 'Y', 3, '2023-07-14 09:58:40', '2023-07-14 09:58:40'),
(6, 1, 1, 'Receipt Number', 'Postal Address', 782879772, 5, '2023-07-14', 'Farm Name', '2023-07-14', '2023-07-14', 'ICA Locality', 'email@example.com', 'Advisor Name', 'Y', 3, '2023-07-14 09:59:15', '2023-07-14 09:59:15'),
(7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, NULL, NULL, '35', '8 mhofu Mufakese', 2633553, 3, '2023-07-19', 'sfdsfs', '2023-07-20', '2023-07-25', '34', 'terry.gomera@gmail.com', 'retw', '', 43, NULL, NULL),
(10, NULL, NULL, '4545', '8 mhofu Mufakese', 263, 1, '2023-07-20', 'sfdsfs', '2023-07-19', NULL, NULL, NULL, '546545', 'Y', 2, NULL, NULL),
(11, NULL, 1, NULL, 'Postal Address', 0, 2, '2023-07-21', 'Farm Name', '2023-07-20', '2023-07-21', NULL, 'terrytinashe24@gmail.com', 'nownow', 'Y', 20, NULL, NULL),
(12, 1, 1, '9009', 'Postal Address', 0, 8, '2023-07-20', 'Farm Name', '2023-07-20', '2023-07-13', NULL, 'terrytinashe24@gmail.com', NULL, 'N', 78, NULL, NULL),
(13, 1, 1, '9009', 'Postal Address', 0, 8, '2023-07-20', 'Farm Name', '2023-07-20', '2023-07-13', NULL, 'terrytinashe24@gmail.com', NULL, 'N', 78, NULL, NULL),
(14, 1, 1, '9009', 'Postal Address', 0, 8, '2023-07-20', 'Farm Name', '2023-07-20', '2023-07-13', NULL, 'terrytinashe24@gmail.com', NULL, 'N', 78, '2023-07-21 15:57:13', '2023-07-21 15:57:13'),
(15, 1, 1, '7', 'Postal Address', 0, 7, '2023-07-21', 'Farm Name', '2023-07-20', '2023-07-21', NULL, 'terrytinashe24@gmail.com', 'nownow', 'N', 78, '2023-07-21 16:04:33', '2023-07-21 16:04:33'),
(16, 1, 1, '7', 'Postal Address', 0, 7, '2023-07-21', 'Farm Name', '2023-07-20', '2023-07-21', NULL, 'terrytinashe24@gmail.com', 'nownow', 'N', 78, '2023-07-21 16:08:40', '2023-07-21 16:08:40'),
(17, 17, 1, NULL, 'Postal Address', 0, 20, '2023-07-20', 'Farm Name', '2023-07-21', '2023-07-19', NULL, 'terrytinashe24@gmail.com', 'nownow', 'N', 20, '2023-07-21 16:29:38', '2023-07-21 16:29:38'),
(18, 1, 1, NULL, 'Postal Address', 0, 20, '2023-07-20', 'Farm Name', '2023-07-21', '2023-07-19', NULL, 'terrytinashe24@gmail.com', 'nownow', 'N', 20, '2023-07-21 16:30:30', '2023-07-21 16:30:30'),
(19, 1, 1, NULL, 'Postal Address', 0, 20, '2023-07-20', 'Farm Name', '2023-07-21', '2023-07-19', NULL, 'terrytinashe24@gmail.com', 'nownow', 'N', 20, '2023-07-21 16:32:04', '2023-07-21 16:32:04'),
(20, 1, 1, NULL, 'Postal Address', 0, 20, '2023-07-20', 'Farm Name', '2023-07-21', '2023-07-19', NULL, 'terrytinashe24@gmail.com', 'nownow', 'N', 20, '2023-07-21 16:33:11', '2023-07-21 16:33:11'),
(21, 1, 1, NULL, 'Postal Address', 0, 20, '2023-07-20', 'Farm Name', '2023-07-21', '2023-07-19', NULL, 'terrytinashe24@gmail.com', 'nownow', 'N', 20, '2023-07-21 16:34:38', '2023-07-21 16:34:38'),
(22, 1, 1, NULL, 'Postal Address', 0, 20, '2023-07-20', 'Farm Name', '2023-07-21', '2023-07-19', NULL, 'terrytinashe24@gmail.com', 'nownow', 'N', 20, '2023-07-21 16:35:22', '2023-07-21 16:35:22'),
(23, 1, 1, NULL, 'Postal Address', 0, 20, '2023-07-20', 'Farm Name', '2023-07-21', '2023-07-19', NULL, 'terrytinashe24@gmail.com', 'nownow', 'N', 20, '2023-07-21 16:41:05', '2023-07-21 16:41:05'),
(24, 1, 1, NULL, 'Postal Address', 0, 20, '2023-07-20', 'Farm Name', '2023-07-21', '2023-07-19', NULL, 'terrytinashe24@gmail.com', 'nownow', 'N', 20, '2023-07-21 17:01:19', '2023-07-21 17:01:19'),
(25, 1, 1, NULL, 'Postal Address', 0, 20, '2023-07-20', 'Farm Name', '2023-07-21', '2023-07-19', NULL, 'terrytinashe24@gmail.com', 'nownow', 'N', 20, '2023-07-21 17:01:59', '2023-07-21 17:01:59'),
(26, 17, 1, NULL, 'Postal Address', 0, 20, '2023-07-20', 'Farm Name', '2023-07-21', '2023-07-19', NULL, 'terrytinashe24@gmail.com', 'nownow', 'N', 20, '2023-07-21 17:05:14', '2023-07-21 17:05:14'),
(27, 1, 1, NULL, 'Postal Address', 0, 9, '0000-00-00', 'Farm Name', '2023-07-21', '2023-07-19', NULL, 'terrytinashe24@gmail.com', 'nownow terry terruy', 'N', 20, '2023-07-21 17:34:08', '2023-07-21 20:00:57'),
(28, 1, 1, NULL, 'Postal Address', 0, 8, '2023-07-26', 'Farm Name', '2023-07-24', NULL, NULL, 'terrytinashe24@gmail.com', NULL, 'N', 8, '2023-07-24 07:54:50', '2023-07-24 07:54:50'),
(29, 1, 1, NULL, 'Postal Address', 0, 23, '2023-07-24', 'Farm Name', '2023-07-18', '2023-07-10', '23', 'terrytinashe24@gmail.com', NULL, 'N', 23, '2023-07-25 05:48:26', '2023-07-25 05:48:26'),
(30, 12, 9, NULL, 'hgjhg jhgk', 777777777, NULL, NULL, 'farm 1', '2023-07-26', '2023-07-19', NULL, 'test3@gmail.com', 'nyabunze', 'Y', 5, '2023-07-25 11:43:39', '2023-07-25 11:46:13'),
(31, 12, 9, NULL, 'hgjhg jhgk', 777777777, 3, '2023-07-03', 'farm 1', '2023-07-25', '2023-07-25', NULL, 'test3@gmail.com', NULL, 'N', 3, '2023-07-25 11:56:35', '2023-07-25 11:56:35'),
(32, 18, 10, '34535', 'werwrw wer wre', 772748495, 345, '2023-07-27', 'sfdsfs', '2023-07-27', '2023-07-27', '3454', 'gomera@gmail.com', '345', 'N', 345, '2023-07-27 05:46:07', '2023-07-27 05:46:07');

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
(1, 'Farm Name', 1, 'Postal Address', 'Contact Phone', 'Farm Size', 'Latitude', 'Longitude', '2023-07-14 09:56:07', '2023-07-14 09:56:07'),
(3, 'Farm Name', 1, 'Postal Address', 'Contact Phone', 'Farm Size', 'Latitude', 'Longitude', '2023-07-14 09:56:38', '2023-07-14 09:56:38'),
(4, 'Farm Name', 3, 'Postal Address', 'Contact Phone', 'Farm Size', 'Latitude', 'Longitude', '2023-07-14 09:57:25', '2023-07-14 09:57:25'),
(5, 'Farm Name', 4, 'Postal Address', 'Contact Phone', 'Farm Size', 'Latitude', 'Longitude', '2023-07-14 09:58:06', '2023-07-14 09:58:06'),
(6, 'Farm Name', 5, 'Postal Address', 'Contact Phone', 'Farm Size', 'Latitude', 'Longitude', '2023-07-14 09:58:40', '2023-07-14 09:58:40'),
(8, 'New', 11, '8 mhofu Mufakose Harare', '0782879773', '12', '-17.831414225320998', '31.044276198766582', '2023-07-25 10:45:19', '2023-07-25 10:45:19'),
(9, 'farm 1', 12, 'hgjhg jhgk', '0777777777', '23', '3', '344', '2023-07-25 11:41:13', '2023-07-25 11:41:13'),
(10, 'sfdsfs', 18, '345 5354', '772748495', '345', '244', '345', '2023-07-27 05:44:55', '2023-07-27 05:44:55');

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

--
-- Dumping data for table `plot`
--

INSERT INTO `plot` (`plot_id`, `farm_id`, `name`, `size`, `lat`, `long`, `created_at`, `updated_at`) VALUES
(1, 1, 'Plot Name', 'Plot Size', 'Latitude', 'Longitude', '2023-07-14 09:56:38', '2023-07-14 09:56:38'),
(3, 1, 'Plot Name', 'Plot Size', 'Latitude', 'Longitude', '2023-07-14 09:57:25', '2023-07-14 09:57:25'),
(4, 1, 'Plot Name', 'Plot Size', 'Latitude', 'Longitude', '2023-07-14 09:58:06', '2023-07-14 09:58:06'),
(5, 1, 'Plot Name', 'Plot Size', 'Latitude', 'Longitude', '2023-07-14 09:58:40', '2023-07-14 09:58:40'),
(6, 1, 'Plot Name', 'Plot Size', 'Latitude', 'Longitude', '2023-07-14 09:59:15', '2023-07-14 09:59:15');

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
  `sample_id` bigint(20) NOT NULL,
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
(14, 27, 0, 1, 'uploads/recommendationfiles/27.pdf', 'Y', 'wowwww', '2023-07-23 14:12:36', '2023-07-23 12:12:36', '2023-07-24 08:49:51'),
(15, 15, 0, 1, 'uploads/recommendationfiles/15.pdf', 'Y', NULL, '2023-07-23 15:07:39', '2023-07-23 13:07:39', '2023-07-23 14:18:17'),
(16, 16, 0, 1, 'uploads/recommendationfiles/16.pdf', 'Y', 'yey', '2023-07-23 17:01:33', '2023-07-23 15:01:33', '2023-07-23 15:01:40'),
(17, 31, 0, 1, 'uploads/recommendationfiles/31.pdf', 'Y', 'Woe wow', '2023-07-25 14:14:54', '2023-07-25 12:14:54', '2023-07-25 12:15:45'),
(18, 32, 27, 1, 'uploads/recommendationfiles/27.pdf', 'N', 'wow', '2023-07-27 08:17:59', '2023-07-27 06:17:59', '2023-07-27 07:44:39');

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
(7, 1, 'AA99999', 1, '876', 'utut', '2023-07-21', '2023-07-20', '76', 'hggh', 'N', '2023-07-21', 67, '20', '24', 'N', 'N', '-17.831414225320998', '31.044276198766585', NULL, NULL),
(13, 17, 'AB00001', 1, '876', 'utut', '2023-07-21', '2023-07-20', '76', 'hggh', 'N', '2023-07-21', 67, '20', '24', 'N', 'N', '-17.831414225320998', '31.044276198766585', NULL, NULL),
(14, 1, 'AB00002', 1, '876', 'utut', '2023-07-21', '2023-07-20', '76', 'hggh', 'N', '2023-07-21', 67, '20', '24', 'N', 'N', '-17.831414225320998', '31.044276198766585', NULL, NULL),
(15, 1, 'AB00003', 1, '876', 'utut', '2023-07-21', '2023-07-20', '99', 'hggh', 'N', '2023-07-18', 86, '786', '7', 'N', 'N', '-17.831414225320998', '31.044276198766584', NULL, NULL),
(16, 1, 'AB00004', 1, '876', 'utut', '2023-07-21', '2023-07-20', '99', 'hggh', 'N', '2023-07-18', 86, '786', '7', 'N', 'N', '-17.831414225320998', '31.044276198766584', NULL, NULL),
(18, 1, 'AB00005', 1, '876', 'utut', '2023-07-21', '2023-07-03', NULL, 'hggh', 'N', '2023-07-22', 100, '12', '21', 'N', 'N', '-17.831414225320998', '31.044276198766585', NULL, NULL),
(19, 1, 'AB00006', 1, '876', 'utut', '2023-07-21', '2023-07-03', NULL, 'hggh', 'N', '2023-07-22', 100, '12', '21', 'N', 'N', '-17.831414225320998', '31.044276198766585', NULL, NULL),
(20, 1, 'AB00007', 1, '876', 'utut', '2023-07-22', '2023-07-22', '90', 'hggh', 'N', '2023-07-28', 90, '90', '98', 'Y', 'N', '-17.831414225320998', '31.044276198766585', '2023-07-21 20:05:11', '2023-07-21 20:05:11'),
(21, 1, 'AB00008', 1, '876', 'utut', '2023-07-22', '2023-07-22', '90', 'hggh', 'N', '2023-07-28', 90, '90', '98', 'Y', 'N', '-17.831414225320998', '31.044276198766585', '2023-07-21 20:06:05', '2023-07-21 20:06:05'),
(22, 18, 'AB00009', 1, '876', 'utut', '2023-07-21', '2023-07-13', '90', 'hggh', 'N', '2023-07-06', 9, '09', '09', 'N', 'N', '-17.831414225320998', '31.044276198766585', '2023-07-21 20:07:27', '2023-07-21 20:07:27'),
(23, 18, 'AB00010', 1, '78', 'utut', '2023-07-28', '2023-07-07', '90', 'hggh', 'N', '2023-07-13', 90, '99', '99', 'N', 'N', '-17.831414225320998', '31.044276198766585', '2023-07-21 20:12:43', '2023-07-21 20:12:43'),
(24, 27, 'AB00011', 1, '989', 'utut', '2023-07-27', '2023-06-30', '99', 'hggh', 'N', '2023-07-21', 9, '99', '09', 'N', 'Y', '-17.831414225320998', NULL, '2023-07-21 20:15:20', '2023-07-21 20:15:20'),
(25, 27, 'AB00012', 1, '876', 'utut', NULL, NULL, NULL, 'hggh', 'N', NULL, 0, '09', '00900', 'Y', 'N', '-17.831414225320998', '31.044276198766585', '2023-07-21 20:24:03', '2023-07-21 20:24:03'),
(26, 31, 'AB00013', 1, 'Test', 'Banana', '2023-07-26', '2023-07-10', '20', 'Beans', 'N', '2023-07-26', 23, '80', '6', 'Y', 'N', '1.2090', '23.7777', '2023-07-25 11:59:30', '2023-07-25 11:59:30'),
(27, 32, 'AB00014', 1, 'tretertetr', '354', '2023-07-25', '2023-07-27', '34', '353', 'Y', '2023-07-27', 34, '5', '3', 'Y', 'Y', '244', '45', '2023-07-27 05:46:47', '2023-07-27 05:46:47');

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
  `approved` enum('Y','N') DEFAULT NULL,
  `approved_by_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `soil_sample_results`
--

INSERT INTO `soil_sample_results` (`result_id`, `request_id`, `sample_id`, `laboratory_number`, `lab_user_id`, `ph_cacl2`, `colour`, `texture`, `percentage_sand`, `percentage_silt`, `percentage_clay`, `min_initial_n`, `p2o5_ppm`, `k`, `mg`, `ca`, `zn`, `cu`, `approved`, `approved_by_user_id`, `created_at`, `updated_at`) VALUES
(3, 27, 24, 'AB00011', NULL, 20.00, NULL, NULL, NULL, 50.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-21 21:45:54', '2023-07-24 09:29:33'),
(5, 1, 14, 'AB00002', NULL, 63.00, 'Brown', 'CL', NULL, NULL, 9.00, 3.00, 2.00, NULL, NULL, 2.00, NULL, NULL, NULL, NULL, '2023-07-24 10:54:44', '2023-07-24 11:02:24'),
(6, 31, 26, 'AB00013', NULL, 16.00, 'Brown', 'L', 10.00, 56.00, 66.00, 97.00, 4.00, 3.00, 2.40, 4.30, 3.10, 3.00, NULL, NULL, '2023-07-25 12:05:30', '2023-07-25 12:05:30'),
(7, 32, 27, 'AB00014', NULL, 4.00, '45', 'C', 45.00, 45.00, 54.00, 45.00, 45.00, 45.00, 45.00, 4.00, 45.00, 45.00, NULL, NULL, '2023-07-27 10:32:05', '2023-07-27 10:32:05');

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
(1, 1, 'terry tinashe gomera', '', 782879772, 'admin@gmail.com', NULL, '$2y$10$flEG/mveu76PeXDwTHb/xuXDPFbyTuHqQDHQ/nQkmnL0WAxChTfSu', NULL, '2023-07-12 09:36:14', '2023-07-12 09:36:14'),
(2, 0, 'terry', '', 1, 'terry.gomera@gmail.com', NULL, '$2y$10$MGKrGf89A.VqG8c.eysKq.WqasaRF2NNFd6hstOGH7UAP/998UuHC', NULL, '2023-07-14 08:17:21', '2023-07-14 08:17:21'),
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
(22, 2, 'terry gomera', NULL, 772748495, 'test@gmail.com', NULL, '$2y$10$flEG/mveu76PeXDwTHb/xuXDPFbyTuHqQDHQ/nQkmnL0WAxChTfSu', NULL, '2023-07-27 05:25:17', '2023-07-27 05:25:17');

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
  MODIFY `country_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `farmer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `farmer_requests`
--
ALTER TABLE `farmer_requests`
  MODIFY `request_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `farms`
--
ALTER TABLE `farms`
  MODIFY `farm_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `plot_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `province_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `recommendations`
--
ALTER TABLE `recommendations`
  MODIFY `reco_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `soil_samples`
--
ALTER TABLE `soil_samples`
  MODIFY `sample_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `soil_sample_results`
--
ALTER TABLE `soil_sample_results`
  MODIFY `result_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
