<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * Install database
 *
 * @package    core\database
 * @author     Christopher Abram
 * @version    1.0
 * @date	16.10.2016
 */
 
$queries = array(
    
    'drop_file_miniature'   => 'DROP TABLE IF EXISTS file_miniature',
    'drop_file'             => 'DROP TABLE IF EXISTS file',
    'drop_alter_user'       => 'ALTER TABLE user DROP FOREIGN KEY `user_file_info_fk`',
    'drop_file_info'        => 'DROP TABLE IF EXISTS file_info',
    'drop_address'          => 'DROP TABLE IF EXISTS address',
    'drop_agreement'        => 'DROP TABLE IF EXISTS agreement',
    'drop_user'             => 'DROP TABLE IF EXISTS user',
    'drop_user_archive'     => 'DROP TABLE IF EXISTS user_archive',
    'drop_user_role'        => 'DROP TABLE IF EXISTS user_role',
    'drop_country'          => 'DROP TABLE IF EXISTS country',
    'drop_department'       => 'DROP TABLE IF EXISTS department',
    'drop_responsibility'   => 'DROP TABLE IF EXISTS responsibility',
    'drop_working_time'     => 'DROP TABLE IF EXISTS working_time',
    
    'country' =>
    'CREATE TABLE IF NOT EXISTS country (
	`id`		INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
   	`name`		VARCHAR(128) NOT NULL,
	`short`		VARCHAR(5)
    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;',
    
    
    'user_role' =>
    'CREATE TABLE IF NOT EXISTS user_role (
	`id`		INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`access_level`	TINYINT(1) NOT NULL DEFAULT 0,
	`name`		VARCHAR(32) NOT NULL
    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;',
    
    
    'user'  =>
    'CREATE TABLE IF NOT EXISTS user (
	`id`		INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `email` 	VARCHAR(100) NOT NULL,
	`password` 	VARCHAR(40) NOT NULL,
	`firstname` 	VARCHAR(100) NOT NULL,
	`lastname` 	VARCHAR(100) NOT NULL,
   	`phone` 	VARCHAR(20),
	`user_role_id`	INT(11) UNSIGNED NULL,
   	`firstaccess` 	BIGINT(10),
   	`lastaccess` 	BIGINT(10),
   	`lastlogin` 	BIGINT(10),
   	`avatar` 	INT(11) UNSIGNED,
	`sex`		ENUM(\'F\', \'M\') NOT NULL,
	`cdate` 	DATETIME,
	`bdate`		DATE,
	`description` 	TEXT,
	`citation`	VARCHAR(255),
	`isactive` 	TINYINT(1) DEFAULT 1,
	`bin`		TINYINT(1) DEFAULT 0,
	`token` 	VARCHAR(40) NOT NULL UNIQUE,
        `profile`       TINYINT(1) DEFAULT 0,
	
	CONSTRAINT `user_user_role_fk` FOREIGN KEY (`user_role_id`) REFERENCES `user_role`(`id`) ON UPDATE CASCADE ON DELETE SET NULL,
  	UNIQUE KEY  `user_key` ( `email` )

    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;',
    
    
    'user_archive'  =>
    "CREATE TABLE IF NOT EXISTS user_archive (
	`user_id`	INT(11) UNSIGNED NOT NULL,
        `email` 	VARCHAR(100),
	`password` 	VARCHAR(40),
	`firstname` 	VARCHAR(100),
	`lastname` 	VARCHAR(100),
   	`phone` 	VARCHAR(20),
	`user_role_id`	INT(11) UNSIGNED,
   	`avatar` 	INT(11) UNSIGNED,
	`sex`		ENUM('F', 'M'),
	`edate` 	DATETIME,
	`bdate`		DATE,
	`description` 	TEXT,
	`citation`	VARCHAR(255)

    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin
    PARTITION BY LIST(MONTH(edate))
    SUBPARTITION BY HASH(DAY(edate))
    SUBPARTITIONS 2 (
        PARTITION eJan VALUES IN(1) (
            SUBPARTITION p0,
            SUBPARTITION p1
        ),
        PARTITION eFeb VALUES IN(2) (
            SUBPARTITION p2,
            SUBPARTITION p3
        ),
        PARTITION eMar VALUES IN(3) (
            SUBPARTITION p4,
            SUBPARTITION p5
        ),
        PARTITION eApr VALUES IN(4) (
            SUBPARTITION p6,
            SUBPARTITION p7
        ),
        PARTITION eMay VALUES IN(5) (
            SUBPARTITION p8,
            SUBPARTITION p9
        ),
        PARTITION eJun VALUES IN(6) (
            SUBPARTITION p10,
            SUBPARTITION p11
        ),
        PARTITION eJul VALUES IN(7) (
            SUBPARTITION p12,
            SUBPARTITION p13
        ),
        PARTITION eAug VALUES IN(8) (
            SUBPARTITION p14,
            SUBPARTITION p15
        ),
        PARTITION eSep VALUES IN(9) (
            SUBPARTITION p16,
            SUBPARTITION p17
        ),
        PARTITION eOct VALUES IN(10) (
            SUBPARTITION p18,
            SUBPARTITION p19
        ),
        PARTITION eNov VALUES IN(11) (
            SUBPARTITION p20,
            SUBPARTITION p21
        ),
        PARTITION eDec VALUES IN(12) (
            SUBPARTITION p22,
            SUBPARTITION p23
        )
    )",
    
    
    'address'   => 
    'CREATE TABLE IF NOT EXISTS address (
	`id`		INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`country_id`	INT(11) UNSIGNED NULL,
	`user_id`	INT(11) UNSIGNED NOT NULL,
   	`city`		VARCHAR(128) NOT NULL,
	`zip`		VARCHAR(10),
	`street`	VARCHAR(128) NOT NULL,
	`house`		VARCHAR(16) NOT NULL,
	`flat`		VARCHAR(16),

	CONSTRAINT `address_user_fk` FOREIGN KEY (`user_id`) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT `address_country_fk` FOREIGN KEY (`country_id`) REFERENCES country(id) ON UPDATE CASCADE ON DELETE SET NULL

    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;',
    
    
    'file_info' =>
    'CREATE TABLE IF NOT EXISTS file_info (
	`id`		INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  	`name`		VARCHAR(255) NOT NULL,
  	`description` 	TEXT,
  	`size`		INT(10) UNSIGNED DEFAULT 0,
  	`mtime`		INT(10) UNSIGNED,
  	`cdate`     	DATETIME DEFAULT NULL,
  	`mime`      	VARCHAR(255) DEFAULT \'unknown\',
  	`read`      	TINYINT(1) DEFAULT 1,
  	`write`     	TINYINT(1) DEFAULT 1,
  	`locked`    	TINYINT(1) DEFAULT 0,
  	`hide`    	TINYINT(1) DEFAULT 0,
	`bin`	      	TINYINT(1) DEFAULT 0,
  	`width`     	INT(5) DEFAULT 0,
  	`height`	INT(5) DEFAULT 0,
	`extension`  	VARCHAR(8) DEFAULT \'unknown\',
  	`user_id`	INT(11) UNSIGNED NOT NULL,

	CONSTRAINT `file_info_user_fk` FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ON DELETE CASCADE ON UPDATE CASCADE

    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;',
    
    
    'alter_user'    => 'ALTER TABLE user ADD CONSTRAINT `user_file_info_fk` FOREIGN KEY (`avatar`) REFERENCES `file_info`(`id`) ON DELETE SET NULL;',
    
    
    'file'  =>
    'CREATE TABLE IF NOT EXISTS file (
	`id`		INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`file_info_id`	INT(11) UNSIGNED NOT NULL,
	`content`	LONGBLOB NOT NULL,
	
        UNIQUE (`file_info_id`),
	CONSTRAINT `file_file_info_fk` FOREIGN KEY (`file_info_id`) REFERENCES `file_info`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
	
    ) DEFAULT CHARSET=utf8 COLLATE=utf8_bin;',
    
    
    'file_miniature' => 
    'CREATE TABLE IF NOT EXISTS file_miniature (
	`id`		INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`file_info_id`	INT(11) UNSIGNED NOT NULL,
	`content`	BLOB NOT NULL,
	
        UNIQUE (`file_info_id`),
	CONSTRAINT `file_miniature_file_info_fk` FOREIGN KEY (`file_info_id`) REFERENCES `file_info`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
	
    ) DEFAULT CHARSET=utf8 COLLATE=utf8_bin;',
    
    
    
    
    
    
    'department' =>
    'CREATE TABLE IF NOT EXISTS department (
	`id`		INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `namepath` 	VARCHAR(255),
	`name`          VARCHAR(256) NOT NULL,
        `description`   TEXT,
   	`city`		VARCHAR(128) NOT NULL,
	`zip`		VARCHAR(10) NOT NULL,
	`street`	VARCHAR(128) NOT NULL,
	`house`		VARCHAR(16) NOT NULL,
	`flat`		VARCHAR(16),

        UNIQUE KEY `namepath` (`namepath`)

    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;',
    
    
    'responsibility' => 
    'CREATE TABLE IF NOT EXISTS responsibility (
	`id`		INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name`          VARCHAR(256) NOT NULL,
        `description`   TEXT
    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;',
    
    
    'working_time' =>
    'CREATE TABLE IF NOT EXISTS working_time (
	`id`		INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `name`          VARCHAR(256) NOT NULL
    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;',
    
    
    'agreement' =>
    'CREATE TABLE IF NOT EXISTS agreement (
	`id`                    INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        
        `user_id`               INT(11) UNSIGNED NOT NULL,
        `department_id`         INT(11) UNSIGNED NOT NULL,
        `responsibility_id`     INT(11) UNSIGNED NOT NULL,
        `working_time_id`       INT(11) UNSIGNED NOT NULL,
        
	`salary`                DECIMAL(12,2) UNSIGNED DEFAULT 0,
        `from_date`             DATE NOT NULL,
        `to_date`               DATE,
        `description`           TEXT,
        
        CONSTRAINT `agreement_user_fk` FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
        CONSTRAINT `agreement_department_fk` FOREIGN KEY (`department_id`) REFERENCES `department`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
        CONSTRAINT `agreement_responsibility_fk` FOREIGN KEY (`responsibility_id`) REFERENCES `responsibility`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
        CONSTRAINT `agreement_working_time_fk` FOREIGN KEY (`working_time_id`) REFERENCES `working_time`(`id`) ON DELETE CASCADE ON UPDATE CASCADE

    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;',
    
    
    
    
    
    
    
    'full_user_view' => 
    'CREATE OR REPLACE VIEW user_full
        AS
        SELECT 
            user.id, email, password, firstname, lastname, phone, firstaccess, lastaccess, lastlogin, avatar, sex, cdate, bdate, description, citation, isactive, bin, token, country.name AS `country`, city, zip, street, house, flat, access_level, user_role.name AS `role`
        FROM user
        LEFT JOIN address ON address.user_id = user.id
        LEFT JOIN country ON country.id = address.country_id
        INNER JOIN user_role ON user.user_role_id = user_role.id',
    
    
    
    
    'user_trigger' =>
    'CREATE TRIGGER archive_user AFTER UPDATE ON user FOR EACH ROW
     BEGIN
        IF (old.email <> new.email OR 
            old.password <> new.password OR 
            old.firstname <> new.firstname OR 
            old.lastname <> new.lastname OR 
            old.phone <> new.phone OR 
            old.user_role_id <> new.user_role_id OR 
            old.avatar <> new.avatar OR 
            old.sex <> new.sex OR 
            old.bdate <> new.bdate OR 
            old.description <> new.description OR 
            old.citation <> new.citation) THEN
            INSERT INTO user_archive(user_id, email, password, firstname, lastname, phone, edate, user_role_id, avatar, sex, bdate, description, citation) VALUES(new.id, new.email, new.password, new.firstname, new.lastname, new.phone, SYSDATE(), new.user_role_id, new.avatar, new.sex, new.bdate, new.description, new.citation);
        END IF;
     END',
    
    'drop_function_count_days'    => 'DROP FUNCTION IF EXISTS count_days',
    'drop_function_month_job'    => 'DROP FUNCTION IF EXISTS month_job',
    'drop_function_contract_job'    => 'DROP FUNCTION IF EXISTS contract_job',
    'drop_function_total_job'    => 'DROP FUNCTION IF EXISTS total_job',
    'drop_function_total_contract'    => 'DROP FUNCTION IF EXISTS total_contract',
    'drop_function_month_salary'    => 'DROP FUNCTION IF EXISTS month_salary',
    'drop_function_contract_salary'    => 'DROP FUNCTION IF EXISTS contract_salary',
    
    'count_days' =>
    'CREATE FUNCTION count_days(a_id INT UNSIGNED)
        RETURNS INT
     BEGIN
        DECLARE r INT DEFAULT 0;
        DECLARE td DATE;
        DECLARE fd DATE;
        DECLARE curr_date DATE;
        
        SET curr_date = curdate();
        SELECT from_date, to_date INTO fd, td FROM agreement WHERE id = a_id;
        
        IF td IS NULL THEN
            SET r = datediff(curr_date, fd);
        ELSEIF td <= curr_date THEN
            SET r = datediff(td, fd);
        ELSE
            SET r = datediff(curr_date, fd);
        END IF;
        
        RETURN r;
     END',
    
    'month_job' =>
    'CREATE FUNCTION month_job(working_time_id INT UNSIGNED)
        RETURNS INT
     BEGIN
        DECLARE r INT DEFAULT 0;
        
        IF working_time_id IN(1, 2, 8) THEN
            SET r = 1;
        ELSE
            SET r = 0;
        END IF;
        
        RETURN r;
     END',
    
    'contract_job' =>
    'CREATE FUNCTION contract_job(working_time_id INT UNSIGNED)
        RETURNS INT
     BEGIN
        RETURN (1 - month_job(working_time_id));
     END',
    
    'total_job' =>
    'CREATE FUNCTION total_job(u_id INT UNSIGNED)
        RETURNS DECIMAL(12, 2)
     BEGIN
        DECLARE total DECIMAL(12,2);
        SET total = (SELECT ROUND(SUM((count_days(id) / 30) * salary), 2) FROM agreement WHERE user_id = u_id AND month_job(working_time_id) = 1);
        IF total IS NULL THEN
            SET total = 0;
        END IF;
        RETURN total;
     END',
    
    'total_contract' =>
    'CREATE FUNCTION total_contract(u_id INT UNSIGNED)
        RETURNS DECIMAL(12, 2)
     BEGIN
        DECLARE total DECIMAL(12,2);
        SET total = (SELECT ROUND(SUM(salary), 2) FROM agreement WHERE user_id = u_id AND contract_job(working_time_id) = 1 AND (to_date <= curdate() OR to_date IS NULL));
        IF total IS NULL THEN
            SET total = 0;
        END IF;
        RETURN total;
     END',
    
    'month_salary' =>
    'CREATE FUNCTION month_salary(u_id INT UNSIGNED)
        RETURNS DECIMAL(12, 2)
     BEGIN
        DECLARE total DECIMAL(12,2);
        SET total = (SELECT ROUND(SUM(salary), 2) FROM agreement WHERE user_id = u_id AND month_job(working_time_id) = 1 AND (from_date <= curdate() && (to_date > curdate() OR to_date IS NULL)));
        IF total IS NULL THEN
            SET total = 0;
        END IF;
        RETURN total;
     END',
    
    'contract_salary' =>
    'CREATE FUNCTION contract_salary(u_id INT UNSIGNED)
        RETURNS DECIMAL(12, 2)
     BEGIN
        DECLARE total DECIMAL(12,2);
        SET total = (SELECT ROUND(SUM(salary), 2) FROM agreement WHERE user_id = u_id AND contract_job(working_time_id) = 1 AND (from_date <= curdate() && (to_date > curdate() OR to_date IS NULL)));
        IF total IS NULL THEN
            SET total = 0;
        END IF;
        RETURN total;
     END',
    
);
