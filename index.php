<?php

session_start();

require_once 'controllers/news.php';
require_once 'models/news.php';
require_once 'views/news.php';

$modelAdmin = new ModelNews();
$controllerIndex = new ControllerIndex($modelAdmin);

if(isset($_GET['disconnect'])){
  $controllerIndex->Disconnect();
  $viewIndexDisconnected = new NewsView($controllerIndex, $modelAdmin);
  echo $viewIndexDisconnected->output();
}
elseif(isset($_COOKIE['username'])){
  $controllerIndex->setAdminTrue();
  $viewIndexAdmin = new NewsView($controllerIndex, $modelAdmin);
  echo $viewIndexAdmin->output();
}
elseif(isset($_GET['err'])){
  //$controllerIndex->setError($_GET['err']);
  $controllerIndex->setError('idError');
  $viewIndexError = new NewsView($controllerIndex, $modelAdmin);
  echo $viewIndexError->output();
}
else{
  $viewIndex = new NewsView($controllerIndex, $modelAdmin);
  echo $viewIndex->output();
}