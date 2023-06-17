-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versione server:              10.4.21-MariaDB - mariadb.org binary distribution
-- S.O. server:                  Win64
-- HeidiSQL Versione:            11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dump della struttura del database inpact
CREATE DATABASE IF NOT EXISTS `inpact` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `inpact`;

-- Dump della struttura di tabella inpact.account
CREATE TABLE IF NOT EXISTS `account` (
  `nomeUtente` int(6) NOT NULL,
  `password` varchar(30) DEFAULT NULL,
  `tipo` int(1) NOT NULL,
  PRIMARY KEY (`nomeUtente`,`tipo`),
  CONSTRAINT `fk_acc_pers` FOREIGN KEY (`nomeUtente`, `tipo`) REFERENCES `persona` (`ID_persona`, `tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella inpact.account: ~5 rows (circa)
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` (`nomeUtente`, `password`, `tipo`) VALUES
	(1, 'ciao1', 1),
	(2, 'ciao2', 1),
	(3, 'ciao3', 1),
	(4, 'ciao4', 2),
	(5, 'ciao5', 2);
/*!40000 ALTER TABLE `account` ENABLE KEYS */;

-- Dump della struttura di tabella inpact.assegna_visualizza
CREATE TABLE IF NOT EXISTS `assegna_visualizza` (
  `ID_persona` int(6) NOT NULL,
  `tipoP` int(1) NOT NULL,
  `codBadge` int(11) NOT NULL,
  `livello` int(1) NOT NULL,
  `dataB` date DEFAULT NULL,
  PRIMARY KEY (`ID_persona`,`tipoP`,`codBadge`,`livello`),
  KEY `fk_ass_badge` (`codBadge`,`livello`),
  CONSTRAINT `fk_ass_badge` FOREIGN KEY (`codBadge`, `livello`) REFERENCES `badge` (`codBadge`, `livello`),
  CONSTRAINT `fk_ass_pers` FOREIGN KEY (`ID_persona`, `tipoP`) REFERENCES `persona` (`ID_persona`, `tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella inpact.assegna_visualizza: ~4 rows (circa)
/*!40000 ALTER TABLE `assegna_visualizza` DISABLE KEYS */;
INSERT INTO `assegna_visualizza` (`ID_persona`, `tipoP`, `codBadge`, `livello`, `dataB`) VALUES
	(1, 1, 1, 2, '2022-05-28'),
	(2, 1, 2, 3, '2022-02-05'),
	(2, 1, 7, 3, '2021-11-03'),
	(3, 1, 3, 1, '2022-07-13');
/*!40000 ALTER TABLE `assegna_visualizza` ENABLE KEYS */;

-- Dump della struttura di tabella inpact.badge
CREATE TABLE IF NOT EXISTS `badge` (
  `codBadge` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `materia` int(11) DEFAULT NULL,
  `livello` int(1) NOT NULL,
  PRIMARY KEY (`codBadge`,`livello`),
  KEY `fk_badge_mat` (`materia`),
  CONSTRAINT `fk_badge_mat` FOREIGN KEY (`materia`) REFERENCES `materia` (`ID_materia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella inpact.badge: ~42 rows (circa)
/*!40000 ALTER TABLE `badge` DISABLE KEYS */;
INSERT INTO `badge` (`codBadge`, `nome`, `materia`, `livello`) VALUES
	(1, 'C', 4, 1),
	(1, 'C', 4, 2),
	(1, 'C', 4, 3),
	(2, 'Cisco', 6, 1),
	(2, 'Cisco', 6, 2),
	(2, 'Cisco', 6, 3),
	(3, 'Crittografia', 4, 1),
	(3, 'Crittografia', 4, 2),
	(3, 'Crittografia', 4, 3),
	(4, 'Css', 3, 1),
	(4, 'Css', 3, 2),
	(4, 'Css', 3, 3),
	(5, 'Hardware', 3, 1),
	(5, 'Hardware', 3, 2),
	(5, 'Hardware', 3, 3),
	(6, 'Html', 3, 1),
	(6, 'Html', 3, 2),
	(6, 'Html', 3, 3),
	(7, 'Java', 3, 1),
	(7, 'Java', 3, 2),
	(7, 'Java', 3, 3),
	(8, 'Javascript', 3, 1),
	(8, 'Javascript', 3, 2),
	(8, 'Javascript', 3, 3),
	(9, 'Office', 3, 1),
	(9, 'Office', 3, 2),
	(9, 'Office', 3, 3),
	(10, 'Php', 3, 1),
	(10, 'Php', 3, 2),
	(10, 'Php', 3, 3),
	(11, 'Python', 3, 1),
	(11, 'Python', 3, 2),
	(11, 'Python', 3, 3),
	(12, 'Reti', 6, 1),
	(12, 'Reti', 6, 2),
	(12, 'Reti', 6, 3),
	(13, 'Software', 3, 1),
	(13, 'Software', 3, 2),
	(13, 'Software', 3, 3),
	(14, 'Sql', 3, 1),
	(14, 'Sql', 3, 2),
	(14, 'Sql', 3, 3);
/*!40000 ALTER TABLE `badge` ENABLE KEYS */;

-- Dump della struttura di tabella inpact.classe
CREATE TABLE IF NOT EXISTS `classe` (
  `ID_classe` int(11) NOT NULL,
  `anno` int(1) DEFAULT NULL,
  `sezione` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`ID_classe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella inpact.classe: ~5 rows (circa)
/*!40000 ALTER TABLE `classe` DISABLE KEYS */;
INSERT INTO `classe` (`ID_classe`, `anno`, `sezione`) VALUES
	(1, 5, 'ci'),
	(2, 4, 'am'),
	(3, 3, 'ae'),
	(4, 2, 'ci'),
	(5, 1, 'ci');
/*!40000 ALTER TABLE `classe` ENABLE KEYS */;

-- Dump della struttura di tabella inpact.insegna
CREATE TABLE IF NOT EXISTS `insegna` (
  `ID_persona` int(6) NOT NULL,
  `ID_materia` int(11) NOT NULL,
  `ID_classe` int(11) NOT NULL,
  PRIMARY KEY (`ID_persona`,`ID_materia`,`ID_classe`),
  KEY `fk_ins_mat` (`ID_materia`),
  KEY `fk_ins_class` (`ID_classe`),
  CONSTRAINT `fk_ins_class` FOREIGN KEY (`ID_classe`) REFERENCES `classe` (`ID_classe`),
  CONSTRAINT `fk_ins_mat` FOREIGN KEY (`ID_materia`) REFERENCES `materia` (`ID_materia`),
  CONSTRAINT `fk_ins_pers` FOREIGN KEY (`ID_persona`) REFERENCES `persona` (`ID_persona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella inpact.insegna: ~4 rows (circa)
/*!40000 ALTER TABLE `insegna` DISABLE KEYS */;
INSERT INTO `insegna` (`ID_persona`, `ID_materia`, `ID_classe`) VALUES
	(4, 4, 1),
	(4, 4, 2),
	(4, 6, 1),
	(5, 1, 1);
/*!40000 ALTER TABLE `insegna` ENABLE KEYS */;

-- Dump della struttura di tabella inpact.materia
CREATE TABLE IF NOT EXISTS `materia` (
  `ID_materia` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID_materia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella inpact.materia: ~6 rows (circa)
/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
INSERT INTO `materia` (`ID_materia`, `nome`) VALUES
	(1, 'Italiano'),
	(2, 'Matematica'),
	(3, 'Informatica'),
	(4, 'Tpsi'),
	(5, 'Motoria'),
	(6, 'Sistemi e Reti');
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;

-- Dump della struttura di tabella inpact.persona
CREATE TABLE IF NOT EXISTS `persona` (
  `ID_persona` int(6) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `cognome` varchar(30) DEFAULT NULL,
  `dataNascita` date DEFAULT NULL,
  `sesso` varchar(1) DEFAULT NULL,
  `tipo` int(11) NOT NULL,
  `ID_classe` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_persona`,`tipo`),
  KEY `fk_pers_class` (`ID_classe`),
  CONSTRAINT `fk_pers_class` FOREIGN KEY (`ID_classe`) REFERENCES `classe` (`ID_classe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella inpact.persona: ~5 rows (circa)
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` (`ID_persona`, `nome`, `cognome`, `dataNascita`, `sesso`, `tipo`, `ID_classe`) VALUES
	(1, 'Luigi Pino', 'Mosto', '2000-10-01', 'M', 1, 1),
	(2, 'Mario', 'Ugo', '1990-12-07', 'M', 1, 1),
	(3, 'Sonia', 'Eticipia', '2000-03-23', 'F', 1, 1),
	(4, 'Vanni', 'Tirapelle', '1974-10-01', 'M', 2, 1),
	(5, 'Emil', 'Ricci', '1978-10-01', 'M', 2, 1);
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
