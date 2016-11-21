-- MySQL dump 10.13  Distrib 5.7.16, for Linux (x86_64)
--
-- Host: localhost    Database: LetterLove
-- ------------------------------------------------------
-- Server version	5.7.16-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cards`
--

DROP TABLE IF EXISTS `cards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cards`
--

LOCK TABLES `cards` WRITE;
/*!40000 ALTER TABLE `cards` DISABLE KEYS */;
INSERT INTO `cards` VALUES (1,'Guard',5),(2,'Priest',2),(3,'Baron',2),(4,'Handmaid',2),(5,'Prince',2),(6,'King',1),(7,'Countess',1),(8,'Princess',1);
/*!40000 ALTER TABLE `cards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `games` (
  `idGame` int(11) NOT NULL AUTO_INCREMENT,
  `player1` int(11) DEFAULT NULL,
  `player2` int(11) DEFAULT NULL,
  `pioche` int(11) NOT NULL,
  `defausse` int(11) NOT NULL,
  `playing` tinyint(1) NOT NULL,
  `player3` int(11) DEFAULT NULL,
  `player4` int(11) DEFAULT NULL,
  PRIMARY KEY (`idGame`),
  KEY `party_fk_player1` (`player1`),
  KEY `party_fk_player2` (`player2`),
  KEY `party_fk_pioche` (`pioche`),
  KEY `party_fk_defausse` (`defausse`),
  KEY `party_fk_player3` (`player3`),
  KEY `party_fk_player4` (`player4`),
  CONSTRAINT `party_fk_defausse` FOREIGN KEY (`defausse`) REFERENCES `piles` (`idPile`),
  CONSTRAINT `party_fk_pioche` FOREIGN KEY (`pioche`) REFERENCES `piles` (`idPile`),
  CONSTRAINT `party_fk_player1` FOREIGN KEY (`player1`) REFERENCES `players` (`idPlayer`),
  CONSTRAINT `party_fk_player2` FOREIGN KEY (`player2`) REFERENCES `players` (`idPlayer`),
  CONSTRAINT `party_fk_player3` FOREIGN KEY (`player3`) REFERENCES `players` (`idPlayer`),
  CONSTRAINT `party_fk_player4` FOREIGN KEY (`player4`) REFERENCES `players` (`idPlayer`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games`
--

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hands`
--

DROP TABLE IF EXISTS `hands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hands` (
  `idHand` int(11) NOT NULL AUTO_INCREMENT,
  `card1` int(11) DEFAULT NULL,
  `card2` int(11) DEFAULT NULL,
  PRIMARY KEY (`idHand`),
  KEY `fk_card1` (`card1`),
  KEY `fk_card2` (`card2`),
  CONSTRAINT `fk_card1` FOREIGN KEY (`card1`) REFERENCES `cards` (`id`),
  CONSTRAINT `fk_card2` FOREIGN KEY (`card2`) REFERENCES `cards` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hands`
--

LOCK TABLES `hands` WRITE;
/*!40000 ALTER TABLE `hands` DISABLE KEYS */;
INSERT INTO `hands` VALUES (1,1,5);
/*!40000 ALTER TABLE `hands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `piles`
--

DROP TABLE IF EXISTS `piles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `piles` (
  `idPile` int(11) NOT NULL AUTO_INCREMENT,
  `card1` int(11) DEFAULT NULL,
  `card2` int(11) DEFAULT NULL,
  `card3` int(11) DEFAULT NULL,
  `card4` int(11) DEFAULT NULL,
  `card5` int(11) DEFAULT NULL,
  `card6` int(11) DEFAULT NULL,
  `card7` int(11) DEFAULT NULL,
  `card8` int(11) DEFAULT NULL,
  `card9` int(11) DEFAULT NULL,
  `card10` int(11) DEFAULT NULL,
  `card11` int(11) DEFAULT NULL,
  `card12` int(11) DEFAULT NULL,
  `card13` int(11) DEFAULT NULL,
  `card14` int(11) DEFAULT NULL,
  `card15` int(11) DEFAULT NULL,
  `card16` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idPile`),
  KEY `pile_fk_card1` (`card1`),
  KEY `pile_fk_card2` (`card2`),
  KEY `pile_fk_card3` (`card3`),
  KEY `pile_fk_card4` (`card4`),
  KEY `pile_fk_card5` (`card5`),
  KEY `pile_fk_card6` (`card6`),
  KEY `pile_fk_card7` (`card7`),
  KEY `pile_fk_card8` (`card8`),
  KEY `pile_fk_card9` (`card9`),
  KEY `pile_fk_card10` (`card10`),
  KEY `pile_fk_card11` (`card11`),
  KEY `pile_fk_card12` (`card12`),
  KEY `pile_fk_card13` (`card13`),
  KEY `pile_fk_card14` (`card14`),
  KEY `pile_fk_card15` (`card15`),
  KEY `pile_fk_card16` (`card16`),
  CONSTRAINT `pile_fk_card1` FOREIGN KEY (`card1`) REFERENCES `cards` (`id`),
  CONSTRAINT `pile_fk_card10` FOREIGN KEY (`card10`) REFERENCES `cards` (`id`),
  CONSTRAINT `pile_fk_card11` FOREIGN KEY (`card11`) REFERENCES `cards` (`id`),
  CONSTRAINT `pile_fk_card12` FOREIGN KEY (`card12`) REFERENCES `cards` (`id`),
  CONSTRAINT `pile_fk_card13` FOREIGN KEY (`card13`) REFERENCES `cards` (`id`),
  CONSTRAINT `pile_fk_card14` FOREIGN KEY (`card14`) REFERENCES `cards` (`id`),
  CONSTRAINT `pile_fk_card15` FOREIGN KEY (`card15`) REFERENCES `cards` (`id`),
  CONSTRAINT `pile_fk_card16` FOREIGN KEY (`card16`) REFERENCES `cards` (`id`),
  CONSTRAINT `pile_fk_card2` FOREIGN KEY (`card2`) REFERENCES `cards` (`id`),
  CONSTRAINT `pile_fk_card3` FOREIGN KEY (`card3`) REFERENCES `cards` (`id`),
  CONSTRAINT `pile_fk_card4` FOREIGN KEY (`card4`) REFERENCES `cards` (`id`),
  CONSTRAINT `pile_fk_card5` FOREIGN KEY (`card5`) REFERENCES `cards` (`id`),
  CONSTRAINT `pile_fk_card6` FOREIGN KEY (`card6`) REFERENCES `cards` (`id`),
  CONSTRAINT `pile_fk_card7` FOREIGN KEY (`card7`) REFERENCES `cards` (`id`),
  CONSTRAINT `pile_fk_card8` FOREIGN KEY (`card8`) REFERENCES `cards` (`id`),
  CONSTRAINT `pile_fk_card9` FOREIGN KEY (`card9`) REFERENCES `cards` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `piles`
--

LOCK TABLES `piles` WRITE;
/*!40000 ALTER TABLE `piles` DISABLE KEYS */;
INSERT INTO `piles` VALUES (26,NULL,2,1,7,2,6,8,5,1,4,1,3,1,1,4,5,'pioche'),(27,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'defausse'),(28,NULL,1,2,3,1,4,7,6,8,1,4,5,2,1,3,5,'pioche'),(29,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'defausse'),(30,NULL,1,8,2,3,3,7,1,1,5,4,1,1,6,4,2,'pioche'),(31,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'defausse'),(32,NULL,4,2,6,1,7,4,1,3,5,1,3,2,1,5,8,'pioche'),(33,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'defausse'),(34,NULL,5,3,4,3,2,1,1,4,5,2,1,1,7,6,1,'pioche'),(35,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'defausse'),(36,NULL,1,6,3,4,1,4,1,5,1,2,3,2,8,1,5,'pioche'),(37,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'defausse'),(38,NULL,1,1,1,8,1,3,4,6,5,2,3,2,7,5,4,'pioche'),(39,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'defausse'),(40,NULL,2,5,1,8,1,2,3,6,7,1,1,5,4,4,3,'pioche'),(41,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'defausse'),(42,NULL,1,3,2,1,4,5,4,5,6,7,2,8,1,3,1,'pioche'),(43,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'defausse'),(44,NULL,4,8,7,4,2,3,1,1,3,1,5,6,1,1,2,'pioche'),(45,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'defausse'),(46,NULL,1,2,7,8,3,4,1,6,3,1,5,1,4,5,2,'pioche'),(47,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'defausse');
/*!40000 ALTER TABLE `piles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `players`
--

DROP TABLE IF EXISTS `players`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `players` (
  `idPlayer` int(11) NOT NULL AUTO_INCREMENT,
  `hand` int(11) DEFAULT NULL,
  `name` varchar(25) NOT NULL,
  `ready` tinyint(1) NOT NULL DEFAULT '0',
  `connected` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idPlayer`),
  KEY `fk_hand` (`hand`),
  CONSTRAINT `fk_hand` FOREIGN KEY (`hand`) REFERENCES `hands` (`idHand`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `players`
--

LOCK TABLES `players` WRITE;
/*!40000 ALTER TABLE `players` DISABLE KEYS */;
INSERT INTO `players` VALUES (2,NULL,'moi',0,0),(3,NULL,'lui',0,0);
/*!40000 ALTER TABLE `players` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-16 15:00:59
