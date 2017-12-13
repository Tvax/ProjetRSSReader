<?php

define('__ROOT__', dirname(dirname(__FILE__)));
require(__ROOT__.'/database.php');

class ModelNews{

  private $maxNews;
  private $rssXMLArray = array();
  private $d = null;

  function __construct(){
    $this->d = new Database();
    $this->maxNews = $this->d->getMaxNews();
    $this->xml2Tab($this->d->getUrls());
  }

  public function getMaxNews(){
    return $this->maxNews;
  }

  public function getrssXMLArray(){
    return $this->rssXMLArray;
  }

 public function xml2Tab($urls){
    $i = 0;
    while($row = $urls->fetch_assoc()) {
      $this->rssXMLArray[$i] = @simplexml_load_file($row["url"]); // XML parser
      $i++;
    }
  }

}
