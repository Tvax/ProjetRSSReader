<?php

class Gateway{
	private $d = null;
	
	function __construct(argument){
		$this->d = new Database();
	}

	public function ValidCreditentials($usr, $pswd){
    $sql = "SELECT username, password FROM Settings";
    $row = $this->ExecQuery($sql);
    
    if($row['username'] == $usr && $row['password'] == $pswd){
      return true;
    }
    return false;
  }

  public function GetUrls(){
    $sql = "SELECT url FROM Feed";
    $row = $this->ExecQuery($sql);

    if ($row->num_rows > 0) {
      return $result;
    }
    return false;
  }

  public function GetMaxNews(){
    $sql = "SELECT max_news FROM Settings";
    $result = $this->ExecQuery($sql);

    if ($result->num_rows > 0){
      $row = $result->fetch_assoc();
      return $row["max_news"];
    }
    else {
      return 10;
    }
  }

  public function SetMaxNews($max_news){
    $sql = "UPDATE Settings SET max_news = $max_news WHERE Settings.username = 'admin'";
    return ExecQuerySet($sql);

//mettre ca dans le modele en dessous
    if ($this->conn->query($sql) === TRUE) {
      return "<p>Max news that will be fetched : $max_news</p><br>";
    }
    else {
      return "Error: " . $sql . "<br>" . $this->conn->error;
    }
  }


}