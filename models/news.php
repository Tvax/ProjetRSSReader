<?php

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/database/gateway.php');

class ModelNews{

  private $maxNews;
  private $rssXMLArray = array();
  private $gateway = null;

  function __construct(){
    $this->gateway = new Gateway();
    $this->maxNews = $this->gateway->getMaxNews();
    $this->xml2Tab($this->gateway->getUrls());
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
