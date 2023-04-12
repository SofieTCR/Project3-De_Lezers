-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2023 at 10:07 AM
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
  `datum` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bestelling`
--

INSERT INTO `bestelling` (`bestellingId`, `klantId`, `datum`, `status`) VALUES
(1, 8, '2023-04-04', 'Verzonden'),
(2, 7, '2021-03-27', 'Voltooid'),
(3, 10, '2022-09-15', 'Voltooid'),
(4, 5, '2011-11-07', 'Retour'),
(5, 11, '2018-01-18', 'Voltooid'),
(6, 3, '2023-04-06', 'Wachtend op Betaling'),
(7, 3, '2017-07-23', 'Voltooid');

-- --------------------------------------------------------

--
-- Table structure for table `bestelling_has_product`
--

CREATE TABLE `bestelling_has_product` (
  `Bestelling_bestellingId` int(11) NOT NULL,
  `Product_productId` int(11) NOT NULL,
  `aantal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bestelling_has_product`
--

INSERT INTO `bestelling_has_product` (`Bestelling_bestellingId`, `Product_productId`, `aantal`) VALUES
(1, 7, 1),
(1, 8, 1),
(2, 2, 1),
(3, 2, 1),
(3, 11, 2),
(4, 12, 1),
(5, 2, 2),
(5, 6, 3),
(5, 12, 1),
(6, 8, 1),
(7, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `boek`
--

CREATE TABLE `boek` (
  `boekId` int(11) NOT NULL,
  `Titel` varchar(45) NOT NULL,
  `Auteur` varchar(45) NOT NULL,
  `Omschrijving` text NOT NULL,
  `Genre` varchar(45) DEFAULT NULL,
  `Uitgever` varchar(45) DEFAULT NULL,
  `blz` int(11) DEFAULT NULL,
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

INSERT INTO `boek` (`boekId`, `Titel`, `Auteur`, `Omschrijving`, `Genre`, `Uitgever`, `blz`, `Gewicht`, `Afmetingx`, `Afmetingy`, `Afmetingz`, `Verchenen`, `minleeftijd`) VALUES
(1, 'Harry Potter Deel 1', 'JK Rowling', 'Harry Potter is een doodgewone, maar ongelukkige jongen die sinds de dood van zijn ouders bij zijn saaie en hardvochtige oom en tante woont, in de bezemkast onder de trap. Op een dag arriveert er een geheimzinnige brief voor hem. En daarna nog een, en nog een. De brieven veranderen Harry s hele leven: hij wordt gered door een woest figuur op een vliegende motorfiets en hij komt erachter wie zijn ouders werkelijk waren. Met een speciale trein die vertrekt van Perron 9¾ belandt hij op Zweinsteins Hogeschool voor Hekserij en Hocus Pocus, waar hij alles leert over bezemstelen, toverdranken en monsters. En uiteindelijk moet Harry het opnemen tegen zijn aartsvijand Voldemort, een levensgevaarlijke tovenaar.', 'Fantasy', 'Uitgeverij De Harmonie', 228, 507, 22.6, 15.6, 2.7, 2000, 10),
(2, 'PHP7 en MySQL', 'AC Gijssen', 'Cursusboek MySQL & PHP', 'Studieboek', 'Instruct', 187, 378, 24.4, 17.6, 1.7, 2016, NULL),
(3, 'The Song Of Achilles', 'Madeline Miller', 'Achilles, de beste onder de Grieken, zoon van de wrede zeegodin Thetis en de legendarische koning Peleus, is sterk, snel en onweerstaanbaar knap. Patroclus is een zachtaardige prins, verbannen uit zijn vaderland na een gewelddadig incident. Achilles neemt Patroclus onder zijn hoede en de twee jongens ontwikkelen een meer dan hechte vriendschap.', 'Literatuur', 'Rainbow', 368, 256, 19.7, 13, 2.8, 2017, 12),
(4, 'Harry Potter Deel 2', 'JK Rowling', 'Na een verschrikkelijke vakantie bij zijn gemene oom en tante gaat Harry Potter naar de tweede klas van Zweinsteins Hogeschool voor Hekserij en Hocus-Pocus. Maar alleen al om daar te komen blijkt een ware heksentoer te zijn, waarbij een vliegende auto Harry en zijn vriend Ron uitkomst biedt. Na alle avonturen van vorig schooljaar denkt Harry zich rustig aan zijn lessen Toverdranken, Verweer tegen de Zwarte Kunsten en zijn favoriete sport Zwerkbal te kunnen wijden. Maar dan hoort hij een mysterieuze stem, vinden er aanslagen plaats en ontdekt hij een wel heel bijzonder dagboek...', 'Fantasy', 'Uitgeverij De Harmonie', 256, 538, 22.8, 15.6, 3, 2000, 10),
(5, 'Harry Potter Deel 3', 'JK Rowling', 'Sirius Zwarts, een beruchte volgeling van Voldemort, is uit de gevangenis van Azkaban ontsnapt en heeft het wellicht op Harry gemunt. Harry is inmiddels aan een enerverend schooljaar begonnen met nieuwe vakken als Dreuzelkunde en zorg voor Fabeldieren, spannende Zwerkbalwedstrijden en griezelige voorspellingen. De school wordt bewaakt door Dementors, de gevreesde bewakers van Azkaban, en Harry zal zijn lessen Verweer tegen de Zwarte Kunsten hard nodig hebben.', 'Fantasy', 'Uitgeverij De Harmonie', 336, 660, 22.7, 15.9, 3.6, 2000, 10),
(6, 'Harry Potter Deel 4', 'JK Rowling', 'Zoals ieder jaar brengt Harry Potter de zomervakantie door bij zijn vreselijke oom en tante, waar de sfeer dit jaar extra gespannen is doordat hun verwende zoontje Dirk op dieet is. Harry kan dan ook niet wachten tot hij terug mag naar Zweinsteins Hogeschool voor Hekserij en Hocus-Pocus, om aan zijn vierde schooljaar te beginnen.', 'Fantasy', 'Uitgeverij De Harmonie', 549, 864, 22.7, 15.8, 4.4, 2000, 10),
(7, 'Written In The Stars', 'Alexandria Bellefleur', 'Wanneer de broer van Darcy en de nieuwe zakenpartner van Elle uitdrukt hoe blij hij is dat ze het goed met elkaar kunnen vinden, is Elle verbaasd. Maar met een paar voorwaarden: Darcy moet Elle helpen omgaan met haar eigen overheersende familie tijdens de feestdagen en hun afspraak verloopt op oudejaarsavond.', 'Romantiek', 'Harpercollins Publishers Inc', 352, 336, 20.4, 13.6, 2.7, 2020, 14),
(8, 'Count Your Lucky Stars', 'Alexandria Bellefleur', 'Nooit in haar leven had ze verwacht dat haar belangrijke nieuwe klant haar beste vrouw zou zijn die wegging. Wanneer een reeks ongelukkige gebeurtenissen Olivia zonder verblijfplaats achterlaat, biedt Margot haar logeerkamer aan omdat ze een heel goed persoon is.', 'Romantiek', 'Harpercollins Publishers Inc', 384, 334, 20.2, 13.5, 3.2, 2022, 14),
(9, 'Hang The Moon', 'Alexandria Bellefleur', 'In een heerlijk vervolg op Written in the Stars, levert Alexandria Bellefleur opnieuw een queer rom-com over een hopeloze romanticus die zweert zijn jeugdliefde te laten zien dat romantiek niet dood is door iconische afspraakjes uit zijn favoriete films na te spelen... Brendon Lowell houdt van liefde.', 'Romantiek', 'Harpercollins Publishers Inc', 384, 284, 20.4, 13.5, 3.4, 2021, 14);

-- --------------------------------------------------------

--
-- Table structure for table `klachten`
--

CREATE TABLE `klachten` (
  `klachtId` int(11) NOT NULL,
  `naam` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `onderwerp` varchar(255) NOT NULL,
  `bericht` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `klachten`
--

INSERT INTO `klachten` (`klachtId`, `naam`, `email`, `onderwerp`, `bericht`) VALUES
(1, 'Ans Peeters', 'anspeeters456@hotmail.com', 'Slechte Service', 'Ik ben zo gefrustreerd door de slechte klantenservice in deze boekenwinkel! De medewerkers zijn onbeschoft en onbehulpzaam, en lijken geen idee te hebben waar iets zich in de winkel bevindt. Het duurde eeuwen om iemand te vinden die me kon helpen bij het vinden van het boek dat ik nodig had, en toen ik eindelijk hulp kreeg, bleek het boek niet op voorraad te zijn. Wat een verspilling van mijn tijd en energie'),
(2, 'Wilma van Schouten', 'wilmavanschouten87@gmail.com', 'Boek Versleten', 'Ik heb onlangs een boek besteld bij een online boekenwinkel en ik was niet tevreden over de kwaliteit van het boek dat ik ontving. Het boek was beschadigd en had duidelijke tekenen van slijtage, alsof het al vele malen was gelezen. Toen ik contact opnam met de klantenservice van de winkel om het probleem aan te kaarten, waren ze onbehulpzaam en onverschillig. Ik voelde me genegeerd en ontevreden over mijn aankoop. Dit was een teleurstellende ervaring en ik zal waarschijnlijk niet meer bij deze winkel kopen.'),
(3, 'Maartje Vink', 'maartje.vink567@hotmail.com', 'Boek niet kunnen vinden', 'Ik was onlangs aan het browsen op de website van een online boekenwinkel en ik vond het erg frustrerend dat ik de boeken niet kon vinden die ik zocht. De zoekfunctie was niet erg nuttig en de categorieën waren verwarrend. Ik heb veel tijd verspild met het proberen te vinden van boeken die ik wilde lezen en uiteindelijk besloot ik om naar een andere website te gaan. Het was een teleurstellende ervaring en het heeft me ervan weerhouden om terug te keren naar deze winkel om te winkelen in de toekomst.');

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
  `Password` varchar(45) NOT NULL,
  `Administrator` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `klant`
--

INSERT INTO `klant` (`klantId`, `Voornaam`, `Achternaam`, `Gebdatum`, `Adres`, `Plaats`, `Postcode`, `Email`, `Telefoon`, `Username`, `Password`, `Administrator`) VALUES
(1, 'Sofie', 'Brink', '2004-08-11', 'Groene Hilledijk 460C', 'Rotterdam', '3075EJ', '9019232@student.zadkine.nl', NULL, 'Sofie9019232', '12345678', NULL),
(2, 'Sofie', 'Brink', '2004-08-11', 'Groene Hilledijk 460C', 'Rotterdam', '3075EJ', 'SofieBrink@yahoo.com', NULL, 'SofieAdmin', '12345678', 1),
(3, 'Frits', 'de Jong', '1985-08-03', 'Julianastraat 86', 'Rijen', '5121LT', 'F.dejong83@hotmail.com', NULL, 'FritsdeJong', 'Peterson', NULL),
(4, 'Natalie', 'van den Bosch', '1998-02-19', 'Basaltstraat 29', 'Groningen', '9743TP', 'natalie.vandenbosch123@gmail.com', NULL, 'Natalienotesfly', 'Bosch1998', NULL),
(5, 'Ans', 'Peeters', '1974-04-28', 'Hercules Segherslaan 30', 'Meppel', '7944LE', 'anspeeters456@hotmail.com', NULL, 'ansreddog', 'reddog1974', NULL),
(6, 'Albertus', 'Kok', '1953-04-15', 'Pr. Christinalaan 60', 'Valkenburg', '6301VZ', 'hannahsmith789@protonmail.com', NULL, 'Albertusshrek', 'Scholier', NULL),
(7, 'Gerardus', 'Bakker', '1966-01-14', 'Johannes Verhulststraat 149HS', 'Amsterdam', '1071NB', 'gerardus.bakker66@yahoo.com', NULL, 'gerardusragingbull', 'Klaproos2000', NULL),
(8, 'Maartje', 'Vink', '1996-03-22', 'Pieter Zeemanstraat 4', 'Nijmegen', '6533NZ', 'maartje.vink567@hotmail.com', NULL, 'maartjecanerock', 'Schaakmat', NULL),
(9, 'Tobias', 'van Schouten', '2010-05-21', 'Lisdodde 22', 'Kampen', '8265EZ', 'wilmavanschouten87@gmail.com', NULL, 'Tobiaseggleaf', 'Fietsbel', NULL),
(10, 'Wilma', 'van Schouten', '1987-05-27', 'Lisdodde 22', 'Kampen', '8265EZ', 'wilmavanschouten87@gmail.com', NULL, 'Wilmacoke', 'Kamperen', NULL),
(11, 'Stacey', 'Peters', '2007-01-24', 'Koolzaadstraat 12', 'Rotterdam', '3073DJ', 'Staceypeters240107@gmail.com', NULL, 'Staceyseasea', 'Opleiding32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `naam` varchar(45) DEFAULT NULL,
  `soort` varchar(45) DEFAULT NULL,
  `prijs` float NOT NULL,
  `vooraad` double NOT NULL,
  `fotoURL` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `naam`, `soort`, `prijs`, `vooraad`, `fotoURL`) VALUES
(1, 'Harry Potter Deel 1', 'Boek', 22.9, 18, 'Harry_Potter_bundle.png'),
(2, 'PHP7 & MySQL', 'Boek', 26.95, 2, 'PHP7MySQL.png'),
(3, 'A Song of Achilles', 'Boek', 20.65, 5, 'songofachilles.png'),
(4, 'Harry Potter Deel 2', 'Boek', 22.9, 38, 'Harry_Potter_bundle.png'),
(5, 'Harry Potter Deel 3', 'Boek', 22.9, 6, 'Harry_Potter_bundle.png'),
(6, 'Harry Potter Deel 4', 'Boek', 25.9, 16, 'Harry_Potter_bundle.png'),
(7, 'Harry Potter Bundel 1 & 2', 'Boekenbundel', 40.95, 4, 'Harry_Potter_bundle.png'),
(8, 'Harry Potter Bundel 3 & 4', 'Boekenbundel', 45.89, 3, 'Harry_Potter_bundle.png'),
(9, 'Written In The Stars', 'Boek', 13.95, 37, 'writteninthestars.png'),
(10, 'Count Your Lucky Stars', 'Boek', 12.95, 48, 'countyourluckystars.png'),
(11, 'Hang The Moon', 'Boek', 12.95, 24, 'hangthemoon.png'),
(12, 'Alexandria Bellefleur Trilogy', 'Boekenbundel', 35.5, 4, 'bellefleurtrilogy.png');

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
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 1),
(7, 4),
(8, 5),
(8, 6),
(9, 7),
(10, 8),
(11, 9),
(12, 7),
(12, 8),
(12, 9);

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
  ADD PRIMARY KEY (`klachtId`);

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
  MODIFY `bestellingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `boek`
--
ALTER TABLE `boek`
  MODIFY `boekId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `klachten`
--
ALTER TABLE `klachten`
  MODIFY `klachtId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `klant`
--
ALTER TABLE `klant`
  MODIFY `klantId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- Constraints for table `product_has_boek`
--
ALTER TABLE `product_has_boek`
  ADD CONSTRAINT `fk_Product_has_Boek_Boek1` FOREIGN KEY (`Boek_boekId`) REFERENCES `boek` (`boekId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Product_has_Boek_Product1` FOREIGN KEY (`Product_productId`) REFERENCES `product` (`productId`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
