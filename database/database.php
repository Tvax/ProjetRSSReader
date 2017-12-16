<?php

class Database{

  private $servername = "sql11.freemysqlhosting.net";
  private $username = "sql11205709";
  private $password =  null;
  private $dbname = "sql11205709";
  private $conn = null;

  function __construct(){
    $this->connect();
  }

  private function connect(){
//    $this->password = 'JXXfhRc7EL';
    $this->password = getenv('DBPASSWD_ENV');
    $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    // Check connection
    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  public function ExecQueryGet($query){
    $sql = $query;
    $result = $this->conn->query($sql);
    return $result->fetch_assoc();
  }

  public function ExecQuerySet($query){
    return $this->conn->query($query);
  }

  

  

  public function addUrl($url){
    $url = '"' . $url . '"';
    $sql = "INSERT INTO Feed (url) VALUES($url)";

    if ($this->conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" .$this->conn->error;
    }
  }

  public function rmUrl($url){
    $url = '"' . $url . '"';
    $sql = "DELETE FROM Feed WHERE Feed.url = $url";
    if ($this->conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" .$this->conn->error;
    }
  }

}

?>
