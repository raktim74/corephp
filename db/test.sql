-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 07, 2020 at 09:20 AM
-- Server version: 5.6.38
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `example`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`) VALUES
(2, 'update', 0),
(3, 'techasdad', 0),
(4, 'updateddd', -1),
(5, 'techonologsss', 0),
(6, 'corephp', 0),
(7, 'corephp', 0),
(8, 'corephp1212prep', 0),
(9, 'corephp1212prepnew ', 0),
(10, 'corephp1212prepnew ', 0),
(11, 'corephp1212prepnew ', 0),
(12, 'ewn', 0),
(13, 'ewn', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` mediumtext NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `title`, `description`, `status`) VALUES
(1, 2, 'bababa', 'dnnan', 0),
(2, 2, 'abbas', 'hello addda da sd', 0),
(3, 4, 'updateddd', 'my api description', 0),
(4, 2, 'new update prepare update 3123123', 'update prepare data4124143', -1),
(5, 4, 'new update prepare', 'prepare statement testing', 0);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `name`, `email`, `password`, `status`) VALUES
(3, 'raktim', 'raktim.n@myapps-solutions.com', 'e10adc3949ba59abbe56e057f20f883e', 0),
(4, 'ritwik', 'ritwik@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0),
(5, 'siba', 'siba@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0),
(6, 'raktim', 'raktim@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0),
(7, 'raktim', 'raktim@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0),
(8, 'raktim', 'raktim12@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0),
(10, 'register', 'register@test.com', 'e10adc3949ba59abbe56e057f20f883e', 0),
(11, 'nana', 'dasd@dada.com', 'e10adc3949ba59abbe56e057f20f883e', 0),
(12, 'nabadeep', 'nabadeep@test.com', 'e10adc3949ba59abbe56e057f20f883e', 0);

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `token` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`token`) VALUES
('BGG fd879dc225a1b28eb3bb57ffb7115df5'),
('BGG fd879dc225a1b28eb3bb57ffb7115df5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
