<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\panel\publicist
 * @author     Christopher Abram
 * @version    1.0
 * @date	23.09.2016
 */

namespace core\classes\command\panel\administrator;

class ArticleComments extends \core\classes\command\panel\publicist\ArticleComments {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
    
            protected function _execute(\core\classes\request\Request $request){
                return parent::_execute($request);
            }// end _execute
            
            protected function _get_count(){
                return \core\classes\data\Article::countHavingAnyComments();
            }// end __count
            
            protected function _get_list($pointer){
                $factory = new \core\classes\data\factory\Article();
                return $factory->getHavingAnyComments($pointer, $this->_countperpage);
            }// end _get_list
            
        // } private {
            
            
            
        // }
    // }
}