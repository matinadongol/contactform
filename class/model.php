<?php
abstract class Model{
    public $conn = null;
    private $stmt = null;
    private $sql = null;
    private $table = null;

    function __construct(){
        try{
            $this->conn = new PDO('mysql:host='.DB_HOST.'; dbname='.DB_NAME.';', DB_USER, DB_PASSWORD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->stmt = $this->conn->prepare('SET NAMES utf8');
            $this->stmt->execute();
        } catch(PDOException $e){
            error_log('PDO, ['.date('Y-m-d H:i:s').']: '.$e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT']. 'error/error.log');
            return false;
        } catch(Exception $e){
            error_log('General, ['.date('Y-m-d H:i:s').']: '.$e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT']. 'error/error.log');
            return false;
        }
    }

    final protected function table($_table){
        $this->table = $_table;
    }

    final protected function insert($data = array(), $is_die = false){
        try{
            $this->sql = "INSERT INTO ";

            if(!isset($this->table) || $this->table == NULL){
                throw new Exception("Table Not Set"); 
            }

            $this->sql .= $this->table." SET "; 

            if(isset($data) && !empty($data)){
                if(is_array($data)){
                    $temp = array();
                    foreach($data as $column_name => $value){
                        $str = $column_name." = :".$column_name;
                        $temp[] = $str;
                    }
                    $this->sql .= implode(', ', $temp);
                } else {
                    $this->sql .= $data;
                }
            } else {
                throw new Exception("Data not set.");
            }

            //debugger($args);
                //debugger($this->sql, true);

            if($is_die){
                debugger($args);
                debugger($this->sql, true);
            }

            $this->stmt = $this->conn->prepare($this->sql);

            if(is_array($data)){
                foreach($data as $column_name => $value){
                    if(is_null($value)){
                        $param = PDO::PARAM_NULL;
                    } else if(is_bool($value)){
                        $param = PDO::PARAM_BOOL;
                    } else if(is_int($value)){
                        $param = PDO::PARAM_INT;
                    } else {
                        $param = PDO::PARAM_STR;
                    }

                    if(isset($param)){
                        $this->stmt->bindValue(":".$column_name, $value, $param);
                    }
                }
            }

            $success=$this->stmt->execute();

            if($success){
                return $this->conn->lastInsertId(); //returns last row id 
            } else {
                return false;
            }
        } catch(PDOException $e){
            // error_log('PDO, ['.date('Y-m-d H:i:s').']: '.$e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT']. 'error/error.log');
            return false;
        } catch(Exception $e){
            // error_log('General, ['.date('Y-m-d H:i:s').']: '.$e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT']. 'error/error.log');
            return false;
        }
    }
}
?>