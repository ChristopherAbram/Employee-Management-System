<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\controller\application
 * @author     Christopher Abram
 * @version    1.0
 * @date	30.08.2016
 */

namespace core\classes\controller\application;

class Controller {
    // vars {
        
        // Controller map;
        protected $_map             = null;
        
        // Base command class:
        protected $_base            = null;
        
        // Default command:
        protected $_default         = null;
        
        // Invoked commands:
        protected $_invoked         = null;
        
        // Request name for command:
        protected $_cmd             = null;
        
        // Is xhr requested:
        protected $_xhr             = false;
        
        // Application command namespace:
        protected $_sub_namespace   = '';
        protected $_cmd_namespace   = '';
    
    // } methods {
    
        // public {
            
            public function __construct($cmd, \core\classes\controller\Map $map, $namespace = ''){
                $this->_cmd = $cmd;
                $this->_map = $map;
                
                $this->_xhr = self::_xhr_requested();
                
                $this->_sub_namespace = $namespace;
                $this->_cmd_namespace = '\\core\\classes\\command'.(empty($namespace) ? '' : '\\'.$namespace);
                
                if(is_null($this->_base)){
                    $base_class = '\\core\\classes\\command\\'.($this->_xhr ? 'xhr\\' : '').'Command';
                    $this->_base = new \ReflectionClass($base_class);
                    $class = $this->_cmd_namespace.($this->_xhr ? '\\xhr' : '').'\\DefaultCommand';
                    $this->_default = new $class();
                }
            }// end __construct
            
            public function getLayout(\core\classes\request\Request $request){
                $cmd = $request->getProperty($this->_cmd);
                $layout = null;
                $User = \ApplicationRegistry::getCurrentUser();
                if($User instanceof \core\classes\domain\User){
                    $role = $User->roleAsString();
                    $layout = $this->_map->getLayout($cmd, $role);
                    if(is_null($layout)){
                        $layout = $this->_map->getLayout(\core\classes\controller\Map::DEFAULT_, $role);
                    }
                }
                if(is_null($layout)){
                    $layout = $this->_map->getLayout($cmd);
                }
                if(is_null($layout)){
                    $layout = $this->_map->getLayout(\core\classes\controller\Map::DEFAULT_);
                }
                return $layout;
            }// end getLayout
            
            public function getView(\core\classes\request\Request $request){
                $view = $this->_getResource($request, 'View');
                return $view;
            }// end getView
            
            public function getForward(\core\classes\request\Request $request){
                $forward = $this->_getResource($request, 'Forward');
                if(!is_null($forward)){
                    $request->setProperty($this->_cmd, $forward);
                }
                return $forward;
            }// end getForward
            
            public function getCommand(\core\classes\request\Request $request){
                $cmd = $this->resolveRequestedCommand($request);
                if($cmd === 0){
                    return null;
                }
                else if($cmd === 1){
                    return $this->_default;
                }
                $command = $this->resolveCommand($cmd);
                if(is_null($command)){
                    \core\functions\header(\core\functions\status(400));
                    //throw new \core\classes\controller\ControllerException(Error::get('cmd_not_exists'));
                }
                $class = get_class($command);
                if(isset($this->_invoked[$class]) && $this->_invoked[$class] == 1){
                    throw new \core\classes\controller\ControllerException(Error::get('looping'));
                }
                $this->_invoked[$class] = 1;
                $command->setNamespace($this->_sub_namespace);
                $command->cmd($this->_cmd);
                return $command;
            }// end getCommand
            
            public function resolveRequestedCommand(\core\classes\request\Request $request){
                $previous = $request->getLastCommand();
                if(is_null($previous)){
                    $cmd = $request->getProperty($this->_cmd);
                    if(is_null($cmd)){
                        $request->setProperty($this->_cmd, \core\classes\controller\Map::DEFAULT_);
                        return 1;
                    }
                }
                else {
                    $cmd = $this->getForward($request);
                    if(is_null($cmd)){
                        return 0;
                    }
                }
                return $cmd;
            }// end resolveRequestedCommand
            
            public function resolveCommand($command){
                $classroot = $this->_map->getClassRoot($command);
                $class = $this->_resolveClassName($classroot);
                
                if(!is_null($class)){
                    $command_class = new \ReflectionClass($class);
                    if($command_class->isSubclassOf($this->_base)){
                        return $command_class->newInstance();
                    }
                }
                return null;
            }// end resolveCommand
            
            public static function xhrRequested(){
                return self::_xhr_requested();
            }// end xhrRequested
            
        // } protected {
            
            protected function _getResource(\core\classes\request\Request $request, $name){
                $cmd = $request->getProperty($this->_cmd);
                $previous = $request->getLastCommand();
                $status = $previous->getStatus();
                if(!$status){
                    $status = \core\classes\command\Command::CMD_DEFAULT;
                }
                $acquire = "get{$name}";
                $resource = $this->_map->$acquire($cmd, $status);
                if(is_null($resource)){
                    $resource = $this->_map->$acquire($cmd, \core\classes\command\Command::CMD_DEFAULT);
                }
                if(is_null($resource)){
                    $resource = $this->_map->$acquire(\core\classes\controller\Map::DEFAULT_, $status);
                }
                if(is_null($resource)){
                    $resource = $this->_map->$acquire(\core\classes\controller\Map::DEFAULT_, \core\classes\command\Command::CMD_DEFAULT);
                }
                return $resource;
            }// end getResource
        
            protected function _resolveClassName($classroot){
                $namespace = $this->_cmd_namespace.'\\';
                $User = \ApplicationRegistry::getCurrentUser();
                $xhr = $this->_xhr ? 'xhr\\' : '';
                if($User instanceof \core\classes\domain\AuthorizedUser){
                    if($User instanceof \core\classes\domain\Administrator){
                        $classname = $namespace.ADMINISTRATOR.'\\'.$xhr.$classroot;
                        if(\class_exists($classname)){
                            //$this->_sub_namespace .= '\\'.ADMINISTRATOR;
                            return $classname;
                        }
                        $classname = $namespace.PUBLICIST.'\\'.$xhr.$classroot;
                        if(\class_exists($classname)){
                            //$this->_sub_namespace .= '\\'.PUBLICIST;
                            return $classname;
                        }
                    }
                    else if($User instanceof \core\classes\domain\Publicist){
                        $classname = $namespace.PUBLICIST.'\\'.$xhr.$classroot;
                        if(\class_exists($classname)){
                            //$this->_sub_namespace .= '\\'.PUBLICIST;
                            return $classname;
                        }
                    }
                    $classname = $namespace.PLAIN.'\\'.$xhr.$classroot;
                    if(\class_exists($classname)){
                        //$this->_sub_namespace .= '\\'.PLAIN;
                        return $classname;
                    }
                }
                $classname = $namespace.GUEST.'\\'.$xhr.$classroot;
                if(\class_exists($classname)){
                    //$this->_sub_namespace .= '\\'.GUEST;
                    return $classname;
                }
                else if(\class_exists($namespace.$xhr.$classroot)){
                    return $namespace.$xhr.$classroot;
                }
                return null;
            }// end _resolveClassName
            
            protected function _resolveUserSpace(){
                // TODO: 
                // Get user and decide which space should by used.
                $User = \ApplicationRegistry::getCurrentUser();
                $space = '';
                if(!is_null($User)){
                    $space = $User->roleAsString().'\\';
                }
                return $space;
            }// end _resolveUserSpace
            
            protected static function _xhr_requested(){
                return \core\functions\detect_xhr();
            }// end _xhr_requested
            
        // } private {
            
            
        
        // }
    // }
}