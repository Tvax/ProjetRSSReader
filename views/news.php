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
      include(__ROOT__ . '/layouts/indexTopLogin.html');
      //return 'login';
    }
    else{
      include (__ROOT__.'/layouts/indexTopAdmin.html');
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
    /*
    recup du tableau de chaque flux RSS
    par exemple :   Tab -> CNN
                        CNN -> news 1
                        CNN -> news 2
                    Tab -> Fox
                        Fox -> news 1
                        Fox -> news 2
                    ...


    */

    $rssArray = $this->modelNews->getrssXMLArray();
    $i = count($rssArray); //nb de flux  dans le tableau (CNN, FOX ...)

    for($i; $i >= 0; $i--){ //parcourir le tableau de flux (CNN, FOX...)
      $j = 0;
      $rss = $rssArray[$i];

      //La on affiche le nom de la chaine en gros au dessous de toutes les new (CNN en gros + som logo si y'en a un)
      $string .= '<h2><img style="vertical-align: middle;" src="'.$rss->channel->image->url.'" /> '.$rss->channel->title.'</h2>';

      //La on affiche chaque news de CNN, comme montre la haut
      foreach($rss->channel->item as $item) {
        if ($j < $this->modelNews->getMaxNews()) { // Max news c'est le nombre max de news a afficher pour chaque flux
          $string .= '<a href="'.$item->link.'">'.$item->title.'</a><br />';
          $string .= '<p>' .$item->pubDate.'<p>';
          $string .= '<p>' .$item->description.'<p>';
        }
        $j++;
      }
    }
    //Et ca retourne le tout
    return $string;
  }

  public function output(){
    return $this->generateTop() . $this->generateNotif() . $this->generateBottom();
  }

}
