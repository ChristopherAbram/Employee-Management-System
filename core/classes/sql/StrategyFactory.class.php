<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\sql
 * @author     Christopher Abram
 * @version    1.0
 * @date	20.08.2016
 */

namespace core\classes\sql;

class StrategyFactory {
    // vars {
        
        
        
    // } methods {
    
        // public {
            
            public static function getBlank(){
                $strategy = new Strategy(
                        new \core\classes\sql\statement\select\Blank(),
                        new \core\classes\sql\statement\update\Blank(),
                        new \core\classes\sql\statement\insert\Blank(),
                        new \core\classes\sql\statement\delete\Blank());
                return $strategy;
            }// end getBlank
            
            public static function getCountry(\core\classes\sql\attribute\AttributeList $attributes){
                $select = new \core\classes\sql\statement\select\Country($attributes);
                $update = new \core\classes\sql\statement\update\Country($attributes);
                $insert = new \core\classes\sql\statement\insert\Country($attributes);
                $delete = new \core\classes\sql\statement\delete\Country();
                return new Strategy($select, $update, $insert, $delete);
            }// end getCountry
            
            public static function getAddress(\core\classes\sql\attribute\AttributeList $attributes){
                $select = new \core\classes\sql\statement\select\Address($attributes);
                $update = new \core\classes\sql\statement\update\Address($attributes);
                $insert = new \core\classes\sql\statement\insert\Address($attributes);
                $delete = new \core\classes\sql\statement\delete\Address();
                return new Strategy($select, $update, $insert, $delete);
            }// end getAddress
            
            public static function getUserRole(\core\classes\sql\attribute\AttributeList $attributes){
                $select = new \core\classes\sql\statement\select\UserRole($attributes);
                $update = new \core\classes\sql\statement\update\UserRole($attributes);
                $insert = new \core\classes\sql\statement\insert\UserRole($attributes);
                $delete = new \core\classes\sql\statement\delete\UserRole();
                return new Strategy($select, $update, $insert, $delete);
            }// end getUserRole
            
            public static function getUser(\core\classes\sql\attribute\AttributeList $attributes){
                $select = new \core\classes\sql\statement\select\User($attributes);
                $update = new \core\classes\sql\statement\update\User($attributes);
                $insert = new \core\classes\sql\statement\insert\User($attributes);
                $delete = new \core\classes\sql\statement\delete\User();
                return new Strategy($select, $update, $insert, $delete);
            }// end getUser
            
            public static function getPage(\core\classes\sql\attribute\AttributeList $attributes){
                $select = new \core\classes\sql\statement\select\Page($attributes);
                $update = new \core\classes\sql\statement\update\Page($attributes);
                $insert = new \core\classes\sql\statement\insert\Page($attributes);
                $delete = new \core\classes\sql\statement\delete\Page();
                return new Strategy($select, $update, $insert, $delete);
            }// end getPage
            
            public static function getPageArticle(\core\classes\sql\attribute\AttributeList $attributes){
                $select = new \core\classes\sql\statement\select\PageArticle($attributes);
                $update = new \core\classes\sql\statement\update\PageArticle($attributes);
                $insert = new \core\classes\sql\statement\insert\PageArticle($attributes);
                $delete = new \core\classes\sql\statement\delete\PageArticle();
                return new Strategy($select, $update, $insert, $delete);
            }// end getPageArticle
            
            public static function getUserPage(\core\classes\sql\attribute\AttributeList $attributes){
                $select = new \core\classes\sql\statement\select\UserPage($attributes);
                $update = new \core\classes\sql\statement\update\UserPage($attributes);
                $insert = new \core\classes\sql\statement\insert\UserPage($attributes);
                $delete = new \core\classes\sql\statement\delete\UserPage();
                return new Strategy($select, $update, $insert, $delete);
            }// end getUserPage
            
            public static function getPageVisit(\core\classes\sql\attribute\AttributeList $attributes){
                $select = new \core\classes\sql\statement\select\PageVisit($attributes);
                $update = new \core\classes\sql\statement\update\PageVisit($attributes);
                $insert = new \core\classes\sql\statement\insert\PageVisit($attributes);
                $delete = new \core\classes\sql\statement\delete\PageVisit();
                return new Strategy($select, $update, $insert, $delete);
            }// end getPageVisit
            
