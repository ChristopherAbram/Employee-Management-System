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

class GetFileList extends Command {
    // vars {
        
        protected $_list     = array();
        
        protected $_removeable = 'true';
        protected $_input = 'radio';
    
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
                    
                    $this->_parse_parameters($parameters);
                    
                    // Load file list:
                    $this->_load_file_list($page, $count);
                    
                    // Set assignments:
                    $this->assignAll(array(
                        'removeable'    => $this->_removeable,
                        'input'         => $this->_input,
                        'files'         => $this->_list,
                    ));
                    
                    return self::CMD_OK;
                }
                
                return self::CMD_ERROR;
            }// end _execute
            
            protected function _parse_parameters($parameters){
                $json = \json_decode($parameters, true);
                if(!is_null($json) && isset($json['removeable'])){
                    $this->_removeable = $json['removeable'];
                }
                if(!is_null($json) && isset($json['input'])){
                    $this->_input = $json['input'];
                }
            }// end _parse_parameters
            
            protected function _load_file_list($page, $count){
                try {
                    $User = \ApplicationRegistry::getCurrentUser();
                    $factory = new \core\classes\domain\factory\File();
                    if(!is_null($User)){
                        $set = $factory->getByUserId($User->getID(), $page, $count);
                        if(!is_null($set)){
                            $set->load(new \core\classes\sql\attribute\AttributeList(array(
                                'id', 'name', 'extension'
                            )));
                            foreach($set as $file){
                                $this->_list[] = &$file->getPresentationData();
                            }
                        }
                    }
                } catch (\core\classes\domain\DomainException $ex) {}
            }// end _load_comment_list
            
        // } private {
            
            
            
        // }
    // }
}