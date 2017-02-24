<?php

    class Database {
        
        private static $instance = NULL;
        
        private function __construct() {}
        
        private function __clone() {}
        
        public static function getInstance() {
            if (!isset(self::$instance)) {
                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                $config = parse_ini_file('./db.ini'); 
                self::$instance = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'], 
                    $config['username'],
                    $config['password'],
                    $pdo_options);
            }
            return self::$instance;
        }
        
    }