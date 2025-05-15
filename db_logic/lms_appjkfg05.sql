-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 15, 2025 at 07:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms_appjkfg05`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `s_content` ()   BEGIN
	SELECT * FROM Books;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `ba_street` varchar(100) DEFAULT NULL,
  `ba_barangay` varchar(100) DEFAULT NULL,
  `ba_city` varchar(100) DEFAULT NULL,
  `ba_province` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `ba_street`, `ba_barangay`, `ba_city`, `ba_province`) VALUES
(1, '07# Medrano Street', 'Bagong Pook', 'Lipa City', 'Batangas'),
(2, '71 Maramo Street', 'Bagong Pook', 'Lipa City', 'Batangas'),
(3, '07# Medrano Street', 'Radiwan', 'Ivana', 'Batanes'),
(4, '4564 fghtgh', 'Aniban I', 'Bacoor City', 'Cavite'),
(5, '45gffgf hghfgh ', 'Concordia', 'Alitagtag', 'Batangas'),
(6, '45 gdfgdret rt', 'San Rafael (Idiang)', 'Itbayat', 'Batanes');

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `author_id` int(11) NOT NULL,
  `author_FN` varchar(100) NOT NULL,
  `author_LN` varchar(100) NOT NULL,
  `author_birthday` date NOT NULL,
  `author_nat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `book_isbn` varchar(20) NOT NULL,
  `book_pubyear` int(11) NOT NULL,
  `quantity_avail` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_authors`
--

CREATE TABLE `book_authors` (
  `ba_id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_copy`
--

CREATE TABLE `book_copy` (
  `copy_id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genre_id` int(11) NOT NULL,
  `genre_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genre_books`
--

CREATE TABLE `genre_books` (
  `gb_id` int(11) NOT NULL,
  `genre_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `transaction_date` date NOT NULL,
  `due_date` date NOT NULL,
  `return_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_copies`
--

CREATE TABLE `transaction_copies` (
  `tc_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `copy_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_FN` varchar(100) NOT NULL,
  `user_LN` varchar(100) NOT NULL,
  `user_birthday` date DEFAULT NULL,
  `user_sex` varchar(6) DEFAULT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_username` varchar(255) NOT NULL,
  `user_phone` varchar(15) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_type` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_FN`, `user_LN`, `user_birthday`, `user_sex`, `user_email`, `user_username`, `user_phone`, `user_password`, `user_type`) VALUES
