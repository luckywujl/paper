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
-- Table structure for table `paper_admin`
--

DROP TABLE IF EXISTS `paper_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paper_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '用户名',
  `nickname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '昵称',
  `password` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '密码',
  `salt` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '密码盐',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '头像',
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '电子邮箱',
  `loginfailure` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '失败次数',
  `logintime` int(10) DEFAULT NULL COMMENT '登录时间',
  `loginip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '登录IP',
  `createtime` int(10) DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(10) DEFAULT NULL COMMENT '更新时间',
  `token` varchar(59) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'Session标识',
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal' COMMENT '状态',
  `company_id` int(10) DEFAULT NULL COMMENT '数据归属',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paper_admin`
--

LOCK TABLES `paper_admin` WRITE;
/*!40000 ALTER TABLE `paper_admin` DISABLE KEYS */;
INSERT INTO `paper_admin` VALUES (1,'admin','Admin','e577a91a95b6d7d895e84de5076600aa','488f89','/uploads/20210120/2e2b656725e591271de4e818a29091c0.jpg','admin@admin.com',0,1615209518,'127.0.0.1',1492186163,1615209982,'','normal',1),(2,'1001','富盛纸业','3e25ca433da7e2d3b0240612b859fa3b','6HwWyX','/uploads/20210120/295d6792aa9f922dbdeb0bc0710d64dd.jpg','1001@qq.com',0,1615209986,'127.0.0.1',1611136410,1615209986,'0fcb9b5d-7082-4fad-8810-429ff044b7f8','normal',2),(3,'2001','车间生产','98107569ec4d32c80bd7eb1847eb1bd6','HWNQVD','/assets/img/avatar.png','2001@qq.com',0,1614314993,'127.0.0.1',1614314781,1614314993,'d4214900-0e46-4800-981a-4d08ac143b84','normal',2);
/*!40000 ALTER TABLE `paper_admin` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-08 22:29:34
