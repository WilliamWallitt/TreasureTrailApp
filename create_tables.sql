
-- ;==========================================
-- Title:  Create Tables - MySQL
-- Author: William Wallitt, Justin Van Daalen, Edward Soutar
-- Date:   25 Feb 2020
-- ========================================== -->

CREATE TABLE `departments` (
  `department_id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `department_name` varchar(255) NOT NULL
);

CREATE TABLE `buildings` (
  `building_id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `building_name` varchar(255) NOT NULL,
  `latitude` decimal(9,6) NOT NULL,
  `longitude` decimal(9,6) NOT NULL,
  `extra_info` varchar(255) NOT NULL
);

CREATE TABLE `routes` (
  `route_id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `department_id` int NOT NULL,
  `building_id` int NOT NULL,
  FOREIGN KEY (`department_id`) REFERENCES `departments`(`department_id`),
  FOREIGN KEY (`building_id`) REFERENCES `buildings`(`building_id`)
);

CREATE TABLE `clues` (
  `clue_id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `building_id` int NOT NULL,
  `clue` varchar(255) NOT NULL,
  FOREIGN KEY (`building_id`) REFERENCES `buildings`(`building_id`)
);

CREATE TABLE `answers` (
  `answer_id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `clue_id` int NOT NULL,
  `answer` varchar(255) NOT NULL,
  `correct` bit NOT NULL DEFAULT 0,
  FOREIGN KEY (`clue_id`) REFERENCES `clues`(`clue_id`)
);

CREATE TABLE `faq` (
  `faq_id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL
);

CREATE TABLE `game_keepers` (
  `game_keeper_id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
);

CREATE TABLE `users` (
  `user_id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `team_name` varchar(255) NOT NULL,
  `department_id` int NOT NULL,
  `current_building_id` int NOT NULL,
  `score` int NOT NULL DEFAULT 0,
  `completed` bit NOT NULL DEFAULT 0,
  FOREIGN KEY (`department_id`) REFERENCES `departments`(`department_id`),
  FOREIGN KEY (`current_building_id`) REFERENCES `buildings`(`building_id`)
);
