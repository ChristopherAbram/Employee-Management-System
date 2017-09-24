<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\functions
 * @author     Christopher Abram
 * @version    1.0
 * @date	31.08.2016
 */

namespace core\functions;

function clear_php_buffer(){
    while(\ob_get_level()){
        \ob_end_clean();
    }
    return;
}