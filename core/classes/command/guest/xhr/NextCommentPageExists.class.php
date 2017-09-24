<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\guest\xhr
 * @author     Christopher Abram
 * @version    1.0
 * @date	15.10.2016
 */

namespace core\classes\command\guest\xhr;

class NextCommentPageExists extends Command {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
            
            protected function _headers($status) {
                return array(
                    \core\functions\status(200),
                );
            }// end _headers
            
            protected function _execute(\core\classes\request\Request $request){
                if(isset($request['page'], $request['count'], $request['parameters'])){
                    // Extract data:
                    $page = (int)\core\functions\filter($request['page']);
                    $count = (int)\core\functions\filter($request['count']);
                    $parameters = $request['parameters'];
                    
                    $article_id = $this->__extract_article_id($parameters);
                    
                    // Count comments:
                    if($this->_count($article_id, $page, $count) > 0){
                        return self::CMD_OK;
                    }
                }
                return self::CMD_ERROR;
            }// end _execute
            
            protected function _count($id, $page, $count){
                try {
                    $factory = new \core\classes\domain\factory\Comment();
                    $set = $factory->getNotHiddenAndNotRemovedByArticleId($id, $page, $count);
                    if(!is_null($set)){
                        return \count($set);
                    }
                } catch (\core\classes\domain\DomainException $ex) {
                    $this->error($ex->getMessage());
                }
                return 0;
            }// end _count
            
        // } private {
            
            private function __extract_article_id($parameters){
                $article_id = 0;
                $json = \json_decode($parameters, true);
                if(!is_null($json) && isset($json['article_id'])){
                    $article_id = (int)$json['article_id'];
                }
                return $article_id;
            }// end __extract_article_id
            
        // }
    // }
}