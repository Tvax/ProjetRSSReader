<?php

require("database.php");

function DisplayTop($opt){
  $string = '<form action="admin.php" method="POST">
                <p>Username : <input type="text" name="username" /></p>
                <p>Password : <input type="password" name="password" /></p>
                <p><input type="submit" value="Connect"></p>
                </form>';
  if($opt == 'err'){
    return $string . '<p>Login Error</p>';
  }
  else if ($opt == 'cookie'){
    return'<a href="admin.php">Admin Settings</a>';
  }
  return $string;
}

function DisplayRSSFeed(){

  $d = new Database;

  $result = $d->getUrls();
  $max_news = $d->getMaxNews();
  $file = null;

  while($row = $result->fetch_assoc()) {
    $file .= DisplayRSS($row["url"], $max_news);
  }
  return $file;
}


function DisplayRSS($url, $max_news){
  $i = 0; // counter
  //$url = "http://feeds.foxnews.com/foxnews/latest"; // url to parse
  $rss = simplexml_load_file($url); // XML parser

  // RSS items loop

  $string = '<h2><img style="vertical-align: middle;" src="'.$rss->channel->image->url.'" /> '.$rss->channel->title.'</h2>'; // channel title + img with src

  foreach($rss->channel->item as $item) {
      if ($i < $max_news) { // parse only 10 items
        $string .= '<a href="'.$item->link.'">'.$item->title.'</a><br />';
        $string .= '<p>' .$item->pubDate.'<p>';
        $string .= '<p>' .$item->description.'<p>';
      }
      $i++;
  }
  return $string;
}

?>
