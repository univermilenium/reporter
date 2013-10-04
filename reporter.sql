-- MySQL dump 10.13  Distrib 5.5.32, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: reporter
-- ------------------------------------------------------
-- Server version	5.5.32-0ubuntu0.12.04.1

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
-- Table structure for table `asignaturas`
--

DROP TABLE IF EXISTS `asignaturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asignaturas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT ' unique index',
  `plantel` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `asignatura` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asignaturas`
--

LOCK TABLES `asignaturas` WRITE;
/*!40000 ALTER TABLE `asignaturas` DISABLE KEYS */;
INSERT INTO `asignaturas` VALUES (1,'NEZA','CRIM0103'),(2,'NEZA','MDER0101'),(3,'NEZA','MPS0101'),(4,'NEZA','MPEG0418'),(5,'NEZA','MPEG0103'),(6,'HIDALGO','MPEG0418'),(7,'HIDALGO','MPEG0103'),(8,'IXTAPA','CRIM0103'),(9,'IXTAPA','MDER0101'),(10,'IXTAPA','MPS0101'),(11,'IXTAPA','MPEG0418'),(12,'IXTAPA','MPEG0103'),(13,'RAYON','MDER0101'),(14,'RAYON','CRIM0103'),(15,'SALUD','MPS0101');
/*!40000 ALTER TABLE `asignaturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email',
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nombre del usuario: custom',
  `apellidos` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Apellidos del usuario: custom',
  `tipo` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tipo (director-coordinador): custom',
  `plantel` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Plantel de usuario: custom',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$3u6j0aA.oKACFmbI42knsuWHPagYAVHc3rKPkS2BKAye9gnl21ENa','moises.rangel@gmail.com','Moisés','Rangel','DIRECTOR','NEZA'),(2,'pcsanchez','$2y$10$g.RmKcuU29Ylvubb3On/heB1KvPYyOByZW5AxZLYAQSipbLp7wxla','pcsanchez@univermilenium.edu.mx','Pablo','Sánchez','DIRECTOR',''),(3,'dir01','$2y$10$2TOKYcA4UQ1b9oGcd6/1v.cWNwDxlFIgwkpJAWPNRsyqUF8k0Rv1C','hguadarrama@univermilenium.edu.mx','Higinio','Guadarrama Archundia','DIRECTOR','RAYON'),(4,'dir02','$2y$10$VEzmAoLwncqhPkZ.Fd9okuLtid8wt8/X4f3ADlZHPzUcj65L8khjK','rgrasso@univermilenium.edu.mx','Rafael','Grasso Calvo','DIRECTOR','NEZA'),(5,'dir03','$2y$10$fI.tnAWcHQwE3bqT9oKdw.s.S1ZbeYhTwKYoRKvDSHXuGfjV9WySq','mislas@univermilenium.edu.mx','María Natividad','Islas Sánchez','DIRECTOR','IXTAPA'),(6,'dir04','$2y$10$H4atDGGhMie39MQcCFZtuOLsb/r0j3.BwglsAjVA6pzFnkC78ffs2','almaraz@univermilenium.edu.mx','Yesica','Mucientes Almaraz','DIRECTOR','HIDALGO'),(7,'dir05','$2y$10$cjkHDZakdcVvkAEHKcdMh.075vJwhAD/LF7tx4T.qZSMxRHRQdZNK','rdiaz@univermilenium.edu.mx','Rafael','Díaz Benítez','DIRECTOR','SALUD'),(8,'dircontrol','$2y$10$2uWWzTBE5wgV6twvZPLmVeknzLUaIEmhgZchKDAp6454pYNURq6t.','gestormpath@hotmail.com','Martha Patricia','Perez','DIRECTOR',''),(9,'der01','$2y$10$NsgPZtj4oOv/Gf5RVwiceOF4Cs2ZGTNpbGbmZICVItts5KrN401Zm','dmoral@univermilenium.edu.mx','Darío Octavio ','Moral Hernández','DERECHO','RAYON'),(10,'der01a','$2y$10$daqGKwbVTqhjwoL/XoMtl.pP/D700fLSRB9Cv3i8t/xmeewLvy8WC','ovenegas@univermilenium.edu.mx','Omar ','Venegas Gutiérrez  ','DERECHO','RAYON'),(11,'crim01','$2y$10$Gv9F3.JMvRrCozFn1ZkS3e7Y4FmTdwpGTauCD7qa50PqysroWF28S','sugaytan@univermilenium.edu.mx','Susana  Gabriela ','Gaytán Nájera ','CRIMINOLOGIA','RAYON'),(12,'sdir01','$2y$10$dkoZrgz2tBkhVoV1Gw940ekPsyIIz66z.vRWQNNV1Xhq103QjGJd.','idiaz@univermilenium.edu.mx','Israel',' Díaz Arriaga','DIRECTOR','RAYON'),(13,'psic02','$2y$10$MP5Y86iVYk3bYwOIcRF9aesApc5OrBc6yxYLvScCapqkOc4vJtQ5a','elbah@univermilenium.edu.mx','Elba','Hernández Bautista','PSICOLOGIA','NEZA'),(14,'crim02','$2y$10$UE24EnS.ZBLCsu9tbvUR1uf5ola2qoubDu7XY9VAMHeRw.JHW1i4y','vmedina@univermilenium.edu.mx','Queahuitl Viridiana','Medina Saldaña','CRIMINOLOGIA','NEZA'),(15,'peg02','$2y$10$oDvXcVup87VQbupxVMGkfe2Okc8HWqWezfrsG/J3AcpJpfcPhsx7S','mcalzada@univermilenium.edu.mx','Martín','Calzada Banda','PEDAGOGIA','NEZA'),(16,'der02','$2y$10$8BWkwOjwkPQmRHdEcOmqB.kefYOXlLmj95rnmmFMcPTQuM7Iygdv.','erodriguez@univermilenium.edu.mx','Guadalupe Eugenia','Rodríguez Rodríguez','DERECHO','NEZA'),(17,'sdir02','$2y$10$O19lWgFVgrsj3KrimGXVjOVldI8nEC2BLj7y79ughZ6icSc0FkkYi','enieto@univermilenium.edu.mx','Francisco Eloy','Nieto Moreno','DIRECTOR','NEZA'),(18,'peg04','$2y$10$ENz7m0sLR7IBnJJWCIh1Eee.BtZUE9F70zlAN64Da5wkGqyLK9Mmu','rvillalobos@univermilenium.edu.mx','Raquel  ','Villalobos Pedraza','PEDAGOGIA','HIDALGO'),(19,'psic05','$2y$10$ug2n7o.bQSc0PUF2UI/zIeWKg5G48tx9wnBjEVkpazChgpae.uyLi','dvargas@univermilenium.edu.mx','Zayra','Vargas Gamboa','PSICOLOGIA','SALUD'),(20,'sdir05','$2y$10$0hydtN6y23YS7u7bQ1i0Te1Fi0e4DEUqyRpUzR3zZJDtSR3OHnQBG','evillicana@univermilenium.edu.mx','Edith Yael','Villicaña Garciamoreno','DIRECTOR','SALUD'),(21,'crim03','$2y$10$ORaxi69nmvdRXFlxJKG65.XGEs70aME9YXQT6I6BvMfWZXrrp6kqC','psanchez@univermilenium.edu.mx','Paola Susana','Sánchez Aranda','CRIMINOLOGIA','IXTAPA'),(22,'der03','$2y$10$nJCbiKn1.oiXGB11qsQyPOGBS.0zCJo22XVzEX9bKeHscX8KxwlMa','bgonzalez@univermilenium.edu.mx','Miriam Berenice','González Pérez','DERECHO','IXTAPA'),(23,'peg03','$2y$10$pS7htYhDrGe3ssx.sF/hne1gbSQRZ.50FU44936QRH3wT1PbqpItG','amucino@univermilenium.edu.mx','Adriana Angélica','Mucino Castro','PEDAGOGIA','IXTAPA'),(24,'psic03','$2y$10$rRcr8GMHciR3lEw5faqN8OpC41.HDSB2C14LdVIlTA16GdJfjxhEm','aracelig@univermilenium.edu.mx','Araceli','Garcia Cuevas','PSICOLOGIA','IXTAPA'),(25,'JMMA24','$2y$10$UDkSUaUdIxgIFxZgCYhD8eWFexdcLUjG48qpgKZ5z4XnhjKoWC.7i','jmmartinez@univermilenium.edu.mx','Jose Mario','Martinez Alvarado','DIRECTOR',''),(27,'alban13','$2y$10$wHPf2kDj1c6Kf7m3x4Mxb.VdQSZ9sS6pJ2mlKiG/DT6y4dILjFUm.','alban@acambio.com','Agustín','Alban Maldonado','DIRECTOR','');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-04 10:35:29
