-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2022 at 05:15 PM
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
(23, 4, 'new01', 'CASH', 0, 0, '4', '2022-02-24 13:13:26', '2022-02-24 18:43:26'),
(24, 4, 'BA1', 'BANK_ACCOUNT', 1, 0, '4', '2022-02-24 13:21:43', '2022-02-24 18:51:43'),
(25, 4, 'BA2', 'BANK_ACCOUNT', 200, 0, '4', '2022-02-24 13:22:25', '2022-02-24 18:52:25'),
(27, 4, 'depo1', 'DEPOSIT', 3000, 0, '4', '2022-02-24 13:42:26', '2022-02-24 19:12:26'),
(32, 4, 'test3', 'CASH', 0, 0, '4', '2022-02-25 06:56:41', '2022-02-25 12:26:41'),
(33, 4, 'expense1', 'CASH', 0, 0, '4', '2022-02-25 14:20:00', '2022-02-25 19:50:00'),
(34, 4, 'transfer', 'BANK_ACCOUNT', 1020304050, 0, '4', '2022-02-25 14:20:45', '2022-02-25 19:50:45'),
(35, 4, 'income', 'DEPOSIT', 0, 0, '4', '2022-02-25 14:21:06', '2022-02-25 19:51:06'),
(36, 4, 'new01', 'ASSET', 0, 0, '4', '2022-02-26 13:03:22', '2022-02-26 18:33:22');

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
(3, '4', 'IDR', 'JPY', 'MM-DD-YYYY', '4', '2022-02-18 12:42:41', '2022-02-26 18:32:27');

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
  `notes` text DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `from_account`, `amount`, `currency`, `to_account`, `transaction_type`, `debit_credit`, `notes`, `transaction_date`, `created_by`, `created_at`, `updated_by`) VALUES
(7, '4', '33', '1.00', 'INR', '', 'EXPENSE', 'D', '', '0000-00-00', '4', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, '4', '35', '200.00', 'INR', '', 'INCOME', 'C', '', '0000-00-00', '4', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, '4', '34', '200.00', 'USD', '34', 'TRANSFER', 'D', '', '0000-00-00', '4', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, '4', '23', '1.00', 'USD', '', 'EXPENSE', 'D', '', '2022-02-25', '4', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, '4', '23', '200.00', 'INR', '23', 'TRANSFER', 'D', '', '0000-00-00', '4', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, '4', '23', '8.00', 'INR', '', 'INCOME', 'C', '', '0000-00-00', '4', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, '4', '23', '8.00', 'INR', '', 'INCOME', 'C', '', '0000-00-00', '4', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, '4', '23', '8555555.00', 'INR', '', 'INCOME', 'C', '', '0000-00-00', '4', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
(1, 'tarang', 'Raval', 'tarang.raval5@gmail.com', 9429291772, '1234567890', 'Customer'),
(2, 't', 't', 't@yopmail.com', 9429291772, 'Test@123', 'Customer'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
