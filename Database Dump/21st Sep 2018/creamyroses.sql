-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2018 at 03:28 AM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `creamyroses`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `aid` int(11) NOT NULL,
  `cid` int(11) NOT NULL COMMENT 'foreign key of tbl_customer',
  `name` varchar(60) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `pin` int(10) NOT NULL,
  `address_line_1` varchar(200) NOT NULL,
  `address_line_2` varchar(200) DEFAULT NULL,
  `landmark` varchar(200) DEFAULT NULL,
  `city` varchar(200) NOT NULL,
  `stateCode` int(11) NOT NULL,
  `isDefault` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: General; 1: Default Address;',
  `type` tinyint(1) NOT NULL COMMENT '0: Home Address; 1: Office Address; 2: Others; ',
  `remarks` varchar(300) DEFAULT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Deleted; 1: Active',
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`aid`, `cid`, `name`, `mobile`, `email`, `pin`, `address_line_1`, `address_line_2`, `landmark`, `city`, `stateCode`, `isDefault`, `type`, `remarks`, `isDeleted`, `modified_on`, `created_on`) VALUES
(1, 2, 'khnad Mish', '0640654650', NULL, 734005, 'Delhi', 'Ashok Nagar', '', 'Siliguri', 1, 0, 1, 'Maitix', 0, '2018-07-28 18:23:09', '2018-07-28 18:23:09'),
(2, 22, 'Jai Kaushik', '9871145277', NULL, 110094, 'D-15/4', 'Ganga Vihar, Delhi', 'Near Ganga Public School', 'Delhi', 2, 1, 0, 'Sweet Home', 1, '2018-09-08 15:38:03', '2018-09-08 15:38:03'),
(4, 22, 'Raj Mishra ed', '9871123454', NULL, 110056, 'D-15/44', 'Ganga Vihar, Delhi', 'Near Ganga Public School', 'Delhi', 12, 0, 1, 'My Office', 1, '2018-09-08 15:48:06', '2018-09-08 15:48:06');

-- --------------------------------------------------------

--
-- Table structure for table `admin_audittrail`
--

CREATE TABLE `admin_audittrail` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `user_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: Admin; 1: Customer',
  `ip` varchar(30) DEFAULT NULL,
  `action` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL,
  `data` varchar(300) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_audittrail`
--

