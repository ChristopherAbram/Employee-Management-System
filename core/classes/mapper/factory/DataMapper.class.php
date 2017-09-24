<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\mapper\factory
 * @author     Christopher Abram
 * @version    1.0
 * @date	28.08.2016
 */

namespace core\classes\mapper\factory;

class DataMapper extends Factory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public static function getUserStandard(\core\classes\sql\Strategy $strategy){
                $connection = \ConnectionRegistry::getUserEstablishedConnection();
                return new \core\classes\mapper\DataMapper($connection, $strategy);
            }// end getUserStandard
        
        // } protected {
            
            
            
        // } private {
            
        // }
    // }
}