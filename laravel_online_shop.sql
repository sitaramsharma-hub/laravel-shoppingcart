-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2025 at 07:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_online_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `status`) VALUES
(1, 'Canon', 'canon', 1),
(2, 'Sony', 'sony', 1),
(3, 'Vivo', 'vivo', 1),
(4, 'Oppo', 'oppp', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'null',
  `status` int(11) NOT NULL DEFAULT 1,
  `showHome` enum('Yes','No') NOT NULL DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `status`, `showHome`, `created_at`, `updated_at`) VALUES
(50, 'Electronics', 'electronics', '50.jpg', 1, 'No', '2024-09-03 12:25:33', '2024-09-05 11:40:27'),
(51, 'Men\'s Fashion', 'mens-fashion', '51.jpg', 1, 'Yes', '2024-09-03 12:26:26', '2024-09-03 19:14:08'),
(52, 'Women\'s Fashion', 'womens-fashion', '52.jpg', 1, 'Yes', '2024-09-03 12:26:55', '2024-09-03 19:14:01'),
(53, 'Appliances', 'appliances', '53.jpg', 1, 'Yes', '2024-09-03 12:27:15', '2024-09-03 19:09:10'),
(54, 'Baby Toy', 'baby-toy', '54.jpg', 1, 'Yes', '2024-09-06 11:27:56', '2024-09-06 11:27:57');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'United States', 'US', NULL, NULL),
(2, 'Canada', 'CA', NULL, NULL),
(3, 'Afghanistan', 'AF', NULL, NULL),
(4, 'Albania', 'AL', NULL, NULL),
(5, 'Algeria', 'DZ', NULL, NULL),
(6, 'American Samoa', 'AS', NULL, NULL),
(7, 'Andorra', 'AD', NULL, NULL),
(8, 'Angola', 'AO', NULL, NULL),
(9, 'Anguilla', 'AI', NULL, NULL),
(10, 'Antarctica', 'AQ', NULL, NULL),
(11, 'Antigua and/or Barbuda', 'AG', NULL, NULL),
(12, 'Argentina', 'AR', NULL, NULL),
(13, 'Armenia', 'AM', NULL, NULL),
(14, 'Aruba', 'AW', NULL, NULL),
(15, 'Australia', 'AU', NULL, NULL),
(16, 'Austria', 'AT', NULL, NULL),
(17, 'Azerbaijan', 'AZ', NULL, NULL),
(18, 'Bahamas', 'BS', NULL, NULL),
(19, 'Bahrain', 'BH', NULL, NULL),
(20, 'Bangladesh', 'BD', NULL, NULL),
(21, 'Barbados', 'BB', NULL, NULL),
(22, 'Belarus', 'BY', NULL, NULL),
(23, 'Belgium', 'BE', NULL, NULL),
(24, 'Belize', 'BZ', NULL, NULL),
(25, 'Benin', 'BJ', NULL, NULL),
(26, 'Bermuda', 'BM', NULL, NULL),
(27, 'Bhutan', 'BT', NULL, NULL),
(28, 'Bolivia', 'BO', NULL, NULL),
(29, 'Bosnia and Herzegovina', 'BA', NULL, NULL),
(30, 'Botswana', 'BW', NULL, NULL),
(31, 'Bouvet Island', 'BV', NULL, NULL),
(32, 'Brazil', 'BR', NULL, NULL),
(33, 'British lndian Ocean Territory', 'IO', NULL, NULL),
(34, 'Brunei Darussalam', 'BN', NULL, NULL),
(35, 'Bulgaria', 'BG', NULL, NULL),
(36, 'Burkina Faso', 'BF', NULL, NULL),
(37, 'Burundi', 'BI', NULL, NULL),
(38, 'Cambodia', 'KH', NULL, NULL),
(39, 'Cameroon', 'CM', NULL, NULL),
(40, 'Cape Verde', 'CV', NULL, NULL),
(41, 'Cayman Islands', 'KY', NULL, NULL),
(42, 'Central African Republic', 'CF', NULL, NULL),
(43, 'Chad', 'TD', NULL, NULL),
(44, 'Chile', 'CL', NULL, NULL),
(45, 'China', 'CN', NULL, NULL),
(46, 'Christmas Island', 'CX', NULL, NULL),
(47, 'Cocos (Keeling) Islands', 'CC', NULL, NULL),
(48, 'Colombia', 'CO', NULL, NULL),
(49, 'Comoros', 'KM', NULL, NULL),
(50, 'Congo', 'CG', NULL, NULL),
(51, 'Cook Islands', 'CK', NULL, NULL),
(52, 'Costa Rica', 'CR', NULL, NULL),
(53, 'Croatia (Hrvatska)', 'HR', NULL, NULL),
(54, 'Cuba', 'CU', NULL, NULL),
(55, 'Cyprus', 'CY', NULL, NULL),
(56, 'Czech Republic', 'CZ', NULL, NULL),
(57, 'Democratic Republic of Congo', 'CD', NULL, NULL),
(58, 'Denmark', 'DK', NULL, NULL),
(59, 'Djibouti', 'DJ', NULL, NULL),
(60, 'Dominica', 'DM', NULL, NULL),
(61, 'Dominican Republic', 'DO', NULL, NULL),
(62, 'East Timor', 'TP', NULL, NULL),
(63, 'Ecudaor', 'EC', NULL, NULL),
(64, 'Egypt', 'EG', NULL, NULL),
(65, 'El Salvador', 'SV', NULL, NULL),
(66, 'Equatorial Guinea', 'GQ', NULL, NULL),
(67, 'Eritrea', 'ER', NULL, NULL),
(68, 'Estonia', 'EE', NULL, NULL),
(69, 'Ethiopia', 'ET', NULL, NULL),
(70, 'Falkland Islands (Malvinas)', 'FK', NULL, NULL),
(71, 'Faroe Islands', 'FO', NULL, NULL),
(72, 'Fiji', 'FJ', NULL, NULL),
(73, 'Finland', 'FI', NULL, NULL),
(74, 'France', 'FR', NULL, NULL),
(75, 'France, Metropolitan', 'FX', NULL, NULL),
(76, 'French Guiana', 'GF', NULL, NULL),
(77, 'French Polynesia', 'PF', NULL, NULL),
(78, 'French Southern Territories', 'TF', NULL, NULL),
(79, 'Gabon', 'GA', NULL, NULL),
(80, 'Gambia', 'GM', NULL, NULL),
(81, 'Georgia', 'GE', NULL, NULL),
(82, 'Germany', 'DE', NULL, NULL),
(83, 'Ghana', 'GH', NULL, NULL),
(84, 'Gibraltar', 'GI', NULL, NULL),
(85, 'Greece', 'GR', NULL, NULL),
(86, 'Greenland', 'GL', NULL, NULL),
(87, 'Grenada', 'GD', NULL, NULL),
(88, 'Guadeloupe', 'GP', NULL, NULL),
(89, 'Guam', 'GU', NULL, NULL),
(90, 'Guatemala', 'GT', NULL, NULL),
(91, 'Guinea', 'GN', NULL, NULL),
(92, 'Guinea-Bissau', 'GW', NULL, NULL),
(93, 'Guyana', 'GY', NULL, NULL),
(94, 'Haiti', 'HT', NULL, NULL),
(95, 'Heard and Mc Donald Islands', 'HM', NULL, NULL),
(96, 'Honduras', 'HN', NULL, NULL),
(97, 'Hong Kong', 'HK', NULL, NULL),
(98, 'Hungary', 'HU', NULL, NULL),
(99, 'Iceland', 'IS', NULL, NULL),
(100, 'India', 'IN', NULL, NULL),
(101, 'Indonesia', 'ID', NULL, NULL),
(102, 'Iran (Islamic Republic of)', 'IR', NULL, NULL),
(103, 'Iraq', 'IQ', NULL, NULL),
(104, 'Ireland', 'IE', NULL, NULL),
(105, 'Israel', 'IL', NULL, NULL),
(106, 'Italy', 'IT', NULL, NULL),
(107, 'Ivory Coast', 'CI', NULL, NULL),
(108, 'Jamaica', 'JM', NULL, NULL),
(109, 'Japan', 'JP', NULL, NULL),
(110, 'Jordan', 'JO', NULL, NULL),
(111, 'Kazakhstan', 'KZ', NULL, NULL),
(112, 'Kenya', 'KE', NULL, NULL),
(113, 'Kiribati', 'KI', NULL, NULL),
(114, 'Korea, Democratic People\'s Republic of', 'KP', NULL, NULL),
(115, 'Korea, Republic of', 'KR', NULL, NULL),
(116, 'Kuwait', 'KW', NULL, NULL),
(117, 'Kyrgyzstan', 'KG', NULL, NULL),
(118, 'Lao People\'s Democratic Republic', 'LA', NULL, NULL),
(119, 'Latvia', 'LV', NULL, NULL),
(120, 'Lebanon', 'LB', NULL, NULL),
(121, 'Lesotho', 'LS', NULL, NULL),
(122, 'Liberia', 'LR', NULL, NULL),
(123, 'Libyan Arab Jamahiriya', 'LY', NULL, NULL),
(124, 'Liechtenstein', 'LI', NULL, NULL),
(125, 'Lithuania', 'LT', NULL, NULL),
(126, 'Luxembourg', 'LU', NULL, NULL),
(127, 'Macau', 'MO', NULL, NULL),
(128, 'Macedonia', 'MK', NULL, NULL),
(129, 'Madagascar', 'MG', NULL, NULL),
(130, 'Malawi', 'MW', NULL, NULL),
(131, 'Malaysia', 'MY', NULL, NULL),
(132, 'Maldives', 'MV', NULL, NULL),
(133, 'Mali', 'ML', NULL, NULL),
(134, 'Malta', 'MT', NULL, NULL),
(135, 'Marshall Islands', 'MH', NULL, NULL),
(136, 'Martinique', 'MQ', NULL, NULL),
(137, 'Mauritania', 'MR', NULL, NULL),
(138, 'Mauritius', 'MU', NULL, NULL),
(139, 'Mayotte', 'TY', NULL, NULL),
(140, 'Mexico', 'MX', NULL, NULL),
(141, 'Micronesia, Federated States of', 'FM', NULL, NULL),
(142, 'Moldova, Republic of', 'MD', NULL, NULL),
(143, 'Monaco', 'MC', NULL, NULL),
(144, 'Mongolia', 'MN', NULL, NULL),
(145, 'Montserrat', 'MS', NULL, NULL),
(146, 'Morocco', 'MA', NULL, NULL),
(147, 'Mozambique', 'MZ', NULL, NULL),
(148, 'Myanmar', 'MM', NULL, NULL),
(149, 'Namibia', 'NA', NULL, NULL),
(150, 'Nauru', 'NR', NULL, NULL),
(151, 'Nepal', 'NP', NULL, NULL),
(152, 'Netherlands', 'NL', NULL, NULL),
(153, 'Netherlands Antilles', 'AN', NULL, NULL),
(154, 'New Caledonia', 'NC', NULL, NULL),
(155, 'New Zealand', 'NZ', NULL, NULL),
(156, 'Nicaragua', 'NI', NULL, NULL),
(157, 'Niger', 'NE', NULL, NULL),
(158, 'Nigeria', 'NG', NULL, NULL),
(159, 'Niue', 'NU', NULL, NULL),
(160, 'Norfork Island', 'NF', NULL, NULL),
(161, 'Northern Mariana Islands', 'MP', NULL, NULL),
(162, 'Norway', 'NO', NULL, NULL),
(163, 'Oman', 'OM', NULL, NULL),
(164, 'Pakistan', 'PK', NULL, NULL),
(165, 'Palau', 'PW', NULL, NULL),
(166, 'Panama', 'PA', NULL, NULL),
(167, 'Papua New Guinea', 'PG', NULL, NULL),
(168, 'Paraguay', 'PY', NULL, NULL),
(169, 'Peru', 'PE', NULL, NULL),
(170, 'Philippines', 'PH', NULL, NULL),
(171, 'Pitcairn', 'PN', NULL, NULL),
(172, 'Poland', 'PL', NULL, NULL),
(173, 'Portugal', 'PT', NULL, NULL),
(174, 'Puerto Rico', 'PR', NULL, NULL),
(175, 'Qatar', 'QA', NULL, NULL),
(176, 'Republic of South Sudan', 'SS', NULL, NULL),
(177, 'Reunion', 'RE', NULL, NULL),
(178, 'Romania', 'RO', NULL, NULL),
(179, 'Russian Federation', 'RU', NULL, NULL),
(180, 'Rwanda', 'RW', NULL, NULL),
(181, 'Saint Kitts and Nevis', 'KN', NULL, NULL),
(182, 'Saint Lucia', 'LC', NULL, NULL),
(183, 'Saint Vincent and the Grenadines', 'VC', NULL, NULL),
(184, 'Samoa', 'WS', NULL, NULL),
(185, 'San Marino', 'SM', NULL, NULL),
(186, 'Sao Tome and Principe', 'ST', NULL, NULL),
(187, 'Saudi Arabia', 'SA', NULL, NULL),
(188, 'Senegal', 'SN', NULL, NULL),
(189, 'Serbia', 'RS', NULL, NULL),
(190, 'Seychelles', 'SC', NULL, NULL),
(191, 'Sierra Leone', 'SL', NULL, NULL),
(192, 'Singapore', 'SG', NULL, NULL),
(193, 'Slovakia', 'SK', NULL, NULL),
(194, 'Slovenia', 'SI', NULL, NULL),
(195, 'Solomon Islands', 'SB', NULL, NULL),
(196, 'Somalia', 'SO', NULL, NULL),
(197, 'South Africa', 'ZA', NULL, NULL),
(198, 'South Georgia South Sandwich Islands', 'GS', NULL, NULL),
(199, 'Spain', 'ES', NULL, NULL),
(200, 'Sri Lanka', 'LK', NULL, NULL),
(201, 'St. Helena', 'SH', NULL, NULL),
(202, 'St. Pierre and Miquelon', 'PM', NULL, NULL),
(203, 'Sudan', 'SD', NULL, NULL),
(204, 'Suriname', 'SR', NULL, NULL),
(205, 'Svalbarn and Jan Mayen Islands', 'SJ', NULL, NULL),
(206, 'Swaziland', 'SZ', NULL, NULL),
(207, 'Sweden', 'SE', NULL, NULL),
(208, 'Switzerland', 'CH', NULL, NULL),
(209, 'Syrian Arab Republic', 'SY', NULL, NULL),
(210, 'Taiwan', 'TW', NULL, NULL),
(211, 'Tajikistan', 'TJ', NULL, NULL),
(212, 'Tanzania, United Republic of', 'TZ', NULL, NULL),
(213, 'Thailand', 'TH', NULL, NULL),
(214, 'Togo', 'TG', NULL, NULL),
(215, 'Tokelau', 'TK', NULL, NULL),
(216, 'Tonga', 'TO', NULL, NULL),
(217, 'Trinidad and Tobago', 'TT', NULL, NULL),
(218, 'Tunisia', 'TN', NULL, NULL),
(219, 'Turkey', 'TR', NULL, NULL),
(220, 'Turkmenistan', 'TM', NULL, NULL),
(221, 'Turks and Caicos Islands', 'TC', NULL, NULL),
(222, 'Tuvalu', 'TV', NULL, NULL),
(223, 'Uganda', 'UG', NULL, NULL),
(224, 'Ukraine', 'UA', NULL, NULL),
(225, 'United Arab Emirates', 'AE', NULL, NULL),
(226, 'United Kingdom', 'GB', NULL, NULL),
(227, 'United States minor outlying islands', 'UM', NULL, NULL),
(228, 'Uruguay', 'UY', NULL, NULL),
(229, 'Uzbekistan', 'UZ', NULL, NULL),
(230, 'Vanuatu', 'VU', NULL, NULL),
(231, 'Vatican City State', 'VA', NULL, NULL),
(232, 'Venezuela', 'VE', NULL, NULL),
(233, 'Vietnam', 'VN', NULL, NULL),
(234, 'Virgin Islands (British)', 'VG', NULL, NULL),
(235, 'Virgin Islands (U.S.)', 'VI', NULL, NULL),
(236, 'Wallis and Futuna Islands', 'WF', NULL, NULL),
(237, 'Western Sahara', 'EH', NULL, NULL),
(238, 'Yemen', 'YE', NULL, NULL),
(239, 'Yugoslavia', 'YU', NULL, NULL),
(240, 'Zaire', 'ZR', NULL, NULL),
(241, 'Zambia', 'ZM', NULL, NULL),
(242, 'Zimbabwe', 'ZW', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_addresses`
--

CREATE TABLE `customer_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `address` text NOT NULL,
  `apartment` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_addresses`
--

INSERT INTO `customer_addresses` (`id`, `user_id`, `first_name`, `last_name`, `email`, `mobile`, `country_id`, `address`, `apartment`, `city`, `state`, `zip`, `created_at`, `updated_at`) VALUES
(1, 3, 'sitaram', 'sharma', 'sitaram.ambalaonline@gmail.com', '01234567890', 3, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'asasa', 'ambala', 'Haryana', '134003', '2024-09-25 12:35:10', '2024-11-22 12:22:33'),
(2, 5, 'johny', 'sharma', 'johny@gmail.com', '01234567890', 3, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', NULL, 'ambala', 'Haryana', '134003', '2024-09-29 11:07:41', '2024-09-29 11:07:41');

-- --------------------------------------------------------

--
-- Table structure for table `discount_coupons`
--

CREATE TABLE `discount_coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `max_uses` int(11) DEFAULT NULL,
  `max_uses_user` int(11) DEFAULT NULL,
  `type` enum('percent','fixed') NOT NULL DEFAULT 'fixed',
  `discount_amount` double(10,2) NOT NULL,
  `min_amount` double(10,2) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `starts_at` timestamp NULL DEFAULT NULL,
  `expire_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discount_coupons`
--

INSERT INTO `discount_coupons` (`id`, `code`, `name`, `description`, `max_uses`, `max_uses_user`, `type`, `discount_amount`, `min_amount`, `status`, `starts_at`, `expire_at`, `created_at`, `updated_at`) VALUES
(3, '1234', 'first', 'sdsdsds', 3, 5, 'percent', 20.00, NULL, 1, '2024-10-01 12:36:59', '2024-10-04 12:37:20', '2024-10-01 07:07:28', '2024-10-01 07:07:28'),
(4, 'sample', 'cxcxc', 'xcxcx', 3, 2, 'percent', 20.00, NULL, 1, '2024-10-03 06:30:41', '2024-10-03 17:56:12', '2024-10-01 12:27:46', '2024-10-01 12:27:46'),
(5, 'dummy', 'sdsds', 'ssd', 10, 2, 'fixed', 80.00, 250.00, 1, '2024-10-11 23:30:09', '2024-10-17 08:49:29', '2024-10-02 03:21:55', '2024-10-02 03:21:55'),
(6, 'ind34', 'Diwali', NULL, 10, 2, 'percent', 50.00, 100.00, 1, '2024-10-04 06:50:31', '2024-10-12 11:50:47', '2024-10-05 06:20:52', '2024-10-05 06:20:52');

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
(5, '2024_08_13_171841_alter_users_table', 2),
(6, '2024_08_15_094255_create_categories_table', 3),
(9, '2024_08_17_173025_create_temp_images_table', 4),
(10, '2024_08_22_002143_create_sub_categories_table', 5),
(11, '2024_08_22_002504_create_sub_categories_table', 6),
(12, '2024_08_25_125447_create_products_table', 7),
(13, '2024_08_25_134056_create_product_images_table', 8),
(14, '2024_09_03_180928_alter_categories_table', 9),
(15, '2024_09_03_182640_alter_products_table', 10),
(16, '2024_09_04_004951_alter_sub_categories_table', 11),
(17, '2024_09_08_180022_alter_products_table', 12),
(18, '2024_09_23_171144_alter_users_table', 13),
(19, '2024_09_24_172716_create_countries_table', 14),
(20, '2024_09_25_070403_create_orders_table', 15),
(21, '2024_09_25_070536_create_order_items_table', 15),
(22, '2024_09_25_071034_create_customer_addresses_table', 15),
(23, '2024_09_26_153329_create_shipping_charges_table', 16),
(24, '2024_09_30_164136_create_discount_coupons_table', 17),
(25, '2024_10_13_080646_alter_orders_table', 18),
(26, '2024_11_20_011513_alter_orders_table', 19),
(27, '2024_11_24_114515_create_wishlists_table', 20),
(28, '2024_12_13_172642_create_product_ratings_table', 21);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subtotal` double(10,2) NOT NULL,
  `shipping` double(10,2) NOT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `coupon_code_id` int(11) DEFAULT NULL,
  `discount` double(10,2) DEFAULT NULL,
  `grand_total` double(10,2) NOT NULL,
  `payment_status` enum('paid','not paid') NOT NULL DEFAULT 'not paid',
  `status` enum('pending','delivered','shipped','cancelled') NOT NULL DEFAULT 'pending',
  `shipped_date` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `address` text NOT NULL,
  `apartment` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `subtotal`, `shipping`, `coupon_code`, `coupon_code_id`, `discount`, `grand_total`, `payment_status`, `status`, `shipped_date`, `first_name`, `last_name`, `email`, `mobile`, `country_id`, `address`, `apartment`, `city`, `state`, `zip`, `notes`, `created_at`, `updated_at`) VALUES
(2, 3, 200.00, 0.00, NULL, NULL, NULL, 200.00, 'not paid', 'pending', NULL, 'sitaram', 'sharma', 'sitaram.ambalaonline@gmail.com', '01234567890', 100, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'sasas', 'ambala', 'Haryana', '134003', 'asasasas', '2024-09-26 05:41:34', '2024-09-26 05:41:34'),
(3, 3, 800.00, 0.00, NULL, NULL, NULL, 800.00, 'not paid', 'pending', NULL, 'sitaram', 'sharma', 'sitaram.ambalaonline@gmail.com', '01234567890', 100, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'asasa', 'ambala', 'Haryana', '134003', 'aasas', '2024-09-26 05:48:54', '2024-09-26 05:48:54'),
(4, 3, 1988.00, 0.00, NULL, NULL, NULL, 1988.00, 'not paid', 'pending', NULL, 'sitaram', 'sharma', 'sitaram.ambalaonline@gmail.com', '01234567890', 100, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'asasa', 'ambala', 'Haryana', '134003', NULL, '2024-09-26 06:41:44', '2024-09-26 06:41:44'),
(5, 3, 100.00, 0.00, NULL, NULL, NULL, 100.00, 'not paid', 'pending', NULL, 'sitaram', 'sharma', 'sitaram.ambalaonline@gmail.com', '01234567890', 100, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'asasa', 'ambala', 'Haryana', '134003', NULL, '2024-09-26 06:51:13', '2024-09-26 06:51:13'),
(6, 3, 491.00, 0.00, NULL, NULL, NULL, 491.00, 'not paid', 'pending', NULL, 'sitaram', 'sharma', 'sitaram.ambalaonline@gmail.com', '01234567890', 100, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'asasa', 'ambala', 'Haryana', '134003', NULL, '2024-09-26 07:12:49', '2024-09-26 07:12:49'),
(7, 3, 100.00, 0.00, NULL, NULL, NULL, 100.00, 'not paid', 'pending', NULL, 'sitaram', 'sharma', 'sitaram.ambalaonline@gmail.com', '01234567890', 100, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'asasa', 'ambala', 'Haryana', '134003', NULL, '2024-09-29 06:52:48', '2024-09-29 06:52:48'),
(8, 3, 417.00, 50.00, NULL, NULL, NULL, 467.00, 'not paid', 'pending', NULL, 'sitaram', 'sharma', 'sitaram.ambalaonline@gmail.com', '01234567890', 100, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'asasa', 'ambala', 'Haryana', '134003', NULL, '2024-09-29 07:07:10', '2024-09-29 07:07:10'),
(9, 5, 217.00, 50.00, NULL, NULL, NULL, 267.00, 'not paid', 'pending', NULL, 'johny', 'sharma', 'johny@gmail.com', '01234567890', 3, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', NULL, 'ambala', 'Haryana', '134003', NULL, '2024-09-29 11:07:42', '2024-09-29 11:07:42'),
(10, 3, 400.00, 100.00, 'dummy', 5, 80.00, 420.00, 'not paid', 'shipped', '2024-11-28 18:02:07', 'sitaram', 'sharma', 'sitaram.ambalaonline@gmail.com', '01234567890', 91, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'asasa', 'ambala', 'Haryana', '134003', NULL, '2024-10-05 06:05:32', '2024-11-20 12:32:17'),
(11, 3, 300.00, 50.00, '', NULL, 0.00, 350.00, 'not paid', 'delivered', '2024-11-25 18:01:29', 'sitaram', 'sharma', 'sitaram.ambalaonline@gmail.com', '01234567890', 91, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'asasa', 'ambala', 'Haryana', '134003', NULL, '2024-11-03 11:49:43', '2024-11-20 12:31:34'),
(12, 3, 400.00, 50.00, '', NULL, 0.00, 450.00, 'not paid', 'pending', NULL, 'sitaram', 'sharma', 'sitaram.ambalaonline@gmail.com', '01234567890', 100, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'asasa', 'ambala', 'Haryana', '134003', NULL, '2024-11-22 11:33:55', '2024-11-22 11:33:55'),
(13, 3, 102.00, 25.00, '', NULL, 0.00, 127.00, 'not paid', 'pending', NULL, 'sitaram', 'sharma', 'sitaram.ambalaonline@gmail.com', '01234567890', 100, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'asasa', 'ambala', 'Haryana', '134003', NULL, '2024-11-22 11:47:41', '2024-11-22 11:47:41'),
(14, 3, 102.00, 25.00, '', NULL, 0.00, 127.00, 'not paid', 'pending', NULL, 'sitaram', 'sharma', 'sitaram.ambalaonline@gmail.com', '01234567890', 100, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'asasa', 'ambala', 'Haryana', '134003', NULL, '2024-11-22 11:48:28', '2024-11-22 11:48:28'),
(15, 3, 102.00, 25.00, '', NULL, 0.00, 127.00, 'not paid', 'pending', NULL, 'sitaram', 'sharma', 'sitaram.ambalaonline@gmail.com', '01234567890', 100, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'asasa', 'ambala', 'Haryana', '134003', NULL, '2024-11-22 11:50:02', '2024-11-22 11:50:02'),
(16, 3, 100.00, 50.00, '', NULL, 0.00, 150.00, 'not paid', 'pending', NULL, 'sitaram', 'sharma', 'sitaram.ambalaonline@gmail.com', '01234567890', 3, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'asasa', 'ambala', 'Haryana', '134003', NULL, '2024-11-22 12:22:33', '2024-11-22 12:22:33'),
(17, 3, 400.00, 100.00, '', NULL, 0.00, 500.00, 'not paid', 'pending', NULL, 'sitaram', 'sharma', 'sitaram.ambalaonline@gmail.com', '01234567890', 3, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'asasa', 'ambala', 'Haryana', '134003', NULL, '2024-11-27 11:26:43', '2024-11-27 11:26:43'),
(18, 3, 400.00, 100.00, '', NULL, 0.00, 500.00, 'not paid', 'pending', NULL, 'sitaram', 'sharma', 'sitaram.ambalaonline@gmail.com', '01234567890', 3, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'asasa', 'ambala', 'Haryana', '134003', NULL, '2024-11-27 11:35:29', '2024-11-27 11:35:29');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  `total` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `name`, `qty`, `price`, `total`, `created_at`, `updated_at`) VALUES
(1, 2, 47, 'test realted', 1, 200.00, 200.00, '2024-09-26 05:41:34', '2024-09-26 05:41:34'),
(2, 3, 11, 'Women Top', 1, 800.00, 800.00, '2024-09-26 05:48:54', '2024-09-26 05:48:54'),
(3, 4, 42, 'Jensen Borer', 2, 544.00, 1088.00, '2024-09-26 06:41:44', '2024-09-26 06:41:44'),
(4, 4, 10, 'adidas show', 3, 300.00, 900.00, '2024-09-26 06:41:44', '2024-09-26 06:41:44'),
(5, 5, 9, 'Coat', 1, 100.00, 100.00, '2024-09-26 06:51:13', '2024-09-26 06:51:13'),
(6, 6, 41, 'Marcel Gaylord III', 1, 491.00, 491.00, '2024-09-26 07:12:49', '2024-09-26 07:12:49'),
(7, 7, 7, 'smart watch', 1, 100.00, 100.00, '2024-09-29 06:52:48', '2024-09-29 06:52:48'),
(8, 8, 47, 'test realted', 1, 200.00, 200.00, '2024-09-29 07:07:10', '2024-09-29 07:07:10'),
(9, 8, 46, 'Madilyn Gerlach', 1, 217.00, 217.00, '2024-09-29 07:07:10', '2024-09-29 07:07:10'),
(10, 9, 46, 'Madilyn Gerlach', 1, 217.00, 217.00, '2024-09-29 11:07:42', '2024-09-29 11:07:42'),
(11, 10, 47, 'test realted', 2, 200.00, 400.00, '2024-10-05 06:05:32', '2024-10-05 06:05:32'),
(12, 11, 10, 'adidas show', 1, 300.00, 300.00, '2024-11-03 11:49:43', '2024-11-03 11:49:43'),
(13, 12, 10, 'adidas show', 1, 300.00, 300.00, '2024-11-22 11:33:55', '2024-11-22 11:33:55'),
(14, 12, 7, 'smart watch', 1, 100.00, 100.00, '2024-11-22 11:33:56', '2024-11-22 11:33:56'),
(15, 13, 8, 'Smart Tv', 1, 102.00, 102.00, '2024-11-22 11:47:42', '2024-11-22 11:47:42'),
(16, 14, 8, 'Smart Tv', 1, 102.00, 102.00, '2024-11-22 11:48:28', '2024-11-22 11:48:28'),
(17, 15, 8, 'Smart Tv', 1, 102.00, 102.00, '2024-11-22 11:50:02', '2024-11-22 11:50:02'),
(18, 16, 7, 'smart watch', 1, 100.00, 100.00, '2024-11-22 12:22:33', '2024-11-22 12:22:33'),
(19, 17, 47, 'test realted', 2, 200.00, 400.00, '2024-11-27 11:26:43', '2024-11-27 11:26:43'),
(20, 18, 47, 'test realted', 2, 200.00, 400.00, '2024-11-27 11:35:29', '2024-11-27 11:35:29');

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `shipping_returns` text DEFAULT NULL,
  `related_products` text DEFAULT NULL,
  `price` double(10,2) NOT NULL,
  `compare_price` double(10,2) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `is_featured` enum('Yes','No') NOT NULL DEFAULT 'No',
  `sku` varchar(255) NOT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `track_qty` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `qty` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `description`, `short_description`, `shipping_returns`, `related_products`, `price`, `compare_price`, `category_id`, `sub_category_id`, `brand_id`, `is_featured`, `sku`, `barcode`, `track_qty`, `qty`, `status`, `created_at`, `updated_at`) VALUES
(7, 'smart watch', 'smart-watch', '<p><strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500</span><br></p>', NULL, NULL, NULL, 100.00, 110.00, 50, 12, 1, 'Yes', 'sku121', '12345', 'Yes', 12, 1, '2024-09-05 12:30:28', '2024-09-05 12:30:28'),
(8, 'Smart Tv', 'smart-tv', '<p><strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500</span><br></p>', NULL, NULL, '', 102.00, 200.00, 53, 19, 2, 'No', 'sku178', '12378', 'Yes', 32, 0, '2024-09-05 12:31:53', '2024-11-27 12:26:39'),
(9, 'Coat', 'coat', '<p><strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500</span><br></p>', NULL, NULL, NULL, 100.00, 200.00, 51, 13, 0, 'Yes', 'sku221', '12378', 'Yes', 56, 1, '2024-09-05 12:33:11', '2024-09-05 12:51:29'),
(10, 'adidas show', 'adidas-show', '<p><strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500</span><br></p>', NULL, NULL, '', 300.00, 400.00, 51, 15, 0, 'No', 'sku300', '12345', 'Yes', 5, 1, '2024-09-05 12:34:12', '2024-09-22 12:03:24'),
(11, 'Women Top', 'women-top', '<p><strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500</span><br></p>', NULL, NULL, NULL, 800.00, 823.00, 52, 17, 0, 'No', 'sku999', '12345', 'Yes', 78, 1, '2024-09-05 12:35:09', '2024-09-05 12:35:09'),
(12, 'LG Tv', 'lg-tv', '<p><strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500</span><br></p>', NULL, NULL, NULL, 102.00, 823.00, 53, 19, 2, 'No', 'sku677', '12345', 'Yes', 333, 1, '2024-09-05 12:38:11', '2024-09-05 12:38:11'),
(13, 'vivo v23', 'vivo-v23', '<p><strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s</span><br></p>', NULL, NULL, NULL, 400.00, 800.00, 50, 8, 3, 'No', 'sku435', '12345', 'Yes', 45, 1, '2024-09-06 12:27:34', '2024-09-06 12:27:34'),
(14, 'Printer', 'printer', '<p><strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s</span><br></p>', NULL, NULL, NULL, 320.00, 800.00, 50, 25, 1, 'No', 'sku000', '12345', 'Yes', 45, 1, '2024-09-06 12:29:35', '2024-09-06 12:54:15'),
(15, 'Laptop notebook', 'laptop-notebook', '<p>sdsdsdsdsd</p>', NULL, NULL, '10,16,12', 1000.00, 1200.00, 50, 10, 2, 'No', 'skuy67', '233232', 'Yes', 45, 1, '2024-09-07 11:40:21', '2024-09-19 11:35:42'),
(16, 'sony ultra notebook', 'sony-ultra-notebook', '<p>dsdsdsd</p>', NULL, NULL, '7,8', 2000.00, 2500.00, 50, 10, NULL, 'No', 'sku0367', '12345', 'Yes', 45, 1, '2024-09-07 12:08:57', '2024-09-10 13:11:18'),
(17, 'Mr. Pablo Stracke III', 'mr-pablo-stracke-iii', NULL, NULL, NULL, NULL, 840.00, NULL, 50, 10, 1, 'Yes', '4552', NULL, 'Yes', 10, 1, '2024-09-08 05:44:26', '2024-09-08 05:44:26'),
(18, 'Aditya Kulas', 'aditya-kulas', NULL, NULL, NULL, NULL, 961.00, NULL, 50, 8, 2, 'Yes', '2803', NULL, 'Yes', 10, 1, '2024-09-08 05:44:27', '2024-09-08 05:44:27'),
(19, 'Prof. Alexandre Bernhard', 'prof-alexandre-bernhard', NULL, NULL, NULL, NULL, 418.00, NULL, 50, 8, 4, 'Yes', '7895', NULL, 'Yes', 10, 1, '2024-09-08 05:44:27', '2024-09-08 05:44:27'),
(20, 'Carmel Mosciski', 'carmel-mosciski', NULL, NULL, NULL, NULL, 53.00, NULL, 50, 10, 2, 'Yes', '6055', NULL, 'Yes', 10, 1, '2024-09-08 05:44:27', '2024-09-08 05:44:27'),
(21, 'Mr. Judson Terry I', 'mr-judson-terry-i', NULL, NULL, NULL, NULL, 35.00, NULL, 50, 10, 4, 'Yes', '1418', NULL, 'Yes', 10, 1, '2024-09-08 05:44:27', '2024-09-08 05:44:27'),
(22, 'Mr. Ryder Funk Jr.', 'mr-ryder-funk-jr', NULL, NULL, NULL, NULL, 339.00, NULL, 50, 10, 2, 'Yes', '5900', NULL, 'Yes', 10, 1, '2024-09-08 05:44:27', '2024-09-08 05:44:27'),
(23, 'Claudine Dicki', 'claudine-dicki', NULL, NULL, NULL, NULL, 891.00, NULL, 50, 8, 2, 'Yes', '1398', NULL, 'Yes', 10, 1, '2024-09-08 05:44:27', '2024-09-08 05:44:27'),
(24, 'Sincere Smith I', 'sincere-smith-i', NULL, NULL, NULL, NULL, 106.00, NULL, 50, 10, 2, 'Yes', '6619', NULL, 'Yes', 10, 1, '2024-09-08 05:44:27', '2024-09-08 05:44:27'),
(25, 'Dr. Merlin Corwin', 'dr-merlin-corwin', NULL, NULL, NULL, NULL, 548.00, NULL, 50, 8, 3, 'Yes', '2711', NULL, 'Yes', 10, 1, '2024-09-08 05:44:27', '2024-09-08 05:44:27'),
(26, 'Laron Frami', 'laron-frami', NULL, NULL, NULL, NULL, 36.00, NULL, 50, 8, 4, 'Yes', '2291', NULL, 'Yes', 10, 1, '2024-09-08 05:44:28', '2024-09-08 05:44:28'),
(27, 'Henry Yost', 'henry-yost', NULL, NULL, NULL, NULL, 610.00, NULL, 50, 8, 3, 'Yes', '4867', NULL, 'Yes', 10, 1, '2024-09-08 05:44:28', '2024-09-08 05:44:28'),
(28, 'Tabitha Rowe', 'tabitha-rowe', NULL, NULL, NULL, NULL, 856.00, NULL, 50, 8, 2, 'Yes', '5861', NULL, 'Yes', 10, 1, '2024-09-08 05:44:28', '2024-09-08 05:44:28'),
(29, 'Prof. Ashtyn McGlynn', 'prof-ashtyn-mcglynn', NULL, NULL, NULL, NULL, 288.00, NULL, 50, 10, 3, 'Yes', '7589', NULL, 'Yes', 10, 1, '2024-09-08 05:44:28', '2024-09-08 05:44:28'),
(30, 'Narciso Nolan', 'narciso-nolan', NULL, NULL, NULL, NULL, 628.00, NULL, 50, 8, 2, 'Yes', '6966', NULL, 'Yes', 10, 1, '2024-09-08 05:44:28', '2024-09-08 05:44:28'),
(31, 'Mrs. Alexandrea Cole', 'mrs-alexandrea-cole', NULL, NULL, NULL, NULL, 706.00, NULL, 50, 10, 2, 'Yes', '7468', NULL, 'Yes', 10, 1, '2024-09-08 05:44:28', '2024-09-08 05:44:28'),
(32, 'Karlee Rosenbaum', 'karlee-rosenbaum', NULL, NULL, NULL, NULL, 964.00, NULL, 50, 10, 4, 'Yes', '7816', NULL, 'Yes', 10, 1, '2024-09-08 05:44:28', '2024-09-08 05:44:28'),
(33, 'Amani Murray', 'amani-murray', NULL, NULL, NULL, NULL, 331.00, NULL, 50, 8, 4, 'Yes', '3070', NULL, 'Yes', 10, 1, '2024-09-08 05:44:28', '2024-09-08 05:44:28'),
(34, 'Mohammed Bradtke II', 'mohammed-bradtke-ii', NULL, NULL, NULL, NULL, 380.00, NULL, 50, 10, 3, 'Yes', '8364', NULL, 'Yes', 10, 1, '2024-09-08 05:44:28', '2024-09-08 05:44:28'),
(35, 'Dr. Flossie Murazik Jr.', 'dr-flossie-murazik-jr', NULL, NULL, NULL, NULL, 501.00, NULL, 50, 10, 4, 'Yes', '2086', NULL, 'Yes', 10, 1, '2024-09-08 05:44:28', '2024-09-08 05:44:28'),
(36, 'Miss Kacie VonRueden IV', 'miss-kacie-vonrueden-iv', NULL, NULL, NULL, NULL, 143.00, NULL, 50, 8, 1, 'Yes', '2320', NULL, 'Yes', 10, 1, '2024-09-08 05:44:28', '2024-09-08 05:44:28'),
(37, 'Rupert Will', 'rupert-will', NULL, NULL, NULL, NULL, 938.00, NULL, 50, 8, 1, 'Yes', '1680', NULL, 'Yes', 10, 1, '2024-09-08 05:44:28', '2024-09-08 05:44:28'),
(38, 'Juanita Grant V', 'juanita-grant-v', NULL, NULL, NULL, NULL, 909.00, NULL, 50, 10, 2, 'Yes', '8153', NULL, 'Yes', 10, 1, '2024-09-08 05:44:28', '2024-09-08 05:44:28'),
(39, 'Miss Sydnie Padberg', 'miss-sydnie-padberg', NULL, NULL, NULL, NULL, 828.00, NULL, 50, 10, 2, 'Yes', '5169', NULL, 'Yes', 10, 1, '2024-09-08 05:44:28', '2024-09-08 05:44:28'),
(40, 'Dr. Julius Lebsack II', 'dr-julius-lebsack-ii', NULL, NULL, NULL, NULL, 351.00, NULL, 50, 10, 1, 'Yes', '5795', NULL, 'Yes', 10, 1, '2024-09-08 05:44:28', '2024-09-08 05:44:28'),
(41, 'Marcel Gaylord III', 'marcel-gaylord-iii', NULL, NULL, NULL, NULL, 491.00, NULL, 50, 10, 2, 'Yes', '9711', NULL, 'Yes', 10, 1, '2024-09-08 05:44:28', '2024-09-08 05:44:28'),
(42, 'Jensen Borer', 'jensen-borer', NULL, NULL, NULL, NULL, 544.00, NULL, 50, 8, 1, 'Yes', '4623', NULL, 'Yes', 10, 1, '2024-09-08 05:44:28', '2024-09-08 05:44:28'),
(43, 'Angelina Ebert', 'angelina-ebert', NULL, NULL, NULL, NULL, 871.00, NULL, 50, 10, 1, 'Yes', '7044', NULL, 'Yes', 10, 1, '2024-09-08 05:44:28', '2024-09-08 05:44:28'),
(44, 'Dr. Travon Schuster II', 'dr-travon-schuster-ii', NULL, NULL, NULL, NULL, 60.00, NULL, 50, 8, 4, 'Yes', '1826', NULL, 'Yes', 10, 1, '2024-09-08 05:44:28', '2024-09-08 05:44:28'),
(45, 'Dr. Jordon Little', 'dr-jordon-little', NULL, NULL, NULL, NULL, 493.00, NULL, 50, 10, 3, 'Yes', '9707', NULL, 'Yes', 10, 1, '2024-09-08 05:44:28', '2024-09-08 05:44:28'),
(46, 'Madilyn Gerlach', 'madilyn-gerlach', NULL, NULL, NULL, NULL, 217.00, 500.00, 50, 10, 2, 'Yes', '8066', NULL, 'Yes', 10, 1, '2024-09-08 05:44:28', '2024-09-08 11:46:23'),
(47, 'test realted', 'test-realted', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</span><br></p>', NULL, NULL, '7,8,16', 200.00, 350.00, 51, 16, NULL, 'No', 'sku-9y754', '22322', 'No', 0, 1, '2024-09-19 11:44:01', '2024-11-27 12:23:33');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `sort_order`, `created_at`, `updated_at`) VALUES
(16, 7, '7_16_1725559228.jpg', NULL, '2024-09-05 12:30:28', '2024-09-05 12:30:28'),
(18, 9, '9_18_1725559391.png', NULL, '2024-09-05 12:33:11', '2024-09-05 12:33:11'),
(19, 10, '10_19_1725559452.jpg', NULL, '2024-09-05 12:34:12', '2024-09-05 12:34:12'),
(20, 10, '10_20_1725559453.jpg', NULL, '2024-09-05 12:34:13', '2024-09-05 12:34:13'),
(21, 10, '10_21_1725559454.jpg', NULL, '2024-09-05 12:34:14', '2024-09-05 12:34:14'),
(22, 11, '11_22_1725559509.jpg', NULL, '2024-09-05 12:35:09', '2024-09-05 12:35:09'),
(23, 11, '11_23_1725559509.jpg', NULL, '2024-09-05 12:35:09', '2024-09-05 12:35:09'),
(27, 14, '14_27_1725646845.jfif', NULL, '2024-09-06 12:50:45', '2024-09-06 12:50:45'),
(28, 13, '13_28_1725646891.jfif', NULL, '2024-09-06 12:51:31', '2024-09-06 12:51:31'),
(29, 12, '12_29_1725646939.jfif', NULL, '2024-09-06 12:52:19', '2024-09-06 12:52:19'),
(30, 8, '8_30_1725646982.jfif', NULL, '2024-09-06 12:53:02', '2024-09-06 12:53:02'),
(31, 15, '15_31_1725729021.jfif', NULL, '2024-09-07 11:40:21', '2024-09-07 11:40:21'),
(32, 16, '16_32_1725730737.jfif', NULL, '2024-09-07 12:08:57', '2024-09-07 12:08:57'),
(33, 47, '47_33_1726766042.jpg', NULL, '2024-09-19 11:44:01', '2024-09-19 11:44:02');

-- --------------------------------------------------------

--
-- Table structure for table `product_ratings`
--

CREATE TABLE `product_ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `rating` double(3,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_ratings`
--

INSERT INTO `product_ratings` (`id`, `product_id`, `username`, `email`, `comment`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(1, 16, 'sitaram', 'sitaram.ambalaonline@gmail.com', 'Good product', 4.00, 1, '2024-12-22 11:42:50', '2024-12-22 11:42:50'),
(2, 16, 'johny', 'john@gmail.com', 'Great product it is', 5.00, 1, '2024-12-22 11:48:03', '2025-01-03 10:56:34'),
(3, 10, 'ratan', 'ratan@gmail.com', 'Great Product', 5.00, 1, '2025-01-02 11:42:39', '2025-01-03 10:55:34');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_charges`
--

CREATE TABLE `shipping_charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` varchar(255) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_charges`
--

INSERT INTO `shipping_charges` (`id`, `country_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, '100', 25.00, '2024-09-26 11:12:35', '2024-09-26 11:12:35'),
(2, 'rest_of_world', 50.00, '2024-09-26 11:13:34', '2024-09-26 11:13:34'),
(3, '1', 78.00, '2024-09-26 12:34:11', '2024-09-26 12:34:11');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `showHome` enum('Yes','No') NOT NULL DEFAULT 'No',
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `slug`, `status`, `showHome`, `category_id`, `created_at`, `updated_at`) VALUES
(8, 'Mobile', 'mobile', 1, 'Yes', 50, '2024-09-03 19:27:50', '2024-09-03 19:28:54'),
(9, 'Tablets', 'tablets', 1, 'Yes', 50, '2024-09-03 19:29:20', '2024-09-03 19:29:20'),
(10, 'Laptops', 'laptops', 1, 'Yes', 50, '2024-09-03 19:29:37', '2024-09-03 19:29:37'),
(11, 'Speakers', 'speakers', 1, 'Yes', 50, '2024-09-03 19:29:56', '2024-09-03 19:29:56'),
(12, 'Watches', 'watches', 1, 'Yes', 50, '2024-09-03 19:30:12', '2024-09-03 19:30:12'),
(13, 'Shirts', 'shirts', 1, 'Yes', 51, '2024-09-03 19:30:37', '2024-09-03 19:30:37'),
(14, 'Jeans', 'jeans', 1, 'Yes', 51, '2024-09-03 19:30:49', '2024-09-03 19:30:49'),
(15, 'Shoes', 'shoes', 1, 'Yes', 51, '2024-09-03 19:31:02', '2024-09-03 19:31:02'),
(16, 'Perfumes', 'perfumes', 1, 'Yes', 51, '2024-09-03 19:31:52', '2024-09-03 19:31:52'),
(17, 'T-Shirts', 't-shirts', 1, 'Yes', 52, '2024-09-03 19:32:25', '2024-09-03 19:32:25'),
(18, 'Tops', 'tops', 1, 'Yes', 52, '2024-09-03 19:32:45', '2024-09-03 19:32:45'),
(19, 'TV', 'tv', 1, 'Yes', 53, '2024-09-03 19:33:10', '2024-09-03 19:33:10'),
(20, 'Washing Machines', 'washing-machines', 1, 'Yes', 53, '2024-09-03 19:33:30', '2024-09-03 19:33:30'),
(21, 'Air Conditioners', 'air-conditioners', 1, 'Yes', 53, '2024-09-03 19:33:42', '2024-09-03 19:33:42'),
(22, 'Vacuum Cleaner', 'vacuum-cleaner', 1, 'Yes', 53, '2024-09-03 19:33:53', '2024-09-03 19:33:53'),
(23, 'Fans', 'fans', 1, 'Yes', 53, '2024-09-03 19:34:05', '2024-09-03 19:34:05'),
(24, 'Air Coolers', 'air-coolers', 1, 'Yes', 53, '2024-09-03 19:34:14', '2024-09-03 19:34:14'),
(25, 'Printer', 'printer', 1, 'Yes', 50, '2024-09-06 12:54:03', '2024-09-06 12:54:03');

