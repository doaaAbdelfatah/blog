-- MySQL Script generated by MySQL Workbench
-- Sat Sep 25 11:20:31 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema blog_offline
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema blog_offline
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `blog_offline` DEFAULT CHARACTER SET utf8mb4 ;
USE `blog_offline` ;

-- -----------------------------------------------------
-- Table `blog_offline`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog_offline`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `mobile` CHAR(15) NULL,
  `name` VARCHAR(255) NULL,
  `password` VARCHAR(32) NULL,
  `gender` BIT NULL DEFAULT 0,
  `role` ENUM('admin', 'editor', 'user') NULL DEFAULT 'user',
  `active` BIT NULL DEFAULT 1,
  `avtar` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT current_timestamp,
  `created_by` INT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE,
  UNIQUE INDEX `mobile_UNIQUE` (`mobile` ASC) VISIBLE,
  INDEX `fk_created_by_idx` (`created_by` ASC) VISIBLE,
  CONSTRAINT `fk_created_by`
    FOREIGN KEY (`created_by`)
    REFERENCES `blog_offline`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `blog_offline`.`posts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog_offline`.`posts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `body` VARCHAR(45) NOT NULL,
  `image` VARCHAR(255) NULL DEFAULT 'posts\images\post_default.png',
  `created_by` INT NOT NULL,
  `status` ENUM('pending', 'approved', 'rejected') NULL DEFAULT 'pending',
  `action_by` INT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`),
  INDEX `fk_posts_users1_idx` (`created_by` ASC) VISIBLE,
  INDEX `fk_posts_users2_idx` (`action_by` ASC) VISIBLE,
  CONSTRAINT `fk_posts_users1`
    FOREIGN KEY (`created_by`)
    REFERENCES `blog_offline`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_posts_users2`
    FOREIGN KEY (`action_by`)
    REFERENCES `blog_offline`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `blog_offline`.`comments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog_offline`.`comments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `comment` VARCHAR(255) NULL,
  `post_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`),
  INDEX `fk_comments_posts1_idx` (`post_id` ASC) VISIBLE,
  INDEX `fk_comments_users1_idx` (`user_id` ASC) VISIBLE,
  CONSTRAINT `fk_comments_posts1`
    FOREIGN KEY (`post_id`)
    REFERENCES `blog_offline`.`posts` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `blog_offline`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `blog_offline`.`likes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog_offline`.`likes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `post_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `type` ENUM('like', 'love', 'care', 'angry') NULL DEFAULT 'like',
  PRIMARY KEY (`id`),
  INDEX `fk_table1_posts1_idx` (`post_id` ASC) VISIBLE,
  INDEX `fk_table1_users1_idx` (`user_id` ASC) VISIBLE,
  CONSTRAINT `fk_table1_posts1`
    FOREIGN KEY (`post_id`)
    REFERENCES `blog_offline`.`posts` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_table1_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `blog_offline`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;