-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Mar 08, 2023 at 12:26 PM
-- Server version: 10.6.11-MariaDB-1:10.6.11+maria~ubu2004-log
-- PHP Version: 8.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `combat`
--

-- --------------------------------------------------------

--
-- Table structure for table `heroes`
--

CREATE TABLE `heroes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `health_point` int(11) DEFAULT 100,
  `avatar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `heroes`
--

INSERT INTO `heroes` (`id`, `name`, `health_point`, `avatar`) VALUES
(11, 'Test', -9, './Images/Avatars/64060a604a0165.19728238.png'),
(12, 'Renaud', 13, './Images/Avatars/6406f90b639cb8.80908011.jpg'),
(13, 'EssaiHero', -15, './Images/Avatars/6406fafc52ec72.73798811.jpg'),
(14, 'Garage 404', -6, './Images/Avatars/64073849b08294.02963124.jpeg'),
(15, 'lailalk', -33, './Images/Avatars/64074745802599.70765144.jpg'),
(16, 'fsehdfh', -16, './Images/Avatars/64074e630c21e9.37503167.png'),
(17, 'fegfegg', -11, './Images/Avatars/640752631f19b0.14881171.jpg'),
(18, 'hyrdtj', -46, './Images/Avatars/6407527b464800.16055038.png'),
(19, 'gqhjsj', -16, './Images/Avatars/64075377eb4767.04352747.jpg'),
(20, 'trgjts', -15, './Images/Avatars/6407573600f788.98514683.jpg'),
(21, 'gezgqh', -3, './Images/Avatars/6407576303f023.07319023.png'),
(22, 'hwjk', -1, './Images/Avatars/640757aded47c1.39017110.png'),
(23, 'jjju', -4, './Images/Avatars/64075805a97b64.54367350.png'),
(24, 'frgtyqhhq', 24, './Images/Avatars/64075879beb768.42315951.jpg'),
(25, 'vd<nb', -17, './Images/Avatars/640758847a3130.12709513.png'),
(26, 'vdgkls', 100, './Images/Avatars/6407589ec742f2.05366789.jpg'),
(27, 'fehtsk', 50, './Images/Avatars/640758daa14a17.33791293.jpeg'),
(28, 'hohiha', -39, './Images/Avatars/640840cab95dd5.90835351.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `heroes`
--
ALTER TABLE `heroes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `heroes`
--
ALTER TABLE `heroes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
