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
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8 COMMENT='销售主表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paper_sale_main`
--

LOCK TABLES `paper_sale_main` WRITE;
/*!40000 ALTER TABLE `paper_sale_main` DISABLE KEYS */;
INSERT INTO `paper_sale_main` VALUES (89,'XS-202102230004',1614093225,1,'淮安兴彩包装有限公司','淮安市洪泽区高良涧','13861578182','吴俊雷',2,2300,1.2,2760,'张三','Admin','大鱼',NULL,NULL,NULL,NULL,'2','1'),(93,'XS-202102170004',1614164103,1,'淮安兴彩包装有限公司','淮安市洪泽区高良涧','13861578182','吴俊雷',3,1489,1.25,1861.25,'张三','Admin','',NULL,NULL,NULL,NULL,'3','1'),(98,'XS-202102240006',1614179400,1,'淮安兴彩包装有限公司','淮安市洪泽区高良涧','13861578182','吴俊雷',5,613,53.71,32921.75,'张三','Admin','',NULL,NULL,NULL,NULL,'3','1'),(102,'XS-202102240008',1614180771,1,'淮安兴彩包装有限公司','淮安市洪泽区高良涧','13861578182','吴俊雷',3,2114,20.52,43389.5,'张三','Admin','',NULL,NULL,NULL,NULL,'3','1'),(106,'XS-202102240007',1614181624,1,'淮安兴彩包装有限公司','淮安市洪泽区高良涧','13861578182','吴俊雷',7,3724,74.26,276557,'张三','Admin','',NULL,NULL,NULL,NULL,'2','1'),(114,'XS-202102170005',1614183860,1,'淮安兴彩包装有限公司','淮安市洪泽区高良涧','13861578182','吴俊雷',10,14569,35.59,518438.7,'张三','Admin','',NULL,NULL,NULL,NULL,'2','1'),(116,'XS-202102250006',1614253570,1,'淮安兴彩包装有限公司','淮安市洪泽区高良涧','13861578182','吴俊雷',2,244,20.43,4983.7,'张三','Admin','',NULL,NULL,NULL,NULL,'1','1'),(122,'XS-202102250007',1614267202,1,'淮安兴彩包装有限公司','淮安市洪泽区高良涧','13861578182','吴俊雷',2,244,20.43,4983.7,'张三','Admin','0987',1614271131,NULL,'Admin',NULL,'1','1'),(127,'XS-202102250008',1614269295,1,'淮安兴彩包装有限公司','淮安市洪泽区高良涧','13861578182','吴俊雷',7,1846,81.04,149601.25,'张三','Admin','sks',1614271247,NULL,'Admin',NULL,'1','1'),(129,'XS-202102260001',1614297003,1,'淮安兴彩包装有限公司','淮安市洪泽区高良涧','13861578182','吴俊雷',1,1.23,35.5,43.66,'张三','富盛纸业','',NULL,NULL,NULL,NULL,'0','2'),(130,'XS-202102260002',1614305426,1,'淮安兴彩包装有限公司','淮安市洪泽区高良涧','13861578182','吴俊雷',1,122,123,15006,'张三','富盛纸业','9908',NULL,NULL,NULL,NULL,'0','2'),(131,'XS-202102260003',1614314665,1,'淮安兴彩包装有限公司','淮安市洪泽区高良涧','13861578182','吴俊雷',1,122,123,15006,'张三','富盛纸业','9908',NULL,NULL,NULL,NULL,'0','2');
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

-- Dump completed on 2021-03-08 22:29:36
