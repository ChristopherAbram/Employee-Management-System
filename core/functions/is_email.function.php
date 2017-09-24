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

function is_email( $email ){
    if(\preg_match('/^'.\REGEX_EMAIL.'$/i', $email)){
        return true;
    }
    return false;
}