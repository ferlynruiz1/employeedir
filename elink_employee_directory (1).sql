-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2018 at 11:19 PM
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
-- Database: `elink_employee_directory`
--

-- --------------------------------------------------------

--
-- Table structure for table `elink_account`
--

CREATE TABLE `elink_account` (
  `id` int(11) NOT NULL,
  `account_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `elink_account`
--

INSERT INTO `elink_account` (`id`, `account_name`) VALUES
(1, 'Readers Magnet'),
(2, 'cVen'),
(3, 'Enterprise'),
(4, 'eLink');

-- --------------------------------------------------------

--
-- Table structure for table `elink_division`
--

CREATE TABLE `elink_division` (
  `id` int(11) NOT NULL,
  `division_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `elink_division`
--

INSERT INTO `elink_division` (`id`, `division_name`) VALUES
(1, 'Accounting'),
(2, 'Operations'),
(3, 'Human Resources'),
(4, 'Training'),
(5, 'Branding/Marketing'),
(6, 'Exec'),
(7, 'IT\r\n'),
(8, 'Business Intelligence');

-- --------------------------------------------------------

--
-- Table structure for table `employee_department`
--

CREATE TABLE `employee_department` (
  `id` int(11) NOT NULL,
  `department_name` varchar(50) NOT NULL,
  `department_code` varchar(20) DEFAULT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `division_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_department`
--

INSERT INTO `employee_department` (`id`, `department_name`, `department_code`, `manager_id`, `division_id`, `account_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'IT Department', 'ITEC05', NULL, 2, 3, '0000-00-00 00:00:00', '2018-03-20 16:33:07', NULL),
(2, 'HR Department', 'HRD04', 1, 2, 3, '0000-00-00 00:00:00', '2018-03-20 16:34:23', NULL),
(3, 'QA Department', 'TQD04', 1, 3, 1, '0000-00-00 00:00:00', '2018-03-20 16:34:43', NULL),
(4, 'PubCon', NULL, 1, 4, 1, '0000-00-00 00:00:00', '2018-03-06 23:17:28', NULL),
(5, 'New Department', NULL, 1, 3, 3, '2018-03-09 21:55:15', '2018-03-16 15:39:12', '2018-03-16 15:39:12'),
(6, 'New Department', NULL, 1, 8, 4, '2018-03-09 22:10:27', '2018-03-16 15:39:17', '2018-03-16 15:39:17'),
(7, 'Rest', NULL, 1, 8, 4, '2018-03-12 15:31:01', '2018-03-12 15:41:32', NULL),
(8, 'Sleep', NULL, 1, 8, 4, '2018-03-12 15:41:17', '2018-03-12 15:41:17', NULL),
(9, 'Eat Department', NULL, 15, 7, 4, '2018-03-14 20:50:02', '2018-03-14 20:50:02', NULL),
(10, 'Test', NULL, NULL, 1, 1, '2018-03-16 15:39:35', '2018-03-16 15:39:40', '2018-03-16 15:39:40');

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
  `team_name` varchar(80) DEFAULT NULL,
  `dept_code` varchar(20) DEFAULT NULL,
  `position_name` varchar(50) NOT NULL,
  `supervisor_id` int(11) DEFAULT NULL,
  `role_id` varchar(50) DEFAULT NULL,
  `supervisor_name` varchar(100) DEFAULT NULL,
  `manager_name` varchar(100) DEFAULT NULL,
  `birth_date` datetime DEFAULT NULL,
  `hired_date` datetime DEFAULT NULL,
  `prod_date` datetime DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  `usertype` int(11) NOT NULL DEFAULT '1',
  `gender` int(11) DEFAULT '1',
  `manager_id` int(11) DEFAULT '0',
  `division_id` int(11) DEFAULT NULL,
  `division_name` varchar(100) DEFAULT NULL,
  `account_id` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `ext` varchar(20) DEFAULT NULL,
  `wave` varchar(20) DEFAULT NULL,
  `all_access` int(11) NOT NULL DEFAULT '0',
  `profile_img` varchar(200) NOT NULL DEFAULT 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg',
  `remember_token` varchar(200) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_info`
--

INSERT INTO `employee_info` (`id`, `eid`, `first_name`, `middle_name`, `last_name`, `email`, `alias`, `team_name`, `dept_code`, `position_name`, `supervisor_id`, `role_id`, `supervisor_name`, `manager_name`, `birth_date`, `hired_date`, `prod_date`, `password`, `usertype`, `gender`, `manager_id`, `division_id`, `division_name`, `account_id`, `status`, `ext`, `wave`, `all_access`, `profile_img`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '--', 'Super ', '', 'Admin', 'directory@elink.com.ph', 'Super Admin', 'Employee Directory', NULL, 'Super Admin', NULL, NULL, NULL, NULL, '2018-03-26 17:07:11', '2018-03-26 17:07:11', '2018-03-26 17:07:11', '$2y$10$UZC/XJjhfkDXj2S8ZeWUs.W.XPL.AAslxixPkX6xgff2elAhZfV4O', 4, 1, NULL, NULL, NULL, 4, 1, NULL, NULL, 0, 'http://localhost/elinkemployeedirectory/public/img/elink-logo-site.png', 'mH27szTzIVJHHUfaSx1IGWlZxmtUphV4TpEnp0BK1KybFc3bmsqcoW6jbXpX', '0000-00-00 00:00:00', '2018-03-21 17:07:11', NULL),
(1562, 'ESCC-2017198', 'Michelle', '', 'De Leon', 'michelledeleon@elink.com.ph', 'Mich', 'Accounting', 'ACC01', 'Accounting', NULL, NULL, 'Pasion, Ferdinand Jr.', '--', NULL, NULL, '2017-01-23 00:00:00', '$2y$10$bNpPZDarXlJDnGqg.8D3FuuX8xRmyYd6sDj7/.KcHCBySQJBA1p6q', 1, 1, 0, NULL, 'Accounting', 3, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:27:59', '2018-03-23 04:27:59', NULL),
(1563, 'ESCC-2017387', 'Duane Marie Lyka', '', 'Del Rio', 'duanemarielykadelrio@elink.com.ph', '--', 'Accounting', 'ACC01', 'Accounting Specialist', NULL, NULL, 'De Leon, Michelle', 'Pasion, Ferdinand Jr.', NULL, NULL, '2018-01-03 00:00:00', '$2y$10$1hruHMLyecTifel8BtfNJumhqGNRdcPkDlcnCHeZlk8Mw75KVZUP2', 1, 1, 0, NULL, 'Accounting', 3, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:00', '2018-03-23 04:28:00', NULL),
(1564, 'ESCC-2017366', 'Francis', '', 'Oliverio', 'francisoliverio@elink.com.ph', '--', 'Branding/marketing', 'BMAR01', 'Branding/Marketing Officer', NULL, NULL, 'Libero, Jose Marie', 'Pasion, Ferdinand Jr.', NULL, NULL, '2017-11-13 00:00:00', '$2y$10$8BAUZbPC0jVvCPf7359Ip.gbHhGrVra08q5Wj1hOMl2J8Jhpj0yOK', 1, 1, 0, NULL, 'Branding/marketing', 1, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:00', '2018-03-23 04:28:00', NULL),
(1565, 'ESCC-2018049', 'Jaydar', '', 'Medrozo', 'jaydarmaine@readersmagnet.com', 'Jaydar Maine', 'Branding/marketing', 'BMAR01', 'Digital Marketing Specialist', NULL, NULL, 'Libero, Jose Marie', 'Pasion, Ferdinand Jr.', NULL, NULL, '2018-03-03 00:00:00', '$2y$10$r5hDJX46B25o4oGJE87LF.F3a3JhpXt/UJG.OgW34qKYWMp0N/1de', 1, 1, 0, NULL, 'Branding/marketing', 1, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:00', '2018-03-23 04:28:00', NULL),
(1566, 'ESCC-2017364', 'Diosdado Mark', '', 'Caluyo', 'diosdadocaluyo@elink.com.ph', '--', 'Business Intelligence', 'BIN02', 'Reports Analyst', NULL, NULL, 'Pasion, Ferdinand Jr.', '--', NULL, NULL, '2017-10-06 00:00:00', '$2y$10$81Aq8QhLuOlXKIvVK.hvluVHPMO1QAwLdity3DVh.0gDvjJO88nDm', 1, 1, 0, NULL, 'Business Intelligence', 3, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:00', '2018-03-23 04:28:00', NULL),
(1567, 'ESCC-2017311', 'Rowena', '', 'Manriquez', 'stephenchian@elink.com.ph', '--', 'Cven', 'CVEN03', 'Au Hr Admin/Supervisor', NULL, NULL, 'Malinao, Leah', 'Pasion, Ferdinand Jr.', NULL, NULL, '2036-02-06 06:28:16', '$2y$10$LKswyszLFUGcPKasy739V.M6NAJyqPUONJkybbuAz/m0oqRGReS1e', 1, 1, 0, NULL, 'Operations', 2, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:00', '2018-03-23 04:28:00', NULL),
(1568, 'ESCC-2018024', 'Sidney Lim', '', 'Ngo', 'ruggieensinada@elink.com.ph', '--', 'Cven', 'CVEN03', 'Documentation Specialist', NULL, NULL, 'Malinao, Leah', 'Pasion, Ferdinand Jr.', NULL, NULL, '2018-01-08 00:00:00', '$2y$10$IHzTpkM4CqtLALFs4lvEEuPUL6/CM1d9KLRlwEtdwKfr1nB2TW0Cy', 1, 1, 0, NULL, 'Operations', 2, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:00', '2018-03-23 04:28:00', NULL),
(1569, 'ESCC-2017310', 'Maryjeane', '', 'Hernando', 'marifelpadilla@readersmagnet.com', '--', 'Cven', 'CVEN03', 'Engineering Admin', NULL, NULL, 'Malinao, Leah', 'Pasion, Ferdinand Jr.', NULL, NULL, '2017-08-29 00:00:00', '$2y$10$m.jFwYwjszKKCNenX5M4dO.9NRe1Nr1kgUVBFd57Di0lQlSTuW3VS', 1, 1, 0, NULL, 'Operations', 2, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:00', '2018-03-23 04:28:00', NULL),
(1570, 'ESCC-2018023', 'Naome', '', 'Bazarte', 'merrysimmons@readersmagnet.com', '--', 'Cven', 'CVEN03', 'Executive Assistant', NULL, NULL, 'Millevoy, Mark', '--', NULL, NULL, '2018-01-20 00:00:00', '$2y$10$6WCOtulRRl5NEIkqsJJ8e.LUbazK.ZgD8Ws5weDHiOlzWjcoZ1dpa', 1, 1, 0, NULL, 'Operations', 2, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:00', '2018-03-23 04:28:00', NULL),
(1571, 'ESCC-2017200', 'Leah', '', 'Malinao', 'kennydonaire@elink.com.ph', '--', 'Cven', 'CVEN03', 'Manager', NULL, NULL, 'Pasion, Ferdinand Jr.', '--', NULL, NULL, '2017-01-30 00:00:00', '$2y$10$VvOLHhFMP.5w3Tx.A9d3k.EBo.NH9j6hOVQSmViHZ5wb6Hnub7GLG', 1, 1, 0, NULL, 'Operations', 2, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:00', '2018-03-23 04:28:00', NULL),
(1572, 'ESCC-2018028', 'Moises Moel Jr.', '', 'Labandero', 'moiseslabandero@elink.com.ph', '--', 'Cven', 'CVEN03', 'Technical Writer', NULL, NULL, 'Malinao, Leah', 'Pasion, Ferdinand Jr.', NULL, NULL, '2018-01-08 00:00:00', '$2y$10$/t.lzk94nHsPryVf1emWrOys5lKyj9ss7gyVDm9sj7Ic68yjcn6D6', 1, 1, 0, NULL, 'Operations', 2, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:01', '2018-03-23 04:28:01', NULL),
(1573, 'ESCC-2017389', 'Charmaine', '', 'Natividad', 'charmainenatividad@elink.com.ph', '--', 'Cven', 'CVEN03', 'Technical Writer', NULL, NULL, 'Malinao, Leah', 'Pasion, Ferdinand Jr.', NULL, NULL, '2018-01-03 00:00:00', '$2y$10$E5Z1oyCeOKTer3gRhV15m.HlNqFMKl23XCepdQBhmIaVqBb.ALNwy', 1, 1, 0, NULL, 'Operations', 2, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:01', '2018-03-23 04:28:01', NULL),
(1574, 'ESCC-2017218', 'Charlou', '', 'Albarando', 'charloualbarando@elink.com.ph', '--', 'Cven', 'CVEN03', 'Technical Writing Staff', NULL, NULL, 'Malinao, Leah', 'Pasion, Ferdinand Jr.', NULL, NULL, '2017-02-21 00:00:00', '$2y$10$v5yEEV.Mztmt8lm7ZlNRe.EP3sNtzyJxYTzc5Sej5DmzbtuJxoYx2', 1, 1, 0, NULL, 'Operations', 2, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:01', '2018-03-23 04:28:01', NULL),
(1575, 'ESCC-2017212', 'Tom Kevin', '', 'Cometa', 'sidneyngo@elink.com.ph', '--', 'Cven', 'CVEN03', 'Technical Writing Staff', NULL, NULL, 'Malinao, Leah', 'Pasion, Ferdinand Jr.', NULL, NULL, '2017-02-08 00:00:00', '$2y$10$uea7whx6gA508V6mP22zmeZtthlNxmp9LaW4EXmMgyBh7WUMvpqOS', 1, 1, 0, NULL, 'Operations', 2, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:01', '2018-03-23 04:28:01', NULL),
(1576, 'ESCC-2017217', 'June Rey', '', 'Montajes', 'alexsilva@readersmagnet.com', '--', 'Cven', 'CVEN03', 'Technical Writing Staff', NULL, NULL, 'Malinao, Leah', 'Pasion, Ferdinand Jr.', NULL, NULL, '2017-02-21 00:00:00', '$2y$10$EKv8wYU2W1rlSPI7dqpBsudhuqg79DOcU/nwiW8bq5E6iZ69zEWM.', 1, 1, 0, NULL, 'Operations', 2, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:01', '2018-03-23 04:28:01', NULL),
(1577, 'ESCC-2014001', 'Ferdinand Jr.', '', 'Pasion', 'ferdinandpasion@elink.com.ph', '--', 'Exec', 'EXEC00', 'GM', NULL, NULL, '--', '--', NULL, NULL, '2015-01-01 00:00:00', '$2y$10$zWfi5L5jF1wuXABxMYGLHOMOtI.rOTqVQl01.LPsWRuOE/Xm0nzb2', 1, 1, 0, NULL, 'Exec', 3, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:01', '2018-03-23 04:28:01', NULL),
(1578, 'ESCC-2018065', 'Charlie', '', 'Remegio', 'charlieremegio@elink.com.ph', '--', 'Human Resources', 'HRD04', 'Admin & HR Assistant', NULL, NULL, 'Aranas, Rosemarie', 'Alix, Rowena', NULL, NULL, '2018-01-29 00:00:00', '$2y$10$irEYW3fwk//ElySB5bihTeBDEc3bb1ztNL5YiZhQLET62k/4U86H6', 1, 1, 0, NULL, 'Human Resources', 3, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:01', '2018-03-23 04:28:01', NULL),
(1579, 'ESCC-2018025', 'Rowena', '', 'Alix', 'robertcarlrodriguez@readersmagnet.com', '--', 'Human Resources', 'HRD04', 'Manager', NULL, NULL, 'Pasion, Ferdinand Jr.', '--', NULL, NULL, '2018-01-08 00:00:00', '$2y$10$y192XnjZqh0YYIlksCnkW.ALq515PVjQKyIaxGsUeOOLACOE65TyS', 1, 1, 0, NULL, 'Human Resources', 3, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:01', '2018-03-23 04:28:01', NULL),
(1580, 'ESCC-2017384', 'OP Maverick', '', 'Lim', 'opmavericklim@elink.com.ph', '--', 'Human Resources', 'HRD04', 'Manager', NULL, NULL, 'Pasion, Ferdinand Jr.', '--', NULL, NULL, '2017-12-14 00:00:00', '$2y$10$4LhiYJlRguRudWzcQbnyreAC2zLvmEHc62w2ynwR4cAgeCnBdnxdu', 1, 1, 0, NULL, 'Recruitment', 3, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:01', '2018-03-23 04:28:01', NULL),
(1581, 'ESCC-2017386', 'Julius Cesar', '', 'Fernandez', 'jaimefernandez@readersmagnet.com', '--', 'Human Resources', 'HRD04', 'Sourcing Specialist - Project Based', NULL, NULL, 'Lim, OP Maverick', 'Pasion, Ferdinand Jr.', NULL, NULL, '2017-12-19 00:00:00', '$2y$10$ZyXbrMRbXqkV.MGNKn3pZO/xtCND9PMuxdoj97QKTBB6NrgDTimmi', 1, 1, 0, NULL, 'Recruitment', 3, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:01', '2018-03-23 04:28:01', NULL),
(1582, 'ESCC-2018026', 'Lauresse Gybrelle', '', 'Poliquit', 'kathrynsanders@readersmagnet.com', '--', 'Human Resources', 'HRD04', 'Sourcing Specialist - Project Based', NULL, NULL, 'Lim, OP Maverick', 'Pasion, Ferdinand Jr.', NULL, NULL, '2018-01-17 00:00:00', '$2y$10$xhuHLKFEbHItvsxYaZjQref0wUsaSXFkIf8k5kGjo6KXkbsk8l4SK', 1, 1, 0, NULL, 'Recruitment', 3, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:02', '2018-03-23 04:28:02', NULL),
(1583, 'ESCC-2017343', 'Alfie', '', 'Andales', 'alfieandales@elink.com.ph', '--', 'IT', 'ITEC05', 'IT', NULL, NULL, 'Fajardo, Alson', 'Pasion, Ferdinand Jr.', NULL, NULL, '2017-10-02 00:00:00', '$2y$10$9n8yW5iqan.S5PBqoGErtuxW6uci2Nqh1ZNLkKcK9buzlLroLxzry', 1, 1, 0, NULL, 'IT', 3, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:02', '2018-03-23 04:28:02', NULL),
(1584, 'ESCC-2016128', 'Ramffy', '', 'Rabadon', 'crispinrebalde@readersmagnet.com', '--', 'IT', 'ITEC05', 'IT', NULL, NULL, 'Fajardo, Alson', 'Pasion, Ferdinand Jr.', NULL, NULL, '2016-07-05 00:00:00', '$2y$10$2aBU3C8ti1VWtQ5abNFncO3qbpVg9wVQrQVmuZA5RwjBgUJ6mID/6', 1, 1, 0, NULL, 'IT', 3, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:02', '2018-03-23 04:28:02', NULL),
(1585, 'ESCC-2016153', 'Crispin', '', 'Rebalde', 'crispinrebalde@elink.com.ph', '--', 'IT', 'ITEC05', 'IT', NULL, NULL, 'Fajardo, Alson', 'Pasion, Ferdinand Jr.', NULL, NULL, '2016-08-16 00:00:00', '$2y$10$wOeL5Glq02.C2QSvJE5CruAAfbSSwqUIl8f.l8lHgw.hfCvLNgDuq', 1, 1, 0, NULL, 'IT', 3, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:02', '2018-03-23 04:28:02', NULL),
(1586, 'ESCC-2017252', 'Alson', '', 'Fajardo', 'alsonfajardo@elink.com.ph', '--', 'IT', 'ITEC05', 'Supervisor', NULL, NULL, 'Pasion, Ferdinand Jr.', '--', NULL, NULL, '2017-07-05 00:00:00', '$2y$10$MysO4e/PHxxl08pqaKbxSOczPrt.VqQ4wJlx5T7yvBD2Q28MaAP7e', 1, 1, 0, NULL, 'IT', 3, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:02', '2018-03-23 04:28:02', NULL),
(1587, 'ESCC-2018064', 'John Manuel', '', 'Derecho', 'jenaevans@readersmagnet.com', '--', 'IT', 'ITEC05', 'System Programmer', NULL, NULL, 'Fajardo, Alson', 'Pasion, Ferdinand Jr.', NULL, NULL, '2018-02-27 00:00:00', '$2y$10$hwm/I2cmwe0K9iduQVMYneszPPurVHMybAkxti1K9FfXM/0b/Ft62', 1, 1, 0, NULL, 'IT', 3, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:02', '2018-03-23 04:28:02', NULL),
(1588, 'ESCC-2016135', 'Jesus Jr.', '', 'Arcayan', 'jakearcayan@readersmagnet.com', '--', 'Lead Distribution Specialist', 'LGEN06', 'Lead Distribution', NULL, NULL, 'Libero, Jose Marie', 'Pasion, Ferdinand Jr.', NULL, NULL, '2016-06-18 00:00:00', '$2y$10$zst81ONLQsONmpExhSvBdu7ZL.HRrfEs5iKZD1PczGJqo.u3Yc9Ly', 1, 1, 0, NULL, 'Operations', 1, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:02', '2018-03-23 04:28:02', NULL),
(1589, 'ESCC-2017273', 'George Michael', '', 'Alana', 'gmichaelalana@readersmagnet.com', 'George Michael Alana', 'Lead Generation', 'LGEN06', 'Lead Generation', NULL, NULL, 'Diamante, Jim Ralph', 'Libero, Jose Marie', NULL, NULL, '2017-07-03 00:00:00', '$2y$10$rnXBMoCTgO6LMj4L1NCbA.b1HImdGw8NxdwhgVT3z7ZJMGFbMLtLO', 1, 1, 0, NULL, 'Operations', 1, 1, '1570', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:02', '2018-03-23 04:28:02', NULL),
(1590, 'ESCC-2017314', 'Cloudine', '', 'Del Socorro', 'cloudinedelsocorro@readersmagnet.com', 'Cloudine Del Socorro', 'Lead Generation', 'LGEN06', 'Lead Generation', NULL, NULL, 'Diamante, Jim Ralph', 'Libero, Jose Marie', NULL, NULL, '2017-09-04 00:00:00', '$2y$10$frp96ty10PyrH9AAHjGjMeGgN0/KDOQ7XTAI36K7miLsoHnWTD4ga', 1, 1, 0, NULL, 'Operations', 1, 1, '1627', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:02', '2018-03-23 04:28:02', NULL),
(1591, 'ESCC-2017336', 'Nicole Anne', '', 'Devaras', 'mitchielynjanemagno@elink.com.ph', 'Nicole Anne Devaras', 'Lead Generation', 'LGEN06', 'Lead Generation', NULL, NULL, 'Diamante, Jim Ralph', 'Libero, Jose Marie', NULL, NULL, '2017-09-12 00:00:00', '$2y$10$tQyJKvgdj2DIPVDQlsmrkei4qJokzf/pJondJ3P6AnwVCSBxRwNZ2', 1, 1, 0, NULL, 'Operations', 1, 1, '1636', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:03', '2018-03-23 04:28:03', NULL),
(1592, 'ESCC-2017319', 'Mavie Jane', '', 'Fuentes', 'maviejanefuentes@readersmagnet.com', 'Mavie Jane Fuentes', 'Lead Generation', 'LGEN06', 'Lead Generation', NULL, NULL, 'Diamante, Jim Ralph', 'Libero, Jose Marie', NULL, NULL, '2017-09-04 00:00:00', '$2y$10$fm7gsscXWKj.0yaPsNmLkOd52gmPq9SBy1htIWD.EgL891o5QSZVy', 1, 1, 0, NULL, 'Operations', 1, 1, '1625', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:03', '2018-03-23 04:28:03', NULL),
(1593, 'ESCC-2017275', 'Jay Mark', '', 'Loyloy', 'jaymarkloyloy@readersmagnet.com', 'Jay Mark Loyloy', 'Lead Generation', 'LGEN06', 'Lead Generation', NULL, NULL, 'Diamante, Jim Ralph', 'Libero, Jose Marie', NULL, NULL, '2017-07-03 00:00:00', '$2y$10$Z2eD6FahXpcS.z97GvlrAeyEUg5JgeJ3DF4tB608UxhEPgilRvko.', 1, 1, 0, NULL, 'Operations', 1, 1, '1568', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:03', '2018-03-23 04:28:03', NULL),
(1594, 'ESCC-2017318', 'Marifel', '', 'Padilla', 'louieross@readersmagnet.com', 'Marifel Padilla', 'Lead Generation', 'LGEN06', 'Lead Generation', NULL, NULL, 'Diamante, Jim Ralph', 'Libero, Jose Marie', NULL, NULL, '2017-09-04 00:00:00', '$2y$10$R0/lVdOuwgkSG3qNphhuYefw0m.XF7uuWUlexffwgIfDLpkpPr.Um', 1, 1, 0, NULL, 'Operations', 1, 1, '1632', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:03', '2018-03-23 04:28:03', NULL),
(1595, 'ESCC-2017297', 'Jan Maree', '', 'Pepito', 'janmareepepito@readersmagnet.com', 'Jan Maree Pepito', 'Lead Generation', 'LGEN06', 'Lead Generation', NULL, NULL, 'Diamante, Jim Ralph', 'Libero, Jose Marie', NULL, NULL, '2017-08-14 00:00:00', '$2y$10$PwxwJEY./Lo4CtjjvvTSJ.dFjmdRJJsYD5VamlH4LCCy6cqN.IUny', 1, 1, 0, NULL, 'Operations', 1, 1, '1540', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:03', '2018-03-23 04:28:03', NULL),
(1596, 'ESCC-2017316', 'Jimmy', '', 'Razaga', 'jeffrivers@readersmagnet.com', 'Jimmy Razaga', 'Lead Generation', 'LGEN06', 'Lead Generation', NULL, NULL, 'Diamante, Jim Ralph', 'Libero, Jose Marie', NULL, NULL, '2017-09-04 00:00:00', '$2y$10$gSxdBbVlnZ/.D.CKZjvHq.EvJkWPNW1t4HY5y1u.L/4uDdsNq/6ca', 1, 1, 0, NULL, 'Operations', 1, 1, '1630', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:03', '2018-03-23 04:28:03', NULL),
(1597, 'ESCC-2017337', 'Robert Carl', '', 'Rodriguez', 'ralphgilbert@readersmagnet.com', 'Robert Carl Rodriguez', 'Lead Generation', 'LGEN06', 'Lead Generation', NULL, NULL, 'Diamante, Jim Ralph', 'Libero, Jose Marie', NULL, NULL, '2017-09-12 00:00:00', '$2y$10$aEFYByeJLWRdEtDNS4QIhOlXynb5EVnTjOnFZVC.hfjo0LkpAk0RC', 1, 1, 0, NULL, 'Operations', 1, 1, '1635', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:03', '2018-03-23 04:28:03', NULL),
(1598, 'ESCC-2017317', 'Jude Silver', '', 'Sanchez', 'jorgeabella@readersmagnet.com', 'Sophia Bennett', 'Lead Generation', 'LGEN06', 'Lead Generation', NULL, NULL, 'Diamante, Jim Ralph', 'Libero, Jose Marie', NULL, NULL, '2017-09-04 00:00:00', '$2y$10$NUMmOQgNTBq9x29MgFTQSOIsq0hBRiATgLwD15AAi3TAhj0.jN4d2', 1, 1, 0, NULL, 'Operations', 1, 1, '1553', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:03', '2018-03-23 04:28:03', NULL),
(1599, 'ESCC-2017238', 'Chrys Diane', '', 'Tariga', 'chrysdianetariga@readersmagnet.com', 'Chrys Diane Tariga', 'Lead Generation', 'LGEN06', 'Lead Generation', NULL, NULL, 'Diamante, Jim Ralph', 'Libero, Jose Marie', NULL, NULL, '2017-05-08 00:00:00', '$2y$10$Pql2Dfg54VCX9.ROwqJUHOyxREXQ7Vl0l6snTG5AiWLP9FmPxh9Ka', 1, 1, 0, NULL, 'Operations', 1, 1, '1524', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:03', '2018-03-23 04:28:03', NULL),
(1600, 'ESCC-2017296', 'Terry Ann', '', 'Torayno', 'terryanntarayno@readersmagnet.com', 'Terry Ann Torayno', 'Lead Generation', 'LGEN06', 'Lead Generation', NULL, NULL, 'Diamante, Jim Ralph', 'Libero, Jose Marie', NULL, NULL, '2017-08-14 00:00:00', '$2y$10$biU4cNZNgTPgA2c/kl8AFuPP44HGvNXwmyjmpzVgUjk.AJAz9Sizq', 1, 1, 0, NULL, 'Operations', 1, 1, '1569', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:04', '2018-03-23 04:28:04', NULL),
(1601, 'ESCC-2017237', 'Angel Mae', '', 'Tumulak', 'angelmaetumulak@readersmagnet.com', 'Angel Mae Tumulak', 'Lead Generation', 'LGEN06', 'Lead Generation', NULL, NULL, 'Diamante, Jim Ralph', 'Libero, Jose Marie', NULL, NULL, '2017-05-04 00:00:00', '$2y$10$iNwHnsCTzTlTJ7nB/0QOPulIQbC1tibgls/MH0EAmWp/tK/t/EjWS', 1, 1, 0, NULL, 'Operations', 1, 1, '1542', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:04', '2018-03-23 04:28:04', NULL),
(1602, 'ESCC-2016056', 'Jim Ralph', '', 'Diamante', 'jaygomez@readersmagnet.com', 'Jim Lewis', 'Lead Generation', 'LGEN06', 'Supervisor', NULL, NULL, 'Libero, Jose Marie', 'Pasion, Ferdinand Jr.', NULL, NULL, '2016-04-03 00:00:00', '$2y$10$X3Bp37Thj2ItYcKxbqeHE.Vap0lsC631Ubudo8HDnZixqKPtXcTJa', 1, 1, 0, NULL, 'Operations', 1, 1, '1547', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:04', '2018-03-23 04:28:04', NULL),
(1603, 'ESCC-2017348', 'Marou', '', 'Abarca', 'marcusmontez@readersmagnet.com', 'Marie Andrews', 'Operations - Fulfillment', 'OFUL08', 'Fulfillment', NULL, NULL, 'Alarde, Jaylord', 'Abueva, Juneil', NULL, NULL, '2017-10-09 00:00:00', '$2y$10$7oRj01uSSmDfFUySvMJ9qu3zYv2Qh4wU4iuNv97kS8.gPoU6TdgpS', 1, 1, 0, NULL, 'Operations', 1, 1, '1657', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:04', '2018-03-23 04:28:04', NULL),
(1604, 'ESCC-2017268', 'Eric', '', 'Aniñon', 'ericaandersen@readersmagnet.com', 'Erica Andersen', 'Operations - Fulfillment', 'OFUL08', 'Fulfillment', NULL, NULL, 'Alarde, Jaylord', 'Abueva, Juneil', NULL, NULL, '2017-06-26 00:00:00', '$2y$10$sFC2K8GJJuIgV7AadNZaDegwOLEhUOon64J2u4CUdmizVOSxhNpgy', 1, 1, 0, NULL, 'Operations', 1, 1, '1565', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:04', '2018-03-23 04:28:04', NULL),
(1605, 'ESCC-2017215', 'Suzette', '', 'Avila', 'shellybernales@readersmagnet.com', 'Stefanie Sanchez', 'Operations - Fulfillment', 'OFUL08', 'Fulfillment', NULL, NULL, 'Alarde, Jaylord', 'Abueva, Juneil', NULL, NULL, '2017-02-21 00:00:00', '$2y$10$WVkKm8uX2crn0grgQswaNuPrWnSKhMQB2iyYSdxTvcyHiDX/2.r9q', 1, 1, 0, NULL, 'Operations', 1, 1, '1611', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:04', '2018-03-23 04:28:04', NULL),
(1606, 'ESCC-2017345', 'Christian Edgar', '', 'Daan', 'ethandickinson@readersmagnet.com', 'Ethan Dickinson', 'Operations - Fulfillment', 'OFUL08', 'Fulfillment', NULL, NULL, 'Alarde, Jaylord', 'Abueva, Juneil', NULL, NULL, '2017-10-02 00:00:00', '$2y$10$Ys9fYibmdtdiRB.4jraiQ.ZQGySImn1WyEhnFQIC5AXWbx2W/GNXy', 1, 1, 0, NULL, 'Operations', 1, 1, '1654', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:04', '2018-03-23 04:28:04', NULL),
(1607, 'ESCC-2017222', 'Mary Cris', '', 'Mahino', 'mariahgray@readersmagnet.com', 'Sophia Stark', 'Operations - Fulfillment', 'OFUL08', 'Fulfillment', NULL, NULL, 'Alarde, Jaylord', 'Abueva, Juneil', NULL, NULL, '2017-04-12 00:00:00', '$2y$10$HV1BNGPkRDxKoy2gXcDlION/s3ITV2SlcIn3.cL3TL1GcI7NpZh1u', 1, 1, 0, NULL, 'Operations', 1, 1, '1598', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:04', '2018-03-23 04:28:04', NULL),
(1608, 'ESCC-2016169', 'Jaylord', '', 'Alarde', 'davidquinn@readersmagnet.com', 'David Quinn', 'Operations - Fulfillment', 'OFUL08', 'Supervisor', NULL, NULL, 'Abueva, Juneil', 'Pasion, Ferdinand Jr.', NULL, NULL, '2016-10-13 00:00:00', '$2y$10$pw5FPhQK2AP4WqdAuOsG4OwbHrHMgm108zl7xBkrsXR3/KF4XpSPO', 1, 1, 0, NULL, 'Operations', 1, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:04', '2018-03-23 04:28:04', NULL),
(1609, 'ESCC-2017240', 'Maikee', '', 'Amoin', 'lemuelbernaldez@readersmagnet.com', '--', 'Operations - Marketing Production', 'OMA09', 'Marketing Production', NULL, NULL, 'Abueva, Juneil_POC', 'Abueva, Juneil', NULL, NULL, '2017-05-16 00:00:00', '$2y$10$WZDVGgeuIZDhdVN5ik7co..Am7vyI9Teti2oPHlakpM0I1vURObIC', 1, 1, 0, NULL, 'Operations', 1, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:04', '2018-03-23 04:28:04', NULL),
(1610, 'ESCC-2017216', 'Stephanie', '', 'Arcilla', 'rusellnicks@readersmagnet.com', '--', 'Operations - Marketing Production', 'OMA09', 'Marketing Production', NULL, NULL, 'Abueva, Juneil_POC', 'Abueva, Juneil', NULL, NULL, '2017-02-22 00:00:00', '$2y$10$n9P3UcogMQQCtOF5GgGKu./rey4D9TD3WPYD0oFbwgpfuUx.F7ANu', 1, 1, 0, NULL, 'Operations', 1, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:05', '2018-03-23 04:28:05', NULL),
(1611, 'ESCC-2017315', 'Hans Christian', '', 'Batuto', 'hanschristianbatuto@elink.com.ph', '--', 'Operations - Marketing Production', 'OMA09', 'Marketing Production', NULL, NULL, 'Abueva, Juneil_POC', 'Abueva, Juneil', NULL, NULL, '2017-09-04 00:00:00', '$2y$10$wiTfCDnqsUF72SC5Z8oHtuO1Npxo4Ff5Sa25lplWlkkHBOrUufyXK', 1, 1, 0, NULL, 'Operations', 1, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:05', '2018-03-23 04:28:05', NULL),
(1612, 'ESCC-2017195', 'Catsteven', '', 'Betonio', 'catstevenbetonio@elink.com.ph', '--', 'Operations - Marketing Production', 'OMA09', 'Marketing Production', NULL, NULL, 'Abueva, Juneil_POC', 'Abueva, Juneil', NULL, NULL, '2017-01-09 00:00:00', '$2y$10$zj9S1aBbcbk8F.IuUzjk5OqtLBG5xZWU0Yqj2PqEbz3frKZ4vkbge', 1, 1, 0, NULL, 'Operations', 1, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:05', '2018-03-23 04:28:05', NULL),
(1613, 'ESCC-2017213', 'Mon Axiell', '', 'Ligan', 'meganthomas@readersmagnet.com', '--', 'Operations - Marketing Production', 'OMA09', 'Marketing Production', NULL, NULL, 'Abueva, Juneil_POC', 'Abueva, Juneil', NULL, NULL, '2017-02-14 00:00:00', '$2y$10$ZrQzCSs73A3UwxgMDhukuOPYWCRkS28sjBKyVmeNCGc4zhbMh7DWy', 1, 1, 0, NULL, 'Operations', 1, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:05', '2018-03-23 04:28:05', NULL),
(1614, 'ESCC-2017257', 'Jess Andrew', '', 'Muaña', 'jessandrewmuana@elink.com.ph', '--', 'Operations - Marketing Production', 'OMA09', 'Marketing Production', NULL, NULL, 'Abueva, Juneil_POC', 'Abueva, Juneil', NULL, NULL, '2017-06-13 00:00:00', '$2y$10$AaxQMv3YxxeBr6Nl8SwEoeH.cBia0yBVeqChVfuzMDZoYMLQbUfTi', 1, 1, 0, NULL, 'Operations', 1, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:05', '2018-03-23 04:28:05', NULL),
(1615, 'ESCC-2017363', 'Denny', '', 'Povadora', 'dennypovadora@readersmagnet.com', '--', 'Operations - Marketing Production', 'OMA09', 'Marketing Production', NULL, NULL, 'Abueva, Juneil_POC', 'Abueva, Juneil', NULL, NULL, '2017-11-02 00:00:00', '$2y$10$.jkpGbMs.stnmK0O5NtK1ewT0zgbO3Hkn/3jNTlvOajxzhxGD3Cvy', 1, 1, 0, NULL, 'Operations', 1, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:05', '2018-03-23 04:28:05', NULL),
(1616, 'ESCC-2017309', 'Roy Anthony', '', 'Ruba', 'royanthonyruba@elink.com.ph', '--', 'Operations - Marketing Production', 'OMA09', 'Marketing Production', NULL, NULL, 'Abueva, Juneil_POC', 'Abueva, Juneil', NULL, NULL, '2017-08-21 00:00:00', '$2y$10$qc8SV8VjuzxKgB7WZ69OZ.jq0AxW7yj.TAXD4vrpgjvoJkkN49ZZO', 1, 1, 0, NULL, 'Operations', 1, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:05', '2018-03-23 04:28:05', NULL),
(1617, 'ESCC-2017224', 'Randy', '', 'Santillan', 'normancraig@readersmagnet.com', '--', 'Operations - Marketing Production', 'OMA09', 'Marketing Production', NULL, NULL, 'Abueva, Juneil_POC', 'Abueva, Juneil', NULL, NULL, '2017-04-17 00:00:00', '$2y$10$kZoNeau.bpQX7iZ5bfF1Juf0aQPpzG1seVTRRx7gC6GM42y2g0EbW', 1, 1, 0, NULL, 'Operations', 1, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:05', '2018-03-23 04:28:05', NULL),
(1618, 'ESCC-2017214', 'Dennis Vouhn', '', 'Tan', 'dennistan@elink.com.ph', '--', 'Operations - Marketing Production', 'OMA09', 'Marketing Production', NULL, NULL, 'Abueva, Juneil_POC', 'Abueva, Juneil', NULL, NULL, '2017-02-14 00:00:00', '$2y$10$/Ir08KGoDtWZ3hVlMJFhG.ZSvj/Y75yuHqAkSwKQz14aWATPnIDty', 1, 1, 0, NULL, 'Operations', 1, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:05', '2018-03-23 04:28:05', NULL),
(1619, 'ESCC-2018098', 'Ruston', '', 'Emperua', 'rosalindalim@readersmagnet.com', '--', 'Operations - Marketing Production', 'OMA09', 'Web Developer', NULL, NULL, 'Abueva, Juneil_POC', 'Abueva, Juneil', NULL, NULL, '2018-02-28 00:00:00', '$2y$10$Igr73Dc/jAN/BJ.LaiDS9O7OMwi6W9aw/TzFQpQfOwfQ8RTdXOrkC', 1, 1, 0, NULL, 'Operations', 1, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:05', '2018-03-23 04:28:05', NULL),
(1620, 'ESCC-2018099', 'Kenny Sy', '', 'Donaire', 'juliacuesta@readersmagnet.com', '--', 'Operations - Production', 'OPR10', 'Customer Serivce Rep', NULL, NULL, 'Nambatac, Niña', 'Abueva, Juneil', NULL, NULL, '2018-03-07 00:00:00', '$2y$10$Y2yJPFVeCYEoDbHiroXzYOYCPwcjDfZBXCLPGjJkvH9omeNyeH6oe', 1, 1, 0, NULL, 'Operations', 1, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:06', '2018-03-23 04:28:06', NULL),
(1621, 'ESCC-2017280', 'Juneil', '', 'Abueva', 'josephorevillo@elink.com.ph', 'Juneil Abueva', 'Operations - Production', 'OPR10', 'Manager', NULL, NULL, 'Pasion, Ferdinand Jr.', '--', NULL, NULL, '2017-07-27 00:00:00', '$2y$10$jeWGksA.6SkdDhlI8PBFl.cbtLXxvZtTXG.eSbjDja0TNimArhqwu', 1, 1, 0, NULL, 'Operations', 1, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:06', '2018-03-23 04:28:06', NULL),
(1622, 'ESCC-2017269', 'Shieldon', '', 'Alcasid', 'rachelecooper@readersmagnet.com', 'Shieldon Alcasid', 'Operations - Publishing Production', 'OPUB01', 'Publishing Production', NULL, NULL, 'Nambatac, Niña', 'Abueva, Juneil', NULL, NULL, '2017-06-26 00:00:00', '$2y$10$45KzKnXeKue24Fkcnt6pmepn240ovHh4txk.d3fPt0bT8xsJssW9S', 1, 1, 0, NULL, 'Operations', 1, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:06', '2018-03-23 04:28:06', NULL),
(1623, 'ESCC-2017344', 'Niño Roberto', '', 'Gonzales', 'monligan@elink.com.ph', 'Rob Nino Gonzales', 'Operations - Publishing Production', 'OPUB01', 'Publishing Production', NULL, NULL, 'Nambatac, Niña', 'Abueva, Juneil', NULL, NULL, '2017-10-02 00:00:00', '$2y$10$QeT8fXVhC0Km1nO/2WehmO6NyCA2sR/JKm9WwjUapZGWIsi.FeR/C', 1, 1, 0, NULL, 'Operations', 1, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:06', '2018-03-23 04:28:06', NULL),
(1624, 'ESCC-2017351', 'Jackie', '', 'Miala', 'jackiemiala@elink.com.ph', '--', 'Operations - Publishing Production', 'OPUB01', 'Publishing Production', NULL, NULL, 'Nambatac, Niña', 'Abueva, Juneil', NULL, NULL, '2017-10-18 00:00:00', '$2y$10$xVMBA2yJfC.0pMSiVAr3neLtL40Q4LkYXCF4D98cz0sL9uTUIce.m', 1, 1, 0, NULL, 'Operations', 1, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:06', '2018-03-23 04:28:06', NULL),
(1625, 'ESCC-2017308', 'Ericka', '', 'Obando', 'erickaobando@elink.com.ph', 'Ericka Obando', 'Operations - Publishing Production', 'OPUB01', 'Publishing Production', NULL, NULL, 'Nambatac, Niña', 'Abueva, Juneil', NULL, NULL, '2017-08-19 00:00:00', '$2y$10$jelGfKpwStnyU9sAP3T3jeB0z6Q3eae.m0TytXScqR9l.plGwPAQm', 1, 1, 0, NULL, 'Operations', 1, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:06', '2018-03-23 04:28:06', NULL),
(1626, 'ESCC-2017313', 'Kevin Rafael', '', 'Ouano', 'junereymontajes@elink.com.ph', 'Kevin Ouano', 'Operations - Publishing Production', 'OPUB01', 'Publishing Production', NULL, NULL, 'Nambatac, Niña', 'Abueva, Juneil', NULL, NULL, '2017-08-28 00:00:00', '$2y$10$14QMqWWF.t/uusDAoMz1EeJH1Ve2DbLf7n12GRAvUj8OHd3dE01uy', 1, 1, 0, NULL, 'Operations', 1, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:06', '2018-03-23 04:28:06', NULL),
(1627, 'ESCC-2017340', 'Donato', '', 'Toledo Jr.', 'donatotoledo@readersmagnet.com', 'Donato Toledo', 'Operations - Publishing Production', 'OPUB01', 'Publishing Production', NULL, NULL, 'Nambatac, Niña', 'Abueva, Juneil', NULL, NULL, '2017-09-18 00:00:00', '$2y$10$0Irvggd1eUqsPhw4WlreE.LEchkaczZqIWm..q76fxKTLohE56.Ea', 1, 1, 0, NULL, 'Operations', 1, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:06', '2018-03-23 04:28:06', NULL),
(1628, 'ESCC-2017347', 'Gezel', '', 'Zozobrado', 'gisellebailey@readersmagnet.com', '--', 'Operations - Publishing Production', 'OPUB01', 'Publishing Production', NULL, NULL, 'Nambatac, Niña_FUL', 'Abueva, Juneil', NULL, NULL, '2017-10-06 00:00:00', '$2y$10$LHzqP78sqJ0dBbhWyMcYm..jLYaH74jzYxGVUpK2j41fBUZeS2eCK', 1, 1, 0, NULL, 'Operations', 1, 1, '1656', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:06', '2018-03-23 04:28:06', NULL),
(1629, 'ESCC-2017253', 'Niña', '', 'Nambatac', 'ninanambatac@readersmagnet.com', 'Niña Nambatac', 'Operations - Publishing Production', 'OPUB01', 'Supervisor', NULL, NULL, 'Abueva, Juneil', 'Pasion, Ferdinand Jr.', NULL, NULL, '2017-06-07 00:00:00', '$2y$10$yMKI8Y/YhxzmsTtJ5D8/keJKNBOU.P4XXJsLQqHydysloT55I01c6', 1, 1, 0, NULL, 'Operations', 1, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:06', '2018-03-23 04:28:06', NULL),
(1630, 'ESCC-2018039', 'Gad Jazer', '', 'Encinas', 'eliasencinas@readersmagnet.com', 'Elias Encinas', 'Operations - Sales', 'OSA02', 'Agent (MC)', NULL, NULL, 'Pitogo, Nethaniah Dell', 'Lumpas, Faith', NULL, NULL, '2018-03-03 00:00:00', '$2y$10$2FmWI/U/u/MJLKpS9TC/neAvrSRk6qf9pB6ZUEoQWEzrNhLnkh.nO', 1, 1, 0, NULL, 'Operations', 1, 1, '1735', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:06', '2018-03-23 04:28:06', NULL),
(1631, 'ESCC-2018044', 'Angel Jhade', '', 'Layson', 'angeloleyson@readersmagnet.com', 'Angelo Leyson', 'Operations - Sales', 'OSA02', 'Agent (MC)', NULL, NULL, 'Pitogo, Nethaniah Dell', 'Lumpas, Faith', NULL, NULL, '2018-03-03 00:00:00', '$2y$10$ThDvrSRHRr5ozJAYGMb45ObeCBqUoXxCd9m6oybQdf1pqY0VRGpNi', 1, 1, 0, NULL, 'Operations', 1, 1, '1736', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:07', '2018-03-23 04:28:07', NULL),
(1632, 'ESCC-2017369', 'Armie', '', 'Ponte', 'aimeeponte@readersmagnet.com', 'Aimee Pontee', 'Operations - Sales', 'OSA02', 'Agent (MC)', NULL, NULL, 'Pitogo, Nethaniah Dell', 'Lumpas, Faith', NULL, NULL, '2017-11-16 00:00:00', '$2y$10$kQxFRB3naMpYCv9o/PVQ8OTDBd2RcFvM6VRojngCJBoZSrDh5I1gC', 1, 1, 0, NULL, 'Operations', 1, 1, '1667', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:07', '2018-03-23 04:28:07', NULL),
(1633, 'ESCC-2017264', 'Minerva', '', 'Remedio', 'miaroberts@readersmagnet.com', 'Mia Roberts', 'Operations - Sales', 'OSA02', 'Agent (MC)', NULL, NULL, 'Pitogo, Nethaniah Dell', 'Lumpas, Faith', NULL, NULL, '2017-06-29 00:00:00', '$2y$10$sRhcZ1CjcEXXYnKqZeYu4.aT4wdud3rATtincAaT46iWAHiH95eg6', 1, 1, 0, NULL, 'Operations', 1, 1, '1571', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:07', '2018-03-23 04:28:07', NULL),
(1634, 'ESCC-2018055', 'Josephine Mae', '', 'Saquilon', 'josiemae@readersmagnet.com', 'Josie Mae', 'Operations - Sales', 'OSA02', 'Agent (MC)', NULL, NULL, 'Pitogo, Nethaniah Dell', 'Lumpas, Faith', NULL, NULL, '2018-03-03 00:00:00', '$2y$10$ff2eXZTfqgh8yj87hk46L.e69V.ED9VyXsZMjD.0Em9CK21NeTIgi', 1, 1, 0, NULL, 'Operations', 1, 1, '1744', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:07', '2018-03-23 04:28:07', NULL),
(1635, 'ESCC-2015019', 'Dejay', '', 'Torres', 'kevintorres@readersmagnet.com', 'Kevin Torres', 'Operations - Sales', 'OSA02', 'Agent (MC)', NULL, NULL, 'Pitogo, Nethaniah Dell', 'Lumpas, Faith', NULL, NULL, '2015-09-21 00:00:00', '$2y$10$uLRK9ePlZncaXeMpL4.M0.NsDAcZfJcDyU1wsijPpljd6OjPtYOQi', 1, 1, 0, NULL, 'Operations', 1, 1, '1551', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:07', '2018-03-23 04:28:07', NULL),
(1636, 'ESCC-2017383', 'Cyrene', '', 'Zamora', 'zairenzamora@readersmagnet.com', 'Zairen Zamora', 'Operations - Sales', 'OSA02', 'Agent (MC)', NULL, NULL, 'Pitogo, Nethaniah Dell', 'Lumpas, Faith', NULL, NULL, '2018-02-01 00:00:00', '$2y$10$Yqnb5oQRpTgXJ//tHY3Kh.hCjdXS8HxRV9JQFF3q0/2mPdOSuegcu', 1, 1, 0, NULL, 'Operations', 1, 1, '1707', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:07', '2018-03-23 04:28:07', NULL),
(1637, 'ESCC-2018030', 'Jade', '', 'Archival', 'jadearcher@readersmagnet.com', 'Jade Archer', 'Operations - Sales', 'OSA02', 'Agent (MC)', NULL, NULL, 'Quinto, Randy Paul', 'Lumpas, Faith', NULL, NULL, '2018-03-03 00:00:00', '$2y$10$3QzrbDKYknqrgeMvP8zJ7.0rT4SjSr3GToALMu1fA8QXd6vJRNU6C', 1, 1, 0, NULL, 'Operations', 1, 1, '1729', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:07', '2018-03-23 04:28:07', NULL),
(1638, 'ESCC-2017284', 'Ma. Criseliza', '', 'Belen', 'lauressepoliquit@elink.com.ph', 'Liza Belen', 'Operations - Sales', 'OSA02', 'Agent (MC)', NULL, NULL, 'Quinto, Randy Paul', 'Lumpas, Faith', NULL, NULL, '2017-08-10 00:00:00', '$2y$10$jpdDKXr5KCiH/zTHfuPEgOWC5yHcZduMJV3CsiZOHMOPrgFsn.Phe', 1, 1, 0, NULL, 'Operations', 1, 1, '1593', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:07', '2018-03-23 04:28:07', NULL),
(1639, 'ESCC-2017242', 'Joseph Ed', '', 'Borinaga', 'joecelilano@elink.com.ph', 'Alex Silva', 'Operations - Sales', 'OSA02', 'Agent (MC)', NULL, NULL, 'Quinto, Randy Paul', 'Lumpas, Faith', NULL, NULL, '2017-06-01 00:00:00', '$2y$10$m0l/9JF6dtM7fiyDfTas.OvwAlleuJfjGdiT3zlx6hHkx3kg3pZ7y', 1, 1, 0, NULL, 'Operations', 1, 1, '1548', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:07', '2018-03-23 04:28:07', NULL),
(1640, 'ESCC-2018012', 'Maria Grace', '', 'Maro', 'gracemartinez@readersmagnet.com', 'Grace Martinez', 'Operations - Sales', 'OSA02', 'Agent (MC)', NULL, NULL, 'Quinto, Randy Paul', 'Lumpas, Faith', NULL, NULL, '2018-03-01 00:00:00', '$2y$10$j0ODlyOR8Zcq3iOFhSSzBuYl.avOWn4RkXsD1M4JUzhFEbQqyE9A.', 1, 1, 0, NULL, 'Operations', 1, 1, '1720', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:08', '2018-03-23 04:28:08', NULL),
(1641, 'ESCC-2017247', 'Lawrence Ellain', '', 'Medrano', 'elainefernandez@readersmagnet.com', 'Elaine Fernandez', 'Operations - Sales', 'OSA02', 'Agent (MC)', NULL, NULL, 'Quinto, Randy Paul', 'Lumpas, Faith', NULL, NULL, '2017-06-01 00:00:00', '$2y$10$zuKmV1qnjbv.Zl39qcHP8O/1X2Ot7bl0tnEaACAN9xbafXPw9qJrO', 1, 1, 0, NULL, 'Operations', 1, 1, '1560', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:08', '2018-03-23 04:28:08', NULL),
(1642, 'ESCC-2017277', 'Icon', '', 'Padin', 'rubybaker@readersmagnet.com', 'Ruby Baker', 'Operations - Sales', 'OSA02', 'Agent (MC)', NULL, NULL, 'Quinto, Randy Paul', 'Lumpas, Faith', NULL, NULL, '2017-07-27 00:00:00', '$2y$10$HNgMHHw18yW1ZSpQa3d5tukU9L1m5VinKTST0uaQsgwUPUYrOGA7u', 1, 1, 0, NULL, 'Operations', 1, 1, '1604', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:08', '2018-03-23 04:28:08', NULL),
(1643, 'ESCC-2018060', 'Brennan', '', 'Sanchez', 'brennansaint@readersmagnet.com', 'Brennan Saint', 'Operations - Sales', 'OSA02', 'Agent (MC)', NULL, NULL, 'Quinto, Randy Paul', 'Lumpas, Faith', NULL, NULL, '2018-03-03 00:00:00', '$2y$10$4UFlZMIArNJPH79JrQy5eOnG5YVW8ft2QYNuSDFb/S1ZPrGmit70a', 1, 1, 0, NULL, 'Operations', 1, 1, '1743', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:08', '2018-03-23 04:28:08', NULL),
(1644, 'ESCC-2016039', 'Frederic', '', 'Violango', 'fredrivera@readersmagnet.com', 'Fred Rivera', 'Operations - Sales', 'OSA02', 'Agent (MC)', NULL, NULL, 'Quinto, Randy Paul', 'Lumpas, Faith', NULL, NULL, '2016-02-08 00:00:00', '$2y$10$eqd5IkOPkW7qFWL3/fZlbuCZbbR6eBCC6/wg7EbXozLEyHdwmGayW', 1, 1, 0, NULL, 'Operations', 1, 1, '1552', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:08', '2018-03-23 04:28:08', NULL),
(1645, 'ESCC-2017258', 'Francis II', '', 'Asenorio', 'marcolopez@readersmagnet.com', 'Marco Lopez', 'Operations - Sales', 'OSA02', 'Agent (PC)', NULL, NULL, 'Tabares, Qr', 'Lumpas, Faith', NULL, NULL, '2017-07-01 00:00:00', '$2y$10$stKNpXx98MLHyzfG5iy70.diJLnYwmlr8H6L97Jjq.GmLczN.CAj6', 1, 1, 0, NULL, 'Operations', 1, 1, '1577', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:08', '2018-03-23 04:28:08', NULL),
(1646, 'ESCC-2018031', 'Jecathelyn', '', 'Bacus', 'franciscabarrios@readersmagnet.com', 'Francisca Barrios', 'Operations - Sales', 'OSA02', 'Agent (PC)', NULL, NULL, 'Tabares, Qr', 'Lumpas, Faith', NULL, NULL, '2018-03-03 00:00:00', '$2y$10$oLiqKN.9CYUtFS1Z15JSZeOnFqPIpuyZtKFSnbifYIm.Aqv5n0cUS', 1, 1, 0, NULL, 'Operations', 1, 1, '1745', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:08', '2018-03-23 04:28:08', NULL),
(1647, 'ESCC-2018037', 'Fritz Gerard', '', 'Densing', 'fritzgrant@readersmagnet.com', 'Fritz Grant', 'Operations - Sales', 'OSA02', 'Agent (PC)', NULL, NULL, 'Tabares, Qr', 'Lumpas, Faith', NULL, NULL, '2018-03-03 00:00:00', '$2y$10$roXKV0ujwRw685fTHLxBiOKKn8xO1GBeNIYmIEo3PZQ1o2qboTa0G', 1, 1, 0, NULL, 'Operations', 1, 1, '1749', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:08', '2018-03-23 04:28:08', NULL),
(1648, 'ESCC-2018009', 'Joseph', '', 'Labao', 'josephdelara@readersmagnet.com', 'Joseph Delara', 'Operations - Sales', 'OSA02', 'Agent (PC)', NULL, NULL, 'Tabares, Qr', 'Lumpas, Faith', NULL, NULL, '2018-03-01 00:00:00', '$2y$10$IwI5kaUtKdd7dKHoEzEz4OKFafIadzwLvlxstvlNhXP6u5ic8.IhK', 1, 1, 0, NULL, 'Operations', 1, 1, '1718', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:08', '2018-03-23 04:28:08', NULL),
(1649, 'ESCC-2018042', 'Fritzie Mae', '', 'Layna', 'fritzieleres@readersmagnet.com', 'Fritzie Leres', 'Operations - Sales', 'OSA02', 'Agent (PC)', NULL, NULL, 'Tabares, Qr', 'Lumpas, Faith', NULL, NULL, '2018-03-03 00:00:00', '$2y$10$u3gWgohKVRt2gYo/Ifkh/e1XG3HTnbEw7eUbtU1W5fAtM806FUluS', 1, 1, 0, NULL, 'Operations', 1, 1, '1751', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:09', '2018-03-23 04:28:09', NULL),
(1650, 'ESCC-2017374', 'Lovely Kish', '', 'Sayon', 'kishsanford@readersmagnet.com', 'Kish Sanford', 'Operations - Sales', 'OSA02', 'Agent (PC)', NULL, NULL, 'Tabares, Qr', 'Lumpas, Faith', NULL, NULL, '2017-11-16 00:00:00', '$2y$10$nSbgSu1i4iJblPZgqtzb/unc6fpqyBv/Zip8hAErj8s7mK5Co4eXW', 1, 1, 0, NULL, 'Operations', 1, 1, '1668', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:09', '2018-03-23 04:28:09', NULL),
(1651, 'ESCC-2017358', 'Dissa Mia', '', 'Tabaranza', 'dizatabaranza@readersmagnet.com', 'Diza Tabaranza', 'Operations - Sales', 'OSA02', 'Agent (PC)', NULL, NULL, 'Tabares, Qr', 'Lumpas, Faith', NULL, NULL, '2017-10-30 00:00:00', '$2y$10$YdFzfGN7FPK69yzsijk7e.E78SS2jOgBWIUTWzRfRDjRJWscWVCqC', 1, 1, 0, NULL, 'Operations', 1, 1, '1588', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:09', '2018-03-23 04:28:09', NULL),
(1652, 'ESCC-2018032', 'Arnie Lou', '', 'Bulawan', 'arniegould@readersmagnet.com', 'Arnie Gould', 'Operations - Sales', 'OSA02', 'Agent (PC)', NULL, NULL, 'Tibon, Darvin Jay', 'Lumpas, Faith', NULL, NULL, '2018-03-03 00:00:00', '$2y$10$67yKXFFsmjf21w06NJuqIeRuZdOPf0EvZXdm..2zPo0qAVyMHYNWu', 1, 1, 0, NULL, 'Operations', 1, 1, '1746', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:09', '2018-03-23 04:28:09', NULL),
(1653, 'ESCC-2017251', 'Chrisadel', '', 'Fuentes', 'chrisadelle@readersmagnet.com', 'Chris Adelle', 'Operations - Sales', 'OSA02', 'Agent (PC)', NULL, NULL, 'Tibon, Darvin Jay', 'Lumpas, Faith', NULL, NULL, '2017-06-05 00:00:00', '$2y$10$TPyRI4fRfAexqNG7LkLuZuyM2Ukcx.iMB7LjXa766m0Wmdrz6VtbC', 1, 1, 0, NULL, 'Operations', 1, 1, '1564', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:09', '2018-03-23 04:28:09', NULL),
(1654, 'ESCC-2017381', 'Dennis Venancio', '', 'Jaranilla', 'dennisjacobs@readersmagnet.com', 'Dennis Jacobs', 'Operations - Sales', 'OSA02', 'Agent (PC)', NULL, NULL, 'Tibon, Darvin Jay', 'Lumpas, Faith', NULL, NULL, '2018-02-01 00:00:00', '$2y$10$K8e5pNKn9LS/aljGVbOme.gG2u/EtjWRcmpllxfGk1tUq1nkWQE26', 1, 1, 0, NULL, 'Operations', 1, 1, '1709', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:09', '2018-03-23 04:28:09', NULL),
(1655, 'ESCC-2018041', 'Juan Fernando', '', 'Labrador', 'juanfernan@readersmagnet.com', 'Juan Fernan', 'Operations - Sales', 'OSA02', 'Agent (PC)', NULL, NULL, 'Tibon, Darvin Jay', 'Lumpas, Faith', NULL, NULL, '2018-03-03 00:00:00', '$2y$10$aAHx1rgDEFeAfQjDfUyO7eog2Yqq1ajDl2DHMeafbRkcbTlA2QN8C', 1, 1, 0, NULL, 'Operations', 1, 1, '1750', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:09', '2018-03-23 04:28:09', NULL),
(1656, 'ESCC-2018043', 'Kristine Joy', '', 'Layno', 'kristinallanes@readersmagnet.com', 'Kristina Llanes', 'Operations - Sales', 'OSA02', 'Agent (PC)', NULL, NULL, 'Tibon, Darvin Jay', 'Lumpas, Faith', NULL, NULL, '2018-03-03 00:00:00', '$2y$10$Sk5Ut/zM6gaYg9rMIdn3quObuHI/HvANonCV31y7kq3DJ2oZ2Qh9y', 1, 1, 0, NULL, 'Operations', 1, 1, '1752', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:09', '2018-03-23 04:28:09', NULL),
(1657, 'ESCC-2017372', 'Charmaine', '', 'Lumayag', 'charmainelane@readersmagnet.com', 'Charmaine Lane', 'Operations - Sales', 'OSA02', 'Agent (PC)', NULL, NULL, 'Tibon, Darvin Jay', 'Lumpas, Faith', NULL, NULL, '2017-11-16 00:00:00', '$2y$10$iwkIY1Vxz5ZUE32Z1YGZRuHfhD7YMNzkQxsx5sf1Yo11YUM9RgqgS', 1, 1, 0, NULL, 'Operations', 1, 1, '1666', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:09', '2018-03-23 04:28:09', NULL),
(1658, 'ESCC-2018014', 'Dennis Rey', '', 'Naliponguit', 'dannyreyes@readersmagnet.com', 'Danny Reyes', 'Operations - Sales', 'OSA02', 'Agent (PC)', NULL, NULL, 'Tibon, Darvin Jay', 'Lumpas, Faith', NULL, NULL, '2018-03-01 00:00:00', '$2y$10$TFsDjCtARfC3tdmAvMByteY.9kL4KWba9GD81fOMukr82xxw3jIJy', 1, 1, 0, NULL, 'Operations', 1, 1, '1722', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:09', '2018-03-23 04:28:09', NULL),
(1659, 'ESCC-2018015', 'Stewart', '', 'Nellas', 'stewartnell@readersmagnet.com', 'Steward Nell', 'Operations - Sales', 'OSA02', 'Agent (PC)', NULL, NULL, 'Tibon, Darvin Jay', 'Lumpas, Faith', NULL, NULL, '2018-03-01 00:00:00', '$2y$10$SyeonudP2B/vMkpMM2wwu.DIG8/fC56fjJS/c.nbc/dAH3Lt6cwLy', 1, 1, 0, NULL, 'Operations', 1, 1, '1723', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:09', '2018-03-23 04:28:09', NULL),
(1660, 'ESCC-2018051', 'Rosen Seth', '', 'Olojan', 'setholi@readersmagnet.com', 'Seth Oli', 'Operations - Sales', 'OSA02', 'Agent (PC)', NULL, NULL, 'Tibon, Darvin Jay', 'Lumpas, Faith', NULL, NULL, '2018-03-03 00:00:00', '$2y$10$SZTqG8aK4nJMTdH.hAp6De85PAYrqIEPlNMI/0drX.3ixcZ6.uGO.', 1, 1, 0, NULL, 'Operations', 1, 1, '1756', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:10', '2018-03-23 04:28:10', NULL),
(1661, 'ESCC-2017382', 'John Elbert', '', 'Sente', 'elbertjohnson@readersmagnet.com', 'Elbert Johnson', 'Operations - Sales', 'OSA02', 'Agent (PC)', NULL, NULL, 'Tibon, Darvin Jay', 'Lumpas, Faith', NULL, NULL, '2018-02-01 00:00:00', '$2y$10$1Gzo74V684jKfGDxY7hymeji9/j3SwFjhsnVwdm2wItl.RZKSRbzm', 1, 1, 0, NULL, 'Operations', 1, 1, '1710', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:10', '2018-03-23 04:28:10', NULL),
(1662, 'ESCC-2017223', 'Faith', '', 'Lumpas', 'faithlumpas@elink.com.ph', '--', 'Operations - Sales', 'OSA02', 'Manager', NULL, NULL, 'Pasion, Ferdinand Jr.', '--', NULL, NULL, '2017-02-02 00:00:00', '$2y$10$pIGOrkxdxQj2f1imBn2DJeUBkRJ.LW04CSEJ.Bz66xIqZXyY574Qy', 1, 1, 0, NULL, 'Operations', 1, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:10', '2018-03-23 04:28:10', NULL),
(1663, 'ESCC-2016066', 'Randy Paul', '', 'Quinto', 'nerrievivienpajugot@elink.com.ph', 'Randy Westbrook', 'Operations - Sales', 'OSA02', 'Supervisor (MC)', NULL, NULL, 'Lumpas, Faith', 'Pasion, Ferdinand Jr.', NULL, NULL, '2016-04-04 00:00:00', '$2y$10$kiz9NZg4F6G9J9ThpUabHu3VPlbajI2BxNz2dHs4VrTJkVuTQppRS', 1, 1, 0, NULL, 'Operations', 1, 1, '1554', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:10', '2018-03-23 04:28:10', NULL);
INSERT INTO `employee_info` (`id`, `eid`, `first_name`, `middle_name`, `last_name`, `email`, `alias`, `team_name`, `dept_code`, `position_name`, `supervisor_id`, `role_id`, `supervisor_name`, `manager_name`, `birth_date`, `hired_date`, `prod_date`, `password`, `usertype`, `gender`, `manager_id`, `division_id`, `division_name`, `account_id`, `status`, `ext`, `wave`, `all_access`, `profile_img`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1664, 'ESCC-2016090', 'Harris', '', 'Imon', 'harrisimon@elink.com.ph', 'Rey Harris', 'Operations - Sales', 'OSA02', 'Supervisor (PC)', NULL, NULL, 'Lumpas, Faith', 'Pasion, Ferdinand Jr.', NULL, NULL, '2016-05-16 00:00:00', '$2y$10$5CNnIQF3bxYK.R46BAkTGOD/9FC8ufjXreIgcx93bYstPOJV2/rAy', 1, 1, 0, NULL, 'Operations', 1, 1, '1507', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:10', '2018-03-23 04:28:10', NULL),
(1665, 'ESCC-2017209', 'Nethaniah Dell', '', 'Pitogo', 'miguelalvez@readersmagnet.com', 'Nathan Moore', 'Operations - Sales', 'OSA02', 'Supervisor Trainee (MC)', NULL, NULL, 'Lumpas, Faith', 'Pasion, Ferdinand Jr.', NULL, NULL, '2017-02-16 00:00:00', '$2y$10$vH.NkbEn6AKAtQpevez8leHvv8UEV1i1FV1HYZAP6iFevp/IbBBTu', 1, 1, 0, NULL, 'Operations', 1, 1, '1535', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:10', '2018-03-23 04:28:10', NULL),
(1666, 'ESCC-2017266', 'Darvin Jay', '', 'Tibon', 'kyledavis@readersmagnet.com', 'Kyle Davis', 'Operations - Sales', 'OSA02', 'Supervisor Trainee (PC)', NULL, NULL, 'Lumpas, Faith', 'Pasion, Ferdinand Jr.', NULL, NULL, '2017-07-01 00:00:00', '$2y$10$s78k1V.o6ka0woSHcOm4Ue9hdVErMA/dHWSlRBWjS/57TnW7deZLK', 1, 1, 0, NULL, 'Operations', 1, 1, '1574', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:10', '2018-03-23 04:28:10', NULL),
(1667, 'ESCC-2017377', 'Stephanie Viene', '', 'Cortes', 'rustonemperua@elink.com.ph', '--', 'Training and Quality', 'TQD04', 'Associate Quality Analyst', NULL, NULL, 'Flores, Nestor', 'Ricarte, Leopoldo Jr.', NULL, NULL, '2017-11-16 00:00:00', '$2y$10$RopPzWPPbxLQGekDG94bIeI9nsIUHeFRIpOkYJ5zHu5ufGgrcchY.', 1, 1, 0, NULL, 'Training', 1, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:10', '2018-03-23 04:28:10', NULL),
(1668, 'ESCC-2017194', 'Kevin', '', 'Desbaro', 'juliusfernandez@elink.com.ph', 'Stephen Parker', 'Training and Quality', 'TQD04', 'Associate Quality Analyst', NULL, NULL, 'Flores, Nestor', 'Ricarte, Leopoldo Jr.', NULL, NULL, '2017-01-11 00:00:00', '$2y$10$GxLpHD87jvFxWmyQvygXb.ouTwu..S5P.LUmufoqyz9EVidETAMFO', 1, 1, 0, NULL, 'Training', 1, 1, '1526', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:10', '2018-03-23 04:28:10', NULL),
(1669, 'ESCC-2017332', 'Ronald', '', 'Francisco', 'ronfrancis@readersmagnet.com', 'Ron Francis', 'Training and Quality', 'TQD04', 'Associate Quality Analyst', NULL, NULL, 'Flores, Nestor', 'Ricarte, Leopoldo Jr.', NULL, NULL, '2017-09-16 00:00:00', '$2y$10$9lRGA0SAVa1rUlejmkcYI./4InLfl9sjbovE82BQydN7ac1STMl8C', 1, 1, 0, NULL, 'Training', 1, 1, '1647', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:11', '2018-03-23 04:28:11', NULL),
(1670, 'ESCC-2018097', 'Luningning', '', 'Vasquez', 'luningningvasquez@elink.com.ph', '--', 'Training and Quality', 'TQD04', 'Development Coach', NULL, NULL, 'Flores, Nestor', 'Ricarte, Leopoldo Jr.', NULL, NULL, '2018-02-27 00:00:00', '$2y$10$SZtAzwY4L3U41PN7cbNU8O8rAUumQf4NNjbSUa2fkX6SoY0ttB/Qu', 1, 1, 0, NULL, 'Training', 1, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:11', '2018-03-23 04:28:11', NULL),
(1671, 'ESCC-2017341', 'Leopoldo Jr.', '', 'Ricarte', 'lukerenolds@readersmagnet.com', '--', 'Training and Quality', 'TQD04', 'Manager', NULL, NULL, 'Pasion, Ferdinand Jr.', '--', NULL, NULL, '2017-10-02 00:00:00', '$2y$10$BF0Zcfk/WzGNcwD2F8WPXu5Be2s0SZTWHzyzM6uifCYeDia.hIh/i', 1, 1, 0, NULL, 'Training', 1, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:11', '2018-03-23 04:28:11', NULL),
(1672, 'ESCC-2018067', 'Dinah Pepito', '', 'Aremon', 'dannareymonds@readersmagnet.com', 'Danna Reymonds', 'Training and Quality', 'TQD04', 'Nesting (MC)', NULL, NULL, 'Desbaro, Kevin', 'Flores, Nestor', NULL, NULL, '2018-04-02 00:00:00', '$2y$10$mmKZVmDtLQjXDeutHQKJL.Ay1Xc3ZxShdldUmGRV8t48EDGWu/8yu', 1, 1, 0, NULL, 'Training', 1, 1, '1764', '16', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:11', '2018-03-23 04:28:11', NULL),
(1673, 'ESCC-2018068', 'Sheila Mae Aguilar', '', 'Aroma', 'sheilaromana@readersmagnet.com', 'Sheila Romana', 'Training and Quality', 'TQD04', 'Nesting (MC)', NULL, NULL, 'Desbaro, Kevin', 'Flores, Nestor', NULL, NULL, '2018-04-02 00:00:00', '$2y$10$EoGcRtdzklFlCZy/nqcnE.V1V/jA4xjjS6uigRvSM07kJ7jYRM/j.', 1, 1, 0, NULL, 'Training', 1, 1, '1765', '16', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:11', '2018-03-23 04:28:11', NULL),
(1674, 'ESCC-2018069', 'Nelson Hortezano Jr.', '', 'Arriesgado', 'nelsonharris@readersmagnet.com', 'Nelson Harris', 'Training and Quality', 'TQD04', 'Nesting (MC)', NULL, NULL, 'Desbaro, Kevin', 'Flores, Nestor', NULL, NULL, '2018-04-02 00:00:00', '$2y$10$CCl0U4iX6nTLSTRxz/a6vOjn7BKvV01XBiOiZ8EOHLk0k8mWFsRua', 1, 1, 0, NULL, 'Training', 1, 1, '1766', '16', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:11', '2018-03-23 04:28:11', NULL),
(1675, 'ESCC-2018070', 'John', '', 'Asumen', 'angellopez@readersmagnet.com', 'Jake Manson', 'Training and Quality', 'TQD04', 'Nesting (MC)', NULL, NULL, 'Desbaro, Kevin', 'Flores, Nestor', NULL, NULL, '2018-04-02 00:00:00', '$2y$10$r3g46zD1H94U8UgFciINWuTI/2tSdFtqVn//kmmRr0rWec.cFgTjG', 1, 1, 0, NULL, 'Training', 1, 1, '1767', '16', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:11', '2018-03-23 04:28:11', NULL),
(1676, 'ESCC-2018074', 'Fernando', '', 'Dela Cerna', 'francisdellan@readersmagnet.com', 'Francis Dellan', 'Training and Quality', 'TQD04', 'Nesting (MC)', NULL, NULL, 'Desbaro, Kevin', 'Flores, Nestor', NULL, NULL, '2018-04-02 00:00:00', '$2y$10$tXFHDnvTqzfAp6LN2ylSxu/OxK.MrOj7AwBHqNFvsCd0p28woyXZq', 1, 1, 0, NULL, 'Training', 1, 1, '1771', '16', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:11', '2018-03-23 04:28:11', NULL),
(1677, 'ESCC-2018078', 'Dennis', '', 'Ebate', 'dannybates@readersmagnet.com', 'Danny Bates', 'Training and Quality', 'TQD04', 'Nesting (MC)', NULL, NULL, 'Desbaro, Kevin', 'Flores, Nestor', NULL, NULL, '2018-04-02 00:00:00', '$2y$10$F1HASF.RI4c9TgZe/kOgJuLt2nyrqFdwByIBaUVRCDvNsZh1rOF4y', 1, 1, 0, NULL, 'Training', 1, 1, '1774', '16', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:11', '2018-03-23 04:28:11', NULL),
(1678, 'ESCC-2018079', 'Manuel', '', 'Espinosa', 'lesliesulivan@readersmagnet.com', 'Miguel Espina', 'Training and Quality', 'TQD04', 'Nesting (MC)', NULL, NULL, 'Desbaro, Kevin', 'Flores, Nestor', NULL, NULL, '2018-04-02 00:00:00', '$2y$10$cy8rqEdEUYaRV4SJ.LJJKOylktNhlu0yqT4euV15vGZuHC2PAubyC', 1, 1, 0, NULL, 'Training', 1, 1, '1775', '16', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:11', '2018-03-23 04:28:11', NULL),
(1679, 'ESCC-2018084', 'Whitney', '', 'Macoy', 'stevepena@readersmagnet.com', 'Whitney Mccoy', 'Training and Quality', 'TQD04', 'Nesting (MC)', NULL, NULL, 'Desbaro, Kevin', 'Flores, Nestor', NULL, NULL, '2018-04-02 00:00:00', '$2y$10$XUHsr2pdS729lX.zAq.CMOWlIRzDZN/DSSYc3kJyCn/cefDvpr5iG', 1, 1, 0, NULL, 'Training', 1, 1, '1780', '16', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:12', '2018-03-23 04:28:12', NULL),
(1680, 'ESCC-2018089', 'Aljon', '', 'Rodeles', 'johnrhodes@readersmagnet.com', 'John Rhodes', 'Training and Quality', 'TQD04', 'Nesting (MC)', NULL, NULL, 'Desbaro, Kevin', 'Flores, Nestor', NULL, NULL, '2018-04-02 00:00:00', '$2y$10$.8NC.4mdzg9GYqqMwH5nA.xYYr/cqr6sVEjNVZ6ROt6El.9OP9eNS', 1, 1, 0, NULL, 'Training', 1, 1, '1785', '16', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:12', '2018-03-23 04:28:12', NULL),
(1681, 'ESCC-2018090', 'Rhollet Marie', '', 'Rondina', 'maureinranders@readersmagnet.com', 'Maurein Randers', 'Training and Quality', 'TQD04', 'Nesting (MC)', NULL, NULL, 'Desbaro, Kevin', 'Flores, Nestor', NULL, NULL, '2018-04-02 00:00:00', '$2y$10$UD1ENgRGL7snXy86AHz.GObVLC5cPeS3PScZfVqy.H8hdF0nArGWu', 1, 1, 0, NULL, 'Training', 1, 1, '1786', '16', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:12', '2018-03-23 04:28:12', NULL),
(1682, 'ESCC-2018093', 'Rex Chilton', '', 'Untalan', 'randywestbrook@readersmagnet.com', 'Rex Chilton', 'Training and Quality', 'TQD04', 'Nesting (MC)', NULL, NULL, 'Desbaro, Kevin', 'Flores, Nestor', NULL, NULL, '2018-04-02 00:00:00', '$2y$10$Zd3oBRHgvQCxOWfmw0DXneDXNmMo3SOCvdjZSl94bTX60N03NJ8Zy', 1, 1, 0, NULL, 'Training', 1, 1, '1789', '16', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:12', '2018-03-23 04:28:12', NULL),
(1683, 'ESCC-2018094', 'Richard Dyn', '', 'Villarino', 'petesilva@readersmagnet.com', 'Richard Dean', 'Training and Quality', 'TQD04', 'Nesting (MC)', NULL, NULL, 'Desbaro, Kevin', 'Flores, Nestor', NULL, NULL, '2018-04-02 00:00:00', '$2y$10$Hg0o27iHRHs3ytQMwoiPcu.Wv6HymkiU0VL5CGe87bW65oXG2gxB6', 1, 1, 0, NULL, 'Training', 1, 1, '1790', '16', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:12', '2018-03-23 04:28:12', NULL),
(1684, 'ESCC-2018066', 'Francisco Alex Dax', '', 'Acedillo', 'francoadams@readersmagnet.com', 'Franco Adams', 'Training and Quality', 'TQD04', 'Nesting (PC)', NULL, NULL, 'Imon, Harris (NESTING)', 'Flores, Nestor', NULL, NULL, '2018-04-02 00:00:00', '$2y$10$KlYPl0HYU/tKGCCvwRvEdudCTbFpHobdOI/XM.gqtEQXK/x2OYceK', 1, 1, 0, NULL, 'Training', 1, 1, '1763', '16', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:12', '2018-03-23 04:28:12', NULL),
(1685, 'ESCC-2018071', 'Lovely Ravelleza', '', 'Banac', 'leahgrady@readersmagnet.com', 'Lovely Ravis', 'Training and Quality', 'TQD04', 'Nesting (PC)', NULL, NULL, 'Imon, Harris (NESTING)', 'Flores, Nestor', NULL, NULL, '2018-04-02 00:00:00', '$2y$10$UOKRbHhZX/5CyiERncrLZ.3.ZX9MRAiYNw9TC4suobw.yVJw1D8f6', 1, 1, 0, NULL, 'Training', 1, 1, '1769', '16', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:12', '2018-03-23 04:28:12', NULL),
(1686, 'ESCC-2018072', 'Rnyl Joey Ong', '', 'Cagas', 'joeycage@readersmagnet.com', 'Joey Cage', 'Training and Quality', 'TQD04', 'Nesting (PC)', NULL, NULL, 'Imon, Harris (NESTING)', 'Flores, Nestor', NULL, NULL, '2018-04-02 00:00:00', '$2y$10$1MoBVemSq/BqSMM9P7fsv.EF2UfjxjJEFtyc4W0HUSah7wxyj5Lxi', 1, 1, 0, NULL, 'Training', 1, 1, '1768', '16', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:12', '2018-03-23 04:28:12', NULL),
(1687, 'ESCC-2018073', 'Jovel Clark', '', 'Contratista', 'johnreypuntual@readersmagnet.com', 'Javis Clarkson', 'Training and Quality', 'TQD04', 'Nesting (PC)', NULL, NULL, 'Imon, Harris (NESTING)', 'Flores, Nestor', NULL, NULL, '2018-04-02 00:00:00', '$2y$10$DCqFSBFe96ZXgFZW7UKetO2vRW/Py6S3w0Ysm/nDxlX5.uflA0EZS', 1, 1, 0, NULL, 'Training', 1, 1, '1770', '16', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:12', '2018-03-23 04:28:12', NULL),
(1688, 'ESCC-2018075', 'Charmaine', '', 'Delantar', 'caradallas@readersmagnet.com', 'Cara Dallas', 'Training and Quality', 'TQD04', 'Nesting (PC)', NULL, NULL, 'Imon, Harris (NESTING)', 'Flores, Nestor', NULL, NULL, '2018-04-02 00:00:00', '$2y$10$IahpFrApIkYxS6wF06tBY.SeMjoj5Hicq15yHPDCY4lmRb.QeXOH.', 1, 1, 0, NULL, 'Training', 1, 1, '1772', '16', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:12', '2018-03-23 04:28:12', NULL),
(1689, 'ESCC-2018080', 'Cromwell', '', 'Ho', 'craigwells@readersmagnet.com', 'Craig Wells', 'Training and Quality', 'TQD04', 'Nesting (PC)', NULL, NULL, 'Imon, Harris (NESTING)', 'Flores, Nestor', NULL, NULL, '2018-04-02 00:00:00', '$2y$10$RnEr.eYlOiWcZ7jEcZspHeo/dJ4PkXPtaCJU4Nun5bUD30gcUC8c2', 1, 1, 0, NULL, 'Training', 1, 1, '1776', '16', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:13', '2018-03-23 04:28:13', NULL),
(1690, 'ESCC-2018081', 'Errica-Joanne Fon', '', 'Lasola', 'erikalarson@readersmagnet.com', 'Erika Larson', 'Training and Quality', 'TQD04', 'Nesting (PC)', NULL, NULL, 'Imon, Harris (NESTING)', 'Flores, Nestor', NULL, NULL, '2018-04-02 00:00:00', '$2y$10$XsdUNy00i5K206oYwPXQR.YoeY6ZJKZEhPYujUOFFVDUnB9uAyi9C', 1, 1, 0, NULL, 'Training', 1, 1, '1777', '16', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:13', '2018-03-23 04:28:13', NULL),
(1691, 'ESCC-2018082', 'Mary Joy', '', 'Lora', 'margocooper@readersmagnet.com', 'Marissa Lopez', 'Training and Quality', 'TQD04', 'Nesting (PC)', NULL, NULL, 'Imon, Harris (NESTING)', 'Flores, Nestor', NULL, NULL, '2018-04-02 00:00:00', '$2y$10$CdyAW1h7HkBJ2.vgXPJGGOKEqqD/X5vCcP8UDvB7RgZj6OVND/daa', 1, 1, 0, NULL, 'Training', 1, 1, '1778', '16', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:13', '2018-03-23 04:28:13', NULL),
(1692, 'ESCC-2018083', 'Khent Canales', '', 'Lorca', 'gabethompson@readersmagnet.com', 'Kenzo Canales', 'Training and Quality', 'TQD04', 'Nesting (PC)', NULL, NULL, 'Imon, Harris (NESTING)', 'Flores, Nestor', NULL, NULL, '2018-04-02 00:00:00', '$2y$10$MR4nI2mGkUcbK/haQjWuCuKi8u8hS96ejx7uzr7EXHLLuzlj1aBDm', 1, 1, 0, NULL, 'Training', 1, 1, '1779', '16', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:13', '2018-03-23 04:28:13', NULL),
(1693, 'ESCC-2018085', 'Queen', '', 'Macuja', 'nicoleannedevaras@readersmagnet.com', 'Keanna Mendrez', 'Training and Quality', 'TQD04', 'Nesting (PC)', NULL, NULL, 'Imon, Harris (NESTING)', 'Flores, Nestor', NULL, NULL, '2018-04-02 00:00:00', '$2y$10$y0FxJcbb1qxHj8B6wNVho.4GuMmbczcwYPHtlMRJxVePaXfbB0CTm', 1, 1, 0, NULL, 'Training', 1, 1, '1781', '16', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:13', '2018-03-23 04:28:13', NULL),
(1694, 'ESCC-2018087', 'Ernest Lou', '', 'Mercado', 'ernestmercer@readersmagnet.com', 'Ernest Mercer', 'Training and Quality', 'TQD04', 'Nesting (PC)', NULL, NULL, 'Imon, Harris (NESTING)', 'Flores, Nestor', NULL, NULL, '2018-04-02 00:00:00', '$2y$10$nhtUQj1Vjl2GylX7fuCbpOwXWC3B1YMrtazQ9ifPtq1tnyQWZS/um', 1, 1, 0, NULL, 'Training', 1, 1, '1783', '16', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:13', '2018-03-23 04:28:13', NULL),
(1695, 'ESCC-2018088', 'Ana Lou', '', 'Quilaga', 'annaqueen@readersmagnet.com', 'Anna Queen', 'Training and Quality', 'TQD04', 'Nesting (PC)', NULL, NULL, 'Imon, Harris (NESTING)', 'Flores, Nestor', NULL, NULL, '2018-04-02 00:00:00', '$2y$10$nk8cEH0kydLBtDxEwtE7uuTmMAwbU3re8crVGSwNdjq/vjeYfw3B.', 1, 1, 0, NULL, 'Training', 1, 1, '1784', '16', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:13', '2018-03-23 04:28:13', NULL),
(1696, 'ESCC-2018091', 'Mark Jason', '', 'Santiso', 'maikeeamoin@elink.com.ph', 'Mark Jansen', 'Training and Quality', 'TQD04', 'Nesting (PC)', NULL, NULL, 'Imon, Harris (NESTING)', 'Flores, Nestor', NULL, NULL, '2018-04-02 00:00:00', '$2y$10$CDLo/ZKITuFn8zGsN2W5zuzAU.b/umJjXFteZMZsMM5CJEx/4QaSi', 1, 1, 0, NULL, 'Training', 1, 1, '1787', '16', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:13', '2018-03-23 04:28:13', NULL),
(1697, 'ESCC-2018092', 'Jorge Vincent', '', 'Tan', 'georgetanner@readersmagnet.com', 'George Tanner', 'Training and Quality', 'TQD04', 'Nesting (PC)', NULL, NULL, 'Imon, Harris (NESTING)', 'Flores, Nestor', NULL, NULL, '2018-04-02 00:00:00', '$2y$10$PMOaLzpLDPmlKjiYJUFpeuZOvY8dAF.zAe0XLFxEiUTvshd2X2cAW', 1, 1, 0, NULL, 'Training', 1, 1, '1788', '16', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:13', '2018-03-23 04:28:13', NULL),
(1698, 'ESCC-2017385', 'Nestor', '', 'Flores', 'michiemendoza@readersmagnet.com', '--', 'Training and Quality', 'TQD04', 'Supervisor (Interim)', NULL, NULL, 'Ricarte, Leopoldo Jr.', 'Pasion, Ferdinand Jr.', NULL, NULL, '2017-12-18 00:00:00', '$2y$10$B0tf/yTJKwlRFTlYEWeHseazi..yUPA1oGJNt87/W0w9UuNFF2n6G', 1, 1, 0, NULL, 'Training', 1, 1, '--', '', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:13', '2018-03-23 04:28:13', NULL),
(1699, 'ESCC-2018063', 'James Dodge', '', 'Perez', 'jamesdodge@readersmagnet.com', 'James Dodge', 'Training and Quality', 'TQD04', 'Supervisor (MC)', NULL, NULL, 'Desbaro, Kevin', 'Flores, Nestor', NULL, NULL, '2018-04-02 00:00:00', '$2y$10$5Db0iloSYwGze4OxFuBjGu1MRiW150rJ9pKeWh.T1APZqx.bJHa0W', 1, 1, 0, NULL, 'Training', 1, 1, '1792', '16', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:14', '2018-03-23 04:28:14', NULL),
(1700, 'ESCC-2018115', 'Mary Grace', '', 'Salem', 'alvinsalem@readersmagnet.com', '--', 'Training and Quality', 'TQD04', 'Trainee', NULL, NULL, 'Esinada, Ruggie Whyl', 'Ricarte, Leopoldo Jr.', NULL, '2018-03-07 00:00:00', '2018-05-01 00:00:00', '$2y$10$eMkNGFYPZAVR/UqyPrLaf.yIJGkNMpVLJo5UeDfY2fGdGw0h4AV/e', 1, 1, 0, NULL, 'Training', 1, 1, '--', '17-A', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:14', '2018-03-23 04:28:14', NULL),
(1701, 'ESCC-2018122', 'Margeorie', '', 'Araneta', 'lindaplaza@readersmagnet.com', '--', 'Training and Quality', 'TQD04', 'Trainee', NULL, NULL, 'Flores, Nestor', 'Ricarte, Leopoldo Jr.', NULL, '2018-03-07 00:00:00', '2018-05-01 00:00:00', '$2y$10$iloI.S4t7/A20JiM2MS3Su9eJYrJEmGC5VjrlgHekQIMZjmKu901C', 1, 1, 0, NULL, 'Training', 1, 1, '--', '17-B', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:14', '2018-03-23 04:28:14', NULL),
(1702, 'ESCC-2018126', 'William Joseph', '', 'Belandres', 'javisclarkson@readersmagnet.com', '--', 'Training and Quality', 'TQD04', 'Trainee', NULL, NULL, 'Flores, Nestor', 'Ricarte, Leopoldo Jr.', NULL, '2018-03-07 00:00:00', '2018-05-01 00:00:00', '$2y$10$LZXUYuzbq3tghYkcVzTO4.L3Eh0p1MwCY9f7JlZPumXrQLxNHg0aS', 1, 1, 0, NULL, 'Training', 1, 1, '--', '17-B', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:14', '2018-03-23 04:28:14', NULL),
(1703, 'ESCC-2018127', 'Ivanniel Walfrey', '', 'Beliran', 'ivanwalfrey@readersmagnet.com', '--', 'Training and Quality', 'TQD04', 'Trainee', NULL, NULL, 'Flores, Nestor', 'Ricarte, Leopoldo Jr.', NULL, '2018-03-07 00:00:00', '2018-05-01 00:00:00', '$2y$10$JB8hdbiCdDfWVv0umZNpxOc76ar7R7vcNnWqs7nc6q76YM8u8sP1i', 1, 1, 0, NULL, 'Training', 1, 1, '--', '17-B', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:14', '2018-03-23 04:28:14', NULL),
(1704, 'ESCC-2018128', 'Richard Fave Marie', '', 'Briones', 'paulinemateo@readersmagnet.com', '--', 'Training and Quality', 'TQD04', 'Trainee', NULL, NULL, 'Flores, Nestor', 'Ricarte, Leopoldo Jr.', NULL, '2018-03-07 00:00:00', '2018-05-01 00:00:00', '$2y$10$viS4e5Mjjhl6f3kjUWUZz.Fm3t95upkeYjr2u4ZOVpHkdZqYzwRha', 1, 1, 0, NULL, 'Training', 1, 1, '--', '17-B', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 04:28:14', '2018-03-23 04:28:14', NULL),
(1705, 'ESCC-12081996', 'Jeneriza', 'Belda', 'Gesapine', 'johnmanuelderecho@elink.com.ph', 'Isai Pine', 'Eat Department', NULL, 'Webmaster', 1587, NULL, NULL, NULL, '1996-12-08 05:04:00', '2018-03-25 05:04:00', '2018-03-25 05:04:00', '$2y$10$KnQ0oOas0db6d84MraPmxObDRswtscfP4NMhzelsOs7nPpnsNAatq', 2, 2, 1587, NULL, NULL, 4, 1, '844', '1', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 05:04:00', '2018-03-23 05:04:00', NULL),
(1706, '123', '123', '123', '123', 'michelledeleon@elink.com.ph', '123', 'IT Department', NULL, '123', 1562, NULL, NULL, NULL, '2018-03-23 05:05:01', '2018-03-23 05:05:01', '2018-03-23 05:05:01', '$2y$10$mJRaIdEvkMcjtkDokOlvs.Q6aASmEpcO8LkembJhWqXbiOxGZiUI6', 2, 1, 1562, NULL, NULL, 1, 1, '123', '123', 0, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 05:05:01', '2018-03-23 05:05:01', NULL),
(1707, '1', '1', '1', '1', 'johnmanuelderecho@elink.com.ph', '1', 'Eat Department', NULL, '1', NULL, NULL, '123, 123', NULL, '1995-12-06 05:23:43', '2018-03-25 05:23:43', '2018-03-25 05:23:43', '$2y$10$T8bB2fOrZWJp/aj7IRm5kugUNAxry/brk8mPcKt7Hc1xXFw0iVbr2', 1, 1, 0, NULL, NULL, 4, 1, '123', '123', 1, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 05:23:43', '2018-03-23 05:23:43', NULL),
(1708, '1', '1', '1', '1', 'h@gmail.com', '1', 'IT Department', NULL, '1', NULL, NULL, 'Medrozo, Jaydar', NULL, '2018-03-23 05:35:59', '2018-04-03 05:35:59', '2018-06-05 05:35:59', '$2y$10$3x01gYx2K3r/LtGXvTf9..yWDqy3rHyk6RU6Kswk1sKqSxNq9pdzi', 1, 1, 0, NULL, NULL, 1, 1, '1', '1', 0, 'http://localhost/elinkemployeedirectory/public/img/nobody_m.original.jpg', NULL, '2018-03-23 05:35:59', '2018-03-23 05:35:59', NULL),
(1709, '123', 'test', 'test', 'test', 'johnmanuelderecho@elink.com.ph', 'test', 'IT Department', NULL, 'test', NULL, NULL, 'Del Rio, Duane Marie Lyka', 'De Leon, Michelle', '1995-12-06 05:38:54', '2018-03-20 05:38:54', '2018-03-20 05:38:54', '$2y$10$Z4OalaLT8rwe9fp16jwIIOFD4vKuLttmaPw9fRmfdQnY/fY/LnDUK', 1, 1, 0, NULL, NULL, 1, 1, '1', '1', 1, 'http://localhost/elinkemployeedirectory/storage/app/images/1709/I8sH4sPhlHn4jp08LF5oVWtzTSt3koMmNfcFNo2L.jpeg', NULL, '2018-03-23 05:38:54', '2018-03-23 05:38:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_manager`
--

CREATE TABLE `employee_manager` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `employee_role`
--

CREATE TABLE `employee_role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_role`
--

INSERT INTO `employee_role` (`id`, `role_name`) VALUES
(1, 'Accounting'),
(2, 'Accounting Specialist'),
(3, 'Admin & HR Assistant '),
(4, 'Agent (MC)'),
(5, 'Agent (PC)'),
(6, 'Associate Quality Analyst'),
(7, 'Au Hr Admin/Supervisor'),
(8, 'Branding/Marketing Officer'),
(9, 'Development Coach'),
(10, 'Documentation Specialist'),
(11, 'Engineering Admin'),
(12, 'Executive Assistant'),
(13, 'Finance'),
(14, 'Fulfillment'),
(15, 'GM'),
(16, 'Lead Distribution'),
(17, 'Lead Generation'),
(18, 'Manager'),
(19, 'Marketing Production'),
(20, 'Nesting (MC)'),
(21, 'Nesting (PC)'),
(22, 'Publishing Production'),
(23, 'Reports Analyst'),
(24, 'Sourcing Specialist - Project Based'),
(25, 'Supervisor'),
(26, 'Supervisor (Interim)'),
(27, 'Supervisor (MC)'),
(28, 'Supervisor (PC)'),
(29, 'Supervisor Trainee (MC)'),
(30, 'Supervisor Trainee (PC)'),
(31, 'System Programmer'),
(32, 'Technical Writer'),
(33, 'Technical Writing Staff'),
(34, 'Trainee'),
(35, 'Trainer'),
(36, 'Web Developer');

-- --------------------------------------------------------

--
-- Table structure for table `employee_supervisor`
--

CREATE TABLE `employee_supervisor` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `elink_account`
--
ALTER TABLE `elink_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `elink_division`
--
ALTER TABLE `elink_division`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `employee_manager`
--
ALTER TABLE `employee_manager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_position`
--
ALTER TABLE `employee_position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_role`
--
ALTER TABLE `employee_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_supervisor`
--
ALTER TABLE `employee_supervisor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `elink_account`
--
ALTER TABLE `elink_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `elink_division`
--
ALTER TABLE `elink_division`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employee_department`
--
ALTER TABLE `employee_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employee_info`
--
ALTER TABLE `employee_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1710;

--
-- AUTO_INCREMENT for table `employee_manager`
--
ALTER TABLE `employee_manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_position`
--
ALTER TABLE `employee_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee_role`
--
ALTER TABLE `employee_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `employee_supervisor`
--
ALTER TABLE `employee_supervisor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
