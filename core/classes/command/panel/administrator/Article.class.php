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

class Article extends \core\classes\command\panel\publicist\Article {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
            
            protected function _count_all_articles(){
                try {
                    $count = \core\classes\data\Article::countNotRemoved();
                    if(!is_null($count)){
                        $this->_count = $count;
                    }
                } catch (\core\classes\data\DataException $ex) {
                    $this->error($ex->getMessage());
                }
            }// end _count
            
            protected function _count_articles(\core\classes\data\Page $page){
                try {
                    $count = \core\classes\data\Article::countNotRemovedByPageId($page->getID());
                    if(!is_null($count)){
                        $this->_count = $count;
                    }
                } catch (\core\classes\data\DataException $ex) {
                    $this->error($ex->getMessage());
                }
            }// end _count
            
            protected function _article_list($pointer){
                try {
                    $factory = new \core\classes\data\factory\Article();
                    $set = $factory->getAllSortedByCdate($pointer, $this->_countperpage);
                    if(!is_null($set)){
                        $domains = new \core\classes\domain\collection\set\Article(array(), $set);
                        $this->_get_data($domains);
                    }
                } catch(\core\classes\data\DataException $ex){
                    $this->error($ex->getMessage());
                }
            }// end _article_list
            
            protected function _article_list_by_page(\core\classes\data\Page $page, $pointer){
                try {
                    $factory = new \core\classes\data\factory\Article();
                    $set = $factory->getAvailableByPageId($page->getID(), $pointer, $this->_countperpage);
                    if(!is_null($set)){
                        $domains = new \core\classes\domain\collection\set\Article(array(), $set);
                        $this->_get_data($domains);
                    }
                } catch(\core\classes\data\DataException $ex){
                    $this->error($ex->getMessage());
                }
            }// end _article_list_by_page
            
        // } private {
            
            
            
        // }
    // }
}