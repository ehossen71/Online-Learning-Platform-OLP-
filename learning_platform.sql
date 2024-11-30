-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
<<<<<<< HEAD
-- Generation Time: Nov 30, 2024 at 07:43 PM
=======
-- Generation Time: Nov 30, 2024 at 12:40 PM
>>>>>>> 207cf69f80bf4009604e271543a94946edb1d844
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

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`Announce_ID`, `UserID`, `Course_ID`, `Title`, `Content`, `Created_At`) VALUES
(9, 'faheem123', 'CSE115.2', 'Quiz update', 'Kalke quiz ', '2024-11-29 17:11:00'),
(10, 'faheem123', 'MAT350.9', 'Quiz update', 'lfajslsdjg ojflsdjgl ', '2024-11-29 18:32:32');

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
  `Course_Num` int(20) NOT NULL,
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

INSERT INTO `course` (`Course_Num`, `Course_ID`, `CourseName`, `Description`, `UserID`, `Start_Date`, `End_Date`) VALUES
(3, 'CSE115.2', 'Introduction to C programming', 'This is a C programming language course', 'faheem123', '2024-10-27', '2024-12-25'),
(6, 'HIS103.5', 'Emergence of Bangladesh', 'This course is about history of Bangladesh', 'tanvir123', '2024-09-29', '2024-12-07'),
(4, 'MAT350.9', 'Engineering Mathematics', 'This is an Engineering mathematics course', 'faheem123', '2024-10-27', '2024-12-25'),
(5, 'MAT361.10', 'Statistics ', 'This is a statistics course', 'faheem123', '2024-10-27', '2024-12-25');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `EnrollmentID` int(10) NOT NULL,
  `enrollmentDate` date DEFAULT NULL,
  `StudentID` int(10) DEFAULT NULL,
  `course_ID` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`EnrollmentID`, `enrollmentDate`, `StudentID`, `course_ID`) VALUES
(8, '2024-11-29', 2, 'CSE115.2'),
(9, '2024-11-29', 3, 'MAT350.9'),
(10, '2024-11-29', 3, 'CSE115.2');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `Ins_ID` int(10) NOT NULL,
  `UserID` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`Ins_ID`, `UserID`) VALUES
(1, 'faheem123'),
(2, 'tanvir123');

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
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `Progress_ID` int(10) NOT NULL,
  `Progress_Status` varchar(100) NOT NULL,
  `StudentID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_description`
--

