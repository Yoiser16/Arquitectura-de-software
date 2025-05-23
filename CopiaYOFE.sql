/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `wastech` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `wastech`;

CREATE TABLE IF NOT EXISTS `arduino` (
  `ID_arduino` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `Modelo` varchar(50) NOT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID_arduino`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='es la placa del deshidratador';

INSERT INTO `arduino` (`ID_arduino`, `Nombre`, `Modelo`, `estado`) VALUES
	(1, 'PRUEBA', 'PRUEBA2', 1),
	(2, 'Version Prueba', ' pr Prototipo', 1),
	(4, 'PruebaBORRA', 'AVGPIO', 0);

CREATE TABLE IF NOT EXISTS `cliente` (
  `cedula` int(11) NOT NULL,
  `nombre1` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `nombre2` varchar(100) DEFAULT NULL,
  `apellido1` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `apellido2` varchar(100) DEFAULT NULL,
  `telefono` int(10) NOT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `correo` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`cedula`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='se guarda la informacion del usuario que es el que va a operar con el dispositivo';


CREATE TABLE IF NOT EXISTS `deshidratador` (
  `ID_deshidratador` int(11) NOT NULL AUTO_INCREMENT,
  `ID_arduino` int(11) NOT NULL,
  `Calentador` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_deshidratador`),
  KEY `FK_deshidratador_arduino` (`ID_arduino`),
  CONSTRAINT `FK_deshidratador_arduino` FOREIGN KEY (`ID_arduino`) REFERENCES `arduino` (`ID_arduino`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='es el dipositivo ';

INSERT INTO `deshidratador` (`ID_deshidratador`, `ID_arduino`, `Calentador`) VALUES
	(2, 1, 'ensayo1'),
	(3, 2, 'NN');

CREATE TABLE IF NOT EXISTS `perfil` (
  `IDperfil` int(11) NOT NULL,
  `Nombre` int(11) NOT NULL,
  PRIMARY KEY (`IDperfil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='credenciales para ingresar al sistema ';


CREATE TABLE IF NOT EXISTS `puntajes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_jugador` varchar(100) DEFAULT NULL,
  `puntaje` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `puntajes` (`ID`, `nombre_jugador`, `puntaje`, `fecha`) VALUES
	(41, 'Yoiser Agualimpia', 3159, '2025-05-23 15:53:04'),
	(53, 'Amaranta Perea', 2560, '2025-05-23 16:00:29'),
	(55, 'Amaranta Perea', 3061, '2025-05-23 16:12:23'),
	(56, 'Amaranta Perea', 437, '2025-05-23 16:12:34'),
	(57, 'Amaranta Perea', 3438, '2025-05-23 16:23:49'),
	(58, 'Amaranta Perea', 3006, '2025-05-23 16:26:13'),
	(59, 'Amaranta Perea', 378, '2025-05-23 16:26:21'),
	(60, 'Amaranta Perea', 646, '2025-05-23 16:31:13'),
	(61, 'Amaranta Perea', 10113, '2025-05-23 16:38:46'),
	(62, 'Amaranta Perea', 1355, '2025-05-23 17:04:04'),
	(63, 'Amaranta Perea', 1843, '2025-05-23 17:07:10'),
	(64, 'Yoiser Agualimpia', 725, '2025-05-23 18:27:35');

CREATE TABLE IF NOT EXISTS `registro` (
  `ID_registro` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha_inicio` date NOT NULL,
  `ID_deshidratador` int(11) NOT NULL,
  `Fecha_fin` date NOT NULL,
  `Estado` varchar(50) NOT NULL,
  `temperatura` float NOT NULL,
  `Humedad` float NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `ID_matep` int(11) NOT NULL,
  `ID_compostaje` int(11) NOT NULL,
  PRIMARY KEY (`ID_registro`),
  KEY `FK_registro_tipo_compostaje` (`ID_compostaje`),
  KEY `FK_registro_tipo_materia_prima` (`ID_matep`),
  KEY `FK_registro_deshidratador` (`ID_deshidratador`),
  CONSTRAINT `FK_registro_deshidratador` FOREIGN KEY (`ID_deshidratador`) REFERENCES `deshidratador` (`ID_deshidratador`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_registro_tipo_compostaje` FOREIGN KEY (`ID_compostaje`) REFERENCES `tipo_compostaje` (`ID_compostaje`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_registro_tipo_materia_prima` FOREIGN KEY (`ID_matep`) REFERENCES `tipo_materia_prima` (`ID_matep`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='es donde esta toda la informacion del sistema en pocas plabaras es el sitema central ';


CREATE TABLE IF NOT EXISTS `resultado` (
  `Cod_resultado` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha_de_inicio` date NOT NULL,
  `Fecha_de_fin` date NOT NULL,
  `ID_sensor` int(11) NOT NULL,
  `Valor` float NOT NULL,
  PRIMARY KEY (`Cod_resultado`),
  KEY `FK_resultado_sensores` (`ID_sensor`),
  CONSTRAINT `FK_resultado_sensores` FOREIGN KEY (`ID_sensor`) REFERENCES `sensores` (`ID_sensor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='restorna los valores segun los parametros';

INSERT INTO `resultado` (`Cod_resultado`, `Fecha_de_inicio`, `Fecha_de_fin`, `ID_sensor`, `Valor`) VALUES
	(1, '2024-02-01', '2024-01-01', 1, 50);

CREATE TABLE IF NOT EXISTS `sensores` (
  `ID_sensor` int(11) NOT NULL AUTO_INCREMENT,
  `Valor_lectura` float NOT NULL,
  `Fecha_lectura` date NOT NULL,
  `ID_tiposensor` int(11) NOT NULL,
  `ID_arduino` int(11) NOT NULL,
  PRIMARY KEY (`ID_sensor`),
  KEY `FK_sensores_arduino` (`ID_arduino`),
  KEY `FK_sensores_tipo_sensor` (`ID_tiposensor`),
  CONSTRAINT `FK_sensores_arduino` FOREIGN KEY (`ID_arduino`) REFERENCES `arduino` (`ID_arduino`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_sensores_tipo_sensor` FOREIGN KEY (`ID_tiposensor`) REFERENCES `tipo_sensor` (`ID_tiposensor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='es el hadware en el cual se apolla la placa para suminstrar la informacion ';

INSERT INTO `sensores` (`ID_sensor`, `Valor_lectura`, `Fecha_lectura`, `ID_tiposensor`, `ID_arduino`) VALUES
	(1, 1, '2024-06-02', 1, 1),
	(2, 80, '2023-12-01', 1, 1),
	(5, 40, '2024-10-24', 1, 4);

CREATE TABLE IF NOT EXISTS `sensor_datos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ID_sensor` int(11) DEFAULT NULL,
  `valor_temperatura` float DEFAULT NULL,
  `valor_humedad` float DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ID_sensor` (`ID_sensor`),
  CONSTRAINT `sensor_datos_ibfk_1` FOREIGN KEY (`ID_sensor`) REFERENCES `sensores` (`ID_sensor`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `sensor_datos` (`id`, `ID_sensor`, `valor_temperatura`, `valor_humedad`, `fecha_creacion`) VALUES
	(1, 1, 27.7, 59.3, '2024-11-22'),
	(2, 1, 27.6, 59.2, '2024-11-22'),
	(3, 1, 27.7, 59.2, '2024-11-22'),
	(4, 1, 27.7, 59.2, '2024-11-22'),
	(5, 1, 27.7, 59.2, '2024-11-22'),
	(6, 1, 27.7, 59.2, '2024-11-22'),
	(7, 1, 27.7, 59.2, '2024-11-22'),
	(8, 1, 27.6, 59.2, '2024-11-22'),
	(9, 1, 27.7, 59.2, '2024-11-22'),
	(10, 1, 27.7, 59.2, '2024-11-22'),
	(11, 1, 27.7, 59.2, '2024-11-22'),
	(12, 1, 27.6, 59.1, '2024-11-22'),
	(13, 1, 27.6, 59.1, '2024-11-22'),
	(14, 1, 27.7, 59.1, '2024-11-22'),
	(15, 1, 27.7, 59.1, '2024-11-22'),
	(16, 1, 27.7, 59.1, '2024-11-22'),
	(17, 1, 27.7, 59, '2024-11-22'),
	(18, 1, 27.7, 58.9, '2024-11-22'),
	(19, 1, 27.6, 59, '2024-11-22'),
	(20, 1, 27.6, 59, '2024-11-22'),
	(21, 1, 27.7, 59, '2024-11-22'),
	(22, 1, 27.7, 59, '2024-11-22'),
	(23, 1, 27.7, 58.9, '2024-11-22'),
	(24, 1, 27.7, 58.9, '2024-11-22'),
	(25, 1, 25.6, 57.3, '2024-11-22'),
	(26, 1, 25.6, 57.1, '2024-11-22'),
	(27, 1, 25.6, 57, '2024-11-22'),
	(28, 1, 25.7, 56.9, '2024-11-22'),
	(29, 1, 25.7, 56.9, '2024-11-22'),
	(30, 1, 25.7, 56.8, '2024-11-22'),
	(31, 1, 25.7, 56.8, '2024-11-22'),
	(32, 1, 25.8, 56.8, '2024-11-22'),
	(33, 1, 25.8, 56.9, '2024-11-22'),
	(34, 1, 25.8, 56.8, '2024-11-22'),
	(35, 1, 25.8, 56.8, '2024-11-22'),
	(36, 1, 25.8, 56.8, '2024-11-22'),
	(37, 1, 25.8, 56.8, '2024-11-22'),
	(38, 1, 25.9, 56.7, '2024-11-22'),
	(39, 1, 25.9, 56.5, '2024-11-22'),
	(40, 1, 25.9, 56.5, '2024-11-22'),
	(41, 1, 25.9, 58.8, '2024-11-22'),
	(42, 1, 25.9, 60.4, '2024-11-22'),
	(43, 1, 26, 62.8, '2024-11-22'),
	(44, 1, 26, 66.8, '2024-11-22'),
	(45, 1, 26.1, 71.5, '2024-11-22'),
	(46, 1, 26.1, 75.7, '2024-11-22'),
	(47, 1, 26.1, 79, '2024-11-22'),
	(48, 1, 26.2, 81.1, '2024-11-22'),
	(49, 1, 26.2, 82.2, '2024-11-22'),
	(50, 1, 26.2, 82.2, '2024-11-22'),
	(51, 1, 26.3, 81.1, '2024-11-22'),
	(52, 1, 26.3, 79.2, '2024-11-22'),
	(53, 1, 26.3, 76.6, '2024-11-22'),
	(54, 1, 26.3, 73.8, '2024-11-22'),
	(55, 1, 26.4, 71.1, '2024-11-22'),
	(56, 1, 26.4, 68.8, '2024-11-22'),
	(57, 1, 26.4, 67.1, '2024-11-22'),
	(58, 1, 26.5, 65.6, '2024-11-22'),
	(59, 1, 26.5, 64.5, '2024-11-22'),
	(60, 1, 26.5, 63.6, '2024-11-22'),
	(61, 1, 26.5, 62.8, '2024-11-22'),
	(62, 1, 26.6, 62, '2024-11-22'),
	(63, 1, 26.6, 61.3, '2024-11-22'),
	(64, 1, 26.6, 60.9, '2024-11-22'),
	(65, 1, 26.6, 60.5, '2024-11-22'),
	(66, 1, 26.7, 60.2, '2024-11-22'),
	(67, 1, 26.7, 59.9, '2024-11-22'),
	(68, 1, 26.7, 59.7, '2024-11-22'),
	(69, 1, 26.7, 59.4, '2024-11-22'),
	(70, 1, 26.8, 59.1, '2024-11-22'),
	(71, 1, 26.8, 58.8, '2024-11-22'),
	(72, 1, 26.8, 58.5, '2024-11-22'),
	(73, 1, 26.8, 58.1, '2024-11-22'),
	(74, 1, 26.9, 57.8, '2024-11-22'),
	(75, 1, 26.9, 57.3, '2024-11-22'),
	(76, 1, 26.9, 56.9, '2024-11-22'),
	(77, 1, 26.9, 56.4, '2024-11-22'),
	(78, 1, 26.9, 56, '2024-11-22'),
	(79, 1, 26.9, 55.8, '2024-11-22'),
	(80, 1, 26.9, 55.5, '2024-11-22'),
	(81, 1, 26.9, 55.3, '2024-11-22'),
	(82, 1, 27, 55.2, '2024-11-22'),
	(83, 1, 27, 55, '2024-11-22'),
	(84, 1, 27, 54.8, '2024-11-22'),
	(85, 1, 27, 54.9, '2024-11-22'),
	(86, 1, 27, 55, '2024-11-22'),
	(87, 1, 27, 55.2, '2024-11-22'),
	(88, 1, 27, 55.3, '2024-11-22'),
	(89, 1, 27, 55.2, '2024-11-22'),
	(90, 1, 27, 55.1, '2024-11-22'),
	(91, 1, 27, 55, '2024-11-22'),
	(92, 1, 27, 54.8, '2024-11-22'),
	(93, 1, 27, 54.7, '2024-11-22'),
	(94, 1, 27, 54.6, '2024-11-22'),
	(95, 1, 27, 54.5, '2024-11-22'),
	(96, 1, 27, 54.4, '2024-11-22'),
	(97, 1, 27, 54.3, '2024-11-22'),
	(98, 1, 27, 54.2, '2024-11-22'),
	(99, 1, 27, 54.1, '2024-11-22'),
	(100, 1, 27, 54, '2024-11-22'),
	(101, 1, 27, 53.9, '2024-11-22'),
	(102, 1, 27, 53.8, '2024-11-22'),
	(103, 1, 27, 53.9, '2024-11-22'),
	(104, 1, 24, 58.2, '2024-11-22'),
	(105, 1, 24, 57.8, '2024-11-22'),
	(106, 1, 24.2, 55.8, '2024-11-22'),
	(107, 1, 24.6, 50.4, '2024-11-22'),
	(108, 1, 25.3, 48.7, '2024-11-22'),
	(109, 1, 26.4, 48.4, '2024-11-22'),
	(110, 1, 27.6, 45.2, '2024-11-22'),
	(111, 1, 28.4, 43.9, '2024-11-22'),
	(112, 1, 29.1, 42.7, '2024-11-22'),
	(113, 1, 29.7, 42.1, '2024-11-22'),
	(114, 1, 30.4, 41, '2024-11-22'),
	(115, 1, 30.6, 38.5, '2024-11-22');

CREATE TABLE IF NOT EXISTS `tipo_compostaje` (
  `ID_compostaje` int(11) NOT NULL AUTO_INCREMENT,
  `Compuestos` varchar(50) NOT NULL DEFAULT '',
  `Temperatura_limite` int(11) NOT NULL,
  `Humedad_limite` int(11) NOT NULL,
  PRIMARY KEY (`ID_compostaje`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='es el tipo de compostaje que se tiene ';

INSERT INTO `tipo_compostaje` (`ID_compostaje`, `Compuestos`, `Temperatura_limite`, `Humedad_limite`) VALUES
	(1, 'Prueba, prueba', 12, 7);

CREATE TABLE IF NOT EXISTS `tipo_materia_prima` (
  `ID_matep` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL DEFAULT '',
  `Temperatura` int(11) NOT NULL,
  PRIMARY KEY (`ID_matep`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='es la materia prima que se utiliza para deshidratar y formar el compostaje ';

INSERT INTO `tipo_materia_prima` (`ID_matep`, `nombre`, `Temperatura`) VALUES
	(1, 'Fruta', 40);

CREATE TABLE IF NOT EXISTS `tipo_sensor` (
  `ID_tiposensor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_sensor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_tiposensor`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='es el tipo de sensor que se tiene ';

INSERT INTO `tipo_sensor` (`ID_tiposensor`, `nombre_sensor`) VALUES
	(1, 'Humedad'),
	(3, 'Temperatura');

CREATE TABLE IF NOT EXISTS `usuario` (
  `cedula` int(11) NOT NULL,
  `nombre1` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `apellido1` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `correo` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `usuario` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  KEY `FK_usuario_cliente` (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `usuario` (`cedula`, `nombre1`, `apellido1`, `correo`, `usuario`, `password`, `estado`) VALUES
	(1122224, 'Yoiser', 'Agualimpia', ' Davila', 'yoiser16', 'b45bc9a4768d1b8ba8f729a450c14ec0', 1),
	(78755789, 'Amaranta', 'Perea', 'Amarap@gmail.com', 'Amara15', '8794734b91fbbea93db7d231aa22e19d', NULL),
	(2147483647, 'Rosa', 'Pinzon', 'rosap12@gmail.com', 'ro12', 'ee6bb77f054ce6ddee5b6817c8075af9', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
