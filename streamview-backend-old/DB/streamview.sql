-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 03, 2021 at 07:43 PM
-- Server version: 5.7.32-0ubuntu0.16.04.1
-- PHP Version: 7.1.33-34+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `streamview`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_activated` int(11) NOT NULL DEFAULT '1',
  `gender` enum('male','female','others') COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT '1',
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token_expiry` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timezone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'America/Los_Angeles',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin_type` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `picture`, `description`, `is_activated`, `gender`, `mobile`, `paypal_email`, `address`, `status`, `role`, `token`, `token_expiry`, `remember_token`, `timezone`, `created_at`, `updated_at`, `admin_type`) VALUES
(1, 'Admin', 'admin@streamview.com', '$2y$10$zct2K2MTy/kIz5GB056nSuM.QTFdPsPCch8mXMI9ZuZMF887YwrJW', 'http://adminview.streamhash.com/placeholder.png', 'description', 1, 'male', '85465765', '', '', 1, 'admin', '2y10cMT7ERA01cHJN3ykJeuXdQTzWTkfGUGHKZo8f0X7uzRhsRcf5q', '5228955933', NULL, 'America/Los_Angeles', '2021-08-14 10:10:31', '2021-08-14 10:15:33', 1),
(2, 'Test', 'test@streamview.com', '$2y$10$ZiRFD4FMYoBwIAFvtR4HTeFiQMAim4Tu38OuHMNt4ge.8DPZpoBR6', 'http://adminview.streamhash.com/placeholder.png', 'description', 1, 'male', '85465765', '', '', 1, 'admin', '2y10U6195egM51cwGaFf2k7GOAkv3szTquJy0CuyIxjoFMohjAwUnC', '1628959231', NULL, 'America/Los_Angeles', '2021-08-14 10:10:31', '2021-08-14 10:10:31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_videos`
--

