<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\plain\xhr
 * @author     Christopher Abram
 * @version    1.0
 * @date	15.10.2016
 */

namespace core\classes\command\plain\xhr;

class AddComment extends Command {
    // vars {
        
        private $__user     = array('firstname' => '', 'lastname' => '', 'role' => array('name' => ''));
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
    
            protected function _save(array &$data){
                try {
                    // Use default attribute set:
                    $comment = new \core\classes\data\Comment();
                    
                    $comment->setData($data);
                    if($comment->create()){
                        return true;
                    }
                } catch (\core\classes\data\DataException $ex) {
                    $this->error($ex->getMessage());
                }
                return false;
            }// end _save
    
            protected function _headers($status) {
                return array(
                    \core\functions\status(200),
                );
            }// end _headers
        
            protected function _execute(\core\classes\request\Request $request){
                
                // Check user reference:
                $User = \ApplicationRegistry::getCurrentUser();
                if(!$User instanceof \core\classes\domain\AuthorizedUser){
                    $this->error(Error::get('user_unknown'));
                    return self::CMD_ERROR;
                }
                
                if(isset($request['content'], $request['article_id'])){
                    // Extract data:
                    $content = \nl2br(\preg_replace('/\R+/i', "\n", \core\functions\filter($request['content'])), false);
                    $id = \core\functions\filter($request['article_id']);
                    
                    // Validate data:
                    if(!$this->__validate($content, $id)){
                        $this->error(Error::get('comment_validation'));
                        return self::CMD_ERROR;
                    }
                    
                    // Set data:
                    $data = array(
                        'user_id'       => $User->getID(),
                        'article_id'    => $id,
                        'content'       => $content,
                        'cdate'         => \date(\DATETIME),
                        'bin'           => 0,
                        'hide'          => 0
                    );
                    
                    // Save data:
                    if($this->_save($data)){
                        $this->_load_user_data();
                        $this->correct(Correct::get('comment_added'));
                        
                        $this->assignAll(array(
                            'content'       => $content,
                            'user'          => $this->__user
                        ));
                        return self::CMD_OK;
                    }
                    else {
                        $this->error(Error::get('comment_rejected'));
                    }
                }
                
                return self::CMD_ERROR;
            }// end _execute
            
            protected function _load_user_data(){
                try {
                    $User = \ApplicationRegistry::getCurrentUser();
                    if($User instanceof \core\classes\domain\AuthorizedUser){
                        $p = $User->load(new \core\classes\sql\attribute\AttributeList(array('id', 'firstname', 'lastname', 'avatar', 'profile')));
                        if($p) $User->loadUserRole();
                        if($p){
                            $Avatar = $User->getAvatar();
                            if(!is_null($Avatar)){
                                $Avatar->load(new \core\classes\sql\attribute\AttributeList(array(
                                    'id', 'name', 'extension'
                                )));
                            }
                        }
                        $data = $User->getPresentationData();
                        $this->__user = $data;
                    }
                } catch (\core\classes\domain\DomainException $ex) {
                    
                }
            }// end _load_user_data
            
        // } private {
            
            private function __validate($str, $id){
                $length = \strlen($str);
                if(($length > 1024 || $length < 8) || !\preg_match('/^'.REGEX_INT_UNSIGNED.'$/i', $id)){
                    return false;
                }
                return true;
            }// end __validate
            
        // }
    // }
}