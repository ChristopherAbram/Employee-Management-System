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
            
            public static function getDepartmentByNamepath(){
                $select = new \core\classes\sql\statement\select\DepartmentByNamepath();
                $update = new \core\classes\sql\statement\update\Blank();
                $insert = new \core\classes\sql\statement\insert\Blank();
                $delete = new \core\classes\sql\statement\delete\Blank();
                return new Strategy($select, $update, $insert, $delete);
            }
            
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