CREATE TABLE `admin_videos` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `download_status` tinyint(4) NOT NULL,
  `age` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `is_kids_video` tinyint(4) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_subtitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trailer_video` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trailer_subtitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `video_gif_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_image_mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_banner_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ratings` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reviews` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_original_video` int(11) NOT NULL DEFAULT '0',
  `is_approved` int(11) NOT NULL,
  `is_home_slider` int(11) NOT NULL DEFAULT '0',
  `is_banner` int(11) NOT NULL,
  `uploaded_by` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `publish_time` datetime NOT NULL,
  `duration` time NOT NULL,
  `trailer_duration` time NOT NULL,
  `video_resolutions` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trailer_video_resolutions` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `compress_status` int(11) NOT NULL DEFAULT '0',
  `main_video_compress_status` tinyint(4) NOT NULL,
  `trailer_compress_status` int(11) NOT NULL DEFAULT '0',
  `video_resize_path` longtext COLLATE utf8mb4_unicode_ci,
  `trailer_resize_path` longtext COLLATE utf8mb4_unicode_ci,
  `edited_by` enum('admin','moderator','user','other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ppv_created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `watch_count` int(11) NOT NULL,
  `is_pay_per_view` tinyint(4) NOT NULL,
  `type_of_user` int(11) NOT NULL DEFAULT '0',
  `type_of_subscription` int(11) NOT NULL DEFAULT '0',
  `amount` float NOT NULL DEFAULT '0',
  `redeem_amount` double(8,2) NOT NULL,
  `admin_amount` double(8,2) NOT NULL,
  `user_amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `video_type` int(11) NOT NULL,
  `video_upload_type` int(11) NOT NULL,
  `position` smallint(6) NOT NULL,
  `player_json` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `hls_main_video` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_subtitle_vtt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `trailer_subtitle_vtt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_video_images`
--

CREATE TABLE `admin_video_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_video_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_default` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_video_subtitles`
--

CREATE TABLE `admin_video_subtitles` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_video_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_four` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_default` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cast_crews`
--

CREATE TABLE `cast_crews` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_series` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_home_display` int(11) NOT NULL DEFAULT '0',
  `is_approved` int(11) NOT NULL DEFAULT '1',
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `continue_watching_videos`
--

CREATE TABLE `continue_watching_videos` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `sub_profile_id` int(11) NOT NULL,
  `admin_video_id` int(11) NOT NULL,
  `duration` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration_in_seconds` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_genre` tinyint(4) NOT NULL,
  `position` smallint(6) NOT NULL,
  `genre_position` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `expiry_date` date NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `status` int(11) NOT NULL,
  `no_of_users_limit` smallint(6) NOT NULL,
  `per_users_limit` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `currency_name`, `currency_code`, `currency`, `created_at`, `updated_at`) VALUES
(1, 'United Arab Emirates Dirham', 'AED', 'د.إ', NULL, NULL),
(2, 'Afghanistani Afghani', 'AFN', '؋', NULL, NULL),
(3, 'Albanian Lek', 'ALL', 'Lek', NULL, NULL),
(4, 'Armenian Dram', 'AMD', 'դր', NULL, NULL),
(5, 'Netherlands Antillean Guilder', 'ANG', 'NAf', NULL, NULL),
(6, 'Angolan Kwanza', 'AOA', 'Kz', NULL, NULL),
(7, 'Argentine Peso', 'ARS', '$', NULL, NULL),
(8, 'Australian Dollar', 'AUD', '$', NULL, NULL),
(9, 'Aruban Florin', 'AWG', 'ƒ', NULL, NULL),
(10, 'Azerbaijani Manat', 'AZN', '₼', NULL, NULL),
(11, 'Bosnia-Herzegovina Convertible Mark', 'BAM', 'KM', NULL, NULL),
(12, 'Barbados Dollar', 'BBD', '$', NULL, NULL),
(13, 'Bangladeshi Taka', 'BDT', '৳', NULL, NULL),
(14, 'Bulgarian Lev', 'BGN', 'лв', NULL, NULL),
(15, 'Burundian Franc', 'BIF', 'FBu', NULL, NULL),
(16, 'Bermuda Dollar', 'BMD', '$', NULL, NULL),
(17, 'Brunei Dollar', 'BND', '$', NULL, NULL),
(18, 'Bolivian Boliviano', 'BOB', '$b', NULL, NULL),
(19, 'Brazilian Real', 'BRL', 'R$', NULL, NULL),
(20, 'Bahamian Dollar', 'BSD', '$', NULL, NULL),
(21, 'Botswana Pula', 'BWP', 'P', NULL, NULL),
(22, 'Belize Dollar', 'BZD', 'BZ$', NULL, NULL),
(23, 'Canadian Dollar', 'CAD', '$', NULL, NULL),
(24, 'Congolese franc', 'CDF', 'FC', NULL, NULL),
(25, 'Swiss Franc', 'CHF', 'CHF', NULL, NULL),
(26, 'Chilean Peso', 'CLP', '$', NULL, NULL),
(27, 'Chinese Yuan Renminbi', 'CNY', '¥', NULL, NULL),
(28, 'Colombian Peso', 'COP', '$', NULL, NULL),
(29, 'Cuban Convertible Peso', 'CUC', '$', NULL, NULL),
(30, 'Cape Verde Escudo', 'CVE', '$', NULL, NULL),
(31, 'Czech Koruna', 'CZK', 'Kč', NULL, NULL),
(32, 'Djiboutian Franc', 'DJF', 'Fdj', NULL, NULL),
(33, 'Danish Krone', 'DKK', 'kr.', NULL, NULL),
(34, 'Dominican Peso', 'DOP', 'RD$', NULL, NULL),
(35, 'Algerian Dinar', 'DZD', 'دج', NULL, NULL),
(36, 'Egyptian Pound', 'EGP', '£', NULL, NULL),
(37, 'Ethiopian Birr', 'ETB', 'ብር', NULL, NULL),
(38, 'European Euro', 'EUR', '€', NULL, NULL),
(39, 'Falkland Islands Pound', 'FKP', '£', NULL, NULL),
(40, 'Fiji Dollar', 'FJD', '$', NULL, NULL),
(41, 'United Kingdom Pound Sterling', 'GBP', '£', NULL, NULL),
(42, 'Georgian Lari', 'GEL', 'ლ', NULL, NULL),
(43, 'Gibraltar Pound', 'GIP', '£', NULL, NULL),
(44, 'Gambian Dalasi', 'GMD', 'D', NULL, NULL),
(45, 'Guinean Franc', 'GNF', 'FG', NULL, NULL),
(46, 'Guatemalan Quetzal', 'GTQ', 'Q', NULL, NULL),
(47, 'Guyanese Dollar', 'GYD', '$', NULL, NULL),
(48, 'Hong Kong Dollar', 'HKD', 'HK$', NULL, NULL),
(49, 'Honduran Lempira', 'HNL', 'L', NULL, NULL),
(50, 'Croatian Kuna', 'HRK', 'kn', NULL, NULL),
(51, 'Haitian Gourde', 'HTG', 'G', NULL, NULL),
(52, 'Hungarian Forint', 'HUF', 'Ft', NULL, NULL),
(53, 'Indonesian Rupiah', 'IDR', 'Rp', NULL, NULL),
(54, 'Israeli New Sheqel', 'ILS', '₪', NULL, NULL),
(55, 'Indian Rupee', 'INR', '₹', NULL, NULL),
(56, 'Icelandic Krona', 'ISK', 'kr', NULL, NULL),
(57, 'Jamaican Dollar', 'JMD', 'J$', NULL, NULL),
(58, 'Japanese Yen', 'JPY', '¥', NULL, NULL),
(59, 'Kenyan Shilling', 'KES', 'KSh,', NULL, NULL),
(60, 'Kyrgyzstani Som', 'KGS', 'лв', NULL, NULL),
(61, 'Cambodian Riel', 'KHR', '៛', NULL, NULL),
(62, 'Comorian Franc', 'KMF', 'CF', NULL, NULL),
(63, 'Korean Won', 'KRW', '₩', NULL, NULL),
(64, 'Cayman Islands Dollar', 'KYD', '$', NULL, NULL),
(65, 'Kazakhstani Tenge', 'KZT', 'лв', NULL, NULL),
(66, 'Lao Kip', 'LAK', '₭', NULL, NULL),
(67, 'Lebanese Pound', 'LBP', '£', NULL, NULL),
(68, 'Sri Lankan Rupee', 'LKR', '₨', NULL, NULL),
(69, 'Liberian Dollar', 'LRD', '$', NULL, NULL),
(70, 'Lesotho Loti', 'LSL', 'L', NULL, NULL),
(71, 'Moroccan Dirham', 'MAD', 'DH', NULL, NULL),
(72, 'Moldovan Leu', 'MDL', 'L', NULL, NULL),
(73, 'Malagasy Ariary', 'MGA', 'Ar', NULL, NULL),
(74, 'Macedonian Denar', 'MKD', 'ден', NULL, NULL),
(75, 'Myanmar Kyat', 'MMK', 'K', NULL, NULL),
(76, 'Mongolian Tugrik', 'MNT', '₮', NULL, NULL),
(77, 'Macanese Pataca', 'MOP', 'MOP$', NULL, NULL),
(78, 'Mauritanian Ouguiya', 'MRO', 'UM', NULL, NULL),
(79, 'Mauritian Rupee', 'MUR', '₨', NULL, NULL),
(80, 'Maldives Rufiyaa', 'MVR', 'Rf', NULL, NULL),
(81, 'Malawian Kwacha', 'MWK', 'MK', NULL, NULL),
(82, 'Mexican Peso', 'MXN', '$', NULL, NULL),
(83, 'Malaysian Ringgit', 'MYR', 'RM', NULL, NULL),
(84, 'Mozambican Metical', 'MZN', 'MT', NULL, NULL),
(85, 'Namibian Dollar', 'NAD', '$', NULL, NULL),
(86, 'Nigerian Naira', 'NGN', '₦', NULL, NULL),
(87, 'Nicaraguan Córdoba', 'NIO', 'C$', NULL, NULL),
(88, 'Norwegian Krone', 'NOK', 'kr', NULL, NULL),
(89, 'Nepalese Rupee', 'NPR', '₨', NULL, NULL),
(90, 'New Zealand Dollar', 'NZD', '$', NULL, NULL),
(91, 'Panamanian Balboa', 'PAB', 'B/.', NULL, NULL),
(92, 'Peruvian Nuevo Sol', 'PEN', 'S/.', NULL, NULL),
(93, 'Papua New Guinea Kina', 'PGK', 'K', NULL, NULL),
(94, 'Philippine Peso', 'PHP', '₱', NULL, NULL),
(95, 'Pakistan Rupee', 'PKR', '₨', NULL, NULL),
(96, 'Polish Zloty', 'PLN', 'zł', NULL, NULL),
(97, 'Paraguay Guarani', 'PYG', 'Gs', NULL, NULL),
(98, 'Qatari Riyal', 'QAR', '﷼', NULL, NULL),
(99, 'Romanian Leu', 'RON', 'lei', NULL, NULL),
(100, 'Serbian Dinar', 'RSD', 'Дин.', NULL, NULL),
(101, 'Russian Ruble', 'RUB', '₽', NULL, NULL),
(102, 'Rwandan Franc', 'RWF', 'FRw', NULL, NULL),
(103, 'Saudi Arabian Riyal', 'SAR', '﷼', NULL, NULL),
(104, 'Solomon Islands Dollar', 'SBD', '$', NULL, NULL),
(105, 'Seychelles Rupee', 'SCR', '₨', NULL, NULL),
(106, 'Swedish Krona', 'SEK', 'kr', NULL, NULL),
(107, 'Singapore Dollar', 'SGD', '$', NULL, NULL),
(108, 'Saint Helena Pound', 'SHP', '£', NULL, NULL),
(109, 'Sierra Leonean Leone', 'SLL', 'Le', NULL, NULL),
(110, 'Somali Shilling', 'SOS', 'S', NULL, NULL),
(111, 'Suriname Dollar', 'SRD', '$', NULL, NULL),
(112, 'Sao Tome Dobra', 'STD', 'Db', NULL, NULL),
(113, 'Swazi Lilangeni', 'SZL', 'E', NULL, NULL),
(114, 'Thai Baht', 'THB', '฿', NULL, NULL),
(115, 'Tajikistan Somoni', 'TJS', 'ЅM', NULL, NULL),
(116, 'Tongan Pa Anga', 'TOP', 'T$', NULL, NULL),
(117, 'Turkish New Lira', 'TRY', '₺', NULL, NULL),
(118, 'Trinidad and Tobago Dollar', 'TTD', 'TT$', NULL, NULL),
(119, 'New Taiwan Dollar', 'TWD', 'NT$', NULL, NULL),
(120, 'Tanzanian Shilling', 'TZS', 'TSh', NULL, NULL),
(121, 'Ukrainian Hryvnia', 'UAH', '₴', NULL, NULL),
(122, 'Ugandan Shilling', 'UGX', 'USh', NULL, NULL),
(123, 'United States Dollar', 'USD', '$', NULL, NULL),
(124, 'Uruguayan peso', 'UYU', '$U', NULL, NULL),
(125, 'Uzbekistani Som', 'UZS', 'лв', NULL, NULL),
(126, 'Viet Nam Dong', 'VND', '₫', NULL, NULL),
(127, 'Vanuatu vatu', 'VUV', 'VT', NULL, NULL),
(128, 'Samoan Tala', 'WST', 'WS$', NULL, NULL),
(129, 'Central African CFA', 'XAF', 'FCFA', NULL, NULL),
(130, 'East Caribbean Dollar', 'XCD', '$', NULL, NULL),
(131, 'West African CFA', 'XOF', 'CFA', NULL, NULL),
(132, 'CFP franc', 'XPF', '₣', NULL, NULL),
(133, 'Yemeni Rial', 'YER', '﷼', NULL, NULL),
(134, 'South African Rand', 'ZAR', 'R', NULL, NULL),
(135, 'Zambian Kwacha', 'ZMW', 'ZK', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `custom_wallets`
--

CREATE TABLE `custom_wallets` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` double(8,2) NOT NULL DEFAULT '0.00',
  `used` double(8,2) NOT NULL DEFAULT '0.00',
  `remaining` double(8,2) NOT NULL DEFAULT '0.00',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_wallet_histories`
--

CREATE TABLE `custom_wallet_histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `custom_field_id` int(11) NOT NULL DEFAULT '0',
  `custom_payment_id` int(11) NOT NULL DEFAULT '0',
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `amount` double(8,2) NOT NULL DEFAULT '0.00',
  `history_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ADD',
  `transaction_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `paid_date` datetime DEFAULT NULL,
  `payment_mode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_wallet_payments`
--

CREATE TABLE `custom_wallet_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wallet_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DIRECT',
  `voucher_id` int(11) NOT NULL DEFAULT '0',
  `voucher_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `actual_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `paid_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `payment_mode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'card',
  `is_cancelled` int(11) NOT NULL DEFAULT '0',
  `cancel_reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `paid_date` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_wallet_vouchers`
--

CREATE TABLE `custom_wallet_vouchers` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `voucher_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL DEFAULT '0.00',
  `total_count` int(11) NOT NULL,
  `per_user_limit` int(11) NOT NULL,
  `used_count` int(11) NOT NULL,
  `remaining_count` int(11) NOT NULL,
  `expiry_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `template_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `template_type`, `subject`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'user_welcome', 'Welcome to <%site_name%>', 'Thanks for signing up! We\'re very excited to have you on board.', 1, '2021-08-14 10:10:33', '2021-08-14 10:10:33'),
