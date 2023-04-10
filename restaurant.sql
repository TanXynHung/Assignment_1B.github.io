-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2023 at 06:56 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--
CREATE DATABASE IF NOT EXISTS `restaurant` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `restaurant`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(255) NOT NULL,
  `userID` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `userID`, `name`, `price`, `quantity`, `image`) VALUES
(37, '2', 'Subway ', '12', 1, 'food-3.png'),
(39, '2', 'French Fried', '9', 1, 'food-6.png'),
(40, '2', 'Burger', '17', 1, 'food-1.png'),
(41, '2', 'SandWich', '9', 1, 'food-4.png');

-- --------------------------------------------------------

--
-- Table structure for table `customer_login`
--

CREATE TABLE `customer_login` (
  `userID` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_login`
--

INSERT INTO `customer_login` (`userID`, `userName`, `password`) VALUES
(1, 'admin', '1111'),
(2, 'xyn', '1111'),
(3, 'asdas', '123123'),
(4, 'asd', 'asd'),
(5, 'xyn', '1234'),
(6, 'xynddaa', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `kitchen`
--

CREATE TABLE `kitchen` (
  `id` int(255) NOT NULL,
  `userID` varchar(255) NOT NULL,
  `total_products` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kitchen`
--

INSERT INTO `kitchen` (`id`, `userID`, `total_products`, `total_price`, `status`) VALUES
(1, '2', 'Burger(1)', '17', 1),
(2, '2', 'Subway (1)', '12', 0),
(3, '2', 'Subway (5)', '60', 0),
(4, '2', 'Pizza(1),Subway (1)', '32', 0),
(5, '2', 'Subway (3)', '36', 0),
(6, '2', 'Subway (4),French Fried(4),Pizza(4)', '164', 0),
(7, '2', 'Pizza(1),Burger(4)', '88', 0),
(8, '2', 'Burger(1),French Fried(1)', '26', 0),
(9, '2', 'Subway (1),Burger(1),SandWich(1),French Fried(1),Coca-Cola(1),Pizza(1)', '72', 0),
(10, '2', 'French Fried(2),Coca-Cola(1)', '23', 0),
(11, '2', 'Burger(3),Pizza(1),Subway (1)', '83', 0),
(12, '2', 'SandWich(1),Subway (1),French Fried(1)', '30', 0),
(13, '2', 'Subway (7),Pizza(1),Burger(1),SandWich(1)', '130', 0),
(14, '2', 'SandWich(1),Subway (1),French Fried(1)', '30', 0),
(15, '2', 'Subway (1)', '12', 0),
(16, '2', 'Burger', '17', 0),
(17, '2', 'Coca-Cola', '5', 0),
(18, '2', 'French Fried', '9', 0),
(19, '2', 'Pizza', '20', 0),
(20, '2', 'Pizza', '20', 0),
(21, '2', 'SandWich', '9', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`) VALUES
(1, 'Burger', '17', 'food-1.png'),
(2, 'Pizza', '20', 'food-2.png'),
(3, 'Subway ', '12', 'food-3.png'),
(4, 'SandWich', '9', 'food-4.png'),
(5, 'Coca-Cola', '5', 'food-5.png'),
(6, 'French Fried', '9', 'food-6.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `customer_login`
--
ALTER TABLE `customer_login`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `kitchen`
--
ALTER TABLE `kitchen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `customer_login`
--
ALTER TABLE `customer_login`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kitchen`
--
ALTER TABLE `kitchen`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
