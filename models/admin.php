<?php

//require_once 'news.php';
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/database/gateway.php');

class ModelAdmin{

	private $maxNews;
	private $urls;
 	private $rssXMLArray = array();
 	private $gateway = null;

	public function getUrls(){
  	return $this->urls;
  }

   public function getMaxNews(){
   	return $this->maxNews;
  }

	public function setMaxNews($max_news){
		$this->max_news = $max_news;
		return $this->gateway->SetMaxNews($max_news);
	}

	function __construct(){
  	    $this->gateway = new Gateway();
		$this->maxNews = $this->gateway->getMaxNews();
		$this->urls = $this->gateway->getUrls();
		$this->xml2Tab($this->urls);
	}

	public function isValidUser($usr, $pswd){
		return ($this->gateway->validCreditentials($usr,$pswd));
	}

	public function UpdateUrl($url, $action){
		if($action == 'add'){
			return $this->gateway->AddUrl($url);
		}
		return $this->gateway->RmUrl($url);
	}

    public function xml2Tab($urls){
        $i = 0;
        while($row = $urls->fetch_assoc()) {
            $this->rssXMLArray[$i] = @simplexml_load_file($row["url"]); // XML parser
            $i++;
        }
	}
}
