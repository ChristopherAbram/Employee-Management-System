<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\view
 * @author     Christopher Abram
 * @version    1.0
 * @date	02.09.2016
 */

namespace core\classes\view;

class View {
    // vars {
        
        protected $_response        = null;
        
        protected $_smarty          = null;
        
        protected $_content         = '';
    
    // } methods {
    
        // public {
            
            public function __construct(\core\classes\response\Response $response){
                $this->_response = $response;
                // Init smarty object:
                $this->_initSmarty();
            }// end __construct
            
            public function sendHeaders(){
                $this->_send_headers();
                return;
            }// end sendHeaders
            
            public function render(){
                // Preparation:
                $assignments = $this->_response->getAssignments();
                foreach($assignments as $key => $value){
                    $this->_smarty->assign($key, $value);
                }
                $error = array();
                while($e = $this->_response->error()){
                    $error[] = $e;
                }
                $warning = array();
                while($w = $this->_response->warning()){
                    $warning[] = $w;
                }
                $correct = array();
                while($c = $this->_response->correct()){
                    $correct[] = $c;
                }
                
                $template = $this->_smarty->fetch($this->_response->getTemplateFile().'.tpl');
                
                $this->_smarty->assign('__content__', $template);
                $this->_smarty->assign('error', $error);
                $this->_smarty->assign('warning', $warning);
                $this->_smarty->assign('correct', $correct);
                $this->_content = $this->_smarty->fetch($this->_response->getLayoutFile().'.tpl');
                
            }// end render
            
            public function display(){
                echo $this->_content;
            }// end display
            
            public function content(){
                return $this->_content;
            }// end content
            
        // } protected {
        
            protected function _initSmarty(){
                $this->_smarty = new \Smarty();
                
                $this->_smarty->setTemplateDir(ViewSetting::$template_dir);
                $this->_smarty->setCompileDir(ViewSetting::$compile_dir);
                $this->_smarty->setCacheDir(ViewSetting::$cache_dir);
                $this->_smarty->setConfigDir(ViewSetting::$configs_dir);
                $this->_smarty->addTemplateDir(ViewSetting::$layouts_dir);
                
            }// end _initSmarty
            
            protected function _send_headers(){
                $headers = $this->_response->getHeaders();
                foreach($headers as $header){
                    // TODO:
                    // invoke \header(...) depend'in on arguments ...
                    if(\is_array($header)){
                        if((isset($header[0]) && \is_string($header[0]) && \strlen($header[0]) > 0) &&
                                (isset($header[1]) && \is_bool($header[1])) &&
                                (isset($header[2]) && \is_int($header[2]))){
                            $this->_header($header[0], $header[1], $header[2]);
                        }
                        else if((isset($header[0]) && \is_string($header[0]) && \strlen($header[0]) > 0) &&
                                (isset($header[1]) && \is_bool($header[1]))){
                            $this->_header($header[0], $header[1]);
                        }
                        else if((isset($header[0]) && \is_string($header[0]) && \strlen($header[0]) > 0)){
                            $this->_header($header[0]);
                        }
                    }
                    else if(\is_string($header) && \strlen($header) > 0){
                        //echo $header;
                        $this->_header($header);
                    }
                }
                $length = strlen($this->_content);
                if($length > 0){
                    //\header('Content-Length: '.strlen($this->_content));
                }
            }// end _send_headers
            
            protected function _header($string, $replace = true, $http_response_code = ''){
                return \core\functions\header($string, $replace, $http_response_code);
            }// end _header
            
        // } private {
            
        // }
    // }
}