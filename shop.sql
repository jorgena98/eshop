CREATE DATABASE  `shop`;
USE `shop`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(100) DEFAULT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0'
);


CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(100),
  `price` int(100),
  `image` varchar(250),
  `description` varchar(250),
  `quantity` int(100),
   `cat_id` int(100)
);

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` text,
  `image` varchar(250),
  `imageS3` varchar(250)
);

CREATE TABLE IF NOT EXISTS  `subscription` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `verify_token` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `created` datetime NOT NULL DEFAULT  current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `users` (`id`, `name`, `login`, `password`, `role`) VALUES
(1, 'Admin', 'admin@admin.com', '202cb962ac59075b964b07152d234b70', 1),
(2, 'Simple User', 'user@user.com', '202cb962ac59075b964b07152d234b70', 0);


   
CREATE TABLE IF NOT EXISTS `message` (
  `contact_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_message` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;


CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `total_price` float,
  `order_status` varchar(100),
  `created_at` datetime
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

CREATE TABLE IF NOT EXISTS `orders_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` float,
  `qty` int(11) NOT NULL,
  `total_price` double
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;
