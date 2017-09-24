<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\command\guest
 * @author     Christopher Abram
 * @version    1.0
 * @date	25.09.2016
 */

namespace core\classes\command\guest;

class Article extends Command {
    // vars {
        
        private $__user      = array();
        private $__rate      = null;
        
        private $__page_list    = array();
        
    // } methods {
    
        // public {
            
            
            
        // } protected {
            
            protected function _headers($status) {
                if($status == self::CMD_ERROR){
                    return array(
                        \core\functions\status(404)
                    );
                }
                return array(
                    'ContentType: text/html; encoding=utf-8',
                    \core\functions\status(200)
                );
            }// end _headers
            
            protected function _styles($status) {
                return array(
                    'informer.style.css',
                    'grade.style.css',
                    'form.style.css',
                    'article.style.css',
                    'comment.style.css'
                );
            }// end _styles
            
            protected function _execute(\core\classes\request\Request $request){
                
                $User = \ApplicationRegistry::getCurrentUser();
                
                // If an article namepath is pointed:
                if(isset($request['namepath'])){
                    // Retrieve the namepath:
                    $namepath = $request['namepath'];
                    // Get an article by the namepath:
                    $Article = $this->__get_article_by_namepath($namepath);
                    if(is_null($Article)){
                        return self::CMD_ERROR;
                    }
                    // Load the content:
                    if(!$this->__load_artilce($Article)){
                        return self::CMD_ERROR;
                    }
                    
                    if($Article->isHidden() or $Article->isRemoved()){
                        return self::CMD_ERROR;
                    }
                    // Parent page (category):
                    $Pages = $Article->getPages();
                    if(is_null($Pages)){
                        return self::CMD_ERROR;
                    }
                    // Note visit:
                    try {
                        $Article->visit();
                    } catch(\core\classes\domain\DomainException $ex){
                        $this->error($ex->getMessage());
                    }
                    // Load data:
                    $data = $Article->getPresentationData(true);
                    
                    // Load user data:
                    $this->__get_current_user();
                    $this->__already_rated($Article->getID());
                    
                    // Ancestors:
                    //$ancestors = $this->__get_ancestors($Article);
                    $this->__extract_pages($Pages);
                    
                    /*echo '<pre>';
                    print_r($data);
                    echo '</pre>';
                    die();*/
                    
                    $this->assignAll(array(
                        // General:
                        'title'         => isset($data['title']) ? $data['title'] : '',
                        'last_modified' => Text::get('last_modified'),
                        'visits'        => Text::get('visits'),
                        'keywords'          => isset($data['keywords']) ? $data['keywords'] : '',
                        'author'            => isset($data['user'], $data['user']['firstname'], $data['user']['lastname']) ? $data['user']['firstname'].' '.$data['user']['lastname'] : '',
                        'meta_description'  => isset($data['description']) ? \strip_tags($data['description']) : '',
                        
                        // Ancestors:
                        //'ancestors'     => $ancestors,
                        
                        'comments_active'   => (isset($data['comments_active']) && $data['comments_active'] == 1),
                        'commenting'        => ($User instanceof \core\classes\domain\AuthorizedUser),

                        // The article:
                        'article'       => $data,
                        'pages'         => &$this->__page_list,
                        'rated'         => $this->__rate,
                        
                        // User data:
                        'user'          => $this->__user,
                        
                    ));
                    
                    return self::CMD_OK;
                }
                return self::NEXT;
            }// end _execute
            
        // } private {
            
