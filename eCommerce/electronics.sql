-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2016 at 10:50 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `electronics`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(200) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `level` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `parent_id`, `level`) VALUES
(2, 'Mobile', NULL, 0),
(3, 'Laptop', NULL, 0),
(5, 'PC', NULL, 0),
(6, 'Camera', NULL, 0),
(7, 'Watches', NULL, 0),
(8, 'HP', 3, 1),
(10, 'Dell', 3, 1),
(11, 'HP-PC', 5, 1),
(12, 'Dell-PC', 5, 1),
(13, 'Canon', 6, 1),
(14, 'Sony', 6, 1),
(15, 'Samsung', 2, 1),
(16, 'Nokia', 2, 1),
(17, 'Casio', 7, 1),
(18, 'Omega', 7, 1),
(19, '', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `content`, `user_id`, `pro_id`) VALUES
(19, 'bad', 12, 12),
(20, 'good', 12, 18),
(21, 'Good', 18, 11),
(22, 'nice', 18, 18),
(23, 'bad', 12, 13),
(24, 'veryu', 12, 18),
(25, 'very', 18, 17);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `avail_quantity` int(4) NOT NULL,
  `total_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `pro_id`, `avail_quantity`, `total_price`) VALUES
(20, 12, 18, 6, 1260),
(21, 18, 11, 6, 37200),
(22, 18, 11, 6, 37200),
(23, 18, 18, 5, 1050),
(24, 18, 17, 12, 1560),
(25, 18, 17, 45, 5850),
(26, 18, 12, 4, 8000);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Sell_price` decimal(7,2) DEFAULT NULL,
  `Discount` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `cat_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `pro_name` varchar(255) DEFAULT NULL,
  `price` decimal(7,2) DEFAULT NULL,
  `avail_quantity` int(3) DEFAULT NULL,
  `writing_date` datetime DEFAULT NULL,
  `pro_desc` varchar(255) DEFAULT NULL,
  `pic_name` varchar(255) DEFAULT NULL,
  `offer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`cat_id`, `pro_id`, `pro_name`, `price`, `avail_quantity`, `writing_date`, `pro_desc`, `pic_name`, `offer`) VALUES
(16, 9, 'X2-Andoid', '1500.00', 45, NULL, 'Nokia X2 Dual SIM Android smartphone', 'X2-Nokia.jpg', 1125),
(8, 10, 'Note-Book', '4300.00', 14, NULL, 'laptop 2GB Ram, core i5, 500GB Hard', 'Daftar-Harga-Laptop-HP-Fitur-dan-Spesifikasi-Tipe-14-R201TX.jpg', 2795),
(10, 11, 'Latitude Dell', '6200.00', 24, NULL, 'laptop 2GB Ram, core i5, 500GB Hard', '1_37_384.jpg', 0),
(11, 12, 'Computer HP', '2000.00', 4, NULL, 'laptop 2GB Ram, core i5, 500GB Hard', 'acer-desktop-computer3.jpg', NULL),
(12, 13, 'Computer Dell', '1800.00', 2, NULL, 'laptop 2GB Ram, core i5, 500GB Hard', 'download.jpg', NULL),
(13, 14, 'Canon 620', '8900.00', 8, NULL, 'Canon EOS Rebel T6i (EOS 750D / Kiss X8i). Announced Feb ... Canon PowerShot ELPH 350 HS (IXUS 275 HS) ... Canon PowerShot ELPH 170 IS (IXUS 170).\r\n', 'canon.jpg', 3560),
(14, 15, 'Sony Cyper-Shot', '12000.00', 6, NULL, 'Browse through 4K & HD professional video cameras ', 'sony-cyper.jpg', 3240),
(15, 16, 'Grand Prime', '1370.00', 45, NULL, 'Features 3G, 5.0″ TFT capacitive touchscreen, 8 MP camera, Wi-Fi, GPS,', 'samsung-galaxy-grand-prime.jpg', NULL),
(17, 17, 'G-Shock', '130.00', 87, NULL, 'The EDIFICE is CASIO''s peak achievement in a metal analog watch', '71PXyslIUyL._UL1500_.jpg', NULL),
(18, 18, 'Nixgen', '210.00', 44, NULL, 'The EDIFICE is CASIO''s peak achievement in a metal analog watch', '2016-Omega-Watches-pricelist.jpg', NULL),
(8, 19, 'title', '0.00', 0, NULL, 'enter the description', '4', NULL),
(8, 20, 'title', '0.00', 0, NULL, 'enter the description', '4', NULL),
(8, 21, '', '0.00', 0, NULL, '', '4', NULL),
(8, 22, 'title', '0.00', 0, NULL, 'enter the description', '4', NULL),
(8, 23, '', '0.00', 0, NULL, '', '4', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `national_id` varchar(14) NOT NULL,
  `pic_name` varchar(255) NOT NULL,
  `role` int(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `user_name`, `password`, `national_id`, `pic_name`, `role`, `email`, `phone`) VALUES
(12, '<h2>sd</h2>', 'Hdeawy', 'Admin', '265a828469ed0d20583f869863987eb4dcbc73ed', '2147483647', 'image.jpg', 1, 'ahmedhdawy@azhar.edu.eg', 1142950885),
(18, 'Hesham', 'Saad', 'Hesham', '46e4b9e28cdc80a8c80160dcdbb0421780f8ae3a', '12345678902345', '011003E.JPG', 0, 'hesham@yahoo.com', 1235467887);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`pro_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
