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

class Web extends Controller {
    // vars {
        
        private static $__instance      = null;
    
        // Application helper:
        private $__applicationHelper    = null;
    
    // } methods {
    
        // public {
        
            public static function run(){
                $instance = self::_getInstance();
                try {
                    $instance->init();
                    $instance->processRequest();
                    
                } catch(\core\classes\controller\ControllerException $ce){
                    $instance->serveFatalError($ce);
                } catch(\Exception $e){
                    $instance->serveFatalError($e);
                }
            }// end run
            
            public function init(){
                $this->__applicationHelper = \core\classes\controller\helper\Application::getInstance();
                $this->__applicationHelper->init();
                $this->_get_current_user_data();
            }// end init
            
            public function defaultAssignments(){
                // Default variables:
                return array(
                    // Generals:
                    'title'         => 'Solteq assignment',
                    'self'          => $_SERVER['PHP_SELF'],
                    'hostname'      => $_SERVER['SERVER_NAME'],
                    'home'          => array(
                        'title'     => 'Home',
                        'link'      => \core\functions\address(),
                    ),
                    'description'   => '',
                    'ancestors'     => array(),
                    'messages'      => array(),
                    'time'          => date('H:i:s d M Y'),
                    'year'          => date('Y'),
                    'lang'          => \core\classes\languages\Lang::getDisplayLanguage(),
                    'path'          => array(
                        'style'         => 'app/style',
                        'img'           => 'app/img',
                        'miniature'     => 'app/img/miniatures',
                        'avatar'        => \core\functions\address().'/app/img/user_default.png',
                        'current'       => \core\functions\uri(),
                    ),
                    'styles'        => array(
                        
                    ),
                    'cookie'                => Text::get('cookie'),
                    'cookie_confirmed'      => \core\functions\cookie_confirmed(),
                    'user_identified'       => \core\classes\domain\AuthorizedUser::identified(),
                    'current_user'          => &$this->_current_user_data,
                    
                    // Error signaling:
                    'noscript'      => Error::get('noscript'),
                    'error_login'   => false,
                    'login_message' => '',
                    
                    // Meta:
                    'keywords'          => '',
                    'author'            => 'Krzysztof Abram',
                    'meta_description'  => '',
                );
            }// end defaultAssignments
            
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
                        
                        // Menu:
                        $response->assign('menu', $this->_menu(2, 10));
                        
                        /*echo '<pre>';
                        print_r($this->_menu(2, 10));
                        echo '</pre>';
                        die();*/
                        
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
                $view = new \core\classes\view\View($response);
                
                //\core\functions\clear_php_buffer();
                //\ob_start();
                
                $view->sendHeaders();
                $view->render();
                $view->display();
                
                /*echo '<pre>';
                print_r($view->content());
                echo '</pre>';
                die();*/
                
                //\ob_end_flush();
                return;
            }// end invokeView
            
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
            
            protected function _menu($level = 2, $count = 10){
                try {
                    return array();
                } catch (\core\classes\domain\DomainException $ex) {
                    throw new \core\classes\controller\ControllerException(Error::get('menu'), 0, $ex);
                }
                return array();
            }// end _menu
            
            protected function _transform_menu(&$array){
                $menu = array();
                foreach($array as &$option){
                    $name = $option['namepath'];
                    $menu[$name] = array(
                        'name'      => $option['title'],
                        'href'      => isset($option['link']) && !empty($option['link']) ? $option['link'] : \core\functions\address().'/page/'.$option['namepath'],
                        'command'   => 'page',
                        'active'    => false,
                        'menu'      => $this->_transform_menu($option['children'])
                    );
                }
                return $menu;
            }// end _transform_menu
            
            protected function __mergeStyles(\core\classes\response\Response $response){
                $assignments = &$response->getAssignments();
                $assignments['styles'] = \array_merge($this->defaultAssignments()['styles'], $assignments['styles']);
            }// end __mergeStyles
            
        // } private {
            
            
            
        // }
    // }
}