<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command
 * @author     Christopher Abram
 * @version    1.0
 * @date	12.09.2016
 */

namespace core\classes\command;

abstract class MultiStep extends Command {
    // vars {
        
        protected $_key             = 'multistepkey';
        
        protected static $_step     = 1;
        protected static $_cmd      = '';
        
        protected $_next            = '';
        protected $_prev            = '';
        protected $_begin           = '';
        protected $_end             = '';
        
        // Indexes:
        const STEP        = 'step';
        const CMD         = 'cmd';
        const DATA        = 'data';

        // } methods {
    
        // public {
        
            public function __construct(){
                parent::__construct();
                
            }// end __construct
            
            public function execute(\core\classes\request\Request $request){
                $step = $this->_current()[self::STEP];
                $cmd = $this->_current()[self::CMD];
                $cmd_name = !is_null($this->cmd()) ? $this->cmd() : \core\classes\request\Request::CMD;
                if($this->_opened() && (($this->_step() == $step) || ($request->getProperty($cmd_name) == $cmd))){
                    parent::execute($request);
                    if(($this->_step() == $step) && ($this->getStatus() == self::NEXT)){
                        $this->_step($this->_next()[self::STEP]);
                        $this->_cmd($this->_next()[self::CMD]);
                    }
                }
                else if(!$this->_opened() && ($step == $this->_begin()[self::STEP])){
                    parent::execute($request);
                    if($this->_opened() && ($this->getStatus() == self::NEXT)){
                        $this->_step($this->_next()[self::STEP]);
                        $this->_cmd($this->_next()[self::CMD]);
                    }
                }
                else {
                    $begin = $this->_begin()[self::CMD];
                    $namespace = !empty($this->getNamespace()) ? $this->getNamespace().'/' : '';
                    \core\functions\redirect(\core\functions\address().'/'.$namespace.$begin);
                }
            }// end execute
            
            public static function info(){
                return array(
                    self::STEP      => static::$_step,
                    self::CMD       => static::$_cmd
                );
            }// end info
            
        // } protected {
        
            protected function _open(array $data){
                $session = \core\classes\session\Session::getInstance();
                $session[$this->_key()] = array(
                    self::STEP      => static::$_step,
                    self::CMD       => static::$_cmd,
                    self::DATA      => $data
                );
                return true;
            }// end _open
            
            protected function _close(){
                if($this->_opened()){
                    $session = \core\classes\session\Session::getInstance();
                    unset($session[$this->_key()]);
                    return true;
                }
                return false;
            }// end _close
            
            protected function _opened(){
                $session = \core\classes\session\Session::getInstance();
                if(isset($session[$this->_key()]) &&
                        isset($session[$this->_key()][self::STEP]) &&
                        isset($session[$this->_key()][self::CMD]) &&
                        isset($session[$this->_key()][self::DATA])){
                    return true;
                }
                return false;
            }// end _opened
            
            protected function _key(){
                return $this->_key;
            }// end _key
            
            protected function _step($number = null){
                if($this->_opened()){
                    $session = \core\classes\session\Session::getInstance();
                    if(!is_null($number)){
                        $data = $session[$this->_key()];
                        $data[self::STEP] = $number;
                        $session[$this->_key()] = $data;
                    }
                    return $session[$this->_key()][self::STEP];
                }
                return null;
            }// end _step
            
            protected function _cmd($cmd = null){
                if($this->_opened()){
                    $session = \core\classes\session\Session::getInstance();
                    if(!is_null($cmd)){
                        $data = $session[$this->_key()];
                        $data[self::CMD] = $cmd;
                        $session[$this->_key()] = $data;
                    }
                    return $session[$this->_key()][self::CMD];
                }
                return null;
            }// end _cmd
            
            protected function _data($data = null){
                if($this->_opened()){
                    $session = \core\classes\session\Session::getInstance();
                    if(!is_null($data)){
                        $d = $session[$this->_key()];
                        $d[self::DATA] = $data;
                        $session[$this->_key()] = $d;
                    }
                    return $session[$this->_key()][self::DATA];
                }
                return null;
            }// end _data
            
            protected function _get(){
                 if($this->_opened()){
                     $session = \core\classes\session\Session::getInstance();
                     return $session[$this->_key()];
                 }
                 return null;
            }// end _get
            
            protected function _current(){
                return self::info();
            }// end _current
            
            protected function _begin(){
                return $this->__getContext($this->_begin);
            }// end _begin
            
            protected function _end(){
                return $this->__getContext($this->_end);
            }// end _end
            
            protected function _next(){
                /*echo '<pre>';
                var_dump($this->__getContext($this->_next));
                echo '</pre>';
                die();*/
                return $this->__getContext($this->_next);
            }// end _next
            
            protected function _prev(){
                return $this->__getContext($this->_prev);
            }// end _prev
            
            protected function _namespace(){
                return __NAMESPACE__;
            }// end _namespace
            
        // } private {
            
            protected function __getContext($var){
                $namespace = $this->_namespace();
                $class = $namespace.'\\'.$var;
                if(\class_exists($class)){
                    return $class::info();
                }
                return null;
            }// end __getContext
            
        // }
    // }
}