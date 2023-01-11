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
-- Table structure for table `cad_filial`
--

DROP TABLE IF EXISTS `cad_filial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cad_filial` (
  `ID_FILIAL` int(11) NOT NULL AUTO_INCREMENT,
  `cnpj` varchar(14) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `empresaFluig` varchar(100) DEFAULT NULL,
  `consorcio` int(11) DEFAULT 0,
  PRIMARY KEY (`ID_FILIAL`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cad_filial`
--

LOCK TABLES `cad_filial` WRITE;
/*!40000 ALTER TABLE `cad_filial` DISABLE KEYS */;
INSERT INTO `cad_filial` VALUES (1,'76564624000101','1.1 - VW Servopa Matriz','1.1 - VW Servopa Matriz',0),(4,'03787133000148','5.1 - Audi Center Curitiba (Plaza)','5.1 - Audi Center Curitiba (Plaza)',0),(9,'76515071000199','C1 - Curitiba-PR (Matriz) - SERVOPA ADM CONSORCIOS LTDA','C1 - Curitiba-PR (Matriz) - SERVOPA ADM CONSORCIOS LTDA',1),(17,'76564624001256','1.11 - VW Servopa Mario Tourinho','1.11 - VW Servopa Mario Tourinho',0),(18,'76564624001337','1.12 - VW Servopa Paranavaí','1.12 - VW Servopa Paranavaí',0),(19,'76564624000284','1.2 - VW Servopa Pinheirinho','1.2 - VW Servopa Pinheirinho',0),(20,'76564624000446','1.3 - VW Servopa Marechal','1.3 - VW Servopa Marechal',0),(21,'76564624000527','1.4 - VW Servopa Ponta Grossa (Oficinas)','1.4 - VW Servopa Ponta Grossa (Oficinas)',0),(23,'76564624000799','1.6 - VW Servopa Paranaguá','1.6 - VW Servopa Paranaguá',0),(24,'76564624000870','1.7 - VW Servopa Castro','1.7 - VW Servopa Castro',0),(26,'76564624001094','1.9 - VW Servopa Maringá','1.9 - VW Servopa Maringá',0),(27,'07202226000114','10.1 - Honda Prixx Curitiba','10.1 - Honda Prixx Curitiba',0),(28,'07202226000203','10.2 - Honda Prixx SJP','10.2 - Honda Prixx SJP',0),(29,'07202226000386','10.3 - Honda Prixx Maringá','10.3 - Honda Prixx Maringá',0),(30,'07202226000467','10.4 - Honda Prixx Maringá FUNILARIA','10.4 - Honda Prixx Maringá FUNILARIA',0),(31,'07202226000548','10.5 - Honda Prixx Londrina','10.5 - Honda Prixx Londrina',0),(32,'07202226000629','10.6 - Honda Prixx Londrina (SEMINOVOS)','10.6 - Honda Prixx Londrina (SEMINOVOS)',0),(36,'00568480000191','15.1 - HMB Sevec (Matriz)','15.1 - HMB Sevec (Matriz)',0),(37,'00568480000353','15.2 - HMB Sevec (Arthur Bernardes)','15.2 - HMB Sevec (Arthur Bernardes)',0),(38,'10285760000146','16.1 - HMB Carway (Ipiranga)','16.1 - HMB Carway (Ipiranga)',0),(39,'10285760000308','16.2 - HMB Carway (Novo Hamburgo)','16.2 - HMB Carway (Novo Hamburgo)',0),(40,'10285760000499','16.3 - HMB Carway (Canoas)','16.3 - HMB Carway (Canoas)',0),(42,'10285760000650','16.5 - HMB Carway (Bento Gonçalves)','16.5 - HMB Carway (Bento Gonçalves)',0),(44,'15108924000183','20.1 - Peugeot Dijon Avant','20.1 - Peugeot Dijon Avant',0),(45,'15108924000264','20.2 - Peugeot Dijon Passion (Canoas)','20.2 - Peugeot Dijon Passion (Canoas)',0),(46,'15108924000507','20.3 - Peugeot Dijon Lyon (Ipiranga)','20.3 - Peugeot Dijon Lyon (Ipiranga)',0),(47,'15108924000698','20.4 - Peugeot Dijon Le Mans (Novo Hamburgo)','20.4 - Peugeot Dijon Le Mans (Novo Hamburgo)',0),(53,'03787133000229','5.2 - Audi Center Cascavel (Plaza)','5.2 - Audi Center Cascavel (Plaza)',0),(54,'03787133000300','5.3 - Audi Center Alto da XV (Plaza)','5.3 - Audi Center Alto da XV (Plaza)',0),(55,'00298749000167','50.1 - Servopa Caminhões Cambé','50.1 - Servopa Caminhões Cambé',0),(56,'00298749001210','50.2 - Servopa Caminhões Curitiba','50.2 - Servopa Caminhões Curitiba',0),(59,'85043636000173','55.1 - MAVESUL Curitiba (CWB Triumph Curitiba)','55.1 - MAVESUL Curitiba (CWB Triumph Curitiba)',0),(60,'85043636000840','55.2 - MAVESUL Londrina (Triumph North Londrina)','55.2 - MAVESUL Londrina (Triumph North Londrina)',0),(62,'18530275000100','56.1 - DUPAR (Ducati Curitiba)','56.1 - DUPAR (Ducati Curitiba)',0),(67,'79321055000153','81.1 - Protecta Corretora de Seguros','81.1 - Protecta Corretora de Seguros',0),(68,'76564632000140','82 - Paranapart Bens','82 - Paranapart Bens',0),(70,'03144717000103','85.1 - DESPACHANTE CELESTINO S/C LTDA','85.1 - DESPACHANTE CELESTINO S/C LTDA',0),(71,'03144717000103','91 - Despachante Celestino','91 - Despachante Celestino',0),(73,'76515071000350','C2 - Ponta Grossa-PR (Filial) - SERVOPA ADM CONSORCIOS LTDA','C2 - Ponta Grossa-PR (Filial) - SERVOPA ADM CONSORCIOS LTDA',1),(74,'76515071000431','C3 - Londrina-PR (Filial) - SERVOPA ADM CONSORCIOS LTDA','C3 - Londrina-PR (Filial) - SERVOPA ADM CONSORCIOS LTDA',1),(75,'76564624000512','C4','C4',1),(76,'76515071000601','C5','C5',1),(77,'76515071000350','C6','C6',1),(78,'76515071000199','C7','C7',1),(80,'01693497000133','H1 - FREEDOM Curitiba (THE ONE - Harley Davidson)','H1 - FREEDOM Curitiba (THE ONE - Harley Davidson)',0),(81,'01693497000214','H2 - FREEDOM Londrina (RED WHEEL - Harley Davidson)','H2 - FREEDOM Londrina (RED WHEEL - Harley Davidson)',0),(82,'01693497000303','FREEDOM Batel Curitiba (Harley Davidson)','FREEDOM Batel Curitiba (Harley Davidson)',0),(85,'33661515000191','V20 - VOLVO DAYGO','V20 - VOLVO DAYGO',0),(86,'00605582000130','V30 - VOLVO VECODIL','V30 - VOLVO VECODIL',0),(87,'04418538000171','84.1 - Brisa Comunicação e Marketing','84.1 - Brisa Comunicação e Marketing',0),(88,'15108924000930','20.7 - Peugeot Dijon Lyon (Ceará)','20.7 - Peugeot Dijon Lyon (Ceará)',0),(89,'15108924000850','20.6 - Peugeot Dijon Lyon (Botânico)','20.6 - Peugeot Dijon Lyon (Botânico)',0),(90,'85043636000920','55.3 - MAVESUL ALTO DA XV (CWB Triumph Alto da XV)','55.3 - MAVESUL ALTO DA XV (CWB Triumph Alto da XV)',0),(92,'15108924000779','20.5 - Peugeot Dijon (Cachoerinha) - Centro de Distribuição','20.5 - Peugeot Dijon (Cachoerinha) - Centro de Distribuição',0),(93,'10285760000570','16.4 - HMB Carway (Cachoerinha) - Centro de Distribuição','16.4 - HMB Carway (Cachoerinha) - Centro de Distribuição',0),(94,'00298749001058','50.1 - Servopa Caminhões Cambé','50.1 - Servopa Caminhões Cambé',0),(95,'76564624001175','1.10 - VW Servopa Ponta Grossa (Nova Russia)','1.10 - VW Servopa Ponta Grossa (Nova Russia)',0),(96,'76564624000950','1.8 - VW Servopa Hauer','1.8 - VW Servopa Hauer',0),(97,'76564624000608','1.5 - VW Servopa Irati','1.5 - VW Servopa Irati',0),(98,'00605582000210','V31 - VOLVO VECODIL CASCAVEL','V31 - VOLVO VECODIL CASCAVEL',0),(99,'03787133000490','5.4 - Audi Center Maringa','5.4 - Audi Center Maringa',0),(100,'16520353000152','H4 - Ribeirao Preto (Harley Davidson)','H4 - Ribeirao Preto (Harley Davidson)',0),(101,'00298749000329','50.3 - Servopa Caminhoes Contorno SJP','50.3 - Servopa Caminhoes Contorno SJP',0),(102,'10285760000731','16.6 - HMB Carway (Gravatai)','16.6 - HMB Carway (Gravatai)',0),(103,'02446766000120','25.1 BYD','25.1 BYD',0),(104,'11777130000151','83.1 - PARANAPART PARTICIPACOES','83.1 - PARANAPART PARTICIPACOES',0),(105,'76515071000512','C4','C4',1);
/*!40000 ALTER TABLE `cad_filial` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-03  9:19:15
