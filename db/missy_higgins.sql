-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2022 at 04:54 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `missy_higgins`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `user_email` varchar(250) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `user_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `user_email`, `password`, `user_name`) VALUES
(1, 'santhiveerapandi@gmail.com', 'sanchitra@1234', 'santhi'),
(2, 'raja@gmail.com', 'raja@1234', 'Raja'),
(3, 'meena@gmail.com', 'meena@1234', 'Meena');

-- --------------------------------------------------------

--
-- Table structure for table `news_letter`
--

CREATE TABLE `news_letter` (
  `id` int(10) UNSIGNED NOT NULL,
  `letter_name` varchar(100) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `mail_content` text NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news_letter`
--

INSERT INTO `news_letter` (`id`, `letter_name`, `subject`, `mail_content`, `updated_by`, `updated_at`, `created_at`) VALUES
(1, 'May 2022 Monthly letter', 'Post One', '<p>Hello #name,</p>\r\n<p>&nbsp; Lerom</p>\r\n<p>&nbsp;</p>\r\n<p>-- From Company</p>', 1, '2022-05-27 07:09:27', '2022-05-26 18:26:04'),
(2, 'April 2022 Monthly letter', '', '', 0, '0000-00-00 00:00:00', '2022-05-26 18:26:04'),
(3, 'March 2022 Monthly letter', '', '', 0, '0000-00-00 00:00:00', '2022-05-26 18:26:44'),
(4, 'Feb 2022 Monthly letter', '', '', 0, '0000-00-00 00:00:00', '2022-05-26 18:26:44');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `pub_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `pub_date`) VALUES
(1, 'Post1', '2022-05-26 17:51:56'),
(2, 'Post2', '2022-05-26 17:51:56'),
(3, 'Post3', '2022-05-26 17:52:03');

-- --------------------------------------------------------

--
-- Stand-in structure for view `post_tags`
-- (See below for the actual view)
--
CREATE TABLE `post_tags` (
`id` int(10) unsigned
,`title` varchar(150)
,`tags` mediumtext
);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(10) UNSIGNED NOT NULL,
  `letter_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(250) NOT NULL,
  `sub_date` datetime NOT NULL DEFAULT current_timestamp(),
  `mail_sent` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `letter_id`, `name`, `email`, `sub_date`, `mail_sent`) VALUES
(1, 1, 'Santhiveerapandi', 'santhiveerapandi@gmail.com', '2022-05-26 19:46:49', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `tag` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `post_id`, `tag`) VALUES
(1, 1, 'PHP'),
(2, 1, 'JS'),
(3, 2, 'C'),
(4, 2, 'C++'),
(5, 1, 'C++'),
(6, 3, 'Java'),
(7, 2, 'C#'),
(8, 3, 'C++'),
(9, 3, 'JS'),
(10, 2, '.net');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `num_post` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `num_post`) VALUES
(1, 'John', 2),
(2, 'Mark', 0),
(3, 'Bill', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_posts`
--

CREATE TABLE `user_posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_posts`
--

INSERT INTO `user_posts` (`id`, `user_id`, `title`) VALUES
(1, 1, 'John Post One'),
(2, 1, 'John Post Two');

--
-- Triggers `user_posts`
--
DELIMITER $$
CREATE TRIGGER `update_num_post` AFTER INSERT ON `user_posts` FOR EACH ROW IF NEW.title!='' THEN
UPDATE users SET num_post=num_post+1 WHERE id=NEW.user_id;
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure for view `post_tags`
--
DROP TABLE IF EXISTS `post_tags`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `post_tags`  AS SELECT `p`.`id` AS `id`, `p`.`title` AS `title`, group_concat(`t`.`tag` separator ',') AS `tags` FROM (`posts` `p` join `tags` `t` on(`p`.`id` = `t`.`post_id`)) GROUP BY `t`.`post_id``post_id`  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`),
  ADD UNIQUE KEY `user_email_UNIQUE` (`user_email`) USING BTREE;

--
-- Indexes for table `news_letter`
--
ALTER TABLE `news_letter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`updated_by`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `letter_id` (`letter_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_posts`
--
ALTER TABLE `user_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `news_letter`
--
ALTER TABLE `news_letter`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_posts`
--
ALTER TABLE `user_posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD CONSTRAINT `letter_id` FOREIGN KEY (`letter_id`) REFERENCES `news_letter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_posts`
--
ALTER TABLE `user_posts`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
