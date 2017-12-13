<?php

class NewsView {

  private $controllerNews;
  private $modelNews;
  private $idError = "idError";

  function __construct($controllerNews, $modelNews){
    $this->controllerNews = $controllerNews;
    $this->modelNews = $modelNews;
  }

  function generateTop(){
    if(!$this->controllerNews->getAdmin()){
      include (__ROOT__.'/layouts/indexTopLogin.php');
      //return 'login';
    }
    else{
      include (__ROOT__.'/layouts/indexTopAdmin.php');
      //return 'admin';
    }
  }

  function generateNotif(){
    if($this->controllerNews->getError() == $this->idError) {
      return "Credidentials error, try again !";
    }

    if($this->controllerNews->getDisconnected()){
      return "Disconnected succesfully";
    }
  }

  function generateBottom(){
    $string = null;
    $rssArray = $this->modelNews->getrssXMLArray();
    $i = count($rssArray); //nb de truc dans array

    for($i; $i >= 0; $i--){ //parcourir array
      $j = 0;
      $rss = $rssArray[$i];
      $string .= '<h2><img style="vertical-align: middle;" src="'.$rss->channel->image->url.'" /> '.$rss->channel->title.'</h2>';
      foreach($rss->channel->item as $item) {
        if ($j < $this->modelNews->getMaxNews()) { // parse only 10 items
          $string .= '<a href="'.$item->link.'">'.$item->title.'</a><br />';
          $string .= '<p>' .$item->pubDate.'<p>';
          $string .= '<p>' .$item->description.'<p>';
        }
        $j++;
      }
    }
    return $string;
  }

  public function output(){
    return $this->generateTop() . $this->generateNotif() . $this->generateBottom();
  }

}
