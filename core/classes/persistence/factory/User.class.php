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

class User extends Factory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public function getDomainSet(array $ids = array(), \core\classes\data\collection\set\Set $set = null){
                return new \core\classes\domain\collection\set\User($ids, $set);
            }// end getDomainSet
            
            public function getDomainFactory($role = GUEST){
                if($role == GUEST){
                    return new \core\classes\domain\factory\Guest();
                }
                else if($role == PLAIN){
                    return new \core\classes\domain\factory\Plain();
                }
                else if($role == PUBLICIST){
                    return new \core\classes\domain\factory\Publicist();
                }
                else if($role == ADMINISTRATOR){
                    return new \core\classes\domain\factory\Administrator();
                }
                return null;
            }// end getDomainFactory
        
        // } protected {
            
            
            
        // } private {
            
        // }
    // }
}