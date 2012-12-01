-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 29, 2012 at 03:23 AM
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
  `vat_code` int(13) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Active','Disable') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `company_name`, `contact_person_name`, `email_address`, `telephone_number`, `address_line_1`, `address_line_2`, `city`, `country`, `post_code`, `special_prices`, `vat_code`, `creation_date`, `update_date`, `status`) VALUES
(1, 'Granjur Tech', 'Waqas Ur Rehman', 'appletoeat2@hotmail.com', '1234567890', 'Samanabad', 'Iqbal Town', 'Lahore', 'Pakistan', '54000', 'No', 1, '2012-08-22 02:31:15', '2012-08-22 02:31:15', 'Active');

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
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `purchase_order_number`, `invoice_address`, `delivery_address`, `order_description_radio`, `order_description`, `order_file_radio`, `order_file`, `status`, `creation_date`, `order_date`, `acceptance_date`, `shipment_date`, `invoice_date`, `outstanding_date`, `compeletion_date`) VALUES
(1, 1, '123', '<p>						Samanabad<br>Lahore<br>Pakistan<br>1234567890<br>54000</p>', '<p>Samanabad<br>Lahore<br>Pakistan<br>1234567890<br>54000</p>', 'Yes', 'jkhnk', 'Yes', '3b31a267ae327b13039a97304399b15a.txt', 'Accepted', '2012-08-29 01:36:34', '2012-08-29 03:14:54', '2012-08-29 03:16:51', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product_group_id`, `product_group`, `product_id`, `product_name`, `product_quantity`, `product_price`, `vat_rate`) VALUES
(2, 1, 1, 'Computer PCs', 1, 'Product 1', 12, 12.00, 10.00),
(3, 1, 2, 'Computer Laptops', 2, 'Product 2', 2, 12.33, 10.00);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `group_id`, `product_name`, `product_code`, `adl_code`, `product_price`, `product_manual`, `product_description`, `creation_date`, `update_date`, `status`) VALUES
(1, 1, 'Product 1', 'ax-123', 'zxc-33', 12.00, '', '', '2012-08-26 04:00:02', '2012-08-26 04:00:02', 'Active'),
(2, 2, 'Product 2', 'ax-12322', 'zxc-322', 12.33, '', '', '2012-08-26 04:00:39', '2012-08-26 04:00:39', 'Active');

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
(1, 'Computer PCs', '2012-08-26 03:58:58', '2012-08-26 03:58:58', 'Active'),
(2, 'Computer Laptops', '2012-08-26 03:59:09', '2012-08-26 03:59:09', 'Active');

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
(1, 22, 'appletoeat2@gmail.com', '7c29e201832905506403c991165fb2ab', 'super_admin', '2012-08-29 00:10:04'),
(2, 1, 'appletoeat2@hotmail.com', '7c29e201832905506403c991165fb2ab', 'customer', '0000-00-00 00:00:00');

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
(1, 'EDS', 10.00, 'Active'),
(2, 'OOO', 17.30, 'Active');
