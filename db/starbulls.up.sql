CREATE DATABASE `starbulls`;

USE `starbulls`;

CREATE TABLE `starbulls`.`review` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`score` FLOAT NOT NULL DEFAULT '5.0',
	`comment` TEXT NULL,
	`user_id` INT NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
);

CREATE TABLE `starbulls`.`user` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`firstName` VARCHAR(30) NOT NULL,
	`lastName` VARCHAR(30) NOT NULL,
	`email` VARCHAR(50) NOT NULL,
	`password` VARCHAR(50) NOT NULL,
	`phoneNumber` VARCHAR(14) NULL,
	`isPreferred` TINYINT NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`)
);