-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.5.0.5332
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for leaderboard
CREATE DATABASE IF NOT EXISTS `leaderboard` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `leaderboard`;

-- Dumping structure for table leaderboard.submissions
CREATE TABLE IF NOT EXISTS `submissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `url` varchar(225) NOT NULL,
  `comments` text,
  `points` int(11) NOT NULL DEFAULT '0',
  `sub_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table leaderboard.submissions: ~2 rows (approximately)
/*!40000 ALTER TABLE `submissions` DISABLE KEYS */;
INSERT INTO `submissions` (`id`, `user`, `url`, `comments`, `points`, `sub_date`) VALUES
	(1, 'janedoe@gmail.com', 'http://localhost/leaderboard/dashboard/user/submit.php', 'Testing', 30, '2020-03-24'),
	(6, 'johndoe@gmail.com', 'https://www.php.net/manual/en/function.date.php', 'Testing3', 15, '2020-03-24');
/*!40000 ALTER TABLE `submissions` ENABLE KEYS */;

-- Dumping structure for table leaderboard.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(7) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `track` varchar(20) NOT NULL,
  `score` int(11) NOT NULL DEFAULT '0',
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table leaderboard.user: ~3 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `user_id`, `nickname`, `email`, `password`, `phone`, `track`, `score`, `isAdmin`) VALUES
	(1, '701b5e', 'Jdoe', 'janedoe@gmail.com', '11111', '+2348153637373', '', 30, 0),
	(2, '89e898', 'John', 'johndoe@gmail.com', '12345', '08045133425', '1', 15, 0),
	(3, 'admin', 'admin', 'admin@gmail.com', 'admin', '09085735462', '0', 0, 1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
