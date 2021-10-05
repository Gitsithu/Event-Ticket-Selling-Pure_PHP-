-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2019 at 03:04 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_events_mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `event_category`
--

CREATE TABLE `event_category` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event_category`
--

INSERT INTO `event_category` (`id`, `name`, `created_at`, `modified_at`, `deleted_at`) VALUES
(1, 'Art', '2019-04-08 19:33:46', '0000-00-00 00:00:00', NULL),
(2, 'Busniess', '2019-04-08 19:33:46', '0000-00-00 00:00:00', NULL),
(3, 'Concerts', '2019-04-08 19:33:46', '0000-00-00 00:00:00', NULL),
(4, 'Exhibition', '2019-04-08 19:33:46', '0000-00-00 00:00:00', NULL),
(5, 'Festivals', '2019-04-08 19:33:46', '0000-00-00 00:00:00', NULL),
(6, 'Meetups', '2019-04-08 19:33:46', '0000-00-00 00:00:00', NULL),
(7, 'Parties', '2019-04-08 19:33:46', '0000-00-00 00:00:00', NULL),
(8, 'Performance', '2019-04-08 19:33:46', '0000-00-00 00:00:00', NULL),
(9, 'Sports', '2019-04-08 19:33:46', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` int(11) DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`, `created_at`, `deleted_at`, `modified_at`) VALUES
(1, 'Yangon', '2019-04-08 19:02:13', NULL, '0000-00-00 00:00:00'),
(2, 'Mandalay', '2019-04-08 19:02:13', NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `status` int(11) NOT NULL,
  `ga` tinyint(4) NOT NULL,
  `ga_price` double NOT NULL,
  `ga_quantity` int(5) NOT NULL,
  `vip` tinyint(4) NOT NULL,
  `vip_price` double NOT NULL,
  `vip_quantity` int(5) NOT NULL,
  `vvip` int(11) NOT NULL,
  `vvip_price` double NOT NULL,
  `vvip_quantity` int(5) NOT NULL,
  `total_price` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `ticket_id`, `user_id`, `image`, `status`, `ga`, `ga_price`, `ga_quantity`, `vip`, `vip_price`, `vip_quantity`, `vvip`, `vvip_price`, `vvip_quantity`, `total_price`, `created_at`, `modified_at`, `deleted_at`) VALUES
(1, 7, 3, 'http://localhost/eventticket/assets/images/ticket/ticket_22_51_42_5caf6996703b1.jpg', 3, 1, 45000, 0, 1, 60000, 28, 0, 0, 0, 120000, '2019-04-11 22:22:34', '0000-00-00 00:00:00', NULL),
(2, 6, 3, 'http://localhost/eventticket/assets/images/ticket/ticket_22_48_56_5caf68f03b78f.jpg', 2, 1, 42000, 2, 1, 60000, 1, 0, 0, 0, 144000, '2019-04-12 15:01:40', '0000-00-00 00:00:00', NULL),
(3, 6, 3, 'http://localhost/eventticket/assets/images/ticket/ticket_22_48_56_5caf68f03b78f.jpg', 2, 1, 42000, 3, 1, 60000, 3, 0, 0, 0, 102000, '2019-04-18 08:18:05', '0000-00-00 00:00:00', NULL),
(4, 3, 3, 'http://localhost/eventticket/assets/images/ticket/ticket_22_22_17_5caf62b18204d.jpg', 2, 1, 55000, 0, 1, 85000, 0, 1, 100000, 5, 500000, '2019-05-23 14:18:52', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name`, `created_at`, `modified_at`, `deleted_at`) VALUES
(1, 'pending', '2019-04-07 13:46:35', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'success', '2019-04-07 14:50:17', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'reject', '2019-04-07 14:50:44', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'going', '2019-04-07 15:33:11', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `created_at`, `modified_at`, `deleted_at`) VALUES
(1, 'user', '2019-04-04 17:16:06', '0000-00-00 00:00:00', NULL),
(2, 'creator', '2019-04-04 17:16:15', '0000-00-00 00:00:00', NULL),
(3, 'admin', '2019-04-04 17:24:30', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `address` text NOT NULL,
  `location_id` int(11) NOT NULL,
  `event_category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_date` varchar(50) NOT NULL,
  `end_date` varchar(50) NOT NULL,
  `free_ticket` tinyint(4) NOT NULL,
  `image` varchar(150) NOT NULL,
  `status` int(11) NOT NULL,
  `ga` tinyint(4) NOT NULL,
  `ga_price` double NOT NULL,
  `ga_quantity` int(5) NOT NULL,
  `vip` tinyint(4) NOT NULL,
  `vip_price` double NOT NULL,
  `vip_quantity` int(5) NOT NULL,
  `vvip` int(11) NOT NULL,
  `vvip_price` double NOT NULL,
  `vvip_quantity` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `title`, `description`, `address`, `location_id`, `event_category_id`, `user_id`, `start_date`, `end_date`, `free_ticket`, `image`, `status`, `ga`, `ga_price`, `ga_quantity`, `vip`, `vip_price`, `vip_quantity`, `vvip`, `vvip_price`, `vvip_quantity`, `created_at`, `modified_at`, `deleted_at`) VALUES
