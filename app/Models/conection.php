<?php
namespace App\Models;
require_once __DIR__ . '/../../config/Config.php';


use mysqli;

class conection
{
    private static $instance;
    private $mysqli;

    private function __construct()
    {
        // Your database connection details
        
        $dbHost = DB_HOST;
        $dbUser = DB_USERNAME;
        $dbPass = DB_PASSWORD;
        $dbName = DB_NAME;
  
        // Create a database connection
        $this-> mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

        // Check connection
        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->mysqli;
    }
    public function close()
    {
        return $this->mysqli->close();
    }
}
?>
