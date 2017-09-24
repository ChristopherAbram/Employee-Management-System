<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\persistence\factory
 * @author     Christopher Abram
 * @version    1.0
 * @date	27.08.2016
 */

namespace core\classes\persistence\factory;

abstract class Factory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            abstract public function getDomainSet(array $ids = array(), \core\classes\data\collection\set\Set $set = null);
            
            abstract public function getDomainFactory();
        
        // } protected {
            
            
            
        // } private {
            
        // }
    // }
}