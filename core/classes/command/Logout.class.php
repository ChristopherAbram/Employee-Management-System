<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command
 * @author     Christopher Abram
 * @version    1.0
 * @date	16.09.2016
 */

namespace core\classes\command;

class Logout extends Command {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
    
            protected function _headers($status) {
                return array(
                    'ContentType: text/html; encoding=utf-8',
                    \core\functions\status(200),
                    'Cache-Control: no-cache'
                );
            }// end _headers
        
            protected function _execute(\core\classes\request\Request $request){
                
                // Change session user data:
                $guest = new \core\classes\domain\Guest();
                
                $session = \core\classes\session\Session::getInstance();
                $session['user'] = array('id' => $guest->getID());
                $session->destroy();
                
                // Unset cookies user data:
                $cookie = \core\classes\cookie\Cookie::getInstance();
                if(isset($cookie['user_token'])){
                    $cookie->setcookie('user_token', '', \time() - 60*60, '/');
                }
                // Redirect to home page:
                if(isset($request['url']) && !empty($request['url'])){
                    \core\functions\redirect($request['url']);
                } 
                else {
                    \core\functions\redirect(\core\functions\address());
                }
                
                return self::CMD_OK;
            }// end _execute
            
        // } private {
            
            
            
        // }
    // }
}