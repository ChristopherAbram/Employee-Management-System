<?php
/*
 * Copyright (c) 2017 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command
 * @author     Christopher Abram
 * @version    1.0
 * @date	20.09.2017
 */

namespace core\classes\command;

abstract class ListCommand extends Command {
    // vars {
        
        // Page number:
        protected $_page          = 1;
        
        // Result count:
        protected $_count         = 0;
        
        // Results per page: 
        protected $_countperpage  = 10;
        
        // Store list data:
        protected $_list          = array();
    
    // } methods {
    
        // public {
        
            
            
        // } protected {
        
            abstract protected function _load_list();
        
            abstract protected function _count_results();
            
            protected function _requested_page(){
                $request = $this->_request;
                if(isset($request['page'])){
                    $page = $request['page'];
                    if(!is_null($page)){
                        $this->_page = (int)$page;
                    }
                }
            }// end _page
            
            protected function _pages_count(){
                if($this->_count != 0){
                    $count = (int)\ceil((float)$this->_count / ((float)$this->_countperpage));
                    return $count;
                }
                return 1;
            }// end _pages_count
            
        // } private {
            
        // }
    // }
}