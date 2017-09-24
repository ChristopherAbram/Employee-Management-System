<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\domain
 * @author     Christopher Abram
 * @version    1.0
 * @date	31.08.2016
 */

namespace core\classes\domain;

class Guest extends User {
    // vars {
    
        
    
    // } methods {
    
        // public {
            
            public function __construct(){
                parent::__construct();
            }// end __construct
            
            public function roleAsString(){
                return GUEST;
            }// end roleAsString
        
        // } protected {
            
            
            
        // } private {
            
        // }
    // }
}