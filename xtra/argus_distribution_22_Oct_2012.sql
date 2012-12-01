-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2012 at 09:09 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


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
(1, '', 'Waqas Ur Rehman', 'appletoeat2@gmail.com', '', '', '', '', '', '', '', 0, 0.00, 0.00, 0, '0000-00-00 00:00:00', '2012-09-06 06:38:39', 0.00, 'Active'),
(2, 'Granjur Technologies', 'Waqas', 'appletoeat2@gmail.com', '1234567890', 'Samanabad', 'Iqbal Town', 'Lahore', 'Pakistan', '54000', 'Yes', 1, 200.00, 100.00, 10, '2012-09-06 06:42:55', '2012-09-06 06:42:55', -484.00, 'Active');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `type`, `customer_id`, `purchase_order_number`, `invoice_address`, `delivery_address`, `order_description_radio`, `order_description`, `order_file_radio`, `order_file`, `status`, `creation_date`, `order_date`, `acceptance_date`, `shipment_date`, `invoice_date`, `outstanding_date`, `compeletion_date`, `invoice_radio`, `invoice`, `invoice_amount`) VALUES
(1, 'order', 2, 'Payorder 1', '<p>						Samanabad<br>Lahore<br>Pakistan<br>1234567890<br>54000</p>', '<p>Samanabad<br>Lahore<br>Pakistan<br>1234567890<br>54000</p>', 'No', '', 'No', '', 'invoiced', '2012-09-28 19:02:03', '2012-09-28 19:02:27', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2012-09-28 19:02:41', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 484.00),
(2, 'order', 2, '454555', '<p>						Samanabad<br>Lahore<br>Pakistan<br>1234567890<br>54000</p>', '<p>Samanabad<br>Lahore<br>Pakistan<br>1234567890<br>54000</p>', '', '', '', '', 'Accepted', '2012-10-19 09:43:59', '0000-00-00 00:00:00', '2012-10-19 09:45:17', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0.00),
(3, 'order', 2, '5456', '<p>						Samanabad<br>Lahore<br>Pakistan<br>1234567890<br>54000</p>', '<p>Samanabad<br>Lahore<br>Pakistan<br>1234567890<br>54000</p>', '', '', '', '', 'Completed', '2012-10-19 09:46:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2012-10-19 09:47:05', '', '', 0.00),
(4, 'order', 2, '7855', '<p>						Samanabad<br>Lahore<br>Pakistan<br>1234567890<br>54000</p>', '<p>Samanabad<br>Lahore<br>Pakistan<br>1234567890<br>54000</p>', '', '', '', '', 'Shipped', '2012-10-19 13:41:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2012-10-19 13:42:03', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0.00),
(5, 'order', 2, '788', '<p>						Samanabad<br>Lahore<br>Pakistan<br>1234567890<br>54000</p>', '<p>Samanabad<br>Lahore<br>Pakistan<br>1234567890<br>54000</p>', '', '', '', '', 'Pending', '2012-10-19 15:59:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0.00);

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
  `product_quantity` int(13) NOT NULL,
  `product_price` float(13,2) NOT NULL,
  `vat_rate` float(13,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product_group_id`, `product_group`, `product_id`, `product_name`, `product_quantity`, `product_price`, `vat_rate`) VALUES
(1, 1, 1, 'Electronics', 1, 'Product 1', 2, 100.00, 10.00),
(2, 1, 2, 'Books', 3, 'Product 3', 2, 120.00, 10.00),
(3, 2, 1, 'Electronics', 1, 'Product 1', 4, 100.00, 10.00),
(4, 3, 1, 'Electronics', 1, 'Product 1', 5, 100.00, 10.00),
(5, 4, 2, 'Books', 3, 'Product 3', 5, 120.00, 10.00);

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
(1, 1, 'Product 1', 'p-123', 'p-123', 100.00, '', 'This is product description', '2012-09-06 06:49:32', '2012-09-06 06:49:32', 'Active'),
(2, 1, 'Product 2', 'p-321', 'p-321', 150.00, '', 'product description of product 2', '2012-09-06 06:50:19', '2012-09-06 06:50:19', 'Active'),
(3, 2, 'Product 3', 'p-213', 'p-213', 120.00, '', 'asdasd', '2012-09-06 06:51:01', '2012-09-06 06:51:01', 'Active'),
(4, 2, 'Product 4', 'p-432', 'p-432', 160.00, '', 'dasasdas', '2012-09-06 06:51:33', '2012-09-06 06:51:33', 'Active');

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
(1, 'Electronics', '2012-09-06 06:44:30', '2012-09-06 06:44:30', 'Active'),
(2, 'Books', '2012-09-06 06:44:44', '2012-09-06 06:44:44', 'Active');

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
(1, 2, 'RMA 123', 'Customer Rep', 'No', 'No', 'sadasd', 'No', 'sadsad', '<p>sadasdsad</p>', '', '<p>asdasdasd</p>', '2012-01-09', '1970-01-01', '<p>dasdasd</p>', '2012-09-27 12:58:39', '2012-09-27 14:00:27', 'Submit');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `returns_records`
--

INSERT INTO `returns_records` (`id`, `returns_id`, `group_id`, `group_name`, `product_id`, `product_name`, `product_quantity`, `date_code`) VALUES
(4, 1, 1, 'Electronics', 1, 'Product 1', '213', '123sad'),
(5, 1, 2, 'Books', 4, 'Product 4', '213', 'das');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `order_id`, `customer_id`, `transaction_type`, `transaction_amount`, `timestamp`) VALUES
(1, 1, 2, 'Add_Back', 184, '2012-09-28 20:29:04');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_logins`
--

INSERT INTO `user_logins` (`id`, `user_id`, `username`, `password`, `user_type`, `last_login`) VALUES
(1, 1, 'appletoeat2@gmail.com', '7c29e201832905506403c991165fb2ab', 'admin', '2012-10-21 09:15:36'),
(3, 2, 'appletoeat2@hotmail.com', '7c29e201832905506403c991165fb2ab', 'customer', '0000-00-00 00:00:00');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `vat_codes`
--

INSERT INTO `vat_codes` (`id`, `vat_code`, `vat_rate`, `status`) VALUES
(1, 'VAT 1', 10.00, 'Active'),
(2, 'VAT 3', 15.00, 'Active');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