CREATE TABLE `quiz_description` (
  `Course_ID` varchar(20) NOT NULL,
  `Quiz_NO` int(11) NOT NULL,
  `Description_Quiz` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_description`
--

INSERT INTO `quiz_description` (`Course_ID`, `Quiz_NO`, `Description_Quiz`) VALUES
('CSE115.2', 1, 'Read carefully and choose the correct answer after choosing once you cannot back for another choice.'),
('CSE115.2', 2, 'lskfja lsdfjasld dsjlfa; j');

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- Table structure for table `quiz_question`
--

CREATE TABLE `quiz_question` (
  `Course_ID` varchar(20) NOT NULL,
  `Quiz_NO` int(11) NOT NULL,
  `Que_NO` int(11) NOT NULL,
  `Question` text NOT NULL,
  `Choice1` text NOT NULL,
  `Choice2` text NOT NULL,
  `Choice3` text NOT NULL,
  `Choice4` text NOT NULL,
  `Correct_Ans` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_question`
--

INSERT INTO `quiz_question` (`Course_ID`, `Quiz_NO`, `Que_NO`, `Question`, `Choice1`, `Choice2`, `Choice3`, `Choice4`, `Correct_Ans`) VALUES
('CSE115.2', 1, 1, '(a-b)^2 = ?', 'a^2 - 2ab + b^2', 'a^2 - 2ab - b^2', '- a^2 - 2ab + b^2', 'a^2 + 2ab + b^2', 'choice1'),
('CSE115.2', 1, 2, '2+2 = ?', '3', '4', '10', '22', 'choice2'),
('CSE115.2', 2, 1, '3+7 = ?', '9', '11', '10', '13', 'choice3'),
('CSE115.2', 2, 2, 'What is the currency of Bangladesh?', 'Taka', 'Dollar', 'Dirham', 'Pound', 'choice1'),
('CSE115.2', 2, 3, 'What is the capital of Bangladesh?', 'Khulna', 'Dhaka', 'Chittagong', 'Rajshahi', 'choice2');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_result`
=======
-- Table structure for table `quizresult`
>>>>>>> 207cf69f80bf4009604e271543a94946edb1d844
--

CREATE TABLE `quiz_result` (
  `Course_ID` varchar(20) NOT NULL,
  `Quiz_NO` int(11) NOT NULL,
  `Score` int(11) NOT NULL,
  `Student_ID` int(11) NOT NULL,
  `CourseName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_result`
--

INSERT INTO `quiz_result` (`Course_ID`, `Quiz_NO`, `Score`, `Student_ID`, `CourseName`) VALUES
('CSE115.2', 1, 2, 2, 'Introduction to C programming'),
('CSE115.2', 2, 2, 2, 'Introduction to C programming');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_description`
--

CREATE TABLE `quiz_description` (
  `Course_ID` varchar(20) NOT NULL,
  `Quiz_NO` int(11) NOT NULL,
  `Description_Quiz` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_description`
--

INSERT INTO `quiz_description` (`Course_ID`, `Quiz_NO`, `Description_Quiz`) VALUES
('CSE115.2', 1, 'Read carefully and choose the correct answer after choosing once you cannot back for another choice.');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_question`
--

CREATE TABLE `quiz_question` (
  `Course_ID` varchar(20) NOT NULL,
  `Quiz_NO` int(11) NOT NULL,
  `Que_NO` int(11) NOT NULL,
  `Question` text NOT NULL,
  `Choice1` text NOT NULL,
  `Choice2` text NOT NULL,
  `Choice3` text NOT NULL,
  `Choice4` text NOT NULL,
  `Correct_Ans` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_question`
--

INSERT INTO `quiz_question` (`Course_ID`, `Quiz_NO`, `Que_NO`, `Question`, `Choice1`, `Choice2`, `Choice3`, `Choice4`, `Correct_Ans`) VALUES
('CSE115.2', 1, 1, '2+2 = ?', '3', '10', '4', '7', 'choice3'),
('CSE115.2', 1, 2, '(a + b)^2 = ?', 'a^2 + 2ab - b^2', 'a^2 + 2ab + b^2', 'a^2 - 2ab + b^2', 'a^2 + 4ab + b^2', 'choice2'),
('CSE115.2', 1, 3, 'What is the capital of Bangladesh?', 'Khulna', 'Barishal', 'Dhaka', 'Narsingdi', 'choice3'),
('CSE115.2', 1, 4, 'What is the national fruit of Bangladesh?', 'Jackfruit', 'Mango', 'Banana', 'Apple', 'choice1');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `Sec_ID` int(5) NOT NULL,
  `Course_ID` varchar(20) NOT NULL,
  `UserID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`Sec_ID`, `Course_ID`, `UserID`) VALUES
(2, 'CSE115.2', 'faheem123'),
(9, 'MAT350.9', 'faheem123'),
(10, 'MAT361.10', 'faheem123'),
(5, 'HIS103.5', 'tanvir123');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `StudentID` int(10) NOT NULL,
  `UserID` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`StudentID`, `UserID`) VALUES
(2, 'emon123'),
(3, 'tanora123');

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
('emon123', 'Emon', 'Hossen', 'Student', 'eh@gmail.com', '$2y$10$gTExMbhIyWqX4lEihjbSlOhY0hQa7CcM13ptQsToUKq1R/592hcdO'),
('faheem123', 'Faheem', 'Hasnat', 'Instructor', 'fh@gmail.com', '$2y$10$o4EO3hNEYmdlkHMFpwr7/e6/LNPSFv1NTBrrofXrgRkI27tu4kDO6'),
('tanora123', 'Tanora', 'Akther', 'Student', 'ta@gmail.com', '$2y$10$eZMpt7A5.UhoRN//76PijuaYshlWXrawYxbX6RkDSXkpqXm0SZRmC'),
('tanvir123', 'Tanvir', 'Niloy', 'Instructor', 'tn@gmail.com', '$2y$10$P5KcsxDOWi5qfoo3OMdzs.ZTo7u5PNA/6mf08eaMNilZXUb4VEt8a');

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
  ADD UNIQUE KEY `Course` (`Course_Num`),
  ADD KEY `foreign_key_userID` (`UserID`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`EnrollmentID`),
  ADD KEY `studentID` (`StudentID`),
  ADD KEY `course_ID` (`course_ID`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`Ins_ID`),
  ADD KEY `userID` (`UserID`);

--
-- Indexes for table `leaderboard`
--
ALTER TABLE `leaderboard`
  ADD PRIMARY KEY (`LeaderboardID`),
  ADD KEY `quizresultID` (`quizresultID`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`Progress_ID`),
  ADD KEY `StudentID` (`StudentID`);

--
-- Indexes for table `quiz_description`
--
ALTER TABLE `quiz_description`
  ADD PRIMARY KEY (`Course_ID`,`Quiz_NO`);

--
<<<<<<< HEAD
-- Indexes for table `quiz_question`
--
ALTER TABLE `quiz_question`
  ADD PRIMARY KEY (`Course_ID`,`Quiz_NO`,`Que_NO`);

--
-- Indexes for table `quiz_result`
=======
-- Indexes for table `quizresult`
>>>>>>> 207cf69f80bf4009604e271543a94946edb1d844
--
ALTER TABLE `quiz_result`
  ADD PRIMARY KEY (`Course_ID`,`Quiz_NO`,`Student_ID`);

--
-- Indexes for table `quiz_description`
--
ALTER TABLE `quiz_description`
  ADD PRIMARY KEY (`Course_ID`,`Quiz_NO`);

--
-- Indexes for table `quiz_question`
--
ALTER TABLE `quiz_question`
  ADD PRIMARY KEY (`Course_ID`,`Quiz_NO`,`Que_NO`);

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
  ADD KEY `userID` (`UserID`);

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
  MODIFY `Announce_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `Course_Num` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `EnrollmentID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `Ins_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `StudentID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
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
-- Constraints for table `progress`
--
ALTER TABLE `progress`
  ADD CONSTRAINT `progress_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `student` (`StudentID`);

--
-- Constraints for table `quiz_question`
--
ALTER TABLE `quiz_question`
  ADD CONSTRAINT `quiz_question_ibfk_1` FOREIGN KEY (`Course_ID`,`Quiz_NO`) REFERENCES `quiz_description` (`Course_ID`, `Quiz_NO`) ON DELETE CASCADE;

--
<<<<<<< HEAD
-- Constraints for table `quiz_result`
--
ALTER TABLE `quiz_result`
  ADD CONSTRAINT `quiz_result_ibfk_1` FOREIGN KEY (`Course_ID`) REFERENCES `course` (`Course_ID`);
=======
-- Constraints for table `quizresult`
--
ALTER TABLE `quizresult`
  ADD CONSTRAINT `quizresult_ibfk_1` FOREIGN KEY (`quiz_ID`) REFERENCES `quiz` (`Quiz_ID`),
  ADD CONSTRAINT `quizresult_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `student` (`StudentID`);
>>>>>>> 207cf69f80bf4009604e271543a94946edb1d844

--
-- Constraints for table `quiz_question`
--
ALTER TABLE `quiz_question`
  ADD CONSTRAINT `quiz_question_ibfk_1` FOREIGN KEY (`Course_ID`,`Quiz_NO`) REFERENCES `quiz_description` (`Course_ID`, `Quiz_NO`) ON DELETE CASCADE;

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