(2, 'admin_user_welcome', 'Welcome to <%site_name%>', 'Thanks for signing up! Where very excited to have you on board.', 1, '2021-08-14 10:10:33', '2021-08-14 10:10:33'),
(3, 'forgot_password', 'Your new password', 'Your Forgot Password request has been Accepted. Please find your credentials of <%site_name%>, <br> Email : <%email%> <br> Password : <%password%>', 1, '2021-08-14 10:10:33', '2021-08-14 10:10:33'),
(4, 'moderator_welcome', 'Welcome to <%site_name%>', 'Congratulations! Admin has made you a Content Creator. Please use the link and details below to login and upload Content.<br> Please find your credentials of <%site_name%>,  <br> Email : <%email%> <br> Password : <%password%>', 1, '2021-08-14 10:10:33', '2021-08-14 10:10:33'),
(5, 'payment_expired', 'Payment Notification', 'Your notification has expired. To keep using channel creation  & upload video without interruption, subscribe any one of our plans and continue to upload', 1, '2021-08-14 10:10:33', '2021-08-14 10:10:33'),
(6, 'payment_going_to_expiry', 'Payment Notification', 'Your subscription will expire soon. Our records indicate that no payment method has been associated with this subscripton account. Go to the subscription plans and provide the required payment information to renew your subscription for watching videos and continue using your profile uninterrupted.', 1, '2021-08-14 10:10:33', '2021-08-14 10:10:33'),
(7, 'new_video', '\'<%video_name%>\' in <%site_name%>', '\'<%video_name%>\' video uploaded in \'<%category_name%>\' Category, don\'t miss the video from <%site_name%>', 1, '2021-08-14 10:10:33', '2021-08-14 10:10:33'),
(8, 'edit_video', '\'<%video_name%>\' in <%site_name%>', '\'<%video_name%>\' video uploaded in \'<%category_name%>\' Category, don\'t miss the video from <%site_name%>', 1, '2021-08-14 10:10:33', '2021-08-14 10:10:33');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flags`
--

CREATE TABLE `flags` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key, It is an unique key',
  `user_id` int(10) UNSIGNED NOT NULL,
  `sub_profile_id` int(11) NOT NULL,
  `video_id` int(10) UNSIGNED NOT NULL,
  `reason` longtext COLLATE utf8mb4_unicode_ci COMMENT 'Reason for flagging the video',
  `status` smallint(6) NOT NULL DEFAULT '0' COMMENT 'Status of the flag table',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '6117e3da05b7a',
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `position` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  `is_home_display` int(11) NOT NULL DEFAULT '0',
  `is_approved` int(11) NOT NULL DEFAULT '1',
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `folder_name` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `folder_name`, `language`, `status`, `created_at`, `updated_at`) VALUES
(1, 'en', 'English', 1, '2021-08-14 10:10:34', '2021-08-14 10:10:34');

-- --------------------------------------------------------

--
-- Table structure for table `like_dislike_videos`
--

CREATE TABLE `like_dislike_videos` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_video_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sub_profile_id` int(11) NOT NULL,
  `like_status` int(11) NOT NULL,
  `dislike_status` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2015_08_25_172600_create_settings_table', 1),
