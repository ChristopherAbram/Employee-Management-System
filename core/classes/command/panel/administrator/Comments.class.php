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

class Comments extends \core\classes\command\panel\publicist\Comments {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
            
            protected function _execute(\core\classes\request\Request $request){
                return parent::_execute($request);
            }// end _execute
            
            protected function _get_count(){
                return \core\classes\data\Comment::count();
            }// end _get_count
            
            protected function _get_count_by_article($id){
                return \core\classes\data\Comment::countByArticleId($id);
            }// end _get_count
            
            protected function _get_list($pointer){
                $factory = new \core\classes\data\factory\Comment();
                return $factory->get($pointer, $this->_countperpage);
            }// end _get_list
            
            protected function _get_list_by_article($id, $pointer){
                $factory = new \core\classes\data\factory\Comment();
                return $factory->getByArticleId($id, $pointer, $this->_countperpage);
            }// end _get_list_by_article
            
        // } private {
            
            
            
        // }
    // }
}