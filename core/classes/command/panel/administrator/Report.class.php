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

class Report extends Command {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
        
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
    
            protected function _execute(\core\classes\request\Request $request) {
                
                $x = \core\classes\data\Agreement::getTotalJobSalary();
                $y = \core\classes\data\Agreement::getTotalContractSalary();
                
                $a = \core\classes\data\Agreement::getMonthSalary();
                $b = \core\classes\data\Agreement::getContractSalary();
                
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
            }
            
        // } private {
            
            
            
        // }
    // }
}