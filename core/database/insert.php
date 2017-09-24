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
    
);
