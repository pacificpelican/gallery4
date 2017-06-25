-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 25, 2017 at 11:23 PM
-- Server version: 5.6.35
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallery4`
--

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

--
-- Dumping data for table `gallerys`
--

INSERT INTO `gallerys` (`id`, `name`, `description`, `galleryscol`, `created_at`, `updated_at`, `users_id`, `meta`, `type`, `is_image`, `file_url`, `file_name`, `extension`, `uploaders_id`, `customers_id`, `title`) VALUES
(1, 'am', NULL, NULL, '2017-06-04 21:18:22', '2017-06-04 21:18:22', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(2, NULL, NULL, NULL, '2017-06-04 21:27:04', '2017-06-04 21:27:04', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'new gallery 2'),
(3, 'g 3', NULL, NULL, '2017-06-04 21:28:28', '2017-06-04 21:28:28', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(4, NULL, NULL, NULL, '2017-06-04 21:30:07', '2017-06-04 21:30:07', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'gallery 4'),
(5, '0', NULL, NULL, '2017-06-24 09:24:51', '2017-06-24 09:24:51', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(6, '1-000 9u09', NULL, NULL, '2017-06-25 22:37:12', '2017-06-25 22:37:12', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(7, 'ntest', NULL, NULL, '2017-06-25 23:05:07', '2017-06-25 23:05:07', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(8, NULL, NULL, NULL, '2017-06-25 23:08:26', '2017-06-25 23:08:26', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'cl'),
(9, NULL, NULL, NULL, '2017-06-25 23:09:20', '2017-06-25 23:09:20', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'n2'),
(10, '8', NULL, NULL, '2017-06-25 23:10:10', '2017-06-25 23:10:10', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(11, 'k this is nenqw9-nc- 90j', NULL, NULL, '2017-06-25 23:12:40', '2017-06-25 23:12:40', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL);

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

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `users_id`, `page`, `meta`, `created_at`, `updated_at`, `title`, `alias`) VALUES
(1, 1, 'duz it still werk', NULL, '2017-06-25 23:18:33', '2017-06-25 23:18:33', 'werk', 'werk');

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

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `file_name`, `file_url`, `description`, `created_at`, `updated_at`, `title`, `meta`, `is_image`, `file_type`, `users_id`, `gallerys_id`, `photo_title`, `extension`, `uploaders_id`, `customers_id`, `thumbnail_name`, `thumbnail_url`) VALUES
(1, 'am2y10Un1zHuOdtxdc9FO.XPj9AuF9X2g9ttC83rhlM4IgwzD1G01f3nLq.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/am2y10Un1zHuOdtxdc9FO.XPj9AuF9X2g9ttC83rhlM4IgwzD1G01f3nLq.png', NULL, '2017-06-04 21:18:22', '2017-06-04 21:18:22', NULL, NULL, '1', '.png', 1, 0, 'am', '.png', NULL, 0, 'am.png', NULL),
(2, 'new-gallery-2.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/new-gallery-2.png', NULL, '2017-06-04 21:27:04', '2017-06-04 21:27:04', NULL, NULL, '1', '.png', 1, 2, 'new gallery 2', '.png', NULL, NULL, NULL, NULL),
(3, 'new-gallery-22.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/new-gallery-22.png', NULL, '2017-06-04 21:27:05', '2017-06-04 21:27:05', NULL, NULL, '1', '.png', 1, 2, 'new gallery 2 2', '.png', NULL, NULL, NULL, NULL),
(4, 'g-32y10FDJYgSaa50aNVBfKA5R8O9MRl2xErXoVxDoE0qv65z2FKrO0Xau.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/g-32y10FDJYgSaa50aNVBfKA5R8O9MRl2xErXoVxDoE0qv65z2FKrO0Xau.png', NULL, '2017-06-04 21:28:28', '2017-06-04 21:28:28', NULL, NULL, '1', '.png', 1, 0, 'g-3', '.png', NULL, 1, 'g-3.png', NULL),
(5, 'g-322y10ChhjbWXrLhgrr2w43hBZj.juS1VGGjhPhV8OtGzpunZd.9x93fbAO.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/g-322y10ChhjbWXrLhgrr2w43hBZj.juS1VGGjhPhV8OtGzpunZd.9x93fbAO.png', NULL, '2017-06-04 21:28:29', '2017-06-04 21:28:29', NULL, NULL, '1', '.png', 1, 0, 'g-3 2', '.png', NULL, 1, 'g-32.png', NULL),
(6, 'g-332y10sddAs3HVLhGDzoqNyHn5OggOzrxb4PrEvY4ghuvwZdoGJzWfiMxK.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/g-332y10sddAs3HVLhGDzoqNyHn5OggOzrxb4PrEvY4ghuvwZdoGJzWfiMxK.png', NULL, '2017-06-04 21:28:29', '2017-06-04 21:28:29', NULL, NULL, '1', '.png', 1, 0, 'g-3 3', '.png', NULL, 1, 'g-33.png', NULL),
(7, 'gallery-4.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/gallery-4.png', NULL, '2017-06-04 21:30:07', '2017-06-04 21:30:07', NULL, NULL, '1', '.png', 1, 4, 'gallery 4', '.png', NULL, NULL, NULL, NULL),
(8, 'gallery-42.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/gallery-42.png', NULL, '2017-06-04 21:30:09', '2017-06-04 21:30:09', NULL, NULL, '1', '.png', 1, 4, 'gallery 4 2', '.png', NULL, NULL, NULL, NULL),
(9, 'gallery-43.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/gallery-43.png', NULL, '2017-06-04 21:30:10', '2017-06-04 21:30:10', NULL, NULL, '1', '.png', 1, 4, 'gallery 4 3', '.png', NULL, NULL, NULL, NULL),
(10, '02y100FZEq6WQQ9UGcFdLIrFAAOhG3U8MldeFDhmc4g2ZPEkXKz1H1kOm.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/02y100FZEq6WQQ9UGcFdLIrFAAOhG3U8MldeFDhmc4g2ZPEkXKz1H1kOm.png', NULL, '2017-06-24 09:24:51', '2017-06-24 09:24:51', NULL, NULL, '1', '.png', 1, 0, '0', '.png', NULL, 1, '0.png', NULL),
(11, '1-000-9u092y106Gs2OpYQAPGc7AKEwIA0OfbIgBz1IpknGMmoEgxzb.fPnSe3yGY6.jpg', '/Users/dmck/Documents/Projects/gallery4/assets/files/1-000-9u092y106Gs2OpYQAPGc7AKEwIA0OfbIgBz1IpknGMmoEgxzb.fPnSe3yGY6.jpg', NULL, '2017-06-25 22:37:13', '2017-06-25 22:37:13', NULL, NULL, '1', '.jpg', 1, 0, '1-000-9u09', '.jpg', NULL, 0, '1-000-9u09.jpg', NULL),
(12, 'ntest2y10cfOm4yfJxsxRbSmarhedY.8m01IOuv2McV0JEauojaB4C5Tr9r8ze.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/ntest2y10cfOm4yfJxsxRbSmarhedY.8m01IOuv2McV0JEauojaB4C5Tr9r8ze.png', NULL, '2017-06-25 23:05:07', '2017-06-25 23:05:07', NULL, NULL, '1', '.png', 1, 0, 'ntest', '.png', NULL, 0, 'ntest.png', NULL),
(13, 'cl.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/cl.png', NULL, '2017-06-25 23:08:26', '2017-06-25 23:08:26', NULL, NULL, '1', '.png', 1, 8, 'cl', '.png', NULL, NULL, NULL, NULL),
(14, 'n2.jpg', '/Users/dmck/Documents/Projects/gallery4/assets/files/n2.jpg', NULL, '2017-06-25 23:09:20', '2017-06-25 23:09:20', NULL, NULL, '1', '.jpg', 1, 9, 'n2', '.jpg', NULL, NULL, NULL, NULL),
(15, '82y10XY7PrFKZZngn7GFczFwrLekSopens6byyQwt98qdJ3oRcJD6Zh6du.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/82y10XY7PrFKZZngn7GFczFwrLekSopens6byyQwt98qdJ3oRcJD6Zh6du.png', NULL, '2017-06-25 23:10:11', '2017-06-25 23:10:11', NULL, NULL, '1', '.png', 1, 0, '8', '.png', NULL, 0, '8.png', NULL),
(16, 'k-this-is-nenqw9-nc--90j2y10d3QHMxW0lGBiqOEDB3mYHOWeoYcHMKKTriz.TO0jRE24T5LwAat5..png', '/Users/dmck/Documents/Projects/gallery4/assets/files/k-this-is-nenqw9-nc--90j2y10d3QHMxW0lGBiqOEDB3mYHOWeoYcHMKKTriz.TO0jRE24T5LwAat5..png', NULL, '2017-06-25 23:12:40', '2017-06-25 23:12:40', NULL, NULL, '1', '.png', 1, 0, 'k-this-is-nenqw9-nc--90j', '.png', NULL, 0, 'k-this-is-nenqw9-nc--90j.png', NULL);

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

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `post`, `created_at`, `updated_at`, `created_at_epoch`, `notes`, `updated_at_epoch`, `podcast_url`) VALUES
(1, 'trivial', 'non-super-small length post to pass validations', '2017-05-30 04:30:26', '2017-05-30 04:30:26', 1496079026, NULL, 1496079026, ''),
(2, 'can u still blog?', 'k? is this enough characters?', '2017-06-25 23:21:48', '2017-06-25 23:21:48', 1498393308, NULL, 1498393308, '');

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

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `password`, `created_at`, `updated_at`, `name`, `URL`, `bio`, `facebook`, `twitter`, `instagram`, `api_key`, `created_at_epoch`, `updated_at_epoch`) VALUES
(1, 'danmck', 'd@danmckeown.info', '2558a34d4d20964ca1d272ab26ccce9511d880579593cd4c9e01ab91ed00f325', '2016-12-29 07:50:36', '2017-06-25 23:14:35', 'd', '', NULL, NULL, NULL, NULL, '3b91bd74d63298f3d0845267de891e25', 1482961836, 1498392875);

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

--
-- Dumping data for table `users_files`
--

INSERT INTO `users_files` (`id`, `users_id`, `meta`, `created_at`, `updated_at`, `file_name`, `file_url`, `description`, `size`, `title`, `is_image`) VALUES
(1, 1, NULL, '2017-06-25 23:18:53', '2017-06-25 23:18:53', 'Anal_Casting_Calls_4_EvilAngelVideo.pdf', '/Users/dmck/Documents/Projects/gallery4/assets/files/Anal_Casting_Calls_4_EvilAngelVideo.pdf', NULL, NULL, NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `users_levels`
--

CREATE TABLE `users_levels` (
  `id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_levels`
--

INSERT INTO `users_levels` (`id`, `users_id`, `level`) VALUES
(1, 1, 10);

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
-- Table structure for table `users_posts`
--

CREATE TABLE `users_posts` (
  `id` int(11) NOT NULL,
  `posts_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `is_archived` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_posts`
--

INSERT INTO `users_posts` (`id`, `posts_id`, `users_id`, `is_archived`) VALUES
(1, 1, 1, NULL),
(2, 2, 1, NULL);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
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
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_files`
--
ALTER TABLE `users_files`
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
-- Indexes for table `users_posts`
--
ALTER TABLE `users_posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gallerys`
--
ALTER TABLE `gallerys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_files`
--
ALTER TABLE `users_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_levels`
--
ALTER TABLE `users_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_links`
--
ALTER TABLE `users_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_posts`
--
ALTER TABLE `users_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
