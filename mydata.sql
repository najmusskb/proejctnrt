-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2026 at 06:45 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nirtproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mission` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no.png',
  `image2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkmarks` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`checkmarks`)),
  `button_text` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_link` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button2_text` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button2_link` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `counter1_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `counter1_label` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `counter2_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `counter2_label` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `badge_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `badge_label` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `title`, `subtitle`, `mission`, `description`, `image`, `image2`, `checkmarks`, `button_text`, `button_link`, `button2_text`, `button2_link`, `counter1_number`, `counter1_label`, `counter2_number`, `counter2_label`, `badge_number`, `badge_label`, `updated_by`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 'See Rome Through The Eyes Of A Local', 'Experience Rome', NULL, 'Nice in Rome Tour is more than a booking service — we\'re a family of passionate Roman guides who have spent a decade uncovering the Eternal City\'s secrets. Every experience is hand-crafted, authentic and personal.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg', NULL, '[\"Deep local knowledge of Rome\",\"Experienced, licensed guides\",\"Authentic, hand-crafted experiences\",\"Personalised, concierge service\"]', 'Discover Our Story →', '#', 'Browse All Tours', '#tours', '35K+', 'Happy Travellers', '4.8★', 'Avg. Rating', '12', 'Years Exp.', NULL, NULL, '2026-08-31 12:17:39', '2026-08-31 12:17:39');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `slug`, `author`, `image`, `short_description`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'The Colosseum\'s Secret Underground — What Most Tourists Miss', 'colosseum-secret-underground', 'Mr. J', 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/66/Colosseum_Arena_%285986632567%29.jpg/960px-Colosseum_Arena_%285986632567%29.jpg', 'Discover the hypogeum, the labyrinthine underground network where gladiators and wild animals once waited...', 'Discover the hypogeum, the labyrinthine underground network where gladiators and wild animals once waited before being lifted into the arena. A fascinating hidden world beneath the iconic Colosseum.', 1, '2026-08-31 12:18:17', '2026-08-31 12:18:17'),
(2, 'Vatican Museums: The Complete Visitor\'s Guide for 2026', 'vatican-museums-complete-guide', 'Mr. J', 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e8/Vatican_Museums_Spiral_Staircase_Looking_Up_2012.jpg/960px-Vatican_Museums_Spiral_Staircase_Looking_Up_2012.jpg', 'Everything you need to know about visiting the Vatican — best times, what to skip, and the must-sees...', 'Everything you need to know about visiting the Vatican — best times, what to skip, and the must-sees. Plan your perfect visit with our expert tips.', 1, '2026-08-31 12:18:17', '2026-08-31 12:18:17'),
(3, 'Best Time to Visit Trevi Fountain Without the Crowds', 'best-time-trevi-fountain', 'Mr. J', 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c7/Trevi_Fountain_-_Roma.jpg/960px-Trevi_Fountain_-_Roma.jpg', 'The Trevi Fountain is magical — but when is the best time to visit and actually enjoy it in peace?...', 'The Trevi Fountain is magical — but when is the best time to visit and actually enjoy it in peace? Our insider tips reveal the quietest hours.', 1, '2026-08-31 12:18:17', '2026-08-31 12:18:17');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `image`, `ip_address`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(8, 'Vatican Museums', 'uploads/brand/ikea9726_67eab6f75d190.jpg', '127.0.0.1', 1, 1, '2025-03-29 10:34:15', '2026-08-31 12:17:39'),
(9, 'Borghese Gallery', 'uploads/brand/doha-landmarks-logo-color-flag-sign-symbol-vector-41464777_67eab6dd1d2e5.jpg', '127.0.0.1', 1, 1, '2025-03-31 09:30:46', '2026-08-31 12:17:39'),
(10, 'Roma Pass', 'uploads/brand/images_67eab712daeb1.png', '127.0.0.1', 1, NULL, '2025-03-31 09:38:58', '2026-08-31 12:17:39'),
(11, 'Trenitalia', 'uploads/brand/images (1)_67eab73193c64.png', '127.0.0.1', 1, NULL, '2025-03-31 09:39:29', '2026-08-31 12:17:39'),
(12, 'Visit Rome', 'uploads/brand/HC-Brand-Jewel-English_67eab7551c3f8.jpg', '127.0.0.1', 1, NULL, '2025-03-31 09:40:05', '2026-08-31 12:17:39'),
(13, 'Italia.it', 'uploads/brand/Midas_Logo_67eab7a533964.png', '127.0.0.1', 1, NULL, '2025-03-31 09:41:25', '2026-08-31 12:17:39'),
(14, 'ENIT', 'uploads/brand/images (3)_67eabe21e1f13.png', '127.0.0.1', 1, NULL, '2025-03-31 10:09:05', '2026-08-31 12:17:39'),
(15, 'Colosseo Parco Archeologico', 'no.png', '127.0.0.1', 1, NULL, '2026-08-31 12:17:39', '2026-08-31 12:17:39'),
(16, 'Musei Vaticani', 'no.png', '127.0.0.1', 1, NULL, '2026-08-31 12:17:39', '2026-08-31 12:17:39');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `icon`, `section`, `status`, `created_at`, `updated_at`) VALUES
(1, 'guided tour', 'guided-tour', 'uploads/category/1788273786.jpg', 'vsdf', 'sdvsdvs', 1, '2026-09-01 08:43:06', '2026-09-01 08:43:06');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `image`, `created_by`, `updated_by`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 'Crown Croporation', 'uploads/client/client_635ca576e47c9.png', 1, NULL, '127.0.0.1', '2022-10-28 22:00:54', '2022-10-28 22:00:54'),
(2, 'Crown Croporation', 'uploads/client/client_635ca585944e7.png', 1, NULL, '127.0.0.1', '2022-10-28 22:01:09', '2022-10-28 22:01:09'),
(3, 'Crown Croporation', 'uploads/client/client_635ca590b5cbd.png', 1, NULL, '127.0.0.1', '2022-10-28 22:01:20', '2022-10-28 22:01:20'),
(4, 'Crown Croporation', 'uploads/client/client_635ca59b2c654.png', 1, NULL, '127.0.0.1', '2022-10-28 22:01:31', '2022-10-28 22:01:31'),
(5, 'Crown Croporation', 'uploads/client/client_635ca5a145ef3.png', 1, NULL, '127.0.0.1', '2022-10-28 22:01:37', '2022-10-28 22:01:37'),
(6, 'Crown Croporation', 'uploads/client/client_635ca5a75d792.png', 1, NULL, '127.0.0.1', '2022-10-28 22:01:43', '2022-10-28 22:01:43'),
(7, 'Crown Croporation', 'uploads/client/client_635ca5ae61a9d.png', 1, NULL, '127.0.0.1', '2022-10-28 22:01:50', '2022-10-28 22:01:50'),
(8, 'Crown Croporation', 'uploads/client/client_635ca5b6a3b14.png', 1, 1, '127.0.0.1', '2022-10-28 22:01:58', '2022-10-28 22:02:15'),
(9, 'Crown Croporation', 'uploads/client/client_635ca60e3e525.png', 1, NULL, '127.0.0.1', '2022-10-28 22:03:26', '2022-10-28 22:03:26'),
(10, 'Crown Croporation', 'uploads/client/client_635ca61390f0c.png', 1, NULL, '127.0.0.1', '2022-10-28 22:03:31', '2022-10-28 22:03:31'),
(11, 'Crown Croporation', 'uploads/client/client_635ca618e456b.png', 1, NULL, '127.0.0.1', '2022-10-28 22:03:36', '2022-10-28 22:03:36'),
(12, 'Crown Croporation', 'uploads/client/client_635ca621bbbba.png', 1, NULL, '127.0.0.1', '2022-10-28 22:03:45', '2022-10-28 22:03:45');

-- --------------------------------------------------------

--
-- Table structure for table `companyprofiles`
--

CREATE TABLE `companyprofiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `com_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_two` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_three` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email1` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no.png',
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_bg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_badge` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_btn1_text` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_btn1_link` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_btn2_text` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_btn2_link` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insta_handle` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insta_followers` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insta_link` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `counter1_icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fas fa-users',
  `counter1_number` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1,658+',
  `counter1_label` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Happy Customers',
  `counter2_icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fas fa-cogs',
  `counter2_number` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '254+',
  `counter2_label` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Project Complete',
  `counter3_icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fas fa-user-shield',
  `counter3_number` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2M+',
  `counter3_label` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Registered Member',
  `counter4_icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fas fa-trophy',
  `counter4_number` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '12+',
  `counter4_label` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Years Experience',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companyprofiles`
