-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2017 at 05:31 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app`
--


DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `test` ()  NO SQL
SELECT * INTO OUTFILE '/tmp/users.sql' FROM `app`.`users`$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `ACCOUNT_ID` bigint(255) NOT NULL,
  `OWNER_ID` varchar(255) NOT NULL,
  `ACCOUNT_TYPE` varchar(3) NOT NULL,
  `CONTACT_SALUTATION` varchar(3) DEFAULT NULL,
  `CONTACT_FIRST_NAME` varchar(35) DEFAULT NULL,
  `CONTACT_LAST_NAME` varchar(35) DEFAULT NULL,
  `COMPANY_NAME` varchar(70) DEFAULT NULL,
  `ACCOUNT_TITLE` varchar(60) NOT NULL,
  `CURRENCY` varchar(3) NOT NULL,
  `DUE_DAYS` int(5) DEFAULT NULL,
  `ADDRESS` varchar(50) DEFAULT NULL,
  `STREET` varchar(50) DEFAULT NULL,
  `CITY` varchar(30) DEFAULT NULL,
  `STATE` varchar(50) DEFAULT NULL,
  `ZIP` int(20) DEFAULT NULL,
  `COUNTRY` varchar(2) DEFAULT NULL,
  `CONTACT_EMAIL` varchar(255) DEFAULT NULL,
  `CONTACT_PHONE` bigint(20) DEFAULT NULL,
  `CONTACT_MOBILE` bigint(20) DEFAULT NULL,
  `WEBSITE` varchar(255) DEFAULT NULL,
  `COMMENT` text,
  `ACTIVITY_STATUS` int(1) DEFAULT NULL,
  `DATE_OF_CREATION` datetime DEFAULT CURRENT_TIMESTAMP,
  `LIST_RANKING` mediumint(9) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact_requests`
--

CREATE TABLE `contact_requests` (
  `NO` bigint(255) NOT NULL,
  `IP` varchar(30) NOT NULL,
  `NAME` varchar(70) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `REASON FOR CONTACT` varchar(3) NOT NULL,
  `SUBJECT` varchar(50) DEFAULT NULL,
  `MESSAGE` text,
  `TIMESTAMP` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `DOCUMENT_ID` bigint(255) NOT NULL,
  `OWNER_ID` varchar(255) NOT NULL,
  `SERVER_FILE_NAME` varchar(100) NOT NULL,
  `FILENAME` varchar(100) NOT NULL,
  `FILE_SIZE` int(10) NOT NULL,
  `FILE_EXTENSION` varchar(10) NOT NULL,
  `FILE_TYPE` varchar(255) NOT NULL,
  `DATE_OF_UPLOAD` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `NO` bigint(255) NOT NULL,
  `IP` varchar(20) NOT NULL,
  `NAME` varchar(70) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `How would you rate your overall experience with our service?` varchar(3) NOT NULL,
  `How would you rate our prices?` varchar(3) NOT NULL,
  `Would you recommend our product / service to other people?` varchar(3) NOT NULL,
  `FEEDBACK` text,
  `TIMESTAMP` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `NO` bigint(255) NOT NULL,
  `IP` varchar(20) NOT NULL,
  `NAME` varchar(70) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `What is your qualification?` varchar(3) NOT NULL,
  `How much experienced?` varchar(30) NOT NULL,
  `Why should we hire you?` text,
  `TIMESTAMP` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `TRANSACTION_ID` bigint(255) NOT NULL,
  `ACCOUNT_ID` bigint(255) NOT NULL,
  `OWNER_ID` varchar(255) NOT NULL,
  `PARTICULARS` varchar(255) DEFAULT NULL,
  `BILL_INVOICE_NO` int(50) DEFAULT NULL,
  `TRANSACTION_TYPE` varchar(3) NOT NULL,
  `TRANSACTION_ACTION` varchar(3) NOT NULL,
  `TRANSACTION_METHOD` varchar(50) DEFAULT NULL,
  `TRANSACTION_AMOUNT` double NOT NULL,
  `COMMENT` text,
  `DATE_OF_TRANSACTION` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` varchar(255) NOT NULL,
  `FIRST_NAME` varchar(35) DEFAULT NULL,
  `LAST_NAME` varchar(35) DEFAULT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `PASSWORD` varchar(128) NOT NULL,
  `GENDER` enum('M','F') DEFAULT NULL,
  `DATE OF BIRTH` date DEFAULT NULL,
  `COUNTRY` varchar(2) DEFAULT NULL,
  `LANGUAGE` varchar(3) NOT NULL,
  `TIME_ZONE` varchar(60) DEFAULT NULL,
  `COMPANY_NAME` varchar(70) NOT NULL,
  `WEBSITE` varchar(255) DEFAULT NULL,
  `INDUSTRY` varchar(3) DEFAULT NULL,
  `FINANCIAL_PERIOD` varchar(4) NOT NULL,
  `CURRENCY` varchar(20) DEFAULT NULL,
  `TAX_ID` varchar(30) DEFAULT NULL,
  `ADDRESS` varchar(50) DEFAULT NULL,
  `STREET` varchar(50) DEFAULT NULL,
  `CITY` varchar(30) DEFAULT NULL,
  `STATE` varchar(50) DEFAULT NULL,
  `ZIP` bigint(20) DEFAULT NULL,
  `JOIN_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `SERVICE_STARTING_DATE` date DEFAULT NULL,
  `AMOUNT_PAID` int(255) DEFAULT NULL,
  `SERVICE_DATE_HISTORY` text,
  `AMOUNT_PAID_HISTORY` text,
  `LOGO` varchar(50) DEFAULT NULL,
  `CONTACT_PHONE` bigint(10) DEFAULT NULL,
  `CONTACT_EMAIL` varchar(255) DEFAULT NULL,
  `HOME_PAGE` varchar(3) NOT NULL DEFAULT 'hp1',
  `MODE` varchar(3) NOT NULL DEFAULT 'mo1',
  `BUYER_TERM` varchar(3) NOT NULL DEFAULT 'bt1',
  `SELLER_TERM` varchar(3) NOT NULL DEFAULT 'st1',
  `VERIFICATION_CODE` varchar(255) DEFAULT NULL,
  `RESET_CODE` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`ACCOUNT_ID`),
  ADD UNIQUE KEY `ACCOUNT_ID` (`ACCOUNT_ID`);

--
-- Indexes for table `contact_requests`
--
ALTER TABLE `contact_requests`
  ADD PRIMARY KEY (`NO`),
  ADD UNIQUE KEY `NO` (`NO`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`DOCUMENT_ID`),
  ADD UNIQUE KEY `NO` (`DOCUMENT_ID`),
  ADD UNIQUE KEY `SERVER_FILE_NAME` (`SERVER_FILE_NAME`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`NO`),
  ADD UNIQUE KEY `NO` (`NO`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`NO`),
  ADD UNIQUE KEY `NO` (`NO`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`TRANSACTION_ID`),
  ADD UNIQUE KEY `TRANSACTION_ID` (`TRANSACTION_ID`),
  ADD KEY `TRANSACTION_ID_2` (`TRANSACTION_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`),
  ADD KEY `ID_2` (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_requests`
--
ALTER TABLE `contact_requests`
  MODIFY `NO` bigint(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `NO` bigint(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `NO` bigint(255) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
