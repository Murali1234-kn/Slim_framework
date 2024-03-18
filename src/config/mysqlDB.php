<?php
class Db
{
    private $dbhost = 'localhost';
    private $dbuser = 'root';
    private $dbpass = '';
    private $dbname = 'slim';
    private $dbConn;

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
?>