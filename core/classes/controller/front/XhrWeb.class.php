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

class XhrWeb extends Web {
    // vars {
        
        private static $__instance      = null;
    
    // } methods {
    
        // public {
        
            public static function run(){
                parent::run();
            }// end run
            
            public function processRequest(){
                $request = \RequestRegistry::getRequest();
                $applicationController = \ApplicationRegistry::getApplicationController();
                
                if(!is_null($applicationController)){
                    try {
                        $response = null;
                        while($command = $applicationController->getCommand($request)){
                            $command->execute($request);
                            if(!is_null($response)){
                                $response->join($command->getResponse());
                            }
                            else {
                                $response = $command->getResponse();
                            }
                        }
                        
                        // Setting view files:
                        $response->setLayoutFile($applicationController->getLayout($request));
                        $response->setTemplateFile($applicationController->getView($request));
                        
                        // Merge default assignments with this comming from command (command more important):
                        // Apart from styles:
                        $response->mergeAssignments($this->defaultAssignments());
                        $this->__mergeStyles($response);
                        
                        // Show results:
                        $this->invokeView($response);
                        
                    } catch(\core\classes\controller\ControllerException $ce){
                        $this->serveInternalError($ce);
                    } catch(\InternalException $ie){
                        $this->serveInternalError($ie);
                    } catch(\Exception $e){
                        $this->serveInternalError($e);
                    }
                }
                else {
                    throw new \core\classes\controller\ControllerException(Error::get('controller_fatal_error'));
                }
                return;
            }// end processRequest
            
            public function invokeView(\core\classes\response\Response $response){
                $view = new \core\classes\view\xhr\View($response);
                $view->sendHeaders();
                $view->render();
                $view->display();
                return;
            }// end invokeView
            
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
                    'Content-Type: application/json; charset=utf-8',
                    'Content-Language: '.\core\classes\languages\Lang::getDisplayLanguage(),
                    'Status: '.$_SERVER['SERVER_PROTOCOL'].' 200 OK',
                    'Cache-Control: no-cache, must-revalidate',
                    'Server: '.$_SERVER['SERVER_NAME'],
                    'Date: '.date(\DATE_RFC2822)
                );
                
                $response = new \core\classes\response\xhr\Response('error', 'xhr_fatal');
                $response->setStatus(\core\classes\command\Command::CMD_ERROR);
                $response->setHeaders($headers);
                
                $response->assign('messages', $messages);
                $response->assign('head', array(
                    'description'   => Text::get('desc'),
                    'message'   => Text::get('msg'),
                    'error'   => Text::get('err'),
                    'file'   => Text::get('file'),
                    'line'  => Text::get('line'),
                    'code'  => Text::get('code'),
                ));
                
                //$response->mergeAssignments($this->defaultAssignments());
                
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
                    'Content-Type: application/json; charset=utf-8',
                    'Content-Language: '.\core\classes\languages\Lang::getDisplayLanguage(),
                    'Status: '.$_SERVER['SERVER_PROTOCOL'].' 200 OK',
                    'Cache-Control: no-cache, must-revalidate',
                    'Server: '.$_SERVER['SERVER_NAME'],
                    'Date: '.date(\DATE_RFC2822)
                );
                
                $response = new \core\classes\response\Response(
                        'error', 'xhr_fatal'
                    );
                $response->setHeaders($headers);
                $response->setStatus(\core\classes\command\Command::CMD_ERROR);
                
                $values = array('messages' => $messages );
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
            
        // } protected {
            
            protected function __construct(){
                parent::__construct();
            }
            
            protected static function _getInstance(){
                if(is_null(self::$__instance)){
                    self::$__instance = new static();
                }
                return self::$__instance;
            }// end getInstance
            
        // } private {
            
            
            
        // }
    // }
}