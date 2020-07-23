-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 23, 2020 at 06:03 AM
-- Server version: 10.3.23-MariaDB-log-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `westbvli_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(10) NOT NULL,
  `acc_no` varchar(20) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `upass` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `addr` varchar(100) NOT NULL,
  `work` varchar(100) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `dob` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `reg_date` varchar(25) DEFAULT NULL,
  `marry` varchar(20) NOT NULL,
  `t_bal` varchar(20) NOT NULL,
  `a_bal` varchar(20) NOT NULL,
  `logins` int(50) DEFAULT 0,
  `status` enum('Active','Dormant/Inactive','Disabled','Closed') DEFAULT 'Active',
  `currency` varchar(5) NOT NULL,
  `cot` varchar(20) NOT NULL,
  `tax` varchar(20) NOT NULL,
  `imf` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `acc_no`, `uname`, `upass`, `email`, `type`, `fname`, `mname`, `lname`, `addr`, `work`, `sex`, `dob`, `phone`, `reg_date`, `marry`, `t_bal`, `a_bal`, `logins`, `status`, `currency`, `cot`, `tax`, `imf`) VALUES
(19, '406070422739', 'StephenThomas', '6d3b8197da8bac685dd7f699be09d7bd', 'thomasstephen151@gmail.com', 'Current ', 'Stephen', 'Leo', 'Thomas', '1611 NE 89th Pl\r\nVancouver, WA 98664-6414', 'Engineering', 'Male', '19/03/1952', '+12015285863', '01/02/2000', 'Widowed', '252256598', '252256598', 48, 'Active', '$', '4576', '7897', '1476');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `uname` varchar(40) NOT NULL,
  `upass` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `verified_count` enum('Y','N') DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `uname`, `upass`, `email`, `verified_count`) VALUES
(1, 'admin101', 'e10adc3949ba59abbe56e057f20f883e', 'info@westoffshorebnk.com', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `alerts`
--

CREATE TABLE `alerts` (
  `id` int(100) NOT NULL,
  `uname` varchar(40) NOT NULL,
  `amount` varchar(40) NOT NULL,
  `sender_name` varchar(40) NOT NULL,
  `type` varchar(10) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `date` varchar(20) NOT NULL,
  `time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alerts`
--

INSERT INTO `alerts` (`id`, `uname`, `amount`, `sender_name`, `type`, `remarks`, `date`, `time`) VALUES
(14, '2665400745', '1000', 'Virginia', 'Credit', 'good', '16/07/2019', '09:52:07'),
(15, '353876156271', '350020000', 'jude', 'Credit', 'contract Equipment', '14/07/2019', '11:44:46'),
(16, '2665400745', '350020000', 'jude born', 'Debit', 'Contract Equipment', '19/06/2019', '11:44:46'),
(17, '2665400745', '5670000000', 'Mark', 'Credit', 'Equipment', '27/3/2019', '08:21:11'),
(18, '1973699215', '460000000', 'Thomas', 'Credit', 'Equipment purchase', '02/07/2018', '20:21:11'),
(19, '488084890706', '860000000', 'Mark', 'Credit', 'Contract upfront payment', '01/08/2018', '20:22:11'),
(20, '488084890706', '370000003', 'Thomas', 'Debit', 'Equipment purchase', '02/07/2018', '09:22:13'),
(21, '488084890706', '230000000', 'Mark Kennedy', 'Credit', 'Workers salary', '04/01/2018', '08:24:12'),
(22, '488084890706', '430000426', 'Mark Kennedy', 'Debit', 'purchase of equipment', '04/01/2018', '20:22:11'),
(23, '488084890706', '760000447', 'John hook', 'Credit', 'Advance payment for a contract', '25/03/2019', '20:22:11'),
(24, '488084890706', '229999965', 'Mark', 'Debit', 'Equipment purchase', '27/03/2019', '21:22:13'),
(25, '406070422739', '35000', 'Harristige Trucking', 'Debit', 'Purchase of Trucks', '02/07/2018', '20:22:11'),
(26, '406070422739', '125090000', 'John hook', 'Debit', 'Purchase of Equipment', '27/11/2019', '08:21:11'),
(27, '406070422739', '800000000', 'Mark Kennedy', 'Credit', 'Contract full payment', '01/09/2019', '20:21:11'),
(28, '406070422739', '25034500', 'John hook', 'Debit', 'Purchase of Contract Tools', '25/03/2019', '08:24:12'),
(29, '406070422739', '202300000', 'John hook', 'Debit', 'workers salary', '01/04/2019', '21:22:13'),
(30, '406070422739', '35000', 'Harristige Trucking', 'Debit', 'For Truck Purchase', '04/03/2020', '20:22:11'),
(31, '406277822712', '1732692', 'Mark Kennedy', 'Credit', 'Contract upfront payment', '01/01/2019', '09:22:11'),
(32, '406277822712', '500000', 'Harristige Trucking', 'Debit', 'Equipment payment', '31/01/2020', '08:21:11'),
(33, '406277822712', '250400', 'Harristige Trucking', 'Debit', 'Equipment Transportation', '13/02/2020', '11:22:14'),
(34, '406277822712', '1832542', 'Thomas', 'Credit', 'contract payment', '28/03/2020', '11:22:11'),
(35, '406070422739', '150000', 'John hook', 'Debit', 'Accommodation Fee', '01/04/2020', '14:22:11'),
(36, '406277822712', '467000', 'Mark Kennedy', 'Credit', 'local workers payment', '05/05/2020', '16:22:12');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(10) NOT NULL,
  `sender_name` varchar(40) NOT NULL,
  `reci_name` varchar(40) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `msg` varchar(2000) NOT NULL,
  `read` enum('unread','opened') DEFAULT 'unread',
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp_account`
--

