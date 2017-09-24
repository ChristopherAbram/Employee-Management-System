<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\panel\administrator
 * @author     Christopher Abram
 * @version    1.0
 * @date	03.10.2016
 */

namespace core\classes\command\panel\administrator;

class Registration extends \core\classes\command\Registration {
    // vars {
        
        // MultiStep options:
        protected $_key         = '__adminregistration';
    
        protected $_cancel      = null;
        
    // } methods {
    
        // public {
            
            
            
        // } protected {
        
            protected function _execute(\core\classes\request\Request $request){
                
                $status = parent::_execute($request);
                
                $this->assignAll(array(
                    // Toolbar:
                    'toolbar_left'      => array($this->__submit),
                    'toolbar_right'     => array($this->_cancel),
                ));
                
                return $status;
            }// end _execute
            
            protected function _cancel(){
                if($this->_opened()){
                    $this->_close();
                }
                \core\functions\redirect(\core\functions\address().'/panel/members');
            }// end _cancel
            
        // } private {
            
            
            
        // }
    // }
}