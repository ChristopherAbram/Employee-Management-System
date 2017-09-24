<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\request
 * @author     Christopher Abram
 * @version    1.0
 * @date	19.08.2016
 */

namespace core\classes\request;

class Request extends \ArrayObject {
    // vars {
        
        // feedback container:
        private $__feedback     = null;
        
        // last command:
        private $__command      = null;
        
        const CMD               = 'cmd';
        const PANEL_CMD         = 'panel_cmd';
        
        private $__var          = null;


        // } methods {
    
        // public {
            
            public function __construct(){
                parent::__construct();
                $this->__feedback = new \SplStack();
                //$this->_init();
                \RequestRegistry::setRequest($this);
            }// end __construct
            
            public function getProperty($key){
                if(isset($this[$key]))
                    return $this[$key];
                return null;
            }// end getProperty
            
            public function setProperty($key, $value){
                $this[$key] = $value;
            }// setProperty
            
            public function setFeedback($msg){
                $this->__feedback->push($msg);
            }// end setFeedback
            
            public function getFeedback(){
                return $this->__feedback->pop();
            }// end getFeedback
            
            public function getAllFeedback($separator = '\n'){
                $str = '';
                foreach($this->__feedback as $value){
                    $str .= $value.$separator;
                }
                return $str;
            }// end getAllFeedback
            
            public function setCommand($command){
                $this->__command = $command;
            }// end setCommand
            
            public function getLastCommand(){
                return $this->__command;
            }// end getLastCommand
            
            public function offsetSet($index, $newval) {
                if(isset($_SERVER['REQUEST_METHOD'])){
                    $_REQUEST[$index] = $newval;
                }
                if(isset($_SERVER['argv'])){
                    foreach($_SERVER['argv'] as $k => $arg){
                        if(strpos($arg, '=')){
                            list($key, $value) = explode('=', $arg);
                            if($index == $key){
                                $_SERVER['argv'][$k] = $key.'='.$newval;
                            }
                        }
                    }
                }
            }// end offsetSet
            
            public function &offsetGet($index) {
                if(isset($_SERVER['REQUEST_METHOD'])){
                    if(isset($_REQUEST[$index])){
                        return $_REQUEST[$index];
                    }
                }
                if(isset($_SERVER['argv'])){
                    foreach($_SERVER['argv'] as $arg){
                        if(strpos($arg, '=')){
                            list($key, $value) = explode('=', $arg);
                            if($index == $key){
                                return $value;
                            }
                        }
                    }
                }
                return $this->__var;
            }// end offsetGet
            
            public function offsetExists($index) {
                $p = false;
                $q = false;
                if(isset($_SERVER['REQUEST_METHOD'])){
                    $p = isset($_REQUEST[$index]);
                }
                if(isset($_SERVER['argv'])){
                    foreach($_SERVER['argv'] as $arg){
                        if(strpos($arg, '=')){
                            list($key, $value) = explode('=', $arg);
                            if($index == $key){
                                $q = true;
                                break;
                            }
                        }
                    }
                }
                return $p || $q;
            }// end offsetExists
            
            public function offsetUnset($index) {
                if(isset($_SERVER['REQUEST_METHOD'])){
                    unset($_REQUEST[$index]);
                }
                if(isset($_SERVER['argv'])){
                    foreach($_SERVER['argv'] as $k => $arg){
                        if(strpos($arg, '=')){
                            list($key, $value) = explode('=', $arg);
                            if($index == $key){
                                unset($_SERVER['argv'][$k]);
                                break;
                            }
                        }
                    }
                }
            }// end offsetUnset
            
            public function &getReference($index){
                if(isset($_REQUEST[$index])){
                    return $_REQUEST[$index];
                }
            }// end getReference
            
        // } protected {
        
            protected function _init(){
                if(isset($_SERVER['REQUEST_METHOD'])){
                    foreach($_REQUEST as $key => $request)
                        $this[$key] = $request;
                }
                if(isset($_SERVER['argv'])){
                    foreach($_SERVER as $arg){
                        if(strpos($arg, '=')){
                            list($key, $value) = explode('=', $arg);
                            $this[$key] = $value;
                        }
                    }
                }
            }// end _init
            
        // } private {
            
        // }
    // }
}