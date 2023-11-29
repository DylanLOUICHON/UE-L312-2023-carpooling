-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.36 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour carpooling
CREATE DATABASE IF NOT EXISTS `carpooling` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `carpooling`;

-- Listage de la structure de la table carpooling. annonces
CREATE TABLE IF NOT EXISTS `annonces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` int(20) NOT NULL,
  `startPlace` varchar(255) NOT NULL,
  `endPlace` varchar(255) NOT NULL,
  `dateBegining` datetime NOT NULL,
  `smoking` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Listage des données de la table carpooling.annonces : ~2 rows (environ)
INSERT INTO `annonces` (`id`, `price`, `startPlace`, `endPlace`, `dateBegining`, `smoking`) VALUES
	(1, 50, 'Rouen, 13 avenue de Bretagne', 'Lyon, Grande Rue de la Croix Rousse', '2023-12-10 00:00:00', 1),
	(2, 10, 'Rennes, Rue Abbe Henri Gregoire', 'Nantes, 21 Avenue des Bergeronnettes', '2023-12-21 00:00:00', 0),
	(3, 30, 'Perpignan, Avenue Albert Camus', 'Besançon, Chemin de la Grande Creuse', '2024-01-05 00:00:00', 0);

-- Listage de la structure de la table carpooling. annonces_cars
CREATE TABLE IF NOT EXISTS `annonces_cars` (
  `annonce_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  PRIMARY KEY (`annonce_id`,`car_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table carpooling.annonces_cars : ~2 rows (environ)
INSERT INTO `annonces_cars` (`annonce_id`, `car_id`) VALUES
	(1, 4),
	(2, 3),
	(3, 1);

-- Listage de la structure de la table carpooling. annonces_reservations
CREATE TABLE IF NOT EXISTS `annonces_reservations` (
  `annonce_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  PRIMARY KEY (`annonce_id`,`reservation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table carpooling.annonces_reservations : ~3 rows (environ)
INSERT INTO `annonces_reservations` (`annonce_id`, `reservation_id`) VALUES
	(1, 5),
	(2, 3),
	(3, 1);

-- Listage de la structure de la table carpooling. cars
CREATE TABLE IF NOT EXISTS `cars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `year` varchar(4) NOT NULL,
  `color` varchar(50) NOT NULL,
  `motorization` varchar(50) NOT NULL,
  `placesNumber` int(4) NOT NULL,
  `numberplate` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Listage des données de la table carpooling.cars : ~4 rows (environ)
INSERT INTO `cars` (`id`, `brand`, `model`, `year`, `color`, `motorization`, `placesNumber`, `numberplate`) VALUES
	(1, 'Skoda', 'Fabia', '2016', 'Blanche', 'essence', 5, 'AS-549-GH'),
	(2, 'Huandai', 'Getz', '2012', 'Rouge', 'diesel', 4, 'FY-851-PM'),
	(3, 'Mercedes', 'Classe C', '2021', 'Noire', 'electrique', 5, 'YV-364-XN'),
	(4, 'Renaut', 'Zoé', 'Bleu', '2018', 'electrique', 4, 'DW-238-JB');

-- Listage de la structure de la table carpooling. reservations
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateTimeReservation` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Listage des données de la table carpooling.reservations : ~4 rows (environ)
INSERT INTO `reservations` (`id`, `dateTimeReservation`) VALUES
	(1, '2023-11-29 12:14:52'),
	(2, '2023-11-12 18:12:34'),
	(3, '2024-03-01 08:54:16'),
	(4, '2024-12-01 14:09:28'),
	(5, '2024-10-02 10:42:47');

-- Listage de la structure de la table carpooling. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthday` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Listage des données de la table carpooling.users : ~3 rows (environ)
INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `birthday`) VALUES
	(1, 'Vincent', 'Godé', 'hello@vincentgo.fr', '1990-11-08 00:00:00'),
	(2, 'Albert', 'Dupond', 'sonemail@gmail.com', '1985-11-08 00:00:00'),
	(3, 'Thomas', 'Dumoulin', 'sonemail2@gmail.com', '1985-10-08 00:00:00');

-- Listage de la structure de la table carpooling. users_annonces
CREATE TABLE IF NOT EXISTS `users_annonces` (
  `user_id` int(11) NOT NULL,
  `annonce_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`annonce_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table carpooling.users_annonces : ~3 rows (environ)
INSERT INTO `users_annonces` (`user_id`, `annonce_id`) VALUES
	(1, 3),
	(2, 1),
	(3, 2);

-- Listage de la structure de la table carpooling. users_cars
CREATE TABLE IF NOT EXISTS `users_cars` (
  `user_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`car_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table carpooling.users_cars : ~4 rows (environ)
INSERT INTO `users_cars` (`user_id`, `car_id`) VALUES
	(1, 1),
	(1, 2),
	(2, 3),
	(3, 4);

-- Listage de la structure de la table carpooling. users_reservations
CREATE TABLE IF NOT EXISTS `users_reservations` (
  `user_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`reservation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table carpooling.users_reservations : ~4 rows (environ)
INSERT INTO `users_reservations` (`user_id`, `reservation_id`) VALUES
	(1, 3),
	(1, 5),
	(2, 1),
	(3, 2),
	(3, 4);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