--

INSERT INTO `companyprofiles` (`id`, `com_name`, `phone`, `whatsapp`, `phone_two`, `phone_three`, `email`, `email1`, `address`, `facebook`, `twitter`, `youtube`, `instagram`, `logo`, `favicon`, `cta_bg`, `cta_badge`, `cta_title`, `cta_description`, `cta_btn1_text`, `cta_btn1_link`, `cta_btn2_text`, `cta_btn2_link`, `insta_handle`, `insta_followers`, `insta_link`, `map`, `counter1_icon`, `counter1_number`, `counter1_label`, `counter2_icon`, `counter2_number`, `counter2_label`, `counter3_icon`, `counter3_number`, `counter3_label`, `counter4_icon`, `counter4_number`, `counter4_label`, `created_at`, `updated_at`) VALUES
(1, 'Nice In Rome Tour', '+97470374788', '+97470374788', '+97470374788', '+97470374788', 'niceinrometour@gmail.com', 'niceinrometour@gmail.com', 'Zone - 25, Street - 905, Qatar', 'https://www.facebook.com/profile.php?id=100065458061293', 'https://www.twitter.com', 'https://www.youtube.com', 'https://www.instagram.com', 'uploads/company/WhatsApp Image 2026-08-25 at 12.06.10 PM_6a9125b55ac3a.jpeg', 'uploads/company/WhatsApp Image 2026-08-25 at 12.06.10 PM_6a9125c1975d4.jpeg', 'uploads/company/WhatsApp Image 2026-08-25 at 12.06.10 PM_6a9125b55c1ce.jpeg', '🌍 Ready for Your Roman Holiday?', 'Ready to Explore Rome?', 'Choose your perfect experience and start your Roman adventure today — secure, instant and unforgettable.', '🎟️ Explore Tours', '#tours', '💬 WhatsApp Us', 'https://wa.me/+97470374788', '@niceinrometour', '12.4K', '#', 'https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3608.8278628629196!2d51.48095287538332!3d25.242722177681674!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjXCsDE0JzMzLjgiTiA1McKwMjknMDAuNyJF!5e0!3m2!1sen!2sbd!4v1743361290125!5m2!1sen!2sbd', 'fas fa-users', '1,658+', 'Happy Customers', 'fas fa-cogs', '254+', 'Project Complete', 'fas fa-user-shield', '2M+', 'Registered Member', 'fas fa-trophy', '12+', 'Years Experience', '2022-10-29 21:47:17', '2026-08-31 12:18:17');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `phone`, `message`, `created_at`, `updated_at`) VALUES
(21, 'David Duncan', 'pyfifig@mailinator.com', 'Sunt excepturi quae', '+1 (812) 658-6416', 'In rerum dolor est d', '2026-09-01 10:33:54', '2026-09-01 10:33:54');

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE `deals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `badge` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_label` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deals`
--

INSERT INTO `deals` (`id`, `badge`, `title`, `description`, `code`, `discount_label`, `url`, `status`, `created_at`, `updated_at`) VALUES
(1, '🎉 Limited Time Offer', 'Explore Rome & Save 15%', 'Book any featured tour before the end of the month and unlock an exclusive discount on your entire booking — seamless, secure and instantly confirmed.', 'ROME15', 'Save 15%', 'book.niceinrometour.com/rome15', 1, '2026-08-31 12:18:16', '2026-08-31 12:18:16');

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`id`, `name`, `slug`, `image`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Vatican City', 'vatican-city', 'uploads/destinations/1788273105.jpg', 1, 0, '2026-09-01 08:31:45', '2026-09-01 08:31:45'),
(2, 'Rome Sohor', 'rome-sohor', 'uploads/destinations/1788273262.jpg', 1, 0, '2026-09-01 08:34:22', '2026-09-01 08:34:22');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'How does WhatsApp booking work?', 'Simply click \"WhatsApp Us\", send us a message with your preferred tour, date, and number of people. We confirm your booking in seconds — no forms, no waiting, just a friendly chat.', 1, 1, '2026-08-31 12:18:17', '2026-08-31 12:18:17'),
(2, 'What is your cancellation policy?', 'All tours offer free cancellation up to 24 hours before the tour starts. Simply message us on WhatsApp to cancel or reschedule — we\'ll handle it instantly with no questions asked.', 2, 1, '2026-08-31 12:18:17', '2026-08-31 12:18:17'),
(3, 'Are your tours suitable for families with kids?', 'Absolutely! Our guides are experienced with families and know how to keep kids engaged with fun stories and facts. Many tours have family discounts — just ask us on WhatsApp!', 3, 1, '2026-08-31 12:18:17', '2026-08-31 12:18:17'),
(4, 'How many people are in a \"small group\" tour?', 'Our small group tours have a maximum of 12 people, ensuring a personal, intimate experience. You can always hear the guide and ask questions comfortably.', 4, 1, '2026-08-31 12:18:17', '2026-08-31 12:18:17'),
(5, 'Do I need to print my ticket?', 'No printing needed! We send your tickets digitally via WhatsApp. Simply show the QR code on your phone at the entrance. Easy, eco-friendly, and hassle-free.', 5, 1, '2026-08-31 12:18:17', '2026-08-31 12:18:17');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `likes` int(11) NOT NULL DEFAULT 0,
  `comments` int(11) NOT NULL DEFAULT 0,
  `span` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `title`, `section`, `likes`, `comments`, `span`, `image`, `ip_address`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Colosseum', 'home', 1472, 218, 'lg:col-span-2 lg:row-span-2', 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Colosseo_2020.jpg/960px-Colosseo_2020.jpg', '127.0.0.1', 1, 1, '2026-08-31 12:18:16', '2026-08-31 12:18:16'),
(2, 'St. Peter\'s Basilica', 'home', 2034, 322, 'md:col-span-2 lg:col-span-2', 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f5/Basilica_di_San_Pietro_in_Vaticano_September_2015-1a.jpg/960px-Basilica_di_San_Pietro_in_Vaticano_September_2015-1a.jpg', '127.0.0.1', 1, 1, '2026-08-31 12:18:16', '2026-08-31 12:18:16'),
(3, 'Vatican Museums', 'home', 921, 187, NULL, 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f0/VaticanMuseumStaircase.jpg/960px-VaticanMuseumStaircase.jpg', '127.0.0.1', 1, 1, '2026-08-31 12:18:16', '2026-08-31 12:18:16'),
(4, 'Trevi Fountain', 'home', 1108, 241, NULL, 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c4/Fontana_di_Trevi_by_TC.jpg/960px-Fontana_di_Trevi_by_TC.jpg', '127.0.0.1', 1, 1, '2026-08-31 12:18:16', '2026-08-31 12:18:16'),
(5, 'Roman Forum', 'home', 763, 129, NULL, 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6a/Foro_Romano_Musei_Capitolini_Roma.jpg/960px-Foro_Romano_Musei_Capitolini_Roma.jpg', '127.0.0.1', 1, 1, '2026-08-31 12:18:16', '2026-08-31 12:18:16'),
(6, 'Galleria Borghese', 'home', 583, 96, NULL, 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5d/Galleria_borghese_facade.jpg/960px-Galleria_borghese_facade.jpg', '127.0.0.1', 1, 1, '2026-08-31 12:18:16', '2026-08-31 12:18:16'),
(7, 'Colosseum at Night', 'home', 1987, 354, NULL, 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Colosseum_exterior_at_night%2C_Rome%2C_Italy_%28Ank_Kumar%29_11.jpg/960px-Colosseum_exterior_at_night%2C_Rome%2C_Italy_%28Ank_Kumar%29_11.jpg', '127.0.0.1', 1, 1, '2026-08-31 12:18:16', '2026-08-31 12:18:16'),
(8, 'Via dei Fori Imperiali', 'home', 884, 160, NULL, 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9f/Sidewalk_of_Via_dei_Fori_Imperiali%2C_Roma%2C_Italy.jpg/960px-Sidewalk_of_Via_dei_Fori_Imperiali%2C_Roma%2C_Italy.jpg', '127.0.0.1', 1, 1, '2026-08-31 12:18:16', '2026-08-31 12:18:16');

-- --------------------------------------------------------

--
-- Table structure for table `home_page_settings`
--

CREATE TABLE `home_page_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dest_subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dest_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dest_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tours_subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tours_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tours_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tours_btn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cat_subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cat_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cat_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pkg_subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pkg_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pkg_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `srv_subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `srv_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `srv_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `srv_btn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wcu_subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wcu_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wcu_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `partners_subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `partners_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `testi_subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `testi_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `management`
--

