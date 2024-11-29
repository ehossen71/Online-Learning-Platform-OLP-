-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2024 at 04:31 PM
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
-- Database: `learning_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `Announce_ID` int(10) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `Course_ID` varchar(20) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Content` longtext NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certification`
--

CREATE TABLE `certification` (
  `CertificationID` int(10) NOT NULL,
  `IssueDate` date DEFAULT NULL,
  `enrollmentID` int(10) DEFAULT NULL,
  `studentID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `Course_ID` varchar(20) NOT NULL,
  `CourseName` varchar(50) DEFAULT NULL,
  `Description` longtext NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `Start_Date` date DEFAULT NULL,
  `End_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`Course_ID`, `CourseName`, `Description`, `UserID`, `Start_Date`, `End_Date`) VALUES
('CSE115.6', 'Introduction to C programming', 'This is a C language code.', 'faheem123', '2024-10-27', '2024-12-04'),
('CSE215.4', 'Object Oriented Language', 'This is a java language course.(Updated)', 'faheem123', '2024-10-15', '2024-12-11');

-- --------------------------------------------------------

--
-- Table structure for table `degree`
--

CREATE TABLE `degree` (
  `DegreeID` int(10) NOT NULL,
  `Ins_ID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `earns`
--

CREATE TABLE `earns` (
  `certificationID` int(10) DEFAULT NULL,
  `studentID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `EnrollmentID` int(10) NOT NULL,
  `enrollmentDate` date DEFAULT NULL,
  `studentID` int(10) DEFAULT NULL,
  `course_ID` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `Ins_ID` int(10) NOT NULL,
  `userID` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leaderboard`
--

CREATE TABLE `leaderboard` (
  `LeaderboardID` int(10) NOT NULL,
  `QuizScore` double DEFAULT NULL,
  `Rank` int(10) DEFAULT NULL,
  `quizresultID` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perform`
--

CREATE TABLE `perform` (
  `quiz_ID` int(20) DEFAULT NULL,
  `studentID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `Progress_ID` int(10) NOT NULL,
  `Progress_Status` varchar(100) NOT NULL,
  `StudentID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qualification`
--

CREATE TABLE `qualification` (
  `Institution` varchar(100) NOT NULL,
  `Ins_ID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `Quiz_ID` int(20) NOT NULL,
  `Quizname` varchar(50) DEFAULT NULL,
  `studentID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quizresult`
--

CREATE TABLE `quizresult` (
  `QuizResultID` int(20) NOT NULL,
  `Quizname` varchar(50) DEFAULT NULL,
  `Score` double DEFAULT NULL,
  `quiz_ID` int(20) DEFAULT NULL,
  `studentID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `Sec_ID` int(5) NOT NULL,
  `Course_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`Sec_ID`, `Course_ID`) VALUES
(4, 'CSE215.4'),
(6, 'CSE115.6');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `StudentID` int(10) NOT NULL,
  `Enrollment_Date` date NOT NULL,
  `userID` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `UserID` varchar(50) NOT NULL,
  `First_Name` varchar(50) NOT NULL,
  `Last_Name` varchar(50) NOT NULL,
  `Role` enum('Student','Instructor') NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`UserID`, `First_Name`, `Last_Name`, `Role`, `Email`, `Password`) VALUES
('emon123', 'Emon', 'Hossen', 'Student', 'em@gmail.com', '$2y$10$LPIH06qo29BJCdefX6kNcejfcAocls1atP1M1VPN86JN8Kp.thm3.'),
('faheem123', 'Faheem', 'Hasnat', 'Instructor', 'fh@gmail.com', '$2y$10$cdLtQ/uAUjKXdcycAoTVlOxZmpG2M6Ncu7nZLaTn1E4IhGjKuWOdC'),
('tanora123', 'Tanora', 'Akther', 'Instructor', 'ta@gmail.com', '$2y$10$DwexI0bqJ7hS3Sn.yzrd8uKyFZCJyeNR8aBn8x0bElILl/duYG3/i');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`Announce_ID`),
  ADD KEY `fk_course` (`Course_ID`),
  ADD KEY `fk_UserID` (`UserID`);

--
-- Indexes for table `certification`
--
ALTER TABLE `certification`
  ADD PRIMARY KEY (`CertificationID`),
  ADD KEY `enrollmentID` (`enrollmentID`),
  ADD KEY `studentID` (`studentID`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`Course_ID`),
  ADD UNIQUE KEY `Course_ID` (`Course_ID`),
  ADD KEY `foreign_key_userID` (`UserID`);

--
-- Indexes for table `degree`
--
ALTER TABLE `degree`
  ADD PRIMARY KEY (`DegreeID`),
  ADD KEY `Ins_ID` (`Ins_ID`);

--
-- Indexes for table `earns`
--
ALTER TABLE `earns`
  ADD KEY `certificationID` (`certificationID`),
  ADD KEY `studentID` (`studentID`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`EnrollmentID`),
  ADD KEY `studentID` (`studentID`),
  ADD KEY `course_ID` (`course_ID`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`Ins_ID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `leaderboard`
--
ALTER TABLE `leaderboard`
  ADD PRIMARY KEY (`LeaderboardID`),
  ADD KEY `quizresultID` (`quizresultID`);

--
-- Indexes for table `perform`
--
ALTER TABLE `perform`
  ADD KEY `quiz_ID` (`quiz_ID`),
  ADD KEY `studentID` (`studentID`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`Progress_ID`),
  ADD KEY `StudentID` (`StudentID`);

--
-- Indexes for table `qualification`
--
ALTER TABLE `qualification`
  ADD KEY `Ins_ID` (`Ins_ID`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`Quiz_ID`),
  ADD KEY `studentID` (`studentID`);

--
-- Indexes for table `quizresult`
--
ALTER TABLE `quizresult`
  ADD PRIMARY KEY (`QuizResultID`),
  ADD KEY `quiz_ID` (`quiz_ID`),
  ADD KEY `studentID` (`studentID`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD KEY `foreign_key_Course_ID` (`Course_ID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`StudentID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `Announce_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `degree`
--
ALTER TABLE `degree`
  MODIFY `DegreeID` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcement`
--
ALTER TABLE `announcement`
  ADD CONSTRAINT `fk_UserID` FOREIGN KEY (`UserID`) REFERENCES `userinfo` (`UserID`),
  ADD CONSTRAINT `fk_course` FOREIGN KEY (`Course_ID`) REFERENCES `course` (`Course_ID`);

--
-- Constraints for table `certification`
--
ALTER TABLE `certification`
  ADD CONSTRAINT `certification_ibfk_1` FOREIGN KEY (`enrollmentID`) REFERENCES `enrollment` (`EnrollmentID`),
  ADD CONSTRAINT `certification_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `student` (`StudentID`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `foreign_key_userID` FOREIGN KEY (`UserID`) REFERENCES `userinfo` (`UserID`);

--
-- Constraints for table `degree`
--
ALTER TABLE `degree`
  ADD CONSTRAINT `degree_ibfk_1` FOREIGN KEY (`Ins_ID`) REFERENCES `instructor` (`Ins_ID`);

--
-- Constraints for table `earns`
--
ALTER TABLE `earns`
  ADD CONSTRAINT `earns_ibfk_1` FOREIGN KEY (`certificationID`) REFERENCES `certification` (`CertificationID`),
  ADD CONSTRAINT `earns_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `student` (`StudentID`);

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `student` (`StudentID`),
  ADD CONSTRAINT `enrollment_ibfk_2` FOREIGN KEY (`course_ID`) REFERENCES `course` (`Course_ID`);

--
-- Constraints for table `instructor`
--
ALTER TABLE `instructor`
  ADD CONSTRAINT `instructor_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `userinfo` (`UserID`);

--
-- Constraints for table `leaderboard`
--
ALTER TABLE `leaderboard`
  ADD CONSTRAINT `leaderboard_ibfk_1` FOREIGN KEY (`quizresultID`) REFERENCES `quizresult` (`QuizResultID`);

--
-- Constraints for table `perform`
--
ALTER TABLE `perform`
  ADD CONSTRAINT `perform_ibfk_1` FOREIGN KEY (`quiz_ID`) REFERENCES `quiz` (`Quiz_ID`),
  ADD CONSTRAINT `perform_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `student` (`StudentID`);

--
-- Constraints for table `progress`
--
ALTER TABLE `progress`
  ADD CONSTRAINT `progress_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `student` (`StudentID`);

--
-- Constraints for table `qualification`
--
ALTER TABLE `qualification`
  ADD CONSTRAINT `qualification_ibfk_1` FOREIGN KEY (`Ins_ID`) REFERENCES `instructor` (`Ins_ID`);

--
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `quiz_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `student` (`StudentID`);

--
-- Constraints for table `quizresult`
--
ALTER TABLE `quizresult`
  ADD CONSTRAINT `quizresult_ibfk_1` FOREIGN KEY (`quiz_ID`) REFERENCES `quiz` (`Quiz_ID`),
  ADD CONSTRAINT `quizresult_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `student` (`StudentID`);

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `foreign_key_Course_ID` FOREIGN KEY (`Course_ID`) REFERENCES `course` (`Course_ID`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `userinfo` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
