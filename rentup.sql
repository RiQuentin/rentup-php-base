-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 29 avr. 2022 à 13:37
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `rentup`
--

-- --------------------------------------------------------

--
-- Structure de la table `property`
--

DROP TABLE IF EXISTS `property`;
CREATE TABLE IF NOT EXISTS `property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `price` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `created_at` date NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `property_type_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `property_type_id` (`property_type_id`),
  KEY `seller_id` (`seller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `property`
--

INSERT INTO `property` (`id`, `name`, `street`, `city`, `postal_code`, `state`, `country`, `price`, `status`, `created_at`, `image`, `property_type_id`, `seller_id`) VALUES
(1, 'Red Carpet Real Estate', 'Zirak Road', 'Montreal ', '210', 'Quebec', 'Canada', 3700, 'For Rent', '2022-04-09', 'p-1.png', 3, 1),
(2, 'Fairmount Properties', 'Zirak Road', 'New York', '5698 ', 'New York', 'USA', 9750, 'For Sale', '2022-04-25', 'p-2.png', 5, 2),
(3, 'Red Carpet Real Estatebbbbbbbbbbbbbbbbbbbbbbbbb', 'Zirak Road', 'Montreal ', '210', 'Quebeca', 'Canada', 3700, 'For Rent', '2022-04-09', 'default-image', 3, 1),
(4, 'Herringbone Realty', 'Liverpool', 'London', '5621 ', 'London City', 'UK', 2742, 'For Sale', '2022-01-19', 'p-5.png', 2, 1),
(15, 'Red Carpet Real Estateaaaaaaaaaaaaa', 'Zirak Road', 'Montreal ', '210', 'Quebeca', 'Canada', 3700, 'For Rent', '2022-04-09', 'default-image', 3, 1),
(16, 'Gary Wisetyti  te', 'Enim tempora dolore  te', 'Autem sit perspiciaty te', 'Dolores voluptas autty te', 'Accusamus est sunt ty te', 'Consectetur debitis tyt te', 281644329, 'For Rent', '2022-07-10', 'BRC-Ukraine-Large.png', 3, 5);

-- --------------------------------------------------------

--
-- Structure de la table `propertytype`
--

DROP TABLE IF EXISTS `propertytype`;
CREATE TABLE IF NOT EXISTS `propertytype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nametype` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `picto` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `nbproperty` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `propertytype`
--

INSERT INTO `propertytype` (`id`, `nametype`, `picto`, `nbproperty`) VALUES
(1, 'Family House', 'resort.png', 122),
(2, 'House & Villa', 'cabin.png', 155),
(3, 'Apartment', 'apartment.png', 300),
(4, 'Office & Studio', 'university.png', 80),
(5, 'Villa & Condo', 'modern-house.png', 80);

-- --------------------------------------------------------

--
-- Structure de la table `seller`
--

DROP TABLE IF EXISTS `seller`;
CREATE TABLE IF NOT EXISTS `seller` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `profil_picture` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `seller`
--

INSERT INTO `seller` (`id`, `firstname`, `lastname`, `location`, `email`, `telephone`, `profil_picture`) VALUES
(1, 'Zion ', 'Davidson ', '8539 Franecki Flats\r\nSchuppeland, AL 92756-5768', 'wyman.ford@king.com', '1-648-482-2311 x0864', '42.jpg'),
(2, 'Payton ', 'Mckinney', '4592 Korey Coves\r\nPort Nathen, IN 37659-1309', 'katrina55@lehner.com', '+1.512.986.0581', '30.jpg'),
(3, 'Camilla ', 'Cooper ', '665 Wilkinson Plains\r\nNorth Loystad, WA 57769-9876', 'skylar.haag@zemlak.com', '(284) 823-9743 x3357', '02.jpg'),
(4, 'Marshall ', 'Reyes ', '854 Nikolaus Canyon\r\nSouth Joanny, WY 07776-1997', 'jarret28@ledner.biz', '251.905.7064', '29.jpg'),
(5, 'Stella', 'Bates ', '40152 Rosenbaum Mission Suite 421\r\nPfannerstillton, IL 00647-9067', 'gdaniel@yahoo.com', '(970) 344-1531', '10.jpg'),
(6, 'Elsie ', 'Price ', '41492 Corkery Way Suite 470\r\nSouth Jasminstad, WA 57432-2097', 'feil.maritza@gmail.com', '(339) 967-9089', '29 (1).jpg');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `property_type_id` FOREIGN KEY (`property_type_id`) REFERENCES `propertytype` (`id`),
  ADD CONSTRAINT `seller_id` FOREIGN KEY (`seller_id`) REFERENCES `seller` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
