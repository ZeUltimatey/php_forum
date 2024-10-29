-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2023 at 08:28 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET
SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET
time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

DROP DATABASE IF EXISTS forum;

CREATE DATABASE forum;
USE forum;
--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `main`
--

CREATE TABLE `admins`
(
    `id`         int(5) NOT NULL,
    `email`      varchar(200) NOT NULL,
    `adminname`  varchar(200) NOT NULL,
    `password`   varchar(200) NOT NULL,
    `created_at` timestamp    NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `main`
--

INSERT INTO `admins` (`id`, `email`, `adminname`, `password`, `created_at`)
VALUES (1, 'admin@gmail.com', 'Admin', '$2y$10$NrKqHO0wpeCPG2poTn9OZe9rDhjJudXxXn012BMjpC4xW6Gc5I99G',
        '2023-08-20 00:38:49'),
       (2, 'admin.first@gmail.com', 'Admin 1', '$2y$10$3K65YpPer25A/2mubAKOvuMPaabW5eszgd8fOYd8t1CvBD3yRWpxa',
        '2023-08-20 02:04:41'),
       (3, 'admin2@gmail.com', 'Admin 2', '$2y$10$MC5E6UZTbNWHao3eC5xhcenvpcasAXwMyTdbSWDgYA/9TpWYosAzu',
        '2023-08-20 04:53:33');

-- --------------------------------------------------------

--
-- Table structure for table `categories-user`
--

CREATE TABLE `categories`
(
    `id`         int(5) NOT NULL,
    `name`       varchar(200) NOT NULL,
    `created_at` timestamp    NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories-user`
--

INSERT INTO `categories` (`id`, `name`, `created_at`)
VALUES (1, 'Tech', '2023-08-19 04:48:33'),
       (2, 'Fun', '2023-08-19 04:48:33'),
       (3, 'New', '2023-08-19 04:48:33'),
       (4, 'Important', '2023-08-19 04:48:33'),
       (5, 'Special', '2023-08-20 05:47:08');

-- --------------------------------------------------------

--
-- Table structure for table `replies-user`
--

CREATE TABLE `replies_user`
(
    `id`         int(5) NOT NULL,
    `reply`      text         NOT NULL,
    `user_id`    int(5) NOT NULL,
    `user_image` varchar(200) NOT NULL,
    `topic_id`   int(5) NOT NULL,
    `user_name`  varchar(200) NOT NULL,
    `created_at` timestamp    NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `replies-user`
--

INSERT INTO `replies_user` (`id`, `reply`, `user_id`, `user_image`, `topic_id`, `user_name`, `created_at`)
VALUES
    (1, 'Lorem ipsum dolor sit amet, consectetur.', 1, 'gravatar.png', 1, 'user1@example.com', '2023-08-18 07:00:54'),
    (2, 'Sed do eiusmod tempor incididunt ut.', 1, 'gravatar.png', 1, 'user1@example.com', '2023-08-18 07:00:54'),
    (3, 'Duis aute irure dolor in reprehenderit.', 1, 'gravatar.png', 2, 'user1@example.com', '2023-08-19 04:08:36'),
    (4, 'Curabitur pretium tincidunt lacus.', 1, 'gravatar.png', 2, 'user1@example.com', '2023-08-19 04:08:39'),
    (5, 'Pellentesque habitant morbi tristique.', 1, 'gravatar.png', 2, 'user1@example.com', '2023-08-19 04:08:44'),
    (6, 'Vivamus elementum semper nisi.', 1, 'gravatar.png', 3, 'user1@example.com', '2023-08-19 04:09:03'),
    (7, 'Aliquam lorem ante, dapibus in.', 1, 'gravatar.png', 4, 'user1@example.com', '2023-08-19 04:19:07'),
    (8, 'Nullam dictum felis eu pede.', 1, 'gravatar.png', 5, 'user1@example.com', '2023-08-19 07:57:12'),
    (9, 'Integer tincidunt. Cras dapibus.', 1, 'gravatar.png', 6, 'user2@example.com', '2023-08-19 08:12:01'),
    (10, 'Vivamus elementum semper nisi.', 1, 'gravatar.png', 7, 'user2@example.com', '2023-08-19 08:12:01'),
    (11, 'Aenean vulputate eleifend tellus.', 1, 'gravatar.png', 7, 'user2@example.com', '2023-08-19 08:12:01'),
    (12, 'Phasellus viverra nulla ut metus.', 1, 'gravatar.png', 7, 'user2@example.com', '2023-08-19 08:12:01'),
    (13, 'Nulla gravida orci a odio.', 1, 'gravatar.png', 8, 'user2@example.com', '2023-08-19 08:12:01'),
    (14, 'Vestibulum vel dolor sed arcu.', 1, 'gravatar.png', 8, 'user2@example.com', '2023-08-19 08:12:01'),
    (15, 'Nullam varius, turpis et commodo.', 2, 'gravatar.png', 9, 'user2@example.com', '2023-08-19 08:12:01');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics_user` (
  `id` int(5) NOT NULL,
  `title` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `body` text NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_image` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics_user` (`id`, `title`, `category`, `body`, `user_name`, `user_image`, `created_at`) VALUES
(1, 'Lorem Ipsum Topic 1', 'Tech', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vel dolor sed arcu bibendum volutpat. Integer in nisi at nisl aliquet facilisis.', 'user1@example.com', 'gravatar.png', '2023-08-18 12:20:16'),
(2, 'Lorem Ipsum Topic 2', 'Fun', 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'user1@example.com', 'gravatar.png', '2023-08-18 12:03:29'),
(3, 'Lorem Ipsum Topic 3', 'Special', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'user2@example.com', 'gravatar.png', '2023-08-18 12:03:29'),
(4, 'Lorem Ipsum Topic 4', 'New', 'Curabitur pretium tincidunt lacus. Nulla gravida orci a odio. Nullam varius, turpis et commodo pharetra, est eros bibendum elit, nec luctus magna felis sollicitudin mauris.', 'user1@example.com', 'gravatar.png', '2023-08-18 12:21:31'),
(5, 'Lorem Ipsum Topic 5', 'Tech', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce aliquet, urna ut suscipit vehicula, erat arcu fermentum justo, vel tincidunt erat metus id elit.', 'user2@example.com', 'gravatar.png', '2023-08-19 04:43:10'),
(6, 'Lorem Ipsum Topic 6', 'New', 'Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.', 'user1@example.com', 'gravatar.png', '2023-08-19 05:10:54'),
(7, 'Lorem Ipsum Topic 7', 'Important', 'Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum.', 'user2@example.com', 'gravatar.png', '2023-08-19 05:10:54'),
(8, 'Lorem Ipsum Topic 8', 'Tech', 'Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.', 'user2@example.com', 'gravatar.png', '2023-08-19 05:10:54');

-- --------------------------------------------------------

--
-- Table structure for table `main-users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `about` text NOT NULL,
  `avatar` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `main-users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `about`, `avatar`, `created_at`) VALUES
(1, 'tiendung8a6@gmail.com', 'tiendung8a6@gmail.com', 'tiendung8a6@gmail.com', '$2y$10$NrKqHO0wpeCPG2poTn9OZe9rDhjJudXxXn012BMjpC4xW6Gc5I99G', 'I am an eager and passionate student with a burgeoning interest in programming, although I am currently at the early stages of my journey. Despite my limited experience, I am dedicated to learning the fundamental principles of programming. I understand that programming encompasses not only mastering specific languages but also cultivating logical thinking and effective problem-solving skills. Through guidance from instructors and participation in study groups, I have already applied my knowledge to small projects, which has boosted my confidence. I actively seek learning opportunities from diverse sources and consistently challenge myself to expand my skill set. While I am still exploring and developing, I am confident that my determination will help me overcome obstacles and become a proficient programmer. I remain committed to continuous learning, skill refinement, and embracing new projects to further excel in the programming field.', 'gravatar.png', '2023-08-19 08:11:59'),
(2, 'user1@gmail.com', 'user1@gmail.com', 'user1@gmail.com', '$2y$10$NrKqHO0wpeCPG2poTn9OZe9rDhjJudXxXn012BMjpC4xW6Gc5I99G', 'I am', 'gravatar.png', '2023-08-19 08:11:59'),
(3, 'user2@gmail.com', 'user2@gmail.com', 'user2@gmail.com', '$2y$10$NrKqHO0wpeCPG2poTn9OZe9rDhjJudXxXn012BMjpC4xW6Gc5I99G', 'I am not', 'gravatar.png', '2023-08-19 08:12:59');


--
-- Indexes for dumped tables
--

--
-- Indexes for table `main`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories-user`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `replies-user`
--
ALTER TABLE `replies_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main-users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `main`
--
ALTER TABLE `admins`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories-user`
--
ALTER TABLE `categories`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `replies-user`
--
ALTER TABLE `replies_user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics_user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `main-users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
