-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.1.72-community - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for customfram
CREATE DATABASE IF NOT EXISTS `customfram` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci */;
USE `customfram`;

-- Dumping structure for table customfram.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table customfram.admin: 0 rows
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table customfram.building
CREATE TABLE IF NOT EXISTS `building` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `street` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `number` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `postCode` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `image` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `latitude` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `longitude` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table customfram.building: ~2 rows (approximately)
/*!40000 ALTER TABLE `building` DISABLE KEYS */;
INSERT INTO `building` (`id`, `name`, `street`, `number`, `postCode`, `city`, `image`, `latitude`, `longitude`) VALUES
	(1, 'WI 1', 'Żołnierska', '49', '71-210', 'Szczecin', NULL, '53.4471762365999', '14.49207887002395'),
	(2, 'WI 2', 'Żołnierska', '52', '71-210', 'Szczecin', NULL, '53.44851316782248', '14.491211086588159');
/*!40000 ALTER TABLE `building` ENABLE KEYS */;

-- Dumping structure for table customfram.lesson
CREATE TABLE IF NOT EXISTS `lesson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `id_worker` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_lesson_worker` (`id_worker`),
  CONSTRAINT `FK_lesson_worker` FOREIGN KEY (`id_worker`) REFERENCES `worker` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table customfram.lesson: ~0 rows (approximately)
/*!40000 ALTER TABLE `lesson` DISABLE KEYS */;
/*!40000 ALTER TABLE `lesson` ENABLE KEYS */;

-- Dumping structure for table customfram.room
CREATE TABLE IF NOT EXISTS `room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) DEFAULT NULL,
  `id_building` int(11) DEFAULT NULL,
  `floor` int(11) DEFAULT NULL,
  `type` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_room_building` (`id_building`),
  CONSTRAINT `FK_room_building` FOREIGN KEY (`id_building`) REFERENCES `building` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table customfram.room: ~0 rows (approximately)
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
/*!40000 ALTER TABLE `room` ENABLE KEYS */;

-- Dumping structure for table customfram.schedule
CREATE TABLE IF NOT EXISTS `schedule` (
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `id_room` int(11) DEFAULT NULL,
  `id_lesson` int(11) DEFAULT NULL,
  KEY `FK__room` (`id_room`),
  KEY `FK_schedule_lesson` (`id_lesson`),
  CONSTRAINT `FK_schedule_lesson` FOREIGN KEY (`id_lesson`) REFERENCES `lesson` (`id`),
  CONSTRAINT `FK__room` FOREIGN KEY (`id_room`) REFERENCES `room` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table customfram.schedule: ~0 rows (approximately)
/*!40000 ALTER TABLE `schedule` DISABLE KEYS */;
/*!40000 ALTER TABLE `schedule` ENABLE KEYS */;

-- Dumping structure for table customfram.student
CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `lastName` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `login` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table customfram.student: ~0 rows (approximately)
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
/*!40000 ALTER TABLE `student` ENABLE KEYS */;

-- Dumping structure for table customfram.worker
CREATE TABLE IF NOT EXISTS `worker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `lastName` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `title` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `login` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `id_room` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_room` (`id_room`),
  CONSTRAINT `worker_ibfk_1` FOREIGN KEY (`id_room`) REFERENCES `room` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table customfram.worker: ~0 rows (approximately)
/*!40000 ALTER TABLE `worker` DISABLE KEYS */;
/*!40000 ALTER TABLE `worker` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