INSERT INTO `admin_audittrail` (`id`, `userID`, `user_type`, `ip`, `action`, `status`, `data`, `created_date`) VALUES
(212, 1, 0, '192.168.0.125', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-03 09:04:32'),
(213, 1, 0, '192.168.0.125', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-03 09:15:28'),
(214, 1, 0, '192.168.0.125', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-03 09:24:52'),
(215, 1, 0, '192.168.137.1', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-03 12:05:40'),
(216, 1, 0, '192.168.0.125', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-04 06:00:13'),
(217, 1, 0, '192.168.0.125', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-04 06:26:11'),
(218, 1, 0, '192.168.0.125', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-04 14:24:52'),
(219, 1, 0, '192.168.1.14', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-05 17:31:04'),
(220, 1, 0, '192.168.1.14', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-05 17:31:19'),
(221, 1, 0, '192.168.1.14', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-05 17:31:32'),
(222, 1, 0, '192.168.1.14', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-05 19:43:54'),
(223, 1, 0, '192.168.1.14', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-07 04:43:36'),
(224, 1, 0, '192.168.0.102', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-07 17:32:59'),
(225, 1, 0, '192.168.0.102', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-07 18:04:03'),
(226, 1, 0, '192.168.1.4', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-09 05:15:33'),
(227, 1, 0, '192.168.1.4', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-10 10:07:26'),
(228, 1, 0, '192.168.0.106', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-10 16:18:33'),
(229, 1, 0, '192.168.1.4', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-11 05:50:49'),
(230, 1, 0, '192.168.1.4', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-11 05:59:28'),
(231, 1, 0, '192.168.1.4', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-11 06:06:52'),
(232, 1, 0, '192.168.0.104', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-12 16:59:48'),
(233, 1, 0, '192.168.0.104', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-12 17:36:16'),
(234, 1, 0, '192.168.0.104', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-14 10:16:28'),
(235, 1, 0, '192.168.0.101', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-19 15:51:09'),
(236, 1, 0, '192.168.0.101', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-19 16:01:05'),
(237, 1, 0, '192.168.0.101', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-19 18:10:50'),
(238, 1, 0, '192.168.0.104', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-22 09:21:31'),
(239, 1, 0, '192.168.0.104', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-22 09:33:35'),
(240, 1, 0, '192.168.0.104', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-22 11:27:00'),
(241, 1, 0, '192.168.0.104', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-22 11:27:03'),
(242, 1, 0, '192.168.0.104', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-22 11:27:06'),
(243, 1, 0, '192.168.0.104', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-22 11:44:33'),
(244, 1, 0, '192.168.0.104', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-22 11:44:50'),
(245, 1, 0, '192.168.0.104', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-22 13:11:44'),
(246, 1, 0, '192.168.0.104', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-22 14:05:12'),
(247, 1, 0, '192.168.0.102', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-28 09:19:17'),
(248, 1, 0, '192.168.0.102', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-28 18:49:03'),
(249, 1, 0, '192.168.0.102', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-29 01:29:56'),
(250, 1, 0, '192.168.0.102', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-29 05:59:22'),
(251, 1, 0, '192.168.0.102', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-29 09:39:40'),
(252, 1, 0, '192.168.0.102', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-29 18:13:35'),
(253, 1, 0, '192.168.0.102', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-30 16:09:27'),
(254, 1, 0, '192.168.0.102', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-30 17:27:25'),
(255, 1, 0, '192.168.0.102', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-31 14:34:06'),
(256, 1, 0, '192.168.0.102', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-31 15:16:04'),
(257, 1, 0, '192.168.0.102', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-07-31 17:08:01'),
(258, 1, 0, '192.168.0.102', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-02 15:02:57'),
(259, 1, 0, '192.168.0.102', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-02 18:21:31'),
(260, 1, 0, '192.168.0.102', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-02 19:47:20'),
(261, 1, 0, '192.168.0.102', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-03 17:49:06'),
(262, 1, 0, '192.168.0.102', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-03 19:03:46'),
(263, 1, 0, '192.168.1.5', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-05 04:07:15'),
(264, 1, 0, '192.168.1.5', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-05 04:07:19'),
(265, 1, 0, '192.168.1.5', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-05 10:18:05'),
(266, 1, 0, '192.168.1.5', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-05 10:48:51'),
(267, 1, 0, '192.168.1.5', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-05 11:18:38'),
(268, 1, 0, '192.168.1.5', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-05 12:00:17'),
(269, 1, 0, '192.168.0.104', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-05 14:14:32'),
(270, 1, 0, '192.168.0.104', 'Login', 'Failed', 'a:1:{s:7:"trigger";i:1;}', '2018-08-05 14:49:24'),
(271, 1, 0, '192.168.0.104', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-05 14:49:30'),
(272, 1, 0, '192.168.0.104', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-05 17:08:54'),
(273, 1, 0, '192.168.0.104', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-05 18:05:55'),
(274, 1, 0, '192.168.0.104', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-07 22:41:46'),
(275, 1, 0, '192.168.0.104', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-08 16:50:11'),
(276, 1, 0, '192.168.0.104', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-09 15:42:17'),
(277, 1, 0, '192.168.0.104', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-12 02:46:42'),
(278, 1, 0, '192.168.0.104', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-12 04:15:32'),
(279, 1, 0, '192.168.0.104', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-12 05:40:25'),
(280, 1, 0, '192.168.0.104', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-12 06:20:10'),
(281, 1, 0, '192.168.0.104', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-12 09:01:21'),
(282, 1, 0, '192.168.0.104', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-12 09:12:44'),
(283, 1, 0, '43.255.152.9', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-12 20:21:58'),
(284, 1, 0, '43.255.152.9', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-13 05:33:50'),
(285, 1, 0, '43.255.152.9', 'Login', 'Failed', 'a:1:{s:7:"trigger";i:1;}', '2018-08-13 08:10:55'),
(286, 1, 0, '43.255.152.9', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-13 08:11:01'),
(287, 1, 0, '43.255.152.9', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-13 12:57:12'),
(288, 1, 0, '43.255.152.9', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-14 16:38:35'),
(289, 1, 0, '43.255.152.9', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-14 17:02:02'),
(290, 1, 0, '43.255.152.9', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-14 21:11:17'),
(291, 1, 0, '43.255.152.9', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-17 16:49:55'),
(292, 1, 0, '192.168.0.107', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-17 18:52:32'),
(293, 1, 0, '192.168.43.57', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-17 19:45:05'),
(294, 1, 0, '192.168.43.57', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-08-29 23:24:53'),
(295, 1, 0, '192.168.0.102', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-09-04 15:17:07'),
(296, 1, 0, '192.168.0.102', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-09-04 16:00:09'),
(297, 1, 0, '192.168.0.102', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-09-04 17:40:03'),
(298, 1, 0, '192.168.0.102', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-09-06 18:19:21'),
(299, 1, 0, '192.168.0.102', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-09-08 18:27:27'),
(300, 1, 0, '192.168.0.102', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-09-08 19:19:39'),
(301, 1, 0, '192.168.0.102', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-09-09 09:42:53'),
(302, 1, 0, '192.168.0.102', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-09-09 16:05:02'),
(303, 1, 0, '192.168.0.103', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-09-10 16:20:49'),
(304, 1, 0, '192.168.0.103', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-09-10 19:47:28'),
(305, 1, 0, '192.168.0.103', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-09-11 17:05:19'),
(306, 1, 0, '192.168.0.103', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-09-11 18:14:57'),
(307, 1, 0, '192.168.0.103', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-09-11 18:32:58'),
(308, 1, 0, '192.168.0.103', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-09-11 18:52:11'),
(309, 1, 0, '192.168.0.103', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-09-11 19:11:12'),
(310, 1, 0, '192.168.0.103', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-09-11 20:20:43'),
(311, 1, 0, '192.168.0.103', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-09-11 21:00:14'),
(312, 1, 0, '192.168.0.103', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-09-12 15:51:16'),
(313, 1, 0, '192.168.0.103', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-09-13 22:41:42'),
(314, 1, 0, '192.168.0.103', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-09-14 13:59:01'),
(315, 1, 0, '192.168.0.103', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-09-14 15:34:57'),
(316, 1, 0, '192.168.0.108', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-09-18 17:10:37'),
(317, 1, 0, '192.168.0.108', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-09-19 16:31:59'),
(318, 1, 0, '192.168.0.108', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-09-20 18:19:20'),
(319, 1, 0, '192.168.0.108', 'Login', 'Success', 'a:1:{s:7:"trigger";i:1;}', '2018-09-20 18:43:36');

-- --------------------------------------------------------

--
-- Table structure for table `admin_contact_us`
--

CREATE TABLE `admin_contact_us` (
  `id` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` text NOT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `isRead` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Read; 1: Unread',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Deleted; 1: Active',
  `created_on` datetime NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin_message_template`
--

CREATE TABLE `admin_message_template` (
  `id` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1: SMS Template; 2: Email Template; 3: Message Template',
  `title` varchar(300) DEFAULT NULL,
  `subject` varchar(300) DEFAULT NULL,
  `message` text,
  `default_title` varchar(300) DEFAULT NULL,
  `default_subject` varchar(300) DEFAULT NULL,
  `default_msg` text,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Deleted; 1: Active; 2: Restrict Delete',
  `created_on` datetime NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_message_template`
--

INSERT INTO `admin_message_template` (`id`, `type`, `title`, `subject`, `message`, `default_title`, `default_subject`, `default_msg`, `isDeleted`, `created_on`, `modified_on`) VALUES
(1, 2, NULL, NULL, NULL, 'Forget Password', 'Forget your password?', '<table class="full" style="-webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius:\r\n 6px;" width="400" cellspacing="0" cellpadding="0" border="0" align="center">\r\n        <tbody><tr>\r\n          <td style="-webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; -webkit-box-shadow\r\n: 0px 0px 6px 0px rgba(0,0,0,0.75); -moz-box-shadow: 0px 0px 6px 0px rgba(0,0,0,0.75); box-shadow: 0px\r\n 0px 6px 0px rgba(0,0,0,0.10);" width="100%" bgcolor="#ffffff"><!-- SORTABLE -->\r\n            \r\n            <div class="sortable_inner ui-sortable"> \r\n              <!-- Start Top -->\r\n              <table class="mobile" style="-webkit-border-top-right-radius: 6px; -moz-border-top-right-radius\r\n: 6px; border-top-right-radius: 6px; -webkit-border-top-left-radius: 6px; -moz-border-top-left-radius\r\n: 6px; border-top-left-radius: 6px;" object="drag-module-small" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">\r\n                <tbody><tr>\r\n                  <td class="fullCenter" width="100%" valign="middle" align="center"><!-- Header Text\r\n -->\r\n                    \r\n                    <table style="text-align: center; border-collapse:collapse; mso-table-lspace:0pt\r\n; mso-table-rspace:0pt;" class="fullCenter" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\r\n                      <tbody><tr>\r\n                        <td style="font-size: 1px; line-height: 1px;" width="100%" height="20">&nbsp;\r\n                          ;</td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td style="width:329px; height:auto;" class="fullCenter" width="100%"><p><img style="width: 329px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAUkAAAB/CAYAAABi3jCsAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMDY3IDc5LjE1Nzc0NywgMjAxNS8wMy8zMC0yMzo0MDo0MiAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTUgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOkIzNjMzODI2NjVCRDExRTdCNjQ2RjNFODhGQUE5NEM3IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOkIzNjMzODI3NjVCRDExRTdCNjQ2RjNFODhGQUE5NEM3Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6QjM2MzM4MjQ2NUJEMTFFN0I2NDZGM0U4OEZBQTk0QzciIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6QjM2MzM4MjU2NUJEMTFFN0I2NDZGM0U4OEZBQTk0QzciLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz5i3ib0AAA0C0lEQVR42uxd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" data-filename="illustration_pass.png"><br></p></td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td style="font-size: 1px; line-height: 1px;" width="100%" height="20">&nbsp;\r\n                          ;</td>\r\n                      </tr>\r\n                    </tbody></table></td>\r\n                </tr>\r\n              </tbody></table>\r\n              <table class="mobile" object="drag-module-small" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">\r\n                <tbody><tr>\r\n                  <td width="100%" valign="middle" align="center"><table style="text-align: center; border-collapse\r\n:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\r\n                      <tbody><tr>\r\n                        <td style="text-align: center; font-family: \'Lato\', Helvetica, Arial, sans-serif\r\n; font-size: 20px; color: #353535; line-height: 33px; font-weight: 400;" class="fullCenter" width="100\r\n%" valign="middle"> Forgot your password ? </td>\r\n                      </tr>\r\n                    </tbody></table></td>\r\n                </tr>\r\n              </tbody></table>\r\n              <table class="mobile" object="drag-module-small" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">\r\n                <tbody><tr>\r\n                  <td width="100%" valign="middle" align="center"><table style="text-align: center; border-collapse\r\n:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\r\n                      <tbody><tr>\r\n                        <td style="font-size: 1px; line-height: 1px;" width="100%" height="25">&nbsp;\r\n                          ;</td>\r\n                      </tr>\r\n                    </tbody></table></td>\r\n                </tr>\r\n              </tbody></table>\r\n              <table class="mobile" object="drag-module-small" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">\r\n                <tbody><tr>\r\n                  <td width="100%" valign="middle" align="center"><table style="text-align: center; border-collapse\r\n:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\r\n                      <tbody><tr>\r\n                        <td style="text-align: center; font-family: \'Lato\', Helvetica, Arial, sans-serif\r\n; font-size: 16px; color: #868585; line-height: 24px; font-weight: 400;" class="" width="100%" valign="middle"> Thats\'s okay, it happens! Click on the button below and enter following OTP, to reset your password.\r\n                          <h1>OTP: <strong>[[OTP]]</strong></h1></td>\r\n                      </tr>\r\n                    </tbody></table></td>\r\n                </tr>\r\n              </tbody></table>\r\n              <table class="mobile" object="drag-module-small" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">\r\n                <tbody><tr>\r\n                  <td width="100%" valign="middle" align="center"><table style="text-align: center; border-collapse\r\n:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\r\n                      <tbody><tr>\r\n                        <td style="font-size: 1px; line-height: 1px;" width="100%" height="30">&nbsp;</td>\r\n                      </tr>\r\n                    </tbody></table></td>\r\n                </tr>\r\n              </tbody></table>\r\n              <table class="mobile" object="drag-module-small" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">\r\n                <tbody><tr>\r\n                  <td width="100%" valign="middle" align="center"><table style="text-align: center; border-collapse\r\n:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\r\n                      <tbody><tr>\r\n                        <td width="100%" align="center"><table class="buttonScale" cellspacing="0" cellpadding="0" border="0" align="center">\r\n                            <tbody><tr>\r\n                              <td style="border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius\r\n: 5px; border-bottom-left-radius: 5px; padding-left: 30px; padding-right: 30px; font-family: \'Lato\',\r\n Helvetica, Arial, sans-serif; color: rgb(255, 255, 255); font-size: 16px; font-weight: 400; line-height\r\n: 1px; background-color: #353535;" bgcolor="#94da43" align="center" height="40"><a href="http://[[ADMIN_URL]]resetpassword" style="color: rgb(255, 255, 255); text-decoration: none; width\r\n: 100%;">Reset Password!</a></td>\r\n                            </tr>\r\n                          </tbody></table></td>\r\n                      </tr>\r\n                    </tbody></table></td>\r\n                </tr>\r\n              </tbody></table>\r\n              <table class="mobile" object="drag-module-small" style="-webkit-border-bottom-right-radius\r\n: 6px; -moz-border-bottom-right-radius: 6px; border-bottom-right-radius: 6px; -webkit-border-bottom-left-radius\r\n: 6px; -moz-border-bottom-left-radius: 6px; border-bottom-left-radius: 6px;" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">\r\n                <tbody><tr>\r\n                  <td width="100%" valign="middle" align="center"><table style="text-align: center; border-collapse\r\n:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\r\n                      <tbody><tr>\r\n                        <td style="font-size: 1px; line-height: 1px;" width="100%" height="50">&nbsp;\r\n                          ;</td>\r\n                      </tr>\r\n                    </tbody></table></td>\r\n                </tr>\r\n              </tbody></table>\r\n              <table class="mobile" object="drag-module-small" style="-webkit-border-radius: 0px 0px\r\n  6px 6px; -moz-border-radius: 0px 0px  6px 6px; border-radius: 0px 0px  6px 6px;" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#00d4ff" align="center">\r\n                <tbody><tr>\r\n                  <td style="-webkit-border-radius: 0px 0px  6px 6px; -moz-border-radius: 0px 0px  6px\r\n 6px; border-radius: 0px 0px  6px 6px;" width="100%" valign="middle" align="center"><table style="text-align\r\n: center; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\r\n                      <tbody><tr> </tr>\r\n                      <tr>\r\n                        <td style="font-size: 1px; line-height: 1px;" width="100%" height="15">&nbsp;\r\n                          ;</td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td style="text-align: center; font-family: \'Lato\', Helvetica, Arial, sans-serif\r\n; font-size: 14px; color: #ffffff; line-height: 22px; font-weight: 400;" class="" width="100%" valign="middle"> *If you are not the orgine of this Email, please consider to update your password </td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td style="font-size: 1px; line-height: 1px;" width="100%" height="15">&nbsp;\r\n                          ;</td>\r\n                      </tr>\r\n                    </tbody></table></td>\r\n                </tr>\r\n              </tbody></table>\r\n            </div>\r\n          </td>\r\n        </tr>\r\n      </tbody></table>', 2, '2018-03-30 00:00:00', '2018-03-28 20:30:00'),
(2, 1, NULL, NULL, NULL, 'Forget Password', 'CMYROS', 'Please use this OTP to reset your password', 2, '2018-03-30 00:00:00', '2018-03-28 20:30:00');
INSERT INTO `admin_message_template` (`id`, `type`, `title`, `subject`, `message`, `default_title`, `default_subject`, `default_msg`, `isDeleted`, `created_on`, `modified_on`) VALUES
(3, 2, NULL, NULL, NULL, 'Activate Account', 'Activate Your Account', '<table class="full" style="-webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius:\n 6px;" width="400" cellspacing="0" cellpadding="0" border="0" align="center">\n        <tbody><tr>\n          <td style="-webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; -webkit-box-shadow\n: 0px 0px 6px 0px rgba(0,0,0,0.75); -moz-box-shadow: 0px 0px 6px 0px rgba(0,0,0,0.75); box-shadow: 0px\n 0px 6px 0px rgba(0,0,0,0.10);" width="100%" bgcolor="#ffffff"><!-- SORTABLE -->\n            \n            <div class="sortable_inner ui-sortable"> \n              <!-- Start Top -->\n              <table class="mobile" style="-webkit-border-top-right-radius: 6px; -moz-border-top-right-radius\n: 6px; border-top-right-radius: 6px; -webkit-border-top-left-radius: 6px; -moz-border-top-left-radius\n: 6px; border-top-left-radius: 6px;" object="drag-module-small" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">\n                <tbody><tr>\n                  <td class="fullCenter" width="100%" valign="middle" align="center"><!-- Header Text\n -->\n                    \n                    <table style="text-align: center; border-collapse:collapse; mso-table-lspace:0pt\n; mso-table-rspace:0pt;" class="fullCenter" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\n                      <tbody><tr>\n                        <td style="font-size: 1px; line-height: 1px;" width="100%" height="20">&nbsp;\n                          ;</td>\n                      </tr>\n                      <tr>\n                        <td style="width:329px; height:auto;" class="fullCenter" width="100%"><p><img style="width: 329px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAUkAAAB+CAYAAACpguMJAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw\n/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWR\nvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMDY3IDc5LjE1Nzc0NywgMjAxNS8wMy8zMC0yMzo0MDo\n0MiAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnM\njIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB\n4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5\njb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTUgKFd\npbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjNFQTY3NEE4NjlBNTExRTc4M0ZFRDdDMjYyQzlCRTcwIiB4bXBNTTp\nEb2N1bWVudElEPSJ4bXAuZGlkOjNFQTY3NEE5NjlBNTExRTc4M0ZFRDdDMjYyQzlCRTcwIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN\n0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6M0VBNjc0QTY2OUE1MTFFNzgzRkVEN0MyNjJDOUJFNzAiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6M0VBNjc0QTc2OUE1MTFFNzgzRkVEN0MyNjJDOUJFNzAiLz4gPC9yZGY6RGVzY3JpcHRpb24\n+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz4lDrgLAAAqJUlEQVR42ux9B3ic1ZX2O0W9S1aXbFmWGy4YG2OqIcTG\n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\n/1eAAQCkVNzA4p+BKQAAAABJRU5ErkJggg==" data-filename="illustration_follow.png"><br></p></td>\n                      </tr>\n                      <tr>\n                        <td style="font-size: 1px; line-height: 1px;" width="100%" height="20">&nbsp;\n                          ;</td>\n                      </tr>\n                    </tbody></table></td>\n                </tr>\n              </tbody></table>\n              <table class="mobile" object="drag-module-small" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">\n                <tbody><tr>\n                  <td width="100%" valign="middle" align="center"><table style="text-align: center; border-collapse\n:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\n                      <tbody><tr>\n                        <td style="text-align: center; font-family: \'Lato\', Helvetica, Arial, sans-serif\n; font-size: 20px; color: #353535; line-height: 33px; font-weight: 400;" class="fullCenter" width="100\n%" valign="middle"> Password Updated ! </td>\n                      </tr>\n                    </tbody></table></td>\n                </tr>\n              </tbody></table>\n              <table class="mobile" object="drag-module-small" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">\n                <tbody><tr>\n                  <td width="100%" valign="middle" align="center"><table style="text-align: center; border-collapse\n:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\n                      <tbody><tr>\n                        <td style="font-size: 1px; line-height: 1px;" width="100%" height="25">&nbsp;\n                          ;</td>\n                      </tr>\n                    </tbody></table></td>\n                </tr>\n              </tbody></table>\n              <table class="mobile" object="drag-module-small" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">\n                <tbody><tr>\n                  <td width="100%" valign="middle" align="center"><table style="text-align: center; border-collapse\n:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\n                      <tbody><tr>\n                        <td style="text-align: center; font-family: \'Lato\', Helvetica, Arial, sans-serif\n; font-size: 16px; color: #868585; line-height: 24px; font-weight: 400;" class="" width="100%" valign="middle">Your account password has been successfully changed.\n                          </td>\n                      </tr>\n                    </tbody></table></td>\n                </tr>\n              </tbody></table>\n              <table class="mobile" object="drag-module-small" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">\n                <tbody><tr>\n                  <td width="100%" valign="middle" align="center"><table style="text-align: center; border-collapse\n:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\n                      <tbody><tr>\n                        <td style="font-size: 1px; line-height: 1px;" width="100%" height="30">&nbsp;</td>\n                      </tr>\n                    </tbody></table></td>\n                </tr>\n              </tbody></table>\n              <table class="mobile" object="drag-module-small" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">\n                <tbody><tr>\n                  <td width="100%" valign="middle" align="center"><table style="text-align: center; border-collapse\n:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\n                      <tbody><tr>\n                        <td width="100%" align="center"><table class="buttonScale" cellspacing="0" cellpadding="0" border="0" align="center">\n                            <tbody><tr>\n                              <td style="border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius\n: 5px; border-bottom-left-radius: 5px; padding-left: 30px; padding-right: 30px; font-family: \'Lato\',\n Helvetica, Arial, sans-serif; color: rgb(255, 255, 255); font-size: 16px; font-weight: 400; line-height\n: 1px; background-color: #353535;" bgcolor="#94da43" align="center" height="40"><a href="[[ADMIN_URL]]login" style="color: rgb(255, 255, 255); text-decoration: none; width\n: 100%;">Login Now!</a></td>\n                            </tr>\n                          </tbody></table></td>\n                      </tr>\n                    </tbody></table></td>\n                </tr>\n              </tbody></table>\n              <table class="mobile" object="drag-module-small" style="-webkit-border-bottom-right-radius\n: 6px; -moz-border-bottom-right-radius: 6px; border-bottom-right-radius: 6px; -webkit-border-bottom-left-radius\n: 6px; -moz-border-bottom-left-radius: 6px; border-bottom-left-radius: 6px;" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">\n                <tbody><tr>\n                  <td width="100%" valign="middle" align="center"><table style="text-align: center; border-collapse\n:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\n                      <tbody><tr>\n                        <td style="font-size: 1px; line-height: 1px;" width="100%" height="50">&nbsp;\n                          ;</td>\n                      </tr>\n                    </tbody></table></td>\n                </tr>\n              </tbody></table>\n              <table class="mobile" object="drag-module-small" style="-webkit-border-radius: 0px 0px\n  6px 6px; -moz-border-radius: 0px 0px  6px 6px; border-radius: 0px 0px  6px 6px;" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#00d4ff" align="center">\n                <tbody><tr>\n                  <td style="-webkit-border-radius: 0px 0px  6px 6px; -moz-border-radius: 0px 0px  6px\n 6px; border-radius: 0px 0px  6px 6px;" width="100%" valign="middle" align="center"><table style="text-align\n: center; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\n                      <tbody><tr> </tr>\n                      <tr>\n                        <td style="font-size: 1px; line-height: 1px;" width="100%" height="15">&nbsp;\n                          ;</td>\n                      </tr>\n                      <tr>\n                        <td style="text-align: center; font-family: \'Lato\', Helvetica, Arial, sans-serif\n; font-size: 14px; color: #ffffff; line-height: 22px; font-weight: 400;" class="" width="100%" valign="middle"> <b>Didn\'t request a new password?</b> </br> If you didn\'t change your account password, <a style="color: #fff;" href="[[ADMIN_URL]]contact"> please let us know immediately</a>\n  </td>\n                      </tr>\n                      <tr>\n                        <td style="font-size: 1px; line-height: 1px;" width="100%" height="15">&nbsp;\n                          ;</td>\n                      </tr>\n                    </tbody></table></td>\n                </tr>\n              </tbody></table>\n            </div>\n          </td>\n        </tr>\n      </tbody></table>', 2, '2018-03-30 00:00:00', '2018-03-28 20:30:00'),
(4, 1, NULL, NULL, NULL, 'Activate Account', 'CMYROS', 'Please use this OTP to activate your account. Your OTP is [[OTP]]', 2, '2018-03-30 00:00:00', '2018-03-28 20:30:00'),
(5, 2, NULL, NULL, NULL, 'Customer Account Activate', 'Account Activated Successfully', '<table class="full" style="-webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius:\n 6px;" width="400" cellspacing="0" cellpadding="0" border="0" align="center">\n  <tbody>\n    <tr>\n      <td style="-webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; -webkit-box-shadow\n: 0px 0px 6px 0px rgba(0,0,0,0.75); -moz-box-shadow: 0px 0px 6px 0px rgba(0,0,0,0.75); box-shadow: 0px\n 0px 6px 0px rgba(0,0,0,0.10);" width="100%" bgcolor="#ffffff"><!-- SORTABLE -->\n        \n        <div class="sortable_inner ui-sortable"> \n          <!-- Start Top -->\n          <table class="mobile" style="-webkit-border-top-right-radius: 6px; -moz-border-top-right-radius\n: 6px; border-top-right-radius: 6px; -webkit-border-top-left-radius: 6px; -moz-border-top-left-radius\n: 6px; border-top-left-radius: 6px;" object="drag-module-small" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">\n            <tbody>\n              <tr>\n                <td class="fullCenter" width="100%" valign="middle" align="center"><table style="text-align: center; border-collapse:collapse; mso-table-lspace:0pt\n; mso-table-rspace:0pt;" class="fullCenter" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\n                    <tbody>\n                      <tr>\n                        <td style="font-size: 1px; line-height: 1px;" width="100%" height="20">&nbsp;</td>\n                      </tr>\n                      <tr>\n                        <td style="width:329px; height:auto;" class="fullCenter" width="100%"><p><img style="width: 329px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAUkAAAB+CAYAAACpguMJAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTQyIDc5LjE2MDkyNCwgMjAxNy8wNy8xMy0wMTowNjozOSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6ODdDREVFQTEzNzFBMTFFODlDQTJCQkYwNjE2NTQwMTIiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6ODdDREVFQTAzNzFBMTFFODlDQTJCQkYwNjE2NTQwMTIiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTUgKFdpbmRvd3MpIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6M0VBNjc0QTg2OUE1MTFFNzgzRkVEN0MyNjJDOUJFNzAiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6M0VBNjc0QTk2OUE1MTFFNzgzRkVEN0MyNjJDOUJFNzAiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz5rKXhfAAAlCElEQVR42ux9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" data-filename="approveCustomer.png"><br>\n                          </p></td>\n                      </tr>\n                      <tr>\n                        <td style="font-size: 1px; line-height: 1px;" width="100%" height="20">&nbsp;</td>\n                      </tr>\n                    </tbody>\n                  </table></td>\n              </tr>\n            </tbody>\n          </table>\n          <table class="mobile" object="drag-module-small" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">\n            <tbody>\n              <tr>\n                <td width="100%" valign="middle" align="center"><table style="text-align: center; border-collapse\n:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\n                    <tbody>\n                      <tr>\n                        <td style="text-align: center; font-family: \'Lato\', Helvetica, Arial, sans-serif\n; font-size: 20px; color: #353535; line-height: 33px; font-weight: 400;" class="fullCenter" width="100\n%" valign="middle"> Account Activated </td>\n                      </tr>\n                    </tbody>\n                  </table></td>\n              </tr>\n            </tbody>\n          </table>\n          <table class="mobile" object="drag-module-small" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">\n            <tbody>\n              <tr>\n                <td width="100%" valign="middle" align="center"><table style="text-align: center; border-collapse\n:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\n                    <tbody>\n                      <tr>\n                        <td style="font-size: 1px; line-height: 1px;" width="100%" height="25">&nbsp;</td>\n                      </tr>\n                    </tbody>\n                  </table></td>\n              </tr>\n            </tbody>\n          </table>\n          <table class="mobile" object="drag-module-small" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">\n            <tbody>\n              <tr>\n                <td width="100%" valign="middle" align="center"><table style="text-align: center; border-collapse\n:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\n                    <tbody>\n                      <tr>\n                        <td style="text-align: center; font-family: \'Lato\', Helvetica, Arial, sans-serif\n; font-size: 16px; color: #868585; line-height: 24px; font-weight: 400;" class="" width="100%" valign="middle"> Your account has been activated successfully. You may now login to the site using your [[USERNAME]]/[[EMAIL]]</td>\n                      </tr>\n                    </tbody>\n                  </table></td>\n              </tr>\n            </tbody>\n          </table>\n          <table class="mobile" object="drag-module-small" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">\n            <tbody>\n              <tr>\n                <td width="100%" valign="middle" align="center"><table style="text-align: center; border-collapse\n:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\n                    <tbody>\n                      <tr>\n                        <td style="font-size: 1px; line-height: 1px;" width="100%" height="30">&nbsp;</td>\n                      </tr>\n                    </tbody>\n                  </table></td>\n              </tr>\n            </tbody>\n          </table>\n          <table class="mobile" object="drag-module-small" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">\n            <tbody>\n              <tr>\n                <td width="100%" valign="middle" align="center"><table style="text-align: center; border-collapse\n:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\n                    <tbody>\n                      <tr>\n                        <td width="100%" align="center"><table class="buttonScale" cellspacing="0" cellpadding="0" border="0" align="center">\n                            <tbody>\n                              <tr>\n                                <td style="border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius\n: 5px; border-bottom-left-radius: 5px; padding-left: 30px; padding-right: 30px; font-family: \'Lato\',\n Helvetica, Arial, sans-serif; color: rgb(255, 255, 255); font-size: 16px; font-weight: 400; line-height\n: 1px; background-color: #353535;" bgcolor="#94da43" align="center" height="40"><a href="[[ADMIN_URL]]login" style="color: rgb(255, 255, 255); text-decoration: none; width\n: 100%;">Login Now !</a></td>\n                              </tr>\n                            </tbody>\n                          </table></td>\n                      </tr>\n                    </tbody>\n                  </table></td>\n              </tr>\n            </tbody>\n          </table>\n          <table class="mobile" object="drag-module-small" style="-webkit-border-bottom-right-radius\n: 6px; -moz-border-bottom-right-radius: 6px; border-bottom-right-radius: 6px; -webkit-border-bottom-left-radius\n: 6px; -moz-border-bottom-left-radius: 6px; border-bottom-left-radius: 6px;" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">\n            <tbody>\n              <tr>\n                <td width="100%" valign="middle" align="center"><table style="text-align: center; border-collapse\n:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\n                    <tbody>\n                      <tr>\n                        <td style="font-size: 1px; line-height: 1px;" width="100%" height="50">&nbsp;</td>\n                      </tr>\n                    </tbody>\n                  </table></td>\n              </tr>\n            </tbody>\n          </table>\n          <table class="mobile" object="drag-module-small" style="background-color: #00d4ff; -webkit-border-radius: 0px 0px\n  6px 6px; -moz-border-radius: 0px 0px  6px 6px; border-radius: 0px 0px  6px 6px;" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#00d4ff" align="center">\n            <tbody>\n              <tr>\n                <td style="-webkit-border-radius: 0px 0px  6px 6px; -moz-border-radius: 0px 0px  6px\n 6px; border-radius: 0px 0px  6px 6px;" width="100%" valign="middle" align="center"><table style="text-align\n: center; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\n                    <tbody>\n                      <tr> </tr>\n                      <tr>\n                        <td style="font-size: 1px; line-height: 1px;" width="100%" height="15">&nbsp;</td>\n                      </tr>\n                      <tr>\n                        <td style="text-align: center; font-family: \'Lato\', Helvetica, Arial, sans-serif\n; font-size: 14px; color: #ffffff; line-height: 22px; font-weight: 400;" class="" width="100%" valign="middle"> If you still do not able to login using your login credentials, you can <a style="color: #ffffff;" href="[[ADMIN_URL]]login#reset">reset</a> your password. </td>\n                      </tr>\n                      <tr>\n                        <td style="font-size: 1px; line-height: 1px;" width="100%" height="15">&nbsp;</td>\n                      </tr>\n                    </tbody>\n                  </table></td>\n              </tr>\n            </tbody>\n          </table>\n        </div></td>\n    </tr>\n  </tbody>\n</table>\n', 2, '2018-03-30 00:00:00', '2018-03-28 20:30:00'),
(6, 1, NULL, NULL, NULL, 'Customer Account Activate', 'CMYROS', 'Your account has been activated. User your email or username to login', 2, '2018-03-30 00:00:00', '2018-03-28 20:30:00');
INSERT INTO `admin_message_template` (`id`, `type`, `title`, `subject`, `message`, `default_title`, `default_subject`, `default_msg`, `isDeleted`, `created_on`, `modified_on`) VALUES
(7, 2, NULL, NULL, NULL, 'Customer Account Suspend', 'Account Suspended', '<table class="full" style="-webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius:\r\n 6px;" width="400" cellspacing="0" cellpadding="0" border="0" align="center">\r\n  <tbody>\r\n    <tr>\r\n      <td style="-webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; -webkit-box-shadow\r\n: 0px 0px 6px 0px rgba(0,0,0,0.75); -moz-box-shadow: 0px 0px 6px 0px rgba(0,0,0,0.75); box-shadow: 0px\r\n 0px 6px 0px rgba(0,0,0,0.10);" width="100%" bgcolor="#ffffff"><!-- SORTABLE -->\r\n        \r\n        <div class="sortable_inner ui-sortable"> \r\n          <!-- Start Top -->\r\n          <table class="mobile" style="-webkit-border-top-right-radius: 6px; -moz-border-top-right-radius\r\n: 6px; border-top-right-radius: 6px; -webkit-border-top-left-radius: 6px; -moz-border-top-left-radius\r\n: 6px; border-top-left-radius: 6px;" object="drag-module-small" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">\r\n            <tbody>\r\n              <tr>\r\n                <td class="fullCenter" width="100%" valign="middle" align="center">\r\n                  <table style="text-align: center; border-collapse:collapse; mso-table-lspace:0pt\r\n; mso-table-rspace:0pt;" class="fullCenter" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\r\n                    <tbody>\r\n                      <tr>\r\n                        <td style="font-size: 1px; line-height: 1px;" width="100%" height="20">&nbsp;</td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td style="width:329px; height:auto;" class="fullCenter" width="100%"><p><img style="width: 329px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAUkAAAB+CAYAAACpguMJAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTQyIDc5LjE2MDkyNCwgMjAxNy8wNy8xMy0wMTowNjozOSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6MDIxODM0QUEzNzFBMTFFOEJBNjM4NkRBMDMwRDc3MjUiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6MDIxODM0QTkzNzFBMTFFOEJBNjM4NkRBMDMwRDc3MjUiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTUgKFdpbmRvd3MpIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6M0VBNjc0QTg2OUE1MTFFNzgzRkVEN0MyNjJDOUJFNzAiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6M0VBNjc0QTk2OUE1MTFFNzgzRkVEN0MyNjJDOUJFNzAiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz50h8n2AAAlCUlEQVR42ux9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" data-filename="suspendCustomer.png"><br>\r\n                          </p></td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td style="font-size: 1px; line-height: 1px;" width="100%" height="20">&nbsp;</td>\r\n                      </tr>\r\n                    </tbody>\r\n                  </table></td>\r\n              </tr>\r\n            </tbody>\r\n          </table>\r\n          <table class="mobile" object="drag-module-small" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">\r\n            <tbody>\r\n              <tr>\r\n                <td width="100%" valign="middle" align="center"><table style="text-align: center; border-collapse\r\n:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\r\n                    <tbody>\r\n                      <tr>\r\n                        <td style="text-align: center; font-family: \'Lato\', Helvetica, Arial, sans-serif\r\n; font-size: 20px; color: #353535; line-height: 33px; font-weight: 400;" class="fullCenter" width="100\r\n%" valign="middle"> Account Suspended </td>\r\n                      </tr>\r\n                    </tbody>\r\n                  </table></td>\r\n              </tr>\r\n            </tbody>\r\n          </table>\r\n          <table class="mobile" object="drag-module-small" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">\r\n            <tbody>\r\n              <tr>\r\n                <td width="100%" valign="middle" align="center"><table style="text-align: center; border-collapse\r\n:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\r\n                    <tbody>\r\n                      <tr>\r\n                        <td style="font-size: 1px; line-height: 1px;" width="100%" height="25">&nbsp;</td>\r\n                      </tr>\r\n                    </tbody>\r\n                  </table></td>\r\n              </tr>\r\n            </tbody>\r\n          </table>\r\n          <table class="mobile" object="drag-module-small" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">\r\n            <tbody>\r\n              <tr>\r\n                <td width="100%" valign="middle" align="center"><table style="text-align: center; border-collapse\r\n:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\r\n                    <tbody>\r\n                      <tr>\r\n                        <td style="text-align: center; font-family: \'Lato\', Helvetica, Arial, sans-serif\r\n; font-size: 16px; color: #868585; line-height: 24px; font-weight: 400;" class="" width="100%" valign="middle"> Your account has been suspended temporarily for security reasons.</td>\r\n                      </tr>\r\n                    </tbody>\r\n                  </table></td>\r\n              </tr>\r\n            </tbody>\r\n          </table>\r\n          <table class="mobile" object="drag-module-small" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">\r\n            <tbody>\r\n              <tr>\r\n                <td width="100%" valign="middle" align="center"><table style="text-align: center; border-collapse\r\n:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\r\n                    <tbody>\r\n                      <tr>\r\n                        <td style="font-size: 1px; line-height: 1px;" width="100%" height="30">&nbsp;</td>\r\n                      </tr>\r\n                    </tbody>\r\n                  </table></td>\r\n              </tr>\r\n            </tbody>\r\n          </table>\r\n          <table class="mobile" object="drag-module-small" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">\r\n            <tbody>\r\n              <tr>\r\n                <td width="100%" valign="middle" align="center"><table style="text-align: center; border-collapse\r\n:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\r\n                    <tbody>\r\n                      <tr>\r\n                        <td width="100%" align="center"><table class="buttonScale" cellspacing="0" cellpadding="0" border="0" align="center">\r\n                            <tbody>\r\n                              <tr>\r\n                                <td style="border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius\r\n: 5px; border-bottom-left-radius: 5px; padding-left: 30px; padding-right: 30px; font-family: \'Lato\',\r\n Helvetica, Arial, sans-serif; color: rgb(255, 255, 255); font-size: 16px; font-weight: 400; line-height\r\n: 1px; background-color: #353535;" bgcolor="#94da43" align="center" height="40"><a href="[[ADMIN_URL]]contact" style="color: rgb(255, 255, 255); text-decoration: none; width\r\n: 100%;">Contact Us !</a></td>\r\n                              </tr>\r\n                            </tbody>\r\n                          </table></td>\r\n                      </tr>\r\n                    </tbody>\r\n                  </table></td>\r\n              </tr>\r\n            </tbody>\r\n          </table>\r\n          <table class="mobile" object="drag-module-small" style="-webkit-border-bottom-right-radius\r\n: 6px; -moz-border-bottom-right-radius: 6px; border-bottom-right-radius: 6px; -webkit-border-bottom-left-radius\r\n: 6px; -moz-border-bottom-left-radius: 6px; border-bottom-left-radius: 6px;" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">\r\n            <tbody>\r\n              <tr>\r\n                <td width="100%" valign="middle" align="center"><table style="text-align: center; border-collapse\r\n:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\r\n                    <tbody>\r\n                      <tr>\r\n                        <td style="font-size: 1px; line-height: 1px;" width="100%" height="50">&nbsp;</td>\r\n                      </tr>\r\n                    </tbody>\r\n                  </table></td>\r\n              </tr>\r\n            </tbody>\r\n          </table>\r\n          <table class="mobile" object="drag-module-small" style="background-color: #00d4ff; -webkit-border-radius: 0px 0px\r\n  6px 6px; -moz-border-radius: 0px 0px  6px 6px; border-radius: 0px 0px  6px 6px;" width="400" cellspacing="0" cellpadding="0" border="0" bgcolor="#00d4ff" align="center">\r\n            <tbody>\r\n              <tr>\r\n                <td style="-webkit-border-radius: 0px 0px  6px 6px; -moz-border-radius: 0px 0px  6px\r\n 6px; border-radius: 0px 0px  6px 6px;" width="100%" valign="middle" align="center"><table style="text-align\r\n: center; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="" width="300" cellspacing="0" cellpadding="0" border="0" align="center">\r\n                    <tbody>\r\n                      <tr> </tr>\r\n                      <tr>\r\n                        <td style="font-size: 1px; line-height: 1px;" width="100%" height="15">&nbsp;</td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td style="text-align: center; font-family: \'Lato\', Helvetica, Arial, sans-serif\r\n; font-size: 14px; color: #ffffff; line-height: 22px; font-weight: 400;" class="" width="100%" valign="middle"> If you think this is a mistake please <a style="color: #ffffff;" href="[[ADMIN_URL]]contact">contact</a> us to resolve this issue. </td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td style="font-size: 1px; line-height: 1px;" width="100%" height="15">&nbsp;</td>\r\n                      </tr>\r\n                    </tbody>\r\n                  </table></td>\r\n              </tr>\r\n            </tbody>\r\n          </table>\r\n        </div></td>\r\n    </tr>\r\n  </tbody>\r\n</table>\r\n', 2, '2018-03-30 00:00:00', '2018-03-28 20:30:00'),
(8, 1, NULL, NULL, NULL, 'Customer Account Suspend', 'CMYROS', 'Your account has been suspended. Please contact to our support team for further assistance.', 2, '2018-03-30 00:00:00', '2018-03-28 20:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `aid` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `role` tinyint(1) NOT NULL COMMENT '1: Super user; 2: Administrator; 3: Accountant',
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  `avtar` varchar(60) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Disabled; 1: Enabled; 2: Suspended;',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Deleted; 1: Active',
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`aid`, `username`, `role`, `fname`, `lname`, `email`, `phone`, `password`, `token`, `avtar`, `status`, `isDeleted`, `modified_date`, `created_date`) VALUES
(1, 'admin', 1, 'Sankhnad', 'Mishra', 'admin@gmail.com', '8800788992', '21232f297a57a5a743894a0e4a801fc3', '21232f297a57a5a743894a0e4a801fc3', '123c1e0a45c9d08442cec9f350f4e7f0.png', 1, 1, '2018-06-15 10:20:00', '2018-03-14 13:58:48'),
(2, 'sankhnad', 1, 'Sankhnad', 'Mishra', 'raj_mishra9933@yahoo.com', '8800788992', '21232f297a57a5a743894a0e4a801fc3', '05ed3de448e492381965c27f33c7b4ce', 'bb9048d5218d3c95e3f535cf0ff771e5.png', 1, 1, '2018-06-04 03:41:19', '2018-03-14 13:58:48');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `url_slug` varchar(500) DEFAULT NULL COMMENT 'Unice SEO freiendly URL',
  `image` varchar(255) DEFAULT NULL,
  `icon` varchar(200) DEFAULT NULL COMMENT 'Icon for menu header',
  `isTopBar` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: Hide on top Header; 1: Show on Top Header;',
  `isLeftBar` tinyint(1) NOT NULL DEFAULT '0' COMMENT ' 0: Hide on Left Catagaory List; 1: Show on Left Catagaory List;',
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Inactive; 1: Active;',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Deleted; 1: Active',
  `created_on` datetime NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `parent_id`, `name`, `url_slug`, `image`, `icon`, `isTopBar`, `isLeftBar`, `sort_order`, `meta_description`, `meta_keyword`, `description`, `status`, `isDeleted`, `created_on`, `modified_on`) VALUES
(1, 0, 'Combos', 'prabhkar', '46df469724aba07bb298d9b2e2abccd4.png', 'a86d85299d42cbd5f8d957bd3c789361.png', 1, 1, 1, 'This is meta tag description', 'oh Meta Keywords also', 'finally its descriptions', 1, 1, '2018-04-11 11:04:16', '2018-04-10 18:34:16'),
(2, 0, 'Gift', 'gift', 'e940ab55b1ff8897f03b9019df93b182.png', '80f206e8aeba112b8da271922eac2bc6.png', 0, 0, 4, 'meta tag wala', 'kyword wlal', 'desssss', 1, 1, '2018-04-11 11:05:01', '2018-04-10 18:35:01'),
(3, 0, 'PhotoCake', 'photocake', 'b34233362d414a4f6229ce20550f0ea7.png', NULL, 1, 0, 7, 'Meta tag', 'kyword', 'descrip', 1, 1, '2018-04-11 11:05:42', '2018-04-10 18:35:42'),
(10, 0, 'Personalised Gift', 'personalised-gift', '715bb517415041f60a0f9f1519b9e2b3.jpg', NULL, 0, 1, 9, 'Sankhnad', 'fsdf', 'sdf', 1, 1, '2018-04-11 13:33:27', '2018-04-10 21:03:27'),
(12, 0, 'Cakes', 'cakes', '14e5adff3ff2fb82fd491d99df45e378.jpg', '86246e751d31099809383b904d528d81.jpg', 0, 0, 0, 'Meta Tag Description ed', 'Meta Tag Keywords ed', 'Description ed', 1, 1, '2018-07-12 18:09:53', '2018-07-12 18:09:53'),
(14, 0, 'Flowers', 'flowers', 'edadbaa4be0f8232fdb33a7f92125c06.jpg', NULL, 1, 1, 0, 'zczXc', 'zxcZC', 'zxcZXc', 1, 1, '2018-07-12 18:37:13', '2018-07-12 18:37:13'),
(15, 0, 'Wedding Stuff', 'wedding-stuff', NULL, NULL, 0, 0, 0, '', '', '', 0, 1, '2018-09-20 18:55:59', '2018-09-20 18:55:59');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `cid` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `code` varchar(10) NOT NULL,
  `type` char(1) NOT NULL,
  `discount` decimal(10,0) NOT NULL,
  `total` decimal(15,4) NOT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `uses_total` int(11) NOT NULL,
  `uses_customer` varchar(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:Active;0:Inactive',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0:Dlete;1:Active',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`cid`, `name`, `code`, `type`, `discount`, `total`, `date_start`, `date_end`, `uses_total`, `uses_customer`, `status`, `isDeleted`, `created_on`) VALUES
(1, 'First', 'CouponOne', '1', '2', '200.0000', '2018-09-15', '2018-10-31', 23, '50', 1, 1, '2018-07-29 02:40:48'),
(2, 'Second', 'CouponTwo', '2', '200', '400.0000', '2018-09-15', '2018-09-15', 23, '23', 1, 1, '2018-07-29 02:50:30');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `mobile_otp` varchar(300) NOT NULL,
  `gender` enum('M','F') NOT NULL DEFAULT 'M' COMMENT 'M: Male; F: Female;',
  `avtar` varchar(60) DEFAULT NULL,
  `dob` date DEFAULT NULL COMMENT 'Date of Birth',
  `doa` date DEFAULT NULL COMMENT 'Date of Anniversary',
  `password` varchar(60) NOT NULL,
  `referral_code` varchar(300) DEFAULT NULL,
  `token` varchar(10) DEFAULT NULL,
  `isEmail_verified` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: Pending verification; 1: Verified;',
  `isSMS_verified` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: Pending verification; 1: Verified;',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Inactive; 1: Active;',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Deleted; 1: Active',
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `fname`, `lname`, `email`, `mobile`, `mobile_otp`, `gender`, `avtar`, `dob`, `doa`, `password`, `referral_code`, `token`, `isEmail_verified`, `isSMS_verified`, `status`, `isDeleted`, `modified_on`, `created_on`) VALUES
(2, 'Raja', 'Rawat', 'r123@gmail.com', '8800913456', '', 'F', 'f1fe1c8c52505e0fa1fcba61ecb77252.jpg', '2018-07-18', NULL, '', 'CRS71548', NULL, 0, 1, 1, 1, '2018-07-08 10:16:19', '2018-07-08 00:00:00'),
(3, 'Deepak', 'Kumar', 'deepak@gmail.,com', '9871123455', '', 'M', NULL, NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', 'CRS87458', NULL, 0, 0, 1, 1, '2018-08-14 18:17:01', '2018-08-14 18:17:01'),
(5, 'suraj', 'kumar', 'suraj123@gmail.com', '987112344', '', 'M', NULL, NULL, NULL, '827ccb0eea8a706c4c34a16891f84e7b', 'CRS65465', NULL, 0, 0, 1, 1, '2018-08-14 18:42:38', '2018-08-14 18:42:38'),
(7, 'ram', 'sharma', 'ramsharma111@gmail.com', '9871123455111111', '01324', 'M', NULL, NULL, NULL, 'e20f517179e9cd52ae29dae43c121b95', 'CRS90486', NULL, 0, 0, 1, 1, '2018-09-05 17:01:57', '2018-09-05 17:01:57'),
(14, 'jai', 'fdsfsadfsdf', 'jk1111@gmail.com', '9871145', '57573', 'M', NULL, NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', 'CRS07817', NULL, 0, 0, 1, 1, '2018-09-05 18:53:06', '2018-09-05 18:53:06'),
(22, 'Jai', 'Kaushik', 'admin', '9871145279', '56162', 'M', '412df1c59875256fe0696b3b8bc72be2.jpg', '1988-06-03', '2014-12-06', '21232f297a57a5a743894a0e4a801fc3', 'CRS00030', NULL, 0, 1, 1, 1, '2018-09-07 17:37:39', '2018-09-07 17:37:39');

-- --------------------------------------------------------

--
-- Table structure for table `customer_group`
--

CREATE TABLE `customer_group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `isDefault` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: False; 1: True',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Inactive; 1: Active',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Deleted: 1: Active',
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment` text,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_group`
--

INSERT INTO `customer_group` (`id`, `name`, `isDefault`, `status`, `isDeleted`, `modified_on`, `comment`, `created_on`) VALUES
(1, 'DFirst Group', 2, 1, 1, '2018-07-07 18:56:27', NULL, '2018-07-07 18:56:27'),
(2, 'second ed', 2, 1, 1, '2018-07-07 18:57:36', NULL, '2018-07-07 18:57:36'),
(3, 'asasa', 1, 1, 1, '2018-07-07 18:58:36', 'assasass', '2018-07-07 18:58:36'),
(4, 'asas', 2, 1, 1, '2018-07-07 19:00:46', 'asasas', '2018-07-07 19:00:46');

-- --------------------------------------------------------

--
-- Table structure for table `customer_group_member`
--

CREATE TABLE `customer_group_member` (
  `id` int(11) NOT NULL,
  `group_id` varchar(13) NOT NULL,
  `customer_id` varchar(10) NOT NULL,
  `member_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Active; 1:Inactive',
  `comment` text,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_group_member`
--

INSERT INTO `customer_group_member` (`id`, `group_id`, `customer_id`, `member_status`, `comment`, `modified_on`) VALUES
(10, '3', '1', 0, NULL, '2018-07-08 09:40:23'),
(12, '1', '1', 0, NULL, '2018-07-22 03:54:19'),
(23, '1', '2', 1, NULL, '2018-07-22 11:45:13'),
(24, '3', '2', 1, NULL, '2018-07-22 11:45:13'),
(25, '4', '2', 1, NULL, '2018-07-22 11:45:13');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_option`
--

CREATE TABLE `delivery_option` (
  `option_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` float NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Active, 1: Deactive',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Deleted; 1: Active',
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_option`
--

INSERT INTO `delivery_option` (`option_id`, `name`, `price`, `status`, `isDeleted`, `created_on`) VALUES
(1, 'Standard Delivery', 0, 1, 1, '2018-09-16 07:47:10'),
(2, 'Early Morning Delivery', 150, 1, 1, '2018-09-16 07:47:38'),
(3, 'Midnight Delivery', 150, 1, 1, '2018-09-16 07:48:19'),
(4, 'Express Delivery', 100, 1, 1, '2018-09-16 07:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_option_slot`
--

CREATE TABLE `delivery_option_slot` (
  `id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL COMMENT 'primary key of delivery_option table',
  `slot_id` int(11) NOT NULL COMMENT 'Primary Key of time_slot table'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_option_slot`
--

INSERT INTO `delivery_option_slot` (`id`, `option_id`, `slot_id`) VALUES
(25, 1, 3),
(26, 1, 4),
(27, 1, 5),
(28, 1, 6),
(29, 1, 7),
(30, 1, 8),
(31, 2, 2),
(32, 3, 10),
(33, 4, 9);

-- --------------------------------------------------------

--
-- Table structure for table `globals`
--

CREATE TABLE `globals` (
  `id` int(11) NOT NULL,
  `logo` varchar(150) DEFAULT NULL COMMENT 'site logo',
  `site_name` varchar(100) DEFAULT NULL COMMENT 'website name; title of the home page',
  `address` varchar(500) DEFAULT NULL COMMENT 'if address',
  `phone` varchar(20) NOT NULL,
  `send_email` varchar(150) DEFAULT NULL COMMENT 'Email will send to users using this mail id',
  `send_email_name` varchar(150) DEFAULT NULL COMMENT 'Label name on email for from email',
  `receive_email` varchar(150) DEFAULT NULL COMMENT 'if anyone will contact you then this email id will be used to receive emails'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `location_area`
--

CREATE TABLE `location_area` (
  `aid` int(11) NOT NULL,
  `pin` varchar(300) NOT NULL COMMENT 'PIN Code',
  `areaName` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Deactive; 1: Active;',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Deleted; 1: Active',
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location_area`
--

INSERT INTO `location_area` (`aid`, `pin`, `areaName`, `status`, `isDeleted`, `created_on`) VALUES
(1, '734005', 'Ashok Nagar', 1, 1, '2018-07-04 00:00:00'),
(2, '110095', 'Dilshad Garden', 1, 1, '2018-07-04 00:00:00'),
(3, '0', 'ar1', 1, 0, '2018-07-31 17:56:24'),
(4, '0', 'a2', 1, 0, '2018-07-31 17:56:24'),
(5, '734005', 'sasa', 1, 0, '2018-07-31 18:00:35'),
(6, '734005', 'sasa2', 1, 0, '2018-07-31 18:00:35'),
(7, '220021', 'jk', 1, 1, '2018-08-02 15:08:46'),
(8, '220021', 'jk2 ed', 1, 1, '2018-08-02 15:08:46'),
(9, '220021', 'jk3', 1, 1, '2018-08-02 15:08:46'),
(10, '110098', 'sa', 1, 1, '2018-08-02 18:24:27'),
(11, '110067', 'qw', 1, 1, '2018-08-03 19:05:01'),
(12, '110067', 'qw12', 1, 1, '2018-08-03 19:05:01');

-- --------------------------------------------------------

--
-- Table structure for table `location_city`
--

CREATE TABLE `location_city` (
  `cid` int(11) NOT NULL,
  `sid` int(11) NOT NULL COMMENT 'foren key of location_state',
  `cityName` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Active, 1: Deactive',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Deleted; 1: Active',
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location_city`
--

INSERT INTO `location_city` (`cid`, `sid`, `cityName`, `status`, `isDeleted`, `created_on`) VALUES
(1, 1, 'New Delhi', 1, 1, '2018-07-03 18:15:11'),
(2, 1, 'Noida', 1, 1, '2018-07-03 18:15:11'),
(3, 2, 'Gurugram', 1, 1, '2018-07-03 18:15:51'),
(4, 2, 'Ghaziabad', 1, 1, '2018-07-03 18:15:51');

-- --------------------------------------------------------

--
-- Table structure for table `location_pin`
--

CREATE TABLE `location_pin` (
  `pid` int(11) NOT NULL,
  `cid` int(11) NOT NULL COMMENT 'Foren key of location_city',
  `pin` int(10) NOT NULL COMMENT 'PIN Code',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Deactive; 1: Active;',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Deleted; 1: Active',
  `created_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location_pin`
--

INSERT INTO `location_pin` (`pid`, `cid`, `pin`, `status`, `isDeleted`, `created_on`) VALUES
(1, 2, 734005, 1, 1, '2018-07-03 18:42:44'),
(2, 2, 734006, 0, 1, '2018-07-03 18:42:44'),
(3, 4, 110095, 0, 0, '2018-07-03 18:43:17'),
(4, 3, 220021, 1, 0, '2018-07-03 18:43:17'),
(5, 2, 110094, 0, 1, '2018-07-29 20:35:52'),
(6, 4, 110067, 1, 1, '2018-07-29 20:36:51'),
(7, 1, 110098, 1, 1, '2018-07-31 17:33:21'),
(8, 1, 110099, 1, 1, '2018-07-31 17:33:21'),
(9, 1, 110097, 1, 1, '2018-07-31 17:33:21'),
(10, 1, 110088, 1, 1, '2018-07-31 17:33:43');

-- --------------------------------------------------------

--
-- Table structure for table `location_state`
--

CREATE TABLE `location_state` (
  `sid` int(11) NOT NULL,
  `stateName` varchar(200) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Deleted; 1: Active',
  `created_on` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Inactive; 1: Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location_state`
--

INSERT INTO `location_state` (`sid`, `stateName`, `isDeleted`, `created_on`, `status`) VALUES
(1, 'West Bengal ed', 1, '2018-07-03 00:00:00', 1),
(2, 'Delhi22', 1, '2018-07-02 00:00:00', 1),
(3, 'eee', 0, '0000-00-00 00:00:00', 1),
(4, 'eee', 0, '2018-07-04 14:37:01', 0),
(5, 'rrr', 1, '2018-07-05 18:07:18', 1),
(6, 'f', 0, '2018-07-05 18:08:32', 1),
(7, 'test one', 0, '2018-07-29 10:20:03', 1),
(8, 'sasa ed', 1, '2018-07-31 15:20:58', 1),
(9, 'asas', 1, '2018-07-31 15:20:58', 1),
(10, 'asasa', 1, '2018-07-31 15:20:58', 1),
(11, 'jk1', 1, '2018-08-03 19:04:27', 1),
(12, 'jk2', 1, '2018-08-03 19:04:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `management_fees`
--

CREATE TABLE `management_fees` (
  `id` int(11) NOT NULL,
  `label_name` varchar(100) NOT NULL,
  `rate` double NOT NULL,
  `type` char(1) NOT NULL DEFAULT 'F' COMMENT 'F: Flat Rate; P: Percentage',
  `created_date` datetime NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `management_fees`
--

INSERT INTO `management_fees` (`id`, `label_name`, `rate`, `type`, `created_date`, `modified_date`) VALUES
(1, 'Sankhnad', 22, 'F', '2018-06-27 10:02:55', '2018-06-27 09:15:59'),
(2, 'w', 2, 'F', '2018-06-27 00:00:00', '2018-06-27 09:52:34'),
(3, 'h', 4, 'F', '2018-06-27 00:00:00', '2018-06-27 09:52:51'),
(4, 'ee', 4, 'P', '2018-06-27 10:07:13', '2018-06-27 10:07:13'),
(5, 'ttt', 22, 'P', '2018-07-02 09:14:23', '2018-07-02 09:14:23');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `invoice_no` varchar(100) DEFAULT NULL,
  `transaction_id` varchar(100) DEFAULT NULL,
  `payment_mode` tinyint(2) DEFAULT NULL COMMENT '1:COD;2:Online',
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `address` text NOT NULL,
  `shipping_address` text,
  `shipping_pin_code` varchar(60) DEFAULT NULL,
  `shipping_number` varchar(60) DEFAULT NULL,
  `pin_code` varchar(60) DEFAULT NULL,
  `phone_number` varchar(50) NOT NULL,
  `coupon` varchar(100) DEFAULT NULL,
  `coupon_price` varchar(10) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `delivery_option` varchar(60) DEFAULT NULL,
  `delivery_time` varchar(60) DEFAULT NULL,
  `delivery_price` float DEFAULT NULL,
  `reward_balance` float DEFAULT NULL,
  `status_type` tinyint(4) NOT NULL DEFAULT '2' COMMENT '0:Cancled by customer; 1:Delivered; 2:Pending; 3:Dispatched; 4:Rejected by Shop;5:Failed;6:Order Placed',
  `is_Deleted` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0:False;1:True',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `invoice_no`, `transaction_id`, `payment_mode`, `customer_id`, `address`, `shipping_address`, `shipping_pin_code`, `shipping_number`, `pin_code`, `phone_number`, `coupon`, `coupon_price`, `delivery_date`, `delivery_option`, `delivery_time`, `delivery_price`, `reward_balance`, `status_type`, `is_Deleted`, `created_on`) VALUES
(1, 'INV73061', NULL, 2, 22, 'Raj Mishra ed,jai123@gmail.com,D-15/44,Ganga Vihar, Delhi,Delhi,jk2,Near Ganga Public School', 'Jai Kaushik, jaikaushik2012@gmail.com, D-15/4, Ganga Vihar, Delhi, Delhi, Delhi22, Near Ganga Public School', '110094', '9871145277', '110056', '9871123454', '', '', '2018-09-21', 'Midnight Delivery', '10:00 PM - 11:00 PM', 150, 0, 2, 1, '2018-09-20 17:45:31'),
(2, 'INV31740', NULL, 2, 22, 'Raj Mishra ed,jaikaushik2012@gmail.com,D-15/44,Ganga Vihar, Delhi,Delhi,jk2,Near Ganga Public School', 'Jai Kaushik, jaikaushik2012@gmail.com, D-15/4, Ganga Vihar, Delhi, Delhi, Delhi22, Near Ganga Public School', '110094', '9871145277', '110056', '9871123454', 'CouponOne', '16', '2018-09-21', 'Midnight Delivery', '10:00 PM - 11:00 PM', 150, 0, 2, 1, '2018-09-20 17:50:31');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `session_id` varchar(30) NOT NULL COMMENT 'current session ID',
  `oid` int(11) DEFAULT NULL COMMENT 'foreign kye of orders',
  `cid` int(11) DEFAULT NULL COMMENT 'Customer ID',
  `pid` int(11) NOT NULL COMMENT 'Product ID',
  `pin_code` mediumint(9) NOT NULL,
  `is_eggless` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: False; 1: True',
  `price_id` int(11) NOT NULL COMMENT 'foreign key of product_price',
  `actual_price` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `total_price` float DEFAULT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `cake_message` varchar(50) DEFAULT NULL,
  `quantity` tinyint(4) NOT NULL,
  `is_in_cart` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: Product is in Cart; 0: Product has been moved to order',
  `created_on` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `session_id`, `oid`, `cid`, `pid`, `pin_code`, `is_eggless`, `price_id`, `actual_price`, `discount`, `total_price`, `unit`, `cake_message`, `quantity`, `is_in_cart`, `created_on`) VALUES
(4, '7ZYJYTVMR74P51S', 1, 22, 13, 110094, 1, 64, 700, 250, 450, '1', '', 1, 0, '2018-09-20 10:12:01'),
(5, '7ZYJYTVMR74P51S', 2, 22, 13, 110094, 1, 65, 1000, 20, 800, '1', '', 1, 0, '2018-09-20 12:19:02');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `url_slug` varchar(500) DEFAULT NULL,
  `tags` text,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: Active; 0: Inactive',
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `sku_code` varchar(500) DEFAULT NULL,
  `date_available` date DEFAULT NULL,
  `sort_number` int(11) DEFAULT NULL,
  `isEggless` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0:Inactive; 1:Active',
  `meta_title` varchar(266) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `delivery_description` text,
  `refund_description` text,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Deleted; 1 Active',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `url_slug`, `tags`, `status`, `description`, `image`, `sku_code`, `date_available`, `sort_number`, `isEggless`, `meta_title`, `meta_keyword`, `meta_description`, `delivery_description`, `refund_description`, `isDeleted`, `created_on`, `modified_on`) VALUES
(1, 'cake1222', 'cake1222', NULL, 1, '<p>sasdsdsdssdsdsdsd<br></p>', NULL, '32', '2018-08-27', 4, 1, NULL, NULL, NULL, NULL, NULL, 1, '2018-07-05 18:41:16', '2018-08-06 00:11:16'),
(2, 'cake edit', 'cake-edit', NULL, 1, '<p>sasasa<br></p>', '05585257cad21f07a384ccf711709337.jpg', 'sku ed', '2018-08-10', 44, 0, NULL, NULL, NULL, NULL, NULL, 1, '2018-08-05 18:50:55', '2018-08-06 00:20:55'),
(3, 'jk pp', 'jk-pp', NULL, 1, '<p>sdsdsdsdsdsd<br></p>', '07f4b7d876f4fc0bfec027a540106fb0.jpg', 'sku11', '2018-09-03', 2, 0, 'Meta Tag Title', 'Meta Tag Keywords', 'Meta Tag Description', '<p> Delivery DeliveryDeliveryDeliveryDeliveryDeliveryDeliveryDeliveryDeliveryDeliveryDeliveryDeliveryDelivery</p>', '<p>RefundRefundRefundRefundRefundRefundRefundRefundRefundRefundRefundRefundRefundRefundRefundRefundRefundRefundRefund</p>', 1, '2018-04-05 19:42:19', '2018-08-06 01:12:19'),
(4, 'test product', 'test-product', NULL, 1, '<p>sasasasas<br></p>', NULL, '32', '2018-08-28', 3, 1, '', '', '', '', '', 1, '2018-08-08 01:22:35', '2018-08-08 06:52:35'),
(5, 'cake New Wala', 'cake-new-wala', NULL, 1, '<p>ddsdsds</p><p>d</p><p>sd</p><p>sd</p><p>sd</p><p><br></p>', 'bc4979b1ef650103c9934977932af2a3.jpg', '32', '2018-08-21', 4, 1, '', '', '', '', '', 1, '2018-08-12 04:18:13', '2018-08-12 09:48:13'),
(6, 'cake New Wala qq', 'cake-new-wala-qq', NULL, 1, '<p>ddsdsds</p><p>d</p><p>sd</p><p>sd</p><p>sd</p><p><br></p>', '853ffa2917384cc3f7d305ba255d3460.jpg', '32', '2018-08-21', 4, 1, 'sdsds', 'sdsd', 'sddsd', 's<p>dsdsdsdsd<br></p>', '<p>sdsdsdsd</p><p>sd</p><p>sd</p><p>s</p><p>d<br></p>', 1, '2018-06-12 04:21:47', '2018-08-12 09:51:47'),
(7, 'cake New Wala qq jhjhjhjh mhjhjh', 'cake-new-wala-qq-jhjhjhjh-mhjhjh', NULL, 1, '<p>ddsdsds</p><p>d</p><p>sd</p><p>sd</p><p>sd</p><p><br></p>', '1b2935dae7034d46b0a5af700dbc62c8.jpg', '32', '2018-08-21', 4, 1, 'sdsds', 'sdsd', 'sddsd', 's<p>dsdsdsdsd<br></p>', '<p>sdsdsdsd</p><p>sd</p><p>sd</p><p>s</p><p>d<br></p>', 1, '2018-06-12 04:22:42', '2018-08-12 09:52:42'),
(8, 'ggg', 'ggg', NULL, 1, '<p>ddsdsds</p><p>d</p><p>sd</p><p>sd</p><p>sd</p><p><br></p>', '5eed620f2f017d2bb388070cb43ab7c4.jpg', '32', '2018-08-21', 4, 1, 'sdsds', 'sdsd', 'sddsd', 's<p>dsdsdsdsd<br></p>', '<p>sdsdsdsd</p><p>sd</p><p>sd</p><p>s</p><p>d<br></p>', 1, '2018-08-12 04:23:36', '2018-08-12 09:53:36'),
(9, 'Choko Cake', 'choko-cake', NULL, 1, '<p>sdsdsds</p><p>d</p><p>sd</p><p>sd</p><p>s</p><p>d</p><p>s<br></p>', 'b5c6d90c0783ed75717caa4cadf131ff.jpg', '32', '2018-08-21', 4, 1, 'sdsdsdsds', 'sdsd', 'sddsd', '<p>dsdsds<br></p>', '<p>sdsdsdsd<br></p>', 1, '2018-08-12 04:38:26', '2018-08-12 10:08:26'),
(10, 'Fruit Cake', 'fruit-cake', NULL, 1, 'Fruit Cake<br>', '1a925937e0d5c8d58c944f89f697ce14.jpg', 'Fruit', '2018-08-22', 3, 1, 'Meta Tag Title', 'Meta Tag Keywords', 'Meta Tag Description Meta Tag Description Meta Tag Description', '', '', 1, '2018-08-12 06:31:27', '2018-08-12 12:01:27'),
(11, 'Cake One', 'cake-one', NULL, 1, '<p>sasasasasas<br></p>', '8b637f24f550dfb31fdb709d3e700df3.jpg', 'qw11', '2018-08-23', 2, 1, 'Meta Tag Title', 'Meta Tag Keywords', 'Meta Tag Description', '<p>DeliveryDeliveryDeliverysdsdsdsds</p>', '<p>kjhjhjh<br></p>', 1, '2018-08-12 07:09:46', '2018-08-12 12:39:46'),
(12, 'Cake Triangle', 'cake-triangle', NULL, 1, '<p>sasasasasas<br></p>', '3f32b8f5f4e6751b60812f8bdeedb834.jpg', 'qw11', '2018-08-23', 2, 1, 'Meta Tag Title', 'Meta Tag Keywords', 'Meta Tag Description', '<p>DeliveryDeliveryDeliverysdsdsdsds</p>', '<p>kjhjhjh<br></p>', 1, '2018-08-12 07:11:37', '2018-08-12 12:41:37'),
(13, 'Fruit Cake New', 'fruit-cake-new', NULL, 1, '<p>sasasa<br></p><div class="tab-pane fade active in" id="product_tabs_custom">\r\n                                                <div class="product-tabs-content-inner clearfix">\r\n                                                    <p><strong>Lorem Ipsum</strong><span> is\r\n                                                        simply dummy text of the printing and typesetting industry. Lorem Ipsum\r\n                                                        has been the industry\'s standard dummy text ever since the 1500s, when \r\n                                                        an unknown printer took a galley of type and scrambled it to make a type\r\n                                                        specimen book. It has survived not only five centuries, but also the \r\n                                                        leap into electronic typesetting, remaining essentially unchanged. It \r\n                                                        was popularised in the 1960s with the release of Letraset sheets \r\n                                                        containing Lorem Ipsum passages, and more recently with desktop \r\n                                                        publishing software like Aldus PageMaker including versions of Lorem \r\n                                                        Ipsum.</span>\r\n                                                    </p>\r\n                                                </div>\r\n                                            </div>', '7f4486a4cf5b7a538fef335d623a31b7.jpg', 'fff1222', '2018-08-28', 4, 1, 'asasasa', '', '', '<div class="tab-pane fade active in" id="product_tabs_custom">\r\n                                                <div class="product-tabs-content-inner clearfix">\r\n                                                    <p><strong>Lorem Ipsum</strong><span> is\r\n                                                        simply dummy text of the printing and typesetting industry. Lorem Ipsum\r\n                                                        has been the industry\'s standard dummy text ever since the 1500s, when \r\n                                                        an unknown printer took a galley of type and scrambled it to make a type\r\n                                                        specimen book. It has survived not only five centuries, but also the \r\n                                                        leap into electronic typesetting, remaining essentially unchanged. It \r\n                                                        was popularised in the 1960s with the release of Letraset sheets \r\n                                                        containing Lorem Ipsum passages, and more recently with desktop \r\n                                                        publishing software like Aldus PageMaker including versions of Lorem \r\n                                                        Ipsum.</span>\r\n                                                    </p>\r\n                                                </div>\r\n                                            </div>', '<div class="tab-pane fade active in" id="product_tabs_custom">\r\n                                                <div class="product-tabs-content-inner clearfix">\r\n                                                    <p><strong>Lorem Ipsum</strong><span> is\r\n                                                        simply dummy text of the printing and typesetting industry. Lorem Ipsum\r\n                                                        has been the industry\'s standard dummy text ever since the 1500s, when \r\n                                                        an unknown printer took a galley of type and scrambled it to make a type\r\n                                                        specimen book. It has survived not only five centuries, but also the \r\n                                                        leap into electronic typesetting, remaining essentially unchanged. It \r\n                                                        was popularised in the 1960s with the release of Letraset sheets \r\n                                                        containing Lorem Ipsum passages, and more recently with desktop \r\n                                                        publishing software like Aldus PageMaker including versions of Lorem \r\n                                                        Ipsum.</span>\r\n                                                    </p>\r\n                                                </div>\r\n                                            </div>', 1, '2018-08-29 23:30:46', '2018-08-30 05:00:46');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`) VALUES
(7, 13, 'd8c7b9d20123bbe494aca33279d7ee7c.jpg'),
(2, 5, '69c22e1094fb17ddc125829919cce76e.jpg'),
(3, 5, 'd4dc56d315b9f434b3d43213bdecf4c2.jpg'),
(4, 5, '52e304763355cf0c64b3a98bb5731787.jpg'),
(8, 13, '1b93cf18582490a3f993e8d0b4a51e3c.jpg'),
(9, 13, '2d52172fb3f5b7cc4337a43f5cecb45f.jpg'),
(10, 13, 'cead6483f34e828250efa8ec53c56367.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_price`
--

CREATE TABLE `product_price` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity_type` varchar(15) DEFAULT NULL,
  `quantity` varchar(15) DEFAULT NULL,
  `product_price` float(10,2) DEFAULT NULL,
  `discount_type` varchar(15) DEFAULT NULL,
  `discount` varchar(15) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_price`
--

INSERT INTO `product_price` (`id`, `product_id`, `quantity_type`, `quantity`, `product_price`, `discount_type`, `discount`) VALUES
(1, 400, 'kg', '2', 400.00, '0', '400.00'),
(2, 300, 'kg', '1', 300.00, '0', '500.00'),
(3, 10, 'gm', '500', 800.00, '0', '100.00'),
(4, 10, 'kg', '1', 2000.00, '0', '10.00'),
(9, 6, 'gm', '2', 3.00, 'F', '1.00'),
(66, 13, 'kg', '1', 1500.00, 'F', '50.00'),
(65, 13, 'gm', '500', 1000.00, 'P', '20.00'),
(64, 13, 'gm', '250', 700.00, 'F', '250.00');

-- --------------------------------------------------------

--
-- Table structure for table `product_to_category`
--

CREATE TABLE `product_to_category` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_to_category`
--

INSERT INTO `product_to_category` (`id`, `product_id`, `category_id`) VALUES
(19, 3, 4),
(17, 2, 11),
(16, 2, 6),
(15, 2, 1),
(14, 2, 14),
(13, 2, 12),
(20, 4, 14),
(21, 4, 1),
(55, 5, 4),
(54, 5, 14),
(44, 6, 4),
(43, 6, 14),
(26, 7, 14),
(27, 7, 4),
(28, 8, 14),
(29, 8, 4),
(30, 9, 12),
(31, 9, 2),
(32, 9, 4),
(33, 10, 10),
(34, 10, 4),
(40, 12, 4),
(39, 12, 10),
(38, 12, 12),
(94, 13, 2),
(93, 13, 1),
(92, 13, 12);

-- --------------------------------------------------------

--
-- Table structure for table `product_to_delivary_option`
--

CREATE TABLE `product_to_delivary_option` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `delivery_option_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_to_delivary_option`
--

INSERT INTO `product_to_delivary_option` (`id`, `product_id`, `delivery_option_id`) VALUES
(38, 12, 0),
(39, 12, 0),
(43, 6, 2),
(42, 6, 1),
(85, 13, 3),
(84, 13, 2),
(83, 13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_to_related`
--

CREATE TABLE `product_to_related` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_related_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_to_related`
--

INSERT INTO `product_to_related` (`id`, `product_id`, `product_related_id`) VALUES
(4, 12, 10),
(3, 12, 9),
(60, 13, 4),
(59, 13, 3),
(58, 13, 2),
(57, 13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_to_type`
--

CREATE TABLE `product_to_type` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_to_type`
--

INSERT INTO `product_to_type` (`id`, `product_id`, `type_id`) VALUES
(7, 3, 17),
(5, 2, 17),
(8, 4, 16),
(41, 5, 17),
(40, 5, 16),
(32, 6, 17),
(31, 6, 16),
(13, 7, 16),
(14, 7, 17),
(15, 8, 16),
(16, 8, 17),
(17, 9, 16),
(18, 9, 17),
(19, 10, 16),
(20, 10, 17),
(21, 11, 16),
(22, 11, 17),
(28, 12, 17),
(27, 12, 16),
(54, 13, 17);

-- --------------------------------------------------------

--
-- Table structure for table `referals`
--

CREATE TABLE `referals` (
  `id` int(11) NOT NULL,
  `ref_cid` int(11) NOT NULL,
  `used_by_cid` int(11) DEFAULT NULL COMMENT 'Foren Key of Order ID or Foren Key of Customer ID who have used this',
  `amount` float NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0: Debit; 1: Credit',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `referals`
--

INSERT INTO `referals` (`id`, `ref_cid`, `used_by_cid`, `amount`, `status`, `created_on`) VALUES
(1, 5, 16, 20, 1, '2018-09-06 10:24:20'),
(2, 3, 17, 20, 1, '2018-09-06 10:29:38'),
(3, 14, 18, 20, 1, '2018-09-06 10:32:30'),
(4, 5, 19, 20, 1, '2018-09-06 11:51:31'),
(5, 22, 1, 0, 0, '2018-09-20 17:45:31'),
(6, 22, 2, 0, 0, '2018-09-20 17:50:31');

-- --------------------------------------------------------

--
-- Table structure for table `time_slot`
--

CREATE TABLE `time_slot` (
  `tid` int(11) NOT NULL,
  `slot` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_slot`
--

INSERT INTO `time_slot` (`tid`, `slot`) VALUES
(1, '06:00 AM - 08:00 AM'),
(2, '08:00 AM - 10:00 AM'),
(3, '10:00 AM - 12:00 PM'),
(4, '12:00 PM - 02:00 PM'),
(5, '02:00 PM - 04:00 PM'),
(6, '04:00 PM - 06:00 PM'),
(7, '06:00 PM - 08:00 PM'),
(8, '08:00 PM - 10:00 PM'),
(9, '10:00 PM - 11:00 PM'),
(10, '11:00 PM - 12:00 AM'),
(11, '12:00 AM - 01:00 AM'),
(12, '01:00 AM - 02:00 AM'),
(13, '02:00 AM - 03:00 AM'),
(14, '03:00 AM - 04:00 AM'),
(15, '04:00 AM - 05:00 AM'),
(16, '05:00 AM - 06:00 AM');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_fees`
--

CREATE TABLE `transaction_fees` (
  `id` int(11) NOT NULL,
  `rate` double NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Inactive; 1: Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_fees`
--

INSERT INTO `transaction_fees` (`id`, `rate`, `created_date`, `status`) VALUES
(1, 10, '2018-06-27 08:03:22', 0),
(2, 5, '2018-06-27 08:04:03', 0),
(3, 99, '2018-06-27 08:23:10', 0),
(4, 1, '2018-06-27 08:23:20', 0),
(5, 4, '2018-07-02 09:17:38', 0),
(6, 9, '2018-07-02 11:52:25', 0),
(7, 10, '2018-07-02 11:54:20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `type_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url_slug` varchar(500) DEFAULT NULL COMMENT 'Unice SEO freiendly URL',
  `image` varchar(255) DEFAULT NULL,
  `icon` varchar(200) DEFAULT NULL COMMENT 'Icon for menu header',
  `isTopBar` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: Hide on top Header; 1: Show on Top Header;',
  `isLeftBar` tinyint(1) NOT NULL DEFAULT '0' COMMENT ' 0: Hide on Left Catagaory List; 1: Show on Left Catagaory List;',
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `mobile_display` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Disabled; 1: Enabled;',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Inactive; 1: Active;',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Deleted; 1: Active',
  `created_on` datetime NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_id`, `name`, `url_slug`, `image`, `icon`, `isTopBar`, `isLeftBar`, `sort_order`, `meta_description`, `meta_keyword`, `description`, `mobile_display`, `status`, `isDeleted`, `created_on`, `modified_on`) VALUES
(16, 'Latest Flowers', 'latest-flowers', '5c67397bbf456f46dabdc4aa8539a984.jpg', '92db2b5c0f8556910c63cc53ef7879e5.jpg', 0, 0, 2, 'sdfsadfsdf edit', 'sa edit', 'fsdafsadfsdaf edit', 0, 1, 1, '2018-07-28 14:01:06', '2018-07-28 14:01:06'),
(17, 'Popular Cakes', 'popular-cakes', NULL, NULL, 0, 0, 1, '', '', '', 1, 1, 1, '2018-07-28 14:26:30', '2018-07-28 14:26:30'),
(18, 'Recent Gift', 'recent-gift', NULL, NULL, 0, 0, 3, '', '', '', 1, 0, 1, '2018-08-14 21:22:05', '2018-08-14 21:22:05'),
(19, 'Corporate Gift', 'corporate-gift', NULL, NULL, 0, 0, 4, '', '', '', 1, 0, 1, '2018-08-14 21:22:34', '2018-08-14 21:22:34'),
(20, 'Extra Benifits', 'extra-benifits', NULL, NULL, 0, 0, 5, '', '', '', 1, 0, 1, '2018-08-14 21:23:35', '2018-08-14 21:23:35');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vid` int(11) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` int(11) NOT NULL,
  `avtar` varchar(60) NOT NULL,
  `store_name` varchar(100) NOT NULL,
  `isEmail_verified` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1: Verified; 0: Pending verification',
  `isSMS_verified` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: Verified; 0: Pending verification ',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: Active; 0: Inactive ',
  `comment` text,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: Deleted; 1: Active',
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vid`, `fname`, `lname`, `email`, `mobile`, `avtar`, `store_name`, `isEmail_verified`, `isSMS_verified`, `status`, `comment`, `isDeleted`, `modified_on`, `created_on`) VALUES
(7, 'Jaied', 'Kaushied', 'jaikaushiked2012@gmail.com', 2147483647, 'ad44cf757b837e65cebf8fea425eb213.jpg', 'Cake Walaed', 1, 1, 0, NULL, 1, '2018-07-11 03:32:04', '2018-07-11 08:01:38'),
(9, 'Ankit', 'Chawla', 'ankit.chawla96@gmail.com', 2147483647, '16391ce1b4e8a84ee81f66e5ca8c54df.jpg', 'CakeAnyTime', 1, 1, 1, NULL, 1, '2018-08-13 12:59:05', '2018-08-13 12:59:05'),
(10, 'Ankit', 'Chawla', 'ankit.chawla96@gmail.com', 2147483647, 'cfd8b19716b8c7826ae89e55130b212c.jpg', 'CakeAnyTime', 1, 1, 1, NULL, 1, '2018-08-13 12:59:16', '2018-08-13 12:59:16');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_location`
--

CREATE TABLE `vendor_location` (
  `vendor_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `type_id` tinyint(1) NOT NULL COMMENT '1:Area, 2: Pincode'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor_location`
--

INSERT INTO `vendor_location` (`vendor_id`, `location_id`, `type_id`) VALUES
(8, 1, 2),
(7, 1, 2),
(10, 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wish_list`
--

CREATE TABLE `wish_list` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wish_list`
--

INSERT INTO `wish_list` (`id`, `pid`, `cid`, `created_on`) VALUES
(4, 13, 22, '2018-09-08 18:26:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`aid`),
  ADD KEY `fld_uid` (`cid`);

--
-- Indexes for table `admin_audittrail`
--
ALTER TABLE `admin_audittrail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`),
  ADD KEY `ip` (`ip`),
  ADD KEY `action` (`action`),
  ADD KEY `data` (`data`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `admin_contact_us`
--
ALTER TABLE `admin_contact_us`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `phone` (`phone`),
  ADD KEY `isDeleted` (`isDeleted`),
  ADD KEY `isRead` (`isRead`),
  ADD KEY `created_on` (`created_on`),
  ADD KEY `subject` (`subject`),
  ADD KEY `ip` (`ip`),
  ADD KEY `modified_on` (`modified_on`);

--
-- Indexes for table `admin_message_template`
--
ALTER TABLE `admin_message_template`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`),
  ADD KEY `title` (`title`),
  ADD KEY `status` (`isDeleted`),
  ADD KEY `created_on` (`created_on`),
  ADD KEY `modified_on` (`modified_on`);

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`aid`),
  ADD KEY `role` (`role`),
  ADD KEY `username` (`username`),
  ADD KEY `fname` (`fname`),
  ADD KEY `email` (`email`),
  ADD KEY `phone` (`phone`),
  ADD KEY `token` (`token`),
  ADD KEY `status` (`status`),
  ADD KEY `modified_date` (`modified_date`),
  ADD KEY `isDeleted` (`isDeleted`),
  ADD KEY `avtar` (`avtar`),
  ADD KEY `lname` (`lname`),
  ADD KEY `created_date` (`created_date`),
  ADD KEY `password` (`password`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_group`
--
ALTER TABLE `customer_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_group_member`
--
ALTER TABLE `customer_group_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_option`
--
ALTER TABLE `delivery_option`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `delivery_option_slot`
--
ALTER TABLE `delivery_option_slot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `globals`
--
ALTER TABLE `globals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location_area`
--
ALTER TABLE `location_area`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `location_city`
--
ALTER TABLE `location_city`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `location_pin`
--
ALTER TABLE `location_pin`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `location_state`
--
ALTER TABLE `location_state`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `management_fees`
--
ALTER TABLE `management_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_price`
--
ALTER TABLE `product_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_to_category`
--
ALTER TABLE `product_to_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_to_delivary_option`
--
ALTER TABLE `product_to_delivary_option`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_to_related`
--
ALTER TABLE `product_to_related`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_to_type`
--
ALTER TABLE `product_to_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referals`
--
ALTER TABLE `referals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_slot`
--
ALTER TABLE `time_slot`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `transaction_fees`
--
ALTER TABLE `transaction_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vid`);

--
-- Indexes for table `wish_list`
--
ALTER TABLE `wish_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `admin_audittrail`
--
ALTER TABLE `admin_audittrail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=320;
--
-- AUTO_INCREMENT for table `admin_contact_us`
--
ALTER TABLE `admin_contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `admin_message_template`
--
ALTER TABLE `admin_message_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `customer_group`
--
ALTER TABLE `customer_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `customer_group_member`
--
ALTER TABLE `customer_group_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `delivery_option`
--
ALTER TABLE `delivery_option`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `delivery_option_slot`
--
ALTER TABLE `delivery_option_slot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `globals`
--
ALTER TABLE `globals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `location_area`
--
ALTER TABLE `location_area`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `location_city`
--
ALTER TABLE `location_city`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `location_pin`
--
ALTER TABLE `location_pin`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `location_state`
--
ALTER TABLE `location_state`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `management_fees`
--
ALTER TABLE `management_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `product_price`
--
ALTER TABLE `product_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `product_to_category`
--
ALTER TABLE `product_to_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
--
-- AUTO_INCREMENT for table `product_to_delivary_option`
--
ALTER TABLE `product_to_delivary_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT for table `product_to_related`
--
ALTER TABLE `product_to_related`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `product_to_type`
--
ALTER TABLE `product_to_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `referals`
--
ALTER TABLE `referals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `time_slot`
--
ALTER TABLE `time_slot`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `transaction_fees`
--
ALTER TABLE `transaction_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `wish_list`
--
ALTER TABLE `wish_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
