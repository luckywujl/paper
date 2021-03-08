-- MySQL dump 10.13  Distrib 8.0.22, for Linux (x86_64)
--
-- Host: localhost    Database: paper_haxxj_com
-- ------------------------------------------------------
-- Server version	8.0.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `paper_base_product`
--

DROP TABLE IF EXISTS `paper_base_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paper_base_product` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '产品ID',
  `product` varchar(45) DEFAULT NULL COMMENT '产品名称',
  `product_weight` varchar(45) DEFAULT NULL COMMENT '克重',
  `product_unit` varchar(45) DEFAULT NULL COMMENT '单位',
  `product_price` double DEFAULT NULL COMMENT '价格',
  `company_id` int(10) DEFAULT NULL COMMENT '数据归属',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='产品信息';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paper_base_product`
--

LOCK TABLES `paper_base_product` WRITE;
/*!40000 ALTER TABLE `paper_base_product` DISABLE KEYS */;
INSERT INTO `paper_base_product` VALUES (1,'瓦楞纸','125克','千克',4.35,1),(2,'瓦楞纸','180克','千克',5.35,2),(3,'铜版纸','250克','kg',35.5,2),(4,'铜版纸','250克','kg',36.5,2),(5,'铜版纸','122','kg',23,2),(6,'铜版纸','123','kg',12,2),(7,'铜版纸','250克11','kg',123,2),(8,'铜版纸','250克11','kg',11,2),(9,'12','12','12',12,2),(10,'13','13','13',13,2);
/*!40000 ALTER TABLE `paper_base_product` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-02-23  1:36:56
