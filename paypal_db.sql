-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2024 at 04:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paypal_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `orderid` int(11) NOT NULL,
  `ordername` longtext NOT NULL,
  `orderemail` longtext NOT NULL,
  `orderpayerid` longtext NOT NULL,
  `orderfn` longtext NOT NULL,
  `ordervalue` longtext NOT NULL,
  `ordercurrency` longtext NOT NULL,
  `orderstatus` longtext NOT NULL,
  `orderstate` longtext NOT NULL,
  `ordertitle` longtext NOT NULL,
  `orderdate` longtext NOT NULL,
  `ordertime` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`orderid`, `ordername`, `orderemail`, `orderpayerid`, `orderfn`, `ordervalue`, `ordercurrency`, `orderstatus`, `orderstate`, `ordertitle`, `orderdate`, `ordertime`) VALUES
(19, 'Jomar Martinez', 'demopayer@gmail.com', 'MA8D7QTL63GMQ', '1 Main St San Jose CA 95131 US', '$990.00', 'USD', 'COMPLETED', 'Complete', 'Tshirt', 'December 13, 2024', ' 11:25:am'),
(20, 'Jomar Martinez', 'demopayer@gmail.com', 'MA8D7QTL63GMQ', '1 Main St San Jose CA 95131 US', '$789.00', 'USD', 'COMPLETED', 'Pending', 'Short', 'December 13, 2024', ' 11:27:am');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `ProductID` int(11) NOT NULL,
  `ProductName` longtext NOT NULL,
  `ProductPrice` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`ProductID`, `ProductName`, `ProductPrice`) VALUES
(1, 'Short', '789'),
(3, 'Tshirt', '990');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`orderid`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`ProductID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
