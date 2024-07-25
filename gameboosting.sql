-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2024 at 01:48 AM
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
-- Database: `gameboosting`
--

-- --------------------------------------------------------

--
-- Table structure for table `boosting_session_report`
--

CREATE TABLE `boosting_session_report` (
  `boosting_session_rep_id` int(11) NOT NULL,
  `boosting_session_id` int(11) DEFAULT NULL,
  `client_player_id` int(11) DEFAULT NULL,
  `reason` varchar(100) DEFAULT NULL,
  `status` enum('checked','notchecked') DEFAULT NULL,
  `checkedby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `boosting_session_report`
--

INSERT INTO `boosting_session_report` (`boosting_session_rep_id`, `boosting_session_id`, `client_player_id`, `reason`, `status`, `checkedby`) VALUES
(1, 1, 2, 'Trashtalking', 'checked', 2),
(2, 2, 3, 'Fake Booster', '', NULL),
(3, 3, 3, 'Fake Booster', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `boostsession`
--

CREATE TABLE `boostsession` (
  `boostSessionID` int(11) NOT NULL,
  `traineeID` int(11) NOT NULL,
  `boosterID` int(11) NOT NULL,
  `game` varchar(255) NOT NULL,
  `gameRank` varchar(50) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'On hold'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `boostsession`
--

INSERT INTO `boostsession` (`boostSessionID`, `traineeID`, `boosterID`, `game`, `gameRank`, `startDate`, `endDate`, `startTime`, `endTime`, `status`) VALUES
(1, 2, 1, 'League of Legends', 'Iron', '2024-07-19', '2024-07-20', '10:00:00', '12:00:00', 'All Accepted'),
(2, 3, 1, 'League of Legends', 'Iron', '2024-07-21', '2024-07-22', '10:00:00', '12:00:00', 'Coach Accepted'),
(3, 4, 1, 'League of Legends', 'Iron', '2024-07-23', '2024-07-24', '10:00:00', '12:00:00', 'On hold'),
(4, 5, 1, 'League of Legends', 'Iron', '2024-07-25', '2024-07-26', '10:00:00', '12:00:00', 'Coach Rejected'),
(5, 1, 31, 'Dota 2', 'Herald', '2024-07-31', '2024-08-01', '13:00:00', '15:00:00', 'All Accepted'),
(6, 1, 27, 'Counter Strike 2', 'Gold Nova', '2024-07-21', '2024-07-22', '07:30:00', '17:30:00', 'On hold'),
(7, 1, 27, 'Counter Strike 2', 'Gold Nova', '2024-07-21', '2024-07-22', '07:30:00', '17:30:00', 'On hold'),
(8, 2, 66, 'Chess', 'Between 1000 and 1199', '2024-07-21', '2024-07-22', '13:00:00', '15:00:00', 'On hold');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_ID` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dateofbirth` date NOT NULL,
  `region` enum('North America','South America','Europe','Asia','Oceania','Antartica','Africa') DEFAULT NULL,
  `bio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_ID`, `username`, `fname`, `lname`, `password`, `phoneNumber`, `email`, `dateofbirth`, `region`, `bio`) VALUES
(1, 'johnCapoy123', 'John', 'CapoyZa', '202cb962ac59075b964b07152d234b70', '98234234212', 'johncapoy@gmail.com', '1999-05-03', 'Europe', 'hello12421'),
(2, 'skibidi', 'Skib', 'Idi', '202cb962ac59075b964b07152d234b70', '0923421241', 'skibidi@mail.com', '2015-10-26', 'Asia', 'hello'),
(3, 'user', 'user', 'user', '202cb962ac59075b964b07152d234b70', '3251551', 'user@mail.com', '2002-07-18', 'Asia', 'hello'),
(4, 'user1', 'John', 'Smith', 'pass1', '123-456-7890', 'user1@example.com', '1990-01-01', 'North America', 'hello'),
(5, 'user2', 'Emily', 'Johnson', 'pass2', '234-567-8901', 'user2@example.com', '1991-02-02', 'South America', 'hello'),
(6, 'user3', 'Michael', 'Williams', 'pass3', '345-678-9012', 'user3@example.com', '1992-03-03', 'Europe', 'hello'),
(7, 'user4', 'Jessica', 'Jones', 'pass4', '456-789-0123', 'user4@example.com', '1993-04-04', 'Asia', 'hello'),
(8, 'user5', 'Daniel', 'Brown', 'pass5', '567-890-1234', 'user5@example.com', '1994-05-05', 'Oceania', 'hello'),
(9, 'user6', 'Sarah', 'Miller', 'pass6', '678-901-2345', 'user6@example.com', '1995-06-06', 'Antartica', 'hello'),
(10, 'user7', 'David', 'Davis', 'pass7', '789-012-3456', 'user7@example.com', '1996-07-07', 'Africa', 'hello'),
(11, 'user8', 'Lisa', 'Martinez', 'pass8', '890-123-4567', 'user8@example.com', '1997-08-08', 'North America', 'hello'),
(12, 'user9', 'Kevin', 'Garcia', 'pass9', '901-234-5678', 'user9@example.com', '1998-09-09', 'South America', 'hello'),
(13, 'user10', 'Rachel', 'Rodriguez', 'pass10', '012-345-6789', 'user10@example.com', '1999-10-10', 'Europe', 'hello'),
(14, 'user11', 'Andrew', 'Lopez', 'pass11', '987-654-3210', 'user11@example.com', '1980-11-11', 'Asia', 'hello'),
(15, 'user12', 'Jessica', 'Wilson', 'pass12', '876-543-2109', 'user12@example.com', '1981-12-12', 'Oceania', 'hello'),
(16, 'user13', 'Matthew', 'Gonzalez', 'pass13', '765-432-1098', 'user13@example.com', '1982-01-13', 'Antartica', 'hello'),
(17, 'user14', 'Amanda', 'Perez', 'pass14', '654-321-0987', 'user14@example.com', '1983-02-14', 'Africa', 'hello'),
(18, 'user15', 'Christopher', 'Robinson', 'pass15', '543-210-9876', 'user15@example.com', '1984-03-15', 'North America', 'hello'),
(19, 'user16', 'Ashley', 'Hernandez', 'pass16', '432-109-8765', 'user16@example.com', '1985-04-16', 'South America', 'hello'),
(20, 'user17', 'Justin', 'Moore', 'pass17', '321-098-7654', 'user17@example.com', '1986-05-17', 'Europe', 'hello'),
(21, 'user18', 'Stephanie', 'Young', 'pass18', '210-987-6543', 'user18@example.com', '1987-06-18', 'Asia', 'hello'),
(22, 'user19', 'Ryan', 'King', 'pass19', '109-876-5432', 'user19@example.com', '1988-07-19', 'Oceania', 'hello'),
(23, 'user20', 'Brittany', 'Scott', 'pass20', '098-765-4321', 'user20@example.com', '1989-08-20', 'Antartica', 'hello'),
(24, 'user21', 'Jonathan', 'Nguyen', 'pass21', '987-654-3210', 'user21@example.com', '1970-09-21', 'Africa', 'hello'),
(25, 'user22', 'Nicole', 'Hill', 'pass22', '876-543-2109', 'user22@example.com', '1971-10-22', 'North America', 'hello'),
(26, 'user23', 'Brandon', 'Flores', 'pass23', '765-432-1098', 'user23@example.com', '1972-11-23', 'South America', 'hello'),
(27, 'user24', 'Melissa', 'Green', 'pass24', '654-321-0987', 'user24@example.com', '1973-12-24', 'Europe', 'hello'),
(28, 'user25', 'Victoria', 'Adams', 'pass25', '543-210-9876', 'user25@example.com', '1974-01-25', 'Asia', 'hello'),
(29, 'user26', 'Eric', 'Baker', 'pass26', '432-109-8765', 'user26@example.com', '1975-02-26', 'Oceania', 'hello'),
(30, 'user27', 'Samantha', 'Nelson', 'pass27', '321-098-7654', 'user27@example.com', '1976-03-27', 'Antartica', 'hello'),
(31, 'user28', 'Alex', 'Carter', 'pass28', '210-987-6543', 'user28@example.com', '1977-04-28', 'Africa', 'hello'),
(32, 'user29', 'Joshua', 'Mitchell', 'pass29', '109-876-5432', 'user29@example.com', '1978-05-29', 'North America', 'hello'),
(33, 'user30', 'Michelle', 'Perez', 'pass30', '098-765-4321', 'user30@example.com', '1979-06-30', 'South America', 'hello'),
(34, 'user31', 'Daniel', 'Harris', 'pass31', '987-654-3210', 'user31@example.com', '1960-07-31', 'Europe', 'hello'),
(35, 'user32', 'Kimberly', 'Gonzales', 'pass32', '876-543-2109', 'user32@example.com', '1961-08-01', 'Asia', 'hello'),
(36, 'user33', 'Tyler', 'Cook', 'pass33', '765-432-1098', 'user33@example.com', '1962-09-02', 'Oceania', 'hello'),
(37, 'user34', 'Katherine', 'Bailey', 'pass34', '654-321-0987', 'user34@example.com', '1963-10-03', 'Antartica', 'hello'),
(38, 'user35', 'Austin', 'Rivera', 'pass35', '543-210-9876', 'user35@example.com', '1964-11-04', 'Africa', 'hello'),
(39, 'user36', 'Megan', 'Cooper', 'pass36', '432-109-8765', 'user36@example.com', '1965-12-05', 'North America', 'hello'),
(40, 'user37', 'Benjamin', 'Richardson', 'pass37', '321-098-7654', 'user37@example.com', '1966-01-06', 'South America', 'hello'),
(41, 'user38', 'Laura', 'Torres', 'pass38', '210-987-6543', 'user38@example.com', '1967-02-07', 'Europe', 'hello'),
(42, 'user39', 'Gabriel', 'Morris', 'pass39', '109-876-5432', 'user39@example.com', '1968-03-08', 'Asia', 'hello'),
(43, 'user40', 'Alyssa', 'Ward', 'pass40', '098-765-4321', 'user40@example.com', '1969-04-09', 'Oceania', 'hello'),
(44, 'user41', 'Zachary', 'James', 'pass41', '987-654-3210', 'user41@example.com', '1950-05-10', 'Antartica', 'hello'),
(45, 'user42', 'Julia', 'Watson', 'pass42', '876-543-2109', 'user42@example.com', '1951-06-11', 'Africa', 'hello'),
(46, 'user43', 'Kyle', 'Brooks', 'pass43', '765-432-1098', 'user43@example.com', '1952-07-12', 'North America', 'hello'),
(47, 'user44', 'Hannah', 'Sanders', 'pass44', '654-321-0987', 'user44@example.com', '1953-08-13', 'South America', 'hello'),
(48, 'user45', 'Jacob', 'Bennett', 'pass45', '543-210-9876', 'user45@example.com', '1954-09-14', 'Europe', 'hello'),
(49, 'user46', 'Olivia', 'Perry', 'pass46', '432-109-8765', 'user46@example.com', '1955-10-15', 'Asia', 'hello'),
(50, 'user47', 'Nathan', 'Long', 'pass47', '321-098-7654', 'user47@example.com', '1956-11-16', 'Oceania', 'hello'),
(51, 'user48', 'Emma', 'Reed', 'pass48', '210-987-6543', 'user48@example.com', '1957-12-17', 'Antartica', 'hello'),
(52, 'user49', 'Alexander', 'Kim', 'pass49', '109-876-5432', 'user49@example.com', '1958-01-18', 'Africa', 'hello'),
(53, 'user50', 'Madison', 'Evans', 'pass50', '098-765-4321', 'user50@example.com', '1959-02-19', 'North America', 'hello'),
(54, 'Johnn', 'Cpooyy', 'SADAW', '202cb962ac59075b964b07152d234b70', '98234281234', 'john@mail.com', '2005-08-29', 'Asia', 'hello'),
(55, 'Jaczyo', 'Kiwoi', 'JAXWRer', '202cb962ac59075b964b07152d234b70', '09783327242', 'jawx@gmail.com', '1997-10-26', 'Oceania', 'hello'),
(56, 'example', 'exam', 'ple', '202cb962ac59075b964b07152d234b70', '213512322', 'example@mail.com', '2003-10-29', 'Europe', 'hello'),
(57, '1', '27', 'Counter Strike 2', 'Master Guardian', '2024-03-12', '2004-04-12', '0000-00-00', '', 'hello'),
(58, 'franzGuessr', 'franz', 'Guessr', '4297f44b13955235245b2497399d7a93', '09297783232', 'franz@mail.com', '2002-09-21', 'Europe', 'hello'),
(59, 'Trying', 'Try', 'Ying', '4297f44b13955235245b2497399d7a93', '09297718273', 'ying@mail.com', '2002-10-02', 'Asia', 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `client_booster`
--

CREATE TABLE `client_booster` (
  `client_booster_id` int(11) NOT NULL,
  `IGN` varchar(255) NOT NULL,
  `client_id` int(11) NOT NULL,
  `coach_uid` varchar(255) NOT NULL,
  `game` varchar(255) NOT NULL,
  `gamerank` varchar(255) NOT NULL,
  `game_uid_screenshot` varchar(255) NOT NULL,
  `game_rank_screenshot` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `upload_Date` date DEFAULT curdate(),
  `status` varchar(255) NOT NULL DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_booster`
--

INSERT INTO `client_booster` (`client_booster_id`, `IGN`, `client_id`, `coach_uid`, `game`, `gamerank`, `game_uid_screenshot`, `game_rank_screenshot`, `price`, `upload_Date`, `status`) VALUES
(1, 'Summoner1', 1, '101', 'League of Legends', 'Gold', '', '', 10.00, '2024-07-14', 'Available'),
(2, 'Summoner2', 2, '102', 'League of Legends', 'Platinum', '', '', 10.00, '2024-07-14', 'Available'),
(3, 'Summoner3', 3, '103', 'League of Legends', 'Diamond', '', '', 10.00, '2024-07-14', 'Available'),
(4, 'Summoner4', 4, '104', 'League of Legends', 'Master', '', '', 10.00, '2024-07-14', 'Available'),
(5, 'Summoner5', 5, '105', 'League of Legends', 'GrandMaster', '', '', 10.00, '2024-07-14', 'Available'),
(6, 'Summoner6', 6, '106', 'League of Legends', 'Challenger', '', '', 10.00, '2024-07-14', 'Available'),
(7, 'Rocketeer1', 7, '107', 'Rocket League', 'Platinum', '', '', 10.00, '2024-07-14', 'Available'),
(8, 'Rocketeer2', 8, '108', 'Rocket League', 'Diamond', '', '', 10.00, '2024-07-14', 'Available'),
(9, 'Rocketeer3', 9, '109', 'Rocket League', 'Champion', '', '', 10.00, '2024-07-14', 'Available'),
(10, 'Rocketeer4', 10, '110', 'Rocket League', 'Grand Champion', '', '', 10.00, '2024-07-14', 'Available'),
(11, 'Rocketeer5', 11, '111', 'Rocket League', 'Supersonic Legend', '', '', 10.00, '2024-07-14', 'Available'),
(12, 'FortnitePlayer1', 12, '112', 'Fortnite', 'Platinum', '', '', 10.00, '2024-07-14', 'Available'),
(13, 'FortnitePlayer2', 13, '113', 'Fortnite', 'Diamond', '', '', 10.00, '2024-07-14', 'Available'),
(14, 'FortnitePlayer3', 14, '114', 'Fortnite', 'Elite', '', '', 10.00, '2024-07-14', 'Available'),
(15, 'FortnitePlayer4', 15, '115', 'Fortnite', 'Champion', '', '', 10.00, '2024-07-14', 'Available'),
(16, 'FortnitePlayer5', 16, '116', 'Fortnite', 'Unreal', '', '', 10.00, '2024-07-14', 'Available'),
(17, 'ValorantAgent1', 17, '117', 'Valorant', 'Gold', '', '', 10.00, '2024-07-14', 'Available'),
(18, 'ValorantAgent2', 18, '118', 'Valorant', 'Platinum', '', '', 10.00, '2024-07-14', 'Available'),
(19, 'ValorantAgent3', 19, '119', 'Valorant', 'Diamond', '', '', 10.00, '2024-07-14', 'Available'),
(20, 'ValorantAgent4', 20, '120', 'Valorant', 'Ascendant', '', '', 10.00, '2024-07-14', 'Available'),
(21, 'ValorantAgent5', 21, '121', 'Valorant', 'Immortal', '', '', 10.00, '2024-07-14', 'Available'),
(22, 'ValorantAgent6', 22, '122', 'Valorant', 'Radiant', '', '', 10.00, '2024-07-14', 'Available'),
(23, 'CSPlayer1', 23, '123', 'Counter Strike 2', 'Gold Nova', '', '', 10.00, '2024-07-14', 'Available'),
(24, 'CSPlayer2', 24, '124', 'Counter Strike 2', 'Master Guardian', '', '', 10.00, '2024-07-14', 'Available'),
(25, 'CSPlayer3', 25, '125', 'Counter Strike 2', 'Legendary Eagle', '', '', 10.00, '2024-07-14', 'Available'),
(26, 'CSPlayer4', 26, '126', 'Counter Strike 2', 'Supreme Master First Class', '', '', 10.00, '2024-07-14', 'Available'),
(27, 'CSPlayer5', 27, '127', 'Counter Strike 2', 'The Global Elite', '', '', 10.00, '2024-07-14', 'Available'),
(28, 'DotAPlayer1', 28, '128', 'Dota 2', 'Archon', '', '', 10.00, '2024-07-14', 'Available'),
(29, 'DotAPlayer2', 29, '129', 'Dota 2', 'Legend', '', '', 10.00, '2024-07-14', 'Available'),
(30, 'DotAPlayer3', 30, '130', 'Dota 2', 'Ancient', '', '', 10.00, '2024-07-14', 'Available'),
(31, 'DotAPlayer4', 31, '131', 'Dota 2', 'Divine', '', '', 10.00, '2024-07-14', 'Available'),
(32, 'ChessPlayer1', 32, '132', 'Chess', 'Expert/National Candidate Master', '', '', 10.00, '2024-07-14', 'Available'),
(33, 'ChessPlayer2', 33, '133', 'Chess', 'FIDE Candidate Master/National Master', '', '', 10.00, '2024-07-14', 'Available'),
(34, 'ChessPlayer3', 34, '134', 'Chess', 'FIDE Master', '', '', 10.00, '2024-07-14', 'Available'),
(35, 'ChessPlayer4', 35, '135', 'Chess', 'International Master', '', '', 10.00, '2024-07-14', 'Available'),
(36, 'ChessPlayer5', 36, '136', 'Chess', 'Grandmaster', '', '', 10.00, '2024-07-14', 'Available'),
(37, 'SiegePlayer1', 37, '137', 'Rainbow Six Siege', 'Gold', '', '', 10.00, '2024-07-14', 'Available'),
(38, 'SiegePlayer2', 38, '138', 'Rainbow Six Siege', 'Platinum', '', '', 10.00, '2024-07-14', 'Available'),
(39, 'SiegePlayer3', 39, '139', 'Rainbow Six Siege', 'Emerald', '', '', 10.00, '2024-07-14', 'Available'),
(40, 'SiegePlayer4', 40, '140', 'Rainbow Six Siege', 'Diamond', '', '', 10.00, '2024-07-14', 'Available'),
(41, 'SiegePlayer5', 41, '141', 'Rainbow Six Siege', 'Champion', '', '', 10.00, '2024-07-14', 'Available'),
(42, 'OverwatchPlayer1', 42, '142', 'Overwatch 2', 'Platinum', '', '', 10.00, '2024-07-14', 'Available'),
(43, 'OverwatchPlayer2', 43, '143', 'Overwatch 2', 'Diamond', '', '', 10.00, '2024-07-14', 'Available'),
(44, 'OverwatchPlayer3', 44, '144', 'Overwatch 2', 'Master', '', '', 10.00, '2024-07-14', 'Available'),
(45, 'OverwatchPlayer4', 45, '145', 'Overwatch 2', 'Grandmaster', '', '', 10.00, '2024-07-14', 'Available'),
(46, 'OverwatchPlayer5', 46, '146', 'Overwatch 2', 'Champion', '', '', 10.00, '2024-07-14', 'Available'),
(47, 'OverwatchPlayer6', 47, '147', 'Overwatch 2', 'Top 500', '', '', 10.00, '2024-07-14', 'Available'),
(48, 'TekkenPlayer1', 48, '148', 'Tekken 8', 'Garyu', '', '', 10.00, '2024-07-14', 'Available'),
(49, 'TekkenPlayer2', 49, '149', 'Tekken 8', 'Shinryu', '', '', 10.00, '2024-07-14', 'Available'),
(50, 'TekkenPlayer3', 50, '150', 'Tekken 8', 'Tenryu', '', '', 10.00, '2024-07-14', 'Available'),
(51, 'TekkenPlayer4', 51, '151', 'Tekken 8', 'Mighty Ruler', '', '', 10.00, '2024-07-14', 'Available'),
(52, 'TekkenPlayer5', 52, '152', 'Tekken 8', 'Flame Ruler', '', '', 10.00, '2024-07-14', 'Available'),
(53, 'TekkenPlayer6', 53, '153', 'Tekken 8', 'Battle Ruler', '', '', 10.00, '2024-07-14', 'Available'),
(54, 'TekkenPlayer7', 54, '154', 'Tekken 8', 'Fujin', '', '', 10.00, '2024-07-14', 'Available'),
(55, 'Valorantee', 1, '125612314', 'Valorant', 'Radiant', '', '', 10.00, '2024-07-14', 'Available'),
(56, 'Johnee', 1, '325125132', 'Overwatch 2', 'Master', '', '', 10.00, '2024-07-14', 'Available'),
(57, 'jOHNY', 1, '12412314', 'Rocket League', 'Supersonic Legend', '', '', 10.00, '2024-07-14', 'Available'),
(58, 'asdf123', 56, '132131', 'Fortnite', '', 'yeah.png', 'Prospectus.png', 10.01, '0000-00-00', 'Available'),
(59, 'examplerani', 56, '1251234', 'League of Legends', 'GrandMaster', 'im2.drawio (1).png', 'im2.drawio (2).png', 12.01, '0000-00-00', 'Available'),
(60, 'TryMyAim', 56, '321342432', 'Rainbow Six Siege', 'Emerald', 'number 3.png', 'Number2.png', 11.00, '0000-00-00', 'Available'),
(61, 'asdfasdf', 1, '123123123', 'Dota 2', 'Archon', 'Array', 'Array', 10.00, '2024-07-18', 'Pending'),
(62, 'Jonhyy', 1, '1231', 'Counter Strike 2', 'Master Guardian', 'Array', 'Array', 10.00, '2024-07-18', 'Available'),
(64, 'StriiNGSHii', 1, '212341234', 'Tekken 8', 'Tekken God', 'im2.drawio (2).png', '3NF.png', 101.00, '2024-07-20', 'Pending'),
(66, 'JohnnyASD', 1, '123121', 'Chess', 'International Master', 'im2.drawio (1).png', 'im2.drawio (2).png', 10.00, '2024-07-20', 'Available'),
(67, 'TryYing', 59, '123123123', 'Chess', 'FIDE Master', 'im2.drawio (2).png', 'Prospectus.png', 102.00, '2024-07-22', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `game_id` int(11) NOT NULL,
  `gameDescription` varchar(255) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `uploaded_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`game_id`, `gameDescription`, `image_path`, `uploaded_by`) VALUES
(1, 'League of Legends', 'resources/Main_Content/League of Legends.jpg', 1),
(2, 'Rocket League', 'resources/Main_Content/Rocket League.jpg', 1),
(3, 'Fortnite', 'resources/Main_Content/Fortnite.jpg', 1),
(4, 'Valorant', 'resources/Main_Content/Valorant.webp', 1),
(5, 'Counter Strike 2', 'resources/Main_Content/Counter Strike 2.jpeg', 1),
(6, 'Dota 2', 'resources/Main_Content/Dota 2.jpg', 1),
(7, 'Chess', 'resources/Main_Content/Chess.jpg', 1),
(8, 'Rainbow Six Siege', 'resources/Main_Content/R6.jpg', 1),
(9, 'Overwatch 2', 'resources/Main_Content/Overwatch 2.jpg', 1),
(10, 'Tekken 8', 'resources/Main_Content/Tekken 8.webp', 1);

-- --------------------------------------------------------

--
-- Table structure for table `game_info`
--

CREATE TABLE `game_info` (
  `gameinfoID` int(11) NOT NULL,
  `gameID` int(11) NOT NULL,
  `gameRank` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `game_info`
--

INSERT INTO `game_info` (`gameinfoID`, `gameID`, `gameRank`) VALUES
(1, 1, 'Iron'),
(2, 1, 'Bronze'),
(3, 1, 'Silver'),
(4, 1, 'Gold'),
(5, 1, 'Platinum'),
(6, 1, 'Diamond'),
(7, 1, 'Master'),
(8, 1, 'GrandMaster'),
(9, 1, 'Challenger'),
(10, 2, 'Bronze'),
(11, 2, 'Silver'),
(12, 2, 'Gold'),
(13, 2, 'Platinum'),
(14, 2, 'Diamond'),
(15, 2, 'Champion'),
(16, 2, 'Grand Champion'),
(17, 2, 'Supersonic Legend'),
(18, 3, 'Bronze'),
(19, 3, 'Silver'),
(20, 3, 'Gold'),
(21, 3, 'Platinum'),
(22, 3, 'Diamond'),
(23, 3, 'Elite'),
(24, 3, 'Champion'),
(25, 3, 'Unreal'),
(26, 4, 'Iron'),
(27, 4, 'Bronze'),
(28, 4, 'Silver'),
(29, 4, 'Gold'),
(30, 4, 'Platinum'),
(31, 4, 'Diamond'),
(32, 4, 'Ascendant'),
(33, 4, 'Immortal'),
(34, 4, 'Radiant'),
(35, 5, 'Silver'),
(36, 5, 'Silver Elite'),
(37, 5, 'Gold Nova'),
(38, 5, 'Master Guardian'),
(39, 5, 'Legendary Eagle'),
(40, 5, 'Supreme Master First Class'),
(41, 5, 'The Global Elite'),
(42, 6, 'Herald'),
(43, 6, 'Guardian'),
(44, 6, 'Crusader'),
(45, 6, 'Archon'),
(46, 6, 'Legend'),
(47, 6, 'Ancient'),
(48, 6, 'Divine'),
(49, 6, 'Immortal'),
(50, 7, 'Below 1000'),
(51, 7, 'Between 1000 and 1199'),
(52, 7, 'Between 1200 and 1399'),
(53, 7, 'Between 1400 and 1599'),
(54, 7, 'Between 1600 and 1799'),
(55, 7, 'Between 1800 and 1999'),
(56, 7, 'Expert/National Candidate Master'),
(57, 7, 'FIDE Candidate Master/National Master'),
(58, 7, 'FIDE Master'),
(59, 7, 'International Master'),
(60, 7, 'Grandmaster'),
(61, 8, 'Copper'),
(62, 8, 'Bronze'),
(63, 8, 'Silver'),
(64, 8, 'Gold'),
(65, 8, 'Platinum'),
(66, 8, 'Emerald'),
(67, 8, 'Diamond'),
(68, 8, 'Champion'),
(69, 9, 'Bronze'),
(70, 9, 'Silver'),
(71, 9, 'Gold'),
(72, 9, 'Platinum'),
(73, 9, 'Diamond'),
(74, 9, 'Master'),
(75, 9, 'Grandmaster'),
(76, 9, 'Champion'),
(77, 9, 'Top 500'),
(78, 10, 'Beginner'),
(79, 10, '1st Dan'),
(80, 10, '2nd Dan'),
(81, 10, 'Fighter'),
(82, 10, 'Strategist'),
(83, 10, 'Combatant'),
(84, 10, 'Brawler'),
(85, 10, 'Ranger'),
(86, 10, 'Cavalry'),
(87, 10, 'Warrior'),
(88, 10, 'Assailant'),
(89, 10, 'Dominator'),
(90, 10, 'Vanquisher'),
(91, 10, 'Destroyer'),
(92, 10, 'Eliminator'),
(93, 10, 'Garyu'),
(94, 10, 'Shinryu'),
(95, 10, 'Tenryu'),
(96, 10, 'Mighty Ruler'),
(97, 10, 'Flame Ruler'),
(98, 10, 'Battle Ruler'),
(99, 10, 'Fujin'),
(100, 10, 'Raijin'),
(101, 10, 'Kishin'),
(102, 10, 'Bushin'),
(103, 10, 'Tekken Emperor'),
(104, 10, 'Tekken God'),
(105, 10, 'Tekken God Supreme'),
(106, 10, 'God of Destruction');

-- --------------------------------------------------------

--
-- Table structure for table `moderator`
--

CREATE TABLE `moderator` (
  `moderator_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` int(11) NOT NULL,
  `gender` enum('Female','Male') NOT NULL,
  `birth_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `moderator`
--

INSERT INTO `moderator` (`moderator_id`, `fname`, `mname`, `lname`, `password`, `age`, `email`, `address`, `contact`, `gender`, `birth_date`) VALUES
(1, 'Nicezel', 'Marquez', 'Jamero', 'gameboosting123', 21, 'nicezel@boostingmail.com', 'Buenavista Homes Jugan', 2147483647, 'Male', '2002-10-21');

-- --------------------------------------------------------

--
-- Table structure for table `moderator_schedule`
--

CREATE TABLE `moderator_schedule` (
  `moderator_sched_id` int(11) NOT NULL,
  `moderator_id` int(11) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `moderator_schedule`
--

INSERT INTO `moderator_schedule` (`moderator_sched_id`, `moderator_id`, `start_time`, `end_time`) VALUES
(1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `client_player_id` int(11) DEFAULT NULL,
  `client_booster_id` int(11) DEFAULT NULL,
  `boosting_session_id` int(11) DEFAULT NULL,
  `hourly_rate` float DEFAULT NULL,
  `session_hours` float DEFAULT NULL,
  `total_amount` float DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `status` enum('paid','issued') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `client_player_id`, `client_booster_id`, `boosting_session_id`, `hourly_rate`, `session_hours`, `total_amount`, `payment_date`, `payment_method`, `status`) VALUES
(2, 2, 1, 1, 100, 3, 300, '0000-00-00 00:00:00', 'Gcash', 'paid'),
(3, 3, 1, 2, 250, 4, 1000, '0000-00-00 00:00:00', 'Paypal', 'paid'),
(4, 3, 2, 3, 400, 4, 1600, '0000-00-00 00:00:00', 'Alipay', 'issued');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boosting_session_report`
--
ALTER TABLE `boosting_session_report`
  ADD PRIMARY KEY (`boosting_session_rep_id`),
  ADD KEY `boosting_session_id` (`boosting_session_id`),
  ADD KEY `client_player_id` (`client_player_id`),
  ADD KEY `checkedby` (`checkedby`);

--
-- Indexes for table `boostsession`
--
ALTER TABLE `boostsession`
  ADD PRIMARY KEY (`boostSessionID`),
  ADD KEY `trainerID` (`traineeID`),
  ADD KEY `boosterID` (`boosterID`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_ID`);

--
-- Indexes for table `client_booster`
--
ALTER TABLE `client_booster`
  ADD PRIMARY KEY (`client_booster_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`game_id`),
  ADD KEY `fk_uploaded_by` (`uploaded_by`);

--
-- Indexes for table `game_info`
--
ALTER TABLE `game_info`
  ADD PRIMARY KEY (`gameinfoID`),
  ADD KEY `gameID` (`gameID`);

--
-- Indexes for table `moderator`
--
ALTER TABLE `moderator`
  ADD PRIMARY KEY (`moderator_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boostsession`
--
ALTER TABLE `boostsession`
  MODIFY `boostSessionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `client_booster`
--
ALTER TABLE `client_booster`
  MODIFY `client_booster_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `game_info`
--
ALTER TABLE `game_info`
  MODIFY `gameinfoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `moderator`
--
ALTER TABLE `moderator`
  MODIFY `moderator_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `boostsession`
--
ALTER TABLE `boostsession`
  ADD CONSTRAINT `boostsession_ibfk_1` FOREIGN KEY (`traineeID`) REFERENCES `client` (`client_ID`),
  ADD CONSTRAINT `boostsession_ibfk_2` FOREIGN KEY (`boosterID`) REFERENCES `client_booster` (`client_booster_id`);

--
-- Constraints for table `client_booster`
--
ALTER TABLE `client_booster`
  ADD CONSTRAINT `client_booster_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_ID`);

--
-- Constraints for table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `fk_uploaded_by` FOREIGN KEY (`uploaded_by`) REFERENCES `moderator` (`moderator_id`);

--
-- Constraints for table `game_info`
--
ALTER TABLE `game_info`
  ADD CONSTRAINT `game_info_ibfk_1` FOREIGN KEY (`gameID`) REFERENCES `game` (`game_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
