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

namespace core\classes\command\panel\plain;

class Money extends Command {
    // vars {
        
        protected $_user_id     = null;
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
        
            protected function _retrieve_id(){
                $User = \ApplicationRegistry::getCurrentUser();
                if(!is_null($User))
                    $this->_user_id = $User->getID();
            }
    
            protected function _headers($status) {
                return array(
                    'Content-Type: text/html; charset=utf-8',
                    \core\functions\status(200)
                );
            }// end _headers
            
            protected function _styles($status){
                return array(
                    
                );
            }// end _styles
        
            protected function _execute(\core\classes\request\Request $request){
                
                $this->_retrieve_id();
                
                $x = \core\classes\data\Agreement::getTotalJobSalaryByUserId($this->_user_id);
                $y = \core\classes\data\Agreement::getTotalContractSalaryByUserId($this->_user_id);
                
                $a = \core\classes\data\Agreement::getMonthSalaryByUserId($this->_user_id);
                $b = \core\classes\data\Agreement::getContractSalaryByUserId($this->_user_id);
                
                // Assignments:
                $this->assignAll(array(
                    'title'             => 'Earnings informations',
                    
                    'total'             => $x + $y,
                    'total_job'         => $x,
                    'total_contract'    => $y,
                    
                    'month_salary'      => $a,
                    'contract_salary'   => $b,
                ));
                
                return self::CMD_OK;
            }// end _execute
            
        // } private {
            
            
            
        // }
    // }
}