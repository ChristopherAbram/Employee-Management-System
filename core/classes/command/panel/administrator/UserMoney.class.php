<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\panel\administrator
 * @author     Christopher Abram
 * @version    1.0
 * @date	21.09.2016
 */

namespace core\classes\command\panel\administrator;

class UserMoney extends \core\classes\command\panel\plain\Money {
    // vars {
        
        protected $_user_id     = null;
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
        
            protected function _retrieve_id(){
                $session = \core\classes\session\Session::getInstance();
                if(isset($session['member']))
                    $this->_user_id = (int)$session['member'];
            }
            
        // } private {
            
            
            
        // }
    // }
}