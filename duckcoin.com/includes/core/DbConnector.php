<?php

namespace App {
    use Exception;
    use PDO;

    class DbConnector
    {
        private  static $_instance = null;

        private function __construct()
        {
            try {
                self::$_instance = new PDO(
                    'mysql:host='.DB_HOST.';dbname='.DB_NAME,
                    DB_USER,
                    DB_PASS,
                    [PDO::MYSQL_ATTR_INIT_COMMAND => "set names 'utf8'" ]
                );
            } catch (Exception $e) {
                self::$_instance->rollback();
                throw new Exception(($e->getMessage()));
            }
        }
        public static function getInstance()
        {
            if(self::$_instance != null) {
                return self::$_instance;
            } else return new self;
        }
    }
}