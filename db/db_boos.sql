-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2023 at 04:17 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_boos`
--
CREATE DATABASE IF NOT EXISTS `db_boos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_boos`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `Checkout`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Checkout` (IN `customerid` INT, IN `payment` VARCHAR(50), IN `amount` DECIMAL(7,2), IN `address_idField` INT, OUT `orderid` INT)   BEGIN
    INSERT INTO tbl_order (customer_id) VALUES (customerid);
    SET @orderid := LAST_INSERT_ID();
    SET @mop_id := (SELECT mop_id FROM tbl_payment_method WHERE payment_name = payment LIMIT 1);

    INSERT INTO tbl_order_details (order_id, mop_id, total_amount, balance, address_id)
    VALUES(@orderid, @mop_id, amount, amount, address_idField);

    SET orderid := @orderid;
END$$

DROP PROCEDURE IF EXISTS `OrderStatusUpdate`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `OrderStatusUpdate` (IN `order_idField` INT)   BEGIN
UPDATE tbl_order SET order_status='Recieved' WHERE order_id =order_idField;
UPDATE tbl_order_details SET balance=0 WHERE order_id=order_idField;
END$$

DROP PROCEDURE IF EXISTS `RegisterUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `RegisterUser` (IN `usernameField` VARCHAR(255), IN `passwordField` VARCHAR(255), IN `saltField` VARCHAR(10), IN `emailField` VARCHAR(255), IN `firstnameField` VARCHAR(255), IN `lastnameField` VARCHAR(255), IN `phoneField` VARCHAR(50), IN `buildingField` VARCHAR(255), IN `streetField` VARCHAR(255), IN `barangayField` VARCHAR(255), IN `municipalityField` VARCHAR(255), IN `postalField` VARCHAR(4))   BEGIN
    -- Insert into tbl_user
    INSERT INTO tbl_user (username, password, salt, email)
    VALUES (usernameField, passwordField, saltField, emailField);

    -- Get the last inserted user_id
    SET @user_id := LAST_INSERT_ID();

    -- Insert into tbl_customer
    INSERT INTO tbl_customer(user_id, firstname, lastname, phone)
    VALUES (@user_id, firstnameField, lastnameField, phoneField);

    -- Get the last inserted customer_id
    SET @customer_id := LAST_INSERT_ID();

    -- Insert into tbl_customer_address
    INSERT INTO tbl_customer_address(customer_id, building_no, street_number, barangay, municipality, postal_code, primary_house)
    VALUES (@customer_id, buildingField, streetField, barangayField, municipalityField, postalField, TRUE);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `created_at`, `modified_at`, `deleted_at`) VALUES
(1, 'Tonkatsu', '2023-12-02 19:50:23', '2023-12-02 19:50:23', NULL),
(2, 'Bento', '2023-12-02 19:50:23', '2023-12-02 19:50:23', NULL),
(3, 'Silog', '2023-12-02 20:17:11', '2023-12-02 20:17:11', NULL),
(4, 'Teriyaki', '2023-12-02 20:19:24', '2023-12-02 20:19:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

DROP TABLE IF EXISTS `tbl_customer`;
CREATE TABLE `tbl_customer` (
  `customer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`customer_id`, `user_id`, `firstname`, `lastname`, `phone`, `created_at`, `modified_at`, `deleted_at`) VALUES
