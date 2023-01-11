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
-- Table structure for table `cad_centrocusto`
--

DROP TABLE IF EXISTS `cad_centrocusto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cad_centrocusto` (
  `ID_CENTROCUSTO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_FILIAL` int(11) DEFAULT NULL,
  `descDpto` varchar(100) DEFAULT NULL,
  `deletar` int(11) DEFAULT 0,
  PRIMARY KEY (`ID_CENTROCUSTO`)
) ENGINE=InnoDB AUTO_INCREMENT=278 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cad_centrocusto`
--

LOCK TABLES `cad_centrocusto` WRITE;
/*!40000 ALTER TABLE `cad_centrocusto` DISABLE KEYS */;
INSERT INTO `cad_centrocusto` VALUES (11,21,'1.1 VEIC. NOVOS',0),(12,21,'1.3 FROTISTA',0),(13,21,'2.1 VEIC. USADOS',0),(14,21,'3.1 PECAS',0),(15,21,'4.1 MEC/ELETRIC',0),(16,21,'5.1 ADMINISTRACAO',0),(17,19,'1.1 VEIC. NOVOS',0),(18,19,'2.1 VEIC. USADOS',0),(19,19,'3.1 PECAS',0),(20,19,'4.1 MEC/ELETRIC',0),(21,19,'1.3 FROTISTA',0),(22,19,'5.1 ADMINISTRACAO',0),(23,26,'1.1 VEIC. NOVOS',0),(24,26,'2.1 VEIC. USADOS',0),(25,26,'1.3 FROTISTA',0),(26,26,'4.1 MEC/ELETRIC',0),(27,26,'3.1 PECAS',0),(28,26,'5.1 ADMINISTRACAO',0),(29,1,'1.1 VEIC. NOVOS',0),(30,1,'1.3 FROTISTA',0),(31,1,'2.1 VEIC. USADOS',0),(32,1,'3.1 PECAS',0),(33,1,'4.1 MEC/ELETRIC',0),(34,1,'5.1 ADMINISTRACAO',0),(35,18,'1.1 VEIC. NOVOS',0),(36,18,'1.3 FROTISTA',0),(37,18,'2.1 VEIC. USADOS',0),(38,18,'3.1 PECAS',0),(39,18,'4.1 MEC/ELETRIC',0),(40,18,'5.1 ADMINISTRACAO',0),(41,20,'1.1 VEIC. NOVOS',0),(42,20,'2.1 VEIC. USADOS',0),(43,20,'5.1 ADMINISTRACAO',0),(44,37,'1.1 VEIC. NOVOS',0),(45,37,'2.1 VEIC. USADOS',0),(46,55,'1.1 VEIC. NOVOS',0),(47,55,'3.1 PECAS',0),(48,55,'4.1 MEC/ELETRIC',0),(49,55,'5.1 ADMINISTRACAO',0),(50,56,'1.1 VEIC. NOVOS',0),(51,56,'3.1 PECAS',0),(52,56,'4.1 MEC/ELETRIC',0),(53,56,'5.1 ADMINISTRACAO',0),(54,80,'1.1 VEIC. NOVOS',0),(55,80,'2.1 VEIC. USADOS',0),(56,80,'3.1 PECAS',0),(57,80,'4.1 MEC/ELETRIC',0),(58,80,'302 BOUTIQUE',0),(59,80,'5.1 ADMINISTRACAO',0),(61,81,'1.1 VEIC. NOVOS',0),(62,81,'2.1 VEIC. USADOS',0),(63,81,'3.1 PECAS',0),(64,81,'4.1 MEC/ELETRIC',0),(65,81,'302 BOUTIQUE',0),(66,81,'5.1 ADMINISTRACAO',0),(68,82,'302 BOUTIQUE',0),(69,82,'3.1 PECAS',0),(70,82,'4.1 MEC/ELETRIC',0),(71,82,'5.1 ADMINISTRACAO',0),(72,83,'1.1 VEIC. NOVOS',0),(73,83,'2.1 VEIC. USADOS',0),(74,83,'3.1 PECAS',0),(76,83,'4.1 MEC/ELETRIC',0),(77,83,'302 BOUTIQUE',0),(78,83,'7.1 GM',0),(79,83,'5.1 ADMINISTRACAO',0),(80,27,'1.1 VEIC. NOVOS',0),(81,31,'1.1 VEIC. NOVOS',0),(82,27,'2.1 VEIC. USADOS',0),(83,31,'2.1 VEIC. USADOS',0),(84,27,'3.1 PECAS',0),(85,31,'3.1 PECAS',0),(86,27,'4.1 MEC/ELETRIC',0),(87,31,'4.1 MEC/ELETRIC',0),(88,27,'5.1 ADMINISTRACAO',0),(89,31,'5.1 ADMINISTRACAO',0),(90,28,'1.1 VEIC. NOVOS',0),(91,28,'3.1 PECAS',0),(92,28,'4.1 MEC/ELETRIC',0),(93,28,'5.1 ADMINISTRACAO',0),(94,29,'1.1 VEIC. NOVOS',0),(95,29,'2.1 VEIC. USADOS',0),(96,29,'5.1 ADMINISTRACAO',0),(97,30,'3.1 PECAS',0),(98,30,'4.1 MEC/ELETRIC',0),(99,30,'4.2 FUNILARIA',0),(100,36,'1.1 VEIC. NOVOS',0),(101,23,'1.1 VEIC. NOVOS',0),(102,17,'1.1 VEIC. NOVOS',0),(103,36,'2.1 VEIC. USADOS',0),(104,23,'2.1 VEIC. USADOS',0),(105,17,'2.1 VEIC. USADOS',0),(106,36,'3.1 PECAS',0),(107,23,'3.1 PECAS',0),(108,17,'3.1 PECAS',0),(109,36,'4.1 MEC/ELETRIC',0),(110,23,'4.1 MEC/ELETRIC',0),(111,17,'4.1 MEC/ELETRIC',0),(112,36,'5.1 ADMINISTRACAO',0),(113,23,'5.1 ADMINISTRACAO',0),(114,17,'5.1 ADMINISTRACAO',0),(115,86,'1.1 VEIC. NOVOS',0),(116,54,'1.1 VEIC. NOVOS',0),(117,86,'2.1 VEIC. USADOS',0),(118,54,'2.1 VEIC. USADOS',0),(119,86,'3.1 PECAS',0),(120,54,'3.1 PECAS',0),(121,86,'4.1 MEC/ELETRIC',0),(122,54,'4.1 MEC/ELETRIC',0),(123,86,'5.1 ADMINISTRACAO',0),(124,54,'5.1 ADMINISTRACAO',0),(125,53,'3.1 PECAS',0),(126,53,'4.1 MEC/ELETRIC',0),(127,53,'5.1 ADMINISTRACAO',0),(128,32,'5.1 ADMINISTRACAO',0),(129,24,'5.1 ADMINISTRACAO',0),(130,62,'5.1 ADMINISTRACAO',0),(131,87,'5.1 ADMINISTRACAO',0),(132,44,'1.1 VEIC. NOVOS',0),(133,45,'1.1 VEIC. NOVOS',0),(134,46,'1.1 VEIC. NOVOS',0),(135,47,'1.1 VEIC. NOVOS',0),(136,38,'1.1 VEIC. NOVOS',0),(137,44,'2.1 VEIC. USADOS',0),(138,45,'2.1 VEIC. USADOS',0),(139,46,'2.1 VEIC. USADOS',0),(140,47,'2.1 VEIC. USADOS',0),(141,38,'2.1 VEIC. USADOS',0),(142,44,'3.1 PECAS',0),(143,45,'3.1 PECAS',0),(144,46,'3.1 PECAS',0),(145,47,'3.1 PECAS',0),(146,38,'3.1 PECAS',0),(147,44,'4.1 MEC/ELETRIC',0),(148,45,'4.1 MEC/ELETRIC',0),(149,46,'4.1 MEC/ELETRIC',0),(150,47,'4.1 MEC/ELETRIC',0),(151,38,'4.1 MEC/ELETRIC',0),(152,44,'5.2 TI RS',0),(153,45,'5.2 TI RS',0),(154,47,'5.2 TI RS',0),(155,46,'5.2 TI RS',0),(156,38,'5.2 TI RS',0),(157,88,'1.1 VEIC. NOVOS',0),(158,88,'2.1 VEIC. USADOS',0),(159,88,'5.2 TI RS',0),(160,89,'1.1 VEIC. NOVOS',0),(161,89,'2.1 VEIC. USADOS',0),(162,89,'5.2 TI RS',0),(163,39,'1.1 VEIC. NOVOS',0),(164,40,'1.1 VEIC. NOVOS',0),(165,39,'2.1 VEIC. USADOS',0),(166,40,'2.1 VEIC. USADOS',0),(167,39,'3.1 PECAS',0),(168,40,'3.1 PECAS',0),(169,39,'4.1 MEC/ELETRIC',0),(170,40,'4.1 MEC/ELETRIC',0),(171,39,'5.2 TI RS',0),(172,40,'5.2 TI RS',0),(173,42,'1.1 VEIC. NOVOS',0),(174,42,'2.1 VEIC. USADOS',0),(175,42,'3.1 PECAS',0),(176,42,'5.2 TI RS',0),(177,42,'4.1 MEC/ELETRIC',0),(178,59,'1.1 VEIC. NOVOS',0),(179,59,'2.1 VEIC. USADOS',0),(180,59,'3.1 PECAS',0),(181,59,'4.4 ADM. OFICINA',0),(182,59,'5.1 ADMINISTRACAO',0),(183,60,'1.1 VEIC. NOVOS',0),(184,90,'4.4 ADM. OFICINA',0),(185,68,'5.1 ADMINISTRACAO',0),(186,92,'1.1 VEIC. NOVOS',0),(187,92,'5.2 TI RS',0),(188,93,'1.1 VEIC. NOVOS',0),(189,93,'5.2 TI RS',0),(190,4,'1.1 VEIC. NOVOS',0),(191,4,'2.1 VEIC. USADOS',0),(192,85,'1.1 VEIC. NOVOS',0),(193,85,'3.1 PECAS',0),(194,4,'3.1 PECAS',0),(195,9,'TI-PR',0),(196,73,'TI-PR',0),(197,74,'TI-PR',0),(199,75,'TI-PR',0),(200,76,'TI-PR',0),(201,77,'TI-PR',0),(202,78,'TI-PR',0),(203,4,'4.1 MEC/ELETRIC',0),(204,4,'5.1 ADMINISTRACAO',0),(205,51,'5.1 ADMINISTRAÇÃO',1),(206,31,'302 BOUTIQUE',1),(207,31,'7.1 GM',1),(208,94,'5.1 ADMINISTRACAO',0),(209,94,'1.1 VEIC. NOVOS',0),(210,94,'3.1 PECAS',0),(211,94,'4.1 MEC/ELETRIC',0),(212,95,'1.1 VEIC. NOVOS',0),(213,96,'5.1 ADMINISTRACAO',0),(214,97,'5.1 ADMINISTRACAO',0),(215,28,'2.1 VEIC. USADOS',0),(216,32,'2.1 VEIC. USADOS',0),(217,98,'1.1 VEIC. NOVOS',0),(218,98,'2.1 VEIC. USADOS',0),(219,98,'3.1 PECAS',0),(220,98,'4.1 MEC/ELETRIC',0),(221,98,'5.1 ADMINISTRACAO',0),(222,19,'1.2 F&I',0),(223,1,'1.2 F&I',0),(224,99,'1.1 VEIC. NOVOS',0),(225,99,'2.1 VEIC. USADOS',0),(226,99,'3.1 PECAS',0),(227,99,'4.1 MEC/ELETRIC',0),(228,99,'5.1 ADMINISTRACAO',0),(229,101,'1.1 VEIC. NOVOS',0),(230,101,'3.1 PECAS',0),(231,101,'4.1 MEC/ELETRIC',0),(232,101,'5.1 ADMINISTRACAO',0),(233,42,'5.1 ADMINISTRACAO',0),(234,38,'5.1 ADMINISTRACAO',0),(235,39,'5.1 ADMINISTRACAO',0),(236,40,'5.1 ADMINISTRACAO',0),(237,93,'5.1 ADMINISTRACAO',0),(238,102,'2.1 VEIC. USADOS',0),(239,102,'5.2 TI RS',0),(240,102,'5.1 ADMINISTRACAO',0),(241,103,'1.1 VEIC. NOVOS',0),(242,103,'4.1 MEC/ELETRIC',0),(243,103,'3.1 PECAS',0),(244,103,'5.1 ADMINISTRACAO',0),(245,89,'5.1 ADMINISTRACAO',0),(246,45,'5.1 ADMINISTRACAO',0),(247,88,'5.1 ADMINISTRACAO',0),(248,46,'5.1 ADMINISTRACAO',0),(249,44,'5.1 ADMINISTRACAO',0),(250,47,'5.1 ADMINISTRACAO',0),(251,90,'5.1 ADMINISTRACAO',0),(252,60,'5.1 ADMINISTRACAO',0),(253,30,'5.1 ADMINISTRACAO',0),(254,76,'ADMINISTRACAO',0),(255,9,'ADMINISTRACAO',0),(256,77,'ADMINISTRACAO',0),(257,74,'ADMINISTRACAO',0),(258,75,'ADMINISTRACAO',0),(259,73,'ADMINISTRACAO',0),(260,37,'5.1 ADMINISTRACAO',0),(261,19,'4.2 FUNILARIA',0),(262,67,'ADMINISTRATIVO',0),(263,70,'5.1 ADMINISTRACAO',0),(264,56,'4.2 FUNILARIA',0),(265,56,'4.4 ADM. OFICINA',0),(266,100,'5.1 ADMINISTRACAO',0),(267,1,'4.2 FUNILARIA',0),(268,97,'1.1 VEIC. NOVOS',0),(269,97,'2.1 VEIC. USADOS',0),(270,97,'3.1 PECAS',0),(271,97,'4.1 MEC/ELETRIC',0),(272,38,'4.4 ADM. OFICINA',0),(273,37,'4.1 MEC/ELETRIC',0),(274,40,'4.4 ADM. OFICINA',0),(275,39,'4.4 ADM. OFICINA',0),(276,45,'4.4 ADM. OFICINA',0),(277,46,'4.4 ADM. OFICINA',0);
/*!40000 ALTER TABLE `cad_centrocusto` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-03  9:19:22