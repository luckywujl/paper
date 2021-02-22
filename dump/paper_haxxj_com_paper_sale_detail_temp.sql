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
-- Table structure for table `paper_sale_detail_temp`
--

DROP TABLE IF EXISTS `paper_sale_detail_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paper_sale_detail_temp` (
  `detail_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '销售明细ID',
  `detail_sale_id` int(10) DEFAULT NULL COMMENT '销售主表ID',
  `detail_no` int(5) DEFAULT NULL COMMENT '序号',
  `detail_product_name` varchar(45) DEFAULT NULL COMMENT '产品名称',
  `detail_product_productweight` varchar(45) DEFAULT NULL COMMENT '克重',
  `detail_grade` varchar(45) DEFAULT NULL COMMENT '产品等级',
  `detail_quality` varchar(45) DEFAULT NULL COMMENT '产品品质',
  `detail_specs` varchar(45) DEFAULT NULL COMMENT '规格',
  `detail_unit` varchar(45) DEFAULT NULL COMMENT '单位',
  `detail_price` double DEFAULT NULL COMMENT '单价',
  `detail_weight` double DEFAULT NULL COMMENT '重量',
  `detail_number` int(5) DEFAULT NULL COMMENT '数量',
  `detail_amount` double DEFAULT NULL COMMENT '金额',
  `detail_detail` tinytext COMMENT '明细重量',
  `detail_remark` tinytext COMMENT '明细备注',
  `company_id` varchar(45) DEFAULT NULL COMMENT '数据归属',
  PRIMARY KEY (`detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=196 DEFAULT CHARSET=utf8 COMMENT='临时销售明细表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paper_sale_detail_temp`
--

LOCK TABLES `paper_sale_detail_temp` WRITE;
/*!40000 ALTER TABLE `paper_sale_detail_temp` DISABLE KEYS */;
INSERT INTO `paper_sale_detail_temp` VALUES (183,34,1,'铜版纸','250克','一级品','全新纸','1200mm','kg',35.5,1367,2,48528.5,'(122)(1245)',NULL,'2'),(184,34,2,'瓦楞纸','180克','一级品','全新纸','1200mm','千克',5.35,122,1,652.7,'(122)',NULL,'2');
/*!40000 ALTER TABLE `paper_sale_detail_temp` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-02-23  1:36:57
