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
-- Table structure for table `paper_sale_main`
--

DROP TABLE IF EXISTS `paper_sale_main`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paper_sale_main` (
  `sale_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '销售ID',
  `sale_code` varchar(45) DEFAULT NULL COMMENT '销售单号',
  `sale_datetime` int(11) DEFAULT NULL COMMENT '销售日期',
  `sale_custom_id` int(10) DEFAULT NULL COMMENT '客户ID',
  `sale_custom_name` varchar(45) DEFAULT NULL COMMENT '客户名称',
  `sale_custom_address` varchar(255) DEFAULT NULL COMMENT '客户地址',
  `sale_custom_tel` varchar(45) DEFAULT NULL COMMENT '联系电话',
  `sale_custom_contact` varchar(45) DEFAULT NULL COMMENT '联系人',
  `sale_number` int(10) DEFAULT NULL COMMENT '总件数',
  `sale_weight` double DEFAULT NULL COMMENT '总重量',
  `sale_price` double DEFAULT NULL COMMENT '单价',
  `sale_amount` double DEFAULT NULL COMMENT '总金额',
  `sale_person` varchar(45) DEFAULT NULL COMMENT '经办人',
  `sale_operator` varchar(45) DEFAULT NULL COMMENT '开单人',
  `sale_remark` tinytext COMMENT '备注',
  `sale_verify_datetime` int(10) DEFAULT NULL COMMENT '审核日期',
  `sale_collection_datetime` int(10) DEFAULT NULL COMMENT '收款日期',
  `sale_verify_person` varchar(45) DEFAULT NULL COMMENT '审核人',
  `sale_collection_person` varchar(45) DEFAULT NULL COMMENT '收款人',
  `sale_status` enum('0','1','2','3') DEFAULT NULL COMMENT '单据状态:0=未审核,1=已审核,2=已收款,3=已作废',
  `company_id` varchar(45) DEFAULT NULL COMMENT '数据归属',
  PRIMARY KEY (`sale_id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8 COMMENT='销售主表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paper_sale_main`
--

LOCK TABLES `paper_sale_main` WRITE;
/*!40000 ALTER TABLE `paper_sale_main` DISABLE KEYS */;
INSERT INTO `paper_sale_main` VALUES (26,'XS-202102150001',1613388260,1,'淮安兴彩包装有限公司','淮安市洪泽区高良涧','13861578182','吴俊雷',1,1200,3.45,234,'张三','Admin','测试',NULL,NULL,NULL,NULL,'0','1'),(40,'XS-202102150004',1613396418,1,'淮安兴彩包装有限公司','淮安市洪泽区高良涧','13861578182','吴俊雷',0,0,0,0,'','Admin','',NULL,NULL,NULL,NULL,'0','1'),(55,'XS-202102170001',1613574439,1,'淮安兴彩包装有限公司','淮安市洪泽区高良涧','13861578182','吴俊雷',3,1489,0,4845.5,'张三','Admin','',NULL,NULL,NULL,NULL,'0','1'),(56,'XS-202102170002',1613574579,1,'淮安兴彩包装有限公司','淮安市洪泽区高良涧','13861578182','吴俊雷',3,1489,0,4845.5,'张三','Admin','',NULL,NULL,NULL,NULL,'0','1'),(57,'XS-202102170003',1613575096,1,'淮安兴彩包装有限公司','淮安市洪泽区高良涧','13861578182','吴俊雷',3,1489,0,4845.5,'张三','Admin','',NULL,NULL,NULL,NULL,'0','1'),(58,'XS-202102170004',1613575360,1,'淮安兴彩包装有限公司','淮安市洪泽区高良涧','13861578182','吴俊雷',3,1489,0,4845.5,'张三','Admin','',NULL,NULL,NULL,NULL,'0','1'),(60,'XS-202102230001',1614012540,1,'淮安兴彩包装有限公司','淮安市洪泽区高良涧','13861578182','吴俊雷',1,122,5.35,652.7,'张三','Admin','',NULL,NULL,NULL,NULL,'0','1'),(66,'XS-202102170006',1614013790,1,'淮安兴彩包装有限公司','淮安市洪泽区高良涧','13861578182','吴俊雷',3,1489,33.03,49181.2,'张三','Admin','',NULL,NULL,NULL,NULL,'0','1'),(67,'XS-202102170005',1614014557,1,'淮安兴彩包装有限公司','淮安市洪泽区高良涧','13861578182','吴俊雷',3,1489,33.03,49181.2,'张三','Admin','',NULL,NULL,NULL,NULL,'0','1'),(68,'XS-202102230002',1614014656,1,'淮安兴彩包装有限公司','淮安市洪泽区高良涧','13861578182','吴俊雷',1,1200,3,3600,'张三','Admin','',NULL,NULL,NULL,NULL,'0','1');
/*!40000 ALTER TABLE `paper_sale_main` ENABLE KEYS */;
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
