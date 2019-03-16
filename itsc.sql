-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2019 at 12:58 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itsc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `Name`, `Email`, `password`) VALUES
(1, 'I.T.S.C Staff', 'itscstaff@gmail.com', '$2y$10$XG2.Gbt5l2aoXJ1Ye.J4U.p7C1oMqvqKA.JyKaORm3f9flrjzdNEy');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Vendor` varchar(255) NOT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `Name`, `Vendor`, `Description`) VALUES
(1, 'Cisco Certified Entry Networking Technician (CCENT)', 'Cisco', 'Entry level networking certificate');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Description` varchar(255) NOT NULL,
  `Duration` smallint(6) NOT NULL,
  `image_directory` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `Name`, `Description`, `Duration`, `image_directory`) VALUES
(5, 'Software Engineering I', 'Software modelling and analysis', 250, 'Software Engineering I.png'),
(9, 'Object-Oriented Programming I', 'This is a beginner course for OOP in Java.', 125, NULL),
(10, 'Data Structures and Algorithms', 'Stacks, queues, linked lists...', 40, NULL),
(11, 'Fundamentals of Networking', 'Entry level networking course', 110, NULL),
(12, 'Data Science', 'Data science with R/Python', 30, NULL),
(13, 'Mobile Programming I', 'Beginner android course', 60, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `offeredcourse`
--

CREATE TABLE `offeredcourse` (
  `course_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `studentcourses`
--

CREATE TABLE `studentcourses` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `offered_course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `MobileTel` text NOT NULL,
  `OfficeTel` text,
  `Organization` varchar(255) DEFAULT NULL,
  `JobTitle` varchar(255) DEFAULT NULL,
  `POBox` varchar(255) DEFAULT NULL,
  `image_directory` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `Name`, `Email`, `password`, `MobileTel`, `OfficeTel`, `Organization`, `JobTitle`, `POBox`, `image_directory`) VALUES
(8, 'Abel T. Belay', 'abeltefera16@gmail.com', '$2y$10$WBLgml9Vbp0OPCvlLolKmOvxGk4ge/o6oNNV/wtITKqIMqw4/Xol6', '923942288', '', 'AAiT', 'Student', '', 'C:\\xampp\\htdocs\\itsc\\public\\img\\7.png'),
(9, 'Bereket Yohaness', 'bekijohn@gmail.com', '$2y$10$nOEAjawQHzMjE3ZhRdG1mOXYP2FMXg6z/./4FPU2lvmfKjyu5W5IK', '911223344', '', 'Addis Ababa University', 'Student', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Certificates` int(11) DEFAULT NULL,
  `image_directory` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `Name`, `password`, `Email`, `Certificates`, `image_directory`) VALUES
(1, 'Molalgne', '$2y$10$CckHs5UtGJ7hO.Lqfo3TNeUF6eBwV0Vj2XfmziJa39JU0X0UfAHf2', 'molbill@gmail.com', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `date` (`date`),
  ADD KEY `Attendance_fk0` (`student_id`),
  ADD KEY `Attendance_fk1` (`course_id`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offeredcourse`
--
ALTER TABLE `offeredcourse`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `studentcourses`
--
ALTER TABLE `studentcourses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `StudentCourses_fk0` (`student_id`),
  ADD KEY `StudentCourses_fk1` (`teacher_id`),
  ADD KEY `StudentCourses_fk2` (`offered_course_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Teachers_fk0` (`Certificates`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `studentcourses`
--
ALTER TABLE `studentcourses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `Attendance_fk0` FOREIGN KEY (`student_id`) REFERENCES `studentcourses` (`student_id`),
  ADD CONSTRAINT `Attendance_fk1` FOREIGN KEY (`course_id`) REFERENCES `studentcourses` (`offered_course_id`);

--
-- Constraints for table `offeredcourse`
--
ALTER TABLE `offeredcourse`
  ADD CONSTRAINT `OfferedCourse_fk0` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `studentcourses`
--
ALTER TABLE `studentcourses`
  ADD CONSTRAINT `StudentCourses_fk0` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `StudentCourses_fk1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`),
  ADD CONSTRAINT `StudentCourses_fk2` FOREIGN KEY (`offered_course_id`) REFERENCES `offeredcourse` (`course_id`);

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `Teachers_fk0` FOREIGN KEY (`Certificates`) REFERENCES `certificates` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
