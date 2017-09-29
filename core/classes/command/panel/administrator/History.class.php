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

class History extends Command {
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
                
                $results = array();
                
                $date = $this->_getOldestAgreementMonth();
                $now = $this->_getNextMonth();
                
                while($date < $now){
                    
                    $monthReport = \core\classes\data\Agreement::getMonthReportByDate($date);
                    if(isset($monthReport[0])){
                        $results[] = array(
                            'month'         => \date('m-Y', \strtotime($date)),
                            'month_salary'  => $monthReport[0]['month_salary'],
                            'total_job'     => $monthReport[0]['total_job'],
                            'total_contract'=> $monthReport[0]['total_contract'],
                            'total'         => $monthReport[0]['total_job'] + $monthReport[0]['total_contract'],
                        );
                    }
                    $date = $this->_addOneMonth($date);
                }
                
                //echo '<pre>';print_r($results); echo '</pre>';
                //exit;
                
                // Assignments:
                $this->assignAll(array(
                    'title'             => 'Earnings informations',
                    
                    'results'           => $results,
                ));
                
                return self::CMD_OK;
            }
            
            protected function _getOldestAgreementMonth(){
                $d = \date('Y-m-01', \strtotime(\core\classes\data\Agreement::getOldestSinceDate()));
                return $d;
            }
            
            protected function _addOneMonth($date){
                $d = \strtotime("+1 months",\strtotime($date));
                return \date("Y-m-d",$d);
            }
            
            protected function _getNextMonth(){
                $d = \date('Y-m-01', \strtotime(\date(DATE)));
                return $this->_addOneMonth($d);
            }

        // } private {
            
            
            
        // }
    // }
}