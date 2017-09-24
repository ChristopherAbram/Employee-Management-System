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

class SetUserAvatar extends Command {
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
                
                if(isset($request['id'])){
                    $id = $request['id'];
                    
                    $User = \ApplicationRegistry::getCurrentUser();
                    if(is_null($User)){
                        $this->error(Error::get('user'));
                    }
                    
                    $user_id = $User->getID();
                    
                    // Check correctness:
                    if(!$this->_validate($id)){
                        $this->error(Error::get('id'));
                        return self::CMD_ERROR;
                    }
                    
                    // Add avatar:
                    if(!$this->_add_avatar($id)){
                        $this->error(Error::get('avatar'));
                        return self::CMD_ERROR;
                    }
                    // Avatar added successfully:
                    $this->correct(Correct::get('added'));
                    return self::CMD_OK;
                }
                else {
                    $this->error(Error::get('id'));
                }
                
                return self::CMD_ERROR;
            }// end _execute
            
            protected function _validate($id){
                if($id > 0){
                    return true;
                }
                return false;
            }// end _validate
            
            protected function _add_avatar($id){
                try {
                    $User = \ApplicationRegistry::getCurrentUser();
                    if(!($User instanceof \core\classes\domain\AuthorizedUser)){
                        return false;
                    }
                    $user = $User->getData();
                    $user->setAttributeList(new \core\classes\sql\attribute\AttributeList(array('id', 'avatar')));
                    
                    // Set data:
                    $data = array(
                        'id'       => $User->getID(),
                        'avatar'   => $id
                    );
                    $user->setData($data);
                    return $user->update();
                } catch (\core\classes\data\DataException $ex) {
                    
                }
                return false;
            }// end _add_avatar
            
        // } private {
            
            
            
        // }
    // }
}