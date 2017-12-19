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
      return '<h3 class="channel-title"><p align="center">Credidentials error, try again !<p></h3>';
    }

    if($this->controllerNews->getDisconnected()){
      return '<h3 class="channel-title"><p align="center">Disconnected succesfully !<p></h3>';
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

      //La on affiche le nom de la chaine en gros au dessous de toutes les new
      $string .= '<div class="container"><div class="properties-news"><h1 align="center" class ="channel-title">'.$rss->channel->title.'</h1>';

      //La on affiche chaque news de CNN, comme montre la haut
      foreach($rss->channel->item as $item) {
        if ($j < $this->modelNews->getMaxNews()) { // Max news c'est le nombre max de news a afficher pour chaque flux
          $num=$j+1;
          $string .= '<div class="news-article"><h3 class="sub-channel-title">Article ' .$num.' of '.$rss->channel->title.'</h3>';
          $string .= '<a href="'.$item->link.'">'.$item->title.'</a><br />';
          $string .= '<p>' .$item->pubDate.'<p>';
          $string .= '<p class="news-description">' .$item->description.'</p><br/><br/>';
          $num=$j+1;
        }
        $j++;
         $string .='</div>';
      }
      $string .='<div>
            <p><br/>
            </p>
          </div>
          </div>
        </div>
      </div>';
     
    }
    $string .=' </body>
    </html> ';
    //Et ca retourne le tout
    return $string;
  }

  public function output(){
    return $this->generateTop() . $this->generateNotif() . $this->generateBottom();
  }

}
