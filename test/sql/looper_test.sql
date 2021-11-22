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


-- Listage de la structure de la base pour looper_test
DROP DATABASE IF EXISTS `looper_test`;
CREATE DATABASE IF NOT EXISTS `looper_test` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `looper_test`;

-- Listage de la structure de la table looper_test. answers
CREATE TABLE IF NOT EXISTS `answers`
(
    `id`          int(11) NOT NULL AUTO_INCREMENT,
    `take_id`     int(11) NOT NULL,
    `question_id` int(11) NOT NULL,
    `value`       text    NOT NULL,
    PRIMARY KEY (`id`),
    KEY `fk_Takes_has_Questions_Questions1_idx` (`question_id`),
    KEY `fk_Takes_has_Questions_Takes1_idx` (`take_id`),
    CONSTRAINT `fk_Takes_has_Questions_Questions1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_Takes_has_Questions_Takes1` FOREIGN KEY (`take_id`) REFERENCES `takes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- Listage des données de la table looper_test.answers : ~2 rows (environ)
/*!40000 ALTER TABLE `answers`
    DISABLE KEYS */;
INSERT INTO `answers` (`take_id`, `question_id`, `value`)
VALUES (1, 2, 'I\'m here POG'),
       (2, 2, 'OMG SAME POGGERS');
/*!40000 ALTER TABLE `answers`
    ENABLE KEYS */;

-- Listage de la structure de la table looper_test. exercises
CREATE TABLE IF NOT EXISTS `exercises`
(
    `id`                 int(11)     NOT NULL AUTO_INCREMENT,
    `title`              varchar(45) NOT NULL,
    `exercise_status_id` int(11)     NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE KEY `id_UNIQUE` (`id`),
    KEY `fk_exercises_exercise_statuses1_idx` (`exercise_status_id`),
    CONSTRAINT `fk_exercises_exercise_statuses1` FOREIGN KEY (`exercise_status_id`) REFERENCES `exercise_statuses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- Listage des données de la table looper_test.exercises : ~3 rows (environ)
/*!40000 ALTER TABLE `exercises`
    DISABLE KEYS */;
INSERT INTO `exercises` (`title`, `exercise_status_id`)
VALUES ('Exercise Building', 1),
       ('Exercise Answering', 2),
       ('Exercise Closed', 3);
/*!40000 ALTER TABLE `exercises`
    ENABLE KEYS */;

-- Listage de la structure de la table looper_test. exercise_statuses
CREATE TABLE IF NOT EXISTS `exercise_statuses`
(
    `id`   int(11) NOT NULL,
    `name` varchar(45) DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- Listage des données de la table looper_test.exercise_statuses : ~3 rows (environ)
/*!40000 ALTER TABLE `exercise_statuses`
    DISABLE KEYS */;
INSERT INTO `exercise_statuses` (`id`, `name`)
VALUES (1, 'Building'),
       (2, 'Answering'),
       (3, 'Closed');
/*!40000 ALTER TABLE `exercise_statuses`
    ENABLE KEYS */;

-- Listage de la structure de la table looper_test. questions
CREATE TABLE IF NOT EXISTS `questions`
(
    `id`               int(11)     NOT NULL AUTO_INCREMENT,
    `label`            varchar(45) NOT NULL,
    `exercise_id`      int(11)     NOT NULL,
    `question_type_id` int(11)     NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `id_UNIQUE` (`id`),
    KEY `fk_Questions_Exercises_idx` (`exercise_id`),
    KEY `fk_questions_question_types1_idx` (`question_type_id`),
    CONSTRAINT `fk_Questions_Exercises` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_questions_question_types1` FOREIGN KEY (`question_type_id`) REFERENCES `question_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- Listage des données de la table looper_test.questions : ~2 rows (environ)
/*!40000 ALTER TABLE `questions`
    DISABLE KEYS */;
INSERT INTO `questions` (`id`, `label`, `exercise_id`, `question_type_id`)
VALUES (1, 'Question to answer', 2, 0),
       (2, 'Closed Question', 3, 1);
/*!40000 ALTER TABLE `questions`
    ENABLE KEYS */;

-- Listage de la structure de la table looper_test. question_types
CREATE TABLE IF NOT EXISTS `question_types`
(
    `id`   int(11)     NOT NULL,
    `name` varchar(45) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- Listage des données de la table looper_test.question_types : ~3 rows (environ)
/*!40000 ALTER TABLE `question_types`
    DISABLE KEYS */;
INSERT INTO `question_types` (`id`, `name`)
VALUES (1, 'Single Line Text'),
       (2, 'Single Line List'),
       (3, 'Multi Line Text');
/*!40000 ALTER TABLE `question_types`
    ENABLE KEYS */;

-- Listage de la structure de la table looper_test. takes
CREATE TABLE IF NOT EXISTS `takes`
(
    `id`        int(11)  NOT NULL AUTO_INCREMENT,
    `timestamp` datetime NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- Listage des données de la table looper_test.takes : ~2 rows (environ)
/*!40000 ALTER TABLE `takes`
    DISABLE KEYS */;
INSERT INTO `takes` (`timestamp`)
VALUES ('2021-09-10 11:16:58'),
       ('2021-09-10 11:18:11');
/*!40000 ALTER TABLE `takes`
    ENABLE KEYS */;

/*!40101 SET SQL_MODE = IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS = IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