(1, 2, 'Emjay', 'Rongavilla', '0999328736', '2023-12-03 20:46:37', '2023-12-03 20:46:37', NULL),
(2, 3, 'Jme', 'Fkdi', '0987654353', '2023-12-09 01:31:56', '2023-12-09 01:31:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_address`
--

DROP TABLE IF EXISTS `tbl_customer_address`;
CREATE TABLE `tbl_customer_address` (
  `address_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `building_no` varchar(255) DEFAULT NULL,
  `street_number` varchar(255) DEFAULT NULL,
  `barangay` varchar(50) DEFAULT NULL,
  `municipality` varchar(50) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `primary_house` tinyint(1) DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_customer_address`
--

INSERT INTO `tbl_customer_address` (`address_id`, `customer_id`, `building_no`, `street_number`, `barangay`, `municipality`, `postal_code`, `primary_house`, `created_at`, `modified_at`, `deleted_at`) VALUES
(1, 2, '3322 Ne', '32 Ds', 'Pansol', 'Padre Garcia', '4224', 1, '2023-12-09 01:31:56', '2023-12-09 01:31:56', NULL),
(2, 1, '213', 'Purok Uno', 'Castillo', 'Padre Garcia', '4563', 0, '2023-12-09 15:27:08', '2023-12-09 15:27:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_cart`
--

DROP TABLE IF EXISTS `tbl_customer_cart`;
CREATE TABLE `tbl_customer_cart` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_customer_cart`
--

INSERT INTO `tbl_customer_cart` (`cart_id`, `product_id`, `customer_id`, `quantity`, `created_at`, `modified_at`, `deleted_at`) VALUES
(1, 1, 1, 0, '2023-12-06 00:24:08', '2023-12-09 22:08:51', '2023-12-09 22:09:52'),
(2, 2, 1, 0, '2023-12-06 01:05:23', '2023-12-09 21:54:54', '2023-12-09 21:58:01'),
(3, 3, 1, 0, '2023-12-06 01:05:26', '2023-12-06 01:33:51', '2023-12-09 21:51:53'),
(4, 1, 2, 5, '2023-12-09 02:38:31', '2023-12-09 23:16:16', NULL),
(5, 3, 2, 0, '2023-12-09 02:42:46', '2023-12-09 22:32:44', '2023-12-09 23:13:06'),
(6, 2, 2, 0, '2023-12-09 09:04:27', '2023-12-09 09:04:27', '2023-12-09 23:13:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

DROP TABLE IF EXISTS `tbl_invoice`;
CREATE TABLE `tbl_invoice` (
  `invoice_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`invoice_id`, `order_id`, `product_id`, `quantity`, `created_at`, `modified_at`, `deleted_at`) VALUES
(1, 13, 1, 2, '2023-12-09 11:23:10', '2023-12-09 11:23:10', NULL),
(2, 13, 2, 1, '2023-12-09 11:23:10', '2023-12-09 11:23:10', NULL),
(3, 13, 3, 1, '2023-12-09 11:23:10', '2023-12-09 11:23:10', NULL),
(4, 14, 1, 2, '2023-12-09 11:23:51', '2023-12-09 11:23:51', NULL),
(5, 14, 2, 1, '2023-12-09 11:23:51', '2023-12-09 11:23:51', NULL),
(6, 14, 3, 1, '2023-12-09 11:23:51', '2023-12-09 11:23:51', NULL),
(7, 15, 1, 2, '2023-12-09 11:26:33', '2023-12-09 11:26:33', NULL),
(8, 15, 2, 1, '2023-12-09 11:26:33', '2023-12-09 11:26:33', NULL),
(9, 15, 3, 1, '2023-12-09 11:26:33', '2023-12-09 11:26:33', NULL),
(13, 17, 1, 2, '2023-12-09 11:30:00', '2023-12-09 11:30:00', NULL),
(14, 17, 2, 1, '2023-12-09 11:30:00', '2023-12-09 11:30:00', NULL),
(15, 17, 3, 1, '2023-12-09 11:30:00', '2023-12-09 11:30:00', NULL),
(16, 18, 1, 2, '2023-12-09 11:31:24', '2023-12-09 11:31:24', NULL),
(17, 18, 2, 1, '2023-12-09 11:31:24', '2023-12-09 11:31:24', NULL),
(18, 18, 3, 1, '2023-12-09 11:31:24', '2023-12-09 11:31:24', NULL),
(19, 19, 1, 2, '2023-12-09 11:51:30', '2023-12-09 11:51:30', NULL),
(20, 19, 2, 1, '2023-12-09 11:51:30', '2023-12-09 11:51:30', NULL),
(21, 19, 3, 1, '2023-12-09 11:51:30', '2023-12-09 11:51:30', NULL),
(22, 20, 1, 2, '2023-12-09 12:00:50', '2023-12-09 12:00:50', NULL),
(23, 20, 2, 1, '2023-12-09 12:00:50', '2023-12-09 12:00:50', NULL),
(24, 20, 3, 1, '2023-12-09 12:00:50', '2023-12-09 12:00:50', NULL),
(25, 21, 1, 2, '2023-12-09 12:01:09', '2023-12-09 12:01:09', NULL),
(26, 21, 2, 1, '2023-12-09 12:01:09', '2023-12-09 12:01:09', NULL),
(27, 21, 3, 1, '2023-12-09 12:01:09', '2023-12-09 12:01:09', NULL),
(28, 22, 1, 2, '2023-12-09 12:01:11', '2023-12-09 12:01:11', NULL),
(29, 22, 2, 1, '2023-12-09 12:01:11', '2023-12-09 12:01:11', NULL),
(30, 22, 3, 1, '2023-12-09 12:01:11', '2023-12-09 12:01:11', NULL),
(31, 23, 1, 2, '2023-12-09 12:10:09', '2023-12-09 12:10:09', NULL),
(32, 24, 1, 1, '2023-12-09 16:27:23', '2023-12-09 16:27:23', NULL),
(33, 24, 2, 1, '2023-12-09 16:27:23', '2023-12-09 16:27:23', NULL),
(34, 24, 3, 1, '2023-12-09 16:27:23', '2023-12-09 16:27:23', NULL),
(35, 25, 1, 2, '2023-12-09 21:40:25', '2023-12-09 21:40:25', NULL),
(36, 26, 1, 3, '2023-12-09 21:49:24', '2023-12-09 21:49:24', NULL),
(37, 27, 1, 1, '2023-12-09 21:51:53', '2023-12-09 21:51:53', NULL),
(38, 27, 2, 1, '2023-12-09 21:51:53', '2023-12-09 21:51:53', NULL),
(39, 27, 3, 1, '2023-12-09 21:51:53', '2023-12-09 21:51:53', NULL),
(40, 28, 2, 1, '2023-12-09 21:55:24', '2023-12-09 21:55:24', NULL),
(41, 29, 2, 1, '2023-12-09 21:58:01', '2023-12-09 21:58:01', NULL),
(42, 30, 1, 1, '2023-12-09 22:26:36', '2023-12-09 22:26:36', NULL),
(43, 31, 3, 1, '2023-12-09 22:28:29', '2023-12-09 22:28:29', NULL),
(44, 32, 1, 3, '2023-12-09 22:40:40', '2023-12-09 22:40:40', NULL),
(45, 32, 3, 2, '2023-12-09 22:40:40', '2023-12-09 22:40:40', NULL),
(46, 33, 1, 1, '2023-12-09 23:13:06', '2023-12-09 23:13:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

DROP TABLE IF EXISTS `tbl_order`;
CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_status` enum('Preparing','Pending','Shipping','Delivered','Cancelled','Recieved') NOT NULL DEFAULT 'Preparing',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `customer_id`, `order_status`, `created_at`, `modified_at`, `deleted_at`) VALUES
(13, 2, 'Preparing', '2023-12-09 11:23:10', '2023-12-09 11:23:10', NULL),
(14, 2, 'Recieved', '2023-12-09 11:23:51', '2023-12-09 11:23:51', NULL),
(15, 2, 'Recieved', '2023-12-09 11:26:33', '2023-12-09 11:26:33', NULL),
(17, 2, 'Preparing', '2023-12-09 11:30:00', '2023-12-09 11:30:00', NULL),
(18, 2, 'Preparing', '2023-12-09 11:31:24', '2023-12-09 11:31:24', NULL),
(19, 2, 'Preparing', '2023-12-09 11:51:29', '2023-12-09 11:51:29', NULL),
(20, 2, 'Preparing', '2023-12-09 12:00:50', '2023-12-09 12:00:50', NULL),
(21, 2, 'Preparing', '2023-12-09 12:01:09', '2023-12-09 12:01:09', NULL),
(22, 2, 'Preparing', '2023-12-09 12:01:11', '2023-12-09 12:01:11', NULL),
(23, 2, 'Preparing', '2023-12-09 12:10:08', '2023-12-09 12:10:08', NULL),
(24, 1, 'Preparing', '2023-12-09 16:27:23', '2023-12-09 16:27:23', NULL),
(25, 2, 'Preparing', '2023-12-09 21:40:25', '2023-12-09 21:40:25', NULL),
(26, 2, 'Preparing', '2023-12-09 21:49:24', '2023-12-09 21:49:24', NULL),
(27, 1, 'Preparing', '2023-12-09 21:51:53', '2023-12-09 21:51:53', NULL),
(28, 1, 'Preparing', '2023-12-09 21:55:24', '2023-12-09 21:55:24', NULL),
(29, 1, 'Preparing', '2023-12-09 21:58:00', '2023-12-09 21:58:00', NULL),
(30, 2, 'Preparing', '2023-12-09 22:26:36', '2023-12-09 22:26:36', NULL),
(31, 2, 'Preparing', '2023-12-09 22:28:29', '2023-12-09 22:28:29', NULL),
(32, 2, 'Preparing', '2023-12-09 22:40:40', '2023-12-09 22:40:40', NULL),
(33, 2, 'Preparing', '2023-12-09 23:13:06', '2023-12-09 23:13:06', NULL);

--
-- Triggers `tbl_order`
--
DROP TRIGGER IF EXISTS `DeleteCart`;
DELIMITER $$
CREATE TRIGGER `DeleteCart` AFTER INSERT ON `tbl_order` FOR EACH ROW UPDATE tbl_customer_cart SET deleted_at = NOW(), quantity = 0 WHERE customer_id = NEW.customer_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_details`
--

DROP TABLE IF EXISTS `tbl_order_details`;
CREATE TABLE `tbl_order_details` (
  `transaction_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `mop_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `address_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order_details`
--

INSERT INTO `tbl_order_details` (`transaction_id`, `order_id`, `mop_id`, `total_amount`, `balance`, `created_at`, `modified_at`, `deleted_at`, `address_id`) VALUES
(13, 13, 1, 0.00, 0.00, '2023-12-09 11:23:10', '2023-12-09 11:23:10', NULL, 1),
(14, 14, 1, 575.00, 0.00, '2023-12-09 11:23:51', '2023-12-09 11:23:51', NULL, 1),
(15, 15, 1, 575.00, 0.00, '2023-12-09 11:26:33', '2023-12-09 11:26:33', NULL, 1),
(17, 17, 1, 575.00, 575.00, '2023-12-09 11:30:00', '2023-12-09 11:30:00', NULL, 1),
(18, 18, 1, 575.00, 575.00, '2023-12-09 11:31:24', '2023-12-09 11:31:24', NULL, 1),
(19, 19, 1, 575.00, 575.00, '2023-12-09 11:51:29', '2023-12-09 11:51:29', NULL, 1),
(20, 20, 1, 575.00, 575.00, '2023-12-09 12:00:50', '2023-12-09 12:00:50', NULL, 1),
(21, 21, 2, 575.00, 575.00, '2023-12-09 12:01:09', '2023-12-09 12:01:09', NULL, 1),
(22, 22, 3, 575.00, 575.00, '2023-12-09 12:01:11', '2023-12-09 12:01:11', NULL, 1),
(23, 23, 1, 220.00, 220.00, '2023-12-09 12:10:08', '2023-12-09 12:10:08', NULL, 1),
(24, 24, 1, 465.00, 465.00, '2023-12-09 16:27:23', '2023-12-09 16:27:23', NULL, 2),
(25, 25, 1, 220.00, 220.00, '2023-12-09 21:40:25', '2023-12-09 21:40:25', NULL, 1),
(26, 26, 3, 330.00, 330.00, '2023-12-09 21:49:24', '2023-12-09 21:49:24', NULL, 1),
(27, 27, 1, 465.00, 465.00, '2023-12-09 21:51:53', '2023-12-09 21:51:53', NULL, 2),
(28, 28, 1, 175.00, 175.00, '2023-12-09 21:55:24', '2023-12-09 21:55:24', NULL, 2),
(29, 29, 1, 175.00, 175.00, '2023-12-09 21:58:01', '2023-12-09 21:58:01', NULL, 2),
(30, 30, 1, 110.00, 110.00, '2023-12-09 22:26:36', '2023-12-09 22:26:36', NULL, 1),
(31, 31, 1, 180.00, 180.00, '2023-12-09 22:28:29', '2023-12-09 22:28:29', NULL, 1),
(32, 32, 2, 690.00, 690.00, '2023-12-09 22:40:40', '2023-12-09 22:40:40', NULL, 1),
(33, 33, 3, 110.00, 110.00, '2023-12-09 23:13:06', '2023-12-09 23:13:06', NULL, 1);

--
-- Triggers `tbl_order_details`
--
DROP TRIGGER IF EXISTS `insert_record`;
DELIMITER $$
CREATE TRIGGER `insert_record` AFTER INSERT ON `tbl_order_details` FOR EACH ROW INSERT INTO tbl_order_records (transaction_id, remarks, amount)
VALUES (NEW.transaction_id, 'Order made', (NEW.total_amount - NEW.balance))
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update_record`;
DELIMITER $$
CREATE TRIGGER `update_record` AFTER UPDATE ON `tbl_order_details` FOR EACH ROW INSERT INTO tbl_order_records (transaction_id, remarks, amount)
VALUES (NEW.transaction_id, 'Order update', (NEW.total_amount - NEW.balance))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_records`
--

DROP TABLE IF EXISTS `tbl_order_records`;
CREATE TABLE `tbl_order_records` (
  `record_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order_records`
--

INSERT INTO `tbl_order_records` (`record_id`, `transaction_id`, `remarks`, `amount`, `created_at`, `deleted_at`) VALUES
(10, 13, 'Order made', 0.00, '2023-12-09 11:23:10', NULL),
(11, 14, 'Order made', 0.00, '2023-12-09 11:23:51', NULL),
(12, 15, 'Order made', 0.00, '2023-12-09 11:26:33', NULL),
(14, 17, 'Order made', 0.00, '2023-12-09 11:30:00', NULL),
(15, 18, 'Order made', 0.00, '2023-12-09 11:31:24', NULL),
(16, 19, 'Order made', 0.00, '2023-12-09 11:51:29', NULL),
(17, 20, 'Order made', 0.00, '2023-12-09 12:00:50', NULL),
(18, 21, 'Order made', 0.00, '2023-12-09 12:01:09', NULL),
(19, 22, 'Order made', 0.00, '2023-12-09 12:01:11', NULL),
(20, 23, 'Order made', 0.00, '2023-12-09 12:10:08', NULL),
(21, 24, 'Order made', 0.00, '2023-12-09 16:27:23', NULL),
(22, 15, 'Order update', 575.00, '2023-12-09 21:37:45', NULL),
(23, 14, 'Order update', 575.00, '2023-12-09 21:38:30', NULL),
(24, 25, 'Order made', 0.00, '2023-12-09 21:40:25', NULL),
(25, 26, 'Order made', 0.00, '2023-12-09 21:49:24', NULL),
(26, 27, 'Order made', 0.00, '2023-12-09 21:51:53', NULL),
(27, 28, 'Order made', 0.00, '2023-12-09 21:55:24', NULL),
(28, 29, 'Order made', 0.00, '2023-12-09 21:58:01', NULL),
(29, 30, 'Order made', 0.00, '2023-12-09 22:26:36', NULL),
(30, 31, 'Order made', 0.00, '2023-12-09 22:28:29', NULL),
(31, 32, 'Order made', 0.00, '2023-12-09 22:40:40', NULL),
(32, 33, 'Order made', 0.00, '2023-12-09 23:13:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_method`
--

DROP TABLE IF EXISTS `tbl_payment_method`;
CREATE TABLE `tbl_payment_method` (
  `mop_id` int(11) NOT NULL,
  `payment_name` varchar(50) NOT NULL,
  `isAvailable` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_payment_method`
--

INSERT INTO `tbl_payment_method` (`mop_id`, `payment_name`, `isAvailable`, `created_at`, `modified_at`, `deleted_at`) VALUES
(1, 'Cash On Delivery', 0, '2023-12-02 19:47:21', '2023-12-02 19:47:21', NULL),
(2, 'Credit Card/Debit Card', 0, '2023-12-02 19:47:21', '2023-12-02 19:47:21', NULL),
(3, 'Gcash', 0, '2023-12-02 19:47:21', '2023-12-02 19:47:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

DROP TABLE IF EXISTS `tbl_product`;
CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_description` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `category_id`, `product_name`, `product_description`, `price`, `image_path`, `created_at`, `modified_at`, `deleted_at`) VALUES
(1, 3, 'HugSiLog', 'Hungarian Hotdog, Sinangag, Itlog', 110.00, '../../public/assets/hugsilog.jpg', '2023-12-02 20:18:59', '2023-12-02 20:18:59', NULL),
(2, 4, 'Chicken Teriyaki', 'Chicken Teriyaki', 175.00, '../../public/assets/chickenteriyaki.jpg', '2023-12-02 20:19:57', '2023-12-02 20:19:57', NULL),
(3, 1, 'Pork Tonkatsu', 'Pork Tonkatsu', 180.00, '../../public/assets/porktonkatsu.jpg', '2023-12-02 20:20:40', '2023-12-02 20:20:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_featured`
--

DROP TABLE IF EXISTS `tbl_product_featured`;
CREATE TABLE `tbl_product_featured` (
  `featureID` int(11) NOT NULL,
  `feature_slot` enum('1','2','3','4','5') NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product_featured`
--

INSERT INTO `tbl_product_featured` (`featureID`, `feature_slot`, `product_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', 1, '2023-12-05 16:27:17', '2023-12-05 16:27:17', NULL),
(2, '2', 3, '2023-12-05 16:32:19', '2023-12-05 16:32:19', NULL),
(3, '3', 2, '2023-12-05 16:32:30', '2023-12-05 16:32:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 2,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(10) NOT NULL DEFAULT substr(md5(rand()),1,10),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `role_id`, `email`, `username`, `password`, `salt`, `created_at`, `modified_at`, `deleted_at`) VALUES
(1, 1, NULL, 'admin', 'f83e14b75dffaf0bb6fe1f133221a748e59fce57d3cdcd154743fc02d83d831b', '3b07e1fd3d', '2023-12-02 20:04:53', '2023-12-02 20:04:53', NULL),
(2, 2, 'emjayrongavilla@gmail.com', 'emjay6113', '1e28bede6f859dce236509932467c2161c25e833e5ac780baf51b9e10380c061', '7ab908c78c', '2023-12-02 20:23:29', '2023-12-02 20:23:29', NULL),
(3, 2, '21-4398@gmail.com', 'LEA994', 'd737525fafa1aa83d304d024fa60e5b15c65c83e5165f08db302e14af31a8e63', 'BGgRls0MKx', '2023-12-09 01:31:56', '2023-12-09 01:31:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_role`
--

DROP TABLE IF EXISTS `tbl_user_role`;
CREATE TABLE `tbl_user_role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user_role`
--

INSERT INTO `tbl_user_role` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_availableproducts`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `view_availableproducts`;
CREATE TABLE `view_availableproducts` (
`ID` int(11)
,`Product Name` varchar(50)
,`Description` varchar(50)
,`Category` varchar(50)
,`Price` decimal(10,2)
,`image_path` varchar(255)
,`created_at` datetime
,`modified_at` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_customer_address`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `view_customer_address`;
CREATE TABLE `view_customer_address` (
`ID` int(11)
,`customer_id` int(11)
,`firstname` varchar(50)
,`lastname` varchar(50)
,`phone` varchar(50)
,`email` varchar(255)
,`street_number` varchar(255)
,`building_no` varchar(255)
,`barangay` varchar(50)
,`municipality` varchar(50)
,`postal_code` varchar(10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_customer_cart`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `view_customer_cart`;
CREATE TABLE `view_customer_cart` (
`cart_id` int(11)
,`customer_id` int(11)
,`product_id` int(11)
,`product_name` varchar(50)
,`price` decimal(10,2)
,`quantity` int(11)
,`cart_total` decimal(20,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_customer_order`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `view_customer_order`;
CREATE TABLE `view_customer_order` (
`product_id` int(11)
,`image_path` varchar(255)
,`product_name` varchar(50)
,`price` decimal(20,2)
,`quantity` int(11)
,`customer_id` int(11)
,`order_id` int(11)
,`order_status` enum('Preparing','Pending','Shipping','Delivered','Cancelled','Recieved')
,`created_at` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_featured_products`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `view_featured_products`;
CREATE TABLE `view_featured_products` (
`Slot` enum('1','2','3','4','5')
,`ProductName` varchar(50)
,`Price` decimal(10,2)
,`image_path` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_user_customer`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `view_user_customer`;
CREATE TABLE `view_user_customer` (
`user_id` int(11)
,`username` varchar(50)
,`email` varchar(255)
,`password` varchar(255)
,`salt` varchar(10)
,`role_name` varchar(50)
,`customerid` int(11)
,`CustomerName` varchar(101)
);

-- --------------------------------------------------------

--
-- Structure for view `view_availableproducts`
--
DROP TABLE IF EXISTS `view_availableproducts`;

DROP VIEW IF EXISTS `view_availableproducts`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_availableproducts`  AS SELECT `pdt`.`product_id` AS `ID`, `pdt`.`product_name` AS `Product Name`, `pdt`.`product_description` AS `Description`, `ctg`.`category_name` AS `Category`, `pdt`.`price` AS `Price`, `pdt`.`image_path` AS `image_path`, `pdt`.`created_at` AS `created_at`, `pdt`.`modified_at` AS `modified_at` FROM (`tbl_product` `pdt` join `tbl_category` `ctg` on(`pdt`.`category_id` = `ctg`.`category_id`)) WHERE `pdt`.`deleted_at` is null ;

-- --------------------------------------------------------

--
-- Structure for view `view_customer_address`
--
DROP TABLE IF EXISTS `view_customer_address`;

DROP VIEW IF EXISTS `view_customer_address`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_customer_address`  AS SELECT `adr`.`address_id` AS `ID`, `ctm`.`customer_id` AS `customer_id`, `ctm`.`firstname` AS `firstname`, `ctm`.`lastname` AS `lastname`, `ctm`.`phone` AS `phone`, `usr`.`email` AS `email`, `adr`.`street_number` AS `street_number`, `adr`.`building_no` AS `building_no`, `adr`.`barangay` AS `barangay`, `adr`.`municipality` AS `municipality`, `adr`.`postal_code` AS `postal_code` FROM ((`tbl_customer_address` `adr` join `tbl_customer` `ctm` on(`adr`.`customer_id` = `ctm`.`customer_id`)) join `tbl_user` `usr` on(`usr`.`user_id` = `ctm`.`user_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_customer_cart`
--
DROP TABLE IF EXISTS `view_customer_cart`;

DROP VIEW IF EXISTS `view_customer_cart`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_customer_cart`  AS SELECT `ctc`.`cart_id` AS `cart_id`, `ctc`.`customer_id` AS `customer_id`, `pdt`.`product_id` AS `product_id`, `pdt`.`product_name` AS `product_name`, `pdt`.`price` AS `price`, `ctc`.`quantity` AS `quantity`, `pdt`.`price`* `ctc`.`quantity` AS `cart_total` FROM (`tbl_customer_cart` `ctc` join `tbl_product` `pdt` on(`ctc`.`product_id` = `pdt`.`product_id`)) WHERE `ctc`.`deleted_at` is null ;

-- --------------------------------------------------------

--
-- Structure for view `view_customer_order`
--
DROP TABLE IF EXISTS `view_customer_order`;

DROP VIEW IF EXISTS `view_customer_order`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_customer_order`  AS SELECT `pdt`.`product_id` AS `product_id`, `pdt`.`image_path` AS `image_path`, `pdt`.`product_name` AS `product_name`, `pdt`.`price`* `inv`.`quantity` AS `price`, `inv`.`quantity` AS `quantity`, `cst`.`customer_id` AS `customer_id`, `inv`.`order_id` AS `order_id`, `odr`.`order_status` AS `order_status`, `odr`.`created_at` AS `created_at` FROM (((`tbl_product` `pdt` join `tbl_invoice` `inv` on(`pdt`.`product_id` = `inv`.`product_id`)) join `tbl_order` `odr` on(`inv`.`order_id` = `odr`.`order_id`)) join `tbl_customer` `cst` on(`odr`.`customer_id` = `cst`.`customer_id`)) WHERE `odr`.`deleted_at` is null ;

-- --------------------------------------------------------

--
-- Structure for view `view_featured_products`
--
DROP TABLE IF EXISTS `view_featured_products`;

DROP VIEW IF EXISTS `view_featured_products`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_featured_products`  AS SELECT `ftp`.`feature_slot` AS `Slot`, `pdt`.`product_name` AS `ProductName`, `pdt`.`price` AS `Price`, `pdt`.`image_path` AS `image_path` FROM (`tbl_product_featured` `ftp` join `tbl_product` `pdt` on(`ftp`.`product_id` = `pdt`.`product_id`)) WHERE `pdt`.`deleted_at` is null ;

-- --------------------------------------------------------

--
-- Structure for view `view_user_customer`
--
DROP TABLE IF EXISTS `view_user_customer`;

DROP VIEW IF EXISTS `view_user_customer`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_user_customer`  AS SELECT `ctm`.`user_id` AS `user_id`, `ctm`.`username` AS `username`, `ctm`.`email` AS `email`, `ctm`.`password` AS `password`, `ctm`.`salt` AS `salt`, `usr`.`role_name` AS `role_name`, `ctr`.`customer_id` AS `customerid`, concat(`ctr`.`firstname`,' ',`ctr`.`lastname`) AS `CustomerName` FROM ((`tbl_user` `ctm` join `tbl_user_role` `usr` on(`ctm`.`role_id` = `usr`.`role_id`)) join `tbl_customer` `ctr` on(`ctr`.`user_id` = `ctm`.`user_id`)) WHERE `ctm`.`deleted_at` is null AND `ctm`.`role_id` = 2 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_customer_address`
--
ALTER TABLE `tbl_customer_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `tbl_customer_cart`
--
ALTER TABLE `tbl_customer_cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `mop_id` (`mop_id`),
  ADD KEY `fk_address_id` (`address_id`);

--
-- Indexes for table `tbl_order_records`
--
ALTER TABLE `tbl_order_records`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `tbl_payment_method`
--
ALTER TABLE `tbl_payment_method`
  ADD PRIMARY KEY (`mop_id`),
  ADD UNIQUE KEY `payment_name` (`payment_name`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tbl_product_featured`
--
ALTER TABLE `tbl_product_featured`
  ADD PRIMARY KEY (`featureID`),
  ADD UNIQUE KEY `feature_slot` (`feature_slot`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_customer_address`
--
ALTER TABLE `tbl_customer_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_customer_cart`
--
ALTER TABLE `tbl_customer_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_order_records`
--
ALTER TABLE `tbl_order_records`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_payment_method`
--
ALTER TABLE `tbl_payment_method`
  MODIFY `mop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_product_featured`
--
ALTER TABLE `tbl_product_featured`
  MODIFY `featureID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD CONSTRAINT `tbl_customer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`);

--
-- Constraints for table `tbl_customer_address`
--
ALTER TABLE `tbl_customer_address`
  ADD CONSTRAINT `tbl_customer_address_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`customer_id`);

--
-- Constraints for table `tbl_customer_cart`
--
ALTER TABLE `tbl_customer_cart`
  ADD CONSTRAINT `tbl_customer_cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`),
  ADD CONSTRAINT `tbl_customer_cart_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`customer_id`);

--
-- Constraints for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD CONSTRAINT `tbl_invoice_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `tbl_order` (`order_id`),
  ADD CONSTRAINT `tbl_invoice_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`);

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`customer_id`);

--
-- Constraints for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD CONSTRAINT `fk_address_id` FOREIGN KEY (`address_id`) REFERENCES `tbl_customer_address` (`address_id`),
  ADD CONSTRAINT `tbl_order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `tbl_order` (`order_id`),
  ADD CONSTRAINT `tbl_order_details_ibfk_2` FOREIGN KEY (`mop_id`) REFERENCES `tbl_payment_method` (`mop_id`);

--
-- Constraints for table `tbl_order_records`
--
ALTER TABLE `tbl_order_records`
  ADD CONSTRAINT `tbl_order_records_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `tbl_order_details` (`transaction_id`);

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`category_id`);

--
-- Constraints for table `tbl_product_featured`
--
ALTER TABLE `tbl_product_featured`
  ADD CONSTRAINT `tbl_product_featured_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`);

--
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `tbl_user_role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
