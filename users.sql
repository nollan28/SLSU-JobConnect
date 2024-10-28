-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2024 at 02:25 PM
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
-- Database: `jobc`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `jobcon` (
  `username` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `department` varchar(50) NOT NULL,
  `year_level` varchar(10) NOT NULL,
  `major` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

$db_username INTO `jobcon` (`username`, `name`, `email`, `student_id`, `department`, `year_level`, `major`, `password`) VALUES
('dsf', 'sdf', 'nol1@gmail.com', '23-10190', 'information tecnology', '2nd year', 'programming', '$2y$10$6YnAJDWkPd25gAF7S./HtO2R6spyxNrsL5u83rogxKGMy8z9CdvC.'),
('nols', 'nollan', 'nollanpalero1@gmail.com', '23-10190', 'information tecnology', '2nd year', 'programming', '$2y$10$H1FbKBi1PPfldgguHP4OpuuL/22PJh0LY0IrAsjcgCIdAxbAuXi8e'),
('ser', 'wer', 'gree1@gmail.com', '23-10190', 'information tecnology', '2nd year', 'programming', '$2y$10$4/A14GC5MC.vomA2VodfD.lkNQB5dSZvZfO0G2qJiU4MVdkNF.B9S'),
('user', 'jobconn', '38475htghghth@gmail.com', '23-10190', 'information tecnology', '2nd year', 'programming', '$2y$10$B2Fhv7fbYbqKH4pw.IimKOQeAmdJW7BGwwRAtuq8SOU62Tvfjqzla');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `jobcon`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
