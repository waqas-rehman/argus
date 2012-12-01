-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 23, 2012 at 03:19 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

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
  `vat_code` int(13) NOT NULL,
  `maximum_limit` float(13,2) NOT NULL,
  `transport_charges` float(13,2) NOT NULL,
  `overdue_days` int(13) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `balance` float(13,2) NOT NULL,
  `status` enum('Active','Disable') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `company_name`, `contact_person_name`, `email_address`, `telephone_number`, `address_line_1`, `address_line_2`, `city`, `country`, `post_code`, `special_prices`, `vat_code`, `maximum_limit`, `transport_charges`, `overdue_days`, `creation_date`, `update_date`, `balance`, `status`) VALUES
(1, '', 'Waqas Ur Rehman', 'appletoeat2@gmail.com', '', '', '', '', '', '', '', 0, 0.00, 0.00, 0, '0000-00-00 00:00:00', '2012-11-23 00:28:12', 0.00, 'Active'),
(2, 'Waqas Tech', 'Waqas Ur Rehman', 'appletoeat2@hotmail.com', '1234567890', 'Address Line 1', 'Address Line 2', 'Town/City ', 'Countrty', 'Postal code', 'No', 1, 100.00, 100.00, 10, '2012-11-22 20:44:21', '2012-11-22 20:44:21', -120.00, 'Active');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `email_messages`
--

