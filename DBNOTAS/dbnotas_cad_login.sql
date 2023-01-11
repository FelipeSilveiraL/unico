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
-- Table structure for table `cad_login`
--

DROP TABLE IF EXISTS `cad_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cad_login` (
  `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `login` varchar(100) DEFAULT NULL,
  `CPF` varchar(11) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `senha_fluig` varchar(45) DEFAULT NULL,
  `usuario_fluig` varchar(45) DEFAULT NULL,
  `admin` int(11) DEFAULT 0,
  `rateio_espelhado` int(11) DEFAULT 0,
  `login_espelho` int(11) DEFAULT 0,
  `deletar` int(11) DEFAULT 0 COMMENT '0 para ativo e 1 para desativado',
  `id_workflow` int(11) DEFAULT 0,
  PRIMARY KEY (`ID_USUARIO`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cad_login`
--

LOCK TABLES `cad_login` WRITE;
/*!40000 ALTER TABLE `cad_login` DISABLE KEYS */;
INSERT INTO `cad_login` VALUES (1,'Heverton','heverton.camargo@servopa.com.br','09404017973','$2y$10$KjYyYQt4HSK3B4Ox7vgkzeJApuYvMuCl78R.BeXpBiKDcwOi2OC/q','','teste',1,0,4,0,0),(2,'FelipeTI','felipe.lara@servopa.com.br','07268977956','$2y$10$P.f8EcNKkiy1w5usPXEE6eJi3lKWtjjzZlKYdzoikhCWxSfYUusFu','123','lucimara.segalla',1,NULL,NULL,0,0),(3,'Tatiane Silva','tatiane.silva@servopa.com.br','65412527000','d3a9a6115e4332e9e8b0fc45754ccb50',NULL,NULL,0,NULL,NULL,0,0),(4,'Lucimara','lucimara.segalla@servopa.com.br','02345861924','$2y$10$ImBPB0jliUkIxFiI8VIhneU1LFN.EhSi0rEtddtMYDEWmNDF1no12','123','lucimara',0,4,4,0,0),(6,'Tatiane Silva','tatiane@servopa.com.br','12215320060','a0ec29cee5c320ef25bd307a6cdc7fd7','123','teste',0,NULL,NULL,1,0),(7,'EWERTON NATALI LEWIS','compras1.matriz@servopa.com.br','08064780985','$2y$10$gsaPnqoIZsxw3EPUB52PvudYwNYriIoVvmO6K6jQO0joJ1Xq1.qd.','','compras.matriz@servopa.com.br',0,NULL,NULL,0,0),(8,'Teste2','teste2@servopa.com.br','89152520048','$2y$10$6NGhUmxirI92x.DeOAooOepj9guNSC1iEZ40ab5gEKjHrjRkWlgDu',NULL,NULL,0,0,0,1,0),(9,'BrunoCaetano','bruno.caetano@servopa.com.br','00000000000','$2y$10$O0/iRKCZ3bgHLLdpLiLImuy4AOAz.YwFhh5EhtPnhiRJcEfLPpNbe','','fda',1,0,0,0,0),(10,'Celina','celina@servopa.com.br','58298681991','$2y$10$gVxC8FtQwLfItgYY69OLzOwxe3vpV8Dr92IbNZyLwDcFrUHigsXxq','4805d1099b66701263f9d2ae15dc50e3','celina',0,0,0,0,0),(11,'Luana Cristina da Silva','luana.silva@servopa.com.br','08550823996','$2y$10$om7WqL9Pg1TYBtkoe9Bjy.Lkqh710db2mqY0/6E4z4jdqfvv934H.','luana1234','luana.silva',0,0,0,0,0),(12,'NicolasPenha','nicolas.penha@servopa.com.br','09662823964','$2y$10$0/oXfrnSylZRX/MTSszq2eg9j20ehfHaneA/oDzfUDgDl88Na5o4C','servopa123','henrique.aquino',0,11,11,0,0),(13,'Alexandre de Melo Nunes','alexandre.nunes@servopa.com.br','09451460942','$2y$10$I4W/VuMLJ45UOfiHsUPfl.ALKy5qTtd9Vr6QalNXa2/ao9OK6UkTq','11764289935','henrique.aquino',0,0,0,0,0),(14,'Henrique Lustosa Aquino','henrique.aquino@servopa.com.br','11764289935','$2y$10$Pvgk7QxbvYgkrToRGLbSLefdktsGZlLpxaDDLOM6WWDpNeka9FKZe','11764289935','henrique.aquino',0,0,0,0,0),(15,'LanÃ§amentodeNotasTI','notas.ti@servopa.com.br','36814134527','$2y$10$upWkZPgXq20v85HVuy/iquEcjVa/RNcPv406jR2k7ROiqm5k.5xea','servopa','robo.ti',0,4,4,0,0),(16,'Matheus','matheus.voltz@servopa.com.br','09460447910','$2y$10$YvPrj0QK4VZk4OAq5/mRNOqukOQBQDYduYffjyR8kfCYNzEZ5xaBe','Kvothe1995@.','matheus.voltz',1,0,0,0,0),(17,'RAFAEL BIER','rafael.bier@servopa.com.br','09891141985','$2y$10$VDjplFhCXAhNG.3eXq7EMOCnJfb6mDSBbg9hq2G8pO5e/Rq3wRwh6','09891141985','3725',0,4,4,0,0),(19,'EMANOELENOEMIAOLIVEIRADELARA','notas.rh@servopa.com.br','14087226905','$2y$10$SRW9Sip.98V02GtiH9IliOpHIXf.bEm3jGxTRDiMsc5TLtj6stSLW','servopa','emanoele.lara',0,0,0,0,0);
/*!40000 ALTER TABLE `cad_login` ENABLE KEYS */;
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