(1, 'New year count down', '808 new is comming differently to you.', 'eee', 1, 3, 2, '2019-04-11  2:00:00 pm', '2019-04-12  2:00:00 pm', 0, 'http://localhost/eventticket/assets/images/ticket/ticket_14_41_50_5cada546c8ea9.png', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2019-04-10 08:11:50', '0000-00-00 00:00:00', NULL),
(2, 'Black jack', 'come and get the new taste and performance in my festival', 'eee', 1, 1, 2, '2019-04-10  3:00:00 pm', '2019-04-12  3:00:00 pm', 1, 'http://localhost/eventticket/assets/images/ticket/ticket_15_13_10_5cadac9e6c951.jpg', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2019-04-10 08:43:10', '0000-00-00 00:00:00', NULL),
(3, 'Barracks 5th Festival', 'á€”á€¾á€…á€ºá€…á€‰á€º á€žá€„á€ºá€¹á€€á€¼á€”á€ºá€á€­á€¯á€„á€ºá€¸á€™á€¾á€¬ á€¡á€•á€¼á€á€ºá€œá€”á€ºá€¸á€”á€±á€á€²á€· Barrack á€€á€­á€¯ á€€á€¼á€±á€„á€¼á€¬á€•á€«á€›á€…á€± Barracks á€›á€²á€· 5 years anniversary ðŸŽ‰á€á€½á€„á€º  á€šá€á€„á€ºá€”á€¾á€…á€ºá€™á€»á€¬á€¸á€‘á€€á€º á€á€¼á€¶á€á€„á€ºá€¸á€€á€»á€šá€ºá€™á€Šá€º ðŸ¤© á€šá€á€„á€ºá€”á€¾á€…á€ºá€™á€»á€¬á€¸á€‘á€€á€º international Dj ðŸ‘ðŸ‘ðŸ‘ á€šá€á€„á€ºá€”á€¾á€…á€ºá€™á€»á€¬á€¸á€‘á€€á€º local Dj ðŸ‘ðŸ‘ðŸ‘ á€šá€á€„á€ºá€”á€¾á€…á€ºá€™á€»á€¬á€¸á€‘á€€á€º productionðŸ‘ðŸ‘ðŸ‘', 'San Chaung , Pyay Road ...', 1, 5, 2, '2019-04-13  9:00:00 am', '2019-04-16  7:00:00 pm', 0, 'http://localhost/eventticket/assets/images/ticket/ticket_22_22_17_5caf62b18204d.jpg', 2, 1, 55000, 50, 1, 85000, 50, 1, 100000, 45, '2019-04-11 15:52:17', '0000-00-00 00:00:00', NULL),
(4, 'Culture Show', 'á€žá€¬á€šá€¬á€œá€¾á€•á€á€²á€· á€Šá€”á€±á€á€„á€ºá€¸á€œá€±á€¸á€á€…á€ºá€á€¯á€™á€¾á€¬ á€™á€­á€žá€¬á€¸á€…á€¯ áŠ á€žá€°á€„á€šá€ºá€á€»á€„á€ºá€¸áŠ á€™á€­á€á€ºá€†á€½á€±á€¡á€•á€±á€«á€„á€ºá€¸á€¡á€žá€„á€ºá€¸á€™á€»á€¬á€¸á€”á€¾á€„á€·á€º á€¡á€á€° á€™á€¼á€”á€ºá€™á€¬á€·á€›á€­á€¯á€¸á€›á€¬ á€¡á€€á€¡á€œá€¾á€™á€»á€¬á€¸á€€á€­á€¯ á€€á€¼á€Šá€·á€ºá€›á€°á€á€¶á€…á€¬á€¸á€•á€¼á€®á€¸ ................ á€¡á€›á€žá€¬á€›á€¾á€­á€žá€±á€¬ á€¡á€…á€¬á€¸á€¡á€žá€±á€¬á€€á€ºá€™á€»á€¬á€¸á€•á€«á€á€„á€ºá€žá€Šá€·á€º Buffet á€€á€­á€¯ á€žá€¯á€¶á€¸á€†á€±á€¬á€„á€ºá€–á€­á€¯á€·á€¡á€á€½á€€á€º Vintage Luxury Yacht Hotel á€€á€»á€„á€ºá€¸á€•á€•á€¼á€¯á€œá€¯á€•á€ºá€™á€šá€·á€º Culture Show á€•á€½á€²á€€á€­á€¯ á€œá€Šá€ºá€¸á€¡á€›á€„á€ºá€œá€á€½á€±á€œá€­á€¯ á€¡á€¬á€¸á€•á€±á€€á€¼á€–á€­á€¯á€· á€‘á€•á€ºá€™á€¶á€–á€­á€á€ºá€á€±á€«á€ºá€¡á€•á€ºá€•á€«á€á€šá€º........  á€œá€€á€ºá€™á€¾á€á€ºá€á€…á€±á€¬á€„á€ºá€€á€­á€¯ 15000 á€€á€»á€•á€º.ðŸ˜¯ðŸ˜¯ðŸ˜¯ðŸ˜¯.........', 'Vintage Luxury Yacht Hotel~ á€¡á€™á€¾á€á€º (á†)áŠ á€—á€­á€¯á€œá€ºá€á€‘á€±á€¬á€„á€ºá€†á€­á€•á€ºá€€á€™á€ºá€¸áŠ á€—á€­á€¯á€œá€ºá€á€‘á€±á€¬á€„á€ºá€˜á€¯á€›á€¬á€¸á€¡á€”á€®á€¸áŠ á€†á€­á€•á€ºá€€á€™á€ºá€¸á€™á€¼á€­á€¯á€·á€”á€šá€ºá‹', 1, 1, 2, '2019-04-20  9:00:00 am', '2019-04-30  6:00:00 pm', 1, 'http://localhost/eventticket/assets/images/ticket/ticket_22_37_59_5caf665f55c91.jpg', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2019-04-11 16:07:59', '0000-00-00 00:00:00', NULL),
(5, 'BlackJack Water Festival', '2019 Blackjack water festival á€€ á€›á€­á€¯á€¸á€›á€¬á€žá€„á€ºá€¹á€€á€¼á€”á€ºá€”á€²á€· á€¡á€™á€­á€¯á€€á€ºá€…á€¬á€¸ EDM Rave area á€á€­á€¯á€· á€•á€±á€«á€„á€ºá€¸á€…á€•á€ºá€–á€½á€²á€·á€…á€Šá€ºá€¸á€‘á€¬á€¸á€œá€­á€¯á€· á€žá€„á€ºá€¹á€€á€¼á€”á€ºá€™á€á€¹á€á€•á€º á€‘á€­á€¯á€„á€ºá€•á€¼á€®á€¸ International top 100 headliners á€™á€»á€¬á€¸á€”á€²á€·á€¡á€á€° á€žá€„á€ºá€¹á€€á€¼á€”á€ºá€™á€¾á€¬á€á€°á€á€°á€€á€²á€€á€¼á€›á€¡á€±á€¬á€„á€º !!!', 'San Chaung , Pyay Road ...', 1, 5, 2, '2019-04-13  9:00:00 am', '2019-04-16  6:00:00 pm', 0, 'http://localhost/eventticket/assets/images/ticket/ticket_22_47_02_5caf687ed95ed.jpg', 2, 1, 70000, 50, 1, 100000, 50, 0, 0, 0, '2019-04-11 16:17:02', '0000-00-00 00:00:00', NULL),
(6, 'EXODUS', 'Exodus Entertainment á€€ á€…á€®á€…á€‰á€ºá€€á€»á€„á€ºá€¸ á€•á€™á€šá€·á€º 2019 Exodus Republic á€€á€¼á€®á€¸á€™á€¾á€¬ á€•á€»á€±á€¬á€€á€ºá€†á€¯á€¶á€¸á€”á€±á€á€²á€· á€›á€”á€ºá€€á€¯á€”á€ºá€™á€¼á€­á€¯á€·á€›á€²á€· á€¡á€á€¬á€žá€„á€ºá€¹á€€á€¼á€”á€ºá€€á€­á€¯ á€•á€¼á€”á€ºá€œá€Šá€ºá€›á€¾á€¬á€–á€½á€±á€–á€­á€¯á€· á€¡á€†á€„á€ºá€žá€„á€·á€ºá€–á€¼á€…á€ºá€•á€¼á€®á€œá€¬á€¸!!!! ðŸ’ªðŸ¼ðŸ˜Ž', 'San Chaung , Pyay Road ...', 1, 5, 2, '2019-04-13  8:00:00 am', '2019-04-16  6:00:00 pm', 0, 'http://localhost/eventticket/assets/images/ticket/ticket_22_48_56_5caf68f03b78f.jpg', 2, 1, 42000, 0, 1, 60000, 0, 0, 0, 0, '2019-04-11 16:18:56', '0000-00-00 00:00:00', NULL),
(7, 'TGY Water Festival', 'á€˜á€±á€¬á€ºá€’á€«á€á€­á€¯á€·á€›á€± á€žá€„á€ºá€¹á€€á€¼á€”á€ºá€¡á€á€½á€€á€º á€’á€®á€”á€±á€›á€¬á€†á€­á€¯á€¡á€†á€„á€ºá€•á€¼á€±á€á€šá€ºá€Ÿá€¯á€á€º ðŸ˜Ž .... ðŸ‘ðŸ‘ TGY WATER FESTIVAL (THE GOD OF WATER)', 'San Chaung , Pyay Road ...', 1, 5, 2, '2019-04-13  8:00:00 am', '2019-04-16  6:00:00 pm', 0, 'http://localhost/eventticket/assets/images/ticket/ticket_22_51_42_5caf6996703b1.jpg', 2, 1, 45000, 20, 1, 60000, 10, 0, 0, 0, '2019-04-11 16:21:42', '0000-00-00 00:00:00', NULL),
(8, 'Mya Kyun Thar Festival', 'á€’á€®á€”á€¾á€…á€ºá€žá€„á€ºá€¹á€€á€¼á€”á€ºá€™á€¾á€¬á€á€±á€¬á€· á€•á€»á€±á€¬á€ºá€›á€½á€¾á€„á€ºá€…á€›á€¬á€á€½á€± á€¡á€†á€€á€ºá€™á€•á€¼á€á€ºá€™á€šá€·á€º á€™á€¼á€€á€»á€½á€”á€ºá€¸á€žá€¬á€žá€„á€ºá€¹á€€á€¼á€”á€ºá€•á€½á€² á€€á€­á€¯á€œá€¬á€–á€­á€¯á€·á€¡á€á€½á€€á€º á€–á€­á€á€ºá€á€±á€«á€ºá€á€»á€„á€ºá€•á€«á€á€šá€ºá‹ á€á€„á€ºá€€á€¼á€±á€¸ á€€á€œá€Šá€ºá€¸á€¡á€á€™á€²á€·á€•á€²á€†á€­á€¯á€á€±á€¬á€·  á€á€…á€ºá€™á€­á€žá€¬á€¸á€…á€¯á€œá€¯á€¶á€¸ á€•á€»á€±á€¬á€ºá€™á€†á€¯á€¶á€¸á€™á€²á€· á€›á€”á€ºá€€á€¯á€”á€ºá€€ á€¡á€€á€¼á€®á€¸á€†á€¯á€¶á€¸ á€žá€„á€ºá€¹á€€á€¼á€”á€ºáŠ á€™á€¼á€€á€»á€½á€”á€ºá€¸á€žá€¬á€žá€„á€ºá€¹á€€á€¼á€”á€ºá€€á€­á€¯ á€¡á€›á€±á€¬á€€á€ºá€œá€¬á€á€²á€·á€á€±á€¬á€·á€”á€±á€¬á€ºá‹', 'Yankin , Insein Road .', 1, 5, 2, '2019-04-13  9:00:00 am', '2019-04-16  7:00:00 pm', 1, 'http://localhost/eventticket/assets/images/ticket/ticket_22_55_20_5caf6a702b08b.jpg', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2019-04-11 16:25:20', '0000-00-00 00:00:00', NULL),
(9, 'We are connected', 'This is our third step to grow up our fresh future with music', 'eee', 1, 1, 2, '2019-04-14  9:00:00 am', '2019-04-18  6:00:00 pm', 1, 'http://localhost/eventticket/assets/images/ticket/ticket_21_33_13_5cb0a8b175700.png', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2019-04-12 15:03:13', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_status`
--

CREATE TABLE `ticket_status` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(80) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ticket_status`
--

INSERT INTO `ticket_status` (`id`, `name`, `created_at`, `modified_at`, `deleted_at`) VALUES
(1, 'pending', '2019-04-09 17:08:21', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'success', '2019-04-09 17:08:21', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'reject', '2019-04-09 17:08:30', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` text,
  `image` varchar(120) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `role_id` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `address`, `image`, `phone`, `role_id`, `created_at`, `modified_at`, `deleted_at`) VALUES
(1, 'Lwin Moe Paing', 'email@gmail.com', '$2y$10$x/IjNrSBrOi4k5VREhG65uZpiBA4Sce.88F9Aio9crmp9tARnVmy.', NULL, 'http://localhost/eventticket/assets/images/profile/profile_21_34_27_5cb0a8fb297bc.png', '09420059241', 3, '2019-04-08 16:22:05', '0000-00-00 00:00:00', NULL),
(2, 'Creator', 'creator@gmail.com', '$2y$10$1BsdiGuFxiiUdd8WZJusLeamU/qWNJHdx4X8kbXLN88sPHl82DL62', '', 'http://localhost/eventticket/assets/images/profile/profile_21_34_30_5cacb47e8b23d.jpg', '09420059241', 2, '2019-04-08 16:37:04', '0000-00-00 00:00:00', NULL),
(3, 'Htet Naing', 'user@gmail.com', '$2y$10$/m3V5GOOdntfErsvdX3gwOKIMhS.1Kwu.W3RgfAF1a7ORsjyFhGdy', '', 'http://localhost/eventticket/assets/images/logo/default.svg', '09456654114', 1, '2019-04-10 10:41:10', '0000-00-00 00:00:00', NULL),
(4, 'Htet', 'user1@gmail.com', '$2y$10$pasdCQn/ZsWaaN5Bporzd.d/DdTXiozMsKDZQ363K0G5fCsIe7muu', '', 'http://localhost/eventticket/assets/images/logo/default.svg', '0945648745', 1, '2019-04-12 15:08:40', '0000-00-00 00:00:00', NULL),
(5, 'Techal', 'abc@gmail.com', '$2y$10$RIC0giDEt4YxCqcDUILiwuMn3CTEX18lNd/KBoC3Xlmvurae8fNvi', '', 'http://localhost/eventticket/assets/images/logo/default.svg', '09900990', 2, '2019-05-23 13:52:22', '0000-00-00 00:00:00', NULL),
(6, 'Si Thu', 'sithunyuntswe1@gmail.com', '$2y$10$T/8TJzERYp.DVmuEzbg/kesY6QzDhVXsICIKLJ0hw166PIGhRUHfy', '', 'http://localhost/eventticket/assets/images/logo/default.svg', '09250676233', 2, '2019-05-24 01:05:58', '0000-00-00 00:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event_category`
--
ALTER TABLE `event_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_status`
--
ALTER TABLE `ticket_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event_category`
--
ALTER TABLE `event_category`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ticket_status`
--
ALTER TABLE `ticket_status`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
