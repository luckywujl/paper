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
-- Table structure for table `paper_product_product`
--

DROP TABLE IF EXISTS `paper_product_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paper_product_product` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '产品信息ID',
  `product_code` varchar(45) DEFAULT NULL COMMENT '产品编码',
  `product_name` varchar(45) DEFAULT NULL COMMENT '产品名称',
  `product_productweight` varchar(45) DEFAULT NULL COMMENT '克重',
  `product_grade` varchar(45) DEFAULT NULL COMMENT '产品等级',
  `product_quality` varchar(45) DEFAULT NULL COMMENT '品质',
  `product_specs` varchar(45) DEFAULT NULL COMMENT '规格',
  `product_unit` varchar(45) DEFAULT NULL COMMENT '单位',
  `product_weight` double DEFAULT NULL COMMENT '重量',
  `product_diameter` varchar(45) DEFAULT NULL COMMENT '卷径',
  `product_broken` int(2) DEFAULT NULL COMMENT '接头数量',
  `product_mother_code` varchar(45) DEFAULT NULL COMMENT '母卷编号',
  `product_storage` varchar(45) DEFAULT NULL COMMENT '存储仓库',
  `product_product_datetime` int(11) DEFAULT NULL COMMENT '生产日期',
  `product_inbound_datetime` int(11) DEFAULT NULL COMMENT '入库日期',
  `product_sale_datetime` int(11) DEFAULT NULL COMMENT '销售日期',
  `product_group` varchar(45) DEFAULT NULL COMMENT '生产班组',
  `product_machine` varchar(45) DEFAULT NULL COMMENT '生产机组',
  `product_operator` varchar(45) DEFAULT NULL COMMENT '生产人员',
  `product_QC` varchar(45) DEFAULT NULL COMMENT '品控员',
  `product_sale_code` varchar(45) DEFAULT NULL COMMENT '销售单号',
  `product_sale_operator` varchar(45) DEFAULT NULL COMMENT '开单人',
  `product_sale_person` varchar(45) DEFAULT NULL COMMENT '销售人员',
  `product_status` enum('0','1','2','3') DEFAULT NULL COMMENT '产品状态:0=生产,1=入库,2=销售中,3=开单中,4=已售',
  `company_id` int(10) DEFAULT NULL COMMENT '数据归属',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COMMENT='产品信息库';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paper_product_product`
--

LOCK TABLES `paper_product_product` WRITE;
/*!40000 ALTER TABLE `paper_product_product` DISABLE KEYS */;
INSERT INTO `paper_product_product` VALUES (1,'202101200001','铜版纸','250克','一级品','全新纸','1200mm','kg',122,'1200mm',1,'123456','主仓库',1611157782,1611157782,1613575410,'丙班','一号机组','富盛纸业','张三','XS-202102170005',NULL,NULL,'3',2),(2,'202101200002','瓦楞纸','180克','一级品','全新纸','1200mm','kg',122,'1200mm',1,'123456','主仓库',1611158078,1611158078,1613575410,'丙班','一号机组','富盛纸业','张三','XS-202102170005',NULL,NULL,'3',2),(3,'202101210001','铜版纸','250克11','一级品','全新纸','1200mm','kg',122,'1200mm',1,'123456','主仓库',1611158568,1611158568,NULL,'乙班','二号机组','富盛纸业','张三',NULL,NULL,NULL,NULL,2),(4,'202101210002','铜版纸','250克','一级品','全新纸','1200mm','kg',123,'1200mm',1,'123456','主仓库',1611158665,1611158665,NULL,'丙班','一号机组','富盛纸业','张三',NULL,NULL,NULL,NULL,2),(7,'202101210003','铜版纸','123','二级品','全新纸','1200mm','kg',123,'1200mm',1,'123456','主仓库',1611160379,1611160379,NULL,'丙班','一号机组','富盛纸业','张三',NULL,NULL,NULL,NULL,2),(10,'202101210004','铜版纸','123','二级品','全新纸','1200mm','kg',122,'1200mm',2,'123456','主仓库',1611160821,1611160821,NULL,'丙班','一号机组','富盛纸业','张三',NULL,NULL,NULL,NULL,2),(11,'202101220001','铜版纸','250克','一级品','全新纸','1200mm','kg',122,'1200mm',1,'123456','主仓库',1611286099,1611286099,NULL,'丙班','一号机组','富盛纸业','张三',NULL,NULL,NULL,NULL,2),(12,'202101220002','铜版纸','250克','一级品','全新纸','1200mm','kg',12345,'1200mm',2,'123456','主仓库',1611286346,1611286346,NULL,'丙班','一号机组','富盛纸业','张三',NULL,NULL,NULL,NULL,2),(13,'202101220003','铜版纸','250克','二级品','回笼纸','1200mm','kg',123,'1200mm',2,'123456','主仓库',1611288701,1611288701,NULL,'丙班','二号机组','富盛纸业','张三',NULL,NULL,NULL,NULL,2),(14,'202101220004','铜版纸','250克','二级品','回笼纸','1200mm','kg',122,'1200mm',1,'123456','主仓库',1611288992,1611288992,NULL,'丙班','二号机组','富盛纸业','张三',NULL,NULL,NULL,NULL,2),(15,'202101220005','铜版纸','250克','一级品','全新纸','1200mm','kg',123,'1200mm',1,'123456','主仓库',1611289269,1611289269,NULL,'丙班','一号机组','富盛纸业','张三',NULL,NULL,NULL,NULL,2),(16,'202101220006','铜版纸','250克','一级品','全新纸','1200mm','kg',123,'1200mm',0,'123456','主仓库',1611289281,1611289281,NULL,'丙班','一号机组','富盛纸业','张三',NULL,NULL,NULL,NULL,2),(17,'202101220007','铜版纸','250克11','一级品','全新纸','1200mm','kg',1111,'1200mm',1,'123456','主仓库',1611289975,1611289975,NULL,'丙班','一号机组','富盛纸业','张三',NULL,NULL,NULL,NULL,2),(18,'202101220008','瓦楞纸','180克','一级品','回笼纸','1200mm','kg',122,'1200mm',1,'123456','主仓库',1611290116,1611290116,NULL,'丙班','一号机组','富盛纸业','张三',NULL,NULL,NULL,NULL,2),(19,'202101220009','瓦楞纸','180克','一级品','全新纸','1200mm','kg',123,'1200mm',1,'123456','主仓库',1611290168,1611290168,NULL,'丙班','一号机组','富盛纸业','张三',NULL,NULL,NULL,NULL,2),(20,'202101220010','铜版纸','250克11','一级品','全新纸','1200mm','kg',122,'1200mm',1,'123456','主仓库',1611290229,1611290229,NULL,'丙班','一号机组','富盛纸业','张三',NULL,NULL,NULL,NULL,2),(21,'202101220001','铜版纸','123','一级品','全新纸','1200mm','kg',123,'12',1,'123','主仓库',1611290293,1611290293,NULL,'','','Admin','',NULL,NULL,NULL,NULL,1),(22,'202101220011','铜版纸','250克11','一级品','全新纸','1200mm','kg',123,'',0,'123456','主仓库',1611290339,1611290339,NULL,'丙班','一号机组','富盛纸业','张三',NULL,NULL,NULL,NULL,2),(23,'202101220012','铜版纸','123','一级品','全新纸','1200mm','',123,'1200mm',0,'','主仓库',1611290424,1611290424,NULL,'','','富盛纸业','',NULL,NULL,NULL,NULL,2),(24,'202101220013','铜版纸','123','一级品','全新纸','1200mm','kg',1222,'',0,'','主仓库',1611290444,1611290444,NULL,'','','富盛纸业','',NULL,NULL,NULL,NULL,2),(25,'202101220002','铜版纸','250克','一级品','全新纸','1200mm','kg',1234,'1245',1,'12345','主仓库',1611294684,1611294684,NULL,'丙班','一号机组','Admin','张三','13','','','0',1),(26,'202101220014','铜版纸','250克','一级品','全新纸','1200mm','kg',1200,'1200mm',1,'123456','主仓库',1611303486,1611303486,NULL,'丙班','一号机组','富盛纸业','张三',NULL,NULL,NULL,NULL,2),(27,'202101220015','铜版纸','250克','一级品','全新纸','1200mm','kg',12,'',0,'123456','主仓库',1611303730,1611303730,NULL,'丙班','一号机组','富盛纸业','张三',NULL,NULL,NULL,NULL,2),(28,'202101220016','铜版纸','250克','一级品','全新纸','1200mm','kg',1052,'1200mm',2,'123456','主仓库',1611304237,1611304237,NULL,'丙班','一号机组','富盛纸业','张三',NULL,NULL,NULL,NULL,2),(29,'202101220017','瓦楞纸','180克','一级品','全新纸','1200mm','kg',1050,'1200mm',1,'A569825','主仓库',1611304627,1611304627,NULL,'甲班','一号机组','富盛纸业','张三',NULL,NULL,NULL,NULL,2),(30,'202101270001','铜版纸','250克11','一级品','回笼纸','1200mm','',900,'',0,'','主仓库',1611757360,1611757360,NULL,'丙班','一号机组','富盛纸业','张三',NULL,NULL,NULL,NULL,2),(31,'202102150001','瓦楞纸','125克','二级品','回笼纸','1200mm',' 林',12,'12',0,'0000','主仓库',1613403006,1613403006,NULL,'丙班','一号机组','Admin','张三',NULL,NULL,NULL,'',1),(32,'202102170001','铜版纸','250克','一级品','全新纸','1200mm','kg',1245,'900mm',1,'234567','主仓库',1613532697,1613532697,1613575410,'甲班','一号机组','Admin','张三','XS-202102170005',NULL,NULL,'3',1),(33,'202102220001','铜版纸','250克','一级品','全新纸','1200mm','kg',1200,'1200',2,'1234567','主仓库',1613953026,1613953026,1614014656,'丙班','一号机组','Admin','张三','XS-202102230002',NULL,NULL,'3',1);
/*!40000 ALTER TABLE `paper_product_product` ENABLE KEYS */;
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
