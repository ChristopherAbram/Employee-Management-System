<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\functions
 * @author     Christopher Abram
 * @version    1.0
 * @date	19.09.2016
 */

namespace core\functions;

function namepath($value){
    $value = replace_diacritics($value, false);
    $value = \preg_replace('/[\<\>\(\)\[\]\!\?\@\#\$\%\^\&\*\:\;\/\{\}\+\=\~]/i', '', $value);
    return $value;
}