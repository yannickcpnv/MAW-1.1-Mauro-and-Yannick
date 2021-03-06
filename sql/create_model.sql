-- MySQL Script generated by MySQL Workbench
-- Mon Nov 22 11:16:12 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0;
SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0;
SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE =
        'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema looper
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `looper`;

-- -----------------------------------------------------
-- Schema looper
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `looper` DEFAULT CHARACTER SET utf8;
USE `looper`;

-- -----------------------------------------------------
-- Table `looper`.`takes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `looper`.`takes`;

CREATE TABLE IF NOT EXISTS `looper`.`takes`
(
    `id`        INT      NOT NULL AUTO_INCREMENT,
    `timestamp` DATETIME NOT NULL,
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `looper`.`exercise_statuses`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `looper`.`exercise_statuses`;

CREATE TABLE IF NOT EXISTS `looper`.`exercise_statuses`
(
    `id`   INT         NOT NULL,
    `name` VARCHAR(45) NULL,
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `looper`.`exercises`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `looper`.`exercises`;

CREATE TABLE IF NOT EXISTS `looper`.`exercises`
(
    `id`                 INT         NOT NULL AUTO_INCREMENT,
    `title`              VARCHAR(45) NOT NULL,
    `exercise_status_id` INT         NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `fk_exercises_exercise_statuses1_idx` (`exercise_status_id` ASC),
    CONSTRAINT `fk_exercises_exercise_statuses1`
        FOREIGN KEY (`exercise_status_id`)
            REFERENCES `looper`.`exercise_statuses` (`id`)
            ON DELETE CASCADE
            ON UPDATE CASCADE
)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `looper`.`question_types`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `looper`.`question_types`;

CREATE TABLE IF NOT EXISTS `looper`.`question_types`
(
    `id`   INT         NOT NULL,
    `name` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `looper`.`questions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `looper`.`questions`;

CREATE TABLE IF NOT EXISTS `looper`.`questions`
(
    `id`               INT         NOT NULL AUTO_INCREMENT,
    `label`            VARCHAR(45) NOT NULL,
    `exercise_id`      INT         NOT NULL,
    `question_type_id` INT         NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `fk_Questions_Exercises_idx` (`exercise_id` ASC),
    INDEX `fk_questions_question_types1_idx` (`question_type_id` ASC),
    CONSTRAINT `fk_Questions_Exercises`
        FOREIGN KEY (`exercise_id`)
            REFERENCES `looper`.`exercises` (`id`)
            ON DELETE CASCADE
            ON UPDATE CASCADE,
    CONSTRAINT `fk_questions_question_types1`
        FOREIGN KEY (`question_type_id`)
            REFERENCES `looper`.`question_types` (`id`)
            ON DELETE CASCADE
            ON UPDATE CASCADE
)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `looper`.`answers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `looper`.`answers`;

CREATE TABLE IF NOT EXISTS `looper`.`answers`
(
    `id`          INT  NOT NULL AUTO_INCREMENT,
    `take_id`     INT  NOT NULL,
    `question_id` INT  NOT NULL,
    `value`       TEXT NOT NULL,
    INDEX `fk_Takes_has_Questions_Questions1_idx` (`question_id` ASC),
    INDEX `fk_Takes_has_Questions_Takes1_idx` (`take_id` ASC),
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_Takes_has_Questions_Takes1`
        FOREIGN KEY (`take_id`)
            REFERENCES `looper`.`takes` (`id`)
            ON DELETE CASCADE
            ON UPDATE CASCADE,
    CONSTRAINT `fk_Takes_has_Questions_Questions1`
        FOREIGN KEY (`question_id`)
            REFERENCES `looper`.`questions` (`id`)
            ON DELETE CASCADE
            ON UPDATE CASCADE
)
    ENGINE = InnoDB;

SET SQL_MODE = @OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS;
