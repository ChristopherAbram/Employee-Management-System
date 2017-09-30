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
    'insert_user_plain'         => "INSERT INTO user(email, password, firstname, lastname, user_role_id, sex, cdate, bdate, isactive, token) VALUES('plain@gmail.com', '".\core\functions\password('password')."', 'Mark', 'Zuckerberg', 2, 'M', '".date(\DATETIME)."', '1984-5-14', 1, '". \core\functions\token('markzuckerbergpassword')."')",
    'insert_user_plain1'         => "INSERT INTO user(email, password, firstname, lastname, user_role_id, sex, cdate, bdate, isactive, token) VALUES('tolkien@gmail.com', '".\core\functions\password('password')."', 'John Ronald Reuel', 'Tolkien', 2, 'M', '".date(\DATETIME)."', '1984-01-03', 1, '". \core\functions\token('johnronaldreueltolkienpassword')."')",
    'insert_user_plain2'         => "INSERT INTO user(email, password, firstname, lastname, user_role_id, sex, cdate, bdate, isactive, token) VALUES('gollum@gmail.com', '".\core\functions\password('password')."', 'Gollum', 'Smeagol', 2, 'M', '".date(\DATETIME)."', '1987-06-16', 1, '". \core\functions\token('gollumsmeagolpassword')."')",
    'insert_user_plain3'         => "INSERT INTO user(email, password, firstname, lastname, user_role_id, sex, cdate, bdate, isactive, token) VALUES('einstein@gmail.com', '".\core\functions\password('password')."', 'Albert', 'Einstein', 2, 'M', '".date(\DATETIME)."', '1879-03-14', 1, '". \core\functions\token('alberteinsteinpassword')."')",
    
    'insert_address_1'  => "INSERT INTO address(user_id, country_id, city) VALUES(1, 233, 'New York')",
    'insert_address_2'  => "INSERT INTO address(user_id, country_id, city) VALUES(2, 232, 'Oldham')",
    'insert_address_3'  => "INSERT INTO address(user_id, country_id, city) VALUES(3, 12, 'London')",
    'insert_address_4'  => "INSERT INTO address(user_id, country_id, city) VALUES(4, 154, 'Middle earth')",
    'insert_address_5'  => "INSERT INTO address(user_id, country_id, city) VALUES(5, 67, 'Ulm')",
    
    'insert_department_1'  => "INSERT INTO department(namepath, name, description, city, zip, street, house) VALUES('finland_office', 'Finland Office', 'Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui, non felis. Maecenas malesuada elit lectus felis, malesuada ultricies. Curabitur et ligula.', 'Vantaa - Aviabulevardi', '01-530', 'Karhumaentie', '3')",
    'insert_department_2'  => "INSERT INTO department(namepath, name, description, city, zip, street, house) VALUES('sweden_office', 'Sweden Office', 'Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui, non felis. Maecenas malesuada elit lectus felis, malesuada ultricies. Curabitur et ligula.', 'Stockholm', '11-120', 'Vasagatan', '16')",
    'insert_department_3'  => "INSERT INTO department(namepath, name, description, city, zip, street, house) VALUES('poland_office', 'Poland Office', 'Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui, non felis. Maecenas malesuada elit lectus felis, malesuada ultricies. Curabitur et ligula.', 'Wrocław', '50-013', 'Czysta', '2-4/204')",
    
    'insert_respon_1' => "INSERT INTO responsibility(name, description) VALUES('Manager', 'Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui, non felis. Maecenas malesuada elit lectus felis, malesuada ultricies. Curabitur et ligula.')",
    'insert_respon_2' => "INSERT INTO responsibility(name, description) VALUES('C++ Developer', 'Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui, non felis. Maecenas malesuada elit lectus felis, malesuada ultricies. Curabitur et ligula.')",
    'insert_respon_3' => "INSERT INTO responsibility(name, description) VALUES('C# Developer', 'Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui, non felis. Maecenas malesuada elit lectus felis, malesuada ultricies. Curabitur et ligula.')",
    'insert_respon_4' => "INSERT INTO responsibility(name, description) VALUES('Secretary', 'Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui, non felis. Maecenas malesuada elit lectus felis, malesuada ultricies. Curabitur et ligula.')",
    'insert_respon_5' => "INSERT INTO responsibility(name, description) VALUES('Student - trainee', 'Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui, non felis. Maecenas malesuada elit lectus felis, malesuada ultricies. Curabitur et ligula.')",
    'insert_respon_6' => "INSERT INTO responsibility(name, description) VALUES('Java Developer', 'Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui, non felis. Maecenas malesuada elit lectus felis, malesuada ultricies. Curabitur et ligula.')",
    
    'insert_wt1'    => "INSERT INTO working_time(name) VALUES('Full time')",
    'insert_wt2'    => "INSERT INTO working_time(name) VALUES('Part time')",
    'insert_wt3'    => "INSERT INTO working_time(name) VALUES('Casual work')",
    'insert_wt4'    => "INSERT INTO working_time(name) VALUES('Seasonal work')",
    'insert_wt5'    => "INSERT INTO working_time(name) VALUES('Freelance work')",
    'insert_wt6'    => "INSERT INTO working_time(name) VALUES('Contract work')",
    'insert_wt7'    => "INSERT INTO working_time(name) VALUES('Self-employment')",
    'insert_wt8'    => "INSERT INTO working_time(name) VALUES('Working from home')",
    
    'insert_agreement_1' => "INSERT INTO agreement(user_id, department_id, responsibility_id, working_time_id, salary, from_date, to_date) VALUES(1, 2, 1, 1, 3010, '2016-01-01', null)",
    'insert_agreement_2' => "INSERT INTO agreement(user_id, department_id, responsibility_id, working_time_id, salary, from_date, to_date) VALUES(2, 1, 2, 1, 3510, '2016-04-01', '2017-01-01')",
    'insert_agreement_3' => "INSERT INTO agreement(user_id, department_id, responsibility_id, working_time_id, salary, from_date, to_date) VALUES(2, 3, 3, 1, 4010, '2017-01-01', null)",
    'insert_agreement_4' => "INSERT INTO agreement(user_id, department_id, responsibility_id, working_time_id, salary, from_date, to_date) VALUES(3, 3, 4, 1, 1010, '2016-01-01', null)",
    'insert_agreement_5' => "INSERT INTO agreement(user_id, department_id, responsibility_id, working_time_id, salary, from_date, to_date) VALUES(5, 1, 5, 8, 2010, '2016-01-01', '2016-09-01')",
    'insert_agreement_6' => "INSERT INTO agreement(user_id, department_id, responsibility_id, working_time_id, salary, from_date, to_date) VALUES(5, 1, 2, 2, 2210, '2016-09-01', '2017-05-01')",
    'insert_agreement_7' => "INSERT INTO agreement(user_id, department_id, responsibility_id, working_time_id, salary, from_date, to_date) VALUES(5, 1, 2, 1, 3010, '2017-06-01', null)",
    'insert_agreement_8' => "INSERT INTO agreement(user_id, department_id, responsibility_id, working_time_id, salary, from_date, to_date) VALUES(4, 2, 6, 1, 2510, '2016-04-01', null)",
);
