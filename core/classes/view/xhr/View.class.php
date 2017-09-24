<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\view\xhr
 * @author     Christopher Abram
 * @version    1.0
 * @date	02.09.2016
 */

namespace core\classes\view\xhr;

class View extends \core\classes\view\View {
    // vars {
        
        
    
    // } methods {
    
        // public {
            
            public function __construct(\core\classes\response\Response $response){
                parent::__construct($response);
            }// end __construct
            
            public function sendHeaders(){
                $this->_send_headers();
                \header('Content-Type: application/json; charset=utf-8');
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
                $response = array(
                    'content'       => $template,
                    'messages'      => array(
                        'error'         => $error,
                        'warning'       => $warning,
                        'correct'       => $correct
                    ),
                    'styles'        => \array_key_exists('styles', $assignments) ? $assignments['styles'] : array(),
                    'status'        => $this->_response->getStatus(),
                );
                $this->_content = \json_encode($response);
                
            }// end render
            
        // } protected {
        
            
            
        // } private {
            
        // }
    // }
}