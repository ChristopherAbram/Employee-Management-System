<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\controller\front
 * @author     Christopher Abram
 * @version    1.0
 * @date	30.08.2016
 */

namespace core\classes\controller\front;

abstract class Controller {
    // vars {
        
        protected $_current_user_data = array();
    
    // } methods {
    
        // public {
            
            abstract public function init();
            
            abstract public function processRequest();
            
            abstract public function invokeView(\core\classes\response\Response $response);
            
            
            
            
            public function serveFatalError(\Exception $exception){
                $messages = array();
                do {
                    $messages[] = array(
                        'message'      => $exception->getMessage(),
                        'file'         => $exception->getFile(),
                        'line'         => $exception->getLine(),
                        'code'         => $exception->getCode()
                    );
                } while($exception = $exception->getPrevious());
                
                $headers = array(
                    'Content-Type: text/html; charset=utf-8',
                    'Content-Language: '.\core\classes\languages\Lang::getDisplayLanguage(),
                    'Status: '.$_SERVER['SERVER_PROTOCOL'].' 200 OK',
                    'Cache-Control: no-cache, must-revalidate',
                    'Server: '.$_SERVER['SERVER_NAME'],
                    'Date: '.date(\DATE_RFC2822)
                );
                
                $response = new \core\classes\response\Response('error', 'fatal');
                $response->setHeaders($headers);
                
                $response->assign('title', Text::get('fatal_error_title'));
                $response->assign('description', Text::get('fatal_error_desc'));
                $response->assign('messages', $messages);
                $response->assign('head', array(
                    'description'   => Text::get('desc'),
                    'message'   => Text::get('msg'),
                    'error'   => Text::get('err'),
                    'file'   => Text::get('file'),
                    'line'  => Text::get('line'),
                    'code'  => Text::get('code'),
                ));
                
                $response->mergeAssignments($this->defaultAssignments());
                
                $this->invokeView($response);
                exit(1);
                return;
            }// end serveFatalError
            
            public function serveInternalError(\Exception $exception){
                $messages = array();
                do {
                    $messages[] = array(
                        'message'      => $exception->getMessage(),
                        'file'         => $exception->getFile(),
                        'line'         => $exception->getLine(),
                        'code'         => $exception->getCode()
                    );
                } while($exception = $exception->getPrevious());
                
                $headers = array(
                    'Content-Type: text/html; charset=utf-8',
                    'Content-Language: '.\core\classes\languages\Lang::getDisplayLanguage(),
                    'Status: '.$_SERVER['SERVER_PROTOCOL'].' 200 OK',
                    'Cache-Control: no-cache, must-revalidate',
                    'Server: '.$_SERVER['SERVER_NAME'],
                    'Date: '.date(\DATE_RFC2822)
                );
                
                $map = \ApplicationRegistry::getControllerMap();
                $response = new \core\classes\response\Response(
                        'error', 'fatal'
                    );
                $response->setHeaders($headers);
                $values = array(
                    'title'         => Text::get('internal_error_title'),
                    'description'   => Text::get('internal_error_desc'),
                    'messages'      => $messages,
                );
                $response->assign('head', array(
                    'description'   => Text::get('desc'),
                    'message'   => Text::get('msg'),
                    'error'   => Text::get('err'),
                    'file'   => Text::get('file'),
                    'line'  => Text::get('line'),
                    'code'  => Text::get('code'),
                ));
                $response->assignAll($values);
                $response->mergeAssignments($this->defaultAssignments());
                
                $this->invokeView($response);
                exit(1);
                return;
            }// end serveInternalError
            
            public static function resolve(){
                return \core\functions\detect_xhr();
            }// end resolve
            
        // } protected {
            
            protected function __construct(){}
            
            protected function _get_current_user_data(){
                // Get User data:
                $User = \PanelRegistry::getCurrentUser();
                if(!is_null($User)){
                    $this->_current_user_data = &$User->getPresentationData();
                }
            }// end _get_current_user_data
            
        // } private {
            
            
            
        // }
    // }
}