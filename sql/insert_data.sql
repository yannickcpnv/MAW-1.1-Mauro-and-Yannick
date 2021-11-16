-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.5.10-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

use looper;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0 */;
/*!40101 SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES = @@SQL_NOTES, SQL_NOTES = 0 */;

-- Dumping data for table looper.answers: ~0 rows (approximately)
/*!40000 ALTER TABLE `answers`
    DISABLE KEYS */;
REPLACE INTO `answers` (`take_id`, `question_id`, `value`)
VALUES (1, 2, 'I\'m here POG'),
       (2, 2, 'OMG SAME POGGERS');
/*!40000 ALTER TABLE `answers`
    ENABLE KEYS */;

-- Dumping data for table looper.exercises: ~0 rows (approximately)
/*!40000 ALTER TABLE `exercises`
    DISABLE KEYS */;
REPLACE INTO `exercises` (`id`, `title`, `exercise_status_id`)
VALUES (1, 'Exercise 1', 1),
       (2, 'Exercise Building', 1),
       (3, 'Exercise Answering', 2),
       (4, 'Exercise Closed', 3);
/*!40000 ALTER TABLE `exercises`
    ENABLE KEYS */;

-- Dumping data for table looper.exercise_statuses: ~3 rows (approximately)
/*!40000 ALTER TABLE `exercise_statuses`
    DISABLE KEYS */;
REPLACE INTO `exercise_statuses` (`id`, `name`)
VALUES (1, 'Building'),
       (2, 'Answering'),
       (3, 'Closed');
/*!40000 ALTER TABLE `exercise_statuses`
    ENABLE KEYS */;

-- Dumping data for table looper.questions: ~0 rows (approximately)
/*!40000 ALTER TABLE `questions`
    DISABLE KEYS */;
REPLACE INTO `questions` (`id`, `label`, `exercise_id`, `question_type_id`)
VALUES (1, 'Question to answer', 3, 1),
       (2, 'Closed Question', 4, 2);
/*!40000 ALTER TABLE `questions`
    ENABLE KEYS */;

-- Dumping data for table looper.question_types: ~0 rows (approximately)
/*!40000 ALTER TABLE `question_types`
    DISABLE KEYS */;
REPLACE INTO `question_types` (`id`, `name`)
VALUES (1, 'Single Line Text'),
       (2, 'Single Line List'),
       (3, 'Multi Line Text');
/*!40000 ALTER TABLE `question_types`
    ENABLE KEYS */;

-- Dumping data for table looper.takes: ~0 rows (approximately)
/*!40000 ALTER TABLE `takes`
    DISABLE KEYS */;
REPLACE INTO `takes` (`id`, `timestamp`)
VALUES (1, '2021-09-10 11:16:58'),
       (2, '2021-09-10 11:18:11');
/*!40000 ALTER TABLE `takes`
    ENABLE KEYS */;

/*!40101 SET SQL_MODE = IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
