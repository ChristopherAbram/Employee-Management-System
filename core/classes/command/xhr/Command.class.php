<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\xhr
 * @author     Christopher Abram
 * @version    1.0
 * @date	15.10.2016
 */

namespace core\classes\command\xhr;

abstract class Command extends \core\classes\command\Command {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public function __construct(){
                $this->_response = new \core\classes\response\xhr\Response();
            }// end __construct
            
        // } protected {
        
            
            
        // } private {
            
        // }
    // }
}