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
-- Table structure for table `paper_command`
--

DROP TABLE IF EXISTS `paper_command`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paper_command` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `type` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '类型',
  `params` varchar(1500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '参数',
  `command` varchar(1500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '命令',
  `content` text COMMENT '返回结果',
  `executetime` int(10) unsigned DEFAULT NULL COMMENT '执行时间',
  `createtime` int(10) unsigned DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(10) unsigned DEFAULT NULL COMMENT '更新时间',
  `status` enum('successed','failured') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'failured' COMMENT '状态',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COMMENT='在线命令表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paper_command`
--

LOCK TABLES `paper_command` WRITE;
/*!40000 ALTER TABLE `paper_command` DISABLE KEYS */;
INSERT INTO `paper_command` VALUES (1,'crud','[\"--table=paper_base_companyinfo\",\"--controller=base\\/companyinfo\"]','php think crud --table=paper_base_companyinfo --controller=base/companyinfo','Build Successed',1611135458,1611135458,1611135458,'successed'),(2,'crud','[\"--table=paper_base_product\",\"--controller=base\\/product\"]','php think crud --table=paper_base_product --controller=base/product','Build Successed',1611135479,1611135479,1611135480,'successed'),(3,'menu','[\"--controller=base\\/Companyinfo\",\"--controller=base\\/Product\"]','php think menu --controller=base/Companyinfo --controller=base/Product','Build Successed!',1611135529,1611135529,1611135531,'successed'),(4,'crud','[\"--table=paper_base_specs\",\"--controller=base\\/specs\"]','php think crud --table=paper_base_specs --controller=base/specs','Build Successed',1611141549,1611141549,1611141549,'successed'),(5,'crud','[\"--table=paper_base_grade\",\"--controller=base\\/grade\"]','php think crud --table=paper_base_grade --controller=base/grade','Build Successed',1611141562,1611141562,1611141562,'successed'),(6,'menu','[\"--controller=base\\/Specs\",\"--controller=base\\/Grade\"]','php think menu --controller=base/Specs --controller=base/Grade','Build Successed!',1611141576,1611141576,1611141576,'successed'),(7,'crud','[\"--table=paper_base_quality\",\"--controller=base\\/quality\"]','php think crud --table=paper_base_quality --controller=base/quality','Build Successed',1611141620,1611141620,1611141620,'successed'),(8,'menu','[\"--controller=base\\/Quality\"]','php think menu --controller=base/Quality','Build Successed!',1611141629,1611141629,1611141629,'successed'),(9,'crud','[\"--table=paper_setting_group\",\"--controller=setting\\/group\"]','php think crud --table=paper_setting_group --controller=setting/group','Build Successed',1611142730,1611142730,1611142730,'successed'),(10,'crud','[\"--table=paper_setting_machine\",\"--controller=setting\\/machine\"]','php think crud --table=paper_setting_machine --controller=setting/machine','Build Successed',1611142746,1611142746,1611142746,'successed'),(11,'crud','[\"--table=paper_setting_person\",\"--controller=setting\\/person\"]','php think crud --table=paper_setting_person --controller=setting/person','Build Successed',1611142760,1611142760,1611142760,'successed'),(12,'menu','[\"--controller=setting\\/Group\",\"--controller=setting\\/Machine\",\"--controller=setting\\/Person\"]','php think menu --controller=setting/Group --controller=setting/Machine --controller=setting/Person','Build Successed!',1611142777,1611142777,1611142777,'successed'),(13,'crud','[\"--table=paper_product_product\",\"--controller=product\\/product\"]','php think crud --table=paper_product_product --controller=product/product','Build Successed',1611143737,1611143737,1611143737,'successed'),(14,'menu','[\"--controller=product\\/Product\"]','php think menu --controller=product/Product','Build Successed!',1611143757,1611143757,1611143757,'successed'),(15,'crud','[\"--table=paper_sale_custom\",\"--controller=sale\\/custom\"]','php think crud --table=paper_sale_custom --controller=sale/custom','Build Successed',1611143775,1611143775,1611143775,'successed'),(16,'crud','[\"--table=paper_sale_custom\",\"--controller=sale\\/custom\"]','php think crud --table=paper_sale_custom --controller=sale/custom','controller already exists!\nIf you need to rebuild again, use the parameter --force=true',1611143807,1611143807,1611143807,'failured'),(17,'menu','[\"--controller=sale\\/Custom\"]','php think menu --controller=sale/Custom','Build Successed!',1611143820,1611143820,1611143820,'successed'),(18,'crud','[\"--table=paper_base_storage\",\"--controller=base\\/storage\"]','php think crud --table=paper_base_storage --controller=base/storage','Build Successed',1611155479,1611155479,1611155479,'successed'),(19,'menu','[\"--controller=base\\/Storage\"]','php think menu --controller=base/Storage','Build Successed!',1611155490,1611155490,1611155491,'successed'),(20,'menu','[\"--controller=product\\/Product\"]','php think menu --controller=product/Product','Build Successed!',1611159770,1611159770,1611159770,'successed'),(21,'menu','[\"--controller=product\\/Product\"]','php think menu --controller=product/Product','Build Successed!',1611287762,1611287762,1611287762,'successed'),(22,'menu','[\"--controller=product\\/Product\"]','php think menu --controller=product/Product','Build Successed!',1611287768,1611287768,1611287768,'successed'),(23,'crud','[\"--table=paper_sale_main\",\"--controller=sale\\/mainlist\",\"--headingfilterfield=sale_status\"]','php think crud --table=paper_sale_main --controller=sale/mainlist --headingfilterfield=sale_status','Build Successed',1611327670,1611327670,1611327670,'successed'),(24,'menu','[\"--controller=sale\\/Mainlist\"]','php think menu --controller=sale/Mainlist','Build Successed!',1611327687,1611327687,1611327687,'successed'),(25,'crud','[\"--force=1\",\"--table=paper_sale_main\",\"--controller=sale\\/mainlist\",\"--headingfilterfield=sale_status\"]','php think crud --force=1 --table=paper_sale_main --controller=sale/mainlist --headingfilterfield=sale_status','Build Successed',1611327764,1611327764,1611327764,'successed'),(26,'crud','[\"--force=1\",\"--table=paper_sale_detail\",\"--controller=sale\\/detaillist\"]','php think crud --force=1 --table=paper_sale_detail --controller=sale/detaillist','Build Successed',1611327805,1611327805,1611327805,'successed'),(27,'menu','[\"--controller=sale\\/Mainlist\",\"--controller=sale\\/Detaillist\"]','php think menu --controller=sale/Mainlist --controller=sale/Detaillist','Build Successed!',1611327819,1611327819,1611327819,'successed'),(28,'crud','[\"--force=1\",\"--table=paper_sale_custom\",\"--controller=sale\\/custom\"]','php think crud --force=1 --table=paper_sale_custom --controller=sale/custom','Build Successed',1611758379,1611758379,1611758379,'successed'),(29,'crud','[\"--force=1\",\"--table=paper_sale_custom\",\"--controller=sale\\/custom\"]','php think crud --force=1 --table=paper_sale_custom --controller=sale/custom','Build Successed',1611760090,1611760090,1611760090,'successed'),(30,'crud','[\"--table=paper_sale_main\",\"--controller=sale\\/saledraft\"]','php think crud --table=paper_sale_main --controller=sale/saledraft','Build Successed',1611903571,1611903571,1611903571,'successed');
/*!40000 ALTER TABLE `paper_command` ENABLE KEYS */;
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
