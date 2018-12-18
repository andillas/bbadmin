-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.37-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.5.0.5372
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para beer_batches
DROP DATABASE IF EXISTS `beer_batches`;
CREATE DATABASE IF NOT EXISTS `beer_batches` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `beer_batches`;

-- Volcando estructura para tabla beer_batches.levadura
DROP TABLE IF EXISTS `levadura`;
CREATE TABLE IF NOT EXISTS `levadura` (
  `id_levadura` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_levadura` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notas_levadura` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_levadura`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla beer_batches.levadura: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `levadura` DISABLE KEYS */;
INSERT INTO `levadura` (`id_levadura`, `nombre_levadura`, `notas_levadura`) VALUES
	(1, 'Safale S-04', NULL),
	(2, 'Safale US-05', NULL);
/*!40000 ALTER TABLE `levadura` ENABLE KEYS */;

-- Volcando estructura para tabla beer_batches.lote
DROP TABLE IF EXISTS `lote`;
CREATE TABLE IF NOT EXISTS `lote` (
  `id_lote` int(11) NOT NULL AUTO_INCREMENT,
  `ref_lote` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_cocinado` date DEFAULT NULL,
  `fecha_embotellado` date DEFAULT NULL,
  `densidad_inicial` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tiempo_hervido` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `agua_macerado` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `agua_lavado` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `levadura` int(11) DEFAULT NULL,
  `azucar` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `densidad_final` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `graduacion` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `atenuacion` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `litros_embotellados` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ibus` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `incidencias` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_lote`),
  KEY `FK_batch_levadura` (`levadura`),
  CONSTRAINT `FK_batch_levadura` FOREIGN KEY (`levadura`) REFERENCES `levadura` (`id_levadura`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla beer_batches.lote: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `lote` DISABLE KEYS */;
INSERT INTO `lote` (`id_lote`, `ref_lote`, `nombre`, `tipo`, `fecha_cocinado`, `fecha_embotellado`, `densidad_inicial`, `tiempo_hervido`, `agua_macerado`, `agua_lavado`, `levadura`, `azucar`, `densidad_final`, `graduacion`, `atenuacion`, `litros_embotellados`, `ibus`, `incidencias`) VALUES
	(2, '0010/005-18', 'Décimo Lote', 'Nugget', '2018-07-21', '2018-07-28', '1040', '70', '23', '8', 1, '125', '1010', '4.03', '75', '22.6', '63.8', '- En la fase de 42º, la máquina se volvío loca, y subió a los 44-45º.\r\n- La puta bomba, ha vuelto a dejar de funcionar en el segundo escalón del macerado.'),
	(3, '0011/006-18', 'Undécimo Lote', 'Biscuit Nugget Ale', '2018-07-28', '2018-08-18', '1042', '70', '23', '8', 1, '200', '1008', '4.56', '80.95', '20', '70.8', '- Un desastre. Perdí el control del tiempo del lúpulo. Se cayó la bolsa del lúpulo dentro de la olla en la segunda adición.\r\n\r\n- Retirada de la capa de espuma al comenzar a hervir.\r\n\r\n- El Nugget es el que me regaló Paco porque el paquete no estaba al vacío.\r\n\r\n- La Pepa se ha ido :\'(.\r\n\r\n- Ha estado 20 días en el fermentador.\r\n\r\n- Ha hecho mucho calor y se ha llegado a los 30ºC.\r\n\r\n- 18-Nov: El sabor es bueno aunque un poco terroso por ser todo Nugget. Además se nota algo de astringencia (podría ser por exprimir la malta tras el macerado o por exceso de temperatura del agua de lavado).'),
	(4, '0012/007-18', 'Duodécimo Lote', 'Biscuit Nugget Mosaic Ale', '2018-11-18', '2018-11-28', '1046', '70', '23', '8', 1, '200', '1014', '4.3', '69.57', '21', '72.2', '- La bomba de recirculado se paró al subir a 78º y removí a mano.\r\n\r\n- Retirada de la capa de espuma al comenzar a hervir.\r\n\r\n- El Nugget es el que me regaló Paco porque el paquete no estaba al vacío.\r\n\r\n- La densidad inicial es orientativa porque tomé la muestra con la levadura en el fermentador.');
/*!40000 ALTER TABLE `lote` ENABLE KEYS */;

-- Volcando estructura para tabla beer_batches.lupulo
DROP TABLE IF EXISTS `lupulo`;
CREATE TABLE IF NOT EXISTS `lupulo` (
  `id_lupulo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_lupulo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alfa_acidos` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notas_lupulo` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_lupulo`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla beer_batches.lupulo: ~12 rows (aproximadamente)
/*!40000 ALTER TABLE `lupulo` DISABLE KEYS */;
INSERT INTO `lupulo` (`id_lupulo`, `nombre_lupulo`, `alfa_acidos`, `notas_lupulo`) VALUES
	(1, 'Chinook', '14.6', NULL),
	(2, 'Cascade', '8.2', NULL),
	(3, 'Chinook', '11.2', NULL),
	(4, 'Citra', '11.4', NULL),
	(5, 'Columbus', '12.6', NULL),
	(6, 'Summit', '6.9', NULL),
	(7, 'Nugget*', '11', '2 Kilos que me regaló Paco porque la bolsa le llegó sin vacío'),
	(8, 'Mosaic', NULL, NULL),
	(14, 'lúpulo prueba', '11', NULL),
	(19, 'Mandarina Bavaria', '8.2', NULL);
/*!40000 ALTER TABLE `lupulo` ENABLE KEYS */;

-- Volcando estructura para tabla beer_batches.lupulo_x_lote
DROP TABLE IF EXISTS `lupulo_x_lote`;
CREATE TABLE IF NOT EXISTS `lupulo_x_lote` (
  `id_lote` int(11) NOT NULL,
  `id_lupulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `tiempo` int(11) NOT NULL,
  PRIMARY KEY (`id_lote`,`id_lupulo`,`cantidad`,`tiempo`),
  KEY `fk_lupulo_x_batch_lupulo1_idx` (`id_lupulo`,`cantidad`,`tiempo`,`id_lote`),
  CONSTRAINT `FK_lupulo_x_batch_batch` FOREIGN KEY (`id_lote`) REFERENCES `lote` (`id_lote`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_lupulo_x_batch_lupulo` FOREIGN KEY (`id_lupulo`) REFERENCES `lupulo` (`id_lupulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla beer_batches.lupulo_x_lote: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `lupulo_x_lote` DISABLE KEYS */;
INSERT INTO `lupulo_x_lote` (`id_lote`, `id_lupulo`, `cantidad`, `tiempo`) VALUES
	(2, 7, 20, 5),
	(2, 7, 20, 15),
	(2, 7, 35, 50),
	(4, 1, 35, 60),
	(4, 3, 35, 15);
/*!40000 ALTER TABLE `lupulo_x_lote` ENABLE KEYS */;

-- Volcando estructura para tabla beer_batches.malta
DROP TABLE IF EXISTS `malta`;
CREATE TABLE IF NOT EXISTS `malta` (
  `id_malta` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_malta` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo_malta` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ebc` int(3) DEFAULT NULL,
  `notas_malta` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id_malta`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla beer_batches.malta: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `malta` DISABLE KEYS */;
INSERT INTO `malta` (`id_malta`, `nombre_malta`, `tipo_malta`, `ebc`, `notas_malta`) VALUES
	(1, 'Pilsen', 'base', NULL, NULL),
	(2, 'Special B', 'especial', NULL, NULL),
	(3, 'Munich', 'base', NULL, NULL),
	(4, 'Pale Ale', 'base', NULL, NULL),
	(5, 'Biscuit', 'especial', 50, NULL);
/*!40000 ALTER TABLE `malta` ENABLE KEYS */;

-- Volcando estructura para tabla beer_batches.malta_x_lote
DROP TABLE IF EXISTS `malta_x_lote`;
CREATE TABLE IF NOT EXISTS `malta_x_lote` (
  `id_lote` int(11) NOT NULL,
  `id_malta` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_lote`,`id_malta`),
  KEY `fk_malta_maltaxbatch_idx` (`id_malta`),
  CONSTRAINT `FK_malta_x_batch_batch` FOREIGN KEY (`id_lote`) REFERENCES `lote` (`id_lote`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_malta_x_batch_malta` FOREIGN KEY (`id_malta`) REFERENCES `malta` (`id_malta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla beer_batches.malta_x_lote: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `malta_x_lote` DISABLE KEYS */;
INSERT INTO `malta_x_lote` (`id_lote`, `id_malta`, `cantidad`) VALUES
	(2, 1, 5000),
	(2, 2, 30);
/*!40000 ALTER TABLE `malta_x_lote` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
