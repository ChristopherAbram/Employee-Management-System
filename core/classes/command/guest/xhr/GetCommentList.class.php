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

class GetCommentList extends Command {
    // vars {
        
        private $__list     = array();
    
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
                    
                    $article_id = 0;
                    $json = \json_decode($parameters, true);
                    if(!is_null($json) && isset($json['article_id'])){
                        $article_id = (int)$json['article_id'];
                    }
                    
                    // Load comment list:
                    $this->_load_comment_list($article_id, $page, $count);
                    
                    // Set assignments:
                    $this->assignAll(array(
                        'comments'  => $this->__list,
                    ));
                    
                    return self::CMD_OK;
                }
                
                return self::CMD_ERROR;
            }// end _execute
            
            protected function _load_comment_list($id, $page, $count){
                try {
                    $factory = new \core\classes\domain\factory\Comment();
                    $set = $factory->getNotHiddenAndNotRemovedByArticleId($id, $page, $count);
                    if(!is_null($set)){
                        $set->accept(function($Comment){
                            $p = $Comment->load();
                            $User = $Comment->getUser();
                            if(!is_null($User)){
                                $User->loadBasic();
                                $User->loadUserRole();
                                $Avatar = $User->getAvatar();
                                if(!is_null($Avatar)){
                                    $Avatar->load(new \core\classes\sql\attribute\AttributeList(array('id', 'name', 'extension')));
                                }
                            }
                            $this->__list[] = $Comment->getPresentationData();
                        });
                        return true;
                    }
                } catch (\core\classes\domain\DomainException $ex) {
                    $this->error($ex->getMessage());
                }
                return false;
            }// end _load_comment_list
            
        // } private {
            
            
            
        // }
    // }
}