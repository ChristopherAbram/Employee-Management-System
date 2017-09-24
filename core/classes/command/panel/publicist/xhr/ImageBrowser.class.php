<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\panel\administrator
 * @author     Christopher Abram
 * @version    1.0
 * @date	02.10.2016
 */

namespace core\classes\command\panel\publicist\xhr;

class ImageBrowser extends Command {
    // vars {
        
        protected $_list        = array();
    
    // } methods {
    
        // public {
            
            
            
        // } protected {
    
            protected function _headers($status) {
                return array(
                    'Content-Type: text/html; charset=utf-8',
                    \core\functions\status(200)
                );
            }// end _headers
            
            protected function _styles($status){
                return array(
                    'panel/upload.style.css'
                );
            }// end _styles
        
            protected function _execute(\core\classes\request\Request $request){
                
                // Get request variables:
                $position = isset($request['position']) ? \core\functions\filter($request['position']) : 0;
                $limit = isset($request['limit']) ? \core\functions\filter($request['limit']) : 10;
                $count = isset($request['count']) ? \core\functions\filter($request['count']) : 0;
                $count_next = isset($request['countNext']) ? \core\functions\filter($request['countNext']) : 0;
                
                if( $count == 1 or $count_next == 1 ){
                    $result = 0;
                    if( $count == 1 ){
                        // Count files:
                        $result = $this->__count_files();
                        
                        // Encode response:
                        $response = \json_encode(array('count' => (int)$result));
                        
                        // Send headers:
                        \header(\core\functions\status(200, false) );
                        \header( 'Content-Type: aplication/json' );
                        \header( 'Content-Length: '.strlen( $response ) );
                        //\ob_end_clean();
                        
                        echo $response;
                        exit;
                    }
                    if( $count_next == 1 ){ 
                        // Count files:
                        $result = $this->__count_files();
                        
                        // Count next:
                        if($limit != 0){
                            //$pages = \ceil($result / $limit);
                            $result = $result - $position;
                        }
                        
                        // Encode response:
                        $response = \json_encode(array('count' => (int)$result));
                        
                        // Send headers:
                        \header(\core\functions\status(200, false));
                        \header('Content-Type: aplication/json');
                        \header('Content-Length: '.strlen($response));
                        //\ob_end_clean();
                        
                        echo $response;
                        exit;
                    }
		} 
                else { 
                    // Retrieve pointer and count:
                    $pointer = 0;
                    if($limit != 0){
                        $pointer = (int)\ceil((int)$position / (int)$limit) + 1;
                    }
                    $count = (int)$limit;
                    
                    // Load files:
                    $this->_get_file_list($pointer, $count);
                    
                    \header(\core\functions\status(200, false));
                    \header( 'Content-Type: text/html;charset=utf-8' );
                    if(!empty($this->_list)){
                        echo $this->__list_to_html();
                    }
                    else {
                        //echo 'No results';
                    }
		}
                exit;
                return self::CMD_OK;
            }// end _execute
            
            protected function _get_file_list($pointer, $count){
                try {
                    $User = \ApplicationRegistry::getCurrentUser();
                    $factory = new \core\classes\domain\factory\File();
                    if(!is_null($User)){
                        $set = $factory->getImagesByUserId($User->getID(), $pointer, $count);
                        if(!is_null($set)){
                            $set->load(new \core\classes\sql\attribute\AttributeList(array(
                                'id', 'name', 'extension'
                            )));
                            foreach($set as $file){
                                $this->_list[] = $file->getPresentationData();
                            }
                        }
                    }
                } catch (\core\classes\domain\DomainException $ex) {}
            }// end _get_file_list
            
        // } private {
            
            private function __count_files(){
                $count = 0;
                try {
                    $User = \ApplicationRegistry::getCurrentUser();
                    if(!is_null($User)){
                        $count = (int)\core\classes\data\FileInfo::countImagesByUserId($User->getID());
                    }
                } catch (\core\classes\data\DataException $ex) {}
                return $count;
            }// end __count_files
            
            private function __list_to_html(){
                $html = '';
                foreach($this->_list as &$data){
                    $html .= '
                    <div class="tile">
                        <div class="imgContener">
                            <div class="cross">
                                <input type="text" name="file_name['.$data['id'].']" value="'.$data['name'].'" class="file_name" readonly="readonly" />
                                <input type="submit" name="remove[]" value="'.$data['id'].'" class="close" title="Remove" />
                            </div>
                            <img class="thumb" src="'.$data['miniature'].'" title="'.$data['name'].'" />
                        </div>
                        <div class="progress">
                            <div class="bar"></div>
                            <input type="hidden" name="response" value="" />
                            <div class="responseMessage">'.$data['name'].'</div>
                        </div>
                    </div>';
                }
                return $html;
            }// end __list_to_html
            
        // }
    // }
}