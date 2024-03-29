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

class File extends Factory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public function getDomainSet(array $ids = array(), \core\classes\data\collection\set\Set $set = null){
                return new \core\classes\domain\collection\set\File($ids, $set);
            }// end getDomainSet
            
            public function getDomainFactory(){
                return new \core\classes\domain\factory\File();
            }// end getDomainFactory
        
        // } protected {
            
            
            
        // } private {
            
        // }
    // }
}