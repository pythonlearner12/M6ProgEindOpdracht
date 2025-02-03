-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mariadb
-- Generation Time: Jan 31, 2025 at 10:07 PM
-- Server version: 11.5.2-MariaDB-ubu2404
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `m6prog`
--

-- --------------------------------------------------------

--
-- Table structure for table `dishes`
--

CREATE TABLE `dishes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `ingrediants` varchar(500) DEFAULT NULL,
  `imagelink` varchar(255) DEFAULT NULL,
  `dishtype_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dishtype`
--

CREATE TABLE `dishtype` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `dishtype`
--

INSERT INTO `dishtype` (`id`, `name`) VALUES
(1, 'Starter'),
(2, 'Main Course'),
(4, 'Dessert'),
(5, 'Lunch');

-- --------------------------------------------------------

--
-- Table structure for table `drinks`
--

CREATE TABLE `drinks` (
  `id` int(11) NOT NULL,
  `hot` tinyint(1) NOT NULL,
  `alcohol` tinyint(1) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `ingrediants` varchar(255) NOT NULL,
  `imagelink` varchar(255) DEFAULT NULL,
  `drinktype_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `drinks`
--

INSERT INTO `drinks` (`id`, `hot`, `alcohol`, `name`, `price`, `ingrediants`, `imagelink`, `drinktype_id`) VALUES
(1, 0, 0, 'abc', 8.23, 'hdsahoddsa', 'https://36563.hosts2.ma-cloud.nl/prog/img/imageExample.jpg', 6),
(2, 0, 0, '', 5.13, 'abc', 'https://36563.hosts2.ma-cloud.nl/prog/img/imageExample.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `drinktype`
--

CREATE TABLE `drinktype` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `drinktype`
--

INSERT INTO `drinktype` (`id`, `name`) VALUES
(1, 'Wine'),
(3, 'Beer'),
(4, 'Cocktails'),
(5, 'Non Alcaholic'),
(6, 'Soft Drink');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `table` int(11) NOT NULL,
  `starter_dish_id` int(11) DEFAULT NULL,
  `drinks_id` int(11) DEFAULT NULL,
  `main_dish_id` int(11) DEFAULT NULL,
  `dessert_dish_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `table`, `starter_dish_id`, `drinks_id`, `main_dish_id`, `dessert_dish_id`) VALUES
(1, 12, 1, NULL, 5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `tablenumber` int(11) NOT NULL,
  `time` time NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `date`, `tablenumber`, `time`, `name`) VALUES
(1, '2025-01-31', 1, '16:00:00', 'Bob'),
(2, '2025-01-31', 1, '17:00:00', 'bob3'),
(3, '2025-01-31', 1, '11:00:00', 'test'),
(4, '2025-01-31', 4, '11:00:00', 'fred');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` int(11) NOT NULL,
  `tablenumber` int(11) DEFAULT NULL,
  `maxpeople` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `tablenumber`, `maxpeople`) VALUES
(1, 1, 4),
(2, 3, 5),
(3, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `websiteText`
--

CREATE TABLE `websiteText` (
  `id` int(11) NOT NULL,
  `pageName` varchar(100) NOT NULL,
  `heroText` varchar(500) NOT NULL,
  `textName` varchar(500) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `websiteText`
--

INSERT INTO `websiteText` (`id`, `pageName`, `heroText`, `textName`, `address`) VALUES
(1, '', 'Welkom bij restaurant The Velvet Fork het goede menu, bij ons kunt u elke dag genieten van een speciaal samengesteld menu. Geniet van onze rustieke sfeer terwijl u een heerlijke lunch of dinner nuttigd', 'The Velvet Fork', '            Zomerzonlaan 6347 postcode 9876ZU College van Media stad Nederland');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dishes_fk_1` (`dishtype_id`);

--
-- Indexes for table `dishtype`
--
ALTER TABLE `dishtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drinks`
--
ALTER TABLE `drinks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `drinks_fk_1` (`drinktype_id`);

--
-- Indexes for table `drinktype`
--
ALTER TABLE `drinktype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `websiteText`
--
ALTER TABLE `websiteText`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dishes`
--
ALTER TABLE `dishes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dishtype`
--
ALTER TABLE `dishtype`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `drinks`
--
ALTER TABLE `drinks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `drinktype`
--
ALTER TABLE `drinktype`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `websiteText`
--
ALTER TABLE `websiteText`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dishes`
--
ALTER TABLE `dishes`
  ADD CONSTRAINT `dishes_fk_1` FOREIGN KEY (`dishtype_id`) REFERENCES `dishtype` (`id`);

--
-- Constraints for table `drinks`
--
ALTER TABLE `drinks`
  ADD CONSTRAINT `drinks_fk_1` FOREIGN KEY (`drinktype_id`) REFERENCES `drinktype` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
