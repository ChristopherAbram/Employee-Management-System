<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\functions
 * @author     Christopher Abram
 * @version    1.0
 * @date	09.09.2016
 */

namespace core\functions;

function username($firstname, $lastname){
    return strtolower(substr($firstname, 0, 5).substr($lastname, 0, 5));
}