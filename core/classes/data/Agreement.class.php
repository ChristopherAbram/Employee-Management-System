<?php
/*
 * Copyright (c) 2016 Christopher Abram.
 *
 * <description>
 *
 * @package    core\classes\data
 * @author     Christopher Abram
 * @version    1.0
 * @date       24.08.2016
 */

namespace core\classes\data;

class Agreement extends Data {
    // vars {
        
        // Default attribute list:
        protected $_defaultAttributeList    = array(
            'id', 'user_id', 'department_id', 'responsibility_id', 'working_time_id',
            'salary', 'from_date', 'to_date', 'description'
        );
        
        // All attribute list:
        protected $_allAttributeList        = array(
            'id', 'user_id', 'department_id', 'responsibility_id', 'working_time_id',
            'salary', 'from_date', 'to_date', 'description'
        );
        
        // Table name:
        protected $_tableName               = 'agreement';
    
    // } methods {
    
        // public {
        
            public function __construct($id = null){
                parent::__construct($id);
                
                // Getting .. statement strategy:
                $this->_strategy = \core\classes\sql\StrategyFactory::getAgreement($this->getAttributeList());
                
                // Getting and establishing connection:
                $connection = \ConnectionRegistry::getUserEstablishedConnection();
                
                // Create new mapper object:
                $this->_mapper = new \core\classes\mapper\DataMapper($connection, $this->_strategy);
                $this->_mapper->setIndexName($this->_getIndexName());
                
            }// end __construct
            
            public function terminate(){
                $args = new \core\classes\sql\attribute\AttributeList(array('id', 'to_date'));
                $this->setAttributeList($args);
                $p = false;
                if($this->read()){
                    $d = $this->getData();
                    if(empty($d['to_date']) || ($d['to_date'] > \date(DATE))){
                        $data = array('id' => $this->getID(), 'to_date' => \date(DATE));
                        $this->setData($data);
                        $p = $this->update();
                    }
                    else {
                        $p = false;
                    }
                }
                $this->setAttributeList(new \core\classes\sql\attribute\AttributeList($this->_defaultAttributeList));
                return $p;
            }
            
            public static function count(){
                $strategy = \core\classes\sql\StrategyFactory::getCountAgreement();
                return self::_count($strategy, array());
            }// end count
            
            public static function countByUserId($id){
                $strategy = \core\classes\sql\StrategyFactory::getCountAgreementByUserId();
                return self::_count($strategy, array('user_id' => $id));
            }// end count
            
            public static function getTotalJobSalaryByUserId($id){
                try {
                    $connection = \ConnectionRegistry::getUserEstablishedConnection();
                    $pdo = $connection->getPDO();
                    
                    $stmt = $pdo->prepare('SELECT total_job(:id) AS \'total\'');
                    $stmt->execute(array(':id' => $id));
                    $result = $stmt->fetchAll();
                    if(isset($result[0]['total'])){
                        return $result[0]['total'];
                    }
                } catch (Exception $ex) {}
                return 0;
            }
            
            public static function getTotalContractSalaryByUserId($id){
                try {
                    $connection = \ConnectionRegistry::getUserEstablishedConnection();
                    $pdo = $connection->getPDO();
                    
                    $stmt = $pdo->prepare('SELECT total_contract(:id) AS \'total\'');
                    $stmt->execute(array(':id' => $id));
                    $result = $stmt->fetchAll();
                    if(isset($result[0]['total'])){
                        return $result[0]['total'];
                    }
                } catch (Exception $ex) {}
                return 0;
            }
            
            public static function getMonthSalaryByUserId($id){
                try {
                    $connection = \ConnectionRegistry::getUserEstablishedConnection();
                    $pdo = $connection->getPDO();
                    
                    $stmt = $pdo->prepare('SELECT month_salary(:id) AS \'salary\'');
                    $stmt->execute(array(':id' => $id));
                    $result = $stmt->fetchAll();
                    if(isset($result[0]['salary'])){
                        return $result[0]['salary'];
                    }
                } catch (Exception $ex) {}
                return 0;
            }
            
            public static function getContractSalaryByUserId($id){
                try {
                    $connection = \ConnectionRegistry::getUserEstablishedConnection();
                    $pdo = $connection->getPDO();
                    
                    $stmt = $pdo->prepare('SELECT contract_salary(:id) AS \'salary\'');
                    $stmt->execute(array(':id' => $id));
                    $result = $stmt->fetchAll();
                    if(isset($result[0]['salary'])){
                        return $result[0]['salary'];
                    }
                } catch (Exception $ex) {}
                return 0;
            }
            
        // } protected {
            
            
            
        // } private {
            
            
            
        // }
    // }
}