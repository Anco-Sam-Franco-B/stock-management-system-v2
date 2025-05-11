-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 09, 2025 at 01:42 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `productin`
--

DROP TABLE IF EXISTS `productin`;
CREATE TABLE IF NOT EXISTS `productin` (
  `ProductIn_id` int NOT NULL AUTO_INCREMENT,
  `PCode` varchar(255) NOT NULL,
  `prIn_Date` date NOT NULL,
  `prIn_Quantity` int NOT NULL,
  `prIn_Unit_price` int NOT NULL,
  `prIn_Totalprice` int NOT NULL,
  PRIMARY KEY (`ProductIn_id`),
  KEY `PCode` (`PCode`(250))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productout`
--

DROP TABLE IF EXISTS `productout`;
CREATE TABLE IF NOT EXISTS `productout` (
  `ProductOut_id` int NOT NULL AUTO_INCREMENT,
  `PCode` varchar(255) NOT NULL,
  `prOut_Date` int NOT NULL,
  `prOut_Quantity` int NOT NULL,
  `prOut_Unit_price` int NOT NULL,
  `prOut_Totalprice` int NOT NULL,
  PRIMARY KEY (`ProductOut_id`),
  KEY `PCode` (`PCode`(250))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `PCode` varchar(220) NOT NULL,
  `PName` varchar(255) NOT NULL,
  `PQuantity` int NOT NULL,
  `PUnit_Price` int NOT NULL,
  `PTotal_price` int NOT NULL,
  PRIMARY KEY (`PCode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `UserId` int NOT NULL AUTO_INCREMENT,
  `UserName` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
