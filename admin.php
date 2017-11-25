<?php

require("database.php");
require("adminUser.php");

$d = new Database;

if(!isset($_COOKIE['username']) || !isset($_COOKIE['password'])){
  //si  pas de cookies on check si ya bon username et password via POST
  if(!$d->validCreditentials($_POST['username'], $_POST['password'])){
    homepage();
  }
  //si ils sont bons on assigne ces coockies pour 10m
  setcookie("username", $_POST['username'], time() + (10 * 60), "/");
  setcookie("password", $_POST['password'], time() + (10 * 60), "/");
}
//sinon les cookies existent, mais on check si ce qu;il ya dedans est bon
else{
  if(!$d->validCreditentials($_COOKIE['username'], $_COOKIE['password'])){
    Disconnect();
    homepage();
  }
}

if(isset($_POST['max_news']) && $_POST['max_news'] != null){
    print $d->setMaxNews($_POST['max_news']);
}
if(isset($_POST['contact']) && $_POST['contact'] != null){
  if($_POST['contact'] == 'add'){
    $d->addUrl($_POST['url']);
  }
  else if ($_POST['contact'] == 'rm'){
    $d->rmUrl($_POST['url']);
  }
}


function displayUrls($d){
  $result = $d->getUrls();
  $row = null;
  $string = "<h4>URLs : </h4>";
  while($row = $result->fetch_assoc()) {
    $string .= '<p>' . $row["url"] . '</p>';
  }
  return $string;
}

function homepage(){
  header('Location: index.php?err');
  die();
}

function displayAdmin($d){
  $string = '<p><a href="index.php">HOME</a></p>';
  $string .= '<a href="index.php?disconnect">Disconnect</a><br>';
  $string .= 'Max news : ' . $d->getMaxNews();
  $string .= '<form action="admin.php" method="POST">
   <p> Max news to parse : <input type="number" name="max_news" min="1" max="50"></p>
   <span>RSS Feed</span> <input type="text" name="url">
   <input class="radio" type="radio" name="contact" value="add" checked /> <span>Add</span>
   <input class="radio" type="radio" name="contact" value="rm" /> <span>Remove</span>
   <p><input type="submit"></p>
  </form>';

  return $string;
}


echo displayAdmin($d);
echo displayUrls($d);

?>
