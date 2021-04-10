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
 `id` int NOT NULL AUTO_INCREMENT,
 `firstName` varchar(30) NOT NULL,
 `lastName` varchar(30) NOT NULL,
 `email` varchar(50) NOT NULL,
 `password` varchar(60) NOT NULL,
 `phoneNumber` varchar(14) DEFAULT NULL,
 `isPreferred` tinyint NOT NULL DEFAULT '0',
 `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `archivedAt` timestamp NULL DEFAULT NULL,
 PRIMARY KEY (`id`)
) 