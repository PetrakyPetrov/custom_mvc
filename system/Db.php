<?php 

use \PDO;

class Db {

    private $dbhost = 'localhost';
    private $dbuser = 'root';
    private $dbpass = 'root';
    private $dbname = 'custom_mvc';

    public function connect () {
        $connectionString = "mysql:host=$this->dbhost;dbname=$this->dbname;";
        $connection = new PDO($connectionString, $this->dbuser, $this->dbpass);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $connection;
    }
}