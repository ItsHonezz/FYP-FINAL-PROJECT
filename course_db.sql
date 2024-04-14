-- Active: 1699800987740@@127.0.0.1@3306@course_db
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 31, 2024 at 07:48 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `course_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

CREATE TABLE `bookmark` (
  `user_id` varchar(20) NOT NULL,
  `playlist_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` varchar(20) NOT NULL,
  `content_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content_id`, `user_id`, `tutor_id`, `comment`, `date`) VALUES
('ONRkGWRM4yOI9efbLysU', '8IgHbg8gjMA6lsM39aD7', 'UsuP7yRKXUGq9jBeMH52', 'LBYtjukIWHJLPw2SnaQB', 'Meow meow moewww', '2024-03-31 19:40:19');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` int NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `playlist_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `video` varchar(100) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'deactive',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pdf1` varchar(255) DEFAULT NULL,
  `doc1` varchar(255) DEFAULT NULL,
  `doc2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `tutor_id`, `playlist_id`, `title`, `description`, `video`, `thumb`, `status`, `date`, `pdf1`, `doc1`, `doc2`) VALUES
('7LxJrE4Cn9X1gWZOM4sx', 'LBYtjukIWHJLPw2SnaQB', '7ZKXhMPvKdcVN0MeSVxP', 'Omelnya', 'Unlock the opportunity to make a difference and share your knowledge by joining us as a tutor today!', 'aOWZlhxXCcagejssXtPu.mp4', '5fYorVYuYu9JcBp9Nqew.jpg', 'active', '2024-03-31 19:41:42', NULL, NULL, NULL),
('8IgHbg8gjMA6lsM39aD7', 'LBYtjukIWHJLPw2SnaQB', '7ZKXhMPvKdcVN0MeSVxP', 'Kucing Ke Shomel', 'Unlock the opportunity to make a difference and share your knowledge by joining us as a tutor today!', 'xBuLyNZZ9MYDfX07NaSQ.mp4', 'NJLl4XVBXNW5Lt0BZxeK.jpg', 'active', '2024-03-31 19:39:54', 'DecqhHQSrzsox2qxKYxZ.pdf', 'GbOAGiDj1TuqROmbMQxt.docx', NULL),
('LIIbOf31AovrlQbbHRcW', 'LBYtjukIWHJLPw2SnaQB', '7ZKXhMPvKdcVN0MeSVxP', 'Hi Frend', 'Unlock the opportunity to make a difference and share your knowledge by joining us as a tutor today!', 'eeJ8rrkZxniPwrrX9Iaz.mp4', 'J2r2gfD7EDFWeaCbsgEJ.jpg', 'active', '2024-03-31 19:41:20', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `user_id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `content_id` varchar(20) NOT NULL,
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`user_id`, `tutor_id`, `content_id`, `id`) VALUES
('UsuP7yRKXUGq9jBeMH52', 'LBYtjukIWHJLPw2SnaQB', '8IgHbg8gjMA6lsM39aD7', 8);

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'deactive',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`id`, `tutor_id`, `title`, `description`, `thumb`, `status`, `date`) VALUES
('7ZKXhMPvKdcVN0MeSVxP', 'LBYtjukIWHJLPw2SnaQB', 'Karya Agung', 'Unlock the opportunity to make a difference and share your knowledge by joining us as a tutor today!', 'anCsJ0JqKs0hCCMPm9b0.jpg', 'active', '2024-03-31 19:39:20');

-- --------------------------------------------------------

--
-- Table structure for table `tutors`
--

CREATE TABLE `tutors` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `profession` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tutors`
--

INSERT INTO `tutors` (`id`, `name`, `profession`, `email`, `password`, `image`) VALUES
('LBYtjukIWHJLPw2SnaQB', 'abahawak', 'developer', 'abah@gmail.com', 'b39abbe763440b02c231b2653ebd9da3ea78dcb1', 'zG5DEJ2WoZvyRE4XFBDe.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`) VALUES
('UsuP7yRKXUGq9jBeMH52', 'MUHAMMAD ZUL FITRI BIN MOHD ZAMRI', 'abah@gmail.com', 'b39abbe763440b02c231b2653ebd9da3ea78dcb1', 'WZncJqS91WCEMHd1u4cW.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `FK_content_id_comms` (`content_id`),
  ADD KEY `FK_user_id_comms` (`user_id`),
  ADD KEY `FK_tutor_id_comms` (`tutor_id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_tutor_id` (`tutor_id`),
  ADD KEY `FK_playlit_id` (`playlist_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_id` (`user_id`),
  ADD KEY `FK_tutor_id1` (`tutor_id`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_tutor` (`tutor_id`);

--
-- Indexes for table `tutors`
--
ALTER TABLE `tutors`
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
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_content_id_comms` FOREIGN KEY (`content_id`) REFERENCES `content` (`id`),
  ADD CONSTRAINT `FK_tutor_id_comms` FOREIGN KEY (`tutor_id`) REFERENCES `tutors` (`id`),
  ADD CONSTRAINT `FK_user_id_comms` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `FK_playlit_id` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`id`),
  ADD CONSTRAINT `FK_tutor_id` FOREIGN KEY (`tutor_id`) REFERENCES `tutors` (`id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `FK_tutor_id1` FOREIGN KEY (`tutor_id`) REFERENCES `tutors` (`id`),
  ADD CONSTRAINT `FK_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `FK_tutor` FOREIGN KEY (`tutor_id`) REFERENCES `tutors` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
