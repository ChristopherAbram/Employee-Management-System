<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\control
 * @author     Christopher Abram
 * @version    1.0
 * @date	02.09.2016
 */

namespace core\classes\control;

class Control {
    // vars {
        
        // Controller Map instance:
        protected $_map                      = null;
        
        // Configuration file pathway:
        protected $_control_file_dirpath     = '';
        protected $_control_file_name        = '';
    
    // } methods {
    
        // public {
            
            public function __construct($relativedirpath, $filename){
                $this->_control_file_dirpath = $relativedirpath;
                $this->_control_file_name = $filename;
                $this->_map = new \core\classes\controller\Map();
            }// end __construct
            
            public function getFilePath(){
                return \realpath(\dirname(__FILE__).'/'.$this->_control_file_dirpath.'/'.$this->_control_file_name);
            }// end getFilePath
            
            public function getFileName(){
                return array($this->_control_file_dirpath, $this->_control_file_name);
            }// end getFileName
            
            public function getMap(){
                return $this->_map;
            }// end getMap
            
            public function parse(){
                $control_file_path = $this->getFilePath();
                // parse using SimpleXML package:
                if(\file_exists($control_file_path)){
                    try {
                        $control = \simplexml_load_file($control_file_path);
                        if($control instanceof \SimpleXMLElement){
                            $this->_perform_reading_xml_file($control, $this->_map);
                        }
                    } catch (\Exception $ex) {
                        throw new ControlException(\core\functions\replace(
                                Error::get('read_xml_file'),
                                array('$file'   => $this->_control_file_name)
                            ), 0, $ex);
                    }
                } else {
                    throw new ControlException(\core\functions\replace(
                            Error::get('control_xml_file_not_exists'),
                            array('$file' => $this->_control_file_name)
                        ));
                }
            }// end parse
            
        // } protected {
        
            protected function _perform_reading_xml_file(\SimpleXMLElement $sxe, \core\classes\controller\Map $map){
                // Default layout:
                foreach($sxe->default->layout as $default_layout){
                    // Depends on user role:
                    if(isset($default_layout['role'])){
                        $map->addLayout(\core\classes\controller\Map::DEFAULT_, self::__filter((string)$default_layout), (string)$default_layout['role']);
                    }
                    else {
                        $map->addLayout(\core\classes\controller\Map::DEFAULT_, self::__filter((string)$default_layout));
                    }
                }
                // Default views:
                foreach($sxe->default->view as $default_view){
                    $status = \core\classes\command\Command::CMD_DEFAULT;
                    if(isset($default_view['status'])){
                        $status_str = self::__filter($default_view['status']);
                        $status = \core\classes\command\Command::status($status_str);
                    }
                    $map->addView(\core\classes\controller\Map::DEFAULT_, $status, self::__filter((string)$default_view));
                }
                
                // Commands:
                foreach($sxe->commands->command as $command){
                    // Command Name:
                    $command_name = \core\classes\controller\Map::DEFAULT_;
                    if(isset($command['name'])){
                        $command_name = self::__filter((string)$command['name']);
                    }
                    // Layout:
                    foreach($command->layout as $layout){
                        // Depends on user role:
                        if(isset($layout['role'])){
                            $map->addLayout($command_name, self::__filter((string)$layout), (string)$layout['role']);
                        }
                        else {
                            $map->addLayout($command_name, self::__filter((string)$layout));
                        }
                    }
                    // Views:
                    if(isset($command->views)){
                        foreach($command->views->view as $view){
                            $status = \core\classes\command\Command::CMD_DEFAULT;
                            if(isset($view['status'])){
                                $status_str = self::__filter((string)$view['status']);
                                $status = \core\classes\command\Command::status($status_str);
                            }
                            $map->addView($command_name, $status, self::__filter((string)$view));
                        }
                    }
                    // ClassRoot:
                    if(isset($command->classroot['name'])){
                        $map->addClassRoot($command_name, self::__filter((string)$command->classroot['name']));
                    }
                    
                    // Forward:
                    if(isset($command->forwards)){
                        foreach($command->forwards->forward as $forward){
                            $status = \core\classes\command\Command::CMD_DEFAULT;
                            if(isset($forward['status'])){
                                $status_str = self::__filter((string)$forward['status']);
                                $status = \core\classes\command\Command::status($status_str);
                            }
                            $map->addForward($command_name, $status, self::__filter((string)$forward));
                        }
                    }
                }
                return;
            }// end _perform_reading_xml_file
            
        // } private {
            
            private static function __filter($str){
                return \htmlspecialchars(\trim($str));
            }// end __filter
            
        // }
    // }
}