CREATE TABLE `management` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_10_27_084202_create_sliders_table', 2),
(11, '2022_10_27_112342_create_clients_table', 8),
(12, '2022_10_29_042456_create_management_table', 9),
(13, '2022_10_29_050915_create_abouts_table', 10),
(15, '2022_10_29_054842_create_categories_table', 11),
(17, '2022_10_29_061610_create_product_images_table', 12),
(19, '2022_10_30_034243_create_companyprofiles_table', 14),
(21, '2022_10_30_052921_create_contacts_table', 16),
(24, '2023_02_26_081037_create_brands_table', 18),
(25, '2022_10_29_061532_create_products_table', 19),
(29, '2023_03_29_063219_create_galleries_table', 20),
(30, '2024_01_01_000001_create_services_table', 21),
(31, '2024_01_01_000002_create_testimonials_table', 21),
(32, '2024_01_01_000003_create_faqs_table', 21),
(33, '2024_01_01_000004_create_why_choose_us_table', 21),
(34, '2026_07_30_143613_add_slider_content_fields_to_sliders_table', 22),
(35, '2026_07_30_144252_add_counter_fields_to_companyprofiles_table', 23),
(36, '2026_07_30_145421_add_type_to_services_table', 24),
(37, '2026_07_31_000000_add_image_to_why_choose_us_table', 25),
(38, '2026_07_31_000001_add_cta_bg_to_companyprofiles_table', 26),
(39, '2026_07_31_000002_create_blogs_table', 27),
(40, '2026_07_31_000003_add_whatsapp_to_companyprofiles_table', 28),
(41, '2026_07_31_000005_add_favicon_to_companyprofiles_table', 29),
(42, '2026_08_05_070008_add_old_price_to_products_table', 30),
(43, '2026_08_05_000000_add_description_to_categories_table', 31),
(44, '2026_08_05_170000_change_old_price_to_string_in_products_table', 32),
(45, '2026_08_06_000000_add_section_to_categories_table', 33),
(46, '2026_08_28_000001_create_destinations_table', 34),
(47, '2026_08_28_000002_create_packages_table', 34),
(48, '2026_08_28_000003_add_tour_fields_to_products_table', 34),
(49, '2026_08_31_000001_create_stats_table', 35),
(50, '2026_08_31_000002_create_deals_table', 35),
(51, '2026_08_31_000003_add_home_fields_to_categories_table', 35),
(52, '2026_08_31_000004_expand_abouts_table', 35),
(53, '2026_08_31_000005_add_cta_fields_to_companyprofiles_table', 35),
(54, '2026_08_31_000006_add_fields_to_galleries_table', 35),
(55, '2026_08_31_185254_create_home_page_settings_table', 36),
(56, '2026_09_01_133611_create_attractions_table', 37),
(57, '2026_09_01_133711_create_experience_types_table', 37),
(58, '2026_09_01_133753_create_experiences_table', 37),
(59, '2026_09_01_140109_create_categories_table', 38),
(60, '2026_09_01_140115_create_destinations_table', 38),
(61, '2026_09_01_140120_create_products_table', 39),
(62, '2026_09_01_145027_create_product_images_table', 40),
(63, '2026_09_01_152144_add_dynamic_fields_to_products_table', 41);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `destination_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `old_price` decimal(10,2) DEFAULT NULL,
  `badge_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` decimal(3,1) DEFAULT NULL,
  `reviews_count` int(11) NOT NULL DEFAULT 0,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `free_cancellation` tinyint(1) NOT NULL DEFAULT 1,
  `short_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `included` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`included`)),
  `excluded` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`excluded`)),
  `itinerary` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`itinerary`)),
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `map_iframe` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meeting_point` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancellation_policy` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`cancellation_policy`)),
  `faqs` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`faqs`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `destination_id`, `name`, `slug`, `image`, `price`, `old_price`, `badge_type`, `rating`, `reviews_count`, `duration`, `group_size`, `free_cancellation`, `short_description`, `description`, `included`, `excluded`, `itinerary`, `status`, `sort_order`, `created_at`, `updated_at`, `map_iframe`, `meeting_point`, `cancellation_policy`, `faqs`) VALUES
