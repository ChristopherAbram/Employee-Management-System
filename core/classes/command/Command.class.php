<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command
 * @author     Christopher Abram
 * @version    1.0
 * @date	30.08.2016
 */

namespace core\classes\command;

abstract class Command {
    // vars {
        
        // Status code:
        protected $_status      = 0;
        
        // Status strings:
        protected static $_STATUSES = array(
            'CMD_DEFAULT'       => 0,
            'CMD_OK'            => 1,
            'CMD_ERROR'         => 2
            
        );
        
        // Status constants:
        const CMD_DEFAULT       = 0;
        const CMD_OK            = 1;
        const CMD_ERROR         = 2;
        const NEXT              = 3;
        
        // Response:
        protected $_response    = null;
        
        // Command request name:
        protected $_request_name = null;
        
        // Application command sub namespace:
        protected $_namespace   = '';
        
        protected $_request     = null;
    
    // } methods {
    
        // public {
        
            public function __construct(){
                $this->_response = new \core\classes\response\Response();
            }// end __construct
            
            public function execute(\core\classes\request\Request $request){
                $this->_request = $request;
                // Performing command:
                $this->_status = $this->_execute($request);
                $this->_response->setStatus($this->_status);
                $request->setCommand($this);
                // Response data:
                $this->_response->setHeaders($this->_headers($this->_status));
                $this->_response->setRequest($request);
                // Joining styles:
                $this->_response->assign('styles', $this->_styles($this->_status));
            }// end execute
            
            public function getStatus(){
                return $this->_status;
            }// end getStatus
            
            public function getResponse(){
                return $this->_response;
            }// end getResponse
            
            public function assign($index, $value){
                $this->_response->assign($index, $value);
            }// end assign
            
            public function assignAll(array $values){
                $this->_response->assignAll($values);
            }// end assignAll
            
            
            
            
            public function handle(\Exception $ex){
                //$messages = array();
                do {
                    /*$messages[] = array(
                        'message'      => $ex->getMessage()
                    );*/
                    $this->warning($ex->getMessage());
                    //echo $ex->getMessage().'<br>';
                } while($ex = $ex->getPrevious());
                //die();
            }// end handle
            
            public function error($message = null){
                if(!is_null($message)){
                    $this->_response->error($message);
                }
                else {
                    return $this->_response->error();
                }
            }// end error
            
            public function warning($message = null){
                if(!is_null($message)){
                    $this->_response->warning($message);
                }
                else {
                    return $this->_response->warning();
                }
            }// end warning
            
            public function correct($message = null){
                if(!is_null($message)){
                    $this->_response->correct($message);
                }
                else {
                    return $this->_response->correct();
                }
            }// end correct
            
            
            
            
            public static function status($status_str){
                try {
                    if(!is_null(constant(__NAMESPACE__.'\\Command::'.$status_str))){
                        return constant(__NAMESPACE__.'\\Command::'.$status_str);
                    }
                    return self::CMD_DEFAULT;
                } catch(\Exception $e){
                    return self::CMD_DEFAULT;
                }
            }// end status
            
            public function setNamespace($namespace){
                $this->_namespace = $namespace;
            }// end setNamespace
            
            public function getNamespace(){
                return $this->_namespace;
            }// end getNamespace
            
            public function cmd($name = null){
                if(!is_null($name)){
                    $this->_request_name = $name;
                }
                return $this->_request_name;
            }// end cmd
            
        // } protected {
        
            abstract protected function _execute(\core\classes\request\Request $request);
            
            protected function _headers($status){
                return array();
            }
            
            protected function _styles($status){
                return array();
            }// end _styles
            
        // } private {
            
        // }
    // }
}