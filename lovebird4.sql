-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 27, 2016 at 09:27 AM
-- Server version: 5.6.33
-- PHP Version: 7.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lovebird4`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `appointment_date` varchar(255) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at_epoch` int(11) DEFAULT NULL,
  `updated_at_epoch` int(11) DEFAULT NULL,
  `start_epoch` int(11) DEFAULT NULL,
  `end_epoch` int(11) DEFAULT NULL,
  `meta` varchar(255) DEFAULT NULL,
  `appointment_date_data` datetime DEFAULT NULL,
  `appointment_meta` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `appointments_id` int(11) DEFAULT NULL,
  `packages_id` int(11) DEFAULT NULL,
  `payment` float DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at_epoch` int(11) DEFAULT NULL,
  `updated_at_epoch` int(11) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `meta` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `card_providers`
--

CREATE TABLE `card_providers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `meta` longtext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at_epoch` int(11) DEFAULT NULL,
  `updated_at_epoch` int(11) DEFAULT NULL,
  `URL` varchar(255) DEFAULT NULL,
  `description` longtext,
  `category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `card_providers`
--

INSERT INTO `card_providers` (`id`, `name`, `address`, `meta`, `created_at`, `updated_at`, `created_at_epoch`, `updated_at_epoch`, `URL`, `description`, `category`) VALUES
(3, 'Mastercard', NULL, NULL, '2016-02-11 06:47:58', '2016-02-11 06:47:58', 1455137278, 1455137278, '', 'major credit card', NULL),
(5, 'VISA', NULL, NULL, '2016-02-18 11:15:02', '2016-02-18 11:15:02', 1455758102, 1455758102, '', 'massive credit card provider', NULL),
(6, 'Discover Card', NULL, NULL, '2016-03-04 03:10:59', '2016-03-04 03:10:59', 1457025059, 1457025059, 'https://www.discover.com/', 'The credit card from Discover Financial.', NULL),
(7, 'American Express', NULL, NULL, '2016-03-04 03:11:36', '2016-03-04 03:11:36', 1457025096, 1457025096, '', 'A large financial company.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `products_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at_epoch` int(11) DEFAULT NULL,
  `updated_at_epoch` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `chat` longtext,
  `created_at` datetime DEFAULT NULL,
  `created_at_epoch` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_at_epoch` int(11) DEFAULT NULL,
  `meta` varchar(45) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `chatscol` varchar(45) DEFAULT NULL,
  `is_archived` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gallerys`
--

CREATE TABLE `gallerys` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` longtext,
  `galleryscol` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `meta` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `is_image` varchar(45) DEFAULT NULL,
  `file_url` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `extension` varchar(45) DEFAULT NULL,
  `uploaders_id` int(11) DEFAULT NULL,
  `customers_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id` int(11) NOT NULL,
  `URL` varchar(255) DEFAULT NULL,
  `description` longtext,
  `title` varchar(164) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `links_tags`
--

CREATE TABLE `links_tags` (
  `id` int(11) NOT NULL,
  `tags_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `users_links_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `payment_methods_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `delivery_type` varchar(45) DEFAULT NULL,
  `created_at_epoch` int(11) DEFAULT NULL,
  `address_1` varchar(255) DEFAULT NULL,
  `address_2` varchar(255) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `ZIP` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_at_epoch` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders_status`
--

CREATE TABLE `orders_status` (
  `id` int(11) NOT NULL,
  `orders_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `code` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `page` longtext,
  `meta` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `alias` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `card_providers_id` int(11) DEFAULT NULL,
  `card` longblob,
  `expiration_month` varchar(255) DEFAULT NULL,
  `expiration_year` varchar(45) DEFAULT NULL,
  `address_1` varchar(255) DEFAULT NULL,
  `address_2` varchar(255) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `ZIP` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at_epoch` int(11) DEFAULT NULL,
  `updated_at_epoch` int(11) DEFAULT NULL,
  `cvv` blob,
  `expires_at` datetime DEFAULT NULL,
  `digest` varchar(45) DEFAULT NULL,
  `meta` varchar(255) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_url` varchar(255) DEFAULT NULL,
  `description` longtext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `meta` varchar(45) DEFAULT NULL,
  `is_image` varchar(45) DEFAULT NULL,
  `file_type` varchar(45) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `gallerys_id` int(11) DEFAULT NULL,
  `photo_title` varchar(255) DEFAULT NULL,
  `extension` varchar(45) DEFAULT NULL,
  `uploaders_id` int(11) DEFAULT NULL,
  `customers_id` int(11) DEFAULT NULL,
  `thumbnail_name` varchar(45) DEFAULT NULL,
  `thumbnail_url` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `photos_cart`
--

CREATE TABLE `photos_cart` (
  `id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `photos_id` int(11) DEFAULT NULL,
  `meta` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at_epoch` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `photos_credits`
--

CREATE TABLE `photos_credits` (
  `id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `credits` int(11) DEFAULT NULL,
  `meta` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at_epoch` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `photos_orders`
--

CREATE TABLE `photos_orders` (
  `id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `subtotal` float DEFAULT NULL,
  `tax` float DEFAULT NULL,
  `total` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `photos_packages`
--

CREATE TABLE `photos_packages` (
  `id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at_epoch` int(11) DEFAULT NULL,
  `updated_at_epoch` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `meta` varchar(255) DEFAULT NULL,
  `photos_packagescol` varchar(45) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `prints` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `photos_purchases`
--

CREATE TABLE `photos_purchases` (
  `id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `photos_id` int(11) DEFAULT NULL,
  `meta` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `created_at_epoch` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

CREATE TABLE `portfolios` (
  `id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `stocks_portfolioscol` varchar(255) DEFAULT NULL,
  `meta` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `post` longtext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at_epoch` int(11) DEFAULT NULL,
  `notes` longtext,
  `updated_at_epoch` int(11) DEFAULT NULL,
  `podcast_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts_comments`
--

CREATE TABLE `posts_comments` (
  `id` int(11) NOT NULL,
  `posts_id` int(11) DEFAULT NULL,
  `users_id` varchar(45) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `meta` varchar(255) DEFAULT NULL,
  `users_posts_id` int(11) DEFAULT NULL,
  `posts_commentscol` varchar(45) DEFAULT NULL,
  `created_at_epoch` int(11) DEFAULT NULL,
  `updated_at_epoch` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts_tags`
--

CREATE TABLE `posts_tags` (
  `id` int(11) NOT NULL,
  `posts_id` int(11) DEFAULT NULL,
  `tags_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product` varchar(255) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `inventory` int(11) DEFAULT NULL,
  `digital_bool` varchar(45) DEFAULT NULL,
  `URL` longtext,
  `description` longtext,
  `photo_url` longtext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at_epoch` int(11) DEFAULT NULL,
  `updated_at_epoch` int(11) DEFAULT NULL,
  `meta` longtext,
  `UPC` varchar(45) DEFAULT NULL,
  `SKU` varchar(45) DEFAULT NULL,
  `product_hash` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products_photos`
--

CREATE TABLE `products_photos` (
  `id` int(11) NOT NULL,
  `products_id` int(11) DEFAULT NULL,
  `URL` varchar(255) DEFAULT NULL,
  `photo` longblob,
  `created_at` datetime DEFAULT NULL,
  `created_at_epoch` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_at_epoch` int(11) DEFAULT NULL,
  `photographer` varchar(255) DEFAULT NULL,
  `photographer_URL` varchar(255) DEFAULT NULL,
  `license` varchar(255) DEFAULT NULL,
  `photo_url` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products_reviews`
--

CREATE TABLE `products_reviews` (
  `id` int(11) NOT NULL,
  `products_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `review` longtext,
  `created_at` datetime DEFAULT NULL,
  `created_at_epoch` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products_suppliers`
--

CREATE TABLE `products_suppliers` (
  `id` int(11) NOT NULL,
  `products_id` int(11) DEFAULT NULL,
  `suppliers_id` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at_epoch` int(11) DEFAULT NULL,
  `updated_at_epoch` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `promo_codes`
--

CREATE TABLE `promo_codes` (
  `id` int(11) NOT NULL,
  `promo_code` int(11) DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `products_id` int(11) DEFAULT NULL,
  `meta` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_at_epoch` int(11) DEFAULT NULL,
  `good_until` datetime DEFAULT NULL,
  `good_until_epoch` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_at_epoch` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `public_chats`
--

CREATE TABLE `public_chats` (
  `id` int(11) NOT NULL,
  `chat` longtext,
  `users_id` int(11) DEFAULT NULL,
  `public_chatscol` varchar(45) DEFAULT NULL,
  `meta` varchar(45) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at_epoch` int(11) DEFAULT NULL,
  `updated_at_epoch` int(11) DEFAULT NULL,
  `is_archived` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `orders_id` int(11) DEFAULT NULL,
  `products_id` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_at_epoch` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL,
  `symbol` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(225) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `stocks_exchanges_id` varchar(45) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `bid` float DEFAULT NULL,
  `ask` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stocks_exchanges`
--

CREATE TABLE `stocks_exchanges` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `meta` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stocks_portfolios`
--

CREATE TABLE `stocks_portfolios` (
  `id` int(11) NOT NULL,
  `portfolios_id` int(11) DEFAULT NULL,
  `stocks_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `meta` varchar(45) DEFAULT NULL,
  `stocks_portfolioscol` varchar(255) DEFAULT NULL,
  `buy_price` float DEFAULT NULL,
  `buy_date` datetime DEFAULT NULL,
  `buy_date_user` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `supplier` varchar(255) DEFAULT NULL,
  `description` longtext,
  `URL` varchar(255) DEFAULT NULL,
  `meta` longtext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at_epoch` int(11) DEFAULT NULL,
  `updated_at_epoch` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `users_id` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tax_rate`
--

CREATE TABLE `tax_rate` (
  `id` int(11) NOT NULL,
  `rate` float DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tax_rate`
--

INSERT INTO `tax_rate` (`id`, `rate`, `created_at`, `updated_at`, `state`) VALUES
(1, 0.096, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) DEFAULT NULL COMMENT '	',
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `URL` varchar(255) DEFAULT NULL,
  `bio` longtext,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `api_key` varchar(255) DEFAULT NULL,
  `created_at_epoch` int(255) DEFAULT NULL,
  `updated_at_epoch` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users_chats`
--

CREATE TABLE `users_chats` (
  `id` int(11) NOT NULL,
  `users_to_id` int(11) DEFAULT NULL,
  `users_from_id` int(11) DEFAULT NULL,
  `chats_id` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at_epoch` int(11) DEFAULT NULL,
  `updated_at_epoch` int(11) DEFAULT NULL,
  `is_archived` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users_files`
--

CREATE TABLE `users_files` (
  `id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `meta` longtext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_url` varchar(255) DEFAULT NULL,
  `description` longtext,
  `size` float DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `is_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users_followers`
--

CREATE TABLE `users_followers` (
  `id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `followers_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `meta` longtext,
  `users_followerscol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users_friends`
--

CREATE TABLE `users_friends` (
  `id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `friends_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `meta` longtext,
  `users_friendscol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users_levels`
--

CREATE TABLE `users_levels` (
  `id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users_links`
--

CREATE TABLE `users_links` (
  `id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `links_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users_payments`
--

CREATE TABLE `users_payments` (
  `id` int(11) NOT NULL,
  `users_id` varchar(255) DEFAULT NULL,
  `orders_id` varchar(45) DEFAULT NULL,
  `payment_methods_id` varchar(45) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_at_epoch` int(11) DEFAULT NULL,
  `subtotal` float DEFAULT NULL,
  `tax_rate` float DEFAULT NULL,
  `meta` varchar(45) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users_posts`
--

CREATE TABLE `users_posts` (
  `id` int(11) NOT NULL,
  `posts_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `is_archived` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `card_providers`
--
ALTER TABLE `card_providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallerys`
--
ALTER TABLE `gallerys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `links_tags`
--
ALTER TABLE `links_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_status`
--
ALTER TABLE `orders_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos_cart`
--
ALTER TABLE `photos_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos_credits`
--
ALTER TABLE `photos_credits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos_orders`
--
ALTER TABLE `photos_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos_packages`
--
ALTER TABLE `photos_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos_purchases`
--
ALTER TABLE `photos_purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts_comments`
--
ALTER TABLE `posts_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts_tags`
--
ALTER TABLE `posts_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_photos`
--
ALTER TABLE `products_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_reviews`
--
ALTER TABLE `products_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_suppliers`
--
ALTER TABLE `products_suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo_codes`
--
ALTER TABLE `promo_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `public_chats`
--
ALTER TABLE `public_chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks_exchanges`
--
ALTER TABLE `stocks_exchanges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks_portfolios`
--
ALTER TABLE `stocks_portfolios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_rate`
--
ALTER TABLE `tax_rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_chats`
--
ALTER TABLE `users_chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_files`
--
ALTER TABLE `users_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_followers`
--
ALTER TABLE `users_followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_friends`
--
ALTER TABLE `users_friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_levels`
--
ALTER TABLE `users_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_links`
--
ALTER TABLE `users_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_payments`
--
ALTER TABLE `users_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_posts`
--
ALTER TABLE `users_posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `card_providers`
--
ALTER TABLE `card_providers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gallerys`
--
ALTER TABLE `gallerys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders_status`
--
ALTER TABLE `orders_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `photos_cart`
--
ALTER TABLE `photos_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `photos_credits`
--
ALTER TABLE `photos_credits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `photos_orders`
--
ALTER TABLE `photos_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `photos_packages`
--
ALTER TABLE `photos_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `photos_purchases`
--
ALTER TABLE `photos_purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts_comments`
--
ALTER TABLE `posts_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts_tags`
--
ALTER TABLE `posts_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products_photos`
--
ALTER TABLE `products_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products_reviews`
--
ALTER TABLE `products_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products_suppliers`
--
ALTER TABLE `products_suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `promo_codes`
--
ALTER TABLE `promo_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `public_chats`
--
ALTER TABLE `public_chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stocks_exchanges`
--
ALTER TABLE `stocks_exchanges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stocks_portfolios`
--
ALTER TABLE `stocks_portfolios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tax_rate`
--
ALTER TABLE `tax_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `users_chats`
--
ALTER TABLE `users_chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_files`
--
ALTER TABLE `users_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_followers`
--
ALTER TABLE `users_followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_friends`
--
ALTER TABLE `users_friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_levels`
--
ALTER TABLE `users_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users_links`
--
ALTER TABLE `users_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_payments`
--
ALTER TABLE `users_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_posts`
--
ALTER TABLE `users_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
