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

class ArticleCategory extends \core\classes\command\panel\publicist\ArticleCategory {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
            
            protected function _page_list(){
                $factory = new \core\classes\domain\factory\Page();
                try {
                    $Page = $factory->getRoot();
                    if(!is_null($Page)){ 
                        // Build page tree:
                        $Page->availableTree();

                        // Load tree data:
                        $visitor = new \core\classes\visitor\PageLoader();
                        $visitor->attributes(array('id', 'title'));
                        $Page->acceptTree($visitor);

                        $Page->acceptTree(function($Page){
                            if($Page->getID() == 1){
                                return;
                            }
                            $this->_list[$Page->getID()] = &$Page->getPresentationData(false);
                        });
                    }
                } catch (\core\classes\domain\DomainException $ex) {
                    $this->error($ex->getMessage());
                }
            }// end _page_list
            
        // } private {
            
            
            
        // }
    // }
}