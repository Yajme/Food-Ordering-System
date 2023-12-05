-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2023 at 10:41 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart_detail`
--

DROP TABLE IF EXISTS `tbl_cart_detail`;
CREATE TABLE `tbl_cart_detail` (
  `detail_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `address` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`customer_id`, `user_id`, `firstname`, `lastname`, `address`, `phone`, `created_at`, `modified_at`, `deleted_at`) VALUES
(1, 2, 'Emjay', 'Rongavilla', 'San Antonio', '0999328736', '2023-12-03 20:46:37', '2023-12-03 20:46:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_cart`
--

DROP TABLE IF EXISTS `tbl_customer_cart`;
CREATE TABLE `tbl_customer_cart` (
  `cart_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

DROP TABLE IF EXISTS `tbl_order`;
CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_status` enum('Preparing','Pending','Shipping','Delivered','Cancelled') NOT NULL DEFAULT 'Preparing',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_method`
--

DROP TABLE IF EXISTS `tbl_payment_method`;
CREATE TABLE `tbl_payment_method` (
  `mop_id` int(11) NOT NULL,
  `payment_name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_payment_method`
--

INSERT INTO `tbl_payment_method` (`mop_id`, `payment_name`, `created_at`, `modified_at`, `deleted_at`) VALUES
(1, 'Cash On Delivery', '2023-12-02 19:47:21', '2023-12-02 19:47:21', NULL),
(2, 'Credit Card/Debit Card', '2023-12-02 19:47:21', '2023-12-02 19:47:21', NULL),
(3, 'Gcash', '2023-12-02 19:47:21', '2023-12-02 19:47:21', NULL);

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
(2, 2, 'emjayrongavilla@gmail.com', 'emjay6113', '1e28bede6f859dce236509932467c2161c25e833e5ac780baf51b9e10380c061', '7ab908c78c', '2023-12-02 20:23:29', '2023-12-02 20:23:29', NULL);

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
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_user_customer`  AS SELECT `ctm`.`user_id` AS `user_id`, `ctm`.`username` AS `username`, `ctm`.`email` AS `email`, `ctm`.`password` AS `password`, `ctm`.`salt` AS `salt`, `usr`.`role_name` AS `role_name`, concat(`ctr`.`firstname`,' ',`ctr`.`lastname`) AS `CustomerName` FROM ((`tbl_user` `ctm` join `tbl_user_role` `usr` on(`ctm`.`role_id` = `usr`.`role_id`)) join `tbl_customer` `ctr` on(`ctr`.`user_id` = `ctm`.`user_id`)) WHERE `ctm`.`deleted_at` is null AND `ctm`.`role_id` = 2 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cart_detail`
--
ALTER TABLE `tbl_cart_detail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id` (`product_id`);

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
-- Indexes for table `tbl_customer_cart`
--
ALTER TABLE `tbl_customer_cart`
  ADD PRIMARY KEY (`cart_id`),
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
  ADD KEY `mop_id` (`mop_id`);

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
-- AUTO_INCREMENT for table `tbl_cart_detail`
--
ALTER TABLE `tbl_cart_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_customer_cart`
--
ALTER TABLE `tbl_customer_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_order_records`
--
ALTER TABLE `tbl_order_records`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_cart_detail`
--
ALTER TABLE `tbl_cart_detail`
  ADD CONSTRAINT `tbl_cart_detail_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `tbl_customer_cart` (`cart_id`),
  ADD CONSTRAINT `tbl_cart_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`);

--
-- Constraints for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD CONSTRAINT `tbl_customer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`);

--
-- Constraints for table `tbl_customer_cart`
--
ALTER TABLE `tbl_customer_cart`
  ADD CONSTRAINT `tbl_customer_cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`customer_id`);

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
