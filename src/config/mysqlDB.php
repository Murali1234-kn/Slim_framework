<?php
class Db
{
    public $dbhost = 'localhost';
    public $dbuser = 'root';
    public $dbpass = '';
    public $dbname = 'slim';
    public $dbConn;

    public function __construct()
    {
        $this->dbConn = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);

        if ($this->dbConn->connect_error) {
            die("Connection failed: " . $this->dbConn->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->dbConn;
    }
}