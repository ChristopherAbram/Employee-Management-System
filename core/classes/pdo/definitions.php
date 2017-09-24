<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * Definitions for pdo package.
 *
 * @package    core\classes\pdo
 * @author     Christopher Abram
 * @version    1.0
 * @date	19.08.2016
 */
 
// Transaction states:


// Transaction isolation level:
define('READ_UNCOMMITED', 'READ UNCOMMITTED');
define('READ_COMMITED', 'READ COMMITTED');
define('REPEATABLE_READ', 'REPEATABLE READ');
define('SERIALIZABLE', 'SERIALIZABLE');