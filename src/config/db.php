<?php
class Db
{
    private $dbhost = 'localhost';
  private $dbuser = 'root';
  private $dbpass = '';
  private $dbname = 'slim';
  public function connect() {

    $prepare_conn_str = "mysql:host=$this->dbhost;dbname=$this->dbname";
    $dbConn = new PDO( $prepare_conn_str, $this->dbuser, $this->dbpass );

    $dbConn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    return $dbConn;
  }
 }
