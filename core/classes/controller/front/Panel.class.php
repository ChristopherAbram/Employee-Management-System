<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\controller\front
 * @author     Christopher Abram
 * @version    1.0
 * @date	16.09.2016
 */

namespace core\classes\controller\front;

class Panel extends Controller {
    // vars {
        
        private static $__instance      = null;
    
        // Application helper:
        private $__panelHelper          = null;
        
        private $__empty                = array();
    
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
                $this->__panelHelper = \core\classes\controller\helper\Panel::getInstance();
                $this->__panelHelper->init();
                $this->_get_current_user_data();
            }// end init
            
            public function defaultAssignments(){
                // Default variables:
                return array(
                    // Generals:
                    'title'         => 'Management Panel',
                    'self'          => $_SERVER['PHP_SELF'],
                    'hostname'      => $_SERVER['SERVER_NAME'],
                    'home'          => array(
                        'title'     => 'Home',
                        'link'      => \core\functions\address(),
                    ),
                    'panel'         => array(
                        'title'     => 'Panel',
                        'link'      => \core\functions\address().'/panel',
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
                    'user_identified'     => \core\classes\domain\AuthorizedUser::identified(),
                    'current_user'          => &$this->_current_user_data,
                    
                    'noscript'      => Error::get('noscript'),
                    
                    // Default toolbar:
                    'toolbar_left'        => array(),
                    'toolbar_right'       => array(),
                    
                );
            }// end defaultAssignments
            
            public function processRequest(){
                $request = \RequestRegistry::getRequest();
                $panelController = \PanelRegistry::getApplicationController();
                
                if(!is_null($panelController)){
                    try {
                        $response = null;
                        while($command = $panelController->getCommand($request)){
                            $command->execute($request);
                            if(!is_null($response)){
                                $response->join($command->getResponse());
                            }
                            else {
                                $response = $command->getResponse();
                            }
                        }
                        // Setting view files:
                        $response->setLayoutFile($panelController->getLayout($request));
                        $response->setTemplateFile($panelController->getView($request));
                        
                        // Merge default assignments with this comming from command (command more important):
                        // Apart from styles:
                        $response->mergeAssignments($this->defaultAssignments());
                        $this->__merge_styles($response);
                        
                        // Menu:
                        $menu = \PanelRegistry::getMenu();
                        $user = \PanelRegistry::getCurrentUser();
                        
                        $menu->filter($user, $request);
                        $menu->selectActiveOptions($request);
                        $submenu = &$menu->extractSubMenu($request);
                        
                        $response->assign('menu', $menu->getMenu());
                        $response->assign('submenu', $submenu);
                        
                        /*echo '<pre>';
                        print_r($menu);
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
                    throw new \core\classes\controller\ControllerException(Error::get('panel_controller_fatal_error'));
                }
                return;
            }// end processRequest
            
            public function invokeView(\core\classes\response\Response $response){
                $view = new \core\classes\view\View($response);
                $view->sendHeaders();
                $view->render();
                $view->display();
                return;
            }// end invokeView
            
        // } protected {
            
            protected function __construct(){}
            
            protected static function _getInstance(){
                if(is_null(self::$__instance)){
                    self::$__instance = new static();
                }
                return self::$__instance;
            }// end getInstance
            
        // } private {
            
            protected function __merge_styles(\core\classes\response\Response $response){
                $assignments = &$response->getAssignments();
                $assignments['styles'] = \array_merge($this->defaultAssignments()['styles'], $assignments['styles']);
            }// end __mergeStyles
            
        // }
    // }
}