            private function __load_artilce(\core\classes\domain\Article $Article){
                try {
                    $Article->setCountingVisits(true);
                    $Article->setCountingComments(true);
                    $Article->setCountingGrade(true);
                    $Article->setCountingGradeCount(true);
                    
                    // Setting an attribute list:
                    $article = $Article->getData();
                    if(!is_null($article)){
                        $q = false; $r = false;
                        $p = $Article->load($article->getAllAttributeList());
                        $User = $Article->getUser();
                        $Article->loadAvailablePages(1, 10);
                        $Pages = $Article->getPages();
                        if(!is_null($User) && !is_null($Pages)){
                            // Load user data:
                            $attributes = new \core\classes\sql\attribute\AttributeList(array('id', 'firstname', 'lastname', 'profile', 'sex'));
                            $q = $User->load($attributes);
                            $User->loadUserRole();
                            $User->loadAvatar();
                            // Load branch page data:
                            $Pages->load(new \core\classes\sql\attribute\AttributeList(array('id', 'bin', 'hide', 'title', 'namepath')));
                            $r = true;
                        }
                        return $p && $q && $r;
                    }
                } catch (\core\classes\domain\DomainException $ex) {
                    $this->error($ex->getMessage());
                }
                return false;
            }// end __load_article
            
            private function __extract_pages(\core\classes\domain\collection\set\Page $set){
                try {
                    $set->accept(function($Page){
                        $this->__page_list[] = &$Page->getPresentationData();
                    });
                } catch (\Exception $ex) {
                    $this->error($ex->getMessage());
                }
            }// end __extract_pages
            
            private function __get_current_user(){
                try {
                    $User = \ApplicationRegistry::getCurrentUser();
                    if($User instanceof \core\classes\domain\AuthorizedUser){
                        $User->loadBasic();
                        $User->loadUserRole();
                        $this->__user = $User->getPresentationData();
                    }
                } catch (\core\classes\domain\DomainException $ex) {
                    $this->error($ex->getMessage());
                }
            }// end __get_current_user
            
            private function __already_rated($id){
                try {
                    $User = \ApplicationRegistry::getCurrentUser();
                    if(!($User instanceof \core\classes\domain\AuthorizedUser)){
                        return false;
                    }
                    $factory = new \core\classes\data\factory\ArticleGrade();
                    $grade = $factory->getByUserAndArticleId($id, $User->getID());
                    
                    if(!is_null($grade)){
                        $grade->setAttributeList(new \core\classes\sql\attribute\AttributeList(array('id', 'value')));
                        if($grade->read()){
                            $data = $grade->getData();
                            $this->__rate = isset($data['value']) ? (int)$data['value'] : null;
                        }
                    }
                    
                    /*$count = \core\classes\data\ArticleGrade::countByUserAndArticleId($id, $User->getID());
                    if($count > 0){
                        return true;
                    }*/
                } catch (\core\classes\data\DataException $ex) {
                    $this->error($ex->getMessage());
                }
                return false;
            }// end __already_rated
            
            private function __get_article_by_namepath($namepath){
                $Article = null;
                try {
                    $factory = new \core\classes\domain\factory\Article();
                    $Article = $factory->getByNamepath($namepath);
                } catch (\core\classes\domain\DomainException $ex) {
                    return null;
                }
                return $Article;
            }// end __get_article_by_namepath
            
            private function __get_ancestors(\core\classes\domain\Article $Article){
                // Get category page:
                $Page = $Article->getPage();
                if(is_null($Page)){
                    return array();
                }
                // Ancestors:
                $array = $Page->getAncestorsData();
                // Extract ancestors:
                $ancestors = array();
                foreach($array as $data){
                    if(isset($data['title'], $data['namepath'])){
                        $ancestors[$data['title']] = \core\functions\address().'/page/'.$data['namepath'];
                    }
                }
                // Parent page:
                $page_data = $Page->getPresentationData();
                if(isset($page_data['title'], $page_data['namepath'])){
                    $ancestors[$page_data['title']] = \core\functions\address().'/page/'.$page_data['namepath'];
                }
                // Current article:
                $data = $Article->getPresentationData();
                if(isset($data['title'], $data['namepath'])){
                    $ancestors[$data['title']] = \core\functions\address().'/article/'.$data['namepath'];
                }
                return $ancestors;
            }// end __get_ancestors
            
        // }
    // }
}