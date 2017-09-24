<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\panel\publicist\xhr
 * @author     Christopher Abram
 * @version    1.0
 * @date	15.10.2016
 */

namespace core\classes\command\panel\publicist\xhr;

class NextFilePageExists extends Command {
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
                    
                    //$file_id = $this->__extract_file_id($parameters);
                    
                    // Count comments:
                    if($this->_count($page, $count) > 0){
                        return self::CMD_OK;
                    }
                }
                return self::CMD_ERROR;
            }// end _execute
            
            protected function _count($page, $count){
                $all = 0;
                try {
                    $User = \PanelRegistry::getCurrentUser();
                    if(!is_null($User)){
                        $all = (int)\core\classes\data\FileInfo::countByUserId($User->getID());
                    }
                } catch (\core\classes\data\DataException $ex) {}
                return ($all - (($page - 1) * $count));
            }// end _count
            
        // } private {
            
            private function __extract_file_id($parameters){
                $file_id = 0;
                $json = \json_decode($parameters, true);
                if(!is_null($json) && isset($json['file_id'])){
                    $file_id = (int)$json['file_id'];
                }
                return $file_id;
            }// end __extract_file_id
            
        // }
    // }
}