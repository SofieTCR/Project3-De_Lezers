-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2023 at 09:29 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `de_lezers`
--

-- --------------------------------------------------------

--
-- Table structure for table `bestelling`
--

CREATE TABLE `bestelling` (
  `bestellingId` int(11) NOT NULL,
  `klantId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bestelling_has_product`
--

CREATE TABLE `bestelling_has_product` (
  `Bestelling_bestellingId` int(11) NOT NULL,
  `Product_productId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `boek`
--

CREATE TABLE `boek` (
  `boekId` int(11) NOT NULL,
  `Titel` varchar(45) NOT NULL,
  `Auteur` varchar(45) NOT NULL,
  `Omschrijving` varchar(45) NOT NULL,
  `Genre` varchar(45) DEFAULT NULL,
  `Soort` varchar(45) DEFAULT NULL,
  `Uitgever` varchar(45) DEFAULT NULL,
  `Gewicht` double DEFAULT NULL,
  `Afmetingx` float DEFAULT NULL,
  `Afmetingy` float DEFAULT NULL,
  `Afmetingz` float DEFAULT NULL,
  `Verchenen` year(4) DEFAULT NULL,
  `minleeftijd` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `boek`
--

INSERT INTO `boek` (`boekId`, `Titel`, `Auteur`, `Omschrijving`, `Genre`, `Soort`, `Uitgever`, `Gewicht`, `Afmetingx`, `Afmetingy`, `Afmetingz`, `Verchenen`, `minleeftijd`) VALUES
(1, 'Harry Potter Deel 1', 'JK Rowling', 'Harry potter op reis', 'Fictie', NULL, 'Hans', 192, 23, 13, 2.8, 2018, 12);

-- --------------------------------------------------------

--
-- Table structure for table `klachten`
--

CREATE TABLE `klachten` (
  `klachtId` int(11) NOT NULL,
  `Klant_klantId` int(11) NOT NULL,
  `bericht` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `klant`
--

CREATE TABLE `klant` (
  `klantId` int(11) NOT NULL,
  `Voornaam` varchar(45) NOT NULL,
  `Achternaam` varchar(45) NOT NULL,
  `Gebdatum` date DEFAULT NULL,
  `Adres` varchar(45) NOT NULL,
  `Plaats` varchar(45) NOT NULL,
  `Postcode` varchar(45) NOT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Telefoon` varchar(45) DEFAULT NULL,
  `Username` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `naam` varchar(45) DEFAULT NULL,
  `Soort` varchar(45) DEFAULT NULL,
  `prijs` float NOT NULL,
  `vooraad` double NOT NULL,
  `fotoURL` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `naam`, `Soort`, `prijs`, `vooraad`, `fotoURL`) VALUES
(4, 'Harry Potter', NULL, 19.99, 17, 'Harry_Potter_bundle.png'),
(5, 'Harry Potter1', NULL, 9.5, 17, 'Harry_Potter_bundle.png'),
(6, 'Harry Potter2', NULL, 19.99, 17, 'Harry_Potter_bundle.png'),
(7, 'Harry Potter3', NULL, 25.5, 17, 'maxmaximonsters.png'),
(8, 'Harry Potter4', NULL, 19.99, 17, 'Harry_Potter_bundle.png'),
(9, 'Harry Potter5', NULL, 44.99, 17, 'Harry_Potter_bundle.png'),
(10, 'Harry Potter6', NULL, 199.99, 17, 'Harry_Potter_bundle.png'),
(11, 'Max en de maximonsters', NULL, 99.99, 99, 'maxmaximonsters.png');

-- --------------------------------------------------------

--
-- Table structure for table `product_has_boek`
--

CREATE TABLE `product_has_boek` (
  `Product_productId` int(11) NOT NULL,
  `Boek_boekId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_has_boek`
--

INSERT INTO `product_has_boek` (`Product_productId`, `Boek_boekId`) VALUES
(4, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bestelling`
--
ALTER TABLE `bestelling`
  ADD PRIMARY KEY (`bestellingId`),
  ADD KEY `klantId_idx` (`klantId`);

--
-- Indexes for table `bestelling_has_product`
--
ALTER TABLE `bestelling_has_product`
  ADD PRIMARY KEY (`Bestelling_bestellingId`,`Product_productId`),
  ADD KEY `fk_Bestelling_has_Product_Product1_idx` (`Product_productId`),
  ADD KEY `fk_Bestelling_has_Product_Bestelling1_idx` (`Bestelling_bestellingId`);

--
-- Indexes for table `boek`
--
ALTER TABLE `boek`
  ADD PRIMARY KEY (`boekId`);

--
-- Indexes for table `klachten`
--
ALTER TABLE `klachten`
  ADD PRIMARY KEY (`klachtId`),
  ADD KEY `fk_Klachten_Klant1_idx` (`Klant_klantId`);

--
-- Indexes for table `klant`
--
ALTER TABLE `klant`
  ADD PRIMARY KEY (`klantId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `product_has_boek`
--
ALTER TABLE `product_has_boek`
  ADD PRIMARY KEY (`Product_productId`,`Boek_boekId`),
  ADD KEY `fk_Product_has_Boek_Boek1_idx` (`Boek_boekId`),
  ADD KEY `fk_Product_has_Boek_Product1_idx` (`Product_productId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bestelling`
--
ALTER TABLE `bestelling`
  MODIFY `bestellingId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `boek`
--
ALTER TABLE `boek`
  MODIFY `boekId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `klachten`
--
ALTER TABLE `klachten`
  MODIFY `klachtId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `klant`
--
ALTER TABLE `klant`
  MODIFY `klantId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bestelling`
--
ALTER TABLE `bestelling`
  ADD CONSTRAINT `klantId` FOREIGN KEY (`klantId`) REFERENCES `klant` (`klantId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `bestelling_has_product`
--
ALTER TABLE `bestelling_has_product`
  ADD CONSTRAINT `fk_Bestelling_has_Product_Bestelling1` FOREIGN KEY (`Bestelling_bestellingId`) REFERENCES `bestelling` (`bestellingId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Bestelling_has_Product_Product1` FOREIGN KEY (`Product_productId`) REFERENCES `product` (`productId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `klachten`
--
ALTER TABLE `klachten`
  ADD CONSTRAINT `fk_Klachten_Klant1` FOREIGN KEY (`Klant_klantId`) REFERENCES `klant` (`klantId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_has_boek`
--
ALTER TABLE `product_has_boek`
  ADD CONSTRAINT `fk_Product_has_Boek_Boek1` FOREIGN KEY (`Boek_boekId`) REFERENCES `boek` (`boekId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Product_has_Boek_Product1` FOREIGN KEY (`Product_productId`) REFERENCES `product` (`productId`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
