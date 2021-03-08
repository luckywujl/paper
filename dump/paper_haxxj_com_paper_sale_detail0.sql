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
-- Table structure for table `paper_sale_detail`
--

DROP TABLE IF EXISTS `paper_sale_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paper_sale_detail` (
  `detail_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '销售明细ID',
  `detail_sale_code` varchar(45) DEFAULT NULL COMMENT '销售主表ID',
  `detail_no` int(5) DEFAULT NULL COMMENT '序号',
  `detail_product_id` int(10) DEFAULT NULL COMMENT '产品ID',
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
) ENGINE=InnoDB AUTO_INCREMENT=223 DEFAULT CHARSET=utf8 COMMENT='销售明细';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paper_sale_detail`
--

LOCK TABLES `paper_sale_detail` WRITE;
/*!40000 ALTER TABLE `paper_sale_detail` DISABLE KEYS */;
INSERT INTO `paper_sale_detail` VALUES (1,'XS-202102170001',1,NULL,'铜版纸','250克','一级品','全新纸','1200mm','kg',3.5,1367,2,4784.5,'(122)(1245)','好难搞啊',NULL),(2,'XS-202102170001',2,NULL,'瓦楞纸','180克','一级品','全新纸','1200mm','千克',0.5,122,1,61,'(122)','',NULL),(3,'XS-202102170002',1,NULL,'铜版纸','250克','一级品','全新纸','1200mm','kg',35.5,1367,2,48528.5,'(122)(1245)','不好玩','1'),(4,'XS-202102170002',2,NULL,'瓦楞纸','180克','一级品','全新纸','1200mm','千克',5.35,122,1,652.7,'(122)',NULL,'1'),(5,'XS-202102170003',1,NULL,'铜版纸','250克','一级品','全新纸','1200mm','kg',35.5,1367,2,48528.5,'(122)(1245)','不好玩','1'),(6,'XS-202102170003',2,NULL,'瓦楞纸','180克','一级品','全新纸','1200mm','千克',5.35,122,1,652.7,'(122)',NULL,'1'),(7,'XS-202102170003',1,NULL,'铜版纸','250克','一级品','全新纸','1200mm','kg',35.5,1367,2,48528.5,'(122)(1245)','不好玩','1'),(8,'XS-202102170003',2,NULL,'瓦楞纸','180克','一级品','全新纸','1200mm','千克',5.35,122,1,652.7,'(122)',NULL,'1'),(9,'XS-202102170003',1,NULL,'铜版纸','250克','一级品','全新纸','1200mm','kg',35.5,1367,2,48528.5,'(122)(1245)','不好玩','1'),(10,'XS-202102170003',2,NULL,'瓦楞纸','180克','一级品','全新纸','1200mm','千克',5.35,122,1,652.7,'(122)',NULL,'1'),(11,'XS-202102170003',1,NULL,'铜版纸','250克','一级品','全新纸','1200mm','kg',35.5,1367,2,48528.5,'(122)(1245)','不好玩','1'),(12,'XS-202102170003',2,NULL,'瓦楞纸','180克','一级品','全新纸','1200mm','千克',5.35,122,1,652.7,'(122)',NULL,'1'),(17,'XS-202102230001',1,NULL,'瓦楞纸','180克','一级品','全新纸','1200mm','千克',5.35,122,1,652.7,'(122)',NULL,'1'),(32,'XS-202102230002',1,NULL,'铜版纸','250克','一级品','全新纸','1200mm','kg',3,1200,1,3600,'(1200)','','1'),(41,'XS-202102230003',1,NULL,'铜版纸','250克','一级品','全新纸','1200mm','kg',35.5,1367,2,48528.5,'(122)(1245)',NULL,'1'),(42,'XS-202102230003',2,NULL,'瓦楞纸','180克','一级品','全新纸','1200mm','千克',5.35,122,1,652.7,'(122)',NULL,'1'),(56,'XS-202102230001',1,NULL,'铜版纸','250克','一级品','全新纸','1200mm','kg',0,1367,2,0,'','','2'),(57,'XS-202102230001',2,NULL,'瓦楞纸','180克','一级品','全新纸','1200mm','千克',5.35,122,1,652.7,NULL,'','2'),(68,'XS-202102230004',1,NULL,'铜版纸','250克','一级品','回笼纸','1200mm','kg',0,1200,1,0,NULL,'','1'),(69,'XS-202102230004',2,NULL,'铜版纸','250克11','一级品','回笼纸','1200mm','kg',0,1100,1,0,NULL,'','1'),(76,'XS-202102170004',1,NULL,'铜版纸','250克','一级品','全新纸','1200mm','kg',0,1367,2,0,'','','1'),(77,'XS-202102170004',2,NULL,'瓦楞纸','180克','一级品','全新纸','1200mm','千克',0,122,1,0,'','','1'),(91,'XS-202102240006',1,NULL,'瓦楞纸','180克','一级品','回笼纸','1200mm','千克',5.35,122,1,652.7,NULL,NULL,'1'),(92,'XS-202102240006',2,NULL,'瓦楞纸','180克','一级品','全新纸','1200mm','千克',5.35,123,1,658.05,NULL,NULL,'1'),(93,'XS-202102240006',3,NULL,'铜版纸','250克11','一级品','全新纸','1200mm','kg',123,245,2,30135,NULL,NULL,'1'),(94,'XS-202102240006',4,NULL,'铜版纸','123','一级品','全新纸','1200mm','kg',12,123,1,1476,NULL,NULL,'1'),(109,'XS-202102240008',1,NULL,'铜版纸','250克','一级品','全新纸','1200mm','kg',35.5,1064,2,37772,'(12)(1052)',NULL,'1'),(110,'XS-202102240008',2,NULL,'瓦楞纸','180克','一级品','全新纸','1200mm','千克',5.35,1050,1,5617.5,'(1050)',NULL,'1'),(129,'XS-202102240007',1,NULL,'铜版纸','250克','二级品','回笼纸','1200mm','kg',35.5,122,1,4331,'(122)',NULL,'1'),(130,'XS-202102240007',2,NULL,'铜版纸','250克','一级品','全新纸','1200mm','kg',35.5,246,2,8733,'(123)(123)',NULL,'1'),(131,'XS-202102240007',3,NULL,'铜版纸','250克11','一级品','全新纸','1200mm','kg',123,1111,1,136653,'(1111)',NULL,'1'),(132,'XS-202102240007',4,NULL,'铜版纸','123','一级品','全新纸','1200mm','kg',12,123,1,1476,'(123)(1222)',NULL,'1'),(133,'XS-202102240007',5,NULL,'铜版纸','123','一级品','全新纸','1200mm','kg',12,1222,1,14664,'(123)(1222)',NULL,'1'),(134,'XS-202102240007',6,NULL,'铜版纸','250克11','一级品','回笼纸','1200mm','kg',123,900,1,110700,'(900)',NULL,'1'),(170,'XS-202102170005',1,NULL,'铜版纸','250克','一级品','全新纸','1200mm','kg',35.5,13957,5,495473.5,'122,123,122,12345,1245,',NULL,'1'),(171,'XS-202102170005',2,NULL,'瓦楞纸','180克','一级品','全新纸','1200mm','千克',5.35,122,1,652.7,'122,',NULL,'1'),(172,'XS-202102170005',3,NULL,'铜版纸','250克11','一级品','全新纸','1200mm','kg',123,122,1,15006,'122,',NULL,'1'),(173,'XS-202102170005',4,NULL,'铜版纸','123','二级品','全新纸','1200mm','kg',12,245,2,2940,'123,122,',NULL,'1'),(174,'XS-202102170005',5,NULL,'铜版纸','250克','二级品','回笼纸','1200mm','kg',35.5,123,1,4366.5,'123,',NULL,'1'),(185,'XS-202102250006',1,NULL,'铜版纸','250克','一级品','全新纸','1200mm','kg',35.5,122,1,4331,'122,',NULL,'1'),(186,'XS-202102250006',2,NULL,'瓦楞纸','180克','一级品','全新纸','1200mm','千克',5.35,122,1,652.7,'122,',NULL,'1'),(192,'XS-202102250007',1,NULL,'铜版纸','250克','一级品','全新纸','1200mm','kg',35.5,122,1,4331,'122,',NULL,'1'),(193,'XS-202102250007',2,NULL,'瓦楞纸','180克','一级品','全新纸','1200mm','千克',5.35,122,1,652.7,'122,',NULL,'1'),(214,'XS-202102250008',1,NULL,'铜版纸','123','二级品','全新纸','1200mm','kg',12,245,2,2940,'123,122,','全新料123456789','1'),(215,'XS-202102250008',2,NULL,'铜版纸','250克','二级品','回笼纸','1200mm','kg',35.5,245,2,8697.5,'123,122,',NULL,'1'),(216,'XS-202102250008',3,NULL,'铜版纸','250克11','一级品','全新纸','1200mm','kg',123,1111,1,136653,'1111,',NULL,'1'),(217,'XS-202102250008',4,NULL,'瓦楞纸','180克','一级品','回笼纸','1200mm','千克',5.35,122,1,652.7,'122,',NULL,'1'),(218,'XS-202102250008',5,NULL,'瓦楞纸','180克','一级品','全新纸','1200mm','千克',5.35,123,1,658.05,'123,',NULL,'1'),(220,'XS-202102260001',1,NULL,'铜版纸','250克','一级品','全新纸','1200mm','kg',35.5,1.23,1,43.66,'1.23,',NULL,'2'),(221,'XS-202102260002',1,NULL,'铜版纸','250克11','一级品','全新纸','1200mm','kg',123,122,1,15006,'122,',NULL,'2'),(222,'XS-202102260003',1,NULL,'铜版纸','250克11','一级品','全新纸','1200mm','kg',123,122,1,15006,'122,',NULL,'2');
/*!40000 ALTER TABLE `paper_sale_detail` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-08 22:29:35
