-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 11, 2013 at 08:08 PM
-- Server version: 5.5.25a-log
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `web178-portal-1`
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
  `county` varchar(255) NOT NULL,
  `post_code` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `company_name`, `contact_person_name`, `email_address`, `telephone_number`, `address_line_1`, `address_line_2`, `city`, `county`, `post_code`, `country`, `special_prices`, `vat_code`, `maximum_limit`, `transport_charges`, `overdue_days`, `creation_date`, `update_date`, `balance`, `status`) VALUES
(1, '', 'Waqas Ur Rehman', 'appletoeat2@gmail.com', '', '', '', '', '', '', '', '', 0, 0.00, 0.00, 0, '0000-00-00 00:00:00', '2012-11-23 00:28:12', 0.00, 'Active'),
(5, 'S2 Fire Solutions', 'Simon Milward', 'adltestcustomer@gmail.com', '447740122393', 'Dunvegan', 'Chester High Road', 'Neston', 'Cheshire', 'CH64 3TH', 'United Kingdom', 'No', 1, 500.00, 7.00, 45, '2012-12-03 15:03:12', '2012-12-03 15:03:12', -498.40, 'Active'),
(8, 'Waqas Tech', 'Waqas', 'appletoeat2@hotmail.com', '1234567890', 'sadads', 'sadasd', 'sad', 'County', 'asd', 'Pakistan', 'No', 1, 100.00, 100.00, 10, '2012-12-09 13:17:54', '2012-12-09 13:17:54', -2.00, 'Active'),
(9, 'wapda', 'zahid Hussain', 'zahid.hkalwar@gmail.com', '03337369496', 'TPS Guddu', 'Guddu', 'Guddu', 'Pakistan', '79220', 'Pakistan', 'No', 1, 10.00, 10.00, 10, '2012-12-09 13:28:17', '2012-12-09 13:28:17', -252.00, 'Active');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `type`, `customer_id`, `purchase_order_number`, `invoice_address`, `delivery_address`, `order_description_radio`, `order_description`, `order_file_radio`, `order_file`, `status`, `creation_date`, `order_date`, `acceptance_date`, `shipment_date`, `invoice_date`, `outstanding_date`, `compeletion_date`, `invoice_radio`, `invoice`, `invoice_amount`) VALUES
(28, 'order', 8, '4569', '						<p>						Waqas Tech<br>sadads<br>sadasd<br>sad<br>County<br>asd<br>Pakistan</p>', '<p>Waqas Tech<br>sadads<br>sadasd<br>sad<br>County<br>asd<br>Pakistan</p>', '', '', 'No', '', 'Pending', '2013-01-09 10:26:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0.00),
(27, 'order', 8, 'TRt', '						<p>						Waqas Tech<br>sadads<br>sadasd<br>sad<br>County<br>asd<br>Pakistan</p>', '<p>Waqas Tech<br>sadads<br>sadasd<br>sad<br>County<br>asd<br>Pakistan</p>', '', '', 'No', '', 'Outstanding', '2012-12-11 22:39:27', '2012-12-11 22:39:53', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2013-01-09 10:22:08', '2013-01-09 10:41:19', '0000-00-00 00:00:00', '', '5217510e5e9acad304cf518213de2807.pdf', 540.00),
(24, 'order', 5, '23', '<p>						S2 Fire Solutions<br>Dunvegan<br>Chester High Road<br>Neston<br>Cheshire<br>CH64 3TH<br>United Kingdom</p>', '<p>S2 Fire Solutions<br>Dunvegan<br>Chester High Road<br>Neston<br>Cheshire<br>CH64 3TH<br>United Kingdom</p>', '', '', '', '', 'Pending', '2012-12-10 14:31:04', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0.00),
(26, 'order', 8, '124', '						<p>						Waqas Tech<br>sadads<br>sadasd<br>sad<br>sad<br>asd<br>sd</p>', '<p>Waqas Tech<br>sadads<br>sadasd<br>sad<br>sad<br>asd<br>sd</p>', '', '', 'No', '', 'Pending', '2012-12-10 19:27:42', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0.00),
(25, 'order', 8, '888', '<p>						Waqas Tech<br>sadads<br>sadasd<br>sad<br>sad<br>asd<br>sd</p>', '<p>Waqas Tech<br>sadads<br>sadasd<br>sad<br>sad<br>asd<br>sd</p>', '', '', 'No', '', 'Pending', '2012-12-10 18:34:29', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0.00),
(23, 'order', 9, '4545', '<p>						wapda<br>TPS Guddu<br>Guddu<br>Guddu<br>Pakistan<br>79220<br>Pakistan</p>', '<p>wapda<br>TPS Guddu<br>Guddu<br>Guddu<br>Pakistan<br>79220<br>Pakistan</p>', '', '', 'No', '', 'Outstanding', '2012-12-09 15:53:02', '2012-12-09 15:53:33', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2012-12-09 15:54:59', '0000-00-00 00:00:00', '', '', 0.00),
(22, 'order', 9, 'asd', '<p>						wapda<br>TPS Guddu<br>Guddu<br>Guddu<br>Pakistan<br>79220<br>Pakistan</p>', '<p>wapda<br>TPS Guddu<br>Guddu<br>Guddu<br>Pakistan<br>79220<br>Pakistan</p>', '', '', 'Yes', '85404d3dab60e80d5199c7c3458af089.txt', 'Outstanding', '2012-12-09 13:47:00', '2012-12-09 13:48:07', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2012-12-09 15:55:32', '2013-01-09 10:41:19', '0000-00-00 00:00:00', '', '', 252.00),
(21, 'order', 8, 'we', '<p>						Waqas Tech<br>sadads<br>sadasd<br>sad<br>sad<br>asd<br>sd</p>', '<p>Waqas Tech<br>sadads<br>sadasd<br>sad<br>sad<br>asd<br>sd</p>', '', '', 'Yes', '33ab48ec9cd385f974bcb6a34ba7e2b3.txt', 'Ordered', '2012-12-09 13:23:38', '2012-12-09 13:24:47', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0.00),
(20, 'order', 5, 'Rt', '<p>						S2 Fire Solutions<br>Dunvegan<br>Chester High Road<br>Neston<br>United Kingdom<br>CH64 3TH<br></p>', '<p>S2 Fire Solutions<br>Dunvegan<br>Chester High Road<br>Neston<br>United Kingdom<br>CH64 3TH<br></p>', '', '', '', '', 'Pending', '2012-12-08 11:02:17', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0.00),
(19, 'quotation', 5, '2543', '', '', '', 'Neston School Project', '', '', '', '2012-12-07 20:42:58', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0.00),
(17, 'order', 5, '12', '<p>						S2 Fire Solutions<br>Dunvegan<br>Chester High Road<br>Neston<br>United Kingdom<br>CH64 3TH</p>', '<p>S2 Fire Solutions<br>Dunvegan<br>Chester High Road<br>Neston<br>United Kingdom<br>CH64 3TH</p>', '', '', '', '', 'Pending', '2012-12-07 10:13:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0.00),
(18, 'order', 5, 'Rf12', '<p>						S2 Fire Solutions<br>Dunvegan<br>Chester High Road<br>Neston<br><br>CH64 3TH</p>', '<p>S2 Fire Solutions<br>Dunvegan<br>Chester High Road<br>Neston<br><br>CH64 3TH</p>', '', 'Test', 'No', '', 'Ordered', '2012-12-07 20:38:10', '2012-12-07 20:38:51', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0.00),
(16, 'order', 5, '1', '<p>						S2 Fire Solutions<br>Dunvegan<br>Chester High Road<br>Neston<br>United Kingdom<br>CH64 3TH</p>', '<p>S2 Fire Solutions<br>Dunvegan<br>Chester High Road<br>Neston<br>United Kingdom<br>CH64 3TH</p>', '', 'Test Order', 'No', '', 'Outstanding', '2012-12-06 14:37:09', '2012-12-06 14:37:49', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2012-12-06 14:39:08', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'feb79da4339ed935c084a2be15db3d94.pdf', 608.40);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product_group_id`, `product_group`, `product_id`, `product_name`, `product_code`, `product_adl_code`, `product_quantity`, `product_price`, `vat_rate`) VALUES
(23, 28, 1, 'Electronics', 1, 'TV', 'E1', 'ADL1', 1, 10.00, 20.00),
(22, 27, 2, 'Books', 4, 'Book 2', 'B2', 'ADL2', 45, 10.00, 20.00),
(21, 26, 1, 'Electronics', 1, 'TV', 'E1', 'ADL1', 10, 10.00, 20.00),
(20, 25, 1, 'Electronics', 1, 'TV', 'E1', 'ADL1', 12, 10.00, 20.00),
(19, 23, 1, 'Electronics', 1, 'TV', 'E1', 'ADL1', 10, 10.00, 20.00),
(18, 22, 1, 'Electronics', 2, 'PC', 'E2', 'ADL2', 21, 10.00, 20.00),
(17, 21, 1, 'Electronics', 1, 'TV', 'E1', 'ADL1', 10, 10.00, 20.00),
(16, 19, 2, 'Books', 3, 'Book 1', '', '', 120, 10.00, 20.00),
(15, 18, 1, 'Electronics', 1, 'TV', 'E1', 'ADL1', 1, 10.00, 20.00),
(14, 16, 1, 'Electronics', 1, 'TV', 'E1', 'ADL1', 50, 10.00, 20.00);

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
(1, 1, 'TV', 'E1', 'ADL1', 10.00, '', 'description of prod 1', '2012-11-22 22:19:49', '2012-11-22 22:19:49', 'Active'),
(2, 1, 'PC', 'E2', 'ADL2', 10.00, '', 'description of -rod 2', '2012-11-22 22:20:52', '2012-11-22 22:20:52', 'Active'),
(3, 2, 'Book 1', 'B1', 'ADLB1', 10.00, '', 'asd b1', '2012-11-22 22:21:23', '2012-11-22 22:21:23', 'Active'),
(4, 2, 'Book 2', 'B2', 'ADL2', 10.00, '', 'sd b2', '2012-11-22 22:21:46', '2012-11-22 22:21:46', 'Active');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `order_id`, `customer_id`, `transaction_type`, `transaction_amount`, `timestamp`) VALUES
(15, 27, 8, 'Add_Back', 1, '2013-01-09 10:25:07'),
(14, 27, 8, 'Payment', 39, '2013-01-09 10:24:33'),
(13, 27, 8, 'Credit_Note', 500, '2013-01-09 10:23:50'),
(12, 16, 5, 'Payment', 110, '2012-12-07 10:10:53');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user_logins`
--

INSERT INTO `user_logins` (`id`, `user_id`, `username`, `password`, `user_type`, `last_login`) VALUES
(1, 1, 'appletoeat2@gmail.com', '7c29e201832905506403c991165fb2ab', 'admin', '2013-01-09 10:20:05'),
(9, 9, 'zahid.hkalwar@gmail.com', '7c29e201832905506403c991165fb2ab', 'customer', '0000-00-00 00:00:00'),
(8, 8, 'appletoeat2@hotmail.com', '7c29e201832905506403c991165fb2ab', 'customer', '0000-00-00 00:00:00'),
(5, 5, 's2fire', '148fd263f6ecc6646056367183248682', 'customer', '0000-00-00 00:00:00');

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
