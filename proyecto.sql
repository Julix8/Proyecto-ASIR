-- MySQL dump 10.13  Distrib 5.7.24, for Win64 (x86_64)
--
-- Host: localhost    Database: proyecto
-- ------------------------------------------------------
-- Server version	5.7.24

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
-- Table structure for table `archivos`
--

DROP TABLE IF EXISTS `archivos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `archivos` (
  `id_archivo` varchar(80) NOT NULL,
  `nombre_archivo` varchar(30) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `tipo` varchar(8) NOT NULL,
  PRIMARY KEY (`id_archivo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `archivos`
--

LOCK TABLES `archivos` WRITE;
/*!40000 ALTER TABLE `archivos` DISABLE KEYS */;
INSERT INTO `archivos` VALUES ('archivo_nuevo_60521e7fc2bc77.00094461.png','archivo_nuevo',1,'png'),('cv_juli_60554c940fb728.07937383.pdf','cv_juli',1,'pdf'),('default_60511486c73688.75106070.jpg','default',1,'jpg'),('default_6051330a590e81.59732175.png','default',1,'png'),('default_6051330f484066.48566843.jpeg','default',1,'jpeg'),('hola_6051148317f8b2.06919345.jpg','hola',1,'jpg'),('hola_6051f5e7f12b22.91668534.jpg','hola',1,'jpg'),('hola_6051f7e59eefe7.85204268.jpg','hola',1,'jpg'),('hola_6051f8312fd5c8.24652436.png','hola',2,'png'),('juli_605123d213e548.96908158.png','juli',1,'png'),('matty_60539f46650e96.94363637.png','matty',1,'png'),('rubensito_605642c74df752.47743585.png','rubensito',1,'png');
/*!40000 ALTER TABLE `archivos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tareas`
--

DROP TABLE IF EXISTS `tareas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tareas` (
  `id_tarea` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `prioridad` int(11) DEFAULT NULL,
  `posicion` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `avisada` int(11) DEFAULT '0',
  PRIMARY KEY (`id_tarea`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tareas`
--

LOCK TABLES `tareas` WRITE;
/*!40000 ALTER TABLE `tareas` DISABLE KEYS */;
INSERT INTO `tareas` VALUES (68,'miau','Que tal funciona','22:21:00','2021-03-22',2,1,2,1,0),(70,'puto','puyototpyotpyotpy puto malo ','20:23:00','2021-03-19',3,2,2,1,0),(71,'Pruebaaa','Probando que bordes queadan mejor','00:38:00','2021-03-19',3,3,1,1,0),(72,'Esta si','Me pase de hora','23:49:00','2021-03-19',2,4,1,1,0),(73,'Probando','Miauau','23:58:00','2021-03-19',3,5,3,1,1),(74,'Tarjeta','werwfg','23:59:00','2021-03-19',3,6,3,1,1),(75,'dcfghbd<f','agagfvae','23:59:00','2021-03-19',3,7,3,1,1),(76,'Ahora si','Try again','00:10:00','2021-03-20',1,8,1,1,0),(77,'Probando','fjtfj','00:20:00','2021-03-20',3,9,3,1,1),(78,'fgyjgftj','','00:00:00','2021-03-20',3,10,1,1,0),(79,'Maybe?','rfthrhs','00:00:00','2021-03-20',1,11,1,1,0),(80,'Maybe now?','Heheh','02:28:02','2021-03-20',3,12,3,1,1),(81,'erhrheh','','02:35:09','2021-03-20',3,13,3,1,1),(83,'Tarea 2','Probando mas tareas','11:38:00','2021-03-20',3,2,2,2,0);
/*!40000 ALTER TABLE `tareas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  `clave` varchar(80) DEFAULT NULL,
  `avisos` int(11) DEFAULT '1',
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Julian Gonzalez','juli@noreal.es','person1.jpg','$2y$10$zpMrZHrKlvBsfHTfZUgpY.HxVy/4PqtzkOg5hnuW5wy7HszQn9ad.',1),(2,'Pepe','pepe@noreal.es','person1.jpg','$2y$10$QSVj5afKsJyYUnQaQH8CdOj5cfnxTSfuc5OTQsSBQQCWpJdjJd7HS',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-21 13:49:47
