-- --------------------------------------------------------
-- Host:                         localhost
-- Wersja serwera:               8.0.30 - MySQL Community Server - GPL
-- Serwer OS:                    Win64
-- HeidiSQL Wersja:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Zrzut struktury tabela customfram.building
CREATE TABLE IF NOT EXISTS `building` (
  `id` int DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `street` varchar(50) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `number` varchar(50) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `postCode` varchar(50) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `image` varchar(50) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `latitude` varchar(50) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `longitude` varchar(50) COLLATE utf8mb4_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- Zrzucanie danych dla tabeli customfram.building: ~0 rows (około)
INSERT INTO `building` (`id`, `name`, `street`, `number`, `postCode`, `city`, `image`, `latitude`, `longitude`) VALUES
	(1, 'WI 1', 'Żołnierska', '49', '71-210', 'Szczecin', NULL, '53.4471762365999', '14.49207887002395'),
	(2, 'WI 2', 'Żołnierska', '52', '71-210', 'Szczecin', NULL, '53.44851316782248', '14.491211086588159');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
