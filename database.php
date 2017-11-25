<?php

class Database{

  private $servername = "sql11.freemysqlhosting.net";
  private $username = "sql11205709";
//  private $password = "JXXfhRc7EL";
//  private $password =  $_SERVER['DBPASSWD_ENV'];
  private $password =  null;
  private $dbname = "sql11205709";
  private $conn = null;

  function __construct(){
    $this->connect();
  }

  private function connect(){
    $this->password = $_SERVER['DBPASSWD_ENV'];
    $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    // Check connection
    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  public function validCreditentials($usr, $pswd){
    $sql = "SELECT username, password FROM Settings";
    $result = $this->conn->query($sql);
    $row = $result->fetch_assoc();

    if($row['username'] == $usr && $row['password'] == $pswd){
      return true;
    }
    return false;
  }

  public function getUrls(){
    $sql = "SELECT url FROM Feed";
    $result = $this->conn->query($sql);
    //$conn->close();

    if ($result->num_rows > 0) {
      return $result;
    }
    else {
      return false;
    }
  }

  public function setMaxNews($max_news){
    $sql = "UPDATE Settings SET max_news = $max_news WHERE Settings.username = 'admin'";

    if ($this->conn->query($sql) === TRUE) {
      return "<p>Max news that will be fetched : $max_news</p><br>";
    }
    else {
      return "Error: " . $sql . "<br>" . $this->conn->error;
    }
  }

  public function getMaxNews(){
    $sql = "SELECT max_news FROM Settings";
    $result = $this->conn->query($sql);

    if ($result->num_rows > 0){
      $row = $result->fetch_assoc();
      return $row["max_news"];
    }
    else {
      return 10;
    }
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
