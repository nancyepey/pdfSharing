-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2022 at 04:27 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdfshare`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(200) NOT NULL,
  `author` varchar(100) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL DEFAULT 'pdfimage.jpg',
  `category_id` int(15) NOT NULL,
  `added_by` int(15) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `thumbnail` varchar(150) NOT NULL,
  `title_en` varchar(155) NOT NULL,
  `title_fr` varchar(155) NOT NULL,
  `content_fr` varchar(500) NOT NULL,
  `content_en` varchar(500) NOT NULL,
  `short_desc_fr` varchar(255) NOT NULL,
  `short_desc_en` varchar(255) NOT NULL,
  `state` varchar(150) NOT NULL,
  `validated` int(11) DEFAULT 0,
  `author` varchar(150) NOT NULL,
  `translator` varchar(150) NOT NULL DEFAULT '',
  `created_on` varchar(150) NOT NULL,
  `updated_on` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(150) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'manager',
  `image` varchar(200) NOT NULL,
  `active` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `password`, `role`, `image`, `active`, `created_on`, `updated_on`) VALUES
(1, 'admin1', 'admin1', 'admin1@gmail.com', '202cb962ac59075b964b07152d234b70', 'superadmin', 'person.jpg', 0, '2022-04-20 15:34:21', '11-05-22 15:29:21'),
(2, 'admin', 'admin', 'admin@admin.com', '202cb962ac59075b964b07152d234b70', 'admin', 'pichack.jpg', 0, '2012-05-22 04:10:02', '2012-05-22 04:30:02'),
(3, 'mr.manager', 'Mr manager', 'manager@email.com', '202cb962ac59075b964b07152d234b70', 'manager', 'manageM.jpg', 1, '2022-05-16 11:49:33', '2022-05-16 11:49:33'),
(4, 'mrs.manager', 'Mrs manager', 'manager1@email.com', '202cb962ac59075b964b07152d234b70', 'manager', 'managerF.jpg', 1, '2022-05-16 11:58:49', '2022-05-16 11:58:49'),
(5, 'miss.trans', 'Miss Translator', 'translator@tran.com', '202cb962ac59075b964b07152d234b70', 'translator', 'fmtrans.jpg', 1, '0000-00-00 00:00:00', ''),
(6, 'mr.tran', 'Mr Translator', 'transmr@tran.com', '202cb962ac59075b964b07152d234b70', 'translator', 'mrtrans.png', 1, '0000-00-00 00:00:00', ''),
(7, 'mr.writer', 'Mr writer', 'writermr@writer.com', '202cb962ac59075b964b07152d234b70', 'writer', 'mrswriter.jpg', 1, '2022-05-16 13:55:26', 'May-16-2022 13:55:26'),
(8, 'mrs.writer', 'Mrs Writer', 'mrswrit@writer.com', '202cb962ac59075b964b07152d234b70', 'writer', 'mrswriter.jpg', 1, '2022-05-17 10:45:00', 'May-17-2022 10:45:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
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
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
