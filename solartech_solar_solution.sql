-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 27, 2022 at 02:09 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `solartech_solar_solution`
--

-- --------------------------------------------------------

--
-- Table structure for table `Bill`
--

CREATE TABLE `Bill` (
  `bill_id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `bill_number_id` int(11) NOT NULL,
  `price` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Bill_Number`
--

CREATE TABLE `Bill_Number` (
  `bill_number_id` int(11) NOT NULL,
  `bill_number_name` varchar(130) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE `Category` (
  `categ_id` int(11) NOT NULL,
  `categ_name` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Company`
--

CREATE TABLE `Company` (
  `comp_id` int(11) NOT NULL,
  `comp_name` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Country`
--

CREATE TABLE `Country` (
  `count_id` int(11) NOT NULL,
  `count_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `currency_id` int(11) NOT NULL,
  `currency_name` varchar(50) NOT NULL,
  `currency_symbol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE `Customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_f_name` varchar(150) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `cutomer_image` varchar(100) NOT NULL,
  `customer_address` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Customer_Buy_Goods`
--

CREATE TABLE `Customer_Buy_Goods` (
  `customer_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `buy_date` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` bigint(20) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `District`
--

CREATE TABLE `District` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(150) NOT NULL,
  `province_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Goods`
--

CREATE TABLE `Goods` (
  `goods_id` int(11) NOT NULL,
  `goods_name` varchar(150) NOT NULL,
  `goods_discription` varchar(500) NOT NULL,
  `buy_price` bigint(20) NOT NULL,
  `entry_date` date NOT NULL,
  `image` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `currency` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Loan`
--

CREATE TABLE `Loan` (
  `loan_id` int(11) NOT NULL,
  `loan_quantity` bigint(20) NOT NULL,
  `paid_quantity` bigint(20) NOT NULL,
  `total_paid` tinyint(1) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Location`
--

CREATE TABLE `Location` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(150) NOT NULL,
  `location_province` int(11) NOT NULL,
  `location_district` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Mobile_Numbers`
--

CREATE TABLE `Mobile_Numbers` (
  `mobile_id` int(11) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Province`
--

CREATE TABLE `Province` (
  `province_id` int(11) NOT NULL,
  `province_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Seller`
--

CREATE TABLE `Seller` (
  `seller_id` int(11) NOT NULL,
  `seller_name` varchar(150) NOT NULL,
  `seller_fname` varchar(150) NOT NULL,
  `seller_user_name` varchar(100) NOT NULL,
  `seller_password` varchar(150) NOT NULL,
  `seller_email` varchar(150) NOT NULL,
  `seller_image` varchar(250) NOT NULL,
  `seller_address` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Store`
--

CREATE TABLE `Store` (
  `store_id` int(11) NOT NULL,
  `store_name` varchar(150) NOT NULL,
  `store_address` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Unit`
--

CREATE TABLE `Unit` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Bill`
--
ALTER TABLE `Bill`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `fk_bill_number_id` (`bill_number_id`),
  ADD KEY `fk_bill_currency_id` (`currency_id`),
  ADD KEY `fk_bill_customer_id` (`customer_id`),
  ADD KEY `fkbill_goods_id` (`goods_id`),
  ADD KEY `fk_bill_seller_id` (`seller_id`),
  ADD KEY `fk_bill_store_id` (`store_id`);

--
-- Indexes for table `Bill_Number`
--
ALTER TABLE `Bill_Number`
  ADD PRIMARY KEY (`bill_number_id`);

--
-- Indexes for table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`categ_id`);

--
-- Indexes for table `Company`
--
ALTER TABLE `Company`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indexes for table `Country`
--
ALTER TABLE `Country`
  ADD PRIMARY KEY (`count_id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`currency_id`);

--
-- Indexes for table `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `fk_customer_location` (`customer_address`);

--
-- Indexes for table `Customer_Buy_Goods`
--
ALTER TABLE `Customer_Buy_Goods`
  ADD KEY `fk_currency_id` (`currency_id`),
  ADD KEY `fk_customer_id` (`customer_id`),
  ADD KEY `fk_sell_id` (`seller_id`),
  ADD KEY `fk_store_id` (`store_id`),
  ADD KEY `fk_good_id` (`goods_id`);

--
-- Indexes for table `District`
--
ALTER TABLE `District`
  ADD PRIMARY KEY (`district_id`),
  ADD KEY `fk_district_province_id` (`province_id`);

--
-- Indexes for table `Goods`
--
ALTER TABLE `Goods`
  ADD PRIMARY KEY (`goods_id`),
  ADD KEY `fk_category_id` (`category_id`),
  ADD KEY `fk_company_id` (`company_id`),
  ADD KEY `fk_country_id` (`country_id`),
  ADD KEY `fk_currency` (`currency`),
  ADD KEY `fk_unit_id` (`unit_id`);

--
-- Indexes for table `Loan`
--
ALTER TABLE `Loan`
  ADD PRIMARY KEY (`loan_id`),
  ADD KEY `fk_loan_customer_id` (`customer_id`);

--
-- Indexes for table `Location`
--
ALTER TABLE `Location`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `fk_location_province_id` (`location_province`),
  ADD KEY `fk_location_district_id` (`location_district`);

--
-- Indexes for table `Mobile_Numbers`
--
ALTER TABLE `Mobile_Numbers`
  ADD PRIMARY KEY (`mobile_id`),
  ADD KEY `fk_mobile_number_customer` (`customer_id`);

--
-- Indexes for table `Province`
--
ALTER TABLE `Province`
  ADD PRIMARY KEY (`province_id`);

--
-- Indexes for table `Seller`
--
ALTER TABLE `Seller`
  ADD PRIMARY KEY (`seller_id`),
  ADD KEY `fk_seller_location` (`seller_address`);

--
-- Indexes for table `Store`
--
ALTER TABLE `Store`
  ADD PRIMARY KEY (`store_id`),
  ADD KEY `fk_store_location_id` (`store_address`);

--
-- Indexes for table `Unit`
--
ALTER TABLE `Unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Bill`
--
ALTER TABLE `Bill`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Bill_Number`
--
ALTER TABLE `Bill_Number`
  MODIFY `bill_number_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Category`
--
ALTER TABLE `Category`
  MODIFY `categ_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Company`
--
ALTER TABLE `Company`
  MODIFY `comp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Country`
--
ALTER TABLE `Country`
  MODIFY `count_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `currency_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Customer`
--
ALTER TABLE `Customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `District`
--
ALTER TABLE `District`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Goods`
--
ALTER TABLE `Goods`
  MODIFY `goods_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Loan`
--
ALTER TABLE `Loan`
  MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Location`
--
ALTER TABLE `Location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Mobile_Numbers`
--
ALTER TABLE `Mobile_Numbers`
  MODIFY `mobile_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Province`
--
ALTER TABLE `Province`
  MODIFY `province_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Seller`
--
ALTER TABLE `Seller`
  MODIFY `seller_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Store`
--
ALTER TABLE `Store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Unit`
--
ALTER TABLE `Unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Bill`
--
ALTER TABLE `Bill`
  ADD CONSTRAINT `fk_bill_currency_id` FOREIGN KEY (`currency_id`) REFERENCES `currency` (`currency_id`),
  ADD CONSTRAINT `fk_bill_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `Customer` (`customer_id`),
  ADD CONSTRAINT `fk_bill_number_id` FOREIGN KEY (`bill_number_id`) REFERENCES `Bill_Number` (`bill_number_id`),
  ADD CONSTRAINT `fk_bill_seller_id` FOREIGN KEY (`seller_id`) REFERENCES `Seller` (`seller_id`),
  ADD CONSTRAINT `fk_bill_store_id` FOREIGN KEY (`store_id`) REFERENCES `Store` (`store_id`),
  ADD CONSTRAINT `fkbill_goods_id` FOREIGN KEY (`goods_id`) REFERENCES `Goods` (`goods_id`);

--
-- Constraints for table `Customer`
--
ALTER TABLE `Customer`
  ADD CONSTRAINT `fk_customer_location` FOREIGN KEY (`customer_address`) REFERENCES `Location` (`location_id`);

--
-- Constraints for table `Customer_Buy_Goods`
--
ALTER TABLE `Customer_Buy_Goods`
  ADD CONSTRAINT `fk_currency_id` FOREIGN KEY (`currency_id`) REFERENCES `currency` (`currency_id`),
  ADD CONSTRAINT `fk_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `Customer` (`customer_id`),
  ADD CONSTRAINT `fk_good_id` FOREIGN KEY (`goods_id`) REFERENCES `Goods` (`goods_id`),
  ADD CONSTRAINT `fk_sell_id` FOREIGN KEY (`seller_id`) REFERENCES `Seller` (`seller_id`),
  ADD CONSTRAINT `fk_store_id` FOREIGN KEY (`store_id`) REFERENCES `Store` (`store_id`);

--
-- Constraints for table `District`
--
ALTER TABLE `District`
  ADD CONSTRAINT `fk_district_province_id` FOREIGN KEY (`province_id`) REFERENCES `Province` (`province_id`);

--
-- Constraints for table `Goods`
--
ALTER TABLE `Goods`
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `Category` (`categ_id`),
  ADD CONSTRAINT `fk_company_id` FOREIGN KEY (`company_id`) REFERENCES `Company` (`comp_id`),
  ADD CONSTRAINT `fk_country_id` FOREIGN KEY (`country_id`) REFERENCES `Country` (`count_id`),
  ADD CONSTRAINT `fk_currency` FOREIGN KEY (`currency`) REFERENCES `currency` (`currency_id`),
  ADD CONSTRAINT `fk_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `Unit` (`unit_id`);

--
-- Constraints for table `Loan`
--
ALTER TABLE `Loan`
  ADD CONSTRAINT `fk_loan_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `Customer` (`customer_id`);

--
-- Constraints for table `Location`
--
ALTER TABLE `Location`
  ADD CONSTRAINT `fk_location_district_id` FOREIGN KEY (`location_district`) REFERENCES `District` (`district_id`),
  ADD CONSTRAINT `fk_location_province_id` FOREIGN KEY (`location_province`) REFERENCES `Province` (`province_id`);

--
-- Constraints for table `Mobile_Numbers`
--
ALTER TABLE `Mobile_Numbers`
  ADD CONSTRAINT `fk_mobile_number_customer` FOREIGN KEY (`customer_id`) REFERENCES `Customer` (`customer_id`);

--
-- Constraints for table `Seller`
--
ALTER TABLE `Seller`
  ADD CONSTRAINT `fk_seller_location` FOREIGN KEY (`seller_address`) REFERENCES `Location` (`location_id`);

--
-- Constraints for table `Store`
--
ALTER TABLE `Store`
  ADD CONSTRAINT `fk_store_location_id` FOREIGN KEY (`store_address`) REFERENCES `Location` (`location_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