INSERT INTO `email_messages` (`id`, `staff_id`, `customer_id`, `email_address`, `cc_email_address`, `bcc_email_address`, `email_subject`, `email_message`, `sent_time`) VALUES
(1, 2, 2, 'appletoeat2@hotmail.com', '', '', 'sdfsadfsdfsdfasdf', '<p>sdfsadfsdfsadfsdfsdfsdfasd</p>', '2012-11-22 21:57:46');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `purchase_order_number` varchar(255) NOT NULL,
  `invoice_address` text NOT NULL,
  `delivery_address` text NOT NULL,
  `order_description_radio` varchar(255) NOT NULL,
  `order_description` longtext NOT NULL,
  `order_file_radio` varchar(255) NOT NULL,
  `order_file` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `acceptance_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `shipment_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `invoice_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `outstanding_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `compeletion_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `invoice_radio` varchar(255) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `invoice_amount` float(13,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `type`, `customer_id`, `purchase_order_number`, `invoice_address`, `delivery_address`, `order_description_radio`, `order_description`, `order_file_radio`, `order_file`, `status`, `creation_date`, `order_date`, `acceptance_date`, `shipment_date`, `invoice_date`, `outstanding_date`, `compeletion_date`, `invoice_radio`, `invoice`, `invoice_amount`) VALUES
(1, 'order', 2, 'PO-1', '<p>						Waqas Tech<br>Address Line 1<br>Address Line 2<br>Town/City <br>Countrty<br>Postal code</p>', '<p>Waqas Tech<br>Address Line 1<br>Address Line 2<br>Town/City <br>Countrty<br>Postal code</p>', '', 'asdsadas', 'Yes', 'be1f955913a2680d51245e585d9c0a86.docx', 'Completed', '2012-11-22 22:48:22', '2012-11-22 23:47:04', '2012-11-23 00:01:35', '2012-11-23 00:01:52', '2012-11-03 00:02:02', '0000-00-00 00:00:00', '2012-11-23 02:55:26', '', 'a5824659970e4f2e66debfa713b66800.docx', 156.00),
(2, 'quotation', 2, 'ewq', '', '', '', 'khjk', '', '', '', '2012-11-22 23:27:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0.00),
(3, 'quotation', 2, 'ewqmm', '', '', '', 'mnbmbmn', '', '', '', '2012-11-22 23:43:02', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0.00),
(4, 'order', 2, 'fsdf', '<p>						Waqas Tech<br>Address Line 1<br>Address Line 2<br>Town/City <br>Countrty<br>Postal code</p>', '<p>Waqas Tech<br>Address Line 1<br>Address Line 2<br>Town/City <br>Countrty<br>Postal code</p>', '', '', '', '', 'Shipped', '2012-11-22 23:51:57', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2012-11-23 03:11:06', '2012-11-02 00:44:05', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'f1873224d9d015e86f6fadb8f8576e78.docx', 120.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE IF NOT EXISTS `order_products` (
  `id` int(13) NOT NULL AUTO_INCREMENT,
  `order_id` int(13) NOT NULL,
  `product_group_id` int(13) NOT NULL,
  `product_group` varchar(255) NOT NULL,
  `product_id` int(13) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_adl_code` varchar(255) NOT NULL,
  `product_quantity` int(13) NOT NULL,
  `product_price` float(13,2) NOT NULL,
  `vat_rate` float(13,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product_group_id`, `product_group`, `product_id`, `product_name`, `product_code`, `product_adl_code`, `product_quantity`, `product_price`, `vat_rate`) VALUES
(1, 1, 1, 'Electronics', 1, 'TV', 'E1', 'adl-1', 3, 10.00, 20.00),
(3, 2, 1, 'Electronics', 1, 'TV', '', '', 3, 10.00, 20.00),
(4, 3, 1, 'Electronics', 2, 'PC', '', '', 23, 10.00, 20.00);

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
  `product_description` text NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Active','Disable') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `group_id`, `product_name`, `product_code`, `adl_code`, `product_price`, `product_manual`, `product_description`, `creation_date`, `update_date`, `status`) VALUES
(1, 1, 'TV', 'E1', 'adl-1', 10.00, '', 'description of prod 1', '2012-11-22 22:19:49', '2012-11-22 22:19:49', 'Active'),
(2, 1, 'PC', 'E2', 'adl-2', 10.00, '', 'description of -rod 2', '2012-11-22 22:20:52', '2012-11-22 22:20:52', 'Active'),
(3, 2, 'Book 1', 'B1', 'adlb-1', 10.00, '', 'asd b1', '2012-11-22 22:21:23', '2012-11-22 22:21:23', 'Active'),
(4, 2, 'Book 2', 'B2', 'adl-2', 10.00, '', 'sd b2', '2012-11-22 22:21:46', '2012-11-22 22:21:46', 'Active');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `product_groups`
--

INSERT INTO `product_groups` (`id`, `group_name`, `creation_date`, `update_date`, `status`) VALUES
(1, 'Electronics', '2012-11-22 22:19:01', '2012-11-22 22:19:01', 'Active'),
(2, 'Books', '2012-11-22 22:19:09', '2012-11-22 22:19:09', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE IF NOT EXISTS `returns` (
  `id` int(13) NOT NULL AUTO_INCREMENT,
  `customer_id` int(13) NOT NULL,
  `rma_number` varchar(255) NOT NULL,
  `customer_representative` varchar(255) NOT NULL,
  `credit_required` varchar(255) NOT NULL,
  `repair_required` varchar(255) NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `report_required` varchar(255) NOT NULL,
  `site_address` varchar(255) NOT NULL,
  `installation_details` longtext NOT NULL,
  `product_details` longtext NOT NULL,
  `environmental_conditions` longtext NOT NULL,
  `installation_date` date NOT NULL,
  `last_maintaince_date` date NOT NULL,
  `additional_description` longtext NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `returns`
--

INSERT INTO `returns` (`id`, `customer_id`, `rma_number`, `customer_representative`, `credit_required`, `repair_required`, `invoice_number`, `report_required`, `site_address`, `installation_details`, `product_details`, `environmental_conditions`, `installation_date`, `last_maintaince_date`, `additional_description`, `insert_date`, `update_date`, `status`) VALUES
(1, 2, 'adsf', 'sdfsdf', 'No', 'No', 'dsf', 'No', 'sdf', 'sdf', '', 'sdf', '1970-01-01', '1970-01-01', 'sdaf', '2012-11-22 23:55:02', '2012-11-22 23:55:02', 'Open');

-- --------------------------------------------------------

--
-- Table structure for table `returns_records`
--

CREATE TABLE IF NOT EXISTS `returns_records` (
  `id` int(13) NOT NULL AUTO_INCREMENT,
  `returns_id` int(13) NOT NULL,
  `group_id` int(13) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `product_id` int(13) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_quantity` varchar(255) NOT NULL,
  `date_code` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `returns_records`
--

INSERT INTO `returns_records` (`id`, `returns_id`, `group_id`, `group_name`, `product_id`, `product_name`, `product_quantity`, `date_code`) VALUES
(1, 1, 1, 'Electronics', 1, 'TV', '324', 'sdf');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(13) NOT NULL AUTO_INCREMENT,
  `order_id` int(13) NOT NULL,
  `customer_id` int(13) NOT NULL,
  `transaction_type` varchar(255) NOT NULL,
  `transaction_amount` int(13) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `order_id`, `customer_id`, `transaction_type`, `transaction_amount`, `timestamp`) VALUES
(1, 1, 2, 'Credit_Note', 10, '2012-11-23 00:34:45'),
(2, 1, 2, 'Payment', 10, '2012-11-23 00:39:59'),
(3, 1, 2, 'Add_Back', 10, '2012-11-23 00:40:50'),
(4, 1, 2, 'Payment', 146, '2012-11-23 02:55:26');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_logins`
--

INSERT INTO `user_logins` (`id`, `user_id`, `username`, `password`, `user_type`, `last_login`) VALUES
(1, 1, 'appletoeat2@gmail.com', '7c29e201832905506403c991165fb2ab', 'admin', '2012-11-22 20:35:27'),
(2, 2, 'appletoeat2@hotmail.com', '7c29e201832905506403c991165fb2ab', 'customer', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `vat_codes`
--

CREATE TABLE IF NOT EXISTS `vat_codes` (
  `id` int(13) NOT NULL AUTO_INCREMENT,
  `vat_code` varchar(255) NOT NULL,
  `vat_rate` float(13,2) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `vat_codes`
--

INSERT INTO `vat_codes` (`id`, `vat_code`, `vat_rate`, `status`) VALUES
(1, 'Code 1', 20.00, 'Active');
