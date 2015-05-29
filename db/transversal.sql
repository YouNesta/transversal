-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Ven 29 Mai 2015 à 06:08
-- Version du serveur :  5.5.38
-- Version de PHP :  5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `transversal`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(3, 'Chambre Adulte'),
(4, 'Chambre Enfant'),
(6, 'Cuisine'),
(1, 'Jardin'),
(5, 'Salle d''eau'),
(2, 'Salon');

-- --------------------------------------------------------

--
-- Structure de la table `categoriesProducts`
--

CREATE TABLE `categoriesProducts` (
  `idCategory` int(11) NOT NULL,
  `idProduct` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `categoriesProducts`
--

INSERT INTO `categoriesProducts` (`idCategory`, `idProduct`) VALUES
(1, 1),
(1, 2),
(2, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `class`
--

CREATE TABLE `class` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `class`
--

INSERT INTO `class` (`id`, `name`) VALUES
(1, 'Mobilier'),
(2, 'Accessoires'),
(3, 'Luminaire'),
(4, 'Decoration');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
`id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `class` int(11) NOT NULL,
  `subclass` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `products`
--

INSERT INTO `products` (`id`, `name`, `class`, `subclass`) VALUES
(1, 'tapisCuisine', 4, 10),
(2, 'mirroirChambre', 4, 9),
(3, 'tapisSalon', 4, 10),
(4, 'tapisChambre', 4, 10),
(5, 'mirroirCuisine', 4, 9),
(6, 'mirroirSalon', 4, 9),
(7, 'rideauChambre', 4, 7),
(8, 'RideauCuisine', 4, 7),
(9, 'rideauSalon', 4, 7),
(10, 'vaseCuisine', 4, 6),
(11, 'vaseSalon', 4, 6);

-- --------------------------------------------------------

--
-- Structure de la table `subclass`
--

CREATE TABLE `subclass` (
`id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `subclass`
--

INSERT INTO `subclass` (`id`, `name`) VALUES
(1, 'Coussin'),
(2, 'Jeux'),
(3, 'Autres'),
(4, 'Poubelle'),
(5, 'Pouf'),
(6, 'Vase'),
(7, 'Rideau'),
(8, 'Meuble'),
(9, 'Miroirs '),
(10, 'Tapis');

-- --------------------------------------------------------

--
-- Structure de la table `subscription`
--

CREATE TABLE `subscription` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `monthlyPayment` varchar(255) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `subscription`
--

INSERT INTO `subscription` (`id`, `name`, `monthlyPayment`, `price`) VALUES
(1, 'Premium +', '3', 300);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
`id` int(11) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `adress` varchar(255) NOT NULL,
  `city` varchar(45) NOT NULL,
  `postalCode` int(11) NOT NULL,
  `subscription` int(11) NOT NULL,
  `stateAccount` tinyint(1) NOT NULL,
  `stateSubscription` tinyint(1) NOT NULL,
  `statePayment` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `lastname`, `firstname`, `email`, `password`, `birthday`, `adress`, `city`, `postalCode`, `subscription`, `stateAccount`, `stateSubscription`, `statePayment`) VALUES
(44, 'Boulkaddid', 'Younes', 'younes@younes.fr', '9cf95dacd226dcf43da376cdb6cbba7035218921', '1995-02-14', 'Younes', 'Evry', 91000, 1, 0, 0, 1),
(46, 'younes', 'younes', 'boulkaddid@gmail.com', 'c7329b36a0495cf910391ad2e5f975504b63b59e', '1997-01-14', '60 boulevard Marechal', 'Evry', 91000, 1, 1, 1, 0),
(47, 'Boulkaddid', 'Younes', 'boulkaddid.younes@gmail.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '1995-02-14', '1 AllÃ©e des Galants Courts', 'Evry', 91000, 1, 0, 0, 1),
(48, 'Boulkaddid', 'Younes', 'boulkaddid.yoeeeunes@gmail.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '1995-02-14', '1 AllÃ©e des Galants Courts', 'Evry', 91000, 1, 0, 0, 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `categoriesProducts`
--
ALTER TABLE `categoriesProducts`
 ADD KEY `idProduct` (`idProduct`), ADD KEY `idCategory` (`idCategory`);

--
-- Index pour la table `class`
--
ALTER TABLE `class`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`id`), ADD KEY `subclass` (`subclass`), ADD KEY `class` (`class`);

--
-- Index pour la table `subclass`
--
ALTER TABLE `subclass`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `subscription`
--
ALTER TABLE `subscription`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`), ADD KEY `subscription` (`subscription`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `class`
--
ALTER TABLE `class`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `subclass`
--
ALTER TABLE `subclass`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `subscription`
--
ALTER TABLE `subscription`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `categoriesProducts`
--
ALTER TABLE `categoriesProducts`
ADD CONSTRAINT `categoriesproducts_ibfk_1` FOREIGN KEY (`idCategory`) REFERENCES `categories` (`id`),
ADD CONSTRAINT `categoriesproducts_ibfk_2` FOREIGN KEY (`idProduct`) REFERENCES `products` (`id`);

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`subclass`) REFERENCES `subclass` (`id`),
ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`class`) REFERENCES `class` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`subscription`) REFERENCES `Subscription` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
