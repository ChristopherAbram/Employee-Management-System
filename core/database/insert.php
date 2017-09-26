<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * Initial Insert into database
 *
 * @package    core\database
 * @author     Christopher Abram
 * @version    1.0
 * @date	16.10.2016
 */
 
$inserts = array(
    
    'insert_user_role_1' => "INSERT INTO user_role(id, access_level, name) VALUES(1, 0, 'Administrator')",
    'insert_user_role_2' => "INSERT INTO user_role(id, access_level, name) VALUES(2, 1, 'Plain')",
    
    
    'insert_user_admin'         => "INSERT INTO user(email, password, firstname, lastname, user_role_id, sex, cdate, bdate, isactive, token) VALUES('admin@gmail.com', '".\core\functions\password('password')."', 'Carl', 'Sagan', 1, 'M', '".date(\DATETIME)."', '1934-11-9', 1, '". \core\functions\token('carlsaganpassword')."')",
    'insert_user_plain'         => "INSERT INTO user(email, password, firstname, lastname, user_role_id, sex, cdate, bdate, isactive, token) VALUES('plain@gmail.com', '".\core\functions\password('password')."', 'Mark', 'Zuckerberg', 1, 'M', '".date(\DATETIME)."', '1984-5-14', 1, '". \core\functions\token('markzuckerbergpassword')."')",
    
    
    'insert_address_1'  => "INSERT INTO address(user_id, country_id, city) VALUES(1, 233, 'New York')",
    'insert_address_2'  => "INSERT INTO address(user_id, country_id, city) VALUES(2, 232, 'Oldham')",
    
    'insert_wt1'    => "INSERT INTO working_time(name) VALUES('Full time')",
    'insert_wt2'    => "INSERT INTO working_time(name) VALUES('Part time')",
    'insert_wt3'    => "INSERT INTO working_time(name) VALUES('Casual work')",
    'insert_wt4'    => "INSERT INTO working_time(name) VALUES('Seasonal work')",
    'insert_wt5'    => "INSERT INTO working_time(name) VALUES('Freelance work')",
    'insert_wt6'    => "INSERT INTO working_time(name) VALUES('Contract work')",
    'insert_wt7'    => "INSERT INTO working_time(name) VALUES('Self-employment')",
    'insert_wt8'    => "INSERT INTO working_time(name) VALUES('Working from home')",
    'insert_wt9'    => "INSERT INTO working_time(name) VALUES('Portfolio work')",
    
);
