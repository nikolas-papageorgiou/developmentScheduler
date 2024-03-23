<?php

class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        // Establish database connection
        $this->connection = new PDO("mysql:host=localhost;dbname=nikos_papageorgiou","root", "");
        // Set PDO to throw exceptions on errors
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}

// // Usage:
// $db = Database::getInstance();
// $connection = $db->getConnection();
// // Now you can use $connection to execute queries
