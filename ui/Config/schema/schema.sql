SET NAMES utf8;

DROP TABLE IF EXISTS `acos`;
CREATE TABLE IF NOT EXISTS `acos`(
	`id` int(11) NOT NULL AUTO_INCREMENT, 
	`parent_id` int(11), 
	`model` varchar(64), 
	`foreign_key` int(11), 
	`alias` varchar(128), 
	`lft` int(11), 
	`rght` int(11), 
	PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `aros`;
CREATE TABLE IF NOT EXISTS `aros`(
	`id` int(11) NOT NULL AUTO_INCREMENT, 
	`parent_id` int(11), 
	`model` varchar(64), 
	`foreign_key` int(11), 
	`alias` varchar(128), 
	`lft` int(11), 
	`rght` int(11), 
	PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `aros_acos`;
CREATE TABLE IF NOT EXISTS `aros_acos`(
	`id` int(11) NOT NULL AUTO_INCREMENT, 
	`aro_id` int(11), 
	`aco_id` int(11), 
	`_create` int(2) DEFAULT NULL, 
	`_read` int(2) DEFAULT NULL, 
	`_update` int(2) DEFAULT NULL, 
	`_delete` int(2) DEFAULT NULL, 
	PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members`(
	`id` int(11) NOT NULL AUTO_INCREMENT, 
	`group_id` int(11), 
	`username` varchar(64), 
	`password` varchar(48), 
	`user_status` varchar(1) DEFAULT 'N', 
	`created` datetime, 
	`modified` datetime, 
	PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups`(
	`id` int(11) NOT NULL AUTO_INCREMENT, 
	`parent_id` int(11), 
	`name` varchar(64), 
	PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `group_permissions`;
CREATE TABLE IF NOT EXISTS `group_permissions`(
	`id` int(11) NOT NULL AUTO_INCREMENT, 
	`parent_id` int(11), 
	`order` int(11), 
	`name` varchar(64), 
	`description` varchar(255) DEFAULT NULL, 
	`acos` varchar(255), 
	PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `news_infos`;
CREATE TABLE IF NOT EXISTS `news_infos`(
	`id` int(11) NOT NULL AUTO_INCREMENT, 
	`news_id` varchar(255) DEFAULT NULL, 
	`time` varchar(255) DEFAULT NULL, 
	`title` varchar(255) DEFAULT NULL, 
	`body` varchar(255) DEFAULT NULL, 
	PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

