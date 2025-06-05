-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2024 at 01:23 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

CREATE DATABASE IF NOT EXISTS userdb;


USE userdb; -- Specify the database you want to use


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `userdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'Vasi', '$2y$10$ccoUlBOKv.DpRDyZ03o2q.TRUVzMMwNgrvzdMvESG0fN7SEOjjDAK'),
(2, 'Mark', '$2y$10$pNNDTwJC2K/qS1lNGF1lauBhJd8J0j0g9LuYxPrSyDY3Lll7mJQCW'),
(3, 'Alex', '$2y$10$BxRF7aipQ7dHgQq6YVZR3uZcBH0lQtYUrSd/WXjk6lyteyDuY.hdW');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`id`, `user_id`, `name`, `email`, `message`) VALUES
(1, 1, 'Seabrook Beach Cleanup Day', 'Join us for a day of community and environmental stewardship as we come together to clean up Seabrook Beach. Participants will gather at the beach and work together to collect litter and debris, helping to preserve the natural beauty of our coastline. Thi', '2024-03-01'),
(2, 2, 'Seabrook Seafood Festival', 'Calling all seafood lovers! Dive into a culinary adventure at the Seabrook Seafood Festival, where you can indulge in the freshest catches from the sea. Sample an array of mouthwatering dishes featuring locally sourced seafood, including lobster rolls, cl', '2024-05-01'),
(3, 3, 'Seabrook Sunset Yoga on the Pier', 'Unwind and rejuvenate with a serene yoga experience overlooking the breathtaking sunset at Seabrook\'s scenic pier. Led by experienced instructors, this outdoor yoga session offers a perfect blend of relaxation, mindfulness, and natural beauty. Feel the ge', '2024-06-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_data`
--
ALTER TABLE `user_data`
  ADD CONSTRAINT `user_data_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
