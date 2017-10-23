-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 23, 2017 at 07:45 AM
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
(11, 'k this is nenqw9-nc- 90j', NULL, NULL, '2017-06-25 23:12:40', '2017-06-25 23:12:40', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(12, 'nu test 8h qehv', NULL, NULL, '2017-06-26 01:46:08', '2017-06-26 01:46:08', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(13, 'nu gallery', NULL, NULL, '2017-06-26 08:35:25', '2017-06-26 08:35:25', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(14, 'new form 0 e8q0n', NULL, NULL, '2017-06-26 08:40:58', '2017-06-26 08:40:58', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(15, 'mu uh', NULL, NULL, '2017-06-26 09:05:19', '2017-06-26 09:05:19', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(16, 'pelican', NULL, NULL, '2017-08-06 22:30:39', '2017-08-06 22:30:39', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(17, 'Jessica', NULL, NULL, '2017-09-25 07:17:42', '2017-09-25 07:17:42', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(18, 'mountain scene via Unsplash', NULL, NULL, '2017-09-25 19:14:36', '2017-09-25 19:14:36', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(19, 'bongaroo', NULL, NULL, '2017-10-16 07:45:37', '2017-10-16 07:45:37', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(20, 'sample photos', NULL, NULL, '2017-10-23 05:24:05', '2017-10-23 05:24:05', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(21, 'new gallery', NULL, NULL, '2017-10-23 05:38:25', '2017-10-23 05:38:25', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(22, 'newer gallery', NULL, NULL, '2017-10-23 05:40:08', '2017-10-23 05:40:08', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(23, 'new pics', NULL, NULL, '2017-10-23 05:54:45', '2017-10-23 05:54:45', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(24, 'new pics', NULL, NULL, '2017-10-23 05:55:47', '2017-10-23 05:55:47', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(25, 'even newer gallery %@&', NULL, NULL, '2017-10-23 06:00:16', '2017-10-23 06:00:16', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(26, '2 more photos', NULL, NULL, '2017-10-23 07:38:53', '2017-10-23 07:38:53', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(27, 'nu stuff', NULL, NULL, '2017-10-23 07:42:16', '2017-10-23 07:42:16', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(28, 'wrv89h 9fh 9', NULL, NULL, '2017-10-23 07:43:56', '2017-10-23 07:43:56', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL);

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
(1, 1, 'duz it still werk', NULL, '2017-06-25 23:18:33', '2017-06-25 23:18:33', 'werk', 'werk'),
(2, 1, '<span class=\"djmblog_img_wrapper\"><a href=\"http://localhost:8888/image/bongaroo.jpg\"><img class=\"djmblog_image\" id=\"bongaroo\" src=\"http://localhost:8888/assets/files/bongaroo.jpg\" alt=\"bongaroo\"></span><span class=\"photo_caption\">bongaroo</a></span>', NULL, '2017-10-23 06:54:57', '2017-10-23 06:54:57', 'embed test', 'embed-test');

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
  `thumbnail_name` varchar(255) DEFAULT NULL,
  `thumbnail_url` varchar(255) DEFAULT NULL
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
(17, 'nu-test-8h-qehv2y10h4dsVimVul4Pp2xZd.o9FebdHhTy1GBVBpGBbeNnnL7fPrlP.F4ly.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/nu-test-8h-qehv2y10h4dsVimVul4Pp2xZd.o9FebdHhTy1GBVBpGBbeNnnL7fPrlP.F4ly.png', NULL, '2017-06-26 01:46:08', '2017-06-26 01:46:08', NULL, NULL, '1', '.png', 1, 0, 'nu-test-8h-qehv', '.png', NULL, 0, 'nu-test-8h-qehv.png', NULL),
(18, 'nu-test-8h-qehv22y10KKkYGv18cQw2xeniAIN8.OBXX1umFnJRYJkjWjWryNmEevIPXNG2.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/nu-test-8h-qehv22y10KKkYGv18cQw2xeniAIN8.OBXX1umFnJRYJkjWjWryNmEevIPXNG2.png', NULL, '2017-06-26 01:46:09', '2017-06-26 01:46:09', NULL, NULL, '1', '.png', 1, 0, 'nu-test-8h-qehv 2', '.png', NULL, 0, 'nu-test-8h-qehv2.png', NULL),
(20, 'nu-gallery2y10qrzF9pHw58cWDwTuxTZObYjt.MFtmL5ubt0eiiLUcsXLXN0jbFy.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/nu-gallery2y10qrzF9pHw58cWDwTuxTZObYjt.MFtmL5ubt0eiiLUcsXLXN0jbFy.png', NULL, '2017-06-26 08:35:25', '2017-06-26 08:35:25', NULL, NULL, '1', '.png', 1, 13, 'nu-gallery', '.png', NULL, 0, 'nu-gallery.png', NULL),
(21, 'nu-gallery22y10b7ToXKsavkUviBlf9Rb4i.aOR6m3FDqiW9ngTkzgsTl9lPSRDbsPu.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/nu-gallery22y10b7ToXKsavkUviBlf9Rb4i.aOR6m3FDqiW9ngTkzgsTl9lPSRDbsPu.png', NULL, '2017-06-26 08:35:26', '2017-06-26 08:35:26', NULL, NULL, '1', '.png', 1, 13, 'nu-gallery 2', '.png', NULL, 0, 'nu-gallery2.png', NULL),
(22, 'nu-gallery32y10FilTbcgMqbr9logASzGeuglTf1OFT0ePiY4RzIsl0XywFD3qodi.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/nu-gallery32y10FilTbcgMqbr9logASzGeuglTf1OFT0ePiY4RzIsl0XywFD3qodi.png', NULL, '2017-06-26 08:35:26', '2017-06-26 08:35:26', NULL, NULL, '1', '.png', 1, 13, 'nu-gallery 3', '.png', NULL, 0, 'nu-gallery3.png', NULL),
(24, 'new-form-0-e8q0n22y10SdMgwceHjPBY54pG2rKSOiJ8TOHmikSshK3AsxLxPlHXomJ5wZGi.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/new-form-0-e8q0n22y10SdMgwceHjPBY54pG2rKSOiJ8TOHmikSshK3AsxLxPlHXomJ5wZGi.png', NULL, '2017-06-26 08:40:59', '2017-06-26 08:40:59', NULL, NULL, '1', '.png', 1, 14, 'new-form-0-e8q0n 2', '.png', NULL, 0, 'new-form-0-e8q0n2.png', NULL),
(25, 'mu-uh2y10gYUWxgZBNOq7.rl6nu6eKeKMgpwdqJGY58.FhEWwqoVPb88DCCaNa.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/mu-uh2y10gYUWxgZBNOq7.rl6nu6eKeKMgpwdqJGY58.FhEWwqoVPb88DCCaNa.png', NULL, '2017-06-26 09:05:19', '2017-06-26 09:05:19', NULL, NULL, '1', '.png', 1, 15, 'mu-uh', '.png', NULL, 0, 'mu-uh.png', NULL),
(26, 'mu-uh22y10.HwWfpf7EY6L8F5o84mPH.9OnNuH8lBJTfYqQ4.7yLSD2Bskq1NS.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/mu-uh22y10.HwWfpf7EY6L8F5o84mPH.9OnNuH8lBJTfYqQ4.7yLSD2Bskq1NS.png', NULL, '2017-06-26 09:05:19', '2017-06-26 09:05:19', NULL, NULL, '1', '.png', 1, 15, 'mu-uh 2', '.png', NULL, 0, 'mu-uh2.png', NULL),
(27, 'mu-uh32y10emdF3Ii3EAaX3dT7nO7hVOfGYCteRQ5Z1hWSazGCpmzCnMXI.Wyrq.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/mu-uh32y10emdF3Ii3EAaX3dT7nO7hVOfGYCteRQ5Z1hWSazGCpmzCnMXI.Wyrq.png', NULL, '2017-06-26 09:05:20', '2017-06-26 09:05:20', NULL, NULL, '1', '.png', 1, 15, 'mu-uh 3', '.png', NULL, 0, 'mu-uh3.png', NULL),
(28, 'pelican2y10euxaCvjXA0HUBss.SNN8qOVM2CizFHr0S7KGcGDfCvCIVlTdnlpe.jpg', '/Users/dmck/Documents/Projects/gallery4/assets/files/pelican2y10euxaCvjXA0HUBss.SNN8qOVM2CizFHr0S7KGcGDfCvCIVlTdnlpe.jpg', NULL, '2017-08-06 22:30:40', '2017-08-06 22:30:40', NULL, NULL, '1', '.jpg', 1, 16, 'pelican', '.jpg', NULL, 0, 'pelican.jpg', NULL),
(29, 'Jessica2y10n5OYwlmzcot.fmwBnXjizOGhpnET6dSoV2WQBerUxv30ojRj2AIRO.jpg', '/Users/dmck/Documents/Projects/gallery4/assets/files/Jessica2y10n5OYwlmzcot.fmwBnXjizOGhpnET6dSoV2WQBerUxv30ojRj2AIRO.jpg', NULL, '2017-09-25 07:17:42', '2017-09-25 07:17:42', NULL, NULL, '1', '.jpg', 1, 17, 'Jessica', '.jpg', NULL, 0, 'Jessica.jpg', NULL),
(30, 'mountain-scene-via-Unsplash2y10Ij9lBu0vD9MrhogReM2tweTNKlC6gC2posXDWAy1BMOCeVqIZvq.jpg', '/Users/dmck/Documents/Projects/gallery4/assets/files/mountain-scene-via-Unsplash2y10Ij9lBu0vD9MrhogReM2tweTNKlC6gC2posXDWAy1BMOCeVqIZvq.jpg', NULL, '2017-09-25 19:14:36', '2017-09-25 19:14:36', NULL, NULL, '1', '.jpg', 1, 18, 'mountain-scene-via-Unsplash', '.jpg', NULL, 0, 'mountain-scene-via-Unsplash.jpg', NULL),
(31, 'bongaroo2y100RPbGGPbDgOs0utu1Ga2EOtgrj47ltXTiGt5SnUVsgeQc6HeDNZq.jpg', '/Users/dmck/Documents/Projects/gallery4/assets/files/bongaroo2y100RPbGGPbDgOs0utu1Ga2EOtgrj47ltXTiGt5SnUVsgeQc6HeDNZq.jpg', NULL, '2017-10-16 07:45:38', '2017-10-16 07:45:38', NULL, NULL, '1', '.jpg', 1, 19, 'bongaroo', '.jpg', NULL, 0, 'bongaroo.jpg', NULL),
(32, 'sample-photos2y1001Jgcm31YPxTzOEY5yuETutJ7YxaPJa0EWhBvZFzbBZH3.oe3sFi.jpg', '/Users/dmck/Documents/Projects/gallery4/assets/files/sample-photos2y1001Jgcm31YPxTzOEY5yuETutJ7YxaPJa0EWhBvZFzbBZH3.oe3sFi.jpg', NULL, '2017-10-23 05:24:06', '2017-10-23 05:24:06', NULL, NULL, '1', '.jpg', 1, 20, 'sample-photos', '.jpg', NULL, 0, 'sample-photos.jpg', NULL),
(33, 'sample-photos22y10WQK4k5XAIyXqrJDCvlvZyuXXqAlWsthxLM8v55ThUHDRrKXaZj5K.jpg', '/Users/dmck/Documents/Projects/gallery4/assets/files/sample-photos22y10WQK4k5XAIyXqrJDCvlvZyuXXqAlWsthxLM8v55ThUHDRrKXaZj5K.jpg', NULL, '2017-10-23 05:24:06', '2017-10-23 05:24:06', NULL, NULL, '1', '.jpg', 1, 20, 'sample-photos 2', '.jpg', NULL, 0, 'sample-photos2.jpg', NULL),
(34, 'new-gallery.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/new-gallery.png', NULL, '2017-10-23 05:38:25', '2017-10-23 05:38:25', NULL, NULL, '1', '.png', 1, 21, 'new-gallery', '.png', NULL, 0, 'new-gallery.png', NULL),
(35, 'new-gallery2.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/new-gallery2.png', NULL, '2017-10-23 05:38:25', '2017-10-23 05:38:25', NULL, NULL, '1', '.png', 1, 21, 'new-gallery 2', '.png', NULL, 0, 'new-gallery2.png', NULL),
(36, 'newer-gallery-.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/newer-gallery-.png', NULL, '2017-10-23 05:40:08', '2017-10-23 05:40:08', NULL, NULL, '1', '.png', 1, 22, 'newer-gallery', '.png', NULL, 0, 'newer-gallery.png', NULL),
(37, 'newer-gallery2-.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/newer-gallery2-.png', NULL, '2017-10-23 05:40:08', '2017-10-23 05:40:08', NULL, NULL, '1', '.png', 1, 22, 'newer-gallery 2', '.png', NULL, 0, 'newer-gallery2.png', NULL),
(38, 'new-pics-.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/new-pics-.png', NULL, '2017-10-23 05:54:45', '2017-10-23 05:54:45', NULL, NULL, '1', '.png', 1, 23, 'new-pics', '.png', NULL, 0, 'new-pics.png', NULL),
(39, 'new-pics2-.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/new-pics2-.png', NULL, '2017-10-23 05:54:45', '2017-10-23 05:54:45', NULL, NULL, '1', '.png', 1, 23, 'new-pics 2', '.png', NULL, 0, 'new-pics2.png', NULL),
(42, 'even-newer-gallery-----.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/even-newer-gallery-----.png', NULL, '2017-10-23 06:00:16', '2017-10-23 06:00:16', NULL, NULL, '1', '.png', 1, 25, 'even-newer-gallery----', '.png', NULL, 0, 'even-newer-gallery----.png', NULL),
(43, 'even-newer-gallery----2-.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/even-newer-gallery----2-.png', NULL, '2017-10-23 06:00:16', '2017-10-23 06:00:16', NULL, NULL, '1', '.png', 1, 25, 'even-newer-gallery---- 2', '.png', NULL, 0, 'even-newer-gallery----2.png', NULL),
(45, '2-more-photos-.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/2-more-photos-.png', NULL, '2017-10-23 07:38:53', '2017-10-23 07:38:53', NULL, NULL, '1', '.png', 1, 26, '2-more-photos', '.png', NULL, 0, '2-more-photos.png', '/Users/dmck/Documents/Projects/gallery4/asset'),
(46, '2-more-photos2-.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/2-more-photos2-.png', NULL, '2017-10-23 07:38:53', '2017-10-23 07:38:53', NULL, NULL, '1', '.png', 1, 26, '2-more-photos 2', '.png', NULL, 0, '2-more-photos2.png', '/Users/dmck/Documents/Projects/gallery4/asset'),
(47, 'nu-stuff-.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/nu-stuff-.png', NULL, '2017-10-23 07:42:16', '2017-10-23 07:42:16', NULL, NULL, '1', '.png', 1, 27, 'nu-stuff', '.png', NULL, 0, 'nu-stuff.png', '/Users/dmck/Documents/Projects/gallery4/asset'),
(48, 'nu-stuff2-.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/nu-stuff2-.png', NULL, '2017-10-23 07:42:16', '2017-10-23 07:42:16', NULL, NULL, '1', '.png', 1, 27, 'nu-stuff 2', '.png', NULL, 0, 'nu-stuff2.png', '/Users/dmck/Documents/Projects/gallery4/asset'),
(49, 'wrv89h-9fh-9-.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/wrv89h-9fh-9-.png', NULL, '2017-10-23 07:43:56', '2017-10-23 07:43:56', NULL, NULL, '1', '.png', 1, 28, 'wrv89h-9fh-9', '.png', NULL, 0, 'wrv89h-9fh-9.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/'),
(50, 'wrv89h-9fh-92-.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/wrv89h-9fh-92-.png', NULL, '2017-10-23 07:43:56', '2017-10-23 07:43:56', NULL, NULL, '1', '.png', 1, 28, 'wrv89h-9fh-9 2', '.png', NULL, 0, 'wrv89h-9fh-92.png', '/Users/dmck/Documents/Projects/gallery4/assets/files/');

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
(2, 'can u still blog?', 'k? is this enough characters? gy', '2017-06-25 23:21:48', '2017-06-25 23:25:35', 1498393308, NULL, 1498393535, '');

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
(1, 'danmck', 'd@danmckeown.info', '2558a34d4d20964ca1d272ab26ccce9511d880579593cd4c9e01ab91ed00f325', '2016-12-29 07:50:36', '2017-06-25 23:14:35', 'd', '', NULL, NULL, NULL, NULL, '3b91bd74d63298f3d0845267de891e25', 1482961836, 1498392875),
(2, 'danmckeown', 'd@danmckeown.info', '8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414', '2017-10-16 07:30:25', '2017-10-16 07:30:25', NULL, NULL, NULL, NULL, NULL, NULL, '83be18a6e9772cdcf0a6451e9a866ab3', 1508099425, 1508099425);

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
(1, 1, 10),
(2, 2, 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users_files`
--
ALTER TABLE `users_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_levels`
--
ALTER TABLE `users_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
