-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2023 at 04:58 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `image` varchar(225) NOT NULL,
  `imageS3` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`, `image`, `imageS3`) VALUES
(1, 'Chair', 'icon1.png', 'cat-04.jpg'),
(2, 'Lamps', 'icon2.png', 'cat-05.jpg'),
(3, 'Vase', 'icon3.png', 'cat-06.jpg'),
(4, 'Clock', 'icon4.png', 'cat-05.jpg'),
(5, 'Table', 'icon5.png', 'cat-04.jpg'),
(6, 'Others', 'icon6.png', 'cat-06.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `contact_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`contact_id`, `fullname`, `subject`, `email`, `user_message`) VALUES
(2, 'Artemisa', 'Message 2', 'admin@admin.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi! Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!'),
(3, 'Ervisi', 'Message 3', 'admin1@admin.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi! Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!'),
(4, 'Ana', 'Refund', 'admin@admin.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi! Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!'),
(5, 'Anisa', 'Payment issues', 'anisa@gmail.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi! Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!'),
(7, 'Jorgena', 'Refund', 'jorgena123@gmail.com', 'Refund process information');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `total_price` float(6,2) NOT NULL DEFAULT 0.00,
  `order_status` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `address`, `total_price`, `order_status`, `created_at`) VALUES
(1, 'Jorgena', 'admin@admin.com', 'Rr.Siri Kodra,Tirane', 136.00, 'confirmed', '2022-12-25 13:31:27'),
(2, 'Artemisa', 'artemisa@gmail.com', 'Rr.Vaso Pasha,Tirane', 168.00, 'confirmed', '2022-12-25 13:32:15'),
(3, 'Ina', 'inashehu@gmail.com', 'Lgj.Pavaresia, Vlore', 375.00, 'confirmed', '2022-12-25 13:33:26'),
(4, 'Jorgena', 'jorgenashinjatari@gmail.com', 'Rr.Siri Kodra,Tirane', 112.00, 'confirmed', '2022-12-26 10:56:42'),
(5, 'Jorgena', 'admin@admin.com', 'Rr.Siri Kodra,Tirane', 180.00, 'confirmed', '2022-12-26 11:48:47'),
(6, 'Jorgena', 'admin@admin.com', 'Rr.Vaso Pasha,Tirane', 135.00, 'confirmed', '2022-12-27 10:14:47');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `product_price` float(6,2) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total_price` double(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_name`, `product_price`, `qty`, `total_price`) VALUES
(1, 1, 8, 'Wood chair', 34.00, 4, 136.00),
(2, 2, 1, 'Clock', 45.00, 2, 90.00),
(3, 2, 13, 'Chair', 78.00, 1, 78.00),
(4, 3, 23, 'Vase', 31.00, 1, 31.00),
(5, 3, 5, 'Wood clock', 89.00, 2, 178.00),
(6, 3, 26, 'Table', 45.00, 1, 45.00),
(7, 3, 33, 'Sofa', 121.00, 1, 121.00),
(8, 4, 20, 'Vase', 22.00, 1, 22.00),
(9, 4, 26, 'Table', 45.00, 2, 90.00),
(10, 5, 1, 'Clock', 45.00, 4, 180.00),
(11, 6, 1, 'Clock', 45.00, 3, 135.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` int(100) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `quantity` int(100) DEFAULT NULL,
  `description` text NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `image`, `quantity`, `description`, `cat_id`) VALUES
(1, 'Clock', 45, '19.jpg', 33, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 4),
(2, 'Wood Clock ', 78, '23.jpg', 23, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 4),
(3, 'Green clock', 34, '22.jpg', 67, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 4),
(4, 'Marble lock', 88, '15.png', 32, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 4),
(5, 'Wood clock', 89, '36.png', 15, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 4),
(7, 'Antique clock', 221, '23.jpg', 12, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 4),
(10, 'Chair', 62, '30.png', 45, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 1),
(11, 'Chair', 75, '6.png', 45, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 1),
(12, 'Black chair', 55, '21.jpg', 34, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 1),
(13, 'Chair', 78, '8.png', 22, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 1),
(14, 'Lamp', 343, '13.png', 22, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 2),
(15, 'Lamp', 35, '26.png', 34, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 2),
(16, 'Lamp', 35, '33.png', 23, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 2),
(17, 'Lamp', 67, '14.png', 32, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 2),
(18, 'Lamp', 45, '17.jpg', 38, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 2),
(19, 'Lamp', 55, '3.png', 34, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 2),
(20, 'Vase', 22, '12.png', 45, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 3),
(21, 'Vase', 12, '16.jpg', 34, ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 3),
(22, 'Vase', 34, '18.jpg', 55, ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 3),
(23, 'Vase', 31, '20.jpg', 43, ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 3),
(24, 'Vase', 33, '38.png', 23, ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 3),
(25, 'Vase', 22, '34.png', 32, ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 3),
(26, 'Table', 45, '41.jpg', 15, ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 5),
(27, 'Table', 67, '37.png', 32, ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 5),
(28, 'Table', 85, '7.png', 45, ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 5),
(29, 'Hourglass', 65, '35.png', 52, ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 6),
(30, 'Eiffel tower', 45, '28.png', 32, ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 6),
(31, 'Sofa', 79, '11.png', 23, ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 6),
(32, 'Sofa', 79, '8.png', 22, ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 6),
(33, 'Sofa', 121, '24.png', 45, ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 6),
(34, 'Sofa', 95, '9.png', 23, ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 6),
(35, 'Chair', 56, '6.png', 34, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quia, illum non optio consequatur eaque sunt iure excepturi illo molestiae quis ducimus hic perferendis atque dolorum! Esse perferendis consequuntur eligendi!', 1),
(37, 'Table', 23, '6.png', 23, 'Lorem ipsum', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `verify_token` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `email`, `verify_token`, `is_verified`, `created`) VALUES
(8, 'jcase.land@gmail.com', '229f1ae31d29b07391bdc6549f37bce1', 1, '2022-12-26 22:07:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `login` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `password`, `role`) VALUES
(1, 'Admin', 'admin@admin.com', '202cb962ac59075b964b07152d234b70', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `name` (`name`) USING HASH;

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
