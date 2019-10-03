SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE DATABASE IF NOT EXISTS `cars` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `cars`;

CREATE TABLE `car` (
                       `id` int(11) NOT NULL,
                       `mark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                       `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                       `year` int(11) NOT NULL,
                       `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                       `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
                       `enabled` tinyint(1) NOT NULL,
                       `created_at` datetime NOT NULL,
                       `updated_at` datetime NOT NULL,
                       `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                       `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                       `image_filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `car` (`id`, `mark`, `model`, `year`, `description`, `slug`, `enabled`, `created_at`, `updated_at`, `country`, `city`, `image_filename`) VALUES
(1, 'mark 0', 'model 0', 2000, 'description 0', 'mark-0-model-0-2000', 1, '2019-05-19 22:46:55', '2019-05-19 22:46:55', NULL, NULL, NULL),
(2, 'mark 1', 'model 1', 2001, 'description 1', 'mark-1-model-1-2001', 1, '2019-05-20 22:46:55', '2019-05-20 22:46:55', NULL, NULL, NULL),
(3, 'mark 2', 'model 2', 2002, 'description 2', 'mark-2-model-2-2002', 1, '2019-05-21 22:46:55', '2019-05-21 22:46:55', NULL, NULL, NULL),
(4, 'mark 3', 'model 3', 2003, 'description 3', 'mark-3-model-3-2003', 1, '2019-05-22 22:46:55', '2019-05-22 22:46:55', NULL, NULL, NULL),
(5, 'mark 4', 'model 4', 2004, 'description 4', 'mark-4-model-4-2004', 1, '2019-05-23 22:46:55', '2019-05-23 22:46:55', NULL, NULL, NULL),
(6, 'mark 5', 'model 5', 2005, 'description 5', 'mark-5-model-5-2005', 1, '2019-05-24 22:46:55', '2019-05-24 22:46:55', NULL, NULL, NULL),
(7, 'mark 6', 'model 6', 2006, 'description 6', 'mark-6-model-6-2006', 1, '2019-05-25 22:46:55', '2019-05-25 22:46:55', NULL, NULL, NULL),
(8, 'mark 7', 'model 7', 2007, 'description 7', 'mark-7-model-7-2007', 1, '2019-05-26 22:46:55', '2019-05-26 22:46:55', NULL, NULL, NULL),
(9, 'mark 8', 'model 8', 2008, 'description 8', 'mark-8-model-8-2008', 1, '2019-05-27 22:46:55', '2019-05-27 22:46:55', NULL, NULL, NULL),
(10, 'mark 9', 'model 9', 2009, 'description 9', 'mark-9-model-9-2009', 1, '2019-05-28 22:46:55', '2019-05-28 22:46:55', NULL, NULL, NULL),
(11, 'mark 10', 'model 10', 2010, 'description 10', 'mark-10-model-10-2010', 1, '2019-05-29 22:54:52', '2019-05-29 22:55:19', 'eeuu', 'Dallas', 'car1-5ceef19caccd9.jpeg');

ALTER TABLE `car`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `UNIQ_773DE69D989D9B62` (`slug`);

ALTER TABLE `car`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;