-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 12, 2020 at 09:46 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `R2U`
--

-- --------------------------------------------------------

--
-- Table structure for table `Account`
--

CREATE TABLE `Account` (
  `account_id` varchar(8) NOT NULL,
  `account_type` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(15) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Account`
--

INSERT INTO `Account` (`account_id`, `account_type`, `name`, `contact_no`, `email`, `password`, `status`) VALUES
('A0000001', 'Service Provider', 'Starship', '0123456789', 'star@gmail.com', '12121212', 'Active'),
('A0000002', 'Service Provider', 'Johnny\'s', '0138465723', 'john@gmail.com', '13131313', 'Active'),
('AA000001', 'Runner', 'Candy', '0129384532', 'can@gmail.com', '11111111', 'Active'),
('AAAA0001', 'Customer', 'Issac L', '0162538432', 'issac@gmail.com', '12341234', 'Active'),
('ADMIN000', 'Admin', 'R2U Administrator', '0126644716', 'r2u@gmail.com', '12121212', 'Active'),
('ADMIN001', 'Admin', 'Sub Admin 001', '123', 'r2u1@gmail.com', '12121212', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `Cart`
--

CREATE TABLE `Cart` (
  `c_account_id` varchar(8) NOT NULL,
  `item_id` varchar(12) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE `Customer` (
  `account_id` varchar(8) NOT NULL,
  `card_no` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Delivery`
--

CREATE TABLE `Delivery` (
  `order_id` varchar(12) NOT NULL,
  `r_account_id` varchar(8) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Delivery`
--

INSERT INTO `Delivery` (`order_id`, `r_account_id`, `date`) VALUES
('AA00AA00AA01', 'AA000001', '12/07/2020'),
('AA00AA00AA02', 'AA000001', '12/07/2020');

-- --------------------------------------------------------

--
-- Table structure for table `Item List`
--

CREATE TABLE `Item List` (
  `item_id` varchar(12) NOT NULL,
  `sp_account_id` varchar(8) NOT NULL,
  `item_type` varchar(10) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_detail` varchar(255) NOT NULL,
  `item_price` float NOT NULL,
  `item_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Item List`
--

INSERT INTO `Item List` (`item_id`, `sp_account_id`, `item_type`, `item_name`, `item_detail`, `item_price`, `item_status`) VALUES
('A0000001AA01', 'A0000001', 'Food', 'Crackers', 'Crispy Crackers', 12, 'Available'),
('A0000002AA01', 'A0000002', 'Food', 'Johnny Biscuit', 'Chocolate cookie', 12, 'Available'),
('A0000002AA02', 'A0000002', 'Pet Assist', 'Rubber Bones', 'For dog of all sizes', 23, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `Ordered Item`
--

CREATE TABLE `Ordered Item` (
  `order_id` varchar(12) NOT NULL,
  `item_id` varchar(12) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Ordered Item`
--

INSERT INTO `Ordered Item` (`order_id`, `item_id`, `quantity`) VALUES
('AA00AA00AA01', 'A0000001AA01', 4),
('AA00AA00AA02', 'A0000002AA01', 2),
('AA00AA00AA03', 'A0000002AA02', 2);

-- --------------------------------------------------------

--
-- Table structure for table `Order List`
--

CREATE TABLE `Order List` (
  `order_id` varchar(12) NOT NULL,
  `c_account_id` varchar(8) NOT NULL,
  `pay_method` varchar(12) NOT NULL,
  `sp_account_id` varchar(8) NOT NULL,
  `dropoff_location` varchar(100) NOT NULL,
  `totalprice` float NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Order List`
--

INSERT INTO `Order List` (`order_id`, `c_account_id`, `pay_method`, `sp_account_id`, `dropoff_location`, `totalprice`, `status`) VALUES
('AA00AA00AA01', 'AAAA0001', 'Paypal', 'A0000001', 'Kuantan', 82, 'Completed'),
('AA00AA00AA02', 'AAAA0001', 'Paypal', 'A0000002', 'Kuantan', 82, 'Completed'),
('AA00AA00AA03', 'AAAA0001', 'Paypal', 'A0000002', 'Kuala Lumpur', 56, 'Requesting');

-- --------------------------------------------------------

--
-- Table structure for table `Runner`
--

CREATE TABLE `Runner` (
  `account_id` varchar(8) NOT NULL,
  `ic` varchar(15) NOT NULL,
  `profile_pic` varchar(20) NOT NULL,
  `license` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Runner`
--

INSERT INTO `Runner` (`account_id`, `ic`, `profile_pic`, `license`) VALUES
('AA000001', '960415074586', 'AA000001.jpg', 'L_AA000001.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `Service Provider`
--

CREATE TABLE `Service Provider` (
  `account_id` varchar(8) NOT NULL,
  `ssmNo` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `logo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Service Provider`
--

INSERT INTO `Service Provider` (`account_id`, `ssmNo`, `address`, `logo`) VALUES
('A0000001', '123456789', 'Kuantan', 'A0000001.png'),
('A0000002', '8473920384', 'Gambang', 'A0000002.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Account`
--
ALTER TABLE `Account`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `Cart`
--
ALTER TABLE `Cart`
  ADD PRIMARY KEY (`c_account_id`,`item_id`),
  ADD KEY `c_account_id` (`c_account_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `Customer`
--
ALTER TABLE `Customer`
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `Delivery`
--
ALTER TABLE `Delivery`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `r_account_id` (`r_account_id`);

--
-- Indexes for table `Item List`
--
ALTER TABLE `Item List`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `p_account_id` (`sp_account_id`);

--
-- Indexes for table `Ordered Item`
--
ALTER TABLE `Ordered Item`
  ADD PRIMARY KEY (`order_id`,`item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `Order List`
--
ALTER TABLE `Order List`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `c_account_id` (`c_account_id`),
  ADD KEY `sp_account_id` (`sp_account_id`);

--
-- Indexes for table `Runner`
--
ALTER TABLE `Runner`
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `Service Provider`
--
ALTER TABLE `Service Provider`
  ADD KEY `account_id` (`account_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Cart`
--
ALTER TABLE `Cart`
  ADD CONSTRAINT `Cart_ibfk_1` FOREIGN KEY (`c_account_id`) REFERENCES `Account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Cart_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `Item List` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Customer`
--
ALTER TABLE `Customer`
  ADD CONSTRAINT `Customer_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `Account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Delivery`
--
ALTER TABLE `Delivery`
  ADD CONSTRAINT `Delivery_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `Order List` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Delivery_ibfk_2` FOREIGN KEY (`r_account_id`) REFERENCES `Account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Item List`
--
ALTER TABLE `Item List`
  ADD CONSTRAINT `Item List_ibfk_1` FOREIGN KEY (`sp_account_id`) REFERENCES `Account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Ordered Item`
--
ALTER TABLE `Ordered Item`
  ADD CONSTRAINT `Ordered Item_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `Order List` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Ordered Item_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `Item List` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Order List`
--
ALTER TABLE `Order List`
  ADD CONSTRAINT `Order List_ibfk_1` FOREIGN KEY (`c_account_id`) REFERENCES `Account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Order List_ibfk_2` FOREIGN KEY (`sp_account_id`) REFERENCES `Account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Runner`
--
ALTER TABLE `Runner`
  ADD CONSTRAINT `Runner_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `Account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Service Provider`
--
ALTER TABLE `Service Provider`
  ADD CONSTRAINT `Service Provider_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `Account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