            public static function getArticle(\core\classes\sql\attribute\AttributeList $attributes){
                $select = new \core\classes\sql\statement\select\Article($attributes);
                $update = new \core\classes\sql\statement\update\Article($attributes);
                $insert = new \core\classes\sql\statement\insert\Article($attributes);
                $delete = new \core\classes\sql\statement\delete\Article();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticle
            
            public static function getArticleVisit(\core\classes\sql\attribute\AttributeList $attributes){
                $select = new \core\classes\sql\statement\select\ArticleVisit($attributes);
                $update = new \core\classes\sql\statement\update\ArticleVisit($attributes);
                $insert = new \core\classes\sql\statement\insert\ArticleVisit($attributes);
                $delete = new \core\classes\sql\statement\delete\ArticleVisit();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleVisit
            
            public static function getArticleGrade(\core\classes\sql\attribute\AttributeList $attributes){
                $select = new \core\classes\sql\statement\select\ArticleGrade($attributes);
                $update = new \core\classes\sql\statement\update\ArticleGrade($attributes);
                $insert = new \core\classes\sql\statement\insert\ArticleGrade($attributes);
                $delete = new \core\classes\sql\statement\delete\ArticleGrade();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleGrade
            
            public static function getComment(\core\classes\sql\attribute\AttributeList $attributes){
                $select = new \core\classes\sql\statement\select\Comment($attributes);
                $update = new \core\classes\sql\statement\update\Comment($attributes);
                $insert = new \core\classes\sql\statement\insert\Comment($attributes);
                $delete = new \core\classes\sql\statement\delete\Comment();
                return new Strategy($select, $update, $insert, $delete);
            }// end getComment
            
            public static function getFileInfo(\core\classes\sql\attribute\AttributeList $attributes){
                $select = new \core\classes\sql\statement\select\FileInfo($attributes);
                $update = new \core\classes\sql\statement\update\FileInfo($attributes);
                $insert = new \core\classes\sql\statement\insert\FileInfo($attributes);
                $delete = new \core\classes\sql\statement\delete\FileInfo();
                return new Strategy($select, $update, $insert, $delete);
            }// end getFileInfo
            
            public static function getFileMiniature(\core\classes\sql\attribute\AttributeList $attributes){
                $select = new \core\classes\sql\statement\select\FileMiniature($attributes);
                $update = new \core\classes\sql\statement\update\FileMiniature($attributes);
                $insert = new \core\classes\sql\statement\insert\FileMiniature($attributes);
                $delete = new \core\classes\sql\statement\delete\FileMiniature();
                return new Strategy($select, $update, $insert, $delete);
            }// end getFileMiniature
            
            public static function getFile(\core\classes\sql\attribute\AttributeList $attributes){
                $select = new \core\classes\sql\statement\select\File($attributes);
                $update = new \core\classes\sql\statement\update\File($attributes);
                $insert = new \core\classes\sql\statement\insert\File($attributes);
                $delete = new \core\classes\sql\statement\delete\File();
                return new Strategy($select, $update, $insert, $delete);
            }// end getFile
            
            public static function getSession(\core\classes\sql\attribute\AttributeList $attributes){
                $select = new \core\classes\sql\statement\select\Session($attributes);
                $update = new \core\classes\sql\statement\update\Session($attributes);
                $insert = new \core\classes\sql\statement\insert\Session($attributes);
                $delete = new \core\classes\sql\statement\delete\Session();
                return new Strategy($select, $update, $insert, $delete);
            }// end getSession
            
            public static function getSessionValue(\core\classes\sql\attribute\AttributeList $attributes){
                $select = new \core\classes\sql\statement\select\SessionValue($attributes);
                $update = new \core\classes\sql\statement\update\SessionValue($attributes);
                $insert = new \core\classes\sql\statement\insert\SessionValue($attributes);
                $delete = new \core\classes\sql\statement\delete\SessionValue();
                return new Strategy($select, $update, $insert, $delete);
            }// end getSessionValue
            
            
            
            
            
            public static function getDepartment(\core\classes\sql\attribute\AttributeList $attributes){
                $select = new \core\classes\sql\statement\select\Department($attributes);
                $update = new \core\classes\sql\statement\update\Department($attributes);
                $insert = new \core\classes\sql\statement\insert\Department($attributes);
                $delete = new \core\classes\sql\statement\delete\Department();
                return new Strategy($select, $update, $insert, $delete);
            }
            
            public static function getResponsibility(\core\classes\sql\attribute\AttributeList $attributes){
                $select = new \core\classes\sql\statement\select\Responsibility($attributes);
                $update = new \core\classes\sql\statement\update\Responsibility($attributes);
                $insert = new \core\classes\sql\statement\insert\Responsibility($attributes);
                $delete = new \core\classes\sql\statement\delete\Responsibility();
                return new Strategy($select, $update, $insert, $delete);
            }
            
            public static function getWorkingTime(\core\classes\sql\attribute\AttributeList $attributes){
                $select = new \core\classes\sql\statement\select\WorkingTime($attributes);
                $update = new \core\classes\sql\statement\update\WorkingTime($attributes);
                $insert = new \core\classes\sql\statement\insert\WorkingTime($attributes);
                $delete = new \core\classes\sql\statement\delete\WorkingTime();
                return new Strategy($select, $update, $insert, $delete);
            }
            
            public static function getAgreement(\core\classes\sql\attribute\AttributeList $attributes){
                $select = new \core\classes\sql\statement\select\Agreement($attributes);
                $update = new \core\classes\sql\statement\update\Agreement($attributes);
                $insert = new \core\classes\sql\statement\insert\Agreement($attributes);
                $delete = new \core\classes\sql\statement\delete\Agreement();
                return new Strategy($select, $update, $insert, $delete);
            }
            
            
            
            public static function getSessionBySID(){
                $select = new \core\classes\sql\statement\select\SessionBySID();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getSessionBySID
            
            public static function getSessionValueByKey(){
                $select = new \core\classes\sql\statement\select\SessionValueByKey();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getSessionValueByKey
            
            public static function getSessionValueBySessionId(){
                $select = new \core\classes\sql\statement\select\SessionValueBySessionId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\SessionValueBySessionId();
                return new Strategy($select, $update, $insert, $delete);
            }// end getSessionValueBySessionId
            
            public static function getCountryByAddressId(){
                $select = new \core\classes\sql\statement\select\CountryByAddressId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getCountryByAddressId
            
            public static function getCountryByUserId(){
                $select = new \core\classes\sql\statement\select\CountryByUserId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getCountryByUserId
            
            public static function getUserRoleByUserId(){
                $select = new \core\classes\sql\statement\select\UserRoleByUserId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getUserRoleByUserId
            
            public static function getAddressByUserId(){
                $select = new \core\classes\sql\statement\select\AddressByUserId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getAddressByUserId
            
            public static function getUserByPageId(){
                $select = new \core\classes\sql\statement\select\UserByPageId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getUserByPageId
            
            public static function getUnremovedPageById(\core\classes\sql\attribute\AttributeList $attributes){
                $select = new \core\classes\sql\statement\select\UnremovedPageById($attributes);
                $update = new \core\classes\sql\statement\update\Page($attributes);
                $insert = new \core\classes\sql\statement\insert\Page($attributes);
                $delete = new \core\classes\sql\statement\delete\Page();
                return new Strategy($select, $update, $insert, $delete);
            }// end getUnremovedPageById
            
            public static function getUserByArticleId(){
                $select = new \core\classes\sql\statement\select\UserByArticleId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getUserByArticleId
            
            public static function getUserByCommentId(){
                $select = new \core\classes\sql\statement\select\UserByCommentId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getUserByCommentId
            
            public static function getUserByToken(){
                $select = new \core\classes\sql\statement\select\UserByToken();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getUserByToken
            
            public static function getUserByFileInfoId(){
                $select = new \core\classes\sql\statement\select\UserByFileInfoId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getUserByFileInfoId
            
            public static function getAllUsersNotRemoved(){
                $select = new \core\classes\sql\statement\select\AllUsersNotRemoved();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getAllUsersNotRemoved
            
            public static function getUserByIdentifiers(){
                $select = new \core\classes\sql\statement\select\UserByIdentifiers();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getUserByIdentifiers
            
            public static function getNotRemovedUserCount(){
                $select = new \core\classes\sql\statement\select\NotRemovedUserCount();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getNotRemovedUserCount
            
            public static function getRemovedUsers(){
                $select = new \core\classes\sql\statement\select\RemovedUsers();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\RemoveMovedUsers();
                return new Strategy($select, $update, $insert, $delete);
            }// end getRemovedUsers
            
            public static function getRestoreAllUsers(){
                $select = new \core\classes\sql\statement\select\Blank();
                $update = new \core\classes\sql\statement\update\RestoreAllUsers();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getRestoreAllUsers
            
            public static function getPageByChildPageId(){
                $select = new \core\classes\sql\statement\select\PageByChildPageId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getPageByChildPageId
            
            public static function getPageByArticleId(){
                $select = new \core\classes\sql\statement\select\PageByArticleId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getPageByArticleId
            
            public static function getPageByArticleIdAndByBin(){
                $select = new \core\classes\sql\statement\select\PageByArticleIdAndByBin();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getPageByArticleIdAndByBin
            
            public static function getPageByArticleIdByBinAndByHide(){
                $select = new \core\classes\sql\statement\select\PageByArticleIdByBinAndByHide();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getPageByArticleIdByBinAndByHide
            
            public static function getAllPageByPublicistIdAndByBin(){
                $select = new \core\classes\sql\statement\select\AllPageByPublicistIdAndByBin();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getAllPageByPublicistIdAndByBin
            
            public static function getPageByUserId(){
                $select = new \core\classes\sql\statement\select\PageByUserId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getPageByArticleId
            
            public static function getPageArticleByArticleId(){
                $select = new \core\classes\sql\statement\select\PageArticleByArticleId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\PageArticleByArticleId();
                return new Strategy($select, $update, $insert, $delete);
            }// end getPageArticleByArticleId
            
            public static function getUserPageByUserId(){
                $select = new \core\classes\sql\statement\select\UserPageByUserId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\UserPageByUserId();
                return new Strategy($select, $update, $insert, $delete);
            }// end getUserPageByArticleId
            
            public static function getUserPageByPageId(){
                $select = new \core\classes\sql\statement\select\UserPageByPageId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getUserPageByPageId
            
            public static function getPageByParentPageId(){
                $select = new \core\classes\sql\statement\select\PageByParentPageId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getPageByParentPageId
            
            public static function getPageByParentPageIdAndByBin(){
                $select = new \core\classes\sql\statement\select\PageByParentPageIdAndByBin();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getPageByParentPageIdAndByBin
            
            public static function getPageByParentPageIdByBinAndByHide(){
                $select = new \core\classes\sql\statement\select\PageByParentPageIdByBinAndByHide();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getPageByParentPageIdByBinAndByHide
            
            public static function getPageByNamepath(){
                $select = new \core\classes\sql\statement\select\PageByNamepath();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getPageByNamepath
            
            public static function getPageBinOperations(){
                $select = new \core\classes\sql\statement\select\Blank();
                $update = new \core\classes\sql\statement\update\RestorePageFromBin();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\MovePageToBin();
                return new Strategy($select, $update, $insert, $delete);
            }// end getPageBinOperations
            
            public static function getPageHideOperations(){
                $select = new \core\classes\sql\statement\select\Blank();
                $update = new \core\classes\sql\statement\update\ShowPage();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\HidePage();
                return new Strategy($select, $update, $insert, $delete);
            }// end getPageHideOperations
            
            public static function getPageHavingAnyArticles(){
                $select = new \core\classes\sql\statement\select\PageHavingAnyArticles();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getPageHavingAnyArticles
            
            public static function getPageHavingAnyArticlesforPublicist(){
                $select = new \core\classes\sql\statement\select\PageHavingAnyArticlesforPublicist();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getPageHavingAnyArticlesforPublicist
            
            public static function getCountPage(){
                $select = new \core\classes\sql\statement\select\CountPage();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getCountPage
            
            public static function getCountNotRemovedPage(){
                $select = new \core\classes\sql\statement\select\CountNotRemovedPage();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getCountNotRemovedPage
            
            public static function getCountPageHavingAnyArticles(){
                $select = new \core\classes\sql\statement\select\CountPageHavingAnyArticles();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getCountPageHavingAnyArticles
            
            public static function getCountPageHavingAnyArticlesforPublicist(){
                $select = new \core\classes\sql\statement\select\CountPageHavingAnyArticlesforPublicist();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getCountPageHavingAnyArticlesforPublicist
            
            public static function getPageVisitCount(){
                $select = new \core\classes\sql\statement\select\PageVisitCount();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getPageVisitCount
            
            public static function getPageVisitCountByPageId(){
                $select = new \core\classes\sql\statement\select\PageVisitCountByPageId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getPageVisitCountByPageId
            
            public static function getRemovedPages(){
                $select = new \core\classes\sql\statement\select\RemovedPages();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\RemoveMovedPages();
                return new Strategy($select, $update, $insert, $delete);
            }// end getRemovedPages
            
            public static function getRestoreAllPages(){
                $select = new \core\classes\sql\statement\select\Blank();
                $update = new \core\classes\sql\statement\update\RestoreAllPages();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getRestoreAllPages
            
            public static function getArticleByCommentId(){
                $select = new \core\classes\sql\statement\select\ArticleByCommentId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleByCommentId
            
            public static function getArticleHavingAnyComments(){
                $select = new \core\classes\sql\statement\select\ArticleHavingAnyComments();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleHavingAnyComments
            
            public static function getArticleHavingAnyCommentsByPublicist(){
                $select = new \core\classes\sql\statement\select\ArticleHavingAnyCommentsByPublicist();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleHavingAnyCommentsByPublicist
            
            public static function getArticleByPageId(){
                $select = new \core\classes\sql\statement\select\ArticleByPageId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleByPageId
            
            public static function getArticleByPageIdAndByBin(){
                $select = new \core\classes\sql\statement\select\ArticleByPageIdAndByBin();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleByPageIdAndByBin
            
            
            public static function getAllDepartments(){
                $select = new \core\classes\sql\statement\select\AllDepartments();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleByPageIdAndByBin
            
            public static function getDepartmentsByUserId(){
                $select = new \core\classes\sql\statement\select\DepartmentsByUserId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleByPageIdAndByBin
            
            public static function getAllResponsibilities(){
                $select = new \core\classes\sql\statement\select\AllResponsibilities();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }
            
            public static function getResponsibilitiesByUserId(){
                $select = new \core\classes\sql\statement\select\ResponsibilitiesByUserId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }
            
            public static function getAllWorkingTimes(){
                $select = new \core\classes\sql\statement\select\AllWorkingTimes();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }
            
            public static function getAllAgreements(){
                $select = new \core\classes\sql\statement\select\AllAgreements();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }
            
            public static function getAgreementsByUserId(){
                $select = new \core\classes\sql\statement\select\AgreementsByUserId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleByPageIdAndByBin
            
            
            public static function getArticleByUserIdAndByBin(){
                $select = new \core\classes\sql\statement\select\ArticleByUserIdAndByBin();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleByUserIdAndByBin
            
            public static function getArticleByPageIdByUserIdAndByBin(){
                $select = new \core\classes\sql\statement\select\ArticleByPageIdByUserIdAndByBin();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleByUserIdAndByBin
            
            public static function getArticleByPageIdByBinAndByHide(){
                $select = new \core\classes\sql\statement\select\ArticleByPageIdByBinAndByHide();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleByPageIdAndByBin
            
            public static function getArticleByUserIdByBinAndByHide(){
                $select = new \core\classes\sql\statement\select\ArticleByUserIdByBinAndByHide();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleByUserIdAndByBin
            
            public static function getArticleByBinAndByHide(){
                $select = new \core\classes\sql\statement\select\ArticleByBinAndByHide();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleByUserIdAndByBin
            
            public static function getArticleByBinAndByHideWithSliderImage(){
                $select = new \core\classes\sql\statement\select\ArticleByBinAndByHideWithSliderImage();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleByBinAndByHideWithSliderImage
            
            public static function getArticleByUserId(){
                $select = new \core\classes\sql\statement\select\ArticleByUserId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleByUserId
            
            public static function getArticleByNamepath(){
                $select = new \core\classes\sql\statement\select\ArticleByNamepath();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleByNamepath
            
            
            public static function getDepartmentByNamepath(){
                $select = new \core\classes\sql\statement\select\DepartmentByNamepath();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }
            
            
            public static function getArticleByNamepathAndByUserId(){
                $select = new \core\classes\sql\statement\select\ArticleByNamepathAndByUserId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleByNamepathAndByUserId
            
            public static function getRemovedArticleByUserId(){
                $select = new \core\classes\sql\statement\select\RemovedArticleByUserId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\RemovedArticleByUserId();
                return new Strategy($select, $update, $insert, $delete);
            }// end getRemovedArticleByUserId
            
            public static function getRemovedArticle(){
                $select = new \core\classes\sql\statement\select\RemovedArticles();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\RemoveMovedArticles();
                return new Strategy($select, $update, $insert, $delete);
            }// end getRemovedArticle
            
            public static function getAllArticleSortedByCdate(){
                $select = new \core\classes\sql\statement\select\AllArticleSortedByCdate();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getAllArticleSortedByCdate
            
            public static function getAllArticleSortedByCdateNotHiddenAndNotRemoved(){
                $select = new \core\classes\sql\statement\select\AllArticleSortedByCdateNotHiddenAndNotRemoved();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getAllArticleSortedByCdate
            
            public static function getAllArticleSortedNotHiddenAndNotRemovedByPageId(){
                $select = new \core\classes\sql\statement\select\AllArticleSortedNotHiddenAndNotRemovedByPageId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getAllArticleSortedByCdate
            
            public static function getArticleBinOperations(){
                $select = new \core\classes\sql\statement\select\Blank();
                $update = new \core\classes\sql\statement\update\RestoreArticleFromBin();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\MoveArticleToBin();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleBinOperations
            
            public static function getArticleHideOperations(){
                $select = new \core\classes\sql\statement\select\Blank();
                $update = new \core\classes\sql\statement\update\ShowArticle();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\HideArticle();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleHideOperations
            
            public static function getCountArticle(){
                $select = new \core\classes\sql\statement\select\CountArticle();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getCountArticle
            
            
            
            
            public static function getCountDepartment(){
                $select = new \core\classes\sql\statement\select\CountDepartment();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }
            
            public static function getCountResponsibility(){
                $select = new \core\classes\sql\statement\select\CountResponsibility();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }
            
            public static function getCountWorkingTime(){
                $select = new \core\classes\sql\statement\select\CountWorkingTime();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }
            
            public static function getCountAgreement(){
                $select = new \core\classes\sql\statement\select\CountAgreement();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }
            
            public static function getCountAgreementByUserId(){
                $select = new \core\classes\sql\statement\select\CountAgreementByUserId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }
            
            
            
            public static function getCountNotRemovedArticle(){
                $select = new \core\classes\sql\statement\select\CountNotRemovedArticle();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getCountNotRemovedArticle
            
            public static function getCountNotRemovedArticleByPageId(){
                $select = new \core\classes\sql\statement\select\CountNotRemovedArticleByPageId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getCountNotRemovedArticleByPageId
            
            public static function getCountNotRemovedArticleByUserId(){
                $select = new \core\classes\sql\statement\select\CountNotRemovedArticleByUserId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getCountNotRemovedArticleByUserId
            
            public static function getCountNotRemovedArticleByPageIdAndByUserId(){
                $select = new \core\classes\sql\statement\select\CountNotRemovedArticleByPageIdAndByUserId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getCountNotRemovedArticleByUserId
            
            public static function getNotRemovedAndNotHiddenArticleCountByPageId(){
                $select = new \core\classes\sql\statement\select\CountNotRemovedAndNotHiddenArticleByPageId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getCountNotRemovedAndNotHiddenArticle
            
            public static function getNotRemovedAndNotHiddenArticleCountByUserId(){
                $select = new \core\classes\sql\statement\select\CountNotRemovedAndNotHiddenArticleByUserId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getCountNotRemovedAndNotHiddenArticle
            
            public static function getCountNotRemovedAndNotHiddenArticle(){
                $select = new \core\classes\sql\statement\select\CountNotRemovedAndNotHiddenArticle();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getCountNotRemovedAndNotHiddenArticle
            
            public static function getArticleCountByPageId(){
                $select = new \core\classes\sql\statement\select\ArticleCountByPageId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleCountByPageId
            
            public static function getArticleCountHavingAnyCommets(){
                $select = new \core\classes\sql\statement\select\ArticleCountHavingAnyComments();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleCountHavingAnyCommets
            
            public static function getArticleCountHavingAnyCommetsByPublicist(){
                $select = new \core\classes\sql\statement\select\ArticleCountHavingAnyCommentsByPublicist();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleCountHavingAnyCommetsByPublicist
            
            public static function getArticleVisitCount(){
                $select = new \core\classes\sql\statement\select\ArticleVisitCount();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleVisitCount
            
            public static function getArticleVisitCountByArticleId(){
                $select = new \core\classes\sql\statement\select\ArticleVisitCountByArticleId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleVisitCountByArticleId
            
            public static function getArticleGradeCount(){
                $select = new \core\classes\sql\statement\select\ArticleGradeCount();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleGradeCount
            
            public static function getArticleGradeCountByArticleId(){
                $select = new \core\classes\sql\statement\select\ArticleGradeCountByArticleId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleGradeCountByArticleId
            
            public static function getArticleGradeCountByUserAndArticleId(){
                $select = new \core\classes\sql\statement\select\ArticleGradeCountByUserAndArticleId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleGradeCountByUserAndArticleId
            
            public static function getArticleGradeByUserAndArticleId(){
                $select = new \core\classes\sql\statement\select\ArticleGradeByUserAndArticleId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleGradeByUserAndArticleId
            
            public static function getArticleGradeAverage(){
                $select = new \core\classes\sql\statement\select\ArticleGradeAverage();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleGradeAverage
            
            public static function getArticleGradeAverageByArticleId(){
                $select = new \core\classes\sql\statement\select\ArticleGradeAverageByArticleId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getArticleGradeAverageByArticleId
            
            public static function getRemoveMovedArticles(){
                $select = new \core\classes\sql\statement\select\Blank();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\RemoveMovedArticles();
                return new Strategy($select, $update, $insert, $delete);
            }// end getRemoveMovedArticles
            
            public static function getRestoreAllArticles(){
                $select = new \core\classes\sql\statement\select\Blank();
                $update = new \core\classes\sql\statement\update\RestoreAllArticles();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getRestoreAllArticles
            
            public static function getRemoveMovedArticlesByUserId(){
                $select = new \core\classes\sql\statement\select\Blank();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\RemoveMovedArticlesByUserId();
                return new Strategy($select, $update, $insert, $delete);
            }// end getRemoveMovedArticlesByUserId
            
            public static function getRestoreAllArticlesByUserId(){
                $select = new \core\classes\sql\statement\select\Blank();
                $update = new \core\classes\sql\statement\update\RestoreAllArticlesByUserId();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getRestoreAllArticlesByUserId
            
            public static function getRemoveMovedFiles(){
                $select = new \core\classes\sql\statement\select\Blank();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\RemoveMovedFiles();
                return new Strategy($select, $update, $insert, $delete);
            }// end getRemoveMovedFiles
            
            public static function getRestoreAllFiles(){
                $select = new \core\classes\sql\statement\select\Blank();
                $update = new \core\classes\sql\statement\update\RestoreAllFiles();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getRestoreAllFiles
            
            public static function getRemoveMovedFilesByUserId(){
                $select = new \core\classes\sql\statement\select\Blank();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\RemoveMovedFilesByUserId();
                return new Strategy($select, $update, $insert, $delete);
            }// end getRemoveMovedFilesByUserId
            
            public static function getRestoreAllFilesByUserId(){
                $select = new \core\classes\sql\statement\select\Blank();
                $update = new \core\classes\sql\statement\update\RestoreAllFilesByUserId();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getRestoreAllFilesByUserId
            
            public static function getCommentByUserId(){
                $select = new \core\classes\sql\statement\select\CommentByUserId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getCommentByUserId
            
            public static function getVisibleCommentByUserId(){
                $select = new \core\classes\sql\statement\select\VisibleCommentByUserId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getCommentByUserId
            
            public static function getCommentByArticleId(){
                $select = new \core\classes\sql\statement\select\CommentByArticleId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getCommentByArticleId
            
            public static function getCommentByArticleIdAndByPublicist(){
                $select = new \core\classes\sql\statement\select\CommentByArticleIdAndByPublicist();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getCommentByArticleId
            
            public static function getNotHiddenAndNotRemovedCommentByArticleId(){
                $select = new \core\classes\sql\statement\select\NotHiddenAndNotRemovedCommentByArticleId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getNotHiddenAndNotRemovedCommentByArticleId
            
            public static function getAllComment(){
                $select = new \core\classes\sql\statement\select\AllComment();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getAllComment
            
            public static function getAllCommentByPublicist(){
                $select = new \core\classes\sql\statement\select\AllCommentByPublicist();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getAllComment
            
            public static function getCountComment(){
                $select = new \core\classes\sql\statement\select\CountComment();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }
            
            public static function getCountCommentByPublicist(){
                $select = new \core\classes\sql\statement\select\CountCommentByPublicist();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }
            
            public static function getCountCommentByHide(){
                $select = new \core\classes\sql\statement\select\CountCommentByHide();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }
            
            public static function getCountCommentByArticleId(){
                $select = new \core\classes\sql\statement\select\CountCommentByArticleId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getCountCommentByArticleId
            
            public static function getCountCommentByArticleIdAndByPublicist(){
                $select = new \core\classes\sql\statement\select\CountCommentByArticleIdAndByPublicist();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getCountCommentByArticleId
            
            public static function getCountCommentByHideAndByArticleId(){
                $select = new \core\classes\sql\statement\select\CountCommentByHideAndByArticleId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }
            
            public static function getCountCommentByUserId(){
                $select = new \core\classes\sql\statement\select\CountCommentByUserId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getCountCommentByUserId
            
            public static function getCountVisibleCommentByUserId(){
                $select = new \core\classes\sql\statement\select\CountVisibleCommentByUserId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getCountCommentByUserId
            
            public static function getCountCommentByHideAndByUserId(){
                $select = new \core\classes\sql\statement\select\CountCommentByHideAndByUserId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getCountNotHiddenCommentByUserId
            
            public static function getCommentHideOperations(){
                $select = new \core\classes\sql\statement\select\Blank();
                $update = new \core\classes\sql\statement\update\ShowComment();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\HideComment();
                return new Strategy($select, $update, $insert, $delete);
            }// end getCommentHideOperations
            
            public static function getAvatarByUserId(){
                $select = new \core\classes\sql\statement\select\AvatarByUserId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getAvatarByUserId
            
            public static function getFileInfoByFileId(){
                $select = new \core\classes\sql\statement\select\FileInfoByFileId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getFileInfoByFileId
            
            public static function getFileInfoByFileMiniatureId(){
                $select = new \core\classes\sql\statement\select\FileInfoByFileMiniatureId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getFileInfoByFileMiniatureId
            
            public static function getFileInfoByArticleId(){
                $select = new \core\classes\sql\statement\select\FileInfoByArticleId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getFileInfoByArticleId
            
            public static function getFileInfoByUserId(){
                $select = new \core\classes\sql\statement\select\FileInfoByUserId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getFileInfoByUserId
            
            public static function getImageFileInfoByUserId(){
                $select = new \core\classes\sql\statement\select\ImageFileInfoByUserId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getFileInfoByUserId
            
            public static function getNotRemovedFileInfoByUserId(){
                $select = new \core\classes\sql\statement\select\NotRemovedFileInfoByUserId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getNotRemovedFileInfoByUserId
            
            public static function getNotRemovedFileInfo(){
                $select = new \core\classes\sql\statement\select\NotRemovedFileInfo();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getNotRemovedFileInfo
            
            public static function getRemovedFileByUserId(){
                $select = new \core\classes\sql\statement\select\RemovedFileByUserId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\RemovedFileByUserId();
                return new Strategy($select, $update, $insert, $delete);
            }// end getRemovedFileByUserId
            
            public static function getRemovedFiles(){
                $select = new \core\classes\sql\statement\select\RemovedFiles();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\RemoveMovedFiles();
                return new Strategy($select, $update, $insert, $delete);
            }// end getRemovedFiles
            
            public static function getFileCount(){
                $select = new \core\classes\sql\statement\select\FileCount();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getFileCount
            
            public static function getNotRemovedFileCount(){
                $select = new \core\classes\sql\statement\select\NotRemovedFileCount();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getNotRemovedFileCount
            
            public static function getFileCountByUserId(){
                $select = new \core\classes\sql\statement\select\FileCountByUserId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getFileCountByUserId
            
            public static function getImageCountByUserId(){
                $select = new \core\classes\sql\statement\select\ImageCountByUserId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getImageCountByUserId
            
            public static function getNotRemovedFileCountByUserId(){
                $select = new \core\classes\sql\statement\select\NotRemovedFileCountByUserId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getNotRemovedFileCountByUserId
            
            public static function getFileMiniatureByFileInfoId(){
                $select = new \core\classes\sql\statement\select\FileMiniatureByFileInfoId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getFileMiniatureByFileInfoId
            
            public static function getFileByFileInfoId(){
                $select = new \core\classes\sql\statement\select\FileByFileInfoId();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getFileByFileInfoId
            
            public static function getAllCountries(){
                $select = new \core\classes\sql\statement\select\AllCountries();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getFileByFileInfoId
            
            public static function checkEmailExistence(){
                $select = new \core\classes\sql\statement\select\EmailExistence();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }// end getFileByFileInfoId
    
        // } protected {
        
            
    
        // } private {
            
        // }
    // }
}