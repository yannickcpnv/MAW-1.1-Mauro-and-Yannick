USE bkury42fzmxm2w0d;

-- -----------------------------------------------------
-- Table takes
-- -----------------------------------------------------
DROP TABLE IF EXISTS takes;

CREATE TABLE IF NOT EXISTS takes
(
    id        INT      NOT NULL AUTO_INCREMENT,
    timestamp DATETIME NOT NULL,
    PRIMARY KEY (id)
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table exercise_statuses
-- -----------------------------------------------------
DROP TABLE IF EXISTS exercise_statuses;

CREATE TABLE IF NOT EXISTS exercise_statuses
(
    id   INT         NOT NULL,
    name VARCHAR(45) NULL,
    PRIMARY KEY (id)
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table exercises
-- -----------------------------------------------------
DROP TABLE IF EXISTS exercises;

CREATE TABLE IF NOT EXISTS exercises
(
    id                 INT         NOT NULL AUTO_INCREMENT,
    title              VARCHAR(45) NOT NULL,
    exercise_status_id INT         NOT NULL,
    PRIMARY KEY (id),
    INDEX fk_exercises_exercise_statuses1_idx (exercise_status_id ASC),
    CONSTRAINT fk_exercises_exercise_statuses1
        FOREIGN KEY (exercise_status_id)
            REFERENCES exercise_statuses (id)
            ON DELETE CASCADE
            ON UPDATE CASCADE
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table question_types
-- -----------------------------------------------------
DROP TABLE IF EXISTS question_types;

CREATE TABLE IF NOT EXISTS question_types
(
    id   INT         NOT NULL,
    name VARCHAR(45) NOT NULL,
    PRIMARY KEY (id)
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table questions
-- -----------------------------------------------------
DROP TABLE IF EXISTS questions;

CREATE TABLE IF NOT EXISTS questions
(
    id               INT         NOT NULL AUTO_INCREMENT,
    label            VARCHAR(45) NOT NULL,
    exercise_id      INT         NOT NULL,
    question_type_id INT         NOT NULL,
    PRIMARY KEY (id),
    INDEX fk_Questions_Exercises_idx (exercise_id ASC),
    INDEX fk_questions_question_types1_idx (question_type_id ASC),
    CONSTRAINT fk_Questions_Exercises
        FOREIGN KEY (exercise_id)
            REFERENCES exercises (id)
            ON DELETE CASCADE
            ON UPDATE CASCADE,
    CONSTRAINT fk_questions_question_types1
        FOREIGN KEY (question_type_id)
            REFERENCES question_types (id)
            ON DELETE CASCADE
            ON UPDATE CASCADE
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table answers
-- -----------------------------------------------------
DROP TABLE IF EXISTS answers;

CREATE TABLE IF NOT EXISTS answers
(
    id          INT  NOT NULL AUTO_INCREMENT,
    take_id     INT  NOT NULL,
    question_id INT  NOT NULL,
    value       TEXT NOT NULL,
    INDEX fk_Takes_has_Questions_Questions1_idx (question_id ASC),
    INDEX fk_Takes_has_Questions_Takes1_idx (take_id ASC),
    PRIMARY KEY (id),
    CONSTRAINT fk_Takes_has_Questions_Takes1
        FOREIGN KEY (take_id)
            REFERENCES takes (id)
            ON DELETE CASCADE
            ON UPDATE CASCADE,
    CONSTRAINT fk_Takes_has_Questions_Questions1
        FOREIGN KEY (question_id)
            REFERENCES questions (id)
            ON DELETE CASCADE
            ON UPDATE CASCADE
) ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table Insertions
-- -----------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0 */;
/*!40101 SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES = @@SQL_NOTES, SQL_NOTES = 0 */;

-- Dumping data for table looper.answers: ~0 rows (approximately)
/*!40000 ALTER TABLE answers
    DISABLE KEYS */;
REPLACE INTO answers (take_id, question_id, value)
VALUES (1, 2, 'I\'m here POG'),
       (2, 2, 'OMG SAME POGGERS');
/*!40000 ALTER TABLE answers
    ENABLE KEYS */;

-- Dumping data for table looper.exercises: ~0 rows (approximately)
/*!40000 ALTER TABLE exercises
    DISABLE KEYS */;
REPLACE INTO exercises (id, title, exercise_status_id)
VALUES (1, 'Exercise 1', 1),
       (2, 'Exercise Building', 1),
       (3, 'Exercise Answering', 2),
       (4, 'Exercise Closed', 3);
/*!40000 ALTER TABLE exercises
    ENABLE KEYS */;

-- Dumping data for table looper.exercise_statuses: ~3 rows (approximately)
/*!40000 ALTER TABLE exercise_statuses
    DISABLE KEYS */;
REPLACE INTO exercise_statuses (id, name)
VALUES (1, 'Building'),
       (2, 'Answering'),
       (3, 'Closed');
/*!40000 ALTER TABLE exercise_statuses
    ENABLE KEYS */;

-- Dumping data for table looper.questions: ~0 rows (approximately)
/*!40000 ALTER TABLE questions
    DISABLE KEYS */;
REPLACE INTO questions (id, label, exercise_id, question_type_id)
VALUES (1, 'Question to answer', 3, 1),
       (2, 'Closed Question', 4, 2);
/*!40000 ALTER TABLE questions
    ENABLE KEYS */;

-- Dumping data for table looper.question_types: ~0 rows (approximately)
/*!40000 ALTER TABLE question_types
    DISABLE KEYS */;
REPLACE INTO question_types (id, name)
VALUES (1, 'Single Line Text'),
       (2, 'Single Line List'),
       (3, 'Multi Line Text');
/*!40000 ALTER TABLE question_types
    ENABLE KEYS */;

-- Dumping data for table looper.takes: ~0 rows (approximately)
/*!40000 ALTER TABLE takes
    DISABLE KEYS */;
REPLACE INTO takes (id, timestamp)
VALUES (1, '2021-09-10 11:16:58'),
       (2, '2021-09-10 11:18:11');
/*!40000 ALTER TABLE takes
    ENABLE KEYS */;

/*!40101 SET SQL_MODE = IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS = IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES = IFNULL(@OLD_SQL_NOTES, 1) */;
