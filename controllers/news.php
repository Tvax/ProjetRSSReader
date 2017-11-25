<?php

class ControllerIndex{

	private $modelNews;
	private $admin = false;
	private $disconnect = false;
	private $error;

	public function getAdmin(){
		return $this->admin;
	}
	public function getDisconnected(){
		return $this->disconnected;
	}
	public function getError(){
		return $this->error;
	}

	public function setAdminTrue(){
		$this->admin = true;
	}
	public function setError($err){
		$this->$error = $err;
	}

	function __construct($modelNews){
		$this->modelNews = $modelNews;
	}

	public function Disconnect(){
  unset($_COOKIE['username']);
  unset($_COOKIE['password']);
  setcookie('username', null, -1, '/');
  setcookie('password', null, -1, '/');
	$this->disconnected = true;
	//session stop plutot
	}
}