(4, '2016_07_25_142335_create_admins_table', 1),
(5, '2016_07_25_142358_create_moderators_table', 1),
(6, '2016_07_28_111853_create_categories_table', 1),
(7, '2016_07_28_111900_create_sub_categories_table', 1),
(8, '2016_07_28_113237_create_sub_category_images_table', 1),
(9, '2016_07_30_033554_add_is_series_field_to_categories_table', 1),
(10, '2016_07_30_040800_create_admin_videos_table', 1),
(11, '2016_07_30_040833_create_admin_video_images_table', 1),
(12, '2016_07_30_132812_create_genres_table', 1),
(13, '2016_07_31_140521_add_genre_id_to_admin_videos_table', 1),
(14, '2016_08_01_151115_add_status_to_admin_videos_table', 1),
(15, '2016_08_02_030955_add_is_approved_to_categories_table', 1),
(16, '2016_08_02_031030_add_is_approved_to_sub_categories_table', 1),
(17, '2016_08_02_031053_add_is_approved_genres_table', 1),
(18, '2016_08_02_031301_add_is_approved_admin_videos_table', 1),
(19, '2016_08_02_134552_create_user_ratings_table', 1),
(20, '2016_08_02_143110_create_wishlists_table', 1),
(21, '2016_08_02_144545_create_user_histories_table', 1),
(22, '2016_08_02_152202_add_default_image_to_admin_videos_table', 1),
(23, '2016_08_02_154250_add_watch_count_to_admin_videos_table', 1),
(24, '2016_08_07_122712_create_pages_table', 1),
(25, '2016_08_08_091037_add_publish_time_to_admin_videos_table', 1),
(26, '2016_08_13_075844_add_video_type-to_admin_videos_table', 1),
(27, '2016_08_13_083130_add_video_upload_type-to_admin_videos_table', 1),
(28, '2016_08_14_042749_add_description_as_text_type', 1),
(29, '2016_08_16_035007_add_is_moderator_to_users_table', 1),
(30, '2016_08_16_070128_add_is_user_to_moderator_table', 1),
(31, '2016_08_19_134019_create_user_payments_table', 1),
(32, '2016_08_19_182650_add_is_paid_to_users', 1),
(33, '2016_08_26_065631_add_duration_to_admin_videos', 1),
(34, '2016_08_29_064138_change_device_type_in_users_table', 1),
(35, '2016_08_29_073204_create_mobile_registers_table', 1),
(36, '2016_08_29_082431_create_page_counters_table', 1),
(37, '2016_08_31_194838_change_video_id_in_admin_video_images', 1),
(38, '2016_09_02_133843_add_is_home_slider_to_admin_videos', 1),
(39, '2016_09_15_070030_create_jobs_table', 1),
(40, '2016_09_15_070051_create_failed_jobs_table', 1),
(41, '2016_09_15_163652_add_is_banner_to_admin_videos_table', 1),
(42, '2016_09_23_180525_add_push_status_users_table', 1),
(43, '2016_09_29_103536_change_login_by_users', 1),
(44, '2017_01_31_114409_create_user_tracks_table', 1),
(45, '2017_03_21_144617_add_timezone_users_field', 1),
(46, '2017_03_21_144742_add_timezone_moderators_field', 1),
(47, '2017_03_21_144824_add_timezone_admins_field', 1),
(48, '2017_03_22_124504_create_flags_table', 1),
(49, '2017_03_23_093118_create_pay_per_views_table', 1),
(50, '2017_03_23_100352_add_pay_per_view_fields_to_admin_videos_table', 1),
(51, '2017_04_07_083733_add_email_verification_fields_to_users_table', 1),
(52, '2017_04_12_085551_create_language_table', 1),
(53, '2017_05_24_151437_create_redeems_table', 1),
(54, '2017_05_24_161212_create_redeem_requests_table', 1),
(55, '2017_07_03_110327_create_sub_profile', 1),
(56, '2017_07_04_062546_added_subscription_field_in_user_payments_table', 1),
(57, '2017_07_04_062857_create_subscription_table', 1),
(58, '2017_07_04_063121_added_subscription_fields_in_users_table', 1),
(59, '2017_07_04_145640_add_details_field_in_videos_table', 1),
(60, '2017_07_08_072952_add_no_of_account_in_subscription_table', 1),
(61, '2017_07_08_091332_added_video_fields_table_genres', 1),
(62, '2017_07_08_105614_added_image_field_table_genres', 1),
(63, '2017_07_13_082946_create_notification_table', 1),
(64, '2017_07_29_115401_add_unique_id_in_admin_videos', 1),
(65, '2017_08_07_133107_added_unique_id_in_genre_table', 1),
(66, '2017_08_14_085732_added_subtitle_to_admin_videos', 1),
(67, '2017_08_14_092159_create_like_dislike_videos', 1),
(68, '2017_09_04_102357_added_enum_in_page', 1),
(69, '2017_09_18_064132_create_notification_templates_table', 1),
(70, '2017_10_09_073405_create_card_table', 1),
(71, '2017_10_09_145238_alter_table_in_videos', 1),
(72, '2017_10_09_145431_added_created_by_in_payperview', 1),
(73, '2017_10_10_065833_added_redeem_amount_in_admin_videos', 1),
(74, '2017_10_10_131357_added_payments_in_admin_videos', 1),
(75, '2017_10_10_131448_added_payments_in_moderators', 1),
(76, '2017_10_11_092951_added_subtitle_in_genre_table', 1),
(77, '2017_10_13_144508_added_card_id_in_users_table', 1),
(78, '2017_10_14_071458_added_payment_mode_in_users_table', 1),
(79, '2017_10_14_092354_added_sub_profile_id_in_spam_videos', 1),
(80, '2017_11_26_055417_added_no_of_account_in_users', 1),
(81, '2017_11_26_061536_created_user_logged_in_table', 1),
(82, '2017_12_12_173534_changed_data_type_of_admin_video_amount', 1),
(83, '2017_12_13_094327_added_fields_in_pay_perviews', 1),
(84, '2017_12_22_182954_add_notes_to_user_payments_table', 1),
(85, '2017_12_22_183016_add_notes_to_pay_per_views_table', 1),
(86, '2017_12_27_074050_add_commission_fields_to_pay_per_views_table', 1),
(87, '2017_12_27_085914_add_commission_spilit_details_to_redeems', 1),
(88, '2017_12_28_094142_changed_data_type_of_redeem', 1),
(89, '2018_01_27_073919_added_cancel_subscription_status', 1),
(90, '2018_03_13_062232_create_coupons_table', 1),
(91, '2018_03_13_190955_create_continue_watching_videos_table', 1),
(92, '2018_03_13_191127_add_position_in_admin_videos_table', 1),
(93, '2018_03_14_074409_add_duration_of_the_video_in_continue_watching', 1),
(94, '2018_03_16_135221_add_payment_mode_in_user_payments', 1),
(95, '2018_03_16_135256_add_payment_mode_in_pay_per_views', 1),
(96, '2018_03_19_104311_add_ppv_amount_to_pay_per_views', 1),
(97, '2018_03_19_105540_add_sub_coupon_amount', 1),
(98, '2018_03_19_112443_add_age_in_admin_videos', 1),
(99, '2018_03_19_113402_add_email_notification_in_users', 1),
(100, '2018_03_19_113707_create_email_templates_table', 1),
(101, '2018_05_05_064436_added_enum_values_in_pages', 1),
(102, '2018_05_28_081507_add_user_type_by_field_to_users_table', 1),
(103, '2018_05_29_094606_add_auto_renewal_fields_to_user_payments_table', 1),
(104, '2018_06_20_112835_add_coupon_status_fields_in_user_payments', 1),
(105, '2018_06_20_112849_add_coupon_status_fields_in_pay_per_views', 1),
(106, '2018_06_21_123332_add_ppv_fields_in_admin_videos_table', 1),
(107, '2018_06_21_123354_add_ppv_fields_in_pay_per_views_table', 1),
(108, '2018_07_03_094024_add_compression_status_in_admin_videos_table', 1),
(109, '2018_07_04_095136_create_cast_crews_table', 1),
(110, '2018_07_04_120838_create_video_cast_crews_table', 1),
(111, '2018_07_07_090350_add_cancel_resaon_in_subscriptions', 1),
(112, '2018_07_07_103833_add_coupon_fields_in_coupons_table', 1),
(113, '2018_07_07_114047_create_user_coupons_table', 1),
(114, '2018_07_09_182616_add_payment_fields_in_table', 1),
(115, '2018_07_10_103948_add_video_fields_in_admin_videos_table', 1),
(116, '2018_07_13_062658_change_coupon_fields_in_user_paymants_table', 1),
(117, '2018_08_01_133331_add_payment_mode_to_redeem_requests_table', 1),
(118, '2018_09_10_083546_add_download_fields_in_admin_videos', 1),
(119, '2018_09_17_110923_create_offline_admin_videos', 1),
(120, '2018_09_25_115241_add_fields_in_admins_table', 1),
(121, '2018_10_11_113012_add_kids_fields_in_admin_videos', 1),
(122, '2018_11_26_153554_add_fields_in_user_notifications_table', 1),
(123, '2019_01_19_071509_version_4_tables_and_changes', 1),
(124, '2019_03_13_092259_add_v4_1_migrations', 1),
(125, '2019_03_14_053152_create_sub_admins_table', 1),
(126, '2019_05_13_070759_add_is_current_to_user_payments_table', 1),
(127, '2019_09_23_095351_add_section_type_to_static_pages', 1),
(128, '2020_02_17_161716_v6_0_referral_related_migrations', 1),
(129, '2020_02_20_135523_v6_0_wallet_related_migrations', 1),
(130, '2020_05_07_081537_add_apple_to_users_table', 1),
(131, '2020_06_03_065322_add_player_json_to_admin_videos_table', 1),
(132, '2020_07_25_081948_add_default_to_fields_version_upgrade', 1),
(133, '2020_07_31_121603_add_hls_video_fields_to_admin_videos_table', 1),
(134, '2020_08_14_080400_create_video_watch_count_table', 1),
(135, '2020_09_04_055441_createfaqs_table', 1),
(136, '2020_10_07_104801_add_subtitle_vtt_fields_to_admin_videos', 1),
(137, '2021_08_05_111057_create_currencies_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mobile_registers`
--

CREATE TABLE `mobile_registers` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mobile_registers`
--

INSERT INTO `mobile_registers` (`id`, `type`, `count`, `created_at`, `updated_at`) VALUES
(1, 'android', 0, NULL, NULL),
(2, 'ios', 0, NULL, NULL),
(3, 'web', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `moderators`
--

CREATE TABLE `moderators` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token_expiry` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `is_activated` int(11) NOT NULL DEFAULT '1',
  `is_user` int(11) NOT NULL DEFAULT '0',
  `gender` enum('male','female','others') COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `paypal_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timezone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'America/Los_Angeles',
  `total` double(8,2) DEFAULT '0.00',
  `total_admin_amount` double(8,2) DEFAULT '0.00',
  `total_user_amount` double(8,2) DEFAULT '0.00',
  `paid_amount` double(8,2) DEFAULT '0.00',
  `remaining_amount` double(8,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `moderators`
--

INSERT INTO `moderators` (`id`, `name`, `email`, `password`, `token`, `token_expiry`, `picture`, `description`, `is_activated`, `is_user`, `gender`, `mobile`, `paypal_email`, `address`, `remember_token`, `timezone`, `total`, `total_admin_amount`, `total_user_amount`, `paid_amount`, `remaining_amount`, `created_at`, `updated_at`) VALUES
(1, 'Moderator', 'moderator@streamview.com', '$2y$10$jDNPRHMJCzi.l365h10PXeZdw6fLXwedZSKiRHs9aQw4JEl92JUyS', '2y10kzNzUoyfyJ2HcQA29L1ubcj7JGN2Hq5aNlVysnhQSY7A0PE1xgm', '1628959233', 'http://adminview.streamhash.com/placeholder.png', 'description', 1, 0, 'male', '85465765', '', '', NULL, 'America/Los_Angeles', 0.00, 0.00, 0.00, 0.00, 0.00, '2021-08-14 10:10:33', '2021-08-14 10:10:33'),
(2, 'Moderator', 'test@streamview.com', '$2y$10$Rdgw/WUsFoZwmEE9khgkmuG7B3EjEWpnv.wswsTLrrZ5Pye2Z/zHi', '2y10WqQ8Zuwc0nnZ2vr5wnmcFO5x4O3yVpR5TSGgZ3sMqMSSEjWq9WjO', '1628959233', 'http://adminview.streamhash.com/placeholder.png', 'description', 1, 0, 'male', '85465765', '', '', NULL, 'America/Los_Angeles', 0.00, 0.00, 0.00, 0.00, 0.00, '2021-08-14 10:10:33', '2021-08-14 10:10:33');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `admin_video_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_templates`
--

CREATE TABLE `notification_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_templates`
--

INSERT INTO `notification_templates` (`id`, `type`, `subject`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 'NEW_VIDEO', '\'<%video_name%>\' in <%site_name%>', '\'<%video_name%>\' video uploaded in \'<%category_name%>\' Category, don\'t miss the video from <%site_name%>', 1, '2021-08-14 10:10:34', '2021-08-14 10:10:34'),
(2, 'EDIT_VIDEO', '\'<%video_name%>\' in <%site_name%>', '\'<%video_name%>\' video uploaded in \'<%category_name%>\' Category, don\'t miss the video from <%site_name%>', 1, '2021-08-14 10:10:34', '2021-08-14 10:10:34'),
(3, 'moderator_update_mail', 'Email Change Notification', '2021-08-14 15:40:34', 1, '0000-00-00 00:00:00', '2021-08-14 10:10:34'),
(4, 'automatic_renewal', 'Automatic Renewal Notification', '2021-08-14 15:40:34', 1, '0000-00-00 00:00:00', '2021-08-14 10:10:34');

-- --------------------------------------------------------

--
-- Table structure for table `offline_admin_videos`
--

CREATE TABLE `offline_admin_videos` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_video_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sub_profile_id` int(11) NOT NULL,
  `download_status` tinyint(4) NOT NULL COMMENT '1 - Started Download, 2 - Onprogress, 3 - Pause, 4 - Completed, 5 - Failed/Cancelled,',
  `download_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `is_expired` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '6117e3c92aed2',
  `heading` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('about','privacy','terms','help','others','contact','faq') COLLATE utf8mb4_unicode_ci DEFAULT 'contact',
  `section_type` enum('1','2','3','4') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `unique_id`, `heading`, `description`, `type`, `section_type`, `status`, `created_at`, `updated_at`, `title`) VALUES
(1, 'about', 'about', 'about', 'about', '1', 1, '2021-08-14 10:10:34', '2021-08-14 10:10:34', ''),
(2, 'contact', 'contact', 'contact', 'contact', '1', 1, '2021-08-14 10:10:34', '2021-08-14 10:10:34', ''),
(3, 'privacy', 'privacy', 'privacy', 'privacy', '1', 1, '2021-08-14 10:10:34', '2021-08-14 10:10:34', ''),
(4, 'terms', 'terms', 'terms', 'terms', '1', 1, '2021-08-14 10:10:34', '2021-08-14 10:10:34', ''),
(5, 'help', 'help', 'help', 'help', '1', 1, '2021-08-14 10:10:35', '2021-08-14 10:10:35', '');

-- --------------------------------------------------------

--
-- Table structure for table `page_counters`
--

CREATE TABLE `page_counters` (
  `id` int(10) UNSIGNED NOT NULL,
  `page` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pay_per_views`
--

CREATE TABLE `pay_per_views` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key, It is an unique key',
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'User table Primary key given as Foreign Key',
  `video_id` int(10) UNSIGNED NOT NULL COMMENT 'Admin Video table Primary key given as Foreign Key',
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ppv_amount` double(8,2) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `payment_mode` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_amount` double(8,2) NOT NULL,
  `moderator_amount` double(8,2) NOT NULL,
  `type_of_subscription` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_of_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiry_date` datetime NOT NULL,
  `is_coupon_applied` tinyint(4) NOT NULL,
  `coupon_reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_watched` tinyint(4) NOT NULL,
  `paid_date` date NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0' COMMENT 'Status of the per_per_view table',
  `reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_amount` double(8,2) NOT NULL,
  `is_wallet_credits_applied` tinyint(4) NOT NULL DEFAULT '0',
  `wallet_amount` double(8,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `redeems`
--

CREATE TABLE `redeems` (
  `id` int(10) UNSIGNED NOT NULL,
  `moderator_id` int(11) NOT NULL,
  `total` double(8,2) DEFAULT '0.00',
  `total_admin_amount` double(8,2) DEFAULT '0.00',
  `total_moderator_amount` double(8,2) DEFAULT '0.00',
  `paid` double(8,2) DEFAULT '0.00',
  `remaining` double(8,2) DEFAULT '0.00',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `redeem_requests`
--

CREATE TABLE `redeem_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `moderator_id` int(11) NOT NULL,
  `request_amount` double(8,2) NOT NULL,
  `paid_amount` double(8,2) NOT NULL,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_paid_amount` double(8,2) NOT NULL COMMENT 'Temporary Column',
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_mode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `referral_codes`
--

CREATE TABLE `referral_codes` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '6117e3d325d82',
  `user_id` int(11) NOT NULL,
  `referral_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `total_referrals` int(11) NOT NULL DEFAULT '0',
  `referral_earnings` double(8,2) NOT NULL DEFAULT '0.00' COMMENT 'Using the current user code, if someone joined means the current user will get this earnings',
  `referee_earnings` double(8,2) NOT NULL DEFAULT '0.00' COMMENT 'if the current user joined using someother user referral code means the current user will get some earnings',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(16, 'site_name', 'StreamHash', NULL, NULL),
(17, 'site_logo', 'http://localhost/logo.png', NULL, NULL),
(18, 'site_icon', 'http://localhost/favicon.png', NULL, NULL),
(19, 'tag_name', '', NULL, NULL),
(20, 'browser_key', '', NULL, NULL),
(21, 'default_lang', 'en', NULL, NULL),
(22, 'currency', '$', NULL, NULL),
(23, 'admin_delete_control', '0', NULL, NULL),
(24, 'installation_process', '0', NULL, NULL),
(25, 'amount', '10', NULL, NULL),
(26, 'expiry_days', '28', NULL, NULL),
(27, 'admin_take_count', '12', NULL, NULL),
(28, 'google_analytics', '', NULL, NULL),
(29, 'streaming_url', '', NULL, NULL),
(30, 'video_compress_size', '50', NULL, NULL),
(31, 'image_compress_size', '8', NULL, NULL),
(32, 's3_bucket', '', NULL, NULL),
(33, 'track_user_mail', '', NULL, NULL),
(34, 'REPORT_VIDEO', 'Sexual content', NULL, NULL),
(35, 'REPORT_VIDEO', 'Violent or repulsive content.', NULL, NULL),
(36, 'REPORT_VIDEO', 'Hateful or abusive content.', NULL, NULL),
(37, 'REPORT_VIDEO', 'Harmful dangerous acts.', NULL, NULL),
(38, 'REPORT_VIDEO', 'Child abuse.', NULL, NULL),
(39, 'REPORT_VIDEO', 'Spam or misleading.', NULL, NULL),
(40, 'REPORT_VIDEO', 'Infringes my rights.', NULL, NULL),
(41, 'REPORT_VIDEO', 'Captions issue.', NULL, NULL),
(42, 'VIDEO_RESOLUTIONS', '426x240', NULL, NULL),
(43, 'VIDEO_RESOLUTIONS', '640x360', NULL, NULL),
(44, 'VIDEO_RESOLUTIONS', '854x480', NULL, NULL),
(45, 'VIDEO_RESOLUTIONS', '1280x720', NULL, NULL),
(46, 'VIDEO_RESOLUTIONS', '1920x1080', NULL, NULL),
(47, 'redeem_paypal_url', 'https://www.sandbox.paypal.com/cgi-bin/webscr', NULL, NULL),
(48, 'custom_users_count', '50', NULL, NULL),
(49, 'admin_language_control', '1', NULL, NULL),
(50, 'post_max_size', '2000M', NULL, NULL),
(51, 'upload_max_size', '2000M', NULL, NULL),
(52, 'minimum_redeem', '1', NULL, NULL),
(53, 'redeem_control', '1', NULL, NULL),
(54, 'admin_commission', '10', NULL, NULL),
(55, 'user_commission', '90', NULL, NULL),
(56, 'home_page_bg_image', 'http://localhost/images/home_page_bg_image.jpg', NULL, NULL),
(57, 'common_bg_image', 'http://localhost/images/login-bg.jpg', NULL, NULL),
(58, 'stripe_publishable_key', 'pk_test_uDYrTXzzAuGRwDYtu7dkhaF3', NULL, NULL),
(59, 'stripe_secret_key', 'sk_test_lRUbYflDyRP3L2UbnsehTUHW', NULL, NULL),
(60, 'video_viewer_count', '10', NULL, NULL),
(61, 'amount_per_video', '100', NULL, NULL),
(62, 'facebook_link', '', NULL, NULL),
(63, 'linkedin_link', '', NULL, NULL),
(64, 'twitter_link', '', NULL, NULL),
(65, 'google_plus_link', '', NULL, NULL),
(66, 'pinterest_link', '', NULL, NULL),
(67, 'instagram_link', '', NULL, NULL),
(68, 'appstore', '', NULL, NULL),
(69, 'playstore', '', NULL, NULL),
(70, 'copyright_content', 'Copyrights 2018 . All rights reserved.', NULL, NULL),
(71, 'contact_email', '', NULL, NULL),
(72, 'contact_address', '', NULL, NULL),
(73, 'contact_mobile', '', NULL, NULL),
(74, 'watermark_logo', 'http://localhost/watermark_logo.png', NULL, NULL),
(75, 'referral_earnings', '10', NULL, NULL),
(76, 'referrer_earnings', '10', NULL, NULL),
(77, 'download_video_expiry_days', '3', NULL, NULL),
(78, 'is_jwplayer_configured_mobile', '1', NULL, NULL),
(79, 'jwplayer_key_mobile', '3FqL/SpvVBWLTmzbGsWMN5QGtFxz/V+KTAH2uZpHiNZTK7G2g91lMuiGeuwcZ+fR', NULL, NULL),
(80, 'currency_code', 'USD', NULL, NULL),
(81, 'max_banner_count', '6', NULL, NULL),
(82, 'max_home_count', '6', NULL, NULL),
(83, 'max_original_count', '20', NULL, NULL),
(84, 'is_home_category_feature', '0', NULL, NULL),
(85, 'token_expiry_hour', '1000000', NULL, NULL),
(86, 'is_subscription', '1', NULL, NULL),
(87, 'is_spam', '1', NULL, NULL),
(88, 'is_payper_view', '1', NULL, NULL),
(89, 'socket_url', '', NULL, NULL),
(90, 'FB_CLIENT_ID', '', NULL, NULL),
(91, 'FB_CLIENT_SECRET', '', NULL, NULL),
(92, 'FB_CALL_BACK', '', NULL, NULL),
(93, 'TWITTER_CLIENT_ID', '', NULL, NULL),
(94, 'TWITTER_CLIENT_SECRET', '', NULL, NULL),
(95, 'TWITTER_CALL_BACK', '', NULL, NULL),
(96, 'GOOGLE_CLIENT_ID', '', NULL, NULL),
(97, 'GOOGLE_CLIENT_SECRET', '', NULL, NULL),
(98, 'GOOGLE_CALL_BACK', '', NULL, NULL),
(99, 'social_email_suffix', '@streamhash.com', NULL, NULL),
(100, 'meta_title', 'STREAMVIEW', NULL, NULL),
(101, 'meta_description', 'STREAMVIEW', NULL, NULL),
(102, 'meta_author', 'STREAMVIEW', NULL, NULL),
(103, 'meta_keywords', 'STREAMVIEW', NULL, NULL),
(104, 'header_scripts', '', NULL, NULL),
(105, 'body_scripts', '', NULL, NULL),
(106, 'ANGULAR_SITE_URL', '', NULL, NULL),
(107, 'is_push_notification', '1', NULL, NULL),
(108, 'no_of_static_pages', '8', NULL, NULL),
(109, 'MAILGUN_PUBLIC_KEY', '', NULL, NULL),
(110, 'MAILGUN_PRIVATE_KEY', '', NULL, NULL),
(111, 'is_mailgun_check_email', '0', NULL, NULL),
(112, 'ios_payment_subscription_status', '0', NULL, NULL),
(113, 'prefix_file_name', 'SV', NULL, NULL),
(114, 'ffmpeg_installed', '1', NULL, NULL),
(115, 'email_verify_control', '0', NULL, NULL),
(116, 'email_notification', '1', NULL, NULL),
(117, 'demo_admin_email', '', NULL, NULL),
(118, 'JWPLAYER_KEY', 'M2NCefPoiiKsaVB8nTttvMBxfb1J3Xl7PDXSaw==', NULL, NULL),
(119, 'HLS_STREAMING_URL', '', NULL, NULL),
(120, 'JWPLAYER_KEY_ANDRIOD', '', NULL, NULL),
(121, 'JWPLAYER_KEY_IOS', '', NULL, NULL),
(122, 'video_player_type', '2', NULL, NULL),
(123, 'RTMP_SECURE_VIDEO_URL', '', NULL, NULL),
(124, 'HLS_SECURE_VIDEO_URL', '', NULL, NULL),
(125, 'VIDEO_SMIL_URL', '', NULL, NULL),
(126, 'promo_video', '', '2021-08-14 10:10:35', '2021-08-14 10:10:35'),
(127, 'is_promo_video_enabled', '0', '2021-08-14 10:10:35', '2021-08-14 10:10:35'),
(128, 'is_watermark_logo_enabled', '0', NULL, NULL),
(129, 'watermark_logo', '', NULL, NULL),
(130, 'watermark_position', 'top-left', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '6117e3d3618a3',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscription_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'month,year,days',
  `plan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `total_subscription` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `popular_status` int(11) NOT NULL DEFAULT '0',
  `no_of_account` int(11) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_admins`
--

CREATE TABLE `sub_admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `gender` enum('male','female','others') COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paypal_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token_expiry` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timezone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `is_home_display` int(11) NOT NULL DEFAULT '0',
  `is_approved` int(11) NOT NULL DEFAULT '1',
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_category_images`
--

CREATE TABLE `sub_category_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_profiles`
--

CREATE TABLE `sub_profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_profiles`
--

INSERT INTO `sub_profiles` (`id`, `user_id`, `name`, `picture`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'User', 'http://adminview.streamhash.com/placeholder.png', 1, '2021-08-14 10:10:35', '2021-08-14 10:10:35'),
(2, 2, 'Test', 'http://adminview.streamhash.com/placeholder.png', 1, '2021-08-14 10:10:35', '2021-08-14 10:10:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token_expiry` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `device_type` enum('android','ios','web') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `login_by` enum('manual','facebook','apple','twitter','instagram','google') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'manual',
  `social_unique_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `fb_lg` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `gl_lg` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `is_activated` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '0',
  `email_notification_status` int(11) NOT NULL DEFAULT '0',
  `push_notification_status` int(11) NOT NULL,
  `email_notification` tinyint(4) NOT NULL DEFAULT '1',
  `no_of_account` int(11) NOT NULL DEFAULT '0',
  `logged_in_account` int(11) NOT NULL DEFAULT '0',
  `card_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `payment_mode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cod',
  `verification_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `verification_code_expiry` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `is_verified` int(11) NOT NULL DEFAULT '0',
  `push_status` int(11) NOT NULL DEFAULT '0',
  `user_type` int(11) NOT NULL DEFAULT '0',
  `user_type_change_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `is_moderator` int(11) NOT NULL DEFAULT '0',
  `moderator_id` int(11) NOT NULL DEFAULT '0',
  `gender` enum('male','female','others') COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `latitude` double(15,8) DEFAULT '0.00000000',
  `longitude` double(15,8) DEFAULT '0.00000000',
  `paypal_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timezone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'America/Los_Angeles',
  `amount_paid` double(8,2) DEFAULT '0.00',
  `expiry_date` datetime DEFAULT NULL,
  `no_of_days` int(11) NOT NULL DEFAULT '0',
  `one_time_subscription` int(11) NOT NULL DEFAULT '0' COMMENT '0 - Not Subscribed , 1 - Subscribed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `picture`, `token`, `token_expiry`, `device_token`, `device_type`, `login_by`, `social_unique_id`, `fb_lg`, `gl_lg`, `description`, `is_activated`, `status`, `email_notification_status`, `push_notification_status`, `email_notification`, `no_of_account`, `logged_in_account`, `card_id`, `payment_mode`, `verification_code`, `verification_code_expiry`, `is_verified`, `push_status`, `user_type`, `user_type_change_by`, `is_moderator`, `moderator_id`, `gender`, `mobile`, `latitude`, `longitude`, `paypal_email`, `address`, `remember_token`, `timezone`, `amount_paid`, `expiry_date`, `no_of_days`, `one_time_subscription`, `created_at`, `updated_at`) VALUES
(1, 'User', 'user@streamview.com', '$2y$10$14UI2teC.rTnGLSG/6ac7.FPXMh1DxwyGm5Jo4BKnbI8aQ3U1EJw2', 'http://adminview.streamhash.com/placeholder.png', '2y10VXSGTFiZp5rbI1NUIBmuy0DOoQKNbKHwz33WdBX4y1rar6BK', '1628959232', '', 'web', 'manual', '', '', '', '', 1, 1, 0, 0, 1, 0, 0, '0', 'cod', '', '', 1, 0, 1, '', 0, 0, 'male', '', 0.00000000, 0.00000000, '', '', NULL, 'America/Los_Angeles', 0.00, NULL, 0, 0, '2021-08-14 10:10:32', '2021-08-14 10:10:32'),
(2, 'Test', 'test@streamview.com', '$2y$10$MprbMD4pTrp3G58mKlkZWuIOUzbbD6/S23gzDmQFSFoIG7ccJnqL6', 'http://adminview.streamhash.com/placeholder.png', '2y10rk0Nv1ac8BmSEiPbwLrinOfe2QfauHnJnjOlvpVDMeVh9ievwQaJe', '1628959232', '', 'web', 'manual', '', '', '', '', 1, 1, 0, 0, 1, 0, 0, '0', 'cod', '', '', 1, 0, 1, '', 0, 0, 'male', '', 0.00000000, 0.00000000, '', '', NULL, 'America/Los_Angeles', 0.00, NULL, 0, 0, '2021-08-14 10:10:32', '2021-08-14 10:10:32');

-- --------------------------------------------------------

--
-- Table structure for table `user_coupons`
--

CREATE TABLE `user_coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_of_times_used` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_histories`
--

CREATE TABLE `user_histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `sub_profile_id` int(11) NOT NULL,
  `admin_video_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_logged_devices`
--

CREATE TABLE `user_logged_devices` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `token_expiry` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_payments`
--

CREATE TABLE `user_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_current` tinyint(4) NOT NULL,
  `subscription_amount` double(8,2) NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `payment_mode` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiry_date` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `from_auto_renewed` int(11) NOT NULL,
  `reason_auto_renewal_cancel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_cancelled` int(11) NOT NULL,
  `is_coupon_applied` tinyint(4) NOT NULL,
  `coupon_reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cancel_reason` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_wallet_credits_applied` tinyint(4) NOT NULL DEFAULT '0',
  `wallet_amount` double(8,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_ratings`
--

CREATE TABLE `user_ratings` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `admin_video_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_referrals`
--

CREATE TABLE `user_referrals` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_user_id` int(11) NOT NULL,
  `referral_code_id` int(11) NOT NULL,
  `referral_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `device_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'web',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_tracks`
--

CREATE TABLE `user_tracks` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `HTTP_USER_AGENT` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `REQUEST_TIME` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `REMOTE_ADDR` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hostname` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` double(10,8) NOT NULL,
  `longitude` double(10,8) NOT NULL,
  `origin` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `others` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `view` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `video_cast_crews`
--

CREATE TABLE `video_cast_crews` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_video_id` int(11) NOT NULL,
  `cast_crew_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `video_watch_counts`
--

CREATE TABLE `video_watch_counts` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_video_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `watch_count` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `sub_profile_id` int(11) NOT NULL,
  `admin_video_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_videos`
--
ALTER TABLE `admin_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_video_images`
--
ALTER TABLE `admin_video_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_video_subtitles`
--
ALTER TABLE `admin_video_subtitles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cast_crews`
--
ALTER TABLE `cast_crews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `continue_watching_videos`
--
ALTER TABLE `continue_watching_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_coupon_code_unique` (`coupon_code`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currencies_currency_name_unique` (`currency_name`),
  ADD UNIQUE KEY `currencies_currency_code_unique` (`currency_code`);

--
-- Indexes for table `custom_wallets`
--
ALTER TABLE `custom_wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_wallet_histories`
--
ALTER TABLE `custom_wallet_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_wallet_payments`
--
ALTER TABLE `custom_wallet_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_wallet_vouchers`
--
ALTER TABLE `custom_wallet_vouchers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flags`
--
ALTER TABLE `flags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_reserved_reserved_at_index` (`queue`,`reserved`,`reserved_at`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like_dislike_videos`
--
ALTER TABLE `like_dislike_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobile_registers`
--
ALTER TABLE `mobile_registers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moderators`
--
ALTER TABLE `moderators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `moderators_email_unique` (`email`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_templates`
--
ALTER TABLE `notification_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offline_admin_videos`
--
ALTER TABLE `offline_admin_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_counters`
--
ALTER TABLE `page_counters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pay_per_views`
--
ALTER TABLE `pay_per_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `redeems`
--
ALTER TABLE `redeems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `redeem_requests`
--
ALTER TABLE `redeem_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referral_codes`
--
ALTER TABLE `referral_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settings_key_index` (`key`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_admins`
--
ALTER TABLE `sub_admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sub_admins_email_unique` (`email`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category_images`
--
ALTER TABLE `sub_category_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_profiles`
--
ALTER TABLE `sub_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_coupons`
--
ALTER TABLE `user_coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_histories`
--
ALTER TABLE `user_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_logged_devices`
--
ALTER TABLE `user_logged_devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_payments`
--
ALTER TABLE `user_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_ratings`
--
ALTER TABLE `user_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_referrals`
--
ALTER TABLE `user_referrals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_tracks`
--
ALTER TABLE `user_tracks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video_cast_crews`
--
ALTER TABLE `video_cast_crews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video_watch_counts`
--
ALTER TABLE `video_watch_counts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `admin_videos`
--
ALTER TABLE `admin_videos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `admin_video_images`
--
ALTER TABLE `admin_video_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `admin_video_subtitles`
--
ALTER TABLE `admin_video_subtitles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cast_crews`
--
ALTER TABLE `cast_crews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `continue_watching_videos`
--
ALTER TABLE `continue_watching_videos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;
--
-- AUTO_INCREMENT for table `custom_wallets`
--
ALTER TABLE `custom_wallets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `custom_wallet_histories`
--
ALTER TABLE `custom_wallet_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `custom_wallet_payments`
--
ALTER TABLE `custom_wallet_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `custom_wallet_vouchers`
--
ALTER TABLE `custom_wallet_vouchers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `flags`
--
ALTER TABLE `flags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key, It is an unique key';
--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `like_dislike_videos`
--
ALTER TABLE `like_dislike_videos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;
--
-- AUTO_INCREMENT for table `mobile_registers`
--
ALTER TABLE `mobile_registers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `moderators`
--
ALTER TABLE `moderators`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notification_templates`
--
ALTER TABLE `notification_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `offline_admin_videos`
--
ALTER TABLE `offline_admin_videos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `page_counters`
--
ALTER TABLE `page_counters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pay_per_views`
--
ALTER TABLE `pay_per_views`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key, It is an unique key';
--
-- AUTO_INCREMENT for table `redeems`
--
ALTER TABLE `redeems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `redeem_requests`
--
ALTER TABLE `redeem_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `referral_codes`
--
ALTER TABLE `referral_codes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sub_admins`
--
ALTER TABLE `sub_admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sub_category_images`
--
ALTER TABLE `sub_category_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sub_profiles`
--
ALTER TABLE `sub_profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_coupons`
--
ALTER TABLE `user_coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_histories`
--
ALTER TABLE `user_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_logged_devices`
--
ALTER TABLE `user_logged_devices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_payments`
--
ALTER TABLE `user_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_ratings`
--
ALTER TABLE `user_ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_referrals`
--
ALTER TABLE `user_referrals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_tracks`
--
ALTER TABLE `user_tracks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `video_cast_crews`
--
ALTER TABLE `video_cast_crews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `video_watch_counts`
--
ALTER TABLE `video_watch_counts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
