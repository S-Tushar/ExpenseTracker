-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2022 at 04:54 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expensetraker`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_accounts`
--

CREATE TABLE `add_accounts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `account_number` int(11) DEFAULT NULL,
  `card_number` int(11) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `add_accounts`
--

INSERT INTO `add_accounts` (`id`, `user_id`, `name`, `type`, `account_number`, `card_number`, `created_by`, `created_at`, `updated_at`) VALUES
(37, 4, 'My Wallet', 'CASH', 0, 0, '4', '2022-03-01 15:47:25', '2022-03-01 21:17:25'),
(38, 4, 'SBI Bank Account - 2202', 'BANK_ACCOUNT', 2147483647, 0, '4', '2022-03-01 15:47:59', '2022-03-01 21:17:59'),
(39, 4, 'HDFC Credit Card- 7362', 'CREDIT', 0, 2147483647, '4', '2022-03-01 15:48:40', '2022-03-01 21:18:40'),
(40, 4, 'PO - fixed Deposit', 'DEPOSIT', 0, 0, '4', '2022-03-01 15:49:13', '2022-03-01 21:19:13'),
(41, 4, 'My Cash Asset', 'ASSET', 0, 0, '4', '2022-03-01 15:49:32', '2022-03-01 21:19:32');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `base_currency` varchar(50) NOT NULL,
  `additional_currency` varchar(50) NOT NULL,
  `date_format` varchar(20) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `createtd_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `user_id`, `base_currency`, `additional_currency`, `date_format`, `created_by`, `createtd_at`, `updated_at`) VALUES
(3, '4', 'INR', '', 'd-m-Y', '4', '2022-02-18 12:42:41', '2022-03-01 21:17:09');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `tags` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `tags`) VALUES
(1, 'Income'),
(2, 'Food');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) DEFAULT NULL,
  `from_account` varchar(50) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `currency` varchar(50) NOT NULL,
  `to_account` varchar(50) DEFAULT NULL,
  `transaction_type` varchar(10) DEFAULT NULL,
  `debit_credit` varchar(20) DEFAULT NULL,
  `tags` text NOT NULL,
  `notes` text DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `from_account`, `amount`, `currency`, `to_account`, `transaction_type`, `debit_credit`, `tags`, `notes`, `transaction_date`, `created_by`, `created_at`, `updated_by`) VALUES
(26, '4', '37', '500.00', 'INR', '', 'INCOME', 'C', 'Income', '', '2022-02-28', '4', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, '4', '41', '1000.00', 'INR', '', 'INCOME', 'C', 'Income', '', '2022-02-28', '4', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, '4', '37', '50.00', 'INR', '', 'EXPENSE', 'D', 'food', '', '2022-03-01', '4', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, '4', '37', '100.00', 'INR', '38', 'TRANSFER', 'D', '', '', '2022-03-01', '4', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_no` bigint(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_name` varchar(20) NOT NULL DEFAULT 'Customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `mobile_no`, `password`, `role_name`) VALUES
(4, 'abc', 'xyz', 'abc@gmail.com', 8686969612, '12345', 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_accounts`
--
ALTER TABLE `add_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
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
-- AUTO_INCREMENT for table `add_accounts`
--
ALTER TABLE `add_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
