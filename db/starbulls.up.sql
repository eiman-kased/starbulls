CREATE DATABASE `starbulls`;

USE `starbulls`;

CREATE TABLE `starbulls`.`review` (
 `id` int NOT NULL AUTO_INCREMENT,
 `score` float NOT NULL DEFAULT '5',
 `comment` text,
 `userID` int DEFAULT NULL,
 `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `archivedAt` timestamp NULL DEFAULT NULL,
 PRIMARY KEY (`id`)
);

CREATE TABLE `starbulls`.`user` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`firstName` VARCHAR(30) NOT NULL,
	`lastName` VARCHAR(30) NOT NULL,
	`email` VARCHAR(50) NOT NULL,
	`password` VARCHAR(60) NOT NULL,
	`phoneNumber` VARCHAR(14) NULL,
	`isPreferred` TINYINT NOT NULL DEFAULT '0',
	`createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
);