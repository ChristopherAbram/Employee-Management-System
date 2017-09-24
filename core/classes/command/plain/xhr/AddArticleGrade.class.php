<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\guest\xhr
 * @author     Christopher Abram
 * @version    1.0
 * @date	20.10.2016
 */

namespace core\classes\command\plain\xhr;

class AddArticleGrade extends Command {
    // vars {
        
        
        
    // } methods {
    
        // public {
            
            
            
        // } protected {
            
            protected function _headers($status) {
                return array(
                    \core\functions\status(200),
                );
            }// end _headers
            
            protected function _execute(\core\classes\request\Request $request){
                
                if(isset($request['parameters'])){
                    $parameters = $request['parameters'];
                    
                    $article_id = 0;
                    $value = 1;
                    
                    // Extract data:
                    $json = \json_decode($parameters, true);
                    if(!is_null($json) && isset($json['article_id'], $json['grade'])){
                        $article_id = (int)$json['article_id'];
                        $value = (int)$json['grade'];
                    }
                    
                    // Check correctness:
                    if(!$this->_validate($article_id, $value)){
                        $this->error(Error::get('parameters'));
                        return self::CMD_ERROR;
                    }
                    
                    // Add grade:
                    if(!$this->_add_grade($article_id, $value)){
                        $this->error(Error::get('grade'));
                        return self::CMD_ERROR;
                    }
                    // Grade added successfully:
                    return self::CMD_OK;
                }
                
                return self::CMD_ERROR;
            }// end _execute
            
            protected function _validate($article_id, $value){
                if($article_id > 0 && ($value >= 1 && $value <= 5)){
                    return true;
                }
                return false;
            }// end _validate
            
            protected function _add_grade($article_id, $value){
                try {
                    $grade = new \core\classes\data\ArticleGrade();
                    $User = \ApplicationRegistry::getCurrentUser();
                    if(!($User instanceof \core\classes\domain\AuthorizedUser)){
                        return false;
                    }
                    
                    // Set data:
                    $data = array(
                        'user_id'       => $User->getID(),
                        'article_id'    => $article_id,
                        'value'         => $value,
                        'cdate'         => \date(\DATETIME)
                    );
                    $grade->setData($data);
                    return $grade->create();
                } catch (\core\classes\data\DataException $ex) {
                    
                }
                return false;
            }// end _add_grade
            
        // } private {
            
            
            
        // }
    // }
}