(1, 1, 2, 'Yael Wolfe', 'yael-wolfe', 'uploads/products/1788273906.jpg', '311.00', '28.00', 'Saepe et in qui aliq', '55.0', 26, 'Doloremque eius volu', 'Aut excepteur conseq', 0, 'Dicta fugit ea sunt', 'Consectetur sit vel', '[\"Voluptas animi sed\"]', '[\"Est et autem quae si\"]', '[\"Tempore lorem optio\"]', 1, 91, '2026-09-01 08:45:06', '2026-09-01 08:45:06', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'uploads/products/gallery/17882748510.jpg', '2026-09-01 09:00:51', '2026-09-01 09:00:51'),
(2, 1, 'uploads/products/gallery/17882748511.jpg', '2026-09-01 09:00:51', '2026-09-01 09:00:51');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'furniture',
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `slug`, `icon`, `short_description`, `description`, `image`, `status`, `type`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Luggage Storage', 'luggage-storage', '🧳', 'Drop your bags before your tour and explore hands-free. Secure storage right in the heart of the city, open daily.', NULL, 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a4/Main_entrance_hall_at_Roma_Termini_Railway_Station_in_Rome%2C_Italy.jpg/960px-Main_entrance_hall_at_Roma_Termini_Railway_Station_in_Rome%2C_Italy.jpg', 1, 'home', 1, '2026-08-31 12:18:17', '2026-08-31 12:18:17'),
(2, 'Airport Transfer', 'airport-transfer', '✈️', 'Private, punctual transfers to and from Fiumicino & Ciampino. A chauffeur meets you at arrivals — no queues, no hassle.', NULL, 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b7/Rome_Fiumicino_international_airport_-_Main_entrance_with_streets.jpg/960px-Rome_Fiumicino_international_airport_-_Main_entrance_with_streets.jpg', 1, 'home', 2, '2026-08-31 12:18:17', '2026-08-31 12:18:17'),
(3, 'Private Taxi & Transfers', 'private-taxi-transfers', '🚗', 'Book a private car for any journey — hotel-to-hotel, cruise port, or a night out. Fixed fares, professional drivers.', NULL, 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a1/Colosseum_of_Rome_and_Roman_forum.jpg/960px-Colosseum_of_Rome_and_Roman_forum.jpg', 1, 'home', 3, '2026-08-31 12:18:17', '2026-08-31 12:18:17'),
(4, 'Golf Cart Tours', 'golf-cart-tours', '🏎️', 'Glide through the cobbled lanes of the Eternal City in style. A fun, effortless way to see Rome\'s hidden gems.', NULL, 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Colosseum_in_Rome%2C_Italy_-_April_2007.jpg/960px-Colosseum_in_Rome%2C_Italy_-_April_2007.jpg', 1, 'home', 4, '2026-08-31 12:18:17', '2026-08-31 12:18:17');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `heading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `subtitle`, `heading`, `link`, `button_text`, `button_url`, `video_url`, `image`, `created_by`, `updated_by`, `ip_address`, `created_at`, `updated_at`) VALUES
(22, 'Your Journey, Our Priority', 'Handpicked Rome & Vatican with local expert guides, seamless booking, and unforgettable experiences.', 'Handpicked Rome & Vatican with local expert guides, seamless booking, and unforgettable experiences.', NULL, 'Get Quotation', '/contact-us', 'https://youtu.be/gpdocHyzN78', 'uploads/slider/Rome_6a9132df7e458.jpg', 1, 1, '127.0.0.1', '2026-07-30 08:40:29', '2026-09-01 07:15:30'),
(23, 'Your Journey, Our Priority', 'Handpicked Rome & Vatican with local expert guides, seamless booking, and unforgettable experiences.', 'Handpicked Rome & Vatican with local expert guides, seamless booking, and unforgettable experiences.', NULL, NULL, NULL, NULL, 'uploads/slider/view-tiber-river-center-rome-italy_6a913dbb4c25c.jpg', 1, 1, '127.0.0.1', '2026-07-31 03:56:28', '2026-09-01 07:15:14');

-- --------------------------------------------------------

--
-- Table structure for table `stats`
--

CREATE TABLE `stats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stats`
--

INSERT INTO `stats` (`id`, `icon`, `number`, `label`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, '35,000+', 'TOURISTS SERVED', 1, 1, '2026-08-31 12:18:16', '2026-08-31 12:18:16'),
(2, NULL, NULL, 'MOST VISITED MONUMENTS', 2, 1, '2026-08-31 12:18:16', '2026-08-31 12:18:16'),
(3, NULL, NULL, 'WHATSAPP INSTANT BOOKING', 3, 1, '2026-08-31 12:18:16', '2026-08-31 12:18:16'),
(4, NULL, '7', 'LANGUAGES SPOKEN', 4, 1, '2026-08-31 12:18:16', '2026-08-31 12:18:16'),
(5, NULL, '4.8★', 'AVERAGE RATING', 5, 1, '2026-08-31 12:18:16', '2026-08-31 12:18:16'),
(6, NULL, '50+', 'CURATED TOURS', 6, 1, '2026-08-31 12:18:16', '2026-08-31 12:18:16'),
(7, NULL, NULL, 'FREE CANCELLATION', 7, 1, '2026-08-31 12:18:16', '2026-08-31 12:18:16'),
(8, NULL, '24/7', 'SUPPORT', 8, 1, '2026-08-31 12:18:16', '2026-08-31 12:18:16');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 5,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `designation`, `image`, `review`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Emily & Luke', 'Verified Travellers, UK', NULL, 'The Colosseum tour with skip-the-line access was flawless. Mr. J\'s team made everything effortless — we booked on WhatsApp in under a minute!', 5, 1, '2026-08-31 12:18:17', '2026-08-31 12:18:17'),
(2, 'Marco & Camila', 'Verified Travellers, Spain', NULL, 'Vatican Museums at opening was magical. Our guide spoke perfect English and Spanish for my parents. Worth every euro — book it!', 5, 1, '2026-08-31 12:18:17', '2026-08-31 12:18:17'),
(3, 'Sarah Green', 'Verified Traveller, USA', NULL, 'Free cancellation saved my trip when my flight changed. The team rearranged everything instantly via WhatsApp. Truly premium service.', 5, 1, '2026-08-31 12:18:17', '2026-08-31 12:18:17'),
(4, 'Priya & Daniel', 'Verified Travellers, India / Canada', NULL, 'The golf cart tour was the highlight of our honeymoon! Covered more of Rome in one evening than days of walking. So romantic at sunset.', 5, 1, '2026-08-31 12:18:17', '2026-08-31 12:18:17'),
(5, 'Hiro & Keiko', 'Verified Travellers, Japan', NULL, 'Luggage storage + airport transfer package was genius. We landed, dropped bags, toured the Pantheon, and reached our hotel stress-free.', 5, 1, '2026-08-31 12:18:17', '2026-08-31 12:18:17'),
(6, 'Aisha B.', 'Verified Traveller, Australia', NULL, 'As a solo traveller I felt completely safe and looked after. The small group size meant the guide could tailor everything to us. 10/10.', 5, 1, '2026-08-31 12:18:17', '2026-08-31 12:18:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no.png',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `role_id`, `email_verified_at`, `password`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nice In Rome Tour', 'admin', 'niceinroometoue@gmail.com', 1, NULL, '$2y$10$VuBFLmG59ifaJFRcTb.Qn.UZ9U73YPWmXKHN5e5.AUqtu3I7HsO1O', 'uploads/user/logo_6a916402dd5e5.jpeg', NULL, '2022-10-27 00:34:21', '2026-08-28 04:33:55'),
(2, 'User Name', 'user', 'user@gmail.com', NULL, NULL, '$2y$10$LWbHmXoM6GIYC8ZDPrInMeXm2vkbvpfjH9mA5dC64AFhXwYtr169m', 'uploads/user/29579_63662defd7938.jpg', NULL, '2022-11-05 03:33:35', '2022-11-05 03:33:35'),
(3, 'Ashraful', 'ashraf', 'ashraful@gmail.com', NULL, NULL, '$2y$10$0bhwJVH6kdMPFV8VxqfGs.oZCGUcALJ8XDIa42xzfzpwMyJYyW3J6', 'uploads/user/36128519_63663ce700ba2.jpg', NULL, '2022-11-05 04:37:27', '2022-11-05 04:37:27');

-- --------------------------------------------------------

--
-- Table structure for table `why_choose_us`
--

CREATE TABLE `why_choose_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `why_choose_us`
--

INSERT INTO `why_choose_us` (`id`, `title`, `icon`, `image`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'WhatsApp Instant Booking', '💬', NULL, 'Book your tour in seconds — availability confirmed instantly, 24/7. Chat like a friend, not a customer.', 1, '2026-08-31 12:18:17', '2026-08-31 12:18:17'),
(2, 'Skip the Line Access', '🏛️️', NULL, 'Exclusive priority access to Rome\'s most visited monuments. No waiting, no stress — just pure history.', 1, '2026-08-31 12:18:17', '2026-08-31 12:18:17'),
(3, '7 Languages Spoken', '🌐', NULL, 'Our expert guides speak Italian, English, Spanish, French, Arabic and more for a truly personal experience.', 1, '2026-08-31 12:18:17', '2026-08-31 12:18:17'),
(4, 'Free Cancellation', '✅', NULL, 'Flexible booking with free cancellation on all tours. Book with confidence — plans change, we understand.', 1, '2026-08-31 12:18:17', '2026-08-31 12:18:17'),
(5, '4.8★ Average Rating', '⭐', NULL, 'Trusted by 35,000+ happy tourists worldwide. Our reputation is built on unforgettable experiences.', 1, '2026-08-31 12:18:17', '2026-08-31 12:18:17'),
(6, 'Small Group Tours', '🎯', NULL, 'Intimate small-group experiences that make you feel like a VIP, not just another tourist in the crowd.', 1, '2026-08-31 12:18:17', '2026-08-31 12:18:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blogs_slug_unique` (`slug`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companyprofiles`
--
ALTER TABLE `companyprofiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deals`
--
ALTER TABLE `deals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `destinations_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_page_settings`
--
ALTER TABLE `home_page_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `management`
--
ALTER TABLE `management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_destination_id_foreign` (`destination_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_slug_unique` (`slug`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stats`
--
ALTER TABLE `stats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `why_choose_us`
--
ALTER TABLE `why_choose_us`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `companyprofiles`
--
ALTER TABLE `companyprofiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `deals`
--
ALTER TABLE `deals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `home_page_settings`
--
ALTER TABLE `home_page_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `management`
--
ALTER TABLE `management`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `stats`
--
ALTER TABLE `stats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `why_choose_us`
--
ALTER TABLE `why_choose_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
