-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `account_types`;
CREATE TABLE `account_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `activity_type` int(11) NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `activity_type` (`activity_type`),
  CONSTRAINT `activities_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `activities_ibfk_2` FOREIGN KEY (`activity_type`) REFERENCES `activity_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `activity_types`;
CREATE TABLE `activity_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `file_uploads`;
CREATE TABLE `file_uploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `file_type` varchar(4) DEFAULT NULL,
  `date_time` datetime NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `directory` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  CONSTRAINT `file_uploads_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `attempts` int(11) NOT NULL,
  `last_attempt` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`account_id`),
  CONSTRAINT `login_attempts_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `pw_reset_keys`;
CREATE TABLE `pw_reset_keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reset_key` varchar(64) NOT NULL,
  `account_id` int(11) NOT NULL,
  `used` tinyint(1) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `registration_keys`;
CREATE TABLE `registration_keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_key` varchar(12) NOT NULL,
  `type` int(11) NOT NULL,
  `used` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `security_questions`;
CREATE TABLE `security_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `security_question_sets`;
CREATE TABLE `security_question_sets` (
  `set_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `sec_question_1` int(11) NOT NULL,
  `sec_answer_1` varchar(255) NOT NULL,
  `sec_question_2` int(11) NOT NULL,
  `sec_answer_2` varchar(255) NOT NULL,
  `sec_question_3` int(11) NOT NULL,
  `sec_answer_3` varchar(255) NOT NULL,
  PRIMARY KEY (`set_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email_addr` varchar(50) DEFAULT NULL,
  `street_addr` varchar(50) DEFAULT NULL,
  `street_addr_2` varchar(50) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `zip` varchar(9) DEFAULT NULL,
  `phone_num` varchar(20) NOT NULL,
  `account_type` int(11) NOT NULL,
  `security_set` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2019-12-02 17:09:11
