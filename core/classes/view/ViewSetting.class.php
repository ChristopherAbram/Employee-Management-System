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

class ViewSetting {
    // vars {
        
        public static  $template_dir        = '';
        
        public static $compile_dir          = '';
        
        public static $cache_dir            = '';
        
        public static $configs_dir          = '';
        
        public static $layouts_dir          = '';
    
    // } methods {
    
        // public {
            
            public static function templateDir($template = ''){
                if(!empty($template)){
                    self::$template_dir = $template;
                }
                return self::$template_dir;
            }// end templateDir
            
            public static function compileDir($compile = ''){
                if(!empty($compile)){
                    self::$compile_dir = $compile;
                }
                return self::$compile_dir;
            }// end compileDir
            
            public static function cacheDir($cache = ''){
                if(!empty($cache)){
                    self::$cache_dir = $cache;
                }
                return self::$cache_dir;
            }// end cacheDir
            
            public static function configsDir($configs = ''){
                if(!empty($configs)){
                    self::$configs_dir = $configs;
                }
                return self::$configs_dir;
            }// end configsDir
            
            public static function layoutDir($layout = ''){
                if(!empty($layout)){
                    self::$layout_dir = $layout;
                }
                return self::$layout_dir;
            }// end layoutDir
            
        // } protected {
        
            
            
        // } private {
            
        // }
    // }
}