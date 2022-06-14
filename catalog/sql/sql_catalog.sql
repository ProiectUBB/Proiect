-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2022 at 08:10 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_catalog`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id_class` int(11) NOT NULL,
  `class_name` varchar(256) NOT NULL,
  `description` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `laboratory`
--

CREATE TABLE `laboratory` (
  `id_laboratory` int(11) NOT NULL,
  `id_class` int(11) NOT NULL,
  `laboratory_name` varchar(64) NOT NULL,
  `laboratory_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `laboratory_attendance`
--

CREATE TABLE `laboratory_attendance` (
  `id_laboratory` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `is_present` tinyint(4) NOT NULL,
  `date` datetime NOT NULL,
  `grade` tinyint(4) DEFAULT NULL,
  `mentions` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `role_name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_role`, `role_name`) VALUES
(1, 'sysadmin'),
(2, 'admin'),
(3, 'teacher'),
(4, 'student');

-- --------------------------------------------------------

--
-- Table structure for table `seminar`
--

CREATE TABLE `seminar` (
  `id_seminar` int(11) NOT NULL,
  `id_class` int(11) NOT NULL,
  `seminar_name` varchar(64) NOT NULL,
  `seminar_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `seminar_attendance`
--

CREATE TABLE `seminar_attendance` (
  `id_seminar` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `is_present` tinyint(4) NOT NULL,
  `date` datetime NOT NULL,
  `mentions` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `reg_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `id_role`, `username`, `password`, `first_name`, `last_name`, `email`) VALUES
(1, 1, 'sysadmin', 'sysadmin', 'sysadmin', 'sysadmin', 'sysadmin@email.com'),
(2, 2, 'admin', 'admin', 'admin', 'admin', 'admin@email.com'),
(3, 3, 'teacher', 'teacher', 'teacher', 'teacher', 'teacher@email.com'),
(4, 4, 'student', 'student', 'student', 'student', 'student@email.com');

-- --------------------------------------------------------

--
-- Table structure for table `users_classes`
--

CREATE TABLE `users_classes` (
  `id_user` int(11) NOT NULL,
  `id_class` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id_class`);

--
-- Indexes for table `laboratory`
--
ALTER TABLE `laboratory`
  ADD PRIMARY KEY (`id_laboratory`),
  ADD KEY `FK_32` (`id_class`);

--
-- Indexes for table `laboratory_attendance`
--
ALTER TABLE `laboratory_attendance`
  ADD PRIMARY KEY (`id_laboratory`,`id_user`),
  ADD KEY `FK_38` (`id_user`),
  ADD KEY `FK_47` (`id_laboratory`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `seminar`
--
ALTER TABLE `seminar`
  ADD PRIMARY KEY (`id_seminar`),
  ADD KEY `FK_35` (`id_class`);

--
-- Indexes for table `seminar_attendance`
--
ALTER TABLE `seminar_attendance`
  ADD PRIMARY KEY (`id_seminar`,`id_user`),
  ADD KEY `FK_41` (`id_user`),
  ADD KEY `FK_44` (`id_seminar`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `FK_29` (`id_role`);

--
-- Indexes for table `users_classes`
--
ALTER TABLE `users_classes`
  ADD PRIMARY KEY (`id_user`,`id_class`),
  ADD KEY `FK_22` (`id_user`),
  ADD KEY `FK_25` (`id_class`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id_class` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laboratory`
--
ALTER TABLE `laboratory`
  MODIFY `id_laboratory` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seminar`
--
ALTER TABLE `seminar`
  MODIFY `id_seminar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `laboratory`
--
ALTER TABLE `laboratory`
  ADD CONSTRAINT `FK_30` FOREIGN KEY (`id_class`) REFERENCES `classes` (`id_class`);

--
-- Constraints for table `laboratory_attendance`
--
ALTER TABLE `laboratory_attendance`
  ADD CONSTRAINT `FK_36` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `FK_45` FOREIGN KEY (`id_laboratory`) REFERENCES `laboratory` (`id_laboratory`);

--
-- Constraints for table `seminar`
--
ALTER TABLE `seminar`
  ADD CONSTRAINT `FK_33` FOREIGN KEY (`id_class`) REFERENCES `classes` (`id_class`);

--
-- Constraints for table `seminar_attendance`
--
ALTER TABLE `seminar_attendance`
  ADD CONSTRAINT `FK_39` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `FK_42` FOREIGN KEY (`id_seminar`) REFERENCES `seminar` (`id_seminar`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_27` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`);

--
-- Constraints for table `users_classes`
--
ALTER TABLE `users_classes`
  ADD CONSTRAINT `FK_20` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `FK_23` FOREIGN KEY (`id_class`) REFERENCES `classes` (`id_class`);
