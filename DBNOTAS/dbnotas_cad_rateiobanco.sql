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
-- Table structure for table `cad_rateiobanco`
--

DROP TABLE IF EXISTS `cad_rateiobanco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cad_rateiobanco` (
  `ID_RATEIOBANCO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_RATEIOFORNECEDOR` int(11) DEFAULT NULL,
  `nome_banco` varchar(100) DEFAULT NULL,
  `agencia` varchar(45) DEFAULT NULL,
  `conta` varchar(45) DEFAULT NULL,
  `digito` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`ID_RATEIOBANCO`)
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cad_rateiobanco`
--

LOCK TABLES `cad_rateiobanco` WRITE;
/*!40000 ALTER TABLE `cad_rateiobanco` DISABLE KEYS */;
INSERT INTO `cad_rateiobanco` VALUES (1,206,'Banco do Brasil S.A.','1622-5','19357','7'),(2,206,'Banco do Brasil S.A.','1622-5','19357','7'),(3,207,'Banco do Brasil S.A.','1622-5','19357','7'),(4,208,'Banco do Brasil S.A.','1622-5','19357','7'),(5,209,'Banco do Brasil S.A.','1622-5','19357','7'),(6,210,'Banco do Brasil S.A.','1622-5','19357','7'),(7,211,'Banco do Brasil S.A.','1622','19357','7'),(8,212,'Banco do Brasil S.A.','1622-5','19357','7'),(9,213,'Banco do Brasil S.A.','1622-5','19357','7'),(10,214,'Banco Bradesco S.A.','6349','1856','2'),(11,215,'Banco Bradesco S.A.','6349','1856','2'),(12,216,'Banco Bradesco S.A.','6349','1856','2'),(13,217,'Banco Bradesco S.A.','6349','1856','2'),(14,218,'Banco Bradesco S.A.','6349','1856','2'),(15,219,'Banco Bradesco S.A.','6349','1856','2'),(16,220,'Banco Bradesco S.A.','6349','1856','2'),(17,221,'Banco Bradesco S.A.','6349','1856','2'),(18,222,'Banco Bradesco S.A.','6349','1856','2'),(19,223,'Banco Bradesco S.A.','6349','1856','2'),(20,224,'Banco Bradesco S.A.','6349','1856','2'),(21,225,'Banco Bradesco S.A.','6349','1856','2'),(22,226,'Banco Bradesco S.A.','6349','1856','2'),(23,227,'Banco Bradesco S.A.','6349','1856','2'),(24,228,'Banco Bradesco S.A.','6349','1856','2'),(25,229,'Banco Bradesco S.A.','6349','1856','2'),(26,230,'Banco Bradesco S.A.','6349','1856','2'),(27,231,'Banco Bradesco S.A.','6349','1856','2'),(28,232,'Banco Bradesco S.A.','6349','1856','2'),(29,233,'Banco Bradesco S.A.','6349','1856','2'),(30,234,'Banco Bradesco S.A.','6349','1856','2'),(31,235,'Banco Bradesco S.A.','6349','1856','2'),(32,236,'Banco Bradesco S.A.','6349','1856','2'),(33,237,'Banco Bradesco S.A.','6349','1856','2'),(34,238,'Banco Bradesco S.A.','6349','1856','2'),(35,239,'Banco Bradesco S.A.','6349','1856','2'),(36,240,'Banco Bradesco S.A.','6349','1856','2'),(37,241,'Banco Bradesco S.A.','6349','1856','2'),(38,242,'Banco Bradesco S.A.','6349','1856','2'),(39,243,'Banco Bradesco S.A.','6349','1856','2'),(40,244,'Banco Bradesco S.A.','6349','1856','2'),(41,245,'Banco Bradesco S.A.','6349','1856','2'),(42,246,'Banco Bradesco S.A.','6349','1856','2'),(43,247,'Banco Bradesco S.A.','6349','1856','2'),(44,248,'Banco Bradesco S.A.','6349','1856','2'),(45,249,'Banco Bradesco S.A.','6349','1856','2'),(46,250,'Banco Bradesco S.A.','6349','1856','2'),(47,251,'Banco Bradesco S.A.','6349','1856','2'),(48,274,'Itaú Unibanco S.A.','1538','12980','8'),(49,275,'Itaú Unibanco S.A.','1538','12980','8'),(50,276,'Itaú Unibanco S.A.','1538','12980','8'),(51,277,'Itaú Unibanco S.A.','1538','12980','8'),(52,278,'Itaú Unibanco S.A.','1538','12980','8'),(53,279,'Itaï¿½ Unibanco S.A.','1538','12980','8'),(54,280,'Itaú Unibanco S.A.','1538','12980','8'),(55,281,'Itaú Unibanco S.A.','1538','12980','8'),(56,282,'Itaú Unibanco S.A.','1538','12980','8'),(57,283,'Itaú Unibanco S.A.','1538','12980','8'),(58,284,'Itaï¿½ Unibanco S.A.','1538','12980','8'),(59,285,'Itaú Unibanco S.A.','1538','12980','8'),(60,286,'Itaï¿½ Unibanco S.A.','1538','12980','8'),(61,287,'Itaú Unibanco S.A.','1538','12980','8'),(62,288,'Itaú Unibanco S.A.','1538','12980','8'),(63,289,'Itaï¿½ Unibanco S.A.','1538','12980','8'),(64,290,'Itaï¿½ Unibanco S.A.','1538','12980','8'),(65,291,'Itaú Unibanco S.A.','1538','12980','8'),(66,292,'Itaú Unibanco S.A.','1538','12980','8'),(67,293,'Itaï¿½ Unibanco S.A.','1538','12980','8'),(68,294,'Itaï¿½ Unibanco S.A.','1538','12980','8'),(69,295,'Itaú Unibanco S.A.','1538','12980','8'),(70,296,'Itaú Unibanco S.A.','1538','12980','8'),(71,297,'Itaú Unibanco S.A.','1538','12980','8'),(72,298,'Itaú Unibanco S.A.','1538','12980','8'),(73,299,'Itaú Unibanco S.A.','1538','12980','8'),(74,300,'Itaú Unibanco S.A.','1538','12980','8'),(75,558,'Itaú Unibanco S.A.','1538','12980','8'),(76,559,'','1538','12980','8'),(77,384,'Banco Santander (Brasil) S. A.','3114','13002535','6'),(78,382,'Banco Santander (Brasil) S. A.','3114','13002535','6'),(79,383,'Banco Santander (Brasil) S. A.','3114','13002535','6'),(80,381,'','3114','13002535','6'),(81,386,'Banco Santander (Brasil) S. A.','3114','13002535','6'),(82,385,'Banco Santander (Brasil) S. A.','3114','13002535','6'),(83,387,'Banco Santander (Brasil) S. A.','3114','13002535','6'),(84,562,'Banco Santander (Brasil) S. A.','3114','13002535','6'),(85,686,'Banco do Brasil S.A.','0712-9','9572','9'),(86,691,'Banco do Brasil S.A.','07129','9572','9'),(87,690,'Banco do Brasil S.A.','07129','9572','9'),(88,689,'Banco do Brasil S.A.','07129','9572','9'),(89,692,'Banco do Brasil S.A.','07129','9572','9'),(90,693,'Banco do Brasil S.A.','07129','9572','9'),(91,694,'Banco do Brasil S.A.','07129','9572','9'),(92,695,'Banco do Brasil S.A.','07129','9572','9'),(93,696,'Banco do Brasil S.A.','07129','9572','9'),(94,697,'Banco do Brasil S.A.','07129','9572','9'),(95,698,'Banco do Brasil S.A.','07129','9572','9'),(96,699,'Banco do Brasil S.A.','07129','9572','9'),(97,700,'Banco do Brasil S.A.','07129','9572','9'),(98,701,'Banco do Brasil S.A.','07129','9572','9'),(100,390,'Itaú Unibanco S.A.',' 0746',' 24408','6'),(101,391,'Itaú Unibanco S.A.','0746','24408','6'),(102,396,'Itaú Unibanco S.A.','0746','24408','6'),(103,397,'Itaú Unibanco S.A.','0746','24408','6'),(104,398,'Itaú Unibanco S.A.','0746','24408','6'),(105,399,'Itaú Unibanco S.A.','0746','24408','6'),(106,400,'Itaú Unibanco S.A.','0746','24408','6'),(107,769,'Banco do Brasil S.A.','0712-9','9572','9'),(108,770,'Banco do Brasil S.A.','0712-9','9572','9'),(109,771,'Banco do Brasil S.A.','0712-9','9572','9'),(110,772,'Banco do Brasil S.A.','0712-9','9572','9'),(111,773,'Banco do Brasil S.A.','0712-9','9572','9'),(112,774,'Banco do Brasil S.A.','0712-9','9572','9'),(113,775,'Banco do Brasil S.A.','0712-9','9572','9'),(114,776,'Banco do Brasil S.A.','0712-9','9572','9'),(115,778,'Banco do Brasil S.A.','0712-9','9572','9'),(116,779,'Banco do Brasil S.A.','0712-9','9572','9'),(117,780,'Banco do Brasil S.A.','0712-9','9572','9'),(118,781,'Banco do Brasil S.A.','0712-9','9572','9'),(119,782,'Banco do Brasil S.A.','0712-9','9572','9'),(120,783,'Banco do Brasil S.A.','0712-9','9572','9'),(121,784,'Banco do Brasil S.A.','0712-9','9572','9'),(122,785,'Banco do Brasil S.A.','0712-9','9572','9'),(123,786,'Banco do Brasil S.A.','0712-9','9572','9'),(124,787,'Banco do Brasil S.A.','0712-9','9572','9'),(125,788,'Banco do Brasil S.A.','0712-9','9572','9'),(126,789,'Banco do Brasil S.A.','0712-9','9572','9'),(127,790,'Banco do Brasil S.A.','0712-9','9572','9'),(128,791,'Banco do Brasil S.A.','0712-9','9572','9'),(129,792,'Banco do Brasil S.A.','0712-9','9572','9'),(131,794,'Banco do Brasil S.A.','0712-9','9572','9'),(132,795,'Banco do Brasil S.A.','0712-9','9572','9'),(133,888,'Banco do Brasil S.A.','0712-9','9572','9'),(134,893,'Banco Bradesco S.A.','2222','22775','7'),(135,894,'Banco Bradesco S.A.','2222','22775','7'),(137,899,'Banco Bradescard S.A.','6349','0001856','2'),(138,904,'Banco Bradesco S.A.','2222','22775','7'),(139,905,'Banco Bradesco S.A.','2222','22775','7'),(140,906,'Banco Bradesco S.A.','2222','22775','7'),(141,907,'Banco Bradesco S.A.','2222','22775','7'),(142,908,'Banco Bradesco S.A.','2222','22775','7'),(143,909,'Banco Bradesco S.A.','2222','22775','7'),(144,910,'Banco Bradesco S.A.','2222','22775','7'),(145,911,'Banco Bradesco S.A.','2222','22775','7'),(146,912,'Banco Bradesco S.A.','2222','22775','7'),(147,913,'Banco Bradesco S.A.','2222','22775','7'),(148,914,'Banco Bradesco S.A.','2222','22775','7'),(149,915,'Banco Bradesco S.A.','2222','22775','7'),(150,916,'Banco Bradesco S.A.','2222','22775','7');
/*!40000 ALTER TABLE `cad_rateiobanco` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-03  9:19:19
