<?php

/**
 *  THIS FILE IS USED FOR THE DATABASE CONFIGURATION
 * 
 * 
*/
class DatabaseConnect {
          private $db_host = "localhost";
          private $db_name = 'wiuc';
          private $db_username = 'root';
          private $db_password = '';
          private $db_charset = 'utf8mb4';

          public $conn;


          public function connect() {
               $this->conn = null;

               //test connection is null
               if($this->conn == null) {
                    try {
                         $server_path = "mysql:host=".$this->getDatabaseHostName().";dbname=".$this->getDatabaseName().";charset=".$this->getDatabaseCharacterSet();
                         $pdo_options = [
                              PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                              PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                              PDO::ATTR_EMULATE_PREPARES =>   false
                         ];  

                         $this->conn = new PDO($server_path, $this->getDatabaseUserName(), $this->getDatabasePassword());

                         //return connection
                         return $this->conn;
                    } catch (\Exception $ex) {
                    return $ex->getMessage();
                    }
               }
          }

          //Accessor

          public function getDatabaseHostName()
          {
               return $this->db_host;
          }

          public function getDatabaseName()
          {
               return $this->db_name;
          }

          public function getDatabaseUserName()
          {
               return $this->db_username;
          }

          public function getDatabasePassword()
          {
               return $this->db_password;
          }

          public function getDatabaseCharacterSet()
          {
               return $this->db_charset;
          }


}