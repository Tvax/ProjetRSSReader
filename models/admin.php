<?php

//require_once 'news.php';
define('__ROOT__', dirname(dirname(__FILE__)));
require(__ROOT__.'/database.php');

class ModelAdmin{

	private $d = null;
	private $maxNews;
	private $urls;
 	private $rssXMLArray = array();
 	private $gateway = null;

	function __construct(){
  	$this->d = new Database();
		$this->maxNews = $this->d->getMaxNews();
		$this->urls = $this->d->getUrls();
		$this->xml2Tab($this->d->getUrls());
	}

	public function setMaxNews($max_news){
		$this->max_news = $max_news;
		$this->gateway
	}

	public function isValidUser($usr, $pswd){
		return ($this->d->validCreditentials($usr,$pswd));
	}

 public function getUrls(){
 	return $this->urls;
 }

  public function getMaxNews(){
  	return $this->maxNews;
  }

 public function xml2Tab($urls){
    $i = 0;
    while($row = $urls->fetch_assoc()) {
      $this->rssXMLArray[$i] = @simplexml_load_file($row["url"]); // XML parser
      $i++;
    }
}

}