(1, 'aliah', 'Torres', '2025-05-08', 'Female', 'kayehi@gmail.com', 'Kaye05hi', '09456346356', '$2y$10$YNzNLUsd.bZuNpozqv8bceCdSh5.vYwOhFmCw3sHfRM6s9gcuVGom', 1),
(2, 'Kaye', 'Fernando', '2004-11-25', 'Female', 'louie05@gmail.com', 'louie', '09751425833', '$2y$10$S4aMynxNhJ8n3x69FBu7VerKDPOfB4kKge1HJ.H2D7wADSwaJJS7e', 1),
(3, 'Jei', 'Pastrana', '2025-05-08', 'Male', 'jei05@gmail.com', 'Jei', '4643656456546', '$2y$10$qL1BcJZdZLTKACXV41fade4Gm2iwdyri9L62vMqW83CBTPveOcXOC', 1),
(4, 'Kian', 'Vergara', '2025-05-15', 'Male', 'kian@gmail.com', 'Kian', '635843942935', '$2y$10$yq30nKuEWwFg/gN.YRUIPembxAxebJprJluZiAdgAGUOcTCUUBFYy', 1),
(5, 'Ci-N', 'Cuenca', '2025-05-15', 'Male', 'cin@gmail.com', 'CI-N', '456546345634', '$2y$10$JxkN2SYZ0/cfZ/IWYK8R4eNnn4DifDB80bEnBMiVZpk3wUrXw0N4m', 1),
(6, 'Ella', 'Mote', '2025-05-15', 'Female', 'ellatot@gmail.com', 'Ella', '463463562342', '$2y$10$a9P70dCtrTeeP85nCoqF7O6zaJCae4hakWNBrsajzZyBt/NQhX1Gy', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_address`
--

CREATE TABLE `users_address` (
  `ba_bridge_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_address`
--

INSERT INTO `users_address` (`ba_bridge_id`, `user_id`, `address_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `users_pictures`
--

CREATE TABLE `users_pictures` (
  `up_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_pic_url` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_pictures`
--

INSERT INTO `users_pictures` (`up_id`, `user_id`, `user_pic_url`, `created_at`) VALUES
(1, 1, 'uploads/cinnamoroll_1746690725.png', '2025-05-08 07:52:05'),
(2, 2, 'uploads/cinnamoroll-wallpaper-kolpaper_1746691275.jpg', '2025-05-08 08:01:15'),
(3, 3, 'uploads/cinnamoroll-wallpaper-kolpaper_1746691442.jpg', '2025-05-08 08:04:02'),
(4, 4, 'uploads/cinnamoroll-wallpaper-kolpaper_1747279393.jpg', '2025-05-15 03:23:13'),
(5, 5, 'uploads/cinnamoroll_1747279564.png', '2025-05-15 03:26:04'),
(6, 6, 'uploads/cinnamoroll_1747281485.png', '2025-05-15 03:58:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD UNIQUE KEY `book_isbn` (`book_isbn`);

--
-- Indexes for table `book_authors`
--
ALTER TABLE `book_authors`
  ADD PRIMARY KEY (`ba_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `book_copy`
--
ALTER TABLE `book_copy`
  ADD PRIMARY KEY (`copy_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genre_id`),
  ADD UNIQUE KEY `genre_name` (`genre_name`);

--
-- Indexes for table `genre_books`
--
ALTER TABLE `genre_books`
  ADD PRIMARY KEY (`gb_id`),
  ADD KEY `genre_id` (`genre_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `transactions_ibfk_2` (`user_id`);

--
-- Indexes for table `transaction_copies`
--
ALTER TABLE `transaction_copies`
  ADD PRIMARY KEY (`tc_id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `copy_id` (`copy_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `borrower_email` (`user_email`);

--
-- Indexes for table `users_address`
--
ALTER TABLE `users_address`
  ADD PRIMARY KEY (`ba_bridge_id`),
  ADD KEY `address_id` (`address_id`),
  ADD KEY `users_address_ibfk_1` (`user_id`);

--
-- Indexes for table `users_pictures`
--
ALTER TABLE `users_pictures`
  ADD PRIMARY KEY (`up_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book_authors`
--
ALTER TABLE `book_authors`
  MODIFY `ba_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `book_copy`
--
ALTER TABLE `book_copy`
  MODIFY `copy_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `genre_books`
--
ALTER TABLE `genre_books`
  MODIFY `gb_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_copies`
--
ALTER TABLE `transaction_copies`
  MODIFY `tc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users_address`
--
ALTER TABLE `users_address`
  MODIFY `ba_bridge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users_pictures`
--
ALTER TABLE `users_pictures`
  MODIFY `up_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_authors`
--
ALTER TABLE `book_authors`
  ADD CONSTRAINT `book_authors_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  ADD CONSTRAINT `book_authors_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `authors` (`author_id`);

--
-- Constraints for table `book_copy`
--
ALTER TABLE `book_copy`
  ADD CONSTRAINT `book_copy_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `genre_books`
--
ALTER TABLE `genre_books`
  ADD CONSTRAINT `genre_books_ibfk_1` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`genre_id`),
  ADD CONSTRAINT `genre_books_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `transaction_copies`
--
ALTER TABLE `transaction_copies`
  ADD CONSTRAINT `transaction_copies_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`),
  ADD CONSTRAINT `transaction_copies_ibfk_2` FOREIGN KEY (`copy_id`) REFERENCES `book_copy` (`copy_id`);

--
-- Constraints for table `users_address`
--
ALTER TABLE `users_address`
  ADD CONSTRAINT `users_address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `users_address_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`);

--
-- Constraints for table `users_pictures`
--
ALTER TABLE `users_pictures`
  ADD CONSTRAINT `users_pictures_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
