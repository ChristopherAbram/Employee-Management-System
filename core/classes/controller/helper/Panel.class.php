<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\controller\helper
 * @author     Christopher Abram
 * @version    1.0
 * @date	16.09.2016
 */

namespace core\classes\controller\helper;

class Panel extends Helper {
    // vars {
        
        // Instance:
        private static $__instance      = null;
        
        // Controller Map instance:
        private $__map                  = null;
        
        // Configuration file pathway:
        private $__control_file_dirpath = '../../../private/panel';
        private $__control_file_name    = 'control.setting.xml';
        
        // Menu configuration:
        private $__menu_dirpath         = '../../../private/panel';
        private $__menu_filename        = 'menu.setting.xml';
    
    // } methods {
    
        // public {
            
            public static function getInstance(){
                if(is_null(self::$__instance)){
                    self::$__instance = new self();
                }
                return self::$__instance;
            }// end getInstance
            
            public function init(){
                // init application configurations:
                try {
                    \PanelRegistry::getInstance();
                } catch(\Exception $ex){
                    throw new \core\classes\controller\ControllerException(Error::get('panel_registry'), 0, $ex);
                }
                // init application control flow map:
                try {
                    $control = new \core\classes\control\Control($this->__control_file_dirpath, $this->__control_file_name);
                    $control->parse();
                    $this->__map = $control->getMap();
                    \PanelRegistry::setControllerMap($this->__map);
                } catch(\core\classes\control\ControlException $ex){
                    throw new \core\classes\controller\ControllerException(Error::get('config_init'), 0, $ex);
                }
                // Connection timeout:
                \ConnectionRegistry::setConnectionTimeout(\ApplicationRegistry::getConnectionTimeoutValue());
                // Connect to the database:
                try {
                    \ConnectionRegistry::establishUserConnection();
                } catch (\PDOException $ex) {
                    throw new \core\classes\controller\ControllerException(Error::get('connection_init'), 0, $ex);
                }
                // Start application session:
                $session = \core\classes\session\Session::getInstance();
                $session->setConnection(\ConnectionRegistry::getUserEstablishedConnection());
                
                $session->setLifetime(\ApplicationRegistry::getSessionExpireTime());
                $session->setOldSessionDuration(\ApplicationRegistry::getOldSessionDuration());
                $session->setRegenerationInterval(\ApplicationRegistry::getSessionRegenerationInterval());
                
                $session->start();
                $session->regenerate_id();
                // init logged user instance:
                try {
                    $user = \core\classes\domain\factory\User::getLoggedUser();
                    $this->_load_user_basic_data($user);
                    \PanelRegistry::setCurrentUser($user);
                } catch(\core\classes\domain\DomainException $ex){
                    throw new \core\classes\controller\ControllerException(Error::get('user_init'), 0, $ex);
                }
                // Menu initialization:
                try {
                    $menu = new \core\classes\menu\Menu($this->__menu_dirpath, $this->__menu_filename);
                    $menu->initialize();
                    //$menu->filter($user);
                    //$menu = $this->_parseMenu($this->__menu_dirpath, $this->__menu_filename);
                    \PanelRegistry::setMenu($menu);
                } catch (\Exception $ex) {
                    throw new \core\classes\menu\MenuException(Error::get('menu_init'), 0, $ex);
                }
                // perform other useful initializations...
                return true;
            }// end init
            
            public function getMap(){
                return $this->__map;
            }// end getMap
            
        // } protected {
        
            protected function _parseMenu($dirpath, $filename){
                $menu_filename = \realpath(\dirname(__FILE__).'/'.$dirpath.'/'.$filename);
                if(\file_exists($menu_filename)){
                    try {
                        $menu = \simplexml_load_file($menu_filename);
                        if($menu instanceof \SimpleXMLElement){
                            return $this->_perform_reading_xml_file($menu);
                        }
                    } catch (\Exception $ex) {
                        throw new \core\classes\controller\ControllerException(\core\functions\replace(
                                Error::get('read_xml_file'),
                                array('$file'   => $filename)
                            ), 0, $ex);
                    }
                } else {
                    throw new \core\classes\controller\ControllerException(\core\functions\replace(
                            Error::get('menu_xml_file_not_exists'),
                            array('$file' => $filename)
                        ));
                }
            }// end _parseMenu
            
            protected function _perform_reading_xml_file(\SimpleXMLElement $sxe){
                // Menu array:
                $menu = array();
                // Reading options:
                foreach($sxe->options->option as $option){
                    $name = self::__filter((string)$option);
                    // Fetch href attribute:
                    $href = '';
                    if(isset($option['href'])){
                        $href = self::__filter((string)$option['href']);
                        $href = \core\functions\replace($href, array(
                            '$home'     => \core\functions\address(),
                            '$panel'    => \core\functions\address().'/panel',
                            '$user_id'  => \PanelRegistry::getCurrentUser()->getID(),));
                    }
                    // Fetch access attribute:
                    $access = array();
                    if(isset($option['access'])){
                        $access = self::__filter((string)$option['access']);
                        // Cleaning:
                        if(\strpos($access, ';') || \strpos($access, ' ')){
                            $access = \preg_replace('/[;\s]/i', '', $access);
                        }
                        if(\strpos($access, ':')){
                            list($modifier, $value) = explode(':', $access);
                            $access = array($modifier => $value);
                        }
                        else {
                            $access = array($access => 'all');
                        }
                    }
                    // Fetch command attribute:
                    $command = '';
                    if(isset($option['command'])){
                        $command = self::__filter((string)$option['command']);
                    }
                    // Fetch submenu:
                    $sub = array();
                    if(isset($option->options)){
                        $sub = $this->_perform_reading_xml_file($option);
                    }
                    // Assign attributes:
                    $arr = array(
                        'name'      => $name,
                        'href'      => $href,
                        'access'    => $access,
                        'command'   => $command,
                        'menu'      => $sub
                    );
                    // Optional attributes:
                    // Fetch multistep attribute:
                    $multistep = '';
                    if(isset($option['multistep'])){
                        $multistep = self::__filter((string)$option['multistep']);
                        if(!empty($multistep)){
                            $arr['multistep'] = $multistep;
                        }
                    }
                    $menu[strtolower($name)] = $arr;
                }
                return $menu;
            }// end _perform_reading_xml_file
            
        // } private {
            
            private function __construct(){}
            
            private static function __filter($str){
                return \htmlspecialchars(\trim($str));
            }// end __filter
        
        // }
    // }
}