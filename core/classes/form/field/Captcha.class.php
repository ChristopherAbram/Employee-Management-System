<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\form\field
 * @author     Christopher Abram
 * @version    1.0
 * @date	08.09.2016
 */

namespace core\classes\form\field;

class Captcha extends Input {
    // vars {
        
        protected $_plugin          = null;
    
    // } methods {
    
        // public {
            
            public function pluginLink($link){
                $this->_plugin = $link;
            }// end pluginLink
            
        // } protected {
        
            protected function _toString(){
                $text = '<img style="border: solid 1px #ddd; display: block; margin: 0 0 10px 0;" src="'.$this->_plugin.'" id="captcha"/>';
                $text .= '<input type="text"';
                $text .= is_null($this->id()) ? '' : " id=\"{$this->id()}\"";
                $text .= is_null($this->form()) ? '' : " form=\"{$this->form()}\"";
                $text .= " name=\"{$this->name()}\"";
                $text .= (is_null($this->value()) || !$this->fill()) ? ' value=""' : " value=\"{$this->displayValue()}\"";
                $text .= (is_null($this->disabled()) || $this->disabled() == false) ? "" : " disabled=\"disabled\"";
                $text .= (is_null($this->required()) || $this->required() == false) ? "" : " required=\"required\"";
                $text .= (is_null($this->readonly()) || $this->readonly() == false) ? "" : " readonly=\"readonly\"";
                $text .= '/>';
                $text .= '<div style="cursor: pointer; font-size: 12px; color: #39f; text-align: center; width: 200px;" 
                     onclick="document.getElementById(\'captcha\').src=\''.$this->_plugin.'?\'+Math.random()" id="change-image">
                        Refresh
                </div>';
                return $text;
            }// end _toString
            
        // } private {
            
        // }
    // }
}