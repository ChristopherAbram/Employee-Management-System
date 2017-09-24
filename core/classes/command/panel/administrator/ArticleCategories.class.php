<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\panel\administrator
 * @author     Christopher Abram
 * @version    1.0
 * @date	23.09.2016
 */

namespace core\classes\command\panel\administrator;

class ArticleCategories extends \core\classes\command\panel\publicist\ArticleCategories {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
            
            protected function _count(){
                try {
                    $count = \core\classes\data\Page::countHavingAnyArticles();
                    if(!is_null($count)){
                        $this->_count = $count;
                    }
                } catch (\core\classes\data\DataException $ex) {
                    $this->error($ex->getMessage());
                }
            }// end _count
            
            protected function _page_list($pointer){
                try {
                    $factory = new \core\classes\data\factory\Page();
                    $set = $factory->getTheseHavingAnyArticles($pointer, $this->_countperpage);
                    if(!is_null($set)){
                        
                        $set->accept(function($page){
                            $attributes = new \core\classes\sql\attribute\AttributeList(array('id', 'title', 'namepath'));
                            $page->setAttributeList($attributes);
                            return $page->read();
                        });
                        
                        foreach($set as $page){
                            $Page = new \core\classes\domain\Page(null, $page);
                            $this->_list[$page->getID()] = &$Page->getPresentationData();
                            $this->_list[$page->getID()]['articles_count'] = \core\classes\data\Article::countNotRemovedByPageId($page->getID());
                        }
                    }
                } catch(\core\classes\data\DataException $ex){
                    $this->error($ex->getMessage());
                }
            }// end _page_list
            
        // } private {
            
            
            
        // }
    // }
}