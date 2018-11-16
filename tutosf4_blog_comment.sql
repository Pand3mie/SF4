-- MySQL dump 10.13  Distrib 8.0.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: tutosf4
-- ------------------------------------------------------
-- Server version	8.0.12

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `blog_comment`
--

DROP TABLE IF EXISTS `blog_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `blog_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_post_id` int(11) DEFAULT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_at` datetime NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7882EFEFB8FA613C` (`comment_post_id`),
  CONSTRAINT `FK_7882EFEFB8FA613C` FOREIGN KEY (`comment_post_id`) REFERENCES `blog_post` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_comment`
--

LOCK TABLES `blog_comment` WRITE;
/*!40000 ALTER TABLE `blog_comment` DISABLE KEYS */;
INSERT INTO `blog_comment` VALUES (4,2,'mana','fzfrferfe','2018-10-30 13:36:40','nicolasfouche@free.fr'),(10,2,'mana','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed commodo lorem, in egestas tortor. Nullam at leo sed dui consequat ultrices vel eget nunc. Vestibulum vulputate neque ut accumsan malesuada. Sed aliquet dolor mi, nec volutpat dui porttitor eget. Mauris odio nulla, dictum quis nulla a, vehicula mattis enim. Curabitur sit amet nunc convallis, fermentum enim id, rhoncus mauris. Nam purus ex, iaculis at ligula quis, pellentesque viverra libero. Pellentesque consequat lorem dui, quis consequat mi placerat sed. Nulla a faucibus urna.\r\n\r\nMauris aliquam massa id augue eleifend, non fringilla metus efficitur. Suspendisse vitae mauris et diam vestibulum elementum eu ut eros. Phasellus sollicitudin velit imperdiet, tempor ex a, ultrices nulla. In non erat sed nulla ultrices dignissim. Donec fermentum lectus pharetra, malesuada nibh at, sagittis metus. Etiam consequat at dui ut accumsan. Maecenas non ante risus. Nullam vitae orci ac lectus pellentesque molestie ac ac turpis.','2018-10-30 14:13:13','nicolasfouche@free.fr'),(11,23,'mana','fregzegtzgtrezgtrzgre','2018-10-30 15:03:59','nicolasfouche@free.fr'),(12,27,'mana','Integer in sagittis lectus. Sed vestibulum vehicula pellentesque. Donec ultricies, ante non scelerisque sagittis, metus odio congue lectus, ac mollis augue justo ac neque. Nunc rhoncus blandit ex eu aliquet. Nulla malesuada risus dictum, fringilla risus mollis, malesuada sem. Integer tincidunt volutpat leo at feugiat. Vestibulum in scelerisque lacus. Nunc posuere vel mi vel ullamcorper. Proin egestas dui sit amet ultrices lacinia. Nunc efficitur metus vitae tortor rhoncus pretium. Integer finibus nulla nec cursus molestie.\r\n\r\nCurabitur leo tellus, dapibus id nulla in, pharetra dapibus odio. Curabitur in sodales est. Donec aliquet rhoncus quam ut sagittis. Pellentesque vel justo ullamcorper, elementum enim a, ornare augue. Nulla lacus lectus, vestibulum ut auctor et, consequat vel dui. Curabitur non neque imperdiet, pharetra mi vitae, vestibulum augue. Vivamus sodales augue quis pharetra facilisis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam et sagittis leo. Vestibulum nulla justo, malesuada ut leo vel, porttitor sollicitudin ante.','2018-10-30 15:51:12','nicolasfouche@free.fr'),(13,27,'mana','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris interdum elit at nisl cursus mattis. Quisque cursus luctus nisi congue finibus. Maecenas hendrerit, purus a maximus lacinia, tortor nulla interdum odio, at pellentesque magna sem id sapien. Sed gravida laoreet viverra. Maecenas volutpat tincidunt quam nec pretium. Donec et erat a odio vestibulum interdum. Vivamus ullamcorper metus nec sodales tincidunt. Suspendisse congue mauris quis metus molestie tincidunt. Sed at congue odio. Ut rhoncus diam quis augue vulputate lobortis. Praesent aliquam rutrum massa, sit amet posuere turpis porta a. Sed fringilla nulla eget mi elementum ornare.\r\n\r\nInteger in sagittis lectus. Sed vestibulum vehicula pellentesque. Donec ultricies, ante non scelerisque sagittis, metus odio congue lectus, ac mollis augue justo ac neque. Nunc rhoncus blandit ex eu aliquet. Nulla malesuada risus dictum, fringilla risus mollis, malesuada sem. Integer tincidunt volutpat leo at feugiat. Vestibulum in scelerisque lacus. Nunc posuere vel mi vel ullamcorper. Proin egestas dui sit amet ultrices lacinia. Nunc efficitur metus vitae tortor rhoncus pretium. Integer finibus nulla nec cursus molestie.\r\n\r\nCurabitur leo tellus, dapibus id nulla in, pharetra dapibus odio. Curabitur in sodales est. Donec aliquet rhoncus quam ut sagittis. Pellentesque vel justo ullamcorper, elementum enim a, ornare augue. Nulla lacus lectus, vestibulum ut auctor et, consequat vel dui. Curabitur non neque imperdiet, pharetra mi vitae, vestibulum augue. Vivamus sodales augue quis pharetra facilisis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam et sagittis leo. Vestibulum nulla justo, malesuada ut leo vel, porttitor sollicitudin ante.\r\n\r\nMaecenas mollis eleifend mattis. Aenean sit amet condimentum lectus. Sed facilisis consequat est, vel lobortis nisi lacinia sit amet. Aenean suscipit ante nunc, quis porta tortor vulputate at. Sed consequat risus magna, sit amet volutpat massa facilisis quis. Vestibulum blandit, nisi sed lacinia porta, ex turpis tincidunt dolor, ut ornare enim nunc eu mauris. Morbi eu tempus elit. Duis tellus magna, hendrerit a ligula eu, fringilla feugiat metus. Sed eu risus mattis, feugiat ligula ut, laoreet augue. Mauris sit amet imperdiet felis. Mauris id odio vulputate, maximus justo quis, placerat libero. Proin ultricies ut ipsum ut condimentum.','2018-10-30 15:57:16','nicolasfouche@free.fr'),(14,27,'mana','Nam vel augue a nunc malesuada dignissim. Mauris viverra velit a mattis facilisis. Duis dapibus et tortor ut ultrices. Donec vel sagittis massa. Aliquam vulputate bibendum massa sed facilisis. Sed vel elit a lectus vulputate auctor. Integer tempus, tortor id molestie congue, felis justo vestibulum mi, ut condimentum turpis lectus ut lacus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi nec lobortis lacus. Nulla vel dui ex. Sed non dui tempor est sagittis varius in vulputate neque. Ut cursus tortor et nulla rutrum, et rhoncus nisi dapibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum nec purus sollicitudin, finibus ex id, scelerisque nibh. Maecenas mattis mi sodales feugiat aliquam.','2018-10-31 13:16:57','nicolasfouche@free.fr'),(15,23,'mana','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sit amet turpis lobortis, congue lorem vel, ornare risus. Sed congue mi sit amet orci rhoncus, et dictum nisl ornare. Proin semper aliquam neque, et pellentesque quam ultrices sit amet. Sed mollis eros quis bibendum imperdiet. Maecenas lobortis ante ac urna luctus ultrices. Phasellus sodales elementum lorem quis pulvinar. Sed interdum id libero eu porta. Sed quis sollicitudin sapien. In ut consectetur nisl. Nunc tempus faucibus malesuada. Aenean varius nibh purus. Vivamus blandit velit et nisl pellentesque, facilisis vulputate tellus molestie. Vivamus et elementum leo. Sed pellentesque commodo lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nisi orci, imperdiet ut finibus eu, cursus a urna.','2018-11-05 14:38:50','nicolasfouche@free.fr'),(16,25,'mana','onclick=\"window.open(\'your_html\', \'_blank\')\"','2018-11-05 15:23:40','nicolasfouche@free.fr');
/*!40000 ALTER TABLE `blog_comment` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-16 17:02:42
