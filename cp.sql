SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `giraudsa` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `giraudsa` ;

-- -----------------------------------------------------
-- Table `giraudsa`.`cp_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `giraudsa`.`cp_user` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `user_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `user_birthday` INT NOT NULL,
  `user_name` VARCHAR(45) NOT NULL,
  `user_firstname` VARCHAR(45) NOT NULL,
  `user_mail` VARCHAR(255) NOT NULL,
  `user_pseudo` VARCHAR(45) NULL,
  `user_password` VARCHAR(45) NOT NULL,
  `user_profil_pic` VARCHAR(255) NULL,
  PRIMARY KEY (`user_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `giraudsa`.`cp_phone`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `giraudsa`.`cp_phone` (
  `phone_id` INT NOT NULL AUTO_INCREMENT,
  `phone_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `phone_indi` VARCHAR(45) NOT NULL,
  `phone_num` VARCHAR(45) NOT NULL,
  `phone_type` ENUM('fixe', 'mobile') NOT NULL,
  `cp_user_user_id` INT NOT NULL,
  PRIMARY KEY (`phone_id`),
  INDEX `fk_cp_phone_cp_user1_idx` (`cp_user_user_id` ASC),
  CONSTRAINT `fk_cp_phone_cp_user1`
    FOREIGN KEY (`cp_user_user_id`)
    REFERENCES `giraudsa`.`cp_user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `giraudsa`.`cp_adress`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `giraudsa`.`cp_adress` (
  `adress_id` INT NOT NULL AUTO_INCREMENT,
  `ad_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `ad_num` VARCHAR(45) NULL,
  `ad_street` VARCHAR(255) NOT NULL,
  `ad_zipcode` VARCHAR(45) NOT NULL,
  `ad_city` VARCHAR(45) NOT NULL,
  `ad_country` VARCHAR(45) NOT NULL,
  `cp_user_user_id` INT NOT NULL,
  PRIMARY KEY (`adress_id`),
  INDEX `fk_cp_adress_cp_user1_idx` (`cp_user_user_id` ASC),
  CONSTRAINT `fk_cp_adress_cp_user1`
    FOREIGN KEY (`cp_user_user_id`)
    REFERENCES `giraudsa`.`cp_user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `giraudsa`.`cp_organism`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `giraudsa`.`cp_organism` (
  `user_type_orga` ENUM('company', 'association') NOT NULL,
  `user_orga_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `cp_user_user_id` INT NOT NULL,
  PRIMARY KEY (`cp_user_user_id`),
  CONSTRAINT `fk_cp_organism_cp_user1`
    FOREIGN KEY (`cp_user_user_id`)
    REFERENCES `giraudsa`.`cp_user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `giraudsa`.`cp_school`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `giraudsa`.`cp_school` (
  `school_id` INT NOT NULL AUTO_INCREMENT,
  `school_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `school_name` VARCHAR(45) NOT NULL,
  `school_city` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`school_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `giraudsa`.`cp_student`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `giraudsa`.`cp_student` (
  `certif` VARCHAR(255) NULL,
  `cp_user_user_id` INT NOT NULL,
  `cp_school_school_id` INT NOT NULL,
  PRIMARY KEY (`cp_user_user_id`),
  INDEX `fk_cp_student_cp_school1_idx` (`cp_school_school_id` ASC),
  CONSTRAINT `fk_cp_student_cp_user1`
    FOREIGN KEY (`cp_user_user_id`)
    REFERENCES `giraudsa`.`cp_user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cp_student_cp_school1`
    FOREIGN KEY (`cp_school_school_id`)
    REFERENCES `giraudsa`.`cp_school` (`school_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `giraudsa`.`cp_admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `giraudsa`.`cp_admin` (
  `user_isadmin` TINYINT(1) NOT NULL,
  `user_admin_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `cp_user_user_id` INT NOT NULL,
  PRIMARY KEY (`cp_user_user_id`),
  CONSTRAINT `fk_cp_admin_cp_user1`
    FOREIGN KEY (`cp_user_user_id`)
    REFERENCES `giraudsa`.`cp_user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `giraudsa`.`cp_bank_details`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `giraudsa`.`cp_bank_details` (
  `bank_id` INT NOT NULL,
  `num_card` VARCHAR(45) NULL,
  `name_card` VARCHAR(45) NULL,
  `crypto_card` VARCHAR(45) NULL,
  `expiration_card` VARCHAR(45) NULL,
  PRIMARY KEY (`bank_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `giraudsa`.`cp_group`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `giraudsa`.`cp_group` (
  `group_id` INT NOT NULL AUTO_INCREMENT,
  `group_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `group_name` VARCHAR(45) NULL,
  `group_descr` VARCHAR(45) NULL,
  `group_img` VARCHAR(45) NULL,
  PRIMARY KEY (`group_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `giraudsa`.`cp_user_has_group`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `giraudsa`.`cp_user_has_group` (
  `user_user_id` INT NULL,
  `group_group_id` INT NOT NULL,
  `cp_group_group_id` INT NOT NULL,
  `cp_user_user_id` INT NOT NULL,
  PRIMARY KEY (`user_user_id`, `group_group_id`, `cp_group_group_id`, `cp_user_user_id`),
  INDEX `fk_cp_user_has_group_cp_group1_idx` (`cp_group_group_id` ASC),
  INDEX `fk_cp_user_has_group_cp_user1_idx` (`cp_user_user_id` ASC),
  CONSTRAINT `fk_cp_user_has_group_cp_group1`
    FOREIGN KEY (`cp_group_group_id`)
    REFERENCES `giraudsa`.`cp_group` (`group_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cp_user_has_group_cp_user1`
    FOREIGN KEY (`cp_user_user_id`)
    REFERENCES `giraudsa`.`cp_user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `giraudsa`.`cp_event`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `giraudsa`.`cp_event` (
  `event_id` INT NOT NULL AUTO_INCREMENT,
  `event_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `event_name` VARCHAR(45) NULL,
  `event_decr` VARCHAR(45) NULL,
  `event_img` VARCHAR(45) NULL,
  PRIMARY KEY (`event_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `giraudsa`.`cp_event_has_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `giraudsa`.`cp_event_has_user` (
  `event_event_id` INT NOT NULL,
  `user_user_id` INT NOT NULL,
  `cp_user_user_id` INT NOT NULL,
  `cp_event_event_id` INT NOT NULL,
  PRIMARY KEY (`event_event_id`, `user_user_id`, `cp_user_user_id`, `cp_event_event_id`),
  INDEX `fk_cp_event_has_user_cp_user1_idx` (`cp_user_user_id` ASC),
  INDEX `fk_cp_event_has_user_cp_event1_idx` (`cp_event_event_id` ASC),
  CONSTRAINT `fk_cp_event_has_user_cp_user1`
    FOREIGN KEY (`cp_user_user_id`)
    REFERENCES `giraudsa`.`cp_user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cp_event_has_user_cp_event1`
    FOREIGN KEY (`cp_event_event_id`)
    REFERENCES `giraudsa`.`cp_event` (`event_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `giraudsa`.`cp_event_has_group`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `giraudsa`.`cp_event_has_group` (
  `event_event_id` INT NOT NULL,
  `group_group_id` INT NOT NULL,
  `cp_group_group_id` INT NOT NULL,
  `cp_event_event_id` INT NOT NULL,
  PRIMARY KEY (`event_event_id`, `group_group_id`, `cp_group_group_id`, `cp_event_event_id`),
  INDEX `fk_cp_event_has_group_cp_group1_idx` (`cp_group_group_id` ASC),
  INDEX `fk_cp_event_has_group_cp_event1_idx` (`cp_event_event_id` ASC),
  CONSTRAINT `fk_cp_event_has_group_cp_group1`
    FOREIGN KEY (`cp_group_group_id`)
    REFERENCES `giraudsa`.`cp_group` (`group_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cp_event_has_group_cp_event1`
    FOREIGN KEY (`cp_event_event_id`)
    REFERENCES `giraudsa`.`cp_event` (`event_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `giraudsa`.`cp_donate`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `giraudsa`.`cp_donate` (
  `donate_id` INT NOT NULL AUTO_INCREMENT,
  `donate_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `donate_amount` DECIMAL(10) NULL,
  `donate_tva` DECIMAL(10) NULL,
  `cp_user_user_id` INT NOT NULL,
  `cp_group_group_id` INT NOT NULL,
  PRIMARY KEY (`donate_id`),
  INDEX `fk_cp_donate_cp_user1_idx` (`cp_user_user_id` ASC),
  INDEX `fk_cp_donate_cp_group1_idx` (`cp_group_group_id` ASC),
  CONSTRAINT `fk_cp_donate_cp_user1`
    FOREIGN KEY (`cp_user_user_id`)
    REFERENCES `giraudsa`.`cp_user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cp_donate_cp_group1`
    FOREIGN KEY (`cp_group_group_id`)
    REFERENCES `giraudsa`.`cp_group` (`group_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `giraudsa`.`cp_event_trash`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `giraudsa`.`cp_event_trash` (
  `trash_id` VARCHAR(45) NOT NULL,
  `trash_date` TIMESTAMP NOT NULL,
  `trash_event_id` INT NOT NULL,
  `trash_event_date` TIMESTAMP NULL,
  `trash_event_name` VARCHAR(45) NOT NULL,
  `trash_event_decr` VARCHAR(45) NOT NULL,
  `trash_event_img` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`trash_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `giraudsa`.`cp_event_trash`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `giraudsa`.`cp_event_trash` (
  `trash_id` VARCHAR(45) NOT NULL,
  `trash_date` TIMESTAMP NOT NULL,
  `trash_event_id` INT NOT NULL,
  `trash_event_date` TIMESTAMP NULL,
  `trash_event_name` VARCHAR(45) NOT NULL,
  `trash_event_decr` VARCHAR(45) NOT NULL,
  `trash_event_img` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`trash_id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
