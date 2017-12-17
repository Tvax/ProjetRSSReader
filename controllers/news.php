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
		return $this->disconnect;
	}
	public function getError(){
		return $this->error;
	}

	public function setAdminTrue(){
		$this->admin = true;
	}
	public function setError($err){
		$this->error = $err;
	}

	function __construct($modelNews){
		$this->modelNews = $modelNews;
        if($_SESSION['admin'] == $this->modelNews->getSessionAdmin()){
            $this->admin = true;
        }
	}

	public function Disconnect(){
        $_SESSION["admin"] = "";
        session_destroy();
        $this->admin = false;
        $this->disconnect = true;
	}
}
