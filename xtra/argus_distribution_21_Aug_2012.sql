-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 21, 2012 at 03:09 AM
-- Server version: 5.1.30
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `argus_distribution`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(13) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL,
  `contact_person_name` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `telephone_number` varchar(255) NOT NULL,
  `address_line_1` varchar(255) NOT NULL,
  `address_line_2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `post_code` varchar(255) NOT NULL,
  `special_prices` varchar(10) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Active','Disable') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `customers`
--


-- --------------------------------------------------------

--
-- Table structure for table `customer_products`
--

CREATE TABLE IF NOT EXISTS `customer_products` (
  `id` int(13) NOT NULL AUTO_INCREMENT,
  `customer_id` int(13) NOT NULL,
  `product_id` int(13) NOT NULL,
  `product_price` float(13,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `customer_products`
--


-- --------------------------------------------------------

--
-- Table structure for table `email_config`
--

CREATE TABLE IF NOT EXISTS `email_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protocol` varchar(255) NOT NULL,
  `smtp_host` varchar(255) NOT NULL,
  `smtp_port` varchar(255) NOT NULL,
  `smtp_user` varchar(255) NOT NULL,
  `smtp_pass` varchar(255) NOT NULL,
  `mailtype` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `email_config`
--

INSERT INTO `email_config` (`id`, `protocol`, `smtp_host`, `smtp_port`, `smtp_user`, `smtp_pass`, `mailtype`) VALUES
(1, 'smtp', 'ssl://smtp.googlemail.com', '465', 'dummyemailfortest@gmail.com', 'dummy123', 'html');

-- --------------------------------------------------------

--
-- Table structure for table `email_messages`
--

CREATE TABLE IF NOT EXISTS `email_messages` (
  `id` int(13) NOT NULL AUTO_INCREMENT,
  `staff_id` int(13) NOT NULL,
  `customer_id` int(13) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `cc_email_address` varchar(255) NOT NULL,
  `bcc_email_address` varchar(255) NOT NULL,
  `email_subject` varchar(255) NOT NULL,
  `email_message` text NOT NULL,
  `sent_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `email_messages`
--


-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(13) NOT NULL AUTO_INCREMENT,
  `group_id` int(13) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `adl_code` varchar(255) NOT NULL,
  `product_price` float(13,2) NOT NULL,
  `product_manual` varchar(255) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Active','Disable') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `products`
--


-- --------------------------------------------------------

--
-- Table structure for table `product_groups`
--

CREATE TABLE IF NOT EXISTS `product_groups` (
  `id` int(13) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `product_groups`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

CREATE TABLE IF NOT EXISTS `user_logins` (
  `id` int(13) NOT NULL AUTO_INCREMENT,
  `user_id` int(13) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user_logins`
--

