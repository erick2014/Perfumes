-- MySQL dump 10.13  Distrib 5.5.25a, for Linux (i686)
--
-- Host: localhost    Database: perfumes
-- ------------------------------------------------------
-- Server version	5.5.25a

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
-- Current Database: `perfumes`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `perfumes` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `perfumes`;

--
-- Table structure for table `combos`
--

DROP TABLE IF EXISTS `combos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `combos` (
  `codigoCombo` int(11) NOT NULL,
  `codigoProducto` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `estado` enum('A','I') DEFAULT 'A',
  `valorCombo` double DEFAULT NULL,
  `codigotipoDetalle` int(11) NOT NULL,
  PRIMARY KEY (`codigoCombo`,`codigoProducto`,`codigotipoDetalle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `combos`
--

LOCK TABLES `combos` WRITE;
/*!40000 ALTER TABLE `combos` DISABLE KEYS */;
INSERT INTO `combos` VALUES (1,1,'dede','A',1000,1),(1,4,'dede','A',1000,2);
/*!40000 ALTER TABLE `combos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_producto_perfume`
--

DROP TABLE IF EXISTS `detalle_producto_perfume`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_producto_perfume` (
  `codigoDetallePerfume` int(11) NOT NULL,
  `codigoProducto` int(11) NOT NULL,
  `fragancia` varchar(45) DEFAULT NULL,
  `codigoFrasco` int(11) DEFAULT NULL,
  `codigoEtiqueta` int(11) DEFAULT NULL,
  `precioCompra` double DEFAULT NULL,
  `precioVenta` double DEFAULT NULL,
  `estado` enum('A','I') DEFAULT 'A',
  `genero` enum('M','F') DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `talla` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `tipo` enum('R','P') DEFAULT NULL,
  PRIMARY KEY (`codigoDetallePerfume`,`codigoProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_producto_perfume`
--

LOCK TABLES `detalle_producto_perfume` WRITE;
/*!40000 ALTER TABLE `detalle_producto_perfume` DISABLE KEYS */;
INSERT INTO `detalle_producto_perfume` VALUES (1,1,NULL,NULL,NULL,2000,4000,'A',NULL,'jean blanco','L','pantalon','R'),(2,4,NULL,NULL,NULL,3000,6000,'A',NULL,'verde--','L--','pantalon verde--','R'),(3,1,NULL,NULL,NULL,222,333,'A',NULL,'dd','d','d','R'),(4,2,'FRAGANCIA',1,1,30000,50000,'A','M',NULL,NULL,NULL,'P');
/*!40000 ALTER TABLE `detalle_producto_perfume` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etiquetas`
--

DROP TABLE IF EXISTS `etiquetas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `etiquetas` (
  `codigoEtiqueta` int(11) NOT NULL,
  `etiqueta` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `estado` enum('A','I') DEFAULT 'A',
  PRIMARY KEY (`codigoEtiqueta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etiquetas`
--

LOCK TABLES `etiquetas` WRITE;
/*!40000 ALTER TABLE `etiquetas` DISABLE KEYS */;
INSERT INTO `etiquetas` VALUES (1,'etiqueta1','descripcion1','A'),(2,'etiqueta002','descripcion002','A');
/*!40000 ALTER TABLE `etiquetas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `frascos`
--

DROP TABLE IF EXISTS `frascos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `frascos` (
  `codigoFrasco` int(11) NOT NULL,
  `frasco` varchar(45) DEFAULT NULL,
  `medidas` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `estado` enum('A','I') DEFAULT 'A',
  PRIMARY KEY (`codigoFrasco`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `frascos`
--

LOCK TABLES `frascos` WRITE;
/*!40000 ALTER TABLE `frascos` DISABLE KEYS */;
INSERT INTO `frascos` VALUES (1,'frasco1','20X20','descripcion','A'),(2,'frasco002','20x20','descripcion002','A');
/*!40000 ALTER TABLE `frascos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingreso_producto`
--

DROP TABLE IF EXISTS `ingreso_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingreso_producto` (
  `codigoProducto` int(11) NOT NULL,
  `codigoTipoDetalle` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `tipo` enum('C','F') DEFAULT NULL,
  `descontado` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigoProducto`,`codigoTipoDetalle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingreso_producto`
--

LOCK TABLES `ingreso_producto` WRITE;
/*!40000 ALTER TABLE `ingreso_producto` DISABLE KEYS */;
/*!40000 ALTER TABLE `ingreso_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventarios`
--

DROP TABLE IF EXISTS `inventarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventarios` (
  `codigoProducto` int(11) NOT NULL,
  `codigoTIpoDetalle` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `stockMaximo` int(11) DEFAULT NULL,
  `stockMInimo` int(11) DEFAULT NULL,
  `estado` enum('A','I') NOT NULL DEFAULT 'A',
  PRIMARY KEY (`codigoProducto`,`codigoTIpoDetalle`,`fecha`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventarios`
--

LOCK TABLES `inventarios` WRITE;
/*!40000 ALTER TABLE `inventarios` DISABLE KEYS */;
INSERT INTO `inventarios` VALUES (3,3030,'2013-12-17',30,1,'A'),(5,323,'2013-12-17',10,1,'A');
/*!40000 ALTER TABLE `inventarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia_prima`
--

DROP TABLE IF EXISTS `materia_prima`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materia_prima` (
  `codigoMateriaPrima` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `cantidad` varchar(45) DEFAULT NULL,
  `estado` enum('A','I') DEFAULT 'A',
  PRIMARY KEY (`codigoMateriaPrima`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia_prima`
--

LOCK TABLES `materia_prima` WRITE;
/*!40000 ALTER TABLE `materia_prima` DISABLE KEYS */;
/*!40000 ALTER TABLE `materia_prima` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `codigoProducto` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `codigo_tipo` int(11) NOT NULL,
  `estado` enum('A','I') DEFAULT 'A',
  PRIMARY KEY (`codigoProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'pantalon','descripcion pantalon',1,'A'),(2,'perfume1','perfume de dama',2,'A'),(3,'perfume2','perfume hombre',2,'A'),(4,'pantalon2','descripcion pantalon2',1,'A');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedores` (
  `nit` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT 'A',
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`nit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registros_sistema`
--

DROP TABLE IF EXISTS `registros_sistema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registros_sistema` (
  `cedula` int(11) NOT NULL,
  `tabla` varchar(45) NOT NULL,
  `detalle` text,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`cedula`,`tabla`,`fecha`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registros_sistema`
--

LOCK TABLES `registros_sistema` WRITE;
/*!40000 ALTER TABLE `registros_sistema` DISABLE KEYS */;
/*!40000 ALTER TABLE `registros_sistema` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_producto`
--

DROP TABLE IF EXISTS `tipo_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_producto` (
  `codigo_tipo` int(11) NOT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `estado` enum('A','I') DEFAULT 'A',
  PRIMARY KEY (`codigo_tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_producto`
--

LOCK TABLES `tipo_producto` WRITE;
/*!40000 ALTER TABLE `tipo_producto` DISABLE KEYS */;
INSERT INTO `tipo_producto` VALUES (1,'ropa','A'),(2,'perfume','A'),(3,'prueba','A');
/*!40000 ALTER TABLE `tipo_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `cedula` varchar(45) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES ('123','nombre','apellido','telefono ','direccion'),('1234','juanito','garcia','769909','cra norte sur 09'),('12344','pepita','meneses','87655432','norte sur 27'),('2020','ale','mazano','9876654','norte 48976');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_sistema`
--

DROP TABLE IF EXISTS `usuario_sistema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_sistema` (
  `cedulaNit` varchar(45) NOT NULL,
  `clave` varchar(45) DEFAULT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `estado` enum('A','I') DEFAULT 'A',
  `tipoUsuario` enum('A','N','C','P') DEFAULT 'N',
  PRIMARY KEY (`cedulaNit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_sistema`
--

LOCK TABLES `usuario_sistema` WRITE;
/*!40000 ALTER TABLE `usuario_sistema` DISABLE KEYS */;
INSERT INTO `usuario_sistema` VALUES ('123','123456','user2','A','A'),('1234','clave','user','A','A'),('12344','pass','user','A','A'),('2020','pass','user','A','A');
/*!40000 ALTER TABLE `usuario_sistema` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitas_sistema`
--

DROP TABLE IF EXISTS `visitas_sistema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visitas_sistema` (
  `cedula` int(11) NOT NULL,
  `fechaIngreso` datetime NOT NULL,
  `fechaSalida` datetime NOT NULL,
  PRIMARY KEY (`cedula`,`fechaIngreso`,`fechaSalida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitas_sistema`
--

LOCK TABLES `visitas_sistema` WRITE;
/*!40000 ALTER TABLE `visitas_sistema` DISABLE KEYS */;
/*!40000 ALTER TABLE `visitas_sistema` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-12-18 16:20:01