CREATE TABLE `temp_account` (
  `id` int(10) NOT NULL,
  `upass` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `addr` varchar(100) NOT NULL,
  `work` varchar(100) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `dob` varchar(30) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `marry` varchar(20) NOT NULL,
  `currency` varchar(5) NOT NULL,
  `code` varchar(6) NOT NULL,
  `verify` enum('Y','N') DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp_transfer`
--

CREATE TABLE `temp_transfer` (
  `id` int(100) NOT NULL,
  `email` varchar(40) NOT NULL,
  `amount` int(20) NOT NULL,
  `acc_no` int(30) NOT NULL,
  `acc_name` varchar(60) NOT NULL,
  `bank_name` varchar(40) NOT NULL,
  `swift` varchar(15) NOT NULL,
  `routing` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_transfer`
--

INSERT INTO `temp_transfer` (`id`, `email`, `amount`, `acc_no`, `acc_name`, `bank_name`, `swift`, `routing`, `type`, `remarks`) VALUES
(1, 'pdavender69@gmail.com', 3000000, 836042760, 'Glenda Mark', 'HSBC', 'MRMDUSS', '022000020', 'Savings', 'Equipment'),
(2, 'pdavender69@gmail.com', 257800000, 22000020, 'Glenda Mark', 'HSBC', 'MRMDUSS', '09876565', 'Savings', 'Equiptment'),
(3, 'pdavender69@gmail.com', 500000000, 836042760, 'Glenda Mark', 'HSBC', 'MRMDUSS', '022000020', 'Savings', 'Equipment'),
(4, 'stephenthomas597@outlook.com', 100000732, 2147483647, 'Glenda Mark', 'Bank of America', 'WOFSUS3N', '111000025', 'Savings', 'Purchase upfront'),
(5, 'stephenthomas597@outlook.com', 329026524, 262177063, 'Harristige Trucking', 'Chase Bank', 'CHASUS33', '111000614', 'Savings', 'Upfront Purchase payment'),
(6, 'stephenthomas597@outlook.com', 25497800, 554522737, 'Fobi Venture', 'Chase Bank', 'CHASUS33', '111000614', 'Savings', 'Payment For Site Machine Renting'),
(7, 'stephenthomas597@outlook.com', 35000, 262177063, 'Harristige Trucking LLC', 'Chase Bank', 'CHASU33', '111000614', 'Savings', 'Past Payment for Tools'),
(8, 'stephenthomas597@outlook.com', 158405000, 2147483647, 'Mohamed Shittu', 'Rak Bank UAE', 'NRAKAEAK', '66040000065268871400', 'Savings', 'Contract Payment'),
(9, 'stephenthomas597@outlook.com', 158405000, 2147483647, 'Mohamed Shittu', 'Rak Bank UAE', 'NRAKAEAK', '66040000065268870000', 'Savings', 'Contract Payment'),
(10, 'stephenthomas597@outlook.com', 158405000, 2147483647, 'Mohamed Shittu', 'Rak Bank UAE', 'NRAKAEAK', '66040000065268871400', 'Savings', 'Contract Install Payment'),
(11, 'stephenthomas597@outlook.com', 35000, 262177063, 'Harristige Trucking', 'Chase Bank', 'CHASUS33', '111000614', 'Savings', 'Purchase of Equipment'),
(12, 'stephenthomas597@outlook.com', 158405000, 2147483647, 'Mohamed Shittu', 'Rak Bank UAE', 'NRAKAEAK', '66040000065268871400', 'Savings', 'Contract Payment'),
(13, 'stephenthomas597@outlook.com', 158405000, 2147483647, 'Mohamed Shittu', 'RAK BANK UAE', 'NRAKAEAK', '66040000065268871400', 'Savings', 'Contract Payment'),
(14, 'stephenthomas597@outlook.com', 158405000, 2147483647, 'Mohamed Shittu', 'RAK BANK UAE', 'NRAKAEAK', '66040000065268871400', 'Savings', 'CONTRACT PAYMENT'),
(15, 'thomasstephen151@gmail.com', 35000, 262177063, 'Harristige Trucking', 'Chase Bank', 'CHASUS33', '111000614', 'Savings', 'Purchase of Trucks'),
(16, 'rrantonio2279@gmail.com', 457000, 2147483647, 'Fobi transportation services LLC', 'Bank of America', 'BOFAUS3N', '111000025', 'Savings', 'Purchase Upfront payment'),
(17, 'rrantonio2279@gmail.com', 475000, 2147483647, 'Fobi transportation services LLC', 'Bank of America', 'BOFAUS3N', '111000022', 'Savings', 'Purchase Upfront'),
(18, 'rrantonio2279@gmail.com', 525675, 679574399, 'Dragons Inn Invest', 'Chase Bank', 'CHASUS33', '111000614', 'Savings', 'Purchase.');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(10) NOT NULL,
  `tc` int(10) NOT NULL,
  `sender_name` varchar(40) NOT NULL,
  `mail` varchar(40) DEFAULT NULL,
  `subject` varchar(100) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `status` enum('Pending','Replied') DEFAULT 'Pending',
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `id` int(10) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `bank_name` varchar(40) NOT NULL,
  `acc_name` varchar(100) NOT NULL,
  `acc_no` varchar(20) NOT NULL,
  `reci_name` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL,
  `swift` varchar(100) NOT NULL,
  `routing` varchar(100) NOT NULL,
  `remarks` varchar(500) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` enum('Failed','Successful','Pending') DEFAULT 'Successful',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transfer`
--

INSERT INTO `transfer` (`id`, `amount`, `bank_name`, `acc_name`, `acc_no`, `reci_name`, `type`, `swift`, `routing`, `remarks`, `email`, `status`, `date`) VALUES
(1, '500000000', 'HSBC', 'Glenda Mark', '836042760', '', 'Savings', 'MRMDUSS', '022000020', 'Equipment', 'pdavender69@gmail.com', 'Successful', '2019-12-24 04:31:12'),
(2, '329026524', 'Chase Bank', 'Harristige Trucking', '262177063', '', 'Savings', 'CHASUS33', '111000614', 'Upfront Purchase payment', 'stephenthomas597@outlook.com', 'Successful', '2019-03-18 15:29:20'),
(3, '25497800', 'Chase Bank', 'Fobi Venture', '554522737', '', 'Savings', 'CHASUS33', '111000614', 'Payment For Site Machine Renting', 'stephenthomas597@outlook.com', 'Successful', '2019-03-19 12:10:55'),
(4, '35000', 'Chase Bank', 'Harristige Trucking LLC', '262177063', '', 'Savings', 'CHASU33', '111000614', 'Past Payment for Tools', 'stephenthomas597@outlook.com', 'Successful', '2020-03-21 08:11:58'),
(5, '35000', 'Chase Bank', 'Harristige Trucking', '262177063', '', 'Savings', 'CHASUS33', '111000614', 'Purchase of Trucks', 'thomasstephen151@gmail.com', 'Successful', '2020-04-02 21:56:57'),
(6, '525675', 'Chase Bank', 'Dragons Inn Invest', '679574399', '', 'Savings', 'CHASUS33', '111000614', 'Purchase.', 'rrantonio2279@gmail.com', 'Successful', '2020-06-05 09:08:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_account`
--
ALTER TABLE `temp_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_transfer`
--
ALTER TABLE `temp_transfer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `alerts`
--
ALTER TABLE `alerts`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_account`
--
ALTER TABLE `temp_account`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_transfer`
--
ALTER TABLE `temp_transfer`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
