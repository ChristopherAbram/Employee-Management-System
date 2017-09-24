<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\guest\xhr
 * @author     Christopher Abram
 * @version    1.0
 * @date	20.10.2016
 */

namespace core\classes\command\panel\plain\xhr;

class DeleteUserAvatar extends Command {
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
                
                $User = \ApplicationRegistry::getCurrentUser();
                if(is_null($User)){
                    $this->error(Error::get('user'));
                }
                
                try {
                    $Avatar = $User->getAvatar();
                    if(!is_null($Avatar)){
                        $avatar = $Avatar->getData();
                        if(!is_null($avatar) && $avatar->delete()){
                            $this->correct(Correct::get('delete_avatar'));
                            return self::CMD_OK;
                        }
                    }
                } catch (Exception $ex) {
                    
                }
                $this->error(Error::get('delete_avatar'));
                return self::CMD_ERROR;
            }// end _execute
            
        // } private {
            
            
            
        // }
    // }
}