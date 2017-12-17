<?php

session_start();

require_once 'controllers/news.php';
require_once 'models/news.php';
require_once 'views/news.php';

$modelNews = new ModelNews();
$controllerIndex = new ControllerIndex($modelNews);

if(isset($_GET['disconnect'])){
  $controllerIndex->Disconnect();
  $viewIndexDisconnected = new NewsView($controllerIndex, $modelNews);
  echo $viewIndexDisconnected->output();
}
elseif(isset($_COOKIE['username'])){
  $controllerIndex->setAdminTrue();
  $viewIndexAdmin = new NewsView($controllerIndex, $modelNews);
  echo $viewIndexAdmin->output();
}
elseif(isset($_GET['err'])){
  //$controllerIndex->setError($_GET['err']);
  $controllerIndex->setError('idError');
  $viewIndexError = new NewsView($controllerIndex, $modelNews);
  echo $viewIndexError->output();
}
else{
  $viewIndex = new NewsView($controllerIndex, $modelNews);
  echo $viewIndex->output();
}