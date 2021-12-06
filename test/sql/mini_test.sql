-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           10.5.9-MariaDB - mariadb.org binary distribution
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0 */;
/*!40101 SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour mini_test
DROP DATABASE IF EXISTS `mini_test`;
CREATE DATABASE IF NOT EXISTS `mini_test` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `mini_test`;

-- Listage de la structure de la table mini_test. users_test
CREATE TABLE IF NOT EXISTS `users_test`
(
    `id`         int(11)      NOT NULL AUTO_INCREMENT,
    `first_name` varchar(45)  NOT NULL,
    `last_name`  varchar(45)  NOT NULL,
    `email`      varchar(255) NOT NULL,
    `ip_address` varchar(15)  NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- Listage des données de la table mini_test.users_test : ~50 rows (environ)
/*!40000 ALTER TABLE `users_test`
    DISABLE KEYS */;
INSERT INTO `users_test` (`first_name`, `last_name`, `email`, `ip_address`)
VALUES ('Obidiah', 'Beig', 'obeig0@phpbb.com', '171.95.176.82'),
       ('Ryley', 'Vaughan-Hughes', 'rvaughanhughes1@angelfire.com', '108.225.12.193'),
       ('Chad', 'Bardell', 'cbardell2@auda.org.au', '253.127.34.56'),
       ('Tory', 'Chaffey', 'tchaffey3@flavors.me', '237.152.85.190'),
       ('Arri', 'Bradnam', 'abradnam4@amazon.co.jp', '136.230.212.172'),
       ('Ingrim', 'Bracey', 'ibracey5@wufoo.com', '203.97.95.7'),
       ('Raine', 'Laugherane', 'rlaugherane6@pen.io', '156.186.54.200'),
       ('Benny', 'Rubinovici', 'brubinovici7@cmu.edu', '197.111.183.93'),
       ('Quintilla', 'Baulch', 'qbaulch8@prweb.com', '108.27.144.61'),
       ('Harri', 'Addess', 'haddess9@unc.edu', '126.82.223.159'),
       ('Grannie', 'Hartland', 'ghartlanda@aboutads.info', '158.239.125.227'),
       ('Gregor', 'Pauli', 'gpaulib@csmonitor.com', '122.88.122.26'),
       ('Dennison', 'Bartocci', 'dbartoccic@pcworld.com', '153.232.242.149'),
       ('Malorie', 'Gillis', 'mgillisd@last.fm', '127.98.110.252'),
       ('Auguste', 'Josofovitz', 'ajosofovitze@buzzfeed.com', '141.43.195.109'),
       ('Bonita', 'Barthrop', 'bbarthropf@mozilla.com', '48.97.129.25'),
       ('Gerladina', 'Gelland', 'ggellandg@independent.co.uk', '43.200.117.205'),
       ('Marika', 'Mainds', 'mmaindsh@youtu.be', '89.167.110.23'),
       ('Ferdinande', 'O\' Sullivan', 'fosullivani@accuweather.com', '115.107.139.43'),
       ('Magdalena', 'Wainer', 'mwainerj@mozilla.org', '252.45.38.35'),
       ('Sigismundo', 'Whitfeld', 'swhitfeldk@feedburner.com', '40.120.154.143'),
       ('Melisenda', 'Pyecroft', 'mpyecroftl@msn.com', '235.159.141.36'),
       ('Kennie', 'Shrawley', 'kshrawleym@archive.org', '16.214.158.247'),
       ('Sybila', 'McKeefry', 'smckeefryn@webnode.com', '166.119.96.72'),
       ('Kaycee', 'Gerardet', 'kgerardeto@apple.com', '222.135.134.46'),
       ('Genni', 'Warke', 'gwarkep@networkadvertising.org', '26.124.93.64'),
       ('Jo-anne', 'Lenz', 'jlenzq@domainmarket.com', '126.197.248.216'),
       ('Margit', 'Golby', 'mgolbyr@is.gd', '217.132.156.176'),
       ('Mick', 'Waterstone', 'mwaterstones@wisc.edu', '235.48.154.156'),
       ('Meridith', 'Alessandrini', 'malessandrinit@tripadvisor.com', '237.123.159.88'),
       ('Cherice', 'Jacqueminet', 'cjacqueminetu@earthlink.net', '199.200.109.74'),
       ('Fara', 'Bryer', 'fbryerv@businesswire.com', '99.168.95.255'),
       ('Kirbie', 'Pestridge', 'kpestridgew@amazon.com', '24.92.93.197'),
       ('Aaren', 'Algie', 'aalgiex@princeton.edu', '75.32.60.108'),
       ('Wakefield', 'Kneal', 'wknealy@indiatimes.com', '19.119.213.177'),
       ('Rubie', 'Yegorovnin', 'ryegorovninz@nhs.uk', '9.6.157.132'),
       ('Olav', 'Luna', 'oluna10@google.es', '190.82.136.46'),
       ('Ardella', 'Fairy', 'afairy11@fotki.com', '28.104.45.141'),
       ('Joyann', 'Batsford', 'jbatsford12@google.it', '87.28.184.70'),
       ('Reinhard', 'Baynham', 'rbaynham13@go.com', '9.68.210.88'),
       ('Jermayne', 'Glowinski', 'jglowinski14@zimbio.com', '63.162.137.126'),
       ('Lorie', 'Northrop', 'lnorthrop15@imageshack.us', '30.65.114.48'),
       ('Marlyn', 'Igo', 'migo16@phoca.cz', '226.35.126.111'),
       ('Con', 'Larkin', 'clarkin17@webmd.com', '219.156.222.168'),
       ('Jerrie', 'Lemary', 'jlemary18@hibu.com', '133.176.240.12'),
       ('Claudianus', 'O\'Dooghaine', 'codooghaine19@nifty.com', '31.16.5.171'),
       ('Sallee', 'Puddle', 'spuddle1a@chronoengine.com', '112.21.249.80'),
       ('Daisi', 'Stair', 'dstair1b@cyberchimps.com', '211.25.137.233'),
       ('Josephine', 'Drabble', 'jdrabble1c@nationalgeographic.com', '228.245.207.56'),
       ('Klement', 'Attyeo', 'kattyeo1d@jiathis.com', '114.58.136.116');
/*!40000 ALTER TABLE `users_test`
    ENABLE KEYS */;

/*!40101 SET SQL_MODE = IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS = IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
