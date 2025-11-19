-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Oct 02, 2024 at 09:12 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `charity`
--

CREATE TABLE `charity` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `charity_name` varchar(100) NOT NULL,
  `charity_number` char(8) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `charity`
--

INSERT INTO `charity` (`id`, `name`, `mobile`, `email`, `address`, `gender`, `charity_name`, `charity_number`, `username`, `password`, `date`, `status`) VALUES
(1, 'ram', '7769875301', '', 'daund', 'male', 'raje trust ', '12345678', 'raj', '1234', '2024-09-28', 'rejected'),
(4, 'ram', '7769875301', '', 'daund', 'male', 'raje trust ', '12345679', 'raj1', '$2y$10$hWcBCe3TuLcISzPMV5ferOTNZYyv6dL/NtUjj4O5IkVMFBA/0rAsS', '2024-09-28', 'approved'),
(5, 'ram', '7769875305', 'rj@gamil.com', 'daund', 'male', 'Raje trust ', '12345649', 'raj2', '$2y$10$Jb04rv5inzDciYOWS.3hgOpShEb80JQs7mctne/ddnsCITfR4D0T6', '2024-09-28', 'approved'),
(6, 'rushi', '9923766023', 'aniketpawar12@g', 'daund', 'male', 'manish', '12345667', 'raj5', '$2y$10$cAa6u87mconRlJEyyArn1OwtBA2pdrE6qPGlnW7yY1gZb16sc/YSK', '2024-09-28', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `contact` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`id`, `full_name`, `address`, `email`, `gender`, `contact`, `username`, `password`, `created_at`) VALUES
(1, 'Aniket Pawar', 'Daund', 'aniketpawarpatil2020@gmail.com', 'male', '7769875301', 'anu', '1234', '2024-08-13 04:20:32'),
(2, 'rohan', 'baramati', 'rohan12@gmail.com', 'male', '9049529265', 'ronny', '$2y$10$qOvueLHoOVGnHFzxy7n7TOUZmHN8gbsh/dPOlIUUgZVtE9iehgUnW', '2024-08-13 05:24:20'),
(27, 'yash', 'phaltan', 'yash234@gmail.com', 'male', '9896959239', 'yash', '$2y$10$QKRxTInI1RzX1m8Z1U953Ov4Fo/zDa5INl1ppZf6d99s4RLngAKLa', '2024-08-13 06:02:41'),
(29, 'sanket', 'daund', 'sanket@gmail.com', 'male', '0123654987', 'sanket', '$2y$10$5uqmfD1KHTly6cgEQMPmceXLYcnsl1/NlP2HOg9TMRxNMnG8RC/ui', '2024-08-13 09:36:05'),
(31, 'hari', 'daund', 'hari@gmail.com', 'male', '1234569987', 'hari', '$2y$10$sCSNLPDBlXFoQ5b/zTg.0e7.p7YnKauhin8vwbT3lceUrkZqjGQTq', '2024-08-13 09:50:34'),
(32, 'rutu', 'daund', 'rutu@gmail.com', 'male', '98786543222', 'rutu', '$2y$10$R5lTxU0nuuX1rwgmCRKmh.N4MRC8Z0r6n6enNlBQ9pHsaTxvvmi9S', '2024-08-13 09:55:53'),
(33, 'omii', 'baramati', 'omii@gmail.com', 'male', '7796969696', 'om', '$2y$10$ZXD7DPtNs2AMvcU/h9qqIexFE6a8JgNpOXAtm5ndJ1JmEMbMTXz.O', '2024-08-13 16:29:49'),
(34, 'manish', 'kharati', 'manish1212@gmail.com', 'male', '9958456525', 'manish1212', '$2y$10$lZifWP7H6ZnJbtIjhvBuH.QhA5F.5hL8fWZoDNp/7OH2fVxu1PNa2', '2024-08-20 09:22:29'),
(35, 'onkar', 'bMT', 'onkar@gmail.com', 'male', '1232321212', 'onkar', '$2y$10$pIBs.UmrHHMAgvtJxmSWfOo4di1keZqtRybX3TCHrYXP8KXl5OI1.', '2024-09-13 17:01:19'),
(36, 'om', 'ffasdsad', 'king@gmail.com', 'male', '3948578438', 'omii99', '$2y$10$GtQakw6Hs9/OF.sUTU0UeembCCcHFVLv/Xo1Yj8ORtokornWe1lAC', '2024-09-30 09:19:41'),
(37, 'yasha', 'pune', 'yash11@gmail.com', 'male', '9876578967', 'yasha', '$2y$10$.8mXJ6c/.iiOoMolUcSHY.IMT8EzCwF7tIgglq7Zyq5aAhApsqGsi', '2024-10-02 06:54:43'),
(38, 'suraj', 'daund', 'suraj11@gmail.com', 'male', '1234456789', 'suraj', '$2y$10$EibaWmYqPIzW/.5y5ORMFuLX5IIiN3pxzLiqxLPbgrSFI1ddy01G6', '2024-10-02 07:01:14'),
(39, 'ramm', 'baramati', 'ram@gmail.com', 'male', '3456788765', 'ramsham', '$2y$10$CRjH8Of00jDIGHf3frqYQeFNQw9IT8DRcsQqyrKJ5ow3bJEc8eFsO', '2024-10-02 07:11:20');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL,
  `food_name` varchar(255) NOT NULL,
  `food_type` enum('veg','non-veg') NOT NULL,
  `food_category` enum('raw','cooked','packed') NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `donor_id` int(11) NOT NULL,
  `status` enum('pending','accepted','assigned','rejected') NOT NULL DEFAULT 'pending',
  `charity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `food_name`, `food_type`, `food_category`, `date`, `donor_id`, `status`, `charity_id`) VALUES
(1, 'chapati', 'veg', 'raw', '2024-09-22', 0, 'pending', 0),
(2, 'chapati', 'veg', 'raw', '2024-09-22', 35, 'assigned', 5),
(3, 'sahil', 'veg', '', '2024-09-26', 35, 'rejected', 0),
(4, 'chpati', 'veg', '', '2024-09-26', 35, 'assigned', 5),
(5, 'rice', 'veg', '', '2024-09-26', 35, 'pending', 0),
(6, 'chapati', 'veg', '', '2024-09-27', 35, 'pending', 0),
(7, 'Aniket Pawar', 'veg', '', '2024-09-27', 35, 'pending', 0),
(8, 'Aniket Pawar', 'veg', 'cooked', '2024-09-27', 35, 'pending', 0),
(9, 'gjhf', 'veg', 'raw', '2024-09-28', 35, 'pending', 0),
(10, 'chapati', 'veg', 'cooked', '2024-09-29', 35, 'pending', 0),
(11, 'varnbhat', 'non-veg', 'cooked', '2024-09-30', 36, 'pending', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `charity`
--
ALTER TABLE `charity`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `charity_number` (`charity_number`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `charity`
--
ALTER TABLE `charity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
