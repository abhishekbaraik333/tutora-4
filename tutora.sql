-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2024 at 01:28 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tutora`
--

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` int(11) NOT NULL,
  `name` varchar(900) DEFAULT NULL,
  `prenom` varchar(900) DEFAULT NULL,
  `email` varchar(900) DEFAULT NULL,
  `prestation` varchar(900) DEFAULT NULL,
  `apec` varchar(900) DEFAULT NULL,
  `destination` varchar(900) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `nbrpassager` varchar(900) DEFAULT NULL,
  `phone` varchar(900) NOT NULL,
  `statut` int(11) DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submissionss`
--

CREATE TABLE `submissionss` (
  `id` int(11) NOT NULL,
  `name` varchar(900) DEFAULT NULL,
  `prenom` varchar(900) DEFAULT NULL,
  `email` varchar(900) DEFAULT NULL,
  `prestation` varchar(900) DEFAULT NULL,
  `apec` varchar(900) DEFAULT NULL,
  `destination` varchar(900) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `nbrpassager` varchar(900) DEFAULT NULL,
  `phone` varchar(900) NOT NULL,
  `preference` varchar(900) NOT NULL,
  `filename` varchar(200) DEFAULT NULL,
  `filesize` int(11) DEFAULT NULL,
  `filetype` varchar(100) DEFAULT NULL,
  `statut` int(11) DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submissionss`
--

INSERT INTO `submissionss` (`id`, `name`, `prenom`, `email`, `prestation`, `apec`, `destination`, `message`, `created_at`, `nbrpassager`, `phone`, `preference`, `filename`, `filesize`, `filetype`, `statut`) VALUES
(5, 'kad', 'anas', 'anas@msn.com', 'tiz', '', 'wahda', 'yayaya', '2024-07-31 05:28:32', 'fax', '5804840', 'math', '', 0, '', 2),
(6, 'kad', 'anas', 'anas@msn.com', 'tiz', '', 'wahda', 'yayaya', '2024-07-31 05:30:06', 'fax', '5804840', 'math', '', 0, '', 2),
(7, 'kad', 'anas', 'anas@msn.com', 'tiz', '', 'wahda', 'yayaya', '2024-07-31 05:32:53', 'fax', '5804840', 'math', '', 0, '', 2),
(8, 'kad', 'anas', 'anas@msn.com', 'tiz', '', 'wahda', 'yayaya', '2024-07-31 05:34:51', 'fax', '5804840', 'math', '', 0, '', 2),
(9, 'kad', 'anas', 'anas@msn.com', 'tiz', '', 'wahda', 'yayaya', '2024-07-31 05:35:53', 'fax', '5804840', 'math', '', 0, '', 2),
(11, 'kad', 'anas', 'anas@msn.com', 'tiz', '', 'wahda', 'ayayayayayaya', '2024-07-31 05:37:28', 'fax', '5804840', 'math', '', 0, '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `submissions_tracking`
--

CREATE TABLE `submissions_tracking` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `submission_count` int(11) NOT NULL DEFAULT 0,
  `last_submission_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submissions_tracking`
--

INSERT INTO `submissions_tracking` (`id`, `ip_address`, `submission_count`, `last_submission_time`) VALUES
(70, '::1', 1, 1722404248);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'emeraulde', 'tutora', '$2y$10$pF4nsdiHDP077756ih0aF.33vafOMrjLHLTqlYO9jU5murRchjiBm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submissionss`
--
ALTER TABLE `submissionss`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submissions_tracking`
--
ALTER TABLE `submissions_tracking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_ip` (`ip_address`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `submissionss`
--
ALTER TABLE `submissionss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `submissions_tracking`
--
ALTER TABLE `submissions_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
