-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table vet_database.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table vet_database.admin: ~1 rows (approximately)
INSERT INTO `admin` (`id`, `email`, `password`) VALUES
	(1, 'vetpassadmin@gmail.com', 'admin');

-- Dumping structure for table vet_database.animal_types
CREATE TABLE IF NOT EXISTS `animal_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table vet_database.animal_types: ~0 rows (approximately)

-- Dumping structure for table vet_database.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `owner_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `owner_surname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `animal_type` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table vet_database.customers: ~3 rows (approximately)
INSERT INTO `customers` (`id`, `owner_name`, `owner_surname`, `animal_type`, `phone_number`, `password`, `email`) VALUES
	(6, 'Owner', 'Own', 'Hamster', '00029953', 'owner', 'owner@gmail.com'),
	(7, 'customer', 'custom', 'Cat', '22009455', 'customer', 'customer@gmail.com'),
	(8, 'Marta', 'Bērziņa', 'Cat', '20000000', 'marta123', 'marta@gmail.com');

-- Dumping structure for table vet_database.doctors
CREATE TABLE IF NOT EXISTS `doctors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `certificate_number` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `request_status` enum('pending','accepted','rejected') COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table vet_database.doctors: ~3 rows (approximately)
INSERT INTO `doctors` (`id`, `username`, `first_name`, `last_name`, `certificate_number`, `email`, `phone_number`, `request_status`, `password`) VALUES
	(28, 'Doctor', 'Saap', 'Sel', '2200953', 'doctor@gmail.com', '2353467', 'accepted', 'doctor'),
	(29, 'anna_123', 'Anna', 'Lapiņa', '12344566', 'anna.lapina@gmail.com', '20000000', 'accepted', 'annalapina'),
	(30, 'roberts_345', 'Roberts', 'Liesmiņš', '237421', 'roberts@gmail.com', '20000000', 'accepted', 'roberts');

-- Dumping structure for table vet_database.doctors_accepted
CREATE TABLE IF NOT EXISTS `doctors_accepted` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `certificate_number` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `profile_photo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table vet_database.doctors_accepted: ~2 rows (approximately)
INSERT INTO `doctors_accepted` (`id`, `username`, `first_name`, `last_name`, `certificate_number`, `email`, `profile_photo`, `phone_number`, `password`) VALUES
	(30, 'Doctor', 'Saap', 'Sel', '2200953', 'doctor@gmail.com', NULL, '2353467', 'doctor'),
	(31, 'roberts_345', 'Roberts', 'Liesmiņš', '237421', 'roberts@gmail.com', NULL, '20000000', 'roberts');

-- Dumping structure for table vet_database.locations
CREATE TABLE IF NOT EXISTS `locations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `location_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table vet_database.locations: ~0 rows (approximately)

-- Dumping structure for table vet_database.visits_accepted
CREATE TABLE IF NOT EXISTS `visits_accepted` (
  `id` int NOT NULL AUTO_INCREMENT,
  `visit_request_id` int DEFAULT NULL,
  `doctor_id` int DEFAULT NULL,
  `customer_id` int DEFAULT NULL,
  `animal_problem` text COLLATE utf8mb4_general_ci,
  `status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `visit_request_id` (`visit_request_id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `visits_accepted_ibfk_1` FOREIGN KEY (`visit_request_id`) REFERENCES `visit_requests` (`id`),
  CONSTRAINT `visits_accepted_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors_accepted` (`id`),
  CONSTRAINT `visits_accepted_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `visits_accepted` (`id`, `visit_request_id`, `doctor_id`, `customer_id`, `animal_problem`, `status`, `created_at`) VALUES
	(10, 32, 30, 6, 'I want a visit', 'accepted', '2024-05-30 13:52:11'),
	(11, 33, 30, 7, 'I want my dog to be cut open\r\n', 'accepted', '2024-05-30 19:40:16');


CREATE TABLE IF NOT EXISTS `visit_requests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int DEFAULT NULL,
  `doctor_id` int DEFAULT NULL,
  `request_text` text COLLATE utf8mb4_general_ci,
  `status` enum('pending','accepted','denied') COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `visit_requests_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table vet_database.visit_requests: ~3 rows (approximately)
INSERT INTO `visit_requests` (`id`, `customer_id`, `doctor_id`, `request_text`, `status`, `created_at`) VALUES
	(32, 6, 30, 'I want a visit', 'accepted', '2024-05-30 13:51:12'),
	(33, 7, 30, 'I want my dog to be cut open\r\n', 'accepted', '2024-05-30 13:53:19'),
	(34, 8, 30, 'sap kājas', 'pending', '2024-05-30 19:43:20');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