-- --------------------------------------------------------

--
-- Table structure for table `temp_images`
--

CREATE TABLE `temp_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, 2, NULL, '$2y$10$pvGn7/LoJXydlnDOnlxhCOuIASRBgh2Gcl4WXYGk7BEp6lDROWU4K', NULL, '2024-08-13 12:07:48', '2024-08-13 12:07:48'),
(3, 'johny sharma', 'sitaram.ambalaonline@gmail.com', '454544545454', 1, NULL, '$2y$10$5fN.jp9/PSBXKFYjltX8POfyykGUc3l3ydrMRBOJKZxjsHL.Blj..', NULL, '2024-09-23 12:14:29', '2024-12-13 11:48:06'),
(4, 'neha', 'neha@gmail.com', '1234567890', 1, NULL, '$2y$10$DvgMViXQzmvdtQHnMQPpnOpTbbYdTZOHPhSglXj7QLnS43Xn99MIK', NULL, '2024-09-23 12:50:53', '2024-09-23 12:50:53'),
(5, 'johny', 'johny@gmail.com', '1234567890', 1, NULL, '$2y$10$x0tqmad/lRyMoFCIhwugne9ZeUvAIlGveKljBL2rt8TB4/M.q9t9m', NULL, '2024-09-29 07:14:54', '2024-09-29 07:14:54');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(14, 3, 40, '2024-11-26 12:55:16', '2024-11-26 12:55:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_addresses_user_id_foreign` (`user_id`),
  ADD KEY `customer_addresses_country_id_foreign` (`country_id`);

--
-- Indexes for table `discount_coupons`
--
ALTER TABLE `discount_coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_country_id_foreign` (`country_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_sub_category_id_foreign` (`sub_category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_ratings_product_id_foreign` (`product_id`);

--
-- Indexes for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `temp_images`
--
ALTER TABLE `temp_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `discount_coupons`
--
ALTER TABLE `discount_coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `product_ratings`
--
ALTER TABLE `product_ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `temp_images`
--
ALTER TABLE `temp_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD CONSTRAINT `customer_addresses_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD CONSTRAINT `product_ratings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
