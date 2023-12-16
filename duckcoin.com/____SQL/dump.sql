-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.39 - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Дамп структуры базы данных myDb
CREATE DATABASE IF NOT EXISTS `myDb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `myDb`;

-- Дамп структуры для таблица myDb.navigate
CREATE TABLE IF NOT EXISTS `navigate` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `href` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) DEFAULT NULL,
  `parentId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `parentId` (`parentId`),
  CONSTRAINT `navigate_ibfk_1` FOREIGN KEY (`parentId`) REFERENCES `navigate` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы myDb.navigate: ~4 rows (приблизительно)
INSERT INTO `navigate` (`Id`, `title`, `href`, `order`, `parentId`) VALUES
	(1, 'Главная', '/', 1, NULL),
	(2, 'Блог', '/blog', 2, NULL),
	(3, 'Новости', '/blog/news', 1, 2),
	(4, 'История', '/blog/history', 2, 2);

-- Дамп структуры для таблица myDb.options
CREATE TABLE IF NOT EXISTS `options` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `groupBy` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы myDb.options: ~4 rows (приблизительно)
INSERT INTO `options` (`Id`, `name`, `value`, `groupBy`) VALUES
	(1, 'lang', 'ua', NULL),
	(2, 'title', 'Назва сайту', NULL),
	(3, 'phone', '+3 8 (066) 256-68-95', 'contacts'),
	(4, 'email', 'mysite@email.com', 'contacts');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
