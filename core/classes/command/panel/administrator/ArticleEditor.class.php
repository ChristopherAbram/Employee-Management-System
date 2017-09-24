<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\panel\publicist
 * @author     Christopher Abram
 * @version    1.0
 * @date	21.09.2016
 */

namespace core\classes\command\panel\administrator;

class ArticleEditor extends \core\classes\command\panel\publicist\ArticleEditor {
    // vars {
        
        

    // } methods {
    
        // public {
            
            
            
        // } protected {
            
            protected function _get_article_by_namepath($namepath){
                try {
                    $factory = new \core\classes\domain\factory\Article();
                    $Article = $factory->getByNamepath($namepath);
                    return $Article;
                } catch (\core\classes\domain\DomainException $ex) {
                    $this->error($ex->getMessage());
                }
                return null;
            }// end _get_article_by_namepath
            
        // } private {
            
            
            
        // }
    // }
}