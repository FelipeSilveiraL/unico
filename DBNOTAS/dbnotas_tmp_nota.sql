-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 10.100.10.67    Database: dbnotas
-- ------------------------------------------------------
-- Server version	5.5.5-10.8.3-MariaDB-log

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
-- Table structure for table `tmp_nota`
--

DROP TABLE IF EXISTS `tmp_nota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tmp_nota` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `cnpj` varchar(14) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `caminho_nota` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tmp_nota`
--

LOCK TABLES `tmp_nota` WRITE;
/*!40000 ALTER TABLE `tmp_nota` DISABLE KEYS */;
INSERT INTO `tmp_nota` VALUES (189,'03787133000490','notas.ti@servopa.com.br','C:\\notas\\lancar\\notasLancamento\\CLARO S.A'),(190,'59104422005704','notas.ti@servopa.com.br','C:\\notas\\lancar\\notasLancamento\\VOLKSWAGEN DO BRASIL IND.VEIC.AUTOMOTORES LTDA'),(191,'34805378000184','notas.ti@servopa.com.br','C:\\notas\\lancar\\notasLancamento\\MCM - TELECOM LTDA - EPP'),(192,'01099212000130','notas.ti@servopa.com.br','C:\\notas\\lancar\\notasLancamento\\MCM - TELECOM LTDA - EPP');
/*!40000 ALTER TABLE `tmp_nota` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-03  9:19:17
