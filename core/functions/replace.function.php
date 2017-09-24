<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\functions
 * @author     Christopher Abram
 * @version    1.0
 * @date	19.08.2016
 */

namespace core\functions;

function replace($subject, array $replacement){
    return \Message::replace($subject, $replacement);
}