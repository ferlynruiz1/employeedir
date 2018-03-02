-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2018 at 12:04 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elink_employee_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee_department`
--

CREATE TABLE `employee_department` (
  `id` int(11) NOT NULL,
  `department_name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_department`
--

INSERT INTO `employee_department` (`id`, `department_name`, `created_at`, `updated_at`) VALUES
(1, 'IT Department', '0000-00-00 00:00:00', '2018-02-27 00:53:57');

-- --------------------------------------------------------

--
-- Table structure for table `employee_info`
--

CREATE TABLE `employee_info` (
  `id` int(11) NOT NULL,
  `eid` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `alias` varchar(80) DEFAULT NULL,
  `team_name` varchar(80) NOT NULL,
  `position_name` varchar(50) NOT NULL,
  `supervisor_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `hired_date` datetime NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `usertype` int(11) NOT NULL DEFAULT '1',
  `gender` int(11) NOT NULL DEFAULT '1',
  `profile_img` varchar(200) NOT NULL DEFAULT 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg',
  `remember_token` varchar(200) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_info`
--

INSERT INTO `employee_info` (`id`, `eid`, `first_name`, `middle_name`, `last_name`, `email`, `alias`, `team_name`, `position_name`, `supervisor_id`, `start_date`, `hired_date`, `username`, `password`, `usertype`, `gender`, `profile_img`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'EID-2018064', 'John Manuel', 'Sebusa', 'Derecho', 'johnmanuelderecho@elink.com.ph', 'John Derecho', 'IT Department', 'System Programmer', 1, '2018-02-26 00:00:00', '2018-02-09 00:00:00', 'jderecho', '$2y$10$UZC/XJjhfkDXj2S8ZeWUs.W.XPL.AAslxixPkX6xgff2elAhZfV4O', 1, 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', 'tZJtSYn5wb6RC9Hlr1h4C4L5Ne3O6nDGILDfQBFwj5qQcCWdRepp8NVWCJtQ', '0000-00-00 00:00:00', '2018-03-01 22:54:54', NULL),
(2, 'EID-1235432', 'Firstname', 'Middlename', 'Last Name', 'jmanuel.derecho@gmail.com', 'Test User', 'IT Department', 'Test User', 1, '2018-02-28 00:00:00', '2018-02-23 00:00:00', 'testuser', '$2y$10$rMPqtuErCeUL1kuoCfG6gO.vXiLFh/Baa0elECdBf5Xy7lC2Dw8P.', 2, 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', 'ytvYromLkwwMfP6qIvLtq1LP7ho0Ldx7po2A1vIlITbyg8WiraiNZY3hQsQS', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(3, 'EID-1292923', 'Jeneriza', 'Belda', 'Gesapine', 'jenerizagesapine@gmail.com', 'Isai Pineee', 'Conchology', 'Webmaster', 1, '2018-02-26 18:07:00', '2013-12-09 18:07:00', NULL, '$2y$10$YNN/QejnSyTx9kgR6PLPquobym93xvUyvv6.vk/Z04afgLg4ooaRe', 1, 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', 'RGU7n31xPLU4hV3VBuNXBDHL45NHCR5XEFeYN6o6WCtCufotcrd344R6cCqc', '2018-03-02 18:07:00', '2018-03-02 22:29:00', NULL),
(4, 'EID-1292923', 'Melanie', NULL, 'Jacinto', 'melaniejacinto@gmail.com', 'Chacha', 'Arcanys', 'Software Tester', 1, '2018-04-15 18:43:39', '2018-02-16 18:43:39', NULL, '$2y$10$6d7Rw2HUXvhhX.cs.tTTHe06AEjSdLWIx.hu1nk6fTfuwMrUeqzuC', 1, 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', 'BDTvpe3gHkxGC0ieQX9HUpSHxv0BICIoyxrpaQorZfxOwLEvLXbXqvn9u8Ct', '2018-03-02 18:43:39', '2018-03-02 22:23:30', NULL),
(5, 'EID-1292923', 'Melanie', NULL, 'Jacinto', 'melaniejacinto@gmail.com', 'Chacha', 'Arcanys', 'Software Tester', 1, '2018-04-15 18:45:13', '2018-02-16 18:45:13', NULL, '$2y$10$ghKcn2P/JFm2aji1i98X/ulSl7BxKynN6z.ENBogR402jT31OIYYe', 1, 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-02 18:45:13', '2018-03-02 21:20:10', '2018-03-02 21:20:10'),
(6, 'EID-1292923', 'Melanie', NULL, 'Jacinto', 'melaniejacinto@gmail.com', 'Chacha', 'Arcanys', 'Software Tester', 1, '2018-04-15 18:45:44', '2018-02-16 18:45:44', NULL, '$2y$10$SFdLlu5XEfIMMyvqURebfusQllx2xX1ylhZbfiJ.AApufzUpBpmGG', 1, 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-02 18:45:44', '2018-03-02 21:20:05', '2018-03-02 21:20:05'),
(7, 'EID-1292923', 'Melanie', NULL, 'Jacinto', 'melaniejacinto@gmail.com', 'Chacha', 'Arcanys', 'Software Tester', 1, '2018-04-15 18:46:02', '2018-02-16 18:46:02', NULL, '$2y$10$TVFRgQeBqKXyxH0CnETAtOkffSaj4DrPNGmwV4wrNE6kUB1HtYSpW', 1, 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-02 18:46:03', '2018-03-02 21:17:56', '2018-03-02 21:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `employee_position`
--

CREATE TABLE `employee_position` (
  `id` int(11) NOT NULL,
  `position_name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_position`
--

INSERT INTO `employee_position` (`id`, `position_name`, `created_at`, `updated_at`) VALUES
(1, 'Systems Programmer', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee_department`
--
ALTER TABLE `employee_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_info`
--
ALTER TABLE `employee_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_position`
--
ALTER TABLE `employee_position`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee_department`
--
ALTER TABLE `employee_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee_info`
--
ALTER TABLE `employee_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employee_position`
--
ALTER TABLE `employee_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
