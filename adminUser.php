<?php

function Disconnect(){
  //on expire les cookies pour quil puisse se reconnecter avec good creditentials
  unset($_COOKIE['username']);
  unset($_COOKIE['password']);
  setcookie('username', null, -1, '/');
  setcookie('password', null, -1, '/');
}
  ?>
