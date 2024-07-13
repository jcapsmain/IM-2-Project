-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2024 at 07:27 PM
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
-- Table structure for table `boosting_session`
--

CREATE TABLE `boosting_session` (
  `boosting_session_id` int(11) NOT NULL,
  `client_player_id` int(11) DEFAULT NULL,
  `client_booster_id` int(11) DEFAULT NULL,
  `game` varchar(50) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `duration` float DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `feedback` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `boosting_session`
--

INSERT INTO `boosting_session` (`boosting_session_id`, `client_player_id`, `client_booster_id`, `game`, `start_time`, `end_time`, `duration`, `rating`, `feedback`) VALUES
(1, 2, 1, 'Rocket League', '2024-06-11 14:00:00', '2024-06-11 19:00:00', 5, 3.5, 'Excellent Effort'),
(2, 3, 1, 'League of Legend', '2024-04-30 15:00:00', '2024-04-30 20:00:00', 5, 4.2, 'Communicative'),
(3, 3, 2, 'Dota', '2024-05-26 16:00:00', '2024-05-26 21:00:00', 5, 5, 'Positive Attitude');

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
  `region` enum('North America','South America','Europe','Asia','Oceania','Antartica','Africa') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_ID`, `username`, `fname`, `lname`, `password`, `phoneNumber`, `email`, `dateofbirth`, `region`) VALUES
(1, 'johnCapoy123', 'Jonh', 'Capoy', '202cb962ac59075b964b07152d234b70', '9823423421', 'johncapoy@gmail.com', '1999-05-03', 'Africa'),
(2, 'skibidi', 'Skib', 'Idi', '202cb962ac59075b964b07152d234b70', '0923421241', 'skibidi@mail.com', '2015-10-26', 'Asia'),
(3, 'user', 'user', 'user', '202cb962ac59075b964b07152d234b70', '3251551', 'user@mail.com', '2002-07-18', 'Asia'),
(4, 'user1', 'John', 'Smith', 'pass1', '123-456-7890', 'user1@example.com', '1990-01-01', 'North America'),
(5, 'user2', 'Emily', 'Johnson', 'pass2', '234-567-8901', 'user2@example.com', '1991-02-02', 'South America'),
(6, 'user3', 'Michael', 'Williams', 'pass3', '345-678-9012', 'user3@example.com', '1992-03-03', 'Europe'),
(7, 'user4', 'Jessica', 'Jones', 'pass4', '456-789-0123', 'user4@example.com', '1993-04-04', 'Asia'),
(8, 'user5', 'Daniel', 'Brown', 'pass5', '567-890-1234', 'user5@example.com', '1994-05-05', 'Oceania'),
(9, 'user6', 'Sarah', 'Miller', 'pass6', '678-901-2345', 'user6@example.com', '1995-06-06', 'Antartica'),
(10, 'user7', 'David', 'Davis', 'pass7', '789-012-3456', 'user7@example.com', '1996-07-07', 'Africa'),
(11, 'user8', 'Lisa', 'Martinez', 'pass8', '890-123-4567', 'user8@example.com', '1997-08-08', 'North America'),
(12, 'user9', 'Kevin', 'Garcia', 'pass9', '901-234-5678', 'user9@example.com', '1998-09-09', 'South America'),
(13, 'user10', 'Rachel', 'Rodriguez', 'pass10', '012-345-6789', 'user10@example.com', '1999-10-10', 'Europe'),
(14, 'user11', 'Andrew', 'Lopez', 'pass11', '987-654-3210', 'user11@example.com', '1980-11-11', 'Asia'),
(15, 'user12', 'Jessica', 'Wilson', 'pass12', '876-543-2109', 'user12@example.com', '1981-12-12', 'Oceania'),
(16, 'user13', 'Matthew', 'Gonzalez', 'pass13', '765-432-1098', 'user13@example.com', '1982-01-13', 'Antartica'),
(17, 'user14', 'Amanda', 'Perez', 'pass14', '654-321-0987', 'user14@example.com', '1983-02-14', 'Africa'),
(18, 'user15', 'Christopher', 'Robinson', 'pass15', '543-210-9876', 'user15@example.com', '1984-03-15', 'North America'),
(19, 'user16', 'Ashley', 'Hernandez', 'pass16', '432-109-8765', 'user16@example.com', '1985-04-16', 'South America'),
(20, 'user17', 'Justin', 'Moore', 'pass17', '321-098-7654', 'user17@example.com', '1986-05-17', 'Europe'),
(21, 'user18', 'Stephanie', 'Young', 'pass18', '210-987-6543', 'user18@example.com', '1987-06-18', 'Asia'),
(22, 'user19', 'Ryan', 'King', 'pass19', '109-876-5432', 'user19@example.com', '1988-07-19', 'Oceania'),
(23, 'user20', 'Brittany', 'Scott', 'pass20', '098-765-4321', 'user20@example.com', '1989-08-20', 'Antartica'),
(24, 'user21', 'Jonathan', 'Nguyen', 'pass21', '987-654-3210', 'user21@example.com', '1970-09-21', 'Africa'),
(25, 'user22', 'Nicole', 'Hill', 'pass22', '876-543-2109', 'user22@example.com', '1971-10-22', 'North America'),
(26, 'user23', 'Brandon', 'Flores', 'pass23', '765-432-1098', 'user23@example.com', '1972-11-23', 'South America'),
(27, 'user24', 'Melissa', 'Green', 'pass24', '654-321-0987', 'user24@example.com', '1973-12-24', 'Europe'),
(28, 'user25', 'Victoria', 'Adams', 'pass25', '543-210-9876', 'user25@example.com', '1974-01-25', 'Asia'),
(29, 'user26', 'Eric', 'Baker', 'pass26', '432-109-8765', 'user26@example.com', '1975-02-26', 'Oceania'),
(30, 'user27', 'Samantha', 'Nelson', 'pass27', '321-098-7654', 'user27@example.com', '1976-03-27', 'Antartica'),
(31, 'user28', 'Alex', 'Carter', 'pass28', '210-987-6543', 'user28@example.com', '1977-04-28', 'Africa'),
(32, 'user29', 'Joshua', 'Mitchell', 'pass29', '109-876-5432', 'user29@example.com', '1978-05-29', 'North America'),
(33, 'user30', 'Michelle', 'Perez', 'pass30', '098-765-4321', 'user30@example.com', '1979-06-30', 'South America'),
(34, 'user31', 'Daniel', 'Harris', 'pass31', '987-654-3210', 'user31@example.com', '1960-07-31', 'Europe'),
(35, 'user32', 'Kimberly', 'Gonzales', 'pass32', '876-543-2109', 'user32@example.com', '1961-08-01', 'Asia'),
(36, 'user33', 'Tyler', 'Cook', 'pass33', '765-432-1098', 'user33@example.com', '1962-09-02', 'Oceania'),
(37, 'user34', 'Katherine', 'Bailey', 'pass34', '654-321-0987', 'user34@example.com', '1963-10-03', 'Antartica'),
(38, 'user35', 'Austin', 'Rivera', 'pass35', '543-210-9876', 'user35@example.com', '1964-11-04', 'Africa'),
(39, 'user36', 'Megan', 'Cooper', 'pass36', '432-109-8765', 'user36@example.com', '1965-12-05', 'North America'),
(40, 'user37', 'Benjamin', 'Richardson', 'pass37', '321-098-7654', 'user37@example.com', '1966-01-06', 'South America'),
(41, 'user38', 'Laura', 'Torres', 'pass38', '210-987-6543', 'user38@example.com', '1967-02-07', 'Europe'),
(42, 'user39', 'Gabriel', 'Morris', 'pass39', '109-876-5432', 'user39@example.com', '1968-03-08', 'Asia'),
(43, 'user40', 'Alyssa', 'Ward', 'pass40', '098-765-4321', 'user40@example.com', '1969-04-09', 'Oceania'),
(44, 'user41', 'Zachary', 'James', 'pass41', '987-654-3210', 'user41@example.com', '1950-05-10', 'Antartica'),
(45, 'user42', 'Julia', 'Watson', 'pass42', '876-543-2109', 'user42@example.com', '1951-06-11', 'Africa'),
(46, 'user43', 'Kyle', 'Brooks', 'pass43', '765-432-1098', 'user43@example.com', '1952-07-12', 'North America'),
(47, 'user44', 'Hannah', 'Sanders', 'pass44', '654-321-0987', 'user44@example.com', '1953-08-13', 'South America'),
(48, 'user45', 'Jacob', 'Bennett', 'pass45', '543-210-9876', 'user45@example.com', '1954-09-14', 'Europe'),
(49, 'user46', 'Olivia', 'Perry', 'pass46', '432-109-8765', 'user46@example.com', '1955-10-15', 'Asia'),
(50, 'user47', 'Nathan', 'Long', 'pass47', '321-098-7654', 'user47@example.com', '1956-11-16', 'Oceania'),
(51, 'user48', 'Emma', 'Reed', 'pass48', '210-987-6543', 'user48@example.com', '1957-12-17', 'Antartica'),
(52, 'user49', 'Alexander', 'Kim', 'pass49', '109-876-5432', 'user49@example.com', '1958-01-18', 'Africa'),
(53, 'user50', 'Madison', 'Evans', 'pass50', '098-765-4321', 'user50@example.com', '1959-02-19', 'North America'),
(54, 'Johnn', 'Cpooyy', 'SADAW', '202cb962ac59075b964b07152d234b70', '98234281234', 'john@mail.com', '2005-08-29', 'Asia'),
(55, 'Jaczyo', 'Kiwoi', 'JAXWRer', '202cb962ac59075b964b07152d234b70', '09783327242', 'jawx@gmail.com', '1997-10-26', 'Oceania'),
(56, 'example', 'exam', 'ple', '202cb962ac59075b964b07152d234b70', '213512322', 'example@mail.com', '2003-10-29', 'Europe');

-- --------------------------------------------------------

--
-- Table structure for table `client_booster`
--

CREATE TABLE `client_booster` (
  `client_booster_id` int(11) NOT NULL,
  `IGN` varchar(255) NOT NULL,
  `client_id` int(11) NOT NULL,
  `coach_uid` int(11) NOT NULL,
  `game` varchar(255) NOT NULL,
  `gamerank` varchar(255) NOT NULL,
  `game_uid_screenshot` varchar(255) NOT NULL,
  `game_rank_screenshot` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `upload_Date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_booster`
--

INSERT INTO `client_booster` (`client_booster_id`, `IGN`, `client_id`, `coach_uid`, `game`, `gamerank`, `game_uid_screenshot`, `game_rank_screenshot`, `price`, `upload_Date`) VALUES
(1, 'Summoner1', 1, 101, 'League of Legends', 'Gold', '', '', 0.00, '2024-07-14'),
(2, 'Summoner2', 2, 102, 'League of Legends', 'Platinum', '', '', 0.00, '2024-07-14'),
(3, 'Summoner3', 3, 103, 'League of Legends', 'Diamond', '', '', 0.00, '2024-07-14'),
(4, 'Summoner4', 4, 104, 'League of Legends', 'Master', '', '', 0.00, '2024-07-14'),
(5, 'Summoner5', 5, 105, 'League of Legends', 'GrandMaster', '', '', 0.00, '2024-07-14'),
(6, 'Summoner6', 6, 106, 'League of Legends', 'Challenger', '', '', 0.00, '2024-07-14'),
(7, 'Rocketeer1', 7, 107, 'Rocket League', 'Platinum', '', '', 0.00, '2024-07-14'),
(8, 'Rocketeer2', 8, 108, 'Rocket League', 'Diamond', '', '', 0.00, '2024-07-14'),
(9, 'Rocketeer3', 9, 109, 'Rocket League', 'Champion', '', '', 0.00, '2024-07-14'),
(10, 'Rocketeer4', 10, 110, 'Rocket League', 'Grand Champion', '', '', 0.00, '2024-07-14'),
(11, 'Rocketeer5', 11, 111, 'Rocket League', 'Supersonic Legend', '', '', 0.00, '2024-07-14'),
(12, 'FortnitePlayer1', 12, 112, 'Fortnite', 'Platinum', '', '', 0.00, '2024-07-14'),
(13, 'FortnitePlayer2', 13, 113, 'Fortnite', 'Diamond', '', '', 0.00, '2024-07-14'),
(14, 'FortnitePlayer3', 14, 114, 'Fortnite', 'Elite', '', '', 0.00, '2024-07-14'),
(15, 'FortnitePlayer4', 15, 115, 'Fortnite', 'Champion', '', '', 0.00, '2024-07-14'),
(16, 'FortnitePlayer5', 16, 116, 'Fortnite', 'Unreal', '', '', 0.00, '2024-07-14'),
(17, 'ValorantAgent1', 17, 117, 'Valorant', 'Gold', '', '', 0.00, '2024-07-14'),
(18, 'ValorantAgent2', 18, 118, 'Valorant', 'Platinum', '', '', 0.00, '2024-07-14'),
(19, 'ValorantAgent3', 19, 119, 'Valorant', 'Diamond', '', '', 0.00, '2024-07-14'),
(20, 'ValorantAgent4', 20, 120, 'Valorant', 'Ascendant', '', '', 0.00, '2024-07-14'),
(21, 'ValorantAgent5', 21, 121, 'Valorant', 'Immortal', '', '', 0.00, '2024-07-14'),
(22, 'ValorantAgent6', 22, 122, 'Valorant', 'Radiant', '', '', 0.00, '2024-07-14'),
(23, 'CSPlayer1', 23, 123, 'Counter Strike 2', 'Gold Nova', '', '', 0.00, '2024-07-14'),
(24, 'CSPlayer2', 24, 124, 'Counter Strike 2', 'Master Guardian', '', '', 0.00, '2024-07-14'),
(25, 'CSPlayer3', 25, 125, 'Counter Strike 2', 'Legendary Eagle', '', '', 0.00, '2024-07-14'),
(26, 'CSPlayer4', 26, 126, 'Counter Strike 2', 'Supreme Master First Class', '', '', 0.00, '2024-07-14'),
(27, 'CSPlayer5', 27, 127, 'Counter Strike 2', 'The Global Elite', '', '', 0.00, '2024-07-14'),
(28, 'DotAPlayer1', 28, 128, 'Dota 2', 'Archon', '', '', 0.00, '2024-07-14'),
(29, 'DotAPlayer2', 29, 129, 'Dota 2', 'Legend', '', '', 0.00, '2024-07-14'),
(30, 'DotAPlayer3', 30, 130, 'Dota 2', 'Ancient', '', '', 0.00, '2024-07-14'),
(31, 'DotAPlayer4', 31, 131, 'Dota 2', 'Divine', '', '', 0.00, '2024-07-14'),
(32, 'ChessPlayer1', 32, 132, 'Chess', 'Expert/National Candidate Master', '', '', 0.00, '2024-07-14'),
(33, 'ChessPlayer2', 33, 133, 'Chess', 'FIDE Candidate Master/National Master', '', '', 0.00, '2024-07-14'),
(34, 'ChessPlayer3', 34, 134, 'Chess', 'FIDE Master', '', '', 0.00, '2024-07-14'),
(35, 'ChessPlayer4', 35, 135, 'Chess', 'International Master', '', '', 0.00, '2024-07-14'),
(36, 'ChessPlayer5', 36, 136, 'Chess', 'Grandmaster', '', '', 0.00, '2024-07-14'),
(37, 'SiegePlayer1', 37, 137, 'Rainbow Six Siege', 'Gold', '', '', 0.00, '2024-07-14'),
(38, 'SiegePlayer2', 38, 138, 'Rainbow Six Siege', 'Platinum', '', '', 0.00, '2024-07-14'),
(39, 'SiegePlayer3', 39, 139, 'Rainbow Six Siege', 'Emerald', '', '', 0.00, '2024-07-14'),
(40, 'SiegePlayer4', 40, 140, 'Rainbow Six Siege', 'Diamond', '', '', 0.00, '2024-07-14'),
(41, 'SiegePlayer5', 41, 141, 'Rainbow Six Siege', 'Champion', '', '', 0.00, '2024-07-14'),
(42, 'OverwatchPlayer1', 42, 142, 'Overwatch 2', 'Platinum', '', '', 0.00, '2024-07-14'),
(43, 'OverwatchPlayer2', 43, 143, 'Overwatch 2', 'Diamond', '', '', 0.00, '2024-07-14'),
(44, 'OverwatchPlayer3', 44, 144, 'Overwatch 2', 'Master', '', '', 0.00, '2024-07-14'),
(45, 'OverwatchPlayer4', 45, 145, 'Overwatch 2', 'Grandmaster', '', '', 0.00, '2024-07-14'),
(46, 'OverwatchPlayer5', 46, 146, 'Overwatch 2', 'Champion', '', '', 0.00, '2024-07-14'),
(47, 'OverwatchPlayer6', 47, 147, 'Overwatch 2', 'Top 500', '', '', 0.00, '2024-07-14'),
(48, 'TekkenPlayer1', 48, 148, 'Tekken 8', 'Garyu', '', '', 0.00, '2024-07-14'),
(49, 'TekkenPlayer2', 49, 149, 'Tekken 8', 'Shinryu', '', '', 0.00, '2024-07-14'),
(50, 'TekkenPlayer3', 50, 150, 'Tekken 8', 'Tenryu', '', '', 0.00, '2024-07-14'),
(51, 'TekkenPlayer4', 51, 151, 'Tekken 8', 'Mighty Ruler', '', '', 0.00, '2024-07-14'),
(52, 'TekkenPlayer5', 52, 152, 'Tekken 8', 'Flame Ruler', '', '', 0.00, '2024-07-14'),
(53, 'TekkenPlayer6', 53, 153, 'Tekken 8', 'Battle Ruler', '', '', 0.00, '2024-07-14'),
(54, 'TekkenPlayer7', 54, 154, 'Tekken 8', 'Fujin', '', '', 0.00, '2024-07-14'),
(55, 'Valorantee', 1, 125612314, 'Valorant', 'Radiant', '', '', 0.00, '2024-07-14'),
(56, 'Johnee', 1, 325125132, 'Overwatch 2', 'Master', '', '', 0.00, '2024-07-14'),
(57, 'jOHNY', 1, 12412314, 'Rocket League', 'Supersonic Legend', '', '', 0.00, '2024-07-14'),
(58, 'asdf123', 56, 132131, 'Fortnite', '', 'yeah.png', 'Prospectus.png', 10.01, '0000-00-00'),
(59, 'examplerani', 56, 1251234, 'League of Legends', 'GrandMaster', 'im2.drawio (1).png', 'im2.drawio (2).png', 12.01, '0000-00-00'),
(60, 'TryMyAim', 56, 321342432, 'Rainbow Six Siege', 'Emerald', 'number 3.png', 'Number2.png', 11.00, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `game_id` int(11) NOT NULL,
  `gameDescription` varchar(255) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`game_id`, `gameDescription`, `image_path`) VALUES
(1, 'League of Legends', 'resources/Main_Content/League of Legends.jpg'),
(2, 'Rocket League', 'resources/Main_Content/Rocket League.jpg'),
(3, 'Fortnite', 'resources/Main_Content/Fortnite.jpg'),
(4, 'Valorant', 'resources/Main_Content/Valorant.webp'),
(5, 'Counter Strike 2', 'resources/Main_Content/Counter Strike 2.jpeg'),
(6, 'Dota 2', 'resources/Main_Content/Dota 2.jpg'),
(7, 'Chess', 'resources/Main_Content/Chess.jpg'),
(8, 'Rainbow Six Siege', 'resources/Main_Content/R6.jpg'),
(9, 'Overwatch 2', 'resources/Main_Content/Overwatch 2.jpg'),
(10, 'Tekken 8', 'resources/Main_Content/Tekken 8.webp');

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
(1, 1, 'Gold'),
(2, 1, 'Platinum'),
(3, 1, 'Diamond'),
(4, 1, 'Master'),
(5, 1, 'GrandMaster'),
(6, 1, 'Challenger'),
(7, 2, 'Platinum'),
(8, 2, 'Diamond'),
(9, 2, 'Champion'),
(10, 2, 'Grand Champion'),
(11, 2, 'Supersonic Legend'),
(12, 3, 'Platinum'),
(13, 3, 'Diamond'),
(14, 3, 'Elite'),
(15, 3, 'Champion'),
(16, 3, 'Unreal'),
(17, 1, 'Gold'),
(18, 1, 'Platinum'),
(19, 1, 'Diamond'),
(20, 1, 'Master'),
(21, 1, 'GrandMaster'),
(22, 1, 'Challenger'),
(23, 2, 'Platinum'),
(24, 2, 'Diamond'),
(25, 2, 'Champion'),
(26, 2, 'Grand Champion'),
(27, 2, 'Supersonic Legend'),
(28, 3, 'Platinum'),
(29, 3, 'Diamond'),
(30, 3, 'Elite'),
(31, 3, 'Champion'),
(32, 3, 'Unreal'),
(33, 1, 'Gold'),
(34, 1, 'Platinum'),
(35, 1, 'Diamond'),
(36, 1, 'Master'),
(37, 1, 'GrandMaster'),
(38, 1, 'Challenger'),
(39, 2, 'Platinum'),
(40, 2, 'Diamond'),
(41, 2, 'Champion'),
(42, 2, 'Grand Champion'),
(43, 2, 'Supersonic Legend'),
(44, 3, 'Platinum'),
(45, 3, 'Diamond'),
(46, 3, 'Elite'),
(47, 3, 'Champion'),
(48, 3, 'Unreal'),
(49, 1, 'Gold'),
(50, 1, 'Platinum'),
(51, 1, 'Diamond'),
(52, 1, 'Master'),
(53, 1, 'GrandMaster'),
(54, 1, 'Challenger'),
(55, 2, 'Platinum'),
(56, 2, 'Diamond'),
(57, 2, 'Champion'),
(58, 2, 'Grand Champion'),
(59, 2, 'Supersonic Legend'),
(60, 3, 'Platinum'),
(61, 3, 'Diamond'),
(62, 3, 'Elite'),
(63, 3, 'Champion'),
(64, 3, 'Unreal'),
(65, 4, 'Gold'),
(66, 4, 'Platinum'),
(67, 4, 'Diamond'),
(68, 4, 'Ascendant'),
(69, 4, 'Immortal'),
(70, 4, 'Radiant'),
(71, 5, 'Gold Nova'),
(72, 5, 'Master Guardian'),
(73, 5, 'Legendary Eagle'),
(74, 5, 'Supreme Master First Class'),
(75, 5, 'The Global Elite'),
(76, 6, 'Archon'),
(77, 6, 'Legend'),
(78, 6, 'Ancient'),
(79, 6, 'Divine'),
(80, 7, 'Expert/National Candidate Master'),
(81, 7, 'FIDE Candidate Master/National Master'),
(82, 7, 'FIDE Master'),
(83, 7, 'International Master'),
(84, 7, 'Grandmaster'),
(85, 8, 'Gold'),
(86, 8, 'Platinum'),
(87, 8, 'Emerald'),
(88, 8, 'Diamond'),
(89, 8, 'Champion'),
(90, 9, 'Platinum'),
(91, 9, 'Diamond'),
(92, 9, 'Master'),
(93, 9, 'Grandmaster'),
(94, 9, 'Champion'),
(95, 9, 'Top 500'),
(96, 10, 'Garyu'),
(97, 10, 'Shinryu'),
(98, 10, 'Tenryu'),
(99, 10, 'Mighty Ruler'),
(100, 10, 'Flame Ruler'),
(101, 10, 'Battle Ruler'),
(102, 10, 'Fujin'),
(103, 10, 'Raijin'),
(104, 10, 'Kishin'),
(105, 10, 'Bushin'),
(106, 10, 'Tekken Emperor'),
(107, 10, 'Tekken God'),
(108, 10, 'Tekken God Supreme'),
(109, 10, 'God of Destruction');

-- --------------------------------------------------------

--
-- Table structure for table `moderator`
--

CREATE TABLE `moderator` (
  `moderator_id` int(11) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `mname` char(1) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `email` varchar(75) DEFAULT NULL,
  `address` varchar(75) DEFAULT NULL,
  `contact` int(11) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `birth_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `moderator`
--

INSERT INTO `moderator` (`moderator_id`, `fname`, `mname`, `lname`, `password`, `age`, `email`, `address`, `contact`, `gender`, `birth_date`) VALUES
(1, 'Ann', 'S', 'France', '*****', 21, 'annsi@gmail.com', 'Street 23', 2147483647, 'Female', '0000-00-00'),
(2, 'Rei', 'D', 'Wei', '*****', 15, 'datwey@gmail.com', 'Street 96', 2147483647, 'Male', '0000-00-00'),
(3, 'Jan', 'D', 'Cruz', '*****', 19, 'diswey@gmail.com', 'Street 101', 1365413255, 'Male', '0000-00-00');

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
-- Indexes for table `boosting_session`
--
ALTER TABLE `boosting_session`
  ADD PRIMARY KEY (`boosting_session_id`),
  ADD KEY `client_player_id` (`client_player_id`),
  ADD KEY `client_booster_id` (`client_booster_id`);

--
-- Indexes for table `boosting_session_report`
--
ALTER TABLE `boosting_session_report`
  ADD PRIMARY KEY (`boosting_session_rep_id`),
  ADD KEY `boosting_session_id` (`boosting_session_id`),
  ADD KEY `client_player_id` (`client_player_id`),
  ADD KEY `checkedby` (`checkedby`);

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
  ADD PRIMARY KEY (`game_id`);

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
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `client_booster`
--
ALTER TABLE `client_booster`
  MODIFY `client_booster_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `game_info`
--
ALTER TABLE `game_info`
  MODIFY `gameinfoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client_booster`
--
ALTER TABLE `client_booster`
  ADD CONSTRAINT `client_booster_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_ID`);

--
-- Constraints for table `game_info`
--
ALTER TABLE `game_info`
  ADD CONSTRAINT `game_info_ibfk_1` FOREIGN KEY (`gameID`) REFERENCES `game` (`game_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
