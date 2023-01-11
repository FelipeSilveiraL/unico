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
-- Table structure for table `cad_status`
--

DROP TABLE IF EXISTS `cad_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cad_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  `deletar` int(11) DEFAULT 0,
  `erro` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cad_status`
--

LOCK TABLES `cad_status` WRITE;
/*!40000 ALTER TABLE `cad_status` DISABLE KEYS */;
INSERT INTO `cad_status` VALUES (1,'Aguardando Lançamento',0,0),(2,'Pendentes',0,0),(3,'Lançado Fluig',0,0),(4,'Erro - Download documento',0,1),(5,'Erro - Fluig fora do ar',0,1),(6,'Erro - CNPJ Fornecedor',0,1),(7,'Erro - Banco não encontrado',0,0),(8,'Erro  - Subir Documento Fluig',0,1),(10,'Aguardando Conferência',0,0),(11,'Erro - Data vencimento inválido',0,0),(12,'Erro - Nota ja lancada, por favor verificar',0,1),(13,'Erro - Não consegui encontrar a filial no fluig',0,0),(14,'Erro - Centro de Custo, por favor verificar',0,1),(16,'Erro - Não foi encontrado razão social',0,0),(17,'Erro - Vencimento deve ter prazo de pelo menos 6 dias!',0,1),(18,'Erro - NOTA É DO CONSORCIO',0,1);
/*!40000 ALTER TABLE `cad_status` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-03  9:19:16
