<?php
/*
 * Copyright (c) 2017 Christopher Abram.
 *
 * Solteq application
 *
 * @package    solteq
 * @author     Christopher Abram
 * @version    1.0
 * @date        19.09.2017
 */

namespace solteq;

if(!\core\classes\controller\front\Controller::resolve()){
    // Run standard application:
    \core\classes\controller\front\Web::run();
}
else {
    // Run XmlHttpRequest application:
    \core\classes\controller\front\XhrWeb::run();
}