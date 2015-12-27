-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2015 at 05:14 AM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stepup`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `token_type` varchar(20) NOT NULL,
  `expires_in` varchar(20) NOT NULL,
  `refresh_token` varchar(100) NOT NULL,
  `access_token` varchar(200) NOT NULL,
  `user_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `token_type`, `expires_in`, `refresh_token`, `access_token`, `user_id`) VALUES
(1, 'bearer', '15551999', 'wTtAMGbO0jafmNxCkyl0i7FRRivtynZq3XbyTp9FMuSjJSlInM5jXnKNwRHx002H', 'waR9B4PVm5p9b1ot2Mb0n26H_6iKsBW59o5r_b8A1KExIyzIqSoB78tTzeck0c0t', '28410220753913964'),
(2, 'bearer', '15551999', 'VeFFwfm0j5hLeYG71EoS6UE_Or09iT5fK0QoKUb0C5wIKtqrS0sRis_IX8VCO69P', '5C9ro0_P2ijXRcR2dKgFjyt2G4K6Da3P4B3pPP5PFnq5bjYqwF5ui9G5kE11Game', '28212217439802670');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
