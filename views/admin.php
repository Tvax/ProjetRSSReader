<?php

class AdminView{

	private $controllerAdmin;
	private $modelAdmin;

 function __construct($controllerAdmin, $modelAdmin){
    $this->controllerAdmin = $controllerAdmin;
    $this->modelAdmin = $modelAdmin;
  }

  private function generateTop(){
  	include(__ROOT__ . '/layouts/adminTop.html');
    if($this->modelAdmin->getDBError != null){
        include(__ROOT__ . '/layouts/adminError.html');
    }
  }

  private function generateMaxNews(){
  	return '<div class="container properties-news"><h3>Max news : '. $this->modelAdmin->getMaxNews().'</h3>';
  }

  private function generateBottom(){
	  $result =  $this->modelAdmin->getUrls();
	  $row = null;
	  $string = '<h4>URLs : </h4>';
	  while($row = $result->fetch_assoc()) {
	    $string .= '<p>' . $row["url"] . '</p>';
	  }
    $string.='</div>
      </body>
    </html>';
	  return $string;
  }

  public function Homepage($param){
    header('Location: index.php' . $param);
    die();
  }

  public function output(){
    return $this->generateTop() . $this->generateMaxNews() . $this->generateBottom();
  }
}
