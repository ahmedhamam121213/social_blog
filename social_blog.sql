-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 12, 2019 at 11:13 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `post_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `title`, `post_id`, `user_id`) VALUES
(70, 'nice post', 3, 6),
(71, 'fff', 5, 7),
(72, 'yeees', 3, 7),
(73, 'gggg', 5, 7),
(74, 'ddd', 6, 7),
(75, 'ddd', 5, 7),
(76, 'qqq', 5, 7),
(77, 'ffff', 5, 7),
(78, 'zzzz', 5, 7),
(79, 'nice post', 5, 7),
(80, 'hello', 6, 7),
(81, 'hello', 6, 7),
(82, 'hello', 6, 7),
(83, 'hello my dear you are very hansam', 5, 7),
(96, 'fffff', 5, 7),
(97, 'how are you?', 5, 7),
(98, 'helo ', 7, 7),
(99, 'yessss', 7, 7),
(100, 'jjj', 8, 7);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `picture_url` text NOT NULL,
  `created` datetime NOT NULL,
  `user_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `picture_url`, `created`, `user_id`) VALUES
(3, 'post title 2', 'post body 2', 'https://images.pexels.com/photos/4458/cup-mug-desk-office.jpg?auto=compress&cs=tinysrgb&dpr=1&w=500', '2019-07-30 00:00:00', 6),
(4, 'title ty', 'bodu ty', 'https://images.pexels.com/photos/34658/pexels-photo.jpg?auto=compress&cs=tinysrgb&dpr=1&w=500', '0000-00-00 00:00:00', 6),
(5, 'hello', 'hello every one', 'https://images.pexels.com/photos/34070/pexels-photo.jpg?auto=compress&cs=tinysrgb&dpr=1&w=500', '0000-00-00 00:00:00', 7),
(6, 'helo my dear', 'hello every day every year', 'https://images.pexels.com/photos/459688/pexels-photo-459688.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500', '0000-00-00 00:00:00', 7),
(7, 'yatatat', 'ayaya ahaha', 'https://images.pexels.com/photos/1657152/pexels-photo-1657152.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500', '0000-00-00 00:00:00', 7),
(8, 'good morining', 'goood moring my dear', 'https://images.pexels.com/photos/450271/pexels-photo-450271.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500', '0000-00-00 00:00:00', 7),
(9, 'so what you do ?', 'I am having my breakfast', 'https://images.pexels.com/photos/709814/pexels-photo-709814.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500', '0000-00-00 00:00:00', 7),
(10, 'not bad post', 'yes not bad at allllllllllll', 'https://images.pexels.com/photos/2563151/pexels-photo-2563151.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500', '0000-00-00 00:00:00', 7),
(11, 'fff', 'bbb', '', '0000-00-00 00:00:00', 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `image_url`) VALUES
(6, 'aya', '123', 'https://images.pexels.com/photos/1627936/pexels-photo-1627936.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500'),
(7, 'salama', '123', 'https://images.pexels.com/photos/36483/aroni-arsa-children-little.jpg?auto=compress&cs=tinysrgb&dpr=1&w=500'),
(8, 'taha', '123', 'https://images.pexels.com/photos/1043471/pexels-photo-1043471.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500'),
(9, 'rana', '123', 'https://images.pexels.com/photos/1674752/pexels-photo-1674752.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500'),
(10, 'walid', '123', 'https://cdn.pixabay.com/photo/2017/12/30/11/58/portrait-3049894__340.jpg'),
(11, 'walaa', '123', 'https://images.pexels.com/photos/1547971/pexels-photo-1547971.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
